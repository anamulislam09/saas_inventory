<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->double('unit_price', 20,2);
            $table->tinyInteger('status')->default(0)->comment('1=ready');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
