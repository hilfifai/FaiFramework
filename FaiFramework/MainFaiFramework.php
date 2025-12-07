<?php
require_once(__DIR__ . '/Structure/Controller/Configuration.php');
require_once(__DIR__ . '/Structure/Controller/Partial.php');

require_once(__DIR__ . '/Structure/App/Workspace.php');

require_once(__DIR__ . '/Structure/App_class/WaApp.php');
require_once(__DIR__ . '/Structure/App_class/ErpPosApp.php');
require_once(__DIR__ . '/Structure/App_class/ChatApp.php');
require_once(__DIR__ . '/Structure/App_class/WorkspaceApp.php');
require_once(__DIR__ . '/Structure/App_class/HabitsApp.php');
require_once(__DIR__ . '/Structure/App_class/ErpPosApp.php');
require_once(__DIR__ . '/Structure/App_class/EcommerceApp.php');
require_once(__DIR__ . '/Structure/App_class/ChatApp.php');


require_once(__DIR__ . '/Structure/Content_class/CrudContent.php');
require_once(__DIR__ . '/Structure/Content_class/CardContent.php');
require_once(__DIR__ . '/Structure/Content_class/TemplateContent.php');
require_once(__DIR__ . '/Structure/Content_class/Content.php');
require_once(__DIR__ . '/Structure/Content_class/ApiContent.php');
require_once(__DIR__ . '/Structure/Content_class/CrudContent.php');
require_once(__DIR__ . '/Structure/Content_class/BundleContent.php');
require_once(__DIR__ . '/Structure/Content_class/IndexedDBContent.php');

require_once(__DIR__ . '/Structure/Function_class/CRUDFunc.php');
require_once(__DIR__ . '/Structure/Function_class/CardFunc.php');
require_once(__DIR__ . '/Structure/Function_class/FileFunc.php');
require_once(__DIR__ . '/Structure/Function_class/PrivilageFunc.php');
require_once(__DIR__ . '/Structure/Function_class/PanelFunc.php');
require_once(__DIR__ . '/Structure/Function_class/MenuFunc.php');

require_once(__DIR__ . "/vendor/autoload.php");
require_once(__DIR__ . "/vendor/TCPDF/examples/tcpdf_include.php");
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
		if ($domain == '192.168.70.159') {
			$domain = 'hibe3.com';
		}
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
}
