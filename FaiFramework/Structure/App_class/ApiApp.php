<?php

use Illuminate\Support\Facades\Date;

require_once BASEPATH . '../FaiFramework/Structure/Content_class/SearchContent.php';

class ApiApp
{
    public static function main_load_data($page)
    {
        header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header('Content-Type: application/json');
        $data     = [];
        $fileName = 'Fai-Version-Template.json';

        DB::table('web__apps');
        DB::selectRaw("web__apps.*,domain_utama,
        meta_title,
        meta_keyword,
        meta_description,
        web__template.folder_template as template_utama,
        sidebar.folder_template as template_sidebar,nomor_send_wa,
        navbar.folder_template as template_navbar,
        header.folder_template as template_header,
        alamat,no_telepon,nama_narahubung,email,
        concat(utama_file.path,utama_file.file_name_save) as logo,
        web__apps.id_first_menu
        ");
        DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
        DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
        DB::joinRaw("web__template on  web__template.id = id_template", 'left');
        DB::joinRaw("web__template sidebar on  sidebar.id = id_sidebar_template", 'left');
        DB::joinRaw("web__template navbar on  navbar.id = id_navbar_template", 'left');
        DB::joinRaw("web__template header on  header.id = id_header_template", 'left');
        DB::joinRaw("web__list_apps_menu on  web__list_apps_menu.id = id_first_menu", 'left');
        DB::joinRaw("drive__file utama_file on  web__apps.logo = utama_file.id", 'left');
        // DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
        $utama = DB::get('all');

        // $db_produk['join'][] = ["drive__file ", " cast(utama_file.id as text)", " cast(inventaris__asset__list.foto_aset as text)", "left"];
        foreach ($utama['row'] as $row) {
            $data['main_web'][$row->domain_utama] = $row;
        }
        $fileName          = 'Fai-Version-Template.json';
        $data['main_page'] = $app = json_decode(trim(file_get_contents($fileName)), true);
        $fileName          = 'Fai-Version-Template-Menu.json';
        $data['main_menu'] = $menu = json_decode(trim(file_get_contents($fileName)), true);
        $fileName          = 'Fai-Version-Template-App.json';
        $data['main_app']  = $App  = json_decode(trim(file_get_contents($fileName)), true);
        $fileName          = 'Fai-Version-Template-MenuList.json';
        $data['menu_list'] = $App = json_decode(trim(file_get_contents($fileName)), true);
        echo json_encode($data);
    }
    public static function main_load_menu($page)
    {
        header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        $fileName = 'Fai-Version-Template-Menu.json';
        echo file_get_contents($fileName);
    }
    public static function main_load_app($page)
    {
        header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        $fileName = 'Fai-Version-Template-App.json';
        echo file_get_contents($fileName);
    }
    public static function main_web($page)
    {
        header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        DB::table('web__apps');
        DB::selectRaw("web__apps.*,domain_utama,
        meta_title,
        meta_keyword,
        meta_description,
        web__template.folder_template as template_utama,
        sidebar.folder_template as template_sidebar,nomor_send_wa,
        navbar.folder_template as template_navbar,
        header.folder_template as template_header,
        alamat,no_telepon,nama_narahubung,email,
        concat(utama_file.path,utama_file.file_name_save) as logo,
        web__apps.id_first_menu
        ");
        DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
        DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
        DB::joinRaw("web__template on  web__template.id = id_template", 'left');
        DB::joinRaw("web__template sidebar on  sidebar.id = id_sidebar_template", 'left');
        DB::joinRaw("web__template navbar on  navbar.id = id_navbar_template", 'left');
        DB::joinRaw("web__template header on  header.id = id_header_template", 'left');
        DB::joinRaw("web__list_apps_menu on  web__list_apps_menu.id = id_first_menu", 'left');
        DB::joinRaw("drive__file utama_file on  web__apps.logo = utama_file.id", 'left');
        // DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
        $utama = DB::get('all');

        // $db_produk['join'][] = ["drive__file ", " cast(utama_file.id as text)", " cast(inventaris__asset__list.foto_aset as text)", "left"];

        $data = [];
        foreach ($utama['row'] as $row) {
            $data[$row->domain_utama] = $row;
        }
        echo json_encode($data);
    }
    public static function get_pending_order($page)
    {
        header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        DB::table('erp__pos__group');
        DB::selectRaw("* ");
        DB::whereRaw("tanggal = DATE(NOW()) and status = 'Pemesanan'");
       
        // DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
        $utama = DB::get('all');

        // $db_produk['join'][] = ["drive__file ", " cast(utama_file.id as text)", " cast(inventaris__asset__list.foto_aset as text)", "left"];

        $data = [];
        unset($utama['query']);
        echo json_encode($utama);
    }
    public static function done_integrasi_db($page)
    {
        $deviceId        = Partial::input('device_id');
        $primary_key     = Partial::input('primary_key');
        $all_data        = Partial::input('all_data');
        $lase_device__id = Partial::input('lase_device__id');
        DB::table('apps_device');

        if ($deviceId) {
            DB::whereRaw("device_id = '$deviceId'");
        }

        $device = DB::get('all');
        //insert if tidak ada
        if (! $device['num_rows']) {
            $sqli["device_id"] = $deviceId;
            DB::insert("apps_device", $sqli);
            $deviceId = Partial::input('device_id');
            DB::table('apps_device');

            if ($deviceId) {
                DB::whereRaw("device_id = '$deviceId'");
            }

            $device = DB::get('all');
        }

        // get id jika ada
        $id_device = $device['row'][0]->id;
        DB::update("apps_device__transaksi", ["status_generate" => "1"], [["id_apps_device", "=", "$id_device"], ["id", "=", "$primary_key"]], 'Where Array');
        echo json_encode(["status" => 1]);
    }
    public static function integrasi_db($page)
    {
        //apps_ device
        $deviceId        = Partial::input('device_id');
        $all_data        = Partial::input('all_data');
        $lase_device__id = Partial::input('lase_device__id');
        DB::table('apps_device');

        if ($deviceId) {
            DB::whereRaw("device_id = '$deviceId'");
        }

        $device = DB::get('all');
        //insert if tidak ada
        if (! $device['num_rows']) {
            $sqli["device_id"] = $deviceId;
            DB::insert("apps_device", $sqli);
            $deviceId = Partial::input('device_id');
            DB::table('apps_device');

            if ($deviceId) {
                DB::whereRaw("device_id = '$deviceId'");
            }

            $device = DB::get('all');
        }

        // get id jika ada
        $id_device = $device['row'][0]->id;
        //update login sebagai id_apps_user apa

        // ceking device id, jika tidak ada id yang belum masuk - dengan parameter user login, dengan database tertentu..
        $db = Partial::input('db');
        DB::table($db);
        DB::whereRaw("id not in(select db_id from apps_device__id where id_apps_device = $id_device)");
        $ceking_device_id = DB::get('all');
        if ($ceking_device_id['num_rows']) {
            foreach ($ceking_device_id['row'] as $row) {
                $sqli                   = [];
                $sqli["id_apps_device"] = $id_device;
                $sqli["db_name"]        = $db;
                $sqli["db_id"]          = $row->id;
                $sqli["apps_id"]        = random(12);
                DB::insert("apps_device__id", $sqli);
            }
        }

        // cari id yang belum masuk di apps_transaksi, maka masukan ke apps_transaksi

        DB::table($db);
        DB::whereRaw("id not in(select database_id from apps__transaksi where database_utama='$db')");
        $ceking_device_id = DB::get('all');
        if ($ceking_device_id['num_rows']) {
            foreach ($ceking_device_id['row'] as $row) {
                $sqli                    = [];
                $sqli["database_utama"]  = $db;
                $sqli["database_id"]     = $row->id;
                $sqli["tipe_transaksi"]  = "Pembuatan";
                $sqli["waktu_perubahan"] = date('Y-m-d H:i:s');
                $sqli['data_awal']       = json_encode([
                    "db_utama"    => $db,
                    "db_utama_id" => $row->id,
                    "array_utama" => $row,
                ]);
                DB::insert("apps__transaksi", $sqli);
            }
        }

        // cari device transaksi, dengan parameter user login
        DB::table("apps__transaksi");
        DB::whereRaw("id not in(select  id_apps_transaksi from apps_device__transaksi  where id_apps_device =$id_device)");
        $ceking_device_id = DB::get('all');
        if ($ceking_device_id['num_rows']) {
            foreach ($ceking_device_id['row'] as $row) {
                $sqli                      = [];
                $sqli["id_apps_device"]    = $id_device;
                $sqli["id_apps_transaksi"] = $row->id;

                DB::insert("apps_device__transaksi", $sqli);
            }
        }
        $data_return = [];
        //foreach apps device_id untuk id diserahkan ke indexeddb;
        DB::table('apps_device__id');
        DB::whereRaw("id_apps_device =$id_device and db_name='$db' " . (($lase_device__id and $lase_device__id != 'undefined') ? "and id>=$lase_device__id" : ""));
        $ceking_device_id = DB::get('all');
        if ($ceking_device_id['num_rows']) {
            foreach ($ceking_device_id['row'] as $row) {

                $data_return["apps_id"]["$row->db_name"]["$row->db_id"] = $row->apps_id;
            }
        }

        DB::table('apps_device__transaksi');

        DB::selectRaw('*');
        DB::selectRaw('apps_device__transaksi.id as primary_key, apps_device__id.apps_id as primary_id');
        DB::joinRaw("apps__transaksi on id_apps_transaksi = apps__transaksi.id", 'left');
        DB::joinRaw("apps_device__id on db_id = apps__transaksi.database_id and db_name = database_utama", 'left');
        DB::whereRaw("apps_device__transaksi.id_apps_device =$id_device and database_utama='$db'
        and status_generate=0
        order by apps__transaksi.waktu_perubahan asc
        ");
        DB::limitRaw($page, 1);
        $ceking_device_id = DB::get('all');
        if ($ceking_device_id['num_rows']) {
            foreach ($ceking_device_id['row'] as $row) {

                $data_return["transaksi"][] = $row;
            }
        }
        $data_return["totaltransaksi"] = $ceking_device_id['num_rows_non_limit'];
        echo json_encode($data_return);
    }
    public static function int_external($page)
    {
        header('Content-Type: application/json');
        $type            = Partial::input('key');
        $_POST['offset'] = Partial::input('start');
        $data            = (ApiContent::$type($page));

        $return["res"]             = $data;
        $return["draw"]            = Partial::input('draw');
        $return["recordsTotal"]    = $data['data']['num_rows_non_limit'] ?? 1000000;
        $return["recordsFiltered"] = $data['data']['num_rows_non_limit'] ?? 1000000;
        $return["data"]            = $data['data']['row'];
        echo json_encode($return);
    }
    public static function dummy($page)
    {
        try {
            $headers = getallheaders();

            $decoded = base64_decode($headers['apps']);
            $data    = json_decode($decoded, true);
            $method  = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Unsupported method']);
        }
    }
    public static function select2($page)
    {
        try {
            $fai      = new MainFaiFramework();
            $apps     = Partial::input('apps');
            $function = Partial::input('page_view');
            $fields   = Partial::input('field');

            $page                            = $fai->Apps($apps, $function, $page);
            $array                           = $page['crud'];
            $page['section']                 = "api";
            $page['load_section']            = $page['section']            = "page";
            $page['section_initialize']      = "crud_utama";
            $page['database_provider']       = DATABASE_PROVIDER;
            $page['database_name']           = DATABASE_NAME;
            $page['conection_name_database'] = CONECTION_NAME_DATABASE;
            $page['conection_server']        = CONECTION_SERVER;
            $page['conection_user']          = CONECTION_USER;
            $page['conection_password']      = CONECTION_PASSWORD;
            $page['conection_scheme']        = CONECTION_SCHEME;
            $page['app_framework']           = APP_FRAMEWORK;
            for ($i = 0; $i < count($page['crud']['array']); $i++) {
                $field = $array['array'][$i][1];
                if (isset($field_array[$field])) {
                    echo 'Field ' . $field . " duplikat, silahkan hubungi admin";
                    die;
                } else {
                    $field_array[$field] = $i;
                }

                $type   = $array['array'][$i][2];
                $extype = explode('-', $type);
                $result = Packages::initialize_array($fai, $page, $array, $i, $field, $type, $extype);

                $page  = $result['page'];
                $array = $result['array'];

                if ($fields == $field) {
                    $select                                                   = ($array['array'][$i]);
                    $page['crud']['select_database_costum'][$fields]['utama'] = $select[3][0];
                    $page['crud']['select_database_costum'][$fields]['np']    = $select[3][0];
                    $row                                                      = Database::database_coverter($page, $page['crud']['select_database_costum'][$fields], [], 'all');
                    $return                                                   = [];
                    $toField                                                  = $array['array'][$i][3][2];
                    foreach ($row['row'] as $data) {
                        $return[] = ["id" => $data->primary_key, "text" => $data->$toField];
                    }
                    echo json_encode($return);
                    die;
                }
            }
            echo json_encode([]);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Unsupported method']);
        }
    }
    public static function crud($page)
    {
        try {
            $headers = getallheaders();

            $decoded = base64_decode($headers['apps']);
            $data    = json_decode($decoded, true);

            $fai                       = new MainFaiFramework();
            $page['load']['apps']      = $apps      = $data['apps'];
            $page['load']['page_view'] = $function = $data['page_view'];
            $page['load']['type']      = $type      = $data['load_type'];
            $page['load']['id']        = $id        = $data['load_page_id'];
            $page['load']['board']     = "-1";

            $page_temp                   = $page;
            $page                        = $fai->Apps($apps, $function, $page);
            $page                        = array_merge($page, $page_temp);
            $page['contentfaiframework'] = "pages";
            $page['load']['apps']        = $apps;
            $page['load']['page_view']   = $function;
            $page['load']['type']        = $type;
            $page['load']['id']          = $id;

            $page['load']['board']           = "-1";
            $page['load_section']            = $page['section']            = "page";
            $page['section_initialize']      = "crud_utama";
            $page['database_provider']       = DATABASE_PROVIDER;
            $page['database_name']           = DATABASE_NAME;
            $page['conection_name_database'] = CONECTION_NAME_DATABASE;
            $page['conection_server']        = CONECTION_SERVER;
            $page['conection_user']          = CONECTION_USER;
            $page['conection_password']      = CONECTION_PASSWORD;
            $page['conection_scheme']        = CONECTION_SCHEME;
            $page['app_framework']           = APP_FRAMEWORK;
            $page['database']['np']          = true;
            /* $page['crud']['database_utama'] =  $page['database']['utama'];
			$returnddv =  	CRUDFunc::declare_crud_variable($fai, $page, $page['crud']['array'], $page['database'], $type, [], $page['crud']);

			$where_raw_temp = $returnddv['$where_raw_temp'];
			$sqli = $returnddv['$sqli'];
			$field_appr =  $returnddv['$field_appr'];
			$where = $returnddv['$where'];
			$select = $returnddv['$select'];
			$join = $returnddv['$join'];

			$sqlen = $returnddv['$sqlen'];
			$sqli_to_database = $returnddv['$sqli_to_database'];
			$sqlfile = $returnddv['$sqlfile'];

			$page['database']['select'] = array_merge($page['database']['select'], $select);
			$page['database']['where'] =   array_merge($page['database']['where'], $where);
			if (isset($page['database']['join']))
				$page['database']['join'] =   array_merge($page['database']['join'], $join);
			else
				$page['database']['join'] =   $join;
			
			$row = $fai->database_coverter($page, $page['database'], [], 'all');*/
            $page['mainAll']      = 2;
            $page['load_section'] = 'admin';
            $page                 = Packages::initialize($page);
            $method               = $headers['METHODE'] ?? $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $method;
            switch ($method) {
                case 'GET':
                    $row = Packages::crud($page, "get_list", $id);

                    $return["draw"]            = Partial::input('draw');
                    $return["recordsTotal"]    = $row['num_rows_non_limit'] ?? 1000000;
                    $return["recordsFiltered"] = $row['num_rows_non_limit'] ?? 1000000;
                    $return["data"]            = $row['row'];
                    //unset($row["query"]);
                    echo json_encode($return);
                    break;

                case 'PATCH':

                    $DB = $page['crud']['sub_kategori'][Partial::input('index')][1];
                    if (Partial::input('parent_id')) {
                        $page['crud']['database_sub_kategori'][$DB]['where'][] = ["id_" . $page['database']['utama'], " = ", Partial::input('parent_id')];
                    }
                    $utama                                                  = $page['database']['utama'];
                    $page['crud']['database_sub_kategori'][$DB]['where'][]  = ["" . $DB, ".active = ", 1];
                    $page['crud']['database_sub_kategori'][$DB]['select'][] = "$utama.*";
                    $page['crud']['database_sub_kategori'][$DB]['join'][]   = [$utama, "$utama.id", "$DB.id_$utama", "left"];
                    $row                                                    = Database::database_coverter($page, $page['crud']['database_sub_kategori'][$DB], [], 'all');
                    $return["draw"]                                         = Partial::input('draw') ?? 1;
                    $return["recordsTotal"]                                 = $row['num_rows_non_limit'] ?? 1000000;
                    $return["recordsFiltered"]                              = $row['num_rows_non_limit'] ?? 1000000;
                    $return["data"]                                         = $row['row'];
                    $return["query"]                                        = $row['query'];
                    //unset($row["query"]);
                    echo json_encode($return);
                    die;

                    break;

                case 'POST':
                    $save = Packages::crud($page, "save", $id);

                    echo json_encode($save);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':

                    $id = Partial::input('id');

                    $save = Packages::crud($page, "hapus", $id);
                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function warehouse_racks($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
            switch ($method) {
                case 'GET':

                    $db['select'][] = "
                            *,inventaris__asset__tanah__gudang__ruang_bangun.id
                            , concat(inventaris__asset__tanah__gudang.nama_gudang
                            ,' -  ',inventaris__asset__tanah__gudang__ruang_bangun.nama_ruang_simpan ) as name

                    ";
                    $db['np']      = "t";
                    $db['utama']   = "inventaris__asset__tanah__gudang__ruang_bangun";
                    $db['join'][]  = ["inventaris__asset__tanah__gudang", " inventaris__asset__tanah__gudang.id", "id_inventaris__asset__tanah__gudang", "LEFT"];
                    $db['where'][] = ["inventaris__asset__tanah__gudang__ruang_bangun.active", "=", 1];
                    $db['where'][] = ["inventaris__asset__tanah__gudang.active", "=", 1];

                    $row = Database::database_coverter($page, $db, [], 'all');

                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save                         = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan           = $save['id'];
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }

                    echo json_encode(["success" => 1, "data" => ["po_id" => $pesanan_id, "id" => $pesanan_id, "created_at" => date('Y-m-d H:i:s'), "status" => "proses"]]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function sales_orders($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
            switch ($method) {
                case 'GET':

                    $db['select'][] = "
                            store__produk.id_asset
                            ,erp__pos__utama__detail.id_produk as id_produk_utama,
                            erp__pos__utama__detail.id as id_detail
                            ,berat
                            ,berat_varian
                            ,varian_barang
                            ,nama_barang
                            ,nama_varian
                            ,barcode_varian as barcode
                            ,store__produk.id_toko
                            ,erp__pos__utama__detail.*

                    ";
                    $db['as']     = "t";
                    $db['np']     = "t";
                    $db['utama']  = "erp__pos__utama__detail";
                    $db['join'][] = ["store__produk", " store__produk.id", "erp__pos__utama__detail.id_produk", "LEFT"];
                    $db['join'][] = ["store__toko", " store__toko.id", "store__produk.id_toko", "LEFT"];
                    $db['join'][] = ["inventaris__asset__list_query", " inventaris__asset__list.id", "erp__pos__utama__detail.id_inventaris__asset__list", "LEFT"];
                    $db['join'][] = ["inventaris__asset__list__varian", " inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list and cast(id_barang_varian as int) = inventaris__asset__list__varian.id", "LEFT"];

                    $db['where'][] = ["qty", ">=", 1];
                    if ($page['database_provider'] == 'mysql') {

                        $dbp      = $db;
                        $getquery = Database::database_coverter($page, $dbp, [], 'source');
                        $query    = "$getquery  LIMIT 1";
                        $conn     = DB::getConn($page);
                        $result   = mysqli_query($conn, $query);

                        // Ambil nama kolom dari hasil query
                        $columns = [];
                        $pairs   = [];
                        $alias   = "t";
                        while ($field = mysqli_fetch_field($result)) {
                            $columns[] = $col = $field->name;
                            $pairs[]   = "'$col', $alias.$col";
                        }
                    }

                    $dbGroup['join_subquery'][] = [
                        [

                            "as"               => "produk",
                            "np"               => "",
                            "not_where_active" => "",
                            "select"           => [
                                $page['database_provider'] == 'postgres' ? "id_erp__pos__group,json_agg(row_to_json(t)) as items" : "id_erp__pos__group,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as items",
                            ],
                            "utama_query"      => $db,
                            "group"            => [
                                "t.id_erp__pos__group",
                            ],

                        ],
                        "produk.id_erp__pos__group",
                        "erp__pos__group.id",
                    ];

                    $dbGroup['np']       = "erp__pos__group";
                    $dbGroup['select'][] = "*,'process' as status,(select sum(grand_total) FROM erp__pos__utama__detail where erp__pos__utama__detail.id_erp__pos__group=erp__pos__group.id) as total,nama_lengkap,email";
                    $dbGroup['utama']    = "erp__pos__group";
                    $dbGroup['where'][]  = ["tipe_group", "!=", "'Pembelian Barang'"];
                    $dbGroup['order'][]  = ["erp__pos__group.id", "desc"];
                    $dbGroup['join'][]   = ["apps_user", "apps_user.id_apps_user", "erp__pos__group.id_apps_user"];
                    $row                 = Database::database_coverter($page, $dbGroup, [], 'all');

                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save                         = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan           = $save['id'];
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }

                    echo json_encode(["success" => 1, "data" => ["po_id" => $pesanan_id, "id" => $pesanan_id, "created_at" => date('Y-m-d H:i:s'), "status" => "proses"]]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function purchase_orders($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body    = json_decode(file_get_contents("php://input"), true);
            $headers = getallheaders();
            switch ($method) {
                case 'GET':

                    $row = DatabaseFunc::purchase_order($page);
                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save               = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan = $save['id'];
                    CRUDFunc::crud_update($fai, $page, ["status_penerimaan" => $body['status_penerimaan'], "status_payment" => $body['status_payment'] ?? 'belum', "notes" => $body['notes']], [], [], [], 'erp__pos__group', 'id', $id_group_pemesanan);
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }
                    $row = DatabaseFunc::purchase_order($page, $id_group_pemesanan);
                    echo json_encode(["success" => 1, "data" => $row['row'][0], "po_id" => $pesanan_id]);
                    break;

                case 'PUT':
                    $id   = $headers['id'];
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $id   = $headers['id'];
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    if (isset($headers['endpoint'])) {
                        if ($headers['endpoint'] == 'update') {
                            $id = $headers['curentpoid'];
                            CRUDFunc::crud_update($fai, $page, $body, [], [], [], 'erp__pos__group', 'id', $id);
                        } else
                        if ($headers['endpoint'] == 'update_items') {
                            $detail['qty']          = $body['quantity'];
                            $detail['qty_pesanan']  = $body['quantity'];
                            $detail['total_diskon'] = $body['discounted_price'];
                            $detail['grand_total']  = $body['selling_price'];
                            $detail['diskon_utama'] = $body['purchase_discount'];
                            CRUDFunc::crud_update($fai, $page, $detail, [], [], [], 'erp__pos__utama__detail', 'id', $body['id_detail']);
                        } else
                        if ($headers['endpoint'] == 'tambah_items') {
                            $detail['id_erp__pos__utama'] = $headers['po'];
                            $detail['id_erp__pos__group'] = $headers['curentpoid'];
                            foreach ($body['items'] as $items) {
                                $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                                $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                                $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                                $detail['qty']                        = $items['quantity'];
                                $detail['qty_pesanan']                = $items['quantity'];
                                $detail['total_diskon']               = $items['discounted_price'];
                                $detail['grand_total']                = $items['selling_price'];
                                $detail['diskon_utama']               = $items['purchase_discount'];
                                $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                                $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                                $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                                $detail['tipe_diskon']                = 'Presentase';

                                CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                            }
                        } else
                        if ($headers['endpoint'] == 'delete_items') {
                            CRUDFunc::crud_update($fai, $page, ["active" => 0], [], [], [], 'erp__pos__utama__detail', 'id', $body['id_detail']);
                        }
                        $row = DatabaseFunc::purchase_order($page, $headers['curentpoid']);
                        echo json_encode([
                            'success' => true,
                            'message' => 'Data berhasil diperbarui',
                            'data'    => $row['row'][0],
                        ]);
                    } else {

                        parse_str(file_get_contents("php://input"), $data);
                        echo json_encode(['method' => $method, 'data' => $data]);
                    }
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }

    public static function stok_opname($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
            switch ($method) {
                case 'GET':

                    $db['select'][] = " erp__pos__stok_opname__detail.*,
		inventaris__asset__list.nama_barang
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


        ";
                    $db['as']             = "t";
                    $db['np']             = "t";
                    $db['non_add_select'] = "t";
                    $db['utama']          = "erp__pos__stok_opname__detail";
                    $db['join'][]         = ["inventaris__asset__list", "inventaris__asset__list.id", "id_asset"];
                    $db['join'][]         = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_asset_varian", 'left'];

                    if ($page['database_provider'] == 'mysql') {

                        $dbp      = $db;
                        $getquery = Database::database_coverter($page, $dbp, [], 'source');
                        $query    = "$getquery  LIMIT 1";
                        $query;
                        $conn   = DB::getConn($page);
                        $result = mysqli_query($conn, $query);

                        // Ambil nama kolom dari hasil query
                        $columns = [];
                        $pairs   = [];
                        $alias   = "t";
                        while ($field = mysqli_fetch_field($result)) {
                            $columns[] = $col = $field->name;
                            $pairs[]   = "'$col', $alias.$col";
                        }
                    }

                    $dbPayment['join_subquery'][] = [
                        [

                            "as"               => "details",
                            "np"               => "",
                            "not_where_active" => "",
                            "select"           => [
                                $page['database_provider'] == 'postgres' ? "id_erp__pos__delivery_order,json_agg(row_to_json(t)) as detail" :
                                "id_erp__pos__stok_opname,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as detail",
                            ],
                            "utama_query"      => $db,
                            "group"            => [
                                "t.id_erp__pos__stok_opname",
                            ],

                        ],
                        "details.id_erp__pos__stok_opname",
                        "erp__pos__stok_opname.id",
                    ];

                    $dbPayment['where'][]  = ["detail", ' is ', " not null"];
                    $dbPayment['select'][] = " *



        ";
                    $dbPayment['as']    = "t";
                    $dbPayment['np']    = "t";
                    $dbPayment['limit'] = "100";
                    $dbPayment['utama'] = "erp__pos__stok_opname";

                    $row = Database::database_coverter($page, $dbPayment, [], 'all');

                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save                         = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan           = $save['id'];
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }

                    echo json_encode(["success" => 1, "data" => ["po_id" => $pesanan_id, "id" => $pesanan_id, "created_at" => date('Y-m-d H:i:s'), "status" => "proses"]]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function delivery_orders($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
            switch ($method) {
                case 'GET':

                    $db['select'][] = " erp__pos__delivery_order__detail.*


        ";
                    $db['as']    = "t";
                    $db['np']    = "t";
                    $db['utama'] = "erp__pos__delivery_order__detail";

                    if ($page['database_provider'] == 'mysql') {

                        $dbp      = $db;
                        $getquery = Database::database_coverter($page, $dbp, [], 'source');
                        $query    = "$getquery  LIMIT 1";
                        $query;
                        $conn   = DB::getConn($page);
                        $result = mysqli_query($conn, $query);

                        // Ambil nama kolom dari hasil query
                        $columns = [];
                        $pairs   = [];
                        $alias   = "t";
                        while ($field = mysqli_fetch_field($result)) {
                            $columns[] = $col = $field->name;
                            $pairs[]   = "'$col', $alias.$col";
                        }
                    }

                    $dbPayment['join_subquery'][] = [
                        [

                            "as"               => "details",
                            "np"               => "",
                            "not_where_active" => "",
                            "select"           => [
                                $page['database_provider'] == 'postgres' ? "id_erp__pos__delivery_order,json_agg(row_to_json(t)) as detail" :
                                "id_erp__pos__delivery_order,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as detail",
                            ],
                            "utama_query"      => $db,
                            "group"            => [
                                "t.id_erp__pos__delivery_order",
                            ],

                        ],
                        "details.id_erp__pos__delivery_order",
                        "erp__pos__delivery_order.id",
                    ];

                    $dbPayment['select'][] = " erp__pos__delivery_order.*,erp__pos__utama.id_erp__pos__group,detail,


		case when nomor_resi = '-' then erp__pos__delivery_order.nomor_resi_ecommerce
		else coalesce(nomor_resi,erp__pos__delivery_order.nomor_resi_ecommerce)
		end as nomor_resi
				,'pending' as status



        ";
                    $dbPayment['as']    = "t";
                    $dbPayment['np']    = "t";
                    $dbPayment['utama'] = "erp__pos__delivery_order";

                    $dbPayment['join'][] = ["erp__pos__utama", 'erp__pos__utama.id', 'erp__pos__delivery_order.id_erp__pos__utama', 'left'];
                    $row                 = Database::database_coverter($page, $dbPayment, [], 'all');

                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save                         = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan           = $save['id'];
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }

                    echo json_encode(["success" => 1, "data" => ["po_id" => $pesanan_id, "id" => $pesanan_id, "created_at" => date('Y-m-d H:i:s'), "status" => "proses"]]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function payments($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body    = json_decode(file_get_contents("php://input"), true);
            $headers = getallheaders();
            switch ($method) {
                case 'GET':

                    $row = DatabaseFunc::payments($page);
                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $bodyAdd = $body;
                    unset($bodyAdd['id']);
                    unset($bodyAdd['split_bill']);
                    $insert = $bodyAdd;
                    $id     = CRUDFunc::crud_insert($fai, $page, $insert, [], 'erp__pos__payment');

                    foreach ($body['split_bill'] as $items) {

                        // CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }
                    $row = DatabaseFunc::payments($page, $id);
                    echo json_encode(["success" => 1, "data" => $row['row'][0]]);
                    break;

                case 'PUT':
                    // $save = Packages::crud($page, "update", $id);

                    // echo json_encode($save);
                    break;
                case 'DELETE':
                    // $save = Packages::crud($page, "hapus", $id);

                    // echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    if (isset($headers['endpoint'])) {
                        if ($headers['endpoint'] == 'load_by_group_id') {
                            $db_where['utama']['where'][] = ["id_erp__pos__group", "=", $body['currentPoId']];
                            $row                          = DatabaseFunc::payments($page, "", $db_where);
                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                                'data'    => $row['row'],
                            ]);
                        } else if ($headers['endpoint'] == 'confirm_lunas') {
                            CRUDFunc::crud_update($fai, $page, ["status_payment x" => "lunas", "update_date" => date("Y-m-d H:i:s")], [], [], [], 'erp__pos__payment', 'id', $body['paymentId']);
                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                                "id"      => $body['paymentId'],
                            ]);
                        } else if ($headers['endpoint'] == 'add_konfirm') {
                            $id = CRUDFunc::crud_insert($fai, $page, $body, [], 'erp__pos__payment__bayar__konfirm');
                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                                "id"      => $id,
                                // 'data' => $row['row']
                            ]);
                        } else if ($headers['endpoint'] == 'add_bayar') {
                            $payment                        = explode('-', $body['paymentMethod']);
                            $insert['id_metode_bayar']      = $payment[1];
                            $insert['id_payment_brand']     = $payment[0];
                            $insert['jumlah_bayar']         = $body['nominal'];
                            $insert['tanggal_bayar_split']  = $body['paymentDate'];
                            $insert['id_akun_bank']         = $body['coa'];
                            $insert['id_erp__pos__payment'] = $body['id_erp__pos__payment'];
                            $id                             = CRUDFunc::crud_insert($fai, $page, $insert, [], 'erp__pos__payment__bayar');

                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                                "id"      => $id,
                                // 'data' => $row['row']
                            ]);
                        }
                    } else {

                        parse_str(file_get_contents("php://input"), $data);
                        echo json_encode(['method' => $method, 'data' => $data]);
                    }
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function outgoings($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REQUEST_METHOD'];
            header('Content-Type: application/json');
            $body = json_decode(file_get_contents("php://input"), true);
            switch ($method) {
                case 'GET':

                    $dbKonfir['select'][] = "
		*

        ";
                    $dbKonfir['as']    = "t";
                    $dbKonfir['np']    = "t";
                    $dbKonfir['utama'] = "erp__pos__inventory__outgoing_breakdown";

                    if ($page['database_provider'] == 'mysql') {

                        $dbp      = $dbKonfir;
                        $getquery = Database::database_coverter($page, $dbp, [], 'source');
                        $query    = "$getquery  LIMIT 1";
                        $conn     = DB::getConn($page);
                        $result2  = mysqli_query($conn, $query);

                        // Ambil nama kolom dari hasil query
                        $columns = [];
                        $pairs   = [];
                        $alias   = "t";
                        while ($field2 = mysqli_fetch_field($result2)) {
                            $columns[] = $col = $field2->name;
                            $pairs[]   = "'$col', $alias.$col";
                        }
                    }

                    $db['join_subquery'][] = [
                        [

                            "as"               => "outBreak",
                            "np"               => "",
                            "not_where_active" => "",
                            "select"           => [
                                $page['database_provider'] == 'postgres' ? "id_erp__pos__inventory__outgoing,json_agg(row_to_json(t)) as breakdown" :
                                "id_erp__pos__inventory__outgoing,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as breakdown",
                            ],
                            "utama_query"      => $dbKonfir,
                            "group"            => [
                                "t.id_erp__pos__inventory__outgoing",
                            ],

                        ],
                        "outBreak.id_erp__pos__inventory__outgoing",
                        "erp__pos__inventory__outgoing.id",
                    ];

                    $db['select'][] = " erp__pos__inventory_detail.*,id_erp__pos__inventory__outgoing,breakdown, inventaris__asset__list.nama_barang
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


        ";
                    $db['as']             = "t";
                    $db['np']             = "t";
                    $db['non_add_select'] = "t";
                    $db['utama']          = "erp__pos__inventory_detail";

                    $db['join'][] = ["erp__pos__inventory__outgoing", " erp__pos__inventory_detail.id", "erp__pos__inventory__outgoing.id_erp__pos__inventory_detail", "LEFT"];

                    $db['join'][] = ["inventaris__asset__list", "inventaris__asset__list.id", "id_barang_keluar"];
                    $db['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_keluar_varian", 'left'];

                    if ($page['database_provider'] == 'mysql') {

                        $dbp      = $db;
                        $getquery = Database::database_coverter($page, $dbp, [], 'source');
                        $query    = "$getquery  LIMIT 1";
                        $query;
                        $conn   = DB::getConn($page);
                        $result = mysqli_query($conn, $query);

                        // Ambil nama kolom dari hasil query
                        $columns = [];
                        $pairs   = [];
                        $alias   = "t";
                        while ($field = mysqli_fetch_field($result)) {
                            $columns[] = $col = $field->name;
                            $pairs[]   = "'$col', $alias.$col";
                        }
                    }

                    $dbPayment['join_subquery'][] = [
                        [

                            "as"               => "produk",
                            "np"               => "",
                            "not_where_active" => "",
                            "select"           => [
                                $page['database_provider'] == 'postgres' ? "id_erp__pos__inventory,json_agg(row_to_json(t)) as items" :
                                "id_erp__pos__inventory,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as items",
                            ],
                            "utama_query"      => $db,
                            "group"            => [
                                "t.id_erp__pos__inventory",
                            ],

                        ],
                        "produk.id_erp__pos__inventory",
                        "erp__pos__inventory.id",
                    ];

                    $dbPayment['select'][] = " erp__pos__inventory.*,items,erp__pos__utama.id_erp__pos__group




        ";
                    $dbPayment['as']     = "t";
                    $dbPayment['np']     = "t";
                    $dbPayment['utama']  = "erp__pos__inventory";
                    $dbPayment['join'][] = ["erp__pos__utama", 'erp__pos__utama.id', 'erp__pos__inventory.id_order', 'left'];

                    $row = Database::database_coverter($page, $dbPayment, [], 'all');

                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    //$save = Packages::crud($page, "save", $id);
                    $save                         = EcommerceApp::inisiate_store_pesanan_group($page, 1, "Pembelian Barang");
                    $id_group_pemesanan           = $save['id'];
                    $pemesanan                    = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, 4, "Proses");
                    $pesanan_id                   = $pemesanan['id'];
                    $detail['id_erp__pos__group'] = $save['id'];
                    $detail['id_erp__pos__utama'] = $pesanan_id;
                    foreach ($body['items'] as $items) {
                        $detail['id_inventaris__asset__list'] = $items['produk_detail']['id_asset'];
                        $detail['id_barang_varian']           = $items['variant_detail']['id_barang_varian'];
                        $detail['harga_penjualan']            = $items['variant_detail']['harga_pokok_varian'];
                        $detail['qty']                        = $items['quantity'];
                        $detail['qty_pesanan']                = $items['quantity'];
                        $detail['total_diskon']               = $items['discounted_price'];
                        $detail['grand_total']                = $items['selling_price'];
                        $detail['diskon_utama']               = $items['purchase_discount'];
                        $detail['berat_satuan']               = $items['variant_detail']['berat_varian'];
                        $detail['berat_total']                = $detail['qty'] * $items['variant_detail']['berat_varian'];
                        $detail['total_harga']                = $detail['qty'] * $detail['harga_penjualan'];
                        $detail['tipe_diskon']                = 'Presentase';

                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__utama__detail');
                    }

                    echo json_encode(["success" => 1, "data" => ["po_id" => $pesanan_id, "id" => $pesanan_id, "created_at" => date('Y-m-d H:i:s'), "status" => "proses"]]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    parse_str(file_get_contents("php://input"), $data);
                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }

    public static function receivings($page)
    {
        $fai = new MainFaiFramework();
        try {
            $method = $_SERVER['REDIRECT_HTTP_METHOD'] ?? $_SERVER['REQUEST_METHOD'];
            $body   = json_decode(file_get_contents("php://input"), true);
            // print_R($body);
            $headers = getallheaders();

            // $decoded = base64_decode();

            header('Content-Type: application/json');
            switch ($method) {
                case 'GET':

                    $row = DatabaseFunc::receivings($page);
                    echo json_encode($row["row"]);
                    break;

                case 'POST':
                    $id_pemesanan = $body['po_id'];

                    $input = [];
                    DB::table('erp__pos__inventory');
                    DB::whereRaw('erp__pos__inventory.id_order=' . $body['po_id']);
                    $inv = DB::get('all');
                    //$input['nomor_receive'] = $id_pemesanan;
                    $input['id_order']                                                                               = $id_pemesanan;
                    $input['tanggal_diterima']                                                                       = date('Y-m-d');
                    $page_out                                                                                        = $page;
                    $page_outNumber                                                                                  = $page;
                    $nomor_add                                                                                       = ".PO";
                    $page_outNumber['crud']['view']                                                                  = 'tambah';
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['prefix']                         = "REC$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['database_utama']                 = "erp__pos__inventory__receive";
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['type'][0]                = 'count-month';
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['type'][0]                = 'count-month';
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['sprintf'][0]             = true;
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['sprintf_number'][0]      = 5;
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['month_get_row_where'][0] = "tanggal_receive";
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['root']['not_string']             = "tanggal_receive";
                    $page_outNumber['crud']['insert_number_code']['nomor_receive']['suffix']                         = '';

                    $getNumberRecceive = $page_out['nomor_receive'] = CRUDFunc::insert_number_code_nomor($fai, $page_outNumber, "nomor_receive", "")['valueinput'];
                    if ($inv['num_rows']) {
                        //if (!$inv['row'][0]->nomor_receive) {

                        //	CRUDFunc::crud_update($fai, $page_out, $input, [], [], [], 'erp__pos__inventory', 'id', $inv['row'][0]->id);
                        //}
                        $insert_id = $inv['row'][0]->id;
                    } else {
                        $input['id_order'] = $id_pemesanan;
                        $insert_id         = CRUDFunc::crud_insert($fai, $page_out, $input, [], "erp__pos__inventory", []);
                    }
                    $inventori[$id_pemesanan] = $insert_id;
                    $id_detail                = $body['po_id'];
                    $erp_inv_detail           = [];
                    $erp_inv_rec              = [];
                    foreach ($body['entries'] as $detail) {
                        $invdet = [];
                        if (! isset($detail['detail']['id_detail'])) {
                            $dbSearch['utama']   = "erp__pos__utama__detail";
                            $dbSearch['where'][] = ["id_erp__pos__utama", "=", $detail['po_id']];
                            $dbSearch['where'][] = ["id_barang_varian", "=", $detail['detail']['variant_detail']['id_barang_varian']];
                            $dbSearch['where'][] = ["id_inventaris__asset__list", "=", $detail['detail']['produk_detail']['id_asset']];
                            $rowSeaarch          = Database::database_coverter($page, $dbSearch, [], 'all');
                            if ($rowSeaarch['num_rows']) {
                                $detail['detail']['id_detail'] = $rowSeaarch['row'][0]->id;
                            }
                        }
                        if (! isset($erp_inv_detail[$detail['detail']['id_detail']])) {
                            $dbInv['utama']   = "erp__pos__inventory_detail";
                            $dbInv['where'][] = ["erp__pos__utama__detail_id", "=", $detail['detail']['id_detail']];
                            $rowDet           = Database::database_coverter($page, $dbInv, [], 'all');
                            if ($rowDet['num_rows']) {
                                $insert_id_det = $erp_inv_detail[$detail['detail']['id_detail']] = $rowDet['row'][0]->id;
                            } else {
                                $invdet['erp__pos__utama__detail_id']     = $detail['detail']['id_detail'];
                                $invdet['id_erp__pos__utama__detail_get'] = $detail['detail']['id_detail'];
                                $invdet['qty_pesan']                      = $detail['detail']['qty'];
                                $invdet['id_inventaris__asset__list']     = $detail['detail']['id_inventaris__asset__list'];
                                $invdet['id_asset_varian_inv']            = $detail['detail']['id_barang_varian'];
                                $invdet['id_produk_inv']                  = null;
                                $invdet['id_produk_varian_inv']           = null;
                                $invdet['id_erp__pos__inventory']         = $inventori[$id_pemesanan];

                                $insert_id_det                                  = CRUDFunc::crud_insert($fai, $page, $invdet, [], "erp__pos__inventory_detail", []);
                                $erp_inv_detail[$detail['detail']['id_detail']] = $insert_id_det;
                            }
                        } else {
                            $insert_id_det = $erp_inv_detail[$detail['detail']['id_detail']];
                        }
                        $dbGud            = [];
                        $dbGud['utama']   = "inventaris__asset__tanah__gudang__ruang_bangun";
                        $dbGud['where'][] = ["id", "=", $detail['rack_id']];
                        $rowGud           = Database::database_coverter($page, $dbGud, [], 'all');

                        if (! $rowGud['num_rows']) {
                            echo json_encode(["success" => 0, "message" => "Gudang dengan ID " . $detail['rack_id'] . " tidak dikenali"]);
                            exit;
                        }
                        if (! isset($erp_inv_rec[$detail['detail']['id_detail']])) {
                            $dbInvRec['utama']   = "erp__pos__inventory__receive";
                            $dbInvRec['where'][] = ["id_erp__pos__inventory_detail", "=", $detail['detail']['id_detail']];
                            $rowDetRec           = Database::database_coverter($page, $dbInvRec, [], 'all');
                            if ($rowDetRec['num_rows']) {
                                $insert_id_out = $erp_inv_rec[$detail['detail']['id_detail']] = $rowDetRec['row'][0]->id;
                            } else {
                                $invout                                  = [];
                                $invout['id_erp__pos__inventory_detail'] = $insert_id_det;
                                $invout['id_barang_masuk']               = $detail['detail']['id_inventaris__asset__list'];
                                $invout['id_barang_masuk_varian']        = $detail['detail']['id_barang_varian'];
                                $invout['id_produk_masuk']               = null;
                                $invout['id_produk_varian_masuk']        = null;
                                $invout['qty_pesan_masuk']               = $detail['detail']['qty'];
                                $invout['id_erp__pos__inventory']        = $inventori[$id_pemesanan];
                                $invout['nomor_receive']                 = $getNumberRecceive;
                                $invout['tanggal_receive']               = date('Y-m-d');
                                $insert_id_out                           = CRUDFunc::crud_insert($fai, $page, $invout, [], "erp__pos__inventory__receive", []);
                            }
                        } else {
                            $insert_id_out = $erp_inv_rec[$detail['detail']['id_detail']];
                        }
                        $out_break                                    = [];
                        $out_break['id_erp__pos__inventory']          = $inventori[$id_pemesanan];
                        $out_break['id_erp__pos__inventory_detail']   = $insert_id_det;
                        $out_break['id_erp__pos__inventory__receive'] = $insert_id_out;
                        $out_break['id_erp__utama__detail_masuk']     = $detail['detail']['id_detail'];

                        $out_break['id_gudang_in']       = $rowGud['row'][0]->id_inventaris__asset__tanah__gudang;
                        $out_break['id_ruang_simpan_in'] = $detail['rack_id'];
                        $out_break['harga_beli_in']      = $detail['unit_price'];
                        $out_break['stok_in']            = null;
                        //$out_break['urutan'] = $urutan;;
                        $out_break['qty_masuk_in'] = $detail['quantity_received'];
                        $id_breakdown              = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $out_break, [], "erp__pos__inventory__receive_breakdown", []);
                    }
                    // $row = DatabaseFunc::receivings($page);
                    echo json_encode(["success" => 1, "data" => []]);
                    break;

                case 'PUT':
                    $save = Packages::crud($page, "update", $id);

                    echo json_encode($save);
                    break;
                case 'DELETE':
                    $save = Packages::crud($page, "hapus", $id);

                    echo json_encode($save);
                    break;
                case 'PATCH':
                    // Untuk PUT/DELETE/PATCH, data tidak otomatis masuk ke $_POST
                    if (isset($headers['endpoint'])) {
                        if ($headers['endpoint'] == 'delete') {
                            CRUDFunc::crud_update($fai, $page, ["active" => 0], [], [], [], 'erp__pos__inventory__receive', 'id', $body['receiveId']);
                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                            ]);
                        } else
                        if ($headers['endpoint'] == 'update') {
                            $input = json_decode(file_get_contents('php://input'), true);

                            // Validasi input
                            if (! isset($input['id_order']) || ! isset($input['receiving_id'])) {
                                throw new Exception('Data tidak lengkap');
                            }

                            $receivingId = $input['receiving_id'];
                            $idOrder     = $input['id_order'];

                            // Process updates
                            if (isset($input['breakdown_updates']) && is_array($input['breakdown_updates'])) {
                                foreach ($input['breakdown_updates'] as $update) {
                                    $id = $update['id'];
                                    unset($update['id']);
                                    $update['update_date'] = date('Y-m-d H:i:s');
                                    CRUDFunc::crud_update($fai, $page, $update, [], [], [], 'erp__pos__inventory__receive_breakdown', 'id', $id);
                                }
                            }

                            // Process creates
                            $newBreakdowns = [];
                            if (isset($input['breakdown_creates']) && is_array($input['breakdown_creates'])) {
                                foreach ($input['breakdown_creates'] as $create) {
                                    // $newId = $this->createBreakdown($create);
                                    // $newBreakdowns[] = $this->getBreakdownById($newId);
                                }
                            }

                            // Process deletes
                            if (isset($input['breakdown_deletes']) && is_array($input['breakdown_deletes'])) {
                                foreach ($input['breakdown_deletes'] as $delete) {
                                    // $this->deleteBreakdown($delete['id'], $delete);
                                }
                            }

                            // Get updated breakdowns
                            $breakdowns = DatabaseFunc::receivings($page, "breakdown_by_receive_id", $receivingId);

                            // if (count($body['breakdown_updates'] ?? [])) {

                            //     foreach ($body['breakdown_updates'] as $update) {

                            //     }
                            // }
                            echo json_encode([
                                'success' => true,
                                'message' => 'Data berhasil diperbarui',
                                'data'    => [
                                    'receiving_id' => $receivingId,
                                    'breakdowns'   => $breakdowns,
                                ],
                            ]);
                        }
                    } else {

                        $row = DatabaseFunc::receivings($page, "row", $body['currentPoId']);
                        echo json_encode($row["row"]);
                    }
                    break;

                    echo json_encode(['method' => $method, 'data' => $data]);
                    break;

                default:
                    echo json_encode(['error' => 'Unsupported method']);
                    break;
            }
        } catch (Exception $e) {
            echo "Error MySQL: " . $e->getMessage();
        }
    }
    public static function add_rumah_pengisi($page)
    {
        ob_start();
        try {
            $fai                                             = new MainFaiFramework();
            $insert['id_apps_user']                          = Partial::input('id_user');
            $insert['id_inventaris__asset__tanah__bangunan'] = Partial::input('id_bangunan');
            $last_id_payment                                 = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__tanah__bangunan__pengisi');

            $get = ob_get_clean();
            if (strpos($get, 'PHP Error')) {
                echo json_encode(["status" => 0, 'error' => $get]);
            } else {
                echo json_encode(["status" => 1, "last_id" => $last_id_payment]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => 0, 'error' => $e]);
        }
    }
    public static function get_firsh_ongkir($page)
    {
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
        // $update['jenis'] = 'Ongkir';
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
    public static function restructureFromJS($convertedData)
    {
        $result = [];

        foreach ($convertedData as $item) {
            $key   = $item[0];
            $value = $item[1];

            // Jika value adalah array hasil Object.entries()
            if (is_array($value) && array_keys($value) === range(0, count($value) - 1)) {
                // Cek apakah ini nested object (array 2D)
                $isNestedObject = true;
                foreach ($value as $subItem) {
                    if (! is_array($subItem)) {
                        $isNestedObject = false;
                        break;
                    }
                }

                if ($isNestedObject) {
                    $value = ApiApp::restructureFromJS($value); // Rekursif untuk nested objects
                }
            }

            $result[$key] = $value;
        }

        return $result;
    }
    public static function get_db_json($page, $body_temp = [], $return = 'json')
    {
        error_reporting(E_ALL);
        try {
            /*
			 live =1 untuk apa? 
				
				
			 live =2 untuk apa? 
			 no live untuk apa? 
			 
			 
			 LIVE 1 dan 2 tanpa proses ke current dan perubahan langsung print
			 
			 no live dengan proses
			 
			 BEDA 1 adalah no key dan 2 with key
			 */

            // header("Access-Control-Allow-Origin: http://localhost:8080"); // Ganti dengan origin frontend
            // header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            // header("Access-Control-Allow-Headers: Content-Type, Authorization");
            $page['database_provider']       = DATABASE_PROVIDER;
            $page['database_name']           = DATABASE_NAME . '_json';
            $page['conection_name_database'] = CONECTION_NAME_DATABASE . '_json';
            $page['conection_server']        = CONECTION_SERVER;
            $page['conection_user']          = CONECTION_USER;
            $page['conection_user']          = $page['database_provider'] == 'mysql' ? CONECTION_USER . '_json' : CONECTION_USER;
            $page['conection_password']      = CONECTION_PASSWORD;
            $page['conection_scheme']        = CONECTION_SCHEME;
            if (! count($body_temp)) {
                $body = json_decode(file_get_contents("php://input"), true);
            } else {
                $body = $body_temp;
            }

            $search       = $body['search'] ?? [];
            $array_search = ApiApp::restructureFromJS($search['array'] ?? []);
            header('Content-Type: application/json; charset=utf-8');
            $db         = $body['db'] ?? 'inventaris__asset__master__kategori_toko';
            $db_to_json = Partial::input('db') ?? $db;
            if ($_GET['live'] ?? '') {
                $search['live'] = $_GET['live'];
            }
            if (($search['live'] ?? '') == 1) {

                $page['database_name']           = DATABASE_NAME . '';
                $page['conection_name_database'] = CONECTION_NAME_DATABASE . '';
                $page['conection_user']          = CONECTION_USER . '';
                DB::connection($page);

                $result                   = ApiApp::db_json($page, $body);
                $returnResult['num_rows'] = count($result);
                $row                      = [];
                foreach ($result as $value) {
                    foreach ($value as $key => $value2) {

                        $row[] = $value2;
                    }
                }
                $returnResult['row'] = ($row);

                echo json_encode($returnResult);
                die;
            } else {

                // contoh ambil nilai

                $page['database_name']           = DATABASE_NAME . '_json';
                $page['conection_name_database'] = CONECTION_NAME_DATABASE . '_json';
                $page['conection_server']        = CONECTION_SERVER;
                $page['conection_user']          = CONECTION_USER;
                $page['conection_user']          = $page['database_provider'] == 'mysql' ? CONECTION_USER . '_json' : CONECTION_USER;
                DB::connection($page);

                $limit  = ($array_search['pagination']['limit']) ?? 10;
                $offset = ($search['offset']) ?? 0;

                if (($search['live'] ?? '') == 2 or ($_GET['search'] ?? '') == 2) {
                    if (in_array($db_to_json, ["checkout", "allproduk", "all_produk"])) {

                        $get_data = ApiApp::db_json_bundle($page, $body);
                    } else {

                        $get_data = ApiApp::db_json($page, $body);
                    }

                    $row = [];
                    foreach ($get_data as $value) {
                        if (isset($value['current'])) {
                            $current = $value['current'];
                            if (is_array($current) && isset($current['id'])) {
                                $id = $current['id'];
                            }

                            // Jika object
                            elseif (is_object($current) && isset($current->id)) {
                                $id = $current->id;
                            } else {
                                $id;
                            }
                            $row[$id] = $value['current'];
                        } else {
                            foreach ($value as $key => $value2) {

                                $id       = $value2['current']->id;
                                $row[$id] = $value2['current']; // ini benar
                            }
                        }
                    }
                    if ($return == 'json') {
                        echo json_encode(["row" => $row]);
                    } else if ($return == 'row') {
                        return $row;
                    }

                } else if (($search['live'] ?? '') == 3 or ($_GET['search'] ?? '') == 3) {
                    // ini benar
                    if (in_array($db_to_json, ["checkout", "allproduk", "all_produk"])) {

                        $get_data = ApiApp::db_json_bundle($page, $body);
                    } else {

                        $get_data = ApiApp::db_json($page, $body);
                    }
                } else {
                    DB::queryRaw($page, "SELECT count(*) as count from apps_data__historis where database_utama='$db_to_json' and generate = 0 ");
                    $all_count = DB::get('all');
                    DB::queryRaw($page, "SELECT count(*)  as count from apps_data__transaksi where nama_db='$db_to_json'  ");
                    $all_transaksi = DB::get('all');
                    if ($all_count['row'][0]->count > 0 or $all_transaksi['row'][0]->count == 0) {

                        $_POST['db']                     = $db_to_json;
                        $page['database_name']           = DATABASE_NAME . '';
                        $page['conection_name_database'] = CONECTION_NAME_DATABASE . '';
                        $page['conection_user']          = CONECTION_USER;
                        DB::connection($page);
                        if (in_array($db_to_json, ["checkout", "allproduk", "all_produk"])) {

                            $get_data = ApiApp::db_json_bundle($page, $body);
                        } else {

                            $get_data = ApiApp::db_json($page, $body);
                        }
                    }
                    $page['database_name']           = DATABASE_NAME . '_json';
                    $page['conection_name_database'] = CONECTION_NAME_DATABASE . '_json';
                    $page['conection_server']        = CONECTION_SERVER;
                    $page['conection_user']          = CONECTION_USER;
                    $page['conection_user']          = $page['database_provider'] == 'mysql' ? CONECTION_USER . '_json' : CONECTION_USER;
                    DB::connection($page);
                    //hanya generate json saja tanpa callback
                    if (isset($body['deviceId'])) {
                        DB::queryRaw($page, "SELECT apps_data__transaksi.* from apps_data__transaksi
							left join apps_data__user on apps_data__user.id_apps_data__transaksi =apps_data__transaksi.id  and apps_data__user.deviceid='" . $body['deviceId'] . "'
							where nama_db='$db_to_json'  and (
							apps_data__transaksi.id not in(SELECT id_apps_data__transaksi from  apps_data__user where deviceid='" . $body['deviceId'] . "')
							or kapan_update_terakhir!=tgl_update_transaksi)
							LIMIT 1
						");
                        $all = DB::get('all');
                        foreach ($all['row'] as $row) {
                            DB::queryRaw($page, "INSERT INTO `apps_data__user`( `id_apps_data__transaksi`, `tgl_update_transaksi`, `deviceid`, `take_date`) VALUES ('$row->id','$row->kapan_update_terakhir','" . $body['deviceId'] . "','" . date('Y-m-d H:i:s') . "')");
                        }
                        //jadi ini mengandalkan save dari indexed DB
                        //if($all['row'] and $all['num_rows']){

                        //echo json_encode($all['row']);
                        $row = [];
                        foreach ($get_data as $value) {
                            foreach ($value as $key => $value2) {

                                $row[$key] = $value2; //}else{ 
                            }
                        }
                        echo json_encode([["json_data" => $row, "id" => -1]]);
                        // ini benar
                    } else {
                        $row = [];
                        foreach ($get_data as $value) {

                            $id       = $value['current']->id;
                            $row[$id] = $value['current']; //}

                        }
                        echo json_encode(["json_data" => $row, "id" => -1]);
                    }
                }
            }
        } catch (Exception $e) {
            echo "Error : " . $e->getMessage();
        }
    }
    public static function asitektur_db_json($page)
    {

        // ini benar

    }
    public function ensureDatabaseExists2($pdo, $dbType, $dbName, $username = null)
    {
        if ($dbType === 'mysql') {
            /*
        
		// DB::queryRaw($page, "SELECT 
                    //         t.id AS transaksi_id,
                    //         JSON_EXTRACT(t.json_data, CONCAT('$.', e.key_name)) AS full_product_data,
                    //         e.key_name
                    //     FROM 
                    //         apps_data__transaksi t
                    //     JOIN (
                    //         SELECT 
                    //             id,
                    //             SUBSTRING_INDEX(SUBSTRING_INDEX(JSON_KEYS(json_data), '\"', n*2), '\"', -1) AS key_name
                    //         FROM 
                    //             apps_data__transaksi
                    //         JOIN (
                    //             SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5
                    //             UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10
                    //         ) numbers ON n <= JSON_LENGTH(json_data)
                    //         WHERE 
                    //             JSON_LENGTH(json_data) > 0
                    //     ) e ON t.id = e.id
                    //     WHERE nama_db='$db_to_json'  and
                    //         JSON_EXTRACT(t.json_data, CONCAT('$.', e.key_name, '.current.create_date')) IS NOT NULL
                    //     ORDER BY 
                    //         STR_TO_DATE(
                    //             JSON_UNQUOTE(
                    //                 JSON_EXTRACT(t.json_data, CONCAT('$.', e.key_name, '.current.create_date'))
                    //             ), 
                    //             '%Y-%m-%d %H:%i:%s'
                    //         ) DESC
                    //     LIMIT $offset,$limit;");
                    //  $all = DB::get('all');
                    // $get_data = [];
                    //   foreach($all['row'] as $row){
                    //       $cleaned = preg_replace('/[\r\n\t]+/', '', $row->full_product_data);
                    //       $data = json_decode(trim($cleaned),true);;
                    //       $data['current'] = json_decode(json_encode($data['current']));
                    //       $get_data[][$row->transaksi_id] = $data;
                    //   }
					
					
		SIDE
            Proses 1 : database to json (data__transaksi)
            Proses 2 : every transaksi to historis
            Proses 3 : historis generate data to  data__transaksi
            Proses 4 : update date user log
        Front END    
            proses 4 : mendapatkan user device menyimpan di indexed DB
            proses 5 : list 
        */$stmt  = $pdo->query("SHOW DATABASES LIKE " . $pdo->quote($dbName));
            $dbExists = $stmt->fetch();

            if (! $dbExists) {
                "Database $dbName belum ada. Membuat...\n";
                $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
                "Database $dbName berhasil dibuat.\n";
            } else {
                "Database $dbName sudah ada.\n";
            }
        } elseif ($dbType === 'pgsql') {
            // Cek apakah DB ada
            $stmt = $pdo->prepare("SELECT 1 FROM pg_database WHERE datname = :dbname");
            $stmt->execute([':dbname' => $dbName]);
            $dbExists = $stmt->fetch();

            if (! $dbExists) {
                "Database $dbName belum ada. Membuat...\n";
                $pdo->exec("CREATE DATABASE \"$dbName\"");

                if ($username) {
                    echo "Menambahkan permission untuk $username...\n";
                    // Cek apakah DB ada
                    $pdo->exec("GRANT ALL PRIVILEGES ON DATABASE \"$dbName\" TO \"$username\"");
                }
                "Database $dbName berhasil dibuat.\n";
            } else {
                "Database $dbName sudah ada.\n";
            }
        } else {
            throw new Exception("Database type tidak dikenali.");
        }
        $tableName = 'apps_bundle__transaksi';
        try {

            if ($page['database_provider'] === 'mysql') {
                $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_db VARCHAR(255),
                kapan_update_terakhir DATETIME,
                row_awal INT,
                row_akhir INT,
                json_data JSON,
                generate INT DEFAULT 0
            )";
                // Grant all ke user untuk DB baru
            } elseif ($page['database_provider'] === 'postgres') {
                //$pdo->exec($sql);
                $stmt = $pdo->prepare("SELECT 1 FROM information_schema.tables WHERE table_name = :table");
                $stmt->execute(['table' => $tableName]);

                if (! $stmt->fetch()) {
                    echo $sql = "CREATE TABLE \"$tableName\" (
                    id SERIAL PRIMARY KEY,
                    nama_db TEXT,
                    kapan_update_terakhir TIMESTAMP,
                    row_awal INTEGER,
                    row_akhir INTEGER,
                    json_data JSONB,
                    generate INTEGER DEFAULT 0
                )";
                    // Cek table ada atau tidak
                    //$pdo->exec($sql);
                    // }else{
                }
            }
        } catch (Exception $e) {
            echo "Error PostgreSQL: " . $e->getMessage();
        }
        $tableName = 'apps_bundle__historis';
        try {

            if ($page['database_provider'] === 'mysql') {
                echo $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_db VARCHAR(255),
                kapan_update_terakhir DATETIME,
                row_awal INT,
                row_akhir INT,
                json_data JSON,
                generate INT DEFAULT 0
            )";
                //     $stmt->fetch();
            } elseif ($page['database_provider'] === 'postgres') {
                //$pdo->exec($sql);
                $stmt = $pdo->prepare("SELECT 1 FROM information_schema.tables WHERE table_name = :table");
                $stmt->execute(['table' => $tableName]);
                if (! $stmt->fetch()) {
                    echo $sql = "CREATE TABLE \"$tableName\" (
                    id SERIAL PRIMARY KEY,
                    database_utama TEXT,
                    database_id INTEGER,
                    tipe_transaksi TEXT,
                    waktu_perubahan TIMESTAMP,
                    generate INTEGER DEFAULT 0
                )";
                    // Cek table ada atau tidak
                    //$pdo->exec($sql);
                    // }else{
                }
            }
        } catch (Exception $e) {
            echo "Error PostgreSQL: " . $e->getMessage();
        }
    }
    public static function db_json_bundle($page, $body = [])
    {

        //     $stmt->fetch();
        // --- CONTOH PAKAI ---
        $page['database_name'];
        $page['database_provider']       = DATABASE_PROVIDER;
        $page['database_name']           = DATABASE_NAME;
        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        // MySQL
        unset($page['database_connected']);
        DB::connection($page);
        if ($page['database_provider'] == 'mysql') {

            try {
                $pdo = $pdoMysql = new PDO("mysql:host=" . $page['conection_server'] . ";dbname=" . $page['conection_name_database'] . '_json', $page['conection_user'] . '_json', $page['conection_password']);
                //print_R($page);
            } catch (Exception $e) {
                echo "Error MySQL: " . $e->getMessage();
            }
        } else {

            //ensureDatabaseExists2($pdoMysql, 'mysql', $page['database_name'] . '_json');
            try {
                $pdo = $pdoPg = new PDO("pgsql:host=localhost dbname=postgres", $page['conection_user'], $page['conection_password']);
                // PostgreSQL
                $pdo = $pdoPg = new PDO("pgsql:host=localhost dbname=" . $page['database_name'] . '_json', $page['conection_user'], $page['conection_password']);
            } catch (Exception $e) {
                echo "Error PostgreSQL: " . $e->getMessage();
            }
        }

        if (isset($body['db'])) {
            $db_to_json = $body['db'];
        } else if (Partial::input('db')) {
            $db_to_json = Partial::input('db');
        } else {
            $db_to_json = "all_produk";
        }
        if (isset($_GET['id_search'])) {
            $body['search']['id_search'] = $_GET['id_search'];
        }
        $db_to_json;
        $all = DatabaseFunc::$db_to_json($page, 1, 100, $body);

        $minKey   = null;
        $maxKey   = null;
        $minHarga = null;
        $maxHarga = null;
        $dirPath  = "FaiFramework/Pages/json/$db_to_json/";
        $filePath = $dirPath . "$db_to_json.json";

        //ensureDatabaseExists2($pdoPg, 'pgsql', $page['database_name'] . '_json', $page['conection_user']);
        if (! is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }

        // Buat folder jika belum ada
        if (file_exists($filePath)) {
            $json_string = file_get_contents($filePath);
            $json_data   = ($json_string);
        } else {
            $json_data = json_encode([]); // Jika file ada, ambil isinya, kalau tidak, set kosong
        }
        $current_json = json_decode($json_data, true);
        foreach ($all as $key => $item) {
            $harga = 0;

            if ($key < $minKey) {
                $minHarga = $harga;
                $minKey   = $key;
            }

            if ($key > $maxKey) {
                $maxHarga = $harga;
                $maxKey   = $key;
            }
        }

        $batchSize  = 100;
        $dibulatkan = floor($minKey / 100) * 100;
        '<br>';
        $offset      = $dibulatkan;
        $batchNumber = 1;
        '<br>';
        $totalRows = $maxKey;

        while ($offset < $totalRows) {
            $rowAwal  = $offset + 1;
            $rowAkhir = $offset + $batchSize;
            $data     = [];
            '<br> INI AWAL SAMPE AKHIR' . $rowAwal . '--' . $rowAkhir;
            foreach ($all as $key => $value) {
                $key;
                if ($key >= $rowAwal and $key <= $rowAkhir) {
                    $data[$key] = $all[$key];
                } else if ($key > $rowAkhir) {
                }
            }

            if (count($data)) {

                $namaDb      = $db_to_json;
                $kapanUpdate = date('Y-m-d H:i:s');

                $stmtDest = $pdo->prepare("SELECT * FROM apps_data__transaksi WHERE nama_db = '$namaDb' and row_awal= $rowAwal and row_akhir=$rowAkhir");
                $stmtDest->execute();
                $counttable = $stmtDest->fetch(PDO::FETCH_ASSOC);
                '<pre>';
                $is_ada    = isset($counttable['json_data']);
                $data_dump = $jsonData = isset($counttable['json_data']) ? json_decode($counttable['json_data'], 1) : [];

                $ada_perubahan = 0;
                foreach ($data as $data_row) {
                    $row       = json_decode(json_encode($data_row), false);
                    $perubahan = 0;
                    if ($is_ada) {
                        if (! isset($data_dump[$row->id]['last_update'])) {
                            $perubahan = 1;
                            $ada_perubahan++;
                        } else
                        if ($data_dump[$row->id]['last_update'] != ($row->update_date ?? $row->create_date) or ! isset($data_dump[$row->id]['current'])) {

                            $perubahan = 1;
                            $ada_perubahan++;
                        } else
                        if ($data_dump[$row->id]['current'] != ($row)) {

                            $perubahan = 1;
                            $ada_perubahan++;
                        }
                    } else {
                        $perubahan = 1;
                        $ada_perubahan++;
                    }
                    if ($perubahan) {
                        $jsonData[$row->id]['allow__on_web_apps'] = [$row->on_web_apps];
                        $jsonData[$row->id]['allow_on_domain']    = [$row->on_domain];
                        $jsonData[$row->id]['allow_on_panel']     = [$row->on_panel ?? ''];
                        $jsonData[$row->id]['allow_on_board']     = [$row->on_board ?? ''];
                        $jsonData[$row->id]['allow_on_role']      = [$row->on_role ?? ''];
                        $jsonData[$row->id]['privilege']          = $row->privilege;
                        $jsonData[$row->id]['last_update']        = $row->update_date ?? $row->create_date;
                        $jsonData[$row->id]['current']            = ($row);

                        $jsonData[$row->id]['json_data'][$row->update_date ?? $row->create_date] = ($row);
                    }
                    $current_json[$row->id] = $row;
                }

                $jsonDataEn = json_encode($jsonData);

                if (! $is_ada) {

                    $insertSql = "INSERT INTO apps_data__transaksi (nama_db, kapan_update_terakhir, row_awal, row_akhir, json_data)
                VALUES ('$namaDb', '$kapanUpdate', '$rowAwal', '$rowAkhir', '$jsonDataEn')";
                    try {
                        $pdo->exec($insertSql);
                    } catch (PDOException $e) {
                        echo '<script>alert("' . $e->getMessage() . '");</script>';
                        echo "Gagal: " . $e->getMessage();
                    }
                } else if ($is_ada and $ada_perubahan) {
                    $insertSql = "UPDATE  apps_data__transaksi set kapan_update_terakhir='$kapanUpdate' , json_data='$jsonDataEn'
                    where nama_db = '$namaDb' and row_awal= '$rowAwal' and row_akhir= '$rowAkhir'";
                    try {

                        $pdo->exec($insertSql);
                    } catch (PDOException $e) {
                        echo '<script>alert("' . $e->getMessage() . '");</script>';
                        echo "Gagal: " . $e->getMessage();
                    }
                } else if ($is_ada and ! $ada_perubahan) {
                    'TIDAK ADA PERUBAHAN';
                }
                foreach ($jsonData as $id => $value) {

                    $stmtDest = $pdo->prepare("SELECT * FROM apps_data__historis WHERE database_utama = '$namaDb' and database_id= $id and tipe_transaksi='Penambahan'");
                    $stmtDest->execute();
                    $counttable = $stmtDest->fetch(PDO::FETCH_ASSOC);
                    if (! isset($counttable['database_utama'])) {

                        $insertSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan,generate)
                             VALUES ('$namaDb', '$id', 'Penambahan', '" . date('Y-m-d H:i:s') . "',1)";
                        $pdo->exec($insertSql);
                    }
                }
                // file belum ada

                "Batch $batchNumber ($rowAwal - $rowAkhir) sukses diinsert.\n";
            }
            $offset += $batchSize;
            $batchNumber++;
        }

        file_put_contents('FaiFramework/Pages/json/' . $namaDb . '/' . $namaDb . '.json', json_encode($current_json, JSON_PRETTY_PRINT));

        return $jsonData;

        // $stmtInsert = $pdo->prepare($insertSql);
        //gimana kontuksinya?
        // last user
        // last user historis
        //riwayat_historis untuk update semua update
        //all_data
        // nama_db kapan update terakhir,  row awal row akhir   json_data

    }
    public static function ensureDatabaseExists($pdo, $dbType, $dbName, $username = null)
    {
        if ($dbType === 'mysql') {
            /*
                {
                    "{id}":{
                        "on_website":"",
                        "last_update":"",
                        "data":{
                                "last_update":data
                            }    
                    }
                }
            */$stmt  = $pdo->query("SHOW DATABASES LIKE " . $pdo->quote($dbName));
            $dbExists = $stmt->fetch();

            if (! $dbExists) {
                "Database $dbName belum ada. Membuat...\n";
                $pdo->exec("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
                "Database $dbName berhasil dibuat.\n";
            } else {
                "Database $dbName sudah ada.\n";
            }
        } elseif ($dbType === 'pgsql') {
            // Cek apakah DB ada
            $stmt = $pdo->prepare("SELECT 1 FROM pg_database WHERE datname = :dbname");
            $stmt->execute([':dbname' => $dbName]);
            $dbExists = $stmt->fetch();

            if (! $dbExists) {
                "Database $dbName belum ada. Membuat...\n";
                $pdo->exec("CREATE DATABASE \"$dbName\"");

                if ($username) {
                    "Menambahkan permission untuk $username...\n";
                    // Cek apakah DB ada
                    $pdo->exec("GRANT ALL PRIVILEGES ON DATABASE \"$dbName\" TO \"$username\"");
                }
                "Database $dbName berhasil dibuat.\n";
            } else {
                "Database $dbName sudah ada.\n";
            }
        } else {
            throw new Exception("Database type tidak dikenali.");
        }
    }
    public static function db_json($page, $body = 0)
    {

        // Grant all ke user untuk DB baru
        // --- CONTOH PAKAI ---
        $page['database_name'];
        $page['database_provider']       = DATABASE_PROVIDER;
        $page['database_name']           = DATABASE_NAME;
        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        if ($page['database_provider'] == 'mysql') {

            try {
                $pdo = $pdoMysql = new PDO("mysql:host=" . $page['conection_server'], $page['conection_user'], $page['conection_password']);
                ApiApp::ensureDatabaseExists($pdoMysql, 'mysql', $page['database_name'] . '_json');
            } catch (Exception $e) {
                echo "Error MySQL: " . $e->getMessage();
            }
        } else {

            // MySQL
            try {
                $pdo = $pdoPg = new PDO("pgsql:host=localhost dbname=postgres", $page['conection_user'], $page['conection_password']);
                ApiApp::ensureDatabaseExists($pdoPg, 'pgsql', $page['database_name'] . '_json', $page['conection_user']);
                $pdo = $pdoPg = new PDO("pgsql:host=localhost dbname=" . $page['database_name'] . '_json', $page['conection_user'], $page['conection_password']);
            } catch (Exception $e) {
                echo "Error PostgreSQL: " . $e->getMessage();
            }
        }

        $page['database_provider']       = DATABASE_PROVIDER;
        $page['database_name']           = DATABASE_NAME;
        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        $page['conection_name_database'] = str_replace('_json', '', $page['conection_name_database']);
        $page['database_name']           = str_replace('_json', '', $page['database_name']);
        unset($page['database_connected']);
        DB::connection($page);
        $tableName = 'apps_data__transaksi';
        try {

            if ($page['database_provider'] === 'mysql') {
                $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_db VARCHAR(255),
                kapan_update_terakhir DATETIME,
                row_awal INT,
                row_akhir INT,
                json_data JSON,
                generate INT DEFAULT 0
            )";
                $pdo->exec($sql);
            } elseif ($page['database_provider'] === 'postgres') {
                // PostgreSQL
                $stmt = $pdo->prepare("SELECT 1 FROM information_schema.tables WHERE table_name = :table");
                $stmt->execute(['table' => $tableName]);

                if (! $stmt->fetch()) {
                    $sql = "CREATE TABLE \"$tableName\" (
                    id SERIAL PRIMARY KEY,
                    nama_db TEXT,
                    kapan_update_terakhir TIMESTAMP,
                    row_awal INTEGER,
                    row_akhir INTEGER,
                    json_data JSONB,
                    generate INTEGER DEFAULT 0
                )";
                    $pdo->exec($sql);
                    // Cek table ada atau tidak
                    // }else{
                }
            }
        } catch (Exception $e) {
            echo "Error PostgreSQL: " . $e->getMessage();
        }
        $tableName = 'apps_data__historis';
        try {

            if ($page['database_provider'] === 'mysql') {
                $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_db VARCHAR(255),
                kapan_update_terakhir DATETIME,
                row_awal INT,
                row_akhir INT,
                json_data JSON,
                generate INT DEFAULT 0
            )";
                $pdo->exec($sql);
            } elseif ($page['database_provider'] === 'postgres') {
                //     $stmt->fetch();
                $stmt = $pdo->prepare("SELECT 1 FROM information_schema.tables WHERE table_name = :table");
                $stmt->execute(['table' => $tableName]);
                if (! $stmt->fetch()) {
                    $sql = "CREATE TABLE \"$tableName\" (
                    id SERIAL PRIMARY KEY,
                    database_utama TEXT,
                    database_id INTEGER,
                    tipe_transaksi TEXT,
                    waktu_perubahan TIMESTAMP,
                    generate INTEGER DEFAULT 0
                )";
                    $pdo->exec($sql);
                    // Cek table ada atau tidak
                    // }else{
                }
            }
        } catch (Exception $e) {
            echo "Error PostgreSQL: " . $e->getMessage();
        }
        $db_to_json = $body['db'] ?? '' ? $body['db'] : (Partial::input('db') ?? "inventaris__asset__master__kategori_toko");
        if (isset($body['db'])) {
            $db_to_json = $body['db'];
        } else if (Partial::input('db')) {
            $db_to_json = Partial::input('db');
        } else {
            $db_to_json = "all_produk";
        }
        //     $stmt->fetch();
        $fai = new MainFaiFramework();
        // DB::queryRaw($page, "SELECT max(id) as max from $db_to_json");
        // $all = DB::get('all');
        // DB::queryRaw($page, "SELECT min(id) as min from $db_to_json");
        if (isset($_GET['search'])) {
            $body['search']['id_search'] = $_GET['search'];
        }
        $search         = $body['search'] ?? [];
        $search['tipe'] = isset($search['tipe']) ? $search['tipe'] : '-1';
        // $min = DB::get('all');
        $page['load']['id'] = $body['load']['load_page_id'] ?? '-1';

        // print_R($search);

        if ($search['tipe'] == 'config_database_db_refer-1') {

            $db = $search['dbConf'];

            if (isset($db['where_get_array'])) {
                //$all = DatabaseFunc::$db_to_json($page, 1, 100,$body);
                foreach ($db['where_get_array'] as $where) {
                    // print_R($search['database']);
                    if (isset($search['database'][$where['get_row']])) {
                        $get           = $search['database'][$where['get_row']];
                        $db['where'][] = [$where['row'], "=", " $get"];
                    }
                }
            }
            if (isset($db['where'])) {
                $where_temp  = $db['where'];
                $db['where'] = [];
                foreach ($where_temp as $where) {
                    if ($where[2] == 'ID_APPS_USER|') {

                        $db['where'][] = [$where[0], $where[1], "'" . $where[2] . "'"];
                    } else {
                        $db['where'][] = [$where[0], $where[1], $where[2]];
                    }
                }
            }
            $dbAll                   = ($db);
            $dbAll['non_add_select'] = true;
            $dbAll['np']             = true;
        } else
        if ($search['tipe'] == 'config_database') {

            $apps                    = $search['apps'] ?? Partial::input('apps');
            $funct                   = $search['page_view'] ?? Partial::input('page_view');
            $key                     = $search['key'] ?? Partial::input('key');
            $get                     = $fai->Apps($apps, $funct, $page);
            $dbAll                   = ($get['config']['database'][$key]);
            $dbAll['non_add_select'] = true;
            $dbAll['np']             = true;
        } else if (($search['live'] ?? '') == 2) {
            $db = $search['database'];
            if (isset($db['where_get_array'])) {
                foreach ($db['where_get_array'] as $arr_wga) {
                    $db['where'][] = [$arr_wga['row'], "=", $body['data'][$arr_wga['get_row']]];
                }
            }
            if (isset($db['where'])) {

                foreach ($db['where'] as $where_value) {
                }
            }
            if (isset($body['search']['id_search'])) {
                $db['where'][] = [$search['database']['utama'] . ".id", "=", $body['search']['id_search']];
            }
            $dbAll                   = ($db);
            $dbAll['non_add_select'] = true;
            $dbAll['np']             = true;
        } else {
            $dbAll = null;
        }
        if (! $dbAll and $db_to_json != '-1') {
            $db                   = [];
            $db['select']         = [];
            $db['select'][]       = "max(id) as max";
            $db['utama']          = $db_to_json;
            $db['non_add_select'] = true;
            $db['np']             = true;
            $db['not_checking']   = true;
            $all                  = Database::database_coverter($page, $db, [], 'all');
            $db                   = [];
            $db['select']         = [];
            $db['select'][]       = "min(id) as min";
            $db['utama']          = $db_to_json;
            $db['non_add_select'] = true;
            $db['np']             = true;
            $db['not_checking']   = true;
            $min                  = Database::database_coverter($page, $db, [], 'all');
        } else {
            $db = $dbAll;
            if (isset($db['utama'])) {
                $db['select']   = [];
                $db['join']     = [];
                $db['where']    = [];
                $db['select'][] = "max(" . $db['utama'] . ".id) as max";

                $all = Database::database_coverter($page, $db, [], 'all');

                $db             = $dbAll;
                $db['select']   = [];
                $db['join']     = [];
                $db['where']    = [];
                $db['select'][] = "min(" . $db['utama'] . ".id) as min";
                $min            = Database::database_coverter($page, $db, [], 'all');
            } else {
                if (! isset($all['row'][0])) {
                    $all['row'][0] = (object) [];
                }
                if (! isset($min['row'][0])) {
                    $min['row'][0] = (object) [];
                }
                $all['row'][0]->max = 1;
                $min['row'][0]->min = 1;
            }
        }
        $totalRows = $all['row'][0]->max;

        $batchSize    = 100;
        $dibulatkan   = floor($min['row'][0]->min / 100) * 100;
        $offset       = $dibulatkan;
        $batchNumber  = 1;
        $all_json     = [];
        $current_json = [];
        $dirPath      = "FaiFramework/Pages/json/$db_to_json/";
        $filePath     = $dirPath . "$db_to_json.json";

        //print_R($where['get_row']);
        if (! is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }

        // Buat folder jika belum ada
        if (file_exists($filePath)) {
            $json_string = file_get_contents($filePath);
            $json_data   = ($json_string);
        } else {
            $json_data = json_encode([]); // Jika file ada, ambil isinya, kalau tidak, set kosong
        }

        // file belum ada
        $current_json = json_decode($json_data, true);
        while ($offset < $totalRows) {

            // Validasi JSON
            $rowAwal  = $offset + 1;
            $rowAkhir = $offset + $batchSize;
            if ($search['live'] ?? '' == 1) {
                $rowAkhir = $totalRows;
            }
            // DB::table($db_to_json);
            // DB::whereRaw("id>=$rowAwal and id<=$rowAkhir");
            if (! isset($db['utama'])) {
                $db = $body['search']['database'];

                // $data = DB::get('all');
                $data = Database::database_coverter($page, $db, [], 'all');
            } else if (! $dbAll) {
                $db          = [];
                $db['utama'] = $db_to_json;
                $db['where'] = [];
                if (isset($body['search']['database'])) {
                    $db = $body['search']['database'];
                }

                $db['np'] = true;
                if (isset($body['search']['database']['where_get_array'])) {
                    foreach ($body['search']['database']['where_get_array'] as $where_get_array) {
                        $db['where'][] = [$where_get_array['row'], " = ", $body['data'][$where_get_array['get_row']]];
                    }
                } else {
                    $db['where'][] = ["$db_to_json.id>=$rowAwal", " and ", "$db_to_json.id<=$rowAkhir"];
                }
                $data = Database::database_coverter($page, $db, [], 'all');
            } else {
                $db = $dbAll;

                // $db['where'][] = [$db['utama'] . ".id>=$rowAwal", " and ", $db['utama'] . ".id<=$rowAkhir"];
                $data = Database::database_coverter($page, $db, [], 'all');
            }
            // $db['where'][] = [$db['utama'] . ".id>=$rowAwal", " and ", $db['utama'] . ".id<=$rowAkhir"];
            //print_R($data); die;
            // echo '<br>' . '<br>' . $data['query'];

            if ($data['num_rows']) {

                $namaDb      = $db_to_json;
                $kapanUpdate = date('Y-m-d H:i:s');

                $stmtDest = $pdo->prepare("SELECT * FROM apps_data__transaksi WHERE nama_db = '$namaDb' and row_awal= $rowAwal and row_akhir=$rowAkhir");
                $stmtDest->execute();
                $counttable = $stmtDest->fetch(PDO::FETCH_ASSOC);
                // echo '<br>' . $data['num_rows'];
                $is_ada    = isset($counttable['json_data']);
                $data_dump = $jsonData = isset($counttable['json_data']) ? json_decode($counttable['json_data'], 1) : [];

                $ada_perubahan    = 0;
                $literasi_darurat = 0;
                foreach ($data['row'] as $row) {

                    // echo '<pre>';
                    $perubahan = 0;
                    if ($is_ada) {
                        if (! isset($data_dump[$row->id ?? $literasi_darurat]['last_update'])) {
                            $perubahan = 1;
                            $ada_perubahan++;
                        } else
                        if ($data_dump[$row->id ?? $literasi_darurat]['last_update'] != ($row->update_date ?? $row->create_date) or ! isset($data_dump[$row->id ?? $literasi_darurat]['current'])) {
                            // // die;
                            $perubahan = 1;
                            $ada_perubahan++;
                        }
                    } else {
                        $ada_perubahan++;
                        $perubahan = 1;
                    }
                    $perubahan = 1;
                    if ($perubahan) {
                        if (($search['live'] ?? '') == 1) {

                            $jsonData[$row->id ?? $literasi_darurat] = ($row);
                        } else {

                            if ($row->on_web_apps ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow__on_web_apps'] = [$row->on_web_apps];
                            }

                            if ($row->on_domain ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow_on_domain'] = [$row->on_domain];
                            }

                            if ($row->on_panel ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow_on_panel'] = [$row->on_panel];
                            }

                            if ($row->on_board ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow_on_board'] = [$row->on_board];
                            }

                            if ($row->on_role ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow_on_role'] = [$row->on_role];
                            }

                            if ($row->privilege ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['allow_privilege'] = [$row->privilege];
                            }

                            if ($row->create_date ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['last_update'] = $row->update_date ?? $row->create_date;
                            }

                            $jsonData[$row->id ?? $literasi_darurat]['current'] = ($row);
                            if ($row->create_date ?? '') {
                                $jsonData[$row->id ?? $literasi_darurat]['json_data'][$row->update_date ?? $row->create_date] = ($row);
                            }

                        }

                        $literasi_darurat++;
                    } else {
                        $jsonData[$row->id ?? $literasi_darurat] = $data_dump[$row->id ?? $literasi_darurat];
                    }
                    $current_json[$row->id ?? $literasi_darurat] = ($row);
                }
                // echo 'HAII';
                $all_json[] = $jsonData;
                //$jsonData['query'] = $data;  
                // $jsonDataEn = json_encode($jsonData);
                // // $jsonDataEn = preg_replace('/\s+/', ' ', $jsonDataEn);
                $jsonDataEn = json_encode($jsonData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                //   $jsonDataEn = preg_replace('/[\r\n\t]+/', '', $jsonDataEn);
                $jsonDataEn = str_replace(["\r", "\n", "\t"], '', $jsonDataEn);

                // 2. Bersihkan whitespace (termasuk enter dan tab)
                $jsonDataEn = preg_replace('/\s+/', ' ', $jsonDataEn);

                // 3. Hapus spasi berlebihan antara elemen
                $jsonDataEn = trim($jsonDataEn);
                if (($search['live'] ?? '') == 1) {
                    // 4. Pastikan tidak ada spasi di awal/akhir
                } else
                if (($search['live'] ?? '') == 2) {
                    // echo 'AS';
                } else if (! $is_ada) {

                    $insertSql = "INSERT INTO apps_data__transaksi (nama_db, kapan_update_terakhir, row_awal, row_akhir, json_data)
                VALUES ('$namaDb', '$kapanUpdate', '$rowAwal', '$rowAkhir', '$jsonDataEn')";
                    try {
                        $pdo->exec($insertSql);
                    } catch (PDOException $e) {
                        echo "Gagal: " . $e->getMessage();
                    }
                } else if ($is_ada and $ada_perubahan) {
                    $insertSql = "UPDATE  apps_data__transaksi set kapan_update_terakhir='$kapanUpdate' and json_data='$jsonDataEn'
                    where nama_db = '$namaDb' and row_awal= '$rowAwal' and row_akhir= '$rowAkhir'";
                    try {

                        $pdo->exec($insertSql);
                    } catch (PDOException $e) {
                        echo '<script>alert("' . $e->getMessage() . '");</script>';
                        "Gagal: " . $e->getMessage();
                    }
                } else if ($is_ada and ! $ada_perubahan) {
                    'TIDAK ADA PERUBAHAN';
                }
                if (($search['live'] ?? '') == 1) {
                    // echo 'AS';
                } else {

                    foreach ($jsonData as $id => $value) {

                        // echo 'AS';

                    }
                }
                /*$stmtDest = $pdo->prepare("SELECT * FROM apps_data__historis WHERE database_utama = '$namaDb' and database_id= $id and tipe_transaksi='Penambahan'");
                        $stmtDest->execute();
                        $counttable = $stmtDest->fetch(PDO::FETCH_ASSOC);
                        if (!isset($counttable['database_utama'])) {

                              $insertSql = "INSERT INTO apps_data__historis (database_utama, database_id, tipe_transaksi, waktu_perubahan,generate)
                             VALUES ('$namaDb', '$id', 'Penambahan', '" . date('Y-m-d H:i:s') . "',1)";
                            $pdo->exec($insertSql);
                        }
						*/
                // $stmtInsert = $pdo->prepare($insertSql);
            }
            $offset = $rowAkhir + 1;
            $batchNumber++;
        }

        file_put_contents('FaiFramework/Pages/json/' . $db_to_json . '/' . $db_to_json . '.json', json_encode($current_json, JSON_PRETTY_PRINT));
        return $all_json;
    }

    public static function inisiasi_stok($page)
    {
        $fai       = new MainFaiFramework();
        $body      = json_decode(file_get_contents("php://input"), true);
        $id_asset  = $body['id_asset'];
        $id_produk = $body['id_produk'];
        $stok      = EcommerceApp::sync_update_stok($page, $id_produk, $id_asset);
        echo json_encode(["stok" => (int) $stok]);
    }
    public static function get_stok($page)
    {
        $fai        = new MainFaiFramework();
        $body       = json_decode(file_get_contents("php://input"), true);
        $variasi_ke = $body['variasi'];
        $id_varian  = $body['id_varian'];
        $where      = "";
        if ($id_varian) {
            $ex_varian = explode('-', $id_varian);
            if (isset($ex_varian[0])) {
                $id_varian_1 = $ex_varian[0];
                $where .= "AND (inventaris__asset__list__varian.id_varian_1 = $id_varian_1  or 	master_varian.id_varian_1 = $id_varian_1)";
            }
            if (isset($ex_varian[1])) {
                $id_varian_2 = $ex_varian[1];
                $where .= "AND (inventaris__asset__list__varian.id_varian_2 = $id_varian_2  or 	master_varian.id_varian_2 = $id_varian_2)";
            }
        }
        $id_asset           = $body['id_asset'];
        $id_produk          = $body['id_produk'];
        $id_asset_varian    = $body['id_asset_varian'];
        $id_produk_varian   = $body['id_produk_varian'];
        $query_asset_varian = "";
        $stok               = EcommerceApp::sync_update_stok($page, $id_produk, $id_asset, $id_asset_varian);
// echo "Batch $batchNumber ($rowAwal - $rowAkhir) sukses diinsert.\n";
        //         if ($id_varian and ! $id_asset_varian) {
        //             $query_asset_varian = " and id_asset_varian in( SELECT inventaris__asset__list__varian.id from inventaris__asset__list__varian
        // LEFT JOIN inventaris__asset__list__varian master_varian on master_varian.id = inventaris__asset__list__varian.id_master_varian
        // where inventaris__asset__list__varian.id_inventaris__asset__list  = $id_asset
        // 										$where
        // 											)";

//         }
        //         DB::selectRaw('sum(coalesce(stok_available,0)) as total_stok');
        //         DB::table("(SELECT id_produk,id_produk_varian,id_ruang_simpan,id_asset_varian,id_asset,connect_api_name,stok_available
        // 		FROM
        // 				inventaris__storage__data

// 		WHERE 1=1 $query_asset_varian
        // 		order by stok_available desc) as f");
        //         DB::whereRaw("id_asset = $id_asset");
        //         DB::whereRaw("id_produk = $id_produk");
        //         if ($id_asset_varian) {
        //             DB::whereRaw("id_asset_varian = $id_asset_varian");

//         }
        //         if ($id_produk_varian) {
        //             DB::whereRaw("id_produk_varian = $id_produk_varian");

//         }
        //         // DB::groupByRaw($page,["connect_api_name"]);
        echo json_encode([
            "stok" => $stok,
            //         $db = DB::get('all');
        ]);
        //,"query"=>		str_replace(['\n','\t'],'',trim($db['query']))  
        //echo json_encode(["stok"=>(int) $db['row'][0]->total_stok,"query"=>
        //str_replace(['\n','\t'],'',trim($db['query']))  
    }
    public static function verifikasi_wa($page)
    {
        $_SESSION['id_apps_user'];
        $db['utama']   = "apps_user";
        $db['np']      = "apps_user";
        $db['where'][] = ["id_apps_user", "=", $_SESSION['id_apps_user']];
        $get           = Database::database_coverter($page, $db, [], 'all');

        if ($get['num_rows']) {
            if ($get['row'][0]->wa_verifikasi == Partial::input('kode')) {

                echo json_encode(["status" => 1]);
            } else {

                echo json_encode(["status" => 0, "keterangan" => "Kode salah"]);
            }
        } else {
            echo json_encode(["status" => 0, "keterangan" => "Kode salah"]);
        }
    }
    public static function get_login($page)
    {
        $field['username'] = ["username", "email", "nomor_handphone"];
        $field['password'] = ["password"];
        $username          = Partial::input('email');
        $password          = Partial::input('password');

        $where       = "";
        $where_array = [];
        $where .= '(';
        for ($i = 0; $i < count($field['username']); $i++) {
            $where .= " " . $field['username'][$i] . " = '$username' ";
            if ($i != count($field['username']) - 1) {
                $where .= " OR ";
            }
        }

        $where .= ')';

        $where .= ' AND ';

        $where .= '(';
        for ($i = 0; $i < count($field['password']); $i++) {
            $where .= " " . $field['password'][$i] . " = '$password' ";
            if ($i != count($field['password']) - 1) {
                $where .= " OR ";
            }
        }
        $where .= ')';
        $where_array[] = ["", "", $where];
        $database      = "apps_user";
        DB::connection($page);
        $db['utama']     = $database;
        $db['where_raw'] = $where;
        $row             = Database::database_coverter($page, $db, [], 'all');
        //]);
        // print_R($row);
        // $sql = "select * from $database where $where";
        $page['load']['login-template']      = "soft-ui";
        $page['load']['login-database']      = "apps_user";
        $page['load']['login-row']           = ["primary_key" => "id_apps_user", "step" => "daftar_step"];
        $page['load']['login-session-utama'] = ["session_name" => "id_apps_user", "database_row" => "id_apps_user"];
        $page['load']['login-session']       = [
            ["session_name" => "hak_akses", "type" => "database", "database_row" => "akses"],
            ["session_name" => "as", "type" => "string", "text" => "user"],
            ["session_name" => "id_organisasi", "type" => "string", "text" => ""],
            ["session_name" => "id_program", "type" => "string", "text" => ""],
        ];
        // $get = DB::query($sql);
        $database_row = $page['load']['login-session-utama']['database_row'];
        if ($row['num_rows']) {
            $return_login['is_login']                                                = 1;
            $_SESSION[$page['load']['login-session-utama']['session_name']]          = $row['row'][0]->$database_row;
            $_SESSION[$page['load']['login-session-utama']['session_name'] . '_tmp'] = $row['row'][0]->$database_row;

            for ($i = 0; $i < count($page['load']['login-session']); $i++) {
                if (isset($page['load']['login-session'][$i])) {
                    if ($page['load']['login-session'][$i]['type'] == 'database') {

                        $database_row                                                          = $page['load']['login-session'][$i]['database_row'];
                        $_SESSION[$page['load']['login-session'][$i]['session_name']]          = $row['row'][0]->$database_row;
                        $_SESSION[$page['load']['login-session'][$i]['session_name'] . '_tmp'] = $row['row'][0]->$database_row;
                    } else if ($page['load']['login-session'][$i]['type'] == 'string') {

                        $_SESSION[$page['load']['login-session'][$i]['session_name'] . '']     = $page['load']['login-session'][$i]['text'];
                        $_SESSION[$page['load']['login-session'][$i]['session_name'] . '_tmp'] = $page['load']['login-session'][$i]['text'];
                    }
                }
            }
            $_SESSION['is_login']         = true;
            $return_login['status']       = 1;
            $return_login['id_apps_user'] = $row['row'][0]->id_apps_user;
            $_SESSION['msg']              = '';
            $return_board['num_rows']     = 0;
            if (Partial::input('id_board')) {
                $return_board = MainFaiFramework::board_role_default($page, Partial::input('id_board'));
            }

            if ($return_board['num_rows']) {
                $return_login['id_first_menu'] = isset($return_board['row']->id_first_menu) ? $return_board['row']->id_first_menu : $return_board['row']->id_first_akses_role;
                $return_login['template']      = $return_board['row']->folder_template;
                $return_login['id_role_user']  = $return_board['row']->id_role_user;
                $return_login['id_role_akses'] = $return_board['row']->id_role_akses;
            }
        } else {
            $return_login['status']     = 0;
            $return_login['is_login']   = 0;
            $_SESSION['is_login']       = false;
            $return_login['keterangan'] = $_SESSION['msg'] = 'Login Gagal! Silahkan Cek Kembali Username Password yang diinputkan';
        }
        echo json_encode($return_login);
    }
    public static function search($page)
    {
        $fai           = new MainFaiFramework();
        $domain        = $fai->input('domain');
        $search_router = SearchContent::router();
        $search_router = $search_router[$domain];
        $returnjson    = [];
        foreach ($search_router['content'] as $json) {

            $body                       = ["db" => $json['database'], "search" => ["live" => 2, "limit" => 10], "limit" => 10];
            $returnjson[$json['Judul']] = ApiApp::get_db_json($page, $body, 'row');
        }

        echo json_encode($returnjson);

    }
    public static function get_logout($page)
    {
        $return_login['status']   = 1;
        $return_login['is_login'] = 1;
        $_SESSION['is_login']     = false;
        unset($_SESSION['id_apps_user']);
        echo json_encode($return_login);
    }
    public static function cheked_cart($page)
    {
        EcommerceApp::cek_harga_cart_get_checkout($page, '', '');
    }
    public static function submit_tambah_alamat_penerima($page)
    {
        try {

            $nama      = Partial::input('nama');
            $alamat    = Partial::input('alamat');
            $kota      = Partial::input('kota');
            $kecamatan = Partial::input('kecamatan');
            $kelurahan = Partial::input('kelurahan');
            $rt        = Partial::input('rt');
            $rw        = Partial::input('rw');
            $nomor     = Partial::input('nomor');
            $patokan   = Partial::input('patokan');
            $wa        = Partial::input('wa');
        } catch (\Throwable $th) {
            // $row = DB::fetchResponse($get);
        }
    }
    public static function produk_sync($page)
    {
        $return = Packages::sync($page, "produk_sync", 1);
        $body   = ["db" => "all_produk", "search" => ["live" => 2], 'search' => ['id_produk' => $return['id_produk']]];
        ApiApp::db_json_bundle($page, $body);

        echo json_encode($return);
    }
    public static function produk_sync_preorder($page)
    {

        $return = Packages::sync($page, "produk_sync", 1);
        $body   = ["db" => "all_produk", "search" => ["live" => 2], 'search' => ['id_produk' => $return['id_produk']]];

        $body = ["db" => "all_produk", "search" => ["live" => 2], 'search' => ['id_produk' => $return['id_produk']]];
        ApiApp::db_json_bundle($page, $body);
        //throw $th;
        echo json_encode($return);
    }
    public static function get_menu_board($page)
    {
        $page['load']['board'] = Partial::input('id_board');
        $page['template']      = "sneat";
        $page['route_type']    = "link_js_fai";
        echo json_encode(["role" => ($_SESSION['board_role-' . $page['load']['board']] ?? ''), "html" => Partial::menu_workspace_role_apps_menu($page)]);
    }
    public static function proses_daftar_mitra($page)
    {
        ob_start();
        try {
            $fai = new MainFaiFramework();
            DB::table('web__apps');
            DB::joinRaw('web__list_apps_board on web__list_apps_board.id = id_board');
            DB::whereRaw("domain_utama = '" . Partial::input('domain') . "'");
            $get                  = DB::get('all');
            $id_store_tokoWebapps = $get['row'][0]->id_single_toko;

            DB::table('crm__mitra_penjualan');
            DB::whereRaw("id_apps_user = '" . Partial::input('id_user') . "'");
            DB::whereRaw("id_store_from = $id_store_tokoWebapps");
            $getCount = DB::get('all');
            if (! $getCount['num_rows']) {
                $id                      = $get_id                      = Partial::input('id_mitra');
                $insert['id_apps_user']  = Partial::input('id_user');
                $insert['id_store_from'] = $id_store_tokoWebapps;

                $insert['id_store__mitra'] = $get_id;
                // return [];
                $insert['link_shopee']        = Partial::input('link_shopee');
                $insert['link_tokpedtok']     = Partial::input('link_tokpedtok');
                $insert['link_lazada']        = Partial::input('link_lazada');
                $insert['no_wa']              = Partial::input('no_wa');
                $insert['nama_toko']          = Partial::input('nama_toko');
                $insert['nama_lengkap']       = Partial::input('nama_lengkap');
                $insert['total_pembayaran']   = Partial::input('total_pembayaran');
                $insert['id_erp__pos__group'] = $id_erp_pos_group = EcommerceApp::inisiate_store_pesanan_group($page, $force = 0, $tipe_group = "Pendaftaran Mitra")['id'];
                if ($insert['total_pembayaran']) {
                    $insert['status_mitra'] = 1;
                    DB::table('erp__pos__group');
                    DB::whereRaw("id = $id_erp_pos_group");
                    $getGroup = DB::get('all');
                    if ($getGroup['num_rows'] and ($getGroup['row'][0]->id_payment ?? 0)) {
                        DB::update('erp__pos__group', ["total" => Partial::input('total_pembayaran')], " id=" . $id_erp_pos_group);
                        DB::update('erp__pos__payment', ["total_bayar" => Partial::input('total_pembayaran')], " id=" . $getGroup['row'][0]->id_payment);
                        $insert['id_payment'] = $getGroup['row'][0]->id_payment;
                    } else {
                        $nomor_payment  = ErpPosApp::route_nomor($page, 'Pendaftaran Mitra', 'nomor_payment');
                        $insert_payment = CRUDFunc::declare_crud_variable($fai, $page, [], 'erp__pos__payment', '', [], $nomor_payment, [])['$sqli'];
                        //$insert['id_store_mitra'] = $get_id;
                        $insert_payment['id_apps_user']       = $_SESSION['id_apps_user'];
                        $insert_payment['id_erp__pos__group'] = $id_erp_pos_group;

                        $insert_payment['status_payment']  = 'Aktif';
                        $insert_payment['tanggal_payment'] = date('Y-m-d H:i:s');
                        // $insert_payment['id_panel'] = $id_panel;
                        $insert_payment['total_bayar'] = Partial::input('total_pembayaran');
                        $last_id_payment               = CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Pendaftaran Mitra'));
                        $insert['id_payment']          = $last_id_payment;
                        $update                        = [];
                        $update['id_payment']          = $last_id_payment;
                        $update['total']               = Partial::input('total_pembayaran');
                        DB::update('erp__pos__group', $update, " id=$id_erp_pos_group ");
                    }
                    $insert['status_mitra'] = 1;
                } else {
                    $insert['status_mitra'] = 3;
                }
                CRUDFunc::crud_insert($fai, $page, $insert, [], 'crm__mitra_penjualan');
            }
            echo json_encode(["status" => 1, "id" => $id_erp_pos_group]);
            $fai = new MainFaiFramework();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function delete_cart($page)
    {
        ob_start();
        try {
            $id_cart = Partial::input('id_cart');
            $fai     = new MainFaiFramework();
            CRUDFunc::crud_update($fai, $page, ["active" => 0, "status_pra_order" => "Hapus"], [], [], [], 'erp__pos__pra_order', 'id', $id_cart);

            $get = ob_get_clean();

            if (strpos($get, 'PHP Error')) {
                echo json_encode(["status" => 0, 'id_cart' => $id_cart, "get" => $get]);
            } else {
                echo json_encode(["status" => 1, 'id_cart' => $id_cart]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => 0, 'error' => $e]);
        }
    }
    public static function proses_cek_bayar($page)
    {
        ob_start();
        try {
            $id       = $get_id       = Partial::input('checkout_id');
            $banks    = Partial::input('bank');
            $tgls     = $_POST['tanggal'] ?? [];
            $ans      = $_POST['an'] ?? [];
            $noreks   = $_POST['norek'] ?? [];
            $nominals = $_POST['nominal'] ?? [];

            // $insert_payment['nomor_payment'] = "FJ-O/" . date('ymdHis') . "/" . random_num(5);
            $files      = $_FILES['file'] ?? [];
            $fai        = new MainFaiFramework();
            $list_utama = [];
            foreach ($banks as $id => $bank) {
                $input = [];

                $an      = $ans[$id] ?? '';
                $norek   = $noreks[$id] ?? '';
                $nominal = $nominals[$id] ?? '';
                $tgl     = $tgls[$id] ?? '';
                foreach ($files as $key => $value) {

                    $_FILES['file_pembayaran'][$key] = $files[$key][$id] ?? null;
                }
                $return_file = FileFunc::file_upload(
                    $page,
                    'file_pembayaran',
                    'ecommerce/konform_bayar/',
                    'ecommerce/konform_bayar/',
                    'erp__pos__payment__bayar',
                    $id,
                    'file_pembayaran',
                    'input_name',
                    'last_one'
                );
                $input['file_pembayaran']             = $return_file;
                $input['id_erp__pos__payment__bayar'] = $id;
                $input['nama_rekening_pengirim']      = $an;
                $input['nomor_rekening_pengirim']     = $norek;
                $input['tanggal_pembayaran']          = empty($tgl) ? date('Y-m-d') : $tgl;
                $input['nominal_bayar']               = $nominal;

                CRUDFunc::crud_insert($fai, $page, $input, [], 'erp__pos__payment__bayar__konfirm');
                $db             = [];
                $db['select'][] = "erp__pos__utama.id as id_utama
                    , inventaris__asset__list.id_api
		            , inventaris__asset__list__varian.id_api_varian";
                $db['utama'] = "erp__pos__payment__bayar";

                $db['join'][]  = ["erp__pos__payment", "erp__pos__payment__bayar.id_erp__pos__payment", "erp__pos__payment.id", "left"];
                $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id_erp__pos__group", "erp__pos__payment.id_erp__pos__group", "left"];
                $db['join'][]  = ["erp__pos__utama__detail", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", "left"];
                $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
                $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian", 'left'];
                $db['where'][] = ["erp__pos__payment__bayar.id", "=", "$id"];
                $get_utama     = Database::database_coverter($page, $db, [], 'all');
                foreach ($get_utama['row'] as $utama) {
                    $id_api = empty($utama->id_api_varian) ? $utama->id_api : $utama->id_api_varian;
                    if (! in_array($utama->id_utama . '-' . $id_api, $list_utama)) {
                        $list_utama[] = $utama->id_utama . '-' . $id_api;
                    }

                }
            }
            $send_order      = [];
            $status_response = true;
            foreach ($list_utama as $values) {
                $ex           = explode('-', $values);
                $send_order[] = $response = ApiContent::send_order($page, $ex[1], $ex[0]);
                if (! $response['status']) {

                    $status_response = false;
                }
            }
            $get = ob_get_clean();

            if (! $status_response) {
                echo json_encode(["status" => 0, "send_order" => $send_order]);
            } else if (strpos($get, 'PHP Error')) {
                echo json_encode(["status" => 0, "send_order" => $send_order]);
            } else {
                echo json_encode(["status" => 1, "send_order" => $send_order]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => 0, 'error' => $e, "send_order" => $send_order]);
        }
    }
    public static function proses_bayar($page)
    {
        ob_start();
        try {
            $id               = $get_id               = Partial::input('checkout_id');
            $brand_pembayaran = explode('-', Partial::input('brand_pembayaran'));

            $fai      = new MainFaiFramework();
            $id_panel = null;
            DB::selectRaw('*,erp__pos__payment.nomor_payment');
            DB::table('erp__pos__group');
            DB::whereRaw('erp__pos__group.id=' . $id);
            DB::joinRaw('erp__pos__payment on id_payment=erp__pos__payment.id', 'left');
            $pemesanan      = DB::get();
            $nomor_payment  = ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_payment');
            $insert_payment = CRUDFunc::declare_crud_variable($fai, $page, [], 'erp__pos__payment', '', [], $nomor_payment, [])['$sqli'];
            // Tangkap file array dari $_FILES
            $insert_payment['id_apps_user']       = $_SESSION['id_apps_user'];
            $insert_payment['id_erp__pos__group'] = $id;

            $insert_payment['id_payment_brand']         = $brand_pembayaran[0];
            $insert_payment['id_payment_brand_webapps'] = $brand_pembayaran[1];
            $insert_payment['status_payment']           = 'Aktif';
            $insert_payment['tanggal_payment']          = date('Y-m-d H:i:s');
            // $insert_payment['id_panel'] = $id_panel;
            $insert_payment['total_bayar'] = (int) $pemesanan[0]->total + (int) Partial::input('biaya_payment_user');
            DB::selectRaw('*,erp__pos__payment.nomor_payment');
            DB::table('erp__pos__payment');
            DB::whereRaw('id_erp__pos__group=' . $id);
            $payment_ada = DB::get('all');
            if ($payment_ada['num_rows'] == 1) {
                $last_id_payment = $payment_ada['row'][0]->id;
                // $insert_payment['nomor_payment'] = "FJ-O/" . date('ymdHis') . "/" . random_num(5);
                DB::update('erp__pos__payment', ["active" => 0], "id_erp__pos__group = $get_id ");
                $last_id_payment = CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
            } else
            if ($payment_ada['num_rows'] > 1) {
                $last_id_payment = $payment_ada['row'][0]->id;
                DB::update('erp__pos__payment', ["active" => 0], "id_erp__pos__group = $get_id ");
                $last_id_payment = CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
            } else {
                $last_id_payment = CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
            }

            $update                     = [];
            $update['status_pra_order'] = 'Pembayaran';

            DB::update('erp__pos__pra_order', $update, "id in  (select id_cart from erp__pos__utama__detail where id_erp__pos__group=  $get_id )");

            $update                             = [];
            $update['status']                   = 'Pembayaran';
            $update['id_payment']               = $last_id_payment;
            $update['id_payment_brand']         = $brand_pembayaran[0];
            $update['id_payment_brand_webapps'] = $brand_pembayaran[1];
            $update['biaya_payment_user']       = Partial::input('biaya_payment_user');
            $update['biaya_payment_system']     = Partial::input('biaya_payment_system');

            DB::update('erp__pos__utama', $update, "id_erp__pos__group = $get_id ");
            DB::update('erp__pos__group', $update, " id=$get_id ");
            $last_id_payment_api = null;
            $va                  = null;
            if ($brand_pembayaran) {
                DB::table('webmaster__payment_method_brand');
                DB::joinRaw("webmaster__payment_method on webmaster__payment_method.id = webmaster__payment_method_brand.id_webmaster__payment_method");
                DB::joinRaw("webmaster__payment_webapps on webmaster__payment_method_brand.id = webmaster__payment_webapps.id_payment_brand");
                DB::whereRaw('webmaster__payment_method_brand.id=' . $brand_pembayaran[0]);
                DB::whereRaw('webmaster__payment_webapps.id=' . $brand_pembayaran[1]);
                $payment_brand                   = DB::get();
                $brand                           = $payment_brand[0]->nama_brand;
                $no_rek                          = $payment_brand[0]->no_rek_webapps;
                $atas_nama                       = $payment_brand[0]->atas_nama_webapps;
                $is_api                          = $payment_brand[0]->is_api;
                $pemesanan[0]->id_payment_method = $payment_brand[0]->id_webmaster__payment_method;
                $pemesanan[0]->id_payment_brand  = $brand_pembayaran[0];
                if ($payment_brand[0]->is_api) {
                    $insert_api = $insert_payment;
                    unset($insert_api['nomor_payment']);
                    unset($insert_api['id_pemesanan']);

                    // DB::update('erp__pos__payment', $insert_payment, "id_erp__pos__group = $get_id ");
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
            $insert_payment_bayar['id_payment_webapps']   = $brand_pembayaran[1];
            $insert_payment_bayar['id_payment_api']       = (int) $last_id_payment_api;
            $insert_payment_bayar['brand_nama']           = $brand;
            $insert_payment_bayar['no_rek']               = $no_rek;
            $insert_payment_bayar['an']                   = $atas_nama;
            $insert_payment_bayar['va_number']            = $va;
            $insert_payment_bayar['is_api']               = $is_api;
            $insert_payment_bayar['jumlah_bayar']         = $pemesanan[0]->total;
            $insert_payment_bayar['status_bayar']         = "belum";
            CRUDFunc::crud_insert($fai, $page, $insert_payment_bayar, [], 'erp__pos__payment__bayar', []);
            $get = ob_get_clean();

            if (strpos($get, 'PHP Error')) {
                echo json_encode(["status" => 0]);
            } else {
                echo json_encode(["status" => 1, "id" => $last_id_payment]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => 0, 'error' => $e]);
        }
    }
    public static function proses_payment($page)
    {
        try {
            ob_start();
            $fai = new MainFaiFramework();

            $get_id                     = Partial::input('checkout_id');
            $id                         = Partial::input('checkout_id');
            $id_kirim_ke                = Partial::input('penerima');
            $update                     = [];
            $update['status_pra_order'] = 'Pemesanan';

            DB::update('erp__pos__pra_order', $update, "id in  (select id_cart from erp__pos__utama__detail where id_erp__pos__group=  $get_id )");

            $update           = [];
            $update['status'] = 'Pemesanan';
            DB::update('erp__pos__utama', $update, "id_erp__pos__group = $get_id ");
            $update           = [];
            $update['status'] = 'Pemesanan';
            DB::update('erp__pos__group', $update, " id=$get_id ");
            $update                         = [];
            $update['id_kirim_ke']          = $id_kirim_ke;
            $update['tipe_pemesanan']       = Partial::input('tipe_pemesanan');
            $update['dropship_toko']        = Partial::input('dropship_toko');
            $update['nomor_resi_ecommerce'] = Partial::input('nomor_resi_ecommerce');
            $update['ekspedisi_ecommerce']  = Partial::input('ekspedisi_ecommerce');
            $update['service_ecommerce']    = Partial::input('service_ecommerce');
            $update['plaform_ecommerce']    = Partial::input('plaform_ecommerce');
            // $insert_api['id_panel'] = $id_panel;
            if (isset($_FILES['file_resi_ecommerce']) or isset($_POST['file_resi_ecommerce'])) {

                $return_file = FileFunc::file_upload(
                    $page,
                    'file_resi_ecommerce',
                    'ecommerce/resi/',
                    'ecommerce/resi/',
                    'erp__pos__group',
                    $id,
                    'file_resi_ecommerce',
                    'input_name',
                    'last_one'
                );
                $update['file_resi_ecommerce'] = $return_file;
            }

            DB::update('erp__pos__group', $update, [('id=' . $id)]);
            DB::update('erp__pos__utama', $update, [('id_erp__pos__group=' . $id)]);
            if ($id_kirim_ke) {
                $db_bangunan            = [];
                $db_bangunan['utama']   = 'inventaris__asset__tanah__bangunan';
                $db_bangunan['np']      = 'inventaris__asset__tanah__bangunan';
                $db_bangunan['where'][] = ['cast(inventaris__asset__tanah__bangunan.id as int)', '=', $id_kirim_ke];
                $get_db_bangunan        = Database::database_coverter($page, $db_bangunan, [], 'all');
                // print_R();
                // 'tipe_pemesanan': tipe_pemesanan,
                //                 'ongkir': ongkir,
                //                 dropship_toko: dropship_toko,
                //                 nomor_resi_ecommerce: nomor_resi_ecommerce,
                //                 ekspedisi_ecommerce: ekspedisi_ecommerce,
                //                 service_ecommerce: service_ecommerce,
                //                 plaform_ecommerce: plaform_ecommerce,
                unset($update['id_kirim_ke']);
                $erp_do                       = $update;
                $erp_do['id_bangunan_tujuan'] = $id_kirim_ke;
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

            }
            $ongkir                 = json_decode(Partial::input('ongkir'), true);
            $total_ongkir           = 0;
            $db_bangunan            = [];
            $db_bangunan['utama']   = 'erp__pos__utama';
            $db_bangunan['np']      = 'erp__pos__utama';
            $db_bangunan['where'][] = ['id_erp__pos__group', '=', $id];

            $get_db_bangunan = Database::database_coverter($page, $db_bangunan, [], 'all');
            foreach ($get_db_bangunan['row'] as $row_utama) {
                $count['utama']   = "erp__pos__delivery_order";
                $count['np']      = "erp__pos__delivery_order";
                $count['where'][] = ["erp__pos__delivery_order.id_erp__pos__utama", "=", "$row_utama->primary_key"];
                $get_count        = Database::database_coverter($page, $count, [], 'all');
                if (isset($erp_do['id_ekpedisi'])) {
                    unset($erp_do['id_ekpedisi']);
                }

                if (isset($erp_do['id_service'])) {
                    unset($erp_do['id_service']);
                }

                $erp_do['id_ekpedisi']  = $ongkir[$row_utama->id_toko]['ekspedisi'];
                $erp_do['id_service']   = $ongkir[$row_utama->id_toko]['service'];
                $erp_do['paket_ongkir'] = $ongkir[$row_utama->id_toko]['paket_ongkir'];
                $erp_do['ongkir']       = (int) $ongkir[$row_utama->id_toko]['ongkir'];

                $total_ongkir += $erp_do['ongkir'];
                if ($get_count['num_rows']) {

                    CRUDFunc::crud_update($fai, $page, $erp_do, [], [], [], 'erp__pos__delivery_order', 'id_erp__pos__utama', $row_utama->primary_key);
                } else {
                    $erp_do['id_erp__pos__utama'] = $row_utama->primary_key;
                    $erp_do['tanggal_do']         = date('Y-m-d');
                    $erp_do['id_store_ongkir']    = "WORKSPACE_SINGLE_TOKO|";
                    //                 file_resi_ecommerce: file_resi_ecommerce,

                    CRUDFunc::crud_insert($fai, $page, $erp_do, [], 'erp__pos__delivery_order');
                }
            }

            $db2['select'][] = "

        erp__pos__utama.no_purchose_order,

        erp__pos__utama__detail.id as id_detail

		, inventaris__asset__list.nama_barang
		, inventaris__asset__list.id as id_asset
		, inventaris__asset__list__varian.id as id_varian
		, inventaris__asset__list.varian_barang


        ,qty_pesanan

        ,erp__pos__utama.id_apps_user

        ,erp__pos__utama__detail.create_date
        ,erp__pos__utama__detail.qty
        ,erp__pos__utama__detail.total_harga
        ,erp__pos__utama__detail.total_diskon
        ,erp__pos__utama__detail.id_erp__pos__utama
		";
            $db2['utama']              = "erp__pos__utama__detail";
            $db2['join'][]             = ["inventaris__asset__list", "inventaris__asset__list.id", "erp__pos__utama__detail.id_inventaris__asset__list"];
            $db2['join'][]             = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "cast(id_barang_varian as int)", 'left'];
            $db2['join'][]             = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
            $db2['order'][]            = ["erp__pos__utama__detail.create_date", " desc "];
            $db2['where'][]            = ["erp__pos__utama__detail.id_erp__pos__group", " = ", $id];
            $get                       = Database::database_coverter($page, $db2, [], 'all');
            $total['sub_total']        = 0;
            $total['total_qty']        = 0;
            $total['total_diskon']     = 0;
            $total['total']            = 0;
            $total['biaya_pengiriman'] = $total_ongkir;
            if ($get['num_rows'] > 0) {

                foreach ($get['row'] as $row) {
                    if (! isset($total_perToko[$row->id_erp__pos__utama]['total_qty'])) {
                        $total_perToko[$row->id_erp__pos__utama]['total_qty'] = $row->qty;
                    } else {
                        $total_perToko[$row->id_erp__pos__utama]['total_qty'] += $row->qty;
                    }
                    if (! isset($total_perToko[$row->id_erp__pos__utama]['sub_total'])) {
                        $total_perToko[$row->id_erp__pos__utama]['sub_total'] = $row->total_harga;
                    } else {
                        $total_perToko[$row->id_erp__pos__utama]['sub_total'] += $row->total_harga;
                    }
                    if (! isset($total_perToko[$row->id_erp__pos__utama]['total_diskon'])) {
                        $total_perToko[$row->id_erp__pos__utama]['total_diskon'] = $row->total_diskon;
                    } else {
                        $total_perToko[$row->id_erp__pos__utama]['total_diskon'] += $row->total_diskon;
                    }
                    $total['total_qty'] += $row->qty;
                    $total['sub_total'] += $row->total_harga;
                    $total['total_diskon'] += $row->total_diskon;
                }
            }
            $total['total']  = $total['sub_total'];
            $update['total'] = $total['sub_total'] + $total['biaya_pengiriman'] - $total['total_diskon'];
            DB::update('erp__pos__group', $update, [('id=' . $id)]);
            foreach ($total_perToko as $id_erp_utama => $value) {
                DB::update('erp__pos__utama', $value, [('id=' . $id_erp_utama)]);
            }
            $get = ob_get_clean();
            // $erp_do['nomor_do'] = date('Y-m-d');
            // $db['utama'] = "erp__pos__group";
            // $db['where'][] = ["id","=","$id"];
            // $all =Database::database_coverter($page, $db, [], 'all');
            // sub_total
            // [sub_total] => [total_qty] => [total_diskon] => [voucher] => [total] => [biaya_pengiriman] => 

            if (strpos($get, 'PHP Error')) {
                echo json_encode(["status" => 0, "error" => $get]);
            } else {
                echo json_encode(["status" => 1, "pesan" => $get]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => 0, "error" => $e->getMessage()]);
        }
    }
    public static function proses_checkout($page)
    {

        $send_cart_proses = Partial::input('send_cart_proses');
        $status           = 1;
        $nama             = "";
        $all_stok         = [];
        $row_cart         = [];
        foreach ($send_cart_proses as $cart) {
            DB::table("erp__pos__pra_order");
            DB::joinRaw("store__produk as p on p.id = erp__pos__pra_order.id_produk", 'left');
            DB::whereRaw("erp__pos__pra_order.id=" . $cart['id_cart']);
            $get = DB::get("all");
            // print_R($all);
            $row_cart[$cart['id_cart']] = $get['row'][0];
            $stok                       = (float) EcommerceApp::sync_update_stok($page, $get['row'][0]->id_produk, $get['row'][0]->id_asset, $get['row'][0]->id_asset_varian);
            $all_stok[]                 = ["id_cart" => $cart['id_cart'], "qty" => $cart['qty'], "stok" => $stok];
            if ($cart['qty'] > $stok) {
                $status  = 0;
                $selisih = $stok - $cart['qty'];
                $nama .= "<li>Barang Qty melebihi stok (stok:$stok, selisih:$selisih)</li> ";
            }
        }
        if ($status == 1) {
            $pemesanan = [];
            DB::beginTransaction();
            try {
                $get_id = $id_group_pemesanan = EcommerceApp::inisiate_store_pesanan_group($page, 1)['id'];
                foreach ($send_cart_proses as $cart) {
                    $detail = $row_cart[$cart['id_cart']];
                    DB::table("store__toko__gudang");
                    DB::whereRaw('store__toko__gudang.id_store__toko=' . $row_cart[$cart['id_cart']]->id_toko);
                    DB::orderByRaw($page, [["store__toko__gudang.urutan", "asc"]]);
                    $get = DB::get("all");
                    if (! isset($pemesanan[$detail->id_toko])) {

                        $pemesanan[$detail->id_toko] = EcommerceApp::inisiate_store_pesanan($page, $id_group_pemesanan, $detail->id_toko, "Pemesanan");
                    }

                    $id_pemesanan = $pemesanan[$detail->id_toko]['id'];
                    if (! isset($inventori[$id_pemesanan])) {
                        $input = [];
                        DB::table('erp__pos__inventory');
                        DB::whereRaw('erp__pos__inventory.id_order=' . $id_pemesanan);
                        $inv                                                                                        = DB::get('all');
                        $input['nomor_outgoing']                                                                    = $id_pemesanan;
                        $input['id_order']                                                                          = $id_pemesanan;
                        $input['tanggal_outgoing']                                                                  = date('Y-m-d');
                        $page_out                                                                                   = $page;
                        $nomor_add                                                                                  = ".BJE";
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['prefix']                         = "OUT$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['root']['type'][0]                = 'count-month';
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf'][0]             = true;
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf_number'][0]      = 5;
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['root']['month_get_row_where'][0] = "tanggal_outgoing";
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['root']['not_string']             = "tanggal_outgoing";
                        $page_out['crud']['insert_number_code']['nomor_outgoing']['suffix']                         = '';
                        if ($inv['num_rows']) {
                            if (! $inv['row'][0]->nomor_outgoing) {

                                CRUDFunc::crud_update(new MainFaiFramework(), $page_out, $input, [], [], [], 'erp__pos__inventory', 'id', $inv['row'][0]->id);
                            }
                            $insert_id = $inv['row'][0]->id;
                        } else {
                            $input['id_order'] = $id_pemesanan;
                            $insert_id         = CRUDFunc::crud_insert(new MainFaiFramework(), $page_out, $input, [], "erp__pos__inventory", []);
                        }
                        $inventori[$id_pemesanan] = $insert_id;
                    }
                    $_POST['id_group_pemesanan'] = $id_group_pemesanan;
                    $_POST['id_pemesanan']       = $id_pemesanan;
                    $id_detail                   = EcommerceApp::cek_harga_cart_get_checkout($page, null, null, 'id_detail', $cart['id_cart'], 1, $cart['qty']);

                    // print_R($get['row']);
                    ApiApp::cart_api($page, $id_group_pemesanan, $id_pemesanan, $cart['id_cart']);

                    $invdet                                   = [];
                    $invdet['erp__pos__utama__detail_id']     = $id_detail;
                    $invdet['id_erp__pos__utama__detail_get'] = $id_detail;
                    $invdet['qty_pesan']                      = $cart['qty'];
                    $invdet['id_inventaris__asset__list']     = $detail->id_asset;
                    $invdet['id_asset_varian_inv']            = $detail->id_asset_varian;
                    $invdet['id_produk_inv']                  = $detail->id_produk;
                    $invdet['id_produk_varian_inv']           = $detail->id_produk_varian;
                    $invdet['id_erp__pos__inventory']         = $inventori[$id_pemesanan];

                    $insert_id_det                           = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $invdet, [], "erp__pos__inventory_detail", []);
                    $invout                                  = [];
                    $invout['id_erp__pos__inventory_detail'] = $insert_id_det;
                    $invout['id_barang_keluar']              = $detail->id_asset;
                    $invout['id_barang_keluar_varian']       = $detail->id_asset_varian;
                    $invout['id_produk_keluar']              = $detail->id_produk;
                    $invout['id_produk_varian_keluar']       = $detail->id_produk_varian;
                    $invout['qty_pesan_keluar']              = $cart['qty'];
                    $invout['id_erp__pos__inventory']        = $inventori[$id_pemesanan];
                    $insert_id_out                           = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $invout, [], "erp__pos__inventory__outgoing", []);

                    $sisa_stok = $cart['qty'];
                    $urutan    = 0;
                    if ($get['num_rows']) {
                        foreach ($get['row'] as $row) {
                            if ($sisa_stok > 0) {

                                DB::table("inventaris__storage__data");

                                DB::whereRaw("inventaris__storage__data.id_gudang =$row->id_gudang");
                                DB::whereRaw("inventaris__storage__data.id_produk = $detail->id_produk");
                                DB::whereRaw("inventaris__storage__data.id_asset = $detail->id_asset");
                                DB::whereRaw("inventaris__storage__data.id_asset_varian = $detail->id_asset_varian");
                                DB::whereRaw("inventaris__storage__data.id_produk_varian = $detail->id_produk_varian");
                                $stok = DB::get("all");
                                foreach ($stok['row'] as $rs) {
                                    if ($sisa_stok > 0) {
                                        $urutan++;
                                        $out_break                                     = [];
                                        $out_break['id_erp__pos__inventory']           = $inventori[$id_pemesanan];
                                        $out_break['id_erp__pos__inventory_detail']    = $insert_id_det;
                                        $out_break['id_erp__pos__inventory__outgoing'] = $insert_id_out;
                                        $out_break['id_erp__utama__detail_keluar']     = $id_detail;

                                        $out_break['id_gudang_out']       = $rs->id_gudang;
                                        $out_break['id_ruang_simpan_out'] = $rs->id_ruang_simpan;
                                        $out_break['stok_out']            = $rs->stok_available;
                                        $out_break['urutan']              = $urutan;
                                        $float                            = $sisa_stok;
                                        if ($float > $rs->stok_available) {
                                            $float = $rs->stok_available;
                                        }
                                        $out_break['qty_keluar_out'] = $float;
                                        $id_breakdown                = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $out_break, [], "erp__pos__inventory__outgoing_breakdown", []);

                                        $update_stok['stok_available'] = $rs->stok_available - $float;
                                        $update_stok['stok_reserved']  = $rs->stok_reserved + $float;
                                        CRUDFunc::crud_update(new MainFaiFramework(), $page, $update_stok, [], [], [], 'inventaris__storage__data', 'id', $rs->id);
                                        $sisa_stok -= $float;

                                        $historis['id_inventaris__storage__data'] = $rs->id;
                                        $historis['tanggal_transaksi']            = date('Y-m-d H:i:s');
                                        $historis['field_storage']                = "stok_reserved";
                                        $historis['total_qty']                    = $float;
                                        $historis['relasi_stok_tipe']             = "outgoing";
                                        $historis['relasi_stok_id']               = $insert_id_out;
                                        $historis['relasi_stok_id_breakdown']     = $id_breakdown;
                                        CRUDFunc::crud_insert(new MainFaiFramework(), $page, $historis, [], "inventaris__storage__historis", []);
                                    }
                                }
                            }
                        }
                    }
                }
                $update                     = [];
                $update['status_pra_order'] = 'Pemesanan';

                DB::update('erp__pos__pra_order', $update, "id in  (select id_cart from erp__pos__utama__detail where id_erp__pos__group=  $get_id )");

                $update           = [];
                $update['status'] = 'Pemesanan';
                DB::update('erp__pos__utama', $update, "id_erp__pos__group = $get_id ");
                $update           = [];
                $update['status'] = 'Pemesanan';
                DB::update('erp__pos__group', $update, " id=$get_id ");
                //tambahkan kirim stok api

                DB::commit();

                echo json_encode(["status" => 1, "id" => $id_group_pemesanan]);
            } catch (Exception $e) {
                DB::rollBack();
                echo json_encode(["status" => 0, "keterangan" => $e->getMessage()]);
                //TAMBAHKAN NOMOR SO
                die;
            }
        } else {

            echo json_encode(["status" => $status, "keterangan" => $nama, "stok" => $all_stok]);
        }
    }
    public static function cart_api($page, $id_group_pemesanan, $id_pemesanan, $id_cart)
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
        ,erp__pos__utama__detail.create_date,
        erp__pos__utama__detail.qty
		";
        $db['utama']   = "erp__pos__utama__detail";
        $db['join'][]  = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
        $db['join'][]  = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian", 'left'];
        $db['join'][]  = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama", 'left'];
        $db['order'][] = ["erp__pos__utama__detail.create_date", " desc "];
        $db['where'][] = ["erp__pos__utama__detail.id_erp__pos__utama", " = ", $id_pemesanan];
        $db['where'][] = ["erp__pos__utama__detail.id_erp__pos__group", " = ", $id_group_pemesanan];
        $db['where'][] = ["erp__pos__utama__detail.id_cart", " = ", $id_cart];
        $get           = Database::database_coverter($page, $db, [], 'all');
        if ($get['num_rows'] > 0) {

            foreach ($get['row'] as $row) {

                if (($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') or ($row->asal_barang_dari == 'Api')) {
                    $a = "";

                    if ($row->varian_barang == 1 and $row->asal_from_data_varian == 'Api') {
                        ApiContent::send_cart(
                            $page,
                            $row->id_detail,
                            $row->id_api_varian,
                            $row->id_from_api_varian,
                            $row->qty,
                            $row->id_apps_user
                        );
                    } else {
                        ApiContent::send_cart(
                            $page,
                            $row->id_detail,
                            $row->id_api,
                            $row->id_from_api,
                            $row->qty,
                            $row->id_apps_user
                        );
                    }
                }
            }
        }
    }
    public static function add_cart($page)
    {

        EcommerceApp::add_cart($page);
    }
    public static function register_guest($page)
    {
        $fai                     = new MainFaiFramework();
        $data['nomor_handphone'] = Partial::input('phone');
        $data['connection_wa']   = 1;
        $data['wa_verifikasi']   = Partial::random_num(6);
        $data['wa_verifikasi']   = Partial::random_num(6);
        $data['id_apps_user']    = Database::string_database($page, $fai, "NOWDATETIME::YmdHis|" . "RAND::10000-999999|");
        $db['utama']             = "apps_user";
        $db['np']                = "apps_user";
        $db['where'][]           = ["nomor_handphone", "=", $data['nomor_handphone']];
        $get                     = Database::database_coverter($page, $db, [], 'all');
        if (! $get['num_rows']) {
            $status = 1;
            CRUDFunc::crud_insert($fai, $page, $data, [], 'apps_user', []);
            $_SESSION['id_apps_user'] = $data['id_apps_user'];
            $_SESSION['login']        = true;
            $_SESSION['hak_akses']    = "guest";
            echo json_encode(["status" => 1, "id_apps_user" => $data['id_apps_user']]);
        } else {
            echo json_encode(["status" => 0, "keterangan" => "Duplikat Nomor Wa"]);
        }
        // echo "<pre>Query Failed: " . $e->getMessage() . "</pre>";
    }
    public static function editing($page)
    {
        // CRUDFunc::crud_insert();
    }
    public static function main_all($page)
    {
        $page                        = Configuration::LoadApps($page, $page['domain'], -1, 'page');
        $page['require_login']       = 0;
        $page['contentfaiframework'] = "";
        $page['mainAll']             = "";
        $array                       = [];
        $array[0][0]                 = "main_all";
        $array[0][1]                 = "base";
        $return                      = Bundlecontent::main_all($page, $array, 0);
        echo json_encode(["main_utama" => $return['html']]);
    }
    public static function main_load_data_last($page)
    {
        $page = Configuration::LoadApps($page, $page['domain'], -1, 'page');

        $content          = str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_utama)));
        $content_css      = str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_css)));
        $content_js       = str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_js)));
        $content_template = str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_content_template)));
        $content_css .= str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_content_template_css)));
        $content_js .= str_replace(['&#039;'], ["'"], html_entity_decode(htmlspecialchars_decode($page['load']['row_web_apps']->main_content_template_js)));

        $content_return = $content;
        $content_return = str_replace('<MAIN-CSS></MAIN-CSS>', $content_css, $content_return);
        $content_return = str_replace('<MAIN-JS></MAIN-JS>', $content_js, $content_return);
        // CRUDFunc::crud_insert();
        $content_return = str_replace('$this->', '$fai->', $content_return);
        ob_start();
        $fai = new MainFaiFramework();

        eval("?> $content_return <? ");
        // $content_return = str_replace('<CONTENT-TEMPLATE></CONTENT-TEMPLATE>', $content_template, $content_return);
        echo json_encode(["main_utama" => ob_get_clean()]);
    }
    public static function store_produk($page, $limit = 30, $return_type = 'json')
    {

        $fai         = new MainFaiFramework();
        $be3id_store = $fai->input('be3id');
        DB::connection($page);
        DB::selectRaw('*');
        // $content = eval($content);

        DB::table('store__produk');
        DB::selectRaw('*');
        DB::selectRaw('store__produk.id as id_produk');
        DB::joinRaw('store__toko on store__toko.id = store__produk.id_toko');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset');
        if ($be3id_store) {
            DB::whereRaw("store__toko.apps_id = '$be3id_store'");
        }

        DB::whereRaw("inventaris__asset__list.jual_barang = 'Ya'");
        DB::limitRaw($page, $limit, ($limit * ($fai->input('page') ? $fai->input('page') : 0)));

        $produk = DB::get('all');
        $data   = EcommerceApp::get_data_detail($page, $produk);

        if ($return_type == 'json') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            return $data;
        }
    }
    public static function brand_produk($page, $limit = 30, $return_type = 'json')
    {

        $fai         = new MainFaiFramework();
        $be3id_store = $fai->input('be3id');
        DB::connection($page);
        DB::selectRaw('*');
        //DB::selectRaw('*');

        DB::table('store__produk');
        DB::selectRaw('*');
        DB::selectRaw('store__produk.id as id_produk');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset');
        DB::joinRaw('inventaris__asset__master__brand on inventaris__asset__master__brand.id = inventaris__asset__list.id_brand');
        if ($be3id_store) {
            DB::whereRaw("inventaris__asset__master__brand.apps_id = '$be3id_store'");
        }

        DB::whereRaw("inventaris__asset__list.jual_barang = 'Ya'");
        DB::limitRaw($page, $limit, ($limit * ($fai->input('page') ? $fai->input('page') : 0)));

        $produk = DB::get('all');
        $data   = EcommerceApp::get_data_detail($page, $produk);

        if ($return_type == 'json') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            return $data;
        }
    }
}
