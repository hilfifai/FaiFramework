<?php

class ApiMaster
{

    public static function kategori()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__kategori";
        $primary_key = null;

        $array = array(

            array(null, "kode_kategori", "text"),
            array(null, "nama_kategori", "text"),


        );


        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function list($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__list";
        $primary_key = null;

        $array = array(

            array(null, "kode_api_master", "text"),
            array(null, "nama_api_master", "text"),
            array(null, "nama_class", "text"),
            array(null, "function_cek_stok", "text"),
            array(null, "parameter_cek_stok", "text"),
            array(null, "penggunaan", "select-manual-value", ["sandbox", "production"]),
            array(null, "gudang", "select", ["inventaris__asset__tanah__gudang", "", "nama_gudang"]),
        );
        $sub_kategori[] = ["Field Utama", "" . $database_utama  . "__field", null, "table"];
        $array_sub_kategori[] = array(
            array(null, "nama_field", "text"),
        );
        $sub_kategori[] = ["Field Utama", "" . $database_utama  . "__versi", null, "table"];
        $array_sub_kategori[] = array(
            array(null, "versi", "text"),
            array(null, "link_sandbox", "text"),
            array(null, "link_production", "text"),
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
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function user($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__user";
        $primary_key = null;

        $array = array(
            array(null, "Api", "select", array("api_master__list", null, "nama_api_master")),
            array(null, "Versi", "select", array("api_master__list__versi", null, "versi")),
            array(null, "panel", "select", ["panel", null, "nama_panel"]),
            array("Workspace", "id_web__list_apps_board", "select", array("web__list_apps_board", null, "nama_board")),
            array("", "penggunaan_link", "select-manual", array("sandbox"=>"Sandbox", "production"=>"Production")),


        );
        $page['crud']['select_database_costum']['id_versi']['np'] = true;
        $sub_kategori[] = ["Field Utama", "" . $database_utama  . "__content", null, "table"];
        $array_sub_kategori[] = array(
            array(null, "api_field", "select", ["api_master__list__field", null, "nama_field"]),
            array(null, "content", "text"),
        );
        $sub_kategori[] = ["Sync Aktif", "" . $database_utama  . "__sync", null, "table"];
        $array_sub_kategori[] = array(
            array(null, "sync", "select", ["api_master__sync", "", "nama_sync"]),
            array(null, "digunakan", "select-manual", [1 => "Ya", 2 => "Tidak"]),
        );

        $page['crud']['insert_default_value']['id_panel'] = "WORKSPACE_SINGLE_PANEL|";
        $page['crud']['insert_default_value']['id_web__list_apps_board'] = "ID_BOARD|";
        $page['crud']['insert_value']['id_web__list_apps_board'] = "ID_BOARD|";
        $page['crud']['insert_value']['id_panel'] =  "WORKSPACE_SINGLE_PANEL|";
        $page['non_view']['Edit']['id_panel'] = true;
        $page['non_view']['Edit']['id_web__list_apps_board'] = true;
        // $page['crud']['insert_default_value']['id_toko'] = "WORKSPACE_SINGLE_TOKO|";


        $search = array();

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'][] = array("$database_utama.id","=","LOAD_ID|");
        $page['database']['np'] = array();
        // $page['get']['sidebarIn'] = true;;
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function sync()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__sync";
        $primary_key = null;

        $array = array(
            array(null, "link", "select", array("api_master__link", null, "link_endpoint")),
            array(null, "nama_sync", "text"),
            array(null, "function_execution", "text"),


        );


        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function data()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__data";
        $primary_key = null;

        $array = array(
            array(null, "Api", "select", array("api_master__list", null, "nama_api_master")),
            array(null, "jenis_data", "text"),
            array(null, "database", "text"),
            array(null, "nama_row_search", "text"),
            array(null, "get_row_id", "text"),
            array(null, "value", "text"),
            array(null, "id_from_api", "text"),
            array(null, "id_in_db", "text"),


        );


        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function link()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "api_master__link";
        $primary_key = null;

        $array = array(

            array(null, "api", "select", array("api_master__list", null, "nama_api_master")),
            array(null, "kategori_api", "select", array("api_master__kategori", null, "nama_kategori")),
            array(null, "link_endpoint", "text"),


        );
        $sub_kategori[] = [" Field", "" . $database_utama  . "__field", null, "form"];
        $array_sub_kategori[] = array(
            array(null, "nama_field", "text"),
            array(null, "tipe_field", "select-manual", ["body" => "Body", "header" => "Header", "param" => "Param"]),
            array(null, "required_field", "select-manual", ["1" => "Ya", "2" => "Tidak"]),
            array(null, "get_field", "select-manual-value", ["Input", "Dari response link"]),
        );
        $sub_kategori[] = ["search", "" . $database_utama  . "__search", null, "table"];
        $array_sub_kategori[] = array(
            array(null, "row_search", "text"),
            array(null, "nama_search", "text"),
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
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
}
