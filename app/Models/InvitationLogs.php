<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'building_id',
        'visit_purpose_id',
        'location',
        'contact',
        'ref_code',
        'companions',
        'target_date'
    ];
}
