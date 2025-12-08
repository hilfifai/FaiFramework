<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('BASEPATH') or exit('No direct script access allowed');
define("APP_FRAMEWORK", "ci");
// define("DATABASE_PROVIDER", "postgres");
// define("DATABASE_NAME", "be3");
// define("CONECTION_SERVER", "localhost");
// define("CONECTION_NAME_DATABASE", "be3");
// define("CONECTION_USER", "hexghtba");
// define("CONECTION_PASSWORD", "hexghtba");
// define("CONECTION_SCHEME", "public");
// define("DATABASE_PROVIDER", "postgres");
// define("DATABASE_NAME", "be3_m");
// define("CONECTION_SERVER", "localhost");
// define("CONECTION_NAME_DATABASE", "be3_m");
// define("CONECTION_USER", "postgres");
// define("CONECTION_PASSWORD", "postgres");
// define("CONECTION_SCHEME", "public");
define("CONECTION_SERVER", "localhost");
define("DATABASE_PROVIDER", "mysql");
// define("CONECTION_SERVER", "moesneeds.id");
define("DATABASE_NAME", "u996263040_moesneeds");
define("CONECTION_NAME_DATABASE", "u996263040_moesneeds");
define("CONECTION_USER", "u996263040_moesneeds");
define("CONECTION_PASSWORD", "Moesneeds.id`1");
define("CONECTION_SCHEME", "public");
require_once(BASEPATH . '../FaiFramework/Structure/Content_class/BundleContent.php');
require_once(BASEPATH . '../FaiFramework/Structure/Content_class/BundleContent2.php');
require_once(BASEPATH . '../FaiFramework/Structure/Api_class/EthicaApi.php');
require_once(BASEPATH . '../FaiFramework/Structure/Api_class/JubelioApi.php');
require_once(BASEPATH . '../FaiFramework/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FaiCommandTest extends CI_Controller
{
	public function total_terjual()
    {
		 $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;


        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
		
		DB::selectRaw('id_produk,erp__pos__utama__detail.id_inventaris__asset__list,id_barang_varian,sum(qty) as terjual');
		DB::table('erp__pos__utama__detail');
		DB::groupByRaw($page,['id_produk,erp__pos__utama__detail.id_inventaris__asset__list,id_barang_varian']);
		$get = DB::get('all');
		foreach($get['row'] as $row){
			DB::update('store__produk__varian',["total_terjual_varian"=>$row->terjual], " id_barang_varian=$row->id_barang_varian and id_store__produk = $row->id_produk");
			if(isset($total[$row->id_produk]))
				$total[$row->id_produk] += $row->terjual;
			else
				$total[$row->id_produk] = $row->terjual;
				
		}
		foreach($total as $id_produk =>$terjual){
			DB::update('store__produk',["total_jual"=> $terjual], " id=$id_produk");
		}
	}
    public function all_produk()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;


        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $db_produk['select'][] = "store__produk.id as primary_key,nama_barang,deskripsi_barang ,  concat(utama_file.path,utama_file.file_name_save) as foto_aset,
                            varian_barang,nama_varian,sku_index_varian, concat(varian_file.path,varian_file.file_name_save) as foto_aset_varian,
							nama_tipe_tipe1,nama_list_tipe_varian_varian1,
							inventaris__asset__list__varian.nama_tipe_tipe2,
							nama_list_tipe_varian_varian,
							nama_tipe_tipe3,nama_list_tipe_varian_varian3,
                store__produk.id_toko,
                id_asset,id_barang_varian,berat_varian,berat, 
                case when varian_barang='1' then 1 else 0 end as count_varian, case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok  ";
        $db_produk['utama'] = "store__produk";
        $db_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", " store__produk.id_asset", "inner"];
        $db_produk['join'][] = ["drive__file utama_file", " cast(utama_file.id as text)", " cast(inventaris__asset__list.foto_aset as text)", "inner"];
        $db_produk['join'][] = ["store__produk__varian", "store__produk__varian.id_store__produk", "  store__produk.id", "left"];
        $db_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "store__produk__varian.id_barang_varian", "left"];
        $db_produk['join'][] = ["drive__file varian_file", " cast(varian_file.id as text)", " cast(inventaris__asset__list__varian.foto_aset_varian as text)", "inner"];
        // $db_produk['join'][] = ["(select count(*) as count_varian, id_store__produk from store__produk__varian as varian group by id_store__produk) get_count","get_count.id_store__produk","store__produk.id","left","non_schema"=>true];
      
        $db_produk['np'] = true;
        $produk = Database::database_coverter($page, $db_produk, [], 'source');
        echo '<pre>';
        print_R($produk);
    }
    
    
    
    public function update_connect_barang()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;


        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        print_R(Partial::input('asset'));
        foreach (Partial::input('asset') as $key => $asset) {
            if ($asset)
                DB::update("inventaris__asset__list", ["id_barang_master" => $asset], ["id=$key"]);
            else
                DB::update("inventaris__asset__list", ["id_barang_master" => null], ["id=$key"]);
        }
    }
    public function update_connect_barang_varian()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;


        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        print_R(Partial::input('varian'));
        foreach (Partial::input('varian') as $key => $asset) {
            if ($asset)
                DB::update("inventaris__asset__list__varian", ["id_asset_list_varian" => $asset], ["id=$key"]);
            else
                DB::update("inventaris__asset__list__varian", ["id_asset_list_varian" => null], ["id=$key"]);
        }
    }
    public function sync_sarimbit_ethica_barang($id_barang_master, $id_varian, $search, $page = [])
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        if (!count($page)) {

            $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
            if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

                $domain = $fai->input('frameworksubdomain');
            } else
                $domain = $_SERVER['HTTP_HOST'];
            if (!$type_load) {
                $type_load = $ci->uri->segment(1);
            }
            if ($domain == 'localhost') {
                $domain = 'hibe3.com';
            }
            $page['domain'] = $domain;
            $page['load']['domain'] = $domain;
            $page['load']['type'] = 'tambah';

            $page['app_framework'] = APP_FRAMEWORK;
            $page['database_provider'] = DATABASE_PROVIDER;
            $page['database_name'] = DATABASE_NAME;
            $page['conection_server'] = CONECTION_SERVER;
            $page['conection_name_database'] = CONECTION_NAME_DATABASE;
            $page['conection_user'] = CONECTION_USER;
            $page['conection_password'] = CONECTION_PASSWORD;
            $page['conection_scheme'] = CONECTION_SCHEME;
            $page['is_login'] = 0;
            DB::connection($page);
            $page['web_load_function'] = $type_load;
            $page['load_section'] = "pages";
            $page['load']['login-session-utama']['session_name'] = "id_apps_user";

            $page['load_section'] = "page";

            $page = $fai->LoadApps($page, $domain, -1, 'page');
        }
        //search barang
        $key = EthicaApi::get_key_v2("816622", "25231b80-f006-11ef-ad5b-bc2411f62480", $force_api = 0);

        $search = strtoupper(trim(str_replace("%20", " ", $search)));
        $search = str_replace("  ", " ", $search);
        $get_data = EthicaApi::get_produk_v2([], [
            'key: ' . $key,
            'order_by: tgl_realease desc',
            'customer_seq: 8190',
            'offset: 0',
            'search: ' . $search
        ]);
        // + barang
        $get_data = json_decode($get_data, 1)['data'];
        print_R($get_data);
        foreach ($get_data as $key => $artikel) {
            foreach ($artikel['list_warna'] as $keya => $warna) {
                foreach ($warna['list_ukuran'] as $keyw => $ukuran) {

                    DB::table('store__toko');
                    DB::whereRaw("jenis_toko='Brand'");
                    DB::whereRaw("nama_toko='" . $ukuran['brand'] . "'");
                    $get_brand = DB::get('all');
                    if (!$get_brand['num_rows']) {
                        $last_id = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $ukuran['brand'], "jenis_toko" => "Brand"], [], 'store__toko');
                        $id_brand = $last_id;
                    } else {
                        $id_brand = $get_brand['row'][0]->id;
                    }
                    DB::table('store__toko');
                    DB::whereRaw("jenis_toko='Brand'");
                    DB::whereRaw("nama_toko='" . $ukuran['sub_brand'] . "'");
                    $get_brand = DB::get('all');
                    if (!$get_brand['num_rows']) {
                        $last_id = CRUDFunc::crud_insert($fai, $page, ['nama_toko' => $ukuran['sub_brand'], "jenis_toko" => "Brand", "id_parent" => $id_brand], [], 'store__toko');
                        $id_subbrand = $last_id;
                    } else {
                        $id_subbrand = $get_brand['row'][0]->id;
                    }
                    DB::table('inventaris__asset__list');
                    DB::whereRaw("nama_barang='" . $get_data[$key]['artikel'] . " " . $get_data[$key]['list_warna'][$keya]['warna'] . " " . $get_data[$key]['list_warna'][$keya]['list_ukuran'][$keyw]['ukuran'] . "'");
                    DB::whereRaw("barcode='" . $ukuran['barcode'] . "'");
                    DB::whereRaw("id_brand=$id_subbrand");
                    $get_brand = DB::get('all');
                    if (!$get_brand['num_rows']) {
                        $data['file'] = [];
                        $data['utama'] = [];
                        $data['file']['id_drive'] = 3;
                        $data['file']['id_drive_folder'] = 100;
                        $data['file']['storage'] = 'External';
                        $data['file']['ref_database'] = 'inventaris__asset__list';
                        $data['file']['path'] = $ukuran['gambar_besar'];
                        $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                        $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');

                        $data['utama']['id_jenis_asset'] = 4;
                        $data['utama']['id_kategori'] = 2544;
                        $data['utama']['kode_barang'] = "";
                        $data['utama']['nama_barang'] = $ukuran['nama'];
                        $data['utama']['barcode'] = $ukuran['barcode'];
                        $data['utama']['deskripsi_barang'] = $ukuran['keterangan'];
                        $data['utama']['berat'] = $ukuran['berat'] * 1000;
                        $data['utama']['peruntukan'] = "Pria Wanita";
                        $data['utama']['jenis_barang'] = "Barang Jadi";
                        $data['utama']['kondisi'] = 1;
                        $data['utama']['harga_pokok_penjualan'] = $ukuran['harga'];
                        $data['utama']['harga_pokok'] = $ukuran['harga'];
                        $data['utama']['id_brand'] = $id_subbrand;
                        $data['utama']['is_master'] = 1;
                        $data['utama']['is_api'] = 1;
                        $data['utama']['id_api'] = 1;
                        $data['utama']['id_sync'] = 4;
                        $data['utama']['foto_aset'] = $last_id_foto;
                        $data['utama']['varian_barang'] = 2;
                        $data['utama']['id_from_api'] = $ukuran['seq'];
                        $data['utama']['klasifikasi_produk'] = "Per Barang";

                        $data['utama']['asal_barang_dari'] = "Api";
                        $data['utama']['jual_barang'] = "0";
                        $last_id_utama = CRUDFunc::crud_insert($fai, $page, $data['utama'], [], 'inventaris__asset__list');
                    } else {
                        $last_id_utama = $get_brand['row'][0]->id;
                    }
                    // update varian
                    DB::update("inventaris__asset__list__varian", ["id_asset_list_varian" => $last_id_utama], ["id=$id_varian"]);
                    //tambah varian barang master
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Artikel'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['nama_tipe'] = "Artikel";
                        $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian1");
                    DB::whereRaw("nama_list_tipe_varian='" . $artikel['artikel'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian1 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian1;
                        $tipe_varian['nama_list_tipe_varian'] = $artikel['artikel'];
                        $id_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Warna'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['nama_tipe'] = "Warna";
                        $id_tipe_varian2 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian2");
                    DB::whereRaw("nama_list_tipe_varian='" . $ukuran['warna'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian2 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian2;
                        $tipe_varian['nama_list_tipe_varian'] = $ukuran['warna'];
                        $id_varian2 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                    DB::table('inventaris__master__tipe_varian');
                    DB::whereRaw("nama_tipe='Size'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_tipe_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['nama_tipe'] = "Size";
                        $id_tipe_varian3 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');
                    }
                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("id_inventaris__master__tipe_varian=$id_tipe_varian3");
                    DB::whereRaw("nama_list_tipe_varian='" . $ukuran['ukuran'] . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian3 = $get_tipe['row'][0]->id;
                    } else {
                        $tipe_varian = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian3;
                        $tipe_varian['nama_list_tipe_varian'] = $ukuran['ukuran'];
                        $id_varian3 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }

                    $varian = [];
                    $varian['id_inventaris__asset__list'] = $id_barang_master;
                    $varian['is_asset_list_varian'] = 1;
                    $varian['generate_asset_list'] = 1;
                    $varian['id_asset_list_varian'] = $last_id_utama;
                    $varian['id_tipe_varian_1'] = $id_tipe_varian1;
                    $varian['id_varian_1'] = $id_varian1;
                    $varian['id_tipe_varian_2'] = $id_tipe_varian2;
                    $varian['id_varian_2'] = $id_varian2;
                    $varian['id_tipe_varian_3'] = $id_tipe_varian3;
                    $varian['id_varian_3'] = $id_varian3;
                    $varian['asal_from_data_varian'] = "'Asset'";
                    $varian['asal_from_data_varian'] = 'Asset';
                    $varian['is_master_varian'] = 1;
                    DB::table('inventaris__asset__list__varian');
                    foreach ($varian as $key_varian => $value_varian) {
                        if ($key_varian == 'asal_from_data_varian') {
                            DB::whereRaw("$key_varian='$value_varian'");
                        } else
                            DB::whereRaw("$key_varian=$value_varian");
                    }
                    $getAda = DB::get('all');
                    if (!$getAda['num_rows']) {
                        CRUDFunc::crud_insert($fai, $page, $varian, [], 'inventaris__asset__list__varian');
                    }
                }
            }
        }
    }
    public function export_excel_from_database()
    {


        // === Step 1: Ambil struktur header dari Excel sebelumnya ===
        $template_path = './uploads/691920199586ca8350c25e579daa3bfe - Copy.xlsx'; // file Excel acuan
        $spreadsheet = IOFactory::load($template_path);
        $sheet = $spreadsheet->getActiveSheet();
        $header_row = $sheet->toArray(null, true, true, true)[1]; // baris pertama (judul kolom)
        $header_row = array_filter($header_row);
        $headers = array_values($header_row); // array kolom (ex: ['order_id', 'nama_produk', ...])
        print_r($headers);
        // === Step 2: Connect ke database ===
        $db_type = DATABASE_PROVIDER; // Ganti ke 'pgsql' kalau pakai PostgreSQL
        $host = CONECTION_SERVER;
        $user = CONECTION_USER;
        $pass = CONECTION_PASSWORD;
        $db_name = CONECTION_NAME_DATABASE;
        $table_name = 'shopee_export_data';

        $dsn = $db_type === 'mysql' ? "mysql:host=$host;dbname=$db_name" : "pgsql:host=$host;dbname=$db_name";

        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // === Step 3: Ambil data dari database ===
            $fields = '"' . implode('","', $headers) . '"';
            $query = $pdo->query("SELECT * FROM \"$table_name\"");
            $data_rows = $query->fetchAll(PDO::FETCH_ASSOC);

            // === Step 4: Buat spreadsheet baru ===
            $export = new Spreadsheet();
            $sheet = $export->getActiveSheet();

            // Tulis header ke Excel
            foreach ($headers as $i => $header) {
                $sheet->setCellValueByColumnAndRow($i + 1, 1, $header);
            }

            // Tulis data
            $row_index = 2;
            foreach ($data_rows as $row) {
                foreach ($headers as $col_index => $col_name) {
                    $sheet->setCellValueByColumnAndRow($col_index + 1, $row_index, $row[$col_name] ?? '');
                }
                $row_index++;
            }

            // === Step 5: Export file Excel ===
            $filename = 'export_data_' . date('Ymd_His') . '.xlsx';
            $filepath = './exports/' . $filename;

            if (!file_exists('./exports')) {
                mkdir('./exports', 0777, true);
            }

            $writer = new Xlsx($export);
            $writer->save($filepath);

            // === Step 6: Return success (JSON) + link download
            echo json_encode([
                'status' => 'success',
                'message' => 'Export berhasil!',
                'download_url' => base_url('exports/' . $filename)
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database Error: ' . $e->getMessage()
            ]);
        }
    }
    public function sync_sarimbit_ethica($search)
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $_GET['search'] = $search;
        $_GET['offset'] = 0;
        $_GET['non_produk'] = 1;
        ApiContent::ethica_sarimbit($page, 1, '', 'ethica_sarimbit_update');
    }
    public function import_shopee_generete()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $nama_file = Partial::input('name');
        DB::table('shopee_export_data__excel');
        DB::whereRaw("nama_file = '$nama_file'");
        $get_shopee = DB::get('all');
        DB::table('inventaris__asset__tanah__gudang');
        DB::whereRaw("nama_gudang='Gudang Ethica Api'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_gudang_ethica = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_gudang'] = "Gudang Ethica Api";
            CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

            DB::table('inventaris__asset__tanah__gudang');
            DB::whereRaw("nama_gudang='Gudang Ethica Api'");
            $get_tipe = DB::get('all');
            $id_gudang_ethica = $get_tipe['row'][0]->id;
        }
        DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang_ethica");
        DB::whereRaw("nama_ruang_simpan='Rak Ethica Api'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_ruang_simpan_ethica = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_ruang_simpan'] = "Rak Ethica Api";
            $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang_ethica;
            $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

            DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
            DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang_ethica");
            DB::whereRaw("nama_ruang_simpan='Rak Ethica Api'");
            $get_tipe = DB::get('all');
            $id_ruang_simpan_ethica = $get_tipe['row'][0]->id;
        }
        $so['tanggal_stok_opname'] = date('Y-m-d');
        $so['nomor_stok_opname'] = "";
        $so['id_gudang_stok_opname'] = $id_ruang_simpan_ethica;
        $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan_ethica;
        $last_id = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
        $sudah = [];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        $tipe_generate = Partial::input('tipe_generate');
        $nama_barang = "";
        $get_data = "";
        if ($tipe_generate == 'warna') {
            DB::selectRaw('distinct(vl2.nama_list_tipe_varian) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  vl2.nama_list_tipe_varian", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::limitRaw($page, 1); //id_varian_1
            $get_sarimbit = DB::get('all');

            foreach ($get_sarimbit['row'] as $asset) {
                // print_R($asset);
                // die;
                $key = EthicaApi::get_key_v2("816625", "25231b80-f006-11ef-ad5b-bc2411f62480", $force_api = 0);
                $nama_barang = "$asset->nama_barang";

                $search = strtoupper(trim(str_replace("%20", " ", $asset->nama_barang)));
                $search = str_replace("  ", " ", $search);
                $get_data = EthicaApi::get_produk_v2([], [
                    'key: ' . $key,
                    'order_by: tgl_realease desc',
                    'customer_seq: 8190',
                    'offset: ' . $asset->offset_generate,
                    'warna: ' . $search
                ]);
                // + barang
                $get_data = json_decode($get_data, 1)['data'];
                // count($get_data);
            }
        } else 
        if ($tipe_generate == 'artikel') {
            DB::selectRaw('distinct(vl1.nama_list_tipe_varian) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  vl1.nama_list_tipe_varian", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::limitRaw($page, 1); //id_varian_1
            $get_sarimbit = DB::get('all');
            if ($get_sarimbit['num_rows']) {

                foreach ($get_sarimbit['row'] as $asset) {
                    // print_R($asset);
                    // die;
                    $key = EthicaApi::get_key_v2("816625", "25231b80-f006-11ef-ad5b-bc2411f62480", $force_api = 0);
                    $nama_barang = "$asset->nama_barang";

                    $search = strtoupper(trim(str_replace("%20", " ", $asset->nama_barang)));
                    $search = str_replace("  ", " ", $search);
                    $get_data = EthicaApi::get_produk_v2([], [
                        'key: ' . $key,
                        'order_by: tgl_realease desc',
                        'customer_seq: 8190',
                        'offset: ' . $asset->offset_generate,
                        'artikel: ' . $search
                    ]);
                    // + barang
                    $get_data = json_decode($get_data, 1)['data'];
                    // count($get_data);
                }
            }
        } else 
        if ($tipe_generate == 'barang') {
            DB::selectRaw('distinct(konek.nama_barang) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  konek.nama_barang", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::limitRaw($page, 1); //id_varian_1
            $get_sarimbit = DB::get('all');

            foreach ($get_sarimbit['row'] as $asset) {
                // print_R($asset);
                // die;
                $key = EthicaApi::get_key_v2("816625", "25231b80-f006-11ef-ad5b-bc2411f62480", $force_api = 0);
                $nama_barang = "$asset->nama_barang";

                $search = strtoupper(trim(str_replace("%20", " ", $asset->nama_barang)));
                $search = str_replace("  ", " ", $search);
                $words = explode(" ", $search);

                // Ambil 3 kata pertama
                $firstThreeWords = implode(" ", array_slice($words, 0, 3));
                $get_data = EthicaApi::get_produk_v2([], [
                    'key: ' . $key,
                    'order_by: tgl_realease desc',
                    'customer_seq: 8190',
                    'offset: ' . $asset->offset_generate,
                    'search: ' . $firstThreeWords
                ]);
                // + barang
                $get_data = json_decode($get_data, 1)['data'];
                // count($get_data);
            }
        } else 
        if ($tipe_generate == 'sarimbit') {














            DB::selectRaw('distinct(master.nama_barang) as nama_barang');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
            DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  master.nama_barang", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("master.nama_barang IS NOT NULL AND master.nama_barang <> ''");

            DB::limitRaw($page, 1); //id_varian_1
            $get_asset = DB::get('all');


            if ($get_asset['num_rows']) {

                foreach ($get_asset['row'] as $asset) {
                    $nama_barang = $asset->nama_barang;
                    if ($asset->nama_barang) {

                        $array = [
                            "offset=0"
                        ];
                        $array[] = "search=" . str_replace(" ", "%20", $asset->nama_barang);

                        $link = "";
                        $get_data = json_decode(EthicaApi::get_sarimbit_update($link, $array), true);
                    }
                }
            }
        }
        $total = 0;
        if ($get_data) {
            foreach ($get_data as $key => $artikel) {
                foreach ($artikel['list_warna'] as $keya => $warna) {
                    foreach ($warna['list_ukuran'] as $keyw => $ukuran) {
                        $total++;
                        // "stok" => $get_barang['stok'];
                        // "nama" => $get_barang['nama'],
                        $ukuran['nama'];
                        $get_stok = $ukuran['stok'];
                        DB::selectRaw('inventaris__asset__list.id as id_asset,inventaris__asset__list.kode_barang,inventaris__asset__list__varian.kode_varian,asset_list.id as id_barang,inventaris__asset__list__varian.id as id_varian,shopee_export_data.id as shoope_id');

                        DB::table('inventaris__asset__list');
                        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
                        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
                        DB::whereRaw("asset_list.nama_barang='" . $ukuran['nama'] . "'");
                        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
                        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
                        DB::joinRaw("inventaris__asset__list asset_list on asset_list.id=inventaris__asset__list__varian.id_asset_list_varian", "left");
                        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");

                        $get_sarimbit = DB::get('all');
                        $get_sarimbit['query'];
                        if ($get_sarimbit['num_rows']) {

                            foreach ($get_sarimbit['row'] as $get) {
                                if (!in_array($ukuran['nama'], $sudah)) {

                                    $id_barang = $get->id_barang;
                                    $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang_ethica, $id_ruang_simpan_ethica, $id_barang, 'rekap_akhir');;
                                    if ($get_system_stok['num_rows']) {
                                        $get_system_stok = $get_system_stok['row'][0]->stok;
                                    } else {
                                        $get_system_stok = 0;
                                    }
                                    $detail['id_asset'] = $id_barang;
                                    $detail['data_stok'] = $get_system_stok;
                                    $detail['data_real'] = $get_stok;

                                    $detail['selisih'] = $get_stok - $get_system_stok;
                                    $detail['id_erp__pos__stok_opname'] = $last_id;
                                    if ($detail['selisih'])
                                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                                    $sudah[] = $ukuran['nama'];
                                }
                                $data_shopee = [];
                                $data_shopee['et_title_variation_stock'] = $ukuran['stok'];
                                $data_shopee['et_title_variation_price'] = $ukuran['harga'];
                                $data_shopee['generate_stok'] = 1;
                                // print_R($get);

                                // DB::update("shopee_export_data", $data_shopee, ["id=$get->shoope_id"]);
                                DB::update("shopee_export_data", $data_shopee, ["et_title_variation_id='$get->kode_varian' and et_title_product_id='$get->kode_barang'"]);
                                if (!$get->shoope_id) {
                                    DB::table('shopee_export_data');
                                    DB::whereRaw("et_title_variation_id='$get->kode_varian' and et_title_product_id='$get->kode_barang'");
                                    $get_sarimbit_shopee = DB::get('all');
                                    if ($get_sarimbit_shopee['num_rows']) {

                                        $get->shoope_id = $get_sarimbit_shopee['row'][0]->id;
                                    } else {
                                        $ukuran['id_shopee_export_data__excel'] = $get_shopee['row'][0]->id;
                                        CRUDFunc::crud_insert($fai, $page, $ukuran, [], 'shopee_export_data__ethica_belum');
                                    }
                                }
                                if ($get->shoope_id)
                                    DB::update("shopee_export_data__excel__baris", ["status_generate" => 1], ["id_shopee_export_data=$get->shoope_id and id_shopee_export_data__excel=" . $get_shopee['row'][0]->id]);
                                DB::update("shopee_export_data__proses_generate", ["status_generate" => 1], ["generate_by='barang' and content_generate='" . $ukuran['nama'] . "' and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
                            }
                        } else {
                            $ukuran['id_shopee_export_data__excel'] = $get_shopee['row'][0]->id;
                            CRUDFunc::crud_insert($fai, $page, $ukuran, [], 'shopee_export_data__ethica_belum');
                        }
                    }
                }
            }
        }
        DB::update("shopee_export_data__proses_generate", ["status_generate" => 1], ["generate_by='$tipe_generate' and content_generate='$nama_barang' and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
        if ($total >= 29 and $tipe_generate != 'sarimbit') {
            // DB::update("shopee_export_data__proses_generate", ["offset_generate" => 30], ["generate_by='tipe_generate' and content_generate='$nama_barang' and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
        } else {
        }
        DB::table('shopee_export_data__proses_generate');
        DB::whereRaw("id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id . " and (status_generate is null) and generate_by='barang' ");
        $get_count = DB::get('all');
        if ($tipe_generate == 'warna') {
            DB::selectRaw('distinct(vl2.nama_list_tipe_varian) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  vl2.nama_list_tipe_varian", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);

            $get_sarimbit = DB::get('all');

            echo json_encode([
                'status' => 'success',
                "next_generate" =>  $get_sarimbit['num_rows'] ? "warna" : 'sarimbit',
                "sisa" => $get_count['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
        if ($tipe_generate == 'artikel') {
            DB::selectRaw('distinct(vl1.nama_list_tipe_varian) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
            DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
            DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  vl1.nama_list_tipe_varian", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);

            $get_sarimbit = DB::get('all');

            echo json_encode([
                'status' => 'success',
                "next_generate" => $get_sarimbit['num_rows'] ? "artikel" : 'barang',
                "sisa" => $get_count['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
        if ($tipe_generate == 'barang') {
            DB::selectRaw('distinct(konek.nama_barang) as nama_barang,offset_generate');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1

            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  konek.nama_barang", "left"); //id_varian_1

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__proses_generate.content_generate IS NOT NULL AND shopee_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);

            $get_sarimbit = DB::get('all');

            echo json_encode([
                'status' => 'success',
                "next_generate" => $get_sarimbit['num_rows'] ? "barang" : 'barang',
                "sisa" => $get_count['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
         if ($tipe_generate == 'sarimbit') {
            DB::selectRaw('distinct(master.nama_barang) as nama_barang');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
            DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
            DB::joinRaw("shopee_export_data__proses_generate  on content_generate =  master.nama_barang", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
            DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");

            DB::whereRaw("shopee_export_data__proses_generate.status_generate is null");
            DB::whereRaw("shopee_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("shopee_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("master.nama_barang IS NOT NULL AND master.nama_barang <> ''");

            $get_asset = DB::get('all');

            echo json_encode([
                'status' => 'success',
                "next_generate" => $get_asset['num_rows'] ? "sarimbit" : 'artikel',
                "sisa" => $get_count['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_asset['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        }
    }
    public function shopee_inisiasi_data()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        //generate yang tidak terafiliasi dengan system 




        $nama_file = Partial::input('name');
        DB::table('shopee_export_data__excel');
        DB::whereRaw("nama_file = '$nama_file'");
        $get_shopee = DB::get('all');
        //generate pengosongan stok
        DB::selectRaw('shopee_export_data.id');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
        DB::orderRaw($page, "inventaris__asset__list.nama_barang asc");
        $get_sarimbit = DB::get('all');
        // echo $get_sarimbit['query'];
        foreach ($get_sarimbit['row'] as $asset) {
            DB::update("shopee_export_data", ['et_title_variation_stock' => 0], ["id=$asset->id"]);
        }
        //generate warna
        DB::selectRaw('distinct(vl2.nama_list_tipe_varian) as nama_barang');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");

        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1


        $get_sarimbit = DB::get('all');
        foreach ($get_sarimbit['row'] as $asset) {
            $generate = [];
            $generate['generate_by'] = 'warna';
            $generate['content_generate'] = $asset->nama_barang;
            $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
            CRUDFunc::crud_insert($fai, $page, $generate, [], 'shopee_export_data__proses_generate');
        }
        //generate_sarimbit
        DB::selectRaw('distinct(master.nama_barang) as nama_barang');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
        DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
        $get_asset = DB::get('all');
        foreach ($get_asset['row'] as $asset) {
            $generate = [];
            $generate['generate_by'] = 'sarimbit';
            $generate['content_generate'] = $asset->nama_barang;
            $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
            CRUDFunc::crud_insert($fai, $page, $generate, [], 'shopee_export_data__proses_generate');
        }
        //per artikel  
        DB::selectRaw('distinct(vl1.nama_list_tipe_varian) as nama_barang');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");

        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1


        $get_sarimbit = DB::get('all');
        foreach ($get_sarimbit['row'] as $asset) {
            $generate = [];
            $generate['generate_by'] = 'artikel';
            $generate['content_generate'] = $asset->nama_barang;
            $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
            CRUDFunc::crud_insert($fai, $page, $generate, [], 'shopee_export_data__proses_generate');
        }
        //per barang
        DB::selectRaw('distinct(konek.nama_barang)');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");

        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1

        $get_sarimbit = DB::get('all');
        foreach ($get_sarimbit['row'] as $asset) {
            $generate = [];
            $generate['generate_by'] = 'barang';
            $generate['content_generate'] = $asset->nama_barang;
            $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
            CRUDFunc::crud_insert($fai, $page, $generate, [], 'shopee_export_data__proses_generate');
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Inisasi Data Sukses:' . $get_shopee['row'][0]->id
        ]);
    }
    public function shopee_database_excel()
    {

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        // ==== Config Manual Database (FLEKSIBEL) ====
        $db_type = DATABASE_PROVIDER; // Ganti ke 'pgsql' kalau pakai PostgreSQL
        $host = CONECTION_SERVER;
        $user = CONECTION_USER;
        $pass = CONECTION_PASSWORD;
        $db_name = CONECTION_NAME_DATABASE;
        $table_name = 'shopee_export_data';
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $dsn = '';
        if ($db_type === 'mysql') {
            $dsn = "mysql:host=$host;";
        } elseif ($db_type === 'postgres') {
            $dsn = "pgsql:host=$host;";
        }

        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // ==== Buat database jika belum ada ====
            if ($db_type === 'mysql') {
                $pdo->exec("CREATE DATABASE IF NOT EXISTS \"$db_name\"");
            } elseif ($db_type === 'pgsql') {
                $pdo->exec("CREATE DATABASE \"$db_name\""); // Jika gagal karena sudah ada, bisa diabaikan atau pakai try-catch
            }

            // ==== Koneksi ke database baru ====
            $dsn_db = $dsn . "dbname=$db_name";
            $pdo = new PDO($dsn_db, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $name_file = Partial::input('name');

            $tipe_varian = [];
            $tipe_varian['nama_file'] = "$name_file";
            $id_shopee = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'shopee_export_data__excel');
            DB::table("shopee_export_data__excel");
            DB::whereRaw("nama_file='" . $name_file . "'");
            $get_asset = DB::get('all');
            $id_shopee = $get_asset['row'][0]->id;

            // ==== Baca file Excel ====
            // http://localhost/frameworkServer_v1/uploads/691920199586ca8350c25e579daa3bfe.xlsx
            $file_path = './uploads/' . $name_file; // Ganti sesuai upload
            $spreadsheet = IOFactory::load($file_path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            $columns_temp = array_map('trim', $rows[1]);
            $column_keys = array_keys($columns_temp);

            // ==== Buat tabel jika belum ada ====
            $fields_sql = [];
            $columns = [];
            foreach ($columns_temp as $key => $col) {
                if ($col)
                    $columns[$key] = $col;
            }
            foreach ($columns as $col) {
                if ($col)
                    $fields_sql[] = "\"$col\" TEXT";
            }
            $unique_key = $columns[$column_keys[0]];

            $create_sql = "CREATE TABLE IF NOT EXISTS \"$table_name\" (
                id SERIAL PRIMARY KEY,
                " . implode(", ", $fields_sql) . "
               
            )";

            $pdo->exec($create_sql);

            // ==== Cek kolom existing ====
            $existing_columns = [];
            $result = $pdo->query("SELECT column_name FROM information_schema.columns WHERE table_name = '$table_name'");
            foreach ($result as $row) {
                $existing_columns[] = $row['column_name'];
            }

            // ==== Tambahkan kolom jika belum ada ====
            foreach ($columns as $col) {
                if ($col) {

                    if (!in_array($col, $existing_columns)) {
                        echo "ALTER TABLE \"$table_name\" ADD COLUMN \"$col\" TEXT";
                        // $pdo->exec("ALTER TABLE \"$table_name\" ADD COLUMN \"$col\" TEXT");
                    }
                }
            }
            // print_R($rows);

            // ==== Masukkan / update data ====
            if (1) {

                for ($i = 7; $i <= count($rows); $i++) {
                    $row_data = $rows[$i];
                    $data = [];
                    foreach ($columns as $key => $col_name) {


                        $val = isset($row_data[$key]) ? $row_data[$key] : '';
                        $data[$col_name] = $val;
                    }

                    $where_field = $columns[$column_keys[2]];

                    $where_value = $data[$where_field];

                    // Cek apakah data sudah ada
                    $stmt = $pdo->prepare("SELECT * FROM \"$table_name\" WHERE \"$where_field\" = :val LIMIT 1");
                    $stmt->execute([':val' => $where_value]);
                    $exists = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($exists) {
                        // UPDATE
                        $update_fields = [];
                        foreach ($data as $key => $val) {
                            $update_fields[] = "\"$key\" = :$key";
                        }
                        $sql = "UPDATE \"$table_name\" SET " . implode(', ', $update_fields) . ",generate_stok=0 WHERE \"$where_field\" = :where_val";
                        $data['where_val'] = $where_value;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($data);
                    } else {
                        // INSERT
                        $keys = array_keys($data);
                        $placeholders = array_map(fn($k) => ":$k", $keys);
                        $sql = "INSERT INTO \"$table_name\" (\"" . implode('", "', $keys) . "\") VALUES (" . implode(", ", $placeholders) . ")";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($data);
                    }
                    $baris = [];
                    DB::table($table_name);
                    DB::whereRaw("et_title_variation_id='" . $data['et_title_variation_id'] . "'");
                    $get_asset = DB::get('all');
                    if ($get_asset['num_rows']) {
                        $baris['id_shopee_export_data'] = $get_asset['row'][0]->id;
                        $baris['id_shopee_export_data__excel'] = $id_shopee;
                        $baris['status_generate'] = 0;
                        CRUDFunc::crud_insert($fai, $page, $baris, [], 'shopee_export_data__excel__baris');
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Import berhasil diproses! nama file = ' . $name_file . ' ID SHOPE' . $id_shopee,
                'rows_processed' => count($rows) - 1
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database Error: ' . $e->getMessage()
            ]);
        }
    }

    public function upload_excel()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 20480; // 2MB max
        $config['encrypt_name'] = TRUE; // agar nama file tidak bentrok

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        if ($this->upload->do_upload('excel_file')) {
            $data = $this->upload->data();
            echo json_encode([
                'status' => 'success',
                'message' => 'File berhasil diupload.',
                'file_name' => $data['file_name'],
                'file_path' => base_url('uploads/' . $data['file_name'])
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => strip_tags($this->upload->display_errors())
            ]);
        }
    }
    public function shopee_manual_update_stok_excel()
    {
        $this->load->view('ShopeeManualUpload');
    }

    public function shopee_manual_analisis_belum_produk()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        // $_GET['search'] = $search;
        $_GET['offset'] = 0;
        $_GET['non_produk'] = 1;
        $_GET['just_sarimbit'] = 1;
        $offset = 0;
        $list = [];
        while (true) {
            $array = [
                "offset=$offset"
            ];
            if (Partial::input('search')) {
                $array[] = "search=" . Partial::input('search');
            }
            $link = "";
            if ($offset > 185) {
                break;
            }
            $get_data = json_decode(EthicaApi::get_sarimbit_update($link, $array), true);
            if (($get_data[0]['keterangan'] == 'Tidak ada data')) break;

            foreach ($get_data as $value) {
                DB::selectRaw('*, inventaris__asset__list.id as primary');
                DB::table('inventaris__asset__list');
                DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
                DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
                DB::whereRaw("master.nama_barang = '" . $value['nama'] . "'");
                $get_asset = DB::get('all');
                if (!$get_asset['num_rows']) {
                    $list[] = $value['nama'];
                }
            }
            $offset += 30;
        }
        echo '<pre>';
        print_R($list);
    }
    public function shopee_manual_inisiasi_not_produk_sync()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');

        DB::selectRaw('shopee_export_data.*');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is null");
        DB::orderRaw($page, "inventaris__asset__list.nama_barang asc");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=inventaris__asset__list__varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=inventaris__asset__list__varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=inventaris__asset__list__varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=inventaris__asset__list__varian.id_varian_2", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v3 on v3.id=inventaris__asset__list__varian.id_tipe_varian_3", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl3 on vl3.id=inventaris__asset__list__varian.id_varian_3", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        DB::joinRaw("shopee_export_data on shopee_export_data.et_title_product_id=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=shopee_export_data.et_title_variation_id", "left");
        DB::joinRaw("shopee_export_data__excel__baris on shopee_export_data.id=shopee_export_data__excel__baris.id_shopee_export_data");

        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is  null");
        // DB::whereRaw("shopee_export_data__excel__baris.status_generate !=1");
        DB::whereRaw("shopee_export_data__excel__baris.id_shopee_export_data__excel=19");
        $get_sarimbit = DB::get('all');
        echo '<pre>';
        print_R($get_sarimbit);
    }
    public function shopee_manual_produk_sync()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');

        // array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
        // array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),
        $nama_gudang = "Shopee";
        $nama_ruang_simpan = "Manual";
        DB::table('inventaris__asset__tanah__gudang');
        DB::whereRaw("nama_gudang='$nama_gudang'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_gudang = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_gudang'] = "$nama_gudang";
            CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

            DB::table('inventaris__asset__tanah__gudang');
            DB::whereRaw("nama_gudang='$nama_gudang'");
            $get_tipe = DB::get('all');
            $id_gudang = $get_tipe['row'][0]->id;
        }
        DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
        DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_ruang_simpan'] = "$nama_ruang_simpan";
            $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang;
            $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

            DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
            DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
            DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
            $get_tipe = DB::get('all');
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('DATA BARANG SHOPEE.xlsx');

        // Misal mau ambil sheet ke-2 (ingat, index mulai dari 0)
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil semua data ke array
        $data = $sheet->toArray();
        $detailFromSheet = [];


        foreach ($data as $baris => $row) {
            // foreach ($row as $cell) {
            //     echo $cell . "\t";
            // }
            if ($baris > 1) {
                $detailFromSheet['by_nama'][$row[1]]['sarimbit'] = $row[13];
                $detailFromSheet['by_nama'][$row[1]]['variasi'][$row[3]] = $row[12];
                $detailFromSheet['by_kode'][$row[0]]['sarimbit'] = $row[13];
                $detailFromSheet['by_kode'][$row[0]]['variasi'][$row[2]] = $row[12];
            }
        }

        DB::table('inventaris__asset__list');
        DB::whereRaw("klasifikasi_produk != 'Per Barang'  ORDER BY nama_barang");
        $get_sarimbit = DB::get('all');
        DB::selectRaw('*, inventaris__asset__list.id as primary');
        DB::table('inventaris__asset__list');
        DB::whereRaw("asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("nama_barang not like '%GB%'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        $get_asset = DB::get('all');
        $no = 0;
        echo '<table>
        <thead><tr>
            <th>No</th>
            <th>Nama</th>
            <th>Sugest</th>
            <th>Asset Sync</th>
            <th>Sync Api Ethica</th>
            </tr>
        </thead>
        <tbody>
       

        ';
        //FAILL UPDATE
        //Array ( [107105] => 32850 [107134] => [107135] => [107136] => [107137] => 33629 [107138] => 32185 [107139] => 31223 [107140] => [107141] => [107142] => [107143] => [107144] => 32099 [107145] => 35163 [107146] => 35084 [107147] => 32131 [107148] => [107149] => 33457 [107150] => [107151] => [107152] => [107153] => 34057 [107154] => [107155] => 34057 [107156] => 31320 [107157] => 31023 [107158] => [107159] => 32221 [107160] => [107161] => 32819 [107162] => 33417 [107163] => [107164] => [107165] => [107166] => [107167] => 31483 [107168] => [107169] => 32321 [107170] => [107171] => [107172] => 35009 [107173] => [107174] => 31055 [107175] => 32035 [107176] => [107177] => 31950 [107178] => [107179] => 34902 [107180] => 31418 [107181] => [107182] => 35164 [107183] => 36776 [107184] => 31157 [107185] => 35107 [107186] => [107187] => 31320 [107188] => [107189] => [107190] => [107191] => 32244 [107192] => 34978 [107193] => 33368 [107194] => [107195] => [107196] => 31815 [107197] => 33961 [107198] => 33961 [107199] => 34971 [107200] => [107201] => 34970 [107202] => 30989 [107203] => [107204] => [107205] => 31352 [107206] => 35083 [107207] => 31087 [107208] => [107209] => 31915 [107210] => 32003 [107211] => 33595 [107212] => 32256 [107213] => [107214] => [107215] => [107216] => 34057 [107217] => 34978 [107218] => 33595 [107219] => [107220] => 31191 [107221] => 32449 [107222] => [107223] => 34530 [107224] => 32186 [107225] => 31287 [107226] => [107227] => 32067 [107228] => [107229] => 31088 [107230] => 31121 [107231] => [107232] => 31849 [107233] => [107234] => 34057 [107235] => 31224 [107236] => [107237] => 31383 [107238] => 31450 [107239] => [107240] => [107241] => 33629 [107242] => [107243] => 33994 [107244] => 30990 [107245] => [107246] => 35009 [107247] => 36532 [107248] => [107249] => [107250] => 33457 [107251] => [107252] => 35220 [107253] => 32510 [107254] => [107255] => [107256] => [107257] => [107258] => 35197 [107259] => ) 
        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_barang" method="post">';

        foreach ($get_asset['row'] as $asset) {
            $no++;
            echo "<tr>
                <td>$no </td>
                <td>$asset->nama_barang </td>
                <td>" . ($detailFromSheet['by_kode'][$asset->kode_barang]['sarimbit'] ?? '') . " </td>
                <td><select name='asset[$asset->primary]'>
                <option value=''>-PILIH-</option>
                ";
            foreach ($get_sarimbit['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id . '" ' . ($asset->id_barang_master == $sarimbit->id ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$asset->kode_barang]['sarimbit'] ?? '') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
            echo "</select> </td>
            <td>
            <a href='" . base_url() . "index.php/FaiCommandTest/sync_sarimbit_ethica/" . ($detailFromSheet['by_kode'][$asset->kode_barang]['sarimbit'] ?? '') . "'>Sync Sarimbit</a>
            </td>
            </tr>";
        }
        echo ' </tbody></table>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';

        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_barang_varian" method="post">';
        $no = 0;
        DB::selectRaw('inventaris__asset__list.*,inventaris__asset__list__varian.id as id_varian,inventaris__asset__list__varian.nama_varian,inventaris__asset__list.id as id_inventaris__asset__list,v1.nama_tipe as v1_nama_tipe,v2.nama_tipe as v2_nama_tipe,v3.nama_tipe as v3_nama_tipe,vl1.nama_list_tipe_varian as vl1_nama_list_tipe_varian,vl2.nama_list_tipe_varian as vl2_nama_list_tipe_varian,vl3.nama_list_tipe_varian as vl3_nama_list_tipe_varian,konek.nama_barang as nama_barang_konek,inventaris__asset__list__varian.id_asset_list_varian,inventaris__asset__list.kode_barang,kode_varian');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Shopee - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is null");
        DB::orderRaw($page, "inventaris__asset__list.nama_barang asc");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=inventaris__asset__list__varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=inventaris__asset__list__varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=inventaris__asset__list__varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=inventaris__asset__list__varian.id_varian_2", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v3 on v3.id=inventaris__asset__list__varian.id_tipe_varian_3", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl3 on vl3.id=inventaris__asset__list__varian.id_varian_3", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        // DB::limitRaw($page, 450); //id_varian_1
        $get_sarimbit = DB::get('all');
        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_varian" method="post">';
        echo '<table border=1>
            <thead><tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Varian</th>
                <th>Varian Values</th>
                <th>Konektifitas Asset</th>
                <th>Suggestion</th>
                <th>Asset Sync</th>
                <th>Sync Api Ethica</th>
                
                </tr>
            </thead>
            <tbody>
           

        ';
        // print_R($get_sarimbit);
        $start = 300;
        foreach ($get_sarimbit['row'] as $row) {
            $no++;
            echo "<tr>
            <td>$no </td>
            <td>$row->nama_barang </td>
            <td>$row->nama_varian </td>
            <td>$row->v1_nama_tipe:$row->vl1_nama_list_tipe_varian<Br>$row->v2_nama_tipe:$row->vl2_nama_list_tipe_varian<br>$row->v3_nama_tipe:$row->vl3_nama_list_tipe_varian </td>
            <td>$row->nama_barang_konek </td>
            <td>$row->kode_barang - $row->kode_varian<BR>" . ($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '') . " </td>
            <td><select name='varian[$row->id_varian]'>
            <option value=''>-PILIH-</option>
            ";
            // id_barang_master
            DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
            DB::table('inventaris__asset__list');
            DB::whereRaw("upper(inventaris__asset__list.nama_barang) like '%" . trim(strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1')) . "%' ");

            DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
            $get_barang = DB::get('all');
            foreach ($get_barang['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id_asset . '" ' . ($row->id_asset_list_varian == $sarimbit->id_asset ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
            echo " <td>
            <a href='" . base_url() . "index.php/FaiCommandTest/sync_sarimbit_ethica_barang/$row->id_barang_master/$row->id_varian/" . trim(strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1')) . "'>Sync Sarimbit</a>
            </td>";
            echo '<td>';
            if ($no > $start) {
                //  FaiCommandTest::sync_sarimbit_ethica_barang($row->id_barang_master,$row->id_varian, trim(strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1')),$page);
            }
            echo '</td>';
        }
        echo ' </tbody></table>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
        echo $get_sarimbit['num_rows_non_limit'];
    }
    public function shopee_manual()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');

        // array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
        // array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),
        $nama_gudang = "Shopee";
        $nama_ruang_simpan = "Manual";
        DB::table('inventaris__asset__tanah__gudang');
        DB::whereRaw("nama_gudang='$nama_gudang'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_gudang = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_gudang'] = "$nama_gudang";
            CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

            DB::table('inventaris__asset__tanah__gudang');
            DB::whereRaw("nama_gudang='$nama_gudang'");
            $get_tipe = DB::get('all');
            $id_gudang = $get_tipe['row'][0]->id;
        }
        DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
        DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_ruang_simpan'] = "$nama_ruang_simpan";
            $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang;
            $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

            DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
            DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
            DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
            $get_tipe = DB::get('all');
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        }
        $so['tanggal_stok_opname'] = date('Y-m-d');
        $so['nomor_stok_opname'] = "";
        $so['id_gudang_stok_opname'] = $id_gudang;
        $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan;
        $last_id = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('DATA BARANG SHOPEE.xlsx');

        // Misal mau ambil sheet ke-2 (ingat, index mulai dari 0)
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil semua data ke array
        $data = $sheet->toArray();
        $detailFromSheet = [];


        foreach ($data as $baris => $row) {
            // foreach ($row as $cell) {
            //     echo $cell . "\t";
            // }
            if ($baris > 1) {
                $detailFromSheet['by_nama'][$row[1]]['sarimbit'] = $row[13];
                $detailFromSheet['by_nama'][$row[1]]['variasi'][$row[3]] = $row[12];
                $detailFromSheet['by_kode'][$row[0]]['sarimbit'] = $row[13];
                $detailFromSheet['by_kode'][$row[0]]['variasi'][$row[2]] = $row[12];

                $insert = [];
                $insert['kode_barang'] = $row[0];
                $insert['jenis_barang'] = "Barang Jadi";
                $insert['id_jenis_asset'] = "4";
                $insert['jual_aset_barang'] = "Ya";
                $insert['varian_barang'] = 1;
                $insert['id_panel'] = -1;
                $insert['asal_barang_dari'] = "Shopee - Manual";
                $insert['is_master'] = 1;
                // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; 
                // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; //toko

                // print_R($insert);
                $db = [];
                foreach ($insert as $tk => $vk) {
                    $va = $insert[$tk] = Database::string_database($page, $fai, $vk);
                    $db['where'][] = ["inventaris__asset__list.$tk", "=", "'$va'"];
                }

                $insert['nama_barang'] = $row[1];
                $db['utama'] = "inventaris__asset__list";
                $db['np'] = "inventaris__asset__list";
                $get_all = Database::database_coverter($page, $db, [], 'all');
                // print_R();
                $total = 0;
                $list = [];


                if ($get_all['num_rows']) {
                    $last_id_utama = $get_all['row'][0]->primary_key;
                } else {
                    $total++;
                    $list[] = "inventaris__asset__list-><BR> (" . $get_all['query'] . ")<BR>";
                    $last_id_utama = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__list');
                }
                foreach (explode(',', $row[3]) as $key => $list_var) {

                    DB::table('inventaris__master__tipe_varian__list');
                    DB::whereRaw("nama_list_tipe_varian='" . $list_var . "'");
                    $get_tipe = DB::get('all');
                    if ($get_tipe['num_rows']) {
                        $id_varian[$key] = $get_tipe['row'][0]->id;
                        $id_tipe_varian[$key] = $get_tipe['row'][0]->id_inventaris__master__tipe_varian;
                    } else {
                        DB::table('inventaris__master__tipe_varian');
                        DB::whereRaw("nama_tipe='VARIASI'");
                        $get_tipe = DB::get('all');
                        if ($get_tipe['num_rows']) {
                            $id_tipe_varian[$key] = $get_tipe['row'][0]->id;
                        } else {
                            $tipe_varian = [];
                            $tipe_varian['nama_tipe'] = "VARIASI";
                            $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');

                            DB::table('inventaris__master__tipe_varian');
                            DB::whereRaw("nama_tipe='VARIASI'");
                            $get_tipe = DB::get('all');
                            $id_tipe_varian[$key] = $get_tipe['row'][0]->id;
                        }
                        $tipe_varian = [];
                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian[$key];
                        $tipe_varian['nama_list_tipe_varian'] = $list_var;
                        $id_varian[$key] = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                    }
                }

                $data_varian = [];
                $data_varian['id_inventaris__asset__list'] = $last_id_utama;

                $data_varian['id_tipe_varian_1'] = $id_tipe_varian[0] ?? -1;
                $data_varian['id_varian_1'] = $id_varian[0] ?? -1;
                $data_varian['id_tipe_varian_2'] = $id_tipe_varian[1] ?? -1;
                $data_varian['id_varian_2'] = $id_varian[1] ?? -1;
                $data_varian['id_tipe_varian_3'] = $id_tipe_varian[2] ?? -1;

                $data_varian['id_varian_3'] = $id_varian[2] ?? -1;
                $data_varian['harga_pokok_penjualan_varian'] = $row[6];
                $data_varian['kode_varian'] = $row[2];
                $data_varian['asal_from_data_varian'] = "Shopee - Manual";
                DB::table('inventaris__asset__list__varian');
                foreach ($data_varian as $key_varian => $value_varian) {
                    if (!$value_varian) {
                    } else if (in_array($key_varian, ['asal_from_data_varian', "jubelio_item_code", 'kode_varian', 'foto_aset'])) {
                        DB::whereRaw("$key_varian='$value_varian'");
                    } else
                        DB::whereRaw("$key_varian=$value_varian");
                }
                $getAda = DB::get('all');
                if (!$getAda['num_rows']) {
                    $last_id_varian = CRUDFunc::crud_insert($fai, $page, $data_varian, [], 'inventaris__asset__list__varian');
                } else {
                    $last_id_varian = $getAda['row'][0]->id;

                    DB::update("inventaris__asset__list__varian", $data_varian, ["id=$last_id_varian"]);
                }
                $get_stok = $row[7];

                $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $last_id_utama, 'rekap_akhir', [], $last_id_varian);;
                if ($get_system_stok['num_rows']) {
                    $get_system_stok = $get_system_stok['row'][0]->stok;
                } else {
                    $get_system_stok = 0;
                }
                $detail = [];
                $detail['id_asset'] = $last_id_utama;
                $detail['id_asset_varian'] = $last_id_varian;
                $detail['data_stok'] = (int) $get_system_stok;
                $detail['data_real'] = (int) $get_stok;
                $detail['selisih'] = (int) $get_stok - $get_system_stok;
                $detail['id_erp__pos__stok_opname'] = $last_id;
                //  print_R($detail);
                if ($detail['selisih'])
                    CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
            }
        }

        DB::table('inventaris__asset__list');
        DB::whereRaw("klasifikasi_produk != 'Per Barang'  ORDER BY nama_barang");
        $get_sarimbit = DB::get('all');
        DB::selectRaw('*, inventaris__asset__list.id as primary');
        DB::table('inventaris__asset__list');
        DB::whereRaw("asal_barang_dari='Jubelio'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        $get_asset = DB::get('all');
        foreach ($get_asset['row'] as $asset) {
            $no++;
            echo "<tr>
                <td>$no </td>
                <td>$asset->nama_barang </td>
                <td>" . ($detailFromSheet['by_kode'][$asset->channel_group_id]['sarimbit'] ?? '') . " </td>
                <td><select name='asset[$asset->primary]'>
                <option value=''>-PILIH-</option>
                ";
            foreach ($get_sarimbit['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id . '" ' . ($asset->id_barang_master == $sarimbit->id ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$asset->kode_barang]['sarimbit'] ?? '') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
            echo "</select> </td>
            </tr>";
        }
        echo ' </tbody></table>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';

        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_barang_varian" method="post">';
        $no = 0;
        DB::selectRaw('inventaris__asset__list.*,inventaris__asset__list__varian.id as id_varian,inventaris__asset__list__varian.nama_varian,inventaris__asset__list.id as id_inventaris__asset__list,v1.nama_tipe as v1_nama_tipe,v2.nama_tipe as v2_nama_tipe,v3.nama_tipe as v3_nama_tipe,vl1.nama_list_tipe_varian as vl1_nama_list_tipe_varian,vl2.nama_list_tipe_varian as vl2_nama_list_tipe_varian,vl3.nama_list_tipe_varian as vl3_nama_list_tipe_varian,konek.nama_barang as nama_barang_konek,inventaris__asset__list__varian.id_asset_list_varian,channel_group_id,jubelio_item_code');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Jubelio'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=inventaris__asset__list__varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=inventaris__asset__list__varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=inventaris__asset__list__varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=inventaris__asset__list__varian.id_varian_2", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v3 on v3.id=inventaris__asset__list__varian.id_tipe_varian_3", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl3 on vl3.id=inventaris__asset__list__varian.id_varian_3", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        $get_sarimbit = DB::get('all');
        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_varian" method="post">';
        echo '<table border=1>
            <thead><tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Varian</th>
                <th>Varian Values</th>
                <th>Konektifitas Asset</th>
                <th>Suggestion</th>
                <th>Asset Sync</th></tr>
            </thead>
            <tbody>
           

        ';
        // print_R($get_sarimbit);
        foreach ($get_sarimbit['row'] as $row) {
            $no++;
            echo "<tr>
            <td>$no </td>
            <td>$row->nama_barang </td>
            <td>$row->nama_varian </td>
            <td>$row->v1_nama_tipe:$row->vl1_nama_list_tipe_varian<Br>$row->v2_nama_tipe:$row->vl2_nama_list_tipe_varian<br>$row->v3_nama_tipe:$row->vl3_nama_list_tipe_varian </td>
            <td>$row->nama_barang_konek </td>
            <td>$row->channel_group_id - $row->jubelio_item_code<BR>" . ($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '') . " </td>
            <td><select name='varian[$row->id_varian]'>
            <option value=''>-PILIH-</option>
            ";
            // id_barang_master
            DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
            DB::table('inventaris__asset__list');
            DB::whereRaw("upper(inventaris__asset__list.nama_barang) like '%" . trim(strtoupper($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '-1')) . "%' ");

            DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
            $get_barang = DB::get('all');
            foreach ($get_barang['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id_asset . '" ' . ($row->id_asset_list_varian == $sarimbit->id_asset ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '-1') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
        }
        echo ' </tbody></table>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
    }
    public function jubelio()
    {

        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;
        $page['load']['type'] = 'tambah';

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');

        // array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
        // array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),

        DB::table('inventaris__asset__tanah__gudang');
        DB::whereRaw("nama_gudang='Jubelio'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_gudang = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_gudang'] = "Jubelio";
            CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

            DB::table('inventaris__asset__tanah__gudang');
            DB::whereRaw("nama_gudang='Jubelio'");
            $get_tipe = DB::get('all');
            $id_gudang = $get_tipe['row'][0]->id;
        }
        DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
        DB::whereRaw("nama_ruang_simpan='Jubelio'");
        $get_tipe = DB::get('all');
        if ($get_tipe['num_rows']) {
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        } else {
            $tipe_varian = [];
            $tipe_varian['nama_ruang_simpan'] = "Jubelio";
            $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang;
            $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

            DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
            DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
            DB::whereRaw("nama_ruang_simpan='Jubelio'");
            $get_tipe = DB::get('all');
            $id_ruang_simpan = $get_tipe['row'][0]->id;
        }
        $so['tanggal_stok_opname'] = date('Y-m-d');
        $so['nomor_stok_opname'] = "";
        $so['id_gudang_stok_opname'] = $id_gudang;
        $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan;
        $last_id = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');

        echo '<pre>';
        $production = 1;
        if ($production) {
            $login = JubelioApi::login(1);
            // print_R($get_token);
            $get_token = $login['token'];
            $item_list = JubelioApi::get_item($get_token, 1, ($_GET['page'] ?? 1), ($_GET['size'] ?? 200));
            if (!$item_list['data']) {
                print_R($item_list);
                die;
            }


            foreach ($item_list['data'] as $data) {
                // $data = ($item_list['data'][0]);

                $total_belum = 0;
                foreach ($data['online_status'] as  $online_status) {
                    $db = [];
                    foreach ($online_status as $tk => $vk) {
                        $va = $online_status[$tk] = Database::string_database($page, $fai, $vk);
                        $db['where'][] = ["$tk", "=", "'$va'"];
                    }
                    $db['np'] = true;
                    $db['utama'] = "inventaris__asset__list__detail";
                    $get_all = Database::database_coverter($page, $db, [], 'all');

                    if (!$get_all['num_rows']) {
                        $total_belum++;
                    }
                }

                if ($total_belum) {
                    $data['file'] = [];
                    $data['file']['id_drive'] = 3;
                    $data['file']['id_drive_folder'] = 100;
                    $data['file']['storage'] = 'External';
                    $data['file']['ref_database'] = 'inventaris__asset__list';
                    $data['file']['path'] = $data['thumbnail'];
                    $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                    $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');
                    $insert['foto_aset'] = " $last_id_foto ";
                    $insert['nama_barang'] = $data['item_name'];
                    $insert['jenis_barang'] = "Barang Jadi";
                    $insert['id_jenis_asset'] = "4";
                    $insert['jual_aset_barang'] = "Ya";
                    $insert['varian_barang'] = ($data['variations']) ? 1 : 2;
                    $insert['id_panel'] = -1;
                    $insert['asal_barang_dari'] = "Jubelio";
                    $insert['is_master'] = 1;
                    $insert['id_master'] = $data['item_group_id']; //id utama sarimbit master atau lainnya
                    // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; 
                    // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; //toko

                    // print_R($insert);
                    $db = [];
                    foreach ($insert as $tk => $vk) {
                        $va = $insert[$tk] = Database::string_database($page, $fai, $vk);
                        $db['where'][] = ["inventaris__asset__list.$tk", "=", "'$va'"];
                    }
                    $db['utama'] = "inventaris__asset__list";
                    $db['np'] = "inventaris__asset__list";
                    $get_all = Database::database_coverter($page, $db, [], 'all');
                    // print_R();
                    $total = 0;
                    $list = [];


                    if ($get_all['num_rows']) {
                        $last_id_utama = $get_all['row'][0]->primary_key;
                    } else {
                        $total++;
                        $list[] = "inventaris__asset__list-><BR> (" . $get_all['query'] . ")<BR>";
                        $last_id_utama = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__list');
                    }
                    foreach ($data['online_status'] as  $online_status) {
                        $db = [];
                        foreach ($online_status as $tk => $vk) {
                            $va = $online_status[$tk] = Database::string_database($page, $fai, $vk);
                            $db['where'][] = ["$tk", "=", "'$va'"];
                        }
                        $db['np'] = true;
                        $db['utama'] = "inventaris__asset__list__detail";
                        $get_all = Database::database_coverter($page, $db, [], 'all');

                        if (!$get_all['num_rows']) {

                            $online_status['id_inventaris__asset__list'] = $last_id_utama;

                            CRUDFunc::crud_insert($fai, $page, $online_status, [], 'inventaris__asset__list__detail');
                        }
                    }
                    if ($data['variants']) {
                        foreach ($data['variants'] as $varian) {
                            $id_tipe_varian = [];
                            $id_varian = [];
                            if ($varian['variation_values']) {


                                foreach ($varian['variation_values'] as $key => $variation_values) {

                                    DB::table('inventaris__master__tipe_varian');
                                    DB::whereRaw("nama_tipe='" . $variation_values['label'] . "'");
                                    $get_tipe = DB::get('all');
                                    if ($get_tipe['num_rows']) {
                                        $id_tipe_varian[$key] = $get_tipe['row'][0]->id;
                                    } else {
                                        $tipe_varian = [];
                                        $tipe_varian['nama_tipe'] = $variation_values['label'];
                                        $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian');

                                        DB::table('inventaris__master__tipe_varian');
                                        DB::whereRaw("nama_tipe='" . $variation_values['label'] . "'");
                                        $get_tipe = DB::get('all');
                                        $id_tipe_varian[$key] = $get_tipe['row'][0]->id;
                                    }
                                    DB::table('inventaris__master__tipe_varian__list');
                                    DB::whereRaw("id_inventaris__master__tipe_varian=" . $id_tipe_varian[$key]);
                                    DB::whereRaw("nama_list_tipe_varian='" . $variation_values['value'] . "'");
                                    $get_tipe = DB::get('all');
                                    if ($get_tipe['num_rows']) {
                                        $id_varian[$key] = $get_tipe['row'][0]->id;
                                    } else {
                                        $tipe_varian = [];
                                        $tipe_varian['id_inventaris__master__tipe_varian'] = $id_tipe_varian[$key];
                                        $tipe_varian['nama_list_tipe_varian'] = $variation_values['value'];
                                        $id_varian[$key] = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                                    }
                                }
                            }
                            // print_R($varian);
                            $data['file'] = [];
                            $data['file']['id_drive'] = 3;
                            $data['file']['id_drive_folder'] = 100;
                            $data['file']['storage'] = 'External';
                            $data['file']['ref_database'] = 'inventaris__asset__list__varian';
                            $data['file']['path'] = $varian['thumbnail'];
                            $data['file']['file_name_system'] = "Be3-" . date('Y-m-d His') . ".png";
                            $last_id_foto = CRUDFunc::crud_insert($fai, $page, $data['file'], [], 'drive__file');
                            $data_varian = [];
                            $data_varian['id_inventaris__asset__list'] = $last_id_utama;
                            $data_varian['foto_aset'] = "$last_id_foto";

                            $data_varian['id_tipe_varian_1'] = $id_tipe_varian[0] ?? -1;
                            $data_varian['id_varian_1'] = $id_varian[0] ?? -1;
                            $data_varian['id_tipe_varian_2'] = $id_tipe_varian[1] ?? -1;
                            $data_varian['id_varian_2'] = $id_varian[1] ?? -1;
                            $data_varian['id_tipe_varian_3'] = $id_tipe_varian[2] ?? -1;

                            $data_varian['id_varian_3'] = $id_varian[2] ?? -1;
                            $data_varian['barcode_varian'] = $varian['barcode'];
                            $data_varian['harga_pokok_penjualan_varian'] = $varian['sell_price'];
                            $data_varian['kode_varian'] = $varian['item_code'];
                            $data_varian['jubelio_item_id'] = $varian['item_id'];
                            $data_varian['jubelio_item_code'] = $varian['item_code'];
                            $data_varian['asal_from_data_varian'] = "Jubelio";
                            DB::table('inventaris__asset__list__varian');
                            foreach ($data_varian as $key_varian => $value_varian) {
                                if (!$value_varian) {
                                } else if (in_array($key_varian, ['asal_from_data_varian', "jubelio_item_code", 'kode_varian', 'foto_aset'])) {
                                    DB::whereRaw("$key_varian='$value_varian'");
                                } else
                                    DB::whereRaw("$key_varian=$value_varian");
                            }
                            $getAda = DB::get('all');
                            if (!$getAda['num_rows']) {
                                $last_id_varian = CRUDFunc::crud_insert($fai, $page, $data_varian, [], 'inventaris__asset__list__varian');
                            } else {
                                $last_id_varian = $getAda['row'][0]->id;

                                DB::update("inventaris__asset__list__varian", $data_varian, ["id=$last_id_varian"]);
                            }
                            $get_stok = $varian['available_qty'];

                            $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $last_id_utama, 'rekap_akhir', [], $last_id_varian);;
                            if ($get_system_stok['num_rows']) {
                                $get_system_stok = $get_system_stok['row'][0]->stok;
                            } else {
                                $get_system_stok = 0;
                            }
                            $detail = [];
                            $detail['id_asset'] = $last_id_utama;
                            $detail['id_asset_varian'] = $last_id_varian;
                            $detail['data_stok'] = (int) $get_system_stok;
                            $detail['data_real'] = (int) $get_stok;
                            $detail['selisih'] = (int) $get_stok - $get_system_stok;
                            $detail['id_erp__pos__stok_opname'] = $last_id;
                            //  print_R($detail);
                            if ($detail['selisih'])
                                CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                        }
                    }
                }
            }
        }

        $insert['asal_barang_dari'] = "Jubelio";

        echo '<table>
            <thead><tr>
                <th>No</th>
                <th>Nama</th>
                <th>Sugest</th>
                <th>Asset Sync</th></tr>
            </thead>
            <tbody>
           

        ';
        //FAILL UPDATE
        //Array ( [107105] => 32850 [107134] => [107135] => [107136] => [107137] => 33629 [107138] => 32185 [107139] => 31223 [107140] => [107141] => [107142] => [107143] => [107144] => 32099 [107145] => 35163 [107146] => 35084 [107147] => 32131 [107148] => [107149] => 33457 [107150] => [107151] => [107152] => [107153] => 34057 [107154] => [107155] => 34057 [107156] => 31320 [107157] => 31023 [107158] => [107159] => 32221 [107160] => [107161] => 32819 [107162] => 33417 [107163] => [107164] => [107165] => [107166] => [107167] => 31483 [107168] => [107169] => 32321 [107170] => [107171] => [107172] => 35009 [107173] => [107174] => 31055 [107175] => 32035 [107176] => [107177] => 31950 [107178] => [107179] => 34902 [107180] => 31418 [107181] => [107182] => 35164 [107183] => 36776 [107184] => 31157 [107185] => 35107 [107186] => [107187] => 31320 [107188] => [107189] => [107190] => [107191] => 32244 [107192] => 34978 [107193] => 33368 [107194] => [107195] => [107196] => 31815 [107197] => 33961 [107198] => 33961 [107199] => 34971 [107200] => [107201] => 34970 [107202] => 30989 [107203] => [107204] => [107205] => 31352 [107206] => 35083 [107207] => 31087 [107208] => [107209] => 31915 [107210] => 32003 [107211] => 33595 [107212] => 32256 [107213] => [107214] => [107215] => [107216] => 34057 [107217] => 34978 [107218] => 33595 [107219] => [107220] => 31191 [107221] => 32449 [107222] => [107223] => 34530 [107224] => 32186 [107225] => 31287 [107226] => [107227] => 32067 [107228] => [107229] => 31088 [107230] => 31121 [107231] => [107232] => 31849 [107233] => [107234] => 34057 [107235] => 31224 [107236] => [107237] => 31383 [107238] => 31450 [107239] => [107240] => [107241] => 33629 [107242] => [107243] => 33994 [107244] => 30990 [107245] => [107246] => 35009 [107247] => 36532 [107248] => [107249] => [107250] => 33457 [107251] => [107252] => 35220 [107253] => 32510 [107254] => [107255] => [107256] => [107257] => [107258] => 35197 [107259] => ) 
        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_barang" method="post">';
        $no = 0;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('DATA BARANG SHOPEE.xlsx');

        // Misal mau ambil sheet ke-2 (ingat, index mulai dari 0)
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil semua data ke array
        $data = $sheet->toArray();
        $detailFromSheet = [];


        foreach ($data as $row) {
            // foreach ($row as $cell) {
            //     echo $cell . "\t";
            // }
            $detailFromSheet['by_nama'][$row[1]]['sarimbit'] = $row[13];
            $detailFromSheet['by_nama'][$row[1]]['variasi'][$row[3]] = $row[12];
            $detailFromSheet['by_kode'][$row[0]]['sarimbit'] = $row[13];
            $detailFromSheet['by_kode'][$row[0]]['variasi'][$row[2]] = $row[12];
        }
        DB::table('inventaris__asset__list');
        DB::whereRaw("klasifikasi_produk != 'Per Barang'  ORDER BY nama_barang");
        $get_sarimbit = DB::get('all');
        $list_belum = [];
        DB::selectRaw('*, inventaris__asset__list.id as primary');
        DB::table('inventaris__asset__list');
        DB::whereRaw("asal_barang_dari='Jubelio'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        $get_asset = DB::get('all');
        foreach ($get_asset['row'] as $asset) {
            $no++;
            echo "<tr>
                <td>$no </td>
                <td>$asset->nama_barang </td>
                <td>" . ($detailFromSheet['by_kode'][$asset->channel_group_id]['sarimbit'] ?? '') . " </td>
                <td><select name='asset[$asset->primary]'>
                <option value=''>-PILIH-</option>
                ";
            foreach ($get_sarimbit['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id . '" ' . ($asset->id_barang_master == $sarimbit->id ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$asset->channel_group_id]['sarimbit'] ?? '') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
            echo "</select> </td>
            </tr>";
        }
        echo ' </tbody></table>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';

        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_barang_varian" method="post">';
        $no = 0;
        DB::selectRaw('inventaris__asset__list.*,inventaris__asset__list__varian.id as id_varian,inventaris__asset__list__varian.nama_varian,inventaris__asset__list.id as id_inventaris__asset__list,v1.nama_tipe as v1_nama_tipe,v2.nama_tipe as v2_nama_tipe,v3.nama_tipe as v3_nama_tipe,vl1.nama_list_tipe_varian as vl1_nama_list_tipe_varian,vl2.nama_list_tipe_varian as vl2_nama_list_tipe_varian,vl3.nama_list_tipe_varian as vl3_nama_list_tipe_varian,konek.nama_barang as nama_barang_konek,inventaris__asset__list__varian.id_asset_list_varian,channel_group_id,jubelio_item_code');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Jubelio'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=inventaris__asset__list__varian.id_tipe_varian_1", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=inventaris__asset__list__varian.id_varian_1", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=inventaris__asset__list__varian.id_tipe_varian_2", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=inventaris__asset__list__varian.id_varian_2", "left"); //id_varian_1
        DB::joinRaw("inventaris__master__tipe_varian v3 on v3.id=inventaris__asset__list__varian.id_tipe_varian_3", "left"); //id_tipe_varian_
        DB::joinRaw("inventaris__master__tipe_varian__list vl3 on vl3.id=inventaris__asset__list__varian.id_varian_3", "left"); //id_varian_1
        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
        $get_sarimbit = DB::get('all');
        echo '<form action="' . base_url() . 'index.php/FaiCommandTest/update_connect_varian" method="post">';
        echo '<table border=1>
            <thead><tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Varian</th>
                <th>Varian Values</th>
                <th>Konektifitas Asset</th>
                <th>Suggestion</th>
                <th>Asset Sync</th></tr>
            </thead>
            <tbody>
           

        ';
        // print_R($get_sarimbit);
        foreach ($get_sarimbit['row'] as $row) {
            $no++;
            echo "<tr>
            <td>$no </td>
            <td>$row->nama_barang </td>
            <td>$row->nama_varian </td>
            <td>$row->v1_nama_tipe:$row->vl1_nama_list_tipe_varian<Br>$row->v2_nama_tipe:$row->vl2_nama_list_tipe_varian<br>$row->v3_nama_tipe:$row->vl3_nama_list_tipe_varian </td>
            <td>$row->nama_barang_konek </td>
            <td>$row->channel_group_id - $row->jubelio_item_code<BR>" . ($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '') . " </td>
            <td><select name='varian[$row->id_varian]'>
            <option value=''>-PILIH-</option>
            ";
            // id_barang_master
            DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
            DB::table('inventaris__asset__list');
            DB::whereRaw("upper(inventaris__asset__list.nama_barang) like '%" . trim(strtoupper($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '-1')) . "%' ");

            DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
            $get_barang = DB::get('all');
            foreach ($get_barang['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id_asset . '" ' . ($row->id_asset_list_varian == $sarimbit->id_asset ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$row->channel_group_id]['variasi'][$row->jubelio_item_code] ?? '-1') ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
        }
        echo ' </tbody></table>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
        if ($production) {

            //konek sync api ethica semua yang udah konek
            DB::selectRaw('asset.*,jubelio_item_id');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Jubelio'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("inventaris__asset__list as asset on asset.id=inventaris__asset__list__varian.id_asset_list_varian", "left");
            $get_pruduk_synced = DB::get('all');
            $get_key = EthicaApi::get_key_v2("20240226230013939733", "25231b80-f006-11ef-ad5b-bc2411f62480",  0);
            DB::table('inventaris__asset__tanah__gudang');
            DB::whereRaw("nama_gudang='Gudang Ethica Api'");
            $get_tipe = DB::get('all');
            if ($get_tipe['num_rows']) {
                $id_gudang_ethica = $get_tipe['row'][0]->id;
            } else {
                $tipe_varian = [];
                $tipe_varian['nama_gudang'] = "Gudang Ethica Api";
                CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

                DB::table('inventaris__asset__tanah__gudang');
                DB::whereRaw("nama_gudang='Gudang Ethica Api'");
                $get_tipe = DB::get('all');
                $id_gudang_ethica = $get_tipe['row'][0]->id;
            }
            DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
            DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang_ethica");
            DB::whereRaw("nama_ruang_simpan='Rak Ethica Api'");
            $get_tipe = DB::get('all');
            if ($get_tipe['num_rows']) {
                $id_ruang_simpan_ethica = $get_tipe['row'][0]->id;
            } else {
                $tipe_varian = [];
                $tipe_varian['nama_ruang_simpan'] = "Rak Ethica Api";
                $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang_ethica;
                $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

                DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
                DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang_ethica");
                DB::whereRaw("nama_ruang_simpan='Rak Ethica Api'");
                $get_tipe = DB::get('all');
                $id_ruang_simpan_ethica = $get_tipe['row'][0]->id;
            }
            $page['section'] = "page";
            $page['crud']['insert_number_code'] = ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_stok_opname')['crud']['insert_number_code'];
            $return = CRUDFunc::insert_number_code_nomor($fai, $page, "nomor_stok_opname", "");
            $so['tanggal_stok_opname'] = date('Y-m-d');
            $so['nomor_stok_opname'] = $return['valueinput'];
            $so['id_gudang_stok_opname'] = $id_gudang_ethica;
            $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan_ethica;
            $last_id = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
            foreach ($get_pruduk_synced['row'] as $row) {


                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.ethica.id/v2/master_barang/loaddata_eksternal',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'key: cfa687438966b5bb8d7c90899dbeebc',
                        'order_by: tgl_realease desc',
                        'customer_seq: 8190',
                        'offset: 0',
                        'search: ' . $row->nama_barang,
                        'Cookie: PHPSESSID=d8hpfp0pfc6ukkd45fpnggmacl'
                    ),
                ));

                $response = curl_exec($curl);

                @curl_close($curl);
                $json =  json_decode($response, 1);
                // print_R($json);
                $detail_barang_api = $json['data'][0]['list_warna'][0]['list_ukuran'][0];

                if (isset($detail_barang_api['stok'])) {


                    $get_stok = $detail_barang_api['stok'];

                    $get_system_stok = ErpPosApp::get_stok($page, 0, $id_gudang_ethica, $id_ruang_simpan_ethica, $row->id, 'rekap_akhir', [], null);;
                    if ($get_system_stok['num_rows']) {
                        $get_system_stok = $get_system_stok['row'][0]->stok;
                    } else {
                        $get_system_stok = 0;
                    }
                    $detail = [];
                    $detail['id_asset'] = $row->id;
                    $detail['id_asset_varian'] = null;
                    $detail['data_stok'] = (int) $get_system_stok;
                    $detail['data_real'] = (int) $get_stok;
                    $detail['selisih'] = (int) $get_stok - $get_system_stok;
                    $detail['id_erp__pos__stok_opname'] = $last_id;
                    //  print_R($detail);
                    if ($detail['selisih'])
                        CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                }
            }

            $page['crud']['insert_number_code'] = ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_stok_opname')['crud']['insert_number_code'];
            $return = CRUDFunc::insert_number_code_nomor($fai, $page, "nomor_stok_opname", "");

            $so['tanggal_stok_opname'] = date('Y-m-d');
            $so['nomor_stok_opname'] = $return['valueinput'];
            $so['id_gudang_stok_opname'] = $id_gudang;
            $so['id_ruang_simpan_stok_opname'] = $id_ruang_simpan;
            $last_id = CRUDFunc::crud_insert($fai, $page, $so, [], 'erp__pos__stok_opname');
            $adj_jub["item_adj_id"] = 0;
            $adj_jub["item_adj_no"] = $return['valueinput'];
            $adj_jub["transaction_date"] = date('Y-m-d') . "T" . date('H:i:s') . "Z";
            $adj_jub["note"] = "Penyesuaian stok produk baru";
            $adj_jub["location_id"] = -1;
            $adj_jub["is_opening_balance"] = false;
            $adj_jub["items"] = [];
            // {
            //     "item_adj_id": 0,
            //     "item_adj_no": "ADJ-20250417-004",
            //     "transaction_date": "2025-04-17T10:00:00Z",
            //     "note": "Penyesuaian stok produk baru: {BUY 1 GET 1} Ethica Sarimbit Royal 43 Morning Velvet",
            //     "location_id": -1,
            //     "is_opening_balance": false,
            //     "items": [
            //         {
            //         "amount": 839700,
            //         "account_id": 4,
            //         "unit": "PCS",
            //         "cost": 279900,
            //         "qty_in_base": 2,
            //         "item_adj_detail_id": 0,
            //         "item_id": 4211,
            //         "description": "{BUY 1 GET 1} (KOKO, 4XL)",
            //         "serial_no": "",
            //         "batch_no": null,
            //         "bin_id":1,
            //         "original_item_adj_detail_id": 0,
            //         "location_id": -1,
            //         "expired_date": null
            //         }

            //     ]
            //     }
            //analisis stok produk 
            $updated_stok = [];
            foreach ($get_pruduk_synced['row'] as $row) {
                $get_system_stok_ethica = ErpPosApp::get_stok($page, 0, $id_gudang_ethica, $id_ruang_simpan_ethica, $row->id, 'rekap_akhir', [], null);;
                // print_R($get_system_stok_ethica);
                if ($get_system_stok_ethica['num_rows']) {
                    $get_system_stok_ethica = $get_system_stok_ethica['row'][0]->stok;
                } else {
                    $get_system_stok_ethica = 0;
                }
                $get_system_stok_jubelio = ErpPosApp::get_stok($page, 0, $id_gudang, $id_ruang_simpan, $row->id, 'rekap_akhir', [], null);;
                if ($get_system_stok_jubelio['num_rows']) {
                    $get_system_stok_jubelio = $get_system_stok_jubelio['row'][0]->stok;
                } else {
                    $get_system_stok_jubelio = 0;
                }
                echo '<Br>';
                echo $row->nama_barang;
                echo '<br>ETHICA:' . $get_system_stok_ethica;
                echo '<br>Jubelio:' . $get_system_stok_jubelio;
                echo '<br>SELISIH:' . ($get_system_stok_ethica - $get_system_stok_jubelio);
                if ($get_system_stok_jubelio != $get_system_stok_ethica) {
                    $detail = [];
                    $detail['id_asset'] = $row->id;
                    $detail['id_asset_varian'] = null;
                    $detail['data_stok'] = (int) $get_system_stok;
                    $detail['data_real'] = (int) $get_stok;
                    $detail['selisih'] = (int) $get_stok - $get_system_stok;
                    $detail['id_erp__pos__stok_opname'] = $last_id;
                    $updated_stok[] = $detail;
                    $adj_jub["items"][] = [
                        "amount" => ($row->harga_pokok_penjualan * $get_system_stok_ethica ?? 0),
                        "account_id" => 4,
                        "unit" => "PCS",
                        "cost" => $row->harga_pokok_penjualan,
                        "qty_in_base" => $get_system_stok_ethica,
                        "item_adj_detail_id" => 0,
                        "item_id" => $row->jubelio_item_id,
                        "description" => "$row->nama_barang",
                        "serial_no" => "",
                        "batch_no" => null,
                        "bin_id" => 1,
                        "original_item_adj_detail_id" => 0,
                        "location_id" => -1,
                        "expired_date" => null
                    ];
                }
            }
            print_R($adj_jub);
            // upload stok produk jubelio

            if ($production) {
                $stok_update = JubelioApi::stok_adjustment($get_token, json_encode($adj_jub), $is_response = 1);
                print_R($stok_update);
                if (($stok_update['status'] ?? 'not_ok') == 'ok') {
                    foreach ($updated_stok as $stok) {
                        CRUDFunc::crud_insert($fai, $page, $stok, [], 'erp__pos__stok_opname__detail');
                    }
                    echo 'SELESAI';
                }
            }
        }
        //cari yang belum produk sarimbit(baik PO maupun non PO)
    }
    public function split_bundles2()
    {
        $fai = new MainFaiFramework();

        $ci = &get_instance();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $ci->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }
        $page['domain'] = $domain;
        $page['load']['domain'] = $domain;


        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $classFilePath = BASEPATH . '../FaiFramework/Structure/Content_class/BundleContent2.php';
        if (!file_exists($classFilePath)) {
            echo "❌ File tidak ditemukan: $classFilePath\n";
            return;
        }

        $originalCode = file_get_contents($classFilePath);

        // Ambil nama class original
        preg_match('/class\s+(\w+)/', $originalCode, $classMatch);
        $originalClassName = $classMatch[1] ?? 'UnknownClass';
        preg_match_all('/public\s+static\s+function\s+(\w+)\s*\((.*?)\)\s*\{(.*?)return\s+\$return;/s', $originalCode, $matches, PREG_SET_ORDER);

        $generatedFunctions = [];
        $bundleContent = new BundleContent2();
        foreach ($matches as $match) {
            echo  $functionName = $match[1];
            if (!in_array($functionName, ["router", 'load_json', 'system_produk', 'malefashion_home_diskon', 'detailing_data', 'ashion_home_profil', 'ashion_contact_us', 'ashion_home_produk_group_klasifikasi', 'name_webapps', 'base_url', 'beegrit_ecommerce_varian', 'beegrit_habistboardcontent_template', 'beegrit_habistboardlist_template', 'beegrit_ecommerce_cart_option_template', 'beegrit_ecommerce_detail_spesifikasi_template', 'codepen_bookmark_appview_transition_card_apps_template'])) {

                $functionParams = $match[2]; // parameter function
                $functionBody = $match[3];   // isi function

                $folderPath = dirname($classFilePath) . "test/$functionName";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $content = $bundleContent->$functionName($page);
                foreach ($content as $key => $value) {
                    echo $newFilePath = "$folderPath/$functionName.$key.php";
                    $value = str_replace("http://localhost/FrameworkServer/FaiFramework/Pages/_template/", "<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>", $value);
                    $value = str_replace('content="hibe3"', "<BE3-META-KEYWORD></BE3-META-KEYWORD>", $value);
                    $value = str_replace('content="Hibe3"', "<BE3-META-TITLE></BE3-META-TITLE>", $value);
                    $value = str_replace('content="Hibe3 Adalah"', "<BE3-META-DESC></BE3-META-DESC>", $value);
                    $value = str_replace('id="load_apps" value=""', 'id="load_apps" value="<BE3-LOAD-APPS></BE3-LOAD-APPS>"', $value);
                    $value = str_replace('id="load_menu" value=""', 'id="load_menu" value="<BE3-LOAD-MENU></BE3-LOAD-MENU>"', $value);
                    $value = str_replace('id="load_nav" value=""', 'id="load_nav" value="<BE3-LOAD-NAV></BE3-LOAD-NAV>"', $value);
                    $value = str_replace('id="load_type" value=""', 'id="load_type" value="<BE3-LOAD-TYPE></BE3-LOAD-TYPE>"', $value);
                    $value = str_replace('id="load_type_temp" value=""', 'id="load_type_temp" value="<BE3-LOAD-TYPE_TEMP></BE3-LOAD-TYPE_TEMP>"', $value);
                    $value = str_replace('id="load_id_temp" value=""', 'id="load_id_temp" value="<BE3-LOAD-ID_TEMP></BE3-LOAD-ID_TEMP>"', $value);
                    $value = str_replace('id="load_id" value=""', 'id="load_id" value="<BE3-LOAD-ID></BE3-LOAD-ID>"', $value);
                    $value = str_replace('id="load_domain" value="hibe3.com"', 'id="load_domain" value="<BE3-LOAD-DOMAIN></BE3-LOAD-DOMAIN>"', $value);
                    $value = str_replace('id="load_page_view" value=""', 'id="load_page_view" value="<BE3-LOAD-PAGE-VIEW></BE3-LOAD-PAGE-VIEW>"', $value);


                    file_put_contents($newFilePath, $value);
                }
            }
        }
    }
    public function split_bundles()
    {
        function refactorClassToFilesAndNewClass($classFilePath, $newClassName)
        {
            if (!file_exists($classFilePath)) {
                echo "❌ File tidak ditemukan: $classFilePath\n";
                return;
            }

            $originalCode = file_get_contents($classFilePath);

            // Ambil nama class original
            preg_match('/class\s+(\w+)/', $originalCode, $classMatch);
            $originalClassName = $classMatch[1] ?? 'UnknownClass';

            // Ambil semua static function dengan $return["html"], dll
            //     preg_match_all('/public\s+static\s+function\s+(\w+)\s*\(\)\s*\{(.*?)return\s+\$return;/s', $originalCode, $matches, PREG_SET_ORDER);

            //     $generatedFunctions = [];

            //     foreach ($matches as $match) {
            //         $functionName = $match[1];
            //         $functionBody = $match[2];

            //         $folderPath = dirname($classFilePath) . "/$functionName";
            //         if (!file_exists($folderPath)) {
            //             mkdir($folderPath, 0777, true);
            //         }

            //         preg_match('/\$return\["css"\]\s*=\s*(.*?);/s', $functionBody, $cssMatch);
            //         preg_match('/\$return\["js"\]\s*=\s*(.*?);/s', $functionBody, $jsMatch);
            //         preg_match('/\$return\["html"\]\s*=\s*(.*?);/s', $functionBody, $htmlMatch);

            //         $css = stripcslashes(trim(trim($cssMatch[1] ?? '', "'\";")));
            //         $js = stripcslashes(trim(trim($jsMatch[1] ?? '', "'\";")));
            //         $html = stripcslashes(trim(trim($htmlMatch[1] ?? '', "'\";")));

            //         file_put_contents("$folderPath/{$functionName}.css.php", $css);
            //         file_put_contents("$folderPath/{$functionName}.js.php", $js);
            //         file_put_contents("$folderPath/{$functionName}.html.php", $html);

            //         $generatedFunctions[] = <<<PHP
            //     public static function $functionName()
            //     {
            //         \$return["css"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.css.php");
            //         \$return["js"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.js.php");
            //         \$return["html"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.html.php");
            //         return \$return;
            //     }

            // PHP;
            //     }
            //     preg_match_all('/public\s+static\s+function\s+(\w+)\s*\(\)\s*\{(.*?)return\s+\$return;/s', $originalCode, $matches, PREG_SET_ORDER);

            //     $generatedFunctions = [];

            //     foreach ($matches as $match) {
            //         $functionName = $match[1];
            //         $functionBody = $match[2];

            //         $folderPath = dirname($classFilePath) . "/$functionName";
            //         if (!file_exists($folderPath)) {
            //             mkdir($folderPath, 0777, true);
            //         }

            //         preg_match('/\$return\["css"\]\s*=\s*(.*?);/s', $functionBody, $cssMatch);
            //         preg_match('/\$return\["js"\]\s*=\s*(.*?);/s', $functionBody, $jsMatch);
            //         preg_match('/\$return\["html"\]\s*=\s*(.*?);/s', $functionBody, $htmlMatch);

            //         $css = stripcslashes(trim(trim($cssMatch[1] ?? '', "'\";")));
            //         $js = stripcslashes(trim(trim($jsMatch[1] ?? '', "'\";")));
            //         $html = stripcslashes(trim(trim($htmlMatch[1] ?? '', "'\";")));

            //         file_put_contents("$folderPath/{$functionName}.css.php", $css);
            //         file_put_contents("$folderPath/{$functionName}.js.php", $js);
            //         file_put_contents("$folderPath/{$functionName}.html.php", $html);

            //         $generatedFunctions[] = <<<PHP
            //     public static function $functionName()
            //     {
            //         \$return["css"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.css.php");
            //         \$return["js"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.js.php");
            //         \$return["html"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.html.php");
            //         return \$return;
            //     }

            // PHP;
            //     }
            //     preg_match_all('/public\s+static\s+function\s+(\w+)\s*\((.*?)\)\s*\{(.*?)return\s+\$return;/s', $originalCode, $matches, PREG_SET_ORDER);

            //     $generatedFunctions = [];

            //     foreach ($matches as $match) {
            //         $functionName = $match[1];
            //         $functionParams = $match[2]; // Simpan kalau perlu nanti
            //         $functionBody = $match[3];

            //         $folderPath = dirname($classFilePath) . "/$functionName";
            //         if (!file_exists($folderPath)) {
            //             mkdir($folderPath, 0777, true);
            //         }

            //         preg_match('/\$return\["css"\]\s*=\s*(.*?);/s', $functionBody, $cssMatch);
            //         preg_match('/\$return\["js"\]\s*=\s*(.*?);/s', $functionBody, $jsMatch);
            //         preg_match('/\$return\["html"\]\s*=\s*(.*?);/s', $functionBody, $htmlMatch);

            //         $css = stripcslashes(trim(trim($cssMatch[1] ?? '', "'\";")));
            //         $js = stripcslashes(trim(trim($jsMatch[1] ?? '', "'\";")));
            //         $html = stripcslashes(trim(trim($htmlMatch[1] ?? '', "'\";")));

            //         file_put_contents("$folderPath/{$functionName}.css.php", $css);
            //         file_put_contents("$folderPath/{$functionName}.js.php", $js);
            //         file_put_contents("$folderPath/{$functionName}.html.php", $html);

            //         $generatedFunctions[] = <<<PHP
            //         public static function $functionName($functionParams)
            //         {
            //             \$base = __DIR__ . "/$functionName/";
            //             \$return["css"] = file_exists(\$base . "{$functionName}.css.php") ? file_get_contents(\$base . "{$functionName}.css.php") : "";
            //             \$return["js"] = file_exists(\$base . "{$functionName}.js.php") ? file_get_contents(\$base . "{$functionName}.js.php") : "";
            //             \$return["html"] = file_exists(\$base . "{$functionName}.html.php") ? file_get_contents(\$base . "{$functionName}.html.php") : "";
            //             return \$return;
            //         }

            //     PHP;
            //     }
            preg_match_all('/public\s+static\s+function\s+(\w+)\s*\((.*?)\)\s*\{(.*?)return\s+\$return;/s', $originalCode, $matches, PREG_SET_ORDER);

            $generatedFunctions = [];

            foreach ($matches as $match) {
                $functionName = $match[1];
                $functionParams = $match[2]; // parameter function
                $functionBody = $match[3];   // isi function

                $folderPath = dirname($classFilePath) . "/$functionName";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                // Tangkap semua $return["key"] = value;
                // preg_match_all('/\$return\[\s*[\'"](.+?)[\'"]\s*\]\s*=\s*(.*?);/s', $functionBody, $returnMatches, PREG_SET_ORDER);

                // $fileGetContentsLines = [];

                // foreach ($returnMatches as $retMatch) {
                //     $key = $retMatch[1]; // nama key, misal: css, js, html, etc
                //     $value = stripcslashes(trim(trim($retMatch[2], "'\";")));

                //     $safeFilename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $key);
                //     file_put_contents("$folderPath/{$functionName}.{$safeFilename}.php", $value);

                //     $fileGetContentsLines[] = "\$return[\"$key\"] = file_exists(\$base . \"$safeFilename.php\") ? file_get_contents(\$base . \"{$functionName}.$safeFilename.php\") : \"\";";
                // }
                preg_match_all('/\$return\[\s*[\'"](.+?)[\'"]\s*\]\s*=\s*(.*?);/s', $functionBody, $returnMatches, PREG_SET_ORDER);

                $fileGetContentsLines = [];

                foreach ($returnMatches as $retMatch) {
                    $key = $retMatch[1];
                    $raw = trim($retMatch[2]);

                    // Bersihkan titik koma di akhir kalau ada
                    $raw = rtrim($raw, ';');

                    // Coba eval kalau literal string
                    if ((str_starts_with($raw, "'") && str_ends_with($raw, "'")) ||
                        (str_starts_with($raw, '"') && str_ends_with($raw, '"'))
                    ) {
                        try {
                            $value = $raw;
                        } catch (\Throwable $e) {
                            $value = '';
                        }
                    } else {
                        // Non-string, simpan komentar placeholder
                        $value = " $raw ";
                    }

                    $safeFilename = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $key);
                    file_put_contents("$folderPath/{$functionName}.{$safeFilename}.php", $value);

                    $fileGetContentsLines[] = "\$return[\"$key\"] = file_exists(\$base . \"{$functionName}.$safeFilename.php\") ? file_get_contents(\$base . \"{$functionName}.$safeFilename.php\") : \"\";";
                }

                $fileGetContentsBlock = implode("\n        ", $fileGetContentsLines);

                $generatedFunctions[] = <<<PHP
            public static function $functionName($functionParams)
            {
                \$base = __DIR__ . "/$functionName/";
                $fileGetContentsBlock
                return \$return;
            }
        
        PHP;
            }

            // Bangun class baru
            $newClassCode = '
        <?php
        
        class $newClassName
        {
        ' . implode("\n    ", $generatedFunctions) . '
        }';

            $newClassFilePath = "{$newClassName}.php";
            file_put_contents($newClassFilePath, $newClassCode);

            echo "✅ Class baru berhasil dibuat: $newClassFilePath\n";
        }

        refactorClassToFilesAndNewClass(BASEPATH . '../FaiFramework/Structure/Content_class/BundleContent2.php', 'BundleContent5');
    }

    public function website__template__file__template()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);

        $folderPath = BASEPATH . '../FaiFramework/Pages/_template'; // Ganti dengan path ke folder kamu
        $templateContent = '';
        function nama_template($nama, $template)
        {
            return str_replace([' ', '<', '>', '.php', '-', '.', '/', $template . '_' . $template . "_"], ['_', '_', '_', '', '_', '_', '_', $template . "_"], strtolower(trim($template . '_' . $nama)));
        }

        function get_file_dir($path, $folder, $sub = "", $type = "template")
        {
            $files_folder = scandir($path);

            foreach ($files_folder as $file) {

                if (is_dir($path . '/' . $file) and !in_array($file, [".", "..", "dist", 'assets', "_utama"])) {
                    get_file_dir($path . '/' . $file, $folder, $file . '/', $type);
                } else
                    if (substr($file, -strlen('.template.php')) === '.template.php') {

                    if ($type == 'template') {

                        echo '
                        $set_type = "' . $sub . str_replace('.php', '', $file) . '";
                        if ($type == -1 or $type == $set_type) {
                            $template[$set_type]["content"] = Bundlecontent::' . nama_template($sub . $file, $folder) . '($page);
                            ';
                    } else if ($type == 'bundles') {
                        if ($sub) {

                            echo '
                            public static function ' . nama_template($sub . $file, $folder) . '(){';
                            echo ' 
                            
                            $return["css"] = "";
                            $return["js"] = "";
                            $return["html"] = `' . str_replace(array('&#039;', "{HTTPS}", "{HTTP}"), array("'", "https", "http"), html_entity_decode(htmlspecialchars_decode(file_get_contents($path . '/' . $file)))) . '`;
                            return $return;';
                        }
                    }
                    if ($sub)
                        echo '
             }
            ';
                }
            }
        }
        $files = scandir($folderPath);
        foreach ($files as $folder) {
            if (is_dir($folderPath . '/' . $folder) and !in_array($folder, [".", "..", "dist", 'assets', "_utama"])) {


                echo '
        return $template;
        }



       public static function ' . $folder . '(){';
                get_file_dir($folderPath . '/' . $folder, $folder);
            }
        }
        echo '<br>';
        echo 'BUndles Content';
        echo '<br>
        
        
        
        
        ';
        foreach ($files as $folder) {
            if (is_dir($folderPath . '/' . $folder) and !in_array($folder, [".", "..", "dist", 'assets', "_utama"])) {


                get_file_dir($folderPath . '/' . $folder, $folder, "", "bundles");
            }
        }
        die;


        echo '<br>';
        echo 'BUndles Content';
        echo '<br>';
        foreach ($get['row'] as $get2) {
            //  print_r($get2);
            echo '}
             public static function ' . nama($get2->nama_file, $get2->nama_template) . '(){';
            echo ' 
                //primary_key = ' . $get2->primary_key . ';
                $return["css"] = "";
                $return["js"] = "";
                $return["html"] = `' . str_replace(array('&#039;', "{HTTPS}", "{HTTP}"), array("'", "https", "http"), html_entity_decode(htmlspecialchars_decode($get2->kontent_file))) . '`;
                return $return;';
        }
    }
    public function website__template__file()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);

        //list_user_in_board -> untuk di dalam

        // $panel = FaiCommandTest::get_list_panel();
        // $list_id = $panel['im_id_organisasi'];
        $list_user = [];
        DB::queryRaw($page, "select *,website__template__file.id as primary_key from website__template__file LEFT JOIN  website__template__list on website__template__file.id_template = website__template__list.id order by website__template__file.id_template");
        $get = DB::get('all');
        $temp = "";
        function nama($nama, $template)
        {
            return str_replace([' ', '<', '>', $template . '_' . $template . "_"], ['_', '_', '_', $template . "_"], strtolower(trim($template . '_' . $nama)));
        }
        // print_R($get);
        foreach ($get['row'] as $get2) {
            if ($temp != $get2->id_template) {
                $temp = $get2->id_template;
                echo '
                 return $template;
                 }



                public static function ' . $get2->nama_template . '(){';
            }
            echo '
             $set_type = "' . $get2->nama_file . '";
            if ($type == -1 or $type == $set_type) {
                $template[$set_type]["content"] = Bundlecontent::' . nama($get2->nama_file, $get2->nama_template) . '($page);
              ';
            DB::queryRaw($page, "select *,website__template__file__tag.id as primary_key from website__template__file__tag where  id_website__template__file=$get2->primary_key");
            $get3 = DB::get('all');
            if ($get3['num_rows']) {
                foreach ($get3['row'] as $get4) {
                    echo '
                    $template[$set_type]["array"][] = ["' . $get4->tag . '", "", ""];';
                }
            }
            echo '
             }
            ';
        }
        echo '
        
        
        
        
        ';
        echo '<br>';
        echo 'BUndles Content';
        echo '<br>';
        foreach ($get['row'] as $get2) {
            //  print_r($get2);
            echo '}
             public static function ' . nama($get2->nama_file, $get2->nama_template) . '(){';
            echo ' 
                //primary_key = ' . $get2->primary_key . ';
                $return["css"] = "";
                $return["js"] = "";
                $return["html"] = `' . str_replace(array('&#039;', "{HTTPS}", "{HTTP}"), array("'", "https", "http"), html_entity_decode(htmlspecialchars_decode($get2->kontent_file))) . '`;
                return $return;';
        }
    }
    public static function change_desimal_and_auto2()
    {
        $servername = "localhost"; // Ganti dengan server database Anda
        $username = CONECTION_USER; // Ganti dengan username database Anda
        echo $password = CONECTION_PASSWORD; // Ganti dengan password database Anda
        $dbname = CONECTION_NAME_DATABASE; // Ganti dengan nama database Anda

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil daftar semua tabel dalam database
        $result = $conn->query("SHOW TABLES");

        while ($row = $result->fetch_array()) {
            $table = $row[0];

            // Update nilai default active menjadi 1
            $conn->query("ALTER TABLE `$table` CHANGE `active` `active` TINYINT(1) DEFAULT '1'");

            // Update semua nilai privilage menjadi 'Private Website'
            $conn->query("ALTER TABLE `$table` CHANGE `privilege` `privilege` VARCHAR(255) DEFAULT 'Private Website'");
            // echo "ALTER TABLE `$table` CHANGE `privilage` `privilege` VARCHAR(255) DEFAULT 'Private Website'";


            // Ubah tipe data create_by, update_by, delete_by menjadi VARCHAR(100)
            $conn->query("ALTER TABLE `$table` CHANGE `create_by` `create_by` VARCHAR(100)");
            $conn->query("ALTER TABLE `$table` CHANGE `update_by` `update_by` VARCHAR(100)");
            $conn->query("ALTER TABLE `$table` CHANGE `delete_by` `delete_by` VARCHAR(100)");

            // Cek apakah ada kolom id_apps_user di tabel ini
            $checkColumn = $conn->query("SHOW COLUMNS FROM `$table` LIKE 'id_apps_user'");
            if ($checkColumn->num_rows > 0) {
                $conn->query("ALTER TABLE `$table` CHANGE `id_apps_user` `id_apps_user` VARCHAR(100)");
            }
        }

        echo "Update database selesai.";

        $conn->close();;
    }
    public static function change_desimal_and_auto()
    {
        $servername = "localhost"; // Ganti dengan server database Anda
        $username = CONECTION_USER; // Ganti dengan username database Anda
        $password = CONECTION_PASSWORD; // Ganti dengan password database Anda
        $dbname = CONECTION_NAME_DATABASE; // Ganti dengan nama database Anda

        // Koneksi ke database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ambil semua tabel yang ada di database
        $sql = "SHOW TABLES";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop melalui setiap tabel
            while ($row = $result->fetch_assoc()) {
                $table = $row["Tables_in_$dbname"]; // Nama tabel

                // Periksa apakah kolom 'id' sudah ada di tabel
                $checkColumnSql = "SHOW COLUMNS FROM `$table` LIKE 'id'";
                $checkColumnResult = $conn->query($checkColumnSql);

                if ($checkColumnResult->num_rows == 0) {
                    // Jika kolom 'id' tidak ada, tambahkan kolom 'id' dengan auto increment
                    $alterTableSql = "ALTER TABLE `$table` ADD COLUMN `id` INT(11) AUTO_INCREMENT PRIMARY KEY";
                    if ($conn->query($alterTableSql) === TRUE) {
                        echo "Kolom 'id' berhasil ditambahkan ke tabel `$table`.\n";
                    } else {
                        echo "Error adding 'id' to table `$table`: " . $conn->error . "\n";
                    }
                } else {
                    echo "Kolom 'id' sudah ada di tabel `$table`.\n";
                }

                // Cek tipe data setiap kolom dan ubah DECIMAL menjadi INT
                $showColumnsSql = "SHOW COLUMNS FROM `$table`";
                $columnsResult = $conn->query($showColumnsSql);

                if ($columnsResult->num_rows > 0) {
                    while ($column = $columnsResult->fetch_assoc()) {
                        // Jika tipe kolom adalah DECIMAL, ubah menjadi INT
                        if (stripos($column['Type'], 'decimal') !== false) {
                            $columnName = $column['Field'];
                            $alterTypeSql = "ALTER TABLE `$table` MODIFY COLUMN `$columnName` INT(11)";
                            if ($conn->query($alterTypeSql) === TRUE) {
                                echo "Kolom `$columnName` di tabel `$table` berhasil diubah dari DECIMAL ke INT(11).\n";
                            } else {
                                echo "Error changing type of `$columnName` in table `$table`: " . $conn->error . "\n";
                            }
                        }
                    }
                }
            }
        } else {
            echo "Tidak ada tabel ditemukan.\n";
        }

        $conn->close();
        die;
    }
    public function set_role_menu_in_function()
    {
        $fai = new MainFaiFramework();

        //print_r($page);
        $page['app_framework'] = 'laravel';
        $page['database_provider'] = 'postgres';
        $page['database_name'] = 'drrina';

        $page['app_framework'] = APP_FRAMEWORK;

        $page['app_framework'] = 'laravel';
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['page']['database_provider'] =  "mysql";
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        //
        $apps = $fai->Apps('Web', 'menu2');
        echo '<pre>';
        print_R($apps);

        echo '<pre>';
        // echo $array[$i][0];
        // echo '<br>';
        // DB::table("web__list_apps_menu");
        // DB::where("id_apps");
        $page['load_section'] = 'page';
        $collect =     FaiCommandTest::menufunction($page, $apps, 70, 0, "Admin");
        print_R($collect);

        $id_web__list_apps_board__role__akses = "104";
        for ($m = 0; $m < count($collect); $m++) {
            $sqli = [];
            $sqli['id_web__list_apps_board__role__akses'] = $id_web__list_apps_board__role__akses;
            $sqli['id_menu'] = $collect[$m];
            $db = [];
            $db['utama'] = "web__list_apps_board__role__akses__menu";
            foreach ($sqli as $key => $value) {
                $db['where'][] = ["$key", "=", $value];
            }
            $db['np'] = true;
            $get = Database::database_coverter($page, $db, array(), 'all');
            echo  print_R($get);;


            if (!$get['num_rows']) {

                $sqli['akses_menu'] = 1;
                $sqli['tambah'] = 1;
                $sqli['edit'] = 1;
                $sqli['hapus'] = 1;

                DB::insert("web__list_apps_board__role__akses__menu", $sqli);
            }
        }
    }
    public function view_layout_to_database()
    {

        $fai = new MainFaiFramework();
        $page = $fai->Apps("Ecommerce", "cart");
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        echo '<pre>';

        for ($i = 0; $i < count($page['view_layout']); $i++) {
            if ($page['view_layout'][$i][0] == "website") {
                $website = ($page['view_layout'][$i][2]['content']);
                for ($j = 0; $j < count($website); $j++) {
                    $array = $website[$j];

                    $website[$j] = FaiCommandTest::get_array_website_view_layout_to_database($page, $fai, $array,  0);
                }
                print_r($website);
            }
        }
    }
    public static function get_array_website_view_layout_to_database($page, $fai, $array, $id_website = 0, $return = 'array')
    {
        $id_database_refer = null;
        if (isset($array['database_refer'])) {
            if (($array['database_refer'])) {
                if ($array['database_refer'] == -1) {


                    $db =  $array['database'];
                    unset($array['database']);
                } else
                    $db =  $page['config']['database'][$array['database_refer']];
                $nama = $sql_db['name_database'] = "Ecommerce > " . $array['database_refer'] . ' ' . (isset($array['tag']) ? $array['tag'] : '');
                DB::queryRaw($page, "select * from website__bundles__database where name_database='" . $nama . "'");
                $get = DB::get('all');
                unset($sql_db['db_utama']);
                if ($get['num_rows']) {
                    $id_database_refer = $get['row'][0]->id;
                } else {
                    $sql_db['db_utama'] = "";
                    $sql_db['db_primary_key'] = "";
                    $sql_db['db_limit'] = null;
                    $sql_db['non_add_select'] = "";
                    $sql_db['min_1'] = "";
                    $sql_db['join_raw'] = "";
                    if (isset($db['utama'])) {
                        $sql_db['db_utama'] = $db['utama'];
                    }
                    if (isset($db['primary_key'])) {
                        $sql_db['db_primary_key'] = (int)$db['primary_key'];
                    }
                    if (isset($db['limit']) and $db['limit']) {
                        $sql_db['db_limit'] = (int) $db['limit'];
                    }
                    if (isset($db['non_add_select'])) {
                        $sql_db['non_add_select'] = $db['non_add_select'];
                    }
                    if ($array['database_refer'] == -1) {
                        $sql_db['min_1'] = 1;
                    }
                    if (isset($db['join_raw'])) {
                        $sql_db['join_raw'] = $db['join_raw'];
                    }
                    print_r($sql_db);
                    $return =  CRUDFunc::crud_save($fai, $page, $sql_db, array(), array(), "website__bundles__database", array());
                    $id_database_refer = $return['last_insert_id'];

                    if (isset($db['where'])) {
                        for ($w = 0; $w < count($db['where']); $w++) {
                            $sqlwhere['row_database'] = $db['where'][$w][0];
                            $sqlwhere['operan'] = $db['where'][$w][1];
                            $sqlwhere['value'] = $db['where'][$w][2];
                            $sqlwhere['id_website__bundles__database'] = $id_database_refer;
                            CRUDFunc::crud_save($fai, $page, $sqlwhere, array(), array(), "website__bundles__database__where", array());
                        }
                    }
                    unset($sqlwhere);
                    if (isset($db['select'])) {
                        for ($w = 0; $w < count($db['select']); $w++) {
                            $sqlwhere['row_database'] = $db['select'][$w];

                            $sqlwhere['id_website__bundles__database'] = $id_database_refer;
                            CRUDFunc::crud_save($fai, $page, $sqlwhere, array(), array(), "website__bundles__database__select", array());
                        }
                    }
                    unset($sqlwhere);
                    if (isset($db['where_get_array'])) {

                        for ($w = 0; $w < count($db['where_get_array']); $w++) {
                            $sqlwhere['row'] = $db['where_get_array'][$w]["row"];
                            $sqlwhere['array_row'] = $db['where_get_array'][$w]['array_row'];
                            $sqlwhere['get_row'] = $db['where_get_array'][$w]['get_row'];

                            $sqlwhere['id_website__bundles__database'] = $id_database_refer;
                            CRUDFunc::crud_save($fai, $page, $sqlwhere, array(), array(), "website__bundles__database__where_get_array", array());
                        }
                    }
                    unset($sqlwhere);
                    if (isset($db['join'])) {

                        for ($w = 0; $w < count($db['join']); $w++) {
                            $sqlwhere['database'] = $db['join'][$w][0];
                            $sqlwhere['join_databasse_in'] = $db['join'][$w][1];
                            $sqlwhere['join_databasse_out'] = $db['join'][$w][2];

                            $sqlwhere['id_website__bundles__database'] = $id_database_refer;
                            CRUDFunc::crud_save($fai, $page, $sqlwhere, array(), array(), "website__bundles__database__join", array());
                        }
                    }
                }
                //website__bundles__database
            }
        }
        $id_tag = null;
        $id_parent_tag = null;
        if (isset($array['tag'])) {

            echo '<br>';
            echo '<br>';
            unset($sqltag);
            $tag = $sqltag["tag"] = $array['tag'];
            unset($array['tag']);
            if ($id_database_refer)
                $sqltag["id_database_refer"] = $id_database_refer;
            unset($array['database_refer']);
            if (isset($array['database_row'])) {
                $array['row'] = $array['database_row'];
                unset($array['database_row']);
            }
            if (isset($array['row'])) {
                $row = $sqltag["database_row"] = $array['row'];
                unset($array['row']);
            }
            if (isset($array['tipe_header'])) {
                $sqltag["tipe_header"] = $array['tipe_header'];
                unset($array['tipe_header']);
            }
            if (isset($array['prefix'])) {
                $sqltag["prefix"] = $array['prefix'];
                unset($array['prefix']);
            }
            if (isset($array['sufix'])) {
                $sqltag["sufix"] = $array['sufix'];
                unset($array['sufix']);
            }
            if (isset($array['source_database'])) {
                $sqltag["source_database"] = $array['source_database'];
                unset($array['source_database']);
            }
            if (isset($array['get_result'])) {
                $sqltag["get_result"] = $array['get_result'];
                unset($array['get_result']);
            }
            if (isset($array['function'])) {
                $sql_func['struktur'] = $array["struktur"];
                $sql_func['class'] = $array["class"];
                $sql_func['function'] = $array["function"];
                $whereRaw = [];

                foreach ($sql_func as $key => $value) {
                    $whereRaw[] = ("$key='$value'");
                }
                DB::queryRaw($page, "select * from website__bundles__master__function where 1=1 and " . implode(' and ', $whereRaw));

                $get = DB::get('all');
                echo '';
                if ($get['num_rows']) {
                    $id_function = $get['row'][0]->id;
                } else {
                    $sql_func['nama_function'] = ucwords(str_replace(array('_'), array(' '), $array['function']));
                    $returnfile = CRUDFunc::crud_save($fai, $page, $sql_func, array(), array(), "website__bundles__master__function", array());
                    $id_function = $returnfile['last_insert_id'];
                    for ($f = 0; $f < count($array['parameter']); $f++) {
                        $sqlf['parameter'] = $array['parameter'][$f];
                        $sqlf['id_website__bundles__master__function'] = $id_function;
                        CRUDFunc::crud_save($fai, $page, $sqlf, array(), array(), "website__bundles__master__function__parameter", array());
                    }
                }
                $sqltag["id_function"] = $id_function;


                unset($array['struktur']);
                unset($array['class']);
                unset($array['function']);
                unset($array['parameter']);
            }
            if (isset($array['if_value'])) {
                DB::queryRaw($page, "select * from website__bundles__master__if where nama_if='" . ucwords(str_replace(array('_'), array(' '), "Ecommerce > " . $tag)) . "'");
                $get = DB::get('all');
                if ($get['num_rows']) {
                    $id_if = $get['row'][0]->id;
                } else {
                    unset($sqli_if);
                    $sql_if['nama_if'] = ucwords(str_replace(array('_'), array(' '), "Ecommerce > " . $tag));
                    $sql_if['row_if'] = $row;
                    $returnif = CRUDFunc::crud_save($fai, $page, $sql_if, array(), array(), "website__bundles__master__if", array());
                    $id_if =  $returnif['last_insert_id'];
                    foreach ($array['if_value'] as $if_key => $if_value) {
                        unset($sqli_if);
                        $sqli_if['id_website__bundles__master__if'] = $id_if;
                        $sqli_if['row_value'] = $if_key;
                        $sqli_if['is_else'] = 0;
                        if (!isset($array['if_else']['template_file'])) {
                            $sqli_if['if_text'] = $array['if_value'][$if_key];
                        } else {
                            $sqli_if['id_bundles_tag'] = FaiCommandTest::get_array_website_view_layout_to_database($page, $fai,  $if_value,  0, 'id_website');
                        }
                        CRUDFunc::crud_save($fai, $page, $sqli_if, array(), array(), "website__bundles__master__if__content", array());
                    }
                    $array['if_else'];
                    unset($sqli_if);
                    $sqli_if['id_website__bundles__master__if'] = $id_if;
                    $sqli_if['is_else'] = 1;
                    if (!isset($array['if_else']['template_file'])) {
                        $sqli_if['if_text'] = $array['if_else'];
                    } else {
                        $sqli_if['id_bundles_tag'] = FaiCommandTest::get_array_website_view_layout_to_database($page, $fai,  $if_value,  0, 'id_website');
                    }
                    CRUDFunc::crud_save($fai, $page, $sqli_if, array(), array(), "website__bundles__master__if__content", array());
                }
                unset($array['if_value']);
                unset($array['if_else']);
                $sqltag["id_if"] = $id_if;
            }
            if (isset($array['refer'])) {

                DB::queryRaw($page, "select * from website__bundles__master__refer where kode_refer='" . $array['refer'] . "'");
                $get = DB::get('all');
                if ($get['num_rows']) {
                    $id_refer = $get['row'][0]->id;
                } else {
                    $sql_refer['nama_refer'] = ucwords(str_replace(array('_'), array(' '), $array['refer']));
                    $sql_refer['kode_refer'] = $array['refer'];
                    $returnfile = CRUDFunc::crud_save($fai, $page, $sql_refer, array(), array(), "website__template__file", array());
                    $id_refer = $returnfile['last_insert_id'];
                }
                $sqltag["id_refer"] = $id_refer;
                unset($array['refer']);
            }
            print_r($sqltag);
            $whereRaw = [];

            foreach ($sqltag as $key => $value) {
                $whereRaw[] = ("$key='$value'");
            }
            DB::queryRaw($page, "select * from website__bundles__tag where 1=1 and " . implode(' and ', $whereRaw));
            $get = DB::get('all');
            echo $get['query'];
            if ($get['num_rows']) {
                $id_tag = $get['row'][0]->id;
            } else {
                $sqltag["nama_bundle_tag"] = "Ecommerce > " . $tag;
                $returnfile = CRUDFunc::crud_save($fai, $page, $sqltag, array(), array(), "website__bundles__tag", array());
                $id_tag = $returnfile['last_insert_id'];
            }
            //website__bundles__tag
        }
        if ($id_website and $id_tag) {
            DB::queryRaw($page, "select * from website__bundles__website__master__tag 
                where nama_parent='$tag'
                     and id_website__bundles__website__master=$id_website");
            $get = DB::get("all");
            if ($get['num_rows']) {
                $sqlUpdate['id_bundle_tag'] = $id_tag;
                CRUDFunc::crud_update($fai, $page, $sqlUpdate, array(), array(), array(), "website__bundles__website__master__tag", "id", $get['row'][0]->id);
            }
        }
        if (isset($array['template_file'])) {
            echo '<textarea>' . $content_file = file_get_contents($fai->urlframework($array['template_name'], $array['template_file'] . '.php')) . '</textarea>';
            DB::queryRaw($page, "select * from website__template__list where nama_template = '" . trim($array['template_name']) . "'");
            $get = DB::get("all");
            if (!$get['num_rows']) {
                $sql_list['nama_template'] = trim($array['template_name']);
                $return =  CRUDFunc::crud_save($fai, $page, $sql_list, array(), array(), "website__template__list", array());
                $id = $return['last_insert_id'];
            } else {
                $id = $get['row'][0]->id;
            }
            $nama_file = $sqli['nama_file'] = $array['template_name'] . ' > ' . str_replace(array(".template", "/"), array("", " > "), $array['template_file']);
            $sqli['kontent_file'] = Partial::html_encode($page, '', '', $content_file);
            $sqli['id_kategori'] = 5;
            $sqli['id_template'] = $id;
            DB::queryRaw($page, "select * from website__template__file where nama_file = '" . $nama_file . "'");
            $get = DB::get("all");
            if ($get['num_rows']) {
                $id_file = $get['row'][0]->id;
            } else {
                $returnfile = CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "website__template__file", array());
                $id_file = $returnfile['last_insert_id'];
            }

            $tag_file = FaiCommandTest::gettag($content_file);

            for ($k = 0; $k < count($tag_file); $k++) {
                $sqli_tag['id_website__template__file'] = $id_file;
                $sqli_tag['tag'] = $tag_file[$k];
                DB::queryRaw($page, "select * from website__template__file__tag where 1=1 and id_website__template__file=$id_file and tag='" . $tag_file[$k] . "'");
                $get = DB::get('all');
                if (!$get['num_rows'])
                    CRUDFunc::crud_save($fai, $page, $sqli_tag, array(), array(), "website__template__file__tag", array());
            }
            $sql_website['nama_bundle'] = $nama_file;
            $sql_website['id_file'] = $id_file;
            $sql_website['id_bundles_tag'] = $id_tag;
            $sql_website['id_parent_tag'] = $id_website;
            $whereRaw = [];

            foreach ($sql_website as $key => $value) {
                $whereRaw[] = ("$key='$value'");
            }
            DB::queryRaw($page, "select * from website__bundles__website__master where 1=1 and " . implode(' and ', $whereRaw));

            $get = DB::get('all');
            if ($get['num_rows']) {
                $id_webmas = $get['row'][0]->id;
            } else {
                $return = CRUDFunc::crud_save($fai, $page, $sql_website, array(), array(), "website__bundles__website__master", array());
                $id_webmas = $return['last_insert_id'];;
            }
            echo $id_webmas;
            unset($sqli_tag);
            for ($k = 0; $k < count($tag_file); $k++) {
                $sqli_tag['id_website__bundles__website__master'] = $id_webmas;
                DB::queryRaw($page, "select * from website__template__file__tag where id_website__template__file= $id_file and tag ='" . $tag_file[$k] . "'");
                $get = DB::get("all");
                $sqli_tag['id_file_tag'] = $get['row'][0]->id;
                $sqli_tag['nama_parent'] = $tag_file[$k];
                $sqli_tag['is_sub_array'] = (isset($array['template_array']) or isset($array['array'])) ? 1 : 0;
                $whereRaw = [];

                foreach ($sqli_tag as $key => $value) {
                    $whereRaw[] = ("$key='$value'");
                }
                DB::queryRaw($page, "select * from website__bundles__website__master__tag where 1=1 and " . implode(' and ', $whereRaw));

                $get = DB::get('all');
                if (!$get['num_rows'])
                    CRUDFunc::crud_save($fai, $page, $sqli_tag, array(), array(), "website__bundles__website__master__tag", array());
            }
            if ((isset($array['template_array']) or isset($array['array'])) ? 1 : 0) {
                if (isset($array['array'])) {
                    $aa = 0;
                    foreach ($array['array'] as $key => $value) {
                        $array['template_array'][$aa] = $value;
                        $array['template_array'][$aa]['tag'] = $key;
                        $aa++;
                    }
                    unset($array['array']);
                }
                for ($aa = 0; $aa < count($array['template_array']); $aa++) {
                    $array['template_array'][$aa] = FaiCommandTest::get_array_website_view_layout_to_database($page, $fai, $array['template_array'][$aa],  $id_webmas);
                }
            }

            unset($array['template_file']);
            unset($array['template_name']);
        }
        if ($return == 'id_website')
            return $id_webmas;
        else
            return $array;
    }
    public static function gettag($contentFile)
    {
        $get = html_entity_decode(htmlspecialchars_decode($contentFile));
        //echo $get;
        $ex = explode('></', $get);
        $exTag = explode('<', $ex[0]);
        $stringTag = $exTag[count($exTag) - 1];;
        $tag = [];
        for ($i = 0; $i < count($ex); $i++) {
            $mixTag = substr($ex[$i], 0, strpos($ex[$i], '>'));
            if ($stringTag == $mixTag) {
                $tag[] = $mixTag;
            }

            $exTag = explode('<', $ex[$i]);
            $stringTag = $exTag[count($exTag) - 1];;
        }
        return ($tag);
    }
    public function Partial_menu()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);

        //list_user_in_board -> untuk di dalam

        // $panel = FaiCommandTest::get_list_panel();
        // $list_id = $panel['im_id_organisasi'];
        $list_user = [];
        DB::queryRaw($page, "select * from web__list_apps 
            

        
            ");
        $get = DB::get('all');
        foreach ($get['row'] as $get) {
            $this->parent_partial_menu($page, $get->id, 0, $get->nama_apps);
        }
    }
    public function parent_partial_menu($page, $id_apps, $parent, $struktur_parent = "")
    {

        DB::queryRaw($page, "select *,web__list_apps_menu.id as id__parent from web__list_apps_menu
            left join web__list_apps on web__list_apps.id = id_apps
            where parent = $parent and id_apps=$id_apps
            

        
            ");
        $get = DB::get('all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $get) {
                // print_r($get);

                echo '<br>';
                echo $struktur_parent;
                echo ' > ';
                echo $get->nama_menu . '(' . $get->tipe_menu . ')';
                echo '<br>';
                DB::update("web__list_apps_menu", ["struktur_menu" => $struktur_parent . " > " . $get->nama_menu], ["id=$get->id__parent"]);
                $this->parent_partial_menu($page, $id_apps, $get->id__parent, $struktur_parent . " > " . $get->nama_menu);
            }
        }
    }

    public function get_content_view_layout()
    {
        $fai = new MainFaiFramework();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain'))) {

            $domain = $fai->input('frameworksubdomain');
        } else
            $domain = $_SERVER['HTTP_HOST'];
        if (!$type_load) {
            $type_load = $this->uri->segment(1);
        }
        if ($domain == 'localhost') {
            $domain = 'hibe3.com';
        }



        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;

        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['domain'] = $domain;
        $type_load;
        $page['route_type'] = "kode";
        echo $all = Partial::link_direct($page, base_url(), array("ViewLayout", "listing", 'view_layout', -1));

        if ($type_load == 'costum') {
            FaiServer::costum($all, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "");
        } else if ($type_load == 'api') {
            FaiServer::api($all);
        } else if ($type_load == 'store') {
            FaiServer::store($all);
        } else if ($type_load == 'produk') {
            FaiServer::produk($all);
            FaiServer::store($all);
        } else if ($type_load == 'config') {
            FaiServer::config($page, $all);
        } else if ($type_load == 'workspace') {
            DB::connection($page);
            DB::queryRaw($page, 'select * from web__list_apps_board where be3_id=\'KJSSTORE\';');
            $get = DB::get('all');
            $page_temp = $page;
            $page_temp['route_type'] = "just_link";
            $link = Partial::link_direct($page_temp, base_url() . "pages/", array("Workspace", "admin", "list", "-1", "-1", "-1", $get['row'][0]->id));
            echo '<script> window.location.href="' . $link . '";</script>';
        } else {
            $fai->LoadApps($page, $domain, $all);
        }
    }

    public function get_board_user()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);

        //list_user_in_board -> untuk di dalam
        $id_board = 37;
        // $panel = FaiCommandTest::get_list_panel();
        // $list_id = $panel['im_id_organisasi'];
        $list_user = [];
        DB::queryRaw($page, "select * from web__list_apps_board__user_list
        where id_web__list_apps_board = " . $id_board . "");
        $get = DB::get('all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                if (!in_array($row->id_user, $list_user)) {

                    $list_user[] = $row->id_user;
                }
            }
        }

        DB::queryRaw($page, "select *,hcms__struktur__anggota.id as id_anggota
                       
                            
                            from web__list_apps_board__entitas
                                left join hcms__struktur__anggota on hcms__struktur__anggota.id_organisasi = web__list_apps_board__entitas.id_organisasi
                                left join apps_user on  id_user = apps_user.id
                                
                                where id_web__list_apps_board = " . $id_board . "
                                and
                                (case when semua_anggota='1' then 1
                                    when semua_anggota='2' then (
                                        select count(*) from hcms__struktur__anggota__jabatan aj
                                        left join hcms__struktur__jabatan k on k.id = aj.id_jabatan 
                                        join web__list_apps_board__entitas__divisi mk on k.id_divisi = mk.id_divisi
                                        where aj.id_hcms__struktur__anggota = hcms__struktur__anggota.id
                                    )
                                end )>=1
                                
                                ");
        $get = DB::get('all');
        if ($get['num_rows']) {

            foreach ($get['row'] as $row) {
                if (!in_array($row->id_apps_user, $list_user) and $row->id_apps_user) {
                    $list_user[] = $row->id_apps_user;
                }
            }
        }

        return $list_user;
    }
    public function get_user_board($get_return = 'all')
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);

        $panel = $this->get_list_panel();

        $list_board = [];
        DB::queryRaw($page, "select * from web__list_apps_board__user_list
        where id_user = " . $_SESSION['id_apps_user'] . "");
        $get = DB::get('all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                if (!in_array($row->id_web__list_apps_board, $list_board)) {
                    $list_board[] = $row->id_web__list_apps_board;
                }
            }
        }
        DB::queryRaw($page, "select *
                       
                            
                            from web__list_apps_board__entitas
                                
                                where 1=1
                                and web__list_apps_board__entitas.id_organisasi in(" . $panel['im_id_organisasi'] . ")
                                and
                                (case when semua_anggota='1' then 1
                                    when semua_anggota='2' then (
                                        select count(*) from  web__list_apps_board__entitas__divisi aj
                                        where aj.id_web__list_apps_board__entitas = web__list_apps_board__entitas.id and id_divisi in (" . $panel['im_id_divisi'] . ")
                                    )
                                end )>=1
                                
                                ");
        $get = DB::get('all');
        if ($get['num_rows']) {

            foreach ($get['row'] as $row) {
                if (!in_array($row->id_web__list_apps_board, $list_board) and $row->id_web__list_apps_board) {
                    $list_board[] = $row->id_web__list_apps_board;
                }
            }
        }
        return $list_board;
    }
    public function get_list_panel($get_return = 'all')
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        $panel_list = [];
        $i = 0;

        if (isset($_SESSION['id_apps_user'])) {
            $panel_list[$i]['panel'] = "user";
            $panel_list[$i]['id_apps_user'] = $_SESSION['id_apps_user'];


            DB::queryRaw($page, "select *,(SELECT distinct string_agg(k.id_divisi::character varying, ',')
                            FROM hcms__struktur__anggota__jabatan mk
                            left join hcms__struktur__jabatan k on k.id = mk.id_jabatan 
                            WHERE mk.id_hcms__struktur__anggota = hcms__struktur__anggota.id and mk.active=1) as divisi_anggota_list,apps_user.be3_id as be3_iduser,organisasi.apps_id as be3_id_organisasi from hcms__struktur__anggota 
        left join apps_user on id_user = apps_user.id
        left join organisasi on id_organisasi = organisasi.id
        where id_apps_user = " . $_SESSION['id_apps_user'] . "");

            $get = DB::get('all');
            foreach ($get['row'] as $row) {
                $i++;

                $panel_list[0]['nama_panel'] = "User - " . $row->nama_lengkap;
                $panel_list[0]['nama_user'] = $row->nama_lengkap;
                $panel_list[0]['nama_organisasi'] = $row->nama_lengkap;
                $panel_list[0]['be3_id'] = $row->be3_iduser;
                $panel_list[0]['nama_lengkap'] = $row->nama_lengkap;
                $panel_list[0]['nama_detail_panel'] = $row->nama_lengkap;
                $panel_list[$i]['panel'] = "organisasi";
                $panel_list[$i]['nama_lengkap'] = $row->nama_lengkap;
                $panel_list[$i]['nama_user'] = $row->nama_lengkap;
                $panel_list[$i]['nama_panel'] = "Organisasi - " . $row->nama_organisasi;
                $panel_list[$i]['be3_id'] = $row->be3_id_organisasi;
                $panel_list[$i]['nama_detail_panel'] = $row->nama_organisasi;
                $panel_list[$i]['nama_organisasi'] = $row->nama_organisasi;
                $panel_list[$i]['id_organisasi'] = $row->id_organisasi;
                $panel_list[$i]['divisi_anggota_list'] = $row->divisi_anggota_list;
            }
        } else {
            if (!isset($_SESSION['hak_akses'])) {
                $_SESSION['hak_akses'] = "public";
            }
            $panel_list[$i]['panel'] = "public";
            $panel_list[$i]['ip_address'] = $_SERVER['REMOTE_ADDR'];
        }
        $panel_detail = array();
        $id_panel_list = array();
        $id_organisasi = array();
        $id_divisi = "";
        $id_panel = null;
        for ($i = 0; $i < count($panel_list); $i++) {
            $where_panel = "";;
            unset($sql);
            $this_aktif = false;
            $sql['panel'] = $panel_list[$i]['panel'];
            $sql['nama_panel'] = $panel_list[$i]['nama_panel'];
            if ($panel_list[$i]['panel'] == 'user') {
                $where_panel .= " and id_apps_user=" . $_SESSION['id_apps_user'] . "";;
                $sql['id_apps_user'] = $_SESSION['id_apps_user'];
                if (strtolower($_SESSION['hak_akses']) == 'user') {
                    $this_aktif = true;
                }
            } else if (isset($panel_list[$i]['id_organisasi'])) {
                //bisa program
                //bisa store
                //bisa project
                $where_panel .= " and id_organisasi=" . $panel_list[$i]['id_organisasi'] . "";;
                $sql['id_organisasi'] = $panel_list[$i]['id_organisasi'];
                if (strtolower($_SESSION['hak_akses']) == 'organisasi' and $panel_list[$i]['id_organisasi'] == $_SESSION['id_organisasi']) {
                    $this_aktif = true;
                }
                $id_organisasi[] = $panel_list[$i]['id_organisasi'];
            } else if ($panel_list[$i]['panel'] == 'public') {
                if (strtolower($_SESSION['hak_akses']) == 'public' and $panel_list[$i]['ip_address'] == $_SERVER['REMOTE_ADDR']) {
                    $this_aktif = true;
                }
            }
            if (isset($panel_list[$i]['divisi_anggota_list'])) {
                $id_divisi .= $panel_list[$i]['divisi_anggota_list'] . ',';
            }
            DB::queryRaw($page, "select * from panel 
                where 1=1  " . $where_panel . "
            ");
            $get = DB::get('all');
            if (!$get['num_rows']) {
                DB::insert("panel", $sql);
                $last_insert_id = DB::lastInsertId($page, "panel");
            } else {
                $last_insert_id = $get['row'][0]->id;
            }
            $panel_list[$i]['id_panel'] = $last_insert_id;
            $id_panel_list[] = $last_insert_id;
            if ($this_aktif) {
                $id_panel = $last_insert_id;

                $panel_detail = $panel_list[$i];
            }
        }
        $id_divisi .= "-1";
        DB::queryRaw($page, "select * from panel__user
                where 1=1 and id_panel=$id_panel and id_apps_user = " . $_SESSION['id_apps_user'] . "
            ");
        if ($get_user = DB::get()) {
            $id_user = $get_user[0]->id;
        } else {
            $sql_user['id_panel'] = $id_panel;
            $sql_user['id_apps_user'] = $_SESSION['id_apps_user'];
            DB::insert("panel", $sql);
            $id_user = DB::lastInsertId($page, "panel");
            DB::queryRaw($page, "select * from panel__user
                where 1=1 and id_panel=$id_panel and id_apps_user = " . $_SESSION['id_apps_user'] . "
            ");
            $get_user = DB::get();
        }
        $return['id_panel'] = $id_panel;
        $return['panel'] = $panel_detail['panel'];;
        $return['panel_list'] = $panel_list;;
        $return['id_panel_list'] = $id_panel_list;;
        $return['im_id_panel_list'] = implode(',', $id_panel_list);;
        $return['id_organisasi'] = $id_organisasi;;
        $return['im_id_divisi'] = $id_divisi;;
        $return['im_id_organisasi'] = implode(',', $id_organisasi);;
        $return['get_panel_detail'] = json_decode(json_encode($panel_detail), FALSE);
        $return['get_panel'] = json_decode(json_encode($panel_detail), FALSE);
        $return['get_user'] = $get_user[0];;
        $return['id_panel_user'] = $id_user;;


        if ($get_return == 'id')
            return $id_panel;
        else {
            return $return;
        }
    }

    public function get_group_menu()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        DB::queryRaw($page, "select * from web__list_apps_menu 
        
        where  parent=1431
        limit 1
        ");

        $get = DB::get();
        $show[] = 1414;
        $show[] = 1421;
        $show[] = 1430;
        // $show[] = 1432;
        // $show[] = 1433;
        // $show[] = 1439;

        /*
        hasil
            1430 = 2;
            1431 = 2;
        */
        $get_parent = function ($menu, $hasil) {

            return $id_parent;
        };
        $id_parent = array();
        $hasil = array();
        for ($i = 0; $i < count($show); $i++) {
            $loop = true;
            $menu = $show[$i];
            DB::queryRaw($page, "select * from web__list_apps_menu  where  id=($menu)");
            $get = DB::get();
            $parent = $get[0]->parent;
            if (!in_array($parent, $id_parent)) {
                $id_parent[] = $parent;
                while ($loop) {

                    DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($parent) and id in (" . implode(',', $show) . ")");
                    $get = DB::get();
                    $hasil[$parent] = $count = $get[0]->count + (isset($superparent[$parent]) ? $superparent[$parent] : 0);

                    $menu = $parent;
                    DB::queryRaw($page, "select * from web__list_apps_menu  where  id=($menu)");
                    $get = DB::get();
                    if ($get) {
                        $parent = $get[0]->parent;
                        if ($count) {
                            $superparent[$parent] = $count;
                        }
                    } else
                        $loop = false;
                    if ($parent == 0)
                        $loop = false;
                }
            }
            $sub_parent = $show[$i];
            DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($sub_parent) ");
            $get = DB::get();
            $hasil[$show[$i]] = $get[0]->count ? $get[0]->count : 1;
            if (($get[0]->count)) {
                DB::queryRaw($page, "select id from web__list_apps_menu  where  parent=($sub_parent) ");
                $get = DB::get();
                foreach ($get as $row) {
                    DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row->id) ");
                    $to_get = DB::get();
                    $hasil[$row->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                    $loop = true;
                    $tree_parent = $row->id;
                    if ($to_get[0]->count) {

                        DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                        $to_get = DB::get();
                        foreach ($to_get as $row1) {

                            DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row1->id) ");
                            $to_get = DB::get();
                            $hasil[$row1->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                            $tree_parent = $row1->id;
                            if ($to_get[0]->count) {

                                DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                $to_get = DB::get();
                                foreach ($to_get as $row2) {

                                    DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row2->id) ");
                                    $to_get = DB::get();
                                    $hasil[$row2->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                    $tree_parent = $row2->id;
                                    if ($to_get[0]->count) {

                                        DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                        $to_get = DB::get();
                                        foreach ($to_get as $row3) {

                                            DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row3->id) ");
                                            $to_get = DB::get();
                                            $hasil[$row3->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                            $tree_parent = $row3->id;
                                            if ($to_get[0]->count) {

                                                DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                                $to_get = DB::get();
                                                foreach ($to_get as $row4) {
                                                    DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row4->id) ");
                                                    $to_get = DB::get();
                                                    $hasil[$row4->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                                    $tree_parent = $row4->id;
                                                    if ($to_get[0]->count) {

                                                        DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                                        $to_get = DB::get();
                                                        foreach ($to_get as $row5) {
                                                            DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row5->id) ");
                                                            $to_get = DB::get();
                                                            $hasil[$row5->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                                            $tree_parent = $row5->id;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $key_hasil = [];
        foreach ($hasil as $key => $value) {
            if ($value)
                $key_hasil[] = $key;
        }


        FaiCommandTest::tree_menuFunction($page, 0, $key_hasil, 1);
    }
    public function tree_menuFunction($page, $parent, $key_hasil, $layer = 1)
    {
        DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=$parent and id in(" . implode(',', $key_hasil) . ") ");
        $get = DB::get();
        if ($get) {
            foreach ($get as $row) {
                unset($key_hasil[$row->id]);
                echo 'Layer ' . $layer . $row->nama_menu;
                echo '<br>';
                $to_layer = $layer + 1;
                FaiCommandTest::tree_menuFunction($page, $row->id, $key_hasil, ($to_layer));
            }
        }
    }
    public function perbaikan_asset_harga()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        DB::queryRaw($page, "select * from inventaris__asset__list where deskripsi_barang like '%Rp.%' order by id desc ");
        $get = DB::get();
        $fai = new MainFaiFramework();

        foreach ($get as $get) {
            echo '<div id="id-produk-' . $get->id . '">';
            echo $get->nama_barang . '<br>';
            echo '
            <div id="form-' . $get->id . '"></div>';
            echo '
            <div contenteditable="true" onkeyup="update(this,' . $get->id . ')" style ="border:1px solid black; margin-bottom:40px">' . $get->deskripsi_barang . '</div>';
            echo '</div>';
        }
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
        echo "
        
        <script>
        function update(e,id){
                 var content = $(e).html();
                        $.ajax({
                            type: 'post',
                            data: {
                                'content': content,
                                'id': id,
                                
                            },
                            url: 'https://hibe3.com/FaiCommandTest/save_perbaikan_deskripsi',
                            dataType: 'json',
                            success: function(data) {
                                
                                $('#form-'+id).html('Data tersimpan');
                                if(data.status==1){
                                $('#id-produk-'+id).html('');
                                    
                                }
                            },
                            error: function(error) {
                                $('#form-'+id).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form-'+id).html('Data proses save');
                            }
                        });
            }";
        echo '</script>';
    }
    public function save_perbaikan_deskripsi()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        $str =  $_POST['content'];
        $fai = new MainFaiFramework();
        DB::queryRaw($page, "update inventaris__asset__list set deskripsi_barang='" . $_POST['content'] . "' where id=" . $_POST['id']);
        $get = DB::get();
        if (strpos($str, 'Rp.')) {
            $data['status'] = 0;
        } else {

            $data['status'] = 1;
        }
        echo json_encode($data);
    }
    public function store__produk_id()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        DB::queryRaw($page, "select * from store__produk where apps_id is null");
        $get = DB::get();
        $fai = new MainFaiFramework();

        foreach ($get as $get) {
            $data["apps_id"] = rand(100000, 999999);
            DB::update("store__produk", $data, ["id=$get->id"]);
        }
        DB::queryRaw($page, "select *,store__produk__varian.id from store__produk__varian join store__produk on store__produk.id = store__produk__varian.id_store__produk where varian_apps_id is null");
        $get = DB::get();
        $fai = new MainFaiFramework();

        foreach ($get as $get) {
            DB::queryRaw($page, "select count(*) as count from store__produk__varian join store__produk on store__produk.id = store__produk__varian.id_store__produk where id_store__produk=$get->id_store__produk and varian_apps_id is not null");
            $count = DB::get();
            $data2["varian_apps_id"] = $get->apps_id . '-' . sprintf('%02d', $count[0]->count + 1);
            DB::update("store__produk__varian", $data2, ["id=$get->id"]);
        }
    }
    public function sinkrinisasi_menu_list_apps_frontend()
    {
        $fai = new MainFaiFramework();

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        $menu = $fai->Apps("HCMS", "frontend");
    }
    public function sinkrinisasi_menu_list_apps()
    {
        $fai = new MainFaiFramework();

        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        DB::connection($page);
        // $array = array(
        //     array("Store", 47),
        //     array("HCMS", 3),
        //     array("ERP", 13),
        //     array("Keuangan", 4),
        //     array("Inventaris_aset", 21),
        //     array("POS", 14),
        //     array("CRM", 26),
        //     array("GA", 27),
        //     array("Outsourcing", 69),
        //     // 13	
        //     // 4	
        //     // 	
        //     // 	 Toko
        //     // 14	
        //     // 	
        // );
        // $Apps = "HCMS";
        // $page['load']['link'] = "direct";
        // $page['route_type'] = "id";
        // $fai = new MainFaiFramework();

        // for ($i = 0; $i < count($array); $i++) {
        //     $menu = $fai->Apps($array[$i][0], "menu_basic");
        ////////////////////////////////////////////////////////////
        $array = array(
            array("Workspace", 70),
            // array("HCMS", 3),
            // array("ERP", 13),
            // array("Keuangan", 4),
            // array("Inventaris_aset", 21),
            // array("POS", 14),
            // array("CRM", 26),
            // array("GA", 27),
            // array("Outsourcing", 69),
            // array("Store", 47),
            // 13	
            // 4	
            // 	
            // 	 Toko
            // 14	
            // 	
        );
        $Apps = "HCMS";
        $page['load']['link'] = "direct";
        $page['route_type'] = "id";
        $fai = new MainFaiFramework();

        for ($i = 0; $i < count($array); $i++) {
            // $menu = $fai->Apps($array[$i][0], "menu_bisnis");
            $menu = $fai->Apps($array[$i][0], "menu_food");

            //////////////////////////////////
            $id_parent = 0;
            $id_apps = $array[$i][1];
            echo '<pre>';
            // echo $array[$i][0];
            // echo '<br>';
            // DB::table("web__list_apps_menu");
            // DB::where("id_apps");
            FaiCommandTest::menufunction($page, $menu, $id_apps, $id_parent, $array[$i][0]);
        }
    }

    public static function menufunction($page, $menu, $id_apps, $id_parent, $struktur_parent = "")
    {

        for ($i = 0; $i < count($menu); $i++) {
            unset($db);
            $where = array();
            $nama = "";
            $where['tipe_menu'] = $menu[$i][0];


            $where['load_apps'] = null;
            $where['load_page_view'] = null;
            $where['load_type'] = null;
            $where['load_page_id'] = null;
            $where['board'] = null;
            if ($menu[$i][0] == 'menu') {
                $parameter = $menu[$i][2];
                $where['load_apps'] = $parameter[0];
                $where['load_page_view'] = $parameter[1];
                $where['load_type'] = $parameter[2];
                $where['load_page_id'] = $parameter[3];
                if (isset($parameter[4])) {
                    $where['menu'] = $parameter[4];

                    if ($parameter[4] != -1)
                        $nama = $parameter[4];
                } else
                    $where['menu'] = -1;

                if (isset($parameter[5])) {
                    $where['nav'] = $parameter[5];
                    if ($parameter[5] != -1)
                        $nama = $parameter[5];
                } else
                    $where['nav'] = -1;
                if (isset($parameter[6])) {
                    $where['board'] = $parameter[6];
                } else
                    $where['board'] = -1;
                //$id = Partial::link_direct($page, base_url(), $menu[$i][2],$menu[$i][0],$id_parent);

            }

            $db['utama'] = 'web__list_apps_menu';
            $where['nama_menu'] =  $menu[$i][1];
            $struktu_menu = $where['struktur_menu'] =  $struktur_parent . " > " . $menu[$i][1];

            $where['id_apps'] = $id_apps;

            // foreach ($where as $key => $value) {
            //     $db['where'][] = array($key, '=', "'$value'");
            // }

            $db['where'][] = array("active", '=', "1");
            $db['where'][] = array("struktur_menu", '=', "'$struktu_menu'");
            print_r($db['where']);

            $get = Database::database_coverter($page, $db, array(), 'all');
            echo $get['query'];
            echo '<br>';
            echo $get['num_rows'] . '==>>>>' . $struktu_menu;
            if (!$get['num_rows']) {
                $where['urutan'] = $i + 1;
                $where['parent'] = $id_parent;
                DB::insert('web__list_apps_menu', $where);
                $collectId[] =    $id__to = DB::lastInsertId($page, 'web__list_apps_menu');
            } else {
                echo    $menu[$i][1];
                $sqli['urutan'] = $i + 1;

                $sqli['parent'] = $id_parent;
                DB::update('web__list_apps_menu', $sqli, ["id=" . $get['row'][0]->id]);
                $collectId[] =     $id__to = $get['row'][0]->id;
            }
            // echo '<br>';
            if ($menu[$i][0] != 'menu') {

                $getCollect = FaiCommandTest::menufunction($page, $menu[$i][2], $id_apps, $id__to, $struktu_menu);
                for ($mn = 0; $mn < count($getCollect); $mn++) {
                    $collectId[] = $getCollect[$mn];
                }
            }
        }
        return $collectId;
    }

    public function test1()
    {
        $page['app_framework'] = 'ci';
        $page['database_provider'] = 'postgres';
        $page['database_name'] = 'hexghtba_be3';
        $page['conection_server'] = 'localhost';
        $page['conection_name_database'] = 'hexghtba_be3';
        $page['conection_user'] = 'hexghtba_be3user';
        $page['conection_password'] = 'be3gritofficial';
        $page['conection_scheme'] = 'public';
        DB::connection($page);
        DB::query('
        --		DROP TABLE panel;
	DROP SEQUENCE  	seq_panel ;
	--DROP TABLE  	panel ;
	--DROP TABLE  	panel__user ;
	--DROP SEQUENCE  	seq_panel__user ;
    --

        		');
        //         
        // 	DROP table  	store__promo__toko__brand ;  --	DROP SEQUENCE "public"."seq_chat__bot" ;
        // 	--DROP SEQUENCE  seq_chat__bot__package ;
        // 	DROP SEQUENCE seq_chat__bot__save ;
        // 	DROP SEQUENCE seq_chat__room ;
        // 	DROP SEQUENCE seq_chat__room__anggota ;
        // 	DROP SEQUENCE seq_chat__room__pesan ;
        //     DROP SEQUENCE seq_panel ;
        // 	DROP SEQUENCE seq_panel__user ;  		
        // GRANT USAGE ON SCHEMA public TO hexghtba ;
        // GRANT SELECT ON ALL TABLES IN SCHEMA public TO hexghtba ;
        // GRANT SELECT ON ALL SEQUENCES IN SCHEMA public TO hexghtba ;
        // GRANT EXECUTE ON ALL FUNCTIONS IN SCHEMA public TO hexghtba ;

        // GRANT ALL ON ALL TABLES IN SCHEMA public TO hexghtba ;
        // GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO hexghtba ;
        // GRANT ALL ON ALL FUNCTIONS IN SCHEMA public TO hexghtba ;

        // GRANT ALL PRIVILEGES ON SCHEMA "public" TO "hexghtba", GROUP "hexghtba" WITH GRANT OPTION;
        // grant all on all tables in schema "public" to hexghtba;

        // grant all on all tables in schema "public" to hexghtba_be3user;
        // grant all on all tables in schema "public" to hexghtba;
    }
    public function test()
    {
        $fai = new MainFaiFramework();
        $page['load']['database']['id']['text'] = 'id';
        $page['load']['database']['id']['type'] = 'prefix'; //prefix//sufix
        $page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id
        $page['app_framework'] = 'ci';
        $page['database_provider'] = 'postgres';
        $page['database_name'] = 'hexghtba_be3';
        $page['conection_server'] = 'localhost';
        $page['conection_name_database'] = 'hexghtba_be3';
        $page['conection_user'] = 'hexghtba_be3user';
        $page['conection_password'] = 'be3gritofficial';
        $page['conection_scheme'] = 'public';
        print_r($fai->get_parent_tree($page, 'inventaris__asset__master__brand', 'id', 2, 'id_parent', 'nama_brand', ' > '));
    }
    public function migrasi($menu = -1)
    {

        $page['app_framework'] = 'ci';
        $page['database_provider'] = 'postgres';
        $page['database_name'] = 'hexghtba_be3';
        $page['conection_server'] = 'localhost';
        $page['conection_name_database'] = 'hexghtba_be3';
        $page['conection_user'] = 'hexghtba_be3user';
        $page['conection_password'] = 'be3gritofficial';
        $page['conection_scheme'] = 'public';
        DB::connection($page);
        DB::table('store__produk');
        DB::selectRaw('*');
        DB::selectRaw('store__produk.id as id_produk');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset');
        DB::whereRaw("inventaris__asset__list.jual_barang = 'Ya'");
        DB::limitRaw($page, 1);
        // print_r(DB::get('query'));
        $produk = DB::get('all');
        $data = EcommerceApp::get_data_detail($page, $produk);
        echo '<pre>';
        // print_r($data[1]);
        $servername = "localhost";
        $username = "hexghtba_cnk";
        $password = "cnkwagateway";
        $dbname = "hexghtba_cnk";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $i = 1;
        $menit = date('Y-m-d H:i:s');

        for ($i = 1; $i <= 1; $i++) {

            //  $menit = date('Y-m-d H:i:s', strtotime($menit.'+1 hour'));
            // $menit = date('Y-m-d H:i:s', strtotime($menit.'+15 minute'));
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+5 minute'));
            $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Start " . $data[$i]['nama_produk'] . "', '1', 'text', '{\"message\":\"*Random Produk:" . $data[$i]['nama_produk'] . "*\"}', 'waiting', '10', '$menit', '2024-02-21 20:45:47', '2024-02-21 21:03:03');
        ";
            $wa = new WaApp();
            $wa->send('628987423444', "*Random Produk:" . $data[$i]['nama_produk'] . "*");
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+5 minute'));
            // $conn->query($sql);
            die;
            for ($ii = 1; $ii <= count($data[$i]['gambar_produk']); $ii++) {
                $gambar = $data[$i]['gambar_produk'][$ii];
                $gambar = str_replace("/", "\\\/", $gambar);
                $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
                echo $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Gambar " . $data[$i]['nama_produk'] . "', '1', 'media', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":\"\"}', 'waiting', '10', '$menit', '2024-02-22 07:59:52', '2024-02-22 07:59:52'); ";

                $conn->query($sql);
                $last_id = $conn->insert_id;
                $sql = "INSERT INTO `bulks` (`id`, `user_id`, `session_id`, `campaign_id`, `receiver`, `message_type`, `message`, `status`, `created_at`, `updated_at`) 
             VALUES ('" . Partial::generateUuid4() . "', '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', '$last_id', '628987423444', 'text', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":\"\"}', 'pending', '2024-02-21 20:45:47', '2024-02-21 20:47:15'); ";
                $conn->query($sql);
            }
            if (isset($data[$i]['varian'])) {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    for ($iii = 1; $iii <= count($data[$i]['varian'][$ii]['gambar_produk_varian']); $iii++) {
                        $gambar = $data[$i]['varian'][$ii]['gambar_produk_varian'][$iii];
                        $gambar = str_replace("/", "\\\/", $gambar);
                        $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
                        echo $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Varian " . $data[$i]['nama_produk'] . "', '1', 'media', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":Varian " . $data[$i]['varian'][$ii]['nama_varian'] . "\"\"}', 'waiting', '10', '$menit', '2024-02-22 07:59:52', '2024-02-22 07:59:52'); ";

                        $conn->query($sql);
                        $last_id = $conn->insert_id;
                        $sql = "INSERT INTO `bulks` (`id`, `user_id`, `session_id`, `campaign_id`, `receiver`, `message_type`, `message`, `status`, `created_at`, `updated_at`) 
             VALUES ('" . Partial::generateUuid4() . "', '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', '$last_id', '628987423444', 'text', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":Varian " . $data[$i]['varian'][$ii]['nama_varian'] . "\"\"}', 'pending', '2024-02-21 20:45:47', '2024-02-21 20:47:15'); ";
                        $conn->query($sql);
                    }
                }
            }
            for ($ii = 1; $ii <= count($data[$i]['thumbail_produk']); $ii++) {
                $gambar = $data[$i]['thumbail_produk'][$ii];
                $gambar = str_replace("/", "\\\/", $gambar);
                $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
                echo $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Sampul " . $data[$i]['nama_produk'] . "', '1', 'media', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":*" . $data[$i]['nama_produk'] . "*\"\"}', 'waiting', '10', '$menit', '2024-02-22 07:59:52', '2024-02-22 07:59:52'); ";
                echo '<br>';
                $conn->query($sql);
                $last_id = $conn->insert_id;
                $sql = "INSERT INTO `bulks` (`id`, `user_id`, `session_id`, `campaign_id`, `receiver`, `message_type`, `message`, `status`, `created_at`, `updated_at`) 
             VALUES ('" . Partial::generateUuid4() . "', '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', '$last_id', '628987423444', 'text', '{\"url\":\"$gambar\",\"media_type\":\"image\",\"caption\":*Sampul " . $data[$i]['nama_produk'] . "*\"\"}', 'pending', '2024-02-21 20:45:47', '2024-02-21 20:47:15'); ";
                $conn->query($sql);
            }

            $deskripsi = $data[$i]['deskripsi'];
            $deskripsi = str_replace(
                '&lt;div&gt;Kelebihan berbelanja di Official Shop kami:&lt;/br&gt;-Barang dijamin branded dengan label kami sendiri&lt;/br&gt;-Desain baju kami exclusive tidak dijual bebas&lt;/br&gt;-Semua barang kami ready stok, langsung di order aja ya kak&lt;/br&gt;-Foto produk kami juga real pic difoto langsung distudio kami sendiri&lt;/br&gt;-Bahannya dijamin high quality &amp; enggak akan mengecewakan, bisa juga untuk kamu jual lagi&lt;/br&gt;-Free retur jika barang salah kirim atau cacat&lt;/br&gt;-Free ongkir untuk pembelian di Official Shop minimum pembelian lebih rendah daripada toko non-official&lt;/br&gt;-Langsung lihat toko kami ya kak untuk membeli item lainnya. Banyak baju lucu dengan harga hemat ditoko kami&lt;/br&gt;',
                '',
                $deskripsi
            );
            $deskripsi = str_replace(
                '&lt;/br&gt;Note: Cocok untuk ukuran tubuh wanita asia&lt;/br&gt;Tips mencuci pakaian:&lt;/br&gt;- Direkomendasikan mengunakan pelapis tambahan ketika mengunakan setrika &lt;/br&gt;- Saat mengunakan setrika sebaiknya dengan suhu rendah&lt;/br&gt;- Jika menggunakan pengering mesin cuci atur dengan kekuatan sedang&lt;/br&gt;- Jika menggunakan tangan peras baju perlahan-lahan, jangan memeras terlalu kencang &lt;/br&gt;- Jangan mengunakan pemutih untuk keperluan sehari-hari&lt;/br&gt;- Supaya warna tidak mudah pudar hindari pengeringan langsung dibawah sinar matahari&lt;/br&gt;- Sebaiknya gunakan hanger untuk mengeringkan&lt;/br&gt;&lt;/div&gt;',
                '',
                $deskripsi
            );
            $deskripsi = str_replace('&lt;/br&gt;', '\r\n', $deskripsi);
            $deskripsi = htmlspecialchars_decode($deskripsi);
            $deskripsi .= "" . '\r\n' . "" . '\r\n' . "*Harga:" . $data[$i]['harga_jual'] . "*";
            if ($data[$i]['is_varian_produk'] == 'Ya') {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    $deskripsi .= "\r\nHarga Varian - " . $data[$i]['varian'][$ii]['nama_varian'] . " - " . $data[$i]['varian'][$ii]['harga_jual'] . "";
                }
            }
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
            $deskripsi = json_encode($deskripsi);
            $deskripsi = substr($deskripsi, 1, -1);
            $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Deskripsi " . $data[$i]['nama_produk'] . "', '1', 'text', '{\"message\":\"*" . $data[$i]['nama_produk'] . "*\\n" . $deskripsi . "\"}', 'waiting', '10', '$menit', '2024-02-21 20:45:47', '2024-02-21 21:03:03');
        ";

            $conn->query($sql);
            $last_id = $conn->insert_id;
            $sql = "INSERT INTO `bulks` (`id`, `user_id`, `session_id`, `campaign_id`, `receiver`, `message_type`, `message`, `status`, `created_at`, `updated_at`) 
             VALUES ('" . Partial::generateUuid4() . "', '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', '$last_id', '628987423444', 'text', '{\"message\":\"*" . $data[$i]['nama_produk'] . "*\\n" . $deskripsi . "\"}', 'pending', '2024-02-21 20:45:47', '2024-02-21 20:47:15'); ";
            $conn->query($sql);
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
            $harga = '\r\n' . "*Harga Toko:" . $data[$i]['harga_jual'] . "*";
            if (isset($data[$i]['varian'])) {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    $harga .= "" . '\r\n' . "_" . $data[$i]['varian'][$ii]['nama_varian'] . "_" . '\r\n' . "\tHarga Varian:" . $data[$i]['varian'][$ii]['harga_jual_akhir'] . "";
                    $mitra = $data[$i]['varian'][$ii]['harga_mitra'];
                    foreach (($mitra) as $iii => $value) {
                        $harga .= "" . '\r\n' . "" . '\r\n' . "_" . $iii . "_";

                        for ($iiii = 1; $iiii <= count($mitra[$iii]); $iiii++) {
                            $harga .= "" . '\r\n' . " Pembelian Min " . $mitra[$iii][$iiii]['minimal_pembelian'] . ($mitra[$iii][$iiii]['maksimal_pembelian'] ? ' s/d ' . $mitra[$iii][$iiii]['maksimal_pembelian'] : '') . ' : ' . $mitra[$iii][$iiii]['harga_jual_mitra'] . "(-" . ($mitra[$iii][$iiii]['tipe_mitra'] == "Rp" ? "Rp. " : '') . $mitra[$iii][$iiii]['margin_mitra'] . ($mitra[$iii][$iiii]['tipe_mitra'] == "%" ? "%" : '') . ")";
                        }
                    }
                }
            } else {
                $mitra = $data[$i]['harga_mitra'];
                foreach (($mitra) as $iii => $value) {
                    $harga .= "" . '\r\n' . "" . '\r\n' . "_" . $iii . "_";
                    print_r($data[$i]['harga_mitra']);
                    foreach (($mitra[$iii]) as $iiii => $value2) {
                        print_r($mitra[$iii][$iiii]);
                        $harga .= "" . '\r\n' . " Pembelian Min " . $mitra[$iii][$iiii]['minimal_pembelian'] . ($mitra[$iii][$iiii]['maksimal_pembelian'] ? ' s/d ' . $mitra[$iii][$iiii]['maksimal_pembelian'] : '') . ' : ' . $mitra[$iii][$iiii]['harga_jual_mitra'];
                    }
                }
            }
            $harga = json_encode($harga);
            $harga = substr($harga, 1, -1);
            $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Harga " . $data[$i]['nama_produk'] . "', '1', 'text', '{\"message\":\"*Informasi Harga*" . $harga . "\"}', 'waiting', '10', '$menit', '2024-02-21 20:45:47', '2024-02-21 21:03:03');
        ";

            $conn->query($sql);
            $last_id = $conn->insert_id;
            $sql = "INSERT INTO `bulks` (`id`, `user_id`, `session_id`, `campaign_id`, `receiver`, `message_type`, `message`, `status`, `created_at`, `updated_at`) 
             VALUES ('" . Partial::generateUuid4() . "', '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', '$last_id', '628987423444', 'text', '{\"message\":\"*Informasi Harga*" . $harga . "\"}', 'pending', '2024-02-21 20:45:47', '2024-02-21 20:47:15'); ";
            $conn->query($sql);
            // $conn->query($sql);


        }
    }
    public function test_chat_bot()
    {
        $page['app_framework'] = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name'] = DATABASE_NAME;
        $page['conection_server'] = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user'] = CONECTION_USER;
        $page['conection_password'] = CONECTION_PASSWORD;
        $page['conection_scheme'] = CONECTION_SCHEME;
        $data['content_message'] = "E Get Produk 5";
        $data['from'] = "628987423444";
        ChatbotApp::router($page, $data);
    }
    public function perbaiki_code()
    {
        $text = 'Array
        (
            [0] =&gt; Array
                (
                    [0] =&gt; website
                    [1] =&gt; col-md-12 xx
                    [2] =&gt; Array
                        (
                            [content] =&gt; Array
                                (
                                    [0] =&gt; Array
                                        (
                                            [content_source] =&gt; template_database
                                            [source_list] =&gt; template_database
                                            [nama_file] =&gt; Ashion &gt; navbar
                                            [template_content] =&gt;  &amp;lt;header class=&amp;quot;header&amp;quot;&amp;gt;
                &amp;lt;div class=&amp;quot;container-fluid&amp;quot;&amp;gt;
                    &amp;lt;div class=&amp;quot;row&amp;quot;&amp;gt;
                        &amp;lt;div class=&amp;quot;col-xl-2&amp;quot;&amp;gt;
                            &amp;lt;HEADER-LOGO&amp;gt;&amp;lt;/HEADER-LOGO&amp;gt;
                        &amp;lt;/div&amp;gt;
                        &amp;lt;div class=&amp;quot;col-xl-6&amp;quot;&amp;gt;
                            &amp;lt;nav class=&amp;quot;header__menu&amp;quot;&amp;gt;
                                &amp;lt;ul&amp;gt;
                                    &amp;lt;MENU-LIST&amp;gt;&amp;lt;/MENU-LIST&amp;gt;
                                    
                                &amp;lt;/ul&amp;gt;
                            &amp;lt;/nav&amp;gt;
                        &amp;lt;/div&amp;gt;
                        &amp;lt;div class=&amp;quot;col-lg-4&amp;quot;&amp;gt;
                            &amp;lt;div class=&amp;quot;header__right&amp;quot;&amp;gt;
                                &amp;lt;ul class=&amp;quot;header__right__widget&amp;quot;&amp;gt;
                                &amp;lt;HEADER-LIST&amp;gt;&amp;lt;/HEADER-LIST&amp;gt;
                                    
                                &amp;lt;/ul&amp;gt;
                            &amp;lt;/div&amp;gt;
                        &amp;lt;/div&amp;gt;
                    &amp;lt;/div&amp;gt;
                    &amp;lt;div class=&amp;quot;canvas__open&amp;quot;&amp;gt;
                        &amp;lt;i class=&amp;quot;fa fa-bars&amp;quot;&amp;gt;&amp;lt;/i&amp;gt;
                    &amp;lt;/div&amp;gt;
                &amp;lt;/div&amp;gt;
            &amp;lt;/header&amp;gt;
            &amp;lt;style&amp;gt;
                .header__right {
        text-align: right
            padding-top: 16px;
            padding-right: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
        }
            &amp;lt;/style&amp;gt;
                                            [template_array] =&gt; Array
                                                (
                                                    [0] =&gt; Array
                                                        (
                                                            [tag] =&gt; MENU-LIST
                                                            [nama_tag] =&gt; Menu List
                                                            [refer] =&gt; menu_list
                                                            [file_menu] =&gt; &amp;lt;li &amp;lt;CLASS-ACTIVE&amp;gt;&amp;lt;/CLASS-ACTIVE&amp;gt;&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK&amp;gt;&amp;lt;/LINK&amp;gt;&amp;quot;&amp;gt;&amp;lt;NAMA-MENU&amp;gt;&amp;lt;/NAMA-MENU&amp;gt;&amp;lt;/a&amp;gt;
            &amp;lt;DROPDOWN&amp;gt;&amp;lt;/DROPDOWN&amp;gt;
        &amp;lt;/li&amp;gt;
                                                            [parameter] =&gt; Array
                                                                (
                                                                    [0] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Home
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; 
                                                                                    [1] =&gt; 
                                                                                    [2] =&gt; 
                                                                                    [3] =&gt; 
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Backend
                                                                                    [8] =&gt; bundles
                                                                                    [9] =&gt; Home
                                                                                )

                                                                        )

                                                                    [1] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Shop
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Ecommerce
                                                                                    [1] =&gt; list
                                                                                    [2] =&gt; view_layout
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [2] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Pesanan Saya
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Ecommerce
                                                                                    [1] =&gt; pesanan_saya
                                                                                    [2] =&gt; list
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; -1
                                                                                    [5] =&gt; -1
                                                                                    [6] =&gt; ID_BOARD|
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [3] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Daftar Mitra
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Workspace
                                                                                    [1] =&gt; daftar_mitra
                                                                                    [2] =&gt; list
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; -1
                                                                                    [5] =&gt; -1
                                                                                    [6] =&gt; ID_BOARD|
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [4] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Kontak
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; 
                                                                                    [1] =&gt; 
                                                                                    [2] =&gt; 
                                                                                    [3] =&gt; 
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Backend
                                                                                    [8] =&gt; bundles
                                                                                    [9] =&gt; contact_us
                                                                                )

                                                                        )

                                                                )

                                                        )

                                                    [1] =&gt; Array
                                                        (
                                                            [tag] =&gt; HEADER-LOGO
                                                            [nama_tag] =&gt; Ashion &gt; Navbar &gt; Header-Logo 
                                                            [content_source] =&gt; template_database
                                                            [source_list] =&gt; template_database
                                                            [nama_file] =&gt; Ashion &gt; Header Logo
                                                            [template_content] =&gt; &amp;lt;div class=&amp;quot;header__logo&amp;quot;&amp;gt;
            &amp;lt;a href=&amp;quot;&amp;lt;BASE-URL&amp;gt;&amp;lt;/BASE-URL&amp;gt;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;&amp;lt;IMAGE-LOGO&amp;gt;&amp;lt;/IMAGE-LOGO&amp;gt;&amp;quot; alt=&amp;quot;&amp;quot; height=&amp;quot;50px&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;
        &amp;lt;/div&amp;gt;
                                                            [refer] =&gt; content_template
                                                            [template_array] =&gt; Array
                                                                (
                                                                    [0] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; IMAGE-LOGO
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; IMAGE-LOGO
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; logo_utama
                                                                        )

                                                                    [1] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; BASE-URL
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; BASE-URL
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; base_url
                                                                        )

                                                                )

                                                            [array] =&gt; Array
                                                                (
                                                                    [IMAGE-LOGO] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; IMAGE-LOGO
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; IMAGE-LOGO
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; logo_utama
                                                                        )

                                                                    [BASE-URL] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; BASE-URL
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; BASE-URL
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; base_url
                                                                        )

                                                                )

                                                        )

                                                    [2] =&gt; Array
                                                        (
                                                            [tag] =&gt; HEADER-LIST
                                                            [nama_tag] =&gt; Ashion &gt; Header List 
                                                            [refer] =&gt; dropdown
                                                            [dropdown] =&gt; Array
                                                                (
                                                                    [1] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Button Search
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Button Search
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;
            &amp;lt;!--&amp;lt;span class=&amp;quot;icon_search search-switch&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;--&amp;gt;
                &amp;lt;form action=&amp;quot;#&amp;quot;&amp;gt;
                    
                &amp;lt;div class=&amp;quot;search-be3&amp;quot;&amp;gt;
        &amp;lt;!--            &amp;lt;select id=&amp;quot;searchType&amp;quot; name=&amp;quot;searchType&amp;quot;&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;option value=&amp;quot;1&amp;quot;&amp;gt;Search in books&amp;lt;/option&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;option value=&amp;quot;2&amp;quot;&amp;gt;Search in videos&amp;lt;/option&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;/select&amp;gt;--&amp;gt;
            
            &amp;lt;input type=&amp;quot;text&amp;quot; name=&amp;quot;searchInput&amp;quot; placeholder=&amp;quot;Search...&amp;quot;&amp;gt;
            &amp;lt;button&amp;gt;&amp;lt;i class=&amp;quot;fa-solid fa-magnifying-glass&amp;quot;&amp;gt;&amp;lt;/i&amp;gt;&amp;lt;/button&amp;gt;
                &amp;lt;/form&amp;gt;
        &amp;lt;/div&amp;gt;
        

        &amp;lt;style&amp;gt;
                    .search-be3{
        
            border: 1px solid rgb(255, 255, 255);
            border-radius: 15px;
            
            align-items: center;
            padding: 5px;
            background: white;  border: 1px solid rgba(0, 0, 0, 0.35);
        }
            .search-be3 select {
                padding: 0;
                border: none;
                outline: none;
                cursor: pointer;
                background: transparent;
            }
        .search-be3 input{
        
            padding: 0;
            border: none;
            outline:none;
            margin-left: 10px;

        }
        .search-be3 button{
            padding: 0;
            border: none;
            outline:none;
            font-size: 25px;
            margin: auto;
            margin-right: 0;
            color: rgb(139, 139, 139);
            background: white;

        }
        @media only screen and (max-width: 600px) {
            .search-be3 {
                width: 100%;
                flex-wrap: wrap;
            }
            .search-be3 select {
                width: 100%;
            }
        }
        &amp;lt;/style&amp;gt;
            &amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                )

                                                                        )

                                                                    [2] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Navbar &gt; Cart
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Asion &gt; Icon Cart
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK-CART&amp;gt;&amp;lt;/LINK-CART&amp;gt;&amp;quot;&amp;gt;&amp;lt;span class=&amp;quot;icon_bag_alt&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;
                    &amp;lt;div class=&amp;quot;tip&amp;quot;&amp;gt; &amp;lt;COUNT-CART&amp;gt;&amp;lt;/COUNT-CART&amp;gt; &amp;lt;/div&amp;gt;
                &amp;lt;/a&amp;gt;&amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-CART
                                                                                            [nama_tag] =&gt; Link CArt
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; just_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Ecommerce
                                                                                                    [1] =&gt; cart
                                                                                                    [2] =&gt; view_layout
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-CART
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [LINK-CART] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-CART
                                                                                            [nama_tag] =&gt; Link CArt
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; just_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Ecommerce
                                                                                                    [1] =&gt; cart
                                                                                                    [2] =&gt; view_layout
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [COUNT-CART] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-CART
                                                                                        )

                                                                                )

                                                                        )

                                                                    [3] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Profile &amp; login
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Profil &amp; login
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;
            &amp;lt;?php 
            $login=false;
            if(isset($_SESSION[&amp;#039;is_login&amp;#039;])){
                if($_SESSION[&amp;#039;is_login&amp;#039;]==1){
                    $login=true;
                }
            }
            if($login){
            ?&amp;gt;
            
            &amp;lt;div class=&amp;quot;dropdown-container-be3&amp;quot;&amp;gt;
                        &amp;lt;details class=&amp;quot;dropdown right&amp;quot;&amp;gt;
                            &amp;lt;summary class=&amp;quot;avatar&amp;quot;&amp;gt;
                                &amp;lt;img src=&amp;quot;&amp;lt;BE3-USER-IMAGE&amp;gt;&amp;lt;/BE3-USER-IMAGE&amp;gt;&amp;quot;&amp;gt;
                            &amp;lt;/summary&amp;gt;
                            &amp;lt;ul&amp;gt;
                                &amp;lt;!-- Optional: user details area w/ gray bg --&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;p&amp;gt;
                                        &amp;lt;span class=&amp;quot;block bold&amp;quot;&amp;gt; &amp;lt;BE3-USER-NAME&amp;gt;&amp;lt;/BE3-USER-NAME&amp;gt; &amp;lt;/span&amp;gt;
                                        &amp;lt;br&amp;gt;
                                        &amp;lt;span class=&amp;quot;block italic&amp;quot;&amp;gt; &amp;lt;BE3-USER-EMAIL&amp;gt;&amp;lt;/BE3-USER-EMAIL&amp;gt; &amp;lt;/span&amp;gt;
                                    &amp;lt;/p&amp;gt;
                                &amp;lt;/li&amp;gt;
                                &amp;lt;!-- Menu links --&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-PROFIL&amp;gt;&amp;lt;/BE3-LINK-PROFIL&amp;quot;&amp;gt;
                                        Profil
                                    &amp;lt;/a&amp;gt;
                                &amp;lt;/li&amp;gt;
                            
                                
                                &amp;lt;!-- Optional divider --&amp;gt;
                                &amp;lt;li class=&amp;quot;divider&amp;quot;&amp;gt;&amp;lt;/li&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-LOGOUT&amp;gt;&amp;lt;/BE3-LINK-LOGOUT&amp;gt;&amp;quot;&amp;gt;
                                        Logout
                                    &amp;lt;/a&amp;gt;
                                &amp;lt;/li&amp;gt;
                            &amp;lt;/ul&amp;gt;
                        &amp;lt;/details&amp;gt;
                    &amp;lt;/div&amp;gt;
                    &amp;lt;?php }else{?&amp;gt;
                    &amp;lt;div class=&amp;quot;header__right__auth&amp;quot;&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-LOGIN&amp;gt;&amp;lt;/BE3-LINK-LOGIN&amp;gt;&amp;quot;&amp;gt;Login&amp;lt;/a&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-REGISTER&amp;gt;&amp;lt;/BE3-LINK-REGISTER&amp;gt;&amp;quot;&amp;gt;Register&amp;lt;/a&amp;gt;
                                &amp;lt;/div&amp;gt;
                    &amp;lt;?php }?&amp;gt;
        &amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-IMAGE
                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-NAME
                                                                                        )

                                                                                    [2] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-EMAIL
                                                                                        )

                                                                                    [3] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGOUT
                                                                                            [nama_tag] =&gt; NavbarListProfile &gt; LINK-LOGOUT
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; costum_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Auth
                                                                                                    [1] =&gt; logout
                                                                                                    [2] =&gt; -1
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [4] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGIN
                                                                                        )

                                                                                    [5] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-REGISTER
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [BE3-USER-IMAGE] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-IMAGE
                                                                                        )

                                                                                    [BE3-USER-NAME] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-NAME
                                                                                        )

                                                                                    [BE3-USER-EMAIL] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-EMAIL
                                                                                        )

                                                                                    [BE3-LINK-LOGOUT] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGOUT
                                                                                            [nama_tag] =&gt; NavbarListProfile &gt; LINK-LOGOUT
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; costum_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Auth
                                                                                                    [1] =&gt; logout
                                                                                                    [2] =&gt; -1
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [BE3-LINK-LOGIN] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGIN
                                                                                        )

                                                                                    [BE3-LINK-REGISTER] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-REGISTER
                                                                                        )

                                                                                )

                                                                        )

                                                                    [-1] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashin &gt; Navbar &gt; Wishlist
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Icon Wishlist
                                                                            [template_content] =&gt; &amp;lt;!--&amp;lt;li&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK-WISHLIST&amp;gt;&amp;lt;/LINK-WISHLIST&amp;gt;&amp;quot;&amp;gt;&amp;lt;span class=&amp;quot;icon_heart_alt&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;--&amp;gt;
        &amp;lt;!--            &amp;lt;div class=&amp;quot;tip&amp;quot;&amp;gt;&amp;lt;COUNT-WISHLIST&amp;gt;&amp;lt;/COUNT-WISHLIST&amp;gt;&amp;lt;/div&amp;gt;--&amp;gt;
        &amp;lt;!--        &amp;lt;/a&amp;gt;&amp;lt;/li&amp;gt;--&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-WISHLIST
                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-WISHLIST
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [LINK-WISHLIST] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-WISHLIST
                                                                                        )

                                                                                    [COUNT-WISHLIST] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-WISHLIST
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [template_array] =&gt; Array
                                                                (
                                                                )

                                                        )

                                                )

                                            [array] =&gt; Array
                                                (
                                                    [MENU-LIST] =&gt; Array
                                                        (
                                                            [tag] =&gt; MENU-LIST
                                                            [nama_tag] =&gt; Menu List
                                                            [refer] =&gt; menu_list
                                                            [file_menu] =&gt; &amp;lt;li &amp;lt;CLASS-ACTIVE&amp;gt;&amp;lt;/CLASS-ACTIVE&amp;gt;&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK&amp;gt;&amp;lt;/LINK&amp;gt;&amp;quot;&amp;gt;&amp;lt;NAMA-MENU&amp;gt;&amp;lt;/NAMA-MENU&amp;gt;&amp;lt;/a&amp;gt;
            &amp;lt;DROPDOWN&amp;gt;&amp;lt;/DROPDOWN&amp;gt;
        &amp;lt;/li&amp;gt;
                                                            [parameter] =&gt; Array
                                                                (
                                                                    [0] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Home
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; 
                                                                                    [1] =&gt; 
                                                                                    [2] =&gt; 
                                                                                    [3] =&gt; 
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Backend
                                                                                    [8] =&gt; bundles
                                                                                    [9] =&gt; Home
                                                                                )

                                                                        )

                                                                    [1] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Shop
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Ecommerce
                                                                                    [1] =&gt; list
                                                                                    [2] =&gt; view_layout
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [2] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Pesanan Saya
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Ecommerce
                                                                                    [1] =&gt; pesanan_saya
                                                                                    [2] =&gt; list
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; -1
                                                                                    [5] =&gt; -1
                                                                                    [6] =&gt; ID_BOARD|
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [3] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Daftar Mitra
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Workspace
                                                                                    [1] =&gt; daftar_mitra
                                                                                    [2] =&gt; list
                                                                                    [3] =&gt; -1
                                                                                    [4] =&gt; -1
                                                                                    [5] =&gt; -1
                                                                                    [6] =&gt; ID_BOARD|
                                                                                    [7] =&gt; Frontend
                                                                                    [8] =&gt; controller
                                                                                    [9] =&gt; 
                                                                                )

                                                                        )

                                                                    [4] =&gt; Array
                                                                        (
                                                                            [nama_menu] =&gt; Kontak
                                                                            [icon] =&gt; 
                                                                            [link] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; 
                                                                                    [1] =&gt; 
                                                                                    [2] =&gt; 
                                                                                    [3] =&gt; 
                                                                                    [4] =&gt; 
                                                                                    [5] =&gt; 
                                                                                    [6] =&gt; 
                                                                                    [7] =&gt; Backend
                                                                                    [8] =&gt; bundles
                                                                                    [9] =&gt; contact_us
                                                                                )

                                                                        )

                                                                )

                                                        )

                                                    [HEADER-LOGO] =&gt; Array
                                                        (
                                                            [tag] =&gt; HEADER-LOGO
                                                            [nama_tag] =&gt; Ashion &gt; Navbar &gt; Header-Logo 
                                                            [content_source] =&gt; template_database
                                                            [source_list] =&gt; template_database
                                                            [nama_file] =&gt; Ashion &gt; Header Logo
                                                            [template_content] =&gt; &amp;lt;div class=&amp;quot;header__logo&amp;quot;&amp;gt;
            &amp;lt;a href=&amp;quot;&amp;lt;BASE-URL&amp;gt;&amp;lt;/BASE-URL&amp;gt;&amp;quot;&amp;gt;&amp;lt;img src=&amp;quot;&amp;lt;IMAGE-LOGO&amp;gt;&amp;lt;/IMAGE-LOGO&amp;gt;&amp;quot; alt=&amp;quot;&amp;quot; height=&amp;quot;50px&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;
        &amp;lt;/div&amp;gt;
                                                            [refer] =&gt; content_template
                                                            [template_array] =&gt; Array
                                                                (
                                                                    [0] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; IMAGE-LOGO
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; IMAGE-LOGO
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; logo_utama
                                                                        )

                                                                    [1] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; BASE-URL
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; BASE-URL
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; base_url
                                                                        )

                                                                )

                                                            [array] =&gt; Array
                                                                (
                                                                    [IMAGE-LOGO] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; IMAGE-LOGO
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; IMAGE-LOGO
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; logo_utama
                                                                        )

                                                                    [BASE-URL] =&gt; Array
                                                                        (
                                                                            [tag] =&gt; BASE-URL
                                                                            [nama_tag] =&gt; Header &gt; Header-Logo &gt; BASE-URL
                                                                            [refer] =&gt; tipe_header
                                                                            [tipe_header] =&gt; base_url
                                                                        )

                                                                )

                                                        )

                                                    [HEADER-LIST] =&gt; Array
                                                        (
                                                            [tag] =&gt; HEADER-LIST
                                                            [nama_tag] =&gt; Ashion &gt; Header List 
                                                            [refer] =&gt; dropdown
                                                            [dropdown] =&gt; Array
                                                                (
                                                                    [1] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Button Search
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Button Search
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;
            &amp;lt;!--&amp;lt;span class=&amp;quot;icon_search search-switch&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;--&amp;gt;
                &amp;lt;form action=&amp;quot;#&amp;quot;&amp;gt;
                    
                &amp;lt;div class=&amp;quot;search-be3&amp;quot;&amp;gt;
        &amp;lt;!--            &amp;lt;select id=&amp;quot;searchType&amp;quot; name=&amp;quot;searchType&amp;quot;&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;option value=&amp;quot;1&amp;quot;&amp;gt;Search in books&amp;lt;/option&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;option value=&amp;quot;2&amp;quot;&amp;gt;Search in videos&amp;lt;/option&amp;gt;--&amp;gt;
        &amp;lt;!--&amp;lt;/select&amp;gt;--&amp;gt;
            
            &amp;lt;input type=&amp;quot;text&amp;quot; name=&amp;quot;searchInput&amp;quot; placeholder=&amp;quot;Search...&amp;quot;&amp;gt;
            &amp;lt;button&amp;gt;&amp;lt;i class=&amp;quot;fa-solid fa-magnifying-glass&amp;quot;&amp;gt;&amp;lt;/i&amp;gt;&amp;lt;/button&amp;gt;
                &amp;lt;/form&amp;gt;
        &amp;lt;/div&amp;gt;
        

        &amp;lt;style&amp;gt;
                    .search-be3{
        
            border: 1px solid rgb(255, 255, 255);
            border-radius: 15px;
            
            align-items: center;
            padding: 5px;
            background: white;  border: 1px solid rgba(0, 0, 0, 0.35);
        }
            .search-be3 select {
                padding: 0;
                border: none;
                outline: none;
                cursor: pointer;
                background: transparent;
            }
        .search-be3 input{
        
            padding: 0;
            border: none;
            outline:none;
            margin-left: 10px;

        }
        .search-be3 button{
            padding: 0;
            border: none;
            outline:none;
            font-size: 25px;
            margin: auto;
            margin-right: 0;
            color: rgb(139, 139, 139);
            background: white;

        }
        @media only screen and (max-width: 600px) {
            .search-be3 {
                width: 100%;
                flex-wrap: wrap;
            }
            .search-be3 select {
                width: 100%;
            }
        }
        &amp;lt;/style&amp;gt;
            &amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                )

                                                                        )

                                                                    [2] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Navbar &gt; Cart
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Asion &gt; Icon Cart
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK-CART&amp;gt;&amp;lt;/LINK-CART&amp;gt;&amp;quot;&amp;gt;&amp;lt;span class=&amp;quot;icon_bag_alt&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;
                    &amp;lt;div class=&amp;quot;tip&amp;quot;&amp;gt; &amp;lt;COUNT-CART&amp;gt;&amp;lt;/COUNT-CART&amp;gt; &amp;lt;/div&amp;gt;
                &amp;lt;/a&amp;gt;&amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-CART
                                                                                            [nama_tag] =&gt; Link CArt
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; just_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Ecommerce
                                                                                                    [1] =&gt; cart
                                                                                                    [2] =&gt; view_layout
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-CART
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [LINK-CART] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-CART
                                                                                            [nama_tag] =&gt; Link CArt
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; just_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Ecommerce
                                                                                                    [1] =&gt; cart
                                                                                                    [2] =&gt; view_layout
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [COUNT-CART] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-CART
                                                                                        )

                                                                                )

                                                                        )

                                                                    [3] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashion &gt; Profile &amp; login
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Profil &amp; login
                                                                            [template_content] =&gt; &amp;lt;li&amp;gt;
            &amp;lt;?php 
            $login=false;
            if(isset($_SESSION[&amp;#039;is_login&amp;#039;])){
                if($_SESSION[&amp;#039;is_login&amp;#039;]==1){
                    $login=true;
                }
            }
            if($login){
            ?&amp;gt;
            
            &amp;lt;div class=&amp;quot;dropdown-container-be3&amp;quot;&amp;gt;
                        &amp;lt;details class=&amp;quot;dropdown right&amp;quot;&amp;gt;
                            &amp;lt;summary class=&amp;quot;avatar&amp;quot;&amp;gt;
                                &amp;lt;img src=&amp;quot;&amp;lt;BE3-USER-IMAGE&amp;gt;&amp;lt;/BE3-USER-IMAGE&amp;gt;&amp;quot;&amp;gt;
                            &amp;lt;/summary&amp;gt;
                            &amp;lt;ul&amp;gt;
                                &amp;lt;!-- Optional: user details area w/ gray bg --&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;p&amp;gt;
                                        &amp;lt;span class=&amp;quot;block bold&amp;quot;&amp;gt; &amp;lt;BE3-USER-NAME&amp;gt;&amp;lt;/BE3-USER-NAME&amp;gt; &amp;lt;/span&amp;gt;
                                        &amp;lt;br&amp;gt;
                                        &amp;lt;span class=&amp;quot;block italic&amp;quot;&amp;gt; &amp;lt;BE3-USER-EMAIL&amp;gt;&amp;lt;/BE3-USER-EMAIL&amp;gt; &amp;lt;/span&amp;gt;
                                    &amp;lt;/p&amp;gt;
                                &amp;lt;/li&amp;gt;
                                &amp;lt;!-- Menu links --&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-PROFIL&amp;gt;&amp;lt;/BE3-LINK-PROFIL&amp;quot;&amp;gt;
                                        Profil
                                    &amp;lt;/a&amp;gt;
                                &amp;lt;/li&amp;gt;
                            
                                
                                &amp;lt;!-- Optional divider --&amp;gt;
                                &amp;lt;li class=&amp;quot;divider&amp;quot;&amp;gt;&amp;lt;/li&amp;gt;
                                &amp;lt;li&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-LOGOUT&amp;gt;&amp;lt;/BE3-LINK-LOGOUT&amp;gt;&amp;quot;&amp;gt;
                                        Logout
                                    &amp;lt;/a&amp;gt;
                                &amp;lt;/li&amp;gt;
                            &amp;lt;/ul&amp;gt;
                        &amp;lt;/details&amp;gt;
                    &amp;lt;/div&amp;gt;
                    &amp;lt;?php }else{?&amp;gt;
                    &amp;lt;div class=&amp;quot;header__right__auth&amp;quot;&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-LOGIN&amp;gt;&amp;lt;/BE3-LINK-LOGIN&amp;gt;&amp;quot;&amp;gt;Login&amp;lt;/a&amp;gt;
                                    &amp;lt;a href=&amp;quot;&amp;lt;BE3-LINK-REGISTER&amp;gt;&amp;lt;/BE3-LINK-REGISTER&amp;gt;&amp;quot;&amp;gt;Register&amp;lt;/a&amp;gt;
                                &amp;lt;/div&amp;gt;
                    &amp;lt;?php }?&amp;gt;
        &amp;lt;/li&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-IMAGE
                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-NAME
                                                                                        )

                                                                                    [2] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-EMAIL
                                                                                        )

                                                                                    [3] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGOUT
                                                                                            [nama_tag] =&gt; NavbarListProfile &gt; LINK-LOGOUT
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; costum_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Auth
                                                                                                    [1] =&gt; logout
                                                                                                    [2] =&gt; -1
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [4] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGIN
                                                                                        )

                                                                                    [5] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-REGISTER
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [BE3-USER-IMAGE] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-IMAGE
                                                                                        )

                                                                                    [BE3-USER-NAME] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-NAME
                                                                                        )

                                                                                    [BE3-USER-EMAIL] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-USER-EMAIL
                                                                                        )

                                                                                    [BE3-LINK-LOGOUT] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGOUT
                                                                                            [nama_tag] =&gt; NavbarListProfile &gt; LINK-LOGOUT
                                                                                            [refer] =&gt; link
                                                                                            [route_type] =&gt; costum_link
                                                                                            [link] =&gt; Array
                                                                                                (
                                                                                                    [0] =&gt; Auth
                                                                                                    [1] =&gt; logout
                                                                                                    [2] =&gt; -1
                                                                                                    [3] =&gt; -1
                                                                                                )

                                                                                        )

                                                                                    [BE3-LINK-LOGIN] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-LOGIN
                                                                                        )

                                                                                    [BE3-LINK-REGISTER] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; BE3-LINK-REGISTER
                                                                                        )

                                                                                )

                                                                        )

                                                                    [-1] =&gt; Array
                                                                        (
                                                                            [nama_tag] =&gt; Ashin &gt; Navbar &gt; Wishlist
                                                                            [content_source] =&gt; template_database
                                                                            [source_list] =&gt; template_database
                                                                            [nama_file] =&gt; Ashion &gt; Icon Wishlist
                                                                            [template_content] =&gt; &amp;lt;!--&amp;lt;li&amp;gt;&amp;lt;a href=&amp;quot;&amp;lt;LINK-WISHLIST&amp;gt;&amp;lt;/LINK-WISHLIST&amp;gt;&amp;quot;&amp;gt;&amp;lt;span class=&amp;quot;icon_heart_alt&amp;quot;&amp;gt;&amp;lt;/span&amp;gt;--&amp;gt;
        &amp;lt;!--            &amp;lt;div class=&amp;quot;tip&amp;quot;&amp;gt;&amp;lt;COUNT-WISHLIST&amp;gt;&amp;lt;/COUNT-WISHLIST&amp;gt;&amp;lt;/div&amp;gt;--&amp;gt;
        &amp;lt;!--        &amp;lt;/a&amp;gt;&amp;lt;/li&amp;gt;--&amp;gt;
                                                                            [refer] =&gt; content_template
                                                                            [template_array] =&gt; Array
                                                                                (
                                                                                    [0] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-WISHLIST
                                                                                        )

                                                                                    [1] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-WISHLIST
                                                                                        )

                                                                                )

                                                                            [array] =&gt; Array
                                                                                (
                                                                                    [LINK-WISHLIST] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; LINK-WISHLIST
                                                                                        )

                                                                                    [COUNT-WISHLIST] =&gt; Array
                                                                                        (
                                                                                            [tag] =&gt; COUNT-WISHLIST
                                                                                        )

                                                                                )

                                                                        )

                                                                )

                                                            [template_array] =&gt; Array
                                                                (
                                                                )

                                                        )

                                                )

                                        )

                                )

                        )

                )

        )
        </div>';
        $fai = new MainFaiFramework();
        echo '<textarea>' . $fai->html_decode([], [], '', $text) . '</textarea>';
    }
}
