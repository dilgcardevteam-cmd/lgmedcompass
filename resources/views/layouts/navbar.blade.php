@php
    $resourceLinks = [
        ['label' => '01 Regional/Division Orders (Policies)', 'url' => 'https://drive.google.com/drive/u/1/folders/1md7KyYPpOim9F_GwcNtFQadQ3NYquej8'],
        ['label' => '02 Performance Audit Results, and Analytics Reports Shared folder', 'url' => 'https://drive.google.com/drive/u/1/folders/1U-sH7yi2nA1L5CWtid61-SJjxplz6dk1'],
        ['label' => '03 CapDev Intervention / Action Plans', 'url' => 'https://drive.google.com/drive/u/1/folders/1MZ4n5xYa_uZhVQ5UTYUyz4YptWCYM_3j'],
        ['label' => '04 Partnership and Collaboration', 'url' => 'https://drive.google.com/drive/u/1/folders/1evYB-zT3gnd7rnPiW2RPJ39lS4Cwidsi'],
        ['label' => '05 Post Activity Reports', 'url' => 'https://drive.google.com/drive/u/1/folders/1dBW9GlrdmuOKxjKvI3pJkDxyjScwFBAU'],
        ['label' => '06 Databases', 'url' => 'https://drive.google.com/drive/u/1/folders/1z9Dq-9frcvMcqZ9QY4AHhZCA8tE9KUJA'],
        ['label' => '07 Resolution', 'url' => 'https://drive.google.com/drive/u/1/folders/1i8b19Wdb2kvm6oAgbu_kmN5SQj3kvQao'],
    ];
@endphp

<body class="pt-16 md:pt-20">

<nav style="background-color:#1E3A8A !important;"
     class="fixed top-0 left-0 right-0 z-[1000] shadow-md border-b border-white/10 text-white">

<div class="max-w-7xl mx-auto px-4 md:px-6">

    <div class="flex justify-between items-center h-16 md:h-20">

        <!-- LOGO AREA -->
        <a href="{{ url('/') }}" class="flex items-center group no-underline text-white">

            <div class="flex items-center pr-3 md:pr-4 border-r border-white/20">
                <img src="{{ asset('images/dilg-logo.png') }}"
                     class="h-8 md:h-12 w-auto object-contain drop-shadow-sm"
                     alt="DILG Logo">

                <img src="{{ asset('images/bagong-pilipinas.png') }}"
                     class="h-8 md:h-12 w-auto object-contain drop-shadow-sm"
                     alt="Bagong Pilipinas">
            </div>

            <div class="flex items-center gap-x-2 md:gap-x-1 pl-1 md:pl-4">

                <img src="{{ asset('images/lgmed-compass.png') }}"
                     class="h-10 md:h-16 w-auto transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 drop-shadow-md"
                     alt="LGMED Compass Logo">

                <div class="flex flex-col justify-center">
                    <h1 class="text-base md:text-2xl font-semibold text-white uppercase m-0">
                        LGMED <span class="text-[#f6c76f]">Compass</span>
                    </h1>

                    <p class="text-[8px] md:text-[10px] font-bold text-white/70 tracking-[0.5em] uppercase hidden sm:block m-0 leading-none">
                        DILG CAR
                    </p>
                </div>

            </div>

        </a>

        <!-- DESKTOP LINKS -->
        <div class="hidden lg:flex items-center gap-x-4 ml-10">

            <a href="{{ url('/') }}" class="nav-link-custom px-3 py-2 rounded-lg text-sm font-bold text-white">
                Home
            </a>

            <a href="{{ url('/organization') }}" class="nav-link-custom px-3 py-2 rounded-lg text-sm font-bold text-white">
                Organization
            </a>

            <details class="services-dropdown">
                <summary class="nav-link-custom px-3 py-2 rounded-lg text-sm font-bold text-white">
                    Services
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="services-dropdown-panel">
                    <a href="{{ route('reports.landing') }}">PPAs</a>
                    <a href="{{ route('request.index') }}">Request</a>
                    <a href="{{ route('public.lgmed-reports.index') }}">1ClickMe</a>
                    <div class="services-dropdown-divider"></div>
                    <details class="services-resources-dropdown">
                        <summary>
                            Resources
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="services-resources-panel">
                            @foreach ($resourceLinks as $resource)
                                <a href="{{ $resource['url'] }}" target="_blank" rel="noopener noreferrer">{{ $resource['label'] }}</a>
                            @endforeach
                        </div>
                    </details>
                </div>
            </details>

            <div class="h-6 w-px bg-white/20 mx-2"></div>

            <a href="{{ route('login') }}"
               class="bg-[#f6c76f] text-black px-4 py-2 rounded-lg text-sm font-black uppercase tracking-wider hover:bg-[#e0b45f] transition-all shadow-sm">
                Sign In
            </a>

        </div>

        <!-- MOBILE MENU BUTTON -->
        <button onclick="toggleMenu()" class="lg:hidden p-2 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

    </div>

</div>

<!-- MOBILE MENU -->
<div id="navLinks"
     class="hidden flex-col bg-[#1E3A8A] border-t border-white/10 lg:hidden px-4 py-4 gap-y-3 shadow-lg">

    <a href="{{ url('/') }}" class="text-lg font-bold text-white">Home</a>
    <a href="{{ url('/organization') }}" class="text-lg font-bold text-white">Organization</a>
    <details class="services-dropdown-mobile">
        <summary class="text-lg font-bold text-white">Services</summary>
        <div class="services-dropdown-mobile-panel">
            <a href="{{ route('reports.landing') }}" class="text-base font-semibold text-white">PPAs</a>
            <a href="{{ route('request.index') }}" class="text-base font-semibold text-white">Request</a>
            <a href="{{ route('public.lgmed-reports.index') }}" class="text-base font-semibold text-white">1ClickMe</a>
            <details class="services-resources-dropdown-mobile">
                <summary>
                    Resources
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
                    </svg>
                </summary>
                <div class="services-resources-mobile-panel">
                    @foreach ($resourceLinks as $resource)
                        <a href="{{ $resource['url'] }}" target="_blank" rel="noopener noreferrer">{{ $resource['label'] }}</a>
                    @endforeach
                </div>
            </details>
        </div>
    </details>

    <a href="{{ route('login') }}"
       class="bg-[#f6c76f] text-black text-center py-3 rounded-lg font-black uppercase">
        Sign In
    </a>

</div>

</nav>

<style>
.nav-link-custom{
    text-decoration:none;
    transition:all .3s ease;
    position:relative;
}

.nav-link-custom:hover{
    background:rgba(255,255,255,.15);
    transform:translateY(-1px);
}

.navbar a{
    text-decoration:none;
}

.services-dropdown > summary,
.services-dropdown-mobile > summary,
.services-resources-dropdown-mobile > summary{
    cursor:pointer;
    list-style:none;
}

.services-dropdown{
    position:relative;
}

.services-dropdown > summary::-webkit-details-marker,
.services-dropdown-mobile > summary::-webkit-details-marker,
.services-resources-dropdown-mobile > summary::-webkit-details-marker{
    display:none;
}

.services-dropdown > summary{
    display:flex;
    align-items:center;
    gap:.4rem;
}

.services-dropdown-panel{
    display:none;
    position:absolute;
    top:calc(100% + .5rem);
    right:0;
    width:23rem;
    max-height:calc(100vh - 7rem);
    overflow-y:auto;
    padding:.5rem;
    border-radius:.75rem;
    background:#fff;
    box-shadow:0 12px 24px rgba(15,23,42,.2);
}

.services-dropdown[open] .services-dropdown-panel{
    display:flex;
    flex-direction:column;
}

.services-dropdown-panel a{
    padding:.6rem .75rem;
    border-radius:.5rem;
    color:#1e293b;
    font-size:.875rem;
    font-weight:700;
    line-height:1.4;
}

.services-dropdown-panel a:hover{
    background:#fef3c7;
}

.services-resources-dropdown > summary,
.services-resources-dropdown-mobile > summary{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:.5rem;
    padding:.6rem .75rem;
    border-radius:.5rem;
    color:#1e293b;
    font-size:.875rem;
    font-weight:700;
    cursor:pointer;
    list-style:none;
}

.services-resources-dropdown > summary::-webkit-details-marker,
.services-resources-dropdown-mobile > summary::-webkit-details-marker{
    display:none;
}

.services-resources-dropdown[open] > summary svg{
    transform:rotate(180deg);
}

.services-resources-dropdown > summary:hover{
    background:#fef3c7;
}

.services-resources-panel{
    display:none;
    flex-direction:column;
    margin:.25rem 0 .25rem .75rem;
    padding-left:.5rem;
    border-left:2px solid #e2e8f0;
}

.services-resources-dropdown[open] .services-resources-panel{
    display:flex;
}

.services-resources-panel a{
    font-size:.8rem;
}

.services-resources-dropdown-mobile > summary{
    width:fit-content;
    color:white;
    font-size:1rem;
}

.services-resources-dropdown-mobile > summary svg{
    transition:transform .2s ease;
}

.services-resources-dropdown-mobile[open] > summary svg{
    transform:rotate(180deg);
}

.services-resources-mobile-panel{
    display:none;
    flex-direction:column;
    gap:.75rem;
    margin:.5rem 0 0 .5rem;
    padding-left:.75rem;
    border-left:1px solid rgba(255,255,255,.25);
}

.services-resources-dropdown-mobile[open] .services-resources-mobile-panel{
    display:flex;
}

.services-resources-mobile-panel a{
    color:white;
    font-size:.9rem;
    font-weight:600;
    line-height:1.4;
    text-decoration:none;
}

.services-resources-mobile-panel a:hover{
    color:#f6c76f;
}

.services-dropdown-divider{
    margin:.4rem .75rem 0;
    border-top:1px solid #e2e8f0;
}

.services-dropdown-mobile > summary{
    width:fit-content;
}

.services-dropdown-mobile-panel{
    display:none;
    flex-direction:column;
    gap:.75rem;
    padding:.75rem 0 0 1rem;
}

.services-dropdown-mobile[open] .services-dropdown-mobile-panel{
    display:flex;
}

/* Mobile animation */
#navLinks.show{
    display:flex !important;
    animation:slideDown .3s ease-out forwards;
}

@keyframes slideDown{
    from{
        opacity:0;
        transform:translateY(-10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>

<script>
function toggleMenu(){
    const menu = document.getElementById("navLinks")
    menu.classList.toggle("show")
}
</script>

</body>