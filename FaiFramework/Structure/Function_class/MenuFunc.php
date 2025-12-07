<?php

class MenuFunc
{
    public static function menu_ecommerce_frontend()
    {
        $menu = array(
            array("menu", "Home", [
                "0" => "Workspace",
                "1" => "home_ecommerce",
                "2" => "view_layout",
                "3" => "-1",
                "4" => "",
                "5" => "",
                "6" => "",
                "7" => "",
                "8" => "",
                "9" => ""
            ], ''),
            array("menu", "Shop", [
                "0" => "Ecommerce",
                "1" => "list",
                "2" => "view_layout",
                "3" => "-1",
                "4" => "",
                "5" => "",
                "6" => "",
                "7" => "Frontend",
                "8" => "controller",
                "9" => ""
            ], ''),
            array("menu", "Pesanan Saya", [
                "0" => "Ecommerce",
                "1" => "pesanan_saya",
                "2" => "list",
                "3" => "-1",
                "4" => "-1",
                "5" => "-1",
                "6" => "ID_BOARD|",
                "7" => "Frontend",
                "8" => "controller",
                "9" => ""
            ], ''),
            array("menu", "Daftar Mitra", [
                "0" => "Workspace",
                "1" => "daftar_mitra",
                "2" => "list",
                "3" => "-1",
                "4" => "-1",
                "5" => "-1",
                "6" => "ID_BOARD|",
                "7" => "Frontend",
                "8" => "controller",
                "9" => ""
            ], ''),
            array("menu", "Kontak Kami", [
                "0" => "",
                "1" => "",
                "2" => "",
                "3" => "",
                "4" => "",
                "5" => "",
                "6" => "",
                "7" => "Backend",
                "8" => "bundles",
                "9" => "contact_us"
            ], ''),

        );
        return $menu;
    }
}
