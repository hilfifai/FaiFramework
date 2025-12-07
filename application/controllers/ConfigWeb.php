<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
class ConfigWeb extends CI_Controller {

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
	public function get_file($page_view='inventory',$apps='Apotek',$type='list')
	{
		
		$fai = new MainFaiFramework();
		$page  = $fai->Apps($apps,$page_view);
		$page['app_framework'] ='laravel';
		$page['database_provider'] ='postgres';
		$page['database_name'] ='apotek';
		
        $page['conection_server'] = 'localhost';
        $page['conection_name_database']='apotek';
        $page['conection_user']='root';
        $page['conection_password'] = '';
        
		$page['file_open'] ="@extends('layouts.app2')
					@section('content')";
		$page['file_closed'] ='@endsection';
		$page['link_page'] =$page_view;
		
		$route_page = '"'.'.Helper_function::url()."';
		$route_page = '';
		$page['crud']['enddiv'] = '</div>';
		$page['crud']['startdiv'] = '<div class="mb-3">
		<label class="form-label"><TEXT-LABEL></TEXT-LABEL></label>';
		$page['load']['crud_template']['class']['thead'] = "table-light";
		$page['load']['crud_template']['class']['button_save'] = "btn btn-primary mb-2 me-2";
		$page['load']['crud_template']['class']['button_kembali'] = "btn btn-danger-soft mb-2 me-2";
		$page['load']['crud_template']['class']['button_print'] = "btn btn-primary mb-2 me-2";
		$page['load']['crud_template']['class']['button_add'] = "btn btn-primary-soft mb-2 me-2";
		$page['load']['crud_template']['class']['button_add_prefix'] = "flex-grow-1";
		$page['load']['crud_template']['class']['table'] = "table text-nowrap table-centered mt-0";
		$page['load']['crud_template']['class']['print'] = "btn btn-success btn-icon btn-sm rounded-circle texttooltip";
		$page['load']['crud_template']['class']['view'] = "btn btn-success texttooltip me-2";
		$page['load']['crud_template']['class']['excel'] = "btn btn-info texttooltip me-2";
		$page['load']['crud_template']['class']['pdf'] = "btn btn-info texttooltip me-2";
		$page['load']['crud_template']['class']['edit'] = "btn btn-info texttooltip me-2";
		$page['load']['crud_template']['class']['delete'] = "btn btn-danger texttooltip me-2";
		$page['load']['crud_template']['text']['view'] = "Detail";
		$page['load']['crud_template']['text']['edit'] = "Edit";
		$page['load']['crud_template']['text']['delete'] = "Delete";
		$page['load']['crud_template']['text']['kembali'] = "Batal";
		$page['load']['crud_template']['text']['save'] = "Simpan";
		$page['load']['crud_template']['table_prefix'] = '<div class="table-responsive table-card">';
		$page['load']['crud_template']['table_sufix'] = '</div>';
		$page['load']['crud_template']['list'] = array(
				"template_name"=>"dashuipro",
				"template_file"=>"",
				
			);
		$page['load']['crud_template']['vte'] = array(
				"template_name"=>"dashuipro",
				"template_file"=>"",
				
			);
		$page['load']['route_page'] = $route_page;
		$page['load']['page_view'] = $page_view;
		$page['load']['type'] = $type;
		$page['load']['apps'] = '';
		$fai->view_source($page,$type);
			
	}
	
	public function all_page()
	{
			$route_page = base_url().'ConfigWeb/all_page';
			$page['app_framework'] ='ci';
			$page['database_provider'] ='mysql';
			$page['database_name'] ='be3';
			
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='be3';
	        $page['conection_user']='root';
	        $page['conection_password'] = '';
	        $page['conection_scheme'] = 'public';
			$page['database_provider'] ='postgres';
			$page['database_name'] ='be3';
			
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='be3';
	        $page['conection_user']='postgres';
	        $page['conection_password'] = 'postgres';
	        $page['conection_scheme'] = 'public';
	        
	        $page['meta']['title'] = "Test Script";
	        $page['meta']['keyword'] = "Test Script";
	        $page['meta']['description'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
	        $page['meta']['google_seo'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
				
				
			$page['template'] = 'sneat';
			$fai = new MainFaiFramework();
				
				$page['load']['sidebar'] = $fai->Apps('Web','menu');;
				$page['load']['route_page'] = $route_page;
				$page['load']['apps'] = 'web';
				$page['load']['page_view'] = 'web_apps';
				$page['load']['type'] = 'list'; 
				$page['load']['id'] = '-1';
				$page['load']['menu'] = '-1';
			
			
			return $fai->allPage($page);
	}
	
}
