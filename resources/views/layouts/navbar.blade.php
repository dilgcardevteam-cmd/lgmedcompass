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

            <a href="{{ url('/reports-landing') }}" class="nav-link-custom px-3 py-2 rounded-lg text-sm font-bold text-white">
                PPA's
            </a>

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
    <a href="{{ url('/reports-landing') }}" class="text-lg font-bold text-white">PPA's</a>

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