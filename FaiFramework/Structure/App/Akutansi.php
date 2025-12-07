<?php

class Akutansi {
/*
Income & Expenses
Sales Quotation
Sales Order
Sales Invoices
Sales Payment
Purchase Request
Purchase Order
Purchase Invoices
Purchase Payment 10 Accounting & Reports (Profit and Loss, Trial Balance, Balance Sheet, General Ledger)
Master Data (COA,COA Balance, Customers, Vendor,Items,Projects,Fixed Assets)
Journal Entry
*/
    public static function akun()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Akun", "nama_akun", "text"),
            array("Kode Akun", "kode_akun", "text"),
            array("Kategori Akun", "kategori_akun", "select", array('keuangan__kategori_akun', null, 'nama_kategori'), null),
            array("Sub dari akun", "sub_dari_akun", "select", array('keuangan__akun', null, 'nama_akun', 'aka'), null),
        );
        $search = array();
        $page['non_view']['Tambah']['total_kuantitas'] = true;
        $page['non_view']['Edit']['total_kuantitas'] = true;
        $page['non_view']['Hapus']['total_kuantitas'] = true;

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("keuangan__akun.nama_akun", "keuangan__akun.kode_akun", "aka.nama_akun as sub_dari_akun");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function saldo_awal()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Akun", "akun_seq", "select", array('keuangan__akun', null, 'nama_akun', 'aka'), null),
            array("Debit", "debit", "number"),
            array("Kredit", "kredit", "number"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array();;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function kategori_akun()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "keuangan__" . __FUNCTION__;
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
}