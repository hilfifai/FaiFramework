<?php
// define("SERVER_KEY_PAYMENT", "SB-Mid-server-nqV_1C85dJJgOEOlwS-YN1M8");
define("URL_PAYMENT", "https://api.sandbox.midtrans.com/v2/");
// define("SERVER_KEY_PAYMENT","SB-Mid-server-K5hrfDcB8rtpTk6oPDAwt2Nh");
// define("SERVER_KEY_PAYMENT","Mid-server-qLsWbwkWKK9kMT_lMN0bjOIt");
// define("URL_PAYMENT","https://api.midtrans.com/v2/");
class MidtransPaymentGatewayApi
{
    public static function getStatus2($url, $server_key, $orderID)
    {
        $url     = $url . $orderID . '/status/b2b';

        $options = [
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($server_key . ':')
            ],


        ];
        $ch      = curl_init($url);  // Inisialisasi Curl
        curl_setopt_array($ch, $options);  // Set Opsi
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch); // Eksekusi Curl
        @curl_close($ch);  // Stop atau tutup script
        return $content;
    }
    public static function getStatus($url, $server_key, $orderID)
    {
        $url = $url . $orderID . '/status/';

        // persiapkan curl
        $ch  = curl_init();
        $post = array(
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($server_key . ':'),
        );
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $post);
        // set user agent

        // return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // tutup curl
        @curl_close($ch);

        // mengembalikan hasil curl
        return $output;
    }

    public static function get_change_status($order_id, $get = 'status')
    {
        $server_key = SERVER_KEY_PAYMENT;

        $url = URL_PAYMENT . $order_id . "/" . $get;
        //echo $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $headers = array(
            "Accept: application/json",
            "Authorization: Basic " . base64_encode($server_key . ':'),
            "Content-Type: application/json",
            "Content-Length: 0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        @curl_close($curl);
        //var_dump($resp);


        return $resp;
    }

    public static function remotePost($postData)
    {

        $server_key = SERVER_KEY_PAYMENT;
        $url = URL_PAYMENT . "charge";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Authorization: Basic " . base64_encode($server_key . ':'),
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //print_r($postData);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        //print_r($resp);
        return $resp;
    }
}
