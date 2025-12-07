<?php

class Form
{

        public  function form()
        {
                $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
                $page['route'] = __FUNCTION__;
                $page['layout_pdf'] = array('a4', 'portait');

                $database_utama = "form";
                $primary_key = null;

                $array = array(
                        array("Tipe form", "tipe_form", "select-manual-req", array("board" => "Board Form", "User" => "User Form")),
                        array("Board", "board", "select", array("web__list_apps_board", null, "Nama Board")),

                        array("Load Apps", null, "text"),
                        array("Load Page View", null, "text"),
                        array("Database Utama", null, "text"),
                        array("Style Form", null, "text"),

                        array("Brosur Form", "brosur_form", "file"),
                        array("Nama form", "nama_form", "text-req"),
                        array("Deskripsi", "deskripsi", "textarea-req"),
                        array("Pesan setelah submit", "pesan_setelah_submit", "textarea-req"),

                        array("Status form", "status_form", "select-manual-req", array("open" => "Open", "open_jadwal" => "Open Sesuai Jadwal", "close" => "Close")),
                        array("Pesan setelah Penutupan Form", "pesan_setelah_penutupan_form", "textarea-req"),
                        array("Link Spreadsheet", null, "text-req"),
                        array("Sheet", null, "text-req"),
                        array("Status approval Proses", null, "text-req"),
                        array("Status approval Update", null, "text-req"),


                );
                $sub_kategori[] = ["Form", $database_utama . "__form__class", null, "table"];
                $form =  $array_sub_kategori[] = array(
                        array("Pertanyaan", "pertanyaan", "text-req"),
                        array("Tipe Form", "tipe_form", "select", array("webmaster__form__tipe", "form_tipe", "nama_tipe")),
                        array(
                                "option",
                                "option",
                                "modalform-subkategori-add",
                                array(
                                        "type" => "many",
                                        "database" => $database_utama . "__form_option",
                                        "array" => array(
                                                array("Option", "option", "text-req"),
                                                array("Deskripsi", "deskripsi", "text-req"),
                                                array("urutan option", "urutan_option", "number"),
                                        )
                                )
                        ),
                );
                $sub_kategori[] = ["Form", $database_utama . "__form__extend", null, "table"];
                $array_sub_kategori[] = array(
                        array("Pertanyaan", "pertanyaan", "text-req"),
                        array("Tipe Form", "tipe_form", "select", array("webmaster__form__tipe", "form_tipe", "nama_tipe")),
                        array(
                                "option",
                                "option",
                                "modalform-subkategori-add",
                                array(
                                        "type" => "many",
                                        "database" => $database_utama . "__form_option",
                                        "array" => array(
                                                array("Option", "option", "text-req"),
                                                array("Deskripsi", "deskripsi", "text-req"),
                                                array("urutan option", "urutan_option", "number"),
                                        )
                                )
                        ),
                );
                $sub_kategori[] = ["Form", $database_utama . "__approval", null, "table"];
                $array_sub_kategori[] = array(
                        array("Approval Ke", null, "number-req"),
                        array("Group Approval", null, "select", array("web__list_apps_board__role__group", null, "nama_role_group")),
                        array("Tipe Approval", null, "select-manual", array("Proses" => "Approval Proses", "Update" => "Approval Update")),
                        array("User Approval", null, "select-manual", array("Semua user dalam role" => "Semua user dalam role", "Spesifik user dalam role" => "Spesifik user dalam role")),
                        array(
                                "option",
                                "option",
                                "modalform-subkategori-add",
                                array(
                                        "type" => "many",
                                        "database" => $database_utama . "__form__approval",
                                        "array" => array(
                                                array("Option", "option", "text-req"),
                                                array("Deskripsi", "deskripsi", "text-req"),
                                                array("urutan option", "urutan_option", "number"),
                                        )
                                )
                        ),

                );
                $sub_kategori[] = ["Open Form", $database_utama . "__open", null, "table"];
                $array_sub_kategori[] = array(

                        array("Tanggal awal ", "tanggal_awal_", "date"),
                        array("Jam Awal", "jam_awal", "time"),
                        array("Tanggal akhir", "tanggal_akhir", "date"),
                        array("Jam Akhir", "jam_akhir", "time"),
                );
                $page['crud']['sub_kategori'] = $sub_kategori;
                $page['crud']['array_sub_kategori'] = $array_sub_kategori;
                $search = array();

                $page['crud']['array'] = $array;
                $page['crud']['search'] = $search;
                $page['panel'] = 'form';

                $page['database']['utama'] = $database_utama;
                $page['database']['primary_key'] = $primary_key;
                $page['database']['select'] = array("*");;
                $page['database']['join'] = array();
                $page['database']['where'] = array();
                return $page;
        }
        public function board()
        {
                $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
                $page['route'] = __FUNCTION__;
                $page['layout_pdf'] = array('a4', 'portait');

                $database_utama = "form__board";
                $primary_key = null;

                $array = array(
                        array("Nama form", "nama_form", "text-req"),
                        array("Deskripsi", "deskripsi", "textarea-req"),
                        array("Pesan setelah submit", "pesan_setelah_submit", "textarea-req"),
                        array("Tanggal awal ", "tanggal_awal_", "date"),
                        array("Jam Awal", "jam_awal", "time"),
                        array("Tanggal akhir", "tanggal_akhir", "date"),
                        array("Jam Akhir", "jam_akhir", "time"),
                        array("Pesan setelah Penutupan Form", "pesan_setelah_penutupan_form", "textarea-req"),
                        array("Brosur Form", "brosur_form", "file"),


                );
                $search = array();

                $page['crud']['array'] = $array;
                $page['crud']['search'] = $search;
                $page['panel'] = 'form';

                $page['database']['utama'] = $database_utama;
                $page['database']['primary_key'] = $primary_key;
                $page['database']['select'] = array("*");;
                $page['database']['join'] = array();
                $page['database']['where'] = array();
                return $page;
        }
        public function section()
        {
                $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
                $page['route'] = __FUNCTION__;
                $page['layout_pdf'] = array('a4', 'portait');

                $database_utama = "form__section";
                $primary_key = null;

                $array = array(
                        array("Nama section", "nama_section", "text-req"),
                        array("Urutan section", "urutan_section", "number"),
                        array("Deskripsi section", "deskripsi_section", "textarea-req"),

                );

                $sub_kategori[] = ["Form", $database_utama . "__form", null, "table"];
                $array_sub_kategori[] = array(
                        array("Pertanyaan", "pertanyaan", "text-req"),
                        array("Tipe Form", "tipe_form", "select", array("webmaster__form__tipe", "form_tipe", "nama_tipe")),
                        array(
                                "option",
                                "option",
                                "modalform-subkategori-add",
                                array(
                                        "type" => "many",
                                        "database" => $database_utama . "__form_option",
                                        "array" => array(
                                                array("Option", "option", "text-req"),
                                                array("Deskripsi", "deskripsi", "text-req"),
                                                array("urutan option", "urutan_option", "number"),
                                        )
                                )
                        ),
                );


                $page['crud']['sub_kategori'] = $sub_kategori;
                $page['crud']['array_sub_kategori'] = $array_sub_kategori;

                $search = array();

                $page['crud']['array'] = $array;
                $page['crud']['search'] = $search;


                $page['database']['utama'] = $database_utama;
                $page['database']['primary_key'] = $primary_key;
                $page['database']['select'] = array("*");;
                $page['database']['join'] = array();
                $page['database']['where'] = array();
                return $page;
        }
        public function response()
        {


                //sub option


        }
}
