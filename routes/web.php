<?php


Auth::routes();





Route::group([
    'namespace' => 'Backend',
    'middleware' => 'managementManager'
], function () {
    //dashboard
    Route::resource('/', 'DashboardController');

    //products
    Route::get('/categories/types/edit/{id}', 'ProductsController@getAllTypesEdit')->name('products.types.edit');
    Route::post('/products/search', 'ProductsController@search')->name('products.search');
    Route::resource('/products', 'ProductsController');

    //category
    Route::post('/categories/search', 'CategoriesController@search')->name('categories.search');
    Route::get('/categories/types/edit/{id}', 'CategoriesController@getAllTypesEdit')->name('categories.types.edit');
    Route::get('/categories/types/cat_edit/{id}', 'CategoriesController@getAllTypesEditCategories')->name('categories.cat.types.edit');
    Route::get('/categories/types', 'CategoriesController@getAllTypes')->name('categories.types');
    Route::get('/categories/parents', 'CategoriesController@getAllParents')->name('categories.parents');
    Route::resource('/categories', 'CategoriesController');

    //Report controller
    Route::get('/user-details/{id}', 'ReportController@get_user_details');
    Route::get('/report/storeState', 'ReportController@full_stock');
    Route::get('/report/outOfStock', 'ReportController@getOutOfStock')->name('report.outOfStock');
    Route::get('/report/empty-stock', 'ReportController@empty_stock');
    Route::get('/report/full-stock', 'ReportController@full_stock_ajax');
    Route::get('/all-s-invoices', 'ReportController@all_invoices');
    Route::get('/today-invoices', 'ReportController@today_invoices');
    Route::get('/this-invoices/{id}', 'ReportController@invoice_products');
    Route::get('/today-invoices/{id}', 'ReportController@t_invoice_products');
    Route::get('/shift-1', 'ReportController@shift_1');
    Route::get('/shift/{id}', 'ReportController@shift');
    Route::get('/today-shift/{id}', 'ReportController@today_invoices_shift');
    Route::get('/today-invoice', 'ReportController@today_invoices_ajax');
    Route::get('/report/filter', 'ReportController@filter')->name('report.filter');


    // invoices
    // Route::resource('/invoices', 'InvoicesController');
    Route::group([
        'prefix' => 'invoices',
        'as' => 'invoices.'
    ], function () {
        Route::get('/{invoicesType}', 'InvoicesController@index')->name('index');
        Route::get('/create/{invoicesType}', 'InvoicesController@create')->name('create');
        Route::get('/edit/{invoicesType}/{invoice}', 'InvoicesController@edit')->name('edit');
        Route::post('/update/{invoicesType}/{invoice}', 'InvoicesController@update')->name('update');
        Route::post('/store/{invoicesType}', 'InvoicesController@store')->name('store');
        Route::get('/delete/{id}/{invoicesType}', 'InvoicesController@delete')->name('delete');
        Route::post('/filter/{invoicesType}', 'InvoicesController@filter')->name('filter');
    });
});

Route::group([
    'namespace' => 'Backend',
    'middleware' => 'stockManager'
], function () {
    //dashboard
    Route::resource('/', 'DashboardController');

    //products
    Route::get('/categories/types/edit/{id}', 'ProductsController@getAllTypesEdit')->name('products.types.edit');
    Route::post('/products/search', 'ProductsController@search')->name('products.search');
    Route::resource('/products', 'ProductsController');

    //category
    Route::post('/categories/search', 'CategoriesController@search')->name('categories.search');
    Route::get('/categories/types/edit/{id}', 'CategoriesController@getAllTypesEdit')->name('categories.types.edit');
    Route::get('/categories/types/cat_edit/{id}', 'CategoriesController@getAllTypesEditCategories')->name('categories.cat.types.edit');
    Route::get('/categories/types', 'CategoriesController@getAllTypes')->name('categories.types');
    Route::get('/categories/parents', 'CategoriesController@getAllParents')->name('categories.parents');
    Route::resource('/categories', 'CategoriesController');

    //Report controller
    Route::get('/user-details/{id}', 'ReportController@get_user_details');
    Route::get('/report/storeState', 'ReportController@full_stock');
    Route::get('/report/outOfStock', 'ReportController@getOutOfStock')->name('report.outOfStock');
    Route::get('/report/empty-stock', 'ReportController@empty_stock');
    Route::get('/report/full-stock', 'ReportController@full_stock_ajax');
    Route::get('/all-s-invoices', 'ReportController@all_invoices');
    Route::get('/today-invoices', 'ReportController@today_invoices');
    Route::get('/shift-1', 'ReportController@shift_1');
    Route::get('/shift/{id}', 'ReportController@shift');
    Route::get('/today-shift/{id}', 'ReportController@today_invoices_shift');
    Route::get('/today-invoice', 'ReportController@today_invoices_ajax');
    Route::get('/this-invoices/{id}', 'ReportController@invoice_products');
    Route::get('/today-invoices/{id}', 'ReportController@t_invoice_products');
    Route::get('/report/filter', 'ReportController@filter')->name('report.filter');


    // invoices
    // Route::resource('/invoices', 'InvoicesController');
    Route::group([
        'prefix' => 'invoices',
        'as' => 'invoices.'
    ], function () {
        Route::get('/{invoicesType}', 'InvoicesController@index')->name('index');
        Route::get('/create/{invoicesType}', 'InvoicesController@create')->name('create');
        Route::get('/edit/{invoicesType}/{invoice}', 'InvoicesController@edit')->name('edit');
        Route::post('/update/{invoicesType}/{invoice}', 'InvoicesController@update')->name('update');
        Route::post('/store/{invoicesType}', 'InvoicesController@store')->name('store');
        Route::get('/delete/{id}/{invoicesType}', 'InvoicesController@delete')->name('delete');
        Route::post('/filter/{invoicesType}', 'InvoicesController@filter')->name('filter');
    });
});

Route::group([
    'namespace' => 'Backend',
    'middleware' => 'admin'
], function () {
    //dashboard
    Route::resource('/', 'DashboardController');

    //users
    Route::post('/users/search', 'UsersController@search')->name('users.search');
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
    Route::get('/categories/types/cat_edit/{id}', 'CategoriesController@getAllTypesEditCategories')->name('categories.cat.types.edit');
    Route::get('/categories/types', 'CategoriesController@getAllTypes')->name('categories.types');
    Route::get('/categories/parents', 'CategoriesController@getAllParents')->name('categories.parents');
    Route::resource('/categories', 'CategoriesController');

    //employees
    Route::post('/employees/search', 'EmployeeController@search')->name('employees.search');
    Route::resource('/employees', 'EmployeeController');

    //expenses
    Route::post('/expenses/search', 'ExpenseController@search')->name('expenses.search');
    Route::resource('/expenses', 'ExpenseController');

    //shifts
    Route::post('/shifts/search', 'ShiftController@search')->name('shifts.search');
    Route::resource('/shifts', 'ShiftController');

    //expensesType
    Route::post('/expensesType/search', 'ExpenseTypeController@search')->name('expensesType.search');
    Route::resource('/expensesType', 'ExpenseTypeController');


    //Report controller
    Route::get('/user-details/{id}', 'ReportController@get_user_details');
    Route::get('/report/storeState', 'ReportController@full_stock');
    Route::get('/report/outOfStock', 'ReportController@getOutOfStock')->name('report.outOfStock');
    Route::get('/report/empty-stock', 'ReportController@empty_stock');
    Route::get('/report/full-stock', 'ReportController@full_stock_ajax');
    Route::get('/all-s-invoices', 'ReportController@all_invoices');
    Route::get('/today-invoices', 'ReportController@today_invoices');
    Route::get('/shift-1', 'ReportController@shift_1');
    Route::get('/shift/{id}', 'ReportController@shift');
    Route::get('/today-shift/{id}', 'ReportController@today_invoices_shift');
    Route::get('/today-invoice-ajax', 'ReportController@today_invoices_ajax');
    Route::get('/this-invoices/{id}', 'ReportController@invoice_products');
    Route::get('/today-invoices/{id}', 'ReportController@t_invoice_products');
    Route::get('/report/filter', 'ReportController@filter')->name('report.filter');




    //invoices
//    Route::resource('/invoices', 'InvoicesController');
    Route::group([
        'prefix' => 'invoices',
        'as' => 'invoices.'
    ], function () {
        Route::get('/{invoicesType}', 'InvoicesController@index')->name('index');
        Route::get('/create/{invoicesType}', 'InvoicesController@create')->name('create');
        Route::get('/edit/{invoicesType}/{invoice}', 'InvoicesController@edit')->name('edit');
        Route::post('/update/{invoicesType}/{invoice}', 'InvoicesController@update')->name('update');
        Route::post('/store/{invoicesType}', 'InvoicesController@store')->name('store');
        Route::get('/delete/{id}/{invoicesType}', 'InvoicesController@delete')->name('delete');
        Route::post('/filter/{invoicesType}', 'InvoicesController@filter')->name('filter');
    });
});

/**
 * Errors Pages
 */
Route::get('/401', function () {
    return view('errors.401');
})->name('admin.access');

//Clear Cache facade value:
Route::get('/cache', function() {
    Artisan::call('cache:clear');

    Artisan::call('optimize');

    Artisan::call('route:clear');

    Artisan::call('config:cache');

    return '<h1>Clear cleared</h1>';
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
})->name('user.logout');
