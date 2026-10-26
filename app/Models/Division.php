<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['code', 'name'];

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
