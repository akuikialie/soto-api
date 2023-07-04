<?php

namespace App\Http\Controllers\Sync;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\NotificationMessage;
use Illuminate\Http\JsonResponse;

use GuzzleHttp\Client;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class TrialController extends Controller
{
  public function index(): JsonResponse
  {
    $data = NotificationMessage::actived()
      ->whereNull('sent_at')
      ->get();
    foreach ($data as $key => $value) {
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
    return response()->json([
      'data' => $data,
    ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
  }

  private function send($target, $sendScheduleAt, $deviceToken, $message)
  {
    // echo $target;
    // echo $sendScheduleAt;
    // echo $deviceToken;
    // echo $message;
    $client = new Client([
      'verify' => false
    ]);
    // // $target[] = '085730432092|Ali|Superadmin';
    // // $target[] = '081917787195|Umi Ayam Aldi|Pasar';
    // // $target[] = '081230788990|Abah Yusuf Ayam|Pasar';
    // $target[] = '087840180475|Anak Abah Kholili|Pasar';
    // // $target[] = '085733171373|Tifani|Finance';
    // // $target[] = '081917787195';

    // var_dump($target);
    // return;
    // exit;

    // $dateTime = '2023-06-30 12:40:00';
    $dateTime = $sendScheduleAt;
    $tz_from = 'Asia/Jakarta';
    $newDateTime = new DateTime($dateTime, new DateTimeZone($tz_from));

    $dateTimeUTC = $newDateTime->format("Y-m-d H:i:s");
    $dateTimeUTCInteger = strtotime($dateTimeUTC);

    // $target = implode(',', $target);
    $response = $client->post(
      'https://api.fonnte.com/send',
      [
        'headers' => [
          'Authorization' => $deviceToken,
          // 'Authorization' => env('FONNTE_TOKEN'),
          // 'Authorization' => 'nAhCYxuXJx2VrZJAaSt7', // WA IPHONE
          // 'Authorization' => 'GdJ14EeFJ7W89i57j81b', // WA BISNIS
        ],
        'form_params' =>
        [
          'target' => $target,
          // 'message' => 'Assalamualaikum, ayam 2',
          'message' => $message,
          // 'schedule' => '1687329757',
          'schedule' => $dateTimeUTCInteger,
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
