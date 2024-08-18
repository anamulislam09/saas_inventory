<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_taken_by_id');
            $table->integer('handover_to_id');
            $table->integer('created_by_id')->nullable();
            $table->integer('approved_by_id')->nullable();
            $table->integer('leave_type_id')->nullable();
            $table->date('application_start_date');
            $table->date('application_end_date');
            $table->date('approved_start_date');
            $table->date('approved_end_date');
            $table->integer('application_days');
            $table->integer('approved_days');
            $table->string('image')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

   public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
