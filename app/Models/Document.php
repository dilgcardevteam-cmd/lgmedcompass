<?php

// app/Models/Document.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'subject_title',
        'section',
        'frequency',
        'who_will_comply',
        'who_will_comply_other',
        'focal_person',
        'reference',
        'mode_of_submission',
        'cy_link',
        'remarks',
        'file_path',
        'document_link',
        'progress',
        'status',
        'deadlines',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_archived' => 'boolean',
        'deadlines' => 'array',
        'who_will_comply' => 'array',
    ];

    public function focalPerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'focal_person');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DocumentSchedule::class);
    }

    public function assignment(): HasOne
    {
        return $this->hasOne(DocumentAssignment::class);
    }

    public function workflowLogs(): HasMany
    {
        return $this->hasMany(DocumentWorkflowLog::class)->latest();
    }

    // ✅ NEW: Relationship to Report
    public function report(): HasOne
    {
        // Assuming each document has one report (adjust if needed)
        return $this->hasOne(Report::class);
        // If foreign key is not 'document_id', specify: return $this->hasOne(Report::class, 'doc_id', 'id');
    }

    // Helper to get current assignee
    public function getCurrentAssigneeAttribute(): ?User
    {
        return $this->assignment?->assignedTo;
    }

    // Helper to get current workflow status
    public function getCurrentWorkflowStatusAttribute(): string
    {
        return $this->assignment?->workflow_status ?? 'Draft';
    }

    // Helper to get last comment
    public function getLastCommentAttribute(): ?string
    {
        return $this->assignment?->last_comment;
    }

    public function getEffectiveProgressAttribute(): int
    {
        $schedules = $this->relationLoaded('schedules')
            ? $this->schedules
            : $this->schedules()->get(['status']);

        $totalSchedules = $schedules->count();

        if ($totalSchedules === 0) {
            return 0;
        }

        $completedSchedules = $schedules
            ->where('status', 'completed')
            ->count();

        return (int) round(($completedSchedules / $totalSchedules) * 100);
    }

    public function getProgressColorAttribute(): string
    {
        $progress = $this->effective_progress;

        if ($progress >= 100) {
            return '#6BBF8A';
        }

        if ($progress >= 70) {
            return '#7BA4E8';
        }

        if ($progress >= 30) {
            return '#F9BD56';
        }

        if ($progress > 0) {
            return '#FF875C';
        }

        return '#B9BFCA';
    }

    // public function latestSchedule(): HasOne
    // {
    //     return $this->hasOne(DocumentSchedule::class)->latestOfMany();
    // }
    public function nextSchedule()
    {
        return $this->hasOne(DocumentSchedule::class)
            ->where('status', '!=', 'completed')   // exclude finished periods
            ->orderBy('due_date', 'asc');           // earliest upcoming first
    }
}
