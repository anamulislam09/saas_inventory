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
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('vendor_id');
            $table->string('vouchar_no');
            $table->tinyInteger('purchase_id');
            $table->date('date');
            $table->double('total_return_amount',20,2);
            $table->text('note')->nullable();
            $table->string('return_status')->default(0);
            $table->string('status')->default(1);
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
        Schema::dropIfExists('purchase_returns');
    }
};