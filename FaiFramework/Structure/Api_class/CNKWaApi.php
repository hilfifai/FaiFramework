<?php 

define("TOKENWAAPI", "be0a9d60b7d733efe2209573fa6a67f3ff2d6f90");
class CNKWaApi{
  
    public static function send_message($nomor_receive,$pesan){
            echo $pesan;
            
          $body = array(
          "api_key" => TOKENWAAPI,
          "receiver" => $nomor_receive,
          "data" => array("message" => $pesan)
        );
        
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://chatbot.hibe3.com/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($body),
          CURLOPT_HTTPHEADER => [
            "Accept: */*",
            "Content-Type: application/json",
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
     public static function send_media($nomor_receive,$pesan,$link_media){
        
        $body = array(
             "api_key" => TOKENWAAPI,
            "receiver" => $nomor_receive,
            "data"=>array(
              "url" => $link_media,
              "media_type" => "image",
              "caption" => $pesan
            )
          );
          
          $curl = curl_init();
          curl_setopt_array($curl, [
            CURLOPT_URL => "https://chatbot.hibe3.com/api/send-media",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
              "Accept: */*",
              "Content-Type: application/json",
            ],
          ]);
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            echo $response;
          }
    }
}