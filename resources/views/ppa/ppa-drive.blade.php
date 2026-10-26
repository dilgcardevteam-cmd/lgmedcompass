<x-app-layout>
    <style>
        /* Your existing CSS – unchanged */
        :root {
            --primary: #e6b907;
            --primary-soft: #fffbeb;
            --gold-hover: #d97706;
            --bg: #fefce8;
            --card-bg: #ffffff;
            --text-main: #78350f;
            --text-muted: #7c5e3a;
            --border: #ebb912;
            --radius: 12px;
            --danger: #ef4444;
            --danger-soft: #fee2e2;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            line-height: 1.5;
        }

        .audit-card {
            max-width: 1400px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.04), 0 8px 10px -6px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
        }

        @media (min-width: 768px) {
            .audit-card {
                padding: 40px;
            }
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-left {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .header-left h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        @media (min-width: 768px) {
            .header-left h2 {
                font-size: 1.75rem;
            }
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
            flex-wrap: wrap;
        }

        .btn-primary, .btn-gold {
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (min-width: 768px) {
            .btn-primary, .btn-gold {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #fcd34d, #e7c85c);
            color: #1f1f1f;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ffd727, #ffe941);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
        }

        .btn-gold {
            background: linear-gradient(135deg, #f7d346, #f0d663);
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
            font-size: 0.85rem;
            padding: 6px 14px;
        }

        .breadcrumb {
            font-size: 0.75rem;
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            background: var(--primary-soft);
            padding: 6px 12px;
            border-radius: 12px;
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 10px rgba(245,158,11,0.15);
            flex-wrap: wrap;
        }

        .breadcrumb span {
            cursor: pointer;
            transition: all 0.2s;
        }

        .breadcrumb span:hover {
            color: var(--primary);
            font-weight: 600;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 32px;
        }

        @media (min-width: 640px) {
            .grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 16px;
            }
        }

        .folder {
            background: #fff;
            padding: 12px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .folder:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
            box-shadow: 0 8px 16px rgba(245, 158, 11, 0.2);
        }

        .folder i {
            font-size: 1.4rem;
            color: var(--primary);
            flex-shrink: 0;
        }

        .folder .folder-name {
            font-weight: 500;
            font-size: 0.85rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
        }

        .action-icon {
            width: 32px;
            height: 32px;
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

        .table-wrapper {
            background: white;
            border-radius: var(--radius);
            overflow-x: auto;
            border: 1px solid var(--border);
            margin-top: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 0.8rem;
        }

        @media (min-width: 768px) {
            th, td {
                padding: 14px 16px;
                font-size: 0.9rem;
            }
        }

        th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            background: var(--primary-soft);
        }

        td {
            border-bottom: 1px solid #fef3c7;
        }

        tr:hover td {
            background-color: #fff7e5;
        }

        .file-name-cell {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
        }

        .action-cell {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
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
            padding: 24px;
            border-radius: 20px;
            width: 90%;
            max-width: 460px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        }

        .modal-header {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal input, .modal select {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            margin-bottom: 16px;
            font-size: 0.9rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        .context-menu {
            position: fixed;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            z-index: 2100;
            min-width: 140px;
            overflow: hidden;
        }
        .context-menu ul {
            margin: 0;
            padding: 6px 0;
            list-style: none;
        }
        .context-menu li {
            padding: 8px 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
        }
        .context-menu li:hover {
            background: var(--primary-soft);
        }
        .context-menu hr {
            margin: 4px 0;
            border-color: var(--border);
        }

        .division-badge-wrapper {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 1.5rem;
        }
        .division-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.4rem 0.8rem;
            background: linear-gradient(135deg, rgba(255,250,230,0.8), rgba(255,245,200,0.6));
            border-left: 4px solid #e59408;
            border-radius: 0 1rem 1rem 0;
            font-size: 0.75rem;
            font-weight: 800;
        }
        .divider {
            height: 2px;
            flex-grow: 1;
            background: linear-gradient(to right, rgba(245,158,11,0.3), transparent);
        }

        .upload-box {
            border: 2px dashed var(--primary);
            padding: 30px 20px;
            border-radius: 14px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .preview-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-soft);
            border-radius: 8px;
            padding: 6px 10px;
            margin-bottom: 8px;
            gap: 8px;
        }
        /* Preview list – scrollable after 4 items */
        #filePreviewList {
            max-height: calc(4 * 48px);     /* fits 4 items, adjust if your item height differs */
            overflow-y: auto;
            border-radius: 8px;
            margin-top: 8px;
        }
        .preview-filename {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
            font-size: 0.8rem;
        }
        .spinner-small {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.6s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>

    @php
        $isAdmin = auth()->check() && auth()->user()->role === 'Admin';
        $currentFolder = $currentFolder ?? null;
        $folders = $folders ?? collect();
        $files = $files ?? collect();
        $breadcrumbs = $breadcrumbs ?? [];
        $sectionDisplay = $sectionDisplay ?? (object)['code' => $sectionCode ?? '', 'name' => ucfirst($sectionCode ?? '')];
    @endphp

    <div class="audit-card">
        <div class="header-top">
            <div class="header-left">
                <a href="{{ route('ppa.index') }}" class="back-btn"><i class="bi bi-chevron-left"></i></a>
                <h2>Programs, Projects & Activities</h2>
            </div>
            <div class="action-group">
                <button class="btn-gold" onclick="openModal('folderModal')"><i class="bi bi-folder-plus"></i> New Folder</button>
                <button class="btn-primary" id="uploadFileBtn" onclick="openModal('fileModal')" style="display: {{ $currentFolder ? 'inline-flex' : 'none' }};"><i class="bi bi-cloud-arrow-up"></i> Upload File</button>
                <button class="btn-primary" id="addLinkBtn" onclick="openModal('linkModal')" style="display: {{ $currentFolder ? 'inline-flex' : 'none' }};"><i class="bi bi-link-45deg"></i> Add Link</button>
            </div>
        </div>

        <div class="division-badge-wrapper">
            <div class="division-badge"><i class="bi bi-tag"></i>{{ $sectionDisplay->name }}</div>
            <div class="divider"></div>
        </div>

        <div id="goRootWrapper" style="margin-bottom:16px; display: {{ $currentFolder ? 'block' : 'none' }};">
            <a href="{{ route('ppa.section', $sectionCode) }}" class="btn-gold"><i class="bi bi-house-door-fill"></i> My Drive</a>
        </div>

        <div class="breadcrumb" id="breadcrumb">
            <span onclick="goRoot()">My Drive</span>
            @foreach($breadcrumbs as $crumb)
                <i class="bi bi-chevron-right"></i>
                <span onclick="jumpToPath({{ $loop->index }})">{{ $crumb['name'] }}</span>
            @endforeach
        </div>

        <div id="folderContainer" class="grid"></div>

        <div id="tableWrapper" class="table-wrapper" style="display: {{ $currentFolder ? 'block' : 'none' }};">
            <table>
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Uploaded By</th>
                        <th>Date Modified</th>
                        <th>File Size</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="fileTable"></tbody>
            </table>
        </div>
    </div>

    <!-- MODALS (unchanged) -->
    <div class="modal" id="folderModal"><div class="modal-content"><div class="modal-header">Create Folder <i class="bi bi-x-lg" onclick="closeModal('folderModal')"></i></div><form id="createFolderForm">@csrf<input type="hidden" name="section" value="{{ $sectionCode }}"><input type="hidden" name="parent_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><input type="text" id="folderName" name="name" placeholder="Enter folder name" required><div class="modal-footer"><button type="button" class="btn-primary" onclick="createFolder()">Create</button></div></form></div></div>

    <div class="modal" id="fileModal"><div class="modal-content"><div class="modal-header">Upload Files <i class="bi bi-x-lg" onclick="closeModal('fileModal')"></i></div><form id="uploadForm" enctype="multipart/form-data">@csrf<input type="hidden" name="section" value="{{ $sectionCode }}"><input type="hidden" name="parent_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><div id="dropZone" class="upload-box"><i class="bi bi-cloud-upload upload-icon"></i><p class="upload-title">Drag & drop files here</p><p class="upload-sub">or click to browse</p><button type="button" class="btn-primary upload-btn" id="browseBtn">Choose Files</button><input type="file" name="files[]" id="fileInputReal" multiple style="display: none;"></div><div id="filePreviewList"></div><div class="modal-footer"><button type="submit" class="btn-primary" id="uploadSubmitBtn" disabled>Upload (<span id="fileCountSpan">0</span>)</button></div></form></div></div>

    <div class="modal" id="linkModal"><div class="modal-content"><div class="modal-header">Add Link <i class="bi bi-x-lg" onclick="closeModal('linkModal')"></i></div><form id="addLinkForm">@csrf<input type="hidden" name="section" value="{{ $sectionCode }}"><input type="hidden" name="parent_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><input type="text" id="linkName" name="name" placeholder="Link Display Name" required><input type="url" id="linkURL" name="url" placeholder="https://example.com" required><div class="modal-footer"><button type="submit" class="btn-primary">Save Link</button></div></form></div></div>

    <div class="modal" id="deleteModal"><div class="modal-content"><div class="modal-header">Confirm Delete <i class="bi bi-x-lg" onclick="closeModal('deleteModal')"></i></div><div class="modal-body"><p id="deleteMessage">Are you sure you want to delete this item?</p><p style="color: #ef4444; font-size: 0.85rem;">This action cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn-gold" onclick="closeModal('deleteModal')">Cancel</button><button type="button" class="btn-primary" onclick="confirmDelete()">Delete</button></div></div></div>

    <div class="modal" id="renameModal"><div class="modal-content"><div class="modal-header">Rename Item <i class="bi bi-x-lg" onclick="closeModal('renameModal')"></i></div><div class="modal-body"><input type="text" id="renameInput" class="form-control" placeholder="New name" autocomplete="off"></div><div class="modal-footer"><button type="button" class="btn-gold" onclick="closeModal('renameModal')">Cancel</button><button type="button" class="btn-primary" onclick="submitRename()">Save</button></div></div></div>

    <div class="modal" id="moveModal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">Move Item <i class="bi bi-x-lg" onclick="closeModal('moveModal')"></i></div>
            <div class="modal-body">
                <p id="moveItemName" style="margin-bottom: 12px; font-weight: 500;"></p>
                <label style="font-weight:600; margin-bottom:4px; display:block;">Destination Division</label>
                <select id="moveDivisionSelect" class="form-control" style="width:100%; margin-bottom:16px;">
                    <option value="">-- Select Section/ Unit --</option>
                    <option value="1">LG-RPCS</option>
                    <option value="2">LG-PMRAS</option>
                    <option value="3">LG-POPSCM</option>
                    <option value="4">SSU</option>
                    <option value="5">DSU</option>
                </select>

                <label style="font-weight:600; margin-bottom:4px; display:block;">Destination Folder (optional)</label>
                <select id="moveDestinationSelect" class="form-control" style="width:100%;">
                    <option value="">-- Root (My Drive) --</option>
                </select>
                <div id="moveLoadingSpinner" style="display:none; text-align:center; margin-top:16px;">
                    <span class="spinner-small"></span> Loading folders...
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-gold" onclick="closeModal('moveModal')">Cancel</button>
                <button type="button" class="btn-primary" onclick="submitMove()">Move</button>
            </div>
        </div>
    </div>
@include('resources.toast')
    <script>
        let isAdmin = @json($isAdmin);
        let isTechnicalInspector = @json(auth()->user()?->role === 'Technical Inspector');
        function showDriveError(message) {
            if (typeof window.showErrorToast === 'function') {
                window.showErrorToast(message);
                return;
            }

            window.alert(message);
        }
        function guardWriteAction(actionName) {
            if (isTechnicalInspector) {
                showDriveError(`You are a Technical Inspector (read-only). Cannot ${actionName}.`);
                return false;
            }
            return true;
        }
        let currentSection = "{{ $sectionCode }}";
        let currentFolderId = {{ $currentFolder ? $currentFolder->id : 'null' }};
        let folderPath = @json($breadcrumbs);
        let deleteTarget = null;
        let renameTarget = { type: null, id: null };
        let moveTarget = { type: null, id: null, name: '' };

        // Map division IDs to section codes (for redirect after move)
        const divisionToSectionMap = {
            1: 'lgrpcs',
            2: 'lgpmras',
            3: 'lgpopscm',
            4: 'ssu',
            5: 'dsu'
        };

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        function loadData() {
            let url = `/ppa/folders/${currentSection}`;
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
            } catch(e) { return dateStr; }
        }

        function renderFiles(files) {
            const tableBody = document.getElementById('fileTable');
            const tableWrapper = document.getElementById('tableWrapper');
            if (!tableBody) return;
            tableBody.innerHTML = '';
            if (files.length === 0) {
                tableWrapper.style.display = 'none';
                return;
            }
            tableWrapper.style.display = 'block';
            files.forEach(file => {
                const icon = file.type === 'LINK' ? 'bi-link-45deg' : 'bi-file-earmark-text';
                const viewLink = file.type === 'file'
                    ? `<a href="/ppa/view/${file.id}" target="_blank" class="action-icon"><i class="bi bi-eye"></i></a>`
                    : `<a href="${file.url}" target="_blank" class="action-icon"><i class="bi bi-arrow-up-right"></i></a>`;
                const deleteButton = isAdmin ? `<button class="action-icon delete" onclick="openDeleteModal('file', ${file.id})"><i class="bi bi-trash"></i></button>` : '';
                const uploadedByName = (file.user && file.user.name) ? file.user.name : (file.uploaded_by_name || '—');
                const dateModified = file.updated_at_formatted || file.updated_at || null;
                const fileSize = (file.type === 'file') ? (file.size_in_kb ?? file.size ?? null) : null;
                
                const row = document.createElement('tr');
                row.setAttribute('data-type', 'file');
                row.setAttribute('data-id', file.id);
                row.setAttribute('data-name', file.name);
                row.innerHTML = `
                    <td><span class="file-name-cell" title="${escapeHtml(file.name)}"><i class="bi ${icon}" style="margin-right:8px;"></i>${escapeHtml(file.name)}</span></td>
                    <td>${escapeHtml(uploadedByName)}</td>
                    <td>${formatDate(dateModified)}</td>
                    <td>${file.type === 'file' ? formatFileSize(fileSize) : '—'}</td>
                    <td><span style="background:var(--primary-soft); padding:4px 10px; border-radius:6px; font-size:0.7rem; font-weight:700;">${file.type.toUpperCase()}</span></td>
                    <td class="action-cell">${viewLink}${deleteButton}</td>
                `;
                row.addEventListener('contextmenu', (e) => {
                    e.preventDefault();
                    showContextMenu(e.clientX, e.clientY, 'file', file.id, file.name);
                });
                tableBody.appendChild(row);
            });
        }

        let activeContextMenu = null;

       function showContextMenu(x, y, type, id, currentName) {
    if (activeContextMenu) activeContextMenu.remove();
    const menu = document.createElement('div');
    menu.className = 'context-menu';
    menu.style.left = x + 'px';
    menu.style.top = y + 'px';
    let menuHtml = '<ul>';
    
    // Always show Rename and Move for every authenticated user
    menuHtml += `<li data-action="rename"><i class="bi bi-pencil-square"></i> Rename</li>`;
    menuHtml += `<li data-action="move"><i class="bi bi-arrow-right-circle"></i> Move</li>`;
    
    // Only admins see the Delete option
    if (isAdmin) {
        menuHtml += `<li data-action="delete"><i class="bi bi-trash"></i> Delete</li>`;
    }
    
    menuHtml += '</ul>';
    menu.innerHTML = menuHtml;
    document.body.appendChild(menu);
    activeContextMenu = menu;
    
    const rect = menu.getBoundingClientRect();
    if (rect.right > window.innerWidth) menu.style.left = (window.innerWidth - rect.width - 10) + 'px';
    if (rect.bottom > window.innerHeight) menu.style.top = (window.innerHeight - rect.height - 10) + 'px';
    
    menu.querySelectorAll('li[data-action]').forEach(li => {
        li.addEventListener('click', (e) => {
            const action = li.getAttribute('data-action');
            if (action === 'rename') {
                renameTarget = { type, id };
                document.getElementById('renameInput').value = currentName;
                openModal('renameModal');
            } else if (action === 'delete') {
                openDeleteModal(type, id);
            } else if (action === 'move') {
                openMoveModal(type, id, currentName);
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

        function submitRename() {
            if (!guardWriteAction('rename')) return;
            const newName = document.getElementById('renameInput').value.trim();
            if (!newName) return showDriveError('Name cannot be empty');
            const url = renameTarget.type === 'file' ? `/ppa/file/${renameTarget.id}` : `/ppa/folder/${renameTarget.id}`;
            fetch(url, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ name: newName })
            }).then(res => res.json()).then(data => {
                if (data.success) { closeModal('renameModal'); loadData(); }
                else console.error('Rename failed:', data.error || 'Rename failed');
            }).catch(err => console.error('Error renaming item:', err));
        }

        // FIXED: Better error handling and folder loading
        async function openMoveModal(type, id, name) {
            moveTarget = { type, id, name };
            document.getElementById('moveItemName').innerText = `Move "${name}" to:`;
            const divisionSelect = document.getElementById('moveDivisionSelect');
            const folderSelect = document.getElementById('moveDestinationSelect');
            
            divisionSelect.value = '';
            folderSelect.innerHTML = '<option value="">-- Select Destination Folder --</option>';
            
            openModal('moveModal');
            
            divisionSelect.onchange = async function() {
                const divId = this.value;
                if (!divId) {
                    folderSelect.innerHTML = '<option value="">-- Select Destination Folder --</option>';
                    return;
                }
                const spinner = document.getElementById('moveLoadingSpinner');
                spinner.style.display = 'block';
                folderSelect.disabled = true;
                folderSelect.innerHTML = '<option value="">-- Loading folders --</option>';
                
                try {
                    const resp = await fetch(`/ppa/folders-list/${divId}`);
                    if (!resp.ok) {
                        throw new Error(`HTTP ${resp.status}: ${resp.statusText}`);
                    }
                    const data = await resp.json();
                    if (!data.folders || !Array.isArray(data.folders)) {
                        throw new Error('Invalid response format');
                    }
                    folderSelect.innerHTML = '<option value="">-- Root (My Drive) --</option>';
                    data.folders.forEach(folder => {
                        if (type === 'folder' && folder.id == id) return;
                        const option = document.createElement('option');
                        option.value = folder.id;
                        option.textContent = folder.name;
                        folderSelect.appendChild(option);
                    });
                } catch (err) {
                    console.error('Move folder load error:', err);
                    folderSelect.innerHTML = '<option value="">-- Error loading folders. Check backend route. --</option>';
                } finally {
                    spinner.style.display = 'none';
                    folderSelect.disabled = false;
                }
            };
        }

        // FIXED: Redirect using division→section mapping
       function submitMove() {
    if (!guardWriteAction('move items')) return;
    const newDivisionId = document.getElementById('moveDivisionSelect').value;
    const destinationId = document.getElementById('moveDestinationSelect').value;

    if (!newDivisionId) {
        showDriveError('Please select a destination division.');
        return;
    }

    const payload = {
        type: moveTarget.type,
        division_id: parseInt(newDivisionId),
        new_parent_id: destinationId === '' ? null : parseInt(destinationId)
    };

    const url = `/ppa/move/${moveTarget.type}/${moveTarget.id}`;
    
    fetch(url, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(payload)
    })
    .then(async response => {
        // First, try to parse the response as JSON
        let data;
        try {
            data = await response.json();
        } catch (e) {
            // If response is not JSON, read as text
            const text = await response.text();
            throw new Error(`Server returned non-JSON: ${text.substring(0, 200)}`);
        }
        
        if (!response.ok) {
            throw new Error(data.error || `HTTP ${response.status}: ${response.statusText}`);
        }
        
        return data;
    })
    .then(data => {
        if (data.success) {
            closeModal('moveModal');
            const targetSection = divisionToSectionMap[newDivisionId];
            if (targetSection && targetSection !== currentSection) {
                window.location.href = `/ppa/${targetSection}`;
            } else {
                loadData();
            }
        } else {
            // Silently handle error - no alert for Technical Inspector restrictions
            console.error('Move failed:', data.error || 'Unknown error');
        }
    })
    .catch(err => {
        console.error('Move error:', err);
        showDriveError(`Move failed: ${err.message}`);
    });
}

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
            folderPath = folderPath.slice(0, index+1); 
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
            const uploadBtn = document.getElementById('uploadFileBtn'), addLinkBtn = document.getElementById('addLinkBtn');
            if (uploadBtn && addLinkBtn) { 
                const show = currentFolderId !== null; 
                uploadBtn.style.display = show ? 'inline-flex' : 'none'; 
                addLinkBtn.style.display = show ? 'inline-flex' : 'none'; 
            }
        }
        function createFolder() {
            if (!guardWriteAction('create folder')) return;
            const name = document.getElementById('folderName').value.trim();
            if (!name) return showDriveError('Enter folder name');
            fetch('/ppa/folder', {
                method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ section: currentSection, name: name, parent_id: currentFolderId || null })
            }).then(async res => { if (!res.ok) throw new Error(await res.text()); return res.json(); })
            .then(() => { closeModal('folderModal'); document.getElementById('folderName').value = ''; loadData(); })
            .catch(err => console.error('Failed to create folder:', err.message));
        }
        function addLink() {
            if (!guardWriteAction('add link')) return;
            const name = document.getElementById('linkName').value.trim(), url = document.getElementById('linkURL').value.trim();
            if (!name || !url) return showDriveError('Fill both fields');
            fetch('/ppa/link', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ section: currentSection, parent_id: currentFolderId, name: name, url: url }) })
            .then(() => { document.getElementById('linkName').value = ''; document.getElementById('linkURL').value = ''; closeModal('linkModal'); loadData(); })
            .catch(err => console.error(err));
        }
        function openDeleteModal(type, id) {
            deleteTarget = { type, id };
            document.getElementById('deleteMessage').innerText = type === 'folder' ? 'Delete folder and ALL contents?' : 'Delete this item?';
            openModal('deleteModal');
        }
        async function confirmDelete() {
            if (!guardWriteAction('delete item')) return;
            if (!deleteTarget) return;
            const { type, id } = deleteTarget;
            const url = type === 'file' ? `/ppa/file/${id}` : `/ppa/folder/${id}`;
            try {
                const response = await fetch(url, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                const result = await response.json();
                if (!response.ok || !result.success) {
                    throw new Error(result.error || 'Delete failed');
                }

                closeModal('deleteModal');
                deleteTarget = null;
                loadData();
                if (typeof window.showSuccessToast === 'function') {
                    window.showSuccessToast(type === 'folder' ? 'Folder deleted successfully' : 'Item deleted successfully');
                }
            } catch (error) {
                console.error('PPA delete failed:', error);
                showDriveError(error.message || 'Delete failed');
            }
        }

        // ----- File size limit (50 MB total) -----
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
                const msg = `Total file size (${totalMB} MB) exceeds the ${MAX_TOTAL_SIZE_MB} MB limit. Please select fewer or smaller files.`;
                showDriveError(msg);
                return false;
            }
            return true;
        }
        // Upload logic (unchanged)
        const dropZone = document.getElementById('dropZone'), fileInput = document.getElementById('fileInputReal'), browseBtn = document.getElementById('browseBtn'), previewList = document.getElementById('filePreviewList'), uploadSubmitBtn = document.getElementById('uploadSubmitBtn'), fileCountSpan = document.getElementById('fileCountSpan');
        let selectedFiles = [];
        function truncateFileName(name, maxLen=38) { return name.length <= maxLen ? name : name.substring(0, maxLen-3)+'...'; }
        function updatePreview() {
            if(previewList) previewList.innerHTML = '';
            if(selectedFiles.length===0) { if(uploadSubmitBtn) uploadSubmitBtn.disabled = true; if(fileCountSpan) fileCountSpan.innerText='0'; return; }
            if(uploadSubmitBtn) uploadSubmitBtn.disabled = false;
            if(fileCountSpan) fileCountSpan.innerText = selectedFiles.length;
            selectedFiles.forEach((file,idx)=>{
                const div = document.createElement('div'); div.className='preview-item';
                div.innerHTML = `<div class="preview-filename" title="${escapeHtml(file.name)}"><i class="bi bi-file-earmark-text"></i> ${escapeHtml(truncateFileName(file.name,42))} <small>(${(file.size/1024).toFixed(1)} KB)</small></div><button type="button" class="action-icon delete" data-index="${idx}" style="background:none;"><i class="bi bi-trash"></i></button>`;
                if(previewList) previewList.appendChild(div);
            });
            document.querySelectorAll('#filePreviewList .action-icon.delete').forEach(btn=>{
                btn.addEventListener('click',(e)=>{
                    const idx = parseInt(btn.getAttribute('data-index'));
                    selectedFiles.splice(idx,1);
                    const dt = new DataTransfer(); selectedFiles.forEach(f=>dt.items.add(f));
                    if(fileInput) fileInput.files = dt.files;
                    updatePreview();
                });
            });
            const container = document.getElementById('filePreviewList');
            if (container && container.children.length > 0) {
                const firstItem = container.children[0];
                const itemHeight = firstItem.offsetHeight;
                container.style.maxHeight = (itemHeight * 4) + 'px';
            }
        }
        function setSelectedFiles(files) { selectedFiles = Array.from(files); const dt = new DataTransfer(); selectedFiles.forEach(f=>dt.items.add(f)); if(fileInput) fileInput.files = dt.files; updatePreview(); }
        function triggerFileInput() { if(fileInput) fileInput.click(); }
        if(dropZone) {
            dropZone.addEventListener('click',triggerFileInput);
            dropZone.addEventListener('dragover',e=>{e.preventDefault(); dropZone.style.background='var(--primary-soft)'; dropZone.style.borderColor='var(--gold-hover)';});
            dropZone.addEventListener('dragleave',()=>{dropZone.style.background='#fffdf7'; dropZone.style.borderColor='var(--primary)';});
            dropZone.addEventListener('drop',e=>{e.preventDefault(); dropZone.style.background='#fffdf7'; if(e.dataTransfer.files.length) setSelectedFiles(e.dataTransfer.files);});
        }
        if(browseBtn) browseBtn.addEventListener('click',e=>{e.stopPropagation(); triggerFileInput();});
        if(fileInput) fileInput.addEventListener('change',e=>{if(e.target.files.length) setSelectedFiles(e.target.files);});
        const uploadForm = document.getElementById('uploadForm');
        if(uploadForm) {
            uploadForm.addEventListener('submit', async function(e){
                e.preventDefault();
                 if (isTechnicalInspector) {
                    showDriveError('You are a Technical Inspector (read-only). Cannot upload files.');
                    return;
                }
                if(selectedFiles.length===0) return;
                if (!validateTotalSize(selectedFiles)) return;

                const formData = new FormData();
                formData.append('section', currentSection);
                formData.append('parent_id', currentFolderId || '');
                selectedFiles.forEach(f => formData.append('files[]', f));
                if(uploadSubmitBtn) { uploadSubmitBtn.disabled=true; uploadSubmitBtn.innerHTML='<i class="bi bi-hourglass-split"></i> Uploading...'; }
                try {
                    const resp = await fetch('/ppa/upload',{
                        method:'POST',
                        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
                        body:formData
                    });
                    const data = await resp.json();
                    if(data.success) { 
                        closeModal('fileModal'); 
                        loadData(); 
                        if (typeof window.showSuccessToast === 'function') {
                            window.showSuccessToast('Files uploaded successfully');
                        }
                    } else { 
                        console.error('Upload failed:', data.error || 'Upload failed');
                        showDriveError(data.error || 'Upload failed');
                    }
                } catch(err) { console.error('Upload error:', err); } finally {
                    if(uploadSubmitBtn) { uploadSubmitBtn.disabled=false; uploadSubmitBtn.innerHTML='Upload (<span id="fileCountSpan">0</span>)'; }
                    selectedFiles=[]; updatePreview(); if(fileInput) fileInput.value='';
                }
            });
        }

        function openModal(id) { document.getElementById(id)?.classList.add('active'); }
        function closeModal(id) { document.getElementById(id)?.classList.remove('active'); }
        document.getElementById('addLinkForm')?.addEventListener('submit',(e)=>{e.preventDefault(); addLink();});
        window.openModal=openModal; window.closeModal=closeModal; window.createFolder=createFolder; window.openDeleteModal=openDeleteModal; window.confirmDelete=confirmDelete; window.openFolder=openFolder; window.goRoot=goRoot; window.jumpToPath=jumpToPath; window.submitRename=submitRename; window.openMoveModal=openMoveModal; window.submitMove=submitMove;
        
        loadData();
    </script>
</x-app-layout>
