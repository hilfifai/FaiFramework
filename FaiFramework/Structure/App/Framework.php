<?php

class Framework {

    public static function versi()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "framework__versi";
        $primary_key = null;

        $array = array(

            array(null, "versi", "text"),
            array(null, "tgl_release_versi", "date"),
            array(null, "keterangan_versi", "text"),
            array(null, "status_versi_berjalan", "select-manual",["1"=>"Ya","2"=>"Tidak"]),


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
    public static function folder()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "framework__folder";
        $primary_key = null;

        $array = array(

            array(null, "versi", "select",["framework__versi",'',"versi"]),
            array(null, "nama_folder", "text"),
            array(null, "folder_enkripsi", "text"),
            array(null, "struktur_folder", "text"),


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
    public static function file()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "framework__file";
        $primary_key = null;

        $array = array(

            array(null, "versi", "select",["framework__versi",'',"versi"]),
            array(null, "folder", "select",["framework__folder",'',"nama_folder"]),
            array(null, "nama_file", "text"),
            array(null, "file_enksripsi", "text"),


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
}
