<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriveFile extends Model
{
    protected $fillable = [
        'folder_id',
        'name',
        'type',
        'path',
        'url',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
