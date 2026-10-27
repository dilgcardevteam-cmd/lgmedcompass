<x-app-layout>
        @vite('resources/css/document.css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="py-1 bg-[#fcfcf9]">
        <div class="max-w-8xl mx-auto px-4">
            <div class="glass-panel rounded-[2.5rem] p-2 shadow-2xl shadow-gray-200/50">
                <div class="bg-white rounded-[2.2rem] p-8 lg:p-12 border border-gray-100">

                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12">
                        <div class="space-y-4">
                            <div class="inline-flex items-center gap-3 px-4 py-2 bg-yellow-50 rounded-2xl border border-yellow-100">
                                <i class="bi bi-file-earmark-text text-yellow-600 text-xl"></i>
                                <span class="text-sm font-black uppercase tracking-widest text-yellow-700">Repository</span>
                            </div>
                            <h2 class="text-5xl font-black text-gray-900 tracking-tight">Programs, Projects & Activities Tracker</h2>
                            <p class="text-gray-500 text-lg font-medium max-w-xl">A visual and interactive overview of all tracked PPA records.</p>
                            
                            <div class="flex flex-wrap items-center gap-3 mt-6">
                            @if($dueTodayCount > 0)
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'due_today']) }}"
                                class="bg-red-500 text-white rounded-full px-5 py-2 text-xs font-bold no-underline hover:bg-red-600 transition shadow-lg shadow-red-200 flex items-center gap-2">
                                    <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                    {{ $dueTodayCount }} Due Today
                                </a>
                            @endif

                            @if($upcomingCount > 0)
                                <a href="{{ request()->fullUrlWithQuery(['filter' => 'upcoming']) }}"
                                class="bg-yellow-400 text-yellow-900 rounded-full px-5 py-2 text-xs font-bold no-underline hover:bg-yellow-500 transition shadow-lg shadow-yellow-100 flex items-center gap-2">
                                    <i class="bi bi-bell-fill"></i> {{ $upcomingCount }} Upcoming
                                </a>
                            @endif

                            @if(request('filter') || request('search') || request('section'))
                                <a href="{{ route('documents.index') }}" 
                                class="group flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 bg-white text-gray-400 hover:text-red-500 hover:border-red-100 hover:bg-red-50 transition-all no-underline shadow-sm">
                                    <span class="text-[10px] font-black uppercase tracking-widest">Clear Filters</span>
                                    <i class="bi bi-x-circle-fill text-gray-300 group-hover:text-red-400 transition-colors"></i>
                                </a>
                            @endif
                            @if($dueTodayCount == 0 && $upcomingCount == 0)
                                <span class="text-xs text-gray-400 italic">No active alerts</span>
                            @endif
                        </div>

                            <form method="GET" action="{{ route('documents.index') }}" class="flex flex-wrap items-center gap-4 mt-8">
                                <div class="relative group">
                                    <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-yellow-600"></i>
                                    <input type="text" name="search" id="liveSearch" value="{{ request('search') }}" placeholder="Search files..." 
                                        class="pl-12 pr-6 py-3.5 w-72 border-0 bg-gray-50 rounded-2xl focus:ring-2 focus:ring-yellow-400 transition shadow-inner font-medium">
                                </div>
                                
                                @if(in_array(Auth::user()->role, ['Admin', 'Division Chief', 'Assistant Division Chief']))
                                    <select name="section" onchange="this.form.submit()"
                                            class="px-6 py-3.5 border-0 bg-gray-50 rounded-2xl focus:ring-2 focus:ring-yellow-400 transition shadow-inner font-bold text-gray-600 text-sm cursor-pointer appearance-none w-64 ">
                                        <option value="">All Sections</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </form>
                        </div>

                        <div class="flex items-center gap-4">
                            <button id="openUploadModalBtn"
                                    class="h-14 px-8 rounded-2xl bg-gray-900 text-white font-bold hover:bg-black transition-all hover:scale-105 active:scale-95 shadow-xl shadow-gray-200 flex items-center gap-2"
                                    data-is-tech-inspector="{{ Auth::user()->isTechnicalInspector() ? 'true' : 'false' }}">
                                <i class="bi bi-cloud-arrow-up text-lg"></i> Upload
                            </button>
                            <a href="{{ route('documents.archiveIndex') }}"
                                class="h-14 px-8 rounded-2xl bg-white border border-gray-200 text-gray-600 font-bold hover:bg-yellow-100 hover:text-yellow-600 hover:border-yellow-200 transition-all no-underline flex items-center gap-2 shadow-sm">
                                    <i class="bi bi-archive"></i> Archive
                                </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="documentResults">
                        @forelse($documents as $doc)
                            @php
                                // Get schedules and basic flags
                                $schedules = $doc->schedules->sortBy('due_date');
                                $isDone = $doc->status === 'Done';
                                
                                // Progress values (assume these are available from model accessors)
                                $percentage = $doc->effective_progress ?? 0;
                                $progressColor = $doc->progress_color ?? '#6c757d';

                                $dueDate = null;
                                $isOverdue = false;
                                $isDueSoon = false;
                                $isDueToday = false;
                                $dueDateRaw = null;

                                if ($isDone) {
                                    // Will show "Completed" in the blade
                                } else {
                                    $today = now()->toDateString();
                                    $activeSchedules = $schedules->filter(function ($schedule) {
                                        return in_array($schedule->status, ['pending', 'overdue', null], true);
                                    })->values();

                                    // 1) Look for a schedule due today
                                    $todaySchedule = $activeSchedules->first(function ($schedule) use ($today) {
                                        return \Carbon\Carbon::parse($schedule->due_date)->toDateString() === $today;
                                    });
                                    
                                    if ($todaySchedule) {
                                        $dueDateRaw = $todaySchedule->due_date;
                                        $isDueToday = true;
                                        $isOverdue = false;
                                        $isDueSoon = true;     // treat "today" as soon
                                    } else {
                                        // 2) No due today -> get next future schedule
                                        $nextSchedule = $activeSchedules
                                            ->filter(function ($schedule) {
                                                return \Carbon\Carbon::parse($schedule->due_date)->isFuture();
                                            })
                                            ->sortBy('due_date')
                                            ->first();
                                        
                                        if ($nextSchedule) {
                                            $dueDateRaw = $nextSchedule->due_date;
                                            $dueDate = \Carbon\Carbon::parse($dueDateRaw);
                                            $isOverdue = $dueDate->isPast();
                                            $isDueSoon = !$isOverdue && $dueDate->diffInDays(now(), false) >= -3;
                                        } else {
                                            // 3) No future schedules -> take the latest active one (overdue/today fallback)
                                            $lastSchedule = $activeSchedules->sortBy('due_date')->last();
                                            if ($lastSchedule) {
                                                $dueDateRaw = $lastSchedule->due_date;
                                                $dueDate = \Carbon\Carbon::parse($dueDateRaw);
                                                $isOverdue = true;
                                                $isDueSoon = false;
                                            }
                                        }
                                    }
                                    
                                    if ($dueDateRaw && !$dueDate) {
                                        $dueDate = \Carbon\Carbon::parse($dueDateRaw);
                                    }
                                    
                                    // 4) If no schedules found, check original deadlines for N/A handling
                                    if (!$dueDateRaw && $doc->deadlines) {
                                        foreach ($doc->deadlines as $deadline) {
                                            if (strtoupper(trim($deadline)) !== 'N/A') {
                                                // This is a valid date that wasn't processed yet
                                                $deadlineDate = \Carbon\Carbon::parse($deadline);
                                                if ($deadlineDate->isFuture() || $deadlineDate->isToday()) {
                                                    $dueDateRaw = $deadline;
                                                    $dueDate = $deadlineDate;
                                                    $isOverdue = $deadlineDate->isPast();
                                                    $isDueSoon = !$isOverdue && $deadlineDate->diffInDays(now(), false) >= -3;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }

                                $modalDeadline = $dueDate ? $dueDate->format('M-d-Y') : ($isDueToday ? 'Due Today' : 'No deadline');
                            @endphp

                            <div class="doc-card group bg-white rounded-[2rem] border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.03)] flex flex-col overflow-hidden relative">
                                
                                <button type="button" class="hidden view-trigger-btn"
                                            data-status="{{ $doc->status }}"
                                            data-subject="{{ $doc->subject_title }}"
                                            data-focal="{{ ucfirst($doc->focal_person) }}"
                                            data-created="{{ $doc->created_at->format('M d, Y • h:i A') }}"
                                            data-updated="{{ $doc->updated_at->format('M d, Y • h:i A') }}"
                                            data-deadline="{{ $modalDeadline }}"
                                            data-frequency="{{ ucfirst($doc->frequency) }}"
                                            data-reference="{{ $doc->reference ?? '' }}"
                                            data-mode="{{ $doc->mode_of_submission ?? '' }}"
                                            data-link="{{ $doc->cy_link ?? '' }}"
                                            data-document-link="{{ $doc->document_link ?? '' }}"
                                            data-remarks="{{ $doc->remarks ?? '' }}"
                                            data-who-will-comply='@json($doc->who_will_comply ?? [])'
                                            data-who-will-comply-other="{{ $doc->who_will_comply_other ?? '' }}"
                                            data-files='@json($doc->file_path ? json_decode($doc->file_path) : [])'>
                                    </button>

                                <div class="p-8 pb-4">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="h-10 w-10 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 font-black text-xs">
                                            DOC
                                        </div>

                                        <button type="button"
                                                class="doc-open-btn h-10 w-10 rounded-full bg-gray-50 text-gray-400 hover:bg-yellow-500 hover:text-white transition-all flex items-center justify-center"
                                                data-document-link="{{ $doc->document_link ?? '' }}"
                                                data-tooltip="Open document link">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </button>
                                    </div>
                                <h3 class="text-xl font-bold text-gray-900 leading-snug truncate group-hover:text-yellow-600 transition-colors cursor-default" title="{{ $doc->subject_title }}">
                                        {{ $doc->subject_title }}
                                    </h3>
                                </div>

                                <div class="px-8 py-4 bg-gray-50/50">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Project Completion</span>
                                        <span class="text-sm font-black text-gray-800">{{ $percentage }}%</span>
                                    </div>
                                    <div class="h-2.5 w-full bg-gray-200 rounded-full overflow-hidden shadow-inner">
                                        <div class="h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%; background-color: {{ $progressColor }}; box-shadow: 0 0 12px {{ $progressColor }}66;"></div>
                                    </div>
                                </div>

                                <div class="px-8 py-6 space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Current Status</span>
                                        <span class="status-badge px-4 py-2 rounded-full text-[10px] font-black uppercase tracking-widest text-center shadow-sm
                                            {{ $doc->status == 'Done' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $doc->status == 'In Progress' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $doc->status == 'To Do' ? 'bg-gray-100 text-gray-600' : '' }}
                                            {{ $doc->status == 'Incomplete' ? 'bg-red-100 text-red-700' : '' }}">
                                            {{ $doc->status }}
                                        </span>
                                    </div>

                                <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Due Date</span>
                                        @if($isDone)
                                            <span class="doc-due-date text-[11px] font-bold text-green-600 flex items-center gap-1">
                                                <i class="bi bi-check2-circle"></i> COMPLETED
                                            </span>
                                        @elseif($isDueToday)
                                            <span class="doc-due-date text-[11px] font-black text-red-500 flex items-center gap-1">
                                                <i class="bi bi-exclamation-triangle-fill"></i> DUE TODAY
                                            </span>
                                        @elseif($dueDate)
                                            <span class="doc-due-date text-[11px] font-black {{ $isOverdue ? 'text-red-500' : ($isDueSoon ? 'text-yellow-600' : 'text-gray-700') }}">
                                                {{ strtoupper($dueDate->format('M d, Y')) }}
                                            </span>
                                        @else
                                            <span class="doc-due-date text-[11px] font-bold text-gray-300 italic uppercase">TBD</span>
                                        @endif
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Section</span>
                                        <span class="text-[11px] font-bold text-gray-700 max-w-[200px] truncate"
                                            title="@if($doc->section){{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}@else Not specified @endif">
                                            @if($doc->section)
                                                {{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}
                                            @else
                                                Not specified
                                            @endif
                                        </span>
                                    </div>
                                                                    
                                </div>
                                <div class="px-8 pb-6">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 block mb-3">Attachments</span>
                                    
                                    @php
                                        $files = $doc->file_path ? json_decode($doc->file_path) : [];
                                        $fileCount = count($files);
                                    @endphp

                                    @if($fileCount > 0)
                                        <div class="relative group/download">
                                            {{-- Unified Dropdown Trigger --}}
                                            <button type="button" class="flex items-center justify-between w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-700 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-yellow-400 hover:text-yellow-900 hover:border-yellow-400 transition-all shadow-sm">
                                                <span class="flex items-center gap-2">
                                                    <i class="bi bi-paperclip text-sm"></i>
                                                    Files 
                                                    <span class="bg-gray-900 text-white group-hover/download:bg-yellow-900 group-hover/download:text-yellow-100 px-1.5 py-0.5 rounded-md text-[9px]">
                                                        {{ $fileCount }}
                                                    </span>
                                                </span>
                                                <i class="bi bi-chevron-down group-hover/download:rotate-180 transition-transform"></i>
                                            </button>

                                            {{-- Dropdown Menu (Appears on Hover) --}}
                                            <div class="absolute left-0 bottom-full mb-2 w-full bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-gray-100 py-2 z-30 opacity-0 invisible group-hover/download:opacity-100 group-hover/download:visible transition-all transform translate-y-2 group-hover/download:translate-y-0 backdrop-blur-sm bg-white/95">
                                                @foreach($files as $file)
                                                    <a href="{{ route('documents.download', base64_encode($file)) }}" download
                                                    class="flex items-center gap-3 px-4 py-3 text-[10px] font-bold text-gray-600 hover:bg-yellow-50 hover:text-yellow-700 no-underline transition-colors border-b border-gray-50 last:border-0 group/item">
                                                        <div class="h-6 w-6 rounded-lg bg-gray-100 flex items-center justify-center group-hover/item:bg-yellow-100 transition-colors">
                                                            <i class="bi bi-file-earmark-arrow-down text-gray-400 group-hover/item:text-yellow-600"></i>
                                                        </div>
                                                        <span class="truncate flex-1">{{ Str::afterLast($file, '/') }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        {{-- Empty State --}}
                                        <div class="flex items-center gap-2 px-4 py-3 bg-gray-50/50 border border-dashed border-gray-200 rounded-xl">
                                            <i class="bi bi-slash-circle text-gray-300"></i>
                                            <span class="text-[10px] font-bold text-gray-300 uppercase tracking-tight">No attachments</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-auto px-8 py-6 border-t border-gray-50 bg-white flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 rounded-lg bg-gray-900 text-white flex items-center justify-center text-[10px] font-bold">
                                            {{ strtoupper(substr($doc->focal_person ?? 'NA', 0, 2)) }}
                                        </div>
                                        <span class="text-xs font-bold text-gray-700">{{ $doc->focal_person ?? 'Unassigned' }}</span>
                                    </div>
                                    <div class="flex justify-end items-center gap-2 p-4 border-t border-gray-100 mt-auto bg-gray-50/30">
    
                                        <button class="complete-schedule-btn group relative flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-green-600 hover:border-green-200 hover:bg-green-50 shadow-sm transition-all duration-200"
                                                data-id="{{ $doc->id }}"
                                                data-tooltip="Complete next period">
                                            <i class="bi bi-check-circle text-lg transition-transform group-hover:scale-110"></i>
                                        </button>

                                        <button class="edit-btn group relative flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-yellow-600 hover:border-yellow-200 hover:bg-yellow-50 shadow-sm transition-all duration-200"
                                                data-target="editModal{{ $doc->id }}"
                                                data-tooltip="Edit document"
                                                data-is-tech-inspector="{{ Auth::user()->isTechnicalInspector() ? 'true' : 'false' }}">
                                            <i class="bi bi-pencil text-base transition-transform group-hover:scale-110"></i>
                                        </button>

                                        @if(Auth::user()->role === 'Admin' || Auth::user()->name === $doc->focal_person)
                                            <button type="button" class="delete-btn group relative flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-yellow-600 hover:border-yellow-200 hover:bg-yellow-50 shadow-sm transition-all duration-200"
                                                    data-action="{{ route('documents.destroy', $doc->id) }}"
                                                    data-title="{{ $doc->subject_title }}"
                                                    data-tooltip="Archive document">
                                                <i class="bi bi-archive text-base transition-transform group-hover:scale-110"></i>
                                            </button>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                                <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">No Documents Found</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-16 flex justify-center">
                        @if ($documents->hasPages())
                            <nav class="flex gap-2 p-2 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                                @for ($i = 1; $i <= $documents->lastPage(); $i++)
                                    <a href="{{ $documents->url($i) }}" 
                                    class="h-10 w-10 flex items-center justify-center rounded-xl font-bold text-xs transition-all no-underline
                                    {{ $i == $documents->currentPage() ? 'bg-yellow-400 text-yellow-900 shadow-lg shadow-yellow-100' : 'text-gray-400 hover:bg-white hover:text-gray-900' }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
            <!--Upload Modal-->
    <div id="uploadModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-all duration-300">
        <div class="relative w-full max-w-5xl max-h-[92vh] bg-[#f8f9fa] rounded-[2rem] shadow-2xl flex flex-col overflow-hidden border border-white/20">
            
            <div class="upload-banner-header sticky top-0 px-8 py-5 flex justify-between items-center z-20">
                <div class="flex items-center gap-3">
                    <div class="upload-icon-wrapper p-2 rounded-lg">
                        <i class="bi bi-cloud-arrow-up-fill text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="upload-title text-xl font-extrabold text-white tracking-tight">Upload New Document</h3>
                        <p class="upload-subtitle text-yellow-100 text-[10px] uppercase font-bold tracking-widest">LGMED Compass • Document Management</p>
                    </div>
                </div>
                <button class="close-modal upload-close-btn bg-white/10 hover:bg-white/20 text-white w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200">
                    <i class="bi bi-x-lg text-lg"></i> 
                </button>
            </div>

            <div class="overflow-y-auto p-8 custom-scrollbar">
                @if($errors->any() && !old('edit_modal_id'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl mb-6 shadow-sm">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <i class="bi bi-exclamation-triangle-fill"></i> Validation Error
                        </div>
                        <ul class="text-sm opacity-90 list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <div class="validation-summary hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl mb-6 shadow-sm" role="alert" aria-live="polite">
                    <div class="flex items-center gap-2 font-bold mb-1">
                        <i class="bi bi-exclamation-triangle-fill"></i> Please check the highlighted fields
                    </div>
                    <ul class="validation-summary-list text-sm opacity-90 list-inside"></ul>
                </div>

                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" novalidate class="document-modal-form space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <div class="lg:col-span-7">
                            <label class="block text-[11px] uppercase font-bold text-gray-400 tracking-widest mb-3 ml-1">Primary Attachment</label>
                            <div class="group relative border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center bg-white hover:border-yellow-500 hover:shadow-xl hover:shadow-yellow-500/5 transition-all duration-300 cursor-pointer" onclick="document.getElementById('fileInput').click();">
                                <div class="text-yellow-500 text-5xl mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <i class="bi bi-file-earmark-arrow-up"></i>
                                </div>
                                <p class="text-gray-700 font-bold text-lg leading-tight">Drag documents here or <span class="text-yellow-600 underline decoration-2 underline-offset-4">browse files</span></p>
                                <p class="text-gray-400 text-xs mt-2 font-medium">Accepts PDF formats up to 25MB</p>
                                
                                <input type="file" id="fileInput" name="documents[]" multiple accept=".pdf" data-max-file-size="25600" class="hidden" onchange="updateFileList(this)">
                                <div id="fileList" class="mt-4 grid grid-cols-1 gap-2"></div>
                            </div>
                        </div>

                        <div class="lg:col-span-5 flex flex-col justify-center">
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
                                <h6 class="text-[11px] uppercase font-bold text-gray-400 tracking-widest flex items-center gap-2">
                                    <i class="bi bi-link-45deg text-lg text-yellow-600"></i> Cloud Reference
                                </h6>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 mb-1 block">External Link (Optional)</label>
                                    <input type="url" name="document_link" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none" placeholder="https://sharepoint.com/..." value="{{ old('document_link') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <h6 class="text-[11px] uppercase font-bold text-gray-400 tracking-widest mb-6 border-b border-gray-50 pb-4 flex items-center gap-2">
                            <i class="bi bi-info-circle-fill text-yellow-600"></i> Document Classification
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">PPA Name / Subject <span class="text-red-500">*</span></label>
                                <input type="text" name="subject_title" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none" required value="{{ old('subject_title') }}" placeholder="Enter project or activity name">
                            </div>
                            
                            <div>
                                <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Section <span class="text-red-500">*</span></label>
                                <select name="section" id="upload-section-select" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none cursor-pointer" required>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Frequency <span class="text-red-500">*</span></label>
                                <select name="frequency" id="uploadFrequency" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none cursor-pointer" required>
                                    <option value="weekly">Weekly</option>
                                    <option value="bi-monthly">Bi-monthly (twice per month)</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="semestral">Semestral</option>
                                    <option value="annual">Annual</option>
                                    <option value="as-needed">As need arises</option>
                                </select>
                            </div>

                            @php
                                $uploadWhoWillComply = old('who_will_comply', []);
                                $uploadWhoWillComply = is_array($uploadWhoWillComply) ? $uploadWhoWillComply : [];
                            @endphp
                            <fieldset class="md:col-span-2 lg:col-span-3">
                                <legend class="text-[10px] font-bold text-gray-500 mb-2 block uppercase">Who will comply</legend>
                                <p class="text-xs text-gray-500 mb-3">Select all that apply.</p>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach(['LGU', 'DILG FOU', 'MGLOO', 'BARANGAY', 'Others'] as $option)
                                        <label class="flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-700">
                                            <input type="checkbox" name="who_will_comply[]" value="{{ $option }}" class="who-will-comply-option rounded border-gray-300 text-yellow-600 focus:ring-yellow-500" {{ in_array($option, $uploadWhoWillComply, true) ? 'checked' : '' }}>
                                            <span>{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="who-will-comply-other mt-3 {{ in_array('Others', $uploadWhoWillComply, true) ? '' : 'hidden' }}">
                                    <label for="whoWillComplyOtherUpload" class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Specify other</label>
                                    <input type="text" id="whoWillComplyOtherUpload" name="who_will_comply_other" maxlength="255" value="{{ old('who_will_comply_other') }}" class="who-will-comply-other-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none" placeholder="Specify who will comply">
                                </div>
                            </fieldset>
                        </div>

                        <div class="mt-6 p-5 bg-red-50/50 rounded-2xl border border-red-100">
                            <label class="text-[10px] font-bold text-red-600 mb-3 block uppercase tracking-widest"><i class="bi bi-calendar-event"></i> Reporting Deadlines <span class="text-xs font-normal normal-case text-gray-500">(optional)</span></label>
                            <div id="deadlineContainer" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="text-[11px] uppercase font-bold text-gray-400 tracking-widest ml-1">Focal Assignment</label>
                            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                                <div id="focal-avatar" class="h-12 w-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xl font-bold transition-all duration-300">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase">Primary Contact</label>
                                    <select
                                        id="upload-focal-select"
                                        name="focal_person"
                                        class="w-full bg-transparent border-none p-0 text-sm font-bold text-gray-800 focus:ring-0"
                                        data-avatar-id="focal-avatar"
                                        data-default-focal="{{ old('focal_person', auth()->user()->name) }}"
                                    >
                                        <option value="{{ auth()->user()->name }}" data-section-id="{{ auth()->user()->section_id }}" {{ old('focal_person', auth()->user()->name) === auth()->user()->name ? 'selected' : '' }}>{{ auth()->user()->name }} (You)</option>
                                        @foreach($users as $user)
                                            @if($user->id !== auth()->id() && strcasecmp(trim($user->name), trim(auth()->user()->name)) !== 0)
                                                <option value="{{ $user->name }}" data-section-id="{{ $user->section_id }}" {{ old('focal_person') === $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[11px] uppercase font-bold text-gray-400 tracking-widest ml-1">Submission Details</label>
                            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase block mb-1">DMS No.</label>
                                    <input type="text" name="reference" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase block mb-1">Submission Mode</label>
                                    <input type="text" name="mode_of_submission" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-[11px] uppercase font-bold text-gray-400 tracking-widest ml-1 mb-3 block">Additional Context</label>
                            <textarea name="remarks" rows="3" class="w-full bg-white border border-gray-200 rounded-2xl p-5 text-sm shadow-sm focus:ring-4 focus:ring-yellow-400/20 focus:border-yellow-400 transition-all outline-none" placeholder="Enter any internal notes or instructions here..."></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-100">
                        <button type="button" class="close-modal px-8 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard Draft</button>
                        <div class="flex gap-4">
                            <button type="submit" class="px-10 py-3 bg-gray-900 text-white rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-xl shadow-gray-900/20 flex items-center gap-2">
                                <i class="bi bi-check2-all text-lg"></i> Finalize & Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!---Edit Modal--->
    @forelse($documents as $doc)
        <div id="editModal{{ $doc->id }}" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-all duration-300">
            <div class="relative w-full max-w-5xl max-h-[92vh] bg-[#f8f9fa] rounded-[2rem] shadow-2xl flex flex-col overflow-hidden border border-white/20">
                
                <div class="sticky top-0 bg-gradient-to-r from-slate-700 to-slate-800 px-8 py-5 flex justify-between items-center z-20 shadow-md">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="bg-white/10 p-2 rounded-lg">
                            <i class="bi bi-pencil-square text-white text-xl"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-xl font-extrabold text-white tracking-tight">Edit Document</h3>
                            <p class="text-slate-300 text-[10px] uppercase font-bold tracking-widest opacity-80 truncate max-w-[16rem] sm:max-w-md lg:max-w-2xl" title="{{ $doc->subject_title }}">Revision Mode • {{ $doc->subject_title }}</p>
                        </div>
                    </div>
                <button class="close-modal upload-close-btn bg-white/10 hover:bg-white/20 text-white w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200">
                    <i class="bi bi-x-lg text-lg"></i> 
                </button>
                </div>

                <div class="overflow-y-auto p-8 custom-scrollbar">
                    @if($errors->any() && session('open_edit_modal') == $doc->id)
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl mb-6 shadow-sm">
                            <div class="flex items-center gap-2 font-bold mb-1 text-sm">
                                <i class="bi bi-exclamation-octagon-fill"></i> Please resolve the following:
                            </div>
                            <ul class="text-xs opacity-90 list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="validation-summary hidden bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl mb-6 shadow-sm" role="alert" aria-live="polite">
                        <div class="flex items-center gap-2 font-bold mb-1 text-sm">
                            <i class="bi bi-exclamation-octagon-fill"></i> Please check the highlighted fields
                        </div>
                        <ul class="validation-summary-list text-xs opacity-90 list-inside"></ul>
                    </div>

                    <form method="POST" action="{{ route('documents.update', $doc->id) }}" enctype="multipart/form-data" novalidate class="document-modal-form edit-document-form space-y-8" data-modal-id="editModal{{ $doc->id }}" data-doc-id="{{ $doc->id }}">
                        @csrf 
                        @method('PATCH')
                        <input type="hidden" name="edit_modal_id" value="{{ $doc->id }}">
                        
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                            <div class="lg:col-span-7">
                                <label class="block text-[11px] uppercase font-bold text-gray-400 tracking-widest mb-3 ml-1">Replace Attachment</label>
                                <div class="group relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-white hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 cursor-pointer" onclick="document.getElementById('editFiles{{ $doc->id }}').click();">
                                    <div class="text-blue-500 text-4xl mb-3 group-hover:scale-110 transition-transform">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                    <p class="text-gray-700 font-bold leading-tight">Upload new versions</p>
                                    <p class="text-gray-400 text-[11px] mt-1">Files uploaded here will replace existing ones.</p>
                                    
                                    <input type="file" name="documents[]" id="editFiles{{ $doc->id }}" class="hidden" multiple accept=".pdf" data-max-file-size="25600" onchange="updateEditFileList(this, {{ $doc->id }})">
                                    <div id="editFileList{{ $doc->id }}" class="mt-4 grid grid-cols-1 gap-2"></div>
                                </div>
                            </div>

                           <div class="lg:col-span-5">
                                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-full">
                                    <h6 class="text-[11px] uppercase font-bold text-gray-400 tracking-widest mb-4 flex items-center gap-2">
                                        <i class="bi bi-link-45deg text-blue-600"></i> Document Link
                                    </h6>
                                    <!-- Editable link field -->
                                    <input type="url" name="document_link"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400"
                                        value="{{ old('document_link', $doc->document_link) }}"
                                        placeholder="https://...">
                                    
                                    @if($doc->document_link)
                                        <p class="mt-2 text-[11px] text-gray-400 truncate">Current: {{ $doc->document_link }}</p>
                                    @else
                                        <p class="mt-2 text-[11px] text-gray-400 italic">No link saved</p>
                                    @endif

                                    <div class="mt-4 pt-3 border-t border-gray-100">
                                        <h6 class="text-[11px] uppercase font-bold text-gray-400 tracking-widest mb-2 flex items-center gap-2">
                                            <i class="bi bi-files text-blue-600"></i> Saved Files
                                        </h6>
                                        @if($doc->file_path)
                                            @php $files = json_decode($doc->file_path, true); @endphp
                                            <div class="space-y-2">
                                                @foreach($files as $file)
                                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 text-xs font-semibold text-gray-600">
                                                        <i class="bi bi-file-earmark-pdf text-red-500 text-lg"></i>
                                                        <span class="truncate">{{ basename($file) }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="h-20 flex flex-col items-center justify-center text-gray-400 italic text-xs border-2 border-dotted border-gray-100 rounded-xl">
                                                No files attached
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="lg:col-span-2">
                                    <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">PPA Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="subject_title" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-blue-400" value="{{ old('subject_title', $doc->subject_title) }}" required>
                                </div>

                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Section <span class="text-red-500">*</span></label>
                                    @php
                                        $selectedSection = old('section', $doc->section);
                                        $hasSelectedSection = $sections->contains(fn ($section) => (string) $section->id === (string) $selectedSection || (string) $section->name === (string) $selectedSection);
                                    @endphp
                                    <select name="section" id="edit-section-select-{{ $doc->id }}" class="edit-section-select w-full bg-gray-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400" required>
                                        <option value="" disabled {{ $selectedSection ? '' : 'selected' }}>Select Section</option>
                                        @if($selectedSection && ! $hasSelectedSection)
                                        <option value="{{ $selectedSection }}" selected>{{ $selectedSection }}</option>
                                        @endif
                                        @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ (string) $section->id === (string) $selectedSection || (string) $section->name === (string) $selectedSection ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Frequency <span class="text-red-500">*</span></label>
                                    <select name="frequency" class="edit-frequency w-full bg-gray-50 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400" data-doc-id="{{ $doc->id }}" required>
                                        <option value="weekly" {{ old('frequency', $doc->frequency)=='weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="bi-monthly" {{ old('frequency', $doc->frequency)=='bi-monthly' ? 'selected' : '' }}>Bi-monthly (twice per month)</option>
                                        <option value="monthly" {{ old('frequency', $doc->frequency)=='monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="quarterly" {{ old('frequency', $doc->frequency)=='quarterly' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="semestral" {{ old('frequency', $doc->frequency)=='semestral' ? 'selected' : '' }}>Semestral</option>
                                        <option value="annual" {{ old('frequency', $doc->frequency)=='annual' ? 'selected' : '' }}>Annual</option>
                                        <option value="as-needed" {{ old('frequency', $doc->frequency)=='as-needed' ? 'selected' : '' }}>As need arises</option>
                                    </select>
                                </div>

                                @php
                                    $selectedWhoWillComply = old('who_will_comply', $doc->who_will_comply ?? []);
                                    $selectedWhoWillComply = is_array($selectedWhoWillComply) ? $selectedWhoWillComply : [];
                                @endphp
                                <fieldset class="md:col-span-2 lg:col-span-3">
                                    <legend class="text-[10px] font-bold text-gray-500 mb-2 block uppercase">Who will comply</legend>
                                    <input type="hidden" name="who_will_comply_present" value="1">
                                    <p class="text-xs text-gray-500 mb-3">Select all that apply.</p>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        @foreach(['LGU', 'DILG FOU', 'MGLOO', 'BARANGAY', 'Others'] as $option)
                                            <label class="flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-700">
                                                <input type="checkbox" name="who_will_comply[]" value="{{ $option }}" class="who-will-comply-option rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ in_array($option, $selectedWhoWillComply, true) ? 'checked' : '' }}>
                                                <span>{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="who-will-comply-other mt-3 {{ in_array('Others', $selectedWhoWillComply, true) ? '' : 'hidden' }}">
                                        <label for="whoWillComplyOther{{ $doc->id }}" class="text-[10px] font-bold text-gray-500 mb-1 block uppercase">Specify other</label>
                                        <input type="text" id="whoWillComplyOther{{ $doc->id }}" name="who_will_comply_other" maxlength="255" value="{{ old('who_will_comply_other', $doc->who_will_comply_other) }}" class="who-will-comply-other-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Specify who will comply">
                                    </div>
                                </fieldset>

                                <div class="md:col-span-2">
                                    <div class="p-5 bg-blue-50/50 rounded-2xl border border-blue-100">
                                        <label class="text-[10px] font-bold text-blue-600 mb-3 block uppercase tracking-widest"><i class="bi bi-calendar-check"></i> Adjust Deadlines <span class="text-xs font-normal normal-case text-gray-500">(optional)</span></label>
                                        <div id="deadlineContainer{{ $doc->id }}" class="deadline-container grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                                <div id="edit-focal-avatar-{{ $doc->id }}" class="h-12 w-12 bg-slate-700 text-white rounded-full flex items-center justify-center text-xl font-bold">
                                    {{ substr($doc->focal_person ?? auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase">Focal Person</label>
                                    <select
                                        name="focal_person"
                                        id="edit-focal-select-{{ $doc->id }}"
                                        class="edit-focal-select w-full border-none p-0 text-sm font-bold text-gray-800 focus:ring-0"
                                        data-avatar-id="edit-focal-avatar-{{ $doc->id }}"
                                        data-default-focal="{{ old('focal_person', $doc->focal_person ?? auth()->user()->name) }}"
                                    >
                                        <option value="{{ auth()->user()->name }}" data-section-id="{{ auth()->user()->section_id }}" {{ old('focal_person', $doc->focal_person) == auth()->user()->name ? 'selected' : '' }}>{{ auth()->user()->name }} (You)</option>
                                        @foreach($users as $user)
                                            @if($user->id != auth()->id() && strcasecmp(trim($user->name), trim(auth()->user()->name)) !== 0)
                                                <option value="{{ $user->name }}" data-section-id="{{ $user->section_id }}" {{ old('focal_person', $doc->focal_person) == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                                <label class="text-[10px] font-bold text-gray-500 uppercase block mb-1">Reference Link</label>
                                <input type="text" name="cy_link" class="w-full bg-gray-50 border-none rounded-lg px-3 py-2 text-xs" value="{{ old('cy_link', $doc->cy_link) }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-[11px] uppercase font-bold text-gray-400 tracking-widest ml-1 mb-2 block">Revision Remarks</label>
                                <textarea name="remarks" rows="3" class="w-full bg-white border border-gray-100 rounded-2xl p-5 text-sm shadow-sm focus:ring-2 focus:ring-blue-400" placeholder="Describe the changes made...">{{ old('remarks', $doc->remarks) }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-100">
                            <button type="button" class="close-modal px-8 py-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Cancel Edits</button>
                            <button type="submit" class="px-10 py-3 bg-slate-800 text-white rounded-full text-sm font-bold hover:bg-slate-900 transition-all shadow-xl shadow-slate-900/20 flex items-center gap-2">
                                <i class="bi bi-arrow-repeat text-lg"></i> Apply Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        @endforelse
        <!-- DELETE MODAL -->
<div id="deleteModal" class="custom-modal fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="modal-content-custom bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto">
        <form method="POST" id="deleteForm" class="modal-content-custom">@csrf @method('DELETE')
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="bi bi-archive-fill text-yellow-600 text-xl"></i>
                    </div>
                    <h5 class="text-lg font-bold text-slate-800">Confirm Archive</h5>
                </div>
                <p class="text-slate-600 mb-6">Are you sure you want to archive:</p>
                <p id="deleteDocTitle" class="font-bold text-yellow-700 mb-6 break-words"></p>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 close-modal">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700">Archive</button>
                </div>
            </div>
        </form>
    </div>
</div>
 
        <!-- ARCHIVE MODAL -->
        <div id="archiveModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
                <form method="POST" id="archiveForm" class="modal-content">@csrf @method('PATCH')<div class="bg-yellow-600 text-white px-6 py-4 rounded-t-2xl"><h5 class="text-xl font-bold">Confirm Archive</h5></div><div class="p-6 text-center">Are you sure you want to archive this document? Archived documents can be restored later.</div><div class="flex justify-center gap-3 p-4 border-t border-gray-200"><button type="button" class="close-modal px-5 py-2 border border-gray-300 rounded-full hover:bg-gray-100">Cancel</button><button type="submit" class="px-5 py-2 bg-yellow-600 text-white rounded-full hover:bg-yellow-700">Archive</button></div></form>
            </div>
        </div>

        <!-- View MODAL -->
    <div id="viewModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-5xl max-h-[92vh] flex flex-col overflow-hidden border border-gray-100">
            
            <div class="h-1.5 w-full bg-gradient-to-r from-yellow-400 via-yellow-600 to-yellow-500"></div>

            <div class="px-8 py-6 flex justify-between items-start bg-white border-b border-gray-50">
                <div class="max-w-[70%] space-y-3">
                    <h4 id="viewSubject" class="text-2xl font-extrabold text-gray-900 tracking-tight leading-tight line-clamp-2">
                        Project Alpha Initiative
                    </h4>
                    
                    <div class="flex flex-wrap gap-3 text-sm">
                        <div class="flex items-center text-gray-500 bg-gray-50 px-3 py-1 rounded-full border border-gray-100 shadow-sm">
                            <i class="bi bi-person-circle text-yellow-600 mr-2"></i> 
                            <span>Focal: <strong id="viewFocal" class="text-gray-800 font-semibold">Jane Doe</strong></span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div id="viewStatusWrapper" class="flex items-center">
                        <span id="viewStatus" class="bg-white text-gray-700 border border-gray-200 px-4 py-2 rounded-2xl text-[11px] font-bold uppercase tracking-widest flex items-center gap-3 shadow-sm group hover:border-yellow-400 transition-all">
                            <span class="flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-2.5 w-2.5 rounded-full bg-yellow-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-yellow-500"></span>
                            </span>
                            <span id="viewStatusText">To Do</span>
                            <i class="bi bi-hourglass-split text-yellow-600"></i>
                        </span>
                    </div>
                    
                    <button class="close-modal p-2.5 bg-gray-50 hover:bg-red-50 rounded-xl transition-all text-gray-400 hover:text-red-500 border border-gray-100">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-8 bg-[#fbfbfd] custom-scrollbar">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        <div class="space-y-4">
                            <h6 class="flex items-center gap-2 font-bold text-[10px] uppercase tracking-[0.2em] text-gray-400">
                                <i class="bi bi-file-earmark-pdf-fill text-yellow-600 text-base"></i> Uploaded Documents
                            </h6>
                            <div id="viewFiles" class="grid gap-3 ">
                                <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:border-yellow-400 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-red-50 text-red-500 rounded-xl group-hover:bg-red-500 group-hover:text-white transition-all">
                                            <i class="bi bi-filetype-pdf text-xl"></i>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 truncate max-w-[300px]">compliance_report_2024.pdf</span>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded-lg group-hover:bg-yellow-50 transition-colors">
                                        <i class="bi bi-download text-gray-400 group-hover:text-yellow-600"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h6 class="flex items-center gap-2 font-bold text-[10px] uppercase tracking-[0.2em] text-gray-400">
                                <i class="bi bi-chat-left-dots-fill text-yellow-600 text-base"></i> Internal Remarks
                            </h6>
                            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 min-h-[160px] relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-8 opacity-5">
                                    <i class="bi bi-quote text-6xl text-gray-900"></i>
                                </div>
                                <p id="viewRemarks" class="text-gray-600 leading-relaxed italic text-sm whitespace-pre-wrap relative z-10">No remarks provided.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 ">
                        <div class="bg-gray-900 rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden">
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl"></div>
                            <h6 class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-4">Quick Access</h6>
                            <div id="viewDocumentLinkWrapper" class="w-full">
                                <a href="#" class="flex items-center justify-center gap-3 w-full bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-extrabold py-3.5 rounded-2xl transition-all shadow-lg shadow-yellow-500/30 active:scale-95">
                                    <i class="bi bi-box-arrow-up-right text-lg"></i> Open Document
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                            <div class="p-5 border-b border-gray-50 bg-gray-50/50">
                                <h6 class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Timeline & Info</h6>
                            </div>
                            <div class="p-6 space-y-5">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium text-gray-400 uppercase tracking-tighter">Deadline</span>
                                    <span id="viewDeadline" class="text-sm font-bold text-red-500 bg-red-50 px-3 py-1 rounded-lg">Apr 02, 2026</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium text-gray-400 uppercase tracking-tighter">Frequency</span>
                                    <span id="viewFrequency" class="text-sm font-bold text-gray-700 bg-gray-50 px-3 py-1 rounded-lg italic">—</span>
                                </div>
                                <div class="pt-4 border-t border-gray-50 space-y-3">
                                    <div class="flex justify-between items-center text-[11px]">
                                        <span class="text-gray-400">System Created</span>
                                        <span id="viewCreated" class="text-gray-600 font-mono">03/24/2026</span>
                                    </div>
                                    <div class="flex justify-between items-center text-[11px]">
                                        <span class="text-gray-400">Last Update</span>
                                        <span id="viewUpdated" class="text-gray-600 font-mono">03/28/2026</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                                <label class="text-[10px] uppercase font-bold text-gray-400 tracking-widest block mb-1">Reference No.</label>
                                <div id="viewReference" class="text-xs font-bold text-gray-700">—</div>
                            </div>
                            <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                                <label class="text-[10px] uppercase font-bold text-gray-400 tracking-widest block mb-1">Submission Mode</label>
                                <div id="viewMode" class="text-xs font-bold text-gray-700">—</div>
                            </div>
                            <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
                                <label class="text-[10px] uppercase font-bold text-gray-400 tracking-widest block mb-1">Who will comply</label>
                                <div id="viewWhoWillComply" class="text-xs font-bold text-gray-700">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="bg-white border-t border-gray-100 px-8 py-5 flex justify-between items-center">
                <button class="close-modal text-sm font-extrabold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">Dismiss</button>
                <div class="flex gap-3">
                    <a href="{{ route('reports.generate') }}" class="px-8 py-3 bg-gray-900 text-white text-sm font-bold rounded-2xl hover:bg-gray-800 transition-all flex items-center gap-2 shadow-xl shadow-gray-900/20 active:scale-95">
                        <i class="bi bi-printer-fill"></i> Print Report
                    </a>
                </div>
            </div> -->
        </div>
    </div>
    <!-- COMPLETE SCHEDULE CONFIRMATION MODAL -->
    <div id="completeScheduleModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="bg-green-600 text-white px-6 py-4 rounded-t-2xl">
                <h5 class="text-xl font-bold">Confirm Completion</h5>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-600">Mark this period as completed?</p>
                <p class="text-sm text-gray-500 mt-2">Progress will increase and the next due date will be shown.</p>
            </div>
            <div class="flex justify-center gap-3 p-4 border-t border-gray-200">
                <button type="button" class="close-modal px-5 py-2 border border-gray-300 rounded-full hover:bg-gray-100">Cancel</button>
                <button type="button" id="confirmCompleteBtn" class="px-5 py-2 bg-green-600 text-white rounded-full hover:bg-green-700">Confirm</button>
            </div>
        </div>
    </div>
        <!-- TOAST CONTAINER -->
        <div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3 pointer-events-none">
        </div>

        <script>
            // ================= DEADLINE GENERATOR =================
            
            // Function to adjust weekend and holiday dates to next business day
            async function adjustWeekend(date) {
                let adjustedDate = new Date(date);
                const day = adjustedDate.getDay();
                
                // First adjust for weekends
                if (day === 6) { // Saturday
                    adjustedDate.setDate(adjustedDate.getDate() + 2); // Move to Monday
                } else if (day === 0) { // Sunday
                    adjustedDate.setDate(adjustedDate.getDate() + 1); // Move to Monday
                }
                
                // Then check for holidays and adjust if needed
                try {
                    const response = await fetch(`/api/holidays/check?date=${adjustedDate.toISOString().split('T')[0]}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    if (response.ok) {
                        const data = await response.json();
                        if (data.needs_adjustment && data.next_business_day) {
                            adjustedDate = new Date(data.next_business_day);
                        }
                    }
                } catch (error) {
                    console.warn('Failed to check holiday status:', error);
                    // If holiday check fails, at least we've handled weekends
                }
                
                return adjustedDate;
            }
            
            // Function to generate subsequent dates based on first date and frequency
            async function generateSubsequentDates(firstDate, frequency, count, startIndex = 0) {
                const dates = [];
                const startDate = new Date(firstDate);
                
                for (let i = 0; i < count; i++) {
                    const date = new Date(startDate);
                    
                    if (frequency === 'monthly') {
                        date.setMonth(startDate.getMonth() + (i - startIndex));
                    } else if (frequency === 'bi-monthly') {
                        date.setDate(startDate.getDate() + ((i - startIndex) * 15));
                    } else if (frequency === 'quarterly') {
                        date.setMonth(startDate.getMonth() + ((i - startIndex) * 3));
                    } else if (frequency === 'semestral') {
                        date.setMonth(startDate.getMonth() + ((i - startIndex) * 6));
                    } else if (frequency === 'weekly') {
                        date.setDate(startDate.getDate() + ((i - startIndex) * 7));
                    } else if (frequency === 'annual') {
                        date.setFullYear(startDate.getFullYear() + (i - startIndex));
                    }
                    
                    dates.push(await adjustWeekend(date));
                }
                
                return dates;
            }
            function generateDeadlines(container, count, existingDates = [], frequency = null) {
                container.innerHTML = "";
                const pickers = [];
                
                // Get frequency from the form if not provided
                if (!frequency) {
                    const form = container.closest('form');
                    const freqSelect = form ? form.querySelector('#uploadFrequency, .edit-frequency') : null;
                    frequency = freqSelect ? freqSelect.value : null;
                }
                
                for (let i = 0; i < count; i++) {
                    const wrapper = document.createElement("div");
                    wrapper.className = "flex gap-2 items-center mb-2";
                    
                    // Create date input
                    const input = document.createElement("input");
                    input.type = "text";
                    input.name = "deadlines[]";
                    input.required = false;
                    input.placeholder = "Select date";
                    input.dataset.label = `Reporting deadline ${i + 1}`;
                    input.dataset.index = i;
                    input.className = "flex-1 border border-gray-300 rounded-lg px-4 py-2";
                    
                    // Create N/A checkbox
                    const naCheckbox = document.createElement("input");
                    naCheckbox.type = "checkbox";
                    naCheckbox.id = `na_${i}`;
                    naCheckbox.className = "w-4 h-4 text-blue-600 rounded focus:ring-blue-500";
                    
                    const naLabel = document.createElement("label");
                    naLabel.htmlFor = `na_${i}`;
                    naLabel.className = "text-sm font-medium text-gray-700 cursor-pointer whitespace-nowrap";
                    naLabel.textContent = "N/A";
                    
                    wrapper.appendChild(input);
                    wrapper.appendChild(naCheckbox);
                    wrapper.appendChild(naLabel);
                    container.appendChild(wrapper);
                    
                    let picker = null;
                    
                    // Initialize date picker
                    function initDatePicker() {
                        picker = flatpickr(input, {
                            altInput: true, altFormat: "M-d-Y", dateFormat: "Y-m-d",
                            minDate: i === 0 ? "today" : null,
                            onChange: async function (selectedDates) {
                                if (!selectedDates.length) return;
                                let selected = selectedDates[0];
                                
                                // Adjust for holidays and weekends
                                selected = await adjustWeekend(selected);
                                picker.setDate(selected);
                                
                                // Only auto-generate if this is the first non-N/A date input
                                // Check if this is the first non-N/A input
                                let isFirstNonNA = true;
                                for (let k = 0; k < i; k++) {
                                    const naCheckbox_k = container.querySelector(`#na_${k}`);
                                    if (naCheckbox_k && !naCheckbox_k.checked) {
                                        isFirstNonNA = false;
                                        break;
                                    }
                                }
                                
                                // Auto-generate subsequent dates only if this is the first non-N/A date and frequency is set
                                if (isFirstNonNA && frequency && count > 1) {
                                    generateSubsequentDates(selected, frequency, count, i).then(subsequentDates => {
                                        // Set dates only for inputs that are currently empty and not N/A
                                        for (let j = i + 1; j < count; j++) {
                                            const naCheckbox_j = container.querySelector(`#na_${j}`);
                                            if (pickers[j] && subsequentDates[j] && naCheckbox_j && !naCheckbox_j.checked && !pickers[j].selectedDates[0]) {
                                                pickers[j].setDate(subsequentDates[j]);
                                            }
                                        }
                                    });
                                }
                                
                                for (let j = 0; j < i; j++) {
                                    const prev = pickers[j] ? pickers[j].selectedDates[0] : null;
                                    if (prev && prev >= selected) {
                                        showFormErrors(input.closest('form'), ["Deadlines must follow chronological order."]);
                                        picker.clear();
                                        return;
                                    }
                                }
                                if (pickers[i + 1]) {
                                    const nextMin = new Date(selected);
                                    nextMin.setDate(nextMin.getDate() + 1);
                                    pickers[i + 1].set("minDate", nextMin);
                                }
                            }
                        });
                        pickers[i] = picker;
                    }
                    
                    // Handle N/A checkbox
                    naCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            // Destroy picker and set N/A
                            if (picker) {
                                picker.destroy();
                                picker = null;
                            }
                            input.value = 'N/A';
                            input.readOnly = true;
                            input.required = false;
                            input.classList.add('bg-gray-100');
                            input.style.cursor = 'not-allowed';
                        } else {
                            // Re-enable input and reinitialize picker
                            input.value = '';
                            input.readOnly = false;
                            input.required = false;
                            input.classList.remove('bg-gray-100');
                            input.style.cursor = '';
                            initDatePicker();
                            
                            // After re-enabling, check if we should trigger auto-generation
                            setTimeout(() => {
                                if (frequency && count > 1) {
                                    // Find the first non-N/A date input
                                    let firstDateIndex = -1;
                                    let firstDate = null;
                                    
                                    for (let k = 0; k < count; k++) {
                                        const naCheckbox_k = container.querySelector(`#na_${k}`);
                                        if (naCheckbox_k && !naCheckbox_k.checked && pickers[k] && pickers[k].selectedDates[0]) {
                                            firstDateIndex = k;
                                            firstDate = pickers[k].selectedDates[0];
                                            break;
                                        }
                                    }
                                    
                                    // Auto-generate subsequent dates only for empty fields
                                    if (firstDate !== null) {
                                        generateSubsequentDates(firstDate, frequency, count, firstDateIndex).then(subsequentDates => {
                                            // Set dates only for inputs that are currently empty and not N/A
                                            for (let j = 0; j < count; j++) {
                                                const naCheckbox_j = container.querySelector(`#na_${j}`);
                                                if (j !== firstDateIndex && pickers[j] && subsequentDates[j] && naCheckbox_j && !naCheckbox_j.checked && !pickers[j].selectedDates[0]) {
                                                    pickers[j].setDate(subsequentDates[j]);
                                                }
                                            }
                                        });
                                    }
                                }
                            }, 200); // Small delay to ensure picker is initialized
                        }
                        
                        // Update form validation
                        updateFormValidation();
                    });
                    
                    // Check if existing date is "N/A"
                    if (existingDates[i]) {
                        if (existingDates[i].toString().toUpperCase() === 'N/A') {
                            naCheckbox.checked = true;
                            input.value = 'N/A';
                            input.readOnly = true;
                            input.required = false;
                            input.classList.add('bg-gray-100');
                            input.style.cursor = 'not-allowed';
                        } else {
                            initDatePicker();
                            // Adjust existing dates for holidays and weekends
                            adjustWeekend(new Date(existingDates[i])).then(adjustedDate => {
                                picker.setDate(adjustedDate);
                            });
                        }
                    } else {
                        initDatePicker();
                    }
                }
                
                // Update form validation after generation
                updateFormValidation();
            }

            // ================= FORM VALIDATION =================
            function updateFormValidation() {
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    const deadlineInputs = form.querySelectorAll('input[name="deadlines[]"]');
                    deadlineInputs.forEach(input => {
                        input.required = false;
                    });
                });
            }

            function updateWhoWillComplyOther(form) {
                const othersCheckbox = Array.from(form.querySelectorAll('.who-will-comply-option'))
                    .find(checkbox => checkbox.value === 'Others');
                const otherContainer = form.querySelector('.who-will-comply-other');
                const otherInput = form.querySelector('.who-will-comply-other-input');
                if (!othersCheckbox || !otherContainer || !otherInput) return;

                otherContainer.classList.toggle('hidden', !othersCheckbox.checked);
                otherInput.required = othersCheckbox.checked;
                if (!othersCheckbox.checked) otherInput.value = '';
            }

            document.querySelectorAll('form').forEach(form => {
                if (form.querySelector('.who-will-comply-option')) updateWhoWillComplyOther(form);
            });
            document.addEventListener('change', function (event) {
                if (!event.target.matches('.who-will-comply-option')) return;
                const form = event.target.closest('form');
                if (form) updateWhoWillComplyOther(form);
            });

            // ================= MODAL MANAGEMENT =================
            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; }
            }
            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; }
            }
            function getFieldLabel(field) {
                if (field.dataset.label) return field.dataset.label;

                const fieldWrapper = field.closest('div');
                const label = fieldWrapper ? fieldWrapper.querySelector('label') : null;
                if (label) return label.textContent.replace('*', '').trim();

                return field.name ? field.name.replace(/\[\]/g, '').replace(/_/g, ' ') : 'This field';
            }
            function getFormValidationErrors(form) {
                const errors = [];
                const fields = form.querySelectorAll('input, select, textarea');

                fields.forEach(field => {
                    field.setCustomValidity('');
                    field.classList.remove('border-red-400', 'ring-2', 'ring-red-200');

                    if (field.disabled || field.type === 'hidden' || field.type === 'submit' || field.type === 'button') return;

                    const label = getFieldLabel(field);
                    const value = field.value ? field.value.trim() : '';

                    if (field.required && !value) {
                        errors.push(`${label} is required.`);
                        field.setCustomValidity(`${label} is required.`);
                    } else if (field.type === 'url' && value && !field.validity.valid) {
                        errors.push(`${label} must be a valid URL.`);
                        field.setCustomValidity(`${label} must be a valid URL.`);
                    }

                    if (field.type === 'file' && field.files.length) {
                        const maxSize = Number(field.dataset.maxFileSize || 0) * 1024;
                        Array.from(field.files).forEach(file => {
                            if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                                errors.push(`${file.name} must be a PDF file.`);
                                field.setCustomValidity('Only PDF files are allowed.');
                            }

                            if (maxSize && file.size > maxSize) {
                                const limitMb = Math.round(maxSize / 1024 / 1024);
                                const fileSizeMb = (file.size / 1024 / 1024).toFixed(1);
                                errors.push(`${file.name} (${fileSizeMb}MB) exceeds the ${limitMb}MB limit. Please use the "Document Link" field instead for files larger than ${limitMb}MB.`);
                                field.setCustomValidity(`Files larger than ${limitMb}MB should use the Document Link field instead.`);
                            }
                        });
                    }

                    if (!field.validity.valid) {
                        field.classList.add('border-red-400', 'ring-2', 'ring-red-200');
                    }
                });

                return [...new Set(errors)];
            }
            function showFormErrors(form, errors = null) {
                if (!form) return;

                const modalBody = form.closest('.overflow-y-auto');
                const summary = modalBody ? modalBody.querySelector('.validation-summary') : null;
                const list = summary ? summary.querySelector('.validation-summary-list') : null;
                const validationErrors = errors || getFormValidationErrors(form);

                if (!summary || !list) return;

                if (!validationErrors.length) {
                    summary.classList.add('hidden');
                    list.innerHTML = '';
                    return;
                }

                list.innerHTML = validationErrors.map(error => `<li>${escapeHtml(error)}</li>`).join('');
                summary.classList.remove('hidden');
                summary.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            function validateModalForm(form, shouldScroll = false) {
                const errors = getFormValidationErrors(form);
                const modalBody = form.closest('.overflow-y-auto');
                const summary = modalBody ? modalBody.querySelector('.validation-summary') : null;
                const list = summary ? summary.querySelector('.validation-summary-list') : null;

                if (summary && list) {
                    if (errors.length) {
                        list.innerHTML = errors.map(error => `<li>${escapeHtml(error)}</li>`).join('');
                        summary.classList.remove('hidden');
                        if (shouldScroll) summary.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        summary.classList.add('hidden');
                        list.innerHTML = '';
                    }
                }

                return errors.length === 0;
            }
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', function () { const modal = this.closest('.fixed.inset-0'); if (modal) closeModal(modal.id); });
            });
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                modal.addEventListener('click', function (e) { if (e.target === this) closeModal(this.id); });
            });

            // ================= UPLOAD MODAL =================
            const uploadBtn = document.getElementById('openUploadModalBtn');
            if (uploadBtn) uploadBtn.addEventListener('click', () => {
                // Check if user is Technical Inspector
                const isTechInspector = uploadBtn.getAttribute('data-is-tech-inspector') === 'true';
                if (isTechInspector) {
                    showToast('Technical Inspector has read-only access. You cannot upload documents.', 'error');
                    return;
                }
                openModal('uploadModal');
            });
            const uploadFrequency = document.getElementById('uploadFrequency');
            const deadlineContainer = document.getElementById('deadlineContainer');
            const getFrequencyCount = (frequency) => ({
                weekly: 52,
                'bi-monthly': 24,
                monthly: 12,
                quarterly: 4,
                semestral: 2,
                annual: 1,
                'as-needed': 1
            }[frequency] || 1);
            function initUploadDeadlines() {
                if (!uploadFrequency || !deadlineContainer) return;
                let freq = uploadFrequency.value;
                let count = getFrequencyCount(freq);
                const oldDeadlines = @json(old('deadlines', []));
                const deadlinesToUse = oldDeadlines.length === count ? oldDeadlines : [];
                generateDeadlines(deadlineContainer, count, deadlinesToUse, freq);
            }
            if (uploadFrequency) {
                uploadFrequency.removeEventListener('change', window._uploadFreqChange);
                window._uploadFreqChange = function () {
                    let freq = this.value;
                    let count = getFrequencyCount(freq);
                    generateDeadlines(deadlineContainer, count, [], freq);
                    validateModalForm(this.closest('form'));
                };
                uploadFrequency.addEventListener('change', window._uploadFreqChange);
            }
            initUploadDeadlines();
            @if($errors->any() && !old('edit_modal_id'))
                window.addEventListener('load', function() { initUploadDeadlines(); openModal('uploadModal'); });
            @endif

            // ================= EDIT MODALS =================
            window.originalDatesMap = window.originalDatesMap || {};
            @foreach($documents as $doc)
                window.originalDatesMap[{{ $doc->id }}] = @json($doc->schedules->pluck('due_date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))->toArray());
            @endforeach
            function setupEditModal(modalId, docId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;
                const freqSelect = modal.querySelector('.edit-frequency');
                const container = modal.querySelector('.deadline-container');
                if (!freqSelect || !container) return;
                const initialCount = getFrequencyCount(freqSelect.value);
                const originalDates = window.originalDatesMap[docId] || [];
                generateDeadlines(container, initialCount, originalDates, freqSelect.value);
                freqSelect.removeEventListener('change', window._editFreqChangeHandler);
                const handler = function () { 
                    generateDeadlines(container, getFrequencyCount(this.value), [], this.value);
                };
                freqSelect.addEventListener('change', handler);
                window._editFreqChangeHandler = handler;
            }
            document.querySelectorAll('.edit-document-form').forEach(form => {
                form.addEventListener('submit', function () {
                    const modalId = this.getAttribute('data-modal-id');
                    const docId = this.getAttribute('data-doc-id');
                    const deadlineInputs = this.querySelectorAll('input[name="deadlines[]"]');

                    if (!deadlineInputs.length) setupEditModal(modalId, docId);
                });
            });
            document.querySelectorAll('.document-modal-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    if (!validateModalForm(this, true)) {
                        event.preventDefault();
                        const firstInvalid = this.querySelector(':invalid');
                        if (firstInvalid) firstInvalid.focus({ preventScroll: true });
                    }
                });

                // Real-time validation removed to prevent error messages showing immediately
                // Validation will only occur on form submission
            });

            // ================= DELEGATED EVENT HANDLERS =================
            document.addEventListener('click', function(e) {
                if (e.target.closest('.doc-open-btn')) {
                    const btn = e.target.closest('.doc-open-btn');
                    const link = btn.getAttribute('data-document-link');
                    if (link && link.trim() !== '') window.open(link, '_blank');
                    else showToast('This document has no link uploaded.', 'error');
                    e.stopPropagation();
                    return;
                }
                if (e.target.closest('.edit-btn')) {
                    const btn = e.target.closest('.edit-btn');
                    // Check if user is Technical Inspector
                    const isTechInspector = btn.getAttribute('data-is-tech-inspector') === 'true';
                    if (isTechInspector) {
                        showToast('Technical Inspector has read-only access. You cannot edit documents.', 'error');
                        e.stopPropagation();
                        return;
                    }
                    const target = btn.getAttribute('data-target');
                    if (target) { const docId = target.replace('editModal', ''); setupEditModal(target, docId); openModal(target); }
                    e.stopPropagation();
                    return;
                }
                    if (e.target.closest('.delete-btn')) {
                        const btn = e.target.closest('.delete-btn');
                        const action = btn.getAttribute('data-action');
                        const title = btn.getAttribute('data-title');

                        const deleteFormElem = document.getElementById('deleteForm');
                        if (deleteFormElem) deleteFormElem.action = action;

                        // Set document title in modal
                        const titleEl = document.getElementById('deleteDocTitle');
                        if (titleEl) {
                            titleEl.textContent = title || 'Unknown document';
                        }

                        openModal('deleteModal');
                        e.stopPropagation();
                        return;
                    }
                if (e.target.closest('.archive-btn')) {
                    const btn = e.target.closest('.archive-btn');
                    const action = btn.getAttribute('data-action');
                    const archiveFormElem = document.getElementById('archiveForm');
                    if (archiveFormElem) archiveFormElem.action = action;
                    openModal('archiveModal');
                    e.stopPropagation();
                    return;
                }
                if (e.target.closest('.mark-done-archive-btn')) {
                    const btn = e.target.closest('.mark-done-archive-btn');
                    const action = btn.getAttribute('data-action');
                    const title = btn.getAttribute('data-title');
                    
                    if (confirm(`Are you sure you want to mark "${title}" as Done and archive it? This action cannot be undone.`)) {
                        // Create a form and submit it
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = action;
                        
                        // Add CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]');
                        if (csrfToken) {
                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = csrfToken.getAttribute('content');
                            form.appendChild(csrfInput);
                        }
                        
                        // Add method override for PATCH
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PATCH';
                        form.appendChild(methodInput);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                    e.stopPropagation();
                    return;
                }
            });

            // ================= CARD CLICK FOR VIEW MODAL (FIXED STATUS COLORS + DYNAMIC LINK) =================
            document.addEventListener('click', function(e) {
                const card = e.target.closest('.doc-card');
                if (!card) return;
                if (e.target.closest('button, a, input, select, form, .doc-open-btn, .edit-btn, .delete-btn, .archive-btn, .mark-done-archive-btn')) return;
                const triggerBtn = card.querySelector('.view-trigger-btn');
                if (!triggerBtn) return;
                const data = triggerBtn.dataset;

                const setText = (id, val, def = '—') => { const el = document.getElementById(id); if (el) el.textContent = val || def; };
                setText('viewSubject', data.subject);
                setText('viewFocal', data.focal);
                setText('viewCreated', data.created);
                setText('viewUpdated', data.updated);
                setText('viewDeadline', data.deadline);
                setText('viewFrequency', data.frequency);
                setText('viewReference', data.reference);
                setText('viewMode', data.mode);
                setText('viewLink', data.link);
                setText('viewRemarks', data.remarks);
                const whoWillComply = JSON.parse(data.whoWillComply || '[]');
                if (whoWillComply.includes('Others') && data.whoWillComplyOther) {
                    whoWillComply.push(data.whoWillComplyOther);
                }
                setText('viewWhoWillComply', whoWillComply.join(', '));

                // --- Status badge with colors (FIXED) ---
                const statusSpan = document.getElementById('viewStatus');
                if (statusSpan) {
                    let statusClass = '';
                    let iconClass = '';
                    const rawStatus = (data.status || '').trim();
                    switch (rawStatus) {
                        case 'To Do':
                            statusClass = 'bg-gray-100 text-gray-800';
                            iconClass = 'bi bi-hourglass-split';
                            break;
                        case 'In Progress':
                            statusClass = 'bg-blue-100 text-blue-800';
                            iconClass = 'bi bi-arrow-repeat';
                            break;
                        case 'In Review':
                            statusClass = 'bg-purple-100 text-purple-800';
                            iconClass = 'bi bi-eye';
                            break;
                        case 'Revision':
                            statusClass = 'bg-orange-100 text-orange-800';
                            iconClass = 'bi bi-pencil-square';
                            break;
                        case 'Done':
                            statusClass = 'bg-green-100 text-green-800';
                            iconClass = 'bi bi-check-circle-fill';
                            break;
                        case 'Incomplete':
                            statusClass = 'bg-red-100 text-red-800';
                            iconClass = 'bi bi-x-circle-fill';
                            break;
                        default:
                            statusClass = 'bg-gray-100 text-gray-800';
                            iconClass = 'bi bi-question-circle';
                    }
                    statusSpan.className = `${statusClass} px-4 py-1 rounded-full text-sm font-semibold flex items-center gap-1`;
                    statusSpan.innerHTML = `<i class="${iconClass}"></i> <span id="viewStatusText">${escapeHtml(rawStatus || 'Unknown')}</span>`;
                }

                // --- Document link handling: clear wrapper and rebuild ---
                const wrapper = document.getElementById('viewDocumentLinkWrapper');
                wrapper.innerHTML = '';
                let rawLink = data.documentLink || '';
                let hasValidLink = typeof rawLink === 'string' && rawLink.trim() !== '' && rawLink !== 'null' && rawLink !== 'undefined';
                if (hasValidLink) {
                    const linkBtn = document.createElement('a');
                    linkBtn.id = 'viewDocumentLink';
                    linkBtn.href = rawLink.trim();
                    linkBtn.target = '_blank';
                    linkBtn.className = 'w-full bg-gray-800 text-white text-center py-2 rounded-full hover:bg-gray-900 transition flex items-center justify-center gap-1';
                    linkBtn.innerHTML = '<i class="bi bi-box-arrow-up-right"></i> Open Document';
                    wrapper.appendChild(linkBtn);
                } else {
                    const noLinkDiv = document.createElement('div');
                    noLinkDiv.id = 'viewNoDocumentLink';
                    noLinkDiv.className = 'flex items-center text-gray-500 text-sm';
                    noLinkDiv.innerHTML = '<i class="bi bi-exclamation-circle me-1"></i> No link uploaded.';
                    wrapper.appendChild(noLinkDiv);
                }

                // Files handling
                const filesContainer = document.getElementById('viewFiles');
                filesContainer.innerHTML = '';
                let files = [];
                try { files = data.files ? JSON.parse(data.files) : []; } catch(e) { console.error(e); }
                if (files.length > 0) {
                    files.forEach(file => {
                        const fileName = file.split('/').pop();
                        const fileDiv = document.createElement('div');
                        fileDiv.className = 'flex items-center justify-between bg-white p-2 rounded border mb-2';
                        fileDiv.innerHTML = `<div class="flex items-center gap-2"><i class="bi bi-file-earmark-pdf text-danger"></i><span class="text-sm">${escapeHtml(fileName)}</span></div><a href="/document-process/download/${encodeURIComponent(file)}" target="_blank" class="text-blue-600 hover:text-blue-800"><i class="bi bi-download"></i></a>`;
                        filesContainer.appendChild(fileDiv);
                    });
                } else {
                    filesContainer.innerHTML = '<span class="text-gray-500"><i class="bi bi-exclamation-circle me-1"></i> No files available.</span>';
                }
                openModal('viewModal');
            });

            function showToast(message, type = 'success') {
                const container = document.getElementById('toastContainer');
                if (!container) return;
                const toast = document.createElement('div');
                toast.className = `rounded-lg shadow-lg px-4 py-2 text-white ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} transition transform duration-300`;
                toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'} me-2"></i>${message}`;
                container.appendChild(toast);
                setTimeout(() => { toast.classList.add('opacity-0'); setTimeout(() => toast.remove(), 300); }, 3500);
            }

            // ================= LIVE SEARCH =================
            const searchInput = document.getElementById('liveSearch');
            if (searchInput) {
                let timeout;
                searchInput.addEventListener('keyup', function () {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        const val = this.value;
                        const section = document.querySelector('select[name="section"]')?.value || '';
                        fetch(`{{ route('documents.liveSearch') }}?search=${encodeURIComponent(val)}&section=${encodeURIComponent(section)}`)
                            .then(r => r.json())
                            .then(docs => {
                                const container = document.getElementById('documentResults');
                                if (!container) return;
                                container.innerHTML = '';
                                if (!docs.length) { container.innerHTML = '<p class="col-span-full text-center text-gray-500">No documents found.</p>'; return; }
                                docs.forEach(doc => {
                                    let dueBadgeClass = 'bg-gray-100 text-gray-800';
                                    let dueText = doc.next_due_date || 'No deadline';
                                    if (doc.status === 'Done') { dueText = 'Completed'; dueBadgeClass = 'bg-green-100 text-green-800'; }
                                    else if (doc.next_due_date) {
                                        if (doc.is_overdue) dueBadgeClass = 'bg-red-100 text-red-800';
                                        else if (doc.is_due_soon) dueBadgeClass = 'bg-yellow-100 text-yellow-800';
                                    }
                                    const percentage = doc.effective_progress || 0;
                                    const progressColor = doc.progress_color || '#6c757d';
                                    let attachmentsHtml = '';
                                    if (doc.files && doc.files.length) {
                                        doc.files.forEach(file => {
                                            const fileName = file.split('/').pop();
                                            attachmentsHtml += `<div class="flex items-center justify-between text-sm text-gray-700 py-1">
                                                <div class="flex items-center gap-1">
                                                    <i class="bi bi-file-earmark-pdf text-danger"></i>
                                                    <span class="truncate">${escapeHtml(fileName)}</span>
                                                </div>
                                                <a href="/document-process/download/${encodeURIComponent(file)}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            </div>`;
                                        });
                                        attachmentsHtml += `<div class="mt-1 text-xs text-green-600"><i class="bi bi-check-circle"></i> ${doc.files.length} file(s) attached</div>`;
                                    } else {
                                        attachmentsHtml = '<span class="text-sm text-yellow-600"><i class="bi bi-exclamation-circle"></i> No file uploaded</span>';
                                    }
                                    const cardHtml = `<div class="doc-card bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden border border-gray-200 flex flex-col">
                                        <button type="button" class="hidden view-trigger-btn" data-status="${escapeHtml(doc.status)}" data-subject="${escapeHtml(doc.subject_title)}" data-focal="${escapeHtml(doc.focal_person)}" data-created="${escapeHtml(doc.created_at_formatted)}" data-updated="${escapeHtml(doc.updated_at_formatted)}" data-deadline="${escapeHtml(doc.next_due_date || 'No deadline')}" data-frequency="${escapeHtml(doc.frequency)}" data-reference="${escapeHtml(doc.reference || '')}" data-mode="${escapeHtml(doc.mode_of_submission || '')}" data-link="${escapeHtml(doc.cy_link || '')}" data-document-link="${escapeHtml(doc.document_link || '')}" data-remarks="${escapeHtml(doc.remarks || '')}" data-who-will-comply="${escapeHtml(JSON.stringify(doc.who_will_comply || []))}" data-who-will-comply-other="${escapeHtml(doc.who_will_comply_other || '')}" data-files='${JSON.stringify(doc.files)}"></button>
                                        <div class="p-4 border-b border-gray-100 flex justify-between items-start gap-2"><div class="font-bold text-gray-800 text-lg truncate min-w-0" title="${escapeHtml(doc.subject_title)}">${escapeHtml(doc.subject_title)}</div><button type="button" class="doc-open-btn shrink-0 text-gray-500 hover:text-gray-700 transition" data-document-link="${escapeHtml(doc.document_link || '')}"><i class="bi bi-arrow-up-right"></i></button></div>
                                        <div class="px-4 pt-2 pb-1"><div class="relative w-full h-2 bg-gray-200 rounded-full overflow-hidden"><div class="absolute top-0 left-0 h-full rounded-full" style="width: ${percentage}%; background-color: ${progressColor};"></div></div><div class="text-right text-xs text-gray-600 mt-1">${percentage}%</div></div>
                                        <div class="px-4 py-2 flex items-center gap-2"><span class="text-sm font-medium text-gray-700 flex items-center gap-1"><i class="bi bi-check-circle"></i> Status:</span><form action="/documents/${doc.id}/status" method="POST" class="inline-block"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="PATCH"><select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-yellow-400" onchange="this.form.submit()"><option value="To Do" ${doc.status === 'To Do' ? 'selected' : ''}>To Do</option><option value="In Progress" ${doc.status === 'In Progress' ? 'selected' : ''}>In Progress</option><option value="In Review" ${doc.status === 'In Review' ? 'selected' : ''}>In Review</option><option value="Revision" ${doc.status === 'Revision' ? 'selected' : ''}>Revision</option><option value="Done" ${doc.status === 'Done' ? 'selected' : ''}>Done</option><option value="Incomplete" ${doc.status === 'Incomplete' ? 'selected' : ''}>Incomplete</option></select></form></div>
                                        <div class="px-4 py-2 flex items-center gap-2"><span class="text-sm font-medium text-gray-700 flex items-center gap-1"><i class="bi bi-calendar3"></i> Due:</span><span class="inline-block text-sm px-2 py-0.5 rounded-full ${dueBadgeClass}">${dueText}</span></div>
                                        <div class="px-4 py-2 flex items-center gap-2"><span class="text-sm font-medium text-gray-700 flex items-center gap-1"><i class="bi bi-person-badge"></i> Focal Person:</span><span class="text-sm text-gray-900">${escapeHtml(doc.focal_person || 'Not assigned')}</span></div>
                                        <div class="px-4 py-2 border-t border-gray-100 mt-2"><span class="text-sm font-medium text-gray-700 block mb-1 flex items-center gap-1"><i class="bi bi-paperclip"></i> Attachments:</span>${attachmentsHtml}</div>
                                        <div class="flex justify-end gap-3 p-4 border-t border-gray-100 mt-auto"><button class="edit-btn text-gray-600 hover:text-yellow-600 transition" data-target="editModal${doc.id}"><i class="bi bi-pencil"></i></button><button type="button" class="delete-btn text-gray-600 hover:text-yellow-600 transition" title="Archive document" aria-label="Archive document" data-action="/documents/${doc.id}"><i class="bi bi-archive"></i></button></div>
                                    </div>`;
                                    container.innerHTML += cardHtml;
                                });
                            }).catch(err => console.error('Live search error:', err));
                    }, 300);
                });
            }

            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/[&<>]/g, function(m) { if (m === '&') return '&amp;'; if (m === '<') return '&lt;'; if (m === '>') return '&gt;'; return m; });
            }

            @if(session('success'))
                window.addEventListener('load', () => { showToast("{{ session('success') }}"); });
            @endif

            const loader = document.getElementById('loading-screen');
            if (loader) { setTimeout(() => { loader.style.opacity = '0'; setTimeout(() => loader.style.display = 'none', 400); }, 800); }

            window.updateFileList = function (input) {
                const fileListDiv = document.getElementById('fileList');
                if (fileListDiv) fileListDiv.innerHTML = Array.from(input.files).map(f => `<div><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ${escapeHtml(f.name)}</div>`).join('');
            };
            window.updateEditFileList = function (input, docId) {
                const fileListDiv = document.getElementById(`editFileList${docId}`);
                if (fileListDiv) fileListDiv.innerHTML = Array.from(input.files).map(f => `<div><i class="bi bi-file-earmark-pdf text-danger me-1"></i> ${escapeHtml(f.name)}</div>`).join('');
            };
            document.addEventListener('DOMContentLoaded', function() {
                const currentUserName = @json(auth()->user()->name);

                function updateAvatar(avatarId, selectedName) {
                    const avatar = document.getElementById(avatarId);
                    if (!avatar) {
                        return;
                    }

                    const firstLetter = (selectedName || '').trim().charAt(0).toUpperCase() || '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}';
                    avatar.textContent = firstLetter;
                    avatar.classList.add('scale-110');

                    setTimeout(() => {
                        avatar.classList.remove('scale-110');
                    }, 200);
                }

                function syncFocalOptions(select, sectionId, originalOptions, preserveSelectedValue = false) {
                    if (!select) {
                        return;
                    }

                    const selectedValue = select.value || select.dataset.defaultFocal || currentUserName;
                    select.innerHTML = '';

                    if (!sectionId) {
                        select.disabled = true;

                        const placeholderOption = document.createElement('option');
                        placeholderOption.value = '';
                        placeholderOption.textContent = 'Select section first';
                        placeholderOption.disabled = true;
                        placeholderOption.selected = true;
                        select.appendChild(placeholderOption);

                        updateAvatar(select.dataset.avatarId, '');

                        return;
                    }

                    const filteredOptions = originalOptions.filter((option) => {
                        const optionSectionId = option.getAttribute('data-section-id');

                        return optionSectionId === sectionId
                            || option.value === currentUserName
                            || (preserveSelectedValue && option.value === selectedValue);
                    });

                    select.disabled = false;

                    if (!filteredOptions.length) {
                        const emptyOption = document.createElement('option');
                        emptyOption.value = '';
                        emptyOption.textContent = 'No users available in this section';
                        emptyOption.disabled = true;
                        emptyOption.selected = true;
                        select.appendChild(emptyOption);

                        updateAvatar(select.dataset.avatarId, '');

                        return;
                    }

                    filteredOptions.forEach((option) => {
                        select.appendChild(option.cloneNode(true));
                    });

                    const preferredValue = preserveSelectedValue ? selectedValue : (select.dataset.defaultFocal || currentUserName);
                    const nextValue = filteredOptions.some((option) => option.value === preferredValue)
                        ? preferredValue
                        : (filteredOptions.some((option) => option.value === currentUserName) ? currentUserName : filteredOptions[0].value);

                    select.value = nextValue;
                    updateAvatar(select.dataset.avatarId, nextValue);
                }

                const uploadSectionSelect = document.getElementById('upload-section-select');
                const uploadFocalSelect = document.getElementById('upload-focal-select');

                if (uploadSectionSelect && uploadFocalSelect) {
                    const uploadOptions = Array.from(uploadFocalSelect.options);

                    syncFocalOptions(uploadFocalSelect, uploadSectionSelect.value, uploadOptions, true);

                    uploadSectionSelect.addEventListener('change', function() {
                        syncFocalOptions(uploadFocalSelect, this.value, uploadOptions);
                    });

                    uploadFocalSelect.addEventListener('change', function() {
                        updateAvatar(this.dataset.avatarId, this.value);
                    });
                }

                document.querySelectorAll('[id^="editModal"]').forEach((modal) => {
                    const sectionSelect = modal.querySelector('.edit-section-select');
                    const focalSelect = modal.querySelector('.edit-focal-select');

                    if (!sectionSelect || !focalSelect) {
                        return;
                    }

                    const focalOptions = Array.from(focalSelect.options);

                    syncFocalOptions(focalSelect, sectionSelect.value, focalOptions, true);

                    sectionSelect.addEventListener('change', function() {
                        syncFocalOptions(focalSelect, this.value, focalOptions);
                    });

                    focalSelect.addEventListener('change', function() {
                        updateAvatar(this.dataset.avatarId, this.value);
                    });
                });
            });
    // Theme Logic
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            const themeIcon = document.getElementById('themeIcon');
            if (themeIcon) {
                themeIcon.classList.replace('bi-moon-stars', 'bi-sun');
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
            
            // Haptic feel if on mobile
            if (window.navigator.vibrate) window.navigator.vibrate(10);
        }

        // Example function to show how to inject the "Aesthetic" toast
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        
        // Create the toast element
        const toast = document.createElement('div');
        
        // Base Classes for the "Aesthetic" look
        toast.className = `
            pointer-events-auto min-w-[300px] flex items-center p-4 rounded-2xl 
            shadow-2xl border border-white/20 bg-white/70 backdrop-blur-xl
            transform transition-all duration-500 ease-out translate-x-full opacity-0
        `;

        // Inner Content
        toast.innerHTML = `
            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div class="ml-4 mr-8">
                <p class="text-sm font-bold text-slate-800">System Notification</p>
                <p class="text-xs text-slate-500 font-medium">${message}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="ml-auto text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        `;

        container.appendChild(toast);

        // Trigger animation
        requestAnimationFrame(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
        });

        // Auto-remove after 4 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    // ================= COMPLETE SCHEDULE HANDLER (MODAL + DYNAMIC UPDATE) =================
    let pendingCompleteBtn = null;

    // Open modal when any .complete-schedule-btn is clicked (event delegation)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.complete-schedule-btn');
        if (!btn) return;
        e.stopPropagation();
        pendingCompleteBtn = btn;
        openModal('completeScheduleModal');
    });

    // Confirm button inside the modal
    const confirmCompleteBtn = document.getElementById('confirmCompleteBtn');
    if (confirmCompleteBtn) {
        // Remove any existing listener to avoid duplicates
        const newConfirmBtn = confirmCompleteBtn.cloneNode(true);
        confirmCompleteBtn.parentNode.replaceChild(newConfirmBtn, confirmCompleteBtn);
        
        newConfirmBtn.addEventListener('click', async function() {
            if (!pendingCompleteBtn) return;

            const btn = pendingCompleteBtn;
            const docId = btn.dataset.id;
            const card = btn.closest('.doc-card');
            
            // Elements to update
            const progressBar = card.querySelector('.h-full.rounded-full');
            const progressText = card.querySelector('.text-sm.font-black.text-gray-800');
            const dueDateSpan = card.querySelector('.doc-due-date');
            const statusBadge = card.querySelector('.status-badge');

            // Disable button during request
            btn.disabled = true;
            btn.classList.add('opacity-50');

            try {
                const response = await fetch(`{{ url('/documents') }}/${docId}/complete-schedule`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Unable to complete the selected period.');
                }

                if (data.success) {
                    // 1. Update progress bar
                    const newPercent = data.progress;
                    if (progressBar) progressBar.style.width = `${newPercent}%`;
                    if (progressText) progressText.innerText = `${newPercent}%`;

                    // 2. Update due date display
                    if (dueDateSpan) {
                        if (data.isFullyComplete) {
                            dueDateSpan.innerHTML = '<i class="bi bi-check2-circle"></i> COMPLETED';
                            dueDateSpan.classList.remove('text-red-500', 'text-yellow-600', 'text-gray-700');
                            dueDateSpan.classList.add('text-green-600');
                        } else if (data.isNextDueToday) {
                            dueDateSpan.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> DUE TODAY';
                            dueDateSpan.classList.remove('text-green-600', 'text-yellow-600', 'text-gray-700');
                            dueDateSpan.classList.add('text-red-500');
                        } else if (data.nextDueDate) {
                            dueDateSpan.innerText = data.nextDueDate.toUpperCase();
                            dueDateSpan.classList.remove('text-red-500', 'text-green-600', 'text-yellow-600', 'text-gray-700');
                            dueDateSpan.classList.add('text-gray-700');
                        } else {
                            dueDateSpan.innerText = 'NO DEADLINE';
                        }
                    }

                    // 3. Update status badge
                    if (statusBadge && data.newStatus) {
                        statusBadge.classList.remove(
                            'bg-green-100', 'text-green-700',
                            'bg-blue-100', 'text-blue-700',
                            'bg-gray-100', 'text-gray-600',
                            'bg-red-100', 'text-red-700'
                        );
                        if (data.newStatus === 'Done') {
                            statusBadge.classList.add('bg-green-100', 'text-green-700');
                        } else if (data.newStatus === 'In Progress') {
                            statusBadge.classList.add('bg-blue-100', 'text-blue-700');
                        } else if (data.newStatus === 'To Do') {
                            statusBadge.classList.add('bg-gray-100', 'text-gray-600');
                        } else if (data.newStatus === 'Incomplete') {
                            statusBadge.classList.add('bg-red-100', 'text-red-700');
                        }
                        statusBadge.innerText = data.newStatus;
                    }

                    // 4. Toast notification
                    if (data.isFullyComplete) {
                        showToast('🎉 All periods completed! Document marked as Done.', 'success');
                    } else {
                        showToast(data.message, 'success');
                    }
                } else {
                    showToast(data.message || 'No pending periods.', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast(err.message || 'An error occurred. Please try again.', 'error');
            } finally {
                btn.disabled = false;
                btn.classList.remove('opacity-50');
                pendingCompleteBtn = null;
                closeModal('completeScheduleModal');
            }
        });
    }

        </script>
    <script>
        (function() {
            // Close all dropdowns
            function closeAllDropdowns() {
                document.querySelectorAll('.combobox-list').forEach(list => {
                    list.classList.add('hidden');
                });
            }

            // Toggle a specific dropdown
            function toggleDropdown(list) {
                if (list.classList.contains('hidden')) {
                    closeAllDropdowns();
                    list.classList.remove('hidden');
                } else {
                    list.classList.add('hidden');
                }
            }

            // Event delegation for clicks anywhere
            document.addEventListener('click', function(e) {
                // Handle button click (toggle dropdown)
                const btn = e.target.closest('.combobox-btn');
                if (btn) {
                    e.preventDefault();
                    e.stopPropagation();
                    const container = btn.closest('.combobox-container');
                    const list = container.querySelector('.combobox-list');
                    if (list) toggleDropdown(list);
                    return;
                }

                // Handle option selection
                const option = e.target.closest('.combobox-list li');
                if (option) {
                    const list = option.closest('.combobox-list');
                    const container = list.closest('.combobox-container');
                    const input = container.querySelector('.combobox-input');
                    if (input) {
                        input.value = option.innerText;
                        // Trigger change event for any Laravel/Livewire listeners
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                    list.classList.add('hidden');
                    return;
                }

                // Close all dropdowns when clicking outside any combobox
                if (!e.target.closest('.combobox-container')) {
                    closeAllDropdowns();
                }
            });

            // Close dropdown on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllDropdowns();
                }
            });

            // Optional: If you use Livewire or Alpine, ensure re-initialization isn't needed
            // This pure event delegation handles dynamic content automatically.
        })();
        
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

                // Check if any document focal person was switched to current user
                if (currentLatest && currentLatest.focal_person_changed) {
                    const currentUser = '{{ Auth::user()->name }}';
                    if (currentLatest.new_focal_person === currentUser) {
                        reloadForWorkflowUpdate('Document assignment was switched to you. Refreshing...');
                        return;
                    }
                }

                lastAssignedCount = currentCount;
                lastWorkflowUpdate = currentLatest;
            } catch (err) {
                console.warn('Workflow update check failed:', err);
            }
        }

        setInterval(checkWorkflowUpdates, 10000);
        window.addEventListener('DOMContentLoaded', checkWorkflowUpdates);
        
    </script>
</x-app-layout>
