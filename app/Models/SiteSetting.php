<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'about_us',
        'corporate_office_address',
        'registered_office_address',
        'uk_office_address',
        'facebook_link',
        'linkedin_link',
        'instagram_link',
        'logo',
        'contact_email',
    ];
}
