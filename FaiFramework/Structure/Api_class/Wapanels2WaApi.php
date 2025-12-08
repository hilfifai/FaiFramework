<?php


class Wapanels2WaApi
{
    public static function send_message($nomor_receive, $pesan)
    {
        $curl = curl_init();
        $token = "";
        $data = [
            'api_key' => 'yhSCyVFDtNtklv8Zw5C7vgLmKAUU3eJdaKI9mZqAFwV2gJKLMA',
            'sender' => '62895807911804',
            'number' => $nomor_receive,
            'message' => $pesan
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.wapanels.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => 'f1b212d9-d8b6-40cf-b230-6101162c8b36',
                'authkey' => 'yhSCyVFDtNtklv8Zw5C7vgLmKAUU3eJdaKI9mZqAFwV2gJKLMA',
                'to' => $nomor_receive,
                'message' => $pesan,
                'sandbox' => 'false'
            ),
        ));



        echo $response = curl_exec($curl);

        @curl_close($curl);
        return $response;
    }
    public static function send_media($nomor_receive, $pesan, $link_media)
    {

        $curl = curl_init();
        print_R(array(
                'appkey' => '88e0d8b0-5d75-4c57-b3d4-fa719768b06e',
                'authkey' => 'yhSCyVFDtNtklv8Zw5C7vgLmKAUU3eJdaKI9mZqAFwV2gJKLMA',
                'to' =>  '628987423444@c.us',
                'message' => $pesan?$pesan:'-',
                'file' => $link_media,
                'sandbox' => 'false'
            ));
        echo $nomor_receive;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.wapanels.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => '88e0d8b0-5d75-4c57-b3d4-fa719768b06e',
                'authkey' => 'yhSCyVFDtNtklv8Zw5C7vgLmKAUU3eJdaKI9mZqAFwV2gJKLMA',
                'to' =>  '120363335246266139',
                'message' => $pesan?$pesan:'-',
                'file' => $link_media,
                'sandbox' => 'false'
            ),
        ));

        $response = curl_exec($curl);

        @curl_close($curl);
        //echo $response;

        return $response;
        die;
    }
}
