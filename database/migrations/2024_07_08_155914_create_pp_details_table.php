<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pp_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pp_id')->constrained('production_plans')->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained('recipes')->onDelete('cascade');
            $table->double('quantity');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pp_details');
    }
};
