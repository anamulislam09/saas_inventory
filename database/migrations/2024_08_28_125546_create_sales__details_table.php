<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales__details', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id');
            $table->integer('product_id');
            $table->double('quantity',20,2);
            $table->double('unit_price',20,2);
            $table->double('total_amount',20,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales__details');
    }
};
