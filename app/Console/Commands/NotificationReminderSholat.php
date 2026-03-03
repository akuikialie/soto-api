<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Telegram;

class NotificationReminderSholat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:reminder-sholat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.myquran.com/v3/sholat/jadwal/cfa0860e83a4c3a763a7e62d825349f7/today?tz=Asia%2FJakarta",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => ["Accept: application/json"],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $jsonResponse = json_decode($response);
        if ($jsonResponse->status) {
            $jadwalSholat = [];
            $tanggalJadwal = '';
            foreach($jsonResponse->data->jadwal as $k => $val) {
                foreach($val as $kItem => $valItem) {
                    if ($kItem === 'tanggal') {
                        $tanggalJadwal = $valItem;
                    }
                    if ($kItem === 'imsak') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                    if ($kItem === 'subuh') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                    if ($kItem === 'dzuhur') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                    if ($kItem === 'ashar') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                    if ($kItem === 'maghrib') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                    if ($kItem === 'isya') {
                        $jadwalSholat[$kItem] =  $valItem;
                    }
                }
            }

            $textTemplate = "[JADWAL SHOLAT]
Tanggal : ".$tanggalJadwal."
________

";
            foreach ($jadwalSholat as $key => $value) {
                $textTemplate .= strtoupper($key) . ' : ' . $value. ' | ';
            }

            Telegram::sendTelegram('154542013', $textTemplate);
        }
    }
}
