<?php 

class Medsos{

    
	
    public function follow(){
    	$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "medsos__folow" ;
        $primary_key = null;

        $array = array(
			array("Panel",null,"select",array("panel",null,"nama_panel")),
			array("tipe",null,"select-manual",array("organisasi",null,"nama_organisasi")),
			array("User",null,"select",array("user",null,"nama_lengkap")),
			
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