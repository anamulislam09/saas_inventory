<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->string('name');
            $table->integer('leave_days');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
