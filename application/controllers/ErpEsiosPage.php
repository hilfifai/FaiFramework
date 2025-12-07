<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(BASEPATH . '../FaiFramework/MainFaiFramework.php');
define("DATABASE_PROVIDER", "postgres");
define("APP_FRAMEWORK", "ci");
define("DATABASE_NAME", "hexghtba_erp_esios");
define("CONECTION_SERVER", "localhost");
define("CONECTION_NAME_DATABASE", "hexghtba_erp_esios");
define("CONECTION_USER", "hexghtba");
define("CONECTION_PASSWORD", "be3gritofficial");
define("CONECTION_SCHEME", "public");
class ErpEsiosPage extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function Chat_model()
	{
		parent::__construct();
	}
	public function get_file($page_view = 'master', $apps = 'DrRina', $type = 'list')
	{
		// 		echo '<title>ERP ESIOS</title>';
		$fai = new MainFaiFramework();
		$page  = $fai->Apps($apps, $page_view);
		//print_r($fai->template_base('adminlte'));
		$page = array_merge_recursive($page, $fai->template_base('adminlte'));
		//print_r($page);
		$page['app_framework'] = 'laravel';
		$page['database_provider'] = 'postgres';
		$page['database_name'] = 'drrina';

		$page['app_framework'] = APP_FRAMEWORK;

		$page['app_framework'] = 'laravel';
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$page['file_open'] = "@extends('layouts.template')
					@section('content')";
		$page['file_closed'] = '@endsection';
		$page['link_page'] = $page_view;

		$route_page = '"' . '.Helper_function::url()."';
		$route_page = '';
		$page['load']['database']['update_by'] = "updated_by";
		$page['load']['database']['update_date'] = "updated_at";

		$page['load']['database']['delete_by'] = "deleted_by";
		$page['load']['database']['delete_date'] = "deleted_at";

		$page['load']['database']['create_by'] = "created_by";
		$page['load']['database']['create_date'] = "created_at";
		$page['load']['crud']['type_form_default']['costum_class']['text'] = "select2bs4";
		$page['load']['crud']['type_form_default']['costum_class']['type'] = "select";
		$page['load']['crud_template']['class']['table'] = "table table-bordered";
		$page['load']['crud_template']['style']['table'] = "font-size: smaller";
		$page['load']['crud']['costum_class'] = "form-control form-control-sm border-dark";
		$page['load']['crud']['col_row'] = "col-md-7 ";
		$page['crud']['form_type'] = 1;
		$page['load']['form']['type'] = 1;
		$page['crud']['startdiv'] = '<div class="form-group row mb-3" ><label class="control-label col-3 " style="font-weight:600"><TEXT-LABEL></TEXT-LABEL></label><div class="col-9">';
		$page['crud']['enddiv'] = "</div></div>";
		$page['load']['database']['id']['text'] = 'id';
		$page['load']['database']['id']['type'] = 'suffix'; //prefix//suffix
		$page['load']['database']['id']['on_table'] = true; //true->id_(nama table)//false->just id
		$page['load']['database']['query']['select'] = false; 
		$page['load']['crud_template']['table']['edit']['is_colom'] = true; 
		$page['load']['crud_template']['table']['edit']['nama_colum'] = "Ubah"; 
		$page['load']['crud_template']['table']['hapus']['is_colom'] = true; 
		$page['load']['crud_template']['table']['hapus']['nama_colum'] = "Hapus"; 
		$page['load']['crud_template']['table']['view']['is_colom'] = true; 
		$page['load']['crud_template']['table']['view']['nama_colum'] = "Lihat"; 
		
		$page['load']['crud_template']['class']['edit']="";
		$page['load']['crud_template']['class']['delete']="";
		$page['load']['crud_template']['class']['view']="";
		$page['load']['crud_template']['icon']['view'] = '<i class="ti ti-search" style="font-size: 16pt"></i>';
		$page['load']['crud_template']['icon']['edit'] = '<i class="ti ti-edit" style="font-size: 16pt"></i>';
		$page['load']['crud_template']['icon']['delete'] = '<i class="ti ti-x" style="font-size: 16pt"></i>';
		
		$page['load']['crud_template']['list']['template_name'] = "esios";
		$page['load']['crud_template']['list']['template_file'] = "crud_list.template";
		$page['load']['crud_template']['vte']['template_name'] = "esios";
		$page['load']['crud_template']['vte']['template_file'] = "crud_vte.template";
		$page['load']['crud_template']['class']['button_add'] = "btn btn-primary";
		$page['load']['crud_template']['style']['section_header'] = "float: left; font-size: 20pt";
		$page['load']['crud_template']['style']['button_add_prefix'] = "text-decoration: none; float: right";
		$page['load']['crud_template']['text']['kembali'] = "Kembali";
		$page['load']['crud_template']['class']['button_back'] = "btn btn-secondary";
		$page['load']['crud_template']['class']['button_save'] = "btn btn-primary me-2";
		$page['load']['crud_template']['text']['save'] = "Simpan";

		$page['load']['route_page'] = $route_page;
		$page['load']['page_view'] = $page_view;
		$page['load']['type'] = $type;
		$page['load']['apps'] = '';
		$page['load']['view_source'] = true;
		$page['import_export'] = true;
		$page['section'] = 'view_source';
		$page['load_section'] = 'viewsource';

		$fai->AllPage($page, $type);
	}
}
