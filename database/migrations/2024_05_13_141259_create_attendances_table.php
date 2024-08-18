<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('created_by_id');
            $table->date('date');
            $table->dateTime('in_at');
            $table->dateTime('out_at')->nullable();
            $table->double('worked_hour',10,2)->nullable();
            $table->double('over_time_hour',10,2)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->comment('0=Absent,1=Present,2=Late,3=Leave');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
