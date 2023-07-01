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
        'user_id',
        'building_id',
        'email',
        'name',
        'contact',
        'profile_photo',
        'front_id',
        'back_id',
        'google_id',
        'ref_code',
        'valid_id',
        'policy',
        'status',
        'status_remarks',
        'remember_otp'
    ];

    protected $attributes = [
        'user_id' => '1',
        'remember_otp' => '000000'
    ];

    public function building(): HasOne 
    {
        return $this->hasOne(Building::class, 'id', 'building_id')->select(['id', 'qr_id','building_name']);
    }

    public function latestLog(): HasOne
    {
        return $this->hasOne(VisitorLogs::class, 'visitor_id', 'id')->where('log_type', 'Walk-In')->latestOfMany();
    }
}
