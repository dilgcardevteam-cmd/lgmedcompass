<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentSchedule extends Model
{
    protected $fillable = [
        'document_id',
        'due_date',
        'status',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'completed_at' => 'datetime',
        ];
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
