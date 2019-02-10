<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerUpdateSupplierDebt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_Supplier_Debt AFTER INSERT ON `supplier_debts` FOR EACH ROW
                BEGIN
                    UPDATE `suppliers` 
                    SET
                    `total_indebtedness` = `total_indebtedness` + NEW.value;
                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
