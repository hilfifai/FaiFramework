<?php

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TemplateContent
{

    public static function logo($page, $type="", $array="", $data=[])
    {
        return [$type => ["content" => ["html" => "<div class='logo'>FaiFramework</div>"]]];
    }

    public static function nama_kategori($page, $type="", $array="", $data=[])
    {
        return [$type => ["content" => ["html" => ""]]];
    }

    public static function primary_key($page, $type="", $array="", $data=[])
    {
        return [$type => ["content" => ["html" => ""]]];
    }

    public static function nomor_send_wa($page,$type="", $array="", $data=[])
    {
        return [$type => ["content" => ["html" => ""]]];
    }

    public static function parse_template($page, $array, $i, $data = [])
    {

        $function = $array[$i][0];
        $type     = $array[$i][1]??"";
        if (! $function and ! $type) {
            return '';
        }
        if (!method_exists(self::class, $function)) {
            $tag = $function;
            $function = $type;
            $type = $array[$i][2] ?? '';
        }
        // $content = self::parse_header($page,$array,$i);
        if ($function == 'pages_content') {
            // echo 'lenapa tak de';
            $content['content']['html'] = $content_return = $page['fai']->pages_content($page);
        } else if ($function == 'bundle') {
            $content['content']['html'] = Bundlecontent::$type($page);
        } else if ($function == 'link') {
            $content['content']['html'] = Bundlecontent::link($page, $type, $array[$i][2]);
        } else if ($function == 'list_menu_board') {

            $content['content']['html'] = Partial::menu_workspace_role_apps_menu($page);
        } else if ($function == 'row_web_apps') {
            $content['content']['html'] = $page['load']['row_web_apps']->$type;
        } else if ($function == 'drive_file_from_database') {
            $content['content']['html'] = Partial::get_url_file($page, ($data->$type??""));
        } else if ($function == 'drive_file_db') {
            $content['content']['html'] = Partial::url_file($data);
        } else if ($function == 'database') {
            $content['content']['html'] = $data->$type ?? "";
        } else if ($function == 'get_data_harga') {
            $id                         = $array[$i][2];
            $get_data_harga             = EcommerceApp::get_data_harga($page, '', '', $array[$i]['parameter'], ($data->$id ?? ""));
            $content['content']['html'] = $get_data_harga[$array[$i]['get_result']] ?? "";
        } else if ($function == 'user_info') {
            if (isset($_SESSION['id_apps_user'])) {
                $sql = DB::fetchResponse(DB::select("select * from apps_user where id_apps_user=" . $_SESSION['id_apps_user'] . " "));
                if ($sql) {
                    $content['content']['html'] = $sql[0]->$type;
                } else {
                    $content['content']['html'] = "";
                }

            } else {
                $content['content']['html'] = "";
            }
        } else if ($function == 'text') {
            $content['content']['html'] = $type;
        } else if ($function == 'crud') {
            $temp_app       = $page['load']['apps'];
            $temp_page_view = $page['load']['page_view'];
            $temp_type      = $page['load']['type'];
            $temp_id        = $page['load']['id'];

            $page = Pages::Apps($array[$i]['class'], $array[$i]['function'], $page);
            unset($page['done_initialize']);
            $page                       = Packages::initialize($page);
            $content['content']['html'] = Pages::page($page, $type, $array[$i]['id'] ?? '-1', "");
            $page['load']['apps']       = $temp_app;
            $page['load']['page_view']  = $temp_page_view;
            $page['load']['type']       = $temp_type;
            $page['load']['id']         = $temp_id;
        } else if ($function == 'menu') {

            $list = $array[$i]['list'];
            if ($list['tipe'] == 'menu_func') {
                $nama_func = $list['func'];
                $menu      = MenuFunc::$nama_func($page);
            }
            $configuration              = $array[$i]['configuration'];
            $page['route_type']         = 'just_link';
            $content['content']['html'] = Partial::navbar_menu($page, $menu, $configuration, 0);
        } else if ($function == 'view_to_js') {
            $view_to_js = "<script>
            function parsehtml" . $array[$i]['func'] . "(key){
            getItemBarang(key).then((data_produk) => {

            console.log('ini'+data_produk);
            $('#content-" . $array[$i]['variable'] . "').html( `
            ";
            $array[0][0]        = $page['template'];
            $array[0][1]        = $array[$i]['content'];
            $array[0]["return"] = "just_template";
            $html               = TemplateContent::parse_template($page, $array, 0);
            $js_array           = $array[$i]['array'];

            $temp_html = $html['content']['html'];
            function looping_array($page, $temp_html, $js_array, $array, $i, $variable, $tree_var = "data_produk")
            {
                foreach ($js_array as $a => $value_a) {
                    echo '<Br>';
                    echo $tree_var;

                    if ($value_a[0] == 'data_tree') {
                        echo '${' . $tree_var . ($value_a['tree_var'] ?? '') . "." . $value_a[1] . '}';
                        $temp_html = str_replace("<$a></$a>", '${' . $tree_var . "." . $value_a[1] . '}', $temp_html);
                    } else
                    if ($value_a[0] == 'data') {
                        $temp_html = str_replace("<$a></$a>", '${' . $variable . "." . $value_a[1] . '}', $temp_html);
                    } else if ($value_a[0] == 'looping') {
                        $temp_looping = "";

                        $template_array   = $value_a;
                        $template_looping = Partial::content_source($page, $template_array);

                        for ($vl = 0; $vl <= count($value_a['looping']); $vl++) {
                            if (isset($value_a['looping'][$vl])) {
                                $thisg_looping = $template_looping;
                                $key           = $value_a['looping_array'];
                                echo $value    = $value_a['looping'][$vl];
                                $thisg_looping = str_replace("<$key></$key>", '${' . $variable . "." . $value_a[1] . "." . $value . '}', $thisg_looping);
                                if (isset($value_a['array'])) {
                                    foreach ($value_a['array'] as $key2 => $value2) {
                                        $tree_value    = ($variable . "." . $value_a[1] . "." . $value);
                                        $thisg_looping = str_replace(
                                            "<$key2></$key2>",
                                            looping_array($page, $thisg_looping, $value_a['array'], $array, $i, $variable, $tree_value),
                                            $thisg_looping
                                        );
                                    }
                                }
                                $temp_looping .= $thisg_looping;
                            }
                        }

                        $temp_html = str_replace("<$a></$a>", $temp_looping, $temp_html);
                    } else
                    if ($value_a[0] == 'list') {
                        $template_array = $value_a;
                        $template_list  = Partial::content_source($page, $template_array);

                        $temp_list = $template_list;
                        foreach ($value_a['array'] as $key2 => $value2) {
                            $temp_list = str_replace(
                                "<$key2></$key2>",
                                looping_array($page, $temp_list, $value_a['array'], $array, $i, $variable, ($variable . "." . $value_a[1])),
                                $temp_list
                            );
                        }
                        $temp_html = str_replace("<$a></$a>", $temp_list, $temp_html);

                        // $temp_html = str_replace("<$a></$a>", '${' . $array[$i]['variable'] . "." . $value_a[1] . '}', $temp_html);
                    }
                }
                return $temp_html;
            }

            $view_to_js .= looping_array($page, $temp_html, $js_array, $array, $i, $array[$i]['variable']);
            $view_to_js .= "`);
            }).catch((error) => {
            });
            }</script>";
            return $view_to_js;
        } else {
            if($function){

               if (is_string($function) && method_exists(static::class, $function)) {
                    $result  = self::$function($page, $type, $array[$i], $data);
                    $content = $result[$type] ?? null;
                } else {
                    $content['content']['html'] = "";
                }
            }
        }
        if (empty($array[$i]['return'])) {
            $array[$i]['return'] = "html_content";
        }

        if ($array[$i]['return'] == "just_template") {
            return $content;
        }
        $return = "";
        if (isset($content['content']['css'])) {
            $return .= Partial::html_decode($page, '', '', $content['content']['css']);
        }
        if (isset($content['content']['html'])) {
            $return .= Partial::html_decode($page, '', '', $content['content']['html']);
        }
        if (isset($content['content']['js'])) {
            $return .= Partial::html_decode($page, '', '', $content['content']['js']);
        }
        if (isset($content['database'])) {

            $row      = Database::database_coverter($page, $content['database'], [], 'all');
            $row_json = json_encode($row['row']);

            if (isset($content['pagination']['page'])) {
                if ($content['pagination']['page'] == 'json') {

                    $row['is_json'] = 1;
                }
            } else {
                $row['is_json'] = 0;
            }
        } else {
            $row = [
                "query"    => 0,
                "is_json"  => 0,
                "num_rows" => 1,
                "row"      => (object) ['object' => 'foreach_1_row'],
            ];
        }

        $return_all = "";
        if ($content['search'] ?? 0) {
            $return_all = "
            <div class='mb-3'>
            <div class=''>
           <label>Cari</label>
            <input type='text' id='search-$function-$type' class='form-control'>

            </div>
            <div class='mt-3'>
               <button type='button' id='buttonsearch-$function-$type' onclick='searchdata$function" . "_$type()' class='btn btn-primary'>Cari</button>
            </div>
            </div>
            ";
        }
        if ($row['num_rows'] and ! $row['is_json']) {
            foreach ($row['row'] as $row) {
                if (isset($content['array'])) {

                    $return_temp = $return;
                    foreach ($content['array'] as $key => $value) {

                        $array = [];
                        // if()

                        foreach ($value as $key2 => $value2) {
                            if (is_int($key2)) {
                                $key2 -= 1;
                            }

                            $array[0][$key2] = $value2;
                        }
                        $template_content = TemplateContent::parse_template($page, $array, 0, $row);
                        $return_temp      = str_ireplace(
                            '<' . $content['array'][$key][0] . '></' . $content['array'][$key][0] . '>',
                            $template_content,
                            $return_temp
                        );
                    }
                    $return_all .= $return_temp;
                } else {

                    $return_all .= $return;
                }
            }
        } else {
            // $template_content = TemplateContent::parse_template($page, $array, 0);
            $return_all .= "
            <div id='content-$function-$type' class='" . (isset($content['row']) ? 'row' : '') . "'></div>

                " . BundleContent::load_json($page, $function, $type, $row_json, $content) . "

            ";
        }

        return $return_all;
    }
    public static function system($page, $type = -1, $array = [])
    {
        $set_type = "pesanan";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::system_pesanan($page);
            $template[$set_type]['array'][] = ["LIST-ADD-PRODUK", 'system', 'pesanan_list_add_produk'];
            $template[$set_type]['array'][] = ["LIST-CUSTOMER", 'system', 'list_customer_option'];
            $template[$set_type]['array'][] = ["LIST-PAGE", 'system', 'list_customer_page'];
            $template[$set_type]['array'][] = ["LIST-PESANAN", 'system', 'list_customer_pesanan'];
        }
        $set_type = "produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::system_produk($page);
            $template[$set_type]['array'][] = [
                "PRODUK-DETAIL",
                'view_to_js',
                'data',
                'content'  => "BE3-ECOMMERCE-DETAIL-PRODUCT",
                "variable" => "data_produk",
                "func"     => "data_produk",
                "array"    => [
                    "NAMA-PRODUK"      => ["data", "nama_barang"],
                    "ID-ASSET"         => ["data", "id_asset"],
                    "ID-PRODUK"        => ["data", "id_produk"],
                    "TOTAL-TERJUAL"    => ["data", "total_jual"],
                    "HARGA-AKHIR"      => ["data", "harga_jual"],
                    "HARGA-AWAL"       => ["data", "id_asset"],
                    "TUMB-LIST-ASHION" => ["data", "foto_utama"],
                    // "IMG-LIST-ASHION" => [
                    //     "list",
                    //     "foto_utama",
                    //     "source_list" => "template",
                    //     "content_source" => "template",
                    //     "template_name" => "ashion",
                    //     "template_file" => "img_list.template",
                    //     'array' => array(
                    //         'SRC' => array(
                    //             "refer" => "img_in_database",
                    //         ),
                    //         'ACTIVE' => array(
                    //             "refer" => "if_first",
                    //             "text" => "active",
                    //         ),
                    //         'ID-PRODUK' => array(
                    //             "refer" => "database",
                    //             "row" => "id_produk",
                    //         ),

                    //     ),
                    // ],
                    "VARIAN"           => [
                        "looping",
                        "list_varian",
                        "content_source" => "template",
                        "template_name"  => "beegrit",
                        "looping"        => ["tipe_1", "tipe_2", "tipe_3"],
                        "looping_array"  => "NAMA-TIPE",
                        "template_file"  => "ecommerce/varian.template",
                        'array'          => [

                            'LIST' => [
                                "list",
                                "list_varian_detail",
                                "template_name" => "beegrit",
                                "template_file" => "ecommerce/varian_else.template",
                                "array"         => [
                                    "VALUE"          => ["data_tree", "id_varian", "tree_var" => ".list_varian"],
                                    "LEVEL"          => ["data_tree", "level"],
                                    "ID-ASSET"       => ["data", "id_asset"],
                                    "ID-PRODUK"      => ["data", "id_store_produk"],
                                    "ID-VARIAN-LIST" => ["data_tree", "id_varian"],
                                    "NAMA-VARIAN"    => ["data_tree", "nama_varian"],

                                ],
                            ],
                        ],
                    ],
                ],
            ];
        }
        $set_type = "list_customer_option";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']['html']   = "<Option value='<VALUE></VALUE>'><TEXT></text></Option>";
            $template[$set_type]['database']['utama'] = 'apps_user';

            $template[$set_type]['database']['where'][] = ['active', "=", "1"];
            $template[$set_type]['array'][]             = ["TEXT", 'database', 'nama_lengkap'];
            $template[$set_type]['array'][]             = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "list_customer_page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']['html']   = "<Option value='<VALUE></VALUE>'><TEXT></text></Option>";
            $template[$set_type]['database']['utama'] = 'webmaster__erp_pos__page';

            $template[$set_type]['database']['where'][] = ['active', "=", "1"];
            $template[$set_type]['array'][]             = ["TEXT", 'database', 'page'];
            $template[$set_type]['array'][]             = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "list_customer_pesanan";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']['html']    = "<Option value='<VALUE></VALUE>'><TEXT></text></Option>";
            $template[$set_type]['database']['utama']  = 'erp__pos__utama';
            $template[$set_type]['database']['join'][] = ['apps_user', 'erp__pos__utama.id_apps_user', 'apps_user.id_apps_user'];
            $template[$set_type]['database']['select'] = ['*', "concat(no_purchose_order,' - ',nama_lengkap)"];

            $template[$set_type]['database']['where'][] = ['erp__pos__utama.active', "=", "1"];
            $template[$set_type]['array'][]             = ["TEXT", 'database', 'no_purchose_order'];
            $template[$set_type]['array'][]             = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "pesanan_list_add_produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']                    = Bundlecontent::system_pesanan_list_add_produk($page);
            $template[$set_type]['database']['utama']          = 'inventaris__asset__list_query';
            $template[$set_type]['database']['non_add_select'] = 'inventaris__asset__list_query';
            $template[$set_type]['database']['select'][]       = 'nama_barang,nama_varian,id_varian_1,id_varian_2,id_varian_3,barcode,barcode_varian,
                                                            inventaris__asset__list.id as id_asset,
                                                            inventaris__asset__list__varian.id as id_asset_varian,
                                                            store__produk.id as id_produk,
                                                            store__produk__varian.id as id_produk_varian,
                                                            case when varian_produk=1 then berat_varian else berat end as berat_satuan_akhir,
                                                            concat(drive__file.path,drive__file.file_name_save) as foto_utama';
            $template[$set_type]['database']['join'][]  = ['store__produk', "inventaris__asset__list.id", "store__produk.id_asset", "inner"];
            $template[$set_type]['database']['join'][]  = ['store__produk__varian', "store__produk__varian.id_store__produk", "store__produk.id", "left"];
            $template[$set_type]['database']['join'][]  = ['inventaris__asset__list__varian', "inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list and store__produk__varian.id_barang_varian = inventaris__asset__list__varian.id", 'left'];
            $template[$set_type]['database']['join'][]  = ['drive__file', "inventaris__asset__list.foto_aset::text", "drive__file.id::text", "left"];
            $template[$set_type]['database']['where'][] = ['1=1', "", "WORKSPACE_SINGLE_TOKO_WHERE|", ""];
            $template[$set_type]['database']['order'][] = ['nama_barang', "asc"];
            $template[$set_type]['database']['order'][] = ['nama_varian', "asc"];
            // $template[$set_type]['database']['limit'] = 30;

            $template[$set_type]['pagination']['page']  = "json"; //json data // ajax page data
            $template[$set_type]['pagination']['limit'] = 30;
            $template[$set_type]['row']['col']          = "col-md-3 col-sm-4 col-xs-6";
            $template[$set_type]['search']['field'][]   = "nama_barang";
            $template[$set_type]['search']['field'][]   = "nama_varian";
            $template[$set_type]['search']['field'][]   = "barcode";
            $template[$set_type]['search']['field'][]   = "barcode_varian";
            // $template[$set_type]['array'][] = ["FORM-SEARCH-BAR", 'foodmart', 'form_search_bar'];
            $template[$set_type]['array'][] = ["NAMA-BARANG", 'database', 'nama_barang'];
            $template[$set_type]['array'][] = ["NAMA-VARIAN", 'database', 'nama_varian'];
            $template[$set_type]['array'][] = ["HARGA", 'database', 'harga_jual'];
            $template[$set_type]['array'][] = ["BERAT", 'database', 'berat_satuan_akhir'];
            $template[$set_type]['array'][] = ["IMG-SRC", 'database', 'foto_utama'];
            $template[$set_type]['array'][] = ["ID_ASSET", 'database', 'id_asset'];
            $template[$set_type]['array'][] = ["ID_PRODUK", 'database', 'id_produk'];
            $template[$set_type]['array'][] = ["ID_ASSET_VARIAN", 'database', 'id_asset_varian'];
            $template[$set_type]['array'][] = ["ID_PRODUK_VARIAN", 'database', 'id_produk_varian'];
            $template[$set_type]['array'][] = ["ID_VARIAN1", 'database', 'id_varian_1'];
            $template[$set_type]['array'][] = ["ID_VARIAN2", 'database', 'id_varian_2'];
            $template[$set_type]['array'][] = ["ID_VARIAN3", 'database', 'id_varian_3'];
            // $template[$set_type]['array'][] = ["BE3-LINK-CART", 'link', ["Ecommerce","cart","view_layout",-1],'just_link'];
        }
        return $template;
    }
    public static function codepen($page, $type = -1)
    {
        $template = [];
        $set_type = "swipper_slider_centered";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::swipper_slider_centered($page);
        }
        $set_type = "profil-dropdown";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::profil_dropdown($page);

            $template[$set_type]['array'][] = ["BE3-NAMA-LENGKAP", 'user_info', 'nama_lengkap'];
            $template[$set_type]['array'][] = ["BE3-SUBINFO", 'text', 'User'];
            $template[$set_type]['array'][] = ["BE3-LINK-PROFIL", 'link', ["User", "profil", "view_layout", -1], 'just_link'];
            $template[$set_type]['array'][] = ["BE3-LINK-LOGOUT", 'bundle'];
        }
        $set_type = "checkout-page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::codepen_checkout_page($page);
        }
        $set_type = "job-search-platform-ui-produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::job_search_plaform_ui_produk($page);
        }
        $set_type = "job-search-platform-ui";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::job_search_plaform_ui($page);
            $template[$set_type]['array'][] = [
                "LIST-PRODUK",
                'produk',
                'new',
                "func_content"  => "codepen",
                'content'       => "job-search-platform-ui-produk",
                "func"          => "data_produk",
                "variable"      => "data_produk",
                "refer"         => "database_func",
                "judul",
                "include_in_id" => [

                    "class" => "job-cards",
                    "after" => "</div>",
                ],
                "refer_db"      => "all_produk",
                "pagination"    => [
                    "page"     => "load_more",
                    "limit"    => 30,
                    "order_by" => ["create_date", "desc"],

                ],

                "col"           => "col-md-3 col-sm-4 col-xs-6",
                "search"        => [
                    "field"  => [
                        "nama_barang",
                        "nama_varian",
                        "barcode",
                        "barcode_varian",
                        "",
                    ],
                    "header" => [
                        "key"    => "PRODUK-HEADER",
                        "method" => "append",
                        "data"   => [

                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                            ["type" => "select", "name" => "Kategori Toko", "db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                        ],
                    ],
                    // "sidebar" => [
                    //     "key" => "PRODUK-SIDEBAR",
                    //     "data" => [
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "range", "name"=>"Harga", "option_literasi" => "100000", "option_akhir" => "500000", "key_search" => "harga_awal"], // tipe, nama_db
                    //     ]
                    // ]
                ],
                "array"         => [
                    "ID"          => ["data", "id"],
                    "NAMA-PRODUK" => ["data", "nama_barang"],
                    "ID-ASSET"    => ["data", "id_asset"],
                    "ID-PRODUK"   => ["data", "id_produk"],
                    "HARGA-FULL"  => ["data", "harga_full"],
                    "DESC"        => ["data", "deskripsi_barang"],
                    "TUMB"        => ["data", "foto_aset"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "HARGA-AKHIR" => ["data", "harga_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "IMG-LIST-ASHION" => [
                    //     "list",
                    //     "foto_utama",
                    //     "source_list" => "template",
                    //     "content_source" => "template",
                    //     "template_name" => "ashion",
                    //     "template_file" => "img_list.template",
                    //     'array' => array(
                    //         'SRC' => array(
                    //             "refer" => "img_in_database",
                    //         ),
                    //         'ACTIVE' => array(
                    //             "refer" => "if_first",
                    //             "text" => "active",
                    //         ),
                    //         'ID-PRODUK' => array(
                    //             "refer" => "database",
                    //             "row" => "id_produk",
                    //         ),

                    //     ),
                    // ],
                    "VARIAN"      => [
                        "looping",
                        "list_varian",
                        "content_source" => "template",
                        "template_name"  => "beegrit",
                        "looping"        => ["tipe_1", "tipe_2", "tipe_3"],
                        "looping_array"  => "NAMA-TIPE",
                        "template_file"  => "ecommerce/varian.template",
                        'array'          => [

                            'LIST' => [
                                "list",
                                "list_varian_detail",
                                "template_name" => "beegrit",
                                "template_file" => "ecommerce/varian_else.template",
                                "array"         => [
                                    "VALUE"          => ["data_tree", "id_varian", "tree_var" => ".list_varian"],
                                    "LEVEL"          => ["data_tree", "level"],
                                    "ID-ASSET"       => ["data", "id_asset"],
                                    "ID-PRODUK"      => ["data", "id_store_produk"],
                                    "ID-VARIAN-LIST" => ["data_tree", "id_varian"],
                                    "NAMA-VARIAN"    => ["data_tree", "nama_varian"],

                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $template[$set_type]['array'][] = ["VARIABEL", 'text', 'data_produk'];
        }
        $set_type = "portfolio_webpage_example_pendidikan";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::codepen_portfolio_webpage_example_timeline($page);

            $template[$set_type]['array'][] = ["SECTION-TITLE", 'text', 'Education'];
            $template[$set_type]['array'][] = ["TIMELINE-ITEM", 'codepen', 'portfolio_webpage_example_pendidikan_item'];
        }
        $set_type = "portfolio_webpage_example_pendidikan_item";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']     = Bundlecontent::codepen_portfolio_webpage_example_timeline_item($page);
            $template[$set_type]['is_database'] = true;
            $template[$set_type]['database']    = Pages::Apps("User", "riwayat_pendidikan", $page)['database'];
            // $template[$set_type]['database']['utama'] = "apps_user";

            $template[$set_type]['array'][] = ["ITEM-TITLE", 'text', 'nama_lengkap'];
            // $template[$set_type]['array'][] = ["ITEM-SUBTITLE", 'database', 'nama_lengkap'];
            // $template[$set_type]['array'][] = ["ITEM-DESKRIPSI", 'database', 'nama_lengkap'];
        }
        $set_type = "portfolio_webpage_example";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::codepen_portfolio_webpage_example($page);
            $template[$set_type]['array'][] = ["NAMA-LENGKAP", 'user_info', 'nama_lengkap'];
            $template[$set_type]['array'][] = ["DESKRIPSI-DIRI", 'user_info', 'nama_lengkap'];
            $template[$set_type]['array'][] = ["TITLE-JOB", 'text', 'User'];
            $template[$set_type]['array'][] = ["IMG-PROFIL", 'text', 'User'];
            // $template[$set_type]['array'][] = ["SERVICE-LIST", 'codepen', 'portfolio_webpage_example_service'];
            $template[$set_type]['array'][] = ["PENDIDIKAN", 'codepen', 'portfolio_webpage_example_pendidikan'];
            // $template[$set_type]['array'][] = ["PEKERJAAN", 'codepen', 'portfolio_webpage_example_pekerjaan'];
            $template[$set_type]['array'][] = ["EDIT-PROFIL-BASIC", 'crud', 'edit', "class" => "User", "function" => "utama", "id" => "ID_APPS_USER|"];
        }
        $set_type = "header";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::_header($page);

            $template[$set_type]["array"][] = ["", "", ""];
        }

        $set_type = "swipper > slide";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::_swipper__slide($page);

            $template[$set_type]["array"][] = ["", "", ""];
        }

        $set_type = "swipper";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::_swipper($page);

            $template[$set_type]["array"][] = ["SLIDE-IMAGE", "", ""];
        }
        // $set_type = "bookmark-appview-transition/card_apps.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_bookmark_appview_transition_card_apps_template($page);
        // }

        // $set_type = "bookmark-appview-transition/card_apps_avatar.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_bookmark_appview_transition_card_apps_avatar_template($page);
        // }

        // $set_type = "bookmark-appview-transition/card_apps_header_nav.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_bookmark_appview_transition_card_apps_header_nav_template($page);
        // }

        // $set_type = "bookmark-appview-transition/card_apps_sidebar.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_bookmark_appview_transition_card_apps_sidebar_template($page);
        // }

        // $set_type = "comparision/comparision.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_comparision_comparision_template($page);
        // }

        // $set_type = "countup.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_countup_template($page);
        // }

        // $set_type = "learderboard/leaderboard.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_learderboard_leaderboard_template($page);
        // }

        // $set_type = "swipper/swipper.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::codepen_swipper_swipper_template($page);
        // }
        return $template;
    }
    public static function ashion($page, $type = -1)
    {
        $template = [];
        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_card_main_listing($page);
        }
        $set_type = "BE3-ECOMMERCE-LIST-PRODUCT-VERTICAL";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_card_vertical($page);
        }
        $set_type = "ViewVertical";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_card_vertical($page);
        }
        $set_type = "BE3-ECOMMERCE-CART";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_cart($page);
        }
        $set_type = "BE3-ECOMMERCE-CART-PRODUK";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_cart_produk($page);
        }
        $set_type = "BE3-ECOMMERCE-CHECKOUT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_checkout($page);
        }

        $set_type = "Ashion > navbar";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___navbar($page);

            $template[$set_type]["array"][] = ["HEADER-LOGO", "", ""];
            $template[$set_type]["array"][] = ["HEADER-LIST", "Ashion", "Ashion > Header List "];
            $template[$set_type]["array"][] = ["MENU-LIST", "", ""];
        }
        $set_type = "Ashion > Header List ";
        if ($type == -1 or $type == $set_type) {
            // $template[$set_type]["content"] = Bundlecontent::ashion___navbar($page);

            $template[$set_type]['dropdown'][1]["array"] = ["ashion", "Ashion > Navbar > Cart"];
            $template[$set_type]['dropdown'][2]["array"] = ["ashion", "Ashin > Navbar > Wishlist"];
            $template[$set_type]['dropdown'][3]["array"] = ["ashion", "Ashion > Button Search"];
        }

        $set_type = "Ashion > Navbar > Cart";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___navbar__cart($page);

            $template[$set_type]["array"][] = ["BANNER-UTAMA", "", ""];
            $template[$set_type]["array"][] = ["BANNER-LIST", "", ""];
        }
        $set_type = "Ashion > Banner";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___banner($page);

            $template[$set_type]["array"][] = ["BANNER-UTAMA", "", ""];
            $template[$set_type]["array"][] = ["BANNER-LIST", "", ""];
        }

        $set_type = "Ashion > Banner > List";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___banner___list($page);

            $template[$set_type]["array"][] = ["IMAGE", "", ""];
            $template[$set_type]["array"][] = ["HEADER-IMAGE", "", ""];
            $template[$set_type]["array"][] = ["DESKRIPSI-IMAGE", "", ""];
            $template[$set_type]["array"][] = ["LINK-KE", "", ""];
            $template[$set_type]["array"][] = ["DESKRIPSI-LINK-KE", "", ""];
        }

        $set_type = "Ashion > Header Logo";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___header_logo($page);

            $template[$set_type]["array"][] = ["IMAGE-LOGO", "", ""];
            $template[$set_type]["array"][] = ["BASE-URL", "", ""];
        }

        $set_type = "Asion > Icon Cart";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_asion___icon_cart($page);

            $template[$set_type]["array"][] = ["LINK-CART", "", ""];
            $template[$set_type]["array"][] = ["COUNT-CART", "", ""];
        }

        $set_type = "ASHION>CHECKOUT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_checkout($page);
        }

        $set_type = "Ashion > Button Search";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___button_search($page);
        }

        $set_type = "Ashion > Banner > Utama";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___banner___utama($page);

            $template[$set_type]["array"][] = ["", "", ""];
        }

        $set_type = "ASION > List Ecommerce";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_asion___list_ecommerce($page);
        }

        $set_type = "AShion > Card Vertical";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___card_vertical($page);

            $template[$set_type]["array"][] = ["CARD-LINK", "", ""];
            $template[$set_type]["array"][] = ["CARD-IMG", "", ""];
            $template[$set_type]["array"][] = ["LABEL", "", ""];
            $template[$set_type]["array"][] = ["CARD-DESKRIPSI", "", ""];
            $template[$set_type]["array"][] = ["CARD-FOOTER-BOTTOM", "", ""];
            $template[$set_type]["array"][] = ["CARD-FOOTER-BOTTOMWITHAVATAR", "", ""];
        }

        $set_type = "Ashion Produk IMG";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_produk_img($page);

            $template[$set_type]["array"][] = ["IMG-SRC", "", ""];
        }

        $set_type = "Ashion > Icon Wishlist";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___icon_wishlist($page);

            $template[$set_type]["array"][] = ["COUNT-WISHLIST", "", ""];
            $template[$set_type]["array"][] = ["LINK-WISHLIST", "", ""];
        }

        $set_type = "Ashion > Cart Produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___cart_produk($page);

            $template[$set_type]["array"][] = ["ID-CART", "", ""];
            $template[$set_type]["array"][] = ["CHECKED", "", ""];
            $template[$set_type]["array"][] = ["IMAGE-CART", "", ""];
            $template[$set_type]["array"][] = ["IS_VARIAN", "", ""];
            $template[$set_type]["array"][] = ["VARIAN", "", ""];
            $template[$set_type]["array"][] = ["QTY", "", ""];
            $template[$set_type]["array"][] = ["HARGA", "", ""];
            $template[$set_type]["array"][] = ["MAX_VARIAN", "", ""];
        }

        $set_type = "ASHION > CART";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___cart($page);
        }

        $set_type = "Ashion Detail Ecommerce";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_detail_ecommerce($page);

            $template[$set_type]["array"][] = ["ID-ASSET", "", ""];
            $template[$set_type]["array"][] = ["ID-PRODUK", "", ""];
            $template[$set_type]["array"][] = ["DESKRIPSI", "", ""];
            $template[$set_type]["array"][] = ["SPESIFIKASI", "", ""];
            $template[$set_type]["array"][] = ["HARGA-AWAL", "", ""];
            $template[$set_type]["array"][] = ["VARIAN", "", ""];
            $template[$set_type]["array"][] = ["HARGA-AKHIR", "", ""];
            $template[$set_type]["array"][] = ["DISKON", "", ""];
        }

        $set_type = "AShion > Navbar > Menu List";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___navbar___menu_list($page);

            $template[$set_type]["array"][] = ["CLASS-ACTIVE", "", ""];
            $template[$set_type]["array"][] = ["LINK", "", ""];
            $template[$set_type]["array"][] = ["DROPDOWN", "", ""];
        }

        $set_type = "Ashion > Navbar > Button List";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion___navbar___button_list($page);

            $template[$set_type]["array"][] = ["LINK-LOGIN", "", ""];
            $template[$set_type]["array"][] = ["LINK-REGISTER", "", ""];
        }

        return $template;
    }
    public static function fai($page, $type = -1)
    {
        $template = [];
        $set_type = "fai_first_template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::fai_first_template($page);

        }
        return $template;
    }
    public static function hibe3($page, $type = -1)
    {
        $template = [];
        $set_type = "moesneeds_home_banner";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::swipper_slider_centered($page);
            $template[$set_type]["array"][] = ["LIST-IMAGE", "hibe3", "moesneeds_home_banner-list_image"];
        }
        $set_type = "moesneeds_home_banner-list_image";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::swipper_slider_centered_list_image($page);
            $template[$set_type]["array"][] = ["IMG", "database", "file_content"];
            $template[$set_type]["array"][] = ["BASE-URL", "bundle", "base_url_non_index_upload"];
            $bannerMoesneeds['live']        = 2;
            $bannerMoesneeds['select'][]    = 'website__bundles__master__banner__content.*,concat(utama_file.path,utama_file.file_name_save) as file_content';

            $bannerMoesneeds['limit']        = '1';
            $bannerMoesneeds['utama']        = 'website__bundles__master__banner__content';
            $bannerMoesneeds['where'][]      = ['id_website__bundles__master__banner', ' = ', "26"];
            $bannerMoesneeds['where'][]      = ['website__bundles__master__banner__content.active', ' = ', "1"];
            $bannerMoesneeds['primary_key']  = null;
            $bannerMoesneeds['join'][]       = ["drive__file utama_file", " (utama_file.id)", " (website__bundles__master__banner__content.file)", "left"];
            $template[$set_type]['database'] = $bannerMoesneeds;
        }
        $set_type = "base";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_base($page);
            $template[$set_type]["array"][] = ["NAVBAR", "menu_content", "hibe3_menu", "navbar"];
        }
        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_card_main_listing($page);
        }
        $set_type = "landing_mitra";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_landing_mitra($page);

            $template[$set_type]["array"][] = ["DISPLAY", "database", "display_belum"];
            $template[$set_type]["array"][] = ["DISPLAY-RESMI", "database", "display_resmi"];
            $template[$set_type]["array"][] = ["DISPLAY-PENDING", "database", "display_pending"];
            $template[$set_type]["array"][] = ["DISPLAY-BELUM-BAYAR", "database", "display_bayar"];
            $template[$set_type]["array"][] = ["ID_GROUP", "database", "id_group"];
            $template[$set_type]["array"][] = ["PERSEN", "database", "persen"];
            $landing_mitra['live']          = 1;
            $landing_mitra['query']         = "SELECT
CASE when (select count(*) as count from crm__mitra_penjualan where id_apps_user  = '{SESSION_UTAMA}' and id_store_from=4) = 0 then 'block'
else 'none' end
as display_belum,

CASE
when (select count(*) as count from crm__mitra_penjualan where id_apps_user  = '{SESSION_UTAMA}' and id_store_from=WORKSPACE_SINGLE_TOKO| and status_mitra=3)= 0 then 'none'
else 'block' end
as display_resmi,

CASE
when (select count(*) as count from crm__mitra_penjualan where id_apps_user  = '{SESSION_UTAMA}' and id_store_from=WORKSPACE_SINGLE_TOKO| and status_mitra=2)= 0 then 'none'
else 'block' end
as display_pending,

CASE
when (select count(*) as count from crm__mitra_penjualan where id_apps_user  = '{SESSION_UTAMA}' and id_store_from=WORKSPACE_SINGLE_TOKO| and status_mitra=1)= 0 then 'none'
else 'block' end
as display_bayar
,CASE
when (select count(*) as count from crm__mitra_penjualan where id_apps_user  = '{SESSION_UTAMA}' and id_store_from=WORKSPACE_SINGLE_TOKO|)= 0 then 0
else (select crm__mitra_penjualan.id_erp__pos__group from crm__mitra_penjualan left join erp__pos__payment on id_payment = erp__pos__payment.id where crm__mitra_penjualan.id_apps_user  = '{SESSION_UTAMA}' and id_store_from=WORKSPACE_SINGLE_TOKO| limit 1) end
as id_group";
            $template[$set_type]['database'] = $landing_mitra;
        }
        $set_type = "kontak_kami";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_kontak_kami($page);
            $template[$set_type]["array"][] = ["ALAMAT", "row_web_apps", "alamat"];
            $template[$set_type]["array"][] = ["EMAIL", "row_web_apps", "email"];
            $template[$set_type]["array"][] = ["NO-TELP", "row_web_apps", "nomor_send_wa"];
        }
        $set_type = "profil";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"]  = Bundlecontent::hibe3_profil($page);
            $template[$set_type]["array"][]  = ["NAMA-LENGKAP", "database", "nama_lengkap"];
            $template[$set_type]["array"][]  = ["EMAIL", "database", "email"];
            $template[$set_type]["array"][]  = ["NO-HP", "database", "nomor_handphone"];
            $template[$set_type]["array"][]  = ["LIST-BANGUNAN", "hibe3", "list_bangunan"];
            $profil['utama']                 = "apps_user";
            $profil['where'][]               = ["id_apps_user", "=", "{SESSION_UTAMA}"];
            $template[$set_type]['database'] = $profil;
        }
        $set_type = "profil_bangunan";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_profil_bangunan($page);
            $template[$set_type]["array"]   = [
                ["NAMA-UNIT", "database", "nama_unit_bangunan"],
                ["ALAMAT", "database", "alamat"],
                ["RT", "database", "rt"],
                ["RW", "database", "rw"],
                ["KECAMATAN", "database", "subdistrict_name"],
                ["KOTA", "database", "kota_name"],
                ["KOTA-TYPE", "database", "type"],
                ["KELURAHAN", "database", "urban"],
                ["NOMOR", "database", "nomor_bangunan"],
                ["KODE-POS", "database", "postal_code"],
                ["PROVINSI", "database", "provinsi"],
                ["NO-HP", "database", "nomor_handphone"],
            ];
            $BANGUNAN['utama']       = 'inventaris__asset__tanah__bangunan__pengisi';
            $BANGUNAN['primary_key'] = null;
            $BANGUNAN['as']          = 't';
            $BANGUNAN['np']          = true;
            $BANGUNAN['select'][]    = 'inventaris__asset__tanah__bangunan.*,
		webmaster__wilayah__provinsi.provinsi,webmaster__wilayah__kabupaten.type,webmaster__wilayah__kabupaten.kota_name,webmaster__wilayah__kecamatan.subdistrict_name,webmaster__wilayah__postal_code.urban,postal_code';
            $BANGUNAN['select'][] = 'erp__pos__group.id as id_erp__pos__group';
            $BANGUNAN['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key2';

            $BANGUNAN['join'][]  = ["erp__pos__group", "erp__pos__group.id_apps_user", "inventaris__asset__tanah__bangunan__pengisi.id_apps_user", 'left'];
            $BANGUNAN['join'][]  = ["inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan"];
            $BANGUNAN['join'][]  = ["webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi"];
            $BANGUNAN['join'][]  = ["webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota"];
            $BANGUNAN['join'][]  = ["webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan"];
            $BANGUNAN['join'][]  = ["webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan"];
            $BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan__pengisi.id_apps_user", "=", "'{SESSION_UTAMA}'"];
            $BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan.id_kota", " is ", " not null"];

            $template[$set_type]['database'] = $BANGUNAN;

        }

        $set_type = "pesanan_saya";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_pesanan_saya($page);
            $template[$set_type]["array"][] = ["LIST-PESANAN", "hibe3", "pesanan_saya_list"];

        }$set_type = "pesanan_saya_list";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"]  = Bundlecontent::hibe3_pesanan_saya_list($page);
            $template[$set_type]["array"][]  = ["NAMA_TOKO", "database", "nama_toko"];
            $template[$set_type]["array"][]  = ["TANGGAL-PO", "database", "tanggal_po"];
            $template[$set_type]["array"][]  = ["NO-PO", "database", "no_purchose_order"];
            $template[$set_type]["array"][]  = ["LIST-PRODUK", "hibe3", "pesanan_saya_list_produk"];
            $template[$set_type]["array"][]  = ["QTY", "database", "total_qty"];
            $template[$set_type]["array"][]  = ["TOTAL", "database", "total"];
            $template[$set_type]["array"][]  = ["ID", "database", "id"];
            $pesanan_saya_list['select'][]   = "erp__pos__utama.*,nama_toko";
            $pesanan_saya_list['utama']      = "erp__pos__utama";
            $pesanan_saya_list['join'][]     = ["store__toko", "store__toko.id", "id_toko"];
            $pesanan_saya_list['where'][]    = ["erp__pos__utama.id_apps_user", '=', "'{SESSION_UTAMA}'"];
            $pesanan_saya_list['order'][]    = ["tanggal_po", 'desc'];
            $template[$set_type]['database'] = $pesanan_saya_list;

        }$set_type = "pesanan_saya_list_produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"]     = Bundlecontent::hibe3_pesanan_saya_list_produk($page);
            $template[$set_type]["array"][]     = ["NAMA-PRODUK", "database", "nama_barang"];
            $template[$set_type]["array"][]     = ["NAMA-VARIAN", "database", "nama_varian"];
            $template[$set_type]["array"][]     = ["IMG", "database", "foto_aset_varian"];
            $template[$set_type]["array"][]     = ["QTY", "database", "qty"];
            $pesanan_saya_list_produk['limit']  = 10;
            $pesanan_saya_list_produk['utama']  = "erp__pos__utama__detail";
            $pesanan_saya_list_produk['join'][] = ["store__produk", "store__produk.id", "id_produk"];
            $pesanan_saya_list_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", "id_asset"];
            $pesanan_saya_list_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian"];

            $pesanan_saya_list_produk["where_get_array"][] =
                [
                "row"       => "id_erp__pos__utama",
                "array_row" => "database",
                "get_row"   => "primary_key",
            ];
            $template[$set_type]['database'] = $pesanan_saya_list_produk;

        }
        $set_type = "pesanan_saya_detail";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_pesanan_saya_detail($page);

            $template[$set_type]["array"][]  = ["QTY", "database", "total_qty"];
            $template[$set_type]["array"][]  = ["SUBTOTAL", "database", "sub_total"];
            $template[$set_type]["array"][]  = ["DISKON", "database", "total_diskon"];
            $template[$set_type]["array"][]  = ["ONGKIR", "database", "biaya_pengiriman"];
            $template[$set_type]["array"][]  = ["TOTAL", "database", "total"];
            $template[$set_type]["array"][]  = ["QTY", "database", "total_qty"];
            $template[$set_type]["array"][]  = ["NAMA_TOKO", "database", "nama_toko"];
            $template[$set_type]["array"][]  = ["TANGGAL-PO", "database", "tanggal_po"];
            $template[$set_type]["array"][]  = ["NOMOR-PO", "database", "no_purchose_order"];
            $template[$set_type]["array"][]  = ["NAMA-PENERIMA", "database", "nama_lengkap"];
            $template[$set_type]["array"][]  = ["NO-PENERIMA", "database", "nomor_handphone"];
            $template[$set_type]["array"][]  = ["ALAMAT-PENERIMA", "database", "alamat_tujuan"];
            $template[$set_type]["array"][]  = ["JASA-KIRIM", "database", "nama_ekspedisi"];
            $template[$set_type]["array"][]  = ["SERVICE", "database", "nama_service"];
            $template[$set_type]["array"][]  = ["METHODE-BAYAR", "database", "nama_payment"];
            $template[$set_type]["array"][]  = ["BRAND-BAYAR", "database", "nama_brand"];
            $template[$set_type]["array"][]  = ["LIST_PRODUK", "hibe3", "pesanan_saya_list_produk"];
            $pesanan_saya_detail['utama']    = "erp__pos__utama";
            $pesanan_saya_detail['join'][]   = ["store__toko", "store__toko.id", "id_toko"];
            $pesanan_saya_detail['join'][]   = ["apps_user", "apps_user.id_apps_user", "erp__pos__utama.id_apps_user", 'left'];
            $pesanan_saya_detail['join'][]   = ["erp__pos__delivery_order", "erp__pos__utama.id", "erp__pos__delivery_order.id_erp__pos__utama", 'left'];
            $pesanan_saya_detail['join'][]   = ["webmaster__payment_method", "webmaster__payment_method.id", "erp__pos__utama.id_payment_method", 'left'];
            $pesanan_saya_detail['join'][]   = ["webmaster__payment_method_brand", "webmaster__payment_method_brand.id", "erp__pos__utama.id_payment_brand", 'left'];
            $pesanan_saya_detail['join'][]   = ["webmaster__ekspedisi", "webmaster__ekspedisi.id", "erp__pos__delivery_order.id_ekpedisi", 'left'];
            $pesanan_saya_detail['join'][]   = ["webmaster__ekspedisi__service", "webmaster__ekspedisi__service.id", "erp__pos__delivery_order.id_service", 'left'];
            $pesanan_saya_detail['where'][]  = ["erp__pos__utama.id", '=', "LOAD_ID|"];
            $pesanan_saya_detail['order'][]  = ["tanggal_po", 'desc'];
            $template[$set_type]['database'] = $pesanan_saya_detail;
        }
        $set_type = "pesanan_saya_detail_produk";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"]       = Bundlecontent::hibe3_pesanan_saya_detail_produk($page);
            $template[$set_type]["array"][]       = ["NAMA-PRODUK", "database", "nama_barang"];
            $template[$set_type]["array"][]       = ["NAMA-VARIAN", "database", "nama_barang"];
            $template[$set_type]["array"][]       = ["IMG", "database", "foto_aset_varian"];
            $template[$set_type]["array"][]       = ["QTY", "database", "qty"];
            $template[$set_type]["array"][]       = ["HARGA", "database", "harga_penjualan"];
            $template[$set_type]["array"][]       = ["SUBTOTAL", "database", "total_harga"];
            $pesanan_saya_detail_produk['utama']  = "erp__pos__utama__detail";
            $pesanan_saya_detail_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", "id_asset"];
            $pesanan_saya_detail_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_varian"];

            $pesanan_saya_detail_produk["where_get_array"][] =
                [
                "row"       => "id_erp__pos__utama",
                "array_row" => "database",
                "get_row"   => "primary_key",
            ];
            $template[$set_type]['database'] = $pesanan_saya_detail_produk;

        }
        $set_type = "mitra_berhasil";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_mitra_berhasil($page);
        }
        $set_type = "payment-page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_payment_page($page);
            $template[$set_type]["array"][] = ["LIST-PAYMENT", "hibe3", "payment-page-pembayaran"];
            $template[$set_type]["array"][] = ["GRAND-SUBTOTAL", "database", "total"];
            $erpGroup['live']               = 2;
            $erpGroup['select'][]           = 'erp__pos__group.*';

            $erpGroup['limit']               = '1';
            $erpGroup['utama']               = 'erp__pos__group';
            $erpGroup['where'][]             = ['erp__pos__group.id', ' = ', "{LOAD_ID}"];
            $erpGroup['primary_key']         = null;
            $template[$set_type]['database'] = $erpGroup;
        }
        $set_type = "payment-page-pembayaran";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_payment_page_pembayaran($page);
            $PAYMENT['live']                = 2;
            $PAYMENT['select'][]            = 'webmaster__payment_method.*';
            $PAYMENT['select'][]            = 'webmaster__payment_method.id as primary_key';
            $PAYMENT['select'][]            = '(SELECT erp__pos__group.id_payment_method from erp__pos__payment
		left join erp__pos__payment__bayar on erp__pos__payment__bayar.id_erp__pos__payment =erp__pos__payment.id
		left join erp__pos__group on erp__pos__group.id_payment =erp__pos__payment.id
		where erp__pos__group.id={LOAD_ID} limit 1) as id_payment_method';
            $PAYMENT['utama']   = 'webmaster__payment_method';
            $PAYMENT['where'][] = ['webmaster__payment_method.id', ' in ', "
		        (SELECT distinct(id_payment_method) as id_payment_method from webmaster__payment_webapps WHERE id_webapps = id_web__apps| and id_workspace = ID_BOARD|)", ];
            $PAYMENT['primary_key']          = null;
            $template[$set_type]['database'] = $PAYMENT;
            $template[$set_type]['array'][]  = ["NAMA-JENIS-PEMBAYARAN", 'database', 'nama_payment'];
            $template[$set_type]['array'][]  = ["LIST-BRAND", 'hibe3', 'payment-page-pembayaran-brand'];
        }
        $set_type = "payment-page-pembayaran-brand";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_payment_page_pembayaran_brand($page);
            $database                       = [
                "utama"           => "webmaster__payment_method_brand",
                "live"            => 2,
                "select"          => [
                    "*",

                    "concat(coalesce(webmaster__payment_method_brand.id,''),'-',coalesce(webmaster__payment_webapps.id,''),'-',coalesce(webmaster__payment_webapps.penanggung_biaya,''),'-',coalesce(biaya_payment,''))  as id_primary_key",
                    "(select erp__pos__utama.id_payment_brand from  erp__pos__payment
									left join erp__pos__payment__bayar on erp__pos__payment__bayar.id_erp__pos__payment =erp__pos__payment.id
									left join erp__pos__utama on erp__pos__utama.id =erp__pos__payment.id_order
									where erp__pos__utama.id={LOAD_ID}) as id_payment_brand",
                    "concat('" . base_url() . "/FaiFramework/Pages/_template/assets/images_brands/',webmaster__payment_method_brand.logo_brand) as logo_brand",
                ],
                "join"            => [
                    [
                        "webmaster__payment_webapps",
                        " webmaster__payment_method_brand.id ",
                        "webmaster__payment_webapps.id_payment_brand and id_webapps = id_web__apps| and id_workspace = ID_BOARD|",
                    ],
                ],

                "where_get_array" => [
                    [
                        "row"       => "id_webmaster__payment_method",
                        "array_row" => "database",
                        "get_row"   => "id",
                    ],
                ],
            ];
            $template[$set_type]['database'] = $database;
            $template[$set_type]['array'][]  = ["NAMA-BRAND", 'database', 'nama_brand'];
            $template[$set_type]['array'][]  = ["ID", 'database', 'id_primary_key'];
            $template[$set_type]['array'][]  = ["BIAYA-PAYMENT", 'database', 'biaya_payment'];
            $template[$set_type]['array'][]  = ["LOGO-BRAND", 'database', 'logo_brand'];
        }

        // 	"CHECKED" => array(
        // 		"refer" => "if_database_to_text",
        // 		"source_database" => "database_list_template_on_list",
        // 		"row" => "primary_key",
        // 		"if_value" => array(
        // 			"row:id_payment_brand!database_list_template_on_list|" => 'checked',
        // 		),
        // 		"if_else" => ''
        // 	),
        // ),
        $set_type = "bayar-page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']  = Bundlecontent::hibe3_bayar_page($page);
            $template[$set_type]['array'][]  = ["LIST-BAYAR", 'hibe3', 'list_bayar-page'];
            $template[$set_type]['array'][]  = ["NOMOR-PO", 'database', 'nomor'];
            $erpPayment['live']              = 2;
            $erpPayment['select'][]          = 'erp__pos__payment.*';
            $erpPayment['select'][]          = 'erp__pos__group.nomor';
            $erpPayment['utama']             = 'erp__pos__payment';
            $erpPayment['join'][]            = ['erp__pos__group', 'id_erp__pos__group', "erp__pos__group.id"];
            $erpPayment['where'][]           = ['erp__pos__payment.id', ' = ', "{LOAD_ID}"];
            $erpPayment['primary_key']       = null;
            $template[$set_type]['database'] = $erpPayment;
        }
        $set_type = "list_bayar-page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_list_bayar_page($page);
            $template[$set_type]['array'][] = ["ID", 'database', 'id'];
            $template[$set_type]['array'][] = ["BANK", 'database', 'brand_nama'];
            $template[$set_type]['array'][] = ["NO-REK", 'database', 'no_rek'];
            $template[$set_type]['array'][] = ["ATAS-NAMA", 'database', 'an'];
            $template[$set_type]['array'][] = ["NONIMAL", 'database', 'jumlah_bayar'];
            $template[$set_type]['array'][] = ["VA_NUMBER", 'database', 'va_number'];
            $template[$set_type]['array'][] = ["DATE-NOW", 'bundle', 'date_now'];
            $template[$set_type]['array'][] = [
                "DISPLAY-VA",
                'if_database_to_text',
                "row"      => "kode_payment",
                "if_value" => [
                    "bank_transfer" => 'display:block',
                ],
                "if_else"  => 'display:none',
            ];
            $template[$set_type]['array'][] = [
                "DISPLAY-MANUAL",
                'if_database_to_text',
                "row"      => "kode_payment",
                "if_value" => [
                    "manual_bank_transfer" => 'display:block',
                ],
                "if_else"  => 'display:none',
            ];
            $template[$set_type]['array'][] = [
                "DISPLAY-QRIS",
                'if_database_to_text',
                "row"      => "kode_payment",
                "if_value" => [
                    "qris" => 'display:block',
                ],
                "if_else"  => 'display:none',
            ];
            $erpPaymentBayar['live']     = 2;
            $erpPaymentBayar['select'][] = 'erp__pos__payment__bayar.*';
            $erpPaymentBayar['select'][] = 'webmaster__payment_method.kode_payment';

            $erpPaymentBayar['utama']  = 'erp__pos__payment__bayar';
            $erpPaymentBayar['join'][] = ['webmaster__payment_method', 'id_metode_bayar', "webmaster__payment_method.id"];
            // $erpGroup['join'][] = ['erp__pos__payment','erp__pos__payment__bayar.id_erp__pos__payment',"erp__pos__payment.id"];
            $erpPaymentBayar['where'][]      = ['erp__pos__payment__bayar.id_erp__pos__payment', ' = ', "{LOAD_ID}"];
            $erpPaymentBayar['primary_key']  = null;
            $template[$set_type]['database'] = $erpPaymentBayar;
        }

        $set_type = "sukses_bayar-page";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3_sukses_bayar_page($page);
            $template[$set_type]['array'][] = [
                "DIPLAY-NON-MANUAL",
                'if_database_to_text',
                "row"      => "kode_payment",
                "if_value" => [
                    "manual_bank_transfer" => 'display:none',
                ],
                "if_else"  => 'display:none',
            ];
            $template[$set_type]['array'][] = [
                "DISPLAY-MANUAL",
                'if_database_to_text',
                "row"      => "kode_payment",
                "if_value" => [
                    "manual_bank_transfer" => 'display:block',
                ],
                "if_else"  => 'display:none',
            ];
            $erpPayment2['live'] = 2;

            $erpPayment2['select'][]         = 'erp__pos__payment.*';
            $erpPayment2['select'][]         = 'webmaster__payment_method.kode_payment';
            $erpPayment2['utama']            = 'erp__pos__payment';
            $erpPayment2['join'][]           = ['webmaster__payment_method_brand', 'id_payment_brand', "webmaster__payment_method_brand.id"];
            $erpPayment2['join'][]           = ['webmaster__payment_method', 'id_webmaster__payment_method', "webmaster__payment_method.id"];
            $erpPayment2['where'][]          = ['erp__pos__payment.id', ' = ', "{LOAD_ID}"];
            $erpPayment2['primary_key']      = null;
            $template[$set_type]['database'] = $erpPayment2;
        }
        $set_type = "BE3-ECOMMERCE-LIST-PRODUCT-VERTICAL";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::default_card_vertical($page);
        }

        $set_type = "ViewVertical";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::default_card_vertical($page);
        }
        $set_type = "Card/_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::hibe3__CardMainListingMenu($page);
        }
        $set_type = "BE3-ECOMMERCE-CART";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_cart($page);
        }
        $set_type = "BE3-ECOMMERCE-CART-PRODUK";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_cart_produk($page);
        }
        $set_type = "BE3-ECOMMERCE-CHECKOUT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_checkout($page);
        }
        $set_type = "hibe3 > NavbarButtonSearch";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___navbarbuttonsearch($page);
        }

        $set_type = "Hibe3 > HeaderList ";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___headerlist($page);

            $template[$set_type]["array"][] = ["LINK", "", ""];
            $template[$set_type]["array"][] = ["ICON", "", ""];
            $template[$set_type]["array"][] = ["NAME", "", ""];
        }

        $set_type = "Hibe3 > NavbarPage";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___navbarpage($page);

            $template[$set_type]["array"][] = ["NAVBAR-LIST", "", ""];
            $template[$set_type]["array"][] = ["NAVBAR-SEARCH", "", ""];
            $template[$set_type]["array"][] = ["NAVBAR-LOGO", "", ""];
            $template[$set_type]["array"][] = ["NAVBAR-TOGGLE", "", ""];
        }

        $set_type = "Hibe3 > HeaderPage";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___headerpage($page);

            $template[$set_type]["array"][] = ["HEADER-UTAMA", "", ""];
            $template[$set_type]["array"][] = ["LINK-CART", "", ""];
        }

        $set_type = "hibe3 > NavbarListProfile";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___navbarlistprofile($page);

            $template[$set_type]["array"][] = ["NAMA-LENGKAP", "", ""];
            $template[$set_type]["array"][] = ["LINK-PROFIL-USER", "", ""];
            $template[$set_type]["array"][] = ["LINK-PEMESANAN", "", ""];
            $template[$set_type]["array"][] = ["LINK-LOGOUT", "", ""];
        }

        $set_type = "hibe3 > NavbarNotification";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3___navbarnotification($page);
        }
        $set_type = "Card/_CardFilter.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardfilter_template($page);
        }

        $set_type = "Card/_CardListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardlistingmenu_template($page);
        }

        $set_type = "Card/_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardmainlistingmenu_template($page);
        }

        $set_type = "Card/_CardMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardmenu_template($page);
        }

        $set_type = "Card/_CardMenuScreenA.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardmenuscreena_template($page);
        }

        $set_type = "Card/_CardMenuScreenB.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardmenuscreenb_template($page);
        }

        $set_type = "Card/_CardProfileMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardprofilemenu_template($page);
        }

        $set_type = "Card/_CardUlLiNav.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardullinav_template($page);
        }

        $set_type = "Card/_CardUlNav.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_card__cardulnav_template($page);
        }

        $set_type = "Chat.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_chat_template($page);
        }

        $set_type = "HeaderList.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_headerlist_template($page);
        }

        $set_type = "HeaderListLeft.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_headerlistleft_template($page);
        }

        $set_type = "NavbarButtonSearch.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarbuttonsearch_template($page);
        }

        $set_type = "NavbarListProfile.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarlistprofile_template($page);
        }

        $set_type = "NavbarLogo.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarlogo_template($page);
        }

        $set_type = "NavbarNotification.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarnotification_template($page);
        }

        $set_type = "NavbarSearch.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarsearch_template($page);
        }

        $set_type = "NavbarSearchResult.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbarsearchresult_template($page);
        }

        $set_type = "NavbarToggle.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_navbartoggle_template($page);
        }

        $set_type = "SidebarInProfileBox.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_sidebarinprofilebox_template($page);
        }

        $set_type = "SidebarList.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_sidebarlist_template($page);
        }

        $set_type = "SidebarListBottom.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_sidebarlistbottom_template($page);
        }

        $set_type = "blockbanner.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_blockbanner_template($page);
        }

        $set_type = "blockbanner_button.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_blockbanner_button_template($page);
        }

        $set_type = "checkboxgroup.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_checkboxgroup_template($page);
        }

        $set_type = "checkboxgroup_checkbox.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_checkboxgroup_checkbox_template($page);
        }

        $set_type = "checkboxgroup_group.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_checkboxgroup_group_template($page);
        }

        $set_type = "swipper.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::hibe3_swipper_template($page);
        }
        $set_type = "ecommerce-terbaru";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::job_search_plaform_ui($page);
            $template[$set_type]['array'][] = [
                "LIST-PRODUK",
                'produk',
                'new',
                "func_content"  => "codepen",
                'content'       => "job-search-platform-ui-produk",
                "func"          => "data_produk",
                "variable"      => "data_terbaru",
                "refer"         => "database_func",
                "judul",
                "include_in_id" => [

                    "class" => "job-cards",
                    "after" => "</div>",
                ],
                "refer_db"      => "all_produk",
                "pagination"    => [
                    "page"     => "none",
                    "limit"    => 10,
                    "order_by" => ["create_date", "desc"],
                ],
                "col"           => "col-md-4 col-sm-4 col-xs-6",
                "search"        => [
                    "non_search" => true,
                    "field"      => [
                        "nama_barang",
                        "nama_varian",
                        "barcode",
                        "barcode_varian",
                        "",
                    ],
                    "header"     => [
                        "key"    => "PRODUK-HEADER",
                        "method" => "append",
                        "data"   => [

                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                            ["type" => "select", "name" => "Kategori Toko", "db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                        ],
                    ],
                    // "sidebar" => [
                    //     "key" => "PRODUK-SIDEBAR",
                    //     "data" => [
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "range", "name"=>"Harga", "option_literasi" => "100000", "option_akhir" => "500000", "key_search" => "harga_awal"], // tipe, nama_db
                    //     ]
                    // ]
                ],
                "array"         => [
                    "ID"            => ["data", "id"],
                    "NAMA-PRODUK"   => ["data", "nama_barang"],
                    "ID-ASSET"      => ["data", "id_asset"],
                    "ID-PRODUK"     => ["data", "id_produk"],
                    "HARGA-FULL"    => ["data", "harga_full"],
                    "DESC"          => ["data", "deskripsi_barang"],
                    "TUMB"          => ["data", "foto_aset"],

                    "TOTAL-TERJUAL" => ["data", "total_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "HARGA-AKHIR" => ["data", "harga_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "IMG-LIST-ASHION" => [
                    //     "list",
                    //     "foto_utama",
                    //     "source_list" => "template",
                    //     "content_source" => "template",
                    //     "template_name" => "ashion",
                    //     "template_file" => "img_list.template",
                    //     'array' => array(
                    //         'SRC' => array(
                    //             "refer" => "img_in_database",
                    //         ),
                    //         'ACTIVE' => array(
                    //             "refer" => "if_first",
                    //             "text" => "active",
                    //         ),
                    //         'ID-PRODUK' => array(
                    //             "refer" => "database",
                    //             "row" => "id_produk",
                    //         ),

                    //     ),
                    // ],
                    "VARIAN"        => [
                        "looping",
                        "list_varian",
                        "content_source" => "template",
                        "template_name"  => "beegrit",
                        "looping"        => ["tipe_1", "tipe_2", "tipe_3"],
                        "looping_array"  => "NAMA-TIPE",
                        "template_file"  => "ecommerce/varian.template",
                        'array'          => [

                            'LIST' => [
                                "list",
                                "list_varian_detail",
                                "template_name" => "beegrit",
                                "template_file" => "ecommerce/varian_else.template",
                                "array"         => [
                                    "VALUE"          => ["data_tree", "id_varian", "tree_var" => ".list_varian"],
                                    "LEVEL"          => ["data_tree", "level"],
                                    "ID-ASSET"       => ["data", "id_asset"],
                                    "ID-PRODUK"      => ["data", "id_store_produk"],
                                    "ID-VARIAN-LIST" => ["data_tree", "id_varian"],
                                    "NAMA-VARIAN"    => ["data_tree", "nama_varian"],

                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $template[$set_type]['array'][] = ["VARIABEL", 'text', 'data_terbaru'];
            $template[$set_type]['array'][] = ["TITLE", 'text', 'Produk Terbaru'];
        }
        $set_type = "ecommerce-terlaris";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::job_search_plaform_ui($page);
            $template[$set_type]['array'][] = [
                "LIST-PRODUK",
                'produk',
                'new',
                "func_content"  => "codepen",
                'content'       => "job-search-platform-ui-produk",
                "func"          => "data_produk",
                "variable"      => "data_terlaris",
                "refer"         => "database_func",
                "judul",
                "include_in_id" => [

                    "class" => "job-cards",
                    "after" => "</div>",
                ],
                "refer_db"      => "all_produk",
                "pagination"    => [
                    "page"     => "none",
                    "limit"    => 10,
                    "order_by" => ["total_jual", "desc"],
                ],
                "col"           => "col-md-3 col-sm-4 col-xs-6",
                "search"        => [
                    "non_search" => true,
                    "field"      => [
                        "nama_barang",
                        "nama_varian",
                        "barcode",
                        "barcode_varian",
                        "",
                    ],
                    "header"     => [
                        "key"    => "PRODUK-HEADER",
                        "method" => "append",
                        "data"   => [

                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                                                                                                                                                                                                                         // ["type" => "select", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                            ["type" => "select", "name" => "Kategori Toko", "db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                        ],
                    ],
                    // "sidebar" => [
                    //     "key" => "PRODUK-SIDEBAR",
                    //     "data" => [
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "range", "name"=>"Harga", "option_literasi" => "100000", "option_akhir" => "500000", "key_search" => "harga_awal"], // tipe, nama_db
                    //     ]
                    // ]
                ],
                "array"         => [
                    "ID"            => ["data", "id"],
                    "NAMA-PRODUK"   => ["data", "nama_barang"],
                    "ID-ASSET"      => ["data", "id_asset"],
                    "ID-PRODUK"     => ["data", "id_produk"],
                    "HARGA-FULL"    => ["data", "harga_full"],
                    "DESC"          => ["data", "deskripsi_barang"],
                    "TUMB"          => ["data", "foto_aset"],

                    "TOTAL-TERJUAL" => ["data", "total_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "HARGA-AKHIR" => ["data", "harga_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "IMG-LIST-ASHION" => [
                    //     "list",
                    //     "foto_utama",
                    //     "source_list" => "template",
                    //     "content_source" => "template",
                    //     "template_name" => "ashion",
                    //     "template_file" => "img_list.template",
                    //     'array' => array(
                    //         'SRC' => array(
                    //             "refer" => "img_in_database",
                    //         ),
                    //         'ACTIVE' => array(
                    //             "refer" => "if_first",
                    //             "text" => "active",
                    //         ),
                    //         'ID-PRODUK' => array(
                    //             "refer" => "database",
                    //             "row" => "id_produk",
                    //         ),

                    //     ),
                    // ],
                    "VARIAN"        => [
                        "looping",
                        "list_varian",
                        "content_source" => "template",
                        "template_name"  => "beegrit",
                        "looping"        => ["tipe_1", "tipe_2", "tipe_3"],
                        "looping_array"  => "NAMA-TIPE",
                        "template_file"  => "ecommerce/varian.template",
                        'array'          => [

                            'LIST' => [
                                "list",
                                "list_varian_detail",
                                "template_name" => "beegrit",
                                "template_file" => "ecommerce/varian_else.template",
                                "array"         => [
                                    "VALUE"          => ["data_tree", "id_varian", "tree_var" => ".list_varian"],
                                    "LEVEL"          => ["data_tree", "level"],
                                    "ID-ASSET"       => ["data", "id_asset"],
                                    "ID-PRODUK"      => ["data", "id_store_produk"],
                                    "ID-VARIAN-LIST" => ["data_tree", "id_varian"],
                                    "NAMA-VARIAN"    => ["data_tree", "nama_varian"],

                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $template[$set_type]['array'][] = ["VARIABEL", 'text', 'data_terlaris'];
            $template[$set_type]['array'][] = ["TITLE", 'text', 'Produk Terlaris'];
        }
        $set_type = "ecommerce-search";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::job_search_plaform_ui($page);
            $template[$set_type]['array'][] = [
                "LIST-PRODUK",
                'produk',
                'new',
                "func_content"  => "codepen",
                'content'       => "job-search-platform-ui-produk",
                "func"          => "data_produk",
                "variable"      => "data_search",
                "refer"         => "database_func",
                "judul",
                "include_in_id" => [

                    "class" => "job-cards",
                    "after" => "</div>",
                ],
                "refer_db"      => "all_produk",
                "pagination"    => [
                    "page"     => "none",
                    "limit"    => 10,
                    "order_by" => ["create_date", "desc"],
                ],
                "col"           => "col-md-3 col-sm-4 col-xs-6",
                "search"        => [
                    "non_search" => true,
                    "field"      => [
                        "nama_barang",
                        "nama_varian",
                        "barcode",
                        "barcode_varian",
                        "",
                    ],
                    "header"     => [
                        "key"    => "PRODUK-HEADER",
                        "method" => "append",
                        "data"   => [                                                                                                                                                                                // ["type" => "select", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                            ["type" => "select", "name" => "Kategori Toko", "db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                        ],
                    ],
                    // "sidebar" => [
                    //     "key" => "PRODUK-SIDEBAR",
                    //     "data" => [
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "inventaris__asset__master__kategori_toko", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "outsourcing__brand", "option_key" => "id", "option_value" => "nama_brand", "key_search" => "id_brand"], // tipe, nama_db
                    //         ["type" => "checkbox", "name"=>"Brand","db" => "webmaster__inventaris__master__kategori", "option_key" => "id", "option_value" => "nama_kategori", "key_search" => "id_kategori"], // tipe, nama_db
                    //         ["type" => "range", "name"=>"Harga", "option_literasi" => "100000", "option_akhir" => "500000", "key_search" => "harga_awal"], // tipe, nama_db
                    //     ]
                    // ]
                ],
                "array"         => [
                    "ID"            => ["data", "id"],
                    "NAMA-PRODUK"   => ["data", "nama_barang"],
                    "ID-ASSET"      => ["data", "id_asset"],
                    "ID-PRODUK"     => ["data", "id_produk"],
                    "HARGA-FULL"    => ["data", "harga_full"],
                    "DESC"          => ["data", "deskripsi_barang"],
                    "TUMB"          => ["data", "foto_aset"],
                    "TOTAL-TERJUAL" => ["data", "total_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "HARGA-AKHIR" => ["data", "harga_jual"],
                    // "HARGA-AWAL" => ["data", "id_asset"],
                    // "IMG-LIST-ASHION" => [
                    //     "list",
                    //     "foto_utama",
                    //     "source_list" => "template",
                    //     "content_source" => "template",
                    //     "template_name" => "ashion",
                    //     "template_file" => "img_list.template",
                    //     'array' => array(
                    //         'SRC' => array(
                    //             "refer" => "img_in_database",
                    //         ),
                    //         'ACTIVE' => array(
                    //             "refer" => "if_first",
                    //             "text" => "active",
                    //         ),
                    //         'ID-PRODUK' => array(
                    //             "refer" => "database",
                    //             "row" => "id_produk",
                    //         ),

                    //     ),
                    // ],
                    "VARIAN"        => [
                        "looping",
                        "list_varian",
                        "content_source" => "template",
                        "template_name"  => "beegrit",
                        "looping"        => ["tipe_1", "tipe_2", "tipe_3"],
                        "looping_array"  => "NAMA-TIPE",
                        "template_file"  => "ecommerce/varian.template",
                        'array'          => [

                            'LIST' => [
                                "list",
                                "list_varian_detail",
                                "template_name" => "beegrit",
                                "template_file" => "ecommerce/varian_else.template",
                                "array"         => [
                                    "VALUE"          => ["data_tree", "id_varian", "tree_var" => ".list_varian"],
                                    "LEVEL"          => ["data_tree", "level"],
                                    "ID-ASSET"       => ["data", "id_asset"],
                                    "ID-PRODUK"      => ["data", "id_store_produk"],
                                    "ID-VARIAN-LIST" => ["data_tree", "id_varian"],
                                    "NAMA-VARIAN"    => ["data_tree", "nama_varian"],

                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $template[$set_type]['array'][] = ["VARIABEL", 'text', 'data_search'];
            $template[$set_type]['array'][] = ["TITLE", 'text', ''];
        }
        return $template;
    }
    public static function soft_ui($page, $type = -1)
    {
        $template = [];
        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_card_main_listing($page);
        }
        $set_type = "CardDashboard-Right.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui_carddashboard_right_template($page);
        }

        $set_type = "CardDashboard.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui_carddashboard_template($page);
        }

        $set_type = "CardInfo1.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui_cardinfo1_template($page);
        }

        $set_type = "_CardFilter.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardfilter_template($page);
        }

        $set_type = "_CardListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardlistingmenu_template($page);
        }

        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardmainlistingmenu_template($page);
        }

        $set_type = "_CardMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardmenu_template($page);
        }

        $set_type = "_CardMenuScreenA.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardmenuscreena_template($page);
        }

        $set_type = "_CardMenuScreenB.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardmenuscreenb_template($page);
        }

        $set_type = "_CardUlLiNav.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardullinav_template($page);
        }

        $set_type = "_CardUlNav.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::soft_ui__cardulnav_template($page);
        }
        return $template;
    }
    public static function beegrit($page, $type = -1)
    {
        $set_type = "Ecommerce > Varian Else";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce___varian_else($page);

            $template[$set_type]["array"][] = ["LEVEL", "", ""];
            $template[$set_type]["array"][] = ["ID-ASSET", "", ""];
            $template[$set_type]["array"][] = ["ID-PRODUK", "", ""];
            $template[$set_type]["array"][] = ["ID-VARIAN-LIST", "", ""];
            $template[$set_type]["array"][] = ["VALUE", "", ""];
        }

        $set_type = "ecommerce detail";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_detail($page);

            $template[$set_type]["array"][] = ["TUMB", "", ""];
            $template[$set_type]["array"][] = ["NAMA-TOKO", "", ""];
            $template[$set_type]["array"][] = ["NAMA-PRODUK", "", ""];
            $template[$set_type]["array"][] = ["HARGA-AKHIR", "", ""];
            $template[$set_type]["array"][] = ["HARGA-AWAL", "", ""];
            $template[$set_type]["array"][] = ["DONASI-BAITUL-MAL", "", ""];
            $template[$set_type]["array"][] = ["SPESIFIKASI", "", ""];
            $template[$set_type]["array"][] = ["DESKRIPSI", "", ""];
            $template[$set_type]["array"][] = ["IMAGE-TOKO", "", ""];
            $template[$set_type]["array"][] = ["NAMA-TOKO", "", ""];
            $template[$set_type]["array"][] = ["BE3-TOKO", "", ""];
            $template[$set_type]["array"][] = ["LINK-PROFILTOKO", "", ""];
            $template[$set_type]["array"][] = ["RATING-TOKO", "", ""];
            $template[$set_type]["array"][] = ["TOTAL-JUAl-TOKO", "", ""];
            $template[$set_type]["array"][] = ["ULASAN", "", ""];
            $template[$set_type]["array"][] = ["VARIAN", "", ""];
            $template[$set_type]["array"][] = ["SAMPUL", "", ""];
        }

        $set_type = "ecommerce varian";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_varian($page);

        //     $template[$set_type]["array"][] = ["LIST", "", ""];
        //     $template[$set_type]["array"][] = ["NAMA-TIPE", "", ""];
        //     $template[$set_type]["array"][] = ["CLASS", "", ""];
        //     $template[$set_type]["array"][] = ["LEVEL", "", ""];
        // }

        $set_type = "IMG Tumb < Detail Ecommerce";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_img_tumb___detail_ecommerce($page);

            $template[$set_type]["array"][] = ["SRC", "", ""];
        }

        $set_type = "Detail Spesifikasi";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_detail_spesifikasi($page);

            $template[$set_type]["array"][] = ["NAMA-DETAIL", "", ""];
            $template[$set_type]["array"][] = ["KONTENT-DETAIL", "", ""];
        }

        $set_type = "IMG SAMPUL";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_img_sampul($page);

            $template[$set_type]["array"][] = ["IMG-SRC", "", ""];
        }

        $set_type = "Ecomerce > Varian Warna";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecomerce___varian_warna($page);

            $template[$set_type]["array"][] = ["LEVEL", "", ""];
            $template[$set_type]["array"][] = ["ID-ASSET", "", ""];
            $template[$set_type]["array"][] = ["ID-PRODUK", "", ""];
            $template[$set_type]["array"][] = ["ID-VARIAN-LIST", "", ""];
            $template[$set_type]["array"][] = ["VALUE", "", ""];
        }

        $set_type = "Ecommerce > varian_size";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce___varian_size($page);

            $template[$set_type]["array"][] = ["LEVEL", "", ""];
            $template[$set_type]["array"][] = ["ID-ASSET", "", ""];
            $template[$set_type]["array"][] = ["ID-PRODUK", "", ""];
            $template[$set_type]["array"][] = ["ID-VARIAN-LIST", "", ""];
            $template[$set_type]["array"][] = ["VALUE", "", ""];
        }
        $set_type = "EccomerceDetail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_eccomercedetail_template($page);
        }

        // $set_type = "HabistBoardContent.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::beegrit_habistboardcontent_template($page);
        // }

        // $set_type = "HabistBoardList.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::beegrit_habistboardlist_template($page);
        // }

        $set_type = "HabitsBoard.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitsboard_template($page);
        }

        $set_type = "HabitsBoardContent.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitsboardcontent_template($page);
        }

        $set_type = "HabitsBoardList.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitsboardlist_template($page);
        }

        $set_type = "HabitsBoardListAmalan.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitsboardlistamalan_template($page);
        }

        $set_type = "HabitsBoardListAnggota.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitsboardlistanggota_template($page);
        }

        $set_type = "HabitsTable.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitstable_template($page);
        }

        $set_type = "HabitsTableAjax.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_habitstableajax_template($page);
        }

        $set_type = "card/img.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_card_img_template($page);
        }

        $set_type = "card/layout.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_card_layout_template($page);
        }

        $set_type = "chat/chat.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_chat_template($page);
        }

        $set_type = "chat/content_footer.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_content_footer_template($page);
        }

        $set_type = "chat/content_pesan.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_content_pesan_template($page);
        }

        $set_type = "chat/content_pesan_me.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_content_pesan_me_template($page);
        }

        $set_type = "chat/content_pesan_other.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_content_pesan_other_template($page);
        }

        $set_type = "chat/content_profile.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_content_profile_template($page);
        }

        $set_type = "chat/list_buat_chat_room.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_list_buat_chat_room_template($page);
        }

        $set_type = "chat/list_chat_room.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_chat_list_chat_room_template($page);
        }

        $set_type = "ecommerce/cart.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_cart_template($page);
        }

        // $set_type = "ecommerce/cart_option.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_cart_option_template($page);
        // }

        $set_type = "ecommerce/cart_produk.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_cart_produk_template($page);
        }

        $set_type = "ecommerce/cart_toko.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_cart_toko_template($page);
        }

        $set_type = "ecommerce/cart_varian.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_cart_varian_template($page);
        }

        $set_type = "ecommerce/checkout.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_checkout_template($page);
        }

        $set_type = "ecommerce/checkout_kirim_ke.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_checkout_kirim_ke_template($page);
        }

        $set_type = "ecommerce/checkout_pembayaran.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_checkout_pembayaran_template($page);
        }

        $set_type = "ecommerce/checkout_pembayaran_brand.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_checkout_pembayaran_brand_template($page);
        }

        $set_type = "ecommerce/detail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_detail_template($page);
        }

        // $set_type = "ecommerce/detail_spesifikasi.template";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_detail_spesifikasi_template($page);
        // }

        $set_type = "ecommerce/img.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_img_template($page);
        }

        $set_type = "ecommerce/img_tumb.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_img_tumb_template($page);
        }

        $set_type = "ecommerce/invoice.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_invoice_template($page);
        }

        $set_type = "ecommerce/invoice_alamat.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_invoice_alamat_template($page);
        }

        $set_type = "ecommerce/invoice_pembayaran.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_invoice_pembayaran_template($page);
        }

        $set_type = "ecommerce/varian.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_varian_template($page);
        }

        $set_type = "ecommerce/varian_else.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_varian_else_template($page);
        }

        $set_type = "ecommerce/varian_size.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_varian_size_template($page);
        }

        $set_type = "ecommerce/varian_warna.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::beegrit_ecommerce_varian_warna_template($page);
        }
        return $template;
    }

    public static function sneat($page, $type = -1)
    {
        $template = [];
        $set_type = "base";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::sneat_base($page);
            $template['base']['array'][]    = ["FILE-CONTENT", 'pages_content', ''];
            $template['base']['array'][]    = ["SIDEBAR", 'sneat', 'sidebar'];
            $template[$set_type]['array'][] = ["BE3-LINK-PROFILE", 'link', ["User", "profil", "view_layout", -1], 'just_link'];
            $template[$set_type]['array'][] = ["BE3-LINK-DAFTAR", 'bundle'];
            $template[$set_type]['array'][] = ["BE3-LINK-LOGIN", 'bundle'];
            $template[$set_type]['array'][] = ["BE3-LINK-LOGOUT", 'bundle'];
        }

        $set_type = "sidebar";
        if ($type == -1 or $type == 'sidebar') {
            $template[$set_type]['content'] = Bundlecontent::sneat_sidebar($page);
            $template[$set_type]['array'][] = ["BRAND-LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["BRAND-LOGOTEXT", 'row_web_apps', 'meta_title'];
            $template[$set_type]['array'][] = ["LIST-MENU", 'list_menu_board', ''];
            // $template[$set_type]['array'][] = ["FORM-SEARCH-BAR", 'foodmart', 'form_search_bar'];
            // $template[$set_type]['array'][] = ["PROFILE", 'codepen', 'profil-dropdown'];
            // $template[$set_type]['array'][] = ["BE3-LINK-CART", 'link', ["Ecommerce","cart","view_layout",-1],'just_link'];
        }
        $set_type = "Ashion > Profillogin";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::sneat_ashion___profil__login($page);

            $template[$set_type]["array"][] = ["BE3-USER-IMAGE", "", ""];
            $template[$set_type]["array"][] = ["BE3-USER-NAME", "", ""];
            $template[$set_type]["array"][] = ["BE3-USER-EMAIL", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-LOGOUT", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-LOGIN", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-REGISTER", "", ""];
        }

        $set_type = "Sneat > Sibare";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::sneat___sibare($page);

            $template[$set_type]["array"][] = ["BASE-URL", "", ""];
            $template[$set_type]["array"][] = ["BRAND-LOGO", "", ""];
            $template[$set_type]["array"][] = ["BRAND-LOGOTEXT", "", ""];
            $template[$set_type]["array"][] = ["BE3-LIST-PANEL-WORKSPACE", "", ""];
            $template[$set_type]["array"][] = ["BE3-LIST-ROLE-WORKSPACE", "", ""];
            $template[$set_type]["array"][] = ["LIST-MENU", "", ""];
        }

        $set_type = "Ashion > Profillogin";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::sneat_ashion___profil__login($page);

            $template[$set_type]["array"][] = ["BE3-USER-IMAGE", "", ""];
            $template[$set_type]["array"][] = ["BE3-USER-NAME", "", ""];
            $template[$set_type]["array"][] = ["BE3-USER-EMAIL", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-LOGOUT", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-LOGIN", "", ""];
            $template[$set_type]["array"][] = ["BE3-LINK-REGISTER", "", ""];
        }
        return $template;
    }
    public static function main_all($page, $type = -1)
    {
        $template = [];
        $set_type = "base";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::main_all($page);
            $template['base']['array'][]    = ["FILE-CONTENT", 'pages_content', ''];
            $template['base']['array'][]    = ["SIDEBAR", 'sneat', 'sidebar'];
        }

        $set_type = "sidebar";
        if ($type == -1 or $type == 'sidebar') {
            $template[$set_type]['content'] = Bundlecontent::sneat_sidebar($page);
            $template[$set_type]['array'][] = ["BRAND-LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["BRAND-LOGOTEXT", 'row_web_apps', 'meta_title'];
            $template[$set_type]['array'][] = ["LIST-MENU", 'list_menu_board', ''];
            // $template[$set_type]['array'][] = ["FORM-SEARCH-BAR", 'foodmart', 'form_search_bar'];
            // $template[$set_type]['array'][] = ["PROFILE", 'codepen', 'profil-dropdown'];
            // $template[$set_type]['array'][] = ["BE3-LINK-CART", 'link', ["Ecommerce","cart","view_layout",-1],'just_link'];
        }
        return $template;
    }
    public static function ilanding($page, $type = -1)
    {
        $template = [];
        if ($type == -1 or $type == 'base') {

            $template['base']['content'] = Bundlecontent::ilanding_base($page);
            $template['base']['array'][] = ["FILE-CONTENT", 'pages_content', ''];
            $template['base']['array'][] = ["HEADER", 'foodmart', 'header'];
            $template['base']['array'][] = ["FOOTER", 'foodmart', 'footer'];
        }
        $set_type = "header";
        if ($type == -1 or $type == 'header') {
            $template[$set_type]['content'] = Bundlecontent::ilanding_header($page);
            $template[$set_type]['array'][] = ["LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["FORM-SEARCH-BAR", 'foodmart', 'form_search_bar'];
            $template[$set_type]['array'][] = ["NOMOR-WA", 'row_web_apps', 'nomor_send_wa'];
            $template[$set_type]['array'][] = ["NAVBAR", 'foodmart', 'navbar'];
            $template[$set_type]['array'][] = ["PROFILE", 'codepen', 'profil-dropdown'];
            $template[$set_type]['array'][] = ["BE3-LINK-CART", 'link', ["Ecommerce", "cart", "view_layout", -1], 'just_link'];
        }

        $set_type = "hero";
        if ($type == -1 or $type == 'hero') {
            $template[$set_type]['content'] = Bundlecontent::ilanding_home_hero($page);
        }
        $set_type = "about";
        if ($type == -1 or $type == 'about') {
            $template[$set_type]['content'] = Bundlecontent::ilanding_home_about($page);
        }
        $set_type = "features";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_features($page);
        }
        $set_type = "features_card";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_features_card($page);
        }
        $set_type = "cta";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_cta($page);
        }
        $set_type = "features_center";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_features_center($page);
        }
        $set_type = "clients";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_clients($page);
        }
        $set_type = "testimonial";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_testimonial($page);
        }
        $set_type = "stat";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_stat($page);
        }
        $set_type = "service";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_service($page);
        }
        $set_type = "pricing";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_pricing($page);
        }
        $set_type = "faq";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_faq($page);
        }
        $set_type = "cta2";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_cta2($page);
        }
        $set_type = "contact";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ilanding_contact($page);
        }
        return $template;
    }
    public static function adminlte($page, $type = -1)
    {
        $template = [];
        $set_type = "crud_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::adminlte_crud_list_template($page);
        }

        $set_type = "crud_vte.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::adminlte_crud_vte_template($page);
        }
        return $template;
    }
    public static function empty($page, $type = -1)
    {
        $template = [];
        if ($type == -1 or $type == 'base') {
            $template['base']['content']['html'] = "<FILE-CONTENT></FILE-CONTENT>";
            $template['base']['array'][]         = ["FILE-CONTENT", 'pages_content', ''];
        }
        return $template;
    }
    public static function file_manager($page, $type = -1)
    {
        $template = [];
        if ($type == -1 or $type == 'base') {
            $template['base']['content']['html'] = Bundlecontent::file_manager_base($page);
        }
        return $template;
    }
    public static function foodmart($page, $type = -1)
    {
        $template = [];
        if ($type == -1 or $type == 'base') {

            $template['base']['content'] = Bundlecontent::foodmart_base($page);
            $template['base']['array'][] = ["HEADER", 'foodmart', 'header'];
            $template['base']['array'][] = ["FILE-CONTENT", 'pages_content', ''];
        }
        $set_type = "header";
        if ($type == -1 or $type == 'header') {
            $template[$set_type]['content'] = Bundlecontent::foodmart_header($page);
            $template[$set_type]['array'][] = ["LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["FORM-SEARCH-BAR", 'foodmart', 'form_search_bar'];
            $template[$set_type]['array'][] = ["NOMOR-WA", 'row_web_apps', 'nomor_send_wa'];
            $template[$set_type]['array'][] = ["NAVBAR", 'foodmart', 'navbar'];
            $template[$set_type]['array'][] = ["PROFILE", 'codepen', 'profil-dropdown'];
            $template[$set_type]['array'][] = ["BE3-LINK-CART", 'link', ["Ecommerce", "cart", "view_layout", -1], 'just_link'];
            $template[$set_type]['array'][] = ["BE3-LINK-PROFILE", 'link', ["User", "profil", "view_layout", -1], 'just_link'];
            $template[$set_type]['array'][] = ["BE3-LINK-DAFTAR", 'bundle'];
            $template[$set_type]['array'][] = ["BE3-LINK-LOGIN", 'bundle'];
            $template[$set_type]['array'][] = ["BE3-LINK-LOGOUT", 'bundle'];
        }
        $set_type = "form_search_bar";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_search($page);
            $template[$set_type]['array'][] = ["KATEGORI", 'foodmart', 'form_search_bar_kategori-kategori_toko'];
        }
        $set_type = "form_search_bar_kategori-kategori_toko";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']['html']   = "<Option value='<VALUE></VALUE>'><TEXT></text></Option>";
            $template[$set_type]['database']['utama'] = 'inventaris__asset__master__kategori_toko';

            $template[$set_type]['database']['where'][] = ['active', "=", "1"];
            $template[$set_type]['array'][]             = ["TEXT", 'database', 'nama_kategori'];
            $template[$set_type]['array'][]             = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "navbar";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_navbar($page);
            $configuration                  = Bundlecontent::foodmart_menu_configuration($page);

            $template[$set_type]['array'][] = [
                "MENU-LIST",
                'menu',
                "",
                "list"          => [
                    "tipe" => "menu_func",
                    "func" => "menu_ecommerce_frontend",
                    "var"  => "list",
                ],

                "configuration" => $configuration,

            ];
        }

        $set_type = "menu_dropdown";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_menu_dropdown($page);
        }
        $set_type = "menu_single";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_menu_single($page);
        }
        $set_type = "home";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::home_produk_group_klasifikasi($page);
            $template[$set_type]['array'][] = ["BEST-SELLER", 'foodmart', 'form_best_seller'];
            $template[$set_type]['array'][] = ["NEW-ARRIVAL", 'foodmart', 'form_new_arrival'];
        }
        $set_type = "form_best_seller";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']           = Bundlecontent::foodmart_card_vertical($page);
            $template[$set_type]['database']['utama'] = "inventaris__asset__list";
            $template[$set_type]['database']['query'] = DatabaseFunc::best_seller($page, 12);

            // $temp_template = str_replace('<CARD-SUBTITLE></CARD-SUBTITLE>', $get_data_harga['Min Max Harga Jual Akhir'], $temp_template);

            $template[$set_type]['array'][] = ["CARD-TITLE", 'database', 'nama_barang'];
            $template[$set_type]['array'][] = ["CARD-SUBTITLE", 'get_data_harga', 'id_produk', "get_result" => "Min Max Harga Jual Akhir", "parameter" => "min_max"];
            $template[$set_type]['array'][] = ["IMG-SRC", 'drive_file_db', ''];
            $template[$set_type]['array'][] = ["CARD-LINK", 'link', ["Ecommerce", "detail", "view_layout", "row:id_produk|"], 'just_link'];
        }

        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_card_main_listing($page);
        }
        $set_type = "BE3-ECOMMERCE-LIST-PRODUCT-VERTICAL";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_card_vertical($page);
        }
        $set_type = "ViewVertical";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_card_vertical($page);
        }
        $set_type = "DETAIL-PRODUCT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_detail_produk($page);
        }
        $set_type = "BE3-ECOMMERCE-DETAIL-PRODUCT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_detail_produk($page);
        }
        $set_type = "BE3-ECOMMERCE-CART";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_ecomerce_cart($page);
        }
        $set_type = "BE3-ECOMMERCE-CART-PRODUK";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::foodmart_ecomerce_cart_produk($page);
            $template[$set_type]['array'][] = ["VALUE", 'database', 'primary_key'];
        }
        $set_type = "BE3-ECOMMERCE-CHECKOUT";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::ashion_ecomerce_checkout($page);
        }
        $set_type = "ViewVertical.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_viewvertical_template($page);
        }

        $set_type = "_CardMainListingMenu.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion__cardmainlistingmenu_template($page);
        }

        $set_type = "footer.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_footer_template($page);
        }

        $set_type = "home2.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_home2_template($page);
        }

        $set_type = "home3.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_home3_template($page);
        }

        $set_type = "img_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_img_list_template($page);
        }

        $set_type = "img_tumb.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::ashion_img_tumb_template($page);
        }

        if (! isset($template[$set_type])) {
            $template['no_content'] = true;
        }
        return $template;
    }
    public static function finapp($page, $type = -1)
    {
        $set_type = "base";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::finapp_base($page);
            $template[$set_type]["array"][] = ["HEADER", "menu_content", "finapp_menu", "header"];
            $template[$set_type]["array"][] = ["SIDEBAR", "menu_content", "finapp_menu", "sidebar"];
            $template[$set_type]["array"][] = ["BOTTOM", "menu_content", "finapp_menu", "bottom"];
            $template[$set_type]['array'][] = ["FILE-CONTENT", 'pages_content', ''];
        }
        $set_type = "Dashboard-card-footer_item.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::finapp_dashboard_card_footer_item_template($page);
        }

        $set_type = "Dashboard-card.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::finapp_dashboard_card_template($page);
        }
        return $template;
    }
    public static function topiclisting($page, $type = -1)
    {
        $set_type = "banner.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_banner_template($page);
        }

        $set_type = "banner_detail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_banner_detail_template($page);
        }

        $set_type = "contact_section.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_contact_section_template($page);
        }

        $set_type = "content_tab_pane.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_content_tab_pane_template($page);
        }

        $set_type = "explore_section.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_explore_section_template($page);
        }

        $set_type = "faq_detail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_faq_detail_template($page);
        }

        $set_type = "faq_section.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_faq_section_template($page);
        }

        $set_type = "footer_section.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_footer_section_template($page);
        }

        $set_type = "nav_header.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_nav_header_template($page);
        }

        $set_type = "nav_item.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_nav_item_template($page);
        }

        $set_type = "nav_item_header.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_nav_item_header_template($page);
        }

        $set_type = "tab_pane.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_tab_pane_template($page);
        }

        $set_type = "timeline_detail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_timeline_detail_template($page);
        }

        $set_type = "timeline_section.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_timeline_section_template($page);
        }

        $set_type = "topic_detail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::topiclisting_topic_detail_template($page);
        }
        return $template;
    }
    public static function tabler($page, $type = -1)
    {
        $set_type = "crud_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::tabler_crud_list_template($page);
        }

        $set_type = "crud_vte.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::tabler_crud_vte_template($page);
        }

        $set_type = "section_header.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::tabler_section_header_template($page);
        }
        return $template;
    }
    public static function esios($page, $type = -1)
    {
        $set_type = "crud_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::esios_crud_list_template($page);
        }

        $set_type = "crud_vte.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::esios_crud_vte_template($page);
        }

        return $template;
    }
    public static function dashuipro($page, $type = -1)
    {
        $set_type = "chat.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_chat_template($page);
        }

        $set_type = "crud_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_crud_list_template($page);
        }

        $set_type = "crud_vte.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_crud_vte_template($page);
        }

        $set_type = "ecommerce_cart.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_ecommerce_cart_template($page);
        }

        $set_type = "pricing.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_pricing_template($page);
        }

        $set_type = "pricingdetail.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_pricingdetail_template($page);
        }

        $set_type = "pricingdetail_list.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_pricingdetail_list_template($page);
        }

        $set_type = "pricinggroup.template";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]["content"] = Bundlecontent::dashuipro_pricinggroup_template($page);
        }

        return $template;
    }
}
