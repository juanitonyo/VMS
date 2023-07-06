<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserBuildings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_id'
    ];

    protected $casts = [
        'building_id' => 'json'
    ];

    protected $attributes = [
        'status' => 1,
    ];

    public function building(): BelongsToMany
    {
        return $this->belongsToMany(Building::class, 'user_buildings', 'id', 'building_id');
    }
}
