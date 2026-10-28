<x-app-layout>
    @vite('resources/css/my-task.css')
    <!-- Bootstrap Icons only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @php
        $adminId = 1; // Adjust as needed
        // Icon mapping for workflow actions
        $actionIcons = [
            'send_for_review' => 'bi-send',
            'revise' => 'bi-pencil-square',
            'approve' => 'bi-check-lg',
            'ready_to_print' => 'bi-printer',
            // Add any other actions you may have
        ];
        $reviewerUsersSections12 = $users->filter(function($user) {
        return in_array($user->section_id, [1, 2]);
        });
    @endphp

    <!-- Pass user lists to JavaScript -->
    <script>
        window.allUsers = @json($users);
        window.reviewerUsers = @json($users->whereNotIn('section_id', [1, 2])->values());
    </script>

  <section class="py-6 sm:py-10 bg-gray-50 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Main Header Card -->
    <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-200 shadow-sm mb-8 p-6 lg:p-10">
        <!-- Subtle Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-yellow-100/40 to-orange-50/20 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-100/30 to-indigo-50/20 rounded-full blur-3xl -ml-20 -mb-20"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-end justify-between gap-8">
            <!-- Left Side: Title & Description -->
            <div class="flex-1 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-100 mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-yellow-700 uppercase tracking-widest">Live Document System</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 tracking-tight leading-[1.1] mb-4">
                    Document <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 via-gray-800 to-gray-900">Process</span>
                </h2>
                <p class="text-gray-500 text-base sm:text-lg font-medium leading-relaxed">
                    Verify and manage assets through our <span class="text-gray-900 font-bold border-b-2 border-yellow-400/60 pb-0.5">multi-stage approval</span> workflow.
                </p>
            </div>

            <!-- Right Side: Primary Actions -->
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <a href="{{ route('documents.archivePage') }}"
                   class="w-full sm:w-auto h-12 flex items-center justify-center px-6 rounded-2xl bg-white text-gray-700 font-bold border border-gray-200 hover:bg-gray-50 hover:border-gray-300 hover:shadow-sm transition-all gap-2 group no-underline">
                    <i class="bi bi-archive text-gray-400 group-hover:text-gray-900 transition-colors"></i>
                    <span>Archive</span>
                </a>

                <button id="openUploadModalBtn"
                        data-is-tech-inspector="{{ Auth::user()->isTechnicalInspector() ? 'true' : 'false' }}"
                        class="w-full sm:w-auto h-12 flex items-center justify-center px-8 rounded-2xl bg-gray-900 text-white font-bold hover:bg-yellow-600 transition-all gap-3 shadow-xl shadow-gray-200 active:scale-95 group">
                    <i class="bi bi-plus-lg text-yellow-400 group-hover:rotate-90 transition-transform duration-300"></i>
                    <span>Upload Document</span>
                </button>
            </div>
        </div>

        <!-- Filter Bar: Integrated Design -->
        <div class="mt-10 pt-8 border-t border-gray-100">
            <form method="GET" action="{{ route('documents.my-tasks') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                <!-- Search Input -->
                <div class="relative md:col-span-6 lg:col-span-7">
                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by title, focal person, or keyword..."
                           class="w-full h-12 pl-12 pr-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 transition-all outline-none text-sm font-semibold text-gray-800 placeholder-gray-400">
                </div>

                <!-- Type Filter -->
                <div class="md:col-span-3 lg:col-span-2.5">
                    <select name="type" onchange="this.form.submit()"
                            class="w-full h-12 px-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 transition-all outline-none text-sm font-bold text-gray-700 cursor-pointer appearance-none">
                        <option value="">All Types</option>
                        <option value="Memorandum" {{ request('type') == 'Memorandum' ? 'selected' : '' }}>Memorandum</option>
                        <option value="Advisory" {{ request('type') == 'Advisory' ? 'selected' : '' }}>Advisory</option>
                        <option value="Division Order" {{ request('type') == 'Division Order' ? 'selected' : '' }}>Division Order</option>
                        <option value="Office Order" {{ request('type') == 'Office Order' ? 'selected' : '' }}>Office Order</option>
                        <option value="Regional Order" {{ request('type') == 'Regional Order' ? 'selected' : '' }}>Regional Order</option>
                        <option value="Post Activity Report" {{ request('type') == 'Post Activity Report' ? 'selected' : '' }}>Post Activity Report</option>
                        <option value="Invitation Letter" {{ request('type') == 'Invitation Letter' ? 'selected' : '' }}>Invitation Letter</option>
                        <option value="Others" {{ request('type') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>

                <!-- Section Filter -->
                <div class="md:col-span-3 lg:col-span-2.5">
                    <select name="section" onchange="this.form.submit()"
                            class="w-full h-12 px-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-yellow-500/10 focus:border-yellow-500 transition-all outline-none text-sm font-bold text-gray-700 cursor-pointer appearance-none">
                        <option value="">All Sections</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

<div class="flex items-end w-full max-w-2xl px-2 mt-6 sm:mt-8 border-b border-gray-200/60">
    
    <div class="relative group flex-shrink-0">
        <button id="uploadedTabBtn"
                data-tab="uploaded"
                class="tab-btn relative flex items-center gap-2 sm:gap-3 px-3 sm:px-6 py-2.5 sm:py-3.5 font-bold transition-all duration-300 rounded-t-2xl z-20 text-sm sm:text-base
                {{ request('tab') == 'uploaded' || !request('tab') ? 'active-tab text-gray-800 bg-white' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50/50' }}">
            
            <div class="relative flex items-center justify-center w-6 h-6 sm:w-8 sm:h-8 rounded-lg sm:rounded-xl bg-yellow-50 text-yellow-600 transition-transform duration-300 group-hover:scale-110">
                <i class="bi bi-cloud-upload-fill text-sm sm:text-base"></i>
            </div>

            <div class="flex flex-col items-start">
                <span class="text-[10px] sm:text-xs font-black uppercase tracking-wider opacity-60 hidden sm:block">Storage</span>
                <span class="text-xs sm:text-sm">Uploaded</span>
            </div>

            <span class="ml-1 px-1.5 sm:px-2 py-0.5 text-[9px] sm:text-[10px] bg-yellow-100 text-yellow-700 rounded-lg font-black ring-1 ring-yellow-200">
                {{ $uploadedDocuments->count() }}
            </span>
        </button>
    </div>

    <div class="relative group flex-shrink-0">
        <button id="taskTabBtn"
                data-tab="task"
                class="tab-btn relative flex items-center gap-2 sm:gap-3 px-3 sm:px-6 py-2.5 sm:py-3.5 font-bold transition-all duration-300 rounded-t-2xl z-20 text-sm sm:text-base
                {{ request('tab') == 'task' ? 'active-tab text-gray-800 bg-white' : 'text-gray-400 hover:text-gray-600 hover:bg-gray-50/50' }}">
            
            <i class="bi bi-check2-circle text-base sm:text-lg group-hover:text-indigo-500 transition-colors"></i>
            
            <div class="flex flex-col items-start">
                <span class="text-[10px] sm:text-xs font-black uppercase tracking-wider opacity-60 hidden sm:block">Action</span>
                <span class="text-xs sm:text-sm">Tasks</span>
            </div>

            <div class="relative">
                 <span class="px-1.5 sm:px-2 py-0.5 text-[9px] sm:text-[10px] bg-gray-100 text-gray-500 rounded-lg font-black transition-colors">
                    {{ $assignedDocuments->total() }}
                </span>
                <span class="absolute -top-1 -right-1 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
            </div>
        </button>
    </div>
</div>
        <div id="uploadedPanel" class="tab-panel">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                @forelse($uploadedDocuments as $doc)
                    @php
                        $progressMap = [
                            'Draft' => 10,
                            'Pending Review' => 30,
                            'Revision Required' => 40,
                            'Approved by Reviewer' => 60,
                            'Pending Chief Approval' => 75,
                            'Ready for Printing' => 90,
                            'Complete' => 100,
                        ];
                        $progress = $progressMap[$doc->status] ?? 0;
                        $isAssignedToMe = ($doc->assigned_to_id == auth()->id());
                        $statusStyles = match($doc->status) {
                            'Draft' => 'bg-gray-100 text-gray-600',
                            'Pending Review' => 'bg-amber-100 text-amber-700',
                            'Revision Required' => 'bg-rose-100 text-rose-700',
                            'Approved by Reviewer' => 'bg-blue-100 text-blue-700',
                            'Pending Chief Approval' => 'bg-purple-100 text-purple-700',
                            'Ready for Printing' => 'bg-violet-100 text-violet-700',
                            'Complete' => 'bg-emerald-100 text-emerald-700',
                            default => 'bg-gray-100 text-gray-600',
                        };
                        $barColor = match($doc->status) {
                            'Complete' => 'bg-emerald-500',
                            'Revision Required' => 'bg-rose-500',
                            'Pending Chief Approval' => 'bg-purple-500',
                            default => 'bg-blue-600',
                        };
                    @endphp
                    
                    <div class="doc-card group bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden"
                         data-id="{{ $doc->id }}"
                         data-doc-title="{{ $doc->subject_title }}"
                         data-doc-status="{{ $doc->status }}"
                         data-doc-focal="{{ $doc->focal_person }}"
                         data-doc-created="{{ $doc->created_at->format('M d, Y • h:i A') }}"
                         data-doc-link="{{ $doc->document_link ?? '' }}"
                         data-doc-last-comment="{{ $doc->last_comment ?? '' }}"
                         data-doc-type-of-paper="{{ $doc->type_of_paper ?? '' }}"
                         data-doc-type-of-paper-other="{{ $doc->type_of_paper_other ?? '' }}"
                         data-doc-files='@json($doc->file_path)'>
                        
                        <div class="p-4 sm:p-6">
                            <div class="flex justify-between items-start mb-3 sm:mb-4">
                                <span class="px-2 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-bold uppercase tracking-wider {{ $statusStyles }}">
                                    {{ $doc->status }}
                                </span>
                                <button type="button" class="doc-open-btn p-1.5 sm:p-2 rounded-lg sm:rounded-xl bg-gray-50 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 transition-colors" title="Open document link" data-document-link="{{ $doc->document_link ?? '' }}">
                                    <i class="bi bi-box-arrow-up-right text-sm sm:text-base"></i>
                                </button>
                            </div>

                            <h3 class="font-bold text-gray-900 text-base sm:text-lg lg:text-xl leading-snug mb-3 sm:mb-4 group-hover:text-yellow-600 transition-colors line-clamp-2">
                                {{ $doc->subject_title }}
                            </h3>

                            <div class="mb-4 sm:mb-6">
                                <div class="flex justify-between items-center mb-2 text-[10px] sm:text-xs font-bold text-gray-500 uppercase tracking-tighter">
                                    <span>Completion</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="w-full h-1.5 sm:h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-700 {{ $barColor }}" style="width: {{ $progress }}%;"></div>
                                </div>
                            </div>

                            <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
                                <div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="bi bi-person text-xs sm:text-sm"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] sm:text-xs text-gray-400 font-medium leading-none">Focal Person</p>
                                        <p class="text-gray-700 font-semibold truncate">{{ $doc->focal_person }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="bi bi-layers text-xs sm:text-sm"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] sm:text-xs text-gray-400 font-medium leading-none">Section</p>
                                        <p class="text-gray-700 font-semibold truncate">
                                            @if($doc->section)
                                                {{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}
                                            @else
                                                Not specified
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($doc->last_comment)
                            <div class="p-4 bg-gray-50 rounded-2xl mb-4 border-l-4 border-yellow-500">
                                <p class="text-xs text-gray-400 font-bold uppercase mb-1">Last Feedback</p>
                                <p class="text-sm text-gray-700 italic line-clamp-2">"{{ $doc->last_comment }}"</p>
                            </div>
                            @endif
                        </div>

                        <div class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50/50 border-t border-gray-100 mt-auto flex flex-col sm:flex-wrap gap-2">
                            @if($doc->status === 'Pending Review')
                                <!-- For Pending Review in Uploaded section: only show Edit and Delete -->
                                <div class="flex gap-2 w-full">
                                    <button type="button"
                                            class="edit-trigger flex-1 px-3 sm:px-4 py-2.5 text-xs sm:text-sm font-bold rounded-lg sm:rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition-all flex items-center justify-center gap-2 whitespace-nowrap"
                                            data-doc-id="{{ $doc->id }}"
                                            data-doc-title="{{ $doc->subject_title }}"
                                            data-doc-focal="{{ $doc->focal_person }}"
                                            data-doc-link="{{ $doc->document_link ?? '' }}"
                                            data-doc-remarks="{{ $doc->remarks ?? '' }}"
                                            data-doc-section="{{ $doc->section ?? '' }}"
                                            title="Edit Document">
                                        <i class="bi bi-pencil text-sm sm:text-base"></i>
                                        <span class="truncate">Edit</span>
                                    </button>
                                </div>
                            @elseif(isset($actions[$doc->status]) && ($isAssignedToMe || Auth::user()->isAdmin()))
                                <div class="flex flex-col sm:flex-row gap-2 w-full">
                                    @foreach($actions[$doc->status] as $actionKey => $actionConfig)
                                        @if($actionKey === 'approve')
                                            @if($doc->status === 'Approved by Reviewer')
                                                <!-- Ready to Print button (for sections 1/2) -->
                                                <button type="button"
                                                    class="ready-to-print-trigger inline-flex items-center justify-center gap-2 min-h-[61px] w-full sm:w-auto px-4 py-3 text-sm sm:text-base font-semibold rounded-2xl bg-indigo-600 text-white border border-indigo-600 shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                                    data-doc-id="{{ $doc->id }}"
                                                    data-doc-title="{{ $doc->subject_title }}"
                                                    data-uploader-id="{{ $doc->user_id }}"
                                                    title="Ready to print">
                                                    <i class="bi bi-printer text-base sm:text-lg"></i>
                                                    <span>{{ $actionConfig['label'] }}</span>
                                                </button>
                                            @else
                                                <!-- Regular Approve button (for reviewers) -->
                                                <button type="button"
                                                        class="approve-trigger px-3 sm:px-4 py-2.5 text-xs sm:text-sm font-bold rounded-lg sm:rounded-xl bg-green-600 text-white hover:bg-green-700 transition-all flex items-center justify-center gap-2 whitespace-nowrap min-w-0 flex-1"
                                                        data-doc-id="{{ $doc->id }}"
                                                        data-doc-title="{{ $doc->subject_title }}">
                                                    <i class="bi bi-check2-circle text-sm sm:text-base"></i>
                                                    <span class="truncate">{{ $actionConfig['label'] }}</span>
                                                </button>
                                            @endif
                                        @else
                                            <!-- Regular workflow button for other actions -->
                                            <button type="button"
                                                    class="workflow-trigger px-3 sm:px-4 py-2.5 text-xs sm:text-sm font-bold rounded-lg sm:rounded-xl bg-yellow-600 text-white hover:bg-yellow-700 transition-all flex items-center justify-center gap-2 whitespace-nowrap min-w-0 flex-1"
                                                    data-doc-id="{{ $doc->id }}"
                                                    data-doc-title="{{ $doc->subject_title }}"
                                                    data-action="{{ $actionKey }}"
                                                    data-label="{{ $actionConfig['label'] }}"
                                                    data-needs-assignee="{{ $actionConfig['needs_assignee'] ? 'true' : 'false' }}"
                                                    data-document-link="{{ $doc->document_link ?? '' }}"
                                                    data-files='@json($doc->file_path)'>
                                                <i class="bi {{ $actionIcons[$actionKey] ?? 'bi-gear' }} text-sm sm:text-base"></i>
                                                <span class="truncate">{{ $actionConfig['label'] }}</span>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            
                            <div class="flex gap-2">
                                @if($doc->status !== 'Pending Review')
                                    <button class="download-btn p-2.5 sm:p-3 rounded-lg sm:rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors flex-shrink-0"
                                            data-file='@json($doc->file_path ? (is_array($doc->file_path) ? $doc->file_path : json_decode($doc->file_path, true)) : [])'
                                            title="Download File">
                                        <i class="bi bi-download text-base sm:text-lg"></i>
                                    </button>
                                @endif
                                <button class="delete-trigger p-2.5 sm:p-3 rounded-lg sm:rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors flex-shrink-0"
                                        data-id="{{ $doc->id }}" data-title="{{ $doc->subject_title }}"
                                        title="Delete">
                                    <i class="bi bi-trash text-base sm:text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <i class="bi bi-cloud-upload text-5xl text-gray-300 mb-4"></i>
                        <p class="text-xl font-medium text-gray-500">You haven't uploaded any documents yet.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $uploadedDocuments->links('pagination::tailwind') }}
            </div>
        </div>

        <div id="taskPanel" class="tab-panel hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($assignedDocuments as $doc)
                    @php
                        $statusStyles = match($doc->status) {
                            'Draft' => 'bg-gray-100 text-gray-600',
                            'Pending Review' => 'bg-amber-100 text-amber-700',
                            'Revision Required' => 'bg-rose-100 text-rose-700',
                            'Approved by Reviewer' => 'bg-blue-100 text-blue-700',
                            'Pending Chief Approval' => 'bg-purple-100 text-purple-700',
                            'Ready for Printing' => 'bg-violet-100 text-violet-700',
                            'Complete' => 'bg-emerald-100 text-emerald-700',
                            default => 'bg-gray-100 text-gray-600',
                        };
                        $progressMap = [
                            'Draft' => 10,
                            'Pending Review' => 30,
                            'Revision Required' => 40,
                            'Approved by Reviewer' => 60,
                            'Pending Chief Approval' => 75,
                            'Ready for Printing' => 90,
                            'Complete' => 100,
                        ];
                        $progress = $progressMap[$doc->status] ?? 0;
                        $barColor = match($doc->status) {
                            'Complete' => 'bg-emerald-500',
                            'Revision Required' => 'bg-rose-500',
                            'Pending Chief Approval' => 'bg-purple-500',
                            default => 'bg-blue-600',
                        };
                    @endphp

                    <div class="doc-card group bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer overflow-hidden"
                         data-id="{{ $doc->id }}"
                         data-doc-title="{{ $doc->subject_title }}"
                         data-doc-status="{{ $doc->status }}"
                         data-doc-focal="{{ $doc->focal_person }}"
                         data-doc-created="{{ $doc->created_at->format('M d, Y • h:i A') }}"
                         data-doc-link="{{ $doc->document_link ?? '' }}"
                         data-doc-last-comment="{{ $doc->last_comment ?? '' }}"
                         data-doc-type-of-paper="{{ $doc->type_of_paper ?? '' }}"
                         data-doc-type-of-paper-other="{{ $doc->type_of_paper_other ?? '' }}"
                         data-doc-files='@json($doc->file_path)'>

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $statusStyles }}">
                                    {{ $doc->status }}
                                </span>
                                <button type="button" class="doc-open-btn p-2 rounded-xl bg-gray-50 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 transition-colors" title="Open document link" data-document-link="{{ $doc->document_link ?? '' }}">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </button>
                            </div>

                            <h3 class="font-bold text-gray-900 text-xl leading-snug mb-4 group-hover:text-yellow-600 transition-colors">
                                {{ $doc->subject_title }}
                            </h3>

                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2 text-xs font-bold text-gray-500 uppercase tracking-tighter">
                                    <span>Completion</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-700 {{ $barColor }}" style="width: {{ $progress }}%;"></div>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-medium leading-none">Focal Person</p>
                                        <p class="text-gray-700 font-semibold">{{ $doc->focal_person }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                        <i class="bi bi-layers"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-medium leading-none">Section</p>
                                        <p class="text-gray-700 font-semibold">
                                            @if($doc->section)
                                                {{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}
                                            @else
                                                Not specified
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($doc->last_comment)
                            <div class="p-4 bg-gray-50 rounded-2xl mb-4 border-l-4 border-yellow-500">
                                <p class="text-xs text-gray-400 font-bold uppercase mb-1">Last Feedback</p>
                                <p class="text-sm text-gray-700 italic line-clamp-2">"{{ $doc->last_comment }}"</p>
                            </div>
                            @endif
                        </div>

                        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 mt-auto flex flex-wrap gap-2">
                            @if(isset($actions[$doc->status]) || Auth::user()->isAdmin())
                                @foreach($actions[$doc->status] as $actionKey => $actionConfig)
                                    @if($actionKey === 'approve')
                                        @if($doc->status === 'Approved by Reviewer')
                                            <!-- Ready to Print button (for sections 1/2) -->
                                            <button type="button"
                                                class="ready-to-print-trigger inline-flex items-center justify-center gap-2 min-h-[61px] w-full sm:w-auto px-4 py-3 text-sm sm:text-base font-semibold rounded-2xl bg-indigo-600 text-white border border-indigo-600 shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                                data-doc-id="{{ $doc->id }}"
                                                data-doc-title="{{ $doc->subject_title }}"
                                                data-uploader-id="{{ $doc->user_id }}">
                                                <i class="bi bi-printer text-base sm:text-lg"></i>
                                                <span>{{ $actionConfig['label'] }}</span>
                                            </button>
                                        @else
                                            <!-- Regular Approve button (for reviewers) -->
                                            <button type="button"
                                                    class="approve-trigger flex-1 px-4 py-2 text-xs font-bold rounded-xl bg-green-600 text-white hover:bg-green-700 transition-all flex items-center justify-center gap-2"
                                                    data-doc-id="{{ $doc->id }}"
                                                    data-doc-title="{{ $doc->subject_title }}">
                                                <i class="bi bi-check2-circle"></i>
                                                {{ $actionConfig['label'] }}
                                            </button>
                                        @endif
                                    @else
                                        <!-- Regular workflow button -->
                                        <button type="button"
                                                class="workflow-trigger flex-1 px-4 py-2 text-xs font-bold rounded-xl bg-yellow-600 text-white hover:bg-yellow-700 transition-all flex items-center justify-center gap-2"
                                                data-doc-id="{{ $doc->id }}"
                                                data-doc-title="{{ $doc->subject_title }}"
                                                data-action="{{ $actionKey }}"
                                                data-label="{{ $actionConfig['label'] }}"
                                                data-needs-assignee="{{ $actionConfig['needs_assignee'] ? 'true' : 'false' }}"
                                                data-document-link="{{ $doc->document_link ?? '' }}"
                                                data-files='@json($doc->file_path)'
                                                data-uploader-id="{{ $doc->user_id }}">
                                            <i class="bi {{ $actionIcons[$actionKey] ?? 'bi-gear' }}"></i>
                                            {{ $actionConfig['label'] }}
                                        </button>
                                    @endif
                                @endforeach
                            @endif
                            <!-- Download button -->
                            <button class="download-btn p-2 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors"
                                    data-file='@json($doc->file_path ? (is_array($doc->file_path) ? $doc->file_path : json_decode($doc->file_path, true)) : [])'
                                    title="Download File">
                                <i class="bi bi-download text-lg"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                        <i class="bi bi-clipboard-check text-5xl text-gray-300 mb-4"></i>
                        <p class="text-xl font-medium text-gray-500">No tasks assigned to you.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-12">
                {{ $assignedDocuments->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    </div>
</section>

    <!-- ==================== CUSTOM MODALS (Tailwind) ==================== -->

   <div id="workflowModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-hidden flex flex-col transform transition-all border border-slate-100">
        
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <div>
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-amber-100 text-amber-600 rounded-xl">
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Perform Action
                </h3>
                <p class="text-sm text-slate-500 mt-1">Please provide the details below to continue.</p>
            </div>
            <button class="close-modal p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
         <!-- Error message area -->
<div id="workflowModalError" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
    <div class="flex items-center gap-2">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span id="workflowModalErrorMsg"></span>
    </div>
</div>                           
        <div class="p-8 overflow-y-auto custom-scrollbar">
            <form method="POST" action="" id="workflowForm" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="action" id="workflowAction">
                
                <div id="workflowDocTitleContainer" class="bg-blue-50 border border-blue-100 rounded-2xl p-4 text-center">
                    <p id="workflowDocTitle" class="text-blue-700 font-semibold text-sm tracking-wide uppercase"></p>
                </div>

                <div id="assigneeField" class="hidden">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Assign to</label>
                    <div class="relative">
                        <select name="assign_to" id="workflowAssigneeSelect" class="w-full appearance-none bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none">
                            <!-- Options will be populated dynamically by JavaScript -->
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            
                        </div>
                    </div>
                </div>

                <div id="attachmentFields" class="hidden space-y-5">
                    <div id="revisionSpecificFields" class="hidden p-5 bg-slate-50 rounded-2xl border border-slate-100 space-y-4">
                        <h6 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                            <i class="bi bi-file-earmark-diff text-amber-500"></i> Revision Details
                        </h6>
                        
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Document Link</label>
                            <input type="url" name="attachment_link" id="modalLinkInput"
                                   placeholder="https://..."
                                   class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-amber-500/20 outline-none">
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Replace File</label>
                            <input type="file" name="attachment" 
                                   class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer"
                                   accept=".pdf,.doc,.docx">
                        </div>
                        <div id="modalCurrentFile" class="text-xs text-slate-400 italic"></div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Comment <span class="text-slate-400 font-normal">(optional)</span></label>
                        <textarea name="comment" rows="3" 
                                  placeholder="Type your notes here..."
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none resize-none"></textarea>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <button type="button" class="close-modal order-2 sm:order-1 px-6 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="order-1 sm:order-2 px-8 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 shadow-lg shadow-slate-200 active:scale-95 transition-all">
                        Confirm Action
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Upload Modal-->
    <div id="uploadModal" class="fixed inset-0 z-[9999] hidden items-center justify-center backdrop-blur-sm bg-black/40 py-8 px-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[92vh] overflow-hidden flex flex-col transform transition-all">
        
        <div class="bg-white px-8 py-6 flex justify-between items-center border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center">
                    <i class="bi bi-cloud-upload-fill text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Upload New Document</h3>
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Document Management System</p>
                </div>
            </div>
            <button class="close-modal text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-full transition-colors">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar bg-white">
            <div id="uploadModalError" class="hidden bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 mb-6 rounded-xl animate-pulse" role="alert">
                <div class="flex items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span id="uploadModalErrorMsg" class="font-medium text-sm"></span>
                </div>
            </div>

            <form method="POST" action="{{ route('documents.quick-store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="group">
                    <label class="block text-sm font-bold text-gray-700 mb-3 ml-1 uppercase tracking-wide">
                        <i class="bi bi-file-earmark-arrow-up text-yellow-600 mr-1"></i> Attach Files
                    </label>
                    <div id="uploadDropZone"
     class="relative border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center bg-gray-50 group-hover:bg-white group-hover:border-yellow-400 group-hover:shadow-md transition-all duration-300 cursor-pointer">
                        
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="bi bi-cloud-arrow-up text-3xl text-yellow-500"></i>
                        </div>
                        
                        <p class="text-gray-900 font-bold text-lg">Drag & drop files here</p>
                        <p class="text-gray-500 text-sm mt-1">or <span class="text-yellow-600 font-semibold underline decoration-2 underline-offset-4">browse your computer</span></p>
                        <div class="mt-4 flex justify-center gap-3">
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-gray-400 border border-gray-100 uppercase">PDF ONLY</span>
                            <span class="px-3 py-1 bg-white rounded-lg text-[10px] font-bold text-gray-400 border border-gray-100 uppercase">MAX 5MB</span>
                        </div>

                        <input type="file" id="fileInput" name="documents[]" multiple accept=".pdf" class="hidden" onchange="updateFileList(this)">
                        <div id="fileList" class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-2 text-left"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <div class="md:col-span-2 group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            <i class="bi bi-link-45deg text-yellow-600"></i> Document Link
                        </label>
                        <input type="url" name="document_link" 
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all outline-none" 
                               placeholder="https://example.com/document">
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Document Title <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="subject_title" 
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all outline-none" 
                               placeholder="Enter title..." required>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Focal Person <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="focal_person" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 appearance-none focus:bg-white focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all outline-none cursor-pointer" required>
                                <option value="" disabled hidden>Select person</option>
                                <option value="{{ auth()->user()->name }}" selected>{{ auth()->user()->name }} (You)</option>
                                @foreach ($users as $user)
                                    @if ($user->id !== auth()->id())
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Section <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="section" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 appearance-none focus:bg-white focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all outline-none cursor-pointer" required>
                               
                            <option value='' selected disabled hidden>Select a section</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}">
                                {{ $section->name }}
                            </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Type of Paper <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="type_of_paper" 
                                   class="combobox-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none pr-10"
                                   placeholder="Input or Select type of paper..."
                                   value="{{ old('type_of_paper') }}"
                                   autocomplete="off"
                                   required>
                            <button type="button" class="combobox-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <ul class="combobox-list absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg max-h-60 overflow-auto hidden">
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Memorandum">Memorandum</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Advisory">Advisory</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Division Order">Division Order</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Office Order">Office Order</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Regional Order">Regional Order</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Post Activity Report">Post Activity Report</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Invitation Letter">Invitation Letter</li>
                                <li class="px-4 py-2 text-sm text-gray-700 hover:bg-yellow-100 cursor-pointer" data-value="Others">Others</li>
                            </ul>
                        </div>
                    </div>

                    <div class="group hidden" data-type-of-paper-other-group>
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Specify Type of Paper <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               name="type_of_paper_other"
                               value="{{ old('type_of_paper_other') }}"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none"
                               placeholder="Enter the type of paper"
                               maxlength="255"
                               disabled>
                    </div>

                    <div class="md:col-span-2 group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">
                            Remarks & Notes
                        </label>
                        <textarea name="remarks" rows="3" 
                                  class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:ring-4 focus:ring-yellow-400/10 focus:border-yellow-400 transition-all outline-none resize-none" 
                                  placeholder="Add additional information here..."></textarea>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-4 mt-10 pt-6 border-t border-gray-100">
                    <button type="button" class="close-modal px-8 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-2xl transition-all">
                        Discard
                    </button>
                    <button type="submit" class="px-10 py-3 bg-gray-900 text-white text-sm font-bold rounded-2xl hover:bg-yellow-600 shadow-lg shadow-gray-200 transition-all active:scale-95 flex items-center gap-2">
                        <i class="bi bi-check-lg text-lg"></i>
                        Save Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #D1D5DB; }
</style>
<!--approval modal-->
<!-- ==================== APPROVAL MODAL (Separate) ==================== -->
<div id="approvalModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-hidden flex flex-col transform transition-all border border-slate-100">
        
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <div>
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-green-100 text-green-600 rounded-xl">
                        <i class="bi bi-check2-circle"></i>
                    </span>
                    Approve Document
                </h3>
                <p class="text-sm text-slate-500 mt-1">Assign this document to a reviewer (Devision Chief and Assistant Chief only).</p>
            </div>
            <button class="close-approval-modal p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Error message area -->
        <div id="approvalModalError" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
            <div class="flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span id="approvalModalErrorMsg"></span>
            </div>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar">
            <form method="POST" action="" id="approvalForm" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="action" value="approve" id="approvalAction">
                
                <div class="bg-green-50 border border-green-100 rounded-2xl p-4 text-center">
                    <p id="approvalDocTitle" class="text-green-700 font-semibold text-sm tracking-wide uppercase"></p>
                </div>

                <!-- Assignee field: only users from sections 1 and 2 -->
                <div id="approvalAssigneeField">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Assign to (Reviewer from Devision Chief and Assistant Chief)</label>
                    <div class="relative">
                        <select name="assign_to" id="approvalAssigneeSelect" class="w-full appearance-none bg-slate-50 border border-slate-200 text-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none">
                            <option value="" selected disabled>Select reviewer</option>
                                @foreach($reviewerUsersSections12 as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->section->name ?? 'Section ' . $user->section_id }})
                                    </option>
                                @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            
                        </div>
                    </div>
                </div>

                <!-- Comment field (optional) -->
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Comment <span class="text-slate-400 font-normal">(optional)</span></label>
                    <textarea name="comment" rows="3" 
                              placeholder="Add approval notes here..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all outline-none resize-none"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <button type="button" class="close-approval-modal order-2 sm:order-1 px-6 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="order-1 sm:order-2 px-8 py-3 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 shadow-lg shadow-green-200 active:scale-95 transition-all">
                        Confirm Approval
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Edit Document Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4 flex justify-between items-center rounded-t-2xl">
                <h3 class="text-xl font-bold text-white flex items-center gap-2"><i class="bi bi-pencil-square"></i> Edit Document</h3>
                <button class="close-modal text-white text-2xl">&times;</button>
            </div>
            <div class="p-6 bg-gray-50">
                <form method="POST" action="" id="editDocumentForm" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2"><i class="bi bi-file-earmark-arrow-up"></i> Replace Attachments (optional)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-white cursor-pointer" onclick="document.getElementById('editFileInput').click();">
                            <i class="bi bi-cloud-upload text-yellow-500 text-3xl mb-2 block"></i>
                            <p class="font-medium">Drop new files or click to browse</p>
                            <small class="text-gray-500">PDF only (max 5MB each)</small>
                            <input type="file" id="editFileInput" name="documents[]" multiple accept=".pdf" class="hidden" onchange="updateEditFileList(this)">
                            <div id="editFileList" class="mt-2 text-sm text-left text-gray-600"></div>
                        </div>
                        <div id="currentFilesPreview" class="mt-2 p-2 bg-white rounded-lg border border-gray-200">
                            <span class="text-sm font-semibold">Current files:</span>
                            <div id="currentFilesList" class="mt-1"></div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2"><i class="bi bi-link-45deg"></i> Document Link</label>
                        <input type="url" name="document_link" id="editDocumentLink" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2"><i class="bi bi-card-heading"></i> Document Title <span class="text-red-500">*</span></label>
                            <input type="text" name="subject_title" id="editSubjectTitle" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2"><i class="bi bi-person-badge"></i> Focal Person <span class="text-red-500">*</span></label>
                            <select name="focal_person" id="editFocalPerson" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                                <option value="{{ auth()->user()->name }}">{{ auth()->user()->name }} (You)</option>
                                @foreach ($users as $user)
                                    @if ($user->id !== auth()->id())
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2"><i class="bi bi-chat-left-text"></i> Remarks</label>
                            <textarea name="remarks" id="editRemarks" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                        <button type="button" class="close-modal px-5 py-2 border border-gray-300 rounded-full hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="px-5 py-2 bg-yellow-600 text-white rounded-full hover:bg-yellow-700">Update Document</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Report Modal -->
   <div id="viewModal" class="fixed inset-0 z-[100000] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
        
        <div class="sticky top-0 bg-white border-b border-gray-100 px-8 py-5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="h-8 w-1.5 bg-yellow-500 rounded-full"></div>
                <h4 id="viewSubject" class="text-xl font-black text-gray-900 tracking-tight">Document Title</h4>
            </div>
            <button class="close-modal p-2 hover:bg-gray-100 rounded-full transition-colors text-gray-400 hover:text-gray-900">
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <div class="p-8 bg-gray-50/50 overflow-y-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h6 class="font-black uppercase text-[11px] tracking-widest text-gray-400 mb-4 flex items-center gap-2">
                            <i class="bi bi-paperclip text-yellow-500 text-base"></i> Attached Files
                        </h6>
                        <div id="viewFiles" class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-gray-600 font-medium">
                            No files attached.
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h6 class="font-black uppercase text-[11px] tracking-widest text-gray-400 mb-4 flex items-center gap-2">
                            <i class="bi bi-chat-left-text text-yellow-500 text-base"></i> Last Comment
                        </h6>
                        <div id="viewLastComment" class="p-4 bg-gray-50 rounded-xl border border-gray-100 min-h-[120px] text-gray-700 leading-relaxed">
                            No comments.
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2 block">Current Status</label>
                        <span id="viewStatus" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200">
                            <i class="bi bi-info-circle-fill"></i> Draft
                        </span>
                    </div>

                    <div>
                        <label class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1 block">Focal Person</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <p id="viewFocal" class="font-bold text-gray-900 text-lg">—</p>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2 block">Type of Paper</label>
                        <div id="viewTypeOfPaper" class="p-3.5 bg-gray-50 rounded-xl border border-gray-100 text-gray-700 font-medium">
                            —
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-2 block">Document Link</label>
                        <div id="viewDocumentLinkWrapper">
                            <a id="viewDocumentLink" href="#" target="_blank" 
                               class="hidden group relative w-full flex items-center justify-center gap-2 bg-gray-900 text-white px-4 py-3.5 rounded-2xl font-bold transition-all duration-300 hover:bg-yellow-500 hover:text-gray-900 hover:shadow-lg hover:shadow-yellow-200 active:scale-95 no-underline">
                                <i class="bi bi-box-arrow-up-right text-yellow-400 group-hover:text-gray-900 transition-colors"></i>
                                <span>Open Document</span>
                            </a>
                            
                            <div id="viewNoDocumentLink" class="flex items-center gap-2 p-3.5 bg-gray-100 rounded-2xl text-gray-400 text-xs font-medium border border-dashed border-gray-300">
                                <i class="bi bi-link-45deg text-lg"></i>
                                No link provided.
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2 text-xs text-gray-400 font-medium">
                            <i class="bi bi-calendar-check text-yellow-500"></i> 
                            <span>Created:</span> 
                            <span id="viewCreated" class="text-gray-600 font-bold"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-t border-gray-100 px-8 py-4 flex justify-end">
            <button class="close-modal px-8 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl transition-all active:scale-95">
                Close
            </button>
        </div>
    </div>
</div>
<!-- ==================== READY TO PRINT MODAL (Separate) ==================== -->
<div id="readyToPrintModal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-hidden flex flex-col transform transition-all border border-slate-100">
        
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <div>
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="p-2 bg-indigo-100 text-indigo-600 rounded-xl">
                        <i class="bi bi-printer"></i>
                    </span>
                    Ready to Print
                </h3>
                <p class="text-sm text-slate-500 mt-1">Confirm that the document is ready for printing.</p>
            </div>
            <button class="close-rtp-modal p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Error message area -->
        <div id="rtpModalError" class="hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
            <div class="flex items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span id="rtpModalErrorMsg"></span>
            </div>
        </div>

        <div class="p-8 overflow-y-auto custom-scrollbar">
            <form method="POST" action="" id="readyToPrintForm" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="action" value="approve">
                <!-- We'll set assign_to to the uploader's ID via JavaScript -->
                <input type="hidden" name="assign_to" id="rtpAssignTo">

                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-4 text-center">
                    <p id="rtpDocTitle" class="text-indigo-700 font-semibold text-sm tracking-wide uppercase"></p>
                </div>

                <!-- Only a comment field -->
                <div class="space-y-1">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Comment <span class="text-slate-400 font-normal">(optional)</span></label>
                    <textarea name="comment" rows="3" 
                              placeholder="Add any final notes before printing..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none resize-none"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                    <button type="button" class="close-rtp-modal order-2 sm:order-1 px-6 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="order-1 sm:order-2 px-8 py-3 bg-indigo-600 text-white text-sm font-bold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 active:scale-95 transition-all">
                        Confirm Ready to Print
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="bg-red-600 text-white px-6 py-4 rounded-t-2xl">
                <h5 class="text-xl font-bold">Confirm Deletion</h5>
            </div>
            <div class="p-6 text-center">
                <p id="deleteMessage">Are you sure you want to delete this document?</p>
            </div>
            <div class="flex justify-center gap-3 p-4 border-t border-gray-200">
                <button type="button" class="close-modal px-5 py-2 border border-gray-300 rounded-full hover:bg-gray-100">Cancel</button>
                <form method="POST" id="deleteForm">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-full hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
        <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3 pointer-events-none">
    </div>

    <script>
        // ==================== TOAST NOTIFICATION ====================
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = `rounded-lg shadow-lg px-4 py-2 text-white ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} transition transform duration-300 flex items-center gap-2`;
            toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'}"></i>${message}`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }

        // ==================== MODAL MANAGEMENT ====================
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('.fixed.inset-0');
                if (modal) closeModal(modal.id);
            });
        });
        document.querySelectorAll('.fixed.inset-0').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) closeModal(this.id);
            });
        });

        // ==================== TABS ====================
        const uploadedTab = document.getElementById('uploadedTabBtn');
        const taskTab = document.getElementById('taskTabBtn');
        const uploadedPanel = document.getElementById('uploadedPanel');
        const taskPanel = document.getElementById('taskPanel');
        function activateTab(tabId) {
            // Remove active classes from both tabs
            uploadedTab.classList.remove('border-b-2', 'border-yellow-500', 'text-yellow-600');
            taskTab.classList.remove('border-b-2', 'border-yellow-500', 'text-yellow-600');
            // Hide both panels
            uploadedPanel.classList.add('hidden');
            taskPanel.classList.add('hidden');
            if (tabId === 'uploaded') {
                uploadedTab.classList.add('border-b-2', 'border-yellow-500', 'text-yellow-600');
                uploadedPanel.classList.remove('hidden');
            } else {
                taskTab.classList.add('border-b-2', 'border-yellow-500', 'text-yellow-600');
                taskPanel.classList.remove('hidden');
            }
        }
        uploadedTab.addEventListener('click', () => activateTab('uploaded'));
        taskTab.addEventListener('click', () => activateTab('task'));
        // Default active tab
        activateTab('uploaded');

        // ==================== OPEN UPLOAD MODAL ====================
        document.getElementById('openUploadModalBtn')?.addEventListener('click', () => {
            // Check if user is Technical Inspector
            const uploadBtn = document.getElementById('openUploadModalBtn');
            const isTechInspector = uploadBtn.getAttribute('data-is-tech-inspector') === 'true';
            if (isTechInspector) {
                showToast('Technical Inspector has read-only access. You cannot upload documents.', 'error');
                return;
            }
            openModal('uploadModal');
        });

      // ==================== DELETE MODAL (AJAX) ====================
const deleteModal = document.getElementById('deleteModal');
const deleteForm = document.getElementById('deleteForm'); // we won't actually submit this form

// Remove the traditional form submission – we'll use fetch
document.querySelectorAll('.delete-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');

        // Store the document ID and card element for later use
        window.deleteDocId = id;
        window.deleteCard = this.closest('.doc-card');

        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete <strong>${title}</strong>?`;
        openModal('deleteModal');
    });
});

// Handle the confirm button click (inside the modal)
const confirmDeleteBtn = document.querySelector('#deleteModal button[type="submit"]');
if (confirmDeleteBtn) {
    // Remove old event listeners (if any) and attach a new one
    const newConfirmBtn = confirmDeleteBtn.cloneNode(true);
    confirmDeleteBtn.parentNode.replaceChild(newConfirmBtn, confirmDeleteBtn);

    newConfirmBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const docId = window.deleteDocId;
        if (!docId) {
            closeModal('deleteModal');
            return;
        }

        // Show a loading state on the button
        const originalText = newConfirmBtn.innerHTML;
        newConfirmBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Deleting...';
        newConfirmBtn.disabled = true;

        fetch(`/documents-process/${docId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the document card from the DOM
                if (window.deleteCard) {
                    window.deleteCard.remove();
                }
                // Update the uploaded documents count badge
                const uploadedCountSpan = document.querySelector('#uploadedTabBtn span:last-child');
                if (uploadedCountSpan) {
                    let currentCount = parseInt(uploadedCountSpan.innerText) || 0;
                    uploadedCountSpan.innerText = Math.max(0, currentCount - 1);
                }
                showToast(data.message || 'Document deleted successfully.', 'success');
                closeModal('deleteModal');
            } else {
                showToast(data.message || 'Failed to delete document.', 'error');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            showToast('An unexpected error occurred. Please try again.', 'error');
        })
        .finally(() => {
            newConfirmBtn.innerHTML = originalText;
            newConfirmBtn.disabled = false;
            delete window.deleteDocId;
            delete window.deleteCard;
        });
    });
}
// ==================== WORKFLOW MODAL ====================
const workflowModal = document.getElementById('workflowModal');
const workflowForm = document.getElementById('workflowForm');
const assigneeField = document.getElementById('assigneeField');
const workflowAssigneeSelect = document.getElementById('workflowAssigneeSelect');
const attachmentFields = document.getElementById('attachmentFields');
const revisionFields = document.getElementById('revisionSpecificFields');
const modalLinkInput = document.getElementById('modalLinkInput');
const modalCurrentFile = document.getElementById('modalCurrentFile');

// Store existing document data when opening modal
let currentDocExistingLink = '';
let currentDocExistingFiles = '';

document.querySelectorAll('.workflow-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const docId = this.getAttribute('data-doc-id');
        const docTitle = this.getAttribute('data-doc-title');
        const action = this.getAttribute('data-action');
        const label = this.getAttribute('data-label');
        
        // Debug logging
        console.log('Workflow trigger clicked:', {
            docId: docId,
            docTitle: docTitle,
            action: action,
            label: label
        });
        let needsAssignee = this.getAttribute('data-needs-assignee') === 'true';
        const docLink = this.getAttribute('data-document-link');
        const rawFiles = this.getAttribute('data-files');
        const uploaderId = this.getAttribute('data-uploader-id');   // ✅ added

        // ✅ Remove any previously existing hidden assign_to input (to avoid duplicates)
        const oldHidden = workflowForm.querySelector('input[name="assign_to"]');
        if (oldHidden && oldHidden.type === 'hidden') oldHidden.remove();

        // Store existing data for validation
        currentDocExistingLink = docLink || '';
        try {
            currentDocExistingFiles = JSON.parse(rawFiles || '[]');
        } catch(e) {
            currentDocExistingFiles = [];
        }

        workflowForm.setAttribute('action', `/document-process/${docId}/workflow`);
        document.getElementById('workflowAction').value = action;
        document.getElementById('workflowDocTitle').innerText = docTitle;
        const submitBtn = workflowModal.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.innerText = label;

        // Determine which users to show in assignee dropdown
        if (needsAssignee) {
            // Show ALL users (no restriction)
            const usersToShow = window.allUsers || [];

            let options = '<option value="" selected disabled>Select team member</option>';
            usersToShow.forEach(user => {
                options += `<option value="${user.id}">${user.name}</option>`;
            });
            workflowAssigneeSelect.innerHTML = options;
            assigneeField.classList.remove('hidden');
        }

        // ✅ Special handling for revise: auto-assign to uploader, hide dropdown
        if (action === 'revise' && uploaderId) {
            const hiddenAssign = document.createElement('input');
            hiddenAssign.type = 'hidden';
            hiddenAssign.name = 'assign_to';
            hiddenAssign.value = uploaderId;
            workflowForm.appendChild(hiddenAssign);
            assigneeField.classList.add('hidden');
        }

        // Determine if this action requires file upload
        const fileRequiringActions = ['revise', 'send', 'resend', 'send_for_review', 'resend_for_review'];
        if (fileRequiringActions.includes(action)) {
            attachmentFields.classList.remove('hidden');
            revisionFields.classList.remove('hidden');
            if (modalLinkInput) modalLinkInput.value = docLink || '';
            if (modalCurrentFile) {
                if (currentDocExistingFiles.length) {
                    modalCurrentFile.innerHTML = currentDocExistingFiles.map(f => `<div class="flex items-center gap-1 mb-1"><i class="bi bi-file-earmark-pdf text-danger"></i> ${f.split('/').pop()}</div>`).join('');
                } else {
                    modalCurrentFile.innerHTML = '<span class="text-muted small fst-italic">No current file uploaded</span>';
                }
            }
        } else if (action === 'approve') {
            // For the "Ready to print" action (approve on Approved by Reviewer status), show only comment
            attachmentFields.classList.remove('hidden');
            revisionFields.classList.add('hidden');
            // Also hide the file/link specific parts (they are inside revisionSpecificFields which is already hidden)
        } else {
            // For other actions (e.g., complete, etc.) show comment only
            attachmentFields.classList.remove('hidden');
            revisionFields.classList.add('hidden');
        }
        // Clear previous error
        const workflowModalError = document.getElementById('workflowModalError');
        const workflowModalErrorMsg = document.getElementById('workflowModalErrorMsg');
        if (workflowModalError) workflowModalError.classList.add('hidden');
        if (workflowModalErrorMsg) workflowModalErrorMsg.innerText = '';

        openModal('workflowModal');
    });
});
// ---------------------------
// WORKFLOW MODAL VALIDATION
// ---------------------------
const workflowModalError = document.getElementById('workflowModalError');
const workflowModalErrorMsg = document.getElementById('workflowModalErrorMsg');

// Validate before submitting workflow form
workflowForm.addEventListener('submit', function(e) {
    e.preventDefault(); // manual validation then submit

    // Hide previous error
    if (workflowModalError) workflowModalError.classList.add('hidden');
    if (workflowModalErrorMsg) workflowModalErrorMsg.innerText = '';

    const action = document.getElementById('workflowAction').value;
    const needsAssignee = !assigneeField.classList.contains('hidden');
    const assigneeSelect = workflowAssigneeSelect;
    
    const fileRequiringActions = ['revise', 'send', 'resend', 'send_for_review', 'resend_for_review'];
    const isFileRequiring = fileRequiringActions.includes(action);
    
    const fileInput = document.querySelector('#workflowModal input[type="file"]');
    const linkInput = document.getElementById('modalLinkInput');
    const hasUserFile = fileInput && fileInput.files.length > 0;
    const hasUserLink = linkInput && linkInput.value.trim() !== '';

    // Check existing document content
    const hasExistingFile = currentDocExistingFiles.length > 0;
    const hasExistingLink = currentDocExistingLink.trim() !== '';

    let errorMsg = '';

    // 1. Assignee validation
    if (needsAssignee && (!assigneeSelect || !assigneeSelect.value)) {
        errorMsg = 'Please select a person to assign this task to.';
    }
    // 2. File/link validation for revise/send actions
    else if (isFileRequiring) {
        const hasExisting = hasExistingFile || hasExistingLink;
        const hasUserProvided = hasUserFile || hasUserLink;
        
        if (!hasExisting && !hasUserProvided) {
            errorMsg = 'This document has no file or link attached. You must provide either a revised file or a document link to proceed.';
        }
        // If document already has a file or link, user can proceed even without new upload/link.
    }

    if (errorMsg) {
        if (workflowModalErrorMsg) workflowModalErrorMsg.innerText = errorMsg;
        if (workflowModalError) workflowModalError.classList.remove('hidden');
        if (workflowModalError) workflowModalError.scrollIntoView({ behavior: 'smooth', block: 'start' });
        return;
    }

    // If validation passes, submit the form via AJAX to show toast
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn ? submitBtn.innerHTML : '';
    if (submitBtn) submitBtn.disabled = true;
    if (submitBtn) submitBtn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i> Processing...';

    fetch(this.getAttribute('action'), {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message || 'Action completed successfully.', 'success');
            closeModal('workflowModal');
            setTimeout(() => window.location.reload(), 1500);
        } else {
            showToast(data.message || 'Action failed.', 'error');
            if (submitBtn) submitBtn.disabled = false;
            if (submitBtn) submitBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Workflow action error:', error);
        showToast('An unexpected error occurred. Please try again.', 'error');
        if (submitBtn) submitBtn.disabled = false;
        if (submitBtn) submitBtn.innerHTML = originalText;
    });
});

// ---------------------------
// UPLOAD MODAL VALIDATION
// ---------------------------
const uploadForm = document.querySelector('#uploadModal form');
const uploadModalError = document.getElementById('uploadModalError');
const uploadModalErrorMsg = document.getElementById('uploadModalErrorMsg');

if (uploadForm) {
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (uploadModalError) uploadModalError.classList.add('hidden');
        let errors = [];
        
        // Clear any previous error message
        if (uploadModalErrorMsg) uploadModalErrorMsg.innerText = '';

        // Required text fields (file and link are optional)
        const title = this.querySelector('input[name="subject_title"]')?.value.trim();
        const focal = this.querySelector('select[name="focal_person"]')?.value;
        const section = this.querySelector('select[name="section"]')?.value;
        const type = this.querySelector('input[name="type_of_paper"]')?.value?.trim();
        const typeOfPaperOther = this.querySelector('input[name="type_of_paper_other"]')?.value?.trim();
        
        if (!title) errors.push('Document title is required.');
        if (!focal) errors.push('Focal person is required.');
        if (!section) errors.push('Section is required.');
        if (!type) errors.push('Type of paper is required.');
        if (type === 'Others' && !typeOfPaperOther) errors.push('Please specify the type of paper.');

        // File size validation (5MB per file)
        const fileInput = this.querySelector('input[name="documents[]"]');
        if (fileInput && fileInput.files.length > 0) {
            const maxSize = 5 * 1024 * 1024;
            Array.from(fileInput.files).forEach(file => {
                if (file.size > maxSize) {
                    const fileSizeMb = (file.size / 1024 / 1024).toFixed(1);
                    errors.push(`${file.name} (${fileSizeMb}MB) exceeds the 5MB per-file limit. Please use the "Document Link" field instead for larger files.`);
                }
            });
        }

        if (errors.length > 0) {
            // Clear any previous timeout
            if (window.errorTimeout) {
                clearTimeout(window.errorTimeout);
            }
            
            // Clear previous error completely before setting new one
            if (uploadModalErrorMsg) {
                uploadModalErrorMsg.innerText = '';
                setTimeout(() => {
                    uploadModalErrorMsg.innerText = errors.join(' ');
                }, 10);
            }
            if (uploadModalError) {
                uploadModalError.classList.remove('hidden');
                uploadModalError.classList.remove('fade-out');
                
                // Auto-hide after 10 seconds
                window.errorTimeout = setTimeout(() => {
                    uploadModalError.classList.add('fade-out');
                    setTimeout(() => {
                        uploadModalError.classList.add('hidden');
                        uploadModalError.classList.remove('fade-out');
                    }, 500);
                }, 10000);
            }
            return;
        }

        this.submit();
    });
}

        // ==================== VIEW MODAL ====================
        const viewModal = document.getElementById('viewModal');
        document.querySelectorAll('.doc-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('button') || e.target.closest('a') || e.target.closest('.workflow-trigger') || e.target.closest('.download-btn') || e.target.closest('.delete-trigger')) return;
                const title = this.dataset.docTitle;
                const focal = this.dataset.docFocal;
                const status = this.dataset.docStatus;
                const created = this.dataset.docCreated;
                const lastComment = this.dataset.docLastComment;
                const docLink = this.dataset.docLink;
                let files = [];
                try { files = JSON.parse(this.dataset.docFiles || '[]'); } catch(e) {}

                document.getElementById('viewSubject').textContent = title || '—';
                document.getElementById('viewFocal').textContent = focal || '—';
                const paperType = this.dataset.docTypeOfPaper || '';
                const otherPaperType = this.dataset.docTypeOfPaperOther || '';
                document.getElementById('viewTypeOfPaper').textContent = paperType === 'Others' && otherPaperType
                    ? `Others: ${otherPaperType}`
                    : paperType || '—';
                document.getElementById('viewLastComment').textContent = lastComment || 'No comments.';
                document.getElementById('viewCreated').textContent = created || '—';

                const statusSpan = document.getElementById('viewStatus');
                if (statusSpan) {
                    let bgClass = 'bg-gray-100 text-gray-800';
                    switch (status) {
                        case 'Draft': bgClass = 'bg-gray-500 text-white'; break;
                        case 'Pending Review': bgClass = 'bg-yellow-500 text-white'; break;
                        case 'Revision Required': bgClass = 'bg-red-500 text-white'; break;
                        case 'Approved by Reviewer': bgClass = 'bg-blue-500 text-white'; break;
                        case 'Pending Chief Approval': bgClass = 'bg-purple-500 text-white'; break;
                        case 'Ready for Printing': bgClass = 'bg-indigo-500 text-white'; break;
                        case 'Complete': bgClass = 'bg-green-500 text-white'; break;
                    }
                    statusSpan.className = `inline-block px-4 py-2 rounded-full text-sm font-semibold ${bgClass}`;
                    statusSpan.innerHTML = `<i class="bi bi-info-circle"></i> ${status}`;
                }

                const linkBtn = document.getElementById('viewDocumentLink');
                const noLinkDiv = document.getElementById('viewNoDocumentLink');
                if (docLink && docLink.trim()) {
                    linkBtn.href = docLink;
                    linkBtn.classList.remove('hidden');
                    noLinkDiv.classList.add('hidden');
                } else {
                    linkBtn.classList.add('hidden');
                    noLinkDiv.classList.remove('hidden');
                }

                const filesDiv = document.getElementById('viewFiles');
                if (files.length) {
                    filesDiv.innerHTML = files.map(f => {
                        const filename = f.split('/').pop();
                        const downloadUrl = '/document-process/download/' + encodeURIComponent(f);
                        return `<a href="${downloadUrl}" target="_blank" class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm mr-2 mb-2 hover:bg-blue-200 transition">${filename}</a>`;
                    }).join('');
                } else {
                    filesDiv.innerHTML = '<span class="text-gray-500">No files attached.</span>';
                }

                openModal('viewModal');
            });
        });

        // ==================== DOCUMENT OPEN BUTTON ====================
        document.querySelectorAll('.doc-open-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const link = this.getAttribute('data-document-link');
                if (link && link.trim()) window.open(link, '_blank');
                else showToast('No document link provided.', 'error');
            });
        });

        // ==================== DOWNLOAD BUTTON ====================
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                let files = [];
                try { files = JSON.parse(this.getAttribute('data-file') || '[]'); } catch(e) {}
                if (!files.length) {
                    showToast('No file attached to download.', 'error');
                    return;
                }
                const filePath = files[0];
                const filename = filePath.split('/').pop();
                const a = document.createElement('a');
                a.href = '/document-process/download/' + encodeURIComponent(filePath);
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });
        });

        // ==================== EDIT MODAL HANDLER ====================
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editDocumentForm');
        const editSubject = document.getElementById('editSubjectTitle');
        const editLink = document.getElementById('editDocumentLink');
        const editRemarks = document.getElementById('editRemarks');
        const editFocal = document.getElementById('editFocalPerson');
        const currentFilesList = document.getElementById('currentFilesList');

        // ==================== EDIT TRIGGER HANDLERS ====================
        // Open edit modal when clicking an "Edit" button
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-trigger')) {
                e.stopPropagation();
                const btn = e.target.closest('.edit-trigger');
                const docId = btn.getAttribute('data-doc-id');
                const docTitle = btn.getAttribute('data-doc-title');
                const docFocal = btn.getAttribute('data-doc-focal');
                const docLink = btn.getAttribute('data-doc-link');
                const docRemarks = btn.getAttribute('data-doc-remarks');
                const docSection = btn.getAttribute('data-doc-section');
                
                // Set form action
                editForm.setAttribute('action', `/documents/${docId}`);
                
                // Populate form fields
                editSubject.value = docTitle || '';
                editLink.value = docLink || '';
                editRemarks.value = docRemarks || '';
                
                // Set focal person
                if (editFocal) {
                    const options = editFocal.querySelectorAll('option');
                    options.forEach(option => {
                        option.selected = option.textContent === docFocal || option.value === docFocal;
                    });
                }
                
                // Show current files if any
                if (currentFilesList) {
                    const docCard = document.querySelector(`[data-id="${docId}"]`);
                    if (docCard) {
                        const files = docCard.getAttribute('data-doc-files');
                        if (files && files !== 'null' && files !== '[]') {
                            try {
                                const fileArray = JSON.parse(files);
                                if (fileArray && fileArray.length > 0) {
                                    currentFilesList.innerHTML = '<div class="text-sm font-semibold mb-1">Current files:</div>' +
                                        fileArray.map(file => {
                                            const filename = file.split('/').pop() || file;
                                            return `<div class="text-xs text-gray-600">• ${filename}</div>`;
                                        }).join('');
                                }
                            } catch (e) {
                                currentFilesList.innerHTML = '';
                            }
                        } else {
                            currentFilesList.innerHTML = '';
                        }
                    }
                }
                
                openModal('editModal');
            }
        });

        // Close edit modal
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                closeModal('editModal');
            });
        });

        // Click outside to close edit modal
        editModal?.addEventListener('click', function(e) {
            if (e.target === this) closeModal('editModal');
        });

        // ==================== UPLOAD FILE LIST HANDLERS ====================
        window.updateFileList = function(input) {
            const fileListDiv = document.getElementById('fileList');
            if (!fileListDiv) return;
            const files = Array.from(input.files);
            if (!files.length) { fileListDiv.innerHTML = ''; return; }
            fileListDiv.innerHTML = files.map(f => `<div><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ${f.name}</div>`).join('');
        };
        window.updateEditFileList = function(input) {
            const fileListDiv = document.getElementById('editFileList');
            if (!fileListDiv) return;
            const files = Array.from(input.files);
            if (!files.length) { fileListDiv.innerHTML = ''; return; }
            fileListDiv.innerHTML = files.map(f => `<div><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ${f.name}</div>`).join('');
        };

        // ==================== AUTO REFRESH ON PROCESS UPDATES ====================
        let lastAssignedCount = null;
        let lastWorkflowUpdate = null;
        let isReloadingForWorkflow = false;

        function reloadForWorkflowUpdate(message) {
            if (isReloadingForWorkflow) {
                return;
            }

            isReloadingForWorkflow = true;
            showToast(message, 'success');
            setTimeout(() => window.location.reload(), 1200);
        }

        async function checkWorkflowUpdates() {
            try {
                const [countResponse, latestResponse] = await Promise.all([
                    fetch("{{ route('documents.workflow.assigned-count') }}", {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    }),
                    fetch("{{ route('documents.workflow.check-updates') }}", {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                ]);

                if (!countResponse.ok || !latestResponse.ok) {
                    throw new Error('Failed to fetch workflow updates');
                }

                const countData = await countResponse.json();
                const latestData = await latestResponse.json();

                const currentCount = Number(countData.count ?? 0);
                const currentLatest = latestData.latest ?? null;

                if (lastAssignedCount === null && lastWorkflowUpdate === null) {
                    lastAssignedCount = currentCount;
                    lastWorkflowUpdate = currentLatest;
                    return;
                }

                if (currentCount > lastAssignedCount) {
                    reloadForWorkflowUpdate('New process task assigned to you. Refreshing...');
                    return;
                }

                if (currentLatest !== null && lastWorkflowUpdate !== null && currentLatest > lastWorkflowUpdate) {
                    reloadForWorkflowUpdate('Your process tasks were updated. Refreshing...');
                    return;
                }

                lastAssignedCount = currentCount;
                lastWorkflowUpdate = currentLatest;
            } catch (err) {
                console.warn('Workflow update check failed:', err);
            }
        }

        setInterval(checkWorkflowUpdates, 10000);
        window.addEventListener('DOMContentLoaded', checkWorkflowUpdates);

        // ==================== SUCCESS/ERROR TOASTS FROM SESSION ====================
        @if(session('success'))
            window.addEventListener('load', () => showToast("{{ session('success') }}", 'success'));
        @endif
        @if(session('error'))
            window.addEventListener('load', () => showToast("{{ session('error') }}", 'error'));
        @endif

        function activateTab(tabId) {
            uploadedTab.classList.remove('bg-white', 'text-yellow-600');
            uploadedTab.classList.add('bg-gray-200', 'text-gray-700');
            taskTab.classList.remove('bg-white', 'text-yellow-600');
            taskTab.classList.add('bg-gray-200', 'text-gray-700');

            uploadedPanel.classList.add('hidden');
            taskPanel.classList.add('hidden');

            if (tabId === 'uploaded') {
                uploadedTab.classList.remove('bg-gray-200', 'text-gray-700');
                uploadedTab.classList.add('bg-white', 'text-yellow-600');
                uploadedPanel.classList.remove('hidden');
            } else {
                taskTab.classList.remove('bg-gray-200', 'text-gray-700');
                taskTab.classList.add('bg-white', 'text-yellow-600');
                taskPanel.classList.remove('hidden');
            }
        }

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                icon.classList.replace('bi-sun', 'bi-moon-stars');
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                icon.classList.replace('bi-moon-stars', 'bi-sun');
            }
            if (window.navigator.vibrate) window.navigator.vibrate(10);
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(t => {
                    t.classList.remove('active-tab', 'text-gray-800', 'bg-white');
                    t.classList.add('text-gray-400');
                });
                this.classList.add('active-tab', 'text-gray-800', 'bg-white');
                this.classList.remove('text-gray-400');
            });
        });
// ==================== DRAG & DROP FOR UPLOAD MODAL ====================
const dropZone = document.getElementById('uploadDropZone');
const fileInput = document.getElementById('fileInput');

if (dropZone && fileInput) {
    let ignoreNextClick = false;

    // Prevent default drag behaviors on the whole window
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        window.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop zone
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('drag-over');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('drag-over');
        }, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        // Mark that a drop just happened – ignore the next click
        ignoreNextClick = true;
        setTimeout(() => { ignoreNextClick = false; }, 200);

        const files = e.dataTransfer.files;
        if (!files.length) return;

        // Filter only PDF files
        const validFiles = Array.from(files).filter(file => file.type === 'application/pdf');
        const invalidCount = files.length - validFiles.length;

        if (invalidCount > 0) {
            showToast(`${invalidCount} file(s) skipped. Only PDF files are allowed.`, 'error');
        }

        if (validFiles.length === 0) return;

        // Update file input
        const dataTransfer = new DataTransfer();
        validFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;

        // Update file list display
        if (typeof window.updateFileList === 'function') {
            window.updateFileList(fileInput);
        } else {
            const fileListDiv = document.getElementById('fileList');
            if (fileListDiv) {
                fileListDiv.innerHTML = validFiles.map(f => 
                    `<div><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ${f.name}</div>`
                ).join('');
            }
        }

        // Fire change event
        const changeEvent = new Event('change', { bubbles: true });
        fileInput.dispatchEvent(changeEvent);

        showToast(`${validFiles.length} file(s) added.`, 'success');
    }

    // Intercept the click on the drop zone to prevent the file dialog after a drop
    dropZone.addEventListener('click', (e) => {
        if (ignoreNextClick) {
            e.stopPropagation();
            return;
        }
        // Otherwise, open the file picker normally
        fileInput.click();
    });
}
// ==================== APPROVAL MODAL HANDLING ====================
const approvalModal = document.getElementById('approvalModal');
const approvalForm = document.getElementById('approvalForm');
const approvalAssigneeSelect = document.getElementById('approvalAssigneeSelect');
const approvalDocTitle = document.getElementById('approvalDocTitle');

// Open approval modal when clicking an "Approve" button
document.querySelectorAll('.approve-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const docId = this.getAttribute('data-doc-id');
        const docTitle = this.getAttribute('data-doc-title');
        
        // Set form action
        approvalForm.setAttribute('action', `/document-process/${docId}/workflow`);
        approvalDocTitle.innerText = docTitle;
        
        // Clear previous error
        const approvalError = document.getElementById('approvalModalError');
        const approvalErrorMsg = document.getElementById('approvalModalErrorMsg');
        if (approvalError) approvalError.classList.add('hidden');
        if (approvalErrorMsg) approvalErrorMsg.innerText = '';
        
        openModal('approvalModal');
    });
});

// Close approval modal
document.querySelectorAll('.close-approval-modal').forEach(btn => {
    btn.addEventListener('click', function() {
        closeModal('approvalModal');
    });
});

// Click outside to close
approvalModal?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('approvalModal');
});

// Approval form validation
approvalForm?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const errorDiv = document.getElementById('approvalModalError');
    const errorMsg = document.getElementById('approvalModalErrorMsg');
    errorDiv?.classList.add('hidden');
    if (errorMsg) errorMsg.innerText = '';
    
    const assigneeValue = approvalAssigneeSelect?.value;
    if (!assigneeValue) {
        if (errorMsg) errorMsg.innerText = 'Please select a reviewer from Devision Chief or Assistant Chief';
        if (errorDiv) errorDiv.classList.remove('hidden');
        return;
    }
    
    this.submit();
});
// ==================== READY TO PRINT MODAL HANDLING ====================
const rtpModal = document.getElementById('readyToPrintModal');
const rtpForm = document.getElementById('readyToPrintForm');
const rtpDocTitle = document.getElementById('rtpDocTitle');
const rtpAssignTo = document.getElementById('rtpAssignTo');

// Open ready-to-print modal when clicking a "Ready to print" button
document.querySelectorAll('.ready-to-print-trigger').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const docId = this.getAttribute('data-doc-id');
        const docTitle = this.getAttribute('data-doc-title');
        const uploaderId = this.getAttribute('data-uploader-id');

        // Set form action
        rtpForm.setAttribute('action', `/document-process/${docId}/workflow`);
        rtpDocTitle.innerText = docTitle;
        rtpAssignTo.value = uploaderId;  // automatically assign back to uploader

        // Clear previous error
        const rtpError = document.getElementById('rtpModalError');
        const rtpErrorMsg = document.getElementById('rtpModalErrorMsg');
        if (rtpError) rtpError.classList.add('hidden');
        if (rtpErrorMsg) rtpErrorMsg.innerText = '';

        openModal('readyToPrintModal');
    });
});

// Close ready-to-print modal
document.querySelectorAll('.close-rtp-modal').forEach(btn => {
    btn.addEventListener('click', function() {
        closeModal('readyToPrintModal');
    });
});

// Click outside to close
rtpModal?.addEventListener('click', function(e) {
    if (e.target === this) closeModal('readyToPrintModal');
});

// No validation needed because comment is optional and assign_to is hidden
rtpForm?.addEventListener('submit', function(e) {
    // Optional: you can add validation if needed, but all fields are fine
    // Proceed with submit
});

// ==================== COMBOBOX FUNCTIONALITY ====================
document.addEventListener('DOMContentLoaded', function() {
    // Type of Paper Combobox
    const typeOfPaperInput = document.querySelector('input[name="type_of_paper"]');
    const typeOfPaperOtherGroup = document.querySelector('[data-type-of-paper-other-group]');
    const typeOfPaperOtherInput = document.querySelector('input[name="type_of_paper_other"]');

    function toggleOtherPaperType() {
        const isOther = typeOfPaperInput?.value.trim() === 'Others';
        typeOfPaperOtherGroup?.classList.toggle('hidden', !isOther);
        if (typeOfPaperOtherInput) {
            typeOfPaperOtherInput.disabled = !isOther;
            typeOfPaperOtherInput.required = isOther;
            if (!isOther) typeOfPaperOtherInput.value = '';
        }
    }
    
    if (typeOfPaperInput) {
        // Find the parent div and then find button and list
        const parentDiv = typeOfPaperInput.parentElement;
        const typeOfPaperBtn = parentDiv?.querySelector('.combobox-btn');
        const typeOfPaperList = parentDiv?.querySelector('.combobox-list');
        
        if (typeOfPaperBtn && typeOfPaperList) {
            // Toggle dropdown
            typeOfPaperBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                typeOfPaperList.classList.toggle('hidden');
            });
            
            // Handle option selection
            typeOfPaperList.addEventListener('click', function(e) {
                if (e.target.tagName === 'LI') {
                    e.preventDefault();
                    e.stopPropagation();
                    const value = e.target.getAttribute('data-value');
                    typeOfPaperInput.value = value;
                    typeOfPaperList.classList.add('hidden');
                    toggleOtherPaperType();
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!parentDiv.contains(e.target)) {
                    typeOfPaperList.classList.add('hidden');
                }
            });
            
            // Hide dropdown when input loses focus
            typeOfPaperInput.addEventListener('blur', function() {
                setTimeout(() => {
                    typeOfPaperList.classList.add('hidden');
                }, 200);
            });
            
            // Show dropdown when input is focused
            typeOfPaperInput.addEventListener('focus', function() {
                typeOfPaperList.classList.remove('hidden');
            });
            typeOfPaperInput.addEventListener('input', toggleOtherPaperType);
            toggleOtherPaperType();
        }
    }
});
    </script>
</x-app-layout>
