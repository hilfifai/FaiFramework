<?php

use App\Helper_function;

require_once('Inventaris_aset.php');
class Ecommerce
{
	public static function list($page)
	{

		$page['title'] = "Ecommerce";
		$page['subtitle'] = "";



		$card['listing_type'] = "listingmenu"; //info/listing/listmenu
		$card['default_id'] = "Mall";
		$card['view_default'] = "ViewVertical";
		$page['limit_page'] = 8;
		$card['row'] = "col-xl-3 col-md-4 mb-xl-0 mb-4";
		$card['menu'] = array(
			// 			"Dashboard" => array("icon", 'card-layout', 'array-layout-dashboard'),
			"Mall" => array("icon", 'card-listing', 'array-produk'),
			// 			"Food" => array("icon", 'card-listing', 'array-food'),
			// 			"Service" => array("icon", 'card-listing', 'array-service'),
			// 			"Properti" => array("icon", 'card-listing', 'array-properti'),
			// 			"Speaker" => array("icon", 'card-listing', 'array-speaker'),
			// 			"Offer Project" => array("icon", 'card-listing', 'array-project'),
		);



		//card-listing


		//layout//ViewHorizontal//ViewVertical//ViewListTables
		//layout -> 
		if ($page['load']['workspace']['id_single_toko'] ?? '')
			$where_kategori = ["webmaster__inventaris__master__kategori.id", ' in ', '(select id_kategori from inventaris__asset__list join store__produk on id_asset = inventaris__asset__list.id where 1=1 WORKSPACE_SINGLE_TOKO_WHERE| )'];
		else
			$where_kategori = ["webmaster__inventaris__master__kategori.id", ' in ', '(select id_kategori from inventaris__asset__list join store__produk on id_asset = inventaris__asset__list.id where 1=1 )'];
		$card['array-produk'] =  array(

			// "source" => "template_file_content",
			// 'ViewVertical' => array(
			// 	"template_name" => "beegrit",
			// 	"template_file" => "card/layout.template"
			// ),
			"source" => "file_bundles_database",
			"template_code" => "BE3-ECOMMERCE-LIST-PRODUCT",
			'ViewVertical' => array(
				"source" => "file_bundles_database",
				"template_code" => "BE3-ECOMMERCE-LIST-PRODUCT-VERTICAL",
			),
			'ViewHorizontal' => array(
				"source" => "file_bundles_database",
				"template_code" => "BE3-ECOMMERCE-LIST-PRODUCT-HORIZONTAL",
			),
			"sort_by" => array(

				"Harga Rendah ke Tinggi" => ("harga_jual_awal_min_store asc"),
				"Harga Tinggi ke Rendah" => ("harga_jual_awal_max_store desc"),
				"Presentase Diskon Tertinggi" => ("presentase_diskon desc"),
				"Presentase Diskon Terendah" => ("presentase_diskon asc"),
				"Harga Diskon Tertinggi" => ("harga_diskon desc"),
				"Terlaris" => ("total_jual desc"),
				"Terbaru" => ("create_date asc"),
				"Terlama" => ("create_date desc"),
			),

			"search_field" => array(
				"nama_barang",
				"outsourcing__brand.nama_toko"
			),
			"filter" => array(
				//Text  // typeform //row //row_where_filter

				array("Brand", "id_brand", "checkbox3-database", array("id", "nama_brand"), array("utama" => "outsourcing__brand", "primary_key" => "id"), "id_brand", 'field_database' => "inventaris__asset__list.id_brand"),
				// case 
				// 	        when inventaris__asset__list.asal_barang_dari ='Master' and inventaris__asset__list.id_brand is null then inventaris__asset__list_master.id_brand 
				// 	        else inventaris__asset__list.id_brand
				// 	    end 
				array("Kategori", "id_kategori", "checkbox3-database", array("id", "nama_kategori"), array("utama" => "webmaster__inventaris__master__kategori", "primary_key" => "id", "where" =>
				[$where_kategori]), "id_brand", 'field_database' => "inventaris__asset__list.id_kategori"),
				// array("Kota Toko",   "id_kota_toko", "select", array("webmaster__wilayah__kabupaten", "kota_id", "kota_name"), "id_kota_toko"),
				// array("Kota Toko2",   null, "select", array("webmaster__wilayah__kabupaten", "kota_id", "kota_name"), "id_kota"),
				// array("Harga",   null, "number_dari_sampai", "harga_jual", "harga_jual_min_store"),
				// array("Harga2",   null, "number_dari_sampai", "harga_jual", "harga_jual_min_store"),
				// array("Kategori",   null, "checkbox-tree-database", array("id","nama_kategori"), 
				// 			array("tree_database_utama"=>"webmaster__inventaris__master__kategori",
				// 					"tree_primary_key"=> "id",
				// 					"tree_parent_id"=> "id_parent",
				// 					"tree_form_parent"=>0,)),
				// array("Harga",   "harga", "price_dari_sampai", "harga_jual", "harga_jual_min_store", 'field_database' => "harga_jual_min_store"),
			),
			"crud" => [
				"form_type_spesific" => ["id_kota_toko" => "2", "kota_toko" => "2", "id_brand" => 2]
			],
			"array" => array(
				array(
					"IMG-SRC",
					"get_img",
					null,
					"datafile-row",
					array("inventaris__asset__list", 'id_asset', "nama_barang", 'id', 'foto_aset'),
					[

						"style" => "border-radius:25px 25px 0 0;"
					]
				),
				array("CARD-LINK", "link", array("Ecommerce", "detail", "view_layout", "row:id_store_produk!card|"), 'just_link'),
				array("CARD-TITLE", "title", "nama_barang", "database", true, array("class" => "product-title", "costum_type" => "info")),
				array("CARD-SUBTITLE", "subtitle", array("App", "EcommerceApp", "get_data_Harga", array("min_max", 'row:id_store_produk!card|'), "Min Max Harga Jual Akhir"), "function", true),
				array("KOTA", "kota", "database"),
			),
		);
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

		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template";
		$website['content'][$i]['template_name'] = "codepen";
		$website['content'][$i]['template_file'] = "swipper/swipper.template";
		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'TITLE',
				"refer" => "text",
				"value" => "Pilih Perencanaan Paket yang tepat",
			),

			array(
				"tag" => 'SUBTITLE',
				"refer" => "text",
				"value" => "Atau hubungi tim konsultasi kami."
			),

		);
		// $page['view_layout'][] = array("website", "col-md-12", $website);


		//$page['enkripsi'] = array("nama_organisasi", "apps_id", "email_organisasi", "narahubung_organisasi", "nama_narahubung", "alamat_organisasi", "bidang_organisasi");
		$page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';


		$page['view_layout'][] = array("card", "col-md-12", $card);
		// $page['config']['database']['Mall']['select'][] = "*,case when LENGTH ((nama_barang))>=75 then concat(substr(nama_barang,0,75),'....') else nama_barang end as nama_barang";
		// $page['config']['database']['Mall']['select'][] = "store__produk.id,id_asset, nama_barang,concat(type,' ',kota_name) as kota";
		// $page['config']['database']['Mall']['select'][] = "nama_barang";
		$page['config']['database']['Mall']['select'][] = "store__produk.id as id_store_produk";
		$page['config']['database']['Mall']['select'][] = "store__produk.id_asset";
		$page['config']['database']['Mall']['select'][] = "concat(webmaster__wilayah__kabupaten.type,' ',kota_name) as kota";
		// $page['config']['database']['Mall']['select'][] = "id_asset";
		// $page['config']['database']['Mall']['select'][] = "id_brand";
		$page['config']['database']['Mall']['select'][] = "store__toko.id_kota";
		$page['config']['database']['Mall']['utama'] = "inventaris__asset__list";
		// $page['config']['database']['Mall']['join'][] = ["panel", "inventaris__asset__list.id_panel", "panel.id", 'left'];
		// $page['config']['database']['Mall']['join'][] = ["webmaster__inventaris__master__kategori", "id_kategori", "webmaster__inventaris__master__kategori.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["store__produk", "id_asset", "inventaris__asset__list.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["outsourcing__brand", "inventaris__asset__list.id_brand", "outsourcing__brand.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["store__toko", " store__produk.id_toko", "store__toko.id", 'left'];
		// $page['config']['database']['Mall']['join'][] = array("drive__file", "drive__file.id::text", "inventaris__asset__list.foto_aset", "left");
		$page['config']['database']['Mall']['join'][] = ["webmaster__wilayah__kabupaten", "store__toko.id_kota", "webmaster__wilayah__kabupaten.kota_id", 'left'];
		if (isset($_SESSION['id_apps_user']))
			$page['config']['database']['Mall']['join'][] = ["store__produk__user", " store__produk__user.id_produk", "store__produk.id  and store__produk__user.id_apps_user=" . $_SESSION['id_apps_user'], 'left'];
		// $page['config']['database']['Mall']['where'][] = ["store__produk.status_publish", " =", "'1'"];
		$page['config']['database']['Mall']['where'][] = ["store__produk.id_toko", " is ", " not null"];
		$page['config']['database']['Mall']['where'][] = ["inventaris__asset__list.active", " = ", " 1"];
		// $page['config']['database']['Mall']['where'][] = ["inventaris__asset__list.jual_aset_barang", "=", "'Ya'"];
		// $page['config']['database']['Mall']['order_by_filter'] = "random() asc";
		$page['config']['database']['Mall']['np'] = "random() asc";


		// select *,case when LENGTH ((nama_barang))>=75 then concat(substr(nama_barang,0,75),'....') else nama_barang end as nama_barang from (select store__produk.id,id_asset, nama_barang,concat(type,' ',kota_name) as kota,id_brand,id_kota from store__produk join inventaris__asset__list b on id_asset=b.id left join outsourcing__brand on b.id_brand = outsourcing__brand.id left join store__toko on store__produk.id_toko = store__toko.id left join webmaster__wilayah__kabupaten on id_kota = kota_id where ( store__produk.status_publish='1') and store__produk.id_toko is not null order by id desc ) as a |WHERE| GROUP BY a.id,id_asset,nama_barang,a.kota,a.id_brand,id_kota order by random()
		// |WHERE|
		// GROUP BY a.id,id_asset,nama_barang,a.kota,a.id_brand,id_kota
		// order by 
		// ";
		$page['crud']['select_database_costum']["0"]['where'][] = array("jual_produk", "=", 1);



		return $page;
	}

	public static function queryallproduklist()
	{
		/*
		$page['config']['database']['Mall']['query'] = "
		select *,case when LENGTH ((nama_barang))>=75 then concat(substr(nama_barang,0,75),'....') else nama_barang end as nama_barang 
		from
		(
			(select store__produk.id,id_asset, nama_barang,concat(type,' ',kota_name) as kota,id_brand,id_kota
					from store__produk 
					
						join inventaris__asset__list b on id_asset=b.id
						left join outsourcing__brand on b.id_brand = outsourcing__brand.id
						left join store__toko on store__produk.id_toko = store__toko.id
						left join webmaster__wilayah__kabupaten on id_kota = kota_id
						where b.jual_barang='Ya' and outsourcing__brand.jual_produk=1
						order by id desc limit 10)

		UNION  ALL
		
		(select store__produk.id,id_asset,nama_barang,concat(type,' ',kota_name) as kota ,id_brand ,id_kota
		from store__produk 
			join inventaris__asset__list b on id_asset=b.id 
			left join outsourcing__brand on b.id_brand = outsourcing__brand.id
			left join store__toko on store__produk.id_toko = store__toko.id
			left join webmaster__wilayah__kabupaten on id_kota = kota_id
			where b.jual_barang='Ya' and outsourcing__brand.jual_produk=1
			)
		) as a
		
		|WHERE|
		GROUP BY a.id,id_asset,nama_barang,a.kota,a.id_brand,id_kota
		order by random()
		";*/
	}

	public static function add_cart()
	{
		return array();
	}
	public static function list_cart()
	{
		return array();
	}
	public static function list_alamat_user()
	{
		return array();
	}
	// public static function pesanan_saya($page)
	// {
	// 	$page['crud']['form_type'] = 2;
	// 	if ($page['section'] != 'generate')
	// 		DB::connection($page);
	// 	$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
	// 	$page['route'] = __FUNCTION__;
	// 	$page['crud']['layout_pdf'] = array('a4', 'landscape');
	// 	$page['get']['sidebarIn'] = true;;
	// 	$page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'sales_order', 'pos_full', 'pembeli');

	// 	$page['crud']['setting_table_group']["non_prefix_all"] = true;;
	// 	$page['crud']['table_group']['ID Order'][] = "no_purchose_order";
	// 	$page['crud']['table_group']['Tanggal Order'][] = "tanggal_po";
	// 	$page['crud']['table_group']['Costumer'][] = "apps_user";
	// 	$page['crud']['table_group']['Payment'][] = "status_payment";
	// 	$page['crud']['table_group']['Status'][] = "status_pesanan";

	// 	$page['crud']['table_view']['no_purchose_order']["tipe_view"] = "bold-muted";
	// 	$page['crud']['table_view']['no_purchose_order']["muted"] = "no_sales_order";
	// 	$page['crud']['table_view']['id_apps_user']["tipe_view"] = "profil_avatar";
	// 	$page['crud']['table_view']['id_apps_user']["more_info"] = "email";
	// 	$page['crud']['table_view']['id_apps_user']["link"] = [];
	// 	$page['crud']['table_view']['status_pesanan']["tipe_view"] = "badge";
	// 	$page['crud']['table_view']['status_pesanan']["value"]["belum bayar"] = "primary";
	// 	$page['crud']['table_view']['status_pesanan']["else"] = "danger";


	// 	$page['crud']['costum_view']['box'][1]['row'] = "col-md-12";
	// 	$card_1 = "Order";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['row'] = "col-md-6";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "no_purchose_order";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "no_sales_order";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "tanggal_po";

	// 	$card_1 = "Costumer";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['row'] = "col-md-6";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_panel";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_apps_user";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_kirim_ke";
	// 	$page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "pesan";

	// 	$card_1 = "List Pesanan";
	// 	$page['crud']['costum_view']['box'][2]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] =  "erp__pos__utama__detail";
	// 	$card_1 = "Delivery Order";
	// 	$page['crud']['costum_view']['box'][2]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] =  "erp__pos__delivery_order";
	// 	$card_1 = "Rincian Pembayaran";
	// 	$page['crud']['costum_view']['box'][2]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['total'] = true;

	// 	$card_1 = "Payment";
	// 	$page['crud']['costum_view']['box'][2]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['row'] = "col-md-12";
	// 	$page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] =  "erp__pos__payment";




	// 	// Page

	// 	// Status Pesanan
	// 	// Type Pemesanan
	// 	// Kirim Ke
	// 	// Pesan
	// 	// Attachment
	// 	// Status
	// 	return $page;
	// }
	public static function update_stok($page)
	{
		EcommerceApp::sync_update_stok($page, $page['load']['id']);
		die;
	}
	public static function clearance_produk($page)
	{
		$total_clearance = EcommerceApp::clearance_produk($page, $page['load']['id']);
		echo json_encode(["total" => $total_clearance]);
		die;
	}
	public static function detail2($page)
	{
		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "system";
		$website['content'][$i]['template_function'] = "produk";
		$website['content'][$i]['id_produk'] = $page['load']['id'];
		$i++;
		$page['title'] = "";
		$page['subtitle'] = "";
		// echo $data_detail[1]['id_apps'];
		// $page['meta']['title'] = $data_detail[1]['nama_barang'];
		// $page['meta']['keyword'] = implode(',', explode(' ', $data_detail[1]['nama_barang']));;
		// $page['meta']['link'] = base_url() . "/produk/" . $data_detail[1]['id_apps'];;;
		// $page['meta']['description'] = htmlspecialchars_decode($data_detail[1]['deskripsi_barang']);;;


		$page['view_layout'][] = array("website", "col-md-12", $website);
		$page['load']['type']  = 'view_layout';

		return $page;
	}
	public static function detail($page)
	{

		// $data_detail = Ecommerce::list_barang_detail($page, $id = "");
		// echo $data_detail[1]['id_apps'];
		// IndexedDBContent::send_barang($page,$data_detail[1]['id_apps'],$data_detail[1]);
		// die;
		// EcommerceApp::sync_update_stok($page, $page['load']['id']);
		// echo 'ini'.$page['load']['id'];
		$page['title'] = "";
		$page['subtitle'] = "";
		$db['utama'] = "inventaris__asset__list_query";
		$db['utama'] = "inventaris__asset__list_query";
		$db['np'] = "inventaris__asset__list_query";
		$db['select'][] = "nama_barang";
		$db['select'][] = "id_apps";
		$db['select'][] = "deskripsi_barang";
		$db['select'][] = "foto_aset_inventaris__asset__list";
		$db['select'][] = "foto_inventaris__asset__list";
		$db['select'][] = "id_asset";
		$db['join'][] = ["store__produk", "id_asset", "inventaris__asset__list.id", 'LEFT'];
		// $db['join'][] = ["panel", "inventaris__asset__list.id_panel", "panel.id", 'left'];
		// $db['join'][] = ["webmaster__inventaris__master__kategori", "id_kategori", "webmaster__inventaris__master__kategori.id", 'left'];
		// $db['join'][] = ["store__produk", "id_asset", "inventaris__asset__list.id", 'left'];
		// $db['join'][] = ["outsourcing__brand", "inventaris__asset__list.id_brand", "outsourcing__brand.id", 'left'];
		// $db['join'][] = ["store__toko", " store__produk.id_toko", "store__toko.id", 'left'];
		// // $page['config']['database']['Mall']['join'][] = array("drive__file", "drive__file.id::text", "inventaris__asset__list.foto_aset", "left");
		// $db['join'][] = ["webmaster__wilayah__kabupaten", "store__toko.id_kota", "webmaster__wilayah__kabupaten.kota_id", 'left'];
		// $db['join'][] = ["store__produk__user", " store__produk__user.id_produk", "store__produk.id  " . (isset($_SESSION['id_apps_user']) ? 'and store__produk__user.id_apps_user=' . $_SESSION['id_apps_user'] : '') . "", 'left'];

		$db['where'][] = ["store__produk.id", "=", "LOAD_ID|"];
		// DB::table('store__produk');
		// DB::joinRaw('inventaris__asset__list on id_asset = inventaris__asset__list.id');
		// DB::whereRaw('store__produk.id = ' . $page['load']['id']);
		if ($page['section'] != "generate") {

			$get = Database::database_coverter($page, $db, [], 'all');

			if ($get['num_rows']) {

				$page['meta']['title'] = $get['row'][0]->nama_barang;
				$page['meta']['keyword'] = implode(',', explode(' ', $get['row'][0]->nama_barang));;
				$page['meta']['link'] = base_url() . "/produk/" . $get['row'][0]->id_apps;;;
				$page['meta']['description'] = htmlspecialchars_decode($get['row'][0]->deskripsi_barang);;;
			}
		}


		$query_id = "SELECT  DISTINCT 
			case when inventaris__asset__list__varian.asal_from_data_varian='Master' then master_varian.<ID_VARIAN> else inventaris__asset__list__varian.<ID_VARIAN> end as <ID_VARIAN> 
			<ADD_SELECT>
			FROM
							inventaris__asset__list__varian
							LEFT JOIN inventaris__asset__list__varian  as master_varian ON master_varian.id= inventaris__asset__list__varian.id_master_varian
							LEFT JOIN inventaris__asset__list ON inventaris__asset__list__varian.id_inventaris__asset__list
							 = inventaris__asset__list.id
							LEFT JOIN store__produk ON id_asset = inventaris__asset__list.id 
						WHERE
							store__produk.id = LOAD_ID| 
										GROUP BY case when inventaris__asset__list__varian.asal_from_data_varian='Master' then master_varian.<ID_VARIAN> else inventaris__asset__list__varian.<ID_VARIAN> end<ADD_SELECT_GROUP>
									
		
		";
		$query_id1 = str_replace('<ID_VARIAN>', 'id_tipe_varian_1', $query_id);
		$query_id1 = str_replace('<ADD_SELECT>', '', $query_id1);
		$query_id1 = str_replace('<ADD_SELECT_GROUP>', '', $query_id1);
		$query_id1 .= '';
		$query_id2 = str_replace('<ID_VARIAN>', 'id_tipe_varian_2', $query_id);
		$query_id2 = str_replace('<ADD_SELECT>', '', $query_id2);
		$query_id2 = str_replace('<ADD_SELECT_GROUP>', '', $query_id2);
		$query_id3 = str_replace('<ID_VARIAN>', 'id_tipe_varian_3', $query_id);
		$query_id3 = str_replace('<ADD_SELECT>', '', $query_id3);
		$query_id3 = str_replace('<ADD_SELECT_GROUP>', '', $query_id3);
		$query_idlist = str_replace('<ID_VARIAN>', 'id_varian_row:level!database|', $query_id);
		$query_idlist = str_replace('<ADD_SELECT>', ',inventaris__asset__list__varian.id_inventaris__asset__list,store__produk.id as id_store_produk', $query_idlist);
		$query_idlist = str_replace('<ADD_SELECT_GROUP>', ',inventaris__asset__list__varian.id_inventaris__asset__list,store__produk.id', $query_idlist);

		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "file_bundles_database";
		$website['content'][$i]['template_code'] = "BE3-ECOMMERCE-DETAIL-PRODUCT";
		// $website['content'][$i]['content_source'] = "template";
		// $website['content'][$i]['database_refer'] = "Detail";
		// $website['content'][$i]['template_name'] = "beegrit";
		// $website['content'][$i]['template_file'] = "ecommerce/detail.template";
		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'NAMA-PRODUK',
				"refer" => "database",
				"database_refer" => "Detail",
				"database_row" => "nama_barang",
			),

			array(
				"tag" => 'NAMA-TOKO',
				"refer" => "function",
				"struktur" => "",
				"class" => "Partial",
				"function" => "get_parent_tree",
				"parameter" => array('outsourcing__brand', 'id', 'row:id_brand!Detail|', 'id_parent', 'nama_brand', ' > '),
				"get_result" => "nama",
			),
			array(
				"tag" => 'BE3-TOKO',
				"refer" => "database",
				"database_refer" => "Detail",
				"database_row" => "nama_toko"
			),
			array(
				"tag" => 'DESKRIPSI',
				"refer" => "function",
				"struktur" => "",
				"class" => "Partial",
				"function" => "html_decode",
				"parameter" => array('row:deskripsi_barang!Detail|'),
			),
			array(
				"tag" => 'ID-PRODUK',
				"refer" => "database",
				"database_refer" => "Detail",
				"database_row" => "id_produk"
			),
			array(
				"tag" => 'ID-ASSET',
				"refer" => "database",
				"database_refer" => "Detail",
				"database_row" => "id_asset"
			),
			// array(
			// 	"tag" => 'STOK-BARANG',
			// 	"refer" => "database",
			// 	"database_refer" => "Detail",
			// 	"database_row" => "total_stok"
			// ),
			array(
				"tag" => 'HARGA-AKHIR',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "get_data_harga",
				"parameter" => array("min_max", 'row:id_produk!Detail|'),
				"get_result" => "Min Max Harga Jual Akhir",
			),
			array(
				"tag" => 'HARGA-AWAL',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "get_data_harga",
				"parameter" => array("min_max", 'row:id_produk!Detail|'),
				"get_result" => "Min Max Harga Jual Awal",
			),
			array(


				"tag" => 'LINK-PROFILTOKO',
				"refer" => "link",
				"route_type" => "just_link",
				"link" => array("Ecommerce", "toko", "view_layout", "row:id_toko!Detail|")
			),
			array(
				"tag" => 'SPESIFIKASI',
				"refer" => "database_list",
				"source_list" => "template",
				"content_source" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/detail_spesifikasi.template",
				"database_refer" => "Spek",
				'array' => array(
					'NAMA-DETAIL' => array(
						"refer" => "database",
						// "database_refer" => "Spek",
						"row" => "nama_detail",
					),
					'KONTENT-DETAIL' => array(
						"refer" => "database",
						// "database_refer" => "Spek",
						"row" => "konten_detail",
					),
				),
			),
			array(
				"tag" => 'TUMB',
				"refer" => "database_list",
				"source_list" => "template",
				"content_source" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/img_tumb.template",
				"database_refer" => "TUMB",
				'array' => array(
					'SRC' => array(
						"refer" => "img_in_database",
					),

				),
			),
			array(
				"tag" => 'TUMB-LIST-ASHION',
				"refer" => "database_list",
				"source_list" => "template",
				"content_source" => "template",
				"template_name" => "ashion",
				"template_file" => "img_tumb.template",
				"database_refer" => "IMGALL",
				'array' => array(
					'SRC' => array(
						"refer" => "img_in_database",
					),
					'ACTIVE' => array(
						"refer" => "if_first",
						"text" => "active",
					),
					'ID-PRODUK' => array(
						"refer" => "database",
						"row" => "id_produk",
					),

				),
			),
			array(
				"tag" => 'IMG-LIST-ASHION',
				"refer" => "database_list",
				"source_list" => "template",
				"content_source" => "template",
				"template_name" => "ashion",
				"template_file" => "img_list.template",
				"database_refer" => "IMGALL",
				'array' => array(
					'SRC' => array(
						"refer" => "img_in_database",
					),
					'ACTIVE' => array(
						"refer" => "if_first",
						"text" => "active",
					),
					'ID-PRODUK' => array(
						"refer" => "database",
						"row" => "id_produk",
					),

				),
			),

			array(
				"tag" => 'SAMPUL',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/img.template",
				"database_refer" => "SAMPUL",
				'array' => array(
					'IMG-SRC' => array(
						"refer" => "img_in_database",
					),

				),
			),
			array(
				"tag" => 'VARIAN',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/varian.template",
				"database_refer" => "TIPE_VARIAN",
				'array' => array(
					'NAMA-TIPE' => array(
						"refer" => "database",
						"row" => "nama_tipe",
					),
					'LEVEL' => array(
						"refer" => "database",
						"row" => "level",
					),
					'CLASS' => array(
						"refer" => "if_database_to_text",
						"source_database" => "database",
						"row" => "nama_tipe",
						"if_value" => array(
							"Warna" => "form-selectgroup",
							"Size" => 'btn-group" role="group" aria-label="Basic radio toggle button group',
						),
						"if_else" => 'btn-group" role="group" aria-label="Basic radio toggle button group',
					),
					'LIST' => array(
						"refer" => "if_database_to_database_list",
						"source_database" => "database",

						"row" => "nama_tipe", //dari  atas
						"database_refer" => -1,
						"database" => array(
							"utama" => "inventaris__master__tipe_varian__list",


							"join_raw" => array("
								($query_idlist) as a on inventaris__master__tipe_varian__list.id = a.id_varian_row:level!database| 
								"),
							"where" => array(
								// array("id_store__produk", '=', 'LOAD_ID|'),
								// array("inventaris__asset__list__varian_level.level", '=', 'row:level!database|'),
							),

							"non_add_select" => true,
							"np" => true,
							"where_get_array" => array(
								array(
									"row" => "id_inventaris__master__tipe_varian",
									"array_row" => "database_list_template",
									"get_row" => "id_tipe_varian"
								),
							),
						),
						"if_value" => array(
							"Warna" => array(
								"template_name" => "beegrit",
								"template_file" => "ecommerce/varian_warna.template",
								"array" => array(
									"VALUE" => array(
										"refer" => "database",
										"row" => "primary_key",
									),
									"BG" => array(
										"refer" => "database",
										"row" => "kode",
									),
									"LEVEL" => array(
										"refer" => "database",
										"row" => "level",
									),
									"ID-ASSET" => array(
										"refer" => "database",
										"row" => "id_inventaris__asset__list",
									),
									// "ID-PRODUK-VARIAN" => array(
									// 	"refer" => "database",
									// 	"row" => "id_store_produk_varian",
									// ),
									// "ID-ASSET-VARIAN" => array(
									// 	"refer" => "database",
									// 	"row" => "id_asset_varian",
									// ),
									"ID-PRODUK" => array(
										"refer" => "database",
										"row" => "id_store_produk",
									),
									"ID-VARIAN-LIST" => array(
										"refer" => "database",
										"row" => "primary_key",
									),
									"NAMA-VARIAN" => array(
										"refer" => "database",
										"row" => "nama_list_tipe_varian",
									),
								),
							),
							"Size" => array(
								"template_name" => "beegrit",
								"template_file" => "ecommerce/varian_size.template",
								"array" => array(
									"VALUE" => array(
										"refer" => "database",
										"row" => "primary_key",
									),
									"BG" => array(
										"refer" => "database",
										"row" => "kode",
									),
									"LEVEL" => array(
										"refer" => "database",
										"row" => "level",
									),
									// "ID-ASSET-VARIAN" => array(
									// 	"refer" => "database",
									// 	"row" => "id_asset_varian",
									// ),
									"ID-ASSET" => array(
										"refer" => "database",
										"row" => "id_inventaris__asset__list",
									),
									// "ID-PRODUK-VARIAN" => array(
									// 	"refer" => "database",
									// 	"row" => "id_store_produk_varian",
									// ),
									"ID-PRODUK" => array(
										"refer" => "database",
										"row" => "id_store_produk",
									),
									"ID-VARIAN-LIST" => array(
										"refer" => "database",
										"row" => "primary_key",
									),
									"NAMA-VARIAN" => array(
										"refer" => "database",
										"row" => "nama_list_tipe_varian",
									),
								),
							),
						),
						"if_else" => array(
							"template_name" => "beegrit",
							"template_file" => "ecommerce/varian_else.template",
							"array" => array(
								"VALUE" => array(
									"refer" => "database",
									"row" => "primary_key",
								),
								"BG" => array(
									"refer" => "database",
									"row" => "kode",
								),

								"LEVEL" => array(
									"refer" => "database",
									"row" => "level",
								),
								"ID-ASSET" => array(
									"refer" => "database",
									"row" => "id_inventaris__asset__list",
								),
								"ID-PRODUK" => array(
									"refer" => "database",
									"row" => "id_store_produk",
								),
								// "ID-PRODUK-VARIAN" => array(
								// 	"refer" => "database",
								// 	"row" => "id_store_produk_varian",
								// ),
								// "ID-ASSET-VARIAN" => array(
								// 	"refer" => "database",
								// 	"row" => "id_asset_varian",
								// ),
								"ID-VARIAN-LIST" => array(
									"refer" => "database",
									"row" => "primary_key",
								),

								"NAMA-VARIAN" => array(
									"refer" => "database",
									"row" => "nama_list_tipe_varian",
								),
							),
						)

					),

				),
			),
			// array(
			//     "tag" => 'HARGA-AKHIR',
			//     "refer" => "database",
			// 	"database_refer" => "Detail",
			//     "database_row" => "deskripsi_barang"
			// ),

		);
		$page['view_layout'][] = array("website", "col-md-12", $website);

		// foto_inventaris__asset__list
		$page['config']['database']['SAMPUL']['select'][] = "drive__file.*";
		// $page['config']['database']['SAMPUL']['select'][] = "store__produk.id as id_produk";
		$page['config']['database']['SAMPUL']['utama'] = "drive__file";
		$page['config']['database']['SAMPUL']['np'] = true;
		$page['config']['database']['SAMPUL']['select'][] = "LOAD_ID| as id_produk";
		// $page['config']['database']['SAMPUL']['join'][] = array("store__produk", "id_asset", "inventaris__asset__list.id");
		// $page['config']['database']['SAMPUL']['join'][] = array("", "drive__file.id::text", "inventaris__asset__list.foto_aset");
		// $page['config']['database']['SAMPUL']['where'][] = array("((ref_database", '=', "'ltw_inventaris__asset__list') or ref_database='inventaris__asset__list')");
		// // $page['config']['database']['SAMPUL']['where'][] = array("inventaris__asset__list.id",'=','ref_external_id');
		// // $page['config']['database']['SAMPUL']['where'][] = array("inventaris__asset__list.id",'=','ref_external_id');
		// $page['config']['database']['SAMPUL']['where'][] = array("support", '=', "'Sampul'");
		// $page['config']['database']['SAMPUL']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');
		if (!empty($get['row'][0]->foto_aset_inventaris__asset__list))
			$page['config']['database']['SAMPUL']['where'][] = array("CAST(id as SIGNED)", '=', $get['row'][0]->foto_aset_inventaris__asset__list);
		else {
			$page['config']['database']['SAMPUL']['where'][] = array("CAST(id as SIGNED)", '=', -1);
		}
		// $page['config']['database']['SAMPUL']['where'][] = array("sizes::int", '>', '0');

		$page['config']['database']['TUMB']['select'][] = "drive__file.*";
		$page['config']['database']['TUMB']['select'][] = "store__produk.id as id_produk";
		$page['config']['database']['TUMB']['utama'] = "store__produk";
		$page['config']['database']['TUMB']['join'][] = array("inventaris__asset__list", "id_asset", "inventaris__asset__list.id");
		$page['config']['database']['TUMB']['join'][] = array("drive__file", "ref_external_id", "inventaris__asset__list.id");
		$page['config']['database']['TUMB']['where'][] = array("((ref_database", '=', "'ltw_inventaris__asset__list') or ref_database='inventaris__asset__list')");
		// $page['config']['database']['SAMPUL']['where'][] = array("inventaris__asset__list.id",'=','ref_external_id');
		// $page['config']['database']['TUMB']['where'][] = array("support",'=',"'Sampul'");
		$page['config']['database']['TUMB']['where'][] = array("CAST(sizes AS SIGNED)", '>', '0');
		$page['config']['database']['TUMB']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');
		$page['config']['database']['TUMB']['np'] = true;

		$page['config']['database']['IMGALL']['select'][] = "*";
		// $page['config']['database']['IMGALL']['select'][] = "store__produk.id as id_produk";
		$page['config']['database']['IMGALL']['select'][] = "LOAD_ID| as id_produk";
		$page['config']['database']['IMGALL']['utama'] = "drive__file";
		// $page['config']['database']['IMGALL']['join'][] = array("inventaris__asset__list", "id_asset", "inventaris__asset__list.id");
		// $page['config']['database']['IMGALL']['join'][] = array("drive__file", "ref_external_id", "inventaris__asset__list.id");
		// $page['config']['database']['IMGALL']['where'][] = array("((ref_database", '=', "'ltw_inventaris__asset__list') or ref_database='inventaris__asset__list')");
		// $page['config']['database']['SAMPUL']['where'][] = array("inventaris__asset__list.id",'=','ref_external_id');
		// $page['config']['database']['TUMB']['where'][] = array("support",'=',"'Sampul'");
		// $page['config']['database']['IMGALL']['where'][] = array("sizes::int", '>', '0');
		if ($page['section'] != "generate") {
			$page['config']['database']['IMGALL']['where'][] = array("CAST(id as SIGNED)", ' in ', "(" .  $get['row'][0]->foto_aset_inventaris__asset__list . $get['row'][0]->foto_inventaris__asset__list . ")");
		} else {
			$get = [];
			$get['row'][0] = (object)[];
			$get['row'][0]->id_asset = "ID_ASSET|";
		}
		// $page['config']['database']['IMGALL']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');
		$page['config']['database']['IMGALL']['np'] = true;

		$page['config']['database']['Detail']['select'][] = "*";
		$page['config']['database']['Detail']['select'][] = "store__produk.id as id_produk";
		$page['config']['database']['Detail']['utama'] = "inventaris__asset__list";
		$page['config']['database']['Detail']['limit'] = 1;
		// $page['config']['database']['Detail']['join'][] = ["panel", "id_panel", "panel.id", 'left'];
		$get_sql = ErpPosApp::get_stok($page, 0, "", "", "", 'sql_rekap_akhir_total_asset');;
		// print_r($get_sql);
		// die;
		$page['config']['database']['Detail']['join'][] = ["($get_sql) as all_stok", "all_stok.id", "inventaris__asset__list.id", "left", "non_schema" => true];

		$page['config']['database']['Detail']['join'][] = array("store__produk", "id_asset", "inventaris__asset__list.id");
		$page['config']['database']['Detail']['join'][] = array("store__toko", "store__produk.id_toko", "store__toko.id", 'LEFT');
		$page['config']['database']['Detail']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');
		$page['config']['database']['Detail']['np'] = true;

		// $page['config']['database']['Spek']['select'][] = "inventaris__asset__list__detail.nama_detail";
		// $page['config']['database']['Spek']['select'][] = "inventaris__asset__list__detail.konten_detail";
		// $page['config']['database']['Spek']['utama'] = "inventaris__asset__list__detail";
		// $page['config']['database']['Spek']['join'][] = array("inventaris__asset__list", "id_inventaris__asset__list", "inventaris__asset__list.id");
		// $page['config']['database']['Spek']['join'][] = array("store__produk", "id_asset", "inventaris__asset__list.id");
		// $page['config']['database']['Spek']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');
		// $page['config']['database']['Spek']['query'] = "SELECT detail.* 
		// 	FROM store__produk 
		// 	left join inventaris__asset__list on inventaris__asset__list.id = id_asset

		// 	join (
		// 	select inventaris__asset__list.id as id_inventaris__asset__list,'brand' as nama_detail,outsourcing__brand.nama_brand as konten_detail from inventaris__asset__list left join outsourcing__brand on outsourcing__brand.id = id_brand  WHERE nama_brand is not null
		// 	union all

		// 	select inventaris__asset__list.id as id_inventaris__asset__list,'kategori' as nama_detail,webmaster__inventaris__master__kategori.nama_kategori as konten_detail from inventaris__asset__list left join webmaster__inventaris__master__kategori on webmaster__inventaris__master__kategori.id = id_kategori  WHERE nama_kategori is not null
		// 	union all

		// 	select id_inventaris__asset__list,nama_detail,konten_detail from inventaris__asset__list__detail 


		// 	)  as detail on detail.id_inventaris__asset__list = inventaris__asset__list.id

		// 	where store__produk.id = LOAD_ID|";

		$page['config']['database']['Spek']['utama'] = "store__produk";
		$page['config']['database']['Spek']['where'][] = ["store__produk.id", "=", "LOAD_ID|"];
		$page['config']['database']['Spek']['non_repositioning_join'] = true;
		$page['config']['database']['Spek']['join'][] = ["inventaris__asset__list", "inventaris__asset__list.id", "id_asset"];
		$page['config']['database']['Spek']['join_subquery'][] = [
			[

				"as" => "detail",
				"union" => [
					"type_onion" => "all",
					"subquery" => [

						[
							"select" => ["inventaris__asset__list.id as id_inventaris__asset__list,'Brand' as nama_detail,outsourcing__brand.nama_toko as konten_detail"],
							"utama" => "inventaris__asset__list",
							"join" => [
								["outsourcing__brand", "outsourcing__brand.id", "id_brand"]
							],
							"where" => [
								["nama_toko", " is ", "not null"],
								["inventaris__asset__list.id", " = ", $get['row'][0]->id_asset]
							],
							"non_master" => true,
							"np" => true,
							"non_add_select" => true,
						],
						[
							"select" => ["inventaris__asset__list.id as id_inventaris__asset__list,'Kategori' as nama_detail,webmaster__inventaris__master__kategori.nama_kategori as konten_detail"],
							"utama" => "inventaris__asset__list",
							"join" => [
								["webmaster__inventaris__master__kategori", " webmaster__inventaris__master__kategori.id", "id_kategori"]
							],
							"where" => [
								["nama_kategori", " is ", "not null"],
								["inventaris__asset__list.id", " = ", $get['row'][0]->id_asset]
							],
							"non_master" => true,
							"np" => true,
							"non_add_select" => true,
						],
						[
							"select" => ["id_inventaris__asset__list,nama_detail,konten_detail"],
							"utama" => "inventaris__asset__list__detail",
							"np" => true,
							"non_master" => true,
							"non_add_select" => true,
							"where" => [
								["id_inventaris__asset__list", " = ", $get['row'][0]->id_asset]
							],


						]
					]
				]
			],


			"detail.id_inventaris__asset__list",
			"inventaris__asset__list.id"
		];
		$page['config']['database']['Spek']['np'] = true;


		$page['config']['database']['TIPE_VARIAN']['query'] = "SELECT
				* 
			FROM
				(SELECT '1' AS level
                    UNION ALL
                    SELECT '2'
                    UNION ALL
                    SELECT '3'
                    UNION ALL
                    SELECT '4'
                    UNION ALL
                    SELECT '5'
                    UNION ALL
                    SELECT '6') AS level 
			join (select *,id as id_tipe_varian from inventaris__master__tipe_varian) as inventaris__master__tipe_varian  on inventaris__master__tipe_varian.id = ( CASE
					WHEN level = '1' then ($query_id1)
					WHEN level = '2' then ($query_id2)
					WHEN level = '3' then ($query_id3)
					ELSE NULL
								END
							)
			WHERE
				(
				CASE
					WHEN level = '1' AND ($query_id1)  IS NOT NULL THEN TRUE
					WHEN level = '2' AND ($query_id1)  IS NOT NULL THEN TRUE
					WHEN level = '3' AND ($query_id3)  IS NOT NULL THEN TRUE
					
					ELSE
						FALSE
				END
			);
			";
		// $page['config']['database']['TIPE_VARIAN']['select'][] = "inventaris__master__tipe_varian.id as id_tipe_varian";
		// $page['config']['database']['TIPE_VARIAN']['utama'] = "inventaris__asset__list__varian_level";
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("inventaris__master__tipe_varian", "id_tipe_varian", "inventaris__master__tipe_varian.id");
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("inventaris__asset__list", "id_inventaris__asset__list", "inventaris__asset__list.id");
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("store__produk", "id_asset", "inventaris__asset__list.id");
		// $page['config']['database']['TIPE_VARIAN']['where'][] = array("store__produk.id", '=', 'LOAD_ID|');



		return $page;
	}
	public static function toko()
	{

		$page['title'] = "Ecommerce";
		$page['subtitle'] = "";



		$card['listing_type'] = "profile-menu"; //info/listing/listmenu
		$card['default_id'] = "Semua Produk";
		$card['view_default'] = "ViewVertical";
		$card['profil']['database']['utama'] = 'store__toko';
		$card['profil']['database']['where'][] = array('store__toko.id', "=", "{LOAD_ID}");
		$card['profil']['array'] = array("title" => array("", "nama_toko", ""), "subtitle" => array("Be3 ID:", "apps_id", ""));
		$page['limit_page'] = 30;
		$card['row'] = "col-xl-3 col-md-4 mb-xl-0 mb-4";
		$card['menu'] = array(
			//"Dashboard" => array("icon", 'card-layout', 'array-layout-dashboard'),
			"Semua Produk" => array("icon", 'card-listing', 'array-produk'),
			// "Galeri Produk" => array("icon", 'card-listing', 'array-food'),
			"Daftar Mitra" => array("icon", 'crud', 'array-reseller'),

		);



		//card-listing


		//layout//ViewHorizontal//ViewVertical//ViewListTables
		//layout -> 

		$card['array-reseller'] =  array(
			//Pages::Apps("CRM","daftar_mitra")['crud']['array'];
			"array" => array(
				array("Be3 ID", "apps_id", "text"),
			),
		);
		$card['array-produk'] =  array(
			"title_nav" => "Toko",
			// "//\title_nav"=>"Toko",
			"source" => "template",
			'ViewVertical' => array(
				"template_name" => "beegrit",
				"template_file" => "card/layout.template"
			),

			"sort_by" => array(

				array("Harga Rendah ke Tinggi", "harga_jual_store", "asc"),
				array("Harga Tinggi ke Rendah", "harga_jual_store", "desc"),
				array("Presentase Diskon Tertinggi", "presentase_diskon", "desc"),
				array("Harga Diskon Tertinggi", "harga_diskon", "desc"),
				array("Produk Terlaris", "total_jual", "desc"),
				array("Produk Terbaru", "create_date", "asc"),
				array("Produk Terlama", "create_date", "desc"),
			),
			"filter" => array(
				//array("Kategori","tree","list",array("webmaster__wilayah__kabupaten","kota_id","kota_name",array("where"=>),""),"id_kota"),
				// array("Brand","tree","list",array("webmaster__wilayah__kabupaten","kota_id","kota_name",array("whereRaw"=>[[""]]),"id_parent"),"id_kota"),

			),
			"array" => array(
				array(
					"img",
					null,
					"datafile",
					array("inventaris__asset__list", 'id_asset', "nama_barang"),
					[
						"source" => "template",
						"template_name" => "beegrit",
						"template_file" => "card/img.template",
						"replace_to_image" => "IMG-SRC",
						"style" => "border-radius:25px 25px 0 0;"
					]
				),
				array("body", "tag"),
				array("link", array("Ecommerce", "detail", "view_layout", "row:id!card|"), 'just_link'),
				array("title", "nama_barang", "database", true, array("class" => "product-title")),
				array("subtitle", array("App", "EcommerceApp", "get_data_Harga", array("min_max", 'row:id!card|'), "Min Max Harga Jual Akhir"), "function", true),
				array("KOTA", "kota", "database"),
			),
		);
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

		$page['view_layout'][] = array("card", "col-md-12", $card);

		$page['config']['database']['Daftar Mitra']['utama'] = 'inventaris__asset__tanah__bangunan';
		$page['config']['database']['Daftar Mitra']['primary_key'] = null;

		$page['config']['database']['Semua Produk']['query'] = "
			select *,case when LENGTH ((nama_barang))>=40 then concat(substr(nama_barang,0,40),'....') else nama_barang end as nama_barang ,
			concat(type,' ',kota_name) as kota,store__produk.id ,store__produk.id as primary_key
				
			from store__produk 
				join inventaris__asset__list b on id_asset=b.id
				left join store__toko on store__produk.id_toko = store__toko.id
				left join webmaster__wilayah__kabupaten on store__toko.id_kota = kota_id
				
			
			where store__produk.id_toko = {LOAD_ID} and jual_barang='Ya'
			order by store__produk.create_date
			limit 30
			";



		return $page;
	}

	public static function cart($page)
	{

		$page['title'] = "";
		$page['subtitle'] = "";


		$join = EcommerceApp::query_varian('store__produk__relation.id')['sql_join'];
		$sql = EcommerceApp::query_varian('row:id_produk!database_list_template_on_list|');
		$join2 = $sql['sql_join'];
		$where2 = $sql['sql_where'];
		$query_idlist = $sql['query_idlist'];
		$BANGUNAN['utama']       = 'inventaris__asset__tanah__bangunan__pengisi';
		$BANGUNAN['primary_key'] = null;
		$BANGUNAN['as']          = 't';
		$BANGUNAN['np']          = true;
		$BANGUNAN['select'][]    = 'inventaris__asset__tanah__bangunan.*,
		webmaster__wilayah__provinsi.provinsi ,webmaster__wilayah__kabupaten.type,webmaster__wilayah__kabupaten.kota_name,webmaster__wilayah__kecamatan.subdistrict_name,webmaster__wilayah__postal_code.urban';
		$BANGUNAN['select'][] = 'erp__pos__group.id as id_erp__pos__group';
		$BANGUNAN['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key2';

		$BANGUNAN['join'][]  = ["erp__pos__group", "erp__pos__group.id_apps_user", "inventaris__asset__tanah__bangunan__pengisi.id_apps_user", 'left'];
		$BANGUNAN['join'][]  = ["inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan", 'left'];
		$BANGUNAN['join'][]  = ["webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi", 'left'];
		$BANGUNAN['join'][]  = ["webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota", 'left'];
		$BANGUNAN['join'][]  = ["webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan", 'left'];
		$BANGUNAN['join'][]  = ["webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan", 'left'];
		$BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan__pengisi.id_apps_user", "=", "erp__pos__group.id_apps_user", 'left'];
		$BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan.id_kota", " is ", " not null"];

		$select[] = "crm__mitra_penjualan.id_apps_user";
		$select[] = "smp.id";
		$select[] = "smp.id_store__mitra";
		$select[] = "minimal_pembelian";
		$select[] = "maksimal_pembelian";
		$select[] = "margin_mitra";
		$select[] = "tipe_margin_mitra";
		$pairs[] = "'id_apps_user',id_apps_user";
		$pairs[] = "'id',id";
		$pairs[] = "'id_store__mitra',id_store__mitra";
		$pairs[] = "'minimal_pembelian',minimal_pembelian";
		$pairs[] = "'maksimal_pembelian',maksimal_pembelian";
		$pairs[] = "'margin_mitra',margin_mitra";
		$pairs[] = "'tipe_margin_mitra',tipe_margin_mitra";
		$diskon['select'] = $select; 
		$diskon['as'] = "t";
		$diskon['utama'] = "crm__mitra_penjualan";
		$diskon['join'][] = ["store__mitra ","store__mitra.id","crm__mitra_penjualan.id_store__mitra ","LEFT"];
		$diskon['join'][] = ["store__mitra__presetase smp","smp.id_store__mitra","store__mitra.id"];
		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "file_bundles_database";
		$website['content'][$i]['template_code'] = "BE3-ECOMMERCE-CART";
		$website['content'][$i]['template_name'] = "beegrit";
		$website['content'][$i]['template_file'] = "ecommerce/cart.template";
		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'TOKO',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/cart_toko.template",
				"database_refer" => "TOKO",
				'array' => array(
					'NAMA-TOKO' => array(
						"refer" => "database",
						"row" => "nama_toko",
					),
					'TYPE' => array(
						"refer" => "database",
						// "database_refer" => "Spek",
						"row" => "type",
					),
					'NAMA-KOTA' => array(
						"refer" => "database",
						// "database_refer" => "Spek",
						"row" => "kota_name",
					),
					"PRODUK" => array(
						"refer" => "database_list",
						"database_refer" => "-1",
						"database" => array(
							"utama" => "erp__pos__pra_order",
							"primary_key" => null,


							"join" => array(
								[
									"view_produk_detail",
									"erp__pos__pra_order.id_produk",
									"view_produk_detail.id
                  				 and erp__pos__pra_order.id_produk_varian  = view_produk_detail.id_produk_varian ",
									"left"
								]
								//, "view_produk_detail.id and erp__pos__pra_order.id_asset_varian =inventaris__asset__list__varian.id",""],
								// array("store__produk as  store__produk__relation", "erp__pos__pra_order.id_produk", "store__produk__relation.id"),
								// array("store__toko", "store__produk__relation.id_toko", "store__toko.id"),
								// array("inventaris__asset__list_query", "store__produk__relation.id_asset", "inventaris__asset__list.id"),
								// array("inventaris__asset__list__varian", "inventaris__asset__list__varian.id_inventaris__asset__list", "inventaris__asset__list.id and erp__pos__pra_order.id_asset_varian =inventaris__asset__list__varian.id", 'left'),
								// ["(SELECT sum(stok_available) as stok,id_toko as id_store_toko,inventaris__storage__data.id_produk as id_p,id_produk_varian,inventaris__storage__data.id_asset  from inventaris__storage__data 
								// left join store__produk as p on p.id = inventaris__storage__data.id_produk where inventaris__storage__data.id_gudang in (select store__toko__gudang.id_gudang from store__toko__gudang where p.id_toko = store__toko__gudang.id_store__toko)  group by id_toko,inventaris__storage__data.id_produk,id_produk_varian,inventaris__storage__data.id_asset) as storage  ", "storage.id_p", " erp__pos__pra_order.id_produk and erp__pos__pra_order.id_produk_varian = storage.id_produk_varian   and storage.id_store_toko =store__toko.id", "left","non_schema"=>true],
								// ["drive__file utama_file", " utama_file.id ", " inventaris__asset__list.foto_aset", "left"],
								// ["drive__file varian_file", " varian_file.id ", " inventaris__asset__list__varian.foto_aset_varian", "left"]
							),
							// LEFT JOIN (select sum(stok_available) as stok,id_toko,inventaris__storage__data.id_produk,id_produk_varian,inventaris__storage__data.id_asset  from inventaris__storage__data 
							// 		left join store__produk as p on p.id = inventaris__storage__data.id_produk where inventaris__storage__data.id_gudang in (select store__toko__gudang.id_gudang from store__toko__gudang)  group by id_toko,inventaris__storage__data.id_produk,id_produk_varian,inventaris__storage__data.id_asset ) as storage on storage.id_produk= erp__pos__pra_order.id_produk and erp__pos__pra_order.id_produk_varian = storage.id_produk_varian and storage.id_asset = store__produk__relation.id_asset  and storage.store__toko__gudang =store__toko.id
							"select" => array(
								("erp__pos__pra_order.id as id_cart,
                     coalesce(foto_aset_varian,foto_aset) as image,
                     3 as max_level,
                     nama_barang,
                     0 as stok,
                     varian_barang,
                     nama_varian,
                     id_varian_pra_order_1,
                     id_varian_pra_order_2,
                     id_varian_pra_order_3,
                     jumlah,
                     checked,
                     id_produk,
                     view_produk_detail.id_toko,
                     case when varian_barang='1' then harga_pokok_penjualan_varian else harga_pokok_penjualan end as harga_satuan,
					 list_diskon
					 "),
							),
							"non_add_select" => true,
							"where" => array(
								array("erp__pos__pra_order.id_apps_user", "=", "ID_APPS_USER|"),
								array("erp__pos__pra_order.active", "=", "1"),
								array("erp__pos__pra_order.status_pra_order", " in ", "('Aktif')"),
							),
							'join_subquery' => [[
								[

									"as"               => "diskon",
									"np"               => "",
									"not_where_active" => "",
									"non_checking" => "",
									"not_checking" => "",
									"select"           => [
										 "id_apps_user,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as list_diskon",
									],
									"utama_query"      => $diskon,
									"group"            => [
										"t.id_apps_user",
									],

								],
								"diskon.id_apps_user",
								"erp__pos__pra_order.id_apps_user",

								'left',
							]],
							"where_get_array" => array(
								array(
									"row" => "view_produk_detail.id_toko",
									"array_row" => "database_list_template",
									"get_row" => "id_toko"
								),
							)
						),
						'content_source' => "file_bundles_database",
						"template_code" => "BE3-ECOMMERCE-CART-PRODUK",
						"template_name" => "beegrit",
						"template_file" => "ecommerce/cart_produk.template",
						"array" => array(
							"NAMA-PRODUK" => array("refer" => "database", "row" => "nama_barang"),
							"ID-CART" => array("refer" => "database", "row" => "id_cart"),
							"IS_VARIAN" => array("refer" => "database", "row" => "varian_barang"),
							// "MAX_VARIAN" => array("refer" => "database", "row" => "max_level"),
							"NAMA-VARIAN" => array("refer" => "database", "row" => "nama_varian"),
							"STOK" => array("refer" => "database", "row" => "stok"),
							"VARIAN1" => array("refer" => "database", "row" => "id_varian_pra_order_1"),
							"VARIAN2" => array("refer" => "database", "row" => "id_varian_pra_order_2"),
							"VARIAN3" => array("refer" => "database", "row" => "id_varian_pra_order_3"),

							"QTY" => array("refer" => "database", "row" => "jumlah"),
							"IMAGE-CART" => array("refer" => "database", "row" => "image"),
							"HARGA-SATUAN" => array("refer" => "database", "row" => "harga_satuan"),
							"LIST-DISKON" => array("refer" => "database_json", "row" => "list_diskon"),
							// "IMAGE-CART" => array(
							// 	"refer" => "function",
							// 	"struktur" => "App",
							// 	"class" => "EcommerceApp",
							// 	"function" => "cek_harga_cart_get_checkout",
							// 	"parameter" => array("all", 'row:id_cart!database_list_template_on_list|', 'row:checked!database_list_template_on_list|', "row:jumlah!database_list_template_on_list|", "row:id_varian_pra_order_1!database_list_template_on_list|", "row:id_varian_pra_order_2!database_list_template_on_list|", "row:id_varian_pra_order_3!database_list_template_on_list|"),
							// 	"get_result" => "img_src",
							// ),
							"CHECKED" => array(
								"refer" => "if_database_to_text",
								"source_database" => "database_list_template_on_list",
								"row" => "checked",
								"if_value" => array(
									"0" => "",
									"1" => 'checked',
								),
								"if_else" => ''
							),

							"HARGA" => array(
								"refer" => "function",
								"struktur" => "App",
								"class" => "EcommerceApp",
								"function" => "get_data_harga",
								"parameter" => array("all", 'row:id_produk!database_list_template_on_list|', 'YA', "row:jumlah!database_list_template_on_list|"), //, "row:id_varian!database_list_template_on_list|"
								"get_result" => "harga_jual_akhir_print",
							),
							"TOTAL-DISKON" => array(
								"refer" => "function",
								"struktur" => "App",
								"class" => "EcommerceApp",
								"function" => "get_data_harga",
								"parameter" => array("all", 'row:id_produk!database_list_template_on_list|', 'YA', "row:jumlah!database_list_template_on_list|"), //, "row:id_varian!database_list_template_on_list|"
								"get_result" => "total_diskon_keseluruhan",
							),
							// "HARGA-SATUAN" => array(
							// 	"refer" => "function",
							// 	"struktur" => "App",
							// 	"class" => "EcommerceApp",
							// 	"function" => "get_data_harga",
							// 	"parameter" => array("all", 'row:id_produk!database_list_template_on_list|', 'YA', "row:jumlah!database_list_template_on_list|"), //, "row:id_varian!database_list_template_on_list|"
							// 	"get_result" => "harga_satuan",
							// ),
							// "VARIAN" => array(
							// 	"refer" => "database_list",
							// 	"database_refer" => "-1",
							// 	"database" => array(

							// 		"utama" => "level_varian()",
							// 		"alias" => "level",
							// 		"primary_key" => "level",
							// 		"not_checking" => true,
							// 		"np" => true,

							// 		"where_raw" => (
							// 			"$where2"
							// 		),
							// 		"select" => ["*"],
							// 		"join_raw" => array(
							// 			"$join2"
							// 		),


							// 		// "where_get_array" => array(
							// 		// 	array(
							// 		// 		"row" => "store__produk.id",
							// 		// 		"array_row" => "database_list_template_on_list",
							// 		// 		"get_row" => "id_produk"
							// 		// 	),
							// 		// )
							// 	),
							// 	"template_name" => "beegrit",
							// 	"template_file" => "ecommerce/cart_varian.template",
							// 	"array" => array(
							// 		"NAMA-TIPE" => array("refer" => "database", "row" => "nama_tipe"),
							// 		"ID-CART" => array("refer" => "database", "row" => "id_cart"),
							// 		"ID-CART" => array("refer" => "database", "row" => "id_cart"),

							// 		"LEVEL" => array("refer" => "database", "row" => "level"),
							// 		"VARIAN-LIST" => array(
							// 			"refer" => "database_list",
							// 			"database_refer" => "-1",
							// 			"database" => array(
							// 				"utama" => "inventaris__master__tipe_varian__list",


							// 				"join_raw" => array("
							// 					($query_idlist) as a on inventaris__master__tipe_varian__list.id = a.id_varian_row:level!database_list_template_on_list_on_list| 
							// 					"),

							// 				// "where" => array(
							// 				// 	array("id_store__produk", '=', ' row:id_produk!database_list_template_on_list|'),
							// 				// ),

							// 				"np" => true,
							// 				"non_add_select" => true,
							// 				"where_get_array" => array(
							// 					array(
							// 						"row" => "id_inventaris__master__tipe_varian",
							// 						"array_row" => "database_list_template_on_list_on_list",
							// 						"get_row" => "id_tipe_varian"
							// 					),
							// 				),

							// 			),
							// 			"template_name" => "beegrit",
							// 			"template_file" => "ecommerce/cart_option.template",
							// 			"array" => array(
							// 				"ID-TIPE" => array("refer" => "database", "row" => "primary_key"),

							// 				"NAMA-VARIAN" => array("refer" => "database", "row" => "nama_list_tipe_varian"),
							// 				"LEVEL" => array("refer" => "database", "row" => "level"),

							// 			),
							// 		)
							// 	),
							// )

						),
					),
				),

			),
			array(
				"tag" => 'SUMMARY',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array(null, "cart"),
				"get_result" => "summary",
			),
			array(
				"tag" => 'VOUCHER_DIGUNAKAN',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array(null, "cart"),
				"get_result" => "voucher_digunakan",
			),
			array(
				"tag" => 'VOUCHER_LIST',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array(null, "cart"),
				"get_result" => "string_voucher_aktif",
			)





		);
		$page['view_layout'][] = array("website", "col-md-12", $website);
		// $page['config']['database']['TIPE_VARIAN']['select'][] = "inventaris__master__tipe_varian.id as id_tipe_varian";
		// $page['config']['database']['TIPE_VARIAN']['utama'] = "inventaris__asset__list__varian_level";
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("inventaris__master__tipe_varian","id_tipe_varian","inventaris__master__tipe_varian.id");
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("inventaris__asset__list","id_inventaris__asset__list","inventaris__asset__list.id");
		// $page['config']['database']['TIPE_VARIAN']['join'][] = array("store__produk","id_asset","inventaris__asset__list.id");
		// $page['config']['database']['TIPE_VARIAN']['where'][] = array("store__produk.id",'=','LOAD_ID|');





		$page['config']['database']['TOKO']['select'][] = "DISTINCT store__produk.id_toko,nama_toko,webmaster__wilayah__kabupaten.type,webmaster__wilayah__kabupaten.kota_name";
		$page['config']['database']['TOKO']['utama'] = "erp__pos__pra_order";
		$page['config']['database']['TOKO']['non_add_select'] = true;
		$page['config']['database']['TOKO']['non_add_select'] = true;
		$page['config']['database']['TOKO']['join'][] = array("store__produk", "id_produk", "store__produk.id", 'inner');
		$page['config']['database']['TOKO']['join'][] = array("store__toko", "store__produk.id_toko", "store__toko.id", 'inner');
		$page['config']['database']['TOKO']['join'][] = array("webmaster__wilayah__kabupaten", "store__toko.id_kota", "kota_id", 'left');
		$page['config']['database']['TOKO']['where'][] = array("erp__pos__pra_order.id_apps_user", '=', "'ID_APPS_USER|'");
		$page['config']['database']['TOKO']['where'][] = array("erp__pos__pra_order.active", '=', 1);
		$page['config']['database']['TOKO']['where'][] = array("erp__pos__pra_order.status_pra_order", ' = ', "'Aktif'");




		return $page;
	}
	public static function list_barang_detail($page, $id = "")
	{
		$page['config']['database']['Mall']['select'][] = "store__produk.id as id_store_produk";
		$page['config']['database']['Mall']['select'][] = "store__produk.id as id_produk";
		$page['config']['database']['Mall']['select'][] = "store__produk.id_asset";
		$page['config']['database']['Mall']['select'][] = "concat(webmaster__wilayah__kabupaten.type,' ',kota_name) as kota
														,concat(drive__file.path,drive__file.file_name_save) as foto_utama
														,inventaris__asset__list.jenis_barang_inventaris__asset__list as jenis_barang
														,inventaris__asset__list.nama_jenis_asset
														,inventaris__asset__list.nama_kategori
														,inventaris__asset__list.id_kategori
														,inventaris__asset__list.nama_barang
														,inventaris__asset__list.sku
														,inventaris__asset__list.peruntukan
														,inventaris__asset__list.deskripsi_barang
														,inventaris__asset__list.foto_aset_inventaris__asset__list as foto_aset
														,store__toko.nama_toko as nama_toko
														,store__produk.id_toko as id_toko
														,varian_barang
														,asal_barang_dari
														,id_from_api
														,inventaris__asset__list.id_apps as id_apps_asset
														,id_apps_store_produk
														
														";
		$page['config']['database']['Mall']['non_add_select'] = true;
		// $page['config']['database']['Mall']['select'][] = "id_asset";
		// $page['config']['database']['Mall']['select'][] = "id_brand";
		// $page['config']['database']['Mall']['limit'] = "3";
		$page['config']['database']['Mall']['select'][] = "store__toko.id_kota";
		$page['config']['database']['Mall']['utama'] = "inventaris__asset__list_query";
		// $page['config']['database']['Mall']['join'][] = ["panel", "inventaris__asset__list.id_panel", "panel.id", 'left'];
		// $page['config']['database']['Mall']['join'][] = ["webmaster__inventaris__master__kategori", "id_kategori", "webmaster__inventaris__master__kategori.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["store__produk", "id_asset", "inventaris__asset__list.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["outsourcing__brand", "inventaris__asset__list.id_brand", "outsourcing__brand.id", 'left'];
		$page['config']['database']['Mall']['join'][] = ["store__toko", " store__produk.id_toko", "store__toko.id", 'left'];
		// $page['config']['database']['Mall']['join'][] = array("drive__file", "drive__file.id::text", "inventaris__asset__list.foto_aset", "left");
		$page['config']['database']['Mall']['join'][] = ["webmaster__wilayah__kabupaten", "store__toko.id_kota", "webmaster__wilayah__kabupaten.kota_id", 'left'];
		if (isset($_SESSION['id_apps_user']))
			$page['config']['database']['Mall']['join'][] = ["store__produk__user", " store__produk__user.id_produk", "store__produk.id  and store__produk__user.id_apps_user=" . $_SESSION['id_apps_user'], 'left'];
		// $page['config']['database']['Mall']['where'][] = ["store__produk.status_publish", " =", "'1'"];
		$page['config']['database']['Mall']['where'][] = ["store__produk.id_toko", " is ", " not null"];
		$page['config']['database']['Mall']['where'][] = ["inventaris__asset__list.active", " = ", " 1"];
		$page['config']['database']['Mall']['join'][] = ['drive__file', "inventaris__asset__list.foto_aset::text", "drive__file.id::text", "left"];
		// $page['config']['database']['Mall']['order'][] = ['nama_barang',"asc"];
		if (Partial::input('id_apps')) {
			$page['config']['database']['Mall']['where'][] = ['store__produk.id_apps_store_produk', "=", "'" . Partial::input('id_apps') . "'"];
		} else if ($id) {
			$page['config']['database']['Mall']['where'][] = ['store__produk.id', "=", $id];
		} else {

			$page['config']['database']['Mall']['where'][] = ['1=1', "", "WORKSPACE_SINGLE_TOKO_WHERE|", ""];
		}
		$page['config']['database']['Mall']['np'] = "";
		$detail = Database::database_coverter($page, $page['config']['database']['Mall'], [], 'all');
		// echo '<pre>';
		$detail =  (EcommerceApp::get_data_detail($page, $detail, 'detail'));
		echo json_encode(trim($detail[1]));
		return $detail[1];
		die;
	}
	public static function buat_invoice($page, $id, $id_panel)
	{

		$page = EcommerceApp::bikin_invoice($page, $id, $id_panel);
		die;
	}

	public static function sync_cart($page, $id_detail, $id_api, $id_from_api, $qty_pesanan, $id_user = '')
	{
		// echo $id_detail;
		ApiContent::send_cart($page, $id_detail, $id_api, $id_from_api, $qty_pesanan, $id_user);
		die;
	}
	//1/69/273465/20250123211111186799
	public static function acc_sync_order($page, $id_api, $id_order, $seq_pesanan, $user_id)
	{
		// echo $id_detail;
		ApiContent::acc_sync_order($page,  $id_api, $id_order, $seq_pesanan, $user_id);
		die;
	}
	public static function get_order($page, $id_api)
	{
		// echo $id_detail;
		$get = ApiContent::get_order($page,  $id_api);
		print_R($get);
		die;
	}
	public static function get_order_detail($page, $id_api, $id_seq)
	{
		// echo $id_detail;
		ApiContent::get_order_detail($page,  $id_api, $id_seq);
		die;
	}
	public static function sync_order($page, $id_api, $id_order)
	{
		// echo $id_detail;
		ApiContent::send_order($page,  $id_api, $id_order);
		die;
	}
	public static function cancel_order($page, $id_api, $id_order, $seq_pesanan, $user_id)
	{
		// echo $id_detail;

		ApiContent::cancel_order($page,  $id_api, $id_order, $seq_pesanan, $user_id);
		die;
	}
	public static function get_pesanan($page, $apps, $page_view)
	{
		$fai = new MainFaiFramework();
		if ($fai->input('form-pesanan') == 'baru') {

			$insert['id_page'] = 4;
			$insert['side'] = 'penjual';
			$insert['input_proses'] = '1';


			$id_pesanan = CRUDFunc::crud_insert($fai, $page, $insert, [], 'erp__pos__utama');;
		} else {
			$id_pesanan = $fai->input('pesanan');
		}
		// echo $page['load']['route_pa'];
		$link = Partial::link_direct($page, base_url('pages/'), [$apps, $page_view, "tambah", $id_pesanan, $fai->input('form-grup')], 'menu', 'just_link');

		// echo $id_pesanan;
		// echo $link;
		echo '<script>
		 setTimeout(function() {
		 	window.location.href="' . $link . '";
		 }, 1000);
		 </script>';
	}
	public static function update_detail($page, $id_api, $id_erp_pos_utama)
	{
		// echo $id_erp_pos_utama;
		$fai = new MainFaiFramework();
		$erp_utama = [];
		$erp_do = [];
		if ($fai->input('nama_pengirim')) {
			$erp_utama['nama_pengirim'] = $fai->input('nama_pengirim');
			$erp_do['nama_pengirim'] = $fai->input('nama_pengirim');
		}
		if ($fai->input('no_telp_pengirim')) {
			$erp_utama['no_telepon_pengirim'] = $fai->input('no_telp_pengirim');
			$erp_do['nomor_pengirim'] = $fai->input('no_telp_pengirim');
		}
		if ($fai->input('nama_penerima')) {
			$erp_utama['nama_penerima_utama'] = $fai->input('nama_penerima');
			$erp_do['nama_penerima'] = $fai->input('nama_penerima');
		}
		if ($fai->input('pesan')) {
			$erp_utama['pesan'] = $fai->input('pesan');
			$erp_do['pesan_pengiriman'] = $fai->input('pesan');
		}
		if ($fai->input('no_telp_penerima')) {
			$erp_utama['nama_penerima_utama'] = $fai->input('no_telp_penerima');
			$erp_do['no_penerima'] = $fai->input('no_telp_penerima');
		}
		if ($fai->input('no_telp_pengirim')) {
			$erp_utama['no_telepon_pengirim'] = $fai->input('no_telp_pengirim');
			$erp_do['nomor_pengirim'] = $fai->input('no_telp_pengirim');
		}
		if ($fai->input('alamat_pengirim')) {
			$erp_utama['id_kirim_dari'] = $fai->input('alamat_pengirim');
			$db_bangunan = [];
			$db_bangunan['utama'] = 'inventaris__asset__tanah__bangunan';
			$db_bangunan['where'][] = array('cast(inventaris__asset__tanah__bangunan.id as SIGNED)', '=', $fai->input('alamat_pengirim'));
			$get_db_bangunan = Database::database_coverter($page, $db_bangunan, [], 'all');
			$erp_do['id_bangunan_asal'] = $fai->input('alamat_pengirim');
			$erp_do['id_provinsi_asal'] = $get_db_bangunan['row'][0]->id_provinsi;
			if ($get_db_bangunan['row'][0]->id_kota)
				$erp_do['id_kota_asal'] = $get_db_bangunan['row'][0]->id_kota;
			if ($get_db_bangunan['row'][0]->id_kecamatan)
				$erp_do['id_kecamatan_asal'] = $get_db_bangunan['row'][0]->id_kecamatan;
			if ($get_db_bangunan['row'][0]->id_kelurahan)
				$erp_do['id_kelurahan_asal'] = $get_db_bangunan['row'][0]->id_kelurahan;
			if ($get_db_bangunan['row'][0]->rt)
				$erp_do['rt_asal'] = $get_db_bangunan['row'][0]->rt;
			if ($get_db_bangunan['row'][0]->rw)
				$erp_do['rw_asal'] = $get_db_bangunan['row'][0]->rw;
			if ($get_db_bangunan['row'][0]->nomor_bangunan)
				$erp_do['no_bangunan_asal'] = $get_db_bangunan['row'][0]->nomor_bangunan;
			if ($get_db_bangunan['row'][0]->nomor_bangunan)
				$erp_do['nomor_asal'] = $get_db_bangunan['row'][0]->nomor_bangunan;

			if ($get_db_bangunan['row'][0]->alamat)
				$erp_do['alamat_asal'] = $get_db_bangunan['row'][0]->alamat;
			$erp_do['nomor_asal'] = $get_db_bangunan['row'][0]->nomor_bangunan;
		}
		if ($fai->input('alamat_penerima')) {
			$erp_utama['id_kirim_ke'] = $fai->input('alamat_penerima');
			$db_bangunan = [];
			$db_bangunan['utama'] = 'inventaris__asset__tanah__bangunan';
			$db_bangunan['where'][] = array('cast(inventaris__asset__tanah__bangunan.id as SIGNED)', '=', $fai->input('alamat_penerima'));
			$get_db_bangunan = Database::database_coverter($page, $db_bangunan, [], 'all');
			$erp_do['id_bangunan_tujuan'] = $fai->input('alamat_penerima');
			if ($get_db_bangunan['row'][0]->id_provinsi)
				$erp_do['id_provinsi_tujuan'] = $get_db_bangunan['row'][0]->id_provinsi;
			if ($get_db_bangunan['row'][0]->id_kota)
				$erp_do['id_kota_tujuan'] = $get_db_bangunan['row'][0]->id_kota;
			if ($get_db_bangunan['row'][0]->id_kecamatan)
				$erp_do['id_kecamatan_tujuan'] = $get_db_bangunan['row'][0]->id_kecamatan;
			if ($get_db_bangunan['row'][0]->id_kelurahan)
				$erp_do['id_kelurahan_tujuan'] = $get_db_bangunan['row'][0]->id_kelurahan;
			if ($get_db_bangunan['row'][0]->rt)
				$erp_do['rt_tujuan'] = $get_db_bangunan['row'][0]->rt;
			if ($get_db_bangunan['row'][0]->rw)
				$erp_do['rw_tujuan'] = $get_db_bangunan['row'][0]->rw;
			if ($get_db_bangunan['row'][0]->alamat)
				$erp_do['alamat_tujuan'] = $get_db_bangunan['row'][0]->alamat;
			if ($get_db_bangunan['row'][0]->nomor_bangunan)
				$erp_do['nomor_tujuan'] = $get_db_bangunan['row'][0]->nomor_bangunan;
		}
		if ($fai->input('kode_booking')) {
			$erp_utama['kode_booking_utama'] = $fai->input('kode_booking');
			$erp_do['kode_booking'] = $fai->input('kode_booking');
		}
		if ($fai->input('nomor_resi')) {
			$erp_utama['no_resi_utama'] = $fai->input('nomor_resi');
			$erp_do['nomor_resi'] = $fai->input('nomor_resi');
		}
		if ($fai->input('ongkir')) {
			$erp_utama['biaya_pengiriman'] = $fai->input('ongkir');
			$erp_do['ongkir'] = $fai->input('ongkir');
			$erp_do['ongkir_akhir'] = $fai->input('ongkir');
		}
		if ($fai->input('service')) {
			$erp_do['paket_ongkir'] = $fai->input('service');
			$explode = explode('-', $fai->input('service'));
			$db = [];
			$db['utama'] = "webmaster__ekspedisi";
			$db['np'] = "webmaster__ekspedisi";
			$db['where'][] = ["webmaster__ekspedisi.kode_ekspedisi", "=", "'" . $explode[0] . "'"];
			$get = Database::database_coverter($page, $db, [], 'all');
			if ($get['num_rows']) {
				$id_ekspedisi = $get['row'][0]->id;
			} else {
				$sqli_ekpedisi = [];
				$sqli_ekpedisi['kode_ekspedisi'] = $explode[0];
				$sqli_ekpedisi['nama_ekspedisi'] = $explode[0];
				CRUDFunc::crud_insert($fai, $page, $sqli_ekpedisi, [], 'webmaster__ekspedisi');;
				$db['utama'] = "webmaster__ekspedisi";
				$db['np'] = "webmaster__ekspedisi";
				$db['where'][] = ["webmaster__ekspedisi.kode_ekspedisi", "=", "'" . $explode[0] . "'"];
				$get = Database::database_coverter($page, $db, [], 'all');
				$id_ekspedisi = $get['row'][0]->id;
			}

			$db = [];
			$db['utama'] = "webmaster__ekspedisi__service";
			$db['np'] = "webmaster__ekspedisi__service";
			$db['where'][] = ["webmaster__ekspedisi__service.kode_service", "=", "'" . $explode[1] . "'"];
			$db['where'][] = ["webmaster__ekspedisi__service.id_webmaster__ekspedisi", "=",  $id_ekspedisi];
			$get = Database::database_coverter($page, $db, [], 'all');
			if ($get['num_rows']) {
				$id_service = $get['row'][0]->id;
			} else {
				$sqli_service = [];
				$sqli_service['kode_service'] = $explode[1];
				$sqli_service['nama_service'] = $explode[1];
				$sqli_service['id_webmaster__ekspedisi'] = $id_ekspedisi;
				CRUDFunc::crud_insert($fai, $page, $sqli_service, [], 'webmaster__ekspedisi__service');;
				$db['utama'] = "webmaster__ekspedisi__service";
				$db['np'] = "webmaster__ekspedisi__service";
				$db['where'][] = ["webmaster__ekspedisi__service.kode_service", "=", "'" . $explode[1] . "'"];
				$db['where'][] = ["webmaster__ekspedisi__service.id_webmaster__ekspedisi", "=",  $id_ekspedisi];
				$get = Database::database_coverter($page, $db, [], 'all');
				$id_service = $get['row'][0]->id;
			}
			$erp_do['id_ekpedisi'] = $id_ekspedisi;
			$erp_do['id_service'] = $id_service;
		}
		if ($fai->input('estimasi_kirim')) {
			$erp_do['estimasi_kirim'] = $fai->input('estimasi_kirim');
		}
		if ($fai->input('status')) {
			$erp_utama['status'] = $fai->input('status');
		}
		if (count($erp_utama)) {

			CRUDFunc::crud_update($fai, $page, $erp_utama, [], [], [], 'erp__pos__utama', 'id', $id_erp_pos_utama);
		}
		if (count($erp_do)) {
			$count['utama'] = "erp__pos__delivery_order";
			$count['np'] = "erp__pos__delivery_order";
			$count['where'][] = ["erp__pos__delivery_order.id_erp__pos__utama", "=", "$id_erp_pos_utama"];
			$get_count = Database::database_coverter($page, $count, [], 'all');

			if ($get_count['num_rows']) {

				CRUDFunc::crud_update($fai, $page, $erp_do, [], [], [], 'erp__pos__delivery_order', 'id_erp__pos__utama', $id_erp_pos_utama);
			} else {
				$erp_do['id_erp__pos__utama'] = $id_erp_pos_utama;
				$erp_do['tanggal_do'] = date('Y-m-d');
				$erp_do['id_store_ongkir'] = "WORKSPACE_SINGLE_TOKO|";
				// $erp_do['nomor_do'] = date('Y-m-d');

				CRUDFunc::crud_insert($fai, $page, $erp_do, [], 'erp__pos__delivery_order');;
			}
		}
		echo '<script>
		setTimeout(function() {
			window.history.back(); // Mengarahkan kembali ke halaman sebelumnya
		}, 1000);
		</script>';

		die;
	}
	public static function hapus_cart($page, $id_api, $user_id, $seq)
	{
		// echo $id_detail;
		ApiContent::hapus_cart($page, $id_api, $user_id, $seq);
		die;
	}
	public static function hapus_cart_web($page, $id_api, $id_detail)
	{

		$fai = new MainFaiFramework();
		CRUDFunc::crud_update($fai, $page, ["active" => 0], [], [], [], 'erp__pos__utama__detail', 'id', $id_detail);
		die;
	}
	public static function konfirmasi_pembayaran($page, $type, $id)
	{

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "erp__pos__payment__bayar__konfirm";
		$primary_key = null;

		$array = array(
			array("Pembayaran", "id_erp__pos__payment__bayar", "select", array('erp__pos__payment__bayar', null, 'jumlah_bayar'), null),

			array("Informasi pembayaran", null, "div"),
			array("Nama Rekening Pengirim", null, "text"),
			array("Nomor rekening Pengirim", "", "text"),
			array("Tanggal Pembayaran", "", "date"),
			array("Catatan", "", "text"),


		);


		$page['crud']['array'] = $array;
		$page['crud']['search'] = [];


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*",);;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		// $page['get']['sidebarIn'] = true;;
		return $page;
	}
	public static function invoice()
	{
		$i = 0;
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template";
		$website['content'][$i]['template_name'] = "beegrit";
		$website['content'][$i]['template_file'] = "ecommerce/invoice.template";
		$website['content'][$i]['database_refer'] = "Invoice";
		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'NOMOR-INVOICE',
				"refer" => "database",
				"database_refer" => "Invoice",
				"row" => "nomor_invoice",
			),
			array(
				"tag" => 'TANGGAL-INVOICE',
				"refer" => "database_function",
				"database_refer" => "Invoice",
				"struktur" => "!!!",
				"row" => "tanggal_invoice",
				"class" => "Partial",
				"function" => "tgl_indo",
				"parameter" => ["ARRAYWEBSITE_THISROW|"],
			),
			array(
				"tag" => 'PRODUK',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'invoice'),
				"get_result" => "table",
			),
			array(
				"tag" => 'SUMMARY',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'invoice'),
				"get_result" => "summary",
			),
			array(
				"tag" => 'PEMBAYARAN',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'invoice'),
				"get_result" => "pembayaran",
			),
			array(
				"tag" => 'KIRIM-KE',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/invoice_alamat.template",
				"database_refer" => "BANGUNAN_KE",
				'array' => array(
					'ID' => array(
						"refer" => "database",
						"row" => "primary_key",
					),

					'NAMA' => array(
						"refer" => "string_database",
						"row" => "row:nama_lengkap!Invoice|",
					),
					'NOMOR-HP' => array(
						"refer" => "string_database",
						"row" => "row:nomor_handphone!Invoice|",
					),
					'EMAIL' => array(
						"refer" => "string_database",
						"row" => "row:email!Invoice|",
					),
					'NAMA-UNIT' => array(
						"refer" => "database",
						"row" => "nama_unit_bangunan",
					),
					'ALAMAT' => array(
						"refer" => "database",
						"row" => "alamat",
					),
					'RT' => array(
						"refer" => "database",
						"row" => "rt",
					),
					'RW' => array(
						"refer" => "database",
						"row" => "rw",
					),
					'KECAMATAN' => array(
						"refer" => "database",
						"row" => "subdistrict_name",
					),
					'KOTA' => array(
						"refer" => "database",
						"row" => "kota_name",
					),
					'KOTA-TYPE' => array(
						"refer" => "database",
						"row" => "type",
					),
					'KELURAHAN' => array(
						"refer" => "database",
						"row" => "urban",
					),
					'KODE-POS' => array(
						"refer" => "database",
						"row" => "postal_code",
					),
					'PROVINSI' => array(
						"refer" => "database",
						"row" => "provinsi",
					),
					'NOMOR' => array(
						"refer" => "database",
						"prefix" => " No.",
						"row" => "nomor_bangunan",
					),
				)
			),
		);

		$page['view_layout'][] = array("website", "col-md-12", $website);


		// ALUR PENDAFTARAN
		/*
        1. Konfirmasi Produk & alamat pengiriman
        2. Voucher & Pengiriman
        3. Pembayaran lewat Apa
        */




		$page['config']['database']['Invoice']['select'][] = '*';
		$page['config']['database']['Invoice']['select'][] = 'erp__pos__group.id_kirim_ke';
		$page['config']['database']['Invoice']['utama'] = 'erp__pos__group';
		$page['config']['database']['Invoice']['join'][] = array("apps_user", "apps_user.id_apps_user", "erp__pos__group.id_apps_user");
		$page['config']['database']['Invoice']['join'][] = array("erp__pos__payment", "erp__pos__payment.id", "erp__pos__group.id_payment");
		$page['config']['database']['Invoice']['where'][] = array("erp__pos__group.id", "=", "{LOAD_ID}");
		$page['config']['database']['Invoice']['primary_key'] = null;
		$page['config']['database']['Invoice']['np'] = null;




		$page['config']['database']['BANGUNAN_KE']['utama'] = 'inventaris__asset__tanah__bangunan';
		$page['config']['database']['BANGUNAN_KE']['primary_key'] = null;
		$page['config']['database']['BANGUNAN_KE']['np'] = null;
		$page['config']['database']['BANGUNAN_KE']['select'][] = '*';
		$page['config']['database']['BANGUNAN_KE']['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key';
		// $page['config']['database']['BANGUNAN_KE']['select'][] = '(select id_kirim_ke from erp__pos__utama join apps_user on apps_user.id_apps_user = erp__pos__utama where erp__pos__utama.id={LOAD_ID}) as id_kirim_ke';

		// $page['config']['database']['BANGUNAN_KE']['join'][] = array("inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "id_inventaris__asset__tanah__bangunan");
		$page['config']['database']['BANGUNAN_KE']['join'][] = array("webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi");
		$page['config']['database']['BANGUNAN_KE']['join'][] = array("webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota");
		$page['config']['database']['BANGUNAN_KE']['join'][] = array("webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan");
		$page['config']['database']['BANGUNAN_KE']['join'][] = array("webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan");
		$page['config']['database']['BANGUNAN_KE']['where'][] = array("inventaris__asset__tanah__bangunan.id", "=", "(select id_kirim_ke from erp__pos__group where erp__pos__group.id={LOAD_ID})");
		$page['config']['database']['BANGUNAN_KE']['where'][] = array("inventaris__asset__tanah__bangunan.id_kota", " is ", " not null");



		return $page;
	}
	public static function checkout($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "codepen";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "checkout-page";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function payment($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "hibe3";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "payment-page";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function bayar($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "hibe3";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "bayar-page";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function sukses_bayar($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "hibe3";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "sukses_bayar-page";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function pesanan_saya($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "hibe3";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "pesanan_saya";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function pesanan_saya_detail($page)
	{

		$i = 0;

		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "template_content";
		$website['content'][$i]['template_class'] = "hibe3";
		// $website['content'][$i]['db_list'] = "home_banner";
		$website['content'][$i]['template_function'] = "pesanan_saya_detail";



		$page['view_layout'][] = array("website", "col-md-12", $website);
		return $page;
	}
	public static function checkout2($page)
	{
		unset($page['view_layout']);
		$i = 0;
		$fai = new MainFaiFramework();
		// DB::queryRaw($page, "update erp__pos__pra_order 
		// set status_pra_order = 'Pemesanan' where id in (select id_cart from erp__pos__utama__detail where id_erp__pos__group= {LOAD_ID})");
		// $pemesanan_detail = DB::get('all',$page);
		// // DB::queryRaw($page, "update erp__pos__utama
		// // set status = 'Pemesanan' where id_erp__pos__group =  {LOAD_ID}");
		// // $pemesanan_detail = DB::get();
		// // DB::queryRaw($page, "update erp__pos__group
		// // set status = 'Pemesanan' where id  = {LOAD_ID}");
		// // $pemesanan_detail = DB::get();
		//         $page_temp = $fai->apps("Inventaris_aset","bangunan"); 
		$page['crud']['wizard_form'] = Inventaris_aset::bangunan()['crud']['wizard_form'];

		/*
		select smp.* from crm__mitra_penjualan cmp  
LEFT JOIN store__mitra on store__mitra.id = cmp.id_store__mitra 
LEFT JOIN store__mitra__presetase smp  on smp.id_store__mitra  = store__mitra.id
where id_apps_user = '20260106175246651956'
		*/
		$website['content'][$i]['tag'] = "BANNER";
		$website['content'][$i]['content_source'] = "file_bundles_database";
		$website['content'][$i]['template_code'] = "BE3-ECOMMERCE-CHECKOUT";
		$website['content'][$i]['template_name'] = "beegrit";
		$website['content'][$i]['template_file'] = "ecommerce/checkout.template";
		$website['content'][$i]['template_array'] = array(
			array(
				"tag" => 'TITLE',
				"refer" => "text",
				"value" => "",
			),

			array(
				"tag" => 'SUBTITLE',
				"refer" => "text",
				"value" => "."
			),

			array(


				"tag" => 'BUAT_INVOICE',
				"refer" => "link",
				"route_type" => "costum_link",
				"link" => array("Ecommerce", "buat_invoice", "id_web__apps|", "{LOAD_ID}", "ID_PANEL|")
			),

			array(
				"tag" => 'PRODUK-TABLE',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'checkout'),
				"get_result" => "table",
			),
			array(
				"tag" => 'ONGKIR-TABLE',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'checkout'),
				"get_result" => "ongkir",
			),
			array(
				"tag" => 'IDPESANAN',
				"refer" => "text",
				"value" => "{LOAD_ID}",
			),
			array(
				"tag" => 'SUMMARY',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "print_pesanan",
				"parameter" => array('{LOAD_ID}', 'checkout'),
				"get_result" => "summary",
			),
			array(
				"tag" => 'TO_SCRIPT',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "script_checkout",
				"parameter" => array('checkout'),
			),
			array(
				"tag" => 'TO_SCRIPT',
				"refer" => "function",
				"struktur" => "App",
				"class" => "EcommerceApp",
				"function" => "update_database_checkout",
				"parameter" => array('checkout'),
			),
			array(
				"tag" => 'KIRIM-KE',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/checkout_kirim_ke.template",
				"database_refer" => "BANGUNAN",
				'array' => array(
					'ID' => array(
						"refer" => "database",
						"row" => "primary_key2",
					),
					"CHECKED" => array(
						"refer" => "if_database_to_text",
						"source_database" => "database_list_template",
						"row" => "primary_key2",
						"if_value" => array(
							"row:id_kirim_ke!database|" => 'checked',
						),
						"if_else" => ''
					),
					'NAMA-UNIT' => array(
						"refer" => "database",
						"row" => "nama_unit_bangunan",
					),
					'ALAMAT' => array(
						"refer" => "database",
						"row" => "alamat",
					),
					'RT' => array(
						"refer" => "database",
						"row" => "rt",
					),
					'RW' => array(
						"refer" => "database",
						"row" => "rw",
					),
					'KECAMATAN' => array(
						"refer" => "database",
						"row" => "subdistrict_name",
					),
					'KOTA' => array(
						"refer" => "database",
						"row" => "kota_name",
					),
					'KOTA-TYPE' => array(
						"refer" => "database",
						"row" => "type",
					),
					'KELURAHAN' => array(
						"refer" => "database",
						"row" => "urban",
					),
					'KODE-POS' => array(
						"refer" => "database",
						"row" => "postal_code",
					),
					'PROVINSI' => array(
						"refer" => "database",
						"row" => "provinsi",
					),
					'NOMOR' => array(
						"refer" => "database",
						"prefix" => " No.",
						"row" => "nomor_bangunan",
					),
				)
			),
			array(
				"tag" => 'LIST-PEMBAYARAN',
				"refer" => "database_list",
				"source_list" => "template",
				"template_name" => "beegrit",
				"template_file" => "ecommerce/checkout_pembayaran.template",
				"database_refer" => "PAYMENT",
				'array' => array(
					'NAMA-PAYMENT' => array(
						"refer" => "database",
						"row" => "nama_payment",
					),
					'ID' => array(
						"refer" => "database",
						"row" => "primary_key",
					),
					"CHECKED" => array(
						"refer" => "if_database_to_text",
						"source_database" => "database_list_template",
						"row" => "primary_key",
						"if_value" => array(
							"row:id_payment_method!database|" => 'checked',
						),
						"if_else" => ''
					),
					'BRAND' => array(
						"refer" => "database_list",
						"source_database" => "database",
						"template_name" => "beegrit",
						"template_file" => "ecommerce/checkout_pembayaran_brand.template",

						"database_refer" => -1,
						"database" => array(
							"utama" => "webmaster__payment_method_brand",
							"select" => [
								"*",
								"concat(webmaster__payment_method_brand.id,'-',webmaster__payment_webapps.id)  as id_primary_key",
								"(select erp__pos__utama.id_payment_brand from  erp__pos__payment 
									left join erp__pos__payment__bayar on erp__pos__payment__bayar.id_erp__pos__payment =erp__pos__payment.id  
									left join erp__pos__utama on erp__pos__utama.id =erp__pos__payment.id_order  
									where erp__pos__utama.id={LOAD_ID}) as id_payment_brand",
							],
							"join" => [
								["webmaster__payment_webapps", " webmaster__payment_method_brand.id ", "webmaster__payment_webapps.id_payment_brand and id_webapps = id_web__apps| and id_workspace = ID_BOARD|"]
							],
							// "select_database" => [
							// 	[
							// 		"as" => "id_payment_brand",
							// 		"utama" => "erp__pos__payment",
							// 		"join" => [
							// 			["erp__pos__payment__bayar", "erp__pos__payment__bayar.id_erp__pos__payment", "erp__pos__payment.id  ", "left"],
							// 			["erp__pos__utama", "erp__pos__utama.id", "erp__pos__payment.id_order", "left"]
							// 		],
							// 		"where" => [
							// 			["erp__pos__utama.id", "=", "{LOAD_ID}"]
							// 		],
							// 		"np"=>true,
							// 		"limit"=>1,
							// 	]
							// ],
							"where_get_array" => array(
								array(
									"row" => "id_webmaster__payment_method",
									"array_row" => "database_list_template",
									"get_row" => "primary_key"
								),
							),
						),
						"array" => array(
							'NAMA-BRAND' => array(
								"refer" => "database",
								"row" => "nama_brand",
							),
							'ID' => array(
								"refer" => "database",
								"row" => "id_primary_key",
							),
							"CHECKED" => array(
								"refer" => "if_database_to_text",
								"source_database" => "database_list_template_on_list",
								"row" => "primary_key",
								"if_value" => array(
									"row:id_payment_brand!database_list_template_on_list|" => 'checked',
								),
								"if_else" => ''
							),
						),
					),
				),
			),

		);



		$page['view_layout'][] = array("website", "col-md-12", $website);


		// ALUR PENDAFTARAN
		/*
        1. Konfirmasi Produk & alamat pengiriman
        2. Voucher & Pengiriman
        3. Pembayaran lewat Apa
        */


		// echo 'hl';

		$page['config']['database']['PAYMENT']['select'][] = '*';
		$page['config']['database']['PAYMENT']['select'][] = 'webmaster__payment_method.id as primary_key';
		$page['config']['database']['PAYMENT']['select'][] = '(select erp__pos__group.id_payment_method from erp__pos__payment 
		left join erp__pos__payment__bayar on erp__pos__payment__bayar.id_erp__pos__payment =erp__pos__payment.id  
		left join erp__pos__group on erp__pos__group.id_payment =erp__pos__payment.id 
		where erp__pos__group.id={LOAD_ID}) as id_payment_method';
		$page['config']['database']['PAYMENT']['utama'] = 'webmaster__payment_method';
		$page['config']['database']['PAYMENT']['where'][] = ['webmaster__payment_method.id', ' in ', "
		(SELECT distinct(id_payment_method) as id_payment_method from webmaster__payment_webapps WHERE id_webapps = id_web__apps| and id_workspace = ID_BOARD|)"];
		$page['config']['database']['PAYMENT']['primary_key'] = null;

		$page['config']['database']['BANGUNAN']['utama'] = 'inventaris__asset__tanah__bangunan__pengisi';
		$page['config']['database']['BANGUNAN']['primary_key'] = null;
		$page['config']['database']['BANGUNAN']['np'] = true;
		$page['config']['database']['BANGUNAN']['select'][] = '*';
		$page['config']['database']['BANGUNAN']['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key2';
		$page['config']['database']['BANGUNAN']['select'][] = '(select id_kirim_ke from erp__pos__group where erp__pos__group.id={LOAD_ID}) as id_kirim_ke';

		$page['config']['database']['BANGUNAN']['join'][] = array("inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan");
		$page['config']['database']['BANGUNAN']['join'][] = array("webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi");
		$page['config']['database']['BANGUNAN']['join'][] = array("webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota");
		$page['config']['database']['BANGUNAN']['join'][] = array("webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan");
		$page['config']['database']['BANGUNAN']['join'][] = array("webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan");
		$page['config']['database']['BANGUNAN']['where'][] = array("cast(inventaris__asset__tanah__bangunan__pengisi.id_apps_user as varchar)", "=", "'{SESSION_UTAMA}'");
		$page['config']['database']['BANGUNAN']['where'][] = array("inventaris__asset__tanah__bangunan.id_kota", " is ", " not null");


		return $page;
	}
	public static function daftar_mitra($page)
	{

		$page =  Pages::Apps('Outsourcing', 'mitra_penjualan');
		return $page;
	}
}
