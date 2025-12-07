<?php

class MenuListContent{
    public static function router($page){
        $menu=[];
        // $menu["hibe3.com"]["public"]["list"] = MenuListContent::hibe3_public_list($page);
        // $menu["hibe3.com"]["user"]["basic"] = MenuListContent::hibe3_user_basic($page);
        $menu[] = "menu_ecommerce_frontend"; 
        return $menu;
    }
    public static function menu_ecommerce_frontend($page){
         $menu=[];
         $var_menu_public = [
            ["nama"=>"Home","Workspace","home-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Belanja","Workspace","belanja-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Pendaftaran Mitra","Mitra","landing-page-pendaftaran-mitra","view-layout","-1","-1","-1",true],
            ["nama"=>"Pesanan Saya","Ecommerce","pesanan-saya","view-layout","-1","-1","-1",true],
            ["nama"=>"Kontak Kami","Workspace","kontak-kami","view-layout","-1","-1","-1",true],
         ];
         $var_menu_user = [
            ["nama"=>"Home","Workspace","home-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Belanja","Workspace","home-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Pendaftaran Mitra","Mitra","landing-page-pendaftaran-mitra","view-layout","-1","-1","-1",true],
            ["nama"=>"Pesanan Saya","Ecommerce","pesanan-saya","view-layout","-1","-1","-1",true],
            ["nama"=>"Kontak Kami","Workspace","kontak-kami","view-layout","-1","-1","-1",true],
         ];
         $var_menu_mitra = [
            ["nama"=>"Home","Workspace","home-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Belanja","Workspace","home-ecommerce","view-layout","-1","-1","-1",false],
            ["nama"=>"Pesanan Saya","Ecommerce","pesanan-saya","view-layout","-1","-1","-1",true],
            ["nama"=>"Kontak Kami","Workspace","kontak-kami","view-layout","-1","-1","-1",true],
         ];
         $menu["moesneeds.id"]["public"]["list"] = $var_menu_public;
         $menu["moesneeds.id"]["user"]["list"] = $var_menu_user;
         $menu["moesneeds.id"]["mitra"]["list"] = $var_menu_mitra;
         $menu["v2.moesneeds.id"]["public"]["list"] = $var_menu_public;
         $menu["v2.moesneeds.id"]["user"]["list"] = $var_menu_user;
         $menu["v2.moesneeds.id"]["mitra"]["list"] = $var_menu_mitra;
         return $menu;
    }
}