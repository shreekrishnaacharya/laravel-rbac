<?php

namespace Skacharya\LaravelRbac\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = "skrbac_role_users";
    protected $fillable = ['role_id', 'user_id'];
}
