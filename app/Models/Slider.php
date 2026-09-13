<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'sub_title',
        'image',
        'button_text',
        'button_link',
        'text_position',
    ];
}
