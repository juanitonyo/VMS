<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InvitationLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'building_id',
        'visit_purpose_id',
        'location',
        'contact',
        'ref_code',
        'companions',
        'target_date',
        'status'
    ];

    public function building(): HasOne
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

    public function visitType(): HasOne
    {
        return $this->hasOne(VisitTypes::class, 'id', 'visit_purpose_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(Host::class, 'id', 'user_id');
    }

    public function latestLog(): HasOne
    {
        return $this->hasOne(VisitorLogs::class, 'visitor_id', 'id')->where('log_type', 'Invitee')->latestOfMany();
    }

    public function log(): HasOne
    {
        return $this->hasOne(VisitorLogs::class, 'visitor_id', 'id');
    }
}
