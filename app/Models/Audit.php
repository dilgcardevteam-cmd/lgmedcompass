<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'focal_person',
        'ppa_title',
        'assessment_year',
        'file_path',
        'user_id',
    ];
}
