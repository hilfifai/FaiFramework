<?php

class Apotek
{
    //Master Data
    public static function menu()
    {
        //nama/link/icon
        $menu = array(

            array("menu", "Overview", array("Apotek", "overview", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Penjualan"),
            array("menu", "Tagihan Penjualan", array("Apotek", "penjualan__tagihan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Pengriman Penjualan", array("Apotek", "penjualan__pengiriman", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("menu", "Pemesanan Penjualan", array("Apotek", "penjualan__pemesanan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Penawaran Penjualan", array("Apotek", "penjualan__penawaran", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Penjualan"),

            array("menu", "Tagihan Pembelian", array("Apotek", "pembelian__tagihan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Pengriman Pembelian", array("Apotek", "pembelian__pengiriman", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("menu", "Pesanan Pembelian", array("Apotek", "pembelian__pemesanan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Penawaran Pembelian", array("Apotek", "pembelian__penawaran", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("group", "Master"),
            array("menu", "Vendor", array("Apotek", "vendor", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Termin", array("Apotek", "termin", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Tag", array("Apotek", "tag", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
//11
            array("group", "Produk"),
            array("menu", "Kategori", array("Apotek", "kategori_produk", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Satuan", array("Apotek", "satuan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Produk", array("Apotek", "produk", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
 //14
            array("group", "Inventory"),
            array("menu", "Inventory", array("Apotek", "inventory", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("group", "Aset Tetap"),
            array("menu", "Aset Tetap", array("Apotek", "aset_tetap", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Keuangan"),
            array("menu", "Kategori Akun", array("Akutansi", "kategori_akun", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Akun", array("Akutansi", "akun", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Kas & Bank", array("Akutansi", "kas_bank", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Saldo Awal", array("Akutansi", "saldo_awal", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
//20
            array("group", "Biaya"),
            array("menu", "Penerima", array("Apotek", "penerima", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Pajak", array("Apotek", "pajak", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Biaya", array("Apotek", "biaya", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
//23
            array("group", "Kontak"),
            array("menu", "Grup", array("Apotek", "grup", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Tipe Kontak", array("Apotek", "tipe_kontak", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Sapaan", array("Apotek", "sapaan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Kontak", array("Apotek", "kontak", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
//27
        );

        return $menu;
    }
    public static function kategori_produk()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
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
        //$page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function satuan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Satuan", "kode_satuan", "text"),
            array("Nama Satuan", "nama_satuan", "text"),
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
    public static function produk()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Gambar", "gambar", "file","apotek/produk"),
            array("Kategori", "kategori_id", "select", array('apotek__master__kategori_produk', null, 'nama_kategori'), null),
            array("Nama Produk", "nama_produk", "text"),
            array("Kode SKU", "kode_sku", "text"),
            array("Satuan", "satuan_id", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Deskripsi", "deskripsi", "textarea"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga_jual", "number"),
            array("Stok Minimal", "stok_minimal", "number"),
            array("Expired Date", "expired_date", "date"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['crud']['row']['nama_produk'] = "col-md-6";
        $page['crud']['row']['kode_sku'] = "col-md-6";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function inventory()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Gudang", "nama_gudang", "text"),
            array("Kode Gudang", "kode_gudang", "text"),
            array("Deskripsi", "deskripsi", "textarea"),
            array("Total kuantitas", "total_kuantitas", "number-table"),
            array("Total nilai", "total_nilai", "number-table"),
        );
        $search = array();
        $page['non_view']['Tambah']['total_kuantitas'] = true;
        $page['non_view']['Edit']['total_kuantitas'] = true;
        $page['non_view']['Hapus']['total_kuantitas'] = true;

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
   
    public static function penerima()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__biaya__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Penerima", "kode_penerima", "text"),
            array("Nama Penerima", "nama_penerima", "text"),
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

        $database_utama = "apotek__biaya__" . __FUNCTION__;
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
    public static function biaya()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__biaya__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Dibayar dari", "akun_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun'), null),
            array("Penerima", "penerima", "select", array('apotek__biaya__penerima', null, 'nama_penerima'), null),
            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Nomor", "nomor", "text"),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),
            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file","apotek/biaya"),
        );

        $sub_kategori[] = ["", "apotek__biaya__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Akun Biaya", "akun_biaya_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun'), null),
            array("Deskripsi", "deskripsi", "textarea"),
            // array("Pajak", "pajak_seq", "select", array('apotek__biaya__pajak', null, 'nama_pajak'), null),
            array("Total", "total", "number"),

        );
        $page['crud']['insert_number_code']['nomor']['prefix'] = 'BIA/{BULAN}|/{TAHUN-y}|/';
        $page['crud']['insert_number_code']['nomor']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor']['root']['sprintf_number'][0] = 6;
        $page['crud']['insert_number_code']['nomor']['root']['month_get_row_where'][0] ='created_at';
        $page['crud']['insert_number_code']['nomor']['suffix'] = '';

        $page['crud']['row']['nomor'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";
        $page['crud']['row']['tag'] = "col-md-4";
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),

                array("name" => "Total", "id" => "total_total", "type" => "text")
            )
        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total_all"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total_all",
            "get" => array("sub_total_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("total"),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("total" => "id_row"),

            "result" => array(

                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),

            )

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
    public static function grup()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__kontak__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Grup", "kode_grup", "text"),
            array("Nama Grup", "nama_grup", "text"),

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
    public static function tipe_kontak()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__kontak__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode", "kode_tipe_kontak", "text"),
            array("Nama", "nama_tipe_kontak", "text"),
            array("Deskripsi", "deskripsi", "text"),

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
    public static function sapaan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__kontak__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode", "kode_sapaan", "text"),
            array("Sapaan", "sapaan", "text"),

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
    public static function kontak()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__kontak__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Foto", "foto", "file","kontak/foto"),

            array("Tipe kontak", "tipe_kontak", "select", array('apotek__kontak__tipe_kontak', null, 'nama_tipe_kontak'), null),
            array("Grup", "grup", "select", array('apotek__kontak__grup', null, 'nama_grup'), null),
            array("Nama", "nama", "text"),
            array("Sapaan", "sapaan", "select", array('apotek__kontak__sapaan', null, 'sapaan'), null),
            array("Perusahaan", "perusahaan", "text"),
            array("Alamat penagihan", "alamat_penagihan", "textarea"),
            array("Negara", "negara", "text"),
            array("Provinsi", "provinsi", "text"),
            array("Kota", "kota", "text"),
            array("Email", "email", "email"),
            array("Telepon", "telepon", "tel"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),
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
    public static function vendor()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Vendor", "kode_vendor", "text"),
            array("Nama Vendor", "nama_vendor", "text"),
            array("Bagian", "bagian", "text"),
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
    public static function termin()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Kode Termin", "kode_termin", "text"),
            array("Nama Termin", "nama_termin", "text"),
            array("Jumlah Hari", "hari", "number"),
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
    public static function tag()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Tag", "nama_tag", "text"),
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
    public static function penjualan__tagihan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Pelanggan", "pelanggan_seq", "select", array('apotek__kontak__kontak', null, 'nama'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal jatuh tempo", "tanggal_jatuh_tempo", "date"),
            array("Termin", "termin", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Gudang", "gudang", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file","apotek/penjualan/tagihan"),

        );

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Kode SKU", "kode_sku", "text"),
            array("Barcode", "barcode", "text"),
            array("Deskripsi", "deskripsi", "text"),
            array("Expired Date","expired_date","date"),
            array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),

        );
        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_bayar", null, "table"];
        $array_sub_kategori[] = array(
            array("Tanggal Transaksi", null, "text"),
            array("Keterangan", null, "text"),
            array("Nominal",null,"date"),
            array("Sisa Nominal", null, "number"),

        );
        $page['crud']['insert_number_code']['nomor']['prefix'] = 'PNT/{BULAN}|/{TAHUN-y}|/';
        $page['crud']['insert_number_code']['nomor']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor']['root']['sprintf_number'][0] = 6;
        $page['crud']['insert_number_code']['nomor']['root']['month_get_row_where'][0] ='created_at';
        $page['crud']['insert_number_code']['nomor']['suffix'] = '';

        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['no_action']["apotek__" . __FUNCTION__ . "_detail"]=true;

        $page['crud']['row']['pelanggan_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tgl_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['tanggal_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin'] = "col-md-4";

        $page['crud']['row']['gudang'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";
        $page['crud']['row']['tag'] = "col-md-4";
        //apotek__master__
        
        $page['non_view']['PDFPage']['barcode'] =true;
        $page['non_view']['PDFPage']['deskripsi'] =true;


        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Pemotongan",

                    "id" => "pemotongan",
                    "type" => "input_no_result_multi",
                    "add_button_multi" => true,
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_pemotongan_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'aka'),null),
                    ),

                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "get_total_pemotongan"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("get_total_pemotongan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("get_total_pemotongan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Total Pemotongan", "id" => "total_pemotongan", "type" => "text", "eventInput" => array("onkeyup" => "total", "onchange" => "total")),
                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma'),null),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "get_total_pemotongan",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "pemotongan",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_pemotongan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_pemotongan_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "total_pemotongan_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(total_pemotongan_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );

        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__pembelian__tagihan_detail";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__master__produk","id_produk","apotek__master__produk.id");
        // $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__tagihan","id_apotek__pembelian__tagihan","apotek__pembelian__tagihan_detail.id");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['where'][] = array("
        (apotek__pembelian__tagihan_detail.kuantitas-
        (SELECT COALESCE(SUM ( apotek__penjualan__tagihan_detail.kuantitas ),0) as  kuantitas FROM apotek__penjualan__tagihan_detail
         where id_pembelian = apotek__pembelian__tagihan_detail.id and apotek__penjualan__tagihan_detail.active=1))",">","0");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "primary_key";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku",'barcode');
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku"
                                                                                                            , "barcode" => "Barcode"
                                                                                                            , "nama_produk" => "Nama Produk"
                                                                                                            , "harga" => "Harga Jual"
                                                                                                            , "harga_beli" => "Harga Beli"
                                                                                                            , "sisa_qty" => "Sisa QTY"
                                                                                                            , "expired_date" => "Expired Date"
                                                                                                        );
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "id_pembelian" => array("row" => "primary_key", "type" => "database"),
                "produk_seq" => array("row" => "id_produk", "type" => "database"),
                "expired_date" => array("row" => "expired_date", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga", "type" => "database"),
                "harga_beli" => array("row" => "harga_beli", "type" => "database"),
                "barcode" => array("row" => "barcode", "type" => "database"),
                "kode_sku" => array("row" => "kode_sku", "type" => "database"),
            );

        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_beli", "harga_beli");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("barcode", "barcode");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("expired_date", "expired_date");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("nobatch", "nobatch");
		
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        
        $page['crud']['change_database']['parameter'] = "kuantitas";
        $page['crud']['change_database']['is_sub_kategori'] = true;
        $page['crud']['change_database']['get_where'] = "apotek__pembelian__tagihan_detail"; 
        $page['crud']['change_database']['database'] = "apotek__pembelian__tagihan_detail.id"; 
        $page['crud']['change_database']['database'] = "apotek__pembelian__tagihan_detail.id"; 

         
        $ii=-1;

        $ii++;
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
		$page['crud']['oninsert_sub_kategori'][$ii]["tipe"] = "check-insert-update";
		$page['crud']['oninsert_sub_kategori'][$ii]["first_proses"] = "check";
		$page['crud']['oninsert_sub_kategori'][$ii]["proses"] = array("check","insert","update");

		$page['crud']['oninsert_sub_kategori'][$ii]["table_sub_kategori"] = "apotek__" . __FUNCTION__ . "_detail";
		
        $page['crud']['oninsert_sub_kategori'][$ii]['check']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["utama"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["join"][] = array("apotek__master__produk","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("id_produk",'=',"id_produk",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][1] = "row";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][0] = null;
        
        $page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['get_where'] = array("id","id_produk",'sqli');

		$page['crud']['oninsert_sub_kategori'][$ii]["row"]['next_execution'] = "check2"; 
        $page['crud']['oninsert_sub_kategori'][$ii]['row']["tipe"] = "row";
        
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["utama"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["join"][] = array("apotek__" . __FUNCTION__ . "_detail","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("nama_produk",'=',"nama_produk",'string','row','row_row[0]');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][0] = "update_id";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][1] = "insert";

		

        $page['crud']['oninsert_sub_kategori'][$ii]['insert']["tipe"] = "insert";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["table_insert"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['get_where'] = array("id","id_produk",'sqli');
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_kategori","id_kategori","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nama_produk","nama_produk","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("kode_sku","kode_sku","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_satuan","id_satuan","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("expired_date","expired_date","input");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_jual","harga","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_beli","harga_beli","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nobatch","nobatch","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("barcode","barcode","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['next_execution'] = "update"; 
		
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update"]['field'][] = array("id_produk","last_value","last_value_oninsert"); 
        
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update_id']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update_id"]['field'][] = array("id_produk","primary_key","database",'check[0]'); 
        
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
        $page['database']['where'][] = array("$database_utama.id_apotek","=",'".'."Auth::user()->id_apotek".'."');
        return $page;
    }
    
    public static function penjualan__penawaran()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Pelanggan", "pelanggan_seq", "select", array('apotek__kontak__kontak', null, 'nama'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Kadaluarsa", "kadaluarsa", "date"),
            array("Termin", "termin", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),

        );
        $page['crud']['row']['pelanggan_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['kadaluarsa'] = "col-md-4";
        $page['crud']['row']['termin'] = "col-md-4";

        $page['crud']['row']['referensi'] = "col-md-6";
        $page['crud']['row']['tag_seq'] = "col-md-6";

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Deskripsi", "deskripsi", "text"),
          array("Expired Date","expired_date","date"),
          array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),

        );
        //penempatan masih dipaling bawah
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text")
            )
        );
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );


        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__penawaran_detail","id_produk","apotek__master__produk.id");
                $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__penawaran","id_apotek__pembelian__penawaran","apotek__pembelian__penawaran_detail.id");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['where'][] = array("apotek__pembelian__penawaran_detail.sisa_qty",">","0");
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku"
                                                                                    , "nama_produk" => "Nama Produk"
                                                                                    , "sisa_qty" => "Sisa QTY"
                                                                                    );
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
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

    public static function penjualan__pemesanan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Pelanggan", "pelanggan_seq", "select", array('apotek__kontak__kontak', null, 'nama'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal Jatuh Tempo", "tgl_jatuh_tempo", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Gudang", "gudang_seq", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),

        );
        $page['crud']['row']['pelanggan_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tgl_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['gudang_seq'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Kode SKU", "kode_sku", "text"),
            array("Barcode", "barcode", "text"),
            array("Deskripsi", "deskripsi", "text"),
            array("Expired Date","expired_date","date"),
            array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma')),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );
        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__pemesanan_detail","id_produk","apotek__master__produk.id");
                $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__pemesanan","id_apotek__pembelian__pemesanan","apotek__pembelian__pemesanan_detail.id");
                
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['where'][] = array("sisa_qty",">","0");
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku",'barcode');
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku", "nama_produk" => "Nama Produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
            );




        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function penjualan__pengiriman()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Pelanggan", "pelanggan_seq", "select", array('apotek__kontak__kontak', null, 'nama'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal Jatuh Tempo", "tgl_jatuh_tempo", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

           // array("Gudang", "gudang_seq", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),

        );
        $page['crud']['row']['pelanggan_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tgl_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['gudang_seq'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Deskripsi", "deskripsi", "text"),
          array("Expired Date","expired_date","date"),
          array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma')),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );
        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__pengiriman_detail","id_produk","apotek__master__produk.id");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['join'][] = array("apotek__pembelian__pengiriman","id_apotek__pembelian__pengiriman","apotek__pembelian__pengiriman_detail.id");
                
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['where'][] = array("sisa_qty",">","0");
        
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku", "nama_produk" => "Nama Produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
            );




        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }





    public static function pembelian__tagihan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Vendor", "vendor_seq", "select", array('apotek__master__vendor', null, 'nama_vendor'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal jatuh tempo", "tanggal_jatuh_tempo", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Gudang", "gudang", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),


            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),
            array("Status Diterima", "status_diterima", "select-manual",array("1"=>"Belum Diterima","2"=>"Diterima")),

        );

        
    
        $page['crud']['edit_if']['check'] = 'row';
        $page['crud']['edit_if']['row_data'] = 'status_diterima';
        $page['crud']['edit_if']['value'] = "'1'";
        $page['crud']['edit_if']['true'] = 'true';
        $page['crud']['edit_if']['false'] = 'false';
        
        
        $page['crud']['delete_if']['check'] = 'row';
        $page['crud']['delete_if']['row_data'] = 'status_diterima';
        $page['crud']['delete_if']['value'] = "'1'";
        $page['crud']['delete_if']['true'] = 'true';
        $page['crud']['delete_if']['false'] = 'false';

        $page['crud']['insert_number_code']['nomor']['prefix'] = 'PMT/{BULAN}|/{TAHUN-y}|/';
        $page['crud']['insert_number_code']['nomor']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor']['root']['sprintf_number'][0] = 6;
        $page['crud']['insert_number_code']['nomor']['root']['month_get_row_where'][0] ='created_at';
        $page['crud']['insert_number_code']['nomor']['suffix'] = '';

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Kode SKU", "kode_sku", "text"),
            array("Barcode", "barcode", "text"),
            array("Deskripsi", "deskripsi", "text"),
            array("Expired Date","expired_date","date"),
            array("No Bacth","nobatch","text"),
            array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),

        ); 
        
        
        $ii=-1;
		$ii++;
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
		$page['crud']['oninsert_sub_kategori'][$ii]["tipe"] = "check-insert-update";
		$page['crud']['oninsert_sub_kategori'][$ii]["first_proses"] = "check";
		$page['crud']['oninsert_sub_kategori'][$ii]["proses"] = array("check","insert","update");

		$page['crud']['oninsert_sub_kategori'][$ii]["table_sub_kategori"] = "apotek__" . __FUNCTION__ . "_detail";
		
        $page['crud']['oninsert_sub_kategori'][$ii]['check']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["utama"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["join"][] = array("apotek__master__produk","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("id_produk",'=',"id_produk",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][1] = "row";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][0] = null;
        
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["utama"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["join"][] = array("apotek__" . __FUNCTION__ . "_detail","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("nama_produk",'=',"nama_produk",'string','row','row_row[0]');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][0] = "update_id";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][1] = "insert";

		$page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['get_where'] = array("id","id_produk",'sqli');

		$page['crud']['oninsert_sub_kategori'][$ii]["row"]['next_execution'] = "check2"; 
        $page['crud']['oninsert_sub_kategori'][$ii]['row']["tipe"] = "row";

        $page['crud']['oninsert_sub_kategori'][$ii]['insert']["tipe"] = "insert";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["table_insert"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['get_where'] = array("id","id_produk",'sqli');
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_kategori","id_kategori","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nama_produk","nama_produk","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("kode_sku","kode_sku","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_satuan","id_satuan","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("expired_date","expired_date","input");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_jual","harga","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_beli","harga_beli","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nobatch","nobatch","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("barcode","barcode","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['next_execution'] = "update"; 
		
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update"]['field'][] = array("id_produk","last_value","last_value_oninsert"); 
        
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update_id']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update_id"]['field'][] = array("id_produk","primary_key","database",'check[0]'); 
                


        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['no_action']["apotek__" . __FUNCTION__ . "_detail"]=true;
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_beli", "harga_beli");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("barcode", "barcode");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kode_sku", "kode_sku");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("expired_date", "expired_date");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("nobatch", "nobatch");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");

        $page['crud']['row']['vendor_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tanggal_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['gudang'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";
        //apotek__master__

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma')),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat((sub_total_input)))+(parseFloat((biaya_pengiriman_input)))-(parseFloat((diskon_input)))-(parseFloat((diskon_per_item_input)))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga_beli'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga_beli" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("((kuantitas)*(harga_beli))"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("((total_harga)*((discount)/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );


        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk","apotek__master__produk.id as primary_key");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku",'barcode');
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku"
                , "barcode" => "Barcode"
                , "nama_produk" => "Nama Produk"
                , "expired_date" => "expired_date"
                , "harga_jual" => "Harga Jual"
                , "harga_beli" => "Harga Beli"
                
            );
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
        array(
        "produk_seq" => array("row" => "primary_key", "type" => "database"),
        "kuantitas" => array("text" => 1, "type" => "text"),
        "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
        "harga" => array("row" => "harga_jual", "type" => "database"),
        "harga_beli" => array("row" => "harga_beli", "type" => "database"),
        "expired_date" => array("row" => "expired_date", "type" => "database"),
        "nobatch" => array("row" => "nobatch", "type" => "database"),
        "barcode" => array("row" => "barcode", "type" => "database"),
        "kode_sku" => array("row" => "kode_sku", "type" => "database"),
        );


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
        $page['database']['where'][] = array("$database_utama.id_apotek","=",'".'."Auth::user()->id_apotek".'."');
        return $page;
    }
    public static function pembelian__pengiriman()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Vendor", "vendor_seq", "select", array('apotek__master__vendor', null, 'nama_vendor'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal Jatuh Tempo", "tgl_jatuh_tempo", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            //array("Gudang", "gudang_seq", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),

        );
        $page['crud']['row']['vendor_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tgl_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['gudang_seq'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Deskripsi", "deskripsi", "text"),
          array("Expired Date","expired_date","date"),
          array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),


        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['no_action']["apotek__" . __FUNCTION__ . "_detail"]=true;
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");

        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma')),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga_beli'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga_beli" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga_beli)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );
        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku", "nama_produk" => "Nama Produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
            );



        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function pembelian__pemesanan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Vendor", "vendor_seq", "select", array('apotek__master__vendor', null, 'nama_vendor'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Tanggal Jatuh Tempo", "tgl_jatuh_tempo", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Gudang", "gudang_seq", "select", array('apotek__master__inventory', null, 'nama_gudang'), null),
            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file","apotek/pembelian/pemesanan/attachment"),
            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );
        
        $page['crud']['edit_if']['check'] = 'row';
        $page['crud']['edit_if']['row_data'] = 'appr_status';
        $page['crud']['edit_if']['value'] = 3;
        $page['crud']['edit_if']['true'] = 'true';
        $page['crud']['edit_if']['false'] = 'false';
        
        
        $page['crud']['delete_if']['check'] = 'row';
        $page['crud']['delete_if']['row_data'] = 'appr_status';
        $page['crud']['delete_if']['value'] = 3;
        $page['crud']['delete_if']['true'] = 'true';
        $page['crud']['delete_if']['false'] = 'false';

        $page['crud']['insert_number_code']['nomor']['prefix'] = 'PMP/{BULAN}|/{TAHUN-y}|/';
        $page['crud']['insert_number_code']['nomor']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor']['root']['sprintf_number'][0] = 6;
        $page['crud']['insert_number_code']['nomor']['root']['month_get_row_where'][0] ='created_at';
        $page['crud']['insert_number_code']['nomor']['suffix'] = '';

        $page['crud']['row']['vendor_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['tgl_jatuh_tempo'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['gudang_seq'] = "col-md-4";
        $page['crud']['row']['referensi'] = "col-md-4";
        $page['crud']['row']['tag_seq'] = "col-md-4";
        $page['crud']['button_approve_on_edit']=true;
        $ii=-1;
		$ii++;
        
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
		$page['crud']['oninsert_sub_kategori'][$ii]["tipe"] = "check-insert-update";
		$page['crud']['oninsert_sub_kategori'][$ii]["first_proses"] = "check";
		$page['crud']['oninsert_sub_kategori'][$ii]["proses"] = array("check","insert","update");

		$page['crud']['oninsert_sub_kategori'][$ii]["table_sub_kategori"] = "apotek__" . __FUNCTION__ . "_detail";
		
        $page['crud']['oninsert_sub_kategori'][$ii]['check']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["utama"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']['database']["join"][] = array("apotek__master__produk","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("id_produk",'=',"id_produk",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][1] = "row";
		$page['crud']['oninsert_sub_kategori'][$ii]['check']["if_execution"][0] = null;
        
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']["tipe"] = "check";
        $page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["utama"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']['database']["join"][] = array("apotek__" . __FUNCTION__ . "_detail","apotek__" . __FUNCTION__ . "_detail.id_produk","apotek__master__produk.id");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("nama_produk",'=',"nama_produk",'string','row','row_row[0]');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.harga_beli",'!=',"harga_beli",'number');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["where"][] = array("apotek__master__produk.expired_date",'!=',"expired_date",'string');
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if"][] = array("count_database",'==',"0");
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][0] = "update_id";
		$page['crud']['oninsert_sub_kategori'][$ii]['check2']["if_execution"][1] = "insert";

		$page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['row']["row"]['get_where'] = array("id","id_produk",'sqli');

		$page['crud']['oninsert_sub_kategori'][$ii]["row"]['next_execution'] = "check2"; 
        $page['crud']['oninsert_sub_kategori'][$ii]['row']["tipe"] = "row";

        $page['crud']['oninsert_sub_kategori'][$ii]['insert']["tipe"] = "insert";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["table_insert"] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['utama'] = "apotek__master__produk";
		$page['crud']['oninsert_sub_kategori'][$ii]['insert']["row"]['get_where'] = array("id","id_produk",'sqli');
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_kategori","id_kategori","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nama_produk","nama_produk","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("kode_sku","kode_sku","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("barcode","barcode","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("id_satuan","id_satuan","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("expired_date","expired_date","input");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("stok_minimal","stok_minimal","database");
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_jual","harga","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("harga_beli","harga_beli","input"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("nobatch","nobatch","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['field'][] = array("barcode","barcode","database"); 
		$page['crud']['oninsert_sub_kategori'][$ii]["insert"]['next_execution'] = "update"; 
		
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update"]['field'][] = array("id_produk","last_value","last_value_oninsert"); 
        
        
        $page['crud']['oninsert_sub_kategori'][$ii]['update_id']["tipe"] = "update";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["table_update"] = "apotek__" . __FUNCTION__ . "_detail";
		$page['crud']['oninsert_sub_kategori'][$ii]['update_id']["get_where"] = array("apotek__" . __FUNCTION__ . "_detail.id","","last_value_sub_kategori");
        $page['crud']['oninsert_sub_kategori'][$ii]["update_id"]['field'][] = array("id_produk","primary_key","database",'check[0]'); 
        


		
		$i=-1;
		$i++;
		$page['crud']['onappr'][$i]["tipe"] = "insert";
		$page['crud']['onappr'][$i]['insert']["table_target"] = "apotek__pembelian__tagihan";
		$page['crud']['onappr'][$i]['insert']["database"]['select'] = array("apotek__pembelian__pemesanan.id_apotek  as id_apotek_apotek__pembelian__pemesanan");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("id_vendor","id_vendor");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("tgl_transaksi","tgl_transaksi");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("tgl_jatuh_tempo","tanggal_jatuh_tempo");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("id_termin","id_termin");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("id_gudang","id_gudang");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("referensi","referensi");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("id_tag","id_tag");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("pesan","pesan");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("attachment","attachment");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("primary_key","id_pemesanan");
		$page['crud']['onappr'][$i]['insert']["field"][] = array("id_apotek","id_apotek");
		 
        $ii=-1;
		$ii++;
		$page['crud']['onappr_sub_kategori'][$ii]["tipe"] = "insert";
		$page['crud']['onappr_sub_kategori'][$ii]["table_form"] = "apotek__pembelian__pemesanan_detail";
		$page['crud']['onappr_sub_kategori'][$ii]["table_target"] = "apotek__pembelian__tagihan_detail";
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("id_apotek__pembelian__tagihan_detail","last_value_onappr_apotek__pembelian__tagihan","last_value");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("id_produk","id_produk","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("deskripsi","deskripsi","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("expired_date","expired_date","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("kuantitas","kuantitas","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("kode_sku","kode_sku","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("barcode","barcode","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("id_satuan","id_satuan","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("discount","discount","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("harga_beli","harga_beli","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("harga","harga","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("jumlah","jumlah","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("total_harga","total_harga","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("total_diskon","total_diskon","database");
		$page['crud']['onappr_sub_kategori'][$ii]["field"][] = array("nobatch","nobatch","database");
		//$page['crud']['oninput_sub_kategori'][''];
		
        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Kode SKU", "kode_sku", "text"),
            array("Barcode", "barcode", "text"),
            array("Deskripsi", "deskripsi", "text"),
            array("No Bacth","nobatch","text"),
            array("Expired Date","expired_date","date"),
            array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Pajak", "pajak_seq", "select", array('apotek__biaya__pajak', null, 'nama_pajak'), null),
            array("Jumlah", "jumlah", "number"),
            array("Total Pajak", "total_pajak", "hidden_input"),
            array("Total Harga", "total_harga", "hidden_input"),
            array("Total Diskon", "total_diskon", "hidden_input"),
            array("ID Pembelian", "id_pembelian", "hidden_input"),


        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search; 
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['no_action']["apotek__" . __FUNCTION__ . "_detail"]=true;
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_beli", "harga_beli");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kode_sku", "kode_sku");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("barcode", "barcode");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("expired_date", "expired_date");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("nobatch", "nobatch");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),
                array("name" => "Uang Muka", 
                    "id" => "uang_muka", 
                    "eventInput" => array("onkeyup" => "sisa_tagihan"),
                    "type" => "input_no_result_multi",
                    "with_input" => true,
                    "col_row" => array("col-3", "col-5", "col-4"),
                    //input -> thisvalue
                    "array" => array(

                        array("", "akun_uang_muka_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'auma')),
                    ),

                    "select" => array("%", "Rp"),
                    
                    "function_js" => array(
                        "%" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("total_input" => "id"),
                            "call_function" => array("sisa_tagihan"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),
                array("name" => "Sisa Tagihan", "id" => "sisa_tagihan", "type" => "text"),
            )
        );

        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sisa_tagihan"
                ),
            ),

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sisa_tagihan",
            "get" => array("total_input" => "id", "uang_muka_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(total_input))-(parseFloat(uang_muka_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sisa_tagihan_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sisa_tagihan_content",
                    "input" => "id",
                    "var" => "result"
                ),

            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga_beli'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga_beli" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga_beli)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );
        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku",'barcode');
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku"
                                                                                                                , "barcode" => "Barcode"
                                                                                                                , "nama_produk" => "Nama Produk"
                                                                                                                , "expired_date" => "Expired Date"
                                                                                                                , "harga_jual" => "Harga Jual"
                                                                                                                , "harga_beli" => "Harga Beli"
                                                                                                            );
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
                "harga_beli" => array("row" => "harga_beli", "type" => "database"),
                "expired_date" => array("row" => "expired_date", "type" => "database"),
                "nobatch" => array("row" => "nobatch", "type" => "database"),
                "barcode" => array("row" => "barcode", "type" => "database"),
                "kode_sku" => array("row" => "kode_sku", "type" => "database"),
            );



        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['crud']['insert_default_value']['id_apotek'] = 'Auth::user()->id_apotek';
        $page['database']['where'][] = array("$database_utama.id_apotek","=",'".'."Auth::user()->id_apotek".'."');
        return $page;
    }
    public static function pembelian__penawaran()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Vendor", "vendor_seq", "select", array('apotek__master__vendor', null, 'nama_vendor'), null),
            array("Nomor", "nomor", "text"),

            array("Tgl transaksi", "tgl_transaksi", "date"),
            array("Kadaluarsa", "kadaluarsa", "date"),
            array("Termin", "termin_seq", "select", array('apotek__master__termin', null, 'nama_termin'), null),

            array("Referensi", "referensi", "text"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Pesan", "pesan", "textarea"),
            array("Attachment", "attachment", "file"),

        );
        $search=array();
        $page['crud']['row']['vendor_seq'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tgl_transaksi'] = "col-md-4";
        $page['crud']['row']['kadaluarsa'] = "col-md-4";
        $page['crud']['row']['termin_seq'] = "col-md-4";

        $page['crud']['row']['referensi'] = "col-md-6";
        $page['crud']['row']['tag_seq'] = "col-md-6";

        $sub_kategori[] = ["", "apotek__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Produk", "produk_seq", "select", array('apotek__master__produk', null, 'nama_produk'), null),
            array("Deskripsi", "deskripsi", "text"),
          array("Expired Date","expired_date","date"),
          array("Kuantitas", "kuantitas", "number"),
            array("Satuan", "satuan_seq", "select", array('apotek__master__satuan', null, 'nama_satuan'), null),
            array("Discount", "discount", "number"),
            array("Harga Beli", "harga_beli", "number"),
            array("Harga Jual", "harga", "number"),
            array("Jumlah", "jumlah", "number"),

        );
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['no_action']["apotek__" . __FUNCTION__ . "_detail"]=true;
        $page['crud']['no_row_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");

         $page['crud']['total'] = array(
            "col-row" => "col-md-7 offset-md-5",
            "content" => array(
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text")
            )
        );
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['utama'] = "apotek__master__produk";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['database']['select_raw'] = "*,1 as kuantitas";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['request_where'] = "apotek__master__produk.<!ONTABLE></!ONTABLE>";
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("kuantitas", "kuantitas");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("satuan_id", "satuan_seq");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][] = array("harga_jual", "harga");
        $page['crud']['field_value_automatic_sub_kategori']['produk_seq']['call_function'][] = array("harga_jual", "harga");
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),
            )

        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("kuantitas", "discount", 'harga_beli'),
            "id_row" => true,
            "input" => array("onkeyup"),
            "get" => array("kuantitas" => "id_row", "harga_beli" => "id_row", "discount" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(kuantitas*harga_beli)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(discount/100))"),
                    "var" => "total_diskon"
                ),

                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "jumlah",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )

        );


        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['insert_default_value_sub_kategori_request']["apotek__" . __FUNCTION__ . "_detail"]['sisa_qty'] = 'kuantitas';

        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['input'] = "Search Barcode/SKU";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['call_function'] = array("change_subtotal(this,output)", "sub_total()");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['utama'] = "apotek__master__produk";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['primary_key'] = null;
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['database']['select'] = array("*","apotek__master__produk.id as id_produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search'] = "kode_sku";
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['search_row'] = array("nama_produk", "kode_sku");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_detail'] = array("kode_sku" => "Kode Sku", "nama_produk" => "Nama Produk");
        $page['crud']['search_load_sub_kategori']["apotek__" . __FUNCTION__ . "_detail"]['array_result'] =
            array(
                "produk_seq" => array("row" => "primary_key", "type" => "database"),
                "kuantitas" => array("text" => 1, "type" => "text"),
                "satuan_seq" => array("row" => "satuan_id", "type" => "database"),
                "harga" => array("row" => "harga_jual", "type" => "database"),
            );



        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function aset_tetap()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Gambar Aset Tetap", "gambar_aset", "file"),

            array("Nama aset", "nama_aset", "text"),
            array("Nomor", "nomor", "number"),

            array("Tanggal Pembelian", "tanggal_pembelian", "date"),
            array("Harga Beli", "harga_beli", "number"),

            array("Akun Aset Tetap", "akun_aset_tetap_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'ata')),
            array("Dikreditkan dari akun", "kredit_akun_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'aka'), null),

            array("Deskripsi", "deskripsi", "textarea"),
            array("Tag", "tag_seq", "select", array('apotek__master__tag', null, 'nama_tag'), null),

            array("Referensi", "referensi", "text"),

            array("Tanpa Penyusutan", "penyusutan", "select", array("0" => "Tanpa Penyusutan", "1" => "Dengan Penyusutan"), null),
        );
        $page['crud']['row']['nama_aset'] = "col-md-6";
        $page['crud']['row']['nomor'] = "col-md-6";

        $page['crud']['row']['tanggal_pembelian'] = "col-md-6";
        $page['crud']['row']['harga_beli'] = "col-md-6";

        $page['crud']['row']['akun_aset_tetap_seq'] = "col-md-6";
        $page['crud']['row']['kredit_akun_seq'] = "col-md-6";

        $page['crud']['row']['deskripsi'] = "col-md-6";
        $page['crud']['row']['referensi'] = "col-md-6";
        $page['crud']['row']['tag_seq'] = "col-md-6";

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
    public static function kas_bank()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apotek__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

           
            array("Akun ", "akun_seq", "select", array('apotek__keuangan__akun', null, 'nama_akun', 'ata')),
          
            array("Saldo", "saldo", "number"),

        );
        $page['crud']['row']['akun_seq'] = "col-md-12";
        $page['crud']['row']['saldo'] = "col-md-12";

        $page['crud']['row']['tanggal_pembelian'] = "col-md-6";
        $page['crud']['row']['harga_beli'] = "col-md-6";

        $page['crud']['row']['akun_aset_tetap_seq'] = "col-md-6";
        $page['crud']['row']['kredit_akun_seq'] = "col-md-6";

        $page['crud']['row']['deskripsi'] = "col-md-6";
        $page['crud']['row']['referensi'] = "col-md-6";
        $page['crud']['row']['tag_seq'] = "col-md-6";

        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }public static function bahan_baku__supplier__kontrabonx()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__pos__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("No Kontrabon", "no_kontrabon", "text"),
            array("Tanggal Pengajuan Kontrabon", "tanggal_pengajuan_kontrabon", "date"),
            array("Nama Supplier", "supplier_seq", "select", array("outsourcing__supplier", null, "nama_suplier"), null),

            array("TOP", "topsup", "text"),
            array("Tanggal Jatuh Tempo", "tanggal_jatuh_tempo", "date"),

            array("Bank", "bank_kontrabon", "text"),
            array("No Rek Kontrabon", "norek_kontrabon", "text"),
            array("No Receive", "erp__bahan_baku__supplier__receive_seq_kontra", "select-nosave", array("erp__bahan_baku__supplier__receive", null, "no_receive"), null),

            array("appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $page['crud']['select_database_costum']['erp__bahan_baku__supplier__receive_seq_kontra']['whereRaw'] = "erp__bahan_baku__supplier__receive.active = 1				
				
				and (
				COALESCE((select sum(qty_receive) from erp__bahan_baku__supplier__receive_detail a  where a.erp__bahan_baku__supplier__receive_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} and a.active=1),0)-COALESCE((select sum(qty_kontrabon) from purchasing_kontrabon_detail 
					 where purchasing_kontrabon_detail.active = 1 and erp__bahan_baku__supplier__receive_in_kontrabon_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} ),0)
				) > 0";


        $page['crud']['appr_no_select'] = true;
        $page['crud']['costum_class']['supplier_seq'] = 'select2';
        //$page['crud']['crud_inline']['supplier_seq'] = 'onchange="get_spesific_supplier(this);receive(this)"';
        $page['crud']['crud_inline']['topsup'] = 'onchange="jatuh_tempo()";onkeyup="jatuh_tempo()";';
        // $page['crud']['crud_after'] = $this->js_kontrabon();
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Tanggal Recive", "tanggal_receive_in_kontrabon", "date"),


            array("No Receive", "erp__bahan_baku__supplier__receive_in_kontrabon_seq", "select", array("erp__bahan_baku__supplier__receive", null, "no_receive", "c"), null),
            array("No PO", "erp__bahan_baku__supplier__purchase__order_in_kontrabon_seq", "select", array("erp__bahan_baku__supplier__purchase__order", null, "no_purchose_order", "b"), null),
            array("Raw Material", "inventaris__asset__list_kontrabon_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
            array("QTY Receive", "qty_kontrabon", "number"),
            array("Harga Beli Satuan", "harga_beli_kontrabon", "number"),
            array("Dics(%)", "diskon_kontrabon", "number"),
            array("Total", "total_kontrabon", "number"),


        );
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__bahan_baku__supplier__receive_detail", "erp__bahan_baku__supplier__receive_detail_in_kontrabon_seq", "erp__bahan_baku__supplier__receive_detail.seq");
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__bahan_baku__supplier__receive", "erp__bahan_baku__supplier__receive_detail.erp__bahan_baku__supplier__receive_seq", "erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE}");
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__bahan_baku__supplier__purchase__order", "erp__bahan_baku__supplier__receive.erp__bahan_baku__supplier__purchase__order_seq", "erp__bahan_baku__supplier__purchase__order.seq");

        $page['crud']['no_edit'] = true;
        $page['crud']['no_delete'] = true;

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['database_sub_kategori'] = $database_sub_kategori;


        $page['crud']['insert_number_code']['no_kontrabon']['prefix'] = 'KB.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_kontrabon']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_kontrabon']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_kontrabon']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_kontrabon']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_pengajuan_kontrabon'] = 'date:now';
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';


        $page['crud']['field_value_automatic_select_target']['supplier_seq']['database']['utama'] = "erp__bahan_baku__supplier__receive";
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['database']['join'][] = array("erp__bahan_baku__supplier__purchase__order", "erp__bahan_baku__supplier__receive.erp__bahan_baku__supplier__purchase__order_seq", "erp__bahan_baku__supplier__purchase__order.seq");
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['database']['whereRaw'] = " erp__bahan_baku__supplier__receive.active = 1				
				
				and (
				COALESCE((select sum(qty_receive) from erp__bahan_baku__supplier__receive_detail a  where a.erp__bahan_baku__supplier__receive_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} and a.active=1),0)-COALESCE((select sum(qty_kontrabon) from purchasing_kontrabon_detail 
					 where purchasing_kontrabon_detail.active = 1 and erp__bahan_baku__supplier__receive_in_kontrabon_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} ),0)
				) > 0 ";
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['request_where'] = "supplier_seq";
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['target'] = "erp__bahan_baku__supplier__receive_seq_kontra";
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['value'] = "primary_key";
        $page['crud']['field_value_automatic_select_target']['supplier_seq']['option'] = "no_receive";

        $page['crud']['field_value_automatic']['supplier_seq']['database']['utama'] = "outsourcing__supplier";
        $page['crud']['field_value_automatic']['supplier_seq']['request_where'] = "outsourcing__supplier.seq";
        $page['crud']['field_value_automatic']['supplier_seq']['field'][] = array("bank", "bank_kontrabon");
        $page['crud']['field_value_automatic']['supplier_seq']['field'][] = array("no_rekening", "norek_kontrabon");

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['type'] = 'add'; //get or add
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['utama'] = "erp__bahan_baku__supplier__receive_detail";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['select_raw'] = "*,erp__bahan_baku__supplier__receive_detail.seq as primary_key";

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['where'][] = array('erp__bahan_baku__supplier__receive_detail.active', '=', "1");
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['join'][] = array("erp__bahan_baku__supplier__receive", "erp__bahan_baku__supplier__receive_seq", "erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE}");
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['database']['join'][] = array("erp__bahan_baku__supplier__purchase__order", "erp__bahan_baku__supplier__receive.erp__bahan_baku__supplier__purchase__order_seq", "erp__bahan_baku__supplier__purchase__order.seq");
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['request_where'] = "erp__bahan_baku__supplier__receive_seq";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__bahan_baku__supplier__receive_detail_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "tanggal_receive_in_kontrabon",
            array("Tanggal Receive", "tanggal_receive", "number"),
        );

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "erp__bahan_baku__supplier__receive_in_kontrabon_seq",
            array("No Receive", "erp__bahan_baku__supplier__receive_seq", "select", array("erp__bahan_baku__supplier__receive", null, "no_receive", "r"), null),


        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "no_purchose_order_in_kontrabon",
            array("No Po", "no_purchose_order", "text"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "erp__bahan_baku__supplier__purchase__order_in_kontrabon_seq",
            array("No Po", "erp__bahan_baku__supplier__purchase__order_seq", "hidden"),
        );


        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "inventaris__asset__list_kontrabon_seq",
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
        );

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "qty_kontrabon",
            array("QTY Receive", "qty_receive", "number"),
        );



        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "harga_beli_kontrabon",
            array("QTY Receive", "harga_beli_receive", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "diskon_kontrabon",
            array("QTY Receive", "diskon_receive", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__receive_seq_kontra']['field'][] = array(
            -1, "total_kontrabon",
            array("QTY Receive", "total_receive", "number"),
        );

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;





        $page['crud']['search'] = array(-1 => array(12, 1), 4    => array(12));
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;

        $page['get']['sidebarIn'] = true;;
        return $page;
        // $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function bahan_baku__supplier__paymentx()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("No Payment", "no_payment", "text"),

            array("Tanggal Payment", "tanggal_payment", "date"),
            array("Nama Supplier", "supplier_payment_seq", "select", array("outsourcing__supplier", null, "nama_suplier"), null),

            array("Total Pembayaran", "total_pembayaran", "text-number-editview"),
            array("No Kontrabon", "purchasing_kontrabon_seq_payment", "select-nosave", array("erp__kontrabon", null, "no_kontrabon"), null),

        );
        // $page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("No Kontrabon", "purchasing_kontrabon_in_payment_seq", "select", array("erp__kontrabon", null, "no_kontrabon"), null),
            array("Tanggal Kontrabon", "tanggal_pengajuan_kontrabon_payment", "date"),
            array("Total QTY kontrabon", "qty_payment", "number"),
            array("Total Harga", "total_harga", "number"),
            array("Total Bayar", "total_payment", "number"),


        );
        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['database']['utama'] = "erp__kontrabon";

        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['database']['whereRaw'] = " purchasing_kontrabon.active = 1				
				
				and (
			select COALESCE(sum(total_kontrabon),0) from purchasing_kontrabon_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE}  = purchasing_kontrabon_detail.purchasing_kontrabon_seq-
    	(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq)) > 0  ";
        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['request_where'] = "purchasing_kontrabon.supplier_seq";
        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['target'] = "purchasing_kontrabon_seq_payment";
        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['value'] = "primary_key";
        $page['crud']['field_value_automatic_select_target']['supplier_payment_seq']['option'] = "no_kontrabon";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['type'] = 'add'; //get or add
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['utama'] = "erp__kontrabon";
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['select_raw'] = "*,purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} as primary_key,
       
       	(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq and purchasing_payment_detail.active=1) as total_payment_bayar,
       	purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} as primary_key, 
    	(select sum(qty_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) as qty_kontrabon,
    	(select sum(total_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) as total_kontrabon,
    	((select sum(total_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) -(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq and purchasing_payment_detail.active=1) ) as total_harga 
		";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['where'][] = array('purchasing_kontrabon.active', '=', "1");
        //$page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['join'][] = array("erp__bahan_baku__supplier__receive","erp__bahan_baku__supplier__receive_seq","erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE}");
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['request_where'] = "purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE}";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "purchasing_kontrabon_in_payment_seq",
            array("No Kontrabon", null, "select", array("erp__kontrabon", null, "no_kontrabon", 'a'), null),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "tanggal_pengajuan_kontrabon_payment",
            array("Tanggal Kontrabon", "tanggal_pengajuan_kontrabon", "date"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "qty_payment",
            array("Total QTY kontrabon", "qty_kontrabon", "number"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "total_harga",
            array("Total QTY kontrabon", "total_harga", "number"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            0, "total_payment",
            array("Total Bayar", "total_payment", "number"),
        );

        $page['crud']['costum_class']['supplier_payment_seq'] = 'select2';
        //$page['crud']['crud_inline']['supplier_payment_seq'] = 'onchange="kontrabon(this)"';

        $page['crud']['function']['total_pembayaran']['type'] = 'help';
        $page['crud']['function']['total_pembayaran']['function'] = 'rupiah';
        $page['crud']['function']['total_pembayaran']['param'][] = '!!!row???';
        $page['crud']['function']['total_pembayaran']['param'][] = null;
        $page['crud']['function']['total_pembayaran']['param'][] = '';

        //$page['crud']['sub_kategori_costum']['no_tambah']["purchasing_".__FUNCTION__."_detail"]=true;
        $page['crud']['no_edit'] = true;

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        //$page['crud']['form_route_costum']['tambah'] = 'simpan_payment';


        $page['crud']['insert_number_code']['no_payment']['prefix'] = 'AP.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_payment']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_payment']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_payment']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_payment']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_payment'] = 'date:now';




        //  //purchasing_kontrabon_seq_payment


        $select = array("*");
        $join = array();
        $where = array();


        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bahan_baku__supplier__request_outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;



        $array = array(
            array("No Request", "no_request", "text"),
            array("Tanggal Permintaan", "tanggal_permintaan", "date"),
            array("Departemen", "hcms__struktur__divisi_seq", "select", array("hcms__struktur__divisi", null, "nama_divisi"), null),
            array("Tanggal Kebutuhan", "tanggal_kebutuhan", "date"),
            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),

            array("Nama Bahan Baku", "inventaris__asset__list_request_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_request_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
            array("QTY Request", "qty_request", "number"),



        );




        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['insert_number_code']['no_request']['prefix'] = 'RQ.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_request']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_request']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_request']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_request']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_permintaan'] = 'date:now';
        $page['crud']['insert_value']['tanggal_kebutuhan'] = 'date:now';



        //$idUser = Auth::user()->id;
        $page['crud']['appr_no_select'] = true;

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bahan_baku__supplier__outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;


        $page['crud']['appr_no_select'] = true;
        $array = array(

            array("No Outgoing", "no_outgoing", "text"),
            array("Tanggal Outgoing", "tanggal_outgoing", "date"),
            array("No Request", "no_request_outgoing", "select", array("erp__bahan_baku__supplier__request_outgoing", null, "no_request"), null),
            array("Departemen", "hcms__struktur__divisi_outgoing_seq", "select", array("hcms__struktur__divisi", null, "nama_divisi"), null),
            array("Tanggal Kebutuhan", "tanggal_kebutuhan_outgoing", "date"),

            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

            //array("Lokasi","lokasi","text"),

        );

        $page['crud']['field_value_automatic']['no_request_outgoing']['database']['utama'] = "erp__bahan_baku__supplier__request_outgoing";
        $page['crud']['field_value_automatic']['no_request_outgoing']['request_where'] = "erp__bahan_baku__supplier__request_outgoing.seq";
        $page['crud']['field_value_automatic']['no_request_outgoing']['field'][] = array("hcms__struktur__divisi", "hcms__struktur__divisi_outgoing_seq");
        $page['crud']['field_value_automatic']['no_request_outgoing']['field'][] = array("tanggal_kebutuhan", "tanggal_kebutuhan_outgoing");

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['utama'] = "erp__bahan_baku__supplier__request_outgoing_detail";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['select_raw'] = "*,erp__bahan_baku__supplier__request_outgoing_detail.seq as primary_key , ((select sum(qty_receive) from erp__bahan_baku__supplier__receive_detail 
			join erp__bahan_baku__supplier__receive on erp__bahan_baku__supplier__receive_detail.erp__bahan_baku__supplier__receive_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE}
		where erp__bahan_baku__supplier__receive_detail.inventaris__asset__list_seq = inventaris__asset__list_request_seq and erp__bahan_baku__supplier__receive.active=1
		and cek_status=1 and erp__bahan_baku__supplier__receive_detail.active=1
		)-(select sum(qty_receive_retur) from erp__retur_detail
			join erp__retur on erp__retur_detail.erp__retur_seq = erp__retur.seq
		where erp__retur_detail.inventaris__asset__list_retur_seq = inventaris__asset__list_request_seq and erp__retur.active=1 
		and erp__retur_detail.active=1
		)-(select sum(qty_outgoing) from erp__bahan_baku__supplier__outgoing_detail
			join erp__bahan_baku__supplier__outgoing on erp__bahan_baku__supplier__outgoing_detail.erp__bahan_baku__supplier__outgoing_seq = erp__bahan_baku__supplier__outgoing.seq
		where erp__bahan_baku__supplier__outgoing_detail.inventaris__asset__list_request_in_outgoing_seq = inventaris__asset__list_request_seq and erp__bahan_baku__supplier__outgoing.active=1 and erp__bahan_baku__supplier__outgoing_detail.active=1
		and appr_status=1
		)+(select sum(qty_retur_outgoing) from erp__retur_outgoing_detail
			join erp__retur_outgoing on erp__retur_outgoing_detail.erp__retur_outgoing_seq = erp__retur_outgoing.seq
		where erp__retur_outgoing_detail.inventaris__asset__list_in_retur_outgoing_seq = inventaris__asset__list_request_seq and erp__retur_outgoing.active=1  and erp__retur_outgoing_detail.active=1
		and appr_status=1
		)) as stok_akhir
       
       ";
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__bahan_baku__supplier__request_outgoing","erp__bahan_baku__supplier__request_outgoing_seq","erp__bahan_baku__supplier__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['request_where'] = "erp__bahan_baku__supplier__request_outgoing_seq";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__bahan_baku__supplier__request_outgoing_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "inventaris__asset__list_request_in_outgoing_seq", array("Nama Bahan Baku", "inventaris__asset__list_request_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "inventaris__master__satuan_request_in_outgoing_seq", array("Satuan", "inventaris__master__satuan_request_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "sisa_stok", array("QTY Request", "stok_akhir", "number"));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "qty_request_in_outgoing", array("QTY Request", "qty_request", "number"));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(0, "qty_outgoing", array("QTY Outgoing", "qty_outgoing", "number"));

        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['select_database_costum']['no_request_outgoing']['whereRaw'] = "erp__bahan_baku__supplier__request_outgoing.active = 1
        				and erp__bahan_baku__supplier__request_outgoing.appr_status = 1
        				and (
        				COALESCE((select sum(qty_request) from erp__bahan_baku__supplier__request_outgoing_detail a  where a.erp__bahan_baku__supplier__request_outgoing_seq = erp__bahan_baku__supplier__request_outgoing.seq and a.active=1),0)-COALESCE((select sum(qty_outgoing) from erp__bahan_baku__supplier__outgoing_detail join erp__bahan_baku__supplier__outgoing on erp__bahan_baku__supplier__outgoing_detail.erp__bahan_baku__supplier__outgoing_seq = erp__bahan_baku__supplier__outgoing.seq where erp__bahan_baku__supplier__outgoing_detail.active = 1 and erp__bahan_baku__supplier__outgoing.no_request_outgoing = erp__bahan_baku__supplier__request_outgoing.seq ),0)
        				) > 0";


        $page['crud']['insert_number_code']['no_outgoing']['prefix'] = 'OUT.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_outgoing']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_outgoing']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_outgoing']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_outgoing']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_outgoing'] = 'date:now';

        $page['crud']['insert_value']['tanggal_outgoing'] = date('Y-m-d');
        //OUT.0223.00004

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(


            array("Nama Bahan Baku", "inventaris__asset__list_request_in_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_request_in_outgoing_seq", "select", array("inventaris__master__satuan", null, "nama_satuan", 'a'), null),
            array("Sisa Stok", "sisa_stok", "number"),
            array("QTY Request", "qty_request_in_outgoing", "number"),
            array("QTY Outgoing", "qty_outgoing", "number"),

        );
        // if ($type == 'edit') {
        $page['crud']['crud_disabled_value']['inventaris__master__satuan_request_in_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_request_in_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_request_in_outgoing'] = 'disabled"';
        $page['crud']['crud_disabled_value']['no_request_outgoing'] = 'disabled';
        $page['crud']['crud_disabled_value']['sisa_stok'] = 'disabled';
        //}
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        //$idUser = Auth::user()->id;


        $page['crud']['search'] = array(-2 => array(12, 1), 0 => array(12));
        $page['crud']['appr_no_select'] = true;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bahan_baku__supplier__receivex()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;



        $array = array(
            array("No Receive", "no_receive", "text"),
            array("Tanggal Receive", "tanggal_receive", "date"),
            array("No Invoice Supplier", "no_inv_sup_receive", "text"),
            array("No Purchose Order", "erp__bahan_baku__supplier__purchase__order_seq", "select", array("erp__bahan_baku__supplier__purchase__order", null, "no_purchose_order"), null),

            array("Cek", "cek", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),


        );
        $page['crud']['crud_disabled_value']['no_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['erp__bahan_baku__supplier__purchase__order_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__master__satuan_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_sisa_awal_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['harga_beli_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['diskon_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['total_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_sisa_akhir_receive'] = 'disabled';


        $page['crud']['select_database_costum']['erp__bahan_baku__supplier__purchase__order_seq']['whereRaw'] = "erp__bahan_baku__supplier__purchase__order.active = 1
        				and erp__bahan_baku__supplier__purchase__order.appr_status = 1
        				and erp__bahan_baku__supplier__purchase__order.status_po = 'Open'
        				and (
        				COALESCE((select sum(qty_pesanan) from erp__bahan_baku__supplier__purchase__order_detail a  where a.erp__bahan_baku__supplier__purchase__order_seq = erp__bahan_baku__supplier__purchase__order.seq and a.active=1),0)-
        				COALESCE((select sum(qty_receive) from erp__bahan_baku__supplier__receive_detail join erp__bahan_baku__supplier__receive on erp__bahan_baku__supplier__receive_detail.erp__bahan_baku__supplier__receive_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} where erp__bahan_baku__supplier__receive.active = 1 and erp__bahan_baku__supplier__receive.erp__bahan_baku__supplier__purchase__order_seq = erp__bahan_baku__supplier__purchase__order.seq ),0)
        				) > 0";


        $page['crud']['function']['tanggal_receive']['type'] = 'help';
        $page['crud']['function']['tanggal_receive']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_receive']['param'][] = '!!!row???';

        $page['crud']['non_view']['PDFPage']['user_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr_id'] = true;
        $page['crud']['non_view']['PDFPage']['cek'] = true;
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];


        // $page['crud']['crud_after'] = $this->js_receive();

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
            array("QTY PO", "qty_sisa_awal_receive", "number"),
            array("QTY Receive", "qty_receive", "number"),
            array("QTY Sisa", "qty_sisa_akhir_receive", "number"),
            array("Harga Beli Satuan", "harga_beli_receive", "number"),
            array("Dics(%)", "diskon_receive", "number"),
            array("Total", "total_receive", "number"),
            array("detail", "erp__bahan_baku__supplier__purchase__order_detail_seq", "hidden"),


        );
        $page['crud']['crud_inline']['qty_receive'] = 'onkeyup="maxinput_recive(this,!!!var:no???);change_qty(this,!!!var:no???);" onchange="maxinput_recive(this,!!!var:no???);change_qty(this,!!!var:no???);" max="!!!row:qty_sisa_akhir_receive???"';

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;


        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['database']['utama'] = "erp__bahan_baku__supplier__purchase__order_detail";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['database']['select_raw'] = "*,erp__bahan_baku__supplier__purchase__order_detail.seq as primary_key,(
        				(qty_pesanan)- COALESCE((select sum(qty_receive) from erp__bahan_baku__supplier__receive_detail join erp__bahan_baku__supplier__receive on erp__bahan_baku__supplier__receive_detail.erp__bahan_baku__supplier__receive_seq = erp__bahan_baku__supplier__receive.{IDTABLE}erp__bahan_baku__supplier__receive{/IDTABLE} where erp__bahan_baku__supplier__receive.active = 1 and erp__bahan_baku__supplier__receive.erp__bahan_baku__supplier__purchase__order_seq = erp__bahan_baku__supplier__purchase__order_detail.erp__bahan_baku__supplier__purchase__order_seq ),0) ) as qty_sisa_akhir_receive";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['database']['where'][] = array('erp__bahan_baku__supplier__purchase__order_detail.active', '=', "1");
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__bahan_baku__supplier__request_outgoing","erp__bahan_baku__supplier__request_outgoing_seq","erp__bahan_baku__supplier__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['request_where'] = "erp__bahan_baku__supplier__purchase__order_seq";
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__bahan_baku__supplier__purchase__order_seq'] = 'value';

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "inventaris__asset__list_seq",
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "inventaris__master__satuan_seq",
            array("Satuan", "inventaris__master__satuan_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
        );


        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "qty_sisa_awal_receive",
            array("QTY PO", "qty_pesanan", "number")
        );

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            0, "qty_receive",
            array("QTY Receive", "qty_receive", "number"),
        );



        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "qty_sisa_akhir_receive",
            array("QTY Receive", "qty_sisa_akhir_receive", "number"),
        );

        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "harga_beli_receive",
            array("Harga Beli", "harga_beli", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "diskon_receive",
            array("Diskon", "diskon", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "total_receive",
            array("Total", "total", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__bahan_baku__supplier__purchase__order_seq']['field'][] = array(
            -1, "erp__bahan_baku__supplier__purchase__order_detail_seq",
            array("No Po", "primary_key", "hidden"),
        );


        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;




        $page['crud']['function']['total_receive']['type'] = 'help';
        $page['crud']['function']['total_receive']['function'] = 'rupiah';
        $page['crud']['function']['total_receive']['param'][] = '!!!value???';
        $page['crud']['function']['total_receive']['param'][] = null;
        $page['crud']['function']['total_receive']['param'][] = '';

        $page['crud']['function']['harga_beli_receive']['type'] = 'help';
        $page['crud']['function']['harga_beli_receive']['function'] = 'rupiah';
        $page['crud']['function']['harga_beli_receive']['param'][] = '!!!value???';
        $page['crud']['function']['harga_beli_receive']['param'][] = null;
        $page['crud']['function']['harga_beli_receive']['param'][] = '';
        //  $db->leftjoin($join[$i][0], $join[$i][1], '=', $join[$i][2]);
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__bahan_baku__supplier__purchase__order_detail", "erp__bahan_baku__supplier__purchase__order_detail_seq", "erp__bahan_baku__supplier__purchase__order_detail.seq");
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['database_sub_kategori'] = $database_sub_kategori;
        //['database_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['join'][0]


        //$idUser = Auth::user()->id;
        //$page['crud']['insert_default_value']['user_id'] = $idUser;

        /*
        $checking =  $this->checking_database($page, $database_utama);;
        $number = 1;
        if ($checking[0]->exists_) {

            $db = DB::connection()->select("SELECT max(" . $primary_key . ") as max FROM " . $database_utama);
            $number = $db[0]->max + 1;
        }*/
        $page['crud']['insert_number_code']['no_receive']['prefix'] = 'RO.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_receive']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_receive']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_receive']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_receive']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_receive'] = 'date:now';


        //  $page['crud']['prefix_list']['erp__bahan_baku__supplier__purchase__order_seq'] = "<a href='".route('tambah_receive','{--$data->erp__bahan_baku__supplier__purchase__order_seq--}')."'>";
        // $page['crud']['sufix_list']['erp__bahan_baku__supplier__purchase__order_seq'] = "</a>";
        // $page['crud']['add']['link'] = route('tambah_receive');
        // $page['crud']['add']['text'] = 'Add Recieve';
        //$page['crud']['no_add'] = true;
        // $page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();


        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));
        $page['crud']['appr_no_select'] = true;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
        //$page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bahan_baku__supplier__retur()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;
        $page['database']['utama'] = "purchasing_" . __FUNCTION__;
        $page['database']['primary_key'] = null;

        $page['database']['join'] = array();
        $page['database']['where'] = array();


        $page['crud']['insert_number_code']['no_retur']['prefix'] = 'RR.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_retur']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_retur']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_retur']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_retur']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_retur'] = 'date:now';

        $array = array(
            array("No Retur", "no_retur", "text"),
            array("Tanggal Retur", "tanggal_retur", "date"),
            array("No Receive", "no_receive_retur", "select", array("erp__bahan_baku__supplier__receive", null, "no_receive"), null),

            //array("Lokasi","lokasi","text"),

        );

        $page['crud']['form_route_costum']['tambah'] = 'simpan_retur';
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_retur_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("QTY Receive", "qty_receive_retur", "number"),
            // array("QTY Terima", "qty_terima", "number"),
            array("QTY Retur", "qty_retur", "number"),
            array("Keterangan", "keterangan", "textarea"),


        );


        $page['crud']['crud_inline']['no_receive_retur'] = 'onchange="receive_item(this)";';
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $page['crud']['sub_kategori_costum']['no_tambah']["erp__" . __FUNCTION__ . "_detail"] = true;
        /*if ($type == 'tambah') {
            $page['crud']['crud_after'] = '<table style="border-collapse: collapse;width:100%" class="table table-striped pb-5"  border="1">
                                        	<thead>
                                        	<tr>
                                        	<th>No</th>
										<th>Nama Bahan Baku</th><th>QTY Receive</th><!--<th>QTY Terima</th>--><th>QTY Retur</th><th>Keterangan</th><th></th>
											
											</tr>
										</thead>
										<tbody id="receive_detail">

										 	
										 </tbody></table>' . $this->js_retur();
        }*/
        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bahan_baku__supplier__retur_outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;
        $page['database']['utama'] = "purchasing_" . __FUNCTION__;
        $page['database']['primary_key'] = null;

        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['crud']['insert_number_code']['no_retur_outgoing']['prefix'] = 'RT.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_retur_outgoing']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_retur_outgoing'] = 'date:now';

        $array = array(
            array("No Retur_outgoing", "no_retur_outgoing", "text"),
            array("Tanggal Retur", "tanggal_retur_outgoing", "date"),
            array("No Outgoing", "no_outgoing_in_retur", "select", array("erp__bahan_baku__supplier__outgoing", null, "no_outgoing"), null),
            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_in_retur_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("QTY Outgoing", "qty_outgoing_in_retur", "number"),
            array("QTY Retur", "qty_retur_outgoing", "number"),
            array("Keterangan", "keterangan_retur_outgoing", "textarea"),


        );
        $page['crud']['crud_disabled_value']['no_outgoing_in_retur'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_in_retur_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_outgoing_in_retur'] = 'disabled';
        $page['crud']['select_database_costum']['no_outgoing_in_retur']['whereRaw'] = "erp__bahan_baku__supplier__outgoing.active = 1
        				and erp__bahan_baku__supplier__outgoing.active = 1
        				and (
        				COALESCE((select sum(qty_outgoing) from erp__bahan_baku__supplier__outgoing_detail a  where a.erp__bahan_baku__supplier__outgoing_seq = erp__bahan_baku__supplier__outgoing.seq and a.active=1),0)-COALESCE((select sum(qty_retur_outgoing) from erp__retur_outgoing_detail join erp__retur_outgoing on erp__retur_outgoing_detail.erp__retur_outgoing_seq = erp__retur_outgoing.seq where erp__retur_outgoing_detail.active = 1 and erp__retur_outgoing.no_outgoing_in_retur = erp__bahan_baku__supplier__outgoing.seq ),0)
        				) > 0";

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['database']['utama'] = "erp__bahan_baku__supplier__outgoing_detail";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['database']['primary_key'] = null;
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__bahan_baku__supplier__request_outgoing","erp__bahan_baku__supplier__request_outgoing_seq","erp__bahan_baku__supplier__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['request_where'] = "erp__bahan_baku__supplier__outgoing_seq";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__bahan_baku__supplier__request_outgoing_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(-1, "inventaris__asset__list_in_retur_outgoing_seq", array("Nama Bahan Baku", "inventaris__asset__list_request_in_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),);
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(-1, "qty_outgoing_in_retur", array("QTY Outgoing", "qty_outgoing", "number"));
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(0, "qty_retur_outgoing", $array_sub_kategori[0][2]);
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(0, "keterangan_retur_outgoing", $array_sub_kategori[0][3]);

        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;

        //$page['crud']['crud_inline']['no_receive_retur'] = 'onchange="receive_item(this)";';
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        // $idUser = Auth::user()->id;
        //$page['crud']['sub_kategori_costum']['no_tambah']["purchasing_".__FUNCTION__."_detail"]=true;

        $page['crud']['appr_no_select'] = true;

        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }public static function barang_jadi__distributor__purchase__order()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;



        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("No Purchose Order", "no_purchose_order", "text"),
            array("Tanggal PO", "tanggal_po", "date"),
            array("Nama distributor", "distributor_seq", "select", array("crm__distributor", null, "nama_distributor"), null),


            array("TOP", "top", "text-number"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            array("Tanggal kirim", "tanggal_kirim", "date"),
            array("Status PO", "status_po", "select-manual-editview", array("Open" => "Open PO", "Closed" => "Closed PO")),
            // array("User", "user_id", "select-relation", array("users", "id", "name", "a"), null),
            array("Status Approval", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),


        );
        $page['crud']['costum_class']['distributor_seq'] = 'select2';
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
            array("QTY", "qty_sisa", "text-tambah"),
            array("QTY Pesanan", "qty_pesanan", "text-editview-right"),
            array("Harga Beli Satuan", "harga_beli", "text-number-right"),
            array("Dics(%)", "diskon", "text-number-right"),
            array("Total", "total", "text-number-right"),


        );

        $page['crud']['field_value_automatic']['distributor_seq']['database']['utama'] = "crm__distributor";
        $page['crud']['field_value_automatic']['distributor_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic']['distributor_seq']['request_where'] = "crm__distributor.seq";
        $page['crud']['field_value_automatic']['distributor_seq']['field'][] = array("temp_of_payment", "top");
        $page['crud']['field_value_automatic']['distributor_seq']['field'][] = array("pajak", "pajak_distributor");


        $page['crud']['button_list_if']['param_if'][] = '!!!row:status_po???[=]Open';
        $page['crud']['button_list_if']['text'][] = 'Closed PO';
        $page['crud']['button_list_if']['link_type'][] = 'route';
        $page['crud']['button_list_if']['link_route'][] = 'closed_po';
        $page['crud']['button_list_if']['link_param'][] = '!!!row:primary_key???';

        $page['crud']['button_list_if']['param_if'][] = '!!!row:status_po???[=]Closed';
        $page['crud']['button_list_if']['text'][] = 'Open PO';
        $page['crud']['button_list_if']['link_type'][] = 'route';
        $page['crud']['button_list_if']['link_route'][] = 'open_po';
        $page['crud']['button_list_if']['link_param'][] = '!!!row:primary_key???';

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['button_tambah']['type'][] = '';
        $page['crud']['button_tambah']['text'][] = '';

        $page['crud']['subtitle'] = '<div ><img src="" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $number = 1;
        /*$checking =  $this->checking_database($page, $database_utama);;
        $number = 1;
        if ($checking[0]->exists_) {

            $db = DB::connection()->select("SELECT max(" . $primary_key . ") as max FROM " . $database_utama);
            $number = $db[0]->max + 1;
        }*/

        $page['crud']['function']['tanggal_po']['type'] = 'help';
        $page['crud']['function']['tanggal_po']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_po']['param'][] = '!!!row???';

        $page['crud']['function']['tanggal_kirim']['type'] = 'help';
        $page['crud']['function']['tanggal_kirim']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_kirim']['param'][] = '!!!row???';


        $page['crud']['insert_number_code']['no_purchose_order']['prefix'] = 'P0.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_purchose_order']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_purchose_order']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_purchose_order']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_purchose_order']['suffix'] = '';

        //in
        $page['crud']['insert_value']['diskon'] = 0;
        $page['crud']['insert_value']['tanggal_po'] = date('Y-m-d');

        $page['crud']['insert_default_value']['status_po'] = 'Open';

        //$page['crud']['crud_inline']['inventaris__asset__list_seq'] = 'onchange="get_spesific_material(this,!!!var:no???)"';

        $page['crud']['crud_function_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['qty_sisa'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['qty_pesanan'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['harga_beli'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['diskon'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['total'] = 'hapusrupiah';

        // $page['crud']['crud_inline']['qty_sisa'] = 'onkeyup="hitung(!!!var:no???)" onkeypress="handleNumber(event, ' . "' {5,0}'" . ')"';
        // $page['crud']['crud_inline']['qty_pesanan'] = 'onkeyup="hitung(!!!var:no???)" onkeypress="handleNumber(event, ' . "' {5,0}'" . ')"';
        // $page['crud']['crud_inline']['harga_beli'] = 'onkeyup="hitung(!!!var:no???)" onkeypress="handleNumber(event, ' . "'{10,0}'" . ')"';
        // $page['crud']['crud_inline']['diskon'] = 'onkeyup="hitung(!!!var:no???)" onkeypress="handleNumber(event, ' . "'{3,0}'" . ')" max="100"';

        $page['crud']['costum_class']['qty_sisa'] = ' text-right';
        $page['crud']['costum_class']['qty_pesanan'] = ' text-right';
        $page['crud']['costum_class']['harga_beli'] = ' text-right';
        $page['crud']['costum_class']['diskon'] = ' text-right';
        $page['crud']['costum_class']['total'] = ' text-right';

        $page['crud']['costum_class']['inventaris__asset__list_seq'] = 'select3';
        $page['crud']['non_view']['PDFPage']['user_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr'] = true;

        $page['crud']['appr_no_select'] = true;

        //$page['crud']['crud_inline']['distributor_seq'] = 'onchange="get_spesific_distributor(this)"';
        $page['crud']['crud_after_form']['distributor_seq'] = "<div id='content_spesific_distributor'></div>";
        // $page['crud']['js'] = $this->js_purchashing();
        /*
        if ($type == 'PDFPage') {
            $dbTotal = DB::connection()->select("SELECT sum(total) as sum FROM " . $database_utama . "_detail where " . $database_utama . "_seq = $id");
            $total = $dbTotal[0]->sum;

            $div_after = '<br><br><style>.title{ text-align:center}</style><table style="width:100%">
		<tr>
			<td class="title">
			Diajukan
			<br><br><br>
			<br>
			<br>
			
			
			___________________
			<br><br><br>
			<br>
			<br>
			</td><td class="title" >
			Disetujui
			<br><br><br>
			<br>
			<br>
			
			
			___________________
			<br><br><br>
			<br>
			<br>
			</td><td class="title" >
			Mengetahui
			<br><br><br>
			<br>
			<br>
			
			
			___________________
			<br><br><br>
			<br>
			<br>
			</td>
		
		</tr>
		
		</table>';
        } else {
            $total = 0;
            $div_after = '';
        }


        $page['crud']['crud_after_sub_kategori'] = "<div style='text-align:right;font-size:20px'><span style='font-weight:bold'>Total Harga</span><span id='totalAll'>" . number_format($total, 0) . "</span> </div>" . $div_after;
        */
        $page['crud']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['qty_pesanan'] = 'qty_sisa';
        $page['crud']['update_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['qty_sisa'] = 'qty_pesanan';

        //$page['crud']['insert_default_value']['user_id'] = $idUser;


        $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__kontrabon()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("No Kontrabon", "no_kontrabon", "text"),
            array("Tanggal Pengajuan Kontrabon", "tanggal_pengajuan_kontrabon", "date"),
            array("Nama distributor", "distributor_seq", "select", array("crm__distributor", null, "nama_distributor"), null),

            array("TOP", "topsup", "text"),
            array("Tanggal Jatuh Tempo", "tanggal_jatuh_tempo", "date"),

            array("Bank", "bank_kontrabon", "text"),
            array("No Rek Kontrabon", "norek_kontrabon", "text"),
            array("No Receive", "erp__barang_jadi__distributor__receive_seq_kontra", "select-nosave", array("erp__barang_jadi__distributor__receive", null, "no_receive"), null),

            array("appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $page['crud']['select_database_costum']['erp__barang_jadi__distributor__receive_seq_kontra']['whereRaw'] = "erp__barang_jadi__distributor__receive.active = 1				
				
				and (
				COALESCE((select sum(qty_receive) from erp__barang_jadi__distributor__receive_detail a  where a.erp__barang_jadi__distributor__receive_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} and a.active=1),0)-COALESCE((select sum(qty_kontrabon) from purchasing_kontrabon_detail 
					 where purchasing_kontrabon_detail.active = 1 and erp__barang_jadi__distributor__receive_in_kontrabon_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} ),0)
				) > 0";


        $page['crud']['appr_no_select'] = true;
        $page['crud']['costum_class']['distributor_seq'] = 'select2';
        //$page['crud']['crud_inline']['distributor_seq'] = 'onchange="get_spesific_distributor(this);receive(this)"';
        $page['crud']['crud_inline']['topsup'] = 'onchange="jatuh_tempo()";onkeyup="jatuh_tempo()";';
        // $page['crud']['crud_after'] = $this->js_kontrabon();
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("Tanggal Recive", "tanggal_receive_in_kontrabon", "date"),


            array("No Receive", "erp__barang_jadi__distributor__receive_in_kontrabon_seq", "select", array("erp__barang_jadi__distributor__receive", null, "no_receive", "c"), null),
            array("No PO", "erp__barang_jadi__distributor__purchase__order_in_kontrabon_seq", "select", array("erp__barang_jadi__distributor__purchase__order", null, "no_purchose_order", "b"), null),
            array("Raw Material", "inventaris__asset__list_kontrabon_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
            array("QTY Receive", "qty_kontrabon", "number"),
            array("Harga Beli Satuan", "harga_beli_kontrabon", "number"),
            array("Dics(%)", "diskon_kontrabon", "number"),
            array("Total", "total_kontrabon", "number"),


        );
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__barang_jadi__distributor__receive_detail", "erp__barang_jadi__distributor__receive_detail_in_kontrabon_seq", "erp__barang_jadi__distributor__receive_detail.seq");
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__barang_jadi__distributor__receive", "erp__barang_jadi__distributor__receive_detail.erp__barang_jadi__distributor__receive_seq", "erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE}");
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__barang_jadi__distributor__purchase__order", "erp__barang_jadi__distributor__receive.erp__barang_jadi__distributor__purchase__order_seq", "erp__barang_jadi__distributor__purchase__order.seq");

        $page['crud']['no_edit'] = true;
        $page['crud']['no_delete'] = true;

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['database_sub_kategori'] = $database_sub_kategori;


        $page['crud']['insert_number_code']['no_kontrabon']['prefix'] = 'KB.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_kontrabon']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_kontrabon']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_kontrabon']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_kontrabon']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_pengajuan_kontrabon'] = 'date:now';
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';


        $page['crud']['field_value_automatic_select_target']['distributor_seq']['database']['utama'] = "erp__barang_jadi__distributor__receive";
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['database']['join'][] = array("erp__barang_jadi__distributor__purchase__order", "erp__barang_jadi__distributor__receive.erp__barang_jadi__distributor__purchase__order_seq", "erp__barang_jadi__distributor__purchase__order.seq");
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['database']['whereRaw'] = " erp__barang_jadi__distributor__receive.active = 1				
				
				and (
				COALESCE((select sum(qty_receive) from erp__barang_jadi__distributor__receive_detail a  where a.erp__barang_jadi__distributor__receive_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} and a.active=1),0)-COALESCE((select sum(qty_kontrabon) from purchasing_kontrabon_detail 
					 where purchasing_kontrabon_detail.active = 1 and erp__barang_jadi__distributor__receive_in_kontrabon_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} ),0)
				) > 0 ";
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['request_where'] = "distributor_seq";
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['target'] = "erp__barang_jadi__distributor__receive_seq_kontra";
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['value'] = "primary_key";
        $page['crud']['field_value_automatic_select_target']['distributor_seq']['option'] = "no_receive";

        $page['crud']['field_value_automatic']['distributor_seq']['database']['utama'] = "crm__distributor";
        $page['crud']['field_value_automatic']['distributor_seq']['request_where'] = "crm__distributor.seq";
        $page['crud']['field_value_automatic']['distributor_seq']['field'][] = array("bank", "bank_kontrabon");
        $page['crud']['field_value_automatic']['distributor_seq']['field'][] = array("no_rekening", "norek_kontrabon");

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['type'] = 'add'; //get or add
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['utama'] = "erp__barang_jadi__distributor__receive_detail";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['select_raw'] = "*,erp__barang_jadi__distributor__receive_detail.seq as primary_key";

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['where'][] = array('erp__barang_jadi__distributor__receive_detail.active', '=', "1");
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['join'][] = array("erp__barang_jadi__distributor__receive", "erp__barang_jadi__distributor__receive_seq", "erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE}");
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['database']['join'][] = array("erp__barang_jadi__distributor__purchase__order", "erp__barang_jadi__distributor__receive.erp__barang_jadi__distributor__purchase__order_seq", "erp__barang_jadi__distributor__purchase__order.seq");
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['request_where'] = "erp__barang_jadi__distributor__receive_seq";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__barang_jadi__distributor__receive_detail_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "tanggal_receive_in_kontrabon",
            array("Tanggal Receive", "tanggal_receive", "number"),
        );

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "erp__barang_jadi__distributor__receive_in_kontrabon_seq",
            array("No Receive", "erp__barang_jadi__distributor__receive_seq", "select", array("erp__barang_jadi__distributor__receive", null, "no_receive", "r"), null),


        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "no_purchose_order_in_kontrabon",
            array("No Po", "no_purchose_order", "text"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "erp__barang_jadi__distributor__purchase__order_in_kontrabon_seq",
            array("No Po", "erp__barang_jadi__distributor__purchase__order_seq", "hidden"),
        );


        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "inventaris__asset__list_kontrabon_seq",
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
        );

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "qty_kontrabon",
            array("QTY Receive", "qty_receive", "number"),
        );



        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "harga_beli_kontrabon",
            array("QTY Receive", "harga_beli_receive", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "diskon_kontrabon",
            array("QTY Receive", "diskon_receive", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__receive_seq_kontra']['field'][] = array(
            -1, "total_kontrabon",
            array("QTY Receive", "total_receive", "number"),
        );

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;





        $page['crud']['search'] = array(-1 => array(12, 1), 4    => array(12));
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;

        $page['get']['sidebarIn'] = true;;
        return $page;
        // $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function barang_jadi__distributor__payment()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("No Payment", "no_payment", "text"),

            array("Tanggal Payment", "tanggal_payment", "date"),
            array("Nama distributor", "distributor_payment_seq", "select", array("crm__distributor", null, "nama_distributor"), null),

            array("Total Pembayaran", "total_pembayaran", "text-number-editview"),
            array("No Kontrabon", "purchasing_kontrabon_seq_payment", "select-nosave", array("erp__kontrabon", null, "no_kontrabon"), null),

        );
        // $page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];
        $array_sub_kategori[] = array(
            array("No Kontrabon", "purchasing_kontrabon_in_payment_seq", "select", array("erp__kontrabon", null, "no_kontrabon"), null),
            array("Tanggal Kontrabon", "tanggal_pengajuan_kontrabon_payment", "date"),
            array("Total QTY kontrabon", "qty_payment", "number"),
            array("Total Harga", "total_harga", "number"),
            array("Total Bayar", "total_payment", "number"),


        );
        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;
        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['database']['utama'] = "erp__kontrabon";

        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['database']['whereRaw'] = " purchasing_kontrabon.active = 1				
				
				and (
			select COALESCE(sum(total_kontrabon),0) from purchasing_kontrabon_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE}  = purchasing_kontrabon_detail.purchasing_kontrabon_seq-
    	(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq)) > 0  ";
        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['request_where'] = "purchasing_kontrabon.distributor_seq";
        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['target'] = "purchasing_kontrabon_seq_payment";
        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['value'] = "primary_key";
        $page['crud']['field_value_automatic_select_target']['distributor_payment_seq']['option'] = "no_kontrabon";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['type'] = 'add'; //get or add
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['utama'] = "erp__kontrabon";
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['select_raw'] = "*,purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} as primary_key,
       
       	(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq and purchasing_payment_detail.active=1) as total_payment_bayar,
       	purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} as primary_key, 
    	(select sum(qty_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) as qty_kontrabon,
    	(select sum(total_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) as total_kontrabon,
    	((select sum(total_kontrabon)  from purchasing_kontrabon_detail b  where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = b.purchasing_kontrabon_seq and b.active=1) -(select COALESCE(sum(total_payment),0) from purchasing_payment_detail where purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE} = purchasing_kontrabon_in_payment_seq and purchasing_payment_detail.active=1) ) as total_harga 
		";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['where'][] = array('purchasing_kontrabon.active', '=', "1");
        //$page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['database']['join'][] = array("erp__barang_jadi__distributor__receive","erp__barang_jadi__distributor__receive_seq","erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE}");
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['request_where'] = "purchasing_kontrabon.{IDTABLE}purchasing_kontrabon{/IDTABLE}";

        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "purchasing_kontrabon_in_payment_seq",
            array("No Kontrabon", null, "select", array("erp__kontrabon", null, "no_kontrabon", 'a'), null),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "tanggal_pengajuan_kontrabon_payment",
            array("Tanggal Kontrabon", "tanggal_pengajuan_kontrabon", "date"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "qty_payment",
            array("Total QTY kontrabon", "qty_kontrabon", "number"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            -1, "total_harga",
            array("Total QTY kontrabon", "total_harga", "number"),
        );
        $page['crud']['field_view_sub_kategori']['purchasing_kontrabon_seq_payment']['field'][] = array(
            0, "total_payment",
            array("Total Bayar", "total_payment", "number"),
        );

        $page['crud']['costum_class']['distributor_payment_seq'] = 'select2';
        //$page['crud']['crud_inline']['distributor_payment_seq'] = 'onchange="kontrabon(this)"';

        $page['crud']['function']['total_pembayaran']['type'] = 'help';
        $page['crud']['function']['total_pembayaran']['function'] = 'rupiah';
        $page['crud']['function']['total_pembayaran']['param'][] = '!!!row???';
        $page['crud']['function']['total_pembayaran']['param'][] = null;
        $page['crud']['function']['total_pembayaran']['param'][] = '';

        //$page['crud']['sub_kategori_costum']['no_tambah']["purchasing_".__FUNCTION__."_detail"]=true;
        $page['crud']['no_edit'] = true;

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        //$page['crud']['form_route_costum']['tambah'] = 'simpan_payment';


        $page['crud']['insert_number_code']['no_payment']['prefix'] = 'AP.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_payment']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_payment']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_payment']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_payment']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_payment'] = 'date:now';




        //  //purchasing_kontrabon_seq_payment


        $select = array("*");
        $join = array();
        $where = array();


        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__request_outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;



        $array = array(
            array("No Request", "no_request", "text"),
            array("Tanggal Permintaan", "tanggal_permintaan", "date"),
            array("Departemen", "hcms__struktur__divisi_seq", "select", array("hcms__struktur__divisi", null, "nama_divisi"), null),
            array("Tanggal Kebutuhan", "tanggal_kebutuhan", "date"),
            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),

            array("Nama Bahan Baku", "inventaris__asset__list_request_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_request_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
            array("QTY Request", "qty_request", "number"),



        );




        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['insert_number_code']['no_request']['prefix'] = 'RQ.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_request']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_request']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_request']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_request']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_permintaan'] = 'date:now';
        $page['crud']['insert_value']['tanggal_kebutuhan'] = 'date:now';



        //$idUser = Auth::user()->id;
        $page['crud']['appr_no_select'] = true;

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;


        $page['crud']['appr_no_select'] = true;
        $array = array(

            array("No Outgoing", "no_outgoing", "text"),
            array("Tanggal Outgoing", "tanggal_outgoing", "date"),
            array("No Request", "no_request_outgoing", "select", array("erp__barang_jadi__distributor__request_outgoing", null, "no_request"), null),
            array("Departemen", "hcms__struktur__divisi_outgoing_seq", "select", array("hcms__struktur__divisi", null, "nama_divisi"), null),
            array("Tanggal Kebutuhan", "tanggal_kebutuhan_outgoing", "date"),

            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

            //array("Lokasi","lokasi","text"),

        );

        $page['crud']['field_value_automatic']['no_request_outgoing']['database']['utama'] = "erp__barang_jadi__distributor__request_outgoing";
        $page['crud']['field_value_automatic']['no_request_outgoing']['request_where'] = "erp__barang_jadi__distributor__request_outgoing.seq";
        $page['crud']['field_value_automatic']['no_request_outgoing']['field'][] = array("hcms__struktur__divisi", "hcms__struktur__divisi_outgoing_seq");
        $page['crud']['field_value_automatic']['no_request_outgoing']['field'][] = array("tanggal_kebutuhan", "tanggal_kebutuhan_outgoing");

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['utama'] = "erp__barang_jadi__distributor__request_outgoing_detail";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['select_raw'] = "*,erp__barang_jadi__distributor__request_outgoing_detail.seq as primary_key , ((select sum(qty_receive) from erp__barang_jadi__distributor__receive_detail 
			join erp__barang_jadi__distributor__receive on erp__barang_jadi__distributor__receive_detail.erp__barang_jadi__distributor__receive_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE}
		where erp__barang_jadi__distributor__receive_detail.inventaris__asset__list_seq = inventaris__asset__list_request_seq and erp__barang_jadi__distributor__receive.active=1
		and cek_status=1 and erp__barang_jadi__distributor__receive_detail.active=1
		)-(select sum(qty_receive_retur) from erp__retur_detail
			join erp__retur on erp__retur_detail.erp__retur_seq = erp__retur.seq
		where erp__retur_detail.inventaris__asset__list_retur_seq = inventaris__asset__list_request_seq and erp__retur.active=1 
		and erp__retur_detail.active=1
		)-(select sum(qty_outgoing) from erp__barang_jadi__distributor__outgoing_detail
			join erp__barang_jadi__distributor__outgoing on erp__barang_jadi__distributor__outgoing_detail.erp__barang_jadi__distributor__outgoing_seq = erp__barang_jadi__distributor__outgoing.seq
		where erp__barang_jadi__distributor__outgoing_detail.inventaris__asset__list_request_in_outgoing_seq = inventaris__asset__list_request_seq and erp__barang_jadi__distributor__outgoing.active=1 and erp__barang_jadi__distributor__outgoing_detail.active=1
		and appr_status=1
		)+(select sum(qty_retur_outgoing) from erp__retur_outgoing_detail
			join erp__retur_outgoing on erp__retur_outgoing_detail.erp__retur_outgoing_seq = erp__retur_outgoing.seq
		where erp__retur_outgoing_detail.inventaris__asset__list_in_retur_outgoing_seq = inventaris__asset__list_request_seq and erp__retur_outgoing.active=1  and erp__retur_outgoing_detail.active=1
		and appr_status=1
		)) as stok_akhir
       
       ";
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__barang_jadi__distributor__request_outgoing","erp__barang_jadi__distributor__request_outgoing_seq","erp__barang_jadi__distributor__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['request_where'] = "erp__barang_jadi__distributor__request_outgoing_seq";
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__barang_jadi__distributor__request_outgoing_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "inventaris__asset__list_request_in_outgoing_seq", array("Nama Bahan Baku", "inventaris__asset__list_request_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "inventaris__master__satuan_request_in_outgoing_seq", array("Satuan", "inventaris__master__satuan_request_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "sisa_stok", array("QTY Request", "stok_akhir", "number"));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(-1, "qty_request_in_outgoing", array("QTY Request", "qty_request", "number"));
        $page['crud']['field_view_sub_kategori']['no_request_outgoing']['field'][] = array(0, "qty_outgoing", array("QTY Outgoing", "qty_outgoing", "number"));

        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['select_database_costum']['no_request_outgoing']['whereRaw'] = "erp__barang_jadi__distributor__request_outgoing.active = 1
        				and erp__barang_jadi__distributor__request_outgoing.appr_status = 1
        				and (
        				COALESCE((select sum(qty_request) from erp__barang_jadi__distributor__request_outgoing_detail a  where a.erp__barang_jadi__distributor__request_outgoing_seq = erp__barang_jadi__distributor__request_outgoing.seq and a.active=1),0)-COALESCE((select sum(qty_outgoing) from erp__barang_jadi__distributor__outgoing_detail join erp__barang_jadi__distributor__outgoing on erp__barang_jadi__distributor__outgoing_detail.erp__barang_jadi__distributor__outgoing_seq = erp__barang_jadi__distributor__outgoing.seq where erp__barang_jadi__distributor__outgoing_detail.active = 1 and erp__barang_jadi__distributor__outgoing.no_request_outgoing = erp__barang_jadi__distributor__request_outgoing.seq ),0)
        				) > 0";


        $page['crud']['insert_number_code']['no_outgoing']['prefix'] = 'OUT.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_outgoing']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_outgoing']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_outgoing']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_outgoing']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_outgoing'] = 'date:now';

        $page['crud']['insert_value']['tanggal_outgoing'] = date('Y-m-d');
        //OUT.0223.00004

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(


            array("Nama Bahan Baku", "inventaris__asset__list_request_in_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_request_in_outgoing_seq", "select", array("inventaris__master__satuan", null, "nama_satuan", 'a'), null),
            array("Sisa Stok", "sisa_stok", "number"),
            array("QTY Request", "qty_request_in_outgoing", "number"),
            array("QTY Outgoing", "qty_outgoing", "number"),

        );
        // if ($type == 'edit') {
        $page['crud']['crud_disabled_value']['inventaris__master__satuan_request_in_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_request_in_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_request_in_outgoing'] = 'disabled"';
        $page['crud']['crud_disabled_value']['no_request_outgoing'] = 'disabled';
        $page['crud']['crud_disabled_value']['sisa_stok'] = 'disabled';
        //}
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        //$idUser = Auth::user()->id;


        $page['crud']['search'] = array(-2 => array(12, 1), 0 => array(12));
        $page['crud']['appr_no_select'] = true;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__receive()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;



        $array = array(
            array("No Receive", "no_receive", "text"),
            array("Tanggal Receive", "tanggal_receive", "date"),
            array("No Invoice distributor", "no_inv_sup_receive", "text"),
            array("No Purchose Order", "erp__barang_jadi__distributor__purchase__order_seq", "select", array("erp__barang_jadi__distributor__purchase__order", null, "no_purchose_order"), null),

            array("Cek", "cek", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),


        );
        $page['crud']['crud_disabled_value']['no_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['erp__barang_jadi__distributor__purchase__order_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__master__satuan_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_sisa_awal_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['harga_beli_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['diskon_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['total_receive'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_sisa_akhir_receive'] = 'disabled';


        $page['crud']['select_database_costum']['erp__barang_jadi__distributor__purchase__order_seq']['whereRaw'] = "erp__barang_jadi__distributor__purchase__order.active = 1
        				and erp__barang_jadi__distributor__purchase__order.appr_status = 1
        				and erp__barang_jadi__distributor__purchase__order.status_po = 'Open'
        				and (
        				COALESCE((select sum(qty_pesanan) from erp__barang_jadi__distributor__purchase__order_detail a  where a.erp__barang_jadi__distributor__purchase__order_seq = erp__barang_jadi__distributor__purchase__order.seq and a.active=1),0)-
        				COALESCE((select sum(qty_receive) from erp__barang_jadi__distributor__receive_detail join erp__barang_jadi__distributor__receive on erp__barang_jadi__distributor__receive_detail.erp__barang_jadi__distributor__receive_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} where erp__barang_jadi__distributor__receive.active = 1 and erp__barang_jadi__distributor__receive.erp__barang_jadi__distributor__purchase__order_seq = erp__barang_jadi__distributor__purchase__order.seq ),0)
        				) > 0";


        $page['crud']['function']['tanggal_receive']['type'] = 'help';
        $page['crud']['function']['tanggal_receive']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_receive']['param'][] = '!!!row???';

        $page['crud']['non_view']['PDFPage']['user_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr_id'] = true;
        $page['crud']['non_view']['PDFPage']['cek'] = true;
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];


        // $page['crud']['crud_after'] = $this->js_receive();

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("Satuan", "inventaris__master__satuan_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
            array("QTY PO", "qty_sisa_awal_receive", "number"),
            array("QTY Receive", "qty_receive", "number"),
            array("QTY Sisa", "qty_sisa_akhir_receive", "number"),
            array("Harga Beli Satuan", "harga_beli_receive", "number"),
            array("Dics(%)", "diskon_receive", "number"),
            array("Total", "total_receive", "number"),
            array("detail", "erp__barang_jadi__distributor__purchase__order_detail_seq", "hidden"),


        );
        $page['crud']['crud_inline']['qty_receive'] = 'onkeyup="maxinput_recive(this,!!!var:no???);change_qty(this,!!!var:no???);" onchange="maxinput_recive(this,!!!var:no???);change_qty(this,!!!var:no???);" max="!!!row:qty_sisa_akhir_receive???"';

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;


        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['database']['utama'] = "erp__barang_jadi__distributor__purchase__order_detail";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['database']['select_raw'] = "*,erp__barang_jadi__distributor__purchase__order_detail.seq as primary_key,(
        				(qty_pesanan)- COALESCE((select sum(qty_receive) from erp__barang_jadi__distributor__receive_detail join erp__barang_jadi__distributor__receive on erp__barang_jadi__distributor__receive_detail.erp__barang_jadi__distributor__receive_seq = erp__barang_jadi__distributor__receive.{IDTABLE}erp__barang_jadi__distributor__receive{/IDTABLE} where erp__barang_jadi__distributor__receive.active = 1 and erp__barang_jadi__distributor__receive.erp__barang_jadi__distributor__purchase__order_seq = erp__barang_jadi__distributor__purchase__order_detail.erp__barang_jadi__distributor__purchase__order_seq ),0) ) as qty_sisa_akhir_receive";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['database']['where'][] = array('erp__barang_jadi__distributor__purchase__order_detail.active', '=', "1");
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__barang_jadi__distributor__request_outgoing","erp__barang_jadi__distributor__request_outgoing_seq","erp__barang_jadi__distributor__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['request_where'] = "erp__barang_jadi__distributor__purchase__order_seq";
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__barang_jadi__distributor__purchase__order_seq'] = 'value';

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "inventaris__asset__list_seq",
            array("Nama Bahan Baku", "inventaris__asset__list_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "inventaris__master__satuan_seq",
            array("Satuan", "inventaris__master__satuan_seq", "select", array("inventaris__master__satuan", null, "nama_satuan"), null),
        );


        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "qty_sisa_awal_receive",
            array("QTY PO", "qty_pesanan", "number")
        );

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            0, "qty_receive",
            array("QTY Receive", "qty_receive", "number"),
        );



        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "qty_sisa_akhir_receive",
            array("QTY Receive", "qty_sisa_akhir_receive", "number"),
        );

        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "harga_beli_receive",
            array("Harga Beli", "harga_beli", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "diskon_receive",
            array("Diskon", "diskon", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "total_receive",
            array("Total", "total", "number"),
        );
        $page['crud']['field_view_sub_kategori']['erp__barang_jadi__distributor__purchase__order_seq']['field'][] = array(
            -1, "erp__barang_jadi__distributor__purchase__order_detail_seq",
            array("No Po", "primary_key", "hidden"),
        );


        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;




        $page['crud']['function']['total_receive']['type'] = 'help';
        $page['crud']['function']['total_receive']['function'] = 'rupiah';
        $page['crud']['function']['total_receive']['param'][] = '!!!value???';
        $page['crud']['function']['total_receive']['param'][] = null;
        $page['crud']['function']['total_receive']['param'][] = '';

        $page['crud']['function']['harga_beli_receive']['type'] = 'help';
        $page['crud']['function']['harga_beli_receive']['function'] = 'rupiah';
        $page['crud']['function']['harga_beli_receive']['param'][] = '!!!value???';
        $page['crud']['function']['harga_beli_receive']['param'][] = null;
        $page['crud']['function']['harga_beli_receive']['param'][] = '';
        //  $db->leftjoin($join[$i][0], $join[$i][1], '=', $join[$i][2]);
        $database_sub_kategori["erp__" . __FUNCTION__ . "_detail"]['join'][] = array("erp__barang_jadi__distributor__purchase__order_detail", "erp__barang_jadi__distributor__purchase__order_detail_seq", "erp__barang_jadi__distributor__purchase__order_detail.seq");
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['database_sub_kategori'] = $database_sub_kategori;
        //['database_sub_kategori']["erp__" . __FUNCTION__ . "_detail"]['join'][0]


        //$idUser = Auth::user()->id;
        //$page['crud']['insert_default_value']['user_id'] = $idUser;

        /*
        $checking =  $this->checking_database($page, $database_utama);;
        $number = 1;
        if ($checking[0]->exists_) {

            $db = DB::connection()->select("SELECT max(" . $primary_key . ") as max FROM " . $database_utama);
            $number = $db[0]->max + 1;
        }*/
        $page['crud']['insert_number_code']['no_receive']['prefix'] = 'RO.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_receive']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_receive']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_receive']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_receive']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_receive'] = 'date:now';


        //  $page['crud']['prefix_list']['erp__barang_jadi__distributor__purchase__order_seq'] = "<a href='".route('tambah_receive','{--$data->erp__barang_jadi__distributor__purchase__order_seq--}')."'>";
        // $page['crud']['sufix_list']['erp__barang_jadi__distributor__purchase__order_seq'] = "</a>";
        // $page['crud']['add']['link'] = route('tambah_receive');
        // $page['crud']['add']['text'] = 'Add Recieve';
        //$page['crud']['no_add'] = true;
        // $page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();


        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));
        $page['crud']['appr_no_select'] = true;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
        //$page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__retur()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;
        $page['database']['utama'] = "purchasing_" . __FUNCTION__;
        $page['database']['primary_key'] = null;

        $page['database']['join'] = array();
        $page['database']['where'] = array();


        $page['crud']['insert_number_code']['no_retur']['prefix'] = 'RR.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_retur']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_retur']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_retur']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_retur']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_retur'] = 'date:now';

        $array = array(
            array("No Retur", "no_retur", "text"),
            array("Tanggal Retur", "tanggal_retur", "date"),
            array("No Receive", "no_receive_retur", "select", array("erp__barang_jadi__distributor__receive", null, "no_receive"), null),

            //array("Lokasi","lokasi","text"),

        );

        $page['crud']['form_route_costum']['tambah'] = 'simpan_retur';
        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_retur_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("QTY Receive", "qty_receive_retur", "number"),
            // array("QTY Terima", "qty_terima", "number"),
            array("QTY Retur", "qty_retur", "number"),
            array("Keterangan", "keterangan", "textarea"),


        );


        $page['crud']['crud_inline']['no_receive_retur'] = 'onchange="receive_item(this)";';
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $page['crud']['sub_kategori_costum']['no_tambah']["erp__" . __FUNCTION__ . "_detail"] = true;
        /*if ($type == 'tambah') {
            $page['crud']['crud_after'] = '<table style="border-collapse: collapse;width:100%" class="table table-striped pb-5"  border="1">
                                        	<thead>
                                        	<tr>
                                        	<th>No</th>
										<th>Nama Bahan Baku</th><th>QTY Receive</th><!--<th>QTY Terima</th>--><th>QTY Retur</th><th>Keterangan</th><th></th>
											
											</tr>
										</thead>
										<tbody id="receive_detail">

										 	
										 </tbody></table>' . $this->js_retur();
        }*/
        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['crud']['array'] = $array;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function barang_jadi__distributor__retur_outgoing()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'portait');

        $database_utama = "erp__" . __FUNCTION__;
        $primary_key = null;
        $page['database']['utama'] = "purchasing_" . __FUNCTION__;
        $page['database']['primary_key'] = null;

        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['crud']['insert_number_code']['no_retur_outgoing']['prefix'] = 'RT.' . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['type'][0] = 'max';
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['no_retur_outgoing']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['no_retur_outgoing']['suffix'] = '';


        $page['crud']['insert_value']['tanggal_retur_outgoing'] = 'date:now';

        $array = array(
            array("No Retur_outgoing", "no_retur_outgoing", "text"),
            array("Tanggal Retur", "tanggal_retur_outgoing", "date"),
            array("No Outgoing", "no_outgoing_in_retur", "select", array("erp__barang_jadi__distributor__outgoing", null, "no_outgoing"), null),
            array("Appr", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),

        );

        $sub_kategori[] = ["Detail", "erp__" . __FUNCTION__ . "_detail", null, "table"];

        $array_sub_kategori[] = array(
            //array("Kode","purchasing_".__FUNCTION__."_seq","disabled"),
            //array("Kode","kode","text"),
            array("Nama Bahan Baku", "inventaris__asset__list_in_retur_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),

            array("QTY Outgoing", "qty_outgoing_in_retur", "number"),
            array("QTY Retur", "qty_retur_outgoing", "number"),
            array("Keterangan", "keterangan_retur_outgoing", "textarea"),


        );
        $page['crud']['crud_disabled_value']['no_outgoing_in_retur'] = 'disabled';
        $page['crud']['crud_disabled_value']['inventaris__asset__list_in_retur_outgoing_seq'] = 'disabled';
        $page['crud']['crud_disabled_value']['qty_outgoing_in_retur'] = 'disabled';
        $page['crud']['select_database_costum']['no_outgoing_in_retur']['whereRaw'] = "erp__barang_jadi__distributor__outgoing.active = 1
        				and erp__barang_jadi__distributor__outgoing.active = 1
        				and (
        				COALESCE((select sum(qty_outgoing) from erp__barang_jadi__distributor__outgoing_detail a  where a.erp__barang_jadi__distributor__outgoing_seq = erp__barang_jadi__distributor__outgoing.seq and a.active=1),0)-COALESCE((select sum(qty_retur_outgoing) from erp__retur_outgoing_detail join erp__retur_outgoing on erp__retur_outgoing_detail.erp__retur_outgoing_seq = erp__retur_outgoing.seq where erp__retur_outgoing_detail.active = 1 and erp__retur_outgoing.no_outgoing_in_retur = erp__barang_jadi__distributor__outgoing.seq ),0)
        				) > 0";

        $page['crud']['no_row_sub_kategori']["erp__" . __FUNCTION__ . "_detail"] = true;

        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['target'] = "erp__" . __FUNCTION__ . "_detail";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['database']['utama'] = "erp__barang_jadi__distributor__outgoing_detail";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['database']['primary_key'] = null;
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__barang_jadi__distributor__request_outgoing","erp__barang_jadi__distributor__request_outgoing_seq","erp__barang_jadi__distributor__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['request_where'] = "erp__barang_jadi__distributor__outgoing_seq";
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['insert_default_value_sub_kategori_request']["erp__" . __FUNCTION__ . "_detail"]['erp__barang_jadi__distributor__request_outgoing_seq'] = 'value';


        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(-1, "inventaris__asset__list_in_retur_outgoing_seq", array("Nama Bahan Baku", "inventaris__asset__list_request_in_outgoing_seq", "select", array("inventaris__asset__list", null, "nama_barang"), null),);
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(-1, "qty_outgoing_in_retur", array("QTY Outgoing", "qty_outgoing", "number"));
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(0, "qty_retur_outgoing", $array_sub_kategori[0][2]);
        $page['crud']['field_view_sub_kategori']['no_outgoing_in_retur']['field'][] = array(0, "keterangan_retur_outgoing", $array_sub_kategori[0][3]);

        $page['crud']['no_action']["erp__" . __FUNCTION__ . "_detail"] = true;

        //$page['crud']['crud_inline']['no_receive_retur'] = 'onchange="receive_item(this)";';
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        // $idUser = Auth::user()->id;
        //$page['crud']['sub_kategori_costum']['no_tambah']["purchasing_".__FUNCTION__."_detail"]=true;

        $page['crud']['appr_no_select'] = true;

        $select = array("*");
        $join = array(
            // array("store_set_jenis_agen_det",$database_utama.".jenis_agen_seq","store_set_jenis_agen_det.seq"),
            //array("master_keagenan","store_set_jenis_agen_det.master_seq","master_keagenan.seq")
        );
        $where = array();
        //$page['crud']['subtitle'] = '<div ><img src="' . asset('dist/img/logo.png') . '" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';

        $page['crud']['search'] = array(-1 => array(12, 1), 1 => array(12));

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
