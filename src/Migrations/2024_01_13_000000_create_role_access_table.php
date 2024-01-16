<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skrbac_role_access', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('access_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skrbac_role_access');
    }
};