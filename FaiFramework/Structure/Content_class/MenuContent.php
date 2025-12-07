<?php
class MenuContent
{

    public static function finapp_menu($page, $type = -1)
    {
        $template = [];

        $set_type = "header";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::finapp___headerpage($page);
            $template[$set_type]['array'][] = ["IMAGE-LOGO", 'bundle', 'logo'];

            $template[$set_type]['array'][] = ["LINK-CART", 'link', ["Ecommerce","cart","view_layout",-1],'just_link'];
        }
        $set_type = "bottom";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::finapp___bottompage($page);
           
        }
        $set_type = "sidebar";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::finapp___sidebarpage($page);
           
        }
       return $template;
    }
    public static function foodmart_menu($page, $type = -1)
    {
    }
    public static function hibe3_menu($page, $type = -1)
    {
        $template = [];
        
        $set_type = "header";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3___headerpage($page);
            
            $template[$set_type]['array'][] = ["LINK-CART", 'link', ["Ecommerce","cart","view_layout",-1],'just_link'];
            $template[$set_type]['array'][] = ["HEADER-UTAMA",  "menu_content",'hibe3__menu', 'header_list'];
        }
        $set_type = "HeaderList";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_headerlist_template($page);;
            $template[$set_type]['database']= array(
                "utama" => "tab_group",
                "primary_key" => "id",
                "where" => [["id_apps_user", "=", "{SESSION_UTAMA}"]],
            );
            $template[$set_type]['array'][] = ["TEXT", 'database', 'nama_kategori'];
            $template[$set_type]['array'][] = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "navbar";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3___navbarpage($page);
            
            $template[$set_type]['array'][] = ["NAVBAR-LIST",  "menu_content",'hibe3__menu', 'navbar_list'];
            $template[$set_type]['array'][] = ["NAVBAR-LOGO",  "menu_content",'hibe3__menu', 'navbar_logo'];
            $template[$set_type]['array'][] = ["NAVBAR-SEARCH",  "menu_content",'hibe3__menu', 'navbar_search'];
            $template[$set_type]['array'][] = ["NAVBAR-TOGGLE",  "menu_content",'hibe3__menu', 'navbar_toggle'];
        }
        $set_type = "navbar_toggle";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_navbartoggle_template($page);
            
        }
        $set_type = "navbar_search";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_navbarsearch_template($page);
            
        }
        $set_type = "navbar_logo";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_navbarlogo_template($page);
            $template[$set_type]['array'][] = ["IMAGE-LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["BASE-URL", 'base_url', ''];
            
        }
        $set_type = "navbar_notification";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_navbarnotification_template($page);
            
        }
        $set_type = "navbar_button_search";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3___navbarbuttonsearch($page);
            
        }
        $set_type = "navbar_list_profil";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3___navbarlistprofile($page);
            $template[$set_type]['array'][] = ["LINK-LOGOUT", 'link', ["Auth","logout","-1",-1],'costum_link'];
            $template[$set_type]['array'][] = ["LINK-PEMESANAN", 'link', ["User","pemesanan","view_layout",-1],'just_link'];
            $template[$set_type]['array'][] = ["LINK-PROFIL-USER", 'link', ["User","profil","view_layout",-1],'just_link'];
            $template[$set_type]['array'][] = ["NAMA-LENGKAP", 'user_info', 'nama_lengkap'];
        }
        $set_type = "navbar_list";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']['html'] ="<NAVBARNOTIVICATION></NAVBARNOTIVICATION><NavbarListProfile></NavbarListProfile><NavbarButtonSearch></NavbarButtonSearch>";
            
            $template[$set_type]['array'][] = ["NAVBARNOTIVICATION",  "menu_content",'hibe3__menu', 'navbar_notification'];
            $template[$set_type]['array'][] = ["NavbarListProfile",  "menu_content",'hibe3__menu', 'navbar_list_profil'];
            $template[$set_type]['array'][] = ["NavbarButtonSearch",  "menu_content",'hibe3__menu', 'navbar_button_search'];
        }
        


        // hibe3_headerlist_template;
        $header['template_array'] = array(
			array(
				"tag" => 'LINK-CART',
				"refer" => "link",
				"link" => array("Ecommerce", "cart", "view_layout", "-1")

			),
			array(
				"tag" => 'HEADER-UTAMA',
				"template_name" => "hibe3",
				"template_file" => "HeaderList.template",
				"refer" => "database_list",
				"database_refer" => "-1",
				"database" => array(
					"utama" => "tab_group",
					"primary_key" => "id",
					"where" => [["id_apps_user", "=", "{SESSION_UTAMA}"]],
				),
				"template_name" => "hibe3",
				"template_file" => "SidebarList.template",
				"array" => array(
					"NAME" => array("refer" => "database", "row" => "nama_menu_tab"),
					"LINK" => array("refer" => "link", "row" => "nama_menu_tab"),
				),
			),
		);
        return $template;
    }
}
