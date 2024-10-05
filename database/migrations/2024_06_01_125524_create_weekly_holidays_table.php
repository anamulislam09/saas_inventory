<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weekly_holidays', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->tinyInteger('saturday')->default(0);
            $table->tinyInteger('sunday')->default(0);
            $table->tinyInteger('monday')->default(0);
            $table->tinyInteger('tuesday')->default(0);
            $table->tinyInteger('wednesday')->default(0);
            $table->tinyInteger('thursday')->default(0);
            $table->tinyInteger('friday')->default(0); 
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('weekly_holidays');
    }
};
