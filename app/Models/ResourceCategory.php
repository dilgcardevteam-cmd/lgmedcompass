<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function folders()
    {
        return $this->hasMany(ResourceFolder::class, 'category_id');
    }
}
