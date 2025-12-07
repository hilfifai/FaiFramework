<?php 

Class Keuangan{
    public static function list_workspace($page)
    {
        $_SESSION['to_list_workspace_id_apps'] = Partial::get_id_apps($page);
        $page = Workspace::workspace_apps($page);
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function Dashboard_workspace()
    {
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function menu_basic(){
        $menu = array(
            array("group", "Dasar",array(
            
                    array("menu", "Kategori", array("Keuangan", "kategori", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "COA", array("Keuangan", "akun", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pemasukan Kas", array("Keuangan", "pemasukan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pengeluaran Kas", array("Keuangan", "pengeluaran", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Hutang", array("Keuangan", "hutang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Piutang", array("Keuangan", "piutang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group","Perencanaan",array(
                    array("menu","Rencana Anggaran Biaya",array("Keuangan","rab","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu","Penyisihan Hasil usaha",array("Keuangan","rab","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group","Transaksi",array(
                    array("menu","Mutasi Dana",array("Keuangan","mutasi_dana","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu","Biaya Operasional",array("Keuangan","biaya_opersional","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu","Pelunasan Pembelian",array("Keuangan","pelunasan_pembelian","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu","Penerimaan Deposit",array("Keuangan","penerimaan_deposit","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu","Keluar Deposit",array("Keuangan","keluar_deposit","list", "-1", -1, -1, 'ID_BOARD|'),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            array("group","Laporan Keuangan",array(
                    array("menu", "Buku Besar", array("Keuangan", "buku_besar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Jurnal Umum", array("Keuangan", "jurnal_umum", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Neraca lajur", array("Keuangan", "Neraca_lajur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Laba Rugi", array("Keuangan", "laba_rugi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Neraca", array("Keuangan", "neraca", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),


        );
        return $menu;
        

        
    

    }
    public static function akun(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            //array("Kategori","kode_akun","text-req"),
            array("Panel","panel","select",array("panel",null,"nama_panel")),
            array("Kategori","kategori","select",array("keuangan__kategori",null,"nama_kategori")),
            array("Kode Akun","kode_akun","text-req"),
            array("Nama Akun","nama_akun","text-req"),
            array("Brand", null, "select", array('webmaster__payment_method_brand', null, 'nama_brand'), null),
            array("No Rekening","norek","text"),
            array("Atas Nama","atas_nama","text"),
            array("Ketarangan","keterangan_akun","text-req"),
            array("Parent Akun","parent","select-req",array($database_utama,$primary_key,"nama_akun","parent")),
            array("Pos Saldo","pos_saldo","select-manual-req",array('Debit'=>"Debit","Kredit"=>"Kredit")),
            array("Pos Laporan","pos_laporan","select-manual-req",array('Neraca'=>"Neraca","Laba Rugi"=>"Laba Rugi")),
            array("","id_store__toko","number-view"),
        );


        $page['crud']['search'] = array(-1 => array(4, 1));

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function kategori(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            array("Panel","panel","select",array("panel",null,"nama_panel")),
            array("Kode Kategori","kode_kategori","text-req"),
            array("Nama Kategori","nama_kategori","text-req"),
           
        );


        $page['crud']['search'] = array();

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function pemasukan(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            //array("Kategori","kode_akun","text-req"),
            
            array("panel","panel","select",array("panel",null,"nama_panel")),
            array("Apps User","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
            array("Tanggal Transaksi","tanggal_transaksi","date"),
            array("Nomor Pemasukan","nomor","text"),
            array("Simpan ke","akun_simpan","select-req",array("keuangan__akun",null,"nama_akun","parent")),
            array("Diterima dari","akun_terima","select-req",array("keuangan__akun",null,"nama_akun","diterima")),
            array("Nominal","nominal","number"),
            array("Keterangan","keterangan","textarea"),
        );


        $page['crud']['search'] = array(-1 => array(3, 1));

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function pengeluaran(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            //array("Kategori","kode_akun","text-req"),
            
            array("panel","panel","select",array("panel",null,"nama_panel")),
            array("Apps User","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
            array("Tanggal Transaksi","tanggal_transaksi","date"),
            array("Nomor Pengeluaran","nomor_pengeluaran","text"),
            array("Untuk Keperluan","akun_keperluan","select-req",array("keuangan__akun",null,"nama_akun","parent")),
            array("Dikeluarkan Dari","akun_dari","select-req",array("keuangan__akun",null,"nama_akun","diterima")),
            array("Nominal","nominal","number"),
            array("Keterangan","keterangan","textarea"),
        );


        $page['crud']['search'] = array(-1 => array(3, 1));

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function piutang(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            //array("Kategori","kode_akun","text-req"),
            
            array("panel","panel","select",array("panel",null,"nama_panel")),
            array("Apps User","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
            array("Tanggal Transaksi","tanggal_transaksi","date"),
            array("Panel Piutang","panel","select",array("panel","id_apps_user","nama_panel")),
            array("Nomor piutang","nomor_piutang","text"),
            array("Keperluan Piutang","akun_keperluan","select-req",array("keuangan__akun",null,"nama_akun","parent")),
            array("Diambil Dari","akun_dari","select-req",array("keuangan__akun",null,"nama_akun","diterima")),
            array("Nominal","nominal","number"),
            array("Keterangan","keterangan","textarea"),
        );


        $page['crud']['search'] = array(-1 => array(3, 1));

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    
    public static function hutang(){
        
        

        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "keuangan__" . __FUNCTION__;
        $primary_key = null;

        $array=array(
            //array("Kategori","kode_akun","text-req"),
            
            array("panel","panel","select",array("panel",null,"nama_panel")),
            array("Apps User","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
            array("Tanggal Transaksi","tanggal_transaksi","date"),
            array("Panel Hutang","panel_hutang","select",array("panel",null,"nama_panel","hutang")),
            array("Nomor hutang","nomor_hutang","text"),
            array("Dikeluarkan_dari","akun_keperluan","select-req",array("keuangan__akun",null,"nama_akun","parent")),
            array("Diambil Dari","akun_dari","select-req",array("keuangan__akun",null,"nama_akun","diterima")),
            array("Nominal","nominal","number"),
            array("Keperluan","keperluan","number"),
            array("Keterangan","keterangan","textarea"),
        );


        $page['crud']['search'] = array(-1 => array(3, 1));

        $page['crud']['array'] = $array;
        //$page['menu'] = POS::menu();

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    
    
}