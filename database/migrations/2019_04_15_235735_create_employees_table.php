<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->date('hiring_date');
            $table->string('salary')->nullable();
            $table->unsignedInteger('branche_id');
            $table->unsignedInteger('shift_id');

            // foreign keys
            $table->foreign('branche_id')->references('id')->on('branches');
            $table->foreign('shift_id')->references('id')->on('shifts');

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
        Schema::dropIfExists('employees');
    }
}
