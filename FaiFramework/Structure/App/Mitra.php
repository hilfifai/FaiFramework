<?php

class Mitra{

    public static function landing_page_pendaftaran_mitra(){
        $i=0;
        
        $i++;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "hibe3";
        // $website['content'][$i]['db_list'] = "home_banner";
        $website['content'][$i]['template_function'] = "landing_mitra";
        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
    public static function berhasil(){
        $i=0;
        
        $i++;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "hibe3";
        // $website['content'][$i]['db_list'] = "home_banner";
        $website['content'][$i]['template_function'] = "mitra_berhasil";
        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
}