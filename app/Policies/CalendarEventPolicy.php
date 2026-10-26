<?php

namespace App\Policies;

use App\Models\CalendarEvent;
use App\Models\User;

class CalendarEventPolicy
{
    /**
     * Determine if the user can view any calendar events.
     */
    public function viewAny(User $user): bool
    {
        // Technical Inspector can see the calendar page, but private events will be filtered
        return in_array($user->role, ['Admin', 'Employee', 'Technical Inspector']);
    }

    /**
     * Determine if the user can view a specific calendar event.
     */
    public function view(User $user, CalendarEvent $event): bool
    {
        // Private events: only the creator and Admins can see them
        if ($event->visibility === 'private') {
            return $user->id === $event->user_id || $user->role === 'Admin';
        }

        // Public events: everyone (including Technical Inspector) can see
        return true;
    }

    /**
     * Block all write operations for Technical Inspector.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function update(User $user, CalendarEvent $event): bool
    {
        return $user->role !== 'Technical Inspector';
    }

    public function delete(User $user, CalendarEvent $event): bool
    {
        return $user->role !== 'Technical Inspector';
    }
}
