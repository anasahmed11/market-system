<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try{
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'is_admin' => 1,
                'password' => bcrypt('123456'),
            ]);
        } catch (Exception $exception){}

        try{
            DB::table('users')->insert([
                'name' => 'elnemr',
                'email' => 'pro.ahmedelnemr@gmail.com',
                'is_admin' => 1,
                'password' => bcrypt('S1234s12'),
            ]);
        } catch (Exception $exception){}

        // invoice types
        try{
            DB::table('invoices_types')->insert([
                'name' => 'فاتورة بيع قطاعي',
                'slug' => 'selling-1',
            ]);
        } catch (Exception $exception) {}

        try{
            DB::table('invoices_types')->insert([
                'name' => 'فاتورة بيع جملة',
                'slug' => 'selling-2',
            ]);
        } catch (Exception $exception) {}





    }
}
