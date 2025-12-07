<?php

class Cronjob
{
    public static function router_cronjob($page)
    {
        $proses = true;
        echo 'proses_share';
        if ($proses)
            $num = Cronjob::proses_share($page);
        if ($num > 0) $proses = false;
        echo 'send_wa';
        if ($proses)
            $num = Cronjob::send_wa($page);
        if ($num > 0) $proses = false;
        echo 'proses_broadcast_wa';
        if ($proses)
            $num = Cronjob::proses_broadcast_wa($page);

        if ($num > 0) $proses = false;
        echo 'hai' . $num;
        if ($proses) {
            echo 'masuk broadcast_wa';
            $num = Cronjob::broadcast_wa($page);
        }
        echo 'daftar_mitra';
        if ($num > 0) $proses = false;
        if ($proses)
            $num = Cronjob::daftar_mitra($page);
        if ($num > 0) $proses = false;

        if ($proses)
            $num = Cronjob::export_to_spreasheet_penjualan($page);
        if ($num > 0) $proses = false;

        if ($proses)
            $num = Cronjob::proses_spreasheet_penjualan($page);
        if ($num > 0) $proses = false;
    }
    public static function text_chat_bot($page, $id_proses = -1, $type_proses = 'kirim_share_wag_group')
    {
        $data['content_message'] = $_GET['msg'];
        ChatbotApp::router($page,$data,null,null,1,1);
    }
    public static function proses_share($page, $id_proses = -1, $type_proses = 'kirim_share_wag_group')
    {
        DB::selectRaw('*,share__wa_group__post.id as id_wa_post');
        DB::table('share__wa_group__post');
        DB::joinRaw("share__post on id_share__post::int= share__post.id", "LEFT");
        if ($id_proses == -1)
            DB::whereRaw("status_generate='Belum' and status_approve='1'");
        else
            DB::whereRaw("id_share__post=$id_proses");
        $get = DB::get('all');
        // print_R($get);
        // echo '<pre>';
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // echo $get['query'];

        $id_pesan_array = [];
        $id_admin_array = [];
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                print_r($row);
                $tanggal_post = $row->tanggal_post;
                if ($row->media) {

                    $listimg = explode(',', $row->media);
                    print_R($listimg);
                    foreach ($listimg as $key_number => $img) {
                        if ($img) {
                            $sqli_pesan = [];

                            $sqli_pesan['tipe_pesan'] = "media";
                            $sqli_pesan['media'] = $img;

                            $sqli_pesan['id_share__wa_group__post'] = $row->id_wa_post;
                            $sqli_pesan['id_share__post'] = $row->id_share__post;
                            print_r($sqli_pesan);
                            $id_pesan = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli_pesan, [], 'chat__broadcast__list__pesan');
                            $id_pesan_array['id_pesan'][] = $id_pesan;
                            $id_pesan_array['id_share__wa_group__post'][] = $row->id_wa_post;
                            $id_pesan_array['id_share__post'][] = $row->id_share__post;
                        }
                    }
                }
                $sqli_pesan = [];
                $sqli_pesan['tipe_pesan'] = "message";
                $sqli_pesan['pesan'] = $row->caption;
                $sqli_pesan['id_share__wa_group__post'] = $row->id_wa_post;
                $sqli_pesan['id_share__post'] = $row->id_share__post;

                $id_pesan = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli_pesan, [], 'chat__broadcast__list__pesan');

                $id_pesan_array['id_pesan'][] = $id_pesan;
                $id_pesan_array['id_share__wa_group__post'][] = $row->id_wa_post;
                $id_pesan_array['id_share__post'][] = $row->id_share__post;
                $id_admin_array[$row->kode_post]['kode_jam'][] = $row->kode_post_group;
                $id_admin_array[$row->kode_post]['id_share__wa_group__post'][] = $row->id_wa_post;
                $id_admin_array[$row->kode_post]['id_share__post'] = $row->id_share__post;
                $id_admin_array[$row->kode_post]['status_approve'][] = $row->status_approve;
            }
            // print_r($id_admin_array);
            $count = 0;
            
            if ($type_proses == 'kirim_share_wag_group') {
                DB::selectRaw('*,share__wa_group__jam.id as id_jam');
                DB::table('chat_wa_phonebook__number');
                DB::joinRaw("chat_wa_number on id_number= chat_wa_number.id", "LEFT");
                DB::joinRaw("share__wa_group__jam on 1=1", "FULL ");
                DB::whereRaw("id_chat_wa_phonebook=1 and (select count(*) from chat__broadcast__generate where id_share_jam is not null and chat_wa_number.wa_number = chat__broadcast__generate.number and generate_tanggal=concat('$tanggal_post',' ',share__wa_group__jam.jam)::timestamp)=0");
                DB::orderRaw($page, "urutan_perioritas desc,jam asc");
                DB::limitRaw($page, $row->jumlah_group);
                $get = DB::get('all');

                if ($get['num_rows']) {
                    foreach ($get['row'] as $row_jadwal) {
                        $count++;
                        $sqli = [];

                        $sqli['number'] = $row_jadwal->wa_number;
                        $sqli['generate_tanggal'] = $tanggal_post . ' ' . $row_jadwal->jam;
                        $sqli['status'] = 'belum';
                        $sqli['id_share_jam'] = $row_jadwal->id_jam;
                        foreach ($id_pesan_array['id_pesan'] as $key_pesan => $value_pesan) {
                            $sqli['id_share__wa_group__post'] = $id_pesan_array['id_share__wa_group__post'][$key_pesan];
                            $sqli['id_share__post'] = $id_pesan_array['id_share__post'][$key_pesan];
                            $sqli['id_pesan'] = $value_pesan;
                            CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli, [], 'chat__broadcast__generate');
                        }
                        if ($count >= $row->jumlah_group) {
                            break;
                        }
                    }
                }

                CRUDFunc::crud_process(new MainFaiFramework(), $page, ["status_generate" => "Sudah"], [], 'share__wa_group__post', [], 'update', 'id', $row->id_wa_post);
            } else if ($type_proses == 'kirim_acc_dec_admin') {
                // $id_admin_array[$row->kode_post]['kode_jam'][] = $row->kode_post_jam;
                // $id_admin_array[$row->kode_post]['id_share__wa_group__post'][] = $row->id_wa_post;
                // $id_admin_array[$row->kode_post]['id_share__post'] = $row->id_share__post;

                foreach ($id_admin_array as $kode_post => $value_admin) {

                    $sqli_pesan = [];
                    $sqli_pesan['tipe_pesan'] = "message";
                    $sqli_pesan['pesan'] = "
                    Approve Post \n
                    *>>Share Acc " . $kode_post . "* \n
                    Decline Post \n
                    *>>Share Dec " . $kode_post . "* \n
                    \n
                    Status
                    ";

                    $id_pesan = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli_pesan, [], 'chat__broadcast__list__pesan');
                    $id_pesan_array['id_pesan'][] = $id_pesan;
                    $id_pesan_array['id_share__wa_group__post'][] = null;
                    $id_pesan_array['id_share__post'][] = $id_admin_array[$kode_post]['id_share__post'];
                    foreach ($id_admin_array[$kode_post]['kode_jam'] as $kode_jam => $value_admin) {
                        $sqli_pesan = [];
                        $sqli_pesan['tipe_pesan'] = "message";
                        if ($id_admin_array[$kode_post]['status_approve'][$kode_jam] == '1') {
                            $status_app = "Disetujui";
                        } else if ($id_admin_array[$kode_post]['status_approve'][$kode_jam] == '2') {
                            $status_app = "Ditolak";
                        } else if ($id_admin_array[$kode_post]['status_approve'][$kode_jam] == '3') {
                            $status_app = "Pending";
                        } else {
                            $status_app = "Pending " . $id_admin_array[$kode_post]['status_approve'][$kode_jam];
                        }
                        $sqli_pesan['pesan'] = "
                        Approve Post \n
                        *>>Share Jadwal Acc " . $value_admin . "* \n
                        Decline Post \n
                        *>>Share Jadwal Dec " . $value_admin . "*\n
                        \n
                        Status Jadwal: $status_app
                        ";

                        $id_pesan = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli_pesan, [], 'chat__broadcast__list__pesan');
                        $id_pesan_array['id_pesan'][] = $id_pesan;
                        $id_pesan_array['id_share__wa_group__post'][] = $id_admin_array[$kode_post]['id_share__wa_group__post'][$kode_jam];
                        $id_pesan_array['id_share__post'][] = $id_admin_array[$kode_post]['id_share__post'];
                    }
                }




                DB::selectRaw('*');
                DB::table('chat_wa_phonebook__number');
                DB::joinRaw("chat_wa_number on id_number= chat_wa_number.id", "LEFT");
                DB::whereRaw("id_chat_wa_phonebook=2");
                $get = DB::get('all');

                if ($get['num_rows']) {
                    foreach ($get['row'] as $row_jadwal) {
                        $count++;
                        $sqli = [];

                        $sqli['number'] = $row_jadwal->wa_number;
                        $sqli['generate_tanggal'] = date('Y-m-d H:i:s');
                        $sqli['status'] = 'belum';

                        foreach ($id_pesan_array['id_pesan'] as $key_pesan => $value_pesan) {
                            $sqli['id_share__wa_group__post'] = $id_pesan_array['id_share__wa_group__post'][$key_pesan];
                            $sqli['id_share__post'] = $id_pesan_array['id_share__post'][$key_pesan];
                            $sqli['id_pesan'] = $value_pesan;
                           
                            CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli, [], 'chat__broadcast__generate');
                        }
                        if ($count >= $row->jumlah_group) {
                            break;
                        }
                    }
                }
            }
        }
        return $get['num_rows'];
    }
    public static function daftar_mitra($page)
    {
        return 0;
    }
    public static function export_to_spreasheet_penjualan($page)
    {
        return 0;
    }
    public static function proses_spreasheet_penjualan($page)
    {
        return 0;
    }
    public static function broadcast_wa($page)
    {
        DB::connection($page);
        $fai = new MainFaiFramework();
        $wa = new WaApp();
        $database_check['select'][] = '*';
        $database_check['select'][] = 'chat__broadcast__generate.id as pid';
        $database_check['utama'] = 'chat__broadcast__generate';
        $database_check['limit'] = 5;
        $database_check['np'] = 5;
        $database_check['join'][] = array('chat__broadcast__list__pesan', "id_pesan", "chat__broadcast__list__pesan.id");
        $database_check['join'][] = array('drive__file', "media", "drive__file.id", 'left');
        $database_check['where'][] = array('status', ' = ', "'belum'");
        $database_check['where'][] = array('generate_tanggal', ' <= ', "'" . date('Y-m-d H:i:s') . "'");
        $database_check['order'][] = array('generate_tanggal', ' asc');
        $database_check['order'][] = array('id_pesan', ' asc');
        $database_check['order'][] = array('number', ' asc');

        $row = Database::database_coverter($page, $database_check, array(), 'all');
        echo '<pre>';
        print_R($row);
        echo '<pre>';

        if ($row['num_rows']) {
            foreach ($row['row'] as $data) {
                // echo $data->number;
                // echo  $data->pesan;
                // echo $data->tipe_pesan;
                $data->number = str_replace("@c.us", "", $data->number);
                if (strlen($data->number) > 14 and !strpos($data->number, '@g.us'))
                    $data->number .= "@g.us";
                else {
                    $data->number .= "@c.us";
                }
               
                $path = Partial::url_file($data);
                if ($data->tipe_pesan == 'command') {
                    $chat['from'] =  $data->number;
                    $chat['message'] =  $data->pesan;
                    ChatApp::initialize_chat($page, $chat);
                    $json = json_encode(["status" => true]);
                } else
                    $json = $wa->send($page,$data->number, $data->pesan, $data->tipe_pesan, $path);
                $de = json_decode($json, true);
                //$de['status']=true;
                print_r($de);
                if (!isset($de['massage_status']) and isset($de['status'])) {
                    if ($de['status'] == 200) {
                        $de['message_status'] = "Success";
                    } else {
                        $de['message_status'] = "gagal";
                    }
                }
                if ($de['message_status'] == "Success") {
                    echo 'masuk';
                    $dataChat['status'] = "sudah";
                    $dataChat['generate_done'] = date('Y-m-d H:i:s');
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, [], array(), array(), 'chat__broadcast__generate', 'id', $data->pid, []);
                    die;
                } else
                if ($de['message_status'] == "gagal") {
                    echo 'masuk';
                    $dataChat['status'] = "gagal";
                    $dataChat['generate_done'] = date('Y-m-d H:i:s');
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, [], array(), array(), 'chat__broadcast__generate', 'id', $data->pid, []);
                    die;
                }
            }
        }
        return   $row['num_rows'];
    }
    public static function proses_broadcast_wa($page)
    {
        $count = ChatApp::proses_brodcast($page);

        return $count;
    }
    public static function send_wa($page)
    {
        DB::connection($page);
        $fai = new MainFaiFramework();
        $wa = new WaApp();
        $database_check['select'][] = '*';
        $database_check['select'][] = 'chat__room__pesan.id';
        $database_check['select'][] = 'chat__room.number_from';
        $database_check['utama'] = 'chat__room__pesan';
        $database_check['where'][] = array('send_wa', ' = ', "2");
        $database_check['join'][] = array('drive__file', ' drive__file.ref_external_id ', "chat__room__pesan.id and drive__file.ref_database='chat__room__pesan'", 'left');
        $database_check['join'][] = array('chat__room', ' chat__room.id ', "chat__room__pesan.id_chat__room", 'left');
        $database_check['order_by'][] = array('chat__room__pesan.id_chat__room');
        $database_check['order_by'][] = array('sort');
        $row = Database::database_coverter($page, $database_check, array(), 'all');
        if ($row['num_rows']) {
            foreach ($row['row'] as $data) {
                
                echo '</pre>';
                echo '<pre>';
                echo '<br>';
                echo '<br>';
                //  //print_r($data_wa);
                $from = trim($data->number_from);
                if ($data->tipe_room == 'wagrup') {
                    $from .= "@g.us";
                } else {
                    $from .= "@c.us";
                }   
                if(!$data->tipe_pesan){
                    if($data->ref_database){
                        $data->tipe_pesan='media';
                    }else{
                        $data->tipe_pesan='message';

                    }
                }
                echo $data->tipe_pesan;
                echo $json = $wa->send($page,$from, $data->content_message, $data->tipe_pesan, $data->path);
                $de = json_decode($json, true);
                //$de['status']=true;
                //print_r($de);
                if ($de['status'] == true) {
                    $dataChat['send_wa'] = 1;
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room__pesan', 'id', $data->id);
                } else {
                    $dataChat['massage_send_wa'] = $de['msg'] . $de['errors'];
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room__pesan', 'id', $data->id);
                }
            }
        }
        return $row['num_rows'];
    }
}
