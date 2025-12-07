<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfigApps extends CI_Controller {

    public function config()
	{

	}public function card_page()
	{
			$route_page = base_url().'welcome/pos_page';
			$load['apps'] = 'Organisasi';
			$load['page_view'] = 'list_organisasi';
			$load['type'] = 'view_layout';
			$load['id'] = 'Dashboard';
			$this->load->view('layout/content.php',array("route_page"=>$route_page,"load"=>$load));
	}
	public function page()
	{
			$route_page = base_url().'welcome/pos_page';
			$load['apps'] = 'POS';
			$load['page_view'] = 'cabang';
			$load['type'] = 'list';
			$load['id'] = '-1';
			$this->load->view('layout/content.php',array("route_page"=>$route_page,"load"=>$load));
	}
	public function card_test($type='Dashboard',$id=-1)
	{
		$fai = new MainFaiFramework();
		$page['app_framework'] ='laravel';
		$page['database_provider'] ='mysql';
		$page['database_name'] ='be3';
		
        $page['conection_server'] = 'localhost';
        $page['conection_name_database']='be3'; 
        $page['conection_user']='root';
        $page['conection_password'] = '';
        
		$page['file_open'] ="@extends('layouts.app')
					@section('content')";
		$page['file_closed'] ='@endsection';




		$page['title'] = "Unit Satuan";

		
		


		$card['listing_type'] = "listingmenu";//info/listing/listmenu
		$card['menu'] = array(
			"Dashboard" => array("icon",'card-layout'),
			"List Organisasi"=> array("icon",'card-menu','array-menu'),
			"LearderBoard"=> array("icon",'card-layout'),
			"Pengajuan Keanggotaan"=> array("icon",'card-menu','array-menu'),
			"Pengajuan Organisasi"=> array("icon",'card-menu-crud','array-crud'),
			"Pending Ajuan"=> array("icon",'card-menu'),
			"Ganti Panel"=> array("icon",'card-menu'),
		);
		
		$card['view_default'] = "ViewHorizontal";
					//layout//ViewHorizontal//ViewVertical//ViewListTables
					//layout -> 
		$card['array-menu'] = 
		array(
			array("img",null,"datafile",array("organisasi"),false),
			array("body","tag"),
				array("title","nama_organisasi","database",true),
				array("subtitle",array("Be3 ID: ","apps_id",""),"database-costum",true),
				array("deskripsi",array("id_organisasi_bidang_on_organisasi","organisasi_bidang","id_organisasi_bidang","nama_bidang"),"database-join",true),
		);
		$card['array-crud'] = array(
			array("Nama Organisasi","nama_organisasi","text"),
			array("Email Organisasi","email_organisasi","textarea")
		);

		$card['enkripsi'][] = "nama_organisasi";
		$card['enkripsi'][] = "email_organisasi";

		$card['config']['database']['List Organisasi']['utama'] = 'organisasi';
		$card['config']['database']['List Organisasi']['primary_key'] = 'id_organisasi';
		$card['config']['database']['List Organisasi']['where'][] = array("status_organisasi","=","'aktif'");
		$card['config']['database']['List Organisasi']['order'][] = array("nama","asc");
		
		
		$page['view_layout'][] = array("card","col-md-12",$card);
		$page['link_route'] =$this->input->get('link_route');




		$fai->page($page,$type,$id);
			
	}
	
	public function user_page($type,$id)
	{
			
			
			$fai = new MainFaiFramework();
			$page['title'] = "Company Profile" ;
			
			if(isset( $_GET['link_route']))
				$page['route'] = $_GET['link_route']  ;
			else if(isset( $_POST['link_route']))
				$page['route'] = $_POST['link_route']  ;
			$page['redirect'] = "edit" ;
			$page['layout_pdf'] = array('a2','landscape') ;
		
			$database_utama = "faiframework__user";
			$primary_key ="id_".$database_utama;
			
			$array = array(
				array("Panel","panel","select-manual",array("user"=>"User","organisasi"=>"Organisasi","program"=>"Program")),
				array("Tanggal Join","tgl_join","date"),
				array("Tanggal Expired","tgl_expired","date"),

		);
			$page['crud']['array'] = $array;
			
			$page['crud']['search']= array(-1=>array(4,1));
			$page['database']['utama'] = $database_utama;
			$page['database']['primary_key'] = $primary_key ;
			$page['database']['select'] = array("*","$database_utama.$primary_key as primary_key"); ;
			$page['database']['join'] = array();
			$page['database']['where'] = array();  
			
			$page['conection_server'] = 'localhost';
			$page['conection_name_database']='be3'; 
			$page['conection_user']='root';
			$page['conection_password'] = '';

			$fai->page($page,$type,$id);

			
		
	}public function index()
	{
		$this->load->view('layout/content.php',array("content"=>'Settingapp/configpage'));
	}
	public function contoh_tempalte()
	{
		$this->load->view('contoh_stisla');
	}
	public function config()
	{
		$this->load->view('contoh_stisla');
	}public function get_template_single()
	{
		//echo $this->input->get('template');
		if($this->input->get('template')=='CRUD Array'){
			$this->load->view('SettingApp/pages/crud');
		}
	}public function get_array_crud()
	{

			$this->load->view('SettingApp/pages/crud_array',array("no_array"=>$this->input->get('no_array')));
		
	}
}