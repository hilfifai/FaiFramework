<?php


class Store
{


	public static function list_workspace($page)
	{
		$_SESSION['to_list_workspace_id_apps'] = Partial::get_id_apps($page);
		$page = Workspace::workspace_apps($page);
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function Dashboard_workspace()
	{
		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template";
		$website['content'][$i]['template_name'] = "soft-ui";
		$website['content'][$i]['row'] = "col-md-3";
		$website['content'][$i]['template_file'] = "CardDashboard.template";



		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'CARD-TITLE',
				"refer" => "text",
				"text" => "Jumlah Toko",
			),
			array(
				"tag" => 'CARD-NUMBER-TEXT',
				"refer" => "text",
				"text" => "123",
			),
		);
		$i++;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template";
		$website['content'][$i]['template_name'] = "soft-ui";
		$website['content'][$i]['row'] = "col-md-3";
		$website['content'][$i]['template_file'] = "CardDashboard.template";


		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'CARD-TITLE',
				"refer" => "text",
				"text" => "Jumlah Produk",
			),
			array(
				"tag" => 'CARD-NUMBER-TEXT',
				"refer" => "text",
				"text" => "122",
			),
		);
		$page['view_layout'][] = array("website", "col-md-12", $website);

		$page['get']['sidebarIn'] = true;;
		$page['get']['sidebarIn'] = true;;
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function menu_basic()
	{
		$menu = array(
			array(
				"group",
				"Store Produk & Harga",
				array(
					array("menu", "Bundle Harga", array("Store", "bundle_harga", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Toko", array("Store", "Toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Produk", array("Store", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Produk User", array("Store", "produk__user", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Paket", array("Store", "paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Ulasan", array("Store", "ulasan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				),
			),

			array(
				"group",
				"Mitra",
				array(
					array("menu", "Tipe Mitra Store", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				),
			),
			//array("menu", "Data Mitra", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// 			array("group", "Alamat"),
			// 				array("menu", "Simpan Alamat", array("Store", "simpan_alamat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// 			array("group", "Pre Order"),
			// 			array("menu", "Pre Order Sesion", array("Store", "preorder", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// 			array("group", "Gudang Toko"),
			//             array("menu", "Gudang", array("Store", "gudang_toko", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array(
				"group",
				"Promosi",
				array(
					array("menu", "Promo Toko", array("Store", "promo__toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Promo Costumer", array("Store", "promo__costumer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Promo Ongkir", array("Store", "promo__ongkir", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Voucher", array("Store", "promo__vourcer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Iklan", array("Store", "iklan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				),
			),


		);

		return $menu;
	}
	public static function produk()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(

			array("Toko", "toko", "select", array('store__toko', null, 'nama_toko'), null),
			array("Tipe Barang", "tipe_barang_form", "select-manual", array("Utama" => "Utama", "Reseller" => "Reseller")),
			// array("Jenis Barang", "jenis_barang", "select-manual", array("Barang" => "Barang", "Paket" => "Paket")),

			// array("Toko Reseller", "toko_reseller", "select", array("store__toko", null, 'nama_toko', 'reseller'), null), //jika reseler
			// array("Produk Reseller", "store_produk_reseller", "select-ajax"), //jika reseler

			array("Asset Produk", "asset_id", "select", array('inventaris__asset__list', null, 'nama_barang'), null),
			array("Costum Nama produk", "costum_produk", "checkbox-manual", array("1" => "Apakah ingin merubah nama?")),

			array("Nama Produk(costum)", "nama_costum_produk", "text"),
			array("Varian", "multiple_penjualan_varian", "select-manual", array("1" => "Ya", "2" => "Tidak")),
			// array("Total Penjualan", null,"number"),
			// array("Total Rating", null,"number"),
		);
		//select target


		$sub_kategori[] = ["Varian", $database_utama . "__varian", null, "table"];
		$array_sub_kategori[] = array(

			array("Barang & Varian", "barang_varian", "select", array("inventaris__asset__list__varian", null, "nama_varian", 'a'), null),
			array(
				"Detail Harga",
				"detail_harga",
				"modalform-subkategori-add",
				array(
					"type" => "many",
					"database" => $database_utama . "__harga",
					"array" => array(
						array("HPP Distributor", "hpp", "number"),
						array("HPJ Distributor", "hpj", "number"),

						// array("Harga Jual Distributor", "harga_jual_distributor", "number"),
						// array("Margin Distributor(minus)", "margin_distibutor", "number"),
						// array("Harga Distributor/Harga Beli", "harga_distributor", "number"),

						// array("Type Margin Harga Jual", "type_harga_jual", "select-manual", array("%" => "%", "Rp" => "Rp")),
						// array("Margin Harga Jual", "margin_harga_jual", "number"),
						array("Bundle Harga", null, "select", array('store__bundle_harga', null, 'nama_bundle_harga'), null),
						array("Donasi Baitul Mal", "donasi_baitul_mal", "number"),
						array("Harga Pokok Jual", "harga_jual", "number"),
					)
				)
			),
		);

		$sub_kategori[] = ["Harga", $database_utama . "__harga", null, "table"];
		$array_sub_kategori[] = array(

			array("HPP Distributor", "hpp", "number"),
			array("HPJ Distributor", "hpj", "number"),
			array("Bundle Harga", null, "select", array('store__bundle_harga', null, 'nama_bundle_harga'), null),
			array("Donasi Baitul Mal", "donasi_baitul_mal", "number"),

			// array("Harga Jual Distributor", "harga_jual_distributor", "number"),
			// array("Type Margin Harga Distributor", "type_harga_distributor", "select-manual", array("%" => "%", "Rp" => "Rp")),
			// array("Margin Distributor(minus)", "margin_distibutor", "number"),
			// array("Harga Distributor/Harga Beli", "harga_distributor", "number"),

			// array("Type Margin Harga Jual", "type_harga_jual", "select-manual", array("%" => "%", "Rp" => "Rp")),
			// array("Margin Harga Jual", "margin_harga_jual", "number"),

			// array("Harga Pokok Jual", "harga_pokok_jual", "number-r"),
		);
		$page['crud']['function_js'][] =  array(
			"type" => "input-changer",
			"name" => "change_subtotal",
			"parameter" => "e,id_row",
			"parameter_input" => "this,<NUMBERING></NUMBERING>",
			"row" => array(
				"harga_jual_distributor",
				"type_harga_distributor",
				'margin_distibutor',
				'harga_distributor',
				"type_harga_jual",
				"margin_harga_jual",
				"donasi_baitul_mal",
				"harga_pokok_jual"
			),
			"id_row" => true,
			"input" => array("onkeyup"),
			"get" => array(
				"harga_jual_distributor" => "id_row",
				"type_harga_distributor" => "id_row",
				"margin_distibutor" => "id_row",
				"harga_distributor" => "id_row",
				"type_harga_jual" => "id_row",
				"margin_harga_jual" => "id_row",

				"donasi_baitul_mal" => "id_row",
				"harga_pokok_jual" => "id_row"
			),
			"execute" => array(
				array(
					"type" => "math_if",
					"if" => array(
						"type_harga_distributor =='Rp'" => "harga_jual_distributor-margin_distibutor",
						"type_harga_distributor =='%'" => "harga_jual_distributor-(margin_distibutor/100*harga_jual_distributor)"
					),
					"var" => "total_harga_distributor"
				),
				array(
					"type" => "math_if",
					"if" => array(
						"type_harga_jual =='Rp'" => "total_harga_distributor-margin_harga_jual",
						"type_harga_jual =='%'" => "total_harga_distributor-(margin_harga_jual/100*total_harga_distributor)"
					),
					"var" => "total_harga_jual"
				),

				array(
					"type" => "math",
					"math" => ("(total_harga-total_diskon)"),
					"var" => "result"
				),
			),
			"create_elemen" => array(
				"<input type='hidden' class='total_qty_harga' >",
				"<input type='hidden' class='total_diskon'>"
			),
			"result" => array(
				array(
					"type" => "to_val_row",
					"elemen" => "total_harga",
					"input" => "id",
					"var" => "total_harga"
				),
				array(
					"type" => "to_val_row",
					"elemen" => "total_diskon",
					"input" => "id",
					"var" => "total_diskon"
				),
				array(
					"type" => "to_val_row",
					"elemen" => "jumlah",
					"input" => "id",
					"var" => "result"
				),
				array(
					"type" => "call_function",
					"name_function" => "sub_total"
				),
				array(
					"type" => "call_function",
					"name_function" => "diskon_item"
				)
			)

		);




		$page['crud']['hidden_show']['multiple_penjualan_varian']['default_sub_kategori'][$database_utama . "__harga"] = "hide";
		$page['crud']['hidden_show']['multiple_penjualan_varian']['default_sub_kategori'][$database_utama . "__varian"] = "hide";
		$page['crud']['hidden_show']['multiple_penjualan_varian']['value_if_sub_kategori']["1"][$database_utama . "__harga"] = "show";
		$page['crud']['hidden_show']['multiple_penjualan_varian']['value_if_sub_kategori']["1"][$database_utama . "__varian"] = "show";
		$page['crud']['hidden_show']['multiple_penjualan_varian']['value_if_sub_kategori']["2"][$database_utama . "__harga"] = "hide";
		$page['crud']['hidden_show']['multiple_penjualan_varian']['value_if_sub_kategori']["2"][$database_utama . "__varian"] = "hide";

		$search = array();
		$page['crud']['no_row_sub_kategori'][$database_utama . "__varian"] = true;
		$page['crud']['no_action'][$database_utama . "__varian"] = true;

		$page['crud']['field_view_sub_kategori']['asset_id']['type'] = 'get'; //get or add
		$page['crud']['field_view_sub_kategori']['asset_id']['target'] = $database_utama . "_harga";
		$page['crud']['field_view_sub_kategori']['asset_id']['target_no'] = 0;
		$page['crud']['field_view_sub_kategori']['asset_id']['database']['utama'] = "inventaris__asset__list__varian";
		$page['crud']['field_view_sub_kategori']['asset_id']['database']['primary_key'] = null;
		$page['crud']['field_view_sub_kategori']['asset_id']['database']['selectRaw'] = "*";
		// $page['crud']['field_view_sub_kategori']['asset_id']['database']['order'] = array('treelevel desc');
		// $page['crud']['field_view_sub_kategori']['asset_id']['database']['join'][] = array("inventaris__asset__list__varian_level", "inventaris__asset__list__varian_level.level", "inventaris__asset__list__varian.tree_level");
		$page['crud']['field_view_sub_kategori']['asset_id']['request_where'] =
			"id_inventaris__asset__list";

		$page['crud']['field_view_sub_kategori']['asset_id']['field'][] = array(
			-1,
			"barang_varian",
			array("Barang & Varian", "nama_varian", "text"),
			"primary_key"
		);
		// $page['crud']['field_view_sub_kategori']['asset_id']['field'][] = array(
		// 	-1, "varian_master",
		// 	array("Varian Master", "varian_master", "select-manual", array(
		// 		"Ya" => "Ya",
		// 		"Tidak" => 'Tidak',
		// 	)),
		// );
		// $page['crud']['field_view_sub_kategori']['asset_id']['field'][] = array(
		// 	-1, "level",
		// 	array("Level", "nama_level", "text"),
		// );
		$page['crud']['field_view_sub_kategori']['asset_id']['field'][] = array(
			0,
			"Detail Harga",
			array(
				"Detail Harga",
				"detail_harga",
				"modalform-subkategori-add",
				array(
					"type" => "many",

					"database" => $database_utama . "__harga",
					"array" => array(
						array("Minimal Pembelian", "minpembelian", "number"),
						array("Maksimal Pembelian", "maxpembelian", "number"),

						// array("Harga Jual Distributor", "harga_jual_distributor", "number"),
						// array("Margin Distributor", "margin_distibutor", "number"),
						// array("Harga Distributor/Harga Beli", "harga_distributor", "number"),

						// array("Type Margin Harga Jual", "type_harga_jual", "select-manual", array("%" => "%", "Rp" => "Rp")),
						// array("Margin Harga Jual", "margin_harga_jual", "number"),
						array("Harga Pokok Jual", "harga_jual", "number"),
						array("Donasi Baitul Mal", "donasi_baitul_mal", "number"),
						array("Bundle Harga", null, "select", array('store__bundle_harga', null, 'nama_bundle_harga'), null),

					)
				)
			),
		);

		$search = array();
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}

	public static function produk__user()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Produk", "produk", "select", array('store__produk', null, 'nama_costum_produk'), null),
			array("User", "apps_user", "select", array('apps_user', null, 'nama_lengkap'), null),

			array(null, "harga_jual_akhir_min_store", "number"),
			array(null, "harga_jual_awal_store", "number"),
			array(null, "harga_jual_akhir_max_store", "number"),
			array(null, "presentase_diskon", "number"),
			array(null, "harga_diskon", "number"),


		);

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function toko($page)
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			// array("Panel", null, "select", array("panel", null, "nama_panel")),
			array("Nama Toko", "nama_toko", "text"),
			array("Kode Toko", "kode_toko", "text"),
			array("Deskripsi", "deskripsi", "text"),
			array("Logo Toko", "logo_toko", "file", 'store_toko/logo/'),
			array("Banner Toko", "banner_toko", "file", 'store_toko/banner/'),
			array("Inventory Bangunan Toko", "inventory_bangunan_toko", "select", array('inventaris__asset__tanah__bangunan', null, 'nama_unit_bangunan'), null),
			array("", "nama_pengirim", "text"),
			array("", "nomor_telepon_pengirim", "text"),
			array("Default Alamat pengiriman", "default_pengiriman", "select", array('inventaris__asset__tanah__bangunan', null, 'nama_unit_bangunan', 'pengiriman'), null),
			array("FB", "platform_toko_fb", "text"),
			array("IG", "platform_toko_ig", "text"),
			array("WA", "platform_toko_wa", "text"),
			array("SHOPEE", "platform_toko_shopee", "text"),
			array("TIKTOK", "platform_toko_tiktok", "text"),
			array("Jenis Toko", "jenis_toko", "text"),
			// array("Link Spreadsheet Pendaftaran Mitra", "link_mitra", "text"),
			// array("Link Spreadsheet Pendaftaran Penjualan", "link_penjualan", "text"),
			// array("Kas Store"),//ini autamatis select
			// array("Kas Penyisihan Distributor"),
			// array("Alamat Toko", "alamat_toko", "text"),
			// array("Prioritas", "prioritas", "text-disable"),
		);
		// $sub_kategori[] = ["Bank", "keuangan__akun", null, "form"];
		// $array_sub_kategori[] = array(
		// 	array("Panel", "panel", "select", array("panel", null, "nama_panel")),
		// 	array("Kategori", "kategori", "select", array("keuangan__kategori", null, "nama_kategori")),

		// 	array("Nama Akun", "nama_akun", "text-req"),
		// 	array("Bank", "bank", "text-req"),
		// 	array("No Rekening", "norek", "text-req"),
		// 	array("Atas Nama", "atas_nama", "text-req"),
		// 	array("Ketarangan", "keterangan_akun", "text"),

		// );
		// $sub_kategori[] = ["Gudang toko", $database_utama . "__gudang", null, "form"];
		// $array_sub_kategori[] = array(
		// 	array("Gudang", "gudang", "select", array("inventaris__asset__tanah__gudang", null, "nama_gudang")),


		// );
		$page['crud']['select_database_costum']['default_pengiriman']['where'][] = array('inventaris__asset__tanah__bangunan.id_toko::numeric', '=', "WORKSPACE_SINGLE_TOKO|");
		// $page['crud']['select_database_costum']['id_inventory_bangunan_toko']['where'][] = array('inventaris__asset__tanah__bangunan.id_panel','=','ID_PANEL|');
		$search = array();
		// $page['crud']['sub_kategori'] = $sub_kategori;
		// $page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function toko__gudang($page)
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__ . "";
		$primary_key = null;

		$array = array(
			array("Gudang", "gudang", "select", array("inventaris__asset__tanah__gudang", null, "nama_gudang")),
			array("Urutan", "urutan", "text"),
		);
		// $sub_kategori[] = ["Bank", "keuangan__akun", null, "form"];
		// $array_sub_kategori[] = array(
		// 	array("Panel", "panel", "select", array("panel", null, "nama_panel")),
		// 	array("Kategori", "kategori", "select", array("keuangan__kategori", null, "nama_kategori")),

		// 	array("Nama Akun", "nama_akun", "text-req"),
		// 	array("Bank", "bank", "text-req"),
		// 	array("No Rekening", "norek", "text-req"),
		// 	array("Atas Nama", "atas_nama", "text-req"),
		// 	array("Ketarangan", "keterangan_akun", "text"),

		// );
		// $sub_kategori[] = ["Gudang toko", $database_utama . "__gudang", null, "form"];
		// $array_sub_kategori[] = array(
		// 	

		// );
		// $page['crud']['select_database_costum']['id_inventory_bangunan_toko']['where'][] = array('inventaris__asset__tanah__bangunan.id_panel','=','ID_PANEL|');
		$search = array();
		// $page['crud']['sub_kategori'] = $sub_kategori;
		// $page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['crud']['insert_default_value']['id_store__toko']  = "WORKSPACE_SINGLE_TOKO|";
		$page['crud']['insert_default_value']['id_panel'] = "WORKSPACE_SINGLE_PANEL|";

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['database']['where'][]     = [$database_utama . ".id_store__toko", "=", "WORKSPACE_SINGLE_TOKO|"];
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function mitra()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Toko", "toko", "select", array('store__toko', null, 'nama_toko'), null),
			array("Kode Mitra", null, "text-kode", ["array" => "one", "tipe" => "count", "prefix" => "Mitra.", "suffix" => "", "sprintf_number" => "3", ""]),
			array("Nama Mitra", null, "text"),
			array("Deskripsi", "deskripsi", "text"),
			array("Syarat & Ketentuan", "syarat_ketentutan", "textarea"),


		);
		$sub_kategori[] = ["presentase", $database_utama . "__presetase", null, "form"];
		$array_sub_kategori[] = array(
			array("Minimal Pembelian", null, "number"),
			array("Maksimal Pembelian", null, "number"),
			array("Margin Mitra", "margin_mitra", "number"),
			array("Tipe Margin Mitra", "tipe_margin_mitra", "select-manual", array("%" => "%", "Rp" => "Rp")),
		);
		$sub_kategori[] = ["Biaya Tagihan", $database_utama . "__tagihan_biaya", null, "form"];
		$array_sub_kategori[] = array(
			array("Jenis", null, "select-manual", array("Adminitrasi" => "Adminitrasi", "Deposit" => "Deposit", "Investasi" => "Investasi", "Minimal Pembelian Barang" => "Minimal Pembelian Barang", "Lainnya" => "Lainnya")),
			array("Nama pembayaran", null, "text"),
			array("Nominal Bayar", null, "number"),

		);
		$search = array();
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function voucher()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Toko", "toko", "select", array('store__toko', null, 'nama_toko'), null),
			array("Kode Voucher", null, "text"),
			array("Nama Voucher", null, "text"),
			array("Berlaku Dari", null, "datetime-local"),
			array("Berlaku Sampai", null, "datetime-local"),

			array("Voucher", null, "select-manual", array("Ongkir" => "Ongkir", "Diskon Produk" => "Diskon Produk")),
			array("Tipe Margin", null, "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Margin Promo", null, "number"),

			array("Maksimal Margin", null, "number"),

			array("Total Penggunaan Voucher", null, "number-listeditview"),
			array("Sisa Penggunaan Voucher", null, "numbe-listeditview"),
			array("Maksimal Penggunaan Voucher", null, "number"),
			array("Syarat Minimal Pembelian", null, "number"),
			array("Syarat Maksimal Pembelian", null, "number"),
			array("Default Tampil", null, "select-manual", ["2" => "Sembunyikan, voucher hanya bisa digunakan ketika user mengetahui kode", "1" => "Tampilkan, Voucher bisa digunakan siapa saja"]),

		);

		$search = array();
		// $page['crud']['sub_kategori'] = $sub_kategori;
		// $page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function promo__toko()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Toko", "toko", "select", array('store__toko', null, 'nama_toko'), null),
			array("Kode Promo", null, "text"),
			array("Nama Promo", null, "text"),
			array("Berlaku Dari", null, "datetime-local"),
			array("Berlaku Sampai", null, "datetime-local"),

			array("Tipe Margin Promo Toko", null, "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Margin Promo Toko", null, "number"),

			array("Maksimal Margin", null, "number"),

			array("Syarat Minimal Pembelian", null, "number"),
			array("Syarat Maksimal Pembelian", null, "number"),
			// array("Syarat Ikuti", "syarat_ikuti", "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),
			array("Semua Produk", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),

		);
		$sub_kategori[] = ["Berdasarkan Produk", $database_utama . "__produk", null, "table"];
		$array_sub_kategori[] = array(
			array("Produk", null, "select", array("store__produk", null, "nama_produk")),
		);
		$sub_kategori[] = ["Berdasarkan Kategori", $database_utama . "__kategori", null, "table"];
		$array_sub_kategori[] = array(
			array("Kategori", null, "select", array("webmaster__inventaris__master__kategori", null, "nama_kategori")),
		);
		$sub_kategori[] = ["Berdasarkan Brand", $database_utama . "__brand", null, "table"];
		$array_sub_kategori[] = array(
			array("Brand", null, "select", array("inventaris__asset__master__brand", null, "nama_brand")),
		);
		$search = array();
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$select_costum['join'][] = ["inventaris__asset__list ial", "store__produk.id_asset", "ial.id", "left"];
		$select_costum['join'][] = ["inventaris__asset__list master", "ial.id_master", "master.id", "left"];
		$select_costum['select'][] = "store__produk.id,ial.asal_barang_dari ,
case when ial.asal_barang_dari  ='Master' then master.nama_barang else ial.nama_barang end as nama_produk";
		$select_costum['where'][] = ["ial.active", "=", "1"];
		$page['crud']['select_database_costum']['produk'] = $select_costum;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function promo__costumer()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Toko", "toko", "select", array('store__toko', null, 'nama_toko'), null),
			array("Kode Promo", null, "text"),
			array("Nama Promo", null, "text"),
			array("Berlaku Dari", null, "datetime-local"),
			array("Berlaku Sampai", null, "datetime-local"),

			array("Tipe Margin Promo Costumer", null, "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Margin Promo Costumer", null, "number"),

			array("Maksimal Margin", null, "number"),

			array("Syarat Minimal Pembelian", null, "number"),
			array("Syarat Maksimal Pembelian", null, "number"),
			// array("Syarat Ikuti", "syarat_ikuti", "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),
			array("Semua Produk", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),
			array("Semua User", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),

		);
		$sub_kategori[] = ["Berdasarkan Produk", $database_utama . "__produk", null, "form"];
		$array_sub_kategori[] = array(
			array("Apps User", null, "select", array('apps_user', null, 'nama_lengkap'), null),

		);
		$sub_kategori[] = ["Berdasarkan Produk", $database_utama . "__produk", null, "form"];
		$array_sub_kategori[] = array(
			array("Produk", null, "select", array("store__produk", null, "nama_produk")),
		);
		$sub_kategori[] = ["Berdasarkan Kategori", $database_utama . "__kategori", null, "form"];
		$array_sub_kategori[] = array(
			array("Kategori", null, "select", array("webmaster__inventaris__master__kategori", null, "nama_kategori")),
		);
		$search = array();
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function promo__ongkir()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Kode Promo", null, "text"),
			array("Nama Promo", null, "text"),
			array("Berlaku Dari", null, "datetime-local"),
			array("Berlaku Sampai", null, "datetime-local"),


			array("Maksimal harga promo", null, "number"),


			array("Syarat Minimal Pembelian", null, "number"),
			array("Syarat Maksimal Pembelian", null, "number"),
			// array("Syarat Ikuti", "syarat_ikuti", "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),

		);


		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function bundle_harga()
	{
		//get 

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Kode Bundle Harga", "kode_bundle_harga", "text"),
			array("Nama Bundle Harga", "nama_bundle_harga", "text"),
			array("Deskripsi", "deskripsi", "text"),
			array("Keuntungan Distributor Dari", null, "select-manual", array("HPP" => "HPP Setiap Barang", "HPJ" => "HPJ Setiap Barang", "Harga Distributor" => "Harga Distributor")),
			array("Biaya Payment Method Dibayarkan Oleh?", "biaya_payment_dari", "select-manual", array("Penjual" => "Penjual", "Pembeli" => "Pembeli")),

			array("Limit Diskon", "limit_diskon", "text"),
			array("Limit Diskon diambil dari", "limit_diskon_dari", "select-manual", array("HPP" => "HPP Setiap Barang", "HPJ" => "HPJ Setiap Barang", "Harga Distributor" => "Harga Distributor")),

		);
		$sub_kategori[] = ["detail", $database_utama . "__detail", null, "form"];
		$array_sub_kategori[] = array(

			array("Minimal Total HPJ Distributor", null, "number"),
			array("Maksimal Total HPJ Distributor", null, "number"),

			//margin_distributor untuk kayak ethica, hpjnya 300 - 20%
			array("Margin Distributor", "margin_distibutor", "number"),
			array("Tipe Margin Harga Distributor", "tipe_margin_harga_distributor", "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Tipe Selisih Harga Distributor", "tipe_selisih_harga_distributor", "select-manual", array("-" => "Kurang", "+" => "Tambah")),


			array("Margin Harga Jual", "margin_harga_jual", "number"),
			array("Tipe Margin Harga Jual", "tipe_harga_jual", "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Tipe Selisih Harga Jual", "tipe_selisih_harga_jual", "select-manual", array("-" => "Kurang", "+" => "Tambah")),


			array("Margin Platform Dari", "margin_platform_from", "select-manual", array("Harga Jual" => "Harga Jual", "Harga Distributor" => "Harga Distributor")),
			array("Margin Platform  Ecommerce", "margin_platform", "number"),
			array("Tipe Margin Platform Ecommerce", "tipe_platform", "select-manual", array("%" => "%", "Rp" => "Rp")),
			array("Tipe Selisih Platform  Ecommerce", "tipe_selisih_platform", "select-manual", array("-" => "Kurang", "+" => "Tambah")),

			array("Margin Donasi Baitul Mal", "donasi_baitul_mal", "number"),
			array("Tipe Margin Donasi ", "tipe_donasi", "select-manual", array("%" => "%", "Rp" => "Rp"))

		);
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}

	public static function simpan_alamat()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "store__user__" . __FUNCTION__;
		$primary_key = null;

		$array = array(
			array("Apps User", null, "select", array("apps_user", "id_apps_user", "nama_lengkap")),
			array("Panel", "panel", "select", array("panel", null, "nama_panel")),
			array("Nama Sesi", null, "text"),
			array("Nama Penerima", null, "text"),
			array("Alamat", null, "textarea"),
			array("Kabupaten", null, "numeric"),
			array("Provinsi", null, "numeric"),
			array("Kota", null, "numeric"),
			array("Kecamatan", null, "numeric"),
			array("Kode Pos", null, "numeric"),
		);

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['get']['sidebarIn'] = true;;
		return $page;
	}
}
