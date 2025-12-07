<?php
class Workspace_CLASS
{
    use Workspace_bisnis;
}
class Workspace extends Workspace_CLASS
{

    public static function workspace_apps($page)
    {

        $page['title'] = strtoupper($page['load']['apps']);

        $card['listing_type'] = "listingmenu"; //info/listing/listmenu
        $card['default_id']   = "Workspace";
        $card['view_default'] = "ViewHorizontal";
        $page['limit_page']   = 1;
        $card['menu']         = [
            "Dashboard" => ["icon", 'card-layout', 'array-layout-dashboard'],
            "Workspace" => ["icon", 'card-nav', 'array-menu'],

        ];

        $card['array-menu'] = [
            "type"       => "nav",
            "defaultNav" => "Workspace",
            "cardNav"    => [
                "Workspace"        => [
                    "mode"           => "card-listing",
                    "database_refer" => "Workspace",
                    "view_default"   => "ViewVertical",
                    "row"            => "col-xl-2 col-md-6 mb-xl-0 mb-4",
                    "prelist"        => [
                        //0-> template,manual,exted,website
                        ["extend", "button", ["a", "Tambah Workspace", "text", false, ["Workspace", "workspace_apps", "view_layout", "-1", "Workspace", "Tambah Workspace"], ["class" => "btn btn-primary btn-sm"]]],
                        ["extend", "button", ["a", "Cari Workspace", "text", false, ["Workspace", "workspace_apps", "view_layout", "-1", "Workspace", "Cari Workspace"], ["class" => "btn btn-primary btn-sm"]]],

                    ],
                    "array"          => [
                        ["img", null, "datafile", ["web__list_apps_board", 'primary_key', "nama_board"], false],
                        ["body", "tag"],
                        ["title", "nama_board", "database", true],
                        ["subtitle", ["Be3 ID: ", "be3_id", ""], "database-costum", true],
                        // array("deskripsi","bidang_organisasi","database",true),
                        //array("deskripsi",array("id_organisasi_bidang_on_organisasi","organisasi_bidang","id_organisasi_bidang","nama_bidang"),"database-join",true),
                        ["extend", "CARD-FOOTER-BOTTOM", "button", ["a", "View Workspace", "text", false, ["Workspace", "user_list", "list", "-1", "-1", "-1", "row:primary_key!Workspace|"]]],
                    ],
                ],
                "Cari Workspace"   => [

                    "mode"           => "card-listing",
                    "database_refer" => "Cari Workspace",
                    "view_default"   => "ViewVertical",
                    "row"            => "col-xl-2 col-md-6 mb-xl-0 mb-4",
                    "array"          => [

                        ["img", null, "datafile", ["ltw_kegiatan__board", 'id', "nama_board"], false],
                        ["body", "tag"],
                        ["title", "nama_board", "database", true],
                        ["subtitle", ["Be3 ID: ", "be3_id", ""], "database-costum", true],
                        ["deskripsi", "deskripsi", "database", true],
                        ["extend", "CARD-FOOTER-BOTTOM", "button", ["a", "Gabung", "text", false, ["Kegiatan", "board_amalan", "view_layout", "{{row:primary_key}}", "Muktabaah", ""], ["claas" => "btn btn-primary btn-sm"]]],
                    ],

                ],
                "Tambah Workspace" => [

                    "mode"           => "crud",
                    "database_refer" => "Tambah Workspace",
                    "crud"           => [
                        "insert_default_value"  => ["barcode" => "RANDOMNUM::10|", 'id_panel' => "ID_PANEL|", "create_on_apps" => Partial::get_id_apps($page)],
                        "redirect_after_submit" => ["Workspace", 'paket', 'view_layout', -1, -1],
                        "oninsert"              => [
                            [
                                "tipe"   => "insert",
                                "insert" => [
                                    "table_insert" => "web__list_apps_board__user_list",
                                    "field"        => [
                                        ["id_user", "id_apps_user", "session"],
                                        ["id_web__list_apps_board", "", "last_value"],
                                    ],
                                ],
                            ],
                            [
                                "tipe"   => "session",
                                "insert" => [
                                    "field" => [
                                        ["insert_workspace_board_id", "", "last_value"],
                                        ["insert_workspace_apps_id", $_SESSION['to_list_workspace_id_apps'], "text"],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    "array"          => [
                        ["Be3 ID", null, "text"],
                        ["Nama Workspace", "nama_board", "text"],
                        ["Deskripsi", null, "text"],
                        ["foto utama", null, "file", 'board/brosur'],
                    ],

                ],
            ],
        ];
        $fai = new MainFaiFramework();

        $page['config']['database']['Workspace']['utama']       = 'web__list_apps_board';
        $page['config']['database']['Workspace']['primary_key'] = null;
        // $page['config']['database']['Workspace']['join'][] = array("web__list_apps_board__user", "web__list_apps_board.id", "web__list_apps_board__user.id_web__list_apps_board and id_user={SESSION_UTAMA} ", 'INNER');
        $page['config']['database']['Workspace']['join'][]  = ["web__list_apps_board__apps", "web__list_apps_board.id", "web__list_apps_board__apps.id_web__list_apps_board", "INNER"];
        $page['config']['database']['Workspace']['where'][] = ["web__list_apps_board.active", "=", "1"];

        $page['config']['database']['Workspace']['where'][] = ["web__list_apps_board.id", " in ", "(" . implode(',', Partial::get_board_user($fai, $page)) . ")"];
        $page['config']['database']['Workspace']['order'][] = ["nama_board", "asc"];

        $page['config']['database']['Tambah Workspace']['utama']       = 'web__list_apps_board';
        $page['config']['database']['Tambah Workspace']['primary_key'] = null;

        $page['get']['not_sidebarIn'] = true;
        $page['view_layout'][]        = ["card", "col-md-12", $card];
        return $page;
    }

    public static function paket($page)
    {
        $i = 0;

        $website['content'][$i]['tag']            = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name']  = "dashuipro";
        $website['content'][$i]['template_file']  = "pricing.template";
        $website['content'][$i]['template_array'] = [
            [
                "tag"   => 'TITLE',
                "refer" => "text",
                "value" => "Pilih Perencanaan Paket yang tepat",
            ],

            [
                "tag"   => 'SUBTITLE',
                "refer" => "text",
                "value" => "Atau hubungi tim konsultasi kami.",
            ],
            [
                "tag"            => 'PRICING',
                "refer"          => "database_list",
                "source_list"    => "template",
                "database_refer" => "Group",
                "template_name"  => "dashuipro",
                "template_file"  => "pricinggroup.template",
                "array"          => [
                    "TITLE"        => ["refer" => "database", "row" => "nama_group"],
                    "SUBTITLE"     => ["refer" => "database", "row" => "deskripsi_group"],
                    "PRICING-LIST" => [
                        "refer"          => "database_list",
                        "database_refer" => "-1",
                        "database"       => [
                            "utama"           => "web__list_apps_paket__list",
                            "primary_key"     => null,
                            "select_raw"      => "*",

                            "where_get_array" => [
                                [
                                    "row"       => "{IDPRIMARY}group{/IDPRIMARY}",
                                    "array_row" => "database_list_template",
                                    "get_row"   => "primary_key",
                                ],
                            ],
                        ],
                        "template_name"  => "dashuipro",
                        "template_file"  => "pricingdetail.template",
                        "array"          => [
                            "TITLE"        => ["refer" => "database", "row" => "nama_paket"],
                            "DESKRIPSI"    => ["refer" => "database", "row" => "deskripsi_paket"],
                            "LINK"         => ["refer" => "link", "route_type" => "costum_link", "link" => ["Workspace", "save_proses", "id_web__apps|", "LOAD_STEP|", "insert_workspace_board_id|", "row:id!database_list_template_on_list|"]],
                            "HARGA"        => ["refer" => "database", "row" => "harga_utama", "function" => ["class" => "Partial", "function" => "rupiah", "parameter" => ["this_value", "0"]]],
                            "PREFIXHARGA"  => ["refer" => "if_database_to_text", "source_database" => "database_list_template_on_list", "row" => "tipe_harga", "if_value" => [0 => "Rp. ", 1 => ""]],
                            "SUFFIXHARGA"  => ["refer" => "if_database_to_text", "source_database" => "database_list_template_on_list", "row" => "tipe_harga", "if_value" => [0 => ",-", 1 => "%"]],
                            "EXTEND-HARGA" => ["refer" => "database", "row" => "extend_paket"],
                            "LIST-DETAIL"  => [
                                "refer"          => "database_list",
                                "database_refer" => "-1",
                                "database"       => [
                                    "utama"           => "web__list_apps_paket__list__detail",
                                    "primary_key"     => null,
                                    "select_raw"      => "*",

                                    "join"            => [
                                        ["web__list_apps_paket__elemen", "id_elemen", "web__list_apps_paket__elemen.id"],
                                    ],
                                    "where_get_array" => [
                                        [
                                            "row"       => "web__list_apps_paket__list__detail.{IDPRIMARY}web__list_apps_paket__list{/IDPRIMARY}",
                                            "array_row" => "database_list_template",
                                            "get_row"   => "primary_key",
                                        ],
                                    ],
                                ],
                                "template_name"  => "dashuipro",
                                "template_file"  => "pricingdetail_list.template",
                                "array"          => [
                                    "TEXT" => ["refer" => "database", "row" => "nama_elemen"],
                                    // "ICON" => array(
                                    //     "refer" => "if_database_to_text",
                                    //     "source_database" => "database_list_template_on_list",
                                    //     "row" => "checklist",
                                    //     "if_value" => array(
                                    //         0 => '<span class="text-danger icon-xs" style="font-size:10px"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle  icon-xs"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></span>', 1 => '<span class="text-success icon-xs" style="font-size:10px"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle  icon-xs"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></span>'
                                    //     )
                                    // ),

                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $step['parameter_check']['get_data']       = "refer";
        $step['parameter_check']['database_refer'] = "Table Workspace";
        $step['parameter_check']['row_data']       = "step";
        $step['parameter_check']['redirect']       = ["POS", "Apps", 'view_layout', '{load_id}'];

        $step['wizard']["type"]                    = "wizard";
        $step['wizard']["first"]                   = 1;
        $i                                         = 1;
        $step['wizard']["step"][$i]['view']        = "view_website";
        $step['wizard']["step"][$i]['next']        = -1;
        $step['wizard']["step"][$i]['var_content'] = "paket";
        $i++;
        $step['wizard']["step"][$i]['view']        = "crud";
        $step['wizard']["step"][$i]['var_content'] = "entitas";

        $step['content']['paket']   = $website;
        $step['content']['entitas'] = [
            ["Entitas Terkoneksi", null, "text"],
        ];

        $page['view_layout'][] = ["step", "col-md-12", $step];

        // ALUR PENDAFTARAN
        /*
        1. pilih paket
        2. pilih aplikasi tambahan
        3. setting struktural bawahan pengendali dan pilih entitas terkoneksi
        3. pembayaran | bisa terdapat opsi trial

        */

        $page['config']['database']['Group']['utama']       = 'web__list_apps_paket__group';
        $page['config']['database']['Group']['primary_key'] = null;
        $page['config']['database']['Group']['where'][]     = ["id_apps", "=", "insert_workspace_apps_id|"];

        $page['config']['database']['Table Workspace']['utama']       = 'web__list_apps_board';
        $page['config']['database']['Table Workspace']['primary_key'] = null;
        $page['config']['database']['Table Workspace']['where'][]     = ["web__list_apps_board.id", "=", "{LOAD_ID}"];

        $page['get']['sidebarIn']     = true;
        $page['get']['not_sidebarIn'] = true;
        return $page;
    }

    public static function sidebarIn()
    {
        echo 'haiss';
        $page['load']['sidebarIn']['template_name']                            = "codepen";
        $page['load']['sidebarIn']['template_file']                            = "bookmark-appview-transition/card_apps.template";
        $i                                                                     = 0;
        $page['load']['sidebarIn']['website']['content'][$i]['tag']            = "NAME";
        $page['load']['sidebarIn']['website']['content'][$i]['refer']          = "database";
        $page['load']['sidebarIn']['website']['content'][$i]['database_refer'] = "Panel User";
        $page['load']['sidebarIn']['website']['content'][$i]['row']            = "nama";
        $i++;
        $page['load']['sidebarIn']['website']['content'][$i]['tag']            = "BE3ID";
        $page['load']['sidebarIn']['website']['content'][$i]['refer']          = "database";
        $page['load']['sidebarIn']['website']['content'][$i]['database_refer'] = "Panel User";
        $page['load']['sidebarIn']['website']['content'][$i]['row']            = "be3id";
        $i++;
        $page['load']['sidebarIn']['website']['content'][$i]['tag']                       = "SIDEBAR";
        $page['load']['sidebarIn']['website']['content'][$i]['source_list']               = "template";
        $page['load']['sidebarIn']['website']['content'][$i]['template_name']             = "codepen";
        $page['load']['sidebarIn']['website']['content'][$i]['template_file']             = "bookmark-appview-transition/";
        $page['load']['sidebarIn']['website']['content'][$i]['refer']                     = "function";
        $page['load']['sidebarIn']['website']['content'][$i]['class']                     = "LOAD_APP|";
        $page['load']['sidebarIn']['website']['content'][$i]['function']                  = "menu_{get_akses}";
        $page['load']['sidebarIn']['website']['content'][$i]['get_row']['param']          = "function";
        $page['load']['sidebarIn']['website']['content'][$i]['get_row']['param_value']    = "{get_akses}";
        $page['load']['sidebarIn']['website']['content'][$i]['get_row']['database_refer'] = "Workspace";
        $page['load']['sidebarIn']['website']['content'][$i]['get_row']['row']            = "Workspace";
        $i++;
        $page['load']['sidebarIn']['website']['content'][$i]['tag']                       = "SIDEBAR";
        $page['load']['sidebarIn']['website']['content'][$i]['refer']                     = "function";
        $page['load']['sidebarIn']['website']['content'][$i]['class']                     = "LOAD_APP|";
        $page['load']['sidebarIn']['website']['content'][$i]['function']                  = "menu_";
        $page['load']['sidebarIn']['website']['content'][$i]['get_row']['database_refer'] = "Workspace";
        return $page;
    }
    public static function menu_basic()
    {
        //nama/link/icon
        $menu = [
            ["group", "Setting"],
            ["menu", "Dashboard", ["Workspace", "dashboard", "view_layout", "ID_BOARD|", -1, -1, "ID_BOARD|"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "Workspace", ["Workspace", "informasi", "edit", "ID_BOARD|", -1, -1, "ID_BOARD|"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "List User ", ["Workspace", "user_list", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "Entitas", ["Workspace", "entitas", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "Group Role", ["Workspace", "group_role", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "Akses Role", ["Workspace", "akses_role", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "User Role", ["Workspace", "user_role", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["group", "Data Menu"],
            ["menu", "List Aplikasi", ["Workspace", "list_apps", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "List Menu", ["Workspace", "list_menu", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ["menu", "Pengajuan Penambahan Menu", ["Workspace", "web_list_apps_board", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
        ];

        return $menu;
    }
    public static function admin($page)
    {
        return Workspace::user_role($page);
    }
    public static function user_role($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", "User Role"));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        //
        $database_utama = "web__list_apps_board__role__user";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],
            ["user", null, "select", ["apps_user", 'id_apps_user', "nama_lengkap"], null],
            ["Role", null, "select", ["web__list_apps_board__role__akses", null, "nama_role"], null],
        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['database']['where'][]                                                  = ["web__list_apps_board__role__user.id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_role']['where'][]                 = ["id_web__list_apps_board", '=', "ID_BOARD|"];
        }
        $page['get']['sidebarIn'] = true;
        return $page;
    }

    public static function informasi($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", "User Role"));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        //
        $database_utama = "web__list_apps_board";
        $primary_key    = null;

        $array = [
            ["Nama Board", null, "text"],
            ["Kode Board", null, "text"],
            ["Deskripsi", null, "text"],
            ["Barcode", null, "text"],
            ["Single Toko", null, "select", ["store__toko", '', "nama_toko"]],
            ["Panel Utama", null, "select", ["panel", '', "nama_panel"]],
            // array("apps", null, "select", array("web__list_apps", '', "nama_apps"), null),
        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
        }
        $page['get']['sidebarIn'] = true;
        return $page;
    }

    public static function list_apps($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", "User Role"));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        //
        $database_utama = "web__list_apps_board__apps";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],
            ["apps", null, "select", ["web__list_apps", '', "nama_apps"], null],
        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
        }
        $page['get']['sidebarIn'] = true;
        return $page;
    }
    public static function list_menu($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", "User Role"));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        //
        $database_utama = "web__list_apps_board__menu";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],
            ["apps menu", null, "select", ["web__list_apps_menu", '', "nama_menu"], null],
        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
        }
        $page['get']['sidebarIn'] = true;
        return $page;
    }
    public static function user_list($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", "User Role"));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        //
        $database_utama = "web__list_apps_board__user_list";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],
            ["User", null, "select", ["apps_user", 'id_apps_user', "nama_lengkap"], null],
        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['database']['where'][]                                                  = ["web__list_apps_board__user_list.id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_role']['where'][]                 = ["id_web__list_apps_board", '=', "ID_BOARD|"];
        }
        $page['get']['sidebarIn'] = true;
        return $page;
    }
    public static function entitas($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        $database_utama = "web__list_apps_board__entitas";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select-req", ["web__list_apps_board", null, "nama_board"]],
            ["Organisasi", "id_organisasi", "select-req", ["organisasi", null, "nama_organisasi"], null],
            ["Semua Anggota", "semua_anggota", "select-manual", ["1" => "Ya", 2 => "Divisi Tertentu"], null],
        ];
        $search               = [];
        $sub_kategori[]       = ["Divisi", $database_utama . "__divisi", null, "table"];
        $array_sub_kategori[] = [
            ["divisi", null, "select", ["hcms__struktur__divisi", null, "nama_divisi"]],
            ["Keanggotaan Workspace", null, "select-manual-req", [1 => "Ya", 2 => "Tidak"]],

        ];
        $page['crud']['field_view_sub_kategori']['id_organisasi']['type']                    = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['id_organisasi']['target']                  = "" . $database_utama . "__divisi";
        $page['crud']['field_view_sub_kategori']['id_organisasi']['target_no']               = 0;
        $page['crud']['field_view_sub_kategori']['id_organisasi']['database']['utama']       = "hcms__struktur__divisi";
        $page['crud']['field_view_sub_kategori']['id_organisasi']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['id_organisasi']['database']['select_raw']  = "*";
        $page['crud']['field_view_sub_kategori']['id_organisasi']['database']['where'][]     = ['active', '=', "1"];
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__bahan_baku__offline__request_outgoing","erp__bahan_baku__offline__request_outgoing_seq","erp__bahan_baku__offline__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['id_organisasi']['request_where'] = "id_organisasi";
        // $page['crud']['field_view_sub_kategori']['id_file']['insert_default_value_sub_kategori_request']["" . $database_utama . "__tag"]['id_file'] = 'value';

        $page['crud']['field_view_sub_kategori']['id_organisasi']['field'][] = [
            -1,
            "id_divisi",                                                                                  // sesuaikan dengan id di subkategori
            ["divisi", "nama_divisi", "text", ["hcms__struktur__divisi", null, "nama_divisi", "divisi"]], //untuk ditampilkan
            "id",                                                                                         //ambil value get
        ];
        $page['crud']['field_view_sub_kategori']['id_organisasi']['field'][] = [
            0,
            "keanggotaan_workspace", // sesuaikan dengan id di subkategori
            ["Keanggotaan Workspace", null, "select-manual-req", [1 => "Ya", 2 => "Tidak"]],

        ];

        $page['crud']['no_action']["" . $database_utama . "__tag"] = true;
        $page['crud']['sub_kategori']                              = $sub_kategori;
        $page['crud']['array_sub_kategori']                        = $array_sub_kategori;
        $page['crud']['array']                                     = $array;
        $page['crud']['search']                                    = $search;
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['database']['where'][]                                                  = ["id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['database']['where'][]                                                  = ["id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
        }

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['get']['sidebarIn']        = true;

        return $page;
    }
    public static function group_role($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        $database_utama = "web__list_apps_board__role__group";
        $primary_key    = null;

        $array = [
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],
            ["Nama Role Group", null, "text"],

        ];
        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['database']['where'][]                                                  = ["id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['database']['where'][]                                                  = ["id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
        }
        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['get']['sidebarIn']        = true;
        return $page;
    }
    public static function akses_role($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        $database_utama = "web__list_apps_board__role__akses";
        $primary_key    = "id";

        $array = [
            // array("ID", "get_primary_key", "text-list"),
            ["Workspace", "id_web__list_apps_board", "select", ["web__list_apps_board", null, "nama_board"]],

            ["role group", null, "select", ["web__list_apps_board__role__group", null, "nama_role_group"], null],
            ["Nama Role", null, "text"],
            ["First Akses Role", null, "select", ["web__list_apps_menu", null, "nama_menu"], 'nama_menu'],
            ["Page", null, "select-manual", ["Frontend" => "Frontend", "Backend" => "Backend", "Super Admin" => "Super Admin"]],
            ["Template Base", null, "select-manual", ["Default" => "Default", "Costum Template" => "Costum Template"]],
            ["Semua Menu", null, "select-manual", ["1" => "ya", "0" => "Tidak"]],
            ["Template", null, "select", ["website__template__list", null, 'nama_template']],

        ];
        $page['crud']['select_database_costum']['first_akses_role']['select'][]      = "*,concat(ambil_dari,' > ',(case when kode_link is not null then concat(kode_link,'_',(select kode_webapps from web__apps where web__list_apps_menu.id_web_apps = web__apps.id )) when struktur_menu is null then concat(web__list_apps_menu.nama_menu,' > ',load_apps,' > ',load_page_view) else web__list_apps_menu.struktur_menu end)) as nama_menu";
        $page['crud']['select_database_costum']['first_akses_role']['order_by'][]    = ["loadx_apps", "asc"];
        $page['crud']['select_database_costum']['first_akses_role']['order_by'][]    = ["struktur_menu", "asc"];
        $page['crud']['select_database_costum']['first_akses_role']['non_privilage'] = true;
        $search                                                                      = [];
        $sub_kategori[]                                                              = ["menu_akses", $database_utama . "__menu", null, "table"];
        $array_sub_kategori[]                                                        = [
            ["Menu", "menu", "select", ["web__list_apps_menu", null, "struktur_menu"], null],
            ["Akses Menu", null, "select-manual", ["Tidak", "Ya"]],
            ["Tambah", null, "select-manual", ["Tidak", "Ya"]],
            ["Edit", null, "select-manual", ["Tidak", "Ya"]],
            ["Hapus", null, "select-manual", ["Tidak", "Ya"]],
            ["Setting", null, "select-manual", ["Tidak", "Ya"]],
            ["PDF", null, "select-manual", ["Tidak", "Ya"]],
            ["Excel", null, "select-manual", ["Tidak", "Ya"]],
            ["Import", null, "select-manual", ["Tidak", "Ya"]],

        ];

        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['target_no_sub_kategori']  = 0;
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['input_row']               = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['input']                   = "Search ";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['database']['select']      = ["*", "concat(ambil_dari,' > ',(case when kode_link is not null then concat(kode_link,'_',(select kode_webapps from web__apps where web__list_apps_menu.id_web_apps = web__apps.id )) when struktur_menu is null then concat(web__list_apps_menu.nama_menu,' > ',load_apps,' > ',load_page_view) else web__list_apps_menu.struktur_menu end)) as nama_menu"];
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['database']['utama']       = "web__list_apps_menu";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['database']['primary_key'] = null;

        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['search']       = "primary_key";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['search_row']   = ["load_apps", "load_page_view", 'struktur_menu', 'nama_menu', 'kode_link'];
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['array_detail'] = [

            "nama_menu" => "Struktur Menu",
        ];
        $page['crud']['search_load_sub_kategori'][$database_utama . "__menu"]['array_result'] =
            [
            "id_menu"    => ["row" => "primary_key", "type" => "database"],
            "akses_menu" => ["text" => 1, "type" => "text"],
        ];

        $page['crud']['sub_kategori']            = $sub_kategori;
        $page['crud']['array_sub_kategori']      = $array_sub_kategori;
        $page['crud']['array']                   = $array;
        $page['crud']['search']                  = $search;
        $page['crud']['crud_inline']['id_menu']  = "style='width:100%'";
        $page['crud']['costum_class']['id_menu'] = "text-nowrap";
        if (! in_array($page['load']['board'] ?? -1, [-1, null])) {
            $page['crud']['insert_value']['id_web__list_apps_board']                      = "ID_BOARD|";
            $page['crud']['crud_inline']['id_web__list_apps_board']                       = " read-only ";
            $page['database']['where'][]                                                  = ["web__list_apps_board__role__akses.id_web__list_apps_board", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_web__list_apps_board']['where'][] = ["id", '=', "ID_BOARD|"];
            $page['crud']['select_database_costum']['id_role_group']['where'][]           = ["id_web__list_apps_board", '=', "ID_BOARD|"];
        }
        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = [" $database_utama.$primary_key as primary_key,$database_utama.$primary_key as get_primary_key"];
        $page['database']['join']        = [];
        $page['get']['sidebarIn']        = true;
        return $page;
    }
}
trait Workspace_bisnis
{
    public function menu_bisnis()
    {

        //nama/link/icon
        $menu = [
            ["menu", "Dashboard", ["Workspace", "bisnis_dashboard", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            [
                "group",
                "Pesanan",
                [
                    ["menu", "Pesanan", ["Workspace", "bisnis_pesanan", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Barang Keluar", ["Workspace", "bisnis_barang_keluar", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Pembayaran", ["Workspace", "bisnis_pembayaran", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Pengiriman", ["Workspace", "bisnis_pengiriman", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Pembatalan", array("Workspace", "pembatalan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pengembalian", array("Workspace", "Pengembalian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                ],
            ],
            [
                "group",
                "Produk",
                [
                    ["menu", "Kategori ", ["Workspace", "bisnis_kategori_produk", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Brand ", ["Workspace", "bisnis_brand", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Tipe Varian ", ["Workspace", "bisnis_tipe_varian", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Produk", ["Workspace", "bisnis_produk", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Bundle Harga ", array("Workspace", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ],
            ],
            [
                "group",
                "Toko",
                [
                    ["menu", "Profil Toko ", ["Workspace", "bisnis_promo_toko", "edit", "WORKSPACE_SINGLE_TOKO|", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Mitra", array("Workspace", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ],
            ],
            [
                "group",
                "Promosi",
                [
                    ["menu", "Promo Toko", ["Workspace", "promo_toko", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Voucher", ["Workspace", "voucher", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],
            [
                "group",
                "Inventory",
                [
                    ["menu", "Gudang", ["Workspace", "gudang", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Kartu Stok", ["Workspace", "Kartu Stok", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Stok Opname", ["Workspace", "Stop_opname", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],
            [
                "group",
                "Mitra",
                [
                    ["menu", "Master Mitra", ["Workspace", "master_mitra", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Data mitra", ["Workspace", "Stok", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],
            [
                "group",
                "Setting",
                [
                    ["menu", "Home Banner Utama ", ["Workspace", "setting_banner_utama", "edit", "id_web__apps|", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Kontak Kami ", ["Workspace", "setting_contact_us", "edit", "id_web__apps|", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Mitra", array("Workspace", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                ],
            ],
            [
                "group",
                "Laporan",
                [
                    ["menu", "Laporan Penjualan Mitra", ["Workspace", "laporan_penjualan_mitra", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Laporan Perbandingan Harga", ["Workspace", "laporan_", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],

            // array(
            //     "group", "Keuangan", array(
            //         array("menu", "Penghasilan ", array("Workspace", "penghasilan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Saldo Saya", array("Workspace", "saldo_saya", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Rekening Bank", array("Workspace", "rekening_bang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),

            // array(
            //     "group", "Setting", array(
            //         array("menu", "Payment", array("Workspace", "Payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //         array("menu", "Shiping", array("Workspace", "shiping", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            //     ),
            // ),

        ];

        return $menu;
    }
    public function menu_food()
    {
        $menu = [
            ["menu", "Dashboard Food", ["Workspace", "food_dashboard", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],

            [
                "group",
                "Master Data",
                [
                    ["menu", "Unit/Satuan", ["Workspace", "satuan", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Konversi", ["Workspace", "conversi", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Bahan Baku", ["Workspace", "rmw_material", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Komposisi Barang", ["Workspace", "rmw_komposisi", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Produk", ["Workspace", "food_produk", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],
            ["group", "Raw Material", [

                ["menu", "Belanja Bahan Baku", ["Workspace", "rmw_pesanan", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ["menu", "Mutasi Masuk Belanja", ["Workspace", "rmw_receive", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ["menu", "Barang Habis Pakai", ["Workspace", "rmw_comsumable", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ]],
            [
                "group",
                "Penjualan",
                [
                    ["menu", "Kasir", ["Workspace", "bisnis_pesanan", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Barang Keluar", array("Workspace", "bisnis_barang_keluar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pembayaran", array("Workspace", "bisnis_pembayaran", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pengiriman", array("Workspace", "bisnis_pengiriman", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pembatalan", array("Workspace", "pembatalan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pengembalian", array("Workspace", "Pengembalian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                ],
            ],
        ];
        return $menu;
    }
    public function menu_share()
    {
        $menu = [
            ["menu", "Dashboard Food", ["Workspace", "food_dashboard", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],

            [
                "group",
                "Master Data",
                [
                    ["menu", "Unit/Satuan", ["Workspace", "satuan", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Konversi", ["Workspace", "conversi", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Bahan Baku", ["Workspace", "rmw_material", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Komposisi Barang", ["Workspace", "rmw_komposisi", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    ["menu", "Produk", ["Workspace", "food_produk", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ],
            ],
            ["group", "Raw Material", [

                ["menu", "Belanja Bahan Baku", ["Workspace", "rmw_pesanan", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ["menu", "Mutasi Masuk Belanja", ["Workspace", "rmw_receive", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                ["menu", "Barang Habis Pakai", ["Workspace", "rmw_comsumable", "list", "-1"], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
            ]],
            [
                "group",
                "Penjualan",
                [
                    ["menu", "Kasir", ["Workspace", "bisnis_pesanan", "list", "-1", -1, -1, 'ID_BOARD|'], '<i class="menu-icon tf-icons bx bx-collection"></i>'],
                    // array("menu", "Barang Keluar", array("Workspace", "bisnis_barang_keluar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pembayaran", array("Workspace", "bisnis_pembayaran", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pengiriman", array("Workspace", "bisnis_pengiriman", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pembatalan", array("Workspace", "pembatalan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    // array("menu", "Pengembalian", array("Workspace", "Pengembalian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                ],
            ],
        ];
        return $menu;
    }

    //Inventaris_aset

    public static function bisnis_dashboard($page)
    {

        $sql                               = DatabaseFunc::dashboard_pesanan_erp_pos($page);
        $db['query']                       = $sql;
        $get                               = Database::database_coverter($page, $db, [], 'all');
        $data1                             = new stdClass();
        $data1->count_belum_bayar          = $get['row'][0]->count_belum_bayar;
        $data1->count_perlu_proses         = $get['row'][0]->count_perlu_proses;
        $data1->count_perlu_kirim          = $get['row'][0]->count_perlu_kirim;
        $data1->count_menunggu_pickup      = $get['row'][0]->count_menunggu_pickup;
        $data2                             = new stdClass();
        $data2->omzet                      = $get['row'][0]->omzet;
        $data2->omzet_ditahan              = $get['row'][0]->omzet_ditahan;
        $data2->saldo                      = 0;
        $data2->rata_rata                  = 0;
        $i                                 = 0;
        $website['content'][$i]['tag']     = "BE3-EC-D1";
        $website['content'][$i]['col_row'] = "col-md-12";
        $website['content'][$i]['data']    = $data1;

        $i++;
        $website['content'][$i]['tag']     = "BE3-EC-D3";
        $website['content'][$i]['col_row'] = "col-lg-6 col-md-12 col-sm-12";
        $website['content'][$i]['data']    = $data2;
        $i++;
        $website['content'][$i]['tag']                 = "BE3-E-BOX";
        $website['content'][$i]['col_row']             = "col-lg-6 col-md-12 ";
        $website['content'][$i]['array'][0]['text']    = "Pesanan Selesai";
        $website['content'][$i]['array'][0]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][0]['value']   = $get['row'][0]->pesanan_selesai;
        $website['content'][$i]['array'][1]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][1]['text']    = "Pesanan Proses";
        $website['content'][$i]['array'][1]['value']   = $get['row'][0]->pesanan_proses;

        $website['content'][$i]['array'][2]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][2]['text']    = "Barang Terjual";
        $website['content'][$i]['array'][2]['value']   = $get['row'][0]->qty_terjual;
        $website['content'][$i]['array'][3]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][3]['text']    = "Barang Terkirim";
        $website['content'][$i]['array'][3]['value']   = $get['row'][0]->qty_terkirim;

        $i++;
        // $website['content'][$i]['tag'] = "BE3-EC-D2";
        // $website['content'][$i]['col_row'] = "col-md-6";
        // $i++;

        // $website['content'][$i]['tag'] = "BE3-W-VB1";
        // $website['content'][$i]['col_row'] = "col-md-6";
        // $i++;
        // $website['content'][$i]['tag'] = "BE3-W-VB2";
        // $website['content'][$i]['col_row'] = "col-md-6";

        $page['view_layout'][] = ["website", "col-md-12", $website];
        return $page;
    }
    public static function home_ecommerce($page)
    {
        $i                                           = 0;
        $website['content'][$i]['tag']               = "BANNER";
        $website['content'][$i]['content_source']    = "template_content";
        $website['content'][$i]['template_class']    = "hibe3";
        $website['content'][$i]['template_function'] = "moesneeds_home_banner";

        $i++;
        $website['content'][$i]['tag']            = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "hibe3";
        // $website['content'][$i]['db_list'] = "home_banner";
        //$website['content'][$i]['template_function'] = "job-search-platform-ui";
        $website['content'][$i]['template_function'] = "ecommerce-terbaru";
        $i++;
        $website['content'][$i]['tag']            = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "hibe3";
        // $website['content'][$i]['db_list'] = "home_banner";
        //$website['content'][$i]['template_function'] = "job-search-platform-ui";
        $website['content'][$i]['template_function'] = "ecommerce-terlaris";
        $i++;
        $website['content'][$i]['tag']            = "BANNER";
        $website['content'][$i]['content_source'] = "html";
        $website['content'][$i]['template_name']  = "";
        $website['content'][$i]['html']           = '<style>
        .loadMore {
  text-align: center;
}
.loadMore__btn {
  display: inline-block;
  padding: 10px 30px;
  color: #000;
  text-decoration: none;
  text-transform: uppercase;
  border: 1px solid #000;
}
  </style>
        <div class="loadMore w-100"><a ' . ($page['section'] == 'generate' ? '' : Partial::link_direct($page, $page['load']['link_route'], [
            "0" => "Ecommerce",
            "1" => "list",
            "2" => "view_layout",
            "3" => "-1",
            "4" => "",
            "5" => "",
            "6" => "",
            "7" => "Frontend",
            "8" => "controller",
            "9" => "",
        ])) . ' class="loadMore__btn" id="loadMore__btn">Load more item</a></div>';

        $page['view_layout'][] = ["website", "col-md-12", $website];
        return $page;
    }
    public static function belanja_ecommerce($page)
    {
        $i = 0;

        $website['content'][$i]['tag']            = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "codepen";
        // $website['content'][$i]['db_list'] = "home_banner";
        $website['content'][$i]['template_function'] = "job-search-platform-ui";

        $page['view_layout'][] = ["website", "col-md-12", $website];
        return $page;
    }
    public static function kontak_kami($page)
    {
        $i                                           = 0;
        $website['content'][$i]['tag']               = "BANNER";
        $website['content'][$i]['content_source']    = "template_content";
        $website['content'][$i]['template_class']    = "hibe3";
        $website['content'][$i]['template_function'] = "kontak_kami";

        $page['view_layout'][] = ["website", "col-md-12", $website];
        return $page;
    }
    public static function food_dashboard($page)
    {

        $sql                               = DatabaseFunc::dashboard_pesanan_erp_pos($page);
        $db['query']                       = $sql;
        $get                               = Database::database_coverter($page, $db, [], 'all');
        $data1                             = new stdClass();
        $data1->count_belum_bayar          = $get['row'][0]->count_belum_bayar;
        $data1->count_perlu_proses         = $get['row'][0]->count_perlu_proses;
        $data1->count_perlu_kirim          = $get['row'][0]->count_perlu_kirim;
        $data1->count_menunggu_pickup      = $get['row'][0]->count_menunggu_pickup;
        $data2                             = new stdClass();
        $data2->omzet                      = $get['row'][0]->omzet;
        $data2->omzet_ditahan              = $get['row'][0]->omzet_ditahan;
        $data2->saldo                      = 0;
        $data2->rata_rata                  = 0;
        $i                                 = 0;
        $website['content'][$i]['tag']     = "BE3-EC-D1";
        $website['content'][$i]['col_row'] = "col-md-12";
        $website['content'][$i]['data']    = $data1;

        $i++;
        $website['content'][$i]['tag']     = "BE3-EC-D3";
        $website['content'][$i]['col_row'] = "col-lg-6 col-md-12 col-sm-12";
        $website['content'][$i]['data']    = $data2;
        $i++;
        $website['content'][$i]['tag']                 = "BE3-E-BOX";
        $website['content'][$i]['col_row']             = "col-lg-6 col-md-12 ";
        $website['content'][$i]['array'][0]['text']    = "Pesanan Selesai";
        $website['content'][$i]['array'][0]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][0]['value']   = $get['row'][0]->pesanan_selesai;
        $website['content'][$i]['array'][1]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][1]['text']    = "Pesanan Proses";
        $website['content'][$i]['array'][1]['value']   = $get['row'][0]->pesanan_proses;

        $website['content'][$i]['array'][2]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][2]['text']    = "Barang Terjual";
        $website['content'][$i]['array'][2]['value']   = $get['row'][0]->qty_terjual;
        $website['content'][$i]['array'][3]['col_row'] = "col-lg-6 col-md-6 col-sm-12 mb-4";
        $website['content'][$i]['array'][3]['text']    = "Barang Terkirim";
        $website['content'][$i]['array'][3]['value']   = $get['row'][0]->qty_terkirim;

        $i++;
        // $website['content'][$i]['tag'] = "BE3-EC-D2";
        // $website['content'][$i]['col_row'] = "col-md-6";
        // $i++;

        // $website['content'][$i]['tag'] = "BE3-W-VB1";
        // $website['content'][$i]['col_row'] = "col-md-6";
        // $i++;
        // $website['content'][$i]['tag'] = "BE3-W-VB2";
        // $website['content'][$i]['col_row'] = "col-md-6";

        $page['view_layout'][] = ["website", "col-md-12", $website];
        return $page;
    }
    public static function satuan($page)
    {
        return Pages::Apps('webmaster', 'satuan');
    }
    public static function conversi($page)
    {
        return Pages::Apps('webmaster', 'conversi');
    }
    public static function rmw_material($page)
    {
        $page = Pages::Apps('Inventaris_aset', 'asset_list', $page);
        return $page;
    }
    public static function rmw_pesanan($page)
    {
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Offline', 'sales_order', 'pos_full', 'penjual');
        return $page;
    }
    public static function setting_pembayaran($page)
    {
        $page = Pages::Apps('Webmaster', 'payment_webapps', $page);
        return $page;
    }
    public static function apps_user($page)
    {
        $page = Pages::Apps('User', 'utama', $page);
        return $page;
    }
    public static function ethica_api($page)
    {
        /*
        DB::table('api_master__user');
        DB::joinRaw('api_master__list on id_api =api_master__list.id ');
        DB::whereRawPage($page, "kode_api_master = 'EthicaApi'  and id_web__list_apps_board=ID_BOARD|");
        $Get = DB::get('all');

        if ($Get['num_rows'] == 0) {
            echo $GET['num_rows'];
            die;
            $sqli['id_api'] = 1;
            $sqli['id_panel'] = 'ID_PANEL|';
            $sqli['id_web__list_apps_board'] = 'ID_BOARD|';
            $insert_last = CRUDFunc::crud_insert($page['fai'], $page, $sqli, [], 'api_master__user');
        } else {
            $insert_last = $Get['row'][0]->id;
        }
        $sqli = [];
        DB::selectRaw('*,api_master__sync.id as primary_key');
        DB::table('api_master__sync');
        DB::joinRaw('api_master__link on id_link =api_master__link.id ');
        DB::joinRaw('api_master__list on id_api =api_master__list.id ');
        DB::whereRawPage($page, "kode_api_master = 'EthicaApi' ");
        $Get = DB::get('all');
        if ($Get['num_rows']) {
            foreach ($Get['row'] as $row) {

                DB::table('api_master__user__sync');
                DB::whereRawPage($page, "id_sync=$row->primary_key and id_api_master__user= $insert_last");
                $Get = DB::get('all');
                if (!$Get['num_rows']) {
                    $sqli = [];
                    $sqli['id_sync'] = $row->primary_key;
                    $sqli['digunakan'] = 1;
                    $sqli['id_api_master__user'] = $insert_last;
                    CRUDFunc::crud_insert($page['fai'], $page, $sqli, [], 'api_master__user__sync');
                }
            }
        }
        DB::selectRaw('*,api_master__list__field.id as primary_key');
        DB::table('api_master__list__field');
        DB::joinRaw('api_master__list on id_api_master__list =api_master__list.id ');
        DB::whereRawPage($page, "kode_api_master = 'EthicaApi' ");
        $Get = DB::get('all');
        if ($Get['num_rows']) {
            foreach ($Get['row'] as $row) {

                DB::table('api_master__user__content');
                DB::whereRawPage($page, "id_api_field=$row->primary_key and id_api_master__user= $insert_last");
                $Get2 = DB::get('all');
                if (!$Get2['num_rows']) {
                    $sqli2['id_api_field'] = $row->primary_key;
                    $sqli2['id_api_master__user'] = $insert_last;
                    CRUDFunc::crud_insert($page['fai'], $page, $sqli2, [], 'api_master__user__content');
                }
            }
        }
        // $page['load']['type'] = "edit";
		*/
        $page['api_user']['id']                                   = 1;
        $id_sync                                                  = 1;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : Per Sarimbit";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";

        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_sarimbit";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nama Sarimbit", "nama_sarimbit", "text"],
            ["List Sarimbit", "list_sarimbit", "text"],
            ["Stok", "stok", "text"],
            ["Aksi", "aksi", "text"],
        ];
        $id_sync                                                  = 2;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : Per Artikel";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_artikel";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nama Artikel", "nama_artikel", "text"],

            ["Stok", "stok", "text"],
            ["Aksi", "aksi", "text"],
        ];

        $id_sync                                                  = 8;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api Pre Order : Per Artikel";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_artikel_preorder";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nama Artikel", "nama_artikel", "text"],

            ["Stok", "stok", "text"],
            ["Aksi", "aksi", "text"],
        ];
        $id_sync                                                  = 3;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : Per Artikel dan Warna";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_artikel_warna";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nama Artikel & Warna", "nama_artikel", "text"],

            ["Stok", "stok", "text"],
            ["Aksi", "aksi", "text"],
        ];
        $id_sync                                                  = 4;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : Per Barang";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_barang";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nama Barang", "nama_barang", "text"],

            ["Stok", "stok", "text"],
            ["Aksi", "aksi", "text"],
        ];
        $id_sync                                                  = 6;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : List Cart";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_cart";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nomor Sales Order", "nomor_sales_order", "text"],
            ["Nama lengkap", "nama_lengkap", "text"],
            ["Varian", "varian", "text"],
            ["Qty Pesanan", "qty_pesanan", "text"],
            ["Status Cart", "status_cart", "text"],
            ["Response", "response", "text"],
            ["Aksi", "aksi", "text"],
        ];

        $id_sync                                                  = 9;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api  Pre Order: List Cart";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_cart_preorder";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nomor Sales Order", "nomor_sales_order", "text"],
            ["Nama lengkap", "nama_lengkap", "text"],
            ["Varian", "varian", "text"],
            ["Qty Pesanan", "qty_pesanan", "text"],
            ["Status Cart", "status_cart", "text"],
            ["Response", "response", "text"],
            ["Aksi", "aksi", "text"],
        ];

        $id_sync                                                  = 7;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api : List Order";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_order";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nomor Sales Order", "nomor_sales_order", "text"],
            ["Detail", "detail", "text"],
            ["Barang", "Barang", "text"],
            ["Status Sync Pesanan", "status_sync_pesanan", "text"],
            ["Response", "response", "text"],

            ["Aksi", "aksi", "text"],
        ];
        $id_sync                                                  = 10;
        $page['api_user']['sync'][$id_sync]["title"]              = "Ethica Api  Pre Order: List Order";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["type"] = "int_external";
        $page['api_user']['sync'][$id_sync]["backendUrl"]["link"] = "get_list_ethica_order_preorder";
        $page['api_user']['sync'][$id_sync]["crud"]["no_action"]  = true;
        $page['api_user']['sync'][$id_sync]["crud"]["array"]      = [
            ["Nomor Sales Order", "nomor_sales_order", "text"],
            ["Detail", "detail", "text"],
            ["Barang", "Barang", "text"],
            ["Status Sync Pesanan", "status_sync_pesanan", "text"],
            ["Response", "response", "text"],

            ["Aksi", "aksi", "text"],
        ];

        return $page;
    }
    public static function konfirmasi_pembayaran($page)
    {
        $page['title']      = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        $database_utama = "erp__pos__payment__bayar__konfirm";
        $primary_key    = null;

        $array = [
            ["Pembayaran", "id_erp__pos__payment__bayar", "select", ['erp__pos__payment__bayar', null, 'jumlah_bayar'], null],

            ["Informasi pembayaran", null, "div"],
            ["Nama Rekening Pengirim", null, "text"],
            ["Nomor rekening Pengirim", "", "text"],
            ["Tanggal Pembayaran", "", "date"],
            ["Catatan", "", "text"],
            ["Status Approve", "", "select-manual", ["Setujui" => "Setujui", "Tolak" => "Tolak", "Kekurangan Bayar" => "Kekurangan Bayar"]],

            ["Kekuranngan Bayar", "", "number"],

        ];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = [];

        $page['database']['utama']       = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select']      = ["*"];
        $page['database']['join']        = [];
        $page['database']['where']       = [];
        // $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function bisnis_produk($page_temp)
    {
        $page['title'] = "Produk";
        if (! isset($_POST['contentfaiframework'])) {
            $page['route'] = __FUNCTION__;
        }

        $page['crud']['layout_pdf'] = ['a4', 'landscape'];
        $page['crud']['form_type']  = 2;
        $database_utama             = "inventaris__asset__list";
        $primary_key                = null;

        $array = [
            ["Panel", "id_panel", "select", ["panel", null, "nama_panel"]],
            ["Toko", "toko", "select", ['store__toko', null, 'nama_toko'], null],
            // array("Tipe Barang", "tipe_barang_", "select-manual", array("Utama" => "Utama", "Reseller" => "Reseller")),

            // array("Asset", "jenis_asset", "select", array("inventaris__asset__master__jenis", null, "nama_jenis_asset"), null),
            // array("Tipe Barang", "tipe_barang", "select-manual", array("Barang Produksi" => "Barang Produksi", "Barang Kebutuhan Pokok" => "Barang Kebutuhan Pokok", "Barang Kepemilikan Hasil Pembelian" => "Barang Kepemilikan Hasil Pembelian", "Barang Kredit Berjalan " => "Barang Kredit Berjalan", "Barang Peminjaman" => "Barang Peminjaman", "Barang Distributor" => "Barang Kerjasama Distributor")),
            // array("Jual Aset barang", null, "select-manual", array("Ya" => "Ya", "Tidak" => "Tidak")),

            ["Kategori Produk", "kategori", "select", ["webmaster__inventaris__master__kategori", null, "nama_kategori"], null],
            ["Kategori Toko", "kategori_toko", "select", ["inventaris__asset__master__kategori_toko", null, "nama_kategori"], null],
            ["Brand/Merek", "brand", "select", ["outsourcing__brand", null, "nama_brand"], null],
            ["Nama Produk", "nama_barang", "text"],
            ["Kode Produk", "kode_barang", "text-kode", ["array" => "one", "tipe" => "count", "prefix" => "INV.P.", "suffix" => "", "sprintf_number" => "5", ""]],
            ["SKU Index", "sku", "text"],
            ["Barcode", "barcode", "text"],
            ["Peruntukan Pemakaian", "peruntukan", "select-manual", ["Pria" => "Pria", "Wanita" => "Wanita", "Pria Wanita" => "Pria Wanita", "Lainnya" => "Lainnya"]],
            ["Berat(gr)", "berat", "number"],
            ["Panjang Barang", null, "number"],
            ["Lebar Barang", null, "number"],
            ["Tinggi Barang", null, "number"],

            ["Foto Utama", "foto_aset", "photos", "inventaris/aset/barang"],
            ["Foto", "foto", "file-upload", "inventaris/aset/barang"],
            ["Video", "video_aset", "video", "inventaris/aset/barang"],
            ["Deskripsi barang", "deskripsi_barang", "textarea"],

            ["Variansi Barang", "varian_barang", "select-manual", ["1" => "Ya", "2" => "Tidak"]],
            ["Jumlah Barang(stok)", "kuantitas", "number"],
            ["Harga Beli", "harga_beli", "number"],
            ["Harga Pokok Jual", "harga_pokok", "number"],
            ["Kondisi", "kondisi", "radio2-manual", ["1" => "Baru", "2" => "Bekas"]],
            ["Status Order", "status_pre_order", "radio2-manual", ["1" => "Ya", "2" => "Tidak"]],
            ["Jumlah Hari Pre Order", "jumlah_hari_pre_order", "number"],
            ["Status Publish", "status_publish", "select-manual", [1 => "Publish", 2 => "Scheduled", 3 => "Non Publish"]],
            ["Tanggal Publish", "tgl_publish", "date"],
        ];
        $page['crud']['select_database_costum']['id_brand']['where'][]        = ["jenis_toko", "=", "'Brand'"];
        $card_1                                                               = "Informasi Dasar";
        $page['crud']['costum_view']['box'][1]['row']                         = "col-md-8";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['row']     = "col-md-12";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "nama_barang";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "kode_barang";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "deskripsi_barang";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "varian_barang";

        $card_1                                                                      = "Media";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['row']            = "col-md-12";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][]        = "foto_aset";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][]        = "foto";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][]        = "video_aset";
        $card_1                                                                      = "Varian";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['row']            = "col-md-12";
        $page['crud']['costum_view']['box'][1]['content'][$card_1]['sub_kategori'][] = $database_utama . "__varian";

        $card_1                                                               = "Detail";
        $page['crud']['costum_view']['box'][2]['row']                         = "col-md-4";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']     = "col-md-12";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "id_brand";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "id_kategori";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "id_kategori_toko";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "peruntukan";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "kondisi";
        $card_1                                                               = "Dimensi";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']     = "col-md-12";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "berat";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "panjang_barang";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "lebar_barang";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "tinggi_barang";
        $card_1                                                               = "Publish & Order";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']     = "col-md-12";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "status_pre_order";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "jumlah_hari_pre_order";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "status_publish";
        $page['crud']['costum_view']['box'][2]['content'][$card_1]['array'][] = "tgl_publish";

        $db_toko                                                                                      = "store__produk";
        $page['crud']['split_database']['array']['id_toko']                                           = $db_toko;
        $page['crud']['split_database']['array']['status_pre_order']                                  = $db_toko;
        $page['crud']['split_database']['array']['jumlah_hari_pre_order']                             = $db_toko;
        $page['crud']['split_database']['array']['status_publish']                                    = $db_toko;
        $page['crud']['split_database']['array']['tgl_publish']                                       = $db_toko;
        $page['crud']['split_database']['crud'][$db_toko]['insert_default_value']['tipe_barang_form'] = "Utama";
        $page['crud']['split_database']['crud'][$db_toko]['insert_default_value']['id_toko']          = "WORKSPACE_SINGLE_TOKO|";
        $page['crud']['split_database']['setting'][$db_toko]['koneksi']['row_form_utama']             = "id";
        $page['crud']['split_database']['setting'][$db_toko]['koneksi']['row_form_split']             = "id_asset";
        $page['crud']['split_database']['setting'][$db_toko]['database_to_row_split']                 = "id_asset";
        $page['crud']['split_database']['setting'][$db_toko]['update_to_database_utama']              = [];
        $page['crud']['split_database']['setting'][$db_toko]['insert_to_database_split']              = [];

        $db_toko_varian = "store__produk__varian";

        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['array']['harga_pokok_penjualan_varian'] = $db_toko_varian;
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['array']['id_store__produk']             = $db_toko_varian;
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['array']['id_barang_varian']             = $db_toko_varian;

        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['crud'][$db_toko_varian]['get_last_value']['id_store__produk'] = "store__produk";
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['crud'][$db_toko_varian]['get_last_value']['id_barang_varian'] = $database_utama . "__varian";
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['setting'][$db_toko_varian]['database_to_row_split']           = "id_barang_varian";
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['setting'][$db_toko_varian]['koneksi']['row_form_utama']       = "id";
        $page['crud']['split_database_sub_kategori'][$database_utama . "__varian"]['setting'][$db_toko_varian]['koneksi']['row_form_split']       = "id_barang_varian";

        $page['crud']['col_row']['nama_barang'] = "col-md-6";
        $page['crud']['col_row']['kode_barang'] = "col-md-6";
        $page['crud']['col_row']['sku']         = "col-md-6";
        $page['crud']['col_row']['barcode']     = "col-md-6";
        // $page['crud']['col_row']['berat'] = "col-md-3";
        // $page['crud']['col_row']['panjang_barang'] = "col-md-3";
        // $page['crud']['col_row']['lebar_barang'] = "col-md-3";
        // $page['crud']['col_row']['tinggi_barang'] = "col-md-3";
        $page['crud']['input_group']['suffix']['berat']           = "Gram";
        $page['crud']['insert_default_value']['jenis_barang']     = "Barang Jadi";
        $page['crud']['insert_default_value']['id_jenis_asset']   = "4";
        $page['crud']['insert_default_value']['jual_aset_barang'] = "Ya";
        // $page['crud']['insert_default_value']['varian_barang'] = "1";
        $page['crud']['insert_default_value']['id_toko']  = "WORKSPACE_SINGLE_TOKO|";
        $page['crud']['insert_default_value']['id_panel'] = "WORKSPACE_SINGLE_PANEL|";
        $sub_kategori[]                                   = ["Varian Barang", $database_utama . "__varian", null, "table"];
        $array_sub_kategori[]                             = [
            ["Foto", "foto_aset_varian", "photos", "inventaris/aset/barang"],
            ["Nama Varian", "nama_varian", "text"],
            ["SKU", "sku_index_varian", "text"],
            ["Barcode", "barcode_varian", "text"],
            ["Berat", "berat_varian", "number"],
            ["Harga Pokok Penjualan", "harga_pokok_penjualan_varian", "number-cur"],
            ["Tipe Varian 1", null, "select", ["inventaris__master__tipe_varian", null, "nama_tipe", 'tipe1']],
            ["Varian 1", null, "select", ["inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian1"]],
            ["Tipe Varian 2", null, "select", ["inventaris__master__tipe_varian", null, "nama_tipe", 'tipe2']],
            ["Varian 2", null, "select", ["inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian"]],
            ["Tipe Varian 3", null, "select", ["inventaris__master__tipe_varian", null, "nama_tipe", 'tipe3']],
            ["Varian 3", null, "select", ["inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", "varian3"]],
            // array("Varian 4",null,"text"),
            // array("Varian 5",null,"text"),
            // array("Jumlah Barang(stok)", "kuantitas_varian", "number"),
            // array("Harga Beli", "harga_beli_varian", "number-cur"),
        ];
        // $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "kuantitas_varian";
        // $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "harga_beli_varian";
        $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "harga_pokok_penjualan_varian";
        $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "id_tipe_varian_1";
        $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "id_tipe_varian_2";
        $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "id_tipe_varian_3";
        $page['crud']['all_change_sub_kategori'][$database_utama . "__varian"]['array'][] = "berat_varian";

        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['database']['utama']       = "inventaris__master__tipe_varian__list";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['database']['select_raw']  = "*";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['request_where']           = "id_inventaris__master__tipe_varian";

        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['target'] = "id_varian_1";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['value']  = "primary_key";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_1']['option'] = "nama_list_tipe_varian";

        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['database']['utama']       = "inventaris__master__tipe_varian__list";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['database']['select_raw']  = "*";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['request_where']           = "id_inventaris__master__tipe_varian";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['target']                  = "id_varian_2";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['value']                   = "primary_key";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_2']['option']                  = "nama_list_tipe_varian";

        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['database']['utama']       = "inventaris__master__tipe_varian__list";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['database']['select_raw']  = "*";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['request_where']           = "id_inventaris__master__tipe_varian";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['target']                  = "id_varian_3";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['value']                   = "primary_key";
        $page['crud']['field_value_automatic_select_target']['id_tipe_varian_3']['option']                  = "nama_list_tipe_varian";

        $page['crud']['table_group']['Data Aset'][] = "jenis_asset";
        $page['crud']['table_group']['Data Aset'][] = "kategori";

        $page['crud']['table_group']['Data Barang'][] = "kode_barang";
        $page['crud']['table_group']['Data Barang'][] = "nama_barang";
        $page['crud']['table_group']['Data Barang'][] = "foto_aset";
        // $page['crud']['table_group']['Data Barang'][] = "deskripsi_barang";

        $page['crud']['table_group']['Detail'][] = "brand";
        $page['crud']['table_group']['Detail'][] = "berat";
        $page['crud']['table_group']['Detail'][] = "kisaran_harga_awal";
        $page['crud']['table_group']['Detail'][] = "kisaran_harga_akhir";
        $page['crud']['table_group']['Detail'][] = "peruntukan";

        $page['crud']['table_group']['Keterangan Barang'][] = "tipe_barang";
        $page['crud']['table_group']['Keterangan Barang'][] = "asal_pinjam_dari";
        $page['crud']['table_group']['Keterangan Barang'][] = "distributor";
        $page['crud']['table_group']['Keterangan Barang'][] = "barang_distributor";
        $page['crud']['table_group']['Keterangan Barang'][] = "kuantitas";
        $page['crud']['table_group']['Keterangan Barang'][] = "varian_barang";

        $page['crud']['select_other']['kategori']["get"]        = "from_controller";
        $page['crud']['select_other']['kategori']["controller"] = "Webmaster";
        $page['crud']['select_other']['kategori']["function"]   = "master__kategori";
        $page['crud']['select_other']['kategori']["field"]      = "nama_kategori";

        // $page['crud']['select_other']['id_tipe_varian_1']["get"] = "from_controller";
        // $page['crud']['select_other']['id_tipe_varian_1']["controller"] = "Webmaster";
        // $page['crud']['select_other']['id_tipe_varian_1']["function"] = "master__kategori";
        // $page['crud']['select_other']['id_tipe_varian_1']["field"] = "nama_kategori";

        $page['crud']['hidden_show']['status_pre_order']['onjs']                             = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['status_pre_order']['default']["jumlah_hari_pre_order"] = "hide";

        $page['crud']['hidden_show']['status_pre_order']['value_if']["2"]["jumlah_hari_pre_order"] = "hide";

        $page['crud']['hidden_show']['status_pre_order']['value_if']["1"]["jumlah_hari_pre_order"]                = "show";
        $page['crud']['hidden_show']['varian_barang']['onjs']                                                     = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['varian_barang']['default']["kuantitas"]                                     = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_beli"]                                    = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_pokok_penjualan"]                         = "show";
        $page['crud']['hidden_show']['varian_barang']['default']["harga_pokok_penjualan"]                         = "hide";
        $page['crud']['hidden_show']['varian_barang']['default_sub_kategori'][$database_utama . "__varian"]       = "hide";
        $page['crud']['hidden_show']['varian_barang']['default_sub_kategori'][$database_utama . "__varian_level"] = "hide";

        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["kuantitas"]                                     = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["harga_pokok_penjualan"]                         = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if']["1"]["harga_beli"]                                    = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["1"][$database_utama . "__varian"]       = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["1"][$database_utama . "__varian_level"] = "show";

        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["kuantitas"]             = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["harga_pokok_penjualan"] = "show";
        $page['crud']['hidden_show']['varian_barang']['value_if']["2"]["harga_beli"]            = "show";

        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["2"][$database_utama . "__varian"]       = "hide";
        $page['crud']['hidden_show']['varian_barang']['value_if_sub_kategori']["2"][$database_utama . "__varian_level"] = "hide";

        $page['crud']['hidden_show']['jenis_barang']['default_sub_kategori'][$database_utama . "__baku_baja"]                = "hide";
        $page['crud']['hidden_show']['jenis_barang']['value_if_sub_kategori']["Bahan Baku"][$database_utama . "__baku_baja"] = "show";

        $page['crud']['hidden_show']['tipe_barang']['onjs']                          = "onclick,onkeyup,onchange";
        $page['crud']['hidden_show']['tipe_barang']['default']["distributor"]        = "hide";
        $page['crud']['hidden_show']['tipe_barang']['default']["barang_distributor"] = "hide";
        $page['crud']['hidden_show']['tipe_barang']['default']["asal_pinjam_dari"]   = "hide";

        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["distributor"]        = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["barang_distributor"] = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Distributor"]["asal_pinjam_dari"]   = "hide";

        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["asal_pinjam_dari"]   = "show";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["distributor"]        = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Peminjaman"]["barang_distributor"] = "hide";

        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["asal_pinjam_dari"]   = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["distributor"]        = "hide";
        $page['crud']['hidden_show']['tipe_barang']['value_if']["Barang Kepemilikan Hasil Pembelian"]["barang_distributor"] = "hide";

        // array("Tipe Barang","tipe_barang","select-manual",array("Barang Kebutuhan Pokok"=>"Barang Kebutuhan Pokok",""=>"Barang Kepemilikan Hasil Pembelian","Barang Kredit Berjalan "=>"Barang Kredit Berjalan",""=>"Barang Peminjaman","Barang Distributor"=>"Barang Kerjasama Distributor")),

        $page['crud']['import_export']['setting'][0]['nama_format']          = "Produk Variansi";
        $page['crud']['import_export']['setting'][0]['tipe_data']            = "combine";
        $page['crud']['import_export']['setting'][0]['combine_sub_kategori'] = $database_utama . "__varian";
        //combine = subkategori bercampur dengan utama
        //single = hanya utama saja 

        $page['crud']['import_export']['setting'][0]['format'] =
            [
            "Nama Produk"           => ["nama_barang", 1],
            "Deskripsi Barang"      => ["deskripsi_barang", 1],
            "Brand/merek"           => ["id_brand", 1],
            "Kategori"              => ["id_kategori", 1],
            "Peruntukan Pemakaian"  => ["peruntukan", 1],
            "Kondisi"               => ["kondisi", 1],
            "Berat(gr)"             => ["berat", 1],
            "Panjang Barang"        => ["panjang_barang", 1],
            "Lebar Barang"          => ["lebar_barang", 1],
            "Tinggi Barang"         => ["tinggi_barang", 1],
            "Foto Utama"            => ["foto_aset", 1],
            "Video"                 => ["video_aset", 1],
            "Foto 1"                => ["foto", 1],
            "Foto 2"                => ["foto", 1],
            "Foto 3"                => ["foto", 1],
            "Foto 4"                => ["foto", 1],
            "Foto 5"                => ["foto", 1],
            "Status Pre Order"      => ["status_pre_order", 1],
            "Jumlah Hari Pre order" => ["jumlah_hari_pre_order", 1],
            "Status Publish"        => ["status_publish", 1],
            "Tanggal Publish"       => ["tgl_publish", 1],

            "Nama Varian"           => ["nama_varian", 0],
            "Foto Varian"           => ["foto_aset", 0],
            "Sku Index"             => ["sku_index", 0],
            "Barcode"               => ["barcode", 0],
            "Berat"                 => ["berat_varian", 0],
            "Harga Pokok Penjualan" => ["harga_pokok_penjualan_varian", 0],
            "Tipe Varian 1"         => ["id_tipe_varian_1", 0],
            "Varian 1"              => ["id_varian_1", 0],
            "Tipe Varian 2"         => ["id_tipe_varian_2", 0],
            "Varian 2"              => ["id_varian_2", 0],
            "Tipe Varian 3"         => ["id_tipe_varian_3", 0],
            "Varian 3"              => ["id_varian_3", 0],
        ];

        // $page['crud']["tree_sub_kategori"][$database_utama . "__varian"]=true;
        $page['crud']['sub_kategori']       = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        $page['crud']['row']['nama_varian']   = "col-md-4";
        $page['crud']['row']['varian_master'] = "col-md-2";
        $page['crud']['row']['stok']          = "col-md-2";
        $page['crud']['row']['harga_beli']    = "col-md-2";

        $page['crud']['search'] = [-1 => [4, 1]];

        $page['crud']['array'] = $array;
        $get_sql               = ErpPosApp::get_stok($page, 0, "", "", "", 'sql_rekap_akhir_total_asset');
        // print_r($get_sql);
        // die;
        $page['database']['join'][]      = ["($get_sql) as all_stok", "all_stok.id", "$database_utama.id", "left", "non_schema" => true];
        $page['database']['where'][]     = ["store__produk.id_toko", "=", "WORKSPACE_SINGLE_TOKO|"];
        $page['database']['utama']       = $database_utama;
        $page['database']['select'][]    = "*";
        $page['database']['select'][]    = "all_stok.total_stok as kuantitas";
        $page['database']['select'][]    = "all_stok.total_stok as kuantitas_$database_utama";
        $page['database']['primary_key'] = $primary_key;

        $page['get']['sidebarIn'] = true;
        return $page;
    }
    public static function bisnis_toko($page)
    {
        $page                                            = Pages::Apps('Store', 'toko', $page);
        $page['database']['where'][]                     = ["store__toko.id", "=", "WORKSPACE_SINGLE_TOKO|"];
        $page['database']['np']                          = true;
        $page['crud']['submit_form_direct']['type']      = "parameter";
        $page['crud']['submit_form_direct']['parameter'] = ["Workspace", "bisnis_toko", "edit", "WORKSPACE_SINGLE_TOKO|", -1, -1, 'ID_BOARD|'];

        $page['non_view']['Edit']['jenis_toko'] = true;
        return $page;
    }
    public static function bisnis_tipe_varian()
    {
        return Pages::Apps('Inventaris_aset', 'tipe_varian');
    }
    public static function bisnis_alamat_pengiriman($page)
    {
        return Pages::Apps('Inventaris_aset', 'bangunan3', $page);
    }
    public static function setting_banner_utama($page_temp)
    {
        $page = Pages::Apps('Website', 'website_bundles_banner');

        $page['database']['where'][] = ["id", " in ", "
        (
            select website__bundles__tag.id_banner   FROM web__list_apps_menu
                LEFT JOIN website__bundles__list on web__list_apps_menu.id_bundle=website__bundles__list.id
                LEFT JOIN website__bundles__list__tag on website__bundles__list__tag.id_website__bundles__list=website__bundles__list.id
                LEFT JOIN website__bundles__website__master on id_website_master = website__bundles__website__master.id
                LEFT JOIN website__bundles__website__master__tag on website__bundles__website__master__tag.id_website__bundles__website__master = website__bundles__website__master.id
                LEFT JOIN website__bundles__tag on website__bundles__website__master__tag.id_bundle_tag = website__bundles__tag.id
                WHERE ambil_dari='bundles' and id_banner is not null
        )    and website__bundles__master__banner.active=1"];
        return $page;
    }

    public static function setting_contact_us($page)
    {

        $page['title']      = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']      = __FUNCTION__;
        $page['layout_pdf'] = ['a4', 'portait'];

        $database_utama = "web__apps";
        $primary_key    = null;

        $array = [
            ["Logo", "logo", "file", "system/apps/"],
            ["Meta Title", "meta_title", "text"],
            ["Meta Keyword", "meta_keyword", "text"],
            ["Meta Description", "meta_description", "text"],

            ["Alamat Lengkap", "alamat", "text"],
            ["No Telpon", "no_telepon", "text"],
            ["Nama Narahubung", "nama_narahubung", "text"],
            ["Email", "email", "text"],
            ["", "nomor_send_wa", "text"],
            ["", "link_gmaps", "textarea"],

        ];

        $search = [];

        $page['crud']['array']  = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama']                       = $database_utama;
        $page['database']['primary_key']                 = $primary_key;
        $page['database']['select']                      = ["*"];
        $page['database']['join']                        = [];
        $page['database']['where']                       = [];
        $page['crud']['submit_form_direct']['type']      = "parameter";
        $page['crud']['submit_form_direct']['parameter'] = ["Workspace", "setting_contact_us", "edit", "id_web__apps|", -1, -1, 'ID_BOARD|'];
        return $page;
    }
    public static function bisnis_pesanan($page)
    {
        $page['crud']['form_type'] = 2;
        if ($page['section'] != 'generate') {
            DB::connection($page);
        }

        $page['title']              = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route']              = __FUNCTION__;
        $page['crud']['layout_pdf'] = ['a4', 'landscape'];
        $page['get']['sidebarIn']   = true;
        $page                       = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'sales_order', 'pos_full', 'penjual');

        // $tab1 = 'Detail Pesanan';
        // $page['tab_view'][$tab1]=$page;
        // $page['tab_view']["Pengiriman"]=$page_pengiriman;
        // $page['tab_view']["Barang Keluar"]=$page_outgoing;
        // $page['tab_view']["Pembayaran"]=$page_payment;

        if ($page['load']['type'] ?? '' == 'tambah') {

            $i                                           = 0;
            $website['content'][$i]['tag']               = "BANNER";
            $website['content'][$i]['content_source']    = "template_content";
            $website['content'][$i]['template_class']    = "system";
            $website['content'][$i]['template_function'] = "pesanan";
            $i++;

            $page['view_layout'][] = ["website", "col-md-12", $website];
            $page['load']['type']  = 'view_layout';
        } else {

            $page['crud']['setting_table_group']["non_prefix_all"] = true;
            $page['crud']['table_group']['ID Order'][]             = "no_purchose_order";
            $page['crud']['table_group']['Tanggal Order'][]        = "tanggal_po";
            $page['crud']['table_group']['Costumer'][]             = "apps_user";
            $page['crud']['table_group']['Payment'][]              = "status_payment";
            $page['crud']['table_group']['Status'][]               = "status_pesanan";

            $page['crud']['table_view']['no_purchose_order']["tipe_view"]         = "bold-muted";
            $page['crud']['table_view']['no_purchose_order']["muted"]             = "no_sales_order";
            $page['crud']['table_view']['id_apps_user']["tipe_view"]              = "profil_avatar";
            $page['crud']['table_view']['id_apps_user']["more_info"]              = "email";
            $page['crud']['table_view']['id_apps_user']["link"]                   = [];
            $page['crud']['table_view']['status_pesanan']["tipe_view"]            = "badge";
            $page['crud']['table_view']['status_pesanan']["value"]["belum bayar"] = "primary";
            $page['crud']['table_view']['status_pesanan']["else"]                 = "danger";

            $page['crud']['costum_view']['box'][1]['row']                         = "col-md-12";
            $card_1                                                               = "Order";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['row']     = "col-md-6";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "no_purchose_order";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "no_sales_order";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "tanggal_po";

            $card_1                                                               = "Costumer";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['row']     = "col-md-6";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_panel";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_apps_user";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "id_kirim_ke";
            $page['crud']['costum_view']['box'][1]['content'][$card_1]['array'][] = "pesan";

            $card_1                                                                      = "List Pesanan";
            $page['crud']['costum_view']['box'][2]['row']                                = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']            = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] = "erp__pos__utama__detail";
            $card_1                                                                      = "Delivery Order";
            $page['crud']['costum_view']['box'][2]['row']                                = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']            = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] = "erp__pos__delivery_order";
            $card_1                                                                      = "Rincian Pembayaran";
            $page['crud']['costum_view']['box'][2]['row']                                = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']            = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['total']          = true;

            $card_1                                                                      = "Payment";
            $page['crud']['costum_view']['box'][2]['row']                                = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['row']            = "col-md-12";
            $page['crud']['costum_view']['box'][2]['content'][$card_1]['sub_kategori'][] = "erp__pos__payment";
        }
        return $page;
    }
    public static function bisnis_barang_keluar()
    {
        return Pages::Apps('POS', 'online__outgoing');
    }
    public static function Stop_opname()
    {
        return Pages::Apps('POS', 'stok_opname');
    }
    public static function bisnis_barang_masuk()
    {
        return Pages::Apps('POS', 'all_receive');
    }
    public static function bisnis_pengiriman()
    {
        return Pages::Apps('POS', 'online__delivery_order');
    }
    public static function bisnis_pembayaran()
    {
        return Pages::Apps('POS', 'online__payment');
    }
    public static function bisnis_kategori_produk()
    {
        return Pages::Apps('Webmaster', 'master__kategori');
    }
    public static function bisnis_kategori_toko()
    {
        return Pages::Apps('Inventaris_aset', 'kategori_toko');
    }
    public static function bisnis_bundles_harga()
    {
        return Pages::Apps('Store', 'bundle_harga');
    }
    public static function bisnis_gudang()
    {
        return Pages::Apps('Inventaris_aset', 'gudang');
    }
    public static function promo_toko()
    {
        $page                                                         = Pages::Apps('Store', 'promo__toko');
        $page['non_view']['Tambah']['id_toko']                        = true;
        $page['non_view']['Edit']['id_toko']                          = true;
        $page['non_view']['Hapus']['id_toko']                         = true;
        $page['crud']['select_database_costum']['id_toko']['where'][] = ["WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|", "", ""];
        $page['crud']['select_database_costum']['id_toko']['np']      = true;
        $page['crud']['insert_default_value']['id_toko']              = "WORKSPACE_SINGLE_TOKO|";
        return $page;
    }
    public static function voucher()
    {
        $page                                                         = Pages::Apps('Store', 'voucher');
        $page['non_view']['Tambah']['id_toko']                        = true;
        $page['non_view']['Edit']['id_toko']                          = true;
        $page['non_view']['Hapus']['id_toko']                         = true;
        $page['crud']['select_database_costum']['id_toko']['where'][] = ["WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|", "", ""];
        $page['crud']['select_database_costum']['id_toko']['np']      = true;
        $page['crud']['insert_default_value']['id_toko']              = "WORKSPACE_SINGLE_TOKO|";
        return $page;
    }
    public static function master_mitra()
    {
        $page = Pages::Apps('Store', 'mitra');

        $page['crud']['select_database_costum']['id_toko']['where'][] = ["WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|", "", ""];
        $page['crud']['select_database_costum']['id_toko']['np']      = true;
        return $page;
    }
    public static function data_mitra()
    {
        $page                              = Pages::Apps('Outsourcing', 'mitra_penjualan');
        $page['crud']['no_dm']['id_panel'] = 1;
        return $page;
    }
    public static function daftar_mitra()
    {
        $page = Pages::Apps('Outsourcing', 'mitra_penjualan');

        $page['non_view']['Tambah']['id_panel']                             = true;
        $page['non_view']['Edit']['id_panel']                               = true;
        $page['non_view']['Hapus']['id_panel']                              = true;
        $page['non_view']['Tambah']['id_apps_user']                         = true;
        $page['non_view']['Edit']['id_apps_user']                           = true;
        $page['non_view']['Hapus']['id_apps_user']                          = true;
        $page['non_view']['Tambah']['status_mitra']                         = true;
        $page['non_view']['Edit']['status_mitra']                           = true;
        $page['non_view']['Tambah']['tanggal_jatuh_tempo']                  = true;
        $page['non_view']['Edit']['tanggal_jatuh_tempo']                    = true;
        $page['crud']['insert_default_value']['id_apps_user']               = "ID_APPS_USER|";
        $page['crud']['insert_default_value']['id_panel']                   = "ID_PANEL|";
        $page['crud']['select_database_costum']['id_store_from']['where'][] = ["WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|", "", ""];
        $page['crud']['select_database_costum']['id_store_from']['np']      = true;
        return $page;
    }

    public static function bisnis_brand()
    {
        return Pages::Apps('Outsourcing', 'brand');
    }
    public static function order_system_ecomerce_fisik()
    {
        $page['orderSystem']['defaultToko'] = "";
        $page['orderSystem']['multiToko']   = true;
        return $page;
    }

    // Toko
    //     Profil Toko
    //     Daftar Mitra
    // }
}
