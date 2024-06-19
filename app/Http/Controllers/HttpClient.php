<?php

namespace App\Http\Controllers;


class HttpClient
{
      public const URL = 'https://restpilot.paylink.sa';
//    public const URL = 'https://paylinkapi.eu.ngrok.io';
  //public const URL = 'https://restapi.paylink.sa';

    public static function execute($ch, bool $closeAfterDone = true)
    {
        $curlResponse = curl_exec($ch);
        if ($curlResponse === false) {
            $curlErrNo = curl_errno($ch);
            $curlError = curl_error($ch);
            if ($closeAfterDone) {
                curl_close($ch);
            }
            print_r(sprintf('Curl error (code %d): %s', $curlErrNo, $curlError));
            throw new \RuntimeException(sprintf('Curl error (code %d): %s', $curlErrNo, $curlError));
        }
        if ($closeAfterDone) {
            curl_close($ch);
        }
        return $curlResponse;
    }

    public static function login()
    {     
          ////Old Test
        // APP_ID_1123453311
        // 0662abb5-13c7-38ab-cd12-236e58f43766
        
        ///New Test
        //APP_ID_1688458562228
        //619486c8-2768-3b60-a662-d39ee1214716
        
        
        
        //live
        //APP_ID_1686650936523
        //644354ce-b6ca-424f-b868-8e76b8b34c1c
        $postData = [
            'persistToken' => false,
            'apiId' => 'APP_ID_1688458562228',
            'secretKey' => '619486c8-2768-3b60-a662-d39ee1214716',
        ];
        $json = self::postRequest($postData, '/api/auth');
        return $json->id_token;
    }

    public static function getRequest($url, $token = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::URL . $url); // the endpoint in paylink to generate the token.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($token) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ]);
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
        }
        return json_decode(self::execute($curl));
    }

    /**
     * @param $postData
     * @param $url
     * @return mixed
     */
    public static function postRequest($postData, $url, $headers = [])
    {
        $headers = array_merge(['Content-Type: application/json'], $headers);
        $postString = json_encode($postData);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, self::URL . $url); // the endpoint in paylink to generate the token.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postString);
        return json_decode(self::execute($curl));
    }
}
