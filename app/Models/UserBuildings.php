<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBuildings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_id'
    ];

    protected $attributes = [
        'status' => 1,
    ];

    public function building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
}
