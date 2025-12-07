<?php
class HCMS_CLASS
{
    use HCMS_ABSENSI;
    use HCMS_ADUAN_KARYAWAN;
    use HCMS_CUTI;
    use HCMS_FASILITAS_PERUSAHAAN;
    use HCMS_KPI;
    use HCMS_KARYAWAN;
}
class  HCMS extends HCMS_CLASS
{
    public static function list_workspace($page)
    {
        $_SESSION['to_list_workspace_id_apps'] = Partial::get_id_apps($page);
        $page = Workspace::workspace_apps($page);
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function Dashboard_workspace()
    {

        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        // 		array("CARD-NUMBER-TEXT"=>array(
        // 							"dataType"=>"database",
        // 							"database_refer"=>"Dashboard-Query",
        // 							"database_row" => "jumlah_organisasi"
        // 							)),
        // 	),

        // )),
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Jumlah Organisasi",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "123",
            ),
        );
        $i++;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Jumlah Anggota",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "122",
            ),
        );
        $page['view_layout'][] = array("website", "col-md-12", $website);

        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function menu_basic()
    {
        //nama/link/icon
        $menu = array(
            array(
                "group",
                "Perusahaan",
                array(
                    // array("menu", "Company Profil", array("HCMS", "company_profile", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                    array(
                        "dropdown",
                        "Struktur",
                        array(
                            array("menu", "Periode", array("HCMS", "periode", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Semester", array("HCMS", "semester", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Level", array("HCMS", "level", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Divisi", array("HCMS", "divisi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Pangkat", array("HCMS", "pangkat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Jabatan", array("HCMS", "jabatan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            //array("menu", "Anggota", array("HCMS", "Anggota", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                ),
            ),


            array(
                "group",
                "Management Karyawan",
                array(

                    array(
                        "dropdown",
                        "Data Karyawan",
                        array(
                            array("menu", "Anggota", array("HCMS", "anggota", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Status Pajak Anggota", array("HCMS", "status_pajak_anggota", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Pengecekan Kartu Identitas", array("HCMS", "pengecekan_kartu_identitas", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Kontrak Kerja",
                        array(
                            array("menu", "Penambahan Kontrak Kerja", array("HCMS", "penambahan_kontrak_kerja", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Historis Kontrak Kerja", array("HCMS", "historis_kontrak_kerja", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Perpindahan Jabatan",
                        array(
                            array("menu", "Mutasi Demosi Promosi", array("HCMS", "mutasi_demosi_promosi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Historis Kerja Karyawan", array("HCMS", "historis_kerja_karyawan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Rekrutmen Karyawan",
                        array(
                            array("menu", "Pengajuan Karyawan", array("HCMS", "pengajuan_karyawan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approval Keuangan", array("HCMS", "approval_keuangan_rekrutmen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Proses Kandidat", array("HCMS", "proses_kandidat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Resign",
                        array(
                            array("menu", "Pengajuan Resign", array("HCMS", "pengajuan_resign", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Turn Back Karyawan", array("HCMS", "turn_back", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Aduan Karyawan",
                        array(
                            array("menu", "Surat Teguran & Peringatan", array("HCMS", "sp_st", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Gratifikasi", array("HCMS", "gratifikasi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Kotak Laporan", array("HCMS", "kotak_laporan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Employe Care", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                ),
            ),
            array(
                "group",
                "Management Absensi",
                array(
                    array(
                        "dropdown",
                        "Master Absensi",
                        array(
                            array("menu", "Periode Absen", array("HCMS", "periode_absen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Periode Lembur", array("HCMS", "periode_lembur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Mesin Absen", array("HCMS", "mesin_absen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Jam Kerja Karyawan",
                        array(
                            array("menu", "Hari Libur Nasional", array("HCMS", "hari_libur_nasional", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Master Jam Kerja Reguler", array("HCMS", "master_jam_kerja_reguler", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Jam Kerja Reguler", array("HCMS", "jam_kerja_reguler", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Master Pilihan Jam Kerja Shift", array("HCMS", "master_jam_shift", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Jam Kerja Shift", array("HCMS", "jam_kerja_shift", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Hari Libur Karyawan Shift", array("HCMS", "hari_libur_shift", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Cuti Karyawan",
                        array(
                            array("menu", "Konfigurasi Cuti", array("HCMS", "konfigurasi_cuti", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Parameter Reset Cuti Tahunan", array("HCMS", "parameter_reset_cuti_tahunan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Laporan Cuti Karyawan", array("HCMS", "laporan_cuti_karyawan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Rekap Cuti Karyawan", array("HCMS", "rekap_cuti_karyawan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown",
                        "Pengajuan Karyawan",
                        array(
                            array(
                                "dropdown",
                                "Master",
                                array(
                                    array("menu", "Batas Pengajuan", array("HCMS", "batas_pengajuan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Batas Approval Pengajuan", array("HCMS", "batas_approval", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Alasan", array("HCMS", "alasan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Jenis Izin", array("HCMS", "jenis_izin", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Transaksi",
                                array(
                                    array("menu", "Ajuan Pergantian Hari Libur", array("HCMS", "pergantian_hari_libur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Ajuan Direksi", array("HCMS", "ajuan_direksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Cek Pengajuan", array("HCMS", "cek_ajuan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Persetujuan",
                                array(
                                    array("menu", "Approval HC", array("HCMS", "approval_hc", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Absen Backdate", array("HCMS", "absen_backdate", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Perdin",
                                array(
                                    array("menu", "Ajuan Perdin", array("HCMS", "perdin", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Perdin - Admin", array("HCMS", "perdin", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Perdin - Keuangan", array("HCMS", "perdin", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Rekapitulasi",
                                array(
                                    array("menu", "Tarik Absen", array("HCMS", "tarik_absen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Rekap Real",
                                array(
                                    array("menu", "Cek Absensi Karyawan Real", array("HCMS", "cek_absensi_real", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Cek Pengajuan Real", array("HCMS", "cek_pengajuan_real", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Rekap Absen Real", array("HCMS", "rekap_absen_real", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown",
                                "Rekap Generate",
                                array(
                                    array("menu", "Cek Absensi Karyawan Generate", array("HCMS", "cek_absensi_generate", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Cek Pengajuan Generate", array("HCMS", "cek_pengajuan_generate", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Rekap Absen Generate", array("HCMS", "rekap_absen_generate", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                "group",
                "Kinerja Kerja",
                array(
                    array(
                        "dropdown",
                        "Penilaian Kinerja",
                        array(
                            array("menu", "Penilaian Kerja", array("HCMS", "penilaian_kerja", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                ),
            ),
            array(
                "dropdown",
                "KPI",
                array(
                    array(
                        "dropdown",
                        "Master",
                        array(
                            array("menu", "Jenis Penilaian", array("HCMS", "jenis_penilaian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Parameter Penilaian", array("HCMS", "parameter_penilaian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Point Utama Penilaian", array("HCMS", "point_utama_penilaian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                        ),
                    ),
                ),
                array(
                    "dropdown",
                    "Transaksi",
                    array(
                        array("menu", "Performa Kontrak", array("HCMS", "performa_kontrak", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        array("menu", "Performa Review", array("HCMS", "performa_review", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        array("menu", "Performa Evaluation", array("HCMS", "performa_evaluation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    ),
                ),
            ),
            array(
                "group",
                "Payrol",
                array(
                    array(
                        "dropdown",
                        "Payrol Gaji",
                        array(
                            array(
                                "dropdown",
                                "Master ",
                                array(
                                    array("menu", "Master Tunjangan", array("HCMS", "master_tunjangan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Master Potongan", array("HCMS", "master_potongan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Master Absensi", array("HCMS", "master_absensi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                )
                            ),
                            array(
                                "dropdown",
                                "Master Gaji",
                                array(
                                    array("menu", "Master Gaji Pokok Bulanan", array("HCMS", "master_gapok_bulanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Master Gaji Pokok Pekanan", array("HCMS", "master_gapok_pekanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Master Gaji Berjenjang", array("HCMS", "master_gaji_berjenjang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Master Gaji Per Tanggal", array("HCMS", "master_potongan_per_tanggal", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                )
                            ),
                            array(
                                "dropdown",
                                "Transaksi",
                                array(
                                    array("menu", "Koreksi", array("HCMS", "koreksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Generate Gaji", array("HCMS", "Payrol", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Data", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Voucher", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Kuangan", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                )
                            ),
                            array(
                                "dropdown",
                                "Report",
                                array(
                                    array("menu", "Slip Gaji", array("HCMS", "slip_gaji", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Rekap Gaji", array("HCMS", "rekap_gaji", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                )
                            ),
                        )
                    ),
                    array(
                        "dropdown",
                        "Payrol THR",
                        array(
                            array("menu", "Generate THR", array("HCMS", "payrol_thr", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            // array("menu", "Approval Data", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            // array("menu", "Approval Voucher", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            // array("menu", "Approval Kuangan", array("HCMS", "keluh_kesah", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        )
                    ),
                ),
            ),
        );

        return $menu;
    }
    public static function list_board($page)
    {
        $page = Board::board_apps($page);
        return $page;
    }
    public static function hcms_strutural($page)
    {
        $page['title'] = "HCMS Struktural";
        $page['subtitle'] = "</div><br>Mendefinisiakan struktur organisasi dan keanggotaan organisasi";

        $fai = new MainFaiFramework();
        $card['listing_type'] = "listingmenu"; //info/listing/listmenu
        $card['listing_type'] = "listingmenu"; //info/listing/listmenu
        $card['default_id'] = "Periode";
        $card['view_default'] = "ViewVertical";
        $page['limit_page'] = 2;
        $card['menu'] = array(
            "Dashboard" => array("icon", 'card-nav', 'array-layout-dashboard'),
            "Periode" => array("icon", 'crud-table', 'array-periode'),
            "Semester" => array("icon", 'crud-table', 'array-semester'),
            "Level Struktural" => array("icon", 'crud-table', 'array-level'),
            "Divisi" => array("icon", 'crud-table', 'array-divisi'),
            "Pangkat" => array("icon", 'crud-table', 'array-pangkat'),
            "Jabatan" => array("icon", 'crud-table', 'array-jabatan'),
            "Anggota" => array("icon", 'crud-table', 'array-anggota'),
        );
        $card['array-periode'] =  array(
            "mode" => "crud",
            "database_refer" => "Periode",
            "crud" => HCMS::periode()['crud'],
            "array" => HCMS::periode()['crud']['array']

        );
        $card['array-semester'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::semester()['crud'],
            "array" => HCMS::semester()['crud']['array'],

        );
        $card['array-pangkat'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::pangkat()['crud'],
            "array" => HCMS::pangkat()['crud']['array'],

        );

        $card['array-level'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::level()['crud'],
            "array" => HCMS::level()['crud']['array'],

        );
        $card['array-divisi'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::divisi()['crud'],
            "array" => HCMS::divisi()['crud']['array'],

        );
        $card['array-jabatan'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::jabatan()['crud'],
            "array" => HCMS::jabatan()['crud']['array'],

        );
        $card['array-anggota'] =  array(
            "mode" => "crud",
            "database_refer" => "Daftarkan Organisasi",
            "crud" => HCMS::anggota()['crud'],
            "array" => HCMS::anggota()['crud']['array'],

        );

        $card['array-layout-dashboard'] = array(
            "array" => array(
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "ProfileTingkatScore.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "HarianList.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),

            ),


        );




        $page['view_layout'][] = array("card", "col-md-12", $card);
        // print_r(HCMS::periode()['database']);
        $page['config']['database']['Periode'] = HCMS::periode()['database'];
        $page['config']['database']['Semester'] = HCMS::semester()['database'];
        $page['config']['database']['Level Struktural'] = HCMS::level()['database'];
        $page['config']['database']['Divisi'] = HCMS::divisi()['database'];
        $page['config']['database']['Jabatan'] = HCMS::jabatan()['database'];
        $page['config']['database']['Pangkat'] = HCMS::pangkat()['database'];
        $page['config']['database']['Anggota'] = HCMS::anggota()['database'];

        // $page['get']['sidebarIn'] = true;;
        return $page;
    }


    public static function frontend()
    {
        $page['title'] = "Be3 Ihsan Produktif";
        $page['subtitle'] = "Be3 Ihsan Produktif adalah aplikasi yang dirancang khusus untuk membantu manajement perencanaan produktifitas kerja";



        $card['listing_type'] = "listingmenu"; //info/listing/listmenu
        $card['listing_type'] = "listingmenu"; //info/listing/listmenu
        $card['default_id'] = "Mutabaah Yaumiyah";
        $card['view_default'] = "ViewVertical";
        $page['limit_page'] = 2;
        $card['menu'] = array(
            "Dashboard" => array("icon", 'card-nav', 'array-layout-dashboard'),
            "Informasi & Aduan" => array("icon", 'card-nav', 'array-layout-informasi_aduan'),
            "Absensi" => array("icon", 'card-nav', 'array-layout-absensi'),
            "Fasilitas" => array("icon", 'card-nav', 'array-layout-fasilitas'),
            "Perusahaan" => array("icon", 'card-nav', 'array-layout-perusahaan'),
            "Kinerja" => array("icon", 'card-nav', 'array-layout-kinerja'),
            "Payrol" => array("icon", 'card-nav', 'array-layout-payrol'),
            "Karyawan" => array("icon", 'card-nav', 'array-layout-karyawan'),
        );
        //card-listing


        //layout//ViewHorizontal//ViewVertical//ViewListTables
        //layout -> 


        $card['array-layout-dashboard'] = array(
            "array" => array(
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "ProfileTingkatScore.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "HarianList.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),

            ),


        );
        $card['array-layout-absensi'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Dashboard" => array(),
                "Aktivitas Atasan" => array(),
                "Approval Pengajuan" => array(),
                "Approval Lintas Mesin" => array(),
                "Approval Pergantian Hari Libur" => array(),
                "Aktivitas Karyawan" => array(),
                "Jadwal Kerja & Shift" => array(),
                "Cek Presensi Kehadiran" => array(),
                "Pengajuan Lembur" => array(),
                "Pengajuan Perjalanan Dinas" => array(),
                "Pengajuan Izin & Cuti" => array(),
                "Pengajuan Pergantian Hari Libur" => array(),
            ),




        );
        $card['array-layout-informasi_aduan'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Informasi" => array(),
                "Berita" => array(),
                "Kegiatan Perusahaan" => array(),
                "Kebijakan Perusahaan" => array(),

                "Aduan" => array(),
                "Kotak Laporan" => array(),
                "Pelaporan Pelanggaran" => array(),
                "Keluh Kesah" => array(),
                "Laporan Gratifikasi" => array(),
                "Klatifikasi Gaji" => array(),
                "Klatifikasi Absen" => array(),
                "Transaksi" => array(),
                "Saran & Kritik" => array(),
                "Pengajuan Kegiatan" => array(),

            ),




        );
        $card['array-layout-fasilitas'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Fasilitas Kesehatan" => array(),
                "Pengajuan BPJS Keluarga" => array(),

            ),




        );

        $card['array-layout-perusahaan'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Struktural" => array(),
                "Struktur Organisasi" => array(),
                "Jobdesk" => array(),
                "Team" => array(),
                "Lainya" => array(),
                "Club" => array(),

            ),




        );
        $card['array-layout-kinerja'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Aktivitas Pemimpin" => array(),
                "Persetujuan KPI" => array(),
                "Persetujuan Capaian " => array(),

                "Aktivitas Karyawn" => array(),
                "KPI" => array(),

            ),




        );
        $card['array-layout-payrol'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Slip Gaji" => array(),
                "Slip THR " => array(),


            ),




        );
        $card['array-layout-karyawan'] = array(


            "type" => "nav",
            "defaultNav" => "Dashboard",
            "cardNav" => array(
                "Aktivitas Pemimpin" => array(),
                "Persetujuan Pengajuan Resign" => array(),
                "Persetujuan Pengajuan Karyawan Baru " => array(),
                "Persetujuan Mutasi Demosi Promosi" => array(),

                "Aktivitas Karyawn" => array(),
                "Pengajuan Karyawan Baru" => array(),
                "Pengajuan Resign" => array(),
                "Pengajuan Mutasi Demosi Promosi" => array(),



            ),




        );



        $page['view_layout'][] = array("card", "col-md-12", $card);

        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function periode()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("Nama Periode", null, "text"),
            array("Periode ke", null, "number"),
            array("Tanggal Awal periode", null, "date"),
            array("Tanggal Akhir periode", null, "date"),
            array("Status Periode", "status_periode", "select-manual", array("pengajuan" => "Pengajuan", "aktif" => "Aktif")),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.id as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";
            $page['database']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;

        return $page;
    }
    public static function semester()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("periode", null, "select", array("hcms__struktur__periode", null, "nama_periode")),
            array("Nama Semester", null, "text"),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";

            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_periode']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
            $page['database']['where'][] = array("hcms__struktur__semester.id_organisasi", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    //struktur
    public static function level()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("Nama Level", null, "text"),
            array("Level Ke", null, "text"),

        );
        $search = array();
        //(Directorat/Divisi/Departemen/Tim)
        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {

            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";

            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
            // $page['crud']['select_database_costum']['id_periode']['where'][] = array("id_organisasi",'=',$_SESSION['id_organisasi']);  
            $page['database']['where'][] = array("$database_utama.id_organisasi", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function divisi()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("Parent", null, "select", array($database_utama, null, "nama_divisi", "pd")),
            array("Level", null, "select", array("hcms__struktur__level", null, "nama_level")),
            array("Nama Divisi", null, "text"),
            array("Level Prefix", null, "select-manual", array(1 => "Ya ({Nama Level} {Nama Divisi})", 2 => "Tidak({Nama Divisi})")),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";
            $page['database']['where'][] = array("$database_utama.id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_level']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_parent']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function pangkat()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("Nama Pangkat", null, "text"),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();

        $page['get']['sidebarIn'] = true;;
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";
            $page['database']['where'][] = array("$database_utama.id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
        }
        return $page;
    }

    public static function jabatan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("Divisi", null, "select", array("hcms__struktur__divisi", null, "nama_divisi")),
            array("Semester", null, "select", array("hcms__struktur__semester", null, "nama_semester")),
            array("Pangkat", null, "select", array("hcms__struktur__pangkat", null, "nama_pangkat")),
            array("Nama Jabatan", null, "text"),
            array("Deskripsi Jabatan", null, "text"),
            array("Job Desk", null, "textarea-req-en"),


        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi'??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";
            $page['database']['where'][] = array("$database_utama.id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_divisi']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_semester']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_pangkat']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function anggota()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "hcms__struktur__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi")),
            array("User", null, "select", array("apps_user", null, "nama_lengkap")),
            // array("Jabatan", null, "select", array("hcms__struktur__jabatan", null, "nama_jabatan")),
            // array("Hak Akses", null, "select", array("hcms__role__hak_akses", null, "nama_hak_akses")),
            // array("Role", null, "select", array("webmaster__", null, "nama_role")),
            array("Tanggal Bergabung Keorganisasian", null, "date"),
            array("Tanggal Berhenti Keorganisasian", null, "date"),
            array("Anggota Ref", null, "text"),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;

        $sub_kategori[] = ["",  $database_utama . "__jabatan", null, "table"];
        $array_sub_kategori[] = array(

            array("Jabatan", null, "select", array("hcms__struktur__jabatan", null, "nama_jabatan")),
            array("Mulai menjabat", null, "date"),
            array("Berakhir Menjabat", null, "date"),
            array("Kontribusi", "kontribusi", "textarea"),

        );
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        if ($_SESSION['hak_akses']??'organisasi' == 'organisasi') {
            $page['crud']['insert_value']['id_organisasi'] ="ID_ORGANISASI|";
            $page['crud']['crud_inline']['id_organisasi'] = " read-only ";
            $page['database']['where'][] = array("$database_utama.id_organisasi", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_organisasi']['where'][] = array("id", '=',"ID_ORGANISASI|");
            $page['crud']['select_database_costum']['id_jabatan']['where'][] = array("id_organisasi", '=',"ID_ORGANISASI|");
        }
        $page['get']['sidebarIn'] = true;;
        return $page;
    }



    //Master Data
    public static function tipe_pemberian()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__gratifikasi__master_" . __FUNCTION__;
        $primary_key = "m_tipe_pemberian_id";

        $array = array(
            array("Nama Tipe Pemberian", "nama_tipe_pemberian", "text"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    //
}

trait  HCMS_ABSENSI
{
    public static function mesin_absen()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama", "nama", "text-req-en"),
            array("IP", "ip", "text-req-en"),
            array("Port", "port", "text-req-en"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function batas_pengajuan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Batas", "nama_batas", "text-req-en"),
            array("Tipe", "tipe", "select-manual-req-en", array("Periode" => "Periode", "+" => "Plus", "-" => "minus", "-1" => "Tidak Ada Batasan")),
            array("Jumlah Hari", "jumlah_hari", "number-req-en"),
            array("", "minimal_hari_h", "select-manual-req-en", array(2 => "Tidak", 1 => "Ya")),
            // array("Nama Parameter Input", "nama_parameter_input", "text-req-en"),
            // array("Jumlah Hari Sebelum Parameter", "jumlah_hari_sebelum_parameter", "text-req-en"),
            // array("Jumlah Hari Setelah Parameter", "jumlah_hari_setelah_parameter", "text-req-en"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function tipe_pengajuan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Tipe", "nama_Tipe", "text-req-en"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function jenis_izin()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Pengajuan", "nama_pengajuan", "text-req-en"),
            array("Kode Pengajuan", "kode_pengajuan", "text-req-en"),
            array("Jumlah Batasan Hari Pengajuan", "jumlah_batasan_hari_pengajuan", "text-req-en"),
            // array("Tipe", "tipe", "text-req-en"),
            array("Wajib File", "wajib_file", "select-manual-req", array(1 => "Ya", 2 => "Tidak")),
            array("Batas Pengajuan ", "batas_pengajuan", "select-req-en", array("hcms__absensi__master__batas_pengajuan", "id", 'nama_batas'), null),
            array("Batas Atasan Approve", "batas_atasan_approve", "text", array("organisasi_kategori", "id_organisasi_kategori", "nama_kategori")),
            array("Jenis Alasan", "jenis_alasan", "select-manual-req", array(1 => "Ya", 2 => "Tidak")),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function alasan()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Jenis Izin ", "jenis_izin", "select-req-en", array("hcms__absensi__master__jenis_izin", "id", 'nama_pengajuan'), null),
            array("Alasan", "alasan", "text"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function hari_libur_nasional()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Tanggal ", "tanggal", "date-req-en"),
            array("Nama Hari Libur", "nama_hari_libur", "text-req-en"),
            array("Cuti Bersama", "cuti_bersama", "select-manual-req-en", array(1 => "Ya", "2" => "Tidak")),
            array("Karyawan yang mempunyai hak cuti?", "punya_hak_cuti", "select-manual-en", array(1 => "Terhitung Cuti", "2" => "Tidak Terhitung Cuti")),
            array("Karyawan yang kurang sisa hak cuti?", "kurang_cuti", "select-manual-en", array(1 => "Potong Gaji", "2" => "Hutang Cuti", 3 => "Tidak Hutang Cuti & Potong Gaji")),
            array("Karyawan yang tidak mempunyai hak cuti?", "tidak_punya_hak_cuti", "select-manual-en", array(1 => "Potong Gaji", "2" => "Hutang Cuti", 4 => "Potong Gaji <= (n) Bulan, Hutang Cuti > (n) Bulan", 3 => "Tidak Hutang Cuti & Potong Gaji")),
            array("Total Bulan", "n_bulan", "number-en"),

        );
        $page['crud']['table_group']['Tanggal'][] = "tanggal";
        $page['crud']['table_group']['Nama Hari Libur'][] = "nama_hari_libur";
        $page['crud']['table_group']['Cuti Bersama'][] = "cuti_bersama";
        $page['crud']['table_group']['Cuti Bersama'][] = "punya_hak_cuti";
        $page['crud']['table_group']['Cuti Bersama'][] = "kurang_cuti";
        $page['crud']['table_group']['Cuti Bersama'][] = "tidak_punya_hak_cuti";
        $page['crud']['table_group']['Cuti Bersama'][] = "n_bulan";


        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function jam_kerja_entitas()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Entitas", "entitas", "select-req-en", array("organisasi", "id", "nama_organisasi")),
            array("Tanggal Awal", "tanggal_awal", "date-req-en"),
            array("Tanggal Akhir", "tanggal_akhir", "date-req-en"),
            array("Jam Masuk", "jam_masuk", "time-req-en"),
            array("Jam Keluar", "jam_keluar", "time-req-en"),
            array("Keterangan", "keterangan", "text-req-en"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function periode_absen()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__master__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Tahun", "tahun", "number-req-en"),
            array("Bulan", "bulan", "number-req-en"),
            array("Tanggal Awal Absen", "tanggal_awal_absen", "date-req-en"),
            array("Tanggal Akhir Absen", "tanggal_akhir_absen", "date-req-en"),
            array("Tanggal Awal Lembur", "tanggal_awal_lembur", "date-req-en"),
            array("Tanggal Akhir Lembur", "tanggal_akhir_lembur", "date-req-en"),
            array("Periode Gajian", "periode_gajian", "select-manual-req-en", array("Pekanan" => "Pekanan", "Bulanan" => "Bulanan")),
            array("Pekanan Ke", "pekanan_ke", "number-en"),
            array("Periode Aktif?", "periode_aktif", "select-manual-req-en", array(1 => "Ya", 2 => "Tidak")),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    ///SHIFT///


    ////LAPORAN///
    public static function rekap_absen() {}
    public static function cek_absen() //belum
    {}

    //pengajuan

    public static function izin_kerja() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__transaksi__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Jenis Izin", "jenis_izin", "select-req-en", array("hcms__absensi__master__jenis_izin", null, "nama_pengajuan")),
            array("Tanggal Awal", "tanggal_awal", "text-req-en"),
            array("Tanggal Akhir", "tanggal_akhir", "text-req-en"),
            array("Lama", "lama", "number-req-en"),
            array("File", "file", "file-req-en", "hcms/File Pengajuan/Izin Kerja"),
            array("Penanggung jawab sementara", "penanggung_jawab_sementara", "select-req-en", array("apps_user", "id_apps_user", "nama-_lengkap")),
            array("Alasan", "alasan", "select-req-en", array("hcms__absensi__master__alasan", null, "alasan")),
            array("Keterangan", "keterangan", "text-req-en"),

        );
        //  array("Tipe Perdin","tipe_perdin","text-req-en"),
        //     array("Alat Transportasi","alat_transportasi","text-req-en"),
        //     array("Tempat Tujuan","tempat_tujuan","text-req-en"),
        //     array("KM Awal","km_awal","text-req-en"),


        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function perdin() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__transaksi__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Jenis Izin", "jenis_izin", "select-req-en", array("hcms__absensi__master__jenis_izin", null, "nama_pengajuan")),
            array("Tanggal Awal", "tanggal_awal", "text-req-en"),
            array("Tanggal Akhir", "tanggal_akhir", "text-req-en"),
            array("Lama", "lama", "number-req-en"),
            array("File", "file", "file-en", "hcms/File Pengajuan/Perdin"),
            array("Penanggung jawab sementara", "penanggung_jawab_sementara", "select-req-en", array("apps_user", "id_apps_user", "nama-_lengkap")),
            array("Tipe Perdin", "tipe_perdin", "text-req-en"),
            array("Alat Transportasi", "alat_transportasi", "text-req-en"),
            array("Tempat Tujuan", "tempat_tujuan", "text-req-en"),
            array("KM Awal", "km_awal", "text-req-en"),
            array("Keterangan Tugas", "keterangan", "text-req-en"),


        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function pergantian_hari_libur() //belum
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__absensi__transaksi__" . __FUNCTION__;
        $primary_key = null;

        $array = array(


            array("Tanggal Libur Awal", "tanggal_libur_awal", "date-req-en"),
            array("Tanggal Libur Diajukan", "tanggal_libur_diajukan", "date-req-en"),
            array("File", "file", "file-req-en", "hcms/File Pengajuan/Pergantian Hari Libur"),

            array("Alasan Pergantian hari libur", "alasan_pergantian_hari_libur", "text-req-en"),


        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    // public static function klarifikasi(){
    //     array("Topik","topik","text-req-en"),
    //     array("Tanggal Klarifikasi","tanggal_klarifikasi","text-req-en"),
    //     array("Masalah","masalah","text-req-en"),
    //     array("File","file","text-req-en"),
    //     array("Jam Masuk","jam_masuk","text-req-en"),
    //     array("Jam Keluar","jam_keluar","text-req-en"),
    //     array("Atasan","atasan","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //     array("Deskripsi","deskripsi","text-req-en"),
    // }
    // public static function absen_backdate(){
    //     array("Nama","nama","text-req-en"),
    //     array("Mesin","mesin","text-req-en"),
    //     array("Tanggal Awal","tanggal_awal","text-req-en"),
    //     array("Tanggal Akhir","tanggal_akhir","text-req-en"),
    //     array("Jam","jam","text-req-en"),
    //     array("Kategori","kategori","text-req-en"),
    // }



}

trait  HCMS_ADUAN_KARYAWAN
{
    //     public static function gratifikasi(){
    //         array("Tanggal Diterima","tanggal_diterima","text-req-en"),
    //         array("Nama lembaga/perusahaan/nama pemberi","nama_lembaga/perusahaan/nama_pemberi","text-req-en"),
    //         array("Nama Barang","nama_barang","text-req-en"),
    //         array("Perkiraan Harga","perkiraan_harga","text-req-en"),
    //         array("Bukti","bukti","text-req-en"),
    //         array("Keterangan","keterangan","text-req-en"),
    //     }
    //     public static function pelaporan_sp_st(){
    //         array("Karyawan Dilaporkan","karyawan_dilaporkan","text-req-en"),
    //         array("Jenis Sanksi","jenis_sanksi","text-req-en"),
    //         array("Alasan Sanksi","alasan_sanksi","text-req-en"),
    //         array("Tindakan Yang disarankan","tindakan_yang_disarankan","text-req-en"),
    //     }
    //     public static function keluh_kesah(){
    //         array("Judul Keluh Kesah","judul_keluh_kesah","text-req-en"),
    //         array("Sampaikan Keluh Kesah","sampaikan_keluh_kesah","text-req-en"),
    //     }
}
trait HCMS_KARYAWAN
{

    //     public static function kontrak_kerja(){
    //         array("Karyawan","karyawan","text-req-en"),
    //         array("Tanggal Awal Kontrak","tanggal_awal_kontrak","text-req-en"),
    //         array("Tanggal Akhir Kontrak","tanggal_akhir_kontrak","text-req-en"),
    //         array("File Kontrak kerja","file_kontrak_kerja","text-req-en"),
    //         array("Keterangan","keterangan","text-req-en"),
    //         array("Entitas","entitas","text-req-en"),
    //         array("Departemen","departemen","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //         array("Divisi","divisi","text-req-en"),
    //         array("Jabatan/Pangkat","jabatan/pangkat","text-req-en"),
    //         array("Status Pekerjaan","status_pekerjaan","text-req-en"),
    //         array("Kantor","kantor","text-req-en"),
    //     }
    //     public static function pengajuan_karyawan(){
    //         array("Posisi Yang Dibutuhkan","posisi_yang_dibutuhkan","text-req-en"),
    //         array("Nama Posisi","nama_posisi","text-req-en"),
    //         array("Dapartement","dapartement","text-req-en"),
    //         array("Level","level","text-req-en"),
    //         array("Entitas","entitas","text-req-en"),
    //         array("Lokasi Penempatan","lokasi_penempatan","text-req-en"),
    //         array("Jumlah Kebutuhan","jumlah_kebutuhan","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //         array("Tanggal Diperlukan","tanggal_diperlukan","text-req-en"),
    //         array("Alasan Permintaan","alasan_permintaan","text-req-en"),
    //         array("Alasan Penambahan Karyawan","alasan_penambahan_karyawan","text-req-en"),
    //         array("Nama Karyawan yang diganti","nama_karyawan_yang_diganti","text-req-en"),
    //         array("Gambarkan Posisi dalam Struktur Organisasi","gambarkan_posisi_dalam_struktur_organisasi","text-req-en"),
    //         array("Uraian Pekerjaan","uraian_pekerjaan","text-req-en"),


    //         array("Kualifikasi Usia","kualifikasi_usia","text-en"),
    //         array("Kualifikasi Jenis Kelamin","kualifikasi_jenis_kelamin","text-en"),
    //         array("Kualifikasi Keahlian","kualifikasi_keahlian","text-en"),
    //         array("Kualifikasi Minimal Pendidikan dan Jurusan","kualifikasi_minimal_pendidikan_dan_jurusan","text-en"),
    //         array("Kualifikasi Pengalaman Kerja","kualifikasi_pengalaman_kerja","text-en"),
    //         array("Kompetensi lainnya","kompetensi_lainnya","text-en"),
    //     }public static function pengajuan_karyawan_kandidat(){
    //         array("Nama Kandidat","nama_kandidat","text-req-en"),
    //         array("No WA Kandidat","no_wa_kandidat","text-req-en"),
    //         array("File CV","file_cv","text-req-en"),
    //         array("Kode","kode","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //         array("Email Kandidat","email_kandidat","text-req-en"),
    //         array("Rekomendasi HR","rekomendasi_hr","text-req-en"),
    //         array("Keterangan HR","keterangan_hr","text-req-en"),
    //         array("File Interview 1","file_interview_1","text-req-en"),
    //         array("File Interview 2","file_interview_2","text-req-en"),
    //         array("File Psikogram","file_psikogram","text-req-en"),
    //     }
    //     public static function mutasi_demosi_promosi(){
    //         array("Jenis","jenis","text-req-en"),
    //         array("Tujuan Entitas","tujuan_entitas","text-req-en"),
    //         array("Tujuan Jabatan","tujuan_jabatan","text-req-en"),
    //         array("Appproval Direksi*","appproval_direksi*","text-req-en"),
    //         array("Karyawan","karyawan","text-req-en"),
    //         array("Deskripsi","deskripsi","text-req-en"),
    //         array("Deskripsi Asesment HC","deskripsi_asesment_hc","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //         array("File Asesment HC","file_asesment_hc","text-req-en"),
    //         array("Status Asesment HC","status_asesment_hc","text-req-en"),
    //         array("Status","status","text-req-en"),
    //     }
    //     public static function pengajuan_resign(){
    //         array("Tanggal Terakhir Kerja","tanggal_terakhir_kerja","text-req-en"),
    //         array("Alasan Mengundurkan Diri","alasan_mengundurkan_diri","text-req-en"),
    //     }

}
trait  HCMS_CUTI
{
    // public static function reset_cuti(){
    //     array("Reset Tahun Cuti","reset_tahun_cuti","text-req-en"),
    //     array("Tanggal","tanggal","text-req-en"),
    // }
    // public static function laporan_cuti_karyawn(){
    // }
    // public static function rekap_cuti_karyawan(){
    // }
}
trait  HCMS_FASILITAS_PERUSAHAAN
{
    //     public static function pengajuan_faskes(){

    //         array("Nama Pasien","nama_pasien","text-req-en"),
    //         array("Nama Penyakit","nama_penyakit","text-req-en"),
    //         array("Nominal","nominal","text-req-en"),
    //         array("Foto","foto","text-req-en"),
    //         array("Tanggal Kebutuhan","tanggal_kebutuhan","text-req-en"),
    //         array("Keterangan","keterangan","text-req-en"),
    //     }
    //     public static function pengajuan_bpjs(){
    //         array("Anggota Keluarga Yang Diajukan","anggota_keluarga_yang_diajukan","text-req-en"),
    //         array("Alamat","alamat","text-req-en"),
    //         array("Tanggal Lahir","tanggal_lahir","text-req-en"),
    //         array("NIK","nik","text-req-en"),
    //         array("File KK pengaju","file_kk_pengaju","text-req-en"),
    //         array("File KTP pengaju","file_ktp_pengaju","text-req-en"),
    //         array("File BPJS Karyawan","file_bpjs_karyawan","text-req-en",array("organisasi_kategori","id_organisasi_kategori","nama_kategori")),
    //         array("File BPJS Induk(BPJS Suami/Istri)","file_bpjs_induk(bpjs_suami/istri)","text-req-en"),
    //     }
    // }
    // class HCMS_PENGGAJIAN {
    //     public static function webmaster_tipe_gaji(){
    //         array("Nama Tipe Gaji","nama_tipe_gaji","text-req-en"),

    //     }
    //     public static function webmaster_master_gaji(){
    //         array("Nama Master Gaji","nama_master_gaji","text-req-en"),
    //         array("Tipe_gaji","tipe_gaji","text-req-en"),
    //         array("Berjangka/pokok","berjangka_pokok","select-manual",array()),

    //     }
    //     public static function master_gaji(){
    //         array("webmaster_gaji","webmaster_gaji","select_other-req-en"),
    //         array("periode_gaji","periode_gaji","select-manual"),
    //     }
    //     public static function master_gaji_pokok(){
    //         array("nama_karyawan","nama_karyawan","select_other-req-en"),
    //     }
    //     public static function master_gaji_berjangka(){
    //         array("Karyawan","karyawan","text-req-en"),
    //         array("Nominal","nominal","text-req-en"),
    //         array("No Anggota","no_anggota","text-req-en"),
    //         array("Tanggal Awal","tanggal_awal","text-req-en"),
    //         array("Tanggal Akhir","tanggal_akhir","text-req-en"),
    //     }
    //     public static function generate_gaji(){
    //         array("Tahun","tahun","text-req-en"),
    //         array("Bulan","bulan","text-req-en"),
    //         array("Periode Gajian","periode_gajian","text-req-en"),
    //         array("Pekanan Ke","pekanan_ke","text-req-en"),
    //         array("Periode Absen","periode_absen","text-req-en"),
    //         array("Periode Lembur","periode_lembur","text-req-en"),
    //     }
    //     public static function susunan_preview_table(){
    //         array("Tahun","tahun","text-req-en"),
    //         array("Bulan","bulan","text-req-en"),
    //         array("Periode Gajian","periode_gajian","text-req-en"),
    //         array("Pekanan Ke","pekanan_ke","text-req-en"),
    //         array("Periode Absen","periode_absen","text-req-en"),
    //         array("Periode Lembur","periode_lembur","text-req-en"),
    //     }
}
trait  HCMS_KPI
{
    // public static function kpi(){
    // array("Periode","periode","text-req-en"),
    // array("Tanggal Awal","tanggal_awal","text-req-en"),
    // array("Tanggal Akhir","tanggal_akhir","text-req-en"),
    // array("Tipe Pencapaian","tipe_pencapaian","text-req-en"),
    // array("Atasan 1","atasan_1","text-req-en"),
    // array("Atasan 2","atasan_2","text-req-en"),
    // }
    // public static function kpi_detail(){
    //     array("Area Kerja","area_kerja","text-req-en"),
    //     array("Sasaran Kerja","sasaran_kerja","text-req-en"),
    //     array("Definisi","definisi","text-req-en"),
    //     array("Target","target","text-req-en"),
    //     array("Satuan","satuan","text-req-en"),
    //     array("Prioritas","prioritas","text-req-en"),
    //     //breakdown target
    // }
}
trait  HCMS_PERUSAHAAN
{
    public static function grade()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        if (!isset($_POST['contentfaiframework'])) $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');

        $database_utama = "hcms__perusahaan__master_" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Grade", "nama_grade", "text-req-en"),
            array("Job Weight Minimum", "job_weight_minimum", "number-req-en"),
            array("Job Weight Maximum", "job_weight_maximum", "number-req-en"),
        );



        $page['crud']['search'] = array();
        $page['crud']['array'] = $array;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();

        $page['get']['sidebarIn'] = true;;
        return $page;
    }
}
