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
        'vision_title',
        'vision_details',
        'core_values_title',
        'core_values_details',
        'meta',
        'meta_description',
    ];
}
