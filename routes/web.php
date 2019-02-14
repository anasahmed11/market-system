<?php


Auth::routes();

Route::group([
    'namespace' => 'Backend'
], function () {
    //dashboard
    Route::resource('/', 'DashboardController');

    //users
    Route::resource('/users', 'UsersController');

    //customers
    Route::post('/debts/types/add/{customer}', 'CustomersController@addDebt')->name('debts.types.add');
    Route::post('/debts/types/remove/{customer}', 'CustomersController@removeDebt')->name('debts.types.remove');
    Route::post('/customers/search', 'CustomersController@search')->name('customers.search');
    Route::get('/customers/{customer}/debts', 'CustomersController@debts')->name('customers.debts');
    Route::resource('/customers', 'CustomersController');

    //branches
    Route::post('/branches/search', 'BranchesController@search')->name('branches.search');
    Route::resource('/branches', 'BranchesController');

    //suppliers
    Route::post('/suppliers_debts/types/add/{supplier}', 'SuppliersController@addDebt')->name('suppliers_debts.types.add');
    Route::post('/suppliers_debts/types/remove/{supplier}', 'SuppliersController@removeDebt')->name('suppliers_debts.types.remove');
    Route::post('/suppliers/search', 'SuppliersController@search')->name('suppliers.search');
    Route::get('/suppliers/{suppliers}/debts', 'SuppliersController@debts')->name('suppliers.debts');
    Route::resource('/suppliers', 'SuppliersController');

    Route::get('/debts/types', 'DebtsController@getTypes')->name('debts.types');
    Route::resource('/debts', 'DebtsController');

    //products
    Route::get('/categories/types/edit/{id}', 'ProductsController@getAllTypesEdit')->name('products.types.edit');
    Route::post('/products/search', 'ProductsController@search')->name('products.search');
    Route::resource('/products', 'ProductsController');

    //category
    Route::post('/categories/search', 'CategoriesController@search')->name('categories.search');
    Route::get('/categories/types/edit/{id}', 'CategoriesController@getAllTypesEdit')->name('categories.types.edit');
    Route::get('/categories/types', 'CategoriesController@getAllTypes')->name('categories.types');
    Route::get('/categories/parents', 'CategoriesController@getAllParents')->name('categories.parents');
    Route::resource('/categories', 'CategoriesController');

    //invoices
//    Route::resource('/invoices', 'InvoicesController');
    Route::group([
        'prefix' => 'invoices',
        'as' => 'invoices.'
    ], function () {
        Route::get('/index', 'InvoicesController@index')->name('index');
        Route::get('/create/{invoicesType}', 'InvoicesController@create')->name('create');
        Route::post('/store/{invoicesType}', 'InvoicesController@store')->name('store');
    });
});

/**
 * Admin Routes
 */
//
//Route::group([
//    'namespace' => 'Backend'
//], function () {
//    //users
//    Route::resource('/users', 'UsersController');
//
//    //customers
//    Route::resource('/customers', 'CustomersController');
//
//    //branches
//    Route::resource('/branches', 'BranchesController');
//
//    //suppliers
//    Route::resource('/suppliers', 'SuppliersController');
//
//    // Debts
//    Route::resource('/debts', 'DebtsController');
//    Route::get('/debts/types', 'DebtsController@getTypes')->name('debts.types');
//
//    Route::get('/categories/types/edit/{id}', 'ProductsController@getAllTypesEdit')->name('products.types.edit');
//    Route::resource('/products', 'ProductsController');
//
//    Route::resource('/categories', 'CategoriesController');
//
//
//});

/**
 * Errors Pages
 */
Route::get('/401', function () {
    return view('errors.401');
})->name('admin.access');

