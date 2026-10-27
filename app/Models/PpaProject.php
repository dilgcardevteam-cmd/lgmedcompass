<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpaProject extends Model
{
    protected $fillable = [
        'section_code',
        'name',
        'description',
        'external_url',
        'sort_order',
        'is_active',
    ];
}
