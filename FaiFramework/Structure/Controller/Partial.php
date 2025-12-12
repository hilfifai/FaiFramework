<?php
require __DIR__ . '/../../Pages/_template/assets/PHPMailer/src/Exception.php';
require __DIR__ . '/../../Pages/_template/assets/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../Pages/_template/assets/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once 'Database.php';
class Partial extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public static function uri_segment(){
        $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
		$basePath = dirname($scriptName);

		if ($basePath && $basePath !== '/' && strpos($requestUri, $basePath) === 0) {
			$requestUri = substr($requestUri, strlen($basePath));
		}
		$requestUri = preg_replace('#/+#', '/', $requestUri);
		// hilangkan query string
		$requestUri = explode('?', $requestUri)[0];

		// bersihkan
		$requestUri = trim($requestUri, '/');

		// ambil segment
		$segments = array_values(array_filter(explode('/', $requestUri))); // reset index
		$segments = explode('/', $requestUri);
		$segments = array_filter($segments); 
        return array_values($segments);
    }
    public static function email_send($email, $judul, $pesan)
    {
        $email = htmlspecialchars($email);
        $judul = htmlspecialchars($judul);
        $pesan = htmlspecialchars($pesan);

        $mail = new PHPMailer(true);
        ob_start();
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host     = 'grsi.ethica.id';
            $mail->SMTPAuth = true;
            // email aktif yang sebelumnya di setting
            $mail->Username = 'admin@grsi.ethica.id';
            // password yang sebelumnya di simpan
            $mail->Password = 'dRRn#9~ro&Yu';
            // $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('admin@grsi.ethica.id', $judul);
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $judul;
            $mail->Body    = $pesan;
            $mail->send();
        } catch (Exception $e) {
        }
        ob_clean();
    }
    public static function array_extend($page, $database_utama, $id, $tipe_data)
    {
        $array = [];
        $sql   = "select * from form where database_utama = '" . $page['database']['utama'] . "'
	            and id_board=" . $page['load']['board'] . "
	            and load_apps='" . $page['load']['apps'] . "'
	            and load_page_view='" . $page['load']['page_view'] . "'
	            and tipe_form = 'Board Form'
	            and active=1";
        $get  = DB::query($sql);
        $form = DB::fetchResponse($get);
        if ($form) {
            $x = 0;
            foreach ($form as $form_) {
                if (! $x) {
                    $get_form = $form_;
                    $x++;
                }
            }
            DB::table('form__content__extend');
            DB::selectRaw('form__content__extend.id as pid,' . ((! empty($id) and $id != -1) ? 'form__response__extend.id as id_responses_extend,' : '') . ' *');
            DB::whereRaw("form__content__extend.id_form=$get_form->id");
            DB::whereRaw("form__content__extend.id_approval is null");
            DB::whereRaw("pertanyaan is not null");
            DB::orderByRaw($page, [["form__content__extend.id", "asc"]]);
            DB::joinRaw("webmaster__form__tipe on id_tipe_form = webmaster__form__tipe.id", 'left');
            if (! empty($id) and $id != -1) {

                DB::joinRaw("form__response__extend on id_extend = form__content__extend.id and connect_database='$database_utama' and tipe_data='$tipe_data' and connect_id=" . $id, 'left');
            }
            $row              = DB::get('all');
            $array['id_form'] = $get_form->id;
            if ($row['num_rows']) {
                foreach ($row['row'] as $data) {
                    if (! $data->kode_form) {
                        $data->kode_form = 'text';
                    }

                    $to = "";
                    if (! empty($id) and $id != -1) {

                        if ($data->respons) {
                            $to                                    = "update";
                            $array['id_form_response']             = $data->id_form_response;
                            $array['id_update_extend'][$data->pid] = $data->id_responses_extend;
                            $array['update_edit_extend'][]         = $data->pid;
                        } else {

                            $array['update_add_extend'][] = $data->pid;
                        }
                        $array['value_input']["extend_$to" . $data->pid] = $data->respons;
                    }
                    $array['array'][]  = [$data->pertanyaan, "extend_$to" . $data->pid, $data->kode_form . "-extend_db"];
                    $array['extend'][] = $data->pid;
                }
            }
        }
        // 		$array = Database::converting_array_field($page,$array);
        return $array;
    }
    public static function array_approval($page, $database_utama, $id, $tipe_data, $database)
    {
        $array = [];
        $sql   = "select * from form where database_utama = '" . $page['database']['utama'] . "'
	            and id_board=" . $page['load']['board'] . "
	            and load_apps='" . $page['load']['apps'] . "'
	            and load_page_view='" . $page['load']['page_view'] . "'
	            and tipe_form = 'Board Form'
	            and active=1";
        $get  = DB::query($sql);
        $form = DB::fetchResponse($get);
        if ($form) {

            $x = 0;
            foreach ($form as $form_) {
                if (! $x) {
                    $get_form = $form_;
                    $x++;
                }
            }
            DB::table('form__approval');
            DB::selectRaw('form__approval.id as pid,*');
            DB::whereRaw("form__approval.id_form=$get_form->id");
            // DB::whereRaw("nama_approval is not null");
            DB::whereRaw("form__approval.active=1");
            DB::orderByRaw($page, [["form__approval.approval_ke", "asc"]]);
            DB::joinRaw("web__list_apps_board__role__group on id_group_approval = web__list_apps_board__role__group.id", 'left');
            //DB::joinRaw("(select fa.id as id_max,approval_ke as tahap_max from form__approval fa where  approval_ke = max(approval_ke) ) faa on faa.id_form=$get_form->id ",'left');

            $row                = DB::get('all');
            $array['id_form']   = $get_form->id;
            $id_first           = 0;
            $id_last            = 0;
            $approval_ke_before = 0;
            if ($row['num_rows']) {
                foreach ($row['row'] as $data) {

                    $array['approval'][$data->approval_ke]    = [$data->nama_approval, $data->nama_role_group, $data->tipe_approval];
                    $array['id_approval'][$data->approval_ke] = $data->pid;
                    $array['tahap_approval'][$data->pid]      = $data->approval_ke;

                    $array['next_approval'][$approval_ke_before] = $data->pid;
                    if (! $id_first) {
                        $id_first = $data->pid;
                    }
                    $approval_ke_before = $data->approval_ke;
                    $id_last            = $data->pid;
                }

                $array['id_max'] = $id_last;

                $row = Database::database_coverter($page, $database, [], 'all');
                if ($row['num_rows']) {
                    foreach ($row['row'] as $data) {
                        unset($db_approval);
                        $db_approval['utama']   = "form__approval__flow";
                        $db_approval['where'][] = ["form__approval__flow.connect_database_utama", '=', "'$database_utama'"];
                        $db_approval['where'][] = ["form__approval__flow.connect_database_id", '=', "$data->primary_key"];
                        $db_approval['where'][] = ["form__approval__flow.id_form", '=', "$get_form->id"];
                        $db_approval['where'][] = ["form__approval__flow.active", '=', "1"];
                        $db_approval['join'][]  = ["form__approval__flow__proses", 'form__approval__flow__proses.id', "id_approval_proses_selesai", 'left'];
                        $row_approval           = $page['fai']->database_coverter($page, $db_approval, [], 'all');
                        if ($row_approval['num_rows'] == 0) {
                            $sql_approval = [];

                            $sql_approval['connect_database_utama'] = $database_utama;
                            $sql_approval['connect_database_id']    = $data->primary_key;
                            $sql_approval['id_form']                = $get_form->id;
                            $sql_approval['proses_tunggu']          = $id_first;
                            $sql_approval['is_selesai']             = 0;
                            CRUDFunc::crud_insert(false, $page, $sql_approval, [], $db_approval['utama'], []);

                            $row_approval = $page['fai']->database_coverter($page, $db_approval, [], 'all');
                        }

                        $db_now_approval['utama']                          = "form__approval";
                        $db_now_approval['where'][]                        = ["form__approval.id", '=', $row_approval['row'][0]->proses_tunggu];
                        $db_now_approval['join'][]                         = ["web__list_apps_board__role__group", 'id_group_approval', 'web__list_apps_board__role__group.id'];
                        $row_now_approval                                  = $page['fai']->database_coverter($page, $db_now_approval, [], 'all');
                        $array['approval_flow'][$data->primary_key]['row'] = $row_approval['row'][0];
                        if ($row_now_approval['num_rows']) {
                            $array['approval_flow'][$data->primary_key]['now_proses'] = $row_now_approval['row'][0];
                        } else {
                            $array['approval_flow'][$data->primary_key]['now_proses'] = (object) [];
                        }

                        DB::table('form__content__extend');
                        DB::selectRaw('form__content__extend.id as pid,form__response__extend.id as id_responses_extend, *');
                        DB::whereRaw("form__content__extend.id_form=$get_form->id");
                        DB::whereRaw("form__content__extend.id_approval is not null");
                        DB::whereRaw("pertanyaan is not null");
                        DB::orderByRaw($page, [["form__content__extend.id", "asc"]]);
                        DB::joinRaw("webmaster__form__tipe on id_tipe_form = webmaster__form__tipe.id", 'left');
                        DB::joinRaw("form__response__extend on id_extend = form__content__extend.id and connect_database='$database_utama' and tipe_data='$tipe_data' and connect_id=" . $data->primary_key, 'left');
                        $row = DB::get('all');

                        if ($row['num_rows']) {
                            foreach ($row['row'] as $data_extend) {
                                if (! $data_extend->kode_form) {
                                    $data_extend->kode_form = 'text';
                                }

                                $to = "";

                                if ($data_extend->respons) {
                                    $to                                                                                                                     = "update";
                                    $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['id_form_response']                    = $data_extend->id_form_response;
                                    $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['id_update_extend'][$data_extend->pid] = $data_extend->id_responses_extend;
                                    $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['update_edit_extend'][]                = $data_extend->pid;
                                } else {

                                    $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['update_add_extend'][] = $data_extend->pid;
                                }
                                $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['value_input']["approval_$to" . $data_extend->pid] = $data_extend->respons;

                                $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['array'][] = [$data_extend->pertanyaan, "approval_$to" . $data_extend->pid, $data_extend->kode_form . "-approval_db"];
                                $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['list'][]  = $data_extend->pid;
                                $array['approval_flow'][$data->primary_key]['extend'][$data_extend->id_approval]['id_form'] = $get_form->id;
                            }
                        }
                        if (isset($array['id_approval'])) {
                            foreach ($array['id_approval'] as $key => $value) {
                                unset($db_approval);
                                $db_approval['utama']   = "form__approval__flow__proses";
                                $db_approval['where'][] = ["connect_database_utama", '=', "'$database_utama'"];
                                $db_approval['where'][] = ["connect_database_id", '=', "$data->primary_key"];
                                $db_approval['where'][] = ["id_approval", '=', "$value"];
                                $db_approval['where'][] = ["id_form", '=', "$get_form->id"];
                                $row_proses_approval    = $page['fai']->database_coverter($page, $db_approval, [], 'all');
                                if (! $row_proses_approval['num_rows'] and $row_approval['row'][0]->is_selesai != 1) {
                                    $sql_approval = [];

                                    $sql_approval['connect_database_utama'] = $database_utama;
                                    $sql_approval['connect_database_id']    = $data->primary_key;
                                    $sql_approval['id_form']                = $get_form->id;
                                    $sql_approval['id_approval']            = $value;
                                    $sql_approval['status_approval']        = 3;
                                    CRUDFunc::crud_insert(false, $page, $sql_approval, [], $db_approval['utama'], []);

                                    $row_proses_approval = $page['fai']->database_coverter($page, $db_approval, [], 'all');
                                }
                                if ($row_proses_approval['num_rows']) {
                                    foreach ($row_proses_approval['row'] as $data_proses_approval) {
                                        $array['approval_flow'][$data->primary_key]['proses'][$data_proses_approval->id_approval]['row'] = $data_proses_approval;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        // 		$array = Database::converting_array_field($page,$array);

        return $array;
    }
    public function view($view, $page = [], $parameter = [], $type = 1)
    {
        $fai = new MainFaiFramework();
        if (count($parameter)) {
            if ($type == 1) {

                foreach ($parameter as $key => $value) {

                    $$key = $value;
                }
            } else {
                for ($i = 0; $i < count($parameter); $i++) {
                    $key  = $parameter[$i];
                    $$key = $key;
                }
            }
        }
        require dirname(__FILE__) . '/../../Pages/' . $view;
    }

    public static function get_id_apps($page)
    {
        if ($page['load_section'] != 'viewsource' and isset($page['load']['apps'])) {

            if (isset($page['load']['menu'])) {
                $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "' and load_page_view = '" . $page['load']['page_view'] . "' and load_menu = '" . $page['load']['menu'] . "' "));
                if (! $db) {
                    $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "' and load_page_view = '" . $page['load']['page_view'] . "'  "));
                }
            } else {
                $db = "";
            }
            if (! $db) {
                $db = DB::fetchResponse(DB::select("select * from web__list_apps_define where load_apps = '" . $page['load']['apps'] . "'   "));
            }
            if ($db) {
                $id = $db[0]->id_web__list_apps;
            } else {
                $id = null;
            }

            return $id;
        } else {
            return null;
        }
    }

    public static function toAlpha($number)
    {
        $alphabet   = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $alpha_flip = array_flip($alphabet);
        if ($number <= 25) {
            return $alphabet[$number];
        } elseif ($number > 25) {
            $dividend = ($number + 1);
            $alpha    = '';
            while ($dividend > 0) {
                $modulo   = ($dividend - 1) % 26;
                $alpha    = $alphabet[$modulo] . $alpha;
                $dividend = floor((($dividend - $modulo) / 26));
            }
            return $alpha;
        }
    }
    public static function getTagValues($tag, $str)
    {

        $re = sprintf("/\{(%s)\}(.+?)\{\/\\1\}/", preg_quote($tag));
        preg_match_all($re, $str, $matches);
        return $matches[2];
    }
    public static function navbar_menu($page, $menu, $configuration, $dropdown = 0)
    {
        // $menu = $page['load'][$tipe_menu];
        $return = "";

        for ($i = 0; $i < count($menu); $i++) {

            if (isset($menu[$i])) {
                if ($menu[$i][0] == 'group') {
                    $to_suffix_group = $configuration['sufix']['grup'];
                    if (isset($menu[$i][2])) {
                        $to_suffix_group = str_replace('<content-grup></content-grup>', Partial::navbar_menu($page, $menu[$i][2], $configuration, ($dropdown + 1)), $to_suffix_group);
                    }

                    $return .= $configuration['prefix']['grup'] . $menu[$i][1] . $to_suffix_group;
                } else if ($menu[$i][0] == 'menu') {
                    $temp_prefix_menu = $configuration['prefix']['menu'];
                    $onclick          = "";
                    $href             = "";

                    if (isset($menu[$i][4])) {
                        $onclick .= 'changeMenu(' . "'" . $menu[$i][4][0] . "'" . ',' . "'" . $menu[$i][4][1] . "'" . ',' . "'" . $menu[$i][4][2] . "'" . ');';
                    }

                    if ($page['load']['link'] == 'direct') {

                        if ($page['route_type'] != 'link_js_fai') {
                            $href = Partial::link_direct($page, $page['load']['link_route'], $menu[$i][2]);
                        } else {

                            $href    = "href='javascript:void(0)'";
                            $onclick = Partial::link_direct($page, $page['load']['link_route'], $menu[$i][2]);
                        }
                    } else {
                        if (isset($menu[$i][2]) and $menu[$i][0] == 'menu') {
                            $onclick .= 'reach_page_first(' . "'" . $menu[$i][2][0] . "'" . ',' . "'" . $menu[$i][2][1] . "'" . ',' . "'" . $menu[$i][2][2] . "'" . ',' . "'" . $menu[$i][2][3] . "'" . ');';
                        }
                    }
                    if (isset($menu[$i][3]) and $menu[$i][0] == 'menu') {
                        $temp_prefix_menu = str_ireplace('<ICON></ICON>', $menu[$i][3], $temp_prefix_menu);
                    }

                    $temp_prefix_menu = str_ireplace('|LINK|', $href . ' onclick="' . $onclick . '"', $temp_prefix_menu);

                    $return .= $temp_prefix_menu . $menu[$i][1] . $configuration['sufix']['menu'];
                } else if ($menu[$i][0] == 'dropdown') {

                    $temp_prefix = str_ireplace('|NAVSUB|', str_replace(" ", "", $menu[$i][1]), $configuration['prefix']['dropdown'][$dropdown]);
                    $temp_sufix  = str_ireplace('|NAVSUB|', str_replace(" ", "", $menu[$i][1]), $configuration['sufix']['dropdown'][$dropdown]);
                    //	$configuration['prefix']['dropdown'][$i];
                    $temp_sufix = str_ireplace("<SUB></SUB>", Partial::navbar_menu($page, $menu[$i][2], $configuration, ($dropdown + 1)), $temp_sufix);
                    $return .= $temp_prefix . '
			                       ' . $menu[$i][1] . $temp_sufix;
                }
            }
        }
        return $return;
    }
    public static function route($link_route, $parameter)
    {
        $prefix = '';
        $suffix = '';
        if (is_array($parameter)) {
            $link = '';
            for ($i = 0; $i < count($parameter); $i++) {
                $link .= $parameter[$i] . '/';
            }
            return $prefix . $link_route . '/' . $link . $suffix;
        } else {

            return $prefix . $link_route . '/' . $parameter . $suffix;
        }
    }
    public static function route_v($page, $link_route, $parameter, $redirect = 'reach_page', $direct_page = null)
    {

        if ($page['section'] == 'viewsource') {
            $prefix = '<?=url("';
            $sufix  = '");?>';

            if (is_array($parameter)) {
                $link = '';
                for ($i = 0; $i < count($parameter); $i++) {
                    if (isset($parameter[$i])) {
                        if (substr($parameter[$i], 0, 5) == 'data:') {
                            $link .= '$' . Partial::nama_function($page, $page['title']) . '->';
                            $link .= substr($parameter[$i], 5) . '/';
                        } else if (substr($parameter[$i], 0, 5) == 'page:') {
                            $link .= '$' . substr($parameter[$i], 5) . '/';
                        } else {
                            $link .= $parameter[$i] . '/';
                        }
                    }
                }
                return $prefix . $link_route . '/' . $link . $sufix;
            } else {

                return $prefix . $link_route . '/' . $parameter . $sufix;
            }
        } else {
            if (isset($page['crud']['list_table_view_layout'])) {
                $redirect = "change_view_layout_crud";
            }
            if (substr($parameter[1], 0, 5) == 'data:') {
                $row = substr($parameter[1], 5);

                $parameter[1] = $page['row'][0]->$row;
            } else if (substr($parameter[1], 0, 5) == 'page:') {
                $row          = substr($parameter[1], 5);
                $parameter[1] = $page[$row];
            }
            $extend = '';
            if ($direct_page) {
                $extend = ",'$direct_page'";
            }
            if ($page['load']['link'] == 'direct') {
                return Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], $parameter[0], $parameter[1]], 'menu', 'just_link');
            } else {
                return '#" onclick="' . $redirect . '(' . "'" . $link_route . "'" . ',' . "'" . $parameter[0] . "'" . ',' . "'" . $parameter[1] . "'" . $extend . ')';
            }
        }
    }
    public static function route_menu_code($page, $link_route, $parameter, $tipe_menu = 'menu')
    {
        $nama                    = "";
        $page['section']         = 'link';
        $where['load_apps']      = $parameter[0];
        $where['load_page_view'] = $parameter[1];
        $where['load_type']      = $parameter[2];
        $where['load_page_id']   = $parameter[3];
        if (isset($parameter[4])) {
            $where['menu'] = $parameter[4];

            if ($parameter[4] != -1) {
                $nama = $parameter[4];
            }
        } else {
            $where['menu'] = -1;
        }

        if (isset($parameter[5])) {
            $where['nav'] = $parameter[5];
            if ($parameter[5] != -1) {
                $nama = $parameter[5];
            }
        } else {
            $where['nav'] = -1;
        }

        if (isset($parameter[6])) {
            $where['board'] = $parameter[6];
        } else {
            $where['board'] = -1;
        }

        if (! $where['board']) {
            $where['board'] = -1;
        }

        $where['tipe_menu'] = $tipe_menu;

        DB::connection($page);
        $db['utama'] = 'web__menu';

        foreach ($where as $key => $value) {
            $db['where'][] = [$key, '=', "'$value'"];
        }
        $db['where'][] = ["active", '=', "1"];
        $db['np']      = true;
        $get           = Database::database_coverter($page, $db, [], 'all');

        if (! $get['num_rows']) {
            $where['kode_menu']    = Partial::random(25);
            $where['login']        = isset($page['load']['login']) ? $page['load']['login'] : 1;
            $where['nama_menu']    = $where['load_apps'] . ' ' . $nama . " - " . ucwords(str_replace('_', ' ', $where['load_page_view'])) . "";
            $where['id_menu_apps'] = (isset($page['id_list_apps'])) ? $page['id_list_apps'] : null;
            CRUDFunc::crud_insert(false, $page, $where, [], 'web__menu', []);

            if ($where['load_apps'] and $where['load_page_view'] and $where['load_type'] and $where['load_page_id']) {
                $get = Database::database_coverter($page, $db, [], 'all');
            }
        }
        $kode_menu      = $get['row'][0]->kode_menu;
        $return['link'] = $link_route . $kode_menu;
        $return['id']   = $get['row'][0]->id;
        $return['kode'] = $kode_menu;
        return $return;
    }
    public static function link_direct($page, $link_route, $parameter, $tipe_menu = 'menu', $route_type_overide = '')
    {

        $fai        = new MainFaiFramework();
        $route_type = 'route_v';
        if (isset($page['route_type'])) {
            if ($page['route_type']) {
                $route_type = $page['route_type'];
            }
        }
        if ($route_type == 'just_just') {
            $route_type = 'just_link';
        }
        if (! $link_route) {
            $link_route = $page['load']['link_route'];
        }
        if ($route_type_overide) {
            $page['route_type'] = $route_type = $route_type_overide;
        }
        /*
// 		0 => $function->load_apps, 
        1=> $function->load_page_view, 
        2=> $function->load_type, 
        3=> $function->load_page_id, 
        4=> $function->menu, 
        5=> $function->nav, 
        6=> $function->board, 
        7=> $function->page, 
        8=> $function->ambil_dari, 
        9=> $function->kode_link
		*/
        if (! ! empty($page['load']['link'])) {
            $page['load']['link'] = 'direct';
        }

        if (! empty($parameter[2])) {

            $parameter[2] = Database::string_database($page, $fai, $parameter[2]);
        } else {
            $parameter[2] = 0;
        }
        if (! empty($parameter[3])) {

            $parameter[3] = Database::string_database($page, $fai, $parameter[3]);
        } else {
            $parameter[3] = 0;
        }
        if (! empty($parameter[4])) {

            $parameter[4] = Database::string_database($page, $fai, $parameter[4]);
        } else {
            $parameter[4] = 0;
        }
        if (! empty($parameter[5])) {
            $parameter[5] = Database::string_database($page, $fai, $parameter[5]);
        } else {
            $parameter[5] = 0;
        }
        if (! empty($parameter[6])) {
            $parameter[6] = Database::string_database($page, $fai, $parameter[6]);
        } else {
            $parameter[6] = 0;
        }
        if (! empty($parameter[7])) {
            $parameter[7] = Database::string_database($page, $fai, $parameter[7]);
        } else {
            $parameter[7] = 0;
        }
        if (! empty($parameter[8])) {
            $parameter[8] = Database::string_database($page, $fai, $parameter[8]);
        } else {
            $parameter[8] = 0;
        }
        if (! empty($parameter[9])) {
            $parameter[9] = Database::string_database($page, $fai, $parameter[9]);
        } else {
            $parameter[9] = 0;
        }
        unset($_SESSION['link'][$page['load']['link']][$route_type][$parameter[0]][$parameter[1]][$parameter[2]][$parameter[3]][$parameter[4]][$parameter[5]][$parameter[6]][$parameter[7]][$parameter[8]][$parameter[9]]);
        if (isset($_SESSION['link'][$page['load']['link']][$route_type][$parameter[0]][$parameter[1]][$parameter[2]][$parameter[3]][$parameter[4]][$parameter[5]][$parameter[6]][$parameter[7]][$parameter[8]][$parameter[9]])) {
            return $_SESSION['link'][$page['load']['link']][$route_type][$parameter[0]][$parameter[1]][$parameter[2]][$parameter[3]][$parameter[4]][$parameter[5]][$parameter[6]][$parameter[7]][$parameter[8]][$parameter[9]];
        } else {
            // 		, $function->page, $function->ambil_dari, $function->kode_link
            $return = "";
            if (! empty($parameter[9])) {

                $return = base_url() . "web/" . $page['load']['row_web_apps']->kode_webapps . '_' . $parameter[9];
            } else if (! ($parameter[0] and $parameter[1])) {
            } else
            if ($page['load']['link'] == 'direct') {

                if ($route_type == 'id') {
                    $return = Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['id'];
                } else if ($route_type == 'kode') {
                    $return = Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['kode'];
                } else if ($route_type == 'just_link') {
                    $return = Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['link'];
                } else if ($route_type == 'link_js_fai') {

                    $encoded = base64_encode(json_encode($parameter));

                    $return = 'link_direct(\'' . $encoded . '\')';
                } else if ($route_type == 'link_id_menu') {
                    $db['utama']   = 'web__menu';
                    $db['where'][] = ['id', '=', $parameter[1]];
                    $get           = DB::get();
                    $kode_menu     = $get[0]->kode_menu;
                    $return        = $link_route . $kode_menu;
                } else if ($route_type == 'costum_link') {
                    $return = "" . base_url() . "/FaiServer/costum/";
                    foreach ($parameter as $key => $value) {

                        $return .= Database::string_database($page, $fai, $value) . "/";
                    }
                    $return;
                } else if ($route_type == 'just_link_with_kutip') {
                    $return = "'" . Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['link'] . "'";
                } else if ($route_type == 'window_location') {
                    $return = "window.location='" . Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['link'] . "'";
                } else {
                    $return = 'href="' . Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['link'] . '"';
                }
            } else {

                $temp         = $parameter;
                $parameter[0] = $temp[2];
                $parameter[1] = $temp[3];
                //$parameter[2] = $temp[4]; 
                if ($route_type == 'just_just') {
                    $route_type = 'just_link';
                }
                if ($route_type == 'just_link') {
                    $return = "'" . $link_route . "'";
                } else if ($route_type == 'window_location') {
                    $return = "window.location='" . Partial::route_menu_code($page, $link_route, $parameter, $tipe_menu)['link'] . "'";
                } else if ($route_type == 'just_link_with_kutip') {
                    $return = "'" . $link_route . "'";
                } else {

                    $return = "'" . Partial::$route_type($page, $link_route, $parameter) . "'";
                }
            }
            $_SESSION['link'][$page['load']['link']][$route_type][$parameter[0]][$parameter[1]][$parameter[2]][$parameter[3]][$parameter[4]][$parameter[5]][$parameter[6]][$parameter[7]][$parameter[8]][$parameter[9]] = $return;
            $return;
            return $return;
        }
    }
    public static function route_r($page, $link_route, $parameter)
    {
        //redirect auto blank

        if ($page['section'] == 'viewsource') {
            $prefix = '<?=url("';
            $sufix  = '");?>';

            if (is_array($parameter)) {
                $link = '';
                for ($i = 0; $i < count($parameter); $i++) {
                    if (substr($parameter[$i], 0, 5) == 'data:') {
                        $link .= '<?=$' . Partial::nama_function($page, $page['title']) . '[0]->';
                        $link .= substr($parameter[$i], 5) . ';?>/';
                    } else if (substr($parameter[$i], 0, 5) == 'page:') {
                        $link .= '$' . substr($parameter[$i], 5) . '/';
                    } else {
                        $link .= $parameter[$i] . '/';
                    }
                }
                $return = $prefix . $link_route . '/' . $link . $sufix;
                $return = str_replace("//", "/", $return);
                return $return;
            } else {
                $return = $prefix . $link_route . '/' . $parameter . $sufix;
                $return = str_replace("//", "/", $return);
            }
        } else {
            if (is_array($parameter)) {
                for ($i = 0; $i < count($parameter); $i++) {
                    if (substr($parameter[$i], 0, 5) == 'data:') {
                        $row           = substr($parameter[$i], 5);
                        $parameter[$i] = $page['row'][0]->$row;
                    } else if (substr($parameter[$i], 0, 5) == 'page:') {
                        $row           = substr($parameter[$i], 5);
                        $parameter[$i] = $page[$row];
                    }
                }
            }

            return $link_route . '?apps=' . $parameter[0] . '&page_view=' . $parameter[1] . '&type=' . $parameter[2] . '&id=' . $parameter[3];
        }
    }
    public static function route_post($page, $link_route, $parameter = null)
    {

        if ($page['section'] == 'viewsource') {
            $prefix = '<?=url("';
            $sufix  = '");?>';

            if (is_array($parameter)) {
                $link = '';
                for ($i = 0; $i < count($parameter); $i++) {
                    if (substr($parameter[$i], 0, 5) == 'data:') {
                        $link .= '<?=$' . Partial::nama_function($page, $page['title']) . '[0]->';
                        $link .= substr($parameter[$i], 5) . ';?>/';
                    } else if (substr($parameter[$i], 0, 5) == 'page:') {
                        $link .= '$' . substr($parameter[$i], 5) . '/';
                    } else {
                        $link .= $parameter[$i] . '/';
                    }
                }
                return $prefix . $link_route . '/' . $link . $sufix;
            } else {

                return $prefix . $link_route . '/' . $parameter . $sufix;
            }
        } else {
            if ($parameter) {

                if (substr($parameter[1], 0, 5) == 'data:') {
                    $row          = substr($parameter[1], 5);
                    $parameter[1] = $page['row'][0]->$row;
                } else if (substr($parameter[1], 0, 5) == 'page:') {
                    $row          = substr($parameter[1], 5);
                    $parameter[1] = $page[$row];
                }
            }

            return Partial::route($link_route, $parameter);
        }
    }
    public static function route_j($page, $link_route, $parameter)
    {
        if ($page['section'] == 'viewsource') {
            $prefix = '<?=url("';
            $sufix  = '");?>';

            if (is_array($parameter)) {
                $link = '';
                for ($i = 0; $i < count($parameter); $i++) {
                    if (substr($parameter[$i], 0, 5) == 'data:') {
                        $link .= '<?=$' . Partial::nama_function($page, $page['title']) . '[0]->';
                        $link .= substr($parameter[$i], 5) . ';?>/';
                    } else if (substr($parameter[$i], 0, 5) == 'page:') {
                        $link .= '$' . substr($parameter[$i], 5) . '/';
                    } else {
                        $link .= $parameter[$i] . '/';
                    }
                }
                return $prefix . $link_route . '/' . $link . $sufix;
            } else {

                return $prefix . $link_route . '/' . $parameter . $sufix;
            }
        } else {
            if (substr($parameter[1], 0, 5) == 'data:') {
                $row          = substr($parameter[1], 5);
                $parameter[1] = $page['row'][0]->$row;
            } else if (substr($parameter[1], 0, 5) == 'page:') {
                $row          = substr($parameter[1], 5);
                $parameter[1] = $page[$row];
            }

            return Partial::route($link_route, $parameter);
        }
    }
    public static function add_tab_group($page)
    {
        if (isset($page['load']['login']) and $page['load']['row_web_apps']->login and isset($_SESSION['id_apps_user'])) {
            DB::table('tab_group');
            DB::whereRaw("id_apps_user='" . $_SESSION['id_apps_user'] . "'");
            DB::whereRaw("tab_aktif=1");
            $tab                         = DB::get('all');
            $update_tab['id_menu']       = isset($page['load']['id_menu']) ? $page['load']['id_menu'] : null;
            $update_tab['id_panel']      = $page['get_panel']['id_panel'];
            $update_tab['nama_menu_tab'] = $page['load']['row_web_apps']->nama_menu;
            if ($tab['num_rows']) {
                DB::update("tab_group", $update_tab, ["id_apps_user='" . $_SESSION['id_apps_user'] . "'", "tab_aktif=1"]);
            } else {
                $update_tab['id_apps_user'] = $_SESSION['id_apps_user'];
                $update_tab['tab_aktif']    = 1;
                $update_tab['urutan']       = 1;

                CRUDFunc::crud_insert(false, $page, $update_tab, [], "tab_group", []);
            }
        }
    }
    public static function define_web_apps_menu($page)
    {

        unset($where);
        $where['load_apps']      = $page['load']['apps'];
        $where['load_page_view'] = $page['load']['page_view'];

        $where['menu'] = ($page['load']['menu']) ? $page['load']['menu'] : -1;
        $where['nav']  = ($page['load']['nav']) ? $page['load']['nav'] : -1;
        foreach ($where as $key => $value) {
            $db['where'][] = [$key, '=', "'$value'"];
        }

        // $db['where'][] = array("active", '=', "1");
        $db['np']    = true;
        $db['utama'] = 'web__list_apps_menu';
        $get         = Database::database_coverter($page, $db, [], 'all');

        if (! $get['num_rows'] and $page['load']['view_page'] != 'bundles' and $where['load_apps'] != '-1' and $where['load_apps'] != 'load_page_view') {
            $where['load_type'] = $page['load']['type'] == 'view_layout' ? 'view_layout' : 'list';

            $where['load_page_id'] = -1;
            $where['login']        = (int) isset($_SESSION['is_login']) ? $_SESSION['is_login'] : 0;
            $where['tipe_menu']    = "menu";
            $where['nama_menu']    = isset($page['title']) ? $page['title'] : null;
            $where['page']         = ($where['load_type'] == 'view_layout' ? "Frontend" : "Backend");
            $where['diambil_dari'] = $page['load']['view_page'];
            $where['ambil_dari']   = $page['load']['view_page'];
            $where['board']        = "ID_BOARD|";
            $where['id_apps']      = (isset($page['id_list_apps'])) ? $page['id_list_apps'] : null;
            if ($where['login']) {
                $where['login'] = 1;
            } else {
                $where['login'] = 0;
            }

            if ($where['load_apps'] and $where['load_page_view']) {
                CRUDFunc::crud_insert(false, $page, $where, [], 'web__list_apps_menu', []);
            }

            if ($where['load_apps'] and $where['load_page_view'] and $where['load_type'] and $where['load_page_id']) {
                $get = Database::database_coverter($page, $db, [], 'all');
            }
        }

        return $get;
    }
    public static function id_user()
    {

        $page['session_utama'] = isset($page['session_utama']) ? $page['session_utama'] : 'id_apps_user';
        $session_utama         = $page['session_utama'];

        return isset($_SESSION[$session_utama]) ? $_SESSION[$session_utama] : 0;
    }
    public static function _reconstruct_array_data($data)
    {
        $result = [];

        foreach ($data as $key => $value) {
            // Handle array notation: key[123]
            if (preg_match('/^(.*)\[(\d+)\]$/', $key, $matches)) {
                $base_key = $matches[1];
                $index    = $matches[2];

                if (! isset($result[$base_key])) {
                    $result[$base_key] = [];
                }
                $result[$base_key][$index] = $value;
            }
            // Handle nested arrays jika ada
            else {

                $result[$key] = $value;
            }
        }

        return $result;
    }
    public static function _reconstruct_complex_data($data)
    {
        $result = [];
        if ($data) {

            foreach ($data as $key => $value) {
                // Handle array bracket notation: key[123]
                if (preg_match('/^(.*)\[(\d+)\]$/', $key, $matches)) {
                    $base_key = $matches[1];
                    $index    = $matches[2];

                    if (! isset($result[$base_key])) {
                        $result[$base_key] = [];
                    }
                    $result[$base_key][$index] = $value;
                }
                // Handle array fields (yang berakhiran _id, _ids, dll)
                else if (preg_match('/^(.*)_id$/', $key, $matches)) {
                    $base_key     = $matches[1];
                    $result[$key] = $value; // Simpan juga field aslinya

                    // Jika ada data yang sesuai untuk base_key ini, reconstruct
                    if (isset($result[$base_key]) && is_array($result[$base_key]) && is_array($value)) {
                        $reconstructed = [];
                        foreach ($value as $i => $id) {
                            if (isset($result[$base_key][$id])) {
                                $reconstructed[$id] = $result[$base_key][$id];
                            }
                        }
                        $result[$base_key] = $reconstructed;
                    }
                } else {
                    $result[$key] = $value;
                }
            }

            return $result;
        } else {

            return [];
        }
    }
    public static function input($field, $type = '_REQUEST')
    {

        $return = null;

        $body = json_decode(file_get_contents("php://input"), true);
        $body = Partial::_reconstruct_complex_data($body);
        $body = Partial::_reconstruct_array_data($body);
        // print_R($body);
        if (isset($body[$field])) {
            $return = $body[$field];
        }
        if (isset($_POST[$field]) and ! $return) {
            $return = $_POST[$field];
        }
        if (isset($_GET[$field]) and ! $return) {
            $return = $_GET[$field];
        }
        if (isset($_FILES[$field]) and ! $return) {
            $return = $_FILES[$field];
        }

        return $return;
    }
    public static function hapusRupiah($angka)
    {

        $angka = str_ireplace('RP', '', $angka);
        $angka = str_ireplace('Rp', '', $angka);
        $angka = str_ireplace('.', '', $angka);
        $angka = str_ireplace(',', '.', $angka);
        $angka = str_ireplace(' ', '', $angka);
        if (! $angka) {
            $angka = 0;
        }

        return ($angka);
    }
    public static function to_phone_number($angka)
    {

        $angka = str_ireplace('+', '', $angka);
        $angka = str_ireplace(' ', '', $angka);
        $angka = str_ireplace('-', '', $angka);
        if (! $angka) {
            $angka = 0;
        }

        return ($angka);
    }
    public static function nama_controller($page, $nama_page)
    {
        $page['app_framework'] = isset($page['app_framework']) ? $page['app_framework'] : 'ci';
        $app_framework         = $page['app_framework'];
        $suffix                = '';
        if ($app_framework == 'laravel') {
            $suffix = 'Controller';
        }

        return ucfirst(str_replace([' '], [], $nama_page)) . $suffix;
    }
    public static function nama_function($page, $nama_page)
    {

        return strtolower(str_replace([' '], ['_'], $nama_page));
    }
    public static function nama_model($nama_page)
    {
        return "M_" . str_replace([' '], [], $nama_page);
    }
    public static function nama_alias_model($nama_page)
    {
        return "M_" . str_replace([' '], [], $nama_page);
    }
    public static function nama_view($nama_page)
    {
        return "v_" . str_replace([' '], [], $nama_page) . '.php';
    }
    public static function nama_modal($nama_page)
    {
        return "v_modal_" . str_replace([' '], ["_"], $nama_page) . '.php';
    }
    public static function nama_js($nama_page)
    {
        return "v_js_" . strtolower(str_replace([' '], ["_"], $nama_page)) . '.php';
    }

    public static function paginate_fai_content($item_per_page, $current_page, $total_records)
    {
        $pagination = '';

        if ($item_per_page) {
            $item_per_page = 1;

            $total_pages = ceil($total_records / $item_per_page);
            if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) {
                //verify total pages and current page number
                $pagination .= '<ul class="pagination m-0 ms-auto" style="align-items: center;">';

                $right_links = $current_page + 3;
                $previous    = $current_page - 3; //previous link
                $next        = $current_page + 1; //next link
                $first_link  = true;              //boolean var to decide our first link

                if ($current_page > 1) {
                    $previous_link = ($previous == 0) ? 1 : $previous;
                    $pagination .= '<li class="first page-item"><button type="button" class="page-link" onclick="gantipage(1),load_data_menu()" title="First"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg> </button></li>'; //first link
                    $pagination .= '<li  class="page-item "><button type="button" class="page-link" onclick="gantipage(' . $previous_link . '),load_data_menu()" title="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/> </svg></button></li>';             //previous link
                    for ($i = ($current_page - 2); $i < $current_page; $i++) {
                        //Create left - hand side links
                        if ($i > 0) {
                            $pagination .= '<li class="page-item "> <button type="button" class="page-link" onclick="gantipage(' . $i . '),load_data_menu()">' . $i . '</button></li>';
                        }
                    }
                    $first_link = false; //set first link to false
                }

                if ($first_link) {
                    //if current active page is first link
                    $pagination .= '<li class="first page-item active"><button type="button" class="page-link" onclick="gantipage(' . $current_page . '),load_data_menu()">' . $current_page . '</button></li>';
                } elseif ($current_page == $total_pages) {
                    //if it's the last active link
                    $pagination .= '<li class="last page-item active"><button type="button" class="page-link" onclick="gantipage(' . $current_page . '),load_data_menu()">' . $current_page . '</button></li>';
                } else {
                    //regular current link
                    $pagination .= '<li class="page-item active"><button type="button" class="page-link" onclick="gantipage(' . $current_page . '),load_data_menu()">' . $current_page . '</button></li>';
                }

                for ($i = $current_page + 1; $i < $right_links; $i++) {
                    //create right - hand side links
                    if ($i <= $total_pages) {
                        $pagination .= '<li  class="page-item"><button type="button" class="page-link" onclick="gantipage(' . $i . '),load_data_menu()">' . $i . '</button></li>';
                    }
                }
                if ($current_page < $total_pages) {
                    $next_link = ($i > $total_pages) ? $total_pages : $i;
                    $pagination .= '<li  class="page-item"><button type="button" class="page-link" onclick="gantipage(' . $next_link . '),load_data_menu()" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/> </svg></button></li>';                                                 //next link
                    $pagination .= '<li class="last page-item"><button type="button" class="page-link" onclick="gantipage(' . $total_pages . '),load_data_menu()" title="Last"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> </button></li>'; //last link
                }

                $pagination .= '</ul>';
            }
        }
        return $pagination; //return pagination links
    }
    public static function get_avatar($page, $nama, $id_file, $database, $return_all = false, $support = "", $avatar_style = 0, $badge = '', $costum_class = 'avatar ', $field_data = '', $get_data = '')
    {

        if ($avatar_style == 3) {
            $style = 'width: 100%;padding-top: 50%;padding-bottom:50%;border-radius: 10px 20px;background: #009688;color: white;font-size: 14px;min-height:50px';
        } elseif ($avatar_style == 2) {
            $style = 'width: 100%;height: 100%;border-radius: 10px 20px;background: #009688;color: white;font-size: 14px;min-height:50px';
        } else if ($avatar_style) {
            $style = 'width: 50px;height: 50px;border-radius: 10px 20px;background: #009688;color: white;font-size: 14px;';
        } else {
            $style = '';
        }
        if ($badge) {
            $badge = '<span class="badge bg-' . $badge . '"></span>';
        }

        $nama_lengkap = explode(' ', $nama);
        if ($id_file) {
            $mas = Partial::get_file($page, $id_file, $database, $field_data, $get_data);
        }

        $url = '';
        if ($mas['num_rows']) {
            foreach ($mas['row'] as $m):
                $url = Partial::url_file($m);
            endforeach;
        }
        if ($url) {

            $avatar = '<span class="' . $costum_class . '" style="background-image: url(' . $url . '); height:100%;bacgrouborder-radius: 10px 20px;
margin: 30px;border-radius: 10px 20px;">
		' . $badge . '</span>';
            //$avatar       = '<div style="background-image: url('.$url.');"></div>'; 
            $avatar_value = $url;
            $avatar_type  = 'img';
        } else {
            $first = '';
            if (isset($nama_lengkap[0][0])) {
                $first = $nama_lengkap[0][0];
            }

            $last_name = '';
            if (isset($nama_lengkap[1][0])) {
                $last_name = $nama_lengkap[1][0];
            }

            $avatar_value = $first . $last_name ? $first . $last_name : $nama_lengkap[0];
            $avatar       = '<span class="' . $costum_class . '" style="' . $style . ';">' . $badge . $first . $last_name . '</span>';

            $avatar_type = 'avatar';
        }
        if (! $return_all) {

            return $avatar;
        } else {
            $return['avatar']       = $avatar;
            $return['avatar_value'] = $avatar_value;
            $return['avatar_type']  = $avatar_type;
            return $return;
        }
    }
    public function get_avatar_full($nama, $id_file, $database, $costum_style = 'avatar avatar-sm')
    {

        $nama_lengkap = explode(' ', $nama);
        $mas          = Partial::get_file($id_file, $database);
        $url          = '';
        foreach ($mas as $m):

            $url = url_file($m);
        endforeach;
        if ($url and file_exists($url)) {
            $avatar = '<div class="avatar-preview" style="width: 150px;height: 150px;border-radius: 40px 70px;">
		<div
		id="imagePreview" style="background-image: url(' . $url . ');border-radius: 38px 67px;" >
		</div>
		</div>';
            $avatar_value = $url;
            $avatar_type  = 'img';
        } else {
            $first = '';
            if (isset($nama_lengkap[0][0])) {
                $first = $nama_lengkap[0][0];
            }

            $last_name = '';
            if (isset($nama_lengkap[1][0])) {
                $last_name = $nama_lengkap[1][0];
            }

            $avatar_value = $first . $last_name ? $first . $last_name : $nama_lengkap[0][1];
            $avatar       = '<span class="' . $costum_style . '" style="width: 100%;height: 100%;border-radius: 20px 50px;background: #009688;color: white;font-size: 14px;">' . $avatar_value . '</span>';

            $avatar_type = 'avatar';
        }
        return $avatar;
    }
    public static function url_file($file)
    {
        //
        if ($file->storage == 'External') {
            if ($file->status_generate == 0) {
                //$ex = explode('/',$file->path);
                // $fileInfo = pathinfo($file->path);

                // $filename = $fileInfo['filename'];
                // $name     = $filename;
                // $ext      = "jpg";
                // $filename = random_str(10) . date('Y-m-d-H-i-s') . random(10) . '-' . $filename . '.' . $ext;
                // $filename_sys = 'Be3-' . date('Y-m-d H:i:s') . random_num(2) . '.' . $ext;
                // //echo 'uploads/'.$file->path_external . $filename;
                // copy($file->path, 'uploads/' . $file->path_external . "/" . $filename);
                // $update['extension'] = "'$ext'";
                // $update['file_name_asli'] = "'$name'";
                // $update['file_name_system'] = "'$filename_sys'";
                // $update['file_name_save'] = "'$filename'";
                // $update['status_generate'] = "1";
                // DB::update('drive__file', $update, [["id", "=", $file->id]], 'Where Array');
                return $file->path;
            } else {
                $file_url = base_url() . 'uploads/' . $file->path_external . '/' . $file->file_name_save;
                return $file_url;
            }
        } else {
            $file_url     = base_url() . 'uploads/' . $file->path . '/' . $file->file_name_save;
            $file_headers = @get_headers($file_url);
            if (isset($file_headers[0])) {
                if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {

                    return '';
                } else {

                    return $file_url;
                }
            } else {
                return '';
            }
        }
    }
    public static function get_file($page, $data, $database = "", $field_data = '', $get_data = '')
    {
        //echo $database;

        $fai = new MainFaiFramework();
        if (! $field_data and ! $get_data) {

            $db['utama']       = "drive__file";
            $db['primary_key'] = "id";
            $db['np']          = "id";
            $db['where'][]     = ["drive__file.id", "=", $data];
            if ($database) {
                $db['where'][] = ["ref_database", "=", "'$database'"];
            }

            // $db['where'][] = array("sizes::int", ">", "0");

            $page['section'] = 'file';
            return $fai->database_coverter($page, $db, null, 'all');
        } else {

            $db['utama']   = $database;
            $db['np']      = $database;
            $db['where'][] = ["$database.$field_data", "=", $data];
            $get           = $fai->database_coverter($page, $db, null, 'all');
            unset($db);
            $db['utama']       = "drive__file";
            $db['primary_key'] = "id";
            $db['np']          = "id";
            $db['where'][]     = ["drive__file.id", " in ", "(" . ($get['row'][0]->$get_data ? $get['row'][0]->$get_data : -1) . ")"];
            // $db['where'][] = array("sizes::int", ">", "0");

            $page['section'] = 'file';
            $get             = $fai->database_coverter($page, $db, null, 'all');

            return $get;
        }
    }
    public function get_img($data, $database, $style = "height='200px'", $type = 'img')
    {
        $baris = Partial::get_file($data, $database, 'row');

        if ($baris['num_rows']) {
            if ($type == 'img') {
                return '<img src="' . url_file($baris['row'][0]) . '" style="' . $style . '" class="mr-3">';
            } else {
                return '<' . $type . ' style="background:url(' . "'" . url_file($baris['row'][0]) . "'" . ');' . $style . '" class="mr-3"></' . $type . '>';
            }
        } else {
            return '';
        }
    }
    public static function get_url_file($page, $data, $database = "")
    {
        if ($data and trim($data) != ',') {
            $baris = Partial::get_file($page, $data, $database);
        } else {

            $baris['num_rows'] = 0;
            $baris['query']    = "";
        }
        if ($baris['num_rows']) {

            return Partial::url_file($baris['row'][0]);
        } else {
            return "#";
        }
    }
    public static function format_tgl($tgl, $format)
    {
        return date($format, strtotime($tgl));
    }
    public static function parse_number($number)
    {
        return str_replace([' ', '-'], ['', ''], $number);
    }

    public static function tambah_tanggal($tanggal, $jumlah_hari)
    {
        $tgl1 = $tanggal;                                                                 // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+' . $jumlah_hari . ' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
        return $tgl2;
    }
    public static function tgl_valid($tgl)
    {
        $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah   = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan   = bulan_east($pecah[1]);
        $tahun   = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
    public static function datetime_indo($tgl)
    {
        $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah   = explode(" ", $ubah);
        $pecah2  = explode("-", $pecah[0]);
        $tanggal = $pecah2[2];
        $bulan   = bulan($pecah2[1]);
        $tahun   = $pecah2[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
    public static function tgl_indo_fd($tgl)
    {
        $waktu = format_tanggal($tgl, 'H:i:s');
        if ($waktu == '00:00:00') {
            $waktu = '';
        } else {
            $waktu = 'Pukul ' . $waktu;
        }
        $tgl     = format_tanggal($tgl, 'Y-m-d');
        $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah   = explode(" ", $ubah);
        $pecah2  = explode("-", $pecah[0]);
        $tanggal = $pecah2[2];
        $bulan   = bulan($pecah2[1]);
        $tahun   = $pecah2[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $waktu;
    }

    public static function nama_bulan_hijriah($bulan_ke)
    {
        $bulan = [
            1 => "Muharam",
            "Safar",
            "Rabiul Awal",
            "Rabiul Akhir",
            "Jumadil Ula",
            "Jumadil Akhir",
            "Rajab",
            "Syaban",
            "Ramadhan",
            "Syawal",
            "Dzulqadah",
            "Dzulhijjah",
        ];
        return $bulan[$bulan_ke];
    }
    public static function nama_bulan($bln)
    {
        $bln = explode('-', $bln)[1];
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

    public static function tgl_indo($tgl)
    {
        if ($tgl) {

            $tgl     = format_tanggal($tgl, 'Y-m-d');
            $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
            $pecah   = explode(" ", $ubah);
            $pecah2  = explode("-", $pecah[0]);
            $tanggal = $pecah2[2];
            $bulan   = bulan($pecah2[1]);
            $tahun   = $pecah2[0];
            return $tanggal . ' ' . $bulan . ' ' . $tahun;
        } else {
            return '';
        }
    }
    public function back_tgl_indo($tgl)
    {

        $pecah   = explode(" ", $tgl);
        $tanggal = $pecah[0];
        $bulan   = back_bulan($pecah[1]);
        if ($bulan < 10) {
            $bulan = '0' . $bulan;
        }
        $tahun = $pecah[2];
        return $tahun . '-' . $bulan . '-' . $tanggal;
    }
    public function bulan_indo($tgl)
    {
        $ubah    = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah   = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan   = bulan($pecah[1]);
        $tahun   = $pecah[0];
        return $bulan;
    }

    public function back_bulan($bln)
    {
        switch ($bln) {
            case "Januari":
                return 1;
                break;
            case "Februari":
                return 2;
                break;
            case "Maret":
                return 3;
                break;
            case "April":
                return 4;
                break;
            case "Mei":
                return 5;
                break;
            case "Juni":
                return 6;
                break;
            case "Juli":
                return 7;
                break;
            case "Juli":
                return 7;
                break;
            case "Agustus":
                return 8;
                break;
            case "September":
                return 9;
                break;
            case "Oktober":
                return 10;
                break;
            case "November":
                return 11;
                break;
            case "Desember":
                return 12;
                break;
        }
    }
    public function bulan_short($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
    public function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
    public function bulan_east($bln)
    {
        switch ($bln) {
            case 1:
                return "January";
                break;
            case 2:
                return "February";
                break;
            case 3:
                return "March";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "May";
                break;
            case 6:
                return "June";
                break;
            case 7:
                return "July";
                break;
            case 8:
                return "August";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "October";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "December";
                break;
        }
    }
    public static function day_number($day_number)
    {
        $days = ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'];
        return $days[$day_number];
    }
    public function search_hari($Date, $day_number)
    {
        $days = ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'];

        return date('Y-m-d', strtotime('' . $days[$day_number] . ' this week', strtotime($Date)));
    }
    public function search_hari_antara_tanggal($startDate, $endDate, $day_number)
    {
        $endDate = strtotime($endDate);
        $days    = ['1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday', '7' => 'Sunday'];
        for ($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i)) {
            $date_array[] = date('Y-m-d', $i);
        }

        return $date_array;
    }

    public static function nama_hari($tanggal)
    {
        $ubah  = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl   = $pecah[2];
        $bln   = $pecah[1];
        $thn   = $pecah[0];

        $nama      = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";

        return $nama_hari;
    }
    public static function nama_hari_indo_name_east($nama)
    {

        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else
        if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else
        if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else
        if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else
        if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else
        if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else
        if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari;
    }
    public static function tgl_indo_no_tahun($tgl)
    {

        $newDate = date("Y-m-d", strtotime($tgl));
        $ubah    = gmdate($newDate, time() + 60 * 60 * 8);
        $pecah   = explode(" ", $ubah);
        $pecah2  = explode("-", $pecah[0]);
        $tanggal = $pecah2[2];
        $bulan   = bulan($pecah2[1]);
        $tahun   = $pecah2[0];
        return $tanggal . ' ' . $bulan;
    }
    public static function stgl_indo_no_tahun($tgl)
    {

        $newDate = date("Y-m-d", strtotime($tgl));
        $ubah    = gmdate($newDate, time() + 60 * 60 * 8);
        $pecah   = explode(" ", $ubah);
        $pecah2  = explode("-", $pecah[0]);
        $tanggal = $pecah2[2];
        $bulan   = sbulan($pecah2[1]);
        $tahun   = $pecah2[0];
        return $tanggal . ' ' . $bulan;
    }
    public static function hitungHari($awal, $akhir)
    {
        $awal  = date("Y-m-d", strtotime($awal));
        $akhir = date("Y-m-d", strtotime($akhir));
        //$akhir = date_format($akhir,"Y - m - d");

        $tglAwal  = strtotime($awal);
        $tglAkhir = strtotime($akhir);
        $jeda     = abs($tglAkhir - $tglAwal);
        return floor($jeda / (60 * 60 * 24));
    }
    public static function hitungHariNoAbs($awal, $akhir)
    {
        $awal  = date("Y-m-d", strtotime($awal));
        $akhir = date("Y-m-d", strtotime($akhir));
        //$akhir = date_format($akhir,"Y - m - d");

        $tglAwal  = strtotime($awal);
        $tglAkhir = strtotime($akhir);
        $jeda     = ($tglAkhir - $tglAwal);
        return floor($jeda / (60 * 60 * 24));
    }
    public static function mondayOfTheWeek($date)
    {
        $week = date('W', strtotime($date));
        $year = date('Y', strtotime($date));

        $timestamp            = mktime(0, 0, 0, 1, 1, $year) + ($week * 7 * 24 * 60 * 60);
        $timestamp_for_monday = $timestamp - 86400 * (date('N', $timestamp) - 1);
        $date_for_monday      = date('Y-m-d', $timestamp_for_monday);
        return $date_for_monday;
    }
    public static function tgl_hijriah($tgl)
    {
        $tgl   = format_tanggal($tgl, 'Y-m-d');
        $pecah = explode("-", $tgl);
        $y     = $pecah[0];
        $m     = $pecah[1];
        $d     = $pecah[2];
        $jd    = GregoriantoJD($m, $d, $y);
        $l     = $jd - 1948440 + 10632;
        $n     = (int) (($l - 1) / 10631);
        $l     = $l - 10631 * $n + 354;
        $j     = ((int) ((10985 - $l) / 5316)) * ((int) ((50 * $l) / 17719)) + (
            (int) ($l / 5670)) * ((int) ((43 * $l) / 15238));
        $l = $l - ((int) ((30 - $j) / 15)) * ((int) ((17719 * $j) / 50)) - (
            (int) ($j / 16)) * ((int) ((15238 * $j) / 43)) + 29;
        $m = (int) ((24 * $l) / 709);
        $d = $l - (int) ((709 * $m) / 24);
        $y = 30 * $n + $j - 30;

        $Hijriah['year']  = $y;
        $Hijriah['month'] = $m;
        $Hijriah['day']   = $d;

        return $Hijriah;
    }

    public function pages_load($page) {}
    public function pages_footer($page)
    {

        return '
   		<div id="snackbar">
			<div id="classType" class="" role="alert">
				<div class="d-flex">
					<div id="svg_content">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<circle cx="12" cy="12" r="9"></circle>
							<line x1="12" y1="8" x2="12" y2="12"></line>
							<line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
					</div>
					<div id="pesan">
						Your account has been deleted and cant be restored.
					</div>
				</div>
				<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
			</div>
		</div>
   		';
    }

    public static function checking_daftar_proses($fai, $page, $type, $id)
    {
        $id_done = 1;
        if (isset($_SESSION[$page['load']['login-session-utama']['session_name'] . "_daftar"]) and $type != 'save_daftar') {
            $type = 'daftar';

            DB::connection($page);
            $database['utama']       = $page['load']['login-database'];
            $database['primary_key'] = $page['load']['login-session-utama']['database_row'];
            $database['where'][]     = [$page['load']['login-session-utama']['database_row'], '=', $_SESSION[$page['load']['login-session-utama']['session_name'] . "_daftar"]];
            $row_base_daftar         = $fai->database_coverter($page, $database, null);
            $row_daftar_step         = $page['load']['login-row']['step'];
            $id_done                 = $row_base_daftar[0]->$row_daftar_step;
            $id                      = $page['load']['login-daftar-array']['step'][$id_done]['next'];
        }
        $return['now_id'] = $id_done;
        $return['id']     = $id;
        $return['type']   = $type;
        return $return;
    }

    public static function parsing_text($fai, $page, $crud_inline, $data = [])
    {
        $crud_inline_temp   = $crud_inline;
        $crud_inline_string = "";
        if (strpos($crud_inline, '???')) {
            $excrud_inline = explode("???", $crud_inline);

            for ($ci = 0; $ci < count($excrud_inline); $ci++) {
                $crud_inline     = $excrud_inline[$ci];
                $temp            = $crud_inline;
                $sub_string_awal = substr($crud_inline, (strpos($crud_inline, '!!!') + 3));

                $ex_string = explode(':', $sub_string_awal);

                if ($ex_string[0] == 'var') {
                    $to_string  = $ex_string[1];
                    $new_string = $$to_string;
                } else if ($ex_string[0] == 'session') {
                    $to_string = $ex_string[1];
                    if ($to_string == 'utama') {
                        if (isset($page['load']['login-session-utama']['session_name'])) {
                            $new_string = $_SESSION[$page['load']['login-session-utama']['session_name']];
                        } else {
                            $new_string = "";
                        }
                    } else if ($to_string == 'utama_daftar') {
                        if (isset($page['load']['login-session-utama']['session_name'])) {
                            $new_string = $_SESSION[$page['load']['login-session-utama']['session_name'] . "_daftar"];
                        } else {
                            $new_string = "";
                        }
                    }
                } else if ($ex_string[0] == 'row') {
                    $to_string = $ex_string[1];
                    if ($page['section'] == 'viewsource') {
                        $new_string = '$data->' . $to_string;
                    } else {
                        $new_string = ($data->$to_string ?? "");
                    }
                } else {

                    $new_string = "";
                }

                $crud_inline = str_replace('!!!' . $sub_string_awal, $new_string, $crud_inline);

                $crud_inline_string .= $crud_inline;
            }
        } else {
            $crud_inline_string = $crud_inline;
        }
        return $crud_inline_string;
    }

    public static function urlframework($template, $url)
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $suffix = "";
        if ($_SERVER['SERVER_NAME'] == 'localhost') {

            $suffix = "/FrameworkServer_v1";
        }
        return $protocol . $_SERVER['SERVER_NAME'] . $suffix . '/FaiFramework/Pages/_template/' . $template . '/' . $url;
    }
    public static function urlframework_pages($template, $url)
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $suffix = "";
        if ($_SERVER['SERVER_NAME'] == 'localhost') {

            $suffix = "/FrameworkServer_v1";
        }
        return $protocol . $_SERVER['SERVER_NAME'] . $suffix . '/FaiFramework/Pages/' . $template . '/' . $url;
    }
    public static function urlframework_template()
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $suffix = "";
        if ($_SERVER['SERVER_NAME'] == 'localhost') {

            $suffix = "/FrameworkServer_v1";
        }
        return $protocol . $_SERVER['SERVER_NAME'] . $suffix . '/FaiFramework/Pages/_template/';
    }
    public static function urlframework_struktur($template, $url)
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        return $protocol . $_SERVER['SERVER_NAME'] . '/FaiFramework/Structure/' . $template . '/' . $url;
    }
    public static function rupiah($angka, $decimal = 0, $cur = 'Rp ')
    {
        $angka        = ! empty($angka) ? $angka : 0;
        $ex_angka     = explode(' - ', $angka);
        $hasil_rupiah = '';
        for ($i = 0; $i < count($ex_angka); $i++) {
            $hasil_rupiah .= $cur . number_format((int) $ex_angka[$i], $decimal, ',', '.');
            if ($i != count($ex_angka) - 1) {
                $hasil_rupiah .= ' - ';
            }
        }

        return $hasil_rupiah;
    }

    public static function random($panjang_karakter)
    {
        $karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        $string        = '';
        $split         = str_split($karakter);
        $panjang_split = count($split);
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, $panjang_split - 1);
            $string .= $split[$pos];
        }
        return $string;
    }
    public static function randomaplpanum($panjang_karakter)
    {
        $karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string        = '';
        $split         = str_split($karakter);
        $panjang_split = count($split);
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, $panjang_split - 1);
            $string .= $split[$pos];
        }
        return $string;
    }
    public static function random_str($panjang_karakter)
    {
        $karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string        = '';
        $split         = str_split($karakter);
        $panjang_split = count($split);
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, $panjang_split - 1);
            $string .= $split[$pos];
        }
        return $string;
    }
    public static function random_low_num($panjang_karakter)
    {
        $karakter      = '1234567890abcdefghijklmnopqrstuvwxyz';
        $string        = '';
        $split         = str_split($karakter);
        $panjang_split = count($split);
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, $panjang_split - 1);
            $string .= $split[$pos];
        }
        return $string;
    }
    public static function random_num($panjang_karakter)
    {
        $karakter      = '1234567890';
        $string        = '';
        $split         = str_split($karakter);
        $panjang_split = count($split);
        for ($i = 0; $i < $panjang_karakter; $i++) {
            $pos = rand(0, $panjang_split - 1);
            $string .= $split[$pos];
        }
        return $string;
    }
    public static function formatPhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters except the "+" symbol
        $cleanNumber = preg_replace('/[^\d+]/', '', $phoneNumber);

        // Check if the number starts with a "+" and remove it
        if (strpos($cleanNumber, '+') === 0) {
            $cleanNumber = substr($cleanNumber, 1);
        }

        // If the number starts with the country code (e.g., 62 for Indonesia), keep it
        // Otherwise, add a default country code if necessary
        $countryCode = '62'; // Default country code
        if (strpos($cleanNumber, $countryCode) !== 0) {
            $cleanNumber = $countryCode . $cleanNumber;
        }

        return $cleanNumber;
    }
    public static function get_board_user($fai, $page)
    {

        //list_user_in_board -> untuk di dalam
        $id_board = $page['load']['board'];
        // $panel = FaiCommandTest::get_list_panel();
        // $list_id = $panel['im_id_organisasi'];
        $list_user = [];
        DB::queryRaw($page, "select * from web__list_apps_board__user_list
        where id_web__list_apps_board = " . $id_board . "");
        $get = DB::get('all');
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                if (! in_array($row->id_user, $list_user)) {

                    $list_user[] = $row->id_user;
                }
            }
        }

        DB::queryRaw($page, "select *,hcms__struktur__anggota.id as id_anggota


                            from web__list_apps_board__entitas
                                left join hcms__struktur__anggota on hcms__struktur__anggota.id_organisasi = web__list_apps_board__entitas.id_organisasi
                                left join apps_user on  id_user = apps_user.id

                                where id_web__list_apps_board = " . $id_board . "
                                and
                                (case when semua_anggota='1' then 1
                                    when semua_anggota='2' then (
                                        select count(*) from hcms__struktur__anggota__jabatan aj
                                        left join hcms__struktur__jabatan k on k.id = aj.id_jabatan
                                        join web__list_apps_board__entitas__divisi mk on k.id_divisi = mk.id_divisi
                                        where aj.id_hcms__struktur__anggota = hcms__struktur__anggota.id
                                    )
                                end )>=1

                                ");
        $get = DB::get('all');
        if ($get['num_rows']) {

            foreach ($get['row'] as $row) {
                if (! in_array($row->id_apps_user, $list_user) and $row->id_apps_user) {
                    $list_user[] = $row->id_apps_user;
                }
            }
        }

        return $list_user;
    }

    public static function menu_workspace_role_apps_menu($page)
    {

        if (! isset($page['configuration'])) {
            $page = Configuration::template_base($page['template'], $page);
        }
        if (isset($page['configuration'])) {

            $configuration          = $page['configuration'];
            $return_menu            = "";
            $board_apps['select'][] = '*';
            $board_apps['select'][] = 'web__list_apps_board__apps.id_apps';
            $board_apps['utama']    = 'web__list_apps_board__apps';
            $board_apps['join'][]   = ['web__list_apps', 'web__list_apps.id', "web__list_apps_board__apps.id_apps"];
            $board_apps['join'][]   = ['web__menu', 'web__menu.id', "web__list_apps.id_first_menu"];
            $board_apps['where'][]  = ['web__list_apps_board__apps.id_web__list_apps_board', '=', $page['load']['board']];
            $board_apps['where'][]  = ['web__list_apps_board__apps.id_apps', ' in ', "
								(select distinct(id_apps) from web__list_apps_board__menu
									join web__list_apps_menu on id_apps_menu = web__list_apps_menu.id
									where id_web__list_apps_board = " . $page['load']['board'] . "
									)"];
            $board_apps['order'][] = ["web__list_apps.urutan_workspace", "asc"];
            $board_apps['order'][] = ["web__list_apps_board__apps.urutan", "asc"];
            // $board_apps['group'][] = ("web__list_apps_board__apps.id_apps  ");
            $board_apps = Database::database_coverter($page, $board_apps, [], 'all');

            $menu  = [];
            $iapps = Partial::input('id');

            if (! empty($_SESSION['board_role-' . $page['load']['board']])) {
                //echo 'ada board-role';
                $query = " SELECT * from web__list_apps_board__role__akses
				where id=" . $_SESSION['board_role-' . $page['load']['board']];
                $db = DB::fetchResponse(DB::select($query));
                if ($db[0]->semua_menu == 1) {

                    $query = "SELECT * from web__list_apps_board__menu
						left join web__list_apps_menu on id_apps_menu = web__list_apps_menu.id
						where id_web__list_apps_board=" . $page['load']['board'] . "
						and web__list_apps_board__menu.active=1
						and web__list_apps_menu.active=1";
                    $menu = Partial::get_menu($page, $query, 'id_apps_menu', 'get_array');
                } else {

                    $query = "SELECT *,web__list_apps_board__role__akses__menu.id_menu as id_apps_menu
					from web__list_apps_board__role__akses__menu
					left  join web__list_apps_menu on web__list_apps_board__role__akses__menu.id_menu = web__list_apps_menu.id
					where
							id_web__list_apps_board__role__akses=" . $_SESSION['board_role-' . $page['load']['board']] . "
							and web__list_apps_menu.active=1
							and web__list_apps_board__role__akses__menu.active=1
							and web__list_apps_menu.active=1
							and akses_menu='1' ";
                    $menu = Partial::get_menu($page, $query, 'id_apps_menu', 'get_array');
                }
            }

            if (! count($menu) and $page['load']['apps']) {

                $Apps     = $page['load']['apps'];
                $function = "menu_";
                $menu     = $Apps::menu_basic();
            } else {
                $return_menu = Partial::navbar_menu($page, $menu, $configuration);
            }
        } else {
            $return_menu = '';
        }
        return $return_menu;
    }

    public static function array_website($page, $content_return, $array, $key_array, $i, $database, $database_list_template = [], $database_list_template_on_list = [], $database_list_template_on_list_on_list = [], $database_list_template_on_list_on_list_on_list = [])
    {

        $fai                                                           = new MainFaiFramework();
        $page['row']['database']                                       = $database;
        $page['row_database']['database_list_template']                = $database_list_template;
        $page['row']['database_list_template_on_list']                 = $database_list_template_on_list;
        $page['row']['database_list_template_on_list_on_list']         = $database_list_template_on_list_on_list;
        $page['row']['database_list_template_on_list_on_list_on_list'] = $database_list_template_on_list_on_list_on_list;
        $prefix                                                        = "";

        if (isset($array['prefix'])) {
            $prefix = $array['prefix'];
        }
        $sufix = "";
        if (isset($array['sufix'])) {
            $sufix = $array['sufix'];
        }
        if (! isset($array['content_source']) and isset($array['source_list'])) {
            $array['content_source'] = $array['source_list'];
        }
        if (! isset($array['refer']) and ! isset($array['template_content'])) {
            $array['refer'] = "text";
            $array['text']  = "";
        } else if (! isset($array['refer']) and isset($array['template_content'])) {
            $array['refer'] = "content_template";
        }
        $array['refer'] = trim($array['refer']);

        if (in_array($key_array, Bundlecontent::router($page, 'array', $array))) {
            $content_return = str_ireplace("<$key_array></$key_array>", Bundlecontent::router($page, 'content', $array, $key_array), $content_return);
        } else if ($array['refer'] == 'text') {
            if ($array['text']) {
                $row_array = Database::string_database($page, $fai, $array['text']);
            } else {
                $row_array = $array['refer'];
            }

            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
            // } else if (in_array($key_array,Bundlecontent::router($page,'array',$array))) {
            // 	$content_return = str_ireplace("<$key_array></$key_array>", Bundlecontent::router($page,'array',$array,$key_array), $content_return);
        } else if ($array['refer'] == 'crud') {
            $page_temp                           = $page;
            $page_temp['load']['type']           = "tambah";
            $page_temp['title']                  = "";
            $page_temp['database']               = $array['database'];
            $page_temp['crud']['database_utama'] = $array['database']['utama'];
            $page_temp['section_initialize']     = "crud_utama";
            if (isset($array['template_crud'])) {
                $page_temp['load']['crud_template']['vte'] = $array['template_crud'];
            }
            for ($i = 0; $i < count($array['array']); $i++) {
                $field = $array['array'][$i][1];

                $field_array[$field] = $i;
                $type                = $array['array'][$i][2];
                $extype              = explode('-', $type);
                $result              = Packages::initialize_array($fai, $page_temp, $array, $i, $field, $type, $extype);

                $page_temp = $result['page'];
                $array     = $result['array'];

                if (isset($page_temp['crud']['costum_class'][$field])) {
                    if (! stripos($page_temp['crud']['costum_class'][$field], $page_temp['database']['utama'] . "__" . $field . "_0")) {
                        $page_temp['crud']['costum_class'][$field] .= $page_temp['database']['utama'] . "__$field" . "_0";
                    }
                } else {
                    $page_temp['crud']['costum_class'][$field] = $page_temp['database']['utama'] . "__$field" . "_0";
                }
            }

            $page_temp['crud']          = $array['crud'];
            $page_temp['crud']['array'] = $array['array'];

            $content_return = str_replace("<$key_array></$key_array>", Packages::crud($page_temp, 'tambah', -1), $content_return);
        } else if ($array['refer'] == 'database') {

            $row_array   = $array['row'];
            $row_array   = trim($row_array);
            $to_database = $database;
            if (! isset($to_database->$row_array) and ($database_list_template)) {
                $to_database = $database_list_template;
            }
            if (! isset($to_database->$row_array) and ($database_list_template_on_list)) {
                $to_database = $database_list_template_on_list;
            }
            if (! isset($to_database->$row_array) and ($database_list_template_on_list_on_list)) {
                $to_database = $database_list_template_on_list_on_list;
            }
            $content_return = str_replace("<$key_array></$key_array>", $prefix . ($to_database->$row_array) . $sufix, $content_return);
        } else if ($array['refer'] == 'database_multiple') {
            $text_db = "";
            $get_row = $array['row'];
            for ($d = 0; $d < count($get_row); $d++) {
                if ($get_row[$d][1] == 'text') {

                    $text_db .= $get_row[$d][0];
                } else {

                    $row_array   = trim($get_row[$d][0]);
                    $to_database = $database;
                    if (! isset($to_database->$row_array) and ($database_list_template)) {
                        $to_database = $database_list_template;
                    }
                    if (! isset($to_database->$row_array) and ($database_list_template_on_list)) {
                        $to_database = $database_list_template_on_list;
                    }
                    if (! isset($to_database->$row_array) and ($database_list_template_on_list_on_list)) {
                        $to_database = $database_list_template_on_list_on_list;
                    }
                    $text_db .= $to_database->$row_array;
                }
            }
            $content_return = str_replace("<$key_array></$key_array>", $prefix . ($text_db) . $sufix, $content_return);
        } else if ($array['refer'] == 'string_database') {
            $row_array      = $array['row'];
            $content_return = str_replace("<$key_array></$key_array>", $prefix . Database::string_database($page, $fai, $row_array) . $sufix, $content_return);
        } else if ($array['refer'] == 'template') {
            // 			$array['source_list'] = $array['refer'];
            $content_return_list = Partial::database_list_view_website($page, $array, $content_return);
            $content_return      = str_replace("<$key_array></$key_array>", $content_return_list, $content_return);
        } else if ($array['refer'] == 'content_template') {

            $content_template        = Partial::content_source($page, $array);
            $return_content_template = "";
            if (isset($array['template_array']) and (isset($array['template_array']) ? (count($array['template_array']) ? 1 : 0) : 0)) {
                $temp_template = $content_template;

                for ($ict = 0; $ict < count($array['template_array']); $ict++) {
                    if (count($array['template_array'][$ict])) {
                        $tag_template  = $array['template_array'][$ict]['tag'];
                        $temp_template = Partial::array_website($page, $temp_template, $array['template_array'][$ict], $tag_template, $ict, $database, $database_list_template, $database_list_template_on_list, $database_list_template_on_list_on_list, $database_list_template_on_list_on_list_on_list);
                    }
                }
                $return_content_template .= $temp_template;
            } else {
                $return_content_template = $content_template;
            }

            $content_return = str_replace("<$key_array></$key_array>", $return_content_template, $content_return);
        } else if ($array['refer'] == 'database_function') {
            $class            = $array['class'];
            $strutktur_folder = ucfirst(strtolower($array['struktur']));

            if ($array['struktur'] !== '!!!') {

                require_once __DIR__ . "../../../Structure/Controller/" . $strutktur_folder . "_class/$class.php";
                $new = new $class();
            }

            $row_array                        = $array['row'];
            $function                         = $array['function'];
            $page['array_website']['thisrow'] = ($database->$row_array);

            $parameter1 = isset($array['parameter'][0]) ? Database::string_database($page, $fai, $array['parameter'][0]) : null;
            $parameter2 = isset($array['parameter'][1]) ? Database::string_database($page, $fai, $array['parameter'][1]) : null;
            $parameter3 = isset($array['parameter'][2]) ? Database::string_database($page, $fai, $array['parameter'][2]) : null;
            $parameter4 = isset($array['parameter'][3]) ? Database::string_database($page, $fai, $array['parameter'][3]) : null;
            $parameter5 = isset($array['parameter'][4]) ? Database::string_database($page, $fai, $array['parameter'][4]) : null;
            $parameter6 = isset($array['parameter'][5]) ? Database::string_database($page, $fai, $array['parameter'][5]) : null;
            $parameter7 = isset($array['parameter'][6]) ? Database::string_database($page, $fai, $array['parameter'][6]) : null;
            $parameter8 = isset($array['parameter'][7]) ? Database::string_database($page, $fai, $array['parameter'][7]) : null;
            if (isset($page['function'][$strutktur_folder][$class][$function][$parameter1][$parameter2][$parameter3][$parameter4][$parameter5][$parameter6][$parameter7][$parameter8])) {
                $info = $page['function'][$strutktur_folder][$class][$function][$parameter1][$parameter2][$parameter3][$parameter4][$parameter5][$parameter6][$parameter7][$parameter8];
            } else {
                if ($array['struktur'] !== '!!!') {
                    $info = $new->$function($page, $page['load']['type'], $page['load']['id'], $parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6, $parameter7, $parameter8);
                } else {
                    $info = $class::$function($parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6, $parameter7, $parameter8);
                }
            }

            $content_return = str_replace("<$key_array></$key_array>", $prefix . $info . $sufix, $content_return);
        } else if ($array['refer'] == 'menu_list') {
            $return_menu = "";
            for ($im = 0; $im < count($array['parameter']); $im++) {

                $content_menu_file = Partial::html_decode($page, '', '', $array['file_menu']);
                $content_menu_file = str_replace("<NAMA-MENU></NAMA-MENU>", $array['parameter'][$im]['nama_menu'], $content_menu_file);
                $content_menu_file = str_replace("<ICON></ICON>", $array['parameter'][$im]['icon'], $content_menu_file);
                $content_menu_file = str_replace("<CLASS-ACTIVE></CLASS-ACTIVE>", "", $content_menu_file);

                $content_menu_file = str_replace("<LINK></LINK>", Partial::link_direct($page, $page['load']['link_route'], [
                    $array['parameter'][$im]['link'][0],
                    $array['parameter'][$im]['link'][1],
                    $array['parameter'][$im]['link'][2],
                    $array['parameter'][$im]['link'][3],
                    $array['parameter'][$im]['link'][4],
                    $array['parameter'][$im]['link'][5],
                    $array['parameter'][$im]['link'][6],
                    $array['parameter'][$im]['link'][7],
                    $array['parameter'][$im]['link'][8],
                    $array['parameter'][$im]['link'][9],
                ], 'menu', 'just_link'), $content_menu_file);

                $return_menu .= $content_menu_file;
            }
            $return_menu;
            $content_return = str_replace("<$key_array></$key_array>", $return_menu, $content_return);
        } else if ($array['refer'] == 'workspace_list_panel') {
            $return_menu = ' <div style="display: block;">
				<label>Panel</label>
				<select class="form-control" id="panel-' . $page['load']['board'] . '" onchange="direct_panel(this,' . $page['load']['board'] . ')">
          	';
            if (count($page['get_panel']['panel_list'])) {
                foreach ($page['get_panel']['panel_list'] as $i => $panel_list) {
                    $return_menu .= '<option value="' . $panel_list['id_panel'] . '" ' . ($_SESSION['board_role-' . $page['load']['board']] == $panel_list['id_panel'] ? 'selected' : '') . '>' . $panel_list['nama_panel'] . '</option>';
                }
            }
            $return_menu .= '
				</select>

			</div>';
            $content_return = str_replace("<$key_array></$key_array>", $return_menu, $content_return);
        } else if ($array['refer'] == 'workspace_list_role') {
            $role['utama']   = 'web__list_apps_board__role__akses';
            $role['where'][] = ['id_web__list_apps_board', '=', $page['load']['board']];
            $role['where'][] = ['id', ' in ', "(select distinct(id_role) from web__list_apps_board__role__user where id_web__list_apps_board=" . $page['load']['board'] . " and id_user=" . $_SESSION['id_apps_user'] . ")"];
            $role            = Database::database_coverter($page, $role, [], 'all');

            $return_menu = ' <div style="display: block;">
				<label>Role</label>
        		lect class="form-control" id="role-' . $page['load']['board'] . '" onchange="direct_role(this,' . $page['load']['board'] . ')">
        	';
            if ($role['num_rows']) {
                foreach ($role['row'] as $role) {
                    $return_menu .= '<option value="' . $role->id . '" ' . ($_SESSION['board_role-' . $page['load']['board']] == $role->id ? 'selected' : '') . '>' . $role->nama_role . '</option>';
                }
            }

            $return_menu .= '
				</select>

			</div>';
            $content_return = str_replace("<$key_array></$key_array>", $return_menu, $content_return);
        } else if ($array['refer'] == 'menu_workspace_role_apps_menu') {
            // echo 'HALLOOWWW EVEry body';
            $return_menu = Partial::menu_workspace_role_apps_menu($page);
            // echo '<pre>';

            $content_return = str_replace("<$key_array></$key_array>", $return_menu, $content_return);
        } else if ($array['refer'] == 'image_banner_list') {

            $return_menu = "";

            foreach (($array['banner_list']) as $key_id => $value_banner) {
                $content_menu_file = Partial::html_decode($page, '', '', $array['template_content']);
                $content_menu_file = str_replace("<IMAGE></IMAGE>", $value_banner['image'], $content_menu_file);
                $content_menu_file = str_replace("<HEADER-IMAGE></HEADER-IMAGE>", $value_banner['header'], $content_menu_file);
                $content_menu_file = str_replace("<DESKRIPSI-IMAGE></DESKRIPSI-IMAGE>", $value_banner['deskripsi'], $content_menu_file);
                //deskripsi_link
                $ex = explode('!', $value_banner['deskripsi_link']);

                $content_menu_file = str_replace("<DESKRIPSI-LINK-KE></DESKRIPSI-LINK-KE>", (isset($ex[0]) ? $ex[0] : ''), $content_menu_file);
                if (isset($ex[1])) {

                    if ($ex[1] == 'function') {

                        $content_menu_file = str_replace("<LINK-KE></LINK-KE>", Partial::link_direct($page, $page['load']['link_route'], [
                            (isset($ex[2]) ? $ex[2] : ''), //0
                            (isset($ex[3]) ? $ex[3] : ''), //1
                            (isset($ex[4]) ? $ex[4] : ''),
                            (isset($ex[5]) ? $ex[5] : ''),
                            (isset($ex[6]) ? $ex[6] : ''),
                            (isset($ex[7]) ? $ex[7] : ''),
                            (isset($ex[8]) ? $ex[8] : ''),
                            (isset($ex[9]) ? $ex[9] : ''),
                        ], 'menu', 'just_link'), $content_menu_file);
                    }
                }
                $return_menu .= $content_menu_file;
            }
            $return_menu;
            $content_return = str_replace("<$key_array></$key_array>", $return_menu, $content_return);
        } else if ($array['refer'] == 'link') {

            if (isset($array['route_type'])) {
                $page['route_type'] = $array['route_type'];
            }

            $link = Partial::link_direct($page, $page['load']['link_route'], $array['link']);

            $content_return = str_replace("<$key_array></$key_array>", $link, $content_return);
        } else if ($array['refer'] == 'link_row_database') {
            //$row_array = $array['row'];
            $apps      = $array['apps'];
            $page_view = $array['page_view'];
            $type      = $array['type'];
            if ($array['menu']) {
                $menu = $array['menu'];
            }

            if ($array['nav']) {
                $nav = $array['nav'];
            }

            if ($array['id']) {
                $id = $array['id'];
            }

            $apps      = ($database_list_template_on_list->$apps ?? "");
            $page_view = ($database_list_template_on_list->$page_view ?? "");
            $type      = ($database_list_template_on_list->$type ?? "");
            $menu      = ($database_list_template_on_list->$menu ?? "");
            $nav       = ($database_list_template_on_list->$nav ?? "");
            $id        = ($database_list_template_on_list->$id ?? "");
            if (isset($array['route_type'])) {
                $page['route_type'] = $array['route_type'];
            }

            // $link = "Partial::route_v($page, $page['load']['route_page'], array($array['page_view'], $array['id']))";
            $link = Partial::link_direct($page, $page['load']['link_route'], [$apps, $page_view, $type, $id, $menu, $nav]);

            $content_return = str_replace("<$key_array></$key_array>", $link, $content_return);
        } else if ($array['refer'] == 'function') {

            $key_array;
            $strutktur_folder = ucfirst(strtolower($array['struktur']));
            $class            = $array['class'];
            if ($strutktur_folder) {
                require_once __DIR__ . "../../../Structure/" . $strutktur_folder . "_class/$class.php";
            }

            $new      = new $class();
            $function = $array['function'];

            $parameter1 = isset($array['parameter'][0]) ? Database::string_database($page, $fai, $array['parameter'][0]) : null;
            $parameter2 = isset($array['parameter'][1]) ? Database::string_database($page, $fai, $array['parameter'][1]) : null;
            $parameter3 = isset($array['parameter'][2]) ? Database::string_database($page, $fai, $array['parameter'][2]) : null;
            $parameter4 = isset($array['parameter'][3]) ? Database::string_database($page, $fai, $array['parameter'][3]) : null;
            $parameter5 = isset($array['parameter'][4]) ? Database::string_database($page, $fai, $array['parameter'][4]) : null;
            $parameter6 = isset($array['parameter'][5]) ? Database::string_database($page, $fai, $array['parameter'][5]) : null;
            $parameter7 = isset($array['parameter'][6]) ? Database::string_database($page, $fai, $array['parameter'][6]) : null;
            $parameter8 = isset($array['parameter'][7]) ? Database::string_database($page, $fai, $array['parameter'][7]) : null;
            if (isset($page['function'][$strutktur_folder][$class][$function][$parameter1][$parameter2][$parameter3][$parameter4][$parameter5][$parameter6][$parameter7][$parameter8])) {
                $info = $page['function'][$strutktur_folder][$class][$function][$parameter1][$parameter2][$parameter3][$parameter4][$parameter5][$parameter6][$parameter7][$parameter8];
            } else {
                $info = $new->$function($page, $page['load']['type'], $page['load']['id'], $parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6, $parameter7, $parameter8);
            }
            //($info);
            if (isset($array['get_result']) and isset($info[$array['get_result']])) {
                $info = $info[$array['get_result']];
            } else if (isset(($array['get_result'])) and ! isset($info[$array['get_result']])) {
                $info = "";
            }

            $content_return = str_replace("<$key_array></$key_array>", $info, $content_return);
        } else if ($array['refer'] == 'if_first' and $i == 1) {
            $row_array      = $array['text'];
            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
        } else if ($array['refer'] == 'if_first' and $i != 1) {
            $row_array      = '';
            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
        } else if ($array['refer'] == 'if_first_and_not_first' and $i == 1) {
            $row_array      = $array['true'];
            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
        } else if ($array['refer'] == 'if_first_and_not_first' and $i != 1) {
            $row_array      = $array['false'];
            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
        } else if ($array['refer'] == 'if_first' and $i == 1) {
            $row_array      = $array['text'];
            $content_return = str_replace("<$key_array></$key_array>", $row_array, $content_return);
        } else if ($array['refer'] == 'tipe_header') {
            $return = "";
            if ($array['tipe_header'] == 'logo_utama') {
                $sql = DB::fetchResponse(DB::select("select * from drive__file where ref_database='web__apps' and ref_external_id=" . $page['load']['id_web__apps'] . " and CAST(sizes AS SIGNED)>0 order by create_date desc, sizes desc"));
                if ($sql) {
                    $return = ($sql[0]->domain ? $sql[0]->domain : base_url()) . '/uploads/' . $sql[0]->path . '/' . $sql[0]->file_name_save;
                }
            } else
            if ($array['tipe_header'] == 'base_url') {
                $return = base_url();
            }
            $content_return = str_replace("<$key_array></$key_array>", $return, $content_return);
        } else if ($array['refer'] == 'dropdown') {
            $dropdown         = $array['dropdown'];
            $content_dropdown = "";
            foreach ($dropdown as $keys => $values) {
                $content_dropdown .= "<DROPDWON_$keys></DROPDWON_$keys>";
                $content_dropdown = Partial::array_website($page, $content_dropdown, $dropdown[$keys], "DROPDWON_$keys", 0, $database, $database_list_template, $database_list_template_on_list, $database_list_template_on_list_on_list, $database_list_template_on_list_on_list_on_list);
            }
            $content_return = str_replace("<$key_array></$key_array>", $content_dropdown, $content_return);
        } else if ($array['refer'] == 'img_in_database') {

            $content_return = str_replace("<$key_array></$key_array>", Partial::url_file($database), $content_return);
        } else if ($array['refer'] == 'if_database_to_text') {
            $source       = $array['source_database'];
            $row_get_if   = $array['row'];
            $if_get_value = $$source->$row_get_if;
            $return_if    = "";
            $fai          = new MainFaiFramework();
            foreach ($array['if_value'] as $key_if => $value_if) {
                if ($key_if) {
                    if ($if_get_value == Database::string_database($page, $fai, $key_if)) {
                        $return_if = $value_if;
                    }
                }
            }
            if (! $return_if and isset($array['if_else'])) {
                $return_if = $array['if_else'];
            }
            $content_return = str_replace("<$key_array></$key_array>", $return_if, $content_return);
        } else if ($array['refer'] == 'if_database_to_database_list') {

            $source                = $array['source_database'];
            $row_get_if            = $array['row'];
            $if_get_value          = $$source->$row_get_if;
            $return_if             = "";
            $db_refer              = $array['database_refer'];
            $content_array_temp_to = "";

            $dl = 0;
            if ($db_refer <= -1) {
                $database_db = $array['database'];

                if (isset($database_db['where_get_array'])) {
                    for ($wga = 0; $wga < count($database_db['where_get_array']); $wga++) {
                        $var_get_data           = $database_db['where_get_array'][$wga]['get_row'];
                        $array_row              = $database_db['where_get_array'][$wga]['array_row'];
                        $database_db['where'][] = [$database_db['where_get_array'][$wga]['row'], '=', $$array_row->$var_get_data];
                    }
                }
                $page['row_section'][$db_refer] = Database::database_coverter($page, $database_db, [], 'all');
            }
            foreach ($array['if_value'] as $key_if => $value_if) {
                if ($if_get_value == $key_if) {

                    $array_if                  = $array['if_value'][$key_if];
                    $get_database_list_on_list = Partial::content_source($page, $array_if);

                    //LAYER3//
                    //LAYER3//
                    //LAYER3//

                    if ($page['row_section'][$db_refer]['num_rows']) {
                        foreach ($page['row_section'][$db_refer]['row'] as $database_list_template_on_list) {
                            $dl++;
                            $content_array_temp_on_list = $get_database_list_on_list;
                            foreach (($array_if['array']) as $key_array_on_array => $value_array) {

                                $array_on_list = $array_if['array'][$key_array_on_array];

                                $content_array_temp_on_list = Partial::array_website($page, $content_array_temp_on_list, $array_on_list, $key_array_on_array, $dl, $database_list_template_on_list, $database_list_template, $database_list_template_on_list);
                            }

                            $content_array_temp_to .= $content_array_temp_on_list;
                        }
                    }
                }
                //$return_if = $value_if;
            }
            if (! $content_array_temp_to and isset($array['if_else'])) {
                $array_if = $array['if_else'];
                $array_if = $array['if_value'][$key_if];

                $get_database_list_on_list = Partial::content_source($page, $array_if);

                // if (!isset($array_if['content_source']) and isset($array_if['template_name'])) {
                // 	$array_if['content_source'] = "template";
                // 	$array_if['content_source'] = "template";
                // } else if (!isset($array_if['content_source']) and isset($array_if['template_content'])) {
                // 	$array_if['content_source'] = "template_database";
                // }
                // if ($array_if['content_source'] == "template_database") {
                // 	$get_database_list_on_list = Partial::html_decode($page, '', '', $array_if['template_content']);
                // } else
                // 	$get_database_list_on_list = file_get_contents(__DIR__ . '/../../Pages/_template/' .
                // 		$array_if['template_name'] . '/' .
                // 		$array_if['template_file'] . '.php');

                //LAYER3//
                //LAYER3//
                //LAYER3//

                if ($page['row_section'][$db_refer]['num_rows']) {
                    foreach ($page['row_section'][$db_refer]['row'] as $database_list_template_on_list) {
                        $dl++;
                        $content_array_temp_on_list = $get_database_list_on_list;
                        foreach (($array_if['array']) as $key_array_on_array => $value_array) {

                            $array_on_list = $array_if['array'][$key_array_on_array];

                            $content_array_temp_on_list = Partial::array_website($page, $content_array_temp_on_list, $array_on_list, $key_array_on_array, $dl, $database_list_template_on_list, $database_list_template, $database_list_template_on_list);
                        }

                        $content_array_temp_to .= $content_array_temp_on_list;
                    }
                }
            }
            $content_return = str_replace("<$key_array></$key_array>", $content_array_temp_to, $content_return);
            //$content_return = str_replace("<$key_array></$key_array>", $return_if, $content_return);
        } else if ($array['refer'] == 'database_list') {
            if (! isset($array['content_source'])) {
                $array['content_source'] = 'template';
            }

            $get_database_list_on_list = Partial::content_source($page, $array);

            // if ($array['content_source'] == "template_database") {
            // 	$get_database_list_on_list = html_entity_decode(htmlspecialchars_decode($array['template_content']));
            // } else {
            // 	if (!isset($array['template_name'])) {
            // 		echo $key_array . ' Belum Disertai Template Source';
            // 	}
            // 	$get_database_list_on_list = file_get_contents(__DIR__ . '/../../Pages/_template/' .
            // 		$array['template_name'] . '/' .
            // 		$array['template_file'] . '.php');
            // }

            //LAYER3//
            //LAYER3//
            //LAYER3//
            $db_refer              = $array['database_refer'];
            $content_array_temp_to = "";

            $dl = 0;
            if ($db_refer <= -1) {
                $database_db = $array['database'];

                if (isset($database_db['where_get_array'])) {
                    for ($wga = 0; $wga < count($database_db['where_get_array']); $wga++) {
                        $var_get_data = $database_db['where_get_array'][$wga]['get_row'];
                        $array_row    = $database_db['where_get_array'][$wga]['array_row'];

                        if (! empty($$array_row->$var_get_data)) {
                            $database_db['where'][] = [$database_db['where_get_array'][$wga]['row'], '=', $$array_row->$var_get_data];
                        } else {
                            $database_db['where'][] = [1, '=', 0];
                        }
                    }
                }
                $page['row_section'][$db_refer] = Database::database_coverter($page, $database_db, [], 'all');
            }

            $var_get_database = 'database';
            if (! ($database_list_template)) {
                $var_get_database = 'database_list_template';
            } else if ($database_list_template and ! ($database_list_template_on_list)) {
                $var_get_database = 'database_list_template_on_list';
            } else if (($database_list_template_on_list) and ! ($database_list_template_on_list_on_list)) {
                $var_get_database = 'database_list_template_on_list_on_list';
            } else if (($database_list_template_on_list) and ($database_list_template_on_list_on_list) and ! ($database_list_template_on_list_on_list_on_list)) {
                $var_get_database = 'database_list_template_on_list_on_list_on_list';
            }

            if ($page['row_section'][$db_refer]['num_rows']) {
                foreach ($page['row_section'][$db_refer]['row'] as $$var_get_database) {
                    $dl++;
                    $content_array_temp_on_list = $get_database_list_on_list;
                    foreach (($array['array']) as $key_array_on_array => $value_array) {
                        $array_on_list              = $array['array'][$key_array_on_array];
                        $content_array_temp_on_list = Partial::array_website($page, $content_array_temp_on_list, $array_on_list, $key_array_on_array, $dl, $$var_get_database, $database_list_template, $database_list_template_on_list, $database_list_template_on_list_on_list, $database_list_template_on_list_on_list_on_list);
                    }

                    $content_array_temp_to .= $content_array_temp_on_list;
                }
            }

            $content_return = str_replace("<$key_array></$key_array>", $content_array_temp_to, $content_return);
        }
        return $content_return;
    }
    public static function html_decode($page, $view, $id, $string)
    {
        // str_replace(array('&#039;'), array("'"), html_entity_decode(htmlspecialchars_decode
        return str_replace(['&#039;', "{HTTPS}", "{HTTP}"], ["'", "https", "http"], html_entity_decode(htmlspecialchars_decode($string)));
    }
    public static function html_encode($page, $view, $id, $string)
    {
        return htmlentities(htmlspecialchars(str_replace(["'"], ['&#039;'], $string)));
    }
    public static function get_parent_tree($page, $view, $id, $database, $row_from, $id_from, $row_tree, $row_nama, $prefix, $get_result = [], $parent_level = 0)
    {

        $row_tree = trim($row_tree);
        $row_nama = trim($row_nama);
        $row_from = trim($row_from);
        DB::connection($page);
        if ($id_from) {

            DB::table($database);
            DB::whereRaw($database . "." . $row_from . "=" . $id_from);
            $get = DB::get('all');
            if (! isset($get_result['nama'])) {
                $get_result['nama'] = "";
            }
            if ($get['num_rows']) {
                $get_result['parent'][$parent_level]['nama']      = $get['row'][0]->$row_nama;
                $get_result['parent'][$parent_level]['id_row']    = $get['row'][0]->$row_from;
                $get_result['parent'][$parent_level]['id_parent'] = $get['row'][0]->$row_tree;
                $get_result['nama']                               = $get['row'][0]->$row_nama . ($parent_level ? $prefix : '') . " " . $get_result['nama'];
                if ($get['row'][0]->$row_tree) {
                    $parent_level++;
                    $get_result = Partial::get_parent_tree($page, $view, $id, $database, $row_from, $get['row'][0]->$row_tree, $row_tree, $row_nama, $prefix, $get_result, $parent_level);
                }
            }

            return $get_result;
        } else {
            return "";
        }
    }
    public static function content_source($page, $template_array)
    {
        ////////////INITIAL DATA///////////////////
        if (isset($template_array['source']) and ! isset($template_array['content_source'])) {
            $template_array['content_source'] = ($template_array['source']);
        }
        if (isset($template_array['source_list']) and ! isset($template_array['content_source'])) {
            $template_array['content_source'] = ($template_array['source_list']);
        }
        if (! isset($template_array['content_source']) and isset($template_array['template_name'])) {
            $template_array['content_source'] = "template";
            $template_array['content_source'] = "template";
        } else if (! isset($template_array['content_source']) and isset($template_array['template_content'])) {
            $template_array['content_source'] = "template_database";
        } else
        if (! isset($template_array['content_source'])) {
            if (isset($template_array['template_name'])) {
                $template_array['content_source'] = "template";
            } else if (isset($template_array['template_content'])) {
                $template_array['content_source'] = "template_database";
            }
        }
        //////////////////////PROSES DATA///////////////////////////////
        if ($template_array['content_source'] == "template_content") {
            $array = [];
            foreach ($template_array as $key2 => $value2) {
                if (is_int($key2)) {
                    $key2 -= 1;
                }

                $array[0][$key2] = $value2;
            }
            $array[0][0] = $template_array['template_class'];
            $array[0][1] = $template_array['template_function'];
            $return      = TemplateContent::parse_template($page, $array, 0);
        } else if ($template_array['content_source'] == "text") {

            $return = $template_array['content'];
        } else if ($template_array['content_source'] == "template_database") {
            $return = Partial::html_decode($page, '', '', $template_array['template_content']);
        } else if ($template_array['content_source'] == "html") {
            $return = Partial::html_decode($page, '', '', $template_array['html']);
        } else if ($template_array['content_source'] == "file_bundles_database") {
            $func     = $page['template'];
            $template = TemplateContent::$func($page, $template_array['template_code']);
            // print_R($template);
            if (isset($template[$template_array['template_code']]['content'])) {
                // echo 'test2';
                $array_template   = [];
                $array_template[] = [$page['template'], $template_array['template_code']];
                $content_template = TemplateContent::parse_template($page, $array_template, 0);
                $return           = $content_template;
                // echo $return;
            } else {
                // echo 'test2';

                $sql = "select * from website__template__master__kategori
			left join website__template__file on website__template__file.id_kategori = website__template__master__kategori.id
			left join website__template__list on website__template__file.id_template = website__template__list.id
			where kode_kategori = '" . $template_array['template_code'] . "' and website__template__list.nama_template='" . $page['template'] . "'";
                DB::queryRaw($page, $sql);
                $get = DB::get('all');

                if ($get['num_rows']) {

                    $return = Partial::html_decode($page, '', '', $get['row'][0]->kontent_file);
                } else {
                    $return = '';
                }
            }
        } else {
            // echo Partial::urlframework($template_array['template_name'] , $template_array['template_file'] . '.php');
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ],
            ]);

            $return = file_get_contents(Partial::urlframework($template_array['template_name'], $template_array['template_file'] . '.php'), false, $context);
        }
        // echo '<textarea>'.$return.'</textarea>';
        return $return;
    }
    public static function database_list_view_website($page, $template_array, $temp)
    {
        $db_refer          = $template_array['database_refer'];
        $source_list       = $template_array['source_list'];
        $content_array     = "";
        $get_database_list = Partial::content_source($page, $template_array);
        // if ($source_list == 'template') {
        // 	$get_database_list = file_get_contents(Partial::urlframework(
        // 		$template_array['template_name'],
        // 		$template_array['template_file'] . '.php'
        // 	));
        // } else if ($source_list == 'template_database') {
        // 	$get_database_list = Partial::html_decode($page, '', '', $template_array['template_content']);;
        // }
        $a             = 0;
        $database_true = true;
        if (isset($template_array['database_refer'])) {
            $db_refer = $template_array['database_refer'];
            if ($db_refer <= -1) {
                $database_db = $template_array['database'];

                if (isset($database_db['where_get_array'])) {
                    for ($wga = 0; $wga < count($database_db['where_get_array']); $wga++) {
                        $var_get_data = $database_db['where_get_array'][$wga]['get_row'];
                        $array_row    = $database_db['where_get_array'][$wga]['array_row'];
                        if (isset($$array_row->$var_get_data)) {
                            $string                 = ! is_numeric($$array_row->$var_get_data) ? "'" : '';
                            $database_db['where'][] = [$database_db['where_get_array'][$wga]['row'], '=', $string . ($$array_row->$var_get_data) . $string];
                        }
                        if ($array_row == 'text') {
                            $string                 = ! is_numeric($var_get_data) ? "'" : '';
                            $database_db['where'][] = [$database_db['where_get_array'][$wga]['row'], '=', $string . $var_get_data . $string];
                        }
                    }
                }
                $page['row_section'][$db_refer] = Database::database_coverter($page, $database_db, [], 'all');
            }
            if (! isset($page['row_section'][$db_refer])) {
                $database_true = false;
            }
        }

        if (isset($template_array['database_refer']) and $database_true) {
            // echo 'masuk1';
            $content_array = $temp;
            if ($page['row_section'][$db_refer]['num_rows']) {
                foreach ($page['row_section'][$db_refer]['row'] as $database_list_template) {

                    $a++;
                    $content_array_temp = $get_database_list;
                    // $template_array = $temp;
                    if (isset($template_array['array'])) {
                        foreach ($template_array['array'] as $key_array => $value_array) {

                            $array              = $template_array['array'][$key_array];
                            $content_array_temp = Partial::array_website($page, $content_array_temp, $array, $key_array, $a, $database_list_template, $database_list_template);
                        }
                    }
                    $content_array .= $content_array_temp;
                }
            }
        } else {
            // echo 'masuk2';
            $content_array_temp = $get_database_list;
            // $template_array = $temp;
            if (isset($template_array['array'])) {

                foreach ($template_array['array'] as $key_array => $value_array) {
                    $array              = $template_array['array'][$key_array];
                    $content_array_temp = Partial::array_website($page, $content_array_temp, $array, $key_array, 0, $page['row']['database'], $page['row']['database_list_template']);
                }
            }
            $content_array .= $content_array_temp;
        }
        return $content_array;
    }
    public static function content_menu($page, $tipe_menu)
    {
        $return = [];
        if (isset($page['load']["id_" . $tipe_menu . "_template"])) {
            $$tipe_menu = DB::fetchResponse(DB::select("select *

				from web__template
				where web__template.id=" . $page['load']["id_" . $tipe_menu . "_template"] . ""));
            if (count($$tipe_menu)) {

                $return["template_name"] = $$tipe_menu[0]->folder_template;
                $tipe_file               = $tipe_menu . "_file";
                $return["template_file"] = $$tipe_menu[0]->$tipe_file;
                $return["session_name"]  = "hak_akses";
            }
        }
        if (isset($page['load']['id_web__apps'])) {
            $get = DB::fetchResponse(DB::select("select *,web__apps__menubar.id as primary_key
                                    from web__apps__menubar
                                    where id_web__apps=" . $page['load']['id_web__apps'] . " and tipe_menu='$tipe_menu'"));

            $i = 0;

            if (($get)) {
                foreach ($get as $navbar) {
                    $return["content_array"][$i]['tipe']           = $navbar->content_dropdown;
                    $return["content_array"][$i]['source']         = $navbar->source;
                    $return["content_array"][$i]['tag']            = $navbar->tag;
                    $return["content_array"][$i]['folder_tag']     = $navbar->folder_tag;
                    $return["content_array"][$i]['file_tag']       = $navbar->file_tag;
                    $return["content_array"][$i]['database_refer'] = $navbar->database_refer;

                    $return["content_array"][$i] += Partial::content_database($page, $navbar->primary_key);
                    $return["content_array"][$i] += Partial::content_tag($page, $navbar->primary_key);
                    $return["content_array"][$i] += Partial::content_dropdown($page, $navbar->primary_key);

                    $i++;
                }
            }
            echo json_encode($return);
            return $return;
        }
    }
    public static function content_tag($page, $primary_key, $type = '')
    {
        $get = DB::fetchResponse(DB::select("select *
											from web__apps__menubar_tag
											where id_web__apps__menubar$type=$primary_key "));
        $return = [];
        if (($get)) {
            $it = 0;
            foreach ($get as $tag) {
                $return['content_tag'][$it]['tag']            = $tag->tag;
                $return['content_tag'][$it]['source']         = $tag->source;
                $return['content_tag'][$it]['file_tag']       = $tag->file_tag;
                $return['content_tag'][$it]['folder_tag']     = $tag->folder_tag;
                $return['content_tag'][$it]['tipe_header']    = $tag->type_header;
                $return['content_tag'][$it]['row_database']   = $tag->row_database;
                $return['content_tag'][$it]['database_refer'] = $tag->database_refer;
                $it++;
            }
        }

        return $return;
    }
    public static function content_dropdown($page, $primary_key, $type = '')
    {
        $return = [];
        $get    = DB::fetchResponse(DB::select("select *,web__apps__menubar_dropdown.id as primary_key
											from web__apps__menubar_dropdown
											where id_web__apps__menubar$type=$primary_key"));
        if (($get)) {
            $ii = 0;
            foreach ($get as $dropdown) {

                $return['content_dropdown'][$ii]['type_header'] = $dropdown->type_header;
                $return['content_dropdown'][$ii]['source']      = $dropdown->source;
                $return['content_dropdown'][$ii]['folder_tag']  = $dropdown->folder_tag;
                $return['content_dropdown'][$ii]['file_tag']    = $dropdown->file_tag;
                //tag
                $return['content_dropdown'][$ii] += Partial::content_tag($page, $dropdown->primary_key, '_dropdown');

                $ii++;
            }
        }

        return $return;
    }
    public static function content_database($page, $primary_key, $type = '')
    {
        $get = DB::fetchResponse(DB::select("select *,web__apps__menubar_list_database.id as primary_key_
											from web__apps__menubar_list_database
											where id_web__apps__menubar$type=$primary_key "));
        $return = [];
        if (($get)) {

            foreach ($get as $database) {
                $return['database'][$database->name_database]['utama']       = $database->utama;
                $return['database'][$database->name_database]['primary_key'] = $database->primary_key;
                $get                                                         = DB::fetchResponse(DB::select("select *
											from web__apps__menubar_list_database__select
											where id_web__apps__menubar_list_database=$database->primary_key_ "));
                if (($get)) {

                    foreach ($get as $select) {
                        $return['database'][$database->name_database]['select'][] = $select->row_database;
                    }
                }
                $get = DB::fetchResponse(DB::select("select *
											from web__apps__menubar_list_database__group
											where id_web__apps__menubar_list_database=$database->primary_key_ "));
                if (($get)) {

                    foreach ($get as $select) {
                        $return['database'][$database->name_database]['group'][] = $select->row_database;
                    }
                }
                $get = DB::fetchResponse(DB::select("select *
											from web__apps__menubar_list_database__where
											where id_web__apps__menubar_list_database=$database->primary_key_ "));
                if (($get)) {

                    foreach ($get as $select) {
                        $return['database'][$database->name_database]['where'][] = [$select->row_database, $select->operan, $select->value];
                    }
                }

                $get = DB::fetchResponse(DB::select("select *
											from web__apps__menubar_list_database__join
											where id_web__apps__menubar_list_database=$database->primary_key_ "));
                if (($get)) {

                    foreach ($get as $select) {
                        $return['database'][$database->name_database]['join'][] = [$select->database, $select->join_database_in, $select->join_database_out];
                    }
                }
                $return['database'][$database->name_database] += Partial::content_tag($page, $database->primary_key_, '_list_database');
            }
        }

        return $return;
    }
    public static function get_menu($page, $query, $nama_row_id_apps_menu, $content)
    {

        DB::queryRaw($page, $query);

        $get  = DB::get();
        $show = [];
        if ($get) {
            foreach ($get as $row) {
                if (! in_array($row->$nama_row_id_apps_menu, $show)) {
                    $show[] = $row->$nama_row_id_apps_menu;
                }
            }
        }

        /*
        hasil
            1430 = 2;
            1431 = 2;
        */

        $id_parent = [];
        $hasil     = [];
        $udah      = [];
        for ($i = 0; $i < count($show); $i++) {

            $loop   = true;
            $menu   = $show[$i];
            $udah[] = $menu;
            DB::queryRaw($page, "select * from web__list_apps_menu  where  id=($menu)");
            $get = DB::get();
            if ($get) {

                $parent = $get[0]->parent;
                if (! in_array($parent, $id_parent)) {
                    $id_parent[] = $parent;
                    while ($loop) {

                        DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($parent) and id in (" . implode(',', $show) . ")");
                        $get            = DB::get();
                        $hasil[$parent] = $count = $get[0]->count + (isset($superparent[$parent]) ? $superparent[$parent] : 0);

                        $menu = $parent;

                        $udah[] = $menu;
                        DB::queryRaw($page, "select * from web__list_apps_menu  where  id=($menu)");
                        $get = DB::get();
                        if ($get) {
                            $parent = $get[0]->parent;
                            if ($count && $parent !== null && $parent !== '') {
                                $superparent[$parent] = $count;
                            }
                        } else {
                            $loop = false;
                        }

                        if ($parent == 0) {
                            $loop = false;
                        }
                    }
                }
                $sub_parent = $show[$i];
                DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($sub_parent) ");
                $get              = DB::get();
                $hasil[$show[$i]] = $get[0]->count ? $get[0]->count : 1;
                if (($get[0]->count)) {
                    DB::queryRaw($page, "select id from web__list_apps_menu  where  parent=($sub_parent) ");
                    $get = DB::get();
                    foreach ($get as $row) {
                        DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row->id) ");
                        $to_get          = DB::get();
                        $hasil[$row->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                        $loop            = true;
                        $tree_parent     = $row->id;
                        if ($to_get[0]->count) {

                            DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                            $to_get = DB::get();
                            foreach ($to_get as $row1) {

                                DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row1->id) ");
                                $to_get           = DB::get();
                                $hasil[$row1->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                $tree_parent      = $row1->id;
                                if ($to_get[0]->count) {

                                    DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                    $to_get = DB::get();
                                    foreach ($to_get as $row2) {

                                        DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row2->id) ");
                                        $to_get           = DB::get();
                                        $hasil[$row2->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                        $tree_parent      = $row2->id;
                                        if ($to_get[0]->count) {

                                            DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                            $to_get = DB::get();
                                            foreach ($to_get as $row3) {

                                                DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row3->id) ");
                                                $to_get           = DB::get();
                                                $hasil[$row3->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                                $tree_parent      = $row3->id;
                                                if ($to_get[0]->count) {

                                                    DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                                    $to_get = DB::get();
                                                    foreach ($to_get as $row4) {
                                                        DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row4->id) ");
                                                        $to_get           = DB::get();
                                                        $hasil[$row4->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                                        $tree_parent      = $row4->id;
                                                        if ($to_get[0]->count) {

                                                            DB::queryRaw($page, "select * from web__list_apps_menu  where  parent=($tree_parent) ");
                                                            $to_get = DB::get();
                                                            foreach ($to_get as $row5) {
                                                                DB::queryRaw($page, "select count(*) as count from web__list_apps_menu  where  parent=($row5->id) ");
                                                                $to_get           = DB::get();
                                                                $hasil[$row5->id] = $to_get[0]->count ? $to_get[0]->count : 1;
                                                                $tree_parent      = $row5->id;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $key_hasil = [];
        foreach ($hasil as $key => $value) {
            if ($value and ! in_array($key, $key_hasil)) {
                $key_hasil[] = $key;
            }
        }

        $content_return = "";
        if ($content == 'get_array') {

            $content_return = Partial::tree_menuFunction($page, 0, $key_hasil, 1, $content);
        } else {
            $content_return .= '
				<table width="100%">
					<thead>
						<tr>
						<th>Nama Menu</th>
						<th>Akses Menu</th>
						<th>Add</th>
						<th>Edit</th>
						<th>Hapus</th>
						</tr>
					</thead>
					<tbody>
				';
            $content_return .= Partial::tree_menuFunction($page, 0, $key_hasil, 1, $content);
            $content_return .= '</table>';
        }
        return $content_return;
    }
    public static function tree_menuFunction($page, $parent, $key_hasil, $layer = 1, $content = "", $menu_tree_content = '')
    {
        if ($content == 'get_array') {
            $return = [];
        } else {
            $return = "";
        }

        if (count($key_hasil)) {
            if ($parent != 0) {
                unset($key_hasil[$parent]);
            }

            $query = "SELECT
					*,
					web__list_apps_menu.ID
				FROM
					web__list_apps_menu
					LEFT JOIN (
						SELECT COUNT(*) AS is_approval,
							form.load_apps AS load_apps_form,
							form.load_page_view AS load_page_view_form
						FROM
							form__approval
							JOIN form ON form__approval.id_form = form.ID
						GROUP BY
							form.load_apps,
							form.load_page_view
							) AS fa ON web__list_apps_menu.load_apps = fa.load_apps_form
					AND fa.load_page_view_form = web__list_apps_menu.load_page_view

					WHERE
						web__list_apps_menu.active=1 and
						parent =$parent
						AND ID IN ( " . implode(',', $key_hasil) . " )
					ORDER BY
						( SELECT COUNT(*) FROM web__list_apps_menu A WHERE A.parent =$parent ) DESC,
						urutan,
						nama_menu
            ";
            DB::queryRaw($page, $query);
            $get  = DB::get();
            $udah = [];
            if ($get) {

                foreach ($get as $row) {

                    $row_udah = ($row->tipe_menu . '-' . $row->nama_menu . '-' . $row->load_apps . '-' . $row->load_page_view . '-' . $row->load_type . '-' . $row->load_page_id . '-' . $row->menu . '-' . $row->nav . '-' . $row->board);
                    if (! in_array($row_udah, $udah)) {
                        $udah[] = $row_udah;
                        unset($key_hasil[$row->id]);
                        $p    = "";
                        $pp   = "";
                        $icon = "";
                        if ($content == 'get_array') {

                            if ($row->load_type == 'api_bundle') {

                                DB::table('api_master__list');
                                DB::whereRawPage($page, "id = $row->load_page_id");

                                $detail_api = DB::get('all');
                                DB::table('api_master__user');
                                DB::joinRaw('api_master__list on id_api =api_master__list.id ');
                                DB::whereRawPage($page, "id_api = $row->load_page_id and id_web__list_apps_board=ID_BOARD|");
                                $Get = DB::get('all');
                                if (! $Get['num_rows']) {
                                    $sqli['id_api']                  = $row->load_page_id;
                                    $sqli['id_panel']                = 'ID_PANEL|';
                                    $sqli['id_web__list_apps_board'] = 'ID_BOARD|';
                                    $insert_last                     = CRUDFunc::crud_insert($page['fai'], $page, $sqli, [], 'api_master__user');
                                } else {
                                    $insert_last = $Get['row'][0]->id;
                                }
                                $sqli = [];
                                DB::selectRaw('*,api_master__sync.id as primary_key');
                                DB::table('api_master__sync');
                                DB::joinRaw('api_master__link on id_link =api_master__link.id ');
                                DB::joinRaw('api_master__list on id_api =api_master__list.id ');
                                DB::whereRawPage($page, " id_kategori_api=1 and api_master__list.id = $row->load_page_id");
                                $Get = DB::get('all');
                                if ($Get['num_rows']) {
                                    foreach ($Get['row'] as $get_row) {

                                        DB::table('api_master__user__sync');
                                        DB::whereRawPage($page, "id_sync=$get_row->primary_key and id_api_master__user= $insert_last");
                                        $Get = DB::get('all');
                                        if (! $Get['num_rows']) {
                                            $sqli['id_sync']             = $get_row->primary_key;
                                            $sqli['digunakan']           = 1;
                                            $sqli['id_api_master__user'] = $insert_last;
                                            CRUDFunc::crud_insert($page['fai'], $page, $sqli, [], 'api_master__user__sync');
                                        }
                                    }
                                }
                                $return[] = ["menu", $detail_api['row'][0]->nama_api_master . " Api Setting", [$row->load_apps, $row->load_page_view, "sync_edit", $insert_last, $row->menu, $row->nav, $row->board, $row->id_parent], $icon];
                                DB::table('api_master__user__sync');
                                DB::joinRaw('api_master__sync on id_sync =api_master__sync.id ');
                                DB::whereRawPage($page, "id_api_master__user= $insert_last and digunakan='1'");
                                $Get = DB::get('all');
                                if ($Get['num_rows']) {
                                    foreach ($Get['row'] as $get_row) {

                                        $return[] = ["menu", $detail_api['row'][0]->nama_api_master . ": Sync " . $get_row->nama_sync, [$row->load_apps, $row->load_page_view, "sync", $get_row->id_sync, $row->menu, $row->nav, $row->board, $row->id_parent], $icon];
                                    }
                                }
                            } else if ($row->tipe_menu == 'menu') {
                                $icon = '<i class="menu-icon tf-icons bx bx-collection"></i>';
                                if ($row->icon) {
                                    $icon = $row->icon;
                                }
                                $return[] = [$row->tipe_menu, $row->nama_menu, [$row->load_apps, $row->load_page_view, $row->load_type, $row->load_page_id, $row->menu, $row->nav, $row->board], $icon];
                                if ($row->is_approval) {
                                    $return[] = [$row->tipe_menu, "Approval " . $row->nama_menu, [$row->load_apps, $row->load_page_view, "appr", $row->load_page_id, $row->menu, $row->nav, $row->board], $icon];
                                }
                            } else if ($row->tipe_menu == 'group') {
                                $to_layer = $layer + 1;

                                $return[] = [$row->tipe_menu, $row->nama_menu, Partial::tree_menuFunction($page, $row->id, $key_hasil, ($to_layer), $content)];
                            } else {
                                //dropdown
                                $to_layer = $layer + 1;
                                $return[] = [$row->tipe_menu, $row->nama_menu, Partial::tree_menuFunction($page, $row->id, $key_hasil, ($to_layer), $content)];
                            }
                        } else {
                            $return .= '
							<tr>
								<td>' . $row->nama_menu . '</td>
								<td><input type="checkbox" class="form-check-input content-' . $p . 'select ' . $pp . '  childchekbox" name="checklist_menu[' . $row->id . ']" value="1" data-id="' . $p . '" style="height: 20px" onclick="checkparent(this)"></td>
								<td><input type="checkbox" class="form-check-input content-' . $p . 'select ' . $pp . 'add  childchekboxadd" name="checklist_add[' . $row->id . ']" value="1" data-id="' . $p . '" style="height: 20px" onclick="checkparent(this)"></td>
								<td><input type="checkbox" class="form-check-input content-' . $p . 'select ' . $pp . 'edit  childchekboxedit" name="checklist_edit[' . $row->id . ']" value="1" data-id="' . $p . '" style="height: 20px" onclick="checkparent(this)"></td>
								<td><input type="checkbox" class="form-check-input content-' . $p . 'select ' . $pp . 'hapus  childchekboxhapus" name="checklist_hapus[' . $row->id . ']" value="1" data-id="' . $p . '" style="height: 20px" onclick="checkparent(this)"></td>
							<tr>
							';

                            $to_layer = $layer + 1;
                            $return .= Partial::tree_menuFunction($page, $row->id, $key_hasil, ($to_layer), $content);
                        }
                    } else {
                        unset($key_hasil[$row->id]);
                    }
                }
            }
        }
        return $return;
    }
    public static function histori_user($page)
    {

        $ua = Partial::getBrowser();

        $isMob = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"));

        // (B) TABLET CHECK
        $isTab = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "tablet"));

        // (C) DESKTOP?
        $isDesktop = ! $isMob && ! $isTab;

        // (D) MANY OTHERS...
        $isWin         = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "windows"));
        $isAndroid     = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "android"));
        $isIPhone      = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "iphone"));
        $isIPad        = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "ipad"));
        $isIOS         = $isIPhone || $isIPad;
        $device_detail = "";
        if ($isMob) {
            $device_detail = 'Mobile';
        } else
        if ($isTab) {
            $device_detail = 'tablet';
        } else
        if ($isWin) {
            $device_detail = 'windows';
        } else
        if ($isAndroid) {
            $device_detail = 'android';
        } else
        if ($isIPhone) {
            $device_detail = 'iphone';
        } else
        if ($isIPad) {
            $device_detail = 'ipad';
        }
        // Append the requested resource location to the URL

        $data['id_apps_user']       = isset($_SESSION['id_apps_user']) ? $_SESSION['id_apps_user'] : 0;
        $data['id_panel']           = isset($page['get_panel']['id_panel']) ? $page['get_panel']['id_panel'] : -1;
        $data['ip']                 = $_SERVER['REMOTE_ADDR'];
        $data['url']                = $_SERVER['REQUEST_URI'];
        $data['domain']             = $_SERVER['SERVER_NAME'];
        $data['historis_apps']      = $page['load']['apps'];
        $data['historis_page_view'] = $page['load']['page_view'];
        $data['historis_id']        = $page['load']['id'];
        $data['historis_type']      = $page['load']['type'];
        $data['historis_nav']       = isset($page['load']['nav']) ? $page['load']['nav'] : -1;
        $data['historis_menu']      = $page['load']['menu'];
        $data['historis_board']     = $page['load']['board'];
        // $data['change'] = $change;
        $data['os']              = $ua['platform'];
        $data['browser']         = $ua['name'];
        $data['browser_version'] = $ua['version'];
        $data['report']          = $ua['userAgent'];
        $data['tanggal_akses']   = date('Y-m-d H:i:s');
        $data['device']          = $isDesktop ? 'Desktop' : 'Mobile';
        $data['device_detail']   = $device_detail;
        $is                      = 1;
        if (isset($page['section'])) {
            if ($page['section'] == 'viewsource') {
                $is = 0;
            }
        }
        if ($is and $page['load_section'] != 'viewsource') {
            CRUDFunc::crud_insert(new MainFaiFramework(), $page, $data, [], 'apps_user__historis', []);
        }

        // $ci->db->insert('apps_user__histori', $data);
    }
    public static function getBrowser()
    {
        $u_agent  = $_SERVER['HTTP_USER_AGENT'];
        $bname    = 'Unknown';
        $platform = 'Unknown';
        $version  = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && ! preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub    = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub    = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub    = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && ! preg_match('/Edge/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub    = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && ! preg_match('/Edge/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub    = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub    = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {
            $bname = 'Edge';
            $ub    = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub    = "MSIE";
        }

        // finally get the correct version number
        $known   = ['Version', $ub, 'other'];
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (! preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = isset($matches['version'][1]) ? $matches['version'][1] : '';
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return [
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern,
        ];
    }
}
