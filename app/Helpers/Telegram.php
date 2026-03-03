<?php

namespace App\Helpers;

class Telegram {

    public static function sendTelegram($chatId = null, $message = 'default-message')
    {
        $params = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        $curl = curl_init();

        $urlSendTelegram = 'https://api.telegram.org/bot8402889913:AAGDSjg9QBnK3So0NJCmykHVIhTcSLoivEo/sendMessage?'.http_build_query($params);

        curl_setopt_array($curl, array(
          CURLOPT_URL => $urlSendTelegram,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_SSL_VERIFYHOST => false,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }
}