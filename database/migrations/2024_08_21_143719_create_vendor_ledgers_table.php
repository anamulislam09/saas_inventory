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
        Schema::create('vendor_ledgers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('vendor_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('sales_id')->nullable();
            $table->integer('collection_id')->nullable();
            $table->string('particular')->nullable();
            $table->date('date');
            $table->double('debit_amount',20,2)->default(0);
            $table->double('credit_amount',20,2)->default(0);
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('vendor_ledgers');
    }
};
