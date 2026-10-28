<x-guest-layout>
    <title>DILG - LGMED Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --accent-gold: #f5c76d;
            --soft-yellow: #fefce8;
            --dark-slate: #1e293b;
            --text-gray: #64748b;
        }

        html, body {
            background: linear-gradient(160deg, #fdfcf0 0%, #fef9c3 100%) !important;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--dark-slate);
            margin: 0;
        }

        .reports-wrapper {
            padding: 120px 24px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header-box {
            text-align: center;
            margin-bottom: 60px;
            max-width: 800px;
        }

        .header-box h2 {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            background: linear-gradient(to bottom right, #1e293b, #475569);
            -webkit-background-clip: text;
            -webkit-fill-color: transparent;
        }

        .header-box .subtitle {
            font-size: 1.1rem;
            color: var(--text-gray);
            font-weight: 400;
        }

        /* Grid */
        .reports-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            width: 100%;
            max-width: 1280px;
        }

        /* Card */
        .modern-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 2px solid #f1f5f9; /* ✅ visible border */
            border-radius: 32px;
            padding: 40px 30px;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        .modern-card:hover {
            transform: translateY(-12px);
            background: #ffffff;
            box-shadow: 0 25px 50px -12px rgba(245, 199, 109, 0.25);
            border-color: var(--accent-gold);
        }

        /* 🔥 BIGGER LOGO CONTAINER */
        .logo-sphere {
            width: 160px;
            height: 160px;
            background: var(--soft-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            transition: 0.5s ease;
            position: relative;
        }

        .logo-sphere::after {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 2px dashed transparent;
            transition: 0.5s;
        }

        /* 🔥 BIGGER IMAGE */
        .logo-sphere img {
            width: 80px;   /* increased from 90px */
            height: 80px;
            object-fit: contain;
            transition: 0.4s;
            filter: drop-shadow(0 6px 10px rgba(0,0,0,0.15));
        }

        /* Hover Effects */
        .modern-card:hover .logo-sphere {
            transform: scale(1.1) rotate(5deg);
            background: white;
        }

        .modern-card:hover .logo-sphere::after {
            border-color: var(--accent-gold);
            transform: rotate(45deg);
        }

        .modern-card:hover .logo-sphere img {
            transform: scale(1.1);
        }

        /* Text */
        .modern-card h4 {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--dark-slate);
            line-height: 1.5;
            margin: 0 0 10px 0;
            text-align: center;
        }
        .acronym {
            display: block;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            color: #f59e0b;
            text-transform: uppercase;
        }

        /* Arrow */
        .hover-arrow {
            margin-top: 20px;
            opacity: 0;
            transform: translateY(10px);
            transition: 0.3s;
            color: var(--accent-gold);
            font-size: 1.5rem;
        }

        .modern-card:hover .hover-arrow {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media(max-width: 1024px) {
            .reports-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media(max-width: 680px) {
            .reports-grid { grid-template-columns: 1fr; }
            .header-box h2 { font-size: 1.8rem; }

            /* slightly smaller logo on mobile */
            .logo-sphere {
                width: 130px;
                height: 130px;
            }

            .logo-sphere img {
                width: 90px;
                height: 90px;
            }
        }
    </style>

    <main>
        <div class="reports-wrapper">

            <div class="header-box">
                <h2>PROGRAMS, PROJECTS & ACTIVITIES</h2>
                <p class="subtitle">
                    Navigate through the LGMED sections to explore list of PPA's.
                </p>
            </div>

            <div class="reports-grid">

                <!-- LG-RPCS -->
                <a href="{{ route('landingpage.lgrpcs') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://image2url.com/r2/default/images/1773891972689-b550c91a-e0a9-4b3d-b4a9-004c347fcc14.png">
                    </div>
                    <h4>LG-RPCS</h4>
                    <span class="acronym">Relations & Policy Compliance Section</span>
                </a>

                <!-- LG-PMRAS -->
                <a href="{{ route('landingpage.lgpmras') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://image2url.com/r2/default/images/1773892132578-d814de20-1b1d-4688-b973-9ea90dc9b351.png">
                    </div>
                    <h4>LG-PMRAS</h4>
                    <span class="acronym">Performance Management, Recognition & Awards</span>
                </a>

                <!-- LG-POPSCM -->
                <a href="{{ route('landingpage.lgpopscm') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://image2url.com/r2/default/images/1773892177167-4f8924b5-fffc-4ca5-9c32-9e06dfd0bce4.png">
                    </div>
                    <h4>LG-POPSCM</h4>
                    <span class="acronym">Peace & Order & Public Safety</span>
                </a>

                <!-- SSU -->
                <a href="{{ route('landingpage.ssu') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://cdn-icons-png.flaticon.com/512/3524/3524636.png">
                    </div>
                    <h4>SSU</h4>
                    <span class="acronym">Support Services Unit</span>
                </a>

                <!-- DSU -->
                <a href="{{ route('landingpage.dsu') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://cdn-icons-png.flaticon.com/512/4248/4248439.png">
                    </div>
                    <h4>DSU</h4>
                    <span class="acronym">Database & Statistical Unit</span>
                </a>

                <a href="{{ route('landingpage.qms') }}" class="modern-card">
                    <div class="logo-sphere">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" alt="">
                    </div>
                    <h4>QMS</h4>
                    <span class="acronym">Quality Management System</span>
                </a>

            </div>
        </div>
    </main>

</x-guest-layout>