<?php

require_once 'Partial.php';
class Packages extends Partial
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public static function initialize($page)
    {

        if (! isset($page['done_initialize'])) {

            $fai         = new MainFaiFramework();
            $page['fai'] = $fai;
            if ($page['section'] != 'generate') {
                DB::connection($page);
            }

            $login               = true;
            $contentfaiframework = $page['contentfaiframework'];
            $mainAll             = $page['mainAll'];

            $page['section']           = isset($page['section']) ? $page['section'] : 'page';
            $page['database_provider'] = isset($page['database_provider']) ? $page['database_provider'] : 'mysql';
            $page['app_framework']     = isset($page['app_framework']) ? $page['app_framework'] : 'ci';
            $page['load']['protocol']  = 'call';

            if ($page['section'] == 'view_source') {
                $page['section'] = 'viewsource';
            }
            if ($page['load_section'] != 'viewsource') {
                $page = $fai->Apps('Auth', 'login_page_1', $page);
            }

            if (! isset($page['web_load_function'])) {
                $page['web_load_function'] = 'files';
            }

            if (! isset($page['load']['login'])) {
                $page['load']['login'] = 1;
            }

            if (! isset($page['route'])) {
                $page['route'] = $page['load']['apps'];
            }

            if (! isset($page['load']['database']['id'])) {
                $page['load']['database']['id']['text']     = 'id';
                $page['load']['database']['id']['type']     = 'prefix'; //prefix//sufix
                $page['load']['database']['id']['on_table'] = false;    //true->id_(nama table)//false->just id
            }
            if (! isset($page['load']['database']['query']['select'])) {
                $page['load']['database']['query']['select'] = true;
            }
            if (! isset($page['load']['view_page'])) {
                $page['load']['view_page'] = 'files';
            }
            if ($page['load']['view_page'] == 'bundles') {
                $page['load']['protocol'] = 'call';
            }

            if ($page['web_load_function'] == 'web') {
            }

            if (! isset($page['load']['link_route'])) {
                $page['load']['link_route'] = $page['load']['route_page'];
            }

            if (! isset($page['load']['menu'])) {
                $page['load']['menu'] = -1;
            }

            if (! isset($page['load']['id'])) {
                $page['load']['id'] = -1;
            }

            if (! isset($page['load']['board'])) {
                $page['load']['board'] = -1;
            }

            if (isset($page['load']['row_web_apps'])) {
                if ($page['load']['board'] == -1 and ($page['load']['row_web_apps']->id_board != -1)) {
                    if ($page['load']['row_web_apps']->id_board) {
                        $page['load']['board'] = $page['load']['row_web_apps']->id_board;
                    }
                }
            }

            if ($page['load']['domain'] == 'admin.hibe3.com') {
                $page['section']      = 'admin';
                $page['load_section'] = 'admin';
            }
            if (! isset($page['load']['link'])) {
                $page['load']['link'] = 'loadJs';
            }

            if (! isset($page['load']['nav'])) {
                $page['load']['nav'] = -1;
            } else if (($page['load']['nav'] == -1) and Partial::input('nav') != -1) {
                $page['load']['nav'] = Partial::input('nav');
            }

            if (! isset($page['load']['contentfaiframework'])) {
                $page['load']['contentfaiframework'] = null;
            }

            if (! isset($page['load']['page_section_menu'])) {
                $page['load']['page_section_menu'] = -1;
            }
            if ($page['load']['view_page'] == 'files') {
                $page['load']['view_page'] = 'controller';
            }

            if (isset($page['database']['utama']) and $page['load_section'] != 'viewsource' and $page['load_section'] != 'api') {
                $sql = "select * from form where database_utama = '" . $page['database']['utama'] . "'
	            and id_board=" . $page['load']['board'] . "
	            and load_apps='" . $page['load']['apps'] . "'
	            and load_page_view='" . $page['load']['page_view'] . "'
	            and tipe_form = 'Board Form'
	            and active=1";
                $get  = DB::query($sql);
                $form = DB::fetchResponse($get);
                if (! $form) {
                    $insert_form['database_utama'] = $page['database']['utama'];
                    $insert_form['id_board']       = $page['load']['board'];
                    $insert_form['load_apps']      = $page['load']['apps'];
                    $insert_form['load_page_view'] = $page['load']['page_view'];
                    $insert_form['tipe_form']      = 'Board Form';
                    $save                          = CRUDFunc::crud_save($fai, $page, $insert_form, [], [], "form", []);
                    $get                           = DB::query($sql);
                    $form                          = DB::fetchResponse($get);
                }
            }
            if ($fai->input('section') == 'card' or $page['section'] == 'card' or ($page['load']['type'] == 'view_layout' and ($page['load']['type'] == 'save' or $page['load']['type'] == 'hapus' or $page['load']['type'] == 'update'))) {
                $page_database = '';
                if ($fai->input('page_database')) {
                    $page_database = $fai->input('page_database');
                } else if (isset($page['load']['page_database'])) {
                    $page_database = $page['load']['page_database'];
                }

                if ($page_database) {
                    $page['database'] = $page['config']['database'][$page_database];
                }

                if ($page['load']['type'] == 'save') {
                    unset($page['database']['where']);
                }

                $array = $fai->input('array') ? json_decode(($fai->input('array')), true) : $page['crud']['array'];
                if (isset($page['view_layout'][$fai->input('view_layout_number')][2]['menu'][$page['load']['page_section_menu']][2])) {
                    $nama_array = ($page['view_layout'][$fai->input('view_layout_number')][2]['menu'][$page['load']['page_section_menu']][2]);
                    $card       = $page['view_layout'][$fai->input('view_layout_number')][2][$nama_array];

                    $nama_type = $page['view_layout'][$fai->input('view_layout_number')][2]['menu'][$page['load']['page_section_menu']][1];
                    if ($nama_type == 'card-nav') {;
                        if (isset($card['cardNav'][$page['load']['nav']]['crud'])) {
                            $page['crud'] = array_merge_recursive($page['crud'], $card['cardNav'][$page['load']['nav']]['crud']);
                        }

                        $array = ($card['cardNav'][$page['load']['nav']]['array']);} else {
                        $nama_array = $page['view_layout'][$fai->input('view_layout_number')][2]['menu'][$page['load']['page_section_menu']][2];
                        $array      = $page['view_layout'][$fai->input('view_layout_number')][2][$nama_array]['array'];

                        if (isset($page['view_layout'][$fai->input('view_layout_number')][2][$nama_array]['crud'])) {
                            $page['crud'] = array_merge_recursive($page['crud'], $page['view_layout'][$fai->input('view_layout_number')][2][$nama_array]['crud']);
                        }
                    }
                }

                $page['database']['primary_key'] = Database::converting_primary_key($page, trim($page['database']['primary_key']), 'ontable');
                $array                           = Database::converting_array_field($page, $array);
                $page['crud']['array']           = $array;
            } else if ($contentfaiframework == 'get_pages') {

                $apps      = Partial::input('apps');
                $page_view = Partial::input('page_view');
                if (Partial::input('type')) {
                    $page['load']['type'] = $type = Partial::input('type');
                }
                $page['load']['id'] = $id = (Partial::input('id') ? Partial::input('id') : $page['load']['id']);
                if (Partial::input('board') and Partial::input('board') != -1) {
                    $page['load']['board'] = Partial::input('board');
                }

                $page_temp = Pages::Apps($apps, $page_view, $page);

                $page = array_merge($page, $page_temp);
            } else if (($contentfaiframework == 'pages' or $contentfaiframework == 'link_direct') and ($page['load']['contentfaiframework'] == null or (Partial::input('apps'))) and ($mainAll == 2 or $mainAll == 3)) {

                $apps      = Partial::input('apps');
                $page_view = Partial::input('page_view');
                if (Partial::input('type')) {
                    $page['load']['type'] = $type = Partial::input('type');
                }

                $type;
                $page['load']['id'] = $id = (Partial::input('id') ? Partial::input('id') : $page['load']['id']);
                if (Partial::input('board') and Partial::input('board') != -1) {
                    $page['load']['board'] = Partial::input('board');
                }

                $page_temp = Pages::Apps($apps, $page_view, $page);
                $page      = array_merge($page, $page_temp);
            } else if (isset($page['load']['view_page'])) {

                if ($page['load']['view_page'] == "controller" and $page['load']['page_view'] != -1) {

                    $page_temp = Pages::Apps($page['load']['apps'], $page['load']['page_view'], $page);
                    if (count($page_temp)) {
                        $page = array_merge($page, $page_temp);
                    }

                }
            }

            if ($page['template']) {
                // $pagetemp =  $page;
                $page = (Configuration::template_base(str_replace(["-", " "], ["_", "_"], strtolower($page['template'])), $page));
                //$page = array_merge_recursive($page, $pagetemp);
            }
            if ($page['section'] != 'viewsource' and $page['section'] != 'api') {

                $page['id_list_apps']              = Partial::get_id_apps($page);
                $page['load']['id_list_apps_menu'] = Partial::define_web_apps_menu($page);
                $page['get_panel']                 = PanelFunc::panel_initial($page, 'all');
                Partial::histori_user($page);
                Partial::add_tab_group($page);
                $login = true;
                if ($page['load']['id_list_apps_menu']['num_rows']) {

                    $page['load']['login'] = $page['load']['id_list_apps_menu']['row'][0]->login;
                }
            }
            // echo 'HAIII';
            if ($page['load']['login'] == 0 and empty($page['load']['force_login'])) {
                // echo 'MALAH MASUK'.$page['load']['login'];
            } else
            if (($page['load']['login']) or ! empty($page['load']['force_login'])) {
                // echo 'masuk';
                if (! isset($_SESSION["is_login"])) {
                    $login = false;
                } else if ($_SESSION["is_login"] == 0) {
                    $login = false;
                } else if (in_array($page['load']['type'], ['get_login', 'daftar', 'logout', 'save_daftar'])) {
                    $login = false;
                }
            }
            if (! empty($_SESSION['id_apps_user'])) {
                $is_login = true;
                if ($_SESSION['id_apps_user'] == -1) {
                    $is_login = false;
                }
            } else {
                $is_login = false;
            }

            if (! $login) {
                $page['load']['contentfaiframework'] = $login;
            }
            $page['require_login'] = $login;
            $page['is_login']      = $is_login;

            if (isset($page['load']['id_list_apps_menu'])) {
                if (isset($page['load']['board']) and $login and $page['load']['id_list_apps_menu']['num_rows']) {
                    if (($page['load']['board'] == -1 ? false : ($page['load']['board'] ? true : false))) {

                        DB::queryRaw($page, "select id_single_toko,id_panel_utama from web__list_apps_board where id = " . $page['load']['board']);
                        $utama                                       = DB::get('all');
                        $page['load']['workspace']['id_single_toko'] = $utama['row'][0]->id_single_toko;
                        $page['load']['workspace']['id_panel_utama'] = $utama['row'][0]->id_panel_utama;
                        if (! isset($_SESSION['board_role-' . $page['load']['board']])) {
                            MainFaiFramework::board_role_default($page, $page['load']['board']);
                        }
                    }
                    if (! empty($_SESSION['board_role-' . $page['load']['board']]) and $page['load_section'] != 'admin') {
                        DB::selectRaw('*, cast(web__list_apps_board__role__akses.nama_menu as int) as id_first_akses_role');
                        DB::table('web__list_apps_board__role__akses');
                        DB::joinRaw("website__template__list on web__list_apps_board__role__akses.id_template = website__template__list.id", 'left');
                        DB::joinRaw("web__list_apps_menu as first on first.id = cast(web__list_apps_board__role__akses.nama_menu as int)", 'left');

                        DB::whereRaw("web__list_apps_board__role__akses.id=" . $_SESSION['board_role-' . $page['load']['board']]);
                        $get = DB::get('all');

                        DB::table('web__list_apps_board__role__akses');
                        DB::selectRaw('web__list_apps_board__role__akses.*');
                        DB::joinRaw("website__template__list on web__list_apps_board__role__akses.id_template = website__template__list.id", 'left');
                        DB::joinRaw("web__list_apps_board__role__akses__menu on web__list_apps_board__role__akses.id = web__list_apps_board__role__akses__menu.id_web__list_apps_board__role__akses", 'left');
                        DB::joinRaw("web__list_apps_menu on web__list_apps_menu.id = web__list_apps_board__role__akses__menu.id_menu", 'left');
                        // DB::joinRaw("web__list_apps_board__role__akses on web__list_apps_menu.id = web__list_apps_board__role__akses.id_menu", 'left');
                        DB::whereRaw("web__list_apps_board__role__akses.id=" . $_SESSION['board_role-' . $page['load']['board']]);
                        DB::whereRaw("web__list_apps_board__role__akses__menu.akses_menu='1'");
                        DB::whereRaw("web__list_apps_menu.load_apps='" . $page['load']['apps'] . "'");
                        DB::whereRaw("web__list_apps_menu.load_page_view='" . $page['load']['page_view'] . "'");
                        $privilage = DB::get('all');
                        if (! $privilage['num_rows'] and $get['row'][0]->id_first_akses_role and $page['load']['id_list_apps_menu']['row'][0]->page != 'Frontend') {
                            $page_temp               = $page;
                            $page_temp['route_type'] = "just_link";

                            $link = Partial::link_direct($page_temp, base_url() . "pages/", [$get['row'][0]->load_apps, $get['row'][0]->load_page_view, $get['row'][0]->load_type, $get['row'][0]->load_page_id, $get['row'][0]->menu, $get['row'][0]->nav, $get['row'][0]->id_web__list_apps_board]);
                            echo '<script>
					// if(confirm())
					window.location.href="' . $link . '";</script>';
                            die;
                            // echo '<script> 

                            // window.location.href="";</script>';
                        }

                        if ($get['num_rows']) {
                            if ($get['row'][0]->template_base == 'Costum Template' and $get['row'][0]->main_content_template) {

                                $page['get']['not_sidebarIn'] = true;
                                $page['get']['not_sidebarIn'] = true;

                                $page['template'] = $get['row'][0]->nama_template;
                                $get['row'][0]->nama_role;

                                $page['load']['row_web_apps']->main_content_template     = ($get['row'][0]->main_content_template);
                                $page['load']['row_web_apps']->main_content_template_css = ($get['row'][0]->main_content_template_css);
                                $page['load']['row_web_apps']->main_content_template_js  = ($get['row'][0]->main_content_template_js);

                                if (! empty($get['row'][0]->id_sidebar_fixed)) {
                                    $page['load']['row_web_apps']->id_sidebar_bundles = ($get['row'][0]->id_sidebar_fixed);
                                    $page['load']['id_sidebar_template']              = $get['row'][0]->id_sidebar_fixed;
                                }
                                if (! empty($get['row'][0]->id_navbar_fixed)) {
                                    $page['load']['row_web_apps']->id_navbar_bundles = ($get['row'][0]->id_navbar_fixed);
                                    $page['load']['id_navbar_template']              = $get['row'][0]->id_navbar_fixed;
                                }
                                if (! empty($get['row'][0]->id_header_fixed)) {
                                    $page['load']['row_web_apps']->id_header_bundles = ($get['row'][0]->id_header_fixed);
                                    $page['load']['id_header_template']              = $get['row'][0]->id_header_fixed;
                                }
                            }
                        }
                    }
                }
            }

            $perubahan = [];
            $array     = isset($page['crud']['array']) ? $page['crud']['array'] : [];

            $array_temp = $array;
            $array      = Database::converting_array_field($page, $array, 'all');

            $field_array = [];

            if (isset($page['config']['database']) and $page['section'] != 'viewsource') {
                foreach ($page['config']['database'] as $key_config => $value_config) {
                    if (isset($value_config['utama'])) {

                        $database_utama = $value_config['utama'];

                        $database_manipulation = Packages::database_manipulation($page, $database_utama, $value_config, [], "", 'page-array');

                        $database_utama = $database_manipulation['utama'];
                        $value_config   = ($database_manipulation['database_costum']);
                        if (isset($database_manipulation['database_costum']['no_checking'])) {
                            $page['config']['database'][$key_config]['not_checking'] = true;
                        }
                        if (isset($value_config['not_checking'])) {
                            $page['config']['database'][$key_config]['not_checking'] = true;
                        }
                        if (isset($value_config['primary_key'])) {
                            $value_config = Database::converting_primary_key($page, $value_config, "utama");
                        }

                        if (isset($database_manipulation['crud']['insert_value'])) {
                            foreach ($database_manipulation['crud']['insert_value'] as $to_key => $to_value) {
                                $page['crud']['insert_default_value'][$to_key] = $to_value;
                                $page['crud']['insert_value'][$to_key]         = $to_value;
                            }
                        }
                        if (isset($database_manipulation['crud']['crud_inline'])) {
                            foreach ($database_manipulation['crud']['crud_inline'] as $to_key => $to_value) {
                                $page['crud']['crud_inline'][$to_key] = $to_value;
                            }
                        }
                        if (isset($database_manipulation['database_all']['select'])) {

                            foreach ($database_manipulation['database_all']['select'] as $to_key => $to_value) {
                                $value_config['select'][] = $to_value;
                            }
                        }

                        if (isset($database_manipulation['database_all']['where'])) {

                            foreach ($database_manipulation['database_all']['where'] as $to_key => $to_value) {
                                $value_config['where'][] = $to_value;
                            }
                        }
                        if (isset($database_manipulation['database_all']['join'])) {

                            foreach ($database_manipulation['database_all']['join'] as $to_key => $to_value) {
                                $value_config['join'][] = $to_value;
                            }
                        }
                        $page['config']['database'][$key_config] = $value_config;
                    }
                }
            }
            if (isset($page['database'])) {
                $page['database']['utama'] = strtolower(trim($page['database']['utama']));
                $database_utama_asli       = $page['database']['utama'];
                $database_utama            = $page['database']['utama'];

                $database_manipulation = Packages::database_manipulation($page, $database_utama, $page['database'], [], "", 'page-array');

                $database_utama = $database_manipulation['utama'];

                $page['database']          = ($database_manipulation['database_costum']);
                $page['database']['utama'] = ($database_manipulation['utama']);

                $page['database']                    = Database::converting_primary_key($page, $page['database'], "utama");
                $page['crud']['database_utama_temp'] = $database_utama_asli;
                $page['crud']['database_utama']      = $database_utama_asli;
                $page['section_initialize']          = "crud_utama";
                if (isset($database_manipulation['database_costum']['no_checking'])) {

                    $page['database']['no_checking'] = true;
                }
                if (isset($value_config['not_checking'])) {
                    $page['database']['not_checking'] = true;
                }
                if (isset($page['database']['select']) and $page['database_provider'] == 'postgres') {
                    $select_temp                = $page['database']['select'];
                    $page['database']['select'] = [];
                }
                if (! empty($page['database']['utama'])) {

                    $primary_key                  = $page['database']['primary_key'] ? $page['database']['primary_key'] : Database::converting_primary_key($page, $page['database']['utama'], 'ontable');
                    $page['database']['select'][] = (isset($page['database']['alias']) ? $page['database']['alias'] : $page['database']['utama']) . ".*";
                    if ($primary_key) {
                        $page['database']['select'][] = (isset($page['database']['alias']) ? $page['database']['alias'] : $page['database']['utama']) . "." . $primary_key . ' as primary_key';
                    }

                    unset($page['database']['select'][array_search("*", $page['database']['select'])]);
                }
                if (isset($page['database']['alias'])) {
                    $database_utama = $page['database']['alias'];
                }
                if (isset($database_manipulation['crud']['insert_value'])) {
                    foreach ($database_manipulation['crud']['insert_value'] as $to_key => $to_value) {
                        $page['crud']['insert_default_value'][$to_key] = $to_value;
                        $page['crud']['insert_value'][$to_key]         = $to_value;
                    }
                }
                if (isset($database_manipulation['crud']['crud_inline'])) {
                    foreach ($database_manipulation['crud']['crud_inline'] as $to_key => $to_value) {
                        $page['crud']['crud_inline'][$to_key] = $to_value;
                    }
                }
                if (isset($database_manipulation['database_all']['select'])) {

                    foreach ($database_manipulation['database_all']['select'] as $to_key => $to_value) {
                        $page['database']['select'][] = $to_value;
                    }
                }

                if (isset($database_manipulation['database_all']['where'])) {

                    foreach ($database_manipulation['database_all']['where'] as $to_key => $to_value) {
                        $page['database']['where'][] = $to_value;
                    }
                }
                if (isset($database_manipulation['database_all']['join'])) {

                    foreach ($database_manipulation['database_all']['join'] as $to_key => $to_value) {
                        $page['database']['join'][] = $to_value;
                    }
                }
            } else {
                $database_utama = null;
            }

            $page['crud']['database_utama'] = $database_utama;
            $page['section_initialize']     = "crud_utama";
            for ($i = 0; $i < count($array['array']); $i++) {
                $field = $array['array'][$i][1];
                if (isset($field_array[$field])) {
                    echo 'Field ' . $field . " duplikat, silahkan hubungi admin";
                    die;
                } else {
                    $field_array[$field] = $i;
                }

                $type   = $array['array'][$i][2];
                $extype = explode('-', $type);
                $result = Packages::initialize_array($fai, $page, $array, $i, $field, $type, $extype);

                $page  = $result['page'];
                $array = $result['array'];

                if (isset($page['crud']['costum_class'][$field])) {
                    if (! stripos($page['crud']['costum_class'][$field], $page['database']['utama'] . "__" . $field . "_0")) {
                        $page['crud']['costum_class'][$field] .= $page['database']['utama'] . "__$field" . "_0";
                    }

                } else {
                    $page['crud']['costum_class'][$field] = $page['database']['utama'] . "__$field" . "_0";
                }
            }
            if (isset($page['crud']['split_database']['array'])) {
                foreach ($page['crud']['split_database']['array'] as $key_split => $value_split) {
                    $page['database']['select'][] = $value_split . "." . trim($key_split);
                }
            }
            if (isset($page['crud']['split_database']['setting'])) {
                foreach ($page['crud']['split_database']['setting'] as $db_setting => $value_setting) {
                    $page['database']['join'][] = [$db_setting, $database_utama . '.' . $value_setting['koneksi']['row_form_utama'], "$db_setting." . $value_setting['koneksi']['row_form_split']];
                }
            }
            if (isset($page['database'])) {

                Database::create_database_check($page, $page['crud']['array'], $page['database']['utama'], $page['database']['primary_key'], $page['database_provider'], $page['app_framework']);
            }
            $page['crud']['database_utama'] = $database_utama;
            $page['crud']['array']          = $array['array'];
            $perubahan                      = $array['perubahan'];
            //Sub Kategori
            $page['section_initialize'] = "crud_sub_kategori";
            if (isset($page['crud']['sub_kategori'])) {
                for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
                    if ($page['crud']['sub_kategori'][$h][2] == null) {
                        $page['crud']['sub_kategori'][$h][2] = Database::converting_primary_key($page, $page['crud']['sub_kategori'][$h][1], 'ontable');
                    }
                    $sub_kategori = $page['crud']['sub_kategori'][$h];

                    $database_utama_sub_kategori = $sub_kategori[1];

                    $array = [];

                    $array                                                                    = $page['crud']['array_sub_kategori'][$h];
                    $page['crud']['sub_kategori'][$h][1]                                      = strtolower(trim($page['crud']['sub_kategori'][$h][1]));
                    $page['crud']['database_utama']                                           = $page['crud']['sub_kategori'][$h][1];
                    $page['crud']['field_sub_kategori'][$page['crud']['sub_kategori'][$h][1]] = $h;
                    $array                                                                    = Database::converting_array_field($page, $array, 'all');
                    $id_primary_key                                                           = Database::converting_primary_key($page, $database_utama_sub_kategori, "primary_key");
                    if ($page['section'] != 'viewsource' or 1 == 1) {

                        Database::create_database_check($page, $array['array'], $database_utama_sub_kategori, $id_primary_key, $page['database_provider']);
                        $columns                                                       = DB::getColumnListing($page, $page['database_provider'], $database_utama_sub_kategori);
                        $page['crud']['database_column'][$database_utama_sub_kategori] = $columns;

                        if (! in_array($id_primary_key, $columns)) {
                            "ALTER TABLE $database_utama_sub_kategori ADD COLUMN $id_primary_key  numeric ;";
                            DB::select("ALTER TABLE " . (! empty($page['conection_scheme']) ? $page['conection_scheme'] . '.' : '') . "$database_utama_sub_kategori ADD COLUMN $id_primary_key  numeric ;");
                        }
                        Database::create_database_check(
                            $page,
                            $array['array'],
                            $page['crud']['sub_kategori'][$h][1],
                            $page['crud']['sub_kategori'][$h][2],
                            $page['database_provider'],
                            $page['app_framework']
                        );
                    }

                    $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['utama']    = $page['crud']['database_utama'];
                    $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['select'][] = $page['crud']['sub_kategori'][$h][1] . ".*";
                    $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['select'][] = $page['crud']['sub_kategori'][$h][1] . "." . $page['crud']['sub_kategori'][$h][2] . ' as primary_key';
                    if (isset($page['crud']['split_database_sub_kategori'][$page['crud']['database_utama']]['setting'])) {

                        foreach ($page['crud']['split_database_sub_kategori'][$page['crud']['database_utama']]['setting'] as $db_setting => $value_setting) {
                            $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['join'][] = [$db_setting, $page['crud']['database_utama'] . '.' . $value_setting['koneksi']['row_form_utama'], "$db_setting." . $value_setting['koneksi']['row_form_split']];
                        }
                        foreach ($page['crud']['split_database_sub_kategori'][$page['crud']['database_utama']]['array'] as $key_split => $value_split) {
                            $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['select'][] = $value_split . "." . trim($key_split);
                        }
                    }
                    for ($i = 0; $i < count($array['array']); $i++) {
                        $field               = $array['array'][$i][1];
                        $field_array[$field] = $i;
                        $type                = $array['array'][$i][2];
                        $extype              = explode('-', $type);
                        $result              = Packages::initialize_array($fai, $page, $array, $i, $field, $type, $extype);
                        $page                = $result['page'];
                        $array               = $result['array'];
                    }

                    $page['crud']['array_sub_kategori'][$h] = $array['array'];
                    $perubahan                              = array_merge($perubahan, $array['perubahan']);
                    if ($page['section'] != 'viewsource') {
                        Database::create_database_check($page, $page['crud']['array_sub_kategori'][$h], $page['crud']['sub_kategori'][$h][1], $page['crud']['sub_kategori'][$h][2], $page['database_provider'], $page['app_framework'], $page['database']['utama']);

                        $columns = DB::getColumnListing($page, $page['database_provider'], $page['crud']['sub_kategori'][$h][1]);
                        if (isset($page['crud']["tree_sub_kategori"][$page['crud']['sub_kategori'][$h][1]])) {

                            if (! in_array("tree_level", $columns)) {

                                if ($page['database_provider'] == 'postgres') {
                                    DB::select("ALTER TABLE " . $page['crud']['sub_kategori'][$h][1] . " ADD COLUMN tree_level numeric ;");
                                } else {
                                    DB::select("ALTER TABLE " . $page['crud']['sub_kategori'][$h][1] . " ADD tree_level  int(11) DEFAULT NULL ;");
                                }
                            }
                        }
                    }
                }
            }
            $page['crud']['field_array'] = $field_array;

            if (isset($page['crud']['total'])) {

                DB::connection($page);
                $database_utama = $page['database']['utama'];
                $columns        = DB::getColumnListing($page, $page['database_provider'], $database_utama);

                $sqli_to_database = [];
                for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {
                    if (isset($page['crud']['total']['content'][$k]["with_input"])) {
                        if ($page['crud']['total']['content'][$k]["with_input"]) {
                            $array = ($page['crud']['total']['content'][$k]["array"]);
                            $array = $page['crud']['total']['content'][$k]["array"] = Database::converting_array_field($page, $array, 'utama');
                        }
                    }
                    if (isset($page['crud']['total']['content'][$k]["add_button_multi"])) {

                        if ($page['crud']['total']['content'][$k]["add_button_multi"]) {
                            if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
                                if (isset($page['crud']['total']['content'][$k]["with_input"])) {
                                    if ($page['crud']['total']['content'][$k]["with_input"]) {
                                        $array = ($page['crud']['total']['content'][$k]["array"]);
                                        $array = Database::converting_array_field($page, $array, 'utama');
                                        for ($i = 0; $i < count($array); $i++) {
                                            $sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = ["", $page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1], "number"];
                                        }
                                    }
                                }
                            }

                            $sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = ["", "total_" . $page['crud']['total']['content'][$k]["id"], "number"];
                            $sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = ["", "select_type_" . $page['crud']['total']['content'][$k]["id"], "number"];
                            $sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = ["", "" . $page['crud']['total']['content'][$k]["id"], "number"];
                        }
                    }

                    if (isset($page['crud']['total']['content'][$k]["with_input"])) {
                        if ($page['crud']['total']['content'][$k]["with_input"]) {
                            $array = ($page['crud']['total']['content'][$k]["array"]);

                            $array                                         = Database::converting_array_field($page, $array, 'all');
                            $page['crud']['total']['content'][$k]["array"] = $array['array'];
                            $array                                         = $array['array'];
                            for ($i = 0; $i < count($array); $i++) {
                                if ($array[$i][2] == 'number') {
                                    if (! in_array($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1], $columns)) {

                                        DB::select("ALTER TABLE $database_utama ADD COLUMN " . "" . $page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1] . "  float8 ;");
                                    }
                                } else if ($array[$i][2] == 'select') {
                                    if (! in_array($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1], $columns)) {

                                        DB::select("ALTER TABLE $database_utama ADD COLUMN " . "" . $page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1] . "  numeric ;");
                                    }
                                } else {
                                    if (! in_array($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1], $columns)) {

                                        DB::select("ALTER TABLE $database_utama ADD COLUMN " . "" . $page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1] . "  character varying(255) ;");
                                    }
                                }
                            }
                        }
                    }
                    if ($database_utama) {
                        if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi' or $page['crud']['total']['content'][$k]["type"] == 'input_no_result') {
                            if (! in_array("select_type_" . $page['crud']['total']['content'][$k]["id"], $columns)) {
                                DB::select("ALTER TABLE $database_utama ADD COLUMN " . "select_type_" . $page['crud']['total']['content'][$k]["id"] . "  character varying(255)  ;");
                            }
                            if (! in_array("total_" . $page['crud']['total']['content'][$k]["id"], $columns)) {
                                DB::select("ALTER TABLE $database_utama ADD COLUMN " . "total_" . $page['crud']['total']['content'][$k]["id"] . "  float8 ;");
                            }
                            if (! in_array($page['crud']['total']['content'][$k]["id"], $columns)) {
                                DB::select("ALTER TABLE $database_utama ADD COLUMN " . $page['crud']['total']['content'][$k]["id"] . "  float8 ;");
                            }
                        } else {
                            if (! in_array($page['crud']['total']['content'][$k]["id"], $columns)) {
                                if ($page['database_provider'] == 'mysql') {
                                    $sql = "ALTER TABLE $database_utama ADD COLUMN " . $page['crud']['total']['content'][$k]["id"] . "  float8 ;";
                                } else {
                                    $sql = "ALTER TABLE " . $page['conection_scheme'] . ".$database_utama ADD COLUMN " . $page['crud']['total']['content'][$k]["id"] . "  float8 ;";
                                }

                                DB::select($sql);
                            }
                        }
                    }
                }

                if (count($sqli_to_database)) {
                    $database_utama_temp = $database_utama;
                    foreach ($sqli_to_database as $key_to_db => $value_to_db) {
                        $database_utama = $database_utama_temp . "_" . $key_to_db;
                        $array          = $sqli_to_database[$key_to_db]['array'];

                        $primary_key              = null;
                        $page['sqli_to_database'] = Database::converting_primary_key($page, [$database_utama, $primary_key, ''], "select_utama");
                        Database::create_database_check($page, $array, $page['sqli_to_database']['utama'], $page['sqli_to_database']['primary_key'], $page['database_provider'], null, $database_utama_temp);
                        $columns        = DB::getColumnListing($page, $page['database_provider'], $database_utama);
                        $id_primary_key = Database::converting_primary_key($page, $database_utama_temp, "primary_key");
                        if (! in_array($id_primary_key, $columns)) {

                            DB::select("ALTER TABLE $database_utama ADD COLUMN $id_primary_key  numeric ;");
                        }
                    }
                }
            }

            if (in_array($page['load']['type'], ['edit', 'view'])) {

                $page['database']['where'][] = [$database_utama . "." . $page['database']['primary_key'], '=', $page['load']['id']];
            }
            if (! Partial::input('search-active', '_REQUEST')) {
                $page['database']['where'][] = [$database_utama . ".active", "=", 1];
            }

            $search = isset($page['crud']['search']) ? $page['crud']['search'] : [];
            foreach ($search as $key => $value) {
                if ($key <= -100) {
                } else if ($key == -1) {
                    if (Partial::input('search-active', '_REQUEST')) {
                        $searchactive = Partial::input('search-active', '_REQUEST') == -1 ? 0 : Partial::input('search-active', '_REQUEST');
                        if ($searchactive != 2) {
                            $page['database']['where'][] = [$database_utama . ".active", "=", $searchactive];
                        }

                    }
                } else if ($key == -2) {
                    if (Partial::input('status-appr', '_GET')) {
                        $page['database']['where'][] = [$database_utama . "." . $field_appr . "_status", "=", Partial::input('status-appr', '_GET')];
                    }
                } else {
                    $i = $key;

                    if ($array['array'][$i][2] == 'date') {
                        $row  = $array['array'][$i][1];
                        $dari = $row . '_dari';

                        if (Partial::input($dari, '_GET')) {
                            $page['database']['where'][] = [$row, ">=", Partial::input($dari, '_GET')];
                        }
                        if (Partial::input($row . '_sampai', '_GET')) {
                            $page['database']['where'][] = [$row, "<=", Partial::input($row . '_sampai', '_GET')];
                        }
                    } else {

                        $row = $array['array'][$i][1];
                        if (Partial::input($row)) {
                            $page['database']['where'][] = [$row, "=", Partial::input($row)];
                        }
                    }
                }
            }

            if (isset($page['crud']['table_group'])) {
                foreach ($page['crud']['table_group'] as $key => $value) {
                    for ($tg = 0; $tg < count($page['crud']['table_group'][$key]); $tg++) {
                        $field = $page['crud']['table_group'][$key][$tg];
                        if (array_key_exists($field, $perubahan)) {
                            $page['crud']['table_group'][$key][$tg] = $perubahan[$field];
                        }
                    }
                }
            }
            //field_value_automatic

            if (isset($page['crud']['miror_sub_kategori'])) {
                foreach ($page['crud']['miror_sub_kategori'] as $db_miror => $value) {
                    foreach ($value['array'] as $field_miror => $value_miror) {
                        if ($value_miror[0] == 'data') {
                            $to_event = 'miror_sub_kategori__' . $db_miror . '(this,\'<NUMBERING></NUMBERING>\',\'' . $field_miror . '\');';

                            if (isset($page['crud']['crud_inline'][$value_miror[1]])) {
                                $input_inline = $page['crud']['crud_inline'][$value_miror[1]];

                                if (strpos($input_inline, 'onchange=')) {
                                    $input_inline = str_replace('onchange="', 'onchange="' . $to_event . ';', $input_inline);
                                } else {
                                    $input_inline .= ' onchange="' . $to_event . '"';
                                }
                                if (strpos($input_inline, 'onkeyup=')) {
                                    $input_inline = str_replace('onkeyup="', 'onkeyup="' . $to_event . ';', $input_inline);
                                } else {
                                    $input_inline .= ' onkeyup="' . $to_event . '"';
                                }
                                $page['crud']['crud_inline'][$value_miror[1]] = $input_inline;
                            } else {

                                $page['crud']['crud_inline'][$value_miror[1]] = ' onchange="' . $to_event . '" onkeyup="' . $to_event . '"';
                            }
                        }
                    }
                }
            }
            if (isset($page['crud']['col_row'])) {
                foreach ($page['crud']['col_row'] as $key => $value) {
                    $temp_page = $page['crud']['col_row'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                           = $perubahan[$key];
                        $page['crud']['col_row'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['col_row'])) {
                foreach ($page['crud']['col_row'] as $key => $value) {
                    $temp_page = $page['crud']['col_row'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                           = $perubahan[$key];
                        $page['crud']['col_row'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['field_value_automatic'])) {
                foreach ($page['crud']['field_value_automatic'] as $key => $value) {
                    $temp_page = $page['crud']['field_value_automatic'][$key];
                    // if (array_key_exists($key, $perubahan)) {

                    $key = Database::converting_primary_key($page, $key, 'primary_key');

                    $page['crud']['field_value_automatic'][$key] = $temp_page;
                    // }
                }
            }

            if (isset($page['crud']['field_view_sub_kategori'])) {
                foreach ($page['crud']['field_view_sub_kategori'] as $key => $value) {
                    $temp_page = $page['crud']['field_view_sub_kategori'][$key];
                    // if (array_key_exists($key, $perubahan)) {

                    $key = Database::converting_primary_key($page, $key, 'primary_key');

                    $page['crud']['field_view_sub_kategori'][$key] = $temp_page;
                    // }
                }
            }
            // 
            if (isset($page['crud']['field_value_automatic_select_target'])) {
                foreach ($page['crud']['field_value_automatic_select_target'] as $key => $value) {

                    $temp_page = $page['crud']['field_value_automatic_select_target'][$key];

                    $key                                                       = Database::converting_primary_key($page, $key, 'primary_key');
                    $page['crud']['field_value_automatic_select_target'][$key] = $temp_page;

                    $page['crud']['field_value_automatic_select_target_select2'][$page['crud']['field_value_automatic_select_target'][$key]['target']]['request_where'] = $page['crud']['field_value_automatic_select_target'][$key]['request_where'];
                    $page['crud']['field_value_automatic_select_target_select2'][$page['crud']['field_value_automatic_select_target'][$key]['target']]['target']        = $key;
                }
            }
            //page['crud']['costum_class']
            if (isset($page['crud']['costum_class'])) {
                foreach ($page['crud']['costum_class'] as $key => $value) {
                    $temp_page = $page['crud']['costum_class'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                = $perubahan[$key];
                        $page['crud']['costum_class'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['crud_inline'])) {
                foreach ($page['crud']['crud_inline'] as $key => $value) {
                    $temp_page = $page['crud']['crud_inline'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                               = $perubahan[$key];
                        $page['crud']['crud_inline'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['insert_number_code'])) {
                foreach ($page['crud']['insert_number_code'] as $key => $value) {
                    $temp_page = $page['crud']['insert_number_code'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                      = $perubahan[$key];
                        $page['crud']['insert_number_code'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['insert_value'])) {
                foreach ($page['crud']['insert_value'] as $key => $value) {
                    $temp_page = $page['crud']['insert_value'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                = $perubahan[$key];
                        $page['crud']['insert_value'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['function'])) {
                foreach ($page['crud']['function'] as $key => $value) {
                    $temp_page = $page['crud']['function'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        unset($page['crud']['function'][$key]);
                        $key                            = $perubahan[$key];
                        $page['crud']['function'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['insert_number_code'])) {
                foreach ($page['crud']['insert_number_code'] as $key => $value) {
                    $temp_page = $page['crud']['insert_number_code'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                      = $perubahan[$key];
                        $page['crud']['insert_number_code'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['insert_default_value'])) {
                foreach ($page['crud']['insert_default_value'] as $key => $value) {
                    $temp_page = $page['crud']['insert_default_value'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                        = $perubahan[$key];
                        $page['crud']['insert_default_value'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['crud_after_form'])) {
                foreach ($page['crud']['crud_after_form'] as $key => $value) {
                    $temp_page = $page['crud']['crud_after_form'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                   = $perubahan[$key];
                        $page['crud']['crud_after_form'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['select_other'])) {
                foreach ($page['crud']['select_other'] as $key => $value) {
                    $temp_page = $page['crud']['select_other'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                = $perubahan[$key];
                        $page['crud']['select_other'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['select_database_costum'])) {
                foreach ($page['crud']['select_database_costum'] as $key => $value) {
                    $temp_page = $page['crud']['select_database_costum'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                          = $perubahan[$key];
                        $page['crud']['select_database_costum'][$key] = $temp_page;
                    }
                }
            }
            if (isset($page['crud']['crud_disabled_value'])) {
                foreach ($page['crud']['crud_disabled_value'] as $key => $value) {
                    $temp_page = $page['crud']['crud_disabled_value'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                       = $perubahan[$key];
                        $page['crud']['crud_disabled_value'][$key] = $temp_page;
                    }
                }
            }
            // if (isset($page['crud']['field_value_automatic_select_target'])) {
            // 	foreach ($page['crud']['field_value_automatic_select_target'] as $key => $value) {
            // 		$temp_page = $page['crud']['field_value_automatic_select_target'][$key];
            // 		if (array_key_exists($key, $perubahan)) {
            // 			$key = $perubahan[$key];
            // 			$page['crud']['field_value_automatic_select_target'][$key] = $temp_page;
            // 		}
            // 	}
            // }
            if (isset($page['crud']['field_view_sub_kategori'])) {
                foreach ($page['crud']['field_view_sub_kategori'] as $key_sub_kategori => $value) {
                    $temp_page = $page['crud']['field_view_sub_kategori'][$key_sub_kategori];
                    //if (array_key_exists($key_sub_kategori, $perubahan)) {
                    $key                                           = Database::converting_primary_key($page, $key, 'primary_key');
                    $page['crud']['field_view_sub_kategori'][$key] = $temp_page;
                    //}

                    $page['crud']['field_view_sub_kategori'][$key]['database'] = Database::converting_primary_key($page, $page['crud']['field_view_sub_kategori'][$key]['database'], "utama");
                    for ($v = 0; $v < count($page['crud']['field_view_sub_kategori'][$key]['field']); $v++) {

                        $key_index = $page['crud']['field_view_sub_kategori'][$key]['field'][$v][1];
                        if (array_key_exists($key_index, $perubahan)) {;
                            $page['crud']['field_view_sub_kategori'][$key]['field'][$v][1] = $perubahan[$key_index];}
                    }
                }
            }

            if (isset($page['crud']['field_value_automatic'])) {
                foreach ($page['crud']['field_value_automatic'] as $key => $value) {
                    $temp_page = $page['crud']['field_value_automatic'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                         = $perubahan[$key];
                        $page['crud']['field_value_automatic'][$key] = $temp_page;
                    }
                }
            }

            if (isset($page['crud']['search_load_sub_kategori'])) {
                foreach ($page['crud']['search_load_sub_kategori'] as $key_sub_kategori => $value) {
                    foreach ($page['crud']['search_load_sub_kategori'][$key_sub_kategori]['array_result'] as $key => $value) {
                        $temp_page = $page['crud']['search_load_sub_kategori'][$key_sub_kategori]['array_result'][$key];
                        if (array_key_exists($key, $perubahan)) {
                            $key                                                                               = $perubahan[$key];
                            $page['crud']['search_load_sub_kategori'][$key_sub_kategori]['array_result'][$key] = $temp_page;
                        }

                        $page['crud']['search_load_sub_kategori'][$key_sub_kategori]['database'] = Database::converting_primary_key($page, $page['crud']['search_load_sub_kategori'][$key_sub_kategori]['database'], "utama");
                    }
                }
            }
            if (isset($page['crud']['field_value_automatic_sub_kategori'])) {
                foreach ($page['crud']['field_value_automatic_sub_kategori'] as $key => $value) {
                    $temp_page = $page['crud']['field_value_automatic_sub_kategori'][$key];
                    if (array_key_exists($key, $perubahan)) {
                        $key                                                      = $perubahan[$key];
                        $page['crud']['field_value_automatic_sub_kategori'][$key] = $temp_page;
                    }
                    $page['crud']['field_value_automatic_sub_kategori'][$key]['database'] = Database::converting_primary_key($page, $page['crud']['field_value_automatic_sub_kategori'][$key]['database'], "utama");
                    if (strpos($page['crud']['field_value_automatic_sub_kategori'][$key]['request_where'], "<!ONTABLE>")) {
                        $get_table = substr($page['crud']['field_value_automatic_sub_kategori'][$key]['request_where'], 0, strpos($page['crud']['field_value_automatic_sub_kategori'][$key]['request_where'], "<!ONTABLE>") - 1);

                        $return                                                                    = Database::converting_primary_key($page, $get_table, "get");
                        $page['crud']['field_value_automatic_sub_kategori'][$key]['request_where'] = str_replace("<!ONTABLE></!ONTABLE>", $return['ONTABLE'], $page['crud']['field_value_automatic_sub_kategori'][$key]['request_where']);
                    }
                    if (isset($page['crud']['field_value_automatic_sub_kategori'][$key]['field'])) {
                        for ($f = 0; $f < count($page['crud']['field_value_automatic_sub_kategori'][$key]['field']); $f++) {

                            if (array_key_exists($page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$f][1], $perubahan)) {
                                $page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$f][1] = $perubahan[$page['crud']['field_value_automatic_sub_kategori']['produk_seq']['field'][$f][1]];
                            }
                        }
                    }
                }
            }
            $page['done_initialize'] = true;
            if (isset($select_temp) and $page['database_provider'] == 'postgres') {
                foreach ($select_temp as $value_select) {
                    $page['database']['select'][] = $value_select;
                }

            }
        }
        return $page;
    }
    public static function initialize_array($fai, $page, $array, $i, $field, $type, $extype)
    {

        $array['array'][$i][1] = strtolower(trim(str_replace('.', '', $array['array'][$i][1]))) . '';

        $field          = $array['array'][$i][1];
        $type           = $array['array'][$i][2];
        $text           = $array['array'][$i][0];
        $extypearray    = explode('-', $array['array'][$i][2]);
        $database_utama = $page['crud']['database_utama'] ?? '';
        $type_temp      = $type;
        $select         = [];
        $join           = [];
        $visible        = true;
        $get_select     = true;
        $required       = false;
        $is_master      = isset($page['database']['is_array']);
        if (! $text) {
            $array['array'][$i][0] = ucwords(str_replace('_', ' ', strtolower($field)));
            $text                  = $array['array'][$i][0];
        }
        if (! $field) {
            $array['array'][$i][1] = strtolower(str_replace(' ', '_', strtolower($text)));
            $field                 = $array['array'][$i][1];
        }
        if (isset($page['load']['database']['query']['select']) and ($type == 'select' or $type == 'select-relation')) {
            $get_select = true;
        } else if (isset($page['load']['database']['query']['select'])) {
            // $get_select = false;
        }

        if (! isset($page['crud']['view'])) {
            $page['crud']['view'] = $page['load']['type'] ?? '';
        }

        if (count($extypearray) > 1) {
            if (in_array('relation', $extypearray)) {
                $type = str_replace('-relation', '', $array['array'][$i][2]);
                if (in_array($page['crud']['view'], ['view']) or in_array($fai->input('_view'), ['view'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                // } else if (in_array('nosave', $extypearray)) {
                // 	$type = str_replace('-nosave', '', $array['array'][$i][2]);
                // 	if (in_array($page['crud']['view'], array('tambah')) or in_array($fai->input('_view'), array('tambah')))
                // 		$visible = true;
                // 	else
                // 		$visible = false;
            } else if (in_array('hidden_input', $extypearray)) {

                if (in_array($page['crud']['view'], ['list']) or in_array($fai->input('_view'), ['list'])) {
                    $visible = false;
                } else {
                    $visible = true;
                }

            } else if (in_array('table', $extypearray)) {

                if (in_array($page['crud']['view'], ['list']) or in_array($fai->input('_view'), ['list'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-table", "", $type);
            } else if (in_array('appr', $extypearray)) {

                if (in_array($page['crud']['view'], ['list', 'appr']) or in_array($fai->input('_view'), ['list', 'appr'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

            } else if (in_array('editview', $extypearray)) {
                $type = str_replace('-editview', '', $array['array'][$i][2]);
                if (in_array($page['crud']['view'], ['edit', 'view']) or in_array($fai->input('_view'), ['edit', 'view'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-editview", "", $type);
            } else if (in_array('crud', $extypearray)) {
                $type = str_replace('-crud', '', $array['array'][$i][2]);
                if (in_array($page['crud']['view'], ['edit', 'view', 'tambah']) or in_array($fai->input('_view'), ['edit', 'view', 'tambah'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-crud", "", $type);
            } else if (in_array('list', $extypearray)) {
                $type = str_replace('-list', '', $array['array'][$i][2]);
                if (in_array($page['crud']['view'], ['edit', 'view', 'tambah']) or in_array($fai->input('_view'), ['edit', 'view', 'tambah'])) {
                    $visible = false;
                } else {
                    $visible = true;
                }

                $array['array'][$i][2] = $type = str_replace("-list", "", $type);
            } else if (in_array('listeditview', $extypearray)) {
                $type = str_replace('-list', '', $array['array'][$i][2]);
                if (in_array($page['crud']['view'], ['edit', 'view', 'list']) or in_array($fai->input('_view'), ['edit', 'view', 'list'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-listeditview", "", $type);
            } else if ($type == ('editor-code')) {
                if (in_array($page['crud']['view'], ['edit', 'view', 'tambah']) or in_array($fai->input('_view'), ['edit', 'view', 'tambah'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

            } else if (in_array('edit', $extypearray)) {
                $type = str_replace('-edit', '', $array['array'][$i][2]);

                if (in_array($page['crud']['view'], ['edit']) or in_array($fai->input('_view'), ['edit'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-edit", "", $field);
            } else if (in_array('tambah', $extypearray)) {
                $type = str_replace('-tambah', '', $array['array'][$i][2]);

                if (in_array($page['crud']['view'], ['tambah']) or in_array($fai->input('_view'), ['tambah'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

                $array['array'][$i][2] = $type = str_replace("-tambah", "", $field);
            } else if (in_array('password', $extypearray)) {
                if (in_array($page['crud']['view'], ['tambah', 'edit']) or in_array($fai->input('_view'), ['tambah', 'edit'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

            } else if (in_array('tambah', $extypearray)) {
                $type = str_replace('-tambah', '', $array['array'][$i][2]);

                if (in_array($page['crud']['view'], ['tambah']) or in_array($fai->input('_view'), ['tambah'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

            } else if (in_array('hidden', $extypearray)) {

                if (in_array($page['crud']['view'], ['tambah']) or in_array($fai->input('_view'), ['tambah'])) {
                    $visible = true;
                } else {
                    $visible = false;
                }

            } else {
                $visible = true;
            }

        } else {
        }
        if ((in_array($page['crud']['view'], ['list']) or in_array($fai->input('_view'), ['list'])) and isset($page['non_view']['list'][$field])) {
            $visible = false;
        } else if ((in_array($page['crud']['view'], ['tambah']) or in_array($fai->input('_view'), ['tambah'])) and isset($page['non_view']['Tambah'][$field])) {
            $visible = false;
        } else if ((in_array($page['crud']['view'], ['edit']) or in_array($fai->input('_view'), ['edit'])) and isset($page['non_view']['Edit'][$field])) {
            $visible = false;
        } else if ((in_array($page['crud']['view'], ['hapus']) or in_array($fai->input('_view'), ['hapus'])) and isset($page['non_view']['Hapus'][$field])) {
            $visible = false;
        }

        // if (!empty($page['crud']['split_database']['array'][$field])) {
        // 	$visible = false;
        // }
        if ($type == 'select-manual-value') {
            $arrray_manual = $array['array'][$i][3];
            $array_set     = [];
            foreach ($arrray_manual as $key_manual => $value_manual) {
                $array_set[$value_manual] = ucwords($value_manual);
            }
            $array['array'][$i][3] = $array_set;
            $type                  = $array['array'][$i][2]                  = "select-manual";
        }
        if (in_array('req', $extypearray)) {
            if (isset($page['crud']['crud_inline'][$array['array'][$i][2]])) {
                $page['crud']['crud_inline'][$array['array'][$i][2]] .= " required ";
            } else {
                $page['crud']['crud_inline'][$array['array'][$i][2]] = " required ";
            }

            $type = $array['array'][$i][2] = str_replace("-req", "", $array['array'][$i][2]);
        }
        if (in_array('cur', $extypearray)) {

            $page['crud']['input_group']['prefix'][$field] = "Rp. ";
            $type                                          = $array['array'][$i][2]                                          = str_replace("-cur", "", $array['array'][$i][2]);
        }
        if (in_array('persen', $extypearray)) {

            $page['crud']['input_group']['sufix'][$field] = "%";
            $type                                         = $array['array'][$i][2]                                         = str_replace("-persen", "", $array['array'][$i][2]);
        }

        if (in_array('disable', $extypearray)) {
            if (isset($page['crud']['crud_inline'][$array['array'][$i][2]])) {
                $page['crud']['crud_inline'][$array['array'][$i][2]] .= " read ";
            } else {
                $page['crud']['crud_inline'][$array['array'][$i][2]] = " disabled ";
            }

            $type = $array['array'][$i][2] = str_replace("-disable", "", $array['array'][$i][2]);
        }
        if (in_array('kode', $extypearray)) {
            $page['crud']['insert_number_code'][$field]['prefix'] = isset($array['array'][$i][3]['prefix']) ? $array['array'][$i][3]['prefix'] : '';
            if ($array['array'][$i][3]['array'] == 'one') {

                $page['crud']['insert_number_code'][$field]['root']['type'][0]           = $array['array'][$i][3]['tipe'];
                $page['crud']['insert_number_code'][$field]['root']['sprintf'][0]        = true;
                $page['crud']['insert_number_code'][$field]['root']['sprintf_number'][0] = $array['array'][$i][3]['sprintf_number'];
                if (isset($array['array'][$i][3]['parent-separator'])) {

                    $page['crud']['insert_number_code'][$field]['parent-separator'] = $array['array'][$i][3]['parent-separator'];
                }
                if (isset($array['array'][$i][3]['data-parent'])) {

                    $page['crud']['insert_number_code'][$field]['data-parent'] = $array['array'][$i][3]['data-parent'];
                    if (isset($page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']])) {
                        $input_inline = $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']];

                        if (strpos($input_inline, 'onchange=')) {
                            $input_inline = str_replace('onchange="', 'onchange="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\');', $input_inline);
                        } else {
                            $input_inline .= ' onchange="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\')"';
                        }
                        $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']] = $input_inline;
                    } else {

                        $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']] = ' onchange="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\')"';
                    }
                    if (isset($page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']])) {
                        $input_inline = $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']];

                        if (strpos($input_inline, 'onclick=')) {
                            $input_inline = str_replace('onclick="', 'onclick="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\');', $input_inline);
                        } else {
                            $input_inline .= ' onclick="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\')"';
                        }
                        $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']] = $input_inline;
                    } else {

                        $page['crud']['crud_inline'][$array['array'][$i][3]['data-parent']] = ' onclick="insert_number_code_' . $field . '(\'<NUMBERING></NUMBERING>\')"';
                    }
                }
            }
            $page['crud']['insert_number_code'][$field]['suffix'] = isset($array['array'][$i][3]['suffix']) ? $array['array'][$i][3]['suffix'] : '';
            $type                                                 = $array['array'][$i][2]                                                 = str_replace("-disable", "", $array['array'][$i][2]);
        }
        if (in_array('en', $extypearray)) {

            $type = $array['array'][$i][2] = str_replace("-en", "", $array['array'][$i][2]);
        }
        if (in_array('number', $extypearray)) {
            $type = str_replace("-number", "", $type);
        }
        if (in_array('right', $extypearray)) {
            $type = str_replace("-right", "", $type);
        }
        if (in_array('req', $extypearray)) {
            $required = true;
            $type     = str_replace("-req", "", $type);
        }
        if (in_array('nonselect2', $extypearray)) {

            $data['nonselect2'] = true;
            $type               = str_replace("-nonselect2", "", $type);
        }
        $type                         = str_replace("-en", "", $type);
        $data['visible']              = $visible;
        $data['type']                 = $type;
        $data['i']                    = $i;
        $data['required']             = $required;
        $data['type_form_asal']       = $type_temp;
        $data['is_number']            = in_array('number', $extypearray) ? 1 : 0;
        $data['is_right']             = in_array('right', $extypearray);
        $data['enskripsi']            = in_array('en', $extypearray);
        $page['crud']['data'][$field] = $data;

        if ($type == 'array_website') {
            if (($array['array'][$i][4]['get'] === 'form_input_value')) {
                if (isset($page['crud']['crud_inline'][$array['array'][$i][2]])) {
                    $input_inline = $page['crud']['crud_inline'][$array['array'][$i][2]];

                    if (strpos($input_inline, 'onchange=')) {
                        $input_inline = str_replace('onchange="', 'onchange="array_website_form_input_value__' . $field . '(this,\'<NUMBERING></NUMBERING>\');', $input_inline);
                    } else {
                        $input_inline .= ' onchange="array_website_form_input_value__' . $field . '(this,\'<NUMBERING></NUMBERING>\')"';
                    }
                    $page['crud']['crud_inline'][$array['array'][$i][2]] = $input_inline;
                } else {

                    $page['crud']['crud_inline'][$array['array'][$i][4]['get']] = ' onchange="array_website_form_input_value__' . $field . '(this,\'<NUMBERING></NUMBERING>\')"';
                }
            }
        } else if ($type == 'select-from' and (in_array($page['crud']['view'], ['tambah']) or in_array($fai->input('_view'), ['tambah']))) {
            $page_select_form                                                                  = $page;
            $apps                                                                              = $fai->Apps($array['array'][$i][3]['apps'], $array['array'][$i][3]['page_view']);
            $array_select_form                                                                 = $apps['crud']['array'];
            $db_split                                                                          = $apps['database']['utama'];
            $page['crud']['split_database']['setting'][$db_split]['koneksi']['row_form_utama'] = $field;
            $page['crud']['split_database']['setting'][$db_split]['koneksi']['row_form_split'] = $array['array'][$i][3][1];
            $page['crud']['split_database']['setting'][$db_split]['database_to_row_split']     = $array['array'][$i][3][1];
            $array_select_form                                                                 = Database::converting_array_field($page, $array_select_form);

            for ($i_select_form = 0; $i_select_form < count($array_select_form); $i_select_form++) {
                $page['crud']['split_database']['array'][$array_select_form[$i_select_form][1]] = $db_split;
            }
        } else if ($array['array'][$i][2] == 'modalform-subkategori-add') {

            $array_mf   = $array['array'][$i][3]['array'];
            $array_mf[] = ["", Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), "number"];
            $array_mf[] = ["", Database::converting_primary_key($page, $page['crud']['database_utama'], 'primary_key'), "number"];
            Database::create_database_check(
                $page,
                $array_mf,
                $array['array'][$i][3]['database'],
                Database::converting_primary_key($page, $array['array'][$i][3]['database'], 'ontable'),
                $page['database_provider'],
                $page['app_framework']
            );

            $array['array'][$i][3]['array'] = Database::converting_array_field($page, $array['array'][$i][3]['array'], 'all')['array'];

            if (isset($array['array'][$i][3]['sub_kategori'])) {
                for ($hh = 0; $hh < count($array['array'][$i][3]['sub_kategori']); $hh++) {

                    if ($array['array'][$i][3]['sub_kategori'][$hh][2] == null) {
                        $array['array'][$i][3]['sub_kategori'][$hh][2] = Database::converting_primary_key($page, $array['array'][$i][3]['sub_kategori'][$hh][1], 'ontable');
                    }
                    $array_submf                                      = Database::converting_array_field($page, $array['array'][$i][3]['array_sub_kategori'][$hh], 'all')['array'];
                    $array['array'][$i][3]['array_sub_kategori'][$hh] = $array_submf;
                    $array_submf[]                                    = ["", Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), "number"];
                    $array_submf[]                                    = ["", Database::converting_primary_key($page, $page['crud']['database_utama'], 'primary_key'), "number"];
                    $array_submf[]                                    = ["", Database::converting_primary_key($page, $array['array'][$i][3]['database'], 'primary_key'), "number"];

                    Database::create_database_check($page, $array_submf, $array['array'][$i][3]['sub_kategori'][$hh][1], $array['array'][$i][3]['sub_kategori'][$hh][2], $page['database_provider'], $page['app_framework'], $page['database']['utama']);
                }
            }
        } else
        if (($type == 'select' or $type == 'checkbox' or $type == 'radio' or $type == 'select-relation') and $array['array'][$i][2] != 'number') {
            //
            $option   = $array['array'][$i][3];
            $database = $option[0];
            $key      = Database::converting_primary_key($page, $option[1], 'ontable');
            $value    = $option[2];
            if (! isset($array['array'][$i][3])) {

                echo $array['array'][$i][0] . "(" . $array['array'][$i][1] . ")" . ' Belum Lengkap';
                die;
            }
            // if (!($option[1])) {
            // 	$option[1] = Database::converting_primary_key($page, $database, 'ontable');
            // }
            // $database_utama = $page['database']['utama'];
            if (! isset($page['crud']['no_dm'][$field]) and ($page['crud']['database_utama'] ?? '')) {

                $database_manipulation = Packages::database_manipulation($page, $database, ["utama_primary" => $page['crud']['database_utama']], $array['array'], $i, 'page-array');

                $database = $array['array'][$i][3][0] = ($database_manipulation['utama']);
                if ((isset($database_manipulation['database_costum']['alias'])) and ! isset($array['array'][$i][3][3])) {

                    $option[3] = $array['array'][$i][3][3] = $database_manipulation['database_costum']['alias'];
                }
                if (isset($database_manipulation['database_costum']['field_select_value'])) {
                    $option[2] = $array['array'][$i][3][2] = $database_manipulation['database_costum']['field_select_value'];
                }

                // if (isset($database_manipulation['crud']['insert_value'])) {

                // 	foreach ($database_manipulation['crud']['insert_value'] as $to_key => $to_value) {
                // 		$page['crud']['insert_value'][$to_key] = $to_value;
                // 		$page['crud']['insert_default_value'][$to_key] = $to_value;
                // 	}
                // }
                if (isset($database_manipulation['crud']['crud_inline'])) {

                    foreach ($database_manipulation['crud']['crud_inline'] as $to_key => $to_value) {
                        $page['crud']['crud_inline'][$to_key] = $to_value;
                    }
                }
                if (isset($database_manipulation['database_all']['select'])) {

                    foreach ($database_manipulation['database_all']['select'] as $to_key => $to_value) {
                        $page['database']['select'][] = $to_value;
                    }
                }

                if (isset($database_manipulation['database_all']['where'])) {

                    foreach ($database_manipulation['database_all']['where'] as $to_key => $to_value) {
                        $page['database']['where'][] = $to_value;
                    }
                }
                if (isset($database_manipulation['database_all']['join'])) {

                    foreach ($database_manipulation['database_all']['join'] as $to_key => $to_value) {
                        $page['database']['join'][] = $to_value;
                    }
                }
            }

            $field;
            if (! isset($array['array'][$i][4])) {
                $array['array'][$i][4] = null;
            }
            if ($array['array'][$i][4]) {
                $field = $array['array'][$i][4];
            }

            $is_alias = false;
            $alias    = "";
            if (isset($option[3])) {
                if ($option[3]) {

                    $is_alias = true;
                    if ($option[1]) {
                        $key = $option[1];
                    }

                    $alias = $option[3];
                }
            }

            $field_select_on_internal_database_utama = (isset($array['array'][$i][5]) ? $array['array'][$i][5] : $field);
            if ($is_alias) {
                if (isset($option[4])) {
                    $join[] = ["$database as $alias", "" . $option[4] . "." . $field_select_on_internal_database_utama . "", "$alias.$key", "left"];
                } else {
                    $join[] = ["$database as $alias", "" . $database_utama . "." . $field_select_on_internal_database_utama . "", "$alias.$key", "left"];
                    //ini
                }
            } else {
                if (isset($option[4])) {
                    $join[] = ["$database", "" . $option[4] . "." . $field_select_on_internal_database_utama . "", "$database." . $option[1], 'left'];
                } else {
                    $join[] = ["$database", "" . $database_utama . "." . $field_select_on_internal_database_utama . "", "$database." . $option[1], 'left'];
                }
            }

            if (isset($page['crud']['select_database_costum'][$field]) and $page['section'] != 'field_view_sub_kategori') {

                if (isset($page['crud']['select_database_costum'][$field]['select'])) {
                    foreach ($page['crud']['select_database_costum'][$field]['select'] as $sdcs => $v) {

                        $select[] = $page['crud']['select_database_costum'][$field]['select'][$sdcs];
                    }
                }

                if (isset($page['crud']['select_database_costum'][$field]['join'])) {

                    for ($x = 0; $x < count($page['crud']['select_database_costum'][$field]['join']); $x++) {
                        $var                                                           = 'join';
                        $page['crud']['select_database_costum'][$field]['join'][$x][0] = Database::string_database($page, $fai, $page['crud']['select_database_costum'][$field]['join'][$x][0]);
                        $page['crud']['select_database_costum'][$field]['join'][$x][1] = Database::string_database($page, $fai, $page['crud']['select_database_costum'][$field]['join'][$x][1]);
                        $page['crud']['select_database_costum'][$field]['join'][$x][2] = Database::string_database($page, $fai, $page['crud']['select_database_costum'][$field]['join'][$x][2]);
                        $join[]                                                        = [$page['crud']['select_database_costum'][$field]['join'][$x][0], $page['crud']['select_database_costum'][$field]['join'][$x][1], $page['crud']['select_database_costum'][$field]['join'][$x][2], 'left'];
                    }
                }
            }
            //ID UNTUK SELECT
            $select[]                                                      = $id_select                                                      = Database::get_colomn_select($page, $array['array'][$i], $database_utama, 'id_select', 'select');
            $page['crud']['field_database'][$field][$database_utama]['id'] = Database::get_colomn_select($page, $array['array'][$i], $database_utama, 'id_select', 'row');
            //VALUE TABLE
            $select[]                                                         = $nama_select                                                         = Database::get_colomn_select($page, $array['array'][$i], $database_utama, 'value_table', 'select');
            $page['crud']['field_database'][$field][$database_utama]['value'] = Database::get_colomn_select($page, $array['array'][$i], $database_utama, 'value_table', 'row');
        } else if ($type == 'select-appr') {
            $select[]                                                         = $database_utama . "." . $field . " as " . $field . '_system_status_appr';
            $page['crud']['field_database'][$field][$database_utama]['value'] = $field . '_system_status_appr';
        } else if ($type == 'select-multiple-string') {
            $option   = $array['array'][$i][3];
            $database = $option[0];
            $key      = $option[1];
            $value    = $option[2];
            $select[] = $database_utama . "." . $field . " as " . $field . '_multiple';
        } else if ($type == 'file') {
            $join[]                                                           = ["drive__file as file_$field", "file_$field.ref_database='$database_utama' and file_$field.input_name", "'$field' and file_$field.ref_external_id=$database_utama.id", 'left'];
            $select[]                                                         = "(case when cast(file_$field.sizes as int)>0 then concat(file_$field.path,file_$field.file_name_save) else '' end) as " . $array['array'][$i][1] . '_' . $database_utama;
            $page['crud']['field_database'][$field][$database_utama]['value'] = $array['array'][$i][1] . '_' . $database_utama;
            // } else if ($type == 'editor-code') {
            // 	$concat = true;
            // 	if (isset($page['crud']['view'])) {
            // 		if ($page['crud']['view'] == "edit") {
            // 			$concat = false;
            // 		} else
            // 					if ($page['crud']['view'] == "view") {
            // 			$concat = false;
            // 		}
            // 	}
        } else if (in_array('dbalias', $extypearray)) {

            $alias                                                            = $array['array'][$i][3];
            $select[]                                                         = $alias[0] . "." . $alias[1] . " as " . $field;
            $page['crud']['field_database'][$field][$database_utama]['value'] = $field;
            $type                                                             = $array['array'][$i][2]                                                             = str_replace("-dbalias", "", $array['array'][$i][2]);
        } else if ($type == 'text-alias') {
            $alias                                                            = $array['array'][$i][3];
            $select[]                                                         = $database_utama . "." . $field . " as " . $alias;
            $page['crud']['field_database'][$field][$database_utama]['value'] = $alias;
            $type                                                             = $array['array'][$i][2]                                                             = str_replace("-alias", "", $array['array'][$i][2]);
        } else if ($type == 'database-join') {
            $option   = $array['array'][$i][1];
            $field    = $option[0];
            $database = $option[1];
            $key      = $option[2];
            $value    = $option[3];
            if (isset($option[4])) {
                $alias                                                            = $option[4];
                $join[]                                                           = ["$database as $alias", "$database_utama.$field", "$alias.$key", 'left'];
                $select[]                                                         = $alias . "." . $value . " as " . $value . '_' . $database . '_' . $alias;
                $page['crud']['field_database'][$field][$database_utama]['value'] = $value . '_' . $database . '_' . $alias;
            } else {
                $join[]                                                           = ["$database", "$database_utama.$field", "$database.$key", 'left'];
                $select[]                                                         = $database . "." . $value . " as " . $value . '_' . $database;
                $page['crud']['field_database'][$field][$database_utama]['value'] = $array['array'][$i][1] . '_' . $database_utama;
            }
        } else {

            if ($page['section'] != 'viewsource') {
                if ($page['section_initialize'] == 'crud_sub_kategori' and isset($page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field])) {
                } else
                if (! empty($page['crud']['split_database']['array'][$field]) and $page['section_initialize'] == 'crud_utama') {

                    $select[]                                                         = $page['crud']['split_database']['array'][$field] . "." . $array['array'][$i][1] . " as " . $array['array'][$i][1] . '_' . $page['crud']['split_database']['array'][$field];
                    $page['crud']['field_database'][$field][$database_utama]['value'] = $array['array'][$i][1] . '_' . $page['crud']['split_database']['array'][$field];
                } else {
                    if (1 == 0) {
                        $field_is_master = $array['array'][$i][1];
                        $master          = $database_utama . "_master";
                        $select[]        = "
						case
							when $database_utama.asal_barang_dari ='Master' and $database_utama.$field_is_master is null then $master.$field_is_master
							else $database_utama.$field_is_master
						end as tinggi_barang_inventaris__asset__list";
                        // "$database_utama . "." . $array['array'][$i][1] . " as " . $array['array'][$i][1] . '_' . $database_utama;
                    } else {
                        $select[] = $database_utama . "." . $array['array'][$i][1] . " as " . $array['array'][$i][1] . '_' . $database_utama;
                    }

                    $page['crud']['field_database'][$field][$database_utama]['value'] = $array['array'][$i][1] . '_' . $database_utama;
                }
            }
        }
        if ($get_select) {
            foreach ($select as $s => $vs) {
                if ($page['section_initialize'] == 'crud_utama') {
                    $page['database']['select'][] = $select[$s];
                } else if ($page['section_initialize'] == 'crud_sub_kategori') {
                    $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['select'][] = $select[$s];
                }

            }
        }
        foreach ($join as $j => $vj) {
            if ($page['section_initialize'] == 'crud_utama') {
                $page['database']['join'][] = $join[$j];
            } else if ($page['section_initialize'] == 'crud_sub_kategori') {
                $page['crud']['database_sub_kategori'][$page['crud']['database_utama']]['join'][] = $join[$j];
            }

        }
        return [
            'page'  => $page,
            'array' => $array,

        ];
    }
    public static function database_manipulation($page, $database_utama, $database, $array, $i, $return = '', $join = [])
    {
        $fai = new MainFaiFramework();
        if (! empty($array) and $return != 'database_converter') {

            $field  = $array[$i][1];
            $type   = $array[$i][2];
            $extype = explode('-', $type);
        }
        $database_all = [];
        $crud         = [];
        $db_join      = isset($database['join']) ? $database['join'] : [];
        if (! isset($database['non_repositioning_join'])) {
            unset($database['join']);
        }

        $database_costum = $database;
        // echo '<br>';
        // echo 'ini dbmanipulaion';;print_R($database);
        // echo '<br>';
        // echo '<br>';
        $database_utama = strtolower(trim($database_utama));
        if (! isset($page['load_section'])) {
            $page['load_section'] = "";
        }

        if ($database_utama == 'web__list_apps_menu') {
            if (! isset($database['non_add_select'])) {
                $database_costum['select'][] = "*,concat($database_utama.ambil_dari,' > ',(case when $database_utama.kode_link is not null then concat($database_utama.kode_link,'_',(select kode_webapps from web__apps where web__list_apps_menu.id_web_apps = web__apps.id )) when $database_utama.struktur_menu is null then concat(web__list_apps_menu.nama_menu,' > ',web__list_apps_menu.load_apps,' > ',web__list_apps_menu.load_page_view) else web__list_apps_menu.struktur_menu end)) as nama_menu";
            }

            $database_costum['order_by'][]    = ["web__list_apps_menu.load_apps", "asc"];
            $database_costum['order_by'][]    = ["web__list_apps_menu.struktur_menu", "asc"];
            $database_costum['non_privilage'] = true;
        } else if ($database_utama == 'outsourcing__mitra_penjualan') {

            $database_utama                             = "store__toko";
            $database_costum['alias']                   = "outsourcing__mitra_penjualan";
            $database_costum['field_select_value']      = "nama_toko";
            $database_costum['where'][]                 = ["outsourcing__mitra_penjualan.jenis_toko", "=", "'Mitra'"];
            $crud['insert_value']['jenis_toko']         = 'mitra';
            $crud['insert_default_value']['jenis_toko'] = 'mitra';
        } else if ($database_utama == 'outsourcing__brand') {
            $database_utama           = "store__toko";
            $database_costum['alias'] = "outsourcing__brand";
            if (! isset($database['non_add_select'])) {
                if (! isset($database_costum['select'])) {
                    $database_costum['select'][] = "*";
                }

                $database_costum['select'][] = "outsourcing__brand.nama_toko as nama_brand";
            }
            // echo '<br>';
            // echo '<br>';
            // print_R($database);
            $database_costum['field_select_value']       = "nama_toko";
            $database_costum['field_select_value_alias'] = "nama_brand";
            $database_costum['where'][]                  = ["outsourcing__brand.jenis_toko", "=", "'Brand'"];
            $crud['insert_value']['jenis_toko']          = 'Brand';
            $crud['insert_default_value']['jenis_toko']  = 'Brand';
        } else if ($database_utama == 'organisasi') {
            $database_utama           = "apps_user";
            $database_costum['alias'] = "organisasi";
            if (! isset($database['non_add_select'])) {
                if (! isset($database_costum['select'])) {
                    $database_costum['select'][] = "*";
                }

                $database_costum['select'][] = "organisasi.nama_lengkap as nama_organisasi";
            }
            // echo '<br>';
            // echo '<br>';
            // print_R($database);
            $database_costum['np']                     = "";
            $database_costum['field_select_value']     = "nama_lengkap";
            $database_costum['where'][]                = ["organisasi.tipe_user", "=", "'Organisasi'"];
            $crud['insert_value']['tipe_user']         = 'Organisasi';
            $crud['insert_default_value']['tipe_user'] = 'Organisasi';
        } else if ($database_utama == ' outsourcing__supplier') {

            $database_utama                             = "store__toko";
            $database_costum['where'][]                 = ["store__toko.jenis_toko", "=", "'Supplier'"];
            $crud['insert_value']['jenis_toko']         = 'Supplier';
            $crud['insert_default_value']['jenis_toko'] = 'Supplier';
        } else if ($database_utama == 'all_store_toko') {
            $database_costum['select'][] = "*
			,store__produk__varian.id as id_store_varian, inventaris__asset__list__varian.id as id_asset_varian
			, case when varian_barang='1' then 1 else 0 end as count_varian
			, case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok,
			, inventaris__asset__list.id as id_asset
                    , inventaris__asset__list__varian.id as id_varian
                    , inventaris__asset__list.varian_barang
                    , inventaris__asset__list.asal_barang_dari
                    , inventaris__asset__list.id_api
                    , inventaris__asset__list.id_sync
                    , inventaris__asset__list.id_from_api
                    , inventaris__asset__list__varian.asal_from_data_varian
                    , inventaris__asset__list__varian.id_api_varian
                    , inventaris__asset__list__varian.id_sync_varian
                    , inventaris__asset__list__varian.id_from_api_varian
			";
            $database_costum['utama'] = "store__produk";

            $database_utama                  = "store__produk";
            $database_costum['not_schema']   = true;
            $database_costum['not_checking'] = true;
            $database_costum['np']           = true;
            $database_costum['non_checking'] = true;
            $database_costum['join'][]       = ["inventaris__asset__list_query", "inventaris__asset__list.id", " store__produk.id_asset", "inner", "non_schema" => true];
            $database_costum['join'][]       = ["store__produk__varian", "store__produk__varian.id_store__produk", "  store__produk.id", "left"];
            $database_costum['join'][]       = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "store__produk__varian.id_barang_varian", "left"];
        } else if ($database_utama == ' outsourcing__distributor') {

            $database_utama = "store__toko";

            $database_costum['where'][]                 = ["store__toko.jenis_toko", "=", "'Distributor'"];
            $crud['insert_value']['jenis_toko']         = 'Distributor';
            $crud['insert_default_value']['jenis_toko'] = 'Distributor';
        } else if ($database_utama == 'inventaris__asset__list__varian_db') {

            $database_utama = "inventaris__asset__list__varian";
        } else if ($database_utama == 'inventaris__asset__list__varian') {

            $getarray = Pages::Apps('Inventaris_aset', 'asset_list');
            $getarray = Database::converting_array_field($page, $getarray['sub_kategori_varian']);
            // $database_costum['join'][] = array("$database_utama  as " . $database_utama . "_master", "" . $database_utama . "_master.id ", $database_utama . '.id_master', 'left');
            $db_master                                               = $database_utama . "_master";
            $select_varian                                           = [];
            $list_array_asset_varian                                 = [];
            $list_array_asset_varian["nama_varian"]                  = "nama_barang";
            $list_array_asset_varian["berat_varian"]                 = "berat";
            $list_array_asset_varian["harga_pokok_penjualan_varian"] = "harga_pokok_penjualan";
            $list_array_asset_varian["barcode_varian"]               = "barcode";
            $list_array_asset_varian["sku_index_varian"]             = "sku";
            $list_array_asset_varian["foto_aset_varian"]             = "foto_aset";
            $list_array_asset_varian["id_api_varian"]                = "id_api";
            $list_array_asset_varian["id_from_api_varian"]           = "id_from_api";
            $list_array_asset_varian["id_sync_varian"]               = "id_sync";
            $list_array_asset_varian["asal_from_data_varian"]        = "asal_barang_dari";
            // $list_array_asset_varian["id_master_varian"] = "id_master";
            foreach ($getarray as $key => $value_array) {
                // print_R($value_array);
                $field_array = $value_array[1];

                if ($value_array[2] == 'select') {
                    // echo '1';
                    $db_select = $value_array[3][0];
                    $db_get    = Packages::database_manipulation($page, $db_select, [], [], -1);

                    $field_select   = $value_array[3][2];
                    $db_select      = $db_get['utama'] . "_$field_array";
                    $db_select_asli = $db_get['utama'] . "";
                    //        when $database_utama.asal_barang_dari ='Master' and $database_utama.id_brand is not null then outsourcing__brand.nama_toko 
                    if (isset($db_get['database_costum']['field_select_value'])) {

                        $field_select = $db_get['database_costum']['field_select_value'];
                    }
                    $as_asli_select = $field_select;
                    if (! empty($value_array[3][3])) {
                        $as_asli_select .= "_" . $value_array[3][3];
                    }
                    $field_with_db        = substr($field_select . "_" . $db_select, 0, 60);
                    $field_with_db_master = substr($field_array . "_" . $db_master, 0, 60);
                    // 			case 
                    // 			when $database_utama.asal_from_data_varian ='Master' and $database_utama.$field_array is null 
                    // 			then " . $db_select . "_master." . $field_select . " 
                    // 			else $db_select" . "__relation." . $field_select . " 
                    // 		end as " .$field_with_db . ",
                    // 	case 
                    // 			when $database_utama.asal_from_data_varian ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . " 
                    // 			else $database_utama." . $field_array . " 
                    // 		end as " . $field_with_db_master . ",
                    $select_varian[] = "

						case
							when $database_utama.asal_from_data_varian ='Master' and $database_utama.$field_array is null then " . $db_select . "_master." . $field_select . "
							else $db_select" . "__relation." . $field_select . "
						end as $as_asli_select,


						case
								when $database_utama.asal_from_data_varian ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
								else $database_utama." . $field_array . "
								end as " . $field_array . "
						";
                    $join_varian[] = $db_select_asli . " as " . $db_select . "_master on $db_master.$field_array = " . $db_select . "_master.id";
                    $join_varian[] = $db_select_asli . " as " . $db_select . "__relation on " . $db_master . "." . $field_array . "=" . $db_select . "__relation.id";
                } else {
                    // echo '2';
                    //when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is not null then $database_utama." . $field_array . " 

                    if (isset($list_array_asset_varian[$field_array])) {
                        $inv_row       = $list_array_asset_varian[$field_array];
                        $field_with_db = substr($field_array . "_" . $db_master, 0, 65);
                        // 		case 
                        // 		when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian ='Asset' then inventaris__asset__list.$inv_row
                        // 	    when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian !='Asset'	then $db_master." . $field_array . " 
                        // 		else $database_utama." . $field_array . " 
                        // 	end as " . $field_with_db . ",
                        $select_varian[] = "

						case
						when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian ='Asset' then inventaris__asset__list.$inv_row
					    when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian !='Asset'	then $db_master." . $field_array . "
						else $database_utama." . $field_array . "
					end as " . $field_array . "
					";
                    } else {
                        $field_with_db = substr($field_select . "_" . $db_select, 0, 50);
                        //                     		case 
                        // 		when $database_utama.asal_from_data_varian ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . " 
                        // 		else $database_utama." . $field_array . " 
                        // 		end as " . $field_with_db . ",
                        $select_varian[] = "

						case
						when $database_utama.asal_from_data_varian ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
						else $database_utama." . $field_array . "
						end as " . $field_array . "

						";
                    }
                }
            }
            $database_utama_temp = $database_utama;
            $join_varian         = array_unique($join_varian);
            $database_utama_with = "SELECT
			$database_utama.id,
			$database_utama.id_inventaris__asset__list,
			$database_utama.active,
			$database_utama.on_domain,
			$database_utama.on_board,
			$database_utama.on_panel,
			$database_utama.on_role ,
			$database_utama.create_date,
			$database_utama.create_by,
			$database_utama.update_by,
			$database_utama.update_date,
			$database_utama.delete_date,
			$database_utama.delete_by,
			$database_utama.privilege ,
			" . implode(',', $select_varian) . "
			from $database_utama
			left join $database_utama as " . $database_utama . "_master on $database_utama.id_master_varian = " . $database_utama . "_master.id
			LEFT JOIN inventaris__asset__list on inventaris__asset__list.id =  case
						when inventaris__asset__list__varian.asal_from_data_varian ='Master' and inventaris__asset__list__varian_master.asal_from_data_varian='Asset' then inventaris__asset__list__varian_master.id_asset_list_varian
						else inventaris__asset__list__varian.id_asset_list_varian
						end
			LEFT JOIN " . implode('
			 LEFT JOIN ', $join_varian) . "
			 WHERE <PROCEDURE-WHERE>
			 ";

            $database_utama           = "view_varian";
            $database_costum['alias'] = "$database_utama_temp";
            $database_utama           = $database_costum['utama']           = "view_varian";
            $database_costum['alias'] = "$database_utama_temp";

                                                                                                                                   //  $database_costum['procedure'][] = ["$database_utama_with","varian",str_replace('.','_',$join[1]),$join[1]]; //query//name//parameter
            $database_costum['view'][]       = ["$database_utama_with", "view_varian", str_replace('.', '_', $join[1]), $join[1]]; //query//name//parameter
            $database_costum['not_schema']   = true;
            $database_costum['no_checking']  = true;
            $database_costum['not_checking'] = true;
        } else if ($database_utama == 'inventaris__asset__list' and ! isset($database['non_add_select'])) {

            $database_costum['is_master'] = true;
            if (! isset($database['non_master'])) {
                $getarray                  = Pages::Apps('Inventaris_aset', 'asset_list');
                $getarray                  = Database::converting_array_field($page, $getarray['crud']['array']);
                $database_costum['join'][] = ["$database_utama  as " . $database_utama . "_master", "" . $database_utama . "_master.id ", $database_utama . '.id_master', 'left'];
                $db_master                 = $database_utama . "_master";
                $database_utama_temp       = $database_utama;

                $select_varian           = [];
                $list_array_asset_varian = [];

                $database_costum['alias']        = "$database_utama_temp";
                $database_costum['not_schema']   = true;
                $database_costum['no_checking']  = true;
                $database_costum['not_checking'] = true;

                foreach ($getarray as $key => $value_array) {
                    // print_R($value_array);
                    $field_array = $value_array[1];

                    if ($value_array[2] == 'select') {
                        // echo '1';
                        $db_select = $value_array[3][0];
                        $db_get    = Packages::database_manipulation($page, $db_select, [], [], -1);

                        $db_select       = $db_get['utama'];
                        $db_alias        = isset($db_get['database_costum']['alias']) ? $db_get['database_costum']['alias'] : $db_get['utama'];
                        $field_select_as = $value_array[3][2];
                        $field_select    = $value_array[3][2];
                        //        when $database_utama.asal_barang_dari ='Master' and $database_utama.id_brand is not null then outsourcing__brand.nama_toko 
                        if (isset($db_get['database_costum']['field_select_value'])) {

                            $field_select = $db_get['database_costum']['field_select_value'];
                        }

                        $database_costum['select'][] = "
						case
							when $database_utama.asal_barang_dari ='Master' and $database_utama.$field_array is null then " . $db_alias . "_master." . $field_select . "
							else $db_select" . "__relation." . $field_select . "
						end as " . $field_select . "_" . $db_select . ",
						case
							when $database_utama.asal_barang_dari ='Master' and $database_utama.$field_array is null then " . $db_alias . "_master." . $field_select . "
							else $db_select" . "__relation." . $field_select . "
						end as " . $field_select_as . ",
						case
								when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
								else $database_utama." . $field_array . "
							end as " . $field_array . "_inventaris__asset__list,
						case
								when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
								else $database_utama." . $field_array . "
								end as " . $field_select_as . "
						";
                        $database_costum['join'][] = [$db_select . " as " . $db_alias . "_master", "$db_master.$field_array", $db_alias . "_master.id", "LEFT"];
                        $database_costum['join'][] = [$db_select . " as " . $db_alias . "__relation", "$db_master.$field_array", $db_alias . "__relation.id", "LEFT"];
                    } else {
                        // echo '2';
                        //when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is not null then $database_utama." . $field_array . " 
                        $database_costum['select'][] = "
					 case
					        when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
					        else $database_utama." . $field_array . "
					    end as " . $field_array . "_inventaris__asset__list,
					 case
					        when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
					        else $database_utama." . $field_array . "
							end as " . $field_array . "

							";
                    }
                }
            }
        } else if ($database_utama == 'inventaris__asset__list_query') {
            $database_utama               = 'inventaris__asset__list';
            $database_costum['is_master'] = true;
            if (! isset($database['non_master'])) {
                $getarray = Pages::Apps('Inventaris_aset', 'asset_list');
                $getarray = Database::converting_array_field($page, $getarray['crud']['array']);
                // $database_costum['join'][] = array("$database_utama  as " . $database_utama . "_master", "" . $database_utama . "_master.id ", $database_utama . '.id_master', 'left');
                $db_master = $database_utama . "_master";

                $select_varian           = [];
                $list_array_asset_varian = [];
                foreach ($getarray as $key => $value_array) {

                    $field_array = $value_array[1];

                    if ($value_array[2] == 'select') {
                        // echo '1';
                        $db_select = $value_array[3][0];
                        $db_get    = Packages::database_manipulation($page, $db_select, [], [], -1);

                        $field_select_as = $value_array[3][2];
                        $field_select    = $value_array[3][2];
                        $db_select       = $db_get['utama'] . "_$field_array";
                        $db_select_asli  = $db_get['utama'] . "";
                        //        when $database_utama.asal_barang_dari ='Master' and $database_utama.id_brand is not null then outsourcing__brand.nama_toko 
                        if (isset($db_get['database_costum']['field_select_value'])) {

                            $field_select = $db_get['database_costum']['field_select_value'];
                        }
                        $field_with_db        = substr($field_select_as . "_" . $db_select, 0, 50);
                        $field_with_db_master = substr($field_array . "_" . $db_master, 0, 50);
                        $select_varian[]      = "
						case
							when $database_utama.asal_barang_dari ='Master' and $database_utama.$field_array is null
							then " . $db_select . "_master." . $field_select . "
							else $db_select" . "__relation." . $field_select . "
						end as " . $field_with_db . ",
						case
							when $database_utama.asal_barang_dari ='Master' and $database_utama.$field_array is null then " . $db_select . "_master." . $field_select . "
							else $db_select" . "__relation." . $field_select . "
						end as " . $field_select_as . ",
						case
								when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
								else $database_utama." . $field_array . "
							end as " . $field_with_db_master . ",

						case
						when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
						else $database_utama." . $field_array . "
						end as " . $field_array . "
				";
                        $join_varian[] = $db_select_asli . " as " . $db_select . "_master on $db_master.$field_array = " . $db_select . "_master.id";
                        $join_varian[] = $db_select_asli . " as " . $db_select . "__relation on " . $db_master . "." . $field_array . "=" . $db_select . "__relation.id";
                    } else {
                        // echo '2';
                        //when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is not null then $database_utama." . $field_array . " 

                        // if (isset($list_array_asset_varian[$field_array])) {
                        // 	$inv_row = $list_array_asset_varian[$field_array];
                        // 	$select_varian[] = "
                        // 	case 
                        // 	when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian ='Asset' then inventaris__asset__list.$inv_row
                        //     when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian !='Asset'	then $db_master." . $field_array . " 
                        // 	else $database_utama." . $field_array . " 
                        // end as " . $field_array . "_" . $db_master . ",
                        // 	case 
                        // 	when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian ='Asset' then inventaris__asset__list.$inv_row
                        //     when $database_utama.asal_from_data_varian ='Master' and $database_utama.nama_varian is null and $db_master.asal_from_data_varian !='Asset'	then $db_master." . $field_array . " 
                        // 	else $database_utama." . $field_array . " 
                        // end as " . $field_array . "
                        // ";
                        // } else {

                        $select_varian[] = "
						case
						when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
						else $database_utama." . $field_array . "
						end as " . $field_array . "_" . $db_master . ",
						case
						when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
						else $database_utama." . $field_array . "
						end as " . $field_array . ",
						case
					        when $database_utama.asal_barang_dari ='Master' and $database_utama." . $field_array . " is null then $db_master." . $field_array . "
					        else $database_utama." . $field_array . "
					    end as " . $field_array . "_inventaris__asset__list


						";
                        // }
                    }
                }
                $database_utama_temp = $database_utama;
                $join_varian         = array_unique($join_varian);
                $database_utama_with = " SELECT
        			$database_utama.id,
        			$database_utama.active,
        			$database_utama.on_domain,
        			$database_utama.on_board,
        			$database_utama.on_panel,
        			$database_utama.on_role ,
        			$database_utama.create_date,
        			$database_utama.create_by,
        			$database_utama.update_by,
        			$database_utama.update_date,
        			$database_utama.delete_date,
        			$database_utama.delete_by,
        			$database_utama.privilege ,
        			" . implode(',', $select_varian) . "
        			from $database_utama
        			left join $database_utama as " . $database_utama . "_master on $database_utama.id_master = " . $database_utama . "_master.id

        			LEFT JOIN " . implode('
        			 LEFT JOIN ', $join_varian) . "
        			WHERE <PROCEDURE-WHERE> ";

                // $database_costum['with'][] = "$database_utama_with";
                $database_utama           = $database_costum['utama']           = "view_inventaris_list";
                $database_costum['alias'] = "$database_utama_temp";

                //  $database_costum['procedure'][] = ["$database_utama_with","inventaris_list",str_replace('.','_',$join[1]),$join[1]]; //query//name//parameter
                //  $database_costum['function'][] = ["$database_utama_with","inventaris_list",str_replace('.','_',$join[1]),$join[1]]; //query//name//parameter
                $database_costum['view'][] = [
                    "$database_utama_with",
                    "view_inventaris_list",
                    str_replace('.', '_', $join[1] ?? "inventaris__asset__list.id"),
                    $join[1] ?? "inventaris__asset__list.id",
                ]; //query//name//parameter
                $database_costum['not_schema']   = true;
                $database_costum['no_checking']  = true;
                $database_costum['not_checking'] = true;
            }
        } else if ($database_utama == 'inventaris__asset__tanah__bangunan') {
            // $database_costum['join'][] = ["inventaris__asset__tanah__bangunan__pengisi", 'inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan', "inventaris__asset__tanah__bangunan.id"];
            // $database_costum['where'][] = ["inventaris__asset__tanah__bangunan__pengisi.id_apps_user", '=', "'" . $_SESSION['id_apps_user'] . "'"];
        } else if ($page['load_section'] == 'admin') {
            //pembatas jika admin 
            //atas = filter untuk semua user
            //bawah = filter kecuali admin
        } else if ($database_utama == 'panel') {

            $id_list_panel = WorkspaceApp::get_panel_board($fai, $page, $page['load']['board'] ?? -1);
            if ($id_list_panel and isset($field)) {

                $database_costum['where'][] = ['panel.id', ' in ', '(' . $id_list_panel . ')'];
                $database_all['where'][]    = ['(case when ' . $page['crud']['database_utama'] . '.' . $field . ' is not null and panel_relation.id in (' . $id_list_panel . ') then 1 when ' . $page['crud']['database_utama'] . '.' . $field . ' is null  then 1 else 0 end )', ' = ', '1'];
                $database_all['join'][]     = ['panel  as panel_relation', ' panel_relation.id ', $page['crud']['database_utama'] . '.id_panel', 'left'];
            }
        } else if ($database_utama == 'organisasi' and $database_utama != 'web__list_apps_board__entitas') {
            if ($_SESSION['hak_akses'] == 'organisasi') {
                $crud['insert_value']['id_organisasi'] = $_SESSION['id_organisasi'];
                $crud['crud_inline']['id_organisasi']  = " read-only ";
                // $database_all['where'][] = array($page['crud']['database_utama'] . ".$field", '=', $_SESSION['id_organisasi']);
                $database_costum['where'][] = ["organisasi.id", '=', $_SESSION['id_organisasi']];
            }
            if ($page['load']['board'] and $page['load']['board'] != -1 and isset($field)) {
                $id_list_organisasi = WorkspaceApp::get_organisasi_board($fai, $page, $page['load']['board']);
                // $database_all['where'][] = array($page['crud']['database_utama'] . ".$field", ' in ', "($id_list_organisasi)");
                $database_costum['where'][] = ["organisasi.id", ' in ', "($id_list_organisasi)"];
            }
        } else if ($database_utama == 'web__list_apps_board') {
            $crud['insert_value']['id_web__list_apps_board'] = $page['load']['board'];
            $crud['crud_inline']['id_web__list_apps_board']  = " read-only ";
            $database_costum['where'][]                      = ["web__list_apps_board.id", '=', $page['load']['board']];
        }
        if (count($db_join) and ! isset($database['non_repositioning_join'])) {
            foreach ($db_join as $key) {
                $database_costum['join'][] = $key;
            }
        }
        if (! empty($database_costum['join'])) {
            for ($j = 0; $j < count($database_costum['join']); $j++) {

                $database_manipulation = Packages::database_manipulation($page, trim($database_costum['join'][$j][0]), [], [], "", 'page-array', $database_costum['join'][$j]);
                //print_R($database_manipulation);
                $database_costum['join'][$j][0] = $database_manipulation['utama'] . '' . (isset($database_manipulation['database_costum']['alias']) ? " as " . $database_manipulation['database_costum']['alias'] : '');

                if (isset($database_manipulation['database_costum']['not_schema'])) {
                    $database_costum['join'][$j]['non_schema'] = true;
                }
                if (count($database_manipulation['database_costum']) and ! isset($database['non_add_select'])) {
                    if (isset($database_manipulation['database_costum']['select'])) {
                        foreach ($database_manipulation['database_costum']['select'] as $w => $ww) {
                            $database_costum['select'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['join'])) {
                        foreach ($database_manipulation['database_costum']['join'] as $w => $ww) {
                            $database_costum['join'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['with'])) {
                        foreach ($database_manipulation['database_costum']['with'] as $w => $ww) {
                            $database_costum['with'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['procedure'])) {
                        foreach ($database_manipulation['database_costum']['procedure'] as $w => $ww) {
                            $database_costum['procedure'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['function'])) {
                        foreach ($database_manipulation['database_costum']['function'] as $w => $ww) {
                            $database_costum['function'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['view'])) {
                        foreach ($database_manipulation['database_costum']['view'] as $w => $ww) {
                            $database_costum['view'][] = $ww;
                        }
                    }
                    if (isset($database_manipulation['database_costum']['where'])) {
                        $where = "";
                        foreach ($database_manipulation['database_costum']['where'] as $w => $ww) {
                            $where .= " and " . $database_manipulation['database_costum']['where'][$w][0] . " " . $database_manipulation['database_costum']['where'][$w][1] . " " . $database_manipulation['database_costum']['where'][$w][2];
                        }
                        $database_costum['join'][$j][2] = $database_costum['join'][$j][2] . $where;
                    }
                }
                // 	$database_costum = array_merge($database_costum, $database_manipulation['database_costum']);
            }
        }

        if (! empty($database_costum['select_database'])) {
            for ($j = 0; $j < count($database_costum['select_database']); $j++) {

                $get_select = Database::database_coverter($page, $database_costum['select_database'][$j], [], 'all')['query'];

                $database_costum['select'][] = "(" . $get_select . ') as ' . $database_costum['select_database'][$j]['as'];
                unset($database_costum['select_database'][$j]);
            }
        }
        if (! empty($database_costum['join_subquery'])) {

            for ($j = 0; $j < count($database_costum['join_subquery']); $j++) {

                $get_select = Database::database_coverter($page, $database_costum['join_subquery'][$j][0], [], 'source');

                $database_costum['join'][] = [
                    " ($get_select) as " . $database_costum['join_subquery'][$j][0]['as'],
                    $database_costum['join_subquery'][$j][1],
                    $database_costum['join_subquery'][$j][2],
                    'left',
                    "non_schema" => true,
                ];
            }

            unset($database_costum['join_subquery']);
        }
        if (! empty($database_costum['union'])) {
            $union = [];
            for ($j = 0; $j < count($database_costum['union']['subquery']); $j++) {
                // print_r($database_costum['union']['subquery'][$j]);
                $get_select = Database::database_coverter($page, $database_costum['union']['subquery'][$j], [], 'all')['query'];
                // echo $get_select;
                // echo '<br>';
                // echo '<br>';
                $union[] = "($get_select) ";
            }
            $database_costum['query'] = "(" . implode(' union ' . $database_costum['union']['type_onion'], $union) . ')  ';
            unset($database_costum['union']);
        }
        if (! empty($database_costum['utama_query'])) {
            $union = [];
            // print_R($database_costum['utama_query']);
            // print_r($database_costum['union']['subquery'][$j]);
            $get_select = Database::database_coverter($page, $database_costum['utama_query'], [], 'source');
            // echo $get_select;
            // echo '<br>';
            // echo '<br>';
            $database_costum['not_schema']       = true;
            $database_costum['np']               = true;
            $database_costum['not_where_active'] = true;
            $database_utama                      = $database_costum['utama']                      = "($get_select) as " . $database_costum['utama_query']['as'];
            unset($database_costum['utama_query']);
        }

        // $database_costum['utama'] = $database_utama;
        if ($database_utama == 'organisasi') {
            $database_costum['primary_key'] = "id";
        }
        if (empty($database_costum['primary_key'])) {
            // $database_costum['primary_key'] = Database::converting_primary_key($page,$database_utama,'primary_key'); 
            $database_costum['primary_key'] = Database::converting_primary_key($page, $database_utama, 'ontable');
        }
        // if(isset($database_costum['where'])){

        // 	foreach($database_costum['where'] as $key => $to_where){
        // 		foreach($to_where as $key_where=>$value_where){

        // 			$database_costum['where'][$key][$key_where] = Database::string_database($page,$fai,$value_where);
        // 		}
        // 	}
        // }
        // echo '<br>';
        // echo '<br>';
        // 		print_r($database_costum);
        return [
            "database_costum" => $database_costum,
            "crud"            => $crud,
            "database_all"    => $database_all, //database dari crud yang mempengaruhi database utama
            "utama"           => $database_utama,
        ];
    }
    public static function step($page, $step_id, $step, $step_content, $database, $content_template = '')
    {

        $content_form          = "";
        $fai                   = new MainFaiFramework();
        $content_template_temp = $content_template;
        if ($step['view'] == 'crud') {
            $to_array        = $step['var_content'];
            $array           = $step_content[$to_array];
            $page['section'] = 'card';

            $page['crud'] = isset($step['function_crud']) ? $step['function_crud'] : [];

            $page['crud']['array'] = $array;
            $page['database']      = $database;
            $page['route']         = $page['load']['route_page'];

            $page['crud']['view'] = 'tambah';
            $page['crud']['type'] = 'tambah';
            $page['type']         = 'tambah';
            $page['id']           = -1;
            $content_form         = "";

            $page['crud']['inside_js'] = 1;

            $fai          = new MainFaiFramework();
            $content      = CrudContent::vte_main($page, $fai);
            $content_form = $content;
            $next         = 0;
            $next_id      = null;
            if (isset($step['next'])) {
                $next_id = $step['next'];
                $next    = 1;
            }
            $content_form .= '<button class="btn btn-primary d-grid w-100" type="button" onclick="submit_daftar(' . $next . ',' . $step_id . ',' . $next_id . ')">Save</button>';
        } else if ($step['view'] == 'view_website') {
            $to_array        = $step['var_content'];
            $page['website'] = $step_content[$to_array];
            $content_form .= Packages::view_website($page, '');
        } else if ($step['view'] == 'get_code') {
            $content_form = '<div class="card-body">
						<h3 class="card-title text-center mb-4 h3 fz-20 bold strong">Kode Verifikasi</h3>
						<div id="wrapper">
							<div id="dialog">

								<h4>Masukan 4 Digit Angka yang kami kirimkan ke email anda</h4>
								<div class="text-muted">Email : G1aqxxVkwdwfa2zH73gBBoV2hiNltjChp1yuoV2hi</div>
								<div class="text-muted">Cek di Kotak Masuk atau Spam email Anda</div>
								<div id="form">
									<input type="text" id="val1" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
									<input type="text" id="val2" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
									<input type="text" id="val3" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
									<input type="text" id="val4" maxlength="1" size="1" min="0" max="9" pattern="[0-9]{1}">
								<div class="d-flex justify-content-center">

									<button class="btn btn-default btn-embossed mt-3 mb-3 w-30 me-1" type="button" onclick="">Verifikasi Nanti </button>
									<button class="btn btn-primary btn-embossed mt-3 mb-3 w-50" type="button" onclick="submit_daftar()">Verifikasi</button>
								</div>
								</div>

								<div>
									Tidak Mendapatkan Kode?<br>
									<a href="#" onclick="kirim_ulang()">Kirim Ulang Kode</a><br>
									<a href="http://localhost/FrameworkServer/hibe3/auth-ganti-email.html">Ganti Email</a>
								</div>

							</div>
						</div>

						';
        }
        $step['view'];
        if ($content_template_temp) {
            $content_template = str_ireplace("<FORM-CONTENT></FORM-CONTENT>", $content_form, $content_template);
        } else {
            $content_template .= $content_form;
        }

        if (isset($step['content'])) {
            foreach ($step['content'] as $tag => $value) {
                $content = "";

                for ($i = 0; $i < count($step['content'][$tag]); $i++) {
                    $data = $step['content'][$tag][$i];
                    if ($data['type'] == 'logo') {
                        $content .= '<div class="app-brand justify-content-center text-center">
								<span class="app-brand-logo demo"><img src="' . $data['content'] . '" height="50px"></span>
						  </div>';
                    } else if ($data['type'] == 'button') {

                        $content .= Content::parse_button($page, $data['array'], [], new MainFaiFramework);
                    } else if ($data['type'] == 'text') {
                        $content .= $data['content'];
                    }
                }
                if ($content_template_temp) {
                    $content_template = str_ireplace("<" . strtoupper($tag) . "></" . strtoupper($tag) . ">", $content, $content_template);
                } else {
                    $content_template .= $content;
                }

            }
        }

        // if (isset($array)) {
        // 	$content_template .= $fai->view('crud/validation_javascript.php', $page, array('array' => $array, 'page' => $page, 'fai' => $fai));
        // }
        return $content_template;
    }
    public static function login($page, $type, $id)
    {
        $fai = new MainFaiFramework();

        $return = Partial::checking_daftar_proses($fai, $page, $type, $id);
        // $return_checking_daftar_proses = $return;
        // //$id = $return['now_id'];

        // $step_id = $return['id'];
        $id = $return['id'];

        $next_id = isset($page['load']['login-daftar-array']['step'][$id]['next']) ? $page['load']['login-daftar-array']['step'][$id]['next'] : 1;
        if ($type == "daftar") {
            $content_template = '';

            $content_template .= file_get_contents(__DIR__ . '/../../Pages/_template/' . $page['load']['login-template'] . '/AuthPage.php');
            $content_template = str_ireplace("LOAD_PAGE_VIEW", $page['load']['page_view'], $content_template);
            if ($id == -1) {
                $id = $page['load']['login-daftar-array']['first'];
            }
            $step = $page['load']['login-daftar-array']['step'][$id];

            if (isset($page['load']['login-daftar-array']['content'])) {
                $step_content = $page['load']['login-daftar-array']['content'];
            } else {
                $step_content = null;
            }

            $content_template = Packages::step($page, $id, $step, $step_content, ["utama" => $page['load']['login-database']], $content_template);

            return $content_template;
        } else if ($type == "save_daftar") {
            // echo 'hallow';
            if (! empty($page['load']['board']) and $page['load']['board'] != -1) {

                DB::queryRaw($page, "select * from web__list_apps_board where id = " . $page['load']['board']);
                $board = DB::get('all');
            } else {
                $board['num_rows'] = 0;
                $board['row'][0]   = (object) ["id_first_role_daftar" => null];
            }
            $page['database'] = ["utama" => $page['load']['login-database']];
            $step             = $page['load']['login-daftar-array']['step'][$id];
            $page['crud']     = isset($step['function_crud']) ? $step['function_crud'] : [];
            $type_submit      = $step["submit"]["type"];
            $to_array         = $step['var_content'];
            $array            = $page['load']['login-daftar-array']['content'][$to_array];

            if (isset($step["submit"]["default"])) {
                $page['crud']['insert_default_value'] = $step["submit"]["default"];
            }
            if (isset($step["submit"]["default"])) {
                $page['crud']['insert_default_value'] = $step["submit"]["default"];
            }
            $page['crud']['save_type']      = "insert";
            $page['crud']['database_utama'] = $page['load']['login-database'];
            $returnddv                      = CRUDFunc::declare_crud_variable($fai, $page, $array, $page['load']['login-database'], $type);
            $where_raw_temp                 = $returnddv['$where_raw_temp'];
            $sqli                           = $returnddv['$sqli'];
            $field_appr                     = $returnddv['$field_appr'];
            $where                          = $returnddv['$where'];
            $select                         = $returnddv['$select'];
            $sqlen                          = $returnddv['$sqlen'];
            $sqlfile                        = $returnddv['$sqlfile'];

            DB::connection($page);
            $type_submit;
            if ($type_submit == 'insert') {

                //$sqli["create_by"]=$idUser;
                $database_utama = $page['load']['login-database'];
                $return         = CRUDFunc::crud_save($fai, $page, $sqli, $sqlen, $array, $database_utama, $returnddv);
                $sqli           = $return['sqli'];
                $sqlen          = $return['sqlen'];
                $last_insert_id = $return['last_insert_id'];
                $database_row   = $page['load']['login-session-utama']['database_row'];
                if ($board['row'][0]->id_first_role_daftar) {

                    $user_workspace['id_user']                 = $sqli[$database_row];
                    $user_workspace['id_web__list_apps_board'] = $page['load']['board'];
                    $user_workspace['id_role']                 = $board['row'][0]->id_first_role_daftar;
                    CRUDFunc::crud_insert($fai, $page, $user_workspace, [], 'web__list_apps_board__role__user', []);
                }

                $sesion_name = $page['load']['login-session-utama']['session_name'] . "_daftar";

                $_SESSION[$sesion_name] = $sqli[$database_row];
                if (
                    isset($_SERVER['HTTPS']) &&
                    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
                    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
                ) {
                    $protocol = 'https://';
                } else {
                    $protocol = 'http://';
                }
                echo '<script> window.location.href="' . $protocol . $page['load']['domain'] . '/registered/' . $next_id . '"</script>';
            } else if ($type_submit == 'update') {

                if (isset($step["submit"]["default"])) {
                    $page['crud']['update_default_value'] = $step["submit"]["default"];
                }
                $sqli["update_date"] = date('Y-m-d H:i:s');
                //$sqli["update_by"]=$idUser;
                $where = [$step["submit"]['database_row_where'] . "=" . $_SESSION[$step["submit"]['session_value_where']]];

                $database_utama = $page['load']['login-database'];
                $database_row   = $page['load']['login-session-utama']['database_row'];
                $sesion_name    = $page['load']['login-session-utama']['session_name'] . "_daftar";

                $return = CRUDFunc::crud_update($fai, $page, $sqli, $sqlen, $sqlfile, $array, $database_utama, $database_row, $_SESSION[$sesion_name], $page['load']['id']);
                //$sqli =  $return['sqli'];

                // $sqlen = $return['sqlen'];
                //DB::update($page['load']['login-database'], $sqli, $where);
            }
        } else if ($type == "get_login") {

            $username = Partial::input('username');
            $password = Partial::input('password');

            $field       = $page['load']['login-array']['field'];
            $where       = "";
            $where_array = [];
            $where .= '(';
            for ($i = 0; $i < count($field['username']); $i++) {
                $where .= " " . $field['username'][$i] . " = '$username' ";
                if ($i != count($field['username']) - 1) {
                    $where .= " OR ";
                }
            }

            $where .= ')';

            $where .= ' AND ';

            $where .= '(';
            for ($i = 0; $i < count($field['password']); $i++) {
                $where .= " " . $field['password'][$i] . " = '$password' ";
                if ($i != count($field['password']) - 1) {
                    $where .= " OR ";
                }
            }
            $where .= ')';
            $where_array[] = ["", "", $where];
            $database      = $page['load']['login-database'];
            DB::connection($page);
            $db['utama']     = $database;
            $db['where_raw'] = $where;
            $row             = Database::database_coverter($page, $db, [], 'all');
            // print_R($row);
            // $sql = "select * from $database where $where";
            // $get = DB::query($sql);

            // $row = DB::fetchResponse($get);
            $database_row = $page['load']['login-session-utama']['database_row'];
            if ($row['num_rows']) {
                $return_login['is_login']                                                = 1;
                $_SESSION[$page['load']['login-session-utama']['session_name']]          = $row['row'][0]->$database_row;
                $_SESSION[$page['load']['login-session-utama']['session_name'] . '_tmp'] = $row['row'][0]->$database_row;

                for ($i = 0; $i < count($page['load']['login-session']); $i++) {
                    if (isset($page['load']['login-session'][$i])) {
                        if ($page['load']['login-session'][$i]['type'] == 'database') {

                            $database_row                                                          = $page['load']['login-session'][$i]['database_row'];
                            $_SESSION[$page['load']['login-session'][$i]['session_name']]          = $row['row'][0]->$database_row;
                            $_SESSION[$page['load']['login-session'][$i]['session_name'] . '_tmp'] = $row['row'][0]->$database_row;
                        } else if ($page['load']['login-session'][$i]['type'] == 'string') {

                            $_SESSION[$page['load']['login-session'][$i]['session_name'] . '']     = $page['load']['login-session'][$i]['text'];
                            $_SESSION[$page['load']['login-session'][$i]['session_name'] . '_tmp'] = $page['load']['login-session'][$i]['text'];
                        }
                    }
                }
                $_SESSION['is_login'] = true;
                $_SESSION['msg']      = '';
            } else {
                $return_login['is_login'] = 0;
                $_SESSION['is_login']     = false;
                $_SESSION['msg']          = 'Login Gagal! Silahkan Cek Kembali Username Password yang diinputkan';
            }
            echo json_encode($return_login);
            die;
        } else if ($type == "logout") {
            session_destroy();
            session_unset();
        } else {
            // echo ;
            if (isset($page['load']['login-template'])) {
                $content_template = file_get_contents(__DIR__ . '/../../Pages/_template/' . $page['load']['login-template'] . '/AuthPage.php');
            } else {
                $content_template = "<FORM-CONTENT></FORM-CONTENT>";
            }

            $content = '<div class="mb-4 mt-3 fv-plugins-icon-container">
              <label for="email" class="form-label">Email or Username</label>
              <input id="usermail" type="text" class="form-control " name="username" value="" required autocomplete="username" autofocus placeholder="Username/Email">


            </div>


            <div class="mb-5 form-password-toggle fv-plugins-icon-container">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>

              </div>
              <div class="input-group input-group-merge has-validation">
                 <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="input-group-text cursor-pointer" onclick="show_password()"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <button class="' . (isset($page['load']['login-array']['content']['BUTTON_CLASS']) ? $page['load']['login-array']['content']['BUTTON_CLASS'][0]['content'] : 'btn bg-gradient-success w-100') . '" type="button" onclick="check_login_js()">Sign in</button>
            </div>
            <script>
            function show_password(){
                 var input = $("#password").val();
                  if (input.attr("type") == "password") {
                    input.attr("type", "text");
                  } else {
                    input.attr("type", "password");
                  }
            }
            </script>
            ';

            $content_template = str_ireplace("<FORM-CONTENT></FORM-CONTENT>", $content, $content_template);
            if (isset($page['load']['login-array']['content'])) {

                foreach ($page['load']['login-array']['content'] as $tag => $value) {
                    $content = "";
                    for ($i = 0; $i < count($page['load']['login-array']['content'][$tag]); $i++) {
                        $data = $page['load']['login-array']['content'][$tag][$i];

                        if ($data['type'] == 'logo') {
                            $content .= '<div class="app-brand justify-content-center text-center">
				            	<span class="app-brand-logo demo"><img src="' . $data['content'] . '" height="50px"></span>
				          </div>';
                        } else if ($data['type'] == 'button') {

                            $content .= Content::parse_button($page, $data['array'], [], new MainFaiFramework);
                        } else if ($data['type'] == 'text') {
                            $content .= $data['content'];
                        }
                    }

                    $content_template = str_ireplace("<" . strtoupper($tag) . "></" . strtoupper($tag) . ">", $content, $content_template);
                }
            }
            $content_footer = '<div class="text-center">

			Belum punya akun?<br>
			<b>
				<a href="' . Bundlecontent::daftar($page) . '" class="text-center">

					Daftar
				</a>
			</b>
		</div>
		<script>
			function check_login_js(){
				var result = true;
				$.ajax({
					type:"POST",
					url:$(\'#load_link_route\').val(),
					cache:false,
					dataType: "JSON",
					data:{
						username:$("#usermail").val(),
						password:$("#password").val(),
						id: $(\'#load_id\').val(),
                        apps: $(\'#load_apps\').val(),
                        page_view: "' . $page['load']['page_view'] . '",
                        frameworksubdomain: $(\'#load_domain\').val(),
                        type: \'get_login\',
                        contentfaiframework:\'get_pages\',
                        MainAll: 2,
                        not_sidebar: "not",

					},
					success:function(data){
						console.log(data);
						if(data.is_login){

							result = true;
							Show_alert(\'Berhasil Login.\',\'success alert-important alert-dismissible\',\'svg-checklis\');
							const currentFullUrl = window.location.href;

							// Melakukan redirect setelah 3 detik (3000 ms)
							setTimeout(() => {
								window.location.href = currentFullUrl;
							}, 1000);
						}else{

							result = false;
							Show_alert(\'Username/Email dan Password Belum tepat\',\'danger alert-important alert-dismissible\',\'svg-danger\');
						}


						//$("#user-availability-status").html(data);

					}
				});
				return result;

			}
		</script>

		';
            $content_footer   = str_ireplace("LOAD_PAGE_VIEW", $page['load']['page_view'], $content_footer);
            $content_footer   = str_ireplace("LOGIN-DAFTAR-STEP", $page['load']['login-daftar-array']["first"] ?? '', $content_footer);
            $content_template = str_ireplace("<FOOTERCONTENT></FOOTERCONTENT>", $content_footer, $content_template);
            $content_template = str_ireplace("<BE3-LOGO></BE3-LOGO>", Bundlecontent::router($page, 'content', [], 'BE3-LOGO'), $content_template);

            return $content_template;
        }
    }
    public static function crud($page, $type, $id)
    {
        $fai    = new MainFaiFramework();
        $idUser = $fai->id_user();

        $array = isset($page['crud']['array']) ? $page['crud']['array'] : [];

        $database_utama = "";
        $primary_key    = null;
        if (isset($page['database']['utama'])) {
            $database_utama = $page['database']['utama'];
        }

        if (isset($page['database']['primary_key'])) {
            $primary_key = $page['database']['primary_key'];
        }

        $search                    = isset($page['crud']['search']) ? $page['crud']['search'] : [];
        $page['database']['where'] = isset($page['crud']['where']) ?
        (isset($page['database']['where']) ? $page['database']['where'] + $page['crud']['where'] : $page['crud']['where'])
            : (isset($page['database']['where']) ? $page['database']['where'] : []);
        if (empty($primary_key)) {
            // $database_costum['primary_key'] = Database::converting_primary_key($page,$database_utama,'primary_key'); 
            $primary_key = $page['database']['primary_key'] = Database::converting_primary_key($page, $database_utama, 'ontable');
        }

        $page['database']['select'] = isset($page['database']['select']) ? $page['database']['select'] : ["*", "$database_utama.$primary_key as primary_key"];
        $page['crud']['array']      = $array;
        /*if ($page['contentfaiframework'] == 'pages')
			$page['crud']['array_extend'] = Partial::array_extend($page, $page['database']['utama'], $id, 'array_utama');
		*/

        $page['type']                   = $type;
        $page['crud']['type']           = $type;
        $page['id']                     = $id;
        $page['crud']['id']             = $id;
        $page['crud']['database_utama'] = $database_utama;
        $page['crud']['primary_key']    = $primary_key;
        $page['crud']['save_type']      = $type == 'update' ? 'update' : 'insert';

        $page['fai']                 = new MainFaiFramework;
        $page['crud']['is_approval'] = 0;
        /*
		if ($page['load']['board'] != -1 and $page['load']['board'] != null and isset($_SESSION['board_role-' . $page['load']['board']])) {
			if ($_SESSION['board_role-' . $page['load']['board']]) {
				$query_akses_board = "select * from web__list_apps_board__role__akses__menu 
		    join  web__list_apps_menu on web__list_apps_board__role__akses__menu.id_menu = web__list_apps_menu.id
		    left join  web__list_apps_board__role__akses on web__list_apps_board__role__akses.id = web__list_apps_board__role__akses__menu.id_web__list_apps_board__role__akses
		    
		    where load_apps = '" . $page['load']['apps'] . "' and load_page_view='" . $page['load']['page_view'] . "'
		    and web__list_apps_board__role__akses__menu.id_web__list_apps_board__role__akses = " . $_SESSION['board_role-' . $page['load']['board']] . "
		    
		    ";
				$row_akses = DB::fetchResponse(DB::select($query_akses_board));
				if ($row_akses)
					$page['crud']['row_akses_role'] = $row_akses[0];
				else
					$page['crud']['row_akses_role'] = (object) ["id_role_group" => -1];
				if ($row_akses) {
					if (!$row_akses[0]->tambah)
						$page['crud']['no_add'] = true;
					if (!$row_akses[0]->edit)
						$page['crud']['no_edit'] = true;
					if (!$row_akses[0]->hapus)
						$page['crud']['no_delete'] = true;
					if (!$row_akses[0]->setting)
						$page['crud']['no_setting'] = true;
					if (!$row_akses[0]->pdf)
						$page['crud']['no_pdf'] = true;
					if (!$row_akses[0]->excel)
						$page['crud']['no_excel'] = true;
					if (!$row_akses[0]->import)
						$page['crud']['no_import'] = true;
				}

				$row_approval = DB::fetchResponse(DB::select("
		            select count(*) as is_approval,form.load_apps as load_apps_form,form.load_page_view as load_page_view_form 
		                from form__approval 
		                join form on form__approval.id_form=form.id 
		                where 
		                    '" . $page['load']['apps'] . "' = form.load_apps
		                    and form.load_page_view ='" . $page['load']['page_view'] . "' 
		                GROUP BY form.load_apps,form.load_page_view"));
				if ($row_approval)
					$page['crud']['is_approval'] = $row_approval[0]->is_approval;
			}
		}
		*/

        $returnddv = CRUDFunc::declare_crud_variable($fai, $page, $array, $page['database'], $type, $search, $page['crud']);

        $where_raw_temp = $returnddv['$where_raw_temp'];
        $sqli           = $returnddv['$sqli'];
        $field_appr     = $returnddv['$field_appr'];
        $where          = $returnddv['$where'];
        $select         = $returnddv['$select'];
        $join           = $returnddv['$join'];

        $sqlen            = $returnddv['$sqlen'];
        $sqli_to_database = $returnddv['$sqli_to_database'];
        $sqlfile          = $returnddv['$sqlfile'];

        $page['database']['select'] = array_merge($page['database']['select'], $select);
        $page['database']['where']  = array_merge($page['database']['where'], $where);
        if (isset($page['database']['join'])) {
            $page['database']['join'] = array_merge($page['database']['join'], $join);
        } else {
            $page['database']['join'] = $join;
        }

        if ($type == 'list_datatable') {
            $draw  = Partial::input('draw');
            $start = Partial::input('start');
            if ($start < 0) {
                $start = 0;
            }
            $rowperpage = Partial::input('length'); // Rows display per page
            if ($page['database_provider'] == 'postgres') {
                $page['database']['limit_raw'] = $rowperpage . " offset " . $start;
            } else {
                $page['limit_raw'] = $rowperpage . " offset " . $start;
            }

        }
        if (Partial::input('contentfaiframework') != 'get_pages' or $type == 'list_datatable') {

            //if (isset($page['crud']['is_approval']) and $page['contentfaiframework'] == 'pages')
            //	$page['crud']['array_approval'] = Partial::array_approval($page, $page['database']['utama'], $id, 'array_utama', $page['database']);
            if ($page['section'] == 'viewsource') {
                $row = [
                    "num_rows" => 0,
                    "row"      => (object) ['object' => 'foreach_1_row'],
                ];
            } else {
                if (isset($page['database']['utama'])) {
                    $page['database']['where'][] = [$page['database']['utama'] . ".active", "=", 1];
                }

                $row = $fai->database_coverter($page, $page['database'], $array, 'all');
            }

            $page['crud']['row'] = $row;
            if ($type == 'get_list') {
                return $row;
            }

            DB::connection($page);
            if ($type == 'hapus') {
            } else if ($type != 'save') {
                if (! $database_utama) {
                } else if ($id == -1 or $fai->input('section') == 'card') {
                    $row_database_utama = DB::select(" select * from $database_utama as dbutama ");
                } else {
                    $row_database_utama = DB::select("select * from $database_utama as dbutama where $primary_key=$id");
                }

                if (DB::fetchResponse($row_database_utama, 'num_rows')) {
                    $page['crud']['row_database_utama'] = $row_database_utama;
                } else {
                    $page['crud']['row_database_utama'] = (object) ['object' => 'foreach_1_row'];
                }

            }
        }

        if ($type == 'setujui_appr' or $type == 'decline_appr') {
            $redirect    = 'appr';
            $id_redirect = '-1';
        } else {

            $redirect    = isset($page['redirect']) ? $page['redirect'] : 'list';
            $id_redirect = isset($page['redirect']) ? $id : '-1';
        }

        if ($type == 'ajax_sub_kategori') {
            $suffix               = "";
            $page['crud']['view'] = $type;
            if ($page['section'] != 'viewsource') {
                if (! in_array($page['crud']['view'], ['edit', 'view', 'ajax_sub_kategori'])) {
                } else {

                    $suffix = "_edit";
                    // $page['crud']['row_sub_kategori'][$h]['row'] = $row;

                }
            } else {
            }
            $h  = $fai->input('h', '_GET');
            $no = $fai->input('no', '_GET');

            $page['crud']['view']         = 'ajax';
            $page['crud']['input_inline'] = '';
            $page['crud']['prefix_name']  = $page['crud']['sub_kategori'][$h][1] . '_';
            $page['crud']['sufix_name']   = '[]';
            $jumlah_add                   = Partial::input('jumlah_add');
            $jumlah_add                   = $jumlah_add ? $jumlah_add : 1;
            for ($m = 0; $m < $jumlah_add; $m++) {

                $row[$m] = (object) ['object' => 'foreach_1_row'];
            }

            $page['crud']['row_sub_kategori'][$h]['row']      = $row;
            $page['crud']['row_sub_kategori'][$h]['num_rows'] = $jumlah_add;
            if ($page['crud']['sub_kategori'][$h][3] == 'table') {
                $page['crud']['startdiv'] = "";
                $page['crud']['enddiv']   = "";
            }
            $funct                             = 'sub_kategori_' . $page['crud']['sub_kategori'][$h][3] . '';
            $page['crud']['view_sub_kategori'] = $page['crud']['sub_kategori'][$h][3];
            $page['crud']['section_vte']       = 'sub_kategori';
            return CrudContent::$funct($page, $fai, $h, $no, $suffix);
        } else if ($type == 'select2') {
            $data          = [];
            $field         = $fai->input('field_array');
            $data['items'] = [];
            $i             = 0;

            $option = json_decode($fai->input('json_array'), true);

            $database = $option[0];

            $key   = $option[1];
            $value = $option[2];
            if (isset($option[0])) {
                $database = $option[0];
                $key      = $option[1];
                if ($fai->input('select_database_costum')) {
                    $select_database_costum_konversi = str_replace("&#39;", "'", $fai->input('select_database_costum'));
                    if (isset($page['crud']['select_database_costum'][$field])) {
                        $page['crud']['select_database_costum'][$field] = array_merge($page['crud']['select_database_costum'][$field], json_decode($select_database_costum_konversi, true));
                    } else {
                        $page['crud']['select_database_costum'][$field] = (json_decode($select_database_costum_konversi, true));
                    }

                }
                $page['crud']['select_database_costum'][$field]['utama']       = $database;
                $page['crud']['select_database_costum'][$field]['primary_key'] = $key;
                if ($fai->input('q')) {
                    $page['crud']['select_database_costum'][$field]['where'][] = ["upper(" . $database . "." . $option[2], ') like ', '\'%' . strtoupper($fai->input('q')) . '%\''];
                }

                if ($fai->input($fai->input('field_value_automatic_select_target_select2_request_where'))) {
                    $page['crud']['select_database_costum'][$field]['where'][] = [$database . "." . $fai->input('field_value_automatic_select_target_select2_request_where'), ' = ', '\'' . $fai->input($fai->input('field_value_automatic_select_target_select2_request_where')) . '\''];
                }

                // print_r($page['crud']['select_database_costum'][$field]);
                $row = $fai->database_coverter($page, $page['crud']['select_database_costum'][$field], [], 'all');

                if ($row['num_rows']) {

                    foreach ($row['row'] as $item) {
                        $data['items'][$i]['id']        = $item->primary_key;
                        $data['items'][$i]['full_name'] = $item->$value;
                        $i++;
                    }
                }
            }

            echo json_encode($data);
        } else if ($type == 'modalform_sub_kategori_add') {
            $h     = $fai->input('h');
            $no    = $fai->input('no');
            $nomor = $fai->input('nomor');
            $nomor += 1;
            $no    = $nomor;
            $i     = $fai->input('i');
            $array = $array = $page['crud']['array_sub_kategori'][$h][$i][3]['array'];

            $page['crud']['array']        = $array;
            $page['crud']['view']         = 'ajax';
            $page['crud']['input_inline'] = '';
            $page['crud']['prefix_name']  = $page['crud']['sub_kategori'][$h][1] . '_';
            $page['crud']['sufix_name']   = '_modalform[' . $no . '][]';
            $page['crud']['row']          = (object) ['object' => 'foreach_1_row'];
            $content                      = "";

            $page['crud']['view_sub_kategori'] = $page['crud']['array_sub_kategori'][$h][$i][3]['view_form'];

            $page['crud']['startdiv'] = "";
            $page['crud']['enddiv']   = "";
            if ($page['crud']['view_sub_kategori'] == 'table') {
                $content .= '<tr id="table-subkateogri-tr-' . $h . '-' . $no . '">
                <td >' . $no . '
                    <input class="no-' . $h . '" name="no_sub_kategori[]" type="hidden" value="' . $no . '">
                </td>
               ';
            }

            $content .= CrudContent::sub_kategori_content_array($page, $fai, $array, $h, $nomor, []);
            if ($page['crud']['view_sub_kategori'] == 'table') {
                $content .= '<td style="display:none"><input class="contentinput-' . $h . '" type="hidden">
                <input class="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '" name="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '[]" value="' . $no . '" type="hidden" />
				</td>

				<tr>';
            }

            return $content;
        } else if ($type == 'insert_number_code') {
            $field = $fai->input('field_auto_change');
            if ($fai->input('parent')) {
                $page['crud']['insert_number_code'][$field]['id-parent'] = $fai->input('parent');
            }

            $page['crud']['view'] = $fai->input('_view');

            print_r(CRUDFunc::insert_number_code_nomor($fai, $page, $field, '')['valueinput']);
            die;
        } else if ($type == 'field_view_sub_kategori') {
            $page['section'] = 'field_view_sub_kategori';

            $no  = $fai->input('_no');
            $key = $fai->input('field_auto_change');
            $h   = $page['crud']['field_view_sub_kategori'][$key]['target_no'];
            $db  = DB::select("SELECT * FROM " .
                $page['crud']['field_view_sub_kategori'][$key]['database']['utama'] . " where " .
                $page['crud']['field_view_sub_kategori'][$key]['request_where'] . "=" . $fai->input('value'));
            $page['crud']['field_view_sub_kategori'][$key]['database']['where'][] = [$page['crud']['field_view_sub_kategori'][$key]['database']['utama'] . '.' . $page['crud']['field_view_sub_kategori'][$key]['request_where'], '=', $fai->input('value')];
            if (isset($page['crud']['field_view_sub_kategori'][$key]['insert_default_value_sub_kategori_request'])) {
                $page['crud']['insert_default_value_sub_kategori_request'] =
                    $page['crud']['field_view_sub_kategori'][$key]['insert_default_value_sub_kategori_request'];
            }
            $array = [];
            $field = $page['crud']['field_view_sub_kategori'][$key]['field'];

            for ($i = 0; $i < count($field); $i++) {
                if ($field[$i][0] == -1) {
                    $array[] = $field[$i][2];
                }
            }

            $array          = Database::converting_array_field($page, $array, 'all')['array'];
            $returnddv      = CRUDFunc::declare_crud_variable($fai, $page, $array, $page['crud']['field_view_sub_kategori'][$key]['database'], $type);
            $where_raw_temp = $returnddv['$where_raw_temp'];
            $sqli           = $returnddv['$sqli'];
            $field_appr     = $returnddv['$field_appr'];
            $where          = $returnddv['$where'];
            $select         = $returnddv['$select'];
            $sqlen          = $returnddv['$sqlen'];
            $sqlfile        = $returnddv['$sqlfile'];
            if (isset($page['crud']['field_view_sub_kategori'][$key]['database']['select'])) {
                $page['crud']['field_view_sub_kategori'][$key]['database']['select'] = array_merge($page['crud']['field_view_sub_kategori'][$key]['database']['select'], $select);
            } else {
                $page['crud']['field_view_sub_kategori'][$key]['database']['select'] = $select;
            }

            $page['crud']['field_view_sub_kategori'][$key]['database']['select'][] = "*";

            $page['crud']['field_view_sub_kategori'][$key]['database']['where'] = array_merge($page['crud']['field_view_sub_kategori'][$key]['database']['where'], $where);

            $row                            = $fai->database_coverter($page, $page['crud']['field_view_sub_kategori'][$key]['database'], $array, 'all');
            $page['crud']['row']            = $row;
            $page['crud']['prefix_name']    = $page['crud']['sub_kategori'][$h][1] . '_';
            $page['crud']['sufix_name']     = '[]';
            $page['crud']['view']           = 'tambah';
            $page['crud']['type']           = $type;
            $page['crud']['section_vte']    = 'sub_kategori';
            $page['crud']['input_inline']   = '';
            $page['crud']['h_sub_kategori'] = $h;
            if ($page['crud']['sub_kategori'][$h][3] == 'table') {
                $page['crud']['startdiv'] = "";
                $page['crud']['enddiv']   = "";
            }
            $func = "field_view_sub_kategori_" . $page['crud']['sub_kategori'][$h][3];
            return CrudContent::$func($page, $fai, $field, $page['crud']['field_view_sub_kategori'][$key]['database']['utama'], $h, $no);
        } else if ($type == 'result_array_website') {
            if ($fai->input('tipe_array') == 'array_utama') {
                $get_array   = $page['crud']['array'];
                $prefix_name = "";
                $sufix_name  = "";
            } else {
                $get_array   = $page['crud']['array_sub_kategori'][$fai->input('no_sub_kategori')];
                $prefix_name = $page['crud']['sub_kategori'][$fai->input('no_sub_kategori')][1] . '_';
                $sufix_name  = '[]';
            }
            $to_array = $get_array[$fai->input('no_array')];
            // if($to_array[3])
            $get   = $to_array[4]['get'];
            $value = $fai->input('value_' . $get);

            $template_array                                  = $to_array[3];
            $template_array['database']['where_get_array'][] = [
                "row"       => $to_array[4]['form_input_get'],
                "array_row" => "text",
                "get_row"   => $value,
            ];

            foreach ($to_array[4]['connect'] as $key => $connect) {
                $row_connect = $connect[0];
                $template_array["template_content"] .= '<input type="hidden" name="' . $prefix_name . $row_connect . $sufix_name . '"  value="<TEMPLATE_CONTENT_ROW-' . $row_connect . '></TEMPLATE_CONTENT_ROW-' . $row_connect . '>">';
                $template_array["array"]['TEMPLATE_CONTENT_ROW-' . $row_connect . ''] = [
                    "refer" => "database",

                    "row"   => $key,
                ];
            }
            $content = Partial::database_list_view_website($page, $template_array, '');
            echo $content;
        } else if ($type == 'list_datatable') {

            return (CrudContent::table($page, $fai, $database_utama, 'datatable'));
        } else if ($type == 'tree_sub_kategori') {
            $h                            = $fai->input('h', '_GET');
            $no                           = $fai->input('no', '_GET');
            $page['crud']['prefix_name']  = $page['crud']['sub_kategori'][$h][1] . '_';
            $page['crud']['view']         = 'ajax';
            $page['crud']['input_inline'] = '';
            $page['crud']['row']          = (object) ['object' => 'foreach_1_row'];
            if ($page['crud']['sub_kategori'][$h][3] == 'table') {
                $page['crud']['startdiv'] = "";
                $page['crud']['enddiv']   = "";
            }
            return CrudContent::tree_sub_kategori($page, $fai, $h, $no);
        } else if ($type == 'field_value_automatic_select_target') {

            $page['crud']['field_value_automatic_select_target'][$fai->input('field_auto_change')]['database']['where'][] = [$page['crud']['field_value_automatic_select_target'][$fai->input('field_auto_change')]['request_where'], "=", $fai->input('value')];

            $row = $fai->database_coverter($page, $page['crud']['field_value_automatic_select_target'][$fai->input('field_auto_change')]['database'], []);

            $value  = $page['crud']['field_value_automatic_select_target'][$fai->input('field_auto_change')]['value'];
            $option = $page['crud']['field_value_automatic_select_target'][$fai->input('field_auto_change')]['option'];
            foreach ($row as $data) {
                echo '<option value="' . $data->$value . '">' . $data->$option . '</option>';
            }
        } else if ($type == 'field_value_automatic') {

            $page['crud']['field_value_automatic'][$fai->input('field_auto_change')]['database']['where'][] = [$page['crud']['field_value_automatic'][$fai->input('field_auto_change')]['request_where'], "=", $fai->input(value)];
            $row                                                                                            = $fai->database_coverter($page, $page['crud']['field_value_automatic'][$fai->input('field_auto_change')]['database'], []);
            echo json_encode($row[0]);
        } else if ($type == 'field_value_automatic_sub_kategori') {

            $page['crud']['field_value_automatic_sub_kategori'][$fai->input('field_auto_change')]['database']['where'][] = [$page['crud']['field_value_automatic_sub_kategori'][$fai->input('field_auto_change')]['request_where'], "=", $fai->input('value')];
            $row                                                                                                         = $fai->database_coverter($page, $page['crud']['field_value_automatic_sub_kategori'][$fai->input('field_auto_change')]['database'], []);
            echo json_encode($row[0]);
        } else if ($type == 'import') {
            return CrudContent::import($fai, $page);
        } else if ($type == 'execution_import') {
            return CrudContent::execution_import($fai, $page, $id);
        } else if ($type == 'template_import') {

            return CrudContent::template_import($fai, $page, $id);
            die;
        } else if ($fai->input('Cari', '_GET') == "excel" or $type == 'excel' or $type == 'export_existing' or $type == "export_empty") {

            $type_page   = $type;
            $spreadsheet = new Spreadsheet;
            $sheet       = $spreadsheet->getActiveSheet();
            $y           = 0;
            if (! ($type == 'export_existing' or $type == "export_empty")) {

                $sheet->setCellValue($fai->toAlpha($y) . '1', 'No');
                $y++;
            }

            for ($i = 0; $i < count($array); $i++) {
                $text  = $array[$i][0];
                $field = $array[$i][1];
                $type  = $array[$i][2];
                if ($type == "password") {
                } else {

                    $sheet->getColumnDimension($fai->toAlpha($y))->setAutoSize(true);
                    $sheet->setCellValue($fai->toAlpha($y) . '1', $text);
                }
                $y++;
            }

            $rows = 1;

            if (! empty($row) and $type_page != "export_empty") {

                $no = 0;
                foreach ($row as $data) {
                    $rows++;

                    $no++;
                    $y = 0;
                    if ($type_page != 'export_existing') {
                        $sheet->setCellValue($fai->toAlpha($y) . $rows, $no);
                        $y++;
                    }
                    for ($i = 0; $i < count($array); $i++) {
                        $text  = $array[$i][0];
                        $field = $array[$i][1];
                        $type  = $array[$i][2];
                        if ($type == "password") {
                        } else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (! $field_database) {

                                $field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }

                            $sheet->setCellValue($fai->toAlpha($y) . $rows, $data->$field_database);
                            $validation = $sheet->getCell($fai->toAlpha($y) . $rows)->getDataValidation();
                            $option     = $array[$i][3];
                            $formula    = "";

                            $option_select   = $array[$i][3];
                            $database_select = $option[0];
                            $key_select      = $option[1];

                            $page['select_database_costum'][$field]['utama']       = $database_select;
                            $page['select_database_costum'][$field]['primary_key'] = $key_select;

                            $value_select = $option[2];
                            $rowoption    = $fai->database_coverter($page, $page['select_database_costum'][$field], []);
                            foreach ($rowoption as $dataoption) {
                                $formula .= ($dataoption->$value) . ',';
                            }

                            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                            $validation->setFormula1('"' . $formula . '"');
                            $validation->setAllowBlank(false);

                            $validation->setShowDropDown(true);

                            $validation->setShowInputMessage(true);

                            $validation->setPromptTitle('Note');

                            $validation->setPrompt('Pilih Salah Satu');

                            $y++;
                        } else if ($type == "select-multiple-string") {
                            $multiple = DB::select("select array_agg(" . $array[$i][3][0] . "." . $array[$i][3][2] . ") as value from " . $array[$i][3][0] . " where " . $array[$i][3][1] . " in(" . $data->$field . ")");
                            $sheet->setCellValue($fai->toAlpha($y) . $rows, str_ireplace(["{", "}", '"'], ["", "", ''], $multiple[0]->value));
                            $y++;
                        } else if ($type == "select-manual") {
                            $field_database = $array[$i][3];
                            if (isset($field_database[$data->$field])) {

                                $sheet->setCellValue($fai->toAlpha($y) . $rows, $field_database[$data->$field]);
                            } else {

                                $sheet->setCellValue($fai->toAlpha($y) . $rows, '');
                            }

                            $validation = $sheet->getCell($fai->toAlpha($y) . $rows)->getDataValidation();
                            $option     = $array[$i][3];
                            $formula    = "";
                            foreach ($option as $key => $value) {
                                $formula .= $value . ',';
                            }

                            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                            $validation->setFormula1('"' . $formula . '"');
                            $validation->setAllowBlank(false);

                            $validation->setShowDropDown(true);

                            $validation->setShowInputMessage(true);

                            $validation->setPromptTitle('Note');

                            $validation->setPrompt('Must select one from the drop down options.');
                            $y++;
                        } else if ($type == "select-appr") {
                            $field_database = $array[$i][3];
                            $field          = 'system_status_appr';
                            if ($data->$field) {

                                $sheet->setCellValue($fai->toAlpha($y) . $rows, $field_database[$data->$field]);
                                $y++;
                            } else {

                                $sheet->setCellValue($fai->toAlpha($y) . $rows, '');
                                $y++;
                            }
                        } else if ($type == "text-alias") {
                            $field_database = $array[$i][3];
                            $sheet->setCellValue($fai->toAlpha($y) . $rows, $data->$field_database);
                            $y++;
                        } else {
                            $sheet->setCellValue($fai->toAlpha($y) . $rows, $data->$field);
                            $y++;
                        }
                    }
                }
            } else if ($type_page == "export_empty") {

                for ($j = 0; $j <= 50; $j++) {
                    $y = 0;
                    $rows++;
                    for ($i = 0; $i < count($array); $i++) {
                        $text  = $array[$i][0];
                        $field = $array[$i][1];
                        $type  = $array[$i][2];
                        if ($type == "password") {
                        } else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (! $field_database) {

                                $field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }

                            $sheet->setCellValue($fai->toAlpha($y) . $rows, "");
                            $validation = $sheet->getCell($fai->toAlpha($y) . $rows)->getDataValidation();
                            $option     = $array[$i][3];
                            $formula    = "";

                            $option_select                                         = $array[$i][3];
                            $database_select                                       = $option[0];
                            $key_select                                            = $option[1];
                            $page['select_database_costum'][$field]['utama']       = $database_select;
                            $page['select_database_costum'][$field]['primary_key'] = $key_select;

                            $value_select = $option[2];
                            $rowoption    = $fai->database_coverter($page, $page['select_database_costum'][$field], []);
                            foreach ($rowoption as $dataoption) {
                                $formula .= ($dataoption->$value_select) . ',';
                            }

                            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                            $validation->setFormula1('"' . $formula . '"');
                            $validation->setAllowBlank(true);

                            $validation->setShowDropDown(true);

                            $validation->setShowInputMessage(true);

                            $validation->setPromptTitle('Note');

                            $validation->setPrompt('Pilih salah satu');

                            $y++;
                        } else if ($type == "select-manual") {
                            $field_database = $array[$i][3];

                            $sheet->setCellValue($fai->toAlpha($y) . $rows, '');

                            $validation = $sheet->getCell($fai->toAlpha($y) . $rows)->getDataValidation();
                            $option     = $array[$i][3];
                            $formula    = "";
                            foreach ($option as $key => $value) {
                                $formula .= $value . ',';
                            }

                            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                            $validation->setFormula1('"' . $formula . '"');
                            $validation->setAllowBlank(true);

                            $validation->setShowDropDown(true);

                            $validation->setShowInputMessage(true);

                            $validation->setPromptTitle('Note');

                            $validation->setPrompt('Pilih salah satu');
                            $y++;
                        } else {
                            $sheet->setCellValue($fai->toAlpha($y) . $rows, "");
                            $y++;
                        }
                    }
                }
            }

            $type = 'xls';
            if ($type == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
            } else if ($type == 'xls') {
                $writer = new Xls($spreadsheet);
            }
            $fileName = $page['title'] . "." . $type;
            $writer->save("export/" . $fileName);

            header("Content-Type: application/vnd.ms-excel");
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false); // required for certain browsers 
                                                     //header('Content-Type: application/pdf');

            header('Content-Disposition: attachment; filename="' . basename($fileName) . '";');
            header('Content-Transfer-Encoding: binary');
            //header('Content-Length: ' . filesize($fileName));

            readfile("export/" . $fileName);

            //return haeder( "location:".base_url()."export/" . $fileName);
        } else if ($type == 'import_excel') {
            $file          = $fai->input('excel', '_FILES');
            $tujuan_upload = 'export';

            $name = 'import-excel-' . $page['title'] . date('YmdHis') . '-' . $file->getClientOriginalName();
            $file->move($tujuan_upload, $name);

            $uploadFilePath = $tujuan_upload . '/' . $name;
            $inputFileType  = ucfirst(pathinfo($uploadFilePath, PATHINFO_EXTENSION));
            //    $inputFileType = 'Xlsx';
            //    $inputFileType = 'Xml';
            //    $inputFileType = 'Ods';
            //    $inputFileType = 'Slk';
            //    $inputFileType = 'Gnumeric';
            //    $inputFileType = 'Csv';

            /**  Create a new Reader of the type defined in $inputFileType  **/
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            /**  Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = $reader->load($uploadFilePath);

            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            for ($j = 2; $j <= count($sheetData); $j++) {
                for ($i = 0; $i < count($array); $i++) {
                    $field = $array[$i][1];
                    if (! empty($sheetData[$j][$fai->toAlpha($i)])) {

                        if ($array[$i][2] == 'select-manual') {
                            $option       = $array[$i][3];
                            $sqli[$field] = array_search($sheetData[$j][$fai->toAlpha($i)], $option);
                        } elseif ($array[$i][2] == 'select') {
                            $option        = $array[$i][3];
                            $option_select = $array[$i][3];

                            $database_select                                       = $option[0];
                            $key_select                                            = $option[1];
                            $page['select_database_costum'][$field]['utama']       = $database_select;
                            $page['select_database_costum'][$field]['primary_key'] = $key_select;

                            $rowoption    = $fai->database_coverter($page, $page['select_database_costum'][$field], []);
                            $value_select = $option[2];

                            $rowoption = $fai->database_coverter($page, $database_select, $key_select, $select_select, $where_select, $join_select, [], $page['request'], $selectRaw_select, $whereRaw_select);
                            foreach ($rowoption as $dataoption) {
                                $option_data[$dataoption->primary_key] = $dataoption->$value_select;
                            }
                            $sqli[$field] = array_search($sheetData[$j][$fai->toAlpha($i)], $option_data);
                        } else {

                            $sqli[$field] = $sheetData[$j][$fai->toAlpha($i)];
                        }
                    }
                }
                $sqli["create_date"] = date('Y-m-d H:i:s');
                $sqli["create_by"]   = $idUser;
                if (isset($page['crud']['insert_default_value'])) {
                    foreach ($page['crud']['insert_default_value'] as $key => $value) {
                        $sqli[$key] = $value;
                    }
                }
                if (! empty($sqli[$page['import_export']['config']['row_check']])) {
                    DB::insert($database_utama, $sqli);
                }

            }

            //return redirect()->route($page['route'], [$redirect, $id_redirect])->with('success', $page['title'] . ' Berhasil di input!');
        } else if ($fai->input('Cari', '_GET') == "pdf" or $type == 'pdf') {
            //	$page['crud']['view'] = 'view';

            //$pdf = PDF::loadView('crud.pdf', compact('page'))->setPaper($page['layout_pdf'][0], $page['layout_pdf'][1]);

            //return $pdf->download($page['title'] . '.pdf');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            //

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            // Set some content to print
            ob_end_clean();
            ob_start();
            $fai->view('crud/pdf.blade.php', $page);
            $contents = ob_get_contents();
            ob_end_clean();
            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $contents, 0, 1, 0, true, '', true);

            // ---------------------------------------------------------
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            return $pdf->Output($page['title'] . '.pdf', 'D');
            /*
			

			I : send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
			D : send to the browser and force a file download with the name given by name.
			F : save to a local server file with the name given by name.
			S : return the document as a string (name is ignored).
			FI : equivalent to F + I option
			FD : equivalent to F + D option
			E : return the document as base64 mime multi-part email attachment (RFC 2045)

				*/
        } else if ($type == "PDFPage2") {

            echo view('crud.PDFPage', compact('page'));
        } else if ($type == "PDFPage") {

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set margins
            $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // set text shadow effect
            //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

            // Set some content to print
            ob_end_clean();
            ob_start();
            $fai->view('crud/PDFPage.blade.php', $page);
            $contents = ob_get_contents();
            ob_end_clean();
            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $contents, 0, 1, 0, true, '', true);

            // ---------------------------------------------------------
            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            return $pdf->Output($page['title'] . '- Page.pdf', 'D');

            // $pdf = PDF::loadHtml('crud.PDFPage', compact('page'))->setPaper($page['layout_pdf'][0], $page['layout_pdf'][1]);

            //   return $pdf->download($page['title'] . '- Page.pdf');

        } else if ($type == "save") {
            try {

                $save = CRUDFunc::crud_save($fai, $page, $sqli, $sqlen, $array, $database_utama, $returnddv);

                return $save;
                if (isset($page['crud']['submit_form_direct'])) {
                    if ($page['crud']['submit_form_direct']['type'] == 'this_link') {

                        // window.location.href = $('#load_link_route').val();
                    } else {

                        //	echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['crud']['submit_form_direct']['parameter']], 'menu', 'just_link') . '";</script>';
                    }
                } else {
                    //echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], "list", $page['load']['id'], $page['load']['nav'], $page['load']['menu'], $page['load']['board']], 'menu', 'just_link') . '";</script>';
                }
            } catch (Exception $e) {
                // Tangani error dan tampilkan pesan error di halaman yang sama
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
            die;
        } else if ($type == "update") {
            try {

                $save = CRUDFunc::crud_update($fai, $page, $sqli, $sqlen, $sqlfile, $array, $database_utama . '', $page['crud']['primary_key'], $id, $returnddv);

                return $save;

                if (isset($page['crud']['submit_form_direct'])) {
                    if ($page['crud']['submit_form_direct']['type'] == 'this_link') {

                        // window.location.href = $('#load_link_route').val();
                    } else {

                        //echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], $page['crud']['submit_form_direct']['parameter'], 'menu', 'just_link') . '";</script>';
                    }
                } else {
                    //echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], "list", $page['load']['id'], $page['load']['nav'], $page['load']['menu'], $page['load']['board']], 'menu', 'just_link') . '";</script>';
                }
                die;
            } catch (Exception $e) {
                // Tangani error dan tampilkan pesan error di halaman yang sama
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        } else if ($type == "hapus") {
            $id = Partial::input('id_form') ?? Partial::input('id');
            CRUDFunc::crud_hapus($fai, $page, $database_utama, $primary_key, $id);
            echo json_encode(["status" => 1]);
            die;
            if (isset($page['crud']['submit_form_direct'])) {
                if ($page['crud']['submit_form_direct']['type'] == 'this_link') {

                    // window.location.href = $('#load_link_route').val();
                } else {

                    echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['crud']['submit_form_direct']['parameter']], 'menu', 'just_link') . '";</script>';
                }
            } else {
                echo '<script> window.location.href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], "list", $page['load']['id'], $page['load']['nav'], $page['load']['menu'], $page['load']['board']], 'menu', 'just_link') . '";</script>';
            }
            die;
        } else if ($type == "update_approval") {
            $id_approval             = $fai->input('id_proses_approval');
            $idUser                  = $fai->id_user();
            $sql['id_apps_user']     = $idUser;
            $sql['tanggal_approval'] = date('Y-m-d H:i:s');
            $sql['status_approval']  = $fai->input('approve__status_approval__' . $id_approval);
            $sql['keterangan']       = $fai->input('approve__keterangan__' . $id_approval);
            $db['utama']             = 'form__approval__flow__proses';
            $db['where'][]           = ['connect_database_id', '=', $id];
            $db['where'][]           = ['id_approval', '=', $id_approval];
            $row_proses              = Database::database_coverter($page, $db, [], 'all');
            $page['crud']['view']    = "update_approval";
            CRUDFunc::crud_update($fai, $page, $sql, [], [], [], "form__approval__flow__proses", "id", $row_proses['row'][0]->primary_key, []);
            CRUDFunc::exted($page, $page['crud']['array_approval']['approval_flow'][$id]['extend'][$id_approval], $database_utama, $id, 'approval');
            if ($fai->input('approve__status_approval__' . $id_approval) == 4) {
                $sqlix['proses_tunggu'] = $id_approval;
            } else
            if ($id_approval == $page['crud']['array_approval']['id_max'] or $fai->input('approve__status_approval__' . $id_approval) == 2) {
                $sqlix['is_selesai']    = 1;
                $sqlix['proses_tunggu'] = 0;
            } else {
                $sqlix['is_selesai']    = 0;
                $sqlix['proses_tunggu'] = $page['crud']['array_approval']['next_approval'][$page['crud']['array_approval']['tahap_approval'][$id_approval]];
            }
            $sqlix['proses_selesai']             = $id_approval;
            $sqlix['id_approval_proses_selesai'] = $row_proses['row'][0]->primary_key;

            CRUDFunc::crud_update($fai, $page, $sqlix, [], [], [], "form__approval__flow", "id", $page['crud']['array_approval']['approval_flow'][$id]['row']->primary_key, []);
        } else if ($type == "setujui_appr") {

            try {
                // $idUser=$this->id_user();

                $update = [$field_appr . "_status" => 1, $field_appr . "_date" => date('Y-m-d H:i:s'), $field_appr . "_by" => $idUser];
                $where  = ["$primary_key=$id"];
                DB::update($database_utama, $update, $where);

                //return redirect()->route($page['route'], [$redirect, $id_redirect])->with('success', $page['title'] . ' Berhasil di input!');
            } catch (\Exeception $e) {
                // DB::rollback();
                return redirect()->back()->with('error', $e);
            }
        } else if ($type == "decline_appr") {

            try {

                $idUser = $fai->id_user();

                $update = [$field_appr . "_status" => 2, $field_appr . "_date" => date('Y-m-d H:i:s'), $field_appr . "_by" => $idUser];
                $where  = ["$primary_key=$id"];
                DB::update($database_utama, $update, $where);

                //return redirect()->route($page['route'], [$redirect, $id_redirect])->with('success', $page['title'] . ' Berhasil di input!');
            } catch (\Exeception $e) {
                // DB::rollback();
                return redirect()->back()->with('error', $e);
            }
        } else {
            if ($type == 'list') {
                $type = 'list_table';
            }

            return CrudContent::$type($page, $fai);
            //$fai->view('crud/' . $type . '.blade.php', $page);
        }
    }

    public static function chat($page, $type, $id)
    {
        $fai = new MainFaiFramework();
        if ($type == "chat") {
            return $fai->view("_template/" . $page['chat']['template_base'] . '/' . $type . '.template.php', $page);
        } else
        if ($type == "list_buat_chat_room") {
            return $fai->view($page['chat']['template_base'] . '/' . $type . '.template.php', $page);
        } else
        if ($type == "to_chat_room" or $type == 'list_pesan') {
            if ($type == "to_chat_room") {
                $dbroom['utama']   = "chat__room";
                $dbroom['where'][] = ["chat__room.id", '=', $id];
                $data_profile      = $fai->database_coverter($page, $dbroom, [], 'all');

                $content_profile = file_get_contents(Partial::urlframework($page['chat']['template_base'], 'content_profile.template.php'));
                $content_footer  = file_get_contents(Partial::urlframework($page['chat']['template_base'], 'content_footer.template.php'));

                $content_profile = str_replace("<NAMA-ROOM></NAMA-ROOM>", $data_profile['row'][0]->nama_room, $content_profile);
                $content_footer  = str_replace("<ID-CHAT></ID-CHAT>", $id, $content_footer);
            }
            $content_pesan_me    = file_get_contents(Partial::urlframework($page['chat']['template_base'], 'content_pesan_me.template.php'));
            $content_pesan_other = file_get_contents(Partial::urlframework($page['chat']['template_base'], 'content_pesan_other.template.php'));
            $db['select'][]      = "*";
            $db['select'][]      = "chat__room__pesan.create_date as last_date";
            $db['utama']         = "chat__room__pesan";
            $db['join'][]        = ["apps_user", "apps_user.id_apps_user", "id_pengirim"];
            $db['where'][]       = ["id_chat__room", '=', $id];
            $data                = $fai->database_coverter($page, $db, [], 'all');
            $result              = "";
            // $content_temp = $content_pesan;
            foreach ($data['row'] as $row) {
                if ($_SESSION['id_apps_user'] == $row->id_pengirim) {
                    $content_pesan = $content_pesan_me;
                } else {
                    $content_pesan = $content_pesan_other;
                }

                $content_pesan     = str_replace("<NAMA-LENGKAP></NAMA-LENGKAP>", $row->nama_lengkap, $content_pesan);
                $content_pesan     = str_replace("<PESAN></PESAN>", $row->content_message, $content_pesan);
                $last_date_tanggal = date('Y-m-d', strtotime($row->last_date));
                $last_date         = (($row->last_date));
                if (date('Y-m-d') != $last_date_tanggal) {

                    $waktu_last = date('d/m/Y H:i', strtotime($last_date));
                } else {
                    $waktu_last = date('H:i', strtotime($last_date));
                }
                if ($_SESSION['id_apps_user'] == $row->id_pengirim) {
                    $content_pesan = str_replace("<CLASS-PENGIRIM></CLASS-PENGIRIM>", ("bg-primary text-white"), $content_pesan);
                    $content_pesan = str_replace("<CLASS-PENGIRIM1></CLASS-PENGIRIM1>", ("justify-content-end"), $content_pesan);
                } else {
                    $content_pesan = str_replace("<CLASS-PENGIRIM></CLASS-PENGIRIM>", (""), $content_pesan);
                    $content_pesan = str_replace("<CLASS-PENGIRIM1></CLASS-PENGIRIM1>", (""), $content_pesan);
                    $content_pesan = str_replace("<IMAGE-PROFILE></IMAGE-PROFILE>", ('<img src="../assets/images/avatar/avatar-4.jpg" alt="Image" class="rounded-circle avatar-md user-avatar">'), $content_pesan);
                }
                $content_pesan = str_replace("<WAKTU-LAST></WAKTU-LAST>", ($waktu_last), $content_pesan);
                $result .= $content_pesan;
            }
            $content = "";
            if ($type == "to_chat_room") {
                $content .= $content_profile;
                $content .= '<div class="card-body" id="list_pesan" style="max-height: 355px;overflow: scroll;">';
            }
            $content .= $result;
            if ($type == "to_chat_room") {
                $content .= '</div>';
                $content .= $content_footer;
            }
            return $content;
        } else
        if ($type == "kirim_pesan") {
            return ChatApp::altenatif_send_massage($page, $id, $fai->input('pesan'), ($_SESSION['id_apps_user']), ($fai->input('mode') ? $fai->input('mode') : 'utama'));
        } else
        if ($type == "list_chat_room") {
            $content       = file_get_contents(Partial::urlframework($page['chat']['template_base'], $type . '.template.php'));
            $db['utama']   = "chat__room";
            $db['join'][]  = ["(select id_chat__room as id_chat_room,create_date as last_date,id_pengirim,tipe_pesan,content_message,sort from chat__room__pesan order by create_date desc limit 1) as pesan", "chat__room.id", "pesan.id_chat_room"];
            $db['join'][]  = ["apps_user", "apps_user.id_apps_user", "id_pengirim"];
            $db['join'][]  = ["chat__room__anggota", "chat__room__anggota.id_chat__room", "chat__room.id"];
            $db['where'][] = ["chat__room.id_panel", '=', "ID_PANEL|"];
            $db['where'][] = ["chat__room__anggota.id_apps_user", '=', "{SESSION_UTAMA}"];
            $data          = $fai->database_coverter($page, $db, [], 'all');

            if (! $data['num_rows']) {
                $sqli['apps_id']   = random(6);
                $sqli['id_panel']  = $page['get_panel']['id_panel'];
                $sqli['nama_room'] = "Be3 Grit Official";
                $sqli['tipe_room'] = "system";
                // $sqli['1'] = "system";
                $return = CRUDFunc::crud_save($fai, $page, $sqli, [], [], 'chat__room');
                $get_id = $return['last_insert_id'];

                $sqli2['id_chat__room'] = $get_id;
                $sqli2['id_apps_user']  = -1;
                $sqli2['id_role']       = 5;
                $sqli2['last_sort']     = 0;
                $sqli2['last_read']     = 0;
                $return                 = CRUDFunc::crud_save($fai, $page, $sqli2, [], [], 'chat__room__anggota');

                $sqli2['id_chat__room'] = $get_id;
                $sqli2['id_apps_user']  = $_SESSION['id_apps_user'];
                $sqli2['id_role']       = 7;
                $sqli2['last_sort']     = 0;
                $sqli2['last_read']     = 0;
                $return                 = CRUDFunc::crud_save($fai, $page, $sqli2, [], [], 'chat__room__anggota');

                $sqli3['id_chat__room']   = $get_id;
                $sqli3['mode']            = "utama";
                $sqli3['id_pengirim']     = -1;
                $sqli3['sort']            = 1;
                $sqli3['tipe_pesan']      = "pesan";
                $sqli3['content_message'] = "Selamat Datang di hibe3.com, kamu bisa menjelahi fitur lengkap kami dengan kirimkan \Help";
                $return                   = CRUDFunc::crud_save($fai, $page, $sqli3, [], [], 'chat__room__pesan');

                $data = $fai->database_coverter($page, $db, [], 'all');
            }

            $result       = "";
            $content_temp = $content;
            foreach ($data['row'] as $row) {
                $content           = $content_temp;
                $content           = str_replace("<ID_CHAT></ID_CHAT>", $row->id_chat_room, $content);
                $content           = str_replace("<NAMA-ROOM></NAMA-ROOM>", $row->nama_room, $content);
                $content           = str_replace("<LAST-MESSAGE></LAST-MESSAGE>", $row->content_message, $content);
                $content           = str_replace("<BELUM-BACA></BELUM-BACA>", ($row->sort - $row->last_sort), $content);
                $last_date_tanggal = date('Y-m-d', strtotime($row->last_date));
                $last_date         = (($row->last_date));
                $waktu_last        = "";
                if (date('Y-m-d') != $last_date_tanggal) {
                    if (Partial::hitungHari($last_date, date('Y-m-d')) == 1) {
                        $waktu_last = 'Kemarin';
                    } else if (date('Y', strtotime($last_date)) != date('Y')) {
                        $waktu_last = date('d/m/Y', strtotime($last_date));
                    } else {
                        $waktu_last = Partial::tgl_indo_no_tahun($last_date);
                    }
                } else {
                    $waktu_last = date('H:i', strtotime($last_date));
                }
                $content = str_replace("<WAKTU-LAST></WAKTU-LAST>", ($waktu_last), $content);
                $result .= $content;
            }
            return $result;
            //return $fai->view($page['chat']['template_base'].'/' . $type . '.template.php', $page);
        }
    }
    public static function wizard_form($fai, $page, $type, $id)
    {
        DB::connection($page);
        $crud   = isset($page['crud']) ? $page['crud'] : [];
        $return = Partial::checking_daftar_proses($fai, $page, $type, $id);

        $id           = $return['id'];
        $type         = $return['type'];
        $step         = $page['load']['login-daftar-array']['step'][$id];
        $page['crud'] = isset($step['function_crud']) ? $step['function_crud'] : [];
        $page['crud'] = array_merge($crud, $page['crud']);
        //row_to_database
        $config_database            = $page['crud']['wizard_form'][$fai->input('value_input')]['row_to_database'];
        $config_database['where'][] = [$page['crud']['wizard_form'][$fai->input('value_input')]['get_where'], "=", "'" . $fai->input($fai->input('value_input')) . "'"];
        $row_base_data              = $fai->database_coverter($page, $config_database, null);
        $selected                   = "";
        $value                      = $page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['value'];
        $option                     = $page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['text'];

        $fai->input('tipe_page');
        if ((in_array($fai->input('tipe_page'), ['edit']))) {
            $db            = $page['database'];
            $db['where'][] = [$db['utama'] . ".id", '=', $id];
            $database      = $fai->database_coverter($page, $db, null);
        } else {
            $database[0] = (object) [$value => -1];
        }
        foreach ($row_base_data as $data) {
            $text_prefix = "";
            $text_sufix  = "";

            if (isset($page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['prefix'])) {
                $prefix      = $page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['prefix'];
                $text_prefix = "";
                for ($i = 0; $i < count($prefix); $i++) {
                    //"type"=>"database","text"
                    if ($prefix[$i]['type'] == 'database') {
                        $row_prefix = $prefix[$i]['text'];
                        $text_prefix .= $data->$row_prefix;
                    } else if ($prefix[$i]['type'] == 'text') {
                        $text_prefix .= $prefix[$i]['text'];
                    }
                }
            }
            if (isset($page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['sufix'])) {
                $sufix = $page['crud']['wizard_form'][$fai->input('value_input')]['output_row']['sufix'];

                for ($i = 0; $i < count($sufix); $i++) {
                    //"type"=>"database","text"
                    if ($sufix[$i]['type'] == 'database') {
                        $row_prefix = $sufix[$i]['text'];
                        $text_sufix .= $data->$row_prefix;
                    } else if ($sufix[$i]['type'] == 'text') {
                        $text_sufix .= $sufix[$i]['text'];
                    }
                }
            }
            $selected = "";
            if ($database[0]->$value) {
                $selected = "selected";
            }
            echo '<option value="' . $data->$value . '" ' . $selected . '>' . $text_prefix . $data->$option . $text_sufix . '</option>';
        }
    }
    public static function view_layout($page, $type, $id, $section_menu)
    {

        if ($type == 'load_data') {
            if (! Partial::input('i_card')) {
                $_GET['i_card'] = 0;
            }
            $page['section']            = "card";
            $page['view_layout_number'] = Partial::input('i_card');

            return Packages::card($page, $type, $id, $section_menu, $page['view_layout'][Partial::input('i_card')][2]);
        } else {
            $content_view_layout_return = "";
            for ($i = 0; $i < count($page['view_layout']); $i++) {
                # code...

                $page['view_layout_number'] = $i;
                if ($page['view_layout'][$i][0] == 'card') {
                    $page['section'] = "card";

                    $content_view_layout_return .= Packages::card($page, $type, $id, $section_menu, $page['view_layout'][$i][2]);
                } else if ($page['view_layout'][$i][0] == 'website') {
                    $page['website'] = $page['view_layout'][$i][2];

                    $content_view_layout_return .= Packages::view_website($page, "");
                } else if ($page['view_layout'][$i][0] == 'step') {
                    DB::connection($page);
                    $step = $page['view_layout'][$i][2];

                    $page['wizard'] = $step['wizard'];
                    if ($step['parameter_check']['get_data'] == 'refer') {
                        $database = $page['config']['database'][$step['parameter_check']['database_refer']];
                    }

                    $row_base = Database::database_coverter($page, $database, null, 'all');
                    if ($row_base['num_rows']) {
                        $row_step = $step['parameter_check']['row_data'];
                        $id_done  = $row_base['row'][0]->$row_step;
                        if ($id_done == 0) {
                            $step_id = 1;
                        } else {
                            $step_id = $page['wizard']['step'][$id_done]['next'];
                        }

                    } else {
                        $step_id = 1;
                    }
                    $page['load']['step']      = $step_id;
                    $page['load']['next_step'] = $page['wizard']['step'][$step_id]['next'];
                    $step_content              = $step['content'];
                    $step                      = $step['wizard']['step'][$step_id];
                    $content_view_layout_return .= Packages::step($page, $step_id, $step, $step_content, $database, '');
                }
            }
            return $content_view_layout_return;
        }
    }
    public static function view_source($page, $type = 'view')
    {
        $fai = new MainFaiFramework();

        if ($type == 'export') {
            return include dirname(__FILE__) . '/../../Pages/view_source/MainExport.blade.php';
        } else {
            return include dirname(__FILE__) . '/../../Pages/view_source/generate_crud.blade.php';
        }
    }
    public static function card($page, $type, $id, $section_menu, $card)
    {
        $fai = new MainFaiFramework();

        $array = [];
        //foreach($card['config']['database'] as $key => $value){  
        if ($section_menu == '-1' or ! $section_menu) {
            $page['load']['page_section_menu'] = $card['default_id'];
        }

        $key = $section_menu;
        if (isset($card['menu'][$key][2])) {

            $nama_array = $card['menu'][$key][2];
            if (isset($card[$nama_array]['array'])) {
                $array = $card[$nama_array]['array'];
            } else {
                $array = null;
            }

        } else {
            $array = null;
        }

        $mode          = $card['menu'][$page['load']['page_section_menu']][1];
        $page_database = $page['load']['page_section_menu'];
        if (($card['menu'][$page['load']['page_section_menu']][1] != 'card-listing' and $card['menu'][$page['load']['page_section_menu']][1] != 'card-nav')) {
            $nama_type  = $card['menu'][$page['load']['page_section_menu']][1];
            $visible    = true;
            $nama_array = $card['menu'][$page['load']['page_section_menu']][2];
            $this_card  = $card[$card['menu'][$page['load']['page_section_menu']][2]];
            if (isset($card[$nama_array]['array'])) {
                $array = $card[$nama_array]['array'];
            } else {
                $array = $card[$nama_array];
            }

        } else if ($card['menu'][$page['load']['page_section_menu']][1] == 'card-nav') {

            if ($page['load']['nav'] == -1 or ! $page['load']['nav']) {

                $page['load']['nav'] = $card[$card['menu'][$page['load']['page_section_menu']][2]]['defaultNav'];
            }

            $this_card  = $card[$card['menu'][$page['load']['page_section_menu']][2]]['cardNav'][$page['load']['nav']];
            $nama_array = $card['menu'][$page['load']['page_section_menu']][2];
            $array      = $this_card['array'];
            $mode       = $card[$card['menu'][$page['load']['page_section_menu']][2]]['cardNav'][$page['load']['nav']]['mode'];
            $nama_type  = $mode;
            if (isset($card[$card['menu'][$page['load']['page_section_menu']][2]]['cardNav'][$page['load']['nav']]['database_refer'])) {
                $page_database = $card[$card['menu'][$page['load']['page_section_menu']][2]]['cardNav'][$page['load']['nav']]['database_refer'];
            }

            // 			if ($mode != 'card-listing')
            $visible = true;
        } else {
            $page_database = $page['load']['page_section_menu'];
            $this_card     = $card[$card['menu'][$page['load']['page_section_menu']][2]];
            //$nama_type = "";
            $nama_type  = $card['menu'][$page['load']['page_section_menu']][1];
            $nama_array = $card['menu'][$page['load']['page_section_menu']][2];
            $this_card  = $card[$card['menu'][$page['load']['page_section_menu']][2]];

            if (isset($card[$nama_array]['array'])) {
                $array = $card[$nama_array]['array'];
            } else {
                $array = $card[$nama_array];
            }

        }
        if ($mode == 'card-listing') {
            $visible = true;
        }

        $page_database;
        if (isset($page['config']['database'][$page_database])) {
            if (! isset($page['load']['workspace']['id_single_toko'])) {
                if (($fai->input('frameworksubdomain'))) {

                    $domain = $fai->input('frameworksubdomain');
                } else {
                    $domain = $_SERVER['HTTP_HOST'];
                }

                $ci     = &get_instance();
                $db_get = DB::get_clear();
                $page   = $fai->LoadApps($page, $domain, ($ci->uri->segment(2) ? $ci->uri->segment(2) : -1), 'page');

                DB::set_db($db_get);
            }
            $page['row_section'][$page_database] = $fai->database_coverter($page, $page['config']['database'][$page_database], $array, 'all');
        } else {
            $page['row_section'][$page_database] = (object) ['object' => 'foreach_1_row'];
        }

        $page['load']['page_database'] = $page_database;

        if ($type == 'view_layout') {
            return CardContent::main($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        } else if ($type == 'load_data') {
            $page['load']['card']['button_save']['function'] = "button_save_crud_card";
            $page['load']['page_section_menu']               = $id;

            return CardContent::main_load_data($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        }
    }

    public static function view_website($page, $content_template)
    {
        DB::connection($page);
        $fai                   = new MainFaiFramework();
        $content_template_temp = $content_template;
        $page['section']       = 'view_website';
        //echo $page['load']['link'];
        if (isset($page['config']['database'])) {
            foreach ($page['config']['database'] as $key => $value) {

                if (isset($page['config']['database'][$key])) {
                    $page['row_section'][$key] = Database::database_coverter($page, $page['config']['database'][$key], [], 'all');
                } else {
                    $page['row_section'][$key] = (object) ['object' => 'foreach_1_row'];
                }
            }
        }
        for ($i = 0; $i < count($page['website']['content']); $i++) {
            $temp_first = $page['website']['content'][$i];

            $key_array = "";
            if (isset($page['website']['content'][$i]['tag'])) {
                $key_array = $page['website']['content'][$i]['tag'];
            }

            $content = "";

            if (in_array($key_array, Bundlecontent::router($page, 'array', $temp_first))) {
                $content .= Bundlecontent::router($page, 'content', $temp_first, $key_array);
                $content = Bundlecontent::router($page, 'content', $page['website']['content'][$i], $key_array);
                if (isset($page['website']['content'][$i]['col_row'])) {
                    $content = "<div class='" . $page['website']['content'][$i]['col_row'] . "'>" . $content . '</div>';
                }
            } else
            if (isset($page['website']['content'][$i]['content_source'])) {
                $content = Partial::content_source($page, $page['website']['content'][$i]);
            }
            if (isset($page['website']['content'][$i]['row'])) {
                $content = "<div class='" . $page['website']['content'][$i]['row'] . "'>" . $content . '</div>';
            } else
            if (isset($page['website']['content'][$i]['col_row'])) {
                $content = "<div class='" . $page['website']['content'][$i]['col_row'] . "'>" . $content . '</div>';
            } else {
                $content = "<div class='col-md-12'>" . $content . '</div>';
            }
            if (isset($page['website']['content'][$i]['template_array'])) {

                //LAYER1//
                //LAYER1//
                //LAYER1//

                for ($j = 0; $j < count($page['website']['content'][$i]['template_array']); $j++) {
                    $tag           = $page['website']['content'][$i]['template_array'][$j]['tag'];
                    $content_array = "";
                    $temp          = $page['website']['content'][$i]['template_array'][$j];

                    $array = $page['website']['content'][$i]['template_array'][$j];
                    if (! isset($array['refer'])) {
                        $array['refer'] = "text";
                        $array['text']  = "";
                    }
                    if (! isset($page['website']['content'][$i]['template_array'][$j]['database_refer']) and $array['refer'] == 'database') {
                        echo $tag . ' Harus Di sertai database_refer';
                        die;
                    } else {
                        //   echo $tag.' belum Di sertai database_refer'; 
                    }

                    if (in_array($tag, Bundlecontent::router($page, 'array', $array))) {
                        $content_array .= Bundlecontent::router($page, 'content', $array, $tag);
                    } else
                    if ($array['refer'] == 'database_list' and 1 == 0) {
                        $content_array = Partial::database_list_view_website($page, $array, $temp);

                        $tag     = $array['tag'];
                        $content = str_replace("<$tag></$tag>", $content_array, $content);
                    } else {
                        if ($array['refer'] == 'text' and isset($array['value'])) {
                            $array['text'] = $array['value'];
                        }
                        if ($array['refer'] == 'database' and isset($array['database_row'])) {
                            $array['row'] = $array['database_row'];
                        }

                        if (isset($array['database_refer'])) {

                            $db_refer = $array['database_refer'];
                            if ($db_refer <= -1) {
                                $database_db = $array['database'];

                                if (isset($database_db['where_get_array'])) {
                                    for ($wga = 0; $wga < count($database_db['where_get_array']); $wga++) {
                                        $var_get_data = $database_db['where_get_array'][$wga]['get_row'];
                                        $array_row    = $database_db['where_get_array'][$wga]['array_row'];
                                        if (isset($$array_row->$var_get_data)) {
                                            $database_db['where'][] = [$database_db['where_get_array'][$wga]['row'], '=', $$array_row->$var_get_data];
                                        }
                                    }
                                }

                                if (! isset($page['row_section'][$db_refer])) {
                                    $page['row_section'][$db_refer]['row'][0]   = (object) ['object' => 'foreach_1_row'];
                                    $page['row_section'][$db_refer]['num_rows'] = 1;
                                }
                                $page['row_section'][$db_refer] = Database::database_coverter($page, $database_db, [], 'all');
                            }
                            if ($page['row_section'][$db_refer]['num_rows']) {
                                $content = Partial::array_website($page, $content, $array, $array['tag'], $j, $page['row_section'][$db_refer]['row'][0]);
                            }

                        } else {
                            $row     = (object) ['object' => 'foreach_1_row'];
                            $content = Partial::array_website($page, $content, $array, $array['tag'], $j, $row);
                        }
                    }
                }
            } else if (in_array($key_array, Bundlecontent::router($page, 'array', $page['website']['content'][$i]))) {

                $content = Bundlecontent::router($page, 'content', $page['website']['content'][$i], $key_array);
                if (isset($page['website']['content'][$i]['col_row'])) {
                    $content = "<div class='" . $page['website']['content'][$i]['col_row'] . "'>" . $content . '</div>';
                }
            }
            $page['website']['content'][$i] = $temp_first;
            if (
                strpos($content_template_temp, (! empty($page['website']['content'][$i]['tag']) ? $page['website']['content'][$i]['tag'] : '-99999999999'))
                and isset($page['website']['content'][$i]['tag'])
            ) {

                $tag              = $page['website']['content'][$i]['tag'];
                $content_template = str_replace("<$tag></$tag>", $content, $content_template);
            } else {

                $content_template .= $content;
            }
        }
        return "<div class='row'>" . $content_template . '</div>';
    }

    public static function datatable_array_website($page, $type, $id)
    {
        DB::connection($page);
        $fai = new MainFaiFramework();
        if ($fai->input('tipe_array') == 'array_utama') {
            $get_array   = $page['crud']['array'];
            $prefix_name = "";
            $sufix_name  = "";
        } else {
            $get_array   = $page['crud']['array_sub_kategori'][$fai->input('no_sub_kategori')];
            $prefix_name = $page['crud']['sub_kategori'][$fai->input('no_sub_kategori')][1] . '_';
            $sufix_name  = '[]';
        }
        $to_array = $get_array[$fai->input('no_array')];
        // if($to_array[3])
        $get = $to_array[4]['get'];

        $to_array[4];
        $sub_kategori_id = Partial::input('sub_kategori_id');
        $array           = $to_array[4]['search_row'];
        $search          = Partial::input('search');
        $where           = "";
        if (! empty($search['value'])) {
            $where = "  ( 0=1 OR ";
            $x     = 0;
            for ($i = 0; $i < count($array); $i++) {

                $where .= "upper(" . $array[$i] . ") like '%" . strtoupper($search['value']) . "%'";
                if ($i != count($array) - 1) {
                    $where .= '  OR  ';
                }
            }
            $where .= "  )";
        }

        // $_POST['search']['value']
        $draw = Partial::input('draw');
        $row  = Partial::input('start');
        if ($row < 0) {
            $row = 0;
        }
        $rowperpage = Partial::input('length'); // Rows display per page

        $key1         = Database::database_coverter($page, $to_array[4]['database'], [], 'source');
        $sql['query'] = "select count(*) from ($key1) as total";

        $key1 = Database::database_coverter($page, $sql, [], 'all');

        if ($page['database_provider'] == 'postgres') {
            $to_array[4]['database']['limit_raw'] = $rowperpage . " offset " . $row;
        } else {
            $to_array[4]['database']['limit_raw'] = $rowperpage . " offset " . $row;
        }

        $to_array[4]['database']['where_raw'] = $where;
        $key                                  = Database::database_coverter($page, $to_array[4]['database'], [], 'all');
        $data                                 = [];
        $no                                   = 0;
        if ($key['num_rows']) {
            foreach ($key['row'] as $value) {
                $no++;
                $nestedData['no'] = $no;
                foreach ($to_array[4]['array_detail'] as $key_detail => $value_detail) {
                    $nestedData[$key_detail] = $value->$key_detail;
                }
                $to_id = $value->primary_key;
                if (isset($to_array[4]['pilih_id'])) {
                    $to_id = "";
                    foreach ($to_array[4]['pilih_id'] as $key_pilih => $value_pilih) {

                        $row_pilih = $value_pilih[0];
                        $to_id .= $value->$row_pilih . "-";
                    }
                    $to_id = substr($to_id, 0, -1);
                }
                $nestedData['aksi'] = '<input  type="checkbox" ' . (in_array($value->primary_key, explode(',', $request->checked)) ? 'checked' : '') . ' id="checbox_search_load_sub_kategori_' . "" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "" . '' . $value->primary_key . '" onclick=""pilih_search_load_sub_kategori_' . "" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "('$to_id')" . '" class="btn btn-success btn-xs">';

                // $nestedData['aksi'] =  "<button type='button' onclick=" . '"' . "pilih_search_load_sub_kategori_" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "('$to_id')" . '"' . " class='btn btn-success btn-xs'>Pilih</button>";

                $data[] = $nestedData;
            }
        }
        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => ($key1['num_rows_non_limit']),
            "iTotalDisplayRecords" => ($key['num_rows_non_limit']),
            "aaData"               => $data,
        ];
        echo json_encode($response);
    }
    public static function sync($page, $type, $id)
    {

        if ($type == 'cari_sync') {
            $search = Partial::input('searchsync');

            $id = $page['load']['id'];
            DB::table('api_master__sync');

            DB::whereRawPage($page, "id=$id");
            $Get = DB::get('all');
            //print_R($Get);
            $return = ApiContent::router($page, $id, $Get['row'][0]->function_execution, $search);
            echo $return;
            die;
        } else if ($type == 'produk_sync') {
            $fai      = new MainFaiFramework();
            $id_utama = Partial::input('last_id_utama');

            $produk = ApiContent::produk_sync($page, $id, $id_utama);

            return (["status" => 1, "id_produk" => $produk['id_produk'], 'empty' => $empty ?? []]);
        } else if ($type == 'produk_sync_preorder') {
            $fai      = new MainFaiFramework();
            $id_utama = Partial::input('last_id_utama');

            $produk = ApiContent::produk_sync($page, $id, $id_utama);
            print_R($produk);
            return (["status" => 1, "id_produk" => $produk['id_produk'], 'empty' => $empty ?? []]);

        } else {

            $return = "";
            $return .= "
			<div class='card'>

				<div class='card-body'>
					<div class='row'>

						<input type='text' id='input_search_sync' placeholder='Search' class='form-control mt-3'>
					</div>
					<button type='button' class='btn btn-primary mt-3' onclick='cari_sync()'>Cari</div>
				</div>
			</div>
			<div class='card'>

				<div class='card-header'>
				Hasil Pencarian
				</div>
				<div id='result_pencarian_sync'>


				</div>
			</div>
			<script>
			function cari_sync(offset=0){
				$.ajax({
					type: 'get',
					data: {
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            'not_sidebar': 'not',
                            'MainAll': 2,
                            'type': 'cari_sync',
                            'offset': offset,
                            'searchsync': $('#input_search_sync').val(),
                        },
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                            $('#result_pencarian_sync').html(data);
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
							}
                    });
			}

			</script>


			" . ' <script>
        $("#example1").DataTable({
								fixedColumns: {
									left: 2
								},
								"scrollY": 500,
								"scrollX": true,
								"ordering": true,
								"lengthChange": true,
								"paging": true,
							});
        </script>';
        }
        return $return;
    }
    public static function datatable($page, $type, $id)
    {
        DB::connection($page);
        $page['crud']['search_load_sub_kategori'][$id];
        $sub_kategori_id = Partial::input('sub_kategori_id');
        $array           = $page['crud']['search_load_sub_kategori'][$id]['search_row'];
        $search          = Partial::input('search');
        $where           = "";
        if (! empty($search['value'])) {
            $where = "  ( 0=1 OR ";
            $x     = 0;
            for ($i = 0; $i < count($array); $i++) {

                $where .= "upper(" . $array[$i] . ") like '%" . strtoupper($search['value']) . "%'";
                if ($i != count($array) - 1) {
                    $where .= '  OR  ';
                }
            }
            $where .= "  )";
        }

        // $_POST['search']['value']
        $draw = Partial::input('draw');
        $row  = Partial::input('start');
        if ($row < 0) {
            $row = 0;
        }
        $rowperpage = Partial::input('length'); // Rows display per page

        $key1         = Database::database_coverter($page, $page['crud']['search_load_sub_kategori'][$id]['database'], [], 'source');
        $sql['query'] = "select count(*) from ($key1) as total";
        $key1         = Database::database_coverter($page, $sql, [], 'all');

        if ($page['database_provider'] == 'postgres') {
            $page['crud']['search_load_sub_kategori'][$id]['database']['limit_raw'] = $rowperpage . " offset " . $row;
        } else {
            $page['crud']['search_load_sub_kategori'][$id]['database']['limit_raw'] = $rowperpage . " offset " . $row;
        }

        $page['crud']['search_load_sub_kategori'][$id]['database']['where_raw'] = $where;
        $key                                                                    = Database::database_coverter($page, $page['crud']['search_load_sub_kategori'][$id]['database'], [], 'all');
        $data                                                                   = [];
        $no                                                                     = 0;
        if ($key['num_rows']) {
            foreach ($key['row'] as $value) {
                $no++;
                $nestedData['no'] = $no;
                foreach ($page['crud']['search_load_sub_kategori'][$id]['array_detail'] as $key_detail => $value_detail) {
                    $nestedData[$key_detail] = $value->$key_detail;
                }
                $to_id = $value->primary_key;
                if (isset($page['crud']['search_load_sub_kategori'][$id]['pilih_id'])) {
                    $to_id = "";
                    foreach ($page['crud']['search_load_sub_kategori'][$id]['pilih_id'] as $key_pilih => $value_pilih) {

                        $row_pilih = $value_pilih[0];
                        $to_id .= $value->$row_pilih . "-";
                    }
                    $to_id = substr($to_id, 0, -1);
                }
                // if(isset($page['crud']['search_load_sub_kategori'][$id]['row_checked']))
                $nestedData['aksi_checkbox'] = '<input  type="checkbox" ' . (in_array($to_id, explode(',', Partial::input('checked'))) ? 'checked' : '') . ' id="checbox_search_load_sub_kategori_' . "" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "" . '' . $to_id . '" onclick="pilih_search_load_sub_kategori_' . "" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "('$to_id')" . '" class="btn btn-success btn-xs">';
                // else
                $nestedData['aksi'] = "<button type='button' onclick=" . '"' . "pilih_search_load_sub_kategori_" . $page['crud']['sub_kategori'][$sub_kategori_id][1] . "('$to_id')" . '"' . " class='btn btn-success btn-xs'>Pilih</button>";

                $data[] = $nestedData;
            }
        }
        $response = [
            "draw"                 => intval($draw),
            "iTotalRecords"        => ($key1['num_rows_non_limit']),
            "iTotalDisplayRecords" => ($key['num_rows_non_limit']),
            "aaData"               => $data,
        ];
        echo json_encode($response);
    }

    public static function search_load($page, $type, $id)
    {
        DB::connection($page);
        $fai                          = new MainFaiFramework();
        $search_temp                  = $search                  = Partial::input('primary_key');
        $page['crud']['view']         = "tambah";
        $page['crud']['input_inline'] = "";
        $page['crud']['type']         = "tambah";
        $page['crud']['startdiv']     = "";
        $page['crud']['enddiv']       = "";
        $sub_kategori_id              = Partial::input('sub_kategori_id');
        if (Partial::input('method') == 'pilih') {
            if (isset($page['crud']['search_load_sub_kategori'][$id]['pilih_id'])) {
                $search = explode('-', $search);
                $I      = 0;

                foreach ($page['crud']['search_load_sub_kategori'][$id]['pilih_id'] as $key_pilih => $value_pilih) {
                    if ($search[$key_pilih]) {
                        $page['crud']['search_load_sub_kategori'][$id]['database']['where'][] = [$value_pilih[1] . "." . (isset($value_pilih[2]) ? $value_pilih[2] : $value_pilih[0]), " = ", $search[$key_pilih]];
                    }

                    $I++;
                }
            } else {

                $page['crud']['search_load_sub_kategori'][$id]['database']['where_raw'] = $page['crud']['search_load_sub_kategori'][$id]['database']['utama'] . "." . $page['crud']['search_load_sub_kategori'][$id]['database']['primary_key'] . " = $search";
            }
        } else {
            $page['crud']['search_load_sub_kategori'][$id]['database']['where_raw'] = $page['crud']['search_load_sub_kategori'][$id]['search'] . " = '$search'";
        }

        $key    = Database::database_coverter($page, $page['crud']['search_load_sub_kategori'][$id]['database'], [], 'all');
        $no     = Partial::input('no');
        $return = "";
        $return .= '<tr id="table-subkateogri-tr-' . $page['crud']['field_sub_kategori'][$id] . '-' . $no . '">';
        if ($key['row']) {

            foreach ($key['row'] as $value) {

                $return .= '<td>' . $no . '
			<input id="no-search_load_sales_order_det-' . $value->primary_key . '" type="hidden" value="' . $no . '">
			<input class="no-' . $sub_kategori_id . '" type="hidden" value="' . $no . '">
			<input id="no-search_load_' . $id . '-' . $search_temp . '" type="hidden" value="' . $no . '">
			<input class="pilih_id-' . $sub_kategori_id . '" type="hidden" value="' . $search_temp . '">
			</td>';

                $array = $page['crud']['array_sub_kategori'][$sub_kategori_id];
                foreach ($page['crud']['search_load_sub_kategori'][$id]['array_result'] as $key_result => $value_result) {

                    if ($value_result['type'] == 'database') {
                        $row_value                                 = $value_result["row"];
                        $page['crud']['insert_value'][$key_result] = $value->$row_value;
                    } else if ($value_result['type'] == 'database_diferent') {
                        $row_value = $value_result["diferent_row"];
                        if (! isset($database_diferent[$value->$row_value])) {
                            $database_diferent[$value->$row_value] = Partial::random(10);
                        }

                        $page['crud']['insert_value'][$key_result] = $database_diferent[$value->$row_value];
                    } else if ($value_result['type'] == 'array_website') {
                        foreach ($value_result['connect'] as $key_array => $value_array) {
                            $row_array                                                = $value_array[0];
                            $page['crud']['where_value_array_website'][$key_result][] = [$value_array[1] . "." . $value_array[0], '=', $value->$key_array];
                        }
                    } else if ($value_result['type'] == 'text') {
                        $row_value                                 = $value_result["text"];
                        $page['crud']['insert_value'][$key_result] = $row_value;
                    }
                }
                for ($i = 0; $i < count($array); $i++) {
                    $page['page_row'] = 'sub_kategori';
                    if (in_array($page['crud']['view'], ['view'])) {
                        $page['crud']['input_inline'] = 'disabled';
                    }

                    $type                           = $array[$i][2];
                    $typearray                      = CrudContent::typearray($page, $array, $i);
                    $type                           = $typearray['type'];
                    $page['crud']['numbering']      = $no;
                    $visible                        = $typearray['visible'];
                    $page['crud']['type_form_asal'] = $typearray['type_form_asal'];
                    if ($visible) {
                        $extypearray = explode('-', $array[$i][2]);
                        if ($type == 'hidden_input') {
                        } else
                        if ((in_array('number', $extypearray)) and (isset($page['PDFPage']))) {
                            $return .= '<td style="padding: 15px 10px;min-width: 250px;text-align:right">';
                        } else {
                            $return .= '<td style="padding: 15px 10px;min-width: 250px;">';
                        }

                        $return .= CrudContent::form($page, $fai, $array, $i, $no, $key['row']);
                        $return .= '</td>';
                    }
                    // echo ''.$page['view'];

                }
                // <button type="button" onclick="sub_kategori_add(0,' . "'" . "table" . "'" . ')" class="btn btn-primary btn-sm">
                // 										<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                // 									</button>
                $return .= '
			<td style="display: flex;">

			<button type="button" onclick="deleteRow(0,' . $no . ',' . "'" . "table" . "'" . ')" class="btn btn-primary btn-sm">
			<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
		</button>
		</td>';
            }
        }
        $return .= '<tr>';
        return $return;
    }

    // public static function webapps($page){
    // 	if(count($_POST)){

    // 		$database['utama'] = 'webapps__page';
    // 		$database['primary_key'] = Database::converting_primary_key($page,$database['utama'],'ontable');
    // 		$where = array();
    // 		$array = array();
    // 		$sqli[$database['primary_key']] = Partial::random(15);
    // 		foreach($_POST as $key => $value){
    // 			$where[] = array($key,'=',$value);
    // 			$array[] = array($key,$key,'text');
    // 			$sqli[$key] = $value;
    // 		}
    // 		$database['where'] = $where;

    // 		Database::create_database_check($page,$array,$database['utama'],$database['primary_key'],$page['database_provider'],$page['app_framework']);
    // 		$get = Database::database_coverter($page,$database,$array);
    // 		if(count($get)){
    // 			return $get[0]->primary_key;
    // 		}else{
    // 			return $sqli[$database['primary_key']];
    // 		}
    // 	}
    // }

    public static function searchNavbar($page, $domain)
    {
        $page = Configuration::LoadApps($page, $domain, -1, 'page');

        $page                                       = DatabaseFunc::search_navbar_func($page);
        $page['load']['row_web_apps']->tipe_website = 'template_content';
        $page['template']                           = "foodmart";
        $page['contentfaiframework']                = "search_navbar";
        $page['mainAll']                            = "2";
        $page['require_login']                      = 0;
        $page['is_login']                           = isset($_SESSION['id_apps_user']);
        echo Configuration::content($page);
    }

    public static function footer_menu($page)
    {
        $content_template = file_get_contents(__DIR__ . '/../../Pages/_template/' . $page['load']['footer_menu']['template_name'] . '/ButtombarPage.php');
        echo $content_template;
    }
    public static function js_ajax($page, $type = 'view')
    {
        $link = Partial::input('link');
        $link = json_decode($link, true);

        require_once __DIR__ . "/../" . $link[0] . '/' . $link[1] . '.php';
        $class         = $link[1];
        echo $function = $link[2];
        echo $class::$function($page);

        print_r($link);
        print_r($_GET);
    }
}
