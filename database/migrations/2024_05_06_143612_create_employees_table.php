<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            //Basic Information
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('country_id');
            $table->string('state');
            $table->string('city');
            $table->string('zip');

            //Positional Information
            $table->integer('division_id');
            $table->integer('designation_id');
            $table->string('duty_type');
            $table->date('hire_date');
            $table->date('original_hire_date');
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->enum('termination_voluntary',['Yes', 'No'])->default('Yes');
            $table->date('rehire_date')->nullable();
            $table->enum('rate_type',['Hourly','Salary']);
            $table->double('rate',20,2);
            $table->double('bonus',20,2);
            $table->string('pay_frequency');
            $table->text('pay_frequency')->nullable();
            $table->integer('allocate_leave');
            $table->integer('remaining_leave');

            //Bigraphical Information
            $table->date('date_of_birth');
            $table->enum('gender',['Male', 'Female']);
            $table->string('marital_status')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('eeo_class')->nullable();
            $table->string('ssn')->nullable();
            $table->enum('work_in_state',['Yes', 'No'])->nullable();
            $table->enum('live_in_state',['Yes', 'No'])->nullable();
            $table->string('image')->nullable();

            //Additional Address
            $table->string('home_email')->nullable();
            $table->string('home_phone');
            $table->string('cell_phone');
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();

            //Emergencry Contact
            $table->string('emerg_cont');
            $table->string('emerg_cont_alt')->nullable();
            $table->string('emerg_home_cont');
            $table->string('emerg_cont_home_alt')->nullable();
            $table->string('emerg_work_cont');
            $table->string('emerg_cont_work_alt')->nullable();
            $table->string('emerg_cont_relations')->nullable();
            $table->tinyInterger('status')->default(1);
        
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
