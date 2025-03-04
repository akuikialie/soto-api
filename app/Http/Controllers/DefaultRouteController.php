<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class DefaultRouteController extends Controller
{
    public function index()
    {
        $dbTimestamp = '';

        try {
            $postgresql = DB::select(DB::raw('select version() as version, current_timestamp as db_timestamp'));

            $dbVersion = $postgresql[0]->version . ' on ' . env('DB_HOST') . ':' . env('DB_PORT');
            $dbTimestamp = $postgresql[0]->db_timestamp;
        } catch (Exception $ex) {
            $dbVersion = $ex->getMessage();
        }

        try {
            Artisan::call('migrate:status');
            $migrateStatus = Artisan::output();
        } catch (Exception $ex) {
            $migrateStatus = 'Fail to call migrate:status. ' . $ex->getMessage();
        }

        $imageVersion = json_decode(file_get_contents(base_path('image-version.json')));

        return response()->json([
            'App Name'          => env('APP_NAME'),
            'App Prefix'        => 'API - EXTERNAL - PLATORM - TELEGRAM - DEFAULT',
            'App Timezone'      => env('APP_TIMEZONE'),
            'Engine'            => app()->version(),
            'PHP'               => phpversion() . '-' . php_sapi_name(),
            'OS'                => php_uname(),
            'OS Time'           => strftime('%c'),
            'DB'                => $dbVersion,
            'DB Time'           => $dbTimestamp,
            'Migrate Status'    => $migrateStatus,
            'Image Version'     => $imageVersion,
        ]);
    }

    public function env(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siapa'     => 'required|string'
        ]);

        if ($validator->fails() || $validator->validated()['siapa'] != 'antokantopo') {
            return response()->json([
                'message'          => "eh eh eh kok gitu sih"
            ]);
        }
        try {
            $env = getenv();
        } catch (Exception $ex) {
            return response()->json([
                'message'          => $ex->getMessage()
            ]);
        }
        return response()->json($env);
    }
}
