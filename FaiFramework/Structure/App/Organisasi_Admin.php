<?php

class Organisasi_Admin 
{
    //Master Data
    public function menu()
    {
        //nama/link/icon
        $menu = array(
           
        array("group","Organisasi Setup"),
            array("menu","Kategori",array("Organisasi_Admin","kategori","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
            
        array("group","List Organsiasi"),
            array("menu","Approve Organisasi",array("Organisasi_Admin","approve","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
           
          
        );
        
        return $menu;
    } public function kategori()
    {
    	$page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
        $page['route'] = __FUNCTION__ ;
        $page['layout_pdf'] = array('a4','portait') ;
       
        $database_utama = "organisasi_setup__".__FUNCTION__;
        $primary_key ="id_".$database_utama;
        
        $array = array(
      		array("Kode Kategori","kode_kategori","text"),
      		array("Nama Kategori","nama_kategori","text"),
       );
       $search = array();
       
      $page['crud']['array'] = $array ;
      $page['crud']['search'] = $search ;
 		
 		
 		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key ;
		$page['database']['select'] = array("*","$database_utama.$primary_key as primary_key"); ;
		$page['database']['join'] = array();
		$page['database']['where'] = array();  
         return $page;
    }
}