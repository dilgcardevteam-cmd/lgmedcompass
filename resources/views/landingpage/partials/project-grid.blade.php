<style>
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
            <span class="project-hint">View project details</span>
        </summary>
        <div class="project-details">
            <p>{{ $project->description }}</p>
            @if($project->external_url)
                <a class="project-link" href="{{ $project->external_url }}" target="_blank" rel="noopener noreferrer">
                    Open project link <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                </a>
            @endif
            @if($allowProjectEditing ?? false)
                <form class="project-editor" method="POST" action="{{ route('ppa.project.update', $project) }}">
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
