<?php

class Chat{


    public static function massangger(){
        $i=0;
        
       

        $page['chat']["template_base"] = "beegrit/chat";

        return $page;
    }
    public static function menu_basic()
    {
    }
    public static function room()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Be3 ID", "apps_id", "text"),
            array("Panel", null, "select",array('panel',null,'nama_panel')),
            array("Tipe Room", null, "select-manual", array("personal" => "Personal", "grup" => "Grup", "organisasi" => "Organisasi", "organisasi" => "Organisasi", "divisi" => "Divisi",'ecomerce'=>"Ecomerce","bot_system"=>"Bot System","system"=>"System")),
            array("id_to_chat", null, "number-disabled"),
            array("last_sort_message", null, "number-disabled"),
            array(null, "pisahkan_ikhwan_akhwat", "select-manual",array("1"=>"Ya","2"=>"Tidak")),
            array( null, "persetujuan_gabung", "select-manual",array("1"=>"Ya","2"=>"Tidak")),
            array( null, "persetujuan_chat", "select-manual",array("1"=>"Ya","2"=>"Tidak")),
            array( null, "enable_send", "select-manual",array("1"=>"Ya","2"=>"Tidak")),
            array( null, "grup_utama","number-disabled"),
            array( null, "status_bot","number-disabled"),
            array( null, "package_bot","number-disabled"),
            array( null, "bot_unique_id","number-disabled"),
            array( null, "bot_unique_support","number-disabled"),
            array( null, "bot_position","number-disabled"),
            array( null, "number_from","number-disabled"),
            array( null, "is_wa","number-disabled"),
            array( null, "nama_room","number-disabled"),
            array( null, "from_sender","number-disabled"),
           
        );
        
        $sub_kategori[] = ["Anggota", "" . $database_utama  . "__anggota", null, "form"];
        $array_sub_kategori[] = array(
            array("apps_user", null, "select", array('apps_user', "id_apps_user", 'nama_lengkap'), null),
            array("role", null, "select", array('web__list_apps_role', null, 'nama_role'), null),
            
            array("", "last_sort", "number"),
            array("", "last_read", "number"),
            array("", "gabung_tanggal", "date"),
            array("", "keluar_tanggal", "date"),

        );
        $sub_kategori[] = ["pesan", "" . $database_utama  . "__pesan", null, "form"];
        $array_sub_kategori[] = array(
        
            array( null, "mode", "select-manual",array("utama"=>"Utama","_ikhwan"=>"Ikhwan","_akhwat"=>"Akhwat")),
             array("pengiriman", null, "select", array('apps_user', "id_apps_user", 'nama_lengkap'), null),
            array("tipe_pesan", null, "select-manual",array("gabung"=>"Gabung","keluar"=>"Keluar","pesan"=>"Pesan","file"=>"File"), null),
            array("", "content_message", "textarea"),
            array("", "id_chat_bot", "number"),
            array("", "package_bot", "text"),
            array("", "reply_package", "text"),
            array("", "bot_unique_id", "text"),
            array("", "block_by", "text"),
            array("", "block_deskripsi", "text"),
            array("", "share_to", "number"),
            array("", "share_from", "number"),
            array("", "reply_from", "number"),
            array("", "sort", "number"),

        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function bot()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            
            array(null, "package_bot", "select",array("chat__bot__package","nama_package","nama_package"),"id_package_bot"),
            array(null, "nama_proses","text"),
            array( null, "kode_chat_room_bot", "text"),
            array( null, "id_prev", "text"),
            array( null, "type_bot", "select-manual",array("need"=>"Need","direct"=>"Direct","save_moment"=>"Save_moment")),
            
            array( null, "keyword","text"),
            array( null, "reply_content","textarea"),
            array( null, "reply_package","text"),
            array( null, "allow_massage","text"),
            array( null, "allow_package","text"),
            array( null, "bot_loop","select-manual",array("1"=>"Ya","2"=>"Tidak")),
            
             	 	 	 	
           
        );
        
        $sub_kategori[] = ["Save", "" . $database_utama  . "__save", null, "form"];
        $array_sub_kategori[] = array(
            
            array("", "bot_unique_id", "text"),
            array("", "bot_unique_support", "text"),
            array("", "package_bot", "text"),
            array("", "reply_package", "text"),
            array("", "content", "textarea"),
            array("", "status_generate", "select-manual",array("1"=>"Sudah","2"=>"Belum")),

        );
        
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function package_bot()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat__bot__package" ;
        $primary_key = null;

        $array = array(

            array(null, "nama_package","text"),
            
           
        );
        
        
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function reply()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat_package" ;
        $primary_key = null;

        $array = array(


            
          
            array(null, "nama_package","text"),
            
           
        );
        
        
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function wa_number()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat_wa_number" ;
        $primary_key = null;

        $array = array(

            array(null, "nama_kontak","text-req"),
            array(null, "wa_number","text-req"),
            array(null, "tipe_kontak","select-manual-req",["kontak"=>"Kontak","group"=>"Group"]),
            array(null, "koneksi_apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
            
           
        );
        
        
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function wa_phonebook()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat_wa_phonebook" ;
        $primary_key = null;

        $array = array(

           
            array(null, "nama_phone_book","text"),
        );
        
        $sub_kategori[] = ["Number", "" . $database_utama  . "__number", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "number","select",array("chat_wa_number",null,"nama_kontak")),
        );
        $page['crud']['select_database_costum']["id_number"]['select']= ["*,case when nama_kontak is not null then nama_kontak else wa_number end as nama_kontak"];
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function broadcast()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat__broadcast" ;
        $primary_key = null;

        $array = array(

           
            array(null, "kode_broadcast","text"),
            array(null, "nama_broadcast","text"),
            array(null, "frekuensi","select-manual",array("sekali"=>"sekali","berulang harian"=>"berulang harian","berulang hari khusus"=>"berulang hari khusus")),
            array(null, "berulang_dalam_satu_hari","select-manual",array("+30 minutes"=>"setiap 30 menit","1 hour"=>"setiap 1 jam","3 hour"=>"setiap 3 jam","6 hour"=>"setiap 6 jam","12 hour"=>"setiap 12 jam")),
            array(null, "tanggal_awal_broadcast","date"),
            array(null, "tanggal_akhir_broadcast","date"),
            array(null, "tanggal_mulai","date"),
            array(null, "waktu_mulai","time"),
            array(null, "status","select-manual-edit-list",array("belum"=>"Belum","sudah"=>"Sudah")),
            array(null, "generate_date","date-edit-list"),
        );
        
        $sub_kategori[] = ["List Hari", "" . $database_utama  . "__list__hari", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "nama_hari","select-manual",array("senin"=>"Senin","selasa"=>"selasa","rabu"=>"Rabu","kamis"=>"Kamis","jumat"=>"Jumat","sabtu"=>"Sabtu","minggu"=>"Minggu")),
        );
        $sub_kategori[] = ["List Phone Book", "" . $database_utama  . "__list__number", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "number","number"),
        );
        $sub_kategori[] = ["List Phone Book", "" . $database_utama  . "__list__phone_book", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "phonebook","select",array("chat_wa_phonebook",null,"nama_phone_book")),
        );
        $sub_kategori[] = ["List Chat Room", "" . $database_utama  . "__list__chat_room", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "chatroom","select",array("chat__room",null,"nama_room")),
             array("Dengan number wa dalam room", "dengan_number","select-manual",array("tidak",'ya')),
        );
        $sub_kategori[] = ["List Generate", "" . $database_utama  . "__generate", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "generate_tanggal","date"),
             array(null, "status","select-manual",array("belum"=>"belum",'selesai'=>'selesai')),
             array(null, "number","text"),
             array(null, "id_pesan","select",array($database_utama  . "__list__pesan",null,"tipe_pesan")),
        );
        $sub_kategori[] = ["List Pesan", "" . $database_utama  . "__list__pesan", null, "form"];
        $array_sub_kategori[] = array(
             array(null, "tipe_pesan","select-manual",array("text"=>"text",'media'=>'media','command'=>'commad')),
             array(null, "pesan","textarea"),
             array(null, "media","file","chat/broadcast"),
        );
        $page['crud']['hidden_show']['frekuensi']['onjs'] = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['frekuensi']['default']["berulang_dalam_satu_hari"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['default']["tanggal_awal_broadcast"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['default']["tanggal_akhir_broadcast"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['default']["tanggal_mulai"] = "show";
        $page['crud']['hidden_show']['frekuensi']['default_sub_kategori'][$database_utama  . "__list__hari"] = "hide";


        $page['crud']['hidden_show']['frekuensi']['value_if']["sekali"]["berulang_dalam_satu_hari"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['value_if']["sekali"]["tanggal_awal_broadcast"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['value_if']["sekali"]["tanggal_akhir_broadcast"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['value_if']["sekali"]["tanggal_mulai"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if_sub_kategori']["sekali"][$database_utama . "__list__hari"] = "hide";
        
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang harian"]["berulang_dalam_satu_hari"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang harian"]["tanggal_awal_broadcast"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang harian"]["tanggal_akhir_broadcast"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang harian"]["tanggal_mulai"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['value_if_sub_kategori']["berulang harian"][$database_utama . "__list__hari"] = "hide";
        
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang hari khusus"]["berulang_dalam_satu_hari"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang hari khusus"]["tanggal_awal_broadcast"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang hari khusus"]["tanggal_akhir_broadcast"] = "show";
        $page['crud']['hidden_show']['frekuensi']['value_if']["berulang hari khusus"]["tanggal_mulai"] = "hide";
        $page['crud']['hidden_show']['frekuensi']['value_if_sub_kategori']["berulang hari khusus"][$database_utama . "__list__hari"] = "show"; 

        
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function send_wa()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "chat__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            
            array(null, "package_bot","text"),
            array(null, "nama_proses","text"),
            array( null, "prev_id", "select",array("$database_utama","$primary_key","nama_proses",'prev'),null),
            array( null, "type_bot", "select-manual",array("need"=>"Need","direct"=>"Direct","save_moment"=>"Save_moment")),
            
            array( null, "keyword","text"),
            array( null, "reply_content","textarea"),
            array( null, "keyword","text"),
           
        );
        
        $sub_kategori[] = ["Anggota", "" . $database_utama  . "__anggota", null, "form"];
        $array_sub_kategori[] = array(
            
            array("", "bot_unique_id", "text"),
            array("", "bot_unique_support", "text"),
            array("", "package_bot", "text"),
            array("", "reply_package", "text"),
            array("", "content", "textarea"),
            array("", "status_generate", "select-manual","1"=>"Sudah","2"=>"Belum"),

        );
        
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        // $page['get']['sidebarIn'] = true;;

        return $page;
    }
}