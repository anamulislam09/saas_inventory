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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->string('invoice_no');
            $table->date('date');
            $table->double('sales_price',20,2)->default(0.00);
            $table->tinyInteger('discount_method')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->double('discount',20,2)->default(0.00);
            $table->double('vat_tax',20,2)->default(0.00);
            $table->double('receiveable_amount',20,2)->default(0.00);
            $table->double('receive_amount',20,2)->default(0.00);
            $table->text('note')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('sales');
    }
};
