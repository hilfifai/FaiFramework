<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
class SBI extends CI_Controller {

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
	public function get_file($page_view='company_profile',$apps='POS',$type='view')
	{
		
		$fai = new MainFaiFramework();
		$page  = $fai->Apps($apps,$page_view);
		$page['app_framework'] ='laravel';
		$page['database_provider'] ='postgres';
		$page['database_name'] ='harlem';
		
        $page['conection_server'] = 'localhost';
        $page['conection_name_database']='harlem';
        $page['conection_user']='root';
        $page['conection_password'] = '';
        
		$page['file_open'] ="@extends('layouts.app')
					@section('content')";
		$page['file_closed'] ='@endsection';
		$page['link_page'] =$page_view;
		$fai->view_source($page,$type);
			
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
			$route_page = base_url().'sbi/all_page';
			$page['app_framework'] ='ci';
			$page['database_provider'] ='postgres';
			$page['database_name'] ='harlem';
			
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='be3';
	        $page['conection_user']='postgres';
			$page['conection_password'] = 'postgres';
			$page['conection_scheme'] = 'public';
	        
	        $page['meta']['title'] = "Harlem Resto";
	        $page['meta']['keyword'] = "Harlem Resto";
	        $page['meta']['description'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
	        $page['meta']['google_seo'] = "Harlem Resto adalahh sebuah tempat makan dibawah Ethics Group yang bertempat di Jl Aceh No 64";
				
				
			$page['template'] = 'sneat';
			$fai = new MainFaiFramework();
				
				$page['load']['sidebar'] = $fai->Apps('POS','menu');;
				$page['load']['route_page'] = $route_page;
				$page['load']['apps'] = 'POS';
				$page['load']['page_view'] = 'cabang';
				$page['load']['type'] = 'list';
				$page['load']['apps'] = 'POS';
				$page['load']['id'] = '-1';
				$page['load']['menu'] = '-1';
			
			
			return $fai->allPage($page);
	}
}
