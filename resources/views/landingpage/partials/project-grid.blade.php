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

    .project-edit-trigger {
        position: absolute;
        z-index: 2;
        top: 28px;
        left: 50%;
        display: flex;
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
        color: var(--accent);
        cursor: pointer;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease, background-color 0.2s ease;
    }

    .report-tile:hover .project-edit-trigger,
    .report-tile:focus-within .project-edit-trigger,
    .project-edit-trigger:focus-visible {
        transform: translateX(-50%) scale(1);
        opacity: 1;
        pointer-events: auto;
    }

    .project-edit-trigger:hover,
    .project-edit-trigger:focus-visible {
        background: #fffbeb;
    }

    .project-edit-trigger img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .project-edit-trigger i {
        position: absolute;
        font-size: 30px;
        opacity: 0;
        transform: scale(0.75);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .project-edit-trigger:hover img,
    .project-edit-trigger:focus-visible img {
        opacity: 0;
        transform: scale(0.8);
    }

    .project-edit-trigger:hover i,
    .project-edit-trigger:focus-visible i {
        opacity: 1;
        transform: scale(1);
    }

    .project-edit-trigger:focus-visible {
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
    <details class="report-tile" name="ppa-projects">
        <summary class="project-summary">
            <span class="tile-logo-wrapper">
                <img src="https://image2url.com/r2/default/images/1773880295036-5e848f27-e22c-4026-9e98-2013534bf9f2.png" alt="" />
            </span>
            <h4>{{ $project->name }}</h4>
            <span class="project-hint">View PPA details</span>
        </summary>
        @if($allowProjectEditing ?? false)
            <button
                class="project-edit-trigger"
                type="button"
                aria-label="Edit {{ $project->name }}"
                aria-controls="project-editor-{{ $project->id }}"
                aria-expanded="false"
                title="Edit project details"
            >
                <img src="https://image2url.com/r2/default/images/1773880295036-5e848f27-e22c-4026-9e98-2013534bf9f2.png" alt="" />
                <i class="bi bi-pencil-square" aria-hidden="true"></i>
            </button>
        @endif
        <div class="project-details">
            <p>{{ $project->description }}</p>
            @if($project->external_url)
                <a class="project-link" href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer">
                    Open project link <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                </a>
            @endif
            @if($allowProjectEditing ?? false)
                <form class="project-editor" id="project-editor-{{ $project->id }}" method="POST" action="{{ route('ppa.project.update', $project) }}" hidden>
                    @csrf
                    @method('PUT')
                    <label>
                        Description
                        <textarea name="description" required>{{ $project->description }}</textarea>
                        @error('description')
                            <span role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <label>
                        Google Drive link
                        <input type="url" name="external_url" value="{{ $project->external_url }}" placeholder="https://drive.google.com/..." />
                        @error('external_url')
                            <span role="alert">{{ $message }}</span>
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
        const trigger = event.target.closest('.project-edit-trigger');

        if (!trigger) {
            return;
        }

        const editor = document.getElementById(trigger.getAttribute('aria-controls'));
        const projectCard = trigger.closest('.report-tile');

        if (!editor || !projectCard) {
            return;
        }

        const isOpening = editor.hidden;
        editor.hidden = !isOpening;
        trigger.setAttribute('aria-expanded', String(isOpening));

        if (isOpening) {
            projectCard.open = true;
        }
    });
</script>
