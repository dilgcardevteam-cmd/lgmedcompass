<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Return Blade view
    public function page()
    {
        $sections = Section::all();
        $users = User::with('section')->get();

        return view('calendar.index', compact('sections', 'users'));
    }

    // Return JSON events

    public function index()
    {
        $user = auth()->user();

        $events = Event::visibleTo($user)
            ->with(['section', 'focalPerson', 'focalPersons', 'user'])
            ->latest()
            ->get()
            ->map(function ($event) {
                $start = $event->start_date;   // Carbon instance (UTC by default)
                $end = $event->end_date;

                // Detect all‑day: both times are exactly midnight
                $isAllDay = $start->format('H:i:s') === '00:00:00'
                        && $end->format('H:i:s') === '00:00:00';

                if ($isAllDay) {
                    $startFormatted = $start->format('Y-m-d');
                    // FullCalendar exclusive end → add one day
                    $endFormatted = $end->copy()->addDay()->format('Y-m-d');
                } else {
                    // Timed event → convert to Asia/Manila & output with offset
                    $startFormatted = $start->setTimezone('Asia/Manila')
                        ->format('Y-m-d\TH:i:sP');
                    $endFormatted = $end->setTimezone('Asia/Manila')
                        ->format('Y-m-d\TH:i:sP');
                }

                return [
                    'id' => $event->id,
                    'title' => $event->title,

                    'start' => $startFormatted,
                    'end' => $endFormatted,

                    'color' => $event->calendar_color,

                    'type' => $event->type,
                    'leave_type' => $event->leave_type,
                    'leave_type_other' => $event->leave_type_other,
                    'location' => $event->location,
                    'link' => $event->link,
                    'notes' => $event->notes,
                    'visibility_type' => $event->visibility_type,
                    'section' => $event->section?->name,
                    'focal_person' => $event->focalPersonNames(),
                    'created_by' => $event->user?->name,
                ];
            });

        return response()->json($events);
    }

    public function store(StoreEventRequest $request)
    {
        $type = $request->type;
        $visibilityType = $request->visibility_type;

        $sectionId = null;
        $focalPersonId = null;
        $focalPersonIds = in_array($type, ['leave', 'official_business'], true)
            ? array_values(array_unique($request->input('focal_person_ids', [])))
            : array_values(array_filter([$request->input('focal_person_id')]));

        /*
        |--------------------------------------------------------------------------
        | TYPE LOGIC
        |--------------------------------------------------------------------------
        */

        switch ($type) {

            case 'event':

                if ($visibilityType === 'section') {
                    $sectionId = $request->section_id;
                }

                break;

            case 'leave':
                $focalPersonId = $focalPersonIds[0] ?? null;

                // Auto-assign section from selected user
                $sectionId = User::findOrFail($focalPersonId)->section_id;

                // These types are always section-based
                $visibilityType = 'section';

                break;
            case 'offsite':
            case 'official_business':

                $focalPersonId = $focalPersonIds[0] ?? null;

                // Auto-assign section from selected user
                $sectionId = User::findOrFail($focalPersonId)->section_id;

                // These types are always section-based
                $visibilityType = 'section';

                break;

            case 'holiday':

                // Always global
                $visibilityType = 'global';
                $sectionId = null;
                $focalPersonId = null;

                break;
        }

        // ---------- Handle all-day: force 8:00 AM – 5:00 PM Manila time ----------
        if ($request->has('all_day') && $request->all_day) {
            $manilaTz = 'Asia/Manila';
            $appTz = config('app.timezone', 'UTC');

            $startDate = Carbon::parse($request->start_date, $manilaTz)
                ->setTime(8, 0, 0)
                ->setTimezone($appTz);
            $endDate = Carbon::parse($request->end_date, $manilaTz)
                ->setTime(17, 0, 0)
                ->setTimezone($appTz);

            // Override the request values so they are used in create()
            $request->merge([
                'start_date' => $startDate->toDateTimeString(),
                'end_date' => $endDate->toDateTimeString(),
            ]);
        }
        // -------------------------------------------------------------------------
        /*
        |--------------------------------------------------------------------------
        | CREATE EVENT
        |--------------------------------------------------------------------------
        */

        $event = Event::create([
            'title' => $request->title,
            'type' => $type,
            'leave_type' => $type === 'leave' ? $request->leave_type : null,
            'leave_type_other' => $type === 'leave' && $request->leave_type === 'Others, specify'
                ? $request->leave_type_other
                : null,
            'link' => $request->link,
            'location' => $request->location,
            'notes' => $request->notes,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'visibility_type' => $visibilityType,
            'section_id' => $visibilityType === 'section' ? $sectionId : null,
            'focal_person_id' => $focalPersonId,
            'user_id' => auth()->id(),
        ]);
        $event->focalPersons()->sync($focalPersonIds);

        return response()->json($event->load(['section', 'focalPersons']), 201);
    }

    public function todayEvents()
    {
        $user = auth()->user();
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();
        $endOfTomorrow = now()->addDay()->endOfDay();

        $events = collect();

        // Get today's events - visible to user
        $todayEvents = Event::visibleTo($user)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->with(['section', 'focalPerson', 'focalPersons'])
            ->get();

        // Get tomorrow's events (excluding those already in today)
        $tomorrowEvents = Event::visibleTo($user)
            ->whereDate('start_date', '<=', $endOfTomorrow)
            ->whereDate('end_date', '>=', $tomorrow)
            ->whereNotIn('id', $todayEvents->pluck('id'))
            ->with(['section', 'focalPerson', 'focalPersons'])
            ->get();

        // Format today's events
        foreach ($todayEvents as $event) {
            $start = $event->start_date;
            $end = $event->end_date;
            $isAllDay = $start->format('H:i:s') === '00:00:00' && $end->format('H:i:s') === '00:00:00';
            $timeDisplay = $isAllDay ? 'All day' : $start->format('g:i A').' - '.$end->format('g:i A');

            // Determine if this event is specifically for the current user as focal person
            $isFocalPerson = $event->focal_person_id === $user->id
                || $event->focalPersons->contains('id', $user->id);

            // Determine the label
            $label = null;
            if ($isFocalPerson) {
                $label = 'For: '.$user->name;
            } elseif ($event->section) {
                $label = $event->section->name;
            }

            $events->push([
                'id' => $event->id,
                'dismissKey' => "event-{$event->id}-{$today->format('Y-m-d')}",
                'title' => $event->title,
                'type' => $event->type,
                'color' => $event->calendar_color ?? '#3b82f6',
                'time' => $timeDisplay,
                'section' => $label,
                'url' => route('calendar.index').'?event='.$event->id,
                'is_tomorrow' => false,
                'is_focal_person' => $isFocalPerson,
                'focal_person_name' => $isFocalPerson ? $user->name : $event->focalPersonNames(),
            ]);
        }

        // Format tomorrow's events
        foreach ($tomorrowEvents as $event) {
            $start = $event->start_date;
            $end = $event->end_date;
            $isAllDay = $start->format('H:i:s') === '00:00:00' && $end->format('H:i:s') === '00:00:00';
            $timeDisplay = $isAllDay ? 'All day' : $start->format('g:i A').' - '.$end->format('g:i A');

            // Determine if this event is specifically for the current user as focal person
            $isFocalPerson = $event->focal_person_id === $user->id
                || $event->focalPersons->contains('id', $user->id);

            // Determine the label
            $label = null;
            if ($isFocalPerson) {
                $label = 'For: '.$user->name;
            } elseif ($event->section) {
                $label = $event->section->name;
            }

            $events->push([
                'id' => $event->id,
                'dismissKey' => "event-{$event->id}-{$tomorrow->format('Y-m-d')}",
                'title' => $event->title,
                'type' => $event->type,
                'color' => $event->calendar_color ?? '#3b82f6',
                'time' => $timeDisplay,
                'section' => $label,
                'url' => route('calendar.index').'?event='.$event->id,
                'is_tomorrow' => true,
                'is_focal_person' => $isFocalPerson,
                'focal_person_name' => $isFocalPerson ? $user->name : $event->focalPersonNames(),
            ]);
        }

        return response()->json($events);
    }

    public function upcoming()
    {
        $user = auth()->user();

        $today = Carbon::now('Asia/Manila')->startOfDay();
        $tomorrow = Carbon::now('Asia/Manila')->addDay()->startOfDay();

        $events = Event::visibleTo($user)
            ->with(['section', 'focalPerson'])
            ->whereDate('start_date', '<=', $tomorrow)
            ->whereDate('end_date', '>=', $today)
            ->get();

        $formatted = $events->map(function ($event) {

            $start = $event->start_date->timezone('Asia/Manila');
            $end = $event->end_date->timezone('Asia/Manila');

            $isToday = $start->isToday() || $end->isToday();
            $isTomorrow = ! $isToday && ($start->isTomorrow() || $end->isTomorrow());

            $time = $start->isSameDay($end)
                ? $start->format('h:i A').' - '.$end->format('h:i A')
                : $start->format('M d h:i A').' - '.$end->format('M d h:i A');

            return [
                'title' => $event->title,
                'date' => $start->format('M d, Y'),
                'time' => $time,
                'type' => $event->type,
                'color' => $event->calendar_color,
                'label' => $event->isSection()
                                    ? optional($event->section)->name
                                    : optional($event->focalPerson)->name,
                'is_today' => $isToday,
                'is_tomorrow' => $isTomorrow,
            ];
        });

        return response()->json($formatted);
    }

    public function show(Event $event)
    {
        $event->load(['user', 'section', 'focalPerson', 'focalPersons']);

        $start = $event->start_date;
        $end = $event->end_date;
        $manilaStart = $start->copy()->setTimezone('Asia/Manila');
        $manilaEnd = $end->copy()->setTimezone('Asia/Manila');

        $isAllDay = $manilaStart->format('H:i') === '08:00'
                && $manilaEnd->format('H:i') === '17:00'
                && $manilaStart->isSameDay($manilaEnd);

        // ---------- FullCalendar date-only format ----------
        if ($isAllDay) {
            $startFC = $start->format('Y-m-d');
            $endFC = $end->copy()->addDay()->format('Y-m-d');
        } else {
            $startFC = $start->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:sP');
            $endFC = $end->setTimezone('Asia/Manila')->format('Y-m-d\TH:i:sP');
        }

        // ---------- View modal timed format (for 8‑5 display) ----------
        // Always provide the local Manila datetime string with time zone offset
        $startModal = $manilaStart->format('Y-m-d\TH:i:sP');
        $endModal = $manilaEnd->format('Y-m-d\TH:i:sP');

        return response()->json([
            'id' => $event->id,
            'title' => $event->title,
            'type' => $event->type,
            'leave_type' => $event->leave_type,
            'leave_type_other' => $event->leave_type_other,
            'location' => $event->location,
            'link' => $event->link,
            'notes' => $event->notes,
            'focal_person' => $event->focalPersonNames(),
            'focal_person_names' => $event->focalPersonNameList(),
            'focal_person_id' => $event->focal_person_id,
            'focal_person_ids' => $event->focalPersonIds(),
            'created_by' => $event->user?->name,
            'visibility_type' => $event->visibility_type,
            'section_id' => $event->section_id,

            // For FullCalendar
            'start' => $startFC,
            'end' => $endFC,

            // For the view modal (now includes time)
            'start_date' => $startModal,
            'end_date' => $endModal,

            'is_all_day' => $isAllDay,
            'start_display' => $start->format('Y-m-d'),
            'end_display' => $end->format('Y-m-d'),
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Event $event)
    {
        \Log::info('Update request received:', [
            'event_id' => $event->id,
            'all_data' => $request->all(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'focal_person_id' => $request->focal_person_id,
        ]);
        $rules = [
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'notes' => 'nullable|string',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        if (in_array($event->type, ['leave', 'official_business'], true)) {
            $rules['focal_person_ids'] = ['required', 'array', 'min:1'];
            $rules['focal_person_ids.*'] = ['required', 'integer', 'distinct', 'exists:users,id'];
        } else {
            $rules['focal_person_id'] = ['nullable', 'integer', 'exists:users,id'];
        }

        if ($event->type === 'leave') {
            $rules['leave_type'] = ['required', 'string', Rule::in(Event::LEAVE_TYPES)];
            $rules['leave_type_other'] = [
                'nullable',
                'string',
                'max:255',
                Rule::requiredIf($request->input('leave_type') === 'Others, specify'),
            ];
        }

        $validated = $request->validate($rules);

        $start = $request->start_date;
        $end = $request->end_date;

        // If the all‑day checkbox was sent, force the times to 8AM-5PM Manila time
        if ($request->has('all_day') && $request->all_day) {
            $manilaTz = 'Asia/Manila';
            $appTz = config('app.timezone', 'UTC');

            $start = Carbon::parse($start, $manilaTz)
                ->setTime(8, 0, 0)
                ->setTimezone($appTz)
                ->toDateTimeString();
            $end = Carbon::parse($end, $manilaTz)
                ->setTime(17, 0, 0)
                ->setTimezone($appTz)
                ->toDateTimeString();

            // Push the corrected values back into the request
            $request->merge(['start_date' => $start, 'end_date' => $end]);
        }

        $type = $event->type;

        $sectionId = $request->section_id;
        $focalPersonIds = in_array($type, ['leave', 'official_business'], true)
            ? array_values(array_unique($validated['focal_person_ids']))
            : array_values(array_filter([$validated['focal_person_id'] ?? null]));
        $focalPersonId = $focalPersonIds[0] ?? null;
        $visibilityType = $request->visibility_type;

        switch ($type) {

            case 'event':
                if ($visibilityType === 'section') {
                    $sectionId = $request->section_id;
                }
                break;

            case 'leave':
            case 'offsite':
            case 'official_business':

                $focalPersonId = $focalPersonIds[0] ?? null;

                if ($focalPersonId) {
                    $sectionId = User::findOrFail($focalPersonId)->section_id;
                }

                $visibilityType = 'section';

                break;

            case 'holiday':

                $visibilityType = 'global';
                $sectionId = null;
                $focalPersonId = null;

                break;
        }

        $event->update([
            'title' => $request->title,
            'leave_type' => $type === 'leave' ? $validated['leave_type'] : null,
            'leave_type_other' => $type === 'leave' && $validated['leave_type'] === 'Others, specify'
                ? $validated['leave_type_other']
                : null,
            'location' => $request->location,
            'link' => $request->link,
            'notes' => $request->notes,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'visibility_type' => $visibilityType,
            'section_id' => $sectionId,
            'focal_person_id' => $focalPersonId,
        ]);
        $event->focalPersons()->sync($focalPersonIds);

        return response()->json(['success' => true]);
    }
}
