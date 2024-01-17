<?php

namespace Sk\LaravelRbac\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    protected $table = "skrbac_role_access";
    protected $fillable = ['role_id', 'access_id'];

    function access()
    {
        return $this->belongsTo(Access::class, 'name', 'access_id');
    }

    function role()
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }
}
