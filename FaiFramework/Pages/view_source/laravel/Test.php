<?php if ($field_appr) { ?>

    <?php $page = $pagetemp; ?>
    public function appr($request,$id)
    {

    <?php
    $select = array();
    $where = array();
    $array = $array_temp;
    $field_appr =  '';
    $page['database'] = $temp_database;
    $search = isset($page['crud']['search']) ? $page['crud']['search'] : array();
    $database_utama = $page['database']['utama'];
    $primary_key = $page['database']['primary_key'];
    $page['database']['where'] = isset($page['database']['where']) ? $page['database']['where'] : array();
    $temp_where = $page['database']['where'];
    $where[] = array("1", "=", '1');
    for ($i = 0; $i < count($array); $i++) {
        $text = $array[$i][0];
        $field = $array[$i][1];
        $typearray = $array[$i][2];
        $extypearray = explode('-', $typearray);

        if ($typearray == 'select-appr') {

            $field_appr =  $field;
            $select[] = $database_utama . "." . $field_appr . "_status as system_status_appr";
            if ($type == 'appr' and !isset($page['crud']['appr_no_select'])) {

                $where[] = array($database_utama . "." . $field_appr . "_id", '=', $idUser);
            }
        }
    }
    foreach ($search as $key => $value) {
        if ($key == -1) {
            echo '
                        $search_active = "1=1";
                        if($request->get("search-active"))
                            $search_active = "  ' . $database_utama . '.active=".$request->get("search-active");
                        
                        ';
            $where[] = array(" ", " ", '$search_active');
        } else if ($key == -2) {
            $field_appr =  $field;
            echo '
                        $status_appr = "1=1";
                        if($request->get("status-appr"))
                            $status_appr = "  ' . $database_utama . '.' . $field_appr . '=".$request->get("status-appr");
                        
                        ';
            $where[] = array(" ", " ", ('$status_appr'));
        } else {
            $i = $key;

            if ($array[$i][2] == 'date') {
                $row = $array[$i][1];
                echo '
                                $' . $row . '_dari = "1=1";
                                if($request->get("' . $row . '_dari"))
                                    $' . $row . '_dari = "  ' . $row . '>=".$request->get("' . $row . '_dari");
                                
                            ';
                echo '
                                $' . $row . '_sampai = "1=1";
                                if($request->get("' . $row . '_sampai"))
                                    $' . $row . '_sampai = "  ' . $row . '<=".$request->get("' . $row . '_sampai");
                                
                            ';
                $dari = $row . '_dari';
                $where[] = array(" ", "", '$' . $dari . '');
                $where[] = array(" ", "", '$' . $row . '_sampai');
            } else {
                $row = $array[$i][1];
                echo '
                                $' . $row . ' = "1=1";
                                if($request->get("' . $row . '"))
                                    $' . $row . ' = "  ' . $row . '<=".$request->get("' . $row . '");
                                
                            ';

                $where[] = array(" ", " ", '$' . $row);
            }
        }
    }
    $page['database']['select'] = array_merge($page['database']['select'], $select);
    $page['database']['where'] =   array_merge($page['database']['where'], $where);
    $ci = &get_instance();
    $row = $fai->database_coverter($page, $page['database'], $array, 'source');
    $query = $row;

    ?>


    $sql="<?= $query ?>";
    $<?php echo $fai->nama_function($page, $page['title']); ?>=DB::connection()->select($sql);
    <?php
    $compact = '';
    if (isset($page['crud']['no_edit'])) {
        echo '$no_edit = true;';
        $compact = '"no_edit",';
    } else
                if (isset($page['crud']['no_delete'])) {
        echo '$no_delete = true;';
        $compact = '"$no_delete",';
    } else
                if (isset($page['crud']['no_add'])) {
        echo '$no_add = true;';
        $compact = '"$no_add",';
    } ?>
    if($request->Cari =='pdf'){
    return $this->pdf();
    }else if($request->Cari =='excel'){
    return $this->excel($request,$<?php echo $fai->nama_function($page, $page['title']); ?>);
    }else{

    return view('<?php echo $fai->nama_function($page, $page['title']); ?>.appr_<?php echo $fai->nama_function($page, $page['title']); ?>',compact(<?= $compact ?>'<?php echo $fai->nama_function($page, $page['title']); ?>'));
    }

    }
    public function view_appr($request,$id)
    {
    <?php $page = $pagetemp; ?>
    <?php
    $where = array();
    $array = $array_temp;
    $database_utama = isset($page['database']['utama']) ? $page['database']['utama'] : '';
    $primary_key = isset($page['database']['primary_key']) ? $page['database']['primary_key'] : '';
    $page['database']['where'][] = array("$database_utama.active", '=', "1");
    $page['database']['where'][] = array("$database_utama.$primary_key", '=', '$id');
    $row = $fai->database_coverter($page, $page['database'], $array, 'source');
    $query = $row;
    ?>
    $sql="<?= $query ?>";


    $<?php echo $fai->nama_function($page, $page['title']); ?>=DB::connection()->select($sql);
    $<?php echo $fai->nama_function($page, $page['title']); ?> = count($<?php echo $fai->nama_function($page, $page['title']); ?>)?$<?php echo $fai->nama_function($page, $page['title']); ?>[0]:array();
    <?php
    $compact = '';
    for ($i = 0; $i < count($array); $i++) {
        $text = $array[$i][0];
        $field = $array[$i][1];
        $type = $array[$i][2];
        if (isset($array[$i][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))) {


            $option = $array[$i][3];
            if (isset($option[0])) {
                $database = $option[0];
                $key = $option[1];
                $page['select_database_costum'][$field]['utama'] =  $database;
                $page['select_database_costum'][$field]['primary_key'] =  $key;

                $row = $fai->database_coverter($page, $page['select_database_costum'][$field], null, 'source');
                $query = $row;
    ?>


                $sql="<?= $query ?>";
                $<?= $field ?>=DB::connection()->select($sql);
                <?php

                $compact .= ',"' . $field . '"';
            }
        }
    }



    if (isset($page['crud']['sub_kategori'])) {
        $page['section_vte'] = 'sub_kategori';
        for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            $sub_kategori = $page['crud']['sub_kategori'][$h];


            $database_sub = $sub_kategori[1];

            $where = isset($page['database_sub_kategori'][$database_sub]['where']) ? $page['database_sub_kategori'][$database_sub]['where'] : array();;


            $where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), '=', '$id');
            $where[] = array($sub_kategori[1] . ".active", '=', 1);

            $page['crud']['database_sub_kategori'][$database_sub]['utama'] = $sub_kategori[1];;
            $page['crud']['database_sub_kategori'][$database_sub]['primary_key'] = $sub_kategori[2];;
            $page['crud']['database_sub_kategori'][$database_sub]['where'] = $where;;
            $array = $page['crud']['array_sub_kategori'][$h];
            //$array = Database::converting_array_field($page,$array);
            for ($i = 0; $i < count($array); $i++) {
                $text = $array[$i][0];
                $field = $array[$i][1];
                $type = $array[$i][2];
                if (isset($array[$i][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))) {


                    $option = $array[$i][3];
                    if (isset($option[0])) {
                        $database = $option[0];
                        $key = $option[1];
                        $page['select_database_costum'][$field]['utama'] =  $database;
                        $page['select_database_costum'][$field]['primary_key'] =  $key;

                        $row = $fai->database_coverter($page, $page['select_database_costum'][$field], null, 'source');
                        $query = $row;
                ?>$sql="<?= $query ?>";
                $<?= $field ?>=DB::connection()->select($sql);
            <?php
                $compact .= ',"' . $field . '"';
                }
                }
            }
                                                    $row = $fai->database_coverter($page, $page['crud']['database_sub_kategori'][$database_sub], $array, 'source');
                                                    $query = $row;
                                                                ?>


                $sql="<?= $query ?>";
                $<?= $sub_kategori[1] ?>=DB::connection()->select($sql);
        <?php

            $compact .= ',"' . $sub_kategori[1] . '"';
        }
    }

        ?>

        return view('<?php echo $fai->nama_function($page, $page['title']); ?>.view_appr_<?php echo $fai->nama_function($page, $page['title']); ?>', compact('id','<?php echo $fai->nama_function($page, $page['title']); ?>'<?= $compact ?>));
        }
        public function setujui_appr($request,$id)
        {

        DB::beginTransaction();

        try {
        $idUser=Auth::user()->id;

        $update= ["<?= $all_field_appr ?>_status" => 1,"<?= $all_field_appr ?>_date"=>date('Y-m-d H:i:s'),"<?= $all_field_appr ?>_by"=>$idUser];
        DB::connection()->table("<?= $database_utama ?>")
        ->where("<?= $primary_key ?>",$id)
        ->update($update );

        <?php

        if (isset($page['crud']['onappr'])) {
            for ($a = 0; $a < count($page['crud']['onappr']); $a++) {
                $array = $array_temp;
                $database_utama = isset($page['database']['utama']) ? $page['database']['utama'] : '';
                $primary_key = isset($page['database']['primary_key']) ? $page['database']['primary_key'] : '';
                $page['database']['where'] = $temp_where;
                //$page['database']['where'][] = array("$database_utama.active",'=',"1");
                $page['database']['where'][] = array("$database_utama.$primary_key", '=', '$id');
                $row = $fai->database_coverter($page, $page['database'], $array, 'source');
                $query = $row;
        ?>
                $sql="<?= $query ?>";
                $<?php echo $fai->nama_function($page, $page['title']); ?>=DB::connection()->select($sql);
                if(count($<?php echo $fai->nama_function($page, $page['title']); ?>)){
                $onappr =array();
                $row=$<?php echo $fai->nama_function($page, $page['title']); ?>;
                <?php for ($b = 0; $b < count($page['crud']['onappr'][$a]['field']); $b++) { ?>
                    $onappr['<?= $page['crud']['onappr'][$a]['field'][$b][1] ?>']=$row-><?= $page['crud']['onappr'][$a]['field'][$b][0] ?>;
                <?php } ?>
                DB::insert('<?= $page['crud']['onappr'][$a]['tabel_target'] ?>',$onappr);
                }

        <?
            }
        }
        ?>
        DB::commit();




        return redirect()->route('<?= $page['route'] ?>',['list','-1'])->with('success','<?= $page['title'] ?> Berhasil di disetujui!');
        } catch (\Exeception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e);
        }


        }
        public function decline_appr(Request $request,$id)
        {


        DB::beginTransaction();
        try {
        $idUser=Auth::user()->id;

        $update= ["<?= $all_field_appr ?>_status" => 2,"<?= $all_field_appr ?>_date"=>date('Y-m-d H:i:s'),"<?= $all_field_appr ?>_by"=>$idUser];

        DB::connection()->table("<?= $database_utama ?>")
        ->where("<?= $primary_key ?>",$id)
        ->update($update );
        DB::commit();




        return redirect()->route('<?= $page['route'] ?>',['list','-1'])->with('success','<?= $page['title'] ?> Berhasil di Tolak!');


        } catch (\Exeception $e) {
        DB::rollback();
        return redirect()->back()->with('error', $e);
        }


        }
    <?php } ?>