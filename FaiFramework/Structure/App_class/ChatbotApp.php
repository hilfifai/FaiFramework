<?php

require_once(__DIR__ . '/../Chatbot_class/Ecommerce_produk.php');
require_once(__DIR__ . '/../Chatbot_class/Bot_Quran.php');
require_once(__DIR__ . '/../Chatbot_class/WhatsAppWebhookHandler.php');
class ChatbotApp
{
    public static function router($page, $data, $id_chat_room = null, $id_chat_massage = null, $is_wa = false, $data_wa = [])
    {
        try {

            $page['no_change_transaction'] = true;
            date_default_timezone_set('Asia/Jakarta');
            if (empty($data['content_message'])) {
                return;
            }
            $message = explode(' ', strtolower($data['content_message']));
            $message_line = preg_split("/\r\n|\r|\n/", strtolower($data['content_message']));
            $data['mode'] = "utama";
            if (strtolower(trim($message[0])) == 'pesan') {
                ChatbotApp::wawebhook_router($page, $data, $data['content_message'], $id_chat_massage, $id_chat_room, $is_wa, $data_wa);;
            } else if (strtolower($message[0]) == 'e') {

                ChatbotApp::ecommerce_router($page, $data, $data['content_message'], $id_chat_massage, $id_chat_room, $is_wa, $data_wa);;
            } else if (in_array((strtolower($message[0])), array('>>share')) or in_array((strtolower($message[0])), array('share'))) {
                ChatbotApp::share_router($page, $data, strtolower($data['content_message']), $id_chat_massage, $id_chat_room, $is_wa, $data_wa);
            } else if (in_array((strtolower($message[0])), array('qs', 'quran'))) {

                ChatbotApp::quran_router($page, $data, $data['content_message'], $id_chat_massage, $id_chat_room, $is_wa, $data_wa);
            } else {
                ChatbotApp::define_chat_bot($page, $data, $data['content_message'], $id_chat_massage, $id_chat_room, $is_wa, $data_wa);
            }
        } catch (Exception $e) {
            echo '<pre>';
            print_R($e->getTraceAsString());
        }
    }
    public static function define_chat_bot($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa)
    {
        $fai = new MainFaiFramework();
        $content_massage_temp = ($content_massage);
        $db_room['select'][] = "*";
        $db_room['utama'] = "chat__room";
        $db_room['non_add_select'] = true;
        $db_room['where'][] = array("id", '=', $id_chat_room);
        $chat_room = $fai->database_coverter($page, $db_room, array(), 'all');
        $chat_room = $chat_room['row'][0];
        //  print_r($chat_room);
        $prev        = $chat_room->bot_position;
        $uniq        = $chat_room->bot_unique_id;
        $keyword_cek = '/end ' . $chat_room->package_bot ? strtolower($chat_room->package_bot) : "";
        $bot = null;
        if ($prev) {
            $db_bot['select'][] = "*";
            $db_bot['utama'] = "chat__bot";
            $db_bot['non_add_select'] = true;
            $db_bot['where'][] = array("id_prev", '=', $prev);
            $db_bot['where'][] = array("package_bot", '=', "'$chat_room->package_bot'");
            $data_bot = $fai->database_coverter($page, $db_bot, array(), 'all');;
            if ($data_bot['num_rows'])
                $bot          = $data_bot['row'][0];
        }
        //print_r($bot);


        $content_massage = str_replace('<br>', '', $content_massage);
        $content_massage = str_replace('&gt;', '>', $content_massage);
        //	echo $content_massage."test";  
        if ($chat_room->status_bot == 'aktif') {

            if (strpos($content_massage, '/') !== false and  strtolower($content_massage) != strtolower($keyword_cek)) {
                $massage = 'Anda sedang dalam <b>sesi ' . $chat_room->package_bot . '</b>, Silahkan ketikan <b> "/end ' . strtolower($chat_room->package_bot) . '"</b> untuk mengakhiri sesi';
                //$data['content_massage'] = "";
                ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $data['mode'], $is_wa, $data_wa, $bot, $uniq, false);

                $status = FALSE;
            } else if (strtolower($content_massage) == strtolower($keyword_cek)) {
                $massage = 'Anda mengakhiri <b>sesi ' . $chat_room->package_bot . '</b>';
                //$data['content_massage'] = "";
                ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $data['mode'], $is_wa, $data_wa, $bot, $uniq, false);

                $dataChat['status_bot'] = 'tidak aktif';
                $dataChat['bot_position'] = null;
                $dataChat['package_bot'] = null;
                $dataChat['bot_unique_id'] = null;
                $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room', 'id', $id_chat_room);
            }
        }
        //echo 'haaaa';
        if (!empty($chat_room->allow_massage)  and $status and $content_massage != $keyword_cek) {
            $allow = explode('###', $chat_room->allow_massage);
            if (!in_array($content_massage, $allow)) {
                $massage = 'Data Yang anda inputkan salah silahkan cek kembali. Hanya Boleh mengirimkan pesan : ' . implode(',', $allow);

                //$data['content_massage'] = "";
                //	echo 'halllloooo';
                ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $data['mode'], $is_wa, $data_wa, $bot, $uniq, false);

                //                ChatApp::altenatif_send_massage($massage, $id_chat_room, $bot, $uniq);

                $status = FALSE;
            } else {
                $status = true;
            }
        } else {
            $status = true;
        }
        if ($chat_room->status_bot != 'aktif') {

            $content_massage_temp;
            if ($content_massage_temp) {
                $db_cari_bot['select'][] = "*";
                $db_cari_bot['utama'] = "chat__bot";
                $db_cari_bot['non_add_select'] = true;
                $db_cari_bot['where'][] = array("LOWER(keyword)", '=', "'$content_massage_temp'");
                $db_cari_bot['where'][] = array("id_prev", '=', "0");
                $data_cari_bot = $fai->database_coverter($page, $db_cari_bot, array(), 'all');
                if ($data_cari_bot['num_rows']) {
                    $bot = $data_cari_bot['row'][0];
                    $massage = $bot->reply_content;
                    //$data['content_massage'] = "";
                    $uniq = uniqid();
                    ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $data['mode'], $is_wa, $data_wa, $bot, $uniq, false);

                    $prev = $bot->kode_chat_room_bot;
                    if ($bot->bot_loop != 2) {
                        $dataChat['status_bot'] = 'aktif';
                        $dataChat['bot_position'] = $bot->kode_chat_room_bot;
                        $dataChat['package_bot'] = $bot->package_bot;
                        $dataChat['bot_unique_id'] = $uniq;
                        $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room', 'id', $id_chat_room);
                        $chat_room = $fai->database_coverter($page, $db_room, array(), 'all');
                        $chat_room = $chat_room['row'][0];
                    }
                }
            }
        }
        if ($chat_room->status_bot == 'aktif') {
            if ($chat_room->package_bot == 'Input Barang') {
                Ecommerce_produk::input_produk($page, $content_massage, $id_chat_room, $id_chat_massage);
            } else if ($chat_room->package_bot == 'Penjualan Tenant') {
                Ecommerce_produk::penjualan_tenant($page, $content_massage, $data['mode'], $bot, $uniq, $id_chat_room, $id_chat_massage, $prev, $fai, $is_wa, $data_wa);
            }
        }
    }

    public static function share_router($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa)
    {
        $content_massage = str_replace(">>share ", "", $content_massage);
        $content_massage = str_replace("share ", "", $content_massage);
        $content_massage = str_replace("  ", " ", $content_massage);
        $ex = explode(" ", $content_massage);
        // *>>Share Acc " . $kode_post . "* \n
        //             Decline Post \n
        //             *>>Share Dec " . $kode_post . "* \n
        // Approve Post \n
        //                 *>>Share Acc Jadwal " . $value_admin . "* \n
        //                 Decline Post \n
        //                 *>>Share Dec Jadwal " . $value_admin . "*\n
        //                 \n
        //                 Status Jadwal: $status_app
        //                 "
        if (strtolower($ex[0]) == 'list') {
            DB::table('share__post');
            DB::whereRaw("(select count(*) from share__wa_group__post where status_approve='3' and share__post.id = id_share__post )>0 or status_approve_post='3'");
            $get = DB::get('all');
            foreach ($get['row'] as $row) {
                Cronjob::proses_share($page, $row->id, 'kirim_acc_dec_admin');
            }
        } elseif (strtolower($ex[0]) == 'acc') {
            $kode = $ex[1];
            CRUDFunc::crud_process(new MainFaiFramework, $page, ["status_approve_post" => "1"], [], "share__post", [], 'update', 'kode_post', $kode);
            $data_wa['send_wa_konfirm'] = true;
            ChatApp::altenatif_send_massage($page, $id_chat_room, "Share Berhasil $kode sudah di approve", -1, "utama", 1, $data_wa);
        } elseif (strtolower($ex[0]) == 'dec') {
            $kode = $ex[1];
            CRUDFunc::crud_process(new MainFaiFramework, $page, ["status_approve_post" => "2"], [], "share__post", [], 'update', 'kode_post', $kode);
            $data_wa['send_wa_konfirm'] = true;
            ChatApp::altenatif_send_massage($page, $id_chat_room, "Share Berhasil $kode sudah di tolak", -1, "utama", 1, $data_wa);
        } elseif (strtolower($ex[0]) == 'jadwal' and strtolower($ex[1]) == 'acc') {
            $kode = $ex[2];
            CRUDFunc::crud_process(new MainFaiFramework, $page, ["status_approve" => "1"], [], "share__wa_group__post", [], 'update', 'kode_post_group', "'$kode'");
            // $data_wa['participant'] = "";
            $data_wa['send_wa_konfirm'] = true;
            ChatApp::altenatif_send_massage($page, $id_chat_room, "Jadwal Berhasil $kode sudah di approve", -1, "utama", 1, $data_wa);
        } elseif (strtolower($ex[0]) == 'jadwal' and strtolower($ex[1]) == 'desc') {
            $kode = $ex[2];
            CRUDFunc::crud_process(new MainFaiFramework, $page, ["status_approve" => "2"], [], "share__wa_group__post", [], 'update', 'kode_post_group', $kode);
            $data_wa['send_wa_konfirm'] = true;
            ChatApp::altenatif_send_massage($page, $id_chat_room, "Jadwal Berhasil $kode sudah di tolak", -1, "utama", 1, $data_wa);
        }
    }

    public static function quran_router($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa)
    {
        $content_massage = str_replace("qs ", "", $content_massage);
        //print_r($data);
        $ex = explode(" ", $content_massage);

        if (strtolower($ex[0]) == 'help') {
            Bot_Quran::help($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $ex);
        } elseif (strtolower($ex[0]) == 'juz') {

            Bot_Quran::juz($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $ex);
        } else if (strtolower($ex[0]) == 'hal') {
            echo 'hi';
            Bot_Quran::halaman($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $ex);
        } else {
            // Bot_Quran::surat_ayat($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $ex);
        }
    }
    public static function ecommerce_router($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa)
    {
        //print_r($data);
        if (strtolower(substr($data['content_message'], 0, strlen('e get produk'))) == 'e get produk') {

            $total = (int) trim(str_ireplace('e get produk', '', $data['content_message']));
            if (!$total) {
                $total = 1;
            }
            //  echo 'masuk';
            Ecommerce_produk::random_produk($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $total);
        }
    }
    public static function wawebhook_router($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa)
    {
        //print_r($data);
        $result = WhatsAppWebhookHandler::handleOrderFromWA($page, $data);
        if ($result['status'] == 1) {
            $response = $result['message'];
        } else {
            $response = "❌ *GAGAL MEMPROSES PESANAN*\n\n";
            $response .= "Error: {$result['message']}\n\n";
            $response .= "Format yang benar:\n";
        }
        $wa = new WaApp();

        $wa->send($page, $data['participant'], $response);
        // Kirim response ke WhatsApp
        // echo $response;
        echo json_encode(["status"=>1]);
        //  echo 'masuk';
        // Ecommerce_produk::random_produk($page, $data, $content_massage, $id_chat_massage, $id_chat_room, $is_wa, $data_wa, $total);
    }
}
