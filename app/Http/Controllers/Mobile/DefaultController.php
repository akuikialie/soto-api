<?php

namespace App\Http\Controllers\Mobile;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DefaultController extends Controller
{
    public function index(): JsonResponse
    {
        $dbTimestamp = '';
        $dbVersion = '';
        try {
            $mysql = DB::select(DB::raw('select version() as version, current_timestamp as db_timestamp'));
            // $postgresql = DB::select(DB::raw('select version() as version, current_timestamp as db_timestamp'));
            // );

            $dbVersion = $mysql[0]->version . ' on ' . env('DB_HOST') . ':' . env('DB_PORT');
            $dbTimestamp = $mysql[0]->db_timestamp;
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
            'App Prefix'        => 'API - MOBILE - DEFAULT',
            'App Timezone'      => env('APP_TIMEZONE'),
            'Engine'            => app()->version(),
            'IP_address'        => $_SERVER['REMOTE_ADDR'],
            'IP_public'         => $this->getUserIpAddr(),
            'IP_server'         => $this->getPublicIP(),
            'PHP'               => phpversion() . '-' . php_sapi_name(),
            'OS'                => php_uname(),
            'OS Time'           => strftime('%c'),
            'DB'                => $dbVersion,
            'DB Time'           => $dbTimestamp,
            'Migrate Status'    => $migrateStatus,
            'Image Version'     => $imageVersion,
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    function getPublicIP()
    {
        // create & initialize a curl session
        $curl = curl_init();
        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, "http://httpbin.org/ip");
        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);
        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);
        $ip = json_decode($output, true);
        return $ip['origin'];
    }

    function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
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
