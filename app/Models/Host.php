<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'firstName',
        'lastName',
        'email',
        'password',
        'location',
        'contact',
        'gov_id',
        'profilePhoto',
        'frontId',
        'backId',
        'policy',
        'role'
    ];

    protected $attributes = [
        'gov_id' => '',
        'frontId' => '',
        'backId' => ''
    ];
}
