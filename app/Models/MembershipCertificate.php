<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipCertificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_title', 
        'page_title', 
        'banner_image', 
        'member_title', 
        'certificates_title',
        'member_image',
        'certificates_image',
    ];
}
