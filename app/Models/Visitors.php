<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visitors extends Model
{
    use HasFactory;

    protected $fillable = [
        'refId',
        'email',
        'name',
        'contact',
        'validId',
        'policy'
    ];

    public function refId(): HasOne
    {
        return $this->hasOne(Building::class, 'qr_id', 'refId');
    }
}
