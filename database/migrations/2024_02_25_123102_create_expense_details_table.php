<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense_details', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('expense_id');
            $table->integer('expense_cat_id');
            $table->integer('expense_head_id');
            $table->double('amount',20,2);
            $table->double('quantity',10,2);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_details');
    }
};
