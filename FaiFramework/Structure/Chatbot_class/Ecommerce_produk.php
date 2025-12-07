<?php

require_once(__DIR__.'/../App_class/WaApp.php');
class Ecommerce_produk
{
    public static function random_produk($page, $data_post, $content_massage, $id_chat_massage, $id_chat_room,$is_wa,$data_wa, $total = 1)
    {

        DB::connection($page);
        DB::table('store__produk');
        DB::selectRaw('*');
        DB::selectRaw('store__produk.id as id_produk');
        DB::joinRaw('inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset');
        DB::joinRaw('inventaris__asset__master__brand on inventaris__asset__master__brand.id = inventaris__asset__list.id_brand');
        DB::whereRaw("inventaris__asset__list.jual_barang = 'Ya'");
        DB::whereRaw("inventaris__asset__master__brand.jual_produk = 1");
        DB::limitRaw($page, $total);
        DB::orderByRaw($page, array(array("random()", '')));
        // print_r(DB::get('query'));
        $produk = DB::get('all');
      
        $data = EcommerceApp::get_data_detail($page, $produk);
 


        $i = 1;
        $menit = date('Y-m-d H:i:s');

        for ($i = 1; $i <= $total; $i++) {

            //  $menit = date('Y-m-d H:i:s', strtotime($menit.'+1 hour'));
            // $menit = date('Y-m-d H:i:s', strtotime($menit.'+15 minute'));
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+5 minute'));
            $sql = "INSERT INTO `campaigns` (`id`, `user_id`, `session_id`, `name`, `phonebook_id`, `message_type`, `message`, `status`, `delay`, `scheduled_at`, `created_at`, `updated_at`) 
            
            VALUES (NULL, '1', 'ff7f9bfe-a480-47c0-b40b-0eeb61e9e2c5', 'Start " . $data[$i]['nama_produk'] . "', '1', 'text', '{\"message\":\"*Random Produk:" . $data[$i]['nama_produk'] . "*\"}', 'waiting', '10', '$menit', '2024-02-21 20:45:47', '2024-02-21 21:03:03');
        ";
            $message= "<b>Random Produk:" . $data[$i]['nama_produk'] . "</b>";
            // $wa = new WaApp();
            // $wa->send($data_post['from'], $message);
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+5 minute'));
            $mode = $data_post['mode'];
            ChatApp::altenatif_send_massage($page, $id_chat_room, $message, -2, $mode,$is_wa,$data_wa, array(), "", false);

            // $conn->query($sql);

            for ($ii = 1; $ii <= count($data[$i]['gambar_produk']); $ii++) {
                $gambar = $data[$i]['gambar_produk'][$ii];
                //$gambar = str_replace("/","\\\/",$gambar);
                $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
               // $wa->send($data_post['from'], "", 'media', $gambar);
                ChatApp::altenatif_send_massage($page, $id_chat_room, "", -2, $mode,$is_wa,$data_wa,  array(), "", false, 'media', $gambar);
            }
            if (isset($data[$i]['varian'])) {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    if (isset($data[$i]['varian'][$ii]['gambar_produk_varian'])) {
                        for ($iii = 1; $iii <= count($data[$i]['varian'][$ii]['gambar_produk_varian']); $iii++) {
                            $gambar = $data[$i]['varian'][$ii]['gambar_produk_varian'][$iii];
                            //$gambar = str_replace("/","\\\/",$gambar);
                            $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
                            //$wa->send($data_post['from'], "Varian " . $data[$i]['varian'][$ii]['nama_varian'], 'media', $gambar);
                            ChatApp::altenatif_send_massage($page, $id_chat_room, $data[$i]['varian'][$ii]['nama_varian'], -2, $mode,$is_wa,$data_wa,  array(), "", false, 'media', $gambar);

                        }
                    }
                }
            }
            for ($ii = 1; $ii <= count($data[$i]['thumbail_produk']); $ii++) {
                $gambar = $data[$i]['thumbail_produk'][$ii];
                //$gambar = str_replace("/","\\\/",$gambar);
                $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
                //$wa->send($data_post['from'], "*" . $data[$i]['nama_produk'] . "*", 'media', $gambar);
                ChatApp::altenatif_send_massage($page, $id_chat_room, "<b>" . $data[$i]['nama_produk'] . "</b>", -2, $mode,$is_wa,$data_wa,  array(), "", false, 'media', $gambar);
            }

            $deskripsi = $data[$i]['deskripsi'];
            $deskripsi = str_replace(
                '&lt;div&gt;Kelebihan berbelanja di Official Shop kami:&lt;/br&gt;-Barang dijamin branded dengan label kami sendiri&lt;/br&gt;-Desain baju kami exclusive tidak dijual bebas&lt;/br&gt;-Semua barang kami ready stok, langsung di order aja ya kak&lt;/br&gt;-Foto produk kami juga real pic difoto langsung distudio kami sendiri&lt;/br&gt;-Bahannya dijamin high quality &amp; enggak akan mengecewakan, bisa juga untuk kamu jual lagi&lt;/br&gt;-Free retur jika barang salah kirim atau cacat&lt;/br&gt;-Free ongkir untuk pembelian di Official Shop minimum pembelian lebih rendah daripada toko non-official&lt;/br&gt;-Langsung lihat toko kami ya kak untuk membeli item lainnya. Banyak baju lucu dengan harga hemat ditoko kami&lt;/br&gt;',
                '',
                $deskripsi
            );
            $deskripsi = str_replace(
                '&lt;/br&gt;Note: Cocok untuk ukuran tubuh wanita asia&lt;/br&gt;Tips mencuci pakaian:&lt;/br&gt;- Direkomendasikan mengunakan pelapis tambahan ketika mengunakan setrika &lt;/br&gt;- Saat mengunakan setrika sebaiknya dengan suhu rendah&lt;/br&gt;- Jika menggunakan pengering mesin cuci atur dengan kekuatan sedang&lt;/br&gt;- Jika menggunakan tangan peras baju perlahan-lahan, jangan memeras terlalu kencang &lt;/br&gt;- Jangan mengunakan pemutih untuk keperluan sehari-hari&lt;/br&gt;- Supaya warna tidak mudah pudar hindari pengeringan langsung dibawah sinar matahari&lt;/br&gt;- Sebaiknya gunakan hanger untuk mengeringkan&lt;/br&gt;&lt;/div&gt;',
                '',
                $deskripsi
            );
            $deskripsi = str_replace('&lt;/br&gt;', "\r\n", $deskripsi);
            $deskripsi = str_replace('&lt;br&gt;', "\r\n", $deskripsi);

            $deskripsi = htmlspecialchars_decode($deskripsi);
            $deskripsi =  str_replace('<br>', "\r\n", $deskripsi);
            $deskripsi .= "\r\n\r\n*Harga:" . $data[$i]['harga_jual'] . "* ";
            if ($data[$i]['is_varian_produk'] == 'Ya') {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    $deskripsi .= "\r\nHarga Varian - " . $data[$i]['varian'][$ii]['nama_varian'] . " - " . $data[$i]['varian'][$ii]['harga_jual'] . "";
                }
            }
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
            $deskripsi = "<b>" . $data[$i]['nama_produk'] . "</b>\r\n" . $deskripsi;
            //$deskripsi = substr($deskripsi,1,-1);
            ////
            ChatApp::altenatif_send_massage($page, $id_chat_room, $deskripsi, -2, $mode,$is_wa,$data_wa,  array(), "", false);

            // $wa->send($data_post['from'], $deskripsi);
            //////////
            $menit = date('Y-m-d H:i:s', strtotime($menit . '+1 minute'));
            //print_r($data[$i]);
            $harga = "\r\n\r\n*Harga Jual Mitra:" . Partial::rupiah($data[$i]['harga_jual']) . "*";
            if (isset($data[$i]['varian'])) {
                for ($ii = 1; $ii <= count($data[$i]['varian']); $ii++) {
                    $harga .= "\r\n<b>" . $data[$i]['varian'][$ii]['nama_varian'] . "</b>\r\n Harga Jual Varian:" . Partial::rupiah($data[$i]['varian'][$ii]['harga_jual_akhir']) . "";
                    $mitra = $data[$i]['varian'][$ii]['harga_mitra'];
                    foreach (($mitra) as $iii => $value) {
                        $harga .= "\r\n\r\n<i>" . $iii . "</i>";

                        foreach (($mitra[$iii]) as $iiii => $value2) {
                            $harga .= "\r\n Pembelian Min " . $mitra[$iii][$iiii]['minimal_pembelian'] . ($mitra[$iii][$iiii]['maksimal_pembelian'] ? ' s/d ' . $mitra[$iii][$iiii]['maksimal_pembelian'] : '') . ' : ' . Partial::rupiah($mitra[$iii][$iiii]['harga_jual_mitra']) . "(-" . ($mitra[$iii][$iiii]['tipe_margin_mitra'] == "Rp" ? "Rp. " : '') . $mitra[$iii][$iiii]['margin_mitra'] . ($mitra[$iii][$iiii]['tipe_margin_mitra'] == "%" ? "%" : '') . ")";
                        }
                    }
                }
            } else {
                $mitra = $data[$i]['harga_mitra'];
                foreach (($mitra) as $iii => $value) {
                    $harga .= "\r\n\r\n<i>" . $iii . "</i>";
                    //print_r($data[$i]['harga_mitra']);
                    foreach (($mitra[$iii]) as $iiii => $value2) {
                       // print_r($mitra[$iii][$iiii]);
                        $harga .= "\r\n Pembelian Min " . $mitra[$iii][$iiii]['minimal_pembelian'] . ($mitra[$iii][$iiii]['maksimal_pembelian'] ? ' s/d ' . $mitra[$iii][$iiii]['maksimal_pembelian'] : '') . ' : ' . Partial::rupiah($mitra[$iii][$iiii]['harga_jual_mitra']);
                    }
                }
            }
            $harga = "<b>Informasi Harga Mitra</b>" . $harga;
            //$harga = substr($harga,1,-1);
            //$wa->send($data_post['from'], $harga);
            ChatApp::altenatif_send_massage($page, $id_chat_room, $harga, -2, $mode,$is_wa,$data_wa,  array(), "", false);

        }
       
    }
    public static function penjualan_tenant($page, $content_massage, $mode, $bot, $uniq, $id_chat_room, $id_chat_massage, $prev, $fai,$is_wa,$data_wa)
    {
        echo $prev;
        $package_bot = 'Penjualan Tenant';
        $db_bot['select'][] = "*";
        $db_bot['utama'] = "chat__bot";
        $db_bot['non_add_select'] = true;
        $db_bot['where'][] = array("id_prev", '=', $prev);
        $db_bot['where'][] = array("package_bot", '=', "'$package_bot'");
        $data_bot = Database::database_coverter($page, $db_bot, array(), 'all');
        // echo $data_bot['']
        if ($data_bot['num_rows']) {
            $next_bot = $data_bot['row'][0];
            if ($next_bot->type_bot == 'direct_massage') {
                $next_bot = $next_bot;
                if ($next_bot->reply_package == 'list_store') {
                    $massage          = 'Bismillah,<br>
					Silahkan untuk memilih Distributor Barang<br>';
                    $db_store['select'][] = "*";
                    $db_store['utama'] = "store__toko";
                    $data_store = Database::database_coverter($page, $db_store, array(), 'all');



                    $allow_massage    = '';
                    if ($data_store['num_rows']) {

                        foreach ($data_store['row'] as $distributor) {
                           // print_r($distributor);
                            $massage .= $distributor->id . '. ' . $distributor->nama_toko . '<br>';
                            $allow_massage .= $distributor->id . '###';
                        }
                    }
                    ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $mode,$is_wa,$data_wa, $next_bot, $uniq, false);



                    unset($dataChat);
                    $dataChat['bot_position'] = $next_bot->kode_chat_room_bot;
                    $dataChat['allow_massage'] = $allow_massage;
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room', 'id', $id_chat_room);
                }
            } else if ($next_bot->type_bot == 'save_moment') {
                if ($next_bot->reply_package == 'save_store') {
                    $save['bot_unique_id'] = $uniq;
                    $save['id_chat__room'] = $id_chat_room;
                    $save['id_chat__bot'] = $next_bot->id;
                    $save['package_bot'] = $next_bot->package_bot;
                    $save['reply_package'] = $next_bot->reply_package;
                    $save['content'] = $content_massage;
                    $save['status_generate'] = 'belum';
                    $return = CRUDFunc::crud_save($fai, $page, $save, array(), array(), 'chat__bot__save');
                    $db_store['select'][] = "*";
                    $db_store['utama'] = "store__toko";
                    $data_store = Database::database_coverter($page, $db_store, array(), 'all');


                   
                  
                    $massage = 'Store yang ada pilih adalah ' . $data_store['row'][0]->nama_toko;
                    ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $mode,$is_wa,$data_wa, $next_bot, $uniq, false);
                    $massage = 'Selanjutnya kirimkan stok produk dengan format dibawah ini';
                    ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $mode,$is_wa,$data_wa, $next_bot, $uniq, false);
                    $massage = '[Stock Penjualan Tenant]<br>
                    <br>
                    Format Stok<br>
                    Barcode - Jumlah Stok<br>
                    <br>
                    Contoh<br>
                    1234567890 - 5<br>
                    1234567810 - 2<br>
                    <br>
                    List Stok Penjualan Tenant:<br>
                    <br>
                    <br>
                    <br>
                    -------(BARIS INI JANGAN DI HAPUS)------
                    ';
                    ChatApp::altenatif_send_massage($page, $id_chat_room, $massage, -2, $mode,$is_wa,$data_wa, $next_bot, $uniq, false);
                    $dataChat['bot_position'] = $next_bot->kode_chat_room_bot;
                    $dataChat['allow_package'] = '>First:[Stock Penjualan Tenant]';
                    $return = CRUDFunc::crud_update($fai, $page, $dataChat, array(), array(), array(), 'chat__room', 'id', $id_chat_room);
                }
            }
        }
    }
    public static function input_produk($page, $content_massage, $id_chat_room, $id_chat_massage)
    {

        $package_bot = 'Input Barang';
        $content_massage = ($content_massage);
        echo '<br>';
        echo $content_massage;
        if (strtolower($content_massage) == '>>input barang') {

            $bot = $ci->db->where(array('keyword'    => '>>input barang', 'package_bot' => 'Input Barang'))->get('chat_room__bot')->row();
            $massage = $bot->reply_content;

            $uniq = uniqid();
            ChatApp::altenatif_send_massage($massage, $id_chat_room, $bot, $uniq);

            $prev = $bot->kode_chat_room_bot;

            $dataChat['status_bot'] = 'aktif';
            $dataChat['bot_position'] = $bot->kode_chat_room_bot;
            $dataChat['package_bot'] = $bot->package_bot;
            $dataChat['bot_unique_id'] = $uniq;
            $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
        } else
			if (strtolower($content_massage) == '>>end input barang') {
            //202103170127197
            //echo 'masuk';
            $bot = $ci->db->where(array('keyword'    => '>>end input barang', 'package_bot' => 'Input Barang'))->get('chat_room__bot')->row();
            $massage = $bot->reply_content;
            ChatApp::altenatif_send_massage($massage, $id_chat_room, $bot, $uniq);

            //$data['content_massage'] = "";

            $prev = $bot->kode_chat_room_bot;

            $dataChat['status_bot'] = 'tidak aktif';
            $dataChat['bot_position'] = '';
            $dataChat['package_bot'] = '';
            $dataChat['bot_unique_id'] = '';
            $dataChat['allow_massage'] = '';
            $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
        } else
			if (strtolower($content_massage) == '>caption' or strtolower($content_massage) == '>gambar' or strtolower($content_massage) == '>tanpa_gambar') {
            //202103170127197
            //echo 'masuk';
            $bot = $ci->db->where(array('keyword'    => $content_massage, 'package_bot' => 'Input Barang'))->get('chat_room__bot')->row();
            $dataChat['status_bot'] = 'aktif';
            $dataChat['bot_position'] = $bot->kode_chat_room_bot;
            $dataChat['package_bot'] = $bot->package_bot;
            $dataChat['allow_massage'] = '';
            $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);


            $massage = $bot->reply_content;
            ChatApp::altenatif_send_massage($massage, $id_chat_room, $bot, $uniq);

            //$data['content_massage'] = "";

            //$data['content_massage'] = "";
            //$prev = $bot->kode_chat_room_bot;

            //$prev = $bot->kode_chat_room_bot;

        }
        echo $prev;
        $next_bot = $ci->db->where(array('prev_id' => $prev))->get('chat_room__bot')->row();
        if ($next_bot->type_bot == 'direct_massage') {
            $next_bot = $next_bot;
            if ($next_bot->reply_package == 'list_distributor') {
                $massage          = 'Bismillah,<br>
					Silahkan untuk memilih Distributor Barang<br>';
                $data_distributor = $ci->db->get('store_distributor')->result();
                $allow_massage    = '';
                foreach ($data_distributor as $distributor) {

                    $massage .= $distributor->id_store_distributor . '. ' . $distributor->nama_distributor . '<br>';
                    $allow_massage .= $distributor->id_store_distributor . '###';
                }
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);


                unset($dataChat);
                $dataChat['bot_position'] = $next_bot->kode_chat_room_bot;
                $dataChat['allow_massage'] = $allow_massage;
                $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
            }
        } else
			if ($next_bot->type_bot == 'save_moment') {
            $next_bot = $next_bot;
            if ($next_bot->reply_package == 'save_distributor') {
                $save['bot_unique_id'] = $uniq;
                $save['kode_chat_room_bot'] = $id_chat_room;
                $save['package_bot'] = $next_bot->package_bot;
                $save['reply_package'] = $next_bot->reply_package;
                $save['content'] = $content_massage;
                $save['status_generate'] = 'belum';
                $ci->db_->input_database('chat_room__bot_save', $save);
                $distibutor = $ci->db->where('id_store_distributor', $content_massage)->get('store_distributor')->row();
                $massage = 'Distributor yang ada pilih adalah ' . $distibutor->nama_distributor;
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                $massage = 'Selanjutnya silahkan inputkan caption yang diawali dengan kode ">caption" ';
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                $dataChat['bot_position'] = $next_bot->kode_chat_room_bot;
                $dataChat['allow_massage'] = '>caption';
                $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
            } else if ($next_bot->reply_package == 'save_caption') {
                $save['bot_unique_id'] = $uniq;
                $save['kode_chat_room_bot'] = $id_chat_room;
                $save['package_bot'] = $next_bot->package_bot;
                $save['reply_package'] = $next_bot->reply_package;
                $save['content'] = $content_massage;
                $save['status_generate'] = 'belum';
                $ci->db_->input_database('chat_room__bot_save', $save);
                $barang_generate = $this->generate_store_barang($id_chat_massage);

                $massage = 'Barang dengan nama barang ' . $barang_generate['judul'] . ' Telah Tersimpan' . $barang_generate['id_barang'];
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                $caption  = $this->reseller->caption($barang_generate['id_barang'], 'rekomendasi');

                $massage = $caption['caption'];
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                $massage = $caption['pengiriman'] . $caption['harga'] . $caption['link'];
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                //print_r($caption); 


                $massage = 'Selanjutnya silahkan inputkan gambar yang diawali dengan kode  ">gambar" jika tidak ada gambar silahkan menggunakan kode ">tanpa gambar"';
                ChatApp::altenatif_send_massage($massage, $id_chat_room, $next_bot, $uniq);
                $dataChat['bot_position'] = $next_bot->kode_chat_room_bot;
                $dataChat['allow_massage'] = '>gambar';
                $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
            } else if ($next_bot->reply_package == 'save_gambar') {
                //echo 'AAAAAAAAAAAAAAAAAAA<br><br><br><br>';
                $save['bot_unique_id'] = $uniq;
                $save['kode_chat_room_bot'] = $id_chat_room;
                $save['package_bot'] = $next_bot->package_bot;
                $save['reply_package'] = $next_bot->reply_package;
                $save['content'] = $content_massage;
                $save['status_generate'] = 'belum';
                $ci->db_->input_database('chat_room__bot_save', $save);

                //$massage = 'Selanjutnya silahkan inputkan gambar yang diawali dengan kode  ">gambar" jika tidak ada gambar silahkan menggunakan kode ">tanpa gambar"';
                //	ChatApp::altenatif_send_massage($massage,$id_chat_room,$next_bot,$uniq);
                $dataChat['bot_position'] = '4';
                $dataChat['allow_massage'] = '>caption';
                $ci->db->where('id_chat_room', $id_chat_room)->update('chat_room', $dataChat);
                $this->generate_store_barang_file($id_chat_massage);
            }
        }
    }
}
