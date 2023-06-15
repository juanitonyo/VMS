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
        'isCheckedOut',
        'health_form',
        'logType'
    ];

    protected $attributes = [
        'user_id' => 1
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitors::class, 'visitor_id');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function visitType(): BelongsTo
    {
        return $this->belongsTo(VisitTypes::class, 'visitPurpose_id');
    }
}
