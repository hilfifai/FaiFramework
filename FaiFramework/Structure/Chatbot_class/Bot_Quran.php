<?php

class Bot_Quran
{
    public static function help($page, $data_post, $content_massage, $id_chat_massage, $id_chat_room,$is_wa,$data_wa, $ex)
    {
        $mode=$data_post['mode'];
        $result_ayat = "*[Panduan Be3 Bot Quran]*";
        $result_ayat .= "\n\nFitur Quran
        
        ";
        $result_ayat .= "=>Quran Surat 
            
        ";
        $result_ayat .= "bisa dengan beberapa cara
            
        ";
        $result_ayat .= "Qs 1
        ";
        $result_ayat .= "_Menampilkan ayat ayat dalam surat  (Al Fatihah)_
            
";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+1
            
";
        $result_ayat .= "Qs 113-114
";
        $result_ayat .= "_Menampilkan ayat ayat dalam surat (Al Falaq dan An Nas)_
";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+113-114
            
";
        $result_ayat .= "=>Ayat Quran
            
";
        $result_ayat .= "_Bisa dengan beberapa cara
            
        ";
        $result_ayat .= "Qs 1 1
        ";
        $result_ayat .= "_Menampilakn salah satu ayat (Al-Fatihah ayat 1)_
        ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+1+1
            
        ";
        $result_ayat .= "Qs 3 190-191
        ";
        $result_ayat .= "_Menampilkan beberapa Ayat (Ali imran Ayat 190-191)_
        ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+3+190-191
            
        ";
        $result_ayat .= "=>Juz
            
        ";
        $result_ayat .= "Bisa dengan beberapa cara:
            
        ";
        $result_ayat .= "Qs juz 1
        ";
        $result_ayat .= "_Menampilakan ayat ayat dalam juz(1)_
            ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+juz+1
            
            ";
        $result_ayat .= "Qs juz 3 2
            ";
        $result_ayat .= "_Menampilkan ayat ayat dalam juz (3) dengan halaman ke (2)_
            ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+juz+3+2
            
            ";
        $result_ayat .= "=> Halaman
            
            ";
        $result_ayat .= "Bisa dengan beberapa cara:
            
            ";
        $result_ayat .= "Qs hal 1
            ";
        $result_ayat .= "_Menampilkan ayat ayat dalam halaman_
            ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+hal+1
            
            ";
        $result_ayat .= "Qs hal 3-4
            ";
        $result_ayat .= "_Menampilkan ayat ayat dalam halaman (3-4)_
            ";
        $result_ayat .= "Wa.me/6283116011939?text=Qs+hal+3-4
            
            ";
        $result_ayat .= "Barakallahu fikum
            "; 
        ChatApp::altenatif_send_massage($page, $id_chat_room, $result_ayat, -2, $mode,$is_wa,$data_wa,  array(), "", false);
    }
    public static function halaman($page, $data_post, $content_massage, $id_chat_massage, $id_chat_room,$is_wa,$data_wa, $ex)
    {
        $mode=$data_post['mode'];
        if ($ex[0] == 'hal') {
            $halaman = $ex[1];
            //$q3 = $this->db->where('page_halaman',$_GET['item_id'])->join('kitab_quran_ayat__perkata ','kitab_quran_ayat__perkata.id=id_ayat_perkata')->order_by('page_urutan')->limit(1)
            //->get('kitab_quran__versi_susunan')->row();
            //$q4 = $this->db->where('page_halaman',$_GET['item_id'])->where('type !=','number')->join('kitab_quran_ayat__perkata ','kitab_quran_ayat__perkata.id=id_ayat_perkata')
            //->order_by('page_baris','desc')->order_by('page_urutan','desc')->limit(1)->get('kitab_quran__versi_susunan')->row();
            $data = DB::queryRaw($page, "select * from kitab_quran__versi_susunan
		        left join kitab_quran_ayat__perkata on kitab_quran_ayat__perkata.id=id_ayat_perkata
		        where page_halaman=$halaman and id_quran_versi=1 and type ='ayat'
		        order by page_baris,page_urutan
		        limit 1
		        ");
            $ayat_dari = 0;
            $ayat_ke = 0;
            $surat_dari = 0;
            $surat_ke = 0;
            $i = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {

                $ayat_dari = $ayat->ayat_ke;
                $surat_dari = $ayat->surat_ke;
            }
            $data = DB::queryRaw($page, "select * from kitab_quran__versi_susunan
		        left join kitab_quran_ayat__perkata on kitab_quran_ayat__perkata.id=id_ayat_perkata
		        where page_halaman=$halaman and id_quran_versi=1
		        and type ='ayat'
		        order by page_baris desc,page_urutan desc
		        limit 1
		        ");
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {

                $ayat_ke = $ayat->ayat_ke;
                $surat_ke = $ayat->surat_ke;
            }
            $sql = "select * from kitab_quran_ayat 
					    left join kitab_quran_ayat__terjemah
					        on id_quran_ayat = kitab_quran_ayat.id and lang='ID' and type = 'terjemah_ayat'
					   
					   left join kitab_quran_surat on kitab_quran_ayat.surat_ke = kitab_quran_surat.surat_ke
					   left join kitab_quran_surat__detail on kitab_quran_surat.id = kitab_quran_surat__detail.id_quran_surat and kitab_quran_surat__detail.lang='ID'
					where kitab_quran_ayat.surat_ke>=$surat_dari and kitab_quran_ayat.surat_ke<=$surat_ke and kitab_quran_ayat.ayat_ke>=$ayat_dari and kitab_quran_ayat.ayat_ke<=$ayat_ke 
					order by kitab_quran_ayat.surat_ke,kitab_quran_ayat.ayat_ke";
            $data = DB::queryRaw($page, $sql);
            $result_ayat = "*Quran Halaman " . $ex[1] . "*\n";
            $surat = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {
                if ($surat != $ayat->surat_ke) {
                    $result_ayat .= "\n\n_Surat " . $ayat->nama_surat. "_";
                    $surat = $ayat->surat_ke;
                }
                $result_ayat .= "\n\n(" . $ayat->ayat_ke. ") " . $ayat->text_ayat. " ";
            }
        }
        ChatApp::altenatif_send_massage($page, $id_chat_room, $result_ayat, -2, $mode,$is_wa,$data_wa,  array(), "", false);
    }
    public static function juz($page, $data_post, $content_massage, $id_chat_massage, $id_chat_room,$is_wa,$data_wa, $ex)
    {
        $mode=$data_post['mode'];
        if (!isset($ex[2])) {

            $data = DB::queryRaw($page, "select * from kitab_quran_ayat 
					    left join kitab_quran_ayat__terjemah
					        on id_quran_ayat = kitab_quran_ayat.id and lang='ID' and type = 'terjemah_ayat'
					   
					   left join kitab_quran_surat on kitab_quran_ayat.surat_ke = kitab_quran_surat.surat_ke
					   left join kitab_quran_surat__detail on kitab_quran_surat.id = kitab_quran_surat__detail.id_quran_surat and kitab_quran_surat__detail.lang='ID'
					where kitab_quran_ayat.juz=" . $ex[1] . '  
					order by kitab_quran_ayat.surat_ke,kitab_quran_ayat.ayat_ke');
            $result_ayat = "*Juz " . $ex[1] . "*\n";
            $surat = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {
                if ($surat != $ayat->surat_ke) {
                    $result_ayat .= "\n\n_Surat " . $ayat->nama_surat. "_";
                    $surat = $ayat->surat_ke;
                }
                $result_ayat .= "\n\n(" . $ayat->ayat_ke. ") " . $ayat->text_ayat. " ";
            }
        } else {
            //halaman
            $data = DB::queryRaw($page, "select * from kitab_quran__versi_susunan
		        left join kitab_quran_ayat__perkata on kitab_quran_ayat__perkata.id=id_ayat_perkata
		        left join kitab_quran_ayat on kitab_quran_ayat.id=id_quran_ayat
		        where kitab_quran_ayat.juz=" . $ex[1] . " and id_quran_versi=1 and type ='ayat'
		        order by page_halaman,page_baris,page_urutan
		        limit 1
		        ");
            $minhalaman = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {
                $minhalaman = $ayat->page_halaman;
            }
            $halaman = $minhalaman + $ex[2] - 1;

            //$q3 = $this->db->where('page_halaman',$_GET['item_id'])->join('kitab_quran_ayat__perkata ','kitab_quran_ayat__perkata.id=id_ayat_perkata')->order_by('page_urutan')->limit(1)
            //->get('kitab_quran__versi_susunan')->row();
            //$q4 = $this->db->where('page_halaman',$_GET['item_id'])->where('type !=','number')->join('kitab_quran_ayat__perkata ','kitab_quran_ayat__perkata.id=id_ayat_perkata')
            //->order_by('page_baris','desc')->order_by('page_urutan','desc')->limit(1)->get('kitab_quran__versi_susunan')->row();
            $data = DB::queryRaw($page, "select * from kitab_quran__versi_susunan
		        left join kitab_quran_ayat__perkata on kitab_quran_ayat__perkata.id=id_ayat_perkata
		        where page_halaman=$halaman and id_quran_versi=1 and type ='ayat'
		        order by page_baris,page_urutan
		        limit 1
		        ");
            $ayat_dari = 0;
            $ayat_ke = 0;
            $surat_dari = 0;
            $surat_ke = 0;
            $i = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {

                $ayat_dari = $ayat->ayat_ke;
                $surat_dari = $ayat->surat_ke;
            }
            $data = DB::queryRaw($page, "select * from kitab_quran__versi_susunan
		        left join kitab_quran_ayat__perkata on kitab_quran_ayat__perkata.id=id_ayat_perkata
		        where page_halaman=$halaman and id_quran_versi=1
		        and type ='ayat'
		        order by page_baris desc,page_urutan desc
		        limit 1
		        ");
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {

                $ayat_ke = $ayat->ayat_ke;
                $surat_ke = $ayat->surat_ke;
            }
            $sql = "select * from kitab_quran_ayat 
					    left join kitab_quran_ayat__terjemah
					        on id_quran_ayat = kitab_quran_ayat.id and lang='ID' and type = 'terjemah_ayat'
					   
					   left join kitab_quran_surat on kitab_quran_ayat.surat_ke = kitab_quran_surat.surat_ke
					   left join kitab_quran_surat__detail on kitab_quran_surat.id = kitab_quran_surat__detail.id_quran_surat and kitab_quran_surat__detail.lang='ID'
					where kitab_quran_ayat.surat_ke>=$surat_dari and kitab_quran_ayat.surat_ke<=$surat_ke and kitab_quran_ayat.ayat_ke>=$ayat_dari and kitab_quran_ayat.ayat_ke<=$ayat_ke 
					order by kitab_quran_ayat.surat_ke,kitab_quran_ayat.ayat_ke";
            $data = DB::queryRaw($page, $sql);
            $result_ayat = "*Quran Juz " . $ex[1] . " Halaman " . $halaman . "*\n";
            $surat = 0;
            $data = DB::get('all');
            foreach ($data['row'] as $ayat) {
                if ($surat != $ayat->surat_ke) {
                    $result_ayat .= "\n\n_Surat " . $ayat->nama_surat. "_";
                    $surat = $ayat->surat_ke;
                }
                $result_ayat .= "\n\n(" . $ayat->ayat_ke. ") " . $ayat->text_ayat. " ";
            }
        }
       
            ChatApp::altenatif_send_massage($page, $id_chat_room, $result_ayat, -2, $mode,$is_wa,$data_wa,  array(), "", false);
    }
}
