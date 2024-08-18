<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_processes', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('year');
            $table->tinyInteger('month');
            $table->integer('total_working_days');
            $table->double('total_working_hours',10,2);
            $table->integer('created_by_id');
            $table->integer('updated_by_id');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('attendance_processes');
    }
};
