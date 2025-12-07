<?php

class Apps
{

    public static function user() {}
    public static function transaksi()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Database Utama", "", "text"),
            array("Database ID", "", "number"),
            array("Tipe transaksi", "", "select-manual", array("Pembuatan" => "Pembuatan", "Pengubahan" => "Pengubahan", "Penghapusan" => "Penghapusan")),
            array("Waktu Perubahan", "", "datetime"),
            array("Data Awal", "", "textarea-json"),
            array("Data Akhir", "", "textarea-json"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function privilege()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Database Utama", "", "text"),
            array("Database ID", "", "number"),
            array("Tipe Privilage", "", "select-manual", array("pengecualian" => "Pengecualian", "diperbolehkan" => "diperbolehkan", "setting" => "setting")),
            array("Tanggal Perubahan", "", "date"),
            array("Jenis Privilage", "", "select-manual", ['Public Global' => 'Public Global', 'Private Website' => 'Private Website', 'Private Workspace' => 'Private Workspace', 'Private Panel' => 'Private Panel', 'Private Role' => 'Private Role']),
            array("Domain privilage", "", "text"),
            array("Web Apps privilage", "", "text"),
            array("Workspace privilage", "", "text"),
            array("panel privilage", "", "text"),
            array("Role privilage", "", "text"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function historis()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Akun", "id_apps_user", "select", array('apps_user', null, 'nama_lengkap', 'aka'), null),
            array("Akun", "id_panel", "select", array('panel', null, 'nama_panel'), null),
            array("", "ip", "text"),
            array("", "url", "text"),
            array("", "domain", "text"),
            array("", "domain", "text"),
            array("", "historis_apps", "text"),
            array("", "historis_page_view", "text"),
            array("", "historis_id", "text"),
            array("", "historis_type", "text"),
            array("", "historis_nav", "text"),
            array("", "historis_menu", "text"),
            array("", "historis_board", "text"),
            array("", "change", "text"),
            array("", "os", "text"),
            array("", "browser", "text"),
            array("", "browser_version", "text"),
            array("", "report", "text"),
            array("", "tanggal_akses", "text"),
            array("", "device", "text"),
            array("", "device_detail", "text"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("aka.nama_akun as sub_dari_akun");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
}
