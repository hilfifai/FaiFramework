<?php


class WatsapWaApi
{
    public static function send_message($nomor_receive, $pesan)
    {
        $api_key   = '55c14b87ee0d36aa3c8ffd6071b59f192ef104b3'; // API KEY Anda
        $id_device = '9634'; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-message'; // URL API
        $no_hp = '628987423444'; // No.HP yang dikirim (No.HP Penerima)
        $pesan = '😁 Halo Terimakasih 🙏'; // Pesan yang dikirim
        //120363335246266139
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp'   => $no_hp,
            'pesan'   => $pesan
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
    public static function send_media($nomor_receive, $pesan, $link_media)
    {

        $api_key   = '55c14b87ee0d36aa3c8ffd6071b59f192ef104b3'; // API KEY Anda
        $id_device = '9634'; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-media'; // URL API
        $no_hp = '628987423444'; // No.HP yang dikirim (No.HP Penerima)
        $pesan = '😁 Halo Terimakasih 🙏'; // Caption/Keterangan Gambar
        $tipe  = 'image'; // Tipe Pesan Media Gambar
        $link  = $link_media; // Link atau URL FILE MEDIA (.jpg, .jpeg, .png)

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp'   => $no_hp,
            'pesan'   => $pesan,
            'tipe'    => $tipe,
            'link'    => $link
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        return $response;
        die;
    }
}
