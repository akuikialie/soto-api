<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\DigitalImpressionController;
use App\Http\Controllers\Dashboard\DnaController;
use App\Http\Controllers\Dashboard\CompareImpressionController;
use App\Http\Controllers\Dashboard\ReputationController;
use App\Http\Controllers\Dashboard\EngagementController;
use App\Http\Controllers\Dashboard\Master\ObjectController;

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

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('digital-impression', [DigitalImpressionController::class, 'index'])
         ->name('digital-impression-index');
    Route::get('digital-impression-brief', [DigitalImpressionController::class, 'indexBrief'])
         ->name('digital-impression-brief');

    Route::get('dna', [DnaController::class, 'index'])
         ->name('dna');
    
    Route::get('compare-impression-internal', [CompareImpressionController::class, 'indexInternal'])
         ->name('compare-impression-internal');
    Route::get('compare-impression-internal', [CompareImpressionController::class, 'indexExternal'])
         ->name('compoare-impression-external');

    Route::get('reputation', [ReputationController::class, 'index'])
         ->name('reputation');
     Route::get('reputation/data', [ReputationController::class, 'data'])
         ->name('reputation-data');

    Route::get('engagement', [EngagementController::class, 'index'])
         ->name('engagement');

    Route::prefix('master')->name('master.')->group(function () {
        Route::name('object.')->prefix('object')->group(function () {
            Route::get('/', 'Dashboard\Master\ObjectController@index')->name('index');
            // Route::get('/create', 'Dashboard\Superadmin\DonorController@create')->name('create');
               // Route::get('/{code}/detail', 'Dashboard\Superadmin\DonorController@detail')->name('detail');
               // Route::get('/data', 'Dashboard\Master\ObjectController@data')->name('data');
               // Route::post('/store', 'Dashboard\Superadmin\DonorController@store')->name('store');
               // Route::post('/{id}/update', 'Dashboard\Superadmin\DonorController@update')->name('update');
               // Route::get('/destroy', 'Dashboard\Superadmin\DonorController@destroy')->name('destroy');
        });
        Route::name('tag.')->prefix('tag')->group(function () {
            Route::get('/', 'Dashboard\Master\TagController@index')->name('index');
            // Route::get('/create', 'Dashboard\Superadmin\DonorController@create')->name('create');
            Route::get('/{id}/detail', 'Dashboard\Master\TagController@detail')->name('detail');
            // Route::get('/data', 'Dashboard\Master\TagController@data')->name('data');
            // Route::post('/store', 'Dashboard\Superadmin\DonorController@store')->name('store');
            Route::post('/{id}/update', 'Dashboard\Master\TagController@update')->name('update');
            // Route::get('/destroy', 'Dashboard\Superadmin\DonorController@destroy')->name('destroy');
        });
        Route::name('schedule.')->prefix('schedule')->group(function () {
            Route::get('/', 'Dashboard\Master\ScheduleController@index')->name('index');
            Route::get('/create', 'Dashboard\Master\ScheduleController@create')->name('create');
            Route::post('/store', 'Dashboard\Master\ScheduleController@store')->name('store');
            Route::get('/{id}/detail', 'Dashboard\Master\ScheduleController@detail')->name('detail');
            Route::get('/{id}/sync', 'Dashboard\Master\ScheduleController@sync')->name('sync');
        });

        Route::name('trend.')->prefix('trend')->group(function () {
          Route::get('/', 'Dashboard\Master\TrendController@index')->name('index');
          Route::get('/{id}/detail', 'Dashboard\Master\TrendController@detail')->name('detail');
      });
    });
});
