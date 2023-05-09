<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visitors extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_ID',
        'email',
        'name',
        'contact',
        'google_id',
        'validId',
        'policy',
        'status',
        'isCheckedOut'
    ];

    public function building(): HasOne 
    {
        return $this->hasOne(Building::class, 'id', 'building_ID')->select(['id','buildingName']);
    }
}
