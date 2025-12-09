<?php

class CARDCONTENTFUNC
{
    function UR_exists($url)
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
    function menu($page, $card, $template_name, $extend = '')
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
    function menu_screen_a($page, $card, $template_name)
    {
        $this->menu($page, $card, $template_name, 'ScreenA');
    }
    function menu_screen_b($page, $card, $template_name)
    {
        $this->menu($page, $card, $template_name, 'ScreenB');
    }
    function list_menu($page, $card, $template_name)
    {

        $fai = new MainFaiFramework();
        ob_start();
        $fai->view('card/_list_menu.blade.php', $page, array('card' => $card));
        return ob_get_clean();
    }
    function filter($page, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database)
    {
        $fai = new MainFaiFramework();

        ob_start();

        $fai->view('card/_Filter.blade.php', $page, array('card' => $card, 'nama_type' => $nama_type, 'nama_array' => $nama_array, 'array' => $array, 'page_database' => $page_database, 'this_card' => $this_card));

        return ob_get_clean();
    }
    function main_load_data_on_listing_menu($page, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database, $visible)
    {
        $fai = new MainFaiFramework();
        if ($visible) {
            
         return CardContent::main_load_data($page,$fai,$card,$type,$id,$nama_type,$nama_array,$array,$this_card);
           
        }
        return '';
    }
    function sort_by_on_filter($page, $card, $template_name, $this_card, $nama_type)
    {
        ob_start();
        if ($nama_type == "card-listing") {
            if (isset($this_card['sort_by'])) { ?>

                <div class="col-md-3">

                    <!-- <label class="form-label  col-form-label">
                        Sort By </label> -->
                    <select class="form-control " name="sort_by" id="sortByListing" onchange="load_data_menu('<?= $page['load']['page_section_menu'] ?>',<?=$page['view_layout_number']?>);">
                        <option value="">
                            - Sort By -
                        </option>
                        <?php
                        foreach (($this_card['sort_by']) as $i => $value) {
                        ?>
                            <option value="<?= $i ?>">
                                <?= $i ?></option>

                        <?php }
                        ?>


                    </select>

                </div>
            <?php
            }
        }
        return ob_get_clean();
    }
    function button_filter_on_filter($page, $card, $template_name, $this_card, $nama_type)
    {
        ob_start();
        if ($nama_type == "card-listing") { ?>
            <button class="btn btn-success" onclick="load_data()" type="button">Filter</button>
        <?php
        }
        return ob_get_clean();
    }
    function button_search_on_filter($page, $card, $template_name, $this_card, $nama_type)
    {
        ob_start();
        if ($nama_type == "card-listing") { ?>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type here" id="searchID-<?=$page['view_layout_number']?>">
                <BUTTON class="input-group-text text-body" onclick="load_data_menu('<?= $page['load']['page_section_menu'] ?>',<?=$page['view_layout_number']?>') type="button"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></i></BUTTON>
            </div>
        <?php
        }
        return ob_get_clean();
    }
    function filter_on_filter($page, $card, $template_name, $this_card, $nama_type)
    {
        ob_start();
        $fai = new MainFaiFramework();
        if ($nama_type == "card-listing") { 
            
            if(isset($this_card['filter'])){
                echo '<form id="filterform" action="#" class="col-3">';
                $page['crud']['view'] = "tambah";
                $page['crud']['type'] = "tambah";
        
                // $page['crud']['prefix_name'] = "datafilter[";
                // $page['crud']['sufix_name'] = "]";
                ob_start();
                ?> onkeyup="load_data_menu('<?= $page['load']['page_section_menu'] ?>',<?=$page['view_layout_number']?>);"  onchange="load_data_menu('<?= $page['load']['page_section_menu'] ?>',<?=$page['view_layout_number']?>);"<?php
                $page['crud']['input_inline'] = ob_get_clean();;
          
            
             $data = array();
            // $this_card['filter'] = Database::converting_array_field($page,$this_card['filter']);
                for($i=0;$i<count($this_card['filter']);$i++){
                      $this_card['filter'][$i][1] = $i;
                echo Content::parse_form($fai, $page, $this_card['filter'], $this_card['filter'][$i][2], $i, 0, $data,array("required"=>""));
                  
                }
                echo '
                </form>
                ';
            }
            
        
        }
        return ob_get_clean();
    }
    function ulli_button($page, $card, $template_name, $this_card, $nama_type)
    {
        ob_start();
        if ($nama_type == "card-listing") { ?>

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
                        <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="changeView('ViewListTables')">
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
                        <button class="btn btn-primary " style="padding: 0.5rem" type="button" onclick="changeView('ViewVertical')">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="4" y="4" width="16" height="6" rx="2" />
                                        <rect x="4" y="14" width="16" height="6" rx="2" />
                                    </svg></i></span>
                        </button>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-primary" style="padding: 0.5rem" type="button" onclick="changeView('ViewHorizontal')">
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
<?php
        }
        return ob_get_clean();
    }
    function page_title($page, $card, $template_name, $this_card)
    {
        if (isset($page['title'])) {
            return $page['title'];
        }
    }
    function page_subtitle($page, $card, $template_name, $this_card)
    {
        if (isset($page['subtitle'])) {
            return $page['subtitle'];
        }
    }
    function prelist($page, $card, $template_name, $this_card)
    {
        $fai = new MainFaiFramework();
        $return_template = "";
        if (isset($this_card['prelist'])) {
            for ($a = 0; $a < count($this_card['prelist']); $a++) {
                if ($this_card['prelist'][$a][0] == 'extend') {
                    $extend_to = "" . $this_card['prelist'][$a][1];

                    $extend_to = "parse_" . $this_card['prelist'][$a][1];

                    $return_template .= $extend_to($page, $this_card['prelist'][$a][2], array(), $fai);
                }
            }
        }
        return $return_template;
    }
    function profile_title($page, $card, $template_name, $this_card)
    {
        
        $title = $card['profil']['array']['title'];
        $row= $title[1];
        return $title[0].' '.$page['row_section']['profil']['row'][0]->$row.' '.$title[2];
    }
    function profile_subtitle($page, $card, $template_name, $this_card)
    {
        
        $title = $card['profil']['array']['subtitle'];
        $row= $title[1];
        return $title[0].' '.$page['row_section']['profil']['row'][0]->$row.' '.$title[2];
    }
    function title_nav($page, $card, $template_name, $this_card)
    {
        
        if (isset($card['Title Nav'])) {
            return $card['Title Nav'];
        } else if (isset($this_card['title_nav'])) {
            return $this_card['title_nav'];
        } else {
            return  ucwords($page['load']['apps']);;
        }
    }
    function subtitle_nav($page, $card, $template_name, $this_card)
    {
        if (isset($this_card['subtitle_nav'])) {
            return $this_card['subtitle_nav'];
        } else {
            return (isset($page['load']['page_section_menu']) ? $page['load']['page_section_menu'] : '');
        }
    }
    function card_nav($page, $card, $template_name)
    {

        $key = $page['load']['page_section_menu'];
        $return_template = "";

        if (isset($card[$card['menu'][$key][2]]['cardNav'])) {

            $filename = isset($page['load']['card_template']['cardulnav']['template_file']) ?
                ($page['load']['card_template']['cardulnav']['template_file'] ? $page['load']['card_template']['cardulnav']['template_file'] : '_CardUlNav.template')
                : '_CardUlNav.template';

            $li_filename = isset($page['load']['card_template']['cardullinav']['template_file']) ?
                ($page['load']['card_template']['cardullinav']['template_file'] ? $page['load']['card_template']['cardullinav']['template_file'] : '_CardUlLiNav.template')
                : '_CardUlLiNav.template';
            $fai = new MainFaiFramework();
            // <?= $this->urlframework('assets\datatable', 'js/jquery.dataTables.min.js');
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
                    //echo '<textarea>'.$li_template.'</textarea>'; 
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
}
