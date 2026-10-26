<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentSchedule;
use App\Models\Event;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. DATA FOR THE GRAPH (unchanged)
        $graphData = [
            'labels' => [],
            'events' => [],
            'docs' => [],
            'new_users' => [],
        ];

        for ($i = 0; $i < 5; $i++) {
            $date = Carbon::today()->addDays($i);
            $graphData['labels'][] = $date->format('D (M j)');
            $graphData['events'][] = Event::whereDate('start_date', $date->format('Y-m-d'))->count();
            $graphData['docs'][] = Document::whereDate('created_at', $date->format('Y-m-d'))->count();
            $graphData['new_users'][] = User::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        // 2. USER STATS (unchanged)
        $userStats = [
            'total' => User::count(),
            'approved' => User::whereIn('role', ['Admin', 'Employee'])->count(),
            'pending' => User::where('role', 'Pending')->count(),
        ];

        // 3. UPCOMING EVENTS (unchanged)
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // =========================================================
        // SORT DOCUMENTS BY NEAREST DUE DATE (same as DocumentController)
        // =========================================================
        $documentsQuery = Document::where('status', '!=', 'draft')
            ->whereHas('schedules', function ($q) {
                // Only documents that have at least one pending/overdue schedule
                $q->whereIn('status', ['pending', 'overdue', null]);
            });

        // Add subquery to get the earliest due date (nearest deadline)
        $documentsQuery->addSelect([
            'next_due_date' => DocumentSchedule::selectRaw('MIN(due_date)')
                ->whereColumn('document_id', 'documents.id')
                ->whereIn('status', ['pending', 'overdue', null])
                ->limit(1),
        ]);

        // 👤 ROLE-BASED DOCUMENT FILTER
        // Use case-insensitive matching with trim to handle role name variations
        $userRole = strtolower(trim($user->role));
        $chiefRoles = ['admin', 'division chief', 'assistant division chief', 'divisionchief', 'assistantdivisionchief'];

        // Check if user's section_id is 1 or 2, or if their role is a chief role
        if (in_array($user->section_id, [1, 2]) || in_array($userRole, $chiefRoles)) {
            // Users with section_id 1 or 2, or chief roles, see ALL documents
            // No section filter applied by default
        } else {
            // Regular users see only documents from their section
            // Role-based filter takes precedence over URL parameters
            $documentsQuery->where('section', $user->section_id);
        }

        // Order by nearest due date first, then by creation date (newest first)
        $documentsQuery->orderByRaw('CASE WHEN next_due_date IS NULL THEN 1 ELSE 0 END')
            ->orderBy('next_due_date', 'asc')
            ->orderBy('documents.created_at', 'desc');

        $upcomingDeadlines = $documentsQuery
            ->with('nextSchedule')
            ->take(10)
            ->get();

        return view('dashboard', compact('graphData', 'userStats', 'upcomingEvents', 'upcomingDeadlines'));
    }
}
