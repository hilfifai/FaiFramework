<?php
// defined('BASEPATH') or exit('No direct script access allowed');
// define("APP_FRAMEWORK", "ci");
// // define("DATABASE_PROVIDER", "postgres");
// define("CONECTION_SERVER", "localhost");
// define("DATABASE_PROVIDER", "mysql");
// // define("CONECTION_SERVER", "moesneeds.id");
// define("DATABASE_NAME", "u996263040_moesneeds");
// define("CONECTION_NAME_DATABASE", "u996263040_moesneeds");
// define("CONECTION_USER", "u996263040_moesneeds");
// define("CONECTION_PASSWORD", "Moesneeds.id`1");
// define("CONECTION_SCHEME", "public");
require_once BASEPATH . '../FaiFramework/MainFaiFramework.php';
require_once BASEPATH . '../FaiFramework/Structure/App_class/ApiApp.php';
require_once BASEPATH . '../FaiFramework/Structure/App_class/VersionApp.php';
require_once BASEPATH . '../FaiFramework/Structure/App_class/JsonApp.php';
require_once BASEPATH . '../FaiFramework/Structure/App_class/WaApp.php';
require_once BASEPATH . '../FaiFramework/Structure/App_class/ChatbotApp.php';

class FaiServer extends CI_Controller
{
    public function index(){
        MainFaiFramework::route_request();
    }
    public function index2($all = -1, $function = "", $id_web_apps = "", $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
    {
        // ini_set('memory_limit', '-1');
        //error_reporting(0);
        //       ini_set('display_errors', 0);  

        $fai = new MainFaiFramework();

        $page['app_framework']           = APP_FRAMEWORK;
        $page['database_provider']       = DATABASE_PROVIDER;
        $page['database_name']           = DATABASE_NAME;
        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;

        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

            $domain = $fai->input('frameworksubdomain');
        } else {
            $domain = $_SERVER['HTTP_HOST'];
        }

        if (! $type_load) {
            $type_load = $this->uri->segment(1);
        }
        if ($domain == 'localhost' and $page['conection_server'] == 'localhost') {
            $domain = 'ajis.hibe3.com';
        } else {
            $domain = 'moesneeds.id';

        }
        $domain                 = 'moesneeds.id';
        $page['domain']         = $domain;
        $page['load']['domain'] = $domain;

        $key                                                 = DB::connection($page);
        $page['database_connected']                          = $key;
        $page['web_load_function']                           = $type_load;
        $page['load_section']                                = "pages";
        $page['load']['login-session-utama']['session_name'] = "id_apps_user";

        $page['load_section'] = "page";
        $page['section']      = "page";

        if ($type_load == 'costum') {
            FaiServer::costum($page, $domain, $all, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "");
        } else if ($type_load == 'login') {
            $page                  = $fai->LoadApps($page, $domain, -1, 'page');
            $page['load']['login'] = 1;
            // echo 'masuk';
            $page['load']['force_login'] = 1;
            echo $fai->AllPage($page, -1, -99, -99);
        } else if (($type_load == 'daftar' or $type_load == 'registered') and $fai->input("type") != 'select2') {
            $page                  = $fai->LoadApps($page, $domain, $all, 'page');
            $page['load']['login'] = 1;
            $page['load']['type']  = "daftar";
            if (
                isset($_SERVER['HTTPS']) &&
                ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
                isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
            ) {
                $protocol = 'https://';
            } else {
                $protocol = 'http://';
            }
            $link                       = $protocol . $page['load']['domain'] . '/daftar';
            echo $link2                 = $protocol . $page['load']['domain'] . '/pages/';
            $page                       = $fai->LoadApps($page, $domain, $all, 'page');
            $page                       = $fai->Apps('Auth', 'login_page_1', $page);
            $page['load']['login']      = 1;
            $page['load']['type']       = "daftar";
            $page['load']['link_route'] = $link2;
            $page['load']['route_page'] = $link;
            $page['load']['id']         = $this->uri->segment(2) ? $this->uri->segment(2) : -1;
            echo $fai->AllPage($page, 'daftar', -99, $page['load']['id']);
            // 			$page_temp = $page;
            // 			$page_temp['route_type'] = "just_link";
            // 			$all = Partial::link_direct($page_temp, base_url() . "pages/", array("Dashboard", "user", "daftar", "-1", "-1", "-1", -1));

            // 			echo '<script> window.location.href="' . $all . '";</script>';
        } else if ($type_load == 'myprofile') {
            $page_temp               = $page;
            $page_temp['route_type'] = "kode";
            $all                     = Partial::link_direct($page_temp, base_url() . "pages/", ["User", "dashboard", "view_layout", "-1", "-1", "-1", -1]);

            $fai->LoadApps($page, $domain, $all);
        } else if ($all == 'page') {
            $page = $fai->LoadApps($page, $domain, -1, 'page');
            return $page;
        } else if ($type_load == 'profile') {
        } else if ($type_load == 'api') {
            $page = $fai->LoadApps($page, $domain, -1, 'page');
            FaiServer::api($all, $page, $domain);
        } else if ($type_load == 'test_script') {
            FaiServer::test_script($all);
        } else if ($type_load == 'store') {
            FaiServer::store($all);
        } else if ($type_load == 'produk') {
            FaiServer::produk($all);
            FaiServer::store($all);
        } else if ($type_load == 'search') {

            $fai->searchNavbar($page, $domain, $all);
        } else if ($type_load == 'config') {
            FaiServer::config($page, $all);
        } else if ($type_load == 'workspace') {
            DB::connection($page);
            $page = $fai->LoadApps($page, $domain, $all, 'workspace');
            DB::queryRaw($page, "select * from web__list_apps_board where be3_id='$all';");
            $get = DB::get('all');
            if ($get['num_rows']) {

                $page_temp               = $page;
                $page_temp['route_type'] = "just_link";
                $link                    = Partial::link_direct($page_temp, base_url() . "pages/", ["Workspace", "admin", "list", "-1", "-1", "-1", $get['row'][0]->id]);
                echo $link;
                die;
                echo '<script> window.location.href="' . $link . '";</script>';
            } else {
                echo "Workspace dengan kode $all tidak ditemukan";
            }
            // 			DB::connection($page);
            // 			DB::queryRaw($page, 'select * from web__list_apps_board where be3_id=\'KJSSTORE\';');
            // 			$get = DB::get('all');
            // 			$page_temp = $page;
            // 			$page_temp['route_type'] = "just_link";
            // 			$link = Partial::link_direct($page_temp, base_url() . "pages/", array("Workspace", "admin", "list", "-1", "-1", "-1", $get['row'][0]->id));
            // 			echo '<script> window.location.href="' . $link . '";</script>';
        } else if ($type_load == 'website') {

            $fai->LoadApps($page, $all, -1);
        } else {

            $fai->LoadApps($page, $domain, $all);
        }
    }
    public static function json($db)
    {
        // =================================================================
        // BAGIAN 1: PENGATURAN AWAL & FUNGSI HELPER AUTENTIKASI
        // =================================================================
        date_default_timezone_set('UTC');

        // Atur header di awal untuk konsistensi
        header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
        header('Content-Type: application/json');

        // Fungsi helper dari kode Anda, untuk mendapatkan header Authorization
        function getAuthorizationHeader(): ?string
        {
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER['Authorization']);
            } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { // Nginx atau server lain
                $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = array_combine(array_map('ucwords', array_keys(apache_request_headers())), array_values(apache_request_headers()));
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
        }

        // Fungsi helper dari kode Anda, untuk mengekstrak Bearer Token
        function getBearerToken(): ?string
        {
            $headers = getAuthorizationHeader();
            if (! empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
            return null;
        }

        // Fungsi untuk mengirim response JSON dan menghentikan skrip
        function json_response(int $code, bool $success, string $message, ?array $data = null)
        {
            http_response_code($code);
            $response = ['success' => $success, 'message' => $message];
            if ($data !== null) {
                $response['data'] = $data;
            }
            echo json_encode($response);
            exit();
        }

        // =================================================================
        // BAGIAN 2: PROSES AUTENTIKASI DAN VALIDASI (GERBANG KEAMANAN)
        // =================================================================

        // 1. Dapatkan Bearer Token dari request
        $receivedToken = getBearerToken();
        if (! $receivedToken) {
            json_response(401, false, 'Akses ditolak: Authorization header tidak ditemukan atau format salah.');
        }

                                                       // 2. Buat token yang valid untuk jam ini
        $valid_token = "SECRET_TOKEN_" . date('YmdH'); // Pastikan 'SECRET_TOKEN_' sama dengan yang digunakan klien

        // 3. Bandingkan token
        if ($receivedToken !== $valid_token) {
            json_response(401, false, 'Akses ditolak: Token tidak valid atau kedaluwarsa.');
        }

                                                 // 4. (Opsional) Validasi Referer sebagai lapisan keamanan tambahan
        $allowed_referers = ['v2.moesneeds.id']; // Hanya host, tanpa protokol
        $refererHost      = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : null;
        if (! $refererHost || ! in_array($refererHost, $allowed_referers)) {
            // Anda bisa memilih untuk mengaktifkan ini atau tidak.
            // json_response(403, false, 'Akses dari sumber yang tidak diizinkan.');
        }

        // =================================================================
        // BAGIAN 3: PROSES PERMINTAAN DATA (SETELAH LOLOS KEAMANAN)
        // =================================================================

        // Dapatkan nama database dan parameter query dari GET request
        $json_input = file_get_contents('php://input');

        $request_data = json_decode($json_input, true);
        $queryParams  = [
            'where'   => $request_data['where'] ?? [],
            'orderBy' => $request_data['orderBy'] ?? [],
            'limit'   => isset($request_data['limit']) ? (int) $request_data['limit'] : null,
            'offset'  => isset($request_data['offset']) ? (int) $request_data['offset'] : 0,
        ];

        try {
            // Buat instance JsonDb (tanpa perlu API Key lagi)
            $db = new JsonApp($db);

            // Lakukan query
            $results = $db->query($queryParams);

            // Kirim hasil yang sukses
            json_response(200, true, "Query berhasil dieksekusi.", $results);

        } catch (Exception $e) {
            // Tangani error dari kelas JsonDb (misal: DB tidak ditemukan, folder cache tidak writable)
            json_response(500, false, 'Terjadi kesalahan internal: ' . $db . ' - ' . $e->getMessage() . '<pre>' . $e->getTraceAsString());
        }
    }
    public static function versions($db)
    {
        // =================================================================
        // BAGIAN 1: PENGATURAN AWAL & FUNGSI HELPER AUTENTIKASI
        // =================================================================
        date_default_timezone_set('UTC');

        // Atur header di awal untuk konsistensi
        header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
        header('Content-Type: application/json');

        // Fungsi helper dari kode Anda, untuk mendapatkan header Authorization
        function getAuthorizationHeader(): ?string
        {
            $headers = null;
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER['Authorization']);
            } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { // Nginx atau server lain
                $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = array_combine(array_map('ucwords', array_keys(apache_request_headers())), array_values(apache_request_headers()));
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
            return $headers;
        }

        // Fungsi helper dari kode Anda, untuk mengekstrak Bearer Token
        function getBearerToken(): ?string
        {
            $headers = getAuthorizationHeader();
            if (! empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
            return null;
        }

        // Fungsi untuk mengirim response JSON dan menghentikan skrip
        function json_response(int $code, bool $success, string $message, ?array $data = null)
        {
            http_response_code($code);
            $response = ['success' => $success, 'message' => $message];
            if ($data !== null) {
                $response['data'] = $data;
            }
            echo json_encode($response);
            exit();
        }

        // =================================================================
        // BAGIAN 2: PROSES AUTENTIKASI DAN VALIDASI (GERBANG KEAMANAN)
        // =================================================================

        // 1. Dapatkan Bearer Token dari request
        $receivedToken = getBearerToken();
        if (! $receivedToken) {
            json_response(401, false, 'Akses ditolak: Authorization header tidak ditemukan atau format salah.');
        }

                                                       // 2. Buat token yang valid untuk jam ini
        $valid_token = "SECRET_TOKEN_" . date('YmdH'); // Pastikan 'SECRET_TOKEN_' sama dengan yang digunakan klien

        // 3. Bandingkan token
        if ($receivedToken !== $valid_token) {
            json_response(401, false, 'Akses ditolak: Token tidak valid atau kedaluwarsa.');
        }

                                                 // 4. (Opsional) Validasi Referer sebagai lapisan keamanan tambahan
        $allowed_referers = ['v2.moesneeds.id']; // Hanya host, tanpa protokol
        $refererHost      = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : null;
        if (! $refererHost || ! in_array($refererHost, $allowed_referers)) {
            // Anda bisa memilih untuk mengaktifkan ini atau tidak.
            // json_response(403, false, 'Akses dari sumber yang tidak diizinkan.');
        }

        // =================================================================
        // BAGIAN 3: PROSES PERMINTAAN DATA (SETELAH LOLOS KEAMANAN)
        // =================================================================

        // Dapatkan nama database dan parameter query dari GET request
        $json_input = file_get_contents('php://input');

        $request_data = json_decode($json_input, true);
        $queryParams  = [
            'where'   => $request_data['where'] ?? [],
            'orderBy' => $request_data['orderBy'] ?? [],
            'limit'   => isset($request_data['limit']) ? (int) $request_data['limit'] : null,
            'offset'  => isset($request_data['offset']) ? (int) $request_data['offset'] : 0,
        ];

        try {
            // Buat instance JsonDb (tanpa perlu API Key lagi)
            $db = new JsonApp($db);

            // Lakukan query
            $results = $db->query($queryParams);

            // Kirim hasil yang sukses
            json_response(200, true, "Query berhasil dieksekusi.", $results);

        } catch (Exception $e) {
            // Tangani error dari kelas JsonDb (misal: DB tidak ditemukan, folder cache tidak writable)
            json_response(500, false, 'Terjadi kesalahan internal: ' . $db . ' - ' . $e->getMessage() . '<pre>' . $e->getTraceAsString());
        }
    }
    public static function json2($db)
    {
        date_default_timezone_set('UTC');
        function getAuthorizationHeader()
        {
            $headers = null;

            // Cek di Apache
            if (isset($_SERVER['Authorization'])) {
                $headers = trim($_SERVER['Authorization']);
            }
            // Cek di Nginx atau server lain
            elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
                $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
            }
            // Handle untuk CGI/FastCGI
            elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                $requestHeaders = array_combine(
                    array_map('ucwords', array_keys($requestHeaders)),
                    array_values($requestHeaders)
                );
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }

            return $headers;
        }

        function getBearerToken()
        {
            $headers = getAuthorizationHeader();

            // Ambil token dari header
            if (! empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            }
            return null;
        }
        $token = getBearerToken();
        header('Content-Type: application/json');

        // Validasi referer (opsional)
        $allowed_referers = ['https://v2.moesneeds.id', 'https://v2.moesneeds.id'];
        $valid_token      = "SECRET_TOKEN_" . date('YmdH'); // Token berubah setiap jam

        if ($token !== $valid_token) {
            http_response_code(401);
            die(json_encode(['error' => 'Invalid token']));
        }
        /*else if (!isset($_SERVER['HTTP_REFERER']) || !in_array(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST), $allowed_referers)) {
			http_response_code(403);
			die(json_encode(['error' => 'Access denied']));
		}*/

        // Baca file JSON
        $json_data = file_get_contents("FaiFramework/Pages/json/$db.json");

        // Validasi JSON
        json_decode($json_data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(500);
            die(json_encode(['error' => 'Invalid JSON data']));
        }

        // Output dengan header CORS jika perlu
        header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
        echo $json_data;
    }
    public static function costum($class, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
    {
        try {
            error_reporting(E_ALL);
            ini_set('display_errors', 0);
            $fai = new MainFaiFramework();
            $ci  = &get_instance();
            if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

                $domain = $fai->input('frameworksubdomain');
            } else {
                $domain = $_SERVER['HTTP_HOST'];
            }

            if (! $type_load) {
                $type_load = $ci->uri->segment(1);
            }
            if ($domain == 'localhost') {
                $domain = 'ajis.hibe3.com';
            }

            $page['load_section']            = "costum";
            $page['app_framework']           = APP_FRAMEWORK;
            $page['database_provider']       = DATABASE_PROVIDER;
            $page['database_name']           = DATABASE_NAME;
            $page['conection_server']        = CONECTION_SERVER;
            $page['conection_name_database'] = CONECTION_NAME_DATABASE;
            $page['conection_user']          = CONECTION_USER;
            $page['conection_password']      = CONECTION_PASSWORD;
            $page['conection_scheme']        = CONECTION_SCHEME;
            DB::connection($page);
            $get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where web__apps.id='$id_web_apps'"));

            $page      = Configuration::LoadApps($page, $domain, -1, 'page');
            $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';

            $page['web_load_function'] = $type_load;
            $page['load_section']      = "pages";
            $page['domain']            = $domain;
            $page['load']['domain']    = $domain;
            $page['load_section']      = "page";

            if (count($get)) {
                $apps = $get[0];

                $page['load']['database']['id']['text']     = $apps->database_id_text;
                $page['load']['database']['id']['type']     = $apps->database_id_type;
                $page['load']['database']['id']['on_table'] = $apps->database_id_on_table;

                return $fai->Apps($class, $function, $page, $param1, $param2, $param3, $param4, $param5);
            }
        } catch (Throwable $e) {
            echo "Error: " . $e->getMessage() . "<br><br>";
            echo "File: " . $e->getFile() . "\n";
            echo "Line: " . $e->getLine() . "<br><br>";
            echo "Trace:\n" . $e->getTraceAsString();
        }
    }
    public static function app2()
    {
        include BASEPATH . '../FaiFramework2/App/index.php';

    }public static function app()
    {
        $fai = new MainFaiFramework();
        return $fai->app();
        echo '<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CRUD App</title>
		<link rel="stylesheet" href="style.css">
		</head>
		<body>
		<div id="app">

		</body>
		</html>
		';
    }
    public static function api($function, $page, $domain)
    {
        // if (!isset($_SESSION['id_apps_user'])) {
        // 	echo 'silahkan login/daftar terlebih dahulu';
        // 	die;
        // } else if (!($_SESSION['id_apps_user'])) {
        // 	echo 'silahkan login/daftar terlebih dahulu';
        // 	die;
        // }
        if ($domain == '192.168.70.159') {
            $domain = 'hibe3.com';
        }
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

        $get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where domain_utama='$domain'"));

        if (count($get)) {
            $apps = $get[0];
            if ($apps->id_board == -1) {
                $is_board = false;
            } else if ($apps->id_board) {
                $is_board              = true;
                $page['load']['board'] = $page['load']['row_web_apps']->id_board;
            }
            $api = new ApiApp();
            return $api->$function($page);
        }
    }
    public static function version($function)
    {
        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        $version                         = new VersionApp();
        return $version->$function($page);
    }

    public static function test_script($be3id)
    {
        $fai                       = new MainFaiFramework();
        $domain                    = $_SERVER['HTTP_HOST'];
        $domain                    = "ajis.hibe3.com";
        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        $page['load_section']            = "page";
        $page                            = Configuration::LoadApps($page, $domain, -1, 'page');
        DB::connection($page);
        $db['select'][] = "erp__pos__utama__detail.id as id_detail
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
		";
        $db['utama']  = "erp__pos__utama__detail";
        $db['join'][] = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
        $db['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian"];
        $db['join'][] = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama"];
        $get          = Database::database_coverter($page, $db, [], 'all');
        echo '<pre>';
        echo $get['query'];
        // array("Ecommerce", "toko", "view_layout", "row:id_toko!Detail|")

        //	redirect();
    }
    public static function store($be3id)
    {
        $fai                       = new MainFaiFramework();
        $domain                    = $_SERVER['HTTP_HOST'];
        $domain                    = "hibe3.com";
        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        DB::connection($page);
        DB::table("store__toko");
        DB::whereRaw("store__toko.apps_id='$be3id'");
        $store = DB::get('all');
        $link  = $fai->route_menu_code($page, base_url(), ["Ecommerce", "toko", "view_layout", $store['row'][0]->id], 'menu');

        $fai->LoadApps($page, $domain, $link['kode']);
        // array("Ecommerce", "toko", "view_layout", "row:id_toko!Detail|")

        //	redirect();
    }
    public static function produk($be3id)
    {
        $fai    = new MainFaiFramework();
        $domain = $_SERVER['HTTP_HOST'];
        //	$domain = "hibe3.com";
        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        DB::connection($page);
        DB::table("store__produk");
        DB::whereRaw("store__produk.apps_id='$be3id'");
        $store = DB::get('all');
        $link  = $fai->route_menu_code($page, base_url(), ["Ecommerce", "detail", "view_layout", $store['row'][0]->id], 'menu');

        $fai->LoadApps($page, $domain, $link['kode']);
        // 		rray("Ecommerce", "detail", "view_layout", "row:id!card|")
        // array("Ecommerce", "toko", "view_layout", "row:id_toko!Detail|")

        //redirect();
    }
    public static function brand($function)
    {
        redirect();
    }
    // 	public function web($get,$page=array(),$domain="")
    // 	{
    // 			$fai = new MainFaiFramework(); 
    // 			$fai->web($get);
    // 	}
    public static function page($menu = -1)
    {
        $type_load = isset($_GET['load_function']) ? $_GET['load_function'] : '';
        if (isset($_GET['frameworksubdomain'])) {

            $domain = $_GET['frameworksubdomain'];
        } else {
            $domain = $_SERVER['HTTP_HOST'];
        }

        //$domain = "hibe3.com";
        $domain;
        $fai = new MainFaiFramework();

        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        DB::connection($page);

        $fai->LoadApps($page, $domain, $menu);
    }
    public static function config($page)
    {
        $type_load = isset($_GET['load_function']) ? $_GET['load_function'] : '';

        $domain                    = "hibe3.com";
        $page['load']['domain']    = $domain;
        $route_page                = base_url() . 'FaiServer/config';
        $page['app_framework']     = APP_FRAMEWORK;
        $page['database_provider'] = DATABASE_PROVIDER;
        $page['database_name']     = DATABASE_NAME;

        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;

        $page['meta']['title']       = "Test Script";
        $page['meta']['keyword']     = "Test Script";
        $page['meta']['description'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
        $page['meta']['google_seo']  = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";

        $page['load_section'] = "admin";
        $page['template']     = 'sneat';
        $fai                  = new MainFaiFramework();

        $page['load']['sidebar']    = $fai->Apps('Web', 'menu');
        $page['load']['route_page'] = $route_page;
        $page['load']['apps']       = 'web';
        $page['load']['page_view']  = 'web_apps';
        $page['load']['type']       = 'list';
        $page['load']['id']         = '-1';
        $page['load']['menu']       = '-1';
        DB::connection($page);
        DB::table('web__apps');
        DB::selectRaw("*,web__apps.id as primary_key");
        DB::whereRaw("domain_utama='$domain'");
        DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
        DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
        DB::joinRaw("web__template on  web__template.id = id_template", 'left');
        DB::joinRaw("web__menu on  web__menu.id = id_first_menu", 'left');
        // DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
        $utama = DB::get('all');

        // 		$page['load']['crud_template']['class']['button_save'] ="btn btn-primary";

        $utama['num_rows'];
        if (($utama['num_rows'])) {
            $apps = $utama['row'][0];

            if ($apps->folder_template) {
                $apps->folder_template;
                $pagetemp = $page;
                $page     = ($fai->template_base(str_replace(["-", " "], ["_", "_"], strtolower($apps->folder_template))));
                $page     = array_merge_recursive($page, $pagetemp);
            }
            $protocol = 'https://';
        }
        $page['load']['row_web_apps'] = $apps;
        $domain_sub_route             = base_url();
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $domain_sub_route = "http://localhost/FrameworkServer/FaiServer/";
        }
        $page['load']['link_route'] = $domain_sub_route . 'config/-1';
        $page['load']['route_page'] = $domain_sub_route . 'config/-1';
        $page['load']['view_page']  = "files";
        // 		$page['load']['link'] = 'direct';
        return $fai->AllPage($page);
    }
    public function get()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $page['app_framework']           = APP_FRAMEWORK;
        $page['database_provider']       = DATABASE_PROVIDER;
        $page['database_name']           = DATABASE_NAME;
        $page['conection_server']        = CONECTION_SERVER;
        $page['conection_name_database'] = CONECTION_NAME_DATABASE;
        $page['conection_user']          = CONECTION_USER;
        $page['conection_password']      = CONECTION_PASSWORD;
        $page['conection_scheme']        = CONECTION_SCHEME;
        $page['section']                 = "chatbot";
        DB::connection($page);
        $get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where web__apps.domain_utama='hibe3.com'"));

        if (count($get)) {
            $apps = $get[0];

            $page['load']['database']['id']['text']     = $apps->database_id_text;
            $page['load']['database']['id']['type']     = $apps->database_id_type;
            $page['load']['database']['id']['on_table'] = $apps->database_id_on_table;
        }

        ChatApp::initialize_chat($page, $data);
        // print_r($data);
        //print_r($row);
    }
    public function logout()
    {

        $_SESSION['is_login'] = false;
        session_destroy();
        redirect(base_url());
    }
    public function get_version_update()
    {

    }
    public function version_content()
    {

    }
}
