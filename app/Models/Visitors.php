<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'profilePhoto',
        'front_id',
        'back_id',
        'google_id',
        'refCode',
        'validId',
        'policy',
        'status',
        'remember-otp'
    ];

    protected $attributes = [
        'user_ID' => '1',
        'remember-otp' => '000000'
    ];

    public function building(): HasOne 
    {
        return $this->hasOne(Building::class, 'id', 'building_ID')->select(['id', 'qr_id','buildingName']);
    }

    public function latestLog(): HasOne
    {
        return $this->hasOne(VisitorLogs::class, 'visitor_id', 'id')->latestOfMany();
    }
}
