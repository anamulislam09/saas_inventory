<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->integer('product_id');
            $table->integer('product_type_id');
            $table->double('quantity',20,2);
            $table->double('unit_price',20,2);
            $table->double('total_amount',20,2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};
