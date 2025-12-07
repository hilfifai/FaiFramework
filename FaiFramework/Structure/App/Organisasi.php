<?php

class Organisasi
{
	public static function menu()
	{
		//nama/link/icon
		$menu = array(
			array("menu", "Dashboard", array("", "", "", ""), ""),
			array("group", "Company Setup"),
			array("menu", "Kategori", array("Webmaster", "webmaster__organsiasi__kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Bidang", array("Webmaster", "webmaster__organsiasi__bidang", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Role", array("Webmaster", "webmaster__organsiasi__role", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Kerjasama", array("Webmaster", "webmaster__organisasi__tipe_kerjasama", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			//
			//
			//
			array("group", "Company Setup"),
			array("menu", "Organsiasi", array("Organisasi", "list_organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "organisasi_form", array("Organisasi", "organisasi_form", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","periode",array("Organisasi","periode","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","semester",array("Organisasi","semester","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","level",array("Organisasi","level","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","divisi",array("Organisasi","divisi","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","pangkat",array("Organisasi","pangkat","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","jabatan",array("Organisasi","jabatan","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu","anggota",array("Organisasi","anggota","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "follower", array("Organisasi", "follower", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "following", array("Organisasi", "following", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "parthner", array("Organisasi", "parthner", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "entitas", array("Organisasi", "entitas", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

		);

		return $menu;
	}
	public static function dashboard()
	{

		$page['title'] = "Profile";
		$page['subtitle'] = "";



		$card['listing_type'] = "profile-menu"; //info/listing/listmenu
		$card['default_id'] = "Tentang Saya";
		$card['view_default'] = "ViewVertical";
		$page['limit_page'] = 2;
		$card['menu'] = array(
			"Post" => array("icon", 'card-nav', 'array-layout-post'),
			"Tentang Saya" => array("icon", 'card-nav', 'array-layout-tentang_saya'),
			"Organisasi" => array("icon", 'card-nav', 'array-layout-dashboard'),
			"Program" => array("icon", 'card-nav', 'array-layout-dashboard'),
			"Projek" => array("icon", 'card-nav', 'array-layout-dashboard'),

		);
		$card['array-layout-tentang_saya'] = array(


			"type" => "nav",
			"defaultNav" => "Utama",
			"cardNav" => array(

				"Utama" => array(),
				"Struktural" => array(),
				"Vision Goals" => array(),
				"BSC" => array(),
				"Program" => array(),
				"Anggota" => array(),


			),




		);
		$page['view_layout'][] = array("card", "col-md-12", $card);
		return $page;
	}
	public static function starting($page_temp)
	{
		$i = 0;
		$website['content'][$i]['tag'] = "";
		$website['content'][$i]['content_source'] = "text";
		$website['content'][$i]['content'] = "<div class='container-fluid m-md-20 m-sm-8 m-xs-0 mt-xs-8 ' style='margin-top:100px;'>";
		$i += 1;
		$website['content'][$i]['tag'] = "";
		$website['content'][$i]['content_source'] = "text";

		$website['content'][$i]['content'] = "<div class='card'>
        <div class='card-body'>
       
            <h3 class='text-center'>Pengajuan Organisasi Sedang Dalam Proses</h3>
            <p class='mr-20 ml-20 ms-md-20 me-md-20 ms-sm-8 me-sm-8 text-center' >
                Pastikan organisasi anda tidak duplikasi dengan organisasi yang telah ada. Dan siapkan data organisasi anda untuk menjadi pertimbangan kami menyetujui organisasi yang anda buat..
            </p>
            <div class='text-center'>
            <a <LINK-DASHBOARD></LINK-DASHBOARD> class='btn btn-primary text-center'> 
                Mulai Menjelajahi Panel Organisasi
            </a>
            </div>
        </div>
        </div>
        
        ";
		// " . Partial::link_direct($page_temp, null, ["Dashboard", "user", "view_layout", -1]) . "
		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function list_organisasi()
	{





		$page['title'] = "Organisasi";



		$card['listing_type'] = "listingmenu"; //info/listing/listmenu
		$card['default_id'] = "Dashboard";
		$card['view_default'] = "ViewHorizontal";
		$page['limit_page'] = 1;
		$card['menu'] = array(
			"Dashboard" => array("icon", 'card-layout', 'array-layout-dashboard'),
			"List Organisasi" => array("icon", 'card-listing', 'array-menu'),
			"Daftarkan Organisasi" => array("icon", 'crud', 'array-crud'),
			"Pending Ajuan" => array("icon", 'card-listing', 'array-menu'),
			"Pending Keanggotaan" => array("icon", 'card-listing', 'array-menu'),
			"Ganti Panel" => array("icon", 'card-listing'),
		);
		//card-listing


		//layout//ViewHorizontal//ViewVertical//ViewListTables
		//layout -> 

		$card['array-menu'] =  array(
			"mode" => "crud",
			"database_refer" => "Daftarkan Organisasi",
			"array" => array(
				array("img", null, "datafile", array("organisasi", 'id', "nama_organisasi"), false),
				array("body", "tag"),
				array("title", "nama_organisasi", "database", true),
				array("subtitle", array("Be3 ID: ", "apps_id", ""), "database-costum", true),
				array("deskripsi", "bidang_organisasi", "database", true),
				//array("deskripsi",array("id_organisasi_bidang_on_organisasi","organisasi_bidang","id_organisasi_bidang","nama_bidang"),"database-join",true),
				array("extend", "CARD-FOOTER-BOTTOM", "button", array("a", "View Profile", "text", false)),
			),
		);
		$fai = new MainFaiFramework();
		$card['array-crud'] =  array(
			"mode" => "crud",
			"database_refer" => "Daftarkan Organisasi",
			"crud" => array(
				"redirect_after_submit" => array("Organisasi", 'starting', 'view_layout', -1, -1),
				"oninsert" => array(
					array(
						"tipe" => "insert",
						"insert" => array(
							"table_insert" => "organisasi__admin",
							"field" => array(
								array("id_user", "id_apps_user", "session"),
								array("sebagai", "created", "text"),
								array("id_organisasi", "", "last_value")
							),
						),
					),
					array(
						"tipe" => "session",
						"insert" => array(
							"field" => array(
								array("hak_akses", "organisasi", "text"),
								array("as", "organisasi", "text"),
								array("id_organisasi", "", "last_value")
							),
						),
					)
				)
			),
			"array" =>
			$fai->Apps("organisasi", "organisasi_form")['crud']['array']

		);

		$card['array-layout-dashboard'] = array(
			"array" => array(
				array(
					"cardType" => "template",

					"cardContent" => array(
						"template_name" => "CardDashboard.template",
						"template_form" => "soft-ui",
						"row" => "col-md-4",
						"content" => array(
							array("CARD-TITLE" => array(
								"dataType" => "text",
								"text" => "Jumlah Organisasi"
							)),
							array("CARD-NUMBER-TEXT" => array(
								"dataType" => "database",
								"database_refer" => "Dashboard-Query",
								"database_row" => "jumlah_organisasi"
							)),
						),

					)
				),

				array(
					"cardType" => "template",

					"cardContent" => array(
						"template_name" => "CardDashboard.template",
						"template_form" => "soft-ui",
						"row" => "col-md-4",
						"content" => array(
							array("CARD-TITLE" => array(
								"dataType" => "text",
								"text" => "Pengajuan Organisasi"
							)),
							array("CARD-NUMBER-TEXT" => array(
								"dataType" => "database",
								"database_refer" => "Dashboard-Query",
								"database_row" => "jumlah_pengajuan"
							)),
						),

					)
				),

				array(
					"cardType" => "template",

					"cardContent" => array(
						"template_name" => "CardDashboard.template",
						"template_form" => "soft-ui",
						"row" => "col-md-4",
						"content" => array(
							array("CARD-TITLE" => array(
								"dataType" => "text",
								"text" => "Pengajuan Keanggotaan"
							)),
							array("CARD-NUMBER-TEXT" => array(
								"dataType" => "database",
								"database_refer" => "Dashboard-Query",
								"database_row" => "jumlah_ajuan_anggota"
							)),
						),

					)
				),

			)

		);
		/*
		"database"=>array(
						array(
										"name"=>"",
										"utama"=>"organisasi_anggota",
										"primary_key"=>"id_organisasi",
										"select" => array("*","(select sum())")
									)
									)
		array("card-single"=>array(
				"row"=>"col-md-3",
				"content"=>array(
						array("")
					),
				"database"=>null
				)),

		*/



		// 		$page['enkripsi'] = array("nama_organisasi","apps_id","email_organisasi","narahubung_organisasi","nama_narahubung","alamat_organisasi","bidang_organisasi");
		// $page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';

		// $page['config']['database']['List Organisasi']['utama'] = 'organisasi';
		// $page['config']['database']['List Organisasi']['primary_key'] = null;
		// $page['config']['database']['List Organisasi']['where'][] = array("status_organisasi", "=", "'aktif'");
		// $page['config']['database']['List Organisasi']['order'][] = array("nama_organisasi", "asc");

		// $page['config']['database']['Daftarkan Organisasi']['utama'] = 'organisasi';
		// $page['config']['database']['Daftarkan Organisasi']['primary_key'] = null;

		// // $page['config']['database']['Dashboard-Number-Text']['select'] = array('count(*) as jumlah_organisasi');
		// // $page['config']['database']['Dashboard-Number-Text']['utama'] = 'organisasi_konfirm_anggota';
		// // $page['config']['database']['Dashboard-Number-Text']['primary_key'] = null;
		// // $page['config']['database']['Dashboard-Number-Text']['utama'] = 'organisasi_konfirm_anggota';
		// // $page['config']['database']['Dashboard-Number-Text']['where'][] = array("id_user", "=", "'2021031816193639478'");
		// // $page['config']['database']['Dashboard-Number-Text']['where'][] = array("status", "=", "'done'");

		// // $page['config']['database']['Dashboard-Query']['select'] = array(
		// // 	"(SELECT count(*) FROM `organisasi_konfirm_anggota` where id_user = '2021031816193639478' and status='done') as jumlah_organisasi",
		// // 	"(SELECT count(*) FROM `organisasi_konfirm_anggota` where id_user = '2021031816193639478' and status='wait' and mode = 'admision') as jumlah_ajuan_anggota", "(SELECT count(*) FROM organisasi where who_created='2021031816193639478' and status_organisasi='pengajuan') as jumlah_pengajuan"
		// // );


		// $page['config']['database']['Pending Ajuan']['utama'] = 'organisasi';
		// $page['config']['database']['Pending Ajuan']['primary_key'] = null;
		// $page['config']['database']['Pending Ajuan']['where'][] = array("status_organisasi", "=", "'pengajuan'");
		// $page['config']['database']['Pending Ajuan']['order'][] = array("nama_organisasi", "asc");


		$page['view_layout'][] = array("card", "col-md-12", $card);

		return $page;
	}
	public static function organisasi_form()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "organisasi";
		$primary_key = null;

		$array = array(

			array("Logo", "logo", "file", "system/organisasi/logo"),
			array("Nama Organisasi", "nama_organisasi", "text"),
			array("Be3 ID", "apps_id", "text"),
			array("Email Organisasi", "email_organisasi", "email"),
			array("Narahubung", "narahubung_organisasi", "number"),
			array("Nama Narahubung", "nama_narahubung", "text"),
			array("Alamat", "alamat_organisasi", "textarea"),

			array("Kategori", "id_kategori_organisasi", "select", array("webmaster__organsiasi__kategori", "id", "nama_kategori")),
			array("Bidang", "bidang_organisasi", "select-ajax"),
			// 			array("Status Organisasi","status_organisasi","select-manual",array("pengajuan"=>"Pengajuan","aktif"=>"Aktif")),
		);
		$search = array();
		$sub_kategori[] = ["Admin", $database_utama . "__admin", null, "table"];
		$array_sub_kategori[] = array(

			array("User", null, "select", array("apps_user", "", "nama_lengkap")),
		);

		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}



	public static function parthner()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "organisasi__relasi__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
			array("Organisasi Parthner", null, "select", array("organisasi", null, "nama_organisasi", "parthner")),
			array("Tipe Kerjasama", null, "select", array("webmaster__organisasi__tipe_kerjasama", null, "nama_kerjasama")),

		);
		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}

	public static function entitas()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "organisasi__relasi__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),

		);
		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
}
