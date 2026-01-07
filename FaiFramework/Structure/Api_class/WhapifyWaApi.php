<?php


class WhapifyWaApi
{
    public static function send_message($page, $nomor_receive, $pesan)
    {
        $curl = curl_init();
        $token = "";
        $nomor_receive = str_replace("@c.us","",$nomor_receive);
        

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://whapify.id/api/send/whatsapp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'secret' => 'e91bab171206e34f451a7f0e499f6d97209128c1',
                'account' => '1767688490979d472a84804b9f647bc185a877a8b5695cc92a389ee',
                'recipient' => $nomor_receive,
                'type' => 'text',
                'message' => $pesan,
            ),
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=uvsu3q2o8hke1nhncl0kns1rk5'
            ),
        ));

        $response = curl_exec($curl);

        @curl_close($curl);

        return $response;
    }

    public static function send_media($page,$nomor_receive, $pesan, $link_media,$media_type='image')
    {
        $curl = curl_init();
        $token = "";

        $nomor_receive = str_replace("@c.us","",$nomor_receive);
        $curl = curl_init();
        print_r(array(
            'secret' => 'e91bab171206e34f451a7f0e499f6d97209128c1',
            'account' => '1734232174cf004fdc76fa1a4f25f62e0eb5261ca3675e486e4f8e5',
            'recipient' => $nomor_receive,
            'message' => $pesan,
            'type' => 'media',
            'media_url' => $link_media,
            'media_type' => $media_type
        ));
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://whapify.id/api/send/whatsapp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'secret' => 'e91bab171206e34f451a7f0e499f6d97209128c1',
                'account' => '1734232174cf004fdc76fa1a4f25f62e0eb5261ca3675e486e4f8e5',
                'recipient' => $nomor_receive,
                'message' => $pesan,
                'type' => 'media',
                'media_url' => $link_media,
                'media_type' => $media_type
            ),
            CURLOPT_HTTPHEADER => array(
                'Cookie: PHPSESSID=uvsu3q2o8hke1nhncl0kns1rk5'
            ),
        ));

        $response = curl_exec($curl);

        @curl_close($curl);

        return $response;
    }
    function schedule($nomor_receive, $pesan, $isgroup, $date, $time)
    {
        $curl = curl_init();
        $token = "";
        $data = [
            'phone' => $nomor_receive,
            'date' => $date,
            'time' => $time,
            'timezone' => 'Asia/Jakarta',
            'message' => $pesan,
            'isGroup' => $isgroup,
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://kudus.wablas.com/api/schedule");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        @curl_close($curl);
        echo "<pre>";
        return ($result);
    }
}
