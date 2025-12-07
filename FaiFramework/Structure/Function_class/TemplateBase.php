<?php
class TemplateBase
{
	public static function soft_ui($page = [])
	{
		$page['load']['body_style'] = "background: #f8f9fa !important;";


		return $page;
	}
	public static function ashion($page = [])
	{
		$page['load']['card_template']['main_listing']['template_name'] = "ashion";
		$page['load']['card_template']['main_listing']['template_file'] = "_CardMainListingMenu.template";

		return $page;
	}
	public static function sneat($page = [])
	{
		$page['load']['crud_template']['class']['not_select2'] = "table-light";
		$configuration['prefix']['grup'] = '<li class="menu-header small text-uppercase">
		                  <span class="menu-header-text">';
		$configuration['sufix']['grup'] = '</span>
		<content-grup></content-grup>
		                </li>';

		$configuration['prefix']['menu'] = '<li class="menu-item">
                <a  |LINK| class="menu-link">
				 <div class="">
                        <ICON></ICON>
                       </div>';
		$configuration['sufix']['menu'] = '
                </a>
              </li>';

		$page['configuration'] = $configuration;
		return $page;
	}
	public static function adminlte($page = [])
	{
		// 		$page['crud']['enddiv'] = '</div>';
		// 		$page['crud']['startdiv'] = '<div class="mb-3"><label class="form-label"><TEXT-LABEL></TEXT-LABEL></label>';
		$page['load']['crud_template']['class']['thead'] = "table-light";
		$page['load']['crud_template']['class']['button_save'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_kembali'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_import_export'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_print'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_approve'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_decline'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_add'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['submit import'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['excel'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['pdf'] = "btn btn-outline-info mb-2 ";
		$page['load']['crud_template']['class']['button_add_prefix'] = "flex-grow-1";
		$page['load']['crud_template']['class']['table'] = "table text-nowrap table-centered mt-0";
		$page['load']['crud_template']['class']['print'] = "btn btn-success btn-icon btn-sm rounded-circle texttooltip";
		$page['load']['crud_template']['class']['view'] = "btn btn-success btn-xs";
		$page['load']['crud_template']['class']['edit'] = "btn btn-primary btn-xs";
		$page['load']['crud_template']['class']['delete'] = "btn-xs btn btn-danger";
		// $page['load']['crud_template']['text']['view'] = "<span class='fa fa-eye'></span>";
		$page['load']['crud_template']['text']['print'] = '<span class="fa fa-print"></span> Print';
		$page['load']['crud_template']['text']['pdf'] = '<span class="fa fa-file"></span> PDF';
		$page['load']['crud_template']['text']['excel'] = '<span class="fa fa-download"></span> Excel';
		$page['load']['crud_template']['text']['template'] = '<span class="fa fa-download"></span> Template';
		$page['load']['crud_template']['text']['Import'] = '<span class="fa fa-upload"></span> Import';
		$page['load']['crud_template']['text']['tambah'] = '<span class="fa fa-plus-circle"></span>';
		$page['load']['crud_template']['text']['approve'] = "<span class='fa fa-check'></span>
                        
		Approve";
		$page['load']['crud_template']['text']['decline'] = "<span class='fa fa-times'></span>
		Decline";
		// $page['load']['crud_template']['text']['edit'] = '<span class="fa fa-edit"></span>';
		// $page['load']['crud_template']['text']['delete'] = '<span class="fa fa-trash"></span>';
		$page['load']['crud_template']['text']['kembali'] = "<span class='fa fa-times'></span> Batal";
		$page['load']['crud_template']['text']['save'] = "<span class='fa fa-save'></span> Simpan";
		$page['load']['crud_template']['table_prefix'] = '<div class="table-responsive table-card">';
		$page['load']['crud_template']['table_sufix'] = '</div>';

		$page['load']['crud_template']['list'] = array(
			"template_name" => "adminlte",
			"template_file" => "",

		);
		$page['load']['crud_template']['vte'] = array(
			"template_name" => "adminlte",
			"template_file" => "",

		);

		return $page;
	}
	public static function dashuipro($page = [])
	{
		// 		$page['crud']['enddiv'] = '</div>';
		// 		$page['crud']['startdiv'] = '<div class="mb-3"><label class="form-label"><TEXT-LABEL></TEXT-LABEL></label>';
		$page['load']['crud_template']['class']['thead'] = "table-light";
		$page['load']['crud_template']['class']['button_save'] = "btn btn-primary btn-sm mb-2 me-2";
		$page['load']['crud_template']['class']['button_kembali'] = "btn btn-danger-soft mb-2 me-2";
		$page['load']['crud_template']['class']['button_print'] = "btn btn-primary btn-sm mb-2 me-2";
		$page['load']['crud_template']['class']['button_add'] = "btn btn-primary btn-sm mb-2 me-2";
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
		$page['load']['crud_template']['text']['kembali'] = "<span class='bi bi-door-closed'></span>Batal";
		$page['load']['crud_template']['text']['save'] = "<span class='bi bi-save'></span>Simpan";
		$page['load']['crud_template']['table_prefix'] = '<div class="table-responsive table-card">';
		$page['load']['crud_template']['table_sufix'] = '</div>';

		$page['load']['crud_template']['list'] = array(
			"template_name" => "dashuipro",
			"template_file" => "",

		);
		$page['load']['crud_template']['vte'] = array(
			"template_name" => "dashuipro",
			"template_file" => "",

		);
		return $page;
	}
	public static function hibe3($page )
	{
		// 		$page['crud']['enddiv'] = '</div>';
		// 		$page['crud']['startdiv'] = '<div class="mb-3"><label class="form-label"><TEXT-LABEL></TEXT-LABEL></label>';
		$page['load']['crud_template']['class']['thead'] = "table-light";
		$page['load']['crud_template']['class']['button_save'] = "btn btn-primary btn-sm mb-2 me-2";
		$page['load']['crud_template']['class']['button_kembali'] = "btn btn-danger-soft mb-2 me-2";
		$page['load']['crud_template']['class']['button_print'] = "btn btn-primary btn-sm mb-2 me-2";
		$page['load']['crud_template']['class']['button_add'] = "btn btn-primary btn-sm mb-2 me-2";
		$page['load']['crud_template']['class']['button_add_prefix'] = "flex-grow-1";
		$page['load']['crud_template']['class']['table'] = "table  table-centered mt-0 w-100";
		$page['load']['crud_template']['class']['print'] = "btn btn-primary btn-sm btn-icon btn-sm rounded-circle texttooltip";
		$page['load']['crud_template']['class']['view'] = "btn btn-primary btn-sm texttooltip me-2";
		$page['load']['crud_template']['class']['excel'] = "btn btn-primary btn-sm texttooltip me-2";
		$page['load']['crud_template']['class']['pdf'] = "btn btn-primary btn-sm texttooltip me-2";
		$page['load']['crud_template']['class']['edit'] = "btn btn-primary btn-sm texttooltip me-2";
		$page['load']['crud_template']['class']['delete'] = "btn btn-primary btn-sm texttooltip me-2";
		$page['load']['crud_template']['text']['view'] = "Detail";
		$page['load']['crud_template']['text']['edit'] = "Edit";
		$page['load']['crud_template']['text']['delete'] = "Delete";
		$page['load']['crud_template']['text']['kembali'] = "<span class='bi bi-door-closed'></span>Batal";
		$page['load']['crud_template']['text']['save'] = "<span class='bi bi-save'></span>Simpan";
		$page['load']['crud_template']['table_prefix'] = '<div class="table-responsive table-card">';
		$page['load']['crud_template']['table_sufix'] = '</div>';
		$page['load']['template']['load_header']['class'] = 'sticky-top';
		$i = 0;
		$navbar['tag'] = "BANNER";
		$navbar['content_source'] = "template";
		$navbar['database_refer'] = "Detail";
		$navbar['template_name'] = "hibe3";
		$navbar['template_file'] = "NavbarPage";
		$navbar['session_name'] = "hak_akses";
		$navbar['template_array'] = array(
			array(
				"tag" => 'HEADER-LIST',
				"source_list" => "dropdown",
				// "template_name" => "hibe3",
				// "template_file" => "Navbar",
				'dropdown' => array(
					1 => array(
						"refer" => "template",
						"template_name" => "hibe3",
						"template_file" => "NavbarNotification.template",
					),
					2 => array(
						"refer" => "template",
						"template_name" => "hibe3",
						"template_file" => "NavbarButtonSearch.template",
					),
					3 => array(
						"refer" => "template",
						"template_name" => "hibe3",
						"template_file" => "NavbarListProfile.template",
						"database_refer" => "User",
						'array' => array(
							"NAMA-LENGKAP" => array(
								"refer" => "database",
								"row" => "nama_lengkap",
							),
							"BE3ID-USER" => array(
								"refer" => "database",
								"row" => "apps_id",
							),

							"LINK-LOGOUT" => array(
								"refer" => "link",
								"route_type" => "costum_link",
								"link" => array("Auth", "logout", "-1", "-1")
							),

							"LINK-PEMESANAN" => array(
								"refer" => "link",
								"route_type" => "just_link",
								"link" => array("User", "pemesanan", "view_layout", "-1")
							),

							"LINK-PROFIL-USER" => array(
								"refer" => "link",
								"route_type" => "just_link",
								"link" => array("User", "profil", "view_layout", "-1")
							),

						),
					),
				),
			),

			array(
				"tag" => 'HEADER-LOGO',
				"refer" => "template",
				"template_name" => "hibe3",
				"template_file" => "NavbarLogo.template",
				'array' => array(
					"IMAGE-LOGO" => array(
						"refer" => "tipe_header",
						"tipe_header" => "logo_utama",
					),
					"BASE-URL" => array(
						"refer" => "tipe_header",
						"tipe_header" => "base_url",
					),

					"LINK-LOGOUT" => array(
						"refer" => "link",
						"route_type" => "costum_link",
						"link" => array("Auth", "logout", "-1", "-1")
					),

					"LINK-PEMESANAN" => array(
						"refer" => "link",
						"route_type" => "just_link",
						"link" => array("User", "pemesanan", "view_layout", "-1")
					),

					"LINK-PROFIL-USER" => array(
						"refer" => "link",
						"route_type" => "just_link",
						"link" => array("User", "profil", "view_layout", "-1")
					),
				),
			),
			array(
				"tag" => 'HEADER-SEARCH',
				"refer" => "template",
				"template_name" => "hibe3",
				"template_file" => "NavbarSearch.template",
				"extend" => array("search"),
				"search" => array(
					"div-id" => "",
					"div-result" => "",
					"input_name" => "",
					"database" => array(
						""
					),
				),

			),
			array(
				"tag" => 'HEADER-TOGGLE',
				"refer" => "template",
				"template_name" => "hibe3",
				"template_file" => "NavbarToggle.template",


			),
		);
		// 		$sidebar = [
		// 			"template_name" => "hibe3",
		// 			"template_file" => "SidebarPage",
		// 			"session_name" => "hak_akses",
		// 			"content_array" => [
		// 				[
		// 					"tipe" => null,
		// 					"source" => "database_list",
		// 					"tag" => "LIST",
		// 					"folder_tag" => "hibe3",
		// 					"file_tag" => "SidebarList.template",
		// 					"database_refer" => "Panel",
		// 					"database" => [
		// 						"Panel" => [
		// 							"utama" => "panel__user",
		// 							"primary_key" => "id",
		// 							"select" => [
		// 								"distinct id_panel,panel__user.id_apps_user,nama_panel",
		// 							],
		// 							"where" => [
		// 								["panel__user.id_apps_user", "=", "{SESSION_UTAMA}"],
		// 								["panel__user.id_panel", " is ", "not null"],
		// 							],
		// 							"join" => [["panel", "panel.id", "id_panel"]],
		// 							"content_tag" => [
		// 								[
		// 									"tag" => "NAME",
		// 									"source" => "foreach_database",
		// 									"row_database" => "nama_panel",
		// 									"database_refer" => "Panel",
		// 								],
		// 							],
		// 						],
		// 					],
		// 				],
		// 			],
		// 		];

		$tipe_sidebar =  (isset($page['load']['row_web_apps'])?$page['load']['row_web_apps']->tipe_sidebar:'');
		if ($tipe_sidebar == 'database_web_apps' and isset($page['load']['tipe_sidebar'])) {
			$page['load']['tipe_sidebar'];
			$db_side = [
				"utama" => "web__apps_sidebar",
				"where" => [
					["group_sidebar", '=', "'" . $page['load']['tipe_sidebar'] . "'"]
				],
				"join" => [["web__list_apps_menu", "web__list_apps_menu.id", "id_menu", "left"]],
			];
			$array_side = array(
				"NAME" => array("refer" => "database", "row" => "nama_menu"),
				"LINK" => array("refer" => "link", "route_type" => "just_link", "link" => array("row:load_apps!database|", "row:load_page_view!database|", "row:load_type!database|", "row:load_page_id!database|")),
			);
		} else if ($tipe_sidebar == 'panel') {
			$db_side = array(

				"utama" => "panel__user",
				"primary_key" => "id",
				"select" => [
					"distinct id_panel,panel__user.id_apps_user,nama_panel",
				],
				"where" => [
					["panel__user.id_apps_user", "=", "{SESSION_UTAMA}"],
					["panel__user.id_panel", " is ", "not null"],
				],
				"join" => [["panel", "panel.id", "id_panel"]],


			);
			$array_side = array(
				"NAME" => array("refer" => "database", "row" => "nama_panel"),
				"LINK" => array("refer" => "link", "route_type" => "costum_link", "link" => array("Auth", "change_panel", "id_web__apps|", "row:id_panel!database|")),
			);
		}
		if (isset($db_side)) {

			$sidebar['tag'] = "SIDEBAR";
			$sidebar['content_source'] = "template";
			$sidebar['database_refer'] = "Detail";
			$sidebar['template_name'] = "hibe3";
			$sidebar['template_file'] = "SidebarPage";
			$sidebar['session_name'] = "hak_akses";
			$sidebar['template_array'] = array(
				array(
					"tag" => 'LIST',
					"source_list" => 'template',
					"template_name" => "hibe3",
					"template_file" => "SidebarList.template",
					"refer" => "database_list",
					"database_refer" => "-1",
					"database" => $db_side,
					"template_name" => "hibe3",
					"template_file" => "SidebarList.template",
					"array" => $array_side,
				),
			);
		}else{
			$sidebar=[];
		}
		$page['config']['database']['panel'] = array(

			"utama" => "panel__user",
			"primary_key" => "id",
			"select" => [
				"distinct id_panel,panel__user.id_apps_user,nama_panel",
			],
			"where" => [
				["panel__user.id_apps_user", "=", "{SESSION_UTAMA}"],
				["panel__user.id_panel", " is ", "not null"],
			],
			"join" => [["panel", "panel.id", "id_panel"]],
			"where_get_array" => array(
				array(
					"row" => "id_toko",
					"array_row" => "database_list_template",
					"get_row" => "id_toko"
				),
			)

		);
		$header['tag'] = "BANNER";
		$header['content_source'] = "template";
		$header['database_refer'] = "Detail";
		$header['template_name'] = "hibe3";
		$header['template_file'] = "HeaderPage";
		$header['session_name'] = "hak_akses";
		$header['template_array'] = array(
			array(
				"tag" => 'LINK-CART',
				"refer" => "link",
				"link" => array("Ecommerce", "cart", "view_layout", "-1")

			),
			array(
				"tag" => 'HEADER-UTAMA',
				"template_name" => "hibe3",
				"template_file" => "HeaderList.template",
				"refer" => "database_list",
				"database_refer" => "-1",
				"database" => array(
					"utama" => "tab_group",
					"primary_key" => "id",
					"where" => [["id_apps_user", "=", "{SESSION_UTAMA}"]],
				),
				"template_name" => "hibe3",
				"template_file" => "SidebarList.template",
				"array" => array(
					"NAME" => array("refer" => "database", "row" => "nama_menu_tab"),
					"LINK" => array("refer" => "link", "row" => "nama_menu_tab"),
				),
			),
		);


		$navbar = [
			"template_name" => "hibe3",
			"template_file" => "NavbarPage",
			"session_name" => "hak_akses",
			"content_array" => [
				[
					"tipe" => "",
					"source" => "dropdown",
					"tag" => "HEADER-LIST",
					"folder_tag" => "hibe3",
					"file_tag" => "Navbar",
					"database_refer" => null,
					"content_tag" => [
						[
							"tag" => null,
							"source" => "file",
							"file_tag" => null,
							"folder_tag" => null,
							"tipe_header" => null,
							"row_database" => null,
							"database_refer" => null,
						],
					],
					"content_dropdown" => [
						[
							"type_header" => null,
							"source" => "file",
							"folder_tag" => "hibe3",
							"file_tag" => "NavbarNotification.template",
						],
						[
							"type_header" => null,
							"source" => "file",
							"database_refer" => null,
							"folder_tag" => "hibe3",
							"file_tag" => "NavbarListProfile.template",

							"content_tag" => [
								[
									"tag" => "LINK-LOGOUT",
									"source" => "link",
									"route_type" => "costum_link",
									"link" => array("Auth", "logout", "-1", "-1")
								],
								[
									"tag" => "LINK-PEMESANAN",
									"source" => "link",
									"route_type" => "just_link",
									"link" => array("User", "pemesanan", "view_layout", "-1")
								],
								[
									"tag" => "LINK-PROFIL-USER",
									"source" => "link",
									"route_type" => "just_link",
									"link" => array("User", "profil", "view_layout", "-1")
								],

								[

									"source" => "database_list",
									"tag" => "NAMA-LENGKAP",
									"row_database" => "nama_lengkap",
									"database_refer" => "USER",
									"database" => [
										"USER" => [
											"utama" => "apps_user",
											"primary_key" => "id",

											"where" => [
												["id_apps_user", "=", "{SESSION_UTAMA}"],
											],


										],
									],
								],

								// 	"source" => "foreach_database",
								// 	"row_database" => "nama_panel",
							]
						],
						[
							"type_header" => null,
							"source" => "file",
							"folder_tag" => "hibe3",
							"file_tag" => "NavbarButtonSearch.template",
						],
					],
				],
				[
					"tipe" => "",
					"source" => "file",
					"tag" => "HEADER-LOGO",
					"folder_tag" => "hibe3",
					"file_tag" => "NavbarLogo.template",
					"database_refer" => null,
					"content_tag" => [
						[
							"tag" => "IMAGE-LOGO",
							"source" => "tipe_header",
							"file_tag" => null,
							"folder_tag" => null,
							"tipe_header" => "logo_utama",
							"row_database" => null,
							"database_refer" => null,
						],
						[
							"tag" => "BASE-URL",
							"source" => "base_url",
							"file_tag" => null,
							"folder_tag" => null,
							"tipe_header" => "base_url",
							"row_database" => null,
							"database_refer" => null,
						],
					],
				],
				[
					"tipe" => "search",
					"source" => "file",
					"tag" => "HEADER-SEARCH",
					"folder_tag" => "hibe3",
					"file_tag" => "NavbarSearch.template",
					"database_refer" => null,
				],
				[
					"tipe" => "",
					"source" => "file",
					"tag" => "HEADER-TOGGLE",
					"folder_tag" => "hibe3",
					"file_tag" => "NavbarToggle.template",
					"database_refer" => null,
				],
			],
		];
		$header = [
			"template_name" => "hibe3",
			"template_file" => "HeaderPage",
			"session_name" => "hak_akses",
			"content_array" => [
				[
					"tipe" => "",
					"tag" => "LINK-CART",
					"source" => "link",
					"link" => array("Ecommerce", "cart", "view_layout", "-1")
				],
				[
					"tipe" => "",
					"source" => "database_list",
					"tag" => "HEADER-UTAMA",
					"folder_tag" => "hibe3",
					"file_tag" => "HeaderList.template",
					"database_refer" => "Tab Group",
					"database" => [
						"Tab Group" => [
							"utama" => "tab_group",
							"primary_key" => "id",
							"where" => [["id_apps_user", "=", "{SESSION_UTAMA}"]],
							"content_tag" => [
								[
									"tag" => "NAME",
									"source" => "foreach_database",
									"file_tag" => null,
									"folder_tag" => null,
									"tipe_header" => null,
									"row_database" => "nama_menu_tab",
									"database_refer" => "Tab Group",
								],
								[
									"tag" => "LINK",
									"source" => "get_database",
									"file_tag" => null,
									"folder_tag" => null,
									"tipe_header" => null,
									"row_database" => null,
									"database_refer" => null,
								],
							],
						],
					],
					"content_tag" => [
						[
							"tag" => "LINK",
							"source" => "link_menu",
							"file_tag" => null,
							"folder_tag" => null,
							"tipe_header" => "",
							"row_database" => null,
							"database_refer" => null,
						],
					],
				],
			],
		];

		$page['load']['navbar'] = $navbar;
		$page['load']['header'] = $header;
		$page['load']['sidebar'] = $sidebar;
		return $page;
	}
}
