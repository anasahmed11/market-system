<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_debts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('debts_types_id');
            $table->unsignedInteger('supplier_id');
            $table->foreign('debts_types_id')->references('id')->on('debts_types');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->text('note')->nullable();
            $table->float('value')->default(0);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('supplier_debts');
    }
}
