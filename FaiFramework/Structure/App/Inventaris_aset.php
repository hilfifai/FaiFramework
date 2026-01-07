<?php

class Inventaris_aset extends Inventaris_Barang
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
                "text" => "Total Asset",
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
                "text" => "Total Kepemilikan Asset",
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
                "Master Data",
                array(
                    array("menu", "Unit/Satuan", array("Inventaris_aset", "satuan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Conversi", array("Inventaris_aset", "conversi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            // array(
            //     "group", "Surat Menyurat", array(
            //         array("menu", "Jenis Surat", array("Inventaris_aset", "jenis_surat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Surat", array("Inventaris_aset", "jenis_surat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),
            array(
                "group",
                "Tanah & Bangunan",
                array(
                    array("menu", "Tanah", array("Inventaris_aset", "tanah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Bangunan", array("Inventaris_aset", "bangunan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Gudang", array("Inventaris_aset", "gudang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Ruang Simpan(Rak)", array("Inventaris_aset", "ruang_simpan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            // array("group", "Master Asset"),
            // array("menu", "Jenis Asset", array("Inventaris_aset", "jenis assett", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Kategori", array("Inventaris_aset", "master__kategori", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Jenis Asset", array("Inventaris_aset", "asset__master__jenis", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //array("menu", "Brand", array("Inventaris_aset", "brand", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Distributor", array("Inventaris_aset", "distributor", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array(
                "group",
                "Asset Prduk",
                array(
                    array("menu", "Tipe Varian", array("Inventaris_aset", "tipe_varian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Data Varian", array("Inventaris_aset", "data_varian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                    array("menu", "Produk", array("Inventaris_aset", "asset_list", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Bahan Baku Produk", array("Inventaris_aset", "bahan_baku_produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Paket", array("Inventaris_aset", "paket", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),



        );
        return $menu;
    }
    public static function klasifikasi_asset()
    {
        //mengenal/
        /*
            Aset Lancar (Current Assets)
                 kas, 
                 piutang usaha,
                 persediaan
                    barang produksi
            Aset Tidak Lancar (Non-Current Assets)
                Aset Tetap  
                    Tanah
                    Bangunan
                    Pelaratan
                    Kendaraan
                Aset Tidak Berwujud (Intangible Assets)
                    hak paten, 
                    merek dagang, 
                    hak cipta, dan 
                        goodwill2
                

        */
    }

    public static function tipe_varian()
    {
        $page['title'] = "" . ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "inventaris__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama tipe", null, "text"),
        );
        $sub_kategori[] = ["List", $database_utama . "__list", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama List Tipe Varian", null, "text"),
            array("Kode", null, "text"),

        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;




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
    public static function data_varian()
    {
        $page['title'] = "" . ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        // $database_utama = "inventaris__master__" . __FUNCTION__;
        // $primary_key = null;

        // $array = array(
        //     array("Nama tipe", null, "text"),
        // );
        // $sub_kategori[] = ["List", $database_utama . "__list", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Nama List Tipe Varian", null, "text"),
        //     array("Kode", null, "text"),

        // );
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;




        $page['crud']['search'] = array(-1 => array(4, 1));

        // $page['database']['utama'] = $database_utama;
        // $page['database']['primary_key'] = $primary_key;
        // $page['database']['select'] = array("*");;
        // $page['database']['join'] = array();
        // $page['database']['where'] = array();
        // $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        $page['route'] = __FUNCTION__;
        return $page;
    }
    public static function tanah()
    {

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__tanah";
        $primary_key = null;

        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Penamaan Tanah", "penamaan_tanah", "text"),
            array("Alamat", "alamat", "textarea"),
            array("Long", "long", "text"),
            array("Lat", "lat", "text"),

            array("Jenis Tanah", "jenis_tanah", "select-manual", array("pemerintah" => "Tanah Pemerintah", "perumahan" => "Perumahan", "rumah" => "Tanah Pribadi")),
            array("Luas Tanah(Meter)", "luas_tanah", "number"),
            array("Lebar Tanah(meter)", "lebar_tanah", "number"),
            array("Panjang (Meter)", "panjang_tanah", "number"),
            array("Ruas Jalan", "ruas_jalan", "number"),
            array("Sertifikat Tanah(SHM)", "sertifikat", "select-manual", array("ada", "Ada dan Punya", "Tidak" => "tidak")),
            array("Izin Mendirikan Bangungan(IMB/PBG)", "imb", "select-manual", array("ada", "Ada dan Punya", "Tidak" => "tidak")),
            array("SPPT-PBB", "spptpbb", "select-manual", array("ada", "Ada dan Punya", "Tidak" => "tidak")),
            array("Kepemilikan ke", "kepemilikan_ke", "number"),
            //user
            array("Nama Pemilik Tanah", "nama_pemilik", "text"),
            array("Narahubung Pemilik Tanah", "narahubung_pemilik", "text"),
            array("Denah", "denah", "file", "inventaris/tanah/denah"),
            array("Foto Tanah", "foto_tanah", "file", "inventaris/tanah/foto"),
        );
        //block_ruang
        $sub_kategori[] = ["Blok Tanah", $database_utama . "__blok", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Blok", "nama_blok", "text"),
            array("Lebar Tanah(meter)", "lebar_tanah", "number"),
            array("Panjang (Meter)", "panjang_tanah", "number"),
            array("Panjang (Meter)", "panjang_tanah", "number"),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bangunan()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__tanah__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            // array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Kode Unit", "kode_unit", "text"),
            array("Nama Unit Bangunan", "nama_unit_bangunan", "text"),
            array("Blok Tanah", "blok_tanah", "select", array("inventaris__asset__tanah", null, "penamaan_tanah")),
            array("Deskripsi", "deskripsi", "text"),
            array("Alamat", "alamat", "textarea"),
            array("Provinsi", "id_provinsi", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
            array("Kota", "id_kota", "select-ajax"),
            array("Kecamatan", "id_kecamatan", "select-ajax"),
            array("Kelurahan", "id_kelurahan", "select-ajax"),
            array("RT", "rt", "number"),
            array("RW", "rw", "number"),
            array("Nomor Bangunan", "nomor_bangunan", "number"),


            array("Tipe Unit", "tipe_unit", "select-manual", array("Kontrakan" => "Kontrakan", "Apartemen" => "Apartemen", 'Rumah' => 'Rumah', 'Pabrik' => "Pabrik", "Ruko", "Vila", "Kantor" => "Kantor", "Gedung" => "Gedung", "Istana" => "Istana", "Tempat Wisata" => "Tempat Wisata", "Museum/Situs" => "Museum/Situs")),
            array("Jumlah Lantai", "jumlah_lantai", "text"),
            array("Keterisian Bangunan", "keterisian_bangunan", "select-manual", array("kosong" => "Bangunan Kosong", "fungsi" => "Bangunan Fungsi")),
            array("Fungsi Bangunan", "fungsi_bangunan", "select-manual", array("bangunan_kontrak" => "Kontrakan/Kosan", "operasional_kantor" => "Operasional Kantor", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga")),
            array("Tipe Kepemilikan Bangunan", "tipe_kepemilikan_bangunan", "select-manual", array("pribadi" => "Milik Pribadi", "organisasi" => "Organisasi/Perusahaan", "pemerintah" => "Pemerintah")),
            array("Kepemilikan Bangunan", "kepemilikan_bangunan", "select-ajax"),
        );
        //block_ruang
        $sub_kategori[] = ["Ruang Bangunan", $database_utama . "__ruang", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Ruang", "nama_ruang_simpan", "text"),
            array("Lantai", "lantai_ruang", "number"),
            array("Lebar Tanah(meter)", "lebar_ruang", "number"),
            array("Panjang (Meter)", "panjang_ruang", "number"),
            array("Tinggi (Meter)", "tinggi_ruang", "number"),
        );
        $sub_kategori[] = ["Pengisi", $database_utama . "__pengisi", null, "table"];
        $array_sub_kategori[] = array(
            array("User", "apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap")),
            array("Tipe", "tipe", "select-manual", array("Pemilik", "Keluarga Pemilik", "Sewa Kontrak", "Waris", "Anggota Perusahaan")),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['wizard_form'] =  array(
            "list_field" => array("id_provinsi", "id_kota", "id_kecamatan", "postal_code"),
            "id_provinsi" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kabupaten",
                    "primary_key" => "kota_id",
                ),
                "get_where" => "provinsi_id",
                "id_result_to" => "id_kota",
                "output_row" => array(
                    "value" => "kota_id",
                    "prefix" => array(
                        array("type" => "database", "text" => "type"),
                        array("type" => "text", "text" => " ")
                    ),
                    "text" => "kota_name"
                )
            ),
            "id_kota" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kecamatan",
                    "primary_key" => "subdistrict_id",
                ),
                "id_result_to" => "id_kecamatan",
                "get_where" => "kota_id",
                "output_row" => array(
                    "value" => "subdistrict_id",

                    "text" => "subdistrict_name"
                )
            ),
            "id_kecamatan" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__postal_code",
                    "primary_key" => "id",
                ),
                "id_result_to" => "id_kelurahan",
                "get_where" => "kecamatan_id",
                "output_row" => array(
                    "value" => "id",
                    "sufix" => array(
                        array("type" => "text", "text" => "("),
                        array("type" => "database", "text" => "postal_code"),
                        array("type" => "text", "text" => ")")
                    ),
                    "text" => "urban"

                )
            ),
        );
        $page['crud']['search'] = $search;
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bangunan3($page)
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", 'bangunan'));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__tanah__bangunan" ;
        $primary_key = null;

        $array = array(
            // array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Kode Unit", "id_toko", "hidden"),
            array("Kode Unit", "kode_unit", "text"),
            array("Nama Unit Bangunan", "nama_unit_bangunan", "text"),
            // array("Blok Tanah", "blok_tanah", "select", array("inventaris__asset__tanah", null, "penamaan_tanah")),
            array("Deskripsi", "deskripsi", "text"),
            array("Alamat", "alamat", "textarea"),
            array("Provinsi", "id_provinsi", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
            array("Kota", "id_kota", "select-ajax"),
            array("Kecamatan", "id_kecamatan", "select-ajax"),
            array("Kelurahan", "id_kelurahan", "select-ajax"),
            array("RT", "rt", "number"),
            array("RW", "rw", "number"),
            array("Nomor Bangunan", "nomor_bangunan", "number"),


            array("Tipe Unit", "tipe_unit", "select-manual", array("Kontrakan" => "Kontrakan", "Apartemen" => "Apartemen", 'Rumah' => 'Rumah', 'Pabrik' => "Pabrik", "Ruko", "Vila", "Kantor" => "Kantor", "Gedung" => "Gedung", "Istana" => "Istana", "Tempat Wisata" => "Tempat Wisata", "Museum/Situs" => "Museum/Situs")),
            array("Jumlah Lantai", "jumlah_lantai", "text"),
            array("Keterisian Bangunan", "keterisian_bangunan", "select-manual", array("kosong" => "Bangunan Kosong", "fungsi" => "Bangunan Fungsi")),
            array("Fungsi Bangunan", "fungsi_bangunan", "select-manual", array("bangunan_kontrak" => "Kontrakan/Kosan", "operasional_kantor" => "Operasional Kantor", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga")),
            array("Tipe Kepemilikan Bangunan", "tipe_kepemilikan_bangunan", "select-manual", array("pribadi" => "Milik Pribadi", "organisasi" => "Organisasi/Perusahaan", "pemerintah" => "Pemerintah", "sewa" => "Milik Pihak Kedua(sewa)","keluarga"=>"Milik Keluarga")),
            // array("Kepemilikan Bangunan", "kepemilikan_bangunan", "select-ajax"),
        );
        //block_ruang
        $sub_kategori[] = ["Ruang Bangunan", $database_utama . "__ruang", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Ruang", "nama_ruang_simpan", "text"),
            array("Lantai", "lantai_ruang", "number"),
            array("Lebar Tanah(meter)", "lebar_ruang", "number"),
            array("Panjang (Meter)", "panjang_ruang", "number"),
            array("Tinggi (Meter)", "tinggi_ruang", "number"),
        );
        // $sub_kategori[] = ["Pengisi", $database_utama . "__pengisi", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("User", "apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap")),
        //     array("Tipe", "tipe", "select-manual", array("Pemilik", "Keluarga Pemilik", "Sewa Kontrak", "Waris", "Anggota Perusahaan")),
        // );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['wizard_form'] =  array(
            "list_field" => array("id_provinsi", "id_kota", "id_kecamatan", "postal_code"),
            "id_provinsi" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kabupaten",
                    "primary_key" => "kota_id",
                ),
                "get_where" => "provinsi_id",
                "id_result_to" => "id_kota",
                "output_row" => array(
                    "value" => "kota_id",
                    "prefix" => array(
                        array("type" => "database", "text" => "type"),
                        array("type" => "text", "text" => " ")
                    ),
                    "text" => "kota_name"
                )
            ),
            "id_kota" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kecamatan",
                    "primary_key" => "subdistrict_id",
                ),
                "id_result_to" => "id_kecamatan",
                "get_where" => "kota_id",
                "output_row" => array(
                    "value" => "subdistrict_id",

                    "text" => "subdistrict_name"
                )
            ),
            "id_kecamatan" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__postal_code",
                    "primary_key" => "id",
                ),
                "id_result_to" => "id_kelurahan",
                "get_where" => "kecamatan_id",
                "output_row" => array(
                    "value" => "id",
                    "sufix" => array(
                        array("type" => "text", "text" => "("),
                        array("type" => "database", "text" => "postal_code"),
                        array("type" => "text", "text" => ")")
                    ),
                    "text" => "urban"

                )
            ),
        );
        $page['crud']['search'] = $search;
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        
        $page['crud']['insert_value']['id_toko'] = "";
        $page['crud']['insert_default_value']['id_toko'] = "WORKSPACE_SINGLE_TOKO|";

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['where'][] = ["$database_utama.id_toko::numeric", "=", "WORKSPACE_SINGLE_TOKO|"];
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bangunan2()
    {
        //get 

        $page['title'] = "";
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__tanah__bangunan" ;
        $primary_key = null;

        $array = array(
            // array("Panel", null, "select", array("panel", null, "nama_panel")),
            // array("Kode Unit", "kode_unit", "text"),
            array("Nama Alamat", "nama_unit_bangunan", "text"),
            // array("Blok Tanah", "blok_tanah", "select", array("inventaris__asset__tanah", null, "penamaan_tanah")),
            // array("Deskripsi", "deskripsi", "text"),
            array("Alamat", "alamat", "textarea"),
            array("Provinsi", "id_provinsi", "select-nonselect2", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
            array("Kota", "id_kota", "select-ajax"),
            array("Kecamatan", "id_kecamatan", "select-ajax"),
            array("Kelurahan", "id_kelurahan", "select-ajax"),
            array("RT", "rt", "number"),
            array("RW", "rw", "number"),
            array("Nomor Bangunan", "nomor_bangunan", "number"),
            array("Patokan", "patokan", "text"),


            // array("Tipe Unit", "tipe_unit", "select-manual", array("Kontrakan" => "Kontrakan", "Apartemen" => "Apartemen", 'Rumah' => 'Rumah', 'Pabrik' => "Pabrik", "Ruko", "Vila", "Kantor" => "Kantor", "Gedung" => "Gedung", "Istana" => "Istana", "Tempat Wisata" => "Tempat Wisata", "Museum/Situs" => "Museum/Situs")),
            // array("Jumlah Lantai", "jumlah_lantai", "text"),
            // array("Keterisian Bangunan", "keterisian_bangunan", "select-manual", array("kosong" => "Bangunan Kosong", "fungsi" => "Bangunan Fungsi")),
            // array("Fungsi Bangunan", "fungsi_bangunan", "select-manual", array("bangunan_kontrak" => "Kontrakan/Kosan", "operasional_kantor" => "Operasional Kantor", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga", "bangunan_keluarga" => "Bangunan Huni keluarga")),
            // array("Tipe Kepemilikan Bangunan", "tipe_kepemilikan_bangunan", "select-manual", array("pribadi" => "Milik Pribadi", "organisasi" => "Organisasi/Perusahaan", "pemerintah" => "Pemerintah")),
            // array("Kepemilikan Bangunan", "kepemilikan_bangunan", "select-ajax"),
        );
        //block_ruang
        // $sub_kategori[] = ["Ruang Bangunan", $database_utama . "__ruang", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Nama Ruang", "nama_ruang", "text"),
        //     array("Lantai", "lantai_ruang", "number"),
        //     array("Lebar Tanah(meter)", "lebar_ruang", "number"),
        //     array("Panjang (Meter)", "panjang_ruang", "number"),
        //     array("Tinggi (Meter)", "tinggi_ruang", "number"),
        // );
        // $sub_kategori[] = ["Pengisi", $database_utama . "__pengisi", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("User", "apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap")),
        //     array("Tipe", "tipe", "select-manual", array("Pemilik", "Keluarga Pemilik", "Sewa Kontrak", "Waris", "Anggota Perusahaan")),
        // );
        $page['crud']['select_database_costum']['id_provinsi']['order'][] = ["provinsi","asc"];
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['wizard_form'] =  array(
            "list_field" => array("id_provinsi", "id_kota", "id_kecamatan", "postal_code"),
            "id_provinsi" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kabupaten",
                    "primary_key" => "kota_id",
                ),
                "get_where" => "provinsi_id",
                "id_result_to" => "id_kota",
                "output_row" => array(
                    "value" => "kota_id",
                    "prefix" => array(
                        array("type" => "database", "text" => "type"),
                        array("type" => "text", "text" => " ")
                    ),
                    "text" => "kota_name"
                )
            ),
            "id_kota" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__kecamatan",
                    "primary_key" => "subdistrict_id",
                ),
                "id_result_to" => "id_kecamatan",
                "get_where" => "kota_id",
                "output_row" => array(
                    "value" => "subdistrict_id",

                    "text" => "subdistrict_name"
                )
            ),
            "id_kecamatan" => array(

                "row_to_database" => array(
                    "utama" => "webmaster__wilayah__postal_code",
                    "primary_key" => "id",
                ),
                "id_result_to" => "id_kelurahan",
                "get_where" => "kecamatan_id",
                "output_row" => array(
                    "value" => "id",
                    "sufix" => array(
                        array("type" => "text", "text" => "("),
                        array("type" => "database", "text" => "postal_code"),
                        array("type" => "text", "text" => ")")
                    ),
                    "text" => "urban"

                )
            ),
        );
        $page['crud']['search'] = $search;
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function gudang()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "inventaris__asset__tanah__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Nama Gudang", "nama_gudang", "text"),
            array("Keterangan", "keterangan_gudang", "textarea"),
            array("Bangunan", "bangunan", "select-form", array("inventaris__asset__tanah__bangunan", null, "nama_unit_bangunan", "apps" => "inventaris_asset", "function" => "bangunan")),
        );
        $sub_kategori[] = ["Ruang", $database_utama . "__ruang_bangun", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Ruang Simpan", "nama_ruang_simpan", "text"),
            array("Ruang", "ruang", "select", array("inventaris__asset__tanah__bangunan__ruang", null, "nama_ruang")),
        );

        // $page['crud']['delete_if']['database'] = 'pos__master__raw_material';
        // $page['crud']['delete_if']['where_in_database'] = $database_utama . '_seq';
        // $page['crud']['delete_if']['row_data'] = 'primary_key';
        // $page['crud']['delete_if']['check'] = 'row';
        $page['crud']['select_database_costum']['id_bangunan']['where'][] = array("inventaris__asset__tanah__bangunan.id_panel", '=', "ID_PANEL|");

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['search'] = array();

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        $page['route'] = __FUNCTION__;
        return $page;
    }
}
class Inventaris_Barang
{
    public static function brand()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama Brand", "nama_brand", "text"),
            array("Parent", "parent", "select", array($database_utama, $primary_key, 'nama_brand', 'b'), null),
            array("Organisasi Pemilik Brand(jika_ada)", "organisasi_pemilik_brand", "select_other", array('organisasi', null, 'nama_organisasi'), null),


        );

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
    public static function kategori_toko()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Kode Kategori", "kode_kategori", "text"),
            array("Nama Kategori", "nama_kategori", "text"),
            array("Parent", "parent", "select", array($database_utama, $primary_key, 'nama_kategori', 'b'), null),


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
		$page['crud']['select_database_costum']['id_produk'] = $select_costum;

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
    public static function distributor()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama Distributor", "nama_distributor", "text"),
            array("No Kontak", "no_kontak", "number"),
            array("Nama Kontrak", "nama_kontak", "text"),
            array("Jabatan Kontrak", "jabatan_kontak", "text"),
            //array("Parent","parent","select",array($database_utama,$primary_key,'nama_kategori'),null),
            array("Organisasi Distibutor", "organisasi_distibutor", "select_other", array('organisasi', null, 'nama_organisasi'), null),


        );

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
    public static function bahan_baku_produk()
    {
        //get 

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "inventaris__asset__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Bahan Produk", null, "text"),

        );
        $sub_kategori[] = ["Bahan Baku", $database_utama . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Bahan Baku", "bahan_baku", "select", array("inventaris__asset__list", null, "nama_barang", 'ba'), null),
            array("Takaran", "takaran", "text"),
            array("Satuan", "satuan", "select", array('ltw_inventaris__master__satuan', null, 'nama_satuan'), null),


        );



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
    public static function asset_list()
    {
        $page['title'] = "" . ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "inventaris__asset__list";
        $primary_key = null;

        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Jenis Barang", "jenis_barang", "select-manual", array("Bahan Baku" => "Bahan Baku", "Barang Jadi" => "Barang jadi", "Asset Jasa" => "Asset jasa")),
            array("Asset", "jenis_asset", "select", array("inventaris__asset__master__jenis", null, "nama_jenis_asset"), null),
            // array("Tipe Barang", "tipe_barang", "select-manual", array("Barang Produksi" => "Barang Produksi", "Barang Kebutuhan Pokok" => "Barang Kebutuhan Pokok", "Barang Kepemilikan Hasil Pembelian" => "Barang Kepemilikan Hasil Pembelian", "Barang Kredit Berjalan " => "Barang Kredit Berjalan", "Barang Peminjaman" => "Barang Peminjaman", "Barang Distributor" => "Barang Kerjasama Distributor")),
            array("Jual Aset barang", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),

            array("Kategori", "kategori", "select", array("webmaster__inventaris__master__kategori", null, "nama_kategori"), null),
            array("Kode Barang barang", "kode_barang", "text"),
            array("Nama Aset barang", "nama_barang", "text"),
            array("SKU Index", "sku", "text"),
            array("Barcode", "barcode", "text"),
            array("Peruntukan Pemakaian", "peruntukan", "select-manual", array("Pria" => "Pria", "Wanita" => "Wanita", "Pria Wanita" => "Pria Wanita", "Lainnya" => "Lainnya")),
            array("Deskripsi barang", "deskripsi_barang", "textarea"),
            array("Berat(gr)", "berat", "number"),
            array("Panjang Barang", null, "number"),
            array("Lebar Barang", null, "number"),
            array("Tinggi Barang", null, "number"),

            array("Foto Utama", "foto_aset", "photos", "inventaris/aset/barang"),
            array("Foto", "foto", "file-upload", "inventaris/aset/barang"),
            array("Video", "video_aset", "video", "inventaris/aset/barang"),


            // array("Kisaran Harga Kepemilikan Aset", "kisaran_harga_kepemilikan_aset", "number"),


            // array("Unit/Satuan", "satuan", "select", array("webmaster__satuan", null, "nama_satuan"), null),
            array("toko", "toko", "select", array("store__toko", null, "nama_toko"), null),
            array("Brand/Merek", "brand", "select", array("outsourcing__brand", null, "nama_brand"), null),
            // array("Bahan Baku", "brand", "select", array("inventaris__asset__master__bahan_baku_produk", null, "nama_bahan_produk"), null),

            // array("Asal Pinjam Dari","asal_pinjam_dari","select",array("")),

            array("Variansi Barang", "varian_barang", "select-manual", array("1" => "Ya", "2" => "Tidak")),
            array("Asal barang dari", "asal_barang_dari", "select-manual", array("1" => "Ya", "2" => "Tidak")),
            // array("Jumlah Barang(stok)", "kuantitas", "number"),
            array("Harga Pokok Penjualan", "harga_pokok_penjualan", "number"),
            array("", "id_master", "hidden"),
            array("", "id_api", "hidden"),
            array("", "id_sync", "hidden"),
            array("", "is_api", "hidden"),
            array("", "klasifikasi_produk", "hidden"),
            array("", "id_from_api", "hidden"),
            array("", "harga_beli", "hidden"),
            array("", "id_kategori_toko", "hidden"),
            array("", "kuantitas", "hidden"),
            array("", "id_apps", "hidden"),
            array("Harga Pokok Jual", "harga_pokok", "number"),
            array("Kondisi", "kondisi", "radio2-manual", array("1" => "Baru", "2" => "Bekas")),
            //gudang simpan

        );
        $sub_kategori[] = ["Detail", $database_utama . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Detail", "nama_detail", "text"),
            array("Konten Detail", "konten_detail", "text"),

        );
        // $sub_kategori[] = ["Bahan Baku Barang Jadi", $database_utama."__baku_baja", null, "table"];
        // $array_sub_kategori[] = array(
        //    

        // );
        // $sub_kategori[] = ["Level Varian", $database_utama . "__varian_level", null, "table"];
        // $array_sub_kategori[] = array(
        //     array("Level", "level", "number"),

        //     // array("Data Master","data_master","text"),

        // );
        $sub_kategori[] = ["Varian Barang", $database_utama . "__varian", null, "Form"];
        $array_sub_kategori[] = $varian = array(
            array("Nama Varian", "nama_varian", "text"),
            array("SKU", "sku_index_varian", "text"),
            array("Barcode", "barcode_varian", "text"),
            array("Berat", "berat_varian", "number"),
            array("Tipe Varian 1", null, "select", array("inventaris__master__tipe_varian", null, "nama_tipe", 'tipe1')),
            array("Varian 1", null, "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian1")),
            array("Tipe Varian 2", null, "select", array("inventaris__master__tipe_varian", null, "nama_tipe", 'tipe2')),
            array("Varian 2", null, "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian")),
            array("Tipe Varian 3", null, "select", array("inventaris__master__tipe_varian", null, "nama_tipe", 'tipe3')),
            array("Varian 3", null, "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian3")),
            array("Harga Pokok Penjualan", "harga_pokok_penjualan_varian", "number"),
            array("Foto", "foto_aset_varian", "photos", "inventaris/aset/barang"),
            array("", "asal_from_data_varian", "hidden"),
            array("", "id_asset_list_varian", "hidden"),
            array("", "generate_asset_list", "hidden"),
            array("", "is_asset_list_varian", "hidden"),
            array("", "prefix_master", "hidden"),
            array("", "id_from_api_varian", "hidden"),
            array("", "id_api_varian", "hidden"),
            array("", "id_sync_varian", "hidden"),
            array("", "id_master_varian", "hidden"),
            array("", "is_master_varian", "hidden"),
        );

        $page['sub_kategori_varian'] = $varian;


        // array("Harga Pokok Penjualan", "harga_pokok_penjualan_varian", "number-cur"),


        $page['crud']['table_group']['Data Aset'][] = "jenis_asset";
        $page['crud']['table_group']['Data Aset'][] = "kategori";

        $page['crud']['table_group']['Data Barang'][] = "kode_barang";
        $page['crud']['table_group']['Data Barang'][] = "nama_barang";
        $page['crud']['table_group']['Data Barang'][] = "foto_aset";
        // $page['crud']['table_group']['Data Barang'][] = "deskripsi_barang";


        $page['crud']['table_group']['Detail'][] = "brand";
        $page['crud']['table_group']['Detail'][] = "berat";
        $page['crud']['table_group']['Detail'][] = "kisaran_harga_awal";
        $page['crud']['table_group']['Detail'][] = "kisaran_harga_akhir";
        $page['crud']['table_group']['Detail'][] = "peruntukan";
        $page['crud']['table_group']['Detail'][] = "varian_barang";

        $page['crud']['table_group']['Keterangan Barang'][] = "tipe_barang";
        $page['crud']['table_group']['Keterangan Barang'][] = "asal_pinjam_dari";
        $page['crud']['table_group']['Keterangan Barang'][] = "distributor";
        $page['crud']['table_group']['Keterangan Barang'][] = "barang_distributor";
        $page['crud']['table_group']['Keterangan Barang'][] = "kuantitas";
        $page['crud']['table_group']['Keterangan Barang'][] = "varian_barang";

        $page['crud']['select_other']['kategori']["get"] = "from_controller";
        $page['crud']['select_other']['kategori']["controller"] = "Webmaster";
        $page['crud']['select_other']['kategori']["function"] = "master__kategori";
        $page['crud']['select_other']['kategori']["field"] = "nama_kategori";


        // $page['crud']['select_other']['id_tipe_varian_1']["get"] = "from_controller";
        // $page['crud']['select_other']['id_tipe_varian_1']["controller"] = "Webmaster";
        // $page['crud']['select_other']['id_tipe_varian_1']["function"] = "master__kategori";
        // $page['crud']['select_other']['id_tipe_varian_1']["field"] = "nama_kategori";


        $page['crud']['hidden_show']['varian_barang']['onjs'] = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['varian_barang']['default']["kuantitas"] = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_beli"] = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_pokok_penjualan"] = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_pokok_penjualan"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['default_sub_kategori'][$database_utama . "__varian"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['default_sub_kategori'][$database_utama . "__varian_level"] = "hide";


        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["kuantitas"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["harga_pokok_penjualan"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["harga_beli"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["1"][$database_utama . "__varian"] = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["1"][$database_utama . "__varian_level"] = "show";

        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["kuantitas"] = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["harga_pokok_penjualan"] = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["harga_beli"] = "show";

        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["2"][$database_utama . "__varian"] = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["2"][$database_utama . "__varian_level"] = "hide";


        // $page['crud']['hidden_show']['jenis_barang']['default_sub_kategori'][$database_utama . "__baku_baja"] = "hide";
        // $page['crud']['hidden_show']['jenis_barang']['value_if_sub_kategori']["Bahan Baku"][$database_utama . "__baku_baja"] = "show";


        $page['crud']['hidden_show']['tipe_barang']['onjs'] = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['tipe_barang']['default']["distributor"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['default']["barang_distributor"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['default']["asal_pinjam_dari"] = "hide";



        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["distributor"] = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["barang_distributor"] = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["asal_pinjam_dari"] = "hide";

        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["asal_pinjam_dari"] = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["distributor"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["barang_distributor"] = "hide";

        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["asal_pinjam_dari"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["distributor"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["barang_distributor"] = "hide";

        // array("Tipe Barang","tipe_barang","select-manual",array("Barang Kebutuhan Pokok"=>"Barang Kebutuhan Pokok",""=>"Barang Kepemilikan Hasil Pembelian","Barang Kredit Berjalan "=>"Barang Kredit Berjalan",""=>"Barang Peminjaman","Barang Distributor"=>"Barang Kerjasama Distributor")),





        // $page['crud']["tree_sub_kategori"][$database_utama . "__varian"]=true;
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['col_row']['nama_varian'] = "col-md-4";
        $page['crud']['col_row']['varian_master'] = "col-md-2";
        $page['crud']['col_row']['stok'] = "col-md-2";
        $page['crud']['col_row']['harga_beli'] = "col-md-2";

        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
}
