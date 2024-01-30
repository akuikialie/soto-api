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
Route::prefix('sync')->name('sync.')->group(function () {
    Route::get('/trial', [App\Http\Controllers\Sync\TrialController::class, 'index'])->name('default');
});

Route::prefix('mobile')->name('mobile.')->group(function () {
    Route::get('/', [App\Http\Controllers\Mobile\DefaultController::class, 'index'])->name('default');
});
Route::prefix('external')->name('external.')->group(function () {
    Route::get('/', [App\Http\Controllers\External\DefaultController::class, 'index'])->name('default');
    Route::prefix('whatsapp-gateway')->name('whatsapp-gateway.')->group(function () {
        Route::post('/send-test', [App\Http\Controllers\External\WhatsappGateway\SendTestController::class, 'index'])->name('default');
    });
    Route::prefix('network-gateway')->name('whatsapp-gateway.')->group(function () {
        Route::get('/sync', [App\Http\Controllers\External\NetworkGateway\SyncController::class, 'index'])->name('default');
    });
});

Route::prefix('panel')->name('panel.')->group(function () {
    Route::prefix('notification')->name('notification.')->group(function () {
        Route::prefix('templates')->name('templates.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Template\IndexController::class, 'index'])->name('index');
        });
        Route::prefix('devices')->name('devices.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Device\IndexController::class, 'index'])->name('index');
        });
        Route::prefix('targets')->name('targets.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Target\IndexController::class, 'index'])->name('index');
        });
        Route::prefix('schedules')->name('schedules.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Schedule\IndexController::class, 'index'])->name('index');
        });
        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'index'])->name('index');
            Route::get('/request', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'indexRequest'])->name('index');
            Route::put('/request/{id}/now', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'updateRequestNow'])->name('index');
            Route::get('/sent', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'indexSent'])->name('index');
            Route::get('/draft', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'indexDraft'])->name('index');
            Route::put('/draft/{id}/now', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'updateDraftNow'])->name('index');
            Route::get('/archive', [App\Http\Controllers\Panel\Notification\Message\IndexController::class, 'indexArchive'])->name('index');

        });
    });

     Route::prefix('master')->name('master.')->group(function () {
        Route::prefix('targets')->name('targets.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Notification\Target\IndexController::class, 'index'])->name('index');
        });
     });

     Route::prefix('hris')->name('hris.')->group(function () {
        Route::prefix('employees')->name('employees.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Hris\Employee\IndexController::class, 'index'])->name('index');
        });
        Route::prefix('employee-presences')->name('employees-presence.')->group(function () {
            Route::get('/', [App\Http\Controllers\Panel\Hris\EmployeePresence\IndexController::class, 'index'])->name('index');
        });
     });

    Route::get('/', [App\Http\Controllers\Mobile\DefaultController::class, 'index'])->name('default');
});
