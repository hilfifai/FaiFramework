<?php

use Illuminate\Support\Arr;

class Setting
{
    public $to_text;


    public static function flow_transaksi()
    {
        $page['title'] = "Flow Transaksi";
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "setting__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Module", null, "text"),
            array("Kode Flow", null, "text"),
            array("Nama Flow", null, "text"),
            array("Keterangan", null, "textarea"),
        );
        $sub_kategori[] = ["Paket", "setting__" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Step Ord", null, "number"),
            array("Step Name", null, "text"),
            array("Function call", null, "text"),
            array("Button step next", null, "text"),
            array("Button Text", null, "text"),
            array("Button Multiple", null, "textarea"),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['import_export']['config']['row_check'] = "nama_suplier";
        $page['crud']['import_export']['config']['on_delete'] = false;


        $page['crud']['insert_number_code']['kode_flow']['prefix'] = 'FLOW.';
        $page['crud']['insert_number_code']['kode_flow']['root']['type'][0] = 'max-mount';
        $page['crud']['insert_number_code']['kode_flow']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['kode_flow']['root']['sprintf_number'][0] = 4;
        $page['crud']['insert_number_code']['kode_flow']['suffix'] = '';


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
