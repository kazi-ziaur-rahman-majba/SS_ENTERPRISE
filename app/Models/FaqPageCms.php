<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqPageCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title',
        'banner_image',
        'title',
        'faq',
        'meta',
        'meta_description',
    ];

    protected $casts = [
        'faq' => 'array',
    ];
}
