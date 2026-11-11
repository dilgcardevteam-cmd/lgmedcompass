<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceRequestFactory> */
    use HasFactory;

    public const SERVICE_TYPE_DATA_ANALYSIS = 'Data Analysis';

    public const SERVICE_TYPE_OTHERS = 'Others';

    public const ANALYSIS_TYPES = [
        'Descriptive Analysis',
        'Diagnostic Analysis',
        'Explanatory Data Analysis',
        'Inferential Analysis',
        'Predictive Analysis',
        'Casual Analysis',
        'Mechanistic Analysis',
        'Prescriptive Analysis',
    ];

    public const STATUS_RECEIVED = 'Received';

    public const STATUS_UNDER_REVIEW = 'Under Review';

    public const STATUS_MORE_INFORMATION_NEEDED = 'More Information Needed';

    public const STATUS_COMPLETED = 'Completed';

    public const STATUS_DECLINED = 'Declined';

    public const OPEN_STATUSES = [
        self::STATUS_RECEIVED,
        self::STATUS_UNDER_REVIEW,
        self::STATUS_MORE_INFORMATION_NEEDED,
    ];

    public const CLOSED_STATUSES = [
        self::STATUS_COMPLETED,
        self::STATUS_DECLINED,
    ];

    protected $fillable = [
        'requester_user_id',
        'requester_name',
        'office_address',
        'contact_number',
        'email',
        'service_type',
        'analysis_types',
        'other_service_type',
        'target_section_id',
        'assigned_to_id',
        'subject',
        'description',
        'requested_at',
        'date_needed',
        'document_link',
        'deliverable_link',
        'attachment_path',
        'attachment_name',
        'status',
        'claimed_at',
        'last_comment',
        'tracking_token',
        'tracking_token_hash',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'date_needed' => 'date',
            'claimed_at' => 'datetime',
            'requester_archived_at' => 'datetime',
            'analysis_types' => 'array',
            'tracking_token' => 'encrypted',
        ];
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_user_id');
    }

    public function targetSection(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'target_section_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(ServiceRequestDeliverable::class);
    }

    public function scopeUnassignedForSection(Builder $query, int $sectionId): Builder
    {
        return $query
            ->where('target_section_id', $sectionId)
            ->whereNull('assigned_to_id')
            ->where('status', self::STATUS_RECEIVED);
    }
}
