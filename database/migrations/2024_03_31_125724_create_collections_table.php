<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('order_no')->nullable();
            $table->integer('table_id')->nullable();
            $table->integer('payment_method_id');
            $table->double('total_amount', 20,2)->nullable();
            $table->double('discount', 20,2)->nullable();
            $table->double('vat', 20,2)->nullable();
            $table->double('total_payable', 20,2)->default(0.00);
            $table->double('paid_amount', 20,2)->default(0.00);
            $table->text('note')->nullable();
            $table->tinyInteger('payment_status')->default(1);
            $table->integer('created_by_id');
            $table->integer('approved_by_id')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
