<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')->name('customers.')->group(function(){
    Route::get('/', 'CustomersController@index')->name('index');
    Route::get('/menu/{id}', 'CustomersController@show')->name('show');
    Route::get('/cart', 'CustomersController@cart')->name('cart');
    Route::get('/cart/clear', 'CustomersController@clearCart')->name('clearCart');
    Route::post('/add', 'CustomersController@addToCart')->name('addToCart');
    Route::post('/cart', 'CustomersController@order')->name('order');
    Route::post('/thanks', 'CustomersController@thanks')->name('thanks');
});

Route::prefix('kasir')->name('kasir.')->group(function(){
    Route::get('/', 'CashiersController@index')->name('index');
    Route::post('/', 'CashiersController@pilih')->name('pilih');
    Route::post('/process', 'CashiersController@process')->name('process');
    Route::get('/bill/{bill}', 'CashiersController@bill')->name('bill');
});

Route::prefix('backs')->name('backs.')->group(function(){
    Route::get('/', 'BacksController@index')->name('index');
});

Route::prefix('menus')->name('menus.')->group(function(){
    Route::get('/', 'MenusController@index')->name('index');
    Route::post('/', 'MenusController@store')->name('store');
    Route::get('/create', 'MenusController@create')->name('create');
    Route::get('/{id}/edit', 'MenusController@edit')->name('edit');
    Route::patch('/{id}', 'MenusController@update')->name('update');
    Route::delete('/', 'MenusController@delete')->name('delete');
});


Route::prefix('orders')->name('orders.')->group(function(){
    Route::get('/', 'OrdersController@index')->name('index');
    Route::post('/update', 'OrdersController@update')->name('update');
});

Route::prefix('accounts')->name('accounts.')->group(function(){
    Route::get('/', 'AccountsController@index')->name('index');
    Route::get('/create', 'AccountsController@create')->name('create');
    Route::post('/', 'AccountsController@store')->name('store');
    Route::get('/{id}/edit', 'AccountsController@edit')->name('edit');
    Route::patch('/{id}/update', 'AccountsController@update')->name('update');
    Route::delete('delete/{id}', 'AccountsController@delete')->name('delete');
});

Route::prefix('report')->name('reports.')->group(function(){
    Route::get('/', 'ReportsController@index')->name('index');
});


Auth::routes();


