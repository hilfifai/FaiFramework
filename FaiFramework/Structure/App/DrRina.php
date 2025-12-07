<?php

class DrRina
{
    public static function master()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__master";
        $primary_key = null;

        $array = array(

            array("Logo", "logo", "file", "website/master/"),
            array("Nama Page", "nama_page", "text"),
            array("Deskripsi Page(Seo)", "deskripsi_page", "text"),
            array("Keyword(Seo)", "keyword", "text"),


            array("Alamat", "alamat", "text"),
            array("No Telpon", "no_telepon", "text"),
            array("Nama Narahubung", "nama_narahubung", "text"),
            array("Email", "email", "text"),
        );
        $search = array();
        //tag and kontent
        //header

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function banner()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__banner";
        $primary_key = null;

        $array = array(

            array("Banner", null, "file", "website/banner/"),
            array("File Tambahan", null, "file", "website/banner/"),
            array("Title Banner", null, "text"),
            array("Deskripsi Banner", null, "text"),
        );
        $search = array();
        //tag and kontent
        //header

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function tanya_dokter()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "xx_tanya_dokter";
        $primary_key = null;

        $array = array(

            array("user", "user", "select", array('users', null, 'name'), null),
            array("Pertanyaan", null, "textarea"),
            array("Jawaban", null, "textarea"),
            array("Tanggal Dijawab", null, "date"),
            array("Muncul", null, "select-manual", array("1" => "Muncul", "2" => "Tidak Muncul")),

        );

        $search = array();
        //tag and kontent
        //header

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function event()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "event";
        $primary_key = null;

        $array = array(

            array("File", null, "file", "website/banner/"),
            array("Nama Event", null, "text"),
            array("Tanggal Awal", null, "date"),
            array("Tanggal Akhir", null, "date"),
            array("Jam Awal", null, "text"),
            array("Jam Akhir", null, "text"),
            array("Deskripsi", null, "textarea"),
            array("Lokasi", null, "text"),
            array("Alamat", null, "textarea"),
            // array("Deskripsi",null,"textarea"),
        );
        $search = array();
        $sub_kategori[] = ["Dokumentasi", "" . __FUNCTION__ . "_dokumentasi", null, "table"];
        $array_sub_kategori[] = array(
            array("file", "file", "file", ""),
            array("deskripsi", "deskripsi", "deskripsi", ""),
            // array("file","paket_seq","select",array('pos__master__paket', null,'nama_paket'), null),

        );
        $sub_kategori[] = ["Panitia", "" . __FUNCTION__ . "_panitia", null, "table"];
        $array_sub_kategori[] = array(
            array("user", "user", "select", array('users', null, 'name'), null),

        );
        $sub_kategori[] = ["Peserta", "" . __FUNCTION__ . "_peserta", null, "table"];
        $array_sub_kategori[] = array(

            array("user", "user", "select", array('users', null, 'name'), null),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
}
