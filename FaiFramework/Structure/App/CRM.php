<?php

class CRM
{
    function list_workspace($page)
    {
        $page = Workspace::workspace_apps($page);
        return $page;
    }
    public static function Dashboard_workspace()
    {
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function menu_basic()
    {
        $menu = array(




            // array(
            //     "group", "Collaborator", array(
            //         array("menu", "Supplier", array("CRM", "supplier", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Distributor", array("CRM", "distributor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Vendor", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Produsen", array("CRM", "produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),
            // array(
            //     "group", "PartnerShip", array(
            //         array("menu", "Mitra Penjualan", array("CRM", "mitra_penjualan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Brand Ambasador", array("CRM", "brand_ambasador", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Media partner", array("CRM", "medpart", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Sponsor", array("CRM", "sponsor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "support", array("CRM", "support", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "investor", array("CRM", "investor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),
            // array(
            //     "group", "Relation", array(
            //         array("menu", "Followership", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Following", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),
            array(
                "group",
                "Client",
                array(
                    array("menu", "Konsumen", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pelanggan", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Client", array("CRM", "vendor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),


        );
        return $menu;
    }
    public static function pembayaran_mitra($page)
    {
        $id_mitra = Partial::input('id_tipe_mitra');

        DB::table('store__mitra__tagihan_biaya');
        DB::whereRaw('id_store__mitra=' . $id_mitra);
        $get = DB::get();
        echo '<div class="">
        <table class="w-100">
        <tr>
        <td>No</td>
        <td>Item</td>
        <td>Harga</td>
        </tr>
        ';
        $no = 0;
        $nom = 0;
        foreach ($get as $get) {
            $no++;
            $nom += $get->nominal_bayar;
            echo '<tr>
        <td>' . $no . '</td>
        <td>' . $get->nama_pembayaran . '</td>
        <td>' . $get->nominal_bayar . '</td>
        </tr>';
        };

        echo '
        <tr>
        
        <td colspan=2>TOTAL</td>
        <td>' . $nom . '</td>
        </tr>
        </table>
        </div>
        ';

        die;
    }
    public static function mitra_penjualan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "crm__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Login User", "id_apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap")),
            array("Nama Toko", "nama_toko", "text"),
            array("Nama Lengkap", "nama_lengkap", "text"),

            array("Link Shopee", "link_shopee", "text"),
            array("Link Tokopedia", "link_tokpedtok", "text"),
            array("Link Lazada", "link_lazada", "text"),
            array("No WhatsApp", "no_wa", "text"),

            array("Store", "store_from", "select", array("store__toko", null, "nama_toko","store_from")),
            array("Tipe Mitra", "tipe_mitra", "select-ajax"),
            array("Login Mitra", "log_mitra", "select-manual", array("1" => "User", "2" => "Toko", "3" => "Organisasi")),
            array("Toko", "toko_reseler", "select", array("store__toko", null, "nama_toko","store_reseler")),
            array("Organisasi", "organisasi", "select", array("organisasi", null, "nama_organisasi")),
            array("Tanggal Jatuh Tempo", "tanggal_jatuh_tempo", "date"),
            array("Status Mitra", "status_mitra", "select-manual", array("1" => "Belum Melakukan Pembayaran", "2" => "Menunggu Pembayaran", "3" => "Aktif")),


            array("Syarat Pendaftaran", "syarat_pendaftaran", "div"),
        );

        $sub_kategori[] = ["Tagihan", "crm__" . __FUNCTION__ . "__tagihan", null, "table"];
        $array_sub_kategori[] = array(
            array("Jenis", "jenis", "text"),
            array("Item", "item", "text"),
            array("Nominal", "nominal", "number"),
        );
        // $sub_kategori[] = ["Invoice", "crm__" . __FUNCTION__ . "__invoice", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Jenis", "jenis", "select-manual", array("Produk" => "Produk", "Ongkir" => "ongkir")),
        // );
        // $sub_kategori[] = ["Payment", "crm__" . __FUNCTION__ . "__payment", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Jenis", "jenis", "select-manual", array("Produk" => "Produk", "Ongkir" => "ongkir")),
        // );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        // $page['crud']["js_ajax"] = array(
        //     array(
        //         "form_input"=>"tipe_mitra",
        //         "name"=>"get_pembayaran",
        //         "link"=>["App","CRM","pembayaran_mitra"],
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

        $database_utama = "crm__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Supplier", "kode_supplier", "text"),
            array("Nama Suplier", "nama_suplier", "text"),
            array("Alamat", "alamat", "textarea"),
            array("Telp", "telp", "number"),
            array("TOP", "temp_of_payment", "text"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            array("Bank", "bank", "text-crud"),
            array("Nama Rekening", "nama_rekening", "text-crud"),
            array("No Rekening", "no_rekening", "text-crud"),
        );

        $page['crud']['import_export']['config']['row_check'] = "nama_suplier";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_supplier']['prefix'] = 'S.';
        $page['crud']['insert_number_code']['kode_supplier']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['kode_supplier']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_supplier']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_supplier']['suffix'] = '';


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
