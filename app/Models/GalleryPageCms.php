<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPageCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title',
        'meta_description',
        'banner_image',
        'meta',
        'meta_description',
    ];
}
