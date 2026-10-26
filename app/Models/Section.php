<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    protected static function booted()
    {
        static::creating(function ($section) {

            $fixedColors = [
                'LGPCRDM' => '#C24141',
                'LGCO' => '#D4A017',
                'LGPOPS' => '#2F6DA3',
                'Administrative' => '#66F574',
                'Assistant Division Chief' => '#8E4D8E',
                'Division Chief' => '#C96A2D',
            ];

            if (array_key_exists($section->name, $fixedColors)) {
                $section->color = $fixedColors[$section->name];
                $section->is_protected = true;
            } else {
                $section->color = $section->color ?? self::generateRandomColor();
            }
        });

        static::updating(function ($section) {

            if ($section->is_protected && auth()->user()?->role !== 'Admin') {
                // Prevent name change
                $section->name = $section->getOriginal('name');

                // Prevent color change
                $section->color = $section->getOriginal('color');
            }
        });
    }

    private static function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
