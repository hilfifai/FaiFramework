<?php

use Illuminate\Support\Arr;

class Outsourcing{
    public $to_text;
    
    public static function list_workspace($page)
    {
        $_SESSION['to_list_workspace_id_apps'] = Partial::get_id_apps($page);
        $page = Workspace::workspace_apps($page);
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function Dashboard_workspace()
    {
        $i=0;
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
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function menu_basic()
    {
        $menu = array(

           


            array("group", "Collaborator",array(
                    array("menu", "Brand", array("Outsourcing", "brand", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Supplier", array("Outsourcing", "supplier", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Distributor", array("Outsourcing", "distributor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Vendor", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Produsen", array("Outsourcing", "produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group", "PartnerShip",array(
                    array("menu", "Mitra Penjualan", array("Outsourcing", "mitra_penjualan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Brand Ambasador", array("Outsourcing", "brand_ambasador", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Media partner", array("Outsourcing", "medpart", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Sponsor", array("Outsourcing", "sponsor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "support", array("Outsourcing", "support", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "investor", array("Outsourcing", "investor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group", "Relation",array(
                    array("menu", "Followership", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Following", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group", "Client",array(
                    array("menu", "Konsumen", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pelanggan", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Client", array("Outsourcing", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),


        );
        return $menu;
    }
    public static function mitra_penjualan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "Outsourcing__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            
            array("Panel", "panel", "select", array("panel", "", "nama_panel")),
            array("Apps User", "id_apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap")),
            array("Store", "store_from", "select", array("store__toko", null, "nama_toko")),
            array("Tipe Mitra", "tipe_mitra", "select-ajax"),
            // array("Toko Pemilik User", "toko_reseler", "select", array("store__toko", null, "nama_toko","reseler")),
            
            array("Tanggal Jatuh Tempo", "tanggal_jatuh_tempo", "date"),
            
            array("Status Mitra", null, "select-manual",array("Menunggu Pembayaran"=>"Menunggu Pembayaran","Menunggu Persetujuan"=>"Menunggu Persetujuan","Aktif"=>"Aktif","Aktif"=>"Aktif")),

            
           array("Syarat Pendaftaran", "syarat_pendaftaran", "div-tambah"),
        );
       
        // $sub_kategori[] = ["Tagihan", "Outsourcing__" . __FUNCTION__ . "__tagihan", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Jenis", "jenis", "text"),
        //     array("Item", "item", "text"),
        //     array("Nominal", "nominal", "number"),
        // );
        // $sub_kategori[] = ["Invoice", "Outsourcing__" . __FUNCTION__ . "__invoice", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Jenis", "jenis", "select-manual", array("Produk" => "Produk", "Ongkir" => "ongkir")),
        // );
        // $sub_kategori[] = ["Payment", "Outsourcing__" . __FUNCTION__ . "__payment", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Jenis", "jenis", "select-manual", array("Produk" => "Produk", "Ongkir" => "ongkir")),
        // );
        $search = array();
        $page['crud']['insert_default_value']['status_mitra'] = "Menunggu Pembayaran";
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        // $page['crud']["js_ajax"] = array(
        //     array(
        //         "form_input"=>"tipe_mitra",
        //         "name"=>"get_pembayaran",
        //         "link"=>["App","Outsourcing","pembayaran_mitra"],
        //         "get"=>array(
        //             array("id_tipe_mitra","tipe_mitra","0",null) // ID, val input, number , null=val or 
        //         ),
        //         "dataType"=>"html",
        //         "result"=>array(
        //             array("syarat_pendaftaran","html",null) //id //.val .html //null = data(value ajax) or data.some value
        //         )
        //     ),
        // );
        $page['crud']["wizard_form"] = array(
            "list_field" => array("id_store_from"),
            "id_store_from" => array(

                "row_to_database" => array(
                    "utama" => "store__mitra",
                    "primary_key" => null,
                ),
                "get_where" => "id_toko",
                "id_result_to" => "tipe_mitra",
                "output_row" => array(
                    "value" => "primary_key",
                    "text" => "nama_mitra"
                )
            ),


        );


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        //$page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function supplier()
    {
        $page['title'] = "Supplier";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "Outsourcing__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Jenis Transaksi", "jenis_transaksi", "select",array('webmaster__jenis_transaksi',null,'nama_jenis_pembelian_barang')),
            array("Kode Supplier", "kode_toko", "text"),
            array("Nama Suplier", "nama_toko", "text"),
            //array("Organisasi Suplier ", "organisasi_pemilik", "select",array('organisasi',null,'nama_organisasi')),
             array("Alamat", "alamat", "textarea"),
            array("No Telp", "telp", "number"),
            array("Default Dicount(Persen)", "default_discount", "number"),
            array("Default Dicount(Harga)", "default_price", "number"),
            // array("Tipe Pembayaran", "temp_of_payment", "text"),
            // array("TOP", "temp_of_payment", "text"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            // array("Bank ", "bank", "text-crud"),
            // array("Nama Rekening", "nama_rekening", "text-crud"),
            // array("No Rekening", "no_rekening", "text-crud"),
        );

        $page['crud']['import_export']['config']['row_check'] = "nama_suplier";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_toko']['prefix'] = 'S.';
        $page['crud']['insert_number_code']['kode_toko']['root']['type'][0] = 'max-mount';
        $page['crud']['insert_number_code']['kode_toko']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_toko']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_toko']['suffix'] = '';


        // $page['crud']['delete_if']['database'] = 'pos__purchasing__purchase_order';
        // $page['crud']['delete_if']['where_in_database'] = 'supplier_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';

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
	public static function channel()
    {
        $page['title'] = "Supplier";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "Outsourcing__" . __FUNCTION__;
        $primary_key = null;
        $array = array(
            array("Jenis Transaksi", "jenis_transaksi", "select",array('webmaster__jenis_transaksi',null,'nama_jenis_pembelian_barang')),
            array("Kode Channel", "kode_channel", "text"),
            array("Nama Channel", "nama_channel", "text"), 
            //array("Organisasi Suplier ", "organisasi_pemilik", "select",array('organisasi',null,'nama_organisasi')),
             array("Alamat", "alamat", "textarea"),
            array("No Telp", "telp", "number"),
            array("Default Dicount(Persen)", "default_discount", "number"),
            array("Default Dicount(Harga)", "default_price", "number"),
            // array("Tipe Pembayaran", "temp_of_payment", "text"),
            // array("TOP", "temp_of_payment", "text"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            // array("Bank ", "bank", "text-crud"),
            // array("Nama Rekening", "nama_rekening", "text-crud"),
            // array("No Rekening", "no_rekening", "text-crud"),
        );

        $page['crud']['import_export']['config']['row_check'] = "nama_suplier";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_toko']['prefix'] = 'S.';
        $page['crud']['insert_number_code']['kode_toko']['root']['type'][0] = 'max-mount';
        $page['crud']['insert_number_code']['kode_toko']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_toko']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_toko']['suffix'] = '';


        // $page['crud']['delete_if']['database'] = 'pos__purchasing__purchase_order';
        // $page['crud']['delete_if']['where_in_database'] = 'supplier_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';

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
    public static function distributor()
    {
        $page['title'] = "Distributor";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "Outsourcing__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode distributor", "kode_distributor", "text"),
            array("Nama distributor", "nama_distributor", "text"),
            array("Organisasi Distributor ", null, "select",array('organisasi',null,'nama_organisasi')),
            array("Alamat", "alamat", "textarea"),
            array("Telp", "telp", "number"),
            array("TOP", "temp_of_payment", "text"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            array("Bank", "bank", "text-crud"),
            array("Nama Rekening", "nama_rekening", "text-crud"),
            array("No Rekening", "no_rekening", "text-crud"),
        );

        $page['crud']['import_export']['config']['row_check'] = "nama_distributor";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_distributor']['prefix'] = 'D.';
        $page['crud']['insert_number_code']['kode_distributor']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_distributor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_distributor']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_distributor']['suffix'] = '';


        // $page['crud']['delete_if']['database'] = 'pos__purchasing__purchase_order';
        // $page['crud']['delete_if']['where_in_database'] = 'supplier_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';

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
    public static function brand()
    {
        $page['title'] = "Brand";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "Outsourcing__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Induk Brand", "parent", "select",array("outsourcing__".__FUNCTION__,null,"nama_toko","parent")),
            array("Kode brand", "kode_toko", "text-kode-req",["array"=>"one","tipe"=>"count-parent","data-parent"=>"id_parent","parent-separator"=>".","prefix"=>"INV.B.","suffix"=>"","sprintf_number"=>"3",""]),
            array("Nama brand", "nama_toko", "text-req"),
            // array("", "jual_produk", "select-manual",array("")),
            // array("", "organisasi_pemilik", "select",array("organisasi",null,"nama_organisasi")),
          
        );
        $page['crud']['select_database_costum']['id_parent']['where'][] = ["jenis_toko","=","Brand"];

        $page['crud']['import_export']['config']['row_check'] = "nama_distributor";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_distributor']['prefix'] = 'D.';
        $page['crud']['insert_number_code']['kode_distributor']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_distributor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_distributor']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_distributor']['suffix'] = '';


        // $page['crud']['delete_if']['database'] = 'pos__purchasing__purchase_order';
        // $page['crud']['delete_if']['where_in_database'] = 'supplier_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';

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
}