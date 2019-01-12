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
    Route::post('/debts/types/add/{customer}', 'CustomersController@addDebt')->name('debts.types.add');
    Route::resource('/customers', 'CustomersController')->only([
        'index', 'show'
    ]);
    Route::post('/customers/search', 'CustomersController@search')->name('customers.search');

    Route::get('/customers/{customer}/debts', 'CustomersController@debts')->name('customers.debts');

    //branches
    Route::resource('/branches', 'BranchesController')->only([
        'index', 'show'
    ]);

    //suppliers
    Route::resource('/branches', 'BranchesController')->only([
        'index', 'show'
    ]);

    Route::get('/debts/types', 'DebtsController@getTypes')->name('debts.types');
    Route::resource('/debts', 'DebtsController');
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

    // Debts
    Route::resource('/debts', 'DebtsController');
    Route::get('/debts/types', 'DebtsController@getTypes')->name('debts.types');

});

/**
 * Errors Pages
 */
Route::get('/401', function () {
    return view('errors.401');
})->name('admin.access');

