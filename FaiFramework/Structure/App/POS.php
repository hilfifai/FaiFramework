<?php

class POS extends POS_USER
{
    //Master Data
    public static function list_workspace($page)
    {
        $_SESSION['to_list_workspace_id_apps'] = Partial::get_id_apps($page);
        $page = Workspace::workspace_apps($page);
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function Dashboard_workspace($page)
    {

        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        // 		array("CARD-NUMBER-TEXT"=>array(
        // 							"dataType"=>"database",
        // 							"database_refer"=>"Dashboard-Query",
        // 							"database_row" => "jumlah_organisasi"
        // 							)),
        // 	),

        // )),
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Total Penjualan",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "123",
            ),
        );
        $i++;

        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Total Diskon",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "122",
            ),
        );
        $i++;

        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Total Omzet",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "122",
            ),
        );
        $page['view_layout'][] = array("website", "col-md-12", $website);

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function croscheck($page)
    {
        $i = 0;


        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "dashuipro";
        $website['content'][$i]['template_file'] = "pricing.template";
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
            array(
                "tag" => 'PRICING',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Group",
                "template_name" => "dashuipro",
                "template_file" => "pricinggroup.template",
                "array" => array(
                    "TITLE" => array("refer" => "database", "row" => "nama_group"),
                    "SUBTITLE" => array("refer" => "database", "row" => "deskripsi_group"),
                    "PRICING-LIST" => array(
                        "refer" => "database_list",
                        "database_refer" => "-1",
                        "database" => array(
                            "utama" => "web__list_apps_paket_list",
                            "primary_key" => null,
                            "select_raw" => "*",


                            "where_get_array" => array(
                                array(
                                    "row" => "{IDPRIMARY}group{/IDPRIMARY}",
                                    "array_row" => "database_list_template",
                                    "get_row" => "primary_key"
                                ),
                            )
                        ),
                        "template_name" => "dashuipro",
                        "template_file" => "pricingdetail.template",
                        "array" => array(
                            "TITLE" => array("refer" => "database", "row" => "nama_paket"),
                            "DESKRIPSI" => array("refer" => "database", "row" => "deskripsi_paket"),
                            "LINK" => array("refer" => "link", "route_type" => "costum_link", "link" => array("POS", "save_proses", "id_web__apps|", "LOAD_STEP|", "{LOAD_ID}", "row:id!database_list_template_on_list|")),
                            "HARGA" => array("refer" => "database", "row" => "harga_utama", "function" => array("class" => "Partial", "function" => "rupiah", "parameter" => array("this_value", "0"))),
                            "PREFIXHARGA" => array("refer" => "if_database_to_text", "source_database" => "database_list_template_on_list", "row" => "tipe_harga", "if_value" => array(0 => "Rp. ", 1 => "")),
                            "SUFFIXHARGA" => array("refer" => "if_database_to_text", "source_database" => "database_list_template_on_list", "row" => "tipe_harga", "if_value" => array(0 => ",-", 1 => "%")),
                            "EXTEND-HARGA" => array("refer" => "database", "row" => "extend_paket"),
                            "LIST-DETAIL" => array(
                                "refer" => "database_list",
                                "database_refer" => "-1",
                                "database" => array(
                                    "utama" => "web__list_apps_paket_list__detail",
                                    "primary_key" => null,
                                    "select_raw" => "*",

                                    "join" => array(
                                        array("web__list_apps_paket_elemen", "id_elemen", "web__list_apps_paket_elemen.id")
                                    ),
                                    "where_get_array" => array(
                                        array(
                                            "row" => "web__list_apps_paket_list__detail.{IDPRIMARY}web__list_apps_paket_list{/IDPRIMARY}",
                                            "array_row" => "database_list_template",
                                            "get_row" => "primary_key"
                                        ),
                                    )
                                ),
                                "template_name" => "dashuipro",
                                "template_file" => "pricingdetail_list.template",
                                "array" => array(
                                    "TEXT" => array("refer" => "database", "row" => "nama_elemen"),
                                    "ICON" => array(
                                        "refer" => "if_database_to_text",
                                        "source_database" => "database_list_template_on_list",
                                        "row" => "checklist",
                                        "if_value" => array(
                                            0 => '<span class="text-danger icon-xs" style="font-size:10px"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle  icon-xs"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></span>', 1 => '<span class="text-success icon-xs" style="font-size:10px"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle  icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>'
                                        )
                                    ),

                                ),
                            ),
                        )
                    ),
                )
            ),
        );

        $step['parameter_check']['get_data'] = "refer";
        $step['parameter_check']['database_refer'] = "Table Board";
        $step['parameter_check']['row_data'] = "step";
        $step['parameter_check']['redirect'] = array("POS", "Apps", 'view_layout', '{load_id}');

        $step['wizard']["type"] =  "wizard";
        $step['wizard']["first"] =  1;
        $i = 1;
        $step['wizard']["step"][$i]['view'] =  "view_website";
        $step['wizard']["step"][$i]['next'] =  -1;
        $step['wizard']["step"][$i]['var_content'] =  "paket";
        $i++;
        $step['wizard']["step"][$i]['view'] =  "crud";
        $step['wizard']["step"][$i]['var_content'] =  "entitas";


        $step['content']['paket'] = $website;
        $step['content']['entitas'] = array(
            array("Entitas Terkoneksi", null, "text"),
        );


        $page['view_layout'][] = array("step", "col-md-12", $step);


        // ALUR PENDAFTARAN
        /*
        1. pilih paket
        2. pilih aplikasi tambahan
        3. setting struktural bawahan pengendali dan pilih entitas terkoneksi
        3. pembayaran | bisa terdapat opsi trial

        */


        $page['config']['database']['Group']['utama'] = 'web__list_apps_paket_group';
        $page['config']['database']['Group']['primary_key'] = null;
        $page['config']['database']['Group']['where'][] = array("id_apps", "=", "ID_APPS|");

        $page['config']['database']['Table Board']['utama'] = 'web__list_apps_board';
        $page['config']['database']['Table Board']['primary_key'] = null;
        $page['config']['database']['Table Board']['where'][] = array("web__list_apps_board.id", "=", "{LOAD_ID}");


        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function apps($page)
    {
    }

    // public static function save_proses($page, $step = "", $load_id = "", $id_paket = "", $param5 = "")
    // {
    //     //echo $load_id;
    //     if ($step == 1) {
    //         DB::connection($page);
    //         $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket_list where id = $id_paket"));
    //         //print_r($db);

    //         $data["tagihan_term_per"] = "'" . $db[0]->tagihan_term_per . "'";
    //         $data["step"] = $step;
    //         $data["tagihan_term_frekuensi"] = $db[0]->tagihan_term_frekuensi;
    //         $data["id_paket"] = $id_paket;
    //         $data["pembayaran_total"] = $db[0]->harga_utama;
    //         $data["pembayaran_selanjutnya"] = "'" . date('Y-m-d') . "'";

    //         // DB::table("web__list_apps_board");
    //         // DB::whereRaw("web__list_apps_board.id","$load_id");
    //         DB::update("web__list_apps_board", $data, [["web__list_apps_board.id", "=", "$load_id"]], 'Where Array');

    //         $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket_list__detail
    //     left join web__list_apps_paket_elemen on id_elemen = web__list_apps_paket_elemen.id
    //     left join web__list_apps_tipe_paket on id_paket_apps = web__list_apps_tipe_paket.id
    //     where id_web__list_apps_paket_list = $id_paket"));

    //         foreach ($db as $db) {
    //             unset($data);
    //             if ($db->id_koneksi_apps) {
    //                 $data['id_apps'] = $db->id_koneksi_apps;
    //                 $data['tipe_menu'] = $db->tipe_menu;
    //                 $data['data_apps'] = $db->data_apps;
    //                 $data['id_web__list_apps_board'] = $load_id;

    //                 DB::insert("web__list_apps_board__apps", $data);
    //             }
    //         }
    //     }
    // }

    public static function menu_basic()
    {
        //nama/link/icon
        $menu = array(
            // array("menu", "Dashboard", array("", "", "", ""), ""),


            // array("group", "Master"),
            // array("menu", "Toko", array("Store", "Toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Table", array("POS", "meja", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Costumer", array("POS", "pelanggan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Ekspedisi", array("POS", "ekspedisi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Ser", array("POS", "payment_method", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


            // array("group", "Store Produk & Harga"),
            // array("menu", "Bundle Harga", array("Store", "bundle_harga", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Toko", array("Store", "Toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Produk", array("Store", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Paket", array("POS", "paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Ulasan", array("POS", "ulasan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("group", "Mitra"),
            // array("menu", "Tipe Mitra Store", array("Store", "tipe_mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //array("menu", "Data Mitra", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


            // array("group", "Promosi"),
            // array("menu", "Tipe Promo", array("POS", "tipe_promo", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Promo ", array("POS", "promo", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            // array("menu", "Promo Toko", array("POS", "promo_toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Promo Costumer", array("POS", "promo_costumer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Promo Ongkir", array("POS", "promo_ongkir", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Voucher", array("POS", "vourcer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Iklan", array("POS", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),



            array(
                "group", "Payment Api", array(
                    array("menu", "Payment Api", array("POS", "payment_api", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),

            array(
                "group", "Penjualan Offline", array(
                    array("menu", "Kasir", array("POS", "offline_kasir", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Jual", array("POS", "offline_retur_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),

            array("group", "Penjualan Media Sosial", array(),),
            array("group", "Penjualan Tenant", array(),),
            array("group", "Penjualan Bazar", array(
                array("menu", "Request Barang", array("POS", "bazar__", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            ),),
            array(
                "group", "Penjualan Ecomerce Hibe3.com", array(
                    array("menu", "Cart/Quotation", array("POS", "online__cart", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pemesanan", array("POS", "online__pemesanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Invoice", array("POS", "online__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Payment", array("POS", "online__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Outgoing", array("POS", "online__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Delivery Order", array("POS", "online__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Jual", array("POS", "online__retur_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array(
                "group", "Pre Order", array(
                    array("menu", "Master Pre Order", array("POS", "preorder", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Purchase Request", array("POS", "purchase_request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Outgoing", array("POS", "outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Outgoing", array("POS", "retur outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array(
                "group", "Penjualan Supplier", array(
                    array("menu", "Quotation Supplier", array("POS", "supplier__quotation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Sales Order Supplier", array("POS", "supplier__sales_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Invoice", array("POS", "supplier__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Outgoing", array("POS", "supplier__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Delivery Order ", array("POS", "supplier__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Jual ", array("POS", "supplier__retur_jual", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array(
                "group", "Penjualan Distributor", array(
                    array("menu", "Quotation", array("POS", "distributor__quotation", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Sales Order", array("POS", "distributor__sales_order", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Delivery Order", array("POS", "distributor__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Outgoing", array("POS", "distributor__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Jual", array("POS", "distributor__retur_jual", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array(
                "group", "Penjualan Mitra", array(
                    array("menu", "Sales Order", array("POS", "mitra__sales_order", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Delivery Order", array("POS", "mitra__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Outgoing", array("POS", "mitra__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Retur Jual ", array("POS", "mitra__retur_jual", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array(
                "group", "Report", array(
                    array("menu", "Report Purchase Order", array("POS", "report_po", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Report Kontrabon", array("POS", "kontrabon", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),

        );

        return $menu;
    }
    public static function supplier__quotation($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'sales_quotation', 'erp_full', 'penjual');
        return $page;
    }
    public static function supplier__sales_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'sales_order', 'erp_full', 'penjual');
        return $page;
    }
    public static function supplier__invoice($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'invoice', 'erp_full', 'penjual');
        return $page;
    }
    public static function supplier__outgoing($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'outgoing', 'erp_full', 'penjual');
        return $page;
    }
    public static function supplier__delivery_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'delivery_order', 'erp_full', 'penjual');
        return $page;
    }
    public static function supplier__retur_jual($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'retur', 'erp_full', 'penjual');
        return $page;
    }
    public static function distributor__delivery_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'delivery_order', 'erp_full', 'penjual');
        return $page;
    }
    public static function distributor__retur_jual($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'delivery_order', 'erp_full', 'penjual');
        return $page;
    }
    public static function online__cart($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'cart', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__pemesanan($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'sales_order', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__invoice($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'invoice', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'payment', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__outgoing($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'outgoing', 'pos_full', 'pembeli');
        return $page;
    }
    public static function all_receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'All', 'receive', 'pos_full', 'pembeli');
        return $page;
    }
    public static function stok_opname($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'All', 'stok_opname', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__delivery_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'delivery_order', 'pos_full', 'pembeli');
        return $page;
    }
    public static function online__retur_jual($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'retur_outgoing', 'pos_full', 'pembeli');
        return $page;
    }
    public static function payment_api($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("ID Payment", null, "text"),
            array("From Payment", null, "text"),
            array("Nomor Payment Api", null, "text"),
            array("Tanggal Payment", null, "date"),
            array("Tanggal Bayar", null, "date"),
            array("Tanggal Jatuh Tempo", null, "date"),
            array("Total Bayar", null, "date"),
            array("Jenis Api", null, "select-manual", array("Midtrans" => "Midtrans")),
            array("Status Payment", null, "select-manual", array("Aktif", "Expired", "Selesai")),

        );
        $sub_kategori[] = ["Produk", "" . __FUNCTION__ . "__midtrans", null, "table"];
        $array_sub_kategori[] = array(
            array("Status Code", "status_code", "number"),
            array("Order Id", "order_id", "number"),
            array("", "transaction_id", "text"),
            array("", "merchant_id", "textarea"),
            array("", "gross_amount", "textarea"),
            array("", "currency", "text"),
            array("", "payment_type", "time"),
            array("", "transaction_time", "datetime"),
            array("", "transaction_status", "text"),
            array("", "va_numbers", "textarea"),
            array("", "bank", "text"),
            array("", "store", "text"),
            array("", "payment_code", "text"),
            array("", "date_update", "text"),
            array("", "fraud_status", "text"),
            array("", "status_message", "text"),
            array("", "transaction_data", "text"),


        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function tipe_promo($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Tipe Promo", "nama_tipe_promo", "text"),
        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function promo($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Promo", "kode_promo", "text"),
            array("Nama Promo", "nama_promo", "text"),
            array("Periode Promo Mulai", "periode_promo_mulai", "date"),
            array("Periode Promo Akhir", "periode_promo_akhir", "date"),
            //array("Tipe Promo", "tipe_promo_seq", "select", array("pos__master__tipe_promo", null, "nama_tipe_promo"), null),
            array("Minimul Belanja", "minumum_belanja", "number"),
        );

        $sub_kategori[] = ["Produk", "pos__master__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('pos__master__produk', null, 'nama_produk'), null),

        );
        $sub_kategori[] = ["Paket", "pos__master__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("paket", "paket_seq", "select", array('pos__master__paket', null, 'nama_paket'), null),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['insert_number_code']['kode_promo']['prefix'] = 'Pro.';
        $page['crud']['insert_number_code']['kode_promo']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_promo']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_promo']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_promo']['suffix'] = '';



        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function workspace($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "pos__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("board", null, "select", array("web__list_apps_board", null, 'nama_board')),
            array("Jenis PoS", null, "select", array("webmaster__pos__", null, 'nama_pos')),
        );
        //    $sub_kategori[] = ["User", $database_utama . "__user", null, "table"];
        // 	$array_sub_kategori[] = array(
        // 		array("menu", null, "select", array("web__menu", null, "nama_menu"),null),
        // 	);


        // 	$page['crud']['sub_kategori'] = $sub_kategori;
        // 	$page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $search = array();

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

    public static function akun($page)
    {
        $page['title'] = "Akun";
        $page['route'] = "akun";
        $page['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "users";
        $primary_key = "id";

        $array = array(
            array("Nama", "name", "text"),
            array("Email", "email", "email"),
            array("Username", "username", "text"),
            array("Password", "password", "password"),

            //array("Lokasi","lokasi","text"),

        );

        $page['insert_default_value']['password'] = '$10$A6k5b8HtL4I4sN3S8v6VEOXdCKiKxWgIKyrrz1P8PE11ilznXZ2Wu';
        $page['crud_function']['password'] = 'hash';



        $search = array(-1 => array(4, 1));
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
    public static function kategori($page)
    {
        $page['title'] = "Kategori";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Cabang", "cabang_seq", "select", array('pos__master__cabang', null, 'nama_cabang'), null),
            array("Tampil Di menu", "tampil_di_menu", "select-manual", array(1 => "Ya", 0 => "Tidak")),
            array("Nama Kategori", "nama_kategori", "text"),
            array("Urutan", "urutan", "numeric"),
            array("Departemen", "departemen", "select", array('pos__master__departemen', null, 'nama_departemen'), null),
        );


        $page['crud']['delete_if']['database'] = 'pos__master__produk';
        $page['crud']['delete_if']['where_in_database'] = 'kategori_in_produk_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function cabang($page)
    {
        $page['title'] = "Cabang";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Cabang", "nama_cabang", "text"),
            array("No Wa", "no_wa", "number"),
            array("Alamat Lengkap", "alamat", "textarea"),
            array("Deskripsi", "deskripsi", "textarea"),
        );


        $page['crud']['delete_if']['database'] = 'pos__master__produk';
        $page['crud']['delete_if']['where_in_database'] = 'cabang_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function pelanggan($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos_transaction_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Pelanggan", "kode_pelanggan", "text"),
            array("Nama Pelanggan", "nama_pelanggan", "text"),
            array("Alamat", "alamat", "text"),
            array("No. HP", "no_hp", "text"),
            array("Email", "email", "text"),
            array("Username", "username_pelanggan", "text"),
            array("Password", "password_pelanggan", "password"),
        );

        $page['crud']['insert_number_code']['kode_pelanggan']['prefix'] = 'PL.';
        $page['crud']['insert_number_code']['kode_pelanggan']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_pelanggan']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_pelanggan']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_pelanggan']['suffix'] = '';

        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function meja($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos_transaction_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Meja", "kode_Meja", "text"),
            array("Nama Meja", "nama_Meja", "text"),

        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function type_payment_method($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos_transaction_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Meja", "kode_Meja", "text"),
            array("Nama Meja", "nama_Meja", "text"),

        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function payment_method($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos_transaction_" . __FUNCTION__;
        $primary_key = null;



        $array = array(
            array("Nama Payment Method", "kode_Meja", "text"),
            array("Nama Meja", "nama_Meja", "text"),

        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function pemesanan($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos_transaction_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Meja", "kode_Meja", "text"),
            array("Nama Meja", "nama_Meja", "text"),

        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function paket($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Paket", "kode_paket", "text"),
            array("Nama Paket", "nama_paket", "text"),
        );

        $sub_kategori[] = ["Produk", "pos__master__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('pos__master__produk', null, 'nama_produk'), null),
            array("Harga", "harga_produk_paket", "number"),

        );
        $page['crud']['insert_number_code']['kode_paket']['prefix'] = 'PA.';
        $page['crud']['insert_number_code']['kode_paket']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_paket']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_paket']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_paket']['suffix'] = '';

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['delete_if']['database'] = 'pos__master__promo_detail';
        $page['crud']['delete_if']['where_in_database'] = 'produk_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function produk($page)
    {
        $page['title'] = "Produk";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Cabang", "cabang_seq", "select", array('pos__master__cabang', null, 'nama_cabang'), null),
            array("Nama Produk", "nama_produk", "text"),
            array("Gambar Produk", "gambar_produk", "file"),
            array("Kategori", "kategori_in_produk_seq", "select", array('pos__master__kategori', null, 'nama_kategori'), null),
            array("Deskripsi Produk", "deskripsi_produk", "textarea"),
            array("Produk Favorit", "produk_favorit", "select-manual", array(1 => "Ya", 0 => "Tidak")),
            array("Aktifkan Menu di Kasir", "aktifkan_menu_di_kasir", "select-manual", array(1 => "Ya", 0 => "Tidak"))


        );

        $sub_kategori[] = ["Resep", "pos__master__" . __FUNCTION__ . "_resep", null, "table"];
        $array_sub_kategori[] = array(
            array("Bahan Baku", "bahan_baku", "select", array('pos__master__raw_material', null, 'item_name'), null),
            array("Takaran", "takaran", "text"),
            array("Satuan", "satuan", "select", array('pos__master__satuan', null, 'nama_satuan'), null),


        );

        $sub_kategori[] = ["Harga", "pos__master__" . __FUNCTION__ . "_harga", null, "table"];
        $array_sub_kategori[] = array(
            array("Satuan", "satuan", "select", array('pos__master__satuan', null, 'nama_satuan'), null),
            array("Konversi", "konversi", "select", array('pos__master__conversi', null, 'nama_konversi'), null),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga_jual", "number"),
            array("SKU", "sku", "text"),
            array("Minimum Quantity Penjualan", "minimum_quantity_penjualan", "number"),
            // array("Ukuran Volume Panjang","ukuran_volume_panjang","number"),
            //  array("Ukuran Volume Lebar","ukuran_volume_lebar","number"),
            //  array("Ukuran Volume Tinggi","ukuran_volume_tinggi","number"),
            array("Berat", "berat", "number"),
        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function satuan($page)
    {
        $page['title'] = "Unit Satuan";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Satuan", "nama_satuan", "text"),
        );


        $page['crud']['delete_if']['database'] = 'pos__master__raw_material';
        $page['crud']['delete_if']['where_in_database'] = $database_utama . '_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function conversi($page)
    {
        $page['title'] = "Conversi";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Konversi", "nama_konversi", "text"),
            array("Satuan Awal", "satuan_awal_seq", "select", array("pos__master__satuan", null, "nama_satuan", "a"), null),
            array("Operator", "operator", "text"),
            array("Besaran", "besaran", "text"),
            array("Nama Satuan", "satuan_akhir_seq", "select", array("pos__master__satuan", null, "nama_satuan", "b"), null),

            //array("Lokasi","lokasi","text"),

        );



        $page['crud']['delete_if']['database'] = 'pos__master__raw_material';
        $page['crud']['delete_if']['where_in_database'] = 'pos__master__conversi_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function raw_material($page)
    {
        $page['title'] = "Raw Material";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "pos__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Item Code", "item_code", "text"),
            array("Item Name", "item_name", "text"),
            array("Unit", "pos__master__satuan_seq", "select", array("pos__master__satuan", null, "nama_satuan"), null),
            array("Konversi", "pos__master__conversi_seq", "select", array("pos__master__conversi", null, "nama_konversi"), null),
            array("Max Stoct", "max_stoct", "number"),
            array("Min Stock", "min_stock", "number"),

            array("Cons. Departement", "comsumption_pos_departement", "textarea"),


        );
        /*$checking =  $this->checking_database($page, $database_utama);;
        $number = 1;
        if ($checking[0]->exists_) {
            $db = DB::connection($page)->select("SELECT count(*) as count FROM " . $database_utama . " where active = 1 and auto = 1");
            $number = $db[0]->count + 1;
        }
        $page['crud']['insert_autofield']['item_code'] = 'RM.' . sprintf('%04d', $number);
		*/
        $page['crud']['delete_if']['check'] = 'database';
        $page['crud']['delete_if']['database'] = 'pos__purchasing__purchase_order_detail';
        $page['crud']['delete_if']['where_in_database'] = 'pos__master__raw_material_seq';
        $page['crud']['delete_if']['row_data'] = 'primary_key';


        $page['crud']['import_export']['config']['row_check'] = "item_name";
        $page['crud']['import_export']['config']['on_delete'] = false;
        /*
        if ($request->autofield_item_code)
            $page['crud']['insert_default_value']['auto'] = 1;
        else
            $page['crud']['insert_default_value']['auto'] = 0;
	*/
        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }



    //Puchasing

    public static function closed_po($id)
    {
        DB::beginTransaction($page);
        try {
            $idUser = Auth::user($page)->id;
            //print_r($request);die;

            $sqli['status_po'] = "Closed";

            DB::connection($page)->table("pos__purchasing__purchase_order")
                ->where(null, $id)
                ->update($sqli);





            DB::commit($page);

            return redirect($page)->route('purchase_order', ['list', '-1'])->with('success',  'Kontrabon Berhasil di input!');
        } catch (\Exception $e) {
            DB::rollback($page);
            return redirect($page)->back($page)->with('error', $e);
        }
    }
    public static function open_po($id)
    {
        DB::beginTransaction($page);
        try {
            $idUser = Auth::user($page)->id;
            //print_r($request);die;

            $sqli['status_po'] = "Open";

            DB::connection($page)->table("pos__purchasing__purchase_order")
                ->where(null, $id)
                ->update($sqli);





            DB::commit($page);

            return redirect($page)->route('purchase_order', ['list', '-1'])->with('success',  'Kontrabon Berhasil di input!');
        } catch (\Exception $e) {
            DB::rollback($page);
            return redirect($page)->back($page)->with('error', $e);
        }
    }
    public static function js_purchashing($page)
    {
        // return view('support/js_puchasing');
    }
    public static function js_kontrabon($page)
    {
        // return view('support/js_kontrabon');
    }
    public static function js_payment($page)
    {
        return view('support/js_payment');
    }


    //Company Profile
    public static function profile($page)
    {
        $page['title'] = "Company Profile";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = "company_profile";
        $page['crud']['redirect'] = "edit";
        $page['crud']['layout_pdf'] = array('a2', 'landscape');

        $database_utama = "pos_company_profile";
        $primary_key = null;

        $array = array(
            array("Company Name", "company_name", "text"),
            array("Address", "address", "textarea"),
            array("Company Email", "company_email", "email"),
            array("Phone", "phone", "number"),
            array("Website", "website", "text"),
            array("Company Logo", "company_logo", "file"),

            //array("Lokasi","lokasi","text"),

        );



        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();


        $page['crud']['search'] = array(-1 => array(4, 1));
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function pos_departemen($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "pos_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Departemen", "kode_pos_departemen", "text"),
            array("Nama Departemen", "nama_departemen", "text"),
        );



        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();


        $page['crud']['search'] = array();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    //inventory



    public static function js_retur($page)
    {

        //return view('support/js_retur');
    }
    public static function js_receive($page)
    {

        //return view('support/js_receive');
    }
    public static function js_outgoing($page)
    {

        //return view('support/js_outgoing');
    }

    public static function stok($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "pos__master__raw_material";
        $primary_key = null;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['selectRaw'] = "*,$database_utama.$primary_key as primary_key,
		(select sum(qty_receive) from pos__purchasing__receive_detail 
			join pos__purchasing__receive on pos__purchasing__receive_detail.pos__purchasing__receive_seq = pos__purchasing__receive.{IDTABLE}pos__purchasing__receive{/IDTABLE}
		where pos__purchasing__receive_detail.pos__master__raw_material_seq = pos__master__raw_material.seq and pos__purchasing__receive.active=1
		and cek_status=1 and pos__purchasing__receive_detail.active=1
		) as stok_receive,
		(select sum(qty_pesanan) from pos__purchasing__purchase_order_detail 
			join pos__purchasing__purchase_order on pos__purchasing__purchase_order_detail.pos__purchasing__purchase_order_seq = pos__purchasing__purchase_order.seq
		where pos__purchasing__purchase_order_detail.pos__master__raw_material_seq = pos__master__raw_material.seq and pos__purchasing__purchase_order.active=1 
		and appr_status=1
		) as stok_po,
		(select sum(qty_receive_retur) from pos__purchasing__retur_detail
			join pos__purchasing__retur on pos__purchasing__retur_detail.pos__purchasing__retur_seq = pos__purchasing__retur.seq
		where pos__purchasing__retur_detail.pos__master__raw_material_retur_seq = pos__master__raw_material.seq and pos__purchasing__retur.active=1 
		and pos__purchasing__retur_detail.active=1
		) as stok_retur,
		(select sum(qty_outgoing) from pos__purchasing__outgoing_detail
			join pos__purchasing__outgoing on pos__purchasing__outgoing_detail.pos__purchasing__outgoing_seq = pos__purchasing__outgoing.seq
		where pos__purchasing__outgoing_detail.pos__master__raw_material_request_in_outgoing_seq = pos__master__raw_material.seq and pos__purchasing__outgoing.active=1 and pos__purchasing__outgoing_detail.active=1
		and appr_status=1
		) as stok_outgoing,
		(select sum(qty_retur_outgoing) from pos__purchasing__retur_outgoing_detail
			join pos__purchasing__retur_outgoing on pos__purchasing__retur_outgoing_detail.pos__purchasing__retur_outgoing_seq = pos__purchasing__retur_outgoing.seq
		where pos__purchasing__retur_outgoing_detail.pos__master__raw_material_in_retur_outgoing_seq = pos__master__raw_material.seq and pos__purchasing__retur_outgoing.active=1  and pos__purchasing__retur_outgoing_detail.active=1
		and appr_status=1
		) as stok_retur_outgoing, 0 as stok_awal,0 as stok_akhir
		
		";


        $page['crud']['search'] = array();



        $array = array(
            array("Item Code", "item_code", "text"),
            array("Item Name", "item_name", "text"),
            array("Min Stock", "min_stock", "number"),
            array("Max Stoct", "max_stoct", "number"),
            array("Stok Awal", "stok_awal", "text"),
            array("Stok Receive", "stok_receive", "text"),
            array("Stok Retur", "stok_retur", "text"),
            array("Stok Outgoing", "stok_outgoing", "text"),
            array("Stok Retur", "stok_retur_outgoing", "text"),
            array(
                "Stok Akhir", "stok_akhir", "calc",
                array(
                    array("tambah", "stok_awal"),
                    array("tambah", "stok_receive"),
                    array("kurang", "stok_retur"),
                    array("kurang", "stok_outgoing"),
                    array("tambah", "stok_retur_outgoing"),
                )

            ),

            //array("Lokasi","lokasi","text"),

        );


        $page['crud']['no_add'] = true;
        $page['crud']['no_edit'] = true;
        $page['crud']['no_delete'] = true;

        //




        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
}

class POS_USER
{

    public static function user_menu($page)
    {
        $menu = array(
            array("menu", "Order", array("POS", "order_user", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Take Away", array("POS", "meja", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

        );

        return $menu;
    }
    public static function order_user($page)
    {
        $page['app_framework'] = 'laravel';
        $page['database_provider'] = 'mysql';
        $page['database_name'] = 'be3';

        $page['conection_server'] = 'localhost';
        $page['conection_name_database'] = 'be3';
        $page['conection_user'] = 'root';
        $page['conection_password'] = '';




        $page['title'] = "Pesanan";



        $card['listing_type'] = "listing"; //info/listing/listmenu
        $card['default_array'] = "array-menu";
        $card['default_id'] = "card-layout";
        $card['view_default'] = "ViewHorizontal";
        $page['limit_page'] = 1;

        //card-listing


        //layout//ViewHorizontal//ViewVertical//ViewListTables
        //layout -> 

        $card['array-menu'] =
            array(
                array("title", "nama_organisasi", "database", true),
                array("subtitle", array("Be3 ID: ", "apps_id", ""), "database-costum", true),
                array("deskripsi", "bidang_organisasi", "database", true),
                //array("deskripsi",array("id_organisasi_bidang_on_organisasi","organisasi_bidang","id_organisasi_bidang","nama_bidang"),"database-join",true),
                array("extend", "CARD-FOOTER-BOTTOM", "button", array("a", "View Profile", "text", false)),
            );

        /*
		

		*/
        $page['enkripsi'] = array("nama_organisasi", "apps_id", "email_organisasi", "narahubung_organisasi", "nama_narahubung", "alamat_organisasi", "bidang_organisasi");
        $page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';

        $page['config']['database']['Daftarkan Organisasi']['utama'] = 'organisasi';
        $page['config']['database']['Daftarkan Organisasi']['primary_key'] = 'id_organisasi';

        $page['view_layout'][] = array("card", "col-md-12", $card);

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
}
