<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Branch;
use App\Shift;
use App\Employee;
use App\Expenses_type;

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
        
        view()->share([
            'branches'=>Branch::all(),
            'shifts'=>Shift::all(),
            'employees' => Employee::all(),
            'expenses_type' => Expenses_type::all(),
            ]);
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
