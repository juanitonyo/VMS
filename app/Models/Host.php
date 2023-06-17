<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'location',
        'contact',
        'govs_id',
        'profile_photo',
        'front_id',
        'back_id',
        'policy',
        'role'
    ];

    protected $attributes = [
        'gov_id' => '',
        'front_id' => '',
        'back_id' => ''
    ];
}
