<x-guest-layout>



<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap');

body {
    padding-top: 30px;
    font-family: 'Inter', sans-serif !important;
    background-color: #ffffff;
}

/* Frosted Glass Button Style */
.btn-glass {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: all 0.3s ease;
}

.btn-glass:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

    /* Scroll to Top Button */
    #myBtn {
        display: none;
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 99;
        font-size: 22px;
        border: none;
        outline: none;
        background-color: #f59e0b;
        color: white;
        cursor: pointer;
        padding: 12px 18px;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    #myBtn:hover {
        background-color: #d97706;
        transform: scale(1.1);
    }
    
/* Modern Card Style */
.core-card {
    background-color: #ffffff;
    padding: 1rem;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    text-align: center;
    transition: all 0.4s ease;
}

.core-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.core-card h3 {
    transition: color 0.3s ease;
}

.core-card:hover h3 {
    color: #f59e0b;
}
.gradient-text {
    background: linear-gradient(to right, #0B3A82, #1E5EFF, #1971a8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
/* Custom Scrollbar */
.custom-scroll::-webkit-scrollbar {
  width: 6px;
}
.custom-scroll::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 10px;
}
.custom-scroll::-webkit-scrollbar-track {
  background: transparent;
}
</style>

<body>


<button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>

<main class="md:pt-27">

<section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-yellow-50">

    <!-- Background layers -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/dilg-building.jpg') }}"
            alt="DILG Building"
            class="w-full h-full object-cover opacity-25 mix-blend-multiply">

        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/40 via-slate-100/40 to-blue-50/40"></div>

        <div class="absolute -top-[10%] -right-[10%] w-[600px] h-[600px] bg-blue-300/20 rounded-full blur-[120px]"></div>

        <div class="absolute -bottom-[10%] -left-[10%] w-[500px] h-[500px] bg-slate-300/20 rounded-full blur-[100px]"></div>

        <div class="absolute inset-0 opacity-[0.04]"
            style="background-image: repeating-linear-gradient(45deg, #1E3A8A 0, #1E3A8A 1px, transparent 0, transparent 100%); background-size: 30px 30px;">
        </div>
    </div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col items-center justify-center text-center max-w-6xl px-6 pt-20 pb-12 w-full">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/40 backdrop-blur-md border border-blue-200 shadow-sm mb-8">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
            </span>
            <span class="text-[10px] font-semibold tracking-[0.2em] text-blue-800 uppercase">
                LGMED Regional Portal
            </span>
        </div>

        <!-- Hero Title -->
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-yellow-800 leading-[0.95] tracking-tight mb-8 font-serif">
            Welcome to <br>
            <span class="gradient-text font-bold">
                LGMED Compass
            </span>
        </h1>

        <!-- Description -->
        <p class="text-base md:text-lg text-yellow-900 max-w-3xl leading-relaxed font-medium mb-12 text-black">
            A high-performance ecosystem built to scale <span class="font-bold">Cordillera's</span> public service efficiency. 
            Empowering local governance through 
            <span class="underline decoration-yellow-500 decoration-2 font-semibold">document automation</span> and 
            <span class="underline decoration-yellow-500 decoration-2 font-semibold">real-time monitoring</span>.
        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-16 text-black">
            <a href="{{ url('/organization') }}"
                class="px-10 py-4 border-2 border-yellow-500 rounded-full font-bold text-yellow-700 bg-white/30 backdrop-blur-sm shadow-sm transition-all duration-300 hover:bg-white/50 hover:text-yellow-900 active:scale-95 no-underline text-black">
                View Sections
            </a>
            <a href="/reports-landing"
                class="px-10 py-4 border-2 border-yellow-500 rounded-full font-bold text-yellow-700 bg-white/30 backdrop-blur-sm shadow-sm transition-all duration-300 hover:bg-white/50 hover:text-yellow-900 active:scale-95 no-underline text-black">
                PPA's
            </a>
        </div>

        <!-- Mandate Cards -->
        <div class="relative w-full z-10 pb-10 flex justify-center">
            <div class="max-w-7xl mx-auto px-4 w-full">
                <div class="bg-yellow-50 border-2 border-yellow-300 rounded-[2.5rem] p-6 md:p-10 shadow-2xl relative flex flex-col items-center justify-center">
                    
                    <!-- Left Image -->
                    <div class="hidden lg:block absolute -top-24 left-12">
                        <img src="https://image2url.com/r2/default/images/1773895759041-67871223-b292-4837-b433-dd02628e78ee.png" class="h-40 drop-shadow-2xl animate-bounce-slow" alt="">
                    </div>

                    <!-- Mandate Text -->
                    <div class="w-full text-center">
                        <p class="text-xs md:text-sm font-semibold tracking-[0.4em] text-yellow-700 uppercase mb-4">
                            Our Official Mandate
                        </p>
                        <h2 class="text-black text-3xl md:text-4xl lg:text-5xl font-semibold tracking-tight flex flex-wrap items-center justify-center gap-3 md:gap-6">
                            MATINO
                            <span class="hidden md:block w-3 h-3 rounded-full bg-yellow-500 shadow-[0_0_10px_rgba(250,204,21,0.5)]"></span>
                            MAHUSAY
                            <span class="hidden md:block w-3 h-3 rounded-full bg-yellow-500 shadow-[0_0_10px_rgba(250,204,21,0.5)]"></span>
                            MAAASAHAN
                        </h2>
                    </div>

                    <!-- Right Image -->
                    <div class="hidden lg:block absolute -top-24 right-12">
                        <img src="https://i.ibb.co/7xKf8X2q/char-right.png" class="h-40 drop-shadow-2xl animate-bounce-slow-delay" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<style>
    @keyframes bounce-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .animate-bounce-slow { animation: bounce-slow 4s ease-in-out infinite; }
    .animate-bounce-slow-delay { animation: bounce-slow 4s ease-in-out infinite 2s; }
</style>

<section class="relative py-20 px-6 bg-[#FFFAEC] overflow-hidden">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-amber-100/40 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10">
        
        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-[#2D241E] uppercase tracking-widest">
                Organizational <span class="text-amber-600">Structure</span>
            </h2>
            <div class="h-1 w-20 bg-amber-400 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="flex justify-center group">
            <div class="relative p-2 bg-white rounded-[2.5rem] shadow-2xl shadow-amber-900/5 border border-amber-100 transition-transform duration-500 hover:scale-[1.01]">
                <img 
                    src="{{ asset('images/OrgChart2.png') }}" 
                    alt="LGMED Organizational Chart"
                    class="w-full h-auto rounded-[2rem]"
                >
            </div>
        </div>
        
    </div>

</section>
    
<section class="relative py-16 px-6 overflow-hidden bg-gradient-to-b from-yellow-100 via-yellow-100 to-yellow-50">
    
    <div class="absolute top-0 left-0 w-full h-full opacity-40 pointer-events-none">
        <div class="absolute -top-[5%] -left-[5%] w-[40%] h-[40%] rounded-full bg-amber-300 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[5%] w-[30%] h-[50%] rounded-full bg-yellow-200 blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        
        <div class="flex flex-col lg:flex-row items-center gap-12 mb-20">
            <div class="lg:w-[45%] text-center lg:text-left">
                <div class="inline-block px-4 py-1 mb-4 rounded-full bg-amber-100 border border-amber-200 shadow-sm">
                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-800">DILG Cordillera Administrative Region</span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-slate-900 leading-[1.1] mb-4">
                    Local Government Monitoring <span class="text-amber-500">&</span> Evaluation Division
                </h2>
                <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="h-1.5 w-16 bg-amber-500 rounded-full"></div>
                    <span class="text-xl font-bold text-slate-400 tracking-tight">(LGMED)</span>
                </div>
            </div>

            <div class="lg:w-[55%] space-y-6">
                <div class="flex justify-center lg:justify-end gap-3">
                    <div class="p-3 w-32 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-white transition-transform hover:scale-105 duration-300 flex items-center justify-center">
                        <img src="{{ asset('images/dilg-logo.png') }}" class="h-16 w-auto object-contain" alt="DILG Logo">
                    </div>
                    <div class="p-3 w-32 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-white transition-transform hover:scale-105 duration-300 flex items-center justify-center">
                        <img src="{{ asset('images/bagong-pilipinas.png') }}" class="h-16 w-auto object-contain" alt="Bagong Pilipinas">
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-xl p-6 md:p-8 rounded-2xl shadow-2xl shadow-slate-200/60 border border-white relative">
                    <div class="absolute -top-3 -left-3 w-10 h-10 bg-amber-400 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg font-serif italic">“</div>
                    <div class="space-y-4">
                        <p class="text-base md:text-lg leading-relaxed text-slate-700 font-medium text-center">
                            The Local Government Monitoring and Evaluation Division (LGMED) is the 
                            <span class="text-slate-900 font-semibold underline decoration-amber-400 decoration-4 underline-offset-4">key oversight arm</span> 
                            of the DILG Cordillera Administrative Region. We strive to ensure that Local Government Units (LGUs) consistently comply with the Local Government Code of 1991 (RA 7160) and other essential national laws, policies, and regulations, promoting effective and accountable local governance.
                        </p>
                        <p class="text-base md:text-lg leading-relaxed text-slate-700 font-medium text-center">
                            Our mission is to <span class="text-slate-900 font-semibold underline decoration-amber-400 decoration-4 underline-offset-4">promote efficient and effective local governance</span>, delivering high-quality service to both our internal teams and external stakeholders.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 mb-16 max-w-xl mx-auto">
<section>
    <div class="text-center mb-10">
        <h2 class="text-4xl md:text-5xl font-semibold text-gray-900 mt-2 mb-4 tracking-tight">
            Our Core Pillars
        </h2>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto leading-relaxed">
            To maintain a high standard of public service, our division is structured into three specialized sections and two support units. Click to learn more about their roles and functions.
        </p>
    </div>

<div class="max-w-7xl mx-auto px-6 py-8 bg-[#FFFAEC] rounded-[3rem] space-y-8">

    <!-- TOP ROW (3 SECTIONS) --> <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> 
        <!-- LG-RPCS --> 
        <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-orange-100 hover:shadow-md flex flex-col"> 
            <button @click="open = !open" class="w-full p-6 text-left"> 
                <div class="flex justify-between items-center"> 
                    <div class="flex items-center gap-4"> 
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center"> 
                            <i class="bi bi-shield-check text-orange-600 text-xl"></i> 
                        </div> 
                        <div> 
                            <h4 class="text-lg font-semibold text-orange-700">LG-RPCS</h4> 
                            <p class="text-xs font-bold text-orange-800/50">Relations & Policy Compliance Section</p> 
                        </div> 
                    </div> 
                    <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 transition-transform"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                 </button> 
                 <div x-show="open" 
                    x-transition
                    class="px-6 pb-6 border-t border-orange-50 text-gray-600 space-y-4">

                    <p>
                        Serves as the bridge between national policies and local implementation, ensuring LGUs remain compliant, informed, and aligned with governance standards while strengthening partnerships and inter-agency coordination.
                    </p>

                    <a href="{{ route('landingpage.lgrpcs') }}"
                    class="inline-block bg-orange-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-orange-600 transition no-underline">
                    View PPA’s →
                    </a>

                </div>
            </div> 
            <!-- LG-PMRAS --> 
             <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-blue-100 hover:shadow-md flex flex-col"> 
                <button @click="open = !open" class="w-full p-6 text-left"> 
                    <div class="flex justify-between items-center"> 
                        <div class="flex items-center gap-4"> 
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center"> 
                                <i class="bi bi-trophy text-blue-600 text-xl"></i> 
                            </div> 
                            <div> 
                                <h4 class="text-lg font-semibold text-blue-700">LG-PMRAS</h4> 
                                <p class="text-xs font-bold text-blue-800/50">Performance Management, Recognition & Awards</p> 
                            </div> 
                        </div> 
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 transition-transform"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button> 
                <div x-show="open" 
                    x-transition
                    class="px-6 pb-6 border-t border-orange-50 text-gray-600 space-y-4">
 
                    <p> Drives excellence in local governance by monitoring performance, promoting transparency, and recognizing outstanding LGUs through results-based systems and incentive-driven programs. </p> 
                    <a href="{{ route('landingpage.lgpmras') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-600 transition no-underline"> View PPA’s → </a> 
                </div> 
            </div> 
            <!-- LG-POPSCM --> 
            <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-red-100 hover:shadow-md flex flex-col"> 
                <button @click="open = !open" class="w-full p-6 text-left"> 
                    <div class="flex justify-between items-center"> 
                        <div class="flex items-center gap-4"> 
                            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center"> 
                                <i class="bi bi-shield-lock text-red-600 text-xl"></i> 
                            </div> 
                            <div> 
                                <h4 class="text-lg font-semibold text-red-700">LG-POPSCM</h4> 
                                <p class="text-xs font-bold text-red-800/50">Peace & Order & Public Safety</p> 
                            </div> 
                        </div> 
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 transition-transform"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button> 
                <div x-show="open" 
                    x-transition
                    class="px-6 pb-6 border-t border-orange-50 text-gray-600 space-y-4">
 
                    <p> Safeguards communities by ensuring effective implementation of peace and order initiatives, strengthening local councils, and monitoring compliance with safety and anti-drug programs. </p> 
                    <a href="{{ route('landingpage.lgpopscm') }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-red-600 transition no-underline"> View PPA’s → </a> 
                </div> 
            </div>
        </div>
   

    <!-- BOTTOM ROW -->
    <div class="flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl">

            <!-- SSU -->
            <div x-data="{ open:false }" class="bg-white rounded-[2rem] border border-yellow-100 hover:shadow-md flex flex-col">

                <button @click="open=!open" class="p-6 text-left">
                    <div class="flex justify-between items-center">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center">
                                <i class="bi bi-gear text-yellow-600 text-xl"></i>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-yellow-700">SSU</h4>
                                <p class="text-xs font-bold text-yellow-800/50">Support Services Unit</p>
                            </div>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 transition-transform"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>

                    </div>
                </button>

                <div x-show="open" 
                    x-transition
                    class="px-6 pb-6 border-t border-orange-50 text-gray-600 space-y-4">
 
                    <p>Powers the division behind the scenes by delivering essential administrative, logistical, and operational support to ensure seamless execution of programs and services.</p>
                    <a href="{{ route('landingpage.ssu') }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-red-600 transition no-underline"> View PPA’s → </a> 
                </div>
            </div>

            <!-- DSU -->
            <div x-data="{ open:false }" class="bg-white rounded-[2rem] border border-green-100 hover:shadow-md flex flex-col">

                <button @click="open=!open" class="p-6 text-left">
                    <div class="flex justify-between items-center">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/4248/4248443.png" class="w-6 h-6">
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-green-700">DSU</h4>
                                <p class="text-xs font-bold text-green-800/50">Database & Statistical Unit</p>
                            </div>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 transition-transform"
                             :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>

                    </div>
                </button>

                <div x-show="open" 
                    x-transition
                    class="px-6 pb-6 border-t border-orange-50 text-gray-600 space-y-4">

                    <p>Transforms raw data into meaningful insights by managing databases, conducting analytics, and producing reports that guide evidence-based planning and decision-making.</p>
                    <a href="{{ route('landingpage.dsu') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-green-600 transition no-underline"> View PPA’s → </a> 
                </div>
            </div>

        </div>
    </div>

</div>

</section>

    <hr class="border-slate-200 mb-16 max-w-xl mx-auto">
    
<section>
    <div class="max-w-6xl mx-auto">
        
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-semibold text-gray-900 tracking-tight">
                Who are <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-yellow-500">we?</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <div class="lg:col-span-5 group relative p-8 md:p-10 bg-white border border-amber-100 rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div class="flex justify-center mb-8">
                        <img src="{{ asset('images/lgmed-compass.png') }}" 
                             class="h-48 md:h-56 w-auto drop-shadow-xl transition-transform duration-700 group-hover:rotate-3 group-hover:scale-110" 
                             alt="LGMED Compass Logo">
                    </div>
                    <div>
                        <p class="text-xl md:text-2xl text-gray-800 leading-snug font-semibold text-center lg:text-left">
                            <span class="text-amber-600">LGMED Compass</span> is a centralized digital ecosystem built to uphold the values of being 
                            <span class="italic font-bold border-b-2 border-amber-400">Matino, Mahusay, at Maaasahan.</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col gap-8">
                
                <div class="p-8 bg-gradient-to-br from-amber-50 to-white border border-amber-100 rounded-[2rem] shadow-lg relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-yellow-400/20 rounded-full blur-3xl group-hover:bg-yellow-400/30 transition-colors"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-amber-500 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-gray-900 font-bold text-xl">Streamlined Operations</h3>
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Efficiently monitor document deadlines, statuses, and reports including an integrated calendar of events.
                        </p>
                    </div>
                </div>

                <div class="flex-grow p-8 bg-white border border-amber-50 rounded-[2rem] shadow-lg flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 order-2 md:order-1 text-center md:text-left">
                        <h3 class="text-amber-600 font-bold text-xl mb-3">Structured Repository</h3>
                        <p class="text-gray-600 leading-relaxed">
                            A digital repository that manages the lifecycle of submissions, making it easier to oversee deliverables and performance at every stage.
                        </p>
                    </div>
                    <div class="flex-shrink-0 order-1 md:order-2">
                        <img src="{{ asset('images/team-illustration.png') }}" 
                             class="w-32 h-32 md:w-40 md:h-40 object-contain drop-shadow-md group-hover:scale-105 transition-transform" 
                             alt="System Illustration">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


    </main>

    <script>

        // Get the button
        let mybutton = document.getElementById("myBtn");

        // Show button when user scrolls down
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // Scroll to top logic
        function topFunction() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>

</x-guest-layout>