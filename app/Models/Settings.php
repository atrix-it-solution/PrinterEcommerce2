<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_icon',
        'site_logo',
        'site_footer_logo',
        'contact_email',
        'contact_phone',
        'address'
    ];
}
