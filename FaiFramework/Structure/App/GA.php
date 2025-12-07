<?php

class GA
{
    public static function list_workspace($page)
    {
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
    public static function menu_basic()
    {
        $menu = array(
            
            array("group", "Asset Management",array(
                    array("menu", "Perencanaan Kebutuhan Asset", array("GA", "perencaan_kebutuhan_aset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Peminjaman Asset", array("GA", "peminajam_aset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pengembalian Asset", array("GA", "pengembalian_aset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Maintenance Asset", array("GA", "maintenance_aset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Boking Asset", array("GA", "booking_asset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Rekomendasi Pembelian Asset", array("GA", "rekomendasi_pembelian_asset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ),
            ),
            
            
            array("group", "Asset Purchase",array(
                    array("menu", "Pembayaran Asset Berjenjang", array("GA", "pembayaran_asset_berjenjang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pengadaan Asset", array("GA", "peminajam_aset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    
                ),
            ),
            
            
            array("group", "Asset Kontrol ",array(
                    array("menu", "Ruang Kebersihan", array("GA", "ruang_kebersihan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Ceklist Kebersihan", array("GA", "ceklist_kebersihan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Jadwal Kontrol Asset", array("GA", "jadwal_kontrol_asset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Jadwal Kontrol Ruang", array("GA", "jadwal_kontrol_rurang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Kontrol Ruang", array("GA", "kontrol_rurang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Jadwal Kontrol Asset", array("GA", "jadwal_kontrol_asset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Kontrol Asset", array("GA", "kontrol_asset", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    //refil
                    
                ),
            ),
            

        );
        return $menu;
    }
}