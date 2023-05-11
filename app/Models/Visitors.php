<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visitors extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_ID',
        'building_ID',
        'email',
        'name',
        'contact',
        'google_id',
        'validId',
        'policy',
        'status',
    ];

    protected $attributes = [
        'user_ID' => '1'
    ];

    public function building(): HasOne 
    {
        return $this->hasOne(Building::class, 'id', 'building_ID')->select(['id','buildingName']);
    }
}
