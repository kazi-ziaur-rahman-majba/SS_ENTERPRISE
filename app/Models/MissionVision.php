<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionVision extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title',
        'banner_image',
        'objective_title',
        'objective_details',
        'mission_title',
        'mission_details',
        'mission_image',
        'vision_title',
        'vision_details',
        'vision_image',
        'core_values_title',
        'core_values_details',
        'core_values_image',
        'core_values_items',
        'meta',
        'meta_description',
    ];

    protected $casts = [
        'core_values_items' => 'array',
    ];
}
