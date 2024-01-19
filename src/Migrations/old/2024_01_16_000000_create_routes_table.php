<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skrbac_routes', function (Blueprint $table) {
            $table->id();
            $table->string('uri');
            $table->string('method')->nullable();
            $table->string('name')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skrbac_routes');
    }
};