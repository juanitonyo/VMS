<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'delivery_form',
        'status',
    ];
}
