<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class VisitorLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_id',
        'building_id',
        'visit_purpose_id',
        'is_checked_out',
        'checked_in_by',
        'checked_out_by',
        'approved_by',
        'health_form',
        'log_type',
        'status',
        'status_remarks'
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitors::class, 'visitor_id');
    }

    public function invited(): BelongsTo
    {
        return $this->belongsTo(InvitationLogs::class, 'visitor_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Host::class, 'user_id', 'user_id');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function visitType(): BelongsTo
    {
        return $this->belongsTo(VisitTypes::class, 'visit_purpose_id');
    }
}
