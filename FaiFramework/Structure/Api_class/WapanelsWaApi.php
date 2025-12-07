<?php


class WapanelsWaApi
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
              CURLOPT_URL => 'https://wa.srv29.wapanels.com/send-message',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode($data),
              CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
              ),
              ));
                                                    
              $response = curl_exec($curl);
                                                    
              curl_close($curl);
              
              return $response;
    }

    public static function send_media($nomor_receive, $pesan, $link_media)
    {
        $curl = curl_init();
        $token = "";
        $data = [
        'api_key' => 'yhSCyVFDtNtklv8Zw5C7vgLmKAUU3eJdaKI9mZqAFwV2gJKLMA',
        'sender' => '62895807911804',
        'number' => $nomor_receive,
        'media_type' => 'image',
        'caption' => $pesan,
        'url' => $link_media,
        'message' => ''
              ];
       $curl = curl_init();
                                                    
             curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://wa.srv29.wapanels.com/send-media',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode($data),
              CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
              ),
              ));
                                                    
              $response = curl_exec($curl);
                                                    
              curl_close($curl);
               $response;
        return($response);
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
        curl_close($curl);
        echo "<pre>";
        return($result);
    }
}
