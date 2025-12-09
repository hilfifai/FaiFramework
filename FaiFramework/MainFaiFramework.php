<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../','./.env');

// if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === 'localhost') {
//     $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.development');
// } else {
//     $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env');
// }
$dotenv->load();

define("APP_FRAMEWORK", $_ENV['APP_FRAMEWORK'] ?: "standalone");
define("DATABASE_PROVIDER", $_ENV['DATABASE_PROVIDER'] ?: "mysql");
define("CONECTION_SERVER", $_ENV['CONECTION_SERVER'] ?: "localhost");
define("DATABASE_NAME", $_ENV['DATABASE_NAME'] ?: "u996263040_moesneeds");
define("CONECTION_NAME_DATABASE", $_ENV['CONECTION_NAME_DATABASE'] ?: "u996263040_moesneeds");
define("CONECTION_USER", $_ENV['CONECTION_USER'] ?: "u996263040_moesneeds");
define("CONECTION_PASSWORD", $_ENV['CONECTION_PASSWORD'] );
define("CONECTION_SCHEME", $_ENV['CONECTION_SCHEME'] ?: "public");
define('BASEPATH_FAI', __DIR__ . '/' . ($_ENV['BASEPATH_FAI'] ?? '../'));
define('BASEPATH', __DIR__ . '/../');

require_once(__DIR__ . '/Structure/Controller/Configuration.php');
require_once(__DIR__ . '/Structure/Controller/Partial.php');

require_once(__DIR__ . '/Structure/App/Workspace.php');

require_once(__DIR__ . '/Structure/App_class/WaApp.php');
require_once(__DIR__ . '/Structure/App_class/ErpPosApp.php');
require_once(__DIR__ . '/Structure/App_class/ChatApp.php');
require_once(__DIR__ . '/Structure/App_class/WorkspaceApp.php');
require_once(__DIR__ . '/Structure/App_class/HabitsApp.php');
require_once(__DIR__ . '/Structure/App_class/ErpPosApp.php');
// if (file_exists(__DIR__ . '/Structure/App_class/EcommerceApp.php')) {
require_once(__DIR__ . '/Structure/App_class/EcommerceApp.php');
// }
require_once(__DIR__ . '/Structure/App_class/ChatApp.php');
require_once(__DIR__ . '/Structure/App_class/ApiApp.php');
require_once(__DIR__ . '/Structure/App_class/VersionApp.php');
require_once(__DIR__ . '/Structure/App_class/GenerateApp.php');
require_once(__DIR__ . '/Structure/App_class/JsonApp.php');
require_once(__DIR__ . '/Structure/App_class/WaApp.php');
require_once(__DIR__ . '/Structure/App_class/ChatbotApp.php');

require_once(__DIR__ . '/Structure/Content_class/CrudContent.php');
require_once(__DIR__ . '/Structure/Content_class/CardContent.php');
require_once(__DIR__ . '/Structure/Content_class/TemplateContent.php');
require_once(__DIR__ . '/Structure/Content_class/SearchContent.php');
require_once(__DIR__ . '/Structure/Content_class/Content.php');
require_once(__DIR__ . '/Structure/Content_class/ApiContent.php');
require_once(__DIR__ . '/Structure/Content_class/CrudContent.php');
require_once(__DIR__ . '/Structure/Content_class/BundleContent.php');
require_once(__DIR__ . '/Structure/Content_class/MenuContent.php');
require_once(__DIR__ . '/Structure/Content_class/MenuListContent.php');
require_once(__DIR__ . '/Structure/Content_class/IndexedDBContent.php');

require_once(__DIR__ . '/Structure/Function_class/CRUDFunc.php');
require_once(__DIR__ . '/Structure/Function_class/CardFunc.php');
require_once(__DIR__ . '/Structure/Function_class/FileFunc.php');
require_once(__DIR__ . '/Structure/Function_class/PrivilageFunc.php');
require_once(__DIR__ . '/Structure/Function_class/PanelFunc.php');
require_once(__DIR__ . '/Structure/Function_class/MenuFunc.php');

if (file_exists(__DIR__ . "/vendor/autoload.php")) {
	require_once(__DIR__ . "/vendor/autoload.php");
}
if (file_exists(__DIR__ . "/vendor/TCPDF/examples/tcpdf_include.php")) {
	require_once(__DIR__ . "/vendor/TCPDF/examples/tcpdf_include.php");
}
// require_once(__DIR__ . '/Pages/content/_Card.php');
// require_once(__DIR__ . '/../../Pages/content/_Form.php');
// require_once(__DIR__ . '/Pages/content/_Button.php');
// use Barryvdh\DomPDF\Facade\Pdf;
//use Dompdf\Dompdf as Pdf;

use App\Helper_function;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
// require_once('Structure/Controller/Packages.php');
//require_once('Database/Main_db.php');

function libfai()
{
	return '../Fai/';
}

function base_url()
{
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
	$port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80;
	// if (($protocol === 'http://' && $port != 80) || ($protocol === 'https://' && $port != 443)) {
	// 	$domainName .= ':' . $port;
	// }
	return $protocol . $domainName . '/';
}
class MainFaiFramework extends Configuration
{
	public $db;
	public function __construct()
	{
		$this->db = new DB();
	}
	public static function app()
	{
		$domain = ($_SERVER['SERVER_NAME']);
		if ($domain == 'localhost') {
			$domain = 'hibe3.com';
		}
		if ($domain == 'localhost:8000') {
			$domain = 'moesneeds.id';
		}
		if ($domain == '192.168.70.159') {
			$domain = 'hibe3.com';
		}
		$domain;
		$fai = new MainFaiFramework();
		$page['load_section'] = "costum";
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		DB::connection($page);
		$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where web__apps.domain_utama='$domain'"));;

		$page = Configuration::LoadApps($page, $domain, -1, 'page');
		include('App/index.php');
	}

	public static function route_request()
	{

		// Parse the request URI
		$requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
		$basePath = dirname($scriptName);

		if ($basePath && $basePath !== '/' && strpos($requestUri, $basePath) === 0) {
			$requestUri = substr($requestUri, strlen($basePath));
		}
		$requestUri = preg_replace('#/+#', '/', $requestUri);
		// hilangkan query string
		$requestUri = explode('?', $requestUri)[0];

		// bersihkan
		$requestUri = trim($requestUri, '/');

		// ambil segment
		$segments = array_values(array_filter(explode('/', $requestUri))); // reset index
		$segments = explode('/', $requestUri);
		$segments = array_filter($segments); // Remove empty segments

		$type_load = isset($segments[0]) ? $segments[0] : '';
		$all = isset($segments[1]) ? $segments[1] : -1;
		$function = isset($segments[2]) ? $segments[2] : "";
		$id_web_apps = isset($segments[3]) ? $segments[3] : "";
		$param1 = isset($segments[4]) ? $segments[4] : "";
		$param2 = isset($segments[5]) ? $segments[5] : "";
		$param3 = isset($segments[6]) ? $segments[6] : "";
		$param4 = isset($segments[7]) ? $segments[7] : "";
		$param5 = isset($segments[8]) ? $segments[8] : "";

		$fai = new MainFaiFramework();

		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		
		$type_load = MainFaiFramework::get_input('load_function') ?: $type_load;
		if ((MainFaiFramework::get_input('frameworksubdomain')) && MainFaiFramework::get_input('frameworksubdomain') != 'undefined') {
			$domain = MainFaiFramework::get_input('frameworksubdomain');
		} else {
			$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		}

		if ($domain == 'localhost' && $page['conection_server'] == 'localhost') {
			$domain = 'ajis.hibe3.com';
		} else {
			$domain = 'moesneeds.id';
		}
		$domain = 'moesneeds.id';
		$page['domain'] = $domain;
		$page['load']['domain'] = $domain;

		$key = DB::connection($page);
		$page['database_connected'] = $key;
		$page['web_load_function'] = $type_load;
		$page['load_section'] = "pages";
		$page['load']['login-session-utama']['session_name'] = "id_apps_user";

		$page['load_section'] = "page";
		$page['section'] = "page";
		$domain;
		if ($type_load == 'costum') {
			MainFaiFramework::costum($page, $domain, $all, $function, $id_web_apps, $param1, $param2, $param3, $param4, $param5);
		} elseif ($type_load == 'login') {
			$page = $fai->LoadApps($page, $domain, -1, 'page');
			$page['load']['login'] = 1;
			$page['load']['force_login'] = 1;
			echo $fai->AllPage($page, -1, -99, -99);
		} elseif (($type_load == 'daftar' || $type_load == 'registered')) {
			$page = $fai->LoadApps($page, $domain, $all, 'page');
			$page['load']['login'] = 1;
			$page['load']['type'] = "daftar";
			if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
				$protocol = 'https://';
			} else {
				$protocol = 'http://';
			}
			$link = $protocol . $page['load']['domain'] . '/daftar';
			$page = $fai->LoadApps($page, $domain, $all, 'page');
			$page = $fai->Apps('Auth', 'login_page_1', $page);
			$page['load']['login'] = 1;
			$page['load']['type'] = "daftar";
			$page['load']['link_route'] = $link;
			$page['load']['route_page'] = $link;
			$page['load']['id'] = $all ?: -1;
			echo $fai->AllPage($page, 'daftar', -99, $page['load']['id']);
		} elseif ($type_load == 'myprofile') {
			$page_temp = $page;
			$page_temp['route_type'] = "kode";
			$all = Partial::link_direct($page_temp, base_url() . "pages/", ["User", "dashboard", "view_layout", "-1", "-1", "-1", -1]);
			$fai->LoadApps($page, $domain, $all);
		} elseif ($all == 'page') {
			$page = $fai->LoadApps($page, $domain, -1, 'page');
			return $page;
		} elseif ($type_load == 'profile') {
			// Handle profile
		} elseif ($type_load == 'api') {

			$page = $fai->LoadApps($page, $domain, -1, 'page');
			MainFaiFramework::api($all, $page, $domain);
		} elseif ($type_load == 'json') {
			MainFaiFramework::json($all);
		} elseif ($type_load == 'test_script') {
			MainFaiFramework::test_script($all);
		} elseif ($type_load == 'store') {
			MainFaiFramework::store($all);
		} elseif ($type_load == 'produk') {
			MainFaiFramework::produk($all);
			MainFaiFramework::store($all);
		} elseif ($type_load == 'search') {
			$fai->searchNavbar($page, $domain, $all);
		} elseif ($type_load == 'config') {
			MainFaiFramework::config($page, $all);
		} elseif ($type_load == 'workspace') {
			DB::connection($page);
			$page = $fai->LoadApps($page, $domain, $all, 'workspace');
			DB::queryRaw($page, "select * from web__list_apps_board where be3_id='$all';");
			$get = DB::get('all');
			if ($get['num_rows']) {
				$page_temp = $page;
				$page_temp['route_type'] = "just_link";
				$link = Partial::link_direct($page_temp, base_url() . "pages/", ["Workspace", "admin", "list", "-1", "-1", "-1", $get['row'][0]->id]);
				echo $link;
				echo '<script> window.location.href="' . $link . '";</script>';
			} else {
				echo "Workspace dengan kode $all tidak ditemukan";
			}
		} elseif ($type_load == 'website') {
			$fai->LoadApps($page, $all, -1);
		} elseif ($type_load == 'version') {
			MainFaiFramework::version($all);
		} elseif ($type_load == 'get_generate') {
			MainFaiFramework::generate($page);
		} else {
			MainFaiFramework::app2();
		}
	}

	public static function get_input($key)
	{
		return $_GET[$key] ?? $_POST[$key] ?? null;
	}

	public static function json($db)
	{
		date_default_timezone_set('UTC');
		header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
		header('Content-Type: application/json');

		function getAuthorizationHeader(): ?string
		{
			$headers = null;
			if (isset($_SERVER['Authorization'])) {
				$headers = trim($_SERVER['Authorization']);
			} elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
				$headers = trim($_SERVER['HTTP_AUTHORIZATION']);
			} elseif (function_exists('apache_request_headers')) {
				$requestHeaders = array_combine(array_map('ucwords', array_keys(apache_request_headers())), array_values(apache_request_headers()));
				if (isset($requestHeaders['Authorization'])) {
					$headers = trim($requestHeaders['Authorization']);
				}
			}
			return $headers;
		}

		function getBearerToken(): ?string
		{
			$headers = getAuthorizationHeader();
			if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
			return null;
		}

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

		$receivedToken = getBearerToken();
		if (!$receivedToken) {
			json_response(401, false, 'Akses ditolak: Authorization header tidak ditemukan atau format salah.');
		}

		$valid_token = "SECRET_TOKEN_" . date('YmdH');
		if ($receivedToken !== $valid_token) {
			json_response(401, false, 'Akses ditolak: Token tidak valid atau kedaluwarsa.');
		}

		$allowed_referers = ['v2.moesneeds.id'];
		$refererHost = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : null;
		if (!$refererHost || !in_array($refererHost, $allowed_referers)) {
			// json_response(403, false, 'Akses dari sumber yang tidak diizinkan.');
		}

		$json_input = file_get_contents('php://input');
		$request_data = json_decode($json_input, true);
		$queryParams = [
			'where' => $request_data['where'] ?? [],
			'orderBy' => $request_data['orderBy'] ?? [],
			'limit' => isset($request_data['limit']) ? (int)$request_data['limit'] : null,
			'offset' => isset($request_data['offset']) ? (int)$request_data['offset'] : 0,
		];

		try {
			$db = new JsonApp($db);
			$results = $db->query($queryParams);
			json_response(200, true, "Query berhasil dieksekusi.", $results);
		} catch (Exception $e) {
			json_response(500, false, 'Terjadi kesalahan internal: ' . $db . ' - ' . $e->getMessage() . '<pre>' . $e->getTraceAsString());
		}
	}

	public static function versions($db)
	{
		date_default_timezone_set('UTC');
		header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
		header('Content-Type: application/json');

		function getAuthorizationHeader(): ?string
		{
			$headers = null;
			if (isset($_SERVER['Authorization'])) {
				$headers = trim($_SERVER['Authorization']);
			} elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
				$headers = trim($_SERVER['HTTP_AUTHORIZATION']);
			} elseif (function_exists('apache_request_headers')) {
				$requestHeaders = array_combine(array_map('ucwords', array_keys(apache_request_headers())), array_values(apache_request_headers()));
				if (isset($requestHeaders['Authorization'])) {
					$headers = trim($requestHeaders['Authorization']);
				}
			}
			return $headers;
		}

		function getBearerToken(): ?string
		{
			$headers = getAuthorizationHeader();
			if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
			return null;
		}

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

		$receivedToken = getBearerToken();
		if (!$receivedToken) {
			json_response(401, false, 'Akses ditolak: Authorization header tidak ditemukan atau format salah.');
		}

		$valid_token = "SECRET_TOKEN_" . date('YmdH');
		if ($receivedToken !== $valid_token) {
			json_response(401, false, 'Akses ditolak: Token tidak valid atau kedaluwarsa.');
		}

		$allowed_referers = ['v2.moesneeds.id'];
		$refererHost = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : null;
		if (!$refererHost || !in_array($refererHost, $allowed_referers)) {
			// json_response(403, false, 'Akses dari sumber yang tidak diizinkan.');
		}

		$json_input = file_get_contents('php://input');
		$request_data = json_decode($json_input, true);
		$queryParams = [
			'where' => $request_data['where'] ?? [],
			'orderBy' => $request_data['orderBy'] ?? [],
			'limit' => isset($request_data['limit']) ? (int)$request_data['limit'] : null,
			'offset' => isset($request_data['offset']) ? (int)$request_data['offset'] : 0,
		];

		try {
			$db = new JsonApp($db);
			$results = $db->query($queryParams);
			json_response(200, true, "Query berhasil dieksekusi.", $results);
		} catch (Exception $e) {
			json_response(500, false, 'Terjadi kesalahan internal: ' . $db . ' - ' . $e->getMessage() . '<pre>' . $e->getTraceAsString());
		}
	}

	public static function json2($db)
	{
		date_default_timezone_set('UTC');
		function getAuthorizationHeader()
		{
			$headers = null;
			if (isset($_SERVER['Authorization'])) {
				$headers = trim($_SERVER['Authorization']);
			} elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
				$headers = trim($_SERVER['HTTP_AUTHORIZATION']);
			} elseif (function_exists('apache_request_headers')) {
				$requestHeaders = apache_request_headers();
				$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
				if (isset($requestHeaders['Authorization'])) {
					$headers = trim($requestHeaders['Authorization']);
				}
			}
			return $headers;
		}

		function getBearerToken()
		{
			$headers = getAuthorizationHeader();
			if (!empty($headers)) {
				if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
					return $matches[1];
				}
			}
			return null;
		}
		$token = getBearerToken();
		header('Content-Type: application/json');
		$valid_token = "SECRET_TOKEN_" . date('YmdH');
		if ($token !== $valid_token) {
			http_response_code(401);
			die(json_encode(['error' => 'Invalid token']));
		}
		$json_data = file_get_contents("FaiFramework/Pages/json/$db.json");
		json_decode($json_data);
		if (json_last_error() !== JSON_ERROR_NONE) {
			http_response_code(500);
			die(json_encode(['error' => 'Invalid JSON data']));
		}
		header('Access-Control-Allow-Origin: https://v2.moesneeds.id');
		echo $json_data;
	}

	public static function costum($page, $domain, $class, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
	{
		try {
			error_reporting(E_ALL);
			ini_set('display_errors', 0);
			$fai = new MainFaiFramework();
			$page['load_section'] = "costum";
			$page['app_framework'] = APP_FRAMEWORK;
			$page['database_provider'] = DATABASE_PROVIDER;
			$page['database_name'] = DATABASE_NAME;
			$page['conection_server'] = CONECTION_SERVER;
			$page['conection_name_database'] = CONECTION_NAME_DATABASE;
			$page['conection_user'] = CONECTION_USER;
			$page['conection_password'] = CONECTION_PASSWORD;
			$page['conection_scheme'] = CONECTION_SCHEME;
			DB::connection($page);
			$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps from web__apps left join web__menu on web__menu.id = id_first_menu left join web__template on web__template.id = id_template where web__apps.id='$id_web_apps'"));

			$page = Configuration::LoadApps($page, $domain, -1, 'page');
			$type_load = $fai->input('load_function') ?: '';

			$page['web_load_function'] = $type_load;
			$page['load_section'] = "pages";
			$page['domain'] = $domain;
			$page['load']['domain'] = $domain;
			$page['load_section'] = "page";

			if (count($get)) {
				$apps = $get[0];
				$page['load']['database']['id']['text'] = $apps->database_id_text;
				$page['load']['database']['id']['type'] = $apps->database_id_type;
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
		include BASEPATH . 'FaiFramework2/App/index.php';
	}

	public static function api($function, $page, $domain)
	{
		
		
		$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps 
		from web__apps 
		left join web__menu on web__menu.id = id_first_menu 
		left join web__template on web__template.id = id_template where domain_utama='$domain'"));

		if (count($get)) {
			$apps = $get[0];
			if ($apps->id_board == -1) {
				$is_board = false;
			} else if ($apps->id_board) {
				$is_board = true;
				$page['load']['board'] = $page['load']['row_web_apps']->id_board;
			}
			$api = new ApiApp();
			return $api->$function($page);
		}
	}

	public static function version($function)
	{
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$version = new VersionApp();

		return $version->$function($page);
	}

	public static function generate($page)
	{
		$generate = new GenerateApp();

		return $generate->get_generate($page);
	}

	public static function test_script($be3id)
	{
		$fai = new MainFaiFramework();
		$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		$domain = "ajis.hibe3.com";
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$page['load_section'] = "page";
		$page = Configuration::LoadApps($page, $domain, -1, 'page');
		DB::connection($page);
		$db['select'][] = "erp__pos__utama__detail.id as id_detail, inventaris__asset__list.id as id_asset, inventaris__asset__list__varian.id as id_varian, inventaris__asset__list.varian_barang, inventaris__asset__list.asal_barang_dari, inventaris__asset__list.id_api, inventaris__asset__list.id_sync, inventaris__asset__list.id_from_api, inventaris__asset__list__varian.asal_from_data_varian, inventaris__asset__list__varian.id_api_varian, inventaris__asset__list__varian.id_sync_varian, inventaris__asset__list__varian.id_from_api_varian";
		$db['utama'] = "erp__pos__utama__detail";
		$db['join'][] = ["inventaris__asset__list", "inventaris__asset__list.id", "id_inventaris__asset__list"];
		$db['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian"];
		$db['join'][] = ["erp__pos__utama", "erp__pos__utama.id", "erp__pos__utama__detail.id_erp__pos__utama"];
		$get = Database::database_coverter($page, $db, [], 'all');
		echo '<pre>';
		echo $get['query'];
	}

	public static function store($be3id)
	{
		$fai = new MainFaiFramework();
		$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		$domain = "hibe3.com";
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		DB::connection($page);
		DB::table("store__toko");
		DB::whereRaw("store__toko.apps_id='$be3id'");
		$store = DB::get('all');
		$link = $fai->route_menu_code($page, base_url(), ["Ecommerce", "toko", "view_layout", $store['row'][0]->id], 'menu');
		$fai->LoadApps($page, $domain, $link['kode']);
	}

	public static function produk($be3id)
	{
		$fai = new MainFaiFramework();
		$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		DB::connection($page);
		DB::table("store__produk");
		DB::whereRaw("store__produk.apps_id='$be3id'");
		$store = DB::get('all');
		$link = $fai->route_menu_code($page, base_url(), ["Ecommerce", "detail", "view_layout", $store['row'][0]->id], 'menu');
		$fai->LoadApps($page, $domain, $link['kode']);
	}

	public static function page_static($menu = -1)
	{
		$type_load = isset($_GET['load_function']) ? $_GET['load_function'] : '';
		if (isset($_GET['frameworksubdomain'])) {
			$domain = $_GET['frameworksubdomain'];
		} else {
			$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		}
		$domain;
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
		$fai->LoadApps($page, $domain, $menu);
	}

	public static function config($page, $all)
	{
		$type_load = isset($_GET['load_function']) ? $_GET['load_function'] : '';
		$domain = "hibe3.com";
		$page['load']['domain'] = $domain;
		$route_page = base_url() . 'FaiServer/config';
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$page['meta']['title'] = "Test Script";
		$page['meta']['keyword'] = "Test Script";
		$page['meta']['description'] = "Harlem Resto adalah sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
		$page['meta']['google_seo'] = "Harlem Resto adalah sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
		$page['load_section'] = "admin";
		$page['template'] = 'sneat';
		$fai = new MainFaiFramework();
		$page['load']['sidebar'] = $fai->Apps('Web', 'menu');
		$page['load']['route_page'] = $route_page;
		$page['load']['apps'] = 'web';
		$page['load']['page_view'] = 'web_apps';
		$page['load']['type'] = 'list';
		$page['load']['id'] = '-1';
		$page['load']['menu'] = '-1';
		DB::connection($page);
		DB::table('web__apps');
		DB::selectRaw("*,web__apps.id as primary_key");
		DB::whereRaw("domain_utama='$domain'");
		DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
		DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
		DB::joinRaw("web__template on  web__template.id = id_template", 'left');
		DB::joinRaw("web__menu on  web__menu.id = id_first_menu", 'left');
		$utama = DB::get('all');
		$utama['num_rows'];
		if (($utama['num_rows'])) {
			$apps = $utama['row'][0];
			if ($apps->folder_template) {
				$apps->folder_template;
				$pagetemp = $page;
				$page = ($fai->template_base(str_replace(["-", " "], ["_", "_"], (strtolower($apps->folder_template)))));
				$page = array_merge_recursive($page, $pagetemp);
			}
			$protocol = 'https://';
		}
		$page['load']['row_web_apps'] = $apps;
		$domain_sub_route = base_url();
		if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost') {
			$domain_sub_route = "http://localhost/FrameworkServer/FaiServer/";
		}
		$page['load']['link_route'] = $domain_sub_route . 'config/-1';
		$page['load']['route_page'] = $domain_sub_route . 'config/-1';
		$page['load']['view_page'] = "files";
		return $fai->AllPage($page);
	}

	public function get_data()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$page['app_framework'] = APP_FRAMEWORK;
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$page['section'] = "chatbot";
		DB::connection($page);
		$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps from web__apps left join web__menu on web__menu.id = id_first_menu left join web__template on web__template.id = id_template where web__apps.domain_utama='hibe3.com'"));
		if (count($get)) {
			$apps = $get[0];
			$page['load']['database']['id']['text'] = $apps->database_id_text;
			$page['load']['database']['id']['type'] = $apps->database_id_type;
			$page['load']['database']['id']['on_table'] = $apps->database_id_on_table;
		}
		ChatApp::initialize_chat($page, $data);
	}

	public function logout()
	{
		$_SESSION['is_login'] = false;
		session_destroy();
		header('Location: ' . base_url());
	}
}
