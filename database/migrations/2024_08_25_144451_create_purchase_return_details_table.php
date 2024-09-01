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
        Schema::create('purchase_return_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->tinyInteger('purchase_return_id');
            $table->tinyInteger('product_id');
            $table->double('quantity_returned',20,2);
            $table->text('return_reason')->nullable();
            $table->double('unit_price',20,2);
            $table->double('amount',20,2);
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_return_details');
    }
};
