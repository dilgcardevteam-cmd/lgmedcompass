<x-guest-layout>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --primary: #1e293b;
        --accent: #f59e0b;
        --glass: rgba(255, 255, 255, 0.9);
        --border: rgba(229, 231, 235, 0.5);
    }

    html { scroll-behavior: smooth; }

    body {
        font-family: 'Inter', "Segoe UI", sans-serif;
        background: radial-gradient(circle at top right, #fffdf2, #f1f5f9);
        margin: 0;
        color: var(--primary);
    }

    main {
        padding: 80px 24px;
        display: flex;
        justify-content: center;
    }

    /* Container */
    .reports-container {
        max-width: 1200px;
        width: 100%;
    }

    /* Header Section */
    .header-section {
        text-align: center;
        margin-bottom: 60px;
    }

    .header-top {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 10px;
    }

    .header-section h2 {
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #64748b;
        margin-bottom: 8px;
    }

    .header-section h1 {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(to right, #1e293b, #f59e0b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
    }

    /* Grid Layout - FIXED TO 3 */
    .modern-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .modern-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .modern-grid {
            grid-template-columns: 1fr;
        }

        .header-section h1 {
            font-size: 2.5rem;
        }
    }

    /* Modern Card */
    .report-tile {
        background: var(--glass);
        backdrop-filter: blur(10px);

        /* 🔥 STRONGER BORDER */
        border: 2px solid #f0eaa5;

        border-radius: 24px;
        padding: 32px;

        transition: all 0.35s ease;

        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;

        /* Optional subtle shadow */
        box-shadow: 0 6px 18px rgba(0,0,0,0.04);
    }

    .report-tile:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
        border-color: var(--accent);
    }

    /* Logo */
    .tile-logo-wrapper {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.04);
    }

    .tile-logo-wrapper img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }

    .report-tile h4 {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 12px;
        line-height: 1.4;
        color: #0f172a;
    }

    .report-tile summary {
        list-style: none;
    }

    .report-tile summary::-webkit-details-marker {
        display: none;
    }

    .project-summary {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        cursor: pointer;
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
        flex-direction: column;
        align-items: center;
        gap: 16px;
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
        background: var(--primary);
        color: white;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .project-link:hover {
        background: var(--accent);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .project-link:focus-visible,
    .project-summary:focus-visible {
        outline: 3px solid var(--accent);
        outline-offset: 4px;
    }

    .focal-badge {
        font-size: 12px;
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 100px;
        color: #475569;
        font-weight: 500;
    }

    /* Back Button (FIXED) */
    .back-nav {
        background: white;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        color: var(--primary);
        text-decoration: none;
        transition: 0.3s;
    }

    .back-nav:hover {
        background: var(--accent);
        color: white;
    }

    /* Scroll Top */
    #myBtn {
        display: none;
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        border: none;
        background: var(--primary);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 15px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myBtn:hover {
        background: var(--accent);
        transform: scale(1.1);
    }
</style>

<button onclick="topFunction()" id="myBtn">
    <i class="bi bi-arrow-up"></i>
</button>

<main>
    <div class="reports-container">
        
        <div class="header-section">

            <!-- FIXED BACK BUTTON -->
            <div class="header-top">
                <a href="/reports-landing" class="back-nav">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </div>

            <h2>Database and Statistical Unit</h2>
            <h1>DSU</h1>
        </div>

        <div class="modern-grid">
            @php
                $projects = [
                    'Data analysis on functional/audit results, and others',
                    'Masterlisting (BIS and ELOPDS)',
                    'Monitoring Report on the Accreditation and Representation of Barangay- Based CSOs/NGOS',
                    'Other Barangay Certification',
                ];
            @endphp

            @foreach($projects as $project)
                <details class="report-tile" name="ppa-projects">
                    <summary class="project-summary">
                        <span class="tile-logo-wrapper">
                            <img src="https://image2url.com/r2/default/images/1773880295036-5e848f27-e22c-4026-9e98-2013534bf9f2.png" alt="" />
                        </span>
                        <h4>{{ $project }}</h4>
                        <span class="project-hint">View project details</span>
                    </summary>
                    <div class="project-details">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a class="project-link" href="https://drive.google.com/" target="_blank" rel="noopener noreferrer">
                            Open project link <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</main>

<script>
    let mybutton = document.getElementById("myBtn");

    window.onscroll = function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    };

    function topFunction() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

</x-guest-layout>