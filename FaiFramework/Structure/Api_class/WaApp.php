<?php 

require_once(__DIR__.'/../Api_class/CNKWaApi.php');
require_once(__DIR__.'/../Api_class/WapanelsWaApi.php');
require_once(__DIR__.'/../Api_class/Wapanels2WaApi.php');
class WaApp{
    
    protected $wa;

    function __construct() {
      //  $this->wa = new CNKWaApi();;
    }
    public static function send($number,$message,$tipe='message',$link_media="")
    {
         $func = "send_$tipe";
       $message = str_replace( 
                    array("<b> ","<b>"," </b>","</b>"),
                    array("*","*","*","*"),
                    $message
                    );
       $message = str_replace( 
                    array("<i> ","<i>"," </i>","</i>"),
                    array("_","_","_","_"),
                    $message
                    );
        return WatsapWaApi::$func($number,$message,$link_media);
    }
    
}