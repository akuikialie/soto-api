<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NotificationMessage;
use GuzzleHttp\Client;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-message:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Message Notification WA';

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
        \Log::info("Send Message! - START");
        $data = NotificationMessage::actived()
            ->whereNull('sent_at')
            ->get();
        foreach ($data as $key => $value) {
            \Log::info("Send ID : ". $value->id);
            $sendMessage = $this->send(
                $value->notificationTarget->phone,
                $value->scheduled_at,
                $value->notificationWhatsappDevice->secret_token,
                $value->content
            );

            if ($sendMessage->status) {
                $value->sent_at = Carbon::now()->format('Y-m-d H:i:s');
                $value->save();
            } else {
                \Log::error("Send To Fonnte Failed (ID : " . $value->id . ") : " . json_encode($sendMessage));
            }
        }
        \Log::info("Send Message! - END");
    }

    private function send($target, $sendScheduleAt, $deviceToken, $message)
    {
        $client = new Client([
            'verify' => false
        ]);

        $dateTime = $sendScheduleAt;
        $tz_from = 'Asia/Jakarta';
        $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from));

        $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
        $dateTimeUTCInteger = strtotime($dateTimeUTC);

        $response = $client->post(
            'https://api.fonnte.com/send',
            [
                'headers' => [
                    'Authorization' => $deviceToken,
                ],
                'form_params' =>
                [
                    'target' => $target,
                    'message' => $message,
                    'schedule' => $dateTimeUTCInteger,
                    'typing' => true,
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        return $body;
    }
}
