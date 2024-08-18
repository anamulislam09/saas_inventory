<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('payment_method_id');
            $table->integer('purchase_id')->nullable();
            $table->date('date');
            $table->double('amount',20,2);
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
