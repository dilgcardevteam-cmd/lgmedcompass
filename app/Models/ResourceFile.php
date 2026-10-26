<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    protected $fillable = ['folder_id', 'name', 'type', 'path', 'url', 'user_id'];

    public function folder()
    {
        return $this->belongsTo(ResourceFolder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
