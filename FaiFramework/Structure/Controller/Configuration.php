<?php

require_once('Pages.php');
class Configuration extends Pages
{

	function __construct() {
		parent::__construct();
	}
	public  static function LoadApps($page, $domain, $menuApps = -1, $return = "")
	{
		if (!isset($_SESSION[$domain][$menuApps][$return][$page['conection_name_database']])) {
			
			$fai = new MainFaiFramework();
			

			DB::table('web__apps');
			DB::selectRaw("*,web__apps.id as primary_key,website__template__list.nama_template");
			DB::whereRaw("domain_utama='$domain'");
			DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
			DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
			DB::joinRaw("web__template on  web__template.id = id_template", 'left');
			DB::joinRaw("web__list_apps_menu on  web__list_apps_menu.id = id_first_menu", 'left');
			// DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
			$utama = DB::get('all');

			$page['fai'] = $fai;
			$page['utama'] = $utama;
			$page['load']['apps'] = -1;
			$page['load']['page_view'] = -1;
			$page['load']['type'] = -1;
			$page['load']['id'] = -1;
			$page['load']['menu'] = -1;
			$page['load']['nav'] = -1;
			$page['load']['login'] = 0;
			if (($utama['num_rows']) and $return != 'utama') {
				$apps  = $utama['row'][0];


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

				if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost') {
					$apps->domain_sub_route = "localhost/FrameworkServer_v1/index.php";
				}
				if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == '192.168.70.159') {
					$apps->domain_sub_route = "192.168.70.159/FrameworkServer_v1/index.php";
				}
				if ($domain == 'admin.hibe3.com') {
					$page['section'] = 'admin';
					$page['load_section'] = 'admin';
				}

				$page['get_panel'] = PanelFunc::panel_initial($page, 'all');
				$page['import_export'] = false;
				$page['load']['link'] = $apps->link;
				$page['load']['domain'] = $domain;
				$page['load']['storage'] = 'uploads';
				$page['load']['link_route'] = $protocol . $apps->domain_sub_route . '/pages/';
				if ($menuApps == '$1') {
					$menuApps = "-1";
				}
				$page['load']['route_page'] = $protocol . str_replace('//', '/', $apps->domain_sub_route . '/pages/' . $menuApps);

				$page['load']['id_header_template'] = $apps->id_header_template;
				$page['load']['id_sidebar_template'] = $apps->id_sidebar_template;
				$page['load']['id_navbar_template'] = $apps->id_navbar_template;
				$page['load']['id_web__apps'] = $apps->primary_key;
				$page['load']['menuApps'] = $menuApps;

				$page['load']['row_web_apps'] = $apps;
				$page['template'] = $apps->folder_template;
				$is_board = false;
				if ($apps->id_board == -1) {
					$is_board = false;
				} else if ($apps->id_board) {
					$is_board = true;
					$page['load']['board'] = $page['load']['row_web_apps']->id_board;
				}
				if (!isset($_SESSION['hak_akses'])) {
					$_SESSION['hak_akses'] = "public";
				}

				$to_board_role_default = 0;
				if (($_SESSION['hak_akses'] != 'public' and $is_board and $menuApps == -1) or $return == 'workspace') {


					if ($return == 'workspace') {
						DB::queryRaw($page, "select * from web__list_apps_board where be3_id='$menuApps';");
						$get = DB::get('all');
						if ($get['num_rows']) {
							$id_board = $get['row'][0]->id;
						}
					} else {
						$id_board = $page['load']['row_web_apps']->id_board;
					}

					$return_board = MainFaiFramework::board_role_default($page, $id_board);

					$to_board_role_default = (($return_board['num_rows']) and (!empty($return_board['row']->load_apps) or !empty($return_board['row']->kode_link)));
				}

				if ($to_board_role_default) {


					if ($return == 'workspace') {
						if ($return_board['row']->load_page_view and $return_board['row']->load_apps)
							$link = Partial::link_direct($page, base_url() . "pages/", array($return_board['row']->load_apps, $return_board['row']->load_page_view, $return_board['row']->load_type, $return_board['row']->load_page_id, $return_board['row']->menu, $return_board['row']->nav, $id_board), 'menu', 'just_link');
						else
							$link = Partial::link_direct($page, base_url() . "pages/", array("Workspace", "admin", "list", "-1", "-1", "-1", $id_board), 'menu', 'just_link');


						echo '<script> window.location.href="' . $link . '";</script>';
						die;
					}

					if ($return_board['row']->ambil_dari == 'bundles') {
						$page['web_load_function'] = 'web';
						$page['load']['view_page'] = "bundles";
						$page['load']['row_menu'] = $return_board['row'];
						$page['load']['nama_bundle'] = $return_board['row']->nama_bundle;
						$page['load']['id_bundle'] = $return_board['row']->id_bundle;
						$page['template'] = $return_board['row']->nama_template;
						$page['load']['login'] = $return_board['row']->login;
					} else {
						$type_link = "menu";
						$page['load']['view_page'] = "controller";
						$page['load']['type_link'] = $type_link;
						$page['load']['id_menu'] = isset($return_board['row']->id_first_menu) ? $return_board['row']->id_first_menu : $return_board['row']->id_first_akses_role;
						$page['load']['apps'] = $return_board['row']->load_apps;
						$page['load']['page_view'] = $return_board['row']->load_page_view;
						$page['load']['type'] = $return_board['row']->load_type;
						$page['load']['id'] = $return_board['row']->load_page_id;
						$page['load']['menu'] = $return_board['row']->menu;
						$page['load']['nav'] = $return_board['row']->nav;
						$page['load']['login'] = $return_board['row']->login;
						$page['load']['board'] = $id_board;
						$page['load']['contentfaiframework'] = 'pages';
					}
				} else 	if ($menuApps == -1) {

					DB::table("web__apps_first_menu");
					DB::selectRaw("*,web__apps_first_menu.id_apps_menu ");
					DB::joinRaw("web__hak_akses on id_hak_akses = web__hak_akses.id", 'left');
					DB::joinRaw("web__list_apps_menu on id_apps_menu = web__list_apps_menu.id", 'left');
					DB::joinRaw("web__apps on id_web_apps = web__apps.id", 'left');
					DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id", 'left');
					DB::whereRaw("id_web__apps='" . $utama['row'][0]->primary_key . "'");
					DB::whereRaw("lower(nama_hak_akses)='" . (strtolower($page['get_panel']['panel'])??'') . "'");
					$first_menu = DB::get('all');

					$id_apps_menu = 0;
					$id_menu = 0;
					if ($first_menu['num_rows'] and !empty($first_menu['row'][0]->id_apps_menu)) {
						$id_apps_menu = $first_menu['row'][0]->id_apps_menu;
						$id_menu = $first_menu['row'][0]->id_menu;
					}


					if ($id_apps_menu) {


						$type_link = "apps";
						$get = $utama['row'][0]->kode_webapps . "_" . $first_menu['row'][0]->kode_link;
						$id_list_apps = $first_menu['row'][0]->id_web_list_apps;
						$page['load']['apps'] = $first_menu['row'][0]->load_apps;
						$page['load']['page_view'] = $first_menu['row'][0]->load_page_view;
						$page['load']['type'] = $first_menu['row'][0]->load_type;
						$page['load']['id'] = $first_menu['row'][0]->load_page_id;
						$page['load']['menu'] = $first_menu['row'][0]->menu;
						$page['load']['nav'] = $first_menu['row'][0]->nav;
						$page['load']['login'] = $first_menu['row'][0]->login;
						// $page['template'] = $first_menu['row'][0]->nama_template;
						$page['load']['row_menu'] = $first_menu['row'][0];
						$page['load']['nama_bundle'] = $first_menu['row'][0]->nama_bundle;
						$page['load']['id_bundle'] = $first_menu['row'][0]->id_bundle;
						$page['web_load_function'] = $first_menu['row'][0]->ambil_dari == 'bundles' ? 'web' : 'pages';
						$page['load']['view_page'] =  $first_menu['row'][0]->ambil_dari;
					} else if ($id_menu) {
					} else {
						$type_link = "menu";
						$page['load']['view_page'] = "controller";
						$page['load']['type_link'] = $type_link;
						$page['load']['id_menu'] = $apps->id_first_menu;
						$page['load']['apps'] = $apps->load_apps;
						$page['load']['page_view'] = $apps->load_page_view;
						$page['load']['type'] = $apps->load_type;
						$page['load']['id'] = $apps->load_page_id;
						$page['load']['menu'] = $apps->menu;
						$page['load']['nav'] = $apps->nav;
						$page['load']['login'] = $apps->login;
						$page['load']['board'] = $apps->board;
						$page['load']['contentfaiframework'] = "pages";
					}
				} else if ($menuApps != -1) {

					if ($page['web_load_function'] == 'web') {
						DB::table('web__list_apps_menu');

						DB::whereRaw("concat(web__apps.kode_webapps,'_',kode_link)='$menuApps'");
						DB::whereRaw("ambil_dari='bundles'");
						DB::joinRaw("web__apps on id_web_apps = web__apps.id", 'left');
						DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id", 'left');
						$get = DB::get('all');
						if ($get['num_rows']) {

							$page['load']['view_page'] = "bundles";
							$page['load']['row_menu'] = $get['row'][0];
							$page['load']['nama_bundle'] = $get['row'][0]->nama_bundle;
							// $page['template'] = $get['row'][0]->nama_template;
							$page['load']['id_bundle'] = $get['row'][0]->id_bundle;
						} else {
							echo 'Link Anda Salah';
							die;
						}
					} else {

						$get = DB::fetchResponse(DB::select("select *
    									from web__menu 
    									where kode_menu='$menuApps'"));;
						if ($get) {

							foreach ($get as $menu) {


								$page['load']['row_menu'] = $menu;
								$page['load']['id_menu'] = $menu->id;
								$page['load']['apps'] = $menu->load_apps;
								$page['load']['page_view'] = $menu->load_page_view;
								$page['load']['type'] = $menu->load_type;
								$page['load']['id'] = $menu->load_page_id;
								$page['load']['menu'] = $menu->menu;
								$page['load']['nav'] = $menu->nav;
								$page['load']['login'] = $menu->login;
								$page['load']['board'] = $menu->board;
								$page['load']['contentfaiframework'] = $menu->contentfaiframework;

								$page['load']['view_page'] = "controller";
							}
						}
					}
				}
				if ($page['load']['menu']) {
					$page['load']['page_section_menu'] = $page['load']['menu'];
				}
				if (!isset($page['load']['board'])) {
					$page['load']['board'] = -1;
				}
				if ($page['load']['board'] == -1) {
					if ($apps->id_board == -1) {
					} else if ($apps->id_board) {

						$page['load']['board'] = $page['load']['row_web_apps']->id_board;
					}
				}

				if (!$page['template']) {

					$page['template'] = $page['load']['row_web_apps']->nama_template;
				}
				if (!$page['template']) {
					$page['template'] = 'sneat';
				}
				if (!$page['load']['row_web_apps']->main_utama) {
					ob_start();

					include __DIR__ . '/../../Pages/_template/MainAll.php';
					$page['load']['row_web_apps']->main_utama = ob_get_clean();
				}




				if (isset($page['load']['board'])) {
					if ($page['load']['board'] == 'ID_BOARD|') {
						$page['load']['board'] = $apps->id_board;
					}
					if (($page['load']['board'] == -1 ? false : ($page['load']['board'] ? true : false))) {

						DB::queryRaw($page, "select id_single_toko,id_panel_utama from web__list_apps_board where id = " . $page['load']['board']);
						$utama = DB::get('all');
						$page['load']['workspace']['id_single_toko'] = $utama['row'][0]->id_single_toko;
						$page['load']['workspace']['id_panel_utama'] = $utama['row'][0]->id_panel_utama;
					}
				}


				if ($apps->id_card_template) {
					$card = DB::fetchResponse(DB::select("select *
			
				from web__template
				where web__template.id=$apps->id_card_template"));;
					if (count($card)) {
						$page['load']['card_template']['cardulnav']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['cardulnav']['template_file'] = $card[0]->card_ul_nav_file;

						$page['load']['card_template']['cardullinav']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['cardullinav']['template_file'] = $card[0]->card_ul_li_nav_file;

						$page['load']['card_template']['main_listing']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['main_listing']['template_file'] = $card[0]->card_main_listing_menu_file;

						$page['load']['card_template']['main_profile']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['main_profile']['template_file'] = $card[0]->card_main_profil_menu_file;


						$page['load']['card_template']['filter']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['filter']['template_file'] = $card[0]->card_filter_file;


						$page['load']['card_template']['list_menu']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['list_menu']['template_file'] = $card[0]->card_listing_menu_file;

						$page['load']['card_template']['menu']["template_name"] = $card[0]->folder_template;
						$page['load']['card_template']['menu']['template_file'] = $card[0]->card_menu_file;
					}
				}
				if ($apps->id_footer_template) {
					$footer = DB::fetchResponse(DB::select("select *
    			
    				from web__template
    				where web__template.id=$apps->id_footer_template"));;

					if (count($footer)) {

						$page['load']['footer_menu']["template_name"] = $footer[0]->folder_template;
						$page['load']['footer_menu']["template_file"] = "";
						$page['load']['footer_menu']["session_name"] = "hak_akses";
						$get = DB::fetchResponse(DB::select("select *
                                        from web__apps_footer
                                        left join web__menu on web__menu.id = id_menu
                                        left join web__hak_akses on web__hak_akses.id = id_hak_akses
                                        where id_web__apps=$apps->primary_key
    									and web__apps_footer.active=1
    									order by urutan_footer
    									"));;
						if ($get) {
							foreach ($get as $footer) {
								$page['load']['footer_menu']["akses_menu"][$footer->kode_session][] = array($footer->tipe_menu, $footer->nama_menu, array($footer->load_apps, $footer->load_page_view, $footer->load_type, $footer->load_page_id), $footer->icon);
							}
						}
					}
				}


				if (isset($page_temp['meta']['title'])) {
					$page['meta']['title'] = $page_temp['meta']['title'];
				} else {
					$page['meta']['title'] = $apps->meta_title;
				}

				if (isset($page_temp['meta']['keyword'])) {
					$page['meta']['keyword'] = $page_temp['meta']['keyword'];
				} else {
					$page['meta']['keyword'] = $apps->meta_keyword;
				}
				if (isset($page_temp['meta']['description'])) {
					$page['meta']['description'] = $page_temp['meta']['description'];
					$page['meta']['google_seo'] = $page_temp['meta']['description'];
				} else {
					$page['meta']['description'] = $apps->meta_description;
					$page['meta']['google_seo'] = $apps->meta_description;
				}
				if (isset($page_temp['meta']['link'])) {
					$page['meta']['link'] = $page_temp['meta']['link'];
				} else {
					$page['meta']['link'] = base_url();;
				}



				$page['load']['database']['id']['text'] = $apps->database_id_text;
				$page['load']['database']['id']['type'] = $apps->database_id_type;
				$page['load']['database']['id']['on_table'] = $apps->database_id_on_table;
			} else if ($return != 'utama') {
				echo 'Anda belum seting webapps untuk Domain ' . $domain;
				die;
			}
			$_SESSION[$domain][$menuApps][$return][$page['conection_name_database']] = $page;
		} else {
			$page = $_SESSION[$domain][$menuApps][$return][$page['conection_name_database']];
		}
		if ($return == 'page' or $return == 'utama') {
			return $page;
		} else {

			return SELF::AllPage($page, $menuApps);
		}
	}
	public static function AllPage($page, $menuApps = -1, $contentfaiframework = -99, $mainAll = -99)
	{
		global $collect_refer;

		if ($mainAll == -99)
			$mainAll = MainFaiFramework::get_input('MainAll');
		if ($contentfaiframework == -99)
			$contentfaiframework = MainFaiFramework::get_input('contentfaiframework');
		if (!(MainFaiFramework::get_input('MainAll'))) {
			$_POST['MainAll'] = 1;
		}
		$page['fai'] = new MainFaiFramework();
		$page['contentfaiframework'] = $contentfaiframework;
		$page['mainAll'] = $mainAll;
		$page['load']['menuApps'] = $menuApps;

		$page = Packages::initialize($page);

		$login = $page['require_login'];

		if (!$login) {
			$page['load']['contentfaiframework'] = $login;
		}


		/* CONTENT PROSES */
		$header_content = "";
		$navbar_content = "";
		$sidebar_content = "";
		$buttombar_content = "";
		$template_content = "";
		$crudlayout_content = "";
		$pages_content = "";
		$contentfaiframework;

		if ($contentfaiframework == 'get_pages') {

			if (!isset($page['get_panel']))
				$page['get_panel'] = PanelFunc::panel_initial($page, 'all');

			$apps = MainFaiFramework::get_input('apps');
			$page_view = MainFaiFramework::get_input('page_view');
			$type = MainFaiFramework::get_input('type');

			$id = MainFaiFramework::get_input('id');
			if (MainFaiFramework::get_input('board') and MainFaiFramework::get_input('board') != -1)
				$page['load']['board'] = MainFaiFramework::get_input('board');
			$section_menu = $page['load']['page_section_menu'];

			echo  Pages::page($page, $type, $id, $section_menu);
			die;
		}
		if ($contentfaiframework == 'crudlayout' and $mainAll == 2) {

			$type = $page['load']['type'];
			$id = MainFaiFramework::get_input('id');
			$section_menu = $page['load']['page_section_menu'];

			if (MainFaiFramework::get_input('json_decode') == 0) {

				if (MainFaiFramework::get_input('crud'))
					$page['crud'] = MainFaiFramework::get_input('crud');
				if (MainFaiFramework::get_input('database'))
					$page['database'] = MainFaiFramework::get_input('database');
			} else if (MainFaiFramework::get_input('json_decode') == "1") {
			}
			if (MainFaiFramework::get_input('board') and MainFaiFramework::get_input('board') != -1)
				$page['load']['board'] = MainFaiFramework::get_input('board');
			$apps = $page['load']['apps'];
			$page_view = $page['load']['page_view'];
			$page_temp  = Pages::Apps($apps, $page_view, $page);
			$view_layout = ($page_temp['view_layout'][MainFaiFramework::get_input('view_layout_number')][2]);
			$this_view_layout = $view_layout[$view_layout['menu'][$page['load']['menu']][2]];
			$crud = array();
			if (isset($this_view_layout['type'])) {
				if ($this_view_layout['type'] == 'nav') {
					$page_database = $this_view_layout['cardNav'][$page['load']['nav']]['database_refer'];
					$array = $this_view_layout['cardNav'][$page['load']['nav']]['array'];
					$crud = $this_view_layout['cardNav'][$page['load']['nav']]['crud'];
				}
			} else {

				$page_database = $page['load']['menu'];

				$array = $this_view_layout['array'];
			}
			$page['load']['page_database'] = $page['load']['card']['page_database'] = $page_database;
			$page['view_layout_number'] = MainFaiFramework::get_input('view_layout_number');

			$page['crud'] = isset($this_view_layout['crud']) ? $this_view_layout['crud'] : $crud;

			$page['crud']['submit_form'] = "card_submit_form";
			$page['crud']['submit_form_direct'] = "this_link";
			$page['crud']['array'] = $array;
			$page['database'] = $page_temp['config']['database'][$page_database];
			$page = Packages::initialize($page);
			$page['route'] = $page['load']['route_page'];
			$page['title'] = "Tambah " . $page['load']['menu'];
			$crudlayout_content .=  Pages::page($page, MainFaiFramework::get_input('type_crud'), $id, $section_menu);
			die;
		}



		if (MainFaiFramework::get_input('page_view') == 'daftar_to_login'  and $mainAll == 2) {

			$_SESSION["hak_akses"] = $_SESSION[$page['load']['login-daftar-hak_akses']];
			$_SESSION[$page['load']['login-session-utama']['session_name']] = $_SESSION[$page['load']['login-session-utama']['session_name'] . "_daftar"];
			header('location:' . base_url());
			die;
		} else
		if (isset($page['load']['view_source'])) {

			$page = Packages::initialize($page);
			Packages::view_source($page, $page['load']['type']);
			die;
		}
		if ($contentfaiframework == 'template' and $mainAll == 2) {

			$template_content .= Pages::template($page);
		}
		if ($contentfaiframework == 'view_website_template' and $mainAll == 2) {

			$pages_content .= Pages::view_website_template($page);
		}

		if ($login and (($contentfaiframework == 'header'  and $mainAll == 2) or ($page['load']['protocol'] == 'call'))) {

			if ($login) {
				$config = new Configuration();
				$header_content .=	$config->header($page);
			}
		}
		if (($contentfaiframework == 'navbar' and $mainAll == 2) or ($page['load']['protocol'] == 'call' and $page['load']['view_page'] == 'bundles')) {

			if ($login) {
				$config = new Configuration();
				$navbar_content .= $config->navbar($page);
			}
		}
		if ((($contentfaiframework == 'sidebar' and $mainAll == 2) or ($page['load']['protocol'] == 'call'))) {


			$page['load']['protocol'];

			if ($login) {
				$config = new Configuration();
				$sidebar_content .=	$config->sidebar($page);
			}
		}
		if ($contentfaiframework == 'sidebarin' and $mainAll == 2) {

			$config = new Configuration();
			$config->sidebarin($page);
		}
		if ($contentfaiframework == 'buttombar' and $mainAll == 2) {

			if ($login) {
				$config = new Configuration();
				$buttombar_content .=	$config->buttombar($page);
			}
		}
		if ($contentfaiframework == 'changeMenu' and $mainAll == 2) {

			$controller_ = MainFaiFramework::get_input('controller_');
			$function_ = MainFaiFramework::get_input('function_');
			$array_menu_ = MainFaiFramework::get_input('array_menu_');
			$page['load'][$array_menu_] = Pages::Apps($controller_, $function_);
			$config = new Configuration();
			$sidebar_content .= $config->sidebar($page);
		}
		if ($contentfaiframework == 'link_direct') {
			$page['route_type'] = 'just_link';

			$kode = Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], MainFaiFramework::get_input('type'), MainFaiFramework::get_input('id'), MainFaiFramework::get_input('menu'), -1, 'ID_BOARD|']);
			$data = "";
			if ($page['load']['link'] == 'loadJs') {
				$data = $pages_content;
			}
			echo json_encode(["link" => $page['load']['link'], 'href' => $kode, "data" => $data]);
			die;
		} else
		if ($page['load']['row_web_apps']->tipe_website != 'template_content')
			$pages_content = Configuration::pages_content($page, $contentfaiframework, $mainAll);

		$page['content']['header_content'] = $header_content;
		$page['content']['sidebar_content'] = $sidebar_content;
		$page['content']['pages_content'] = $pages_content;
		$page['content']['template_content'] = $template_content;
		$page['content']['navbar_content'] = $navbar_content;
		$page['content']['buttombar_content'] = $buttombar_content;
		$page['content']['mainAll'] = $mainAll;
		echo Configuration::content($page);
	}



	public static function content($page)
	{
		// $this = new MainFaiFramework();
		$fai = new MainFaiFramework();
		$navbar_content = $page['content']['navbar_content'] ?? '';
		$template_content = $page['content']['template_content'] ?? '';
		$buttombar_content = $page['content']['buttombar_content'] ?? '';
		$header_content = $page['content']['header_content'] ?? '';
		$sidebar_content = $page['content']['sidebar_content'] ?? '';
		$pages_content = $page['content']['pages_content'] ?? '';
		$mainAll = $page['content']['mainAll'] ?? 1;
		if ($page['load']['row_web_apps']->tipe_website == 'template_content') {

			$i = 0;
			$type = $page['load']['type'];
			$id = $page['load']['id'];
			$content =  Partial::html_decode($page, $type, $id, $page['load']['row_web_apps']->main_utama);
			$content_css =  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_css));
			$content_js =  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_js));
			$content_return = $content;
			$content_return = str_replace('<MAIN-CSS></MAIN-CSS>', $content_css, $content_return);
			$content_return = str_replace('<MAIN-JS></MAIN-JS>', $content_js, $content_return);
			$array[$i] = [$page['template'], 'base'];
			$content_template = "";
			foreach ($array as $i => $value) {

				$content_template .= TemplateContent::parse_template($page, $array, $i);
			}

			$content_return = str_replace('<CONTENT-TEMPLATE></CONTENT-TEMPLATE>', $content_template, $content_return);
			$content_return = str_replace('$this->', '$fai->', $content_return);
			$content_return = str_replace('<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>', $fai->urlframework_template(), $content_return);
			$content_return = str_replace('<BASE-URL></BASE-URL>', base_url(), $content_return);

			eval("?> $content_return <? ");
		} else
		if (($page['load']['view_page'] == 'bundles' or $page['load']['row_web_apps']->main_utama) and Partial::input('type') != 'load_data') {
			$page['load']['view_page'];
			$type = $page['load']['type'];
			$id = $page['load']['id'];
			$content =  Partial::html_decode($page, $type, $id, $page['load']['row_web_apps']->main_utama);
			$content_css =  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_css));
			$content_js =  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_js));
			$content_template =  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_content_template));
			$content_css .=  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_content_template_css));
			$content_js .=  Partial::html_decode($page, $type, $id, ($page['load']['row_web_apps']->main_content_template_js));


			$content_return = $content;
			$content_return = str_replace('<MAIN-CSS></MAIN-CSS>', $content_css, $content_return);
			$content_return = str_replace('<MAIN-JS></MAIN-JS>', $content_js, $content_return);
			$content_return = str_replace('<CONTENT-TEMPLATE></CONTENT-TEMPLATE>', $content_template, $content_return);
			$content_return = str_replace('<HEADER></HEADER>', $header_content, $content_return);
			$content_return = str_replace('<SIDEBAR></SIDEBAR>', $sidebar_content, $content_return);
			$content_return = str_replace('<FILE-CONTENT></FILE-CONTENT>', $pages_content, $content_return);
			$content_return = str_replace('$this->', '$fai->', $content_return);
			$content_return = str_replace('<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>', $fai->urlframework_template(), $content_return);
			$content_return = str_replace('<BASE-URL></BASE-URL>', base_url(), $content_return);

			eval("?> $content_return <? ");
		} else if (!($mainAll == 2 or $mainAll == 3)) {
			include __DIR__ . '/../../Pages/_template/MainAll.php';
			$fai->pages_load($page);
		} else {
			$contentfaiframework = empty($page['contentfaiframework']) ? 'pages' : $page['contentfaiframework'];

			$var = $contentfaiframework . '_content';
			echo $$var;
		}
	}



	public function pages_content($page)
	{
		global $collect_refer;
		// echo 'masuk sini';
		$login = $page['require_login'];
		$contentfaiframework = $page['contentfaiframework'];
		$mainAll = $page['mainAll'];
		if (!$login) {
			$page['load']['contentfaiframework'] = $login;
		}
		$pages_content = "";
		if ($contentfaiframework == 'search_navbar') {
			$pages_content .= "<div class='container'>";
			$search_navbar = ($page['search_navbar'][$page['load']['id_web__apps']]) ?? [];
			foreach ($search_navbar['search'] as $detail_sn) {


				$pages_content .= '<h1>' . $detail_sn['title'] . "</h1>";
				$db = $detail_sn["databbase"];
				$where = " 1=1 ";
				if ((Partial::input("keyword"))) {
					$array = $db['search_field'];
					$where = "  (";
					for ($i = 0; $i < count($array); $i++) {
						$where .= "upper(" . $array[$i] . ") like '%" . strtoupper(Partial::input("keyword")) . "%'";
						if ($i != count($array) - 1) {
							$where .= '  or  ';
						}
					}
					$where .= "  )";
				}
				$db['where'][] = ["$where", "", ""];
				$get = Database::database_coverter($page, $db, [], 'all');
				$function = $detail_sn['view'][0];
				$type = $detail_sn['view'][1];
				$temp = TemplateContent::$function($page, $type, 0);
				$pages_content .= $temp[$type]['content']['row_start'] ?? '';
				if ($get['num_rows']) {
					foreach ($get['row'] as $row) {
						$page['row_section']["search_navbar"]['row'][0] = $row;
						$pages_content .= $temp[$type]['content']['col_start'] ?? '';
						$array[0] = $detail_sn['view'];
						$return = TemplateContent::parse_template($page, $array, 0);

						$array_data = $detail_sn['array_data'];
						foreach ($detail_sn['array_data'] as $key => $value) {
							$array = [];
							// if()

							foreach ($value as $key2 => $value2) {


								$array[0][$key2] = $value2;
							}

							$template_content = TemplateContent::parse_template($page, $array, 0, $row);
							$return = str_ireplace(
								'<' . $key . '></' . $key . '>',
								$template_content,
								$return
							);
						}
						$pages_content .= $return;
						$pages_content .= $temp[$type]['content']['col_end'] ?? '';
					}

					$pages_content .= $temp[$type]['content']['row_end'] ?? '';
				}
			}
		} else
		 if (!$login) {
			// echo 'hallo';
			if (MainFaiFramework::get_input('type'))
				$page['load']['type'] = MainFaiFramework::get_input('type');
			$pages_content .= Packages::login($page, $page['load']['type'], $page['load']['id']);
		} else {

			// 			if (isset($page['get']['sidebarIn']) and $sidebarIn  and !isset($page['get']['not_sidebarIn']) and $login) {
			// 				$pages_content .= 	$this->sidebarin($page);
			// 			}
			// if($page['load_section']=='admin'){

			// if ($page['load']['view_page'] == 'bundles') {
			if (!empty($page['load']['id_bundle'])) {
				// echo 'MASUK';
				DB::table('website__bundles__list__tag');
				DB::whereRaw("id_website__bundles__list='" . $page['load']['id_bundle'] . "'");
				DB::orderRaw($page, "coalesce(website__bundles__list__tag.urutan,9999) asc");
				$tag_list = DB::get();

				if ($tag_list) {

					foreach ($tag_list as $tag) {
						$content_array = [];
						if ($tag->tipe == 'website') {
							$website['content'] = $this->webcontent($page, $tag->id_website_master);
							$content_array = $website;
						}


						$page['view_layout'][] = array($tag->tipe, $tag->col_row, $content_array);
					}
				}

				if (($collect_refer)) {
					DB::table('website__bundles__database');
					DB::whereRaw("website__bundles__database.id in(" . implode(',', $collect_refer) . ")");
					$db = DB::get();
					foreach ($db as $db) {
						if ($db->db_utama) {
							$page['config']['database'][$db->name_database] = MainFaiFramework::config_database($page, $db);
						}
					}
				}

				$page['config']['database']["Profile"] = [
					"utama" => "apps_user",
					"primary_key" => "id",

					"where" => [
						["id_apps_user", "=", "{SESSION_UTAMA}"],
					],


				];
				if (isset($page['config']['database'])) {
					foreach ($page['config']['database'] as $key => $value) {

						if (isset($page['config']['database'][$key])) {
							$page['row_section'][$key] = Database::database_coverter($page, $page['config']['database'][$key], array(), 'all');
						} else {
							$page['row_section'][$key] = (object) ['object' => 'foreach_1_row'];
						}
					}
				}
				$sidebarIn = true;
				if (MainFaiFramework::get_input("not_sidebar") == 'not') {
					$sidebarIn = false;
				}
				if (isset($page['get']['sidebarIn']) and $sidebarIn  and !isset($page['get']['not_sidebarIn'])) {
					$config = new Configuration();
					$pages_content .=	$config->sidebarin($page);
				}
				$pages_content .= Packages::view_layout($page, 'view_layout', '-1', '-1');
			} else if (($contentfaiframework == 'pages' or $contentfaiframework == 'link_direct') and ($page['load']['contentfaiframework'] == null or (Partial::input('apps'))) and ($mainAll == 2 or $mainAll == 3)) {


				$section_menu = $page['load']['page_section_menu'];
				$apps = MainFaiFramework::get_input('apps');
				$page_view = MainFaiFramework::get_input('page_view');
				$page['load']['type'] = $type = MainFaiFramework::get_input('type');
				$page['load']['id'] = $id = MainFaiFramework::get_input('id');
				if (MainFaiFramework::get_input('board') and MainFaiFramework::get_input('board') != -1)
					$page['load']['board'] = MainFaiFramework::get_input('board');

				$sidebarIn = true;
				if (MainFaiFramework::get_input("not_sidebar") == 'not') {
					$sidebarIn = false;
				}
				if (isset($page['get']['sidebarIn']) and $sidebarIn  and !isset($page['get']['not_sidebarIn'])) {
					$pages_content .=	$this->sidebarin($page);
				}
				$pages = true;
				$config = new Configuration();
				$pages_content .=  $config->page($page, $type, $id, $section_menu);
			} else
			if (($page['load']['contentfaiframework'] == 'pages' and $mainAll == 2 and !(Partial::input('apps'))) or ($page['load']['protocol'] == 'call')) {

				$pages = true;

				$apps = $page['load']['apps'];
				$page_view = $page['load']['page_view'];
				$type = $page['load']['type'];
				$page['load']['id'] = $id = $page['load']['id'];
				$section_menu = $page['load']['page_section_menu'];
				//$page['load']['page_section_menu'] = $section_menu;


				$sidebarIn = true;
				if (MainFaiFramework::get_input("not_sidebar") == 'not') {
					$sidebarIn = false;
				}
				// if (isset($page['get']['sidebarIn']) and $sidebarIn  and !isset($page['get']['not_sidebarIn'])) {
				// 	$pages_content .=	$this->sidebarin($page);
				// } 
				$config = new Configuration();
				$pages_content .=  	$config->page($page, $type, $id, $section_menu);
			}
		}
		return $pages_content;
	}



	public static function template_base($template, $page)
	{

		require_once(__DIR__ . '/../Function_class/TemplateBase.php');
		$template_base = new TemplateBase();

		if (method_exists($template_base, $template)) {
			if (count($page))
				return $template_base->$template($page);
			else
				return $template_base->$template($page);
		} else {
			return $page;
		}
	}
	public function call_function_class($file_function_class)
	{

		require_once('../Function_class/' . $file_function_class . '.php');
		return new $file_function_class();
	}
	public static function board_role_default($page, $id_board, $id_role = -1)
	{
		$where = "";
		$return['row'] = (object) [];
		if (isset($_SESSION['id_apps_user'])) {

			if ($id_role == '-1') {
				if (isset($_SESSION['board_role-' . $id_board])) {
					$where = " and id_role=" . $_SESSION['board_role-' . $id_board];
				}
			}
			if ($id_role != '-1') {

				$where = " and id_role=$id_role";
			}
			$sql =
				"SELECT
				*,
				web__list_apps_menu.*,
				web__list_apps_menu.ID AS id_menu,
				web__list_apps_board__role__user.id as id_role_user,
				web__list_apps_board__role__akses.id as id_role_akses
			FROM
				web__list_apps_board__role__user
				JOIN web__list_apps_board__role__akses ON id_role = web__list_apps_board__role__akses.ID 
				LEFT JOIN web__list_apps_menu ON id_first_akses_role = web__list_apps_menu.ID 
				LEFT JOIN web__template on web__template.id = web__list_apps_board__role__akses.id_template
			WHERE
				web__list_apps_board__role__user.id_web__list_apps_board = $id_board
			
				$where
				AND id_user=" . $_SESSION['id_apps_user'] . "
				order by coalesce(prioritas_default_role,-1) desc,coalesce(id_first_akses_role,-1) desc
				";

			DB::queryRaw($page, $sql);
			$get = DB::get('all');

			$return['num_rows'] = $get['num_rows'];
			if ($get['num_rows']) {

				if (!isset($_SESSION['board_role-' . $id_board])) {
					$_SESSION['board_role-' . $id_board] =  $get['row'][0]->id_role;
				}
				$return['row'] = $get['row'][0];
			}
		}
		return $return;
	}
	public function web($page, $domain, $get)
	{
		global $collect_refer;
		DB::connection($page);

		$fai = new MainFaiFramework();
		$domain;
		$page = Packages::initialize($page);
		$page['get_panel'] = PanelFunc::panel_initial($page, 'all');
		DB::table('web__apps');
		DB::selectRaw("*,web__apps.id as primary_key");
		DB::whereRaw("domain_utama='$domain'");
		DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
		DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
		// DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
		$utama = DB::get('all');
		if ($get == -1) {

			if (strtolower($page['get_panel']['panel']) == 'public') {
				DB::table("web__apps_first_menu");
				DB::joinRaw("web__hak_akses on id_hak_akses = web__hak_akses.id", 'left');
				DB::joinRaw("web__list_apps_menu on id_apps_menu = web__list_apps_menu.id", 'left');
				DB::whereRaw("id_web__apps='" . $utama['row'][0]->primary_key . "'");
				DB::whereRaw("lower(nama_hak_akses)='" . strtolower($page['get_panel']['panel']) . "'");
				$first_menu = DB::get('all');
				if ($first_menu['row'][0]->id_apps_menu) {
					$type_link = "apps";
					$get = $utama['row'][0]->kode_webapps . "_" . $first_menu['row'][0]->kode_link;
					$id_list_apps = $first_menu['row'][0]->id_web_list_apps;
				} else {
					$type_link = "menu";
					$get = $first_menu['row'][0]->kode_menu;
				}
			}
		}
		$get;
		DB::table('web__list_apps_menu');
		DB::whereRaw("concat(web__apps.kode_webapps,'_',kode_link)='$get'");
		DB::whereRaw("ambil_dari='bundles'");
		DB::whereRaw("domain_utama='$domain'");
		DB::joinRaw("web__apps on id_web_apps = web__apps.id", 'left');
		DB::joinRaw("website__template__main on id_utama = website__template__main.id", 'left');
		DB::joinRaw("website__template__list on id_main_template = website__template__list.id", 'left');
		// DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
		$menu_row = DB::get('all');

		$page = $fai->LoadApps($page, $domain, -1, "page");
		if (!isset($id_list_apps)) {
			$page['id_list_apps'] = Partial::get_id_apps($page);
		} else {
			$page['id_list_apps'] = $id_list_apps;
		}
		//$page['load']['protocol'] = 'bundles';



		$header = $page;
		DB::table('website__bundles__list__tag');
		DB::whereRaw("id_website__bundles__list='" . $utama['row'][0]->id_header_bundles . "'");
		$tag_list = DB::get();

		if ($tag_list) {
			foreach ($tag_list as $tag) {
				$content_array_header = [];
				if ($tag->tipe == 'website') {
					$website_header['content'] = $this->webcontent($header, $tag->id_website_master);
					$content_array_header = $website_header;
				}


				$header['view_layout'][] = array($tag->tipe, $tag->col_row, $content_array_header);
			}
		}

		//sampe sini udah
		$page['load']['id'] = 7866;
		$content =  str_replace(array('&#039;'), array("'"), html_entity_decode(htmlspecialchars_decode($utama['row'][0]->main_utama)));
		$content_css =  str_replace(array('&#039;'), array("'"), html_entity_decode(htmlspecialchars_decode($utama['row'][0]->main_css)));
		$content_js =  str_replace(array('&#039;'), array("'"), html_entity_decode(htmlspecialchars_decode($utama['row'][0]->main_js)));
		$content_template =  str_replace(array('&#039;'), array("'"), html_entity_decode(htmlspecialchars_decode($utama['row'][0]->main_content_template)));

		DB::table('website__bundles__list__tag');
		DB::whereRaw("id_website__bundles__list='" . $utama['row'][0]->id_bundle . "'");
		$tag_list = DB::get();

		if ($tag_list) {
			foreach ($tag_list as $tag) {
				$content_array = [];
				if ($tag->tipe == 'website') {
					$website['content'] = $this->webcontent($page, $tag->id_website_master);
					$content_array = $website;
				}


				$page['view_layout'][] = array($tag->tipe, $tag->col_row, $content_array);
			}
		}
		DB::table('website__bundles__database');
		DB::whereRaw("website__bundles__database.id in(" . implode(',', $collect_refer) . ")");
		$db = DB::get();
		foreach ($db as $db) {
			if ($db->db_utama) {
				$page['config']['database'][$db->name_database] = MainFaiFramework::config_database($page, $db);
			}
		}
		$page['config']['database']["Profile"] = [
			"utama" => "apps_user",
			"primary_key" => "id",

			"where" => [
				["id_apps_user", "=", "{SESSION_UTAMA}"],
			],


		];
		if (isset($page['config']['database'])) {
			foreach ($page['config']['database'] as $key => $value) {

				if (isset($page['config']['database'][$key])) {
					$page['row_section'][$key] = Database::database_coverter($page, $page['config']['database'][$key], array(), 'all');
				} else {
					$page['row_section'][$key] = (object) ['object' => 'foreach_1_row'];
				}
			}
		}

		$header_content = Packages::view_layout($header, 'view_layout', '-1', '-1');

		$file_content = Packages::view_layout($page, 'view_layout', '-1', '-1');
		$content_return = $content;
		$content_return = str_replace('<MAIN-CSS></MAIN-CSS>', $content_css, $content_return);
		$content_return = str_replace('<MAIN-JS></MAIN-JS>', $content_js, $content_return);
		$content_return = str_replace('<CONTENT-TEMPLATE></CONTENT-TEMPLATE>', $content_template, $content_return);
		$content_return = str_replace('<HEADER></HEADER>', $header_content, $content_return);
		$content_return = str_replace('<FILE-CONTENT></FILE-CONTENT>', $file_content, $content_return);

		eval("?> $content_return <? ");
	}
	public static function config_database($page, $db)
	{
		$return['utama'] = $db->db_utama;
		$return['primary_key'] = $db->db_primary_key;
		$return['join_raw'][] = $db->join_raw;
		DB::table('website__bundles__database__select');
		DB::whereRaw('id_website__bundles__database=' . $db->id);
		$select = DB::get();
		foreach ($select as $select) {
			if ($select->row_database)
				$return['select'][] = $select->row_database;
		}
		if (!isset($return['select'])) {

			$return['select'][] = "*";
		}
		DB::table('website__bundles__database__where');
		DB::whereRaw('id_website__bundles__database=' . $db->id);
		$select = DB::get();
		foreach ($select as $select) {
			if ($select->row_database and $select->value)
				$return['where'][] = array($select->row_database, $select->operan, $select->value);
		}
		DB::table('website__bundles__database__join');
		DB::whereRaw('id_website__bundles__database=' . $db->id);
		$select = DB::get();
		foreach ($select as $select) {
			if ($select->database and $select->join_databasse_in and $select->join_databasse_out) {
				if ($select->database_alias) {
					$return['join'][] = array($select->database, $select->join_databasse_in, $select->join_databasse_out, $select->database_alias);
				} else
					$return['join'][] = array($select->database, $select->join_databasse_in, $select->join_databasse_out);
			}
		}
		return $return;
	}
	public static function webcontent($page, $id)
	{
		global $collect_refer;
		$website_content = [];
		DB::table('website__bundles__website__master'); // ada id_bundle tag // ada id_file buat content
		DB::selectRaw('*,website__bundles__website__master.id as primary_key'); // ada id_bundle tag // ada id_file buat content
		DB::joinRaw("website__bundles__tag on id_bundles_tag = website__bundles__tag.id", 'left');
		DB::joinRaw("website__bundles__database on id_database_refer = website__bundles__database.id", 'left');
		DB::joinRaw("website__bundles__master__refer on id_refer = website__bundles__master__refer.id", 'left');
		DB::joinRaw("website__template__file on id_file = website__template__file.id", 'left');
		DB::whereRaw("website__bundles__website__master.id='" . $id . "'");
		$get_content_website = DB::get();
		foreach ($get_content_website as $i => $website_row) {
			$website_content[$i] = MainFaiFrameWork::bundles_array($page, $website_row);

			$website_content[$i]['template_array'] = array();

			DB::table('website__bundles__website__master__tag'); // ada id_bundle tag
			DB::selectRaw('*,website__bundles__website__master__tag.is_sub_array,website__bundles__website__master__tag.id as primary_key'); // ada id_bundle tag


			DB::joinRaw("website__bundles__tag on id_bundle_tag = website__bundles__tag.id", 'left');
			DB::joinRaw("website__template__file__tag on id_file_tag = website__template__file__tag.id", 'left');
			DB::joinRaw("website__bundles__database on id_database_refer = website__bundles__database.id", 'left');
			DB::joinRaw("website__bundles__master__refer on id_refer = website__bundles__master__refer.id", 'left');
			DB::joinRaw("website__bundles__master__link on id_link = website__bundles__master__link.id", 'left');
			DB::joinRaw("website__bundles__master__if on id_if = website__bundles__master__if.id", 'left');
			DB::joinRaw("website__bundles__master__function on id_function = website__bundles__master__function.id", 'left');

			DB::whereRaw("id_website__bundles__website__master='" . $website_row->primary_key . "'");
			$bundle_tag_list = DB::get();
			if ($bundle_tag_list) {
				foreach ($bundle_tag_list as $b => $bundle_row) {
					$array = MainFaiFrameWork::bundles_array($page, $bundle_row);
					if (count($array)) {
						$website_content[$i]['template_array'][$b] = $array;
						$website_content[$i]['array'][$bundle_row->tag] = $array;
					}
				}
			}
		}
		return $website_content;
	}
	public static function bundles_array($page, $bundle_row)
	{
		global $collect_refer;
		$array =  [];

		if (isset($bundle_row->is_sub_array)) {
			if ($bundle_row->is_sub_array == 1) {
				DB::table('website__bundles__website__master');
				DB::whereRaw('id_parent_tag = ' . $bundle_row->primary_key);
				$sub = DB::get('all');

				if ($sub['num_rows']) {
					$array = MainFaiFrameWork::webcontent($page, $sub['row'][0]->id)[0];
				}
			}
		}
		if ($bundle_row->tag)
			$array['tag'] = $bundle_row->tag;
		if ($bundle_row->nama_bundle_tag)
			$array['nama_tag'] = $bundle_row->nama_bundle_tag;
		if (isset($bundle_row->kontent_file)) {
			if ($bundle_row->kontent_file) {
				$array['content_source'] = "template_database";
				$array['source_list'] = "template_database";
				$array['nama_file'] = $bundle_row->nama_file;
				$array['template_content'] = $bundle_row->kontent_file;
			}
		}

		if ($bundle_row->nama_refer)
			$array['refer'] = $bundle_row->kode_refer;
		if ($bundle_row->name_database) {
			if ($bundle_row->min_1 == 1) {

				DB::table('website__bundles__database');
				DB::whereRaw("website__bundles__database.id in(" . $bundle_row->id_database_refer . ")");
				$db = DB::get();
				foreach ($db as $db) {
					if ($db->db_utama) {
						$array['database'] = MainFaiFramework::config_database($page, $db);
					}
				}
				$array['database_refer'] = -1;
			} else {
				$array['database_refer'] = $bundle_row->name_database;
				$collect_refer[] = $bundle_row->id_database_refer;
			}
		}

		if ($bundle_row->text_content)
			$array['text'] = $bundle_row->text_content;
		if ($bundle_row->database_row)
			$array['row'] = $bundle_row->database_row;
		if ($bundle_row->get_result)
			$array['get_result'] = $bundle_row->get_result;
		if ($bundle_row->source_database)
			$array['source_database'] = $bundle_row->source_database;
		if ($bundle_row->tipe_header)
			$array['tipe_header'] = $bundle_row->tipe_header;
		if ($bundle_row->id_if) {
			$array['row'] = $bundle_row->row_if;
			DB::table('website__bundles__master__if__content');
			DB::whereRaw('id_website__bundles__master__if=' . $bundle_row->id_if);
			$if = DB::get();
			foreach ($if as $if) {
				if ($if->is_else == 1) {
					if ($if->if_text)
						$array['if_else'] = $if->if_text;
					else
						$array['if_else'] = MainFaiFrameWork::webcontent($page, $if->id_bundles_tag)[0];
				} else {
					if ($if->if_text)
						$array['if_value'][$if->row_value] = $if->if_text;
					else
						$array['if_value'][$if->row_value] = MainFaiFrameWork::webcontent($page, $if->id_bundles_tag)[0];
				}
			}
		}
		if ($bundle_row->id_link) {
			$array['route_type'] = $bundle_row->route_type;
			DB::table('website__bundles__master__link__parameter');
			DB::whereRaw('id_website__bundles__master__link=' . $bundle_row->id_link);
			DB::orderByRaw($page, array(array("urutan", "asc")));
			$function = DB::get();
			foreach ($function as $function) {
				$array['link'][] = $function->parameter;
			}
			$array['route_type'] = $bundle_row->route_type;
		}
		if (!empty($bundle_row->id_dropdown)) {
			DB::table('website__bundles__master__dropdown__list');
			DB::whereRaw('id_tag is not null and id_website__bundles__master__dropdown=' . $bundle_row->id_dropdown);
			DB::orderByRaw($page, array(array("parameter", "asc")));
			$dropdown = DB::get();
			foreach ($dropdown as $dropdown) {

				DB::table('website__bundles__tag'); // ada id_bundle tag
				DB::selectRaw('*,website__bundles__website__master.id as primary_key_website'); // ada id_bundle tag

				//
				// array("File Tag",null,"select",array( "website__template__file__tag",'id',"tag"),null), untuk dapet nama tag
				// array("Bundle Tag",null,"select",array("website__bundles__tag",'id',"nama_bundle_tag"),null), untuk isi tag
				DB::joinRaw("website__bundles__website__master on id_bundles_tag = website__bundles__tag.id", 'left');
				DB::joinRaw("website__template__file on id_file = website__template__file.id", 'left');
				// DB::joinRaw("website__bundles__website__master__tag on id_website__template__file = website__template__file.id",'left');
				DB::joinRaw("website__bundles__database on id_database_refer = website__bundles__database.id", 'left');
				DB::joinRaw("website__bundles__master__refer on id_refer = website__bundles__master__refer.id", 'left');
				DB::joinRaw("website__bundles__master__link on id_link = website__bundles__master__link.id", 'left');
				DB::joinRaw("website__bundles__master__if on id_if = website__bundles__master__if.id", 'left');
				DB::joinRaw("website__bundles__master__function on id_function = website__bundles__master__function.id", 'left');

				DB::whereRaw("website__bundles__tag.id='" . $dropdown->id_tag . "'");
				$dropdown_tag = DB::get();
				foreach ($dropdown_tag as $dropdown_tag) {
					//
					$array_dropdown =   MainFaiFrameWork::bundles_array($page, $dropdown_tag);
					if ($dropdown_tag->primary_key_website)
						$array_dropdown +=  MainFaiFrameWork::webcontent($page, $dropdown_tag->primary_key_website)[0];;
					if ($dropdown_tag->kontent_file) {
						$array_dropdown['content_source'] = "template_database";
						$array_dropdown['source_list'] = "template_database";
						$array_dropdown['template_content'] = $dropdown_tag->kontent_file;
					}
				}
				$array['dropdown'][$dropdown->parameter] = $array_dropdown;
			}
		}
		if ($bundle_row->id_function) {
			$array['struktur'] = $bundle_row->struktur;
			$array['class'] = $bundle_row->class;
			$array['function'] = $bundle_row->function;

			DB::table('website__bundles__master__function__parameter');
			DB::whereRaw('id_website__bundles__master__function=' . $bundle_row->id_function);
			DB::orderByRaw($page, array(array("urutan", "asc")));
			$function = DB::get();
			foreach ($function as $function) {
				$array['parameter'][] = $function->parameter;
			}
		}
		if ($bundle_row->id_banner) {


			DB::table('website__bundles__master__banner__content');
			DB::joinRaw("drive__file on file=drive__file.id", 'left');
			DB::whereRaw('id_website__bundles__master__banner=' . $bundle_row->id_banner);
			DB::orderByRaw($page, array(array("urutan", "asc"), array("drive__file.create_date desc, drive__file.sizes desc")));
			$function = DB::get('all');
			$get_func = $function;
			foreach ($function['row'] as $function) {
				$array['banner_list'][$function->id]["header"] = $function->header_caption;
				$array['banner_list'][$function->id]["deskripsi"] = $function->deskripsi_caption;
				$array['banner_list'][$function->id]["deskripsi_link"] = $function->link_ke;
				$array['banner_list'][$function->id]["image"] =  ($function->domain ? $function->domain : base_url()) . '/uploads/' . $function->path . '/' . $function->file_name_save;;
			}
		}
		if ($bundle_row->id_menu_list) {

			DB::table('website__bundles__master__menu__content');
			DB::joinRaw("website__bundles__master__menu on id_website__bundles__master__menu = website__bundles__master__menu.id", 'left');
			DB::joinRaw("website__template__file on id_file_foreach = website__template__file.id", 'left');
			DB::joinRaw("web__list_apps_menu on website__bundles__master__menu__content.id_menu = web__list_apps_menu.id", 'left');
			DB::whereRaw('id_website__bundles__master__menu=' . $bundle_row->id_menu_list);
			DB::orderByRaw($page, array(array("website__bundles__master__menu__content.urutan", "asc")));
			$function = DB::get();
			$xx = 0;

			foreach ($function as $function) {

				$array['file_menu'] = $function->kontent_file;
				$array['parameter'][$xx]['nama_menu'] = $function->nama_show_menu;
				$array['parameter'][$xx]['icon'] = $function->icon;
				$array['parameter'][$xx]['link'] = array($function->load_apps, $function->load_page_view,  $function->load_type, $function->load_page_id, $function->menu, $function->nav, $function->board, $function->page, $function->ambil_dari, $function->kode_link);
				$xx++;
			}
		}

		return $array;
	}
	// 	public static function urlframework($template, $urm)
	// 	{
	// 		$fai = new MainFaiFramework();
	// 		return $fai->urlframework($template, $urm);
	// 	}







}
