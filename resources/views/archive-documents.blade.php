<x-app-layout>
    @vite('resources/css/document.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Keep original styles plus custom modal styles */
        .modal:not(.show) { display: none !important; }
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
        }

        body { background-color: #f8fafc; }

        .doc-card {
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .doc-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: #e2e8f0;
        }

        .header-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
        }

        .filter-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        
        /* Custom modal styles */
        .custom-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .custom-modal.show {
            display: flex;
        }
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        .modal-backdrop.show {
            display: block;
        }
        .modal-content-custom {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 500px;
            width: 90%;
            animation: modalFadeIn 0.2s ease-out;
        }
        .modal-content-custom.modal-lg {
            max-width: 700px;
        }
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="header-glass p-6 mb-12 flex flex-col lg:flex-row justify-between items-center shadow-sm gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 text-white">
                        <i class="bi bi-archive-fill fs-4"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Archives</h2>
                        <p class="text-slate-500 text-sm font-medium italic">Document Repository</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4 w-full lg:w-auto">
                    <div class="relative w-full md:w-64">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest absolute -top-5 left-1">Filter by Section</label>
                        <select id="sectionFilter" class="filter-select w-full px-4 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition cursor-pointer shadow-sm">
                            <option value="all">All Sections</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ request('section') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <a href="{{ route('documents.my-tasks') }}" 
                       class="w-full md:w-auto px-6 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-50 transition shadow-sm d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-left-short fs-5 me-1"></i>
                        Return
                    </a>
                </div>
            </div>

            <div id="documentGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($archivedDocuments as $doc)
                <div class="doc-card p-6 view-card"
                     data-id="{{ $doc->id }}"
                     data-section="{{ $doc->section }}" 
                     data-subject="{{ $doc->subject_title }}"
                     data-focal="{{ $doc->focal_person }}"
                     data-created="{{ $doc->created_at->format('M d, Y') }}"
                     data-document-link="{{ $doc->document_link ?? '' }}"
                     data-last-comment="{{ $doc->last_comment ?? '' }}"
                     data-files='@json($doc->file_path)'
                     data-restore-url="{{ route('documentsProcess.restore', $doc->id) }}"
                     data-delete-url="{{ route('documentsProcess.forceDelete', $doc->id) }}">
                    
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-2 bg-slate-50 rounded-lg">
                            <i class="bi bi-file-earmark-zip text-slate-400"></i>
                        </div>
                        <span class="status-badge-modern text-uppercase">Archived</span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-2 leading-snug min-h-[56px]">
                        {{ Str::limit($doc->subject_title, 60) }}
                    </h3>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center justify-between py-2 border-b border-slate-50">
                            <span class="text-xs font-bold text-slate-400">SECTION</span>
                            <span class="text-sm font-semibold text-indigo-600 max-w-[200px] truncate" 
                                title="@if($doc->section){{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}@else Not specified @endif">
                                @if($doc->section)
                                    {{ App\Models\Section::find($doc->section)?->name ?? 'Unknown Section' }}
                                @else
                                    Not specified
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400">FOCAL</span>
                            <span class="text-sm font-semibold text-slate-700">{{ $doc->focal_person }}</span>
                        </div>
                    </div>
                    
                    <div class="card-actions flex gap-3 pt-2">
                        <button type="button" class="btn btn-delete-soft btn-sm px-3 py-2.5 delete-btn"><i class="bi bi-trash3"></i></button>
                    </div>
                </div>
                @empty
                    <div id="emptyState" class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                        <p class="text-slate-400 font-bold">The archives are empty</p>
                    </div>
                @endforelse
                
            </div>
            
            <div id="noResults" class="hidden col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200">
                <i class="bi bi-search text-4xl text-slate-300 mb-4 d-block"></i>
                <h5 class="text-slate-400 font-bold">No documents found for this section</h5>
            </div>

            @php
                $isShowingAll = request()->boolean('show_all');
                $archiveCount = $isShowingAll ? $archivedDocuments->count() : $archivedDocuments->total();
                $hasMoreArchivedDocuments = $archiveCount > 6;
                $archiveQuery = request()->except(['page', 'show_all']);
            @endphp
            @if($hasMoreArchivedDocuments)
                <div class="mt-8 flex justify-end">
                    @if($isShowingAll)
                        <a href="{{ route('documents.archivePage', $archiveQuery) }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 shadow-sm transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
                            <i class="bi bi-chevron-up" aria-hidden="true"></i>
                            Show less
                        </a>
                    @else
                        <a href="{{ route('documents.archivePage', array_merge($archiveQuery, ['show_all' => 1])) }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-indigo-200 bg-white px-5 py-2.5 text-sm font-bold text-indigo-600 shadow-sm transition hover:bg-indigo-50">
                            See all
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Custom View Modal -->
    <div id="viewModal" class="custom-modal">
        <div class="modal-content-custom modal-lg w-full max-w-3xl">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h5 class="text-xl font-bold text-slate-800">
                        <i class="bi bi-file-text-fill text-indigo-600 me-2"></i> Document Details
                    </h5>
                    <button type="button" class="text-slate-400 hover:text-slate-600 close-modal" data-modal="viewModal">
                        <i class="bi bi-x-lg text-lg"></i>
                    </button>
                </div>
                <div class="bg-slate-50 rounded-2xl p-4 mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Section</label>
                            <p class="text-slate-800 font-semibold mt-1" id="modalSection">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Focal Person</label>
                            <p class="text-slate-800 font-semibold mt-1" id="modalFocal">-</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Subject Title</label>
                            <p class="text-slate-800 font-semibold mt-1" id="modalSubject">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Archived Date</label>
                            <p class="text-slate-800 mt-1" id="modalCreated">-</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Document Link</label>
                            <p class="mt-1" id="modalDocumentLink">-</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide">Last Comment</label>
                            <p class="text-slate-600 mt-1" id="modalLastComment">-</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-2 d-block">Attached Files</label>
                            <div id="modalFilesList" class="space-y-2">
                                <p class="text-slate-400 text-sm">No files attached</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 close-modal" data-modal="viewModal">Close</button>
                </div>
            </div>
        </div>
    </div>


  <!-- Custom Delete Modal -->
<div id="deleteModal" class="custom-modal">
    <div class="modal-content-custom">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle-fill text-red-600 text-xl"></i>
                </div>
                <h5 class="text-lg font-bold text-slate-800">Confirm Permanent Deletion</h5>
            </div>
            <p class="text-slate-600 mb-6">This action cannot be undone. The document will be permanently deleted from the archives.</p>
            <div class="flex justify-end gap-3">
                <button type="button" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 close-modal" data-modal="deleteModal">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="btn-text">Permanently Delete</span>
                    <span class="btn-spinner hidden">
                        <i class="bi bi-arrow-repeat animate-spin"></i> Deleting...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
    <!-- Shared Backdrop -->
    <div id="modalBackdrop" class="modal-backdrop"></div>

   <script>
    document.addEventListener('DOMContentLoaded', function(){
        // ---------- Section filter ----------
        const sectionFilter = document.getElementById('sectionFilter');

        sectionFilter.addEventListener('change', function() {
            const url = new URL(window.location.href);

            if (this.value === 'all') {
                url.searchParams.delete('section');
            } else {
                url.searchParams.set('section', this.value);
            }

            url.searchParams.delete('page');
            url.searchParams.delete('show_all');
            window.location.assign(url);
        });

        // ---------- Custom modal system ----------
        const backdrop = document.getElementById('modalBackdrop');
        let activeModal = null;
        let currentDeleteUrl = null;
        let currentDeleteCard = null;

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            if (activeModal) closeModal(activeModal);
            modal.classList.add('show');
            backdrop.classList.add('show');
            activeModal = modalId;
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.remove('show');
            backdrop.classList.remove('show');
            activeModal = null;
            document.body.style.overflow = '';
        }

        function closeAllModals() {
            ['viewModal', 'restoreModal', 'deleteModal'].forEach(id => {
                const m = document.getElementById(id);
                if (m) m.classList.remove('show');
            });
            backdrop.classList.remove('show');
            activeModal = null;
            document.body.style.overflow = '';
        }

        backdrop.addEventListener('click', closeAllModals);
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal');
                if (modalId) closeModal(modalId);
                else closeAllModals();
            });
        });

        // Escape key support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && activeModal) {
                closeAllModals();
            }
        });

        // Helper: Show temporary toast message
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-5 right-5 z-50 px-4 py-2 rounded-xl shadow-lg text-white text-sm font-semibold transition-all duration-300 ${type === 'success' ? 'bg-emerald-600' : 'bg-red-600'}`;
            toast.innerText = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Helper: Show/hide empty archive state
        function updateEmptyArchiveState() {
            const remainingCards = document.querySelectorAll('.view-card');
            const grid = document.getElementById('documentGrid');
            const existingEmpty = document.getElementById('dynamicEmptyState');
            
            if (remainingCards.length === 0) {
                if (!existingEmpty) {
                    const emptyDiv = document.createElement('div');
                    emptyDiv.id = 'dynamicEmptyState';
                    emptyDiv.className = 'col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-200';
                    emptyDiv.innerHTML = `
                        <i class="bi bi-archive text-4xl text-slate-300 mb-4 d-block"></i>
                        <p class="text-slate-400 font-bold">The archives are empty</p>
                    `;
                    grid.appendChild(emptyDiv);
                }
                // Hide noResults if visible
                noResults.classList.add('hidden');
            } else {
                if (existingEmpty) existingEmpty.remove();
            }
        }

        // ---------- View Modal ----------
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        function populateViewModal(card) {
    const sectionId = card.getAttribute('data-section') || 'N/A';
    const subject = card.getAttribute('data-subject') || 'No title';
    const focal = card.getAttribute('data-focal') || 'N/A';
    const created = card.getAttribute('data-created') || 'Unknown date';
    let documentLink = card.getAttribute('data-document-link') || '';
    const lastComment = card.getAttribute('data-last-comment') || 'No comments';
    let filesJson = card.getAttribute('data-files') || '[]';
    
    let files = [];
    try {
        const parsed = JSON.parse(filesJson);
        if (Array.isArray(parsed)) files = parsed;
        else if (typeof parsed === 'string') files = [parsed];
    } catch(e) {
        if (filesJson && filesJson.trim() !== '') files = [filesJson];
    }
    
    // Convert section ID to section name
    let sectionName = 'Not specified';
    if (sectionId && sectionId !== 'N/A') {
        const sectionDisplay = card.querySelector('.text-indigo-600');
        if (sectionDisplay) {
            sectionName = sectionDisplay.textContent.trim();
        } else {
            sectionName = 'Unknown Section';
        }
    }
    
    document.getElementById('modalSection').innerText = sectionName;
    document.getElementById('modalSubject').innerText = subject;
    document.getElementById('modalFocal').innerText = focal;
    document.getElementById('modalCreated').innerText = created;
    document.getElementById('modalLastComment').innerText = lastComment;
    
    const linkContainer = document.getElementById('modalDocumentLink');
    if (documentLink && documentLink.trim() !== '') {
        let displayLink = documentLink;
        if (!displayLink.startsWith('http://') && !displayLink.startsWith('https://')) {
            displayLink = '//' + displayLink;
        }
        linkContainer.innerHTML = `<a href="${displayLink}" target="_blank" class="text-indigo-600 hover:underline break-all">${escapeHtml(documentLink)}</a>`;
    } else {
        linkContainer.innerHTML = '<span class="text-slate-400">No link provided</span>';
    }
    
    const filesContainer = document.getElementById('modalFilesList');
    if (files.length > 0) {
        let filesHtml = '<div class="space-y-2">';
        files.forEach((file, index) => {
    const fileName = file.split('/').pop() || `file_${index+1}`;
    
    // Encode only the path, not the slashes
    const encodedFile = file.split('/').map(segment => encodeURIComponent(segment)).join('/');
    const downloadUrl = `/document-process/download/${encodedFile}`;
    
    filesHtml += `
        <div class="flex items-center justify-between p-2 rounded-lg border border-slate-100">
            <div class="flex items-center gap-2">
                <i class="bi bi-file-earmark-text text-slate-400"></i>
                <span class="text-sm text-slate-700 truncate max-w-[200px]">${escapeHtml(fileName)}</span>
            </div>
            <a href="${downloadUrl}" 
               class="download-btn text-indigo-500 hover:text-indigo-700 text-sm inline-flex items-center gap-1">
                <i class="bi bi-download"></i> Download
            </a>
        </div>
    `;
});
        filesHtml += '</div>';
        filesContainer.innerHTML = filesHtml;
    } else {
        filesContainer.innerHTML = '<p class="text-slate-400 text-sm">No attached files</p>';
    }
}

        // Card click - view modal
        document.querySelectorAll('.view-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.restore-btn') || e.target.closest('.delete-btn')) return;
                populateViewModal(this);
                openModal('viewModal');
            });
        });

        // ---------- Restore (kept as form submit, but that's fine) ----------
        const restoreBtns = document.querySelectorAll('.restore-btn');
        const restoreForm = document.getElementById('restoreForm');
        restoreBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const card = this.closest('.view-card');
                const restoreUrl = card.getAttribute('data-restore-url');
                if (restoreUrl) {
                    restoreForm.action = restoreUrl;
                    openModal('restoreModal');
                } else {
                    showToast('Restore URL missing', 'error');
                }
            });
        });

        // ---------- DELETE - AJAX implementation ----------
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        
        // Open delete modal and store card reference
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const card = this.closest('.view-card');
                const deleteUrl = card.getAttribute('data-delete-url');
                if (deleteUrl) {
                    currentDeleteUrl = deleteUrl;
                    currentDeleteCard = card;
                    openModal('deleteModal');
                } else {
                    showToast('Delete URL missing', 'error');
                }
            });
        });

        // Handle delete confirmation
        confirmDeleteBtn.addEventListener('click', async function() {
            if (!currentDeleteUrl || !currentDeleteCard) {
                closeModal('deleteModal');
                showToast('No document selected for deletion', 'error');
                return;
            }

            // Show loading state
            const btnText = this.querySelector('.btn-text');
            const btnSpinner = this.querySelector('.btn-spinner');
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            this.disabled = true;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                  document.head.querySelector('meta[name="csrf-token"]')?.content;
                
                const response = await fetch(currentDeleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Remove card from DOM
                    currentDeleteCard.remove();
                    
                    // Update filter options (optional: remove section from dropdown if no cards left with that section)
                    const remainingCards = document.querySelectorAll('.view-card');
                    if (remainingCards.length === 0) {
                        // Reset filter to "all" when archives become empty
                        sectionFilter.value = 'all';
                        sectionFilter.dispatchEvent(new Event('change'));
                    } else {
                        // Re-trigger filter to refresh visibility
                        sectionFilter.dispatchEvent(new Event('change'));
                    }
                    
                    updateEmptyArchiveState();
                    showToast('Document permanently deleted', 'success');
                    closeModal('deleteModal');
                } else {
                    throw new Error(data.message || 'Deletion failed');
                }
            } catch (error) {
                console.error('Delete error:', error);
                showToast(error.message || 'Something went wrong. Please try again.', 'error');
            } finally {
                // Reset loading state
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
                this.disabled = false;
                currentDeleteUrl = null;
                currentDeleteCard = null;
            }
        });

        // Initial empty state check (in case there were no documents from the start)
        updateEmptyArchiveState();
    });
</script>
</x-app-layout>