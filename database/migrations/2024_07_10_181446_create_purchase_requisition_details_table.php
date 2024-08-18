<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_requisition_id')->constrained('purchase_requisitions')->onDelete('cascade');
            $table->integer('item_id');
            $table->integer('item_type_id');
            $table->double('quantity',20,2);
            $table->double('unit_price',20,2);
            $table->double('amount',20,2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('purchase_requisition_details');
    }
};
