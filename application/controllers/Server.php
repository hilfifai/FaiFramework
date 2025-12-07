<?php
defined('BASEPATH') or exit('No direct script access allowed');
define("APP_FRAMEWORK", "ci");
define("DATABASE_PROVIDER", "postgres");
define("CONECTION_SERVER", "localhost");

define("DATABASE_NAME", "pwvndpvl_dbmoesneed");
define("CONECTION_NAME_DATABASE", "pwvndpvl_dbmoesneed");
define("CONECTION_USER", "pwvndpvl_moes");
define("CONECTION_PASSWORD", "pwvndpvl_moes");
define("CONECTION_SCHEME", "public");
require_once(BASEPATH . '../FaiFramework/MainFaiFramework.php');
require_once(BASEPATH . '../FaiFramework/Structure/App_class/ApiApp.php');
require_once(BASEPATH . '../FaiFramework/Structure/App_class/WaApp.php');
require_once(BASEPATH . '../FaiFramework/Structure/App_class/ChatbotApp.php');

class FaiServer extends CI_Controller
{
    public function start(){
        echo 'HALLOW';
    }
	public function index($all = -1, $function = "", $id_web_apps = "", $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
	{

		$fai = new MainFaiFramework();


		//$all = menu / class/function
		$type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
		if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

			$domain = $fai->input('frameworksubdomain');
		} else
			$domain = $_SERVER['HTTP_HOST'];
		if (!$type_load) {
			$type_load = $this->uri->segment(1);
		}
		if ($domain == 'localhost') {
			$domain = 'ajis.hibe3.com';
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
		DB::connection($page);
		$page['web_load_function'] = $type_load;
		$page['load_section'] = "pages";
		$page['load']['login-session-utama']['session_name'] = "id_apps_user";

		$page['load_section'] = "page";

		if ($type_load == 'costum') {
			FaiServer::costum($page, $domain, $all, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "");
		} else if ($type_load == 'login') {
			$page = $fai->LoadApps($page, $domain, -1, 'page');
			$page['load']['login'] = 1;
			// echo 'masuk';
			$page['load']['force_login'] = 1;
			echo  $fai->AllPage($page, -1, -99, -99);
		} else if (($type_load == 'daftar' or $type_load == 'registered')and $fai->input("type")!='select2') {
			$page = $fai->LoadApps($page, $domain, $all, 'page');
			$page['load']['login'] = 1;
			$page['load']['type'] = "daftar";
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
			$link =  $protocol . $page['load']['domain'] . '/daftar';
			$link2 =  $protocol . $page['load']['domain'] . '/pages/'; 
			$page = $fai->LoadApps($page, $domain, $all, 'page');
			$page = $fai->Apps('Auth', 'login_page_1', $page);;
			$page['load']['login'] = 1;
			$page['load']['type'] = "daftar";
			$page['load']['link_route'] = $link2;
			$page['load']['route_page'] = $link;
			$page['load']['id'] = $this->uri->segment(2) ? $this->uri->segment(2) : -1;;
			echo  $fai->AllPage($page, 'daftar', -99, $page['load']['id']);
			// 			$page_temp = $page;
			// 			$page_temp['route_type'] = "just_link";
			// 			$all = Partial::link_direct($page_temp, base_url() . "pages/", array("Dashboard", "user", "daftar", "-1", "-1", "-1", -1));

			// 			echo '<script> window.location.href="' . $all . '";</script>';
		} else if ($type_load == 'myprofile') {
			$page_temp = $page;
			$page_temp['route_type'] = "kode";
			$all = Partial::link_direct($page_temp, base_url() . "pages/", array("User", "dashboard", "view_layout", "-1", "-1", "-1", -1));

			$fai->LoadApps($page, $domain, $all);
		} else if ($type_load == 'profile') {
		} else if ($type_load == 'api') {
			FaiServer::api($all);
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

				$page_temp = $page;
				$page_temp['route_type'] = "just_link";
				$link = Partial::link_direct($page_temp, base_url() . "pages/", array("Workspace", "admin", "list", "-1", "-1", "-1", $get['row'][0]->id));
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
		} else {
			$fai->LoadApps($page, $domain, $all);
		}
	}
	public static function costum($class, $function, $id_web_apps, $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
	{

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
                                    where web__apps.id='$id_web_apps'"));;
		$type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
		if (($fai->input('frameworksubdomain')) and $fai->input('frameworksubdomain') != 'undefined') {

			$domain = $fai->input('frameworksubdomain');
		} else
			$domain = $_SERVER['HTTP_HOST'];
		
		if ($domain == 'localhost') {
			$domain = 'ajis.hibe3.com';
		}
		$page = Configuration::LoadApps($page, $domain, -1, 'page');
		$type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';



		$page['web_load_function'] = $type_load;
		$page['load_section'] = "pages";
		$page['domain'] = $domain;
		$page['load']['domain'] = $domain;
		$page['load_section'] = "page";

		if (count($get)) {
			$apps  = $get[0];

			$page['load']['database']['id']['text'] = $apps->database_id_text;
			$page['load']['database']['id']['type'] = $apps->database_id_type;
			$page['load']['database']['id']['on_table'] = $apps->database_id_on_table;

			return $fai->Apps($class, $function, $page, $param1, $param2, $param3, $param4, $param5);
		}
	}
	public static function api($function)
	{
		// if (!isset($_SESSION['id_apps_user'])) {
		// 	echo 'silahkan login/daftar terlebih dahulu';
		// 	die;
		// } else if (!($_SESSION['id_apps_user'])) {
		// 	echo 'silahkan login/daftar terlebih dahulu';
		// 	die;
		// }

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
		$domain = $_SERVER['HTTP_HOST'];
		$domain = "hibe3.com";
		$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where domain_utama='$domain'"));;


		if (count($get)) {

			$api = new ApiApp();
			return $api->$function($page);
		}
	}
	public static function store($be3id)
	{
		$fai = new MainFaiFramework();
		$domain = $_SERVER['HTTP_HOST'];
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
		// array("Ecommerce", "toko", "view_layout", "row:id_toko!Detail|")

		//	redirect();
	}
	public static function produk($be3id)
	{
		$fai = new MainFaiFramework();
		$domain = $_SERVER['HTTP_HOST'];
		//	$domain = "hibe3.com";
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
		} else
			$domain = $_SERVER['HTTP_HOST'];
		//$domain = "hibe3.com";
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
	public static function config($page)
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
		$page['meta']['description'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
		$page['meta']['google_seo'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";


		$page['load_section'] = "admin";
		$page['template'] = 'sneat';
		$fai = new MainFaiFramework();

		$page['load']['sidebar'] = $fai->Apps('Web', 'menu');;
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
		// DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
		$utama = DB::get('all');

		// 		$page['load']['crud_template']['class']['button_save'] ="btn btn-primary";

		$utama['num_rows'];
		if (($utama['num_rows'])) {
			$apps  = $utama['row'][0];

			if ($apps->folder_template) {
				$apps->folder_template;
				$pagetemp =  $page;
				$page = ($fai->template_base(str_replace(array("-", " "), array("_", "_"), strtolower($apps->folder_template))));
				$page = array_merge_recursive($page, $pagetemp);
			}
			$protocol = 'https://';
		}
		$page['load']['row_web_apps'] = $apps;
		$domain_sub_route = base_url();
		if ($_SERVER['SERVER_NAME'] == 'localhost') {
			$domain_sub_route = "http://localhost/FrameworkServer/FaiServer/";
		}
		$page['load']['link_route'] = $domain_sub_route . 'config/-1';
		$page['load']['route_page'] = $domain_sub_route . 'config/-1';
		$page['load']['view_page'] = "files";
		// 		$page['load']['link'] = 'direct';
		return $fai->AllPage($page);
	}
	public function get()
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
		$get = DB::fetchResponse(DB::select("select *,web__apps.id as id_web__apps
								from web__apps
								left join web__menu on web__menu.id = id_first_menu
								left join web__template on web__template.id = id_template
                                    where web__apps.domain_utama='hibe3.com'"));;


		if (count($get)) {
			$apps  = $get[0];

			$page['load']['database']['id']['text'] = $apps->database_id_text;
			$page['load']['database']['id']['type'] = $apps->database_id_type;
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
}
