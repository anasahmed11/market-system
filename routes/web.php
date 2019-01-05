<?php


Auth::routes();

Route::group([
    'namespace' => 'Backend',
    'middleware' => 'auth'
], function () {
    //dashboard
    Route::resource('/', 'DashboardController');

    //users
    Route::resource('/users', 'UsersController')->only([
        'index', 'show'
    ]);

    //customers
    Route::resource('/customers', 'CustomersController')->only([
        'index', 'show'
    ]);
    Route::get('/customers/{customer}/debts', 'CustomersController@debts')->name('customers.debts');

    //branches
    Route::resource('/branches', 'BranchesController')->only([
        'index', 'show'
    ]);

    //suppliers
    Route::resource('/branches', 'BranchesController')->only([
        'index', 'show'
    ]);

});

/**
 * Admin Routes
 */

Route::group([
    'namespace' => 'Backend',
    'middleware' => ['auth', 'admin']
], function () {
    //users
    Route::resource('/users', 'UsersController');

    //customers
    Route::resource('/customers', 'CustomersController');

    //branches
    Route::resource('/branches', 'BranchesController');

    //suppliers
    Route::resource('/suppliers', 'SuppliersController');

});

/**
 * Errors Pages
 */
Route::get('/401', function () {
    return view('errors.401');
})->name('admin.access');

