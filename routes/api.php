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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/',  [DefaultRouteController::class, 'index'])
//     // ->middleware('log')
//     ->name('api.default.index');

// Route::post('/env',  [DefaultRouteController::class, 'env'])
//     ->name('api.default.post.env');
// Route::get('/env',  [DefaultRouteController::class, 'env'])
//     ->name('api.default.get.env');

Route::prefix('mobile')->name('mobile.')->group(function () {
    Route::get('/', [App\Http\Controllers\Mobile\DefaultController::class, 'index'])->name('default');
});
Route::prefix('external')->name('external.')->group(function () {
    Route::get('/', [App\Http\Controllers\External\DefaultController::class, 'index'])->name('default');
    Route::prefix('whatsapp-gateway')->name('whatsapp-gateway.')->group(function () {
        Route::post('/send-test', [App\Http\Controllers\External\WhatsappGateway\SendTestController::class, 'index'])->name('default');
    });
});
