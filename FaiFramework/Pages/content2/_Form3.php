<?php
function parse_form($fai, $page, $array, $type, $i, $no, $data,$return_typearray)
{
	//DB::connection($page);
	$return_content = "";
	$text = $array[$i][0];
	$field = $array[$i][1];
	$input_inline = isset($page['crud']['input_inline']) ? $page['crud']['input_inline'] : '';
	$costum_class = isset($page['crud']['costum_class'][$field]) ? $page['crud']['costum_class'][$field] . ' ' . $field : ' ' . $field;
    if($return_typearray['required']){
        $input_inline .=" required ";
       
    }
    
	$prefix_name = isset($page['crud']['prefix_name']) ? $page['crud']['prefix_name'] : '';
	$sufix_name = isset($page['crud']['sufix_name']) ? $page['crud']['sufix_name'] : '';

	$crud_after_form = '';
	$numbering = isset($page['crud']['numbering']) ? $page['crud']['numbering'] : 0;;
	if (isset($page['crud']['view_sub_kategori'])) {
		if ($page['crud']['view_sub_kategori'] == 'table') {
			$startdiv = '';
			$enddiv = '';
		}
	}
	if ($type == 'file') {
		$sufix_name = "[]";
	}
	$page['crud']['type_form_asal'] = isset($page['crud']['type_form_asal']) ? $page['crud']['type_form_asal'] : (isset($type) ? $type : $array[$i][2]);

	if (isset($page['load']['crud']['type_form_default']['costum_class']['type'])) {
		if ($page['load']['crud']['type_form_default']['costum_class']['type'] == $type)
			$costum_class .= ' ' . $page['load']['crud']['type_form_default']['costum_class']['text'];
	}
	if (isset($page['crud']['page_row'])) {
		if ($page['crud']['page_row'] == 'sub_kategori') {
			$numbering = $no;
		}
	}
	$extypearray = explode('-', $array[$i][2]);
	if ((in_array('right', $extypearray)))
		$costum_class .= ' text-right';
	if (isset($page['load']['form']['type'])) {

		$formType = $page['load']['form']['type'];
	} else  if (isset($page['crud']['form_type'])) {

		$formType = $page['crud']['form_type'];
	} else{
		$formType = 1;
	}

	if ($formType == 1) {

		$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group row" ><label class="control-label col-3 " style="font-weight:600">' . $text . '</label><div class="col-9">';
		$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
	} elseif ($formType == 2) {

		$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group " ><label class="control-label  " style="font-weight:600">' . $text . '</label><div class="">';
		$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
	}
	$startdiv = str_replace('<TEXT-LABEL></TEXT-LABEL>', $text, $startdiv);
	if ($type == 'hidden_input') {
		$type = 'hidden';
	}
	if (in_array($page['crud']['view'], array('search'))) {
		if ($fai->input($field, '_GET')) {

			$valueinput = $fai->input($field, '_GET');
		} else {
			$valueinput = "";
		}
	} else if (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource') {
		if (isset($page['crud']['page_row'])) {
			if ($page['crud']['page_row'] == 'sub_kategori') {
				//print_r($data);
				$row = $data;
			}
		} else {
			$row = $page['crud']['row']['row'];
		}
		$typearray = explode('-',$type);
		//print_r($typearray);echo '<br>';
			//print_r($row);
		if ($type == "password") {
			$valueinput = '';
		} else if (in_array("extend_db",$typearray)  ) {
		    $type = str_replace("-extend_db","",$type);
		    if(isset($page['crud']['array_extend']['value_input'][$field]))
		    $valueinput = $page['crud']['array_extend']['value_input'][$field];
		} else if ($type == "text-alias") {
			$field_database = $array[$i][3];
			if ($page['crud']['section_vte'] == 'sub_kategori')
				$valueinput = $row->$field_database;
			else
				$valueinput = $row[0]->$field_database;
		} else if (($type  == "select") or ($page['crud']['type_form_asal']  == "select" or $page['crud']['type_form_asal']  == "select-relation" or $page['crud']['type_form_asal']  == "select-multiple-string") and (!$page['type'] == 'field_view_sub_kategori')) {
			// 
			$field_database = $field . '_2';
			if ($page['crud']['section_vte'] == 'sub_kategori') {

				$valueinput = $row->$field_database;
			} else
				$valueinput = $row[0]->$field_database;
		} else if ($type == "select-appr") {
		} else {
			if ($page['crud']['section_vte'] == 'sub_kategori')
				$valueinput = $row->$field;
			else
				$valueinput = $row[0]->$field;
		}
	} else {
		$valueinput = "";
	}
   // echo $field;
    //print_r($page['crud']['insert_value']);
	if (isset($page['crud']['insert_value'][$field]) and (in_array($page['crud']['view'], array('tambah'))  or in_array($fai->input('_view'), array('tambah')))) {
		$string = $page['crud']['insert_value'][$field];
		if ($string == 'date:now') {
			if ($page['section'] == 'viewsource')
				$string = '<?=date("Y-m-d")?>';
			else
				$string = date("Y-m-d");
		}


	     	$valueinput = $string;
	}

	if (isset($page['crud']['insert_disable'][$field]) and (in_array($page['crud']['view'], array('tambah'))   or in_array($fai->input('_view'), array('tambah')))) {
		$string = isset($page['crud']['insert_disable'][$field]['prefix']) ? CRUDFunc::default_value($page['crud']['insert_disable'][$field]['prefix'], $page) : '';

		if ($page['section'] == 'viewsource') {
			$return_content .=  '<?php ';
			$return_content .=  '$string = "' . $string . '";';
		}
		for ($is = 0; $is < count($page['crud']['insert_disable'][$field]['root']['type']); $is++) {
			$root = "";
			if ($page['crud']['insert_disable'][$field]['root']['type'][$is] == 'count' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'count-month' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'max' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'max-month') {

				if ($page['crud']['insert_disable'][$field]['root']['type'][$is] == 'count' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'count-month')
					$insert_disable['select'][] = 'count(*) as total';
				else if ($page['crud']['insert_disable'][$field]['root']['type'][$is] == 'max' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'max-month')
					$insert_disable['select'][] = 'max(' . $page['database']['primary_key'] . ') as total';

				if ($page['crud']['insert_disable'][$field]['root']['type'][$is] == 'max-month' or $page['crud']['insert_disable'][$field]['root']['type'][$is] == 'count-month') {
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
						$insert_disable['where'][] = array($page['database']['utama'] . "." . $page['crud']['insert_disable']['nomor']['root']['month_get_row_where'][$is], ">=", "'" . '$tahun-$bulan-01' . "'");
						$insert_disable['where'][] = array($page['database']['utama'] . "." . $page['crud']['insert_disable']['nomor']['root']['month_get_row_where'][$is], "<", "'" . '$tahun_plus_1-$bulan_plus_1-01' . "'");
					} else {
						$insert_disable['where'][] = array($page['database']['utama'] . "." . $page['crud']['insert_disable']['nomor']['root']['month_get_row_where'][$is], ">=", "'$tahun-$bulan-01'");
						$insert_disable['where'][] = array($page['database']['utama'] . "." . $page['crud']['insert_disable']['nomor']['root']['month_get_row_where'][$is], "<", "'$tahun_plus_1-$bulan_plus_1-01'");
					}
				}
				$insert_disable['non_add_select']=true;
				$insert_disable['utama'] = $page['database']['utama'];
				if ($page['section'] == 'viewsource') {

					$row = $fai->database_coverter($page, $insert_disable, null, 'source');
					$query = $row;
					$return_content .= '
					$sql="' . $query . '";';
					$return_content .= '$' . $field . '=DB::connection()->select($sql);';
					$return_content .= '$root = $' . $field . '[0]->total+1;';
				} else {
					$row = $fai->database_coverter($page, $insert_disable, null);
					$root = $row[0]->total + 1;
				}
			}
			if (isset($page['crud']['insert_disable'][$field]['root']['sprintf'][$is])) {
				if ($page['section'] == 'viewsource') {
					$return_content .= '$root= sprintf("%0' . $page['crud']['insert_disable'][$field]['root']['sprintf_number'][$is] . 'd", $root);';
				} else {
					$root = sprintf('%0' . $page['crud']['insert_disable'][$field]['root']['sprintf_number'][$is] . 'd', $root);
				}
			}
			if ($page['section'] == 'viewsource') {
				$return_content .= '$string .= $root;';
			} else {
				$string .= $root;
			}
		}
		if ($page['section'] == 'viewsource') {
			$return_content .= '$string .= "' . (isset($page['crud']['insert_disable'][$field]['suffix']) ? $page['crud']['insert_disable'][$field]['suffix'] : '') . '";';

			$return_content .=  '
		?>';
			$valueinput = '<?=$string?>';
		} else {

			$string .= isset($page['crud']['insert_disable'][$field]['suffix']) ? $page['crud']['insert_disable'][$field]['suffix'] : '';
			$valueinput = $string;
		}


		$input_inline .=  ' ' . 'readonly';
	}

	if (isset($page['crud']['value_input_database'][$field])) {

		$row = $fai->database_coverter($page, $page['crud']['value_input_database'][$field]['database'], null);
		$row_value = $page['crud']['value_input_database'][$field]['row_value'];
		$valueinput = $row[0]->$row_value;
	}

	if (isset($page['crud']['crud_inline'][$field])) {
		$crud_inline = $page['crud']['crud_inline'][$field];
		$crud_inline_temp = $crud_inline;
		$crud_inline_string = "";
		if (strpos($crud_inline, '???')) {
			$excrud_inline = explode("???", $crud_inline);

			for ($ci = 0; $ci < count($excrud_inline); $ci++) {
				$crud_inline = $excrud_inline[$ci];
				$temp = $crud_inline;
				$sub_string_awal = substr($crud_inline, (strpos($crud_inline, '!!!') + 3));

				$ex_string = explode(':', $sub_string_awal);

				if ($ex_string[0] == 'var') {
					$to_string = $ex_string[1];
					$new_string = $$to_string;
				} else if ($ex_string[0] == 'row') {
					$to_string = $ex_string[1];
					if ($page['section'] == 'viewsource') {
						$new_string = '$data->' . $to_string;
					} else
						$new_string = $data->$to_string;
				} else {

					$new_string = "";
				}

				$crud_inline = str_replace('!!!' . $sub_string_awal, $new_string, $crud_inline);

				$crud_inline_string .= $crud_inline;
			}
		} else {
			$crud_inline_string = $crud_inline;
		}
		$input_inline .= ' ' . $crud_inline_string;
	}
	if (isset($page['crud']['insert_autofield'][$field])) {
		$enddiv = '<div class="form-check mt-3">
                	<input class="form-check-input" type="checkbox" name="autofield_' . $field . '" onclick="insert_autofield_' . $field . '(this)">
                    <label class="form-check-label" for="defaultCheck1"> Auto </label>
                </div>' . $enddiv;
	}
	if (isset($page['crud']['field_value_automatic_sub_kategori'][$field])) {

		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="field_value_automatic_sub_kategori_' . $field . '(this,' . $numbering . ');', $input_inline);
		} else {
			$input_inline .= ' onchange="field_value_automatic_sub_kategori_' . $field . '(this,' . $numbering . ')"';
		}
	}
	if (isset($page['crud']['hidden_show'][$field])) {

		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="hidden_show_' . $field . '(this,' . $numbering . ');', $input_inline);
		} else {
			$input_inline .= ' onchange="hidden_show_' . $field . '(this,' . $numbering . ')"';
		}
	}
	if (isset($page['crud']['field_value_automatic'][$field])) {

		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="field_value_automatic_' . $field . '(this);', $input_inline);
		} else {
			$input_inline .= ' onchange="field_value_automatic_' . $field . '(this)"';
		}
	}
	if (isset($page['crud']['select_other'][$field])) {

		$startdiv = '<div class="form-group row" ><label class="control-label col-3 ">' . $text . '</label><div class="col-8" id="select_other_content-' . $field . '" data-name="' . $prefix_name . $field . $sufix_name . '">';
		$enddiv = '</div> <div class="col-1"><button type="button" class="btn btn-primary" onclick="select_other_modal_' . $field . '(this);">+</button></div></div>';
	}
	if (isset($page['crud']['field_value_automatic_select_target'][$field])) {

		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="field_value_automatic_select_target_' . $field . '(this);', $input_inline);
		} else {
			$input_inline .= ' onchange="field_value_automatic_select_target_' . $field . '(this)"';
		}
	}
	if (isset($page['crud']['field_view_sub_kategori'][$field])) {

		if ($page['crud']['field_view_sub_kategori'][$field]['type'] == 'get') {

			if (strpos($input_inline, 'onchange=')) {
				$input_inline = str_replace('onchange="', 'onchange="field_view_sub_kategori_' . $field . '(this);', $input_inline);
			} else {
				$input_inline .= ' onchange="field_view_sub_kategori_' . $field . '(this)"';
			}
		} else {
			$startdiv = '<div class="form-group row" ><label class="control-label col-3 ">' . $text . '</label><div class="col-8">';
			$enddiv = '</div> <div class="col-1"><button type="button" class="btn btn-primary" onclick="field_view_sub_kategori_' . $field . '(this);">+</button></div></div>';
		}
	}
	if (isset($page['crud']['js_ajax'])) {
		$js_ajax = "";
		for ($i = 0; $i < count($page['crud']['js_ajax']); $i++) {
			if ($page['crud']['js_ajax'][$i]["form_input"] == $field) {
				$js_ajax .= "js_ajax_" . $page['crud']['js_ajax'][$i]["form_input"] . "_" . $page['crud']['js_ajax'][$i]["name"] . "();";
			}
		}

		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="'.$js_ajax .';', $input_inline);
		} else {
			$input_inline .= ' onchange="'.$js_ajax .'"';
		}
		if (strpos($input_inline, 'onkeyup=')) {
			$input_inline = str_replace('onkeyup="', 'onkeyup="'.$js_ajax .';', $input_inline);
		} else {
			$input_inline .= ' onkeyup="'.$js_ajax .'"';
		}
	}
	if (isset($page['crud']['unique_value'])) {
		if (in_array($field, $page['crud']['unique_value']['list_field'])) {
			if (strpos($input_inline, 'onchange=')) {
				$input_inline = str_replace('onchange="', 'onchange="search_unique(' . "'" . $field . "'" . ',$(' . "'#" . $field . $numbering . "'" . ').val());', $input_inline);
			} else {
				$input_inline .= ' onchange="search_unique(' . "'" . $field . "'" . ',$(' . "'#" . $field . $numbering . "'" . ').val())"';
			}

			if (strpos($input_inline, 'onkeyup=')) {
				$input_inline = str_replace('onkeyup="', 'onkeyup="search_unique(' . "'" . $field . "'" . ',$(' . "'#" . $field . $numbering . "'" . ').val());', $input_inline);
			} else {
				$input_inline .= ' onkeyup="search_unique(' . "'" . $field . "'" . ',$(' . "'#" . $field . $numbering . "'" . ').val())"';
			}
		}
	}
	if (isset($page['crud']['wizard_form'])) {
		if (in_array($field, $page['crud']['wizard_form']['list_field'])) {
			if (strpos($input_inline, 'onchange=')) {
				$input_inline = str_replace('onchange="', 'onchange="change_wizard_form_' . $field . '($(' . "'#" . $field . $numbering . "'" . ').val(),'."'".$field . $numbering."'".','.$numbering.');', $input_inline);
			} else {
				$input_inline .= ' onchange="change_wizard_form_' . $field . '($(' . "'#" . $field . $numbering . "'" . ').val(),'."'".$field ."'".','.$numbering.');"';
			}
		}
	}
	if ($type == 'number') {
		//			$input_inline .= ' onkeypress="handleNumber(event, -100,3)" ';
	}
	if ($type == 'picture-upload') {
		if (strpos($input_inline, 'onchange=')) {
			$input_inline = str_replace('onchange="', 'onchange="readURL(this,' . "'$field'" . ');', $input_inline);
		} else {
			$input_inline .= ' onchange="readURL(this,' . "'$field'" . ');"';
		}
	}
	if ($type == 'multiple-tag') {
		$input_inline .= ' data-role="tagsinput" ';
	}
	if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource' and !isset($page['crud']['no_input_value']) and  !isset($page['crud']['set_input_value'])) {
		$valueinput = '<?=$' . $fai->nama_function($page, $page['title']) . '->' . $field . ';?>';
	} else
if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource' and isset($page['crud']['set_input_value'])) {
		//echo 'set_input_value';
		$valueinput = $page['crud']['set_input_value']['tag'];
	}

	if (isset($page['crud']['select_other'][$field])) {

		$startdiv = '<div class="form-group row" ><label class="control-label col-3 ">' . $text . '</label><div class="col-8" id="select_other_content-' . $field . '" data-name="' . $prefix_name . $field . $sufix_name . '">';
		$enddiv = '</div> <div class="col-1"><button type="button" class="btn btn-primary" onclick="select_other_modal_' . $field . '(this);">+</button></div></div>';
	}

	if (isset($page['crud']['list_input_charger'])) {
		if (in_array($field, $page['crud']['list_input_charger'])) {
			$list_input_charger = array();
			for ($k = 0; $k < count($page['crud']['list_input_charger_detail'][$field]); $k++) {

				$parameter = $page['crud']['list_input_charger_detail'][$field][$k]['parameter_input'];
				$parameter = str_replace('<NUMBERING></NUMBERING>', $numbering, $parameter);

				for ($l = 0; $l < count($page['crud']['list_input_charger_detail'][$field][$k]['oninput']); $l++) {
					if (strpos($input_inline, $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '=')) {
						$input_inline = str_replace($page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="', $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="input_' . $field . $page['crud']['list_input_charger_detail'][$field][$k]['i'] . '(' . $parameter . ');', $input_inline);
					} else {
						$input_inline .= ' ' . $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="input_' . $field . $page['crud']['list_input_charger_detail'][$field][$k]['i'] . '(' . $parameter . ')"';
					}
				}
			}
		}
	}
	if (isset($page['crud_disabled_value'][$field]) and (in_array($page['view'], array('edit'))   or in_array($fai->input('_view'), array('edit')))) {

		$input_inline .=  ' ' . 'disabled';
		$return_content .=  '<input name="' . $prefix_name . $field . $sufix_name . '" type="hidden" value="' . $valueinput . '">';
	}
	if (isset($page['crud_after_form'][$field])) {
		$crud_after_form .= $page['crud_after_form'][$field];
	}
	if (!isset($valueinput))  $valueinput = '';

	if (isset($page['function'][$field]['function'])) {
		/*
    $param0 = null;
    $param1 = null;
    $param2 = null;
    $param3 = null;
    $param4 = null;
    $param5 = null;
    $param6 = null;
    $param7 = null;
    $func = $page['function'][$field]['function'];
    for ($p = 0; $p < count($page['function'][$field]['param']); $p++) {
        $var = 'param' . $p;
        $value = $page['function'][$field]['param'][$p];
        if ($page['function'][$field]['param'][$p] == '!!!value???')
            $value = $valueinput;
        $$var = $value;
    }
    //if(=='help')
    $valueinput = $page[$page['function'][$field]['type']]->$func($param0, $param1, $param2, $param3, $param4, $param5, $param6, $param7);

*/
	}
	$extype = explode('-', $type);
	if (in_array('r', $extype) or in_array('required', $extype) or in_array('req', $extype)) {

		//echo ''.$type;
		$costum_class .= 'required';
		$type = str_replace('-r', '', $type);
		$type = str_replace('-required', '', $type);
	}

	if (isset($page['crud']['PDFPage'])) {
		$valueinput = '';
		if ($page['crud']['section_vte'] == 'sub_kategori') {

			$variable_object = '' . $fai->nama_function($page, $page['title']) . '';
		} else {
			$variable_object = "data";
		}
		// echo 'test'.$page['section'];
		if ($page['section'] != 'viewsource') {
			if (isset($page['crud']['page_row'])) {
				if ($page['crud']['page_row'] == 'sub_kategori') {
					$data = $data;
				}
			} else {
				$data = $page['crud']['row'][0];
			}
		}
		//$data = $page['row'][0];
		if ($type == "password") {
		} else if ($type == "text-crud") {
		} else
									if ($type == "select") {
			$field_database = $array[$i][4];
			if (!$field_database) {
				if (isset($array[$i][3][3]))
					$field_database = $array[$i][3][2] . '_' . $array[$i][3][0] . '_' . $array[$i][3][3];
				else
					$field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
			}
			if ($page['section'] == 'viewsource')
				$valueinput = '<?=$' . $variable_object . '->' . $field_database . '?>';
			else
				$valueinput = $data->$field_database;
		} else if ($type == "select-multiple-string") {
			$multiple = DB::select_object("select array_agg(" . $array[$i][3][0] . "." . $array[$i][3][2] . ") as value from " . $array[$i][3][0] . " where " . $array[$i][3][1] . " in(" . $data->$field . ")");
			$valueinput = str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value);
		} else if ($type == "select-manual") {
			$field_database = $array[$i][3];
			if ($page['section'] == 'viewsource') {
				$return_content .=   '<?php 
        	$' . $field . ' = "";
        	';
				//print_r($field_database);
				$l = 0;
				foreach (($field_database) as $key => $value) {
					if ($l != 0)
						$return_content .=  'else ';
					$return_content .=  'if($' . $variable_object . '->' . $field . '==' . $field_database[$key] . '){
        			$' . $field . ' = "' . $field_database[$key] . '";
        		}
        		';
					$l++;
				}
				$return_content .=  '?>';
				$valueinput = '<?=$' . $field . '?>';
			} else {

				if ($data->$field)
					$valueinput = $field_database[$data->$field];
				else
					$valueinput = '';
			}
		} else if ($type == "select-appr") {
			$field_database = $array[$i][3];
			$field = $field . '_status';
			if ($data->$field)
				$valueinput = $field_database[$data->$field];
			else
				$valueinput = '';
			if ($data->$field != 3)
				$row_edit_hapus = false;
		} else if ($type == "text-alias") {
			$field_database = $array[$i][3];
			if ($page['section'] == 'viewsource')
				$valueinput = '<?=$' . $variable_object . '->' . $field_database . '?>';
			else
				$valueinput = $data->$field_database;
		} else {
			if ($page['section'] == 'viewsource')
				$valueinput = '<?=$' . $variable_object . '->' . $field . '?>';
			else
				$valueinput = $data->$field;
		}
		if (isset($page['function'][$field]['function'])) {

			$param0 = null;
			$param1 = null;
			$param2 = null;
			$param3 = null;
			$param4 = null;
			$param5 = null;
			$param6 = null;
			$param7 = null;
			$func = $page['function'][$field]['function'];
			for ($p = 0; $p < count($page['function'][$field]['param']); $p++) {
				$var = 'param' . $p;
				$value = $page['function'][$field]['param'][$p];
				if ($page['function'][$field]['param'][$p] == '!!!row???')
					$value = $valueinput;
				$$var = $value;
			}
			$valueinput = $page[$page['crud']['function'][$field]['type']]->$func($param0, $param1, $param2, $param3, $param4, $param5, $param6, $param7);
		}

		if ($page['crud']['section_vte']  == 'sub_kategori') {
			$return_content .=
				$valueinput;
		} else {

			$return_content .= '
			<tr>
				<td style="width:30%">' . $text . '</td>
				<td >: </td>
				<td>' . $valueinput . '</td>
			</tr>
		';
		}
	} else if ($type == 'select' or $type == 'checkbox'  or $type == 'radio') {
		//
		$option = $array[$i][3];

		$database = $option[0];
		$key = $option[1];
		$page['crud']['select_database_costum'][$field]['utama'] = $database;
		$page['crud']['select_database_costum'][$field]['primary_key'] = $key;
	    //print_r($page['crud']['select_database_costum']);
		$value = $option[2];
		$select = isset($select) ? $select : array();
		$select = isset($select) ? $select : array();
		

		if ($page['section'] != 'viewsource') {
		
			$rowoption = $fai->database_coverter($page, $page['crud']['select_database_costum'][$field], array(), 'all');
		}
		//print_r($rowoption);
		//echo $key;
		// $return_content.= json_encode($rowoption); 
		$content_form_check = $startdiv;
		$content_form_detail = $startdiv;
		$content_form_detail .= '<select name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-select select2 form-control ' . $costum_class . ' " type="text" placeholder="' . $text . '" ' . $input_inline . '>';
		if($rowoption['num_rows']>1)
		$content_form_detail .= '<option value="0">- ' . $text . ' -</option>';
		if($rowoption['num_rows']==0)
		$content_form_detail .= '<option value="0"> - Tidak ada data - </option>';
		if ($page['section'] == 'viewsource') {
			if ($page['crud']['type'] == 'ajax') {
				$content_form_detail .=  "';foreach($" . $field . ' as $dataoption){  ';
				$content_form_detail .=  'echo ' . "'" . '<option value="' . "'." . '$dataoption->' . $key . ".'" . '" ';
				$content_form_detail .=  "';foreach($" . $field . ' as $dataoption){  ';
				$content_form_detail .=  'echo ' . "'" . '<option value="' . "'." . '$dataoption->' . $key . ".'" . '" ';

				if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource' or $page['crud']['type'] == 'ajax') and $page['section'] == 'viewsource') {
					//echo "'.(".'$'.$fai->nama_function($page,$page['title']).'->'.$field.'==$dataoption->'.$key.'?"selected":"")'.".'
					$content_form_detail .=  ">" . "'." . '$dataoption->' . $value . ".'" . ' </option>' . "';" . ' }  echo ' . "'";
				}
			} else {
				$content_form_detail .= '<?php foreach($' . $field . ' as $dataoption){ ?> ';
				$content_form_detail .= "<option value='" .  '<?=$dataoption->' . $key . ';?>' . "'";

				if (isset($page['crud']['view_source_search_load'])) {
					if (in_array($field, $page['crud']['view_source_search_load'])) {
						$content_form_detail .=  '<?=$data->' . $field . '==$dataoption->' . $key . '?"selected":"";?>';
					}
				} else
                if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') {
					/* $content_form_detail .=  '<?=$'.$fai->nama_function($page,$page['title']).'->'.$field.'==$dataoption->'.$key.'?"selected":"";?>';
	            */
					if (!isset($page['crud']['no_input_value']) and !isset($page['crud']['set_input_value']))
						$content_form_detail .=  '<?=$' . $fai->nama_function($page, $page['title']) . '->' . $field . '==$dataoption->' . $key . '?"selected":"";?>';
					else 
                if (isset($page['crud']['set_input_value']))
						$content_form_detail .=  $page['crud']['set_input_value']['tag'];
				}

				$content_form_detail .= ">" .  '<?=$dataoption->' . $value . ';?>' . "</option>";
				$content_form_detail .= '<?php  } ?> ';
			}
		} else {

			if ($rowoption['num_rows']) {
				// print_r($rowoption['query']);

				foreach ($rowoption['row'] as $dataoption) {

					$content_form_check .= '<input type="'.$type.'" value="' . $dataoption->$key . '" ' . ($valueinput == $dataoption->$key ? "checked" : "") . '>' . $dataoption->$value . '</input>';
					$content_form_detail .= '<option '.$valueinput.' value="' . $dataoption->$key . '" ' . ($valueinput == $dataoption->$key ? "selected" : "") . '>' . $dataoption->$value . '</option>';
				}
			}
		}
		$content_form_detail .= '</select>';
		$content_form_detail .= $enddiv . $crud_after_form;
		$content_form_check .= $enddiv . $crud_after_form;
		if($type=='select')
		$return_content .= $content_form_detail;
		else
		$return_content .= $content_form_check;
	} else if ($type == 'select-multiple-string') {
		$option = $array[$i][3];
		$database = $option[0];
		$key = $option[1];
		$value = $option[2];
		$sepearator = $array[$i][5];



		$rowoption = $fai->database_coverter($page, $database, $key, $select, $where, $join, array(), $page['request'], $selectRaw, $whereRaw);
		$return_content .= '' . $startdiv . '
    <select name="' . $prefix_name . $field . $sufix_name . '[]" id="' . $field . $numbering . '" type="' . $type . '" multiple class="form-select form-control ' . $costum_class . ' " type="text" placeholder="' . $text . '" ' . $input_inline . '>
        <option value="">- ' . $text . ' -</option>';
		foreach ($rowoption as $dataoption) {
			$return_content .= '<option value="' . $dataoption->$key . '" ' . in_array($dataoption->$key, explode($sepearator, $valueinput)) ? "selected" : "" . '>' . $dataoption->$value . '</option>';
		}
		$return_content .= '</select>
    ' . $enddiv . $crud_after_form;
	} else if ($type == 'select-manual') {
		$option = $array[$i][3];

		$return_content .= $startdiv . '
    <select name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-select form-control ' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . '>
        <option value="">- ' . $text . ' -</option>';
		foreach ($option as $key => $value) {
			$return_content .= '<option value="' . $key . '" ' . ($valueinput == $key ? "selected" : "") . '>' . $value . '</option>';
		}
		$return_content .= '</select>' . $enddiv . $crud_after_form;
	} else if ($type == 'select-ajax') {

		$return_content .= $startdiv . '
    <select name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-select form-control ' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . '>
        <option value="">- ' . $text . ' -</option>';

		$return_content .= '</select>' . $enddiv . $crud_after_form;
	} else if ($type == 'radio-manual') {
		$option = $array[$i][3];

		$return_content .= $startdiv . '
   
        ';
		foreach ($option as $key => $value) {
			$return_content .= ' <input type="radio" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '> ' . $value . '';
		}
		$return_content .= '' . $enddiv . $crud_after_form;
	} else if ($type == 'radio2-manual') {
		$option = $array[$i][3];

		$return_content .= '<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column py-2">

				<label class="form-label">
					' . $text . '
				</label>';
		foreach ($option as $key => $value) {
			$return_content .= '	
				<label class="form-selectgroup-item flex-fill">
				<input type="radio" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-selectgroup-input ' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '>
					<div class="form-selectgroup-label d-flex align-items-center p-3">
						<div class="me-3">
							<span class="form-selectgroup-check">
							</span>
						</div>
						<div>

							 ' . $value . '
						</div>
					</div>
				</label>';
		}
		$return_content .= '</div>';

		$return_content .= '' . $crud_after_form;
	} else if ($type == 'checkbox-manual') {
		$option = $array[$i][3];

		$return_content .= $startdiv . '
   
        ';
		foreach ($option as $key => $value) {
			$return_content .= ' <input type="checkbox" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-check-input' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '> <span class="form-check-label">' . $value . '</span>';
		}
		$return_content .= '' . $enddiv . $crud_after_form;
	} else if ($type == 'checkbox2-manual') {
		$option = $array[$i][3];

		$return_content .= '<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column py-2">

				<label class="form-label">
					' . $text . '
				</label>';
		foreach ($option as $key => $value) {
			$return_content .= '	
				<label class="form-selectgroup-item flex-fill">
				<input type="checkbox2" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-selectgroup-input ' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '>
					<div class="form-selectgroup-label d-flex align-items-center p-3">
						<div class="me-3">
							<span class="form-selectgroup-check">
							</span>
						</div>
						<div>

							 ' . $value . '
						</div>
					</div>
				</label>';
		}
		$return_content .= '</div>';

		$return_content .= '' . $crud_after_form;
	} else if ($type == 'picture-upload') { 
		$return_content .= '
				<div class="avatar-upload "  style="height: 150px; margin-bottom:20px;display: grid;justify-content: center;align-content: center;">
						<div class="avatar-edit">

							<input type="file" id="filefotoimage" name="' . $prefix_name . $field . $sufix_name . '[]" accept=".png, .jpg, .jpeg" ' . $input_inline . '>
							<label for="filefotoimage">
							</label>
						</div>
						<div class="avatar-preview" style="width: 150px;height: 150px;border-radius: 25px 57px">
							<div id="imagePreview' . $field . '" style="background-image: url(http://localhost/FrameworkServer/hibe3/images/default-profile-pic.png);border-radius: 18px 47px;"></div>
						</div>
						</div>
					';
	} else if ($type == 'textarea') {
		$return_content .=  $startdiv . '
    <textarea name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '" type="text" placeholder="' . $text . '">' . $valueinput;
		if ($page['section'] == 'viewsource')  $return_content .= '&#60;/textarea>';
		else  $return_content .= '</textarea>';
		$return_content .=  $enddiv . $crud_after_form;
	} else if ($type == 'contenteditable') {
		$return_content .= '<div class="text-muted m-0" data-placeholder="Masukan ' . $text . '" id=""' . $field . $numbering . 'Value" style="outline: 0;' . $input_inline . '" contenteditable="true">' . $valueinput . '</div>
					<div>
						<textarea class="d-none" name="' . $prefix_name . $field . $sufix_name . '" id=""' . $field . $numbering . 'Value" data-placeholder="' . $text . '" placeholder="' . $text . '">' . $valueinput . '</textarea>
					</div>';
	} else if ($type == 'disabled') {
		if (in_array($page['view'], array('edit', 'view'))) {

			$return_content .= $startdiv;
			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '" type="text" placeholder="' . $text . '" value="' . $valueinput . '" disabled>
        ' . $enddiv . $crud_after_form;
		}
	} else if ($type == 'hidden') {
		//print_r($page['crud']['row']);
		$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class  . '" type="text" placeholder="' . $text . '" value="' . $valueinput  . '" readonly>';
	} else if ($type == 'div') {
		//print_r($page['crud']['row']);
		$return_content .= '<h4>' . $text . '</h4>';
		$return_content .= '<div id="' . $field . '"></div>';
	} else if ($type == 'number_dari_sampai') {
		$return_content .= $startdiv;
		$return_content .= '<div class="row">';
		$return_content .= '<div class="col-5">';
		$return_content .= '<input name="' . $prefix_name . $field."_dari" . $sufix_name . '" id="' . $field."_dari" . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="Dari ' . $text . '" value="' . $valueinput . '" />';
		
		$return_content .= '</div>';
		$return_content .= '<div class="col-1"> - ';
		$return_content .= '</div>';
		$return_content .= '<div class="col-6">';
		$return_content .= '<input name="' . $prefix_name . $field."_sampai" . $sufix_name . '" id="' . $field."_sampai" . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="Sampai ' . $text . '" value="' . $valueinput . '" />';
		
		$return_content .= '</div>';
		$return_content .= '</div>';
		$return_content .= $enddiv . $crud_after_form;
	} else if ($type == 'number') {
		$return_content .= $startdiv;
		$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="' . $text . '" value="' . $valueinput . '" />';
		$return_content .= $enddiv . $crud_after_form;
	} else {
		$return_content .= $startdiv;
		$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="' . $text . '" value="' . $valueinput . '" />';
		$return_content .= $enddiv . $crud_after_form;
	}
	//$return_content .= '<input type="hidden" id="supporting_'. $field . $numbering.'"></span><span class="help-block text-danger" id="help_'. $field . $numbering.'"></span>';
	return $return_content;
}
