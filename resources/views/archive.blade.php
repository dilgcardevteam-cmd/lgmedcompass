<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@vite('resources/css/archive.css')

<style>
.modal {

    .task-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0,0,0,0.05);
        background: #ffffff;
    }
    .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px -10px rgba(0,0,0,0.1);
        border-color: #fbbf24; /* Warning color for archive */
    }
    .glass-filter {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .status-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    /* Modal z-index fixes */
    #viewArchivedModal {
        z-index: 1060 !important;
    }
    .modal-backdrop.show {
        z-index: 1055 !important;
    }
    /* Status Colors */
    .done { background-color: #dcfce7; color: #166534; }
    .in-progress { background-color: #dbeafe; color: #1e40af; }
    .to-do { background-color: #fef9c3; color: #854d0e; }
    .incomplete { background-color: #fee2e2; color: #991b1b; }
</style>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="bi bi-archive text-yellow-600"></i>
                    </div>
                    Document Archive
                </h2>
                <p class="text-gray-500 mt-1 ml-12">Archived documents are retained for 3 years before permanent deletion.</p>
            </div>

           <a href="{{ route('documents.index') }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 transition-all shadow-sm gap-2 no-underline">
                <i class="bi bi-arrow-left"></i>
                Back to Management
            </a>
        </div>

        <div class="glass-filter p-4 rounded-2xl mb-10 shadow-sm">
            <form method="GET" action="{{ route('documents.archiveIndex') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="bi bi-search text-gray-400"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="block w-full pl-10 pr-3 py-2.5 border-gray-200 rounded-xl focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                           placeholder="Search by title...">
                </div>

                <select name="section" onchange="this.form.submit()"
                        class="block w-full py-2.5 border-gray-200 rounded-xl focus:ring-yellow-500 focus:border-yellow-500 text-sm">
                    <option value="">All Sections</option>
                    @foreach($sections as $sec)
                        <option value="{{ $sec->id }}" {{ (string) request('section') === (string) $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                    @endforeach
                </select>

                <select name="frequency" onchange="this.form.submit()"
                        class="block w-full py-2.5 border-gray-200 rounded-xl focus:ring-yellow-500 focus:border-yellow-500 text-sm">
                    <option value="">All Frequencies</option>
                    @foreach(['weekly', 'bi-monthly', 'monthly', 'quarterly', 'semestral', 'annual', 'as-needed'] as $freq)
                        <option value="{{ $freq }}" {{ request('frequency') == $freq ? 'selected' : '' }}>{{ $freq === 'as-needed' ? 'As need arises' : ($freq === 'bi-monthly' ? 'Bi-monthly (twice per month)' : ucfirst($freq)) }}</option>
                    @endforeach
                </select>

                <a href="{{ route('documents.archiveIndex') }}" class="text-center py-2.5 text-sm text-gray-500 hover:text-gray-700 font-medium">
                    Clear Filters
                </a>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($documents as $doc)
                <div class="task-card group relative flex flex-col p-5 rounded-2xl view-trigger-card cursor-pointer" 
                     data-doc-id="{{ $doc->id }}" 
                     data-doc-title="{{ $doc->subject_title }}"
                     data-status="{{ $doc->status }}"
                     data-focal="{{ ucfirst($doc->focal_person) }}"
                     data-deleted-on="{{ \Carbon\Carbon::parse($doc->deleted_at)->format('M d, Y') }}"
                     data-delete-after="{{ \Carbon\Carbon::parse($doc->deleted_at)->addYears(3)->format('M d, Y') }}"
                     data-section="{{ $doc->section ? App\Models\Section::find($doc->section)?->name : 'Not specified' }}"
                     data-frequency="{{ ucfirst($doc->frequency) }}"
                     data-remarks="{{ $doc->remarks ?? 'No remarks' }}"
                     data-document-link="{{ $doc->document_link ?? '' }}"
                     data-files='@json($doc->file_path ? json_decode($doc->file_path) : [])'>
                     
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1 pr-4">
                            <h3 class="text-lg font-bold text-gray-800 leading-tight group-hover:text-yellow-600 transition-colors">
                                {{ $doc->subject_title }}
                            </h3>
                        </div>
                        <span class="status-badge {{ strtolower(str_replace(' ', '-', $doc->status)) }}">
                            {{ $doc->status }}
                        </span>
                    </div>

                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="bi bi-person-circle mr-2 text-gray-400"></i>
                            <span class="font-medium mr-1 text-gray-900">Focal:</span> {{ ucfirst($doc->focal_person) }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="bi bi-calendar-x mr-2 text-red-400"></i>
                            <span class="font-medium mr-1 text-gray-900">Archived:</span> {{ \Carbon\Carbon::parse($doc->deleted_at)->format('M d, Y') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="bi bi-hourglass-split mr-2 text-amber-500"></i>
                            <span class="font-medium mr-1 text-gray-900">Deletes after:</span> {{ \Carbon\Carbon::parse($doc->deleted_at)->addYears(3)->format('M d, Y') }}
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center gap-2">
                        <form method="POST" action="{{ route('documents.restore', $doc->id) }}" class="restore-form flex-1">
                            @csrf @method('PATCH')
                            <button type="button" class="restore-btn w-full py-2 bg-yellow-50 text-yellow-700 hover:bg-yellow-100 rounded-xl text-sm font-bold transition-colors flex items-center justify-center gap-2">
                                <i class="bi bi-arrow-counterclockwise"></i> Restore
                            </button>
                        </form>

                        @auth
                            @if(Auth::user()->role === 'Admin')
                                <form method="POST" action="{{ route('documents.forceDelete', $doc->id) }}" class="purge-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="purge-btn p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" title="Purge Permanently">
                                        <i class="bi bi-trash3 text-lg"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-24 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="bi bi-trash text-4xl text-gray-300"></i>
                    </div>
                    <p class="text-gray-500 font-medium text-lg">The archive is empty</p>
                    <p class="text-gray-400 text-sm">No archived documents found matching your filters.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $documents->links() }}
        </div>
    </div>
</section>

<!-- ========== RESTORE CONFIRMATION MODAL ========== -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Confirm Restore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore <strong id="restoreDocTitle"></strong>?</p>
                <p class="text-muted mb-0">This document will be moved back to active documents.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" id="confirmRestoreBtn">Restore</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== PURGE CONFIRMATION MODAL ========== -->
<div class="modal fade" id="purgeModal" tabindex="-1" aria-labelledby="purgeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purgeModalLabel">Permanently Delete Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are about to <strong class="text-danger">permanently delete</strong> <strong id="purgeDocTitle"></strong>.</p>
                <p class="text-danger fw-bold">This action is irreversible and cannot be undone.</p>
                <p>Are you absolutely sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmPurgeBtn">Permanently Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- ========== VIEW DETAILS MODAL ========== -->
<div class="modal fade mt-4" id="viewArchivedModal" tabindex="-1" aria-labelledby="viewArchivedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow-2xl rounded-5 overflow-hidden">
            <div class="modal-header border-0 px-4 pt-4 pb-0 bg-white">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger-subtle text-danger rounded-3 p-2 me-3 shadow-sm">
                            <i class="bi bi-trash3-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0">Document Details</h5>
                            <small class="text-muted">Reviewing trashed repository item</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div class="modal-body p-4">
                <div class="row g-4">
                    <!-- Left column -->
                    <div class="col-md-7">
                        <div class="p-3 mb-4 rounded-4 bg-light border-0 shadow-sm">
                            <h6 class="text-uppercase text-muted extra-small fw-bold mb-2">
                                <i class="bi bi-tag-fill me-1"></i> Document Title
                            </h6>
                            <p id="viewTitle" class="fs-5 fw-bold text-dark mb-0">—</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Status</label>
                                <span id="viewStatus" class="badge rounded-pill px-3 py-2 fw-medium shadow-sm">—</span>
                            </div>
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Focal Person</label>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs me-2 rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:24px;height:24px;font-size:10px;">FP</div>
                                    <span id="viewFocal" class="fw-semibold text-secondary small">—</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Archived On</label>
                                <p id="viewArchivedOn" class="fw-medium text-dark small mb-0">
                                    <i class="bi bi-calendar-x text-danger me-1"></i> —
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Section</label>
                                <p id="viewSection" class="fw-medium text-dark small mb-0">
                                    <i class="bi bi-building-gear text-primary me-1"></i> —
                                </p>
                            </div>
                            <!-- ✅ ADDED Frequency row -->
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Deletes After</label>
                                <p id="viewDeleteAfter" class="fw-medium text-dark small mb-0">
                                    <i class="bi bi-hourglass-split text-warning me-1"></i> -
                                </p>
                            </div>
                            <div class="col-6">
                                <label class="text-uppercase text-muted extra-small fw-bold d-block mb-1">Frequency</label>
                                <p id="viewFrequency" class="fw-medium text-dark small mb-0">
                                    <i class="bi bi-calendar-week me-1"></i> —
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right column -->
                    <div class="col-md-5">
                        <div class="d-flex flex-column h-100 g-3">
                            <div class="p-3 mb-3 rounded-4 border border-2 border-dashed border-light shadow-sm">
                                <h6 class="text-uppercase text-muted extra-small fw-bold mb-3">Resource Link</h6>
                                <div id="viewLinkWrapper">
                                    <a href="#" id="viewDocumentLink" target="_blank" class="btn btn-primary w-100 rounded-3 py-2 fw-bold shadow-sm">
                                        <i class="bi bi-box-arrow-up-right me-2"></i>View Original
                                    </a>
                                    <p id="viewNoLink" class="text-muted small mb-0 d-none text-center">No link attached</p>
                                </div>
                            </div>

                            <div class="p-3 rounded-4 bg-gray-50 border-0 flex-grow-1">
                                <h6 class="text-uppercase text-muted extra-small fw-bold mb-2">Attachments</h6>
                                <div id="viewFilesList" class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center p-2 bg-white rounded-3 shadow-xs border border-light">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                        <span class="text-muted small">No files available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Full width remarks -->
                    <div class="col-12 mt-2">
                        <div class="p-3 rounded-4" style="background-color:#f8fafc; border-left:4px solid #cbd5e1;">
                            <h6 class="text-uppercase text-muted extra-small fw-bold mb-2">Internal Remarks</h6>
                            <p id="viewRemarks" class="mb-0 text-secondary fst-italic small leading-relaxed">—</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-light px-4 py-2 rounded-3 fw-semibold text-muted" data-bs-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>
<!-- TOAST CONTAINER -->
<div id="toastContainer" class="fixed bottom-5 right-5 z-50 flex flex-col items-end gap-3 pointer-events-none"></div>
<script>
    // Store references to the form that will be submitted
    let pendingRestoreForm = null;
    let pendingPurgeForm = null;

    // Restore button handlers
    document.querySelectorAll('.restore-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click
            const card = this.closest('.task-card');
            const docTitle = card.getAttribute('data-doc-title');
            const restoreForm = card.querySelector('.restore-form');

            pendingRestoreForm = restoreForm;
            document.getElementById('restoreDocTitle').innerText = docTitle;
            new bootstrap.Modal(document.getElementById('restoreModal')).show();
        });
    });

    // Purge button handlers (Admin only)
    document.querySelectorAll('.purge-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click
            const card = this.closest('.task-card');
            const docTitle = card.getAttribute('data-doc-title');
            const purgeForm = card.querySelector('.purge-form');

            pendingPurgeForm = purgeForm;
            document.getElementById('purgeDocTitle').innerText = docTitle;
            new bootstrap.Modal(document.getElementById('purgeModal')).show();
        });
    });

    // Confirm restore action
    document.getElementById('confirmRestoreBtn').addEventListener('click', function() {
        if (pendingRestoreForm) {
            pendingRestoreForm.submit();
        }
    });

    // Confirm purge action
    document.getElementById('confirmPurgeBtn').addEventListener('click', function() {
        if (pendingPurgeForm) {
            pendingPurgeForm.submit();
        }
    });

    // ========== VIEW MODAL LOGIC ==========
    const viewModal = new bootstrap.Modal(document.getElementById('viewArchivedModal'));
    const cards = document.querySelectorAll('.view-trigger-card');

    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Ignore if click originated from a button or inside a form
            if (e.target.closest('button') || e.target.closest('form')) return;

            // Extract data attributes
            const title = this.dataset.docTitle || '—';
            const status = this.dataset.status || '—';
            const focal = this.dataset.focal || '—';
            const deletedOn = this.dataset.deletedOn || '—';
            const deleteAfter = this.dataset.deleteAfter || '-';
            const section = this.dataset.section || '—';
            const frequency = this.dataset.frequency || '—';
            const remarks = this.dataset.remarks || 'No remarks';
            const docLink = this.dataset.documentLink || '';
            let files = [];
            try {
                files = JSON.parse(this.dataset.files || '[]');
            } catch(e) { files = []; }

            // Fill modal fields
            document.getElementById('viewTitle').innerText = title;
            const statusSpan = document.getElementById('viewStatus');
            statusSpan.innerText = status;
            // Apply status color
            let statusClass = 'bg-secondary';
            if (status === 'Done') statusClass = 'bg-success';
            else if (status === 'In Progress') statusClass = 'bg-primary';
            else if (status === 'To Do') statusClass = 'bg-warning text-dark';
            else if (status === 'Incomplete') statusClass = 'bg-danger';
            statusSpan.className = `badge ${statusClass} fs-6 fw-normal px-3 py-2`;

            document.getElementById('viewFocal').innerText = focal;
            document.getElementById('viewArchivedOn').innerText = deletedOn;
            document.getElementById('viewDeleteAfter').innerText = deleteAfter;
            document.getElementById('viewSection').innerText = section;
            document.getElementById('viewFrequency').innerText = frequency;
            document.getElementById('viewRemarks').innerText = remarks;

            // Handle document link
            const linkBtn = document.getElementById('viewDocumentLink');
            const noLinkMsg = document.getElementById('viewNoLink');
            if (docLink && docLink.trim() !== '') {
                linkBtn.href = docLink;
                linkBtn.classList.remove('d-none');
                if (noLinkMsg) noLinkMsg.classList.add('d-none');
            } else {
                linkBtn.classList.add('d-none');
                if (noLinkMsg) noLinkMsg.classList.remove('d-none');
            }

            // Handle attachments
            const filesContainer = document.getElementById('viewFilesList');
            filesContainer.innerHTML = '';
            if (files.length > 0) {
                files.forEach(file => {
                    const fileName = file.split('/').pop();
                    const fileUrl = `/document-process/download/${encodeURIComponent(file)}`;
                    const fileItem = document.createElement('div');
                    fileItem.className = 'd-flex justify-content-between align-items-center border-bottom pb-2 mb-2';
                    fileItem.innerHTML = `
                        <div class="flex items-center gap-2">
                            <i class="bi bi-file-earmark-pdf text-danger me-2 flex-shrink-0"></i>
                            <span class="text-sm text-gray-700 truncate max-w-[200px]" title="${escapeHtml(fileName)}">${escapeHtml(fileName)}</span>
                        </div>
                        <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-secondary flex-shrink-0">
                            <i class="bi bi-download"></i> Download
                        </a>
                    `;
                    filesContainer.appendChild(fileItem);
                });
            } else {
                filesContainer.innerHTML = '<span class="text-muted">No attachments</span>';
            }

            viewModal.show();
        });
    });

    // Helper function to escape HTML
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    // ==================== AUTO REFRESH ====================
    let lastUpdate = null;
    function checkUpdates(){
        fetch('/documents/check-updates')
            .then(res => res.json())
            .then(data => {
                if(!lastUpdate){
                    lastUpdate = data.latest;
                    return;
                }
                if(data.latest !== lastUpdate){
                    location.reload();
                }
            })
            .catch(err => console.warn('Auto-refresh error:', err));
    }
    setInterval(checkUpdates, 3000);
</script>
</x-app-layout>
