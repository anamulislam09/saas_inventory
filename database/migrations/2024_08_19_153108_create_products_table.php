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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('cat_type_id');
            $table->integer('cat_id');
            $table->integer('sub_cat_id')->nullable();
            $table->integer('unit_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image');
            $table->double('cost',20,2)->default(0);
			$table->double('price',20,2)->default(0);
			$table->float('vat',5,2)->default(0);
            $table->double('sold_qty',20,2)->default(0);
            $table->double('opening_stock',20,2)->default(0);
            $table->double('current_stock',20,2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
