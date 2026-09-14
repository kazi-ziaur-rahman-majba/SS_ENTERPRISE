<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutQligence extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'sub_title',
        'detail',
        'button_title',
        'button_link',
        'first_image',
        'second_image',
        'third_image',
        'check_1',
        'check_2',
        'check_3',
        'check_4',
        'check_5',
        'check_6',
        'experience_years',
        'experience_label',
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
        'expertise_title_three',
        'expertise_detail_three',
        'image_title',
        'safety_detail',
        'safety_image',
        'safety_title_one',
        'safety_detail_one',
        'safety_title_two',
        'safety_detail_two',
        'safety_title_three',
        'safety_detail_three',
    ];
}
