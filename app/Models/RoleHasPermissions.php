<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermissions extends Model
{
    use HasFactory;

    public function permission()
    {
        return $this->belongsTo(Permissions::class, 'permission_id');
    }
}
