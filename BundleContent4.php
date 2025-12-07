
        <?php
        
        class $newClassName
        {
            public static function router($page, $type, $array_website, $code = '')
    {
        $base = __DIR__ . "/router/";
        $return["css"] = file_exists($base . "router.css.php") ? file_get_contents($base . "router.css.php") : "";
        $return["js"] = file_exists($base . "router.js.php") ? file_get_contents($base . "router.js.php") : "";
        $return["html"] = file_exists($base . "router.html.php") ? file_get_contents($base . "router.html.php") : "";
        return $return;
    }

        public static function main_all($page)
    {
        $base = __DIR__ . "/main_all/";
        $return["css"] = file_exists($base . "main_all.css.php") ? file_get_contents($base . "main_all.css.php") : "";
        $return["js"] = file_exists($base . "main_all.js.php") ? file_get_contents($base . "main_all.js.php") : "";
        $return["html"] = file_exists($base . "main_all.html.php") ? file_get_contents($base . "main_all.html.php") : "";
        return $return;
    }

        public static function hibe3_base($page)
    {
        $base = __DIR__ . "/hibe3_base/";
        $return["css"] = file_exists($base . "hibe3_base.css.php") ? file_get_contents($base . "hibe3_base.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_base.js.php") ? file_get_contents($base . "hibe3_base.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_base.html.php") ? file_get_contents($base . "hibe3_base.html.php") : "";
        return $return;
    }

        public static function hibe3_card_main_listing($page)
    {
        $base = __DIR__ . "/hibe3_card_main_listing/";
        $return["css"] = file_exists($base . "hibe3_card_main_listing.css.php") ? file_get_contents($base . "hibe3_card_main_listing.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card_main_listing.js.php") ? file_get_contents($base . "hibe3_card_main_listing.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card_main_listing.html.php") ? file_get_contents($base . "hibe3_card_main_listing.html.php") : "";
        return $return;
    }

        public static function hibe3__CardMainListingMenu($page)
    {
        $base = __DIR__ . "/hibe3__CardMainListingMenu/";
        $return["css"] = file_exists($base . "hibe3__CardMainListingMenu.css.php") ? file_get_contents($base . "hibe3__CardMainListingMenu.css.php") : "";
        $return["js"] = file_exists($base . "hibe3__CardMainListingMenu.js.php") ? file_get_contents($base . "hibe3__CardMainListingMenu.js.php") : "";
        $return["html"] = file_exists($base . "hibe3__CardMainListingMenu.html.php") ? file_get_contents($base . "hibe3__CardMainListingMenu.html.php") : "";
        return $return;
    }

        public static function default_card_vertical($page)
    {
        $base = __DIR__ . "/default_card_vertical/";
        $return["css"] = file_exists($base . "default_card_vertical.css.php") ? file_get_contents($base . "default_card_vertical.css.php") : "";
        $return["js"] = file_exists($base . "default_card_vertical.js.php") ? file_get_contents($base . "default_card_vertical.js.php") : "";
        $return["html"] = file_exists($base . "default_card_vertical.html.php") ? file_get_contents($base . "default_card_vertical.html.php") : "";
        return $return;
    }

        public static function hibe3_card_vertical($page)
    {
        $base = __DIR__ . "/hibe3_card_vertical/";
        $return["css"] = file_exists($base . "hibe3_card_vertical.css.php") ? file_get_contents($base . "hibe3_card_vertical.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card_vertical.js.php") ? file_get_contents($base . "hibe3_card_vertical.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card_vertical.html.php") ? file_get_contents($base . "hibe3_card_vertical.html.php") : "";
        return $return;
    }

        public static function ilanding_footer($page)
    {
        $base = __DIR__ . "/ilanding_footer/";
        $return["css"] = file_exists($base . "ilanding_footer.css.php") ? file_get_contents($base . "ilanding_footer.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_footer.js.php") ? file_get_contents($base . "ilanding_footer.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_footer.html.php") ? file_get_contents($base . "ilanding_footer.html.php") : "";
        return $return;
    }

        public static function ilanding_contact($page)
    {
        $base = __DIR__ . "/ilanding_contact/";
        $return["css"] = file_exists($base . "ilanding_contact.css.php") ? file_get_contents($base . "ilanding_contact.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_contact.js.php") ? file_get_contents($base . "ilanding_contact.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_contact.html.php") ? file_get_contents($base . "ilanding_contact.html.php") : "";
        return $return;
    }

        public static function ilanding_cta2($page)
    {
        $base = __DIR__ . "/ilanding_cta2/";
        $return["css"] = file_exists($base . "ilanding_cta2.css.php") ? file_get_contents($base . "ilanding_cta2.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_cta2.js.php") ? file_get_contents($base . "ilanding_cta2.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_cta2.html.php") ? file_get_contents($base . "ilanding_cta2.html.php") : "";
        return $return;
    }

        public static function ilanding_faq($page)
    {
        $base = __DIR__ . "/ilanding_faq/";
        $return["css"] = file_exists($base . "ilanding_faq.css.php") ? file_get_contents($base . "ilanding_faq.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_faq.js.php") ? file_get_contents($base . "ilanding_faq.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_faq.html.php") ? file_get_contents($base . "ilanding_faq.html.php") : "";
        return $return;
    }

        public static function ilanding_pricing($page)
    {
        $base = __DIR__ . "/ilanding_pricing/";
        $return["css"] = file_exists($base . "ilanding_pricing.css.php") ? file_get_contents($base . "ilanding_pricing.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_pricing.js.php") ? file_get_contents($base . "ilanding_pricing.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_pricing.html.php") ? file_get_contents($base . "ilanding_pricing.html.php") : "";
        return $return;
    }

        public static function ilanding_service($page)
    {
        $base = __DIR__ . "/ilanding_service/";
        $return["css"] = file_exists($base . "ilanding_service.css.php") ? file_get_contents($base . "ilanding_service.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_service.js.php") ? file_get_contents($base . "ilanding_service.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_service.html.php") ? file_get_contents($base . "ilanding_service.html.php") : "";
        return $return;
    }

        public static function ilanding_stat($page)
    {
        $base = __DIR__ . "/ilanding_stat/";
        $return["css"] = file_exists($base . "ilanding_stat.css.php") ? file_get_contents($base . "ilanding_stat.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_stat.js.php") ? file_get_contents($base . "ilanding_stat.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_stat.html.php") ? file_get_contents($base . "ilanding_stat.html.php") : "";
        return $return;
    }

        public static function ilanding_testimonial($page)
    {
        $base = __DIR__ . "/ilanding_testimonial/";
        $return["css"] = file_exists($base . "ilanding_testimonial.css.php") ? file_get_contents($base . "ilanding_testimonial.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_testimonial.js.php") ? file_get_contents($base . "ilanding_testimonial.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_testimonial.html.php") ? file_get_contents($base . "ilanding_testimonial.html.php") : "";
        return $return;
    }

        public static function ilanding_clients($page)
    {
        $base = __DIR__ . "/ilanding_clients/";
        $return["css"] = file_exists($base . "ilanding_clients.css.php") ? file_get_contents($base . "ilanding_clients.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_clients.js.php") ? file_get_contents($base . "ilanding_clients.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_clients.html.php") ? file_get_contents($base . "ilanding_clients.html.php") : "";
        return $return;
    }

        public static function ilanding_features_center($page)
    {
        $base = __DIR__ . "/ilanding_features_center/";
        $return["css"] = file_exists($base . "ilanding_features_center.css.php") ? file_get_contents($base . "ilanding_features_center.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_features_center.js.php") ? file_get_contents($base . "ilanding_features_center.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_features_center.html.php") ? file_get_contents($base . "ilanding_features_center.html.php") : "";
        return $return;
    }

        public static function ilanding_cta($page)
    {
        $base = __DIR__ . "/ilanding_cta/";
        $return["css"] = file_exists($base . "ilanding_cta.css.php") ? file_get_contents($base . "ilanding_cta.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_cta.js.php") ? file_get_contents($base . "ilanding_cta.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_cta.html.php") ? file_get_contents($base . "ilanding_cta.html.php") : "";
        return $return;
    }

        public static function ilanding_features_card($page)
    {
        $base = __DIR__ . "/ilanding_features_card/";
        $return["css"] = file_exists($base . "ilanding_features_card.css.php") ? file_get_contents($base . "ilanding_features_card.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_features_card.js.php") ? file_get_contents($base . "ilanding_features_card.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_features_card.html.php") ? file_get_contents($base . "ilanding_features_card.html.php") : "";
        return $return;
    }

        public static function ilanding_features($page)
    {
        $base = __DIR__ . "/ilanding_features/";
        $return["css"] = file_exists($base . "ilanding_features.css.php") ? file_get_contents($base . "ilanding_features.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_features.js.php") ? file_get_contents($base . "ilanding_features.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_features.html.php") ? file_get_contents($base . "ilanding_features.html.php") : "";
        return $return;
    }

        public static function ilanding_home_about($page)
    {
        $base = __DIR__ . "/ilanding_home_about/";
        $return["css"] = file_exists($base . "ilanding_home_about.css.php") ? file_get_contents($base . "ilanding_home_about.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_home_about.js.php") ? file_get_contents($base . "ilanding_home_about.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_home_about.html.php") ? file_get_contents($base . "ilanding_home_about.html.php") : "";
        return $return;
    }

        public static function ilanding_home_hero($page)
    {
        $base = __DIR__ . "/ilanding_home_hero/";
        $return["css"] = file_exists($base . "ilanding_home_hero.css.php") ? file_get_contents($base . "ilanding_home_hero.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_home_hero.js.php") ? file_get_contents($base . "ilanding_home_hero.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_home_hero.html.php") ? file_get_contents($base . "ilanding_home_hero.html.php") : "";
        return $return;
    }

        public static function ilanding_header($page)
    {
        $base = __DIR__ . "/ilanding_header/";
        $return["css"] = file_exists($base . "ilanding_header.css.php") ? file_get_contents($base . "ilanding_header.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_header.js.php") ? file_get_contents($base . "ilanding_header.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_header.html.php") ? file_get_contents($base . "ilanding_header.html.php") : "";
        return $return;
    }

        public static function ilanding_base($page)
    {
        $base = __DIR__ . "/ilanding_base/";
        $return["css"] = file_exists($base . "ilanding_base.css.php") ? file_get_contents($base . "ilanding_base.css.php") : "";
        $return["js"] = file_exists($base . "ilanding_base.js.php") ? file_get_contents($base . "ilanding_base.js.php") : "";
        $return["html"] = file_exists($base . "ilanding_base.html.php") ? file_get_contents($base . "ilanding_base.html.php") : "";
        return $return;
    }

        public static function beegrit_kirim_ke($page)
    {
        $base = __DIR__ . "/beegrit_kirim_ke/";
        $return["css"] = file_exists($base . "beegrit_kirim_ke.css.php") ? file_get_contents($base . "beegrit_kirim_ke.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_kirim_ke.js.php") ? file_get_contents($base . "beegrit_kirim_ke.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_kirim_ke.html.php") ? file_get_contents($base . "beegrit_kirim_ke.html.php") : "";
        return $return;
    }

        public static function load_json($page, $function, $type, $row_json, $template)
    {
        $base = __DIR__ . "/load_json/";
        $return["css"] = file_exists($base . "load_json.css.php") ? file_get_contents($base . "load_json.css.php") : "";
        $return["js"] = file_exists($base . "load_json.js.php") ? file_get_contents($base . "load_json.js.php") : "";
        $return["html"] = file_exists($base . "load_json.html.php") ? file_get_contents($base . "load_json.html.php") : "";
        return $return;
    }

        public static function system_pesanan_list_add_produk($page)
    {
        $base = __DIR__ . "/system_pesanan_list_add_produk/";
        $return["css"] = file_exists($base . "system_pesanan_list_add_produk.css.php") ? file_get_contents($base . "system_pesanan_list_add_produk.css.php") : "";
        $return["js"] = file_exists($base . "system_pesanan_list_add_produk.js.php") ? file_get_contents($base . "system_pesanan_list_add_produk.js.php") : "";
        $return["html"] = file_exists($base . "system_pesanan_list_add_produk.html.php") ? file_get_contents($base . "system_pesanan_list_add_produk.html.php") : "";
        return $return;
    }

        public static function system_pesanan($page)
    {
        $base = __DIR__ . "/system_pesanan/";
        $return["css"] = file_exists($base . "system_pesanan.css.php") ? file_get_contents($base . "system_pesanan.css.php") : "";
        $return["js"] = file_exists($base . "system_pesanan.js.php") ? file_get_contents($base . "system_pesanan.js.php") : "";
        $return["html"] = file_exists($base . "system_pesanan.html.php") ? file_get_contents($base . "system_pesanan.html.php") : "";
        return $return;
    }

        public static function system_produk($page)
    {
        $base = __DIR__ . "/system_produk/";
        $return["css"] = file_exists($base . "system_produk.css.php") ? file_get_contents($base . "system_produk.css.php") : "";
        $return["js"] = file_exists($base . "system_produk.js.php") ? file_get_contents($base . "system_produk.js.php") : "";
        $return["html"] = file_exists($base . "system_produk.html.php") ? file_get_contents($base . "system_produk.html.php") : "";
        return $return;
    }

        public static function malefashion_home_diskon($page)
    {
        $base = __DIR__ . "/malefashion_home_diskon/";
        $return["css"] = file_exists($base . "malefashion_home_diskon.css.php") ? file_get_contents($base . "malefashion_home_diskon.css.php") : "";
        $return["js"] = file_exists($base . "malefashion_home_diskon.js.php") ? file_get_contents($base . "malefashion_home_diskon.js.php") : "";
        $return["html"] = file_exists($base . "malefashion_home_diskon.html.php") ? file_get_contents($base . "malefashion_home_diskon.html.php") : "";
        return $return;
    }

        public static function foodmart_header($page)
    {
        $base = __DIR__ . "/foodmart_header/";
        $return["css"] = file_exists($base . "foodmart_header.css.php") ? file_get_contents($base . "foodmart_header.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_header.js.php") ? file_get_contents($base . "foodmart_header.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_header.html.php") ? file_get_contents($base . "foodmart_header.html.php") : "";
        return $return;
    }

        public static function foodmart_menu_dropdown($page)
    {
        $base = __DIR__ . "/foodmart_menu_dropdown/";
        $return["css"] = file_exists($base . "foodmart_menu_dropdown.css.php") ? file_get_contents($base . "foodmart_menu_dropdown.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_menu_dropdown.js.php") ? file_get_contents($base . "foodmart_menu_dropdown.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_menu_dropdown.html.php") ? file_get_contents($base . "foodmart_menu_dropdown.html.php") : "";
        return $return;
    }

        public static function foodmart_menu_configuration($page)
    {
        $base = __DIR__ . "/foodmart_menu_configuration/";
        $return["css"] = file_exists($base . "foodmart_menu_configuration.css.php") ? file_get_contents($base . "foodmart_menu_configuration.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_menu_configuration.js.php") ? file_get_contents($base . "foodmart_menu_configuration.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_menu_configuration.html.php") ? file_get_contents($base . "foodmart_menu_configuration.html.php") : "";
        return $return;
    }

        public static function foodmart_navbar($page)
    {
        $base = __DIR__ . "/foodmart_navbar/";
        $return["css"] = file_exists($base . "foodmart_navbar.css.php") ? file_get_contents($base . "foodmart_navbar.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_navbar.js.php") ? file_get_contents($base . "foodmart_navbar.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_navbar.html.php") ? file_get_contents($base . "foodmart_navbar.html.php") : "";
        return $return;
    }

        public static function form_search_header($page)
    {
        $base = __DIR__ . "/form_search_header/";
        $return["css"] = file_exists($base . "form_search_header.css.php") ? file_get_contents($base . "form_search_header.css.php") : "";
        $return["js"] = file_exists($base . "form_search_header.js.php") ? file_get_contents($base . "form_search_header.js.php") : "";
        $return["html"] = file_exists($base . "form_search_header.html.php") ? file_get_contents($base . "form_search_header.html.php") : "";
        return $return;
    }

        public static function foodmart_search($page)
    {
        $base = __DIR__ . "/foodmart_search/";
        $return["css"] = file_exists($base . "foodmart_search.css.php") ? file_get_contents($base . "foodmart_search.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_search.js.php") ? file_get_contents($base . "foodmart_search.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_search.html.php") ? file_get_contents($base . "foodmart_search.html.php") : "";
        return $return;
    }

        public static function foodmart_base($page)
    {
        $base = __DIR__ . "/foodmart_base/";
        $return["css"] = file_exists($base . "foodmart_base.css.php") ? file_get_contents($base . "foodmart_base.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_base.js.php") ? file_get_contents($base . "foodmart_base.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_base.html.php") ? file_get_contents($base . "foodmart_base.html.php") : "";
        return $return;
    }

        public static function foodmart_card_vertical($page)
    {
        $base = __DIR__ . "/foodmart_card_vertical/";
        $return["css"] = file_exists($base . "foodmart_card_vertical.css.php") ? file_get_contents($base . "foodmart_card_vertical.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_card_vertical.js.php") ? file_get_contents($base . "foodmart_card_vertical.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_card_vertical.html.php") ? file_get_contents($base . "foodmart_card_vertical.html.php") : "";
        return $return;
    }

        public static function soft_ui_card_main_listing($page)
    {
        $base = __DIR__ . "/soft_ui_card_main_listing/";
        $return["css"] = file_exists($base . "soft_ui_card_main_listing.css.php") ? file_get_contents($base . "soft_ui_card_main_listing.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui_card_main_listing.js.php") ? file_get_contents($base . "soft_ui_card_main_listing.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui_card_main_listing.html.php") ? file_get_contents($base . "soft_ui_card_main_listing.html.php") : "";
        return $return;
    }

        public static function codepen_portfolio_webpage_example_timeline_item($page)
    {
        $base = __DIR__ . "/codepen_portfolio_webpage_example_timeline_item/";
        $return["css"] = file_exists($base . "codepen_portfolio_webpage_example_timeline_item.css.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.css.php") : "";
        $return["js"] = file_exists($base . "codepen_portfolio_webpage_example_timeline_item.js.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.js.php") : "";
        $return["html"] = file_exists($base . "codepen_portfolio_webpage_example_timeline_item.html.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.html.php") : "";
        return $return;
    }

        public static function codepen_portfolio_webpage_example_timeline($page)
    {
        $base = __DIR__ . "/codepen_portfolio_webpage_example_timeline/";
        $return["css"] = file_exists($base . "codepen_portfolio_webpage_example_timeline.css.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline.css.php") : "";
        $return["js"] = file_exists($base . "codepen_portfolio_webpage_example_timeline.js.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline.js.php") : "";
        $return["html"] = file_exists($base . "codepen_portfolio_webpage_example_timeline.html.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_timeline.html.php") : "";
        return $return;
    }

        public static function codepen_portfolio_webpage_example_service_list($page)
    {
        $base = __DIR__ . "/codepen_portfolio_webpage_example_service_list/";
        $return["css"] = file_exists($base . "codepen_portfolio_webpage_example_service_list.css.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_service_list.css.php") : "";
        $return["js"] = file_exists($base . "codepen_portfolio_webpage_example_service_list.js.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_service_list.js.php") : "";
        $return["html"] = file_exists($base . "codepen_portfolio_webpage_example_service_list.html.php") ? file_get_contents($base . "codepen_portfolio_webpage_example_service_list.html.php") : "";
        return $return;
    }

        public static function codepen_portfolio_webpage_example($page)
    {
        $base = __DIR__ . "/codepen_portfolio_webpage_example/";
        $return["css"] = file_exists($base . "codepen_portfolio_webpage_example.css.php") ? file_get_contents($base . "codepen_portfolio_webpage_example.css.php") : "";
        $return["js"] = file_exists($base . "codepen_portfolio_webpage_example.js.php") ? file_get_contents($base . "codepen_portfolio_webpage_example.js.php") : "";
        $return["html"] = file_exists($base . "codepen_portfolio_webpage_example.html.php") ? file_get_contents($base . "codepen_portfolio_webpage_example.html.php") : "";
        return $return;
    }

        public static function sneat_sidebar($page)
    {
        $base = __DIR__ . "/sneat_sidebar/";
        $return["css"] = file_exists($base . "sneat_sidebar.css.php") ? file_get_contents($base . "sneat_sidebar.css.php") : "";
        $return["js"] = file_exists($base . "sneat_sidebar.js.php") ? file_get_contents($base . "sneat_sidebar.js.php") : "";
        $return["html"] = file_exists($base . "sneat_sidebar.html.php") ? file_get_contents($base . "sneat_sidebar.html.php") : "";
        return $return;
    }

        public static function sneat_base($page)
    {
        $base = __DIR__ . "/sneat_base/";
        $return["css"] = file_exists($base . "sneat_base.css.php") ? file_get_contents($base . "sneat_base.css.php") : "";
        $return["js"] = file_exists($base . "sneat_base.js.php") ? file_get_contents($base . "sneat_base.js.php") : "";
        $return["html"] = file_exists($base . "sneat_base.html.php") ? file_get_contents($base . "sneat_base.html.php") : "";
        return $return;
    }

        public static function profil_dropdown($page)
    {
        $base = __DIR__ . "/profil_dropdown/";
        $return["css"] = file_exists($base . "profil_dropdown.css.php") ? file_get_contents($base . "profil_dropdown.css.php") : "";
        $return["js"] = file_exists($base . "profil_dropdown.js.php") ? file_get_contents($base . "profil_dropdown.js.php") : "";
        $return["html"] = file_exists($base . "profil_dropdown.html.php") ? file_get_contents($base . "profil_dropdown.html.php") : "";
        return $return;
    }

        public static function ashion_ecomerce_checkout($page)
    {
        $base = __DIR__ . "/ashion_ecomerce_checkout/";
        $return["css"] = file_exists($base . "ashion_ecomerce_checkout.css.php") ? file_get_contents($base . "ashion_ecomerce_checkout.css.php") : "";
        $return["js"] = file_exists($base . "ashion_ecomerce_checkout.js.php") ? file_get_contents($base . "ashion_ecomerce_checkout.js.php") : "";
        $return["html"] = file_exists($base . "ashion_ecomerce_checkout.html.php") ? file_get_contents($base . "ashion_ecomerce_checkout.html.php") : "";
        return $return;
    }

        public static function ashion_ecomerce_cart_produk($page)
    {
        $base = __DIR__ . "/ashion_ecomerce_cart_produk/";
        $return["css"] = file_exists($base . "ashion_ecomerce_cart_produk.css.php") ? file_get_contents($base . "ashion_ecomerce_cart_produk.css.php") : "";
        $return["js"] = file_exists($base . "ashion_ecomerce_cart_produk.js.php") ? file_get_contents($base . "ashion_ecomerce_cart_produk.js.php") : "";
        $return["html"] = file_exists($base . "ashion_ecomerce_cart_produk.html.php") ? file_get_contents($base . "ashion_ecomerce_cart_produk.html.php") : "";
        return $return;
    }

        public static function ashion_ecomerce_cart($page)
    {
        $base = __DIR__ . "/ashion_ecomerce_cart/";
        $return["css"] = file_exists($base . "ashion_ecomerce_cart.css.php") ? file_get_contents($base . "ashion_ecomerce_cart.css.php") : "";
        $return["js"] = file_exists($base . "ashion_ecomerce_cart.js.php") ? file_get_contents($base . "ashion_ecomerce_cart.js.php") : "";
        $return["html"] = file_exists($base . "ashion_ecomerce_cart.html.php") ? file_get_contents($base . "ashion_ecomerce_cart.html.php") : "";
        return $return;
    }

        public static function beegrit_ecomerce_cart_toko($page)
    {
        $base = __DIR__ . "/beegrit_ecomerce_cart_toko/";
        $return["css"] = file_exists($base . "beegrit_ecomerce_cart_toko.css.php") ? file_get_contents($base . "beegrit_ecomerce_cart_toko.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecomerce_cart_toko.js.php") ? file_get_contents($base . "beegrit_ecomerce_cart_toko.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecomerce_cart_toko.html.php") ? file_get_contents($base . "beegrit_ecomerce_cart_toko.html.php") : "";
        return $return;
    }

        public static function foodmart_ecomerce_cart_produk($page)
    {
        $base = __DIR__ . "/foodmart_ecomerce_cart_produk/";
        $return["css"] = file_exists($base . "foodmart_ecomerce_cart_produk.css.php") ? file_get_contents($base . "foodmart_ecomerce_cart_produk.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_ecomerce_cart_produk.js.php") ? file_get_contents($base . "foodmart_ecomerce_cart_produk.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_ecomerce_cart_produk.html.php") ? file_get_contents($base . "foodmart_ecomerce_cart_produk.html.php") : "";
        return $return;
    }

        public static function foodmart_ecomerce_cart($page)
    {
        $base = __DIR__ . "/foodmart_ecomerce_cart/";
        $return["css"] = file_exists($base . "foodmart_ecomerce_cart.css.php") ? file_get_contents($base . "foodmart_ecomerce_cart.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_ecomerce_cart.js.php") ? file_get_contents($base . "foodmart_ecomerce_cart.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_ecomerce_cart.html.php") ? file_get_contents($base . "foodmart_ecomerce_cart.html.php") : "";
        return $return;
    }

        public static function detailing_data($page)
    {
        $base = __DIR__ . "/detailing_data/";
        $return["css"] = file_exists($base . "detailing_data.css.php") ? file_get_contents($base . "detailing_data.css.php") : "";
        $return["js"] = file_exists($base . "detailing_data.js.php") ? file_get_contents($base . "detailing_data.js.php") : "";
        $return["html"] = file_exists($base . "detailing_data.html.php") ? file_get_contents($base . "detailing_data.html.php") : "";
        return $return;
    }

        public static function ashion_card_main_listing($page)
    {
        $base = __DIR__ . "/ashion_card_main_listing/";
        $return["css"] = file_exists($base . "ashion_card_main_listing.css.php") ? file_get_contents($base . "ashion_card_main_listing.css.php") : "";
        $return["js"] = file_exists($base . "ashion_card_main_listing.js.php") ? file_get_contents($base . "ashion_card_main_listing.js.php") : "";
        $return["html"] = file_exists($base . "ashion_card_main_listing.html.php") ? file_get_contents($base . "ashion_card_main_listing.html.php") : "";
        return $return;
    }

        public static function swipper_slider_centered($page)
    {
        $base = __DIR__ . "/swipper_slider_centered/";
        $return["css"] = file_exists($base . "swipper_slider_centered.css.php") ? file_get_contents($base . "swipper_slider_centered.css.php") : "";
        $return["js"] = file_exists($base . "swipper_slider_centered.js.php") ? file_get_contents($base . "swipper_slider_centered.js.php") : "";
        $return["html"] = file_exists($base . "swipper_slider_centered.html.php") ? file_get_contents($base . "swipper_slider_centered.html.php") : "";
        return $return;
    }

        public static function ashion_home_profil($page)
    {
        $base = __DIR__ . "/ashion_home_profil/";
        $return["css"] = file_exists($base . "ashion_home_profil.css.php") ? file_get_contents($base . "ashion_home_profil.css.php") : "";
        $return["js"] = file_exists($base . "ashion_home_profil.js.php") ? file_get_contents($base . "ashion_home_profil.js.php") : "";
        $return["html"] = file_exists($base . "ashion_home_profil.html.php") ? file_get_contents($base . "ashion_home_profil.html.php") : "";
        return $return;
    }

        public static function ashion_contact_us($page)
    {
        $base = __DIR__ . "/ashion_contact_us/";
        $return["css"] = file_exists($base . "ashion_contact_us.css.php") ? file_get_contents($base . "ashion_contact_us.css.php") : "";
        $return["js"] = file_exists($base . "ashion_contact_us.js.php") ? file_get_contents($base . "ashion_contact_us.js.php") : "";
        $return["html"] = file_exists($base . "ashion_contact_us.html.php") ? file_get_contents($base . "ashion_contact_us.html.php") : "";
        return $return;
    }

        public static function ashion_card_vertical($page)
    {
        $base = __DIR__ . "/ashion_card_vertical/";
        $return["css"] = file_exists($base . "ashion_card_vertical.css.php") ? file_get_contents($base . "ashion_card_vertical.css.php") : "";
        $return["js"] = file_exists($base . "ashion_card_vertical.js.php") ? file_get_contents($base . "ashion_card_vertical.js.php") : "";
        $return["html"] = file_exists($base . "ashion_card_vertical.html.php") ? file_get_contents($base . "ashion_card_vertical.html.php") : "";
        return $return;
    }

        public static function ashion_home_produk_group_klasifikasi($page)
    {
        $base = __DIR__ . "/ashion_home_produk_group_klasifikasi/";
        $return["css"] = file_exists($base . "ashion_home_produk_group_klasifikasi.css.php") ? file_get_contents($base . "ashion_home_produk_group_klasifikasi.css.php") : "";
        $return["js"] = file_exists($base . "ashion_home_produk_group_klasifikasi.js.php") ? file_get_contents($base . "ashion_home_produk_group_klasifikasi.js.php") : "";
        $return["html"] = file_exists($base . "ashion_home_produk_group_klasifikasi.html.php") ? file_get_contents($base . "ashion_home_produk_group_klasifikasi.html.php") : "";
        return $return;
    }

        public static function name_webapps($page)
    {
        $base = __DIR__ . "/name_webapps/";
        $return["css"] = file_exists($base . "name_webapps.css.php") ? file_get_contents($base . "name_webapps.css.php") : "";
        $return["js"] = file_exists($base . "name_webapps.js.php") ? file_get_contents($base . "name_webapps.js.php") : "";
        $return["html"] = file_exists($base . "name_webapps.html.php") ? file_get_contents($base . "name_webapps.html.php") : "";
        return $return;
    }

        public static function base_url($page)
    {
        $base = __DIR__ . "/base_url/";
        $return["css"] = file_exists($base . "base_url.css.php") ? file_get_contents($base . "base_url.css.php") : "";
        $return["js"] = file_exists($base . "base_url.js.php") ? file_get_contents($base . "base_url.js.php") : "";
        $return["html"] = file_exists($base . "base_url.html.php") ? file_get_contents($base . "base_url.html.php") : "";
        return $return;
    }

        public static function _swipper__slide()
    {
        $base = __DIR__ . "/_swipper__slide/";
        $return["css"] = file_exists($base . "_swipper__slide.css.php") ? file_get_contents($base . "_swipper__slide.css.php") : "";
        $return["js"] = file_exists($base . "_swipper__slide.js.php") ? file_get_contents($base . "_swipper__slide.js.php") : "";
        $return["html"] = file_exists($base . "_swipper__slide.html.php") ? file_get_contents($base . "_swipper__slide.html.php") : "";
        return $return;
    }

        public static function _swipper()
    {
        $base = __DIR__ . "/_swipper/";
        $return["css"] = file_exists($base . "_swipper.css.php") ? file_get_contents($base . "_swipper.css.php") : "";
        $return["js"] = file_exists($base . "_swipper.js.php") ? file_get_contents($base . "_swipper.js.php") : "";
        $return["html"] = file_exists($base . "_swipper.html.php") ? file_get_contents($base . "_swipper.html.php") : "";
        return $return;
    }

        public static function hibe3___navbarbuttonsearch()
    {
        $base = __DIR__ . "/hibe3___navbarbuttonsearch/";
        $return["css"] = file_exists($base . "hibe3___navbarbuttonsearch.css.php") ? file_get_contents($base . "hibe3___navbarbuttonsearch.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___navbarbuttonsearch.js.php") ? file_get_contents($base . "hibe3___navbarbuttonsearch.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___navbarbuttonsearch.html.php") ? file_get_contents($base . "hibe3___navbarbuttonsearch.html.php") : "";
        return $return;
    }

        public static function hibe3___headerlist()
    {
        $base = __DIR__ . "/hibe3___headerlist/";
        $return["css"] = file_exists($base . "hibe3___headerlist.css.php") ? file_get_contents($base . "hibe3___headerlist.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___headerlist.js.php") ? file_get_contents($base . "hibe3___headerlist.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___headerlist.html.php") ? file_get_contents($base . "hibe3___headerlist.html.php") : "";
        return $return;
    }

        public static function hibe3___navbarpage()
    {
        $base = __DIR__ . "/hibe3___navbarpage/";
        $return["css"] = file_exists($base . "hibe3___navbarpage.css.php") ? file_get_contents($base . "hibe3___navbarpage.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___navbarpage.js.php") ? file_get_contents($base . "hibe3___navbarpage.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___navbarpage.html.php") ? file_get_contents($base . "hibe3___navbarpage.html.php") : "";
        return $return;
    }

        public static function hibe3___headerpage()
    {
        $base = __DIR__ . "/hibe3___headerpage/";
        $return["css"] = file_exists($base . "hibe3___headerpage.css.php") ? file_get_contents($base . "hibe3___headerpage.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___headerpage.js.php") ? file_get_contents($base . "hibe3___headerpage.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___headerpage.html.php") ? file_get_contents($base . "hibe3___headerpage.html.php") : "";
        return $return;
    }

        public static function hibe3___navbarlistprofile()
    {
        $base = __DIR__ . "/hibe3___navbarlistprofile/";
        $return["css"] = file_exists($base . "hibe3___navbarlistprofile.css.php") ? file_get_contents($base . "hibe3___navbarlistprofile.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___navbarlistprofile.js.php") ? file_get_contents($base . "hibe3___navbarlistprofile.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___navbarlistprofile.html.php") ? file_get_contents($base . "hibe3___navbarlistprofile.html.php") : "";
        return $return;
    }

        public static function hibe3___navbarnotification()
    {
        $base = __DIR__ . "/hibe3___navbarnotification/";
        $return["css"] = file_exists($base . "hibe3___navbarnotification.css.php") ? file_get_contents($base . "hibe3___navbarnotification.css.php") : "";
        $return["js"] = file_exists($base . "hibe3___navbarnotification.js.php") ? file_get_contents($base . "hibe3___navbarnotification.js.php") : "";
        $return["html"] = file_exists($base . "hibe3___navbarnotification.html.php") ? file_get_contents($base . "hibe3___navbarnotification.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce___varian_else()
    {
        $base = __DIR__ . "/beegrit_ecommerce___varian_else/";
        $return["css"] = file_exists($base . "beegrit_ecommerce___varian_else.css.php") ? file_get_contents($base . "beegrit_ecommerce___varian_else.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce___varian_else.js.php") ? file_get_contents($base . "beegrit_ecommerce___varian_else.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce___varian_else.html.php") ? file_get_contents($base . "beegrit_ecommerce___varian_else.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_detail()
    {
        $base = __DIR__ . "/beegrit_ecommerce_detail/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_detail.css.php") ? file_get_contents($base . "beegrit_ecommerce_detail.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_detail.js.php") ? file_get_contents($base . "beegrit_ecommerce_detail.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_detail.html.php") ? file_get_contents($base . "beegrit_ecommerce_detail.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_varian()
    {
        $base = __DIR__ . "/beegrit_ecommerce_varian/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_varian.css.php") ? file_get_contents($base . "beegrit_ecommerce_varian.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_varian.js.php") ? file_get_contents($base . "beegrit_ecommerce_varian.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_varian.html.php") ? file_get_contents($base . "beegrit_ecommerce_varian.html.php") : "";
        return $return;
    }

        public static function beegrit_img_tumb___detail_ecommerce()
    {
        $base = __DIR__ . "/beegrit_img_tumb___detail_ecommerce/";
        $return["css"] = file_exists($base . "beegrit_img_tumb___detail_ecommerce.css.php") ? file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_img_tumb___detail_ecommerce.js.php") ? file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_img_tumb___detail_ecommerce.html.php") ? file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.html.php") : "";
        return $return;
    }

        public static function beegrit_detail_spesifikasi()
    {
        $base = __DIR__ . "/beegrit_detail_spesifikasi/";
        $return["css"] = file_exists($base . "beegrit_detail_spesifikasi.css.php") ? file_get_contents($base . "beegrit_detail_spesifikasi.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_detail_spesifikasi.js.php") ? file_get_contents($base . "beegrit_detail_spesifikasi.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_detail_spesifikasi.html.php") ? file_get_contents($base . "beegrit_detail_spesifikasi.html.php") : "";
        return $return;
    }

        public static function beegrit_img_sampul()
    {
        $base = __DIR__ . "/beegrit_img_sampul/";
        $return["css"] = file_exists($base . "beegrit_img_sampul.css.php") ? file_get_contents($base . "beegrit_img_sampul.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_img_sampul.js.php") ? file_get_contents($base . "beegrit_img_sampul.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_img_sampul.html.php") ? file_get_contents($base . "beegrit_img_sampul.html.php") : "";
        return $return;
    }

        public static function beegrit_ecomerce___varian_warna()
    {
        $base = __DIR__ . "/beegrit_ecomerce___varian_warna/";
        $return["css"] = file_exists($base . "beegrit_ecomerce___varian_warna.css.php") ? file_get_contents($base . "beegrit_ecomerce___varian_warna.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecomerce___varian_warna.js.php") ? file_get_contents($base . "beegrit_ecomerce___varian_warna.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecomerce___varian_warna.html.php") ? file_get_contents($base . "beegrit_ecomerce___varian_warna.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce___varian_size()
    {
        $base = __DIR__ . "/beegrit_ecommerce___varian_size/";
        $return["css"] = file_exists($base . "beegrit_ecommerce___varian_size.css.php") ? file_get_contents($base . "beegrit_ecommerce___varian_size.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce___varian_size.js.php") ? file_get_contents($base . "beegrit_ecommerce___varian_size.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce___varian_size.html.php") ? file_get_contents($base . "beegrit_ecommerce___varian_size.html.php") : "";
        return $return;
    }

        public static function ashion___navbar()
    {
        $base = __DIR__ . "/ashion___navbar/";
        $return["css"] = file_exists($base . "ashion___navbar.css.php") ? file_get_contents($base . "ashion___navbar.css.php") : "";
        $return["js"] = file_exists($base . "ashion___navbar.js.php") ? file_get_contents($base . "ashion___navbar.js.php") : "";
        $return["html"] = file_exists($base . "ashion___navbar.html.php") ? file_get_contents($base . "ashion___navbar.html.php") : "";
        return $return;
    }

        public static function ashion___banner()
    {
        $base = __DIR__ . "/ashion___banner/";
        $return["css"] = file_exists($base . "ashion___banner.css.php") ? file_get_contents($base . "ashion___banner.css.php") : "";
        $return["js"] = file_exists($base . "ashion___banner.js.php") ? file_get_contents($base . "ashion___banner.js.php") : "";
        $return["html"] = file_exists($base . "ashion___banner.html.php") ? file_get_contents($base . "ashion___banner.html.php") : "";
        return $return;
    }

        public static function ashion___banner___list()
    {
        $base = __DIR__ . "/ashion___banner___list/";
        $return["css"] = file_exists($base . "ashion___banner___list.css.php") ? file_get_contents($base . "ashion___banner___list.css.php") : "";
        $return["js"] = file_exists($base . "ashion___banner___list.js.php") ? file_get_contents($base . "ashion___banner___list.js.php") : "";
        $return["html"] = file_exists($base . "ashion___banner___list.html.php") ? file_get_contents($base . "ashion___banner___list.html.php") : "";
        return $return;
    }

        public static function ashion___header_logo()
    {
        $base = __DIR__ . "/ashion___header_logo/";
        $return["css"] = file_exists($base . "ashion___header_logo.css.php") ? file_get_contents($base . "ashion___header_logo.css.php") : "";
        $return["js"] = file_exists($base . "ashion___header_logo.js.php") ? file_get_contents($base . "ashion___header_logo.js.php") : "";
        $return["html"] = file_exists($base . "ashion___header_logo.html.php") ? file_get_contents($base . "ashion___header_logo.html.php") : "";
        return $return;
    }

        public static function ashion_asion___icon_cart()
    {
        $base = __DIR__ . "/ashion_asion___icon_cart/";
        $return["css"] = file_exists($base . "ashion_asion___icon_cart.css.php") ? file_get_contents($base . "ashion_asion___icon_cart.css.php") : "";
        $return["js"] = file_exists($base . "ashion_asion___icon_cart.js.php") ? file_get_contents($base . "ashion_asion___icon_cart.js.php") : "";
        $return["html"] = file_exists($base . "ashion_asion___icon_cart.html.php") ? file_get_contents($base . "ashion_asion___icon_cart.html.php") : "";
        return $return;
    }

        public static function ashion_checkout()
    {
        $base = __DIR__ . "/ashion_checkout/";
        $return["css"] = file_exists($base . "ashion_checkout.css.php") ? file_get_contents($base . "ashion_checkout.css.php") : "";
        $return["js"] = file_exists($base . "ashion_checkout.js.php") ? file_get_contents($base . "ashion_checkout.js.php") : "";
        $return["html"] = file_exists($base . "ashion_checkout.html.php") ? file_get_contents($base . "ashion_checkout.html.php") : "";
        return $return;
    }

        public static function ashion___button_search()
    {
        $base = __DIR__ . "/ashion___button_search/";
        $return["css"] = file_exists($base . "ashion___button_search.css.php") ? file_get_contents($base . "ashion___button_search.css.php") : "";
        $return["js"] = file_exists($base . "ashion___button_search.js.php") ? file_get_contents($base . "ashion___button_search.js.php") : "";
        $return["html"] = file_exists($base . "ashion___button_search.html.php") ? file_get_contents($base . "ashion___button_search.html.php") : "";
        return $return;
    }

        public static function ashion___banner___utama()
    {
        $base = __DIR__ . "/ashion___banner___utama/";
        $return["css"] = file_exists($base . "ashion___banner___utama.css.php") ? file_get_contents($base . "ashion___banner___utama.css.php") : "";
        $return["js"] = file_exists($base . "ashion___banner___utama.js.php") ? file_get_contents($base . "ashion___banner___utama.js.php") : "";
        $return["html"] = file_exists($base . "ashion___banner___utama.html.php") ? file_get_contents($base . "ashion___banner___utama.html.php") : "";
        return $return;
    }

        public static function ashion_asion___list_ecommerce()
    {
        $base = __DIR__ . "/ashion_asion___list_ecommerce/";
        $return["css"] = file_exists($base . "ashion_asion___list_ecommerce.css.php") ? file_get_contents($base . "ashion_asion___list_ecommerce.css.php") : "";
        $return["js"] = file_exists($base . "ashion_asion___list_ecommerce.js.php") ? file_get_contents($base . "ashion_asion___list_ecommerce.js.php") : "";
        $return["html"] = file_exists($base . "ashion_asion___list_ecommerce.html.php") ? file_get_contents($base . "ashion_asion___list_ecommerce.html.php") : "";
        return $return;
    }

        public static function ashion___card_vertical()
    {
        $base = __DIR__ . "/ashion___card_vertical/";
        $return["css"] = file_exists($base . "ashion___card_vertical.css.php") ? file_get_contents($base . "ashion___card_vertical.css.php") : "";
        $return["js"] = file_exists($base . "ashion___card_vertical.js.php") ? file_get_contents($base . "ashion___card_vertical.js.php") : "";
        $return["html"] = file_exists($base . "ashion___card_vertical.html.php") ? file_get_contents($base . "ashion___card_vertical.html.php") : "";
        return $return;
    }

        public static function ashion_produk_img()
    {
        $base = __DIR__ . "/ashion_produk_img/";
        $return["css"] = file_exists($base . "ashion_produk_img.css.php") ? file_get_contents($base . "ashion_produk_img.css.php") : "";
        $return["js"] = file_exists($base . "ashion_produk_img.js.php") ? file_get_contents($base . "ashion_produk_img.js.php") : "";
        $return["html"] = file_exists($base . "ashion_produk_img.html.php") ? file_get_contents($base . "ashion_produk_img.html.php") : "";
        return $return;
    }

        public static function ashion___icon_wishlist()
    {
        $base = __DIR__ . "/ashion___icon_wishlist/";
        $return["css"] = file_exists($base . "ashion___icon_wishlist.css.php") ? file_get_contents($base . "ashion___icon_wishlist.css.php") : "";
        $return["js"] = file_exists($base . "ashion___icon_wishlist.js.php") ? file_get_contents($base . "ashion___icon_wishlist.js.php") : "";
        $return["html"] = file_exists($base . "ashion___icon_wishlist.html.php") ? file_get_contents($base . "ashion___icon_wishlist.html.php") : "";
        return $return;
    }

        public static function ashion___cart_produk()
    {
        $base = __DIR__ . "/ashion___cart_produk/";
        $return["css"] = file_exists($base . "ashion___cart_produk.css.php") ? file_get_contents($base . "ashion___cart_produk.css.php") : "";
        $return["js"] = file_exists($base . "ashion___cart_produk.js.php") ? file_get_contents($base . "ashion___cart_produk.js.php") : "";
        $return["html"] = file_exists($base . "ashion___cart_produk.html.php") ? file_get_contents($base . "ashion___cart_produk.html.php") : "";
        return $return;
    }

        public static function ashion___cart()
    {
        $base = __DIR__ . "/ashion___cart/";
        $return["css"] = file_exists($base . "ashion___cart.css.php") ? file_get_contents($base . "ashion___cart.css.php") : "";
        $return["js"] = file_exists($base . "ashion___cart.js.php") ? file_get_contents($base . "ashion___cart.js.php") : "";
        $return["html"] = file_exists($base . "ashion___cart.html.php") ? file_get_contents($base . "ashion___cart.html.php") : "";
        return $return;
    }

        public static function ashion_detail_ecommerce()
    {
        $base = __DIR__ . "/ashion_detail_ecommerce/";
        $return["css"] = file_exists($base . "ashion_detail_ecommerce.css.php") ? file_get_contents($base . "ashion_detail_ecommerce.css.php") : "";
        $return["js"] = file_exists($base . "ashion_detail_ecommerce.js.php") ? file_get_contents($base . "ashion_detail_ecommerce.js.php") : "";
        $return["html"] = file_exists($base . "ashion_detail_ecommerce.html.php") ? file_get_contents($base . "ashion_detail_ecommerce.html.php") : "";
        return $return;
    }

        public static function ashion___navbar___menu_list()
    {
        $base = __DIR__ . "/ashion___navbar___menu_list/";
        $return["css"] = file_exists($base . "ashion___navbar___menu_list.css.php") ? file_get_contents($base . "ashion___navbar___menu_list.css.php") : "";
        $return["js"] = file_exists($base . "ashion___navbar___menu_list.js.php") ? file_get_contents($base . "ashion___navbar___menu_list.js.php") : "";
        $return["html"] = file_exists($base . "ashion___navbar___menu_list.html.php") ? file_get_contents($base . "ashion___navbar___menu_list.html.php") : "";
        return $return;
    }

        public static function ashion___navbar___button_list()
    {
        $base = __DIR__ . "/ashion___navbar___button_list/";
        $return["css"] = file_exists($base . "ashion___navbar___button_list.css.php") ? file_get_contents($base . "ashion___navbar___button_list.css.php") : "";
        $return["js"] = file_exists($base . "ashion___navbar___button_list.js.php") ? file_get_contents($base . "ashion___navbar___button_list.js.php") : "";
        $return["html"] = file_exists($base . "ashion___navbar___button_list.html.php") ? file_get_contents($base . "ashion___navbar___button_list.html.php") : "";
        return $return;
    }

        public static function sneat_ashion___profil__login()
    {
        $base = __DIR__ . "/sneat_ashion___profil__login/";
        $return["css"] = file_exists($base . "sneat_ashion___profil__login.css.php") ? file_get_contents($base . "sneat_ashion___profil__login.css.php") : "";
        $return["js"] = file_exists($base . "sneat_ashion___profil__login.js.php") ? file_get_contents($base . "sneat_ashion___profil__login.js.php") : "";
        $return["html"] = file_exists($base . "sneat_ashion___profil__login.html.php") ? file_get_contents($base . "sneat_ashion___profil__login.html.php") : "";
        return $return;
    }

        public static function sneat___sibare()
    {
        $base = __DIR__ . "/sneat___sibare/";
        $return["css"] = file_exists($base . "sneat___sibare.css.php") ? file_get_contents($base . "sneat___sibare.css.php") : "";
        $return["js"] = file_exists($base . "sneat___sibare.js.php") ? file_get_contents($base . "sneat___sibare.js.php") : "";
        $return["html"] = file_exists($base . "sneat___sibare.html.php") ? file_get_contents($base . "sneat___sibare.html.php") : "";
        return $return;
    }

        public static function foodmart_home_template()
    {
        $base = __DIR__ . "/foodmart_home_template/";
        $return["css"] = file_exists($base . "foodmart_home_template.css.php") ? file_get_contents($base . "foodmart_home_template.css.php") : "";
        $return["js"] = file_exists($base . "foodmart_home_template.js.php") ? file_get_contents($base . "foodmart_home_template.js.php") : "";
        $return["html"] = file_exists($base . "foodmart_home_template.html.php") ? file_get_contents($base . "foodmart_home_template.html.php") : "";
        return $return;
    }

        public static function adminlte_crud_list_template()
    {
        $base = __DIR__ . "/adminlte_crud_list_template/";
        $return["css"] = file_exists($base . "adminlte_crud_list_template.css.php") ? file_get_contents($base . "adminlte_crud_list_template.css.php") : "";
        $return["js"] = file_exists($base . "adminlte_crud_list_template.js.php") ? file_get_contents($base . "adminlte_crud_list_template.js.php") : "";
        $return["html"] = file_exists($base . "adminlte_crud_list_template.html.php") ? file_get_contents($base . "adminlte_crud_list_template.html.php") : "";
        return $return;
    }

        public static function adminlte_crud_vte_template()
    {
        $base = __DIR__ . "/adminlte_crud_vte_template/";
        $return["css"] = file_exists($base . "adminlte_crud_vte_template.css.php") ? file_get_contents($base . "adminlte_crud_vte_template.css.php") : "";
        $return["js"] = file_exists($base . "adminlte_crud_vte_template.js.php") ? file_get_contents($base . "adminlte_crud_vte_template.js.php") : "";
        $return["html"] = file_exists($base . "adminlte_crud_vte_template.html.php") ? file_get_contents($base . "adminlte_crud_vte_template.html.php") : "";
        return $return;
    }

        public static function ashion_viewvertical_template()
    {
        $base = __DIR__ . "/ashion_viewvertical_template/";
        $return["css"] = file_exists($base . "ashion_viewvertical_template.css.php") ? file_get_contents($base . "ashion_viewvertical_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_viewvertical_template.js.php") ? file_get_contents($base . "ashion_viewvertical_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_viewvertical_template.html.php") ? file_get_contents($base . "ashion_viewvertical_template.html.php") : "";
        return $return;
    }

        public static function ashion__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/ashion__cardmainlistingmenu_template/";
        $return["css"] = file_exists($base . "ashion__cardmainlistingmenu_template.css.php") ? file_get_contents($base . "ashion__cardmainlistingmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion__cardmainlistingmenu_template.js.php") ? file_get_contents($base . "ashion__cardmainlistingmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion__cardmainlistingmenu_template.html.php") ? file_get_contents($base . "ashion__cardmainlistingmenu_template.html.php") : "";
        return $return;
    }

        public static function ashion_footer_template()
    {
        $base = __DIR__ . "/ashion_footer_template/";
        $return["css"] = file_exists($base . "ashion_footer_template.css.php") ? file_get_contents($base . "ashion_footer_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_footer_template.js.php") ? file_get_contents($base . "ashion_footer_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_footer_template.html.php") ? file_get_contents($base . "ashion_footer_template.html.php") : "";
        return $return;
    }

        public static function ashion_home2_template()
    {
        $base = __DIR__ . "/ashion_home2_template/";
        $return["css"] = file_exists($base . "ashion_home2_template.css.php") ? file_get_contents($base . "ashion_home2_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_home2_template.js.php") ? file_get_contents($base . "ashion_home2_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_home2_template.html.php") ? file_get_contents($base . "ashion_home2_template.html.php") : "";
        return $return;
    }

        public static function ashion_home3_template()
    {
        $base = __DIR__ . "/ashion_home3_template/";
        $return["css"] = file_exists($base . "ashion_home3_template.css.php") ? file_get_contents($base . "ashion_home3_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_home3_template.js.php") ? file_get_contents($base . "ashion_home3_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_home3_template.html.php") ? file_get_contents($base . "ashion_home3_template.html.php") : "";
        return $return;
    }

        public static function ashion_img_list_template()
    {
        $base = __DIR__ . "/ashion_img_list_template/";
        $return["css"] = file_exists($base . "ashion_img_list_template.css.php") ? file_get_contents($base . "ashion_img_list_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_img_list_template.js.php") ? file_get_contents($base . "ashion_img_list_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_img_list_template.html.php") ? file_get_contents($base . "ashion_img_list_template.html.php") : "";
        return $return;
    }

        public static function ashion_img_tumb_template()
    {
        $base = __DIR__ . "/ashion_img_tumb_template/";
        $return["css"] = file_exists($base . "ashion_img_tumb_template.css.php") ? file_get_contents($base . "ashion_img_tumb_template.css.php") : "";
        $return["js"] = file_exists($base . "ashion_img_tumb_template.js.php") ? file_get_contents($base . "ashion_img_tumb_template.js.php") : "";
        $return["html"] = file_exists($base . "ashion_img_tumb_template.html.php") ? file_get_contents($base . "ashion_img_tumb_template.html.php") : "";
        return $return;
    }

        public static function beegrit_eccomercedetail_template()
    {
        $base = __DIR__ . "/beegrit_eccomercedetail_template/";
        $return["css"] = file_exists($base . "beegrit_eccomercedetail_template.css.php") ? file_get_contents($base . "beegrit_eccomercedetail_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_eccomercedetail_template.js.php") ? file_get_contents($base . "beegrit_eccomercedetail_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_eccomercedetail_template.html.php") ? file_get_contents($base . "beegrit_eccomercedetail_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habistboardcontent_template()
    {
        $base = __DIR__ . "/beegrit_habistboardcontent_template/";
        $return["css"] = file_exists($base . "beegrit_habistboardcontent_template.css.php") ? file_get_contents($base . "beegrit_habistboardcontent_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habistboardcontent_template.js.php") ? file_get_contents($base . "beegrit_habistboardcontent_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habistboardcontent_template.html.php") ? file_get_contents($base . "beegrit_habistboardcontent_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habistboardlist_template()
    {
        $base = __DIR__ . "/beegrit_habistboardlist_template/";
        $return["css"] = file_exists($base . "beegrit_habistboardlist_template.css.php") ? file_get_contents($base . "beegrit_habistboardlist_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habistboardlist_template.js.php") ? file_get_contents($base . "beegrit_habistboardlist_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habistboardlist_template.html.php") ? file_get_contents($base . "beegrit_habistboardlist_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitsboard_template()
    {
        $base = __DIR__ . "/beegrit_habitsboard_template/";
        $return["css"] = file_exists($base . "beegrit_habitsboard_template.css.php") ? file_get_contents($base . "beegrit_habitsboard_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitsboard_template.js.php") ? file_get_contents($base . "beegrit_habitsboard_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitsboard_template.html.php") ? file_get_contents($base . "beegrit_habitsboard_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitsboardcontent_template()
    {
        $base = __DIR__ . "/beegrit_habitsboardcontent_template/";
        $return["css"] = file_exists($base . "beegrit_habitsboardcontent_template.css.php") ? file_get_contents($base . "beegrit_habitsboardcontent_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitsboardcontent_template.js.php") ? file_get_contents($base . "beegrit_habitsboardcontent_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitsboardcontent_template.html.php") ? file_get_contents($base . "beegrit_habitsboardcontent_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitsboardlist_template()
    {
        $base = __DIR__ . "/beegrit_habitsboardlist_template/";
        $return["css"] = file_exists($base . "beegrit_habitsboardlist_template.css.php") ? file_get_contents($base . "beegrit_habitsboardlist_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitsboardlist_template.js.php") ? file_get_contents($base . "beegrit_habitsboardlist_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitsboardlist_template.html.php") ? file_get_contents($base . "beegrit_habitsboardlist_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitsboardlistamalan_template()
    {
        $base = __DIR__ . "/beegrit_habitsboardlistamalan_template/";
        $return["css"] = file_exists($base . "beegrit_habitsboardlistamalan_template.css.php") ? file_get_contents($base . "beegrit_habitsboardlistamalan_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitsboardlistamalan_template.js.php") ? file_get_contents($base . "beegrit_habitsboardlistamalan_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitsboardlistamalan_template.html.php") ? file_get_contents($base . "beegrit_habitsboardlistamalan_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitsboardlistanggota_template()
    {
        $base = __DIR__ . "/beegrit_habitsboardlistanggota_template/";
        $return["css"] = file_exists($base . "beegrit_habitsboardlistanggota_template.css.php") ? file_get_contents($base . "beegrit_habitsboardlistanggota_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitsboardlistanggota_template.js.php") ? file_get_contents($base . "beegrit_habitsboardlistanggota_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitsboardlistanggota_template.html.php") ? file_get_contents($base . "beegrit_habitsboardlistanggota_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitstable_template()
    {
        $base = __DIR__ . "/beegrit_habitstable_template/";
        $return["css"] = file_exists($base . "beegrit_habitstable_template.css.php") ? file_get_contents($base . "beegrit_habitstable_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitstable_template.js.php") ? file_get_contents($base . "beegrit_habitstable_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitstable_template.html.php") ? file_get_contents($base . "beegrit_habitstable_template.html.php") : "";
        return $return;
    }

        public static function beegrit_habitstableajax_template()
    {
        $base = __DIR__ . "/beegrit_habitstableajax_template/";
        $return["css"] = file_exists($base . "beegrit_habitstableajax_template.css.php") ? file_get_contents($base . "beegrit_habitstableajax_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_habitstableajax_template.js.php") ? file_get_contents($base . "beegrit_habitstableajax_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_habitstableajax_template.html.php") ? file_get_contents($base . "beegrit_habitstableajax_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_chat_template()
    {
        $base = __DIR__ . "/dashuipro_chat_template/";
        $return["css"] = file_exists($base . "dashuipro_chat_template.css.php") ? file_get_contents($base . "dashuipro_chat_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_chat_template.js.php") ? file_get_contents($base . "dashuipro_chat_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_chat_template.html.php") ? file_get_contents($base . "dashuipro_chat_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_crud_list_template()
    {
        $base = __DIR__ . "/dashuipro_crud_list_template/";
        $return["css"] = file_exists($base . "dashuipro_crud_list_template.css.php") ? file_get_contents($base . "dashuipro_crud_list_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_crud_list_template.js.php") ? file_get_contents($base . "dashuipro_crud_list_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_crud_list_template.html.php") ? file_get_contents($base . "dashuipro_crud_list_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_crud_vte_template()
    {
        $base = __DIR__ . "/dashuipro_crud_vte_template/";
        $return["css"] = file_exists($base . "dashuipro_crud_vte_template.css.php") ? file_get_contents($base . "dashuipro_crud_vte_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_crud_vte_template.js.php") ? file_get_contents($base . "dashuipro_crud_vte_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_crud_vte_template.html.php") ? file_get_contents($base . "dashuipro_crud_vte_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_ecommerce_cart_template()
    {
        $base = __DIR__ . "/dashuipro_ecommerce_cart_template/";
        $return["css"] = file_exists($base . "dashuipro_ecommerce_cart_template.css.php") ? file_get_contents($base . "dashuipro_ecommerce_cart_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_ecommerce_cart_template.js.php") ? file_get_contents($base . "dashuipro_ecommerce_cart_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_ecommerce_cart_template.html.php") ? file_get_contents($base . "dashuipro_ecommerce_cart_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_pricing_template()
    {
        $base = __DIR__ . "/dashuipro_pricing_template/";
        $return["css"] = file_exists($base . "dashuipro_pricing_template.css.php") ? file_get_contents($base . "dashuipro_pricing_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_pricing_template.js.php") ? file_get_contents($base . "dashuipro_pricing_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_pricing_template.html.php") ? file_get_contents($base . "dashuipro_pricing_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_pricingdetail_template()
    {
        $base = __DIR__ . "/dashuipro_pricingdetail_template/";
        $return["css"] = file_exists($base . "dashuipro_pricingdetail_template.css.php") ? file_get_contents($base . "dashuipro_pricingdetail_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_pricingdetail_template.js.php") ? file_get_contents($base . "dashuipro_pricingdetail_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_pricingdetail_template.html.php") ? file_get_contents($base . "dashuipro_pricingdetail_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_pricingdetail_list_template()
    {
        $base = __DIR__ . "/dashuipro_pricingdetail_list_template/";
        $return["css"] = file_exists($base . "dashuipro_pricingdetail_list_template.css.php") ? file_get_contents($base . "dashuipro_pricingdetail_list_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_pricingdetail_list_template.js.php") ? file_get_contents($base . "dashuipro_pricingdetail_list_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_pricingdetail_list_template.html.php") ? file_get_contents($base . "dashuipro_pricingdetail_list_template.html.php") : "";
        return $return;
    }

        public static function dashuipro_pricinggroup_template()
    {
        $base = __DIR__ . "/dashuipro_pricinggroup_template/";
        $return["css"] = file_exists($base . "dashuipro_pricinggroup_template.css.php") ? file_get_contents($base . "dashuipro_pricinggroup_template.css.php") : "";
        $return["js"] = file_exists($base . "dashuipro_pricinggroup_template.js.php") ? file_get_contents($base . "dashuipro_pricinggroup_template.js.php") : "";
        $return["html"] = file_exists($base . "dashuipro_pricinggroup_template.html.php") ? file_get_contents($base . "dashuipro_pricinggroup_template.html.php") : "";
        return $return;
    }

        public static function esios_crud_list_template()
    {
        $base = __DIR__ . "/esios_crud_list_template/";
        $return["css"] = file_exists($base . "esios_crud_list_template.css.php") ? file_get_contents($base . "esios_crud_list_template.css.php") : "";
        $return["js"] = file_exists($base . "esios_crud_list_template.js.php") ? file_get_contents($base . "esios_crud_list_template.js.php") : "";
        $return["html"] = file_exists($base . "esios_crud_list_template.html.php") ? file_get_contents($base . "esios_crud_list_template.html.php") : "";
        return $return;
    }

        public static function esios_crud_vte_template()
    {
        $base = __DIR__ . "/esios_crud_vte_template/";
        $return["css"] = file_exists($base . "esios_crud_vte_template.css.php") ? file_get_contents($base . "esios_crud_vte_template.css.php") : "";
        $return["js"] = file_exists($base . "esios_crud_vte_template.js.php") ? file_get_contents($base . "esios_crud_vte_template.js.php") : "";
        $return["html"] = file_exists($base . "esios_crud_vte_template.html.php") ? file_get_contents($base . "esios_crud_vte_template.html.php") : "";
        return $return;
    }

        public static function finapp_dashboard_card_footer_item_template()
    {
        $base = __DIR__ . "/finapp_dashboard_card_footer_item_template/";
        $return["css"] = file_exists($base . "finapp_dashboard_card_footer_item_template.css.php") ? file_get_contents($base . "finapp_dashboard_card_footer_item_template.css.php") : "";
        $return["js"] = file_exists($base . "finapp_dashboard_card_footer_item_template.js.php") ? file_get_contents($base . "finapp_dashboard_card_footer_item_template.js.php") : "";
        $return["html"] = file_exists($base . "finapp_dashboard_card_footer_item_template.html.php") ? file_get_contents($base . "finapp_dashboard_card_footer_item_template.html.php") : "";
        return $return;
    }

        public static function finapp_dashboard_card_template()
    {
        $base = __DIR__ . "/finapp_dashboard_card_template/";
        $return["css"] = file_exists($base . "finapp_dashboard_card_template.css.php") ? file_get_contents($base . "finapp_dashboard_card_template.css.php") : "";
        $return["js"] = file_exists($base . "finapp_dashboard_card_template.js.php") ? file_get_contents($base . "finapp_dashboard_card_template.js.php") : "";
        $return["html"] = file_exists($base . "finapp_dashboard_card_template.html.php") ? file_get_contents($base . "finapp_dashboard_card_template.html.php") : "";
        return $return;
    }

        public static function hibe3_chat_template()
    {
        $base = __DIR__ . "/hibe3_chat_template/";
        $return["css"] = file_exists($base . "hibe3_chat_template.css.php") ? file_get_contents($base . "hibe3_chat_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_chat_template.js.php") ? file_get_contents($base . "hibe3_chat_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_chat_template.html.php") ? file_get_contents($base . "hibe3_chat_template.html.php") : "";
        return $return;
    }

        public static function hibe3_headerlist_template()
    {
        $base = __DIR__ . "/hibe3_headerlist_template/";
        $return["css"] = file_exists($base . "hibe3_headerlist_template.css.php") ? file_get_contents($base . "hibe3_headerlist_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_headerlist_template.js.php") ? file_get_contents($base . "hibe3_headerlist_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_headerlist_template.html.php") ? file_get_contents($base . "hibe3_headerlist_template.html.php") : "";
        return $return;
    }

        public static function hibe3_headerlistleft_template()
    {
        $base = __DIR__ . "/hibe3_headerlistleft_template/";
        $return["css"] = file_exists($base . "hibe3_headerlistleft_template.css.php") ? file_get_contents($base . "hibe3_headerlistleft_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_headerlistleft_template.js.php") ? file_get_contents($base . "hibe3_headerlistleft_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_headerlistleft_template.html.php") ? file_get_contents($base . "hibe3_headerlistleft_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarbuttonsearch_template()
    {
        $base = __DIR__ . "/hibe3_navbarbuttonsearch_template/";
        $return["css"] = file_exists($base . "hibe3_navbarbuttonsearch_template.css.php") ? file_get_contents($base . "hibe3_navbarbuttonsearch_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarbuttonsearch_template.js.php") ? file_get_contents($base . "hibe3_navbarbuttonsearch_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarbuttonsearch_template.html.php") ? file_get_contents($base . "hibe3_navbarbuttonsearch_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarlistprofile_template()
    {
        $base = __DIR__ . "/hibe3_navbarlistprofile_template/";
        $return["css"] = file_exists($base . "hibe3_navbarlistprofile_template.css.php") ? file_get_contents($base . "hibe3_navbarlistprofile_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarlistprofile_template.js.php") ? file_get_contents($base . "hibe3_navbarlistprofile_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarlistprofile_template.html.php") ? file_get_contents($base . "hibe3_navbarlistprofile_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarlogo_template()
    {
        $base = __DIR__ . "/hibe3_navbarlogo_template/";
        $return["css"] = file_exists($base . "hibe3_navbarlogo_template.css.php") ? file_get_contents($base . "hibe3_navbarlogo_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarlogo_template.js.php") ? file_get_contents($base . "hibe3_navbarlogo_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarlogo_template.html.php") ? file_get_contents($base . "hibe3_navbarlogo_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarnotification_template()
    {
        $base = __DIR__ . "/hibe3_navbarnotification_template/";
        $return["css"] = file_exists($base . "hibe3_navbarnotification_template.css.php") ? file_get_contents($base . "hibe3_navbarnotification_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarnotification_template.js.php") ? file_get_contents($base . "hibe3_navbarnotification_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarnotification_template.html.php") ? file_get_contents($base . "hibe3_navbarnotification_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarsearch_template()
    {
        $base = __DIR__ . "/hibe3_navbarsearch_template/";
        $return["css"] = file_exists($base . "hibe3_navbarsearch_template.css.php") ? file_get_contents($base . "hibe3_navbarsearch_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarsearch_template.js.php") ? file_get_contents($base . "hibe3_navbarsearch_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarsearch_template.html.php") ? file_get_contents($base . "hibe3_navbarsearch_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbarsearchresult_template()
    {
        $base = __DIR__ . "/hibe3_navbarsearchresult_template/";
        $return["css"] = file_exists($base . "hibe3_navbarsearchresult_template.css.php") ? file_get_contents($base . "hibe3_navbarsearchresult_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbarsearchresult_template.js.php") ? file_get_contents($base . "hibe3_navbarsearchresult_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbarsearchresult_template.html.php") ? file_get_contents($base . "hibe3_navbarsearchresult_template.html.php") : "";
        return $return;
    }

        public static function hibe3_navbartoggle_template()
    {
        $base = __DIR__ . "/hibe3_navbartoggle_template/";
        $return["css"] = file_exists($base . "hibe3_navbartoggle_template.css.php") ? file_get_contents($base . "hibe3_navbartoggle_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_navbartoggle_template.js.php") ? file_get_contents($base . "hibe3_navbartoggle_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_navbartoggle_template.html.php") ? file_get_contents($base . "hibe3_navbartoggle_template.html.php") : "";
        return $return;
    }

        public static function hibe3_sidebarinprofilebox_template()
    {
        $base = __DIR__ . "/hibe3_sidebarinprofilebox_template/";
        $return["css"] = file_exists($base . "hibe3_sidebarinprofilebox_template.css.php") ? file_get_contents($base . "hibe3_sidebarinprofilebox_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_sidebarinprofilebox_template.js.php") ? file_get_contents($base . "hibe3_sidebarinprofilebox_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_sidebarinprofilebox_template.html.php") ? file_get_contents($base . "hibe3_sidebarinprofilebox_template.html.php") : "";
        return $return;
    }

        public static function hibe3_sidebarlist_template()
    {
        $base = __DIR__ . "/hibe3_sidebarlist_template/";
        $return["css"] = file_exists($base . "hibe3_sidebarlist_template.css.php") ? file_get_contents($base . "hibe3_sidebarlist_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_sidebarlist_template.js.php") ? file_get_contents($base . "hibe3_sidebarlist_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_sidebarlist_template.html.php") ? file_get_contents($base . "hibe3_sidebarlist_template.html.php") : "";
        return $return;
    }

        public static function hibe3_sidebarlistbottom_template()
    {
        $base = __DIR__ . "/hibe3_sidebarlistbottom_template/";
        $return["css"] = file_exists($base . "hibe3_sidebarlistbottom_template.css.php") ? file_get_contents($base . "hibe3_sidebarlistbottom_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_sidebarlistbottom_template.js.php") ? file_get_contents($base . "hibe3_sidebarlistbottom_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_sidebarlistbottom_template.html.php") ? file_get_contents($base . "hibe3_sidebarlistbottom_template.html.php") : "";
        return $return;
    }

        public static function hibe3_blockbanner_template()
    {
        $base = __DIR__ . "/hibe3_blockbanner_template/";
        $return["css"] = file_exists($base . "hibe3_blockbanner_template.css.php") ? file_get_contents($base . "hibe3_blockbanner_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_blockbanner_template.js.php") ? file_get_contents($base . "hibe3_blockbanner_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_blockbanner_template.html.php") ? file_get_contents($base . "hibe3_blockbanner_template.html.php") : "";
        return $return;
    }

        public static function hibe3_blockbanner_button_template()
    {
        $base = __DIR__ . "/hibe3_blockbanner_button_template/";
        $return["css"] = file_exists($base . "hibe3_blockbanner_button_template.css.php") ? file_get_contents($base . "hibe3_blockbanner_button_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_blockbanner_button_template.js.php") ? file_get_contents($base . "hibe3_blockbanner_button_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_blockbanner_button_template.html.php") ? file_get_contents($base . "hibe3_blockbanner_button_template.html.php") : "";
        return $return;
    }

        public static function hibe3_checkboxgroup_template()
    {
        $base = __DIR__ . "/hibe3_checkboxgroup_template/";
        $return["css"] = file_exists($base . "hibe3_checkboxgroup_template.css.php") ? file_get_contents($base . "hibe3_checkboxgroup_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_checkboxgroup_template.js.php") ? file_get_contents($base . "hibe3_checkboxgroup_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_checkboxgroup_template.html.php") ? file_get_contents($base . "hibe3_checkboxgroup_template.html.php") : "";
        return $return;
    }

        public static function hibe3_checkboxgroup_checkbox_template()
    {
        $base = __DIR__ . "/hibe3_checkboxgroup_checkbox_template/";
        $return["css"] = file_exists($base . "hibe3_checkboxgroup_checkbox_template.css.php") ? file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_checkboxgroup_checkbox_template.js.php") ? file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_checkboxgroup_checkbox_template.html.php") ? file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.html.php") : "";
        return $return;
    }

        public static function hibe3_checkboxgroup_group_template()
    {
        $base = __DIR__ . "/hibe3_checkboxgroup_group_template/";
        $return["css"] = file_exists($base . "hibe3_checkboxgroup_group_template.css.php") ? file_get_contents($base . "hibe3_checkboxgroup_group_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_checkboxgroup_group_template.js.php") ? file_get_contents($base . "hibe3_checkboxgroup_group_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_checkboxgroup_group_template.html.php") ? file_get_contents($base . "hibe3_checkboxgroup_group_template.html.php") : "";
        return $return;
    }

        public static function hibe3_swipper_template()
    {
        $base = __DIR__ . "/hibe3_swipper_template/";
        $return["css"] = file_exists($base . "hibe3_swipper_template.css.php") ? file_get_contents($base . "hibe3_swipper_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_swipper_template.js.php") ? file_get_contents($base . "hibe3_swipper_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_swipper_template.html.php") ? file_get_contents($base . "hibe3_swipper_template.html.php") : "";
        return $return;
    }

        public static function soft_ui_carddashboard_right_template()
    {
        $base = __DIR__ . "/soft_ui_carddashboard_right_template/";
        $return["css"] = file_exists($base . "soft_ui_carddashboard_right_template.css.php") ? file_get_contents($base . "soft_ui_carddashboard_right_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui_carddashboard_right_template.js.php") ? file_get_contents($base . "soft_ui_carddashboard_right_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui_carddashboard_right_template.html.php") ? file_get_contents($base . "soft_ui_carddashboard_right_template.html.php") : "";
        return $return;
    }

        public static function soft_ui_carddashboard_template()
    {
        $base = __DIR__ . "/soft_ui_carddashboard_template/";
        $return["css"] = file_exists($base . "soft_ui_carddashboard_template.css.php") ? file_get_contents($base . "soft_ui_carddashboard_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui_carddashboard_template.js.php") ? file_get_contents($base . "soft_ui_carddashboard_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui_carddashboard_template.html.php") ? file_get_contents($base . "soft_ui_carddashboard_template.html.php") : "";
        return $return;
    }

        public static function soft_ui_cardinfo1_template()
    {
        $base = __DIR__ . "/soft_ui_cardinfo1_template/";
        $return["css"] = file_exists($base . "soft_ui_cardinfo1_template.css.php") ? file_get_contents($base . "soft_ui_cardinfo1_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui_cardinfo1_template.js.php") ? file_get_contents($base . "soft_ui_cardinfo1_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui_cardinfo1_template.html.php") ? file_get_contents($base . "soft_ui_cardinfo1_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardfilter_template()
    {
        $base = __DIR__ . "/soft_ui__cardfilter_template/";
        $return["css"] = file_exists($base . "soft_ui__cardfilter_template.css.php") ? file_get_contents($base . "soft_ui__cardfilter_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardfilter_template.js.php") ? file_get_contents($base . "soft_ui__cardfilter_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardfilter_template.html.php") ? file_get_contents($base . "soft_ui__cardfilter_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardlistingmenu_template()
    {
        $base = __DIR__ . "/soft_ui__cardlistingmenu_template/";
        $return["css"] = file_exists($base . "soft_ui__cardlistingmenu_template.css.php") ? file_get_contents($base . "soft_ui__cardlistingmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardlistingmenu_template.js.php") ? file_get_contents($base . "soft_ui__cardlistingmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardlistingmenu_template.html.php") ? file_get_contents($base . "soft_ui__cardlistingmenu_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/soft_ui__cardmainlistingmenu_template/";
        $return["css"] = file_exists($base . "soft_ui__cardmainlistingmenu_template.css.php") ? file_get_contents($base . "soft_ui__cardmainlistingmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardmainlistingmenu_template.js.php") ? file_get_contents($base . "soft_ui__cardmainlistingmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardmainlistingmenu_template.html.php") ? file_get_contents($base . "soft_ui__cardmainlistingmenu_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardmenu_template()
    {
        $base = __DIR__ . "/soft_ui__cardmenu_template/";
        $return["css"] = file_exists($base . "soft_ui__cardmenu_template.css.php") ? file_get_contents($base . "soft_ui__cardmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardmenu_template.js.php") ? file_get_contents($base . "soft_ui__cardmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardmenu_template.html.php") ? file_get_contents($base . "soft_ui__cardmenu_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardmenuscreena_template()
    {
        $base = __DIR__ . "/soft_ui__cardmenuscreena_template/";
        $return["css"] = file_exists($base . "soft_ui__cardmenuscreena_template.css.php") ? file_get_contents($base . "soft_ui__cardmenuscreena_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardmenuscreena_template.js.php") ? file_get_contents($base . "soft_ui__cardmenuscreena_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardmenuscreena_template.html.php") ? file_get_contents($base . "soft_ui__cardmenuscreena_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardmenuscreenb_template()
    {
        $base = __DIR__ . "/soft_ui__cardmenuscreenb_template/";
        $return["css"] = file_exists($base . "soft_ui__cardmenuscreenb_template.css.php") ? file_get_contents($base . "soft_ui__cardmenuscreenb_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardmenuscreenb_template.js.php") ? file_get_contents($base . "soft_ui__cardmenuscreenb_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardmenuscreenb_template.html.php") ? file_get_contents($base . "soft_ui__cardmenuscreenb_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardullinav_template()
    {
        $base = __DIR__ . "/soft_ui__cardullinav_template/";
        $return["css"] = file_exists($base . "soft_ui__cardullinav_template.css.php") ? file_get_contents($base . "soft_ui__cardullinav_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardullinav_template.js.php") ? file_get_contents($base . "soft_ui__cardullinav_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardullinav_template.html.php") ? file_get_contents($base . "soft_ui__cardullinav_template.html.php") : "";
        return $return;
    }

        public static function soft_ui__cardulnav_template()
    {
        $base = __DIR__ . "/soft_ui__cardulnav_template/";
        $return["css"] = file_exists($base . "soft_ui__cardulnav_template.css.php") ? file_get_contents($base . "soft_ui__cardulnav_template.css.php") : "";
        $return["js"] = file_exists($base . "soft_ui__cardulnav_template.js.php") ? file_get_contents($base . "soft_ui__cardulnav_template.js.php") : "";
        $return["html"] = file_exists($base . "soft_ui__cardulnav_template.html.php") ? file_get_contents($base . "soft_ui__cardulnav_template.html.php") : "";
        return $return;
    }

        public static function tabler_crud_list_template()
    {
        $base = __DIR__ . "/tabler_crud_list_template/";
        $return["css"] = file_exists($base . "tabler_crud_list_template.css.php") ? file_get_contents($base . "tabler_crud_list_template.css.php") : "";
        $return["js"] = file_exists($base . "tabler_crud_list_template.js.php") ? file_get_contents($base . "tabler_crud_list_template.js.php") : "";
        $return["html"] = file_exists($base . "tabler_crud_list_template.html.php") ? file_get_contents($base . "tabler_crud_list_template.html.php") : "";
        return $return;
    }

        public static function tabler_crud_vte_template()
    {
        $base = __DIR__ . "/tabler_crud_vte_template/";
        $return["css"] = file_exists($base . "tabler_crud_vte_template.css.php") ? file_get_contents($base . "tabler_crud_vte_template.css.php") : "";
        $return["js"] = file_exists($base . "tabler_crud_vte_template.js.php") ? file_get_contents($base . "tabler_crud_vte_template.js.php") : "";
        $return["html"] = file_exists($base . "tabler_crud_vte_template.html.php") ? file_get_contents($base . "tabler_crud_vte_template.html.php") : "";
        return $return;
    }

        public static function tabler_section_header_template()
    {
        $base = __DIR__ . "/tabler_section_header_template/";
        $return["css"] = file_exists($base . "tabler_section_header_template.css.php") ? file_get_contents($base . "tabler_section_header_template.css.php") : "";
        $return["js"] = file_exists($base . "tabler_section_header_template.js.php") ? file_get_contents($base . "tabler_section_header_template.js.php") : "";
        $return["html"] = file_exists($base . "tabler_section_header_template.html.php") ? file_get_contents($base . "tabler_section_header_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_banner_template()
    {
        $base = __DIR__ . "/topiclisting_banner_template/";
        $return["css"] = file_exists($base . "topiclisting_banner_template.css.php") ? file_get_contents($base . "topiclisting_banner_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_banner_template.js.php") ? file_get_contents($base . "topiclisting_banner_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_banner_template.html.php") ? file_get_contents($base . "topiclisting_banner_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_banner_detail_template()
    {
        $base = __DIR__ . "/topiclisting_banner_detail_template/";
        $return["css"] = file_exists($base . "topiclisting_banner_detail_template.css.php") ? file_get_contents($base . "topiclisting_banner_detail_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_banner_detail_template.js.php") ? file_get_contents($base . "topiclisting_banner_detail_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_banner_detail_template.html.php") ? file_get_contents($base . "topiclisting_banner_detail_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_contact_section_template()
    {
        $base = __DIR__ . "/topiclisting_contact_section_template/";
        $return["css"] = file_exists($base . "topiclisting_contact_section_template.css.php") ? file_get_contents($base . "topiclisting_contact_section_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_contact_section_template.js.php") ? file_get_contents($base . "topiclisting_contact_section_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_contact_section_template.html.php") ? file_get_contents($base . "topiclisting_contact_section_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_content_tab_pane_template()
    {
        $base = __DIR__ . "/topiclisting_content_tab_pane_template/";
        $return["css"] = file_exists($base . "topiclisting_content_tab_pane_template.css.php") ? file_get_contents($base . "topiclisting_content_tab_pane_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_content_tab_pane_template.js.php") ? file_get_contents($base . "topiclisting_content_tab_pane_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_content_tab_pane_template.html.php") ? file_get_contents($base . "topiclisting_content_tab_pane_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_explore_section_template()
    {
        $base = __DIR__ . "/topiclisting_explore_section_template/";
        $return["css"] = file_exists($base . "topiclisting_explore_section_template.css.php") ? file_get_contents($base . "topiclisting_explore_section_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_explore_section_template.js.php") ? file_get_contents($base . "topiclisting_explore_section_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_explore_section_template.html.php") ? file_get_contents($base . "topiclisting_explore_section_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_faq_detail_template()
    {
        $base = __DIR__ . "/topiclisting_faq_detail_template/";
        $return["css"] = file_exists($base . "topiclisting_faq_detail_template.css.php") ? file_get_contents($base . "topiclisting_faq_detail_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_faq_detail_template.js.php") ? file_get_contents($base . "topiclisting_faq_detail_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_faq_detail_template.html.php") ? file_get_contents($base . "topiclisting_faq_detail_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_faq_section_template()
    {
        $base = __DIR__ . "/topiclisting_faq_section_template/";
        $return["css"] = file_exists($base . "topiclisting_faq_section_template.css.php") ? file_get_contents($base . "topiclisting_faq_section_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_faq_section_template.js.php") ? file_get_contents($base . "topiclisting_faq_section_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_faq_section_template.html.php") ? file_get_contents($base . "topiclisting_faq_section_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_footer_section_template()
    {
        $base = __DIR__ . "/topiclisting_footer_section_template/";
        $return["css"] = file_exists($base . "topiclisting_footer_section_template.css.php") ? file_get_contents($base . "topiclisting_footer_section_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_footer_section_template.js.php") ? file_get_contents($base . "topiclisting_footer_section_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_footer_section_template.html.php") ? file_get_contents($base . "topiclisting_footer_section_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_nav_header_template()
    {
        $base = __DIR__ . "/topiclisting_nav_header_template/";
        $return["css"] = file_exists($base . "topiclisting_nav_header_template.css.php") ? file_get_contents($base . "topiclisting_nav_header_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_nav_header_template.js.php") ? file_get_contents($base . "topiclisting_nav_header_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_nav_header_template.html.php") ? file_get_contents($base . "topiclisting_nav_header_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_nav_item_template()
    {
        $base = __DIR__ . "/topiclisting_nav_item_template/";
        $return["css"] = file_exists($base . "topiclisting_nav_item_template.css.php") ? file_get_contents($base . "topiclisting_nav_item_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_nav_item_template.js.php") ? file_get_contents($base . "topiclisting_nav_item_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_nav_item_template.html.php") ? file_get_contents($base . "topiclisting_nav_item_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_nav_item_header_template()
    {
        $base = __DIR__ . "/topiclisting_nav_item_header_template/";
        $return["css"] = file_exists($base . "topiclisting_nav_item_header_template.css.php") ? file_get_contents($base . "topiclisting_nav_item_header_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_nav_item_header_template.js.php") ? file_get_contents($base . "topiclisting_nav_item_header_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_nav_item_header_template.html.php") ? file_get_contents($base . "topiclisting_nav_item_header_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_tab_pane_template()
    {
        $base = __DIR__ . "/topiclisting_tab_pane_template/";
        $return["css"] = file_exists($base . "topiclisting_tab_pane_template.css.php") ? file_get_contents($base . "topiclisting_tab_pane_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_tab_pane_template.js.php") ? file_get_contents($base . "topiclisting_tab_pane_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_tab_pane_template.html.php") ? file_get_contents($base . "topiclisting_tab_pane_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_timeline_detail_template()
    {
        $base = __DIR__ . "/topiclisting_timeline_detail_template/";
        $return["css"] = file_exists($base . "topiclisting_timeline_detail_template.css.php") ? file_get_contents($base . "topiclisting_timeline_detail_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_timeline_detail_template.js.php") ? file_get_contents($base . "topiclisting_timeline_detail_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_timeline_detail_template.html.php") ? file_get_contents($base . "topiclisting_timeline_detail_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_timeline_section_template()
    {
        $base = __DIR__ . "/topiclisting_timeline_section_template/";
        $return["css"] = file_exists($base . "topiclisting_timeline_section_template.css.php") ? file_get_contents($base . "topiclisting_timeline_section_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_timeline_section_template.js.php") ? file_get_contents($base . "topiclisting_timeline_section_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_timeline_section_template.html.php") ? file_get_contents($base . "topiclisting_timeline_section_template.html.php") : "";
        return $return;
    }

        public static function topiclisting_topic_detail_template()
    {
        $base = __DIR__ . "/topiclisting_topic_detail_template/";
        $return["css"] = file_exists($base . "topiclisting_topic_detail_template.css.php") ? file_get_contents($base . "topiclisting_topic_detail_template.css.php") : "";
        $return["js"] = file_exists($base . "topiclisting_topic_detail_template.js.php") ? file_get_contents($base . "topiclisting_topic_detail_template.js.php") : "";
        $return["html"] = file_exists($base . "topiclisting_topic_detail_template.html.php") ? file_get_contents($base . "topiclisting_topic_detail_template.html.php") : "";
        return $return;
    }

        public static function beegrit_card_img_template()
    {
        $base = __DIR__ . "/beegrit_card_img_template/";
        $return["css"] = file_exists($base . "beegrit_card_img_template.css.php") ? file_get_contents($base . "beegrit_card_img_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_card_img_template.js.php") ? file_get_contents($base . "beegrit_card_img_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_card_img_template.html.php") ? file_get_contents($base . "beegrit_card_img_template.html.php") : "";
        return $return;
    }

        public static function beegrit_card_layout_template()
    {
        $base = __DIR__ . "/beegrit_card_layout_template/";
        $return["css"] = file_exists($base . "beegrit_card_layout_template.css.php") ? file_get_contents($base . "beegrit_card_layout_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_card_layout_template.js.php") ? file_get_contents($base . "beegrit_card_layout_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_card_layout_template.html.php") ? file_get_contents($base . "beegrit_card_layout_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_chat_template()
    {
        $base = __DIR__ . "/beegrit_chat_chat_template/";
        $return["css"] = file_exists($base . "beegrit_chat_chat_template.css.php") ? file_get_contents($base . "beegrit_chat_chat_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_chat_template.js.php") ? file_get_contents($base . "beegrit_chat_chat_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_chat_template.html.php") ? file_get_contents($base . "beegrit_chat_chat_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_content_footer_template()
    {
        $base = __DIR__ . "/beegrit_chat_content_footer_template/";
        $return["css"] = file_exists($base . "beegrit_chat_content_footer_template.css.php") ? file_get_contents($base . "beegrit_chat_content_footer_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_content_footer_template.js.php") ? file_get_contents($base . "beegrit_chat_content_footer_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_content_footer_template.html.php") ? file_get_contents($base . "beegrit_chat_content_footer_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_content_pesan_template()
    {
        $base = __DIR__ . "/beegrit_chat_content_pesan_template/";
        $return["css"] = file_exists($base . "beegrit_chat_content_pesan_template.css.php") ? file_get_contents($base . "beegrit_chat_content_pesan_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_content_pesan_template.js.php") ? file_get_contents($base . "beegrit_chat_content_pesan_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_content_pesan_template.html.php") ? file_get_contents($base . "beegrit_chat_content_pesan_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_content_pesan_me_template()
    {
        $base = __DIR__ . "/beegrit_chat_content_pesan_me_template/";
        $return["css"] = file_exists($base . "beegrit_chat_content_pesan_me_template.css.php") ? file_get_contents($base . "beegrit_chat_content_pesan_me_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_content_pesan_me_template.js.php") ? file_get_contents($base . "beegrit_chat_content_pesan_me_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_content_pesan_me_template.html.php") ? file_get_contents($base . "beegrit_chat_content_pesan_me_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_content_pesan_other_template()
    {
        $base = __DIR__ . "/beegrit_chat_content_pesan_other_template/";
        $return["css"] = file_exists($base . "beegrit_chat_content_pesan_other_template.css.php") ? file_get_contents($base . "beegrit_chat_content_pesan_other_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_content_pesan_other_template.js.php") ? file_get_contents($base . "beegrit_chat_content_pesan_other_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_content_pesan_other_template.html.php") ? file_get_contents($base . "beegrit_chat_content_pesan_other_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_content_profile_template()
    {
        $base = __DIR__ . "/beegrit_chat_content_profile_template/";
        $return["css"] = file_exists($base . "beegrit_chat_content_profile_template.css.php") ? file_get_contents($base . "beegrit_chat_content_profile_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_content_profile_template.js.php") ? file_get_contents($base . "beegrit_chat_content_profile_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_content_profile_template.html.php") ? file_get_contents($base . "beegrit_chat_content_profile_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_list_buat_chat_room_template()
    {
        $base = __DIR__ . "/beegrit_chat_list_buat_chat_room_template/";
        $return["css"] = file_exists($base . "beegrit_chat_list_buat_chat_room_template.css.php") ? file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_list_buat_chat_room_template.js.php") ? file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_list_buat_chat_room_template.html.php") ? file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.html.php") : "";
        return $return;
    }

        public static function beegrit_chat_list_chat_room_template()
    {
        $base = __DIR__ . "/beegrit_chat_list_chat_room_template/";
        $return["css"] = file_exists($base . "beegrit_chat_list_chat_room_template.css.php") ? file_get_contents($base . "beegrit_chat_list_chat_room_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_chat_list_chat_room_template.js.php") ? file_get_contents($base . "beegrit_chat_list_chat_room_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_chat_list_chat_room_template.html.php") ? file_get_contents($base . "beegrit_chat_list_chat_room_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_cart_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_cart_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_cart_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_cart_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_cart_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_cart_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_cart_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_cart_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_cart_option_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_cart_option_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_cart_option_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_cart_option_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_cart_option_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_cart_option_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_cart_option_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_cart_option_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_cart_produk_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_cart_produk_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_cart_produk_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_cart_produk_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_cart_produk_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_cart_produk_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_cart_produk_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_cart_produk_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_cart_toko_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_cart_toko_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_cart_toko_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_cart_toko_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_cart_toko_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_cart_toko_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_cart_toko_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_cart_toko_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_cart_varian_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_cart_varian_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_cart_varian_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_cart_varian_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_cart_varian_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_cart_varian_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_cart_varian_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_cart_varian_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_checkout_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_checkout_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_checkout_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_checkout_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_checkout_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_checkout_kirim_ke_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_checkout_kirim_ke_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_checkout_kirim_ke_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_checkout_kirim_ke_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_checkout_kirim_ke_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_checkout_pembayaran_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_checkout_pembayaran_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_checkout_pembayaran_brand_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_checkout_pembayaran_brand_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_detail_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_detail_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_detail_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_detail_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_detail_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_detail_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_detail_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_detail_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_detail_spesifikasi_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_detail_spesifikasi_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_detail_spesifikasi_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_detail_spesifikasi_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_detail_spesifikasi_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_img_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_img_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_img_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_img_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_img_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_img_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_img_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_img_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_img_tumb_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_img_tumb_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_img_tumb_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_img_tumb_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_img_tumb_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_img_tumb_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_img_tumb_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_img_tumb_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_invoice_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_invoice_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_invoice_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_invoice_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_invoice_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_invoice_alamat_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_invoice_alamat_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_invoice_alamat_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_invoice_alamat_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_invoice_alamat_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_invoice_pembayaran_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_invoice_pembayaran_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_invoice_pembayaran_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_invoice_pembayaran_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_invoice_pembayaran_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_varian_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_varian_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_varian_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_varian_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_varian_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_varian_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_varian_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_varian_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_varian_else_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_varian_else_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_varian_else_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_varian_else_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_varian_else_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_varian_else_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_varian_else_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_varian_else_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_varian_size_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_varian_size_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_varian_size_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_varian_size_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_varian_size_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_varian_size_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_varian_size_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_varian_size_template.html.php") : "";
        return $return;
    }

        public static function beegrit_ecommerce_varian_warna_template()
    {
        $base = __DIR__ . "/beegrit_ecommerce_varian_warna_template/";
        $return["css"] = file_exists($base . "beegrit_ecommerce_varian_warna_template.css.php") ? file_get_contents($base . "beegrit_ecommerce_varian_warna_template.css.php") : "";
        $return["js"] = file_exists($base . "beegrit_ecommerce_varian_warna_template.js.php") ? file_get_contents($base . "beegrit_ecommerce_varian_warna_template.js.php") : "";
        $return["html"] = file_exists($base . "beegrit_ecommerce_varian_warna_template.html.php") ? file_get_contents($base . "beegrit_ecommerce_varian_warna_template.html.php") : "";
        return $return;
    }

        public static function codepen_bookmark_appview_transition_card_apps_template()
    {
        $base = __DIR__ . "/codepen_bookmark_appview_transition_card_apps_template/";
        $return["css"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_template.css.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_template.js.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_template.html.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.html.php") : "";
        return $return;
    }

        public static function codepen_bookmark_appview_transition_card_apps_avatar_template()
    {
        $base = __DIR__ . "/codepen_bookmark_appview_transition_card_apps_avatar_template/";
        $return["css"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.css.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.js.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.html.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.html.php") : "";
        return $return;
    }

        public static function codepen_bookmark_appview_transition_card_apps_header_nav_template()
    {
        $base = __DIR__ . "/codepen_bookmark_appview_transition_card_apps_header_nav_template/";
        $return["css"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.css.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.js.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.html.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.html.php") : "";
        return $return;
    }

        public static function codepen_bookmark_appview_transition_card_apps_sidebar_template()
    {
        $base = __DIR__ . "/codepen_bookmark_appview_transition_card_apps_sidebar_template/";
        $return["css"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.css.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.js.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.html.php") ? file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.html.php") : "";
        return $return;
    }

        public static function codepen_comparision_comparision_template()
    {
        $base = __DIR__ . "/codepen_comparision_comparision_template/";
        $return["css"] = file_exists($base . "codepen_comparision_comparision_template.css.php") ? file_get_contents($base . "codepen_comparision_comparision_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_comparision_comparision_template.js.php") ? file_get_contents($base . "codepen_comparision_comparision_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_comparision_comparision_template.html.php") ? file_get_contents($base . "codepen_comparision_comparision_template.html.php") : "";
        return $return;
    }

        public static function codepen_learderboard_leaderboard_template()
    {
        $base = __DIR__ . "/codepen_learderboard_leaderboard_template/";
        $return["css"] = file_exists($base . "codepen_learderboard_leaderboard_template.css.php") ? file_get_contents($base . "codepen_learderboard_leaderboard_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_learderboard_leaderboard_template.js.php") ? file_get_contents($base . "codepen_learderboard_leaderboard_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_learderboard_leaderboard_template.html.php") ? file_get_contents($base . "codepen_learderboard_leaderboard_template.html.php") : "";
        return $return;
    }

        public static function codepen_swipper_swipper_template()
    {
        $base = __DIR__ . "/codepen_swipper_swipper_template/";
        $return["css"] = file_exists($base . "codepen_swipper_swipper_template.css.php") ? file_get_contents($base . "codepen_swipper_swipper_template.css.php") : "";
        $return["js"] = file_exists($base . "codepen_swipper_swipper_template.js.php") ? file_get_contents($base . "codepen_swipper_swipper_template.js.php") : "";
        $return["html"] = file_exists($base . "codepen_swipper_swipper_template.html.php") ? file_get_contents($base . "codepen_swipper_swipper_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardfilter_template()
    {
        $base = __DIR__ . "/hibe3_card__cardfilter_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardfilter_template.css.php") ? file_get_contents($base . "hibe3_card__cardfilter_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardfilter_template.js.php") ? file_get_contents($base . "hibe3_card__cardfilter_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardfilter_template.html.php") ? file_get_contents($base . "hibe3_card__cardfilter_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardlistingmenu_template()
    {
        $base = __DIR__ . "/hibe3_card__cardlistingmenu_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardlistingmenu_template.css.php") ? file_get_contents($base . "hibe3_card__cardlistingmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardlistingmenu_template.js.php") ? file_get_contents($base . "hibe3_card__cardlistingmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardlistingmenu_template.html.php") ? file_get_contents($base . "hibe3_card__cardlistingmenu_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/hibe3_card__cardmainlistingmenu_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardmainlistingmenu_template.css.php") ? file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardmainlistingmenu_template.js.php") ? file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardmainlistingmenu_template.html.php") ? file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardmenu_template()
    {
        $base = __DIR__ . "/hibe3_card__cardmenu_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardmenu_template.css.php") ? file_get_contents($base . "hibe3_card__cardmenu_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardmenu_template.js.php") ? file_get_contents($base . "hibe3_card__cardmenu_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardmenu_template.html.php") ? file_get_contents($base . "hibe3_card__cardmenu_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardmenuscreena_template()
    {
        $base = __DIR__ . "/hibe3_card__cardmenuscreena_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardmenuscreena_template.css.php") ? file_get_contents($base . "hibe3_card__cardmenuscreena_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardmenuscreena_template.js.php") ? file_get_contents($base . "hibe3_card__cardmenuscreena_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardmenuscreena_template.html.php") ? file_get_contents($base . "hibe3_card__cardmenuscreena_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardmenuscreenb_template()
    {
        $base = __DIR__ . "/hibe3_card__cardmenuscreenb_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardmenuscreenb_template.css.php") ? file_get_contents($base . "hibe3_card__cardmenuscreenb_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardmenuscreenb_template.js.php") ? file_get_contents($base . "hibe3_card__cardmenuscreenb_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardmenuscreenb_template.html.php") ? file_get_contents($base . "hibe3_card__cardmenuscreenb_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardprofilemenu_template()
    {
        $base = __DIR__ . "/hibe3_card__cardprofilemenu_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardprofilemenu_template.css.php") ? file_get_contents($base . "hibe3_card__cardprofilemenu_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardprofilemenu_template.js.php") ? file_get_contents($base . "hibe3_card__cardprofilemenu_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardprofilemenu_template.html.php") ? file_get_contents($base . "hibe3_card__cardprofilemenu_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardullinav_template()
    {
        $base = __DIR__ . "/hibe3_card__cardullinav_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardullinav_template.css.php") ? file_get_contents($base . "hibe3_card__cardullinav_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardullinav_template.js.php") ? file_get_contents($base . "hibe3_card__cardullinav_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardullinav_template.html.php") ? file_get_contents($base . "hibe3_card__cardullinav_template.html.php") : "";
        return $return;
    }

        public static function hibe3_card__cardulnav_template()
    {
        $base = __DIR__ . "/hibe3_card__cardulnav_template/";
        $return["css"] = file_exists($base . "hibe3_card__cardulnav_template.css.php") ? file_get_contents($base . "hibe3_card__cardulnav_template.css.php") : "";
        $return["js"] = file_exists($base . "hibe3_card__cardulnav_template.js.php") ? file_get_contents($base . "hibe3_card__cardulnav_template.js.php") : "";
        $return["html"] = file_exists($base . "hibe3_card__cardulnav_template.html.php") ? file_get_contents($base . "hibe3_card__cardulnav_template.html.php") : "";
        return $return;
    }

        }