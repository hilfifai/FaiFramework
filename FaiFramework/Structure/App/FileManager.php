<?php

class FileManager{
    public static function home($page)
    {
        $i=0;
       
        $i++;
        $website['content'][$i]['tag'] = "";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "file_manager";
        // $website['content'][$i]['db_list'] = "home_banner";
        $website['content'][$i]['template_function'] = "base";
        $i++;
      

        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
}