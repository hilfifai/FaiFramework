<?php

class Esios
{
  public static function group_asset()
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "am_group_asset";
    $primary_key = null;

    $array = array(

      array("Kode", "kodegroup", "text-req"),
      array("Nama", "namagroup", "text-req"),
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
  public static function jenis_pekerjaan($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "r_jenispekerjaan";
    $primary_key = null;

    $array = array(
      array("Kode Jenis Pekerjaan", "kdjenispekerjaan", "text-req"),
      array("Nama Jenis Pekerjaan", "nmjenispekerjaan", "text-req"),
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
  public static function departemen($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "r_activity";
    $primary_key = null;

    $array = array(
      array("Kode", "kode", "text-req"),
      array("Activity", "activity", "text-req"),
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
  public static function organisasi($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "r_organisasi";
    $primary_key = null;

    $array = array(
      array("Kode", "kdorganisasi", "text-req"),
      array("Organisasi", "nmorganisasi", "text-req"),
      array("Alamat", "alamat", "text"),
      array("Telp", "telp", "text"),
      array("Logo", "logo", "file", "logo"),
      // array("Group Organisasi", "gruporganisasi", "text-req", array("r_gruporganisasi", null, "nmgruporganisasi")),
      // array("Tipe Organisasi", "tipeorganisasi", "text-req", array("tipeorganisasi", null, "nmtipe_organisasi")),
      // array("Organisasi Induk", "organisasiinduk_id", "select", array("r_organisasi", null, "nmorganisasi","parent")),
      // array("Brand", "r_brand_id", "select-req", array("r_brand", null, "nmbrand")),
      // array("Nama Wilayah", "r_wilayah_id", "select-req", array("r_wilayah", null, "nmwilayah")),
      // array("Cashbook Toko", "r_cashbook_id", "select", array("r_cashbook", null, "nmcashbook")),
      // array("No Rekening Toko", "r_rekeningbank_id", "select", array("r_rekeningbank", null, "nmrekeningbank")),
      // array("Nama CO", "namaco", "text"),
      // array("Alamat 2", "alamat", "text"),
      // array("Kota", "kota", "text-req"),
      // array("Pulau", "pulau", "text"),
      // array("Provinsi", "provinsi", "text"),
      // array("Kode Pos", "kodepos", "text"),
      // array("Group Toko", "group_toko", "text"),
      // array("Nama Printer", "nama_printer", "text"),
      // array("IP Address", "ip_address", "text"),
      // array("HP", "hp", "text"),
      // array("Email", "email", "text"),
      // array("User Email", "email_user", "text"),
      // array("Password Email", "email_password", "text"),
      // array("Kode Cabang PKP", "kode_cabang_pkp", "text-req"),
      // array("Lokasi Kerja", "lokasi_kerja", "select", array("ba_lokasi_kerja", null, "nama")),
      // array("Saldo Awal", "nominal_saldo_awal", "text-req"),
      // array("Tanggal Saldo Awal", "tgl_saldo_awal", "text-req"),
      // array("Tampil Desimal", "is_show_decimal", "checkbox"),
      // array("Tampil Poin", "is_show_point", "checkbox"),
      // array("Nilai Poin", "nilai_poin", "text"),
      // array("Tampil NPWP", "is_show_npwp", "checkbox"),
      // array("Tampil Ket Struk", "is_show_remarks", "checkbox"),
      // array("Aktif Disc Customer", "is_automatic_cust_disc", "checkbox"),
      // array("Modern Market", "ismodernmarket", "checkbox"),
      // array("Aktif", "aktif", "checkbox"),
      // array("Alokasi Brand", "alokasi_brand", "text"),
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
  public static function jenis_asset()
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "am_group_asset";
    $primary_key = null;

    $array = array(

      array("Kelas", "kelas", "text-req"),

      array("Kode", "kode", "checkbox-req"),
      array("Nama", "nama", "text-req"),
      array("Umur Ekonomis", "umur_ekonomis", "number"),
      array("Aktif", "aktif", "checkbox-req"),
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
  public static function jenis_ukuran($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "r_jenis_ukuran";
    $primary_key = null;

    $array = array(
      array("Nama Jenis", "nama_jenis", "text-req"),
    );
    $search = array();
    //tag and kontent
    //header
    $sub_kategori[] = ["Size",  $database_utama . "_size", null, "table"];
    $array_sub_kategori[] = array(
      array("Size", "r_size_id", "select-req", ["r_size", "r_size_id", "nmsize"]),
      array("Urutan", "urutan", "number"),
    );
    $page['crud']['sub_kategori'] = $sub_kategori;
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function worksheet($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "pr_planingmd";
    $primary_key = null;

    $array = array(

      array("No JOB", "kodejob", "text-req"),
      array("Kode Sample", "pr_sample_id", "select", array("pr_sample", null, "kdsample")),
      array("Organisasi", "r_organisasi_id", "select", array("r_organisasi", null, "nmorganisasi")),
      array("Desain", "pr_design_id", "select", array("pr_design", null, "nmdesainer")),
      array("Kategori Produk", "kategoriproduk", "select", array("r_grupjenis", null, "jenis", "kategoriproduk"), "kategoriproduk"),
      array("Grup Jenis", "kdgrupjenis", "select", array("r_grupjenis", null, "nmgrupjenis"), "kdgrupjenis"),
      array("Kode Desain", "kode_design", "select", array("pr_design", null, "kddesign"), "kode_design_id"),
      array("Nama Artikel", "nmartikel", "text"),
      array("Brand", "r_brand_id", "select", array("r_brand", null, "nmbrand")),
      array("Status Desain", "stsdesign", "select-manual", array(0 => "NEW", 1 => "REPEAT", 2 => "PARTIAL")),
      array("Triwulan", "kwartal", "select-manual", array(
        "0" => "Basic",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "08"
      )),
      array("Tahun", "tahun", "number-req"),
      array("Occation", "occation", "text"),
      array("Bahan Baku Utama*", "bhnutama", "select-manual-req", array("IN ORDER" => "IN ORDER", "NOT READY" => "LAPDIP", "READY STOK" => "READY STOK")),
      array("Warna", "r_warna_id", "select", array('r_warna', null, "nmwarna")),
      array("Status Bahan Utama", "sts_bhn_baku", "select-manual", array("IN ORDER" => "IN ORDER", "NOT READY" => "LAPDIP", "READY STOK" => "READY STOK")),
      array("Status Bhn Pembantu", "sts_bhn_pembantu", "select-manual", array("IN ORDER" => "IN ORDER", "NOT READY" => "LAPDIP", "READY STOK" => "READY STOK")),
      array("Keterangan", "keterangan", "textarea"),
      array("PIC", "pic_planing", "select-req", array("r_bp", null, "kdbp"), 'pic_planing'),
      array("Upload Gambar", "gambar", "file"),
    );

    $page['crud']['select_database_costum']['pr_design_id']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
    $page['crud']['select_database_costum']['pr_design_id']['join'][]  = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    $search = array();
    //tag and kontent
    //header
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['utama'] = "pr_sample";
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" pr_design", "pr_design.pr_design_id", "pr_sample.pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    // $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['request_where'] = "pr_sample.pr_sample_id";
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_organisasi_id", "r_organisasi_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "kode_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_grupjenis_id", "kdgrupjenis");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_warna_id", "r_warna_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_brand_id", "r_brand_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("tahun", "tahun");

    $page['crud']['insert_number_code']['kodejob']['prefix'] = "1.WSH.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kodejob']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kodejob']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kodejob']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kodejob']['root']['month_get_row_where'][0] = "tanggal_outgoing";
    $page['crud']['insert_number_code']['kodejob']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kodejob']['suffix'] = '';
    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;

    $sub_kategori[] = ["warna",  $database_utama . "_warna", null, "table"];
    $array_sub_kategori[] = array(

      array("Warna", "r_warna_id", "select", array('r_warna', null, "nmwarna")),
      array("Jenis Pekerjaan", "r_jenispekerjaan_id", "select", array('r_jenispekerjaan', null, "nmjenispekerjaan")),
      array("Pelaksana", "r_bp_id", "select", array("r_bp", null, "nmbp")),
      array("Biaya", "biaya", "number"),



      array("Jenis Pekerjaan", "jenispekerjaan2", "select", array('r_jenispekerjaan', null, "nmjenispekerjaan", "pekerjaan2")),
      array("Pelaksana", "pelaksana2", "select", array("r_bp", null, "nmbp", "pelaksana2")),
      array("Biaya", "biaya2", "number"),

      array("Jenis Pekerjaan", "jenispekerjaan3", "select", array('r_jenispekerjaan', null, "nmjenispekerjaan", "pekerjaan3")),
      array("Pelaksana", "pelaksana3", "select", array("r_bp", null, "nmbp", "pelaksana3")),
      array("Biaya", "biaya3", "number"),
    );
    $page['crud']['sub_kategori'] = $sub_kategori;
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;



    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function material_request_barang_produksi()
  {
    //
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "p_requisition";
    $primary_key = null;

    $array = array(
      array("No Material Receive", "kdrequisition", "text"),
      array("Pengaju", "r_bp_id", "select-req", array("r_bp", null, "nmbp")),
      // array("Departemen", "departemen", "select-req"),
      array("Organisasi", "r_organisasi_id", "select-req", array("r_organisasi", null, "nmorganisasi")),
      array("Brand", "r_brand_id", "select-req", array("r_brand", null, "nmbrand")),

      array("Triwulan", "triwulan", "select-manual-req", array(
        "0" => "Basic",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "08"
      )),
      array("Tahun", "tahun", "number-req"),
      array("Tgl Pengajuan", "tglrequisition", "date-req"),
      array("Plan Kedatangan", "plan_kedatangan", "date-req"),
      array("Kategori PR", "r_kategoripo_id", "select-req", array("r_kategoripo", null, "nm_kategori_po")),
      array("Jenis Pengadaan", "jenis_pengadaan", "select-manual-req", array(
        "0" => "LOKAL",
        "1" => "IMPORT"
      )),
      array("Supplier", "supplier", "text"),
      array("Keterangan", "keterangan", "text"),
    );
    $page['crud']['insert_number_code']['kdrequisition']['prefix'] = "1.REQ.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kdrequisition']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kdrequisition']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kdrequisition']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kdrequisition']['root']['month_get_row_where'][0] = "tanggal_outgoing";
    $page['crud']['insert_number_code']['kdrequisition']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kdrequisition']['suffix'] = '';

    $sub_kategori[] = ["", "p_detilrequisition", null, "table"];
    $array_sub_kategori[] = array(
      array("Kode Barang", "r_produk_id", "hidden_input"),
      array("Kode Barang", "kode_barang", "info"),
      array("Nama Barang", "nama_barang", "info"),
      array("Stok Onhand", "stok_onhand", "info"),
      array("Qty Beli", "qty", "number"),
      array("Harga", "harga", "number"),
      array("Jumlah", "jumlah", "number"),
      array("Keterangan", "keterangan", "text"),

    );

    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['target_no_sub_kategori'] = 0;
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['input'] = "Search ";
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['call_function'] = array("change_subtotal(this,output)");
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['database']['utama'] = "r_produk";
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['database']['primary_key'] = null;

    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['database']['select'] = array("*");
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['search'] = "primary_key";
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['search_row'] = array("nama_produk", "kode_sku", 'barcode');
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['array_detail'] = array(
      "kdproduk" => "Kode",
      "nmproduk" => "Nama"
    );
    $page['crud']['search_load_sub_kategori']["p_detilrequisition"]['array_result'] =
      array(
        "r_produk_id" => array("row" => "primary_key", "type" => "database"),
        "kode_barang" => array("row" => "kdproduk", "type" => "database"),
        "nama_barang" => array("row" => "nmproduk", "type" => "database"),
        "stok_onhand" => array("text" => 1, "type" => "text"),
        "qty" => array("text" => 1, "type" => "text"),

        "harga" => array("row" => "harga", "type" => "database"),
        "jumlah" => array("row" => "harga", "type" => "database"),
      );

    $page['crud']['function_js'][] =  array(
      "type" => "input-changer",
      "name" => "change_subtotal",
      "parameter" => "e,id_row",
      "parameter_input" => "this,<NUMBERING></NUMBERING>",
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),

      ),

      "result" => array(

        array(
          "type" => "to_val_row",
          "elemen" => "jumlah",
          "input" => "id",
          "var" => "total_harga"
        ),

      )

    );
    $page['crud']['array'] = $array;
    $page['crud']['search'] = array();
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function purchase_order()
  {
    //
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "p_order";
    $primary_key = null;

    $array = array(
      array("No. Purchase Order", "kdorder", "text-req"),
      array("Organisasi", "r_organisasi_id", "select-req", array("r_organisasi", null, "nmorganisasi")),
      array("Bisnis Partner", "r_bp_id", "select-req", array("r_bp", null, "nmbp")),
      array("Alamat Bisnis Partner", "alamat_bp", "text"),
      array("Keterangan", "keterangan", "text"),
      array("Triwulan", "r_kwartal_id", "select-manual-req", array(
        "0" => "Basic",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "08"
      )),
      array("Tahun Anggaran", "thnanggaran", "number-req"),
      array("Tanggal Order", "tglorder", "date"),
      array("Nilai DP", "nilaidp", "number"),
      array("Mata Uang", "r_currency_id", "select-req", array("r_currency", null, "nmcurrency")),
      array("Tanggal Rencana Datang", "tgldatang", "date"),
      array("Nilai Tukar", "nilaikurs", "number"),
      array("Payment Term", "payment_term", "number-req"),
      array("Jatuh Tempo", "tgl_jatuh_tempo", "date"),

      array("Kesepakatan Supplier", "kesepakatan", "select-manual-req", array(1 => "Terima Tanpa Diskon", 2 => "Terima Dgn Diskon", 3 => "Retur")),
      array("Diskon", "disc_kesepakatan", "number"),
      array("Konfirmasi QC", "konfirmasi_qc", "number"),
      array("Kategori PO", "r_produkkategori_id", "select-req", array("r_kategoripo", null, "nm_kategori_po")),
      array("Requistion", "p_requisition_id", "select-req", array("p_requisition", null, "kdrequisition")),
    );
    $page['crud']['field_value_automatic']['r_bp_id']['database']['utama'] = "r_bp";
    // $page['crud']['field_value_automatic']['r_bp_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['r_bp_id']['request_where'] = "r_bp.r_bp_id";
    $page['crud']['field_value_automatic']['r_bp_id']['field'][] = array("alamatbp", "alamat_bp");

    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";


    $page['crud']['insert_number_code']['kdorder']['prefix'] = "1.REQ.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kdorder']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kdorder']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kdorder']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kdorder']['root']['month_get_row_where'][0] = "tglorder";
    $page['crud']['insert_number_code']['kdorder']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kdorder']['suffix'] = '';

    $sub_kategori[] = ["", "p_detilorder", null, "table"];
    $array_sub_kategori[] = array(
      array("Kode", "r_produk_id", "hidden_input"),
      array("Kode", "p_requisition_id", "hidden_input"),
      array("Kode", "p_detailpr", "hidden_input"),
      array("Kode", "kode", "text-nosave"),
      array("Nama", "nama", "text-nosave"),
      array("Satuan", "satuan", "text"),
      array("Qty", "qty", "number"),
      array("Harga", "harga", "number"),
      array("Bruto", "bruto", "number"),
      array("Diskon", "diskonpr", "number"),
      array("Nominal Diskon", "diskonrp", "number"),
      array("Netto", "netto", "number"),
      array("Requistion", "requistion", "text-nosave"),
      array("Onhand", "qtymr", "text"),

    );
    $page['crud']['function_js'][] =  array(
      "type" => "input-changer",
      "name" => "change_subtotal",
      "parameter" => "e,id_row",
      "parameter_input" => "this,<NUMBERING></NUMBERING>",
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row", "diskonpr" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),
        array(
          "type" => "math",
          "math" => ("(total_harga*(diskonpr/100))"),
          "var" => "total_diskon"
        ),

        array(
          "type" => "math",
          "math" => ("(total_harga-total_diskon)"),
          "var" => "result"
        ),

      ),

      "result" => array(

        array(
          "type" => "to_val_row",
          "elemen" => "bruto",
          "input" => "id",
          "var" => "total_harga"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskonrp",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "netto",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "bruto",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "ttlorder_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "ttlorder_content",
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
      "name" => "total_qty",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "qty",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "ttlqtyorder_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "ttlqtyorder_content",
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
          "sum" => "diskonrp",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "diskon_rp_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "diskon_rp_content",
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
          "math" => "(((parseFloat(ttlorder_input))-(parseFloat(diskon_rp_input))-(parseFloat(nilai_dp_input))))",
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
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['type'] = 'get'; //get or add
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['target'] =  "p_detilorder";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['target_no'] = 0;
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['utama'] = "p_detilrequisition";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['join'][] = array("p_requisition", "p_requisition.p_requisition_id", "p_detilrequisition.p_requisition_id", 'left');
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['primary_key'] = null;
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['select_raw'] = "*";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['where'][] = array('p_detilrequisition.active', '=', "1");
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['request_where'] = "p_detilrequisition.p_requisition_id";



    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "r_produk_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "r_produk_id", "hidden"), //untuk ditampilkan
      "r_produk_id" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "p_requisition_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "p_requisition_id", "hidden"), //untuk ditampilkan
      "primary_key" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "p_detailpr", // sesuaikan dengan id di subkategori
      array("Nama Barang", "p_detilrequisition_id", "hidden"), //untuk ditampilkan
      "p_detilrequisition_id" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Kode", "kode", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Nama", "nama", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "satuan", // sesuaikan dengan id di subkategori
      array("Satuan", "satuan", "text"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "qty", // sesuaikan dengan id di subkategori
      array("Qty", "qty", "number"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "harga", // sesuaikan dengan id di subkategori
      array("Harga", "harga", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "bruto", // sesuaikan dengan id di subkategori
      array("Bruto", "jumlah", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "diskonpr", // sesuaikan dengan id di subkategori
      array("Diskon", "diskonpr", "number"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "diskonrp", // sesuaikan dengan id di subkategori
      array("Nominal Diskon", "diskon", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "netto", // sesuaikan dengan id di subkategori
      array("Netto", "netto", "number"),
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "qtymr", // sesuaikan dengan id di subkategori
      array("Onhand", "qtymr", "text"),
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "requistion", // sesuaikan dengan id di subkategori
      array("Requistion", "kdrequisition", "number"),
    );



    // Jumlah Qty 	: 	
    // 114,00
    // Total Line 	: 	
    // 3.192.000,00
    // Diskon 	: 	
    // 0,00
    // Total Order 	: 	
    // 0,00
    // DP 	: 	
    // 0,00
    //  	: 	
    // 3.192.000,00

    //  	: 	
    // 0,00
    //  	: 	
    // 3.192.000,00
    // Reff. DP 	:


    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Jumlah Qty", "id" => "ttlqtyorder", "type" => "text"),
        array("name" => "Total_order", "id" => "ttlorder", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon_rp", "type" => "text"),
        array("name" => "DP", "id" => "nilai_dp", "type" => "text"),
        array("name" => "Grand Total", "id" => "grandtotal", "type" => "text"),
        array("name" => "PPN", "id" => "ppn", "type" => "input"),
        array("name" => "Netto", "id" => "netto", "type" => "text"),

      )
    );




    $page['crud']['search_load_sub_kategori']["p_detilorder"]['target_no_sub_kategori'] = 0;
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['input'] = "Search ";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['call_function'] = array("change_subtotal(this,output)");
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['utama'] = "r_produk";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['primary_key'] = null;

    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['select'] = array("*");
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['search'] = "primary_key";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['search_row'] = array("nama_produk", "kode_sku", 'barcode');
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['array_detail'] = array(
      "kdproduk" => "Kode",
      "nmproduk" => "Nama"
    );
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['array_result'] =
      array(
        "r_produk_id" => array("row" => "primary_key", "type" => "database"),
        "kode_barang" => array("row" => "kdproduk", "type" => "database"),
        "nama_barang" => array("row" => "nmproduk", "type" => "database"),
        "stok_onhand" => array("text" => 1, "type" => "text"),
        "qty" => array("text" => 1, "type" => "text"),

        "harga" => array("row" => "harga", "type" => "database"),
        "jumlah" => array("row" => "harga", "type" => "database"),
      );

    $page['crud']['function_js'][] =  array(
      "type" => "input-changer",
      "name" => "change_subtotal",
      "parameter" => "e,id_row",
      "parameter_input" => "this,<NUMBERING></NUMBERING>",
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),

      ),

      "result" => array(

        array(
          "type" => "to_val_row",
          "elemen" => "jumlah",
          "input" => "id",
          "var" => "total_harga"
        ),

      )

    );
    $page['crud']['array'] = $array;
    $page['crud']['search'] = array();
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function form_comsumption($page)
  {

    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "pr_worksheet";
    $primary_key = null;
    $page['template'] = "abc";
    $array = array(
      array("Form Consumption*", "noworksheet", "text-req"),
      array("No. Worksheet", "pr_planning_md_id", "select-req", array("pr_planning_md", null, "kodejob")),
      array("Kode Intruksi", "pr_intruksi_id", "select", array("pr_intruksi", null, "kode")),
      array("Keterangan", "keterangan_planing", "text"),
      array("Warna", "r_warna_id", "select", array("r_warna", null, "nmwarna")),
      array("Brand", "", "select-nosave", array("r_brand", null, "nmbrand")),
      array("Organisasi", "", "select-nosave", array("r_organisasi", null, "nmorganisasi")),
      array("Design", "", "select-nosave", array("r_design", null, "nmdesign")),
      array("Kategori Form Consumption", "kategoridsg", "select-manual-req", [0 => "NEW", 1 => "REPEAT", 2 => "PARTIAL"]),
      array("Kategori Produk", "kategoriproduk", "select-manual-req", [0 => "BUSANA", 1 => "NON BUSANA"]),
      array("Grup Jenis", "kdgrupjenis", "text"),
      array("Fabric", "pabrik", "text"),
      array("Nama Artikel", "namabrgjadi", "text-req"),
      array("Kategori", "kategori", "text-req"),
      array("Tgl Pengiriman", "tglpengiriman", "text-req"),
      array("Catatan", "catatan", "text-req"),
      array("Triwulan", "season", "select-manual-req", [0 => "BASIC", 1 => "K1", 2 => "K2", 3 => "K3"]),
      array("Tahun", "tahun", "text-req"),
      array("Keterangan", "keterangan", "text-req"),
      array("Person Incharge", "pic", "select-req", array("r_bp", null, "nmbp")),
      array("Status", "", "text-req"),
    );
    $page['crud']['field_value_automatic']['pr_planning_md_id']['database']['utama'] = "pr_planning_md";
    // $page['crud']['field_value_automatic']['r_bp_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['pr_planning_md_id']['request_where'] = "pr_planning_md_id";
    $page['crud']['field_value_automatic']['pr_planning_md_id']['field'][] = array("alamatbp", "alamat_bp");

    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";


    $page['crud']['insert_number_code']['noworksheet']['prefix'] = "1.JPR.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['noworksheet']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['noworksheet']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['noworksheet']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['noworksheet']['root']['month_get_row_where'][0] = "createdate";
    $page['crud']['insert_number_code']['noworksheet']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['noworksheet']['suffix'] = '';

    $sub_kategori[] = ["List Size Body & Varian", "pr_worksheet_size", null, "table"];
    $array_sub_kategori[] = array(
      array("HPP", "hpp", "number-req"),
      array("Warna", "r_warna_id", "select-req", ["r_warna", "r_warna_id", "nmwarna"]),
      array("Size", "pr_size_id", "select-req", ["r_size", "r_size_id", "nmsize"]),
      array("Qty Produksi ", "qtyproduksi", "text-req"),
      array("Bahan Baku Utama ", "produk_bb", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'bb']),
      array("Cons/Pcs ", "consproduksi", "number-req"),
      array("Variasi I ", "produkvar1", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'var1']),
      array("Cons/Pcs ", "consvar1", "number-req"),
      array("Variasi II ", "produkvar2", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'var2']),
      array("Cons/Pcs ", "consvar2", "number-req"),
      array("Variasi III ", "produkvar3", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'var3']),
      array("Cons/Pcs ", "consvar3", "number-req"),
      array("Kancing ", "kancing", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'kancing']),
      array("Cons/Pcs ", "conskancing", "number-req"),
      array("Zipper ", "zipper", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'zipper']),
      array("Cons/Pcs ", "conszipper", "number-req"),
      array("Logo ", "logo", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'logo']),
      array("Cons/Pcs ", "conslogo", "number-req"),
      array("Label ", "label", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'label']),
      array("Cons/Pcs ", "conslabel", "number-req"),
      array("Plastik ", "plastik", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'pla']),
      array("Cons/Pcs ", "consplastik", "number-req"),
      array("Hantag ", "hantag", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'han']),
      array("Cons/Pcs ", "conshantag", "number-req"),
      array("Loopin ", "loopin", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'lop']),
      array("Cons/Pcs ", "consloopin", "number-req"),
      array("Acc I ", "produkacc1", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc1']),
      array("Cons/Pcs ", "consacc1", "number-req"),
      array("Acc II ", "produkacc2", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc2']),
      array("Cons/Pcs ", "consacc2", "number-req"),
      array("Acc III ", "produkacc3", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc3']),
      array("Cons/Pcs ", "consacc3", "number-req"),
      array("Acc IV ", "produkacc4", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc4']),
      array("Cons/Pcs ", "consacc4", "number-req"),
      array("Acc V ", "produkacc5", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc5']),
      array("Cons/Pcs ", "consacc5", "number-req"),
      array("Acc VI ", "produkacc6", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc6']),
      array("Cons/Pcs ", "consacc6", "number-req"),
      array("Acc VII ", "produkacc7", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc7']),
      array("Cons/Pcs ", "consacc7", "number-req"),
      array("Acc VII ", "produkacc8", "select-req", ["r_produk", "r_produk_id", "nm_produk", 'acc8']),
      array("Cons/Pcs ", "consacc8", "number-req"),




    );

    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produk_bb";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "qtyproduksi";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consproduksi";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkvar1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consvar1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkvar2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consvar2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkvar3";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consvar3";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "kancing";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conskancing";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "zipper";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conszipper";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "logo";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conslogo";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "label";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conslabel";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "plastik";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consplastik";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "hantag";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conshantag";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "loopin";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consloopin";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "lain1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conslain1";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "lain2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "conslain2";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "r_produk_id";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "hpp";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc3";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc3";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc4";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc4";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc5";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc5";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc6";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc6";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc7";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc7";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "produkacc8";
    $page['crud']['all_change_sub_kategori']["pr_worksheet_size"]['array'][] = "consacc8";
    $sub_kategori[] = ["List Color Way", "pr_worksheetdetil", null, "table"];
    $array_sub_kategori[] = array(
      array("Nama Bahan ", "r_produk_id", "text-req"),
      array("Cons Total", "totalcons", "text-req"),
      array("Qty All Lokasi", "", "text-req"),
      array("Qty Internal", "", "text-req"),
      array("Qty Eksternal ", "", "text-req"),
      array("Selisih", "", "text-req"),
    );
    $sub_kategori[] = ["List Pekerjaan Dan Biaya", "pr_leadtime", null, "table"];
    $array_sub_kategori[] = array(
      array("Jenis Pekerjaan ", "r_jenispekerjaan_id", "text-req"),
      array("Biaya ", "biaya", "text-req"),
      array("Keterangan ", "keterangan", "text-req"),
    );
    $page['crud']['array'] = $array;
    $page['crud']['search'] = array();
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }

  public static function fgw_sales_order()
  {
    //
    $page['title'] = "Sales Order";
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');
    $page['app_framework'] = "laravel";
    $page['database_provider'] = "mysql";
    $page['page']['database_provider'] = "mysql";
    $page['database_name'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_server'] = "ethica.id";
    $page['conection_name_database'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_user'] = "ethicaid_duplikasi_orion_user";
    $page['conection_password'] = "hpKUnW5]a}.c";
    $page['conection_scheme'] = CONECTION_SCHEME;
    DB::connection($page);
    $page['load']['database']['id']['text'] = 'seq';
    $page['load']['database']['id']['type'] = 'suffix'; //prefix//suffix
    $page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id

    $database_utama = "sales_order_mst";
    $primary_key = null;

    $array = array(
      array("Tgl. SO", "tanggal", "date-req"),
      array("Tgl. Acc", "tgl_acc", "date-req"),
      array("Nomor SO", "nomor", "text-req"),
      array("Tgl. DO", "tanggal_do", "date-req"),
      array("No. DO", "nomor_do", "text-req"),
      array("Kode Customer", "cust_seq", "select-req", array("master_customer", null, "NAMA")),
      array("Customer", "", "text-req"),
      array("Brand", "brand_seq", "select-req", array("master_brand", null, "nama")),
      array("Qty", "", "number-req"),
      array("Subtotal", "subtotal", "number-req"),
      array("Diskon", "diskon", "number-req"),
      array("Diskon Global(Rp.)", "diskon_global", "number-req"),
      array("Diskon Global(%)", "diskon_global_pct", "number-req"),
      array("Ongkir Kirim", "ongkos_kirim", "number-req"),
      array("B. Penanganan", "biaya_penanganan", "number-req"),
      array("Total", "total", "number-req"),
      array("Keterangan", "keterangan", "text-req"),
      array("Artikel", "", "text-req"),
      array("No. Faktur", "", "text-req"),
      array("Alamat Kirim", "alamat_kirim_lengkap", "textarea-req"),
      array("SIP", "sip", "textarea-req"),
      array("Ekspedisi", "ekspedisi_seq", "select-req", array("master_ekspedisi", null, "nama")),
      array("Service", "service", "text-req"),
      array("Kode Booking", "kode_booking", "text-req"),
      array("No. Resi", "no_resi", "text-req"),
      array("User Pemesan", "pesanan_seq", "text-req", array("pesanan_master", null, "user_id")),
      array("Sales", "sales_seq", "select-req", array("master_pegawai", null, "nama", "sales")),
      array("Admin", "admin_seq", "select-req", array("master_pegawai", null, "nama", "admin")),
      array("Admin Web", "user_admin_eksternal", "text-req"),
      array("No. Eksternal", "no_eksternal", "text-req"),
      array("Jml. Print", "jml_print", "number-req"),
      array("Dropship", "is_dropship", "select-manual-req", ["F" => "Reguler", "T" => "Dropship"]),
      array("User Id", "userd_id", "text-req"),
      array("Tgl. Input", "tgl_input", "date-req"),
      array("Tgl.JT", "tgl_jt", "cal-req"),
    );
    $page['crud']['appr']['catatan_appr'] = "appr";



    $page['crud']['field_value_automatic']['cust_seq']['database']['utama'] = "master_costumer";
    $page['crud']['field_value_automatic']['cust_seq']['database']['select'] = array(" *", "(concat('Yth:',nama_toko,'\nAlamat:',alamat_toko,'No. Hp:',no_hp)) as alamat_kirim");
    $page['crud']['field_value_automatic']['cust_seq']['request_where'] = "master_costumer.seq";
    $page['crud']['field_value_automatic']['cust_seq']['field'][] = array("platfond", "plafon"); // yang di array , table
    $page['crud']['field_value_automatic']['cust_seq']['field'][] = array("admin_seq", "admin_seq");
    $page['crud']['field_value_automatic']['cust_seq']['field'][] = array("sales_seq", "sales_seq");
    $page['crud']['field_value_automatic']['cust_seq']['field'][] = array("top", "top");
    $page['crud']['field_value_automatic']['cust_seq']['field'][] = array("alamat_kirim_lengkap", "alamat_kirim");

    $sub_kategori[] = ["Detail", "sales_order_det", null, "table"];
    $array_sub_kategori[] = array(
      array("Barcode", "barang_seq", "select-req", array("master_barang", null, "barcode")),
      array("nama", "nama", "text-nosave-req"),
      array("brand", "nmbrand", "text-nosave-req"),
      array("klasifikasi", "klasifikasi", "text-nosave-req"),
      array("qty", "qty", "number-req"),
      array("berat", "berat", "number-req"),
      array("berat total", "berat_total", "cal-nosave-req"),
      array("Harga", "harga", "number-req"),
      array("diskon per pcs (%)", "disc1", "number-req"),
      array("diskon per pcs (Rp)", "disc2", "number-req"),
      array("Diskon", "diskon", "cal-nosave-req"),
      array("Hrg. Akhir", "harga_diskon", "number-req"),
      array("T.Disc", "totaldiskon", "cal-nosave-req"),
      array("Total", "total", "number-req"),
      array("Total", "bruto", "hidden_input"),


    );
    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Subtotal", "id" => "subtotal", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon", "type" => "text"),
        array("name" => "Diskon Global(%)", "id" => "diskon_global_pct", "type" => "text"),
        array("name" => "Diskon Global(Rp)", "id" => "diskon_global", "type" => "text"),
        array("name" => "Ongkos Kirim", "id" => "ongkos_kirim", "type" => "input"),
        array("name" => "Biaya Penanganan", "id" => "biaya_penanganan", "type" => "input"),
        array("name" => "Total", "id" => "total", "type" => "text"),

      )
    );
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['target_no_sub_kategori'] = 0;
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['input'] = "Search ";
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['call_function'] = array("change_subtotal(this,output)");
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['database']['utama'] = "master_barang";
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['database']['primary_key'] = null;

    $page['crud']['search_load_sub_kategori']["sales_order_det"]['database']['select'] = array("*");
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['search'] = "primary_key";
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['checked_row'] = "seq";
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['search_row'] = array("nama_barang", "artikel", 'barcode');
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['array_detail'] = array(
      "barcode" => "Barcode",
      "nama" => "Nama",
      "artikel" => "Artikel",
    );
    $page['crud']['search_load_sub_kategori']["sales_order_det"]['array_result'] =
      array(
        "barang_seq" => array("row" => "primary_key", "type" => "database"),
        "nama" => array("row" => "nama", "type" => "database"),
        "nmbrand" => array("row" => "nmbrand", "type" => "database"),
        "klasifikasi" => array("row" => "klasifikasi", "type" => "database"),
        "berat" => array("row" => "berat", "type" => "database"),
        "berat_total" => array("row" => "berat", "type" => "database"),
        "harga" => array("row" => "harga_jual", "type" => "database"),
        "harga_diskon" => array("row" => "harga_jual", "type" => "database"),
        "total" => array("row" => "harga_jual", "type" => "database"),

        "qty" => array("text" => 1, "type" => "text"),

      );

    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total",
      "get" => array("subtotal_input" => "id", "diskon_input" => "id", "diskon_global_input" => "id", "ongkos_kirim_input" => "id", "biaya_penanganan_input" => "id"),
      "first" => array(
        array(
          "type" => "call_function",
          "name_function" => "total_bruto"
        ),

      ),
      "execute" => array(
        array(
          "type" => "math",
          "math" => "(((parseFloat(subtotal_input))-(parseFloat(diskon_input))-(parseFloat(diskon_global_input))+(parseFloat(ongkos_kirim_input))+(parseFloat(biaya_penanganan_input)) ))",
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
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "bruto",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "Subtotal_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "Subtotal_content",
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
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row", "disc1" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),
        array(
          "type" => "math",
          "math" => ("(harga*(disc1/100))"),
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "math",
          "math" => ("(harga-diskon_satuan)"),
          "var" => "harga_akhir"
        ),
        array(
          "type" => "math",
          "math" => ("(diskon_satuan*(qty))"),
          "var" => "total_diskon"
        ),

        array(
          "type" => "math",
          "math" => ("(total_harga-total_diskon)"),
          "var" => "result"
        ),

      ),

      "result" => array(
        array(
          "type" => "to_val_row",
          "elemen" => "disc2",
          "input" => "id",
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "totaldiskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "bruto",
          "input" => "id",
          "var" => "total_harga"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "harga_diskon",
          "input" => "id",
          "var" => "harga_akhir"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "total",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total"
        )

      )

    );
    // $page['crud']['field_value_automatic']['p_order_id']['database']['utama'] = "p_order";
    // // $page['crud']['field_value_automatic']['p_order_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    // $page['crud']['field_value_automatic']['p_order_id']['request_where'] = "p_order.p_order_id";
    // $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("tanggal_po", "tglorder");
    // $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("r_organisasi_id_po", "r_organisasi_id");
    // $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("r_bp_id_po", "r_bp_id");

    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";


    // $page['crud']['insert_number_code']['kdmr']['prefix'] = "1.MRJ.NOWBULAN|.NOWTAHUNKECIL|";
    // $page['crud']['insert_number_code']['kdmr']['root']['type'][0] = 'count-month';
    // $page['crud']['insert_number_code']['kdmr']['root']['sprintf'][0] = true;
    // $page['crud']['insert_number_code']['kdmr']['root']['sprintf_number'][0] = 5;
    // $page['crud']['insert_number_code']['kdmr']['root']['month_get_row_where'][0] = "tglorder";
    // $page['crud']['insert_number_code']['kdmr']['root']['plus'] = 1000000;
    // $page['crud']['insert_number_code']['kdmr']['suffix'] = '';
    // $page['crud']['field_view_sub_kategori']['p_order_id']['type'] = 'get'; //get or add
    // $page['crud']['field_view_sub_kategori']['p_order_id']['target'] =  "p_detilmr";
    // $page['crud']['field_view_sub_kategori']['p_order_id']['target_no'] = 0;
    // $page['crud']['field_view_sub_kategori']['p_order_id']['database']['utama'] = "p_detilorder";
    // $page['crud']['field_view_sub_kategori']['p_order_id']['database']['join'][] = ["r_produk", "p_detilorder.r_produk_id", "r_produk.r_produk_id"];
    // $page['crud']['field_view_sub_kategori']['p_order_id']['database']['join'][] = ["r_uom", "r_uom.r_uom_id", "r_produk.r_uom_id"];
    // $page['crud']['field_view_sub_kategori']['p_order_id']['database']['primary_key'] = null;
    // $page['crud']['field_view_sub_kategori']['p_order_id']['database']['select_raw'] = "*";
    // $page['crud']['field_view_sub_kategori']['p_order_id']['request_where'] = "p_detilorder.p_order_id";



    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "r_produk_id", // sesuaikan dengan id di subkategori
    //   array("Nama Barang", "r_produk_id", "hidden_input"), //untuk ditampilkan
    //   "r_produk_id" //ambil value get
    // );

    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "detilreff_id", // sesuaikan dengan id di subkategori
    //   array("Nama Barang", "p_detilorder_id", "hidden_input"), //untuk ditampilkan
    //   "p_detilorder_id" //ambil value get
    // );

    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "nmproduk", // sesuaikan dengan id di subkategori
    //   array("Kode", "kdproduk", "text-nosave"),

    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "nmproduk", // sesuaikan dengan id di subkategori
    //   array("Nama", "nmproduk", "text-nosave"),
    //   "nmproduk" //ambil value get

    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "satuan", // sesuaikan dengan id di subkategori
    //   array("Satuan", "nmuom", "text"),

    //   "nmuom" //ambil value get
    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   -1,
    //   "qty_po", // sesuaikan dengan id di subkategori
    //   array("Qty", "qty", "number"),
    //   "qty" //ambil value get
    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "qtysj", // sesuaikan dengan id di subkategori
    //   array("QTY SJ", "qtysj", "number-req"),

    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "qtyqc", // sesuaikan dengan id di subkategori
    //   array("QTY QC", "qtyqc", "number-req"),

    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "qtyreject", // sesuaikan dengan id di subkategori
    //   array("QTY Reject", "qtyreject", "number-req"),

    // );
    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "selisih", // sesuaikan dengan id di subkategori
    //   array("Selisih", "selisih", "number-req"),

    // );

    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "qtyinvoice", // sesuaikan dengan id di subkategori
    //   array("QTY Invoice", "qtyinvoice", "number-req"),

    // );
    // // $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
    // //   0,
    // //   "qtyinvoice", // sesuaikan dengan id di subkategori
    // //   array("Alokasi", "alokasi", "modalsubkategori-modalform-req"),

    // // );

    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "keterangan", // sesuaikan dengan id di subkategori
    //   array("Keterangan", "keterangan", "text-req"),

    // );

    // $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
    //   0,
    //   "alias", // sesuaikan dengan id di subkategori
    //   array("Alias", "alias", "text-req"),

    // );






    $page['crud']['array'] = $array;
    $page['crud']['search'] = array(
      // -3 => array("5"),
      // -2 => array("5", "appr_status"),
      0 => array(
        6,

      ),
      -102 => array(
        6,
        ["sales_order_mst.cust_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Customer", "cust_seq", "select", array("master_customer", null, "nama")),
      ),
      -103 => array(
        6,
        ["sales_order_mst.ekspedisi_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Ekspedisi", "ekspedisi_seq", "select", array("master_ekspedisi", null, "nama")),
      ),
      -104 => array(
        6,
        ["sales_order_mst.seq", ' in ', '(select barang_seq from sales_order_det  where barang_seq = <REQUEST-VALUE>)'],
        array("Barang", "barang_seq", "select", array("master_barang", null, "nama")),
      ),
      -105 => array(
        6,
        ["sales_order_mst.service", ' = ', ' <REQUEST-VALUE>'],
        array("Service", "service", "text"),
      ),
      -106 => array(
        6,
        ["sales_order_mst.sales_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Sales", "sales", "select", array("master_pegawai", null, "nama")),
      ),
      -107 => array(
        6,
        ["sales_order_mst.admin_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Admin", "adminseq", "select", array("master_pegawai", null, "nama")),
      ),
      -100 => array(
        6,
        ["sales_order_mst.seq", ' in ', '(select master_seq from sales_order_det left join master_barang on master_barang.seq = barang_seq where brand_seq = <REQUEST-VALUE>)'],
        array("Brand", "brand_seq", "select", array("master_brand", null, "nama")),
      ),
      -101 => array(
        6,
        ["sales_order_mst.seq", ' in ', '(select master_seq from sales_order_det left join master_barang on master_barang.seq = barang_seq where sub_brand_seq = <REQUEST-VALUE>)'],
        array("Sub Brand", "subbrand_seq", "select", array("master_sub_brand", null, "nama")),
      ),
      // -108 => array(
      //  6,
      //   ["sales_order_mst.seq", ' in ', '(select barang_seq from sales_order_det  where klasifikasi = <REQUEST-VALUE>)'],
      //   array("Klasifikasi", "klasifikasi", "select", array("master_barang", null, "nama")),
      // )
    );
    // 
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*,delivery_order_mst.tanggal as tanggal_do,
				delivery_order_mst.nomor as nomor_do,
				0 as qty,
				'' as artikel,
				'' as tgl_jt,
				'' as no_faktur 
      ");;
    $page['database']['join'] = array("delivery_order_mst", "delivery_order_mst.so_seq", "sales_order_mst.seq");
    $page['database']['where'] = array();
    return $page;
  }
  public static function fgw_faktur_jual()
  {
    $page['title'] = "Faktur Jual";
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');
    $page['app_framework'] = "laravel";
    $page['database_provider'] = "mysql";
    $page['page']['database_provider'] = "mysql";
    $page['database_name'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_server'] = "ethica.id";
    $page['conection_name_database'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_user'] = "ethicaid_duplikasi_orion_user";
    $page['conection_password'] = "hpKUnW5]a}.c";
    // $page['conection_scheme'] = CONECTION_SCHEME;
    DB::connection($page);
    $page['load']['database']['id']['text'] = 'seq';
    $page['load']['database']['id']['type'] = 'suffix'; //prefix//suffix
    $page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id

    $database_utama = "faktur_jual_mst";
    $primary_key = null;

    $array = array(

      array("Tgl. SO", "tanggal_so", "date-dbalias-req", ["sales_order_mst", "tanggal"]),
      array("Tgl. Acc SO", "tgl_acc_so", "date-dbalias-req", ["sales_order_mst", "tgl_acc"]),
      array("No. SO", "nomorso", "text-dbalias-req", ["sales_order_mst", "tgl_acc"]),
      array("Tgl. DO", "tanggal_do", "date-dbalias-req", ["delivery_order_mst", "tanggal"]),
      array("No. DO", "nomor_do", "select-req", ["delivery_order_mst", "", "nomor"]),
      array("Tgl FJ", "tanggal", "text-req"),
      array("Nomor FJ", "nomor", "text-req"),
      array("Tanggal Jatuh Tempo", "", "text-req"),
      array("Kode Customer", "cust_seq", "select-req", array("master_customer", null, "KODE")),
      array("Customer", "", "text-req", ["master_customer", "nama"]),
      array("nama toko", "", "text-req", ["master_customer", "nama_toko"]),
      array("Brand", "brand_seq", "select-req", array("master_brand", null, "nama")),
      array("Qty", "", "number-req"),
      array("Subtotal", "subtotal", "number-req"),
      array("Diskon", "diskon", "number-req"),
      array("Diskon Global(Rp.)", "diskon_global", "number-req"),
      array("Diskon Global(%)", "diskon_global_pct", "number-req"),
      array("Ongkir Kirim", "ongkos_kirim", "number-req"),
      array("B. Penanganan", "biaya_penanganan", "number-req"),
      array("Total", "total", "number-req"),
      array("Ekspedisi", "ekspedisi_seq", "select-req", array("master_ekspedisi", null, "nama")),
      array("Service", "service", "text-req"),
      array("Kode Booking", "kode_booking", "text-req"),
      array("No. Resi", "no_resi", "text-req"),
      array("Tgl No Resi", "tgl_no_resi", "text-req"),
      array("Total Koli", "total_koli", "text-req"),
      array("No Polibag", "total", "number-req"),
      array("Keterangan", "keterangan", "text-req"),
      array("Alamat Kirim", "alamat_kirim_lengkap", "textarea-req"),
      array("SIP", "sip", "textarea-req"),
      array("Status", "status", "text-req"),
      array("Tipe Trans", "keterangan", "text-req"),
      array("Dropship", "", "text-req"),
      array("Sales", "sales_seq", "select-req", array("master_pegawai", null, "nama", 'sales')),
      array("Admin", "admin_seq", "select-req", array("master_pegawai", null, "nama", 'admin')),
      array("User Pemesan", "pesanan_seq", "text-req", array("pesanan_master", null, "user_id")),
      array("Admin Web", "user_admin_eksternal", "text-req"),
      array("No. Eksternal", "no_eksternal", "text-req"),
      array("User Id", "user_id", "text-req"),
      array("Tgl. Input", "tgl_input", "date-req"),
    );

    $page['no_checking'] = true;

    $sub_kategori[] = ["Detail", "faktur_jual_det", null, "table"];
    $array_sub_kategori[] = array(
      array("Barcode", "barang_seq", "select-req", array("master_barang", null, "barcode")),
      array("nama", "nama", "text-nosave-req"),
      array("stok", "stok", "text-nosave-req"),
      array("qty", "qty", "number-req"),
      array("Selisih", "qty", "number-req"),
      array("berat", "berat", "number-req"),
      array("berat total", "berat_total", "cal-nosave-req"),
      array("Harga", "harga", "number-req"),
      array("diskon per pcs (%)", "desc1", "number-req"),
      array("diskon per pcs (Rp)", "disc2", "cal-req"),
      array("Diskon", "diskon", "number-nosave-req"),
      array("Hrg. Akhir", "harga_diskon", "number-req"),
      array("T.Disc", "totaldiskon", "cal-nosave-req"),
      array("Total", "total", "number-req"),
      array("No Polibag", "berat_total", "cal-nosave-req"),
    );
    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Subtotal", "id" => "subtotal", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon", "type" => "text"),
        array("name" => "Diskon Global(%)", "id" => "diskon_global_pct", "type" => "text"),
        array("name" => "Diskon Global(Rp)", "id" => "diskon_global", "type" => "text"),
        array("name" => "Ongkos Kirim", "id" => "ongkos_kirim", "type" => "input"),
        array("name" => "Biaya Penanganan", "id" => "biaya_penanganan", "type" => "input"),
        array("name" => "Total", "id" => "total", "type" => "text"),

      )
    );


    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total",
      "get" => array("subtotal_input" => "id", "diskon_input" => "id", "diskon_global_input" => "id", "ongkos_kirim_input" => "id", "biaya_penanganan_input" => "id"),
      "first" => array(
        array(
          "type" => "call_function",
          "name_function" => "total_bruto"
        ),

      ),
      "execute" => array(
        array(
          "type" => "math",
          "math" => "(((parseFloat(subtotal_input))-(parseFloat(diskon_input))-(parseFloat(diskon_global_input))+(parseFloat(ongkos_kirim_input))+(parseFloat(biaya_penanganan_input)) ))",
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
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "bruto",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "Subtotal_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "Subtotal_content",
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
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row", "disc1" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),
        array(
          "type" => "math",
          "math" => ("(harga*(disc1/100))"),
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "math",
          "math" => ("(harga-diskon_satuan)"),
          "var" => "harga_akhir"
        ),
        array(
          "type" => "math",
          "math" => ("(diskon_satuan*(qty))"),
          "var" => "total_diskon"
        ),

        array(
          "type" => "math",
          "math" => ("(total_harga-total_diskon)"),
          "var" => "result"
        ),

      ),

      "result" => array(
        array(
          "type" => "to_val_row",
          "elemen" => "disc2",
          "input" => "id",
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "totaldiskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "bruto",
          "input" => "id",
          "var" => "total_harga"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "harga_diskon",
          "input" => "id",
          "var" => "harga_akhir"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "total",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total"
        )

      )

    );
    $page['crud']['field_value_automatic']['nomor_do']['database']['utama'] = "delivery_order_mst";
    // $page['crud']['field_value_automatic']['p_order_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['nomor_do']['request_where'] = "delivery_order_mst.seq";
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("tanggal_do", "tanggal"); // yang di array , table
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("cust_seq", "cust_seq");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("nama_toko", "nama_toko");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("agen", "agen");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("plafon", "plafon");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("top", "top");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("tanggal_jatuh_tempo", "tanggal_jatuh_tempo");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("gudang_seq", "gudang_seq");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("admin_seq", "admin_seq");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("ekspedisi_seq", "ekspedisi_seq");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("no_resi", "no_resi");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("pesanan_seq", "user_id");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("user_admin_eksternal", "user_admin_eksternal");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("no_eksternal", "no_eksternal");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("service", "service");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("kode_booking", "kode_booking");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("alamat_kirim_lengkap", "alamat_kirim_lengkap");
    $page['crud']['field_value_automatic']['nomor_do']['field'][] = array("sip", "sip");

    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";

    //DO/0924/004-00001

    $page['crud']['insert_number_code']['nomor_so']['prefix'] = "DO/NOWBULAN|NOWTAHUNKECIL|/USERID-";
    $page['crud']['insert_number_code']['nomor_so']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['nomor_so']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['nomor_so']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['nomor_so']['root']['month_get_row_where'][0] = "tanggal";
    $page['crud']['insert_number_code']['nomor_so']['suffix'] = '';

    $page['crud']['field_view_sub_kategori']['nomor_do']['type'] = 'get'; //get or add
    $page['crud']['field_view_sub_kategori']['nomor_do']['target'] =  "p_detilmr";
    $page['crud']['field_view_sub_kategori']['nomor_do']['target_no'] = 0;
    $page['crud']['field_view_sub_kategori']['nomor_do']['database']['utama'] = "sales_order_det";
    $page['crud']['field_view_sub_kategori']['nomor_do']['database']['join'][] = ["master_barang", "master_barang.seq", "master_seq", ';eft'];
    $page['crud']['field_view_sub_kategori']['nomor_do']['database']['primary_key'] = null;
    $page['crud']['field_view_sub_kategori']['nomor_do']['database']['select_raw'] = "*";
    $page['crud']['field_view_sub_kategori']['nomor_do']['request_where'] = "sales_order_det.master_seq";



    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "barang_seq", // sesuaikan dengan id di subkategori
      array("Nama Barang", "barang_seq", "hidden_input"), //untuk ditampilkan
      "seq" //ambil value get
    );



    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Kode", "kdproduk", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "barcode", // sesuaikan dengan id di subkategori
      array("Barcode", "barcode", "text-nosave"),
      "barcode" //ambil value get

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "nama", // sesuaikan dengan id di subkategori
      array("Nama", "nama", "text-nosave-req"),
      "nama" //ambil value get

    );

    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "stok", // sesuaikan dengan id di subkategori
      array("stok", "stok", "text-nosave-req"),

      "nmuom" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "so_qty", // sesuaikan dengan id di subkategori
      array("SO", "so_qty", "number-req"),
      "qty" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "qty", // sesuaikan dengan id di subkategori
      array("DO", "qty", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "selisih", // sesuaikan dengan id di subkategori
      array("Selisih", "selisih", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "berat", // sesuaikan dengan id di subkategori
      array("berat", "berat", "number-req"),
      "berat" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "berat_total", // sesuaikan dengan id di subkategori
      array("berat total", "berat_total", "cal-nosave-req"),

    );

    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "no_polibag", // sesuaikan dengan id di subkategori
      array("No Polibag", "no_polibag", "number"),

    );

    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      -1,
      "harga", // sesuaikan dengan id di subkategori
      array("Harga", "harga", "number-req"),
      "harga" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "disc1", // sesuaikan dengan id di subkategori
      array("diskon per pcs (%)", "disc1", "number-req"),
      "disc1" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "disc2", // sesuaikan dengan id di subkategori
      array("diskon per pcs (Rp)", "disc2", "number-req"),
      "disc2" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "diskon", // sesuaikan dengan id di subkategori
      array("Diskon", "diskon", "number-nosave-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "harga_diskon", // sesuaikan dengan id di subkategori
      array("Hrg. Akhir", "harga_diskon", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "totaldiskon", // sesuaikan dengan id di subkategori
      array("T.Disc", "totaldiskon", "cal-nosave-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_do']['field'][] = array(
      0,
      "total", // sesuaikan dengan id di subkategori
      array("Total", "total", "number-req"),

    );






    $page['crud']['array'] = $array;
    $page['crud']['search'] = array(
      // -3 => array("5"),
      // -2 => array("5", "appr_status"),
      3 => array(
        6,

      ),
      //faktur_jual
      -102 => array(
        6,
        ["faktur_jual_mst.cust_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Customer", "cust_seq", "select", array("master_customer", null, "nama")),
      ),
      -111 => array(
        6,
        ["faktur_jual_mst.seq", ' in ', "(select master_seq from faktur_jual_det left join master_barang on master_barang.seq = barang_seq where artikel = <REQUEST-VALUE>)"],
        array("Artikel", "artikel_seq", "select", array("(select distint artikel as artikel from master_barang)", "artikel", "artikel")),
      ),

      -113 => array(
        6,
        ["faktur_jual_mst.cust_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Sub Agen", "sub_agen_seq", "select", array("master_customer", null, "nama")),
      ),
      -110 => array(
        6,
        ["faktur_jual_mst.seq", ' in ', "(select master_seq from faktur_jual_det  where barang_seq = <REQUEST-VALUE>)"],
        array("Barang", "barang_seq", "select", array("master_barang", null, "nama")),
      ),

      -106 => array(
        6,
        ["faktur_jual_mst.sales_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Sales", "sales", "select", array("master_pegawai", null, "nama")),
      ),
      -100 => array(
        6,
        ["faktur_jual_mst.seq", ' in ', '(select master_seq from faktur_jual_det left join master_barang on master_barang.seq = barang_seq where brand_seq = <REQUEST-VALUE>)'],
        array("Brand", "brand_seq", "select", array("master_brand", null, "nama")),
      ),

      -107 => array(
        6,
        ["faktur_jual_mst.admin_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Admin", "adminseq", "select", array("master_pegawai", null, "nama")),
      ),


      -101 => array(
        6,
        ["faktur_jual_mst.seq", ' in ', '(select master_seq from faktur_jual_det left join master_barang on master_barang.seq = barang_seq where sub_brand_seq = <REQUEST-VALUE>)'],
        array("Sub Brand", "subbrand_seq", "select", array("master_sub_brand", null, "nama")),
      ),
      -103 => array(
        6,
        ["faktur_jual_mst.ekspedisi_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Ekspedisi", "ekspedisi_seq", "select", array("master_ekspedisi", null, "nama")),
      ),
      -115 => array(
        6,
        ["faktur_jual_mst.gudang_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Gudang", "gudang_seq", "select", array("master_gudang", null, "nama")),
      ),
      -116 => array(
        6,
        ["faktur_jual_mst.nomor", ' = ', ' <REQUEST-VALUE>'],
        array("Jenis SO", "jenis_so", "select-manual", array("SO-A" => "SO-A", "PO-A" => "PO-A", "SO" => "SO")),
      ),
      -116 => array(
        6,
        ["faktur_jual_mst.nomor", ' = ', ' <REQUEST-VALUE>'],
        array("Dropsip", "dropsip", "select-manual", array("SO-A" => "SO-A", "PO-A" => "PO-A", "SO" => "SO")),
      ),

    );
    // 
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*,faktur_jual_mst.tanggal as tanggal_do,
				faktur_jual_mst.nomor as nomor_do,
				0 as qty,
				'' as artikel,
				'' as tgl_jt,
				'' as no_faktur 
      ");;
    $page['database']['join'][] = array("sales_order_mst", "faktur_jual_mst.so_seq", "sales_order_mst.seq", 'left');
    $page['database']['where'] = array();


    $page['conection_scheme'] = CONECTION_SCHEME;
    return $page;
  }
  public static function fgw_delivery_order()
  {
    //
    $page['title'] = "Delivery Order";
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');
    $page['app_framework'] = "laravel";
    $page['database_provider'] = "mysql";
    $page['page']['database_provider'] = "mysql";
    $page['database_name'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_server'] = "ethica.id";
    $page['conection_name_database'] = "ethicaid_duplikasi_pusat_orion";
    $page['conection_user'] = "ethicaid_duplikasi_orion_user";
    $page['conection_password'] = "hpKUnW5]a}.c";
    $page['conection_scheme'] = CONECTION_SCHEME;
    DB::connection($page);
    $page['load']['database']['id']['text'] = 'seq';
    $page['load']['database']['id']['type'] = 'suffix'; //prefix//suffix
    $page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id

    $database_utama = "delivery_order_mst";
    $primary_key = null;

    $array = array(
      array("Tgl. SO", "tanggal_so", "date-dbalias-req", ["delivery_order_mst", "tanggal"]),
      array("Tgl. Acc SO", "tgl_acc_so", "date-dbalias-req", ["delivery_order_mst", "tgl_acc"]),
      array("No. SO", "nomor_so", "select-req", array("sales_order_mst", null, "nomor")),
      array("Tgl. DO", "tanggal", "date-req"),
      array("No. DO", "nomor", "text-req"),
      array("Kode Customer", "kode_costumer", "text-dbalias", ["master_customer", "KODE"]),
      array("Customer", "cust_seq", "select-req", array("master_customer", null, "NAMA")),
      array("Brand", "brand_seq", "select-req", array("master_brand", null, "nama")),
      array("Qty", "qty", "number-req"),
      array("Subtotal", "subtotal", "number-req"),
      array("Diskon", "diskon", "number-req"),
      array("Diskon Global(Rp.)", "diskon_global", "number-req"),
      array("Diskon Global(%)", "diskon_global_pct", "number-req"),
      array("Ongkir Kirim", "ongkos_kirim", "number-req"),
      array("B. Penanganan", "biaya_penanganan", "number-req"),
      array("Total", "total", "number-req"),
      array("Gudang", "gudang_seq", "select-req", ["master_gudang", '', 'nama']),
      array("No Polibag", "no_polibag", "number-req"),
      array("Sales", "sales_seq", "select-req", array("master_pegawai", null, "nama", 'sales')),
      array("Admin", "admin_seq", "select-req", array("master_pegawai", null, "nama", 'admin')),
      array("Ekspedisi", "ekspedisi_seq", "select-req", array("master_ekspedisi", null, "nama")),
      array("Service", "service", "text-req"),
      array("Kode Booking", "kode_booking", "text-req"),
      array("No. Resi", "no_resi", "text-req"),
      array("Alamat Kirim", "alamat_kirim_lengkap", "textarea-req"),
      array("SIP", "sip", "textarea-req"),
      array("Keterangan", "keterangan", "text-req"),
      array("Tipe Trans", "keterangan", "text-req"),
      array("User Pemesan", "pesanan_seq", "text-req", array("pesanan_master", null, "user_id")),
      array("Admin Web", "user_admin_eksternal", "text-req"),
      array("No. Eksternal", "no_eksternal", "text-req"),
      array("User Id", "userd_id", "text-req"),
      array("Tgl. Input", "tgl_input", "date-req"),
    );

    $page['no_checking'] = true;

    $sub_kategori[] = ["Detail", "delivery_order_det", null, "table"];
    $array_sub_kategori[] = array(
      array("Barcode", "barang_seq", "select-req", array("master_barang", null, "barcode")),
      array("nama", "nama", "text-nosave-req"),
      array("stok", "stok", "text-nosave-req"),
      array("SO", "so_qty", "number-req"),
      array("DO", "qty", "number-req"),
      array("Selisih", "selisih", "number-req"),
      array("berat", "berat", "number-req"),
      array("berat total", "berat_total", "cal-nosave-req"),
      array("No Polibag", "no_polibag", "cal-nosave-req"),
      array("Harga", "harga", "number-req"),
      array("diskon per pcs (%)", "desc1", "number-req"),
      array("diskon per pcs (Rp)", "disc2", "cal-req"),
      array("Diskon", "diskon", "number-nosave-req"),
      array("Hrg. Akhir", "harga_diskon", "number-req"),
      array("T.Disc", "totaldiskon", "cal-nosave-req"),
      array("Total", "total", "number-req"),
    );
    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Subtotal", "id" => "subtotal", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon", "type" => "text"),
        array("name" => "Diskon Global(%)", "id" => "diskon_global_pct", "type" => "text"),
        array("name" => "Diskon Global(Rp)", "id" => "diskon_global", "type" => "text"),
        array("name" => "Ongkos Kirim", "id" => "ongkos_kirim", "type" => "input"),
        array("name" => "Biaya Penanganan", "id" => "biaya_penanganan", "type" => "input"),
        array("name" => "Total", "id" => "total", "type" => "text"),

      )
    );


    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total",
      "get" => array("subtotal_input" => "id", "diskon_input" => "id", "diskon_global_input" => "id", "ongkos_kirim_input" => "id", "biaya_penanganan_input" => "id"),
      "first" => array(
        array(
          "type" => "call_function",
          "name_function" => "total_bruto"
        ),

      ),
      "execute" => array(
        array(
          "type" => "math",
          "math" => "(((parseFloat(subtotal_input))-(parseFloat(diskon_input))-(parseFloat(diskon_global_input))+(parseFloat(ongkos_kirim_input))+(parseFloat(biaya_penanganan_input)) ))",
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
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "bruto",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "Subtotal_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "Subtotal_content",
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
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row", "disc1" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),
        array(
          "type" => "math",
          "math" => ("(harga*(disc1/100))"),
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "math",
          "math" => ("(harga-diskon_satuan)"),
          "var" => "harga_akhir"
        ),
        array(
          "type" => "math",
          "math" => ("(diskon_satuan*(qty))"),
          "var" => "total_diskon"
        ),

        array(
          "type" => "math",
          "math" => ("(total_harga-total_diskon)"),
          "var" => "result"
        ),

      ),

      "result" => array(
        array(
          "type" => "to_val_row",
          "elemen" => "disc2",
          "input" => "id",
          "var" => "diskon_satuan"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "totaldiskon",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "bruto",
          "input" => "id",
          "var" => "total_harga"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "harga_diskon",
          "input" => "id",
          "var" => "harga_akhir"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "total",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total"
        )

      )

    );
    $page['crud']['field_value_automatic']['nomor_so']['database']['utama'] = "sales_order_mst";
    // $page['crud']['field_value_automatic']['p_order_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['nomor_so']['request_where'] = "sales_order_mst.seq";
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("tanggal_so", "tanggal"); // yang di array , table
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("cust_seq", "cust_seq");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("gudang_seq", "gudang_seq");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("admin_seq", "admin_seq");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("ekspedisi_seq", "ekspedisi_seq");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("service", "service");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("kode_booking", "kode_booking");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("alamat_kirim_lengkap", "alamat_kirim_lengkap");
    $page['crud']['field_value_automatic']['nomor_so']['field'][] = array("sip", "sip");

    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    // // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";

    //DO/0924/004-00001

    $page['crud']['insert_number_code']['nomor_so']['prefix'] = "DO/NOWBULAN|NOWTAHUNKECIL|/USERID-";
    $page['crud']['insert_number_code']['nomor_so']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['nomor_so']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['nomor_so']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['nomor_so']['root']['month_get_row_where'][0] = "tanggal";
    $page['crud']['insert_number_code']['nomor_so']['suffix'] = '';

    $page['crud']['field_view_sub_kategori']['nomor_so']['type'] = 'get'; //get or add
    $page['crud']['field_view_sub_kategori']['nomor_so']['target'] =  "p_detilmr";
    $page['crud']['field_view_sub_kategori']['nomor_so']['target_no'] = 0;
    $page['crud']['field_view_sub_kategori']['nomor_so']['database']['utama'] = "sales_order_det";
    $page['crud']['field_view_sub_kategori']['nomor_so']['database']['join'][] = ["master_barang", "master_barang.seq", "master_seq", ';eft'];
    $page['crud']['field_view_sub_kategori']['nomor_so']['database']['primary_key'] = null;
    $page['crud']['field_view_sub_kategori']['nomor_so']['database']['select_raw'] = "*";
    $page['crud']['field_view_sub_kategori']['nomor_so']['request_where'] = "sales_order_det.master_seq";



    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "barang_seq", // sesuaikan dengan id di subkategori
      array("Nama Barang", "barang_seq", "hidden_input"), //untuk ditampilkan
      "seq" //ambil value get
    );



    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Kode", "kdproduk", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "barcode", // sesuaikan dengan id di subkategori
      array("Barcode", "barcode", "text-nosave"),
      "barcode" //ambil value get

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "nama", // sesuaikan dengan id di subkategori
      array("Nama", "nama", "text-nosave-req"),
      "nama" //ambil value get

    );

    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "stok", // sesuaikan dengan id di subkategori
      array("stok", "stok", "text-nosave-req"),

      "nmuom" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "so_qty", // sesuaikan dengan id di subkategori
      array("SO", "so_qty", "number-req"),
      "qty" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "qty", // sesuaikan dengan id di subkategori
      array("DO", "qty", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "selisih", // sesuaikan dengan id di subkategori
      array("Selisih", "selisih", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "berat", // sesuaikan dengan id di subkategori
      array("berat", "berat", "number-req"),
      "berat" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "berat_total", // sesuaikan dengan id di subkategori
      array("berat total", "berat_total", "cal-nosave-req"),

    );

    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "no_polibag", // sesuaikan dengan id di subkategori
      array("No Polibag", "no_polibag", "number"),

    );

    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      -1,
      "harga", // sesuaikan dengan id di subkategori
      array("Harga", "harga", "number-req"),
      "harga" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "disc1", // sesuaikan dengan id di subkategori
      array("diskon per pcs (%)", "disc1", "number-req"),
      "disc1" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "disc2", // sesuaikan dengan id di subkategori
      array("diskon per pcs (Rp)", "disc2", "number-req"),
      "disc2" //ambil value get"
    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "diskon", // sesuaikan dengan id di subkategori
      array("Diskon", "diskon", "number-nosave-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "harga_diskon", // sesuaikan dengan id di subkategori
      array("Hrg. Akhir", "harga_diskon", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "totaldiskon", // sesuaikan dengan id di subkategori
      array("T.Disc", "totaldiskon", "cal-nosave-req"),

    );
    $page['crud']['field_view_sub_kategori']['nomor_so']['field'][] = array(
      0,
      "total", // sesuaikan dengan id di subkategori
      array("Total", "total", "number-req"),

    );






    $page['crud']['array'] = $array;
    $page['crud']['search'] = array(
      // -3 => array("5"),
      // -2 => array("5", "appr_status"),
      3 => array(
        6,

      ),
      //delivery_order
      -110 => array(
        6,
        ["delivery_order_mst.gudang_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Gudang", "gudang_seq", "select", array("master_gudang", null, "nama")),
      ),

      -100 => array(
        6,
        ["delivery_order_mst.seq", ' in ', '(select master_seq from delivery_order_det left join master_barang on master_barang.seq = barang_seq where brand_seq = <REQUEST-VALUE>)'],
        array("Brand", "brand_seq", "select", array("master_brand", null, "nama")),
      ),
      -102 => array(
        6,
        ["delivery_order_mst.cust_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Customer", "cust_seq", "select", array("master_customer", null, "nama")),
      ),

      -101 => array(
        6,
        ["delivery_order_mst.seq", ' in ', '(select master_seq from delivery_order_det left join master_barang on master_barang.seq = barang_seq where sub_brand_seq = <REQUEST-VALUE>)'],
        array("Sub Brand", "subbrand_seq", "select", array("master_sub_brand", null, "nama")),
      ),


      -106 => array(
        6,
        ["delivery_order_mst.sales_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Sales", "sales", "select", array("master_pegawai", null, "nama")),
      ),
      -107 => array(
        6,
        ["delivery_order_mst.admin_seq", ' = ', ' <REQUEST-VALUE>'],
        array("Admin", "adminseq", "select", array("master_pegawai", null, "nama")),
      ),

    );
    // 
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*,delivery_order_mst.tanggal as tanggal_do,
				delivery_order_mst.nomor as nomor_do,
				0 as qty,
				'' as artikel,
				'' as tgl_jt,
				'' as no_faktur 
      ");;
    $page['database']['join'][] = array("sales_order_mst", "delivery_order_mst.so_seq", "sales_order_mst.seq", 'left');
    $page['database']['where'] = array();
    return $page;
  }
  public static function rmw_material_receive($page)
  {
    //
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "p_mr";
    $primary_key = null;
    //   case 'IM' :
    //     $sql1=", ";
    //     $sql2="";
    //     $idJobOrder='';
    //     $sqlOrder="SELECT r_tipedokumen_id FROM i_movement WHERE i_movement_id=".$IdPo."; ";
    //     $order=$MyDataBase->GetData($Conn,$sqlOrder);
    //     $r_tipedokumen_id=$order['r_tipedokumen_id'][0];
    //     break;
    // case '' : $sql1="pr_jor_id, "; $sql2=""; $idJobOrder=''; break;
    // case 'PO' : $sql1="p_order_id, "; $sql2=""; $idJobOrder=''; break;
    // case 'JOB' :
    //     $sql1=", ";
    //     $sql2="pr_joborder_id, ";
    //     $sqlJobOrder="SELECT pr_joborder_id FROM pr_joborder_pekerjaan WHERE pr_joborder_pekerjaan_id=".$IdPo;
    //     $dataJobOrder=$MyDataBase->GetData($Conn,$sqlJobOrder);
    //     $idJobOrder=$dataJobOrder['pr_joborder_id'][0].",";
    //     break;
    // case 'MM' : $sql1="p_order_id,"; $IdPo="NULL";$sql2=""; $idJobOrder='';break;
    // case 'RG' : $sql1="p_order_id,"; $IdPo="NULL";$r_tipedokumen_id=38;$tgl_rg=date("Y-m-d",strtotime($tgl_rg)); $sql2=""; $idJobOrder='';break;
    // case 'BOM' : $sql1="id_bom_ref,";  $sql2=""; $idJobOrder='';break;
    // case 'QC' :
    //     $sql1="p_order_konfirmasi_id,";
    //     $sql2="p_order_id, ";
    //     $sqlOrder="SELECT p_mr_transit.p_order_id
    //                 FROM p_order_konfirmasi
    //                 LEFT JOIN p_qc ON p_qc.p_qc_id=p_order_konfirmasi.p_qc_id
    //                 LEFT JOIN p_mr_transit ON p_mr_transit.p_mr_transit_id=p_qc.p_mr_transit_id
    //                 WHERE p_order_konfirmasi.p_order_konfirmasi_id=".$IdPo;
    //     $order=$MyDataBase->GetData($Conn,$sqlOrder);
    //     $idJobOrder=$order['p_order_id'][0].",";
    // break;
    $page['crud']['hidden_show']['sumber']['onjs'] = "onclick,onkeyup,onchange";
    $page['crud']['hidden_show']['sumber']['default']["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['default']["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['default']["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['default']["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['default']["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['default']["p_order_konfirmasi_id"] = "hide";

    $value_if = "IM";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "show";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";
    $value_if = "JOR";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "show";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";
    $value_if = "PO";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "show";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";
    $value_if = "JOB";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "show";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";
    $value_if = "BOM";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "show";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";
    $value_if = "QC";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "show";
    $value_if = "QC";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["i_movement_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_jor_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["pr_joborder_pekerjaan_id"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["id_bom_ref"] = "hide";
    $page['crud']['hidden_show']['sumber']['value_if'][$value_if]["p_order_konfirmasi_id"] = "hide";

    $page['crud']['hidden_show']['sumber']['value_if']["1"]["jumlah_hari_pre_order"] = "show";
    $array = array(
      array("No.Dokumen", "kdmr", "text-req"),
      array("Tanggal", "tglmr", "date-req"),
      array("Sumber", "sumber", "select-manual-req", array(
        // "IM" => "Inventory Move",
        // "JOB" => "Job",
        // "JOR" => "Job Order Received",
        "PO" => "Purchase Order",
        // "RG" => "Return Gudang (XML)",
        // "QC" => "QC",
        // "BOM" => "BOM",
        "MM" => "Mutasi Masuk"
      )),
      // array("No. Ref", "i_movement_id", "select-default-req",array("i_movement")),
      // array("No. Ref", "pr_jor_id", "select-default-req",array("pr_jor")),
      array("No. Ref", "p_order_id", "select-req", array("p_order", null, "kdorder")),
      // array("No. Ref", "p_order_konfirmasi_id", "select-default-req",array("i_movement")),
      // array("No. Ref", "id_bom_ref", "select-default-req",array("i_movement")),
      array("Tanggal PO", "tanggal_po", "text-dbalias", ["p_order", "tglorder"]),
      array("Organisasi", "r_organisasi_id_po", "text-dbalias", ["p_order", "r_organisasi_id", "nmorganisasi"]),
      array("Bisnis Partner", "r_bp_id_po", "text-dbalias", ["p_order", "r_bp_id", "kdbp"]),
      array("Gudang", "i_gudang_id", "select-req", array("i_gudang", null, "nmgudang")),
      array("Inspektor", "inspektor", "selectx-req"),
      array("Produk Yang Telah Di MR", "qty_tlh_mr", "number-req"),
      array("Sisa", "qty_sisa", "number-req"),
      array("Tanggal Awal Inspek", "tglawalinspek", "date-req"),
      array("Tanggal Akhir Inspek", "tglakhirinspek", "date-req"),
      // array("Gudang Asal", "id_gudang_asal", "select-req", array("i_gudang_id", null, "nmgudang")),
      array("", "idtoko_rg", "hidden_input"),
      array("", "isgl", "hidden_input"),
      // array("", "kdstatusdokumen", "hidden_input-default-req", 'DR'),
      // array("", "r_tipedokumen_id", "hidden_input"),
      array("", "ttlqtymr", "hidden_input"),
      array("", "tgl_rg", "hidden_input"),
    );
    $page['crud']['appr']['catatan_appr'] = "appr";


    $page['crud']['field_value_automatic']['p_order_id']['database']['utama'] = "p_order";
    // $page['crud']['field_value_automatic']['p_order_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['p_order_id']['request_where'] = "p_order.p_order_id";
    $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("tanggal_po", "tglorder");
    $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("r_organisasi_id_po", "r_organisasi_id");
    $page['crud']['field_value_automatic']['p_order_id']['field'][] = array("r_bp_id_po", "r_bp_id");

    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    // $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";


    $page['crud']['insert_number_code']['kdmr']['prefix'] = "1.MRJ.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kdmr']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kdmr']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kdmr']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kdmr']['root']['month_get_row_where'][0] = "tglorder";
    $page['crud']['insert_number_code']['kdmr']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kdmr']['suffix'] = '';

    $sub_kategori[] = ["Detail Material Received", "p_detilmr", null, "table"];
    $array_sub_kategori[] = array(
      array("", "r_produk_id", "hidden_input"),
      array("", "detilreff_id", "hidden_input"),
      array("Kode", "kode", "text-req-nosave"),
      array("Nama", "nama", "text-req-nosave"),
      array("Satuan", "satuan", "text-req"),
      array("QTY PO", "qty_po", "number-req"),
      array("QTY SJ", "qtysj", "number-req"),
      array("QTY QC", "qtyqc", "number-req"),
      array("QTY Reject", "qtyreject", "number-req"),
      array("Selisih", "selisih", "number-req"),
      array("QTY Invoice", "qtyinvoice", "number-req"),
      // array("Alokasi", "alokasi", "modalsubkategori-modalform-req"),
      array("Keterangan", "keterangan", "text-req"),
      array("Alias", "", "text-req"),


    );

    $page['crud']['field_view_sub_kategori']['p_order_id']['type'] = 'get'; //get or add
    $page['crud']['field_view_sub_kategori']['p_order_id']['target'] =  "p_detilmr";
    $page['crud']['field_view_sub_kategori']['p_order_id']['target_no'] = 0;
    $page['crud']['field_view_sub_kategori']['p_order_id']['database']['utama'] = "p_detilorder";
    $page['crud']['field_view_sub_kategori']['p_order_id']['database']['join'][] = ["r_produk", "p_detilorder.r_produk_id", "r_produk.r_produk_id"];
    $page['crud']['field_view_sub_kategori']['p_order_id']['database']['join'][] = ["r_uom", "r_uom.r_uom_id", "r_produk.r_uom_id"];
    $page['crud']['field_view_sub_kategori']['p_order_id']['database']['primary_key'] = null;
    $page['crud']['field_view_sub_kategori']['p_order_id']['database']['select_raw'] = "*";
    $page['crud']['field_view_sub_kategori']['p_order_id']['request_where'] = "p_detilorder.p_order_id";



    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "r_produk_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "r_produk_id", "hidden_input"), //untuk ditampilkan
      "r_produk_id" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "detilreff_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "p_detilorder_id", "hidden_input"), //untuk ditampilkan
      "p_detilorder_id" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Kode", "kdproduk", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Nama", "nmproduk", "text-nosave"),
      "nmproduk" //ambil value get

    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "satuan", // sesuaikan dengan id di subkategori
      array("Satuan", "nmuom", "text"),

      "nmuom" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      -1,
      "qty_po", // sesuaikan dengan id di subkategori
      array("Qty", "qty", "number"),
      "qty" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "qtysj", // sesuaikan dengan id di subkategori
      array("QTY SJ", "qtysj", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "qtyqc", // sesuaikan dengan id di subkategori
      array("QTY QC", "qtyqc", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "qtyreject", // sesuaikan dengan id di subkategori
      array("QTY Reject", "qtyreject", "number-req"),

    );
    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "selisih", // sesuaikan dengan id di subkategori
      array("Selisih", "selisih", "number-req"),

    );

    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "qtyinvoice", // sesuaikan dengan id di subkategori
      array("QTY Invoice", "qtyinvoice", "number-req"),

    );
    // $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
    //   0,
    //   "qtyinvoice", // sesuaikan dengan id di subkategori
    //   array("Alokasi", "alokasi", "modalsubkategori-modalform-req"),

    // );

    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "keterangan", // sesuaikan dengan id di subkategori
      array("Keterangan", "keterangan", "text-req"),

    );

    $page['crud']['field_view_sub_kategori']['p_order_id']['field'][] = array(
      0,
      "alias", // sesuaikan dengan id di subkategori
      array("Alias", "alias", "text-req"),

    );






    $page['crud']['array'] = $array;
    $page['crud']['search'] = array(-3 => array("5"), -2 => array("5", "appr_status"));
    $page['crud']['search'] = [];
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function purchase_order_greige1()
  {
    //
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "p_order_greige";
    $primary_key = null;

    $array = array(
      array("No. Purchase Order", "kdorder", "text-req"),
      array("Organisasi", "r_organisasi_id", "select-req", array("r_organisasi", null, "nmorganisasi")),
      array("Bisnis Partner", "r_bp_id", "select-req", array("r_bp", null, "nmbp")),
      array("Alamat Bisnis Partner", "alamat_bp", "text"),
      array("Keterangan", "keterangan", "text"),
      array("Triwulan", "r_kwartal_id", "select-manual-req", array(
        "0" => "Basic",
        "1" => "01",
        "2" => "02",
        "3" => "03",
        "4" => "04",
        "5" => "05",
        "6" => "08"
      )),
      array("Tahun Anggaran", "thnanggaran", "number-req"),
      array("Tanggal Order", "tglorder", "date"),
      array("Nilai DP", "nilaidp", "number"),
      array("Mata Uang", "r_currency_id", "select-req", array("r_currency", null, "nmcurrency")),
      array("Tanggal Rencana Datang", "tgldatang", "date"),
      array("Nilai Tukar", "nilaikurs", "number"),
      array("Payment Term", "payment_term", "number-req"),
      array("Jatuh Tempo", "tgl_jatuh_tempo", "date"),

      array("Kesepakatan Supplier", "kesepakatan", "select-manual-req", array(1 => "Terima Tanpa Diskon", 2 => "Terima Dgn Diskon", 3 => "Retur")),
      array("Diskon", "disc_kesepakatan", "number"),
      array("Konfirmasi QC", "konfirmasi_qc", "number"),
      array("Kategori PO", "r_produkkategori_id", "select-req", array("r_kategoripo", null, "nm_kategori_po")),
      array("Requistion", "p_requisition_id", "select-req", array("p_requisition", null, "kdrequisition")),
      array("Approve", "appr", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),
      array("Catatan Approve", "catatan_appr", "textarea-appr"),
      array("Approve 2", "appr_2", "select-appr", array("3" => "Pending", "1" => "Setuju", "2" => "Tolak")),
    );
    $page['crud']['appr']['catatan_appr'] = "appr";


    $page['crud']['field_value_automatic']['r_bp_id']['database']['utama'] = "r_bp";
    // $page['crud']['field_value_automatic']['r_bp_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['r_bp_id']['request_where'] = "r_bp.r_bp_id";
    $page['crud']['field_value_automatic']['r_bp_id']['field'][] = array("alamatbp", "alamat_bp");

    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['utama'] = "p_requisition";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("ispo", "=", "'CO'");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("kdstatusdokumen", "=", "'Y'");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['database']['where'][] = array("r_tipedokumen_id", "=", "5");
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['request_where'] = "r_kategoripo_id";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['target'] = "p_requisition_id";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['value'] = "primary_key";
    $page['crud']['field_value_automatic_select_target']['r_produkkategori_id']['option'] = "kdrequisition";


    $page['crud']['insert_number_code']['kdorder']['prefix'] = "1.REQ.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kdorder']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kdorder']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kdorder']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kdorder']['root']['month_get_row_where'][0] = "tglorder";
    $page['crud']['insert_number_code']['kdorder']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kdorder']['suffix'] = '';

    $sub_kategori[] = ["", "p_detilorder", null, "table"];
    $array_sub_kategori[] = array(
      array("Kode", "r_produk_id", "hidden_input"),
      array("Kode", "p_requisition_id", "hidden_input"),
      array("Kode", "p_detailpr", "hidden_input"),
      array("Kode", "kode", "text-nosave"),
      array("Nama", "nama", "text-nosave"),
      array("Satuan", "satuan", "text"),
      array("Qty", "qty", "number"),
      array("Harga", "harga", "number"),
      array("Bruto", "bruto", "number"),
      array("Diskon", "diskonpr", "number"),
      array("Nominal Diskon", "diskonrp", "number"),
      array("Netto", "netto", "number"),
      array("Requistion", "requistion", "text-nosave"),
      array("Onhand", "qtymr", "text"),

    );
    $page['crud']['function_js'][] =  array(
      "type" => "input-changer",
      "name" => "change_subtotal",
      "parameter" => "e,id_row",
      "parameter_input" => "this,<NUMBERING></NUMBERING>",
      "row" => array("qty", 'harga'),
      "id_row" => true,
      "input" => array("onkeyup"),
      "get" => array("qty" => "id_row", "harga" => "id_row", "diskonpr" => "id_row"),
      "execute" => array(
        array(
          "type" => "math",
          "math" => ("(qty*harga)"),
          "var" => "total_harga"
        ),
        array(
          "type" => "math",
          "math" => ("(total_harga*(diskonpr/100))"),
          "var" => "total_diskon"
        ),

        array(
          "type" => "math",
          "math" => ("(total_harga-total_diskon)"),
          "var" => "result"
        ),

      ),

      "result" => array(

        array(
          "type" => "to_val_row",
          "elemen" => "bruto",
          "input" => "id",
          "var" => "total_harga"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "diskonrp",
          "input" => "id",
          "var" => "total_diskon"
        ),
        array(
          "type" => "to_val_row",
          "elemen" => "netto",
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
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "bruto",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "ttlorder_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "ttlorder_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_qty",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "qty",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "ttlqtyorder_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "ttlqtyorder_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "diskon_item",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "diskonrp",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "diskon_rp_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "diskon_rp_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total",
      "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
      "first" => array(
        array(
          "type" => "call_function",
          "name_function" => "total_bruto"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total_qty"
        ),
        array(
          "type" => "call_function",
          "name_function" => "diskon_item"
        )
      ),
      "execute" => array(
        array(
          "type" => "math",
          "math" => "(((parseFloat(ttlorder_input))-(parseFloat(diskon_rp_input))-(parseFloat(nilai_dp_input))))",
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
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['type'] = 'get'; //get or add
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['target'] =  "p_detilorder";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['target_no'] = 0;
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['utama'] = "p_detilrequisition";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['join'][] = array("p_requisition", "p_requisition.p_requisition_id", "p_detilrequisition.p_requisition_id", 'left');
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['primary_key'] = null;
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['select_raw'] = "*";
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['database']['where'][] = array('p_detilrequisition.active', '=', "1");
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['request_where'] = "p_detilrequisition.p_requisition_id";



    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "r_produk_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "r_produk_id", "hidden"), //untuk ditampilkan
      "r_produk_id" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "p_requisition_id", // sesuaikan dengan id di subkategori
      array("Nama Barang", "p_requisition_id", "hidden"), //untuk ditampilkan
      "primary_key" //ambil value get
    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "p_detailpr", // sesuaikan dengan id di subkategori
      array("Nama Barang", "p_detilrequisition_id", "hidden"), //untuk ditampilkan
      "p_detilrequisition_id" //ambil value get
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Kode", "kode", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      -1,
      "nmproduk", // sesuaikan dengan id di subkategori
      array("Nama", "nama", "text-nosave"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "satuan", // sesuaikan dengan id di subkategori
      array("Satuan", "satuan", "text"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "qty", // sesuaikan dengan id di subkategori
      array("Qty", "qty", "number"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "harga", // sesuaikan dengan id di subkategori
      array("Harga", "harga", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "bruto", // sesuaikan dengan id di subkategori
      array("Bruto", "jumlah", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "diskonpr", // sesuaikan dengan id di subkategori
      array("Diskon", "diskonpr", "number"),

    );
    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "diskonrp", // sesuaikan dengan id di subkategori
      array("Nominal Diskon", "diskon", "number"),

    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "netto", // sesuaikan dengan id di subkategori
      array("Netto", "netto", "number"),
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "qtymr", // sesuaikan dengan id di subkategori
      array("Onhand", "qtymr", "text"),
    );

    $page['crud']['field_view_sub_kategori']['p_requisition_id']['field'][] = array(
      0,
      "requistion", // sesuaikan dengan id di subkategori
      array("Requistion", "kdrequisition", "number"),
    );



    // Jumlah Qty 	: 	
    // 114,00
    // Total Line 	: 	
    // 3.192.000,00
    // Diskon 	: 	
    // 0,00
    // Total Order 	: 	
    // 0,00
    // DP 	: 	
    // 0,00
    //  	: 	
    // 3.192.000,00

    //  	: 	
    // 0,00
    //  	: 	
    // 3.192.000,00
    // Reff. DP 	:


    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Jumlah Qty", "id" => "ttlqtyorder", "type" => "text"),
        array("name" => "Total_order", "id" => "ttlorder", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon_rp", "type" => "text"),
        array("name" => "DP", "id" => "nilai_dp", "type" => "text"),
        array("name" => "Grand Total", "id" => "grandtotal", "type" => "text"),
        array("name" => "PPN", "id" => "ppn", "type" => "input"),
        array("name" => "Netto", "id" => "netto", "type" => "text"),

      )
    );




    $page['crud']['search_load_sub_kategori']["p_detilorder"]['target_no_sub_kategori'] = 0;
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['input'] = "Search ";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['call_function'] = array("change_subtotal(this,output)");
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['utama'] = "r_produk";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['primary_key'] = null;

    $page['crud']['search_load_sub_kategori']["p_detilorder"]['database']['select'] = array("*");
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['search'] = "primary_key";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['checked_row'] = "r_produk_id";
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['search_row'] = array("nama_produk", "kode_sku", 'barcode');
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['array_detail'] = array(
      "kdproduk" => "Kode",
      "nmproduk" => "Nama"
    );
    $page['crud']['search_load_sub_kategori']["p_detilorder"]['array_result'] =
      array(
        "r_produk_id" => array("row" => "primary_key", "type" => "database"),
        "kode_barang" => array("row" => "kdproduk", "type" => "database"),
        "nama_barang" => array("row" => "nmproduk", "type" => "database"),
        "stok_onhand" => array("text" => 1, "type" => "text"),
        "qty" => array("text" => 1, "type" => "text"),

        "harga" => array("row" => "harga", "type" => "database"),
        "jumlah" => array("row" => "harga", "type" => "database"),
      );


    $page['crud']['array'] = $array;
    $page['crud']['search'] = array(-3 => array("5"), -2 => array("5", "appr_status"));
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['sub_kategori'] = $sub_kategori;

    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function marker($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "pr_marker";
    $primary_key = null;

    $array = array(

      array("nomor", "nomor_marker", "date-req"),
      array("Tgl. Marker", "tanggal", "date-req"),
      array("No. Sample", "pr_planingmd_id", "select-req", array("pr_planingmd", null, "nmsample")),

      array("Kode Desain", "kode_desain", "select-disable-req-nosave", array("pr_design", null, "kddesain", 'kodedesign', "pr_sample")),
      array("Artikel", "artikel", "textarea"),
      array("Brand", "brand", "select-disable-nosave", array("r_brand", null, "nmbrand", null, "pr_sample"), "r_brand_id"),
      array("Warna", "warna", "select-disable-nosave", array("r_warna", null, "nmwarna", null, "pr_sample"), "r_warna_id"),
      array("Size", "size", "select", array("r_size", null, "nmsize"), "size"),
      array("Grup Jenis", "kdgrupjenis", "select-nosave", array("r_grupjenis", null, "nmgrupjenis", "nmgrupjenis", "pr_sample"), "r_grupjenis_id"),

      //alias//ambil_dari_table  //select relasi 
    );
    $sub_kategori[] = ["", "pr_marker_detil", null, "table"];
    $array_sub_kategori[] = array(
      array("Size", "pr_size_id", "select-req", ["r_size", "r_size_id", "nmsize"]),
      array("Bahan Utama ", "consproduksi", "number-req"),
      array("Variasi I ", "consvar", "number-req"),
      array("Kain Keras ", "conskainkeras", "number-req"),
      array("Kancing ", "conskancing", "number-req"),
      array("Zipper ", "conszipper", "number-req"),
      array("Logo ", "conslogo", "number-req"),
      array("Label ", "conslabel", "number-req"),
      array("Plastik ", "consplastik", "number-req"),
      array("Hantag", "conshantag", "number-req"),
      array("Loopin", "consloopin", "number-req"),
      array("Acc", "consacc", "number-req"),
    );
    $page['crud']['sub_kategori'] = $sub_kategori;
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    // array("Kode Desain", "kode_design", "select", array("pr_design", null, "kddesign"), "kode_design_id"),
    // $page['crud']['select_database_costum']['pr_planingmd_id']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
    $page['crud']['select_database_costum']['pr_planingmd_id']['join'][]  = array(" pr_sample", "pr_sample.pr_sample_id", "pr_sample.pr_sample_id");

    $page['crud']['select_database_costum']['desain']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
    $page['crud']['select_database_costum']['desain']['join'][]  = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    $search = array();
    //tag and kontent
    //header
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['utama'] = "pr_sample";
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" pr_design", "pr_design.pr_design_id", "pr_sample.pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    // $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['request_where'] = "pr_sample.pr_sample_id";
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_organisasi_id", "r_organisasi_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "kode_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_grupjenis_id", "kdgrupjenis");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_warna_id", "r_warna_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_brand_id", "r_brand_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("tahun", "tahun");

    $page['crud']['insert_number_code']['nomor_marker']['prefix'] = "1.MAR.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['nomor_marker']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['nomor_marker']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['nomor_marker']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['nomor_marker']['root']['month_get_row_where'][0] = "tanggal_outgoing";
    $page['crud']['insert_number_code']['nomor_marker']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['nomor_marker']['suffix'] = '';
    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;





    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  public static function instruksi_sample_produksi()
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "pr_intruksi";
    $primary_key = null;

    $array = array(

      array("Tgl. Intruksi", "tanggal", "date-req"),
      array("No. Sample", "pr_planingmd", "select-req", array("pr_planingmd", null, "nmsample")),
      array("Desain", "desain", "select-disable-req-nosave", array("pr_design", null, "nmdesainer", 'design', "r_nmdesign"), "nmdesign"),
      array("Kode Desain", "kode_desain", "select-disable-req-nosave", array("pr_design", null, "kddesain", 'kodedesign', "pr_sample")),
      array("Jenis", "jenis", "select-nosave", array("r_grupjenis", null, "kdgrupjenis", "kdgrupjenis", "pr_sample"), "kdgrupjenis", "r_grupjenis_id"),
      array("Grup Jenis", "kdgrupjenis", "select-nosave", array("r_grupjenis", null, "nmgrupjenis", "nmgrupjenis", "pr_sample"), "r_grupjenis_id"),
      array("Kode Produksi", "kode_produks", "text-disable-nosave"),
      array("Brand", "brand", "select-disable-nosave", array("r_brand", null, "nmbrand", null, "pr_sample"), "r_brand_id"),
      //alias//ambil_dari_table  //select relasi 
      array("Warna", "warna", "select-disable-nosave", array("r_warna", null, "nmwarna", null, "pr_sample"), "r_warna_id"),
      array("Size", "size", "select", array("r_size", null, "nmsize"), "size"),
      array("Keterangan", "keterangan", "textarea"),
      array("Penerima", "penerima", "select-req", array("r_bp", null, "nmbp"), 'penerima'),
    );

    // array("Kode Desain", "kode_design", "select", array("pr_design", null, "kddesign"), "kode_design_id"),
    // $page['crud']['select_database_costum']['pr_planingmd_id']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
    $page['crud']['select_database_costum']['pr_planingmd_id']['join'][]  = array(" pr_sample", "pr_sample.pr_sample_id", "pr_sample.pr_sample_id");

    $page['crud']['select_database_costum']['desain']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
    $page['crud']['select_database_costum']['desain']['join'][]  = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    $search = array();
    //tag and kontent
    //header
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['utama'] = "pr_sample";
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" pr_design", "pr_design.pr_design_id", "pr_sample.pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
    // $page['crud']['field_value_automatic']['pr_sample_id']['database']['join'][] = array(" r_nmdesign","r_nmdesign.nmdesign_id","pr_design.nmdesign_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['request_where'] = "pr_sample.pr_sample_id";
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_organisasi_id", "r_organisasi_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "pr_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("pr_design_id", "kode_design_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_grupjenis_id", "kdgrupjenis");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_warna_id", "r_warna_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("r_brand_id", "r_brand_id");
    $page['crud']['field_value_automatic']['pr_sample_id']['field'][] = array("tahun", "tahun");

    $page['crud']['insert_number_code']['kodejob']['prefix'] = "1.WSH.NOWBULAN|.NOWTAHUNKECIL|";
    $page['crud']['insert_number_code']['kodejob']['root']['type'][0] = 'count-month';
    $page['crud']['insert_number_code']['kodejob']['root']['sprintf'][0] = true;
    $page['crud']['insert_number_code']['kodejob']['root']['sprintf_number'][0] = 5;
    $page['crud']['insert_number_code']['kodejob']['root']['month_get_row_where'][0] = "tanggal_outgoing";
    $page['crud']['insert_number_code']['kodejob']['root']['plus'] = 1000000;
    $page['crud']['insert_number_code']['kodejob']['suffix'] = '';
    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;





    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    return $page;
  }
  // public static function rmw_received()
  // {
  //   $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
  //   $page['route'] = __FUNCTION__;
  //   $page['layout_pdf'] = array('a4', 'portait');

  //   $database_utama = "p_mr";
  //   $primary_key = null;

  //   $array = array(

  //     array("No.Dokumen", "kdmr", "text-req"),
  //     array("Tanggal", "tglmr", "date-req"),

  //     array("Sumber", "sumber", "select-manual-req", array("IM" => "Inventory Move", "JOB" => "Job", "JOR" => "Job Order Received", "PO" => "Purchase Order", "RG" => "Return Gudang (XML)", "QC" => "QC", "BOM" => "BOM", "MM" => "Mutasi Masuk"),),
  //     array("No. Ref", "p_order_id", "select-ajax"),
  //     array("Bisnis Partner", "r_bp_id", "select", array("r_bp", null, "nmbp")),
  //     array("Organisasi", "r_organisasi_id", "select", array("r_organisasi", null, "nmorganisasi")),
  //     array("Tanggal IM", "tgl_rg", "date"),
  //     array("Gudang", "i_gudang_id", "select-req", array("i_gudang", null, "nmgudang")),
  //     array("Inspektor", "inspektor", "text-req"),
  //     array("Produk Yang Telah Di MR", "qty_tlh_mr", "number"),
  //     array("Sisa", "qty_sisa", "number"),
  //     array("Tanggal Awal Inspek", "tglawalinspek", "date-req"),
  //     array("Tanggal Akhir Inspek", "tglakhirinspek", "date-req"),
  //   );

  //   // array("Kode Desain", "kode_design", "select", array("pr_design", null, "kddesign"), "kode_design_id"),
  //   // $page['crud']['select_database_costum']['pr_planingmd_id']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
  //   $page['crud']['select_database_costum']['pr_planingmd_id']['join'][]  = array(" pr_sample", "pr_sample.pr_sample_id", "pr_sample.pr_sample_id");

  //   $page['crud']['select_database_costum']['desain']['select'] = array("*", "r_nmdesign.nmdesign as nmdesainer");
  //   $page['crud']['select_database_costum']['desain']['join'][]  = array(" r_nmdesign", "r_nmdesign.nmdesign_id", "pr_design.nmdesign_id");
  //   $search = array();
  //   $sub_kategori[] = ["Detil",    "p_detilmr", null, "table"];
  //   $array_sub_kategori[] = array(

  //     array("Kode", "kode", "text"),
  //     array("Nama", "nama", "text"),
  //     array("Satuan", "satuan", "text"),
  //     array("Qty PO", "qty_po", "text"),
  //     array("QTY SJ", "qtysj", "text"),
  //     array("QTY QC", "qtyqc", "text"),
  //     array("QTY Reject", "qtyreject", "text"),
  //     array("Selisih", "selisih", "text"),
  //     array("Invoice", "qtyinvoice", "text"),
  //     array("Alokasi", "alokasi", "modalform-subkategori-add"),
  //     array("Keterangan", "keterangan", "text"),
  //     array("Alias", "alias", "text"),
  //   );
  //   $page['crud']['sub_kategori'] = $sub_kategori;
  //   $page['crud']['array_sub_kategori'] = $array_sub_kategori;

  //   $page['crud']['insert_number_code']['kodejob']['prefix'] = "1.WSH.NOWBULAN|.NOWTAHUNKECIL|";
  //   $page['crud']['insert_number_code']['kodejob']['root']['type'][0] = 'count-month';
  //   $page['crud']['insert_number_code']['kodejob']['root']['sprintf'][0] = true;
  //   $page['crud']['insert_number_code']['kodejob']['root']['sprintf_number'][0] = 5;
  //   $page['crud']['insert_number_code']['kodejob']['root']['month_get_row_where'][0] = "tanggal_outgoing";
  //   $page['crud']['insert_number_code']['kodejob']['root']['plus'] = 1000000;
  //   $page['crud']['insert_number_code']['kodejob']['suffix'] = '';
  //   $page['crud']['array'] = $array;
  //   $page['crud']['search'] = $search;





  //   $page['database']['utama'] = $database_utama;
  //   $page['database']['primary_key'] = $primary_key;
  //   $page['database']['select'] = array("*");;
  //   $page['database']['join'] = array();
  //   $page['database']['where'] = array();
  //   return $page;
  // }
}
