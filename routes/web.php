<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('default');
});

Route::prefix('transaction')->name('transaction.')->group(function () {
    Route::get('/', 'TransactionController@index')->name('index');
    Route::get('create', 'TransactionController@create')->name('create');
    Route::post('store', 'TransactionController@store')->name('store');
    Route::get('view/{id}', 'TransactionController@show')->name('view');
});

Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/', 'VendorController@index')->name('index');
    Route::get('create', 'VendorController@create')->name('create');
    Route::post('store', 'VendorController@store')->name('store');
    Route::get('view/{id}', 'VendorController@show')->name('view');
    Route::put('update/{id}', 'VendorController@update')->name('update');
    Route::get('delete/{id}', 'VendorController@destroy')->name('delete');
});

Route::prefix('journal')->name('journal.')->group(function () {
    Route::get('/', 'JournalController@index')->name('index');
    Route::get('create', 'JournalController@create')->name('create');
    Route::post('store', 'JournalController@store')->name('store');
    Route::get('view/{id}', 'JournalController@show')->name('view');
    Route::put('update/{id}', 'JournalController@update')->name('update');
    Route::get('delete/{id}', 'JournalController@destroy')->name('delete');
});