<x-app-layout>
    <link rel="stylesheet" href="{{ asset('vendor/unicons/line.css') }}">

    <style>
        :root {
            --mustard-subtle: #fef3c7;
            --mustard-main: #f6c76f;
            --mustard-dark: #d3a847;
            --slate-900: #0f172a;
            --slate-600: #475569;
            --card-radius: 24px;
        }

        .app-page-content {
            padding: 2rem;
            background-color: #f8fafc;
        }

        .hero-section {
            max-width: 1200px;
            margin: 0 auto 3rem auto;
            text-align: left;
        }

        .hero-section h2 {
            font-size: 2.5rem;
            font-weight: 500;
            color: var(--slate-900);
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        .hero-section p {
            color: var(--slate-600);
            font-size: 1.1rem;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .res-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.03);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            height: 100%;
        }

        .res-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--mustard-main);
        }

        .res-visual {
            background: #FFC93C;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.4s ease;
        }

        .res-card:hover .res-visual {
            background: #F1C40F;
        }

        .res-visual img {
            width: 120px; /* Adjusted size for better fit */
            height: auto;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
            transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .res-card:hover .res-visual img {
            transform: scale(1.15) rotate(8deg);
        }

        .res-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .res-content h3 {
            font-size: 1.15rem; /* Slightly smaller for long titles */
            font-weight: 700;
            color: var(--slate-900);
            line-height: 1.4;
            margin-bottom: 1rem;
        }

        .res-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--mustard-dark);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .res-action i {
            transition: transform 0.3s ease;
        }

        .res-card:hover .res-action i {
            transform: translateX(5px);
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 50;
            background: var(--slate-900);
            color: white;
            border: none;
            width: 56px;
            height: 56px;
            border-radius: 18px;
            cursor: pointer;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #myBtn:hover {
            background: var(--mustard-main);
            transform: scale(1.1);
        }

        @media (max-width: 640px) {
            .hero-section h2 { font-size: 1.8rem; }
            .resources-grid { grid-template-columns: 1fr; }
        }
    </style>

    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="uil uil-arrow-up"></i>
    </button>

    <main class="app-page-content">
        <div class="hero-section">
            <h2>Resources & Downloads</h2>
            <p>Select a section below to access internal documents and localized resources.</p>
        </div>

        <div class="resources-grid">
            @php
                $categories = [
                    ['name' => 'Division Chief', 'slug' => 'chief'],
                    ['name' => 'Assistant Division Chief', 'slug' => 'assistant-chief'],
                    ['name' => 'LG Relations & Policy Compliance Section', 'slug' => 'lgrpcs'],
                    ['name' => 'LG Performance Management, Recognition, and Awards Section', 'slug' => 'lgpmras'],
                    ['name' => 'LG Peace, Order & Public Safety Compliance Monitoring', 'slug' => 'lgpopscm'],
                    ['name' => 'Support Services Unit', 'slug' => 'ssu'],
                    ['name' => 'Database & Statistical Unit', 'slug' => 'dsu'],
                    ['name' => 'QMS', 'slug' => 'qms'],
                ];
            @endphp

            @foreach($categories as $category)
                <a href="{{ route('resources.rd-' . $category['slug']) }}" class="res-card">
                    <div class="res-visual">
                        <img src="{{ asset('images/dilg-logo.png') }}" alt="DILG Logo">
                    </div>
                    <div class="res-content">
                        <h3>{{ $category['name'] }}</h3>
                        <div class="res-action">
                            Explore Folder <i class="uil uil-arrow-right"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </main>

    <script>
        const mybutton = document.getElementById("myBtn");
        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                mybutton.style.display = "flex";
            } else {
                mybutton.style.display = "none";
            }
        };

        function topFunction() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</x-app-layout>