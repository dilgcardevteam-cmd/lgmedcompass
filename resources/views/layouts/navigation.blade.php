<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LGMED Compass') }}</title>

    <link rel="stylesheet" href="{{ asset('css/plus-jakarta-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/unicons/line.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Your existing CSS – unchanged, keep it exactly as before */
        :root {
            --topbar-height: 72px;
            --sidebar-collapsed-width: 88px;
            --sidebar-expanded-width: 280px;
            --brand-primary: #f7d114;
            --brand-light: #fef9ec;
            --brand-dark: #b68d40;
            --slate-900: #0f172a;
            --slate-600: #475569;
            --bg-main: #f8fafc;
            --transition-smooth: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.02), 0 1px 0 rgba(0,0,0,0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.06), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--bg-main); color: var(--slate-900); -webkit-font-smoothing: antialiased; }

        /* ===== TOPBAR ===== */
        .topbar {
            height: var(--topbar-height);
            background: #1E3A8A;
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 2000;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .topbar .left { display: flex; align-items: center; gap: 24px; }

        .institutional-logos {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-right: 24px;
            position: relative;
        }
        .institutional-logos::after {
            content: '';
            position: absolute;
            right: 0; top: 20%; height: 60%;
            width: 1px; background: rgba(0,0,0,0.08);
        }
        .inst-logo { height: 38px; width: auto; transition: var(--transition-smooth); }
        .inst-logo:hover { transform: scale(1.05); }

        .brand-main-text {
            font-weight: 900;
            font-size: 1.5rem;
            letter-spacing: -0.04em;
            color: #fff;
            text-transform: uppercase;
            line-height: 1;
        }

        .brand-highlight {
            color:#f7d114;
            font-weight: 900;
        }

        .brand-sub-text {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            line-height: 1;
            margin-top: 6px;
        }

        /* ===== BUTTONS & CAPSULES ===== */
        .action-btn-pill {
            height: 42px; width: 42px;
            font-size: 18px;
            cursor: pointer;
            color: #000;
            border-radius: 12px;
            background: rgba(255,255,255,0.25);
            border: 1px solid rgba(255,255,255,0.3);
            transition: var(--transition-smooth);
            display: flex; align-items: center; justify-content: center;
        }
        .action-btn-pill:hover {
            background: #fff;
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .user-profile-capsule {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.9);
            padding: 6px 16px 6px 6px;
            border-radius: 14px;
            text-decoration: none;
            transition: var(--transition-smooth);
            border: 1px solid rgba(255, 255, 255, 0.5);
            max-height: 48px;
        }
        .user-profile-capsule:hover {
            background: #fff;
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        .avatar-squircle {
            height: 36px; width: 36px;
            background: var(--slate-900); color: var(--brand-primary);
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px; font-size: 14px; font-weight: 800;
        }
        .user-name-label { font-size: 13px; font-weight: 700; color: var(--slate-900); }
        .user-section-label { font-size: 9px; font-weight: 700; color: var(--slate-600); letter-spacing: 0.05em; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            height: calc(100vh - var(--topbar-height));
            width: var(--sidebar-collapsed-width);
            background: #fff;
            z-index: 1500;
            border-right: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition-smooth);
            padding-top: 20px;
        }
        body.sidebar-open .sidebar { width: var(--sidebar-expanded-width); }
        .item {
            display: flex; align-items: center; height: 52px;
            margin: 4px 14px;
            text-decoration: none; color: var(--slate-600);
            border-radius: 14px; transition: var(--transition-smooth);
            position: relative;
        }
        .item i {
            font-size: 20px;
            min-width: calc(var(--sidebar-collapsed-width) - 28px);
            display: flex; align-items: center; justify-content: center;
        }
        .item .item-logo {
            width: 20px;
            height: 20px;
            min-width: calc(var(--sidebar-collapsed-width) - 28px);
            object-fit: contain;
        }
        .item span { font-size: 14px; font-weight: 600; opacity: 0; margin-left: 4px; transition: opacity 0.2s; }
        body.sidebar-open .item span { opacity: 1; }
        .item:hover { background: var(--brand-light); color: var(--brand-dark); }
        .item.active {
            background: #FACA19;
            color: #000;
            box-shadow: 0 8px 20px -6px rgba(246, 199, 111, 0.6);
        }
        body:not(.sidebar-open) .item:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%; margin-left: 20px;
            background: var(--slate-900); color: #fff;
            padding: 6px 12px; border-radius: 6px; font-size: 12px;
            white-space: nowrap; pointer-events: none;
            z-index: 1600;
        }
        .sidebar-divider {
            margin: 12px 28px;
            border-top: 1px solid rgba(15, 23, 42, 0.12);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-top: var(--topbar-height);
            margin-left: var(--sidebar-collapsed-width);
            padding: 40px;
            transition: var(--transition-smooth);
        }
        body.sidebar-open .main-content { margin-left: var(--sidebar-expanded-width); }

        /* ===== NOTIFICATION DROPDOWN & MODAL ===== */
        #notifDropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 300px;
            max-height: 480px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(0,0,0,0.05);
            z-index: 3000;
            display: flex;
            flex-direction: column;
        }
        /* Custom hide class for dropdown */
        #notifDropdown.notif-closed {
            display: none !important;
        }
        /* The scrollable area - header stays fixed, content scrolls */
        #notifScrollArea {
            flex: 1;
            overflow-y: auto;
            min-height: 0;
            border-radius: 0 0 20px 20px;
        }

        /* Add this to ensure the header looks clean */
        #notifDropdown > .px-5.py-4.bg-gray-50 {
            flex-shrink: 0;
            border-radius: 20px 20px 0 0;
        }
        .notif-dot {
            position: absolute;
            top: 10px;
            right: 10px;
            height: 10px;
            width: 10px;
            background-color: #ef4444;
            border-radius: 50%;
            border: 2px solid var(--brand-primary);
        }

        /* ===== TOAST NOTIFICATION STYLES ===== */
        .toast-container {
            position: fixed;
            top: 88px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            pointer-events: none;
            max-width: 380px;
        }

        .toast-clear-toolbar {
            display: flex;
            justify-content: flex-end;
            pointer-events: none;
        }

        .toast-clear-all {
            display: inline-flex;
            width: 34px;
            height: 34px;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 9999px;
            background: rgba(30, 41, 59, 0.96);
            color: #fff;
            cursor: pointer;
            pointer-events: auto;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .toast-clear-all:hover {
            background: #fff;
            color: #1e293b;
        }
        
        .toast-message.stagger-1 {
            animation-delay: 0s;
        }
        
        .toast-message.stagger-2 {
            animation-delay: 0.5s;
        }
        
        .toast-message.stagger-3 {
            animation-delay: 1s;
        }
        
        .toast-message.stagger-4 {
            animation-delay: 1.5s;
        }
        
        .toast-message.stagger-5 {
            animation-delay: 2s;
        }
        .toast-message {
            pointer-events: auto;
            background: #1e293b;
            backdrop-filter: blur(16px);
            background: rgba(30, 41, 59, 0.96);
            border-left: 6px solid var(--brand-primary);
            border-radius: 20px;
            padding: 14px 18px;
            min-width: 280px;
            max-width: 380px;
            box-shadow: 0 20px 35px -12px rgba(0,0,0,0.3);
            display: flex;
            gap: 14px;
            align-items: flex-start;
            transform: translateX(420px);
            animation: slideInToast 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
            transition: all 0.2s;
        }
        .toast-message.removing {
            animation: slideOutToast 0.25s ease-in forwards;
        }
        @keyframes slideInToast {
            to { transform: translateX(0); }
        }
        @keyframes slideOutToast {
            to { transform: translateX(420px); opacity: 0; }
        }
        .toast-icon {
            font-size: 22px;
            color: var(--brand-primary);
            flex-shrink: 0;
        }
        .toast-content {
            flex: 1;
        }
        .toast-title {
            font-weight: 800;
            font-size: 0.9rem;
            letter-spacing: -0.2px;
            color: white;
            margin-bottom: 4px;
        }
        .toast-text {
            font-size: 0.75rem;
            color: #cbd5e1;
            line-height: 1.4;
        }
        .toast-close {
            background: rgba(255,255,255,0.1);
            border: none;
            color: #94a3b8;
            cursor: pointer;
            border-radius: 30px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: 0.2s;
        }
        .toast-close:hover { background: rgba(255,255,255,0.2); color: white; }

        /* Dismiss button inside dropdown */
        .dismiss-event-btn {
            opacity: 0;
            transition: opacity 0.2s;
        }
        .group:hover .dismiss-event-btn {
            opacity: 1;
        }

        /* ... keep the rest of your modal styles ... */
        /* Mobile Devices (320px - 767px) */
        @media (max-width:767px) {
            .institutional-logos, .brand-text-group { display: none; }
            .sidebar { transform: translateX(-100%); }
            body.sidebar-open .sidebar { transform: translateX(0); width: 280px; }
            .main-content { margin-left: 0 !important; padding: 20px; }
            
            /* Notification dropdown mobile styles */
            #notifDropdown { 
                width: calc(100vw - 24px); 
                right: -12px; 
                left: 12px;
                max-width: 400px;
                max-height: 70vh; /* Limit height on mobile */
                margin: 0 auto;
                border-radius: 16px;
            }
            #notifDropdown .px-5 { padding-left: 16px !important; padding-right: 16px !important; }
            #notifDropdown .py-4 { padding-top: 12px !important; padding-bottom: 12px !important; }
            #notifDropdown .py-3 { padding-top: 10px !important; padding-bottom: 10px !important; }
            #notifDropdown .max-h-80 { max-height: 60vh; }
            #notifDropdown .max-h-48 { max-height: 40vh; }
            
            .toast-container { top: 76px; right: 12px; left: 12px; max-width: calc(100vw - 24px); }
            .toast-message { min-width: 260px; max-width: calc(100vw - 40px); }
            .detail-row { flex-wrap: wrap; gap: 6px; }
            .detail-label { width: 100%; }
        }

        /* Tablet Devices (768px - 1023px) */
        @media (min-width:768px) and (max-width:1023px) {
            .institutional-logos { display: none; }
            .sidebar { width: var(--sidebar-collapsed-width); }
            .main-content { margin-left: var(--sidebar-collapsed-width); padding: 30px; }
            body.sidebar-open .sidebar { width: var(--sidebar-expanded-width); }
            body.sidebar-open .main-content { margin-left: var(--sidebar-expanded-width); }
            
            /* Notification dropdown tablet styles */
            #notifDropdown { 
                width: 340px; 
                right: -8px;
                max-height: 70vh;
                border-radius: 18px;
            }
            #notifDropdown .max-h-80 { max-height: 70vh; }
            #notifDropdown .max-h-48 { max-height: 45vh; }
            
            .toast-container { top: 88px; right: 20px; max-width: 360px; }
            .toast-message { min-width: 300px; max-width: 360px; }
        }

        /* Small Desktop/Laptop (1024px - 1439px) */
        @media (min-width:1024px) and (max-width:1439px) {
            .main-content { padding: 35px; }
            
            /* Notification dropdown small desktop styles */
            #notifDropdown { 
                width: 360px; 
                right: 0;
                max-height: 75vh;
            }
            #notifDropdown .max-h-80 { max-height: 75vh; }
            #notifDropdown .max-h-48 { max-height: 50vh; }
            
            .toast-container { top: 88px; right: 30px; max-width: 380px; }
        }

        /* Large Desktop (1440px+) */
        @media (min-width:1440px) {
            .main-content { padding: 40px; }
            
            /* Notification dropdown large desktop styles */
            #notifDropdown { 
                width: 400px; 
                right: 0;
                max-height: 80vh;
            }
            #notifDropdown .max-h-80 { max-height: 80vh; }
            #notifDropdown .max-h-48 { max-height: 55vh; }
            
            .toast-container { top: 88px; right: 40px; max-width: 400px; }
        }

        /* Ultra-wide screens (1920px+) */
        @media (min-width:1920px) {
            #notifDropdown { 
                width: 420px; 
            }
            .toast-container { max-width: 420px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="left">
            <div class="institutional-logos">
                <img src="{{ asset('images/dilg-logo.png') }}" class="inst-logo" alt="DILG">
                <img src="{{ asset('images/bagong-pilipinas.png') }}" class="inst-logo" alt="BP">
            </div>
            <div class="brand-group">
                <div class="brand-text-group">
                    <span class="brand-main-text">LGMED <span class="brand-highlight">Compass</span></span>
                    <br>
                    <span class="brand-sub-text">DILG CAR</span>
                </div>
            </div>
        </div>

        <div class="right" style="display: flex; align-items: center; gap: 12px;">
            <div class="relative flex items-center">
                <button id="notifBtn" class="action-btn-pill relative">
                    <i class="bi bi-bell"></i>
                    @auth
                    @if(auth()->user()->unreadNotifications->count())
                        <span class="notif-dot"></span>
                    @endif
                    @endauth
                </button>

                <div id="notifDropdown" class="notif-closed">
                    {{-- Header (fixed at top) --}}
                    <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Notifications</span>
                            @if(auth()->user()->unreadNotifications->count())
                                <button
                                    id="clearAllNotificationsBtn"
                                    type="button"
                                    onclick="markAllAsRead()"
                                    title="Clear all notifications"
                                    aria-label="Clear all notifications"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full text-gray-500 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                                >
                                    <i class="bi bi-check2-all text-base" aria-hidden="true"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Scrollable Content Area (all sections scroll together) --}}
                    <div id="notifScrollArea">
                        {{-- System Notifications List --}}
                        <div class="divide-y divide-gray-50" id="systemNotificationsList">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <button
                                    id="notif-{{ $notification->id }}"
                                    onclick="openNotifModal(this)"
                                    data-id="{{ $notification->id }}"
                                    data-title="{{ $notification->data['title'] ?? 'Notification' }}"
                                    data-message="{{ $notification->data['message'] ?? '' }}"
                                    data-url="{{ route('notification.redirect', $notification->id) }}"
                                    class="w-full text-left block px-5 py-4 hover:bg-amber-50 transition-colors"
                                >
                                    <div class="text-sm font-bold text-gray-800">{{ $notification->data['title'] ?? 'Update' }}</div>
                                    <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($notification->data['message'] ?? '', 60) }}</div>
                                    <div class="text-[10px] text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</div>
                                </button>
                            @empty
                                <div class="px-5 py-10 text-center text-gray-400 text-sm empty-notif-placeholder">
                                    <i class="bi bi-inbox text-3xl block mb-2"></i>
                                    No new notifications
                                </div>
                            @endforelse
                        </div>

                        {{-- Today's Calendar Events Section --}}
                        <div id="calendarTodayEventsSection" class="border-t border-gray-100 hidden">
                            <div class="px-5 py-3 bg-amber-50/50">
                                <span class="text-[10px] font-extrabold text-amber-700 uppercase tracking-wider">
                                    <i class="bi bi-calendar-check mr-1"></i> Today's Events
                                </span>
                            </div>
                            <div id="calendarTodayEventsList" class="divide-y divide-gray-50"></div>
                        </div>

                        {{-- Tomorrow's Calendar Events Section --}}
                        <div id="calendarTomorrowEventsSection" class="border-t border-gray-100 hidden">
                            <div class="px-5 py-3 bg-blue-50/50 border-l-4 border-blue-400">
                                <span class="text-[10px] font-extrabold text-blue-700 uppercase tracking-wider">
                                    <i class="bi bi-calendar-plus mr-1"></i> Tomorrow's Events
                                </span>
                            </div>
                            <div id="calendarTomorrowEventsList" class="divide-y divide-blue-50"></div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="user-profile-capsule">
                <div class="avatar-squircle">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-meta">
                    <span class="user-name-label">{{ auth()->user()->name }}</span>
                    <span class="user-section-label">{{ auth()->user()->section->name ?? 'LGMED Section' }}</span>
                </div>
            </a>

            <button class="action-btn-pill" onclick="toggleSidebar()">
                <i class="uil uil-bars"></i>
            </button>

            <button class="action-btn-pill text-red-600" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="uil uil-signout"></i>
            </button>
        </div>
    </header>

    <aside class="sidebar" id="sidebar">
        <div class="menu">
            <a class="item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" data-title="Dashboard">
                <i class="uil uil-estate"></i><span>Dashboard</span>
            </a>
            <a class="item {{ request()->routeIs('documents.*') && !request()->routeIs('documents.my-tasks') && !request()->routeIs('documents.my-uploads') && !request()->routeIs('documents.workflow') && !request()->routeIs('documents.archivePage') ? 'active' : '' }}" href="{{ route('documents.index') }}" data-title="PPAs Tracker">
                <i class="uil uil-layers"></i><span>PPAs Tracker</span>
            </a>
            <a class="item {{ request()->routeIs('documents.my-tasks') || request()->routeIs('documents.my-uploads') || request()->routeIs('documents.workflow') || request()->routeIs('documents.archivePage') || request()->routeIs('workflow.documents.*') || request()->routeIs('documentsProcess.*') ? 'active' : '' }}" href="{{ route('documents.my-tasks') }}" data-title="Process">
                <i class="uil uil-sync"></i><span>Process</span>
            </a>
            <a class="item {{ request()->routeIs('ppa.*') ? 'active' : '' }}" href="{{ route('ppa.index') }}" data-title="PPAs">
                <i class="uil uil-chart-growth"></i><span>PPAs</span>
            </a>
            <a class="item {{ request()->routeIs('calendar.*') ? 'active' : '' }}" href="{{ route('calendar.index') }}" data-title="Calendar">
                <i class="uil uil-calendar-alt"></i><span>Calendar</span>
            </a>
            @can('manage-accounts')
            <a class="item {{ request()->routeIs('account-management.*') ? 'active' : '' }}" href="{{ route('account-management.index') }}" data-title="Accounts">
                <i class="uil uil-shield-check"></i><span>Accounts</span>
            </a>
            @endcan
        </div>
        <div class="sidebar-divider" role="separator" aria-orientation="horizontal"></div>
        <div class="menu">
            <a class="item" href="https://intranet.dilg.gov.ph/user/login" target="_blank" rel="noopener noreferrer" data-title="DILG Intranet">
                <img class="item-logo" src="{{ asset('images/dilg-logo.png') }}" alt="">
                <span>DILG Intranet</span>
            </a>
            <a class="item" href="https://drive.google.com/drive/u/1/folders/1JN-8jz58sP3WFfKA058mxNDqVyb0mXAy" target="_blank" rel="noopener noreferrer" data-title="User Manual">
                <i class="uil uil-book-open"></i><span>User Manual</span>
            </a>
        </div>
    </aside>

    <!-- DETAILED NOTIFICATION MODAL (keep exactly as you had) -->
    <div id="notificationModal" class="hidden fixed inset-0 z-[4000] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" onclick="closeNotifModal()"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-white">
            <div class="px-8 py-6 border-b flex justify-between items-center bg-gray-50/50">
                <h3 class="font-extrabold text-xl text-gray-900" id="modalTitle">Notification</h3>
                <button onclick="closeNotifModal()" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition-colors text-2xl">&times;</button>
            </div>
            <div class="p-8">
                <p id="modalMessage" class="text-gray-600 leading-relaxed text-base"></p>
            </div>
            <div class="px-8 py-6 bg-gray-50 flex justify-between items-center">
                <button id="modalClearBtn" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase tracking-widest">Mark as Read</button>
                <div class="flex gap-3">
                    <a id="modalOpenLink" href="#" class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-bold text-sm shadow-lg shadow-slate-200">View Action</a>
                </div>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>


    @if(session('reset_calendar_toasts'))
    <script>
        sessionStorage.setItem('reset_calendar_toasts', 'true');
    </script>
    @endif
   <script>
    // ---------- GLOBAL TOAST CLOSE FUNCTIONS ----------
    function closeGlobalErrorToast() {
        const toast = document.getElementById('globalErrorToast');
        if (toast) toast.remove();
    }

    function closeGlobalSuccessToast() {
        const toast = document.getElementById('globalSuccessToast');
        if (toast) toast.remove();
    }

    setTimeout(() => {
        closeGlobalErrorToast();
        closeGlobalSuccessToast();
    }, 4000);

    // ---------- SIDEBAR ----------
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-open');
        localStorage.setItem('sidebar-state', document.body.classList.contains('sidebar-open') ? 'open' : 'closed');
    }

    // ---------- DISMISS STORAGE (for event toasts) ----------
    function getDismissedKeys() {
        const stored = localStorage.getItem('dismissedTodayEvents');
        if (!stored) return [];
        try {
            return JSON.parse(stored).filter(item => item && item.key && item.date);
        } catch (e) {
            return [];
        }
    }

    function addDismissedKey(key) {
        const today = new Date().toISOString().split('T')[0];
        const items = getDismissedKeys();
        if (!items.some(item => item.key === key && item.date === today)) {
            items.push({ key, date: today });
        }
        localStorage.setItem('dismissedTodayEvents', JSON.stringify(items));
    }

    function clearOldDismissedKeys() {
        const today = new Date().toISOString().split('T')[0];
        const items = getDismissedKeys();
        const fresh = items.filter(item => item.date === today);
        localStorage.setItem('dismissedTodayEvents', JSON.stringify(fresh));
    }

    // ---------- SESSION STORAGE FOR LOGIN-BASED TOAST DISPLAY ----------
    function hasShownInitialToasts() {
        const shown = sessionStorage.getItem('calendar_toasts_shown');
        const timestamp = sessionStorage.getItem('calendar_toasts_timestamp');
        
        if (shown === 'true' && timestamp) {
            const shownDate = new Date(parseInt(timestamp));
            const today = new Date();
            return shownDate.toDateString() === today.toDateString();
        }
        
        return false;
    }

    function markInitialToastsAsShown() {
        sessionStorage.setItem('calendar_toasts_shown', 'true');
        sessionStorage.setItem('calendar_toasts_timestamp', Date.now().toString());
    }

    window.resetCalendarToastFlag = function() {
        sessionStorage.removeItem('calendar_toasts_shown');
        sessionStorage.removeItem('calendar_toasts_timestamp');
    };

    // ---------- ESCAPE HTML (global) ----------
    window.escapeHtml = function(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    };

    // ---------- ERROR TOAST (for 403 and other errors) ----------
    window.showErrorToast = function(message) {
        const existing = document.getElementById('errorToast');
        if (existing) existing.remove();

        const toast = document.createElement('div');
        toast.id = 'errorToast';
        toast.className = 'fixed top-6 right-6 z-[9999] w-96 max-w-full p-4 rounded-lg border-l-4 border-red-600 bg-white shadow-xl flex items-start gap-3';
        toast.innerHTML = `
            <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
            </svg>
            <div class="text-red-800 text-sm">${window.escapeHtml(message)}</div>
            <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 font-bold">×</button>
        `;
        document.body.appendChild(toast);

        setTimeout(() => {
            const t = document.getElementById('errorToast');
            if (t) t.remove();
        }, 4000);
    };

    // ---------- INTERCEPT AJAX REQUESTS (for 403 handling) ----------
    const originalFetch = window.fetch;
    window.fetch = function(...args) {
        let options = args[1] || {};
        let headers = options.headers || {};

        headers['X-Requested-With'] = 'XMLHttpRequest';
        headers['Accept'] = 'application/json';
        
        // ADD THIS LINE - Include CSRF token in all fetch requests
        if (!headers['X-CSRF-TOKEN']) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (csrfToken) {
                headers['X-CSRF-TOKEN'] = csrfToken;
            }
        }

        options.headers = headers;
        args[1] = options;

        return originalFetch.apply(this, args).then(response => {
            if (response.status === 403) {
                return response.clone().json().then(data => {
                    showErrorToast(data.error || 'Forbidden: Read-only access.');
                }).catch(() => {
                    showErrorToast('Forbidden: Technical Inspector has read-only access.');
                }).then(() => response);
            }
            if (response.status === 419) {
                showErrorToast('Your session has expired. Please refresh the page.');
            }
            return response;
        });
    };

    const originalXHROpen = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
        this.addEventListener('load', function() {
            if (this.status === 403) {
                let errorMsg = 'Forbidden: Read-only access.';
                try {
                    const json = JSON.parse(this.responseText);
                    errorMsg = json.error || errorMsg;
                } catch(e) {}
                showErrorToast(errorMsg);
            }
            if (this.status === 419) {
                showErrorToast('Your session has expired. Please refresh the page.');
            }
        });
        this.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        this.setRequestHeader('Accept', 'application/json');
        
        // ADD THIS - Include CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            this.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        }
        
        return originalXHROpen.apply(this, arguments);
    };

    // ---------- TOAST QUEUE SYSTEM ----------
    let toastQueue = [];
    let toastCounter = 0;
    let isProcessingQueue = false;
    let toastQueueGeneration = 0;

    function getCalendarToastType(type) {
        const labels = {
            holiday: 'Holiday',
            leave: 'Leave',
            offsite: 'Off Site',
            official_business: 'Official Business'
        };
        const key = (type || '').toString().toLowerCase();

        return labels[key] || type || 'Event';
    }

    function getCalendarToastIcon(type) {
        const icons = {
            holiday: 'bi-calendar-heart',
            leave: 'bi-person-walking',
            offsite: 'bi-building',
            official_business: 'bi-briefcase'
        };
        const key = (type || '').toString().toLowerCase();

        return icons[key] || 'bi-calendar-event';
    }

    function ensureToastClearButton(toastContainer) {
        if (toastContainer.querySelector('.toast-clear-toolbar')) return;

        const toolbar = document.createElement('div');
        toolbar.className = 'toast-clear-toolbar';

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'toast-clear-all';
        button.title = 'Clear all notifications';
        button.setAttribute('aria-label', 'Clear all notifications');
        button.innerHTML = '<i class="bi bi-trash-fill" aria-hidden="true"></i>';
        button.addEventListener('click', clearAllToasts);

        toolbar.appendChild(button);
        toastContainer.appendChild(toolbar);
    }

    function removeToastClearButtonIfEmpty(toastContainer) {
        if (toastContainer && toastQueue.length === 0 && toastContainer.querySelectorAll('.toast-message').length === 0) {
            toastContainer.querySelector('.toast-clear-toolbar')?.remove();
        }
    }

    function clearAllToasts() {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;

        toastQueue.forEach(toast => {
            if (toast.dismissKey) addDismissedKey(toast.dismissKey);
        });
        toastContainer.querySelectorAll('.toast-message').forEach(toast => {
            if (toast.dataset.dismissKey) addDismissedKey(toast.dataset.dismissKey);
            toast.remove();
        });

        toastQueue = [];
        toastCounter = 0;
        isProcessingQueue = false;
        toastQueueGeneration++;
        toastContainer.querySelector('.toast-clear-toolbar')?.remove();
    }

    function processToastQueue() {
        if (isProcessingQueue || toastQueue.length === 0) return;
        
        isProcessingQueue = true;
        const generation = toastQueueGeneration;
        const toast = toastQueue.shift();
        toastCounter++;
        
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;
        ensureToastClearButton(toastContainer);
        
        const toastElement = document.createElement('div');
        toastElement.className = `toast-message stagger-${Math.min(toastCounter, 5)}`;
        toastElement.setAttribute('role', 'alert');
        toastElement.dataset.dismissKey = toast.dismissKey;

        const icon = getCalendarToastIcon(toast.type);
        const typeLabel = getCalendarToastType(toast.type);

        const isFocalPerson = toast.is_focal_person;
        const borderColor = isFocalPerson ? '#8B5CF6' : 'var(--brand-primary)';
        const iconColor = isFocalPerson ? 'color: #8B5CF6;' : '';
        const titlePrefix = isFocalPerson ? 'Personal: ' : 'Today\'s ';

        toastElement.style.borderLeft = `6px solid ${borderColor}`;

        toastElement.innerHTML = `
            <div class="toast-icon" style="${iconColor}"><i class="bi ${icon}"></i></div>
            <div class="toast-content toast-clickable" style="cursor: pointer;" data-url="${toast.url}">
                <div class="toast-title">${titlePrefix}${typeLabel}</div>
                <div class="toast-text"><strong>${window.escapeHtml(toast.title)}</strong> ${toast.time ? '· ' + toast.time : ''}</div>
                ${toast.section ? `<div class="toast-text text-[10px] mt-1 opacity-70">${window.escapeHtml(toast.section)}</div>` : ''}
            </div>
            <button class="toast-close" onclick="event.stopPropagation(); dismissToast(this)">&times;</button>
        `;

        const clickableArea = toastElement.querySelector('.toast-clickable');
        clickableArea.addEventListener('click', function(e) {
            const url = this.dataset.url;
            const key = toastElement.dataset.dismissKey;
            if (key) addDismissedKey(key);
            if (url) window.location.href = url;
        });

        toastContainer.appendChild(toastElement);

        setTimeout(() => {
            toastElement.classList.add('removing');
            setTimeout(() => {
                toastElement.remove();
                if (generation !== toastQueueGeneration) return;
                isProcessingQueue = false;
                processToastQueue();
                removeToastClearButtonIfEmpty(toastContainer);
            }, 250);
        }, 5000);

        setTimeout(() => {
            if (generation === toastQueueGeneration) processToastQueue();
        }, 500);
    }

    function showMultipleToasts(events) {
        toastQueue = [...events];
        toastCounter = 0;
        isProcessingQueue = false;
        processToastQueue();
    }

    // ---------- EVENT REMINDER TOAST (for today's calendar events) ----------
    function showEventReminderToast(event) {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;
        ensureToastClearButton(toastContainer);
        const toast = document.createElement('div');
        toast.className = 'toast-message';
        toast.setAttribute('role', 'alert');
        toast.dataset.dismissKey = event.dismissKey;

        const isFocalPerson = event.is_focal_person;
        const borderColor = isFocalPerson ? '#8B5CF6' : 'var(--brand-primary)';
        const iconColor = isFocalPerson ? 'color: #8B5CF6;' : '';
        const titlePrefix = isFocalPerson ? 'Personal: ' : 'Today\'s ';

        toast.style.borderLeft = `6px solid ${borderColor}`;

        const icon = getCalendarToastIcon(event.type);
        const typeLabel = getCalendarToastType(event.type);

        toast.innerHTML = `
            <div class="toast-icon" style="${iconColor}"><i class="bi ${icon}"></i></div>
            <div class="toast-content toast-clickable" style="cursor: pointer;" data-url="${event.url}">
                <div class="toast-title">${titlePrefix}${typeLabel}</div>
                <div class="toast-text"><strong>${window.escapeHtml(event.title)}</strong> ${event.time ? '· ' + event.time : ''}</div>
                ${event.section ? `<div class="toast-text text-[10px] mt-1 opacity-70">${window.escapeHtml(event.section)}</div>` : ''}
            </div>
            <button class="toast-close" onclick="event.stopPropagation(); dismissToast(this)">&times;</button>
        `;

        const clickableArea = toast.querySelector('.toast-clickable');
        clickableArea.addEventListener('click', function(e) {
            const url = this.dataset.url;
            const key = toast.dataset.dismissKey;
            if (key) addDismissedKey(key);
            if (url) window.location.href = url;
        });

        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('removing');
            setTimeout(() => {
                toast.remove();
                removeToastClearButtonIfEmpty(toastContainer);
            }, 250);
        }, 5000);
    }

    // ---------- EVENT REMINDER TOAST (for tomorrow's calendar events) ----------
    function showTomorrowEventToast(event) {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;
        ensureToastClearButton(toastContainer);
        
        const toast = document.createElement('div');
        toast.className = 'toast-message';
        toast.setAttribute('role', 'alert');
        toast.dataset.dismissKey = event.dismissKey;

        const isFocalPerson = event.is_focal_person;
        const borderColor = isFocalPerson ? '#8B5CF6' : '#3B82F6';
        const iconColor = isFocalPerson ? 'color: #8B5CF6;' : 'color: #3B82F6;';
        const titlePrefix = isFocalPerson ? 'Personal: ' : 'Tomorrow\'s ';
        const titleColor = isFocalPerson ? 'color: #8B5CF6;' : 'color: #3B82F6;';

        toast.style.borderLeft = `6px solid ${borderColor}`;
        
        const icon = getCalendarToastIcon(event.type);
        const typeLabel = getCalendarToastType(event.type);
        
        toast.innerHTML = `
            <div class="toast-icon" style="${iconColor}"><i class="bi ${icon}"></i></div>
            <div class="toast-content toast-clickable" style="cursor: pointer;" data-url="${event.url}">
                <div class="toast-title" style="${titleColor}">${titlePrefix}${typeLabel}</div>
                <div class="toast-text"><strong>${window.escapeHtml(event.title)}</strong> ${event.time ? '· ' + event.time : ''}</div>
                ${event.section ? `<div class="toast-text text-[10px] mt-1 opacity-70">${window.escapeHtml(event.section)}</div>` : ''}
            </div>
            <button class="toast-close" onclick="event.stopPropagation(); dismissToast(this)">&times;</button>
        `;
        
        const clickableArea = toast.querySelector('.toast-clickable');
        clickableArea.addEventListener('click', function(e) {
            const url = this.dataset.url;
            const key = toast.dataset.dismissKey;
            if (key) addDismissedKey(key);
            if (url) window.location.href = url;
        });
        
        toastContainer.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('removing');
            setTimeout(() => {
                toast.remove();
                removeToastClearButtonIfEmpty(toastContainer);
            }, 250);
        }, 5000);
    }

    function dismissToast(btn) {
        const toast = btn.closest('.toast-message');
        const key = toast.dataset.dismissKey;
        if (key) addDismissedKey(key);
        toast.classList.add('removing');
        setTimeout(() => {
            toast.remove();
            removeToastClearButtonIfEmpty(document.getElementById('toastContainer'));
        }, 250);
    }

    // ---------- NOTIFICATION MODAL FUNCTIONS ----------
    function formatDate(dateString) {
        if (!dateString) return 'No due date';
        const d = new Date(dateString);
        if (isNaN(d.getTime())) return 'Invalid date';
        const month = d.toLocaleString('en-US', { month: 'short' });
        const day = String(d.getDate()).padStart(2, '0');
        const year = d.getFullYear();
        return `${month}-${day}-${year}`;
    }

    function openNotifModal(element) {
        const notifId = element.getAttribute('data-id');
        const notifTitle = element.getAttribute('data-title') || 'Notification';
        const notifMessage = element.getAttribute('data-message') || '';
        const redirectUrl = element.getAttribute('data-url') || '#';

        const modal = document.getElementById('notificationModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalOpenLink = document.getElementById('modalOpenLink');
        const modalClearBtn = document.getElementById('modalClearBtn');

        modalTitle.innerText = 'Loading...';
        modalMessage.innerHTML = '<div class="text-center py-4"><i class="bi bi-hourglass-split animate-spin"></i> Fetching details...</div>';
        modalOpenLink.href = redirectUrl;
        modal.classList.remove('hidden');

        fetch(`/notification/${notifId}/details`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                return response.json();
            })
            .then(data => {
                const formattedDate = formatDate(data.due_date);
                let additionalInfo = '';
                if (data.assignment_step) {
                    additionalInfo = `<br><strong>Assigned Step:</strong> ${window.escapeHtml(data.assignment_step)}`;
                }
                if (data.assigned_by) {
                    additionalInfo += `<br><strong>Assigned By:</strong> ${window.escapeHtml(data.assigned_by)}`;
                }
                modalTitle.innerText = data.type === 'assignment' ? 'Document Assignment' : 'Document Details';
                modalMessage.innerHTML = `
                    <strong>Title:</strong> ${window.escapeHtml(data.title || notifTitle)}<br>
                    <strong>Due Date:</strong> ${formattedDate}<br>
                    <strong>Status:</strong> ${window.escapeHtml(data.status || 'Pending')}
                    ${additionalInfo}
                `;
            })
            .catch(error => {
                console.error('Failed to load notification details:', error);
                modalTitle.innerText = "Notification";
                modalMessage.innerHTML = `
                    <strong>${window.escapeHtml(notifTitle)}</strong><br>
                    ${window.escapeHtml(notifMessage)}<br><br>
                    <span class="text-xs text-gray-400">(Detailed information could not be loaded, but you can still view the action.)</span>
                `;
            })
            .finally(() => {
                modalClearBtn.onclick = function () {
                    markAsRead(notifId);
                };
            });
    }

    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/mark-as-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Network error');
            return res.json();
        })
        .then(data => {
            if (data.success) {
                const notifItem = document.getElementById(`notif-${notificationId}`);
                if (notifItem) notifItem.remove();
                closeNotifModal();
                updateNotificationUI();
            }
        })
        .catch(err => console.error('Mark as read failed:', err));
    }

    function updateNotificationUI() {
        const dropdownContainer = document.querySelector('#systemNotificationsList');
        const dot = document.querySelector('.notif-dot');
        const clearAllBtn = document.getElementById('clearAllNotificationsBtn');

        const remainingNotifs = document.querySelectorAll('#systemNotificationsList > button[id^="notif-"]');
        if (remainingNotifs.length === 0) {
            if (dropdownContainer) {
                dropdownContainer.innerHTML = `
                    <div class="px-5 py-10 text-center text-gray-400 text-sm empty-notif-placeholder">
                        <i class="bi bi-inbox text-3xl block mb-2"></i>
                        No new notifications
                    </div>
                `;
            }
            if (dot) dot.remove();
            if (clearAllBtn) clearAllBtn.remove();
        }
    }

    function markAllAsRead() {
        const clearAllBtn = document.getElementById('clearAllNotificationsBtn');
        if (clearAllBtn) clearAllBtn.disabled = true;

        fetch('/notifications/clear', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            if (!data.success) throw new Error('The server did not clear notifications.');

            document.querySelectorAll('#systemNotificationsList > button[id^="notif-"]').forEach(notification => {
                notification.remove();
            });
            updateNotificationUI();
        })
        .catch(err => {
            console.error('Clear all failed:', err);
            if (clearAllBtn) clearAllBtn.disabled = false;
            window.showErrorToast('Could not clear notifications. Please try again.');
        });
    }

    function closeNotifModal() {
        document.getElementById('notificationModal').classList.add('hidden');
    }

    // ---------- DOM READY ----------
    document.addEventListener("DOMContentLoaded", function () {
        // Check if we need to reset toast flag (from fresh login or registration)
        if (sessionStorage.getItem('reset_calendar_toasts') === 'true') {
            sessionStorage.removeItem('calendar_toasts_shown');
            sessionStorage.removeItem('calendar_toasts_timestamp');
            sessionStorage.removeItem('reset_calendar_toasts');
        }

        // ---------- HIDE LOADING SCREEN ----------
        const loader = document.getElementById("loading-screen");
        if (loader) {
            const loadingDelay = Number(document.body.dataset.loadingDelay || 800);
            setTimeout(() => {
                loader.style.opacity = "0";
                loader.style.transition = "opacity 0.4s ease";
                setTimeout(() => loader.style.display = "none", 400);
            }, loadingDelay);
        }

        // Restore sidebar state
        if (localStorage.getItem('sidebar-state') === 'open') {
            document.body.classList.add('sidebar-open');
        }

        // Notification dropdown toggle
        (function() {
            const notifBtn = document.getElementById("notifBtn");
            const notifDropdown = document.getElementById("notifDropdown");
            
            if (!notifBtn || !notifDropdown) return;
            
            // Toggle dropdown on button click
            notifBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                if (notifDropdown.classList.contains("notif-closed")) {
                    notifDropdown.classList.remove("notif-closed");
                } else {
                    notifDropdown.classList.add("notif-closed");
                }
            });
            
            // Close dropdown when clicking anywhere on the document
            document.addEventListener("click", function(e) {
                if (!notifDropdown.classList.contains("notif-closed")) {
                    if (!notifDropdown.contains(e.target) && e.target !== notifBtn && !notifBtn.contains(e.target)) {
                        notifDropdown.classList.add("notif-closed");
                    }
                }
            });
        })();

        // ---------- LOGOUT HANDLER ----------
        const logoutForm = document.getElementById('logout-form');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function() {
                sessionStorage.removeItem('calendar_toasts_shown');
                sessionStorage.removeItem('calendar_toasts_timestamp');
            });
        }

        document.querySelectorAll('.action-btn-pill.text-red-600').forEach(btn => {
            btn.addEventListener('click', function() {
                sessionStorage.removeItem('calendar_toasts_shown');
                sessionStorage.removeItem('calendar_toasts_timestamp');
            });
        });

        // ---------- HELPER: Attach click/dismiss handlers to event list items ----------
        function attachEventClickHandlers(listElement, events, sectionElement) {
            listElement.querySelectorAll('[data-dismiss-key]').forEach(item => {
                const key = item.dataset.dismissKey;
                const eventForItem = events.find(e => e.dismissKey === key);
                const url = eventForItem ? eventForItem.url : '#';
                
                item.addEventListener('click', (e) => {
                    if (e.target.closest('.dismiss-event-btn')) return;
                    addDismissedKey(key);
                    window.location.href = url;
                });
                
                item.querySelector('.dismiss-event-btn')?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    addDismissedKey(key);
                    item.remove();
                    if (listElement.children.length === 0) {
                        sectionElement.classList.add('hidden');
                    }
                });
            });
        }

        // ---------- FETCH TODAY'S AND TOMORROW'S EVENTS ----------
        clearOldDismissedKeys();
        fetch('/calendar/today-events')
            .then(res => res.json())
            .then(events => {
                const dismissedItems = getDismissedKeys();
                const dismissedKeys = dismissedItems.map(item => item.key);
                
                const todayEvents = events.filter(e => !e.is_tomorrow && !dismissedKeys.includes(e.dismissKey));
                const tomorrowEvents = events.filter(e => e.is_tomorrow && !dismissedKeys.includes(e.dismissKey));
                
                const shouldShowToasts = !hasShownInitialToasts();
                
                if (shouldShowToasts) {
                    todayEvents.forEach(event => showEventReminderToast(event));
                    tomorrowEvents.forEach(event => showTomorrowEventToast(event));
                    markInitialToastsAsShown();
                }
                
                // Populate Today's Events
                const todaySection = document.getElementById('calendarTodayEventsSection');
                const todayList = document.getElementById('calendarTodayEventsList');
                if (todaySection && todayList) {
                    if (todayEvents.length > 0) {
                        todaySection.classList.remove('hidden');
                        todayList.innerHTML = todayEvents.map(event => {
                            const isFocalPerson = event.is_focal_person;
                            const extraClass = isFocalPerson ? 'border-l-2 border-purple-300' : '';
                            const badgeHtml = isFocalPerson 
                                ? '<span class="ml-auto text-[10px] bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-medium">PERSONAL</span>'
                                : '';
                            
                            return `
                                <div class="px-5 py-3 hover:bg-amber-50/60 transition-colors cursor-pointer group relative ${extraClass}"
                                    data-dismiss-key="${event.dismissKey}">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full" style="background: ${event.color}"></span>
                                        <span class="text-sm font-semibold text-gray-800">${window.escapeHtml(event.title)}</span>
                                        ${badgeHtml}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1 ml-4">
                                        ${event.time}${event.section ? ' · ' + window.escapeHtml(event.section) : ''}
                                    </div>
                                    <button class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 text-gray-400 hover:text-red-500 p-1 dismiss-event-btn"
                                            title="Dismiss">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            `;
                        }).join('');
                        
                        attachEventClickHandlers(todayList, todayEvents, todaySection);
                    } else {
                        todaySection.classList.add('hidden');
                    }
                }
                
                // Populate Tomorrow's Events
                const tomorrowSection = document.getElementById('calendarTomorrowEventsSection');
                const tomorrowList = document.getElementById('calendarTomorrowEventsList');
                if (tomorrowSection && tomorrowList) {
                    if (tomorrowEvents.length > 0) {
                        tomorrowSection.classList.remove('hidden');
                        tomorrowList.innerHTML = tomorrowEvents.map(event => {
                            const isFocalPerson = event.is_focal_person;
                            const extraClass = isFocalPerson ? 'border-l-2 border-purple-300' : 'border-l-2 border-blue-200';
                            const hoverClass = isFocalPerson ? 'hover:bg-purple-50/60' : 'hover:bg-blue-50/60';
                            const badgeClass = isFocalPerson ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700';
                            const badgeText = isFocalPerson ? 'PERSONAL' : 'TOMORROW';
                            
                            return `
                                <div class="px-5 py-3 ${hoverClass} transition-colors cursor-pointer group relative ${extraClass}"
                                    data-dismiss-key="${event.dismissKey}">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full" style="background: ${event.color}"></span>
                                        <span class="text-sm font-semibold text-gray-800">${window.escapeHtml(event.title)}</span>
                                        <span class="ml-auto text-[10px] ${badgeClass} px-2 py-0.5 rounded-full font-medium">${badgeText}</span>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1 ml-4">
                                        ${event.time}${event.section ? ' · ' + window.escapeHtml(event.section) : ''}
                                    </div>
                                    <button class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 text-gray-400 hover:text-red-500 p-1 dismiss-event-btn"
                                            title="Dismiss">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            `;
                        }).join('');
                        
                        attachEventClickHandlers(tomorrowList, tomorrowEvents, tomorrowSection);
                    } else {
                        tomorrowSection.classList.add('hidden');
                    }
                }
            })
            .catch(err => console.warn('Could not fetch today\'s events:', err));
    });
</script>


@stack('scripts')

</body>
</html>
