<?php

require_once 'PaymentGatewayApp.php';
// require_once 'OngkirApp.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Xlsx;

class EcommerceApp
{
    public static function excel_produk($page, $type, $id, $limit = 1)
    {

        $fai         = new MainFaiFramework();
        $spreadsheet = new Spreadsheet;
        $sheet       = $spreadsheet->getActiveSheet();
        $y           = 0;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'No');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Nama Produk');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Varian');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'HPP');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'HPJ');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Harga Distributor');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Harga Jual Awal');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Harga Jual Akhir');
        $y++;
        $sheet->setCellValue($fai->toAlpha($y) . '1', 'Harga Mitra');
        $y++;
        DB::table('store__produk');
        DB::selectRaw('*');
        DB::selectRaw('store__produk.id as id_produk');
        DB::joinRaw('store__toko on store__toko.id = store__produk.id_toko');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset');
        if ($id) {
            DB::whereRaw("store__toko.apps_id = '$id'");
        }

        DB::whereRaw("inventaris__asset__list.jual_barang = 'Ya'");
        DB::limitRaw($page, $limit, ($limit * ($fai->input('page') ? $fai->input('page') : 0)));

        $produk = DB::get('all');
        $data   = EcommerceApp::get_data_detail($page, $produk, 'detail');
        $rows   = 1;
        for ($i = 1; $i <= count($data); $i++) {
            $rows++;
            $y = 0;
            $sheet->setCellValue($fai->toAlpha($y) . $rows, ($rows - 1));
            $y++;
            $sheet->setCellValue($fai->toAlpha($y) . $rows, $data[$i]['nama_produk']);
            $y++;
            if ($data[$i]['is_varian_produk'] == 'Tidak') {
                $sheet->setCellValue($fai->toAlpha($y) . $rows, $data[$i]['hpp']);
                $y++;
                $sheet->setCellValue($fai->toAlpha($y) . $rows, $data[$i]['hpj']);
                $y++;
            }
        }
        echo '<pre>';
        print_r($data);
        die;

        $type = 'xls';
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }
        $fileName = 'Excel Produk' . "." . $type;
        $writer->save("export/" . $fileName);
        // print_r($fileName);die;
        header("Content-Type: application/vnd.ms-excel");
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false); // required for certain browsers 
        //header('Content-Type: application/pdf');

        header('Content-Disposition: attachment; filename="' . basename($fileName) . '";');
        header('Content-Transfer-Encoding: binary');
        //header('Content-Length: ' . filesize($fileName));

        readfile("export/" . $fileName);
    }
    public static function clearance_produk($page, $id_produk)
    {
        DB::selectRaw("inventaris__asset__list.id,
        inventaris__asset__list.asal_barang_dari,
        inventaris__asset__list.id_master,
        inventaris__asset__list.varian_barang,
       master.nama_barang as master_nama_barang,
        inventaris__asset__list.nama_barang as nama_barang,
        api_master__sync.function_execution,
        master_sync.function_execution as msfe,
        master.id_sync as master_sync_id,
        inventaris__asset__list.id_sync,
        store__produk.status_clearance
        ");
        DB::table('store__produk');
        DB::joinRaw("inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset", 'left');
        DB::joinRaw("inventaris__asset__list master on master.id = inventaris__asset__list.id_master", 'left');
        DB::joinRaw("api_master__sync  on api_master__sync.id = inventaris__asset__list.id_sync", 'left');
        DB::joinRaw("api_master__sync master_sync on master_sync.id = master.id_sync", 'left');

        DB::whereRaw("store__produk.id = $id_produk");

        $produk = DB::get('all');
        // echo $produk['query'];
        $stok = 0;
        if ($produk['num_rows']) {

            $id_gudang_temp       = "";
            $id_ruang_simpan_temp = "";

            foreach ($produk['row'] as $row) {
                if (! $row->status_clearance) {

                    $func            = $row->msfe ? $row->msfe : $row->function_execution;
                    $_POST['offset'] = 0;
                    ApiContent::$func($page, ($row->master_sync_id ? $row->master_sync_id : $row->id_sync), ($row->master_nama_barang ? $row->master_nama_barang : $row->nama_barang),);
                    $_POST['offset'] = 30;
                    ApiContent::$func($page, ($row->master_sync_id ? $row->master_sync_id : $row->id_sync), ($row->master_nama_barang ? $row->master_nama_barang : $row->nama_barang),);

                    $_POST['offset'] = 60;
                    ApiContent::$func($page, ($row->master_sync_id ? $row->master_sync_id : $row->id_sync), ($row->master_nama_barang ? $row->master_nama_barang : $row->nama_barang),);

                    //    print_R($row);
                    //    echo $id_produk;
                    $response = ApiContent::produk_sync($page, ($row->master_sync_id ? $row->master_sync_id : $row->id_sync), $row->id_master);
                    if ($response['total'] >= 1) {
                        DB::select("update store__produk  set status_clearance=1 where id=$id_produk");
                        DB::update('store__produk', ["status_clearance" => 1], ["id=$id_produk "]);
                    }
                    echo json_encode($response);
                }
            }
        }
    }
    public static function sync_update_stok($page, $id_produk, $id_asset = "", $id_asset_varian = "", $type = "")
    {
        $fai = new MainFaiFramework();
        DB::selectRaw("inventaris__asset__list__varian.id,
                        inventaris__asset__list.asal_barang_dari,
                        inventaris__asset__list.id_master,
                        inventaris__asset__list.varian_barang,
                        inventaris__asset__list__varian.id as id_varian_utama,
                        inventaris__asset__list__varian.asal_from_data_varian,
                        inventaris__asset__list__varian.id_asset_list_varian,
                        inventaris__asset__list__varian.id_master_varian,
                        inventaris__asset__list__varian.id_master_varian,
                        master.asal_from_data_varian as asal_from_data_varian_master,
                        master.id_asset_list_varian as id_asset_list_varian_master,
                        master.id_master_varian as id_master_varian_master,
                        master_varian_asset.asal_barang_dari as asal_barang_dari_master_varian,
                        master_varian_asset.id_api as id_api_master_varian_asset,
                        master_varian_asset.id_from_api as id_from_api_master_varian_asset,
                        master_varian_asset.id_sync as id_sync_master_varian_asset,
                        case when
                            master.asal_from_data_varian ='Asset' then master_varian_asset.nama_barang
                        end as nama_barang,
                        store__produk__varian.id as id_produk_varian,
                        store__produk.id_asset,
						masterutama.nama_barang as nama_barang_utama,
                        function_cek_stok
                        ");
        DB::table('store__produk');
        DB::joinRaw("inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset", 'left');
        DB::joinRaw("inventaris__asset__list masterutama on masterutama.id = inventaris__asset__list.id_master", 'left');
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id = inventaris__asset__list__varian.id_inventaris__asset__list", 'left');
        DB::joinRaw("store__produk__varian on inventaris__asset__list__varian.id = store__produk__varian.id_barang_varian and store__produk.id = store__produk__varian.id_store__produk ", 'left');
        DB::joinRaw("inventaris__asset__list__varian as master on master.id = inventaris__asset__list__varian.id_master_varian", 'left');
        DB::joinRaw("inventaris__asset__list as master_varian_asset  on master_varian_asset.id =
        case
        when inventaris__asset__list__varian.asal_from_data_varian ='Master'
        then master.id_asset_list_varian
        else  inventaris__asset__list__varian.id

        end ", 'left');
        DB::joinRaw("api_master__list on api_master__list.id = master_varian_asset.id_api", 'left');
        DB::whereRaw("store__produk.id = $id_produk");
        if ($id_asset) {
            DB::whereRaw("inventaris__asset__list.id = $id_asset");
        }

        if ($id_asset_varian) {
            DB::whereRaw("inventaris__asset__list__varian.id = $id_asset_varian");
        }

        $produk = DB::get('all');
        // echo $produk['query'];
        $stok = 0;
        if ($produk['num_rows']) {

            $id_gudang_temp       = "";
            $id_ruang_simpan_temp = "";
            $all_stok_api         = [];
            $is_all_stok          = false;
            // $dirPath = "FaiFramework/Pages/json/all_produk/";
            // $filePath = $dirPath . "all_produk.json";
            // $json = file_get_contents($filePath);
            // $array = json_decode($json, true);
            foreach ($produk['row'] as $row) {
                $function = $row->function_cek_stok;
                DB::table('api_master__sync');
                DB::joinRaw('api_master__link on api_master__link.id = id_link');
                DB::joinRaw('api_master__list on api_master__list.id = id_api');

                DB::whereRawPage($page, "api_master__sync.id=$row->id_sync_master_varian_asset");
                $Get = DB::get('all');
                if ($id_gudang_temp != $Get['row'][0]->id_gudang and $id_ruang_simpan_temp != $Get['row'][0]->id_ruang_simpan) {

                    // $function                          = $Get['row'][0]->function_cek_stok;
                    $id_api                            = $Get['row'][0]->id_api;
                    $class                             = $Get['row'][0]->nama_class;
                    $so['tanggal_stok_opname']         = date('Y-m-d');
                    $so['nomor_stok_opname']           = "";
                    $so['id_gudang_stok_opname']       = $id_gudang       = $Get['row'][0]->id_gudang;
                    $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;
                    $last_id                           = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
                    $id_gudang_temp                    = $Get['row'][0]->id_gudang;
                    $id_ruang_simpan_temp              = $Get['row'][0]->id_ruang_simpan;
                }

                if ($row->asal_barang_dari_master_varian == 'Api' or $row->asal_from_data_varian_master == 'Api' or $row->asal_barang_dari == 'Api') {

                    if ($row->asal_from_data_varian_master == 'Asset' and $row->id_asset_list_varian_master and $row->asal_barang_dari_master_varian == 'Api') {

                        $id_api      = $row->id_api_master_varian_asset;
                        $id_from_api = $row->id_from_api_master_varian_asset;
                        //echo '<br>'.$row->nama_barang.'=';
                        // if (! $is_all_stok) {

                        //     $key      = EthicaApi::get_key_v2("816625", "25231b80-f006-11ef-ad5b-bc2411f62480", $force_api = 0);
                        //     $search   = strtoupper(trim(str_replace("%20", " ", $row->nama_barang_utama)));
                        //     $search   = str_replace("  ", " ", $search);
                        //     $get_data = EthicaApi::get_produk_v2([], [
                        //         'key: ' . $key,
                        //         'order_by: tgl_realease desc',
                        //         'customer_seq: 8190',
                        //         'seq: ' . $id_from_api,
                        //         'offset: 0',
                        //         // 'search: ' . $search,
                        //         'limit:100',
                        //     ]);
                        //     // + barang
                        //     $get_data = json_decode($get_data, 1)['data'];

                        //     if (($get_data)) {
                        //         foreach ($get_data as $key => $artikel) {
                        //             foreach ($artikel['list_warna'] as $keya => $warna) {
                        //                 foreach ($warna['list_ukuran'] as $keyw => $ukuran) {

                        //                     // "stok" => $get_barang['stok'];
                        //                     // "nama" => $get_barang['nama'],
                        //                     $ukuran['nama'];
                        //                     $get_stokAll                   = $ukuran['stok'];
                        //                     $all_stok_api[$ukuran['nama']] = $get_stokAll;

                        //                 }
                        //             }
                        //         }
                        //     }
                        //     $is_all_stok = true;
                        // }
                        // if ($is_all_stok) {
                        $row->nama_barang_utama;
                        $function;
                        if (isset($all_stok_api[$row->nama_barang])) {
                            $get_stok = $all_stok_api[$row->nama_barang];
                        } else {
                            $stok_api = ApiContent::$function($page, $row->id_sync_master_varian_asset, $id_api, $row, ($stok_api['detail'] ?? []));

                            $get_stok                        = $stok_api['stok'];
                            $all_stok_api[$row->nama_barang] = $get_stok;
                        }
                        //echo 'after:' . $get_stok;
                        // }
                        //print_R($all_stok_api);
                        //echo ''.$get_stok;
                        $id_barang       = $row->id_asset_list_varian_master;
                        $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $id_barang, 'rekap_akhir');
                        //     echo '<br>';
                        //  echo '<br>';
                        //  echo $id_barang;
                        //  echo $row->nama_barang;
                        //  echo '<br>';
                        //  echo $row->nama_varian;

                        if ($get_system_stok['num_rows']) {
                            $get_system_stok = $get_system_stok['row'][0]->stok;
                        } else {
                            $get_system_stok = 0;
                        }
                        $detail['id_asset']                 = $row->id_asset_list_varian_master;
                        $detail['data_stok']                = (int) $get_system_stok;
                        $detail['data_real']                = (int) $get_stok;
                        $detail['selisih']                  = (int) $get_stok - $get_system_stok;
                        $detail['id_erp__pos__stok_opname'] = $last_id;
                        //  print_R($detail);
                        $stok += $get_stok;
                        if ($detail['selisih']) {
                            CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                        }

                        // $storage                     = [];
                        // $storage['id_gudang']        = $id_gudang;
                        // $storage['id_ruang_simpan']  = $id_ruang_simpan;
                        // $storage['id_asset']         = $row->id_asset;
                        // $storage['id_produk']        = $id_produk;
                        // $storage['id_asset_varian']  = $row->id_varian_utama;
                        // $storage['id_produk_varian'] = $row->id_produk_varian;

                        // DB::table('inventaris__storage__data');
                        // foreach ($storage as $key => $value) {

                        //     DB::whereRaw("$key = $value");
                        // }
                        // $get_storage = DB::get('all');

                        // if ($get_storage['num_rows']) {
                        //     $storage['stok_onhand']    = $get_stok;
                        //     $storage['stok_available'] = (int) $get_stok - (int) ($get_storage['row'][0]->stok_reserved);
                        //     CRUDFunc::crud_update($fai, $page, $storage, [], [], [], 'inventaris__storage__data', 'id', $get_storage['row'][0]->id);

                        //     $id_storage = $get_storage['row'][0]->id;
                        // } else {
                        //     $storage['stok_onhand']      = $get_stok;
                        //     $storage['stok_available']   = $get_stok;
                        //     $storage['connect_api_name'] = $row->nama_barang;
                        //     //$storage['connect_api_id'] = $row->id_from_api;
                        //     $id_storage = CRUDFunc::crud_insert($fai, $page, $storage, [], 'inventaris__storage__data');
                        // }
                        // DB::table('inventaris__storage__data');
                        // DB::whereRaw("id_gudang = $id_gudang");
                        // DB::whereRaw("id_ruang_simpan = $id_ruang_simpan");
                        // DB::whereRaw("connect_api_name = '$row->nama_barang'");
                        // $get_storageAll = DB::get('all');

                        // foreach ($get_storageAll['row'] as $all) {
                        //     $storageAll['stok_onhand']    = $get_stok;
                        //     $storageAll['stok_available'] = $get_stok - (int) ($all->stok_reserved);
                        //     CRUDFunc::crud_update($fai, $page, $storageAll, [], [], [], 'inventaris__storage__data', 'connect_api_name', "'$row->nama_barang'");
                        // }
                    }
                }
            }
        }
        // $body['db']                  = "all_produk";
        // $body['search']['id_produk'] = $id_produk;
        // $body['search']['id_search'] = $id_produk;
        // ApiApp::db_json_bundle($page, $body);

        /*DB::table("inventaris__storage__data");
        DB::selectRaw("sum(coalesce(stok_available,0)) as stok");
        //DB::joinRaw("store__produk as p on p.id = inventaris__storage__data.id_produk", 'left');

        //DB::whereRaw("inventaris__storage__data.id_gudang in 
		//(select store__toko__gudang.id_gudang from store__toko__gudang where p.id_toko = store__toko__gudang.id_store__toko)");
        DB::whereRaw("inventaris__storage__data.id_produk = $id_produk");
        if ($id_asset)
            DB::whereRaw("inventaris__storage__data.id_asset = $id_asset");
        if ($id_asset_varian)
            DB::whereRaw("inventaris__storage__data.id_asset_varian = $id_asset_varian");
        DB::groupByRaw($page,["connect_api_name"]);
        $get = DB::get("all");
	   
		if ($get['num_rows']) {

            return $get['row'][0]->stok;
        } else {
            return 0;
        }
       */
        $stok;
        return $stok;
    }
    public static function sync_cart($page, $id_group_pesanan)
    {
        $db['select'][] = "
                    erp__pos__utama.id as id_erp__pos__utama,
                    erp__pos__utama.id_erp__pos__group,
                    erp__pos__utama__detail.id as id_detail
                    , erp__pos__utama__detail.qty_pesanan
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
                    ,erp__pos__utama.id_apps_user as id_user
                    ";
        $db['utama']   = "erp__pos__utama__detail";
        $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
        $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian"];
        $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama"];
        $db['where'][] = ["erp__pos__utama.id_erp__pos__group", "=", "$id_group_pesanan"];
        $get           = Database::database_coverter($page, $db, [], 'all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {

                if ($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') {
                    ApiContent::send_cart($page, $row->id_detail, $row->id_api_varian, $row->id_from_api_varian, $row->qty_pesanan, $row->id_user);
                } else if ($row->asal_barang_dari == 'Api') {
                    ApiContent::send_cart($page, $row->id_detail, $row->id_api, $row->id_from_api, $row->qty_pesanan, $row->id_user);
                }
            }
        }
    }
    public static function router() {}
    public static function diferent_value_id_apps($id_store_priduk)
    {
        if ($id_store_priduk) {

            $id_apps = Partial::random(12);
            DB::table('store__produk');
            DB::whereRaw("store__produk.id_apps_store_produk='$id_apps'");
            $count = DB::get('all');
            if ($count['num_rows']) {
                return EcommerceApp::diferent_value_id_apps($id_store_priduk);
            } else {
                DB::select("update store__produk  set id_apps_store_produk='$id_apps' where id=$id_store_priduk");
                return $id_apps;
            }
        } else {
            return null;
        }
    }
    public static function get_data_detail($page, $result_database, $type_result = 'simple')
    {
        $i                      = 0;
        $diferent_value_id_apps = function () {};
        if ($result_database['num_rows']) {
            foreach ($result_database['row'] as $produk) {
                $i++;
                foreach ($produk as $Key => $value) {

                    $data[$i][$Key] = $value;
                }
                if (! $produk->id_apps_store_produk) {
                    $produk->id_apps_store_produk = EcommerceApp::diferent_value_id_apps($produk->id_store_priduk);
                }
                $data[$i]['id_apps']     = $produk->id_apps_store_produk;
                $data[$i]['nama_produk'] = $produk->nama_barang;
                $data[$i]['deskripsi']   = $produk->deskripsi_barang;

                $harga_min_max = EcommerceApp::get_data_harga($page, '', '', 'min_max', $produk->id_produk, 'Ya', 1);

                $data[$i]['harga_jual']       = $harga_min_max['Min Max Harga Jual Awal'];
                $data[$i]['is_varian_produk'] = $produk->varian_barang == 1 ? 'Ya' : 'Tidak';

                if ($produk->varian_barang == 1) {
                    // DB::selectRaw('*');
                    // DB::selectRaw('store__produk__varian.id as id_varian');
                    // DB::table('inventaris__asset__list__varian');
                    // DB::joinRaw('store__produk__varian on store__produk__varian.id_barang_varian = inventaris__asset__list__varian.id');
                    // DB::whereRaw("inventaris__asset__list__varian.id_inventaris__asset__list = $produk->id_asset");
                    // DB::whereRaw("store__produk__varian.id_store__produk = $produk->id_produk");
                    $db_varian['select'][] = "*,store__produk__varian.id as id_varian,inventaris__asset__list__varian.*";
                    $db_varian['utama']    = "inventaris__asset__list__varian";
                    $db_varian['join'][]   = ["store__produk__varian", "store__produk__varian.id_barang_varian", "inventaris__asset__list__varian.id"];
                    $db_varian['where'][]  = ["inventaris__asset__list__varian.id_inventaris__asset__list", "=", "$produk->id_asset"];
                    $db_varian['where'][]  = ["store__produk__varian.id_store__produk", "=", "$produk->id_produk"];
                    // $varian = DB::get('all');
                    $varian = Database::database_coverter($page, $db_varian, [], 'all');
                    $j      = 0;
                    if ($varian['num_rows']) {
                        foreach ($varian['row'] as $varian) {
                            $j++;

                            $data[$i]['varian'][$j]['nama_varian']      = $varian->nama_varian;
                            $data[$i]['varian'][$j]['sku_index_varian'] = $varian->sku_index_varian;
                            $data[$i]['varian'][$j]['barcode_varian']   = $varian->barcode_varian;
                            $data[$i]['varian'][$j]['berat_varian']     = $varian->berat_varian;
                            $data[$i]['varian'][$j]['id_tipe_varian_1'] = $varian->id_tipe_varian_1;
                            $data[$i]['varian'][$j]['id_tipe_varian_2'] = $varian->id_tipe_varian_2;
                            $data[$i]['varian'][$j]['id_tipe_varian_3'] = $varian->id_tipe_varian_3;
                            $data[$i]['varian'][$j]['id_varian_1']      = $varian->id_varian_1;
                            $data[$i]['varian'][$j]['id_varian_2']      = $varian->id_varian_2;
                            $data[$i]['varian'][$j]['id_varian_3']      = $varian->id_varian_3;
                            $data[$i]['list_varian']["tipe_1"]          = $varian->nama_tipe_inventaris__master__tipe_varian_id_tipe_varian_1;
                            $data[$i]['list_varian']["tipe_2"]          = $varian->nama_tipe_inventaris__master__tipe_varian_id_tipe_varian_2;
                            $data[$i]['list_varian']["tipe_3"]          = $varian->nama_tipe_inventaris__master__tipe_varian_id_tipe_varian_3;
                            if ($varian->id_varian_2) {
                                DB::table('inventaris__master__tipe_varian__list');
                                DB::whereRaw("id = $varian->id_varian_1");
                                $varian_list1 = DB::get('all');
                            } else {
                                $varian_list1['num_rows'] = 0;
                            }
                            if ($varian->id_varian_2) {

                                DB::table('inventaris__master__tipe_varian__list');
                                DB::whereRaw("id = $varian->id_varian_2");
                                $varian_list2 = DB::get('all');
                            } else {
                                $varian_list2['num_rows'] = 0;
                            }
                            if ($varian->id_varian_3) {
                                DB::table('inventaris__master__tipe_varian__list');
                                DB::whereRaw("id = $varian->id_varian_3");
                                $varian_list3 = DB::get('all');
                            } else {
                                $varian_list3['num_rows'] = 0;
                            }

                            $data[$i]['varian'][$j]['nama_list_tipe_varian_1'] = $varian_list1['row'][0]->nama_list_tipe_varian ?? '';
                            $data[$i]['varian'][$j]['nama_list_tipe_varian_2'] = $varian_list2['row'][0]->nama_list_tipe_varian ?? '';
                            $data[$i]['varian'][$j]['nama_list_tipe_varian_3'] = $varian_list3['row'][0]->nama_list_tipe_varian ?? '';

                            $harga = EcommerceApp::get_data_harga($page, '', '', 'all', $produk->id_produk, 'Ya', 1, $varian->id_varian);
                            if ($type_result == 'detail') {
                                $data[$i]['varian'][$j]['hpp']               = $harga['hpj'];
                                $data[$i]['varian'][$j]['hpj']               = $harga['hpj'];
                                $data[$i]['varian'][$j]['harga_distributor'] = $harga['harga_distributor'];
                            }
                            $data[$i]['varian'][$j]['harga_jual']        = $harga['Harga Jual'];
                            $data[$i]['varian'][$j]['harga_diskon_toko'] = $harga['harga_diskon_toko'];
                            $data[$i]['varian'][$j]['harga_diskon_user'] = $harga['harga_diskon_user'];
                            $data[$i]['varian'][$j]['harga_jual_akhir']  = $harga['harga_akhir_tanpa_mitra'];
                            DB::table('drive__file');
                            DB::whereRaw("drive__file.id=$varian->foto_aset_varian");
                            $file = DB::get('all');
                            $k    = 0;
                            if ($file['num_rows']) {
                                foreach ($file['row'] as $file) {
                                    $k++;
                                    $data[$i]['varian'][$j]['gambar_produk_varian'][$k] = Partial::url_file($file);
                                }
                            }
                            // $data[$i]['varian'][$j]['harga_mitra'] =  $harga['harga_mitra'];
                            $data[$i]['list_varian_detail']['all'][$data[$i]['varian'][$j]['nama_list_tipe_varian_1']][$data[$i]['varian'][$j]['nama_list_tipe_varian_2']][$data[$i]['varian'][$j]['nama_list_tipe_varian_3']] = $data[$i]['varian'][$j];
                            if (! isset($data[$i]['list_varian']['tipe_1'])) {
                                $data[$i]['list_varian']['tipe_1']['detail'] = [];
                            }

                            if (! isset($data[$i]['list_varian']['tipe_2'])) {
                                $data[$i]['list_varian']['tipe_2']['detail'] = [];
                            }

                            if (! isset($data[$i]['list_varian']['tipe_3'])) {
                                $data[$i]['list_varian']['tipe_3']['detail'] = [];
                            }

                            if (! in_array($data[$i]['varian'][$j]['nama_list_tipe_varian_1'], $data[$i]['list_varian']['tipe_1'])) {
                                $data[$i]['list_varian']['tipe_1']['detail'][] = ["nama_varian" => $data[$i]['varian'][$j]['nama_list_tipe_varian_1'], "id_varian" => $varian->id_varian_1, "level" => 1];
                            }

                            if (! in_array($data[$i]['varian'][$j]['nama_list_tipe_varian_2'], $data[$i]['list_varian']['tipe_2'])) {
                                $data[$i]['list_varian']['tipe_2']['detail'][] = ["nama_varian" => $data[$i]['varian'][$j]['nama_list_tipe_varian_2'], "id_varian" => $varian->id_varian_2, "level" => 2];
                            }

                            if (! in_array($data[$i]['varian'][$j]['nama_list_tipe_varian_3'], $data[$i]['list_varian']['tipe_3'])) {
                                $data[$i]['list_varian']['tipe_3']['detail'][] = ["nama_varian" => $data[$i]['varian'][$j]['nama_list_tipe_varian_3'], "id_varian" => $varian->id_varian_3, "level" => 3];
                            }
                        }
                    }
                } else {
                    $harga = EcommerceApp::get_data_harga($page, '', '', 'all', $produk->id_produk, 'Ya', 1);
                    if ($type_result == 'detail') {
                        $data[$i]['hpp']               = $harga['hpj'];
                        $data[$i]['hpj']               = $harga['hpj'];
                        $data[$i]['harga_distributor'] = $harga['harga_distributor'];
                    }
                    $data[$i]['harga_diskon_toko']      = $harga['harga_diskon_toko'];
                    $data[$i]['persentase_diskon_toko'] = $harga['diskon_toko'];
                    $data[$i]['harga_diskon_user']      = $harga['harga_diskon_user'];
                    $data[$i]['persentase_diskon_user'] = $harga['diskon_user'];
                    $data[$i]['harga_jual_akhir']       = $harga['harga_akhir_tanpa_mitra'];
                    $data[$i]['harga_mitra']            = $harga['harga_mitra'];
                }
            }
        } else {
            $data['massage'] = "Tidak ada data";
        }
        return $data;
    }
    public static function bundle_harga($page, $id_bundle_harga, $hpj)
    {


        DB::table('store__bundle_harga__detail');
        DB::joinRaw('store__bundle_harga on store__bundle_harga.id = id_store__bundle_harga');
        DB::whereRaw("id_store__bundle_harga = $id_bundle_harga");
        DB::whereRaw("$hpj >= minimal_total_hpj_distributor and ($hpj<=maksimal_total_hpj_distributor or maksimal_total_hpj_distributor is null or maksimal_total_hpj_distributor=0)");

        $bundle = DB::get('all');
        if ($bundle['num_rows']) {
            foreach ($bundle['row'][0] as $key => $value) {
                $return[$key] = $value;
            }
            if ($bundle['row'][0]->tipe_margin_harga_distributor == '%') {
                $distributor = $hpj * (float) $bundle['row'][0]->margin_distibutor / 100;
            } else {
                $distributor = (float) $bundle['row'][0]->margin_distibutor;
            }
            if ($bundle['row'][0]->tipe_selisih_harga_distributor == '+') {
                $harga_distributor = $hpj + $distributor;
            } else {
                $harga_distributor = $hpj - $distributor;
            }
            $return['Selisih Distributor'] = $distributor;
            $return['harga_distributor']   = $harga_distributor;
            if ($bundle['row'][0]->tipe_harga_jual == '%') {
                $harga_jual = $harga_distributor * (float) $bundle['row'][0]->margin_harga_jual / 100;
            } else {
                $harga_jual = (float) $bundle['row'][0]->margin_harga_jual;
            }
            if ($bundle['row'][0]->tipe_selisih_harga_jual == '+') {
                $harga_harga_jual = $harga_distributor + $harga_jual;
            } else {
                $harga_harga_jual = $harga_distributor - $harga_jual;
            }

            $return['Selisih Harga Jual'] = $harga_jual;
            $return['Harga Jual']         = $harga_harga_jual;
            $return['selisih_harga_jual'] = $harga_jual;
            $return['harga_jual']         = $harga_harga_jual;

            if ($bundle['row'][0]->tipe_platform == '%') {
                $platform = $harga_harga_jual * (float) $bundle['row'][0]->margin_platform / 100;
            } else {
                $platform = (float) $bundle['row'][0]->margin_platform;
            }
            if ($bundle['row'][0]->tipe_selisih_platform == '+') {
                $harga_platfom = $harga_harga_jual + $platform;
            } else {
                $harga_platfom = $harga_harga_jual - $platform;
            }
            $return['selisih_harga_platform'] = $platform;
            $return['harga_platform']         = $harga_platfom;

            $return['donasi_baitul_mal']      = $bundle['row'][0]->donasi_baitul_mal;
            $return['tipe_donasi_baitul_mal'] = $bundle['row'][0]->tipe_donasi;
        } else {
            $return['Selisih Distributor'] = 0;
            $return['harga_distributor']   = 0;
            $return['Selisih Harga Jual']  = 0;
            $return['Harga Jual']          = $hpj;
            $return['selisih_harga_jual']  = 0;
            $return['harga_jual']          = $hpj;

            $return['selisih_harga_platform'] = 0;
            $return['harga_platform']         = 0;

            $return['donasi_baitul_mal']      = 0;
            $return['tipe_donasi_baitul_mal'] = 'Rp';
        }

        return $return;
    }
    public static function get_data_harga_promo($jual_awal, $promo, $return, $jumlah = 1)
    {
        $jual_akhir_temp         = $jual_awal * $jumlah;
        $jual_akhir              = $jual_awal * $jumlah;
        $diskon_toko             = 0;
        $harga_diskon_toko       = 0;
        $harga_diskon_toko_total = 0;
        $list_potongan           = [];

        if (count($promo['toko']['aktif'])) {
            for ($t = 1; $t <= count($promo['toko']['aktif']); $t++) {
                $diskon_toko = $promo['toko']['aktif'][$t]['margin_promo_toko'];
                if ($promo['toko']['aktif'][$t]['tipe_margin_promo_toko'] == '%') {
                    $harga_diskon_toko = ($diskon_toko / 100 * $jual_akhir_temp);
                } else {
                    $harga_diskon_toko = $diskon_toko * $jumlah;
                }

                if ($harga_diskon_toko > $promo['toko']['aktif'][$t]['maksimal_margin']) {
                    $harga_diskon_toko = $promo['toko']['aktif'][$t]['maksimal_margin'];
                }
                if (isset($return['limit_diskon'])) {

                    if (($jual_akhir_temp - $harga_diskon_toko) < ($return[strtolower($return['limit_diskon_dari'])] + $return['limit_diskon'])) {
                        //harga mitra adalah harga minimum
                        $harga_limit = $return[strtolower($return['limit_diskon_dari'])];
                        $harga_limit += $return['limit_diskon'];

                        $return['harga_limit_toko'] = $harga_limit;
                        $pengurang                  = $jual_akhir_temp - $harga_diskon_toko - $harga_limit;
                        $harga_diskon_toko += $pengurang;
                    }
                }

                $gc                                      = count($list_potongan);
                $list_potongan[$gc]['kode_promo']        = $promo['toko']['aktif'][$t]['kode_promo'];
                $list_potongan[$gc]['nama_promo']        = $promo['toko']['aktif'][$t]['nama_promo'];
                $list_potongan[$gc]['margin_promo']      = $promo['toko']['aktif'][$t]['margin_promo_toko'];
                $list_potongan[$gc]['tipe_margin_promo'] = $promo['toko']['aktif'][$t]['tipe_margin_promo_toko'];
                $list_potongan[$gc]['maksimal_margin']   = $promo['toko']['aktif'][$t]['maksimal_margin'];
                $list_potongan[$gc]['primary_key']       = $promo['toko']['aktif'][$t]['primary_key'];
                $list_potongan[$gc]['informasi']         = $promo['toko']['aktif'][$t]['informasi'];
                $list_potongan[$gc]['harga_jual_diskon'] = $jual_akhir_temp;
                $list_potongan[$gc]['harga_diskon']      = $harga_diskon_toko;
                $list_potongan[$gc]['jenis']             = "Toko";

                $jual_akhir -= $harga_diskon_toko;
                $harga_diskon_toko_total += $harga_diskon_toko;
            }
        }
        $diskon_user             = 0;
        $harga_diskon_user       = 0;
        $harga_diskon_user_total = 0;
        if (count($promo['user']['aktif'])) {
            for ($t = 1; $t <= count($promo['user']['aktif']); $t++) {
                $diskon_user = $promo['user']['aktif'][$t]['margin_promo_user'];
                if ($promo['user']['aktif'][$t]['tipe_margin_promo_user'] == '%') {
                    $harga_diskon_user = ($diskon_user / 100 * $jual_akhir_temp);
                } else {
                    $harga_diskon_user = $diskon_user * $jumlah;
                }

                if ($harga_diskon_user > $promo['user']['aktif'][$t]['maksimal_margin']) {
                    $harga_diskon_user = $promo['user']['aktif'][$t]['maksimal_margin'];
                }
                if (($jual_akhir_temp - $harga_diskon_user) < ($return[strtolower($return['limit_diskon_dari'])] + $return['limit_diskon'])) {
                    //harga mitra adalah harga minimum
                    $harga_limit = $return[strtolower($return['limit_diskon_dari'])];
                    $harga_limit += $return['limit_diskon'];

                    $return['harga_limit_user'] = $harga_limit;
                    $pengurang                  = $jual_akhir_temp - $harga_diskon_user - $harga_limit;
                    $harga_diskon_user += $pengurang;
                }

                $gc                                      = count($list_potongan);
                $list_potongan[$gc]['kode_promo']        = $promo['user']['aktif'][$t]['kode_promo'];
                $list_potongan[$gc]['nama_promo']        = $promo['user']['aktif'][$t]['nama_promo'];
                $list_potongan[$gc]['margin_promo']      = $promo['user']['aktif'][$t]['margin_promo_user'];
                $list_potongan[$gc]['tipe_margin_promo'] = $promo['user']['aktif'][$t]['tipe_margin_promo_user'];
                $list_potongan[$gc]['maksimal_margin']   = $promo['user']['aktif'][$t]['maksimal_margin'];
                $list_potongan[$gc]['primary_key']       = $promo['user']['aktif'][$t]['primary_key'];
                $list_potongan[$gc]['informasi']         = $promo['user']['aktif'][$t]['informasi'];
                $list_potongan[$gc]['harga_jual_diskon'] = $jual_akhir_temp;
                $list_potongan[$gc]['harga_diskon']      = $harga_diskon_user;

                $list_potongan[$gc]['jenis'] = "User";

                $jual_akhir -= $harga_diskon_user;
                $harga_diskon_user_total += $harga_diskon_user;
            }
        }
        $harga_akhir_tanpa_mitra  = $jual_akhir;
        $diskon_mitra             = "0";
        $harga_diskon_mitra       = "0";
        $harga_diskon_mitra_total = "0";
        if (count($promo['mitra']['aktif'])) {
            for ($t = 1; $t <= count($promo['mitra']['aktif']); $t++) {
                $diskon_mitra = $promo['mitra']['aktif'][$t]['margin_promo_mitra'];

                if ($promo['mitra']['aktif'][$t]['tipe_margin_promo_mitra'] == '%') {
                    $harga_diskon_mitra = ($diskon_mitra / 100 * $jual_akhir_temp);
                } else {
                    $harga_diskon_mitra = $diskon_mitra * $jumlah;
                }
                if ($promo['mitra']['aktif'][$t]['maksimal_margin']) {

                    if ($harga_diskon_mitra > $promo['mitra']['aktif'][$t]['maksimal_margin']) {
                        $harga_diskon_mitra = $promo['mitra']['aktif'][$t]['maksimal_margin'];
                    }
                }

                if (isset($return['limit_diskon'])) {

                    if (($jual_akhir_temp - $harga_diskon_mitra) < ($return[strtolower($return['limit_diskon_dari'])] + $return['limit_diskon'])) {
                        //harga mitra adalah harga minimum
                        $harga_limit = $return[strtolower($return['limit_diskon_dari'])];
                        $harga_limit += $return['limit_diskon'];

                        $return['harga_limit_toko'] = $harga_limit;
                        $pengurang                  = $jual_akhir_temp - $harga_diskon_mitra - $harga_limit;
                        $harga_diskon_mitra += $pengurang;
                    }
                }
                $gc                                      = count($list_potongan);
                $list_potongan[$gc]['kode_promo']        = $promo['mitra']['aktif'][$t]['kode_promo'];
                $list_potongan[$gc]['nama_promo']        = $promo['mitra']['aktif'][$t]['nama_promo'];
                $list_potongan[$gc]['margin_promo']      = $promo['mitra']['aktif'][$t]['margin_promo_mitra'];
                $list_potongan[$gc]['tipe_margin_promo'] = $promo['mitra']['aktif'][$t]['tipe_margin_promo_mitra'];
                $list_potongan[$gc]['maksimal_margin']   = $promo['mitra']['aktif'][$t]['maksimal_margin'];
                $list_potongan[$gc]['primary_key']       = $promo['mitra']['aktif'][$t]['primary_key'];
                $list_potongan[$gc]['informasi']         = $promo['mitra']['aktif'][$t]['informasi'];
                $list_potongan[$gc]['harga_jual_diskon'] = $jual_akhir_temp;
                $list_potongan[$gc]['harga_diskon']      = $harga_diskon_mitra;
                $list_potongan[$gc]['jenis']             = "Mitra";

                $jual_akhir -= $harga_diskon_mitra;
                $harga_diskon_mitra_total += $harga_diskon_mitra;
            }
        }

        //$return['tipe_diskon_mitra'] = $type_mitra;
        $return['result_jual_akhir']  = $jual_akhir;
        $return['harga_diskon_mitra'] = $harga_diskon_mitra_total;

        $return['diskon_mitra'] = $jual_awal ? $harga_diskon_mitra_total / $jual_awal * 100 : 0;
        // $return['tipe_diskon_user'] = $type_user;
        $return['harga_diskon_user'] = $harga_diskon_user_total;
        $return['diskon_user']       = $jual_awal ? $harga_diskon_user_total / $jual_awal * 100 : 0;
        //$return['tipe_diskon_toko'] = $type_toko;
        $return['harga_diskon_toko']       = $harga_diskon_toko_total;
        $return['diskon_toko']             = $jual_awal ? $harga_diskon_toko_total / $jual_awal * 100 : 0;
        $return['harga_akhir_tanpa_mitra'] = $harga_akhir_tanpa_mitra;
        $return['list_potongan']           = $list_potongan;

        return $return;
    }
    public static function get_data_harga($page, $type, $id, $type_return, $id_store_barang, $hitung = 'Tidak', $jumlah = 1, $id_store_barang_varian = null, $id_user_mitra = null)
    {
        //    echo $type_return.'--'.$id_store_barang.'--'.$id_store_barang_varian;
        // if (!isset($_SESSION['id_apps_user'])) {
        //     echo 'silahkan login/daftar terlebih dahulu';
        //     die;
        // }
        if (! $jumlah or $jumlah < 0) {
            $jumlah = 1;
        }

        DB::selectRaw('*,store__produk.id_toko');
        DB::table('store__produk');
        DB::joinRaw("inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset", 'left');
        DB::whereRaw("store__produk.id = $id_store_barang");
        $produk = DB::get('all');
        if ($produk['num_rows']) {

            $id_toko     = $produk['row'][0]->id_toko ? $produk['row'][0]->id_toko : -1;
            $id_kategori = $produk['row'][0]->id_kategori ? $produk['row'][0]->id_kategori : -1;
            $id_brand    = $produk['row'][0]->id_brand;

            DB::selectRaw('*,store__voucher.id as primary_key');
            DB::table('store__voucher');
            if ($id_toko) {
                DB::whereRaw("store__voucher.id_toko = $id_toko");
            }

            DB::whereRaw("store__voucher.sisa_pengunaan_voucher >0");
            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' >= berlaku_dari");
            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' <= berlaku_sampai");

            DB::whereRaw("(case
                when store__voucher.semua_produk='Ya' then 1
                when store__voucher.semua_produk!='Ya' and
                    (
                        (select count(*) from store__voucher__produk where store__voucher__produk.id_produk=$id_store_barang and store__voucher.id =  store__voucher__produk.id_store__voucher) >= 1
                        or
                        (select count(*) from store__voucher__kategori where id_kategori=$id_kategori and store__voucher.id =  store__voucher__kategori.id_store__voucher) >= 1
                        " . ($id_brand ? "or
                        (select count(*) from store__voucher__brand where id_brand=$id_brand and store__voucher.id =  store__voucher__brand.id_store__voucher) >= 1" : 'or 1=0') . "
                    ) then 1
                    else 0
                end)=1");
            $promo_voucher = DB::get('all');
            $promo_voucher['query'];
            $string_promo_voucher_aktif = "";
            $string_promo_voucher_all   = "";

            $i                         = 0;
            $promo['voucher']['aktif'] = [];

            if ($promo_voucher['num_rows']) {
                foreach ($promo_voucher['row'] as $voucher) {

                    $i++;
                    if (($jumlah >= $voucher->syarat_minimal_pembelian or $voucher->syarat_minimal_pembelian == null or $voucher->syarat_minimal_pembelian = 0) and ($jumlah <= $voucher->syarat_maksimal_pembelian or $voucher->syarat_maksimal_pembelian == null or $voucher->syarat_maksimal_pembelian == 0)) {
                        $promo['voucher']['aktif'][$i]['kode_promo']                = $voucher->kode_voucher;
                        $promo['voucher']['aktif'][$i]['nama_promo']                = $voucher->nama_voucher;
                        $promo['voucher']['aktif'][$i]['margin_promo_voucher']      = $voucher->margin_promo;
                        $promo['voucher']['aktif'][$i]['tipe_margin_promo_voucher'] = $voucher->tipe_margin;
                        $promo['voucher']['aktif'][$i]['primary_key']               = $voucher->primary_key;
                        $promo['voucher']['aktif'][$i]['maksimal_margin']           = $voucher->maksimal_margin;
                        $promo['voucher']['aktif'][$i]['jenis_voucher']             = $voucher->voucher;
                        $to_string_promo_voucher_aktif                              = "<div class='card'>";
                        $to_string_promo_voucher_aktif .= "<div class='card-body'>
                                    <h5>" . $voucher->nama_promo . '</h5>

                                     ';
                        $to_string_promo_voucher_aktif .= "
                        Diskon " . $voucher->Voucher . " " . ($voucher->tipe_margin == 'Rp' ? 'Rp. ' : '') . $voucher->margin_promo . ($voucher->tipe_margin == '%' ? '%. ' : '');
                        $to_string_promo_voucher_aktif .= "
                            <a type='button' onclick='gunakan_voucher(" . $voucher->primary_key . ")' class='' href='javascript:void(0)'>Gunakan Voucher</a>
                            </div>
                        </div>";

                        $promo['voucher']['aktif'][$i]['informasi'] = $to_string_promo_voucher_aktif;

                        $string_promo_voucher_aktif .= $to_string_promo_voucher_aktif;
                    }

                    $promo['voucher']['all'][$i]['kode_promo']                = $voucher->kode_voucher;
                    $promo['voucher']['all'][$i]['nama_promo']                = $voucher->nama_voucher;
                    $promo['voucher']['all'][$i]['margin_promo_voucher']      = $voucher->margin_promo;
                    $promo['voucher']['all'][$i]['tipe_margin_promo_voucher'] = $voucher->tipe_margin;
                    $promo['voucher']['all'][$i]['maksimal_margin']           = $voucher->maksimal_margin;

                    $string_promo_voucher_all .= "pilih " . $voucher->syarat_minimal_pembelian;
                    $string_promo_voucher_all .= ",dapatkan " . $voucher->nama_promo . ' ';
                    $string_promo_voucher_all .= "" . $voucher->nama_promo . ' ';
                    $string_promo_voucher_all .= "Diskon " . ($voucher->tipe_margin_promo_voucher == 'Rp' ? 'Rp. ' : '') . $voucher->margin_promo_voucher . ($voucher->tipe_margin_promo_voucher == '%' ? '%. ' : '');
                    $string_promo_voucher_all .= "|";
                }
            }

            DB::selectRaw('*,store__promo__toko.id as primary_key');
            DB::table('store__promo__toko');
            if ($id_toko) {
                DB::whereRaw("store__promo__toko.id_toko = $id_toko");
            }

            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' >= berlaku_dari");
            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' <= berlaku_sampai");

            DB::whereRaw("(case
                when store__promo__toko.semua_produk='Ya' then 1
                when store__promo__toko.semua_produk!='Ya' and
                    (
                        (select count(*) from store__promo__toko__produk where store__promo__toko__produk.id_produk=$id_store_barang and store__promo__toko.id =  store__promo__toko__produk.id_store__promo__toko) >= 1
                        or
                        (select count(*) from store__promo__toko__kategori where id_kategori=$id_kategori and store__promo__toko.id =  store__promo__toko__kategori.id_store__promo__toko) >= 1
                        " . ($id_brand ? "or
                        (select count(*) from store__promo__toko__brand where id_brand=$id_brand and store__promo__toko.id =  store__promo__toko__brand.id_store__promo__toko) >= 1" : '') . "
                    ) then 1
                    else 0
                end)=1");
            $promo_toko = DB::get('all');
            $promo_toko['query'];
            $string_promo_toko_aktif = "";
            $string_promo_toko_all   = "";
            $i                       = 0;

            $promo['toko']['aktif'] = [];

            if ($promo_toko['num_rows']) {
                foreach ($promo_toko['row'] as $toko) {

                    $i++;
                    if (($jumlah >= $toko->syarat_minimal_pembelian or $toko->syarat_minimal_pembelian == null or $toko->syarat_minimal_pembelian = 0) and ($jumlah <= $toko->syarat_maksimal_pembelian or $toko->syarat_maksimal_pembelian == null or $toko->syarat_maksimal_pembelian == 0)) {
                        $promo['toko']['aktif'][$i]['kode_promo']             = $toko->kode_promo;
                        $promo['toko']['aktif'][$i]['nama_promo']             = $toko->nama_promo;
                        $promo['toko']['aktif'][$i]['margin_promo_toko']      = $toko->margin_promo_toko;
                        $promo['toko']['aktif'][$i]['tipe_margin_promo_toko'] = $toko->tipe_margin_promo_toko;
                        $promo['toko']['aktif'][$i]['primary_key']            = $toko->primary_key;
                        $promo['toko']['aktif'][$i]['maksimal_margin']        = $toko->maksimal_margin;
                        $to_string_promo_toko_aktif                           = "";
                        $to_string_promo_toko_aktif .= "" . $toko->nama_promo . ' ';
                        $to_string_promo_toko_aktif .= "Diskon " . ($toko->tipe_margin_promo_toko == 'Rp' ? 'Rp. ' : '') . $toko->margin_promo_toko . ($toko->tipe_margin_promo_toko == '%' ? '%. ' : '');
                        $to_string_promo_toko_aktif .= "|";

                        $promo['toko']['aktif'][$i]['informasi'] = $to_string_promo_toko_aktif;

                        $string_promo_toko_aktif .= $to_string_promo_toko_aktif;
                    }

                    $promo['toko']['all'][$i]['kode_promo']             = $toko->kode_promo;
                    $promo['toko']['all'][$i]['nama_promo']             = $toko->nama_promo;
                    $promo['toko']['all'][$i]['margin_promo_toko']      = $toko->margin_promo_toko;
                    $promo['toko']['all'][$i]['tipe_margin_promo_toko'] = $toko->tipe_margin_promo_toko;
                    $promo['toko']['all'][$i]['maksimal_margin']        = $toko->maksimal_margin;

                    $string_promo_toko_all .= "pilih " . $toko->syarat_minimal_pembelian;
                    $string_promo_toko_all .= ",dapatkan " . $toko->nama_promo . ' ';
                    $string_promo_toko_all .= "" . $toko->nama_promo . ' ';
                    $string_promo_toko_all .= "Diskon " . ($toko->tipe_margin_promo_toko == 'Rp' ? 'Rp. ' : '') . $toko->margin_promo_toko . ($toko->tipe_margin_promo_toko == '%' ? '%. ' : '');
                    $string_promo_toko_all .= "|";
                }
            }
            DB::selectRaw('*,store__promo__costumer.id as primary_key');
            DB::table('store__promo__costumer');
            DB::whereRaw("store__promo__costumer.id_toko = $id_toko");
            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' >= berlaku_dari");
            DB::whereRaw("'" . date('Y-m-d H:i:s') . "' <= berlaku_sampai");

            DB::whereRaw("(case
                when store__promo__costumer.semua_produk='Ya' then 1
                when store__promo__costumer.semua_produk!='Ya' and
                    (
                        (select count(*) from store__promo__costumer__produk where store__promo__costumer__produk.id_produk=$id_store_barang and store__promo__costumer.id = id_store__promo__costumer) >= 1
                        or
                        (select count(*) from store__promo__costumer__kategori where id_kategori=$id_kategori and store__promo__costumer.id = id_store__promo__costumer) >= 1
                    ) then 1
                    else 0
                end)=1");
            $promo_user              = DB::get('all');
            $string_promo_user_aktif = "";
            $string_promo_user_all   = "";
            $i                       = 0;
            $promo['user']['aktif']  = [];
            if ($promo_user['num_rows']) {
                foreach ($promo_user['row'] as $user) {

                    $i++;
                    if (($jumlah >= $user->syarat_minimal_pembelian or $user->syarat_minimal_pembelian == null or $user->syarat_minimal_pembelian = 0) and ($jumlah <= $user->syarat_maksimal_pembelian or $user->syarat_maksimal_pembelian == null or $user->syarat_maksimal_pembelian == 0)) {
                        $promo['user']['aktif'][$i]['kode_promo']             = $user->kode_promo;
                        $promo['user']['aktif'][$i]['nama_promo']             = $user->nama_promo;
                        $promo['user']['aktif'][$i]['primary_key']            = $user->primary_key;
                        $promo['user']['aktif'][$i]['margin_promo_user']      = $user->margin_promo_user;
                        $promo['user']['aktif'][$i]['tipe_margin_promo_user'] = $user->tipe_margin_promo_user;
                        $promo['user']['aktif'][$i]['maksimal_margin']        = $user->maksimal_margin;
                        $string_promo_user_aktif .= "" . $user->nama_promo . ' ';
                        $string_promo_user_aktif .= "Diskon " . ($user->tipe_margin_promo_user == 'Rp' ? 'Rp. ' : '') . $user->margin_promo_user . ($user->tipe_margin_promo_user == '%' ? '%. ' : '');
                        $string_promo_user_aktif .= "|";
                    }

                    $promo['user']['all'][$i]['kode_promo']             = $user->kode_promo;
                    $promo['user']['all'][$i]['nama_promo']             = $user->nama_promo;
                    $promo['user']['all'][$i]['margin_promo_user']      = $user->margin_promo_user;
                    $promo['user']['all'][$i]['tipe_margin_promo_user'] = $user->tipe_margin_promo_user;
                    $promo['user']['all'][$i]['maksimal_margin']        = $user->maksimal_margin;

                    $string_promo_user_all .= "pilih " . $user->syarat_minimal_pembelian;
                    $string_promo_user_all .= ",dapatkan " . $user->nama_promo . ' ';
                    $string_promo_user_all .= "" . $user->nama_promo . ' ';
                    $string_promo_user_all .= "Diskon " . ($user->tipe_margin_promo_user == 'Rp' ? 'Rp. ' : '') . $user->margin_promo_user . ($user->tipe_margin_promo_user == '%' ? '%. ' : '');
                    $string_promo_user_all .= "|";
                }
            }

            $promo['mitra']['aktif']  = [];
            $promo['mitra']['all']    = [];
            $string_promo_mitra_aktif = "";
            $string_promo_mitra_all   = "";
            if ($produk['row'][0]->pengurangan_harga_reseller == 1 and isset($_SESSION['id_apps_user'])) {

                DB::selectRaw('*,store__toko.id as primary_key');
                DB::table('store__toko');
                //     DB::whereRaw("(case 
                //     when store__toko.log_mitra=1 and id_apps_user = " . $_SESSION['id_apps_user'] . " then 1 
                //   when store__toko.log_mitra=3 and id_organisasi = " . (isset($_SESSION['id_organisasi']) ? ($_SESSION['id_organisasi'] ? $_SESSION['id_organisasi'] : -1000) : -1000) . " then 1 

                //     end)=1");

                DB::whereRaw("store__toko.id_store_from = $id_toko");
                DB::whereRaw("id_apps_user = '" . $_SESSION['id_apps_user'] . "'");
                DB::whereRaw("jenis_toko = 'Mitra'");
                DB::joinRaw("store__mitra on store__toko.tipe_mitra = store__mitra.id");
                DB::joinRaw("store__mitra__presetase on store__mitra__presetase.id_store__mitra = store__mitra.id ");
                // DB::whereRaw("'" . date('Y-m-d H:i:s') . "' >= berlaku_dari");
                // DB::whereRaw("'" . date('Y-m-d H:i:s') . "' <= berlaku_sampai");
                $promo_mitra = DB::get('all');
                $i           = 0;
                //and $jumlah >= minimal_pembelian and ($jumlah<=maksimal_pmebelian or maksimal_pmebelian is null)
                if ($promo_mitra['num_rows']) {
                    foreach ($promo_mitra['row'] as $mitra) {

                        $i++;
                        if (($jumlah >= $mitra->minimal_pembelian or $mitra->minimal_pembelian == null or $mitra->minimal_pembelian = 0) and ($jumlah <= $mitra->maksimal_pembelian or $mitra->maksimal_pembelian == null or $mitra->maksimal_pembelian == 0)) {
                            $promo['mitra']['aktif'][$i]['kode_promo']              = $mitra->kode_mitra;
                            $promo['mitra']['aktif'][$i]['nama_promo']              = "Diskon Mitra " . $mitra->nama_mitra;
                            $promo['mitra']['aktif'][$i]['primary_key']             = $mitra->primary_key;
                            $promo['mitra']['aktif'][$i]['margin_promo_mitra']      = $mitra->margin_mitra;
                            $promo['mitra']['aktif'][$i]['tipe_margin_promo_mitra'] = $mitra->tipe_margin_mitra;
                            $promo['mitra']['aktif'][$i]['maksimal_margin']         = "0";
                            $string_promo_mitra_aktif .= "Diskon Mitra " . $mitra->nama_mitra . ' ';
                            $string_promo_mitra_aktif .= "Diskon " . ($mitra->tipe_margin_mitra == 'Rp' ? 'Rp. ' : '') . $mitra->margin_mitra . ($mitra->tipe_margin_mitra == '%' ? '%. ' : '');
                            $string_promo_mitra_aktif .= "|";

                            $promo['mitra']['aktif'][$i]['informasi'] = $string_promo_mitra_aktif;
                        }

                        $promo['mitra']['all'][$i]['kode_promo']              = $mitra->kode_mitra;
                        $promo['mitra']['all'][$i]['nama_promo']              = "Diskon Mitra " . $mitra->nama_mitra;
                        $promo['mitra']['all'][$i]['margin_promo_mitra']      = $mitra->margin_mitra;
                        $promo['mitra']['all'][$i]['tipe_margin_promo_mitra'] = $mitra->tipe_margin_mitra;
                        // $promo['mitra']['all'][$i]['maksimal_margin'] = $mitra->maksimal_margin;

                        $string_promo_mitra_all .= "pilih " . $mitra->minimal_pembelian;
                        $string_promo_mitra_all .= ",dapatkan Diskon Mitra" . $mitra->nama_mitra . ' ';
                        $string_promo_mitra_all .= "" . $mitra->nama_mitra . ' ';
                        $string_promo_mitra_all .= "Diskon " . ($mitra->tipe_margin_mitra == 'Rp' ? 'Rp. ' : '') . $mitra->margin_mitra . ($mitra->tipe_margin_mitra == '%' ? '%. ' : '');
                        $string_promo_mitra_all .= "|";
                    }
                }
            }

            if ($type_return == 'min_max') {
                $array_harga_awal  = [];
                $array_harga_akhir = [];
                $awal              = 0;
                $akhir             = 0;
                $sql               = " select id_bundle_harga,hpj,hpp
                    from store__produk__harga
                    where id_store__produk = $id_store_barang
                        and store__produk__harga.active=1
                        and minpembelian=1
                ";
                DB::queryRaw($page, $sql);
                $harga = DB::get('all');

                if ($harga['num_rows']) {
                    foreach ($harga['row'] as $row) {
                        $id_store_barang;
                        //print_R($row);
                        $return = EcommerceApp::bundle_harga($page, $row->id_bundle_harga, $row->hpj);
                        if (! isset($return['limit_diskon_dari'])) {
                            $return['limit_diskon_dari'] = "hpp";
                        } else if (! ($return['limit_diskon_dari'])) {
                            $return['limit_diskon_dari'] = "hpp";
                        }
                        $return['limit_diskon'] = (int) $return['limit_diskon'];
                        $jual_awal              = $return['Harga Jual'];
                        $return['hpj']          = $row->hpj;
                        $return['hpp']          = $row->hpp;
                        $array_harga_awal[]     = $jual_awal;
                        $jual_akhir             = $jual_awal;

                        $return     = EcommerceApp::get_data_harga_promo($jual_awal, $promo, $return, 1);
                        $jual_akhir = $return['result_jual_akhir'];

                        $array_harga_akhir[] = $jual_akhir;
                    }
                } else {
                    $sql = " select *
                        from store__produk
                        left join store__produk__varian on store__produk__varian.id_store__produk =  store__produk.id
                        left join (select count(*) as count_varian, id_store__produk from store__produk__varian as varian group by id_store__produk) get_count on get_count.id_store__produk =  store__produk.id
                        where store__produk.id = $id_store_barang
                    ";
                    DB::queryRaw($page, $sql);
                    $harga = DB::get('all');

                    if ($harga['num_rows']) {
                        foreach ($harga['row'] as $row) {
                            $return['limit_diskon_dari'] = "hpp";
                            $return['limit_diskon']      = (int)  -1;
                            $return['hpp']               = $produk["row"][0]->harga_pokok;
                            $return['hpj']               = $produk["row"][0]->harga_pokok;
                            if ($row->count_varian > 0) {
                                $jual_awal          = $row->harga_pokok_penjualan_varian;
                                $array_harga_awal[] = $jual_awal;
                                $return             = EcommerceApp::get_data_harga_promo($jual_awal, $promo, $return, 1);
                                $jual_akhir         = $return['result_jual_akhir'];

                                $array_harga_akhir[] = $jual_akhir;
                            } else {
                                $jual_awal          = $row->harga_pokok_penjualan;
                                $array_harga_awal[] = $jual_awal;
                                $return             = EcommerceApp::get_data_harga_promo($jual_awal, $promo, $return, 1);
                                $jual_akhir         = $return['result_jual_akhir'];

                                $array_harga_akhir[] = $jual_akhir;
                            }
                        }
                    }
                }

                $awal = Partial::rupiah(min($array_harga_awal));
                if (min($array_harga_awal) != max($array_harga_awal)) {
                    $awal .= ' s/d ' . Partial::rupiah(max($array_harga_awal));
                }

                $awal_polos = (min($array_harga_awal));
                if (min($array_harga_awal) != max($array_harga_awal)) {
                    $awal_polos .= ' s/d ' . (max($array_harga_awal));
                }

                $akhir = Partial::rupiah(min($array_harga_akhir));
                if (min($array_harga_akhir) != max($array_harga_akhir)) {
                    $akhir .= ' s/d ' . Partial::rupiah(max($array_harga_akhir));
                }

                // $presentase_awal =  (min($array_harga_akhir) - min($array_harga_awal)) / min($array_harga_akhir) * 100;
                // $presentase_akhir = (max($array_harga_akhir) - max($array_harga_awal)) / max($array_harga_akhir) * 100;
                ($harga_diskon_awal = min($array_harga_awal) - min($array_harga_akhir));
                $harga_diskon_akhir                          = max($array_harga_awal) - max($array_harga_akhir);
                $update_produk['harga_diskon']               = $harga_diskon_awal;
                $update_produk['presentase_diskon']          = min($array_harga_awal) ? $harga_diskon_awal / min($array_harga_awal) * 100 : 0;
                $update_produk['harga_jual_awal_min_store']  = min($array_harga_awal);
                $update_produk['harga_jual_awal_max_store']  = max($array_harga_awal);
                $update_produk['harga_jual_akhir_min_store'] = min($array_harga_akhir);
                $update_produk['harga_jual_akhir_max_store'] = max($array_harga_akhir);
                if (isset($_SESSION['id_apps_user'])) {

                    DB::queryRaw($page, " select * from store__produk__user
                    where id_produk = $id_store_barang
                    and id_apps_user=" . $_SESSION['id_apps_user']);
                    $user_produk = DB::get('all');
                    if ($user_produk['num_rows']) {
                        DB::update('store__produk__user', $update_produk, ["id_produk=$id_store_barang ", "id_apps_user=" . $_SESSION['id_apps_user']]);
                    } else {
                        $update_produk['id_produk']    = $id_store_barang;
                        $update_produk['id_apps_user'] = $_SESSION['id_apps_user'];
                        CRUDFunc::crud_insert(new MainFaiFramework(), $page, $update_produk, [], 'store__produk__user', []);
                    }
                }

                $return['Min Max Harga Jual Akhir'] = $akhir;
                $return['Min Max Harga Jual Awal']  = $awal;
            } else {
                $where = "";
                if ($id_store_barang_varian) {
                    $where = "and store__produk__varian.id=$id_store_barang_varian";
                }

                // $sql = " select *,case when count_varian>0 then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok,store__produk.id_toko
                //     from store__produk
                //     left join store__produk__varian on store__produk__varian.id_store__produk =  store__produk.id
                //     left join inventaris__asset__list on inventaris__asset__list.id =  store__produk.id_asset
                //     left join inventaris__asset__list__varian on inventaris__asset__list__varian.id =  store__produk__varian.id_barang_varian
                //     left join (select count(*) as count_varian, id_store__produk from store__produk__varian as varian group by id_store__produk) get_count on get_count.id_store__produk =  store__produk.id
                //     where   $where
                // ";
                // DB::queryRaw($page, $sql);
                // DB::table('store__produk');
                // DB::selectRaw("*, case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok");
                // DB::whereRaw("store__produk.id = $id_store_barang");
                // if ($id_store_barang_varian)
                //     DB::whereRaw("store__produk__varian.id = $id_store_barang_varian");
                // DB::joinRaw(" on inventaris__asset__list.id = store__produk.id_asset");
                // DB::joinRaw("store__produk__varian on varian_barang = '1'  and store__produk.id = id_store__produk", 'left');
                // $produk = DB::get('all');
                $db_produk['select'][] = "store__produk.id_toko,
                id_asset,id_barang_varian,berat_varian,berat, case when varian_barang='1' then 1 else 0 end as count_varian, case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok";
                $db_produk['utama']  = "store__produk";
                $db_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", " store__produk.id_asset", "inner"];
                $db_produk['join'][] = ["store__produk__varian", "store__produk__varian.id_store__produk", "  store__produk.id", "left"];
                $db_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "store__produk__varian.id_barang_varian", "left"];
                // $db_produk['join'][] = ["(select count(*) as count_varian, id_store__produk from store__produk__varian as varian group by id_store__produk) get_count","get_count.id_store__produk","store__produk.id","left","non_schema"=>true];
                $db_produk['where'][] = ["store__produk.id ", " = ", "$id_store_barang $where"];
                $db_produk['np']      = true;
                $produk               = Database::database_coverter($page, $db_produk, [], 'all');
                $id_toko              = $produk['row'][0]->id_toko;

                $return['id_toko'] = $id_toko;
                $where             = "";
                $jumlah            = (int) $jumlah;
                if (! $jumlah) {
                    $jumlah = 1;
                }

                $sql = " select *,store__produk__harga.id as id_harga from

                store__produk__harga
                where id_store__produk = $id_store_barang
                and store__produk__harga.active=1
               and (($jumlah>=minpembelian and ($jumlah<=maxpembelian or maxpembelian is null) ) )

                $where
                ";
                DB::queryRaw($page, $sql);
                $harga_qty = DB::get('all');
                // echo '<pre>';
                // print_R($produk);
                if ($harga_qty['num_rows']) {
                    $return                 = EcommerceApp::bundle_harga($page, $harga_qty["row"][0]->id_bundle_harga, $harga_qty["row"][0]->hpj);
                    $return['bundle_harga'] = $harga_qty["row"][0]->id_bundle_harga;
                    $return['hpp']          = $harga_qty["row"][0]->hpp;
                    $return['hpj']          = $harga_qty["row"][0]->hpj;
                } else if ($produk["row"][0]->harga_pokok) {
                    $return        = EcommerceApp::bundle_harga($page, 0, $produk["row"][0]->harga_pokok);
                    $return['hpp'] = $produk["row"][0]->harga_pokok;
                    $return['hpj'] = $produk["row"][0]->harga_pokok;
                }
                if (! isset($return['limit_diskon_dari'])) {
                    $return['limit_diskon_dari'] = "hpp";
                } else if (! ($return['limit_diskon_dari'])) {
                    $return['limit_diskon_dari'] = "hpp";
                }
                if (isset($return['limit_diskon'])) {
                    $return['limit_diskon'] = (int) $return['limit_diskon'];
                }

                $return['harga_satuan']       = $return['Harga Jual'];
                $return['harga_satuan_print'] = Partial::rupiah($return['Harga Jual']);
                // $return['id_harga'] = $harga_qty["row"][0]->id_harga;
                $return['id_barang']                = $produk["row"][0]->id_asset;
                $return['id_barang_varian']         = $produk["row"][0]->id_barang_varian;
                $return['id_toko']                  = $id_toko;
                $return['berat_satuan']             = $produk["row"][0]->count_varian ? $produk["row"][0]->berat_varian : $produk["row"][0]->berat;
                $return['berat_total']              = $return['berat_satuan'] * $jumlah;
                $jual_awal                          = $return['Harga Jual'] * $jumlah;
                $return['harga_jual_qty']           = $return['Harga Jual'] * $jumlah;
                $return                             = EcommerceApp::get_data_harga_promo($return['Harga Jual'], $promo, $return, $jumlah);
                $jual_akhir                         = $return['result_jual_akhir'];
                $return['harga_jual_akhir']         = $jual_akhir;
                $return['harga_jual_akhir_print']   = Partial::rupiah($jual_akhir);
                $return['total_diskon_keseluruhan'] = $jual_awal - $jual_akhir;
                $return['diskon_keseluruhan']       = $jual_awal ? (($jual_awal - $jual_akhir) / $jual_awal * 100) : 0;

                // $return['harga_jual'] = $harga_qty["row"][0]->harga_jual*$jumlah;
                // $return['harga_jual_print'] = Partial::rupiah($harga_qty["row"][0]->harga_jual*$jumlah);

            }
            if (isset($harga_akhir_tanpa_mitra)) {
                DB::table('store__mitra');
                DB::joinRaw('store__mitra__presetase on id_store__mitra = store__mitra.id');
                DB::whereRaw("store__mitra.id_toko = $id_toko");
                $mitra = DB::get();
                $x     = 0;
                foreach ($mitra as $mitra) {
                    $x += 1;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['minimal_pembelian']  = $mitra->minimal_pembelian;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['maksimal_pembelian'] = $mitra->maksimal_pembelian;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['margin_mitra']       = $diskon_mitra       = $mitra->margin_mitra;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['tipe_margin_mitra']  = $type_mitra  = $mitra->tipe_margin_mitra;
                    if ($diskon_mitra) {
                        if ($type_mitra == '%') {
                            $harga_diskon_mitra = ($diskon_mitra / 100 * $harga_akhir_tanpa_mitra);
                            //$jual_akhir = $harga_akhir_tanpa_mitra - $harga_diskon_mitra;
                        } else {
                            $harga_diskon_mitra = $diskon_mitra * $jumlah;
                            // $jual_akhir -= $harga_diskon_mitra;
                        }
                    }

                    $harga_limit = $return[strtolower($return['limit_diskon_dari'])];
                    $harga_limit += (int) $return['limit_diskon'];

                    $return['harga_mitra'][$mitra->nama_mitra][$x]['harga_limit'] = $harga_limit;
                    if (($harga_akhir_tanpa_mitra - $harga_diskon_mitra) < $harga_limit) {
                        //harga mitra adalah harga minimum
                        $pengurang = $harga_akhir_tanpa_mitra - $harga_diskon_mitra - $harga_limit;
                        $harga_diskon_mitra += $pengurang;
                    }
                    if ($harga_diskon_mitra < 0) {
                        $harga_diskon_mitra = 0;
                    }
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['diskon_mitra']            = $harga_diskon_mitra;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['persentase_margin_mitra'] = $harga_diskon_mitra / $harga_akhir_tanpa_mitra * 100;
                    $return['harga_mitra'][$mitra->nama_mitra][$x]['harga_jual_mitra']        = $harga_akhir_tanpa_mitra - $harga_diskon_mitra;
                }
            }
            if (isset($return['donasi_baitul_mal'])) {
                if ($return['tipe_donasi_baitul_mal'] == '%') {
                    $harga_donasi_baitul_mal = ($return['donasi_baitul_mal'] / 100 * $jual_akhir);
                } else {
                    $harga_donasi_baitul_mal = $return['donasi_baitul_mal'];
                }
                $return['harga_donasi_baitul_mal'] = $harga_donasi_baitul_mal;
            } else {
                $return['harga_donasi_baitul_mal'] = 0;
            }
            $return['string_voucher_aktif']     = $string_promo_voucher_aktif;
            $return['string_promo_toko_aktif']  = $string_promo_toko_aktif;
            $return['string_promo_toko_all']    = $string_promo_toko_all;
            $return['string_promo_user_aktif']  = $string_promo_user_aktif;
            $return['string_promo_user_all']    = $string_promo_user_all;
            $return['string_promo_mitra_aktif'] = $string_promo_mitra_aktif;
            $return['string_promo_mitra_all']   = $string_promo_mitra_all;
            //    echo $produk["row"][0]->id_asset;
            $lainnya['id_varian'] = ($produk["row"][0]->id_barang_varian ?? -1);
            $stok                 = ErpPosApp::get_stok($page, 0, "", "", ($produk["row"][0]->id_asset ?? -1), 'exe_rekap_akhir_total_asset', $lainnya);

            $return['stok']       = $stok['num_rows'] ? $stok['row'][0]->stok : 0;
            $return['query_stok'] = $stok['query'];
            // EcommerceApp::sync_update_stok($page, $id_store_barang, ($produk["row"][0]->id_asset??0), ($produk["row"][0]->id_barang_varian??0));
            return $return;
        } else {
            return [];
        }
    }
    public static function list_alamat_user($page)
    {
        $db['utama']       = 'inventaris__asset__tanah__bangunan__pengisi';
        $db['primary_key'] = null;
        $db['np']          = true;
        $db['select'][]    = '*';
        $db['select'][]    = 'inventaris__asset__tanah__bangunan.id as primary_key';
        $db['select'][]    = '(select id_kirim_ke from erp__pos__group where erp__pos__group.id={LOAD_ID}) as id_kirim_ke';

        $db['join'][]  = ["inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan"];
        $db['join'][]  = ["webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi"];
        $db['join'][]  = ["webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota"];
        $db['join'][]  = ["webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan"];
        $db['join'][]  = ["webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan"];
        $db['where'][] = ["inventaris__asset__tanah__bangunan__pengisi.id_apps_user", "=", "{SESSION_UTAMA}"];
        $db['where'][] = ["inventaris__asset__tanah__bangunan.id_kota", " is ", " not null"];
    }
    public static function stok_satuan($body)
    {
        DB::table('view_all_produk_stok');
        DB::whereRaw("id_asset = '" . $body['id_asset'] . "'");
        DB::whereRaw("id_barang_varian = '" . $body['id_asset_varian'] . "'");
        DB::whereRaw("id_produk_varian = '" . $body['id_produk_varian'] . "'");
        $get                  = DB::get('all');
        return $get['row'][0]->stok_available ?? 0;
    }
    public static function list_cart($page)
    {
        $db = [
            "utama"       => "erp__pos__pra_order",
            "primary_key" => null,

            "join"        => [
                ["store__produk as  store__produk__relation", "id_produk", "store__produk__relation.id"],
                ["store__toko", "store__produk__relation.id_toko", "store__toko.id"],
                ["inventaris__asset__list_query", "store__produk__relation.id_asset", "inventaris__asset__list.id"],
                ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id_inventaris__asset__list", "inventaris__asset__list.id and erp__pos__pra_order.id_asset_varian =inventaris__asset__list__varian.id", 'left'],
            ],

            "select"      => [
                ("erp__pos__pra_order.id as id_cart"),

                ("*"),
            ],
            "where"       => [
                ["erp__pos__pra_order.id_apps_user", "=", Partial::input('id_user')],
                ["erp__pos__pra_order.status_pra_order", "=", "'Cart'"],
                ["erp__pos__pra_order.active", "=", "1"],
            ],
        ];
        $data                = Database::database_coverter($page, $db, [], 'all');
        $return_all          = "";
        $get_template_master = BundleContent::foodmart_ecomerce_cart_produk($page);

        if ($data['num_rows']) {

            foreach ($data['row'] as $data) {
                $get_template        = $get_template_master['html'];
                $ecomerce_data_harga = EcommerceApp::get_data_harga($page, '', '', "cart", $data->id_produk, 'YA', $data->jumlah, $data->id_produk_varian);                                                                                      //, "row:id_varian!database_list_template_on_list|"
                $ecomerce_cek_harga  = EcommerceApp::cek_harga_cart_get_checkout($page, '', '', "all", $data->id_cart, $data->checked, $data->jumlah, $data->id_varian_pra_order_1, $data->id_varian_pra_order_2, $data->id_varian_pra_order_3); //, "row:id_varian!database_list_template_on_list|"

                $get_template = str_replace("<NAMA-PRODUK></NAMA-PRODUK>", $data->nama_barang, $get_template);
                $get_template = str_replace("<ID-CART></ID-CART>", $data->id_cart, $get_template);
                $get_template = str_replace("<NAMA-VARIAN></NAMA-VARIAN>", $data->nama_varian, $get_template);
                $get_template = str_replace("<HARGA-SATUAN></HARGA-SATUAN>", $ecomerce_data_harga['harga_satuan'], $get_template);
                $get_template = str_replace("<TOTAL-DISKON></TOTAL-DISKON>", $ecomerce_data_harga['total_diskon_keseluruhan'], $get_template);
                $get_template = str_replace("<HARGA></HARGA>", $ecomerce_data_harga['harga_jual_akhir_print'], $get_template);
                $get_template = str_replace("<IMAGE-CART></IMAGE-CART>", $ecomerce_cek_harga['img_src'], $get_template);
                $get_template = str_replace("<VARIAN1><VARIAN1>", $data->id_varian_1, $get_template);
                $get_template = str_replace("<VARIAN2><VARIAN2>", $data->id_varian_2, $get_template);
                $get_template = str_replace("<VARIAN3><VARIAN3>", $data->id_varian_3, $get_template);
                $get_template = str_replace("<QTY></QTY>", $data->jumlah, $get_template);
                $get_template = str_replace("<CHECKED></CHECKED>", ($data->checked ? 'checked' : ''), $get_template);
                $return_all .= $get_template;
            }
        }
        return $return_all;
    }
    public static function add_cart($page)
    {

        $fai = new MainFaiFramework();
        // $data['id_panel'] = $page['get_panel']['id_panel'];
        $data['id_apps_user'] = Partial::input('id_user') ? Partial::input('id_user') : $_SESSION['id_apps_user'];
        $where                = "";

        if ((int) $fai->input('id_varian_1')) {
            $where .= (" and
        case
                    when inventaris__asset__list__varian.asal_from_data_varian ='Master'
                            then master.id_varian_1
                    else  inventaris__asset__list__varian.id_varian_1

                end =
        " . (int) $fai->input('id_varian_1'));
        }

        if ((int) $fai->input('id_varian_2')) {
            $where .= ("  and case
                    when inventaris__asset__list__varian.asal_from_data_varian ='Master'
                            then master.id_varian_2
                    else  inventaris__asset__list__varian.id_varian_2

                end=" . (int) $fai->input('id_varian_2'));
        }

        if ((int) $fai->input('id_varian_3')) {
            $where .= (" and  case
                    when inventaris__asset__list__varian.asal_from_data_varian ='Master'
                            then master.id_varian_3
                    else  inventaris__asset__list__varian.id_varian_3

                end=" . (int) $fai->input('id_varian_3'));
        }

        DB::queryRaw($page, "SELECT *,store__produk__varian.id as id_store_varian, inventaris__asset__list__varian.id as id_asset_varian
        FROM store__produk__varian
        left join inventaris__asset__list__varian on id_barang_varian = inventaris__asset__list__varian.id
        left join inventaris__asset__list__varian as master on inventaris__asset__list__varian.id_master_varian = master.id
        where id_store__produk = " . $fai->input('id_produk') . "
        $where");
        $get = DB::get('all');

        $data['id_asset_varian']  = $get['row'][0]->id_asset_varian;
        $data['id_produk_varian'] = $get['row'][0]->id_store_varian;
        $data['id_asset']         = (int) $fai->input('id_asset');
        $data['id_produk']        = (int) $fai->input('id_produk');
        $set_qty                  = (int) $fai->input('set_qty');

        if ($fai->input('add_qty')) {

            $db['utama'] = 'erp__pos__pra_order';
            foreach ($data as $key => $value) {
                $db['where'][] = [$key, "=", $value];
            }
            $get = Database::database_coverter($page, $db, [], 'all');
            if ($get['num_rows'] > 0) {
                $qty = $get['row'][0]->jumlah;
            } else {
                $qty = 0;
            }
            $set_qty = $qty + 1;
        }

        $stok = EcommerceApp::sync_update_stok($page, $data['id_produk'], $data['id_asset'], $data['id_asset_varian']);
        $stok_available                  = EcommerceApp::stok_satuan($data);
        if ($set_qty >  $stok_available) {
            echo json_encode(["status" => "0", "stok" => $stok, "keterangan" => "Qty Pesan melebihi Stok (Stok:$stok)"]);
        } else {

            // $data['id_varian_list'] = $fai->input('id_varian');
            $data['id_varian_pra_order_1'] = (int) $fai->input('id_varian_1');
            $data['id_varian_pra_order_2'] = (int) $fai->input('id_varian_2');
            $data['id_varian_pra_order_3'] = (int) $fai->input('id_varian_3');

            $data['jumlah']      = $set_qty;
            $data['create_date'] = date('Y-m-d H:i:s');
            //ini

            CRUDFunc::crud_insert($fai, $page, $data, [], 'erp__pos__pra_order', []);
            echo json_encode(["status" => "1", "qty" => $data['jumlah'], "stok" => $stok]);
        }
    }
    public static function jadikan_default_pengiriman($page, $type, $id)
    {
        $fai = new MainFaiFramework();
        DB::update("inventaris__asset__tanah__bangunan__pengisi", ["default_pembelian_barang" => 0, "update_date" => date("Y-m-d H:i:s"), "update_by" => $_SESSION['id_apps_user']], ["id_apps_user=" . $_SESSION['id_apps_user']]);
        DB::update("inventaris__asset__tanah__bangunan__pengisi", ["default_pembelian_barang" => 1, "update_date" => date("Y-m-d H:i:s"), "update_by" => $_SESSION['id_apps_user']], ["id_inventaris__asset__tanah__bangunan	=" . Partial::input('id_bangunan') . " and id_apps_user=" . $_SESSION['id_apps_user']]);
    }
    public static function save_pengiriman_ke($page, $type, $id)
    {

        $fai                       = new MainFaiFramework();
        $array                     = $fai->apps("Inventaris_aset", "bangunan")['crud']['array'];
        $array                     = Database::converting_array_field($page, $array);
        $page['crud']['array']     = $array;
        $page['crud']['save_type'] = "insert";
        $returnddv                 = CRUDFunc::declare_crud_variable($fai, $page, $array, "inventaris__asset__tanah__bangunan", $type);
        $sqli                      = $returnddv['$sqli'];
        $field_appr                = $returnddv['$field_appr'];
        $where                     = $returnddv['$where'];
        $select                    = $returnddv['$select'];
        $sqlen                     = $returnddv['$sqlen'];
        $sqlfile                   = $returnddv['$sqlfile'];
        $sqli["create_date"]       = date('Y-m-d H:i:s');
        //$sqli["create_by"]=$idUser;
        $database_utama = "inventaris__asset__tanah__bangunan";
        $return         = CRUDFunc::crud_save($fai, $page, $sqli, $sqlen, $array, $database_utama, $returnddv);
        $sqli           = $return['sqli'];
        $sqlen          = $return['sqlen'];
        DB::queryRaw($page, "select count(*) from inventaris__asset__tanah__bangunan__pengisi where id_apps_user=" . $_SESSION['id_apps_user'] . " and default_pembelian_barang=1");
        $get                                                   = DB::get();
        $id_last                                               = ($return['last_insert_id']);
        $sqli_pengisi["id_apps_user"]                          = $_SESSION['id_apps_user'];
        $sqli_pengisi["id_inventaris__asset__tanah__bangunan"] = $id_last;
        $sqli_pengisi["default_pembelian_barang"]              = $get[0]->count ? 0 : 1;
        $return                                                = CRUDFunc::crud_save($fai, $page, $sqli_pengisi, [], [], "inventaris__asset__tanah__bangunan__pengisi");

        $update                = [];
        $update['id_kirim_ke'] = $id_last;
        DB::update('erp__pos__group', $update, [('id=' . $id)]);
        DB::update('erp__pos__utama', $update, [('id_erp__pos__group=' . $id)]);
        $db_bangunan            = [];
        $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
        $db_bangunan['np']      = 'inventaris__asset__tanah__bangunan';
        $db_bangunan['where'][] = ['inventaris__asset__tanah__bangunan.id', '=', $id_last];
        $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');

        $erp_do['id_bangunan_tujuan'] = $id_last;
        if ($get_db_bangunan['row'][0]->id_provinsi) {
            $erp_do['id_provinsi_tujuan'] = $get_db_bangunan['row'][0]->id_provinsi;
        }

        if ($get_db_bangunan['row'][0]->id_kota) {
            $erp_do['id_kota_tujuan'] = $get_db_bangunan['row'][0]->id_kota;
        }

        if ($get_db_bangunan['row'][0]->id_kecamatan) {
            $erp_do['id_kecamatan_tujuan'] = $get_db_bangunan['row'][0]->id_kecamatan;
        }

        if ($get_db_bangunan['row'][0]->id_kelurahan) {
            $erp_do['id_kelurahan_tujuan'] = $get_db_bangunan['row'][0]->id_kelurahan;
        }

        if ($get_db_bangunan['row'][0]->rt) {
            $erp_do['rt_tujuan'] = $get_db_bangunan['row'][0]->rt;
        }

        if ($get_db_bangunan['row'][0]->rw) {
            $erp_do['rw_tujuan'] = $get_db_bangunan['row'][0]->rw;
        }

        if ($get_db_bangunan['row'][0]->alamat) {
            $erp_do['alamat_tujuan'] = $get_db_bangunan['row'][0]->alamat;
        }

        if ($get_db_bangunan['row'][0]->nomor_bangunan) {
            $erp_do['nomor_tujuan'] = $get_db_bangunan['row'][0]->nomor_bangunan;
        }

        $db_bangunan            = [];
        $db_bangunan['utama']   = 'erp__pos__utama';
        $db_bangunan['np']      = 'erp__pos__utama';
        $db_bangunan['where'][] = ['id_erp__pos__group', '=', $id];
        $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
        foreach ($get_db_bangunan['row'] as $row_utama) {
            $count['utama']   = "erp__pos__delivery_order";
            $count['np']      = "erp__pos__delivery_order";
            $count['where'][] = ["erp__pos__delivery_order.id_erp__pos__utama", "=", "$row_utama->primary_key"];
            $get_count        = Database::database_coverter($page, $count, [], 'all');

            if ($get_count['num_rows']) {

                CRUDFunc::crud_update($fai, $page, $erp_do, [], [], [], 'erp__pos__delivery_order', 'id_erp__pos__utama', $row_utama->primary_key);
            } else {
                $erp_do['id_erp__pos__utama'] = $row_utama->primary_key;
                $erp_do['tanggal_do']         = date('Y-m-d');
                $erp_do['id_store_ongkir']    = "WORKSPACE_SINGLE_TOKO|";
                // $erp_do['nomor_do'] = date('Y-m-d');

                CRUDFunc::crud_insert($fai, $page, $erp_do, [], 'erp__pos__delivery_order');
            }
        }

        echo '1';
    }
    public static function select_varian_cart($page, $type, $id)
    {
        $fai = new MainFaiFramework();
        if ($fai->input('id_cart')) {
            $id_cart = $fai->input('id_cart');
        }

        DB::table('erp__pos__pra_order');
        DB::whereRaw("erp__pos__pra_order.id=$id_cart");
        $cart      = DB::get();
        $id_asset  = $cart[0]->id_asset;
        $id_produk = $cart[0]->id_produk;

        $_GET['id_asset']  = $id_asset;
        $_GET['id_produk'] = $id_produk;

        EcommerceApp::select_varian($page, $type, $id);
    }
    public static function query_varian($id_produk)
    {
        $query_id = "SELECT  DISTINCT
			case when inventaris__asset__list__varian.asal_from_data_varian='Master' then master_varian.<ID_VARIAN> else inventaris__asset__list__varian.<ID_VARIAN> end as <ID_VARIAN>
			<ADD_SELECT>
			FROM
							inventaris__asset__list__varian
							LEFT JOIN inventaris__asset__list__varian  as master_varian ON master_varian.id= inventaris__asset__list__varian.id_master_varian
							LEFT JOIN inventaris__asset__list ON inventaris__asset__list__varian.id_inventaris__asset__list
							 = inventaris__asset__list.id
							LEFT JOIN store__produk ON id_asset = inventaris__asset__list.id
						WHERE
							store__produk.id = $id_produk
										GROUP BY case when inventaris__asset__list__varian.asal_from_data_varian='Master' then master_varian.<ID_VARIAN> else inventaris__asset__list__varian.<ID_VARIAN> end<ADD_SELECT_GROUP>


		";
        $query_id1 = str_replace('<ID_VARIAN>', 'id_tipe_varian_1', $query_id);
        $query_id1 = str_replace('<ADD_SELECT>', '', $query_id1);
        $query_id1 = str_replace('<ADD_SELECT_GROUP>', '', $query_id1);
        $query_id1 .= '';
        $query_id2 = str_replace('<ID_VARIAN>', 'id_tipe_varian_2', $query_id);
        $query_id2 = str_replace('<ADD_SELECT>', '', $query_id2);
        $query_id2 = str_replace('<ADD_SELECT_GROUP>', '', $query_id2);
        $query_id3 = str_replace('<ID_VARIAN>', 'id_tipe_varian_3', $query_id);
        $query_id3 = str_replace('<ADD_SELECT>', '', $query_id3);
        $query_id3 = str_replace('<ADD_SELECT_GROUP>', '', $query_id3);
        $sql_join  = " (select *,id as id_tipe_varian from inventaris__master__tipe_varian) as inventaris__master__tipe_varian  on inventaris__master__tipe_varian.id = ( CASE
					WHEN level = '1' then ($query_id1)
					WHEN level = '2' then ($query_id2)
					WHEN level = '3' then ($query_id3)
					ELSE NULL
								END
							)";
        $sql_where = "(
				CASE
					WHEN level = '1' AND ($query_id1)  IS NOT NULL THEN TRUE
					WHEN level = '2' AND ($query_id1)  IS NOT NULL THEN TRUE
					WHEN level = '3' AND ($query_id3)  IS NOT NULL THEN TRUE

					ELSE
						FALSE
				END
			)";
        $query_idlist = str_replace('<ID_VARIAN>', 'id_varian_row:level!database|', $query_id);
        $query_idlist = str_replace('<ADD_SELECT>', ',inventaris__asset__list__varian.id_inventaris__asset__list,store__produk.id as id_store_produk', $query_idlist);
        $query_idlist = str_replace('<ADD_SELECT_GROUP>', ',inventaris__asset__list__varian.id_inventaris__asset__list,store__produk.id', $query_idlist);

        $return['query_id']     = $query_id;
        $return['query_id1']    = $query_id1;
        $return['query_id2']    = $query_id2;
        $return['query_id3']    = $query_id3;
        $return['query_idlist'] = $query_idlist;
        $return['sql_join']     = $sql_join;
        $return['sql_where']    = $sql_where;
        return $return;
    }
    public static function select_varian($page, $type, $id)
    {
        $fai       = new MainFaiFramework();
        $id_asset  = (int) $fai->input('id_asset');
        $id_produk = (int) $fai->input('id_produk');
        $where     = "";
        $lainnya   = [];
        $join      = EcommerceApp::query_varian($id_produk)['sql_join'];
        DB::queryRaw($page, "SELECT
		max(level) as max_level ,
		max(level) as max
            FROM
                (SELECT '1' AS level
UNION ALL
SELECT '2'
UNION ALL
SELECT '3'
UNION ALL
SELECT '4'
UNION ALL
SELECT '5'
UNION ALL
SELECT '6') AS level
            join $join

       ");

        $max         = DB::get('all');
        $max         = $max['row'][0]->max;
        $level       = (int) $fai->input('level');
        $level_plus1 = $level + 1;
        // if ((int)$fai->input('id_varian_1') and $level >= 1) {
        //     $where .= " and id_varian_1=" . (int)$fai->input('id_varian_1');
        // }
        // if ((int)$fai->input('id_varian_2') and $level >= 2) {
        //     $where .= " and id_varian_2=" . (int)$fai->input('id_varian_2');
        // }
        // if ((int)$fai->input('id_varian_3') and $level >= 3) {
        //     $where .= " and id_varian_3=" . (int)$fai->input('id_varian_3');
        // }

        if ((int) $fai->input('id_varian_1') and $level >= 1) {

            $where .= (" and
            case
            when inventaris__asset__list__varian.asal_from_data_varian ='Master'
            then master.id_varian_1
                        else  inventaris__asset__list__varian.id_varian_1

                        end =
                        " . (int) $fai->input('id_varian_1'));
            $lainnya['id_varian_1'] = (int) $fai->input('id_varian_1');
        }
        if ((int) $fai->input('id_varian_2') and $level >= 2) {

            $where .= (" and case
            when inventaris__asset__list__varian.asal_from_data_varian ='Master'
            then master.id_varian_2
            else  inventaris__asset__list__varian.id_varian_2

                    end=" . (int) $fai->input('id_varian_2'));
            $lainnya['id_varian_2'] = (int) $fai->input('id_varian_2');
        }
        if ((int) $fai->input('id_varian_3') and $level >= 3) {

            $where .= (" and case
            when inventaris__asset__list__varian.asal_from_data_varian ='Master'
            then master.id_varian_3
            else  inventaris__asset__list__varian.id_varian_3

            end=" . (int) $fai->input('id_varian_3'));
            $lainnya['id_varian_3'] = (int) $fai->input('id_varian_3');
        }
        $qty = (int) $fai->input('set_qty') ? (int) $fai->input('set_qty') : 1;
        if ($level == $max) {
            $level_plus1 = $max;
        }
        $sql = "SELECT *,store__produk__varian.id as id_store_varian, inventaris__asset__list__varian.id as id_asset_varian,inventaris__master__tipe_varian__list.id as id_varian_list
        from store__produk__varian
        left join inventaris__asset__list__varian on id_barang_varian = inventaris__asset__list__varian.id
        left join inventaris__asset__list__varian master on master.id = inventaris__asset__list__varian.id_master_varian
        left join inventaris__master__tipe_varian__list on case
                        when inventaris__asset__list__varian.asal_from_data_varian ='Master'
                                then master.id_varian_$level_plus1
                        else  inventaris__asset__list__varian.id_varian_$level_plus1

                    end = inventaris__master__tipe_varian__list.id
        where id_store__produk = " . $fai->input('id_produk') . "
        $where";
        DB::queryRaw($page, $sql);
        $get                = DB::get('all');
        $varian_list        = "";
        $varian_list_option = " <option value='' selected> - Pilih  -</option>";
        $get_ada            = [];
        if ($level != $max) {
            foreach ($get['row'] as $get) {
                // value="' . $get->nama_list_tipe_varian . '" 
                if (in_array($get->id_varian_list, $get_ada)) {
                } else {

                    $varian_list .= '<label class="form-selectgroup-item">
                    <input type="radio" name="varian-' . $level_plus1 . '" class="form-selectgroup-input" id="checked-' . $id_asset . '-' . $id_produk . '-' . $get->id_varian_list . '-' . $level_plus1 . '" value="' . $get->id_varian_list . '" onclick="select_varian(' . $id_asset . ',' . $fai->input('id_produk') . ',' . $get->id_varian_list . ',' . $level_plus1 . ')">
                    <span class="form-selectgroup-label">' . $get->nama_list_tipe_varian . '</span>
                    </label>';
                    $varian_list_option .= "<option value='$get->id_varian_list'>" . $get->nama_list_tipe_varian . "</option>";
                    $get_ada[] = $get->id_varian_list;
                }
            }

            $stok = ErpPosApp::get_stok($page, 0, "", "", $id_asset, 'exe_rekap_akhir_total_asset', $lainnya);

            $return['stok'] = $stok['num_rows'] ? $stok['row'][0]->stok : 0;
            // $return['query_stok'] = $stok['query'];
        } else {
            $return = EcommerceApp::cek_harga_cart_get_checkout($page, $type, $id, 'detail', null, 1, $qty, $fai->input('id_varian_1'), $fai->input('id_varian_2'), $fai->input('id_varian_3'));
        }
        $return['varian_list_option'] = $varian_list_option;
        $return['varian_list']        = $varian_list;
        echo json_encode($return);
    }

    public static function cek_harga_cart_get_checkout($page, $type, $id, $type_return = 'json', $id_cart = null, $checked = null, $qty = 0, $varian_1 = 0, $varian_2 = 0, $varian_3 = 0)
    {
        $stok            = 0;
        $id_asset_varian = 0;
        $fai             = new MainFaiFramework();
        if ($fai->input('id_cart')) {
            $id_cart = $fai->input('id_cart');
        }

        if ($fai->input('varian_1')) {
            $varian_1 = $fai->input('varian_1');
        }

        if ($fai->input('varian_2')) {
            $varian_2 = $fai->input('varian_2');
        }

        if ($fai->input('varian_3')) {
            $varian_3 = $fai->input('varian_3');
        }

        if ($fai->input('set_qty')) {
            $qty = $fai->input('set_qty');
        }

        if ($fai->input('checked')) {
            $checked = $fai->input('checked') == 'true' ? 1 : 0;
        }

        if ($fai->input('id_asset')) {
            $id_asset = (int) $fai->input('id_asset');
        }

        if ($fai->input('id_produk')) {
            $id_produk = (int) $fai->input('id_produk');
        }

        $varian_1 = (int) $varian_1;
        $varian_2 = (int) $varian_2;
        $varian_3 = (int) $varian_3;
        $varian_1 = (int) $varian_1;
        // if ($type_return != 'detail') {
        if ($id_cart) {

            DB::table('erp__pos__pra_order');
            DB::whereRaw("erp__pos__pra_order.id=$id_cart");
            $cart             = DB::get();
            $id_asset         = $cart[0]->id_asset;
            $id_produk        = $cart[0]->id_produk;
            $id_produk_varian = $cart[0]->id_produk_varian;
            $id_asset_varian  = $cart[0]->id_asset_varian;
        } else {
            $db_utama_varian['select'][] = ('inventaris__asset__list__varian.id');
            $db_utama_varian['utama']    = ('inventaris__asset__list__varian');
            $whereRaw                    = "";

            $whereRaw .= ("inventaris__asset__list__varian.id_inventaris__asset__list=$id_asset");
            if ($varian_1) {
                $whereRaw .= ("
                and inventaris__asset__list__varian.id_varian_1

                         =
                " . $varian_1);
            }

            if ($varian_2) {
                $whereRaw .= (" and  inventaris__asset__list__varian.id_varian_2

                        =" . $varian_2);
            }

            if ($varian_3) {
                $whereRaw .= (" and
                    inventaris__asset__list__varian.id_varian_3=" . $varian_3);
            }

            $db_utama_varian['where'][] = [$whereRaw, '', ''];
            $get_asset_varian           = Database::database_coverter($page, $db_utama_varian, [], 'all');

            if (($get_asset_varian['num_rows'])) {

                $id_asset_varian = $update['id_asset_varian'] = $get_asset_varian['row'][0]->id;

                DB::table('store__produk__varian');
                DB::whereRaw("id_store__produk=$id_produk");

                DB::whereRaw("id_barang_varian=$id_asset_varian");
                $produk_varian = DB::get();

                $id_produk_varian = ($produk_varian[0]->id);

                // $update['id_produk_varian'] = $id_produk_varian;
                // $update['id_varian'] = $id_produk_varian;
            }
        }
        // }
        $db_utama['select'][]       = ('varian_barang');
        $db_utama['utama']          = ('inventaris__asset__list');
        $db_utama['non_add_select'] = ('inventaris__asset__list');
        $db_utama['whereRaw']       = ("inventaris__asset__list.id=$id_asset");
        $asset                      = Database::database_coverter($page, $db_utama, []);
        // if ($asset[0]->varian_barang == 1) {

        // //     $db_utama_varian['select'][] = ('*,inventaris__asset__list__varian.id');
        // //     $db_utama_varian['utama'] = ('inventaris__asset__list__varian');
        // //     $db_utama_varian['joinRaw'] = ('inventaris__asset__list__varian as master on master.id = inventaris__asset__list__varian.id_master_varian');
        // //     $whereRaw = "";

        // //     $whereRaw .= ("inventaris__asset__list__varian.id_inventaris__asset__list=$id_asset");
        // //     if ($varian_1)
        // //         $whereRaw .= ("
        // //     and
        // //    inventaris__asset__list__varian.id_varian_1

        // //              = 
        // //     " . $varian_1);
        // //     //     $whereRaw .= ("
        // //     // and
        // //     // case 
        // //     //             when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
        // //     //                     then master.id_varian_1 
        // //     //             else  inventaris__asset__list__varian.id_varian_1

        // //     //         end = 
        // //     // " . $varian_1);
        // //     if ($varian_2)
        // //         $whereRaw .= (" and  inventaris__asset__list__varian.id_varian_2

        // //             =" . $varian_2);
        // //     // $whereRaw .= (" and case 
        // //     //         when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
        // //     //                 then master.id_varian_2 
        // //     //         else  inventaris__asset__list__varian.id_varian_2

        // //     //     end=" . $varian_2);
        // //     if ($varian_3)
        // //         $whereRaw .= (" and
        // //         inventaris__asset__list__varian.id_varian_3=" . $varian_3);
        //     // $whereRaw .= ("
        //     // and case 
        //     //         when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
        //     //                 then master.id_varian_3 
        //     //         else  inventaris__asset__list__varian.id_varian_3 

        //     //     end=" . $varian_3);
        //     $db_utama_varian['where'][] = [$whereRaw, '', ''];
        //     $get_asset_varian = Database::database_coverter($page, $db_utama_varian, [], 'all');

        //     if (($get_asset_varian['num_rows'])) {

        //         // $id_asset_varian = $update['id_asset_varian'] = $get_asset_varian['row'][0]->id;

        //         DB::table('store__produk__varian');
        //         DB::whereRaw("id_store__produk=$id_produk");

        //         DB::whereRaw("id_barang_varian=$id_asset_varian");
        //         $produk_varian = DB::get();

        //         $id_produk_varian = ($produk_varian[0]->id);

        //         $update['id_produk_varian'] = $id_produk_varian;
        //         // $update['id_varian'] = $id_produk_varian;
        //     }
        // }

        $return = [];
        $url    = '<svg id="Capa_1" enable-background="new 0 0 512.005 512.005" height="100" viewBox="0 0 512.005 512.005" width="100" xmlns="http://www.w3.org/2000/svg" style="fill:#009688;filter: drop-shadow(0 5px 15px rgba(0, 150, 136, 0.20))">
                <g>
                    <path d="m512.004 192.508c0-10.448-8.501-18.949-18.949-18.949h-47.216c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.216c2.177 0 3.949 1.771 3.949 3.949v259.951l-103.457-127.207c-3.614-4.443-8.972-6.992-14.7-6.992h-87.397c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h87.396c1.194 0 2.31.531 3.063 1.457l106.828 131.351h-368.172c-1.194 0-2.311-.531-3.064-1.458l-101.59-124.91c-1.42-1.747-.824-3.51-.502-4.187.322-.678 1.315-2.253 3.566-2.253h235.448c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-131.801v-57.471c1.064.029 2.131.047 3.202.047h88.14c6.291 0 11.912-3.755 14.319-9.567 2.407-5.813 1.089-12.442-3.36-16.891l-12.683-12.683c17.591-19.995 27.565-45.138 28.461-71.862h24.729c1.055 0 2.047.411 2.792 1.156l21.044 21.044c-1.673 4.111-2.604 8.601-2.604 13.306 0 19.527 15.886 35.413 35.413 35.413 18.44 0 33.627-14.171 35.26-32.193h51.477c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-53.346c-4.866-13.751-17.993-23.632-33.39-23.632-9.329 0-17.822 3.632-24.154 9.55l-19.093-19.094c-3.579-3.579-8.337-5.55-13.399-5.55h-25.201c-1.839-19.271-8.462-37.674-19.464-53.761-2.339-3.419-7.006-4.295-10.425-1.957s-4.295 7.006-1.957 10.425c11.377 16.635 17.391 36.12 17.391 56.346 0 26.697-10.397 51.797-29.275 70.675-2.929 2.929-2.929 7.678 0 10.606l17.817 17.817c.126.126.236.236.108.544-.127.308-.282.308-.46.308h-88.14c-55.112 0-99.949-44.837-99.95-99.949 0-26.671 10.403-51.763 29.295-70.655s43.984-29.296 70.655-29.296c21.175 0 41.41 6.543 58.517 18.919 3.357 2.429 8.046 1.676 10.473-1.68 2.428-3.356 1.676-8.045-1.68-10.473-19.681-14.24-42.957-21.767-67.31-21.767-30.678 0-59.537 11.964-81.262 33.689-21.724 21.726-33.688 50.586-33.688 81.263 0 57.19 41.984 104.752 96.748 113.503v58.87h-88.647c-7.383 0-13.94 4.142-17.112 10.81-3.171 6.667-2.248 14.367 2.411 20.095l101.59 124.911c3.614 4.444 8.973 6.993 14.701 6.993h383.939c4.031.05 7.565-3.467 7.499-7.504v-281.057zm-189.928-27.581c11.255 0 20.413 9.157 20.413 20.413s-9.157 20.413-20.413 20.413-20.413-9.157-20.413-20.413 9.157-20.413 20.413-20.413z">
                    </path>
                    <path d="m276.722 406.47 25.889 34.017c3.289 4.322 8.495 6.902 13.926 6.902h101.018c4.784 0 9.075-2.663 11.2-6.949s1.645-9.314-1.252-13.122l-25.889-34.017c-3.289-4.322-8.495-6.902-13.926-6.902h-101.019c-4.784 0-9.076 2.663-11.2 6.95-2.124 4.288-1.644 9.315 1.253 13.121zm110.966-5.07c.776 0 1.52.369 1.989.986l22.834 30.003h-95.974c-.776 0-1.52-.369-1.989-.986l-22.834-30.003z">
                    </path>
                    <path d="m202.618 439.887c0 4.142 3.358 7.5 7.5 7.5h45.887c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-45.887c-4.142 0-7.5 3.358-7.5 7.5z">
                    </path>
                    <path d="m239.259 422.511c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-19.477c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z">
                    </path>
                    <path d="m178.918 115.292c0-6.01-2.341-11.661-6.59-15.909-4.25-4.25-9.9-6.591-15.91-6.591s-11.661 2.341-15.91 6.591l-14.685 14.685-14.683-14.686c-4.25-4.25-9.9-6.59-15.91-6.59s-11.661 2.341-15.91 6.59c-4.25 4.25-6.59 9.9-6.59 15.91s2.34 11.66 6.59 15.91l14.684 14.685-14.684 14.684c-4.25 4.25-6.59 9.9-6.59 15.91s2.341 11.661 6.59 15.909c4.25 4.25 9.9 6.591 15.91 6.591s11.661-2.341 15.91-6.59l14.684-14.685 14.685 14.685c4.25 4.25 9.9 6.59 15.91 6.59s11.66-2.34 15.91-6.59 6.59-9.9 6.59-15.91-2.34-11.66-6.59-15.91l-14.685-14.685 14.685-14.685c4.249-4.249 6.589-9.899 6.589-15.909zm-17.197 5.303-19.988 19.988c-2.929 2.929-2.929 7.678 0 10.606l19.988 19.988c1.417 1.417 2.197 3.3 2.197 5.303s-.78 3.887-2.197 5.303-3.3 2.197-5.303 2.197-3.887-.78-5.303-2.197l-19.988-19.988c-1.406-1.407-3.314-2.197-5.303-2.197s-3.897.79-5.303 2.197l-19.988 19.988c-1.416 1.416-3.299 2.196-5.303 2.196s-3.887-.78-5.303-2.197c-1.417-1.416-2.197-3.299-2.197-5.303 0-2.003.78-3.887 2.197-5.303l19.987-19.988c2.929-2.929 2.929-7.678 0-10.606l-19.987-19.988c-1.417-1.417-2.197-3.3-2.197-5.303s.78-3.887 2.197-5.303c1.416-1.417 3.299-2.197 5.303-2.197s3.887.78 5.303 2.197l19.987 19.988c1.406 1.407 3.314 2.197 5.303 2.197s3.897-.79 5.303-2.197l19.988-19.988c1.417-1.417 3.299-2.197 5.303-2.197s3.886.78 5.303 2.198c1.417 1.416 2.197 3.299 2.197 5.303.001 2.003-.779 3.886-2.196 5.303z">
                    </path>
                    <path d="m419.83 159.372c16.281 0 29.527-13.246 29.527-29.527s-13.246-29.527-29.527-29.527-29.527 13.246-29.527 29.527 13.246 29.527 29.527 29.527zm0-44.054c8.01 0 14.527 6.517 14.527 14.527s-6.517 14.527-14.527 14.527-14.527-6.517-14.527-14.527 6.517-14.527 14.527-14.527z">
                    </path>
                    <path d="m344.229 104.248c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l4.058-4.058 4.058 4.058c1.464 1.465 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.677 0-10.606l-4.058-4.058 4.058-4.058c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-4.058 4.058-4.058-4.058c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.677 0 10.606l4.058 4.058-4.058 4.058c-2.93 2.929-2.93 7.678 0 10.606z">
                    </path>
                    <path d="m28.317 295.193c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l7.065-7.065 7.065 7.065c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.678 0-10.606l-7.065-7.065 7.065-7.065c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-7.065 7.065-7.065-7.065c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.678 0 10.606l7.065 7.065-7.065 7.065c-2.93 2.928-2.93 7.677 0 10.606z">
                    </path>
                </g>
             </svg>';
        $url_file = null;
        if ($asset[0]->varian_barang == 1 and ! empty($id_produk_varian)) {

            $return = EcommerceApp::get_data_harga($page, $type, $id, 'all', $id_produk, 'YA', $qty, $id_produk_varian);

            //     DB::table('inventaris__asset__list__varian');
            //     DB::selectRaw('inventaris__asset__list__varian.asal_from_data_varian,
            //     case 
            //                 when inventaris__asset__list__varian.asal_from_data_varian =\'Master\' 
            //                         then master.is_asset_list_varian 
            //                 else  inventaris__asset__list__varian.is_asset_list_varian

            //             end as is_asset_list_varian,
            //             inventaris__asset__list__varian.foto_aset_varian as foto_ori,master.foto_aset_varian as foto_master, inventaris__asset__list.foto_aset as foto_asset');
            //     DB::joinRaw("inventaris__asset__list__varian as master on master.id = inventaris__asset__list__varian.id_master_varian", 'left');
            //     DB::joinRaw("inventaris__asset__list  on inventaris__asset__list.id = 
            //             case 
            //                 when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
            //                         then master.id_asset_list_varian 
            //                 else  inventaris__asset__list__varian.id

            //             end ", 'left');
            //     DB::whereRaw("inventaris__asset__list__varian.id=$id_asset_varian");
            //     $getfile = DB::get();

            //     // foto_aset_varian
            //     if ($getfile[0]->asal_from_data_varian == 'Master' and $getfile[0]->is_asset_list_varian == 1) {
            //         $id_file = $getfile[0]->foto_asset;
            //     } else  if ($getfile[0]->asal_from_data_varian == 'Master' and $getfile[0]->is_asset_list_varian == 0) {
            //         $id_file = $getfile[0]->foto_master;
            //     } else {
            //         $id_file = $getfile[0]->foto_ori;
            //     }
            //     if (!$id_file) {
            //         $id_file = -1;
            //     }

            //     DB::table('drive__file');
            //     DB::whereRaw("drive__file.id in ($id_file)");

            //     $file = DB::get();
            //     if (($file))
            //         $url_file = Partial::url_file($file[0]);
        } else {
            $return = EcommerceApp::get_data_harga($page, $type, $id, 'all', $id_produk, 'YA', $qty);
            //     DB::table('drive__file');
            //     DB::whereRaw("drive__file.ref_database='inventaris__asset__list'");
            //     DB::whereRaw("drive__file.ref_external_id=$id_asset");
            //     $file = DB::get();

            //     if (($file))
            //         $url_file = Partial::url_file($file[0]);
        }
        // if ($url_file) {
        //     $return['url_img'] = $url_file;
        //     $return['img_src'] = "<img src='$url_file' class='xzoom3' style=' height:auto;width:90%; border-radius: 10px;'>";
        // } else {
        //     $return['url_img'] = $url;
        //     $return['img_src'] = $url;
        // }
        // $type_return;

        // $id_asset = $cart[0]->id_asset;
        //     $id_produk = $cart[0]->id_produk;
        //     $id_produk_varian = $cart[0]->id_produk_varian;
        //     $id_asset_varian = $cart[0]->id_asset_varian;
        $return['id_produk']        = $id_produk;
        $return['id_barang']        = $id_asset;
        $return['id_barang_varian'] = $id_asset_varian;
        $return['id_produk_varian'] = $id_produk_varian;

        if ($type_return != 'detail') {
            $update['jumlah'] = $qty;
            // $update['id_varian_pra_order_1'] = $varian_1;;
            // $update['id_varian_pra_order_2'] = $varian_2;;
            // $update['id_varian_pra_order_3'] = $varian_3;;
            $update['checked'] = $checked ? 1 : 0;
            DB::update('erp__pos__pra_order', $update, "erp__pos__pra_order.id=$id_cart");
            $return    = array_merge($return, $update);
            $id_detail = EcommerceApp::cheked_pesan($page, $id_cart, $checked, $return);
        }
        if ($type_return == 'id_detail') {
            return $id_detail;
        } else {

            $print = EcommerceApp::print_pesanan($page, $type, $id);
            // $lainnya['id_varian'] =  $id_asset_varian;
            // $stok =  ErpPosApp::get_stok($page, 0, "", "", ($id_asset ?? -1), 'exe_rekap_akhir_total_asset', $lainnya);

            // $return['stok_akhir'] = $stok['num_rows'] ? $stok['row'][0]->stok : 0;
            $return['print_summary'] = $print['summary'];
            $return['status']        = 1;
            if ($type_return == 'json') {
                echo json_encode($return);
            } else {
                return $return;
            }
        }
    }

    public static function cheked_pesan($page, $id_cart, $checked, $return)
    {
        if (Partial::input('id_group_pemesanan')) {
            $id_group_pemesanan = Partial::input('id_group_pemesanan');
        } else {
            $pemesanan_grup     = EcommerceApp::inisiate_store_pesanan_group($page);
            $id_group_pemesanan = $pemesanan_grup['id'];
        }
        $id_pemesanan = null;
        if (Partial::input('id_pemesanan')) {

            // $pemesanan = EcommerceApp::inisiate_store_pesanan($page);
            $id_pemesanan = Partial::input('id_pemesanan');
        }
        //echo 'HAL';
        if ($checked) {

            $insert['id_cart'] = $id_cart;
            if ($id_pemesanan) {
                $insert['id_erp__pos__utama'] = $id_pemesanan;
            }

            $insert['id_erp__pos__group'] = $id_group_pemesanan;

            $insert['id_inventaris__asset__list'] = $return['id_barang'];
            $insert['id_barang_varian']           = $return['id_barang_varian'];
            $insert['grand_total']                = $return['harga_jual_qty'] - $return['total_diskon_keseluruhan'];
            $insert['berat_satuan']               = (int) $return['berat_satuan'];
            $insert['berat_total']                = $return['berat_total'];
            $insert['qty_pesanan']                = $return['jumlah'];
            $insert['qty']                        = $return['jumlah'];
            $insert['harga_penjualan']            = $return['harga_jual'];
            $insert['total_harga']                = $return['harga_jual_qty'];
            $insert['id_store_toko']              = $return['id_toko'];
            $insert['id_produk']                  = $return['id_produk'];
            if (isset($return['id_produk_varian'])) {
                $insert['id_varian'] = $return['id_produk_varian'];
            }
            $insert['diskon_utama'] = $return['diskon_keseluruhan'];
            $insert['tipe_diskon']  = "Presentase";
            $insert['total_diskon'] = $return['total_diskon_keseluruhan'];

            DB::table('erp__pos__utama__detail');
            DB::whereRaw("id_cart=$id_cart");
            // $insert['id_harga'] =  isset($return['id_harga']) ? $return['id_harga'] : 0;
            DB::whereRaw("id_erp__pos__group=$id_group_pemesanan");
            $get = DB::get('all');
            if ($get['num_rows']) {
                DB::update('erp__pos__utama__detail', $insert, "id=" . $get['row'][0]->id);
                $inser_last_id = $get['row'][0]->id;
            } else {
                $inser_last_id = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $insert, [], 'erp__pos__utama__detail', []);
            }
            // $insert['id_bundle_harga_pesan'] = isset($return['bundle_harga']) ? $return['bundle_harga'] : 0;
            // $insert['jenis'] = "Produk";

            foreach ($return['list_potongan'] as $lp) {
                $insert_potongan                               = [];
                $insert_potongan["id_erp__pos__utama__detail"] = $inser_last_id;
                // DB::whereRaw("id_erp__pos__utama=$id_pemesanan");
                $insert_potongan['id_erp__pos__group']                = $id_group_pemesanan;
                $insert_potongan["id_inventaris__asset__list_diskon"] = $return['id_barang'];
                $insert_potongan["id_diskon_relation"]                = $lp['primary_key'];
                $insert_potongan["jenis_diskon"]                      = $lp['jenis'];
                DB::table('erp__pos__utama__detail__diskon');
                foreach ($insert_potongan as $where_key => $where_value) {

                    DB::whereRaw("$where_key::text='$where_value'");
                }
                $get                                          = DB::get('all');
                $insert_potongan["harga_jual_diskon"]         = $lp['harga_jual_diskon'];
                $insert_potongan["margin_diskon"]             = $lp['margin_promo'];
                $insert_potongan["tipe_margin_diskon"]        = $lp['tipe_margin_promo'];
                $insert_potongan["total_diskon"]              = $lp['harga_diskon'];
                $insert_potongan["informasi_diskon_relation"] = $lp['informasi'];
                if (isset($lp['maksimal_margin'])) {
                    $insert_potongan["maksimal_margin"] = $lp['maksimal_margin'];
                }

                $insert_potongan["nama_promo"] = $lp['nama_promo'];

                if ($get['num_rows'] > 1) {
                    foreach ($get['row'] as $hapus) {

                        DB::delete('erp__pos__utama__detail__diskon', "id=" . $hapus->id);
                    }
                    CRUDFunc::crud_insert(new MainFaiFramework(), $page, $insert_potongan, [], 'erp__pos__utama__detail__diskon', []);
                } else
                if ($get['num_rows'] == 1) {
                    DB::update('erp__pos__utama__detail__diskon', $insert_potongan, "id=" . $get['row'][0]->id);
                } else
                if ($get['num_rows'] == 0) {
                    CRUDFunc::crud_insert(new MainFaiFramework(), $page, $insert_potongan, [], 'erp__pos__utama__detail__diskon', []);
                }

                //sync stok if api
                // EcommerceApp::sync_update_stok($page, $return['id_produk'], $return['id_barang'], $return['id_barang_varian']);
                // $insert_potongan['id_erp__pos__utama'] = $id_pemesanan;

            }
            return $inser_last_id;
        } else {
            DB::delete('erp__pos__utama__detail', [('id_cart   =' . $id_cart), ('id_erp__pos__group=' . $id_group_pemesanan)], "Where Array");
        }
    }

    public static function print_pesanan($page, $type, $id, $id_pesanan = null, $type_return = 'cart')
    {
        $fai = new MainFaiFramework();
        // $insert_potongan["id_store_produk_diskon"] = $return['id_produk'];
        // $insert_potongan["id_barang_varian_diskon"] = $return['id_barang_varian'];
        // $insert_potongan["id_produk_varian_diskon"] = $return['id_produk_varian'];
        // if (!$id_pesanan and Partial::input('pesanan')) {
        //     $type_return = "json";
        //     $id_pesanan = Partial::input('pesanan');;
        // } else
        // if (!$id_pesanan) {
        //     $pemesanan = EcommerceApp::inisiate_store_pesanan($page);
        //     $id_pesanan = $pemesanan['id'];;
        // }
        $id_group_pemesanan = $id_pesanan;
        if (! $id_pesanan and Partial::input('pesanan')) {
            $type_return        = "json";
            $id_group_pemesanan = Partial::input('pesanan');
        } else
        if (! $id_group_pemesanan) {
            $pemesanan_grup = EcommerceApp::inisiate_store_pesanan_group($page);

            $id_group_pemesanan = $pemesanan_grup['id'] ?? -1;
        }
        if ($id_group_pemesanan and Partial::input('pesanan') == $id_group_pemesanan) {
            $type_return = "json";
        }

        $string_promo_voucher_aktif = "";
        $string_promo_voucher_all   = "";

        $i = 0;
        DB::selectRaw('*,erp__pos__utama__detail__diskon.id as primary_key');
        DB::table('erp__pos__utama__detail__diskon');
        DB::whereRaw("erp__pos__utama__detail__diskon.id_erp__pos__group =$id_group_pemesanan");
        DB::whereRaw("jenis_diskon ='Voucher'");

        $promo['voucher']['aktif'] = [];
        $promo_voucher             = DB::get('all');
        $i                         = 0;
        if ($promo_voucher['num_rows']) {

            foreach ($promo_voucher['row'] as $voucher) {
                $promo['voucher']['aktif']['id'][$i]                 = $voucher->id_diskon_relation;
                $promo['voucher']['aktif']['id_detail_diskon'][$i]   = $voucher->primary_key;
                $promo['voucher']['aktif']['id_store'][$i]           = $voucher->id_store;
                $promo['voucher']['aktif']['tipe_diskon'][$i]        = $voucher->tipe_diskon;
                $promo['voucher']['aktif']['margin_diskon'][$i]      = $voucher->margin_diskon;
                $promo['voucher']['aktif']['tipe_margin_diskon'][$i] = $voucher->tipe_margin_diskon;
                $promo['voucher']['aktif']['nama_promo'][$i]         = $voucher->nama_promo;
                $to_string_promo_voucher_aktif                       = "<div class='card'>";
                $to_string_promo_voucher_aktif .= "<div class='card-body'>
                                <h5>" . $voucher->nama_promo . '</h5>

                                 ';
                $to_string_promo_voucher_aktif .= "
                    Diskon " . $voucher->tipe_diskon . " " . ($voucher->tipe_margin_diskon == 'Rp' ? 'Rp. ' : '') . $voucher->margin_diskon . ($voucher->tipe_margin_diskon == '%' ? '%. ' : '');
                $to_string_promo_voucher_aktif .= "
                        <a type='button' onclick='batalkan_voucher(" . $voucher->primary_key . ")' class='' href='javascript:void(0)'>Batalkan Voucher</a>
                        </div>
                    </div>";

                $promo['voucher']['aktif'][$i]['informasi'] = $to_string_promo_voucher_aktif;

                $string_promo_voucher_aktif .= $to_string_promo_voucher_aktif;

                $promo['voucher']['aktif']['collect_id_store'][$voucher->id_store][] = $i;
                $i++;
            }
        }

        DB::selectRaw('*,store__voucher.id as primary_key');
        DB::table('store__voucher');

        // if ($id_pesanan and Partial::input('pesanan') == $id_pesanan) {
        DB::whereRaw("store__voucher.sisa_pengunaan_voucher >0");
        if (isset($promo['voucher']['aktif']['id'])) {
            DB::whereRaw("store__voucher.id not in (" . implode(',', $promo['voucher']['aktif']['id']) . ")");
        }

        DB::whereRaw("'" . date('Y-m-d H:i:s') . "' >= berlaku_dari");
        DB::whereRaw("'" . date('Y-m-d H:i:s') . "' <= berlaku_sampai");
        $promo_voucher = DB::get('all');
        $promo_voucher['query'];
        $promo['voucher']['all'] = [];
        $total_nominal_voucher   = 0;
        if ($promo_voucher['num_rows']) {
            foreach ($promo_voucher['row'] as $voucher) {

                $i++;
                $promo['voucher']['all'][$i]['kode_promo']                = $voucher->kode_voucher;
                $promo['voucher']['all'][$i]['nama_promo']                = $voucher->nama_voucher;
                $promo['voucher']['all'][$i]['margin_promo_voucher']      = $voucher->margin_promo;
                $promo['voucher']['all'][$i]['tipe_margin_promo_voucher'] = $voucher->tipe_margin;
                $promo['voucher']['all'][$i]['primary_key']               = $voucher->primary_key;
                $promo['voucher']['all'][$i]['maksimal_margin']           = $voucher->maksimal_margin;
                $promo['voucher']['all'][$i]['jenis_voucher']             = $voucher->voucher;
                $to_string_promo_voucher_aktif                            = "<div class='card'>";
                $to_string_promo_voucher_aktif .= "<div class='card-body'>
                                <h5>" . $voucher->nama_voucher . '</h5>

                                 ';
                $to_string_promo_voucher_aktif .= "
                    Diskon " . $voucher->voucher . " " . ($voucher->tipe_margin == 'Rp' ? 'Rp. ' : '') . $voucher->margin_promo . ($voucher->tipe_margin == '%' ? '%. ' : '');
                $to_string_promo_voucher_aktif .= "
                        <a type='button' onclick='gunakan_voucher(" . $voucher->primary_key . ")' class='' href='javascript:void(0)'>Gunakan Voucher</a>
                        </div>
                    </div>";

                $promo['voucher']['all'][$i]['informasi'] = $to_string_promo_voucher_aktif;

                $string_promo_voucher_all .= $to_string_promo_voucher_aktif;
            }
        }

        //     $type_return = "json";
        // }
        // DB::whereRaw("store__voucher.id_toko = $id_toko");
        // DB::selectRaw('*,erp__pos__utama__detail.id as id_detail
        // ,erp__pos__group.id_payment as id_payment
        // ,store__produk.id_toko

        // ,inventaris__asset__tanah__bangunan.*
        unset($db);
        $db['select'][] = "
                erp__pos__utama__detail.id_store_toko,store__produk.id_toko,store__produk.id_asset,erp__pos__utama__detail.id_produk,
                erp__pos__group.id_payment,erp__pos__utama__detail.id as id_detail,

                berat,berat_varian,berat_satuan,berat_total,varian_barang,qty,harga_penjualan,total_harga,erp__pos__group.total_diskon,
                nama_barang,nama_varian
        ,erp__pos__group.id_payment as id_payment
        ,store__produk.id_toko
        ,inventaris__asset__tanah__bangunan.*
        ,erp__pos__utama__detail.*
        ,erp__pos__utama__detail.id_erp__pos__utama,
        erp__pos__group.status as status_group
        ";
        $db['utama']   = "erp__pos__utama__detail";
        $db['join'][]  = ["erp__pos__group", "erp__pos__group.id", "erp__pos__utama__detail.id_erp__pos__group", "inner"];
        $db['join'][]  = ["erp__pos__utama", " erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", "left"];
        $db['join'][]  = ["erp__pos__pra_order", " erp__pos__pra_order.id", "erp__pos__utama__detail.id_cart and erp__pos__pra_order.status_pra_order = erp__pos__group.status and erp__pos__pra_order.active=1", "inner"];
        $db['join'][]  = ["erp__pos__payment", " erp__pos__payment.id", "erp__pos__group.id_payment", "left"];
        $db['join'][]  = ["store__produk", " store__produk.id", "erp__pos__utama__detail.id_produk", "inner"];
        $db['join'][]  = ["store__toko", " store__toko.id", "store__produk.id_toko", "inner"];
        $db['join'][]  = ["inventaris__asset__tanah__bangunan", " inventaris__asset__tanah__bangunan.id", "store__toko.id_inventory_bangunan_toko", "inner"];
        $db['join'][]  = ["inventaris__asset__list_query", " inventaris__asset__list.id", "store__produk.id_asset", "inner"];
        $db['join'][]  = ["inventaris__asset__list__varian", " inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list and id_barang_varian = inventaris__asset__list__varian.id", "left"];
        $db['where'][] = ["erp__pos__utama__detail.id_erp__pos__group", "=", "$id_group_pemesanan"];
        $db['where'][] = ["qty", ">=", 1];

        $get_detail           = Database::database_coverter($page, $db, [], 'all');
        $return['pembayaran'] = "";
        // ,erp__pos__utama__detail.*
        if (($get_detail['num_rows'])) {
            if ($get_detail['row'][0]->id_payment) {
                DB::table('erp__pos__payment__bayar');
                DB::whereRaw("id_erp__pos__payment=" . $get_detail['row'][0]->id_payment);
                $get_bayar = DB::get();
                foreach ($get_bayar as $get_bayar) {
                    $return['pembayaran'] .= "<Br>
                <div class='font-size:18px;'>
                <b>Informasi Pembayaran</b><br>

                Status Bayar: $get_bayar->status_bayar <Br>
                <div style='font-size:22px;font-weight:700'>" . Partial::rupiah($get_bayar->jumlah_bayar) . "</div>
                $get_bayar->brand_nama <Br>";
                    if ($get_bayar->va_number and $get_bayar->id_payment_api) {
                        $return['pembayaran'] .= "Vitual Account Number : <br><h4>$get_bayar->va_number</h4><br> expired date:";
                    } else {
                        $return['pembayaran'] .= "
                $get_bayar->no_rek <Br>
                a.n  <Br>

                        <br>
                        <br>
                        <a href='" . Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "konfirmasi_pembayaran", "tambah", $get_bayar->id], 'menu', 'just_link') . "'>
                            Konfirmasi pembayaran
                        </a>

                ";
                    }
                    $return['pembayaran'] .= "</div>";
                }
            }

            $return['table'] = '<table class="table table-centered  w-100">
            <thead class="table-light text-nowrap ">
                <tr>

                    <th scope="col">Produk </th>
                    <th scope="col">Varian </th>
                    <th scope="col">QTY</th>
                    <th scope="col">Berat Satuan</th>
                    <th scope="col">Berat Total</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Diskon Total</th>
                    <th scope="col">Grand Total</th>
                </tr>
            </thead>
            <tbody>';
            $id_store           = [];
            $id_store_kota      = [];
            $product_store_kota = [];
            $berat              = 0;
            $qty                = 0;
            $sub_total          = 0;
            $total_diskon       = 0;
            $grand_total        = 0;
            foreach ($get_detail['row'] as $detail) {
                if (isset($detail->id_store_toko) and empty($detail->id_toko)) {
                    $detail->id_toko = $detail->id_store_toko;
                }
                if (! in_array($detail->id_store_toko, $id_store)) {
                    $id_store[] = $detail->id_store_toko;
                }

                if (isset($berat[$detail->id_store_toko])) {
                }
                // ,erp__pos__utama__detail.id_erp__pos__utama
                // ');
                $pemesanan    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, $detail->id_store_toko, $detail->status_group);
                $id_pemesanan = $pemesanan['id'];

                if (! $detail->id_erp__pos__utama) {

                    $update_detail['id_erp__pos__utama'] = $id_pemesanan;
                    DB::update('erp__pos__utama__detail', $update_detail, [('id=' . $detail->id_detail)]);
                    $product_store_kota[$detail->id_toko]['id_pemesanan'] = $id_pemesanan;
                }

                $id_store_kota[$detail->id_toko]                     = $detail->id_kota;
                $product_store_kota[$detail->id_toko]['id_asset'][]  = $detail->id_asset;
                $product_store_kota[$detail->id_toko]['id_toko'][]   = $detail->id_toko;
                $product_store_kota[$detail->id_toko]['id_produk'][] = $detail->id_produk;
                $update_berat                                        = [];
                if (! $detail->berat_satuan) {
                    $detail->berat_satuan         = $detail->varian_barang == '1' ? $detail->berat_varian : $detail->berat;
                    $update_berat['berat_satuan'] = $detail->berat_satuan;
                }
                if (! $detail->berat_total) {
                    $detail->berat_total         = $detail->varian_barang == '1' ? $detail->berat_varian * $detail->qty : $detail->berat * $detail->qty;
                    $update_berat['berat_total'] = $detail->berat_total;
                }
                if (count($update_berat)) {
                    DB::update('erp__pos__utama__detail', $update_berat, [('id=' . $detail->id_detail)]);
                }
                $product_store_kota[$detail->id_toko]['berat_total'][]  = $detail->berat_total;
                $product_store_kota[$detail->id_toko]['berat_satuan'][] = $detail->berat_satuan;
                $product_store_kota[$detail->id_toko]['qty'][]          = $detail->qty;
                if (isset($product_store_kota[$detail->id_toko]['jumlah_berat'])) {
                    $product_store_kota[$detail->id_toko]['jumlah_berat'] += $detail->berat_total;
                } else {
                    $product_store_kota[$detail->id_toko]['jumlah_berat'] = $detail->berat_total;
                }

                if (isset($product_store_kota[$detail->id_toko]['harga_penjualan'])) {
                    $product_store_kota[$detail->id_toko]['harga_penjualan'] += $detail->harga_penjualan;
                } else {
                    $product_store_kota[$detail->id_toko]['harga_penjualan'] = $detail->harga_penjualan;
                }

                if (isset($product_store_kota[$detail->id_toko]['total_harga'])) {
                    $product_store_kota[$detail->id_toko]['total_harga'] += $detail->total_harga;
                } else {
                    $product_store_kota[$detail->id_toko]['total_harga'] = $detail->total_harga;
                }

                $product_store_kota[$detail->id_toko]['detail'] = $detail;
                $return['table'] .= '
                <tr>
                    <td class="text-nowrap">
                        ' . $detail->nama_barang . '
                        </td>
                    ';
                if ($detail->varian_barang == 1 and $detail->id_varian) {

                    $return['table'] .= '<td>  ' . $detail->nama_varian . '</td> ';
                } else {
                    $return['table'] .= '<td></td> ';
                }
                $return['table'] .= '

                    <td>' . $detail->qty . '</td>
                    <td>' . $detail->berat_satuan . '</td>
                    <td>' . $detail->berat_total . '</td>
                    <td>' . Partial::rupiah($detail->harga_penjualan) . '

                    </td>
                    <td class="text-nowrap">' . Partial::rupiah($detail->total_harga) . '
                    </td>
                    <td class="text-nowrap"> ' . Partial::rupiah($detail->total_diskon) . '
                    </td>
                    <td class="text-nowrap"> ' . Partial::rupiah($detail->total_harga - $detail->total_diskon) . '
                    </td>
                </tr>';
                $berat += $detail->berat * $detail->qty;
                $qty += $detail->qty;
                $sub_total += $detail->total_harga;
                $total_diskon += $detail->total_diskon;
                $grand_total += $detail->total_harga - $detail->total_diskon;
            }
            $return['table'] .= "
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan=2> TOTAL</th>
                        <th> " . Partial::rupiah($qty, 0, '') . "</th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th class='text-nowrap'> " . Partial::rupiah($sub_total) . "</th>
                        <th class='text-nowrap'> " . Partial::rupiah($total_diskon) . "</th>
                        <th class='text-nowrap'> " . Partial::rupiah($grand_total) . "</th>

                    </tr>
                </tfoot>

             ";
            foreach ($product_store_kota as $id_toko => $psk) {

                if (count($promo['voucher']['aktif'])) {
                    if (in_array($id_toko, $promo['voucher']['aktif']['id_store'])) {
                        for ($s = 0; $s < count($promo['voucher']['aktif']['collect_id_store'][$id_toko]); $s++) {
                            $id_collect = $promo['voucher']['aktif']['collect_id_store'][$id_toko][$s];
                            if ($promo['voucher']['aktif']['tipe_diskon'][$id_collect] == 'Produk') {
                                $harga_jual_diskon = $psk['total_harga'];
                                if ($promo['voucher']['aktif']['tipe_margin_diskon'][$id_collect] == '%') {

                                    $total_diskon_voucher = (float) ($harga_jual_diskon * $promo['voucher']['aktif']['margin_diskon'][$id_collect] / 100);
                                } else {
                                    $total_diskon_voucher = $promo['voucher']['aktif']['margin_diskon'][$id_collect];
                                    if ($total_diskon_voucher > $harga_jual_diskon) {
                                        $total_diskon_voucher = $harga_jual_diskon;
                                    }
                                }
                                $update_diskon['total_diskon']      = $total_diskon_voucher;
                                $update_diskon['harga_jual_diskon'] = $harga_jual_diskon;
                                DB::update('erp__pos__utama__detail__diskon', $update_diskon, [('id=' . $promo['voucher']['aktif']['id_detail_diskon'][$id_collect])]);
                                $total_nominal_voucher += $total_diskon_voucher;
                            }
                        }
                    }
                }
            }

            $return['table'] .= '

                    </tbody>
                </table>';
            $return['ongkir'] = "";
            if (isset($_SESSION['id_apps_user'])) {

                DB::table('erp__pos__group');
                DB::joinRaw('inventaris__asset__tanah__bangunan on id_kirim_ke = inventaris__asset__tanah__bangunan.id', 'left');

                DB::whereRaw("erp__pos__group.id=$id_group_pemesanan");
                $get_all = DB::get('all');
                if (! $get_all['row'][0]->id_kirim_ke) {

                    DB::selectRaw('inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan');
                    DB::table('inventaris__asset__tanah__bangunan__pengisi');
                    DB::joinRaw('inventaris__asset__tanah__bangunan on inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan = inventaris__asset__tanah__bangunan.id');
                    DB::whereRaw("inventaris__asset__tanah__bangunan__pengisi.id_apps_user='" . $_SESSION['id_apps_user'] . "'");
                    DB::whereRaw("default_pembelian_barang=1");
                    $get_rumah = DB::get('all');

                    if (! $get_rumah['num_rows']) {
                        DB::selectRaw('inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan');
                        DB::table('inventaris__asset__tanah__bangunan__pengisi');
                        DB::joinRaw('inventaris__asset__tanah__bangunan on inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan = inventaris__asset__tanah__bangunan.id');
                        DB::whereRaw("inventaris__asset__tanah__bangunan__pengisi.id_apps_user='" . $_SESSION['id_apps_user'] . "'");

                        $get_rumah = DB::get('all');
                    }
                    if ($get_rumah['num_rows']) {

                        $data['id_kirim_ke'] = $get_rumah['row'][0]->id_inventaris__asset__tanah__bangunan;
                        // echo $get_detail['query'];
                        DB::update('erp__pos__utama', $data, ["id_erp__pos__group=$id_group_pemesanan"]);
                        DB::update('erp__pos__group', $data, ["id=$id_group_pemesanan"]);

                        DB::table('erp__pos__group');
                        DB::joinRaw('inventaris__asset__tanah__bangunan on id_kirim_ke = inventaris__asset__tanah__bangunan.id', 'left');

                        DB::whereRaw("erp__pos__group.id=$id_group_pemesanan");
                        $get_all = DB::get('all');
                    }
                }

                // print_R($detail);
                if ($get_all['row'][0]->id_kirim_ke) {
                    $id_kota_user = $get_all['row'][0]->id_kota;

                    for ($i = 0; $i < count($id_store); $i++) {
                        $pemesanan    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, $id_store[$i], $get_all['row'][0]->status);
                        $id_pemesanan = $pemesanan['id'];
                        DB::selectRaw('*');
                        DB::selectRaw('erp__pos__delivery_order.id as id_detail');
                        DB::table('erp__pos__delivery_order');
                        DB::joinRaw('store__toko on id_store_ongkir = store__toko.id');
                        DB::whereRaw("id_erp__pos__utama=$id_pemesanan");
                        if ($id_store[$i]) {
                            DB::whereRaw("id_store_ongkir=" . $id_store[$i]);
                        }

                        $get_ongkir = DB::get('all');
                        if ($get_ongkir['num_rows']) {
                            $paket = explode('-', $get_ongkir['row'][0]->paket_ongkir);
                            $return['ongkir'] .= '
                                <div id="ongkir-' . $id_store[$i] . '">
                                <div class="card card-bordered shadow-none mb-2">

                                    <div class="card-body">

                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <!-- img -->
                                            <div class="d-flex align-items-start">

                                                <!-- text -->
                                                <div class="ms-2">
                                                    <h6 class="mb-1"> ' . $get_ongkir['row'][0]->nama_toko . '</h6>
                                                    <h5 class="mb-1"> ' . strtoupper(isset($paket[0]) ? $paket[0] : '') . ' ' . strtoupper(isset($paket[1]) ? $paket[1] : '') . '
                                                    <button class="btn btn-primary btn-sm" type="button" onclick="get_ubah_ongkir(' . "'" . $id_store[$i] . "' ,'" . $id_kota_user . "','" . $product_store_kota[$id_toko]['jumlah_berat'] . "','" . $id_store_kota[$id_store[$i]] . "'" . ')">Ubah</button></h5>
                                                                        <span class="fs-6">Estimasi Kirim ' . $get_ongkir['row'][0]->estimasi_kirim . ' Hari</span>
                                                </div>
                                            </div>
                                            <!-- text -->
                                            <div>
                                                <h3 class="mb-0">' . Partial::rupiah($get_ongkir['row'][0]->ongkir) . '
                                                <input type="hidden" class="ongkir_terpilih" value="' . $get_ongkir['row'][0]->ongkir . '">
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>';
                            $ongkir_akhir = $get_ongkir['row'][0]->ongkir;
                        } else {

                            $ongkir = OngkirApp::print_ongkir(
                                $id_store[$i],
                                $id_kota_user,
                                $product_store_kota[$id_toko]['jumlah_berat'],
                                'first_ongkir',
                                $id_store_kota[$id_store[$i]]
                            );

                            $return['ongkir'] .= $ongkir['print'];
                            $page['crud']['save_type'] = "insert";
                            $update                    = CRUDFunc::declare_crud_variable($fai, $page, [], 'erp__pos__delivery_order', '', [], ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_do'))['$sqli'];
                            $update['paket_ongkir']    = $ongkir['paket_ongkir'];
                            $update['estimasi_kirim']  = $ongkir['estimasi_kirim'];
                            $update['tanggal_do']      = date('Y-m-d');
                            $list_data_alamat[]        = "id_provinsi";
                            $list_data_alamat[]        = "id_kota";
                            $list_data_alamat[]        = "id_kecamatan";
                            $list_data_alamat[]        = "id_kelurahan";
                            $list_data_alamat[]        = "nomor";
                            $list_data_alamat[]        = "alamat";
                            $list_data_alamat[]        = "rt";
                            $list_data_alamat[]        = "rw";
                            for ($lda = 0; $lda < count($list_data_alamat); $lda++) {
                                $nama_row = $list_data_alamat[$lda];
                                if ($nama_row == 'nomor') {
                                    $nama_row = 'nomor_bangunan';
                                }
                                if ($product_store_kota[$id_store[$i]]['detail']->$nama_row) {
                                    $update[$list_data_alamat[$lda] . '_asal'] = $product_store_kota[$id_store[$i]]['detail']->$nama_row;
                                }

                                if ($get_all['row'][0]->$nama_row) {
                                    $update[$list_data_alamat[$lda] . '_tujuan'] = $get_all['row'][0]->$nama_row;
                                }
                            }
                            // echo '<br>';
                            $update['ongkir']          = $ongkir['harga_ongkir'];
                            $update['id_store_ongkir'] = $id_store[$i];

                            $update['create_date']        = date('Y-m-d');
                            $update['id_erp__pos__utama'] = $id_pemesanan;
                            $update['total_berat']        = $product_store_kota[$id_store[$i]]['jumlah_berat'];
                            $ongkir_akhir                 = $update['ongkir_akhir']                 = $update['ongkir'];
                            $paket_ongkir                 = explode('-', $ongkir['paket_ongkir']);
                            if (isset($paket_ongkir[0])) {

                                DB::queryRaw($page, "select * from webmaster__ekspedisi where kode_ekspedisi='" . $paket_ongkir[0] . "'");
                                $eks = DB::get('all');
                                if (! $eks['num_rows']) {
                                    $insert_eks['kode_ekspedisi'] = $paket_ongkir[0];
                                    CRUDFunc::crud_insert($fai, $page, $insert_eks, [], "webmaster__ekspedisi", []);
                                    DB::queryRaw($page, "select * from webmaster__ekspedisi where kode_ekspedisi='" . $paket_ongkir[0] . "'");
                                    $eks = DB::get('all');
                                }
                                $update['id_ekpedisi'] = $eks['row'][0]->id;
                            }
                            if (isset($paket_ongkir[1])) {
                                DB::queryRaw($page, "select * from webmaster__ekspedisi__service where kode_service='" . $paket_ongkir[1] . "'");
                                $eks = DB::get('all');
                                if (! $eks['num_rows']) {
                                    $insert_eks_s['id_webmaster__ekspedisi'] = $eks['row'][0]->id;
                                    $insert_eks_s['kode_service']            = $paket_ongkir[1];
                                    CRUDFunc::crud_insert($fai, $page, $insert_eks_s, [], "webmaster__ekspedisi__service", []);
                                    DB::queryRaw($page, "select * from webmaster__ekspedisi__service where kode_service='" . $paket_ongkir[1] . "'");
                                    $eks = DB::get('all');
                                }
                                $update['id_service'] = $eks['row'][0]->id;
                            }

                            $id_delivery_order = CRUDFunc::crud_insert($fai, $page, $update, [], "erp__pos__delivery_order", []);

                            $product_store_kota[$id_store[$i]]['id_asset'];
                            for ($psk = 0; $psk < count($product_store_kota[$id_store[$i]]['id_asset']); $psk++) {

                                $data_detail_do['id_erp__pos__delivery_order']   = $id_delivery_order;
                                $data_detail_do['id_erp__pos__utama']            = $id_pemesanan;
                                $data_detail_do['id_inventaris__asset__list_do'] = $product_store_kota[$id_store[$i]]['id_asset'][$psk];

                                $data_detail_do['qty_pesan_do']    = $product_store_kota[$id_store[$i]]['qty'][$psk];
                                $data_detail_do['berat_satuan_do'] = $product_store_kota[$id_store[$i]]['berat_satuan'][$psk];
                                $data_detail_do['berat_total_do']  = $product_store_kota[$id_store[$i]]['berat_total'][$psk];
                                $data_detail_do['qty_kirim']       = $product_store_kota[$id_store[$i]]['qty'][$psk];
                                $data_detail_do['sisa_qty_kirim']  = 0;
                                $id_delivery_order                 = CRUDFunc::crud_insert($fai, $page, $data_detail_do, [], "erp__pos__delivery_order__detail", []);
                            }
                        }
                        if (count($promo['voucher']['aktif'])) {

                            if (in_array($id_store[$i], $promo['voucher']['aktif']['id_store'])) {
                                for ($s = 0; $s < count($promo['voucher']['aktif']['collect_id_store'][$id_store[$i]]); $s++) {
                                    $id_collect = $promo['voucher']['aktif']['collect_id_store'][$id_store[$i]][$s];
                                    if ($promo['voucher']['aktif']['tipe_diskon'][$id_collect] == 'Ongkir') {
                                        $harga_jual_diskon = $ongkir_akhir;
                                        if ($promo['voucher']['aktif']['tipe_margin_diskon'][$id_collect] == '%') {

                                            $total_diskon_voucher = (float) ($harga_jual_diskon * $promo['voucher']['aktif']['margin_diskon'][$id_collect] / 100);
                                        } else {
                                            $total_diskon_voucher = $promo['voucher']['aktif']['margin_diskon'][$id_collect];
                                            if ($total_diskon_voucher > $harga_jual_diskon) {
                                                $total_diskon_voucher = $harga_jual_diskon;
                                            }
                                        }
                                        $update_diskon['total_diskon']      = $total_diskon_voucher;
                                        $update_diskon['harga_jual_diskon'] = $harga_jual_diskon;
                                        DB::update('erp__pos__utama__detail__diskon', $update_diskon, [('id=' . $promo['voucher']['aktif']['id_detail_diskon'][$id_collect])]);

                                        $total_nominal_voucher += $total_diskon_voucher;
                                    }
                                }
                            }
                        }
                        EcommerceApp::total_biaya_pengiriman($page, $type, $id, $id_group_pemesanan, $id_pemesanan, 'ongkir_toko');
                    }
                }
            }

            unset($update);
            $update['sub_total']    = $sub_total;
            $update['total_qty']    = $qty;
            $update['total_diskon'] = $total_diskon;
            $update['voucher']      = $total_nominal_voucher;

            $biaya_pengiriman = EcommerceApp::total_biaya_pengiriman($page, $type, $id, $id_group_pemesanan);

            $update['total'] = $sub_total + $biaya_pengiriman - $total_diskon - $total_nominal_voucher;

            DB::update('erp__pos__group', $update, [('id=' . $id_group_pemesanan)]);

            DB::table('erp__pos__group');
            DB::selectRaw('*');
            DB::whereRaw("id=$id_group_pemesanan");
            // print_R($data);
            $get_total = DB::get("all");
            $get_total["query"];
            $get_total = $get_total['row'];
            //
            $page['template'];
            $return['summary'] = '';

            if ($type_return !== 'invoice') {
                // $update['jenis'] = 'Ongkir';
            }

            $return['summary'] .= '


                <div id="detail-order">

            <ul class="list-unstyled mb-0">
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> QTY Produk </span>
                <span>' . ($get_total[0]->total_qty) . ' pcs </span>

                </li>
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> Sub Total</span>
                <span>' . Partial::rupiah($get_total[0]->sub_total) . '</span>

                </li>';
            if (($get_total[0]->biaya_pengiriman)) {
                $return['summary'] .= '
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> Total Ongkir </span>
                <span>' . Partial::rupiah($get_total[0]->biaya_pengiriman) . '</span>

                </li>';
            }
            if (($get_total[0]->total_diskon)) {
                $return['summary'] .= '
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black; font-weight:700">
                <span>Diskon </span>
                <span>' . Partial::rupiah($get_total[0]->total_diskon) . '</span>

                </li>';
            }
            if (($get_total[0]->voucher)) {
                $return['summary'] .= '
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black; font-weight:700">
                <span>Vourcher </span>
                <span>' . Partial::rupiah($get_total[0]->voucher) . '</span>

                </li>';
            }

            if (0) {
                $return['summary'] .= '


                <li class="d-flex justify-content-between" style="border-bottom:1px dotted black">
                    <span>Pajak  </span>
                    <span class="text-primary">' . Partial::rupiah(0) . '</span>

                </li>';
            }
            if ((0)) {
                $return['summary'] .= '
                <li class="d-flex justify-content-between" style="border-bottom:1px dotted black">
                    <span>Biaya Payment Bank  </span>
                    <span class="text-primary">' . Partial::rupiah(0) . '</span>

                </li>';
            }
            $return['summary'] .= '
            </ul>
            </div>
            <div  id="total-order">
                <ul class="list-unstyled mb-0">
                <li class="d-flex justify-content-between" style="font-weight:700;font-size:18px">
                    <span class="text-dark">Total Bayar</span>
                    <span class=""><b>' . Partial::rupiah($get_total[0]->total) . '</b></span>
                </li>

                </ul>
            </div>

            ';
            // DB::whereRaw("(case when (jenis='Produk' and (qty!=0 or qty is not null)) then 1 else 1 end)=1");
            //
            // $return['summary'] .= '<h3> Order </h3>';
            //  <li class="d-flex justify-content-between">

            if ($type_return == 'cart') {
                $return['summary'] .= '<a class="btn-primary btn" onclick="proses_checkout(' . $id_group_pemesanan . ')" href="">Checkout</a>';
            } else if ($type_return == 'checkout') {
                //                     <span class="text-dark">Kontrobusi Baitul Mal</span>
            }
        } else {
            $return['summary'] = '<div class="card-body p-2 h4">Silahkan pilih salah satu produk kedalam cart</div>';
        }
        $return['summary']              = '<div id="SUMMARY">' . $return['summary'] . '</div>';
        $return['voucher_digunakan']    = $string_promo_voucher_aktif;
        $return['string_voucher_aktif'] = $string_promo_voucher_all;
        $return['status']               = 1;
        if ($type_return == 'json') {
            echo json_encode($return);
        } else {
            return $return;
        }
    }

    public static function update_database_checkout($page, $type, $id)
    {
        $get_id                     = $page['load']['id'];
        $update                     = [];
        $update['status_pra_order'] = 'Pemesanan';

        DB::update('erp__pos__pra_order', $update, "id in  (select id_cart from erp__pos__utama__detail where id_erp__pos__group=  $get_id )");

        $update           = [];
        $update['status'] = 'Pemesanan';
        DB::update('erp__pos__utama', $update, "id_erp__pos__group = $get_id ");
        $update           = [];
        $update['status'] = 'Pemesanan';
        DB::update('erp__pos__group', $update, " id=$get_id ");
        //                     <span class="text-success ">' . Partial::rupiah($get_total[0]->harga_donasi_baitul_mal) . '</span>
        //                 </li>
        //$return['summary'] .=  '<a class="btn-primary btn" ' . Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], "buat_invoice", "id_web__apps|", $id_pesanan, "ID_PANEL|"]) . '">Buat Inforice</a>';
        // DB::queryRaw($page, "update erp__pos__pra_order 
        // set status_pra_order = 'Pemesanan' where id in (select id_cart from erp__pos__utama__detail where id_erp__pos__group= {LOAD_ID})");
        // $pemesanan_detail = DB::get('all',$page);
        // DB::queryRaw($page, "update erp__pos__utama
        // set status = 'Pemesanan' where id_erp__pos__group =  {LOAD_ID}");
        // $pemesanan_detail = DB::get();
    }

    public static function script_checkout($page, $type, $id)
    {

        $fai     = new MainFaiFramework();
        $content = file_get_contents($fai->urlframework('dist', 'modal_checkout.php'));
        $content .= '	<script  type="text/javascript" src="' . $fai->urlframework('dist', 'ecommerce_checkout.js') . '"></script>';
        return $content;
    }
    public static function gunakan_voucher($page, $type, $id)
    {
        $fai        = new MainFaiFramework();
        $id_voucher = $fai->input('id_voucher');
        DB::table('store__voucher');

        // DB::queryRaw($page, "update erp__pos__group
        DB::whereRaw("store__voucher.id =$id_voucher");
        $get_detail         = DB::get('all');
        $pemesanan_grup     = EcommerceApp::inisiate_store_pesanan_group($page);
        $id_group_pemesanan = $pemesanan_grup['id'];
        DB::table('erp__pos__group');

        // set status = 'Pemesanan' where id  = {LOAD_ID}");
        DB::whereRaw("erp__pos__group.id =$id_group_pemesanan");
        $get_group = DB::get('all');
        if ($get_detail['num_rows']) {
            $row                                   = $get_detail['row'][0];
            $pemesanan                             = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, $row->id_toko, $get_group['row'][0]->status);
            $id_pemesanan                          = $pemesanan['id'];
            $insert_potongan                       = [];
            $insert_potongan["id_store"]           = $row->id_toko;
            $insert_potongan['id_erp__pos__group'] = $id_group_pemesanan;
            $insert_potongan['id_erp__pos__utama'] = $id_pemesanan;
            $insert_potongan["id_diskon_relation"] = $row->id;
            $insert_potongan["jenis_diskon"]       = 'Voucher';
            $insert_potongan["tipe_diskon"]        = $row->voucher;
            DB::table('erp__pos__utama__detail__diskon');
            foreach ($insert_potongan as $where_key => $where_value) {

                DB::whereRaw("$where_key::text='$where_value'");
            }
            $get                           = DB::get('all');
            $to_string_promo_voucher_aktif = "<div class='card'>";
            $to_string_promo_voucher_aktif .= "<div class='card-body'>
                                <h5>" . $row->nama_voucher . '</h5>

                                 ';
            $to_string_promo_voucher_aktif .= "
                    Diskon " . $row->voucher . " " . ($row->tipe_margin == 'Rp' ? 'Rp. ' : '') . $row->margin_promo . ($row->tipe_margin == '%' ? '%. ' : '');
            $to_string_promo_voucher_aktif .= "
                        <a type='button' onclick='gunakan_voucher(" . $row->id . ")' class='' href='javascript:void(0)'>Gunakan Voucher</a>
                        </div>
                    </div>";
            $insert_potongan["margin_diskon"]      = $row->margin_promo;
            $insert_potongan["tipe_margin_diskon"] = $row->tipe_margin;
            // $pemesanan_detail = DB::get();
            // DB::whereRaw("store__voucher.id_toko = $id_toko");
            $insert_potongan["informasi_diskon_relation"] = $to_string_promo_voucher_aktif;
            // DB::whereRaw("store__voucher.id_toko = $id_toko");
            // $insert_potongan["harga_jual_diskon"] = $lp['harga_jual_diskon'];
            $insert_potongan["nama_promo"] = $row->nama_voucher;
            if ($get['num_rows'] > 1) {
                foreach ($get['row'] as $hapus) {

                    DB::delete('erp__pos__utama__detail__diskon', "id=" . $hapus->id);
                }
                CRUDFunc::crud_insert(new MainFaiFramework(), $page, $insert_potongan, [], 'erp__pos__utama__detail__diskon', []);
            } else if ($get['num_rows'] == 1) {
                DB::update('erp__pos__utama__detail__diskon', $insert_potongan, "id=" . $get['row'][0]->id);
            } else if ($get['num_rows'] == 0) {
                CRUDFunc::crud_insert(new MainFaiFramework(), $page, $insert_potongan, [], 'erp__pos__utama__detail__diskon', []);
            }
        }
    }

    public static function get_change_ongkir($page, $type, $id)
    {
        $fai                      = new MainFaiFramework();
        $ongkir                   = OngkirApp::print_ongkir($fai->input('id_store'), $fai->input('id_kota_user'), $fai->input('berat'), 'ongkir_terpilih', $fai->input('id_kota_asal'), $fai->input('pilih_ongkir'));
        $update['paket_ongkir']   = $ongkir['paket_ongkir'];
        $update['estimasi_kirim'] = $ongkir['estimasi_kirim'];
        // $insert_potongan["total_diskon"] = $lp['harga_diskon'];
        $update['ongkir']          = $ongkir['harga_ongkir'];
        $update['id_store_ongkir'] = $fai->input('id_store');
        $update['id_store_ongkir'] = $fai->input('id_store');
        DB::table('erp__pos__group');
        DB::whereRaw("erp__pos__group.id=" . Partial::input('pesanan'));
        $get_all   = DB::get('all');
        $pemesanan = EcommerceApp::inisiate_store_pesanan($page, $fai->input('pesanan'), $fai->input('id_store'), $get_all['row'][0]->status);
        DB::update('erp__pos__delivery_order', $update, ['id_store_ongkir=' . $fai->input('id_store'), 'id_erp__pos__utama=' . $pemesanan['id']]);
        print_r($ongkir['print']);
        EcommerceApp::total_biaya_pengiriman($page, $type, $id, $fai->input('pesanan'), $pemesanan['id']);
    }

    public static function total_biaya_pengiriman($page, $type, $id, $id_group_pemesanan, $id_pesanan = -1)
    {
        if ($id_pesanan != -1) {

            DB::selectRaw('sum(ongkir) as total_ongkir');
            DB::table('erp__pos__delivery_order');

            DB::whereRaw("id_erp__pos__utama=" . $id_pesanan);
            $get_all = DB::get('all');

            DB::update('erp__pos__utama', ["biaya_pengiriman" => $get_all['row'][0]->total_ongkir], ['id=' . $id_pesanan]);
        }
        DB::selectRaw('sum(ongkir) as total_ongkir');
        DB::table('erp__pos__delivery_order');
        DB::joinRaw('erp__pos__utama on erp__pos__delivery_order.id_erp__pos__utama =erp__pos__utama.id');

        DB::whereRaw("id_erp__pos__group=" . $id_group_pemesanan);
        $get_all = DB::get('all');

        DB::update('erp__pos__group', ["biaya_pengiriman" => $get_all['row'][0]->total_ongkir], ['id=' . $id_group_pemesanan]);
        return $get_all['row'][0]->total_ongkir;
    }

    public static function get_all_ongkir($page, $type, $id)
    {
        $fai = new MainFaiFramework();
        DB::table('erp__pos__group');
        DB::joinRaw('inventaris__asset__tanah__bangunan on id_kirim_ke = inventaris__asset__tanah__bangunan.id', 'left');

        DB::whereRaw("erp__pos__group.id=" . Partial::input('id_pemesanan'));
        $get_all = DB::get('all');
        $ongkir  = OngkirApp::print_ongkir($fai->input('id_store'), $get_all['row'][0]->id_kota, $fai->input('berat'), 'All', $fai->input('id_kota_asal'));
        print_r($ongkir);
    }

    public static function inisiate_store_pesanan($page, $id_group_pemesanan, $id_toko, $status = 2, $type = 'umum')
    {
        $return = [];
        if (isset($_SESSION['id_apps_user'])) {
            $id_toko = $id_toko ? $id_toko : $page['workspace'];
            DB::table('erp__pos__utama');
            // if (isset($lp['maksimal_margin']))
            DB::whereRaw("erp__pos__utama.id_apps_user ='" . $_SESSION['id_apps_user'] . "'");
            DB::whereRaw('erp__pos__utama.id_toko=' . $id_toko);
            DB::whereRaw('erp__pos__utama.id_erp__pos__group=' . $id_group_pemesanan);
            DB::whereRaw("erp__pos__utama.status='$status'");
            $cek = DB::get('all');
            if (! $cek['num_rows']) {
                $data = [
                    'no_purchose_order'  => "PO-BJE/" . date('ymdHis') . "/" . rand(100, 999),
                    'id_panel'           => $page['get_panel']['id_panel'],
                    'id_apps_user'       => $_SESSION['id_apps_user'],
                    'tanggal_po'         => date('Y-m-d'),
                    'id_toko'            => $id_toko,
                    'id_erp__pos__group' => $id_group_pemesanan,
                    'status'             => $status,
                    'id_page'            => '1',
                    'side'               => 'pembeli',
                ];
                $insert_id = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $data, [], "erp__pos__utama", []);

                //     $insert_potongan["maksimal_margin"] = $lp['maksimal_margin'];
                DB::table('erp__pos__utama');
                // $update['jenis'] = 'Ongkir';
                DB::whereRaw("erp__pos__utama.id_apps_user='" . $_SESSION['id_apps_user'] . "'");
                DB::whereRaw('erp__pos__utama.id_toko=' . $id_toko);
                DB::whereRaw('erp__pos__utama.id_erp__pos__group=' . $id_group_pemesanan);
                DB::whereRaw("erp__pos__utama.status='$status'");
                $cek          = DB::get('all');
                $return['id'] = $insert_id;
            } else {
                $return['id'] = $cek['row'][0]->id;
            }
            $return['row'] = $cek['row'][0];
        }
        return $return;
    }
    public static function getFirstCharacter($inputString)
    {
        // DB::whereRaw('erp__pos__utama.id_panel=' . $page['get_panel']['id_panel']);
        if (! empty($inputString)) {
            // $insert_id = DB::lastInsertId($page, 'erp__pos__utama');
            $firstChar = substr($inputString, 0, 1);
            return $firstChar;
        } else {
            return ""; // DB::whereRaw('erp__pos__utama.id_panel=' . $page['get_panel']['id_panel']);
        }
    }
    public static function inisiate_store_pesanan_group($page, $force = 0, $tipe_group = "Barang Jadi Ecommerce")
    {
        $return = [];
        if (isset($_SESSION['id_apps_user'])) {

            DB::table('erp__pos__group');
            DB::whereRaw('erp__pos__group.id_panel=' . $page['get_panel']['id_panel']);
            DB::whereRaw("erp__pos__group.id_apps_user='" . $_SESSION['id_apps_user'] . "'");
            DB::whereRaw("erp__pos__group.tipe_group='" . $tipe_group . "'");
            DB::whereRaw("erp__pos__group.status='Aktif'");
            $cek = DB::get('all');
            if (! $cek['num_rows'] or $force) {
                $data = [
                    'nomor'        => "PO-" . EcommerceApp::getFirstCharacter($tipe_group) . "/" . date('ymdHis') . "/" . rand(100, 999),
                    'id_panel'     => $page['get_panel']['id_panel'],
                    'id_apps_user' => $_SESSION['id_apps_user'],
                    'tanggal'      => date('Y-m-d H:i:s'),
                    'status'       => 'Aktif',
                    'tipe_group'   => $tipe_group,
                ];
                $insert_id = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $data, [], "erp__pos__group", []);

                // Check if the string is not empty
                DB::table('erp__pos__group');
                DB::whereRaw('erp__pos__group.id_panel=' . $page['get_panel']['id_panel']);
                DB::whereRaw("erp__pos__group.id_apps_user ='" . $_SESSION['id_apps_user'] . "'");
                DB::whereRaw("erp__pos__group.status='Aktif'");
                $cek          = DB::get('all');
                $return['id'] = $insert_id;
            } else {
                $return['id'] = $cek['row'][0]->id;
            }
            $return['row'] = $cek['row'][0];
        }
        return $return;
    }

    public static function delete_cart($page, $type, $id)
    {
        $fai = new MainFaiFramework();
        ($id_cart = $fai->input('id_cart'));
        // Get the first character
        // Return empty string if input is empty

        $pemesanan_grup     = EcommerceApp::inisiate_store_pesanan_group($page);
        $id_group_pemesanan = $pemesanan_grup['id'];
        DB::update('erp__pos__pra_order', ["active" => 0, "status_pra_order" => "Hapus"], [('id=' . $id_cart)]);
        DB::delete('erp__pos__utama__detail', [('id_cart=' . $id_cart), ('id_erp__pos__group =' . $id_group_pemesanan)], "Where Array");
        echo '1';
    }
    public static function update_pemesanan($page, $type, $id)
    {
        ($id_pemesanan = Partial::input('id_pemesanan'));
        if (Partial::input('kirim_ke')) {
            $update['id_kirim_ke']  = Partial::input('kirim_ke');
            $db_bangunan            = [];
            $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
            $db_bangunan['where'][] = ['inventaris__asset__tanah__bangunan.id', '=', Partial::input('kirim_ke')];
            $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
            if ($get_db_bangunan['num_rows']) {

                $erp_do['id_bangunan_tujuan'] = Partial::input('kirim_ke');
                if ($get_db_bangunan['row'][0]->id_provinsi) {
                    $erp_do['id_provinsi_tujuan'] = $get_db_bangunan['row'][0]->id_provinsi;
                }

                if ($get_db_bangunan['row'][0]->id_kota) {
                    $erp_do['id_kota_tujuan'] = $get_db_bangunan['row'][0]->id_kota;
                }

                if ($get_db_bangunan['row'][0]->id_kecamatan) {
                    $erp_do['id_kecamatan_tujuan'] = $get_db_bangunan['row'][0]->id_kecamatan;
                }

                if ($get_db_bangunan['row'][0]->id_kelurahan) {
                    $erp_do['id_kelurahan_tujuan'] = $get_db_bangunan['row'][0]->id_kelurahan;
                }

                if ($get_db_bangunan['row'][0]->rt) {
                    $erp_do['rt_tujuan'] = $get_db_bangunan['row'][0]->rt;
                }

                if ($get_db_bangunan['row'][0]->rw) {
                    $erp_do['rw_tujuan'] = $get_db_bangunan['row'][0]->rw;
                }

                if ($get_db_bangunan['row'][0]->alamat) {
                    $erp_do['alamat_tujuan'] = $get_db_bangunan['row'][0]->alamat;
                }

                if ($get_db_bangunan['row'][0]->nomor_bangunan) {
                    $erp_do['nomor_tujuan'] = $get_db_bangunan['row'][0]->nomor_bangunan;
                }

                $db_bangunan            = [];
                $db_bangunan['utama']   = 'erp__pos__utama';
                $db_bangunan['where'][] = ['id_erp__pos__group', '=', $id_pemesanan];
                $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
                foreach ($get_db_bangunan['row'] as $row_utama) {

                    CRUDFunc::crud_update(new MainFaiFramework(), $page, $erp_do, [], [], [], 'erp__pos__delivery_order', 'id_erp__pos__utama', $row_utama->primary_key);
                }
            }
        }
        $update['id_payment_method'] = Partial::input('payment');
        if (Partial::input('brand')) {

            $update['id_payment_brand']   = explode('-', Partial::input('brand'))[0];
            $update['id_payment_webapps'] = explode('-', Partial::input('brand'))[1];
        }

        DB::update('erp__pos__group', $update, [('id=' . $id_pemesanan)]);
        DB::update('erp__pos__utama', $update, [('id_erp__pos__group=' . $id_pemesanan)]);
        echo json_encode(["status" => 1, "update" => $update]);
    }

    public static function bikin_invoice($page, $id, $id_panel)
    {
        // $insert_id = DB::lastInsertId($page, 'erp__pos__utama');

        $fai                        = new MainFaiFramework();
        $idUser                     = Partial::id_user();
        $get_id                     = $id;
        $update                     = [];
        $update['status_pra_order'] = 'Pemesanan';

        DB::update('erp__pos__pra_order', $update, "id in  (select id_cart from erp__pos__utama__detail where id_erp__pos__group=  $get_id )");

        $update           = [];
        $update['status'] = 'Pemesanan';
        DB::update('erp__pos__utama', $update, "id_erp__pos__group = $get_id ");
        $update           = [];
        $update['status'] = 'Pemesanan';
        DB::update('erp__pos__group', $update, " id=$get_id ");

        // $pemesanan = EcommerceApp::inisiate_store_pesanan($page);
        // $id_pemesanan = $pemesanan['id'];;
        //echo $id;
        // DB::table('erp__pos__utama__detail');
        // DB::queryRaw($page, "update erp__pos__pra_order set status_pra_order = 'Pembayaran' 
        //     where id in (select id_cart from erp__pos__utama__detail where id_erp__pos__group= $id)");
        // $pemesanan_detail = DB::get();
        // DB::queryRaw($page, "update erp__pos__utama set status = 'Pembayaran' where id_erp__pos__group = $id");
        DB::selectRaw('*,erp__pos__payment.nomor_payment');
        DB::table('erp__pos__group');
        DB::whereRaw('erp__pos__group.id=' . $id);
        DB::joinRaw('erp__pos__payment on id_payment=erp__pos__payment.id', 'left');
        $pemesanan                 = DB::get();
        $last_id                   = $id;
        $last_id_payment           = $pemesanan[0]->id_payment;
        $insert['tanggal_invoice'] = date('Y-m-d H:i:s');
        // $pemesanan_detail = DB::get();
        CRUDFunc::crud_update($fai, $page, $insert, [], [], [], 'erp__pos__utama', 'id_erp__pos__group', $id, ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
        CRUDFunc::crud_update($fai, $page, $insert, [], [], [], 'erp__pos__group', 'id', $id, ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
        if (! $last_id) {

            // DB::queryRaw($page, "update erp__pos__group set status = 'Pembayaran' where id = $id");
            // $pemesanan_detail = DB::get();
        }

        if ($last_id_payment and $pemesanan[0]->nomor_payment) {
            DB::queryRaw($page, "update   erp__pos__payment__bayar set active=0, delete_date='" . date('Y-m-d H:i:s') . "', delete_by=$idUser  where id_erp__pos__payment=$last_id_payment");
            $get = DB::get();
        } else {
            $page['crud']['save_type']            = "insert";
            $insert_payment                       = CRUDFunc::declare_crud_variable($fai, $page, [], 'erp__pos__payment', '', [], ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_payment'), [])['$sqli'];
            $insert_payment['id_panel']           = $id_panel;
            $insert_payment['id_apps_user']       = $_SESSION['id_apps_user'];
            $insert_payment['id_erp__pos__group'] = $id;
            $insert_payment['status_payment']     = 'Aktif';
            $insert_payment['tanggal_payment']    = date('Y-m-d H:i:s');
            // $insert['nomor_invoice'] = "INV-" . sprintf('%04d', $id) . random_num(10);
            $insert_payment['total_bayar'] = $pemesanan[0]->total;
            $last_id_payment               = CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
        }
        $last_id_payment_api = null;
        $va                  = null;
        $brand               = null;
        $no_rek              = null;
        $atas_nama           = null;
        $is_api              = null;
        if ($pemesanan[0]->id_payment_brand) {
            DB::table('webmaster__payment_method_brand');
            DB::joinRaw("webmaster__payment_method on webmaster__payment_method.id = webmaster__payment_method_brand.id_webmaster__payment_method");
            DB::whereRaw('webmaster__payment_method_brand.id=' . $pemesanan[0]->id_payment_brand);
            $payment_brand = DB::get();
            $brand         = $payment_brand[0]->nama_brand;
            $no_rek        = $payment_brand[0]->no_rek;
            $atas_nama     = $payment_brand[0]->atas_nama;
            $is_api        = $payment_brand[0]->is_api;
            if ($payment_brand[0]->is_api) {
                $insert_api = $insert_payment;
                unset($insert_api['nomor_payment']);
                unset($insert_api['id_pemesanan']);

                $insert_api['id_panel']          = $id_panel;
                $insert_api['id_apps_user']      = $_SESSION['id_apps_user'];
                $insert_api['id_payment']        = $last_id_payment;
                $insert_api['from_payment']      = "pos__transaksi__online";
                $insert_api['nomor_payment_api'] = "PA/" . date('ymdHis') . "/" . random_num(5);
                $insert_api['jenis_api']         = $payment_brand[0]->api;
                $insert_api['status_payment']    = "aktif";
                $last_id_payment_api             = CRUDFunc::crud_insert($fai, $page, $insert_api, [], 'payment_api', []);

                $va = PaymentGatewayApp::initialize_payment($page, $payment_brand[0]->api, $last_id_payment_api, $id, $insert_api['nomor_payment_api'], $pemesanan[0]->total, $payment_brand[0]->kode_payment, $payment_brand[0]->kode_brand);
            }
        }

        $insert_payment_bayar['id_erp__pos__payment'] = $last_id_payment;
        $insert_payment_bayar['id_metode_bayar']      = $pemesanan[0]->id_payment_method;
        $insert_payment_bayar['id_payment_brand']     = $pemesanan[0]->id_payment_brand;
        $insert_payment_bayar['id_payment_api']       = $last_id_payment_api;
        $insert_payment_bayar['brand_nama']           = $brand;
        $insert_payment_bayar['no_rek']               = $no_rek;
        $insert_payment_bayar['an']                   = $atas_nama;
        $insert_payment_bayar['va_number']            = $va;
        $insert_payment_bayar['is_api']               = $is_api;
        $insert_payment_bayar['jumlah_bayar']         = $pemesanan[0]->total;
        $insert_payment_bayar['status_bayar']         = "belum";
        CRUDFunc::crud_insert($fai, $page, $insert_payment_bayar, [], 'erp__pos__payment__bayar', []);

        // DB::update('erp__pos__utama', $insert,[]);
        // $last_id = DB::lastInsertId($page, 'erp__pos__invoice');
        // $insert_payment['nomor_payment'] = "FJ-O/" . date('ymdHis') . "/" . random_num(5);
        $update['id_payment'] = $last_id_payment;
        // $update['id_payment'] = $last_id_payment;
        DB::update('erp__pos__group', $update, [('id=' . $id)]);
        $message = "
        *[Informasi Pembayaran]*\n
        Hai Sobat,Assalamualaikum\n
        Terima kasih telah mempercayai pembelian produk kepada kami,  \n
        \n
        \n
        \nBerikut adalah informasi pembayaran pesanan anda:
        \n
        " . ("$brand") . "\n
        " . $no_rek . $va . "\n
        " . ($atas_nama ? "an. " . $atas_nama : '') . "Vitual Account Bank" . "\n
        \n
        Silahkan melakukan pembayaran selambat lambatnya 1x24 jam\n
        Barakallahu fikum

        ";
        DB::queryRaw($page, "select * from apps_user where id_apps_user = $idUser");
        $get_user = DB::get();
        $number   = Partial::parse_number($get_user[0]->nomor_handphone);
        unset($data);
        // // $update['status'] = "Menunggu Pembayaran";
        // DB::update('erp__pos__utama', $update, array(('id=' . $id)));
        // $update['status'] = "Menunggu Pembayaran";
        // $data["message"] = $message;
        // $data["from"] = $number;

        EcommerceApp::sync_cart($page, $id);

        $page['route_type']   = 'just_link';
        $page['load']['link'] = "direct";
        redirect(Partial::link_direct($page, base_url() . 'pages/', ["Ecommerce", "invoice", "view_layout", $id]));
        die;
    }

    // public function send_ulasan($jenis, $id_store_pesanan, $id_store_barang, $nilai = null)
    // {
    //     $dataInput = Partial::input('dataInput');
    //     if ($jenis == 'ulasan') {
    //         $data['ulasan'] = $dataInput;
    //         $this->db->where('id_store_pesanan ', $id_store_pesanan)->where('id_apps_user ', $_SESSION['id_apps'])->where('id_store_barang ', $id_store_barang)->update('store_barang_ulasan', $data);
    //     } else if ($jenis == 'nilai') {
    //         $data['nilai'] = $nilai;
    //         $this->db->where('id_store_pesanan ', $id_store_pesanan)->where('id_apps_user ', $_SESSION['id_apps'])->where('id_store_barang ', $id_store_barang)->update('store_barang_ulasan', $data);
    //         echo $this->db->last_query();
    //         $nilaiAVG               = $this->db->select_avg('nilai')->where('id_store_barang', $id_store_barang)->get('store_barang_ulasan')->row()->nilai;
    //         $barang['nilai_ulasan'] = $nilaiAVG;
    //         $this->db->where('id_store_barang ', $id_store_barang)->update('store_barang', $barang);
    //     } else if ($jenis == 'doa') {
    //         $data['doa'] = $dataInput;
    //         $this->db->where('id_store_pesanan ', $id_store_pesanan)->where('id_apps_user ', $_SESSION['id_apps'])->where('id_store_barang ', $id_store_barang)->update('store_doa', $data);
    //     }
    // }

    // public function check_status_payment()
    // {
    //     $row = $this->db->or_where('store_pesanan.status_pembayaran', 'menunggu')->or_where('store_pesanan_bayar.transaction_status', 'pending')->join('store_pesanan_bayar', 'store_pesanan.id_store_pesanan_bayar=store_pesanan_bayar.id_store_pesanan_bayar')->get('store_pesanan')->result();
    //     foreach ($row as $data) {
    //         $this->get_check_status_payment($data->order_id, $data->id_store_pesanan, $data->id_store_pesanan_bayar, $data->gross_amount);
    //     }
    // }
    // public function get_check_status_payment($order_id, $store_pesanan, $store_bayar, $total_bayar)
    // {
    //     try {
    //         $url      = 'https://api.midtrans.com/v2/';
    //         $response = getStatus2($url, 'VT-server-xV8ByBbVg0ZT4mZbLSXTTtru', $order_id);
    //         // ChatApp::altenatif_send_massage($page, $row['row'][0]->id, $data['message'], -2, 'utama', 1, $data);
    //     } catch (Exception $e) {
    //         //  
    //         die();
    //     }
    //     $response = json_decode($response, true);
    //     // payment_api 

    //     $store_pesanan . '- Status = ' . $response['transactions'][0]['transaction_status'];
    //     $updateBayar['transaction_status'] = $response['transactions'][0]['transaction_status'];
    //     $this->db->where('id_store_pesanan_bayar', $store_bayar)->update('store_pesanan_bayar', $updateBayar);
    //     if ($response['transactions'][0]['transaction_status'] == 'expire' or $response['transactions'][0]['transaction_status'] == 'cancle') {
    //         if ($response['transactions'][0]['transaction_status'] == 'expire') {
    //             $data['status_pembayaran'] = 'Waktu Habis';
    //         }

    //         if ($response['transactions'][0]['transaction_status'] == 'cancel') {
    //             $data['status_pembayaran'] = 'Transaksi Gagal';
    //         }

    //         $data['status'] = 'gagal';
    //         $this->db->where('id_store_pesanan', $store_pesanan)->update('store_pesanan', $data);
    //         $data_user_cart       = $this->db->select('id_store_user_cart')->where('id_store_pesanan', $store_pesanan)->get('store_pesanan_detail')->result();
    //         $UpdateCart['status'] = 'Belum Beli';
    //         foreach ($data_user_cart as $cart) {
    //             $this->db->where('id_store_user_cart', $cart->id_store_user_cart)->update('store_user_cart', $UpdateCart);
    //         }
    //     } else if ($response['transactions'][0]['transaction_status'] == 'success' or $response['transactions'][0]['transaction_status'] == 'capture' or $response['transactions'][0]['transaction_status'] == 'settlement') {
    //         // echo " < pre > ";print_r($response);
    //         $updatePesanan['tgl_bayar']         = date('Y-m-d H:i:s');
    //         $updatePesanan['status']            = 'selesai';
    //         $updatePesanan['status_pembayaran'] = 'selesai';
    //         $this->db->where('id_store_pesanan', $store_pesanan)->update('store_pesanan', $updatePesanan);
    //         $data_barang = $this->db->where('id_store_pesanan', $store_pesanan)->where('jenis', 'barang')->get('store_pesanan_detail')->result();
    //         // echo $e->getMessage();
    //         $updateDetail['status_pengiriman'] = 'Dalam Antrian';
    //         foreach ($data_barang as $row_barang) {
    //             $barang = $this->db->where('id_store_barang', $row_barang->id_store_barang)->get('store_barang')->row();
    //             //print_r($response);
    //             $updateBarang['total_terjual'] = ($barang->total_terjual) + (1);
    //             $updateBarang['stok']          = ($barang->stok) - (1);
    //             $this->db->where('id_store_barang', $row_barang->id_store_barang)->update('store_barang', $updateBarang);
    //             $id_distributor = $barang->id_store_distributor;
    //             $ongkir         = $this->db->where('jenis', 'ongkir')->where('id_store_distributor', $id_distributor)->where('id_store_pesanan', $store_pesanan)->get('store_pesanan_detail')->row();
    //             $estimasi_hari  = explode('-', $ongkir->estimasi_hari);
    //             $estimasi_awal  = $estimasi_hari[0];
    //             $estimasi_akhir = ($estimasi_hari[1]) + (1);

    //             $updateDetail['perkiraan_sampai_awal']  = tambah_tanggal(date('Y-m-d'), $estimasi_awal);
    //             $updateDetail['perkiraan_sampai_akhir'] = tambah_tanggal(date('Y-m-d'), $estimasi_akhir);

    //             $this->db->where('id_store_pesanan_detail', $row_barang->id_store_pesanan_detail)->update('store_pesanan_detail', $updateDetail);
    //         }
    //         $point['id_store_pesanan'] = $store_pesanan;
    //         $point['id_apps_user']     = $_SESSION['id_apps'];
    //         $point['point']            = intdiv((int) $total_bayar, 5000);
    //         $total_insert              = $this->db->where($point)->get('store_point')->num_rows();
    //         if ($total_insert == 0) {
    //             $this->db->insert('store_point', $point);
    //         }

    //     }
    // }
    // public function initialize_payment($store_pesanan, $invoice, $payment_type, $payment_brand)
    // {
    //     $data_pesanan = $this->belanja->data_pesanan($store_pesanan);

    //     //tambah total terjual
    //     $ongkir = $this->db->select_sum('harga_total')->where('jenis', 'ongkir')
    //         ->where('id_store_pesanan', $store_pesanan)
    //         ->get('store_pesanan_detail')->row()->harga_total;
    //     $data_ongkir = $this->belanja->data_pesanan('ongkir', $store_pesanan);
    //     $total       = 0;

    //     $total += 0;
    //     $total += $ongkir;

    //     foreach ($data_pesanan->result() as $pesanan) {
    //         $total += $pesanan->harga_total;
    //     }
    //     //Dalam Antrian
    //     //	print_r($barang->total_terjual);

    //     $transaction_details = [
    //         'order_id'     => $store_pesanan . '-' . $invoice,
    //         'gross_amount' => $total,
    //     ];
    //     $user_all =
    //     $this->db->where('id_apps_user', $_SESSION['id_apps'])
    //         ->join('apps_wilayah_kabupaten', 'apps_user.id_kota_user = apps_wilayah_kabupaten.kota_id', 'left')
    //         ->join('apps_wilayah_provinsi', 'apps_wilayah_provinsi.provinsi_id = apps_wilayah_kabupaten.provinsi_id')
    //         ->get('apps_user')->row();
    //     //$zakat        = $this->db->select('nominal')->where('jenis','pembelian_barang')->where('id_store_pesanan',$this->uri->segment(2))		->get('zakat')->row()->nominal;
    //     $billing_address = [
    //         'first_name'   => $user_all->nama_lengkap,
    //         'last_name'    => "",
    //         'address'      => $user_all->alamat,
    //         'city'         => $user_all->type . ' ' . $user_all->kota_name,
    //         'postal_code'  => $user_all->kode_pos,
    //         'phone'        => $user_all->no_hp,
    //         'country_code' => 'IDN',
    //     ];

    //     //$items = ($item);
    //     $shipping_address = [
    //         'first_name'   => "We Are Islam",
    //         'last_name'    => "Store",
    //         'address'      => "Jl Babakan Ciserueuh Timur RT 01/07",
    //         'city'         => "Bandung",
    //         'postal_code'  => "40255",
    //         'phone'        => "08987423444",
    //         'country_code' => 'IDN',
    //     ];
    //     //print_r($items);
    //     // Populate customer's billing address
    //     $customer_details = [
    //         'first_name'       => $user_all->nama_lengkap,
    //         'last_name'        => "",
    //         'email'            => $user_all->email,
    //         'phone'            => $user_all->no_hp,
    //         'billing_address'  => $billing_address,
    //         'shipping_address' => $shipping_address,
    //     ];

    //     // Populate customer's shipping address
    //     $token_id = "asasa21212312";

    //     //billing address (alamat penagihan) sama seperti alamat pengiriman (shipping address).
    //     $transaction_data['payment_type'] = $payment_type;
    //     if ($payment_type == 'bank_transfer') {
    //         $transaction_data['bank_transfer'] = ['bank' => $payment_brand];
    //     } else
    //     if ($payment_type == 'cstore') {
    //         $transaction_data['cstore'] = ['store' => $payment_brand, 'message' => "We Are Islam Store"];
    //     }
    //     $transaction_data['transaction_details'] = $transaction_details;
    //     // Populate customer's info
    //     $transaction_data['customer_details'] = $customer_details;
    //     // Token ID from checkout page
    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL            => "https://api.sandbox.midtrans.com/v2/SANDBOX-G710367688-806/status",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING       => "",
    //         CURLOPT_MAXREDIRS      => 10,
    //         CURLOPT_TIMEOUT        => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST  => "GET",
    //         CURLOPT_POSTFIELDS     => "\n\n",
    //         CURLOPT_HTTPHEADER     => [
    //             "Accept: application/json",
    //             "Content-Type: application/json",
    //             "Authorization: SB-Mid-client-0FHNOdX3KizpO3B0",
    //         ],
    //     ]);
    //     $content = curl_exec($curl);
    //     print_r($content);

    //     try {
    //         $url      = 'https://api.sandbox.midtrans.com/v2/charge';
    //         $response = remotePost($url, 'SB-Mid-server-nqV_1C85dJJgOEOlwS-YN1M8', json_encode($transaction_data, true));
    //         // Transaction data to be sent
    //     } catch (Exception $e) {
    //         //$transaction_data['item_details'] = $items;
    //         die();
    //     }
    //     $response = json_decode($response, true);
    //     //print_r($transaction_data);
    //     $data['id_store_pesanan']   = $store_pesanan;
    //     $data['status_code']        = $response['status_code'];
    //     $data['status_message']     = $response['status_message'];
    //     $data['transaction_id']     = $response['transaction_id'];
    //     $data['order_id']           = $response['order_id'];
    //     $data['gross_amount']       = $response['gross_amount'];
    //     $data['currency']           = $response['currency'];
    //     $data['payment_type']       = $response['payment_type'];
    //     $data['transaction_time']   = $response['transaction_time'];
    //     $data['transaction_status'] = $response['transaction_status'];
    //     $data['merchant_id']        = $response['merchant_id'];
    //     if ($payment_type == 'cstore') {

    //         $data['payment_code'] = $response['payment_code'];
    //         $data['store']        = $response['store'];
    //     } else
    //     if ($payment_type == 'bank_transfer') {
    //         if ($payment_brand != 'permata') {

    //             $data['bank']       = $response['va_numbers'][0]['bank'];
    //             $data['va_numbers'] = $response['va_numbers'][0]['va_number'];
    //         } else {
    //             // echo " < pre > ";print_r($response);
    //             $data['bank']       = $payment_brand;
    //             $data['va_numbers'] = $response['permata_va_number'];
    //         }

    //         $data['fraud_status'] = $response['fraud_status'];
    //     }
    //     if ($data['transaction_id'] != null) {

    //         $this->db->insert('store_pesanan_bayar', $data);
    //         return $this->db->insert_id();
    //     }
    // }
    // public function bayar($store_pesanan)
    // {
    //     if (isset($_GET['proses'])) {
    //         if ($_GET['proses'] == 'input') {

    //             $row = $this->db->where('id_store_pesanan', $store_pesanan)->get('store_pesanan_detail')->result();

    //             $data['status'] = 'Proses Pembayaran';
    //             foreach ($row as $baris) {
    //                 $this->db->where('id_store_user_cart', $baris->id_store_user_cart)->update('store_user_cart', $data);
    //             }
    //             $data                      = Partial::input('data');
    //             $data['payment_type']      = Partial::input('payment_type');
    //             $data['payment_brand']     = Partial::input('payment_brand');
    //             $data['status']            = 'pembayaran';
    //             $data['tgl_pesan']         = date('Y-m-d H:i:s');
    //             $data['tgl_expired_bayar'] = tambah_tanggal(date('Y-m-d'), 1) . ' ' . date('H:i:s');
    //             $data['nomor_invoice']     = date('ymdHis') . rand(10000, 99999);

    //             if ($data['payment_type'] != 'Manual Transfer Bank') {

    //                 $insert_id = $this->initialize_payment($store_pesanan, $data['nomor_invoice'], $data['payment_type'], $data['payment_brand']);

    //                 $data['id_store_pesanan_bayar'] = $insert_id;
    //             }

    //             $this->db->where('id_store_pesanan', $store_pesanan)->update('store_pesanan', $data);
    //             redirect(base_url() . 'bayar.html/' . $store_pesanan . '?proses=email');
    //         } else
    //         if ($_GET['proses'] == 'email') {
    //             $user = $this->db->where('id_apps_user', $_SESSION['id_apps'])->get('apps_user')->row();
    //             // echo $e->getMessage();
    //             $pesanan = $this->db->where('id_store_pesanan', $store_pesanan)->get('store_pesanan')->row();
    //             if ($pesanan->payment_type == 'Manual Transfer Bank') {
    //                 $konfirm = "
    // 				<h3>Konfirmasi Pembayaran</h3>
    // 				Lakukan Konfirmasi Pembayaran, dengan cara:<br>
    // 				1. pastikan anda login sesuai akun yang sama saat pemesanan<br>
    // 				2. klik icon profile, kemudian pilih konfirmasi pembayaran. atau klik button yang ada di bawah ini<br>
    // 				3. Pilih Nomor Invoice, pastikan nomor invoice yang anda pilih sesuai dengan pembayaran yang dilakukan
    // 				4. Lalu isi form yang lainnya, kemudian Simpan<br><br><br>

    // 				<a href='http://weareislam.id/Store//konfirmasi-pembayaran.html' style='background-color: #206bc4;  border: none;  color: white;  padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;'>Konfirmasi Pembayaran</a>
    // 				";
    //                 $imgBrand     = 'BankBNI.png';
    //                 $payment_code = '0902402741 ';
    //                 $an           = 'a.n HILFI MUHAMAD ARYAWAN<br>(BNI SYARIAH/BSI)';
    //                 $title        = 'Bank Transfer Ke';
    //             } else if ($pesanan->payment_type == 'bank_transfer') {
    //                 $payment = $this->db->where('id_store_pesanan_bayar', $pesanan->id_store_pesanan_bayar)->get('store_pesanan_bayar')->row();
    //                 if ($pesanan->payment_brand == 'bni') {
    //                     $imgBrand = 'BankBNI.png';
    //                 } else if ($pesanan->payment_brand == 'bri') {
    //                     $imgBrand = 'BankBRI.png';
    //                 } else if ($pesanan->payment_brand == 'bca') {
    //                     $imgBrand = 'BankBCA.png';
    //                 } else if ($pesanan->payment_brand == 'permata') {
    //                     $imgBrand = 'BankPermata.png';
    //                 }

    //                 $title        = '  Vitual Account Billing';
    //                 $payment_code = $payment->va_numbers;
    //             } else if ($pesanan->payment_type == 'cstore') {
    //                 $payment = $this->db->where('id_store_pesanan_bayar', $pesanan->id_store_pesanan_bayar)->get('store_pesanan_bayar')->row();
    //                 if ($pesanan->payment_brand == 'alfamart') {
    //                     $imgBrand = 'alfamart.png';
    //                 } else if ($pesanan->payment_brand == 'indomaret') {
    //                     $imgBrand = 'indomaret.png';
    //                 }

    //                 $payment_code = $payment->payment_code;
    //                 $title        = 'Gerai Retail';
    //             }
    //             $msg = "
    // 			Bismillah, <br>
    // 			Hallo Sahabat " . $user->nama_lengkap . ",<br>
    // 			Jazakumullahu khair, telah memesan barang barang dari website kami, berikut adalah rincian pembayaran yang sahabat harus lakukan:<br><br>
    // 			<center>
    // 			<b>Total Bayar</b><br>
    // 			<font style='font-size:20px'><b>" . rupiah($pesanan->total_bayar) . "</b></font><br>
    // 			<font style='color:#222'>Jatuh Tempo pada :<br> " . tgl_indo(nice_date($pesanan->tgl_expired_bayar, 'Y-m-d')) . " Pukul " . nice_date($pesanan->tgl_expired_bayar, 'H:i:s') . "</font><br><br>
    // 			Lakukan Pembayaran:<br>
    // 			$title<br>
    // 				<h3 style='padding-bottom:5px;padding-top:5px;margin: 0px;'>
    //               		<img src=" . base_url() . 'images/' . $imgBrand . " width='50px'> <br><font style='font-size:25px;'><b>" . $payment_code . "</b></font><br>
    //               	</h3>
    //               	<div class=''>$an</div>
    //               	$konfirm
    // 			</center>

    // 			";
    //             ob_start();
    //             send_email($user->email, $user->nama_lengkap, "Pembayaran Weareislam.id Pemesanan Tanggal" . tgl_indo(nice_date($pesanan->tgl_expired_bayar, 'Y-m-d')) . " Pukul " . nice_date($pesanan->tgl_expired_bayar, 'H:i:s'), $msg);
    //             ob_end_clean();
    //         }
    //         redirect(base_url() . 'bayar.html/' . $store_pesanan . '');
    //     } else {

    //         $page['content']  = '_v_store/v_belanja_bayar';
    //         $page['pesanan']  = $pesanan  = $this->db->where('id_store_pesanan', $this->uri->segment(2))->get('store_pesanan')->row();
    //         $page['user_all'] =
    //         $this->db->where('id_apps_user', $_SESSION['id_apps'])
    //             ->join('apps_wilayah_kabupaten', 'apps_user.id_kota_user = apps_wilayah_kabupaten.kota_id', 'left')
    //             ->join('apps_wilayah_provinsi', 'apps_wilayah_provinsi.provinsi_id = apps_wilayah_kabupaten.provinsi_id')
    //             ->get('apps_user')->row();
    //         $this->load->view('layout/content', $page);
    //     }
    // }

    // public function get_invoice_barang()
    // {
    //     $data = $this->db
    //         ->select('store_pesanan.*,store_pesanan_detail.*,store_barang.*')
    //         ->select('(IF(store_pesanan_detail.id_store_varian_warna!=0, concat(" Warna : ",(Select nama_varian from store_barang_varian where store_barang_varian.id_store_barang_varian =  store_pesanan_detail.id_store_varian_warna)), null)) as warna')
    //         ->select('(IF(store_pesanan_detail.id_store_varian_type!=0,concat(" Type : ",(Select nama_varian from store_barang_varian where store_barang_varian.id_store_barang_varian =  store_pesanan_detail.id_store_varian_type)), null)) as type')
    //         ->where('store_pesanan.nomor_invoice', Partial::input('no_inv'))
    //         ->from('store_pesanan')
    //         ->join('store_pesanan_detail', 'store_pesanan_detail.id_store_pesanan = store_pesanan.id_store_pesanan')
    //         ->join('store_barang', 'store_pesanan_detail.id_store_barang = store_barang.id_store_barang')
    //         ->get();
    //     $content     = '';
    //     $no          = 1;
    //     $total_bayar = 0;
    //     foreach ($data->result() as $baris) {

    //         $content .= '
    // 						<label class="form-selectgroup-item flex-fill mb-2">
    // 						<input class="form-selectgroup-input" disabled  type="checkbox">
    // 						<div class="form-selectgroup-label d-flex align-items-centerr p-3">
    // 						<div class="me-3">
    // 						<span class="">' . $no++ . '</span>
    // 						</div>
    // 						<div class="form-selectgroup-label-content text-left d-flex " style="color: #000;">
    // 						<div  class=" text-left ">
    // 						<div class="font-weight-bold" style="text-align: left;"> ' . $baris->nama_barang . '</div>
    // 						<div class="text-muted" style="text-align: left;">' . $baris->jumlah . 'x    ' . $baris->warna . '   ' . $baris->type . ' </div>
    // 						<div class="text-muted" style="text-align: left;"> Harga ' . $baris->harga_total . ' </div>

    // 						</div>
    // 						</div>
    // 						</div>
    // 						</label>';
    //         $total_bayar += $baris->harga_total;
    //         $id_pesanan = $baris->id_store_pesanan;
    //     }
    //     $zakat  = $this->db->select('nominal')->where('id_store_pesanan', $id_pesanan)->get('zakat')->row()->nominal;
    //     $ongkir = $this->db->select_sum('harga_total')->where('id_store_pesanan', $id_pesanan)->where('jenis', 'ongkir')->get('store_pesanan_detail')->row()->harga_total;

    //     $content .= '
    // 						<label class="form-selectgroup-item flex-fill mb-2">
    // 						<input class="form-selectgroup-input" disabled  type="checkbox">
    // 						<div class="form-selectgroup-label d-flex align-items-centerr p-3">
    // 						<div class="me-3">
    // 						<span class="">' . $no++ . '</span>
    // 						</div>
    // 						<div class="form-selectgroup-label-content text-left d-flex " style="color: #000;">
    // 						<div  class=" text-left ">
    // 						<div class="font-weight-bold" style="text-align: left;"> Zakat Mal</div>
    // 						<div class="text-muted" style="text-align: left;">' . rupiah($zakat) . ' </div>

    // 						</div>
    // 						</div>
    // 						</div>
    // 						</label>';
    //     $content .= '
    // 						<label class="form-selectgroup-item flex-fill mb-2">
    // 						<input class="form-selectgroup-input" disabled  type="checkbox">
    // 						<div class="form-selectgroup-label d-flex align-items-centerr p-3">
    // 						<div class="me-3">
    // 						<span class="">' . $no++ . '</span>
    // 						</div>
    // 						<div class="form-selectgroup-label-content text-left d-flex " style="color: #000;">
    // 						<div  class=" text-left ">
    // 						<div class="font-weight-bold" style="text-align: left;"> Ongkir</div>
    // 						<div class="text-muted" style="text-align: left;">' . rupiah($ongkir) . ' </div>

    // 						</div>
    // 						</div>
    // 						</div>
    // 						</label>';

    //     $total_bayar += $zakat;
    //     $total_bayar += $ongkir;
    //     $return['content']      = $content;
    //     $return['id_pesanan']   = $id_pesanan;
    //     $return['total_barang'] = $data->num_rows();
    //     $return['total_bayar']  = rupiah($total_bayar);
    //     $return['total_inv']    = Partial::input('no_inv');
    //     echo json_encode($return);
    // }
    // public function send_konfirm_bayar()
    // {
    //     $data                 = Partial::input('data');
    //     $data['id_apps_user'] = $_SESSION['id_apps'];
    //     $this->db->insert('store_pesanan_bayar_konfirm', $data);
    //     $id         = $this->db->insert_id();
    //     $uploadData = $this->_do_upload('file', 'Store', 'store_pesanan_bayar_konfirm', 'KonfirmBayar');
    //     //print_r($response);
    //     $img = "";
    //     for ($i = 0; $i < count($uploadData); $i++) {
    //         $uploadData[$i]['id_ext'] = $id;
    //         //echo'tess';
    //         $this->db->insert('apps_file', $uploadData[$i]);
    //         $img .= "
    // 	 	<img src=" . base_url('upload/') . $uploadData[$i]['path'] . '/' . $uploadData[$i]['file_name'] . " width='500px'/>		 	";
    //     }
    //     $user = $this->db->where('id_apps_user', $_SESSION['id_apps'])->get('apps_user')->row();
    //     //echo $user->email;
    //     $pesanan = $this->db->where('nomor_invoice', $data['nomor_invoice'])->get('store_pesanan')->row();

    //     $konfirm = "
    // 				<h3>Konfirmasi Pembayaran</h3>


    // 				<a href='http://weareislam.id/Store/Admin/konfirmasi_pembayaran/detail/?auth=b894ba59093db2515774580cdc93726e&id_konfirm=$id' style='background-color: #206bc4;  border: none;  color: white;  padding: 5px 12px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;'>Lihat Lebih Detail</a>
    // 				<a href='http://weareislam.id/Store/Admin/konfirmasi_pembayaran/send/?auth=b894ba59093db2515774580cdc93726e&id_konfirm=$id&value=benar' style='background-color: #206bc4;  border: none;  color: white;  padding: 5px 12px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;'>Benar</a>
    // 				<a href='http://weareislam.id/Store/konfirmasi_pembayaran/send/?auth=b894ba59093db2515774580cdc93726e&id_konfirm=$id&value=tidak' style='background-color: #206bc4;  border: none;  color: white;  padding: 5px 12px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 16px;'>Tidak Benar</a>
    // 				";

    //     $msg = "
    // 			Bismillah, <br>
    // 			Hallo Sahabat Bapak Admin,<br>
    // 			Sahabat kita " . $user->nama_lengkap . " telah sudah melakukan pembayaran, mangga di cek,<br><br><br>
    // 			<center>
    // 			<b>Total Bayar</b><br>
    // 			<font style='font-size:20px'><b>" . rupiah($pesanan->total_bayar) . "</b></font><br>
    // 			<font style='color:#222'>
    // 			Atas Nama : <b> " . $data['nama'] . "</b><br>
    // 			No Rek : <b> " . $data['no_rek'] . "</b><br>
    // 			bank : <b> " . $data['bank'] . "</b><br>
    // 			$img
    // 			</font><br><br>
    // 			$konfirm

    // 			</center>

    // 			";
    //     ob_start();
    //     send_email('hilfimuhamad@gmail.com', "Admin We Are Islam", "Konfirmasi Pembayaran User " . $user->nama_lengkap, $msg, ["hermawanbujil60@gmail.com", "Refafauzia00@gmail.com"]);
    //     //echo count($uploadData);
    //     //print_r($uploadData[$i]);
    //     ob_end_clean();
    //     //echo $user->email;
    //     redirect(base_url() . 'konfirmasi-pembayaran.html');
    // }
}
// class Belanja
// {

//     public function data_distributor($id_store_distributor)
//     {
//         $query = $this->db->where('id_store_distributor', $id_store_distributor)
//             ->join('apps_wilayah_kabupaten', 'store_distributor.id_kota = apps_wilayah_kabupaten.kota_id')
//             ->get('store_distributor');
//         return $query;
//     }
//     public function data_cart_distributor($id_store_distributor)
//     {
//         $query = $this->db->where('id_apps_user ', $_SESSION['id_apps'])->where('status', 'Belum Beli')->where('jenis  ', 'ongkir')->where('id_store_distributor', $id_store_distributor)
//             ->get('store_user_cart');
//         return $query;
//     }
//     public function data_ulasan()
//     {
//         $data_pesanan = $this->db
//             ->where('store_pesanan.status ', 'selesai')
//             ->join('store_pesanan_detail', 'store_pesanan_detail.id_store_pesanan = store_pesanan.id_store_pesanan')
//             ->join('store_barang', 'store_pesanan_detail.id_store_barang = store_barang.id_store_barang')

//             ->where('store_pesanan_detail.jenis ', 'barang')
//             ->where('store_pesanan.id_apps_user', $_SESSION['id_apps'])

//             ->get('store_pesanan');
//         return $data_pesanan;
//     }
//     public function data_pesanan($id_store_pesanan = null, $status = null)
//     {
//         if ($id_store_pesanan) {
//             $this->db->where('store_pesanan.id_store_pesanan ', $id_store_pesanan);
//         } else {
//             $this->db->where('store_pesanan.status !=', 'aktif');
//         }
//         if ($status) {
//             $this->db->where('store_pesanan.status ', $status);
//         }

//         $data_pesanan = $this->db

//             ->where('store_pesanan_detail.jenis ', 'barang')
//             ->where('store_pesanan.id_apps_user', $_SESSION['id_apps'])
//             ->join('store_pesanan_detail', 'store_pesanan_detail.id_store_pesanan = store_pesanan.id_store_pesanan')
//             ->join('store_barang', 'store_pesanan_detail.id_store_barang = store_barang.id_store_barang')
//             ->join('store_distributor', 'store_barang.id_store_distributor = store_distributor.id_store_distributor')
//             ->join('apps_wilayah_kabupaten', 'store_distributor.id_kota = apps_wilayah_kabupaten.kota_id')
//             ->order_by('store_pesanan_detail.id_store_pesanan')
//             ->get('store_pesanan');
//         return $data_pesanan;
//     }
//     public function data_store_cart($id_store_cart = null, $status = null, $panel = 'umum')
//     {
//         if ($id_store_cart) {
//             $this->db->where('id_store_user_cart', $id_store_cart);
//         }
//         $data_cart = $this->db->where('id_apps_user', $_SESSION['id_apps'])
//             ->where('store_user_cart.status', 'Belum Beli')
//         //send_email('hermawanbujil60@gmail.com',"Admin We Are Islam","Konfirmasi Pembayaran User ".$user->nama_lengkap,$msg,"hermawanbujil60@gmail.com,Refafauzia00@gmail.com");
//             ->join('store_barang', 'store_user_cart.id_store_barang = store_barang.id_store_barang')
//             ->join('store_distributor', 'store_barang.id_store_distributor = store_distributor.id_store_distributor', 'left')
//             ->join('apps_wilayah_kabupaten', 'store_distributor.id_kota = apps_wilayah_kabupaten.kota_id', 'left')
//             ->order_by('store_barang.id_store_distributor')
//             ->get('store_user_cart');
//         //send_email('Refafauzia00@gmail.com',"Admin We Are Islam","Konfirmasi Pembayaran User ".$user->nama_lengkap,$msg,"hermawanbujil60@gmail.com,Refafauzia00@gmail.com");
//         return $data_cart;
//     }
//     public function send_zakat($store_pesanan, $zakat)
//     {
//         $data['id_store_pesanan'] = $store_pesanan;
//         $data['id_apps_user']     = $_SESSION['id_apps'];
//         $data['nominal']          = $zakat;
//         $data['zakat_sisa']       = $zakat;
//         $data['tgl_input']        = date('Y-m-d H:i:s');
//         $data['jenis']            = 'pembelian_barang';
//         $this->db->where('id_store_pesanan', $store_pesanan)->where('jenis', 'pembelian_barang')->delete('zakat');
//         $this->db->insert('zakat', $data);
//     }

//     public function get_saldo($kategori)
//     {

//         if ($kategori == 'zakat') {
//             $this->db
//                 ->where('zakat.id_apps_user', $_SESSION['id_apps']);
//             $this->db->from('zakat')
//                 ->join('store_pesanan', 'zakat.id_store_pesanan = store_pesanan.id_store_pesanan')
//                 ->where('store_pesanan.status_pembayaran', 'selesai');
//             $result = 'zakat_sisa';
//             $this->db->select_sum('zakat.zakat_sisa');

//             return $this->db->get()->row()->zakat_sisa;
//         } else if ($kategori == 'donasi') {
//             $this->db
//                 ->where('donasi.id_apps_user', $_SESSION['id_apps']);
//             $this->db->from('donasi')
//                 ->where('store_pesanan.status_pembayaran', 'selesai')
//                 ->join('store_pesanan', 'donasi.id_store_pesanan = store_pesanan.id_store_pesanan  ');
//             $result = 'donasi_sisa';
//             $this->db->select_sum('donasi.donasi_sisa');

//             return $this->db->get()->row()->donasi_sisa;
//         } else if ($kategori == 'sisa_total_donasi') {
//             $this->db
//                 ->where('donasi.id_apps_user', $_SESSION['id_apps']);
//             $this->db->from('donasi')
//                 ->where('store_pesanan.status_pembayaran', 'selesai')
//                 ->join('store_pesanan', 'donasi.id_store_pesanan = store_pesanan.id_store_pesanan  ');
//             $result = 'donasi_sisa_total';
//             $this->db->select_sum('donasi.donasi_sisa_total');

//             return $this->db->get()->row()->donasi_sisa_total;
//         }
//     }
// }
