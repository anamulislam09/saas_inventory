<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id');
            $table->string('order_no');
            $table->double('trade_price', 20,2)->default(0.00);
            $table->double('mrp', 20,2)->default(0.00);
            $table->double('discount', 20,2)->default(0.00);
            $table->double('vat', 20,2)->default(0.00);
            $table->double('net_bill', 20,2)->default(0.00);
            $table->double('paid_amount', 20,2)->default(0.00);
            $table->double('profit', 20,2)->default(0.00);
            $table->text('note')->nullable();
            $table->tinyInteger('payment_status')->default(1);
            $table->tinyInteger('order_status')->default(0)->comment('0=pending,1=Approved,2=Cancelled,3=Processing,4=Processed,5=Completed');
            $table->tinyInteger('order_type')->default(0)->comment('0=Dine-In,1=Takeaway,2=Online');
            $table->integer('created_by_id');
            $table->integer('approved_by_id')->nullable();
            $table->dateTime('received_by_id')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->tinyInteger('kitchen_alert')->default(0);
            $table->tinyInteger('collection_alert')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
