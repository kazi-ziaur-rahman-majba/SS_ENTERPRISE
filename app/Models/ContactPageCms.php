<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageCms extends Model
{
    use HasFactory;

    protected $table = 'contact_page_cms';

    protected $fillable = [
        'banner_title',
        'page_title',
        'banner_image',
        'meta',
        'meta_description',
    ];
}
