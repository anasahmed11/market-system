<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('branch_id');
            $table->dateTime('date');
            $table->unsignedDecimal('sub_total')->default(0);
            $table->unsignedDecimal('total')->default(0);
            $table->unsignedDecimal('added_value')->default(0);
            $table->unsignedDecimal('discount_value')->default(0);
            $table->unsignedDecimal('payed')->default(0);
            $table->unsignedDecimal('remaining')->default(0);
            $table->text('note')->nullable();

            $table->timestamps();

            // foreign keys
            $table->foreign('type_id')->references('id')->on('invoices_types');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers_invoices');
    }
}
