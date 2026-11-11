<x-guest-layout>
    
    <title>DILG - LGMED Organization</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,700&display=swap');

        body { 
            font-family:'Inter',sans-serif;            
            background-color: #ffffff; 
        }

        .serif-italic { 
            font-family: 'Playfair Display', serif; 
            font-style: italic; 
        }
        html {
            scroll-behavior: smooth;
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

        .container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #fff;
        }

        /* The Peach outer frame */
        .section-card {
            background-color: #fde4cf; 
            width: 320px; /* Slightly wider to accommodate a larger logo */
            padding: 20px; 
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }

        .section-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.2);
        }

        /* Yellow top container - increased height */
        .logo-container {
            background-color: #f4cd56;
            height: 180px; /* Increased from 160px */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Logo styling - increased size */
        .logo-container img {
            width: 250px; /* Increased from 110px */
            max-width: 120%; /* Ensures it doesn't hit the edges */
            height: auto;
            object-fit: contain;
        }

        /* White bottom container */
        .text-container {
            background-color: #ffffff;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .text-container p {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 1.15rem;
            line-height: 1.4;
            margin: 0;
        }
        [x-cloak] { display: none !important; }
    </style>


<button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
<main>
    
    <section class="relative py-20 px-6 bg-gradient-to-b from-orange-200 via-yellow-200 to-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="max-w-7xl mx-auto">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-amber-900/5 border border-amber-100 flex flex-col items-center text-center group hover:border-amber-400 transition-all"> 
                    <h3 class="text-3xl font-black text-amber-700 uppercase tracking-widest mb-4">Mission</h3> 
                    <p class="text-[#5D534A] leading-relaxed text-lg"> 
                        The Department shall ensure peace and order, public safety and security, uphold excellence in local governance and enable resilient and inclusive communities.
                    </p> 
                </div> 

                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-amber-900/5 border border-amber-100 flex flex-col items-center text-center group hover:border-amber-400 transition-all"> 
                    <h3 class="text-3xl font-black text-amber-700 uppercase tracking-widest mb-4">Vision</h3> 
                    <p class="text-[#5D534A] leading-relaxed text-lg"> 
                        A highly trusted Department and Partner in nurturing local governments and sustaining peaceful, safe, progressive, resilient, and inclusive communities towards a comfortable and secure life for Filipinos by 2040.
                    </p> 
                </div>
                </div>

<div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl shadow-amber-900/10 border-2 border-amber-200 relative overflow-hidden group flex flex-col justify-center w-full max-w-full md:col-span-3">
    
    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:rotate-12 transition-transform">
        <svg class="w-28 h-28 md:w-32 md:h-32 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
        </svg>
    </div>

    <h3 class="text-3xl md:text-4xl font-black text-amber-700 uppercase tracking-widest mb-6 border-b-2 border-amber-100 pb-2 inline-block">
        Quality Policy
    </h3>

    <div class="space-y-5 text-[#5D534A] text-base md:text-lg font-medium leading-relaxed">
        
        <p>
            We, the DILG, imbued with the core values of <span class="text-amber-700 font-bold">Integrity, Commitment, Teamwork and Responsiveness</span>, commit to formulate sound policies on strengthening local government capacities, performing oversight function over LGUs, and providing rewards and incentives. <span class="text-amber-700 font-bold">We pledge to provide effective technical and administrative services</span> to uphold excellence in local governance and enhance the service delivery of our Regional and Field Offices <span class="text-amber-700 font-bold">to become trusted partners in nurturing local governments and sustaining peaceful, safe, progressive, resilient, and inclusive communities</span>
        </p>
        <p>
            We commit to continually improve the effectiveness of our Quality Management System compliant with applicable statutory and regulatory requirements and international standards, gearing towards organizational efficiency and client satisfaction.
        </p>
        <p>
            We commit to consistently demonstrate a <span class="italic text-orange-600 font-bold">"Matino, Mahusay at Maaasahang Kagawaran Para sa Mapagkalinga at Maunlad na Pamahalaang Lokal"</span>.
        </p>

    </div>

</div>
            </div>
            

            <!-- Core Values Row (full width below top row) -->
            <div class="flex justify-center mt-12">
                <!-- Core Values Card -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-amber-900/5 border border-amber-100 w-full max-w-5xl">
                    <h3 class="text-2xl font-black text-amber-700 uppercase tracking-widest mb-8 text-center">Shared Values</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    
                        <!-- Isko -->
                        <div class="relative flex items-center justify-center p-6 w-full max-w-[250px] h-[260px] mx-auto 
                                bg-[#FFFAEC] rounded-2xl border border-amber-100 
                                group hover:bg-blue-800 transition-all duration-300 overflow-hidden">  
                            
                            <!-- DEFAULT -->
                            <div class="flex flex-col items-center gap-4 group-hover:hidden">
                                <div class="w-20 h-20 rounded-full bg-white shadow-sm flex items-center justify-center overflow-hidden">
                                    <img src="https://image2url.com/r2/default/images/1773892441809-c6dd31d9-fb7c-48bc-b483-3a38fe81cb4f.png" class="w-full h-full object-contain">
                                </div>
                                <p class="text-xs font-black text-amber-600 uppercase tracking-tighter">Isko</p>
                                <p class="text-lg font-bold text-[#2D241E]">MATINO</p>
                                <p class="text-sm text-center italic text-[#2D241E]">
                                    "Accountable, Committed, Works with Integrity"
                                </p>
                            </div>

                            <!-- HOVER -->
                            <div class="absolute inset-0 flex items-center justify-center px-4 text-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <p class="text-white text-sm">
                                    "As Individuals: Work with integrity and genuine commitment to accountability and transparency"
                                </p>
                            </div>

                        </div>

                        <!-- Isay -->
                        <div class="relative flex items-center justify-center p-6 w-full max-w-[250px] h-[260px] mx-auto 
                                bg-[#FFFAEC] rounded-2xl border border-amber-100 
                                group hover:bg-blue-800 transition-all duration-300 overflow-hidden">  
                            
                            <!-- DEFAULT -->
                            <div class="flex flex-col items-center gap-4 group-hover:hidden">
                                <div class="w-20 h-20 rounded-full bg-white shadow-sm flex items-center justify-center overflow-hidden">
                                    <img src="https://image2url.com/r2/default/images/1773892399590-51c1516d-2427-41e0-8810-32e3847fe282.png" class="w-full h-full object-contain">
                                </div>
                                <p class="text-xs font-black text-amber-600 uppercase tracking-tighter">Isay</p>
                                <p class="text-lg font-bold text-[#2D241E]">MAHUSAY</p>
                                <p class="text-sm text-center italic text-[#2D241E]">
                                    "Skillful, Capable, Methodical, Excellent"
                                </p>
                            </div>

                            <!-- HOVER -->
                            <div class="absolute inset-0 flex items-center justify-center px-4 text-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <p class="text-white text-sm">
                                    "As Individuals: Provide capable, methodical, and excellent service to clientele as further strengthened by continuous professionalization and capacity building."
                                </p>
                            </div>

                        </div>

                        <!-- Ana -->
                        <div class="relative flex items-center justify-center p-6 w-full max-w-[250px] h-[260px] mx-auto 
                                bg-[#FFFAEC] rounded-2xl border border-amber-100 
                                group hover:bg-blue-800 transition-all duration-300 overflow-hidden">        
                            <!-- DEFAULT -->
                            <div class="flex flex-col items-center gap-4 group-hover:hidden">
                                <div class="w-20 h-20 rounded-full bg-white shadow-sm flex items-center justify-center overflow-hidden">
                                    <img src="https://image2url.com/r2/default/images/1773892303378-c86196f2-33f4-492c-9631-ba8a50c9085d.png" class="w-full h-full object-contain">
                                </div>
                                <p class="text-xs font-black text-amber-600 uppercase tracking-tighter">Ana</p>
                                <p class="text-lg font-bold text-[#2D241E]">MAAASAHAN</p>
                                <p class="text-sm text-center italic text-[#2D241E]">
                                    "Dependable. Reliable, Accessible"
                                </p>
                            </div>

                            <!-- HOVER -->
                            <div class="absolute inset-0 flex items-center justify-center px-4 text-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <p class="text-white text-sm">
                                    "As Individuals: Engage the clientele and the general public as dependable, reliable, and accessible government workers who are able, willing ang prepared to extend assistance and services to the people to advance their welfare and interests"
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- HERO HEADER -->
<section class="relative h-[40vh] md:h-[50vh] flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 z-0 bg-[#FFFAEC]">

        <!-- Background Image -->
        <img src="{{ asset('images/dilg-building.jpg') }}" 
            alt="DILG Building" 
            class="w-full h-full object-cover scale-105 transition-transform duration-1000 hover:scale-100 opacity-70 rounded-lg">

        <!-- Image Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-amber-100/30 via-[#FFFAEC]/70 to-[#FFFAEC]"></div>


        <!-- Smooth transition (GRAY, not orange) -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-gray-300/70 to-transparent"></div>
        
        <!-- Decorative Blurs -->
        <div class="absolute top-[10%] -right-[5%] w-[600px] h-[600px] bg-amber-200/30 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] -left-[10%] w-[500px] h-[500px] bg-amber-100/20 rounded-full blur-[100px] pointer-events-none"></div>
    </div>

        <!-- Content -->
        <div class="relative z-10 px-6 py-10 md:py-16 text-center">
            <!-- Accent Line -->
            <div class="w-16 h-1 bg-amber-500 mx-auto mb-6 rounded-full shadow-[0_0_15px_rgba(245,158,11,0.6)]"></div>

            <!-- Text Container -->
            <div class="bg-black/40 backdrop-blur-md border border-white/10 px-8 py-6 md:px-12 md:py-10 rounded-2xl shadow-2xl">
                <h1 class="text-3xl md:text-6xl font-extrabold uppercase tracking-widest text-white drop-shadow-lg"
                    style="font-family: 'Inter', sans-serif;">
                    LGMED <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-amber-200">Organization</span>
                </h1>

                <!-- Subtext -->
                <div class="flex items-center justify-center gap-4 mt-4">
                    <div class="h-[1px] w-12 bg-white/40"></div>
                    <span class="text-xs md:text-sm font-semibold tracking-widest text-amber-400 uppercase">DILG CAR</span>
                    <div class="h-[1px] w-12 bg-white/40"></div>
                </div>
            </div>
        </div>

        <!-- Bottom Gradient Fade -->
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-[#fcfcfc] to-transparent z-10"></div>
    </section>

    <!--SIDE BAR -->
    <section class="py-12 px-4 md:px-20 bg-[#f9f9fb]" x-data="{ activeTab: 'admin' }">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-12">
            
 
       <aside class="w-full lg:w-1/4">
            <div class="sticky top-8 space-y-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6 px-4">Division Navigation</h3>
                
                <!-- Division Chief -->
                <button @click="activeTab = 'admin'" 
                    :class="activeTab === 'admin' 
                        ? 'bg-yellow-500 text-white shadow-lg shadow-yellow-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-yellow-100 hover:text-yellow-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    <span :class="activeTab === 'admin' ? 'scale-110' : ''">⚖️</span>
                    <span>Division Chief</span>
                </button>

                <!-- Assistant -->
                <button @click="activeTab = 'assistant'" 
                    :class="activeTab === 'assistant' 
                        ? 'bg-pink-500 text-white shadow-lg shadow-pink-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-pink-100 hover:text-pink-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    <span :class="activeTab === 'assistant' ? 'scale-110' : ''">📋</span>
                    <span>Assistant Division Chief</span>
                </button>

                <!-- LG-RPCS -->
                <button @click="activeTab = 'lgrpcs'" 
                    :class="activeTab === 'lgrpcs' 
                        ? 'bg-green-500 text-white shadow-lg shadow-green-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-green-100 hover:text-green-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    <span :class="activeTab === 'lgrpcs' ? 'scale-110' : ''">📊</span>
                    <span>LG-RPCS</span>
                </button>

                <!-- LG-PMRAS -->
                <button @click="activeTab = 'lgpmras'" 
                    :class="activeTab === 'lgpmras' 
                        ? 'bg-purple-500 text-white shadow-lg shadow-purple-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-purple-100 hover:text-purple-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    <span :class="activeTab === 'lgpmras' ? 'scale-110' : ''">🤝</span>
                    <span>LG-PMRAS</span>
                </button>

                <!-- LG-POPSCM -->
                <button @click="activeTab = 'lgpopscm'" 
                    :class="activeTab === 'lgpopscm' 
                        ? 'bg-red-500 text-white shadow-lg shadow-red-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-red-100 hover:text-red-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    <span :class="activeTab === 'lgpopscm' ? 'scale-110' : ''">🛡️</span>
                    <span>LG-POPSCM</span>
                </button>

                <!-- SSU -->
                <button 
                    @click="activeTab = 'ssu'" 
                    :class="activeTab === 'ssu' 
                        ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-blue-100 hover:text-blue-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    
                    <span :class="activeTab === 'ssu' ? 'scale-110' : ''">📋</span>
                    <span>SSU</span>
                </button>

                <!-- DSU -->
                <button @click="activeTab = 'dsu'" 
                    :class="activeTab === 'dsu' 
                        ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/30 scale-[1.02]' 
                        : 'text-gray-600 hover:bg-orange-100 hover:text-orange-600'"
                    class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl font-bold transition-all duration-300 text-left">
                    
                    <span class="text-xl transition-transform duration-300" 
                        :class="activeTab === 'dsu' ? 'scale-110' : ''">📈</span>
                    
                    <span>DSU</span>
                </button>
            </div>
        </aside>

            <main class="w-full lg:w-3/4 min-h-[500px]">
                
                <!--DC-->
                <div x-show="activeTab === 'admin'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="max-w-5xl mx-auto w-full group">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.1)] overflow-hidden transition-all duration-500 hover:shadow-[0_20px_60px_-12px_rgba(0,0,0,0.15)] border border-gray-100">
                            
                            <div class="w-full md:w-1/3 relative h-[350px] md:h-auto overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-tr from-[#e2d1b1] to-[#f3e9d4]"></div>
                                
                                <img src="{{ asset('images/officer-abance.png') }}" 
                                    class="relative z-10 w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105"
                                    alt="Mary Jane S. Abance">
                                
                                <div class="absolute bottom-4 left-4 right-4 z-20 backdrop-blur-md bg-white/80 p-4 rounded-2xl shadow-lg border border-white/50">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1 leading-tight">
                                        Mary Jane S. Abance
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <span class="h-[1px] w-4 bg-amber-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-amber-700 tracking-tighter">
                                            LGOO VII • Division Chief
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-8 md:p-14 flex flex-col justify-center relative bg-gradient-to-br from-white to-[#fcfaf6]">
                                <div class="absolute top-10 right-10 opacity-[0.05] pointer-events-none">
                                    <svg width="100" height="100" viewBox="0 0 24 24" fill="currentColor" class="text-gray-900"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.154c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                                </div>

                                <div class="relative z-10">
                                    <p class="text-xl md:text-2xl text-gray-700 font-medium leading-[1.6] italic">
                                        "Provides overall supervision and guidance for the efficient implementation of all PPAs within the division."
                                    </p>
                                </div>

                                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center gap-4">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-amber-200 border-2 border-white"></div>
                                        <div class="w-8 h-8 rounded-full bg-amber-400 border-2 border-white"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 font-semibold tracking-wide uppercase">DILG LGMED Strategic Lead</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!--ADC-->
                <div x-show="activeTab === 'assistant'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="max-w-5xl mx-auto w-full group">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.1)] overflow-hidden transition-all duration-500 hover:shadow-[0_20px_60px_-12px_rgba(0,0,0,0.15)] border border-gray-100">
                            
                            <div class="w-full md:w-1/3 relative h-[350px] md:h-auto overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-tr from-[#e2d1b1] to-[#f3e9d4]"></div>
                                
                                <img src="{{ asset('images/officer-adnol.png') }}" 
                                    class="relative z-10 w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105"
                                    alt="Bable G. Adnol">
                                
                                <div class="absolute bottom-4 left-4 right-4 z-20 backdrop-blur-md bg-white/80 p-4 rounded-2xl shadow-lg border border-white/50">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1 leading-tight">
                                        Bable G. Adnol
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <span class="h-[1px] w-4 bg-amber-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-amber-700 tracking-tighter">
                                            LGOO VI • Assistant Division Chief
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-8 md:p-14 flex flex-col justify-center relative bg-gradient-to-br from-white to-[#fcfaf6]">
                                <div class="absolute top-10 right-10 opacity-[0.05] pointer-events-none">
                                    <svg width="100" height="100" viewBox="0 0 24 24" fill="currentColor" class="text-gray-900"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.154c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                                </div>

                                <div class="relative z-10">
                                    <p class="text-xl md:text-2xl text-gray-700 font-medium leading-[1.6] italic">
                                        "Assist the Division Chief in the performance of duties and functions"
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!--LG-RPCS-->
                <div class="space-y-12 py-10" x-show="activeTab === 'lgrpcs'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" >
                    <!--1-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#e9f1ed]">
                                <img src="{{ asset('images/officer-canullas.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Mary Jheama Rachine E. Canullas">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Mary Jheama Rachine E. Canullas
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-emerald-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-emerald-700 tracking-wider">
                                            LGOO V • Section Chief - LG-RPCS
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#f8faf9]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-emerald-600 uppercase bg-emerald-50 rounded-lg mb-2">
                                        LG-RPCS Division
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-emerald-200 bg-emerald-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-emerald-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5 space-y-3">
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-NBOO-RO-01: Processing of Barangay Officials’ Death and Burial Assistance (BODBA) for Fund Allocation by the Department of Budget and Management (DBM) </p>
                                                </div>
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-BLGS-RO-03: Issuance of Certificate for Foreign Travel Authority of Local Government Officials and Employees</p>
                                                </div>
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-BLGS-RO-04: Issuance of Full Disclosure Policy (FDP) Compliance Certificate</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-emerald-200 bg-emerald-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-emerald-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Transparency & Disclosure</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Full Disclosure Policy (FDP)</p>
                                                        <p>• Barangay FDP</p>
                                                        <p>• SK Full Public Disclosure Policy (FPDP)</p>
                                                        <p>• LGU Annual Report</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Local Governance & Institutional Support</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• LGU Leagues (Elections/Meetings)</p>
                                                        <p>• Barangay Assembly</p>
                                                        <p>• Bawat Barangay Makikinabang Program (BBMP)</p>
                                                    </div>
                                                </div>

                                                
                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Youth & Sectoral Programs</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• IPMR (Indigenous Peoples Mandatory Representation)</p>
                                                        <p>• NCIP-led Activities</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Other Coordination Functions</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Coordination with Regional Line Agencies (RLAs)</p>
                                                    </div>
                                                </div>

                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                    
                </div>

                <div class="space-y-12 py-10" x-show="activeTab === 'lgrpcs'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" >
                    <!--1-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#e9f1ed]">
                                <img src="{{ asset('images/officer-bumagil.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Sigfred G. Bumagil">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Sigfred G. Bumagil
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-emerald-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-emerald-700 tracking-wider">
                                            LGOO IV • Assistant Section Chief 
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#f8faf9]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-emerald-600 uppercase bg-emerald-50 rounded-lg mb-2">
                                        LG-RPCS Division
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-emerald-200 bg-emerald-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-emerald-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5 space-y-3">
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-BLGS-RO-02: Issuance of Department Authority to LGUs for the Purchase of Motor Vehicles"</p>
                                                </div>
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-BLGS-RO-06: Issuance of Certificate for Service Rendered by Local/Barangay official for Application for CSC Eligibility</p>
                                                </div>
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-emerald-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-emerald-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">QP-DILG-BLGS-RO-07: Issuance of Certificate of Incumbency of Local Officials</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-emerald-200 bg-emerald-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-emerald-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Community Programs & Initiatives</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Kalinisan sa Bagong Pilipinas Reports</p>
                                                        <p>• Barangay at Kalinisan Day (BarKaDa)</p>
                                                        <p>• Halina't Magtanim ng Gulay at Prutas (HAPAG)</p>
                                                        <p>• Barangay Road Clearing Operations (BaRCO)</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Youth & Sectoral Programs</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• SK, NYC and Youth-related PPAs</p>
                                                        <p>• Senior Citizen & Solo Parents Monitoring</p>
                                                        <p>• NCIP-led Activities</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Social Protection Programs (DSWD-led)</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• 4Ps (Pantawid Pamilyang Pilipino Program)</p>
                                                        <p>• KALAHI-CIDSS</p>
                                                        <p>• EPAHP (Enhanced Partnership Against Hunger and Poverty)</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Labor & Employment (DOLE-led)</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Kasambahay Reports</p>
                                                        <p>• First-Time Job Assistance Act (FTJAA) Beneficiaries</p>
                                                        <p>• Regional Council against Child Labor(RCACL)</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Agriculture & Health Programs</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• African Swine Fever (ASF)</p>
                                                        <p>• CPD-led Programs (Family/RPRH, Population)</p>
                                                        <p>• Regional Implementation Team(RIT) for RPRH</p>
                                                        <p>• DA-led Programs</p>
                                                    </div>
                                                </div>

                                                <div class="p-4 rounded-xl bg-white border border-emerald-100 shadow-sm">
                                                    <p class="font-bold text-xs text-emerald-800 uppercase mb-2">Other Coordination Functions</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Election-related Concerns (Non-legal)</p>
                                                        <p>• Coordination with Regional Line Agencies (RLAs)</p>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                    
                </div>

                <!--LG-POPSCM-->
                <div class="space-y-12 py-10" x-show="activeTab === 'lgpopscm'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <!--1-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#e0e7ff]">
                                <img src="{{ asset('images/officer-geron1.jpg') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Lala G. Geron">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Lala G. Geron
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-indigo-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-indigo-700 tracking-wider">
                                            LGOO V • OIC Section Chief - LG-POPSCM
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#f5f7ff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-indigo-600 uppercase bg-indigo-50 rounded-lg mb-2">
                                        LG-POPSCM 
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP-DILG-BLGS-RO-05:</span>
                                                        Issuance of Department Authorization to Utilize Additional Confidential Funds of LGUs
                                                    </p>
                                                </div>
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP 43 Lupong Tagapamayapa Incentives Awards (LTIA)</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Katarungang Pambarangay (KP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> KP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> LTIA Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Comprehensive Social Benefits Program (CSBP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> CSBP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Facilitate Assistance</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Local Legislative Awards (LLA)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Anti-Illegal Drugs</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Anti-Drug Abuse Councils (ADAC) Functionality Audit</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Adjudication Committee (RAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Philippine Anti-Drugs Strategy (PADS)-related PPAS:
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Inter-Agency Committee on Anti-Illegal Drugs (ICAD) - ICAD Advocacy Cluster</li>
                                                                    <li class="text-[11px] text-gray-600">Buhay Ingatan, Droga'y Ayawan (BIDA)</li>
                                                                    <li class="text-[11px] text-gray-600">Special Drug Education Center (SDEC)</li>
                                                                    <li class="text-[11px] text-gray-600">Community-Based Drug Rehabilitation Program (CBDRP)</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Peace and Order</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Peace and Order Council (RPOC)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">POC Audit</li>
                                                                    <li class="text-[11px] text-gray-600">CSO Security Clearance</li>
                                                                    <li class="text-[11px] text-gray-600">POPS-PCMS</li>
                                                                    <li class="text-[11px] text-gray-600">Firecrackers People's Law Enforcement Board (PLEB)</li>
                                                                </ul>
                                                        </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> NTF/RTF ELCAC related activities
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">C4PEACE-CUCPD</li>
                                                                    <li class="text-[11px] text-gray-600">Retooled Community Support Program (Monitoring and Evaluation)</li>
                                                                    <li class="text-[11px] text-gray-600">Support to RTF-ELCAC and LEO 70</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Preventing and Countering Violent Extremism and Insurgency (PCVE)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Enhanced Comprehensive Local Integration Program (ECLIP)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Provision of DILG Assistance Package</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Human Rights Action Center (HRAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> POGO Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Cockpit and Cockfighting Monitoring</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->

                    <!--2-->
                    <!-- <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-baisa.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Princes A. Baisa">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Princes A. Baisa
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-indigo-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-indigo-600 tracking-wider">
                                            LGOO IV • Assistant Section Chief
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-indigo-500 uppercase bg-indigo-50 rounded-lg mb-2">
                                        LG-POPSCM
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP-DILG-BLGS-RO-05:</span>
                                                        Issuance of Department Authorization to Utilize Additional Confidential Funds of LGUs
                                                    </p>
                                                </div>
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP 43 Lupong Tagapamayapa Incentives Awards (LTIA)</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Katarungang Pambarangay (KP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> KP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> LTIA Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Comprehensive Social Benefits Program (CSBP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> CSBP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Facilitate Assistance</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Local Legislative Awards (LLA)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Anti-Illegal Drugs</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Anti-Drug Abuse Councils (ADAC) Functionality Audit</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Adjudication Committee (RAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Philippine Anti-Drugs Strategy (PADS)-related PPAS:
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Inter-Agency Committee on Anti-Illegal Drugs (ICAD) - ICAD Advocacy Cluster</li>
                                                                    <li class="text-[11px] text-gray-600">Buhay Ingatan, Droga'y Ayawan (BIDA)</li>
                                                                    <li class="text-[11px] text-gray-600">Special Drug Education Center (SDEC)</li>
                                                                    <li class="text-[11px] text-gray-600">Community-Based Drug Rehabilitation Program (CBDRP)</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Peace and Order</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Peace and Order Council (RPOC)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">POC Audit</li>
                                                                    <li class="text-[11px] text-gray-600">CSO Security Clearance</li>
                                                                    <li class="text-[11px] text-gray-600">POPS-PCMS</li>
                                                                    <li class="text-[11px] text-gray-600">Firecrackers People's Law Enforcement Board (PLEB)</li>
                                                                </ul>
                                                        </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> NTF/RTF ELCAC related activities
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">C4PEACE-CUCPD</li>
                                                                    <li class="text-[11px] text-gray-600">Retooled Community Support Program (Monitoring and Evaluation)</li>
                                                                    <li class="text-[11px] text-gray-600">Support to RTF-ELCAC and LEO 70</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Preventing and Countering Violent Extremism and Insurgency (PCVE)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Enhanced Comprehensive Local Integration Program (ECLIP)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Provision of DILG Assistance Package</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Human Rights Action Center (HRAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> POGO Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Cockpit and Cockfighting Monitoring</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--end-->
                    <!--3-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-gunday.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Nikko May L. Gunday">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Nikko May L. Gunday
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-indigo-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-indigo-600 tracking-wider">
                                            ADAC RTA
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-indigo-500 uppercase bg-indigo-50 rounded-lg mb-2">
                                        LG-POPSCM
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP-DILG-BLGS-RO-05:</span>
                                                        Issuance of Department Authorization to Utilize Additional Confidential Funds of LGUs
                                                    </p>
                                                </div>
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">QP 43 Lupong Tagapamayapa Incentives Awards (LTIA)</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Katarungang Pambarangay (KP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> KP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> LTIA Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Comprehensive Social Benefits Program (CSBP)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> CSBP Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Facilitate Assistance</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Local Legislative Awards (LLA)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Assessment</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Anti-Illegal Drugs</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Anti-Drug Abuse Councils (ADAC) Functionality Audit</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Adjudication Committee (RAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Philippine Anti-Drugs Strategy (PADS)-related PPAS:
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Inter-Agency Committee on Anti-Illegal Drugs (ICAD) - ICAD Advocacy Cluster</li>
                                                                    <li class="text-[11px] text-gray-600">Buhay Ingatan, Droga'y Ayawan (BIDA)</li>
                                                                    <li class="text-[11px] text-gray-600">Special Drug Education Center (SDEC)</li>
                                                                    <li class="text-[11px] text-gray-600">Community-Based Drug Rehabilitation Program (CBDRP)</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">Peace and Order</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Regional Peace and Order Council (RPOC)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">POC Audit</li>
                                                                    <li class="text-[11px] text-gray-600">CSO Security Clearance</li>
                                                                    <li class="text-[11px] text-gray-600">POPS-PCMS</li>
                                                                    <li class="text-[11px] text-gray-600">Firecrackers People's Law Enforcement Board (PLEB)</li>
                                                                </ul>
                                                        </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> NTF/RTF ELCAC related activities
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">C4PEACE-CUCPD</li>
                                                                    <li class="text-[11px] text-gray-600">Retooled Community Support Program (Monitoring and Evaluation)</li>
                                                                    <li class="text-[11px] text-gray-600">Support to RTF-ELCAC and LEO 70</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Preventing and Countering Violent Extremism and Insurgency (PCVE)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Enhanced Comprehensive Local Integration Program (ECLIP)
                                                                <ul class="list-disc list-inside ml-4">
                                                                    <li class="text-[11px] text-gray-600">Provision of DILG Assistance Package</li>
                                                                </ul>
                                                            </li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Human Rights Action Center (HRAC)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> POGO Report</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> Cockpit and Cockfighting Monitoring</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->

                    <!--4-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-cornelio.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Angelo H. Cornelio">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Angelo H. Cornelio
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-indigo-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-indigo-600 tracking-wider">
                                            PEO II • Service Support Staff
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-indigo-500 uppercase bg-indigo-50 rounded-lg mb-2">
                                        LG-POPSCM
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">To be Updated</span>
                                                        To be Updated
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">To be Updated</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> To be Updated</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->

                    <!--5-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-gallamos.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Matt Andrei C. Gallamos">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Matt Andrei C. Gallamos
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-indigo-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-indigo-600 tracking-wider">
                                            PEO I • Service Support Staff
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-indigo-500 uppercase bg-indigo-50 rounded-lg mb-2">
                                        LG-POPSCM
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-indigo-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-indigo-900 font-bold mb-1 uppercase text-[10px]">To be Updated:</span>
                                                        To be Updated
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-indigo-200 bg-indigo-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-indigo-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-indigo-100">
                                                        <p class="text-[10px] font-black text-indigo-600 uppercase mb-2">To be Updated</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-indigo-300 rounded-full"></span> To be Updated</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                </div>

                <!--LG-PMRAS-->
                <div class="space-y-12 py-10" x-show="activeTab === 'lgpmras'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <!--1-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-ocal.jpg') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Allan F. Ocal">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Allan F. Ocal
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-red-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-red-600 tracking-wider">
                                            LGOO V • Section Chief - LG-PMRAS
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-red-500 uppercase bg-red-50 rounded-lg mb-2">
                                        LG-PMRAS Division
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-red-200 bg-red-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-red-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-red-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-red-900 font-bold mb-1 uppercase text-[10px]">QP-DILG-BLGS-44:</span>
                                                        Seal of Good Local Governance (SGLG) Assessment
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-red-200 bg-red-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-red-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Citizen Satisfaction Index System (CSIS)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">LGU Performance-Based Bonus</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Seal of Good Local Governance (SGLG)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">SGLGB</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Persons With Disability / PDAO</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Gender-Based Violence</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">VAW Desk</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">MAKABATA</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Local Committee on (LCAT-VAWC) Functionality Audit Anti-Trafficking</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Local Health Boards(LHB)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Regional Inter-Agency on Anti-Trafficking and Violence Against Women and Their Children (RCAT-VAWC)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Regional Committee on Disability Affairs (RCDA)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Regional Coordination Committee National Tuberculosis Program (RCC-NTB)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Child-Friendly</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Cordillera Council of Good Local Governance (CCGLG)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Child-Friendly Local Government Audit (CFLGA)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Juvenile Justice and Welfare related PPAS (CAR, CICL, CLJIP, RA 9344)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Local Council on the Protection of Children (CPC) Functionality Assessment</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Regional Sub-Committee for the Welfare of Children (RSCWC)</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">DOH and NNC led</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->

                    <!--2-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f5f3ff]">
                                <img src="{{ asset('images/officer-pacis.png') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Alex Ian A. Pacis">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Alex Ian A. Pacis
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-red-500"></span>
                                        <p class="text-[10px] font-bold uppercase text-red-600 tracking-wider">
                                            LGOO IV • Assistant Section Chief
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafaff]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-red-500 uppercase bg-red-50 rounded-lg mb-2">
                                        LG-PMRAS
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-red-200 bg-red-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">QMS Process Owner</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-red-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5">
                                                <div class="flex items-start gap-3 p-4 bg-white rounded-xl border border-red-100 shadow-sm">
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                                        <span class="block text-red-900 font-bold mb-1 uppercase text-[10px]">To be update:</span>
                                                        To be update
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-red-200 bg-red-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Regional Focal Person</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-red-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Child-Friendly Local Government Audit (CFLGA)</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Juvenile Justice and Welfare related PPAS (CAR, CICL, CLJIP, RA 9344)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Local Council on the Protection of Children (CPC) Functionality Assessment</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> Regional Sub-Committee for the Welfare of Children (RSCWC)</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Local Government Unit Support System</p>
                                                        <ul class="space-y-1">
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> CMIMS (Cities and Municipalities Information Management System)</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> DMS4LGUs</li>
                                                            <li class="text-[11px] text-gray-600 flex items-center gap-2"><span class="w-1 h-1 bg-red-300 rounded-full"></span> BIMS (Barangay Information Management System)</li>
                                                        </ul>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Seal of Good Local Governance for Barangay (SGLGB)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Local Council on the Protection of Children (LCPC) Functionality Assessment</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Regional Public Finance for Children (PF4C) (CBETT)</p>
                                                    </div>
                                                    
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">MAKABATA, NAtional Children's Month</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Cordillera Regional Council for Mental Health</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">BHERT</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">MELLPI Pro</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Philippine Plan of Action for nutrition (PPAN)</p>
                                                    </div>
                                                    <div class="p-3 bg-white rounded-xl border border-red-100">
                                                        <p class="text-[10px] font-black text-red-600 uppercase mb-2">Regional Bantay Asin Task Force</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                </div>
                <!--SSU-->
                <div>
                    <div x-show="activeTab === 'ssu'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                            <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                                
                                <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f4f1ea]">
                                    <img src="{{ asset('images/officer-gonzales.png') }}" 
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                        alt="Marlene C. Gonzales">
                                    
                                    <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50">
                                        <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                            Marlene C. Gonzales
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <span class="h-[2px] w-6 bg-amber-600"></span>
                                            <p class="text-[10px] font-bold uppercase text-amber-700 tracking-wider">
                                                AA VI • Records Officer
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#fafafa]">
                                    <div class="mb-8">
                                        <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-amber-600 uppercase bg-amber-50 rounded-lg mb-2">
                                            Administrative Core
                                        </span>
                                        <h3 class="text-2xl font-black text-gray-800 tracking-tight mb-6">Responsibilities</h3>
                                        
                                        <ul class="space-y-4">
                                            <li class="flex items-start gap-4 text-gray-700">
                                                <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></div>
                                                <p class="text-md font-medium">Monitors submission of Administrative Requirements</p>
                                            </li>
                                            <li class="flex items-start gap-4 text-gray-700">
                                                <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></div>
                                                <p class="text-md font-medium">Records Management</p>
                                            </li>
                                            <li class="flex items-start gap-4 text-gray-700">
                                                <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></div>
                                                <p class="text-md font-medium">Inventory / Supplies / Properties</p>
                                            </li>
                                            <li class="flex items-start gap-4 text-gray-700">
                                                <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></div>
                                                <p class="text-md font-medium">Take minutes of Division and SPMS meetings</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--DSU-->
                    <div x-show="activeTab === 'dsu'" 
     x-transition:enter="transition ease-out duration-500" 
     x-transition:enter-start="opacity-0 translate-y-4" 
     x-transition:enter-end="opacity-100 translate-y-0"
     class="space-y-8">

    <!-- 1 -->
    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
            
            <!-- IMAGE -->
            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-orange-50">
                <img src="{{ asset('images/officer-palaruan.png') }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                     alt="Jhosua Philip A. Palaruan">
                
                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50">
                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                        Jhosua Philip A. Palaruan
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="h-[2px] w-6 bg-orange-600"></span>
                        <p class="text-[10px] font-bold uppercase text-orange-700 tracking-wider">
                            Stat II • Unit Chief
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-orange-50/20">
                <div class="mb-8">
                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-orange-600 uppercase bg-orange-50 rounded-lg mb-2">
                        Database & Statistics Unit
                    </span>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">
                        Responsibilities
                    </h3>
                </div>

                <div class="space-y-4">

                    <!-- QMS -->
                    <div class="rounded-2xl border transition-all duration-300" 
                        :class="openSection === 1 ? 'border-orange-200 bg-orange-50 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                        
                        <button @click="openSection = openSection === 1 ? null : 1"
                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">
                                QMS Process Owner
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                 :class="{'rotate-180 text-orange-600': openSection === 1}" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="openSection === 1" x-collapse>
                            <div class="px-6 pb-6 space-y-3">
                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-NBOO-RO-01:</span> 
                                        Processing of Barangay Officials Death and Burial Assistance (BODBA) for Fund Allocation by the Department of Budget and Management (DBM)
                                    </p>
                                </div>

                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-BLGS-RO-06:</span> 
                                        Issuance of Certificate for Service Rendered by Local/Barangay official for Application for CSC Eligibility
                                    </p>
                                </div>

                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-BLGS-RO-07:</span> 
                                        Issuance of Certificate of Incumbency of Local Officials
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Regional -->
                    <div class="rounded-2xl border transition-all duration-300" 
                        :class="openSection === 2 ? 'border-orange-200 bg-orange-50 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                        
                        <button @click="openSection = openSection === 2 ? null : 2"
                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">
                                Regional Focal Person
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                 :class="{'rotate-180 text-orange-600': openSection === 2}" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="openSection === 2" x-collapse>
                            <div class="px-6 pb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    <div class="p-4 rounded-xl bg-white border border-orange-100 shadow-sm">
                                        <p class="font-bold text-xs text-orange-800 uppercase mb-2">
                                            Analysis & Monitoring
                                        </p>
                                        <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                            <p>• Designate Division QMS Secretariat</p>
                                            <p>• Masterlisting (BIS and ELOPDS)</p>
                                            <p>• Data analysis on functional/audit results, and others</p>
                                            <p>• Monitoring Report on the Accreditation and Representation of Barangay-Based CSOs/NGOs</p>
                                        </div>
                                    </div>

                                    <div class="p-4 rounded-xl bg-white border border-orange-100 shadow-sm">
                                        <p class="font-bold text-xs text-orange-800 uppercase mb-2">
                                            Other Barangay Certification
                                        </p>
                                        <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                            <p>• Submission of Relevant Data related to the Issuance of Barangay Certification/Barangay Certificate of Residency for Purposes of Voters Registration or Transfer of Registration</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- 2 -->
    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
            
            <!-- IMAGE -->
            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-orange-50">
                <img src="{{ asset('images/officer-kimayong.png') }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                     alt="Jan Mikhail P. Kimayong">
                
                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50">
                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                        Jan Mikhail P. Kimayong
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="h-[2px] w-6 bg-orange-600"></span>
                        <p class="text-[10px] font-bold uppercase text-orange-700 tracking-wider">
                            Stat I • Assistant Unit Chief
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-orange-50/20">
                <div class="mb-8">
                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-orange-600 uppercase bg-orange-50 rounded-lg mb-2">
                        Database & Statistics Unit
                    </span>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">
                        Responsibilities
                    </h3>
                </div>

                <div class="space-y-4">

                    <!-- QMS -->
                    <div class="rounded-2xl border transition-all duration-300" 
                        :class="openSection === 1 ? 'border-orange-200 bg-orange-50 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                        
                        <button @click="openSection = openSection === 1 ? null : 1"
                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">
                                QMS Process Owner
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                 :class="{'rotate-180 text-orange-600': openSection === 1}" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="openSection === 1" x-collapse>
                            <div class="px-6 pb-6 space-y-3">
                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-NBOO-RO-01:</span> 
                                        Processing of Barangay Officials Death and Burial Assistance (BODBA) for Fund Allocation by the Department of Budget and Management (DBM)
                                    </p>
                                </div>

                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-BLGS-RO-06:</span> 
                                        Issuance of Certificate for Service Rendered by Local/Barangay official for Application for CSC Eligibility
                                    </p>
                                </div>

                                <div class="p-4 bg-white rounded-xl border border-orange-100 flex gap-3">
                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                                    <p class="text-xs text-gray-600 font-medium">
                                        <span class="font-bold text-orange-700">QP-DILG-BLGS-RO-07:</span> 
                                        Issuance of Certificate of Incumbency of Local Officials
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Regional -->
                    <div class="rounded-2xl border transition-all duration-300" 
                        :class="openSection === 2 ? 'border-orange-200 bg-orange-50 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                        
                        <button @click="openSection = openSection === 2 ? null : 2"
                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">
                                Regional Focal Person
                            </span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" 
                                 :class="{'rotate-180 text-orange-600': openSection === 2}" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="openSection === 2" x-collapse>
                            <div class="px-6 pb-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    <div class="p-4 rounded-xl bg-white border border-orange-100 shadow-sm">
                                        <p class="font-bold text-xs text-orange-800 uppercase mb-2">
                                            Analysis & Monitoring
                                        </p>
                                        <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                            <p>• Designate Division QMS Secretariat</p>
                                            <p>• Masterlisting (BIS and ELOPDS)</p>
                                            <p>• Data analysis on functional/audit results, and others</p>
                                            <p>• Monitoring Report on the Accreditation and Representation of Barangay-Based CSOs/NGOs</p>
                                        </div>
                                    </div>

                                    <div class="p-4 rounded-xl bg-white border border-orange-100 shadow-sm">
                                        <p class="font-bold text-xs text-orange-800 uppercase mb-2">
                                            Other Barangay Certification
                                        </p>
                                        <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                            <p>• Submission of Relevant Data related to the Issuance of Barangay Certification/Barangay Certificate of Residency for Purposes of Voters Registration or Transfer of Registration</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--NEW DIVISION TEMPLATE-->
                <div class="space-y-12 py-10" x-show="activeTab === 'newdivision'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" >
                    <!--1-->
                    <div class="max-w-5xl mx-auto w-full group" x-data="{ openSection: null }">
                        <div class="relative flex flex-col md:flex-row bg-white rounded-[2rem] shadow-[0_10px_50px_-12px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 transition-all duration-500 hover:shadow-2xl">
                            
                            <div class="w-full md:w-1/3 relative h-[400px] md:h-auto overflow-hidden bg-[#f0f4f8]">
                                <img src="{{ asset('images/officer-placeholder.jpg') }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Officer Name">
                                
                                <div class="absolute bottom-6 left-6 right-6 backdrop-blur-md bg-white/90 p-5 rounded-2xl shadow-xl border border-white/50 text-center md:text-left">
                                    <p class="font-black uppercase text-sm tracking-widest text-gray-900 mb-1">
                                        Officer Name
                                    </p>
                                    <div class="flex items-center justify-center md:justify-start gap-2">
                                        <span class="h-[2px] w-6 bg-blue-600"></span>
                                        <p class="text-[10px] font-bold uppercase text-blue-700 tracking-wider">
                                            Position Title • Section Chief - Division Name
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-2/3 p-6 md:p-10 bg-gradient-to-br from-white to-[#f8faf9]">
                                <div class="mb-6">
                                    <span class="inline-block px-3 py-1 text-[10px] font-bold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-lg mb-2">
                                        Division Name
                                    </span>
                                    <h3 class="text-2xl font-black text-gray-800 tracking-tight">Responsibilities</h3>
                                </div>

                                <div class="space-y-3">
                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 1 ? 'border-blue-200 bg-blue-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 1 ? null : 1"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Responsibility Area 1</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-blue-600': openSection === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 1" x-collapse>
                                            <div class="px-6 pb-5 space-y-3">
                                                <!-- Content will go here -->
                                                <div class="flex items-start gap-3 p-3 bg-white rounded-xl border border-blue-100">
                                                    <span class="mt-1 w-1.5 h-1.5 rounded-full bg-blue-400 shrink-0"></span>
                                                    <p class="text-xs text-gray-600 leading-relaxed font-medium">Responsibility description placeholder</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border transition-all duration-300" 
                                        :class="openSection === 2 ? 'border-blue-200 bg-blue-50/30 shadow-sm' : 'border-gray-100 bg-white hover:border-gray-200'">
                                        <button @click="openSection = openSection === 2 ? null : 2"
                                                class="w-full flex justify-between items-center px-6 py-4 text-left">
                                            <span class="font-bold text-gray-700 uppercase text-xs tracking-widest">Responsibility Area 2</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{'rotate-180 text-blue-600': openSection === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="openSection === 2" x-collapse>
                                            <div class="px-6 pb-6">
                                                <!-- Content will go here -->
                                                <div class="p-4 rounded-xl bg-white border border-blue-100 shadow-sm">
                                                    <p class="font-bold text-xs text-blue-800 uppercase mb-2">Category Name</p>
                                                    <div class="space-y-1 text-[11px] text-gray-500 font-medium">
                                                        <p>• Item placeholder</p>
                                                        <p>• Item placeholder</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end-->
                    
                </div>

            </div>
        </div>
    </div>

</div>

            </div>

            </main>
        </div>
    </section>
    </div>

</main>

<script>
    let mybutton = document.getElementById("myBtn");

    window.onscroll = function() { scrollFunction(); };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>


</x-guest-layout>