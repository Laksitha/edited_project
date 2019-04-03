<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')->onDelete('cascade');
            $table->decimal('attendance')->default(0);
            $table->decimal('travel')->default(0);
            $table->decimal('food')->default(0);
            $table->decimal('lodg')->default(0);
            $table->decimal('cost_of_living')->default(0);
            $table->decimal('training')->default(0);
            $table->decimal('total_allowence')->default(0);
            $table->decimal('No_of_days')->default(0);
            $table->decimal('rate')->default(0);
            $table->decimal('no_pay')->default(0);
            $table->decimal('emp_epf')->default(0);
            $table->decimal('salary_advance')->default(0);
            $table->decimal('loan_recovery')->default(0);
            $table->decimal('welfair_contribution')->default(0);
            $table->decimal('penelties')->default(0);
            $table->decimal('total_deductions')->default(0);
            $table->decimal('net_salary')->default(0);
            $table->decimal('cmp_epf')->default(0);
            $table->decimal('cmp_etf')->default(0);
            $table->decimal('salary_for_epf')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll');
    }
}
