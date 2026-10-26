<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentWorkflowLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'from_user_id',
        'to_user_id',
        'action',
        'status_before',
        'status_after',
        'comment',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
