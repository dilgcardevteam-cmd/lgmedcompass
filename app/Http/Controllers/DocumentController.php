<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentAssignment;
use App\Models\DocumentSchedule;
use App\Models\Section;
use App\Models\User;
use App\Notifications\DeadlineReminderNotification;
use App\Notifications\FocalPersonAssigned;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DocumentController extends Controller
{
    private function storeUploadedDocument(UploadedFile $file): string
    {
        $folder = 'documents';
        $originalName = $file->getClientOriginalName();
        $filename = preg_replace('/[<>:"\/\\|?*\x00-\x1F]/u', '_', $originalName);
        $filename = trim($filename) ?: 'document.'.$file->getClientOriginalExtension();

        if (! str_contains($filename, '.')) {
            $filename .= '.'.$file->getClientOriginalExtension();
        }

        $path = "{$folder}/{$filename}";
        $baseName = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $counter = 1;

        while (Storage::disk('public')->exists($path)) {
            $path = "{$folder}/{$baseName}-{$counter}.{$extension}";
            $counter++;
        }

        $file->storeAs($folder, basename($path), 'public');

        return $path;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sections = Section::all();
        $query = Document::with('schedules');

        // 🔎 SEARCH FILTER
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject_title', 'like', "%{$search}%")
                    ->orWhere('focal_person', 'like', "%{$search}%")
                    ->orWhere('frequency', 'like', "%{$search}%");
            });
        }

        // Mark overdue schedules
        DocumentSchedule::where('status', 'pending')
            ->whereDate('due_date', '<', Carbon::today())
            ->update(['status' => 'overdue']);

        // 📂 SECTION FILTER
        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        // 📅 FREQUENCY FILTER
        if ($request->filled('frequency')) {
            $query->where('frequency', $request->frequency);
        }

        // 👤 ROLE-BASED DOCUMENT FILTER
        $user = Auth::user();

        // Use case-insensitive matching with trim to handle role name variations
        $userRole = strtolower(trim($user->role));
        $chiefRoles = ['admin', 'division chief', 'assistant division chief', 'divisionchief', 'assistantdivisionchief'];

        // Check if user's section_id is 1 or 2, or if their role is a chief role
        if (in_array($user->section_id, [1, 2]) || in_array($userRole, $chiefRoles)) {
            // Users with section_id 1 or 2, or chief roles, see ALL documents
            // No filters applied by default - same as Admin access
            if ($request->filled('section')) {
                $query->where('section', $request->section);
            }
        } else {
            // Regular users see only documents from their section
            $query->where('section', $user->section_id);
        }

        // 🏷️ FILTER (due today / upcoming)
        if ($request->filled('filter')) {
            if ($request->filter === 'due_today') {
                $query->whereHas('schedules', function ($q) {
                    $q->where(function ($q2) {
                        $q2->where('status', 'pending')
                            ->orWhereNull('status');
                    })
                        ->whereDate('due_date', Carbon::today());
                });

                // For users with section_id 1 or 2, show all documents due today
                // For other users, show only their assigned documents
                if (! in_array($user->section_id, [1, 2])) {
                    $query->where('focal_person', Auth::user()->name);
                }
            }

            if ($request->filter === 'upcoming') {
                $query->where('status', '!=', 'Done')
                    ->whereHas('schedules', function ($q) {
                        $q->where(function ($q2) {
                            $q2->where('status', 'pending')
                                ->orWhereNull('status');
                        })
                            ->whereDate('due_date', '>', Carbon::today());
                    });

                // For users with section_id 1 or 2, show all upcoming documents
                // For other users, show only their assigned documents
                if (! in_array($user->section_id, [1, 2])) {
                    $query->where('focal_person', Auth::user()->name);
                }
            }
        }

        // ✅ NEW: Order by the nearest due_date (ascending)
        $query->select('documents.*')
            ->addSelect([
                'next_due_date' => DocumentSchedule::selectRaw('MIN(due_date)')
                    ->whereColumn('document_id', 'documents.id')
                    ->where(function ($q) {
                        $q->where('status', 'pending')
                            ->orWhere('status', 'overdue')
                            ->orWhereNull('status');
                    })
                    ->limit(1),
            ])
            ->orderByRaw('CASE WHEN next_due_date IS NULL THEN 1 ELSE 0 END')
            ->orderBy('next_due_date', 'asc')
            ->orderBy('documents.created_at', 'desc');

        $documents = $query->paginate(9)->withQueryString();

        $users = User::orderBy('first_name')->orderBy('last_name')->get();

        $statusColors = [
            'To Do' => '#6c757d',
            'In Progress' => '#0d6efd',
            'In Review' => '#ffc107',
            'Revision' => '#dc3545',
            'Done' => '#198754',
            'Incomplete' => '#fd7e14',
        ];

        // Documents due tomorrow (remains unchanged)
        $dueTomorrowDocs = $documents->filter(function ($doc) {
            $nextSchedule = $doc->schedules
                ->whereIn('status', ['pending', 'overdue'])
                ->sortBy('due_date')
                ->first();

            if (! $nextSchedule) {
                return false;
            }

            $dueDate = Carbon::parse($nextSchedule->due_date);

            return $dueDate->isTomorrow();
        });

        // 🔔 Notifications (unchanged)
        foreach ($documents as $doc) {
            if ($doc->focal_person !== $user->name) {
                continue;
            }

            $nextSchedule = $doc->schedules
                ->whereIn('status', ['pending', 'overdue'])
                ->sortBy('due_date')
                ->first();

            if (! $nextSchedule) {
                continue;
            }

            $dueDate = Carbon::parse($nextSchedule->due_date);

            $type = null;
            $message = null;

            if ($nextSchedule->status === 'overdue' || $dueDate->isPast()) {
                $type = 'overdue';
                $message = 'This document is overdue.';
            } elseif ($dueDate->isToday()) {
                $type = 'today';
                $message = 'Deadline is today.';
            } elseif ($dueDate->diffInDays(now()) <= 3) {
                $type = 'soon';
                $message = 'Deadline is approaching.';
            }

            if (! $type) {
                continue;
            }

            $alreadyNotified = $user->notifications()
                ->where('data->document_id', $doc->id)
                ->whereDate('created_at', today())
                ->exists();

            if (! $alreadyNotified) {
                $user->notify(new DeadlineReminderNotification($doc, $message, $type));
            }
        }

        // 📊 COUNTS (unchanged)
        $today = Carbon::today();

        // Calculate due today count based on section-based access
        // Use the same logic as the filter for consistency
        $dueTodayQuery = Document::where('status', '!=', 'Done')
            ->whereHas('schedules', function ($q) use ($today) {
                $q->where(function ($q2) {
                    $q2->where('status', 'pending')
                        ->orWhereNull('status');
                })
                    ->whereDate('due_date', $today);
            });

        // Apply section-based filtering for badge counts
        // Users with section_id 1 or 2, or chief roles see all documents
        // Other users see only documents from their section
        if (! in_array($user->section_id, [1, 2]) && ! in_array($userRole, $chiefRoles)) {
            $dueTodayQuery->where('section', $user->section_id);
        }

        $dueTodayCount = $dueTodayQuery->count();

        // Calculate upcoming count based on section-based access
        $upcomingQuery = Document::where('status', '!=', 'Done')
            ->whereHas('schedules', function ($q) use ($today) {
                $q->where(function ($q2) {
                    $q2->where('status', 'pending')
                        ->orWhereNull('status');
                })
                    ->whereDate('due_date', '>', $today);
            });

        // Apply section-based filtering for badge counts
        // Users with section_id 1 or 2, or chief roles see all documents
        // Other users see only documents from their section
        if (! in_array($user->section_id, [1, 2]) && ! in_array($userRole, $chiefRoles)) {
            $upcomingQuery->where('section', $user->section_id);
        }

        $upcomingCount = $upcomingQuery->count();

        return view('document', compact(
            'documents',
            'users',
            'statusColors',
            'dueTomorrowDocs',
            'dueTodayCount',
            'upcomingCount',
            'sections'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('first_name')->orderBy('last_name')->get();

        return view('documents.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $deadlines = $request->input('deadlines', []);
        if (is_array($deadlines)) {
            $deadlines = collect($deadlines)
                ->filter(fn ($deadline) => filled($deadline))
                ->values()
                ->all();
        }
        $request->merge(['deadlines' => $deadlines]);

        $request->validate([
            'subject_title' => 'required|string|max:255',
            'section' => 'required|string',
            'deadlines' => 'nullable|array',
            'deadlines.*' => 'nullable|string',
            'frequency' => 'required|in:weekly,bi-monthly,monthly,quarterly,semestral,annual,as-needed',
            'who_will_comply' => 'nullable|array',
            'who_will_comply.*' => 'required|string|in:LGU,DILG FOU,MGLOO,BARANGAY,Others',
            'who_will_comply_other' => 'nullable|string|max:255',
            'focal_person' => 'required|string|max:255',
            'reference' => 'nullable|string',
            'mode_of_submission' => 'nullable|string',
            'cy_link' => 'nullable|string',
            'remarks' => 'nullable|string',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf|max:2048',
            'document_link' => 'nullable|url|max:5048',
        ]);

        $deadlineCountError = $this->deadlineCountError($request->string('frequency')->toString(), $request->input('deadlines', []));
        if ($deadlineCountError !== null) {
            throw ValidationException::withMessages(['deadlines' => $deadlineCountError]);
        }
        $whoWillComply = $request->input('who_will_comply', []);
        $whoWillComply = is_array($whoWillComply) ? $whoWillComply : [];
        $whoWillComplyOther = in_array('Others', $whoWillComply, true)
            ? $request->input('who_will_comply_other')
            : null;
        $this->validateWhoWillComplyOther($whoWillComply, $whoWillComplyOther);

        // Handle file uploads
        $filePaths = null;
        if ($request->hasFile('documents')) {
            $filePaths = [];
            foreach ($request->file('documents') as $file) {
                $filePaths[] = $this->storeUploadedDocument($file);
            }
        }

        // Create the document
        $document = Document::create([
            'user_id' => auth()->id(),
            'subject_title' => $request->subject_title,
            'section' => $request->section,
            'frequency' => $request->frequency,
            'who_will_comply' => $whoWillComply,
            'who_will_comply_other' => $whoWillComplyOther,
            'focal_person' => $request->focal_person,
            'reference' => $request->reference,
            'mode_of_submission' => $request->mode_of_submission,
            'cy_link' => $request->cy_link,
            'remarks' => $request->remarks,
            'file_path' => $filePaths ? json_encode($filePaths) : null,
            'document_link' => $request->document_link,
            'progress' => 0, // Default progress
            'status' => 'To Do', // Default status
            'deadlines' => $request->input('deadlines', []),
        ]);
        // Create initial assignment for the uploader
        DocumentAssignment::create([
            'document_id' => $document->id,
            'assigned_to_id' => auth()->id(),
            'workflow_status' => 'Draft',
            'last_comment' => null,
        ]);

        // Create schedules for each deadline
        foreach ($request->input('deadlines', []) as $date) {
            if (blank($date) || strtoupper(trim($date)) === 'N/A') {
                continue;
            }

            $document->schedules()->create([
                'due_date' => $date,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(document $document)
    {
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $hasDeadlines = $request->exists('deadlines');
        $hasWhoWillComply = $request->boolean('who_will_comply_present');
        $deadlines = $request->input('deadlines', []);
        if (is_array($deadlines)) {
            $deadlines = collect($deadlines)
                ->filter(fn ($deadline) => filled($deadline))
                ->values()
                ->all();
        }
        $request->merge(['deadlines' => $deadlines]);

        $validator = Validator::make($request->all(), [
            'subject_title' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'frequency' => 'required|in:weekly,bi-monthly,monthly,quarterly,semestral,annual,as-needed',
            'who_will_comply' => 'nullable|array',
            'who_will_comply.*' => 'required|string|in:LGU,DILG FOU,MGLOO,BARANGAY,Others',
            'who_will_comply_other' => 'nullable|string|max:255',
            'deadlines' => 'nullable|array',
            'deadlines.*' => 'nullable|string',
            'focal_person' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
            'mode_of_submission' => 'nullable|string|max:255',
            'cy_link' => 'nullable|string|max:255',
            'document_link' => 'nullable|url|max:5048',
            'remarks' => 'nullable|string',
            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file|mimes:pdf|max:20000', // 20MB
        ]);

        $validator->after(function ($validator) use ($request): void {
            $deadlines = $request->input('deadlines', []);
            if (! is_array($deadlines)) {
                return;
            }

            $deadlineCountError = $this->deadlineCountError(
                (string) $request->input('frequency'),
                $deadlines
            );
            if ($deadlineCountError !== null) {
                $validator->errors()->add('deadlines', $deadlineCountError);
            }
            $whoWillComply = $request->input('who_will_comply', []);
            if (is_array($whoWillComply) && in_array('Others', $whoWillComply, true) && blank($request->input('who_will_comply_other'))) {
                $validator->errors()->add('who_will_comply_other', 'Please specify who will comply.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_edit_modal', $document->id); // Key part!
        }

        $data = $validator->validated();

        // Check if focal person is being changed
        $oldFocalPerson = $document->focal_person;
        $newFocalPerson = $data['focal_person'];
        $focalPersonChanged = $oldFocalPerson !== $newFocalPerson;

        $documentData = [
            'subject_title' => $data['subject_title'],
            'section' => $data['section'],
            'frequency' => $data['frequency'],
            'focal_person' => $data['focal_person'],
            'reference' => $data['reference'] ?? null,
            'mode_of_submission' => $data['mode_of_submission'] ?? null,
            'cy_link' => $data['cy_link'] ?? null,
            'document_link' => $data['document_link'] ?? null,
            'remarks' => $data['remarks'] ?? null,
        ];
        if ($hasWhoWillComply) {
            $whoWillComply = $data['who_will_comply'] ?? [];
            $whoWillComply = is_array($whoWillComply) ? $whoWillComply : [];
            $documentData['who_will_comply'] = $whoWillComply;
            $documentData['who_will_comply_other'] = in_array('Others', $whoWillComply, true)
                ? ($data['who_will_comply_other'] ?? null)
                : null;
        }
        if ($hasDeadlines) {
            $documentData['deadlines'] = $data['deadlines'] ?? [];
        }

        // Handle file uploads
        if ($request->hasFile('documents')) {
            // Optionally delete old files from storage
            $oldFiles = json_decode($document->file_path, true) ?? [];
            foreach ($oldFiles as $oldFile) {
                Storage::disk('public')->delete($oldFile);
            }

            $paths = [];
            foreach ($request->file('documents') as $file) {
                $paths[] = $this->storeUploadedDocument($file);
            }
            $documentData['file_path'] = json_encode($paths);
        }

        $document->update($documentData);

        // Create notification if focal person was changed
        if ($focalPersonChanged && $newFocalPerson) {
            $this->createFocalPersonNotification($document, $oldFocalPerson, $newFocalPerson);
        }

        if ($hasDeadlines) {
            $deadlines = $data['deadlines'] ?? [];
            $document->schedules()->delete();
            foreach ($deadlines as $dueDate) {
                if (blank($dueDate) || strtoupper(trim($dueDate)) === 'N/A') {
                    continue;
                }

                $document->schedules()->create(['due_date' => $dueDate]);
            }
        }

        $successMessage = $focalPersonChanged
            ? 'Document updated successfully. New focal person has been notified.'
            : 'Document updated successfully.';

        return redirect()
            ->route('documents.index')
            ->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if (Auth::id() !== 1 && Auth::id() !== $document->user_id) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            return back()->with('error', 'You are not authorized to delete this document.');
        }

        $document->delete();

        return back()->with('success', 'Document archived successfully.');
    }

    public function reports(Request $request)
    {
        $search = $request->search;

        $documents = Document::when($search, function ($query) use ($search) {
            $query->where('subject_title', 'like', "%{$search}%")
                ->orWhere('focal_person', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('reports', compact('documents', 'search'));
    }

    public function reportsLive(Request $request)
    {
        $search = $request->search;

        $documents = Document::where('subject_title', 'like', "%{$search}%")
            ->orWhere('focal_person', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(6)
            ->get();

        return response()->json($documents);
    }

    public function liveSearch(Request $request)
    {
        $search = $request->search;
        $section = $request->section;

        $query = Document::with('schedules')
            ->where(function ($q) use ($search) {
                $q->where('subject_title', 'like', "%{$search}%")
                    ->orWhere('focal_person', 'like', "%{$search}%")
                    ->orWhere('frequency', 'like', "%{$search}%");
            });

        if ($section) {
            $query->where('section', $section);
        }

        $documents = $query->orderBy('created_at', 'desc')->limit(10)->get();

        // Add computed fields for each document
        $documents->transform(function ($doc) {
            $nextSchedule = $doc->schedules
                ->where('due_date', '>', now())
                ->sortBy('due_date')
                ->first();

            $dueDate = $nextSchedule ? \Carbon\Carbon::parse($nextSchedule->due_date) : null;
            $isDone = $doc->status === 'Done';
            $isOverdue = ! $isDone && $dueDate && $dueDate->isPast();
            $isDueSoon = ! $isDone && $dueDate && $dueDate->diffInDays(now(), false) >= -3 && ! $dueDate->isPast();

            $doc->next_due_date = $dueDate ? $dueDate->format('M-d-Y') : null;
            $doc->is_overdue = $isOverdue;
            $doc->is_due_soon = $isDueSoon;
            $doc->effective_progress = $doc->effective_progress;
            $doc->progress_color = $doc->progress_color;
            $doc->files = $doc->file_path ? json_decode($doc->file_path) : [];
            $doc->document_link = $doc->document_link;

            // Format dates for the view modal
            $doc->created_at_formatted = $doc->created_at->format('M d, Y • h:i A');
            $doc->updated_at_formatted = $doc->updated_at->format('M d, Y • h:i A');

            return $doc;
        });

        return response()->json($documents);
    }

    public function generateReport()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('pdf', compact('documents'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('LGMed-Report.pdf');
    }

    public function archive(Document $document)
    {
        $document->delete();   // sets deleted_at

        return back()->with('success', 'Document archived successfully.');
    }

    public function markDoneArchive(Document $document)
    {
        // Mark as Done first
        $document->status = 'Done';
        $document->save();

        // Then archive it
        $document->delete();   // sets deleted_at

        return redirect()->route('documents.archiveIndex')
            ->with('success', 'Document marked as Done and archived successfully.');
    }

    public function restore($id)
    {
        $document = Document::withTrashed()->findOrFail($id);

        $document->restore();   // correct way

        return back()->with('success', 'Document restored successfully.');
    }

    public function destroyPermanent($id)
    {
        $document = Document::withTrashed()->findOrFail($id);

        $this->deleteDocumentFiles($document);
        $document->forceDelete();

        return back()->with('success', 'Document permanently deleted.');
    }

    public function archiveIndex(Request $request)
    {
        $this->purgeExpiredArchivedDocuments();

        $search = $request->search;
        $section = $request->section;
        $frequency = $request->frequency;
        $sections = Section::orderBy('name')->get();

        $documents = Document::onlyTrashed()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('subject_title', 'like', "%{$search}%")
                        ->orWhere('focal_person', 'like', "%{$search}%");
                });
            })

            ->when($section, function ($query) use ($section) {
                $query->where('section', $section);
            })

            ->when($frequency, function ($query) use ($frequency) {
                $query->where('frequency', $frequency);
            })

            ->orderBy('deleted_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('archive', compact('documents', 'search', 'section', 'frequency', 'sections'));
    }

    private function purgeExpiredArchivedDocuments(): void
    {
        Document::onlyTrashed()
            ->where('deleted_at', '<=', now()->subYears(3))
            ->get()
            ->each(function (Document $document): void {
                $this->deleteDocumentFiles($document);
                $document->forceDelete();
            });
    }

    private function deleteDocumentFiles(Document $document): void
    {
        $files = json_decode($document->file_path ?? '[]', true);

        if (! is_array($files)) {
            return;
        }

        foreach ($files as $file) {
            Storage::disk('public')->delete($file);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $newStatus = $request->status;
        $oldStatus = $document->status;

        // Update status
        $document->status = $newStatus;
        $document->save();

        // If status changed to 'Done' and document is not already soft-deleted, archive it
        if ($newStatus === 'Done' && $oldStatus !== 'Done' && ! $document->trashed()) {
            $document->delete(); // soft delete -> moves to archive
        }

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function clearNotifications()
    {
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
        ]);
    }

    public function getNotificationDetails($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $data = $notification->data;

        $document = Document::with('schedules')->findOrFail($data['document_id']);

        $nextSchedule = $document->schedules
            ->whereIn('status', ['pending', 'overdue'])
            ->sortBy('due_date')
            ->first();

        return response()->json([
            'title' => $document->subject_title,
            'due_date' => $nextSchedule ? $nextSchedule->due_date : null,
            'status' => $document->status,
        ]);
    }

    public function schedules()
    {
        return $this->hasMany(DocumentSchedule::class);
    }

    public function getEffectiveProgressAttribute()
    {
        $total = $this->schedules()->count();
        if ($total === 0) {
            return 0;
        }

        $completed = $this->schedules()->where('status', 'completed')->count();

        return round(($completed / $total) * 100);
    }

    public function getProgressColorAttribute()
    {
        $percent = $this->effective_progress;
        if ($percent >= 100) {
            return '#28a745';
        }
        if ($percent >= 70) {
            return '#17a2b8';
        }
        if ($percent >= 30) {
            return '#ffc107';
        }

        return '#dc3545';
    }

    public function completeSchedule(Document $document)
    {
        $document->load('schedules');
        $currentSchedule = $document->schedules()
            ->where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->first();

        if (! $currentSchedule) {
            return response()->json([
                'success' => false,
                'message' => 'All periods are already completed.',
                'progress' => $document->effective_progress,
            ], 400);
        }

        $currentSchedule->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Recalculate progress (completed / total * 100)
        $totalSchedules = $document->schedules()->count();
        $completedCount = $document->schedules()->where('status', 'completed')->count();
        $progress = ($totalSchedules > 0) ? (int) round(($completedCount / $totalSchedules) * 100) : 0;

        // Auto‑update document status
        $newStatus = 'To Do';
        if ($progress >= 100) {
            $newStatus = 'Done';
        } elseif ($completedCount > 0) {
            $newStatus = 'In Progress';
        }
        $document->update([
            'status' => $newStatus,
            'progress' => $progress,
        ]);

        if ($newStatus === 'Done' && ! $document->trashed()) {
            $document->delete();
        }

        // Get the next pending due date (for display)
        $nextPending = $document->schedules()
            ->where('status', '!=', 'completed')
            ->orderBy('due_date')
            ->first();

        $nextDueDate = $nextPending
            ? Carbon::parse($nextPending->due_date)->format('M d, Y')
            : null;

        $isNextDueToday = $nextPending
            ? Carbon::parse($nextPending->due_date)->isToday()
            : false;

        return response()->json([
            'success' => true,
            'message' => 'Completed period due on '.Carbon::parse($currentSchedule->due_date)->format('M d, Y'),
            'progress' => $progress,
            'isFullyComplete' => $progress >= 100,
            'nextDueDate' => $nextDueDate,
            'isNextDueToday' => $isNextDueToday,
            'newStatus' => $newStatus,
        ]);
    }

    public function advancePeriod(Request $request, $id)
    {
        $document = Document::with('schedules')->findOrFail($id);

        switch ($document->frequency) {
            case 'annual':
            case 'as-needed':
                // Mark document as Done and set progress to 100%
                $document->update(['status' => 'Done', 'progress' => 100]);
                $document->schedules()->update(['status' => 'completed']);
                $document->delete();
                $message = $document->frequency === 'annual'
                    ? 'Annual document marked as Done.'
                    : 'As-needed document marked as Done.';

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'new_status' => 'Done',
                    'progress' => 100,
                    'next_due_date' => null,
                ]);

            case 'monthly':
            case 'bi-monthly':
            case 'quarterly':
            case 'semestral':
            case 'weekly':
                // Find the earliest pending schedule
                $currentSchedule = $document->schedules()
                    ->where('status', 'pending')
                    ->orderBy('due_date')
                    ->first();

                if (! $currentSchedule) {
                    // No pending schedule → create the next one based on the latest due date
                    $lastSchedule = $document->schedules()->orderByDesc('due_date')->first();
                    if (! $lastSchedule) {
                        return response()->json(['success' => false, 'message' => 'No schedule found.'], 400);
                    }
                    $nextDueDate = Carbon::parse($lastSchedule->due_date);
                    $this->advanceDueDate($nextDueDate, $document->frequency);
                    $document->schedules()->create([
                        'due_date' => $nextDueDate,
                        'status' => 'pending',
                    ]);
                    // Progress stays the same (already 100% if all completed, but we recalc anyway)
                } else {
                    // Mark current as completed
                    $currentSchedule->update(['status' => 'completed']);

                    // Create the next schedule
                    $nextDueDate = Carbon::parse($currentSchedule->due_date);
                    $this->advanceDueDate($nextDueDate, $document->frequency);
                    $document->schedules()->create([
                        'due_date' => $nextDueDate,
                        'status' => 'pending',
                    ]);
                }

                // Recalculate progress (completed / total * 100)
                $completedCount = $document->schedules()->where('status', 'completed')->count();
                $totalCount = $document->schedules()->count();
                $progress = round(($completedCount / $totalCount) * 100);

                // Update document status automatically
                $newStatus = $document->status;
                if ($progress >= 100) {
                    $newStatus = 'Done';
                } elseif ($document->status === 'To Do' && $completedCount > 0) {
                    $newStatus = 'In Progress';
                }
                $document->update(['progress' => $progress, 'status' => $newStatus]);

                // Find next pending due date for display
                $nextPending = $document->schedules()
                    ->where('status', 'pending')
                    ->orderBy('due_date')
                    ->first();
                $nextDueDateFormatted = $nextPending ? $nextPending->due_date->format('M d, Y') : null;

                return response()->json([
                    'success' => true,
                    'message' => $progress >= 100 ? 'All periods completed! Document marked as Done.' : 'Period completed. Next due date set.',
                    'next_due_date' => $nextDueDateFormatted,
                    'progress' => $progress,
                    'new_status' => $newStatus,
                ]);

            default:
                return response()->json(['success' => false, 'message' => 'Invalid frequency.'], 400);
        }
    }

    private function deadlineCountError(string $frequency, array $deadlines): ?string
    {
        $expectedCount = match ($frequency) {
            'weekly' => 52,
            'bi-monthly' => 24,
            'monthly' => 12,
            'quarterly' => 4,
            'semestral' => 2,
            'annual' => 1,
            'as-needed' => 1,
            default => null,
        };

        if ($expectedCount === null || count($deadlines) <= $expectedCount) {
            return null;
        }

        return ucfirst($frequency).' documents allow up to '.$expectedCount.' reporting deadlines.';
    }

    private function advanceDueDate(Carbon $date, string $frequency): Carbon
    {
        return match ($frequency) {
            'weekly' => $date->addWeek(),
            'bi-monthly' => $date->addDays(15),
            'monthly' => $date->addMonth(),
            'quarterly' => $date->addMonths(3),
            'semestral' => $date->addMonths(6),
            default => $date,
        };
    }

    /**
     * @param  array<int, string>  $whoWillComply
     */
    private function validateWhoWillComplyOther(array $whoWillComply, ?string $whoWillComplyOther): void
    {
        if (in_array('Others', $whoWillComply, true) && blank($whoWillComplyOther)) {
            throw ValidationException::withMessages([
                'who_will_comply_other' => 'Please specify who will comply.',
            ]);
        }
    }

    /**
     * Create notification for new focal person assignment
     */
    private function createFocalPersonNotification(Document $document, string $oldFocalPerson, string $newFocalPerson): void
    {
        // Find the user who is now the focal person
        // Search by combined first_name and last_name
        $newFocalUser = \App\Models\User::whereRaw("CONCAT(TRIM(first_name), ' ', TRIM(last_name)) = ?", [$newFocalPerson])->first();

        if (! $newFocalUser) {
            return; // User not found, skip notification
        }

        // Send notification using Laravel's notification system
        $newFocalUser->notify(
            new FocalPersonAssigned(
                $document,
                Auth::user()->name,
                $oldFocalPerson
            )
        );
    }

    /**
     * Check if a date is a holiday
     */
    public function checkHoliday(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date');

        try {
            $isHoliday = \App\Helpers\BusinessDayHelper::isHoliday($date);
            $isWeekend = \App\Helpers\BusinessDayHelper::isWeekend($date);
            $isBusinessDay = \App\Helpers\BusinessDayHelper::isBusinessDay($date);
            $nextBusinessDay = \App\Helpers\BusinessDayHelper::getNextBusinessDay($date);

            return response()->json([
                'date' => $date,
                'is_holiday' => $isHoliday,
                'is_weekend' => $isWeekend,
                'isBusinessDay' => $isBusinessDay,
                'next_business_day' => $nextBusinessDay->format('Y-m-d'),
                'needs_adjustment' => ! $isBusinessDay,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }
    }

    /**
     * Helper method to check if a date is a holiday
     */
    private function isHolidayDate($date)
    {
        $monthDay = $date->format('m-d');
        $holidays = [
            '01-01' => 'New Year\'s Day',
            '04-09' => 'Day of Valor',
            '05-01' => 'Labor Day',
            '06-12' => 'Independence Day',
            '08-26' => 'National Heroes Day', // From guide
            '11-30' => 'Bonifacio Day',
            '12-25' => 'Christmas Day',
            '12-30' => 'Rizal Day',
        ];

        $currentYear = $date->year;
        $moveableHolidays = [
            $currentYear.'-03-28' => 'Maundy Thursday', // From guide
            $currentYear.'-03-29' => 'Good Friday', // From guide
        ];

        $dateStr = $date->format('Y-m-d');

        return isset($holidays[$monthDay]) || isset($moveableHolidays[$dateStr]);
    }

    public function download($filename)
    {
        $decodedFilename = base64_decode($filename);
        $filePath = $decodedFilename;

        if (! str_starts_with($filePath, 'documents/')) {
            $filePath = 'documents/'.$filePath;
        }

        if (str_contains($filePath, '..')) {
            abort(404, 'File not found');
        }

        if (! Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($filePath, basename($filePath));
    }
}
