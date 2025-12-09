<?php


class WablasWaApi
{
    function send_message($nomor_receive, $pesan)
    {
        $curl = curl_init();
        $token = "";
        $data = [
            'phone' => $nomor_receive,
            'message' => $pesan,
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
        curl_setopt($curl, CURLOPT_URL,  "https://kudus.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        @curl_close($curl);
        echo "<pre>";
        print_r($result);
    }

    function send_media($nomor_receive, $pesan, $link_media)
    {
        $curl = curl_init();
        $token = "";
        $data = [
            'phone' => $nomor_receive,
            'image' => $link_media,
            'caption' => $pesan,
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
        curl_setopt($curl, CURLOPT_URL,  "https://kudus.wablas.com/api/send-image");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        @curl_close($curl);
        echo "<pre>";
        print_r($result);
    }
    function schedule($nomor_receive, $pesan, $isgroup,$date,$time)
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
        curl_setopt($curl, CURLOPT_HTTPHEADER,
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
        print_r($result);
    }
}
