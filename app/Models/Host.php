<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Host extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'location',
        'contact',
        'gov_id',
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
