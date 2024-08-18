<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('h_r_settings', function (Blueprint $table) {
            $table->id();
            $table->time('office_start_at')->default('10:00:00');
            $table->time('office_end_at')->default('18:00:00');
            $table->integer('daily_work_hour')->default(8);
            $table->double('overtime_rate',10,3)->default('1');
            $table->tinyInteger('equivalent_absences')->default('3');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('h_r_settings');
    }
};
