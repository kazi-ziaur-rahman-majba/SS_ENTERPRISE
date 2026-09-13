<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePageCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title',
        'banner_image',
        'detail_page_title',
        'detail_page_banner_image',
        'how_it_works_title',
        'why_qligence_title',
        'meta',
        'meta_description',
    ];
}
