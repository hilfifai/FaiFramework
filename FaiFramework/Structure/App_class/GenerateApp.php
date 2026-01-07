<?php

class GenerateApp
{
    public static function get_generate($page)
    {
       
        // Contoh penggunaan
        $set_type                        = "hibe3";
        $version                         = "1";
        $gen                             = 0;
        $urut                            = 0;
        $page['section']                 = "generate";
        $data['menu']                    = self::generateVersionedTemplate($page,$set_type, $version, $gen, 'json', 'MenuContent');
        $data['menu_list']               = self::generateVersionedTemplate($page,$set_type, $version, $gen, 'json', 'MenuListContent');
        $data['search']                  = self::generateVersionedTemplate($page,$set_type, $version, $gen, 'json', 'SearchContent');
        $data['page']                    = self::generateVersionedTemplate($page,$set_type, $version, $gen, 'json', 'TemplateContent');
        $data['app']                     = self::app_generate();
        // $page['database_provider']       = DATABASE_PROVIDER;
        // $page['database_name']           = DATABASE_NAME . '_json';
        // $page['conection_name_database'] = CONECTION_NAME_DATABASE . '_json';
        // $page['conection_server']        = CONECTION_SERVER;
        // $page['conection_user']          = CONECTION_USER;
        // $page['conection_user']          = $page['database_provider'] == 'mysql' ? CONECTION_USER . '_json' : CONECTION_USER;
        // $page['conection_password']      = CONECTION_PASSWORD;
        // $page['conection_scheme']        = CONECTION_SCHEME;
        // DB::connection($page);

        $raw = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $raw = preg_replace("/[\n\r\t]+/", '', $raw);

        // Escape single quote (')
        $raw       = str_replace("'", "\\'", $raw);
        $insertSql = "INSERT INTO `apps__version`( `version`, `raw_version`, `last_version`, `last_gen`, `last_urut`) VALUES ('$version.$gen.$urut','$raw','$version','$gen','$urut')";
        $updateql  = "UPDATE `apps__version` SET `raw_version`='$raw' WHERE version='$version.$gen.$urut'";
        DB::table('apps__version');
        DB::whereRaw("version='$version.$gen.$urut'");
        $get = DB::get('all');
        if ($get['num_rows']) {
            DB::queryRaw($page, $updateql);
            DB::get('all');
        } else {

            DB::queryRaw($page, $insertSql);
            DB::get('all');
        }
    }

    public static function app_generate()
    {
        $file = scandir(BASEPATH_FAI . 'FaiFramework/Structure/App');
        print_r($file);
        echo '<pre>';
        $data          = [];
        echo $fileName = 'Fai-Version-Template-App.json';
        if (! file_exists($fileName)) {

            file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT));
        }
        $page            = [];
        $count           = 0;
        $version         = 1;
        $gen             = 0;
        $outputFormat    = "json";
        $page['section'] = "generate";

        // $page['load']['database']['id']['text'] = 'id';
        // $page['load']['database']['id']['type'] = 'prefix'; //prefix//sufix
        // $page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id
        $data = json_decode(file_get_contents($fileName), true);
        for ($i = 2; $i < count($file); $i++) {
            $nama      = $file[$i];
            $name_func = str_replace(".php", "", $nama);
            if (substr($nama, -strlen('.php')) == '.php' and ! in_array($nama, [
                "ChatApp.php",
                "temp.php",
                "Form.php",
                "Amal.php",
                "Auth.php",
                "Cronjob.php",
                "Data.php",
                "Esios.php",
                "WaWebhook.php",
                "ViewLayout.php",
                "BForm.php",
            ])) {
                '<br>' . $nama;

                require_once BASEPATH . "FaiFramework/Structure/App/$nama";
                $class     = str_replace('.php', "", $nama);
                $template  = new $class();
                $reflector = new ReflectionClass($class);
                $methods   = $reflector->getMethods();
                // print_r($methods);

                $true = false;
                foreach ($methods as $method) {
                    $name_method = $method->name;
                    echo '<br>' . $nama . '-' . $name_method;
                    $get_now_array         = [];
                    $get_last_version      = $data["versions"][$name_func][$name_method]['last_version'] ?? ($version - 1) . '.' . $gen . '.0';
                    $get_temp_version_last = $data["versions"][$name_func][$name_method]['versions'][$get_last_version] ?? [];
                    if (! in_array($nama . '-' . $name_method, [
                        "BForm.php-form_content",
                        "BForm.php-approval_content",
                        "BForm.php-update_utama",
                        "BForm.php-add_approval",
                        "BForm.php-add_from_extend",
                        "BForm.php-add_form_approval",
                        "BForm.php-save_nama_approval",
                        "CRM.php-list_workspace",
                        "ERP.php-list_workspace",
                        "ERP.php-pajak",
                        "Ecommerce.php-update_stok",
                        "Ecommerce.php-clearance_produk",
                        "Ecommerce.php-detail2",
                        "Ecommerce.php-list_barang_detail",
                        "Ecommerce.php-buat_invoice",
                        "Ecommerce.php-sync_cart",
                        "Ecommerce.php-acc_sync_order",
                        "Ecommerce.php-get_order",
                        "Ecommerce.php-get_order_detail",
                        "Ecommerce.php-sync_order",
                        "Ecommerce.php-cancel_order",
                        "Ecommerce.php-get_pesanan",
                        "Ecommerce.php-update_detail",
                        "Ecommerce.php-hapus_cart",
                        "Ecommerce.php-hapus_cart_web",
                        "Ecommerce.php-konfirmasi_pembayaran",
                        "GA.php-list_workspace",
                        "HCMS.php-list_workspace",
                        "HCMS.php-list_board",
                        "Inventaris_aset.php-list_workspace",
                        "Keuangan.php-list_workspace",
                        "Outsourcing.php-list_workspace",
                        "POS.php-list_workspace",
                        "POS.php-closed_po",
                        "POS.php-open_po",
                        "POS.php-js_payment",
                        "Share.php-jam2",
                        "Inventaris_aset.php-data_varian",
                        "Share.php-send_wa_insert",
                        "Store.php-list_workspace",
                        "Web.php-get_menu",
                        "Web.php-save_menu",
                        "Website.php-gettag",
                        "Workspace.php-workspace_apps",
                        "CRM.php-pembayaran_mitra",
                        "Workspace.php-food_dashboard",

                    ])) {

                        $content_page = $template->$name_method($page);
                        // $content_page['section'] ="generate";
                        // $content_page = Packages::initialize($content_page);
                        // unset($content_page['section']);
                        // if (isset($content_page['crud']['array'])){

                        //     $perubahan_array = Database::converting_array_field($page, $content_page['crud']['array'], 'all');
                        //     // print_R($perubahan_array);
                        //     $content_page['crud']['array'] = $perubahan_array['array'];
                        // }
                        // if (isset($content_page['crud']['array_sub_kategori'])){
                        //     for($i=0;$i<count($content_page['crud']['array_sub_kategori']);$i++){

                        //         $perubahan_array = Database::converting_array_field($page, $content_page['crud']['array_sub_kategori'][$i], 'all');
                        //         // print_R($perubahan_array);
                        //         $content_page['crud']['array_sub_kategori'][$i] = $perubahan_array['array'];
                        //     }
                        // }
                        $db = [];
                        //$page['config']['database']['Pending Ajuan']['utama'] = 'organisasi';
                        if (isset($content_page['config']['database'])) {
                            foreach ($content_page['config']['database'] as $key => $config) {
                                if (isset($config['utama'])) {
                                    $db[$config['utama']] = ["config_utama", $key];
                                }

                                if (count($config["join"] ?? [])) {

                                    foreach ($config["join"] as $key2 => $join) {
                                        $db[$join[0]] = ["config_join", $key, $key2];
                                    }
                                }
                            }
                        }
                        if (isset($content_page["database"])) {

                            $db[$content_page["database"]['utama']] = ["utama"];

                            if (count($content_page["database"]["join"] ?? [])) {

                                foreach ($content_page["database"]["join"] as $key => $join) {
                                    $db[$join[0]] = ["join", $key];
                                }
                            }
                        }
                        if (count($content_page['crud']["sub_kategori"] ?? [])) {
                            foreach ($content_page['crud']["sub_kategori"] as $key => $sub) {
                                $db[$sub[1]] = ["sub_kategori", $key];
                            }
                        }
                        $get_now_array['db']   = $db;
                        $get_now_array['page'] = $content_page;

                        $diff_analis_key = [];
                        foreach ($get_now_array as $key => $value) {
                            echo empty($get_temp_version_last[$key]);
                            if (empty($get_temp_version_last[$key]) and empty($value)) {
                            } else
                            if (! isset($get_temp_version_last[$key])) {
                                $diff_analis_key[$key] = "ISI";
                                $true                  = true;
                            } else if ((($get_temp_version_last[$key]) ?? -1) != (($value) ?? -1)) {

                                // $diff_analis_key[$key] = $value;
                                foreach ($get_now_array[$key] as $key2 => $value2) {
                                    if (! isset($get_temp_version_last[$key][$key2])) {
                                        $true                                    = true;
                                        $diff_analis_key["KEY PEMBEDA-" . $key2] = $value2;
                                    } else
                                    if (($get_temp_version_last[$key][$key2]) != ($value2)) {
                                        $true                                    = true;
                                        $diff_analis_key["KEY PEMBEDA-" . $key2] = $value2;
                                    }
                                }
                            }
                        }
                        if (! isset($data["versions"][$name_func][$name_method])) {
                            $true = true;
                        }

                        if (count($diff_analis_key) || $true) {
                            echo '<br>';
                            echo '<br>';
                            echo $name_func . $name_method . '<br> LASTER VERSION';
                            print_R($get_last_version);
                            echo '<Br>';
                            // print_R($get_temp_version_last);
                            $urut                                                                                        = $data["data-versions"][$name_func][$name_method][$version][$gen]                                                                                        = ($data["data-versions"][$name_func][$name_method][$version][$gen] ?? -1) + 1;
                            $data["versions"][$name_func][$name_method]['versions'][$version . '.' . $gen . '.' . $urut] = $get_now_array;
                            echo '<br>NEW VERSION' . $version . '.' . $gen . '.' . $urut;
                            // print_R($get_now_array);
                            echo 'PEMBEDA';

                            print_R($diff_analis_key);

                            $count++;

                            $data["versions"][$name_func][$name_method]['last_version']       = $version . '.' . $gen . '.' . $urut;
                            $data["versions"][$name_func][$name_method]['last_generate_date'] = date("Y-m-d");
                            // die;
                        }
                        // sleep(2);

                    }
                }
            }
        }

        if ($count) {

            $urutan_versi                = $data["data-versions"]['utama'][$version][$gen]                = ($data["data-versions"]['utama'][$version][$gen] ?? -1) + 1;
            $data["alast_version"]       = $version . '.' . $gen . '.' . $urutan_versi;
            $data["alast_generate_date"] = date("Y-m-d");

            // Simpan dalam JSON atau XML

            if ($outputFormat === 'json') {
                file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT));
            } else {
                $xml = new SimpleXMLElement('<FaiTemplate/>');
                arrayToXml($data, $xml);
                file_put_contents($fileName, $xml->asXML());
            }
        }
        // $class="";
        return $data;
    }

    public static function generateVersionedTemplate($page,$set_type, $version, $gen, $outputFormat = 'json', $class = "TemplateContent")
    {
        echo $outputFormat;
        ini_set('memory_limit', '-1');
        error_reporting(E_ALL);

        $fai = new MainFaiFramework();

        //$all = menu / class/function
        $type_load = ($fai->input('load_function')) ? $fai->input('load_function') : '';
        

       

        $page = $fai->LoadApps($page, $page['load']['domain'], -1, 'page');
        echo '<Br>';
        $extend = "";
        if (($class == 'MenuContent')) {

            $extend = "-Menu";
        } else
        if (($class == 'MenuListContent')) {

            $extend = "-MenuList";
        } else
        if (($class == 'AuthContent')) {

            $extend = "-Auth";
        } else
        if (($class == 'SearchContent')) {

            $extend = "-Search";
        }
        echo $fileName = 'Fai-Version-Template' . $extend . '.' . $outputFormat;
        if (! file_exists($fileName)) {
            // Isi default bisa disesuaikan
            $defaultData = [
                'version'    => '1.0',
                'template'   => [],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            file_put_contents($fileName, json_encode($defaultData, JSON_PRETTY_PRINT));
        }

        $data = json_decode(file_get_contents($fileName), true);
        // Jika file sudah ada, ambil datanya
        // if (file_exists($fileName)) {

        // } else {
        //     $data = [
        //         "data_version" => "$version.$gen.0",
        //         "last_generate_date" => date("Y-m-d"),
        //         "versions" => [],
        //     ];
        // }
        $template  = new $class();
        $reflector = new ReflectionClass($class);
        $methods   = $reflector->getMethods();
        echo '<pre>';

        // Contoh Data
        echo $class;
        //  print_R($methods);

        // Menganalisis perbedaan nilai

        $count = 0;
        foreach ($methods as $key => $value) {

            $name_func = $value->name;
            if (! in_array($name_func, ['__construct', 'get_generate', 'parse_template'])) {
                //  echo '<br>'.$name_func;
                $get_last_version      = $data["versions"][$name_func]['last_version'] ?? ($version - 1) . '.' . $gen . '.0';
                $get_temp_version_last = $data["versions"][$name_func]['versions'][$get_last_version] ?? [];
                $get_now_array         = $template->$name_func($page);
                //echo '<textarea>';
                //print_r($get_now_array);
                //echo '</textarea>';
                $diff_analis_key  = [];
                $diff_analis_key2 = [];
                $true             = false;
                if (! isset($data["versions"][$name_func])) {
                    $true = true;

                    $diff_analis_key2[$name_func]                                                  = 1;
                    $data["data-versions"][$name_func][$version][$gen]                             = $urut                             = 0;
                    $data["versions"][$name_func]['versions'][$version . '.' . $gen . '.' . $urut] = $get_now_array;

                    $count++;

                    $data["versions"][$name_func]['last_version']       = $version . '.' . $gen . '.' . $urut;
                    $data["versions"][$name_func]['last_generate_date'] = date("Y-m-d");
                } else {

                    if (($get_now_array)) {

                        // $diff_values = array_diff_assoc_recursive($get_temp_version_last, $get_now_array);

                        // // Menganalisis perbedaan struktur kunci
                        // $diff_keys = array_diff_key_recursive($get_temp_version_last, $get_now_array);

                        foreach ($get_now_array as $key => $value) {

                            if (! isset($get_temp_version_last[$key])) {
                                $diff_analis_key[$key] = 1;
                                $true                  = true;
                            } else if ($get_temp_version_last[$key] != $value) {
                                $true                  = true;
                                $diff_analis_key[$key] = 1;
                            }
                        }
                        // print_R($diff_analis_key);
                        // print_R($diff_analis_key2);
                        // if(!isset($get_temp_version_last[$nama_func])){
                        //     $diff_analis_key[$nama_func] = 1;
                        // }
                        if (count($diff_analis_key)) {
                            echo $name_func;
                            echo '<br>';
                            print_R($diff_analis_key);
                        }
                        if (count($diff_analis_key) || $true) {
                            echo 'MASUK';
                            // echo 'KENAPA SIH' . $name_func;
                            $urut                                                                          = $data["data-versions"][$name_func][$version][$gen]                                                                          = ($data["data-versions"][$name_func][$version][$gen] ?? -1) + 1;
                            $data["versions"][$name_func]['versions'][$version . '.' . $gen . '.' . $urut] = $get_now_array;

                            $count++;

                            $data["versions"][$name_func]['last_version']       = $version . '.' . $gen . '.' . $urut;
                            $data["versions"][$name_func]['last_generate_date'] = date("Y-m-d");

                            // print_R($data["versions"][$name_func]['versions'][$version . '.' . $gen . '.' . $urut]);
                        }
                    }
                }
            }
        }
        echo $count;
        if ($count) {
            echo 'HALLOW' . $outputFormat;
            $urutan_versi                = $data["data-versions"]['utama'][$version][$gen]                = ($data["data-versions"]['utama'][$version][$gen] ?? -1) + 1;
            $data["alast_version"]       = $version . '.' . $gen . '.' . $urutan_versi;
            $data["alast_generate_date"] = date("Y-m-d");

            // Simpan dalam JSON atau XML
            if ($outputFormat === 'json') {
                file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT));

            } else {
                $xml = new SimpleXMLElement('<FaiTemplate/>');
                arrayToXml($data, $xml);
                file_put_contents($fileName, $xml->asXML());
            }
        }

        return $data;
    }
}