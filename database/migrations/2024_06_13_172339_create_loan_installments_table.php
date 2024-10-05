<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_installments', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('loan_id');
            $table->double('amount',20,2);
            $table->string('year_month');
            $table->date('payment_date',20,2);
            $table->tinyInteger('payment_status')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('loan_installments');
    }
};
