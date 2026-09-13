<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title',
        'banner_image',
        'about_title',
        'about_details',
        'about_image',
        'meta',
        'meta_description',
    ];
}
