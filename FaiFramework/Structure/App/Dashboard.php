<?php

class Dashboard
{

    public static function user($page)
    {

        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "hibe3";
        $website['content'][$i]['template_file'] = "blockbanner.template";
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "text",
                "value" => "Hi, Assalamualaikum"
            ),
            array(
                "tag" => 'SUBTITLE',
                "refer" => "text",
                "value" => "Sudah Senyumkah Hari Ini?"
            ),
        );
        $i += 1;
        $website['content'][$i]['tag'] = "";
        $website['content'][$i]['content_source'] = "text";
        $website['content'][$i]['content'] = "<div class='container-fluid'>";


        $i += 1;

        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "finapp";
        $website['content'][$i]['template_file'] = "Dashboard-card.template";
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "database",
                "database_refer" => "Profile",
                "database_row" => "nama"
            ),
            array(
                "tag" => 'DESCRIBE',
                "refer" => "database",
                "prefix" => "Be3 ID: ",
                "enkripsi_prefix" => true,
                "database_refer" => "Profile",
                "database_row" => "apps_id"
            ),
            array(
                "tag" => 'SUBTITLE',
                "refer" => "text",
                "value" => "Panel " . (isset($_SESSION['hak_akses'])?ucwords($_SESSION['hak_akses']):'')
            ),
            array(
                "tag" => 'FOOTER',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Panel Connection",
                "template_name" => "finapp",
                "template_file" => "Dashboard-card-footer_item.template",
                "array" => array(
                    "TITLE" => array("refer" => "database", "row" => "nama_connection"),
                    "ICON" => array(
                        "refer" => "text",
                        "text" => "-",


                    ),
                )
            ),
        );
        // print_r($_SESSION);
        $i += 1;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "hibe3";
        $website['content'][$i]['template_file'] = "checkboxgroup.template";
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "text",
                "value" => ""
            ),
            array(
                "tag" => 'TEXT-GROUP',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "List Apps Group",
                "template_name" => "hibe3",
                "template_file" => "checkboxgroup_group.template",
                "array" => array(
                    "GROUP-TITLE" => array("refer" => "database", "row" => "nama_group"),
                    "CHECKBOX" => array(
                        "refer" => "database_list",
                        "database_refer" => "-1",
                        "database" => array(
                            "utama" => "web__list_apps",
                            "primary_key" => null,

                            "where" => array(
                                array("tampilkan", "=","'2'"),
                               
                            ),
                            "order" => array(
                                array("urutan", "asc"),
                                array("nama_apps", "asc"),
                            ),
                            "join" => array(
                                array("web__menu", "web__list_apps.id_first_menu", "web__menu.id"),
                            ),
                            "where_get_array" => array(
                                array("row" => "{IDPRIMARY}group{/IDPRIMARY}", "array_row" => "database_list_template", "get_row" => "primary_key"),
                            )
                        ),
                        "template_name" => "hibe3",
                        "template_file" => "checkboxgroup_checkbox.template",
                        "array" => array(
                            "LINK" => array("refer" => "link_row_database", "route_type" => "window_location", "apps" => "load_apps", "page_view" => "load_page_view", "type" => "load_type", "id" => "load_page_id", "menu" => "menu", "nav" => "nav"),
                            "TITLE" => array("refer" => "database", "row" => "nama_apps"),
                            "INLINE-INPUT" => array("refer" => "text", "text" => "disabled"),
                        )

                    ),
                )
            ),
        );

        $page['view_layout'][] = array("website", "col-md-12", $website);
        //List Apps Group

        if (isset($_SESSION['hak_akses'])) {
            if ($_SESSION['hak_akses'] == 'user') {
                $page['config']['database']['Profile']['select'][] = 'apps_id,apps_user.nama_lengkap as nama';
                $page['config']['database']['Profile']['utama'] = 'apps_user';
                $page['config']['database']['Profile']['where'][] = array("id_apps_user", "=", $_SESSION['id_apps_user']);
            }else
            if ($_SESSION['hak_akses'] == 'organisasi') {
                $page['config']['database']['Profile']['select'][] = 'apps_id,organisasi.nama_organisasi as nama';
                $page['config']['database']['Profile']['utama'] = 'organisasi';
                $page['config']['database']['Profile']['where'][] = array("id", "=", $_SESSION['id_organisasi']);
            }
        } else {
        }
        $page['config']['database']['List Apps Group']['utama'] = 'web__list_apps_group';
        $page['config']['database']['List Apps Group']['primary_key'] = null;
        $page['config']['database']['List Apps Group']['where'][] = array("tampilkan", "=", "'2'");
        $page['config']['database']['List Apps Group']['where'][] = array("active", "=", "1");
        $page['config']['database']['List Apps Group']['order'][] = array("urutan", "asc");


        $page['config']['database']['Panel Connection']['utama'] = 'web__panel__connection';
        $page['config']['database']['Panel Connection']['primary_key'] = null;
        $page['config']['database']['Panel Connection']['where'][] = array("id_panel_list", "=", "1");
        return $page;
    }
}
