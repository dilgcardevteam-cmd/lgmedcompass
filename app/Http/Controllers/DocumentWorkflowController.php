<?php

namespace App\Http\Controllers;

use App\Models\DocumentProcess;
use App\Models\Section;
use App\Models\User;
use App\Notifications\DocumentAssignedNotification;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentWorkflowController extends Controller
{
    private function storeUploadedFile(UploadedFile $file, ?int $sectionId = null): string
    {
        $folder = 'document_processes';

        if ($sectionId) {
            $sectionName = Section::find($sectionId)?->name;
            if ($sectionName) {
                $folder .= '/'.Str::slug($sectionName);
            }
        }

        $originalName = $file->getClientOriginalName();
        $filename = preg_replace('/[<>:"\/\\|?*\x00-\x1F]/u', '_', $originalName);
        $filename = trim($filename) ?: 'document.'.$file->getClientOriginalExtension();

        if (! str_contains($filename, '.')) {
            $filename .= '.'.$file->getClientOriginalExtension();
        }

        $path = "{$folder}/{$filename}";
        $counter = 1;
        $baseName = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        while (Storage::disk('public')->exists($path)) {
            $path = "{$folder}/{$baseName}-{$counter}.{$extension}";
            $counter++;
        }

        $file->storeAs($folder, basename($path), 'public');

        return $path;
    }

    public function index(Request $request)
    {
        return redirect()->route('documents.my-tasks');
    }

    public function quickStore(Request $request)
    {

        $request->validate([
            'subject_title' => 'required|string|max:255',
            'focal_person' => 'required|string|max:255',
            'type_of_paper' => 'required|string|max:255',
            'type_of_paper_other' => 'required_if:type_of_paper,Others|nullable|string|max:255',
            'documents.*' => 'nullable|file|mimes:pdf|max:5120',
            'document_link' => 'nullable|url',
            'remarks' => 'nullable|string',
        ]);

        $filePaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filePaths[] = $this->storeUploadedFile($file, $request->section);
            }
        }

        $documentProcess = DocumentProcess::create([
            'user_id' => auth()->id(),
            'subject_title' => $request->subject_title,
            'focal_person' => $request->focal_person,
            'type_of_paper' => $request->type_of_paper,
            'type_of_paper_other' => $request->type_of_paper === 'Others'
                ? $request->type_of_paper_other
                : null,
            'section' => $request->section,
            'document_link' => $request->document_link,
            'remarks' => $request->remarks,
            'file_path' => $filePaths,
            'assigned_to_id' => auth()->id(),
            'status' => 'Draft',
            'last_comment' => null,
        ]);

        return redirect()->route('documents.my-tasks')
            ->with('success', 'Document uploaded.')
            ->with('skip_loader', true);
    }

    public function update(Request $request, DocumentProcess $documentProcess)
    {
        if ($documentProcess->assigned_to_id != auth()->id()) {
            return back()->with('error', 'You are not authorized to edit this document.');
        }

        $request->validate([
            'subject_title' => 'sometimes|string|max:255',
            'focal_person' => 'sometimes|string|max:255',
            'document_link' => 'nullable|url',
            'remarks' => 'nullable|string',
            'documents.*' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->has('subject_title')) {
            $documentProcess->subject_title = $request->subject_title;
        }
        if ($request->has('focal_person')) {
            $documentProcess->focal_person = $request->focal_person;
        }
        if ($request->has('document_link')) {
            $documentProcess->document_link = $request->document_link;
        }
        if ($request->has('remarks')) {
            $documentProcess->remarks = $request->remarks;
        }

        if ($request->hasFile('documents')) {
            $filePaths = [];
            foreach ($request->file('documents') as $file) {
                $filePaths[] = $this->storeUploadedFile($file, $documentProcess->section);
            }
            $documentProcess->file_path = $filePaths;
        }

        $documentProcess->save();

        return redirect()->route('documents.my-tasks')
            ->with('success', 'Document updated.')
            ->with('skip_loader', true);
    }

    public function destroy(Request $request, $id)
    {
        // Find the document (with trashed if needed – but for deletion we want active only)
        $documentProcess = DocumentProcess::findOrFail($id);

        // Authorization: only the uploader can delete
        if ($documentProcess->user_id !== auth()->id()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'You are not authorized to delete this document.'], 403);
            }
            abort(403);
        }

        // Delete stored files
        if ($documentProcess->file_path) {
            $files = is_array($documentProcess->file_path)
                ? $documentProcess->file_path
                : json_decode($documentProcess->file_path, true);
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        // Delete the record (this will soft‑delete if your model uses SoftDeletes)
        $documentProcess->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
        }

        return redirect()->route('documents.my-tasks')
            ->with('success', 'Document deleted successfully.');
    }

    public function myTasks(Request $request)
    {
        $sections = Section::all();
        $user = Auth::user();

        // Build base queries
        $assignedQuery = DocumentProcess::with('section')
            ->where('assigned_to_id', $user->id)
            ->where('user_id', '!=', $user->id);

        $uploadedQuery = DocumentProcess::with('section')
            ->where('user_id', $user->id);

        // Apply filters
        if ($request->filled('type')) {
            $assignedQuery->where('type_of_paper', $request->type);
            $uploadedQuery->where('type_of_paper', $request->type);
        }

        if ($request->filled('section')) {
            $assignedQuery->where('section', $request->section);
            $uploadedQuery->where('section', $request->section);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $assignedQuery->where(function ($q) use ($searchTerm) {
                $q->where('subject_title', 'like', "%{$searchTerm}%")
                    ->orWhere('focal_person', 'like', "%{$searchTerm}%");
            });
            $uploadedQuery->where(function ($q) use ($searchTerm) {
                $q->where('subject_title', 'like', "%{$searchTerm}%")
                    ->orWhere('focal_person', 'like', "%{$searchTerm}%");
            });
        }

        $assignedDocuments = $assignedQuery->orderBy('updated_at', 'desc')
            ->paginate(4, ['*'], 'assigned_page');

        $uploadedDocuments = $uploadedQuery->orderBy('updated_at', 'desc')
            ->paginate(4, ['*'], 'uploaded_page');

        $users = User::where('id', '!=', $user->id)->orderBy('first_name')->orderBy('last_name')->get();

        $actions = [
            'Draft' => [
                'send' => ['label' => 'Send for Review', 'needs_assignee' => true],
            ],
            'Pending Review' => [
                'approve' => ['label' => 'Approve', 'needs_assignee' => true],
                'revise' => ['label' => 'Revise', 'needs_assignee' => false],
            ],
            'Revision Required' => [
                'send' => ['label' => 'Resend for Review', 'needs_assignee' => true],
            ],
            'Ready for Printing' => [
                'complete' => ['label' => 'Done', 'needs_assignee' => false],
            ],
        ];

        if (in_array($user->section_id, [1, 2])) {
            $actions['Pending Review'] = [
                'ready_for_printing' => ['label' => 'Ready for Printing', 'needs_assignee' => false],
                'revise' => ['label' => 'Revise', 'needs_assignee' => false],
            ];
            $actions['Approved by Reviewer'] = [
                'approve' => ['label' => 'Ready to print', 'needs_assignee' => false],
                'revise' => ['label' => 'Revise', 'needs_assignee' => false],
            ];
        } else {
            $actions['Approved by Reviewer'] = [];
        }

        return view('my-tasks', compact(
            'assignedDocuments',
            'uploadedDocuments',
            'users',
            'actions',
            'sections'
        ));
    }

    public function workflowAction(Request $request, DocumentProcess $documentProcess)
    {

        $request->validate([
            'action' => 'required|in:send,approve,revise,complete,ready_for_printing',
            'comment' => 'nullable|string|max:1000',
            'assign_to' => 'required_if:action,send,approve|exists:users,id',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'attachment_link' => 'nullable|url',
        ]);

        $user = Auth::user();

        // 1. Basic authorization: user must be either the creator or the current assignee
        if ($documentProcess->assigned_to_id != $user->id && $documentProcess->user_id != $user->id) {
            return back()->with('error', 'You are not authorized to act on this document.');
        }

        // 2. Section restrictions only for specific actions, not all actions
        if (in_array($request->action, ['ready_for_printing'])) {
            if (! in_array($user->section_id, [1, 2])) {
                return back()->with('error', 'Only sections 5 or 6 can perform this action.');
            }
        }

        // 3. Additional action-specific restrictions
        if ($request->action === 'approve' && $documentProcess->status === 'Approved by Reviewer') {
            if (! in_array($user->section_id, [1, 2])) {
                return back()->with('error', 'Only sections 5 or 6 can perform this action.');
            }
        }

        if ($request->action === 'ready_for_printing') {
            // Allow sections 1 and 2 to use ready_for_printing from Pending Review status
            if (! in_array($user->section_id, [1, 2]) && $documentProcess->status !== 'Approved by Reviewer') {
                return back()->with('error', 'This action is only allowed on documents under Approved by Reviewer.');
            }
        }

        $oldStatus = $documentProcess->status;
        $newStatus = $oldStatus;
        $newAssigneeId = $documentProcess->assigned_to_id;

        DB::beginTransaction();

        try {
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $path = $this->storeUploadedFile($file, $documentProcess->section);
                $documentProcess->file_path = [$path];
            }

            if ($request->filled('attachment_link')) {
                $documentProcess->document_link = $request->attachment_link;
            }

            switch ($request->action) {
                case 'send':
                    $newStatus = 'Pending Review';
                    $newAssigneeId = $request->assign_to;
                    break;

                case 'approve':
                    if ($oldStatus === 'Pending Review') {
                        $newStatus = 'Approved by Reviewer';
                        $newAssigneeId = $request->assign_to;
                    } elseif ($oldStatus === 'Approved by Reviewer') {
                        $newStatus = 'Ready for Printing';
                        $newAssigneeId = $request->assign_to;
                    }
                    break;

                case 'ready_for_printing':
                    $newStatus = 'Ready for Printing';
                    // Optionally assign back to the original uploader
                    $newAssigneeId = $documentProcess->user_id;
                    break;

                case 'revise':
                    $newStatus = 'Revision Required';
                    $newAssigneeId = $documentProcess->user_id;
                    break;

                case 'complete':
                    $newStatus = 'Complete';
                    $newAssigneeId = null;
                    break;
            }

            $documentProcess->status = $newStatus;
            $documentProcess->assigned_to_id = $newAssigneeId;

            if ($request->filled('comment')) {
                $documentProcess->last_comment = $request->comment;
            }

            $documentProcess->save();

            if ($newAssigneeId) {
                $nextUser = User::find($newAssigneeId);
                if ($nextUser) {
                    $message = match ($newStatus) {
                        'Pending Review' => 'A document has been assigned to you for review.',
                        'Approved by Reviewer' => 'Your document has been approved and is ready for printing.',
                        'Ready for Printing' => 'A document is ready for printing.',
                        'Revision Required' => 'A document has been returned to you for revision.',
                        default => 'A new document has been assigned to you.',
                    };
                    $nextUser->notify(new DocumentAssignedNotification($documentProcess, $message));
                }
            }

            // Auto-archive when status becomes Complete
            if ($newStatus === 'Complete') {
                DB::table('notifications')
                    ->whereJsonContains('data->document_id', $documentProcess->id)
                    ->update(['read_at' => now()]);
                $documentProcess->delete();
            }

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Action completed.']);
            }

            return redirect()
                ->route('documents.my-tasks')
                ->with('success', 'Action completed.');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong: '.$e->getMessage()], 500);
            }

            return back()->with('error', 'Something went wrong: '.$e->getMessage())
                ->with('skip_loader', true);
        }
    }

    public function archivePage(Request $request)
    {
        $sections = Section::all();
        $query = DocumentProcess::onlyTrashed();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('subject_title', 'like', "%{$search}%")
                    ->orWhere('focal_person', 'like', "%{$search}%");
            });
        }

        if ($request->filled('focal')) {
            $query->where('focal_person', $request->focal);
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        if ($request->filled('type')) {
            $query->where('type_of_paper', $request->type);
        }

        $archivedDocuments = $query
            ->orderBy('deleted_at', 'desc');

        if ($request->boolean('show_all')) {
            $archivedDocuments = $archivedDocuments->get();
        } else {
            $archivedDocuments = $archivedDocuments
                ->paginate(6)
                ->withQueryString();
        }

        return view('archive-documents', compact('archivedDocuments', 'sections'));
    }

    public function restore($id)
    {
        $document = DocumentProcess::withTrashed()->findOrFail($id);
        $document->restore();

        if ($document->status === 'Complete') {
            $document->status = 'Ready for Printing';
            $document->save();
        }

        return redirect()->route('documents.my-tasks')
            ->with('success', 'Document restored successfully.');
    }

    public function forceDelete(Request $request, $id)
    {
        $document = DocumentProcess::withTrashed()->findOrFail($id);
        $user = Auth::user();

        // Authorization: user must be owner OR belong to section 5 or 6
        if ($user->id !== 1 && ! in_array($user->section_id, [1, 2]) && $user->id !== $document->user_id) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'You are not authorized to permanently delete this document.'], 403);
            }

            return back()->with('error', 'You are not authorized to permanently delete this document.');
        }

        $document->forceDelete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Document permanently deleted.']);
        }

        return redirect()->route('documents.archivePage')
            ->with('success', 'Document permanently deleted.')
            ->with('skip_loader', true);
    }

    public function markDelete($id)
    {
        $doc = DocumentProcess::withTrashed()->findOrFail($id);
        $doc->delete_scheduled_at = now()->addYears(3);
        $doc->save();

        return back()->with('success', 'Document will be deleted after 3 years.');
    }

    public function clearNotifications(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notifications cleared.');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->first();

        if (! $notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function checkUpdates()
    {
        $userId = auth()->id();

        $latest = DocumentProcess::query()
            ->where(function ($query) use ($userId) {
                $query->where('assigned_to_id', $userId)
                    ->orWhere('user_id', $userId);
            })
            ->latest('updated_at')
            ->value('updated_at');

        return response()->json([
            'latest' => $latest ? strtotime($latest) : null,
        ]);
    }

    public function assignedCount()
    {
        try {
            $count = DocumentProcess::where('assigned_to_id', auth()->id())->count();

            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            \Log::error('assignedCount error: '.$e->getMessage());

            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function downloadFile($path)
    {
        try {
            $decodedPath = urldecode($path);

            // Security check
            if (Str::contains($decodedPath, '..')) {
                abort(404);
            }

            $fullPath = storage_path('app/public/'.$decodedPath);

            \Log::info('Download attempt: '.$fullPath);
            \Log::info('File exists: '.(file_exists($fullPath) ? 'YES' : 'NO'));

            if (! file_exists($fullPath)) {
                abort(404, 'File not found: '.basename($decodedPath));
            }

            return response()->download($fullPath, basename($decodedPath));

        } catch (\Exception $e) {
            \Log::error('Download error: '.$e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
