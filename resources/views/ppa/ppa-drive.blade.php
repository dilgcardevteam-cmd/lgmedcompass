<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1e293b;
            --accent: #f59e0b;
            --ppa-primary: #1e293b;
            --ppa-accent: #f59e0b;
            --ppa-glass: rgba(255, 255, 255, 0.9);
        }

        body {
            background: radial-gradient(circle at top right, #fffdf2, #f1f5f9);
            color: var(--ppa-primary);
        }

        .ppa-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        .ppa-header {
            position: relative;
            margin-bottom: 40px;
            text-align: center;
        }

        .ppa-back {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            color: var(--ppa-primary);
            text-decoration: none;
        }

        .ppa-back:hover {
            background: var(--ppa-accent);
            color: white;
        }

        .ppa-header p {
            margin: 0 0 8px;
            color: #64748b;
            font-size: 1rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .ppa-header h1 {
            margin: 0;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
        }

        .ppa-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .report-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 28px;
            border: 2px solid #f0eaa5;
            border-radius: 24px;
            background: var(--ppa-glass);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
            text-align: center;
            transition: all 0.35s ease;
        }

        .report-tile:hover {
            transform: translateY(-8px);
            border-color: var(--ppa-accent);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
        }

        .report-tile summary {
            list-style: none;
        }

        .report-tile summary::-webkit-details-marker {
            display: none;
        }

        .project-summary {
            display: flex;
            width: 100%;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
        }

        .tile-logo-wrapper {
            display: flex;
            width: 80px;
            height: 80px;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.04);
        }

        .tile-logo-wrapper img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .report-tile h4 {
            margin: 0 0 12px;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
        }

        .project-hint {
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
        }

        .project-details {
            display: none;
            width: 100%;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
        }

        .report-tile[open] .project-details {
            display: flex;
        }

        .project-details p {
            margin: 0;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            background: var(--ppa-primary);
            color: white;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .project-link:hover {
            transform: translateY(-2px);
            background: var(--ppa-accent);
            color: var(--ppa-primary);
        }

        .project-editor {
            display: grid;
            width: 100%;
            gap: 12px;
            text-align: left;
        }

        .project-editor label {
            display: grid;
            gap: 6px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .project-editor textarea,
        .project-editor input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            color: #0f172a;
            font: inherit;
            font-weight: 400;
        }

        .project-editor textarea {
            min-height: 90px;
            resize: vertical;
        }

        .project-editor button {
            justify-self: center;
            padding: 10px 16px;
            border: 0;
            border-radius: 12px;
            background: var(--ppa-primary);
            color: white;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .project-editor button:hover {
            background: var(--ppa-accent);
            color: var(--ppa-primary);
        }

        .project-link:focus-visible,
        .project-summary:focus-visible,
        .project-editor button:focus-visible {
            outline: 3px solid var(--ppa-accent);
            outline-offset: 4px;
        }

        .ppa-admin-fab {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 1000;
            display: grid;
            justify-items: end;
            gap: 12px;
        }

        .ppa-admin-fab-menu {
            display: grid;
            min-width: 190px;
            gap: 8px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: white;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.18);
        }

        .ppa-admin-fab-menu[hidden] {
            display: none;
        }

        .ppa-admin-fab-menu button,
        .ppa-admin-fab-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .ppa-admin-fab-menu button {
            justify-content: flex-start;
            padding: 10px 12px;
            border-radius: 10px;
            background: white;
            color: #1e293b;
        }

        .ppa-admin-fab-menu button:hover,
        .ppa-admin-fab-menu button:focus-visible {
            background: #fffbeb;
        }

        .ppa-admin-fab-menu .ppa-admin-fab-delete {
            color: #b91c1c;
        }

        .ppa-admin-fab-menu button i {
            width: 20px;
            font-size: 18px;
            text-align: center;
        }

        .ppa-admin-fab-toggle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--ppa-accent);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.22);
            color: #1e293b;
            font-size: 26px;
        }

        .ppa-admin-fab-toggle:hover,
        .ppa-admin-fab-toggle:focus-visible {
            transform: translateY(-2px);
            background: #fbbf24;
        }

        .ppa-admin-fab button:focus-visible,
        .ppa-project-dialog button:focus-visible,
        .ppa-project-dialog input:focus-visible,
        .ppa-project-dialog textarea:focus-visible {
            outline: 3px solid #f59e0b;
            outline-offset: 3px;
        }

        .ppa-project-dialog {
            position: fixed;
            inset: 0;
            margin: auto;
            width: min(520px, calc(100vw - 32px));
            max-height: calc(100vh - 32px);
            padding: 24px;
            overflow-y: auto;
            border: 0;
            border-radius: 20px;
            color: #1e293b;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.3);
        }

        .ppa-project-dialog::backdrop {
            background: rgba(15, 23, 42, 0.55);
        }

        .ppa-project-dialog h2 {
            margin: 0 0 18px;
            font-size: 1.4rem;
            font-weight: 800;
        }

        .ppa-project-dialog form {
            display: grid;
            gap: 14px;
        }

        .ppa-project-dialog label {
            display: grid;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
        }

        .ppa-project-dialog input,
        .ppa-project-dialog textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            color: #0f172a;
            font: inherit;
            font-weight: 400;
        }

        .ppa-project-dialog textarea {
            min-height: 100px;
            resize: vertical;
        }

        .ppa-project-dialog [role="alert"] {
            color: #b91c1c;
            font-weight: 600;
        }

        .ppa-project-dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 6px;
        }

        .ppa-project-dialog-actions button {
            padding: 10px 14px;
            border: 0;
            border-radius: 10px;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .ppa-project-dialog-cancel {
            background: #e2e8f0;
            color: #1e293b;
        }

        .ppa-project-dialog-submit {
            background: #1e293b;
            color: white;
        }

        .ppa-delete-dialog {
            max-width: 440px;
        }

        .ppa-delete-dialog-content {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .ppa-delete-dialog-icon {
            display: flex;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fee2e2;
            color: #b91c1c;
            font-size: 20px;
        }

        .ppa-delete-dialog-description {
            margin: 8px 0 0;
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
        }

        .ppa-delete-dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .ppa-delete-dialog-actions button {
            padding: 10px 14px;
            border: 0;
            border-radius: 10px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .ppa-delete-dialog-actions .ppa-admin-fab-delete {
            background: #dc2626;
            color: white;
        }

        .ppa-delete-dialog-actions .ppa-admin-fab-delete:hover {
            background: #b91c1c;
        }

        @media (max-width: 1024px) {
            .ppa-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .ppa-page {
                padding: 32px 16px;
            }

            .ppa-header {
                padding-top: 56px;
            }

            .ppa-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <main class="ppa-page">
        <header class="ppa-header">
            <a href="{{ $backUrl ?? route('ppa.index') }}" class="ppa-back" aria-label="Back to PPA sections">
                <i class="bi bi-chevron-left" aria-hidden="true"></i>
            </a>
            <p>{{ strtoupper($sectionDisplay->code) }}</p>
            <h1>{{ $sectionDisplay->name }}</h1>
        </header>

        <section class="ppa-grid" aria-label="Programs, projects, and activities">
            @include('landingpage.partials.project-grid')
        </section>
    </main>

    @if($allowProjectEditing)
        <div class="ppa-admin-fab">
            <div class="ppa-admin-fab-menu" id="ppaAdminFabMenu" hidden>
                <button type="button" data-ppa-fab-action="add">
                    <i class="bi bi-plus-circle" aria-hidden="true"></i>
                    Add project
                </button>
                <button type="button" data-ppa-fab-action="edit">
                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                    Edit project
                </button>
                <button type="button" class="ppa-admin-fab-delete" data-ppa-fab-action="delete">
                    <i class="bi bi-trash3-fill" aria-hidden="true"></i>
                    Delete project
                </button>
                <button type="button" data-ppa-fab-action="exit">
                    <i class="bi bi-x-circle" aria-hidden="true"></i>
                    Exit project mode
                </button>
            </div>
            <button
                class="ppa-admin-fab-toggle"
                id="ppaAdminFabToggle"
                type="button"
                aria-label="Open project actions"
                aria-controls="ppaAdminFabMenu"
                aria-expanded="false"
                title="Project actions"
            >
                <i class="bi bi-plus-lg" aria-hidden="true"></i>
            </button>
        </div>

        <dialog
            class="ppa-project-dialog"
            id="ppaAddProjectDialog"
            @if($errors->any() && old('ppa_action') === 'create') data-auto-open="true" @endif
        >
            <h2>Add project to {{ $sectionDisplay->code }}</h2>
            <form method="POST" action="{{ route('ppa.project.store', $sectionCode) }}">
                @csrf
                <input type="hidden" name="ppa_action" value="create">
                <label>
                    Project name
                    <input type="text" name="name" value="{{ old('ppa_action') === 'create' ? old('name') : '' }}" maxlength="255" required>
                    @if(old('ppa_action') === 'create')
                        @error('name')
                            <span role="alert">{{ $message }}</span>
                        @enderror
                    @endif
                </label>
                <label>
                    Description
                    <textarea name="description" maxlength="5000" required>{{ old('ppa_action') === 'create' ? old('description') : '' }}</textarea>
                    @if(old('ppa_action') === 'create')
                        @error('description')
                            <span role="alert">{{ $message }}</span>
                        @enderror
                    @endif
                </label>
                <label>
                    Google Drive link
                    <input
                        type="url"
                        name="external_url"
                        value="{{ old('ppa_action') === 'create' ? old('external_url') : '' }}"
                        placeholder="https://drive.google.com/..."
                    >
                    @if(old('ppa_action') === 'create')
                        @error('external_url')
                            <span role="alert">{{ $message }}</span>
                        @enderror
                    @endif
                </label>
                <div class="ppa-project-dialog-actions">
                    <button class="ppa-project-dialog-cancel" type="button" data-ppa-dialog-close>Cancel</button>
                    <button class="ppa-project-dialog-submit" type="submit">Add project</button>
                </div>
            </form>
        </dialog>

        <dialog
            class="ppa-project-dialog ppa-delete-dialog"
            id="ppaDeleteProjectDialog"
            aria-labelledby="ppaDeleteProjectTitle"
            aria-describedby="ppaDeleteProjectDescription"
        >
            <div class="ppa-delete-dialog-content">
                <div class="ppa-delete-dialog-icon" aria-hidden="true">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h2 id="ppaDeleteProjectTitle">Permanently delete project?</h2>
                    <p class="ppa-delete-dialog-description" id="ppaDeleteProjectDescription">
                        Permanently delete <strong id="ppaDeleteProjectName"></strong>? This action cannot be undone.
                    </p>
                </div>
            </div>
            <div class="ppa-delete-dialog-actions">
                <button class="ppa-project-dialog-cancel" id="cancelPpaProjectDelete" type="button">Cancel</button>
                <button class="ppa-admin-fab-delete" id="confirmPpaProjectDelete" type="button">Permanently delete</button>
            </div>
        </dialog>

        <script>
            (function () {
                const menu = document.getElementById('ppaAdminFabMenu');
                const toggle = document.getElementById('ppaAdminFabToggle');
                const dialog = document.getElementById('ppaAddProjectDialog');
                const deleteDialog = document.getElementById('ppaDeleteProjectDialog');
                const deleteProjectName = document.getElementById('ppaDeleteProjectName');
                const confirmDeleteButton = document.getElementById('confirmPpaProjectDelete');
                const projectGrid = document.querySelector('.ppa-grid');
                const modeAfterValidation = @json(str_starts_with(old('ppa_action', ''), 'edit-') ? 'edit' : '');

                if (!menu || !toggle || !dialog || !deleteDialog || !deleteProjectName || !confirmDeleteButton || !projectGrid) {
                    return;
                }

                let pendingDeleteForm = null;

                if (modeAfterValidation) {
                    updateProjectActionLabels(modeAfterValidation);
                    setProjectMode(modeAfterValidation);
                }

                if (dialog.dataset.autoOpen === 'true') {
                    dialog.showModal();
                }

                function setProjectMode(mode) {
                    if (mode) {
                        projectGrid.dataset.ppaAdminMode = mode;
                    } else {
                        delete projectGrid.dataset.ppaAdminMode;
                        projectGrid.querySelectorAll('.project-editor').forEach(function (editor) {
                            editor.hidden = true;
                        });
                        projectGrid.querySelectorAll('.report-tile[open]').forEach(function (projectCard) {
                            projectCard.open = false;
                        });
                    }

                    const modeIcons = {
                        edit: '<i class="bi bi-pencil-square" aria-hidden="true"></i>',
                        delete: '<i class="bi bi-trash3-fill" aria-hidden="true"></i>',
                    };
                    const modeLabels = {
                        edit: 'Edit mode active. Open project actions',
                        delete: 'Delete mode active. Open project actions',
                    };

                    toggle.innerHTML = modeIcons[mode] || '<i class="bi bi-plus-lg" aria-hidden="true"></i>';
                    toggle.setAttribute('aria-label', modeLabels[mode] || 'Open project actions');
                    toggle.title = modeLabels[mode] || 'Project actions';

                    menu.querySelectorAll('[data-ppa-fab-action="edit"], [data-ppa-fab-action="delete"]').forEach(function (button) {
                        button.setAttribute('aria-pressed', String(button.dataset.ppaFabAction === mode));
                    });
                }

                function updateProjectActionLabels(mode) {
                    document.querySelectorAll('.project-action-trigger').forEach(function (button) {
                        if (!mode) {
                            button.setAttribute('aria-label', `Select action for ${button.dataset.projectName}`);
                            button.title = 'Select project action';
                            return;
                        }

                        const action = mode === 'delete' ? 'Delete' : 'Edit';
                        button.setAttribute('aria-label', `${action} ${button.dataset.projectName}`);
                        button.title = `${action} project`;
                    });
                }

                toggle.addEventListener('click', function () {
                    menu.hidden = !menu.hidden;
                    toggle.setAttribute('aria-expanded', String(!menu.hidden));
                });

                menu.addEventListener('click', function (event) {
                    const actionButton = event.target.closest('[data-ppa-fab-action]');

                    if (!actionButton) {
                        return;
                    }

                    const action = actionButton.dataset.ppaFabAction;
                    menu.hidden = true;
                    toggle.setAttribute('aria-expanded', 'false');

                    if (action === 'add') {
                        updateProjectActionLabels('');
                        setProjectMode('');
                        dialog.showModal();
                        dialog.querySelector('input[name="name"]').focus();
                        return;
                    }

                    if (action === 'edit' || action === 'delete') {
                        updateProjectActionLabels(action);
                        setProjectMode(action);
                        return;
                    }

                    updateProjectActionLabels('');
                    setProjectMode('');
                });

                dialog.addEventListener('click', function (event) {
                    if (event.target.closest('[data-ppa-dialog-close]')) {
                        dialog.close();
                    }
                });

                window.addEventListener('ppa:confirm-project-delete', function (event) {
                    pendingDeleteForm = event.detail.form;
                    deleteProjectName.textContent = event.detail.projectName;
                    deleteDialog.showModal();
                });

                document.getElementById('cancelPpaProjectDelete').addEventListener('click', function () {
                    deleteDialog.close();
                });

                confirmDeleteButton.addEventListener('click', function () {
                    if (!pendingDeleteForm) {
                        return;
                    }

                    pendingDeleteForm.requestSubmit();
                    deleteDialog.close();
                });

                deleteDialog.addEventListener('close', function () {
                    pendingDeleteForm = null;
                });
            })();
        </script>
    @endif

    @include('ppa.toast')
</x-app-layout>
