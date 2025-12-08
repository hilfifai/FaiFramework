<?php
class DatabaseFunc
{
    public static function sqlcreate($database_utama, $field, $array, $i, $database_provider, $page, $yang_sudah = [])
    {
        $type = $array[$i][2];
        $type = CrudContent::typearray($page, $array, $i)['type'];
        if ($type == 'database-join') {
            $field_data = $field;
            $field      = $field_data[0];
        } else if ($type == 'database-costum') {
            //echo 'masuk';;
            $field_data = $field;
            $field      = $field_data[1];
        }
        if ($type == 'select-appr') {
            $sqlcreate = "";
        } else
        if ($database_provider == 'postgres') {
            $sqlcreate = "$field ";
        } else {
            $sqlcreate = "`$field` ";
        }

        $type_data = "";
        if (! ($field == null)) {

            $type;
            if ($type == 'text') {
                if ($database_provider == 'postgres') {
                    $type_data = "character varying(255)";
                } else {
                    $type_data = " varchar(255) DEFAULT NULL";
                }
            } else if ($type == 'textarea') {
                if ($database_provider == 'postgres') {
                    $type_data = " text";
                } else {
                    $type_data = " text DEFAULT NULL";
                }
            } else if ($type == 'editor-code') {
                if ($database_provider == 'postgres') {
                    $type_data = " text";
                } else {
                    $type_data = " text DEFAULT NULL";
                }
            } else if ($type == 'select') {
                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL
            ";
                }
            } else if ($type == 'list_panel') {
                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL
            ";
                }
            } else if ($type == 'file') {
                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL,
            ";
                }
            } else if ($type == 'select-relation') {
                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL
            ";
                }
            } else if ($type == 'select-appr') {
                if ($database_provider == 'postgres') {

                    $type_data = "_id  numeric,
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_by  numeric,
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_date  date,
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_status  numeric DEFAULT 3
               ";
                } else {
                    $type_data = "_id  int(11) DEFAULT NULL
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_by  int(11) DEFAULT NULL
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_date  date DEFAULT NULL
               ";
                    $sqlcreate .= $field . $type_data;
                    $type_data = "_status int(11) DEFAULT 3
               ";
                    $sqlcreate .= $field . $type_data;
                }
            } else if ($type == 'select-manual') {
                if ($database_provider == 'postgres') {
                    $type_data = " character varying(255)";
                } else {
                    $type_data = " varchar(255) DEFAULT NULL";
                }
                // } else if ($type == 'file') {
                //     if ($database_provider == 'postgres') {
                //         $type_data =  " character varying(255)";
                //     } else {
                //         $type_data =  " varchar(255) DEFAULT NULL";
                //     }
            } else if ($type == 'email') {
                if ($database_provider == 'postgres') {
                    $type_data = " character varying(255)";
                } else {
                    $type_data = " varchar(255) DEFAULT NULL";
                }
            } else if ($type == 'number') {
                if ($database_provider == 'postgres') {
                    $type_data = " float8";
                } else {
                    $type_data = " float DEFAULT NULL";
                }
            } else if ($type == 'disabled') {
                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL";
                }
            } else if ($type == 'date') {
                if ($database_provider == 'postgres') {
                    $type_data = " date";
                } else {
                    $type_data = " date DEFAULT NULL";
                }
            } else if ($type == 'database-join') {

                if ($database_provider == 'postgres') {
                    $type_data = " numeric";
                } else {
                    $type_data = " int(11) DEFAULT NULL";
                }
            } else if ($type == 'database-costum') {
                //echo 'masuk';;

                if ($database_provider == 'postgres') {
                    $type_data = " text";
                } else {
                    $type_data = " text DEFAULT NULL";
                }
            } else if ($type == 'modalform-subkategori-add') {

                $modaform['table'][]        = $array[$i][3]['database'];
                $modaform['array'][]        = $array[$i][3]['array'];
                $modaform['database_sub'][] = $database_utama;
            } else {
                if ($database_provider == 'postgres') {
                    $type_data = " character varying(255)";
                } else {

                    $type_data = " varchar(255) DEFAULT NULL";
                }
            }
        }
        $sqlcreate .= $type_data;
        $return['type_data'] = $type_data;
        $return['sqlcreate'] = $sqlcreate;
        $return['alter']     = "ALTER TABLE $database_utama ADD $field $type_data";
        $return['field']     = $field;
        return $return;
    }
    public static function config_database_array($page)
    {
        // $config['apps_user']['db'] = "";
        $config['apps_user']['crud'] = "";
        $config['apps_user']['db']   = "";
        return $page;
    }
    public static function search_navbar_func($page)
    {
        //moesneed.id
        $config[3]['search'][] = [
            'title'      => 'Search Produk',
            "databbase"  => [
                "select"       => [

                    "*",
                    "store__produk.id as id_produk",
                ],
                "utama"        => "inventaris__asset__list_query",
                "join"         => [
                    ["store__produk", "store__produk.id_asset", "inventaris__asset__list.id"],
                ],
                "where"        => [
                    ["inventaris__asset__list.active", "=", "1"],
                ],

                "search_field" => [
                    "nama_barang",
                    "barcode",
                ],
            ],
            "view"       => ["foodmart", "ViewVertical"],
            "array_data" => [
                "CARD-TITLE" => ["database", "nama_barang"],
                "CARD-LINK"  => ["link", ["Ecommerce", "detail", "view_layout", "row:id_produk!search_navbar|"], "just_link"],
                "IMG-SRC"    => ["drive_file_from_database", "foto_aset"],
            ],
        ];
        $page['search_navbar'] = $config;
        return $page;
    }
    public static function checkout($page, $json_fe = 1, $limit = 100, $body = [])
    {
        DB::connection($page);

        //         SELECT *
        // from erp__pos__group
        //  JOIN (SELECT id_erp__pos__group,json_agg(row_to_json(t)) as list_produk FROM (SELECT * FROM erp__pos__utama__detail 
        // ) t GROUP BY t.id_erp__pos__group) as tt on  id_erp__pos__group = erp__pos__group.id
        $return                 = [];
        $db_payemnt['select'][] = "*";
        // $db_payemnt['select'][] = "(" . "SELECT json_agg(row_to_json(t)) FROM (SELECT * FROM erp__pos__utama where id_erp__pos__group = erp__pos__group.id) t) as list_toko";
        // $db_payemnt['select'][] = "(" . "SELECT json_agg(row_to_json(t)) FROM (SELECT * FROM erp__pos__utama__detail where id_erp__pos__group = erp__pos__group.id) t) as list_produk";
        $db_payemnt['utama'] = "erp__pos__group";
        if ($page['database_provider'] == 'mysql') {
            $conn = DB::getConn($page);
            $dbp  = [

                "select" => [
                    "erp__pos__utama.*,store__toko.nama_toko,kode_toko,deskripsi,alamat_toko,prioritas,id_organisasi,id_inventory_bangunan_toko,id_negara,id_provinsi,id_kota,id_kecamatan,id_kelurahan,id_pos,apps_id,logo_toko,banner_toko,platform_toko_fb,platform_toko_ig,platform_toko_wa,platform_toko_shopee,platform_toko_tiktok,id_parent,jenis_toko,id_organisasi_pemilik,jual_produk,id_store_from,tipe_mitra,id_toko_reseler,tanggal_jatuh_tempo,status_mitra,syarat_pendaftaran,id_default_pengiriman,nomor_telepon_pengirim,link_mitra,link_penjualan,deskripsi_all_produk,kota_id,provinsi_id,provinsi,type,kota_name,postal_code,rajaongkir_kota_id,
                     erp__pos__utama.id as primary_key  ",
                ],
                "utama"  => "erp__pos__utama",
                "join"   => [
                    ["store__toko", "erp__pos__utama.id_toko", "store__toko.id", 'left'],
                    ["webmaster__wilayah__kabupaten", "store__toko.id_kota", "webmaster__wilayah__kabupaten.kota_id", 'left'],

                ],
            ];
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";

            $result = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field = mysqli_fetch_field($result)) {
                $columns[] = $col = $field->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }
        $db_payemnt['join_subquery'][] = [
            [

                "as"               => "toko_utama",
                "np"               => "toko_utama",
                "not_where_active" => "toko_utama",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__group,json_agg(row_to_json(t)) as list_toko" : "id_erp__pos__group,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as list_toko",
                ],
                "utama_query"      => [

                    "as"     => "t",
                    "np"     => "erp__pos__utama",
                    "select" => [
                        "erp__pos__utama.*,store__toko.nama_toko,kode_toko,deskripsi,alamat_toko,prioritas,id_organisasi,id_inventory_bangunan_toko,id_negara,id_provinsi,id_kota,id_kecamatan,id_kelurahan,id_pos,apps_id,logo_toko,banner_toko,platform_toko_fb,platform_toko_ig,platform_toko_wa,platform_toko_shopee,platform_toko_tiktok,id_parent,jenis_toko,id_organisasi_pemilik,jual_produk,id_store_from,tipe_mitra,id_toko_reseler,tanggal_jatuh_tempo,status_mitra,syarat_pendaftaran,id_default_pengiriman,nomor_telepon_pengirim,link_mitra,link_penjualan,deskripsi_all_produk,kota_id,provinsi_id,provinsi,type,kota_name,postal_code,rajaongkir_kota_id,
                     erp__pos__utama.id as primary_key  ",
                    ],
                    "utama"  => "erp__pos__utama",
                    "join"   => [
                        ["store__toko", "erp__pos__utama.id_toko", "store__toko.id", 'left'],
                        ["webmaster__wilayah__kabupaten", "store__toko.id_kota", "webmaster__wilayah__kabupaten.kota_id", 'left'],

                    ],

                ],
                "group"            => [
                    "t.id_erp__pos__group",
                ],

            ],
            "toko_utama.id_erp__pos__group",
            "erp__pos__group.id",
        ];

        $db['select'][] = "
                store__produk.id_asset
                ,erp__pos__utama__detail.id_produk as id_produk_utama,
                erp__pos__utama__detail.id as id_detail
                ,berat
                ,berat_varian
                ,varian_barang
                ,nama_barang
                ,nama_varian
                ,store__produk.id_toko
                , concat(utama_file.path,coalesce(utama_file.file_name_save,'')) as foto_aset
                , concat(varian_file.path,coalesce(varian_file.file_name_save,'')) as foto_aset_varian

                ,erp__pos__utama__detail.*

        ";
        $db['as']     = "t";
        $db['utama']  = "erp__pos__utama__detail";
        $db['join'][] = ["store__produk", " store__produk.id", "erp__pos__utama__detail.id_produk", "inner"];
        $db['join'][] = ["store__toko", " store__toko.id", "store__produk.id_toko", "inner"];
        $db['join'][] = ["inventaris__asset__list_query", " inventaris__asset__list.id", "store__produk.id_asset", "inner"];
        $db['join'][] = ["inventaris__asset__list__varian", " inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list and cast(id_barang_varian as int) = inventaris__asset__list__varian.id", "left"];

        $db['join'][]  = ["drive__file utama_file", " (utama_file.id)", " (inventaris__asset__list.foto_aset)", "left"];
        $db['join'][]  = ["drive__file varian_file", " (varian_file.id )", " (inventaris__asset__list__varian.foto_aset_varian )", "left"];
        $db['where'][] = ["qty", ">=", 1];
        if ($page['database_provider'] == 'mysql') {

            $dbp      = $db;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";

            $result = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field = mysqli_fetch_field($result)) {
                $columns[] = $col = $field->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }

        $db_payemnt['join_subquery'][] = [
            [

                "as"               => "produk",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__group,json_agg(row_to_json(t)) as list_produk" : "id_erp__pos__group,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as list_produk",
                ],
                "utama_query"      => $db,
                "group"            => [
                    "t.id_erp__pos__group",
                ],

            ],
            "produk.id_erp__pos__group",
            "erp__pos__group.id",
        ];

        $BANGUNAN['utama']       = 'inventaris__asset__tanah__bangunan__pengisi';
        $BANGUNAN['primary_key'] = null;
        $BANGUNAN['as']          = 't';
        $BANGUNAN['np']          = true;
        $BANGUNAN['select'][]    = 'inventaris__asset__tanah__bangunan.*,
		webmaster__wilayah__provinsi.provinsi ,webmaster__wilayah__kabupaten.type,webmaster__wilayah__kabupaten.kota_name,webmaster__wilayah__kecamatan.subdistrict_name,webmaster__wilayah__postal_code.urban';
        $BANGUNAN['select'][] = 'erp__pos__group.id as id_erp__pos__group';
        $BANGUNAN['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key2';

        $BANGUNAN['join'][]  = ["erp__pos__group", "erp__pos__group.id_apps_user", "inventaris__asset__tanah__bangunan__pengisi.id_apps_user", 'left'];
        $BANGUNAN['join'][]  = ["inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "inventaris__asset__tanah__bangunan__pengisi.id_inventaris__asset__tanah__bangunan", 'left'];
        $BANGUNAN['join'][]  = ["webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "id_provinsi", 'left'];
        $BANGUNAN['join'][]  = ["webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "id_kota", 'left'];
        $BANGUNAN['join'][]  = ["webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "id_kecamatan", 'left'];
        $BANGUNAN['join'][]  = ["webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "id_kelurahan", 'left'];
        $BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan__pengisi.id_apps_user", "=", "erp__pos__group.id_apps_user", 'left'];
        $BANGUNAN['where'][] = ["inventaris__asset__tanah__bangunan.id_kota", " is ", " not null"];

        if ($page['database_provider'] == 'mysql') {
            $dbp      = $BANGUNAN;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery LIMIT 1";

            $result = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            if ($result) {

                while ($field = mysqli_fetch_field($result)) {
                    $columns[] = $col = $field->name;
                    $pairs[]   = "'$col', $alias.$col";
                }
            } else {
                echo "Query failed: " . mysqli_error($conn);
            }
        }
        $db_payemnt['join_subquery'][] = [
            [

                "as"               => "bangunan",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__group,json_agg(row_to_json(t)) as list_bangunan" : "id_erp__pos__group,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as list_bangunan",
                ],
                "utama_query"      => $BANGUNAN,
                "group"            => [
                    "t.id_erp__pos__group",
                ],

            ],
            "bangunan.id_erp__pos__group",
            "erp__pos__group.id",

            'left',
        ];
        $PAYMENT['select'][] = '*';
        $PAYMENT['select'][] = 'webmaster__payment_method.id as primary_key';
        $PAYMENT['select'][] = '(select erp__pos__group.id_payment_method from erp__pos__payment
		left join erp__pos__payment__bayar on erp__pos__payment__bayar.id_erp__pos__payment =erp__pos__payment.id
		left join erp__pos__group on erp__pos__group.id_payment =erp__pos__payment.id
		where erp__pos__group.id={LOAD_ID}) as id_payment_method';
        $PAYMENT['as']          = 't';
        $PAYMENT['utama']       = 'webmaster__payment_method';
        $PAYMENT['where'][]     = ['webmaster__payment_method.id', ' in ', "(SELECT distinct(id_payment_method) as id_payment_method from webmaster__payment_webapps WHERE id_webapps = id_web__apps| and id_workspace = ID_BOARD|)"];
        $PAYMENT['primary_key'] = null;

        // $db_payemnt['join_subquery'][] = [
        //     [

        //         "as" => "payment",
        //         "np" => "",
        //         "not_where_active" => "",
        //         "select" => [
        //             "id_erp__pos__group,json_agg(row_to_json(t)) as list_payment"
        //         ],
        //         "utama_query" =>  $PAYMENT,
        //         "group" => [
        //             "t.id_erp__pos__group"
        //         ]

        //     ],
        //     "payment.id_erp__pos__group",
        //     "erp__pos__group.id"
        // ];
        if ($body['search']['id_search'] ?? '') {

            $db_payemnt['where'][] = ["erp__pos__group.id", "=", $body['search']['id_search']];
        }
        $db_payemnt['np']           = true;
        $db_payemnt['not_checking'] = true;
        $db_payemnt['not_schema']   = true;
        $group                      = Database::database_coverter($page, $db_payemnt, [], 'all');
        '<pre>';
        $group['query'];
        // print_r($group);
        if ($group['num_rows']) {
            foreach ($group['row'] as $g) {
                $g_temp = $g;

                $return[$g->primary_key]['id']            = $g->primary_key;
                $return[$g->primary_key]['on_role']       = $g->on_role;
                $return[$g->primary_key]['create_date']   = $g->create_date;
                $return[$g->primary_key]['update_date']   = $g->update_date;
                $return[$g->primary_key]['on_domain']     = $g->on_domain;
                $return[$g->primary_key]['on_web_apps']   = $g->on_web_apps;
                $return[$g->primary_key]['privilege']     = $g->privilege;
                $return[$g->primary_key]['on_panel']      = $g->on_panel;
                $return[$g->primary_key]['on_board']      = $g->on_board;
                $return[$g->primary_key]['utama']         = $g_temp;
                $return[$g->primary_key]['list_toko']     = $g->list_toko;
                $return[$g->primary_key]['list_produk']   = $g->list_produk;
                $return[$g->primary_key]['list_bangunan'] = $g->list_bangunan;
                // $return[$g->primary_key]['list_payment'] = $g->list_payment;
                // $return[$g->primary_key]['list_voucher'] = $g->list_voucher;
            }
        }

        return $return;
    }
    public static function receivings($page, $return = "row", $spesificId = "")
    {
        $dbKonfir['select'][] = "*";
        $dbKonfir['as']       = "t";
        $dbKonfir['np']       = "t";
        $dbKonfir['utama']    = "erp__pos__inventory__receive_breakdown";
        if ($return == 'breakdown_by_receive_id') {
            $dbKonfir['where'][] = ["id_erp__pos__inventory__receive", "=", $spesificId];
            $row                 = Database::database_coverter($page, $dbKonfir, [], 'all');
            return $row['row'];
        }

        if ($page['database_provider'] == 'mysql') {

            $dbp      = $dbKonfir;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";
            $conn     = DB::getConn($page);
            $result2  = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field2 = mysqli_fetch_field($result2)) {
                $columns[] = $col = $field2->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }
        //BREAKDOWN
        $db['join_subquery'][] = [
            [

                "as"               => "outBreak",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__inventory__receive,json_agg(row_to_json(t)) as breakdown" :
                    "id_erp__pos__inventory__receive,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as breakdown",
                ],
                "utama_query"      => $dbKonfir,
                "group"            => [
                    "t.id_erp__pos__inventory__receive",
                ],

            ],
            "outBreak.id_erp__pos__inventory__receive",
            "erp__pos__inventory__receive.id",
        ];

        $db['select'][] = " erp__pos__inventory_detail.*
                        ,id_erp__pos__inventory__receive,breakdown
                        , erp__pos__inventory__receive.id as id_receive
                        , inventaris__asset__list.nama_barang
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
                        , inventaris__asset__list__varian.nama_varian,
                        erp__pos__inventory__receive.nomor_receive,
                        erp__pos__inventory__receive.tanggal_receive


                        ";
        $db['as']             = "t";
        $db['np']             = "t";
        $db['non_add_select'] = "t";
        $db['utama']          = "erp__pos__inventory_detail";
        $db['where'][]        = ["erp__pos__inventory__receive.active", "=", "1"];

        $db['join'][] = ["erp__pos__inventory__receive", " erp__pos__inventory_detail.id", "erp__pos__inventory__receive.id_erp__pos__inventory_detail", "LEFT"];

        $db['join'][] = ["inventaris__asset__list", "inventaris__asset__list.id", "id_barang_masuk"];
        $db['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "id_barang_masuk_varian", 'left'];

        if ($page['database_provider'] == 'mysql') {

            $dbp      = $db;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";
            $query;
            $conn   = DB::getConn($page);
            $result = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field = mysqli_fetch_field($result)) {
                $columns[] = $col = $field->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }

        $dbPayment['join_subquery'][] = [
            [

                "as"               => "produk",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__inventory,json_agg(row_to_json(t)) as items" :
                    "id_erp__pos__inventory,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as items",
                ],
                "utama_query"      => $db,
                "group"            => [
                    "t.id_erp__pos__inventory",
                ],

            ],
            "produk.id_erp__pos__inventory",
            "erp__pos__inventory.id",
        ];

        $dbPayment['select'][] = " erp__pos__inventory.*,items,erp__pos__utama.id_erp__pos__group";
        $dbPayment['as']       = "t";
        $dbPayment['np']       = "t";
        $dbPayment['utama']    = "erp__pos__inventory";
        $dbPayment['join'][]   = ["erp__pos__utama", 'erp__pos__utama.id', 'erp__pos__inventory.id_order', 'left'];
        if ($spesificId) {
            $dbPayment['where'][] = ["erp__pos__inventory.id_order", '=', $spesificId];
        }

        if ($return == 'row') {

            $row = Database::database_coverter($page, $dbPayment, [], 'all');
            return $row;
        } else {
            $row = Database::database_coverter($page, $dbPayment, [], 'all');
            return $row;
        }
    }
    public static function payments($page, $spesificId = "", $dbParam = [])
    {

        $dbKonfir['select'][] = "*";
        $dbKonfir['as']       = "t";
        $dbKonfir['np']       = "t";
        $dbKonfir['utama']    = "erp__pos__payment__bayar__konfirm";

        if ($page['database_provider'] == 'mysql') {

            $dbp      = $dbKonfir;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";
            $conn     = DB::getConn($page);
            $result2  = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field2 = mysqli_fetch_field($result2)) {
                $columns[] = $col = $field2->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }

        $db['join_subquery'][] = [
            [

                "as"               => "konfirm_bayar",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__payment__bayar,json_agg(row_to_json(t)) as konfirm" : "id_erp__pos__payment__bayar,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as konfirm",
                ],
                "utama_query"      => $dbKonfir,
                "group"            => [
                    "t.id_erp__pos__payment__bayar",
                ],

            ],
            "konfirm_bayar.id_erp__pos__payment__bayar",
            "erp__pos__payment__bayar.id",
        ];

        $db['select'][] = " erp__pos__payment__bayar.*,
                        nama_payment,kode_payment,
                        kode_brand,nama_brand,konfirm_bayar.konfirm ";
        $db['as']    = "t";
        $db['np']    = "t";
        $db['utama'] = "erp__pos__payment__bayar";

        $db['join'][] = ["webmaster__payment_method", " webmaster__payment_method.id", "id_metode_bayar", "LEFT"];
        $db['join'][] = ["webmaster__payment_method_brand", " webmaster__payment_method_brand.id", "id_payment_brand", "LEFT"];

        if ($page['database_provider'] == 'mysql') {

            $dbp      = $db;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";
            $query;
            $conn   = DB::getConn($page);
            $result = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            while ($field = mysqli_fetch_field($result)) {
                $columns[] = $col = $field->name;
                $pairs[]   = "'$col', $alias.$col";
            }
        }

        $dbPayment['join_subquery'][] = [
            [

                "as"               => "split_bill",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres' ? "id_erp__pos__payment,json_agg(row_to_json(t)) as split_bill" : "id_erp__pos__payment,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as split_bill",
                ],
                "utama_query"      => $db,
                "group"            => [
                    "t.id_erp__pos__payment",
                ],

            ],
            "split_bill.id_erp__pos__payment",
            "erp__pos__payment.id",
        ];

        $dbPayment['select'][] = " *";
        $dbPayment['as']       = "t";
        $dbPayment['np']       = "t";
        $dbPayment['utama']    = "erp__pos__payment";
        if (isset($dbParam['utama'])) {
            foreach ($dbParam['utama'] as $key => $utama) {
                if (is_array($utama)) {
                    foreach ($utama as $subKey => $subVal) {
                        $dbPayment[$key][$subKey] = $subVal;
                    }
                } else {
                    // Kalau bukan array (string, int, dsb)
                    $dbPayment[$key] = $utama;
                }
            }
        }
        if ($spesificId) {
            $dbPayment['where'][] = ["erp__pos__payment.id", "=", $spesificId];
        }

        $row = Database::database_coverter($page, $dbPayment, [], 'all');
        return $row;
    }
    public static function purchase_order($page, $spesificId = "")
    {
        $db['select'][] = "
                            store__produk.id_asset
                            ,erp__pos__utama__detail.id_produk as id_produk_utama,
                            erp__pos__utama__detail.id as id_detail
                            ,berat
                            ,berat_varian
                            ,varian_barang
                            ,nama_barang
                            ,nama_varian
                            ,barcode_varian as barcode
                            ,store__produk.id_toko
                            ,erp__pos__utama__detail.*

                    ";
        $db['as']     = "t";
        $db['np']     = "t";
        $db['utama']  = "erp__pos__utama__detail";
        $db['join'][] = ["store__produk", " store__produk.id", "erp__pos__utama__detail.id_produk", "LEFT"];
        $db['join'][] = ["store__toko", " store__toko.id", "store__produk.id_toko", "LEFT"];
        $db['join'][] = ["inventaris__asset__list_query", " inventaris__asset__list.id", "erp__pos__utama__detail.id_inventaris__asset__list", "LEFT"];
        $db['join'][] = ["inventaris__asset__list__varian", " inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list and cast(id_barang_varian as int) = inventaris__asset__list__varian.id", "LEFT"];

        $db['where'][] = ["qty", ">=", 1];
        $db['where'][] = ["erp__pos__utama__detail.active", "=", 1];
        if ($page['database_provider'] == 'mysql') {

            $dbp      = $db;
            $getquery = Database::database_coverter($page, $dbp, [], 'source');
            $query    = "$getquery  LIMIT 1";
            $conn     = DB::getConn($page);
            $result   = mysqli_query($conn, $query);

            // Ambil nama kolom dari hasil query
            $columns = [];
            $pairs   = [];
            $alias   = "t";
            if ($result && mysqli_num_fields($result) > 0) {
                while ($field = mysqli_fetch_field($result)) {
                    $columns[] = $col = $field->name;
                    $pairs[]   = "'$col', $alias.$col";
                }
            } else {
                $pairs[] = "'empty', NULL";
            }
        }

        $dbGroup['join_subquery'][] = [
            [

                "as"               => "produk",
                "np"               => "",
                "not_where_active" => "",
                "select"           => [
                    $page['database_provider'] == 'postgres'
                        ? "id_erp__pos__group,json_agg(row_to_json(t)) as items"
                        : "id_erp__pos__group,JSON_ARRAYAGG(JSON_OBJECT(" . implode(', ', $pairs) . ")) as items",
                ],
                "utama_query"      => $db,
                "group"            => [
                    "t.id_erp__pos__group",
                ],

            ],
            "produk.id_erp__pos__group",
            "erp__pos__group.id",
        ];

        $dbGroup['np']       = "erp__pos__group";
        $dbGroup['select'][] = "erp__pos__group.*,'process' as status
        ,erp__pos__utama.id as id_utama
        ,(select sum(grand_total)
         FROM erp__pos__utama__detail where erp__pos__utama__detail.id_erp__pos__group=erp__pos__group.id) as total
        ,items";
        $dbGroup['utama']   = "erp__pos__group";
        $dbGroup['where'][] = ["tipe_group", "=", "'Pembelian Barang'"];
        $dbGroup['join'][]  = ["erp__pos__utama", "erp__pos__utama.id_erp__pos__group", "erp__pos__group.id", 'left'];
        $dbGroup['order'][] = ["erp__pos__group.id", "desc"];
        if ($spesificId) {
            $dbGroup['where'][] = ["erp__pos__group.id", "=", $spesificId];
        }
        $row = Database::database_coverter($page, $dbGroup, [], 'all');
        return $row;
    }
    public static function all_produk($page, $json_fe = 1, $limit = 100, $body=[])
    {
        ini_set('memory_limit', '2024M');
        // $db_produk['select'][] = "
        //         store__produk.*,
        //         store__produk.id as primary_key,
        //         inventaris__asset__list.nama_barang,
        //         inventaris__asset__list.deskripsi_barang ,
        //         inventaris__asset__list.barcode,  
        //         concat(utama_file.path,coalesce(utama_file.file_name_save,'')) as foto_aset,
        //         store__produk.id_toko,
        //         store__toko.nama_toko,
        //         store__toko.deskripsi_all_produk,

        //         store__produk__varian.id as id_produk_varian,
        //         inventaris__asset__list.varian_barang,nama_varian,
        //         sku_index_varian, 
        //         concat(varian_file.path,coalesce(varian_file.file_name_save,'')) as foto_aset_varian,
        // 		    inventaris__asset__list__varian.nama_tipe_tipe1,
        // 		    inventaris__asset__list__varian.nama_tipe_tipe2,
        // 		    inventaris__asset__list__varian.nama_tipe_tipe3,
        //             nama_list_tipe_varian_varian1,
        // 			nama_list_tipe_varian_varian,
        // 			nama_list_tipe_varian_varian3,
        //             id_tipe_varian_1,id_tipe_varian_2,id_tipe_varian_3,
        //             id_varian_1,id_varian_2,id_varian_3,id_kategori,id_brand,
        //         id_asset,id_barang_varian,berat_varian,berat,barcode_varian, 
        //         case when varian_barang='1' then 1 else 0 end as count_varian, 
        //         store__produk__varian.harga_pokok_penjualan_varian,
        //         case when varian_barang='1' then store__produk__varian.harga_pokok_penjualan_varian else  store__produk.harga_pokok_penjualan end harga_pokok,total_terjual_varian,total_jual,coalesce(stok_available,0) as stok_available,
        //         store__produk.create_date,store__produk.update_date  ";
        // $db_produk['utama'] = "store__produk";
        // $db_produk['join'][] = ["inventaris__asset__list_query", "inventaris__asset__list.id", " store__produk.id_asset", "inner"];
        // $db_produk['join'][] = ["drive__file utama_file", " (utama_file.id)", " (inventaris__asset__list.foto_aset)", "left"];
        // $db_produk['join'][] = ["store__toko ", " store__toko.id", " store__produk.id_toko", "left"];
        // $db_produk['join'][] = ["store__produk__varian", "store__produk__varian.id_store__produk", "  store__produk.id", "left"];
        // $db_produk['join'][] = ["inventaris__asset__list__varian", "inventaris__asset__list__varian.id", "store__produk__varian.id_barang_varian", "left"];
        // $db_produk['join'][] = ["drive__file varian_file", " (varian_file.id )", " (inventaris__asset__list__varian.foto_aset_varian )", "left"];
        // $db_produk['join'][] = ["(SELECT sum(coalesce(stok_available,0)) as stok_available,id_produk,id_produk_varian from 
        // (SELECT id_produk,id_produk_varian,id_ruang_simpan,stok_available 
        // FROM
        // 		inventaris__storage__data 
        // GROUP BY id_produk,connect_api_name,id_ruang_simpan
        // order by stok_available desc
        // ) as s
        // GROUP BY id_produk,id_produk_varian) storage", " storage.id_produk", " store__produk.id and storage.id_produk_varian = store__produk__varian.id", "left"];
        // $db_produk['order'][] = ["store__produk.id", "desc"];
        // //$db_produk['limit_raw'] = "1";
        // 
        $db_produk['utama'] = "view_produk_detail";
        //$db_produk['utama'] = "view_all_produk_stok";
        if (isset($body['search']['id_produk'])) {
            $db_produk['where'][] = [$db_produk['utama'] . ".id", "=", $body['search']['id_produk']];
        }
        if (isset($body['search']['id_produk_varian'])) {
            $db_produk['where'][] = [$db_produk['utama'] . ".id_produk_varian", "=", $body['search']['id_produk_varian']];
        }
        if (isset($body['search']['limit'])) {
            $db_produk['limit'] = $body['search']['limit'];
        }
        $db_produk['np'] = true;
        $produk          = Database::database_coverter($page, $db_produk, [], 'all');
        // echo '<pre>';echo $produk['query'];die;
        $stok = 0;
        if ($json_fe) {
            $return = [];
            foreach ($produk['row'] as $row) {
                $stok                                          = $row->stok_available ?? 0;
                $return[$row->primary_key]['id']               = $row->primary_key;
                $return[$row->primary_key]['nama_barang']      = $row->nama_barang;
                $return[$row->primary_key]['deskripsi_barang'] = $row->deskripsi_all_produk . ' ' . $row->deskripsi_barang;
                $return[$row->primary_key]['foto_aset']        = $row->foto_aset ? $row->foto_aset : str_replace('index.php/', '', base_url()) . 'image_placeholder.jpg';
                $return[$row->primary_key]['barcode']          = $row->barcode;
                $return[$row->primary_key]['berat']            = $row->berat;
                $return[$row->primary_key]['id_asset']         = $row->id_asset;
                $return[$row->primary_key]['id_kategori']      = $row->id_kategori;
                $return[$row->primary_key]['id_brand']         = $row->id_brand;
                $return[$row->primary_key]['total_jual']       = $row->total_jual;
                $return[$row->primary_key]['varian_barang']    = $row->varian_barang;
                $return[$row->primary_key]['id_toko']          = $row->id_toko;
                $return[$row->primary_key]['nama_toko']        = $row->nama_toko;
                $return[$row->primary_key]['create_date']      = $row->create_date;
                $return[$row->primary_key]['update_date']      = $row->update_date;
                $return[$row->primary_key]['on_web_apps']      = $row->on_web_apps;
                $return[$row->primary_key]['on_domain']        = $row->on_domain;
                $return[$row->primary_key]['on_panel']         = $row->on_panel;
                $return[$row->primary_key]['on_board']         = $row->on_board;
                $return[$row->primary_key]['on_role']          = $row->on_role;
                $return[$row->primary_key]['privilege']        = $row->privilege;
                $return[$row->primary_key]['nama_varian'] = ($return[$row->primary_key]['nama_varian'] ?? '') . (isset($return[$row->primary_key]['nama_varian']) ? ' ' : '') . $row->nama_varian;
                if (! isset($return[$row->primary_key]['harga_awal'])) {
                    $return[$row->primary_key]['harga_awal'] = $row->varian_barang == 1 ? $row->harga_pokok_penjualan_varian : $row->harga_pokok_penjualan;
                } else {
                    $harga = $row->varian_barang == 1 ? $row->harga_pokok_penjualan_varian : $row->harga_pokok_penjualan;
                    if ($harga < $return[$row->primary_key]['harga_awal']) {
                        $return[$row->primary_key]['harga_awal'] = $harga;
                    }
                }
                if (! isset($return[$row->primary_key]['harga_akhir'])) {
                    $return[$row->primary_key]['harga_akhir'] = $row->varian_barang == 1 ? $row->harga_pokok_penjualan_varian : $row->harga_pokok_penjualan;
                } else {
                    $harga = $row->varian_barang == 1 ? $row->harga_pokok_penjualan_varian : $row->harga_pokok_penjualan;
                    if ($harga > $return[$row->primary_key]['harga_akhir']) {
                        $return[$row->primary_key]['harga_akhir'] = $harga;
                    }
                }

                $return[$row->primary_key]['harga_full'] = $return[$row->primary_key]['harga_awal'] == $return[$row->primary_key]['harga_akhir'] ? Partial::rupiah($return[$row->primary_key]['harga_awal']) : Partial::rupiah($return[$row->primary_key]['harga_awal']) . ' s/d ' . Partial::rupiah($return[$row->primary_key]['harga_akhir']);
                $lainnya['id_varian']                    = ($row->id_barang_varian ?? -1);
                // $get_stok = ErpPosApp::get_stok($page, 0, "", "", ($row->id_asset ?? -1), 'exe_rekap_akhir_total_asset', $lainnya);
                // if($stok['row'][0]->stok){

                //     print_R($stok);
                //     die;
                // }
                // $stok =  0;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_varian']             = $row->nama_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['harga_pokok_varian']      = $row->harga_pokok_penjualan_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['sku_index_varian']        = $row->sku_index_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['terjual_varian']          = $row->total_terjual_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['barcode_varian']          = $row->barcode_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['berat_varian']            = $row->berat_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_tipe_varian_1']        = $row->id_tipe_varian_1;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_tipe_varian_2']        = $row->id_tipe_varian_2;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_tipe_varian_3']        = $row->id_tipe_varian_3;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_varian_1']             = $row->id_varian_1;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_varian_2']             = $row->id_varian_2;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_varian_3']             = $row->id_varian_3;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_1'] = $row->nama_list_tipe_varian_varian1 ?? '';
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_2'] = $row->nama_list_tipe_varian_varian ?? '';
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_3'] = $row->nama_list_tipe_varian_varian3 ?? '';
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['id_barang_varian']        = $row->id_barang_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['gambar_produk_varian']    = $row->foto_aset_varian;
                $return[$row->primary_key]['varian'][$row->id_produk_varian]['stok']                    = $stok;

                // $return[$row->primary_key]['list_varian']["tipe_1"]['data'] = $row->nama_list_tipe_varian_varian1;
                // $return[$row->primary_key]['list_varian']["tipe_2"]['data'] = $row->nama_list_tipe_varian_varian;
                // $return[$row->primary_key]['list_varian']["tipe_3"]['data'] = $row->nama_list_tipe_varian_varian3;

                if (! isset($return[$row->primary_key]['list_varian']['tipe_1'])) {
                    $return[$row->primary_key]['list_varian']['tipe_1']['detail'] = [];
                }

                if (! isset($return[$row->primary_key]['list_varian']['tipe_2'])) {
                    $return[$row->primary_key]['list_varian']['tipe_2']['detail'] = [];
                }

                if (! isset($return[$row->primary_key]['list_varian']['tipe_3'])) {
                    $return[$row->primary_key]['list_varian']['tipe_3']['detail'] = [];
                }

                $return[$row->primary_key]['list_varian_detail']['all'][$row->id_varian_1 . '-' . $row->id_varian_2 . '-' . $row->id_varian_3] = $row->id_produk_varian;
                $return[$row->primary_key]['nama_variasi'][1]                                                                                  = $row->nama_tipe_tipe1;
                $return[$row->primary_key]['nama_variasi'][2]                                                                                  = $row->nama_tipe_tipe2;
                $return[$row->primary_key]['nama_variasi'][3]                                                                                  = $row->nama_tipe_tipe3;
                if (! $row->nama_tipe_tipe1) {
                    $max = 0;
                }
                if (! $row->nama_tipe_tipe2) {
                    $max = 1;
                }
                if (! $row->nama_tipe_tipe3) {
                    $max = 2;
                } else {
                    $max = 3;
                }
                $return[$row->primary_key]['max_variasi'] = $max;

                if (! isset($return[$row->primary_key]['list_varian']['tipe_1']['detail'])) {
                    $return[$row->primary_key]['list_varian']['tipe_1']['detail'] = [];
                }
                if (! isset($return[$row->primary_key]['list_varian']['tipe_2']['detail'])) {
                    $return[$row->primary_key]['list_varian']['tipe_2']['detail'] = [];
                }
                if (! isset($return[$row->primary_key]['list_varian']['tipe_3']['detail'])) {
                    $return[$row->primary_key]['list_varian']['tipe_3']['detail'] = [];
                }

                $return[$row->primary_key]['stok'] = ($return[$row->primary_key]['stok'] ?? 0) + $stok;

                $return[$row->primary_key]['stok_detail'][$row->id_varian_1] = ($return[$row->primary_key]['stok_detail'][$row->id_varian_1] ?? 0) + $stok;

                $return[$row->primary_key]['stok_detail'][$row->id_varian_1 . '-' . $row->id_varian_2] = ($return[$row->primary_key]['stok_detail'][$row->id_varian_1 . '-' . $row->id_varian_2] ?? 0) + $stok;

                $min_price = &$return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_awal'];
                if (!isset($min_price) || $row->harga_pokok_penjualan_varian < $min_price) {
                    $min_price = $row->harga_pokok_penjualan_varian;
                }
                $max_price = &$return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_akhir'];
                if (!isset($max_price) || $row->harga_pokok_penjualan_varian > $max_price) {
                    $max_price = $row->harga_pokok_penjualan_varian;
                }
                $return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_full'] = $return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_awal'] == $return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_akhir'] ? Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_awal']) : Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_awal']) . ' s/d ' . Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1]['harga_akhir']);

                $min_price2 = &$return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_awal'];
                if (!isset($min_price2) || $row->harga_pokok_penjualan_varian < $min_price2) {
                    $min_price2 = $row->harga_pokok_penjualan_varian;
                }
                $max_price2 = &$return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_akhir'];
                if (!isset($max_price2) || $row->harga_pokok_penjualan_varian > $max_price2) {
                    $max_price2 = $row->harga_pokok_penjualan_varian;
                }
                $return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_full'] = $return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_awal'] == $return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_akhir'] ? Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_awal']) : Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_awal']) . ' s/d ' . Partial::rupiah($return[$row->primary_key]['harga_detail'][$row->id_varian_1 . '-' . $row->id_varian_2]['harga_akhir']);

                $return[$row->primary_key]['foto_detail'][$row->id_varian_1]                           = $row->foto_aset_varian;
                $return[$row->primary_key]['foto_detail'][$row->id_varian_1 . '-' . $row->id_varian_2] = $row->foto_aset_varian;

                $return[$row->primary_key]['list_varian']['tipe_1']['detail'][] = [
                    "nama_varian" => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_1'],
                    "id_varian"   => $row->id_varian_1,
                    "level"       => 1,
                ];

                $return[$row->primary_key]['list_varian']['tipe_2']['detail'][] = [
                    "nama_varian" => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_2'],
                    "id_varian"   => $row->id_varian_2,
                    "level"       => 2,
                ];
                $return[$row->primary_key]['list_varian']['tipe_2']['breakdown'][2][$row->id_varian_1][] = [
                    "nama_varian" => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_2'],
                    "id_varian"   => $row->id_varian_1 . '-' . $row->id_varian_2,
                    "id_varian2"  => $row->id_varian_2,
                    "level"       => 2,
                ];

                $return[$row->primary_key]['list_varian']['tipe_2']['breakdown'][3][$row->id_varian_1][] = [
                    "nama_varian" => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_3'],
                    "id_varian"   => $row->id_varian_1 . '-' . $row->id_varian_2 . '-' . $row->id_varian_3,
                    "id_varian2"  => $row->id_varian_2,
                    "id_varian3"  => $row->id_varian_3,
                    "level"       => 3,
                ];

                $return[$row->primary_key]['list_varian']['tipe_3']['detail'][]                                                    = ["nama_varian" => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_3'], "id_varian" => $row->id_varian_1 . '-' . $row->id_varian_2 . '-' . $row->id_varian_3, "level" => 3];
                $return[$row->primary_key]['list_varian']['tipe_3']['breakdown'][3][$row->id_varian_1 . '-' . $row->id_varian_2][] = [
                    "nama_varian"      => $return[$row->primary_key]['varian'][$row->id_produk_varian]['nama_list_tipe_varian_3'],
                    "id_varian"        => $row->id_varian_1 . '-' . $row->id_varian_2 . '-' . $row->id_varian_3,
                    "level"            => 3,
                    "foto_aset_varian" => $row->foto_aset_varian,
                ];
            }
        } else {
            $return = $produk['row'];
        }

        return $return;
    }
    public static function new_produk_last($page, $limit)
    {
        return "SELECT

            ,
            store__produk.id as id_produk,
            drive__file.*
        FROM
            inventaris__asset__list

            JOIN store__produk on inventaris__asset__list.id=store__produk.id_asset
            LEFT JOIN drive__file ON cast(inventaris__asset__list.foto_aset as char) = cast(drive__file.id as char)
             WHERE 1=1 WORKSPACE_SINGLE_TOKO_WHERE|
			ORDER BY (case when store__produk.tgl_publish is not null then store__produk.tgl_publish when store__produk.create_date is not null then store__produk.create_date else inventaris__asset__list.create_date end ) desc
            LIMIT $limit";
    }
    public static function new_produk($page, $limit)
    {
        $db['select'][] = "store__produk.id as id_produk";
        $db['select'][] = " inventaris__asset__list.id as id_inventaris__asset__list";
        $db['select'][] = "inventaris__asset__list.nama_barang";
        $db['select'][] = "drive__file.*";
        $db['utama']    = "inventaris__asset__list_query";
        $db['join'][]   = ["store__produk", "inventaris__asset__list.id", "store__produk.id_asset"];
        // $db['join'][] = ["drive__file", "
        // case 
        // 			        when inventaris__asset__list.asal_barang_dari ='Master' and inventaris__asset__list.foto_aset is null then inventaris__asset__list_master.foto_aset::text 
        // 			        else 
        // 			    end", "drive__file.id::text", "left"];
        $db['join'][] = ["drive__file", "cast(inventaris__asset__list.foto_aset as char)", "cast(drive__file.id as char)", "left"];
        // $db['where'][] = ["1=","=","1"];
        $db['where'][] = ["1=1", "", " WORKSPACE_SINGLE_TOKO_WHERE|"];
        $db['where'][] = ["inventaris__asset__list.active", "=", " 1"];
        $get           = Database::database_coverter($page, $db, [], 'source');

        return $get . "
			ORDER BY (case when store__produk.tgl_publish is not null then store__produk.tgl_publish when store__produk.create_date is not null then store__produk.create_date else inventaris__asset__list.create_date end ) desc
            LIMIT $limit";
    }

    public static function best_seller($page, $limit)
    {
        return "SELECT
            inventaris__asset__list.id as id_inventaris__asset__list,
            inventaris__asset__list.nama_barang,
            store__produk.id as id_produk,
            detail.*,
            drive__file.*
        FROM
            inventaris__asset__list
            LEFT JOIN (SELECT id_inventaris__asset__list,

                            sum(COALESCE ( qty, 0 )) AS qty,
                            sum(COALESCE ( harga_penjualan, 0 )) AS harga_penjualan,
                            sum(COALESCE ( diskon_utama, 0 )) AS diskon_utama,
                            sum(COALESCE ( grand_total, 0 )) AS grand_total

                            FROM erp__pos__utama__detail GROUP BY id_inventaris__asset__list ) detail ON detail.id_inventaris__asset__list = inventaris__asset__list.id
            JOIN store__produk on inventaris__asset__list.id=store__produk.id_asset
            LEFT JOIN drive__file ON cast(inventaris__asset__list.foto_aset as char) = cast(drive__file.id as char)
            -- LEFT JOIN drive__file ON ref_external_id=inventaris__asset__list.id AND((ref_database='ltw_inventaris__asset__list') or ref_database='inventaris__asset__list') AND support='Sampul' AND cast(sizes as int)>0
            WHERE detail.qty >0 WORKSPACE_SINGLE_TOKO_WHERE| and inventaris__asset__list.active=1
            ORDER BY detail.qty desc,grand_total desc
            LIMIT $limit
                            ";
    }
    public static function home_banner($page)
    {
        $db['utama']   = "website__bundles__master__banner__content";
        $db['join'][]  = ["website__bundles__master__banner", "website__bundles__master__banner__content.id_website__bundles__master__banner", "website__bundles__master__banner.id"];
        $db['join'][]  = ["drive__file", "cast(drive__file.id as CHAR)", "cast(website__bundles__master__banner__content.file as CHAR)"];
        $db['where'][] = ["id_web_apps", "=", $page['load']['id_web__apps']];
        $db['where'][] = ["kode_banner", "=", "'Home Banner'"];
        $db['where'][] = ["website__bundles__master__banner__content.active", "=", "1"];
        $get           = Database::database_coverter($page, $db, [], 'source');
        return $get;
    }
    public static function dashboard_pesanan_erp_pos($page)
    {
        return "SELECT
                    sum( CASE WHEN belum_bayar = 1 THEN 1 ELSE 0 END ) AS count_belum_bayar,
                    sum( CASE WHEN perlu_proses = 1 AND COALESCE ( belum_bayar, 1 ) = 0 THEN 1 ELSE 0 END ) AS count_perlu_proses,
                    sum( CASE WHEN COALESCE ( belum_bayar, 1 ) = 0 THEN perlu_kirim ELSE 0 END ) AS count_perlu_kirim,
                    sum( CASE WHEN hole.status_pickup = 'Belum' AND COALESCE ( belum_bayar, 1 ) = 0 THEN perlu_kirim ELSE 0 END ) AS count_menunggu_pickup,
                    sum( CASE WHEN upper( status_pesanan ) = 'SELESAI' THEN grand_total ELSE 0 END ) AS omzet,
                    sum( CASE WHEN upper( status_pesanan ) NOT IN ( 'AKTIF', 'SELESAI', 'MENUNGGU PEMBAYARAN', 'REVIEW' ) THEN grand_total ELSE 0 END ) AS omzet_ditahan,
                    sum( CASE WHEN upper( status_pesanan ) = 'SELESAI' THEN qty ELSE 0 END ) AS qty_terjual,
                    sum( CASE WHEN hole.status_pickup != 'Belum' THEN qty_kirim ELSE 0 END ) AS qty_terkirim,
                    sum( count_selesai ) AS pesanan_selesai,
                    sum( count_proses ) AS pesanan_proses
                FROM
                    (
                        SELECT
                            erp__pos__utama.id AS primary_key,
                            COALESCE ( qty_pesan, 0 ) AS qty_pesan,
                            COALESCE ( qty_out, 0 ) AS qty_out,
                            COALESCE ( count_belum_bayar, 1 ) AS belum_bayar,
                            COALESCE ( kirim.status_pickup, 'Belum' ) AS status_pickup,
                            COALESCE ( qty_kirim, 0 ) AS qty_kirim,
                            ( CASE WHEN COALESCE ( qty_pesan, 0 ) > COALESCE ( qty_out, 0 ) THEN 1 ELSE 0 END ) AS perlu_proses,
                            COALESCE ( qty_pesan, 0 ) - COALESCE ( qty_kirim, 0 ) AS perlu_kirim,
                            erp__pos__utama__detail.id,
                            erp__pos__utama__detail.id_erp__pos__utama,
                            COALESCE ( erp__pos__utama__detail.qty, 0 ) AS qty,
                            harga_penjualan,
                            diskon_utama,
                            COALESCE ( grand_total, 0 ) AS grand_total,
                            COALESCE ( erp__pos__utama.status_pesanan, 'aktif' ) AS status_pesanan,
                            ( CASE WHEN upper( COALESCE ( erp__pos__utama.status_pesanan, 'aktif' ) ) = 'SELESAI' THEN 1 ELSE 0 END ) AS count_selesai,
                            ( CASE WHEN upper( COALESCE ( erp__pos__utama.status_pesanan, 'aktif' ) ) != 'SELESAI' THEN 1 ELSE 0 END ) AS count_proses
                        FROM
                            erp__pos__utama__detail
                            JOIN erp__pos__utama ON erp__pos__utama__detail.id_erp__pos__utama = erp__pos__utama.id
                            LEFT JOIN ( SELECT id_erp__pos__utama, sum( erp__pos__utama__detail.qty ) AS qty_pesan FROM erp__pos__utama__detail GROUP BY id_erp__pos__utama ) detail ON detail.id_erp__pos__utama = erp__pos__utama.id
                            LEFT JOIN (
                                        SELECT
                                            id,
                                            count( CASE WHEN upper( erp__pos__payment.status_payment ) = 'AKTIF' THEN 1 ELSE 0 END ) AS count_belum_bayar
                                        FROM
                                            erp__pos__payment
                                        GROUP BY
                                            id
                            ) payment ON payment.id = erp__pos__utama.id_payment
                            LEFT JOIN (
                                        SELECT
                                            erp__pos__utama__detail.id_erp__pos__utama,
                                            sum( erp__pos__inventory__outgoing_breakdown.qty_keluar_out ) AS qty_out
                                        FROM
                                            erp__pos__inventory_detail
                                            LEFT JOIN erp__pos__utama__detail ON erp__pos__utama__detail.id = CAST(erp__pos__inventory_detail.id_erp__pos__utama__detail_get as INT)
                                            LEFT JOIN erp__pos__inventory__outgoing ON erp__pos__inventory_detail.id = erp__pos__inventory__outgoing.id_erp__pos__inventory_detail
                                            LEFT JOIN erp__pos__inventory__outgoing_breakdown ON erp__pos__inventory__outgoing.id = id_erp__pos__inventory__outgoing
                                        GROUP BY
                                            erp__pos__utama__detail.id_erp__pos__utama
                            ) AS outgoing ON erp__pos__utama.id = outgoing.id_erp__pos__utama
                            LEFT JOIN (
                                        SELECT
                                            erp__pos__delivery_order.id_erp__pos__utama,
                                            COALESCE ( status_pickup_kurir, 'Belum' ) AS status_pickup,
                                            sum( erp__pos__delivery_order__detail.qty_kirim ) AS qty_kirim
                                        FROM
                                            erp__pos__delivery_order
                                            LEFT JOIN erp__pos__delivery_order__detail ON erp__pos__delivery_order__detail.id_erp__pos__delivery_order = erp__pos__delivery_order.id
                                        GROUP BY
                                            erp__pos__delivery_order.id_erp__pos__utama,
                                            status_pickup_kurir
                            ) kirim ON erp__pos__utama.id = kirim.id_erp__pos__utama
                    ) AS hole";
    }
    public static function get_id_apps($page)
    {
        if ($page['load_section'] != 'viewsource') {

            if (isset($page['load']['menu'])) {
                $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "' and load_page_view = '" . $page['load']['page_view'] . "' and load_menu = '" . $page['load']['menu'] . "' "));
                if (! $db) {
                    $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "' and load_page_view = '" . $page['load']['page_view'] . "'  "));
                }
            } else {
                $db = "";
            }
            if (! $db) {
                $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "'   "));
            }
            if ($db) {
                $id = $db[0]->id_web__list_apps;
            } else {
                $id = null;
            }

            return $id;
        } else {
            return null;
        }
    }
}
