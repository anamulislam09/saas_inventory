<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('client_id')->nullable();
            $table->string('type');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('nid_no')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('is_client')->default(1);
            $table->tinyInteger('package_id')->nullable();
            $table->string('package_start_date')->nullable();
            $table->double('client_balance', 20, 2)->default(0);
            $table->timestamps();
            $table->rememberToken();
        });
    }
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
