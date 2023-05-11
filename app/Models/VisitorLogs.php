<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_id',
        'building_id',
        'visitPurpose_id',
        'isCheckedOut'
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitors::class, 'visitor_id');
    }
}
