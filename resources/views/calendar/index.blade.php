    <x-app-layout>
    @vite('resources/css/calendar-responsiveness.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <div class="bg-gray-100 min-h-screen p-6 font-sans border border-[#f59e0b] rounded-2xl">
        <div class="max-w-7xl mx-auto h-full flex flex-col">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-4 flex-shrink-0">
                <h1 class="text-2xl font-semibold text-gray-800">Calendar</h1>
                <div class="relative">
                    <button id="createBtn"
                        class="flex items-center gap-2 bg-white shadow-md hover:shadow-lg outline-[#f59e0b] outline-2 border border-[#f59e0b] rounded-full px-5 py-2 text-sm font-medium text-[#f59e0b]">
                        <span class="text-lg">+</span> Create
                    </button>
                    <div id="createDropdown"
                        class="hidden absolute right-0 mt-2 z-50">
                        <button id="createFromDateBtn" type="button"
                            class="flex items-center gap-2 rounded-full border border-amber-300 bg-white px-4 py-2 text-sm font-semibold text-amber-700 shadow-lg transition hover:bg-amber-50">
                            <i class="bi bi-plus-lg" aria-hidden="true"></i>
                            <span>Create</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- COLOR LEGEND
            <div class="bg-white border rounded-xl p-4 mb-6">
                <h2 class="text-sm font-semibold text-gray-600 mb-3">Designated Colors</h2>
                <div class="flex flex-wrap gap-4 text-sm">
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-red-600"></span>Holiday</div>
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-yellow-500"></span>Leave</div>
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-yellow-400"></span>Global View</div>
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-green-700"></span>Private</div>
                    <div class="w-full border-t my-2"></div>
                    @foreach($sections as $section)
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $section->color }}"></span>
                        {{ $section->name }}
                    </div>
                    @endforeach
                </div>
            </div> -->

            <!-- MAIN LAYOUT -->
            <div class="grid grid-cols-12 gap-6 flex-1 min-h-0">
                <!-- LEFT SIDEBAR -->
                <div class="col-span-12 lg:col-span-3 flex flex-col gap-4 h-full order-2 lg:order-1">
                    <!-- MINI CALENDAR -->
                    <div class="mini-calendar-card bg-white border rounded-xl shadow-sm p-4 h-fit w-full flex-shrink-0">
                        <div id="miniCalendar"></div>
                    </div>

                    <!-- FILTER CALENDAR -->
                    <div class="bg-white border rounded-xl shadow-sm p-4 flex flex-col flex-1 min-h-0 filter-calendar-card">

                        <div class="flex items-center justify-between w-full mb-3">
                            {{-- Collapsible Toggle --}}
                            <button type="button"
                                class="flex items-center gap-2 text-left text-sm font-semibold text-gray-700 collapsible-toggle"
                                data-target="filterCalendarContent">
                                <span>Filter Calendar</span>
                                <svg class="w-5 h-5 transition-transform duration-200 collapsible-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            {{-- Clear Filters Button (improved UX) --}}
                            <button id="clearFiltersBtn" 
                                class="group relative flex items-center gap-1.5 text-xs font-medium text-gray-500 hover:text-red-500 bg-gray-50 hover:bg-red-50 px-3 py-1.5 rounded-full border border-gray-200 hover:border-red-200 transition-all duration-200"
                                title="Clear all filters – hides all events">
                                <i class="bi bi-eraser text-base"></i>
                                <span class="hidden sm:inline">Clear</span>
                                {{-- Tooltip for mobile/touch --}}
                                <span class="absolute -top-8 right-0 scale-0 group-hover:scale-100 transition-transform bg-gray-800 text-white text-xs px-2 py-1 rounded shadow-lg whitespace-nowrap">
                                    Clear all filters
                                </span>
                            </button>
                        </div>

                        {{-- Filter List --}}
                        <div id="filterCalendarContent" class="overflow-y-auto flex-1 pr-2 custom-scrollbar collapsible-content">
                            <div id="calendarFilters" class="flex flex-col gap-3 text-sm">
                                {{-- Holiday --}}
                                <label class="filter-item group">
                                    <input type="checkbox" value="Holiday" checked class="calendar-filter rounded text-red-600">
                                    <span class="filter-dot bg-red-600"></span>
                                    <span class="filter-label">Holiday</span>
                                </label>

                                {{-- Official Business --}}
                                <label class="filter-item group">
                                    <input type="checkbox" value="official_business" checked class="calendar-filter rounded" style="accent-color: #0f766e">
                                    <span class="filter-dot" style="background-color: #0f766e"></span>
                                    <span class="filter-label">Official Business</span>
                                </label>

                                {{-- Leave --}}
                                <label class="filter-item group">
                                    <input type="checkbox" value="Leave" checked class="calendar-filter rounded text-yellow-500">
                                    <span class="filter-dot bg-yellow-500"></span>
                                    <span class="filter-label">Leave</span>
                                </label>

                                <div class="w-full border-t my-2"></div>

                                {{-- Private --}}
                                <label class="filter-item group">
                                    <input type="checkbox" value="Private" checked class="calendar-filter rounded text-green-700">
                                    <span class="filter-dot bg-green-700"></span>
                                    <span class="filter-label">Private</span>
                                </label>

                                <div class="w-full border-t my-2"></div>

                                {{-- Dynamic Sections --}}
                                @foreach($sections as $section)
                                <label class="filter-item group">
                                    <input type="checkbox" value="{{ $section->name }}" checked class="calendar-filter rounded" style="accent-color: {{ $section->color }}">
                                    <span class="filter-dot" style="background-color: {{ $section->color }}"></span>
                                    <span class="filter-label">{{ $section->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                    <!-- MAIN CALENDAR -->
                <div class="col-span-12 lg:col-span-9 flex flex-col min-h-0 order-1 lg:order-2">
                    <div class="bg-white border rounded-xl shadow-sm p-4 flex-1 overflow-hidden min-h-0">
                        <div id="calendarContainer" class="w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALS --}}
    @push('modals')
    @include('calendar.partials.event-modal')
    @include('calendar.partials.holiday-modal')
    @include('calendar.partials.leave-modal')
    @include('calendar.partials.official-business-modal')
    @include('calendar.partials.view-modal')
    @endpush

    {{-- SCRIPTS --}}
    @push('scripts')
    <script>
        // Pre-load users data for dropdowns
        window.usersData = @json($users);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}?v={{ filemtime(public_path('js/calendar.js')) }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        


        document.querySelectorAll('.collapsible-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const content = document.getElementById(targetId);
                const icon = this.querySelector('.collapsible-icon');
                if (content) {
                    content.classList.toggle('hidden');
                    if (icon) icon.classList.toggle('rotate-180');
                }
            });
        });
    });
    </script>

    <style>
        .collapsible-content.hidden {
            display: none !important;
        }
        /* Notes container flexible height */
        #rowNotes {
            display: block !important;  /* override any flex */
            width: 100%;
        }
        #rowNotes .notes-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        #viewNotes {
            max-height: 200px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-word;
            font-size: 0.875rem;
            line-height: 1.6;
            padding-right: 4px;
            color: #374151;
            margin: 0;
        }
        /* Custom scrollbar for notes */
        #viewNotes::-webkit-scrollbar {
            width: 4px;
        }
        #viewNotes::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }
        /* Ensure filter card doesn't clip tooltips and hover effects */
        .filter-calendar-card {
            overflow: visible !important;
            position: relative;
            z-index: 5; /* Place above mini calendar if needed */
        }

        /* Mini calendar stays below */
        .mini-calendar-card {
            position: relative;
            z-index: 1;
        }

        /* Clear button tooltip z-index boost */
        #clearFiltersBtn .absolute {
            z-index: 50 !important;
        }

        /* Filter items container should not clip hover background */
        #filterCalendarContent {
            overflow-y: auto;
            overflow-x: visible !important;
        }
        /* Filter item styling */
        .filter-item {
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            cursor: pointer;
            padding: 0.25rem 0;
            transition: background 0.15s;
            border-radius: 0.375rem;
        }

        .filter-item:hover {
            background: #f9fafb;
        }

        .filter-item .calendar-filter {
            margin-top: 0.125rem;
            flex-shrink: 0;
        }

        .filter-dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 9999px;
            flex-shrink: 0;
            margin-top: 0.25rem;
        }

        .filter-label {
            flex: 1;
            line-height: 1.4;
            word-break: break-word;
            color: #374151;
        }

        /* Make the clear button more discoverable */
        #clearFiltersBtn:hover .bi-eraser {
            animation: wiggle 0.3s ease;
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        /* Override the general card styling for the mini calendar */
        .mini-calendar-card {
            flex: none !important;      /* Prevents flex growing */
            height: auto !important;
            min-height: 0 !important;
            align-self: flex-start;     /* Keeps it top-aligned */
        }

        /* Ensure the inner calendar doesn't force a height */
        #miniCalendar {
            height: auto !important;
            min-height: 0 !important;
            width: 100% !important;
        }
        /* =====================================================
        MAIN LAYOUT – FULL WIDTH & HEIGHT WITH CLEAR GAP
        ===================================================== */
        .bg-gray-100.min-h-screen {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .max-w-7xl {
            flex: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 100%;
            padding: 0 1rem;
        }

        /* Grid layout – responsive columns, no fixed widths */
        .grid.grid-cols-12 {
            flex: 1;
            min-height: 0;
            width: 100%;
            gap: 1.5rem; /* 24px – matches Tailwind gap-6 */
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
        }

        /* Left sidebar – flexible width, column direction */
        .col-span-12.lg\:col-span-3 {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            min-height: 0;
            width: 100%;           /* Remove fixed 320px */
            flex-shrink: 1;        /* Allow shrinking */
        }

        /* Main calendar column – takes remaining space */
        .col-span-12.lg\:col-span-9 {
            display: flex;
            flex-direction: column;
            min-height: 0;
            width: 100%;
            min-width: 0;           /* Prevent overflow */
        }

        /* White card inside main column */
        .bg-white.border.rounded-xl.shadow-sm.p-4 {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 0;
            overflow: hidden;
            width: 100%;
        }

        /* Calendar container fills the card */
        #calendarContainer {
            flex: 1;
            min-height: 0;
            width: 100%;
        }

        /* FullCalendar fills its parent (width & height) */
        .fc {
            height: 100% !important;
            width: 100% !important;
            min-height: 400px;
        }

        /* Ensure internal tables stretch horizontally */
        .fc-daygrid-body,
        .fc-scrollgrid,
        .fc-scrollgrid-section-liquid,
        .fc-daygrid-body table,
        .fc-timegrid-body,
        .fc-timegrid-slots,
        .fc-list-table {
            width: 100% !important;
        }

        /* Prevent scrollbar issues on zoom */
        .fc-scroller {
            overflow: auto !important;
        }

        /* Left sidebar components – scrollable if needed */
        #filterCalendarContent {
            max-height: 100%;
            overflow-y: auto;
        }

        /* Mobile: sidebar becomes full width, stacks below calendar */
        @media (max-width: 1023px) {
            .grid.grid-cols-12 {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }
            .col-span-12.lg\:col-span-3,
            .col-span-12.lg\:col-span-9 {
                width: 100%;
                flex-shrink: 1;
            }
            /* Sidebar sections side by side on tablets */
            .col-span-12.lg\:col-span-3 {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 1rem;
            }
            .col-span-12.lg\:col-span-3 > div {
                flex: 1 1 280px;
            }
        }

        /* =====================================================
        DROPDOWN & MODAL Z-INDEX
        ===================================================== */
        #createDropdown { z-index: 9999 !important; }
        #createDropdown.flex { display: flex !important; flex-direction: column; }
        .calendar-modal { z-index: 9998 !important; }

        /* =====================================================
        MINI CALENDAR (compact, no events)
        ===================================================== */
        #miniCalendar {
            font-size: 0.75rem;
        }
        #miniCalendar .fc-toolbar {
            margin-bottom: 0.5rem;
        }
        #miniCalendar .fc-toolbar-title {
            font-size: 0.875rem;
            font-weight: 600;
        }
        #miniCalendar .fc-button {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            background: transparent;
            border: none;
            color: #374151;
        }
        #miniCalendar .fc-button:hover {
            background: #f3f4f6;
        }
        #miniCalendar .fc-daygrid-day {
            cursor: pointer;
        }
        #miniCalendar .fc-daygrid-day:hover {
            background: #f3f4f6;
        }
        #miniCalendar .fc-day-today {
            background: #3b82f6 !important;
            color: white;
            border-radius: 50%;
        }
        #miniCalendar .fc-day-today .fc-daygrid-day-number {
            color: white;
        }
        #miniCalendar .fc-daygrid-day-number {
            padding: 0.25rem;
            width: 1.75rem;
            height: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            border-radius: 50%;
        }
        #miniCalendar .mini-cal-selected .fc-daygrid-day-number {
            background: #dbeafe;
            color: #1d4ed8;
        }
        #miniCalendar .fc-col-header-cell-cushion {
            padding: 0.25rem;
            font-weight: 500;
            color: #6b7280;
        }
        #miniCalendar .fc-daygrid-day-events,
        #miniCalendar .fc-daygrid-day-bottom {
            display: none;
        }

        /* =====================================================
        COLLAPSIBLE FILTER PANEL
        ===================================================== */
        .collapsible-content {
            transition: all 0.2s ease-in-out;
        }
        .collapsible-icon {
            transition: transform 0.2s ease-in-out;
        }
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    @endpush
    </x-app-layout>