<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppd_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pp_id')->constrained('production_plans')->onDelete('cascade');
            $table->integer('raw_material_id');
            $table->double('quantity',20,2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ppd_raw_materials');
    }
};
