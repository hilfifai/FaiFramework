<?php

require_once __DIR__ . '/../Api_class/EthicaApi.php';
class ApiContent
{

    public static function router($page, $id, $function, $search)
    {
        $content = ApiContent::$function($page, $id, $search);
        return $content;
    }

    public static function produk_sync($page, $id_sync, $id_utama)
    {

        'HAII';
        $fai = new MainFaiFramework();
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');
        DB::joinRaw('api_master__list on api_master__list.id = id_api');

        DB::whereRawPage($page, "api_master__sync.id=$id_sync");
        $Get      = DB::get('all');
        $id_api   = $Get['row'][0]->id_api;
        $class    = $Get['row'][0]->nama_class;
        $function = $Get['row'][0]->function_cek_stok;

        $so['tanggal_stok_opname']         = date('Y-m-d');
        $so['nomor_stok_opname']           = "";
        $so['id_gudang_stok_opname']       = $id_gudang       = $Get['row'][0]->id_gudang;
        $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;
        $last_id                           = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
        $data['utama']['jual_barang']      = "1";

        $insert['jenis_barang']     = "Barang Jadi";
        $insert['id_jenis_asset']   = "4";
        $insert['jual_aset_barang'] = "Ya";
        $insert['varian_barang']    = "1";
        $insert['id_panel']         = "WORKSPACE_SINGLE_PANEL|";
        $insert['asal_barang_dari'] = "Master";
        $insert['is_master']        = 0;
        $insert['id_master']        = $id_utama; //id utama sarimbit master atau lainnya
        $insert['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $insert['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $db                         = [];
        foreach ($insert as $tk => $vk) {
            $va            = $insert[$tk]            = Database::string_database($page, $fai, $vk);
            $db['where'][] = ["inventaris__asset__list.$tk", "=", "'$va'"];
        }
        $db['select'][]       = "inventaris__asset__list.id as primary_key";
        $db['utama']          = "inventaris__asset__list";
        $db['non_add_select'] = "inventaris__asset__list";
        $get_all              = Database::database_coverter($page, $db, [], 'all');
        // print_R();

        $total = 0;
        $list  = [];

        if ($get_all['num_rows']) {
            $last_id_utama = $get_all['row'][0]->primary_key;
        } else {
            $total++;
            $list[]        = "inventaris__asset__list->" . $id_utama . "<BR> (" . $get_all['query'] . ")<BR>";
            $last_id_utama = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__list');
        }

        $produk['id_asset']         = $last_id_utama;
        $produk['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $produk['tipe_barang_form'] = "Utama";
        $db                         = [];
        foreach ($produk as $tk => $vk) {
            $va            = $produk[$tk]            = Database::string_database($page, $fai, $vk);
            $db['where'][] = ["store__produk.$tk", "=", "'$va'"];
        }
        $db['utama'] = "store__produk";
        $get_all     = Database::database_coverter($page, $db, [], 'all');
        if ($get_all['num_rows']) {
            $store = $get_all['row'][0]->primary_key;
        } else {
            $produk['status_publish'] = "1";
            $produk['tgl_publish']    = date('Y-m-d');
            $produk['apps_id']        = rand(100000, 999999);
            $store                    = CRUDFunc::crud_insert($fai, $page, $produk, [], 'store__produk');
            $total++;
            $list[] = "store__produk->" . $store . "<BR> (" . $get_all['query'] . ")<BR>";
        }
        DB::selectRaw('*,id_asset_list_varian as primary_key,inventaris__asset__list__varian.id as id_varian_master');
        DB::table('inventaris__asset__list__varian');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = id_asset_list_varian');
        DB::whereRaw('id_inventaris__asset__list=' . $id_utama);
        DB::groupByRaw($page, ['id_inventaris__asset__list,id_asset_list_varian,id_varian_1,id_varian_2,inventaris__asset__list__varian.barcode']);
        $varians = DB::get('all');
        $empty   = [];

        if ($varians['num_rows']) {

            foreach ($varians['row'] as $varian_row) {

                $insert_varian['id_inventaris__asset__list'] = $last_id_utama;
                $insert_varian['asal_from_data_varian']      = 'Master';

                $insert_varian['id_master_varian'] = $varian_row->id_varian_master;
                $db                                = [];
                foreach ($insert_varian as $tk => $vk) {
                    $va            = $insert_varian[$tk]            = Database::string_database($page, $fai, $vk);
                    $db['where'][] = ["inventaris__asset__list__varian.$tk", "=", "'$va'"];
                }
                $db['utama'] = "inventaris__asset__list__varian_db";
                $db['np']    = "inventaris__asset__list__varian_db";
                $get_all     = Database::database_coverter($page, $db, [], 'all');
                if ($get_all['num_rows']) {
                    $last_insert = $get_all['row'][0]->primary_key;
                } else {
                    $insert_varian['is_master_varian'] = 0;
                    $last_insert                       = CRUDFunc::crud_insert($fai, $page, $insert_varian, [], 'inventaris__asset__list__varian');
                    $total++;
                    $list[] = "inventaris__asset__list__varian->" . $last_insert;
                }
                $store_varian['harga_pokok_penjualan_varian'] = $varian_row->harga_pokok_penjualan;
                $store_varian['id_barang_varian']             = $last_insert;
                $store_varian['id_store__produk']             = $store;
                $db                                           = [];
                foreach ($store_varian as $tk => $vk) {
                    $va            = $store_varian[$tk]            = Database::string_database($page, $fai, $vk);
                    $db['where'][] = ["store__produk__varian.$tk", "=", "'$va'"];
                }
                $db['utama'] = "store__produk__varian";
                $get_all     = Database::database_coverter($page, $db, [], 'all');

                if ($get_all['num_rows']) {
                    $last_insert = $get_all['row'][0]->primary_key;
                } else {
                    $last_insert = CRUDFunc::crud_insert($fai, $page, $store_varian, [], 'store__produk__varian');
                    $total++;
                    $list[] = "store__produk__varian->" . $last_insert;
                }

                // $stok_api = ApiContent::$function($page, $id_sync, $id_api, $varian_row);

                // $get_stok = $stok_api['stok'];
                // $empty += $stok_api['empty'];
                // $id_barang = $varian_row->primary_key;
                //     $dbstok['non_checking'] = "view_total_stok_barang_gudang";
                //     $dbstok['utama'] = "view_total_stok_barang_gudang";
                //     $dbstok['where'][] =["id_gudang","=",$id_gudang];
                //     $dbstok['where'][] =["id_ruang_simpan","=",$id_ruang_simpan];
                //     $dbstok['where'][] =["id_asset","=",$id_barang];
                //     $get_system_stok = Database::database_coverter($page,$dbstok,[],'all');
                //    // $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $id_barang, 'rekap_akhir');;
                //     if ($get_system_stok['num_rows']) {
                //         $get_system_stok = $get_system_stok['row'][0]->jumlah_stok;
                //     } else {
                //         $get_system_stok = 0;
                //     }
                //     $detail['id_asset'] = $varian_row->primary_key;
                //     $detail['data_stok'] = $get_system_stok;
                //     $detail['data_real'] = $get_stok;

                //     $detail['selisih'] = $get_stok - $get_system_stok;
                //     $detail['id_erp__pos__stok_opname'] = $last_id;
                //     if ($detail['selisih'])
                //         CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');

            }
        } else {
        }

        return ["total" => $total ?? 0, "list" => $list, "id_produk" => $store];
    }
    public static function produk_sync_pre_order($page, $id_sync, $id_utama)
    {

        'HAII';
        $fai = new MainFaiFramework();
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');
        DB::joinRaw('api_master__list on api_master__list.id = id_api');

        DB::whereRawPage($page, "api_master__sync.id=$id_sync");
        $Get      = DB::get('all');
        $id_api   = $Get['row'][0]->id_api;
        $class    = $Get['row'][0]->nama_class;
        $function = $Get['row'][0]->function_cek_stok;

        $so['tanggal_stok_opname']         = date('Y-m-d');
        $so['nomor_stok_opname']           = "";
        $so['id_gudang_stok_opname']       = $id_gudang       = $Get['row'][0]->id_gudang;
        $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;
        $last_id                           = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
        $data['utama']['jual_barang']      = "1";

        $insert['jenis_barang']     = "Barang Jadi";
        $insert['id_jenis_asset']   = "4";
        $insert['jual_aset_barang'] = "Ya";
        $insert['varian_barang']    = "1";
        $insert['id_panel']         = "WORKSPACE_SINGLE_PANEL|";
        $insert['asal_barang_dari'] = "Master";
        $insert['is_master']        = 0;
        $insert['id_master']        = $id_utama; //id utama sarimbit master atau lainnya
        $insert['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $insert['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $db                         = [];
        foreach ($insert as $tk => $vk) {
            $va            = $insert[$tk]            = Database::string_database($page, $fai, $vk);
            $db['where'][] = ["inventaris__asset__list.$tk", "=", "'$va'"];
        }
        $db['utama'] = "inventaris__asset__list";
        $get_all     = Database::database_coverter($page, $db, [], 'all');
        // print_R();
        $total = 0;
        $list  = [];

        if ($get_all['num_rows']) {
            $last_id_utama = $get_all['row'][0]->primary_key;
        } else {
            $total++;
            $list[]        = "inventaris__asset__list->" . $id_utama . "<BR> (" . $get_all['query'] . ")<BR>";
            $last_id_utama = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__list');
        }

        $produk['id_asset']         = $last_id_utama;
        $produk['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $produk['tipe_barang_form'] = "Utama";
        $db                         = [];
        foreach ($produk as $tk => $vk) {
            $va            = $produk[$tk]            = Database::string_database($page, $fai, $vk);
            $db['where'][] = ["store__produk.$tk", "=", "'$va'"];
        }
        $db['utama'] = "store__produk";
        $get_all     = Database::database_coverter($page, $db, [], 'all');
        if ($get_all['num_rows']) {
            $store = $get_all['row'][0]->primary_key;
        } else {
            $produk['status_publish'] = "1";
            $produk['tgl_publish']    = date('Y-m-d');
            $produk['apps_id']        = rand(100000, 999999);
            $store                    = CRUDFunc::crud_insert($fai, $page, $produk, [], 'store__produk');
            $total++;
            $list[] = "store__produk->" . $store . "<BR> (" . $get_all['query'] . ")<BR>";
        }
        DB::selectRaw('*,id_asset_list_varian as primary_key,inventaris__asset__list__varian.id as id_varian_master');
        DB::table('inventaris__asset__list__varian');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = id_asset_list_varian');
        DB::whereRaw('id_inventaris__asset__list=' . $id_utama);
        $varians = DB::get('all');
        $empty   = [];
        if ($varians['num_rows']) {

            foreach ($varians['row'] as $varian_row) {

                $insert_varian['id_inventaris__asset__list'] = $last_id_utama;
                $insert_varian['asal_from_data_varian']      = 'Master';

                $insert_varian['id_master_varian'] = $varian_row->id_varian_master;
                $db                                = [];
                foreach ($insert_varian as $tk => $vk) {
                    $va            = $insert_varian[$tk]            = Database::string_database($page, $fai, $vk);
                    $db['where'][] = ["inventaris__asset__list__varian.$tk", "=", "'$va'"];
                }
                $db['utama'] = "inventaris__asset__list__varian_db";
                $db['np']    = "inventaris__asset__list__varian_db";
                $get_all     = Database::database_coverter($page, $db, [], 'all');
                if ($get_all['num_rows']) {
                    $last_insert = $get_all['row'][0]->primary_key;
                } else {
                    $insert_varian['is_master_varian'] = 0;
                    $last_insert                       = CRUDFunc::crud_insert($fai, $page, $insert_varian, [], 'inventaris__asset__list__varian');
                    $total++;
                    $list[] = "inventaris__asset__list__varian->" . $last_insert;
                }
                $store_varian['harga_pokok_penjualan_varian'] = $varian_row->harga_pokok_penjualan;
                $store_varian['id_barang_varian']             = $last_insert;
                $store_varian['id_store__produk']             = $store;
                $db                                           = [];
                foreach ($store_varian as $tk => $vk) {
                    $va            = $store_varian[$tk]            = Database::string_database($page, $fai, $vk);
                    $db['where'][] = ["store__produk__varian.$tk", "=", "'$va'"];
                }
                $db['utama'] = "store__produk__varian";
                $get_all     = Database::database_coverter($page, $db, [], 'all');
                if ($get_all['num_rows']) {
                    $last_insert = $get_all['row'][0]->primary_key;
                } else {
                    $last_insert = CRUDFunc::crud_insert($fai, $page, $store_varian, [], 'store__produk__varian');
                    $total++;
                    $list[] = "store__produk__varian->" . $last_insert;
                }
                $stok_api = ApiContent::$function($page, $id_sync, $id_api, $varian_row);
                $get_stok = $stok_api['stok'];
                $empty += $stok_api['empty'];
                $id_barang       = $varian_row->primary_key;
                $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $id_barang, 'rekap_akhir');
                if ($get_system_stok['num_rows']) {
                    $get_system_stok = $get_system_stok['row'][0]->stok;
                } else {
                    $get_system_stok = 0;
                }
                $detail['id_asset']  = $varian_row->primary_key;
                $detail['data_stok'] = $get_system_stok;
                $detail['data_real'] = $get_stok;

                $detail['selisih']                  = $get_stok - $get_system_stok;
                $detail['id_erp__pos__stok_opname'] = $last_id;
                if ($detail['selisih']) {
                    CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                }

            }
        } else {
        }
        return ["total" => $total ?? 0, "list" => $list];
    }

    public static function api_produk_checking($page, $id_produk)
    {}

    public static function send_cart($page, $id_detail_pos, $id_api, $id_from_api, $qty, $id_user = '')
    {
        //id_detail_pos merupakan id detail yang ada di erp_utama_detail
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
        // 
        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "api_master__user.active=1");
        DB::whereRawPage($page, "api_master__list__versi.active=1");
        $user_api = DB::get('all');

        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        DB::table("api_master__link");
        DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "id_kategori_api=2");
        $user_api_endpoint = DB::get('all');

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;
        // echo $link . '/' . $link_endpoint;
        $response_cart = $nama_class::send_cart($page, $user_api, $link . '/' . $link_endpoint, $id_from_api, $qty, $id_user);

        if ($response_cart['status']) {

            $sqli['id_sync_cart']        = $response_cart['id_cart'];
            $sqli['status_sync_cart']    = "Berhasil";
            $sqli['ressponse_sync_cart'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama__detail", "id", $id_detail_pos);
            '<script type="text/javascript">
                setTimeout(function() {
                    console.log("This message is delayed by 1 second.");
                    window.history.back();
                }, 2000);
            </script>';
        } else {
            $sqli['status_sync_cart']    = "Gagal";
            $sqli['ressponse_sync_cart'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama__detail", "id", $id_detail_pos);
        }

        return $response_cart;
    }
    public static function send_order($page, $id_api, $id_order)
    {
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
        // 
        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "api_master__user.active=1");
        DB::whereRawPage($page, "api_master__list__versi.active=1");
        $user_api = DB::get('all');

        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        DB::table("api_master__link");
        DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "id_kategori_api=6");
        $user_api_endpoint = DB::get('all');

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;

        $response_cart = $nama_class::send_order($page, $user_api, $link . '/' . $link_endpoint, $id_order);
        if ($response_cart['status']) {

            $sqli['nomor_sync_pesanan']    = $response_cart['nomor'];
            $sqli['id_sync_pesanan']       = $response_cart['seq'];
            $sqli['status_sync_pesanan']   = "Berhasil";
            $sqli['response_sync_pesanan'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama", "id", $id_order);
        } else {
            $sqli['status_sync_pesanan']   = "Gagal";
            $sqli['response_sync_pesanan'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama", "id", $id_order);
        }

        return $response_cart;
    }
    public static function api($page, $id_api, $kategori, $overide_versi = '', $overide_link = '')
    {
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on ' . (! $overide_versi ? 'api_master__list__versi.id = id_versi' : "api_master__list__versi.versi = '$overide_versi'"), 'left');
        // 
        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "api_master__user.active=1");
        DB::whereRawPage($page, "api_master__list__versi.active=1");
        DB::whereRawPage($page, "penggunaan_link is not null");
        $user_api = DB::get('all');

        $type_link = "link_" . (! $overide_link ? $user_api['row'][0]->penggunaan_link : $overide_link);
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);

        DB::table("api_master__link");
        DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "id_kategori_api=$kategori");
        $user_api_endpoint = DB::get('all');

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;
        return [
            "user_api"      => $user_api,
            "link"          => $link,
            "link_endpoint" => $link_endpoint,
            "nama_class"    => $nama_class,
        ];
    }
    public static function hapus_cart($page, $id_api, $user_id, $seq, $attemp = 0)
    {
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
        // 
        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "api_master__user.active=1");
        DB::whereRawPage($page, "api_master__list__versi.active=1");
        $user_api = DB::get('all');

        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        DB::table("api_master__link");
        DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "id_kategori_api=7");
        $user_api_endpoint = DB::get('all');

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;

        $response_cart = $nama_class::hapus_cart($page, $user_api, $link . '/' . $link_endpoint, $user_id, $seq);
        if ($response_cart['status']) {
            $sqli['status_sync_cart'] = "Dihapus";
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama__detail", "id_sync_cart", $seq);
            echo '<script type="text/javascript">
                setTimeout(function() {
                    console.log("This message is delayed by 1 second.");
                    window.history.back();
                }, 2000);
            </script>';
        } else {
        }

        echo json_encode($response_cart);
    }
    public static function cancel_order($page, $id_api, $id_detail, $seq, $user_id, $attemp = 0)
    {

        $api = ApiContent::api($page, $id_api, 10); // 8 = get_sarimbit

        $user_api      = $api['user_api'];
        $link          = $api['link'];
        $link_endpoint = $api['link_endpoint'];
        $nama_class    = $api['nama_class'];
        $response_cart = $nama_class::cancel_order($page, $user_api, $link . '/' . $link_endpoint, $user_id, $seq);

        if ($response_cart['status']) {

            $sqli['status_sync_pesanan']   = "Dihapus";
            $sqli['response_sync_pesanan'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama", "id_sync_pesanan", $seq);
        }

        echo json_encode($response_cart);
    }
    public static function get_order($page, $id_api)
    {

        $api = ApiContent::api($page, $id_api, 9); // 8 = get_sarimbit

        $user_api      = $api['user_api'];
        $link          = $api['link'];
        $link_endpoint = $api['link_endpoint'];
        $nama_class    = $api['nama_class'];
        $response_cart = $nama_class::get_order($page, $link . '/' . $link_endpoint, $user_api);
        if ($user_api['row'][0]->versi == 'Versi 2' and $response_cart['status'] == 200) {
            return ["status" => 1, "response" => $response_cart['data']];
        } else {
            return ["status" => 0, "response" => $response_cart];
        }

        // echo json_encode($response_cart);
    }
    public static function get_order_detail($page, $id_api, $id_seq)
    {

        $api = ApiContent::api($page, $id_api, 12); // 8 = get_sarimbit

        $user_api      = $api['user_api'];
        $link          = $api['link'];
        $link_endpoint = $api['link_endpoint'];
        $nama_class    = $api['nama_class'];
        $response_cart = $nama_class::get_order_detail($page, $link . '/' . $link_endpoint, $user_api, $id_seq);
        if ($user_api['row'][0]->versi == 'Versi 2' and $response_cart['status'] == 200) {
            return ["status" => 1, "response" => $response_cart['data']];
        } else if ($user_api['row'][0]->versi == 'Versi 1' and $response_cart['status'] == 200) {
            return ["status" => 1, "response" => $response_cart];
        } else {
            return ["status" => 0, "response" => $response_cart];
        }

        // echo json_encode($response_cart);
    }
    public static function acc_sync_order($page, $id_api, $id_erp_utama, $seq, $user_id, $attemp = 0)
    {

        $api = ApiContent::api($page, $id_api, 11); // 8 = get_sarimbit

        $user_api      = $api['user_api'];
        $link          = $api['link'];
        $link_endpoint = $api['link_endpoint'];
        $nama_class    = $api['nama_class'];
        $response_cart = $nama_class::acc_sync_order($page, $user_api, $link . '/' . $link_endpoint, $user_id, $seq);

        if ($response_cart['status']) {

            $sqli['status_acc_sync_pesanan']   = "Berhasil";
            $sqli['response_acc_sync_pesanan'] = json_encode($response_cart['response']);
            CRUDFunc::crud_update($page['fai'], $page, $sqli, [], [], [], "erp__pos__utama", "id_sync_pesanan", $seq);
        }

        echo json_encode($response_cart);
    }

    public static function ethica_sync_data_ekspedisi($page, $id_api)
    {
        $fai           = new MainFaiFramework();
        $get_ekspedisi = EthicaApi::ekspedisi($page);
        if ($get_ekspedisi) {
            for ($i = 0; $i < count($get_ekspedisi); $i++) {
                $detail        = $get_ekspedisi[$i];
                $db            = [];
                $db['utama']   = "webmaster__ekspedisi";
                $db['where'][] = ["UPPER(webmaster__ekspedisi.kode_ekspedisi)", '=', "'" . strtoupper($detail['kode']) . "'"];
                $get           = Database::database_coverter($page, $db, [], 'all');
                if ($get['num_rows']) {
                    $id_ekspedisi = $get['row'][0]->id;
                } else {
                    $sqli                   = [];
                    $sqli['kode_ekspedisi'] = $detail['kode'];
                    $sqli['nama_ekspedisi'] = $detail['nama'];
                    CRUDFunc::crud_insert($fai, $page, $sqli, [], 'webmaster__ekspedisi');
                    $get          = Database::database_coverter($page, $db, [], 'all');
                    $id_ekspedisi = $get['row'][0]->id;
                }
                $db            = [];
                $db['utama']   = "api_master__data";
                $db['where'][] = ["get_row_id ", "=", "'id'"];
                $db['where'][] = ["nama_row_search  ", "=", "'kode_ekspedisi'"];
                $db['where'][] = ["value  ", "=", "'" . strtoupper($detail['kode']) . "'"];
                $db['where'][] = ["database  ", "=", "'webmaster__ekspedisi'"];
                $db['where'][] = ["id_api  ", "=", "'$id_api'"];
                $db['where'][] = ["active  ", "=", "'1'"];
                $get           = Database::database_coverter($page, $db, [], 'all');
                if (! $get['num_rows']) {
                    $sqli                    = [];
                    $sqli['id_api']          = $id_api;
                    $sqli['database']        = "webmaster__ekspedisi";
                    $sqli['nama_row_search'] = "kode_ekspedisi";
                    $sqli['get_row_id']      = "id";
                    $sqli['id_from_api']     = $detail['seq'];
                    $sqli['id_in_db']        = $id_ekspedisi;
                    $sqli['value']           = strtoupper($detail['kode']);
                    CRUDFunc::crud_insert($fai, $page, $sqli, [], 'api_master__data');
                }
                $db            = [];
                $db['utama']   = "webmaster__ekspedisi__service";
                $db['where'][] = ["UPPER(webmaster__ekspedisi__service.nama_service)", '=', "'" . strtoupper($detail['service']) . "'"];
                $get           = Database::database_coverter($page, $db, [], 'all');
                if ($get['num_rows']) {
                    $id_service = $get['row'][0]->id;
                } else {
                    $sqli                 = [];
                    $sqli['kode_service'] = $detail['service'];
                    $sqli['nama_service'] = $detail['service'];
                    $sqli['deskripsi']    = $detail['deskripsi'];
                    CRUDFunc::crud_insert($fai, $page, $sqli, [], 'webmaster__ekspedisi__service');
                    $get        = Database::database_coverter($page, $db, [], 'all');
                    $id_service = $get['row'][0]->id;
                }
                $db            = [];
                $db['utama']   = "api_master__data";
                $db['where'][] = ["get_row_id ", "=", "'id'"];
                $db['where'][] = ["nama_row_search  ", "=", "'nama_service'"];
                $db['where'][] = ["value  ", "=", "'" . strtoupper($detail['service']) . "'"];
                $db['where'][] = ["database  ", "=", "'webmaster__ekspedisi__service'"];
                $db['where'][] = ["id_api  ", "=", "'$id_api'"];
                $db['where'][] = ["active  ", "=", "'1'"];
                $get           = Database::database_coverter($page, $db, [], 'all');
                if (! $get['num_rows']) {
                    $sqli                    = [];
                    $sqli['id_api']          = $id_api;
                    $sqli['database']        = "webmaster__ekspedisi__service";
                    $sqli['nama_row_search'] = "nama_service";
                    $sqli['get_row_id']      = "id";
                    $sqli['id_from_api']     = $detail['seq'];
                    $sqli['id_in_db']        = $id_service;
                }
            }
        }
    }

    public static function search_data_api($page, $id_api, $value, $database, $row_search, $get_row_id, $func_sync_api)
    {
        // 'webmaster__ekspedisi','kode_ekspedisi','id')
        if ($value == 'LAIN') {
            $value = 'LAIN - LAIN';
        }
        $db['utama']   = "api_master__data";
        $db['where'][] = ["get_row_id ", "=", "'$get_row_id'"];
        $db['where'][] = ["nama_row_search  ", "=", "'$row_search'"];
        $db['where'][] = ["UPPER(value)  ", "=", "'" . strtoupper($value) . "'"];
        $db['where'][] = ["database  ", "=", "'$database'"];
        $db['where'][] = ["id_api  ", "=", "'$id_api'"];
        $db['where'][] = ["active  ", "=", "'1'"];
        $get           = Database::database_coverter($page, $db, [], 'all');
        if ($get['num_rows']) {
            $get_row_id = $get['row'][0]->id_from_api;
        } else {

            ApiContent::$func_sync_api($page, $id_api, $get_row_id);
            $db            = [];
            $db['utama']   = "api_master__data";
            $db['np']      = "api_master__data";
            $db['where'][] = ["get_row_id ", "=", "'$get_row_id'"];
            $db['where'][] = ["nama_row_search  ", "=", "'$row_search'"];
            $db['where'][] = ["UPPER(value)  ", "=", "'" . strtoupper($value) . "'"];
            $db['where'][] = ["database  ", "=", "'$database'"];
            $db['where'][] = ["id_api  ", "=", "'$id_api'"];
            $db['where'][] = ["active  ", "=", "'1'"];
            $get           = Database::database_coverter($page, $db, [], 'all');
            // echo $get['query'];
            if ($get['num_rows']) {

                $get_row_id = $get['row'][0]->id_from_api;
            }
        }
        return $get_row_id;
    }
    
    public static function get_list_ethica_order_preorder($page)
    {
        $search         = Partial::input('search');
        $return['data'] = (array) ApiContent::get_list_order($page, 10, 2,$search, 'data');
        return $return;
    }
    public static function get_list_ethica_order($page)
    {
        $search         = Partial::input('search');
        $return['data'] = (array) ApiContent::get_list_order($page, 7, 1,$search, 'data');
        return $return;
    }
    public static function get_list_order($page, $id_sync, $id_api)
    {
        $db['select'][] = "
        erp__pos__utama.no_purchose_order,status_acc_sync_pesanan,status_sync_pesanan,response_acc_sync_pesanan,response_sync_pesanan,
        erp__pos__utama.id_apps_user,nomor_handphone,id_sync_pesanan
        ,webmaster__wilayah__provinsi.provinsi as provinsi,concat(webmaster__wilayah__kabupaten.type,' ',webmaster__wilayah__kabupaten.kota_name) as kota,
        webmaster__wilayah__postal_code.urban as kelurahan,webmaster__wilayah__kecamatan.subdistrict_name as kecamatan ,webmaster__wilayah__postal_code.postal_code,
        webmaster__wilayah__provinsi.provinsi as provinsi_asal,concat(webmaster__wilayah__kabupaten.type,' ',webmaster__wilayah__kabupaten.kota_name) as kota_asal,
        keluarahan_asal.urban as kelurahan_asal,kecamatan_asal.subdistrict_name as kecamatan_asal ,keluarahan_asal.postal_code as postal_code_asal,

        erp__pos__utama.id as primary_key
		,erp__pos__utama.create_date,erp__pos__delivery_order.*,nama_lengkap,store__toko.nama_toko,erp__pos__delivery_order.id as id_do";
        $db['np']     = "erp__pos__utama";
        $db['utama']  = "erp__pos__utama";
        $db['join'][] = ["erp__pos__group", "erp__pos__group.id", "erp__pos__utama.id_erp__pos__group"];
        $db['join'][] = ["store__toko", "store__toko.id", "erp__pos__utama.id_toko"];
        $db['join'][] = ["apps_user", "erp__pos__utama.id_apps_user", "apps_user.id_apps_user"];
        $db['join'][] = ["erp__pos__delivery_order", "erp__pos__delivery_order.id_erp__pos__utama", "erp__pos__utama.id", "left"];
        $db['join'][] = ["webmaster__wilayah__provinsi", "id_provinsi_tujuan", "webmaster__wilayah__provinsi.provinsi_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kabupaten", "id_kota_tujuan", "webmaster__wilayah__kabupaten.kota_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kecamatan", "id_kecamatan_tujuan", "webmaster__wilayah__kecamatan.subdistrict_id", "left"];
        $db['join'][] = ["webmaster__wilayah__postal_code", "id_kelurahan_tujuan", "webmaster__wilayah__postal_code.id", "left"];

        $db['join'][] = ["webmaster__wilayah__provinsi provinsi_asal", "id_provinsi_asal", "provinsi_asal.provinsi_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kabupaten kota_asal", "id_kota_asal", "kota_asal.kota_id", "left"];
        $db['join'][] = ["webmaster__wilayah__kecamatan kecamatan_asal", "id_kecamatan_asal", "kecamatan_asal.subdistrict_id", "left"];
        $db['join'][] = ["webmaster__wilayah__postal_code keluarahan_asal", "id_kelurahan_asal", "keluarahan_asal.id", "left"];

        $db['where'][] = ["1=1 WORKSPACE_SINGLE_TOKO_POS_WHERE|", "", ""];
        //$db['where'][] = ["erp__pos__utama.status", " not in", "('2','Aktif')"]; 
        $db['where'][] = ["erp__pos__group.tipe_group", " = ", "'Barang Jadi Ecommerce'"];
        $db['where'][] = ["erp__pos__utama.active", " = ", "1"];
        //$db['where'][] = ["coalesce(erp__pos__utama.status_acc_sync_pesanan,'Aktif')", " !=", "'Berhasil'"]; 
        $db['order'][] = ["erp__pos__utama.create_date", " desc", ""];
        if (Partial::input('searchsync')) {
            $db['where'][] = ["erp__pos__utama.no_purchose_order", "=", "'" . Partial::input('searchsync') . "'"];
        }
        if (Partial::input('search')) {
            $db['where'][] = ["erp__pos__utama.no_purchose_order", "=", "'" . Partial::input('search') . "'"];
        }
        if (Partial::input('length')) {
            $db['limit_raw'] = Partial::input('length') . " Offset " . Partial::input('start');
        }

        $db['where'][] = ["(select count(*) as count  from erp__pos__utama__detail 
                left join view_inventaris_list on view_inventaris_list.id = id_inventaris__asset__list 
                WHERE 
                        erp__pos__utama.id = erp__pos__utama__detail.id_erp__pos__utama
                and view_inventaris_list.id_api = $id_api)",">","0"];
        $get  = Database::database_coverter($page, $db, [], 'all');
        $no   = 0;
        $data = [];
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
                    , inventaris__asset__list.berat
                    , inventaris__asset__list.id_api
                    , inventaris__asset__list.id_sync
                    , inventaris__asset__list.id_from_api
                    , inventaris__asset__list__varian.asal_from_data_varian
                    , inventaris__asset__list__varian.id_api_varian
                    , inventaris__asset__list__varian.id_sync_varian
                    , inventaris__asset__list__varian.id_from_api_varian
                    , inventaris__asset__list__varian.nama_varian
                    , inventaris__asset__list__varian.berat_varian
                    ,ressponse_sync_cart
                    ,qty_pesanan
                    ,id_sync_cart
                    ,erp__pos__utama__detail.berat_total
                    ,erp__pos__utama__detail.berat_satuan
                    ";
                $db['utama']   = "erp__pos__utama__detail";
                $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
                $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian and inventaris__asset__list__varian.id_inventaris__asset__list = inventaris__asset__list.id ", 'left'];
                $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
                $db['where'][] = ["erp__pos__utama__detail.id_erp__pos__utama", "=", "$row->primary_key"];
                $db['where'][] = ["erp__pos__utama__detail.active", "=", "1"];
                $get2          = Database::database_coverter($page, $db, [], 'all');

                $barang      = " <ol>";
                $total_cart  = $get2['num_rows'];
                $total_beres = 0;
                $total_berat = 0;
                if ($get2['num_rows']) {
                    foreach ($get2['row'] as $row2) {

                        if (($row2->varian_barang == 1 and $row2->asal_from_data_varian == 'Api') or ($row2->asal_barang_dari == 'Api')) {
                            $berat       = $row2->varian_barang ? $row2->berat_varian : $row2->berat;
                            $berat_total = $berat * $row2->qty_pesanan;
                            $total_berat += $berat_total;
                            $update_detail = [];
                            $ada           = false;
                            if (! $row2->berat_total) {
                                $ada               = true;
                                $row2->berat_total = $update_detail['berat_total'] = $berat_total;
                            }
                            if (! $row2->berat_satuan) {
                                $ada                = true;
                                $row2->berat_satuan = $update_detail['berat_satuan'] = $berat;
                            }
                            if ($ada) {
                                DB::update("erp__pos__utama__detail", $update_detail, [('id=' . $row2->id_detail)]);
                            }
                            $total_berat += $row2->berat_total;

                            $barang .= "
                    <li>" . $row2->nama_barang . "<Br>
                    <br>Varian:" . $row2->nama_varian . "
                    <br>Qty:" . $row2->qty_pesanan . "
                    <br>Status Sync:" . $row2->status_sync_cart . "

                    </li>
                ";
                            if ($row2->status_sync_cart == 'Berhasil') {
                                $total_beres++;
                            }
                        }
                    }
                }
                if ($row->total_berat != $total_berat and $row->id_do) {
                    $update_detail    = [];
                    $row->total_berat = $update_detail['total_berat'] = $total_berat;
                    DB::update("erp__pos__delivery_order", $update_detail, [('id=' . $row->id_do)]);
                }
                $barang .= "</ol>";

                $data['id_apps_user']            = $row->id_apps_user;
                $data['nama']                    = $row->nama_lengkap;
                $data['no_hp']                   = $row->nomor_handphone;
                $data['alamat']                  = $row->alamat_tujuan;
                $data['id_provinsi']             = $row->id_provinsi_tujuan;
                $data['id_kota']                 = $row->id_kota_tujuan;
                $data['id_kecamatan']            = $row->id_kecamatan_tujuan;
                $data['provinsi']                = $row->provinsi;
                $data['kota']                    = $row->kota;
                $data['kecamatan']               = $row->kecamatan;
                $data['kelurahan']               = $row->kelurahan;
                $data['ongkos_kirim']            = $row->ongkir;
                $data['ekspedisi_seq']           = ApiContent::search_data_api($page, 1, $paket[0], 'webmaster__ekspedisi', 'kode_ekspedisi', 'id', 'ethica_sync_data_ekspedisi');
                $data['ekspedisi']               = $paket[0];
                $data['service']                 = $paket[1];
                $data['kode_booking']            = $row->kode_booking;
                $data['no_resi']                 = $row->nomor_resi;
                $data['no_hp_pengirim']          = $row->no_telepon_pengirim ?? $row->nomor_pengirim;
                $data['nama_pengirim']           = $row->nama_pengirim ?? $row->nama_toko;
                $data['alamat_pengirim_lengkap'] = $row->alamat_asal;
                $data['alamat_pengirim']         = $data['nama_pengirim'] . '<br>' . $row->alamat_asal . ($row->no_bangunan_asal ? "No. " . $row->no_bangunan_asal : "") . ' Kel:' . $row->kelurahan_asal . ' Kec:' . $row->kecamatan_asal . ', ' . $row->provinsi_asal . ' ' . $row->kota_asal . ', ' . $row->postal_code_asal . ($row->patokan_asal ? "(Patokan: " . $row->patokan_asal . ")" : "") . '<BR>No Hp:' . $data['no_hp_pengirim'];
                $data['alamat_kirim']            = "Kepada<br>Yth:" . $data['nama'] .
                "<br>Alamat : " . $data['alamat'] . ($row->no_bangunan_tujuan ? "No. " . $row->no_bangunan_tujuan : "") . ' Kel:' . $data['kelurahan'] . ' Kec:' . $data['kecamatan'] . ', ' . $data['provinsi'] . ' ' . $data['kota'] . ', ' . $row->postal_code . ($row->patokan_tujuan ? "(Patokan: " . $row->patokan_tujuan . ")" : "") . "<BR>No. HP :" . $data['no_hp'];
                $page['route_type'] = "costum_link"; //
                $text               = "Sync Order";
                $no++;
                $detail = "";
                $detail .= "

                    <h4>Data Penerima</h4>
                    Nama Kirim:" . $data['nama'] .
                    "<br>no_telepon_kirim:" . $data['no_hp'] .
                    "<br>alamat-kirim-lengkap:" . $data['alamat'];

                // "<br>id-provinsi:" . $data['id_provinsi'] .
                // "<br>id-kota:" . $data['id_kota'] .
                // "<br>id-kecamatan:" . $data['id_kecamatan'] .
                $detail .= "<br>Provinsi:" . $data['provinsi'] .
                    "<br>Kota:" . $data['kota'] .

                    "<br>kecamatan:" . $data['kecamatan'] .
                    "<br>kelurahan:" . $data['kelurahan'];
                $detail .= "<br>alamat_kirim:" . $data['alamat_kirim'];
                if (! ($row->status_acc_sync_pesanan == 'Berhasil' or $row->status_sync_pesanan == 'Dihapus')) {
                    $detail .= '<br><button type="button" class="btn btn-primary btn-sm btn-xs" data-toggle="modal" data-target="#exampleModalLongPenerima' . $row->primary_key . '">
                                    Edit Alamat Penerima
                                    </button>
                                    <div class="modal fade" id="exampleModalLongPenerima' . $row->primary_key . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongPenerima' . $row->primary_key . 'Title" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongPenerima' . $row->primary_key . 'Title">Update Alamat Penerima</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="' . base_url() . "/FaiServer/costum/Ecommerce/update_detail/" . $page['load']['id_web__apps'] . "/1/" . $row->primary_key . '"' . " method='post'>" . '
                                        <div class="modal-body">
                                          <div class="form-group">

                                                <label for="exampleInputEmail1">Nama Penerima</label>
                                                <input class="form-control" name="nama_penerima" value="' . $data['nama'] . '">

                                                <div class="form-group">

                                                    <label for="exampleInputEmail1">Nomor Telepon Penerima</label>
                                                    <input class="form-control" name="no_telp_penerima" value="' . $data['no_hp'] . '">
                                                </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Penerima</label>
                                            <select class="form-control" name="alamat_penerima">
                                            <option value="">Pilih</option>
                                            ';
                    $db_bangunan            = [];
                    $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
                    $db_bangunan['join'][]  = ['inventaris__asset__tanah__bangunan__pengisi', "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id"];
                    $db_bangunan['where'][] = ['inventaris__asset__tanah__bangunan__pengisi.id_apps_user', '=', $row->id_apps_user];
                    $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');

                    if ($get_db_bangunan['num_rows'] > 0) {
                        foreach ($get_db_bangunan['row'] as $key => $value) {
                            $detail .= '<option value="' . $value->primary_key . '">' . $value->nama_unit_bangunan . '</option>';
                        }
                    }
                    $detail .= ' </select>
                                        </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    </div>';
                }
                $detail .=
                    "
                    <h4> Data Pengirim</h4>
                    nama-pengirim:" . $data['nama_pengirim'] .
                    "<br>no-telepon-pengirim:" . $data['no_hp_pengirim'] .
                    "<br>alamat-pengirim-lengkap:" . $data['alamat_pengirim_lengkap'] .
                    "<br>alamat-pengirim:" . $data['alamat_pengirim'];

                if (! ($row->status_acc_sync_pesanan == 'Berhasil' or $row->status_sync_pesanan == 'Dihapus')) {

                    $detail .= '<br><button type="button" class="btn btn-primary btn-sm btn-xs" data-toggle="modal" data-target="#exampleModalLongPengirim' . $row->primary_key . '">
                                        Edit Alamat Pengirim
                                        </button>
                                        <div class="modal fade" id="exampleModalLongPengirim' . $row->primary_key . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongPengirim' . $row->primary_key . 'Title" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongPengirim' . $row->primary_key . 'Title">Update Alamat Pengirim</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="' . base_url() . "/FaiServer/costum/Ecommerce/update_detail/" . $page['load']['id_web__apps'] . "/1/" . $row->primary_key . '"' . " method='post'>" . '
                                            <div class="modal-body">

                                                    <div class="form-group">

                                                    <label for="exampleInputEmail1">Nama Pengirim</label>
                                                    <input class="form-control" name="nama_pengirim" value="' . $data['nama_pengirim'] . '">

                                                    <div class="form-group">

                                                        <label for="exampleInputEmail1">Nomor Telepon Pengirim</label>
                                                        <input class="form-control" name="no_telp_pengirim" value="' . $data['no_hp_pengirim'] . '">
                                                    </div>
                                                <div class="form-group">

                                                    <label for="exampleInputEmail1">Alamat Pengirim</label>
                                                    <select class="form-control" name="alamat_pengirim">
                                                    <option value="">Pilih</option>
                                                ';
                    $db_bangunan            = [];
                    $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
                    $db_bangunan['np']      = 'inventaris__asset__tanah__bangunan';
                    $db_bangunan['where'][] = ['cast(inventaris__asset__tanah__bangunan.id_toko as INT)', '=', $page['load']['workspace']['id_single_toko']];
                    $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
                    if ($get_db_bangunan['num_rows'] > 0) {
                        foreach ($get_db_bangunan['row'] as $key => $value) {
                            $detail .= '<option value="' . $value->primary_key . '">' . $value->nama_unit_bangunan . '</option>';
                        }
                    }
                    $detail .= '
                                                </select>
                                                </div>
                                                </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                        </div>

                                        ';
                }
                $detail .= "
                <h4> Data Ekspedisi</h4>
               ongkos-kirim:" . $data['ongkos_kirim'] .
                "<br>ekspedisi-seq:" . $data['ekspedisi_seq'] .
                "<br>ekspedisi:" . $data['ekspedisi'] .
                "<br>service:" . $data['service'] .
                "<br>kode_booking:" . $data['kode_booking'] .
                "<br>no_resi:" . $data['no_resi'] .

                "
                    <h4> Data Pesanan</h4>
                    is-selesai-chat:F" .
                "<br>tipe-apps:W" .
                "<br>no-eksternal:" . $row->no_purchose_order;
                $aksi = "";
                if ($row->status_acc_sync_pesanan == 'Berhasil') {

                    $aksi .= "<br>Sinkronisasi pesanan disetujui";
                } else if ($row->status_sync_pesanan == 'Berhasil') {
                    $link_acc = base_url() . "/FaiServer/costum/" . "Ecommerce" . '/' . "acc_sync_order" . '/' . $page['load']['id_web__apps'] . '/' . "1" . '/' . $row->primary_key . '/' . $row->id_sync_pesanan . '/' . $row->id_apps_user;

                    $aksi .= "
                            <a href='javascript:void(0)' onclick='link_acc_pesanan(this," . $page['load']['id_web__apps'] . ",$id_api,$row->primary_key,$row->id_sync_pesanan, $row->id_apps_user)' class='btn btn-primary'>Acc</a>
                            ";
                    $link_acc = base_url() . "/FaiServer/costum/" . "Ecommerce" . '/' . "cancel_order" . '/' . $page['load']['id_web__apps'] . '/' . "1" . '/' . $row->primary_key . '/' . $row->id_sync_pesanan . '/' . $row->id_apps_user;

                    $aksi .= "
                            <a href='javascript:void(0)' onclick='link_cancel_pesanan(this," . $page['load']['id_web__apps'] . ",$id_api,$row->primary_key,$row->id_sync_pesanan, $row->id_apps_user)'
							class='btn btn-primary'>Cancel Order</a>
                            ";
                    //$link_acc =  base_url()."/FaiServer/costum/"."Ecommerce".'/'. "cancel_order".'/'. $page['load']['id_web__apps'].'/'. "1".'/'. $row->primary_key;

                    $aksi .= "
                            <a href='#' class='btn btn-primary'>Update Ongkir dan Resi</a>
                            ";
                } else if ($row->status_sync_pesanan == 'Dihapus') {

                    $aksi .= "<br>Sinkronisasi pesanan terhapus";
                } else {
                    $total_belum = 0;
                    if (! $data['alamat_pengirim'] or ! $data['alamat'] or ! $data['no_hp'] or ! $data['no_hp_pengirim'] or ! $data['alamat_pengirim_lengkap']) {
                        $total_belum++;
                        $aksi .= "<Br>Data Alamat Belum lengkap<br>
                            " . '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong' . $row->primary_key . '">
                                    Lengkapi
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLong' . $row->primary_key . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLong' . $row->primary_key . 'Title" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLong' . $row->primary_key . 'Title">Update Alamat Pengiriman</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="' . base_url() . "/FaiServer/costum/Ecommerce/update_detail/" . $page['load']['id_web__apps'] . "/1/" . $row->primary_key . '"' . " method='post'>" . '
                                        <div class="modal-body">

                                                <div class="form-group">

                                                <label for="exampleInputEmail1">Nama Pengirim</label>
                                                <input class="form-control" name="nama_pengirim" value="' . $data['nama_pengirim'] . '">

                                                <div class="form-group">

                                                    <label for="exampleInputEmail1">Nomor Telepon Pengirim</label>
                                                    <input class="form-control" name="no_telp_pengirim" value="' . $data['no_hp_pengirim'] . '">
                                                </div>
                                            <div class="form-group">

                                                <label for="exampleInputEmail1">Alamat Pengirim</label>
                                                <select class="form-control" name="alamat_pengirim">
                                                <option value="">Pilih</option>
                                            ';
                        $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
                        $db_bangunan['where'][] = ['cast(inventaris__asset__tanah__bangunan.id_toko as int)', '=', $page['load']['workspace']['id_single_toko']];
                        $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
                        if ($get_db_bangunan['num_rows'] > 0) {
                            foreach ($get_db_bangunan['row'] as $key => $value) {
                                $aksi .= '<option value="' . $value->primary_key . '">' . $value->nama_unit_bangunan . '</option>';
                            }
                        }
                        $aksi .= '
                                            </select>
                                            </div>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Penerima</label>
                                            <select class="form-control" name="alamat_penerima">
                                            <option value="">Pilih</option>
                                            ';
                        $db_bangunan            = [];
                        $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
                        $db_bangunan['join'][]  = ['inventaris__asset__tanah__bangunan__pengisi', "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id"];
                        $db_bangunan['where'][] = ['inventaris__asset__tanah__bangunan__pengisi.id_apps_user', '=', $row->id_apps_user];
                        $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');

                        if ($get_db_bangunan['num_rows'] > 0) {
                            foreach ($get_db_bangunan['row'] as $key => $value) {
                                $aksi .= '<option value="' . $value->primary_key . '">' . $value->nama_unit_bangunan . '</option>';
                            }
                        }
                        $aksi .= ' </select>
                                        </div>

                                        <div class="form-group">

                                                    <label for="exampleInputEmail1">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="">Pilih</option>
                                                        <option value="8">Invoice</option>
                                                        <option value="7">Sales Order</option>
                                                        <option value="14">Delivery Order</option>

                                                    </select>
                                                </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    ' . "
                            ";
                    } else if (! $data['ekspedisi'] or ! $data['service'] or ! $data['no_resi'] or ! $data['kode_booking']) {

                        $aksi .= "
                    <Br>Data Ekspedisi Belum lengkap<br>
                            " . '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLongEkspedisi' . $row->primary_key . '">
                                    Lengkapi
                    </button>
                    <br>Sync Cart terlebih dahulu<!-- Modal -->
                    <div class="modal fade" id="exampleModalLongEkspedisi' . $row->primary_key . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongEkspedisi' . $row->primary_key . 'Title" aria-hidden="true">
                    <form action="' . base_url() . "/FaiServer/costum/Ecommerce/update_detail/" . $page['load']['id_web__apps'] . "/1/" . $row->primary_key . '" method="post">
                    form
                    <div class="modal-dialog" role="document">

                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongEkspedisi' . $row->primary_key . 'Title">Update Alamat Pengiriman</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ';
                        if (! $data['ekspedisi'] or ! $data['service']) {
                            $ongkir = OngkirApp::print_ongkir($row->id_store_ongkir, $row->id_kota_tujuan, $row->total_berat, 'all_option', $row->id_kota_asal, null, $page);

                            $aksi .= '
                                               <div class="form-group">

                                                    <label for="exampleInputEmail1">Ekspedisi</label>
                                                    <select class="form-control" name="ekspedisi" id="ekspedisi' . $row->primary_key . '" onchange="change_ekspedisi' . $row->primary_key . '()">
                                                        <option value="">Pilih </option>
                                                        ';

                            $aksi .= $ongkir['ekspedisi'];

                            $aksi .= '
                                                    </select>
                                                </div>
                                               <div class="form-group">

                                                    <label for="exampleInputEmail1">Service</label>
                                                    <select class="form-control" name="service" onchange="change_service' . $row->primary_key . '()" id="service' . $row->primary_key . '">
                                                        <option value="">Pilih terlebih dahulu ekspedisi </option>
                                                        ';

                            $aksi .= '
                                                    </select>
                                                </div>

                                                <script>
                                                    var data_service = ' . json_encode($ongkir['service']) . ';
                                                    function change_ekspedisi' . $row->primary_key . '(){
                                                        var ekspedisi = document.getElementById("ekspedisi' . $row->primary_key . '").value;
                                                        var service = document.getElementById("service' . $row->primary_key . '");
                                                        service.innerHTML = \' <option value="">Pilih </option> \'+data_service[ekspedisi].option;

                                                    }
                                                        function change_service' . $row->primary_key . '(){
                                                        var ekspedisi = document.getElementById("ekspedisi' . $row->primary_key . '").value;
                                                        var service = document.getElementById("service' . $row->primary_key . '");
                                                        var ongkir = document.getElementById("ongkir");
                                                        var estimasi_kirim = document.getElementById("estimasi_kirim");
                                                        ongkir.value = data_service[ekspedisi].cost[service.value];
                                                        estimasi_kirim.value = data_service[ekspedisi].etd[service.value];
                                                        }

                                                </script>

                                            <div class="form-group">

                                                        <label for="exampleInputEmail1">Ongkir</label>
                                                        <input class="form-control" name="ongkir" id="ongkir">
                                                    </div>
                                            <div class="form-group">

                                                        <label for="exampleInputEmail1">Estimasi Kirim</label>
                                                        <input class="form-control" name="estimasi_kirim" id="estimasi_kirim">
                                                    </div>';
                        }
                        $aksi .= '
                                            <div class="form-group">

                                                        <label for="exampleInputEmail1">Kode Booking</label>
                                                        <input class="form-control" name="kode_booking" value="' . $data['kode_booking'] . '">
                                                    </div>
                                            <div class="form-group">

                                                        <label for="exampleInputEmail1">No resi</label>
                                                        <input class="form-control" name="nomor_resi" value="' . $data['no_resi'] . '">

                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </div>
                                    </div>
                                    </form>
                                    </div>
                                    ' . "
                            ";
                    } else if ($total_beres != $total_cart) {

                        $aksi .= "<br>Sync Cart terlebih dahulu";
                    } else if ($total_beres == $total_cart) {
                        $true = true;
                        foreach ($data as $to_key => $to_value) {
                            if ($to_key == 'ongkos_kirim') {
                            } else
                            if (empty($to_value)) {
                                $aksi .= $to_key . ' is empty';
                                $true = false;
                            }
                        }
                        if ($true) {

                            $link = base_url() . "/FaiServer/costum/" . "Ecommerce" . '/' . "sync_order" . '/' . $page['load']['id_web__apps'] . '/' . "1" . '/' . $row->primary_key;

                            $aksi .= "<a href='" . $link . "' class='btn btn-primary'>$text</a>";
                        }
                    } else {
                        $aksi .= "Sync Cart terlebih dahulu";
                    }
                }

                $dataReturn[] = [
                    "nomor_sales_order"   => trim($row->no_purchose_order . "<br>" . $row->create_date),
                    "detail"              => trim($detail),
                    "barang"              => trim($barang),
                    "status_sync_pesanan" => ($row->status_sync_pesanan ? $row->status_sync_pesanan : 'Belum') . "<br><br>
					Status Acc :
					<div id='status_acc_sync_pesanan-$row->primary_key'>
					" . ($row->status_acc_sync_pesanan ? $row->status_acc_sync_pesanan : 'Belum') . "
					</div>
					<div  id='response_acc_sync_pesanan-$row->primary_key'> Response acc:
						" . ($row->response_acc_sync_pesanan) . "
					</div>
					",
                    "response"            => $row->response_sync_pesanan,
                    "aksi"                => trim($aksi),
                ];
            }
        }

        return ["row" => $dataReturn, "num_rows" => $get['num_rows'], "num_rows_non_limit" => $get['num_rows_non_limit']];
    }
    public static function ethica_list_order($page, $id, $id_api)
    {
        $return = "";

        // echo $get['query'];
        $list_order_esios = ApiContent::get_order($page, 1);
        // asort($list_order_esios);
        $return = '<ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">List Order Web</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Cari Order Esios</button>
            </li>

            </ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <table class="table table-stripped">
                <thead>
                    <th>Pesanan</th>
                    <th>Ekspedisi</th>
                    <th>Detail</th>
                    <th>Aksi</th>

                </thead>
                <tbody>
                ';
        $nomor_order = 0;
        if ($list_order_esios['status']) {

            foreach ($list_order_esios['response'] as $res) {
                $detail = ApiContent::get_order_detail($page, 1, $res['seq']);
                $nomor_order++;
                $return .= '<tr>
                <td>Tanggal' . $res['tanggal'] . '<Br>
                Nomor Esios:' . $res['nomor'] . '<br>
                Nomor PO Web:' . $res['no_eksternal'] . '<br>Status :' . $res['status_order'] . '
                <br>' . $res['seq'] . '</td>
                <td>Kode Booking :' . $res['kode_booking'] . '
                <br> No Resi : ' . $res['no_resi'] . '
                <br> Ongkos Kirim : ' . $res['ongkos_kirim'] . '
                </td>
                <td>
                ';
                if (! empty($detail['response'])) {
                    foreach ($detail['response'] as $det) {

                        $return .= '<hr><br>' . $det['nama'] . ' <br>' . $det['qty'] . 'psc x ' . $det['harga'] . '<br>' .
                            'Subtotal:' . $det['subtotalmst'] . '<br> Diskon:' . $det['diskon'] . '<br> Total:' . $det['totalmst'];
                    }
                }
                $return .= '
                </td>
                <td>';
                if ($res['status_order'] == 'BELUM APPROVE' or $res['status_order'] == 'KEEP') {
                    $db_list_order            = [];
                    $db_list_order['utama']   = "erp__pos__utama";
                    $db_list_order['table']   = "erp__pos__utama";
                    $db_list_order['np']      = "erp__pos__utama";
                    $db_list_order['where'][] = ["erp__pos__utama.no_purchose_order", "=", "'" . $res['no_eksternal'] . "'"];
                    $get3                     = Database::database_coverter($page, $db_list_order, [], 'all');

                    $row3     = $get3['row'][0];
                    $link_acc = base_url() . "/FaiServer/costum/" . "Ecommerce" . '/' . "acc_sync_order" . '/' . $page['load']['id_web__apps'] . '/' . "1" . '/' . $row3->primary_key . '/' . $res['seq'] . '/' . $row3->id_apps_user;
                    $return .= "
                    <a href='" . $link_acc . "' class='btn btn-primary'>Acc</a>
                    ";
                }
                $return .= '</td>
                </tr>
                ';
            }
        }
        $return .= '</table>
            </div>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            ' . "

        <div style='overflow-x:scroll'>
        <table class='table table-striped text-nowrap' style='max-width:100%;'>
            <thead>
            <tr>
                <th>No</th>
                <th>Nomor Sales Order</th>
                <th>Detail </th>
                <th>Barang</th>
                <th>Status Sync Pesanan</th>
                <th>Response</th>
                <th>Aksi</th>
            </tr>

            ";
        $no = 0;
        return $return;
    }
    public static function get_list_ethica_cart($page)
    {
        $search         = Partial::input('search');
        $return['data'] = ApiContent::get_list_cart($page, 6, $search, 'data');
        return $return;
    }
    public static function get_list_cart($page, $id, $search)
    {
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
        ,id_sync_cart
        ,erp__pos__utama.id_apps_user
        ,nama_lengkap,
        erp__pos__utama__detail.create_date,
        erp__pos__utama__detail.qty
		";
        $db['utama']   = "erp__pos__utama__detail";
        $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
        $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian", 'left'];
        $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
        $db['join'][]  = ["apps_user", "erp__pos__utama.id_apps_user", "apps_user.id_apps_user", 'left'];
        $db['order'][] = ["erp__pos__utama__detail.create_date", " desc "];
        Partial::input('length');
        $db['where'][] = ["inventaris__asset__list__varian.id_api_varian", " = ", "1"];

        if (Partial::input('length')) {
            $db['limit_raw'] = Partial::input('length') . " Offset " . Partial::input('start');
        }
        $get = Database::database_coverter($page, $db, [], 'all');
        unset($db);
        $db['utama'] = "apps_user";
        $user        = Database::database_coverter($page, $db, [], 'all');

        if ($get['num_rows'] > 0) {

            foreach ($get['row'] as $row) {

                if (($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') or ($row->asal_barang_dari == 'Api')) {
                    $a = "";

                    $page['route_type'] = "costum_link";

                    if ($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') {
                        $link = Partial::link_direct($page, $page['load']['link_route'], [
                            "Ecommerce",
                            "sync_cart",
                            $page['load']['id_web__apps'],
                            $row->id_detail,
                            $row->id_api_varian,
                            $row->id_from_api_varian,
                            $row->qty,
                            $row->id_apps_user,
                        ], "costum_link");
                        // ApiContent::send_cart($page, $row->id_detail, $row->id_api_varian, $row->id_from_api_varian,$row->qty_pesanan);
                        $text = "Sync";
                    } else if ($row->asal_barang_dari == 'Api') {
                        $link = Partial::link_direct(
                            $page,
                            $page['load']['link_route'],
                            [
                                "Ecommerce",
                                "sync_cart",
                                $page['load']['id_web__apps'],
                                $row->id_detail,
                                $row->id_api,
                                $row->id_from_api,
                                $row->qty,
                                $row->id_apps_user,
                            ],
                            "costum_link"
                        );
                        $text = "Sync";
                        // ApiContent::send_cart($page, $row->id_detail, $row->id_api, $row->id_from_api,$row->qty_pesanan);
                    }
                    if ($row->status_sync_cart == 'Berhasil' or ($row->status_sync_cart == 'Hapus')) {
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>Resync</a>";
                        $link = "" . base_url("FaiServer/Costum/Ecommerce/hapus_cart/" . $page['load']['id_web__apps'] . '/1/' . $row->id_apps_user, $row->id_sync_cart) . "";
                        // Partial::link_direct($page, $page['load']['link_route'], array("Ecommerce", "hapus_cart", $page['load']['id_web__apps'],  $row->id_api, $row->id_detail, $row->id_sync_cart), "costum_link");
                        $text = "Hapus Sync";
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>$text</a>";
                    } else {
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>$text</a>";
                    }
                    $link = "" . base_url("FaiServer/Costum/Ecommerce/hapus_cart_web/" . $page['load']['id_web__apps'] . '/1/' . $row->id_detail) . "";
                    // Partial::link_direct($page, $page['load']['link_route'], array("Ecommerce", "hapus_cart", $page['load']['id_web__apps'],  $row->id_api, $row->id_detail, $row->id_sync_cart), "costum_link");
                    $a .= "<a href='" . $link . "' class='btn btn-primary'>Hapys Cart web</a>";
                    $dataReturn[] = [
                        "nomor_sales_order" => $row->no_purchose_order . "<Br> $row->create_date",
                        "nama_lengkap"      => $row->nama_lengkap,
                        "nama_barang"       => $row->nama_barang,
                        "varian"            => $row->nama_varian,
                        "qty_pesanan"       => $row->qty,
                        "status_cart"       => $row->status_sync_cart,
                        "response"          => $row->ressponse_sync_cart,
                        "aksi"              => $a,
                    ];
                }
            }
        }
        return ["row" => $dataReturn, "num_rows" => $get['num_rows'], "num_rows_non_limit" => $get['num_rows_non_limit']];
    }
    public static function get_list_ethica_cart_preorder($page)
    {
        $search         = Partial::input('search');
        $return['data'] = ApiContent::get_list_cart_preorder($page, 6, $search, 'data');
        return $return;
    }
    public static function get_list_cart_preorder($page, $id, $search)
    {
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
        ,id_sync_cart
        ,erp__pos__utama.id_apps_user
        ,nama_lengkap,
        erp__pos__utama__detail.create_date,
        erp__pos__utama__detail.qty
		";
        $db['utama']   = "erp__pos__utama__detail";
        $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
        $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian", 'left'];
        $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
        $db['join'][]  = ["apps_user", "erp__pos__utama.id_apps_user", "apps_user.id_apps_user", 'left'];
        $db['order'][] = ["erp__pos__utama__detail.create_date", " desc "];
        $db['where'][] = ["inventaris__asset__list__varian.id_api_varian", " = ", "2"];
        Partial::input('length');
        if (Partial::input('length')) {
            $db['limit_raw'] = Partial::input('length') . " Offset " . Partial::input('start');
        }
        $get = Database::database_coverter($page, $db, [], 'all');
        unset($db);
        $db['utama'] = "apps_user";
        $user        = Database::database_coverter($page, $db, [], 'all');
        $dataReturn  = [];
        if ($get['num_rows'] > 0) {

            foreach ($get['row'] as $row) {

                if (($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') or ($row->asal_barang_dari == 'Api')) {
                    $a = "";

                    $page['route_type'] = "costum_link";

                    if ($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') {
                        $link = Partial::link_direct($page, $page['load']['link_route'], [
                            "Ecommerce",
                            "sync_cart",
                            $page['load']['id_web__apps'],
                            $row->id_detail,
                            $row->id_api_varian,
                            $row->id_from_api_varian,
                            $row->qty,
                            $row->id_apps_user,
                        ], "costum_link");
                        // ApiContent::send_cart($page, $row->id_detail, $row->id_api_varian, $row->id_from_api_varian,$row->qty_pesanan);
                        $text = "Sync";
                    } else if ($row->asal_barang_dari == 'Api') {
                        $link = Partial::link_direct(
                            $page,
                            $page['load']['link_route'],
                            [
                                "Ecommerce",
                                "sync_cart",
                                $page['load']['id_web__apps'],
                                $row->id_detail,
                                $row->id_api,
                                $row->id_from_api,
                                $row->qty,
                                $row->id_apps_user,
                            ],
                            "costum_link"
                        );
                        $text = "Sync";
                        // ApiContent::send_cart($page, $row->id_detail, $row->id_api, $row->id_from_api,$row->qty_pesanan);
                    }
                    if ($row->status_sync_cart == 'Berhasil' or ($row->status_sync_cart == 'Hapus')) {
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>Resync</a>";
                        $link = "" . base_url("FaiServer/Costum/Ecommerce/hapus_cart/" . $page['load']['id_web__apps'] . '/1/' . $row->id_apps_user, $row->id_sync_cart) . "";
                        // Partial::link_direct($page, $page['load']['link_route'], array("Ecommerce", "hapus_cart", $page['load']['id_web__apps'],  $row->id_api, $row->id_detail, $row->id_sync_cart), "costum_link");
                        $text = "Hapus Sync";
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>$text</a>";
                    } else {
                        $a .= "<a href='" . $link . "' class='btn btn-primary'>$text</a>";
                    }
                    $link = "" . base_url("FaiServer/Costum/Ecommerce/hapus_cart_web/" . $page['load']['id_web__apps'] . '/1/' . $row->id_detail) . "";
                    // Partial::link_direct($page, $page['load']['link_route'], array("Ecommerce", "hapus_cart", $page['load']['id_web__apps'],  $row->id_api, $row->id_detail, $row->id_sync_cart), "costum_link");
                    $a .= "<a href='" . $link . "' class='btn btn-primary'>Hapys Cart web</a>";
                    $dataReturn[] = [
                        "nomor_sales_order" => $row->no_purchose_order . "<Br> $row->create_date",
                        "nama_lengkap"      => $row->nama_lengkap,
                        "nama_barang"       => $row->nama_barang,
                        "varian"            => $row->nama_varian,
                        "qty_pesanan"       => $row->qty,
                        "status_cart"       => $row->status_sync_cart,
                        "response"          => $row->ressponse_sync_cart,
                        "aksi"              => $a,
                    ];
                }
            }
        }
        return ["row" => $dataReturn, "num_rows" => $get['num_rows'], "num_rows_non_limit" => $get['num_rows_non_limit']];
    }
    public static function ethica_list_cart($page, $id, $search)
    {

        $return = '<ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">List Cart Web</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Keranjang Tersync</button>
            </li>

            </ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        '
            . "

        <div style='overflow-x:scroll'>
        <table class='table table-striped text-nowrap' style='max-width:100%;'>
            <thead>
            <tr>
                <th>No</th>
                <th>Nomor Sales Order</th>
                <th>NAma Lengkap</th>
                <th>Nama Barang</th>
                <th>Varian</th>
                <th>Qty Pesanan</th>
                <th>Status Cart</th>
                <th>Response</th>
                <th>Aksi</th>
            </tr>

            ";
        $no    = 0;
        $data  = ApiContent::get_artikel($page, $id, $search);
        $nomor = 0;
        foreach ($data as $row) {
            $nomor++;
            $no++;
            $return .=
                "<tr>
                            <td>$no</td>

                            <td>" . $row['nomor_sales_order'] . "</td>
                            <td>" . $row['nama_lengkap'] . "</td>
                            <td>" . $row['varian'] . "</td>
                            <td>" . $row['qty_pesanan'] . "
                            <td>" . $row['status_cart'] . "
                            <td>" . $row['response'] . "
                            <td>" . $row['aksi'] . "
                            </td>

                            </tr>
                            ";
        }
        $return .= "</table></div>" . '</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <table class="table table-stripped">
        <thead>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Jumlah Keranjang</th>
            <th>Detail</th>

        </thead>
        <tbody>';
        $no     = 0;
        $id_api = 1;
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
        // 
        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        DB::whereRawPage($page, "api_master__user.active=1");
        DB::whereRawPage($page, "api_master__list__versi.active=1");
        $user_api = DB::get('all');

        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        $db['utama'] = "apps_user";
        $user        = Database::database_coverter($page, $db, [], 'all');
        if ($user['row']) {
            foreach ($user['row'] as $row) {
                $no++;
                $get_cart = EthicaApi::get_cart($page, $link, $user_api, $row->id_apps_user);

                $return .= '<tr>
      <td>' . $no . '</td>
      <td>' . $row->nama_lengkap . '
        <input type="hidden" value="' . $row->id_apps_user . '">
      </td>

      <td>' . ($get_cart ? count($get_cart) : 0) . '</td>
      <td><input type="image" value="Detail" onclick="detailControl(this)"></input></td>
        </tr>
        <tr>
        <td colspan=6 class="iTable">
            <div>
            <table class="aTable table table-stripped">
            <thead>
                <th>Nama Barang</th>
                <th>Qty Barang</th>
                <th>Harga Barang</th>
                <th>Sub TOtal</th>
                <th>Action</th>
                </thead>
                <tbody>
                ';
                if (isset($get_cart['status'])) {

                    $tidak_ada = ($get_cart['status'] == 'Tidak ada data' ?? false);
                } else {
                    $tidak_ada = false;
                }
                if ((! $tidak_ada)) {
                    if ($get_cart) {
                        foreach ($get_cart as $cart) {
                            // $link =  Partial::link_direct($page, $page['load']['link_route'], array("Ecommerce", "hapus_cart", $page['load']['id_web__apps'],1, $row->id_apps_user,$cart['seq']), "costum_link");

                            $return .= '
                <tr>
                    <td>' . $cart['nama'] . '</td>
                    <td>' . $cart['qty_order'] . '</td>
                    <td>' . $cart['harga'] . '</td>
                    <td>' . ($cart['harga'] * $cart['qty_order']) . '</td>
                    <td>' . "
                     <a href='" . (base_url() . "/FaiServer/Costum/Ecommerce/hapus_cart/" . $page['load']['id_web__apps'] . '/1/' . $row->id_apps_user . '/' . $cart['seq']) . "' class='btn btn-primary'>Hapus Cart</a>" . '
                    </td>
                </tr>
                ';
                        }
                    }
                    // https://moesneeds.id//FaiServer/costum/Ecommerce/hapus_cart/3/1/1669/0/0/0/0/0/
                }
                $return .= '
            </tbody>

        </table>
        </div>
      </td>
        </tr>';
            }
        }
        $return .= '
            </tbody>
            </table>
            <script>
            $(".iTable").hide();
            $(".iTable").addClass("hide");
            $(".aTable").hide();
            function detailControl( clickedLine ) {
            var input = $("td > input[value="+ clickedLine.value + "]").parent().parent();
            var linhaTabela = input.next();
            var table = linhaTabela.children();
            var tableInside = table.children().children();
            if(linhaTabela.children().hasClass("hide")) {
                table.addClass("show");
                table.removeClass("hide");
                tableInside.fadeIn();
                table.children().fadeIn(200);
                table.delay(200).slideUp(600).fadeIn(600);
            } else {
                table.removeClass("show");
                table.addClass("hide");
                tableInside.fadeOut(1000);
                table.children().delay(300).fadeOut(300);
                table.delay(300).slideUp("slow").fadeOut("slow");
            }
            }
            </script>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>';
        return $return;
    }

    public static function ethica_cek_stok($page, $id, $id_api, $varian, $detail = [])
    {
        if (! isset($detail[$id . $id_api]['api_master__sync'])) {

            DB::table('api_master__sync');
            DB::joinRaw('api_master__link on api_master__link.id = id_link');

            DB::whereRawPage($page, "api_master__sync.id=$id");
            $Get                                       = DB::get('all');
            $detail[$id . $id_api]['api_master__sync'] = $Get;
        } else {
            $Get = $detail[$id . $id_api]['api_master__sync'];
        }

        $id_api = $Get['row'][0]->id_api;
        if (! isset($detail[$id . $id_api]['user_api'])) {
            DB::selectRaw('*,api_master__user.id as primary_key');
            DB::table('api_master__user');
            DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
            // 
            DB::whereRawPage($page, "id_web__list_apps_board=" . $page['load']['board']);
            DB::whereRawPage($page, "id_api=$id_api");
            DB::whereRawPage($page, "api_master__user.active=1");
            DB::whereRawPage($page, "api_master__list__versi.active=1");
            $user_api = DB::get('all');
        } else {
            $user_api = $detail[$id . $id_api]['user_api'];
        }
        $user_api['query'];
        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        if (! isset($detail[$id . $id_api]['user_api_endpoint'])) {
            DB::table("api_master__link");
            DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
            DB::whereRawPage($page, "id_api=$id_api");
            DB::whereRawPage($page, "id_kategori_api=1");
            $user_api_endpoint = DB::get('all');
        } else {
            $user_api_endpoint = $detail[$id . $id_api]['user_api_endpoint'];
        }

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;

        $varian->nama_barang = str_replace('%20', ' ', trim($varian->nama_barang));
        $response            = $nama_class::produk($page, $user_api, $link . '/' . $link_endpoint, $varian->nama_barang);
        // print_r($response);

        if (! $response['status']) {

            $list_empty[] = $varian->nama_barang;
            $get_stok     = 0;
        } else {

            $get_data = ($response['response']['data']);

            $list_empty = [];
            if (! empty($get_data)) {

                $get_stok = 0;
                foreach ($get_data as $key => $artikel) {
                    foreach ($artikel['list_warna'] as $keya => $warna) {
                        foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                            $true = true;

                            if ($true and $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['nama'] == $varian->nama_barang) {

                                $get_stok = $ukuran['stok'];
                            }
                        }
                    }
                }
            } else {
                // e;print($get_data);
                $list_empty[] = $varian->nama_barang;
                $get_stok     = 0;
            }
        }

        $get_system_stok = 0;
        return ["stok" => $get_stok, 'empty' => $list_empty, 'system_stok' => $get_system_stok, "detail" => $detail, "response" => $response];
    }
    public static function ethica_cek_stok_preorder($page, $id, $id_api, $varian, $detail = [])
    {
        if (! isset($detail[$id . $id_api]['api_master__sync'])) {

            DB::table('api_master__sync');
            DB::joinRaw('api_master__link on api_master__link.id = id_link');

            DB::whereRawPage($page, "api_master__sync.id=$id");
            $Get                                       = DB::get('all');
            $detail[$id . $id_api]['api_master__sync'] = $Get;
        } else {
            $Get = $detail[$id . $id_api]['api_master__sync'];
        }

//        $id_api = $Get['row'][0]->id_api;
        if (! isset($detail[$id . $id_api]['user_api'])) {
            DB::selectRaw('*,api_master__user.id as primary_key');
            DB::table('api_master__user');
            DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');
            // 
            DB::whereRawPage($page, "id_web__list_apps_board=" . $page['load']['board']);
            DB::whereRawPage($page, "id_api=$id_api");
            DB::whereRawPage($page, "api_master__user.active=1");
            DB::whereRawPage($page, "api_master__list__versi.active=1");
            $user_api = DB::get('all');
        } else {
            $user_api = $detail[$id . $id_api]['user_api'];
        }
        $user_api['query'];
        $type_link = "link_" . $user_api['row'][0]->penggunaan_link;
        $link      = $user_api['row'][0]->$type_link;
        $link      = str_replace('{HTTPS}', 'https', $link);
        $link      = str_replace('{HTTP}', 'http', $link);
        if (! isset($detail[$id . $id_api]['user_api_endpoint'])) {
            DB::table("api_master__link");
            DB::joinRaw('api_master__list on api_master__list.id = id_api', 'left');
            DB::whereRawPage($page, "id_api=$id_api");
            DB::whereRawPage($page, "id_kategori_api=1");
            $user_api_endpoint = DB::get('all');
        } else {
            $user_api_endpoint = $detail[$id . $id_api]['user_api_endpoint'];
        }

        $link_endpoint = $user_api_endpoint['row'][0]->link_endpoint;
        $nama_class    = $user_api_endpoint['row'][0]->nama_class;

        $varian->nama_barang = str_replace('%20', ' ', trim($varian->nama_barang));
        $varian->nama_barang = str_replace('(PRE ORDER)', '', trim($varian->nama_barang));
        $varian->nama_barang = trim($varian->nama_barang);
        $response            = $nama_class::produk_pre_order($page, $user_api, $link . '/' . $link_endpoint, trim($varian->nama_barang));

        if (! $response['status']) {

            $list_empty[] = $varian->nama_barang;
            $get_stok     = 0;
        } else {

            $get_data = ($response['response']['data']);

            $list_empty = [];
            if (! empty($get_data)) {

                $get_stok = 0;
                foreach ($get_data as $key => $artikel) {
                    foreach ($artikel['list_warna'] as $keya => $warna) {
                        foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                            $true = true;
                            // print_R($ukuran);
                            if ($true and $ukuran['nama'] == $varian->nama_barang) {
                                $true = false;
                                // echo $varian->nama_barang;
                                // echo 'stok'; 
                                $get_stok = $ukuran['stok'];
                            }
                        }
                    }
                }
            } else {
                // e;print($get_data);
                $list_empty[] = $varian->nama_barang;
                $get_stok     = 0;
            }
        }

        $get_system_stok = 0;
        return ["stok" => $get_stok, 'empty' => $list_empty, 'system_stok' => $get_system_stok, "detail" => $detail, "response" => $response];
    }

    public static function send_asset($page, $array_detail)
    {

        $fai       = new MainFaiFramework();
        $is_gambar = $array_detail['is_gambar'];
        $id_api    = $array_detail['id_api'];

        $keterangan   = $array_detail['keterangan'];
        $gambar_besar = $array_detail['gambar_besar'];
        $brand        = $array_detail['brand'];
        $berat        = $array_detail['berat'];
        $sub_brand    = $array_detail['sub_brand'];
        $barcode      = $array_detail['barcode'];
        $artikel      = $array_detail['artikel'];
        $warna        = $array_detail['warna'];
        $ukuran       = $array_detail['ukuran'];
        $harga        = $array_detail['harga'];
        $seq          = $array_detail['seq'];
        $nama         = $array_detail['nama'];
        DB::table('store__toko');
        DB::whereRaw("jenis_toko='Brand'");
        DB::whereRaw("nama_toko='" . $brand . "'");
        $get_brand = DB::get('all');
        if (! $get_brand['num_rows']) {
            $last_id  = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $brand, "jenis_toko" => "Brand"], [], 'store__toko');
            $id_brand = $last_id;
        } else {
            $id_brand = $get_brand['row'][0]->id;
        }
        DB::table('store__toko');
        DB::whereRaw("jenis_toko='Brand'");
        DB::whereRaw("nama_toko='" . $sub_brand . "'");
        $get_brand = DB::get('all');
        if (! $get_brand['num_rows']) {
            $last_id     = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $sub_brand, "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
            $id_subbrand = $last_id;
        } else {
            $id_subbrand = $get_brand['row'][0]->id;
        }
        DB::table('inventaris__asset__list');
        DB::whereRaw("nama_barang='" . $nama . "'");
        DB::whereRaw("barcode='" . $barcode . "'");
        DB::whereRaw("id_brand=$id_subbrand");
        $get_brand = DB::get('all');
        if (! $get_brand['num_rows']) {
            $data['file']                     = [];
            $data['utama']                    = [];
            $data['file']['id_drive']         = 3;
            $data['file']['id_drive_folder']  = 100;
            $data['file']['storage']          = 'External';
            $data['file']['ref_database']     = 'inventaris__asset__list';
            $data['file']['path']             = $gambar_besar;
            $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
            $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

            if (! $is_gambar and $last_id_foto and $data['file']['path']) {
                $is_gambar = $last_id_foto;
            }

            if ($last_id_foto and $data['file']['path']) {
                $gambar[] = $last_id_foto;
            }

            $data['utama']['id_jenis_asset']        = 4;
            $data['utama']['id_kategori']           = 2544;
            $data['utama']['kode_barang']           = "";
            $data['utama']['nama_barang']           = $nama;
            $data['utama']['barcode']               = $barcode;
            $data['utama']['deskripsi_barang']      = $ukuran['keterangan'] ?? '';
            $data['utama']['berat']                 = (float) $berat * 1000;
            $data['utama']['peruntukan']            = "Pria Wanita";
            $data['utama']['jenis_barang']          = "Barang Jadi";
            $data['utama']['kondisi']               = 1;
            $data['utama']['harga_pokok_penjualan'] = $harga;
            $data['utama']['harga_pokok']           = $harga;
            $data['utama']['id_brand']              = $id_subbrand;
            $data['utama']['is_master']             = 1;
            $data['utama']['is_api']                = 1;
            $data['utama']['id_api']                = $id_api;
            $data['utama']['id_sync']               = 4;
            $data['utama']['foto_aset']             = $last_id_foto;
            $data['utama']['varian_barang']         = 2;
            $data['utama']['id_from_api']           = $seq;
            $data['utama']['klasifikasi_produk']    = "Per Barang";

            $data['utama']['asal_barang_dari'] = "Api";
            $data['utama']['jual_barang']      = "0";
            $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
        } else {
            $last_id_utama = $get_brand['row'][0]->id;
        }
        return $last_id_utama;
    }

    public static function get_list_ethica_sarimbit($page)
    {
        $search                = Partial::input('search');
        $return['data']['row'] = ApiContent::get_sarimbit($page, 1, $search, 'data');
        return $return;
    }

    public static function get_sarimbit($page, $id, $search, $return = '')
    {

        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get = DB::get('all');

        $id_api = $Get['row'][0]->id_api;
        if ($return != 'ethica_sarimbit_update') {

            $api = ApiContent::api($page, $id_api, 8, 'Versi 2', 'production'); // 8 = get_sarimbit

            $user_api      = $api['user_api'];
            $link          = $api['link'];
            $user_api      = $api['user_api'];
            $link          = $api['link'];
            $link_endpoint = $api['link_endpoint'];
            $nama_class    = $api['nama_class'];

            $user       = $nama_class::detail_user($page, $user_api, false, '', 'Versi 2');
            $apikey     = $user["apikey"];
            $cust_seq   = $user["cust_seq"];
            $cotumer_id = $user["costumer_id"];

            $page['db']['np'] = true;
            $start            = Partial::input('offset') ? Partial::input('offset') : 0;
            // $search = str_replace(' ','%20',$search);
            $array = ['key: ' . $apikey, 'offset: ' . $start, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
            if ($search) {
                $array[] = 'search: ' . $search;
            }

            if ($user_api['row'][0]->versi == 'Versi 2' or 1 == 1) {

                $get_data = json_decode(EthicaApi::get_sarimbit_v2($page, $link, $array, $user_api), true);
                if (isset($get_data['data'])) {
                    $get_data = $get_data['data'];
                }
            } else
            if ($user_api['row'][0]->versi == 'Versi 1') {
                // echo 'masuk2';
                $link .= "/setting_sarimbit_master/loaddata_eksternal?offset= $start&customer_seq=$cust_seq" . ($search ? "&search=$search" : '');

                $get_data = json_decode(EthicaApi::get_sarimbit($link, $array, $page, $user_api, 1, $search), true);
            }
        } else {
            $array = [
                "offset=" . (Partial::input('offset') ?? 0),
            ];
            if (Partial::input('search')) {
                $array[] = "search=" . Partial::input('search');
            }
            $link     = "";
            $get_data = json_decode(EthicaApi::get_sarimbit_update($link, $array), true);
        }
        $count = $get_data ? count($get_data) : (0);
        if ($count) {
            if (isset($get_data['status'])) {

                if ($get_data['status'] == 404) {
                    $count = 0;
                }
            }
        }
        $no       = 1;
        $fai      = new MainFaiFramework();
        $sarimbit = [];

        if ($count) {

            foreach ($get_data as $value) {
                $no++;
                $sarimbit[$value['nama_sarimbit']]['data']['seq']                = $value['seq_sarimbit'] ?? null;
                $sarimbit[$value['nama_sarimbit']]['data']['gambar']             = $value['gambar'];
                $sarimbit[$value['nama_sarimbit']]['data']['gambar_sedang']      = $value['gambar_sedang'];
                $sarimbit[$value['nama_sarimbit']]['data']['gambar_besar']       = $value['gambar_besar'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['barcode']     = $value['barcode'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['nama_produk'] = $value['nama_produk'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['warna']       = $value['WARNA'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['ukuran']      = $value['UKURAN'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['artikel']     = $value['artikel'];
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['stok']        = $value['stok'];

                $is_gambar = "";
                $gambar[]  = "";
                DB::table('inventaris__asset__list');
                DB::whereRaw("nama_barang='" . $value['nama_produk'] . "'");
                DB::whereRaw("barcode='" . $value['barcode'] . "'");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    if ($return != 'ethica_sarimbit_update') {
                        if ($user_api['row'][0]->versi == 'Versi 2') {
                            $array    = ['Offset: 0', 'key: ' . $apikey, 'search: ' . $value['nama_produk'], 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
                            $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
                            $get_data = $get_data['data'];
                        } else if ($user_api['row'][0]->versi == 'Versi 1') {
                            $get_data = json_decode(EthicaApi::get_produk($cust_seq, $value['nama_produk'], $link), 1);
                        }
                    }
                    $sarimbit[$value['nama_sarimbit']]['barang'][$no]['detail'] = $get_data;
                    foreach ($get_data as $key => $artikel) {
                        foreach ($artikel['list_warna'] as $keya => $warna) {
                            foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                                $is_gambar = $array_detail['is_gambar'] = $is_gambar;
                                $id_api    = $array_detail['id_api']    = $Get['row'][0]->id_api;

                                $nama          = $array_detail['nama']          = $ukuran['nama'];
                                $berat         = $array_detail['berat']         = $ukuran['berat'];
                                $keterangan    = $array_detail['keterangan']    = $ukuran['keterangan'];
                                $gambar_besar  = $array_detail['gambar_besar']  = $ukuran['gambar_besar'];
                                $brand         = $array_detail['brand']         = $ukuran['brand'];
                                $sub_brand     = $array_detail['sub_brand']     = $ukuran['sub_brand'];
                                $barcode       = $array_detail['barcode']       = $ukuran['barcode'];
                                $seq           = $array_detail['seq']           = $ukuran['seq'];
                                $artikel       = $array_detail['artikel']       = $get_data[$key]['artikel'];
                                $warna         = $array_detail['warna']         = $get_data[$key]['list_warna'][$keya]['warna'];
                                $ukuran        = $array_detail['ukuran']        = $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                                $harga         = $array_detail['harga']         = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                                $last_id_utama = ApiContent::send_asset($page, $array_detail);
                            }
                        }
                    }
                } else {
                    $last_id_utama = $get_brand['row'][0]->id;
                }
                $sarimbit[$value['nama_sarimbit']]['barang'][$no]['id_asset'] = $last_id_utama;
            }
        }
        $dataReturn = [];
        if ($return == "sarimbit") {
            return $sarimbit;
        }

        $data  = [];
        $nomor = 0;
        if (count($sarimbit)) {

            foreach ($sarimbit as $key => $value) {
                $nomor++;
                $stok = 0;
                DB::table('inventaris__asset__list');
                DB::whereRaw("nama_barang='" . $key . "'");
                DB::whereRaw("id_api='" . $Get['row'][0]->id_api . "'");
                DB::whereRaw("id_sync=$id");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    $data['utama']                    = [];
                    $data['file']                     = [];
                    $data['file']['id_drive']         = 3;
                    $data['file']['id_drive_folder']  = 100;
                    $data['file']['storage']          = 'External';
                    $data['file']['ref_database']     = 'inventaris__asset__list';
                    $data['file']['path']             = $value['data']['gambar_besar'];
                    $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                    $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                    $data['utama']['id_jenis_asset'] = 4;
                    $data['utama']['id_kategori']    = 2544;
                    $data['utama']['kode_barang']    = "";
                    $data['utama']['nama_barang']    = $key;
                    $data['utama']['peruntukan']     = "Pria Wanita";
                    $data['utama']['jenis_barang']   = "Barang Jadi";
                    $data['utama']['kondisi']        = 1;
                    // $data['utama']['id_brand'] = $id_subbrand;
                    $data['utama']['is_master']          = 1;
                    $data['utama']['is_api']             = 1;
                    $data['utama']['id_from_api']        = $value['data']['seq'];
                    $data['utama']['id_api']             = $Get['row'][0]->id_api;
                    $data['utama']['id_sync']            = $id;
                    $data['utama']['varian_barang']      = 1;
                    $data['utama']['klasifikasi_produk'] = $Get['row'][0]->nama_sync;

                    $data['utama']['asal_barang_dari'] = "Api";
                    $data['utama']['jual_barang']      = "0";
                    $data['utama']['foto_aset']        = "$last_id_foto";
                    $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                } else {
                    $last_id_utama = $get_brand['row'][0]->id;
                }
                $list = [];
                foreach ($value['barang'] as $barang) {
                    $list[] = $barang['nama_produk'] . ":" . $barang['stok'];

                    $stok += $barang['stok'];
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Artikel'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Artikel";
                        $id_tipe_varian1          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian1");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['artikel'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian1;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['artikel'];
                        $id_varian1                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Warna'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Warna";
                        $id_tipe_varian2          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian2");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['warna'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian2;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['warna'];
                        $id_varian2                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Size'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Size";
                        $id_tipe_varian3          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian3");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['ukuran'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian3;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['ukuran'];
                        $id_varian3                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }

                    $varian                               = [];
                    $varian['id_inventaris__asset__list'] = $last_id_utama;
                    $varian['is_asset_list_varian']       = 1;
                    $varian['generate_asset_list']        = 1;
                    $varian['id_asset_list_varian']       = $barang['id_asset'];
                    $varian['id_tipe_varian_1']           = $id_tipe_varian1;
                    $varian['id_varian_1']                = $id_varian1;
                    $varian['id_tipe_varian_2']           = $id_tipe_varian2;
                    $varian['id_varian_2']                = $id_varian2;
                    $varian['id_tipe_varian_3']           = $id_tipe_varian3;
                    $varian['id_varian_3']                = $id_varian3;
                    $varian['asal_from_data_varian']      = "'Asset'";
                    $varian['asal_from_data_varian']      = 'Asset';
                    $varian['is_master_varian']           = 1;
                    DB::table('inventaris__asset__list__varian');
                    foreach ($varian as $key_varian => $value_varian) {
                        if ($key_varian == 'asal_from_data_varian') {
                            DB::whereRaw("$key_varian='$value_varian'");
                        } else {
                            DB::whereRaw("$key_varian=$value_varian");
                        }

                    }
                    $getAda = DB::get('all');
                    if (! $getAda['num_rows']) {
                        CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                    }
                }
                if (! Partial::input('non_produk')) {

                    DB::table("store__produk");
                    DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
                    DB::whereRaw("id_master=$last_id_utama");
                    DB::whereRaw('is_master=0');
                    DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
                    $get          = DB::get('all');
                    $dataReturn[] = [
                        "nama_sarimbit" => $key,
                        "list_sarimbit" => implode('<br>', $list),
                        "stok"          => $stok,
                        "aksi"          => ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</button>"),

                    ];
                }
            }
        }

        if ($return == "sarimbit") {
            return $sarimbit;
        } else {
            return $dataReturn;
        }

    }
    public static function ethica_sarimbit($page, $id, $search, $return = '')
    {

        $sarimbit = ApiContent::get_sarimbit($page, $id, $search, 'sarimbit');
        $return   = '
        <table id="example1" class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama Sarimbit </th>
            <th>List Barang </th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
        ';
        $page['db']['np'] = true;
        $fai              = new MainFaiFramework();
        $nomor            = 0;
         DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get = DB::get('all');
        if (count($sarimbit)) {

            foreach ($sarimbit as $key => $value) {
                $nomor++;
                $stok = 0;
                DB::table('inventaris__asset__list');
                DB::whereRaw("nama_barang='" . $key . "'");
                DB::whereRaw("id_api='" . $Get['row'][0]->id_api . "'");
                DB::whereRaw("id_sync=$id");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    $data['utama']                    = [];
                    $data['file']                     = [];
                    $data['file']['id_drive']         = 3;
                    $data['file']['id_drive_folder']  = 100;
                    $data['file']['storage']          = 'External';
                    $data['file']['ref_database']     = 'inventaris__asset__list';
                    $data['file']['path']             = $value['data']['gambar_besar'];
                    $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                    $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                    $data['utama']['id_jenis_asset'] = 4;
                    $data['utama']['id_kategori']    = 2544;
                    $data['utama']['kode_barang']    = "";
                    $data['utama']['nama_barang']    = $key;
                    $data['utama']['peruntukan']     = "Pria Wanita";
                    $data['utama']['jenis_barang']   = "Barang Jadi";
                    $data['utama']['kondisi']        = 1;
                    // $data['utama']['id_brand'] = $id_subbrand;
                    $data['utama']['is_master']          = 1;
                    $data['utama']['is_api']             = 1;
                    $data['utama']['id_from_api']        = $value['data']['seq'];
                    $data['utama']['id_api']             = $Get['row'][0]->id_api;
                    $data['utama']['id_sync']            = $id;
                    $data['utama']['varian_barang']      = 1;
                    $data['utama']['klasifikasi_produk'] = $Get['row'][0]->nama_sync;

                    $data['utama']['asal_barang_dari'] = "Api";
                    $data['utama']['jual_barang']      = "0";
                    $data['utama']['foto_aset']        = "$last_id_foto";
                    $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                } else {
                    $last_id_utama = $get_brand['row'][0]->id;
                }
                $list = [];
                foreach ($value['barang'] as $barang) {
                    $list[] = $barang['nama_produk'] . ":" . $barang['stok'];

                    $stok += $barang['stok'];
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Artikel'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Artikel";
                        $id_tipe_varian1          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian1");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['artikel'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian1;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['artikel'];
                        $id_varian1                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Warna'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Warna";
                        $id_tipe_varian2          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian2");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['warna'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian2;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['warna'];
                        $id_varian2                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Size'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Size";
                        $id_tipe_varian3          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian3");
                    DB::whereRaw("nama_list_tipe_varian='" . $barang['ukuran'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian3;
                        $tipe_varian['nama_list_tipe_varian']              = $barang['ukuran'];
                        $id_varian3                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }

                    $varian                               = [];
                    $varian['id_inventaris__asset__list'] = $last_id_utama;
                    $varian['is_asset_list_varian']       = 1;
                    $varian['generate_asset_list']        = 1;
                    $varian['id_asset_list_varian']       = $barang['id_asset'];
                    $varian['id_tipe_varian_1']           = $id_tipe_varian1;
                    $varian['id_varian_1']                = $id_varian1;
                    $varian['id_tipe_varian_2']           = $id_tipe_varian2;
                    $varian['id_varian_2']                = $id_varian2;
                    $varian['id_tipe_varian_3']           = $id_tipe_varian3;
                    $varian['id_varian_3']                = $id_varian3;
                    $varian['asal_from_data_varian']      = "'Asset'";
                    $varian['asal_from_data_varian']      = 'Asset';
                    $varian['is_master_varian']           = 1;
                    DB::table('inventaris__asset__list__varian');
                    foreach ($varian as $key_varian => $value_varian) {
                        if ($key_varian == 'asal_from_data_varian') {
                            DB::whereRaw("$key_varian='$value_varian'");
                        } else {
                            DB::whereRaw("$key_varian=$value_varian");
                        }

                    }
                    $getAda = DB::get('all');
                    if (! $getAda['num_rows']) {
                        CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                    }
                }
                if (! Partial::input('non_produk')) {

                    DB::table("store__produk");
                    DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
                    DB::whereRaw("id_master=$last_id_utama");
                    DB::whereRaw('is_master=0');
                    DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
                    $get = DB::get('all');
                    $return .=
                    "<tr>
                            <td>$nomor</td>

                            <td>" . $key . "</td>
                            <td>" . implode('<br>', $list) . "</td>
                            <td>" . $stok . "</td>
                            <td>" . ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</a>") . "
                            </td>

                            </tr>
                            ";
                }
            }
        }

        $return .= '</table>';
        $return .= '<div class="card-footer">';
        $start            = Partial::input('offset') ? Partial::input('offset') : 0;
        $count            = count($sarimbit);
        if (! Partial::input('non_produk')) {
            if ($start) {
                $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start - $count) . ')">Prev</button>';
            }

            if ($count) {
                $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start + $count) . ')">Next</button>';
            }

        }
        $return .= '</div>';
        $return .= '
       <script>
        function tambah_produk(this,last_id_utama){
        ' . "
        $.ajax({
					type: 'get',
					data: {
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            'not_sidebar': 'not',
                            'MainAll': 2,
                            'id':$id,
                            'type': 'produk_sync',
                            'last_id_utama': last_id_utama,
                            'searchsync': $('#input_search_sync').val(),
                        },
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                           //  $('#result_pencarian_sync').html(data);
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
							}
                    });
        " . '
        }
       </script>

        ';
        return $return;
    }

    public static function get_list_ethica_artikel_preorder($page)
    {

        $search                = Partial::input('search');
        $return['data']['row'] = ApiContent::get_artikel_pre_order($page, 8, $search, 'data');
        return $return;
    }
    public static function get_list_ethica_artikel($page)
    {

        $search                = Partial::input('search');
        $return['data']['row'] = ApiContent::get_artikel($page, 1, $search, 'data');
        return $return;
    }
    public static function get_artikel_pre_order($page, $id, $search)
    {

        $search = str_replace("%20", " ", $search);
        $nomor  = 0;
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');
        DB::joinRaw('api_master__list on api_master__list.id = id_api');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get    = DB::get('all');
        $id_api = $Get['row'][0]->id_api;

        $id_api   = $Get['row'][0]->id_api;
        $function = $Get['row'][0]->function_cek_stok;

        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');

        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        $user_api = DB::get('all');
        $link     = $user_api['row'][0]->link_production;
        $link     = str_replace('{HTTPS}', 'https', $link);
        $link     = str_replace('{HTTP}', 'http', $link);
        if ($user_api['row'][0]->versi == 'Versi 2') {
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
            $apikey = EthicaApi::get_key_v2($cust_seq, $cotumer_id);
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
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
        }

        // $stok_api = ApiContent::$function($page, $row->id_sync_master_varian_asset, $id_api, $row, ($stok_api['detail'] ?? []));

        $start            = Partial::input('offset') ? Partial::input('offset') : 0;
        $row              = (object) [];
        $row->nama_barang = $search;
        $get_data         = ApiContent::$function($page, $id, $id_api, $row, ($stok_api['detail'] ?? []))['response']['response']['data'];
        // print_R($get_data);
        // if ($user_api['row'][0]->versi == 'Versi 2') {
        //     $array = ['Offset: ' . $start, 'key: ' . $apikey, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
        //     if ($search) {
        //         $array[] = 'search: ' . $search;
        //         $array[] = 'is_preorder: T';
        //     }
        //     $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
        //     $get_data = $get_data['data'];
        // } else if ($user_api['row'][0]->versi == 'Versi 1') {
        //     $param    = "&is_preorder=F&is_ada_stok=T";
        //     $get_data = json_decode(EthicaApi::get_produk($cust_seq, $search, $link, $param), 1);
        // }
        // print_R($get_data);

        // $count            = count(($get_data));
        $page['db']['np'] = true;
        $fai              = new MainFaiFramework();
        $dataReturn       = [];
        if ($get_data) {
            foreach ($get_data as $key => $artikel) {

                DB::table('store__toko');
                DB::whereRaw("jenis_toko='Brand'");
                DB::whereRaw("nama_toko='" . $artikel['brand'] . "'");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    $last_id  = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['brand'], "jenis_toko" => "Brand"], [], 'store__toko');
                    $id_brand = $last_id;
                } else {
                    $id_brand = $get_brand['row'][0]->id;
                }
                DB::table('store__toko');
                DB::whereRaw("jenis_toko='Brand'");
                DB::whereRaw("nama_toko='" . $artikel['sub_brand'] . "'");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    $last_id     = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['sub_brand'], "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
                    $id_subbrand = $last_id;
                } else {
                    $id_subbrand = $get_brand['row'][0]->id;
                }
                DB::table('inventaris__asset__list');
                DB::whereRaw("nama_barang='(PRE ORDER)" . $get_data[$key]['artikel'] . "'");
                DB::whereRaw("id_api='" . $Get['row'][0]->id_api . "'");
                DB::whereRaw("id_sync=$id");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {
                    $data['file']  = [];
                    $data['utama'] = [];

                    $data['utama']['id_jenis_asset'] = 4;
                    $data['utama']['id_kategori']    = 2544;
                    $data['utama']['kode_barang']    = "";
                    $data['utama']['nama_barang']    = "(PRE ORDER)" . $get_data[$key]['artikel'];
                    // $data['utama']['barcode'] = $ukuran['barcode'];
                    // $data['utama']['deskripsi_barang'] = $ukuran['keterangan'];
                    // $data['utama']['berat'] = $ukuran['berat'] * 1000;
                    $data['utama']['peruntukan']   = "Pria Wanita";
                    $data['utama']['jenis_barang'] = "Barang Jadi";
                    $data['utama']['kondisi']      = 1;
                    // $data['utama']['harga_pokok_penjualan'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                    // $data['utama']['harga_pokok'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                    $data['utama']['id_brand']           = $id_subbrand;
                    $data['utama']['is_master']          = 1;
                    $data['utama']['is_api']             = 1;
                    $data['utama']['id_api']             = $Get['row'][0]->id_api;
                    $data['utama']['id_sync']            = $id;
                    $data['utama']['varian_barang']      = 1;
                    $data['utama']['klasifikasi_produk'] = $Get['row'][0]->nama_sync;

                    $data['utama']['asal_barang_dari'] = "Api";
                    $data['utama']['jual_barang']      = "0";
                    $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                } else {
                    $last_id_utama = $get_brand['row'][0]->id;
                }
                $is_gambar = "";

                $gambar = [];
                $nomor++;
                foreach ($artikel['list_warna'] as $keya => $warna) {
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Warna'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Warna";
                        $id_tipe_varian1          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian1");
                    DB::whereRaw("nama_list_tipe_varian='" . $get_data[$key]['list_warna'][$keya]['warna'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian1;
                        $tipe_varian['nama_list_tipe_varian']              = $get_data[$key]['list_warna'][$keya]['warna'];
                        $id_varian1                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    $stok = 0;
                    foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                        // $data['file']['id_drive'] = 3;
                        // $data['file']['id_drive_folder'] = 100;
                        // $data['file']['storage'] = 'External';
                        // $data['file']['ref_database'] = 'inventaris__asset__list';
                        // $data['file']['path'] = $ukuran['gambar_besar'];
                        // $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                        // $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                        DB::table('inventaris__asset__list');
                        DB::whereRaw("nama_barang='(PRE ORDER)" . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['nama'] . "'");
                        DB::whereRaw("barcode='" . $ukuran['barcode'] . "'");
                        DB::whereRaw("id_brand=$id_subbrand");
                        $get_brand = DB::get('all');
                        if (! $get_brand['num_rows']) {
                            $data['file']                     = [];
                            $data['utama']                    = [];
                            $data['file']['id_drive']         = 3;
                            $data['file']['id_drive_folder']  = 100;
                            $data['file']['storage']          = 'External';
                            $data['file']['ref_database']     = 'inventaris__asset__list';
                            $data['file']['path']             = $ukuran['gambar_besar'];
                            $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                            $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');
                            if ($last_id_foto and $data['file']['path']) {
                                $gambar[] = $last_id_foto;
                            }

                            if (! $is_gambar and $last_id_foto and $data['file']['path']) {
                                $is_gambar = $last_id_foto;
                            }

                            $data['utama']['id_jenis_asset']        = 4;
                            $data['utama']['id_kategori']           = 2544;
                            $data['utama']['kode_barang']           = "";
                            $data['utama']['nama_barang']           = "(PRE ORDER)" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                            $data['utama']['barcode']               = $ukuran['barcode'];
                            $data['utama']['deskripsi_barang']      = $ukuran['keterangan'];
                            $data['utama']['berat']                 = $ukuran['berat'] * 1000;
                            $data['utama']['peruntukan']            = "Pria Wanita";
                            $data['utama']['jenis_barang']          = "Barang Jadi";
                            $data['utama']['kondisi']               = 1;
                            $data['utama']['harga_pokok_penjualan'] = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                            $data['utama']['harga_pokok']           = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                            $data['utama']['id_brand']              = $id_subbrand;
                            $data['utama']['is_master']             = 1;
                            $data['utama']['is_api']                = 1;
                            $data['utama']['id_api']                = $Get['row'][0]->id_api;
                            $data['utama']['foto_aset']             = $last_id_foto;
                            $data['utama']['varian_barang']         = 2;
                            $data['utama']['id_from_api']           = $ukuran['seq'];
                            $data['utama']['id_sync']               = 4;
                            $data['utama']['klasifikasi_produk']    = "Per Barang";

                            $data['utama']['asal_barang_dari'] = "Api";
                            $data['utama']['jual_barang']      = "0";
                            $last_id_varian                    = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                        } else {
                            $last_id_varian = $get_brand['row'][0]->id;
                            $gambar[]       = $get_brand['row'][0]->foto_aset;
                            if (! $is_gambar and $get_brand['row'][0]->foto_aset) {
                                $is_gambar = $get_brand['row'][0]->foto_aset;
                            }

                            $gambar[] = $get_brand['row'][0]->foto_aset;
                        }

                        DB::table('inventaris__master__tipe_varian');
                        DB::whereRaw("nama_tipe='Size'");
                        $get_tipe = DB::get('all');
                        if ($get_tipe['num_rows']) {
                            $id_tipe_varian = $get_tipe['row'][0]->id;
                        } else {
                            $tipe_varian              = [];
                            $tipe_varian['nama_tipe'] = "Size";
                            $id_tipe_varian           = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                        }
                        DB::table('inventaris__master__tipe_varian__list');
                        DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian");
                        DB::whereRaw("nama_list_tipe_varian='" . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                        $get_tipe = DB::get('all');
                        if ($get_tipe['num_rows']) {
                            $id_varian = $get_tipe['row'][0]->id;
                        } else {
                            $tipe_varian                                       = [];
                            $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian;
                            $tipe_varian['nama_list_tipe_varian']              = $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                            $id_varian                                         = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                        }

                        $stok += $ukuran['stok'];
                        $varian                               = [];
                        $varian['id_inventaris__asset__list'] = $last_id_utama;
                        $varian['is_asset_list_varian']       = 1;
                        $varian['generate_asset_list']        = 1;
                        $varian['id_asset_list_varian']       = $last_id_varian;
                        $varian['id_tipe_varian_1']           = $id_tipe_varian1;
                        $varian['id_varian_1']                = $id_varian1;
                        $varian['id_tipe_varian_2']           = $id_tipe_varian;
                        $varian['id_varian_2']                = $id_varian;
                        $varian['asal_from_data_varian']      = 'Asset';
                        $varian['is_master_varian']           = 1;
                        CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                        $stok += $ukuran['stok'];
                    }
                }
                $update_asset['foto_aset'] = $is_gambar;
                $update_asset['foto']      = implode(',', $gambar);
                CRUDFunc::crud_insert($fai, $page, $update_asset, [], 'inventaris__asset__list', ["id=$last_id_utama"], 'update');
                DB::table("store__produk");
                DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
                DB::whereRaw("id_master=$last_id_utama");
                DB::whereRaw('is_master=0');
                DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
                $get = DB::get('all');
                // echo '<pre>';
                // print_R($get);
                $dataReturn[] = [
                    "nama_artikel" => $get_data[$key]['artikel'],
                    "stok"         => $stok,
                    "aksi"         => ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk_preorder(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</button>"),
                ];
            }
        }
        return $dataReturn;
    }
    public static function get_artikel($page, $id, $search)
    {

        $search = str_replace("%20", " ", $search);
        $nomor  = 0;
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get    = DB::get('all');
        $id_api = $Get['row'][0]->id_api;
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');

        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        $user_api = DB::get('all');
        $link     = $user_api['row'][0]->link_production;
        $link     = str_replace('{HTTPS}', 'https', $link);
        $link     = str_replace('{HTTP}', 'http', $link);
        if ($user_api['row'][0]->versi == 'Versi 2') {
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
            $apikey = EthicaApi::get_key_v2($cust_seq, $cotumer_id);
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
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
        }

        $start = Partial::input('offset') ? Partial::input('offset') : 0;
        if ($user_api['row'][0]->versi == 'Versi 2') {
            $array = ['Offset: ' . $start, 'key: ' . $apikey, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
            if ($search) {
                $array[] = 'search: ' . $search;
            }
            $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
            $get_data = $get_data['data'];
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
            $get_data = json_decode(EthicaApi::get_produk($cust_seq, $search, $link), 1);
        }

        $count            = count($get_data);
        $page['db']['np'] = true;
        $fai              = new MainFaiFramework();
        foreach ($get_data as $key => $artikel) {
            DB::table('store__toko');
            DB::whereRaw("jenis_toko='Brand'");
            DB::whereRaw("nama_toko='" . $artikel['brand'] . "'");
            $get_brand = DB::get('all');
            if (! $get_brand['num_rows']) {
                $last_id  = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['brand'], "jenis_toko" => "Brand"], [], 'store__toko');
                $id_brand = $last_id;
            } else {
                $id_brand = $get_brand['row'][0]->id;
            }
            DB::table('store__toko');
            DB::whereRaw("jenis_toko='Brand'");
            DB::whereRaw("nama_toko='" . $artikel['sub_brand'] . "'");
            $get_brand = DB::get('all');
            if (! $get_brand['num_rows']) {
                $last_id     = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['sub_brand'], "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
                $id_subbrand = $last_id;
            } else {
                $id_subbrand = $get_brand['row'][0]->id;
            }
            DB::table('inventaris__asset__list');
            DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . "'");
            DB::whereRaw("id_api='" . $Get['row'][0]->id_api . "'");
            DB::whereRaw("id_sync=$id");
            $get_brand = DB::get('all');
            if (! $get_brand['num_rows']) {
                $data['file']  = [];
                $data['utama'] = [];

                $data['utama']['id_jenis_asset'] = 4;
                $data['utama']['id_kategori']    = 2544;
                $data['utama']['kode_barang']    = "";
                $data['utama']['nama_barang']    = $get_data[$key]['artikel'];
                // $data['utama']['barcode'] = $ukuran['barcode'];
                // $data['utama']['deskripsi_barang'] = $ukuran['keterangan'];
                // $data['utama']['berat'] = $ukuran['berat'] * 1000;
                $data['utama']['peruntukan']   = "Pria Wanita";
                $data['utama']['jenis_barang'] = "Barang Jadi";
                $data['utama']['kondisi']      = 1;
                // $data['utama']['harga_pokok_penjualan'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                // $data['utama']['harga_pokok'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                $data['utama']['id_brand']           = $id_subbrand;
                $data['utama']['is_master']          = 1;
                $data['utama']['is_api']             = 1;
                $data['utama']['id_api']             = $Get['row'][0]->id_api;
                $data['utama']['id_sync']            = $id;
                $data['utama']['varian_barang']      = 1;
                $data['utama']['klasifikasi_produk'] = $Get['row'][0]->nama_sync;

                $data['utama']['asal_barang_dari'] = "Api";
                $data['utama']['jual_barang']      = "0";
                $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
            } else {
                $last_id_utama = $get_brand['row'][0]->id;
            }
            $is_gambar = "";

            $gambar = [];
            $nomor++;
            foreach ($artikel['list_warna'] as $keya => $warna) {
                DB::table('inventaris__master__tipe_varian');
                DB::whereRaw("nama_tipe='Warna'");
                $get_tipe = DB::get('all');
                if ($get_tipe['num_rows']) {
                    $id_tipe_varian1 = $get_tipe['row'][0]->id;
                } else {
                    $tipe_varian              = [];
                    $tipe_varian['nama_tipe'] = "Warna";
                    $id_tipe_varian1          = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                }
                DB::table('inventaris__master__tipe_varian__list');
                DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian1");
                DB::whereRaw("nama_list_tipe_varian='" . $get_data[$key]['list_warna'][$keya]['warna'] . "'");
                $get_tipe = DB::get('all');
                if ($get_tipe['num_rows']) {
                    $id_varian1 = $get_tipe['row'][0]->id;
                } else {
                    $tipe_varian                                       = [];
                    $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian1;
                    $tipe_varian['nama_list_tipe_varian']              = $get_data[$key]['list_warna'][$keya]['warna'];
                    $id_varian1                                        = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                }
                $stok = 0;
                foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                    // $data['file']['id_drive'] = 3;
                    // $data['file']['id_drive_folder'] = 100;
                    // $data['file']['storage'] = 'External';
                    // $data['file']['ref_database'] = 'inventaris__asset__list';
                    // $data['file']['path'] = $ukuran['gambar_besar'];
                    // $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                    // $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                    DB::table('inventaris__asset__list');
                    DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    DB::whereRaw("barcode='" . $ukuran['barcode'] . "'");
                    DB::whereRaw("id_brand=$id_subbrand");
                    $get_brand = DB::get('all');
                    if (! $get_brand['num_rows']) {
                        $data['file']                     = [];
                        $data['utama']                    = [];
                        $data['file']['id_drive']         = 3;
                        $data['file']['id_drive_folder']  = 100;
                        $data['file']['storage']          = 'External';
                        $data['file']['ref_database']     = 'inventaris__asset__list';
                        $data['file']['path']             = $ukuran['gambar_besar'];
                        $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                        $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');
                        if ($last_id_foto and $data['file']['path']) {
                            $gambar[] = $last_id_foto;
                        }

                        if (! $is_gambar and $last_id_foto and $data['file']['path']) {
                            $is_gambar = $last_id_foto;
                        }

                        $data['utama']['id_jenis_asset']        = 4;
                        $data['utama']['id_kategori']           = 2544;
                        $data['utama']['kode_barang']           = "";
                        $data['utama']['nama_barang']           = $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                        $data['utama']['barcode']               = $ukuran['barcode'];
                        $data['utama']['deskripsi_barang']      = $ukuran['keterangan'];
                        $data['utama']['berat']                 = $ukuran['berat'] * 1000;
                        $data['utama']['peruntukan']            = "Pria Wanita";
                        $data['utama']['jenis_barang']          = "Barang Jadi";
                        $data['utama']['kondisi']               = 1;
                        $data['utama']['harga_pokok_penjualan'] = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['harga_pokok']           = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['id_brand']              = $id_subbrand;
                        $data['utama']['is_master']             = 1;
                        $data['utama']['is_api']                = 1;
                        $data['utama']['id_api']                = $Get['row'][0]->id_api;
                        $data['utama']['foto_aset']             = $last_id_foto;
                        $data['utama']['varian_barang']         = 2;
                        $data['utama']['id_from_api']           = $ukuran['seq'];
                        $data['utama']['id_sync']               = 4;
                        $data['utama']['klasifikasi_produk']    = "Per Barang";

                        $data['utama']['asal_barang_dari'] = "Api";
                        $data['utama']['jual_barang']      = "0";
                        $last_id_varian                    = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                    } else {
                        $last_id_varian = $get_brand['row'][0]->id;
                        $gambar[]       = $get_brand['row'][0]->foto_aset;
                        if (! $is_gambar and $get_brand['row'][0]->foto_aset) {
                            $is_gambar = $get_brand['row'][0]->foto_aset;
                        }

                        $gambar[] = $get_brand['row'][0]->foto_aset;
                    }

                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Size'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Size";
                        $id_tipe_varian           = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian");
                    DB::whereRaw("nama_list_tipe_varian='" . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian;
                        $tipe_varian['nama_list_tipe_varian']              = $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                        $id_varian                                         = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }

                    $stok += $ukuran['stok'];
                    $varian                               = [];
                    $varian['id_inventaris__asset__list'] = $last_id_utama;
                    $varian['is_asset_list_varian']       = 1;
                    $varian['generate_asset_list']        = 1;
                    $varian['id_asset_list_varian']       = $last_id_varian;
                    $varian['id_tipe_varian_1']           = $id_tipe_varian1;
                    $varian['id_varian_1']                = $id_varian1;
                    $varian['id_tipe_varian_2']           = $id_tipe_varian;
                    $varian['id_varian_2']                = $id_varian;
                    $varian['asal_from_data_varian']      = 'Asset';
                    $varian['is_master_varian']           = 1;
                    CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                    $stok += $ukuran['stok'];
                }
            }
            $update_asset['foto_aset'] = $is_gambar;
            $update_asset['foto']      = implode(',', $gambar);
            CRUDFunc::crud_insert($fai, $page, $update_asset, [], 'inventaris__asset__list', ["id=$last_id_utama"], 'update');
            DB::table("store__produk");
            DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
            DB::whereRaw("id_master=$last_id_utama");
            DB::whereRaw('is_master=0');
            DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
            $get = DB::get('all');
            // echo '<pre>';
            // print_R($get);
            $dataReturn[] = [
                "nama_artikel" => $get_data[$key]['artikel'],
                "stok"         => $stok,
                "aksi"         => ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</button>"),
            ];
        }
        return $dataReturn;
    }

    public static function ethica_artikel($page, $id, $search)
    {
        //versi_1
        $return = '
            <table id="example1" class="table table-striped">
            <tr>
                <th>No</th>
                <th>Nama Artikel </th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
            ';
        $data  = ApiContent::get_artikel($page, $id, $search);
        $nomor = 0;
        foreach ($data as $row) {
            $nomor++;
            $return .=
                "<tr>
                            <td>$nomor</td>

                            <td>" . $row['nama_artikel'] . "</td>
                            <td>" . $row['stok'] . "</td>
                            <td>" . $row['aksi'] . "
                            </td>

                            </tr>
                            ";
        }

        $return .= '</table>';
        $return .= '<div class="card-footer">';
        $start            = Partial::input('offset') ? Partial::input('offset') : 0;
        $count            = count($data);
        if ($start) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start - $count) . ')">Prev</button>';
        }

        if ($count) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start + $count) . ')">Next</button>';
        }

        $return .= '</div>';
        $return .= '
       <script>
        function tambah_produk(this,last_id_utama){
        ' . "
        $.ajax({
					type: 'get',
					data: {
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            'not_sidebar': 'not',
                            'MainAll': 2,
                            'id':$id,
                            'type': 'produk_sync',
                            'last_id_utama': last_id_utama,
                            'searchsync': $('#input_search_sync').val(),
                        },
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                           //  $('#result_pencarian_sync').html(data);
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
							}
                    });
        " . '
        }
       </script>

        ';
        return $return;
    }
    public static function get_list_ethica_artikel_warna($page)
    {
        $search                = Partial::input('search');
        $return['data']['row'] = ApiContent::get_artikel_warna($page, 3, $search, 'data');
        return $return;
    }
    public static function get_artikel_warna($page, $id, $search)
    {
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get    = DB::get('all');
        $id_api = $Get['row'][0]->id_api;
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');

        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        $user_api = DB::get('all');
        $link     = $user_api['row'][0]->link_production;
        $link     = str_replace('{HTTPS}', 'https', $link);
        $link     = str_replace('{HTTP}', 'http', $link);
        if ($user_api['row'][0]->versi == 'Versi 2') {
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
            $apikey = EthicaApi::get_key_v2($cust_seq, $cotumer_id);
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
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
        }

        $start = Partial::input('offset') ? Partial::input('offset') : 0;
        $nomor = $start;
        if ($user_api['row'][0]->versi == 'Versi 2') {
            $array = ['Offset: ' . $start, 'key: ' . $apikey, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
            if ($search) {
                $array[] = 'search: ' . $search;
            }
            $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
            if ($get_data['status'] != 2) {
                if ($get_data['status_message'] == 'Invalid Authentication') {
                    unset($_SESSION['ethicaApi'][date('Y-m-d')]);
                    $apikey = EthicaApi::get_key_v2($cust_seq, $cotumer_id);
                    $array  = ['Offset: ' . 0, 'key: ' . $apikey, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
                    if ($search) {
                        $array[] = 'search: ' . $search;
                    }
                    $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
                }
            }
            $get_data = $get_data['data'];
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
            $get_data = json_decode(EthicaApi::get_produk($cust_seq, $search, $link), 1);
        }

        $count            = ($get_data);
        $page['db']['np'] = true;
        $fai              = new MainFaiFramework();
        $data             = [];
        foreach ($get_data as $key => $artikel) {
            DB::table('store__toko');
            DB::whereRaw("jenis_toko='Brand'");
            DB::whereRaw("nama_toko='" . $artikel['brand'] . "'");
            $get_brand = DB::get('all');
            if (! $get_brand['num_rows']) {
                $last_id  = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['brand'], "jenis_toko" => "Brand"], [], 'store__toko');
                $id_brand = $last_id;
            } else {
                $id_brand = $get_brand['row'][0]->id;
            }
            DB::table('store__toko');
            DB::whereRaw("jenis_toko='Brand'");
            DB::whereRaw("nama_toko='" . $artikel['sub_brand'] . "'");
            $get_brand = DB::get('all');
            if (! $get_brand['num_rows']) {
                $last_id     = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $artikel['sub_brand'], "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
                $id_subbrand = $last_id;
            } else {
                $id_subbrand = $get_brand['row'][0]->id;
            }

            foreach ($artikel['list_warna'] as $keya => $warna) {
                $gambar = [];
                DB::table('inventaris__asset__list');
                DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . "'");
                DB::whereRaw("id_api='" . $Get['row'][0]->id_api . "'");
                DB::whereRaw("id_sync=$id");
                $get_brand = DB::get('all');
                if (! $get_brand['num_rows']) {

                    $data['file']                    = [];
                    $data['utama']                   = [];
                    $data['utama']['id_jenis_asset'] = 4;
                    $data['utama']['id_kategori']    = 2544;
                    $data['utama']['kode_barang']    = "";
                    $data['utama']['nama_barang']    = $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'];
                    // $data['utama']['barcode'] = $ukuran['barcode'];
                    // $data['utama']['deskripsi_barang'] = $ukuran['keterangan'];
                    // $data['utama']['berat'] = $ukuran['berat'] * 1000;
                    $data['utama']['peruntukan']   = "Pria Wanita";
                    $data['utama']['jenis_barang'] = "Barang Jadi";
                    $data['utama']['kondisi']      = 1;
                    // $data['utama']['harga_pokok_penjualan'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                    // $data['utama']['harga_pokok'] = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']?$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']:$get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                    $data['utama']['id_brand']           = $id_subbrand;
                    $data['utama']['is_master']          = 1;
                    $data['utama']['is_api']             = 1;
                    $data['utama']['id_api']             = $Get['row'][0]->id_api;
                    $data['utama']['id_sync']            = $id;
                    $data['utama']['varian_barang']      = 1;
                    $data['utama']['klasifikasi_produk'] = $Get['row'][0]->nama_sync;

                    $data['utama']['id_sync']            = 4;
                    $data['utama']['klasifikasi_produk'] = "Per Barang";
                    $data['utama']['asal_barang_dari']   = "Api";
                    $data['utama']['jual_barang']        = "0";
                    $last_id_utama                       = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                } else {
                    $last_id_utama = $get_brand['row'][0]->id;
                }

                $nomor++;
                $stok      = 0;
                $is_gambar = "";
                $gambar[]  = "";
                foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                    $data['file']  = [];
                    $data['utama'] = [];
                    // $data['file']['id_drive'] = 3;
                    // $data['file']['id_drive_folder'] = 100;
                    // $data['file']['storage'] = 'External';
                    // $data['file']['ref_database'] = 'inventaris__asset__list';
                    // $data['file']['path'] = $ukuran['gambar_besar'] ? $ukuran['gambar_besar'] : $ukuran['gambar'];
                    // $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                    // $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                    DB::table('inventaris__asset__list');
                    DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    DB::whereRaw("barcode='" . $ukuran['barcode'] . "'");
                    DB::whereRaw("id_brand=$id_subbrand");
                    $get_brand = DB::get('all');
                    if (! $get_brand['num_rows']) {
                        $data['file']                     = [];
                        $data['utama']                    = [];
                        $data['file']['id_drive']         = 3;
                        $data['file']['id_drive_folder']  = 100;
                        $data['file']['storage']          = 'External';
                        $data['file']['ref_database']     = 'inventaris__asset__list';
                        $data['file']['path']             = $ukuran['gambar_besar'];
                        $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                        $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');
                        if (! $is_gambar and $last_id_foto and $data['file']['path']) {
                            $is_gambar = $last_id_foto;
                        }

                        if ($last_id_foto and $data['file']['path']) {
                            $gambar[] = $last_id_foto;
                        }

                        $data['utama']['id_jenis_asset']        = 4;
                        $data['utama']['id_kategori']           = 2544;
                        $data['utama']['kode_barang']           = "";
                        $data['utama']['nama_barang']           = $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                        $data['utama']['barcode']               = $ukuran['barcode'];
                        $data['utama']['deskripsi_barang']      = $ukuran['keterangan'];
                        $data['utama']['berat']                 = $ukuran['berat'] * 1000;
                        $data['utama']['peruntukan']            = "Pria Wanita";
                        $data['utama']['jenis_barang']          = "Barang Jadi";
                        $data['utama']['kondisi']               = 1;
                        $data['utama']['harga_pokok_penjualan'] = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['harga_pokok']           = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['id_brand']              = $id_subbrand;
                        $data['utama']['is_master']             = 1;
                        $data['utama']['is_api']                = 1;
                        $data['utama']['id_api']                = $Get['row'][0]->id_api;
                        $data['utama']['id_sync']               = $id;
                        $data['utama']['foto_aset']             = $last_id_foto;
                        $data['utama']['varian_barang']         = 2;
                        $data['utama']['id_from_api']           = $ukuran['seq'];
                        $data['utama']['klasifikasi_produk']    = $Get['row'][0]->nama_sync;

                        $data['utama']['asal_barang_dari'] = "Api";
                        $data['utama']['jual_barang']      = "0";
                        $last_id_varian                    = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                    } else {
                        $last_id_varian = $get_brand['row'][0]->id;
                        $gambar[]       = $get_brand['row'][0]->foto_aset;
                        if (! $is_gambar and $get_brand['row'][0]->foto_aset) {
                            $is_gambar = $get_brand['row'][0]->foto_aset;
                        }

                        $gambar[] = $get_brand['row'][0]->foto_aset;
                    }

                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Size'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian              = [];
                        $tipe_varian['nama_tipe'] = "Size";
                        $id_tipe_varian           = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian");
                    DB::whereRaw("nama_list_tipe_varian='" . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian                                       = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian;
                        $tipe_varian['nama_list_tipe_varian']              = $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                        $id_varian                                         = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }

                    $varian                               = [];
                    $varian['is_asset_list_varian']       = 1;
                    $varian['generate_asset_list']        = 1;
                    $varian['id_asset_list_varian']       = $last_id_varian;
                    $varian['id_tipe_varian_1']           = $id_tipe_varian;
                    $varian['id_varian_1']                = $id_varian;
                    $varian['id_inventaris__asset__list'] = $last_id_utama;
                    $varian['asal_from_data_varian']      = 'Asset';
                    $varian['is_master_varian']           = 1;
                    CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                    $stok += $ukuran['stok'];
                }

                $update_asset['foto_aset'] = $is_gambar;
                $update_asset['foto']      = implode(',', $gambar);
                CRUDFunc::crud_insert($fai, $page, $update_asset, [], 'inventaris__asset__list', ["id=$last_id_utama"], 'update');
                DB::table("store__produk");
                DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
                DB::whereRaw("id_master=$last_id_utama");
                DB::whereRaw('is_master=0');
                DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
                $get          = DB::get('all');
                $dataReturn[] = [
                    "barcode"      => $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['barcode'],
                    "nama_artikel" => $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'],
                    "stok"         => (isset($get_data[$key]['list_warna'][$keya]['stok']) ? $get_data[$key]['list_warna'][$keya]['stok'] : $stok),
                    "aksi"         => ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</a>"),
                ];
            }
        }
        return $dataReturn;
    }
    public static function ethica_artikel_warna($page, $id, $search)
    {
        //versi_1
        $return = '
            <table id="example1" class="table table-striped">
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Artikel Warna</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
            ';
        $data  = ApiContent::get_artikel_warna($page, $id, $search);
        $nomor = 0;
        foreach ($data as $row) {
            $nomor++;
            $return .=
                "<tr>
                            <td>$nomor</td>

                            <td>" . $row['barcode'] . "</td>
                            <td>" . $row['nama_artikel'] . "</td>
                            <td>" . $row['stok'] . "</td>
                            <td>" . $row['aksi'] . "
                            </td>

                            </tr>
                            ";
        }

        $return .= '</table>';
        $return .= '<div class="card-footer">';
        
        $start            = Partial::input('offset') ? Partial::input('offset') : 0;
        $count            = count($data);
        if ($start) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start - $count) . ')">Prev</button>';
        }

        if ($count) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start + $count) . ')">Next</button>';
        }

        $return .= '</div>';
        $return .= '
       <script>
        function tambah_produk(this,last_id_utama){
        ' . "
        $.ajax({
					type: 'get',
					data: {
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            'not_sidebar': 'not',
                            'MainAll': 2,
                            'id':$id,
                            'type': 'produk_sync',
                            'last_id_utama': last_id_utama,
                            'searchsync': $('#input_search_sync').val(),
                        },
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                           //  $('#result_pencarian_sync').html(data);
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
							}
                    });
        " . '
        }
       </script>

        ';
        return $return;
    }
    public static function get_list_ethica_barang($page)
    {
        $search                = Partial::input('search');
        $return['data']['row'] = ApiContent::get_barang($page, 1, $search, 'data');
        return $return;
    }
    public static function get_barang($page, $id, $search)
    {

        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on api_master__link.id = id_link');

        DB::whereRawPage($page, "api_master__sync.id=$id");
        $Get    = DB::get('all');
        $id_api = $Get['row'][0]->id_api;
        DB::selectRaw('*,api_master__user.id as primary_key');
        DB::table('api_master__user');
        DB::joinRaw('api_master__list__versi on api_master__list__versi.id = id_versi', 'left');

        DB::whereRawPage($page, "id_web__list_apps_board=ID_BOARD|");
        DB::whereRawPage($page, "id_api=$id_api");
        $user_api = DB::get('all');
        $link     = $user_api['row'][0]->link_production;
        $link     = str_replace('{HTTPS}', 'https', $link);
        $link     = str_replace('{HTTP}', 'http', $link);
        if ($user_api['row'][0]->versi == 'Versi 2') {
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
            $apikey = EthicaApi::get_key_v2($cust_seq, $cotumer_id);
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
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
        }

        $start = Partial::input('offset') ? Partial::input('offset') : 0;
        if ($user_api['row'][0]->versi == 'Versi 2') {
            $array = ['Offset: ' . $start, 'key: ' . $apikey, 'Cookie: PHPSESSID=2epb23rm5b3lt8f0jtb6ujdd05'];
            if ($search) {
                $array[] = 'search: ' . $search;
            }
            $get_data = json_decode(EthicaApi::get_produk_v2($link, $array), 1);
            $get_data = $get_data['data'];
        } else if ($user_api['row'][0]->versi == 'Versi 1') {
            $get_data = json_decode(EthicaApi::get_produk($cust_seq, $search, $link), 1);
        }
        $count            = count($get_data);
        $nomor            = 0;
        $page['db']['np'] = true;
        $fai              = new MainFaiFramework();
        $data             = [];
        foreach ($get_data as $key => $artikel) {
            foreach ($artikel['list_warna'] as $keya => $warna) {
                foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                    $nomor++;

                    DB::table('store__toko');
                    DB::whereRaw("jenis_toko='Brand'");
                    DB::whereRaw("nama_toko='" . $ukuran['brand'] . "'");
                    $get_brand = DB::get('all');
                    if (! $get_brand['num_rows']) {
                        $last_id  = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $ukuran['brand'], "jenis_toko" => "Brand"], [], 'store__toko');
                        $id_brand = $last_id;
                    } else {
                        $id_brand = $get_brand['row'][0]->id;
                    }
                    DB::table('store__toko');
                    DB::whereRaw("jenis_toko='Brand'");
                    DB::whereRaw("nama_toko='" . $ukuran['sub_brand'] . "'");
                    $get_brand = DB::get('all');
                    if (! $get_brand['num_rows']) {
                        $last_id     = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $ukuran['sub_brand'], "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
                        $id_subbrand = $last_id;
                    } else {
                        $id_subbrand = $get_brand['row'][0]->id;
                    }
                    DB::table('inventaris__asset__list');
                    DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    DB::whereRaw("barcode='" . $ukuran['barcode'] . "'");
                    DB::whereRaw("id_brand=$id_subbrand");
                    $get_brand = DB::get('all');
                    if (! $get_brand['num_rows']) {
                        $data['file']                     = [];
                        $data['utama']                    = [];
                        $data['file']['id_drive']         = 3;
                        $data['file']['id_drive_folder']  = 100;
                        $data['file']['storage']          = 'External';
                        $data['file']['ref_database']     = 'inventaris__asset__list';
                        $data['file']['path']             = $ukuran['gambar_besar'];
                        $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                        $last_id_foto                     = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                        $data['utama']['id_jenis_asset']        = 4;
                        $data['utama']['id_kategori']           = 2544;
                        $data['utama']['kode_barang']           = "";
                        $data['utama']['nama_barang']           = $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'];
                        $data['utama']['barcode']               = $ukuran['barcode'];
                        $data['utama']['deskripsi_barang']      = $ukuran['keterangan'];
                        $data['utama']['berat']                 = $ukuran['berat'] * 1000;
                        $data['utama']['peruntukan']            = "Pria Wanita";
                        $data['utama']['jenis_barang']          = "Barang Jadi";
                        $data['utama']['kondisi']               = 1;
                        $data['utama']['harga_pokok_penjualan'] = (isset($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual']) ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['harga_pokok']           = ($get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] ? $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga_jual'] : $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['harga']);
                        $data['utama']['id_brand']              = $id_subbrand;
                        $data['utama']['is_master']             = 1;
                        $data['utama']['is_api']                = 1;
                        $data['utama']['id_api']                = $Get['row'][0]->id_api;
                        $data['utama']['id_sync']               = $id;
                        $data['utama']['foto_aset']             = $last_id_foto;
                        $data['utama']['varian_barang']         = 2;
                        $data['utama']['id_from_api']           = $ukuran['seq'];
                        $data['utama']['klasifikasi_produk']    = $Get['row'][0]->nama_sync;

                        $data['utama']['asal_barang_dari'] = "Api";
                        $data['utama']['jual_barang']      = "0";
                        $last_id_utama                     = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                    } else {
                        $last_id_utama = $get_brand['row'][0]->id;
                    }
                    DB::table("store__produk");
                    DB::joinRaw("inventaris__asset__list on store__produk.id_asset=inventaris__asset__list.id");
                    DB::whereRaw("id_master=$last_id_utama");
                    DB::whereRaw('is_master=0');
                    DB::whereRawPage($page, 'store__produk.id_toko=WORKSPACE_SINGLE_TOKO|');
                    $get          = DB::get('all');
                    $dataReturn[] = [
                        "barcode"     => $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['barcode'],
                        "nama_barang" => $ukuran['nama'],
                        "stok"        => $ukuran['stok'],
                        "aksi"        => ($get['num_rows'] ? "Sudah Sync" : "<button onclick='tambah_produk(this,$last_id_utama)' class='btn btn-primary'>Tambah Produk</button>"),
                    ];
                }
            }
        }
        return $dataReturn;
    }
    public static function ethica_barang($page, $id, $search)
    {
        //versi_1
        $return = '
            <table id="example1" class="table table-striped">
            <tr>
                <th>No</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
            ';
        $data  = ApiContent::get_barang($page, $id, $search);
        $nomor = 0;
        foreach ($data as $row) {
            $nomor++;
            $return .=
                "<tr>
                            <td>$nomor</td>

                            <td>" . $row['barcode'] . "</td>
                            <td>" . $row['nama_barang'] . "</td>
                            <td>" . $row['stok'] . "</td>
                            <td>" . $row['aksi'] . "
                            </td>

                            </tr>
                            ";
        }

        $return .= '</table>';
        $return .= '<div class="card-footer">';
        
        $start            = Partial::input('offset') ? Partial::input('offset') : 0;
        $count            = count($data);
        if ($start) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start - $count) . ')">Prev</button>';
        }

        if ($count) {
            $return .= '<button type="button" class="btn btn-primary" onclick="cari_sync(' . ((int) $start + $count) . ')">Next</button>';
        }

        $return .= '</div>';
        $return .= '
       <script>
        function tambah_produk(this,last_id_utama){
        ' . "
        $.ajax({
					type: 'get',
					data: {
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            'not_sidebar': 'not',
                            'MainAll': 2,
                            'id':$id,
                            'type': 'produk_sync',
                            'last_id_utama': last_id_utama,
                            'searchsync': $('#input_search_sync').val(),
                        },
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                           //  $('#result_pencarian_sync').html(data);
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
							}
                    });
        " . '
        }
       </script>

        ';
        return $return;
    }
}
