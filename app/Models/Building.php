<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'proptech_id',
        'building_name',
        'registration_name',
        'address',
        'qr_id',
        'description',
        'building_type',
        'logo',
        'status',
        'health_form'
    ];

    public function buildingType(): HasOne
    {
        return $this->hasOne(BuildingTypes::class, 'id', 'building_type')->select(['id','name', 'delivery_form', 'health_form']);
    }
}
