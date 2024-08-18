<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('total_seat');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_available')->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
