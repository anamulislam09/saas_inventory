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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('organization')->nullable();
            $table->double('opening_payable',20,2)->default(0.00);
            $table->double('opening_receivable',20,2)->default(0.00);
            $table->double('current_balance',20,2)->default(0.00);
            $table->string('status')->default(0);
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
        Schema::dropIfExists('vendors');
    }
};
