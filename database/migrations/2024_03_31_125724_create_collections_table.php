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
            $table->tinyInteger('client_id');
            $table->integer('vendor_id');
            $table->integer('collection_method_id');
            $table->integer('sales_id')->nullable();
            $table->date('date');
            $table->double('amount',20,2);
            $table->double('discount', 20,2)->nullable();
            $table->double('vat', 20,2)->nullable();
            $table->double('total_collection_amount', 20,2)->default(0.00);
            $table->double('total_collection', 20,2)->default(0.00);
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
