<?php


class Web_Topic extends Web_topic_master {}
class Website extends Web_Topic
{
    public static function website_template_kategori()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__template__master__kategori";
        $primary_key = null;

        $array = array(
            array("Kode Kategori", null, "text"),
            array("Nama Kategori", null, "text"),



        );
        $page['crud']['insert_value']['navbar_file'] = "NavbarPage";


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
    public static function website_template_main()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__template__main";
        $primary_key = null;

        $array = array(
            array("Versi", null, "text"),

            array("Main Utama", null, "editor-code"),
            array("Main CSS", null, "editor-code"),
            array("Main JS", null, "editor-code"),


        );
        $page['crud']['insert_value']['navbar_file'] = "NavbarPage";


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
    public static function website_template_list()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__template__list";
        $primary_key = null;

        $array = array(
            array("Nama Template", null, "text"),
            array("Sidebar fixed", null, "select", array("website__bundles__list", null, 'nama_bundle')),
            array("Main Content Template", null, "editor-code"),
            array("Main Content Template css", null, "editor-code"),
            array("Main Content Template js", null, "editor-code"),


        );



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

    public static function website_template_list_file($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__template__file";
        $primary_key = null;

        $array = array(
            array("Kategori", null, "select", array("website__template__master__kategori", null, "nama_kategori")),
            array("Template", null, "select", array("website__template__list", null, "nama_template")),
            array("Nama File", null, "text"),
            array("Kontent File", null, "editor-code"),
            // array("Kontent File CSS",null,"editor-code"),
            // array("Kontent File JS",null,"editor-code"),


        );
        $sub_kategori[] = ["Tag Kontent", "" . $database_utama . "__tag", null, "table"];
        $array_sub_kategori[] = array(

            array("Tag", null, "text"),

        );
        if ($page['section'] != 'generate') {

            $link = $page['load']['link'];
            $page['load']['link'] = 'direct';
            $page['route_type'] = "just_just";
        }
        $page['crud']['crud_after'] = "
        <button type='button' onclick='getTag()' >
            Get Tag
        </button>
        <script>
            function getTag(){
                typing_kontent_file0();
                get = escapeHtml($('#kontent_file0').val());
                
                 $.ajax({
                            type: 'post',
                            data: {
                                
                                'content': get,
                            },
                            url: '" . ($page['section'] == 'generate' ? '' : (Partial::link_direct($page, base_url() . 'pages/', array("Website", "gettag", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link'))) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#tablecontentsubkategori-tbody-0').html(data);
                                
                            },
                            error: function(error) {
                                
                               
                            },
                            
                        });
            }
        </script>
        
        ";
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;

        if ($page['section'] != 'generate')
            $page['load']['link'] = $link;

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
    public static function gettag($page)
    {
        $get = html_entity_decode(htmlspecialchars_decode($_POST['content']));
        //echo $get;
        $ex = explode('></', $get);
        $exTag = explode('<', $ex[0]);
        $stringTag = $exTag[count($exTag) - 1];;
        $tag = [];
        $sudah = [];
        for ($i = 0; $i < count($ex); $i++) {
            $mixTag = substr($ex[$i], 0, strpos($ex[$i], '>'));
            if ($stringTag == $mixTag and !in_array($mixTag, $tag)) {
                $tag[] = $mixTag;
            }

            $exTag = explode('<', $ex[$i]);
            $stringTag = $exTag[count($exTag) - 1];;
        }
        //print_r($tag);
        $content = "";
        for ($i = 0; $i < count($tag); $i++) {

            $x = $i + 1;
            $content .= '<tr id="table-subkateogri-tr-' . $x . '">
                <td>' . $x . '
                    <input class="no-0" name="no_sub_kategori[]" type="hidden" value="' . $x . '">
                </td>
               <td style="padding: 5px;">
                <input name="website__template__file__tag_tag[]" id="tag' . $x . '" type="text" class="form-control  tag" placeholder="Tag" value="' . $tag[$i] . '"></td>
                <input class="contentinput-0" type="hidden">
                <input name="no_sub_kategori-website__template__file__tag[]" value="' . $x . '" type="hidden">
                <td><button type="button" onclick="deleteRow(0,' . $x . ',\'table\')" class="btn btn-primary btn-sm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                                    </button></td></tr>';
        }

        echo $content;
        die;
    }
    public static function website_bundles_refer()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__refer";
        $primary_key = null;

        $array = array(
            array("Nama Refer", null, "text"),
            array("Kode Refer", null, "text"),

        );
        $sub_kategori[] = ["Require Field", "" . $database_utama . "__require", null, "table"];
        $array_sub_kategori[] = array(

            array("Nama Field", null, "text"),
            array("Wajib", null, "select-manual", array("1" => "Ya", "2" => "Tidak")),

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
    public static function website_bundles_if()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__if";
        $primary_key = null;

        $array = array(
            array("Nama If", null, "text"),
            array("Row If", null, "text"),

        );

        $sub_kategori[] = ["Content", "" . $database_utama . "__content", null, "table"];
        $array_sub_kategori[] = array(

            array("is_else", null, "select-manual", array(1 => "Ya", 2 => "Tidak")),
            array("Row value", null, "text"),
            array("If Text", null, "textarea"),
            array("Bundles Tag", null, "select", array("website__bundles__website__master", null, "nama_bundle")),


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
    public static function website_bundles_menu()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__menu";
        $primary_key = null;

        $array = array(
            array("Nama Menu list", null, "text"),
            array("File Foreach", null, "select", array("website__template__file", "id", "nama_file")),

        );

        $sub_kategori[] = ["Content", "" . $database_utama . "__content", null, "table"];
        $array_sub_kategori[] = array(

            array("Nama Show Menu", null, "text"),
            array("Icon", null, "text"),
            array("Menu", null, "select", array("web__list_apps_menu", null, "nama_menu")),


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
    public static function website_bundles_banner()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__banner";
        $primary_key = null;

        $array = array(
            array("Nama Banner", null, "text"),

        );

        $sub_kategori[] = ["Content", "" . $database_utama . "__content", null, "table"];
        $array_sub_kategori[] = array(

            array("urutan", null, "number"),
            array("File", null, "photos", "bundles/banner/"),
            array("Header Caption", null, "text"),
            array("Deskripsi Caption", null, "text"),
            array("link ke", null, "text"),
            array("direct", null, "select", array("web__list_apps_menu", null, "nama_menu")),


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
    public static function website_bundles_link()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__link";
        $primary_key = null;

        $array = array(
            array("Nama Link", null, "text"),
            array("route_type", null, "select-manual", array("just_link" => "Just Link", "just_link_with_kutip" => "Just Link With Kutip", "link_id_menu" => "Link With Menu Web", "costum_link" => "Costum Link", "window_location" => "javascript window location")),


        );

        $sub_kategori[] = ["Link", "" . $database_utama . "__parameter", null, "table"];
        $array_sub_kategori[] = array(

            array("parameter", null, "text"),
            array("Urutan", null, "number"),


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

    public static function website_bundles_function()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__function";
        $primary_key = null;

        $array = array(
            array("Nama Function", null, "text"),
            array("Struktur", null, "text"),
            array("Class", null, "text"),
            array("Function", null, "text"),

        );
        $sub_kategori[] = ["Parameter", "" . $database_utama . "__parameter", null, "table"];
        $array_sub_kategori[] = array(

            array("parameter", null, "text"),
            array("Urutan", null, "number"),

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
    public static function website_bundles_dropdown()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__master__dropdown";
        $primary_key = null;

        $array = array(
            array("Nama Dropdown", null, "text"),


        );
        $sub_kategori[] = ["List", "" . $database_utama . "__list", null, "table"];
        $array_sub_kategori[] = array(

            array("parameter", null, "text"),
            array("Tag", null, "select", array("website__bundles__tag", null, "nama_bundle_tag")),

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

    public static function website_bundles_tag()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__tag";
        $primary_key = null;

        $array = array(
            // array("Parent Bundle Tag",null,"select",array("website__bundles__tag",'id',"nama_bundle_tag",'tag'),null),
            array("Nama Bundle Tag", null, "text"),
            array("Tag", null, "text"),

            array("Refer", null, "select", array("website__bundles__master__refer", "id", "nama_refer")),
            array("Database Refer", null, "select", array("website__bundles__database", "id", "name_database")),
            array("text content", null, "text"),
            array("Database Row", null, "text"),
            array("function", null, "select", array("website__bundles__master__function", null, "nama_function")),
            array("if", null, "select", array("website__bundles__master__if", null, "nama_if")),
            array("dropdown", null, "select", array("website__bundles__master__dropdown", null, "nama_dropdown")),
            array("banner", null, "select", array("website__bundles__master__banner", null, "nama_banner")),
            array("menu list", null, "select", array("website__bundles__master__menu", null, "nama_menu_list")),
            array("link", null, "select", array("website__bundles__master__link", null, "nama_link")),
            array("Get Result", null, "text"),
            array("", "tipe_header", "text"),
            array("", "source_database", "select-manual", array("database" => "Database Layer 1", "database_list_template" => "Database Layer 2", "database_list_template_on_list" => "Database Layer 2", "database_list_template_on_list_on_list" => "Database Layer 4", "database_list_template_on_list_on_list_on_list" => "Database Layer 5")),


        );

        // $sub_kategori[] = ["database", "" . $database_utama . "__require", null, "table"];
        //     $array_sub_kategori[] = array(

        //         array("Nama Field",null,"text"),
        //         array("Wajib",null,"select-manual",array("1"=>"Ya","2"=>"Tidak")),

        //     );

        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;


        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        $page['database']['order'][] = array("nama_bundle_tag");
        return $page;
    }
    public static function website_bundles_website_master()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__website__master";
        $primary_key = null;

        $array = array(
            //array("Kategori",null,"select",array("website__template__master__kategori",null,"nama_kategori")),

            array("Nama Bundle", null, "text"),
            array("file", null, "select", array("website__template__file", "id", "nama_file")),
            array("bundles tag", null, "select", array("website__bundles__tag", "id", "nama_bundle_tag")),
            array("parent tag", null, "select", array($database_utama . "__tag", "id", "nama_parent", "parent")),



        );
        $sub_kategori[] = ["tag", "" . $database_utama . "__tag", null, "table"];
        $array_sub_kategori[] = array(

            array("File Tag", null, "select", array("website__template__file__tag", 'id', "tag"), null),
            array("Bundle Tag", null, "select", array("website__bundles__tag", 'id', "nama_bundle_tag"), null),
            array("Is Sub Array", null, "select-manual", array(1 => "Ya", 2 => "Tidak")),
            array("nama parent", null, "text"),
        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['select_database_costum']['parent_tag']['join'][] = array("website__template__file__tag","website__template__file__tag.id_file_tag","parent_tag");
        $page['crud']['no_row_sub_kategori']["" . $database_utama . "__tag"] = true;


        $page['crud']['field_view_sub_kategori']['id_file']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['id_file']['target'] = "" . $database_utama . "__tag";
        $page['crud']['field_view_sub_kategori']['id_file']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['id_file']['database']['utama'] = "website__template__file__tag";
        $page['crud']['field_view_sub_kategori']['id_file']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['id_file']['database']['select_raw'] = "*";
        $page['crud']['field_view_sub_kategori']['id_file']['database']['where'][] = array('active', '=', "1");
        //$page['crud']['field_view_sub_kategori']['no_request_outgoing']['database']['join'][] = array("erp__bahan_baku__offline__request_outgoing","erp__bahan_baku__offline__request_outgoing_seq","erp__bahan_baku__offline__request_outgoing.seq");
        $page['crud']['field_view_sub_kategori']['id_file']['request_where'] = "id_website__template__file";
        $page['crud']['field_view_sub_kategori']['id_file']['insert_default_value_sub_kategori_request']["" . $database_utama . "__tag"]['id_file'] = 'value';
        $page['crud']['field_view_sub_kategori']['id_file']['field'][] = array(
            -1,
            "id_file_tag", // sesuaikan dengan id di subkategori
            array("File Tag", "tag", "text"), //untuk ditampilkan
            "id" //ambil value get
        );


        $page['crud']['field_view_sub_kategori']['id_file']['field'][] = array(
            0,
            "id_bundle_tag",
            array("Bundle Tag", null, "select", array("website__bundles__tag", 'id', "nama_bundle_tag"), null),
        );

        $page['crud']['field_view_sub_kategori']['id_file']['field'][] = array(
            0,
            "is_sub_array",
            array("Is Sub Array", null, "select-manual", array(1 => "Ya", 2 => "Tidak")),
        );
        $page['crud']['field_view_sub_kategori']['id_file']['field'][] = array(
            -1,
            "nama_parent",
            array("tag", null, "text"),
            "tag"
        );




        $page['crud']['no_action']["" . $database_utama . "__tag"] = true;


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
    public static function website_bundles_list()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__list";
        $primary_key = null;

        $array = array(
            array("Kategori", null, "select", array("website__template__master__kategori", null, "nama_kategori")),
            array("Nama Bundle", null, "text"),

        );
        $sub_kategori[] = ["tag", "" . $database_utama . "__tag", null, "table"];
        $array_sub_kategori[] = array(

            array("tipe", null, "select-manual", array("card" => "Card", "step" => "Step", "website" => "website"), null),
            array("col_row", null, "text"),
            array("Website Master", null, "select", array("website__bundles__website__master", 'id', "nama_bundle"), null),
            array("Card Master", null, "select", array("website__bundles__card__master", 'id', "nama_card"), null),
            array("urutan", null, "number"),
            // array("Card Master",null,"select",array( "website__bundles__card__master",'id',"nama_card"),null),
        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['select_database_costum']['parent_tag']['join'][] = array("website__template__file__tag","website__template__file__tag.id_file_tag","parent_tag");


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

    public static function website_bundles_card()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__card__master";
        $primary_key = null;

        $array = array(

            array("Nama Card", null, "text"),
            array("Title", null, "text"),
            array("SubTitle", null, "text"),
            array("", "limit_page", "number"),
            array("", "default_id", "text"),
            array("", "view_default", "select-manual", array("ViewVertical" => "ViewVertical", "ViewHorizontal" => "ViewHorizontal", "ViewTables" => "ViewTables")),
            array("", "listing_type", "select-manual", array("listingmenu" => "Listing Menu", "profile-menu" => "Profil", "backend" => "Backend")),


        );
        $sub_kategori[] = ["menu", "" . $database_utama . "__menu", null, "table"];
        $array_sub_kategori[] = array(


            array("Nama Menu", null, "text"),
            array("Tipe menu", null, "select-manual", array(
                "card-listing" => "Listing Card",
                "card-layout" => "Layout",
                "card-nav" => "Nav",
                "crud" => "Crud",
                "crud-table" => "Crud Table",
            )),
            array("Tampilkan", null, "select-manual", array("1" => "Ya", "2" => "Tidak")),
            array("Urutan Menu", null, "number"),
            // array("Website Master",null,"select",array("website__bundles__list",null,"nama_bundle","header")),

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
    public static function website_card_nav()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__card__nav";
        $primary_key = null;

        $array = array(

            array("card", null, "select", array("website__bundles__card", null, "nama_nav"), null),
            array("Nama Nav", null, "text"),
            array("Title Nav", null, "text"),
            array("SubTitle Nav", null, "text"),
            array("", "tipe_nav", "select-manual", array(
                "card-listing" => "Listing Card",
                "card-layout" => "Layout"
            )),


        );


        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;


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
    public static function website_database()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__bundles__database";
        $primary_key = null;

        $array = array(

            array("Name Database", "name_database", "text"),
            array("Database Utama", "db_utama", "text"),
            array("Database Primary", "db_primary_key", "text"),
            array("limit", "db_limit", "number"),
            array("query", "db_query", "textarea"),
            array("", "non_add_select", "textarea"),
            array("", "min_1", "select-manual", array("1" => "Ya", "2" => "Tidak")),
            array("", "join_raw", "textarea"),


        );

        $sub_kategori = [
            ["select",  $database_utama . "__select", null, "table"],
            ["where",  $database_utama . "__where", null, "table"],
            ["join",  $database_utama . "__join", null, "table"],
            ["where_get_array",  $database_utama . "__where_get_array", null, "table"]
        ];
        $array_sub_kategori = [
            array(
                array("row", "row_database", "text"),
            ),
            array(
                array("row", "row_database", "text"),
                array("operan", "operan", "select-manual", array(" = " => "sama dengan(=)", "!=" => "tidak sama dengan(!=)", ">" => "lebih dari(>)", "<" => "kurang dari(<)", ">=" => "lebih dari sama dengan(>=)", "<=" => "kurang dari  sama dengan(<=)")),
                array("Value", "value", "text"),
            ),

            array(
                array("database", "database", "text"),
                array("join database in", "join_databasse_in", "text"),
                array("join database out", "join_databasse_out", "text"),
                array("database alias", "database_alias", "text"),
            ),
            array(
                array("", "row", "text"),
                array("", "array_row", "text"),
                array("", "get_row", "text"),
            ),
        ];

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
    // 	public static function panel()
    //     {
    //     	$page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
    //         $page['route'] = __FUNCTION__ ;
    //         $page['layout_pdf'] = array('a4','portait') ;

    //         $database_utama = "website";
    //         $primary_key =null;

    //         $array = array(

    //             array("Panel",null,"select",array("panel",null,"nama_panel")),
    //             array("Status Website","no_telepon","select-manual",""),


    //             array("Term Pembayaran",null,"text"),
    //             array("Nama Narahubung","nama_narahubung","text"),
    //             array("Email","email","text"),

    //       );
    //       $search = array();

    //       $page['crud']['array'] = $array ;
    //       $page['crud']['sub_kategori'] = $sub_kategori ;
    //       $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
    //       $page['crud']['search'] = $search ;


    //  		$page['panel'] = "website";
    // 		$page['database']['utama'] = $database_utama;
    // 		$page['database']['primary_key'] = $primary_key ;
    // 		$page['database']['select'] = array("*","$database_utama.$primary_key as primary_key"); ;
    // 		$page['database']['join'] = array();
    // 		$page['database']['where'] = array();  
    //          return $page;
    //     }
    // 	public static function website_list()
    //     {
    //     	$page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
    //         $page['route'] = __FUNCTION__ ;
    //         $page['layout_pdf'] = array('a4','portait') ;

    //         $database_utama = "website__list";
    //         $primary_key =null;

    //         $array = array(

    //             array("Logo","logo","file","website/master/"),
    //             array("Nama Website","nama_website","text"),
    //             array("Domain","domain","text"),
    //             array("Deskripsi Page(Seo)","deskripsi_page","text"),
    //             array("Keyword(Seo)","keyword","text"),


    //             array("Alamat","alamat","text"),
    //             array("No Telpon","no_telepon","text"),
    //             array("Nama Narahubung","nama_narahubung","text"),
    //             array("Email","email","text"),

    //             array("Utama",null,"select",array("website__template__main",null,"versi")),
    //             array("Main Template",null,"select",array("website__template__list",null,"nama_template")),
    //             array("Header",null,"select",array("website__bundles__list",null,"nama_bundle","header")),
    //             array("Sidebar",null,"select",array("website__bundles__list",null,"nama_bundle","Sidebar")),
    //             array("Footer",null,"select",array("website__bundles__list",null,"nama_bundle","Footer")),
    //       );
    //       $search = array();

    //       $page['crud']['array'] = $array ;
    //     //   $page['crud']['sub_kategori'] = $sub_kategori ;
    //     //   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
    //       $page['crud']['search'] = $search ;


    // //  		$page['panel'] = "website";
    // 		$page['database']['utama'] = $database_utama;
    // 		$page['database']['primary_key'] = $primary_key ;
    // 		$page['database']['select'] = array("*"); ;
    // 		$page['database']['join'] = array();
    // 		$page['database']['where'] = array();  
    //          return $page;
    //     }
    // 	public static function pages()
    //     {
    //     	$page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
    //         $page['route'] = __FUNCTION__ ;
    //         $page['layout_pdf'] = array('a4','portait') ;

    //         $database_utama = "website__list__pages";
    //         $primary_key =null;

    //         $array = array(
    //             array("list_website",null,"select",array("website__list",null,"nama_website")),
    //             array("Bundle",null,"select",array("website__bundles__list",null,"nama_bundle")),

    //       );
    //       $search = array();

    //       $page['crud']['array'] = $array ;
    //     //   $page['crud']['sub_kategori'] = $sub_kategori ;
    //     //   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
    //       $page['crud']['search'] = $search ;


    // 		$page['database']['utama'] = $database_utama;
    // 		$page['database']['primary_key'] = $primary_key ;
    // 		$page['database']['select'] = array("*"); ;
    // 		$page['database']['join'] = array();
    // 		$page['database']['where'] = array();  
    //          return $page;
    //     }

}
class Web_topic_master
{
    public static function menu_topic()
    {
        $menu = array(
            //array("menu","Topic Produk",array("Website","topic__produk","list","-1"),'<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Master"),
            array("menu", "Master", array("Website", "master", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("group", "Content"),
            array("menu", "Organisasi", array("Website", "topic__organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            array("menu", "Kategori Topic", array("Website", "topic__kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Topic List", array("Website", "topic__list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "FAQ", array("Website", "topic__faq", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Timeline", array("Website", "topic__timeline", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Asset Prduk"),
            array("menu", "Kategori", array("Webmaster", "master__kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Jenis Asset", array("Webmaster", "asset__master__jenis", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Brand", array("Inventaris_aset", "brand", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Distributor", array("Inventaris_aset", "distributor", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Produk", array("Inventaris_aset", "asset_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Tanah & Bangunan"),
            array("menu", "Tanah", array("Inventaris_aset", "tanah", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Bangunan", array("Inventaris_aset", "bangunan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Store Produk & Harga"),
            array("menu", "Toko", array("Store", "Toko", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Produk", array("Store", "produk", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("group", "Transaksi"),
            array("menu", "Cart", array("Store", "cart", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            array("menu", "Pesanan", array("Store", "pesanan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
        );
        return $menu;
    }
    public static function topic__page()
    {


        $page['website']['template'] = 'topiclisting';

        $i = 0;
        $page['website']['content'][$i]['tag'] = "NAV-HEADER";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "nav_header.template";
        $page['website']['content'][$i]['template_array'] = array(
            array(
                "tag" => 'LOGO',
                "refer" => "text",
                "value" => "Apa yang kamu butuhkan"
            ),
            array(
                "tag" => 'MENU',
                "refer" => "database_list_if",
                "source_list" => "template",
                "database_refer" => "Header",
                "if" => array(
                    array(
                        "source_if" => "database",
                        "row_if" => "kategori_header",
                        "value" => "1",
                        "refer" => "database_list",
                        "template_name" => "topiclisting",
                        "template_file" => "nav_item_header.template",
                        "array" => array(
                            "NAME" => array("refer" => "database", "row" => "nama_header"),
                            "LINK" => array("refer" => "database", "row" => "nama_header"),
                        ),
                    ),
                    array(
                        "row_if" => "kategori_header",
                        "value" => "2",
                        "refer" => "database_list",
                        "template_name" => "topiclisting",
                        "template_file" => "nav_item_header.template",
                        "array" => array(
                            "NAME" => array("refer" => "database", "row" => "nama_header"),
                            "LINK" => array("refer" => "database", "row" => "nama_header"),
                            "DROPDOWN" => array(
                                "refer" => "database_list",
                                "database_refer" => "-1",
                                "database" => array(
                                    "utama" => "website__master__header__dropdown",
                                    "primary_key" => null,
                                    "select_raw" => "*,(case 
																when website__topic__list.berdasarkan_list='kastore' then (select nama_produk as nama_topic from store__produk)
																when website__topic__list.berdasarkan_list='katin' then (select nama_barang as nama_topic from ltw_inventaris__asset__list) end) as nama_topic",


                                    "join" => array(
                                        array("website__topic__kategori", "website__topic__kategori.{IDTABLE}website__topic__kategori{/IDTABLE}", "{IDPRIMARY}kategori_topic{/IDPRIMARY}"),



                                    ),
                                    "order" => array(
                                        array("urutan", "asc"),
                                        array("urutan_topic", "asc")
                                    ),
                                    "where_get_array" => array(
                                        array(
                                            "row" => "{IDPRIMARY}list_topic{/IDPRIMARY}",
                                            "array_row" => "database_list_template",
                                            "get_row" => "primary_key"
                                        ),
                                    )
                                ),
                                "template_name" => "topiclisting",
                                "template_file" => "content_tab_pane.template",
                                "array" => array()
                            ),
                        )
                    )
                )

            ),
        );

        $i++;
        $page['website']['content'][$i]['tag'] = "BANNER";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "banner.template";
        $page['website']['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "text",
                "value" => "Apa yang kamu butuhkan"
            ),
            array(
                "tag" => 'SUBTITLE',
                "refer" => "text",
                "value" => ""
            ),
        );

        $i++;
        $page['website']['content'][$i]['tag'] = "BANNER-DETAIL";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "banner_detail.template";
        $page['website']['content'][$i]['template_array'] = array(
            array(
                "tag" => 'ORGANISASI-TITLE',
                "refer" => "text",
                "value" => "Be3 Corporation"
            ),
            array(
                "tag" => 'ORGANISASI-CONTENT',
                "refer" => "text",
                "value" => "Be3 Coorporation adalah sebuah startup yang dirancang untuk menyediakan jasa jasa sebagai solusi permasalahan anda"
            ),
        );

        $i++;
        $page['website']['content'][$i]['tag'] = "EXPLORE-SECTION";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "explore_section.template";
        $page['website']['content'][$i]['template_array'] = array(
            array(
                "tag" => 'SECTION-TITLE',
                "refer" => "text",
                "value" => "Jasa & Layanan"
            ),
            array(
                "tag" => 'SECTION-SUBTITLE',
                "refer" => "text",
                "value" => "Pilih Apa yang kamu butuhkan"
            ),
            array(
                "tag" => 'NAVPANE',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Kategori",
                "template_name" => "topiclisting",
                "template_file" => "nav_item.template",
                "array" => array(
                    "IDNAV" => array("refer" => "database", "row" => "kode_kategori"),
                    "CLASS-ACTIVE" => array("refer" => "if_first", "text" => "active"),
                    "ARIA-SELECTED" => array("refer" => "if_first_and_not_first", "true" => "true", "false" => "false"),
                    "NAV-TITLE" => array("refer" => "database", "row" => "nama_kategori_costum"),
                )
            ),
            array(
                "tag" => 'TAB-PANE',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Kategori",
                "template_name" => "topiclisting",
                "template_file" => "tab_pane.template",
                "array" => array(
                    "IDNAV" => array("refer" => "database", "row" => "kode_kategori"),
                    "CLASS-ACTIVE" => array("refer" => "if_first", "text" => "show active"),
                    "CONTENT-TAB-PANE" => array(
                        "refer" => "database_list",
                        "database_refer" => "-1",
                        "database" => array(
                            "utama" => "website__topic__list",
                            "primary_key" => null,
                            "select_raw" => "*,website__topic__list.id as primary_key,(case 
																when website__topic__list.berdasarkan_list='kastore' then (select nama_produk as nama_topic from store__produk)
																when website__topic__list.berdasarkan_list='katin' then (select nama_barang as nama_topic from ltw_inventaris__asset__list) end) as nama_topic",


                            "join" => array(
                                array("website__topic__kategori", "website__topic__kategori.{IDTABLE}website__topic__kategori{/IDTABLE}", "{IDPRIMARY}kategori_topic{/IDPRIMARY}"),



                            ),
                            "order" => array(
                                array("urutan", "asc"),
                                array("urutan_topic", "asc")
                            ),
                            "where_get_array" => array(
                                array("row" => "{IDPRIMARY}list_topic{/IDPRIMARY}", "array_row" => "database_list_template", "get_row" => "primary_key"),
                            )
                        ),
                        "template_name" => "topiclisting",
                        "template_file" => "content_tab_pane.template",
                        "array" => array(
                            "COL-ROW" => array("refer" => "text", "text" => "col-lg-4 col-md-6 col-12 mb-4 mb-lg-3"),
                            "LINK" => array("refer" => "link", "apps" => "Website", "page_view" => "topic__detail", "type" => "view_website", "id" => "-1"),
                            "TITLE-TAB-PANE" => array("refer" => "database", "row" => "nama_kategori_costum"),
                            "DESKRIPSI-SINGKAT-TAB-PANE" => array("refer" => "database", "row" => "deskripsi_singkat_topic")
                        )

                    ),
                )
            ),
        );

        $i++;
        $page['website']['content'][$i]['tag'] = "TIMELINE-SECTION";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "timeline_section.template";
        $page['website']['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "text",
                "value" => "Kenapa Harus Memilih Kami"
            ),
            array(
                "tag" => 'SECTION-SUBTITLE',
                "refer" => "text",
                "value" => "Pilih Apa yang kamu butuhkan"
            ),
            array(
                "tag" => 'LIST',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Topic Timeline",
                "template_name" => "topiclisting",
                "template_file" => "timeline_detail.template",
                "array" => array(
                    "JUDUL" => array("refer" => "database", "row" => "judul"),
                    "DESKRIPSI" => array("refer" => "database", "row" => "deskripsi"),
                )
            ),
        );

        $i++;
        $page['website']['content'][$i]['tag'] = "FAQ-SECTION";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "faq_section.template";
        $page['website']['content'][$i]['template_array'] = array(

            array(
                "tag" => 'LIST',
                "refer" => "database_list",
                "source_list" => "template",
                "database_refer" => "Topic FAQ",
                "template_name" => "topiclisting",
                "template_file" => "faq_detail.template",
                "array" => array(
                    "QUESTION" => array("refer" => "database", "row" => "question"),
                    "ANSWER" => array("refer" => "database", "row" => "answer"),
                    "NO" => array("refer" => "no"),
                )
            ),
        );


        $i++;
        $page['website']['content'][$i]['tag'] = "CONTACT-SECTION";
        $page['website']['content'][$i]['content_source'] = "template";
        $page['website']['content'][$i]['template_name'] = "topiclisting";
        $page['website']['content'][$i]['template_file'] = "CONTACT_section.template";

        $page['config']['database']['Kategori']['utama'] = 'website__topic__kategori';
        $page['config']['database']['Kategori']['primary_key'] = null;
        $page['config']['database']['Kategori']['join'][] = array('webmaster__inventaris__master__kategori', 'website__topic__kategori.id_kategori', 'webmaster__inventaris__master__kategori.id', 'left');;
        $page['config']['database']['Kategori']['order'][] = array("urutan", "asc");

        $page['config']['database']['Topic Timeline']['utama'] = 'website__topic__timeline';
        $page['config']['database']['Topic Timeline']['primary_key'] = null;

        $page['config']['database']['Topic FAQ']['utama'] = 'website__topic__faq';
        $page['config']['database']['Topic FAQ']['primary_key'] = null;

        $page['config']['database']['Header']['utama'] = 'website__master__header';
        $page['config']['database']['Header']['primary_key'] = null;
        $page['config']['database']['Header']['where'][] = array("kategori_header", '=', "'1'");

        $page['config']['database']['Kategori & Topic']['utama'] = 'website__topic__list';
        $page['config']['database']['Kategori & Topic']['primary_key'] = null;
        $page['config']['database']['Kategori & Topic']['join'][] = array("website__topic__kategori", "website__topic__kategori.{IDTABLE}website__topic__kategori{/IDTABLE}", "{IDPRIMARY}kategori_topic{/IDPRIMARY}", 'left');;
        $page['config']['database']['Kategori & Topic']['order'][] = array("urutan", "asc");
        $page['config']['database']['Kategori & Topic']['order'][] = array("urutan_topic", "asc");
        $page['panel'] = 'website';
        return $page;
    }


    public static function topic__timeline()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Judul", "judul", "text"),
            array("Deskripsi", "deskripsi", "text"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function topic__faq()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Question", "question", "text"),
            array("Answer", "answer", "text"),
            array("Urutan", "urutan", "text"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function topic__menu_produk()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Nama Menu", "nama_menu", "text"),
            array("Topic", "topic_seq", "select"),
            array("Harga sesuai tingkat", "harga_sesuai_tingkat", "select-manual"),
            array("Tingkat", "tingkat_seq", "select"),
            array("Harga Costum", "harga_costum", "number"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function topic__list()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Kategori List", "kategori_topic", "select", array('website__topic__kategori', "id", 'nama_kategori_costum', null), null),
            array("Berdasarkan", "berdasarkan_list", "select-manual", array('costum' => 'Costum', 'katin' => 'Asset Inventaris', 'kastore' => 'Produk Store'), null),
            ///array("List","list_topic","select",array('ltw_inventaris__asset__list',null,'nama_barang','lk'), null),
            array("List", "list_topic", "select", array('store__produk', null, 'nama_produk', null, 'lksp'), null),

            array("Nama Topic (Costum)", "nama_topic_costum", "text"),
            array("urutan", "urutan_topic", "numeric"),
            array("Deskripsi Topic", "deskripsi_topic", "textarea"),
            array("Deskripsi Singkat Topic", "deskripsi_singkat_topic", "textarea"),

        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;
        $page['crud']['select_database_costum']['kategori_topic']['join'][] = array('webmaster__inventaris__master__kategori', 'website__topic__kategori.id_kategori', 'webmaster__inventaris__master__kategori.id', 'left');
        $page['crud']['select_database_costum']['list_store']['join'][] = array('ltw_inventaris__asset__list as lksp', 'id_store__produk', 'lksp.id', 'left');

        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array(
            array('webmaster__inventaris__master__kategori', 'website__topic__kategori.id_kategori', 'webmaster__inventaris__master__kategori.id'),
            array('ltw_inventaris__asset__list as lk', 'id_list_topic', 'lk.id', 'left'),
            array('store__produk as lksp', 'id_list_topic', 'lksp.id', 'left')
        );
        $page['database']['where'] = array();
        $page['database']['order'] = array("urutan_topic");
        return $page;
    }
    public static function topic__kategori()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(

            array("Berdasarkan", "berdasarkan", "select-manual", array('costum' => 'Costum', 'katin' => 'Berdasarkan Kategori Inventaris', 'kastore' => 'Berdasarkan Store'), null),
            array("Kategori", "kategori", "select", array('webmaster__inventaris__master__kategori', null, 'nama_kategori'), null),
            array("Nama Kategori (costum)", "nama_kategori_costum", "text"),
            array("Urutan", "urutan", "number"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
    public static function topic__organisasi()
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['layout_pdf'] = array('a4', 'portait');

        $database_utama = "website__" . __FUNCTION__;
        $primary_key = null;

        $array = array(
            array("Nama Organisasi", "nama_organisasi", "text"),
            array("Deskripsi singkat", "deskripsi_singkat", "textarea"),
            array("Deskripsi", "deskripsi", "textarea"),
        );
        $search = array();

        $page['crud']['array'] = $array;
        $page['crud']['search'] = $search;


        $page['panel'] = "website";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");;
        $page['database']['join'] = array();
        $page['database']['where'] = array();
        return $page;
    }
}
