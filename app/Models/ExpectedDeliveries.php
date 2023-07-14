<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExpectedDeliveries extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_name',
        'building_id',
        'user_id',
        'target_date',
        'remarks',
        'status'
    ];

    public function building(): HasOne
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
}
