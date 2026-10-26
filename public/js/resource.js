/*******************************************************
 *  resource-manager.js
 *  Reusable drive / file manager for any category
 *  Requires global window.ResourceManagerConfig
 *******************************************************/
(function() {
    'use strict';

    // ----- Helper functions -----
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function formatFileSize(sizeKB) {
        if (sizeKB === null || sizeKB === undefined) return '—';
        if (sizeKB < 1024) return `${sizeKB.toFixed(1)} KB`;
        return `${(sizeKB / 1024).toFixed(1)} MB`;
    }

    function formatDate(dateStr) {
        if (!dateStr) return '—';
        try {
            let d = new Date(dateStr);
            return d.toLocaleString();
        } catch (e) { return dateStr; }
    }

    // ----- Configuration (set by the including blade) -----
    const cfg = window.ResourceManagerConfig || {};
    const isAdmin = cfg.isAdmin || false;
    const categorySlug = cfg.categorySlug || '';
    let currentFolderId = cfg.currentFolderId || null;
    let folderPath = [];
    let deleteTarget = null;
    let renameTarget = { type: null, id: null };
    const tableStyle = cfg.showFullDetails ? 'full' : 'simple';

    // ----- FILE SIZE VALIDATION (MUST BE BEFORE ANY USE) -----
    const MAX_TOTAL_SIZE_MB = 50;
    const MAX_TOTAL_SIZE_BYTES = MAX_TOTAL_SIZE_MB * 1024 * 1024;

    function getTotalSize(files) {
        let total = 0;
        for (let i = 0; i < files.length; i++) total += files[i].size;
        return total;
    }

    function validateTotalSize(files) {
        const totalBytes = getTotalSize(files);
        if (totalBytes > MAX_TOTAL_SIZE_BYTES) {
            const totalMB = (totalBytes / (1024 * 1024)).toFixed(1);
            window.showErrorToast(`Total file size (${totalMB} MB) exceeds the ${MAX_TOTAL_SIZE_MB} MB limit. Please select fewer or smaller files.`);
            return false;
        }
        return true;
    }

    // ----- API loader -----
    function loadData() {
        let url = `/resource/folders/${categorySlug}`;
        if (currentFolderId) url += `/${currentFolderId}`;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                renderFolders(data.folders);
                renderFiles(data.files);
                renderBreadcrumb();
                updateButtonsVisibility();
            })
            .catch(err => console.error(err));
    }

    // ----- Folder rendering -----
    function renderFolders(folders) {
        const container = document.getElementById('folderContainer');
        if (!container) return;
        container.innerHTML = '';
        folders.forEach(folder => {
            const div = document.createElement('div');
            div.className = 'folder';
            div.setAttribute('data-type', 'folder');
            div.setAttribute('data-id', folder.id);
            div.setAttribute('data-name', folder.name);
            div.addEventListener('click', () => openFolder(folder.id, folder.name));
            div.innerHTML = `
                <i class="bi bi-folder-fill"></i>
                <div class="folder-name" title="${escapeHtml(folder.name)}">${escapeHtml(folder.name)}</div>
            `;
            div.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                e.stopPropagation();
                showContextMenu(e.clientX, e.clientY, 'folder', folder.id, folder.name);
            });
            container.appendChild(div);
        });
    }

    function guardWriteAction(actionName) {
        if (cfg.isTechnicalInspector) {
            window.showErrorToast(`You are a Technical Inspector (read‑only). Cannot ${actionName}.`);
            return false;
        }
        return true;
    }
    // ----- File rendering (adapts to table style) -----
    function renderFiles(files) {
        const tableBody = document.getElementById('fileTable');
        const tableWrapper = document.getElementById('tableWrapper');
        if (!tableBody || !tableWrapper) return;
        tableBody.innerHTML = '';
        if (files.length === 0) {
            tableWrapper.style.display = 'none';
            return;
        }
        tableWrapper.style.display = 'block';
        files.forEach(file => {
            const icon = file.type === 'LINK' ? 'bi-link-45deg' : 'bi-file-earmark-text';
            const viewLink = file.type === 'FILE'
                ? `<a href="${file.url}" target="_blank" class="action-icon"><i class="bi bi-eye"></i></a>`
                : `<a href="${file.url}" target="_blank" class="action-icon"><i class="bi bi-arrow-up-right"></i></a>`;
            const deleteButton = isAdmin
                ? `<button class="action-icon delete" onclick="event.stopPropagation(); openDeleteModal('file', ${file.id})"><i class="bi bi-trash"></i></button>`
                : '';

            const row = document.createElement('tr');
            row.setAttribute('data-type', 'file');
            row.setAttribute('data-id', file.id);
            row.setAttribute('data-name', file.name);

            const uploadedByName = (file.user && file.user.name) ? file.user.name : (file.uploaded_by_name || '—');
            const dateModified = file.updated_at_formatted || file.updated_at || null;
            const fileSize = (file.type === 'FILE') ? (file.size_in_kb ?? file.size ?? null) : null;

            if (tableStyle === 'full') {
                // 6‑column layout (assistant‑chief style)
                row.innerHTML = `
                    <td><span class="file-name-cell" title="${escapeHtml(file.name)}"><i class="bi ${icon}" style="margin-right:8px;"></i>${escapeHtml(file.name)}</span></td>
                    <td>${escapeHtml(uploadedByName)}</td>
                    <td>${formatDate(dateModified)}</td>
                    <td>${file.type === 'FILE' ? formatFileSize(fileSize) : '—'}</td>
                    <td><span style="background:var(--primary-soft); padding:4px 10px; border-radius:6px; font-size:0.7rem; font-weight:700;">${file.type}</span></td>
                    <td class="action-cell">${viewLink}${deleteButton}</td>
                `;
            } else {
                // Simple 4‑column layout (original drive blade)
                row.innerHTML = `
                    <td style="font-weight:500;"><i class="bi ${icon}" style="margin-right:8px; color:var(--text-muted)"></i>${escapeHtml(file.name)}</td>
                    <td style="color:#7c5e3a; font-size:0.85rem">${currentFolderId ? 'Current Folder' : 'Root'}</td>
                    <td><span style="background:var(--primary-soft); padding:4px 10px; border-radius:6px; font-size:0.75rem; font-weight:700; color:var(--text-main);">${file.type}</span></td>
                    <td class="action-cell">${viewLink}${deleteButton}</td>
                `;
            }

            row.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                showContextMenu(e.clientX, e.clientY, 'file', file.id, file.name);
            });
            tableBody.appendChild(row);
        });
    }

    // ----- Breadcrumb & navigation -----
    function renderBreadcrumb() {
        const breadcrumb = document.getElementById('breadcrumb');
        if (!breadcrumb) return;
        let html = `<span onclick="goRoot()">My Drive</span>`;
        folderPath.forEach((folder, idx) => {
            html += `<i class="bi bi-chevron-right"></i> <span onclick="jumpToPath(${idx})">${escapeHtml(folder.name)}</span>`;
        });
        breadcrumb.innerHTML = html;
        breadcrumb.style.display = folderPath.length ? 'flex' : 'none';
    }

    function jumpToPath(index) {
        const target = folderPath[index];
        folderPath = folderPath.slice(0, index + 1);
        currentFolderId = target.id;
        loadData();
    }

    function openFolder(folderId, folderName) {
        folderPath.push({ id: folderId, name: folderName });
        currentFolderId = folderId;
        loadData();
    }

    function goRoot() {
        folderPath = [];
        currentFolderId = null;
        loadData();
    }

    function updateButtonsVisibility() {
        const goRootWrapper = document.getElementById('goRootWrapper');
        if (goRootWrapper) goRootWrapper.style.display = currentFolderId !== null ? 'block' : 'none';
        const uploadBtn = document.getElementById('uploadFileBtn');
        const addLinkBtn = document.getElementById('addLinkBtn');
        if (uploadBtn && addLinkBtn) {
            const show = currentFolderId !== null;
            uploadBtn.style.display = show ? 'inline-flex' : 'none';
            addLinkBtn.style.display = show ? 'inline-flex' : 'none';
        }
    }

    // ----- CRUD operations (with toast feedback) -----
    function createFolder() {
        if (!guardWriteAction('create folder')) return;
        const nameEl = document.getElementById('folderName');
        const name = nameEl ? nameEl.value.trim() : '';
        if (!name) return window.showErrorToast('Please enter a folder name');
        fetch('/resource/folder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': cfg.csrfToken
            },
            body: JSON.stringify({
                category_slug: categorySlug,
                name: name,
                parent_id: currentFolderId || null
            })
        })
        .then(async res => {
            const data = await res.json().catch(() => ({ error: 'Failed to create folder' }));
            if (!res.ok) throw new Error(data.error || 'Create folder failed');
            window.showSuccessToast('Folder created successfully');
            closeModal('folderModal');
            if (nameEl) nameEl.value = '';
            loadData();
        })
        .catch(err => {
            window.showErrorToast(err.message);
            console.error(err);
        });
    }

    function addLink() {
        if (!guardWriteAction('add link')) return;
        const nameEl = document.getElementById('linkName');
        const urlEl = document.getElementById('linkURL');
        const name = nameEl ? nameEl.value.trim() : '';
        const url = urlEl ? urlEl.value.trim() : '';
        if (!name || !url) return window.showErrorToast('Fill both name and URL');
        fetch('/resource/link', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': cfg.csrfToken
            },
            body: JSON.stringify({
                folder_id: currentFolderId,
                name: name,
                url: url
            })
        })
        .then(async res => {
            const data = await res.json().catch(() => ({ error: 'Failed to add link' }));
            if (!res.ok) throw new Error(data.error || 'Add link failed');
            window.showSuccessToast('Link added successfully');
            if (nameEl) nameEl.value = '';
            if (urlEl) urlEl.value = '';
            closeModal('linkModal');
            loadData();
        })
        .catch(err => {
            window.showErrorToast(err.message);
            console.error(err);
        });
    }

    function openDeleteModal(type, id) {
        deleteTarget = { type, id };
        const msgEl = document.getElementById('deleteMessage');
        if (msgEl) msgEl.innerText = type === 'folder' ? 'Delete folder and ALL contents?' : 'Delete this item?';
        openModal('deleteModal');
    }

    function confirmDelete() {
        if (!guardWriteAction('delete')) return;
        if (!deleteTarget) return;
        const { type, id } = deleteTarget;
        const url = type === 'file' ? `/resource/file/${id}` : `/resource/folder/${id}`;
        fetch(url, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': cfg.csrfToken }
        })
        .then(async res => {
            const data = await res.json().catch(() => ({ error: 'Delete failed' }));
            if (!res.ok) throw new Error(data.error || 'Delete failed');
            window.showSuccessToast(type === 'folder' ? 'Folder deleted' : 'File deleted');
            closeModal('deleteModal');
            deleteTarget = null;
            loadData();
        })
        .catch(err => {
            window.showErrorToast(err.message);
            console.error(err);
        });
    }

    // ----- Rename (right‑click context menu) -----
    function submitRename() {
        if (!guardWriteAction('rename')) return;
        const nameEl = document.getElementById('renameInput');
        const newName = nameEl ? nameEl.value.trim() : '';
        if (!newName) return window.showErrorToast('Name cannot be empty');
        const url = renameTarget.type === 'file' ? `/resource/file/${renameTarget.id}` : `/resource/folder/${renameTarget.id}`;
        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': cfg.csrfToken
            },
            body: JSON.stringify({ name: newName })
        })
        .then(async res => {
            const data = await res.json().catch(() => ({ error: 'Rename failed' }));
            if (!res.ok) throw new Error(data.error || 'Rename failed');
            window.showSuccessToast('Renamed successfully');
            closeModal('renameModal');
            loadData();
        })
        .catch(err => {
            window.showErrorToast(err.message);
            console.error(err);
        });
    }

    // ----- Context menu (right‑click) -----
    let activeContextMenu = null;
    function showContextMenu(x, y, type, id, currentName) {
        if (activeContextMenu) activeContextMenu.remove();
        const menu = document.createElement('div');
        menu.className = 'context-menu';
        menu.style.left = x + 'px';
        menu.style.top = y + 'px';
        let html = '<ul>';
        html += `<li data-action="rename"><i class="bi bi-pencil-square"></i> Rename</li>`;
        if (isAdmin) {
            html += `<hr>`;
            html += `<li data-action="delete"><i class="bi bi-trash"></i> Delete</li>`;
        }
        html += '</ul>';
        menu.innerHTML = html;
        document.body.appendChild(menu);
        activeContextMenu = menu;
        // adjust position
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) menu.style.left = (window.innerWidth - rect.width - 10) + 'px';
        if (rect.bottom > window.innerHeight) menu.style.top = (window.innerHeight - rect.height - 10) + 'px';
        menu.querySelectorAll('li').forEach(li => {
            li.addEventListener('click', (e) => {
                const action = li.getAttribute('data-action');
                if (action === 'rename') {
                    renameTarget = { type, id };
                    const input = document.getElementById('renameInput');
                    if (input) input.value = currentName;
                    openModal('renameModal');
                } else if (action === 'delete') {
                    openDeleteModal(type, id);
                }
                closeContextMenu();
            });
        });
        setTimeout(() => {
            document.addEventListener('click', closeContextMenu);
            document.addEventListener('contextmenu', closeContextMenu);
        }, 10);
    }

    function closeContextMenu() {
        if (activeContextMenu) {
            activeContextMenu.remove();
            activeContextMenu = null;
        }
        document.removeEventListener('click', closeContextMenu);
        document.removeEventListener('contextmenu', closeContextMenu);
    }

    // ----- File upload with preview (works only if dropZone exists) -----
    let selectedFiles = [];
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInputReal');
    const browseBtn = document.getElementById('browseBtn');
    const previewList = document.getElementById('filePreviewList');
    const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
    const fileCountSpan = document.getElementById('fileCount');

    function updatePreview() {
        if (!previewList) return;
        previewList.innerHTML = '';
        if (selectedFiles.length === 0) {
            if (uploadSubmitBtn) uploadSubmitBtn.disabled = true;
            if (fileCountSpan) fileCountSpan.innerText = '0';
            return;
        }
        if (uploadSubmitBtn) uploadSubmitBtn.disabled = false;
        if (fileCountSpan) fileCountSpan.innerText = selectedFiles.length;
        selectedFiles.forEach((file, idx) => {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.innerHTML = `
                <div class="preview-filename" title="${escapeHtml(file.name)}"><i class="bi bi-file-earmark-text"></i> ${escapeHtml(file.name)} <small>(${(file.size/1024).toFixed(1)} KB)</small></div>
                <button type="button" class="action-icon delete" data-index="${idx}" style="background:none;"><i class="bi bi-trash"></i></button>
            `;
            previewList.appendChild(div);
        });
        document.querySelectorAll('#filePreviewList .action-icon.delete').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const idx = parseInt(btn.getAttribute('data-index'));
                selectedFiles.splice(idx, 1);
                const dt = new DataTransfer();
                selectedFiles.forEach(f => dt.items.add(f));
                if (fileInput) fileInput.files = dt.files;
                updatePreview();
            });
        });
    }

    function setSelectedFiles(files) {
        selectedFiles = Array.from(files);
        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        if (fileInput) fileInput.files = dt.files;
        updatePreview();
    }

    if (dropZone) {
        dropZone.addEventListener('click', () => { if (fileInput) fileInput.click(); });
        dropZone.addEventListener('dragover', e => {
            e.preventDefault();
            dropZone.style.background = 'var(--primary-soft)';
            dropZone.style.borderColor = 'var(--gold-hover)';
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.background = '#fffdf7';
            dropZone.style.borderColor = 'var(--primary)';
        });
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.style.background = '#fffdf7';
            if (e.dataTransfer.files.length) setSelectedFiles(e.dataTransfer.files);
        });
    }
    if (browseBtn) browseBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (fileInput) fileInput.click();
    });
    if (fileInput) fileInput.addEventListener('change', (e) => {
        if (e.target.files.length) setSelectedFiles(e.target.files);
    });

    // Add form submit handler for addLinkForm
    const addLinkForm = document.getElementById('addLinkForm');
    if (addLinkForm) {
        addLinkForm.addEventListener('submit', function(e) {
            e.preventDefault();
            addLink();
        });
    }

    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (cfg.isTechnicalInspector) {
                    window.showErrorToast('You are a Technical Inspector (read‑only). Cannot upload files.');
                    return;
                }
            if (selectedFiles.length === 0) return;
            if (!validateTotalSize(selectedFiles)) return;
            const formData = new FormData();
            formData.append('category_slug', categorySlug);
            formData.append('folder_id', currentFolderId);
            selectedFiles.forEach(f => formData.append('files[]', f));
            if (uploadSubmitBtn) {
                uploadSubmitBtn.disabled = true;
                uploadSubmitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Uploading...';
            }
            try {
                const resp = await fetch('/resource/upload', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': cfg.csrfToken },
                    body: formData
                });
                const data = await resp.json().catch(() => ({ error: 'Upload failed' }));
                if (resp.ok && data.success) {
                    window.showSuccessToast('File(s) uploaded successfully');
                    closeModal('fileModal');
                    loadData();
                } else {
                    throw new Error(data.error || 'Upload failed');
                }
            } catch (err) {
                window.showErrorToast(err.message);
                console.error(err);
            } finally {
                if (uploadSubmitBtn) {
                    uploadSubmitBtn.disabled = false;
                    uploadSubmitBtn.innerHTML = 'Upload (<span id="fileCount">0</span>)';
                }
                selectedFiles = [];
                updatePreview();
                if (fileInput) fileInput.value = '';
            }
        });
    }

    // ----- Simple file upload (non‑preview version, for drive blade) -----
    // We'll wrap the older uploadFile() (used via inline onclick) if no preview exists.
    window.uploadFile = function() {
        // If there's a preview system, use that modal's submit instead
        if (cfg.isTechnicalInspector) {
            window.showErrorToast('You are a Technical Inspector (read‑only). Cannot upload files.');
            return;
        }
        if (uploadForm) return;
        const input = document.getElementById('fileInputReal');
        const file = input ? input.files[0] : null;
        if (!file) return window.showErrorToast('Please select a file');
        if (file.size > MAX_TOTAL_SIZE_BYTES) {
            const fileMB = (file.size / (1024 * 1024)).toFixed(1);
            window.showErrorToast(`File size (${fileMB} MB) exceeds the ${MAX_TOTAL_SIZE_MB} MB limit.`);
            return;
        }
        const formData = new FormData();
        formData.append('category_slug', categorySlug);
        formData.append('folder_id', currentFolderId);
        formData.append('file', file);
        fetch('/resource/upload', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': cfg.csrfToken },
            body: formData
        })
        .then(async res => {
            const data = await res.json().catch(() => ({ error: 'Upload failed' }));
            if (!res.ok) throw new Error(data.error || 'Upload failed');
            window.showSuccessToast('File uploaded successfully');
            if (input) input.value = '';
            closeModal('fileModal');
            loadData();
        })
        .catch(err => {
            window.showErrorToast(err.message);
            console.error(err);
        });
    };

    // ----- Modal helpers -----
    function openModal(id) {
        const el = document.getElementById(id);
        if (el) el.classList.add('active');
    }
    function closeModal(id) {
        const el = document.getElementById(id);
        if (el) el.classList.remove('active');
    }

    // ----- Expose globally needed functions -----
    window.loadData = loadData;
    window.openFolder = openFolder;
    window.goRoot = goRoot;
    window.jumpToPath = jumpToPath;
    window.createFolder = createFolder;
    window.addLink = addLink;
    window.openDeleteModal = openDeleteModal;
    window.confirmDelete = confirmDelete;
    window.submitRename = submitRename;
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.uploadFile = window.uploadFile; // already defined

    // ----- Initial load -----
    loadData();
    
})();