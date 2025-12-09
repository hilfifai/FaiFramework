<?php
require_once('Packages.php');
require_once('Database.php');
class Pages extends Packages
{

	public function __construct()
	{
		parent::__construct();
	}
	public static function Apps($class, $function, $page = array(), $param1 = "", $param2 = "", $param3 = "", $param4 = "", $param5 = "")
	{

		$class = ucfirst($class??"");
		if ($class and $class != -1) {
			require_once(dirname(__FILE__) . "/../App/$class.php");
			return $class::$function($page, $param1, $param2, $param3, $param4, $param5);
		} else {
			return array();
		}
	}
	public static function Page($page, $type, $id, $section_menu = '-1')
	{
		
		$fai = new MainFaiFramework();
		$page['section'] = isset($page['section']) ? $page['section'] : 'page';
		$page['database_provider'] = isset($page['database_provider']) ? $page['database_provider'] : 'mysql';
		$page['app_framework'] = isset($page['app_framework']) ? $page['app_framework'] : 'ci';;
		$login = $page['require_login'];

		if($type=='delete_privilage'){
			$type='hapus';
		}
		// die;
		if ($type == 'enskripsi') {
			return  de(Partial::input('text', '_POST'));
		} else  if (in_array($type, array('unique_value', 'diferent_value', 'wizard_form'))) {

			return CRUDFunc::$type($fai, $page, $type, $id);
		} else  if (!$login  or in_array($type, array('get_login', 'check_login'))) {

			return Packages::login($page, $type, $id);
		} else if (in_array($type, array('view_layout', 'load_data'))) {
			return Packages::view_layout($page, $type, $id, $section_menu);
		} else if (in_array($type, array('js_ajax'))) {
			return Packages::js_ajax($page, $type, $id, $section_menu);
		} else if (in_array($type, array(
			'setting',
			'save_setting',
			'list_datatable',
			'tambah',
			'edit',
			'edit_approval',
			'update_approval',
			'view',
			'list',
			'hapus',
			'save',
			"appr",
			'update',
			'tree_sub_kategori',
			'field_value_automatic_sub_kategori',
			'ajax_sub_kategori',
			'decline_appr',
			'setujui_appr',
			'PDFPage',
			'pdf',
			'import_excel',
			'export_existing',
			'export_empty',
			'field_value_automatic',
			'result_array_website',
			'field_value_automatic_select_target',
			'field_view_sub_kategori',
			'insert_number_code',
			'modalform_sub_kategori_add',
			'import',
			'template_import',
			'execution_import',
			'select2'
		))) {

			// if(!empty($page['database']['utama']) and !empty($page['crud']['array'])){
			if (!empty($page['crud']['array'])) {

				return Packages::crud($page, $type, $id);
			} else {
				return Packages::crud($page, $type, $id);
			}
		} else  if (in_array($type, array('daftar','save_daftar'))) {
			return Packages::login($page, $type, $id);
		} else  if (in_array($type, array('datatable_array_website'))) {
			return Packages::datatable_array_website($page, $type, $id);
		} else  if (in_array($type, array('delete_privilage', 'info_privilage'))) {
			return PrivilageFunc::$type($page, $type, $id);
		} else  if (in_array($type, array('datatable'))) {
			return Packages::datatable($page, $type, $id);
		} else  if (in_array($type, array('sync', 'cari_sync', 'produk_sync'))) {
			return Packages::sync($page, $type, $id);
		} else  if (in_array($type, array('search_load'))) {
			return Packages::search_load($page, $type, $id);
		} else  if (in_array($type, array('habittable', 'save_lapor_habits'))) {
			return HabitsApp::$type($page, $type, $id);
		} else  if (in_array($type, array('list_alamat_user','jadikan_default_pengiriman','list_cart', 'save_pengiriman_ke', 'gunakan_voucher', 'add_cart', 'excel_produk', 'select_varian', 'select_varian_cart', "cek_harga_cart_get_checkout", "delete_cart", "update_pemesanan", 'get_all_ongkir', "get_change_ongkir", "print_pesanan"))) {

			print_r(EcommerceApp::$type($page, $type, $id));
			die;
		} else  if (in_array($type, array('select_order'))) {

			print_r(ErpPosApp::$type($page, $type, $id));
			die;
		} else  if (in_array($type, array('chat', 'kirim_pesan', 'list_pesan', 'list_chat_room', 'list_buat_chat_room', 'to_chat_room', 'content_message', 'tambah_chat_personal', "tambah_chat_grup"))) {

			return Packages::chat($page, $type, $id);
		}
	}



	public function template($page)
	{
		ob_start();
		if ($page['template']) {
			include dirname(__FILE__) . '/../../Pages/_template/' . $page['template'] . '/MainTemplate.php';
			$this->pages_footer($page);
		}
		$content_template = ob_get_clean();
		return $content_template;
	}
	public function view_website_template($page)
	{
		$page_template = $this->Apps($page['load']['apps'], $page['load']['page_view']);
		ob_start();
		include dirname(__FILE__) . '/../../Pages/_template/' . $page_template['website']['template'] . '/MainTemplate.php';
		$content_template = ob_get_clean();
		$page = array_merge_recursive($page, $page_template);
		return Packages::view_website($page, $content_template);

		//$this->pages_footer($page);
	}

	public function proses_menubar($page, $type)
	{
		$content = "";;
		$page['section'] = 'menubar';
		if (isset($page['load'][$type])) {
			$filename = isset($page['load'][$type]['template_file']) ?
				($page['load'][$type]['template_file'] ? $page['load'][$type]['template_file'] : ucfirst($type) . 'Page')
				: ucfirst($type) . 'Page';
			$content = file_get_contents(Partial::urlframework_pages('_template', $page['load'][$type]['template_name'] . '/' . $filename . '.php'));
			if (isset($page['load'][$type]['content_array'])) {

				for ($i = 0; $i < count($page['load'][$type]['content_array']); $i++) {
					$content_array = $page['load'][$type]['content_array'][$i];
					$replace_tag = "";
					$replace_tag = $this->sub_proses_menubar($page, $content_array, $type, $i);
					if (isset($content_array['content_tag'])) {

						for ($ix = 0; $ix < count($content_array['content_tag']); $ix++) {

							$replace_tag_replace_tag = $this->sub_proses_menubar($page, $content_array['content_tag'][$ix], $type, $ix);
							$tag = $content_array['content_tag'][$ix]['tag'];
							$replace_tag = str_replace("<$tag></$tag>", $replace_tag_replace_tag, $replace_tag);
						}
					}



					$tag = $content_array['tag'];
					$content = str_replace("<$tag></$tag>", $replace_tag, $content);
				}
			}
		}
		return $content;
	}
	public function sub_proses_menubar($page, $content_array, $type, $i, $row = array())
	{
		$replace_tag = '';
		if (isset($content_array['source'])) {

			if ($content_array['source'] == 'file' and $content_array['folder_tag'] and $content_array['file_tag']) {

				$replace_tag = file_get_contents(__DIR__ . '/../../Pages/_template/' . $content_array['folder_tag'] . '/' . $content_array['file_tag'] . '.php');
			} else if ($content_array['source'] == 'link_menu') {

				$replace_tag = base_url();
			} else if ($content_array['source'] == 'base_url') {

				$replace_tag = base_url();
			} else if ($content_array['source'] == 'dropdown') {
				for ($ii = 0; $ii < count($content_array['content_dropdown']); $ii++) {
					$content_dropdwon = $content_array['content_dropdown'][$ii];

					if ($content_dropdwon['source'] == 'file') {
						$replace_tag .= file_get_contents(__DIR__ . '/../../Pages/_template/' . $content_dropdwon['folder_tag'] . '/' . $content_dropdwon['file_tag'] . '.php');
						if (isset($content_dropdwon['content_tag'])) {
							for ($ix = 0; $ix < count($content_dropdwon['content_tag']); $ix++) {

								$replace_tag_replace_tag = $this->sub_proses_menubar($page, $content_dropdwon['content_tag'][$ix], $type, $ix);
								$tag = $content_dropdwon['content_tag'][$ix]['tag'];
								$replace_tag = str_replace("<$tag></$tag>", $replace_tag_replace_tag, $replace_tag);
							}
						}
					}
				}

				//
			} else if ($content_array['source'] == 'database_list') {

				$database_refer = $content_array['database'][$content_array['database_refer']];
				$name_database = strtolower(str_replace(' ', '', $content_array['database_refer']));

				$database = Database::database_coverter($page, $database_refer, array(), 'all');
				if (isset($content_array['folder_tag']))
					$get_database =  file_get_contents(__DIR__ . '/../../Pages/_template/' . $content_array['folder_tag'] . '/' . $content_array['file_tag'] . '.php');
				else
					$get_database = "";
				$content_database = "";
				if ($database['num_rows']) {

					foreach ($database['row'] as $$name_database) {
						$get_database_temp = $get_database;
						if (isset($database_refer['content_tag'])) {
							for ($ii = 0; $ii < count($database_refer['content_tag']); $ii++) {
								if ($database_refer['content_tag'][$ii]['source'] == 'foreach_database') {
									$db_refer = strtolower(str_replace(' ', '', $database_refer['content_tag'][$ii]['database_refer']));

									$row_db_refer = $database_refer['content_tag'][$ii]['row_database'];
									$tag_ldt = $database_refer['content_tag'][$ii]['tag'];
									$to_replace = $$db_refer->$row_db_refer;
									if ($get_database)
										$get_database = str_replace("<$tag_ldt></$tag_ldt>", $to_replace, $get_database);

									if (isset($content_array['content_tag'])) {

										for ($ix = 0; $ix < count($content_array['content_tag']); $ix++) {

											$replace_tag_replace_tag = $this->sub_proses_menubar($page, $content_array['content_tag'][$ix], $type, $ix);
											$tag = $content_array['content_tag'][$ix]['tag'];
											if ($get_database_temp)
												$get_database = str_replace("<$tag></$tag>", $replace_tag_replace_tag, $get_database);
											else
												$get_database .= $replace_tag_replace_tag;
										}
									}
								}
							}
						}
						$content_database .= $get_database;
						$get_database = $get_database_temp;
					}
				}
				$replace_tag = $content_database;
			} else if ($content_array['source'] == 'tipe_header') {
				if ($content_array['tipe_header'] == 'logo_utama') {
					$sql = DB::fetchResponse(DB::select("select * from drive__file where ref_database='web__apps' and ref_external_id=" . $page['load']['id_web__apps']));
					if (isset($sql[0]))
						$replace_tag = ($sql[0]->domain ? $sql[0]->domain : base_url()) . '/uploads/' . $sql[0]->path . '/' . $sql[0]->file_name_save;
				}
			} else {
				$content_array['refer'] = $content_array['source'];

				$replace_tag = Partial::array_website($page, '<ARRAY-WEBSITE></ARRAY-WEBSITE>', $content_array, 'ARRAY-WEBSITE', $i, $row);
			}
		}
		return $replace_tag;
	}
	public function navbar($page)
	{

		$content = $this->proses_menubar($page, 'navbar');


		return $content;
	}
	public function header($page)
	{
		global $collect_refer;

		$id_header_bundles = 0;
		if (isset($page['load']['row_web_apps'])) {
			$id_header_bundles = $page['load']['row_web_apps']->id_header_bundles;
		}
		$header_content = "";
		echo $id_header_bundles;
		
		if (!empty($id_header_bundles) and 1==0) {
			$header = [];
			$header['app_framework'] = $page['app_framework'];
			$header['database_provider'] = $page['database_provider'];
			$header['database_name'] = $page['database_name'];
			$header['conection_server'] = $page['conection_server'];
			$header['conection_name_database'] = $page['conection_name_database'];
			$header['conection_user'] = $page['conection_user'];
			$header['conection_password'] = $page['conection_password'];
			$header['conection_scheme'] = $page['conection_scheme'];
			$header['load'] = $page['load'];
			$header['load_section'] = $page['load_section'];
			DB::connection($page);
			unset($header['view_layout']);
			DB::table('website__bundles__list__tag');
			DB::whereRaw("id_website__bundles__list='" . $id_header_bundles . "'");
			$tag_list = DB::get();

			if ($tag_list) {
				foreach ($tag_list as $tag) {
					$content_array_header = [];
					if ($tag->tipe == 'website') {
						$website_header['content'] = Configuration::webcontent($header, $tag->id_website_master);
						$content_array_header = $website_header;
					}


					$header['view_layout'][] = array($tag->tipe, $tag->col_row, $content_array_header);
				}
			}
			//  echo '<pre>';
			//  print_R($header['view_layout']); 
			// die;
			// $header_content = Packages::view_layout($header, 'view_layout', '-1', '-1');
			// echo '<textarea>'.$header_content.'</textarea>';
		} else {
			if ($page['template'] != 'sneat') {

				if (isset($page['load']['config']))
					$page['config'] = $page['load']['config'];
				if (isset($page['load']['header'])) {
					$header = $page['load']['header'];
				} else {
					$header = ""; // atau []
				}
				$page['website']['content'][0] = $header ;
				$header_content = Packages::view_website($page, '<HEADER></HEADER>');
				$header_content;
			} else {
				$header_content = $this->proses_menubar($page, 'header');
			}
		}
		return $header_content;
	}
	public function sidebar($page)
	{

		$id_sidebar_bundles = 0;

		if (isset($page['load']['row_web_apps'])) {
			$id_sidebar_bundles = $page['load']['row_web_apps']->id_sidebar_bundles;
		}


		if ($id_sidebar_bundles) {
			$header = $page;
			unset($header['view_layout']);
			DB::table('website__bundles__list__tag');
			DB::whereRaw("id_website__bundles__list='" . $id_sidebar_bundles . "'");
			$tag_list = DB::get('all');

			if ($tag_list['num_rows']) {
				foreach ($tag_list['row'] as $tag) {
					$content_array_header = [];
					if ($tag->tipe == 'website') {
						$website_header['content'] = Configuration::webcontent($header, $tag->id_website_master);
						$content_array_header = $website_header;
					}

					$header['view_layout'][] = array($tag->tipe, $tag->col_row, $content_array_header);
				}
			}

			$sidebar_content = Packages::view_layout($header, 'view_layout', '-1', '-1');

			return $sidebar_content;
		} else if ($page['template'] != 'sneat') {



			if (isset($page['load']['sidebar'])) {
				$page['website']['content'][0] = $page['load']['sidebar'];
				$content = Packages::view_website($page, '<SIDEBAR></SIDEBAR>');

				return $content;
			}
		} else {
			ob_start();
			include dirname(__FILE__) . '/../../Pages/_template/' . $page['template'] . '/SidebarPage.php';
			return ob_get_clean();
		}
	}
	public function sidebarIn($page)
	{

		if ($page['load']['board'] != -1) {

			ob_start();
			$sidebarIn = ($this->Apps('Workspace', "sidebarIn"));
			$content_template = file_get_contents(__DIR__ . '/../../Pages/_template/' . $sidebarIn['load']['sidebarIn']['template_name'] . '/' . $sidebarIn['load']['sidebarIn']['template_file'] . '.php');
			// $page['website'] = $sidebarIn['load']['sidebarIn']['website'];
			include dirname(__FILE__) . '/../../Pages/_template/' . $sidebarIn['load']['sidebarIn']['template_name'] . '/' . $sidebarIn['load']['sidebarIn']['template_file'] . '.php';
			return ob_get_clean();
		}
	}
	public function buttombar($page)
	{
		ob_start();
		if (isset($page['load']['footer_menu'])) {
			$filename = isset($page['load']['footer_menu']['template_file']) ?
				($page['load']['footer_menu']['template_file'] ? $page['load']['footer_menu']['template_file'] : 'ButtombarPage')
				: 'ButtombarPage';
			include dirname(__FILE__) . '/../../Pages/_template/' . $page['load']['footer_menu']['template_name'] . '/' . $filename . '.php';
		}
		return ob_get_clean();
	}
}
