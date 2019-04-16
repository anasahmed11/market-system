<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
           
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('expenses_type_id');
            $table->string('received_amount');
            $table->string('paid_amount');
            $table->date('payment_date');
            $table->string('notes');
            // foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('expenses_type_id')->references('id')->on('expenses_types');
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
        Schema::dropIfExists('expenses');
    }
}
