<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public function hasPermissions()
    {
        return $this->hasMany(RoleHasPermissions::class, 'role_id');
    }
}
