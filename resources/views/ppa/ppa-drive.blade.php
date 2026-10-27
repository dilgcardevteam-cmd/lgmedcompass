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

        .report-tile:hover .project-details,
        .report-tile:focus-within .project-details,
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
            <a href="{{ route('ppa.index') }}" class="ppa-back" aria-label="Back to PPA sections">
                <i class="bi bi-chevron-left" aria-hidden="true"></i>
            </a>
            <p>{{ strtoupper($sectionDisplay->code) }}</p>
            <h1>{{ $sectionDisplay->name }}</h1>
        </header>

        <section class="ppa-grid" aria-label="Programs, projects, and activities">
            @include('landingpage.partials.project-grid')
        </section>
    </main>

    @include('ppa.toast')
</x-app-layout>
