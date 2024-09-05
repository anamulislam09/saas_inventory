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
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('vendor_id')->nullable();
            $table->string('invoice_no');
            $table->tinyInteger('sales_id');
            $table->date('date');
            $table->double('total_amount',20,2);
            $table->double('refund_amount',20,2);
            $table->text('note')->nullable();
            $table->string('return_status')->default(0);
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
        Schema::dropIfExists('sales_returns');
    }
};
