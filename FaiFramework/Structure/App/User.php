<?php

class User
{
    public static function profil()
    {
        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "hibe3";
        $website['content'][$i]['template_function'] = "profil";
        


        $page['view_layout'][] = array("website", "col-md-12", $website);
        return $page;
    }
    public static function dashboard()
    {

        $page['title'] = "Profile";
        $page['subtitle'] = "";
        $page['meta']['title'] = "Profile";


        // $card['listing_type'] = "profile-menu"; //info/listing/listmenu
        // $card['default_id'] = "Tentang Saya";
        // $card['view_default'] = "ViewVertical";
        // $page['limit_page'] = 2;
        // $card['profil']['database']['utama'] = 'apps_user';
		// $card['profil']['database']['where'][] = array('id_apps_user', "=", "{SESSION_UTAMA}");
		// $card['profil']['array'] = array("title" => array("", "nama_lengkap", ""), "subtitle" => array("Be3 ID:", "apps_id", ""));
		
        // $card['menu'] = array(
        //     "Post" => array("icon", 'card-nav', 'array-layout-post'),
        //     "Tentang Saya" => array("icon", 'card-nav', 'array-layout-tentang_saya'),
        //     "Organisasi" => array("icon", 'card-nav', 'array-layout-dashboard'),
        //     "Program" => array("icon", 'card-nav', 'array-layout-dashboard'),
        //     "Projek" => array("icon", 'card-nav', 'array-layout-dashboard'),

        // );
        // $card['array-layout-tentang_saya'] = array(


        //     "type" => "nav",
        //     "defaultNav" => "Utama",
        //     "cardNav" => array(

        //         "Utama" => array(
        //             "mode"=>"crud",
        //             "array"=>array(
                       
        //                 array("Nama Lengkap", "nama_lengkap", "text-req-en"),
        //                 array("Display Status", "display_status", "contenteditable"),
        //                 array("Be3 ID", "be3_id", "text"),
            
        //             )

        //         ),
        //         "Media Sosial" => array(),
        //         "Keluarga" => array(),
        //         "Pendidikan" => array(),
        //         "Kursus" => array(),
        //         "Penyakit" => array(),
        //         "Organisasi" => array(),
        //         "Kepanitiaan" => array(),
        //         "Skill" => array(),
        //         "Pakaian" => array(),
        //         "Bank" => array(),

        //     ),




        // );
        // $page['config']['database']['Tentang Saya']['utama'] = "apps_user";
        // $page['config']['database']['Tentang Saya']['primary_key'] =null;
        // $page['config']['database']['Tentang Saya']['where'][] = array("id_apps_user","=","{SESSION_UTAMA}");
        
        // $page['view_layout'][] = array("card", "col-md-12", $card);
        $i=0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template_content";
        $website['content'][$i]['template_class'] = "codepen";
        $website['content'][$i]['template_function'] = "portfolio_webpage_example";



        $page['view_layout'][] = array("website", "col-md-12", $website);
        // return $page;
        return $page;
    }
    public static function profil_user()
    {
    }
    public static function utama($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user";
        $primary_key = null;

        $array = array(
            array("File", "file", "picture-upload"),

            array("Nama Lengkap", "nama_lengkap", "text-req-en"),
            array("Display Status", "display_status", "contenteditable"),
            array("Apps ID", "be3_id", "text"),

            array("Nama Panggilan", null, "text-req-en"),
            array("Tempat Lahir", "tempat_lahir", "text-req-en"),
            array("Tanggal Lahir", "tanggal_lahir", "date-req-en"),
            array("Jenis Kelamin", "jenis_kelamin", "radio2-manual", array("Pria" => "Pria", "Wanita" => "Wanita")),
            // array("Agama", "agama", "select-req-en", array("webmaster__master__agama", null, "nama_agama")),
            // array("No KK", "no_kk", "select-req-en", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")), //pembuatan iventaris asset
            // array("No KTP", "no_ktp", "select-req-en", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")), //pembuatan iventaris asset


            array("username", "username", "text-req-en"),
            array("password", "password", "hidden"),

            array("Nomor Handphone", "nomor_handphone", "text-req-en"),
            array("Koneksi WA", "connection_wa", "checkbox-manual", array("1" => "Apakah Nomor ini terdaftar di Whatapps? ")),

            array("Alamat Email", "email", "text-req-en"),
            array("Golongan Darah", "golongan_darah", "select-manual-en", array("A" => "A", "B" => "B", "AB" => "AB", "O" => "O")),
            array("Status Perkawinan", "status_perkawinan", "select-manual-en", array("Menikah" => "Menikah", "Belum Menikah" => "Belum Menikah", "Cerai Hidup" => "Duda/Janda Cerai Hidup", "Cerai Mati" => "Duda/Janda Cerai Mati",)),
            array("Jumlah Anak", "jumlah_anak", "number-en"),

            // array("Alamat Domisili", "alamat_domisili", "text-req-en"),
            // array("Provinsi", "provinsi_id", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
            // array("Kota", "kota_id", "select-ajax"),
            // array("Kecamatan", "kecamatan_domisili", "select-ajax"),
            // array("Kelurahan", "kelurahan_domisili", "select-ajax"),



            array("", "wa_verifikasi_kode", "hidden"),
            array("", "email_verifikasi_kode", "hidden"),
            array("", "daftar_step", "hidden"),
            array("", "kode_apps_user", "hidden"),
            array("", "status", "hidden"),
            array("", "email_verifikasi", "hidden"),
            array("", "wa_verifikasi", "hidden"),
        );
        // $page_support = Pages::Apps("User","riwayat_pendidikan");
        // $sub_kategori[] = [$page_support['title'], $page_support['database']['utama'], $page_support['database']['primary_key'], "table"];
        // $array_sub_kategori[] = $page_support['crud']['array'];
        // $page_support_all[] = $page_support;

        // $page_support = Pages::Apps("User","riwayat_pekerjaan");
        // $sub_kategori[] = [$page_support['title'], $page_support['database']['utama'], $page_support['database']['primary_key'], "table"];
        // $array_sub_kategori[] = $page_support['crud']['array'];
        // $page_support_all[] = $page_support;

        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // for($i=0;$i<count($page_support_all);$i++){
        //     foreach($page_support_all[$i]['crud'] as $key => $value){
        //         if(!in_array($key,array("array",'search','sub_kategori','array_sub_kategori'))){
        //             foreach($page_support_all[$i]['crud'][$key] as $key2 => $value2){
        //                 $page['crud'][$key][$key2] = $page_support_all[$i]['crud'][$key][$key2];
        //             }
        //         }
        //     }
        // }


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }

    public static function riwayat_pendidikan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "organisasi__relasi__anggota";
        $primary_key = null;

        $array = array(
            array("Nama Sekolah", "id_organisasi", "select-req-en", array("organisasi", null, "nama_organisasi")),
            // array("Fakultas", "fakultas", "select-req-en"),
            // array("Jurusan", "jurusan", "select-req-en"),
            array("IPK/Nilai Akhir", "nilai_akhir", "number-req-en"),
            array("Angkatan Awal", "angkatan", "number-req-en"),
            array("Tgl Awal Bergabung", "masa_awal", "number-req-en"),
            array("Tgl Akhir Bergabung", "masa_akhir", "number-req-en"),
            // array("Status", "status", "select-manual-req-en"),
        );
        $search = array();

        // $page['crud']['insert_default_value']['kode_menu'] = 'RANDOM::25|' ;


        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $field = 'sekolah';
        $page['crud']['select_other'][$field]["get"] = "from_controller";
        $page['crud']['select_other'][$field]["controller"] = "Organisasi";
        $page['crud']['select_other'][$field]["function"] = "organisasi_form";
        $page['crud']['select_other'][$field]["field"] = "nama_organisasi";

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['np'] = true;
        
        $page['database']['join'] = array();
        $page['database']['join'][] = ["organisasi","organisasi.id","$database_utama.id_organisasi"];
        $page['database']['join'][] = ["webmaster__organsiasi__kategori","webmaster__organsiasi__kategori.id","organisasi.id_kategori_organisasi"];
        // $page['database']['where'] = array();
        $page['database']['where'][] = ["webmaster__organsiasi__kategori.nama_kategori","=","'pendidikan'"];
        return $page;
    }
    public static function riwayat_kursus()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Kursus/Pelatihan/Sertifikasi(Program)", "nama_kursus_pelatihan_sertifikasi", "select-req-en"),
            array("Penyelenggara Kursus_Pelatihan_Sertifikasi", "penyelenggara", "text-req-en"),
            array("Tanggal Awal Pelatihan", "tanggal_awal", "text-req-en"),
            array("Tanggal Akhir Pelatihan", "tanggal_akhir", "text-req-en"),
            array("Sertifikat", "sertifikat", "select-manual-req-en"),
            array("Jenis", "jenis", "select-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }

    public static function riwayat_pekerjaan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "organisasi__relasi__anggota";
        $primary_key = null;

        $array = array(
            array("Perusahaan", "id_organisasasi", "select-req-en", array("organisasi", null, "nama_organisasi")),
            array("Jabatan", "jabatan", "select-req-en",[]),
            array("Deskripsi Kerja", "deskripsi_kerja", "text-req-en"),
            array("Masa Awal kerja (Perkiraan)", "masa_awal", "date-req-en"),
            array("Masa Akhir kerja (Perkiraan)", "masa_akhir", "date-req-en"),
            array("Ruang Lingkup Pekerjaan", "ruang_lingkup_pekerjaan", "text-req-en"),

            array("Gaji Terakhir yang diterima", "gaji_yang_diterima", "number-req-en"),
            array("Alasan Berhenti", "alasan_berhenti", "text-req-en"),
            array("Slip Gaji Terakhir", "slip_gaji_terakhir", "file-req-en"),
            array("Surat Faklaring", "surat_faklaring", "file-req-en"),

            array("Nomor Referensi", "nomor_referensi", "number-req-en"),
            array("Nama Referensi", "nama_referensi", "text-req-en"),
            array("Hubungan Referensi", "hubungan_referensi", "select-en", array("webmaster__hubungan", null, "nama_hubungan")),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['crud']['select_other']['perusahaan']["get"] = "from_controller";
        $page['crud']['select_other']['perusahaan']["controller"] = "Organisasi";
        $page['crud']['select_other']['perusahaan']["function"] = "organisasi_form";
        $page['crud']['select_other']['perusahaan']["field"] = "nama_organisasi";

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function riwayat_organisasi() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "organisasi__relasi__anggota";
        $primary_key = null;

        $array = array(
            array("Jenis Penyakit/Kecelakaan", "jenis_penyakit/kecelakaan", "select-req-en"),
            array("Tahun mengalami:", "apps_id", "text-req-en"),
            array("Sembuh", "sembuh", "text-req-en"),
            array("Dampak yang diraskan saat ini:", "dampak_yang_diraskan_saat_ini:", "text-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }

    public static function riwayat_penyakit()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Jenis Penyakit/Kecelakaan", "jenis_penyakit/kecelakaan", "select-req-en"),
            array("Tahun mengalami:", "apps_id", "text-req-en"),
            array("Sembuh", "sembuh", "text-req-en"),
            array("Dampak yang diraskan saat ini:", "dampak_yang_diraskan_saat_ini:", "text-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
   
    public static function riwayat_kepanitiaan() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Jenis Penyakit/Kecelakaan", "jenis_penyakit/kecelakaan", "select-req-en"),
            array("Tahun mengalami:", "apps_id", "text-req-en"),
            array("Sembuh", "sembuh", "text-req-en"),
            array("Dampak yang diraskan saat ini:", "dampak_yang_diraskan_saat_ini:", "text-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }

    public static function kartu_identitas()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("No KTP", "no_ktp", "select-req-en"),
            array("No NPWP", "apps_id", "text-req-en"),
            array("No SIM A", "no_sim_a", "text-req-en"),
            array("No SIM C", "no_sim_c", "text-req-en"),
            array("No BPJS Ketenagakerjaan", "no_bpjs_ketenagakerjaan", "text-req-en"),
            array("No BPJS Kesehatan", "no_bpjs_kesehatan", "text-req-en"),
            array("No Pasport", "no_pasport", "text-req-en", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function keluarga() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Hubungan", "no_ktp", "select-req-en"),
            array("Nama", "apps_id", "text-req-en"),
            array("No Hp", "no_sim_a", "text-req-en"),
            array("Tanggal Lahir", "no_sim_c", "date-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function pakaian()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Hubungan", "nama_hubungan", "select-req-en"),
            array("Hubungan", "hubungan", "text-req-en"),
            array("Gamis", "gamis", "text-req-en"),
            array("Kameja", "kameja", "text-req-en"),
            array("Kaos", "kaos", "text-req-en"),
            array("Jaket", "jaket", "text-req-en"),
            array("Celana", "celana", "text-req-en", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")),
            array("Sepatu", "sepatu", "text-req-en"),
            array("Kacamata", "kacamata", "text-req-en"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function skill() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "apps_user__detail__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("No KTP", "no_ktp", "select-req-en"),
            array("No NPWP", "apps_id", "text-req-en"),
            array("No SIM A", "no_sim_a", "text-req-en"),
            array("No SIM C", "no_sim_c", "text-req-en"),
            array("No BPJS Ketenagakerjaan", "no_bpjs_ketenagakerjaan", "text-req-en"),
            array("No BPJS Kesehatan", "no_bpjs_kesehatan", "text-req-en"),
            array("No Pasport", "no_pasport", "text-req-en", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function bank() //belum
    {
    }
}
