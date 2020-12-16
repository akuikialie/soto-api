<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('journal', 'Api\JournalController@index');
Route::post('journal', 'Api\JournalController@store');

Route::get('transaction', 'Api\TransactionController@index');
Route::post('transaction', 'Api\TransactionController@store');

Route::get('vendor', 'Api\VendorController@index');
Route::post('vendor', 'Api\VendorController@store');