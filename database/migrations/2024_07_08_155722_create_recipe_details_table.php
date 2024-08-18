<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipe_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes')->onDelete('cascade');
            $table->integer('raw_material_id');
            $table->double('sub_quantity',10,2);
            $table->double('sub_unit_price',10,2);
            $table->integer('sub_unit_id');
            $table->integer('main_unit_id');
            $table->double('main_quantity',10,2);
            $table->double('main_unit_price',10,2);
            $table->integer('cost');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('recipe_details');
    }
};
