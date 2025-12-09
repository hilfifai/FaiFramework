<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('DB.php');
require_once(__DIR__ . '/../Function_class/DatabaseFunc.php');
class Database extends DB
{
	public function __construct()
	{
		//	session_start();
	}
	public static function string_database($page, $fai, $string)
	{

        if(($page['section']??'pages')=='generate'){
            return $string;
        }else if (!empty(($string)) and is_string($string)) {
			if (!$fai) {
				$fai = new MainFaiFramework();
			}
		
			 $count = (count(explode('}', $string)) + count(explode('|', $string)));
			for ($i = 0; $i <= $count + 1; $i++) {
				

				if ($string == '$id' and $page['section'] != 'viewsource')
					$string = $page['id'];
				else if (strpos($string, '???')  and $page['section'] != 'viewsource') {
					$string = $fai->parsing_text($fai, $page, $string);
				} else if (strpos($string, 'IDTABLE')) {

					$IDTABLE = Partial::getTagValues("IDTABLE", $string);
					for ($j = 0; $j < count($IDTABLE); $j++) {
						$convert = Database::converting_primary_key($page, $IDTABLE[$j], 'ontable');
						$string = str_ireplace('{IDTABLE}' . $IDTABLE[$j] . '{/IDTABLE}', $convert, $string);
					}
				} else if (strpos($string, 'IDPRIMARY')) {

					$IDPRIMARY = Partial::getTagValues("IDPRIMARY", $string);

					for ($j = 0; $j < count($IDPRIMARY); $j++) {
						$convert = Database::converting_primary_key($page, $IDPRIMARY[$j], 'primary_key');
						$string = str_ireplace('{IDPRIMARY}' . $IDPRIMARY[$j] . '{/IDPRIMARY}', $convert, $string);
					}
				} else if (strpos($string, 'SESSION_UTAMA}')) {
					// echo $string;
					if (!isset($page['load']['login-session-utama']['session_name'])) {
						$page['load']['login-session-utama']['session_name'] = 'id_apps_user';
					}
					if (!isset($_SESSION[$page['load']['login-session-utama']['session_name']])) {
						$_SESSION[$page['load']['login-session-utama']['session_name']] = -1;
					}
					$string = str_ireplace('{SESSION_UTAMA}', $_SESSION[$page['load']['login-session-utama']['session_name']], $string);
				} else if (strpos($string, 'SESSION_UTAMA_DAFTAR}')) {
					$string = str_ireplace('{SESSION_UTAMA_DAFTAR}', $_SESSION[$page['load']['login-session-utama']['session_name'] . "_daftar"], $string);
				} else if (strpos($string, 'LOAD_ID}')) {
					$string = str_ireplace('{LOAD_ID}', $page['load']['id'], $string);
				} else if (strpos($string, 'ID_APPS|') or substr($string, 0, strlen('ID_APPS|')) == 'ID_APPS|') {
					$string = str_ireplace('ID_APPS|', $page['id_list_apps'], $string);
				} else if (strpos($string, 'ID_APPS_USER|') or substr($string, 0, strlen('ID_APPS_USER|')) == 'ID_APPS_USER|') {
					
					$string = str_ireplace('ID_APPS_USER|', $_SESSION['id_apps_user'], $string);
				} else if (strpos($string, 'ID_PANEL|') or substr($string, 0, strlen('ID_PANEL|')) == 'ID_PANEL|') {

					if (isset($page['get_panel']['id_panel']))
						$string = str_ireplace('ID_PANEL|', $page['get_panel']['id_panel'], $string);
					else
						$string = str_ireplace('ID_PANEL|', -1, $string);
				} else if (strpos($string, 'DOMAIN_UTAMA|') or substr($string, 0, strlen('DOMAIN_UTAMA|')) == 'DOMAIN_UTAMA|') {

					if (!isset($page['load']['domain'])) {
						if (($fai->input('frameworksubdomain'))) {

							$domain = $fai->input('frameworksubdomain');
						} else
							$domain = $_SERVER['HTTP_HOST'];

						if ($domain == 'localhost') {
							$domain = 'ajis.hibe3.com';
						}
						$page['load']['domain'] = $domain;
					}
					$string = str_ireplace('DOMAIN_UTAMA|', $page['load']['domain'], $string);
				} else if (strpos($string, 'ID_BOARD|') or substr($string, 0, strlen('ID_BOARD|')) == 'ID_BOARD|') {
					$string = str_ireplace('ID_BOARD|', (isset($page['load']['board']) ? $page['load']['board'] : '-1'), $string);
				} else if (strpos($string, 'WORKSPACE_ROLE_UTAMA|') or substr($string, 0, strlen('WORKSPACE_ROLE_UTAMA|')) == 'WORKSPACE_ROLE_UTAMA|') {
					$role = isset($_SESSION['board_role-' . (isset($page['load']['board']) ? $page['load']['board'] : '-1')]) ? $_SESSION['board_role-' . (isset($page['load']['board']) ? $page['load']['board'] : '-1')] : -1;

					$string = str_ireplace('WORKSPACE_ROLE_UTAMA|', $role, $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_TOKO_WHERE|') or substr($string, 0, strlen('WORKSPACE_SINGLE_TOKO_WHERE|')) == 'WORKSPACE_SINGLE_TOKO_WHERE|') {


					$string = str_ireplace('WORKSPACE_SINGLE_TOKO_WHERE|', "AND store__produk.id_toko=" . $page['load']['workspace']['id_single_toko'], $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_TOKO_POS_WHERE|') or substr($string, 0, strlen('WORKSPACE_SINGLE_TOKO_POS_WHERE|')) == 'WORKSPACE_SINGLE_TOKO_POS_WHERE|') {


					$string = str_ireplace('WORKSPACE_SINGLE_TOKO_POS_WHERE|', "AND erp__pos__utama.id_toko=" . $page['load']['workspace']['id_single_toko'], $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_TOKO_WHERE_NO_AND|') or substr($string, 0, strlen('WORKSPACE_SINGLE_TOKO_WHERE_NO_AND|')) == 'WORKSPACE_SINGLE_TOKO_WHERE_NO_AND|') {
					$string = str_ireplace('WORKSPACE_SINGLE_TOKO_WHERE_NO_AND|', "store__produk.id_toko=" . $page['load']['workspace']['id_single_toko'], $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|') or substr($string, 0, strlen('WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|')) == 'WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|') {
					$string = str_ireplace('WORKSPACE_SINGLE_TOKO_WHERE_NO_AND_ID|', "id=" . $page['load']['workspace']['id_single_toko'], $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_TOKO|') or substr($string, 0, strlen('WORKSPACE_SINGLE_TOKO|')) == 'WORKSPACE_SINGLE_TOKO|') {

					$string = str_ireplace('WORKSPACE_SINGLE_TOKO|', $page['load']['workspace']['id_single_toko'], $string);
				} else if (strpos($string, 'WORKSPACE_SINGLE_PANEL|') or substr($string, 0, strlen('WORKSPACE_SINGLE_PANEL|')) == 'WORKSPACE_SINGLE_PANEL|') {
					$string = str_ireplace('WORKSPACE_SINGLE_PANEL|', $page['load']['workspace']['id_panel_utama'], $string);
				} else if (strpos($string, 'KUTIP}')) {
					$string = str_ireplace('{KUTIP}', "'", $string);
				} else if ($string == "NOWDATETIME" or strpos($string, 'NOWDATETIME') or substr($string, 0, strlen("NOWDATETIME")) == 'NOWDATETIME') {
					$format = substr($string, strpos($string, 'NOWDATETIME') + strlen("NOWDATETIME::"));

					$format = substr($format, strpos($string, 'NOWDATETIME'), strpos($format, '|'));

					$string = str_ireplace("NOWDATETIME::$format|", date($format), $string);
				} else if ($string == "NOWDATE" or strpos($string, 'NOWDATE') or substr($string, 0, strlen("NOWDATE")) == 'NOWDATE') {
					$string = str_ireplace("NOWDATE", date('Y-m-d'), $string);
				} else if ($string == "NOWTAHUNKECIL" or strpos($string, 'NOWTAHUNKECIL') or substr($string, 0, strlen("NOWTAHUNKECIL")) == 'NOWTAHUNKECIL') {
					if ($page['section'] == 'viewsource') {
						$string = str_ireplace("NOWTAHUNKECIL|", '".' . "date('y')" . '."', $string);
					} else
						$string = str_ireplace("NOWTAHUNKECIL|", date('y'), $string);
				} else if ($string == "NOWBULAN" or strpos($string, 'NOWBULAN') or substr($string, 0, strlen("NOWBULAN")) == 'NOWBULAN') {
					if ($page['section'] == 'viewsource') {
						$string = str_ireplace("NOWBULAN|", '".' . " sprintf('%02d', date('m'))" . '."', $string);
					} else
						$string = str_ireplace("NOWBULAN|", sprintf('%02d', date('m')), $string);
				} else if ($string == "RANDOMNUM" or stripos($string, 'RANDOMNUM') or substr($string, 0, strlen("RANDOMNUM")) == 'RANDOMNUM') {
					$format = substr($string, strpos($string, 'RANDOMNUM') + strlen("RANDOMNUM::"));

					$format = substr($format, 0, strpos('|', $format) - 1);


					$string = str_ireplace("RANDOMNUM::$format|", Partial::random_num($format), $string);
				} else if ($string == "ARRAYWEBSITE_THISROW|" or stripos($string, 'ARRAYWEBSITE_THISROW|') or substr($string, 0, strlen("ARRAYWEBSITE_THISROW|")) == 'ARRAYWEBSITE_THISROW|') {

					$string = str_ireplace("ARRAYWEBSITE_THISROW|", $page['array_website']['thisrow'], $string);
				} else if ($string == "row:" or stripos($string, 'row:') or substr($string, 0, strlen("row:")) == 'row:') {
					// echo $string;
					$format = substr($string, strpos($string, 'row') + strlen("row:"));
					$format = trim($format);

					$get_row = substr($format, 0, strpos($format, '!') + strlen("!") - 1);

					$format = substr($format, strpos($format, '!') + strlen("!"));
					$get_form = explode('|', $format);
					$get_form = $get_form[0];
					if (isset($page['row'][$get_form]))
						$replace_string = ($page['row'][$get_form]->$get_row);
					else if (isset($page['row_section'][$get_form]['row'][0])) {

						$replace_string = ($page['row_section'][$get_form]['row'][0]->$get_row);
					} else {
						echo $get_row . ' tidak ada row terkait pada ' . $get_form . ' hubungi webmaster';
					}
					$string = str_ireplace("row:$get_row!$get_form|", $replace_string, $string);
				} else if ($string == "LAST_INSERT:" or stripos($string, 'LAST_INSERT:') or substr($string, 0, strlen("LAST_INSERT:")) == 'LAST_INSERT:') {
					// $return_data = "LAST_INSERT:$value|";
					$format = substr($string, strpos($string, 'LAST_INSERT') + strlen("LAST_INSERT:"));
					$format = trim($format);

					$get_row = substr($format, 0, strpos($format, '|') + strlen("|") - 1);
					$replace_string = ($page['crud']['last_insert'][$get_row]);


					$string = str_ireplace("LAST_INSERT:$get_row|", $replace_string, $string);
				} else if ($string == "RANDOM" or stripos($string, 'RANDOM') or substr($string, 0, strlen("RANDOM")) == 'RANDOM') {
					$format = substr($string, strpos($string, 'RANDOM') + strlen("RANDOM::"));

					$format = substr($format, 0, strpos('|', $format) - 1);


					$string = str_ireplace("RANDOM::$format|", Partial::random($format), $string);
				} else if ($string == "RAND" or strpos($string, 'RAND') or substr($string, 0, strlen("RAND")) == 'RAND') {
					$format = substr($string, strpos($string, 'RAND') + strlen("RAND::"));

					$format = substr($format, 0, strpos('|', $format) - 1);
					$ex_format = explode('-', $format);
					if (isset($ex_format[1]))
						$string = str_ireplace("RAND::$format|", rand($ex_format[0], $ex_format[1]), $string);
				} else if ($string == "LOAD_ID" or strpos($string, 'LOAD_ID') or substr($string, 0, strlen("LOAD_ID")) == 'LOAD_ID') {


					$string = str_ireplace("LOAD_ID|", $page['load']['id'], $string);
				} else if ($string == "LOAD_STEP" or strpos($string, 'LOAD_STEP') or substr($string, 0, strlen("LOAD_STEP")) == 'LOAD_STEP') {
					$string = str_ireplace("LOAD_STEP|", $page['load']['step'], $string);
				} else if ($string == "id_web__apps" or strpos($string, 'id_web__apps') or substr($string, 0, strlen("id_web__apps")) == 'id_web__apps') {
					if (!isset($page['load']['id_web__apps'])) {
						$page['load']['id_web__apps'] = null;
					}
					$string = str_ireplace("id_web__apps|", $page['load']['id_web__apps'], $string);
				} else if ($string == "insert_workspace_board_id" or strpos($string, 'insert_workspace_board_id') or substr($string, 0, strlen("insert_workspace_board_id")) == 'insert_workspace_board_id') {
					
					$string = str_ireplace("insert_workspace_board_id|", $_SESSION['insert_workspace_board_id'], $string);
				} else if ($string == "insert_workspace_apps_id" or strpos($string, 'insert_workspace_apps_id') or substr($string, 0, strlen("insert_workspace_apps_id")) == 'insert_workspace_apps_id') {
					
					$string = str_ireplace("insert_workspace_apps_id|", $_SESSION['insert_workspace_apps_id'], $string);
				} else if ($string == "ID_APPS" or strpos($string, 'ID_APPS') or substr($string, 0, strlen("ID_APPS")) == 'ID_APPS') {
					$string = str_ireplace("ID_APPS|", Partial::get_id_apps($page), $string);
				} else if ($string == "{BULAN}" or strpos($string, '{BULAN}') or substr($string, 0, strlen("{BULAN}")) == '{BULAN}') {

					if ($page['section'] == 'viewsource') {
						$string = str_ireplace("{BULAN}|", '".' . "sprintf('%02d',date('m'))" . '."', $string);
					} else {

						$string = str_ireplace("{BULAN}|", sprintf('%02d', date('m')), $string);
					}
				} else if ($string == "{TAHUN-y}" or strpos($string, '{TAHUN-y}') or substr($string, 0, strlen("{TAHUN-y}")) == '{TAHUN}') {

					if ($page['section'] == 'viewsource') {
						$string = str_ireplace("{TAHUN-y}|", '".' . "date('y')" . '."', $string);
					} else {
						$string = str_ireplace("{TAHUN-y}|", date('y'), $string);
					}
				} else {
					//$string = CRUDFunc::default_value($string, $page);
				}
			}
		}
		return $string;
	}
	public static function get_colomn_select($page, $selet_array, $database_utama, $type_return, $type_get)
	{

		if (isset($selet_array[3])) {

			$field = $selet_array[1];
			$option = $selet_array[3];

			$database = $option[0];

			if (!isset($selet_array[4])) {
				$selet_array[4] = null;
			}
			if ($selet_array[4]) {
				$field = $selet_array[4];
			}
			if (!($option[1])) {
				$option[1] = Database::converting_primary_key($page, $database, 'ontable');
			}
			$key = Database::converting_primary_key($page, $option[1], 'select');
			$value = $option[2];
			$is_alias = false;
			$alias = "";
			if (isset($option[3])) {
				if ($option[3]) {

					$is_alias = true;
					if ($option[1])
						$key = $option[1];
					$alias = $option[3];
				}
			}

			// if (isset($option[3])) {
			// 	$join_from_table_column = $option[4];
			// } else 

			$field_select_on_internal_database_utama = (isset($selet_array[5]) ? $selet_array[5] : $field);
			if ($type_return == 'id_select') {

				if (isset($option[4])) {
					$join_from_table_column = $option[4];
				} else {
					$join_from_table_column = "$database_utama";
				}
				if ($type_get == 'select')
					return "
				$join_from_table_column." . (isset($selet_array[4]) ? $selet_array[4] : $field) . " as $field" . '_' . $join_from_table_column;
				if ($type_get == 'row') {

					return "$field" . '_' . $join_from_table_column;
				}
			} else {

				if (isset($option[5])) {
					$join_from_table_column = $option[5];
				} else if ($is_alias) {
					$join_from_table_column = "$alias";
				} else {
					$join_from_table_column = "$database";
				}

				if ($type_get == 'select')
					return "
				$join_from_table_column.$value as $value" . '_' . $join_from_table_column;
				if ($type_get == 'row')
					return "$value" . '_' . $join_from_table_column;
			}
		}
	}
	public static function database_coverter($page, $database, $array, $exec = 'exec', $panel = true)
	{

		$fai = new MainFaiFramework();
		
		DB::connection($page);

		if (!isset($page['section'])) $page['section'] = '';
		$database_utama = isset($database['utama']) ? $database['utama'] : '';
		
		$database_manipulation = Packages::database_manipulation($page, $database_utama,  $database, $array, "", 'database_converter');
        // print_R($database_manipulation['database_costum']);
		$db_temp_utama = $database_utama = $database_manipulation['utama'];
		$database = ($database_manipulation['database_costum']);
		// print_R($database);
		// echo '<br>';
		// echo '<br>';
		// echo '<br>';
		$database['utama'] = $database_manipulation['utama'];
		$database_utama = isset($database['alias']) ? $database['alias'] : $database_utama;
		$query = isset($database['query']) ? Database::string_database($page, $fai, $database['query']) : '';
		$limit = isset($database['limit']) ? $database['limit'] : '';
		$limit_raw = isset($database['limit_raw']) ? $database['limit_raw'] : '';

		if ($database_utama) {
			$primary_key = isset($database['primary_key']) ?
				(!empty($database['primary_key'])  ? $database['primary_key'] : 
				Database::converting_primary_key($page, $database['primary_key'], 'ontable')) : '';
			if (!$primary_key and isset($database['utama'])) {
				$primary_key = Database::converting_primary_key($page, $database['utama'], 'ontable');
			}
			if (!str_starts_with($database['utama'], 'view_') and !isset($database['not_checking']) and !stripos($database['utama'], ' as ') and !in_array($page['section'], ["card", 'viewsource']))
				Database::create_database_check($page, $array, $database['utama'], $primary_key, $page['database_provider']);
		
			$select = isset($database['select']) ? $database['select'] : (!isset($database['non_add_select'])?array('*', $database_utama . '.' . $primary_key . ' as primary_key'):[]);
			

			$join = isset($database['join']) ? $database['join'] : '';
			$select_database = isset($database['select_database']) ? $database['select_database'] : array();
			$joinRaw = isset($database['join_raw']) ? $database['join_raw'] : array();
			$select_raw = isset($database['select_raw']) ? $database['select_raw'] : '';
			$where_raw = isset($database['where_raw']) ? $database['where_raw'] : '';

			$order_by = isset($database['order']) ? $database['order'] : (isset($page['load']['not_orderby']) ?
				(
					array(
						array("$database_utama." . (isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date ") . ' desc ')
					)
				) : array()
			);
			$group_by = isset($database['group']) ? $database['group'] : array();



			if (!$query and !isset($database['not_where_active']))
				$where = isset($database['where']) ? $database['where'] : (($where_raw or $page['section'] == 'viewsource') ? array() : array(array("$database_utama.active", '=', "1")));
			else {
				$where = isset($database['where']) ? $database['where'] : array();
			}
			$np = 1;
			if ($page['section'] == 'viewsource')
				$np = 0;
			else if (isset($page['load']['database']['not_faiframework_database']))
				$np = 0;
		else if ($page['load_section'] == 'admin')
				$np = 0;
			else if ($page['load']['domain']??'' == 'admin.hibe3.com')
				$np = 0;
			else if (isset($database['non_privilage']))
				$np = 0;
			else if (isset($database['np']))
				$np = 0;
			else if (substr($database_utama, 0, strlen('web')) == 'web')
				$np = 0;
			else if (substr($database_utama, 0, strlen('apps')) == 'apps')
				$np = 0;

			// echo $database_utama.'ininp'.$np;


			if ($np)
				$where[] = array("
				(case 
							when ($database_utama.privilege='Public Global') then 1
							when ($database_utama.privilege='Private Website' and 
									($database_utama.on_domain='DOMAIN_UTAMA|' or   $database_utama.on_board = ID_BOARD|) and 
									(select count(*) from apps__privilege where tipe_privilage='pengecualian' and CAST(apps__privilege.database_id AS int) = CAST($database_utama.id AS int) and 'DOMAIN_UTAMA|'=apps__privilege.domain_privilage)=0) then 1
							when ($database_utama.privilege='Private Workspace' and  $database_utama.on_board = ID_BOARD| ) then 1
							when ($database_utama.privilege='Private Panel' and  $database_utama.on_panel = ID_PANEL| )then 1
							when ($database_utama.privilege='Private Role' and $database_utama.on_role = WORKSPACE_ROLE_UTAMA|) then  1
							when ($database_utama.privilege='Private Personal' and CAST($database_utama.create_by AS CHAR) = 'WORKSPACE_ROLE_UTAMA|') then  1
							else 0
							end
					)
				", '=', '1');
			$page['database_provider'] = isset($page['database_provider']) ? $page['database_provider'] : 'mysql';
			$page['app_framework'] = isset($page['app_framework']) ? $page['app_framework'] : 'ci';
			$database_provider = $page['database_provider'];
			$app_framework = $page['app_framework'];
			if ($page['section'] != 'viewsource') {
				if (isset($page['panel']) and $panel) {
					$get_panel = Database::get_database_panel($page, $page['panel']);;

					$columns = DB::getColumnListing($page, $database_provider, $database_utama);;
					if ($database_provider == 'postgres') {
						if (!in_array((Database::converting_primary_key($page, $page['panel'], 'primary_key')), $columns)) {

							DB::select("ALTER TABLE $database_utama ADD COLUMN " . (Database::converting_primary_key($page, $page['panel'], 'primary_key')) . " numeric  DEFAULT NULL");
						}
					} else {
						if (!in_array((Database::converting_primary_key($page, $page['panel'], 'primary_key')), $columns)) {

							DB::select("ALTER TABLE $database_utama ADD COLUMN " . (Database::converting_primary_key($page, $page['panel'], 'primary_key')) . " int(11)  DEFAULT NULL");
						}
					}
					if (!$query) {
						$where[] = array($database_utama . "." . Database::converting_primary_key($page, $page['panel'], 'primary_key'), '=', $get_panel);
					}
				}
			}

			if (!$query) {

				DB::table((!empty($page['conection_scheme'] and !isset($database['not_schema']) and $page['database_provider']=='postgres') ? $page['conection_scheme'] . '.' : '') . $database['utama'] . (isset($database['alias']) ? ' as ' . $database['alias'] : ''));
				if ($exec != 'source' and !isset($database['non_add_select'])) {

					if (!in_array("$database_utama.$primary_key as primary_key", $select)) {
						$select[] = "$database_utama.$primary_key as primary_key";
					}
					if (!isset($database['database_overide_onselect_primary_key'])) {
						$select[] = ("$database_utama.$primary_key as primary_key_$database_utama");
					} else {
						if ($database['database_overide_onselect_primary_key'])
							$select[] = (($database['database_overide_onselect_primary_key'] ? $database['database_overide_onselect_primary_key'] . "." : '') . "$primary_key as primary_key_$database_utama");
					}
				}

				$select = $select;
				$where_sql = "";
				$select_raw_temp = "";


				if ($select_raw) DB::selectRaw($select_raw . $select_raw_temp);

				if (count($select)) {
				
					for ($i = 0; $i < count($select); $i++) {
						if (isset($select[$i])) {

							$var = 'select';

							$$var[$i] = Database::string_database($page, $fai, $$var[$i]);

							DB::selectRaw($select[$i]);
						}
					}
				}


				// 			DB::joinRaw("(select count(*) as is_approval,form.load_apps as load_apps_form,form.load_page_view as load_page_view_form from form__approval join form on form__approval.id_form=form.id GROUP BY form.load_apps,form.load_page_view) as fa on '".$page['load']['apps']."' = fa.load_apps_form and fa.load_page_view_form ='".$page['load']['page_view']."'", 'left');


			} else {
				DB::queryRaw($page, $query);
			}
			$where_raw = Database::string_database($page, $fai, $where_raw);
			$datatable_search = Partial::input('search');
			if (isset($page['database']['utama'])) {
				if ($datatable_search and $database_utama == $page['database']['utama']) {
					$to_search = ($datatable_search['value']);
					if ($to_search) {

						$where_search_array = [];

						$columns[$database_utama] = DB::getColumnListing($page, $database_provider, $database_utama, 'type');

						for ($i = 0; $i < count($array); $i++) {
							if (('select' == $array[$i][2]) and $array[$i][3][2] != 'id') {
								$field = $array[$i][3][0] . "." . $array[$i][3][2];
								if (!isset($columns[$array[$i][3][0]])) {
									$columns[$array[$i][3][0]] = DB::getColumnListing($page, $database_provider, $array[$i][3][0], 'type');
									if (in_array($columns[$array[$i][3][0]][$array[$i][3][2]], array("interger", "numeric", 'float', 'double', 'double precision'))) {

										if ($to_search == 0) {

											$to_search = (float) $to_search;
										} else {

											$to_search = (float) $to_search;
											if (!$to_search) {
												$to_search = -9;
											}
										}
										if ($to_search)
											$where_search_array[] = "($field) = $to_search";
									} else {
										if ($to_search)
											$where_search_array[] = "($field) ilike '%$to_search%'";
									}
								}
							} else if (('select-manual' == $array[$i][2])) {
								foreach ($array[$i][3] as $key_manual => $value_manual) {

									$where_search_array[] = "POSITION('$to_search' IN '" . $value_manual . "') > 0";
									$where_search_array[] = "POSITION('$to_search' IN  '" . $key_manual . "') > 0";
									// $where_search_array[] = "CHARINDEX('$to_search', '".$value_manual."') > 0";
									// $where_search_array[] = "CHARINDEX('$to_search', '".$key_manual."') > 0";
								}
							} else if ($array[$i][1] != 'id') {
								$field = $database_utama . "." . $array[$i][1];
								if (in_array($columns[$database_utama][$array[$i][1]], array("interger", "numeric", 'float', 'double', 'double precision'))) {

									if ($to_search === 0) {
										$to_search = (float) $to_search;
									} else {
										$to_search = (float) $to_search;
										if (!$to_search) {
											$to_search = -999999999;
										}
									}
									if ($to_search)
										$where_search_array[] = "($field) = $to_search";
								} else {
									if ($to_search)
										$where_search_array[] = "($field) ilike '%$to_search%'";
								}
							}
						}
						"(" . implode(' OR ', $where_search_array) . ")";
						if (count($where_search_array))
							$where_raw .= "(" . implode(' OR ', $where_search_array) . ")";
					}
				}
			}
			if (!isset($database['not_checking']) and $page['section'] != 'viewsource')
				$column = DB::getColumnListing($page, $page['database_provider'], $database_utama, 'type');
			DB::whereRaw($where_raw);  

			if (count($where)) {
				
				for ($i = 0; $i < count($where); $i++) {
					 $where[$i][2];
					$where[$i][0] = Database::string_database($page, $fai, $where[$i][0]);
					$where[$i][2] = Database::string_database($page, $fai, $where[$i][2]);
					if (isset($column[$where[$i][0]])) {
						if (!in_array($column[$where[$i][0]], array("numeric", "float8", "float", 'double', "int8", "interger", "int4")) and substr($where[$i][2], 0, 1) != "'" and !strpos($where[$i][2], "select") and !strpos($where[$i][2], ")")) {
							DB::whereRaw($where[$i][0] . $where[$i][1] . "'" . $where[$i][2] . "'");
						} else {
							DB::whereRaw($where[$i][0] . $where[$i][1] . $where[$i][2]);
						}
					} else
						DB::whereRaw($where[$i][0] . $where[$i][1] . $where[$i][2]);
				}
			}
			if (!empty($join)) {


				if (count($join)) {
					for ($i = 0; $i < count($join); $i++) {
						$var = 'join';


						$$var[$i][0] = Database::string_database($page, $fai, $$var[$i][0]);
						$$var[$i][1] = Database::string_database($page, $fai, $$var[$i][1]);
						$$var[$i][2] = Database::string_database($page, $fai, $$var[$i][2]);

						DB::joinRaw(((!empty($page['conection_scheme']) and !isset($join[$i]['non_schema']) and $page['database_provider']=='postgres') ? $page['conection_scheme'] . '.' : '') . $join[$i][0] . " on " . $join[$i][1] . '=' . $join[$i][2], isset($$var[$i][3]) ?	$$var[$i][3] : '');
					}
				}
			}

			if ($joinRaw) {

				if (count($joinRaw)) {
					for ($i = 0; $i < count($joinRaw); $i++) {
					    
						DB::joinRaw(Database::string_database($page, $fai, $joinRaw[$i]));
					}
				}
			}
			if (isset($database['with'])) {

				if (count($database['with'])) {
					for ($i = 0; $i < count($database['with']); $i++) {
					   
						DB::withRaw(Database::string_database($page, $fai, $database['with'][$i]));
					}
				}
			}
			if (isset($database['procedure'])) {

				if (count($database['procedure'])) {
					for ($i = 0; $i < count($database['procedure']); $i++) {
					   
						DB::procedureRaw($database['procedure'][$i]);
					}
				}
			}
			if (isset($database['function'])) {

				if (count($database['function'])) {
					for ($i = 0; $i < count($database['function']); $i++) {
					   
						DB::functionRaw($database['function'][$i]);
					}
				}
			}
			if (isset($database['view'])) {

				if (count($database['view'])) {
					for ($i = 0; $i < count($database['view']); $i++) {
					   
						DB::viewRaw($database['view'][$i]);
					}
				}
			}
			if (count($order_by)) {
				DB::orderByRaw($page, $order_by);
			}
			if (isset($database['order_by_filter'])) {
				DB::orderByFilterRaw($page, $database['order_by_filter']);
			}
			if (count($group_by)) {
				DB::groupByRaw($page, $group_by);
			}


			if ($limit) {

				DB::limitRaw($page, $limit);
			}
			if ($limit_raw) {
				DB::limitRaw($page, $limit_raw);
			}
			$row = DB::get($exec);

			return $row;
		} else {
			if ($query) {
				DB::queryRaw($page, $query . ' ' . ($limit ? ' LIMIT ' . $limit : ''));
				$row = DB::get($exec);
				
				return $row;
			} else
				return '';
		}
	}

	public static function create_database_check($page, $array, $database_utama, $primary_key, $database_provider, $app_framework = null, $database_sub = '', $db_sub = array())
	{
		$fai = new MainFaiFramework();
		$schema = $page['conection_scheme'].'.';
		if($database_provider=='mysql'){
		    $schema = '';
		    
		}
		$array = Database::converting_array_field($page, $array);
		// $primary_key = Database::converting_primary_key($page,$primary_key,'');
		$collect_udah = [];
	
		if (!empty($page['database']['no_checking'])) {
    
		} else if (!$database_utama) {
		} else if (!isset($page['no_checking'])  and !isset($page['load']['database']['not_create_database_check'])  and !isset($page['database']['no_checking'])) {
		   
		    if($array != null){
			$array_temp['array'] = $array;
			$checking = $fai->checking_database($page, $database_utama);;
			if (!$checking->exists_) {
                if($database_provider=='postgres')
				$sqlcreate = "CREATE TABLE $schema$database_utama (";
				else 
				$sqlcreate = "CREATE TABLE $database_utama (";
				if ($database_provider == 'postgres') {
					$sqlcreate .= "$primary_key integer DEFAULT nextval('seq_$database_utama'::regclass) NOT NULL,
				";
					$collect_udah[] = "$primary_key";
				} else {
					$sqlcreate .= "`$primary_key`  int(11) NOT NULL,
				";
					$collect_udah[] = "$primary_key";
				}
				if (strlen($database_sub) > 0) {

					if ($database_provider == 'postgres') {
						$sqlcreate .= Database::converting_primary_key($page, $database_sub, 'primary_key') . " integer DEFAULT NULL,
							";
						$collect_udah[] = Database::converting_primary_key($page, $database_sub, 'primary_key');
					} else {
						$sqlcreate .= "`" . Database::converting_primary_key($page, $database_sub, 'primary_key') . "` int(11) DEFAULT NULL,
							";
						$collect_udah[] = Database::converting_primary_key($page, $database_sub, 'primary_key');
					}
				}
				if (count($db_sub) > 0) {
					if ($database_provider == 'postgres') {
						$sqlcreate .= Database::converting_primary_key($page, $database_utama, 'ontable') . " integer DEFAULT NULL,
						";
						$collect_udah[] = Database::converting_primary_key($page, $database_utama, 'ontable');
					} else {
						$sqlcreate .= "`" . Database::converting_primary_key($page, $database_utama, 'ontable') . "` int(11) DEFAULT NULL,
						";
						$collect_udah[] = Database::converting_primary_key($page, $database_utama, 'ontable');
					}

					for ($z = 0; $z < count($db_sub); $z++) {
						// if(){
						if (!in_array(Database::converting_primary_key($page, $db_sub[$z], 'primary_key'), $collect_udah)) {

							if ($database_provider == 'postgres') {
								$sqlcreate .= Database::converting_primary_key($page, $db_sub[$z], 'primary_key') . " integer DEFAULT NULL,
							";
								$collect_udah[] = Database::converting_primary_key($page, $db_sub[$z], 'ontable');
							} else {
								$sqlcreate .= "`" . Database::converting_primary_key($page, $db_sub[$z], 'primary_key') . "` int(11) DEFAULT NULL,
							";
								$collect_udah[] = Database::converting_primary_key($page, $db_sub[$z], 'ontable');
								// }
							}
						}
					}
				}
              

				for ($i = 0; $i < count($array); $i++) {
					$field = $array[$i][1];

					$type = $array[$i][2];
					$extype = explode('-', $type);

					if (isset($page['crud']['split_database']['array'][$field])) {
						// $visible = false;
						// echo '$field split';
					} else
					if ($array[$i][2] == 'array_website' and !in_array(DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['field'], $collect_udah)) {
						$sqlcreate .= DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['sqlcreate'] . ",
						";
						$collect_udah[] = DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['field'];
						foreach ($array[$i][4]['connect'] as $to_key => $to_value) {
							$to_array[$to_key] = array(null, $to_value[0], $to_value[1]);
							$sqlcreate .= DatabaseFunc::sqlcreate($database_utama, $to_value[0], $to_array, $to_key, $database_provider, $page)['sqlcreate'] . ",
							";
							$collect_udah[] = DatabaseFunc::sqlcreate($database_utama, $to_value[0], $to_array, $to_key, $database_provider, $page)['field'];
						}
					} else
					if ($array[$i][2] != 'modalform-subkategori-add' and $array[$i][2] != 'div' and !in_array(DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['field'], $collect_udah)) {
                        $funcCreate = DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page);
                        
						$sqlcreate .= $funcCreate['sqlcreate'] . ",
						";
						$collect_udah[] = $funcCreate['field'];
					}
				}

				if ($database_provider == 'postgres') {
					$sqlcreate .= " 
						    
						    active integer DEFAULT 1
						    
						);";
				} else {
					$sqlcreate .= " 
						   
						    active int(11)  DEFAULT 1
						  
						);";
				}
				if ($database_provider == 'postgres') {


					DB::connection($page);

					$check_seq = Database::checking_database($page, "seq_$database_utama");
					if (!$check_seq->exists_) {
						DB::select("CREATE SEQUENCE $schemaseq_$database_utama
										    START WITH 1
										    INCREMENT BY 1
										    NO MINVALUE
										    NO MAXVALUE
										    CACHE 1;");
					}
					if ($page['section'] != 'viewsource') {

						DB::select($sqlcreate);
						DB::select("ALTER TABLE ONLY $schema$database_utama
		    					ADD CONSTRAINT " . $database_utama . "_pkey PRIMARY KEY ($primary_key);");
						DB::select("ALTER TABLE $schemaseq_$database_utama OWNER TO postgres;");
						DB::select("ALTER TABLE $schema$database_utama OWNER TO postgres;");
						/*JANGAN DIHAPUS*/
						echo '<script> window.location.href="' . $page['route_page'] . '"</script>';
					} else {
						echo $sqlcreate;
					}
				} else {
					if ($page['section'] != 'viewsource') {
						DB::select($sqlcreate);
						DB::select("ALTER TABLE `$database_utama`
													ADD PRIMARY KEY (`$primary_key`);");
						DB::select("ALTER TABLE `$database_utama`
										MODIFY `$primary_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
										");
						/*JANGAN DIHAPUS*/
						if(isset($page['route_page']))
						echo '<script> window.location.href="' . $page['route_page'] . '"</script>';
					} else {
						echo $sqlcreate;
						echo "ALTER TABLE `$database_utama`
													ADD PRIMARY KEY (`$primary_key`);";
					}
				}
			}
		    }


			$columns = DB::getColumnListing($page, $database_provider, $database_utama);
			$page['crud']['database_utama'] = $database_utama;
			for ($i = 0; $i < count($array); $i++) {

				$field = strtolower($array[$i][1]);

				$type = $array[$i][2];

				if ($database_provider == 'postgres')
					$after = "";
				else {
					if ($i > 0)
						$after = " AFTER `" . $array[$i - 1][1] . "`";
					else
						$after = " AFTER `id`";
				}
				if (isset($page['crud']['split_database']['array'][$field])) {
				} else if ($array[$i][2] == 'array_website' and !in_array(DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['field'], $collect_udah)) {
					if (!in_array($field, $columns)) {

						$sql_alter = DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['alter'] . "";
						DB::select($sql_alter);
					}
					foreach ($array[$i][4]['connect'] as $to_key => $to_value) {
						$to_array[$to_key] = array(null, $to_value[0], $to_value[1]);
						if (!in_array($to_value[0], $columns)) {

							$sql_alter = DatabaseFunc::sqlcreate($database_utama, $to_value[0], $to_array, $to_key, $database_provider, $page)['alter'] . "";
							DB::select($sql_alter);
						}
					}
				} else if (((!in_array($field, $columns) and ($array[$i][2] != 'select-appr')) or (($array[$i][2] == 'select-appr') and !in_array($field . '_status', $columns))) and $array[$i][2] != 'modalform-subkategori-add') {

					echo $sql_alter = "ALTER TABLE $schema$database_utama ADD $field" . ($array[$i][2] != 'select-appr' ? " " : "") . DatabaseFunc::sqlcreate($database_utama, $field, $array, $i, $database_provider, $page)['type_data'] . " $after;";
					DB::select($sql_alter);
				}
			}


			$columns = DB::getColumnListing($page, $database_provider, $database_utama);
			//print_R($columns);
			if ($database_provider == 'postgres') {

				$get_sub = Database::converting_primary_key($page, $database_sub, 'primary_key');
				if (strlen($database_sub) > 0 and !in_array($get_sub, $columns)) {
					DB::select("ALTER TABLE $schema$database_utama ADD $get_sub numeric DEFAULT null;");
				}


				if (!isset($page['load']['database']['not_faiframework_database'])) {
					if (!in_array('on_web_apps', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_web_apps text DEFAULT null;");
					}
					if (!in_array('on_domain', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_domain text DEFAULT null;");
					}
					if (!in_array('on_panel', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_panel numeric DEFAULT null;");
					}
					if (!in_array('on_board', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_board numeric DEFAULT null;");
					}
					if (!in_array('on_role', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_role numeric DEFAULT null;");
					}
					if (!in_array('privilege', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD privilege varchar(200) DEFAULT 'Private Website';");
					}
				}
				if (!in_array((isset($page['load']['database']['active']) ? $page['load']['database']['active'] : "active"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD " . (isset($page['load']['database']['active']) ? $page['load']['database']['active'] : "active") . " integer DEFAULT 1;");
				}
				if (!in_array((isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD  " . (isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date") . " timestamp without time zone;");
					DB::select("ALTER TABLE $schema$database_utama ADD  " . (isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by") . " numeric DEFAULT NULL::numeric;");
				}
				if (!in_array((isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD  " . (isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date") . " timestamp without time zone;");
					DB::select("ALTER TABLE $schema $database_utama ADD  " . (isset($page['load']['database']['update_by']) ? $page['load']['database']['update_by'] : "update_by") . " numeric DEFAULT NULL::numeric;");
				}

				if (!in_array((isset($page['load']['database']['delete_date']) ? $page['load']['database']['delete_date'] : "delete_date"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD  " . (isset($page['load']['database']['delete_date']) ? $page['load']['database']['delete_date'] : "delete_date") . " timestamp without time zone;");
					DB::select("ALTER TABLE $schema$database_utama ADD  " . (isset($page['load']['database']['delete_by']) ? $page['load']['database']['delete_by'] : "delete_by") . " numeric DEFAULT NULL::numeric;");
				}
				if (!isset($page['load']['database']['not_faiframework_database'])) {
					if (!in_array('timezone', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD  timezone character varying(255);");
					}
				}
			} else {
				if (!isset($page['load']['database']['not_faiframework_database'])) {
					if (!in_array('on_web_apps', $columns)) {

						DB::select("ALTER TABLE $schema$schema$database_utama ADD on_web_apps text DEFAULT null;");
					}
					if (!in_array('on_domain', $columns)) {

						DB::select("ALTER TABLE $schema$schema$database_utama ADD on_domain text DEFAULT null;");
					}
					if (!in_array('on_panel', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_panel int(11) DEFAULT null;");
					}
					if (!in_array('on_board', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_board int(11) DEFAULT null;");
					}
					if (!in_array('on_role', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD on_role int(11) DEFAULT null;");
					}
					if (!in_array('privilege', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD privilege varchar(200) DEFAULT 'Private Website';");
					}
				}
				if (!in_array((isset($page['load']['database']['active']) ? $page['load']['database']['active'] : "active"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['active']) ? $page['load']['database']['active'] : "active") . " int(11) DEFAULT 1;");
				}
				if (!in_array((isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date") . " datetime  DEFAULT NULL");
					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by") . " int(11) DEFAULT NULL;");
				}
				if (!in_array((isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date") . " datetime  DEFAULT NULL;");
					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['update_by']) ? $page['load']['database']['update_by'] : "update_by") . " int(11) DEFAULT NULL;");
				}
				if (!in_array((isset($page['load']['database']['delete_date']) ? $page['load']['database']['delete_date'] : "delete_date"), $columns)) {

					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['delete_date']) ? $page['load']['database']['delete_date'] : "delete_date") . " datetime  DEFAULT NULL;");
					DB::select("ALTER TABLE $schema$database_utama ADD COLUMN " . (isset($page['load']['database']['delete_by']) ? $page['load']['database']['delete_by'] : "delete_by") . " int(11) DEFAULT NULL;");
				}
				if (!isset($page['load']['database']['not_faiframework_database'])) {
					if (!in_array('timezone', $columns)) {

						DB::select("ALTER TABLE $schema$database_utama ADD  timezone varchar(255);");
					}
				}
			}
			if (isset($modaform['table'][0])) {

				for ($x = 0; $x < count($modaform['table']); $x++) {
					Database::create_database_check($page, $modaform['array'][$x], $modaform['table'][$x], Database::converting_primary_key($page, $modaform['table'][$x], 'primary_key'), $page['database_provider'], $page['app_framework'], $database_sub, array($modaform['database_sub'][$x]));
				}
			}
		}
	}

	public static function checking_database($page, $database_utama)
	{
		if (substr(trim($database_utama), 0, 1) == '(') {
		} else
		if (!isset($page['no_checking']) and !isset($page['database']['no_checking']) and !stripos(trim($database_utama), ' as ') and substr(trim($database_utama), 0, 1) != '(') {

			$schema = isset($page['conection_scheme']) ? $page['conection_scheme'] : 'public';
			$databaseName = $page['conection_name_database'];
			$app_framework = $page['app_framework'];
			$database_provider = $page['database_provider'];
			if ($database_provider == 'postgres') {
				$sqlcheck = "SELECT EXISTS (
				   SELECT FROM information_schema.tables 
				   WHERE  table_schema = '$schema'
				   AND    table_name   = '$database_utama'
				   ) as exists_;;";
				DB::connection($page);

				$checking = DB::fetchResponse(DB::select($sqlcheck, 'SELECT'));;
				$checking = $checking[0];
				if ($checking->exists_ == 'f')
					$checking->exists_ = 0;
				else
					$checking->exists_ = 1;
			} else {
				$sqlcheck = "SELECT count(*) as  exists_
							FROM information_schema.tables
							WHERE  table_name = '$database_utama'
							LIMIT 1;";
				DB::connection($page);

				$checking = DB::fetchResponse(DB::select($sqlcheck, 'SELECT'));;
				$checking = $checking[0];
			}
		} else {
			$vars = (object)array("exists_" => 1);
			$checking = $vars;
		}

		return $checking;
	}

	public static function converting_array_field($page, $array, $type_convert = null)
	{
		if (!isset($page['load']['database']['id'])) {

			$page['load']['database']['id']['text'] = 'id';
			$page['load']['database']['id']['type'] = 'prefix'; //prefix//sufix
			$page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id
		}
		$perubahan = array();
		$perubahan = array();
		if ($array) {

			for ($i = 0; $i < count($array); $i++) {


				if (!($array[$i][0])) {
					$array[$i][0] = ucwords(str_replace("_", " ", ($array[$i][1])));
				}
				$text = $array[$i][0];
				$field = $array[$i][1];

				if (!$field) {
					$field = str_replace(" ", "_", strtolower($text));
					if (strpos($field, '('))
						$field = substr($field, 0, strpos($field, '('));
					if (strpos($field, '?'))
						$field = substr($field, 0, strpos($field, '?'));
					if (strpos($field, '!'))
						$field = substr($field, 0, strpos($field, '?!'));
				}
				if (!$text or $text == null) {
					$field_temp = $field;

					$text = $field_temp;
				}
				if (substr($text, -4) == '_seq') {
					$text = substr($text, 0, -4);
				}
				if (substr($text, -3) == '_id') {
					$text = substr($text, 0, -3);
				}
				if (substr($text, 0, 3) == 'id_') {
					$text = substr($text, 3);
				}
				$text = ucwords(str_replace("_", " ", strtolower($text)));
				$array[$i][0] = $text;

				$type = $array[$i][2];
				if ($type == 'select' or $type == 'select-relation') {
					$field_temp = $field;
					if (substr($field, -4) == '_seq') {
						$field = substr($field, 0, -4);
					}
					if (substr($field, -3) == '_id') {
						$field = substr($field, 0, -3);
					}
					if (substr($field, 0, 3) == 'id_') {
						$field = substr($field, 3);
					}
					if ($page['load']['database']['id']['type'] == 'suffix') {
						$field = $field . '_' . $page['load']['database']['id']['text'];
					} else {
						$field = $page['load']['database']['id']['text'] . '_' . $field;
					}
					if (isset($array[$i][4])) {
						if ($array[$i][4]) {
							$field = $array[$i][4];
						}
					}
					$perubahan[$field_temp] = $field;
					$array[$i][1] = $field;

					if (!isset($array[$i][3]))
						$array[$i][3] = null;
				} else
					$array[$i][1] = $field;


				if ($array[$i][2] == 'select') {
					if (!isset($array[$i][3])) {
						echo $array[$i][0] . ' Belum lengkap';
						die;
					}
					if (!isset($array[$i][3][1])) {

						$array[$i][3][1] = Database::converting_primary_key($page, $array[$i][3][0], 'ontable');
					}
					if ($array[$i][3][1] == null) {
						$array[$i][3][1] = Database::converting_primary_key($page, $array[$i][3][0], 'ontable');
					}
					if (!isset($array[$i][4])) {
						$array[$i][4] = null;
					}
				}
			}
		}
		if ($type_convert == 'all') {
			$return['array'] = $array;
			$return['perubahan'] = $perubahan;
			return $return;
		} else
			return $array;
	}
	public static function converting_primary_key($page, $page_database, $type)
	{
		if (!isset($page['load']['database']['id'])) {

			$page['load']['database']['id']['text'] = 'id';
			$page['load']['database']['id']['type'] = 'prefix'; //prefix//sufix
			$page['load']['database']['id']['on_table'] = false; //true->id_(nama table)//false->just id
		}

		if ($type == 'primary_key') {

			if (substr($page_database, -4) == '_seq') {
				$page_database = substr($page_database, 0, -4);
			}
			if (substr($page_database, -3) == '_id') {
				$page_database = substr($page_database, 0, -3);
			}

			if (substr($page_database, 0, 3) == 'id_') {
				$page_database = substr($page_database, 3);
			}
			$page['load']['database']['id']['type'];
			if ($page['load']['database']['id']['type'] == 'suffix') {
				return $page_database . '_' . $page['load']['database']['id']['text'];
			} else if ($page['load']['database']['id']['type'] == 'prefix') {
				return $page['load']['database']['id']['text'] . '_' . $page_database;
			}
		} else if ($type == 'ontable') {
			$return['ONTABLE'] = '';
			if ($page['load']['database']['id']['on_table']) {
				if ($page['load']['database']['id']['type'] == 'suffix') {
					$return['ONTABLE']  .= $page_database . '_';
				}
			}
			$return['ONTABLE'] .= $page['load']['database']['id']['text'];
			if ($page['load']['database']['id']['on_table']) {
				if ($page['load']['database']['id']['type'] == 'prefix') {
					$return['ONTABLE']  .= '_' . $page_database;
				}
			}
			return $return['ONTABLE'];
		} else if ($type == 'get') {

			$return['ONTABLE'] = '';
			if ($page['load']['database']['id']['on_table']) {
				if ($page['load']['database']['id']['type'] == 'suffix') {
					$return['ONTABLE']  .= $page_database . '_';
				}
			}
			$return['ONTABLE'] .= $page['load']['database']['id']['text'];
			if ($page['load']['database']['id']['on_table']) {
				if ($page['load']['database']['id']['type'] == 'prefix') {
					$return['ONTABLE']  .= '_' . $page_database;
				}
			}
			$return['ONRELATION'] = '';
			if ($page['load']['database']['id']['type'] == 'suffix') {
				$return['ONRELATION']  .= $page_database . '_';
			}

			$return['ONRELATION'] .= $page['load']['database']['id']['text'];
			if ($page['load']['database']['id']['type'] == 'prefix') {
				$return['ONRELATION']  .= '_' . $page_database;
			}

			return $return;
		} else {

			if ($type == 'utama')
				$return['database'] = $page_database;
			else if ($type == 'select') {
				$return['database']['utama'] = $page_database[0];
				$return['database']['primary_key'] = NULL;
			} else if ($type == 'select_utama') {
				$return['database']['utama'] = $page_database[0];
				$return['database']['primary_key'] = NULL;
			}

			if ($return['database']['primary_key'] == null) {
				$return['database']['primary_key'] = '';
				if ($page['load']['database']['id']['on_table']) {
					if ($page['load']['database']['id']['type'] == 'suffix') {
						$return['database']['primary_key'] .= $return['database']['utama'] . '_';
					}
				}
				$return['database']['primary_key'] .= $page['load']['database']['id']['text'];
				if ($page['load']['database']['id']['on_table']) {
					if ($page['load']['database']['id']['type'] == 'prefix') {
						$return['database']['primary_key'] .= '_' . $return['database']['utama'];
					}
				}
			}
			$database_utama = isset($return['database']['alias']) ? $return['database']['alias'] : $return['database']['utama'];
			$primary_key = $return['database']['primary_key'];
			if (isset($return['database']['non_add_select'])) {
			} else
			if (!isset($return['database']['select']) and !isset($return['database']['non_add_select'])) {
				$return['database']['select'] = array("*", "$database_utama.$primary_key as primary_key");
			} else {
				if (!in_array("$database_utama.$primary_key as primary_key", $return['database']['select'])) {
					$return['database']['select'][] = "$database_utama.$primary_key as primary_key";
				}
			}
			//foreach($page['database'] as $key => $value){
			//	$page['database'][$key]
			//}
			if ($type == 'utama')
				return $return['database'];
			else if ($type == 'select') {
				return $return['database']['primary_key'];
			} else if ($type == 'select_utama') {
				return $return['database'];
			}
		}
	}


	public static function get_database_panel($page, $nama_database, $get_return = 'id')
	{
		$array = array(
			array("Id Panel", "id_panel", 'number'),
		);
		Database::create_database_check($page, $array, $nama_database, Database::converting_primary_key($page, $nama_database, 'ontable'), $page['database_provider'], $page['app_framework']);
		$panel = PanelFunc::panel_initial($page, 'all');
		$id_panel = $panel['id_panel'];
		$page['section'] = '';
		$database['utama'] = trim($nama_database);
		$database['primary_key'] = Database::converting_primary_key($page, $nama_database, 'ontable');
		$database['where'][] = array("id_panel", "=", "'" . $id_panel . "'");
		$get = Database::database_coverter($page, $database, $array, 'all', false);
		if (!($get['num_rows'])) {
			$sqli['id_panel'] = $id_panel;

			CRUDFunc::crud_insert(false, $page, $sqli, [], $nama_database, []);

			$get = Database::database_coverter($page, $database, $array, 'exec', false);
		} else {
			$get = $get['row'];
		}
		if ($get_return == 'id')
			return $get[0]->primary_key;
		else if ($get_return == 'all') {
			$return['id_panel'] = $id_panel;
			$return['id_database_panel'] = $get[0]->primary_key;
			$return['panel'] = $panel['panel'];
			return $return;
		}
	}
	public static function check_input_column_exist($page, $sqli, $database_utama)
	{
		echo $database_utama;
		$columns = Database::getColumnListing($page, $page['database_provider'], $database_utama);
		foreach ($sqli as $key => $value) {
			if (!in_array($key, $columns)) {
			}
		}
	}
}
