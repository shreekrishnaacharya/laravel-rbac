<?php

namespace Sk\LaravelRbac\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = "skrbac_role_access";
    protected $fillable = ['name', 'id'];
}
