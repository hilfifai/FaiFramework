<?php
date_default_timezone_set("Asia/Jakarta");
class CRUDFunc2
{

	public static  function insert_number_code_nomor($fai, $page, $field, $valueinput)
	{
		$return_content = "";
		if (!isset($page['crud']['view'])) {
			$page['crud']['view'] = $page['load']['type'];
		}
		if (
			(isset($page['crud']['insert_number_code'][$field]) and (in_array($page['crud']['view'], array('tambah', 'all_viewsource'))   or in_array($fai->input('_view'), array('tambah'))))
			or
			(isset($page['crud']['update_number_code'][$field]) and (in_array($page['crud']['view'], array('edit'))   or in_array($fai->input('_view'), array('edit'))) and !$valueinput)
		) {
			if ((in_array($page['crud']['view'], array('edit'))   or in_array($fai->input('_view'), array('edit')))) {

				unset($page['crud']['insert_number_code'][$field]);
			}
			if ((isset($page['crud']['update_number_code'][$field]) and (in_array($page['crud']['view'], array('edit'))   or in_array($fai->input('_view'), array('edit'))) and !$valueinput)) {
				unset($page['crud']['insert_number_code'][$field]);
				$page['crud']['insert_number_code'][$field] = $page['crud']['update_number_code'][$field];
			}
			$string = isset($page['crud']['insert_number_code'][$field]['prefix']) ? CRUDFunc::default_value($page['crud']['insert_number_code'][$field]['prefix'], $page) : '';

			if ($page['section'] == 'viewsource') {
				$return_content .=  '<?php ';
				$return_content .=  '$string = "' . $string . '";';
			}

			for ($is = 0; $is < count($page['crud']['insert_number_code'][$field]['root']['type']); $is++) {
				unset($insert_number_code);
				$root = "";
				$plus = (isset($page['crud']['insert_number_code'][$field]['root']['plus']) ? '+' . $page['crud']['insert_number_code'][$field]['root']['plus'] : 0);
				if (
					$page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count' or
					$page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count-month' or
					$page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'max' or
					$page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'max-month'
				) {

					$insert_number_code['utama'] = isset($page['crud']['insert_number_code'][$field]['database_utama']) ? $page['crud']['insert_number_code'][$field]['database_utama'] : $page['database']['utama'];
					if ($page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count' or $page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count-month')
						$insert_number_code['select'][] = 'count(*) as total';
					else if ($page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'max' or $page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'max-month')
						$insert_number_code['select'][] = 'max(' . $page['database']['primary_key'] . ') as total';
					if (isset($page['crud']['insert_number_code'][$field]['root']['not_string'])) {
						$insert_number_code['where'][] = array($insert_number_code['utama'] . "." . $page['crud']['insert_number_code'][$field]['root']['not_string'], " is  ", " not null");
					}
					if ($page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'max-month' or $page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count-month') {
						$tahun = date('Y');
						$bulan = date('m');
						if ($bulan == 12) {
							$tahun_plus_1 = $tahun + 1;
							$bulan_plus_1 = 1;
						} else {
							$tahun_plus_1 = $tahun;
							$bulan_plus_1 = $bulan + 1;
						}
						if ($page['section'] == 'viewsource') {
							$return_content .= '
    						
    						$tahun = date("Y");
    						$bulan = date("m");
    						if($bulan==12){
    							$tahun_plus_1 =$tahun+1;
    							$bulan_plus_1 =1;
    						}else{
    							$tahun_plus_1 =$tahun;
    							$bulan_plus_1 =$bulan+1;
    	
    						} ';
							$insert_number_code['where'][] = array($insert_number_code['utama'] . "." . $page['crud']['insert_number_code'][$field]['root']['month_get_row_where'][$is], ">=", "'" . '$tahun-$bulan-01' . "'");
							$insert_number_code['where'][] = array($insert_number_code['utama'] . "." . $page['crud']['insert_number_code'][$field]['root']['month_get_row_where'][$is], "<", "'" . '$tahun_plus_1-$bulan_plus_1-01' . "'");
						} else {
							$insert_number_code['where'][] = array($insert_number_code['utama'] . "." . $page['crud']['insert_number_code'][$field]['root']['month_get_row_where'][$is], ">=", "'$tahun-$bulan-01'");
							$insert_number_code['where'][] = array($insert_number_code['utama'] . "." . $page['crud']['insert_number_code'][$field]['root']['month_get_row_where'][$is], "<", "'$tahun_plus_1-$bulan_plus_1-01'");
						}
					}

					$insert_number_code['non_add_select'] = true;

					if ($page['section'] == 'viewsource') {

						$row_insert = $fai->database_coverter($page, $insert_number_code, null, 'source');
						$query = $row_insert;
						$return_content .= '
    					$sql="' . $query . '";';
						$return_content .= '$' . $field . '=DB::connection()->select($sql);';
						$return_content .= '$root = $' . $field . '[0]->total+1' . (isset($page['crud']['insert_number_code'][$field]['root']['plus']) ? '+' . $page['crud']['insert_number_code'][$field]['root']['plus'] : '') . ';';
					} else {
						$row_insert = $fai->database_coverter($page, $insert_number_code, null, 'all');
						// echo $row_insert['query'];

						$root = $row_insert['row'][0]->total + 1 + $plus;
					}
				} else if ($page['crud']['insert_number_code'][$field]['root']['type'][$is] == 'count-parent') {;
					$insert_number_code['utama'] = isset($page['crud']['insert_number_code'][$field]['database_utama']) ? $page['crud']['insert_number_code'][$field]['database_utama'] : $page['database']['utama'];
					$insert_number_code['where'][] = [$insert_number_code['utama'] . '.' . $page['crud']['insert_number_code'][$field]['data-parent'], "=", isset($page['crud']['insert_number_code'][$field]['id-parent']) ? $page['crud']['insert_number_code'][$field]['id-parent'] : 0];
					$insert_number_code['select'][] = 'count(*) as total';
					$insert_number_code['non_add_select'] = true;
					$row_insert = $fai->database_coverter($page, $insert_number_code, null, 'all');
					if (isset($page['crud']['insert_number_code'][$field]['id-parent'])) {

						$insert_number_code2['utama'] = isset($page['crud']['insert_number_code'][$field]['database_utama']) ? $page['crud']['insert_number_code'][$field]['database_utama'] : $page['database']['utama'];
						$insert_number_code2['where'][] = [$insert_number_code['utama'] . '.id', "=", isset($page['crud']['insert_number_code'][$field]['id-parent']) ? $page['crud']['insert_number_code'][$field]['id-parent'] : 0];

						$row_insert2 = $fai->database_coverter($page, $insert_number_code2, null, 'all');

						$string = $row_insert2['row'][0]->$field;
						if (isset($page['crud']['insert_number_code'][$field]['parent-separator'])) {

							$string .= $page['crud']['insert_number_code'][$field]['parent-separator'];
						}
					}
					$insert_number_code['select'][] = 'count(*) as total';

					$root = $row_insert['row'][0]->total + 1 + $plus;
				}
				if (isset($page['crud']['insert_number_code'][$field]['root']['sprintf'][$is])) {
					if ($page['section'] == 'viewsource') {
						$return_content .= '$root= sprintf("%0' . $page['crud']['insert_number_code'][$field]['root']['sprintf_number'][$is] . 'd", $root);';
					} else {
						$root = sprintf('%0' . $page['crud']['insert_number_code'][$field]['root']['sprintf_number'][$is] . 'd', $root);
					}
				}
				if ($page['section'] == 'viewsource') {
					$return_content .= '$string .= $root;';
				} else {
					$string .= $root;
				}
			}
			if ($page['section'] == 'viewsource') {
				$return_content .= '$string .= "' . (isset($page['crud']['insert_number_code'][$field]['suffix']) ? $page['crud']['insert_number_code'][$field]['suffix'] : '') . '";';

				$return_content .=  '
    		?>';
				$valueinput = '<?=$string?>';
			} else {

				$string .= isset($page['crud']['insert_number_code'][$field]['suffix']) ? $page['crud']['insert_number_code'][$field]['suffix'] : '';
				$valueinput = $string;
			}
		}
		$return['valueinput'] = $valueinput;
		$return['return_content'] = $return_content;
		return $return;
	}
	public static  function wizard_form($fai, $page, $type, $id)
	{
		DB::connection($page);
		$crud = isset($page['crud']) ? $page['crud'] : array();
		//	echo $id;
		$return = Partial::checking_daftar_proses($fai, $page, $type, $id);
		$page['load']['apps'];
		$id = $return['id'];
		$type = $return['type'];
		if (isset($page['load']['login-daftar-array']['step'][$id]))
			$step = $page['load']['login-daftar-array']['step'][$id];
		$page['crud'] = isset($step['function_crud']) ? $step['function_crud'] : array();


		$page_temp  = Pages::Apps($page['load']['apps'], $page['load']['page_view'], $page);

		$page = array_merge($page, $page_temp);

		//row_to_database
		Partial::input('value_input');

		$get_where = $page['crud']['wizard_form'][Partial::input('value_input')]['get_where'];;
		$id_result_to = $page['crud']['wizard_form'][Partial::input('value_input')]['id_result_to'];;
		$config_database = $page['crud']['wizard_form'][Partial::input('value_input')]['row_to_database'];
		$config_database['where'][] = array($get_where, "=", "'" . Partial::input('this_value_input') . "'");
		$row_base_data = $fai->database_coverter($page, $config_database, null, 'all');
		$value = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['value'];
		$option = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['text'];


		if ((in_array(Partial::input('tipe_page'), array('edit')))) {
			$db = $page['database'];
			$db['where'][] = array($db['utama'] . ".id", '=', $id);
			$database = $fai->database_coverter($page, $db, null,);
		} else {
			$database[0] = (object) [$id_result_to => -1];
		}
		$content = "";

		if ($row_base_data['num_rows']) {
			$content .= "<option value=''>- Pilih -</option>";
			foreach ($row_base_data['row'] as $data) {
				$value = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['value'];
				$option = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['text'];
				$text_prefix = "";
				$text_sufix = "";

				if (isset($page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['prefix'])) {
					$prefix = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['prefix'];
					$text_prefix = "";
					for ($i = 0; $i < count($prefix); $i++) {
						//"type"=>"database","text"
						if ($prefix[$i]['type'] == 'database') {
							$row_prefix = $prefix[$i]['text'];
							$text_prefix .= $data->$row_prefix;
						} else if ($prefix[$i]['type'] == 'text') {
							$text_prefix .= $prefix[$i]['text'];
						}
					}
				}
				if (isset($page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['sufix'])) {
					$sufix = $page['crud']['wizard_form'][Partial::input('value_input')]['output_row']['sufix'];

					for ($i = 0; $i < count($sufix); $i++) {
						//"type"=>"database","text"
						if ($sufix[$i]['type'] == 'database') {
							$row_prefix = $sufix[$i]['text'];
							$text_sufix .= $data->$row_prefix;
						} else if ($sufix[$i]['type'] == 'text') {
							$text_sufix .= $sufix[$i]['text'];
						}
					}
				}
				$selected = "";

				if ($database[0]->$id_result_to == $data->$value) {
					$selected = "selected";
				}
				$content .= '<option value="' . $data->$value . '" ' . $selected . '>' . $text_prefix . $data->$option . $text_sufix . '</option>';
			}
		} else {
			$content .= "<option value=''>- Tidak Ada Data -</option>";
		}
		return $content;
	}
	public static  function unique_value($fai, $page, $type, $id)
	{
		$crud = isset($page['crud']) ? $page['crud'] : array();

		$return = Partial::checking_daftar_proses($fai, $page, $type, $id);
		$step_id = $return['id'];
		if ($step_id == -1) {
			$step_id = $page['load']['login-daftar-array']['first'];
		}


		$step = $page['load']['login-daftar-array']['step'][$step_id];
		$page['crud'] = isset($step['function_crud']) ? $step['function_crud'] : array();
		$page['crud'] = array_merge($crud, $page['crud']);
		DB::connection($page);

		$config_database = $page['crud']['unique_value'][Partial::input('value_input')]['database'];

		$config_database['where'][] = array(Partial::input('value_input'), "=", "'" . Partial::input(Partial::input('value_input')) . "'");
		$row_base_data = $fai->database_coverter($page, $config_database, null, 'all');
		echo json_encode(array("count" => $row_base_data['num_rows']));
	}
	public static function input_content($page, $database_utama, $array, $i, $typearray, $field)
	{

		if ($page['save']['section'] == 'sub_kategori') {
			if (isset($array[$i][5])) {
				$field_name = $database_utama . '_' . $array[$i][5];
			} else
				$field_name = $database_utama . '_' . $array[$i][1];


			$input_content = Partial::input($field_name) ? Partial::input($field_name) : null;

			if ($typearray != 'file' and isset($input_content[$page['save']['no_list_sub_kategori']]))
				$input_content = $input_content[$page['save']['no_list_sub_kategori']];
		} else {
			$field_name = $field;
			$input_content = Partial::input($field) ? Partial::input($field) : null;
		}

		return [
			'$input_content' => $input_content,
			'$field_name' => $field_name,
		];
	}
	public static function declare_crud_variable($fai, $page, $array, $database, $type, $search = array(), $crud = array())
	{


		$where_raw_temp = '';
		$sqli = array();
		$sqli_to_database = array();
		$sqli_to_split = array();
		$field_appr =  '';
		$where = array();
		$select = array();
		$sqlen = array();
		$sqlfile = array();
		$join = array();
		$sql_update_file = array();
		$database_utama = isset($database['utama']) ? $database['utama'] : '';
		$database_utama = isset($database['alias']) ? $database['alias'] : $database_utama;
		if (!isset($page['save']['section'])) {
			$page['save']['section'] = "";
		}

		if (!count($crud))
			$crud = $page['crud'];



		if (!empty($page['crud']['split_database']['crud'])) {
			foreach ($page['crud']['split_database']['crud'] as $db_toko => $value_split) {
				foreach ($page['crud']['split_database']['crud'][$db_toko] as $array_crud_split => $value_split) {
					foreach ($page['crud']['split_database']['crud'][$db_toko][$array_crud_split] as $field_crud_split => $value_split) {
						$crud[$array_crud_split][$field_crud_split] = $page['crud']['split_database']['crud'][$db_toko][$array_crud_split][$field_crud_split];
						$page['crud']['split_database']['array'][$field_crud_split] = $db_toko;
					}
				}
			}
		}
		if (!empty($page['crud']['split_database_sub_kategori'][$database_utama]['crud'])) {
			foreach ($page['crud']['split_database_sub_kategori'][$database_utama]['crud'] as $db_toko => $value_split) {
				foreach ($page['crud']['split_database_sub_kategori'][$database_utama]['crud'][$db_toko] as $array_crud_split => $value_split) {
					foreach ($page['crud']['split_database_sub_kategori'][$database_utama]['crud'][$db_toko][$array_crud_split] as $field_crud_split => $value_split) {
						$crud[$array_crud_split][$field_crud_split] = $page['crud']['split_database_sub_kategori'][$database_utama]['crud'][$db_toko][$array_crud_split][$field_crud_split];
						$page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field_crud_split] = $db_toko;
					}
				}
			}
		}
		if ($type == 'get_execution_import') {
			
			foreach($array as $key => $input_content){
				if($page['save']['section']=='utama'){

					$array_crud = $page['crud']['array'];
					
					
				}else{
					
					$array_crud = $page['crud']['array_sub_kategori'][$page['crud']['field_sub_kategori'][$database]];
					
				}
				$i = $page['crud']['field_array'][$key];
				$field = $array_crud[$i][1];
				$typearray = CrudContent::typearray($page, $array_crud, $i)['type'];


				
				$input_content = str_replace("'", "{KUTIP}", $input_content);

				$array_declare = CRUDFunc::array_declare($fai, $page, $database_utama, $input_content, $array_crud, $i);


				if ($array_declare['return_var'] == 'sqli') {
					$sqli[$field] = $array_declare['return_data'];
				} else if ($array_declare['return_var'] == 'sqlfile') {
					$sqlfile[$i] = $array_declare['sqlfile'];
					$sqlfile[$i][6] = $input_content;

				} else if ($array_declare['return_var'] == 'sqli_to_split') {
					$sqli_to_split[$array_declare['db_sql_split']][$field] = $array_declare['return_data'];
				}
			}
		} else {
			 
			for ($i = 0; $i < count($array); $i++) {
				$field = $array[$i][1];
				$typearray = CrudContent::typearray($page, $array, $i)['type'];

				if ($typearray == 'file' or $typearray == "photos" or $typearray == "file-upload"  or $typearray == 'video') {
					$input_content = CRUDFunc::input_content($page, $database_utama, $array, $i, $typearray, $field)['$field_name'];
				}else{

					$input_content = CRUDFunc::input_content($page, $database_utama, $array, $i, $typearray, $field)['$input_content'];
				}
				$input_content = str_replace("'", "{KUTIP}", $input_content);

				$array_declare = CRUDFunc::array_declare($fai, $page, $database_utama, $input_content, $array, $i);


				if ($array_declare['return_var'] == 'sqli') {
					$sqli[$field] = $array_declare['return_data'];
				} else if ($array_declare['return_var'] == 'sqlfile') {
					$sqlfile[$i] = $array_declare['sqlfile'];
				} else if ($array_declare['return_var'] == 'sqli_to_split') {
					$sqli_to_split[$array_declare['db_sql_split']][$field] = $array_declare['return_data'];
				}
			}
		}


		if ($page['save']['section'] != 'sub_kategori') {

			if (isset($crud['insert_default_value'])) {

				foreach ($crud['insert_default_value'] as $field => $value) {

					$return_data = CRUDFunc::default_value($value, $page);
					if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {
						if ($return_data)
							$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $return_data;
					} else {
						if ($return_data)
							$sqli[$field] = $return_data;
					}
				}
			}

			if (isset($crud['insert_default_value_request'])) {
				foreach ($crud['insert_default_value_request'] as $field => $value) {
					$var = $value;
					$return_data = Partial::input($var);
					if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {
						if ($return_data)
							$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $return_data;
					} else {
						if ($return_data)
							$sqli[$field] = $return_data;
					}
				}
			}

			if (isset($crud['crud_function'])) {
				foreach ($crud['crud_function'] as $field => $value) {
					if ($value == 'hash') {
						if (Partial::input($field))
							$return_data = Hash::make(Partial::input($field));
					} else if ($value == 'hapusrupiah') {
						if (Partial::input($field))
							$return_data = $fai->hapusRupiah(Partial::input($field));
					}
					if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {
						if ($return_data)
							$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $return_data;
					} else {
						if ($return_data)
							$sqli[$field] = $return_data;
					}
				}
			}
		}
		if (isset($crud['insert_default_value_sub_kategori_request'][$database_utama])) {
			foreach ($crud['insert_default_value_sub_kategori_request'][$database_utama] as $field => $value) {
				$var =  $value;
				$return_data = $sqli[$var];
				$sqli[$field] = $return_data;
			}
		}

		if (isset($crud['crud_function_sub_kategori'][$database_utama])) {
			foreach ($crud['crud_function_sub_kategori'][$database_utama] as $key => $value) {
				if ($value == 'hash') {
					if (Partial::input($key))
						$sqli[$key] = Hash::make(Partial::input($key));
				} else if ($value == 'hapusrupiah') {
					if (Partial::input($key))
						$sqli[$key] = $fai->hapusRupiah(Partial::input($key));
				}
			}
		}

		if (isset($crud['insert_number_code_value'])) {
			foreach ($crud['insert_number_code_value'] as $key => $value) {

				$sqli[$key] = CRUDFunc::insert_number_code_nomor($fai, $page, $key, '');
			}
		}
		if (isset($crud['get_last_value'])) {

			foreach ($crud['get_last_value'] as $field => $value) {

				$return_data = "LAST_INSERT:$value|";
				if ($page['save']['section'] == 'sub_kategori' and isset($page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field])) {
					// echo 'masuk2';
					if ($return_data)
						$sqli_to_split[$page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field]][$field] = $return_data;
				} else
				if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {
					// echo 'masuk';
					if ($return_data)
						$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $return_data;
				} else {
					// echo 'masuk2';
					if ($return_data)
						$sqli[$field] = $return_data;
				}
			}
		}




		$database_utama_temp = $database_utama;
		if (isset($page['crud']['total']['content'][0]) and $database_utama == $page['database']['utama']) {
			//echo $page['database_provider'];
			DB::connection($page);
			$columns = DB::getColumnListing($page, $page['database_provider'], $database_utama);

			for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {

				if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi' or $page['crud']['total']['content'][$k]["type"] == 'input_no_result') {

					if (isset($page['crud']['total']['content'][$k]["add_button_multi"])) {

						if ($page['crud']['total']['content'][$k]["add_button_multi"]) {

							//$sqli_to_database
							if (Partial::input($page['crud']['total']['content'][$k]["id"] . '_input')) {
								for ($x = 0; $x < count(Partial::input($page['crud']['total']['content'][$k]["id"] . '_input')); $x++) {
									if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
										if (isset($page['crud']['total']['content'][$k]["with_input"])) {
											if ($page['crud']['total']['content'][$k]["with_input"]) {
												$array = ($page['crud']['total']['content'][$k]["array"]);
												for ($i = 0; $i < count($array); $i++) {
													$sqli_to_database[$database_utama_temp . "_" . $page['crud']['total']['content'][$k]["id"]]['sqli'][$page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]] =
														Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]);
													$sqli_to_database[$database_utama_temp . "_" . $page['crud']['total']['content'][$k]["id"]]['array'][] = array("", $page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1], "number");
												}
											}
										}
									}
									$sqli_to_database[$database_utama_temp . "_" . $page['crud']['total']['content'][$k]["id"]]['sqli']["total_" . $page['crud']['total']['content'][$k]["id"]] = Partial::input("total_" . $page['crud']['total']['content'][$k]["id"]);
									$sqli_to_database[$database_utama_temp . "_" . $page['crud']['total']['content'][$k]["id"]]['sqli']["select_type_" . $page['crud']['total']['content'][$k]["id"]] = Partial::input("select_type_" . $page['crud']['total']['content'][$k]["id"]);
									$sqli_to_database[$database_utama_temp . "_" . $page['crud']['total']['content'][$k]["id"]]['sqli'][$page['crud']['total']['content'][$k]["id"]] = Partial::input($page['crud']['total']['content'][$k]["id"] . '_input');
								}
							}
						}
					} else {
						if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
							if (isset($page['crud']['total']['content'][$k]["with_input"])) {
								if ($page['crud']['total']['content'][$k]["with_input"]) {
									$array = ($page['crud']['total']['content'][$k]["array"]);
									for ($i = 0; $i < count($array); $i++) {
										if ($array[$i][2] == 'number') {
											$sqli[$page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]] =
												Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]) ? Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]) : 0;
										} else if ($array[$i][2] == 'select') {
											$sqli[$page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]] =
												Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]) ? Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]) : 0;
										} else {
											$sqli[$page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]] =
												Partial::input($page['crud']['total']['content'][$k]["id"] . "_" . $array[$i][1]);
										}
									}
								}
							}
						}
						$sqli["total_" . $page['crud']['total']['content'][$k]["id"]] = Partial::input("total_" . $page['crud']['total']['content'][$k]["id"]) ? Partial::input("total_" . $page['crud']['total']['content'][$k]["id"]) : 0;
						$sqli["select_type_" . $page['crud']['total']['content'][$k]["id"]] = Partial::input("select_type_" . $page['crud']['total']['content'][$k]["id"]) ? Partial::input("select_type_" . $page['crud']['total']['content'][$k]["id"]) : 0;
						$sqli[$page['crud']['total']['content'][$k]["id"]] = Partial::input($page['crud']['total']['content'][$k]["id"] . '_input') ? Partial::input($page['crud']['total']['content'][$k]["id"] . '_input') : 0;
					}
				} else {
					$sqli[$page['crud']['total']['content'][$k]["id"]] = Partial::input('total_' . $page['crud']['total']['content'][$k]["id"]);
				}
			}
		}
		$database_utama_temp = $database_utama;

		$database_utama = $database_utama_temp;

		// $insert_number_code = CRUDFunc::insert_number_code_nomor($fai, $page, $field, $input_content);
		// if ($insert_number_code['valueinput'])
		// 	$input_content = $insert_number_code['valueinput'];

		$returnddv['$where_raw_temp'] = $where_raw_temp;
		$returnddv['$sqli'] =  $sqli;
		$returnddv['$field_appr'] = $field_appr;
		$returnddv['$where'] = $where;
		$returnddv['$select'] = $select;
		$returnddv['$sqlen'] = $sqlen;
		$returnddv['$sqli_to_database'] = $sqli_to_database;
		$returnddv['$sqli_to_split'] = $sqli_to_split;
		$returnddv['$sqlfile'] = $sqlfile;
		$returnddv['$sql_update_file'] = $sql_update_file;
		$returnddv['$join'] = $join;
		return $returnddv;
	}

	public static function array_declare($fai, $page, $database_utama, $input_content, $array, $i)
	{
		$field = $array[$i][1];
		$typearray = $array[$i][2];
		$field_name = $field;
		$extypearray = explode('-', $typearray);
		$to_field = $field;

		$return_data = "";
		$return_var = "";
		$db_sql_split = "";
		$sqlfile = [];
		if ($typearray == 'file' or $typearray == "photos" or $typearray == "file-upload"  or $typearray == 'video') {

			$sqlfile[0] = $field_name;
			$sqlfile[1] = $array[$i][3];
			$sqlfile[2] = isset($page['save']['section']) ? $page['save']['section'] : 'utama';
			$sqlfile[3] = isset($page['save']['no_sub_kategori']) ? $page['save']['no_sub_kategori'] : 0;
			$sqlfile[4] = $field;
			$sqlfile[5] = $input_content;;
			// $sqlfile[5] = CRUDFunc::input_content($page, $database_utama, $array, $i, $typearray, $field)['$field_name'];;
			// 			} else if ($typearray == 'select') {
			// 			    $select[] = $database_utama . "." . $field . " as ".$database_utama."_".$field;
			// 			    $select[] = $array[$i][3][0] . "." . $array[$i][3][2] . " as ".$array[$i][3][2]."_".$array[$i][3][0];
			// 			 //   $join[] = array($array[$i][3][0],$array[$i][3][0] . ".x" . $array[$i][3][2], $database_utama . "." . $field);
			// 			    	$sqli[$field] = $input_content;
			$return_var = "sqlfile";
		} else if (!$input_content and Partial::input('type') == 'save') {
		} else
			if (in_array('edit', $extypearray) and Partial::input('type') == 'update' and $input_content) {
		} else
			if ($typearray == 'editor-code') {
			$return_data =  htmlspecialchars($input_content);;
		} else if ($typearray == 'select-appr') {
			$field_appr =  $field;
			$select[] = $database_utama . "." . $field_appr . "_status as system_status_appr";

			$field_name = $field . '_id';
			$to_field = $field_name;
			$return_data = Partial::input($field_name);
		} else if (in_array('array-website', $extypearray)) {
			$return_data = $input_content;
			foreach ($array[$i][4]['connect'] as $to_key => $to_value) {
				$to_array[$to_key] = array(null, $to_value[0], $to_value[1]);

				$array_website_return_data = CRUDFunc::input_content($page, $database_utama, $to_array, $to_key, explode('-', $to_value[0]), $to_value[0])['$input_content'];
				if ($page['save']['section'] == 'sub_kategori' and isset($page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field])) {
					if ($return_data)
						$sqli_to_split[$page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field]][$field] = $array_website_return_data;
				} else
					if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {
					if ($return_data)
						$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $array_website_return_data;
				} else {
					if ($return_data)
						$sqli[$to_field] = $array_website_return_data;
				}
			}
		} else if (in_array('number', $extypearray)) {


			$return_data = $fai->hapusRupiah($input_content ? $input_content : 0);


			//  } else if (in_array('file', $extypearray)) {
			//               $file_upload= FileFunc::file_upload($page, $field_name, $array[$i][3], $array[$i][3], $database_utama, null,"input_name",'all');
			// 	$sqli_sub_kategori[$field] =$file_upload['last_one'];
			// 	$sql_update_file[] = $file_upload['last_one'];;
			// // 	if (($input_field)) {
			// // 	    $sql_update_file[] = $sqli_sub_kategori[$field] =FileFunc::file_upload($page, $field_name, $array[$i][3], $array[$i][3], $database_utama, $id,"input_name",'last_one');
			// // 	}



		} else if (!(in_array('nosave', $extypearray) or in_array('relation', $extypearray))) {

			if (isset($page['enkripsi'])) {
				if (in_array($field, $page['enkripsi'])) {
					$return_data = en($input_content);

					$sqlen['database'][] = en($database_utama, true);
					$sqlen['nama_row'][] = en($field, true);
					$sqlen['value'][] = $input_content;
					//$search['id'] = $id;
					//$ci->db->insert('search_keyword',$search);

				} else
					$return_data = $input_content;
			} else {
				$return_data = $input_content;
			}
		} else if ($typearray != 'modalform-subkategori-add') {
			if (!isset($page['save']['type_sub_kategori'])) {
			} else
				if ($page['save']['type_sub_kategori'] == 'normal')
				$input_field = Partial::input($field_name)[$no];
			else if ($page['save']['type_sub_kategori'] == 'tree') {
				$field_name = $field_name . '_tree' . $level;
				if ($level == 1) {
					$input_field = Partial::input($field_name)[$no][$no2];
					$sqli[Database::converting_primary_key($page, $database_utama . '', 'primary_key')] = $id1;
				} else if ($level == 2) {

					$input_field = Partial::input($field_name)[$no][$no2][$no3];
					$sqli[Database::converting_primary_key($page, $database_utama . '', 'primary_key')] = $id2;
				} else if ($level == 3) {
					$input_field = Partial::input($field_name)[$no][$no2][$no3][$no4];
					$sqli[Database::converting_primary_key($page, $database_utama . '', 'primary_key')] = $id3;
				} else if ($level == 4) {
					$input_field = Partial::input($field_name)[$no][$no2][$no3][$no4][$no5];
					$sqli[Database::converting_primary_key($page, $database_utama . '', 'primary_key')] = $id4;
				} else if ($level == 5) {
					$input_field = Partial::input($field_name)[$no][$no2][$no3][$no4][$no5][$no6];
					$sqli[Database::converting_primary_key($page, $database_utama . '', 'primary_key')] = $id5;
				}
				$sqli['tree_level'] = $level;
			}
		}
		if ($page['save']['section'] == 'sub_kategori' and isset($page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field])) {
			if ($return_data) {
				$return_var = "sqli_to_split";
				$db_sql_split = $page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field];
				//$sqli_to_split[$page['crud']['split_database_sub_kategori'][$database_utama]['array'][$field]][$field] = $return_data;
			}
		} else
			if (!empty($page['crud']['split_database']['array'][$field]) and $page['save']['section'] != 'sub_kategori') {

			if ($return_data) {
				$return_var = "sqli_to_split";
				$db_sql_split = $page['crud']['split_database']['array'][$field];
				//$sqli_to_split[$page['crud']['split_database']['array'][$field]][$field] = $return_data;
			}
		} else {
			if ($return_data) {
				$return_var = "sqli";
			}
		}

		$return = [];
		$return['return_data'] =  $return_data;
		$return['return_var'] =  $return_var;
		$return['db_sql_split'] =  $db_sql_split;
		$return['sqlfile'] =  $sqlfile;


		return $return;
	}

	public static function exted($page, $array_extend, $database_utama, $id, $name)
	{

		$idUser = $page['fai']->id_user();
		if (isset($array_extend['update_edit_extend'])) {
			for ($i = 0; $i < count($array_extend['update_edit_extend']); $i++) {
				$sqli_extend_update['respons'] = $page['fai']->input($name . "_update" . $array_extend['extend'][$i]);
				DB::update('form__response__extend', $sqli_extend_update, ["id=" . $array_extend['id_update_extend'][$array_extend['update_edit_extend'][$i]]]);
			}
		}
		if (isset($array_extend['update_add_extend'])) {
			$ada = 1;
			if (!isset($array_extend['id_form_response'])) {
				$ada = 0;
			} else
                    if ($array_extend['id_form_response']) {
				$ada = 0;
			}
			if (!$ada) {
				$sqli_response['id_form'] = $array_extend['id_form'];
				$sqli_response['id_apps_user'] = $idUser;
				$sqli_response['connect_database_id'] = $id;
				$sqli_response['connect_database_utama'] = $database_utama;
				$sqli_response[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
				$sqli_response[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
				$sqli_response['timezone'] = date_default_timezone_get();
				$sqli_response['on_domain'] = $page['load']['domain'];
				if (isset($page['get_panel']['id_panel'])) {
					$sqli_response['on_panel'] = $page['get_panel']['id_panel'];
				}
				if (!in_array($page['load']['board'], array(-1, null))) {
					$sqli_response['on_board'] = $page['load']['board'];
					$sqli_response['on_role'] = isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : null;
				}
				CRUDFunc::crud_insert(false, $page, $sqli_response, [], 'form__response', []);

				$array_extend['id_form_response'] = DB::lastInsertId($page, 'form__response');
			}
			for ($i = 0; $i < count($array_extend['update_add_extend']); $i++) {
				$sqli_extend['respons'] = $page['fai']->input($name . "_" . $array_extend['update_add_extend'][$i]);
				$sqli_extend['id_extend'] = ($array_extend['update_add_extend'][$i]);
				$sqli_extend['id_form_response'] = $array_extend['id_form_response'];
				$sqli_extend['tipe_data'] = "array_utama";;
				$sqli_extend['connect_database'] = $database_utama;
				$sqli_extend['connect_id'] = $id;
				$sqli_extend[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
				$sqli_extend[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
				$sqli_extend['timezone'] = date_default_timezone_get();
				$sqli_extend['on_domain'] = $page['load']['domain'];
				if (isset($page['get_panel']['id_panel'])) {
					$sqli_extend['on_panel'] = $page['get_panel']['id_panel'];
				}
				if (!in_array($page['load']['board'], array(-1, null))) {
					$sqli_extend['on_board'] = $page['load']['board'];
					$sqli_extend['on_role'] = isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : null;
				}
				CRUDFunc::crud_insert(false, $page, $sqli_extend, [], 'form__response__extend', []);
			}
		}
	}

	public static function crud_update($fai, $page, $sqli, $sqlen, $sqlfile, $array, $database_utama, $primary_key, $id, $declare_crud_variable = [])
	{
		try {
			if (isset($declare_crud_variable['$sqli'])) {
				$where_raw_temp         = $declare_crud_variable['$where_raw_temp'];
				$sqli                   = $declare_crud_variable['$sqli'];
				$field_appr             = $declare_crud_variable['$field_appr'];
				$where                  = $declare_crud_variable['$where'];
				$select                 = $declare_crud_variable['$select'];
				$sqlen                  = $declare_crud_variable['$sqlen'];
				$sqlfile                = $declare_crud_variable['$sqlfile'];
				$sqli_to_database       = $declare_crud_variable['$sqli_to_database'];

				$sqli_to_split 			= $declare_crud_variable['$sqli_to_split'];
				$sql_update_file        = $declare_crud_variable['$sql_update_file'];
			} else {
				$sql_update_file = array();
				$sqli_to_database = array();
				$sqlfile = array();
				$sqli_to_split = array();
			}

			$array_crud = $array;
			$idUser = $fai->id_user();
			$sqli[(isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date")] = date('Y-m-d H:i:s');
			$sqli[(isset($page['load']['database']['update_by']) ? $page['load']['database']['update_by'] : "update_by")] = $idUser;

			if (isset($page['crud']['crud_function'])) {
				foreach ($page['crud']['crud_function'] as $key => $value) {
					if ($value == 'hash') {
						if (Partial::input($key))
							$sqli[$key] = Hash::make(Partial::input($key));
					} else if ($value == 'hapusrupiah') {
						if (Partial::input($key))
							$sqli[$key] = $fai->hapusRupiah(Partial::input($key));
					}
				}
			}
			//$update = ["active" => 0, "delete_date" => date('Y-m-d H:i:s'), "delete_by" => $idUser];
			
			if (isset($page['crud']['update_default_value'])) {
				foreach ($page['crud']['update_default_value'] as $field => $value) {

					$value = CRUDFunc::default_value($value, $page);
					$sqli[$field] = trim($value);
				}
			}

			$sqli = array_filter($sqli);

			DB::update($database_utama, $sqli, $where);

			$extend = true;
			if (isset($page['crud']['view'])) {
				if ($page['crud']['view'] == 'update_approval')
					$extend = false;
			}
			if (isset($page['crud']['array_extend']['extend']) and $extend) {
				CRUDFunc::exted($page, $page['crud']['array_extend'], $database_utama, $id, 'extend');
			}

			// if (count($sqlfile)) {
			// 	foreach ($sqlfile as $f => $valueFile) {

			// 		if (isset($_FILES[$sqlfile[$f][0]])) {

			// 			if (count($_FILES[$sqlfile[$f][0]]['name'])) {
			// 				// echo $_FILES[$sqlfile[$f][0]];
			// 				FileFunc::file_upload($page, $sqlfile[$f][0], $sqlfile[$f][1], $sqlfile[$f][1], $database_utama, $id, $sqlfile[$f][4]);
			// 			}
			// 		}
			// 	}
			// }

			if (count($sqlfile)) {

				foreach ($sqlfile as $f => $valueFile) {
					if(isset($sqlfile[$f][6])){
						$return_file =	FileFunc::file_upload($page, $sqlfile[$f][0] . $sqlfile[$f][3], $sqlfile[$f][6], $sqlfile[$f][1], $database_utama, $id, $sqlfile[$f][4], 'input_name', 'last_one');
						DB::update("$database_utama", [$sqlfile[$f][4] =>  $return_file], ["id" . "=" . $id]);	
					}else
					if (isset($_FILES[$sqlfile[$f][0] . $sqlfile[$f][3]])) {
						if (count($_FILES[$sqlfile[$f][0] . $sqlfile[$f][3]]['name'])) {
							$return_file =	FileFunc::file_upload($page, $sqlfile[$f][0] . $sqlfile[$f][3], $sqlfile[$f][1], $sqlfile[$f][1], $database_utama, $id, $sqlfile[$f][4], 'input_name', 'last_one');
							DB::update("$database_utama", [$sqlfile[$f][4] =>  $return_file], ["id" . "=" . $id]);
						}
					}
				}
			}
			if (count($sql_update_file)) {
				for ($a = 0; $a < count($sql_update_file); $a++) {
					DB::update("drive__file", ["ref_external_id" => $id], ["id=" . $sql_update_file[$a]]);
				}
			}

			if (isset($page['crud']['sub_kategori'])) {
				for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
					$sub_kategori = $page['crud']['sub_kategori'][$h];
					$database_utama = $sub_kategori[1];

					$first = (Partial::input("deleteRow" . $h));

					$no_sub_kategori = isset($first[0]) ? count($first) : 0;

					for ($x = 0; $x < ($no_sub_kategori); $x++) {

						$update = ["active" => 0, "delete_date" => date('Y-m-d H:i:s'), "delete_by" => $idUser];
						$where = ["$database_utama.id" . "=" . $first[$x]];
						DB::update($database_utama, $update, $where);
					}


					$array = $page['crud']['array_sub_kategori'][$h];

					//echo $database_utama . '_' . $array[0][1];web__apps__navbar_primary_key_edit
					$first = (Partial::input($database_utama . '_' . $array[0][1] . '_edit'));
					$no_sub_kategori = isset($first[0]) ? count($first) : 0;
					$get_nomor_sub_kategori = $fai->input('no_sub_kategori-' . $database_utama);
					for ($x = 0; $x < ($no_sub_kategori); $x++) {
						$nomor = $get_nomor_sub_kategori[$x];
						$sqli_sub_kategori = array();
						$sqli_sub_kategori[Database::converting_primary_key($page, $page['database']['utama'], 'primary_key')] = $id;
						if (isset($page['crud']['update_default_value_sub_kategori'])) {
							foreach ($page['crud']['update_default_value_sub_kategori'] as $field => $value) {

								$value = CRUDFunc::default_value($value, $page);
								$sqli_sub_kategori[$field] = trim($value);
							}
						}
						for ($i = 0; $i < count($array); $i++) {

							$text = $array[$i][0];
							$field_name = $database_utama . '_' . $array[$i][1] . '_edit';
							// echo $field_name;echo '<br>';echo '<br>';
							$field = $array[$i][1];
							$typearray = $array[$i][2];
							$extypearray = explode("-", $typearray);
							if (in_array('number', $extypearray)) {
								if (isset(Partial::input($field_name)[$x])) {
									$$field_name = 	Partial::input($field_name)[$x];;
									$sqli_sub_kategori[$field] =  $fai->hapusRupiah(Partial::input($field_name)[$x]);
								}
							} else if (in_array('file', $extypearray)) {

								$id_file = -1;
								if (isset($_FILES[$database_utama . '_' . $array[$i][1] . $nomor]))
									echo 	 $id_file = FileFunc::file_upload($page, $database_utama . '_' . $array[$i][1] . $nomor, $array[$i][3], $array[$i][3], $database_utama, $id, $field, "input_name", 'last_one');
								if ($id_file != -1) {
									$sqli_sub_kategori[$field] = $id_file;
								} else {
									unset($sqli_sub_kategori[$field]);
								}
							} else if (!in_array($typearray, array('text-relation', 'select-relation'))) {
								if (isset(Partial::input($field_name)[$x])) {
									$sqli_sub_kategori[$field] = Partial::input($field_name)[$x];
								}
							}
						}
						if (isset($page['crud']['update_default_value_sub_kategori_request'])) {
							foreach ($page['crud']['update_default_value_sub_kategori_request'][$database_utama] as $key => $value) {
								$var = $database_utama . '_' . $value;
								$sqli_sub_kategori[$key] = $sqli_sub_kategori[$var];
							}
						}
						$primary_key = $sub_kategori[2];
						// if (count($sqli_sub_kategori) > 1) {
						$sqli_sub_kategori[(isset($page['load']['database']['update_date']) ? $page['load']['database']['update_date'] : "update_date")] = date('Y-m-d H:i:s');
						$sqli_sub_kategori[(isset($page['load']['database']['update_by']) ? $page['load']['database']['update_by'] : "update_by")] = $idUser;

						if (isset(Partial::input($database_utama . '_primary_key_edit')[$x])) {
							$where = ["$database_utama.id" . "=" . Partial::input($database_utama . '_primary_key_edit')[$x]];
							DB::update($database_utama, $sqli_sub_kategori, $where);
						}
					}


					$first = (Partial::input($database_utama . '_' . $array[0][1]));
					$no_sub_kategori = isset($first[0]) ? count($first) : 0;
					for ($x = 0; $x <= ($no_sub_kategori); $x++) {

						$sqli_sub_kategori = array();
						$sqli_sub_kategori[Database::converting_primary_key($page, $page['database']['utama'], 'primary_key')] = $id;
						if (isset($page['crud']['update_default_value_sub_kategori'])) {
							foreach ($page['crud']['update_default_value_sub_kategori'] as $field => $value) {

								$value = CRUDFunc::default_value($value, $page);
								$sqli_sub_kategori[$field] = trim($value);
							}
						}
						for ($i = 0; $i < count($array); $i++) {

							$text = $array[$i][0];
							$field_name = $database_utama . '_' . $array[$i][1];
							// echo $field_name;echo '<br>';echo '<br>';
							$field = $array[$i][1];
							$typearray = $array[$i][2];
							$extypearray = explode("-", $typearray);
							if (isset(Partial::input($field_name)[$x])) {
								if ((Partial::input($field_name)[$x])) {
									if (in_array('number', $extypearray)) {
										$$field_name = 	Partial::input($field_name)[$x];;
										$sqli_sub_kategori[$field] =  $fai->hapusRupiah(Partial::input($field_name)[$x]);
									} else if (in_array('file', $extypearray)) {

										$sqli_sub_kategori[$field] = FileFunc::file_upload($page, $field_name, $array[$i][3], $array[$i][3], $database_utama, $id, $field, "input_name", 'last_one');
									} else if (!in_array($typearray, array('text-relation', 'select-relation'))) {

										$sqli_sub_kategori[$field] = Partial::input($field_name)[$x];
									}
								}
							}
						}
						if (isset($page['crud']['update_default_value_sub_kategori_request'])) {
							foreach ($page['crud']['update_default_value_sub_kategori_request'][$database_utama] as $key => $value) {
								$var = $database_utama . '_' . $value;
								$sqli_sub_kategori[$key] = $$var;
							}
						}
						$primary_key = $sub_kategori[2];
						if (count($sqli_sub_kategori) > 1) {
							$sqli_sub_kategori[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
							$sqli_sub_kategori[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
							CRUDFunc::crud_insert(false, $page, $sqli_sub_kategori, [], $database_utama, []);

							$page['crud']['sqli_sub_kategori'] = $sqli_sub_kategori;
							$page['crud']['oninsert']['last_value_sub_kategori'] = DB::lastInsertId($page, $database_utama);
							if (isset($page['crud']['oninsert_sub_kategori'])) {
								for ($a = 0; $a < count($page['crud']['oninsert_sub_kategori']); $a++) {
									if ($page['crud']['oninsert_sub_kategori'][$a]['table_sub_kategori'] == $database_utama) {
										$nama_array_execution = $page['crud']['oninsert_sub_kategori'][$a]["first_proses"];

										CRUDFunc::execution($page, $a, $nama_array_execution, $fai);
									}
								}
							}
						}
					}
				}
			}


			//return redirect()->route($page['route'], [$redirect, $id_redirect])->with('success', $page['title'] . ' Berhasil di input!');
		} catch (\Exeception $e) {

			return redirect()->back()->with('error', $e);
		}
	}
	public static function default_value($value, $page = array())
	{
		$fai = new MainFaiFramework();

		$value = Database::string_database($page, $fai, $value);
		return $value;
	}
	public static function crud_hapus($fai, $page, $database_utama, $primary_key, $id)
	{
		try {
			// $idUser=$this->id_user();
			$idUser = $fai->id_user();

			DB::queryRaw($page, "select * from $database_utama where $primary_key = $id");
			$get = DB::get('all');
			$sqli['database_utama'] = $database_utama;
			$sqli['database_id'] = $id;
			$sqli['tipe_privilage'] = "pengecualian";
			$sqli['tanggal_perubahan'] = date('Y-m-d');
			$sqli['domain_privilage'] = $get['row'][0]->on_domain;
			$sqli['web_apps_privilage'] = $get['row'][0]->on_web_apps;
			$sqli['workspace_privilage'] = $get['row'][0]->on_board;
			$sqli['panel_privilage'] = $get['row'][0]->on_panel;
			$sqli['role_privilage'] = $get['row'][0]->on_role;
			$sqli['jenis_privilage'] = $get['row'][0]->privilege;

			CRUDFunc::crud_insert($fai, $page, $sqli, [], "apps_privilege", []);
		} catch (\Exeception $e) {
			// DB::rollback();
			return redirect()->back()->with('error', $e);
		}
	}
	public static function crud_insert($fai, $page, $sqli, $array, $database_utama, $update_where = [], $tipe = 'insert')
	{


		$idUser                 = Partial::id_user();
		// echo $database_utama;
		foreach ($sqli as $field => $string) {
			// echo '<br>' . $field;
			$sqli[$field] = Database::string_database($page, $fai, $string);
		}
		if ($database_utama != 'form') {

			$sqli[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
			$sqli[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
			$sqli['timezone'] 		= date_default_timezone_get();
			$domain = $sqli['on_domain'] 		= $_SERVER['SERVER_NAME'];
			if (!isset($page['load']['id_web__apps'])) {
				DB::table('web__apps');
				DB::selectRaw("web__apps.id as primary_key");
				DB::whereRaw("domain_utama='$domain'");
				// DB::joinRaw("website__bundles__list on web__list_apps_menu.id_bundle = website__bundles__list.id",'left');
				$utama = DB::get('all');
				if (isset($utama['row'][0]))
					$page['load']['id_web__apps'] = $utama['row'][0]->primary_key;
			}
			$sqli['on_web_apps'] 	= isset($page['load']['id_web__apps']) ? $page['load']['id_web__apps'] : null;
			if (isset($page['get_panel']['id_panel'])) {
				$sqli['on_panel'] = $page['get_panel']['id_panel'];
			}
			if (isset($page['load']['board'])) {
				if (!in_array($page['load']['board'], array(-1, null))) {
					$sqli['on_board'] = $page['load']['board'];
					$sqli['on_role'] = isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : null;
				}
			}
		}

		$columns[$database_utama] = DB::getColumnListing($page, $page['database_provider'], $database_utama, 'type');
		foreach ($sqli as $to_key => $to_value) {
			if (!isset($columns[$database_utama][$to_key])) {

				Database::create_database_check($page, $array, $database_utama, Database::converting_primary_key($page, $database_utama, 'primary_key'), $page['database_provider']);
				$columns[$database_utama] = DB::getColumnListing($page, $page['database_provider'], $database_utama, 'type');
			}
			//  echo $columns[$database_utama][$to_key];
			if (isset($columns[$database_utama][$to_key])) {
				if (in_array($columns[$database_utama][$to_key], array("interger", "numeric", 'float'))) {
					$sqli[$to_key] = str_replace(
						str_split('abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM'),
						"",
						$to_value
					);
					if (!$sqli[$to_key]) {
						$sqli[$to_key] = 0;
					}
				}
			}
		}

		DB::insert($database_utama, $sqli);
		//  json_encode(["utama" => $database_utama, "sqli" => $sqli, "last_insert" => DB::lastInsertId($page, $database_utama)]);

		return  DB::lastInsertId($page, $database_utama);
	}
	public static function crud_save($fai, $page, $sqli, $sqlen, $array, $database_utama, $declare_crud_variable = array())
	{
		if (!isset($page['save']['section'])) {
			$page['save']['section'] = '';
		}
		try {
			if (isset($declare_crud_variable['$sqli'])) {
				$where_raw_temp         = $declare_crud_variable['$where_raw_temp'];
				$sqli                   = $declare_crud_variable['$sqli'];
				$field_appr             = $declare_crud_variable['$field_appr'];
				$where                  = $declare_crud_variable['$where'];
				$select                 = $declare_crud_variable['$select'];
				$sqlen                  = $declare_crud_variable['$sqlen'];
				$sqlfile                = $declare_crud_variable['$sqlfile'];
				$sqli_to_database       = $declare_crud_variable['$sqli_to_database'];

				$sqli_to_split 			= $declare_crud_variable['$sqli_to_split'];
				$sql_update_file        = $declare_crud_variable['$sql_update_file'];
			} else {
				$sql_update_file = array();
				$sqli_to_database = array();
				$sqlfile = array();
				$sqli_to_split = array();
			}
			if (isset($page['panel'])) {
				$get_panel = Database::get_database_panel($page, $page['panel']);;
				$sqli[Database::converting_primary_key($page, $page['panel'], 'primary_key')] = $get_panel;
			}
			$idUser                 = Partial::id_user();

			$array_save = [];


			$last_insert_id = CRUDFunc::crud_insert($fai, $page, $sqli, $array, $database_utama, $page['crud'], 'insert');
			$page['crud']['last_insert'][$database_utama] = $last_insert_id;
			$database_utama_temp = $database_utama;
			$array_save['db_utama'] = $database_utama;
			$array_save['db_utama_id'] = $last_insert_id;
			$array_save['array_utama'] = $sqli;
			if (isset($page['crud']['array_extend']['extend'])) {
				$sqli_response['id_form'] = $page['crud']['array_extend']['id_form'];
				$sqli_response['id_apps_user'] = $idUser;
				$sqli_response['connect_database_id'] = $last_insert_id;
				$sqli_response['connect_database_utama'] = $database_utama;
				$sqli_response[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
				$sqli_response[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
				$sqli_response['timezone'] = date_default_timezone_get();
				$sqli_response['on_domain'] = $page['load']['domain'];
				if (isset($page['get_panel']['id_panel'])) {
					$sqli_response['on_panel'] = $page['get_panel']['id_panel'];
				}
				if (!in_array($page['load']['board'], array(-1, null))) {
					$sqli_response['on_board'] = $page['load']['board'];
					$sqli_response['on_role'] = isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : null;
				}
				CRUDFunc::crud_insert(false, $page, $sqli_response, [], 'form__response', []);
				$last_insert_id_form__response = DB::lastInsertId($page, 'form__response');

				for ($i = 0; $i < count($page['crud']['array_extend']['extend']); $i++) {
					$sqli_extend['respons'] = $page['fai']->input("extend_" . $page['crud']['array_extend']['extend'][$i]);
					$sqli_extend['id_extend'] = ($page['crud']['array_extend']['extend'][$i]);
					$sqli_extend['id_form_response'] = $last_insert_id_form__response;
					$sqli_extend['tipe_data'] = "array_utama";;
					$sqli_extend['connect_database'] = $database_utama;
					$sqli_extend['connect_id'] = $last_insert_id;
					$sqli_extend[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
					$sqli_extend[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
					$sqli_extend['timezone'] = date_default_timezone_get();
					$sqli_extend['on_domain'] = $page['load']['domain'];
					if (isset($page['get_panel']['id_panel'])) {
						$sqli_extend['on_panel'] = $page['get_panel']['id_panel'];
					}
					if (!in_array($page['load']['board'], array(-1, null))) {
						$sqli_extend['on_board'] = $page['load']['board'];
						$sqli_extend['on_role'] = isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : null;
					}

					CRUDFunc::crud_insert(false, $page, $sqli_extend, [], 'form__response__extend', []);
				}
			}


			if (isset($page['crud']['oninsert_sub_kategori'])) {
				for ($a = 0; $a < count($page['crud']['oninsert_sub_kategori']); $a++) {
					if ($page['crud']['oninsert_sub_kategori'][$a]['table_sub_kategori'] == $database_utama) {
						$nama_array_execution = $page['crud']['oninsert_sub_kategori'][$a]["first_proses"];

						CRUDFunc::execution($page, $a, $nama_array_execution, $fai);
					}
				}
			}

			if (isset($page['crud']['insert_after'])) {
				$class_after = $page['crud']['insert_after'][0];
				$function_after = $page['crud']['insert_after'][1];
				require_once(__DIR__ . "/../../App/$class_after.php");
				$new = new $class_after();
				$new->$function_after($page, "save", $last_insert_id);
			}

			if (count($sqlfile)) {
				foreach ($sqlfile as $f => $valueFile) {

					if (isset($_FILES[$sqlfile[$f][5] . $sqlfile[$f][3]])) {
						if (count($_FILES[$sqlfile[$f][5] . $sqlfile[$f][3]]['name'])) {

							$return_file =	FileFunc::file_upload($page, $sqlfile[$f][5] . $sqlfile[$f][3], $sqlfile[$f][1], $sqlfile[$f][1], $database_utama, $last_insert_id, $sqlfile[$f][4], 'input_name', 'last_one');
							DB::update("$database_utama", [$sqlfile[$f][4] =>  $return_file], ["id" . "=" . $last_insert_id]);
						}
					}
				}
			}
			if (count($sql_update_file)) {
				for ($a = 0; $a < count($sql_update_file); $a++) {
					DB::update("drive__file", ["ref_external_id" => $last_insert_id], ["id=" . $sql_update_file[$a]]);
				}
			}
			if ($page['save']['section'] != 'sub_kategori') {

				if (count($sqli_to_split)) {
					foreach ($sqli_to_split as $key_to_db => $value_to_db) {
						$database_utama = $key_to_db;
						//$array = $sqli_to_database[$key_to_db]['array'];
						$sqli_split = $sqli_to_split[$key_to_db];
						$sqli_split[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
						$sqli_split[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
						$sqli_split['timezone'] = date_default_timezone_get();
						$sqli_split[$page['crud']['split_database']['setting'][$key_to_db]['database_to_row_split']] = $last_insert_id;

						$id_last_split = CRUDFunc::crud_insert($fai, $page, $sqli_split, array(), $database_utama, $page['crud']['split_database']['crud'][$key_to_db], 'insert');
						$page['crud']['last_insert'][$database_utama] = $id_last_split;
					}
				}
			}
			if (count($sqli_to_database)) {
				foreach ($sqli_to_database as $key_to_db => $value_to_db) {
					$database_utama = $key_to_db;
					//$array = $sqli_to_database[$key_to_db]['array'];
					$sqli_insert = $sqli_to_database[$key_to_db]['sqli'];
					$sqli_insert[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
					$sqli_insert[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
					$sqli_insert['timezone'] = date_default_timezone_get();

					CRUDFunc::crud_insert(false, $page, $sqli_insert, [], $database_utama, []);
				}
			}


			if (isset($sqlen['database'][0])) {

				for ($ien = 0; $ien < count($sqlen['database']); $ien++) {

					$sqlen['id'][$ien] = $last_insert_id;
					$sqle['database'] = $sqlen['database'][$ien];
					$sqle['nama_row'] = $sqlen['nama_row'][$ien];
					$sqle['value'] = $sqlen['value'][$ien];
					$sqle['id'] = $sqlen['id'][$ien];

					CRUDFunc::crud_insert(false, $page, $sqle, [], 'search_keyword', []);
				}
			}
			//$ci->db->insert('search_keyword',$search);

			$last_value = $last_insert_id;

			if (isset($page['crud']['oninsert'])) {
				for ($a = 0; $a < count($page['crud']['oninsert']); $a++) {
					if ($page['crud']['oninsert'][$a]['tipe'] == 'insert') {

						for ($b = 0; $b < count($page['crud']['oninsert'][$a]['insert']['field']); $b++) {
							$value = "";
							if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'session') {
								$value = $_SESSION[$page['crud']['oninsert'][$a]['insert']['field'][$b][1]];
							} else if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'last_value') {
								$value = $last_value;
							} else if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'text') {
								$value = $page['crud']['oninsert'][$a]['insert']['field'][$b][1];
							}
							$oninsert[$page['crud']['oninsert'][$a]['insert']['field'][$b][0]] = $value;
						}
						$oninsert[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
						$oninsert[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
						$oninsert['timezone'] = date_default_timezone_get();
						CRUDFunc::crud_insert(false, $page, $oninsert, [], $page['crud']['oninsert'][$a]['insert']['table_insert'], []);
					} else if ($page['crud']['oninsert'][$a]['tipe'] == 'session') {
						for ($b = 0; $b < count($page['crud']['oninsert'][$a]['insert']['field']); $b++) {
							$value = "";
							if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'session') {
								$value = $_SESSION[$page['crud']['oninsert'][$a]['insert']['field'][$b][1]];
							} else if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'last_value') {
								$value = $last_value;
							} else if ($page['crud']['oninsert'][$a]['insert']['field'][$b][2] == 'text') {
								$value = $page['crud']['oninsert'][$a]['insert']['field'][$b][1];
							}
							$_SESSION[$page['crud']['oninsert'][$a]['insert']['field'][$b][0]] = $value;
						}
					}
				}
			}
			if (Partial::input("sub_kategori") == 'not' or $page['save']['section'] == 'sub_kategori') {
				$tampil = false;
			} else {
				$tampil = true;
			}
			if (isset($page['crud']['sub_kategori']) and $tampil) {
				for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
					$sub_kategori = $page['crud']['sub_kategori'][$h];
					$page['save']['section'] = 'sub_kategori';
					$database_utama = $sub_kategori[1];
					if (!isset($page['crud']['database_sub_kategori'][$database_utama]['utama']))
						$page['crud']['database_sub_kategori'][$database_utama]['utama'] = $database_utama;
					//$columns = DB::getColumnListing($page,$page['database_provider'],$database_utama);

					$array = $page['crud']['array_sub_kategori'][$h];
					$array = Database::converting_array_field($page, $array);

					$typearray = $array[0][2];
					$typearray2 = $array[1][2];
					if (!($typearray == 'file' or $typearray == "photos" or $typearray == "file-upload"  or $typearray == 'video')) {
						if (isset($array[0][5])) {
							$get = $database_utama . '_' . $array[0][5];
						} else
							$get = $database_utama . '_' . $array[0][1];

						$no_sub_kategori_input = Partial::input($get);
					} else 
                    if (!($typearray2 == 'file' or $typearray2 == "photos" or $typearray2 == "file-upload"  or $typearray2 == 'video')) {
						if (isset($array[1][5])) {
							$get = $database_utama . '_' . $array[1][5];
						} else
							$get = $database_utama . '_' . $array[1][1];

						$no_sub_kategori_input = Partial::input($get);
					}

					if (isset($no_sub_kategori_input[0])) {
						foreach ($no_sub_kategori_input as $no => $value) {
							if ($value) {

								$return = CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $no);
								$id1 = $return['last_value'];
								$sqli = $return['sqli'];
								$array_save['sub_kategori'][$database_utama][$id1] = $sqli;
								$page['crud']['last_insert'][$database_utama] = $id1;
								for ($i = 0; $i < count($array); $i++) {
									if ($array[$i][2] == 'modalform-subkategori-add') {
										$array_mf = $array[$i][3]['array'];
										$database_utama_mf = $array[$i][3]['database'];;
										$no_sub_kategori = Partial::input("no_sub_kategori-$database_utama")[$no];
										$page['save']['no_sub_kategori'] = $no_sub_kategori;
										$page['save']['no_list_sub_kategori'] = $no;
										$input_field = Partial::input($database_utama . '_' . $array_mf[0][1] . '_modalform')[$no_sub_kategori];
										for ($mfi = 0; $mfi < count($input_field); $mfi++) {
											$sqli_modalform = array();
											for ($mf = 0; $mf < count($array_mf); $mf++) {
												$field_name = $database_utama . '_' . $array_mf[0][1] . '_modalform';
												$field = $array_mf[$mf][1];
												$typearray = $array_mf[$mf][2];
												$extypearray = explode('-', $typearray);

												$input_field = Partial::input($field_name)[$no_sub_kategori];

												if (in_array('number', $extypearray)) {

													if (($input_field[$mfi])) {
														$$field_name = 	$input_field[$mfi];;
														$sqli_modalform[$field] =  $fai->hapusRupiah($input_field[$mfi]);
													}
												} else if (!in_array($typearray, array('text-relation', 'select-relation'))) {

													if (!empty($input_field[$mfi])) {

														$$field_name = 	$input_field[$mfi];;
														$sqli_modalform[$field] = $input_field[$mfi];
													}
												}
											}

											if (count($sqli_modalform)) {
												$sqli_modalform[Database::converting_primary_key($page, $database_utama_temp, 'primary_key')] = $last_value;
												$sqli_modalform[Database::converting_primary_key($page, $database_utama, 'primary_key')] = $id1;
												$sqli_modalform[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
												$sqli_modalform[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;

												Database::check_input_column_exist($page, $sqli_modalform, $database_utama_mf);
												CRUDFunc::crud_insert(false, $page, $sqli_modalform, [], $database_utama_mf, []);
												$last_insert_id_mf = DB::lastInsertId($page, $database_utama_mf);
												if (isset($array[$i][3]['sub_kategori']) and $array[$i][3]['type'] != 'many') {
													for ($hmf = 0; $hmf < count($array[$i][3]['sub_kategori']); $hmf++) {
														$database_utama_mf_sub = $array[$i][3]['sub_kategori'][$hmf][1];;
														$array_mf_sub = $array[$i][3]['array_sub_kategori'][$hmf];;

														$input_field = Partial::input($database_utama_mf_sub . '_' . $array_mf_sub[0][1] . '_modalform')[$no_sub_kategori];
														for ($mfi = 0; $mfi < count($input_field); $mfi++) {
															$sqli_modalform_sub_kategori = array();
															for ($mf = 0; $mf < count($array_mf_sub); $mf++) {
																$field_name = $database_utama_mf_sub . '_' . $array_mf_sub[0][1] . '_modalform';
																$field = $array_mf_sub[$mf][1];
																$typearray = $array_mf_sub[$mf][2];
																$extypearray = explode('-', $typearray);

																$input_field = Partial::input($field_name)[$no_sub_kategori];

																if (in_array('number', $extypearray)) {

																	if (($input_field[$mfi])) {
																		$$field_name = 	$input_field[$mfi];;
																		$sqli_modalform_sub_kategori[$field] =  $fai->hapusRupiah($input_field[$mfi]);
																	}
																} else if (!in_array($typearray, array('text-relation', 'select-relation'))) {

																	if (!empty($input_field[$mfi])) {

																		$$field_name = 	$input_field[$mfi];;
																		$sqli_modalform_sub_kategori[$field] = $input_field[$mfi];
																	}
																}
															}
															$sqli_modalform_sub_kategori[Database::converting_primary_key($page, $database_utama_mf . '', 'primary_key')] = $last_insert_id_mf;
															$sqli_modalform_sub_kategori[Database::converting_primary_key($page, $database_utama_temp, 'primary_key')] = $last_value;
															$sqli_modalform_sub_kategori[Database::converting_primary_key($page, $database_utama, 'primary_key')] = $id1;
															$sqli_modalform_sub_kategori[(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
															$sqli_modalform_sub_kategori[(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
															Database::check_input_column_exist($page, $sqli_modalform, $database_utama_mf_sub);

															CRUDFunc::crud_insert(false, $page, $sqli_modalform_sub_kategori, [], $database_utama_mf_sub, []);
														}
													}
												}
											}
										}
									}
								}

								$x = $no + 1;
								if (isset(Partial::input($database_utama . '_' . $array[0][1] . "_tree1")[$x])) {
									foreach (Partial::input($database_utama . '_' . $array[0][1] . "_tree1")[$x] as $no2 => $value2) {

										$id2 = CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $x, 'tree', 1, $id1, $no2);
										if (isset(Partial::input($database_utama . '_' . $array[0][1] . "_tree2")[$x][$no2])) {
											foreach (Partial::input($database_utama . '_' . $array[0][1] . "_tree2")[$x][$no2] as $no3 => $value3) {
												$id3 = CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $x, 'tree', 2, $id1, $no2, $id2, $no3);
												if (isset(Partial::input($database_utama . '_' . $array[0][1] . "_tree3")[$x][$no2][$no3])) {
													foreach (Partial::input($database_utama . '_' . $array[0][1] . "_tree3")[$x][$no2][$no3] as $no4 => $value4) {
														$id4 = CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $x, 'tree', 3, $id1, $no2, $id2, $no3, $id3, $no4);
														if (isset(Partial::input($database_utama . '_' . $array[0][1] . "_tree4")[$x][$no2][$no3][$no4])) {
															foreach (Partial::input($database_utama . '_' . $array[0][1] . "_tree4")[$x][$no2][$no3][$no4] as $no5 => $value5) {

																$id5 = CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $x, 'tree', 4, $id1, $no2, $id2, $no3, $id3, $no4, $id4, $no5);
																if (isset(Partial::input($database_utama . '_' . $array[0][1] . "_tree5")[$x][$no2][$no3][$no4][$no5])) {

																	foreach (Partial::input($database_utama . '_' . $array[0][1] . "_tree5")[$x][$no2][$no3][$no4][$no5] as $no6 => $value6) {
																		CRUDFunc::sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $x, 'tree', 5, $id1, $no2, $id2, $no3, $id3, $no4, $id4, $no5, $id5, $no6);
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
			}

			

			// DB::commit();
			// return redirect()->route($page['route'], [$redirect, $id_redirect])->with('success', $page['title'] . ' Berhasil di input!');
		} catch (Exeception $e) {
			// DB::rollback();
			// return redirect()->back()->with('error', $e);
		}

		$return['sqli'] = $sqli;
		$return['sqlen'] = $sqlen;
		$return['last_insert_id'] = $last_insert_id;
		$return['array_save'] = $array_save;
		return $return;
	}

	public static function sub_kategori($page, $database_utama, $database_utama_temp, $array, $last_value, $fai, $no, $type_save_sub_kategori = 'normal', $level = 0, $id1 = 0, $no2 = 0, $id2 = 0, $no3 = 0, $id3 = 0, $no4 = 0, $id4 = 0, $no5 = 0, $id5 = 0, $no6 = 0)
	{
		$page['save']['section'] = "sub_kategori";
		$page['save']['type_sub_kategori'] = $type_save_sub_kategori;
		$no_sub_kategori = Partial::input("no_sub_kategori-$database_utama")[$no];

		$page['save']['no_sub_kategori'] = $no_sub_kategori;
		$page['save']['no_list_sub_kategori'] = $no;

		$sqli_get_sub_kategori = CrudFunc::declare_crud_variable($fai, $page, $array, $page['crud']['database_sub_kategori'][$database_utama], $page['load']['type'], $search = array());
		$sqli_get_sub_kategori['$sqli'][Database::converting_primary_key($page, $database_utama_temp . '', 'primary_key')] = $last_value;
		$sqli_get_sub_kategori['$sqli'][Database::converting_primary_key($page, $database_utama_temp, 'primary_key')] = $last_value;
		if (isset($page['crud']['insert_default_value_sub_kategori'])) {
			foreach ($page['crud']['insert_default_value_sub_kategori'][$database_utama] as $key => $value) {
				$sqli_get_sub_kategori['$sqli'][$key] = $value;
			}
		}


		CRUDFunc::crud_save($fai, $page, $sqli_get_sub_kategori['$sqli'], $sqli_get_sub_kategori['$sqlen'], $array, $database_utama, $sqli_get_sub_kategori);
		$page['crud']['last_insert'][$database_utama] = DB::lastInsertId($page, $database_utama);
		$sqli_to_split = $sqli_get_sub_kategori['$sqli_to_split'];

		if (count($sqli_to_split)) {
			foreach ($sqli_to_split as $key_to_db => $value_to_db) {
				$database_utama_split = $key_to_db;
				$sqli_split = $sqli_to_split[$key_to_db];
				$sqli_split[$page['crud']['split_database_sub_kategori'][$database_utama]['setting'][$key_to_db]['database_to_row_split']] = DB::lastInsertId($page, $database_utama);

				CRUDFunc::crud_insert($fai, $page, $sqli_split, array(), $database_utama_split, $page['crud']['split_database_sub_kategori'][$database_utama]['crud'][$key_to_db], 'insert');
			}
		}

		return ["last_value" => DB::lastInsertId($page, $database_utama), "sqli" => $sqli_get_sub_kategori['$sqli']];
	}
	public static function execution($page, $a, $nama_array_execution, $fai)
	{
		//echo $nama_array_execution;
		if ($nama_array_execution) {
			$tipe = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['tipe'];

			if ($tipe == 'check') {
				CRUDFunc::check($page, $a, $nama_array_execution, $fai);
			} else if ($tipe == 'insert') {
				CRUDFunc::insert_execution($page, $a, $nama_array_execution, $fai);
			} else if ($tipe == 'update') {
				CRUDFunc::update_execution($page, $a, $nama_array_execution, $fai);
			} else if ($tipe == 'row') {
				CRUDFunc::row_execution($page, $a, $nama_array_execution, $fai);
			} else if ($tipe == 'session') {
				CRUDFunc::row_execution($page, $a, $nama_array_execution, $fai);
			}
		}
	}
	public static function check($page, $a, $nama_array_execution, $fai)
	{
		for ($b = 0; $b < count($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["where"]); $b++) {
			$where = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["where"][$b];

			$where_content = "";
			if (!isset($where[4])) {
				$where_content = '".$sqli_sub_kategori[' . "'" . $where[2] . "'" . ']."';
			} else if ($where[4] == 'row') {
				$where_content = '".$' . $where[5] . '->' . "" . $where[2] . "" . '."';
			}

			if ($where[3] == 'number')
				$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['database']["where"][] = array($where[0], $where[1], $where_content);
			if ($where[3] == 'string')
				$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['database']["where"][] = array($where[0], $where[1], "'" . $where_content . "'");
		}
		$row = $fai->database_coverter($page, $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['database'], array(), 'source');
		$query = $row;
		echo '$sql="' . $query . '";
		$check=DB::connection()->select($sql);';

		if (isset($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["if"])) {
			for ($c = 0; $c < count($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["if"]); $c++) {
				$if = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["if"][$c];

				if ($if[0] == 'count_database') {
					echo 'if(count($check) ' . $if[1] . ' ' . $if[2] . '){
					$is_check = true;}';
				}
			}
			echo 'else{
					$is_check = false;
					}';
		}
		echo 'if($is_check){';
		$nama_array_exec = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["if_execution"][1];
		CRUDFunc::execution($page, $a, $nama_array_exec, $fai);
		echo '}else{';
		$nama_array_exec = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["if_execution"][0];
		CRUDFunc::execution($page, $a, $nama_array_exec, $fai);
		echo '}';
	}
	public static function session_execution($page, $a, $nama_array_execution, $fai)
	{
		echo 'HAII';
	}
	public static function insert_execution($page, $a, $nama_array_execution, $fai)
	{
		if (isset($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"])) {
			if ($page['section'] == 'viewsource') {
				$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]['where'][] = array($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]["get_where"][0], "=", "'" . '".$sqli_sub_kategori[' . "'" . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]["get_where"][1] . "'" . ']."' . "'");
				$row = $fai->database_coverter($page, $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"], array(), 'source');
				$query = $row;
				echo '$sql="' . $query . '";
			$row_insert=DB::connection()->select($sql);';
			} else {
				$row_insert = $fai->database_coverter($page, $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"], array(), 'source');
			}
		}
		$oninsert = [];
		if ($page['section'] == 'viewsource')
			echo '$oninsert = [];';

		for ($c = 0; $c < count($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field']); $c++) {
			if ($page['section'] == 'viewsource') {

				echo '$oninsert["' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][0] . '"] =';
				if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'input') {
					echo '$sqli_sub_kategori["' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1] . '"]';
				} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'database') {
					echo '$row_insert[0]->' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1] . ';';
				}
			} else {
				$value = "";
				if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'input') {
					$value = $page['crud']['sqli_sub_kategori'][$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1]];
				} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'last_id_sub_kategori') {
					$value = $page['crud']['oninsert']['last_value_sub_kategori'];
				} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'string_database') {
					$value = Database::string_database($page, $fai, $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1]);
				} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'text') {
					$value = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1];
				} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][2] == 'database') {
					$row_filed = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][1];
					$value = $row_insert[0]->$row_filed;
				}
				$oninsert[$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$c][0]] = $value;
			}
		}
		CRUDFunc::crud_insert(false, $page, $oninsert, [], $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["table_insert"], []);

		if ($page['section'] == 'viewsource') {
			echo '
				DB::connection()->table("' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["table_insert"] . '")
				->insert($oninsert);
				$last_value_oninsert = DB::connection()->select("select * from seq_' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["table_insert"] . '");
				';
		}
		if (isset($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["next_execution"])) {
			$nama_array_exec = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["next_execution"];
			CRUDFunc::execution($page, $a, $nama_array_exec, $fai);
		}
	}
	public static function update_execution($page, $a, $nama_array_execution, $fai)
	{

		echo '$onupdate = [];';
		for ($d = 0; $d < count($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field']); $d++) {

			echo '$onupdate["' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$d][0] . '"] = ';
			if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$d][2] == 'last_value_oninsert') {
				echo '$last_value_oninsert[0]->last_value;';
			} else if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$d][2] == 'database') {
				echo '$' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$d][3] . '->' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]['field'][$d][1] . ';';
			}
		}
		echo '		DB::connection()->table("' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["table_update"] . '")
			->where("' . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["get_where"][0] . '",';
		if ($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["get_where"][2] == 'last_value_sub_kategori') {
			echo '$last_value_sub_kategori[0]->last_value';
		}
		echo ')->update($onupdate);';
	}
	public static function row_execution($page, $a, $nama_array_execution, $fai)
	{
		$page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]['where'][] = array($page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]["get_where"][0], "=", "'" . '".$sqli_sub_kategori[' . "'" . $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"]["get_where"][1] . "'" . ']."' . "'");
		$row = $fai->database_coverter($page, $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["row"], array(), 'source');
		$query = $row;
		echo '$sql="' . $query . '";
		$row_' . $nama_array_execution . '=DB::connection()->select($sql);';

		$nama_array_exec = $page['crud']['oninsert_sub_kategori'][$a][$nama_array_execution]["next_execution"];
		CRUDFunc::execution($page, $a, $nama_array_exec, $fai);
	}
}
