<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'name',
        'division_id',
        'parent_id',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(DriveFile::class);
    }

    public function subfoldersRecursive()
    {
        return $this->subfolders()->with('subfoldersRecursive', 'files');
    }
}
