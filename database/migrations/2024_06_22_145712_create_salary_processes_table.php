<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_processes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_id');
            $table->integer('employee_id');
            $table->string('year');
            $table->string('month');
            $table->double('basic_salary',20,2);
            $table->double('bonus',20,2)->default(0.00);
            $table->double('overtime',20,2)->default(0.00);
            $table->double('others',20,2)->default(0.00);
            $table->double('absent',20,2)->default(0.00);
            $table->double('late',20,2)->default(0.00);
            $table->double('loan',20,2)->default(0.00);
            $table->double('net_payable',20,2)->default(0.00);
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_processes');
    }
};
