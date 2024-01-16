<?php

namespace Sk\LaravelRbac\Models;

use Illuminate\Database\Eloquent\Model;

class RbacRoute extends Model
{
    protected $table = "skrbac_routes";
    protected $fillable = ['name', 'id'];
}
