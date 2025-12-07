<?php

class Wenda
{

    public static function barang($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("", "kode_barang", "text"),
            array("", "nama_barang", "text"),
            array("", "satuan", "text"),
            array("", "harga", "number"),
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
    public static function stok_opname($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;
        //'001/900/SDN1-2CKD/I/2024
        $array = array(

            array("", "nomor", "text-kode", [
                "array" => "one",
                "tipe" => "count-mount",
                "prefix" => "",
                "suffix" => "SDN1-2CKD/" . (date('m')) . "/" . date('Y'),
                "sprintf_number" => "3",
                ""
            ]),

            array("", "tanggal_so", "date"),

        );
        $search = array();

        $sub_kategori[] = ["Detail", "" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Barang", "barang", "select", ["barang", "", "nama_barang"]),
            array("", "harga_satuan", "number"),
            array("Data Stok ", "stok", "number"),
            array("Stok Fisik", "stok_fisik", "number"),
            array("Selisih", "Selisih", "number"),

        );

        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("jumlah", "harga_satuan"),
            "id_row" => true,
            "input" => array("onkeyup", 'onchange'),
            "get" => array("jumlah" => "id_row", "harga_satuan" => "id_row", "jumlah_harga" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(jumlah*harga_satuan)"),
                    "var" => "total_harga"
                ),
                
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
               
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
               
            )
        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function pengeluaran($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;
        //'001/900/SDN1-2CKD/I/2024
        $array = array(

            array("", "nomor_pengeluaran", "text-req-kode", [
                "array" => "one",
                "tipe" => "count-mount",
                "prefix" => "",
                "suffix" => "SDN1-2CKD/" . (date('m')) . "/" . date('Y'),
                "sprintf_number" => "3",
                ""
            ]),

            array("", "tanggal_keluar", "date-req"),
            array("", "pemohon", "text-req"),
            array("", "kegiatan", "text-req"),
            array("", "no_nota_dinas", "text-req"),
            array("", "tgl_nota_dinas", "date-req"),
            array("", "no_spb", "text-req"),
            array("", "tgl_spb", "date-req"),
            array("", "no_sppb", "text-req"),
            array("", "tgl_sppb", "date-req"),
            array("", "no_bast", "text-req"),
            array("", "tgl_bast", "date-req"),
            array("", "keterangan", "text"),
        );
        $search = array();

        $sub_kategori[] = ["Detail", "" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Barang", "barang", "select", ["barang", "", "nama_barang"]),
            array("", "harga_satuan", "number"),
            array("Jumlah Barang", "jumlah", "number"),
            array("", "jumlah_harga", "number"),
            array("", "kode_rekening", "number"),

        );

        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("jumlah", "harga_satuan"),
            "id_row" => true,
            "input" => array("onkeyup", 'onchange'),
            "get" => array("jumlah" => "id_row", "harga_satuan" => "id_row", "jumlah_harga" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(jumlah*harga_satuan)"),
                    "var" => "total_harga"
                ),
                
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
               
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
               
            )
        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function penerimaan($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');
        $page['not_checking'] =true;
        $database_utama = "" . __FUNCTION__;
        $primary_key = null;
        //'001/900/SDN1-2CKD/I/2024
        $array = array(

            array("", "nomor_penerimaan", "text-kode", [
                "array" => "one",
                "tipe" => "count-mount",
                "prefix" => "",
                "suffix" => "SDN1-2CKD/" . (date('m')) . "/" . date('Y'),
                "sprintf_number" => "3",
                ""
            ]),

            array("", "tanggal_diterima", "date"),
            array("", "dari", "text"),
            
            array("BASP", "basp", "text"),
            array("Tanggal BASP", "tanggal basp", "date"),
            array("", "keterangan", "text"),
        );
        $search = array();

        $sub_kategori[] = ["Detail", "" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Barang", "barang", "select", ["barang", "", "nama_barang"]),
            array("", "harga_satuan", "number"),
            array("Jumlah", "jumlah", "number"),
            array("", "jumlah_harga", "number"),
            array("", "kode_rekening", "number"),

        );

        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("jumlah", "harga_satuan"),
            "id_row" => true,
            "input" => array("onkeyup", 'onchange'),
            "get" => array("jumlah" => "id_row", "harga_satuan" => "id_row", "jumlah_harga" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(jumlah*harga_satuan)"),
                    "var" => "total_harga"
                ),
                
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
               
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
               
            )
        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function surat_permintaan($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;
        //'001/900/SDN1-2CKD/I/2024
        $array = array(

            array("", "nomor_surat_permintaan", "text-kode", [
                "array" => "one",
                "tipe" => "count-mount",
                "prefix" => "",
                "suffix" => "SDN1-2CKD/" . (date('m')) . "/" . date('Y'),
                "sprintf_number" => "3",
                ""
            ]),

            array("", "tanggal_surat_permintaan", "date"),
            array("Diminta Oleh", "", "text"),
            array("Dari", "", "text"),
        );
        $search = array();

        $sub_kategori[] = ["Detail", "" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Barang", "barang", "select", ["barang", "", "nama_barang"]),
            
            array("Jumlah", "jumlah", "number"),
            
            array("", "keterangan", "text"),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function surat_penyaluran($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "" . __FUNCTION__;
        $primary_key = null;
        //'001/900/SDN1-2CKD/I/2024
        $array = array(

            array("", "nomor_surat_penyaluran", "text-kode", [
                "array" => "one",
                "tipe" => "count-mount",
                "prefix" => "",
                "suffix" => "SDN1-2CKD/" . (date('m')) . "/" . date('Y'),
                "sprintf_number" => "3",
                ""
            ]),

            array("", "tanggal_surat_penyaluran", "date"),
            array("Untuk", "", "text"),
            array("Surat Dinas", "", "text"),
        );
        $search = array();

        
        $sub_kategori[] = ["Detail", "" . __FUNCTION__ . "__detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Barang", "barang", "select", ["barang", "", "nama_barang"]),
            array("", "harga_satuan", "number"),
            array("", "satuan", "number"),
            array("Jumlah", "jumlah", "number"),
            array("", "jumlah_harga", "number"),
            array("", "ket", "text"),

        );

        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("jumlah", "harga_satuan"),
            "id_row" => true,
            "input" => array("onkeyup", 'onchange'),
            "get" => array("jumlah" => "id_row", "harga_satuan" => "id_row", "jumlah_harga" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(jumlah*harga_satuan)"),
                    "var" => "total_harga"
                ),
                
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
               
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
               
            )
        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
}
