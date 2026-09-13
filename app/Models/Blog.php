<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 
        'category_name',
        'title',
        'slug',
        'image',
        'details',
        'meta',
        'meta_description',
    ];
    
}
