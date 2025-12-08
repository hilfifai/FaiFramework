<?php

class CardContent
{

    public static function main($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {

        if ($card['listing_type'] == "listingmenu") {
            return CardContent::main_listing_menu($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        } else if ($card['listing_type'] == "profile-menu") {
            return CardContent::main_profil_menu($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        } else if ($card['listing_type'] == "backend") {
            return CardContent::main_listing_menu($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        } else {
            return CardContent::main_content_card($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        }
    }
    public static function list_menu($page, $type, $id, $fai, $card)
    {

        $filename = isset($page['load']['card_template']['list_menu']['template_file']) ?
            ($page['load']['card_template']['list_menu']['template_file'] ? $page['load']['card_template']['list_menu']['template_file'] : '_CardListingMenu.template')
            : '_CardListingMenu.template';
        $template_name = isset($page['load']['card_template']['list_menu']['template_name']) ?
            $page['load']['card_template']['list_menu']['template_name'] : 'soft-ui';
        $content_template = file_get_contents(Partial::urlframework_pages("_template/" . $template_name, $filename . '.php'));
        $content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
        $array_template = array(
            "MENU" => 'menu',
            "MENU-SCREENA" => 'menu_screen_a',
            "MENU-SCREENB" => 'menu_screen_b',
        );

        $CARDCONTENTFUNC = new CardContentSection();
        foreach ($array_template as $key => $value) {
            if (strpos($content_template, "<$key></$key>"))
                $content_template = str_replace("<$key></$key>", $CARDCONTENTFUNC->$value($page, $type, $id, $card, $template_name), $content_template);
        }

        return $content_template;
    }

    public static function array_template()
    {
        $array_template = array(
            "PAGE-TITLE" => 'content_page_title',
            "PAGE-SUBTITLE" => 'content_page_subtitle',
            "PROFILE-TITLE" => 'content_profile_title',
            "PROFILE-SUBTITLE" => 'content_profile_subtitle',
            "LIST-MENU" => 'content_list_menu',
            "PRELIST" => 'content_prelist',
            "FILTER" => 'content_filter',
            "MAINLOADDATA" => 'content_main_load_data_on_listing_menu',
            "SEARCH-FORM" => 'content_search_form',
            "FILTER-SIDEBAR" => 'content_filter_on_filter',

            "SORT-BY" => 'content_sort_by_on_filter',
            "BUTTON-FILTER" => 'content_button_filter_on_filter',
            "BUTTON-SEARCH" => 'content_button_search_on_filter',
        );

        return $array_template;
    }

    public static function main_listing_menu($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {
        ob_start();
        $visible = false;

        $page_database = $page['load']['page_database'];

        $page['load']['card']['page_database'] = $page_database;
        $page['load']['card']['nama_type'] = $nama_type;

        $page['load']['card']['this_card'] = $this_card;
        $page['load']['card']['array'] = $array;

        if ($page_database) {
            if (isset($page['row_section'][$page_database]))
                $database = $page['row_section'][$page_database];
            else
                $database = "";
        } else
            $database = "";


        $key = $page['load']['page_section_menu'];

        $filename = isset($page['load']['card_template']['main_listing']['template_file']) ?
            ($page['load']['card_template']['main_listing']['template_file'] ? $page['load']['card_template']['main_listing']['template_file'] : '_CardMainListingMenu.template')
            : '_CardMainListingMenu.template';
        $template_name = isset($page['load']['card_template']['main_listing']['template_name']) ?
            $page['load']['card_template']['main_listing']['template_name'] : 'soft_ui';
        $array_template = [];

        $object = new TemplateContent();

        if (method_exists($object, $template_name)) {
            // echo "Method abc() ada dalam class.";


            $array_template[] = [$template_name, $filename];
            $content_template = TemplateContent::parse_template($page, $array_template, 0);
        } else {
            $content_template = file_get_contents(Partial::urlframework_pages("_template/" . $template_name, $filename . '.php'));
            $content_template = file_get_contents(Partial::urlframework_pages("_template/soft-ui", '_CardMainListingMenu.template.php'));

        }
        $content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template) . "";
        $array_template = CardContent::array_template();

        $CARDCONTENTFUNC = new CardContentSection();
        foreach ($array_template as $key => $value) {
            if (strpos($content_template, "<$key></$key>"))
                $content_template = str_ireplace("<$key></$key>", $CARDCONTENTFUNC->$value($page, $type, $id, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database, $visible), $content_template);
        }

        $content_template .= '    <input id="total_record" value="' . ((gettype($database) == 'array') ? ($database['num_rows']) : -1) . '" type="hidden">
        <input id="limit_page" value="' . (isset($page['limit_page']) ? $page['limit_page'] : 12) . '" type="hidden">
        
        <script>
        	var number_page = 1;
        	var view = "ViewVertical";
        	var numbeArrayEdit = 0;
        </script>';
        // if (!$visible) {
        $content_template .= '
        <script>
            $(document).ready(function() {
                load_data_menu("' . $page['load']['page_section_menu'] . '","' . $page['view_layout_number'] . '");
            });
        		
        	</script>';
        // }

        return $content_template;
    }
    public static function main_profil_menu($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {

        $visible = false;
        $page_database = $page['load']['page_database'];
        $page['load']['card']['page_database'] = $page_database;
        $page['load']['card']['nama_type'] = $nama_type;
        $page['load']['card']['this_card'] = $this_card;
        $page['load']['card']['array'] = $array;

        if ($page_database) {
            if (isset($page['row_section'][$page_database]))
                $database = $page['row_section'][$page_database];
            else
                $database = "";
        } else
            $database = "";


        $key = $page['load']['page_section_menu'];

        $filename = isset($page['load']['card_template']['main_profile']['template_file']) ?
            ($page['load']['card_template']['main_profile']['template_file'] ? $page['load']['card_template']['main_profile']['template_file'] : '_CardProfileMenu.template')
            : '_CardProfileMenu.template';
        $template_name = isset($page['load']['card_template']['main_listing']['template_name']) ?
            $page['load']['card_template']['main_listing']['template_name'] : 'soft-ui';
        $content_template = file_get_contents(Partial::urlframework($template_name, $filename . '.php'));
        // echo '/../_template/'.$template_name.'/'.$filename.'.php';
        $page['row_section']['profil'] = $database = Database::database_coverter($page, $card['profil']['database'], array(), 'all');
        $content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
        $array_template = CardContent::array_template();

        $CARDCONTENTFUNC = new CardContentSection();
        foreach ($array_template as $key => $value) {
            if (strpos($content_template, "<$key></$key>"))
                $content_template = str_ireplace("<$key></$key>", $CARDCONTENTFUNC->$value($page, $type, $id, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database, $visible), $content_template);
        }

        $content_template .= '  
         <input id="total_record" value="' . ($database ? ($database['num_rows']) : -1) . '" type="hidden">
        <input id="limit_page" value="' . $page['limit_page'] . '" type="hidden">

        <script>
            var number_page = 1;
            var view = "ViewHorizontal";
            var numbeArrayEdit = 0;
        </script>';
        if (!$visible) {
            $content_template .= '  
            <script>
                load_data_menu("' . $page['load']['page_section_menu'] . '");
            </script>';
        }
        return $content_template;
    }
    public static function main_content_card($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {
        return CardContent::main_load_data($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
    }
    public static function main_load_data($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {
        $key = $page['load']['page_section_menu'];
        $content = "";


        if ($nama_type == 'crud' or $nama_type == 'crud-table') {
            $page['section'] = 'card';
            $page_database = $page['load']['page_database'];
            $array = Packages::converting_array_field($page, $array, null);
            $_POST['section'] = 'card';
            $_POST['page_database'] = $page_database;
            $_POST['array'] = json_encode($array);
            $nama_array;

            if (isset($this_card['crud']))
                $page['crud'] = $this_card['crud'];
            $page['crud']['list_table_view_layout'] = true;

            $page['crud']['search'] = array();
            $page['crud']['array'] = $array;
            $page['database'] = $page['config']['database'][$page_database];
            $page['title'] = $page['load']['menu'];
            ;
            $page['route'] = $page['load']['route_page'];
            $page['id'] = -1;
            $page = Packages::initialize($page);
            $content .= "<div id='faicontentcrud'>";
            if ($nama_type == 'crud-table') {


                if (isset($page['crud']['list_table_view_layout'])) {
                    if (!Partial::input('type_crud')) {
                        $page['crud']['view'] = 'list';
                        $_POST['type_crud'] = 'list';
                    }
                    $page['crud']['view'] = Partial::input('type_crud');
                    $content .= $fai->page($page, Partial::input('type_crud'), $page['load']['id']);
                } else {
                    $page['crud']['list_table_view_layout'] = true;
                    $page['crud']['view'] = 'list';
                    $content .= $fai->page($page, 'list', $page['load']['id']);
                }
            } else
                $content .= $fai->page($page, 'tambah', $page['load']['id']);
            $content .= '</div>';
            $content .= $fai->view('_template/dist/js.php', $page, array("array" => $array));
        } else if ($nama_type == 'card-nav') {
            $page['load']['nav'];
            if ($page['load']['nav'] == -1) {
                $page['load']['nav'] = $card[$card['menu'][$key][2]]['defaultNav'];
            }

            $cardNav = $card[$card['menu'][$key][2]]['cardNav'][$page['load']['nav']];

            if ($cardNav['mode'] == 'card-layout') {
                $array = $cardNav['array'];
                $content .= CardFunc::card_layout($page, $fai, $array);
            } else if ($cardNav['mode'] == 'card-listing') {
                $array = $cardNav['array'];

                $content .= CardFunc::card_listing($page, $fai, $cardNav, $cardNav['database_refer'], $array, $this_card);
            }
        } else if ($nama_type == 'card-layout') {
            $content .= '<div class="row">';
            $content .= CardFunc::card_layout($page, $fai, $array);
            $content .= '</div>';
        } else if ($nama_type == 'card-listing') {

            $content .= CardFunc::card_listing($page, $fai, $card, $page['load']['page_database'], $array, $this_card);
        }
        return $content;
    }

    public static function filter__($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card)
    {
        $key = $page['load']['page_section_menu'];

        $filename = isset($page['load']['card_template']['filter']['template_file']) ?
            ($page['load']['card_template']['filter']['template_file'] ? $page['load']['card_template']['filter']['template_file'] : '_CardFilter.template')
            : '_CardFilter.template';

        $template_name = isset($page['load']['card_template']['filter']['template_name']) ?
            $page['load']['card_template']['filter']['template_name'] : 'soft-ui';

        $content_template = file_get_contents($fai->urlframework($template_name, $filename . '.php'));

        $content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
        $array_template = array(
            "TITLE" => 'content_title_nav',
            "SUBTITLE" => 'content_subtitle_nav',
            "CARD-NAV" => 'content_card_nav',
            "ULLI-BUTTON" => 'content_ulli_button',
            "FILTER" => 'content_filter_on_filter',
            "SORT-BY" => 'content_sort_by_on_filter',
            "BUTTON-FILTER" => 'content_button_filter_on_filter',
            "BUTTON-SEARCH" => 'content_button_search_on_filter',
        );

        $CARDCONTENTFUNC = new CardContentSection();
        foreach ($array_template as $key => $value) {
            if (strpos($content_template, "<$key></$key>"))
                $content_template = str_replace("<$key></$key>", $CARDCONTENTFUNC->$value($page, $type, $id, $card, $template_name, $this_card, $nama_type), $content_template);
        }
        return $content_template;
    }
}
class CardFunc
{
    public static function card_layout($page, $fai, $array)
    {
        $return = "";
        for ($i = 0; $i < count($array); $i++) {

            if ($array[$i]['cardType'] == 'manual') {
            } else if ($array[$i]['cardType'] == 'template') {
                $cardContent = $array[$i]['cardContent'];
                $content_template = file_get_contents($fai->urlframework($cardContent['template_form'], $cardContent['template_name'] . '.php'));
                $content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
                $return .= '<div class="' . $cardContent['row'] . '">';
                for ($j = 0; $j < count($cardContent['content']); $j++) {
                    foreach ($cardContent['content'][$j] as $tag => $valueCard) {
                        $content = '';
                        if ($valueCard['dataType'] == 'text') {
                            $content = $valueCard['text'];
                        } else if ($valueCard['dataType'] == 'database') {
                            $fai->connection($page);
                            if (!isset($page['row_section'][$valueCard['database_refer']])) {

                                $page['row_section'][$valueCard['database_refer']] = $fai->database_coverter($page, $page['config']['database'][$valueCard['database_refer']], null, 'exec');
                            }
                            $row_selection = $valueCard['database_row'];
                            $content = $page['row_section'][$valueCard['database_refer']][0]->$row_selection;
                        }

                        $content_template = str_ireplace("<" . strtoupper($tag) . "></" . strtoupper($tag) . ">", $content, $content_template);
                    }
                }
                $return .= $content_template;
                $return .= '</div>';
            }
        }
        return $return;
    }
    public static function card_listing($page, $fai, $card, $database_refer, $array, $this_card)
    {
        $result_content = "";
        $view_default = $card['view_default'];



        $key = $page['load']['page_section_menu'];
        if ($key == -1 or !$key) {
            $key = $card['default_id'];
        }
        $content_card = '';
        $card_array = ($card['menu'][$key][2]);
        $func = $page['template'];
        $template_content = TemplateContent::$func($page);
        $return_content_template = [];
        if (isset($template_content[$view_default])) {
            $return_content_template = $template_content[$view_default];

        }

        // echo '<textarea>' . $view_default.  . '</textarea>';  
        if ($view_default == 'ViewHorizontal') {
            $result_content .= '<div>';
            if (isset($card[$card_array]['ViewHorizontal']['template_file'])) {


                $content_card = file_get_contents($fai->urlframework_pages("_template", $card[$card_array]['ViewHorizontal']['template_name'] . '/' . $card[$card_array]['ViewHorizontal']['template_file'] . '.php'));
            } else {

                $content_card = file_get_contents($fai->urlframework_pages("card", 'LoadDataViewHorizontal.php'));
            }
        } else if ($view_default == 'ViewListTables') {
            $result_content .= '<div class="card">';
            if (isset($card[$card_array]['ViewVertical']['template_file'])) {

                $content_card = file_get_contents($fai->urlframework_pages("_template", $card[$card_array]['ViewListTables']['template_name'] . '/' . $card[$card_array]['ViewListTables']['template_file'] . '.php'));
            } else
                $content_card = file_get_contents($fai->urlframework_pages($page['template'], 'LoadDataViewTables.php'));
        } else if ($view_default == 'ViewVertical') {
            if (isset($return_content_template['content']['row_start'])) {
                $result_content .= $return_content_template['content']['row_start'];
            } else
                $result_content .= '<div class="row">';



            if (isset($card[$card_array]['ViewVertical']['template_file'])) {
                // echo 'masuk 1';
                $content_card = file_get_contents($fai->urlframework_pages("_template", $card[$card_array]['ViewVertical']['template_name'] . '/' . $card[$card_array]['ViewVertical']['template_file'] . '.php'));
            } else if (isset($this_card['ViewVertical'])) {
                $content_card = Partial::content_source($page, $card[$card_array]['ViewVertical']);
            } else {

                $content_card = file_get_contents($fai->urlframework_pages("card", 'LoadDataViewVertical.php'));
                // echo 'masuk 3';/
            }
        }
        // echo '<textarea>' . $view_default. $content_card . '</textarea>';  
        if (isset($return_content_template['content']['col_start'])) {
            $content_card = $return_content_template['content']['col_start'] . $content_card;
        }
        if (isset($return_content_template['content']['col_end'])) {
            $content_card .= $return_content_template['content']['col_end'];
        }



        $card_db = $page['config']['database'][$database_refer];
        $page['database_provider'] = isset($page['database_provider']) ? $page['database_provider'] : 'mysql';
        if ($page['database_provider'] == 'mysql') {
            $card_db['limit'] = (($fai->input('number_page', '_GET') * $page['limit_page']) - 1) . "," . $page['limit_page'];
        } else {
            $card_db['limit'] = $page['limit_page'] . " offset " . ((($fai->input('number_page', '_GET') - 1) * $page['limit_page']) > 0 ? (($fai->input('number_page', '_GET') - 1) * $page['limit_page']) : 0);
        }

        $order_by = "";

        $datafilter = $fai->input('datafilter');
        $where = [];
        if ($datafilter) {
            $list_filter = [];
            foreach ($this_card['filter'] as $key => $value) {
                $list_filter[$value[1]] = $key;
            }
            for ($ii = 0; $ii < count($datafilter); $ii++) {
                if (isset($list_filter[$datafilter[$ii]['name']])) {

                    $iii = $list_filter[$datafilter[$ii]['name']];
                    if (strpos($iii, '_dari')) {

                        $array_filter = $this_card['filter'][str_replace("_dari", '', $iii)];
                        if ($datafilter[$ii]['value'])
                            $card_db['where'][] = array($array_filter[4], '>=', $datafilter[$ii]['value']);
                    } elseif (strpos($iii, '_sampai')) {
                        $array_filter = $this_card['filter'][str_replace("_sampai", '', $iii)];
                        if ($datafilter[$ii]['value'])
                            $card_db['where'][] = array($array_filter[4], '<=', $datafilter[$ii]['value']);
                    } else {
                        // if (isset($this_card['filter'][$iii])) {

                        $array_filter = $this_card['filter'][$iii];

                        if ($datafilter[$ii]['value']) {

                            $where[] = ($array_filter['field_database'] . '=' . $datafilter[$ii]['value']);
                        }
                        // }
                    }
                }
            }
        }
        if (count($where))
            $card_db['where'][] = array("", '', "(" . implode(' OR ', $where) . ")");
        if (!isset($page['load']['workspace']['id_single_toko'])) {
            if (($fai->input('frameworksubdomain'))) {

                $domain = $fai->input('frameworksubdomain');
            } else
                $domain = $_SERVER['HTTP_HOST'];
            $ci = &get_instance();
            // $db_get = DB::get_clear();
            $page_temp = $fai->LoadApps($page, $domain, ($ci->uri->segment(2) ? $ci->uri->segment(2) : -1), 'page');
            $page = array_merge($page, $page_temp);
            // DB::set_db($db_get);
        }

        if ($fai->input('dataSortBy')) {
            $array_sort = $this_card['sort_by'][$fai->input('dataSortBy')];

            $card_db["order_by_filter"] = ($array_sort);
        }
        if ($fai->input('datasearch')) {

            $array_search = isset($this_card['search_field']) ? $this_card['search_field'] : [];
            $where_search = [];
            for ($s = 0; $s < count($array_search); $s++) {
                $where_search[] = "upper(" . $array_search[$s] . ")::text like '%" . strtoupper($fai->input('datasearch')) . "%'";
            }
            if (count($where_search))
                $card_db["where"][] = ["(" . implode(' OR ', $where_search) . ")", "", ""];
        }

        $data = Database::database_coverter($page, $card_db, $array, 'all');

        $content_card_temp = $content_card;
        if ($data['num_rows']) {
            foreach ($data['row'] as $row) {
                $page['row']['card'] = $row;
                $content_card = $content_card_temp;
                $content_card = str_ireplace("<CLASS-ROW></CLASS-ROW>", isset($card['row']) ? $card['row'] : 'col-xl-4 col-md-6 mb-xl-0 mb-4', $content_card);
                if ($array) {
                    for ($i = 0; $i < count($array); $i++) {
                        $tag = $array[$i][0];
                        if (($array[$i][0]) != 'extend') {

                            $content = Content::parse_card($page, $array[$i], $row, $fai);
                            $content_card = str_ireplace("<$tag></$tag>", $content, $content_card);
                        } else


                            if (($array[$i][0]) == 'extend') {

                                $extend_to = "" . $array[$i][2];
                                $extend_to = "parse_" . $array[$i][2];
                                $content = $extend_to($page, $array[$i][3], $row, $fai);
                                $content_card = str_ireplace("<" . strtoupper($array[$i][1]) . "></" . strtoupper($array[$i][1]) . ">", $content, $content_card);
                            }

                        // if (($array[$i][0]) == 'img') {

                        // } else if (($array[$i][0]) == 'title') {
                        //     $content_card = str_ireplace("<CARD-TITLE></CARD-TITLE>", $content, $content_card);
                        // } else if (($array[$i][0]) == 'subtitle') {
                        //     $content_card = str_ireplace("<CARD-SUBTITLE></CARD-SUBTITLE>", $content, $content_card);
                        // } else  else if (($array[$i][0]) == 'deskripsi') {
                        //     $content_card = str_ireplace("<CARD-DESKRIPSI></CARD-DESKRIPSI>", $content, $content_card);
                        // } else 
                        // else {
                        //     $content_card = str_ireplace("<" . strtoupper($array[$i][0]) . "></" . strtoupper($array[$i][0]) . ">", $content, $content_card);
                        // }
                    }
                    $result_content .= $content_card;
                }
            }
        } else {
            $result_content .= isset($page['list_empty']) ? $page['list_empty'] : 'Data Tidak ada data';
        }
        $result_content .= '</div>';

        //ViewHorizontal//ViewVertical//ViewListTables

        if (!Partial::input('i_card')) {
            $_GET['i_card'] = 0;
        }
        $result_content .= '<div  style="display: grid;text-align: center;justify-content: center;">' . $fai->paginate_fai_content($fai->input('jumlah'), $fai->input('number_page'), $data['num_rows'], $page['load']['id'], Partial::input('i_card')) . '</div>';
        return $result_content;
    }
}

class CardContentSection
{
    function content_UR_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        @curl_close($ch);
        return $status;
    }
    function content_menu($page, $card, $template_name, $extend = '')
    {
        $return_template = "";
        $fai = new MainFaiFramework();
        $filename = isset($page['load']['card_template']['menu']['template_file']) ?
            ($page['load']['card_template']['menu']['template_file'] ? $page['load']['card_template']['menu']['template_file'] : '_CardMenu|extend|.template')
            : '_CardMenu|extend|.template';
        $filename = str_replace('|extend|', $extend, $filename);
        $content_template = file_get_contents($fai->urlframework($template_name, $filename . '.php'));


        foreach ($card['menu'] as $title => $detail) {
            $content_template_temp = $content_template;
            $content_template = str_replace("<TITTLE></TITTLE>", $title, $content_template);
            $content_template = str_replace("<ACTIVE></ACTIVE>", ($page['load']['menu'] == $title ? 'active' : ''), $content_template);
            $content_template = str_replace("<LINK></LINK>", (Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], $page['load']['type'], $page['load']['id'], $title])), $content_template);

            $return_template .= $content_template;

            $content_template = $content_template_temp;
        }



        return $return_template;
    }
    function content_menu_screen_a($page, $card, $template_name)
    {
        $this->menu($page, $card, $template_name, 'ScreenA');
    }
    function content_menu_screen_b($page, $card, $template_name)
    {
        $this->menu($page, $card, $template_name, 'ScreenB');
    }
    function content_list_menu($page, $type, $id, $card, $template_name)
    {

        $fai = new MainFaiFramework();

        return CardContent::list_menu($page, $type, $id, $fai, $card);
    }
    function content_filter($page, $type, $id, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database)
    {
        $fai = new MainFaiFramework();

        // ob_start();

        // $fai->view('card/_Filter.blade.php', $page, array('card' => $card, 'nama_type' => $nama_type, 'nama_array' => $nama_array, 'array' => $array, 'page_database' => $page_database, 'this_card' => $this_card));

        return CardContent::filter__($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
    }
    function content_main_load_data_on_listing_menu($page, $type, $id, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database, $visible)
    {
        $fai = new MainFaiFramework();
        if ($visible) {

            return CardContent::main_load_data($page, $fai, $card, $type, $id, $nama_type, $nama_array, $array, $this_card);
        } else
            return '';
    }
    function content_search_form($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {
        return '
        <style>
.card_search_form {
        margin-bottom: 45px;
    }

    .card_search_form form {
        position: relative;
    }

    .card_search_form form input {
        width: 100%;
        font-size: 15px;
        color: #b7b7b7;
        padding-left: 20px;
        border: 1px solid #e5e5e5;
        height: 42px;
    }

    .card_search_form form input::-webkit-input-placeholder {
        color: #b7b7b7;
    }

    .card_search_form form input::-moz-placeholder {
        color: #b7b7b7;
    }

    .card_search_form form input:-ms-input-placeholder {
        color: #b7b7b7;
    }

    .card_search_form form input::-ms-input-placeholder {
        color: #b7b7b7;
    }

    .card_search_form form input::placeholder {
        color: #b7b7b7;
    }

    .card_search_form form button {
        color: #b7b7b7;
        font-size: 15px;
        border: none;
        background: transparent;
        position: absolute;
        right: 0;
        padding: 0 15px;
        top: 0;
        height: 100%;
    }
        </style>
        <div class="card_search_form">
                        
                            <input type="text" id="searchID-' . $page['view_layout_number'] . '" placeholder="Search..." >
                            <button type="button"><span class="icon_search" onclick="load_data_menu(\'' . $page['load']['page_section_menu'] . '\',' . $page['view_layout_number'] . ');"></span></button>
                       
                    </div>';
    }
    function content_sort_by_on_filter($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {
        $content = "";
        $nama_type;
        if ($nama_type == "card-listing") {
            if (isset($this_card['sort_by'])) {
                $content .= '<div class="" style="width: 200px;float: right;">

                
                <select class="form-control " name="sort_by" id="sortByListing" onchange="load_data_menu(\'' . $page['load']['page_section_menu'] . '\',' . $page['view_layout_number'] . ');">
                    <option value="">
                        - Sort By -
                    </option>
                ';
                foreach (($this_card['sort_by']) as $i => $value) {
                    $content .= '<option value="' . $i . '">
                            ' . $i . '</option>
                            ';
                }

                $content .= '

                </select>

            </div>';
            }
        }
        return $content;
    }
    function content_button_filter_on_filter($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {

        $content = "";
        if ($nama_type == "card-listing") {
            $content .= '<button class="btn btn-success" onclick="load_data()" type="button">Filter</button>';
        }
        return $content;
    }
    function content_button_search_on_filter($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {

        $content = "";
        if ($nama_type == "card-listing") {
            $content .= '<div class="input-group">
            <input type="text" class="form-control" placeholder="Type here" id="searchID-' . $page['view_layout_number'] . '">
            <BUTTON class="input-group-text text-body" onclick="load_data_menu(\'' . $page['load']['page_section_menu'] . '\',' . $page['view_layout_number'] . ');" type="button">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></i>
            </BUTTON>
        </div>';
        }
        return $content;
    }
    function content_filter_on_filter($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {

        $fai = new MainFaiFramework();
        $content = "";
        $all_filter = [];
        if ($nama_type == "card-listing") {

            if (isset($this_card['filter'])) {
                $content .= '<form id="filterform" action="#">';
                $page['crud'] = $this_card['crud'];
                $page['crud']['view'] = "tambah";
                $page['crud']['type'] = "tambah";

                // $page['crud']['prefix_name'] = "datafilter[";
                // $page['crud']['sufix_name'] = "]";
                $input_inline_temp = "";
                //onkeyup="load_data_menu(\'' . $page['load']['page_section_menu'] . '\',' . $page['view_layout_number'] . ');" 
                $input_inline_temp .= '
                        onchange="load_data_menu(\'' . $page['load']['page_section_menu'] . '\',' . $page['view_layout_number'] . ');"';


                $data = array();
                // $this_card['filter'] = Database::converting_array_field($page,$this_card['filter']);
                for ($i = 0; $i < count($this_card['filter']); $i++) {
                    $this_card['filter'][$i][1] = $i;
                    $field = $this_card['filter'][$i][1];
                    $all_filter[] = "filter_$field";
                    $input_inline = $input_inline_temp . " class='filter_$field'";
                    $page['crud']['input_inline'] = $input_inline;
                    ;
                    $content .= Content::parse_form($fai, $page, $this_card['filter'], $this_card['filter'][$i][2], $i, 0, $data, array("required" => "1"));
                }
                $content .= '</form>';
            }
        }
        $content .= "<script>
            $(document).ready(function() {
                ";
        foreach ($all_filter as $key => $value) {
            $content .= "  $('.$value').val();
                    ";
            $content .= "  $('.$value').prop('checked',false);
                    ";
            $content .= "  $('.$value').prop('selected',false);
                    ";
        }
        $content .= "  }); ";
        $content .= "</script>
        ";
        return $content;
    }
    function content_ulli_button($page, $type, $id, $card, $template_name, $this_card, $nama_type)
    {
        $content = "";
        if ($nama_type == "card-listing") {
            $content .= '
            <div class="col-md-4 col-auto ms-auto" style="display: flex;">
                    <div class=" navbar-collapse " id="navbar" style="display: grid;">

                        <ul class="navbar-nav  justify-content-md-end justify-content-md-start " style="flex-direction: row;">


                            <!-- <li class="nav-item px-3 ps-0 d-flex align-items-center">
                        <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="searchButton(this)" data-visible="false">
                            <span class="btn-inner--icon"><i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </i></span>
                        </button> -->
                            </li>
                            <!-- <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="filterButton(this)" data-visible="false">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5" />
                                    </svg></i></span>
                        </button>
                    </li> -->
                            <li class="nav-item px-3 d-flex align-items-center">
                                <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="changeView(\'ViewListTables\')">
                                    <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <rect x="3" y="4" width="18" height="8" rx="3" />
                                                <rect x="3" y="12" width="18" height="8" rx="3" />
                                                <line x1="7" y1="8" x2="7" y2="8.01" />
                                                <line x1="7" y1="16" x2="7" y2="16.01" />
                                            </svg></i></span>
                                </button>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <button class="btn btn-primary " style="padding: 0.5rem" type="button" onclick="changeView(\'ViewVertical\')">
                                    <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <rect x="4" y="4" width="16" height="6" rx="2" />
                                                <rect x="4" y="14" width="16" height="6" rx="2" />
                                            </svg></i></span>
                                </button>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="changeView(\'ViewHorizontal\')">
                                    <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <rect x="4" y="4" width="6" height="6" rx="1" />
                                                <rect x="14" y="4" width="6" height="6" rx="1" />
                                                <rect x="4" y="14" width="6" height="6" rx="1" />
                                                <rect x="14" y="14" width="6" height="6" rx="1" />
                                            </svg></i></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
    ';
        }
        return $content;
        ;
    }
    function content_page_title($page, $type, $id, $card, $template_name, $this_card)
    {
        if (isset($page['title'])) {
            return $page['title'];
        }
    }
    function content_page_subtitle($page, $type, $id, $card, $template_name, $this_card)
    {
        if (isset($page['subtitle'])) {
            return $page['subtitle'];
        }
    }
    function content_prelist($page, $type, $id, $card, $template_name, $this_card)
    {
        $fai = new MainFaiFramework();
        $return_template = "";
        if (isset($this_card['prelist'])) {
            for ($a = 0; $a < count($this_card['prelist']); $a++) {
                if ($this_card['prelist'][$a][0] == 'extend') {
                    $extend_to = "" . $this_card['prelist'][$a][1];
                    $extend_to = "parse_" . $this_card['prelist'][$a][1];
                    $return_template .= Content::$extend_to($page, $this_card['prelist'][$a][2], array(), $fai);
                }
            }
        }
        return $return_template;
    }
    function content_profile_title($page, $type, $id, $card, $template_name, $this_card)
    {

        $title = $card['profil']['array']['title'];
        $row = $title[1];
        return $title[0] . ' ' . $page['row_section']['profil']['row'][0]->$row . ' ' . $title[2];
    }
    function content_profile_subtitle($page, $type, $id, $card, $template_name, $this_card)
    {
        $title = $card['profil']['array']['subtitle'];
        $row = $title[1];
        return $title[0] . ' ' . $page['row_section']['profil']['row'][0]->$row . ' ' . $title[2];
    }
    function content_title_nav($page, $type, $id, $card, $template_name, $this_card)
    {
        if (isset($card['Title Nav'])) {
            return $card['Title Nav'];
        } else if (isset($this_card['title_nav'])) {
            return $this_card['title_nav'];
        } else {
            return ucwords($page['load']['apps']);
            ;
        }
    }
    function content_subtitle_nav($page, $type, $id, $card, $template_name, $this_card)
    {
        if (isset($this_card['subtitle_nav'])) {
            return $this_card['subtitle_nav'];
        } else {
            return (isset($page['load']['page_section_menu']) ? $page['load']['page_section_menu'] : '');
        }
    }
    function content_card_nav($page, $type, $id, $card, $template_name)
    {
        $key = $page['load']['page_section_menu'];
        $return_template = "";
        if($key==-1){
            $key= $card['default_id'];
        }
        if (isset($card[$card['menu'][$key][2]]['cardNav'])) {
            $filename = isset($page['load']['card_template']['cardulnav']['template_file']) ?
                ($page['load']['card_template']['cardulnav']['template_file'] ? $page['load']['card_template']['cardulnav']['template_file'] : '_CardUlNav.template')
                : '_CardUlNav.template';
            $li_filename = isset($page['load']['card_template']['cardullinav']['template_file']) ?
                ($page['load']['card_template']['cardullinav']['template_file'] ? $page['load']['card_template']['cardullinav']['template_file'] : '_CardUlLiNav.template')
                : '_CardUlLiNav.template';
            $fai = new MainFaiFramework();
            $content_template = file_get_contents($fai->urlframework($template_name, $filename . '.php'));
            $li_template = file_get_contents($fai->urlframework($template_name, $li_filename . '.php'));
            $content_li = "";
            foreach ($card[$card['menu'][$key][2]]['cardNav'] as $key_title => $value_array) {
                $visible = true;
                if (isset($card[$card['menu'][$key][2]]['cardNav'][$key_title]['visible'])) {
                    $visible = $card[$card['menu'][$key][2]]['cardNav'][$key_title]['visible'];
                }
                if ($visible) {
                    $content_template_temp = $content_template;
                    $li_template_temp = $li_template;
                    $li_template = str_ireplace("?LINK?", Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], $page['load']['type'], -1, $page['load']['page_section_menu'], $key_title]), $li_template);
                    $li_template = str_ireplace("<TITLE></TITLE>", $key_title, $li_template);
                    $content_li .= $li_template;
                    $li_template = $li_template_temp;
                }
            }
            $content_template = str_ireplace("<LI-NAV></LI-NAV>", $content_li, $content_template);
            $return_template .= $content_template;
            $content_template = $content_template_temp;
        }
        return $return_template;
    }
    function menu($page, $type, $id, $card, $template_name, $extend = '')
    {
        $return_template = "";
        $fai = new MainFaiFramework();
        $filename = isset($page['load']['card_template']['menu']['template_file']) ?
            ($page['load']['card_template']['menu']['template_file'] ? $page['load']['card_template']['menu']['template_file'] : '_CardMenu|extend|.template')
            : '_CardMenu|extend|.template';
        $filename = str_replace('|extend|', $extend, $filename);
        $content_template = file_get_contents($fai->urlframework($template_name, $filename . '.php'));


        foreach ($card['menu'] as $title => $detail) {
            $content_template_temp = $content_template;
            $content_template = str_replace("<TITTLE></TITTLE>", $title, $content_template);
            $content_template = str_replace("<ACTIVE></ACTIVE>", ($page['load']['menu'] == $title ? 'active' : ''), $content_template);
            $content_template = str_replace("<LINK></LINK>", (Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], $page['load']['type'], $page['load']['id'], $title])), $content_template);

            $return_template .= $content_template;

            $content_template = $content_template_temp;
        }



        return $return_template;
    }
    function menu_screen_a($page, $type, $id, $card, $template_name)
    {
        $this->menu($page, $type, $id, $card, $template_name, 'ScreenA');
    }
    function menu_screen_b($page, $type, $id, $card, $template_name)
    {
        $this->menu($page, $type, $id, $card, $template_name, 'ScreenB');
    }
}
