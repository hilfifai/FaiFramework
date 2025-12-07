<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
require_once(APPPATH . 'third_party\simplexlsxgen-master\src\SimpleXLSXGen.php');
		use Shuchkin\SimpleXLSXGen;
class Welcome extends CI_Controller {

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
	public function index(){
		echo' hellow';
	}
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
	public function kecamatan()
	{
		//->where("subdistrict_id")
		$kecamatan = $this->db->get('apps_wilayah__kecamatan')->result();
		foreach($kecamatan as $kecamatan){
			
			echo $data['kecamatan_id'] = $kecamatan->subdistrict_id;
			$this->db->like('city',$kecamatan->kota)->where('sub_district',''.$kecamatan->subdistrict_name.'')->update('apps_wilayah__postal_code',$data);
			echo ''.$this->db->last_query();
			echo 'done<Br>';
			
		}
		
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
        $page['conection_name_database']='be3';
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
	
	public function excel()
	{
		
		/*$data = [
		    ['Integer', 123],
		    ['Float', 12.35],
		    ['Percent', '12%'],
		    ['Currency $', '$500.67'],
		    ['Currency €', '200 €'],
		    ['Currency ₽', '1200.30 ₽'],
		    ['Currency (other)', '<style nf="&quot;£&quot;#,##0.00">500</style>'],
		    ['Currency Float (other)', '<style nf="#,##0.00\ [$£-1];[Red]#,##0.00\ [$£-1]">500.250</style>'],
		    ['Datetime', '2020-05-20 02:38:00'],
		    ['Date', '2020-05-20'],
		    ['Time', '02:38:00'],
		    ['Datetime PHP', new DateTime('2021-02-06 21:07:00')],
		    ['String', 'Very long UTF-8 string in autoresized column'],
		    ['Formula', '<f >SUM(B1:B2)</f>'],
		    ['Hyperlink', 'https://github.com/shuchkin/simplexlsxgen'],
		    ['Hyperlink + Anchor', '<a href="https://github.com/shuchkin/simplexlsxgen">SimpleXLSXGen</a>'],
		    ['Internal link', '<a href="sheet2!A1">Go to second page</a>'],
		    ['RAW string', "\0" . '2020-10-04 16:02:00']
		];*/
		
		$data = [
			[ "Kategori",//1
			  "Nama Produk","Deskripsi Produk","SKU Induk","Produk Berbahaya","Kode Integrasi Variasi","Nama Variasi 1","Varian untuk Variasi 1","Foto Produk per Varian","Nama Variasi 2","Varian untuk Variasi 2","Harga","Stok","Kode Variasi"
			  ,"Panduan Ukuran","Foto Sampul","Foto Produk 1","Foto Produk 2","Foto Produk 3","Foto Produk 4","Foto Produk 5","Foto Produk 6","Foto Produk 7","Foto Produk 8","Berat","Panjang","Lebar","Tinggi","Same Day","Next Day","Reguler (Cashless)","Hemat","Indopaket (Ambil di Indomaret)","Dikirim Dalam Pre-order","Jangka Dikirim Dalam Pre-order","Merek","Negara Asal","Masa Garansi","Jenis Garansi","Perusahaan Penerbit","Negara","Bahasa","Impor/Lokal","Terbit","ISBN","Jenis Edisi","Kota","Jenis Cover","Tahun"],
		];
		$row = $this->db->query("
		select *,
			(select content_detail from ltw_inventoris_barang__spesifikasi libs where (nama_detail='kover' or nama_detail='cover') and libs.id_ltw_inventoris_barang = lib.id_ltw_inventoris_barang limit 1 ) as jenis_cover,lib.id_ltw_inventoris_barang
			 from store_product sp
			left join ltw_inventoris_barang lib on lib.id_ltw_inventoris_barang = sp.id_ltw_inventoris_barang
            left join ltw_inventoris_barang__brand libb on lib.id_brand = libb.id_ltw_inventoris_barang__brand
            left join ltw_inventoris_barang__kategori libk on lib.id_ltw_inventoris_barang_kategori = libk.id_kategori
       		left join store_product__harga_jual sphj on sphj.id_store_product = sp.id_store_product
       		left join apps__file on database_='Inventoris Barang' and id_ext =lib.id_ltw_inventoris_barang and support=1
			where select_varian_type ='tanpa' and sp.id_ltw_inventoris_barang is not null
		")->result();
		$i=0;
		foreach($row  as $value){
			
			$file = $this->db->query("
			select * from apps__file where database_='Inventoris Barang' and id_ext = $value->id_ltw_inventoris_barang and support!=1
			")->result(); 
			$list_file = array();
			foreach($file as $files){
				
				if(!in_array("wedding-hilfi-sisi.my.id/photos/".$files->file_name_asli,$list_file))
				$list_file[] = "wedding-hilfi-sisi.my.id/photos/".$files->file_name_asli;
			}
			
			echo '<br>';
			$i++;
			$data[$i] =[
				$value->shopee_kode,
				$value->nama_barang,
				(str_replace("<br>","\n",$value->keterangan)),
				$value->wui_id,
				"No",
			
					"",//kode intergrasi
					"",//nama variasi 1
					"",//Varian untuk Variasi 1 
					"",//Foto Produk per Varian 
					"",//Nama Variasi 2
					"",//Varian untuk Variasi 2
					$value->harga_jual_umum,
					$value->stok,
					"",
					"",
					"wedding-hilfi-sisi.my.id/photos/".$value->file_name_asli,
					(isset($list_file[0])?$list_file[0]:""),
					(isset($list_file[1])?$list_file[1]:""),
					(isset($list_file[2])?$list_file[2]:""),
					(isset($list_file[3])?$list_file[3]:""),
					(isset($list_file[4])?$list_file[4]:""),
					(isset($list_file[5])?$list_file[5]:""),
					(isset($list_file[6])?$list_file[6]:""),
					(isset($list_file[7])?$list_file[7]:""),
					$value->berat,
					"",
					"",
					"",
					"Nonaktif",
					"Nonaktif",
					"Aktif",
					"",
					"",
					"",
					"",//preorder
					$value->nama_brand,
					"Indonesia",
					"",
					"",
					$value->nama_brand,
					"Indonesia",
					"Indonesia",
					"Impor",
					"Lainnya",
					"",
					"Edisi Reguler",
					"",
					$value->jenis_cover,//jenis koder
					"",
					
				];
			}
		
		
		$new = new SimpleXLSXGen();
		$new->fromArray($data)->saveAs('datatypes7.xlsx');
	}public function excel_ayat()
	{
		
		$surat_data = $this->db->query("select * from kitab_quran_surat ")->result();
		foreach($surat_data as $surat){
		$data = [
			[ "ID",//1
			  "Ayat","Perkata KE","Perkata Id"],
		];
		$row = $this->db->query("
		select *
		
			from kitab_quran_ayat__perkata 
			where surat_ke = $surat->surat_ke
			
			")->result();
		$i=0;
		foreach($row  as $value){
			
			
			$i++;
			$data[$i] =[
				$value->id,
				$value->ayat_ke,
				$value->urutan,
				$value->kata_arab,
				
				];
			}
		
		
		$new = new SimpleXLSXGen();
		$new->fromArray($data)->saveAs('surat-'.$surat->surat_ke.'.xlsx');
		
		}
	}
	
	public function logout()
	{
		session_destroy();
	}
	
	public function all_page()
	{
		$this->load->library('session');
			$route_page = base_url().'welcome/all_page';
			$page['meta']['title'] = "Hibe3";
	        $page['meta']['keyword'] = "Hibe3,Be3 Grit, Be3 Studio, Be3";
	        $page['meta']['description'] = "Hibe3 Adalah sebuah plafon";
	        $page['meta']['google_seo'] = "Hibe3 Adalah sebuah plafon";
	        
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='be3';
	        $page['conection_user']='root';
	        $page['conection_password'] = '';
	        $page['app_framework'] ='laravel';
			$page['database_provider'] ='mysql';
			$page['database_name'] ='be3';
			
	        $page['conection_server'] = 'localhost';
	        $page['conection_name_database']='be3'; 
	        $page['conection_user']='root';
	        $page['conection_password'] = '';
			$fai = new MainFaiFramework();
			$load = $fai->Apps('Auth','login_page_1');;

			$load['apps_title'] = 'Hibe3';
				
			$load['type'] = 'list';
			$load['apps'] = 'habits';
			$load['page_view'] = 'table';
			$load['type'] = 'view_layout';
			$load['id'] = '-1';
			$load['database']['id']['text'] = 'id';
			$load['database']['id']['type'] = 'prefix';//prefix//sufix
			$load['database']['id']['on_table'] = true;//true->id_(nama table)//false->just id
			
			
			$load['route_page'] = $route_page;
			$load['link_route'] = $route_page;
			
			$load['login'] = true;
			$load['body_class'] = 'g-sidenav-show  bg-gray-100 homepage';
			$load['footer_menu'] = array(
				"template_name"=>"finapp",
				"template_file"=>"",
				"session_name"=>"hak_akses",
				"akses_menu"=>array(
				
					   "user"=>array(
						array("menu","Dashboard",array("Apps","Dashboard","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
						array("menu","Organisasi",array("Organisasi","list_organisasi","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
						array("menu","Program",array("Organisasi","list_organisasi","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
						array("menu","Chat",array("Chat","list_chat","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
						array("menu","Crowd Funding",array("Crowd Funding","list","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
						array("menu","Profil",array("Profil","list","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
					),
					"organisasi"=>array(
						array("menu","Dashboard",array("Apps","Dashboard","view_layout","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
					
					),
					"admin"=>array(
						array("menu","Organisasi",array("Organisasi_Admin","kategori","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
					
					)
				)
			);
          
			$load['crud_template']['list'] = array(
					"template_name"=>"tabler",
					"template_file"=>"",
					
            	);
          
			$page['template'] = 'soft-ui';
			$page['load'] = $load;
			$page['load_screen'] = '<div class="col align-self-center text-white text-center">
        <img src="http://localhost/Server/hibe3/assets/images/logo.png" alt="logo" width="200px">
        <h1 class="mt-3  text-white" style="color: #04684d !important;"><span class="font-weight-light text-gradient-success  text-white" style="color:#bfd200 !important;">Hi</span>Be3</h1>

        <div class="loadingCircle">
            <div class="circleOuter"></div>
            <div class="circleLoader"></div>
        </div>
    </div>
    <div style="text-align: center; position: absolute; bottom: 60px">
        <h6 class="mt-3"><span class="font-weight-light text-gradient-success text-white" style="color: #04684d !important;">Powered By</h6>
        <img src="http://localhost/Server/hibe3/assets/images/logo.png" alt="logo" width="50px">
    </div>';
			$fai = new MainFaiFramework();
			$page['load']['menu'] = $fai->Apps('Organisasi','menu');;
			
			$page['load']['form']['type'] = 2;
			return $fai->allPage($page);
	}
}
