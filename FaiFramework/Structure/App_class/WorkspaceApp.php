<?php

class WorkspaceApp
{

    public static  function get_board_user($fai, $page, $id_board = -1, $return = 'get_board_user')
    {
        //cari board dari user
        // buat list board
        $panel = PanelFunc::panel_initial($page, 'all');
        $where="";
        $list_board = [];
        if (isset($_SESSION['id_apps_user'])) {
            if ($id_board != -1)
                $where = " and id_web__list_apps_board=$id_board";
             $sql = "select * from web__list_apps_board__user_list
                            where id_user = " . $_SESSION['id_apps_user'] . " $where";
            DB::queryRaw($page, $sql);
            $get = DB::get('all');
            $list_panel = [];

            // untuk list user
            if ($get['num_rows']) {
                foreach ($get['row'] as $row) {
                    if (!in_array($row->id_web__list_apps_board, $list_board)) {
                        $list_board[] = $row->id_web__list_apps_board;
                    }
                    if (!in_array($panel['user_id_panel'], $list_panel) and $panel['user_id_panel']) {
                        $list_panel[] = $panel['user_id_panel'];
                    }
                }
            }
           
             $sql =  "select *
            from web__list_apps_board__entitas
                
                where 1=1
                and web__list_apps_board__entitas.id_organisasi in(" . $panel['im_id_organisasi'] . ")
                $where
                and
                (case when semua_anggota='1' then 1
                    when semua_anggota='2' then (
                        select count(*) from  web__list_apps_board__entitas__divisi aj
                        where aj.id_web__list_apps_board__entitas = web__list_apps_board__entitas.id and id_divisi in (" . $panel['im_id_divisi'] . ")
                    )
                end )>=1
            ";
            DB::queryRaw($page,$sql);

            $get = DB::get('all');
            $list_organisasi[] = -1;
            if ($get['num_rows']) {

                foreach ($get['row'] as $row) {
                    if (!in_array($row->id_web__list_apps_board, $list_board) and $row->id_web__list_apps_board) {
                        $list_board[] = $row->id_web__list_apps_board;
                    }
                    if (!in_array($panel['panel_organisasi'][$row->id_organisasi], $list_panel) and $panel['panel_organisasi'][$row->id_organisasi]) {
                        $list_panel[] = $panel['panel_organisasi'][$row->id_organisasi];
                        $list_organisasi[] = $row->id_organisasi;
                    }
                }
            }
        }else{
            $list_board[] = -1;
            $list_panel[] = -1;
            $list_organisasi[] = -1;
        }
        // print_R($list_organisasi);
        if ($return == 'get_board_user')
            return implode(',', $list_board);
        else if ($return == 'get_panel_board')
            return implode(',', $list_panel);
        else if ($return == 'get_organisasi_board')
            return implode(',', $list_organisasi);
    }
    public static  function get_panel_board($fai, $page, $id_board)
    {

        $return =  WorkspaceApp::get_board_user($fai, $page, $id_board, 'get_panel_board');

        return $return;
    }
    public static  function get_organisasi_board($fai, $page, $id_board)
    {

        $return =  WorkspaceApp::get_board_user($fai, $page, $id_board, 'get_organisasi_board');

        return $return;
    }
    public static  function get_user_board($fai, $page, $id_board)
    {
        //cari user dalam board
        $list_user = [];
        DB::queryRaw($page, "select * from web__list_apps_board__user_list
        where id_web__list_apps_board = " . $id_board . "");
        $get = DB::get('all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                if (!in_array($row->id_user, $list_user)) {

                    $list_user[] = $row->id_user;
                }
            }
        }

        DB::queryRaw($page, "select *,hcms__struktur__anggota.id as id_anggota
                       
                            
                            from web__list_apps_board__entitas
                                left join hcms__struktur__anggota on hcms__struktur__anggota.id_organisasi = web__list_apps_board__entitas.id_organisasi
                                left join apps_user on  id_user = apps_user.id
                                
                                where id_web__list_apps_board = " . $id_board . "
                                and
                                (case when semua_anggota='1' then 1
                                    when semua_anggota='2' then (
                                        select count(*) from hcms__struktur__anggota__jabatan aj
                                        left join hcms__struktur__jabatan k on k.id = aj.id_jabatan 
                                        join web__list_apps_board__entitas__divisi mk on k.id_divisi = mk.id_divisi
                                        where aj.id_hcms__struktur__anggota = hcms__struktur__anggota.id
                                    )
                                end )>=1
                                
                                ");
        $get = DB::get('all');
        if ($get['num_rows']) {

            foreach ($get['row'] as $row) {


                if (!in_array($row->id_apps_user, $list_user) and $row->id_apps_user) {

                    $list_user[] = $row->id_apps_user;
                }
            }
        }

        return $list_user;
    }


    public static function save_proses($page, $step = "", $load_id = "", $id_paket = "", $param5 = "")
    {
        $page['load']['board'] = $load_id;
        $step;
        if ($step == 1) {
            DB::connection($page);
            $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket__list where id = $id_paket"));
            //print_r($db);

            $data["tagihan_term_per"] = "'" . $db[0]->tagihan_term_per . "'";
            $data["step"] = $step;
            $data["tagihan_term_frekuensi"] = $db[0]->tagihan_term_frekuensi;
            $data["id_paket"] = $id_paket;
            $data["pembayaran_total"] = $db[0]->harga_utama;
            $data["pembayaran_selanjutnya"] = "'" . date('Y-m-d') . "'";

            // DB::table("web__list_apps_board");
            // DB::whereRaw("web__list_apps_board.id","$load_id");
            DB::update("web__list_apps_board", $data, [["web__list_apps_board.id", "=", "$load_id"]], 'Where Array');

            $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket__list__detail
                left join web__list_apps_paket__elemen on id_elemen = web__list_apps_paket__elemen.id
                left join web__list_apps_paket__tipe on id_paket_apps = web__list_apps_paket__tipe.id
                where id_web__list_apps_paket__list = $id_paket  and web__list_apps_paket__list__detail.active=1"));

            foreach ($db as $db) {
                unset($data);
                if ($db->id_koneksi_apps) {
                    $data['id_apps'] = $db->id_koneksi_apps;
                    // $data['tipe_menu'] = $db->tipe_menu;
                    $data['data_apps'] = $db->id_paket_apps;
                    $data['id_web__list_apps_board'] = $load_id;
                    CRUDFunc::crud_insert(false, $page, $data, [], 'web__list_apps_board__apps', []);

                }
            }

            $fai = new MainFaiFramework();
            $sql = "select * from web__list_apps_paket__list__detail
                join web__list_apps_paket__tipe__detail on id_paket_apps = web__list_apps_paket__tipe__detail.id_web__list_apps_paket__tipe
                where id_web__list_apps_paket__list = $id_paket
                and web__list_apps_paket__tipe__detail.checklist='1' 
                and web__list_apps_paket__list__detail.active=1
                and web__list_apps_paket__tipe__detail.active=1
                ";
            $db = DB::fetchResponse(DB::select($sql));
            foreach ($db as $db) {
                unset($data);
                $sqli['id_web__list_apps_board'] = $load_id;
                $sqli['id_apps_menu'] = $db->id_apps_menu;
                //CrudFunc::crud_save();
                // print_r($sqli);
                $respon = CrudFunc::crud_save($fai, $page, $sqli, array(), array(), "web__list_apps_board__menu");
            }
            $fai = new MainFaiFramework();
            $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket__role__group
                where web__list_apps_paket__role__group.id in(select id_role_group from web__list_apps_paket__role__akses where web__list_apps_paket__role__akses.id_paket = $id_paket  and web__list_apps_paket__role__akses.active=1) and web__list_apps_paket__role__group.active=1"));
            foreach ($db as $db) {
                unset($sqli);
                $sqli['id_web__list_apps_board'] = $load_id;
                $sqli['nama_role_group'] = $db->nama_role_group;
                //CrudFunc::crud_save();

                $respon = CrudFunc::crud_save($fai, $page, $sqli, array(), array(), "web__list_apps_board__role__group");
                $collect_group_menu[$db->id] = $respon['last_insert_id'];
            }
            $fai = new MainFaiFramework();
            $role = [];
            $db = DB::fetchResponse(DB::select("select * from web__list_apps_paket__role__akses where id_paket = $id_paket  and active=1"));
            foreach ($db as $db) {
                unset($sqli);
                $sqli['id_web__list_apps_board'] = $load_id;
                $sqli['nama_role'] = $db->nama_role;
                $sqli['page'] = $db->page;
                $sqli['id_role_group'] = $collect_group_menu[$db->id_role_group];
                //CrudFunc::crud_save();

                $respon = CrudFunc::crud_save($fai, $page, $sqli, array(), array(), "web__list_apps_board__role__akses");
                $collect_akses_menu[$db->id] = $respon['last_insert_id'];
                $role[] = $respon['last_insert_id'];
                $db2 = DB::fetchResponse(DB::select("select * from web__list_apps_paket__role__akses__menu where id_web__list_apps_paket__role__akses = $db->id and active=1"));
                if ($db2) {
                    foreach ($db2 as $db2) {

                        $sqlix['id_web__list_apps_board__role__akses'] = $respon['last_insert_id'];
                        $sqlix['id_menu'] = $db2->id_menu;
                        $sqlix['akses_menu'] = $db2->akses_menu;
                        $sqlix['tambah'] = $db2->tambah;
                        $sqlix['edit'] = $db2->edit;
                        $sqlix['hapus'] = $db2->hapus;

                        $respon2 = CrudFunc::crud_save($fai, $page, $sqlix, array(), array(), "web__list_apps_board__role__akses__menu");
                    }
                }
            }
            if (!count($role)) {
                $sqli['id_web__list_apps_board'] = $load_id;
                $sqli['nama_role_group'] = "Admin";
                //CrudFunc::crud_save();

                $respon = CrudFunc::crud_save($fai, $page, $sqli, array(), array(), "web__list_apps_board__role__group");
                $id_group = $respon['last_insert_id'];
                $sqlqlra['id_web__list_apps_board'] = $load_id;
                $sqlqlra['nama_role'] = "Super Admin FrontEnd";
                $sqlqlra['semua_menu'] = 1;
                $sqlqlra['page'] = 'Frontend';
                $sqlqlra['id_role_group'] = $id_group;
                $respon2 = CrudFunc::crud_save($fai, $page, $sqlqlra, array(), array(), "web__list_apps_board__role__akses");
                $role[] = $respon2['last_insert_id'];
                $sqlqlra['id_web__list_apps_board'] = $load_id;
                $sqlqlra['nama_role'] = "Super Admin Backend";
                $sqlqlra['semua_menu'] = 1;
                $sqlqlra['page'] = 'Backend';
                $sqlqlra['id_role_group'] = $id_group;
                $respon2 = CrudFunc::crud_save($fai, $page, $sqlqlra, array(), array(), "web__list_apps_board__role__akses");
                $role[] = $respon2['last_insert_id'];
            }
            for ($i = 0; $i < count($role); $i++) {
                $sqlq['id_web__list_apps_board'] = $load_id;
                $sqlq['id_user'] = $_SESSION['id_apps_user'];
                $sqlq['id_role'] = $role[$i];


                $respon2 = CrudFunc::crud_save($fai, $page, $sqlq, array(), array(), "web__list_apps_board__role__user");
            }

            $sqlql['id_web__list_apps_board'] = $load_id;
            $sqlql['id_user'] = $_SESSION['id_apps_user'];
            $respon2 = CrudFunc::crud_save($fai, $page, $sqlql, array(), array(), "web__list_apps_board__user_list");
        }

        $page['route_type'] = "just_link";
        echo '';
        redirect(Partial::link_direct($page, "https://" . $_SERVER['SERVER_NAME'] . '/pages/', array("Workspace", "admin", "list", "-1", "-1", "-1", $load_id)));
        die;
    }
}
