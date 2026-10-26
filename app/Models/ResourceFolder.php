<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceFolder extends Model
{
    protected $fillable = ['category_id', 'parent_id', 'name'];

    public function category()
    {
        return $this->belongsTo(ResourceCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo(ResourceFolder::class, 'parent_id');
    }

    public function subfolders()
    {
        return $this->hasMany(ResourceFolder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(ResourceFile::class, 'folder_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
