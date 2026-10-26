<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="icon" href="{{ asset('lgmed-compass.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('lgmed-compass.png') }}">
<link rel="apple-touch-icon" href="{{ asset('lgmed-compass.png') }}">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')

<style @nonce>   

:root{
    --topbar-height:60px;
    --sidebar-collapsed-width:80px;
    --sidebar-expanded-width:280px;
    --transition:all .3s cubic-bezier(.4,0,.2,1);
}

/* ================================
   SIDEBAR OVERLAY (MOBILE)
================================ */

.sidebar-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.4);
    z-index:1000;
    opacity:0;
    visibility:hidden;
    transition:var(--transition);
}

body.sidebar-open .sidebar-overlay{
    opacity:1;
    visibility:visible;
}

/* ================================
   PAGE HEADER
================================ */

.app-page-heading{

    font-family:'Inter',sans-serif;

    margin-top:var(--topbar-height);
    margin-left:var(--sidebar-collapsed-width);

    border-bottom:1px solid #e5e7eb;

    transition:margin-left .3s ease;

    box-shadow:none !important;
}

/* ================================
   PAGE CONTENT
================================ */

.app-page-content{

    font-family:'Inter',sans-serif;
     margin-top:var(--topbar-height); 
    margin-left:var(--sidebar-collapsed-width);

    padding:1.5rem;

    min-height:calc(100vh - var(--topbar-height));

    background:#f8fafc;

    transition:margin-left .3s ease;

    box-shadow:none !important;
}

/* ================================
   WHEN SIDEBAR EXPANDS
================================ */

body.sidebar-open .app-page-heading,
body.has-sidebar:not(.sidebar-collapsed) .app-page-heading{
    margin-left:var(--sidebar-expanded-width);
}

body.sidebar-open .app-page-content,
body.has-sidebar:not(.sidebar-collapsed) .app-page-content{
    margin-left:var(--sidebar-expanded-width);
}
/* ================================
   LOADING SCREEN
================================ */
#loading-screen {
    position: fixed;
    inset: 0;
    background: rgba(255, 255, 255, 0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
}

.loading-content {
    display: flex;           /* make it flex */
    flex-direction: column;  /* stack logo, spinner, text */
    align-items: center;     /* center horizontally */
    justify-content: center; /* center vertically inside loading content */
    gap: 15px;               /* spacing between logo, spinner, and text */
    text-align: center;
}

.loading-logo {
    width: 100px;
    margin-bottom: 20px;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #0d6efd;
    border-radius: 50%;
    animation: layout-loader-spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes layout-loader-spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
/* ================================
   MOBILE
================================ */

@media(max-width:768px){

    .app-page-heading,
    .app-page-content{
        margin-left:0 !important;
    }

}

</style>

</head>
<!-- Global Flash Messages -->
@if(session('error'))
    <div id="globalErrorToast" class="fixed top-6 right-6 z-[9999] w-96 max-w-full p-4 rounded-lg border-l-4 border-red-600 bg-white shadow-xl flex items-start gap-3">
        <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
        </svg>
        <div class="text-red-800 text-sm">{{ session('error') }}</div>
        <button class="ml-auto text-red-600 font-bold toast-close">×</button>
    </div>
@endif

@if(session('status'))
<button class="ml-auto text-green-600 font-bold toast-close">×</button>       
 <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
        <span class="text-green-800 text-sm font-medium">{{ session('status') }}</span>
        <button onclick="closeGlobalSuccessToast()" class="ml-auto text-green-600 font-bold">×</button>
    </div>
@endif
<body
    class="font-sans antialiased app-shell {{ auth()->check() ? 'has-sidebar sidebar-collapsed' : '' }}"
    data-loading-delay="{{ request()->routeIs('documents.my-tasks') ? 1200 : 800 }}"
>
<!-- ================================
     LOADING SCREEN
================================ -->
<div id="loading-screen">
    <div class="loading-content">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg/250px-Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg.png"
        class="loading-logo">
        <div class="loading-spinner"></div>
        <p>Loading LGMED Compass...</p>
    </div>
</div>
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>

<div class="min-h-screen bg-gray-100 ">

    @auth
        @include('layouts.navigation')
    @endauth

    @isset($header)
    <header class="bg-white app-page-heading">
        <div class="max-w-7xl mx-auto py-4 px-6">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main class="app-page-content">
        {{ $slot }}
    </main>

</div>

@stack('scripts')
@stack('modals')

</body>
</html>
