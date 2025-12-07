<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
class ApotekPage extends CI_Controller {

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
		//print_r($fai->template_base('adminlte'));
		$page = array_merge_recursive($page ,$fai->template_base('adminlte'));
		//print_r($page);
		$page['app_framework'] ='laravel';
		$page['database_provider'] ='postgres';
		$page['database_name'] ='apotek';
		
		$page['conection_server'] = 'localhost';
		$page['conection_name_database']='apotek2';
		$page['conection_user']='postgres';
		$page['conection_password'] = 'postgres';
		$page['conection_scheme'] = 'public';
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
		$fai->AllPage($page,$type);
			
	}
	public function pos_page()
	{
		$fai = new MainFaiFramework();
		$apps=$this->input->post_get('apps');
		$page_view=$this->input->post_get('page_view');
		$type=$this->input->post_get('type');
		$id=$this->input->post_get('id');
		
		
		$page  = $fai->Apps($apps,$page_view);
		$page['app_framework'] ='ci';
		$page['database_provider'] ='mysql';
		$page['database_name'] ='harlem';
		
        $page['conection_server'] = 'localhost';
        $page['conection_name_database']='harlem';
        $page['conection_user']='root';
        $page['conection_password'] = '';
        
		
		$page['apps'] =$apps;
		$page['page_view'] =$page_view;
		$page['type'] =$type;
		$page['id'] =$id;
		$page['link_route'] =$this->input->get('link_route');
		
		$page['load']['apps'] =$apps;
		$page['load']['page_view'] =$page_view;
		$page['load']['type'] =$type;
		$page['load']['id'] =$id;
		$page['load']['link_route'] =$this->input->get('link_route');
		//echo $type;
		$fai->page($page,$type,$id);
			
		
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
