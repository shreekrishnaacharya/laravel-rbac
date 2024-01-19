<?php

namespace Skacharya\LaravelRbac\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "skrbac_roles";
    protected $fillable = ['name', 'id'];

    function users()
    {
        return $this->belongsToMany(config('skrbac.user_model'), 'skrbac_role_users', 'user_id', 'role_id');
    }
}
