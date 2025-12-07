<?php

class EthicaApi
{

    public static function detail_user($page, $user_api, $force_api = false, $user_id = '', $overide_versi = '')
    {
        if (! isset($_SESSION['id_apps_user'])) {
            $_SESSION['id_apps_user'] = -1;
        }
        if (empty($user_id)) {
            $user_id = $_SESSION['id_apps_user'];
        }
        if ($user_api['row'][0]->versi == 'Versi 2' or $overide_versi == 'Versi 2') {
            DB::table('api_master__user__content');
            DB::joinRaw('api_master__list__field on api_master__list__field.id = id_api_field', 'left');
            DB::whereRaw("nama_field='customer_seq'");
            DB::whereRaw("id_api_master__user=" . $user_api['row'][0]->primary_key);
            $get_content = DB::get('all');
            if (! $get_content['num_rows']) {
                echo 'Anda Belum Setting customer_seq';
                die;
            } else
            if (! $get_content['row'][0]->content) {
                echo 'Anda Belum Setting customer_seq';
                die;
            } else {
                $cust_seq = $get_content['row'][0]->content;
            }
            DB::table('api_master__user__content');
            DB::joinRaw('api_master__list__field on api_master__list__field.id = id_api_field', 'left');
            DB::whereRaw("nama_field='customer_id'");
            DB::whereRaw("id_api_master__user=" . $user_api['row'][0]->primary_key);
            $get_content = DB::get('all');
            if (! $get_content['num_rows']) {
                echo 'Anda Belum Setting customer_id';
                die;
            } else
            if (! $get_content['row'][0]->content) {
                echo 'Anda Belum Setting customer_id';
                die;
            } else {
                $cotumer_id = $get_content['row'][0]->content;
            }
            $apikey = EthicaApi::get_key_v2($user_id, $cotumer_id, $force_api);
        } else if ($user_api['row'][0]->versi == 'Versi 1' or $overide_versi == 'Versi 1') {
            DB::table('api_master__user__content');
            DB::joinRaw('api_master__list__field on api_master__list__field.id = id_api_field', 'left');
            DB::whereRaw("nama_field='customer_seq'");
            DB::whereRaw("id_api_master__user=" . $user_api['row'][0]->primary_key);
            $get_content = DB::get('all');
            if (! $get_content['num_rows']) {
                echo 'Anda Belum Setting customer_seq';
                die;
            } else
            if (! $get_content['row'][0]->content) {
                echo 'Anda Belum Setting customer_seq';
                die;
            } else {
                $cust_seq = $get_content['row'][0]->content;
            }
            $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
            $link      = $user_api['row'][0]->$type_link;
            $link      = str_replace('{HTTPS}', 'https', $link);
            $link      = str_replace('{HTTP}', 'http', $link);

            $apikey = EthicaApi::get_key($link, $user_id, $cust_seq, $force_api);
        }
        $return['cust_seq']    = $cust_seq ?? 0;
        $return['costumer_id'] = $cotumer_id ?? 0;
        $return['apikey']      = $apikey ?? 0;
        return $return;
    }

    public static function get_key_v2($user, $costumer_id, $force_api = 0)
    {
        if (isset($_SESSION['ethicaApiV2'][date('Y-m-d')][$user]) and ! $force_api) {
            return $_SESSION['ethicaApiV2'][date('Y-m-d')][$user];
        } else {

            $curl = curl_init();
            // 'customer-id: e60db986-db5b-11ee-b044-1a1720bec973',
            //                 'user: ethica_jakut',
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://api.ethica.id/v2/master_customer/get_key_external',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_HTTPHEADER     => [
                    'customer-id: ' . $costumer_id,
                    'user: ' . $user,
                    'Cookie: PHPSESSID=qc7civn2qbafshe1edv32jsnos',
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);
            $response;
            $responseData = json_decode($response, true);
            if ($responseData['status'] == 200) {
                unset($_SESSION['ethicaApiV2']);

                $_SESSION['ethicaApiV2'][date('Y-m-d')][$user] = $responseData['data'][0]['api_key'];
                return $responseData['data'][0]['api_key'];
            } else {
                echo $response;
            }
        }
    }
    public static function get_produk_v2($link, $array = [], $user = '', $costumer_id = '', $attemp = 1)
    {
        $curl = curl_init();
        // print_r($array);
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.ethica.id/v2/master_barang/loaddata_eksternal',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => $array,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        // print_R($responseData);
        if ($responseData['status'] == 200) {

            return $response;
        } else if ($responseData['status'] == 401 and trim($responseData['message']) == 'Unauthorized' and $attemp <= 5) {

            $key      = self::get_key_v2($user, $costumer_id, 1);
            $array[0] = 'key: ' . $key;
            return EthicaApi::get_produk_v2([], $array, $user, $costumer_id, ($attemp + 1));
        } else {
            // echo $response;
            return $response;
        }
    }
    public static function get_sarimbit_v2($page, $link, $array = [], $user_api = [], $attemp = 0)
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link . '/setting_sarimbit_master/loaddata_eksternal',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => $array,
            // array(
            //     'key: 927242bfc145739aedbcca0fe69ccf3',
            //     'offset: 0',
            //     'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'
            // ),
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if (! isset($responseData['status'])) {
            $responseData['status'] = 404;
        }

        if ($responseData['status'] == 200) {

            return $response;
        } else if ($responseData['status'] == 401 and $attemp < 5) {
            $user = EthicaApi::detail_user($page, $user_api, 1);
            return EthicaApi::get_sarimbit_v2($page, $link, $array, $user_api, $attemp + 1);
        } else {
            return $response;
        }
    }
    public static function get_sarimbit_update($link, $array = [])
    {

        $curl = curl_init();
        'https://api.ethica.id/setting_sarimbit_master/load?' . implode('&', $array);
        '<br>';
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.ethica.id/setting_sarimbit_master/load?' . implode('&', $array),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            // CURLOPT_HTTPHEADER => $array
            // array(
            //     'key: 927242bfc145739aedbcca0fe69ccf3',
            //     'offset: 0',
            //     'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'
            // ),
        ]);
        $response_awal = curl_exec($curl);
        if (Partial::input('just_sarimbit')) {

            return $response_awal;
        }
        curl_close($curl);
        $responseData = json_decode($response_awal, true);

        $response = [];
        $offset   = 0;
        'ini Response Data';

        // print_R($response_awal);
        // print_R($responseData);
        'hallo22';

        $angka = 0;
        if (! isset($responseData[0]['seq'])) {
            print_R($responseData);
        } else if ($responseData[0]['keterangan'] == 'Tidak ada data') {
            return "";
        } else {
            'masuk';
            '<pre>';
            $get_barang = EthicaApi::get_barang_update("", ["offset=$offset", "sarimbit_seq=" . $responseData[0]['seq']]);
            $get_barang = json_decode($get_barang, true);
            if (count($get_barang)) {
                while (true) {

                    "Angka: $angka\n";
                    foreach ($get_barang as $get_barang) {

                        $nm         = $get_barang['nama'];
                        $ex_nm      = explode(' ', $nm);
                        $artikel    = $ex_nm[0] . ' ' . $ex_nm[1] . (in_array($ex_nm[1], ['KIDS', "UNIFORM"]) ? ' ' . ($ex_nm[2] ?? '') : "");
                        $response[] = [
                            "seq_sarimbit"  => $responseData[0]['seq'],
                            "nama_sarimbit" => $responseData[0]['nama'],
                            "gambar"        => $responseData[0]['gambar'],
                            "gambar_sedang" => $responseData[0]['gambar_sedang'],
                            "gambar_besar"  => $responseData[0]['gambar_besar'],
                            "nama_produk"   => $get_barang['nama'],
                            "WARNA"         => $get_barang['warna'],
                            "UKURAN"        => $get_barang['ukuran'],
                            "barcode"       => $get_barang['barcode'],
                            "artikel"       => $artikel,
                            "stok"          => $get_barang['stok'],
                            "brand"         => $get_barang['brand'],
                            "sub_brand"     => $get_barang['sub_brand'],
                            "katalog"       => $get_barang['katalog'],
                            "tahun"         => $get_barang['tahun'],
                            "tipe_brg"      => $get_barang['tipe_brg'],
                            "berat"         => 0.5,
                            "list_warna"    => [
                                [

                                    "warna"       => $get_barang['warna'],
                                    "list_ukuran" => [
                                        [
                                            "ukuran"        => $get_barang['ukuran'],
                                            "stok"          => $get_barang['stok'],
                                            "seq"           => $get_barang['seq'],
                                            "barcode"       => $get_barang['barcode'],
                                            "nama"          => $get_barang['nama'],
                                            "brand"         => $get_barang['brand'],
                                            "sub_brand"     => $get_barang['sub_brand'],
                                            "warna"         => $get_barang['warna'],
                                            "katalog"       => $get_barang['warna'],
                                            "tahun"         => $get_barang['tahun'],
                                            "tipe_brg"      => $get_barang['tipe_brg'],
                                            "harga"         => $get_barang['harga'],
                                            "gambar"        => $get_barang['gambar'],
                                            "gambar_besar"  => $get_barang['gambar_besar'],
                                            "gambar_sedang" => $get_barang['gambar_besar'],
                                            "keterangan"    => $get_barang['keterangan'],
                                            "is_preorder"   => $get_barang['is_preorder'],
                                            "tgl_release"   => $get_barang['tgl_release'],
                                            "klasifikasi"   => $get_barang['klasifikasi'],
                                            "berat"         => 0.5,
                                        ],

                                    ],
                                ],
                            ],
                        ];
                    }
                    $angka += 30;
                    if ($angka > $get_barang['jumlah_data']) {
                        "Angka lebih dari " . $get_barang['jumlah_data'] . ", berhenti.\n";
                        break;
                    }
                    $offset += 30;
                }
            }
        }

        $response = json_encode($response);
        // $sarimbit[$value['nama_sarimbit']]['data']['seq'] = $value['seq_sarimbit'];
        // $sarimbit[$value['nama_sarimbit']]['data']['gambar'] = $value['gambar'];
        // $sarimbit[$value['nama_sarimbit']]['data']['gambar_sedang'] = $value['gambar_sedang'];
        // $sarimbit[$value['nama_sarimbit']]['data']['gambar_besar'] = $value['gambar_besar'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['barcode'] = $value['barcode'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['nama_produk'] = $value['nama_produk'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['warna'] = $value['WARNA'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['ukuran'] = $value['UKURAN'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['artikel'] = $value['artikel'];
        // $sarimbit[$value['nama_sarimbit']]['barang'][$no]['stok'] = $value['stok'];
        // "data": [
        //     {
        //         "artikel": "NARA 02",
        //         "stok": "6",
        //         "brand": "SEPLY",
        //         "sub_brand": "NARA",
        //         "katalog": "01",
        //         "tahun": "2025-01-01",
        //         "tipe_brg": "A",
        //         "jumlah_data": "1",
        //         "list_warna": [
        //             {
        //                 "warna": "ASH DAWN",
        //                 "list_ukuran": [
        //                     {
        //                         "ukuran": "S",
        //                         "stok": "6",
        //                         "seq": "81073",
        //                         "barcode": "301250700011873002",
        //                         "nama": "NARA 02 ASH DAWN S",
        //                         "brand": "SEPLY",
        //                         "sub_brand": "NARA",
        //                         "warna": "ASH DAWN",
        //                         "katalog": "01",
        //                         "tahun": "2025-01-01",
        //                         "tipe_brg": "A",
        //                         "harga": "249900",
        //                         "gambar": "https://api.ethica.id//uploads/SEPLY/NARA/TUMBNAIL/NARA 02 ASH DAWN.jpg",
        //                         "gambar_besar": "https://api.ethica.id//uploads/SEPLY/NARA/BESAR/NARA 02 ASH DAWN.jpg",
        //                         "gambar_sedang": "https://api.ethica.id//uploads/SEPLY/NARA/SEDANG/NARA 02 ASH DAWN.jpg",
        //                         "keterangan": "- Bukaan depan menggunakan zipper\n- Variasi potongan lengkung pada bagian dada dengan detail frill\n- Variasi potongan pada sisi pinggang dengan detail kancing\n- Variasi list vertikal sampai dengan potongan bawah\n- Variasi kerut pada bagian bawah dengan detail frill dan list\n- Lengan menggunakan manset dengan variasi list hidup\n- Saku sembunyi di sisi kanan",
        //                         "is_preorder": "F",
        //                         "tgl_release": "2024-11-14",
        //                         "klasifikasi": "Diamond",
        //                         "berat": "0.5"
        //                     }
        //                 ],
        //                 "stok": "6"
        //             }
        //         ]
        //     }

        if (! isset($responseData['status'])) {
            $responseData['status'] = 404;
        }
        if ($responseData['status'] == 200) {

            return $response;
        } else {
            return $response;
        }
    }
    public static function get_barang_update($link, $array = [])
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.ethica.id/master_barang/loaddata?' . implode('&', $array),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            // CURLOPT_HTTPHEADER => $array
            // array(
            //     'key: 927242bfc145739aedbcca0fe69ccf3',
            //     'offset: 0',
            //     'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'
            // ),
        ]);

        return $response_awal = curl_exec($curl);
    }
    public static function get_sarimbit($link, $array = [], $page = [], $user_api = [], $attemp = 1)
    {

        $link = str_replace('%20', ' ', $link);
        $curl = curl_init();
        $link;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            // CURLOPT_HTTPHEADER => $array
            // array(
            //     'key: 927242bfc145739aedbcca0fe69ccf3',
            //     'offset: 0',
            //     'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'
            // ),
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
        $response;

        if (count($responseData) >= 1) {

            return $response;
        } else if ($responseData['message'] == 'Unauthorized ') {
            $user = EthicaApi::detail_user($page, $user_api, 1);
            return EthicaApi::get_sarimbit($link, $array = [], $page = [], $user_api = [], $attemp + 1);
        } else {
            if ($attemp >= 3) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::get_sarimbit($link, $array = [], $page = [], $user_api = [], $attemp + 1);
            }
        }
    }
    public static function ekspedisi()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'http://103.139.175.102/ethica_api/public/ekspedisi/load',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'key: 927242bfc145739aedbcca0fe69ccf3',
                'offset: 0',
                'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);

        return $responseData;
    }
    public static function get_master()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://api.ethica.id/v2/master_barang/load_data_master',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=aa2l21c349grc6tufk2sa1j4bq',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if ($responseData['status'] == 200) {

            return $response;
        } else {
            return EthicaApi::get_master();
        }
    }
    public static function get_key($link, $user, $costumer_id, $force_api = 0)
    {

        $curl = curl_init();
        if (isset($_SESSION['ethicaApiV1'][date('Y-m-d')][$user]) and ! $force_api) {
            return $_SESSION['ethicaApiV1'][date('Y-m-d')][$user];
        } else {

            curl_setopt_array($curl, [
                CURLOPT_URL            => $link . '/master_customer/get_key_external',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => ['customer_seq' => $costumer_id, 'user' => $user],
                CURLOPT_HTTPHEADER     => [
                    'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                ],
            ]);

            $response     = curl_exec($curl);
            $responseData = json_decode($response, true);

            if ($responseData['status'] == 'success') {
                unset($_SESSION['ethicaApiV1']);

                $_SESSION['ethicaApiV1'][date('Y-m-d')][$user] = $responseData['api_key'];
                return $responseData['api_key'];
            } else {
                echo $response;
            }
        }
    }
    public static function produk($page, $user_api, $link, $nama_barang, $attemp = 0)
    {
        $user         = EthicaApi::detail_user($page, $user_api);
        $apikey       = $user["apikey"];
        $customer_seq = $user["cust_seq"];
        $array        = [];
        $array_header = [];
        $link_temp    = $link;
        if ($user_api['row'][0]->versi == 'Versi 1') {
            $nama_barang = str_replace(' ', '%20', $nama_barang);
            $array       = ['Offset: 0', 'key: ' . $apikey, 'search: ' . $nama_barang, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];

            $link .= "?key=" . $user['apikey'] . '&offset=0&search=' . $nama_barang . '&customer_seq=' . $customer_seq . '';
        } else if ($user_api['row'][0]->versi == 'Versi 2') {
            $array_header = ['Offset: 0', 'key: ' . $apikey, 'search: ' . $nama_barang, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];

            $link .= "?key=" . $user['apikey'];
        }

        $curl = curl_init();
        // 'customer-id: e60db986-db5b-11ee-b044-1a1720bec973',
        //                 'user: ethica_jakut',
        //    echo $link;
        // print_R($array_header);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => $array_header,
        ]);

        $response = curl_exec($curl);

        // echo $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        // print_R($responseData);
        if ($user_api['row'][0]->versi == 'Versi 1') {
            $status               = 200;
            $sukses               = true;
            $sukses               = true;
            $responseData['data'] = $responseData;
        } else if ($user_api['row'][0]->versi == 'Versi 2') {
            $status = $responseData['status'];
            $sukses = $responseData['success'];
        }

        if ($sukses) {
            // echo 'masuk';
            //  EthicaApi::get_cart($page,$user_api,$user["cust_seq"], $_SESSION['id_apps_user']);
            return ["status" => 1, "response" => $responseData];
        } else if ($status == 401) {
            $user = EthicaApi::detail_user($page, $user_api, 1);
            return EthicaApi::produk($page, $user_api, $link_temp, $nama_barang, $attemp + 1);
        } else {
            if ($attemp >= 5) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::produk($page, $user_api, $link_temp, $nama_barang, $attemp + 1);
            }
        }
    }
    public static function produk_pre_order($page, $user_api, $link, $nama_barang, $attemp = 0)
    {
        $user         = EthicaApi::detail_user($page, $user_api);
        $apikey       = $user["apikey"];
        $customer_seq = $user["cust_seq"];
        $array        = [];
        $array_header = [];
        $link_temp    = $link;
        $nama_barang;
        if ($user_api['row'][0]->versi == 'Versi 1') {
            $nama_barang = str_replace(' ', '%20', $nama_barang);
            $array       = ['Offset: 0', 'key: ' . $apikey, 'is_pre_order: F', 'search: ' . $nama_barang, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];

            $link .= "?key=" . $user['apikey'] . '&offset=0&is_pre_order=F&search=' . $nama_barang . '&customer_seq=' . $customer_seq . '';
        } else if ($user_api['row'][0]->versi == 'Versi 2') {
            $array_header = ['Offset: 0', 'key: ' . $apikey, 'is_pre_order: F', 'search: ' . $nama_barang, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];

            $link .= "?key=" . $user['apikey'];
        }

        $curl = curl_init();
        // 'customer-id: e60db986-db5b-11ee-b044-1a1720bec973',
        //                 'user: ethica_jakut',
        //    echo $link;
        // print_R($array_header);
        $curl = curl_init();
        $link;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => $array_header,
        ]);

        $response = curl_exec($curl);

        // echo $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        // print_R($responseData);
        if ($user_api['row'][0]->versi == 'Versi 1') {
            $status               = 200;
            $sukses               = true;
            $sukses               = true;
            $responseData['data'] = $responseData;
        } else if ($user_api['row'][0]->versi == 'Versi 2') {
            $status = $responseData['status'];
            $sukses = $responseData['success'];
        }

        if ($sukses) {
            // echo 'masuk';
            //  EthicaApi::get_cart($page,$user_api,$user["cust_seq"], $_SESSION['id_apps_user']);
            return ["status" => 1, "response" => $responseData];
        } else if ($status == 401) {
            $user = EthicaApi::detail_user($page, $user_api, 1);
            return EthicaApi::produk_pre_order($page, $user_api, $link_temp, $nama_barang, $attemp + 1);
        } else {
            if ($attemp >= 5) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::produk_pre_order($page, $user_api, $link_temp, $nama_barang, $attemp + 1);
            }
        }
    }
    public static function send_cart($page, $user_api, $link, $id_from_api, $qty, $id_user = '', $attemp = 0)
    {
        if (! $id_user) {
            $id_user = $_SESSION['id_apps_user'];
            'masuk id user';
        }
        $id_user;
        $user         = EthicaApi::detail_user($page, $user_api, 0, $id_user);
        $array_header = [];
        $array        = [];
        $link_temp    = $link;
        // echo $_SESSION['id_apps_user'];
        // echo '<Br>';
        // echo  $user["apikey"];
        $user_api['row'][0]->versi;
        if ($user_api['row'][0]->versi == 'Versi 1') {
            $array = [
                "customer_seq" => $user["cust_seq"],
                "barang_seq"   => $id_from_api,
                "qty"          => $qty,
                "user_id"      => $id_user, //1669,
                "is_preorder"  => "F",
                "tipe_apps"    => "W",
            ];
            $link .= "?key=" . $user['apikey'];
        } else if ($user_api['row'][0]->versi == 'Versi 2') {

            $array = [
                "customer_seq" => $user["cust_seq"],
                "barang_seq"   => $id_from_api,
                "qty"          => $qty,
                "user_id"      => $id_user,
                "is_preorder"  => "F",
                "tipe_apps"    => "W",

                "key"          => $user["apikey"],
                // "barang_seq:" . $id_from_api,
                // "qty:" . $qty,
                // "user_id:" . $_SESSION['id_apps_user'],
                // "is_preorder:F",
                // "tipe_apps:W",
            ];
            $array_header = [

                // "barang_seq" => $id_from_api,
                // "qty" => $qty,
                // "user_id" => $_SESSION['id_apps_user'],
                // "is_preorder"=>"F",
                // "tipe_apps"=>"W",

                "key:" . $user["apikey"],
                "barang-seq:" . $id_from_api,
                "qty:" . $qty,
                "user_id:" . $id_user,
                "is_preorder:F",
                "tipe_apps:W",
            ];
            $link .= "?key=" . $user['apikey'];
        }
        // print_R($array_header);
        // print_R($array);
        $curl = curl_init();
        // 'customer-id: e60db986-db5b-11ee-b044-1a1720bec973',
        //                 'user: ethica_jakut',
        // echo $link;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $array,
            CURLOPT_HTTPHEADER     => $array_header,

        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $responseData = json_decode($response, true);
        // print_R($responseData);
        if ($responseData['status'] == 200 and $responseData['success'] and $user_api['row'][0]->versi == 'Versi 2') {
            //  EthicaApi::get_cart($page,$user_api,$user["cust_seq"], $_SESSION['id_apps_user']);
            return ["status" => 1, "response" => $responseData, "id_cart" => $responseData['data'][0]['seq']];
        } else if (($responseData['status'] == "success save" or $responseData['status'] == "success Update") and $user_api['row'][0]->versi == 'Versi 1') {
            return ["status" => 1, "response" => $responseData, "id_cart" => $responseData['seq']];
        } else if ($user_api['row'][0]->versi == 'Versi 1' and ($responseData['status'] == 401 or trim($responseData['status']) == 'Unauthorized')) {

            EthicaApi::detail_user($page, $user_api, 1);
            if ($attemp >= 2) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::send_cart($page, $user_api, $link_temp, $id_from_api, $qty, $id_user, $attemp + 1);
            }
        } else if ($responseData['status'] == 'Unauthorized' or trim($responseData['message'] ?? '') == 'Unauthorized') {
            $costumer_id = $user['costumer_id'];
            self::get_key_v2($user["cust_seq"], $costumer_id, 1);
            if ($attemp >= 2) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::send_cart($page, $user_api, $link_temp, $id_from_api, $qty, $id_user, $attemp + 1);
            }
        } else {
            if ($attemp >= 2) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::send_cart($page, $user_api, $link_temp, $id_from_api, $qty, $id_user, $attemp + 1);
            }
        }
    }
    public static function get_cart($page, $link, $user_api, $user_id)
    {
        $user     = EthicaApi::detail_user($page, $user_api);
        $cust_seq = $user["cust_seq"];
        $curl     = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $link . "keranjang_eksternal/load?user_id=$user_id&customer_seq=$cust_seq",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:" . $user['apikey'],
                "user_id:$user_id",
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);

        return $responseData;
    }
    // public static function get_order($cust_seq, $search = "", $link = '')
    // {
    //     //         . Mengambil 1 Data Pesanan Bersama Detailnya
    //     // ✧ Method : GET
    //     // ✧ URL : https://api.trial.ethica.id/v2/pesanan_master/get
    //     // ✧ Parameter Wajib : (Harusnya simpan diheaders)
    //     // Parameter Keterangan
    //     // seq Id pesanan yang ingin diambil datanya
    //     // is-pesanan Diisi dengan 'T' atau 'F'
    //     $array = array(
    //         "seq:" . $cust_seq,
    //         "key:" . $_SESSION['apikey'],
    //         "is-pesanan:F"
    //     );
    // }
    public static function get_order_detail($page, $link, $user_api, $id_seq)
    {
        $user     = EthicaApi::detail_user($page, $user_api);
        $cust_seq = $user["cust_seq"];
        $curl     = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $link . "?key=" . $user['apikey'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:" . $user['apikey'],
                "cust_seq:" . $cust_seq,
                "seq_pesanan:" . $id_seq,
                "seq:" . $id_seq,
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);

        return $responseData;
    }
    public static function get_order($page, $link, $user_api)
    {
        $user     = EthicaApi::detail_user($page, $user_api, 0, 20240226230013939733);
        $cust_seq = $user["cust_seq"];
        $curl     = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $link . "?key=" . $user['apikey'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:" . $user['apikey'],
                "cust_seq:" . $cust_seq,
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);

        return $responseData;
    }
    public static function hapus_cart($page, $user_api, $link_endpoint, $user_id, $seq, $attemp = 0)
    {

        $curl    = curl_init();
        $user    = EthicaApi::detail_user($page, $user_api, 1, $user_id);
        $key_api = $user['apikey'];
        //echo $link_endpoint . $seq . '?key=' . $key_api . '&tipe_apps=W';

        curl_setopt_array($curl, [
            CURLOPT_URL            => $link_endpoint . $seq . '?key=' . $key_api . '&tipe_apps=W',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:$key_api",
                "seq:$seq",
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $responseData = json_decode($response, true);
        $responseData = json_decode($response, true);

        if ($responseData['status'] == 'sudah terhapus') {
            return ["status" => 1, "response" => $responseData];
        } else {
            if ($attemp >= 5) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::hapus_cart($page, $user_api, $link_endpoint, $user_id, $seq, $attemp + 1);
            }
        }
    }
    public static function cancel_order($page, $user_api, $link_endpoint, $user_id, $seq, $attemp = 0)
    {

        $curl    = curl_init();
        $user    = EthicaApi::detail_user($page, $user_api, 1, $user_id);
        $key_api = $user['apikey'];
        //echo $link_endpoint . $seq . '?key=' . $key_api . '&tipe_apps=W';
        if ($user_api['row'][0]->versi == 'Versi 2') {

            $link_full = $link_endpoint . $seq . '?key=' . $key_api . '&tipe_apps=W';
        } else {
            if (substr($link_endpoint, -1) == '/') {
                $link_full = substr($link_endpoint, 0, -1) . '?key=' . $key_api . '&tipe_apps=W';
            } else {
                $link_full = $link_endpoint . '?key=' . $key_api . '&tipe_apps=W';
            }

        }
        // echo $link_full;
        //  die;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link_full,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',

            CURLOPT_POSTFIELDS     => [
                'Cookie' => 'PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key"    => "$key_api",
                "seq"    => "$seq",
            ],
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:$key_api",
                "seq:$seq",
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $responseData = json_decode($response, true);
        $responseData = json_decode($response, true);

        if ($responseData['status'] == 'success') {
            return ["status" => 1, "response" => $responseData];
        } elseif ($responseData['status'] == 'Unauthorized') {

            EthicaApi::detail_user($page, $user_api, 1);
            if ($attemp >= 2) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::cancel_order($page, $user_api, $link_endpoint, $user_id, $seq, $attemp + 1);
            }
        } else {
            if ($attemp >= 5) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::cancel_order($page, $user_api, $link_endpoint, $user_id, $seq, $attemp + 1);
            }
        }
    }
    public static function acc_sync_order($page, $user_api, $link_endpoint, $user_id, $seq, $attemp = 0)
    {

        $curl    = curl_init();
        $user    = EthicaApi::detail_user($page, $user_api, 1, $user_id);
        $key_api = $user['apikey'];
        //echo $link_endpoint . $seq . '?key=' . $key_api . '&tipe_apps=W';
        if ($user_api['row'][0]->versi == 'Versi 2') {

            $link_full    = $link_endpoint;
            $array_header = [
                "key:$key_api",
                "seq:$seq",
                "tipe_apps:W",
                "user-admin-eksternal:" . $_SESSION['id_apps_user'],

            ];
        } else {
            if (substr($link_endpoint, -1) == '/') {
                $link_full = substr($link_endpoint, 0, -1) . '?key=' . $key_api . '&tipe_apps=W';
            } else {
                $link_full = $link_endpoint . '?key=' . $key_api . '&tipe_apps=W';
            }

        }
        $link_full;
        // echo $seq;
        //  die;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $link_full,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',

            CURLOPT_POSTFIELDS     => [
                'Cookie'               => 'PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key"                  => "$key_api",
                "seq"                  => "$seq",
                "tipe_apps"            => "W",
                "user_admin_eksternal" => $_SESSION['id_apps_user'],
            ],
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
                "key:$key_api",
                "seq:$seq",
                "tipe_apps:W",
            ],
        ]);
        $response = curl_exec($curl);

        curl_close($curl);
        // echo $responseData = json_decode($response, true);
        $responseData = json_decode($response, true);
        if ($user_api['row'][0]->versi == 'Versi 2' and (($response['success'] ?? '') or $responseData['message'] == 'pesanan telah diapprove')) {
            return ["status" => 1, "response" => $responseData];
        } else
        if ($responseData['status'] == 'success') {
            return ["status" => 1, "response" => $responseData];
        } else {
            if ($attemp >= 2) {
                return ["status" => 0, "response" => $responseData];
            } else {
                sleep(2);
                return EthicaApi::acc_sync_order($page, $user_api, $link_endpoint, $user_id, $seq, $attemp + 1);
            }
        }
    }
    public static function send_order($page, $user_api, $link_endpoint = '', $id_order = "", $attemp = 0)
    {

        //         $db['select'][] = "
        //         *,webmaster__wilayah__provinsi.provinsi as provinsi,concat(webmaster__wilayah__kabupaten.type,' ',webmaster__wilayah__kabupaten.kota_name) as kota,
        // webmaster__wilayah__postal_code.urban as kelurahan,webmaster__wilayah__kecamatan.subdistrict_name as kecamatan ,erp__pos__utama.id as primary_key
        // 		";
        //         $db['utama'] = "erp__pos__utama";
        //         $db['np'] = "erp__pos__utama";
        //         $db['join'][] = ["store__toko", "store__toko.id", "erp__pos__utama.id_toko"];
        //         $db['join'][] = ["apps_user", "erp__pos__utama.id_apps_user", "apps_user.id_apps_user"];
        //         $db['join'][] = ["erp__pos__delivery_order", "erp__pos__delivery_order.id_erp__pos__utama", "erp__pos__utama.id", "left"];
        //         $db['join'][] = ["webmaster__wilayah__provinsi", "id_provinsi_tujuan", "webmaster__wilayah__provinsi.provinsi_id", "left"];
        //         $db['join'][] = ["webmaster__wilayah__kabupaten", "id_kota_tujuan", "webmaster__wilayah__kabupaten.kota_id", "left"];
        //         $db['join'][] = ["webmaster__wilayah__kecamatan", "id_kecamatan_tujuan", "webmaster__wilayah__kecamatan.subdistrict_id", "left"];
        //         $db['join'][] = ["webmaster__wilayah__postal_code", "id_kelurahan_tujuan", "webmaster__wilayah__postal_code.id", "left"];
        $db['select'][] = "
        erp__pos__utama.no_purchose_order,status_acc_sync_pesanan,status_sync_pesanan,response_acc_sync_pesanan,response_sync_pesanan,
        erp__pos__utama.id_apps_user,nomor_handphone
        ,webmaster__wilayah__provinsi.provinsi as provinsi,concat(webmaster__wilayah__kabupaten.type,' ',webmaster__wilayah__kabupaten.kota_name) as kota,
        webmaster__wilayah__postal_code.urban as kelurahan,webmaster__wilayah__kecamatan.subdistrict_name as kecamatan ,webmaster__wilayah__postal_code.postal_code,
        webmaster__wilayah__provinsi.provinsi as provinsi_asal,concat(webmaster__wilayah__kabupaten.type,' ',webmaster__wilayah__kabupaten.kota_name) as kota_asal,
        webmaster__wilayah__postal_code.urban as kelurahan_asal,webmaster__wilayah__kecamatan.subdistrict_name as kecamatan_asal ,keluarahan_asal.postal_code as postal_code_asal,

        erp__pos__utama.id as primary_key
        ,erp__pos__utama.create_date,erp__pos__delivery_order.*,nama_lengkap,store__toko.nama_toko";
        $db['utama']  = "erp__pos__utama";
        $db['np']     = "erp__pos__utama";
        $db['join'][] = ["store__toko", "store__toko.id", "erp__pos__utama.id_toko"];
        $db['join'][] = ["apps_user", "erp__pos__utama.id_apps_user", "apps_user.id_apps_user"];
        $db['join'][] = ["erp__pos__delivery_order", "erp__pos__delivery_order.id_erp__pos__utama", "erp__pos__utama.id", "left"];
        $db['join'][] = ["webmaster__wilayah__provinsi", "id_provinsi_tujuan", "webmaster__wilayah__provinsi.provinsi_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kabupaten", "id_kota_tujuan", "webmaster__wilayah__kabupaten.kota_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kecamatan", "id_kecamatan_tujuan", "webmaster__wilayah__kecamatan.subdistrict_id", "left"];
        $db['join'][] = ["webmaster__wilayah__postal_code", "id_kelurahan_tujuan", "webmaster__wilayah__postal_code.id", "left"];

        $db['join'][]  = ["webmaster__wilayah__provinsi provinsi_asal", "id_provinsi_asal", "provinsi_asal.provinsi_id", "left"];
        $db['join'][]  = ["webmaster__wilayah__kabupaten kota_asal", "id_kota_asal", "kota_asal.kota_id", "left"];
        $db['join'][]  = ["webmaster__wilayah__kecamatan kecamatan_asal", "id_kecamatan_asal", "kecamatan_asal.subdistrict_id", "left"];
        $db['join'][]  = ["webmaster__wilayah__postal_code keluarahan_asal", "id_kelurahan_asal", "keluarahan_asal.id", "left"];
        $db['where'][] = ["1=1 WORKSPACE_SINGLE_TOKO_POS_WHERE|", "", ""];
        $db['where'][] = ["erp__pos__utama.id", "=", "$id_order"];
        $get           = Database::database_coverter($page, $db, [], 'all');

        if ($get['num_rows'] > 0) {
            foreach ($get['row'] as $row) {

                if ($row->paket_ongkir) {

                    $paket = explode('-', $row->paket_ongkir);
                } else {
                    $paket = [
                        "",
                        "",
                    ];
                }
                if ($paket[0] == 'LAIN') {
                    $paket[0] = 'LAIN - LAIN';
                }
                if ($paket[1] == 'LAIN') {
                    $paket[1] = 'LAIN - LAIN';
                }
                $db             = [];
                $db['select'][] = "
        erp__pos__utama.no_purchose_order,

        erp__pos__utama__detail.id as id_detail
		, erp__pos__utama__detail.status_sync_cart
		, inventaris__asset__list.nama_barang
		, inventaris__asset__list.id as id_asset
		, inventaris__asset__list__varian.id as id_varian
		, inventaris__asset__list.varian_barang
		, inventaris__asset__list.asal_barang_dari
		, inventaris__asset__list.id_api
		, inventaris__asset__list.id_sync
		, inventaris__asset__list.id_from_api
		, inventaris__asset__list__varian.asal_from_data_varian
		, inventaris__asset__list__varian.id_api_varian
		, inventaris__asset__list__varian.id_sync_varian
		, inventaris__asset__list__varian.id_from_api_varian
		, inventaris__asset__list__varian.nama_varian
        ,ressponse_sync_cart
        ,qty_pesanan
        ,id_sync_cart,
        erp__pos__utama.id_apps_user
		";

                $db['utama']   = "erp__pos__utama__detail";
                $db['np']      = "erp__pos__utama__detail";
                $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
                $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian", 'left'];
                $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
                $db['where'][] = ["erp__pos__utama__detail.id_erp__pos__utama", "=", "$row->primary_key_erp__pos__utama"];
                $db['where'][] = ["erp__pos__utama__detail.active", "=", "1"];

                '<pre>';
                // print_r($row);die;
                // print_r($db);die; 
                $get2   = Database::database_coverter($page, $db, [], 'all');
                $barang = [];
                foreach ($get2['row'] as $row2) {

                    if (($row2->varian_barang == 1 and $row2->asal_from_data_varian == 'Api') or ($row2->asal_barang_dari == 'Api')) {

                        $barang[] = ["keranjang_seq" => $row2->id_sync_cart];
                    }
                }

                $data['id_apps_user'] = $row->id_apps_user;
                $data['nama']         = $row->nama_lengkap;
                $data['no_hp']        = $row->nomor_handphone;
                $data['alamat']       = "Jalan Kemakmuran Raya no 3";
                $row->alamat_tujuan;
                $data['id_provinsi'] = 9;
                $row->id_provinsi_tujuan;
                $data['id_kota'] = 23;
                $row->id_kota_tujuan;
                $data['id_kecamatan'] = 362;
                $row->id_kecamatan_tujuan;
                $data['provinsi'] = "Jawa Barat";
                $row->provinsi;
                $data['kota'] = "Kota Bandung";
                $row->kota;
                $data['kecamatan'] = "Rancasari";
                $row->kecamatan;
                $data['kelurahan'] = "DARWATI";
                $row->kelurahan;
                $data['ongkos_kirim']            = $row->ongkir;
                $data['ekspedisi_seq']           = ApiContent::search_data_api($page, 1, $paket[0], 'webmaster__ekspedisi', 'kode_ekspedisi', 'id', 'ethica_sync_data_ekspedisi');
                $data['ekspedisi']               = $paket[0];
                $data['service']                 = $paket[1];
                $data['kode_booking']            = $row->kode_booking;
                $data['no_resi']                 = $row->nomor_resi;
                $data['no_hp_pengirim']          = $row->no_telepon_pengirim ?? $row->nomor_pengirim;
                $data['nama_pengirim']           = $row->nama_pengirim ?? $row->nama_toko;
                $data['alamat_pengirim']         = $row->alamat_asal;
                $data['alamat_pengirim_lengkap'] = $row->alamat_asal . ($row->no_bangunan_asal ? "No. " . $row->no_bangunan_asal : "");
                $data['alamat_pengirim']         = $data['nama_pengirim'] . ", Alamat: " . $row->alamat_asal . ($row->no_bangunan_asal ? "No. " . $row->no_bangunan_asal : "") . ' Kel:' . $row->kelurahan_asal . ' Kec:' . $row->kecamatan_asal . ', ' . $row->provinsi_asal . ' ' . $row->kota_asal . ', ' . $row->postal_code_asal . ($row->patokan_asal ? "(Patokan: " . $row->patokan_asal . ")" : "") . " No Hp:" . $data['no_hp_pengirim'];
                $data['alamat_kirim']            = "Kepada Yth:" . $data['nama'] .
                "Alamat : " . $data['alamat'] . ($row->no_bangunan_tujuan ? "No. " . $row->no_bangunan_tujuan : "") . ' Kel:' . $data['kelurahan'] . ' Kec:' . $data['kecamatan'] . ', ' . $data['provinsi'] . ' ' . $data['kota'] . ', ' . $row->postal_code . ($row->patokan_tujuan ? "(Patokan: " . $row->patokan_tujuan . ")" : "") . " No. HP :" . $data['no_hp'];

                if ($data['service'] == 'CTC') {
                    $data['service'] = "REG";
                }
                $curl = curl_init();
                $row->id_apps_user;
                '<br>';
                $_SESSION['id_apps_user'];
                $user = EthicaApi::detail_user($page, $user_api, 0, $row->id_apps_user);
                // echo 'HAIII2';
                $data['apikey'] = $key_api = $user['apikey'];
                $cust_seq       = $user['cust_seq'];
                $array_header   = [
                    "customer_seq:" . $cust_seq,
                    "user_id:" . $data['id_apps_user'],
                    "nama-kirim:" . $data['nama'],
                    "no-telepon-kirim:" . $data['no_hp'],
                    "alamat-kirim-lengkap:" . $data['alamat'],
                    "alamat-kirim:" . $data['alamat_kirim'],
                    "id-provinsi:" . $data['id_provinsi'],
                    "id-kota:" . $data['id_kota'],
                    "id-kecamatan:" . $data['id_kecamatan'],
                    "Provinsi:" . $data['provinsi'],
                    "Kota:" . $data['kota'],

                    "kecamatan:" . $data['kecamatan'],
                    "kelurahan:" . $data['kelurahan'],
                    "alamat-pengirim-lengkap:" . $data['alamat_pengirim_lengkap'],
                    "no-telepon-pengirim:" . $data['no_hp_pengirim'],
                    "nama-pengirim:" . $data['nama_pengirim'],
                    "alamat-pengirim:" . $data['alamat_pengirim'],
                    "is-selesai-chat:F",
                    "ongkos-kirim:" . $data['ongkos_kirim'],
                    "ekspedisi-seq:" . $data['ekspedisi_seq'],
                    "ekspedisi:" . $data['ekspedisi'],
                    "service:" . $data['service'],
                    "no-resi: 123456",
                    "tipe-apps:W",
                    "no-eksternal:" . $row->no_purchose_order,
                    "kode-booking:123456",
                    "detail:" . json_encode($barang),
                    "key:" . $data['apikey'],

                ];
                $array = [
                    "customer_seq"            => $cust_seq,
                    "user_id"                 => $data['id_apps_user'],
                    "nama_kirim"              => $data['nama'],
                    "no_telepon_kirim"        => $data['no_hp'],
                    "alamat_kirim_lengkap"    => $data['alamat'],

                    "alamat_kirim"            => $data['alamat_kirim'],
                    "id_provinsi"             => $data['id_provinsi'],
                    "id_kota"                 => $data['id_kota'],
                    "id_kecamatan"            => $data['id_kecamatan'],
                    "provinsi"                => $data['provinsi'],
                    "kota"                    => $data['kota'],

                    "kecamatan"               => $data['kecamatan'],
                    "kelurahan"               => $data['kelurahan'],
                    "alamat_pengirim_lengkap" => $data['alamat_pengirim_lengkap'],
                    "no_telepon_pengirim"     => $data['no_hp_pengirim'],
                    "nama_pengirim"           => $data['nama_pengirim'],
                    "alamat_pengirim"         => $data['alamat_pengirim'],
                    "is_selesai_chat"         => "F",
                    "ongkos_kirim"            => $data['ongkos_kirim'],
                    "ekspedisi_seq"           => $data['ekspedisi_seq'],
                    "ekspedisi"               => $data['ekspedisi'],
                    "service"                 => $data['service'],
                    "no_resi"                 => "123456",
                    "tipe_apps"               => "W",
                    "no_eksternal"            => $row->no_purchose_order,
                    "kode_booking"            => "123456",
                    "detail"                  => json_encode($barang),
                    "key"                     => $data['apikey'],
                ];
                $true = true;
                foreach ($array as $key => $value) {
                    if ($key == 'ongkos_kirim') {
                    } else
                    if (empty($value)) {
                        $true      = true;
                        $message[] = $key . " is empty";
                    }
                    // $array_header[] = $key . ":" . $value;
                }

                // print_r($array_header);
                //  print_r($array);
                if ($true) {
                    $link_endpoint . '?key=' . $key_api . '&tipe_apps=W';
                    $key_api = $user['apikey'];
                    curl_setopt_array($curl, [
                        CURLOPT_URL            => $link_endpoint . '?key=' . $key_api . '&tipe_apps=W',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_MAXREDIRS      => 10,
                        CURLOPT_TIMEOUT        => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST  => 'POST',
                        CURLOPT_POSTFIELDS     => $array,
                        CURLOPT_HTTPHEADER     => $array_header,
                    ]);

                    $response = curl_exec($curl);

                    curl_close($curl);
                    // echo $responseData = json_decode($response, true);
                    $responseData = json_decode($response, true);

                    if ($user_api['row'][0]->versi == 'Versi 1' and ($responseData['status'] == 401 or trim($responseData['status']) == 'Unauthorized')) {

                        EthicaApi::detail_user($page, $user_api, 1);
                        if ($attemp >= 2) {
                            return ["status" => 0, "response" => $responseData];
                        } else {
                            sleep(2);
                            return EthicaApi::send_order($page, $user_api, $link_endpoint, $id_order, $attemp + 1);
                        }
                    } else
                    if ($user_api['row'][0]->versi == 'Versi 2' and ($responseData['status'] == 401 or trim($responseData['message']) == 'Unauthorized')) {

                        EthicaApi::detail_user($page, $user_api, 1);
                        if ($attemp >= 2) {
                            return ["status" => 0, "response" => $responseData];
                        } else {
                            sleep(2);
                            return EthicaApi::send_order($page, $user_api, $link_endpoint, $id_order, $attemp + 1);
                        }
                    } else
                    if ($user_api['row'][0]->versi == 'Versi 1' and $responseData['status'] == 'success') {
                        // echo 'masuk';
                        return ["status" => 1, "response" => $responseData, "seq" => $responseData['seq'], "nomor" => $responseData['nomor']];
                    } else if ($responseData['status'] == 200 and $user_api['row'][0]->versi == 'Versi 2') {
                        return ["status" => 1, "response" => $responseData, "seq" => $responseData['data'][0]['seq'], "nomor" => $responseData['data'][0]['nomor']];
                    } else {
                        if ($attemp >= 2) {
                            return ["status" => 0, "response" => $responseData];
                        } else {
                            sleep(2);

                            return EthicaApi::send_order($page, $user_api, $link_endpoint, $id_order, $attemp + 1);
                        }
                    }
                } else {
                    return ["status" => 0, "response" => implode($message)];
                }
            }
        } else {
            return ["status" => 0, "response" => "Data Id Order Tidak Ditemukan"];
        }
    }

    public static function get_produk($cust_seq, $search = "", $link = '', $param = '')
    {

        $curl     = curl_init();
        $all_link = ($link ? $link : 'http://103.139.175.102/ethica_api/public') . '/master_barang/loaddata_eksternal?customer_seq=' . $cust_seq . ($search ? "&search=$search" : '') . '&is_ada_stok=F&order_by=tgl_release%20DESC%20,%20Nama%20DESC' . $param;
        curl_setopt_array($curl, [
            CURLOPT_URL            => $all_link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if (isset($responseData[0]['artikel'])) {

            return trim($response);
        } else {
            return trim($response);
        }
    }
    public static function get_produk_brand($cust_seq, $brand)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'http://103.139.175.102/ethica_api/public/master_barang/loaddata_eksternal?customer_seq=' . $cust_seq . '&brand=' . $brand . '&is_ada_stok=T&order_by=tgl_release%20DESC%20,%20Nama%20DESC&offset=0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if (isset($responseData[0]['artikel'])) {

            return trim($response);
        } else {
            echo $response;
        }
    }
    public static function create_pesanan($key)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'http://103.139.175.102/ethica_api/public/pesanan_master/save_pesanan_eksternal?key=' . $key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if (isset($responseData[0]['artikel'])) {

            return trim($response);
        } else {
            echo $response;
        }
    }
    public static function get_produk_detail($cust_seq, $artikel)
    {

        $curl    = curl_init();
        $artikel = str_replace(' ', '%20', $artikel);
        $url     = ('http://103.139.175.102/ethica_api/public/master_barang/loaddata_eksternal?customer_seq=' . $cust_seq . '&search=' . $artikel . '&is_ada_stok=T&order_by=tgl_release%20DESC%20,%20Nama%20DESC&offset=0');
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);
        $response = curl_exec($curl);

        curl_close($curl);
        $responseData = json_decode($response, true);
        if (isset($responseData[0]['artikel'])) {

            return trim($response);
        } else {
            // retirm $response;
        }
    }
    public static function save_keranjang($key, $cust_seq, $barang_seq, $qty, $user_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'http://103.139.175.102/ethica_api/public/keranjang_eksternal/save?key=' . $key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => ['customer_seq' => $cust_seq, 'barang_seq' => $barang_seq, 'qty' => $qty, 'user_id' => $user_id, 'is_preorder' => 'F', 'tipe_apps' => 'W'],
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        return $response;
    }
    public static function ubah_keranjang($key, $cust_seq, $barang_seq, $qty_awal, $user_id, $id_keranjang, $qty_order, $tipe)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'http://103.139.175.102/ethica_api/public/keranjang_eksternal/update_qty?key=' . $key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => ['customer_seq' => $cust_seq, 'barang_seq' => $barang_seq, 'qty' => $qty_awal, 'user_id' => $user_id, 'is_preorder' => 'F', 'tipe_apps' => 'W', 'id_keranjang' => $id_keranjang, 'qty_order' => $qty_order, 'tipe' => $tipe, 'seq' => $id_keranjang],
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
    public static function get_produk_by_nama($nama, $cust_seq)
    {

        $nama = str_replace(' ', '%20', $nama);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "http://103.139.175.102/ethica_api/public/master_barang/loaddata_eksternal?customer_seq=$cust_seq&offset=0&search=$nama",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Cookie: PHPSESSID=hl041fbt0er6qdqumm6i5abeuc',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
