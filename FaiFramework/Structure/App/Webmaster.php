<?php

class Webmaster
{

    public static function ekspedisi()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Ekspedisi", "kode_ekspedisi", "text"),
            array("Nama Ekspedisi", "nama_ekspedisi", "text"),


        );
        $sub_kategori[] = ["Service", "webmaster__" . __FUNCTION__ . "__service", null, "table"];
        $array_sub_kategori[] = array(
            array("Kode Service", "kode_service", "text"),
            array("Nama Service", "nama_service", "text"),

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
    public static function payment_webapps()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("webapps", null, "select", array("web__apps", null, "domain_utama")),
            array("workspace", null, "select", array("web__list_apps_board", null, "nama_board")),
            array("payment method", null, "select", array("webmaster__payment_method", null, "nama_payment")),
            array("payment Brand", null, "select", array("webmaster__payment_method_brand", null, "nama_brand")),
            array("Is VA", null, "select-manual", array(1 => "Ya", 2 => "Tidak")),

            array("A.n", "atas_nama_webapps", "text"),
            array("Nomor Rekening", "no_rek_webapps", "number"),


        );
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['database']['utama'] = "webmaster__payment_method_brand";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['request_where'] = "id_webmaster__payment_method";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['target'] = "id_payment_method";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['value'] = "primary_key";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['option'] = "nama_brand";

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
    public static function jenis_transaksi()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Tipe", null, "select-manual", array("pembelian" => "Pembelian Barang", "penjualan" => "Penjualan Barang")),
            array("Nama", "nama_jenis_pembelian_barang", "text"),
            array("Deskripsi ", "deskripsi_jenis_pembelian_barang", "text"),
            array("Icon", "icon", "text"),


        );
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['database']['utama'] = "webmaster__payment_method_brand";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['request_where'] = "id_webmaster__payment_method";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['target'] = "id_payment_method";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['value'] = "primary_key";
        //    $page['crud']['field_value_automatic_select_target']['id_payment_brand']['option'] = "nama_brand";

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
    public static function flow_transaksi()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Transaksi", null, "text"),
            array("Nama Transaksi", null, "text"),


        );
        $sub_kategori[] = ["Detail", "webmaster__" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Urutan", null, "text"),
            array("Sort Code", null, "text"),
            array("Sort Name", null, "text"),
            array("Call Function", null, "text"),
            array("Button Function", null, "text"),
            array("Call Next Code Button", null, "text")
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
    public static function payment_method()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Payment", null, "text"),
            array("Nama Metode", "nama_payment", "text"),


        );
        $sub_kategori[] = ["Paket", "webmaster__" . __FUNCTION__ . "_brand", null, "table"];
        $array_sub_kategori[] = array(
            array("Kode Brand", "kode_brand", "text"),
            array("Nama Brand", "nama_brand", "text"),
            array("Logo Brand", "logo_brand", "file", "payment/logo/"),
            array("Biaya Payment", "biaya_payment", "number"),
            array("Expired Jam", "expired_jam", "number"),
            array("Is Api", "is_api", "select-manual", array("Tidak", "Ya")),
            array("Api", "api", "select-manual", array("midtrans" => "midtrans")),

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
    public static function form__tipe()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__form__tipe";
        $primary_key = null;

        $array = array(
            array("kode form sesuai ", "kode_form", "text"),
            array("Nama Form show", "nama_form", "text"),
            array("is Option", "is_option", "select-manual", array(1 => "Ya", 2 => "Tidak")),
            array("ada deskripsi option", "is_deskripsi", "select-manual", array(1 => "Ya", 2 => "Tidak")),


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
    public static function privasi()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Privasi", "kode_privasi", "text"),
            array("Nama Privasi", "nama_privasi", "text"),


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
    public static function jenis()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__pos__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Kategori", "kode_kategori", "text"),
            array("Nama Kategori", "nama_kategori", "text"),
            array("Shopee Code", "shopee_code", "text"),
            array("Tokopedia Code", "tokopedia_code", "text"),
            array("Parent", "parent", "select", array($database_utama, $primary_key, 'nama_kategori', 'wib'), null),

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
    public static function erp_pos__page()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama Page", "page", "text"),
            array("Keterangan", "keterangan_page", "text"),


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
    public static function master__kategori()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__inventaris__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Parent", "parent", "select", array($database_utama, $primary_key, 'nama_kategori', 'wib'), null),
            array("Kode Kategori", "kode_kategori", "text-kode", ["array" => "one", "tipe" => "count-parent", "data-parent" => "id_parent", "parent-separator" => ".", "prefix" => "INV.K.", "suffix" => "", "sprintf_number" => "3", ""]),
            array("Nama Kategori", "nama_kategori", "text"),
            array("Kode Shopee Kategori", "shopee_code", "text"),
            array("Kode Tokopedia  Kategori", "tokopedia_code", "text"),
            array("Kode Lazada  Kategori", "lazada_code", "text"),

        );

        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['primary_kode'] = "kode_kategori";
        $page['database']['primary_nama'] = "nama_kategori";
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function webmaster__organsiasi__kategori()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Kategori", "kode_kategori", "text"),
            array("Nama Kategori", "nama_kategori", "text"),
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

    public static function webmaster__organsiasi__bidang()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kategori", null, "select", array("webmaster__organsiasi__kategori", null, "nama_kategori")),
            array("Nama Bidang", null, "text"),
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
    public static function pajak()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Pajak", "kode_pajak", "text"),
            array("Nama Pajak", "nama_pajak", "text"),
            array("Operator", "operator", "select-manual", array("%" => "%", "/" => "/")),
            array("Nilai", "nilai", "number"),
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
    public static function satuan()
    {
        $page['title'] = "Unit Satuan";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Satuan", "nama_satuan", "text"),
            array("Consumable Items", "konsutif_item", "select-manual", [
                "1" => "Ya, Satuan yang menjadi acuan untuk jumlah kuantiti  tidak berkurang berdasarkan penjuakan",
                "2" => "Bukan, Satuan yang menjadi acuan untuk jumlah kuantiti   berkurang berdasarkan penjuakan"
            ]),
        );


        // $page['crud']['delete_if']['database'] = 'pos__master__raw_material';
        // $page['crud']['delete_if']['where_in_database'] = $database_utama . '_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';
        // $page['crud']['delete_if']['check'] = 'row';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        $page['route'] = __FUNCTION__;
        return $page;
    }
    public static function conversi()
    {
        $page['title'] = "Conversi";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "webmaster__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Konversi", "nama_konversi", "text"),
            array("Satuan Awal", "satuan_awal_seq", "select", array("webmaster__satuan", null, "nama_satuan", "a"), null),
            array("Operator", "operator", "text"),
            array("Besaran", "besaran", "text"),
            array("Nama Satuan", "satuan_akhir_seq", "select", array("webmaster__satuan", null, "nama_satuan", "b"), null),

            //array("Lokasi","lokasi","text"),

        );



        // $page['crud']['delete_if']['database'] = 'pos__master__raw_material';
        // $page['crud']['delete_if']['where_in_database'] = 'pos__master__conversi_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';
        // $page['crud']['delete_if']['check'] = 'row';


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        $page['route'] = __FUNCTION__;
        return $page;
    }
    public static function webmaster__organisasi__tipe_kerjasama()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama Kerjasama", null, "text"),
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

    public static function webmaster__organsiasi__role()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Bidang", null, "select", array("webmaster__organsiasi__bidang", null, "nama_bidang")),
            array("Nama Role", "nama_role", "text"),
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
    public static function webmaster_wilayah__provinsi()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Provinsi", "provinsi", "text"),
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
    public static function asset__master__jenis()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "webmaster__inventaris__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Jenis Asset", "nama_jenis_asset", "text"),

            //array("Parent","parent","select",array($database_utama,$primary_key,'nama_jenis_asset','wib'),null),

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
