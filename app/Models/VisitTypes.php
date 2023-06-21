<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VisitTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building_type',
        'description',
        'person_to_visit',
        'visit_approval',
        'auto_approve',
        'status',
    ];

    public function buildingTypeName(): HasOne
    {
        return $this->hasOne(BuildingTypes::class, 'id', 'building_type')->select(['id','name']);
    }
}
