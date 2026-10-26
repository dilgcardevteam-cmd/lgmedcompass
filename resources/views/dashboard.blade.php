<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Base responsive styles */
    .table-row-hover-rounded {
    border-collapse: separate;
    border-spacing: 0;
}
tbody tr:hover td:first-child {
    border-top-left-radius: 0.75rem;
    border-bottom-left-radius: 0.75rem;
}
tbody tr:hover td:last-child {
    border-top-right-radius: 0.75rem;
    border-bottom-right-radius: 0.75rem;
}
    @keyframes glow-pulse {
        0% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.2); }
        50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.6); }
        100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.2); }
    }
    .urgent-glow { animation: glow-pulse 2s infinite ease-in-out; }
    
    /* Responsive scrollbar */
    .tactical-scroll::-webkit-scrollbar { width: 4px; }
    .tactical-scroll::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .tactical-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    .tactical-scroll::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    
    /* Mobile scrollbar */
    @media (max-width: 640px) {
        .tactical-scroll::-webkit-scrollbar { width: 3px; }
        .tactical-scroll::-webkit-scrollbar-track { background: #f9fafb; border-radius: 6px; }
        .tactical-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 6px; }
    }
    
    .event-item { cursor: pointer; transition: all 0.15s; }
    .event-item:hover { background-color: #f9fafb; }
    
    /* Responsive dashboard grid */
    .dashboard-grid {
        display: grid;
        gap: 1rem;
    }
    
    @media (min-width: 640px) {
        .dashboard-grid {
            gap: 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .dashboard-grid {
            gap: 2rem;
        }
    }
    
    /* Navigation cards */
    .nav-card {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background: white;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    @media (min-width: 640px) {
        .nav-card {
            padding: 1.5rem;
            border-radius: 0.875rem;
            gap: 1rem;
        }
    }
    
    .nav-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.06);
        transform: translateY(-2px);
    }
    
    /* Navigation icons */
    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        flex-shrink: 0;
    }
    
    @media (min-width: 640px) {
        .nav-icon {
            width: 3rem;
            height: 3rem;
        }
    }
    
    /* Navigation content */
    .nav-content h4 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    @media (min-width: 640px) {
        .nav-content h4 {
            font-size: 1rem;
        }
    }
    
    .nav-content p {
        font-size: 0.75rem;
        color: #6b7280;
        margin: 0;
    }
    
    @media (min-width: 640px) {
        .nav-content p {
            font-size: 0.875rem;
        }
    }
    
    /* Metrics cards */
    .metric-card {
        background: white;
        border: 1px solid #e5e7eb;
        padding: 1rem;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border-left: 4px solid #d1d5db;
    }
    
    @media (min-width: 640px) {
        .metric-card {
            padding: 1.5rem;
            border-radius: 0.875rem;
        }
    }
    
    .metric-card.green { border-left-color: #10b981; }
    .metric-card.orange { border-left-color: #f97316; }
    .metric-card.blue { border-left-color: #3b82f6; }
    
    .metric-label {
        font-size: 0.625rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    @media (min-width: 640px) {
        .metric-label {
            font-size: 0.75rem;
        }
    }
    
    .metric-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
    }
    
    @media (min-width: 640px) {
        .metric-value {
        font-size: 2rem;
        }
    }
    
    /* Tasks table */
    .tasks-table {
        width: 100%;
        text-align: left;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .tasks-table th {
        font-size: 0.625rem;
        font-weight: 800;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
        background: white;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    
    @media (min-width: 640px) {
        .tasks-table th {
            font-size: 0.6875rem;
        }
    }
    
    .tasks-table td {
        font-size: 0.75rem;
        padding: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
    }
    
    @media (min-width: 640px) {
        .tasks-table td {
            font-size: 0.875rem;
            padding: 1rem;
        }
    }
    
    .tasks-table tr:hover {
        background-color: rgba(250, 204, 25, 0.4);
        box-shadow: 0 0 15px rgba(234, 179, 8, 0.6);
        border-color: #fbbf24;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    /* Status badges */
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 1px solid;
    }
    
    @media (min-width: 640px) {
        .status-badge {
            padding: 0.375rem 0.75rem;
            font-size: 0.625rem;
        }
    }
    
    /* Chart container */
    .chart-container {
        height: 250px;
        min-height: 250px;
    }
    
    @media (min-width: 768px) {
        .chart-container {
            height: 300px;
            min-height: 300px;
        }
    }
    
    @media (min-width: 1024px) {
        .chart-container {
            height: 400px;
            min-height: 400px;
        }
    }
    
    /* Events sidebar */
    .events-sidebar {
        max-height: 200px;
    }
    
    @media (min-width: 640px) {
        .events-sidebar {
            max-height: 250px;
        }
    }
    
    @media (min-width: 1024px) {
        .events-sidebar {
            max-height: 320px;
        }
    }
    
    /* Welcome card */
    .welcome-card {
        background: white;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        border-radius: 0.75rem;
        padding: 1rem;
    }
    
    @media (min-width: 640px) {
        .welcome-card {
            border-radius: 0.875rem;
            padding: 1.5rem;
        }
    }
    
    /* Touch optimizations */
    @media (hover: none) and (pointer: coarse) {
        .nav-card:hover {
            transform: none;
        }
        
        .nav-card:active {
            transform: scale(0.98);
        }
        
        .tasks-table tr:hover {
            transform: none;
        }
        
        .tasks-table tr:active {
            transform: scale(0.98);
        }
    }
    .metric-card {
    min-height: 120px; /* Provides a uniform height without being excessive */
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>

<div class="py-4 sm:py-6 lg:py-10">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-6 lg:space-y-8">

    {{-- WELCOME CARD --}}
    <div class="welcome-card">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }} 👋</h3>
        <p class="text-sm sm:text-base text-gray-500 mt-1">Access your company tools and manage your tasks from here.</p>
    </div>
    
    {{-- NAVIGATION (EMPLOYEE) --}}
    @if(auth()->user()->role === 'Employee')
    <div class="dashboard-grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('documents.index') }}" class="nav-card">
            <div class="nav-icon bg-blue-100 text-blue-600">
                <x-heroicon-o-document-text class="w-5 h-5 sm:w-6 sm:h-6"/>
            </div>
            <div class="nav-content">
                <h4>Programs, Projects & Activities Tracker</h4>
                <p class="hidden xs:inline">Access company documents</p>
                <p class="xs:hidden sm:inline lg:hidden">PPAs Tracker</p>
            </div>
        </a>
        <a href="{{ route('calendar.index') }}" class="nav-card">
            <div class="nav-icon bg-green-100 text-green-600">
                <x-heroicon-o-calendar class="w-5 h-5 sm:w-6 sm:h-6"/>
            </div>
            <div class="nav-content">
                <h4>Calendar</h4>
                <p class="hidden xs:inline">View events and schedules</p>
                <p class="xs:hidden sm:inline lg:hidden">Events</p>
            </div>
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-card">
            <div class="nav-icon bg-purple-100 text-purple-600">
                <x-heroicon-o-user class="w-5 h-5 sm:w-6 sm:h-6"/>
            </div>
            <div class="nav-content">
                <h4>Profile</h4>
                <p class="hidden xs:inline">Manage your account</p>
                <p class="xs:hidden sm:inline lg:hidden">Profile</p>
            </div>
        </a>
    </div>
    @endif

   {{-- NAVIGATION (ADMIN) --}}
    @if(auth()->user()->role === 'Admin')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
        <a href="{{ route('account-management.index') }}" class="nav-card">
            <div class="nav-icon bg-red-100 text-red-600">
                <x-heroicon-o-users class="w-6 h-6"/>
            </div>
            <div class="nav-content">
                <h4 class="font-bold">Manage Users</h4>
                <p>Approve and manage accounts</p>
            </div>
        </a>
        <a href="{{ route('documents.index') }}" class="nav-card">
            <div class="nav-icon bg-blue-100 text-blue-600">
                <x-heroicon-o-document-text class="w-6 h-6"/>
            </div>
            <div class="nav-content">
                <h4 class="font-bold">Programs, Projects & Activities Tracker</h4>
                <p>Track and update files</p>
            </div>
        </a>
        <a href="{{ route('calendar.index') }}" class="nav-card">
            <div class="nav-icon bg-green-100 text-green-600">
                <x-heroicon-o-calendar class="w-6 h-6"/>
            </div>
            <div class="nav-content">
                <h4 class="font-bold">Calendar</h4>
                <p>Schedules and events</p>
            </div>
        </a>
    </div>
    @endif

   {{-- USER METRICS (ADMIN) --}}
    @if(auth()->user()->role === 'Admin')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
        
        {{-- Total Users Card --}}
        <div class="group relative overflow-hidden bg-white border border-gray-100 rounded-2xl p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-blue-200">
            <div class="absolute -right-4 -top-4 text-gray-50 transition-transform duration-500 group-hover:-rotate-12 group-hover:scale-110">
                <x-heroicon-s-users class="w-24 h-24"/>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-black text-gray-400 uppercase tracking-[0.15em] mb-1">Total System Users</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ $userStats['total'] }}</p>
                    <span class="text-xs font-medium text-gray-400">Accounts</span>
                </div>
                <div class="mt-4 h-1 w-12 bg-gray-200 rounded-full"></div>
            </div>
        </div>

        {{-- Approved Personnel Card --}}
        <div class="group relative overflow-hidden bg-white border border-gray-100 rounded-2xl p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-green-200">
            <div class="absolute -right-4 -top-4 text-green-50/50 transition-transform duration-500 group-hover:-rotate-12 group-hover:scale-110">
                <x-heroicon-s-check-badge class="w-24 h-24"/>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-black text-green-600/70 uppercase tracking-[0.15em] mb-1">Approved Personnel</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-green-600 tracking-tight">{{ $userStats['approved'] }}</p>
                    <x-heroicon-s-shield-check class="w-5 h-5 text-green-500"/>
                </div>
                <div class="mt-4 h-1 w-12 bg-green-500 rounded-full"></div>
            </div>
        </div>

        {{-- Pending Review Card --}}
        <div class="group relative overflow-hidden bg-white border border-gray-100 rounded-2xl p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-orange-200">
            <div class="absolute -right-4 -top-4 text-orange-50/50 transition-transform duration-500 group-hover:-rotate-12 group-hover:scale-110">
                <x-heroicon-s-clock class="w-24 h-24"/>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-black text-orange-600/70 uppercase tracking-[0.15em] mb-1">Pending Review</p>
                <div class="flex items-center gap-4">
                    <p class="text-4xl font-black text-orange-600 tracking-tight">{{ $userStats['pending'] }}</p>
                    @if($userStats['pending'] > 0)
                        <div class="flex items-center gap-1.5 px-2 py-1 bg-orange-100 rounded-full">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                            </span>
                            <span class="text-[10px] font-bold text-orange-700 uppercase">Action Required</span>
                        </div>
                    @endif
                </div>
                <div class="mt-4 h-1 w-12 {{ $userStats['pending'] > 0 ? 'bg-orange-500' : 'bg-gray-200' }} rounded-full"></div>
            </div>
        </div>

    </div>
    @endif
    
    {{-- DOCUMENT TRACKER (TASKS) --}}
@if(auth()->user()->role !== 'Pending')
<div class="bg-white border rounded-xl shadow-sm overflow-hidden">
    <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100 bg-gray-50/50">
        <h4 class="text-xs font-bold text-gray-500 uppercase tracking-widest flex items-center gap-2">
            <i class="bi bi-journal-text text-blue-600"></i> <span class="hidden xs:inline">My </span><span class="xs:hidden sm:inline lg:hidden">Tasks</span><span class="hidden lg:inline">My Tasks</span>
        </h4>
    </div>

    {{-- Scrollable table container with fixed header --}}
    <div class="tactical-scroll overflow-y-auto" style="max-height: 240px;">
        <table class="tasks-table">
            <thead class="sticky top-0 bg-white z-10 shadow-sm">
                <tr class="text-xs sm:text-[11px] font-black text-gray-400 uppercase tracking-wider border-b border-gray-100">
                    <th class="px-3 sm:px-6 py-2 sm:py-3 min-w-[120px] sm:min-w-[180px]">Document / Subject</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center min-w-[80px] sm:min-w-[100px]">Section</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center min-w-[60px] sm:min-w-[80px]">Due</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 text-center min-w-[60px] sm:min-w-[80px]">Status</th>
                </tr>
            </thead>
           <tbody class="divide-y divide-gray-100">
                @forelse($upcomingDeadlines as $doc)
                @php
                    $schedule = $doc->nextSchedule;
                    if ($schedule && $schedule->status === 'completed') {
                        $correctStatus = 'completed';
                    } elseif ($schedule && \Carbon\Carbon::parse($schedule->due_date)->isPast()) {
                        $correctStatus = 'overdue';
                    } else {
                        $correctStatus = 'pending';
                    }
                    $statusClasses = match($correctStatus) {
                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                        'overdue'   => 'bg-red-100 text-red-700 border-red-200 urgent-glow',
                        'pending'   => 'bg-amber-100 text-amber-700 border-amber-200',
                        default     => 'bg-gray-100 text-gray-600 border-gray-200',
                    };
                    $sectionName = 'Not assigned';
                    if (!empty($doc->section)) {
                        $section = \App\Models\Section::find($doc->section);
                        $sectionName = $section ? $section->name : 'Unknown section';
                    }
                @endphp
                <tr class="hover:bg-[#FACA19]/40 transition-all duration-200 cursor-pointer hover:shadow-[0_0_15px_rgba(234,179,8,0.6)] hover:border-yellow-300"
                    data-id="{{ $doc->id }}"
                    onclick="window.location.href = '{{ route('documents.index') }}'">
                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                        <div class="text-sm sm:text-base font-bold text-gray-800 truncate max-w-[200px] sm:max-w-none">{{ $doc->subject_title }}</div>
                        <div class="text-[10px] sm:text-[11px] text-gray-400 uppercase tracking-tighter truncate max-w-[150px] sm:max-w-none">Focal: {{ $doc->focal_person }}</div>
                        <p class="text-xs text-gray-500 italic sm:hidden mt-1">
                            "{{ Str::limit($doc->remarks ?? 'No remarks', 30) }}"
                        </p>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-4">
                        <p class="text-sm text-gray-700 truncate max-w-[100px] sm:max-w-none">{{ $sectionName }}</p>
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                        @if($schedule)
                            <div class="text-sm sm:text-base font-semibold {{ $correctStatus === 'overdue' ? 'text-red-600' : 'text-gray-700' }}">
                                {{ \Carbon\Carbon::parse($schedule->due_date)->format('M d, Y') }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] text-gray-400 uppercase tracking-widest hidden sm:block">Target Date</div>
                        @else
                            <span class="text-xs text-gray-300 italic">No schedule set</span>
                        @endif
                    </td>
                    <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                        <span class="status-badge px-2 sm:px-3 py-1 rounded-full text-[10px] font-black uppercase border {{ $statusClasses }}">
                            {{ ucfirst($correctStatus) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 sm:px-12 text-center">
                        <i class="bi bi-inbox text-3xl sm:text-4xl text-gray-200"></i>
                        <p class="text-sm text-gray-400 mt-2">No active documents to track.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
    {{-- WORKLOAD & SIDEBAR --}}
    @if(auth()->user()->role !== 'Pending')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        
        {{-- Workload Graph --}}
        <div class="lg:col-span-2 bg-white border rounded-xl p-4 sm:p-6 shadow-sm flex flex-col">
            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 sm:mb-4 flex items-center gap-2">
                <i class="bi bi-graph-up-arrow"></i> <span class="hidden xs:inline">5-Day </span><span class="xs:hidden sm:inline lg:hidden">Outlook</span><span class="hidden lg:inline">5-Day Outlook</span>
            </h4>
            <div class="chart-container">
                <canvas id="tacticalWorkloadChart"></canvas>
            </div>
        </div>

        {{-- Right Sidebar --}}
        <div class="space-y-4 sm:space-y-6">
            {{-- UPCOMING EVENTS (from Calendar) --}}
            <div class="bg-white border rounded-xl p-4 sm:p-5 shadow-sm">
                <h4 class="text-xs font-bold text-green-600 uppercase mb-3 flex items-center gap-2">
                    <i class="bi bi-calendar-event"></i> <span class="hidden xs:inline">Upcoming </span><span class="xs:hidden sm:inline lg:hidden">Events</span><span class="hidden lg:inline">Upcoming Events</span>
                </h4>
                <div class="tactical-scroll overflow-y-auto events-sidebar pr-2 space-y-3" id="dashboardUpcomingEvents">
                    <p class="text-xs text-gray-400 italic text-center py-2">Loading events...</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- PENDING USER MESSAGE --}}
    @if(auth()->user()->role === 'Pending')
    <div class="flex justify-center">
        <div class="w-full max-w-xl bg-white border border-yellow-200 rounded-xl shadow-md p-6 sm:p-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full"><x-heroicon-o-clock class="w-6 h-6"/></div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Account Pending Approval</h3>
                    <p class="text-sm text-gray-500">Your account is waiting for administrator approval.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
</div>

{{-- INCLUDE VIEW MODAL (same as calendar) --}}
@include('calendar.partials.view-modal')

{{-- SCRIPTS --}}
@push('scripts')
<script src="{{ asset('js/calendar.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
        // Chart initialization – safe against multiple runs
    const canvas = document.getElementById('tacticalWorkloadChart');
    if (canvas) {
        // Destroy existing Chart.js instance attached to this canvas
        let existingChart = Chart.getChart(canvas);   // Chart.js v3+
        if (existingChart) {
            existingChart.destroy();
        }
        // Fallback for custom property (if you ever stored it manually)
        if (canvas.chart) {
            canvas.chart.destroy();
        }

        const ctx = canvas.getContext('2d');
        const newChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($graphData['labels']) !!},
                datasets: [
                    { label: 'Calendar Events', data: {!! json_encode($graphData['events']) !!}, backgroundColor: '#10b981', borderRadius: 6 },
                    { label: 'Tasks/Docs', data: {!! json_encode($graphData['docs']) !!}, backgroundColor: '#3b82f6', borderRadius: 6 },
                    { label: 'New Users', data: {!! json_encode($graphData['new_users']) !!}, backgroundColor: '#f59e0b', borderRadius: 6 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1, color: '#9ca3af' }, grid: { borderDash: [5, 5] } },
                    x: { ticks: { color: '#9ca3af' }, grid: { display: false } }
                },
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } }
            }
        });

        // Store reference for potential future cleanup
        canvas.chart = newChart;
    }

    // =========================================================
    // UPCOMING EVENTS – FULL WEEK (next 7 days) – FIXED TIMEZONE
    // =========================================================
    const container = document.getElementById('dashboardUpcomingEvents');
    if (!container) return;

    // Helper: get local 'YYYY-MM-DD' from a UTC ISO string
    function getLocalDateKeyFromIso(isoString) {
        const date = new Date(isoString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Helper: get today's local date as YYYY-MM-DD
    function getLocalTodayKey() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Helper: add days to a local YYYY-MM-DD date string
    function addDaysToDateKey(dateKey, days) {
        const [y, m, d] = dateKey.split('-').map(Number);
        const date = new Date(y, m - 1, d);
        date.setDate(date.getDate() + days);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Fetch all calendar events
    fetch('/calendar/events')
        .then(res => res.json())
        .then(events => {
            const todayKey = getLocalTodayKey();
            const nextWeekKey = addDaysToDateKey(todayKey, 7);

            // Filter events that start within the next 7 days (including today)
            const weekEvents = events.filter(event => {
                const eventDateKey = getLocalDateKeyFromIso(event.start);
                return eventDateKey >= todayKey && eventDateKey < nextWeekKey;
            });

            // Sort by start time (ISO string works fine as sort key)
            weekEvents.sort((a, b) => new Date(a.start) - new Date(b.start));

            // Group by local date key
            const grouped = {};
            weekEvents.forEach(event => {
                const dateKey = getLocalDateKeyFromIso(event.start);
                if (!grouped[dateKey]) grouped[dateKey] = [];
                grouped[dateKey].push(event);
            });

            container.innerHTML = '';

            if (Object.keys(grouped).length === 0) {
                container.innerHTML = '<p class="text-xs text-gray-400 italic text-center py-2">No events in the coming week.</p>';
                return;
            }

            const tomorrowKey = addDaysToDateKey(todayKey, 1);

            // Render a single event
            function renderEvent(event, isToday, isTomorrow) {
                const div = document.createElement('div');
                div.className = `event-item p-3 rounded-lg border transition-all duration-300 cursor-pointer`;
                div.setAttribute('onclick', `openViewModalById(${event.id}, true)`);

                let glowClass = '';
                let timeText = '';
                if (isToday) {
                    glowClass = 'urgent-glow bg-green-50 border-green-200';
                    timeText = 'Today';
                } else if (isTomorrow) {
                    glowClass = 'bg-yellow-50 border-yellow-200';
                    div.style.boxShadow = '0 0 8px rgba(234,179,8,0.4)';
                    timeText = 'Tomorrow';
                } else {
                    glowClass = 'bg-gray-50 border-gray-100';
                    const eventDate = new Date(event.start);
                    timeText = eventDate.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
                }

                div.className += ` ${glowClass}`;

                // Time range formatting
                const startDate = new Date(event.start);
                const endDate = event.end ? new Date(event.end) : null;
                let timeRange = '';
                if (endDate && startDate.toDateString() === endDate.toDateString()) {
                    const startTime = startDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                    const endTime = endDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                    timeRange = `${startTime} – ${endTime}`;
                } else if (endDate) {
                    const startTime = startDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                    timeRange = `${startTime} onwards`;
                } else {
                    const startTime = startDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                    timeRange = startTime;
                }

                function escapeHtml(str) {
                    if (!str) return '';
                    return str.replace(/[&<>]/g, function(m) {
                        if (m === '&') return '&amp;';
                        if (m === '<') return '&lt;';
                        if (m === '>') return '&gt;';
                        return m;
                    });
                }

                div.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full" style="background:${event.color || '#3788d8'}"></span>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">${escapeHtml(event.title)}</p>
                            ${event.extendedProps?.label ? `<p class="text-xs text-gray-600">${escapeHtml(event.extendedProps.label)}</p>` : ''}
                            <p class="text-xs ${isToday ? 'text-green-700 font-semibold' : (isTomorrow ? 'text-yellow-700 font-semibold' : 'text-gray-500')}">
                                ${timeText} • ${timeRange}
                            </p>
                        </div>
                        ${isToday ? `
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                        ` : (isTomorrow ? `
                            <span class="relative flex h-3 w-3">
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                            </span>
                        ` : '')}
                    </div>
                `;
                return div;
            }

            // Render each date group
            for (const [dateKey, evts] of Object.entries(grouped)) {
                const isToday = (dateKey === todayKey);
                const isTomorrow = (dateKey === tomorrowKey);

                if (!isToday && !isTomorrow) {
                    const header = document.createElement('p');
                    header.className = 'text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-3 mb-2';
                    const displayDate = new Date(dateKey + 'T12:00:00'); // noon to avoid timezone shift
                    header.textContent = displayDate.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric' });
                    container.appendChild(header);
                } else if (isToday) {
                    const header = document.createElement('p');
                    header.className = 'text-[10px] font-bold text-green-600 uppercase tracking-wider mt-1 mb-2';
                    header.textContent = 'Today';
                    container.appendChild(header);
                } else if (isTomorrow) {
                    const header = document.createElement('p');
                    header.className = 'text-[10px] font-bold text-yellow-600 uppercase tracking-wider mt-3 mb-2';
                    header.textContent = 'Tomorrow';
                    container.appendChild(header);
                }

                evts.forEach(event => {
                    container.appendChild(renderEvent(event, isToday, isTomorrow));
                });
            }
        })
        .catch(err => {
            console.error('Failed to load week events:', err);
            container.innerHTML = '<p class="text-xs text-red-400 italic text-center py-2">Unable to load events.</p>';
        });

    // Helper function to open view modal by ID (must be globally available)
    window.openViewModalById = async function(id, fromDashboard = false) {
        try {
            const response = await fetch(`/calendar/events/${id}`);
            const event = await response.json();
            if (typeof openViewModal === 'function') {
                openViewModal({ id: event.id, title: event.title, start: event.start_date, end: event.end_date, extendedProps: event }, fromDashboard);
            } else {
                console.error('openViewModal function not found.');
            }
        } catch (error) {
            console.error('Error fetching event:', error);
        }
    };
});
</script>
@endpush
</x-app-layout>