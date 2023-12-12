<?php

namespace App\Http\Controllers\External\WhatsappGateway;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use GuzzleHttp\Client;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class SendTestController extends Controller
{
    public function send($phone, $message)
    {
        // var_dump($request->all());
        // exit;
        $client = new Client([
            'verify' => false
        ]);
        // $target[] = '085730432092|Ali|Superadmin';
        // $target[] = '081917787195|Umi Ayam Aldi|Pasar';
        // $target[] = '081230788990|Abah Yusuf Ayam|Pasar';
        // $target[] = '087840180475|Anak Abah Kholili|Pasar';
        // $target[] = '085733171373|Tifani|Finance';
        // $target[] = '081917787195';

        // var_dump($target);

        // exit;

        // $dateTime = '2023-06-30 12:40:00';
        // $tz_from = 'Asia/Jakarta';
        // $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from));

        // $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
        // // var_dump($dateTimeUTC);
        // $dateTimeUTCInteger = strtotime($dateTimeUTC);
        // var_dump($dateTimeUTCInteger);

        // $newDateTime->setTimezone(new DateTimeZone("UTC"));
        // $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
        // var_dump($dateTimeUTC);
        // $dateTimeUTCInteger = strtotime($dateTimeUTC);
        // var_dump($dateTimeUTCInteger);

        // $target = implode(',', $target);
        $response = $client->post(
            'https://api.fonnte.com/send',
            [
                'headers' => [
                    // 'Authorization' => env('FONNTE_TOKEN'),
                    'Authorization' => 'nAhCYxuXJx2VrZJAaSt7', // WA IPHONE
                    // 'Authorization' => 'GdJ14EeFJ7W89i57j81b', // WA BISNIS
                ],
                'form_params' =>
                [
                    // 'target' => '085730432092',
                    // 'message' => 'via GuzzleHttp',
                    // 'target' => $target,
                    'target' => $phone,
                    'message' => $message,
                    // 'message' => 'Assalamualaikum, ayam 2',
                    // 'schedule' => '1687329757',
                    // 'schedule' => $dateTimeUTCInteger,
                    // 'message' => 'Assalamualaikum, {name} ({var1}). Coba send WhatsappGateway : '. Carbon::now()->format('Y-m-d H:i:s'),
                    // 'message' => 'Coba send WhatsappGateway : '. Carbon::now()->format('Y-m-d H:i:s'),
                    // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                    // 'url' => 'https://cdn-indraco.storage.googleapis.com/icons/hris.jpg',
                    // 'url' => 'https://filesamples.com/samples/document/txt/sample3.txt',
                    // 'location' => '-7.983908, 112.621391',
                    // 'location' => '-7.2929482,112.6971682,17z', // kantor indraco
                    // 'message' => 'test message to {name} as {var1}',
                    'typing' => true,
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        return $body;
        return $body->success;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            if (!$request->has('phone')) {
                return response()->json([
                    'code' => 400,
                    'status' => false,
                    'message' => 'No Phone',
                ], 200);
            }
            if (!$request->has('message')) {
                 return response()->json([
                    'code' => 400,
                    'status' => false,
                    'message' => 'No Message',
                ], 200);
            }
            $sendRequestApi = $this->send($request->phone, $request->message);
            if ($sendRequestApi->status) {
                return response()->json([
                    'code' => 200,
                    'status' => true,
                    'message' => 'Successfull Send',
                    'data' => $sendRequestApi,
                ], 200);
            }

            return response()->json([
                'code' => 200,
                'status' => false,
                'message' => $sendRequestApi->reason,
            ], 200);

            var_dump($sendRequestApi->status);
            var_dump($sendRequestApi);
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => 'Successfull Send',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'code' => 200,
                'status' => false,
                'message' => $ex->getMessage(),
            ], 400);
        }
    //     exit;

    //     // $curl = curl_init();
    //     // curl_setopt_array($curl, array(
    //     //   CURLOPT_URL => 'https://api.fonnte.com/send',
    //     //   CURLOPT_RETURNTRANSFER => true,
    //     //   CURLOPT_ENCODING => '',
    //     //   CURLOPT_MAXREDIRS => 10,
    //     //   CURLOPT_TIMEOUT => 0,
    //     //   CURLOPT_FOLLOWLOCATION => true,
    //     //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     //   CURLOPT_CUSTOMREQUEST => 'POST',
    //     //   CURLOPT_POSTFIELDS => array(
    //     //     'target' => '085730432092',
    //     //     'message' => 'test dari postman laravel'
    //     //     /*
    //     //     'target' => $target,
    //     //     'message' => 'test message to {name} as {var1}',
    //     //     'url' => 'https://md.fonnte.com/images/wa-logo.png',
    //     //     'filename' => 'filename',
    //     //     'schedule' => '0',
    //     //     'typing' => false,
    //     //     'delay' => '2',
    //     //     'countryCode' => '62',
    //     //     'location' => '-7.983908, 112.621391',
    //     //     'buttonJSON' => '{"message":"fonnte button message","footer":"fonnte footer message","buttons":[{"id":"mybutton1","message":"hello fonnte"},{"id":"mybutton2","message":"fonnte pricing"},{"id":"mybutton3","message":"tutorial fonnte"}]}',
    //     //     'templateJSON' => '{"message":"fonnte template message","footer":"fonnte footer message","buttons":[{"message":"fonnte","url":"https://fonnte.com"},{"message":"call me","tel":"6282227097005"},{"id":"mybutton1","message":"hello fonnte"}]}',
    //     //     'listJSON' => '{"message":"fonnte list message","footer":"fonnte footer message","buttonTitle":"fonnte\'s packages","title":"fonnte title","buttons":[{"title":"text only","list":[{"message":"regular","footer":"10k messsages/month","id":"list-1"},{"message":"regular pro","footer":"25k messsages/month","id":"list-2"},{"message":"master","footer":"unlimited messsages/month","id":"list-3"}]},{"title":"all feature","list":[{"message":"super","footer":"10k messsages/month","id":"list-4"},{"message":"advanced","footer":"25k messsages/month","id":"list-5"},{"message":"ultra","footer":"unlimited messsages/month","id":"list-6"}]}]}'
    //     //     */
    //     //     ),
    //     //   CURLOPT_HTTPHEADER => array(
    //     //     'Authorization: nAhCYxuXJx2VrZJAaSt7'
    //     //   ),
    //     // ));

    //     // $response = curl_exec($curl);

    //     // curl_close($curl);

    //     return response()->json([
    //         'App Name'          => env('APP_NAME'),
    //         'App Prefix'        => 'API - EXTERNAL - DEFAULT',
    //         'App Timezone'      => env('APP_TIMEZONE'),
    //         'Engine'            => app()->version(),
    //         'IP_address'        => $_SERVER['REMOTE_ADDR'],
    //         'Fonnte'            => env('FONNTE_TOKEN'),
    //         'PHP'               => phpversion() . '-' . php_sapi_name(),
    //         'OS'                => php_uname(),
    //         'OS Time'           => strftime('%c'),
    //         'response'          => $response,
    //     ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
