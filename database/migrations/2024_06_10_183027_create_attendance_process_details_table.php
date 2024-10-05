<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_process_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('attendance_process_id');
            $table->integer('employee_id');
            $table->integer('absent_days');
            $table->integer('late_to_absent_days');
            $table->integer('net_absent_days');
            $table->integer('present_days');
            $table->integer('leave_days');
            $table->integer('net_present_days');
            $table->double('regular_hours_worked',10,2)->default(0);
            $table->double('overtime_hours',10,2)->default(0);
            $table->double('total_hours_worked',10,2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_process_details');
    }
};
