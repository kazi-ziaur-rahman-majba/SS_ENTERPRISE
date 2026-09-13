<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'slug',
        'image',
        'detail',
        'category_id',
        'category_name',
        'meta',
        'meta_description',
    ];
}
