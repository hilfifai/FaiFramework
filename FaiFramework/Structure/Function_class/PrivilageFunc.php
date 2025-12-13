<?php

class PrivilageFunc
{


    public static  function delete_privilage($page, $type, $id)
    {



        $insert = [];
        $insert['database_utama'] = $id;
        $insert['database_id'] =  Partial::input('id_form');
        $insert['tipe_privilage'] = 'pengecualian';
        $insert['tanggal_perubahan'] = date('Y-m-d H:i:s');

        DB::table($id);
        DB::whereRaw("id=" . Partial::input('id_form'));
        $get = DB::get('all');
        $insert['jenis_privilage'] = $get['row'][0]->privilege;
        $insert['domain_privilage'] = $get['row'][0]->on_domain;
        $insert['web_apps_privilage'] = $get['row'][0]->on_web_apps;
        $insert['panel_privilage'] = $get['row'][0]->on_panel;
        $insert['workspace_privilage'] = $get['row'][0]->on_board;
        $insert['role_privilage'] = $get['row'][0]->on_role;
        CrudFunc::crud_insert(new MainFaiFramework, $page, $insert, [], 'apps__privilege');
        $sqli['active'] = 0;
        CRUDFunc::crud_execution($fai, $page, $sqli, [], $database_utama, ["$primary_key" . "=" . $id], 'delete');
        echo json_encode(["status" => 1]);
        die;
    }
    public static  function info_privilage($page, $type, $id)
    {
        DB::table($id);
        DB::selectRaw("$id.create_by ,nama_lengkap, panel.nama_panel,web__list_apps_board.nama_board,web__list_apps_board__role__akses.nama_role,$id.on_domain as domain,$id.create_date");
        DB::joinRaw("panel on $id.on_panel=panel.id", 'LEFT');
        DB::joinRaw("web__list_apps_board on $id.on_board=web__list_apps_board.id", 'LEFT');
        DB::joinRaw("web__list_apps_board__role__akses on $id.on_role=web__list_apps_board__role__akses.id", 'LEFT');
        DB::joinRaw("apps_user on $id.create_by::text=apps_user.id_apps_user::text", 'LEFT');
        DB::whereRaw("$id.id=" . $id_form = Partial::input('id_form'));
        $get = DB::get('all');
        //
        //app_transaksi
        DB::table('apps__transaksi');
        DB::whereRaw("database_utama='$id'");
        DB::whereRaw("database_id='$id_form'");
        DB::orderRaw($page, "waktu_perubahan desc");
        $apps = DB::get('all');
        $table = "";
        $no = 0;
        if ($apps['num_rows']) {
            foreach ($apps['row'] as $t) {
                $no++;
                $data_akhir = "";
                $data_awal = "";
                $get_awal = json_decode($t->data_awal, 1);

                $get_akhir = json_decode($t->data_akhir, 1);
                if ($t->tipe_transaksi == 'Perubahan') {

                    $array_utama =  $get_awal['utama'];
                    $data_awal .= "<strong>Data Utama</strong>
                        <ul>";
                    foreach ($array_utama as $kau => $au) {
                        $kau = ucwords($kau);
                        $au = ucwords($au);
                        $data_awal .= "<li>$kau : $au</li>";
                    }
                    if (isset($get_awal['sub_kategori'])) {

                        $sub_kategori = $get_awal['sub_kategori'];
                        foreach ($sub_kategori as $ks => $vss) {
                            $nama = "";
                            $ks = $ks ? ucwords($ks) : "";
                            $data_awal .= "<strong> Sub Kategori $ks </strong>";
                            foreach ($vss as $ks => $vs) {
                                if (isset($get_awal['detail_sub_kategori'][$ks])) {
                                    $nama = ucwords($get_awal['detail_sub_kategori'][$ks]);
                                }
                                $data_awal .= "<strong> $nama </strong>
                    
                            <ul>";
                                $array_utama = $vs;
                                $noo = 0;
                                foreach ($array_utama as $kau => $id) {
                                    $noo++;
                                    $data_awal .= "<li>Data $noo<ul>";
                                    foreach ($id as $kau => $au) {
                                        $kau = $kau ? ucwords($kau) : "";

                                        $au = $au ? ucwords($au) : "";

                                        $data_awal .= "<li>$kau : $au</li>";
                                    }
                                    $data_awal .= "</ul>";
                                }
                                $data_awal .= "</ul>";
                            }
                        }
                    }
                    $array_utama =  $get_akhir['utama'];
                    $data_akhir .= "<strong>Data Utama</strong>
                        <ul>";
                    foreach ($array_utama as $kau => $au) {
                        $kau = ucwords($kau);
                        $au = ucwords($au);
                        $data_akhir .= "<li>$kau : $au</li>";
                    }
                    if (isset($get_akhir['sub_kategori'])) {

                        $sub_kategori = $get_akhir['sub_kategori'];
                        foreach ($sub_kategori as $ks => $vss) {
                            $nama = "";
                            $ks = $ks ? ucwords($ks) : "";
                            $data_akhir .= "<strong> Sub Kategori $ks </strong>";
                            foreach ($vss as $ks => $vs) {
                                if (isset($get_akhir['detail_sub_kategori'][$ks])) {
                                    $nama = ucwords($get_akhir['detail_sub_kategori'][$ks]);
                                }
                                $data_akhir .= "<strong> $nama </strong>
                    
                            <ul>";
                                $array_utama = $vs;
                                $noo = 0;
                                foreach ($array_utama as $kau => $id) {
                                    $noo++;
                                    $data_akhir .= "<li>Data $noo<ul>";
                                    foreach ($id as $kau => $au) {
                                        $kau = $kau ? ucwords($kau) : "";

                                        $au = $au ? ucwords($au) : "";

                                        $data_akhir .= "<li>$kau : $au</li>";
                                    }
                                    $data_akhir .= "</ul>";
                                }
                                $data_akhir .= "</ul>";
                            }
                        }
                    }
                } else
                if ($t->tipe_transaksi == 'Pembuatan') {
                    $array_utama = $get_awal['array_utama'];

                    $data_awal .= "<strong>Data Utama</strong>
                        <ul>
                    ";
                    foreach ($array_utama as $kau => $au) {
                        $kau = ucwords($kau);
                        $au = ucwords($au);
                        $data_awal .= "<li>$kau : $au</li>";
                    }
                    $data_awal .= "</ul>";
                    if (isset($get_awal['sub_kategori'])) {

                        $sub_kategori = $get_awal['sub_kategori'];

                        foreach ($sub_kategori as $ks => $vs) {
                            $nama = "";
                            if (isset($get_awal['detail_sub_kategori'][$ks])) {
                                $nama = ucwords($get_awal['detail_sub_kategori'][$ks]);
                            }
                            $data_awal .= "<strong> $nama </strong>
                    
                            <ul>";
                            $array_utama = $vs;
                            foreach ($array_utama as $kau => $id) {
                                foreach ($id as $kau => $au) {
                                    $kau = $kau ? ucwords($kau) : "";

                                    $au = $au ? ucwords($au) : "";

                                    $data_awal .= "<li>$kau : $au</li>";
                                }
                            }
                            $data_awal .= "</ul>";
                        }
                    }
                }
                $table .= "
                 <tr>
                    <th>$no</th>
                    <th>" . Partial::tgl_indo($t->waktu_perubahan) . "</th>
                    <th>User</th>
                    <th>$t->tipe_transaksi</th>
                    <th>$data_awal</th>
                    <th>$data_akhir</th>
                </tr>
                ";
            }
        }
        $get['row'][0]->histori_data = $table;
        echo json_encode($get['row'][0]);
        die;
    }
}
