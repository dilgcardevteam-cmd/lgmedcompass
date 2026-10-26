<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/plus-jakarta-sans.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Your existing styles – copy them from your working blade */
        /* Preview list container - scrollable after 4 items */
        #filePreviewList {
            max-height: calc(4 * 48px);     /* adjust based on item height (padding + line-height) */
            overflow-y: auto;
            border-radius: 8px;
            margin-top: 8px;
        }

        /* Optional: improve preview item spacing */
        .preview-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-soft);
            border-radius: 8px;
            padding: 8px 12px;
            margin-bottom: 6px;
            gap: 8px;
        }
        .preview-filename {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
            font-size: 0.8rem;
        }
        :root {
            --primary: #f59e0b;
            --primary-soft: #fffbeb;
            --gold-hover: #d97706;
            --bg: #fefce8;
            --card-bg: #ffffff;
            --text-main: #78350f;
            --text-muted: #7c5e3a;
            --border: #f3c11c;
            --radius: 12px;
            --danger: #ef4444;
            --danger-soft: #fee2e2;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            margin: 0;
            padding: 40px;
            color: var(--text-main);
            line-height: 1.5;
        }

        .audit-card {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.04), 0 8px 10px -6px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header-left {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .header-left h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .back-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: white;
            color: var(--text-main);
            font-size: 1.2rem;
            text-decoration: none;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: var(--primary-soft);
            color: var(--primary);
            border-color: var(--primary);
        }

        .action-group {
            display: flex;
            gap: 10px;
        }

        .btn-primary, .btn-gold {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ecc02c, #e8c424);
            color: #1f1f1f;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #f6cb0e, #e8cf10);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
        }

        .btn-gold {
            background: linear-gradient(135deg, #f3c920, #f5d130);
            color: #1f1f1f;
            box-shadow: 0 4px 18px rgba(250, 204, 21, 0.4);
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 22px rgba(245, 158, 11, 0.6);
        }

        #goRootWrapper .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 16px;
            transition: all 0.2s;
        }

        #goRootWrapper .btn-gold:hover {
            background: var(--primary-soft);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .breadcrumb {
            font-size: 0.875rem;
            margin-top: 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            background: var(--primary-soft);
            padding: 6px 14px;
            border-radius: 12px;
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 10px rgba(245,158,11,0.15);
        }

        .breadcrumb a, .breadcrumb span {
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        .breadcrumb span:hover {
            color: var(--primary);
            font-weight: 600;
            transform: translateY(-1px);
        }

        .breadcrumb i {
            font-size: 0.7rem;
            color: rgba(120,53,15,0.7);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .folder {
            position: relative;
            background: #fff;
            padding: 16px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .folder:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 12px 20px rgba(245, 158, 11, 0.25);
        }

        .folder i {
            font-size: 1.6rem;
            color: var(--primary);
        }

        .folder div {
            font-weight: 500;
            font-size: 0.95rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .delete-form {
            position: relative;
            z-index: 2;
            margin-left: auto;
        }

        .action-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            transition: 0.2s;
            margin: 0 2px;
            text-decoration: none;
        }

        .action-icon:hover {
            background: var(--primary);
            color: white;
        }

        .action-icon.delete {
            background: #fee2e2;
            color: #ef4444;
            width: 30px;
            height: 30px;
        }

        .action-icon.delete:hover {
            background: #ef4444;
            color: white;
        }

        .action-icon.delete .bi-trash {
            font-size: 0.9rem;
        }

        .table-wrapper {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--primary-soft);
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 14px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #fef3c7;
            font-size: 0.95rem;
        }

        tr:hover td {
            background-color: #fff7e5;
        }

        .action-cell {
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 20px;
            width: 420px;
            max-width: 90%;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        }

        .modal-header {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header i {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-header i:hover {
            color: var(--primary);
            transform: scale(1.15);
        }

        .modal input, .modal .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            margin-bottom: 16px;
            font-size: 0.95rem;
            box-sizing: border-box;
            outline: none;
        }

        .modal input:focus {
            border-color: var(--primary);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
        }

        #fileInputReal {
            display: none;
        }

        .division-badge-wrapper {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 2rem;
        }

        .division-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, rgba(255,250,230,0.8), rgba(255,245,200,0.6));
            backdrop-blur: 8px;
            border-left: 4px solid #f59e0b;
            color: #78350f;
            border-radius: 0 1rem 1rem 0;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 12px rgba(245,158,11,0.25);
            transition: all 0.3s ease;
            cursor: default;
        }

        .division-badge:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 20px rgba(245,158,11,0.35);
        }

        .division-badge i {
            color: #f59e0b;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .division-badge:hover i {
            transform: rotate(-10deg) scale(1.1);
        }

        .divider {
            height: 2px;
            flex-grow: 1;
            background: linear-gradient(to right, rgba(245,158,11,0.3), transparent);
            border-radius: 2px;
        }
    </style>

    <body>
        @include('layouts.navigation')

        <div class="audit-card">
            <div class="header-top">
                <div class="header-left">
                    <a href="{{ route('resources.index') }}" class="back-btn"><i class="bi bi-chevron-left"></i></a>
                    <h2>Resources & Downloads</h2>
                </div>
               <div class="action-group">
                <button class="btn-gold" onclick="openModal('folderModal')"><i class="bi bi-folder-plus"></i> New Folder</button>
                <button class="btn-primary" id="uploadFileBtn" onclick="openModal('fileModal')" style="display: none;"><i class="bi bi-cloud-arrow-up"></i> Upload File</button>
                <button class="btn-primary" id="addLinkBtn" onclick="openModal('linkModal')" style="display: none;"><i class="bi bi-link-45deg"></i> Add Link</button>
            </div>
            </div>

            <div class="division-badge-wrapper">
                <div class="division-badge"><i class="bi bi-person-badge"></i>{{ $category->name }}</div>
                <div class="divider"></div>
            </div>

            <div id="goRootWrapper" style="margin-bottom:16px; display:none;">
                <button class="btn-gold" onclick="goRoot()"><i class="bi bi-house-door-fill"></i> My Drive</button>
            </div>

            <div class="breadcrumb" id="breadcrumb"></div>
            <div id="folderContainer" class="grid"></div>
            <div id="tableWrapper" class="table-wrapper" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:35%">Name</th>
                            <th style="width:30%">Location</th>
                            <th style="width:20%">Type</th>
                            <th style="width:15%; text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="fileTable"></tbody>
                </table>
            </div>
        </div>

        <!-- Modals -->
        <div class="modal" id="folderModal">
            <div class="modal-content">
                <div class="modal-header">
                    Create Folder
                    <i class="bi bi-x-lg" onclick="closeModal('folderModal')"></i>
                </div>
                <input type="text" id="folderName" placeholder="Enter folder name" required>
                <div class="modal-footer">
                    <button class="btn-primary" onclick="createFolder()">Create</button>
                </div>
            </div>
        </div>

        <div class="modal" id="fileModal">
            <div class="modal-content">
                <div class="modal-header">
                    Upload File
                    <i class="bi bi-x-lg" onclick="closeModal('fileModal')"></i>
                </div>
                <div style="border:2px dashed var(--primary); padding:40px; border-radius:12px; text-align:center; margin-bottom:20px;">
                    <i class="bi bi-cloud-upload" style="font-size:2.5rem; color:var(--primary); display:block; margin-bottom:10px;"></i>
                    <input type="file" id="fileInputReal" style="display:none" required>
                    <button type="button" class="btn-primary" onclick="document.getElementById('fileInputReal').click()">
                        Choose File
                    </button>
                    <p style="font-size:0.8rem; color:var(--text-muted); margin-top:12px;">
                        Files will be added to the current folder
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary" onclick="uploadFile()">Upload</button>
                </div>
            </div>
        </div>

        <div class="modal" id="linkModal">
            <div class="modal-content">
                <div class="modal-header">
                    Add Link
                    <i class="bi bi-x-lg" onclick="closeModal('linkModal')"></i>
                </div>
                <input type="text" id="linkName" placeholder="Link Display Name" required>
                <input type="url" id="linkURL" placeholder="https://example.com" required>
                <div class="modal-footer">
                    <button class="btn-primary" onclick="addLink()">Save Link</button>
                </div>
            </div>
        </div>
        @php
            $isAdmin = auth()->user()->role === 'admin';
        @endphp
        <div class="modal" id="deleteModal">
            <div class="modal-content">
                <div class="modal-header">
                    Confirm Delete
                    <i class="bi bi-x-lg" onclick="closeModal('deleteModal')"></i>
                </div>
                <div class="delete-text" id="deleteMessage">Are you sure you want to delete this item? This action cannot be undone.</div>
                <div class="modal-footer">
                    <button class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                    <button class="btn-primary" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
        @include('resources.toast')

        <script>
            let isAdmin = {{ $isAdmin ? 'true' : 'false' }};
            let currentCategorySlug = "{{ $categorySlug }}";
            let currentFolderId = null;
            let folderPath = [];
            let deleteTarget = null;

            function loadData() {
                let url = `/resource/folders/${currentCategorySlug}`;
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

            function renderFolders(folders) {
                const container = document.getElementById('folderContainer');
                container.innerHTML = '';
                folders.forEach(folder => {
                    const div = document.createElement('div');
                    div.className = 'folder';
                    div.innerHTML = `
                        <div style="display:flex; align-items:center; gap:12px; flex:1; cursor:pointer;" onclick="openFolder(${folder.id}, '${escapeHtml(folder.name)}')">
                            <i class="bi bi-folder-fill"></i>
                            <div>${escapeHtml(folder.name)}</div>
                        </div>
                        ${isAdmin ? `<button class="action-icon delete" onclick="event.stopPropagation(); openDeleteModal('folder', ${folder.id})"><i class="bi bi-trash"></i></button>` : ''}
                    `;
                    container.appendChild(div);
                });
            }

            function renderFiles(files) {
                const tableBody = document.getElementById('fileTable');
                const tableWrapper = document.getElementById('tableWrapper');
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
                        ? `<button class="action-icon delete" onclick="openDeleteModal('file', ${file.id})"><i class="bi bi-trash"></i></button>`
                        : '';
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td style="font-weight:500;"><i class="bi ${icon}" style="margin-right:8px; color:var(--text-muted)"></i>${escapeHtml(file.name)}</td>
                        <td style="color:#7c5e3a; font-size:0.85rem">${currentFolderId ? 'Current Folder' : 'Root'}</td>
                        <td><span style="background:var(--primary-soft); padding:4px 10px; border-radius:6px; font-size:0.75rem; font-weight:700; color:var(--text-main);">${file.type}</span></td>
                        <td class="action-cell">
                            ${viewLink}
                            ${deleteButton}
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }

            function renderBreadcrumb() {
                const breadcrumb = document.getElementById('breadcrumb');
                if (folderPath.length === 0) {
                    breadcrumb.style.display = 'none';
                    return;
                }
                breadcrumb.style.display = 'flex';
                let html = `<span onclick="goRoot()">My Drive</span>`;
                folderPath.forEach((folder, idx) => {
                    html += `<i class="bi bi-chevron-right"></i> <span onclick="jumpToPath(${idx})">${escapeHtml(folder.name)}</span>`;
                });
                breadcrumb.innerHTML = html;
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
                goRootWrapper.style.display = currentFolderId !== null ? 'block' : 'none';

                const uploadBtn = document.getElementById('uploadFileBtn');
                const addLinkBtn = document.getElementById('addLinkBtn');
                if (uploadBtn && addLinkBtn) {
                    const show = currentFolderId !== null;
                    uploadBtn.style.display = show ? 'inline-flex' : 'none';
                    addLinkBtn.style.display = show ? 'inline-flex' : 'none';
                }
            }

           function createFolder() {
                const name = document.getElementById('folderName').value.trim();
                if (!name) {
                    window.showErrorToast('Please enter a folder name');
                    return;
                }
                fetch('/resource/folder', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        category_slug: currentCategorySlug,
                        name: name,
                        parent_id: currentFolderId
                    })
                })
                .then(async res => {
                    const result = await res.json().catch(() => ({ error: 'Invalid server response' }));
                    if (!res.ok) throw new Error(result.error || 'Failed to create folder');
                    window.showSuccessToast('Folder created successfully');
                    closeModal('folderModal');
                    document.getElementById('folderName').value = '';
                    loadData();
                })
                .catch(err => {
                    window.showErrorToast(err.message);
                    console.error(err);
                });
            }

            function uploadFile() {
                const fileInput = document.getElementById('fileInputReal');
                const file = fileInput.files[0];
                if (!file) {
                    window.showErrorToast('Please select a file');
                    return;
                }
                const MAX_SIZE_MB = 50;
                    const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;
                    if (file.size > MAX_SIZE_BYTES) {
                        const fileMB = (file.size / (1024 * 1024)).toFixed(1);
                        window.showErrorToast(`File size (${fileMB} MB) exceeds the ${MAX_SIZE_MB} MB limit.`);
                        return;
                    }
                const formData = new FormData();
                formData.append('category_slug', currentCategorySlug);
                formData.append('folder_id', currentFolderId);
                formData.append('file', file);
                fetch('/resource/upload', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(async res => {
                    const data = await res.json().catch(() => ({ error: 'Upload failed' }));
                    if (!res.ok) throw new Error(data.error || 'Upload failed');
                    window.showSuccessToast('File uploaded successfully');
                    fileInput.value = '';
                    closeModal('fileModal');
                    loadData();
                })
                .catch(err => {
                    window.showErrorToast(err.message);
                    console.error(err);
                });
            }

            function addLink() {
                const name = document.getElementById('linkName').value.trim();
                const url = document.getElementById('linkURL').value.trim();
                if (!name || !url) {
                    window.showErrorToast('Please fill both name and URL');
                    return;
                }
                fetch('/resource/link', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        folder_id: currentFolderId,
                        name: name,
                        url: url
                    })
                })
                .then(async res => {
                    const data = await res.json().catch(() => ({ error: 'Failed to add link' }));
                    if (!res.ok) throw new Error(data.error || 'Failed to add link');
                    window.showSuccessToast('Link added successfully');
                    document.getElementById('linkName').value = '';
                    document.getElementById('linkURL').value = '';
                    closeModal('linkModal');
                    loadData();
                })
                .catch(err => {
                    window.showErrorToast(err.message);
                    console.error(err);
                });
            }

            function confirmDelete() {
                if (!deleteTarget) return;
                const { type, id } = deleteTarget;
                const url = type === 'file' ? `/resource/file/${id}` : `/resource/folder/${id}`;
                fetch(url, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
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

            function openDeleteModal(type, id) {
                deleteTarget = { type, id };
                const messageEl = document.getElementById('deleteMessage');
                if (type === 'folder') {
                    messageEl.innerText = 'This will delete the folder and ALL its contents. This action cannot be undone.';
                } else {
                    messageEl.innerText = 'Are you sure you want to delete this item? This action cannot be undone.';
                }
                openModal('deleteModal');
            }
            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/[&<>]/g, function(m) {
                    if (m === '&') return '&amp;';
                    if (m === '<') return '&lt;';
                    if (m === '>') return '&gt;';
                    return m;
                });
            }

            function openModal(id) { document.getElementById(id).classList.add('active'); }
            function closeModal(id) { document.getElementById(id).classList.remove('active'); }

            loadData();
        </script>
    </body>
</x-app-layout>