<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\ServerException;

class SendNotificationWhatsappKlinikoo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-notification-whatsapp:klinikoo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification WA to Klinikoo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Send Notif Message! - START");

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
                // 'nodejs' => null,
                // 'redisio' => null,
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

        if ($responseDatabase = $this->checkDatabase()) {
            $service['configurations']['mariadb'] = $responseDatabase;
        }
        $message = 'Assalamualaikum, ijin share status server.

|------------------|---------------------|
';
        $index = 1;
        foreach ($service as $key => $val) {
            foreach ($val as $keyDetail => $valueDetail) {
                // if (!$valueDetail) {
            $message .= '  '.$index. ' . ['. strtoupper($keyDetail).'] = '. ($valueDetail ? '_ONLINE_' : '_*OFFLINE*_'). "
";
                    $index++;
                // }
            }
        }
        $message .= '|------------------|---------------------|';
        $message .= '


';
        $message .= 'Powered _akuikialie.github.io_ - *Bot Whatsapp*';

        $this->sendNotifWa($message, '085730432092');
        // $this->sendNotifWa($message, '120363038111231633@g.us');

        \Log::info("Send Notif Message! - END");
    }

    private function checkDatabase() {
        DB::connection('klinikoo')->getPdo();
        if(DB::connection('klinikoo')->getDatabaseName()){
            return true;
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }
        return false;
    }

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
        } catch (ServerException $e) {
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    private function sendNotifWa($message, $phone) {
        $client = new Client([
            'verify' => false
        ]);
        
        $response = $client->post(
            'https://api.fonnte.com/send',
            [
                'headers' => [
                    'Authorization' => 'nAhCYxuXJx2VrZJAaSt7', // WA IPHONE
                ],
                'form_params' =>
                [
                    'target' => $phone,
                    'message' => $message,
                    'typing' => false,
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        return $body;
    }
}
