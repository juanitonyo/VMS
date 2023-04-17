<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'buildingName',
        'address',
        'description',
        'buildingType',
        'logo',
        'status',
    ];

        /**
     * Get the phone associated with the user.
     */
    public function buildingType(): HasOne
    {
        return $this->hasOne(BuildingTypes::class, 'id', 'buildingType')->select(['id','name']);
    }
}
