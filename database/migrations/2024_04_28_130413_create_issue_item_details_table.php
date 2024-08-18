<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issue_item_details', function (Blueprint $table) {
            $table->id();
            $table->integer('issue_id');
            $table->integer('item_id');
            $table->double('quantity',20,2);
            $table->double('unit_price',20,2);
            $table->double('total_amount',20,2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issue_item_details');
    }
};
