<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'name',
        'type',
        'file_path',
        'url',
        'parent_id',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(SectionFile::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SectionFile::class, 'parent_id');
    }
}
