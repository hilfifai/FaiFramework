<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH . '../FaiFramework/MainFaiFramework.php');define("DATABASE_PROVIDER", "postgres");
define("APP_FRAMEWORK", "ci");
define("DATABASE_NAME", "hexghtba_be3");
define("CONECTION_SERVER", "localhost");
define("CONECTION_NAME_DATABASE", "hexghtba_be3");
define("CONECTION_USER", "hexghtba");
define("CONECTION_PASSWORD", "be3gritofficial");
define("CONECTION_SCHEME", "public");
class DrRinaPage extends CI_Controller {

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
	 public function Chat_model() {
        parent::__construct();
    }
	public function get_file($page_view='master',$apps='DrRina',$type='list')
	{
		
		$fai = new MainFaiFramework();
		$page  = $fai->Apps($apps,$page_view);
		//print_r($fai->template_base('adminlte'));
		$page = array_merge_recursive($page ,$fai->template_base('adminlte'));
		//print_r($page);
		$page['app_framework'] ='laravel';
		$page['database_provider'] ='postgres';
		$page['database_name'] ='drrina';
		
		$page['app_framework'] = APP_FRAMEWORK;
		
		$page['app_framework'] ='laravel';
		$page['database_provider'] = DATABASE_PROVIDER;
		$page['database_name'] = DATABASE_NAME;
		$page['conection_server'] = CONECTION_SERVER;
		$page['conection_name_database'] = CONECTION_NAME_DATABASE;
		$page['conection_user'] = CONECTION_USER;
		$page['conection_password'] = CONECTION_PASSWORD;
		$page['conection_scheme'] = CONECTION_SCHEME;
		$page['file_open'] ="@extends('layouts.app2')
					@section('content')";
		$page['file_closed'] ='@endsection';
		$page['link_page'] =$page_view;
		
		$route_page = '"'.'.Helper_function::url()."';
		$route_page = '';
		$page['load']['database']['update_by'] = "updated_by";
		$page['load']['database']['update_date'] = "updated_at";

		$page['load']['database']['delete_by'] = "deleted_by";
		$page['load']['database']['delete_date'] = "deleted_at";
	
		$page['load']['database']['create_by'] = "created_by";
		$page['load']['database']['create_date'] = "created_at";
		$page['load']['crud']['type_form_default']['costum_class']['text'] = "select2bs4";
		$page['load']['crud']['type_form_default']['costum_class']['type'] = "select";
		
		$page['load']['route_page'] = $route_page;
		$page['load']['page_view'] = $page_view;
		$page['load']['type'] = $type;
		$page['load']['apps'] = '';
		$page['load']['view_source'] = true;
		$page['import_export'] = true;
		$page['section'] = 'view_source';
		$page['load_section'] = 'viewsource';
		
		$fai->AllPage($page,$type);
			
	}
	
	
	public function all_page()
	{
			
		 $route_page = base_url().'ApotekPage/all_page';
			$page['app_framework'] ='ci';
			$page['database_provider'] ='postgres';
			$page['database_name'] ='apotek';
			
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='apotek2';
	        $page['conection_user']='postgres';
	        $page['conection_password'] = 'postgres';
	        $page['conection_scheme'] = 'public';
	        
	        $page['meta']['title'] = "Local";
	        $page['meta']['keyword'] = "Harlem Resto";
	        $page['meta']['description'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
	        $page['meta']['google_seo'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
				
				
			$page['template'] = 'sneat';
			$fai = new MainFaiFramework();
				
				$page['load']['sidebar'] = $fai->Apps('Apotek','menu');;
				$page['load']['route_page'] = $route_page;
				$page['load']['apps'] = 'Apotek';
				$page['load']['page_view'] = 'penjualan__tagihan';
				$page['load']['type'] = 'tambah'; 
				$page['load']['id'] = '-1';
				$page['load']['menu'] = '-1';
			
				$page['load']['database']['update_by'] = "updated_by";
				$page['load']['database']['update_date'] = "updated_at";

				$page['load']['database']['delete_by'] = "deleted_by";
				$page['load']['database']['delete_date'] = "deleted_at";
			
				$page['load']['database']['create_by'] = "created_by";
				$page['load']['database']['create_date'] = "created_at";
			return $fai->allPage($page);
	}
}
