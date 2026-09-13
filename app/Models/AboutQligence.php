<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutQligence extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'detail',
        'button_title',
        'button_link',
        'first_image',
        'second_image',
        'third_image',
        'trust_title_one',
        'trust_detail_one',
        'trust_title_two',
        'trust_detail_two',
        'trust_title_three',
        'trust_detail_three',
        'expertise_detail',
        'expertise_title_one',
        'expertise_detail_one',
        'expertise_title_two',
        'expertise_detail_two',
        'image_title',
        'safety_detail',
        'safety_image',
    ];
}
