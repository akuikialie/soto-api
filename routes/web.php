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
    return view('welcome');
});

Route::prefix('transaction')->name('transaction.')->group(function () {
    Route::get('/', 'TransactionController@index')->name('index');
    Route::get('create', 'TransactionController@create')->name('create');
    Route::post('store', 'TransactionController@store')->name('store');
    Route::get('view/{id}', 'TransactionController@show')->name('view');
});