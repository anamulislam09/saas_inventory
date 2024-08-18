<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('approved_by_id')->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->text('loan_details');
            $table->date('application_date');
            $table->date('approved_date');
            $table->date('repayment_from');
            $table->double('amount', 20,2);
            $table->integer('interest_percent');
            $table->integer('installment_period');
            $table->double('repayment_total',20,2);
            $table->double('installment', 20,2);
            $table->double('paid_amount', 20,2);
            $table->tinyInteger('payment_status')->comment('0 = Not Paid, 1 = Paid');
            $table->tinyInteger('approve_status')->comment('0 = Pending, 1 = Approved, -1 = Cancelled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
