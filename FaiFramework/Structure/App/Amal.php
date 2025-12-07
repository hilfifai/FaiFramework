<?php

class Amal
{
    public static function dashboard($page)
    {


        $data1 = new stdClass();
        $data1->count_belum_bayar = 0;
        $data1->count_perlu_proses = 0;
        $data1->count_perlu_kirim = 0;
        $data1->count_menunggu_pickup = 0;
        $data2 = new stdClass();
        $data2->omzet = 0;
        $data2->omzet_ditahan = 0;
        $data2->saldo = 0;
        $data2->rata_rata = 0;
        $i = 0;
        $website['content'][$i]['tag'] = "BE3-EC-D1";
        $website['content'][$i]['col_row'] = "col-md-12";
        $website['content'][$i]['data'] =  $data1;

        $i++;
        $website['content'][$i]['tag'] = "BE3-EC-D3";
        $website['content'][$i]['col_row'] = "col-lg-6 col-md-12 col-sm-12";
        $website['content'][$i]['data'] =  $data2;
        $i++;

        $i++;
        $page['load']['tipe_sidebar'] = "Beranda";
        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
    public static function board($page)
    {

        if(Partial::input('search')){
            $_POST['id_board'] = Partial::input('search');
        }
        if ($page['load']['type'] == 'list_board_amalan') {

            $i = 0;
            $website['content'][$i]['tag'] = "";
            $website['content'][$i]['content_source'] = "html";
            $website['content'][$i]['html'] = "<CONTENT></CONTENT>";
            $website['content'][$i]['template_file'] = "HabitsBoard.template";
            $website['content'][$i]['template_array'] = array(


                array(
                    "tag" => 'CONTENT',
                    "refer" => "database_list",
                    "source_list" => "template",
                    "database_refer" => "Board Amalan",
                    "template_name" => "beegrit",
                    "template_file" => "HabitsBoardList.template",
                    "array" => array(
                        "NAMA" => array("refer" => "database", "row" => "nama_board"),
                        "IDBOARD" => array("refer" => "database", "row" => "primary_key"),
                        // "PANEL"=>array("refer"=>"database","row"=>"answer"),
                        // "NO"=>array("refer"=>"no"),
                    )
                ),
            );
            $page['website'] = $website;
            $page['config']['database']['Board Amalan']['utama'] = 'ltw_kegiatan__board';
            $page['config']['database']['Board Amalan']['primary_key'] = 'id';
            $page['config']['database']['Board Amalan']['join'][] = array("ltw_kegiatan__board__user", "ltw_kegiatan__board__user.id_ltw_kegiatan__board", "ltw_kegiatan__board.id");
            $page['config']['database']['Board Amalan']['where'][] = array("id_user", "=", "'" . $_SESSION['id_apps_user'] . "'");
            if (Partial::input('search')) {

                $page['config']['database']['Board Amalan']['where'][] = array("nama_board", "=", "'" . Partial::input('search') . "'");
            }

            $page['config']['database']['Board Amalan']['order'][] = array("nama_board", "asc");
            echo Packages::view_website($page, '');
            die;
        } else    if ($page['load']['type'] == 'content_board') {
            $i = 0;
            $website['content'][$i]['tag'] = "";
            $website['content'][$i]['content_source'] = "html";
            $website['content'][$i]['html'] = "<CONTENT></CONTENT>";
            $website['content'][$i]['template_array'] = array(


                array(
                    "tag" => 'CONTENT',
                    "refer" => "database_list",
                    "source_list" => "template",
                    "database_refer" => "Board Amalan",
                    "template_name" => "beegrit",
                    "template_file" => "HabitsBoardContent.template",
                    "array" => array(
                        "NAMA" => array("refer" => "database", "row" => "nama_board"),
                        "IDBOARD" => array("refer" => "database", "row" => "primary_key"),
                        "LIST-ANGGOTA" => array(
                            "refer" => "database_list",
                            "database_refer" => "Anggota",
                            "source_list" => "template",
                            "template_name" => "beegrit",
                            "template_file" => "HabitsBoardListAnggota.template",
                            "array" => array(
                                "NAMA-LENGKAP" => array("refer" => "database", "row" => "nama_board"),
                                "ROLE" => array("refer" => "database", "row" => "sebagai"),
                            ),
                        ),
                        "LIST-ANGGOTAMENUNGGU" => array(
                            "refer" => "database_list",
                            "database_refer" => "AnggotaMenunggu",
                            "source_list" => "template",
                            "template_name" => "beegrit",
                            "template_file" => "HabitsBoardListAnggota.template",
                            "array" => array(
                                "NAMA-LENGKAP" => array("refer" => "database", "row" => "nama_board"),
                                "ROLE" => array("refer" => "database", "row" => "sebagai"),
                            ),
                        ),
                        "LIST-AMALAN" => array(
                            "refer" => "database_list",
                            "database_refer" => "AMALAN",
                            "source_list" => "template",
                            "template_name" => "beegrit",
                            "template_file" => "HabitsBoardListAmalan.template",
                            "array" => array(
                                "NAMA-AMALAN" => array("refer" => "database", "row" => "nama_kegiatan"),
                                "ID_BOARD" => array("refer" => "database", "row" => "id_board"),
                                "ID_LIST" => array("refer" => "database", "row" => "primary_key"),
                                "ID_TASK" => array("refer" => "database", "row" => "id_task"),
                                "LIST-TARGET" => array(
                                    "refer" => "database_list",
                                    "database_refer" => "-1",
                                    "database" => [
                                        "utama" => 'ltw_kegiatan__list__breakdown_target',
                                        "where_get_array" => array(
                                            array(
                                                "row" => "id_ltw_kegiatan__list",
                                                "array_row" => "database_list_template_on_list",
                                                "get_row" => "primary_key"
                                            ),
                                        ),

                                    ],
                                    "source_list" => "html",
                                    "html" => "<option value='<VALUE></VALUE>'> <OPTION></OPTION> </option>",
                                    "array" => [
                                        "VALUE" => array("refer" => "database", "row" => "primary_key"),
                                        "OPTION" => array(
                                            "refer" => "database_multiple",
                                            "row" => [
                                                ["target", "row"],
                                                [" / ", "text"],
                                                ["per", "row"],
                                                ["frekuensi", "row"],
                                            ]
                                        ),
                                    ]

                                ),
                                "CHECHKED" => array(
                                    "refer" => "if_database_to_text",
                                    "source_database" => "database_list_template_on_list",
                                    "row" => "checked",
                                    "if_value" => array(
                                        "0" => "",
                                        "1" => 'checked',
                                    ),
                                    "if_else" => ''
                                ),
                            ),
                        ),
                        "MUKTABAAH" => array(
                            "refer" => "content_template",
                            "source_list" => "template",
                            "template_name" => "beegrit",
                            "template_file" => "HabitsTable.template",
                            "array" => array(),
                        ),

                    )
                ),
            );
            $page['website'] = $website;
            $page['config']['database']['Board Amalan']['utama'] = 'ltw_kegiatan__board';
            $page['config']['database']['Board Amalan']['primary_key'] = 'id';
            $page['config']['database']['Board Amalan']['join'][] = array("ltw_kegiatan__board__user", "ltw_kegiatan__board__user.id_ltw_kegiatan__board", "ltw_kegiatan__board.id");
            $page['config']['database']['Board Amalan']['where'][] = array("id_user", "=", "'" . $_SESSION['id_apps_user'] . "'");
            if (Partial::input('search')) {

                $page['config']['database']['Board Amalan']['where'][] = array("ltw_kegiatan__board.id", "=", "" . Partial::input('search') . "");
            }

            $page['config']['database']['Board Amalan']['order'][] = array("nama_board", "asc");

            $page['config']['database']['Anggota']['utama'] = 'ltw_kegiatan__board__user';
            $page['config']['database']['Anggota']['join'][] = ['apps_user', "apps_user.id_apps_user", "ltw_kegiatan__board__user.id_user"];
            $page['config']['database']['Anggota']['primary_key'] = 'id';
            $page['config']['database']['Anggota']['non_privilage'] = null;
            $page['config']['database']['Anggota']['where_raw'] = "status_keanggotaan = 1 and id_ltw_kegiatan__board=" . Partial::input('search');

            $page['config']['database']['AnggotaMenunggu']['utama'] = 'ltw_kegiatan__board__user';
            $page['config']['database']['AnggotaMenunggu']['join'][] = ['apps_user', "apps_user.id_apps_user", "ltw_kegiatan__board__user.id_user"];
            $page['config']['database']['AnggotaMenunggu']['primary_key'] = 'id';
            $page['config']['database']['AnggotaMenunggu']['non_privilage'] = null;
            $page['config']['database']['AnggotaMenunggu']['np'] = null;
            $page['config']['database']['AnggotaMenunggu']['where_raw'] = "status_keanggotaan = 3  and id_ltw_kegiatan__board=" . Partial::input('search');

            $page['config']['database']['AMALANTARGET']['utama'] = 'ltw_kegiatan__list__breakdown_target';
            $page['config']['database']['AMALANTARGET']['primary_key'] = 'id';

            $page['config']['database']['AMALAN']['select'][] = '*,ltw_kegiatan__task.id as id_task';
            $page['config']['database']['AMALAN']['utama'] = 'ltw_kegiatan__list';
            $page['config']['database']['AMALAN']['primary_key'] = 'id';
            $page['config']['database']['AMALAN']['where_raw'] = "mode_kegiatan = 'amalan' and ltw_kegiatan__list.active=1";
            $page['config']['database']['AMALAN']['join'][] = array("ltw_kegiatan__task", "ltw_kegiatan__task.id_list", "ltw_kegiatan__list.id and id_board=".Partial::input('search'),'LEFT');



            // $page['config']['database']['Role']['utama'] = 'web__list_apps_role';
            // $page['config']['database']['Role']['primary_key'] = 'id';
            // $page['config']['database']['Role']['where_raw'] = "(privacy='public' or (privacy='private' and support_id_private={LOAD_ID}) ) and id_apps=ID_APPS|";
            echo Packages::view_website($page, '');
            die;
        } else {
            $page = $page;
            $page['load']['tipe_sidebar'] = "Beranda";
            $i = 0;
            $website['content'][$i]['tag'] = "BANNER";
            $website['content'][$i]['content_source'] = "template";
            $website['content'][$i]['template_name'] = "beegrit";
            $website['content'][$i]['template_file'] = "HabitsBoard.template";
            $crud = array(
                "redirect_after_submit" => array("Amal", 'board', 'view_layout', -1),
                "submit_link" => array("Amal", 'board', 'save_board', -1),
                "costum_type" => "save_board",
                "oninsert" => array(
                    array(
                        "tipe" => "insert",
                        "insert" => array(
                            "table_insert" => "ltw_kegiatan__board__user",
                            "field" => array(
                                array("id_user", "id_apps_user", "session"),
                                array("sebagai", "admin", "text"),
                                array("id_ltw_kegiatan__board", "", "last_value")
                            ),
                        ),
                    )
                )
            );
            $array =    array(
                array("Be3 ID", null, "text"),
                array("Nama Board", null, "text"),
                array("Deskripsi", null, "text"),
                array("Brosur", null, "file", 'kegiatan/brosur'),
            );
            $database = [
                "utama" => "ltw_kegiatan__board"
            ];
            $website['content'][$i]['template_array'] = array(
                array(
                    "tag" => 'FORM-CRUD-BOARD',
                    "refer" => "crud",
                    "template_crud" => [
                        'content_source' => "html",
                        'html' => '
                    <section class="section p-2">
                                <FORM-ACTION></FORM-ACTION>
                                <div class="row">
                                    <div class="col-md-12">
                                        <VTE-MAIN></VTE-MAIN>
                                        <BUTTON-VTE></BUTTON-VTE>
                                    </div>
                                </div>
                                </form>
                                

                    </section>
                    '
                    ],
                    "database" => $database,
                    "crud" => $crud,
                    "array" => $array,
                )
            );
            $page['view_layout'][] = array("website", "col-md-12", $website);
        }

        if ($page['load']['type'] == 'save_board') {
            $fai = new MainFaiFramework();
            $page_temp = $page;
            $page_temp['database'] = $database;
            $page_temp['crud']['database_utama'] = $database['utama'];

            $page_temp['section_initialize'] = "crud_utama";
            $array['array'] = $array;
            for ($i = 0; $i < count($array['array']); $i++) {
                $field = $array['array'][$i][1];

                $field_array[$field] = $i;
                $type = $array['array'][$i][2];
                $extype = explode('-', $type);
                $result = Packages::initialize_array($fai, $page_temp, $array, $i, $field, $type, $extype);

                $page_temp = $result['page'];
                $array = $result['array'];

                if (isset($page_temp['crud']['costum_class'][$field])) {
                    if (!stripos($page_temp['crud']['costum_class'][$field], $page_temp['database']['utama'] . "__" . $field . "_0"))
                        $page_temp['crud']['costum_class'][$field] .= $page_temp['database']['utama'] . "__$field" . "_0";
                } else {
                    $page_temp['crud']['costum_class'][$field] = $page_temp['database']['utama'] . "__$field" . "_0";
                }
            }

            $page_temp['crud'] = $crud;
            $page_temp['crud']['array'] = $array['array'];
            Packages::crud($page_temp, 'save', -1);
            die;
        }



        return $page;
    }
    public static function mutabaah_yaumiyah($page)
    {


        $page['load']['tipe_sidebar'] = "Beranda";



        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "beegrit";
        $website['content'][$i]['template_file'] = "HabitsTable.template";
        $website['content'][$i]['template_array'] = array();
        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
}
