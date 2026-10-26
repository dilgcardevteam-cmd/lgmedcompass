<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'assigned_to_id',
        'workflow_status',
        'last_comment',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
