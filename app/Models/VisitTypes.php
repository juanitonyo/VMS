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
        'buildingType',
        'description',
        'personToVisit',
        'visitApproval',
        'autoApprove',
        'status',
    ];

    public function buildingTypeName(): HasOne
    {
        return $this->hasOne(BuildingTypes::class, 'id', 'buildingType')->select(['id','name']);
    }
}
