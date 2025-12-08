<?php
class PanelFunc
{

    public static function panel_initial($page, $get_return = 'id')
    {

        $page['section'] = '';
        DB::connection($page);
        $page['crud']['database_utama'] = "panel";
        $page['section_initialize'] = 'crud_utama';
        $page['load']['panel']['database_utama'] = "panel";
        $page['load']['panel']['array'][] = array("row" => "panel", "get" => "session", "session" => 'hak_akses', "default" => "public");
        $page['load']['panel']['array'][] = array("row" => "nama_panel", "get" => "get_name_database", "default" => null);
        $page['load']['panel']['array'][] = array("row" => "id_apps_user", "get" => "session", "session" => 'id_apps_user', "default" => "0");
        $page['load']['panel']['array'][] = array("row" => "id_organisasi", "get" => "session", "session" => 'id_organisasi', "default" => "0");
        $page['load']['panel']['array'][] = array("row" => "id_program", "get" => "session", "session" => 'id_program', "default" => "0");
        // 		$page['load']['panel']['array'][] = array("row" => "ip_address", "get" => "ip");
        $page['load']['panel']['array'][] = array("row" => "create_in", "get" => "all_load");
        $page['load']['not_orderby'] = true;
        $array = array();
        $where = array();
        $sqli = array();
        $id_panel = -1;
        for ($i = 0; $i < count($page['load']['panel']['array']); $i++) {
            $row = $page['load']['panel']['array'][$i]['row'];
            $array[] = array($row, $row, "text");
        }
        Database::create_database_check($page, $array, $page['load']['panel']['database_utama'], Database::converting_primary_key($page, $page['load']['panel']['database_utama'], 'ontable'), $page['database_provider'], $page['app_framework']);
        if ($page['load_section'] != 'viewsource') {
            $id_divisi = "";
            $panel_list = [];
            $i = 0;
            $is_user = 0;
            if (isset($_SESSION['id_apps_user'])) {
                $is_user = 1;

                if ($_SESSION['id_apps_user'] == '-1' and !isset($_SESSION['id_apps_user_tmp'])) {
                    $is_user = 0;
                }
            }
            if ($is_user) {
                if ($_SESSION['id_apps_user'] == '-1' and isset($_SESSION['id_apps_user_tmp']))
                    $_SESSION['id_apps_user'] = $_SESSION['id_apps_user_tmp'];
                $panel_list[$i]['panel'] = "user";
                $panel_list[$i]['id_apps_user'] = $_SESSION['id_apps_user'];
                if($page['database_provider'] == 'postgres'){
                $distinct = "distinct string_agg(CAST(k.id_divisi as char(255)), ',')";
                }else{
                    $distinct="GROUP_CONCAT(DISTINCT CAST(k.id_divisi as char(255)) SEPARATOR ',')";
                }
                $sql = "select *,
                        (SELECT  $distinct
                                            FROM hcms__struktur__anggota__jabatan mk
                                            left join hcms__struktur__jabatan k on k.id = mk.id_jabatan 
                                            WHERE mk.id_hcms__struktur__anggota = hcms__struktur__anggota.id and mk.active=1) as divisi_anggota_list,
                        apps_user.be3_id as be3_iduser,organisasi.apps_id as be3_id_organisasi 
                        from hcms__struktur__anggota 
                        left join apps_user on id_user = apps_user.id
                        left join organisasi on id_organisasi = organisasi.id
                        where cast(id_apps_user as char) = '" . $_SESSION['id_apps_user'] . "'";
                DB::queryRaw($page, $sql);

                $get = DB::get('all');
                if ($get['num_rows']) {
                    foreach ($get['row'] as $row) {
                        $i++;

                        $panel_list[0]['nama_panel'] = "User - " . $row->nama_lengkap;
                        $panel_list[0]['nama_user'] = $row->nama_lengkap;
                        $panel_list[0]['nama_organisasi'] = $row->nama_lengkap;
                        $panel_list[0]['be3_id'] = $row->be3_iduser;
                        $panel_list[0]['nama_lengkap'] = $row->nama_lengkap;
                        $panel_list[0]['nama_detail_panel'] = $row->nama_lengkap;
                        $panel_list[$i]['panel'] = "organisasi";
                        $panel_list[$i]['nama_lengkap'] = $row->nama_lengkap;
                        $panel_list[$i]['nama_user'] = $row->nama_lengkap;
                        $panel_list[$i]['nama_panel'] = "Organisasi - " . $row->nama_organisasi;
                        $panel_list[$i]['be3_id'] = $row->be3_id_organisasi;
                        $panel_list[$i]['nama_detail_panel'] = $row->nama_organisasi;
                        $panel_list[$i]['nama_organisasi'] = $row->nama_organisasi;
                        $panel_list[$i]['id_organisasi'] = $row->id_organisasi;
                        $panel_list[$i]['divisi_anggota_list'] = $row->divisi_anggota_list;
                        if ($row->divisi_anggota_list)
                            $id_divisi .= $panel_list[$i]['divisi_anggota_list'] . ',';
                    }
                } else {
                    DB::queryRaw($page, "select *,
       
                    apps_user.be3_id as be3_iduser
                    from apps_user 
                    where cast(id_apps_user as char) = '" . $_SESSION['id_apps_user'] . "'");

                    $get = DB::get('all');
                    if ($get['num_rows']) {

                        $panel_list[0]['nama_panel'] = "User - " . $get['row'][0]->nama_lengkap;
                        $panel_list[0]['nama_user'] = $get['row'][0]->nama_lengkap;
                        $panel_list[0]['nama_organisasi'] = $get['row'][0]->nama_lengkap;
                        $panel_list[0]['be3_id'] = $get['row'][0]->be3_iduser;
                        $panel_list[0]['nama_lengkap'] = $get['row'][0]->nama_lengkap;
                        $panel_list[0]['nama_detail_panel'] = $get['row'][0]->nama_lengkap;
                    }
                }
            } else {
                if (!isset($_SESSION['hak_akses'])) {
                    $_SESSION['hak_akses'] = "public";
                }
                $panel_list[$i]['panel'] = "public";
                $panel_list[$i]['nama_panel'] = "Public ";
                $panel_list[$i]['ip_address'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
            }
            $id_divisi .= "-1";
            $panel_detail = array();
            $id_panel_list = array();
            $id_organisasi = array();
            $panel_organisasi = array();
            $id_panel_user = "";
           
            for ($i = 0; $i < count($panel_list); $i++) {
                $where_panel = "";;
                unset($sql);
                $this_aktif = false;
                $sql['panel'] = $panel_list[$i]['panel'];
                if (isset($panel_list[$i]['nama_panel']))
                    $sql['nama_panel'] = $panel_list[$i]['nama_panel'];
                if ($panel_list[$i]['panel'] == 'user') {
                    $where_panel .= " and cast(id_apps_user as char) = '" . $_SESSION['id_apps_user'] . "'";;
                    $sql['id_apps_user'] = $_SESSION['id_apps_user'];
                    if (strtolower($_SESSION['hak_akses']) == 'user') {
                        $this_aktif = true;
                    }
                } else if (isset($panel_list[$i]['id_organisasi'])) {
                    //bisa program
                    //bisa store
                    //bisa project
                    $where_panel .= " and id_organisasi=" . $panel_list[$i]['id_organisasi'] . "";;
                    $sql['id_organisasi'] = $panel_list[$i]['id_organisasi'];
                    if (strtolower($_SESSION['hak_akses']) == 'organisasi' and $panel_list[$i]['id_organisasi'] == $_SESSION['id_organisasi']) {
                        $this_aktif = true;
                    }
                    $id_organisasi[] = $panel_list[$i]['id_organisasi'];
                } else if ($panel_list[$i]['panel'] == 'public') {
                    if (strtolower($_SESSION['hak_akses']) == 'public' and $panel_list[$i]['ip_address'] == (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1')) {
                        $this_aktif = true;
                    }
                }

                DB::queryRaw($page, "select * from panel 
                where 1=1  " . $where_panel . "");
                $get = DB::get('all');
                if (!$get['num_rows']) {
                    CRUDFunc::crud_insert(false,$page,$sql,[],'panel',[]);
		
                    $last_insert_id = DB::lastInsertId($page, "panel");
                } else {
                    $last_insert_id = $get['row'][0]->id;
                    if (isset($panel_list[$i]['nama_panel'])) {

                        if ($get['row'][0]->nama_panel != $panel_list[$i]['nama_panel']) {
                            DB::update("panel", ["nama_panel" => $panel_list[$i]['nama_panel']], ["id=" . $get['row'][0]->id]);
                        }
                    }
                }
                $panel_list[$i]['id_panel'] = $last_insert_id;
                $id_panel_list[] = $last_insert_id;
                if ($panel_list[$i]['panel'] == 'organisasi') {
                    $panel_organisasi[$panel_list[$i]['id_organisasi']] =  $last_insert_id;
                }
                if ($panel_list[$i]['panel'] == 'user') {
                    $id_panel_user =  $last_insert_id;
                }
                if ($this_aktif) {
                    $id_panel = $last_insert_id;
                    $panel_detail = $panel_list[$i];
                }
            }
            $sql = "select * from panel__user
                left join apps_user on cast(apps_user.id_apps_user as char) = cast(panel__user.id_apps_user  as char)
                where 1=1 and id_panel=$id_panel  " . (isset($_SESSION['id_apps_user']) ? "and cast(panel__user.id_apps_user as char)='" . $_SESSION['id_apps_user']."'" : '') . "
            ";
            DB::queryRaw($page, $sql);
            $get_user = DB::get('all');
             $get_user['query'];
            if ($get_user['num_rows']) {
                $id_user = $get_user['row'][0]->id;
            } else {
                $sql_user['id_panel'] = $id_panel;
                if (isset($_SESSION['id_apps_user']))
                    $sql_user['id_apps_user'] = $_SESSION['id_apps_user'];
                    CRUDFunc::crud_insert(false,$page,$sql_user,[],'panel__user',[]);
		
                $id_user = DB::lastInsertId($page, "panel__user");
                DB::queryRaw($page, $sql);
                $get_user = DB::get('all');
            }
            $id_organisasi[] = -1;
            $return['id_panel'] = $id_panel;
            $return['panel'] = isset($panel_detail['panel']) ? $panel_detail['panel'] : array();;
            $return['panel_list'] = $panel_list;;
            $return['panel_organisasi'] = $panel_organisasi;;
            $return['id_panel_list'] = $id_panel_list;;
            $return['im_id_panel_list'] = implode(',', $id_panel_list);;
            $return['id_organisasi'] = $id_organisasi;;
            $return['im_id_organisasi'] = implode(',', $id_organisasi);;
            $return['im_id_divisi'] = $id_divisi;;
            $return['get_panel_detail'] = json_decode(json_encode($panel_detail), FALSE);
            $return['get_panel'] = json_decode(json_encode($panel_detail), FALSE);
            $return['get_user'] = $get_user['row'][0];;
            $return['id_panel_user'] = $id_user;;
            $return['user_id_panel'] =   $id_panel_user;;


            if ($get_return == 'id')
                return $id_panel;
            else {
                return $return;
            }
        }
    }
}
