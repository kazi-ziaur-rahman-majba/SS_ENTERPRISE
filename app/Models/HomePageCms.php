<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'slider_bottom_title',
        'slider_bottom_link_title',
        'slider_bottom_link',
        'project_title',
        'project_button_title',
        'project_button_link',
        'why_work_us_title',
        'client_title',
        'news_title',
        'news_sub_title',
        'news_button_title',
        'news_button_link',
        'meta',
        'meta_description',
    ];
    
}
