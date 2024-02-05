<?php

namespace App\Http\Controllers\External\NetworkGateway;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class SyncController extends Controller
{

    private function checkEnv($uriDefault, $xApiKey = null) {
        try {
            $client = new Client([
                'verify' => false]
            );
            $headers = [
              'x-api-key' => 'internal-klinikoo',
              'api-key' => 'oFKyiuiFTQ'
            ];
            $request = new Psr7Request(
                'GET',
                $uriDefault,
                $headers
            );
            $res = $client->sendAsync($request)->wait();

            if ($res->getStatusCode() !== 200) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function checkDatabase() {
        DB::connection('klinikoo')->getPdo();
        if(DB::connection('klinikoo')->getDatabaseName()){
            return true;
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }
        return false;
        // } else {
        //     retrn false;
        //     die("Could not find the database. Please check your configuration.");
        // }
    }

    private function checkRedis() {

    }

    public function index()
    {
        $service = [
            'modules' => [
                'homepage_klinikoo' => null,
                'dashboard_klinikoo' => null,
                'dokter_klinikoo' => null,
                'pasien_klinikoo' => null,

                'mitra_stage_klinikoo' => null,
                'homepage_stage_klinikoo' => null,
            ],
            'configurations' => [
                'mariadb' => null,
            ],
        ];
        if ($responseHomepage = $this->checkEnv('https://klinikoo.id/env')) {
            $service['modules']['homepage_klinikoo'] = $responseHomepage;
        }
        if ($responseMitra = $this->checkEnv('https://mitra.klinikoo.id/env')) {
            $service['modules']['mitra_stage_klinikoo'] = $responseMitra;
        } else {
            $service['modules']['mitra_stage_klinikoo'] = false;
        }
        if ($responseHomepageStage = $this->checkEnv('https://stage.klinikoo.id')) {
            $service['modules']['homepage_stage_klinikoo'] = $responseHomepageStage;
        } else {
            $service['modules']['homepage_stage_klinikoo'] = false;
        }
        if ($responseDashboard = $this->checkEnv('https://dashboard.klinikoo.id')) {
            $service['modules']['dashboard_klinikoo'] = $responseDashboard;
        } else {
            $service['modules']['dashboard_klinikoo'] = false;
        }
        if ($responseDokterLandingPage = $this->checkEnv('https://dokterapp.klinikoo.id')) {
            $service['modules']['dokter_klinikoo'] = $responseDokterLandingPage;
        } else {
            $service['modules']['dokter_klinikoo'] = false;
        }
        if ($responseDokterLandingPage = $this->checkEnv('https://apipasien.klinikoo.id/api/v2/my-env')) {
            $service['modules']['pasien_klinikoo'] = $responseDokterLandingPage;
        } else {
            $service['modules']['pasien_klinikoo'] = false;
        }

        // if ($responseDatabase = $this->checkDatabase()) {
        //     $service['configurations']['mariadb'] = $responseDatabase;
        // }

        $message = 'Assalamualaikum, ijin share status server.
|------------------|---------------------|
';
        $index = 1;
        foreach ($service as $key => $val) {
            foreach ($val as $keyDetail => $valueDetail) {
                if (!is_null($valueDetail) && ($valueDetail === false)) {
                $message .= '  '.$index. ' . ['. strtoupper($keyDetail).'] = '. ($valueDetail ? '*ONLINE*' : '_*OFFLINE*_'). "
";
                    $index++;
                }
            }
        }
        $message .= '|------------------|---------------------|';
        $message .= '


';
        $message .= 'Powered _akuikialie.github.io_ - *Bot Whatsapp*';

        $this->sendNotifWa($message, '085730432092');

        return response()->json([
            'data' => $service,
            'status' => true,
            'code' => 200,
        ]);
    }

    private function sendNotifWa($message, $phone) {
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
                    'Authorization' => 'nAhCYxuXJx2VrZJAaSt7', // WA IPHONE
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
}
