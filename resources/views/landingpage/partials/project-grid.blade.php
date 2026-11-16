<style>
    .ppa-grid .report-tile,
    .modern-grid .report-tile {
        position: relative;
        box-sizing: border-box;
        width: 100%;
        height: 300px;
        min-height: 300px;
        align-self: start;
    }

    .ppa-grid .report-tile[open],
    .modern-grid .report-tile:hover,
    .modern-grid .report-tile:focus-within,
    .modern-grid .report-tile[open] {
        height: auto;
    }

    .ppa-grid[data-ppa-admin-mode="edit"] .report-tile {
        background-color: #fef3c7;
    }

    .ppa-grid[data-ppa-admin-mode="delete"] .report-tile {
        background-color: #fee2e2;
    }

    .ppa-grid .project-summary,
    .modern-grid .project-summary {
        box-sizing: border-box;
        min-height: 0;
        flex: 1;
        justify-content: center;
    }

    .ppa-grid .project-summary h4,
    .modern-grid .project-summary h4 {
        display: -webkit-box;
        min-height: 4.2em;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }

    .project-action-trigger {
        position: absolute;
        z-index: 2;
        top: 28px;
        left: 50%;
        width: 80px;
        height: 80px;
        align-items: center;
        justify-content: center;
        padding: 0;
        transform: translateX(-50%) scale(0.94);
        border: 0;
        border-radius: 20px;
        background: white;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        color: #1e293b;
        cursor: pointer;
        display: none;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .ppa-grid[data-ppa-admin-mode="edit"] .project-action-trigger,
    .ppa-grid[data-ppa-admin-mode="delete"] .project-action-trigger {
        display: flex;
        transform: translateX(-50%) scale(1);
    }

    .ppa-grid[data-ppa-admin-mode="delete"] .project-action-trigger {
        color: #dc2626;
    }

    .project-action-trigger:hover,
    .project-action-trigger:focus-visible {
        background: #fffbeb;
    }

    .project-action-trigger i {
        font-size: 30px;
    }

    .ppa-grid[data-ppa-admin-mode="edit"] .project-action-trigger i:last-child,
    .ppa-grid[data-ppa-admin-mode="delete"] .project-action-trigger i:first-child {
        display: none;
    }

    .project-action-trigger:focus-visible {
        outline: 3px solid var(--accent);
        outline-offset: 4px;
    }

    .project-editor {
        display: grid;
        width: 100%;
        gap: 12px;
        text-align: left;
    }

    .project-editor[hidden] {
        display: none;
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
        background: var(--primary);
        color: white;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .project-editor button:hover {
        background: var(--accent);
        color: var(--primary);
    }
</style>

@foreach($projects as $project)
    <details class="report-tile" name="ppa-projects" @if(($allowProjectEditing ?? false) && old('ppa_action') === 'edit-'.$project->id) open @endif>
        <summary class="project-summary">
            <span class="tile-logo-wrapper">
                <img src="https://image2url.com/r2/default/images/1773880295036-5e848f27-e22c-4026-9e98-2013534bf9f2.png" alt="" />
            </span>
            <h4>{{ $project->name }}</h4>
            <span class="project-hint">View PPA details</span>
        </summary>
        @if($allowProjectEditing ?? false)
            <button
                class="project-action-trigger"
                type="button"
                aria-label="Select action for {{ $project->name }}"
                title="Select project action"
                data-project-name="{{ $project->name }}"
            >
                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                <i class="bi bi-trash3-fill" aria-hidden="true"></i>
            </button>
            <form
                class="project-delete-form"
                method="POST"
                action="{{ route('ppa.project.destroy', $project) }}"
                hidden
                data-project-name="{{ $project->name }}"
            >
                @csrf
                @method('DELETE')
            </form>
        @endif
        <div class="project-details">
            <p>{{ $project->description }}</p>
            @if($project->external_url)
                <a class="project-link" href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer">
                    Open project link <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                </a>
            @endif
            @if($allowProjectEditing ?? false)
                <form
                    class="project-editor"
                    id="project-editor-{{ $project->id }}"
                    method="POST"
                    action="{{ route('ppa.project.update', $project) }}"
                    @if(old('ppa_action') !== 'edit-'.$project->id) hidden @endif
                >
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ppa_action" value="edit-{{ $project->id }}">
                    <label>
                        Project name
                        <input
                            type="text"
                            name="name"
                            value="{{ old('ppa_action') === 'edit-'.$project->id ? old('name', $project->name) : $project->name }}"
                            maxlength="255"
                            required
                        />
                        @error('name')
                            @if(old('ppa_action') === 'edit-'.$project->id)
                                <span role="alert">{{ $message }}</span>
                            @endif
                        @enderror
                    </label>
                    <label>
                        Description
                        <textarea name="description" required>{{ old('ppa_action') === 'edit-'.$project->id ? old('description', $project->description) : $project->description }}</textarea>
                        @error('description')
                            @if(old('ppa_action') === 'edit-'.$project->id)
                                <span role="alert">{{ $message }}</span>
                            @endif
                        @enderror
                    </label>
                    <label>
                        Google Drive link
                        <input
                            type="url"
                            name="external_url"
                            value="{{ old('ppa_action') === 'edit-'.$project->id ? old('external_url', $project->external_url) : $project->external_url }}"
                            placeholder="https://drive.google.com/..."
                        />
                        @error('external_url')
                            @if(old('ppa_action') === 'edit-'.$project->id)
                                <span role="alert">{{ $message }}</span>
                            @endif
                        @enderror
                    </label>
                    <button type="submit">Save project details</button>
                </form>
            @endif
        </div>
    </details>
@endforeach

<script>
    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('.project-action-trigger');

        if (!trigger) {
            return;
        }

        const projectCard = trigger.closest('.report-tile');
        const projectGrid = trigger.closest('.ppa-grid');

        if (!projectCard || !projectGrid) {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        if (projectGrid.dataset.ppaAdminMode === 'edit') {
            const editor = projectCard.querySelector('.project-editor');

            if (!editor) {
                return;
            }

            projectCard.open = true;
            editor.hidden = false;
            editor.querySelector('input[name="name"]')?.focus();
            return;
        }

        if (projectGrid.dataset.ppaAdminMode === 'delete') {
            const deleteForm = projectCard.querySelector('.project-delete-form');

            if (deleteForm) {
                window.dispatchEvent(new CustomEvent('ppa:confirm-project-delete', {
                    detail: {
                        form: deleteForm,
                        projectName: deleteForm.dataset.projectName,
                    },
                }));
            }
        }
    });
</script>
