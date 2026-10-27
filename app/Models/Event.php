<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title',
        'type',
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
