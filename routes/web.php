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

    //products
    Route::post('/products/search', 'ProductsController@search')->name('products.search');
    Route::get('/categories/types/edit/{id}', 'ProductsController@getAllTypesEdit')->name('products.types.edit');
    Route::resource('/products', 'ProductsController')->only([
        'index', 'show'
    ]);

    //category
    Route::post('/categories/search', 'CategoriesController@search')->name('categories.search');
    Route::get('/categories/types/edit/{id}', 'CategoriesController@getAllTypesEdit')->name('categories.types.edit');
    Route::get('/categories/types', 'CategoriesController@getAllTypes')->name('categories.types');
    Route::get('/categories/parents', 'CategoriesController@getAllParents')->name('categories.parents');
    Route::resource('/categories', 'CategoriesController')->only([
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

    // Debts
    Route::resource('/debts', 'DebtsController');
    Route::get('/debts/types', 'DebtsController@getTypes')->name('debts.types');

    Route::resource('/products', 'ProductsController');

    Route::resource('/categories', 'CategoriesController');


});

/**
 * Errors Pages
 */
Route::get('/401', function () {
    return view('errors.401');
})->name('admin.access');

