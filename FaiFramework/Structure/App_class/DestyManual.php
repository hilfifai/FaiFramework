<?php
defined('BASEPATH') or exit('No direct script access allowed');
defined('BASEPATH') or exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DestyManual
{

    public static function upload_excel($page)
    {
        $upload_path = './uploads/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $file = $_FILES['excel_file'];
        $allowed_extensions = ['xls', 'xlsx'];
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_extensions)) {
            $new_filename = date('Ymdhis') . '.' . $file_extension;
            $destination = $upload_path . $new_filename;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'File berhasil diupload.',
                    'file_name' => $new_filename,
                    'file_path' => base_url('uploads/' . $new_filename)
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal memindahkan file ke server.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Format file tidak diizinkan (hanya .xls atau .xlsx).'
            ]);
        }
    }
    public static function proses_data_excel_to_database($page)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 300);

        // ==== Config Manual Database (FLEKSIBEL) ====
        $db_type = DATABASE_PROVIDER; // Ganti ke 'pgsql' kalau pakai PostgreSQL
        $host = CONECTION_SERVER;
        $user = CONECTION_USER;
        $pass = CONECTION_PASSWORD;
        $db_name = CONECTION_NAME_DATABASE;
        $table_name = 'desty_export_data';
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';

        $page['load']['type'] = 'tambah';

        $domain = $page['load']['domain'];
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
                // $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
            } elseif ($db_type === 'pgsql') {
                //$pdo->exec("CREATE DATABASE \"$db_name\""); // Jika gagal karena sudah ada, bisa diabaikan atau pakai try-catch
            }

            // ==== Koneksi ke database baru ====pg_catalog
            $dsn_db = $dsn . "dbname=$db_name";
            $pdo = new PDO($dsn_db, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $name_file = Partial::input('name');
            function primary_key($type)
            {
                $sql = "";
                if ($type == 'mysql') {
                    $sql = "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
                } else {
                    $sql = '"id" SERIAL PRIMARY KEY,';
                }
                return $sql;
            }
            $idp = primary_key($page['database_provider']);
            $create_sql = 'CREATE TABLE IF NOT EXISTS desty_export_data__excel (
                ' . $idp . '
                nama_file varchar(255) DEFAULT NULL,
                create_date date DEFAULT NULL,
                create_by numeric DEFAULT NULL,
                timezone varchar(255) DEFAULT NULL,
                on_domain varchar(255) DEFAULT NULL,
                on_web_apps varchar(255) DEFAULT NULL,
                on_panel varchar(255) DEFAULT NULL
                );
             
CREATE TABLE IF NOT EXISTS desty_export_data__excel__baris (
  ' . $idp . '
  id_desty_export_data__excel numeric(65) DEFAULT NULL,
  id_desty_export_data numeric(65) DEFAULT NULL,
  status_generate numeric(65) DEFAULT 0,
  create_date date DEFAULT NULL,
  create_by numeric DEFAULT NULL,
  timezone varchar(255) DEFAULT NULL,
  on_domain varchar(255) DEFAULT NULL,
  on_web_apps varchar(255) DEFAULT NULL,
  on_panel varchar(255) DEFAULT NULL
)
;

-- ----------------------------
-- Table structure for desty_export_data__proses_generate
-- ----------------------------
CREATE TABLE IF NOT EXISTS desty_export_data__proses_generate (
 ' . $idp . '
  id_desty_export_data numeric(65) DEFAULT NULL,
  generate_by varchar(255) DEFAULT NULL,
  content_generate text DEFAULT NULL,
  status_generate numeric(65) DEFAULT NULL,
  id_shoepee_export_data__excel numeric(65) DEFAULT NULL,
  create_date date DEFAULT NULL,
  create_by numeric DEFAULT NULL,
  timezone varchar(255) DEFAULT NULL,
  on_domain varchar(255) DEFAULT NULL,
  on_web_apps varchar(255) DEFAULT NULL,
  on_panel varchar(255) DEFAULT NULL,
  offset_generate numeric(65) DEFAULT 0
)
;

-- ----------------------------
-- Primary Key structure for table desty_export_data__excel__baris
-- ----------------------------
            ';

            $pdo->exec($create_sql);
            $page['section'] = 'page';
            $tipe_varian = [];
            $tipe_varian['nama_file'] = "$name_file";
            $id_shopee = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'desty_export_data__excel');
            DB::table("desty_export_data__excel");
            DB::whereRaw("nama_file='" . $name_file . "'");
            $get_asset = DB::get('all');
            $id_shopee = $get_asset['row'][0]->id;

            // ==== Baca file Excel ====
            // http://localhost/frameworkServer_v1/uploads/691920199586ca8350c25e579daa3bfe.xlsx
            ob_start();
            $file_path = './uploads/' . $name_file; // Ganti sesuai upload
            $spreadsheet = IOFactory::load($file_path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);
            ob_clean();
            $columns_temp = array_map('trim', $rows[1]);
            $column_keys = array_keys($columns_temp);

            // ==== Buat tabel jika belum ada ====
            $fields_sql = [];
            $columns = [];
            foreach ($columns_temp as $key => $col) {
                $col = strtolower($col);
                $col = str_ireplace(' ', '_', $col);
                $col = str_ireplace('-', '_', $col);
                $col = str_ireplace('(', '', $col);
                $col = str_ireplace(')', '', $col);
                $col = str_ireplace('/', '_', $col);
                if ($col)
                    $columns[$key] = $col;
            }
            foreach ($columns as $col) {
                $col = strtolower($col);
                $col = str_ireplace(' ', '_', $col);
                $col = str_ireplace('-', '_', $col);
                $col = str_ireplace('(', '', $col);
                $col = str_ireplace(')', '', $col);
                $col = str_ireplace('/', '_', $col);
                if ($col and !in_array("$col TEXT", $fields_sql))
                    $fields_sql[] = "$col TEXT";
            }
            $unique_key = $columns[$column_keys[0]];

            $create_sql = "CREATE TABLE IF NOT EXISTS $table_name (
                $idp
                generate_stok int(11),
                status_stok int(11),
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
                        $col = strtolower($col);
                        $col = str_ireplace(' ', '_', $col);
                        echo "ALTER TABLE $table_name ADD COLUMN $col TEXT";
                        // $pdo->exec("ALTER TABLE \"$table_name\" ADD COLUMN \"$col\" TEXT");
                    }
                }
            }

            // ==== Masukkan / update data ====
            if (1) {

                for ($i = 3; $i <= count($rows); $i++) {
                    $row_data = $rows[$i];
                    $data = [];
                    foreach ($columns as $key => $col_name) {


                        $val = isset($row_data[$key]) ? $row_data[$key] : '';
                        $data[$col_name] = $val;
                    }

                    $where_field = "id_produk";

                    $where_value = $data[$where_field];

                    // Cek apakah data sudah ada
                    echo "SELECT * FROM $table_name WHERE $where_field = '$where_value' LIMIT 1";
                    $stmt = $pdo->prepare("SELECT * FROM $table_name WHERE $where_field = '$where_value' LIMIT 1");
                    $stmt->execute();
                    $exists = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($exists) {
                        // UPDATE
                        $update_fields = [];
                        $update_fields[] = "tersedia = '" . $data['tersedia'] . "'";
                        $update_fields[] = "sku_master = '" . $data['sku_master'] . "'";
                        // foreach ($data as $key => $val) {
                        //     $update_fields[] = "$key = :$key";
                        // }
                        echo $sql = "UPDATE $table_name SET " . implode(', ', $update_fields) . ",generate_stok=0 WHERE $where_field = '$where_value'";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                    } else {
                        // INSERT
                        echo 'insert' . $data['nama_produk'];
                        $keys = array_keys($data);
                        $placeholders = array_map(fn($k) => ":$k", $keys);
                        $sql = "INSERT INTO $table_name (" . implode(', ', $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($data);
                    }
                    $baris = [];
                    DB::table($table_name);
                    DB::whereRaw("id_produk='" . $data['id_produk'] . "'");
                    $get_asset = DB::get('all');
                    if ($get_asset['num_rows']) {
                        $baris['id_desty_export_data'] = $get_asset['row'][0]->id;
                        $baris['id_desty_export_data__excel'] = $id_shopee;
                        $baris['status_generate'] = 0;
                        CRUDFunc::crud_insert($fai, $page, $baris, [], 'desty_export_data__excel__baris');
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
                'line' => $e->getLine(),
                'message' => 'Database Error: ' . $e->getMessage()
            ]);
            echo '<pre>';
            print_R($e->getTraceAsString());
        }
    }
    public static function desty_data_to_inventaris($page)
    {
        try {
            $fai = new MainFaiFramework();

            $segments = Partial::uri_segment();
            //$all = menu / class/function
            $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
            if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

                $domain = $fai->input('frameworksubdomain');
            } else
                $domain = $_SERVER['HTTP_HOST'];
            if (!$type_load) {
                $type_load = $segments[1]  ? $segments[1] : "";
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
            $page['section'] = 'page';

            DB::connection($page);
            $page['web_load_function'] = $type_load;
            $page['load_section'] = "pages";
            $page['load']['login-session-utama']['session_name'] = "id_apps_user";

            $page['load_section'] = "page";

            //$page = $fai->LoadApps($page, $domain, -1, 'page');

            // array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
            // array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),
            $nama_gudang = "Desty";
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

            $detailFromSheet = [];
            DB::table('desty_export_data');
            DB::whereRaw('id not in (select id_desty_manual from inventaris__asset__list__varian where id_desty_manual is not null)');
            DB::orderRaw($page, 'nama_produk asc');
            $data = DB::get('all');

            if ($data['num_rows']) {
                foreach ($data['row'] as  $row) {

                    if (1 == 1) {

                        if ($row->nama_varian != 'Nama Varian') {
                            foreach (explode('/', $row->nama_varian) as $key => $list_var) {

                                $list_var = trim($list_var);
                                DB::table('inventaris__master__tipe_varian__list');
                                DB::whereRaw("nama_list_tipe_varian='" . trim($list_var) . "'");
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
                                    foreach ($tipe_varian as $tk => $vk) {
                                        $va = $insert[$tk] = Database::string_database($page, $fai, $vk);
                                        $dbvar['where'][] = ["inventaris__master__tipe_varian__list.$tk", "=", "'$va'"];
                                    }
                                    $dbvar['utama'] = "inventaris__master__tipe_varian__list";
                                    $dbvar['np'] = "inventaris__asset__list";
                                    $get_allvar = Database::database_coverter($page, $dbvar, [], 'all');
                                    if ($get_allvar['num_rows']) {
                                        $id_varian[$key] = $get_allvar['row'][0]->id;
                                    } else {
                                        $id_varian[$key] = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__master__tipe_varian__list');
                                    }
                                }
                            }

                            $data_varian = [];

                            $data_varian['id_tipe_varian_1'] = $id_tipe_varian[0] ?? -1;
                            $data_varian['id_varian_1'] = $id_varian[0] ?? -1;
                            $data_varian['id_tipe_varian_2'] = $id_tipe_varian[1] ?? -1;
                            $data_varian['id_varian_2'] = $id_varian[1] ?? -1;
                            $data_varian['id_tipe_varian_3'] = $id_tipe_varian[2] ?? -1;

                            $data_varian['id_varian_3'] = $id_varian[2] ?? -1;
                            $data_varian['id_desty_manual'] = $row->id;
                            $data_varian['kode_varian'] = $row->id_produk;
                            $data_varian['nama_varian'] = $row->nama_varian;
                            $data_varian['sku_index_varian'] = $row->sku_master;
                            $data_varian['harga_pokok_penjualan_varian'] = str_ireplace('.', '', $row->harga_produk);
                            $data_varian['asal_from_data_varian'] = "Desty - Manual";


                            print_R($data_varian);

                            DB::table('inventaris__asset__list__varian');
                            foreach ($data_varian as $key_varian => $value_varian) {
                                if (!$value_varian) {
                                } else if (in_array($key_varian, ['asal_from_data_varian', "jubelio_item_code", 'kode_varian', 'foto_aset', 'nama_varian', 'sku_index_varian'])) {
                                    DB::whereRaw("$key_varian='$value_varian'");
                                } else
                                    DB::whereRaw("$key_varian=$value_varian");
                            }
                            $getAda = DB::get('all');
                            if (!$getAda['num_rows']) {
                                //jadi kalau ga ada mah baru create inventaris
                                $insert = [];

                                $insert['nama_barang'] = $row->nama_produk;
                                $insert['jenis_barang'] = "Barang Jadi";
                                $insert['id_jenis_asset'] = "4";
                                $insert['jual_aset_barang'] = "Ya";
                                $insert['varian_barang'] = 1;
                                $insert['id_panel'] = -1;
                                $insert['asal_barang_dari'] = "Desty - Manual";
                                $insert['is_master'] = 1;
                                // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; 
                                // $insert['id_toko'] = "WORKSPACE_SINGLE_TOKO|"; //toko

                                // print_R($insert);
                                $db = [];
                                foreach ($insert as $tk => $vk) {
                                    $va = $insert[$tk] = Database::string_database($page, $fai, $vk);
                                    DB::whereRaw("inventaris__asset__list.$tk" . "=" . "'$va'");
                                }


                                DB::table("inventaris__asset__list");
                                $db['np'] = "inventaris__asset__list";
                                $get_all = DB::get('all');


                                $total = 0;
                                $list = [];


                                if ($get_all['num_rows']) {
                                    $last_id_utama = $get_all['row'][0]->id;
                                } else {
                                    $total++;
                                    $list[] = "inventaris__asset__list-><BR> (" . $get_all['query'] . ")<BR>";
                                    $last_id_utama = CRUDFunc::crud_insert($fai, $page, $insert, [], 'inventaris__asset__list');
                                }
                                $data_varian['id_inventaris__asset__list'] = $last_id_utama;
                                echo 'is TIDAK ADA';
                                $last_id_varian = CRUDFunc::crud_insert($fai, $page, $data_varian, [], 'inventaris__asset__list__varian');
                            } else {
                                $last_id_varian = $getAda['row'][0]->id;
                                echo 'is ADA';
                                DB::update("inventaris__asset__list__varian", $data_varian, ["id=$last_id_varian"]);
                            }
                            echo '<br><Br>';
                            $get_stok = str_ireplace('.', '', $row->tersedia);

                            $get_system_stok = 0;
                            $detail = [];
                            $detail['id_asset'] = $last_id_utama;
                            $detail['id_asset_varian'] = $last_id_varian;
                            $detail['data_stok'] = (int) $get_system_stok;
                            $detail['data_real'] = (int) $get_stok;
                            $detail['selisih'] = (int) $get_stok - $get_system_stok;
                            $detail['id_erp__pos__stok_opname'] = $last_id;
                            CRUDFunc::crud_insert($fai, $page, $detail, [], 'erp__pos__stok_opname__detail');
                            $storage = [];
                            $storage['id_gudang'] = $id_gudang;
                            $storage['id_ruang_simpan'] = $id_ruang_simpan;
                            $storage['id_asset'] = $last_id_utama;
                            $storage['id_asset_varian'] =  $last_id_varian;
                            $dbst['utama'] = 'inventaris__storage__data';
                            $dbst['np'] = 'inventaris__storage__data';
                            foreach ($storage as $tk => $vk) {

                                $dbst['where'][] = ["inventaris__storage__data.$tk", "=", "$vk"];
                            }
                            $dbst['where'][] = ["inventaris__storage__data.id_produk", " is ", "null"];
                            $dbst['where'][] = ["inventaris__storage__data.id_produk_varian", " is ", "null"];
                            // $storage['id_produk'] = null;
                            // $storage['id_produk_varian'] = null;
                            $storage['stok_onhand'] = $get_stok;
                            $get_allb = Database::database_coverter($page, $dbst, [], 'all');
                            if (!$get_allb['num_rows']) {
                                CRUDFunc::crud_insert($fai, $page, $storage, [], 'inventaris__storage__data');
                            } else {
                                $laststorage = $get_allb['row'][0]->id;

                                DB::update("inventaris__storage__data", $storage, ["id=$laststorage"]);
                            }
                        }
                    }
                }
            }
        } catch (PDOException $e) {

            echo json_encode([
                'status' => 'error',
                'line' => $e->getLine(),
                'message' => 'Database Error: ' . $e->getMessage()
            ]);
            echo '<pre>';
            print_R($e->getTraceAsString());
        }
    }
    public static function manual_produk_sync_utama($page)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        
        $domain = $page['load']['domain'] ;
        $page['load']['type'] = 'tambah';

       
        $page['is_login'] = 0;
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');

        // array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
        // array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),
        // $nama_gudang = "desty";
        // $nama_ruang_simpan = "Manual";
        // DB::table('inventaris__asset__tanah__gudang');
        // DB::whereRaw("nama_gudang='$nama_gudang'");
        // $get_tipe = DB::get('all');
        // if ($get_tipe['num_rows']) {
        //     $id_gudang = $get_tipe['row'][0]->id;
        // } else {
        //     $tipe_varian = [];
        //     $tipe_varian['nama_gudang'] = "$nama_gudang";
        //     CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang');

        //     DB::table('inventaris__asset__tanah__gudang');
        //     DB::whereRaw("nama_gudang='$nama_gudang'");
        //     $get_tipe = DB::get('all');
        //     $id_gudang = $get_tipe['row'][0]->id;
        // }
        // DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        // DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
        // DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
        // $get_tipe = DB::get('all');
        // if ($get_tipe['num_rows']) {
        //     $id_ruang_simpan = $get_tipe['row'][0]->id;
        // } else {
        //     $tipe_varian = [];
        //     $tipe_varian['nama_ruang_simpan'] = "$nama_ruang_simpan";
        //     $tipe_varian['id_inventaris__asset__tanah__gudang'] = $id_gudang;
        //     $id_tipe_varian1 = CRUDFunc::crud_insert($fai, $page, $tipe_varian, [], 'inventaris__asset__tanah__gudang__ruang_bangun');

        //     DB::table('inventaris__asset__tanah__gudang__ruang_bangun');
        //     DB::whereRaw("id_inventaris__asset__tanah__gudang=$id_gudang");
        //     DB::whereRaw("nama_ruang_simpan='$nama_ruang_simpan'");
        //     $get_tipe = DB::get('all');
        //     $id_ruang_simpan = $get_tipe['row'][0]->id;
        // }



        DB::table('inventaris__asset__list');
        DB::whereRaw("klasifikasi_produk != 'Per Barang'  ORDER BY nama_barang");
        $get_sarimbit = DB::get('all');
        DB::selectRaw('*, inventaris__asset__list.id as primary_key');
        DB::table('inventaris__asset__list');
        DB::whereRaw("asal_barang_dari='Desty - Manual'");
        DB::whereRaw("nama_barang not like '%GB%'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is null");
        DB::joinRaw("inventaris__asset__list__detail on inventaris__asset__list.id=inventaris__asset__list__detail.id_inventaris__asset__list", "left");
        DB::limitRaw($page, 0); //id_varian_1
        $get_asset = DB::get('all');
        $no = 0;
        echo '<table border=1>
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
        echo '<form action="' . base_url() . 'DestyStokManual/update_connect_barang" method="post">';
        function ambil4KataPertama($input)
        {
            // Pisahkan string menjadi array kata-kata berdasarkan spasi
            $words = preg_split('/\s+/', $input);

            // Ambil 4 kata pertama
            $first4Words = array_slice($words, 0, 4);

            // Gabungkan kembali menjadi string
            return implode(' ', $first4Words);
        }
        function sugest($input)
        {
            $input = strtolower($input);
            $keywords = ['elfa', 'ziya', 'rainami', 'Mikhayla', 'eksis', 'royal', 'tenara', 'prime', 'ayumi', 'yui', 'ladiva', 'ishami', 'nara', 'aluna', 'kagumi', 'kahfi', 'couple', 'naomi', 'aluna', 'masami', 'elemental', 'namira', 'megumi', 'sasha'];
            foreach ($keywords as $keyword) {
                if (stripos($input, $keyword) !== false) {
                    // Langkah 2: Cari "sarimbit" atau "baju" setelah ditemukan keyword
                    $input = str_ireplace('Couple Pasangan', '', $input);
                    $input = str_ireplace('Ladiva Keluarga', '', $input);
                    $input = str_ireplace('Royal Keluarga', 'Royal', $input);
                    $input = str_ireplace('Royal Royal', 'Royal', $input);
                    $input = str_ireplace('RoyalRoyal', 'Royal', $input);
                    $input = str_ireplace('Series', '', $input);
                    $input = str_ireplace('Couple Sarimbit', 'Couple ', $input);
                    $input = str_ireplace('/', '', $input);
                    $input = str_ireplace('  ', '', $input);
                    $input = str_ireplace('  ', '', $input);
                    $input = str_ireplace(' Shadowindigocoffeeredsage Green', '', $input);
                    $input = substr($input, stripos($input, $keyword));
                    $input = str_ireplace(["Bay Seply//", 'By Seply//', 'Ethica', '/gamis/koko/', 'terbaru', ' By ', 'Square Hijab', 'Square Motif', 'segiempat', 'Gamiskokogamis Anakkoko Anak', 'Muslim', 'atasan', 'Hijab Square', ' Atasan Wanita', 'Dress', 'Atasan', 'Muslim', 'Series', '2025', '2024', 'Blazzer', '/', 'Atasan Muslim', 'Shadowindigocoffeeredsage Green', '  ', '  '], '', $input);
                    if (strpos($input, ',') !== false) {
                        // Ambil bagian sebelum koma pertama
                        $input = substr($input, 0, strpos($input, ','));
                    } else {
                        // Jika tidak ada koma, ambil seluruh string
                        $input = $input;
                    }
                    if (strpos($input, '(') !== false) {
                        // Ambil bagian sebelum koma pertama
                        $input = substr($input, 0, strpos($input, '('));
                    } else {
                        // Jika tidak ada koma, ambil seluruh string
                        $input = $input;
                    }
                    $words = explode(' ', trim(strtoupper($input)));
                    if (in_array($words[0], ['AYUMI', 'YUI', 'RAINAMI', 'ISHAMI', 'NAMIRA', 'MIKHAYLA'])) {
                        $input = implode(' ', array_slice($words, 0, 2));
                    }
                    if (in_array($words[0], ['ZIYA'])) {
                        $input = implode(' ', array_slice($words, 0, 3));
                    }

                    $input = str_ireplace('  ', '', $input);
                    $input = str_ireplace('  ', '', $input);
                    $posSarimbit = stripos($input, 'sarimbit');
                    $posBaju = stripos($input, 'baju');

                    // Tentukan posisi minimum antara "sarimbit" dan "baju" jika ada
                    $endPos = min($posSarimbit === false ? PHP_INT_MAX : $posSarimbit, $posBaju === false ? PHP_INT_MAX : $posBaju);

                    // Jika ditemukan posisi, potong string sampai titik tersebut
                    if ($endPos !== PHP_INT_MAX) {
                        return substr($input, 0, $endPos);
                    } else {
                        // Jika tidak ditemukan "sarimbit" atau "baju", ambil 4 kata pertama
                        return ambil4KataPertama($input);
                    }
                }
            }

            // Jika tidak ada keyword ditemukan, ambil 4 kata pertama
            return ambil4KataPertama($input);
        }
        function replace($string)
        {
            $string = str_ireplace('(ANAK)', '', $string);
            $string = str_ireplace('  ', ' ', $string);
            return trim($string);
        }
        foreach ($get_asset['row'] as $asset) {
            $no++;

            $suggest = trim(str_ireplace(["Bay Seply//", 'By Seply//', 'Ethica', 'TUnik', '/sarimbit', '/gamis/koko/', 'Gamis', 'seply', 'terbaru', ' By ', ' Atasan Wanita', 'Dress'], '', ucwords(sugest($asset->nama_barang))));
            echo "<tr>
                <td>$no </td>
                <td>$asset->nama_barang </td>
                <td>$suggest </td>
                <td><select name='asset[$asset->primary_key]' class='js-example-basic-single'>
                <option value=''>-PILIH-</option>
                <option value='-1'>BUKAN PRODUK ETHICA - BIARKAN STOK</option>
                <option value='-2'>PRODUK ETHICA - Kosongkan STOK</option>
                ";
            foreach ($get_sarimbit['row'] as $sarimbit) {
                echo '<option value="' . $sarimbit->id . '" ' . ($asset->id_barang_master == $sarimbit->id ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($suggest) ? 'selected' : '')) . '>' . $sarimbit->nama_barang . '</option>';
            }
            echo "</select> </td>
            <td>
            <a href='" . base_url() . "DestyStokManual/sync_sarimbit_ethica/$suggest'>Sync Sarimbit</a>
            <a href='" . base_url() . "DestyStokManual/sync_artikel_ethica/$suggest'>Sync Artikel</a>
            </td>
            </tr>";
        }

        echo ' </tbody></table>
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- jQuery -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
							$(".js-example-basic-single").select2();
						  });
</script>
        ';
    }
    public static function manual_produk_sync_varian($page)
    {

        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];
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
        $page['section'] = 'pages';
        DB::connection($page);
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";
        $page['section'] = "page";
        $page = $fai->LoadApps($page, $domain, -1, 'page');
        echo '<form action="' . base_url() . 'DestyStokManual/update_connect_barang_varian" method="post">';
        $no = 0;
        DB::selectRaw('inventaris__asset__list.*,inventaris__asset__list.id as primary_to_key,inventaris__asset__list__varian.id as id_varian,inventaris__asset__list__varian.nama_varian,inventaris__asset__list.id as id_inventaris__asset__list,v1.nama_tipe as v1_nama_tipe,v2.nama_tipe as v2_nama_tipe,v3.nama_tipe as v3_nama_tipe,vl1.nama_list_tipe_varian as vl1_nama_list_tipe_varian,vl2.nama_list_tipe_varian as vl2_nama_list_tipe_varian,vl3.nama_list_tipe_varian as vl3_nama_list_tipe_varian,konek.nama_barang as nama_barang_konek,inventaris__asset__list__varian.id_asset_list_varian,inventaris__asset__list.kode_barang,kode_varian');
        DB::table('inventaris__asset__list');
        if ($_GET['is_lebih'] ?? 'F' == 'T') {
            DB::whereRaw("inventaris__asset__list__varian.id>=" . $_GET['last']);
        }
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
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
        $start = 100;
        if (isset($_GET['offset']) and isset($_GET['limit'])) {
            $start = $_GET['offset'];
            DB::limitRaw($page, $_GET['offset'], $_GET['limit']); //id_varian_1

        } elseif (isset($_GET['offset'])) {
            $start = $_GET['offset'];
            DB::limitRaw($page, $_GET['offset'], 100); //id_varian_1

        } else
            DB::limitRaw($page, 50); //id_varian_1
        DB::orderRaw($page, 'nama_barang, inventaris__asset__list__varian.nama_varian asc');
        $get_sarimbit = DB::get('all');




        if (!$get_sarimbit['num_rows']) {
            DB::selectRaw('inventaris__asset__list.*,inventaris__asset__list.id as primary_to_key,inventaris__asset__list__varian.id as id_varian,inventaris__asset__list__varian.nama_varian,inventaris__asset__list.id as id_inventaris__asset__list,v1.nama_tipe as v1_nama_tipe,v2.nama_tipe as v2_nama_tipe,v3.nama_tipe as v3_nama_tipe,vl1.nama_list_tipe_varian as vl1_nama_list_tipe_varian,vl2.nama_list_tipe_varian as vl2_nama_list_tipe_varian,vl3.nama_list_tipe_varian as vl3_nama_list_tipe_varian,konek.nama_barang as nama_barang_konek,inventaris__asset__list__varian.id_asset_list_varian,inventaris__asset__list.kode_barang,kode_varian');
            DB::table('inventaris__asset__list');
            if ($_GET['is_lebih'] ?? 'F' == 'T') {
                DB::whereRaw("inventaris__asset__list__varian.id>=" . $_GET['last']);
            }
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian =-3");
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
            $start = 100;
            if (isset($_GET['offset']) and isset($_GET['limit'])) {
                $start = $_GET['offset'];
                DB::limitRaw($page, $_GET['offset'], $_GET['limit']); //id_varian_1

            } elseif (isset($_GET['offset'])) {
                $start = $_GET['offset'];
                DB::limitRaw($page, $_GET['offset'], 100); //id_varian_1

            } else
                DB::limitRaw($page, 50); //id_varian_1
            DB::orderRaw($page, 'nama_barang, inventaris__asset__list__varian.nama_varian asc');
            $get_sarimbit = DB::get('all');
        }
        echo '<form action="' . base_url() . 'DestyStokManual/update_connect_varian" method="post">';
        echo '
		<style>
			.select2-container{
				width:100% !important;
			}
		</style>
		<table border=1>
            <thead><tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Varian</th>
                <th>Konektifitas Asset</th>
                <th>Suggestion</th>
                <th>Asset Sync</th>
                <th>Varian Values</th>
                <th>Sync Api Ethica</th>
                
                </tr>
            </thead>
            <tbody>
           

        ';
        // print_R($get_sarimbit);

        $set = [
            "GAMIS" => ["AYUMi", "MEYRA", "LADIVA", "KAGUMI", "NARA"],
            "ANAK PR" => ["AYUMI KIDS", "KAGUMI KIDS", "SELIA", "LADIVA KIDS", "NARA KIDS"],
            "KOKO" => ["KAHFI", "KASEO"],
            "ANAK LK" => ["KLIKO", "KAHFI KIDS"],
        ];
        function replace($string, $true = false)
        {
            $string = strtoupper(trim($string));
            $string = str_ireplace('(ANAK)', '', $string);
            if (!$true) {
                $string = str_ireplace('ANAK', '', $string);
                $string = str_ireplace('Dewasa', '', $string);
            }
            $string = str_ireplace('(', '', $string);
            $string = str_ireplace(')', '', $string);
            $string = str_ireplace('  ', ' ', $string);
            $string = str_ireplace('Anak No.', '', $string);
            $string = str_ireplace('ENDLESS SKY', '', $string);
            $string = str_ireplace('BLUE CAPTAIN', '', $string);
            $string = str_ireplace('NARA', 'GAMIS DEWASA / ', $string);
            $string = str_ireplace('GAMIS IBU', 'GAMIS DEWASA', $string);
            $string = str_ireplace('BOY', 'KOKO ANAK', $string);
            $string = str_ireplace('KLIKO', 'KOKO ANAK / ', $string);
            $string = str_ireplace('DAD', 'KOKO', $string);
            $string = str_ireplace('KASEO', 'KOKO / ', $string);
            $string = str_ireplace('AYAH', 'KOKO', $string);
            $string = str_ireplace('GIRL', 'GAMIS ANAK', $string);
            $string = str_ireplace('SELIA', 'GAMIS ANAK / ', $string);
            $string = str_ireplace('MOM', 'GAMIS', $string);
            $string = str_ireplace('IBU', 'GAMIS', $string);
            $string = str_ireplace('GAMSI', 'GAMIS', $string);
            $string = str_ireplace('KOKO KOKO', 'KOKO', $string);
            $string = str_ireplace('MERAH LAKI-LAKI', '(LK) RED', $string);
            $string = str_ireplace('MERAH PEREMPUAN', '(PR) RED', $string);
            $string = str_ireplace('PUTIH LAKI-LAKI', '(LK) WHITE', $string);
            $string = str_ireplace('PUTIH PEREMPUAN', '(LK) WHITE', $string);
            $string = str_ireplace('No ', '', $string);
            $string = str_ireplace('No', '', $string);
            $string = str_ireplace('.', '', $string);
            $string = str_ireplace('XXXXXXL', '6XL', $string);
            $string = str_ireplace('XXXXXL', '5XL', $string);
            $string = str_ireplace('XXXXL', '4XL', $string);
            $string = str_ireplace('XXXL', '3XL', $string);
            $ex = explode(' ', strtoupper($string));
            $ex = explode(' ', strtoupper($string));
            $ex = explode(' ', strtoupper($string));
            if ($ex[0] == 'GAMIS') {
                //	$string = "GAMIS";
            }
            if ($ex[0] == 'KOKO') {
                //$string = "KOKO";
            }
            return trim(strtoupper($string));
        }
        function startsWithAny($namaBarang, $prefixes)
        {
            foreach ($prefixes as $prefix) {
                if (str_starts_with($namaBarang, strtoupper($prefix))) {
                    return true;
                }
            }
            return false;
        }
        $id_last = 0;
        function strpos_array($haystack, $needles)
        {
            foreach ($needles as $needle) {
                $pos = stripos($haystack, $needle);
                if ($pos !== false) {
                    return $pos;
                }
            }
            return false;
        }
        function tambahkanSlashJikaDiAkhir($kalimat)
        {
            $kalimat = trim($kalimat); // Bersihkan spasi di awal/akhir
            $kata_kunci = ['koko', 'gamis'];

            foreach ($kata_kunci as $kata) {
                $panjang_kata = strlen($kata);
                $panjang_kalimat = strlen($kalimat);
                $lower_kalimat = strtolower($kalimat);
                $lower_kata = strtolower($kata);

                // Jika string tunggal, skip
                if ($lower_kalimat === $lower_kata) {
                    return $kalimat;
                }

                // Jika di akhir kalimat
                if (
                    $panjang_kalimat > $panjang_kata &&
                    strtolower(substr($kalimat, -$panjang_kata)) === $lower_kata
                ) {
                    return strtoupper(substr($kalimat, 0, -$panjang_kata) . '/' . $kata);
                }
            }

            // Proses untuk kata di tengah (bukan di awal)
            $words = explode(' ', strtolower($kalimat));
            if (in_array($words[0], $kata_kunci)) {
                return strtoupper($kalimat);
            }
            foreach ($words as &$word) {
                foreach ($kata_kunci as $kata) {
                    $lower_word = strtolower($word);
                    $lower_kata = strtolower($kata);

                    // Jika kata ditemukan dan tidak di awal kata dan belum ada /
                    if (
                        $lower_word === $lower_kata &&
                        strpos($word, '/') !== 0
                    ) {
                        $word = ' / ' . $word;
                    }
                }
            }

            return strtoupper(implode(' ', $words));
        }
        foreach ($get_sarimbit['row'] as $row) {
            $no++;
            if ($row->id_varian > $id_last) {
                $id_last = $row->id_varian;
            }
            $temp = $row->nama_varian;
            $row->nama_varian = str_ireplace(['AYAH', 'KASEO', 'IBU', 'NARA', 'GAMIS', 'GIRL', 'SELIA', 'BOY', 'KLIKO', 'NO.', '  ', '/ /', 'ACCARDIAN GREENGAMIS', ' '], ['AYAH / ', 'AYAH / ', 'IBU  / ', 'IBU  / ', 'GAMIS / ', 'GIRL / ', 'GIRL / ', 'BOY / ', 'BOY / ', '', ' ', '/', "ACCARDIAN GREEN GAMIS", ' '], $row->nama_varian);
            $row->nama_varian = str_ireplace(["Gamis / anak"], ["GAMIS ANAK"], $row->nama_varian);;
            if (stripos($row->nama_varian, 'ANAK') !== false and strpos_array($row->nama_varian, [
                "XL / 8",
                "XL/8",
                "L / 6",
                "L/6",
                "M / 4",
                "M/4",
                "S / 2",
                "S/2",
                "XS / 0",
                "XS/0",
                "XXL / 10",
                "XXL/10",
            ])) {

                $row->nama_varian = str_ireplace(["XL / 8", "XL/8"], "8", $row->nama_varian);
                $row->nama_varian = str_ireplace(["L / 6", "L/6"], "6", $row->nama_varian);
                $row->nama_varian = str_ireplace(["M / 4", "M/4"], "4", $row->nama_varian);
                $row->nama_varian = str_ireplace(["S / 2", "S/2"], "2", $row->nama_varian);
                $row->nama_varian = str_ireplace(["XS / 0", "XS/0"], "0", $row->nama_varian);
                $row->nama_varian = str_ireplace(["XXL / 10", "XXL/10"], "10", $row->nama_varian);
            } else if (!stripos($row->nama_varian, 'ANAK') !== false and strpos_array($row->nama_varian, [
                "XL / 8",
                "XL/8",
                "L / 6",
                "L/6",
                "M / 4",
                "M/4",
                "S / 2",
                "S/2",
                "XS / 0",
                "XS/0",
                "XXL / 10",
                "XXL/10",
            ])) {

                $row->nama_varian = str_ireplace(["XL / 8", "XL/8"], "XL", $row->nama_varian);
                $row->nama_varian = str_ireplace(["L / 6", "L/6"], "L", $row->nama_varian);
                $row->nama_varian = str_ireplace(["M / 4", "M/4"], "M", $row->nama_varian);
                $row->nama_varian = str_ireplace(["S / 2", "S/2"], "S", $row->nama_varian);
                $row->nama_varian = str_ireplace(["XS / 0", "XS/0"], "XS", $row->nama_varian);
                $row->nama_varian = str_ireplace(["XXL / 10", "XXL/10"], "XXL", $row->nama_varian);
            }
            $row->nama_varian = str_ireplace(["5XL 6XL"], "6XL", $row->nama_varian);
            $row->nama_varian = str_ireplace(["3XL 4XL"], "4XL", $row->nama_varian);
            $row->nama_varian = str_ireplace(["NO"], "/", $row->nama_varian);
            $row->nama_varian = str_ireplace(["GAMIS / DEWASA"], ["GAMIS DEWASA"], $row->nama_varian);;
            $row->nama_varian = tambahkanSlashJikaDiAkhir($row->nama_varian);
            if (strtoupper($temp) == "GAMIS / 2")
                $row->nama_varian = "GAMIS / 2";
            if (strpos($row->nama_varian, '/'))
                $exx = explode('/', $row->nama_varian);
            else
                $exx = explode(' ', str_ireplace(['No', '.'], '', $row->nama_varian));
            $row->vl1_nama_list_tipe_varian = replace(trim($exx[0]), 1);
            $row->vl2_nama_list_tipe_varian = replace($exx[1] ?? '');
            $row->vl3_nama_list_tipe_varian = replace($exx[2] ?? '');
            $where = "(1=0 ";
            if ($row->vl1_nama_list_tipe_varian) {

                $where .= " or inventaris__asset__list.nama_barang LIKE '%$row->vl1_nama_list_tipe_varian%'";
            }
            if ($row->vl2_nama_list_tipe_varian) {

                $where .= " or inventaris__asset__list.nama_barang LIKE '%$row->vl2_nama_list_tipe_varian%'";
            }
            if ($row->vl3_nama_list_tipe_varian) {

                $where .= " or inventaris__asset__list.nama_barang LIKE '%$row->vl3_nama_list_tipe_varian%'";
            }
            $where .= ")";
            if ($where == '(1=0 )') {
                $where = "1=1";
            } else {
                if ($row->vl1_nama_list_tipe_varian == 'GAMIS DEWASA') {
                    if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['GAMIS'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                } else if ($row->vl1_nama_list_tipe_varian == 'GAMIS ANAK') {
                    if (!in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['ANAK PR'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                } elseif ($row->vl1_nama_list_tipe_varian == 'KOKO DEWASA') {
                    if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['KOKO'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                } else if ($row->vl1_nama_list_tipe_varian == 'KOKO ANAK') {
                    if (!in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['ANAK LK'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                } else
                if ($row->vl1_nama_list_tipe_varian == 'GAMIS') {
                    if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['GAMIS'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    } else if ($row->vl2_nama_list_tipe_varian == 0 or  ($row->vl2_nama_list_tipe_varian >= 1 and $row->vl2_nama_list_tipe_varian  <= 10
                        and !in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"]))) {
                        $where .= " AND (1=0";
                        foreach ($set['ANAK PR'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                } else if ($row->vl1_nama_list_tipe_varian == 'KOKO') {
                    if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                        $where .= " AND (1=0";
                        foreach ($set['KOKO'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    } elseif (
                        $row->vl2_nama_list_tipe_varian == 0 or
                        ($row->vl2_nama_list_tipe_varian >= 1 and $row->vl2_nama_list_tipe_varian  <= 10 and !in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"]))
                    ) {
                        $where .= " AND (1=0";
                        foreach ($set['ANAK LK'] as $value) {

                            $where .= " or inventaris__asset__list.nama_barang LIKE '% $value'";
                        }
                        $where .= ")";
                    }
                }
            }
            $targetVarian = trim($row->vl1_nama_list_tipe_varian . ' ' . $row->vl2_nama_list_tipe_varian);
            $targetVarian2 = trim(' ' . $row->vl2_nama_list_tipe_varian);
            $targetVarian3 = trim(' ' . $row->vl3_nama_list_tipe_varian);
            $array_tipe = ["AYAH", "GAMIS", "KOKO", "KOKO ANAK", "GAMIS ANAK", "IBU"];
            if (in_array($row->vl2_nama_list_tipe_varian, $array_tipe)) {
                $tipe = strtoupper(trim($row->vl2_nama_list_tipe_varian));
            } else if (in_array($row->vl3_nama_list_tipe_varian, $array_tipe)) {
                $tipe = strtoupper(trim($row->vl3_nama_list_tipe_varian));
            } else
                $tipe = strtoupper(trim($row->vl1_nama_list_tipe_varian));
            $tipe = str_ireplace(["AYAH", "IBU"], ["KOKO", "GAMIS"], $tipe);
            if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                $var = $targetVarian2;
                $var2 = $row->vl2_nama_list_tipe_varian;
            } else if (in_array($row->vl2_nama_list_tipe_varian, ['0', "2", "4", "6", "8", "10"])) {
                $var = $targetVarian2;
                $var2 = $row->vl2_nama_list_tipe_varian;
            } else if (in_array($row->vl3_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                $var = $targetVarian3;
                $var2 = $row->vl3_nama_list_tipe_varian;
            } else if (in_array($row->vl3_nama_list_tipe_varian, ['0', "2", "4", "6", "8", "10"])) {
                $var = $targetVarian3;
                $var2 = $row->vl3_nama_list_tipe_varian;
            } else {
                $var = $row->nama_varian;
                $var2 = $row->nama_varian;
            }
            $ukuran = $var2;
            // Tentukan apakah ukuran termasuk ukuran anak atau dewasa
            $isAnak = preg_match('/^(0|[1-9]|10)$/', $var2);       // 0–10
            $isDewasa = preg_match('/^(XS|S|M|L|XL|XXL|3XL|4XL|5XL|6XL)$/', $var2);


            $where2 = "1=1";
            //$where2 .= "(  inventaris__asset__list.nama_barang LIKE '%$row->vl1_nama_list_tipe_varian $row->vl2_nama_list_tipe_varian%' or inventaris__asset__list.nama_barang LIKE '%$row->vl2_nama_list_tipe_varian%')";
            $where2 = "1=1";
            if (in_array($row->vl2_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                $where2 .= " and (  inventaris__asset__list.nama_barang LIKE '% $row->vl2_nama_list_tipe_varian')";
            }
            if (in_array($row->vl3_nama_list_tipe_varian, ['M', "S", "XS", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL"])) {
                $where2 .= " and (  inventaris__asset__list.nama_barang LIKE '% $row->vl3_nama_list_tipe_varian')";
            }
            DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");

            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.id in (SELECT id_asset_list_varian FROM inventaris__asset__list__varian where id_inventaris__asset__list = $row->id_barang_master)");
            DB::whereRaw("$where");

            DB::whereRaw("$where2");


            //DB::whereRaw("upper(inventaris__asset__list.nama_barang) like '%" . 
            //trim(strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1')) . "%' ");

            DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
            $get_barang = DB::get('all');
            if ($get_barang['num_rows'] == 0) {



                DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
                DB::table('inventaris__asset__list');
                DB::whereRaw("inventaris__asset__list.id in (SELECT id_asset_list_varian FROM inventaris__asset__list__varian where id_inventaris__asset__list = $row->id_barang_master) and $where2");

                DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
                $get_barang = DB::get('all');
            }
            if ($get_barang['num_rows'] == 0) {



                DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
                DB::table('inventaris__asset__list');
                DB::whereRaw("inventaris__asset__list.id in (SELECT id_asset_list_varian FROM inventaris__asset__list__varian where id_inventaris__asset__list = $row->id_barang_master) ");

                DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
                $get_barang = DB::get('all');
            }

            echo "<tr style='" . ($row->id_varian <= ($_GET['last'] ?? 0) ? 'color:red;font-weight:550' : '') . "'>
            <td>" . ($no + $start) . " </td>
            <td>$row->nama_barang </td>
            <td>$row->nama_varian ($temp)</td>
            
            <td>$row->nama_barang_konek </td>
            <td>$row->kode_barang - $row->kode_varian<BR> </td>
            <td>$row->v1_nama_tipe:$row->vl1_nama_list_tipe_varian
            <Br>$row->v2_nama_tipe:$row->vl2_nama_list_tipe_varian<br>$row->v3_nama_tipe:$row->vl3_nama_list_tipe_varian </td>
			<td id='content-varian-$row->id_varian'><select name='varian[$row->id_varian]' class='js-example-basic-single' style='width:100%'>
          
            ";
            // id_barang_master


            $is_selected = "";


            foreach ($get_barang['row'] as $sarimbit) {
                $namaBarang = strtoupper(trim($sarimbit->nama_barang));
                $array_nama = explode(' ', $namaBarang);
                $selected = "";


                if ($row->id_asset_list_varian == $sarimbit->id_asset) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 1;
                } else if ($tipe === 'GAMIS' && $isDewasa && startsWithAny($namaBarang, $set["GAMIS"]) and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 2;
                } else if ($tipe === 'GAMIS DEWASA' && $isDewasa && startsWithAny($namaBarang, $set["GAMIS"]) and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 2;
                } elseif ($tipe === 'GAMIS' && $isAnak && startsWithAny($namaBarang, $set["ANAK PR"]) and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 3;
                } elseif ($tipe === 'GAMIS ANAK' && $isAnak && startsWithAny($namaBarang, $set["ANAK PR"]) and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 3;
                } elseif ($tipe === 'KOKO' && $isDewasa && startsWithAny($namaBarang, $set["KOKO"])  and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 4;
                } elseif ($tipe === 'KOKO DEWASA' && $isDewasa && startsWithAny($namaBarang, $set["KOKO"])  and end($array_nama) == $var) {
                    $selected = 'selected';
                    if (!$selected)
                        $if = 4;
                } elseif ($tipe === 'KOKO' && $isAnak && startsWithAny($namaBarang, $set["ANAK LK"]) and end($array_nama) == $var) {
                    if (!$is_selected) {
                        $if = 5;
                        $selected = 'selected';
                    }
                } elseif ($tipe === 'KOKO ANAK' && $isAnak && startsWithAny($namaBarang, $set["ANAK LK"]) and end($array_nama) == $var) {
                    if (!$is_selected) {
                        $if = 5;
                        $selected = 'selected';
                    }
                } else if (str_ends_with(strtoupper(trim($sarimbit->nama_barang)), strtoupper(trim($targetVarian)))) {
                    if (!$is_selected) {
                        $if = 6;
                        $selected = 'selected';
                    }
                } else if ((trim(substr(trim($sarimbit->nama_barang), -strlen($targetVarian))) == $targetVarian)) {
                    if (!$is_selected) {
                        $if = 6;
                        $selected = 'selected';
                    }
                    /*}else if(str_ends_with(strtoupper($sarimbit->nama_barang), strtoupper($targetVarian2))){
					if(!$is_selected){
					$if = 7;
					$selected = 'selected';
					}*/
                } else {
                    if (!$is_selected)
                        $if = 8;
                }
                $selected2 = ($row->id_asset_list_varian == $sarimbit->id_asset ? 'selected' : (strtoupper($sarimbit->nama_barang) == strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1') ? 'selected' : (
                    str_ends_with(strtoupper($sarimbit->nama_barang), strtoupper($targetVarian))
                    ? 'selected'
                    : (str_ends_with(strtoupper($sarimbit->nama_barang), strtoupper($targetVarian2))
                        ? 'selected'
                        : '')
                )));
                if ($selected == 'selected' and $is_selected) {
                    $selected == '';
                }


                echo '<option value="' . $sarimbit->id_asset . '" ' . $selected . '>' . $sarimbit->nama_barang
                    . '</option>';
                if ($selected == 'selected'  and !$is_selected)
                    $is_selected = true;
            }

            echo '<option value="-3" ' . (!$is_selected ? 'selected' : '') . '>PILIH' . $isAnak . $isDewasa . '</option>';
            echo '<option value="-1">PRODUK SYNC TAPI BUKAN PRODUK ETHCIA- SELALU KOSONGKAN</option>';
            echo '<option value="-2">NON PRODUK SYNC</option>';

            echo "</select></td> ";
            $sql = "SELECT DISTINCT TRIM(SUBSTRING_INDEX(nama_barang, ' ', LENGTH(nama_barang) - LENGTH(REPLACE(nama_barang, ' ', '')))) AS nama_tanpa_ukuran
			FROM inventaris__asset__list__varian
			LEFT JOIN inventaris__asset__list on id_asset_list_varian = inventaris__asset__list.id
			WHERE inventaris__asset__list__varian.id_inventaris__asset__list = $row->id_barang_master
			;";
            DB::queryRaw($page, $sql);
            $get_sync = DB::get('all');
            echo "<td> 
			<select id='sync-$row->id_varian' class='js-example-basic-single' value>
			";
            foreach ($get_sync['row'] as $s) {
                $sarimbit = $s;
                $sarimbit->nama_barang = $s->nama_tanpa_ukuran . ' ' . $row->vl2_nama_list_tipe_varian;;
                $namaBarang = strtoupper(trim($sarimbit->nama_barang));
                $array_nama = explode(' ', $namaBarang);
                $selected = "";

                if ($tipe === 'GAMIS' && $isDewasa && startsWithAny($namaBarang, $set["GAMIS"]) and !stripos($namaBarang, 'KIDS')) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 2;
                    }
                } else if ($tipe === 'GAMIS DEWASA' && $isDewasa && startsWithAny($namaBarang, $set["GAMIS"]) and !stripos($namaBarang, 'KIDS')) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 2;
                    }
                } elseif ($tipe === 'GAMIS' && $isAnak && startsWithAny($namaBarang, $set["ANAK PR"])) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 3;
                    }
                } elseif ($tipe === 'GAMIS ANAK' && $isAnak && startsWithAny($namaBarang, $set["ANAK PR"])) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 3;
                    }
                } elseif ($tipe === 'KOKO' && $isDewasa && startsWithAny($namaBarang, $set["KOKO"]) and !stripos($namaBarang, 'KIDS')) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 4;
                    }
                } elseif ($tipe === 'KOKO DEWASA' && $isDewasa && startsWithAny($namaBarang, $set["KOKO"])  and !stripos($namaBarang, 'KIDS')) {
                    if (!$selected) {
                        $selected = 'selected';
                        $if = 4;
                    }
                } elseif ($tipe === 'KOKO' && $isAnak && startsWithAny($namaBarang, $set["ANAK LK"])) {
                    if (!$selected) {
                        $if = 5;
                        $selected = 'selected';
                    }
                } elseif ($tipe === 'KOKO ANAK' && $isAnak && startsWithAny($namaBarang, $set["ANAK LK"])) {
                    if (!$selected) {
                        $if = 5;
                        $selected = 'selected';
                    }
                    /*}else if(str_ends_with(strtoupper(trim($sarimbit->nama_barang)), strtoupper(trim($targetVarian)))){
					if(!$is_selected){
					$if = 6;
					$selected = 'selected';	
					}
				}else if((trim(substr(trim($sarimbit->nama_barang), -strlen($targetVarian)))== $targetVarian) ){
					if(!$is_selected){
					$if = 6;
					$selected = 'selected';	
					}
				}else if(str_ends_with(strtoupper($sarimbit->nama_barang), strtoupper($targetVarian2))){
					if(!$is_selected){
					$if = 7;
					$selected = 'selected';
					}*/
                } else {
                    if (!$is_selected)
                        $if = 8;
                    $selected = 0;
                }

                echo '<option ' . $selected . ' ' . $if . '>';
                echo $s->nama_tanpa_ukuran . ' ' . $var2;
                echo '</option>';
                echo '<option>';
                echo $s->nama_tanpa_ukuran;
                echo '</option>';
            }
            echo "
			</select>
			
           <button type='button'  onclick='sync_sarimbit_ethica_barang($row->id_barang_master,$row->primary_to_key,$row->id_varian,0)'>Sync Single</button>
		   <button type='button'  onclick='sync_sarimbit_ethica_barang($row->id_barang_master,$row->primary_to_key,$row->id_varian,1)'>Sync Multiple</button>
		   <button type='button'  onclick='loaddata($row->id_barang_master,$row->primary_to_key,$row->id_varian,1)'>LOAD</button>
		   <input type='text' class='form-control' id='all-cari-$row->id_varian' width='100%'>
		   <button type='button'  onclick='sync_sarimbit_ethica_barang($row->id_barang_master,$row->primary_to_key,$row->id_varian,2)'>CARI INPUT</button>
            </td>";
            echo '<td>';
            if ($no > $start) {
                //  DestyStokManual::sync_sarimbit_ethica_barang($row->id_barang_master,$row->id_varian, trim(strtoupper($detailFromSheet['by_kode'][$row->kode_barang]['variasi'][$row->kode_varian] ?? '-1')),$page);
            }
            echo '</td>';
        }
        echo ' </tbody></table>
        <input type="hidden" name="offset" value="' . ($_GET['offset'] ?? 0) . '">
        <input type="hidden" name="limit" value="' . ($_GET['limit'] ?? 0) . '">
        <button type="submit" class="btn btn-primary" name="last" value=' . $row->id_varian . '>Submit</button>
        </form>
        <form action="" method="get">
            <button href type="submit" name="offset" class="btn btn-primary" value="' . ((($_GET['offset'] ?? 0) - 100)) . '">Pref</button>
       
            <button href type="submit" name="offset" class="btn btn-primary" value="' . ((($_GET['offset'] ?? 0) + 100)) . '">Next</button>
        </form>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $(".js-example-basic-single").select2();
  });
  function sync_sarimbit_ethica_barang(id_barang_master,id_desty_master,id_varian_desty,typess){
	  if(typess==2)
	  nama_barang = $("#all-cari-"+id_varian_desty).val();
      else 
	  nama_barang = $("#sync-"+id_varian_desty).val();
	  $.ajax({  
				type: "get",
				data: {"id_barang_master": id_barang_master,"id_desty_master": id_desty_master
					,"nama_barang": nama_barang
					,"id_varian_desty": id_varian_desty
					,"typess": typess
				},
				url: "' . base_url() . 'DestyStokManual/sync_sarimbit_ethica_barang",
				dataType: "json",
				success: function(data){
					if(data.result){
					if(typess==0)
					$("#content-varian-"+id_varian_desty).html(nama_barang);
					else{
					$("#content-varian-"+id_varian_desty).html(data.select);
					$("#varian-select-"+id_varian_desty).select2();
					}
					}else{
					alert(data.message);
					}
					
				},
				error: function (error) {
				   
				} 
			});
  } function loaddata(id_barang_master,id_desty_master,id_varian_desty,typess){
	  nama_barang = $("#sync-"+id_varian_desty).val();
	  $.ajax({  
				type: "get",
				data: {"id_barang_master": id_barang_master,"id_desty_master": id_desty_master
					,"nama_barang": nama_barang
					,"id_varian_desty": id_varian_desty
					,"typess": typess
				},
				url: "' . base_url() . 'DestyStokManual/load_barang",
				dataType: "json",
				success: function(data){
					
					$("#content-varian-"+id_varian_desty).html(data.select);
					$("#varian-select-"+id_varian_desty).select2();
					
					
				},
				error: function (error) {
				   
				} 
			});
  }
</script>';

        echo $get_sarimbit['num_rows_non_limit'];
    }
    public static function sync_sarimbit_ethica($page,$search)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];

        $page['load']['type'] = 'tambah';
         $page['is_login'] = 0;
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
    public static function sync_artikel_ethica($page,$search)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];

        $page['load']['type'] = 'tambah';
         $page['is_login'] = 0;
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $_GET['search'] = $search;
        $_GET['offset'] = 0;
        $_GET['non_produk'] = 1;
        ApiContent::ethica_artikel($page, 1, $search);
    }
    public static function sync_sarimbit_ethica_barang($page)
    {
        $fai = new MainFaiFramework();
        $id_barang_master = $fai->input('id_barang_master');
        $id_desty_master = $fai->input('id_desty_master');
        $id_varian = $fai->input('id_varian_desty');
        $search = $fai->input('nama_barang');
        $typess = $fai->input('typess');
        $page = [];


        $segments = Partial::uri_segment();
        //$all = menu / class/function
        if (!count($page)) {

            $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
            if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

                $domain = $fai->input('frameworksubdomain');
            } else
                $domain = $_SERVER['HTTP_HOST'];
            if (!$type_load) {
                $type_load = $segments[1]  ? $segments[1] : "";
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
        ], "816622", "25231b80-f006-11ef-ad5b-bc2411f62480");
        // + barang
        $get_data = json_decode($get_data, 1)['data'];

        if (!$get_data) {
            $data_Return['result'] = 0;
            $data_Return['message'] = json_decode($get_data, 1);
        } else {
            $data_Return['result'] = 1;
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
                        if ($typess == 0)
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
                        $id_varian2 = null;
                        $id_varian3 = null;
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
        DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.id in (SELECT id_asset_list_varian FROM inventaris__asset__list__varian where id_inventaris__asset__list = $id_barang_master) ");

        DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
        $get_barang = DB::get('all');
        ob_start();
        echo "<select name='varian[$id_varian]' id='varian-select-$id_varian' class='js-example-basic-single' style='width:100%'>";
        foreach ($get_barang['row'] as $sarimbit) {
            $selected = $search == $sarimbit->nama_barang ? 'selected' : '';
            echo '<option value="' . $sarimbit->id_asset . '" ' . $selected . '>' . $sarimbit->nama_barang
                . '</option>';
        }
        echo '</select>';
        $data_Return['select'] = ob_get_clean();
        echo json_encode($data_Return);
    }
    public static function load_barang($page)
    {

        $fai = new MainFaiFramework();
        $typess = $fai->input('typess');
        $page = [];


        $segments = Partial::uri_segment();
        //$all = menu / class/function
        if (!count($page)) {

            $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
            if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

                $domain = $fai->input('frameworksubdomain');
            } else
                $domain = $_SERVER['HTTP_HOST'];
            if (!$type_load) {
                $type_load = $segments[1]  ? $segments[1] : "";
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
        $id_barang_master = $fai->input('id_barang_master');
        $id_desty_master = $fai->input('id_desty_master');
        $id_varian = $fai->input('id_varian_desty');
        $search = $fai->input('nama_barang');
        $typess = $fai->input('typess');
        DB::selectRaw("inventaris__asset__list.id as id_asset,nama_barang");
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.id in (SELECT id_asset_list_varian FROM inventaris__asset__list__varian where id_inventaris__asset__list = $id_barang_master) ");

        DB::orderRaw($page, ' inventaris__asset__list.nama_barang asc');
        $get_barang = DB::get('all');
        ob_start();
        echo "<select name='varian[$id_varian]' id='varian-select-$id_varian' class='js-example-basic-single' style='width:100%'>";
        echo '<option value="-3">Pilih</option>';
        foreach ($get_barang['row'] as $sarimbit) {
            $selected = $search == $sarimbit->nama_barang ? 'selected' : '';
            echo '<option value="' . $sarimbit->id_asset . '" ' . $selected . '>' . $sarimbit->nama_barang
                . '</option>';
        }
        echo '</select>';
        $data_Return['select'] = ob_get_clean();
        echo json_encode($data_Return);
    }
    public static function update_connect_barang($page)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];


         $page['is_login'] = 0;
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
    public static function update_connect_barang_varian($page)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];


         $page['is_login'] = 0;
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

        echo '
		<button type="button" onclick="back()">BACK</button>
		<script>
		function back(){
			window.location.href="' . base_url() . 'DestyStokManual/manual_produk_sync_varian?offset=' . (Partial::input('offset') ?? 0) . '&limit=' . (Partial::input('limit') ?? 100) . '&last=' . (Partial::input('last') ?? 0) . '";
		}</script>
		';
    }
    public static function generate_harga($page)
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
        DB::selectRaw('desty_export_data.id,konek.harga_pokok_penjualan');
        DB::table('desty_export_data');
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list__varian.id_desty_manual=desty_export_data.id", "left");
        DB::joinRaw("inventaris__asset__list on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");


        DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1

        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
        DB::whereRaw("desty_export_data.generate_stok = 0");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian >0");
        DB::whereRaw("harga_seharusnya is null");
        $get = DB::get('all');

        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                DB::update("desty_export_data", ['harga_seharusnya' => $row->harga_pokok_penjualan], ["id=$row->id"]);
            }
        }
    }
    public static function proses_inisiasi_generate_data($page,$tipe)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];
        $page['load']['type'] = 'tambah';

         $page['is_login'] = 0;
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        //generate yang tidak terafiliasi dengan system 




        $nama_file = Partial::input('name');
        DB::table('desty_export_data__excel');
        DB::whereRaw("nama_file = '$nama_file'");
        $get_shopee = DB::get('all');
        //generate pengosongan stok

        DB::selectRaw('desty_export_data.id');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
        DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("desty_export_data on inventaris__asset__list__varian.id_desty_manual=desty_export_data.id", "left");
        DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");
        DB::orderRaw($page, "inventaris__asset__list.nama_barang asc");
        $get_sarimbit = DB::get('all');
        // echo $get_sarimbit['query'];
        foreach ($get_sarimbit['row'] as $asset) {
            DB::update("desty_export_data", ['et_title_variation_stock' => 0], ["id=$asset->id"]);
        }
        //generate warna
        if ($tipe == 'warna') {
            DB::selectRaw('distinct(vl2.nama_list_tipe_varian) as nama_barang');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::joinRaw("desty_export_data on inventaris__asset__list__varian.id_desty_manual=desty_export_data.id", "left");
            DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");
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
                CRUDFunc::crud_insert($fai, $page, $generate, [], 'desty_export_data__proses_generate');
            }
        }
        //generate_sarimbit
        /* DB::selectRaw('distinct(master.nama_barang) as nama_barang');
        DB::table('inventaris__asset__list');
        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
        DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
        DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
        DB::joinRaw("desty_export_data on desty_export_data.=inventaris__asset__list.kode_barang", "left");
        DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");
        DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
        $get_asset = DB::get('all');
        foreach ($get_asset['row'] as $asset) {
            $generate = [];
            $generate['generate_by'] = 'sarimbit';
            $generate['content_generate'] = $asset->nama_barang;
            $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
            CRUDFunc::crud_insert($fai, $page, $generate, [], 'desty_export_data__proses_generate');
        }*/
        //per artikel  
        if ($tipe == 'artikel') {
            DB::selectRaw('distinct(master.nama_barang) as nama_barang');
            DB::table('desty_export_data');
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list__varian.id_desty_manual=desty_export_data.id", "left");
            DB::joinRaw("inventaris__asset__list on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");

            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("desty_export_data.generate_stok = 0");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian >0");

            DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian master_varian on master_varian.id_inventaris__asset__list=master.id and master_varian.id_asset_list_varian =inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1
            //DB::joinRaw("inventaris__master__tipe_varian v1 on v1.id=master_varian.id_tipe_varian_1", "left"); //id_tipe_varian_
            //DB::joinRaw("inventaris__master__tipe_varian__list vl1 on vl1.id=master_varian.id_varian_1", "left"); //id_varian_1
            //DB::joinRaw("inventaris__master__tipe_varian v2 on v2.id=master_varian.id_tipe_varian_2", "left"); //id_tipe_varian_
            //DB::joinRaw("inventaris__master__tipe_varian__list vl2 on vl2.id=master_varian.id_varian_2", "left"); //id_varian_1


            $get_sarimbit = DB::get('all');

            foreach ($get_sarimbit['row'] as $asset) {
                $generate = [];
                $generate['generate_by'] = 'artikel';
                $generate['content_generate'] = $asset->nama_barang;
                $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
                CRUDFunc::crud_insert($fai, $page, $generate, [], 'desty_export_data__proses_generate');
            }
        }
        //per barang
        if ($tipe == 'barang') {
            DB::selectRaw('distinct(konek.nama_barang)');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");

            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::joinRaw("desty_export_data on inventaris__asset__list__varian.id_desty_manual=desty_export_data.id", "left");
            DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");
            DB::joinRaw("inventaris__asset__list konek on konek.id=inventaris__asset__list__varian.id_asset_list_varian", "left"); //id_varian_1

            $get_sarimbit = DB::get('all');
            foreach ($get_sarimbit['row'] as $asset) {
                $generate = [];
                $generate['generate_by'] = 'barang';
                $generate['content_generate'] = $asset->nama_barang;
                $generate['id_shoepee_export_data__excel'] = $get_shopee['row'][0]->id;
                CRUDFunc::crud_insert($fai, $page, $generate, [], 'desty_export_data__proses_generate');
            }
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Inisasi Data Sukses:' . $get_shopee['row'][0]->id
        ]);
    }


    public static function inisisasi_to_storage_store_produk($page)
    {
        ob_start();
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];
        $page['load']['type'] = 'tambah';

         $page['is_login'] = 0;
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        /*DB::table('inventaris__asset__list');
		DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
           
        DB::whereRaw("nama_file = '$nama_file'");
        $get_shopee = DB::get('all');
		*/


        //INI UNTUK SEMUA TOKO
        $db_produk['select'][] = "
                store__produk.*,
                store__produk.id as id_produk,
                inventaris__asset__list.nama_barang,
                inventaris__asset__list.deskripsi_barang ,
                inventaris__asset__list.barcode,  
                store__produk.id_toko,
                store__toko.nama_toko,
                store__toko.deskripsi_all_produk,
                
                store__produk__varian.id as id_produk_varian,
                inventaris__asset__list.varian_barang,nama_varian,
				inventaris__asset__list.id_api,
                sku_index_varian, 
				    inventaris__asset__list__varian.nama_tipe_tipe1,
				    inventaris__asset__list__varian.nama_tipe_tipe2,
				    inventaris__asset__list__varian.nama_tipe_tipe3,
                    nama_list_tipe_varian_varian1,
					nama_list_tipe_varian_varian,
					nama_list_tipe_varian_varian3,
                    id_tipe_varian_1,id_tipe_varian_2,id_tipe_varian_3,
                    id_varian_1,id_varian_2,id_varian_3,id_kategori,id_brand,
                store__produk.id_asset,id_barang_varian,berat_varian,berat,barcode_varian, 
                case when varian_barang='1' then 1 else 0 end as count_varian, 
                store__produk__varian.harga_pokok_penjualan_varian,
                case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok,
                store__produk.create_date,store__produk.update_date,
            inventaris__asset__list__varian.*				";
        $db_produk['utama'] = "store__produk";
        $db_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", " store__produk.id_asset", "inner"];
        $db_produk['join'][] = ["drive__file utama_file", " (utama_file.id)", " (inventaris__asset__list.foto_aset)", "left"];
        $db_produk['join'][] = ["store__toko ", " store__toko.id", " store__produk.id_toko", "left"];
        $db_produk['join'][] = ["store__produk__varian", "store__produk__varian.id_store__produk", "  store__produk.id", "left"];
        $db_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "store__produk__varian.id_barang_varian", "left"];
        //$db_produk['join'][] = ["inventaris__storage__data", " inventaris__storage__data.id_produk_varian", " store__produk__varian.id  and inventaris__storage__data.id_produk = store__produk.id", "left"];
        //$db_produk['where'][] = ["inventaris__storage__data.id", " is ",'null'];
        $db_produk['order'][] = ["store__produk.id", "desc"];
        //$db_produk['limit_raw'] = "100";
        $db_produk['limit_raw'] = "" . $fai->input('limit') . " OFFSET " . $fai->input('offset');


        $db_produk['np'] = true;
        $produk = Database::database_coverter($page, $db_produk, [], 'all');
        $list = [];
        $listnon = [];
        echo $produk['num_rows_non_limit'];
        echo '<pre>';
        $detail_API = [];
        foreach ($produk['row'] as $row) {
            if ($detail_API[$row->id_api_varian ?? $row->id_api]) {
                if (!isset($detail_API[$row->id_api_varian ?? $row->id_api])) {
                    DB::table('api_master__list');

                    DB::whereRawPage($page, "api_master__list.id=" . ($row->id_api_varian ?? $row->id_api));
                    $Get = DB::get('all');
                    $detail_API[$row->id_api_varian ?? $row->id_api] = $Get;
                } else {
                    $Get = $detail_API[$row->id_api_varian ?? $row->id_api];
                }

                $detail = [];
                $detail['id_gudang'] = $id_gudang = $Get['row'][0]->id_gudang;
                $detail['id_ruang_simpan'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;

                $detail['id_asset'] = $row->id_asset;
                $detail['id_produk'] = $row->id_produk;
                $detail['id_asset_varian'] = $row->id_barang_varian;
                $detail['id_produk_varian'] = $row->id_produk_varian;

                $detail['id_asset_connect'] = $row->id_asset_list_varian;
                $detail['connect_api_name'] = $row->nama_varian ?? $row->nama_barang;
                $detail['connect_api_id'] = $row->id_from_api_varian;
                $detail['id_api'] =  $row->id_api_varian;
                $list[] = $detail['connect_api_name'];
                DB::table('inventaris__storage__data');
                DB::whereRaw('id_gudang=' . $detail['id_gudang']);
                DB::whereRaw('id_ruang_simpan=' . $detail['id_ruang_simpan']);
                DB::whereRaw('id_asset=' . $detail['id_asset']);
                if ($detail['id_produk'] == null)
                    DB::whereRaw('id_produk is null');
                else
                    DB::whereRaw('id_produk=' . $detail['id_produk']);

                if ($detail['id_asset_varian'] == null)
                    DB::whereRaw('id_asset_varian is null');
                else
                    DB::whereRaw('id_asset_varian=' . $detail['id_asset_varian']);

                if ($detail['id_produk_varian'] == null)
                    DB::whereRaw('id_produk_varian is null');
                else
                    DB::whereRaw('id_produk_varian=' . $detail['id_produk_varian']);
                $storage = DB::get('all');
                if (!$storage['num_rows']) {
                    CRUDFunc::crud_insert($fai, $page, $detail, [], "inventaris__storage__data");
                }
            } else {
                $listnon[] = $row->nama_varian ?? $row->nama_barang;
            }
        }
        ob_clean();
        echo json_encode(["list" => $list, "listnon" => $listnon]);
    }
    public static function inisisasi_to_storage_desty_manual($page)
    {
        ob_start();
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];
        $page['load']['type'] = 'tambah';

         $page['is_login'] = 0;
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        /*DB::table('inventaris__asset__list');
		DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
           
        DB::whereRaw("nama_file = '$nama_file'");
        $get_shopee = DB::get('all');
		*/


        //INI UNTUK SEMUA TOKO
        $db_produk['select'][] = "
                inventaris__asset__list.*,
                inventaris__asset__list.id as id_asset,
                inventaris__asset__list.nama_barang,
                inventaris__asset__list.deskripsi_barang ,
                inventaris__asset__list.barcode,  
                inventaris__asset__list.varian_barang,nama_varian,
				inventaris__asset__list.id_api,
				inventaris__asset__list__varian.*,
				inventaris__asset__list__varian.id as id_barang_varian,
				asset.id_api as id_api_varian,
				asset.id_from_api as id_from_api_varian,
				asset.nama_barang as nama_varian

				";
        $db_produk['utama'] = "inventaris__asset__list_query";
        $db_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id_inventaris__asset__list", "inventaris__asset__list.id", "left"];
        $db_produk['join'][] = ["inventaris__asset__list as asset", "inventaris__asset__list__varian.id_asset_list_varian", "asset.id", "left"];
        $db_produk['where'][] = ["inventaris__asset__list.asal_barang_dari", " = ", "'Desty - Manual'"];
        $db_produk['where'][] = ["inventaris__asset__list__varian.id_asset_list_varian", " is ", "not null"];
        $db_produk['where'][] = ["inventaris__asset__list__varian.id_asset_list_varian", " not in ", "(-1,-2,-3)"];
        $db_produk['order'][] = ["inventaris__asset__list.id", "desc"];
        //$db_produk['limit_raw'] = "100";
        $db_produk['limit_raw'] = "" . $fai->input('limit') . " OFFSET " . $fai->input('offset');

        $db_produk['np'] = true;
        $produk = Database::database_coverter($page, $db_produk, [], 'all');
        $list = [];
        $listnon = [];
        $insert = [];
        $update = [];
        echo $produk['num_rows_non_limit'];
        echo '<pre>';
        $detail_API = [];

        foreach ($produk['row'] as $row) {

            if ($row->id_api_varian ?? $row->id_api) {
                if (!isset($detail_API[$row->id_api_varian ?? $row->id_api])) {
                    DB::table('api_master__list');

                    DB::whereRawPage($page, "api_master__list.id=" . ($row->id_api_varian ?? $row->id_api));
                    $Get = DB::get('all');
                    $detail_API[$row->id_api_varian ?? $row->id_api] = $Get;
                } else {
                    $Get = $detail_API[$row->id_api_varian ?? $row->id_api];
                }
            } else {
                $listnon[] = $row->nama_varian ?? $row->nama_barang;
                $Get['row'][0]->id_gudang = 2;
                $Get['row'][0]->id_ruang_simpan = 2;
            }

            $detail = [];
            $detail['id_gudang'] = $id_gudang = $Get['row'][0]->id_gudang;
            $detail['id_ruang_simpan'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;

            $detail['id_asset'] = $row->id_asset;
            $detail['id_produk'] = null;
            $detail['id_asset_varian'] = $row->id_barang_varian;
            $detail['id_produk_varian'] = null;

            $detail['id_asset_connect'] = $row->id_asset_list_varian;
            $detail['connect_api_name'] = $row->nama_varian ?? $row->nama_barang;
            $detail['connect_api_id'] = $row->id_from_api_varian;
            $detail['id_api'] =  $row->id_api_varian;
            $list[] = $detail['connect_api_name'];
            DB::table('inventaris__storage__data');
            DB::whereRaw('id_gudang=' . $detail['id_gudang']);
            DB::whereRaw('id_ruang_simpan=' . $detail['id_ruang_simpan']);
            DB::whereRaw('id_asset=' . $detail['id_asset']);
            if ($detail['id_produk'] == null)
                DB::whereRaw('(id_produk is null or id_produk=0)');
            else
                DB::whereRaw('id_produk=' . $detail['id_produk']);

            if ($detail['id_asset_varian'] == null)
                DB::whereRaw('(id_asset_varian is null or id_produk=0)');
            else
                DB::whereRaw('id_asset_varian=' . $detail['id_asset_varian']);

            if ($detail['id_produk_varian'] == null)
                DB::whereRaw('(id_produk_varian is null or  id_produk_varian=0)');
            else
                DB::whereRaw('id_produk_varian=' . $detail['id_produk_varian']);
            $storage = DB::get('all');
            if (!$storage['num_rows']) {
                CRUDFunc::crud_insert($fai, $page, $detail, [], "inventaris__storage__data");
                $insert[] = $detail['connect_api_name'];
            } else {
                CRUDFunc::crud_update($fai, $page, $detail, array(), array(), array(), "inventaris__storage__data", "id", $storage['row'][0]->id);
                $update[] = $detail['connect_api_name'];
            }
        }
        ob_clean();
        echo json_encode(["list" => $list, "listnon" => $listnon, "insert" => $insert, "update" => $update]);
    }
    public static function inisisasi_to_storage($page)
    {
        echo "
		<input type='' id='mulai_dari' value=0>
		<button type='button' onclick='mulai_toko()'>TOKO</button>
		<button type='button' onclick='mulai_toko_desty()'>DESTY</button>
		<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script>
let offset = 0;
let limit = 100; // jumlah per request, sesuaikan

function generateLink(offset) {
    $.ajax({
        url: '" . base_url() . "/DestyStokManual/inisisasi_to_storage_store_produk?offset=' + offset + '&limit=' + limit,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Berhasil generate:', response);

            // Delay 10 detik sebelum memanggil lagi dengan offset berikutnya
            setTimeout(function() {
                offset += parseInt(limit);
                generateLink(offset);
            }, 2000); // 10.000 ms = 10 detik
        },
        error: function(xhr, status, error) {
            console.error('Gagal:', error);

            // Coba lagi setelah 10 detik
            setTimeout(function() {
                generateLink(offset);
            }, 10000);
        }
    });
}
function generateLinkDesty(offset) {
    $.ajax({
        url: '" . base_url() . "/DestyStokManual/inisisasi_to_storage_desty_manual?offset=' + offset + '&limit=' + limit,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log('Berhasil generate:', response);

            // Delay 10 detik sebelum memanggil lagi dengan offset berikutnya
            setTimeout(function() {
                offset += parseInt(limit);
                generateLinkDesty(offset);
            }, 2000); // 10.000 ms = 10 detik
        },
        error: function(xhr, status, error) {
            console.error('Gagal:', error);

            // Coba lagi setelah 10 detik
            setTimeout(function() {
                generateLinkDesty(offset);
            }, 10000);
        }
    });
}

// Mulai looping pertama kali
function mulai_toko(){
	
generateLink(parseInt($('#mulai_dari').val()));
}function mulai_toko_desty(){
	
generateLinkDesty(parseInt($('#mulai_dari').val()));
}
</script>";
    }


    public static function import_shopee_generete($page)
    {
        $fai = new MainFaiFramework();

        $segments = Partial::uri_segment();
        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
       $domain = $page['load']['domain'];
        $page['load']['type'] = 'tambah';

         $page['is_login'] = 0;
        $page['web_load_function'] = $type_load;
        $page['load_section'] = "pages";
        $page['section'] = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";

        $page = $fai->LoadApps($page, $domain, -1, 'page');
        $nama_file = Partial::input('name');
        DB::table('desty_export_data__excel');
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
            DB::selectRaw('content_generate as nama_barang,offset_generate');
            DB::table('desty_export_data__proses_generate');


            //id_varian_1
            DB::whereRaw("desty_export_data__proses_generate.status_generate is null");
            DB::whereRaw("desty_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("desty_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);

            DB::whereRaw("desty_export_data__proses_generate.content_generate IS NOT NULL AND desty_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
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
                    'offset: 0',
                    'warna: ' . $search,
                    'limit:100'
                ]);
                // + barang
                $get_data = json_decode($get_data, 1)['data'];

                DB::selectRaw('inventaris__asset__list__varian.id as id_asset_varian
,inventaris__asset__list__varian.id_inventaris__asset__list as id_asset 
,store__produk__varian.id as id_produk_varian
,store__produk.id as id_produk
,inventaris__asset__list.id_api as id_api_varian 

,inventaris__asset__list.id_from_api as id_from_api_varian
,inventaris__asset__list.nama_barang
,inventaris__asset__list.nama_barang as nama_varian
,id_asset_list_varian');
                DB::table('inventaris__asset__list__varian');
                DB::joinRaw("inventaris__asset__list on id_asset_list_varian = inventaris__asset__list.id", "left");
                DB::joinRaw("store__produk__varian on id_barang_varian = inventaris__asset__list__varian.id", "left");
                DB::joinRaw("store__produk on store__produk.id_asset = inventaris__asset__list__varian.id_inventaris__asset__list
 and store__produk.id = store__produk__varian.id_store__produk", "left");
                DB::joinRaw("inventaris__storage__data on id_asset_varian = inventaris__asset__list__varian.id", "left");
                DB::whereRaw("inventaris__asset__list.nama_barang  like '%$search%'

and inventaris__storage__data.id is null");
                $get_storage = DB::get('all');
                if ($get_storage['num_rows']) {

                    foreach ($get_storage['row'] as $row) {
                        if ($row->id_api_varian) {
                            if (!isset($detail_API[$row->id_api_varian ?? $row->id_api])) {
                                DB::table('api_master__list');

                                DB::whereRawPage($page, "api_master__list.id=" . ($row->id_api_varian ?? $row->id_api));
                                $Get = DB::get('all');
                                $detail_API[$row->id_api_varian ?? $row->id_api] = $Get;
                            } else {
                                $Get = $detail_API[$row->id_api_varian ?? $row->id_api];
                            }

                            $detail = [];
                            $detail['id_gudang'] = $id_gudang = $Get['row'][0]->id_gudang;
                            $detail['id_ruang_simpan'] = $id_ruang_simpan = $Get['row'][0]->id_ruang_simpan;

                            $detail['id_asset'] = $row->id_asset;
                            $detail['id_produk'] = $row->id_produk;
                            $detail['id_asset_varian'] = $row->id_asset_varian;
                            $detail['id_produk_varian'] = $row->id_produk_varian;

                            $detail['id_asset_connect'] = $row->id_asset_list_varian;
                            $detail['connect_api_name'] = $row->nama_varian ?? $row->nama_barang;
                            $detail['connect_api_id'] = $row->id_from_api_varian;
                            $detail['id_api'] =  $row->id_api_varian;
                            $list[] = $detail['connect_api_name'];
                            DB::table('inventaris__storage__data');
                            DB::whereRaw('id_gudang=' . $detail['id_gudang']);
                            DB::whereRaw('id_ruang_simpan=' . $detail['id_ruang_simpan']);
                            DB::whereRaw('id_asset=' . $detail['id_asset']);
                            if ($detail['id_produk'] == null)
                                DB::whereRaw('(id_produk is null or id_produk =0)');
                            else
                                DB::whereRaw('id_produk=' . $detail['id_produk']);

                            if ($detail['id_asset_varian'] == null)
                                DB::whereRaw('(id_asset_varian is null or id_asset_varian=0)');
                            else
                                DB::whereRaw('id_asset_varian=' . $detail['id_asset_varian']);

                            if ($detail['id_produk_varian'] == null)
                                DB::whereRaw('(id_produk_varian is null  or id_produk_varian=0)');
                            else
                                DB::whereRaw('id_produk_varian=' . $detail['id_produk_varian']);
                            $storage = DB::get('all');
                            if (!$storage['num_rows']) {
                                CRUDFunc::crud_insert($fai, $page, $detail, [], "inventaris__storage__data");
                            }
                        }
                    }
                    // count($get_data);
                }
            }
            $detail = [];
        } else 
        if ($tipe_generate == 'artikel') {
            DB::selectRaw('content_generate as nama_barang,offset_generate');
            DB::table('desty_export_data__proses_generate');


            //id_varian_1
            DB::whereRaw("desty_export_data__proses_generate.status_generate is null");
            DB::whereRaw("desty_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("desty_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);

            DB::whereRaw("desty_export_data__proses_generate.content_generate IS NOT NULL AND desty_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
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
                        'search: ' . $search,
                        'limit:100'
                    ]);
                    // + barang
                    $get_data = json_decode($get_data, 1)['data'];
                    // count($get_data);
                }
            }
        } else 
        if ($tipe_generate == 'barang') {
            DB::selectRaw('content_generate as nama_barang,offset_generate');
            DB::table('desty_export_data__proses_generate');


            //id_varian_1
            DB::whereRaw("desty_export_data__proses_generate.status_generate is null");
            DB::whereRaw("desty_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("desty_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);

            DB::whereRaw("desty_export_data__proses_generate.content_generate IS NOT NULL AND desty_export_data__proses_generate.content_generate <> ''");
            DB::whereRaw("id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
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
                    'search: ' . $firstThreeWords,
                    'limit:100'
                ]);
                // + barang
                $get_data = json_decode($get_data, 1)['data'];
                // count($get_data);
            }
        } else 
        if ($tipe_generate == 'sarimbit') {




            DB::selectRaw('distinct(master.nama_barang) as nama_barang');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
            DB::joinRaw("desty_export_data__proses_generate  on content_generate =  master.nama_barang", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("desty_export_data on desty_export_data.id_produk=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=desty_export_data.id_produk", "left");
            DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");

            DB::whereRaw("desty_export_data__proses_generate.status_generate is null");
            DB::whereRaw("desty_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("desty_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("desty_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
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
                        DB::selectRaw('inventaris__asset__list.id as id_asset,inventaris__asset__list.kode_barang,inventaris__asset__list__varian.kode_varian,asset_list.id as id_barang,inventaris__asset__list__varian.id as id_varian,desty_export_data.id as id_desty_manual');

                        DB::table('inventaris__asset__list');
                        DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
                        DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
                        DB::whereRaw("(asset_list.nama_barang='" . $ukuran['nama'] . "'  or asset_list.nama_barang='" . $ukuran['nama'] . " ALL SIZE')");
                        DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
                        DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
                        DB::joinRaw("inventaris__asset__list asset_list on asset_list.id=inventaris__asset__list__varian.id_asset_list_varian", "left");
                        DB::joinRaw("desty_export_data on inventaris__asset__list__varian.kode_varian=desty_export_data.id_produk", "left");

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
                                $data_shopee['harga_seharusnya'] = $ukuran['harga'];
                                $data_shopee['generate_stok'] = 1;
                                // print_R($get);

                                // DB::update("desty_export_data", $data_shopee, ["id=$get->id_desty_manual"]);
                                DB::update("desty_export_data", $data_shopee, ["id_produk='$get->kode_varian' "]);
                                DB::update("inventaris__storage__data", ["stok_onhand" => $ukuran['stok'], "update_date" => date('Y-m-d H:i:s')], ["(connect_api_name='" . $ukuran['nama'] . "' or connect_api_name='" . $ukuran['nama'] . " ALL SIZE')"]);
                                if (!$get->id_desty_manual) {
                                    DB::table('desty_export_data');
                                    DB::whereRaw("id_produk='$get->kode_varian'");
                                    $get_sarimbit_shopee = DB::get('all');
                                    if ($get_sarimbit_shopee['num_rows']) {

                                        $get->id_desty_manual = $get_sarimbit_shopee['row'][0]->id;
                                    } else {
                                        $ukuran['id_desty_export_data__excel'] = $get_shopee['row'][0]->id;
                                        CRUDFunc::crud_insert($fai, $page, $ukuran, [], 'desty_export_data__ethica_belum');
                                    }
                                }
                                if ($get->id_desty_manual)
                                    DB::update("desty_export_data__excel__baris", ["status_generate" => 1], ["id_desty_export_data=$get->id_desty_manual and id_desty_export_data__excel=" . $get_shopee['row'][0]->id]);
                                DB::update("desty_export_data__proses_generate", ["status_generate" => 1], ["generate_by='barang' and content_generate='" . $ukuran['nama'] . "' and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
                            }
                        } else {
                            $ukuran['id_desty_export_data__excel'] = $get_shopee['row'][0]->id;
                            CRUDFunc::crud_insert($fai, $page, $ukuran, [], 'desty_export_data__ethica_belum');
                        }
                    }
                }
            }
        }
        DB::update("desty_export_data__proses_generate", ["status_generate" => 1], ["generate_by='$tipe_generate' and (content_generate='$nama_barang' or content_generate='$nama_barang ALL SIZE') and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
        if ($total >= 29 and $tipe_generate != 'sarimbit') {
            // DB::update("desty_export_data__proses_generate", ["offset_generate" => 30], ["generate_by='tipe_generate' and content_generate='$nama_barang' and id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id]);
        } else {
        }
        DB::table('desty_export_data__proses_generate');
        DB::whereRaw("id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id . " and (status_generate is null) and generate_by='barang' ");
        $get_count = DB::get('all');
        if ($tipe_generate == 'warna') {


            echo json_encode([
                'status' => 'success',
                "next_generate" =>  $get_sarimbit['num_rows'] ? "warna" : 'sarimbit',
                "sisa" => $get_sarimbit['num_rows_non_limit'] - $get_sarimbit['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
        if ($tipe_generate == 'artikel') {


            echo json_encode([
                'status' => 'success',
                "next_generate" => $get_sarimbit['num_rows'] ? "artikel" : 'barang',
                "sisa" => $get_sarimbit['num_rows_non_limit'] - $get_sarimbit['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
        if ($tipe_generate == 'barang') {
            echo json_encode([
                'status' => 'success',
                "next_generate" => $get_sarimbit['num_rows'] ? "artikel" : 'barang',
                "sisa" => $get_sarimbit['num_rows_non_limit'] - $get_sarimbit['num_rows'],
                'message' => 'Generate ' . $tipe_generate . ':' . $get_sarimbit['num_rows'],
                "nama_barang" => $nama_barang,
                "get_data" => $get_data
            ]);
        } else 
         if ($tipe_generate == 'sarimbit') {
            DB::selectRaw('distinct(master.nama_barang) as nama_barang');
            DB::table('inventaris__asset__list');
            DB::whereRaw("inventaris__asset__list.asal_barang_dari='Desty - Manual'");
            DB::whereRaw("master.nama_barang not ilike 'AYUMI%'");
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::joinRaw("inventaris__asset__list master on master.id=inventaris__asset__list.id_barang_master", "left");
            DB::joinRaw("desty_export_data__proses_generate  on content_generate =  master.nama_barang", "left"); //id_varian_1
            DB::joinRaw("inventaris__asset__list__varian on inventaris__asset__list.id=inventaris__asset__list__varian.id_inventaris__asset__list", "left");
            DB::joinRaw("desty_export_data on desty_export_data.id_produk=inventaris__asset__list.kode_barang and inventaris__asset__list__varian.kode_varian=desty_export_data.id_produk", "left");
            DB::joinRaw("desty_export_data__excel__baris on desty_export_data.id=desty_export_data__excel__baris.id_desty_export_data");

            DB::whereRaw("desty_export_data__proses_generate.status_generate is null");
            DB::whereRaw("desty_export_data__proses_generate.generate_by='$tipe_generate'");
            DB::whereRaw("desty_export_data__proses_generate.id_shoepee_export_data__excel=" . $get_shopee['row'][0]->id);
            DB::whereRaw("inventaris__asset__list.id_barang_master is not null");
            DB::whereRaw("inventaris__asset__list__varian.id_asset_list_varian is not null");
            DB::whereRaw("desty_export_data__excel__baris.status_generate !=1");
            DB::whereRaw("desty_export_data__excel__baris.id_desty_export_data__excel=" . $get_shopee['row'][0]->id);
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
    public static function export_excel_from_database($page)
    {


        // === Step 1: Ambil struktur header dari Excel sebelumnya ===
        $template_path = './uploads/6884f302c6f06.xlsx'; // file Excel acuan
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
        $table_name = 'desty_export_data';

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
}
