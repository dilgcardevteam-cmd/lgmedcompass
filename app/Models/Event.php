<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    public const LEAVE_TYPES = [
        'Vacation Leave',
        'Mandatory/Forced Leave',
        'Sick Leave',
        'Maternity Leave',
        'Paternity Leave',
        'Special Priviledge Leave',
        'Solo Parent Leave',
        'Study Leave',
        '10-Day VAWC Leave',
        'Rehabilitation Priviledge',
        'Special Leave Benefits for Women',
        'Special Emergency (Calamity) Leave',
        'Adoption Leave',
        'Wellness Leave',
        'Others, specify',
    ];

    protected $fillable = [
        'title',
        'type',
        'leave_type',
        'leave_type_other',
        'link',
        'location',
        'notes',
        'start_date',
        'end_date',
        'section_id',
        'focal_person_id',
        'user_id',
        'visibility_type',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function focalPerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'focal_person_id');
    }

    public function focalPersons(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_focal_persons')
            ->withTimestamps();
    }

    /**
     * @return list<int|string>
     */
    public function focalPersonIds(): array
    {
        $ids = $this->focalPersons->modelKeys();

        if ($ids !== []) {
            return $ids;
        }

        return $this->focal_person_id === null ? [] : [(int) $this->focal_person_id];
    }

    public function focalPersonNames(): string
    {
        return implode(', ', $this->focalPersonNameList());
    }

    /**
     * @return list<string>
     */
    public function focalPersonNameList(): array
    {
        if ($this->focalPersons->isNotEmpty()) {
            return $this->focalPersons->pluck('name')->all();
        }

        return $this->focalPerson === null ? [] : [$this->focalPerson->name];
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes (Security Layer)
    |--------------------------------------------------------------------------
    */

    public function scopeVisibleTo($query, $user)
    {
        return $query->where(function ($query) use ($user) {

            $query->where('user_id', $user->id) // Private (owner)
                ->orWhere('visibility_type', 'global') // Global
                ->orWhere('visibility_type', 'section'); // Section (visible to all)
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPrivate()
    {
        return $this->visibility_type === 'private';
    }

    public function isSection()
    {
        return $this->visibility_type === 'section';
    }

    public function isGlobal()
    {
        return $this->visibility_type === 'global';
    }

    /*
    |--------------------------------------------------------------------------
    | Calendar Color Logic
    |--------------------------------------------------------------------------
    */

    public function getCalendarColorAttribute()
    {
        // Special types override everything
        if ($this->type === 'holiday') {
            return '#d32f2f';
        }

        if ($this->type === 'offsite') {
            return '#5c6bc0';
        }

        if ($this->type === 'official_business') {
            return '#0f766e';
        }

        if ($this->type === 'leave') {
            return '#f9a825';
        }

        // Visibility-based coloring
        switch ($this->visibility_type) {

            case 'global':
                return '#FFD700'; // Gold

            case 'section':
                return optional($this->section)->color ?? '#3b82f6';

            case 'private':
            default:
                return '#067a10ff'; // Neutral gray
        }
    }
}
