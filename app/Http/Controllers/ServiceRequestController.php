<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Section;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestDeliverable;
use App\Models\User;
use App\Notifications\ServiceRequestReceived;
use App\Notifications\ServiceRequestWorkflowUpdate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class ServiceRequestController extends Controller
{
    private const DSU_SECTION_NAME = 'Database and Statistical Unit';

    public function index(HttpRequest $request): View
    {
        $user = auth()->user();
        $isDsuStaff = $this->isDsuStaff($user);
        $isAdmin = $this->isEligibleStaff($user) && $user->isAdmin();
        $canReviewRequests = $this->isEligibleStaff($user)
            && ($user->section_id !== null || $isAdmin);
        $canReceiveRequests = $isDsuStaff || $isAdmin;
        $canSubmitRequests = $user !== null && ! $isDsuStaff;
        $canArchiveRequesterRequests = $canSubmitRequests && ! $isAdmin;
        $defaultTab = $canReceiveRequests ? 'incoming' : 'my-active';
        $availableTabs = $canSubmitRequests ? ['my-active'] : [];
        if ($canArchiveRequesterRequests) {
            $availableTabs[] = 'my-finished';
        }
        if ($canReceiveRequests) {
            $availableTabs[] = 'incoming';
        }
        if ($canReviewRequests) {
            $availableTabs[] = 'claimed';
        }
        if ($canReviewRequests || $canSubmitRequests) {
            $availableTabs[] = 'archive';
        }
        $tab = $request->query('tab', $defaultTab);
        if ($tab === 'my-requests') {
            $tab = 'my-active';
        }
        if (! in_array($tab, $availableTabs, true)) {
            $tab = $defaultTab;
        }

        $requestCounts = [
            'my-active' => 0,
            'my-finished' => 0,
            'incoming' => 0,
            'claimed' => 0,
            'archive' => 0,
        ];
        $activeRequests = collect();
        $finishedRequests = collect();
        if ($user !== null && $canSubmitRequests) {
            $activeQuery = ServiceRequest::query()
                ->where('requester_user_id', $user->id)
                ->whereIn('status', ServiceRequest::OPEN_STATUSES)
                ->with(['assignedTo', 'deliverables'])
                ->latest('requested_at');
            $requestCounts['my-active'] = (clone $activeQuery)->count();
            $this->applyFilters($activeQuery, $request);
            $activeRequests = $activeQuery->paginate(8, ['*'], 'active_page')->withQueryString();

            if ($canArchiveRequesterRequests) {
                $finishedQuery = ServiceRequest::query()
                    ->where('requester_user_id', $user->id)
                    ->whereIn('status', ServiceRequest::CLOSED_STATUSES)
                    ->whereNull('requester_archived_at')
                    ->with(['assignedTo', 'deliverables'])
                    ->latest('updated_at');
                $requestCounts['my-finished'] = (clone $finishedQuery)->count();
                $this->applyFilters($finishedQuery, $request);
                $finishedRequests = $finishedQuery->paginate(8, ['*'], 'finished_page')->withQueryString();
            }
        }

        $incomingRequests = collect();
        $claimedRequests = collect();
        $archivedRequests = collect();

        if ($canReceiveRequests) {
            $teamRequests = $this->teamRequestsQuery($user, $isAdmin);
            $incomingQuery = (clone $teamRequests)
                ->whereIn('status', ServiceRequest::OPEN_STATUSES)
                ->whereNull('assigned_to_id')
                ->where(function (Builder $query) use ($user): void {
                    $query->whereNull('requester_user_id')
                        ->orWhere('requester_user_id', '<>', $user->id);
                })
                ->with(['requester', 'assignedTo', 'deliverables'])
                ->latest('requested_at');
            $requestCounts['incoming'] = (clone $incomingQuery)->count();
            $this->applyFilters($incomingQuery, $request);
            $incomingRequests = $incomingQuery->paginate(8, ['*'], 'incoming_page')->withQueryString();
        }

        if ($canReviewRequests) {
            $teamRequests = $this->teamRequestsQuery($user, $isAdmin);
            $claimedQuery = (clone $teamRequests)
                ->where('assigned_to_id', $user->id)
                ->whereIn('status', ServiceRequest::OPEN_STATUSES)
                ->with(['requester', 'assignedTo', 'deliverables'])
                ->latest('updated_at');
            $requestCounts['claimed'] = (clone $claimedQuery)->count();
            $this->applyFilters($claimedQuery, $request);
            $claimedRequests = $claimedQuery->paginate(8, ['*'], 'claimed_page')->withQueryString();
        }

        if ($canReviewRequests || $canSubmitRequests) {
            $archiveQuery = $this->archivedRequestsQuery($user, $canReviewRequests, $isAdmin)
                ->with(['requester', 'assignedTo', 'deliverables'])
                ->latest('updated_at');
            $requestCounts['archive'] = (clone $archiveQuery)->count();
            $this->applyFilters($archiveQuery, $request);
            $archivedRequests = $archiveQuery->paginate(8, ['*'], 'archive_page')->withQueryString();
        }

        $statuses = [
            ServiceRequest::STATUS_RECEIVED,
            ServiceRequest::STATUS_UNDER_REVIEW,
            ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
            ServiceRequest::STATUS_COMPLETED,
            ServiceRequest::STATUS_DECLINED,
        ];
        $requestUpdateSnapshot = $user === null
            ? []
            : $this->requestUpdateSnapshot($user, $canReceiveRequests, $canReviewRequests, $isAdmin);

        return view('request.index', compact(
            'activeRequests',
            'finishedRequests',
            'incomingRequests',
            'claimedRequests',
            'archivedRequests',
            'requestCounts',
            'statuses',
            'tab',
            'isDsuStaff',
            'isAdmin',
            'canReviewRequests',
            'canReceiveRequests',
            'canSubmitRequests',
            'canArchiveRequesterRequests',
            'requestUpdateSnapshot'
        ));
    }

    public function checkUpdates(HttpRequest $request): JsonResponse
    {
        $user = $request->user();
        abort_unless($user !== null, 401);

        $isAdmin = $this->isEligibleStaff($user) && $user->isAdmin();
        $canReviewRequests = $this->isEligibleStaff($user)
            && ($user->section_id !== null || $isAdmin);
        $canReceiveRequests = $this->isDsuStaff($user) || $isAdmin;

        return response()->json([
            'snapshot' => $this->requestUpdateSnapshot(
                $user,
                $canReceiveRequests,
                $canReviewRequests,
                $isAdmin
            ),
        ]);
    }

    public function archiveForRequester(HttpRequest $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $user = $request->user();
        $isAdmin = $this->isEligibleStaff($user) && $user->isAdmin();

        abort_unless($user !== null && ! $this->isDsuStaff($user) && ! $isAdmin, 403);
        abort_unless((int) $serviceRequest->requester_user_id === (int) $user->id, 403);
        abort_unless(in_array($serviceRequest->status, ServiceRequest::CLOSED_STATUSES, true), 409);

        if ($serviceRequest->requester_archived_at === null) {
            $serviceRequest->forceFill(['requester_archived_at' => now()])->save();
        }

        return redirect()
            ->route('request.index', ['tab' => 'archive'])
            ->with('success', 'Finished request moved to your archive.');
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        $attachmentPath = null;
        $attachmentName = null;
        $targetSectionId = null;

        if ($validated['service_type'] === ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS) {
            $targetSectionId = Section::query()
                ->where('name', self::DSU_SECTION_NAME)
                ->value('id');

            abort_if($targetSectionId === null, 503, 'The Database and Statistical Unit is not configured to receive requests.');
        }

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $attachmentPath = $attachment->store('service-requests', 'local');
            $attachmentName = $attachment->getClientOriginalName();

            if (! is_string($attachmentPath)) {
                throw new RuntimeException('The supporting document could not be stored.');
            }
        }

        $trackingToken = Str::random(64);

        try {
            $serviceRequest = DB::transaction(function () use ($validated, $user, $attachmentPath, $attachmentName, $targetSectionId, $trackingToken): ServiceRequest {
                $serviceRequest = ServiceRequest::query()->create([
                    'requester_user_id' => $user?->id,
                    'requester_name' => $user?->name ?? $validated['requester_name'],
                    'office_address' => $validated['office_address'],
                    'contact_number' => $validated['contact_number'],
                    'email' => $user?->email ?? $validated['email'],
                    'service_type' => $validated['service_type'],
                    'analysis_types' => $validated['service_type'] === ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS
                        ? $validated['analysis_types']
                        : null,
                    'other_service_type' => $validated['service_type'] === ServiceRequest::SERVICE_TYPE_OTHERS
                        ? $validated['other_service_type']
                        : null,
                    'target_section_id' => $targetSectionId,
                    'assigned_to_id' => null,
                    'subject' => $validated['subject'],
                    'description' => $validated['description'],
                    'requested_at' => now(),
                    'date_needed' => $validated['date_needed'],
                    'document_link' => $validated['document_link'] ?? null,
                    'attachment_path' => $attachmentPath,
                    'attachment_name' => $attachmentName,
                    'status' => ServiceRequest::STATUS_RECEIVED,
                    'tracking_token' => $trackingToken,
                    'tracking_token_hash' => hash('sha256', $trackingToken),
                ]);

                $this->notifyReceivingStaff($serviceRequest);

                return $serviceRequest;
            });
        } catch (Throwable $exception) {
            if ($attachmentPath !== null) {
                Storage::disk('local')->delete($attachmentPath);
            }

            throw $exception;
        }

        $reference = 'REQ-'.now()->format('Y').'-'.str_pad((string) $serviceRequest->id, 6, '0', STR_PAD_LEFT);
        if ($user === null) {
            Notification::route('mail', $serviceRequest->email)->notify(new ServiceRequestWorkflowUpdate(
                $serviceRequest,
                'Your LGMED request was received',
                "Your request {$reference} has been received. Use the private link to track it and respond if more information is requested."
            ));
        }

        return redirect()
            ->route('request.index')
            ->with('success', 'Your request has been submitted successfully.')
            ->with('request_reference', $reference);
    }

    public function track(string $token): View
    {
        $serviceRequest = ServiceRequest::query()
            ->where('tracking_token_hash', hash('sha256', $token))
            ->firstOrFail();

        return view('request.track', compact('serviceRequest', 'token'));
    }

    public function respondToRequest(HttpRequest $request, string $token): RedirectResponse
    {
        $validated = $request->validate([
            'response' => ['required', 'string', 'max:10000'],
        ]);
        $serviceRequest = ServiceRequest::query()
            ->where('tracking_token_hash', hash('sha256', $token))
            ->firstOrFail();

        abort_unless($serviceRequest->status === ServiceRequest::STATUS_MORE_INFORMATION_NEEDED, 409);

        $serviceRequest->forceFill([
            'status' => ServiceRequest::STATUS_UNDER_REVIEW,
            'last_comment' => $validated['response'],
        ])->save();

        $serviceRequest->assignedTo?->notify(new ServiceRequestWorkflowUpdate(
            $serviceRequest,
            'Requester responded to a service request',
            "The requester has provided additional information for: {$serviceRequest->subject}",
            'claimed'
        ));

        return redirect()
            ->route('request.track', $token)
            ->with('success', 'Your response has been sent to the assigned staff member.');
    }

    public function downloadDeliverable(ServiceRequest $serviceRequest, ServiceRequestDeliverable $deliverable): StreamedResponse
    {
        $user = auth()->user();
        $isRequester = (int) $serviceRequest->requester_user_id === (int) $user?->id;

        abort_unless($isRequester || $this->canReview($user, $serviceRequest), 403);

        return $this->streamDeliverable($serviceRequest, $deliverable);
    }

    public function downloadTrackedDeliverable(string $token, ServiceRequestDeliverable $deliverable): StreamedResponse
    {
        $serviceRequest = ServiceRequest::query()
            ->where('tracking_token_hash', hash('sha256', $token))
            ->firstOrFail();

        return $this->streamDeliverable($serviceRequest, $deliverable);
    }

    public function claim(HttpRequest $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $user = $request->user();
        abort_unless($this->canReview($user, $serviceRequest), 403);
        abort_if($serviceRequest->requester_user_id === $user->id, 403, 'You cannot claim your own request.');

        $claimed = ServiceRequest::query()
            ->whereKey($serviceRequest->id)
            ->where('status', ServiceRequest::STATUS_RECEIVED)
            ->whereNull('assigned_to_id')
            ->update([
                'status' => ServiceRequest::STATUS_UNDER_REVIEW,
                'assigned_to_id' => $user->id,
                'claimed_at' => now(),
                'updated_at' => now(),
            ]);

        if ($claimed !== 1) {
            return back()->with('error', 'This request has already been claimed or is no longer available.');
        }

        $serviceRequest->refresh();
        $this->notifyRequester(
            $serviceRequest,
            'Your request is under review',
            "A staff member has claimed your request: {$serviceRequest->subject}"
        );

        return back()->with('success', 'Request claimed and added to your tasks.');
    }

    public function updateStatus(HttpRequest $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([
                ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
                ServiceRequest::STATUS_COMPLETED,
                ServiceRequest::STATUS_DECLINED,
            ])],
            'comment' => [
                Rule::requiredIf(in_array($request->input('status'), [
                    ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
                    ServiceRequest::STATUS_DECLINED,
                ], true)),
                'nullable',
                'string',
                'max:5000',
            ],
            'completion_link' => [
                Rule::prohibitedIf($request->input('status') !== ServiceRequest::STATUS_COMPLETED),
                'nullable',
                'url:http,https',
                'max:2048',
            ],
            'completion_files' => [
                Rule::prohibitedIf($request->input('status') !== ServiceRequest::STATUS_COMPLETED),
                'nullable',
                'array',
                'max:5',
            ],
            'completion_files.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,csv,ppt,pptx,txt', 'max:10240'],
        ]);
        $user = $request->user();

        abort_unless($this->canReview($user, $serviceRequest), 403);
        abort_unless((int) $serviceRequest->assigned_to_id === (int) $user->id, 403);
        abort_unless(in_array($serviceRequest->status, [
            ServiceRequest::STATUS_UNDER_REVIEW,
            ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
        ], true), 409);

        $storedFiles = [];
        try {
            foreach ($validated['completion_files'] ?? [] as $file) {
                $path = $file->store('service-request-deliverables', 'local');
                if (! is_string($path)) {
                    throw new RuntimeException('A completed request file could not be stored.');
                }

                $storedFiles[] = [
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ];
            }

            DB::transaction(function () use ($validated, $serviceRequest, $storedFiles): void {
                $serviceRequest->forceFill([
                    'status' => $validated['status'],
                    'last_comment' => $validated['comment'] ?? null,
                    'deliverable_link' => $validated['completion_link'] ?? null,
                ])->save();

                foreach ($storedFiles as $storedFile) {
                    $serviceRequest->deliverables()->create($storedFile);
                }

                $message = match ($serviceRequest->status) {
                    ServiceRequest::STATUS_MORE_INFORMATION_NEEDED => "More information is needed for your request: {$serviceRequest->subject}",
                    ServiceRequest::STATUS_COMPLETED => "Your request has been completed: {$serviceRequest->subject}",
                    ServiceRequest::STATUS_DECLINED => "Your request was declined: {$serviceRequest->subject}",
                };
                if ($serviceRequest->status === ServiceRequest::STATUS_COMPLETED) {
                    if ($serviceRequest->deliverable_link !== null || $storedFiles !== []) {
                        $message .= ' You can access your completed files and link from the private tracking page.';
                    }
                }

                $this->notifyRequester($serviceRequest, 'Request status updated', $message);
            });
        } catch (Throwable $exception) {
            Storage::disk('local')->delete(array_column($storedFiles, 'file_path'));

            throw $exception;
        }

        return back()->with('success', 'Request status updated and the requester has been notified.');
    }

    private function notifyReceivingStaff(ServiceRequest $serviceRequest): void
    {
        $staff = $this->reviewersFor($serviceRequest)
            ->when(
                $serviceRequest->requester_user_id !== null,
                fn (Builder $query) => $query->where('id', '<>', $serviceRequest->requester_user_id)
            )
            ->get();

        Notification::send($staff, new ServiceRequestReceived($serviceRequest));
    }

    private function notifyRequester(ServiceRequest $serviceRequest, string $title, string $message): void
    {
        $notification = new ServiceRequestWorkflowUpdate($serviceRequest, $title, $message);

        if ($serviceRequest->requester !== null) {
            $serviceRequest->requester->notify($notification);

            return;
        }

        Notification::route('mail', $serviceRequest->email)->notify($notification);
    }

    private function teamRequestsQuery(User $user, bool $isAdmin): Builder
    {
        return ServiceRequest::query()
            ->where(function (Builder $query) use ($user, $isAdmin): void {
                if ($user->section_id !== null) {
                    $query->where('target_section_id', $user->section_id);
                }

                if ($isAdmin) {
                    $query->orWhere(function (Builder $adminQuery): void {
                        $adminQuery
                            ->where('service_type', ServiceRequest::SERVICE_TYPE_OTHERS)
                            ->whereNull('target_section_id');
                    });
                }
            });
    }

    private function archivedRequestsQuery(User $user, bool $canReviewRequests, bool $isAdmin): Builder
    {
        return ServiceRequest::query()->where(function (Builder $query) use ($user, $canReviewRequests, $isAdmin): void {
            $hasRequesterArchiveScope = false;

            if ($isAdmin) {
                $query->where('requester_user_id', $user->id)
                    ->whereIn('status', ServiceRequest::CLOSED_STATUSES);
                $hasRequesterArchiveScope = true;
            } elseif (! $this->isDsuStaff($user)) {
                $query->where('requester_user_id', $user->id)
                    ->whereIn('status', ServiceRequest::CLOSED_STATUSES)
                    ->whereNotNull('requester_archived_at');
                $hasRequesterArchiveScope = true;
            }

            if ($canReviewRequests) {
                $teamArchiveIds = $this->teamRequestsQuery($user, $isAdmin)
                    ->whereIn('status', ServiceRequest::CLOSED_STATUSES)
                    ->select('service_requests.id');

                if ($hasRequesterArchiveScope) {
                    $query->orWhereIn('service_requests.id', $teamArchiveIds);
                } else {
                    $query->whereIn('service_requests.id', $teamArchiveIds);
                }
            }
        });
    }

    /**
     * @return array<string, array<string, array{count: int, latest: ?string}>>
     */
    private function requestUpdateSnapshot(
        User $user,
        bool $canReceiveRequests,
        bool $canReviewRequests,
        bool $isAdmin
    ): array {
        $snapshot = [];

        $isDsuStaff = $this->isDsuStaff($user);

        if (! $isDsuStaff) {
            $snapshot['my-active'] = $this->requestStatusSnapshot(
                ServiceRequest::query()
                    ->where('requester_user_id', $user->id)
                    ->whereIn('status', ServiceRequest::OPEN_STATUSES)
            );

            if (! $isAdmin) {
                $snapshot['my-finished'] = $this->requestStatusSnapshot(
                    ServiceRequest::query()
                        ->where('requester_user_id', $user->id)
                        ->whereIn('status', ServiceRequest::CLOSED_STATUSES)
                        ->whereNull('requester_archived_at')
                );
            }
        }

        if ($canReceiveRequests) {
            $incomingQuery = $this->teamRequestsQuery($user, $isAdmin)
                ->whereIn('status', ServiceRequest::OPEN_STATUSES)
                ->whereNull('assigned_to_id')
                ->where(function (Builder $query) use ($user): void {
                    $query->whereNull('requester_user_id')
                        ->orWhere('requester_user_id', '<>', $user->id);
                });
            $snapshot['incoming'] = $this->requestStatusSnapshot($incomingQuery);
        }

        if ($canReviewRequests) {
            $teamRequests = $this->teamRequestsQuery($user, $isAdmin);
            $snapshot['claimed'] = $this->requestStatusSnapshot(
                (clone $teamRequests)
                    ->where('assigned_to_id', $user->id)
                    ->whereIn('status', ServiceRequest::OPEN_STATUSES)
            );
        }

        if ($canReviewRequests || ! $isDsuStaff) {
            $snapshot['archive'] = $this->requestStatusSnapshot(
                $this->archivedRequestsQuery($user, $canReviewRequests, $isAdmin)
            );
        }

        return $snapshot;
    }

    /**
     * @return array<string, array{count: int, latest: ?string}>
     */
    private function requestStatusSnapshot(Builder $query): array
    {
        return $query
            ->select('status')
            ->selectRaw('COUNT(*) as count, MAX(updated_at) as latest')
            ->groupBy('status')
            ->orderBy('status')
            ->get()
            ->mapWithKeys(fn (object $row): array => [
                $row->status => [
                    'count' => (int) $row->count,
                    'latest' => $row->latest,
                ],
            ])
            ->all();
    }

    private function reviewersFor(ServiceRequest $serviceRequest): Builder
    {
        return User::query()
            ->where('role', '<>', 'Pending')
            ->whereNotNull('email_verified_at')
            ->where(function (Builder $query) use ($serviceRequest): void {
                if ($serviceRequest->target_section_id !== null) {
                    $query->where('section_id', $serviceRequest->target_section_id);
                } else {
                    $query->where('role', 'Admin');
                }
            });
    }

    private function applyFilters(Builder $query, HttpRequest $request): void
    {
        if ($request->filled('search')) {
            $search = trim((string) $request->query('search'));
            $query->where(function (Builder $builder) use ($search): void {
                $builder->where('subject', 'like', "%{$search}%")
                    ->orWhere('requester_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (in_array($request->query('status'), [
            ServiceRequest::STATUS_RECEIVED,
            ServiceRequest::STATUS_UNDER_REVIEW,
            ServiceRequest::STATUS_MORE_INFORMATION_NEEDED,
            ServiceRequest::STATUS_COMPLETED,
            ServiceRequest::STATUS_DECLINED,
        ], true)) {
            $query->where('status', $request->query('status'));
        }
    }

    private function isEligibleStaff(?User $user): bool
    {
        return $user !== null && $user->hasVerifiedEmail() && $user->role !== 'Pending';
    }

    private function isDsuStaff(?User $user): bool
    {
        return $this->isEligibleStaff($user) && $user->section?->name === self::DSU_SECTION_NAME;
    }

    private function canReview(?User $user, ServiceRequest $serviceRequest): bool
    {
        if (! $this->isEligibleStaff($user)) {
            return false;
        }

        if ($serviceRequest->target_section_id !== null) {
            return (int) $user->section_id === (int) $serviceRequest->target_section_id;
        }

        return $user->isAdmin()
            && $serviceRequest->service_type === ServiceRequest::SERVICE_TYPE_OTHERS;
    }

    public function downloadAttachment(ServiceRequest $serviceRequest): StreamedResponse
    {
        $user = auth()->user();
        abort_unless($this->canReview($user, $serviceRequest), 403);
        abort_unless($serviceRequest->attachment_path, 404);
        abort_unless(Storage::disk('local')->exists($serviceRequest->attachment_path), 404);

        return Storage::disk('local')->download(
            $serviceRequest->attachment_path,
            $serviceRequest->attachment_name ?? basename($serviceRequest->attachment_path)
        );
    }

    private function streamDeliverable(
        ServiceRequest $serviceRequest,
        ServiceRequestDeliverable $deliverable
    ): StreamedResponse {
        abort_unless($serviceRequest->status === ServiceRequest::STATUS_COMPLETED, 404);
        $deliverable = $serviceRequest->deliverables()->findOrFail($deliverable->id);
        abort_unless(Storage::disk('local')->exists($deliverable->file_path), 404);

        return Storage::disk('local')->download($deliverable->file_path, $deliverable->file_name);
    }
}
