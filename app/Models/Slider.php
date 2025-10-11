<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'text',
        'description',
        'image',
        'bg_color',
        'status'
    ];
}
