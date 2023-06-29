<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuildings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_id'
    ];

    // protected $casts = [
    //     'building_id' => 'array'
    // ];

    protected $attributes = [
        'status' => 1,
    ];

    public function building()
    {
        return $this->select(Building::class, 'id', 'building_id');
    }
}
