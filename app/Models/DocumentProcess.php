<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'subject_title',
        'focal_person',
        'type_of_paper',
        'section',
        'document_link',
        'remarks',
        'file_path',
        'assigned_to_id',
        'status',
        'last_comment',
    ];

    protected $casts = [
        'file_path' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section');
    }

    use SoftDeletes;
}
