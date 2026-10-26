<x-app-layout>
    <style>
        :root {
            --primary: #f59e0b;
            --primary-soft: #fffbeb;
            --gold-hover: #d97706;
            --bg: #fefce8;
            --card-bg: #ffffff;
            --text-main: #78350f;
            --text-muted: #7c5e3a;
            --border: #fcd34d;
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

        /* Modal */
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

        .modal input {
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
            border-left: 4px solid #f59e0b;
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
        .preview-filename {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
            font-size: 0.8rem;
        }
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
    </style>

    @php
    $isAdmin = auth()->check() && auth()->user()->role === 'Admin';
    $categorySlug = 'lgrpcs';
    $parent_id = null;
    $currentFolder = null;
    $folders = collect();
    $files = collect();
    $breadcrumbs = [];
    $category = (object) ['name' => 'LGRPCS'];
    $section = 'lgrpcs';
    @endphp
    @php
    $currentFolder = $currentFolder ?? null;
    $folders = $folders ?? collect();
    $files = $files ?? collect();
    $breadcrumbs = $breadcrumbs ?? [];
    $isAdmin = $isAdmin ?? false;
    $category = $category ?? (object)['name' => 'LGRPCS'];
    $categorySlug = $categorySlug ?? 'lgrpcs';
    @endphp

    <div class="audit-card">
        <div class="header-top">
            <div class="header-left">
                <a href="{{ route('resources.index') }}" class="back-btn"><i class="bi bi-chevron-left"></i></a>
                <h2>LGRPCS Resources</h2>
            </div>
            <div class="action-group">
                <button class="btn-gold" onclick="openModal('folderModal')"><i class="bi bi-folder-plus"></i> New Folder</button>
                <button class="btn-primary" id="uploadFileBtn" onclick="openModal('fileModal')" style="display: {{ $currentFolder ? 'inline-flex' : 'none' }};"><i class="bi bi-cloud-arrow-up"></i> Upload File</button>
                <button class="btn-primary" id="addLinkBtn" onclick="openModal('linkModal')" style="display: {{ $currentFolder ? 'inline-flex' : 'none' }};"><i class="bi bi-link-45deg"></i> Add Link</button>
            </div>
        </div>

        <div class="division-badge-wrapper">
            <div class="division-badge"><i class="bi bi-tag"></i>{{ $category->name }}</div>
            <div class="divider"></div>
        </div>

        <div id="goRootWrapper" style="margin-bottom:16px; display: {{ $currentFolder ? 'block' : 'none' }};">
            <a href="{{ route('resources.category', $categorySlug) }}" class="btn-gold"><i class="bi bi-house-door-fill"></i> My Drive</a>
        </div>

        <div class="breadcrumb" id="breadcrumb">
            <span onclick="goRoot()">My Drive</span>
            @foreach($breadcrumbs as $crumb)
                <i class="bi bi-chevron-right"></i>
                <span onclick="jumpToPath({{ $loop->index }})">{{ $crumb['name'] }}</span>
            @endforeach
        </div>

        <div id="folderContainer" class="grid"></div>

        <!-- Table with 6 columns -->
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

    <!-- MODALS -->
    <div class="modal" id="folderModal"><div class="modal-content"><div class="modal-header">Create Folder <i class="bi bi-x-lg" onclick="closeModal('folderModal')"></i></div><form id="createFolderForm">@csrf<input type="hidden" name="category_slug" value="{{ $categorySlug }}"><input type="hidden" name="parent_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><input type="text" id="folderName" name="name" placeholder="Enter folder name" required><div class="modal-footer"><button type="button" class="btn-primary" onclick="createFolder()">Create</button></div></form></div></div>
    <div class="modal" id="fileModal"><div class="modal-content"><div class="modal-header">Upload Files <i class="bi bi-x-lg" onclick="closeModal('fileModal')"></i></div><form id="uploadForm" enctype="multipart/form-data">@csrf<input type="hidden" name="category_slug" value="{{ $categorySlug }}"><input type="hidden" name="folder_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><div id="dropZone" class="upload-box"><i class="bi bi-cloud-upload upload-icon"></i><p class="upload-title">Drag & drop files here</p><p class="upload-sub">or click to browse</p><button type="button" class="btn-primary upload-btn" id="browseBtn">Choose Files</button><input type="file" name="files[]" id="fileInputReal" multiple style="display: none;"></div><div id="filePreviewList"></div><div class="modal-footer"><button type="submit" class="btn-primary" id="uploadSubmitBtn" disabled>Upload (<span id="fileCount">0</span>)</button></div></form></div></div>
    <div class="modal" id="linkModal"><div class="modal-content"><div class="modal-header">Add Link <i class="bi bi-x-lg" onclick="closeModal('linkModal')"></i></div><form id="addLinkForm">@csrf<input type="hidden" name="folder_id" value="{{ $currentFolder ? $currentFolder->id : '' }}"><input type="text" id="linkName" name="name" placeholder="Link Display Name" required><input type="url" id="linkURL" name="url" placeholder="https://example.com" required><div class="modal-footer"><button type="submit" class="btn-primary">Save Link</button></div></form></div></div>
    <div class="modal" id="deleteModal"><div class="modal-content"><div class="modal-header">Confirm Delete <i class="bi bi-x-lg" onclick="closeModal('deleteModal')"></i></div><div class="modal-body"><p id="deleteMessage">Are you sure you want to delete this item?</p><p style="color: #ef4444; font-size: 0.85rem;">This action cannot be undone.</p></div><div class="modal-footer"><button type="button" class="btn-gold" onclick="closeModal('deleteModal')">Cancel</button><button type="button" class="btn-primary" onclick="confirmDelete()">Delete</button></div></div></div>
    <div class="modal" id="renameModal"><div class="modal-content"><div class="modal-header">Rename Item <i class="bi bi-x-lg" onclick="closeModal('renameModal')"></i></div><div class="modal-body"><input type="text" id="renameInput" class="form-control" placeholder="New name" autocomplete="off"></div><div class="modal-footer"><button type="button" class="btn-gold" onclick="closeModal('renameModal')">Cancel</button><button type="button" class="btn-primary" onclick="submitRename()">Save</button></div></div></div>

@include('resources.toast')

<script>
    window.ResourceManagerConfig = {
        categorySlug: "{{ $categorySlug }}",
        isAdmin: @json($isAdmin),
        currentFolderId: {{ $parent_id ?? 'null' }},
        csrfToken: '{{ csrf_token() }}',
        showFullDetails: true,   // true for 6‑column table, false for simple 4‑column
        isTechnicalInspector: @json(auth()->user()?->role === 'Technical Inspector'),
    };
</script>
<script src="{{ asset('js/resource.js') }}"></script>

</x-app-layout>