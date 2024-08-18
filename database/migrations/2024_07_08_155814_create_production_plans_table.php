<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_no');
            $table->date('date');
            $table->string('note')->nullable();
            $table->tinyInteger('status');
            $table->integer('created_by_id');
            $table->integer('updated_by_id');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('production_plans');
    }
};
