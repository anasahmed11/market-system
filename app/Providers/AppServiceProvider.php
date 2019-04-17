<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Branch;
use App\Shift;
use App\Employee;
use App\Expenses_type;
use Mockery\Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        try{
            view()->share([
                'branches'=>Branch::all(),
                'shifts'=>Shift::all(),
                'employees' => Employee::all(),
                'expenses_type' => Expenses_type::all(),
            ]);
        } catch (Exception $exception) {
            return;
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
