<?php

class Kegiatan
{


	public static function list_kegiatan()
	{

		$page['title'] = "Be3 Ihsan Produktif";
		$page['subtitle'] = "Be3 Ihsan Produktif adalah aplikasi yang dirancang khusus untuk membantu manajement perencanaan produktifitas kerja";



		$card['listing_type'] = "listingmenu"; //info/listing/listmenu
		$card['default_id'] = "Mutabaah Yaumiyah";
		$card['view_default'] = "ViewVertical";
		$page['limit_page'] = 2;
		$card['menu'] = array(
			"Dashboard" => array("icon", 'card-nav', 'array-layout-dashboard'),
			"Tujuan" => array("icon", 'card-nav', 'array-layout-dashboard'),
			"Planner" => array("icon", 'card-nav', 'array-layout-dashboard'),
			
			"Kegiatan" => array("icon", 'card-nav', 'array-layout-mutabaah'),
			"Habits" => array("icon", 'card-nav', 'array-layout-mutabaah'),
			"Mutabaah Yaumiyah" => array("icon", 'card-nav', 'array-layout-mutabaah'),
			"Task Planner" => array("icon", 'crud', 'array-crud'),
		);
		//card-listing


		//layout//ViewHorizontal//ViewVertical//ViewListTables
		//layout -> 


		$card['array-layout-dashboard'] = array(
			"array" => array(
				array(
					"cardType" => "template",

					"cardContent" => array(
						"template_name" => "ProfileTingkatScore.template",
						"template_form" => "codepen",
						"row" => "col-md-12",
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
						"template_name" => "HarianList.template",
						"template_form" => "codepen",
						"row" => "col-md-12",
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

			),


		);
		$card['array-layout-mutabaah'] = array(


			"type" => "nav",
			"defaultNav" => "Muktabaah",
			"cardNav" => array(
				"Muktabaah" => array(
					"mode" => "card-layout",
					
					"titlenav"=>"Hallo",
					"array" => array(
						array(

							"cardType" => "template",
							"cardContent" => array(

								"template_name" => "HabitsTable.template",
								"template_form" => "beegrit",
								"row" => "col-md-12",

								"content" => array(),
							),
						),
					)


				),
				"Board" => array(
					"mode" => "card-listing",
					"database_refer" => "Board Amalan",
					"view_default" => "ViewVertical",
					"row" => "col-xl-2 col-md-6 mb-xl-0 mb-4",
					"prelist" => array(
						//0-> template,manual,exted,website
						array("extend", "button", array("a", "Tambah Board", "text", false, array("Kegiatan", "list_kegiatan", "view_layout", "-1", "Mutabaah Yaumiyah", "Tambah Board"), array("class" => "btn btn-primary btn-sm"))),
						array("extend", "button", array("a", "Cari Board", "text", false, array("Kegiatan", "list_kegiatan", "view_layout", "-1", "Mutabaah Yaumiyah", "Cari Board"), array("class" => "btn btn-primary btn-sm"))),

					),
					"array" => array(

						array("img", null, "datafile", array("ltw_kegiatan__board", 'id', "nama_board"), false),
						array("body", "tag"),
						array("title", "nama_board", "database", true),
						array("subtitle", array("Be3 ID: ", "be3_id", ""), "database-costum", true),
						array("deskripsi", "deskripsi", "database", true),
						array("extend", "CARD-FOOTER-BOTTOM", "button", array("a", "View Board", "text", false, array("Kegiatan", "board_amalan", "view_layout", "{{row:primary_key}}", "Muktabaah", ""), array("claas" => "btn btn-primary btn-sm"))),

					),
				),
				"Cari Board" => array(
					"visible" => false,
					"mode" => "card-listing",
					"database_refer" => "Cari Board Amalan",
					"view_default" => "ViewVertical",
					"row" => "col-xl-2 col-md-6 mb-xl-0 mb-4",
					"array" => array(

						array("img", null, "datafile", array("ltw_kegiatan__board", 'id', "nama_board"), false),
						array("body", "tag"),
						array("title", "nama_board", "database", true),
						array("subtitle", array("Be3 ID: ", "be3_id", ""), "database-costum", true),
						array("deskripsi", "deskripsi", "database", true),
						array("extend", "CARD-FOOTER-BOTTOM", "button", array("a", "Gabung", "text", false, array("Kegiatan", "board_amalan", "view_layout", "{{row:primary_key}}", "Muktabaah", ""), array("claas" => "btn btn-primary btn-sm"))),
					),

				),
				"Tambah Board" => array(
					"visible" => false,
					"mode" => "crud",
					"database_refer" => "Tambah Board",
					"crud" => array(
						"redirect_after_submit" => array("Kegiatan", 'list_kegiatan', 'view_layout', -1, 'Mutabaah Yaumiyah'),
						"oninsert" => array(
							array(
								"tipe" => "insert",
								"insert" => array(
									"table_insert" => "ltw_kegiatan__board__user",
									"field" => array(
										array("id_user", "id_apps_user", "session"),
										array("sebagai", "admin", "text"),
										array("id_ltw_kegiatan__board", "", "last_value")
									),
								),
							)
						)
					),
					"array" => array(
						array("Be3 ID", null, "text"),
						array("Nama Board", null, "text"),
						array("Deskripsi", null, "text"),
						array("Brosur", null, "file", 'kegiatan/brosur'),
					),
					
				),
				"Report" => array(),
				"Leader Board" => array(
					"mode" => "card-layout",
					"array" => array(
						array(

							"cardType" => "template",
							"cardContent" => array(

								"template_name" => "learderboard/leaderboard.template",
								"template_form" => "codepen",
								"row" => "col-md-12",

								"content" => array(),
							),
						),
					)
				)
			),




		);
		$card['array-layout-task-planner'] = array(


			"type" => "nav",
			"defaultNav" => "Board",

			"cardNav" => array(
				"Board" => array(
					"mode" => "card-listing",
					"database_refer" => "Pending Ajuan",
					"view_default" => "ViewHorizontal",
					"array" => array(

						array("img", null, "datafile", array("organisasi", 'id', "nama_organisasi"), false),
						array("body", "tag"),
						array("title", "nama_organisasi", "database", true),
						array("subtitle", array("Be3 ID: ", "apps_id", ""), "database-costum", true),
						array("deskripsi", "bidang_organisasi", "database", true),
						//array("deskripsi",array("id_organisasi_bidang_on_organisasi","organisasi_bidang","id_organisasi_bidang","nama_bidang"),"database-join",true),
						array("extend", "CARD-FOOTER-BOTTOM", "button", array("a", "View Profile", "text", false)),

					),
				),
			),




		);



		$page['view_layout'][] = array("card", "col-md-12", $card);

		$page['enkripsi'] = array("nama_organisasi", "apps_id", "email_organisasi", "narahubung_organisasi", "nama_narahubung", "alamat_organisasi", "bidang_organisasi");
		$page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';

		// $page['config']['database']['List Organisasi']['utama'] = 'organisasi';
		// $page['config']['database']['List Organisasi']['primary_key'] = 'id_organisasi';
		// $page['config']['database']['List Organisasi']['where'][] = array("status_organisasi", "=", "'aktif'");
		// $page['config']['database']['List Organisasi']['order'][] = array("nama", "asc");

		// $page['config']['database']['Daftarkan Organisasi']['utama'] = 'organisasi';
		// $page['config']['database']['Daftarkan Organisasi']['primary_key'] = 'id_organisasi';

		// $page['config']['database']['Dashboard-Number-Text']['select'] = array('count(*) as jumlah_organisasi');
		// $page['config']['database']['Dashboard-Number-Text']['utama'] = 'organisasi_konfirm_anggota';
		// $page['config']['database']['Dashboard-Number-Text']['where'][] = array("id_user", "=", "'2021031816193639478'");
		// $page['config']['database']['Dashboard-Number-Text']['where'][] = array("status", "=", "'done'");

		// $page['config']['database']['Dashboard-Query']['select'] = array(
		// 	"(SELECT count(*) FROM `organisasi_konfirm_anggota` where id_user = '2021031816193639478' and status='done') as jumlah_organisasi",
		// 	"(SELECT count(*) FROM `organisasi_konfirm_anggota` where id_user = '2021031816193639478' and status='wait' and mode = 'admision') as jumlah_ajuan_anggota", "(SELECT count(*) FROM organisasi where who_created='2021031816193639478' and status_organisasi='pengajuan') as jumlah_pengajuan"
		// );


		$page['config']['database']['Pending Ajuan']['utama'] = 'organisasi';
		$page['config']['database']['Pending Ajuan']['primary_key'] = 'id';
		$page['config']['database']['Pending Ajuan']['where'][] = array("status_organisasi", "=", "'pengajuan'");
		$page['config']['database']['Pending Ajuan']['order'][] = array("nama", "asc");

		$page['config']['database']['Tambah Board']['utama'] = 'ltw_kegiatan__board';
		$page['config']['database']['Tambah Board']['primary_key'] = null;

		$page['config']['database']['Board Amalan']['utama'] = 'ltw_kegiatan__board';
		$page['config']['database']['Board Amalan']['primary_key'] = 'id';
		$page['config']['database']['Board Amalan']['join'][] = array("ltw_kegiatan__board__user", "ltw_kegiatan__board__user.id_ltw_kegiatan__board", "ltw_kegiatan__board.id");
		$page['config']['database']['Board Amalan']['where'][] = array("id_user", "=", "'ID_APPS_USER|'");
		$page['config']['database']['Board Amalan']['order'][] = array("nama_board", "asc");

		$page['config']['database']['Cari Board Amalan']['utama'] = 'ltw_kegiatan__board';
		$page['config']['database']['Cari Board Amalan']['primary_key'] = 'id';
		$page['config']['database']['Cari Board Amalan']['join'][] = array("ltw_kegiatan__board__user", "ltw_kegiatan__board__user.id_ltw_kegiatan__board", "ltw_kegiatan__board.id");
		$page['config']['database']['Cari Board Amalan']['where'][] = array("id_user", "!=", "'ID_APPS_USER|'");
		$page['config']['database']['Cari Board Amalan']['order'][] = array("nama_board", "asc");



		return $page;
	}
	public static function board_amalan()
	{





		$page['title'] = "Be3 Ihsan Produktif";



		$card['listing_type'] = "listingmenu"; //info/listing/listmenu
		$card['default_id'] = "Mutabaah Yaumiyah";
		$card['Title Nav'] = "Mutabaah Yaumiyah";
		$card['view_default'] = "ViewHorizontal";
		$page['limit_page'] = 1;
		$card['menu'] = array(
			"Overview" => array("icon", 'card-layout', 'array-layout-dashboard'),
			"Role" => array("icon", 'crud-table', 'array-listing-role'),
			"Anggota" => array("icon", 'crud-table', 'array-listing-anggota'),
			"Board Amalan" => array("icon", 'crud-table', 'array-layout-board_amalan'),
			"Checklist Amalan" => array("icon", 'crud-table', 'array-layout-checklist_amalan'),

			"Muktabaah Yaumiyah" => array("icon", 'card-layout', 'array-layout-mutabaah'),
			"Report" => array("icon", 'card-layout', 'array-layout_report'),
			"Leader Board" => array("icon", 'crud', 'array-layout-list_amalan'),
		);
		//card-listing


		//layout//ViewHorizontal//ViewVertical//ViewListTables
		//layout -> 



		$card['array-layout-mutabaah'] = array(

			"array" => array(
				array(

					"cardType" => "template",
					"cardContent" => array(

						"template_name" => "HabitsTable.template",
						"template_form" => "beegrit",
						"row" => "col-md-12",

						"content" => array(),
					),
				),
			)




		);

		$card['array-listing-role'] = array(
			"role" => array("sebagai","<",10),
			"check_role" => ["utama" => "ltw_kegiatan__board__user", "where" => [["id_board" => "{LOAD_ID}"]]],
			"crud" => array(
				"insert_default_value" => array(
										 "id_apps" => "ID_APPS|"
										,"default_pembuat"=>2
										,"privacy"=>"private"
										,"support_id_private" => "LOAD_ID|"
									),

			),
			"array" => array(
				array("Nama Role",null,"text"),
      			array("Level Role",null,"number"),
			),
		);
		$card['array-listing-anggota'] = array(
			
			"check_role" => ["utama" => "ltw_kegiatan__board__user", "where" => [["id_board" => "{LOAD_ID}"]]],
			"crud" => array(
				"insert_default_value" => array(
										 
										"id_ltw_kegiatan__board" => "LOAD_ID|"
									),
				"select_database_costum"=>[
					"id_role"=>[
					"where_raw"=>"(privacy='public' or (privacy='private' and support_id_private={LOAD_ID}) ) and id_apps=ID_APPS|"
					]
				]

			),
			"array" => array(
				array("Role",null,"select",array("web__list_apps_role",null,"nama_role")),
				array("user",null,"select",array("apps_user",null,"nama_lengkap")),
			),
		);
		$card['array-layout-board_amalan'] = array(
			"role" => "admin",
			"get_where_role" => "sebagai",
			"check_role" => ["utama" => "ltw_kegiatan__board__user", "where" => [["id_board" => "{LOAD_ID}"]]],
			"crud" => array(
				"insert_default_value" => array("id_board" => "LOAD_ID|"),

			),
			"array" => array(
				array("Nama Amalan", "id_list", 'select', array("ltw_kegiatan__list", null, "nama_kegiatan", 'as_list')),
			),
		);
		$card['array-layout-checklist_amalan'] = array(

			"crud" => array(
				///"insert_default_value"=>array("id_board"=>"LOAD_ID|"),
				"select_database_costum" => array(
					"id_ltw_kegiatan__task" => [
						"database_overide_onselect_primary_key" => "",
						"select" => ["ltw_kegiatan__list.nama_kegiatan", "ltw_kegiatan__task.id as id_is_task"],
						"join" => [["ltw_kegiatan__task", "ltw_kegiatan__list.id", "ltw_kegiatan__task.id_list"]],
						"where" => [["id_board", "=", "{LOAD_ID}"]]
					]
				),
				"value_input_database" => array("id_board_user" => [
					"database" => [
						'utama' => "ltw_kegiatan__board__user",
						"where" => [
							["id_ltw_kegiatan__board", "=", "{LOAD_ID}"],
							['id_user', "=", "{SESSION_UTAMA}"]
						]
					], "row_value" => "primary_key"
				]),
			),
			"array" => array(
				array("Nama Amalan", "id_ltw_kegiatan__task", 'select', array("ltw_kegiatan__list", 'id_is_task', "nama_kegiatan", 'as_list')),
				array("", "id_board_user", 'hidden'),
			),





		);
		// echo '<pre>';print_r($card['array-layout-checklist_amalan']); die;
		// $page['crud']['value_input_database'][$field]['database']
		// $page['crud']['value_input_database'][$field]['row_value']


		$page['view_layout'][] = array("card", "col-md-12", $card);

		$page['enkripsi'] = array("nama_organisasi", "apps_id", "email_organisasi", "narahubung_organisasi", "nama_narahubung", "alamat_organisasi", "bidang_organisasi");
		$page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';

		$page['config']['database']['Board Amalan']['utama'] = 'ltw_kegiatan__task';
		$page['config']['database']['Board Amalan']['primary_key'] = null;
		$page['config']['database']['Board Amalan']['join'][] = array('ltw_kegiatan__board aa', 'id_board', 'aa.id');
		$page['config']['database']['Board Amalan']['where'][] = array("id_board", "=", "{LOAD_ID}");

		$page['config']['database']['Checklist Amalan']['utama'] = "ltw_kegiatan__task__detail";
		$page['config']['database']['Checklist Amalan']['primary_key'] = null;
		$page['config']['database']['Checklist Amalan']['join'][] = array('ltw_kegiatan__board__user bu', 'id_board_user', 'bu.id');
		$page['config']['database']['Checklist Amalan']['join'][] = array('ltw_kegiatan__task__detail td', 'ltw_kegiatan__task__detail.id_ltw_kegiatan__task', 'td.id');
		$page['config']['database']['Checklist Amalan']['where'][] = array("bu.id_ltw_kegiatan__board", "=", "{LOAD_ID}");
		$page['config']['database']['Checklist Amalan']['where'][] = array('bu.id_user', "=", "{SESSION_UTAMA}");



		$page['config']['database']['Role']['utama'] = 'web__list_apps_role';
		$page['config']['database']['Role']['primary_key'] = 'id';
		$page['config']['database']['Role']['where_raw'] = "(privacy='public' or (privacy='private' and support_id_private={LOAD_ID}) ) and id_apps=ID_APPS|";
		
		$page['config']['database']['Anggota']['utama'] = 'ltw_kegiatan__board__user';
		$page['config']['database']['Anggota']['primary_key'] = 'id';
		$page['config']['database']['Anggota']['where_raw'] = "id_ltw_kegiatan__board={LOAD_ID}";



		return $page;
	}

	public static function list()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__list";
		$primary_key = null;

		$array = array(
			array("Mode Kegiatan", null, "select-manual", array("amalan" => "Amalan yaumiyah", "kegiatan" => "Kegiatan")),
			array("Nama Kegiatan", null, "text"),
			array("Deskripsi", null, "textarea"),
			array("Lokasi", null, "text"),
			array("CP", null, "text"),
			array("Point Value", null, "number"),

			array("Tanggal Mulai", null, "time"),
			array("Tanggal Selesai", null, "time"),

			array("Jam Mulai", null, "time"),
			array("Jam Selesai", null, "time"),

			array("Tanggal Deadline", null, "date"),
			array("Jam Deadline", null, "date"),

			array("Priority", null, "select-manual", array("Rendah" => "Rendah", "Sedang" => "Sedang", "Tinggi" => "Tinggi")),

			// array("Progres", null, "number"),

			array("Pengingat", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),
			array("Waktu Pengingat", null, "select-manual", array("5M" => "5 Menit Sebelum", "10M" => "10 Menit Sebelum", "15M" => "15 Menit Sebelum", "30M" => "30 Menit Sebelum", "10M" => "45 Menit Sebelum", "1J" => "1J Sebelum")),

			array("Parent", null, "select", array("$database_utama", null, 'nama_kegiatan', 'parent'), null),
			array("Level Parent", null, "number"),

			array("PIC", null, "number"),

			array("Unit Target", null, "text"),
			array("Perubahan Target", null, "array-manual", array("ya" => "Ya", "tidak" => "Tidak")),

			
			

		);
		$sub_kategori[] = ["Breakdown Target(Jika Target>1)", $database_utama . "__breakdown_target", null, "table"];
		$array_sub_kategori[] = array(
			
			array("Target", null, "number"),
			array("Frekuensi", null, "number"),
			array("Per", null, "select-manual", array("Hari" => "Hari", "Tanggal", "Tanggal", "Bulan" => "Bulan")),
			array("Ideal Target", null, "select-manual", array("Ya" => "Ya", "Tidak"=> "Tidak")),
			
		);
		$sub_kategori[] = ["Pertanyaan Reminder", $database_utama . "__pertanyaan", null, "table"];
		$array_sub_kategori[] = array(
			array("Pertanyaan", null, "text"),
		);
		$select_manual = array();
		for ($i = 1; $i <= 7; $i++) {
			$select_manual[Partial::nama_hari_indo_name_east(Partial::day_number($i))] = "Hari " . Partial::nama_hari_indo_name_east(Partial::day_number($i));
		}
		$sub_kategori[] = ["Khusus Hari", $database_utama . "__khusus_hari", null, "table"];
		$array_sub_kategori[] = array(
			array("Hari", null, "select-manual", $select_manual),
		);
		$sub_kategori[] = ["Kecuali Hari", $database_utama . "__kecuali_hari", null, "table"];
		$array_sub_kategori[] = array(
			array("Hari", null, "select-manual", $select_manual),
		);
		$select_manual = array();
		for ($i = 1; $i <= 31; $i++) {
			$select_manual[$i] = "Tanggal " . $i;
		}
		$sub_kategori[] = ["Khusus Tanggal", $database_utama . "__khusus_tanggal", null, "table"];
		$array_sub_kategori[] = array(
			array("Tanggal", null, "select-manual", $select_manual),
			array("Tanggal type", null, "select-manual", array("masehi" => "Masehi", "hijriyah" => "Hijriyah")),
		);
		$sub_kategori[] = ["Kecuali Tanggal", $database_utama . "__kecuali_tanggal", null, "table"];
		$array_sub_kategori[] = array(
			array("Tanggal", null, "select-manual", $select_manual),
			array("Tanggal type", null, "select-manual", array("masehi" => "Masehi", "hijriyah" => "Hijriyah")),
		);
		$select_manual = array();
		for ($i = 1; $i <= 12; $i++) {
			$select_manual[Partial::nama_bulan("-" . $i)] = "Masehi " . Partial::nama_bulan("-" . $i);
		}
		for ($i = 1; $i <= 12; $i++) {
			$select_manual[Partial::nama_bulan_hijriah("" . $i)] = "Hijriyah " . Partial::nama_bulan_hijriah("" . $i);
		}
		$sub_kategori[] = ["Khusus Bulan", $database_utama . "__khusus_bulan", null, "table"];
		$array_sub_kategori[] = array(
			array("Bulan", null, "select-manual", $select_manual),
			array("Bulan type", null, "select-manual", array("masehi" => "Masehi", "hijriyah" => "Hijriyah")),
		);
		//    print_r($select_manual);
		$sub_kategori[] = ["Kecuali Bulan", $database_utama . "__kecuali_bulan", null, "table"];
		$array_sub_kategori[] = array(
			array("Bulan", null, "select-manual", $select_manual),
			array("Bulan type", null, "select-manual", array("masehi" => "Masehi", "hijriyah" => "Hijriyah")),
		);

		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

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

	public static function board()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__board";
		$primary_key = null;

		$array = array(

			array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),
			array("Be3 ID", null, "text"),
			array("Nama Board", null, "text"),
			array("Deskripsi", null, "text"),
			array("Brosur", null, "file", 'kegiatan/brosur'),
			array("Barcode", null, "text"),
			array("Tanggal Awal", null, "date"),
			array("Tanggal Akhir", null, "date"),


		);
		$sub_kategori[] = ["User", $database_utama . "__user", null, "table"];
		$array_sub_kategori[] = array(
			array("User", null, "select", array("apps_user", null, "nama_lengkap"), null),
			array("Role", null, "select", array("web__list_apps_role", null, "nama_role"),null),
		);


		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;
		$page['panel'] = 'ltw_kegiatan';

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function user_ltw_kegiatan()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__user";
		$primary_key = null;

		$array = array(

			array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),
			array("Be3 ID", null, "text"),
			array("Nama Board", null, "text"),
			array("Deskripsi", null, "text"),
			array("Brosur", null, "file", 'kegiatan/brosur'),
			array("Barcode", null, "text"),
			array("Tanggal Awal", null, "date"),
			array("Tanggal Akhir", null, "date"),


		);
		$sub_kategori[] = ["User", $database_utama . "__user", null, "table"];
		$array_sub_kategori[] = array(
			array("User", null, "select", array("apps_user", null, "nama_lengkap"), null),
			array("Sebagai", null, "select-manual", array("user" => "Peserta", "admin" => "Admin")),
		);


		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;
		$page['panel'] = 'ltw_kegiatan';

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}

	public static function board_task()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__task";
		$primary_key = null;
		//kalau board task ini
		/*
					Kegiatan = Rincian Rundown Acara
					Habits = Sama Penganyambung amalan dan juga
					Muktabaah = Penyambung antara amalan dan juga 
				*/
		$array = array(

			
			array("board", null, "select", array("ltw_kegiatan__board", null, 'nama_board'), null),
			array("list", null, "select", array("ltw_kegiatan__list", null, 'nama_kegiatan'), null),



			//target pribadi kalau semisal Habits dan Mutabaah



		);
		$sub_kategori[] = ["Deskripsi", $database_utama . "__deskripsi", null, "table"];
		$array_sub_kategori[] = array(

			array("Judul", null, "text"),
			array("Deksripsi", null, "textarea"),
		);
		$sub_kategori[] = ["Task User", $database_utama . "__detail", null, "table"];
		$array_sub_kategori[] = array(
			array("Board User", null, "select", array("ltw_kegiatan__board__user", null, 'sebagai'), null),
			array("Task Jobdesk", null, "text"),
		);


		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;
		$page['panel'] = 'ltw_kegiatan';

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function report()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__report";
		$primary_key = null;
		//kalau board task ini
		/*
					Kegiatan = Rincian Rundown Acara
					Habits = Sama Penganyambung amalan dan juga
					Muktabaah = Penyambung antara amalan dan juga 
				*/
		$array = array(
			array("task detail", null, "select", array("ltw_kegiatan__task__detail", null, "task_jobdesk")),
			array("Tanggal Report", null, "date"),
			array("Value Report", null, "number"),
			array("target", null, "number"),
			array("Persen Target", null, "number"),
			array("Ketercapaian Target", null, "number"),
			array("Keterlambatan Deadline", null, "date"),
			array("Keterlambatan ", null, "date"),

		);


		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;
		$page['panel'] = 'ltw_kegiatan';

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function take_list()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "ltw_kegiatan__take_list";
		$primary_key = null;
		//kalau board task ini
		/*
					Kegiatan = Rincian Rundown Acara
					Habits = Sama Penganyambung amalan dan juga
					Muktabaah = Penyambung antara amalan dan juga 
				*/
		$array = array(
			array("list", null, "select", array("ltw_kegiatan__list", null, "nama_list")),
			array("user", 'id_apps_user', "hidden"),
			

		);


		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;
		$page['panel'] = 'ltw_kegiatan';

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
}
