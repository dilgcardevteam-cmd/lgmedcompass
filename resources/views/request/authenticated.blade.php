<section class="min-h-screen bg-gray-50 py-6 sm:py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative mb-8 overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm lg:p-10">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-br from-yellow-100/40 to-orange-50/20 blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-gradient-to-tr from-blue-100/30 to-indigo-50/20 blur-3xl"></div>
            <div class="relative flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-2xl flex-1">
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-yellow-100 bg-yellow-50 px-3 py-1">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-yellow-500"></span>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-yellow-700">Live Request System</span>
                    </div>
                    <h1 class="mb-4 text-3xl font-black leading-tight tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                        Request <span class="bg-gradient-to-r from-yellow-600 via-gray-800 to-gray-900 bg-clip-text text-transparent">Process</span>
                    </h1>
                    <p class="text-base font-medium leading-relaxed text-gray-500 sm:text-lg">
                        Submit, track, claim, and process service requests through one shared workflow.
                    </p>
                </div>
                @unless($isDsuStaff)
                    <button
                        type="button"
                        onclick="document.getElementById('requestForm').showModal()"
                        class="flex h-12 w-full items-center justify-center gap-3 rounded-2xl bg-gray-900 px-8 font-bold text-white shadow-xl shadow-gray-200 transition-all hover:bg-yellow-600 active:scale-95 sm:w-auto"
                    >
                        <i class="bi bi-plus-lg text-yellow-400" aria-hidden="true"></i>
                        <span>New Request</span>
                    </button>
                @endunless
            </div>
        </div>

        @if(session('success') || session('error'))
            <div data-auto-dismiss="5000" class="mb-6 rounded-2xl border p-5 opacity-100 transition-opacity duration-500 {{ session('error') ? 'border-red-200 bg-red-50 text-red-900' : 'border-green-200 bg-green-50 text-green-900' }}" role="{{ session('error') ? 'alert' : 'status' }}">
                <p class="font-bold">{{ session('error') ?? session('success') }}</p>
                @if(session('request_reference'))
                    <p class="mt-1 text-sm">Reference number: <strong>{{ session('request_reference') }}</strong></p>
                @endif
            </div>
        @endif

        @php
            $requestTabs = [
                'my-active' => 'Active Requests',
                'my-finished' => 'Finished Requests',
                'incoming' => 'Incoming Requests',
                'claimed' => 'My Tasks',
                'archive' => 'Archive',
            ];
            $displayRequests = match ($tab) {
                'my-finished' => $finishedRequests,
                'incoming' => $incomingRequests,
                'claimed' => $claimedRequests,
                'archive' => $archivedRequests,
                default => $activeRequests,
            };
            $sectionTitle = match ($tab) {
                'my-active' => 'Active Requests',
                'my-finished' => 'Finished Requests',
                'incoming' => 'Incoming Requests',
                'claimed' => 'My Tasks',
                'archive' => 'Archived Requests',
                default => 'Active Requests',
            };
            $sectionDescription = match ($tab) {
                'my-active' => 'Requests that are still being processed.',
                'my-finished' => 'Completed or declined requests. Archive them when you no longer need them in this list.',
                'incoming' => 'Requests routed to your section, plus general requests awaiting Admin review when applicable.',
                'claimed' => 'Requests you have claimed and are currently processing.',
                'archive' => 'Requests you archived, along with completed requests handled by your section.',
                default => 'Requests that are still being processed.',
            };
        @endphp

        <nav class="mb-6 flex w-full max-w-4xl gap-1 overflow-x-auto border-b border-gray-200" aria-label="Request sections">
            @foreach($requestTabs as $tabKey => $tabLabel)
                @if((in_array($tabKey, ['my-active', 'my-finished'], true) && ($tabKey === 'my-active' ? $canSubmitRequests : $canArchiveRequesterRequests)) || ($tabKey === 'incoming' && $canReceiveRequests) || ($tabKey === 'claimed' && $canReviewRequests) || ($tabKey === 'archive' && ($canReviewRequests || $canSubmitRequests)))
                    <a
                        href="{{ route('request.index', ['tab' => $tabKey]) }}"
                        @class([
                            'whitespace-nowrap rounded-t-xl px-4 py-3 text-sm font-bold no-underline transition sm:px-6',
                            'border-b-2 border-yellow-500 bg-white text-gray-900' => $tab === $tabKey,
                            'text-gray-500 hover:bg-gray-100 hover:text-gray-800' => $tab !== $tabKey,
                        ])
                    >
                        {{ $tabLabel }}
                        @if(($requestCounts[$tabKey] ?? 0) > 0)
                            <span class="ml-1 inline-flex min-w-5 items-center justify-center rounded-full bg-gray-200 px-1.5 py-0.5 text-[11px] font-extrabold leading-none text-gray-700" aria-label="{{ $requestCounts[$tabKey] }} requests">
                                {{ $requestCounts[$tabKey] }}
                            </span>
                        @endif
                    </a>
                @endif
            @endforeach
        </nav>

        <div class="mb-4 rounded-3xl border border-gray-200 bg-white p-4 shadow-sm sm:p-5">
            <form method="GET" action="{{ route('request.index') }}" class="grid grid-cols-1 gap-3 md:grid-cols-12">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <label class="sr-only" for="requestSearch">Search requests</label>
                <input id="requestSearch" name="search" type="search" value="{{ request('search') }}" placeholder="Search subject, requester, or email" class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm md:col-span-7">
                <label class="sr-only" for="requestStatus">Filter by status</label>
                <select id="requestStatus" name="status" class="h-11 rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm md:col-span-3">
                    <option value="">All statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
                <button class="h-11 rounded-xl bg-gray-900 px-5 text-sm font-bold text-white transition hover:bg-yellow-600 md:col-span-2" type="submit">Search</button>
            </form>
        </div>

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
            <div class="border-b border-gray-100 px-6 py-5 sm:px-8">
                <h2 class="text-xl font-extrabold text-gray-900">{{ $sectionTitle }}</h2>
                <p class="mt-1 text-sm font-medium text-gray-500">{{ $sectionDescription }}</p>
            </div>

            @forelse($displayRequests as $serviceRequest)
                <details @if($errors->any()) open @endif class="group border-b border-gray-100 last:border-0">
                    <summary class="flex cursor-pointer list-none flex-wrap items-center gap-x-3 gap-y-2 px-6 py-4 transition hover:bg-gray-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-blue-700 sm:px-8 [&::-webkit-details-marker]:hidden">
                        <i class="bi bi-chevron-right text-xs text-gray-400 transition-transform group-open:rotate-90" aria-hidden="true"></i>
                        <span class="font-bold text-gray-900">{{ $serviceRequest->subject }}</span>
                        <x-request-status-badge :status="$serviceRequest->status" />
                        <span class="text-xs font-semibold text-gray-500">{{ $serviceRequest->service_type }}</span>
                        <span class="ml-auto text-xs text-gray-500">{{ $serviceRequest->requester_name }}</span>
                    </summary>
                    <div class="border-t border-gray-100 px-6 py-6 sm:px-8">
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-start">
                        <div class="min-w-0 flex-1">
                            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $serviceRequest->description }}</p>
                            <dl class="mt-4 grid grid-cols-1 gap-x-6 gap-y-2 text-sm sm:grid-cols-2">
                                <div><dt class="inline font-semibold text-gray-700">Requester: </dt><dd class="inline text-gray-600">{{ $serviceRequest->requester_name }}</dd></div>
                                <div><dt class="inline font-semibold text-gray-700">Email: </dt><dd class="inline text-gray-600">{{ $serviceRequest->email }}</dd></div>
                                <div><dt class="inline font-semibold text-gray-700">Office / Address: </dt><dd class="inline text-gray-600">{{ $serviceRequest->office_address }}</dd></div>
                                <div><dt class="inline font-semibold text-gray-700">Contact: </dt><dd class="inline text-gray-600">{{ $serviceRequest->contact_number }}</dd></div>
                                @if($serviceRequest->analysis_types)
                                    <div class="sm:col-span-2"><dt class="inline font-semibold text-gray-700">Analysis requested: </dt><dd class="inline text-gray-600">{{ implode(', ', $serviceRequest->analysis_types) }}</dd></div>
                                @endif
                                @if($serviceRequest->other_service_type)
                                    <div class="sm:col-span-2"><dt class="inline font-semibold text-gray-700">Service specified: </dt><dd class="inline text-gray-600">{{ $serviceRequest->other_service_type }}</dd></div>
                                @endif
                                <div><dt class="inline font-semibold text-gray-700">Needed by: </dt><dd class="inline text-gray-600">{{ $serviceRequest->date_needed->format('M j, Y') }}</dd></div>
                                <div><dt class="inline font-semibold text-gray-700">Received: </dt><dd class="inline text-gray-600">{{ $serviceRequest->requested_at->format('M j, Y g:i A') }}</dd></div>
                                @if($serviceRequest->assignedTo)
                                    <div><dt class="inline font-semibold text-gray-700">Assigned to: </dt><dd class="inline text-gray-600">{{ $serviceRequest->assignedTo->name }}</dd></div>
                                @endif
                            </dl>
                            @if($serviceRequest->last_comment)
                                <div class="mt-4 rounded-xl border border-blue-100 bg-blue-50 p-4 text-sm text-blue-900">
                                    <p class="font-bold">Latest update</p>
                                    <p class="mt-1 whitespace-pre-line">{{ $serviceRequest->last_comment }}</p>
                                </div>
                            @endif
                            @if($serviceRequest->status === \App\Models\ServiceRequest::STATUS_COMPLETED && ($serviceRequest->deliverable_link || $serviceRequest->deliverables->isNotEmpty()))
                                <div class="mt-4 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-950">
                                    <p class="font-bold">Completed files and links</p>
                                    @if($serviceRequest->deliverable_link)
                                        <a href="{{ $serviceRequest->deliverable_link }}" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex items-center gap-2 font-semibold text-blue-800 underline">
                                            <i class="bi bi-link-45deg" aria-hidden="true"></i> Open deliverable link
                                        </a>
                                    @endif
                                    @foreach($serviceRequest->deliverables as $deliverable)
                                        <a href="{{ route('request.deliverable', [$serviceRequest, $deliverable]) }}" class="mt-2 flex items-center gap-2 font-semibold text-blue-800 underline">
                                            <i class="bi bi-download" aria-hidden="true"></i> {{ $deliverable->file_name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mt-4 flex flex-wrap gap-2">
                                @if($serviceRequest->document_link)
                                    <a href="{{ $serviceRequest->document_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-3 py-2 text-sm font-semibold text-gray-700 no-underline transition hover:bg-gray-50">
                                        <i class="bi bi-link-45deg" aria-hidden="true"></i> Supporting link
                                    </a>
                                @endif
                                @if($serviceRequest->attachment_path && $canReviewRequests)
                                    <a href="{{ route('request.attachment', $serviceRequest) }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 px-3 py-2 text-sm font-semibold text-gray-700 no-underline transition hover:bg-gray-50">
                                        <i class="bi bi-paperclip" aria-hidden="true"></i> {{ $serviceRequest->attachment_name }}
                                    </a>
                                @endif
                                @if($serviceRequest->status === \App\Models\ServiceRequest::STATUS_MORE_INFORMATION_NEEDED && (int) $serviceRequest->requester_user_id === (int) auth()->id())
                                    <a href="{{ route('request.track', $serviceRequest->tracking_token) }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-800 px-3 py-2 text-sm font-bold text-white no-underline transition hover:bg-blue-900">
                                        <i class="bi bi-reply" aria-hidden="true"></i> Respond to request
                                    </a>
                                @endif
                                @if($tab === 'my-finished' && $canArchiveRequesterRequests && (int) $serviceRequest->requester_user_id === (int) auth()->id())
                                    <form method="POST" action="{{ route('request.archive', $serviceRequest) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:bg-gray-50">
                                            <i class="bi bi-archive" aria-hidden="true"></i> Archive request
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        @if($canReviewRequests && ! in_array($tab, ['my-active', 'my-finished', 'archive'], true))
                            <div class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 xl:max-w-sm">
                                @if($serviceRequest->status === \App\Models\ServiceRequest::STATUS_RECEIVED && $serviceRequest->assigned_to_id === null)
                                    <form method="POST" action="{{ route('request.claim', $serviceRequest) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gray-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-yellow-600">
                                            <i class="bi bi-person-check" aria-hidden="true"></i> Claim Request
                                        </button>
                                    </form>
                                @elseif((int) $serviceRequest->assigned_to_id === (int) auth()->id())
                                    <form method="POST" action="{{ route('request.update-status', $serviceRequest) }}" enctype="multipart/form-data" class="request-status-form space-y-3">
                                        @csrf
                                        @method('PATCH')
                                        <label for="status-{{ $serviceRequest->id }}" class="block text-xs font-bold uppercase tracking-wide text-gray-600">Update status</label>
                                        <select id="status-{{ $serviceRequest->id }}" name="status" required class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm">
                                            <option value="{{ \App\Models\ServiceRequest::STATUS_MORE_INFORMATION_NEEDED }}" @selected(old('status') === \App\Models\ServiceRequest::STATUS_MORE_INFORMATION_NEEDED)>More Information Needed</option>
                                            <option value="{{ \App\Models\ServiceRequest::STATUS_COMPLETED }}" @selected(old('status') === \App\Models\ServiceRequest::STATUS_COMPLETED)>Completed</option>
                                            <option value="{{ \App\Models\ServiceRequest::STATUS_DECLINED }}" @selected(old('status') === \App\Models\ServiceRequest::STATUS_DECLINED)>Declined</option>
                                        </select>
                                        @error('status')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                        <label for="comment-{{ $serviceRequest->id }}" class="block text-xs font-bold uppercase tracking-wide text-gray-600">Message to requester</label>
                                        <textarea id="comment-{{ $serviceRequest->id }}" name="comment" rows="3" maxlength="5000" class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm" placeholder="Explain what is needed or why the request was declined."></textarea>
                                        @error('comment')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                        <div class="completion-deliverables space-y-3 rounded-xl border border-green-200 bg-green-50 p-3">
                                            <p class="text-xs font-bold uppercase tracking-wide text-green-900">Completed request deliverables (optional)</p>
                                            <label for="completion-link-{{ $serviceRequest->id }}" class="block text-xs font-semibold text-gray-700">Link for the requester</label>
                                            <input id="completion-link-{{ $serviceRequest->id }}" name="completion_link" type="url" maxlength="2048" value="{{ old('completion_link') }}" placeholder="https://..." class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2.5 text-sm">
                                            @error('completion_link')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                            <label for="completion-files-{{ $serviceRequest->id }}" class="block text-xs font-semibold text-gray-700">Attach files (up to 5; 10 MB each)</label>
                                            <input id="completion-files-{{ $serviceRequest->id }}" name="completion_files[]" type="file" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.ppt,.pptx,.txt" class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm">
                                            <p class="text-xs text-gray-500">PDF, Word, Excel, CSV, PowerPoint, or text files.</p>
                                            @error('completion_files')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                            @error('completion_files.*')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                                        </div>
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-800 px-4 py-3 text-sm font-bold text-white transition hover:bg-blue-900">
                                            <i class="bi bi-arrow-repeat" aria-hidden="true"></i> Save Update
                                        </button>
                                    </form>
                                @else
                                    <p class="text-sm font-semibold text-gray-600">
                                        {{ $serviceRequest->assignedTo ? 'Claimed by '.$serviceRequest->assignedTo->name : 'Available for staff to claim.' }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                </details>
            @empty
                <div class="px-6 py-16 text-center sm:px-8">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-50 text-yellow-600">
                        <i class="bi bi-inbox text-2xl" aria-hidden="true"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-gray-900">Nothing to show</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-gray-500">
                        {{ match ($tab) {
                            'my-active' => 'You have no active requests.',
                            'my-finished' => 'You have no finished requests to archive.',
                            'incoming' => 'There are no incoming requests for your unit.',
                            'claimed' => 'You have not claimed any requests.',
                            'archive' => 'There are no archived requests.',
                            default => 'There are no requests to show.',
                        } }}
                    </p>
                </div>
            @endforelse

            @if($displayRequests->hasPages())
                <div class="border-t border-gray-100 px-6 py-4 sm:px-8">
                    {{ $displayRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    const requestUpdateUrl = @json(route('request.check-updates'));
    let requestUpdateSnapshot = @json($requestUpdateSnapshot);
    let isRefreshingForRequestUpdate = false;

    const refreshForRequestUpdate = (message) => {
        if (isRefreshingForRequestUpdate) {
            return;
        }

        isRefreshingForRequestUpdate = true;
        const notice = document.createElement('div');
        notice.setAttribute('role', 'status');
        notice.className = 'fixed bottom-5 left-1/2 z-50 -translate-x-1/2 rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-xl';
        notice.textContent = message;
        document.body.appendChild(notice);
        window.setTimeout(() => window.location.reload(), 1200);
    };

    const checkRequestUpdates = async () => {
        if (document.visibilityState !== 'visible' || isRefreshingForRequestUpdate) {
            return;
        }

        try {
            const response = await fetch(requestUpdateUrl, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error('Failed to check for request updates.');
            }

            const data = await response.json();
            const updatedSnapshot = data.snapshot;
            const changedLists = Object.keys(updatedSnapshot).filter((key) =>
                JSON.stringify(updatedSnapshot[key]) !== JSON.stringify(requestUpdateSnapshot[key])
            );

            if (changedLists.length > 0) {
                const message = changedLists.includes('incoming')
                    ? 'Incoming requests changed. Refreshing...'
                    : changedLists.includes('claimed')
                        ? 'Your request tasks were updated. Refreshing...'
                        : changedLists.includes('archive')
                            ? 'Your request archive was updated. Refreshing...'
                            : 'Your requests were updated. Refreshing...';
                refreshForRequestUpdate(message);

                return;
            }

            requestUpdateSnapshot = updatedSnapshot;
        } catch (error) {
            console.warn('Request update check failed:', error);
        }
    };

    window.setInterval(checkRequestUpdates, 10000);

    document.querySelectorAll('.request-status-form').forEach((form) => {
        const status = form.querySelector('select[name="status"]');
        const comment = form.querySelector('textarea[name="comment"]');
        const deliverables = form.querySelector('.completion-deliverables');
        const deliverableLink = form.querySelector('input[name="completion_link"]');
        const deliverableFiles = form.querySelector('input[name="completion_files[]"]');

        const updateCommentRequirement = () => {
            comment.required = [
                'More Information Needed',
                'Declined',
            ].includes(status.value);
            const isCompleting = status.value === 'Completed';
            deliverables.hidden = !isCompleting;
            deliverableLink.disabled = !isCompleting;
            deliverableFiles.disabled = !isCompleting;
        };

        status.addEventListener('change', updateCommentRequirement);
        updateCommentRequirement();
    });
</script>
