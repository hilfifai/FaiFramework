<?php

class Content
{

	public static function parse_form($fai, $page, $array, $type, $i, $no, $data, $return_typearray)
	{

		//DB::connection($page);
		$return_content = "";
		$text = $array[$i][0];
		$field = isset($array[$i][5]) ? $array[$i][5] : $array[$i][1];
		$input_inline = isset($page['crud']['input_inline']) ? $page['crud']['input_inline'] : '';
		$costum_class = isset($page['crud']['costum_class'][$field]) ? $page['crud']['costum_class'][$field] . ' ' . $field : ' ' . $field;
		$prefix_name = isset($page['crud']['prefix_name']) ? $page['crud']['prefix_name'] : '';
		$sufix_name = isset($page['crud']['sufix_name']) ? $page['crud']['sufix_name'] : '';
		if ($return_typearray['required']) {
			$input_inline .= " required ";
		}
		$is_edit = 0;
		if ((in_array($page['crud']['view'], array('edit', 'view')) or in_array($fai->input('_view'), array('edit', 'view')))) {
			$is_edit = 1;
		}
		if (isset($return_typearray['is_right'])) {
			if (isset($page['crud']['costum_class'][$field])) {

				$page['crud']['costum_class'][$field] .= ' text-right';
			} else {
				$page['crud']['costum_class'][$field] = ' text-right';
			}
		}
		if (isset($return_typearray['is_number'])) {
			if (($return_typearray['is_number'])) {
				if (strpos($input_inline, 'onkeypress=')) {
					$input_inline = str_replace('onkeypress="', 'onkeypress="handleNumber(event,\'{-30,3}\');', $input_inline);
				} else {
					$input_inline .= ' onkeypress="handleNumber(event,\'{-30,3}\')"';
				}
				$input_inline .= ' data-number="true" ';
				if (isset($page['crud']['costum_class'][$field])) {

					$page['crud']['costum_class'][$field] .= ' is_number';
				} else {
					$page['crud']['costum_class'][$field] = ' is_number';
				}
				// $return_content .= '<input type="hidden" name="is_number[]" value="' . $prefix_name . $field . $sufix_name . '">';
			}
		}
		$crud_after_form = '';
		$numbering = isset($page['crud']['numbering']) ? $page['crud']['numbering'] : 0;
		;

		if ($type == 'file' or $type == "photos" or $type == "file-upload" or $type == 'video') {
			$sufix_name = $numbering . "[]";
		}
		$page['crud']['type_form_asal'] = isset($page['crud']['type_form_asal']) ? $page['crud']['type_form_asal'] : (isset($type) ? $type : $array[$i][2]);

		if (isset($page['load']['crud']['type_form_default']['costum_class']['type'])) {
			if ($page['load']['crud']['type_form_default']['costum_class']['type'] == $type)
				$costum_class .= ' ' . $page['load']['crud']['type_form_default']['costum_class']['text'];
		}
		if (isset($page['load']['crud']['costum_class'])) {
			$costum_class .= ' ' . $page['load']['crud']['costum_class'];
		}
		if (isset($page['crud']['page_row'])) {
			if ($page['crud']['page_row'] == 'sub_kategori') {
				$numbering = $no;
			}
		}
		$numbering = ($page['load_section'] == 'viewsource' ? '<?=$no;?>' : $numbering);
		$extypearray = explode('-', $array[$i][2]);
		if ((in_array('right', $extypearray)))
			$costum_class .= ' text-right';
		if (isset($page['load']['form']['type'])) {

			$formType = $page['load']['form']['type'];
		} else if (isset($page['crud']['form_type'])) {

			$formType = $page['crud']['form_type'];
		} else if (isset($page['crud']['form_type_spesific'][$field])) {
			$formType = $page['crud']['form_type_spesific'][$field];
		} else {
			$formType = 1;
		}

		if ($formType == 1) {

			$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group row mb-1" ><label class="control-label col-3 " style="font-weight:600">' . $text . '</label><div class="col-9 ' . (!empty($page['crud']['input_group']['prefix'][$field]) ? 'input-group' : '') . '">';
			$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
		} elseif ($formType == 2) {

			$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group  mb-1" ><label class="control-label  " style="font-weight:600">' . $text . '</label><div class="' . (!empty($page['crud']['input_group']['prefix'][$field]) ? 'input-group' : '') . '">';
			$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
		}
		if (isset($page['crud']['view_sub_kategori'])) {
			if ($page['crud']['view_sub_kategori'] == 'table') {
				$startdiv = '<div class="input-group">';
			}
		}
		if (empty($enddiv)) {
			$enddiv = '</div>';
		}
		if (empty($startdiv)) {
			$startdiv = '<div class="form-group">';
		}
		if (!empty($page['crud']['input_group']['prefix'][$field])) {
			$startdiv = '<div class="form-group row mb-1" ><label class="control-label col-12 " style="font-weight:600">' . $text . '</label><div class="input-group"><span class="input-group-text">' . $page['crud']['input_group']['prefix'][$field] . '</span>';
		}
		if (!empty($page['crud']['input_group']['suffix'][$field])) {
			$template_input_group = '<span class="input-group-text"><TEXT></TEXT></span>';
			if (!empty($page['crud']['input_group']['suffix_type'][$field])) {
				$template_input_group = $page['crud']['input_group']['suffix_type'][$array[$i][1]];
				;
			}
			$enddiv = str_replace('<TEXT></TEXT>', $page['crud']['input_group']['suffix'][$field], $template_input_group) . $enddiv;
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

					$row = $data;
				}
			} else if ($page['crud']['section_vte'] == 'approval') {
				$row = $data;
			} else {
				$row = $page['crud']['row']['row'];
			}
			$typearray = explode('-', $type);

			if ($type == "password") {
				$valueinput = '';
			} else if (in_array("extend_db", $typearray)) {
				$type = str_replace("-extend_db", "", $type);
				if (isset($page['crud']['array_extend']['value_input'][$field]))
					$valueinput = $page['crud']['array_extend']['value_input'][$field];
				// } else if ($type == "text-alias") {
				// 	$field_database = $array[$i][3];
				// 	if ($page['crud']['section_vte'] == 'sub_kategori')
				// 		$valueinput = $row->$field_database;
				// 	else
				// 		$valueinput = $row[0]->$field_database;
				// } else if (($type  == "select") or ($page['crud']['type_form_asal']  == "select" or $page['crud']['type_form_asal']  == "select-relation" or $page['crud']['type_form_asal']  == "select-multiple-string") and (!$page['type'] == 'field_view_sub_kategori')) {

				// 	$page['crud']['database_utama'];
				// 	$field_database = Database::get_colomn_select($page, $array[$i], $page['crud']['database_utama'], 'id_select', 'row');

				// 	if ($page['crud']['section_vte'] == 'sub_kategori') {

				// 		$valueinput = $row->$field_database;
				// 	} else
				// 		$valueinput = $row[0]->$field_database;
				// } else if ($type == "select-appr") {
			} else if (substr($field, -(strlen('__all_change'))) == "__all_change") {
				$valueinput = "";
			} else {

				$field_data = isset($page['crud']['field_database'][$field][$page['crud']['database_utama']]['value']) ? $page['crud']['field_database'][$field][$page['crud']['database_utama']]['value'] : $field;
				if ($page['crud']['section_vte'] == 'sub_kategori') {
					$valueinput = $row->$field_data;
				} else {

					$valueinput = $row[0]->$field_data;
					// echo "$field_data:".$valueinput;
				}
			}
		} else {
			$valueinput = isset($page['crud']['valueinput'][$field]) ? $page['crud']['valueinput'][$field] : '';
		}
		if (
			(isset($page['crud']['insert_value'][$field]) and (in_array($page['crud']['view'], array('tambah')) or in_array($fai->input('_view'), array('tambah'))))

			or
			(isset($page['crud']['update_value'][$field]) and (in_array($page['crud']['view'], array('edit')) or in_array($fai->input('_view'), array('edit'))) and !$valueinput)
		) {
			if ((in_array($page['crud']['view'], array('edit')) or in_array($fai->input('_view'), array('edit')))) {
				unset($page['crud']['insert_value'][$field]);
			}
			if (in_array($page['crud']['view'], array('edit')) and isset($page['crud']['update_value'][$field])) {
				$page['crud']['insert_value'][$field] = $page['crud']['update_value'][$field];
			}
			$string = $page['crud']['insert_value'][$field];
			if ($string == 'date:now') {
				if ($page['section'] == 'viewsource')
					$string = '<?=date("Y-m-d")?>';
				else
					$string = date("Y-m-d");
			}
			$valueinput = $string;
		}
		if (!isset($row)) {
		} else if ($page['crud']['section_vte'] == 'sub_kategori') {
			$row_data = $row;
		} else {

			$row_data = $row[0];
		}
		$insert_number_code = CRUDFunc::insert_number_code_nomor($fai, $page, $field, $valueinput);
		$return_content .= $insert_number_code['return_content'];
		if ($insert_number_code['valueinput'])
			$valueinput = $insert_number_code['valueinput'];
		if (!isset($page['crud']['section_vte']))
			$page['crud']['section_vte'] = 'utama';
		if ($page['crud']['section_vte'] == 'sub_kategori' and isset($row)) {
			$row_temp = $row;
			unset($row);
			$row[0] = $row_temp;
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


		if (isset($page['crud']['field_value_automatic_select_target'][$field])) {

			if (strpos($input_inline, 'onchange=')) {
				$input_inline = str_replace('onchange="', 'onchange="field_value_automatic_select_target_' . $field . '(this,' . $numbering . ');', $input_inline);
			} else {
				$input_inline .= ' onchange="field_value_automatic_select_target_' . $field . '(this,' . $numbering . ')"';
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
				$input_inline = str_replace('onchange="', 'onchange="' . $js_ajax . ';', $input_inline);
			} else {
				$input_inline .= ' onchange="' . $js_ajax . '"';
			}
			if (strpos($input_inline, 'onkeyup=')) {
				$input_inline = str_replace('onkeyup="', 'onkeyup="' . $js_ajax . ';', $input_inline);
			} else {
				$input_inline .= ' onkeyup="' . $js_ajax . '"';
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
					$input_inline = str_replace('onchange="', 'onchange="change_wizard_form_' . $field . '($(' . "'#" . $field . $numbering . "'" . ').val(),' . "'" . $field . $numbering . "'" . ',' . $numbering . ');', $input_inline);
				} else {
					$input_inline .= ' onchange="change_wizard_form_' . $field . '($(' . "'#" . $field . $numbering . "'" . ').val(),' . "'" . $field . "'" . ',' . $numbering . ');"';
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
		if (($page['crud']['type'] == 'all_viewsource') and $page['section'] == 'viewsource' and !isset($page['crud']['no_input_value']) and !isset($page['crud']['set_input_value'])) {
			$valueinput = '<?=($page!="tambah"?$' . $fai->nama_function($page, $page['title']) . '->' . $field . ':"");?>';
		} else if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource' and !isset($page['crud']['no_input_value']) and !isset($page['crud']['set_input_value'])) {
			$valueinput = '<?=$' . $fai->nama_function($page, $page['title']) . '->' . $field . ';?>';
		} else if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource' and isset($page['crud']['set_input_value'])) {

			$valueinput = $page['crud']['set_input_value']['tag'];
		}



		if (isset($page['crud']['list_input_charger'])) {
			if (in_array($field, $page['crud']['list_input_charger'])) {
				$list_input_charger = array();
				for ($k = 0; $k < count($page['crud']['list_input_charger_detail'][$field]); $k++) {

					$parameter = $page['crud']['list_input_charger_detail'][$field][$k]['parameter_input'];
					$parameter = str_replace('<NUMBERING></NUMBERING>', $numbering, $parameter);

					for ($l = 0; $l < count($page['crud']['list_input_charger_detail'][$field][$k]['oninput']); $l++) {
						if (strpos($input_inline, $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '=')) {
							$input_inline = str_replace($page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="', $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="input_' . $field . '(' . $parameter . ');', $input_inline);
						} else {
							$input_inline .= ' ' . $page['crud']['list_input_charger_detail'][$field][$k]['oninput'][$l] . '="input_' . $field . '(' . $parameter . ')"';
						}
					}
				}
			}
		}
		if (isset($page['crud']['select_other'][$field])) {

			$startdiv .= '<div class="row"><div class="col-9" id="select_other_content-' . $field . '" data-name="' . $prefix_name . $field . $sufix_name . '">	';
			$enddiv = '</div> <div class="col-1"><button type="button" class="btn btn-primary" onclick="select_other_modal_' . $field . '(this);">+</button></div>' . $enddiv;
		}
		// if (isset($page['crud']['select_other'][$field])) {

		// 	$startdiv = '<div class="form-group row" ><label class="control-label col-3 ">' . $text . '</label><div class="col-8" id="select_other_content-' . $field . '" data-name="' . $prefix_name . $field . $sufix_name . '">';
		// 	$enddiv = '</div> <div class="col-1"><button type="button" class="btn btn-primary" onclick="select_other_modal_' . $field . '(this);">+</button></div></div>';
		// }
		if (isset($page['crud_disabled_value'][$field]) and (in_array($page['view'], array('edit')) or in_array($fai->input('_view'), array('edit')))) {

			$input_inline .= ' ' . 'disabled';
			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" type="hidden" value="' . $valueinput . '">';
		}
		if (isset($page['crud_after_form'][$field])) {
			$crud_after_form .= $page['crud_after_form'][$field];
		}
		if (!isset($valueinput))
			$valueinput = '';

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

			$costum_class .= 'required';
			$type = str_replace('-r', '', $type);
			$type = str_replace('-required', '', $type);
		}

		$input_inline = str_replace('<NUMBERING></NUMBERING>', $numbering, $input_inline);
		if ($valueinput and $type == 'number-cur')
			$valueinput = $page['section'] == 'viewsource' ?
				'<?=$help->rupiah(' . trim(str_ireplace(array('<?=', ';', '?>'), '', $valueinput)) . ',\'\');?>'
				: Partial::rupiah($valueinput);
		if ($valueinput and $type == 'number') {
			$valueinput = $page['section'] == 'viewsource' ?
				'<?=$help->rupiah(' . trim(str_ireplace(array('<?=', ';', '?>'), '', $valueinput)) . ',\'\');?>'
				: Partial::rupiah($valueinput, 0, '');
		}
		if (isset($page['crud']['PDFPage'])) {
			$valueinput = '';
			if ($page['crud']['section_vte'] == 'sub_kategori') {

				$variable_object = '' . $fai->nama_function($page, $page['title']) . '';
			} else {
				$variable_object = "data";
			}
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
			} else if ($type == "select") {
				$field_database = isset($array[$i][4]) ? $array[$i][4] : 0;
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
					$return_content .= '<?php 
            	$' . $field . ' = "";
            	
				';
					$l = 0;
					foreach (($field_database) as $key => $value) {
						if ($l != 0)
							$return_content .= '
						else ';
						$return_content .= 'if($' . $variable_object . '->' . $field . '==' . $field_database[$key] . '){
            			$' . $field . ' = "' . $field_database[$key] . '";
            		}
            		
					';
						$l++;
					}
					$return_content .= '?>';
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

			if ($page['crud']['section_vte'] == 'sub_kategori') {
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
		} else if ($type == 'select-from' and (in_array($page['crud']['view'], array('tambah')) or in_array($fai->input('_view'), array('tambah')))) {
			$page_select_form = $page;
			$apps = $fai->Apps($array[$i][3]['apps'], $array[$i][3]['page_view']);
			$array_select_form = $apps['crud']['array'];



			$content_form_detail .= "<div id='select-form-$field'>";
			for ($i_select_form = 0; $i_select_form < count($page_select_form['crud']['array']); $i_select_form++) {

				$return_select_form = CrudContent::typearray($page, $array, $i_select_form);
				$type_select_form = $return['type'];
				$visible = $return['visible'];
				if ($visible)
					$content_form_detail .= CrudContent::form($fai, $page, $array_select_form, $type_select_form, $i_select_form, $no, $data, $return_select_form);
			}
			$content_form_detail .= "</div>";
		} else if ($type == 'select' or $type == 'select-from' or $type == 'checkbox' or $type == 'radio') {

			$option = $array[$i][3];


			$content_form_detail = "";

			// $return_content.= json_encode($rowoption); 
			$field_database_id = Database::get_colomn_select($page, $array[$i], $page['crud']['database_utama'], 'id_select', 'row');
			$field_database_name = Database::get_colomn_select($page, $array[$i], $page['crud']['database_utama'], 'name_select', 'row');
			if (!isset($page['crud']['data'][$field]['nonselect2'])) {
				$content_form_detail = '<script>
				
					function select2_' . $field . $numbering . '(){
					$("#' . $field . $numbering . '").select2({
					
					ajax: {
							url: ' . ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['select2_' . $field, -1])) . '"') : "$('#load_link_route').val()") . ',
							
							dataType: "json",
							data: (params) => {
								return {
									q: params.term,
									' . ($page['load_section'] != 'viewsource' ? ('
									link_route: $("#load_link_route").val(),
									apps: $("#load_apps").val(),
									page_view: $("#load_page_view").val(),
									type: "select2",
									id: $("#load_id").val(),
									i_array: ' . $i . ',
									field: "' . ($field) . '",
									json_array: \'' . json_encode($option) . '\',
									contentfaiframework: "get_pages",
									frameworksubdomain: $("#load_domain").val(),
									MainAll: 2,
									') : '') . '
									' . (isset($page['crud']['field_value_automatic_select_target_select2'][$field]) ? ('
									field_value_automatic_select_target_select2_target: \'' . $page['crud']['field_value_automatic_select_target_select2'][$field]['target'] . '\',
									field_value_automatic_select_target_select2_request_where: \'' . $page['crud']['field_value_automatic_select_target_select2'][$field]['request_where'] . '\',
									' . $page['crud']['field_value_automatic_select_target_select2'][$field]['request_where'] . ': $("#' . $page['crud']['field_value_automatic_select_target_select2'][$field]['target'] . $numbering . '").val(),
									
									') : '') . '
									' . (isset($page['crud']['field_value_automatic_select_target'][$field]) ? ('
									field_value_automatic_select_target_select2_target: \'' . $page['crud']['field_value_automatic_select_target'][$field]['target'] . '\',
									field_value_automatic_select_target_select2_request_where: \'' . $page['crud']['field_value_automatic_select_target'][$field]['request_where'] . '\',
									' . $page['crud']['field_value_automatic_select_target'][$field]['request_where'] . ': $("#' . $page['crud']['field_value_automatic_select_target'][$field]['target'] . $numbering . '").val(),
									
									') : '') . '
									' . ((isset($page['crud']['select_database_costum'][$field]) and $page['section'] != 'viewsource') ? ('
									select_database_costum: \'' . str_replace("'", "&#39;", preg_replace('/\r\n|\r|\n/', '', json_encode($page['crud']['select_database_costum'][$field]))) . '\',
									
									') : '') .
					'
								}
							},
							processResults: (data, params) => {
								const results = data.items.map(item => {
									return {
										id: item.id,
										text: item.full_name || item.name,
									};
								});
								return {
									results: results,
								}
							},
						},
					});
					' . ((substr($field, strlen('search_')) == "search_" and $page['section'] == 'viewsource') ? '
					 $newOption = $("<option selected=\'selected\'></option>").val("' . $valueinput . '").text("' . (


						$page['load_section'] == 'viewsource' ? $valueinput = '<?=($page!="tambah"?$' . $fai->nama_function($page, $page['title']) . '->' . $field_database_name . ':"");?>' : (isset($row) ? $row[0]->$field_database_name : '')) . '")
 
					$("#' . $field . $numbering . '").append($newOption).trigger("change");
					
					' : '') . '
					}

					$(document).ready(function(){

					 select2_' . $field . $numbering . '();
					 });
			</script>';
				if ($page['crud']['view'] != 'ajax' and (in_array($page['crud']['view'], array('edit', 'view')) or in_array($fai->input('_view'), array('edit', 'view'))) and substr($field, -(strlen('__all_change'))) != "__all_change") {

					$content_form_detail .= '<script>
				$(document).ready(function(){

						$newOption = $("<option selected=\'selected\'></option>").val("' . ($page['section'] != 'viewsource' ? (isset($row[0]) ? $row[0]->$field_database_id : $row->$field_database_id) : '') . '").text("' . ($page['section'] != 'viewsource' ? (isset($row[0]) ? $row[0]->$field_database_name : $row->$field_database_name) : '') . '")

						$("#' . $field . $numbering . '").append($newOption).trigger("change");
									
					});
		   </script>';
				}
			}
			$content_form_check = $startdiv;
			$content_form_detail .= $startdiv;
			$content_form_detail .= '<select name="' . $prefix_name . $field . $sufix_name . '" 
						id="' . $field . $numbering . '" type="' . $type . '" 
						class="form-control ' . $costum_class . ' " 
						type="text" 
						placeholder="' . $text . '" ' . $input_inline . '>';
			if (isset($page['crud']['data'][$field]['nonselect2'])) {
				$content_form_detail .= "<option value=''>-Pilih $text-</test>";
				$option = $array[$i][3];

				$database = $option[0];
				$key = $option[1];
				$value = $option[2];
				$page['crud']['select_database_costum'][$field]['utama'] = $database;
				$page['crud']['select_database_costum'][$field]['primary_key'] = $key;
				$rowoption = $fai->database_coverter($page, $page['crud']['select_database_costum'][$field], array(), 'all');
				if ($rowoption['num_rows']) {
					foreach ($rowoption['row'] as $dataoption) {

						$content_form_check .= '<input type="' . $type . '" value="' . $dataoption->$key . '" ' . ($valueinput == $dataoption->$key ? "checked" : "") . '>' . $dataoption->$value . '</input>';
						$content_form_detail .= '<option ' . $valueinput . ' value="' . $dataoption->$key . '" ' . ($valueinput == $dataoption->$key ? "selected" : "") . '>' . $dataoption->$value . '</option>';
					}
				}
			}
			// (!isset($page['load']['crud_template']['class']['not_select2']) ? ' select2 select3 ' : ' ')
			$content_form_detail .= '</select>';
			if ($page['section'] != 'viewsource' and !isset($page['crud']['data'][$field]['nonselect2']))
				$content_form_detail .= '<Br><button onclick="select2_' . $field . $numbering . '()" type="button" class="btn btn-primary btn-xs">Reload</button>';







			$content_form_detail .= $enddiv . $crud_after_form;


			$content_form_check .= $enddiv . $crud_after_form;
			if ($type == 'select')
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
				$return_content .= '<option value="' . $key . '" ' . ($page['section'] == 'viewsource' ? '' . substr($valueinput, 0, -3) . '==' . "'$key'?'selected':'';?>" : ($valueinput == $key ? "selected" : "")) . '>' . $value . '</option>';
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
		} else if ($type == 'editor-code') {

			$return_content .= $startdiv . '</div><div class="col-md-12">
			
			
				<pre id="editor_' . $field . $numbering . '" style="width: 100%;height: 500px;overflow: scroll;" onkeyup="typing_' . $field . $numbering . '(this)">' . htmlspecialchars_decode($valueinput) . '</pre>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>

				<script>
				var editor_' . $field . $numbering . ' = ace.edit("editor_' . $field . $numbering . '");
				editor_' . $field . $numbering . '.setTheme("ace/theme/tomorrow");
				editor_' . $field . $numbering . '.session.setMode("ace/mode/php");
				editor_' . $field . $numbering . '.setOptions({
					enableBasicAutocompletion: true,
					enableSnippets: true,
					enableLiveAutocompletion: false
				});
				function typing_' . $field . $numbering . '(){
				var get_editor_' . $field . $numbering . ' = ace.edit("editor_' . $field . $numbering . '");
				var code = get_editor_' . $field . $numbering . '.getValue();
			
					$("#' . $field . $numbering . '").val(escapeHtml(code));
				}
			</script>
				';
			$return_content .= '<textarea  name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control d-none' . $costum_class . '" type="text" placeholder="' . $text . '" value="' . $valueinput . '" readonly></textarea>';

			$return_content .= '' . $enddiv . $crud_after_form;
		} else if ($type == 'radio2-manual') {
			$option = $array[$i][3];

			$return_content .= $startdiv;
			foreach ($option as $key => $value) {
				$exvalue = explode('!!', $value);
				$return_content .= '	
    				<label class="form-selectgroup-item flex-fill">
    				<input type="radio" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-selectgroup-input ' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '>
    					<div class="form-selectgroup-label d-flex p-3" style="text-align: left;">
						<div class="me-3">
						<span class="form-selectgroup-check">
    							</span>
    						</div>
    						<div>
    
							' . $exvalue[0] . '
							<div class="text-muted"> ' . (isset($exvalue[1]) ? $exvalue[1] : '') . '</div>
    						</div>
							</div>
							</label>';
			}
			$return_content .= $enddiv;

			$return_content .= '' . $crud_after_form;
		} else if ($type == 'checkbox-tree-database') {
			//ashion template
			//array("Kategori",   null, "checkbox-tree-database", array("id","nama_kategori"), 
			// 				array("tree_database_utama"=>"webmaster__inventaris__master__kategori",
			// 						"tree_primary_key"=> "id",
			// 						"tree_parent_id"=> "id_parent",
			// 						"tree_form_parent"=>0,)),

			$return_content .= '
			<div class="sidebar__categories">
                            <div class="section-title">
                                <h4>' . $text . '</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    ';
			$db = $array[$i][4]['tree_database_utama'];
			$primari = $array[$i][4]['tree_primary_key'];
			$parent_row = $array[$i][4]['tree_parent_id'];
			$id_parent = $array[$i][4]['tree_form_parent'];
			$start_parent = $array[$i][4]['tree_form_parent'];

			function treefunction($page, $array, $i, $db, $primari, $parent_row, $id_parent, $field, $numbering, $prefix_name, $sufix_name, $valueinput, $input_inline)
			{
				$return_content = "";

				DB::queryRaw($page, "select *,(select count(*) from $db a where a.$parent_row = $db.$primari) as count from $db where $parent_row = $id_parent");
				$get = DB::get('all');

				$option = $array[$i][3];
				$key_row = $option[0];
				$value_row = $option[1];
				$row_get = $array[$i][3][1];

				foreach ($get['row'] as $tree) {
					if ($tree->count) {

						$return_content .= '
						<style>
						.sidebar__sizes,
						.sidebar__color {
							margin-bottom: 40px;
						}

						.sidebar__sizes .section-title,
						.sidebar__color .section-title {
							margin-bottom: 35px;
						}

						.sidebar__sizes .section-title h4,
						.sidebar__color .section-title h4 {
							font-size: 18px;
						}

						.sidebar__sizes .size__list label,
						.sidebar__color .size__list label {
							display: block;
							padding-left: 20px;
							font-size: 14px;
							text-transform: uppercase;
							color: #444444;
							position: relative;
							cursor: pointer;
						}

						.sidebar__sizes .size__list label input,
						.sidebar__color .size__list label input {
							position: absolute;
							visibility: hidden;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark,
						.sidebar__color .size__list label input:checked~.checkmark {
							border-color: #ca1515;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark:after,
						.sidebar__color .size__list label input:checked~.checkmark:after {
							border-color: #ca1515;
							opacity: 1;
						}

						.sidebar__sizes .size__list label .checkmark,
						.sidebar__color .size__list label .checkmark {
							position: absolute;
							left: 0;
							top: 4px;
							height: 10px;
							width: 10px;
							border: 1px solid #444444;
							border-radius: 2px;
						}

						.sidebar__sizes .size__list label .checkmark:after,
						.sidebar__color .size__list label .checkmark:after {
							position: absolute;
							left: 0px;
							top: -2px;
							width: 11px;
							height: 5px;
							border: solid #ffffff;
							border-width: 1.5px 1.5px 0px 0px;
							-webkit-transform: rotate(127deg);
							-ms-transform: rotate(127deg);
							transform: rotate(127deg);
							opacity: 0;
							content: "";
						}

						.sidebar__color .color__list label {
							text-transform: capitalize;
						}
							</style>
												<div class="card">
											<div class="card-heading">
											<a data-toggle="collapse" data-target="#collapse' . $tree->id . '">' . $tree->$row_get . '</a>
                                        </div>
                                        <div id="collapse' . $tree->id . '" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
											<div class="sidebar__sizes">
                       						 <div class="size__list">	

                                                ' . treefunction($page, $array, $i, $db, $primari, $parent_row, $tree->$primari, $field, $numbering, $prefix_name, $sufix_name, $valueinput, $input_inline) . '
													</div>
													</div>
													</div>
													</div>
													</div>';
					} else {
						$return_content .= '<label for="' . $field . $numbering . str_replace(' ', '', $tree->$key_row) . '">
                                ' . $tree->$value_row . '
                                <input type="checkbox" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . str_replace(' ', '', $tree->$key_row) . '"  value="' . $tree->$key_row . '" ' . ($valueinput == $tree->$value_row ? "checked" : "") . ' >
                                <span class="checkmark"></span>
                            </label>';
					}
				}
				return $return_content;
			}
			;
			$return_content .= treefunction($page, $array, $i, $db, $primari, $parent_row, $id_parent, $field, $numbering, $prefix_name, $sufix_name, $valueinput, $input_inline) . '    </div>
                            </div>
                        </div>';
		} else if ($type == 'checkbox3-manual') {
			$return_content .= '
			<style>
			.sidebar__sizes,
						.sidebar__color {
							margin-bottom: 40px;
						}

						.sidebar__sizes .section-title,
						.sidebar__color .section-title {
							margin-bottom: 35px;
						}

						.sidebar__sizes .section-title h4,
						.sidebar__color .section-title h4 {
							font-size: 18px;
						}

						.sidebar__sizes .size__list label,
						.sidebar__color .size__list label {
							display: block;
							padding-left: 20px;
							font-size: 14px;
							text-transform: uppercase;
							color: #444444;
							position: relative;
							cursor: pointer;
						}

						.sidebar__sizes .size__list label input,
						.sidebar__color .size__list label input {
							position: absolute;
							visibility: hidden;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark,
						.sidebar__color .size__list label input:checked~.checkmark {
							border-color: #ca1515;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark:after,
						.sidebar__color .size__list label input:checked~.checkmark:after {
							border-color: #ca1515;
							opacity: 1;
						}

						.sidebar__sizes .size__list label .checkmark,
						.sidebar__color .size__list label .checkmark {
							position: absolute;
							left: 0;
							top: 4px;
							height: 10px;
							width: 10px;
							border: 1px solid #444444;
							border-radius: 2px;
						}

						.sidebar__sizes .size__list label .checkmark:after,
						.sidebar__color .size__list label .checkmark:after {
							position: absolute;
							left: 0px;
							top: -2px;
							width: 11px;
							height: 5px;
							border: solid #ffffff;
							border-width: 1.5px 1.5px 0px 0px;
							-webkit-transform: rotate(127deg);
							-ms-transform: rotate(127deg);
							transform: rotate(127deg);
							opacity: 0;
							content: "";
						}

						.sidebar__color .color__list label {
							text-transform: capitalize;
						}
							</style>
									<div class="sidebar__sizes">
                        <div class="section-title">
                            <h4>' . $text . '</h4>
                        </div>
                        <div class="size__list">';
			$option = $array[$i][3];
			foreach ($option as $key => $value) {
				$return_content .= '	
				<label for="' . $field . $numbering . str_replace(' ', '', $value) . '">
                                ' . $value . '
                                <input type="checkbox" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . str_replace(' ', '', $value) . '"  value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . ' ' . $input_inline . '>
                                <span class="checkmark"></span>
                            </label>
				';
			}
			$return_content .= '	
                            
                            
                        </div>
                    </div>';
		} else if ($type == 'checkbox3-database') {
			$return_content .= '
			<style>	
			.sidebar__sizes,
						.sidebar__color {
							margin-bottom: 40px;
						}

						.sidebar__sizes .section-title,
						.sidebar__color .section-title {
							margin-bottom: 35px;
						}

						.sidebar__sizes .section-title h4,
						.sidebar__color .section-title h4 {
							font-size: 18px;
						}

						.sidebar__sizes .size__list label,
						.sidebar__color .size__list label {
							display: block;
							padding-left: 20px;
							font-size: 14px;
							text-transform: uppercase;
							color: #444444;
							position: relative;
							cursor: pointer;
						}

						.sidebar__sizes .size__list label input,
						.sidebar__color .size__list label input {
							position: absolute;
							visibility: hidden;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark,
						.sidebar__color .size__list label input:checked~.checkmark {
							border-color: #ca1515;
						}

						.sidebar__sizes .size__list label input:checked~.checkmark:after,
						.sidebar__color .size__list label input:checked~.checkmark:after {
							border-color: #ca1515;
							opacity: 1;
						}

						.sidebar__sizes .size__list label .checkmark,
						.sidebar__color .size__list label .checkmark {
							position: absolute;
							left: 0;
							top: 4px;
							height: 10px;
							width: 10px;
							border: 1px solid #444444;
							border-radius: 2px;
						}

						.sidebar__sizes .size__list label .checkmark:after,
						.sidebar__color .size__list label .checkmark:after {
							position: absolute;
							left: 0px;
							top: -2px;
							width: 11px;
							height: 5px;
							border: solid #ffffff;
							border-width: 1.5px 1.5px 0px 0px;
							-webkit-transform: rotate(127deg);
							-ms-transform: rotate(127deg);
							transform: rotate(127deg);
							opacity: 0;
							content: "";
						}

						.sidebar__color .color__list label {
							text-transform: capitalize;
						}
							</style>
							<div class="sidebar__sizes">
                        <div class="section-title">
                            <h4>' . $text . '</h4>
                        </div>
                        <div class="size__list">';
			$option = $array[$i][3];
			$key_row = $option[0];
			$value_row = $option[1];
			$page['crud']['select_database_costum'][$field] = $array[$i][4];
			if ($page['section'] != 'viewsource') {
				$rowoption = $fai->database_coverter($page, $page['crud']['select_database_costum'][$field], array(), 'all');
			} else {
				$rowoption['num_rows'] = 1;
			}
			if ($rowoption['num_rows']) {

				foreach ($rowoption['row'] as $dataoption) {
					$return_content .= '	
					<label for="' . $field . $numbering . str_replace(' ', '', $dataoption->$key_row) . '">
					' . $dataoption->$value_row . '
					<input type="checkbox" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . str_replace(' ', '', $dataoption->$key_row) . '"  value="' . $dataoption->$key_row . '" ' . ($valueinput == $dataoption->$value_row ? "checked" : "") . ' ' . $input_inline . '>
					<span class="checkmark"></span>
					</label>
					';
				}
			}
			$return_content .= '	
                            

                        </div>
                    </div>';
		} else if ($type == 'checkbox-manual') {
			$option = $array[$i][3];

			$return_content .= $startdiv . '
			
            ';
			foreach ($option as $key => $value) {
				$return_content .= ' <input type="checkbox" name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" class="form-check-input' . $costum_class . '" type="text" placeholder="' . $text . '" ' . $input_inline . ' value="' . $key . '" ' . ($valueinput == $key ? "checked" : "") . '> <span class="form-check-label">' . $value . '</span>';
			}
			$return_content .= '' . $enddiv . $crud_after_form;
		} else if ($type == 'checkbox2-manual') {


			$return_content .= '<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column py-2">
			
			<label class="form-label">
			' . $text . '
			</label>';
			$option = $array[$i][3];
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
		} else if ($type == 'price_dari_sampai') {
			$return_content .= '<div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10000" data-max="50000000"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#">Filter</a>
                        </div>';
		} else if ($type == 'picture-upload') {
			$return_content .= '
			<style>
							
				.be3-avatar-upload {
				position: relative;

				}
				.be3-avatar-upload .avatar-edit {
				position: absolute;
				right: 12px;
				z-index: 1;
				top: 10px;
				}
				.be3-avatar-upload .avatar-edit input {
				display: none;
				}
				.be3-avatar-upload .avatar-edit input + label {
				display: inline-block;
				width: 25px;
				height: 25px;
				align:center;
				text-align:center;
				margin-bottom: 0;
				border-radius: 100%;
				background: #FFFFFF;
				border: 1px solid transparent;
				box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
				cursor: pointer;
				font-weight: normal;
				transition: all 0.2s ease-in-out;
				}
				.be3-avatar-upload .avatar-edit input + label:hover {
				background: #f1f1f1;
				border-color: #d6d6d6;
				}
				.be3-avatar-upload .avatar-edit input + label:after {
				content: "\f040";
				font-family: "FontAwesome";
				color: #757575;
				position: absolute;
				
				left: 0;
				right: 0;
				text-align: center;
				margin: auto;
				}
				.be3-avatar-upload .avatar-preview {
				width: 90px;
				height: 90px;
				position: relative;
				border-radius: 20px 40px;
				border: 6px solid #F8F8F8;
				box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
				}
				.be3-avatar-upload .avatar-preview > div {
				width: 100%;
				height: 100%;
				border-radius: 15px 30px;
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center;
				}
			</style>

			<div class="be3-avatar-upload "  style="height: 150px; margin-bottom:20px;display: grid;justify-content: center;align-content: center;">
			<div class="avatar-edit">
    
			<input type="file" id="filefotoimage" name="' . $prefix_name . $field . $numbering . $sufix_name . '[]" accept=".png, .jpg, .jpeg" ' . $input_inline . '>
			<label for="filefotoimage">
			</label> 
			</div>
    						<div class="avatar-preview" style="width: 150px;height: 150px;border-radius: 25px 57px">
    							<div id="imagePreview' . $field . '" style="background-image: url(http://localhost/FrameworkServer/hibe3/images/default-profile-pic.png);border-radius: 18px 47px;"></div>
								</div>
								</div>
								';
		} else if ($type == 'textarea') {
			$return_content .= $startdiv . '
        	<textarea name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '" type="text" placeholder="' . $text . '">' . $valueinput;
			if ($page['section'] == 'viewsource')
				$return_content .= '&#60;/textarea>';
			else
				$return_content .= '</textarea>';
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == "photos") {
			$return_content .= $startdiv;
			$return_content .= '
			<style>
						.w-32 {
				width: 12rem;
			}
			.h-32 {
				height: 12rem;
			}
			.relative {
				position: relative;
			}
			.object-cover {
				object-fit: cover;
			}
			.w-full {
				width: 100%;
			}
			.left-0 {
				left: 0;
			}
			.bottom-0 {
				bottom: 0;
			}
			.right-0 {
				right: 0;
			}
			.top-0 {
				top: 0;
			}
			.absolute {
				position: absolute;
			}
			.justify-center {
				justify-content: center;
			}
			.items-center {
				align-items: center;
			}
			.flex {
				display: flex;
			}
			.text-gray-700 {
				--text-opacity: 1;
				color: #4a5568;
				color: rgba(74, 85, 104, var(--text-opacity));
			}
			.shadow-sm {
				box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .05);
			}
			.px-4 {
				padding-left: 1rem;
				padding-right: 1rem;
			}
			.py-2 {
				padding-top: .5rem;
				padding-bottom: .5rem;
			}
			.text-sm {
				font-size: .875rem;
			}
			.font-semibold {
				font-weight: 600;
			}

			.rounded-lg {
				border-radius: .5rem;
			}
			.border-gray-300 {
				--border-opacity: 1;
				border-color: #e2e8f0;
				border-color: rgba(226, 232, 240, var(--border-opacity));
			}
			.hidden {
				display: none;
			}
			.text-gray-700 {
				--text-opacity: 1;
				color: #4a5568;
				color: rgba(74, 85, 104, var(--text-opacity));
			}
				</style>
						<div>
						
							<div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
								<img id="image' . $field . $numbering . '" class="object-cover w-full h-32" src="' . (!empty($valueinput) ? ((in_array($page['crud']['view'], array('edit', 'view')) or in_array($fai->input('_view'), array('edit', 'view'))) ?
					Partial::get_url_file($page, $valueinput, $page['crud']['database_utama']) : 'https://placehold.co/300x300/e2e8f0/e2e8f0') : 'https://placehold.co/300x300/e2e8f0/e2e8f0/' . $valueinput) . '" />
								
								<div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById(\'' . $field . $numbering . '\').click()">
									<button type="button"
										style="background-color: rgba(255, 255, 255, 0.65)"
										class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm"
									>
										<svg xmlns="http://www.w3.org/2000/svg" class=" icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
											<path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
											<circle cx="12" cy="13" r="3" />
										</svg>							  
									</button>
								</div>
							</div>
							<input name="' . $prefix_name . $field . $sufix_name . '[]" id="' . $field . $numbering . '" accept="image/*" class="hidden" type="file" onChange="
							let file' . $field . $numbering . ' = this.files[0]; 
								var reader' . $field . $numbering . ' = new FileReader();

								reader' . $field . $numbering . '.onload = function (e) {
									document.getElementById(\'image' . $field . $numbering . '\').src = e.target.result;
									// document.getElementById(\'image2\').src = e.target.result;
								};
							
								reader' . $field . $numbering . '.readAsDataURL(file' . $field . $numbering . ');
							">
						</div>
		
			';
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == "file-upload") {
			//
			//https://codepen.io/mrtokachh/pen/LYGvPBj
			$return_content .= $startdiv . "
				<style>
				.upload" . $numbering . "__box {

				}
				.upload" . $numbering . "__inputfile {
					width: .1px;
					height: .1px;
					opacity: 0;
					overflow: hidden;
					position: absolute;
					z-index: -1;
				}
				.upload" . $numbering . "__btn {
					display: inline-block;
					font-weight: 600;
					color: #fff;
					text-align: center;
					min-width: 116px;
					transition: all .3s ease;
					cursor: pointer;
					border: 2px solid;
					background-color: #4045ba;
					border-color: #4045ba;
					border-radius: 10px;
					line-height: 26px;
					font-size: 14px;
				}
				.upload" . $numbering . "__btn:hover {
					background-color: unset;
					color: #4045ba;
					transition: all .3s ease;
				}
				.upload" . $numbering . "__btn-box {
					// margin-bottom: 10px;
				}
				.upload" . $numbering . "__img-wrap {
					display: flex;
					flex-wrap: wrap;
					margin: 0 -10px;
				}
				.upload" . $numbering . "__img-box {
					width: 200px;
					padding: 0 10px;
					margin-bottom: 12px;
				}
				.upload" . $numbering . "__img-close {
					width: 24px;
					height: 24px;
					border-radius: 50%;
					background-color: rgba(0, 0, 0, 0.5);
					position: absolute;
					top: 10px;
					right: 10px;
					text-align: center;
					line-height: 24px;
					z-index: 1;
					cursor: pointer;
				}
				.upload" . $numbering . "__img-close:after {
					content: 'x';
					font-size: 14px;
					color: white;
				}
				.img-bg {
					background-repeat: no-repeat;
					background-position: center;
					background-size: cover;
					position: relative;
					padding-bottom: 100%;
				}

					</style>
						" . '<div class="upload' . $numbering . '__box">
				<div class="upload' . $numbering . '__btn-box">
					<label class="upload' . $numbering . '__btn">
					<p>Upload images</p>
					<input type="file" multiple="" name="' . $prefix_name . $field . $sufix_name . '[]"  class="upload' . $numbering . '__inputfile">
					</label>
				</div>
				<div class="upload' . $numbering . '__img-wrap mt-3">
			';
			$listimg = explode(',', $valueinput);
			foreach ($listimg as $key_number => $img) {
				if ($img) {

					$return_content .= "<div class='upload" . $numbering . "__img-box'>
					<div style=\"background-image: url('" . ((in_array($page['crud']['view'], array('edit', 'view')) or in_array($fai->input('_view'), array('edit', 'view'))) ? Partial::get_url_file($page, $img, $page['crud']['database_utama']) : 'https://placehold.co/300x300/e2e8f0/e2e8f0') . "')\" 
					data-number='" . $key_number . "' class='img-bg'><div class='upload" . $numbering . "__img-close' data-edit=1 data-fileget=$img></div></div></div>";
				}
			}

			$return_content .= '
				</div>
				</div>
				</div>
				<div id="file-deleted" style="display:none"></div>
						
				</div>		
							' .
								"
				<script>
				jQuery(document).ready(function () {
				ImgUpload" . $numbering . "();
				});

				function ImgUpload" . $numbering . "() {
				var imgWrap = '';
				var imgArray = [];

				$('.upload" . $numbering . "__inputfile').each(function () {
					$(this).on('change', function (e) {
					imgWrap = $(this).closest('.upload" . $numbering . "__box').find('.upload" . $numbering . "__img-wrap');
					var maxLength = $(this).attr('data-max_length');

					var files = e.target.files;
					var filesArr = Array.prototype.slice.call(files);
					var iterator = 0;
					filesArr.forEach(function (f, index) {

						if (!f.type.match('image.*')) {
						return;
						}

						if (imgArray.length > maxLength) {
						return false
						} else {
						var len = 0;
						for (var i = 0; i < imgArray.length; i++) {
							if (imgArray[i] !== undefined) {
							len++;
							}
						}
						if (len > maxLength) {
							return false;
						} else {
							imgArray.push(f);

							var reader = new FileReader();
							reader.onload = function (e) {
							var html = \"<div class='upload" . $numbering . "__img-box'><div style='background-image: url(\" + e.target.result + \")' data-number='\" + $(\".upload" . $numbering . "__img-close\").length + \"' data-file='\" + f.name + \"' class='img-bg'><div class='upload" . $numbering . "__img-close'  data-edit=0></div></div></div>\";
							imgWrap.append(html);
							iterator++;
							}
							reader.readAsDataURL(f);
						}
						}
					});
					});
				});

				$('body').on('click', '.upload" . $numbering . "__img-close', function (e) {
					var file = $(this).parent().data('file');
					$('#file-deleted').append('<input type=\"hidden\" name=\"file_deleted[" . $page['crud']['database_utama'] . "][" . $field . "][" . ($is_edit ? $row_data->primary_key : -1) . "]\" value=\"'+$(this).data('fileget')+'\">');
					for (var i = 0; i < imgArray.length; i++) {
					if (imgArray[i].name === file) {
						imgArray.splice(i, 1);
						break;
					}
					}
					$(this).parent().parent().remove();
				});
				}
				</script>
				";
		} else if ($type == "file-upload3") {
			$return_content .= '
			
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
			<style>
						
			.dropzone {
				background: white;
				border-radius: 5px;
				border: 2px dashed rgb(0, 135, 247);
				border-image: none;
				max-width: 500px;
				margin-left: auto;
				margin-right: auto;
			}
						</style>

			<SECTION>
			<DIV id="dropzone">
				<FORM class="dropzone needsclick" id="demo-upload" action="/upload">
				<DIV class="dz-message needsclick">    
					Drop files here or click to upload.<BR>
					<SPAN class="note needsclick">(This is just a demo dropzone. Selected 
					files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
				</DIV>
				</FORM>
			</DIV>
			</SECTION>

			<br/>
			<hr size="3" noshade color="#F00000">

			<div style="font-size: 0.8em;">
			<p>If you find this demo useful, please consider <a href="https://www.paypal.me/RobertGravelle/1" target="_blank">donating $1 dollar</a> for a coffee (secure PayPal link) or purchasing one of my songs from <a href="https://ax.itunes.apple.com/WebObjects/MZSearch.woa/wa/search?term=rob%20gravelle" target="_blank">iTunes.com</a> or <a href="http://www.amazon.com/s/ref=ntt_srch_drd_B001ES9TTK?ie=UTF8&field-keywords=Rob%20Gravelle&index=digital-music&search-type=ss" target="_blank">Amazon.com</a> for only 0.99 cents each.</p>
			<p>Rob uses and recommends <a href="http://www.mochahost.com/2425.html" target="_blank">MochaHost</a>, which provides Web Hosting for as low as $1.95 per month, as well as unlimited emails and disk space!</p>
			</div>  
			<DIV id="preview-template" style="display: none;">
			<DIV class="dz-preview dz-file-preview">
			<DIV class="dz-image"><IMG data-dz-thumbnail=""></DIV>
			<DIV class="dz-details">
			<DIV class="dz-size"><SPAN data-dz-size=""></SPAN></DIV>
			<DIV class="dz-filename"><SPAN data-dz-name=""></SPAN></DIV></DIV>
			<DIV class="dz-progress"><SPAN class="dz-upload" 
			data-dz-uploadprogress=""></SPAN></DIV>
			<DIV class="dz-error-message"><SPAN data-dz-errormessage=""></SPAN></DIV>
			<div class="dz-success-mark">
			<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				<title>Check</title>
				<desc>Created with Sketch.</desc>
				<defs></defs>
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					<path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
				</g>
			</svg>
			</div>
			<div class="dz-error-mark">
			<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				<title>error</title>
				<desc>Created with Sketch.</desc>
				<defs></defs>
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					<g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
						<path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
					</g>
				</g>
			</svg>
			</div>

											<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

			<script>
			var dropzone = new Dropzone("#demo-upload", {
			previewTemplate: document.querySelector("#preview-template").innerHTML,
			parallelUploads: 2,
			thumbnailHeight: 120,
			thumbnailWidth: 120,
			maxFilesize: 3,
			filesizeBase: 1000,
			thumbnail: function(file, dataUrl) {
				if (file.previewElement) {
				file.previewElement.classList.remove("dz-file-preview");
				var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
				for (var i = 0; i < images.length; i++) {
					var thumbnailElement = images[i];
					thumbnailElement.alt = file.name;
					thumbnailElement.src = dataUrl;
				}
				setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
				}
			}

			});


			// Now fake the file upload, since GitHub does not handle file uploads
			// and returns a 404

			var minSteps = 6,
				maxSteps = 60,
				timeBetweenSteps = 100,
				bytesPerStep = 100000;

			dropzone.uploadFiles = function(files) {
			var self = this;

			for (var i = 0; i < files.length; i++) {

				var file = files[i];
				totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

				for (var step = 0; step < totalSteps; step++) {
				var duration = timeBetweenSteps * (step + 1);
				setTimeout(function(file, totalSteps, step) {
					return function() {
					file.upload = {
						progress: 100 * (step + 1) / totalSteps,
						total: file.size,
						bytesSent: (step + 1) * file.size / totalSteps
					};

					self.emit("uploadprogress", file, file.upload.progress, file.upload.bytesSent);
					if (file.upload.progress == 100) {
						file.status = Dropzone.SUCCESS;
						self.emit("success", file, "success", null);
						self.emit("complete", file);
						self.processQueue();
						//document.getElementsByClassName("dz-success-mark").style.opacity = "1";
					}
					};
				}(file, totalSteps, step), duration);
				}
			}
			}
			</script>

			';
		} else if ($type == "file-upload2") {
			$return_content .= $startdiv;
			// <FORM class="dropzone needsclick" id="demo-upload" action="/upload">
			$return_content .= '
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
			<style>
			.dropzone {
						background: white;
						border-radius: 5px;
						border: 2px dashed rgb(0, 135, 247);
						border-image: none;
						max-width: 500px;
						margin-left: auto;
						margin-right: auto;
					}</style>

								<div class="dropzone" style="width: 100%;border:2px dashed #e4e6e8;text-align: center;justify-content: center;" id="dropzone' . $numbering . '">
								<form id="demo-upload" class="dropzone" action="/upload" method="post" enctype="multipart/form-data"></form>

						
														<span class="drop-zone__prompt' . $field . $numbering . '">
														<div class="dz-message needsclick">
															<div style="background-image:url(data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\'%3e%3cpath d=\'M11 15H13V9H16L12 4L8 9H11V15Z\' fill=\'%238592A3\'/%3e%3cpath d=\'M20 18H4V11H2V18C2 19.103 2.897 20 4 20H20C21.103 20 22 19.103 22 18V11H20V18Z\' fill=\'%238592A3\'/%3e%3c/svg%3e") !important></div>
															<p class="h4 needsclick pt-4 mb-2">Drag and drop your image here</p>
															<p class="h6 text-muted d-block fw-normal mb-2">or</p>
															<span class="note needsclick btn btn-sm btn-label-primary" id="btnBrowse">Browse image</span>
														</div>
														</span>
														<input type="file" name="' . $prefix_name . $field . $sufix_name . '[]" class="drop-zone__input" data-id="' . $field . $numbering . '" multiple>
														<div class="" style="display:flex" id="thumb-' . $field . $numbering . '"></div>
													</div>
															
					<DIV id="preview-template" style="display: none;">
					<DIV class="dz-preview dz-file-preview">
					<DIV class="dz-image"><IMG data-dz-thumbnail=""></DIV>
					<DIV class="dz-details">
					<DIV class="dz-size"><SPAN data-dz-size=""></SPAN></DIV>
					<DIV class="dz-filename"><SPAN data-dz-name=""></SPAN></DIV></DIV>
					<DIV class="dz-progress"><SPAN class="dz-upload" 
					data-dz-uploadprogress=""></SPAN></DIV>
					<DIV class="dz-error-message"><SPAN data-dz-errormessage=""></SPAN></DIV>
					<div class="dz-success-mark">
					<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
						<title>Check</title>
						<desc>Created with Sketch.</desc>
						<defs></defs>
						<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
							<path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
						</g>
					</svg>
					</div>
					<div class="dz-error-mark">
					<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
						<title>error</title>
						<desc>Created with Sketch.</desc>
						<defs></defs>
						<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
							<g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
								<path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
							</g>
						</g>
					</svg>
					</div>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

													<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
													<script>
					document.addEventListener("DOMContentLoaded", function () {
						Dropzone.autoDiscover = false;
						new Dropzone("#demo-upload");
					});
													var dropzone = new Dropzone(\'#demo-upload2\', {
					previewTemplate: document.querySelector(\'#preview-template\').innerHTML,
					parallelUploads: 2,
					thumbnailHeight: 120,
					thumbnailWidth: 120,
					maxFilesize: 3,
					filesizeBase: 1000,
					thumbnail: function(file, dataUrl) {
						if (file.previewElement) {
						file.previewElement.classList.remove("dz-file-preview");
						var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
						for (var i = 0; i < images.length; i++) {
							var thumbnailElement = images[i];
							thumbnailElement.alt = file.name;
							thumbnailElement.src = dataUrl;
						}
						setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
						}
					}

					});


					// Now fake the file upload, since GitHub does not handle file uploads
					// and returns a 404

					var minSteps = 6,
						maxSteps = 60,
						timeBetweenSteps = 100,
						bytesPerStep = 100000;

					dropzone.uploadFiles = function(files) {
					var self = this;

					for (var i = 0; i < files.length; i++) {

						var file = files[i];
						totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

						for (var step = 0; step < totalSteps; step++) {
						var duration = timeBetweenSteps * (step + 1);
						setTimeout(function(file, totalSteps, step) {
							return function() {
							file.upload = {
								progress: 100 * (step + 1) / totalSteps,
								total: file.size,
								bytesSent: (step + 1) * file.size / totalSteps
							};

							self.emit(\'uploadprogress\', file, file.upload.progress, file.upload.bytesSent);
							if (file.upload.progress == 100) {
								file.status = Dropzone.SUCCESS;
								self.emit("success", file, \'success\', null);
								self.emit("complete", file);
								self.processQueue();
								//document.getElementsByClassName("dz-success-mark").style.opacity = "1";
							}
							};
						}(file, totalSteps, step), duration);
						}
					}
					}
								</script>
						
								';
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == "video") {
			$return_content .= $startdiv;

			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="file" accept="video/*"' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="' . $text . '" value="' . $valueinput . '" />';
			$return_content .= '<div style="width:100%">
							<video id="video-' . $field . $numbering . '" width="300" height="300" controls style="display: block;"></video>
							</div>';
			$return_content .= "<script>
					const input" . $field . $numbering . " = document.getElementById('" . $field . $numbering . "');
				const video" . $field . $numbering . " = document.getElementById('video-" . $field . $numbering . "');
				const videoSource = document.createElement('source');

				input" . $field . $numbering . ".addEventListener('change', function() {
					const files" . $field . $numbering . " = this.files || [];

					if (!files" . $field . $numbering . ".length) return;
					
					const reader" . $field . $numbering . " = new FileReader();

					reader" . $field . $numbering . ".onload = function (e) {
						videoSource.setAttribute('src', e.target.result);
						video" . $field . $numbering . ".appendChild(videoSource);
						video" . $field . $numbering . ".load();
						video" . $field . $numbering . ".play();
					};
					
					reader" . $field . $numbering . ".onprogress = function (e) {
						console.log('progress: ', Math.round((e.loaded * 100) / e.total));
					};
					
					reader" . $field . $numbering . ".readAsDataURL(files" . $field . $numbering . "[0]);
				});
							
			</script>";

			$return_content .= $enddiv . $crud_after_form;
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
			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '" type="text" placeholder="' . $text . '" value="' . $valueinput . '" readonly>';
		} else if ($type == 'div') {
			$return_content .= '<h4>' . $text . '</h4>';
			$return_content .= '<div id="' . $field . '"></div>';
		} else if ($type == 'number_dari_sampai') {
			$return_content .= $startdiv;
			$return_content .= '<div class="row">';
			$return_content .= '<div class="col-5">';
			$return_content .= '<input name="' . $prefix_name . $field . "_dari" . $sufix_name . '" id="' . $field . "_dari" . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="Dari ' . $text . '" value="' . $valueinput . '" />';

			$return_content .= '</div>';
			$return_content .= '<div class="col-1"> - ';
			$return_content .= '</div>';
			$return_content .= '<div class="col-6">';
			$return_content .= '<input name="' . $prefix_name . $field . "_sampai" . $sufix_name . '" id="' . $field . "_sampai" . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="Sampai ' . $text . '" value="' . $valueinput . '" />';

			$return_content .= '</div>';
			$return_content .= '</div>';
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == 'number') {
			$return_content .= $startdiv;
			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="text" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="' . $text . '" value="' . $valueinput . '" />';
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == 'modalform-subkategori-add') {
			$return_content .= $startdiv;
			$return_content .= CrudContent::sub_kategori_modalform($page, $fai, $field, $i, $page['crud']['h_sub_kategori'], $array, $numbering, $array[$i][3]['array'], $data, $array[$i][3]);
			$return_content .= $enddiv . $crud_after_form;
		} else if ($type == 'array_website') {
			$template_array = $array[$i][3];
			if ((in_array($page['crud']['view'], array('edit', 'view')) or in_array($fai->input('_view'), array('edit', 'view')))) {
				foreach ($array[$i][4]['connect'] as $key => $connect) {
					$row_connect = $connect[0];
					if ($data->$row_connect)
						$template_array['database']['where_get_array'][] = array(
							"row" => (isset($connect[2]) ? $connect[2] : $key),
							"array_row" => "text",
							"get_row" => $data->$row_connect
						);
				}
			} else if ((in_array($page['crud']['view'], array('tambah')) or in_array($fai->input('_view'), array('tambah'))) and !isset($page['crud']['where_value_array_website'][$field])) {
				if (($array[$i][4]['get'] != 'database')) {

					$template_array['database']['where_get_array'][] = array(
						"row" => 1,
						"array_row" => "text",
						"get_row" => 0
					);
				}
			}

			foreach ($array[$i][4]['connect'] as $key => $connect) {
				$row_connect = $connect[0];
				$template_array["template_content"] .= '<input type="hidden" name="' . $prefix_name . $row_connect . $sufix_name . '"  value="<TEMPLATE_CONTENT_ROW-' . $row_connect . '></TEMPLATE_CONTENT_ROW-' . $row_connect . '>">';
				$template_array["array"]['TEMPLATE_CONTENT_ROW-' . $row_connect . ''] = array(
					"refer" => "database",

					"row" => $key,
				);
			}

			if (isset($page['crud']['where_value_array_website'][$field])) {
				for ($ix = 0; $ix < count($page['crud']['where_value_array_website'][$field]); $ix++) {

					$template_array['database']['where'][] = $page['crud']['where_value_array_website'][$field][$ix];
				}
			}
			$content = Partial::database_list_view_website($page, $template_array, '');

			$return_content .= $startdiv;
			$return_content .= "<div class='w-100 $costum_class' id='" . $field . $numbering . "'>";
			$return_content .= $content;
			$return_content .= '</div>';
			if (($array[$i][4]['get'] == 'add')) {
				$return_content .= "<button type='button'onclick='detail_array_website_add_" . $array[$i][1] . "()' class='btn btn-primary btn-sm d-block' > <i class='fa fa-edit'></i> </button>";
			}
			// $return_content .= '<input type="hidden" name="' . $prefix_name . $field . $sufix_name . '"  value="' . Partial::html_encode(array(), '', '', $content) . '">';
			$return_content .= $enddiv . $crud_after_form;
		} else {
			$return_content .= $startdiv;
			$return_content .= '<input name="' . $prefix_name . $field . $sufix_name . '" id="' . $field . $numbering . '" type="' . $type . '" ' . $input_inline . ' class="form-control ' . $costum_class . '"  type="text" placeholder="' . $text . '" value="' . $valueinput . '" />';
			$return_content .= $enddiv . $crud_after_form;
		}
		//$return_content .= '<input type="hidden" id="supporting_'. $field . $numbering.'"></span><span class="help-block text-danger" id="help_'. $field . $numbering.'"></span>';
		return $return_content;
	}
	public static function parse_card($page, $array, $row, $fai)
	{
		$page['row']['card'] = $row;
		$id = $page['load']['id'];
		$i = 0;
		$tag = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$type = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$field = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$dataset = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$enkripsi = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$support = isset($array[$i]) ? $array[$i] : null;

		$return = "";
		$dataset;
		$info = '';
		$prefix_costum = '';
		$suffix_costum = '';
		if ($dataset == 'database') {
			$info = $row->$field;
		} else if ($dataset == 'function') {
			$field_function = $field;
			$strutktur_folder = ucfirst(strtolower($field_function[0]));
			$class = $field_function[1];
			require_once(__DIR__ . "../../../Structure/" . $strutktur_folder . "_class/$class.php");
			$new = new $class();
			$function = $field_function[2];
			$parameter1 = isset($field_function[3][0]) ? Database::string_database($page, $fai, $field_function[3][0]) : null;
			$parameter2 = isset($field_function[3][1]) ? Database::string_database($page, $fai, $field_function[3][1]) : null;
			$parameter3 = isset($field_function[3][2]) ? Database::string_database($page, $fai, $field_function[3][2]) : null;
			$parameter4 = isset($field_function[3][3]) ? Database::string_database($page, $fai, $field_function[3][3]) : null;
			$parameter5 = isset($field_function[3][4]) ? Database::string_database($page, $fai, $field_function[3][4]) : null;
			$parameter6 = isset($field_function[3][5]) ? Database::string_database($page, $fai, $field_function[3][5]) : null;
			$return_function = $new->$function($page, $page['load']['type'], $page['load']['id'], $parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6);
			if (isset($field_function[4])) {
				$info = $return_function[$field_function[4]];
			} else
				$info = $return_function;
			// $info = $new->$function($page, $parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6);//
		} else if ($dataset == 'database-costum') {
			$field_costum = $field;
			$prefix_costum = $field_costum[0];
			$field = $field_costum[1];
			$suffix_costum = $field_costum[2];
			$info = ($row->$field);
		} else if ($dataset == 'database-relation') {
			$field_relation = $field;
			$internal_field = $field[1];

			$info = $row->$field;
		} else if ($dataset == 'database-join') {
			$field_relation = $field;
			$internal_field = $field[3];

			$info = $row->$internal_field;
		}

		// if ($enkripsi) {
		//     $info = $prefix_costum . '<be3 text="' . $info . '" done="false"><span class="skeleton-box" style="width:100%;"></span></be3>' . $suffix_costum;
		// }
		$info = $prefix_costum . $info . $suffix_costum;


		if (isset($support['costum_type'])) {

			$type = $support['costum_type'];
		}

		if ($type == 'img') {
			$nama_data = $enkripsi[2];
			$id_data = $enkripsi[1];
			$avatar = Partial::get_avatar($page, de($row->$nama_data), $row->$id_data, 0, $support, 1, 0);

			if (isset($support['source'])) {
				$get_template = Partial::content_source($page, $support);
				$tag = $support['replace_to_image'];
				// if ($support['source'] == 'template') {
				// 	$get_template = file_get_contents(__DIR__ . '/../../Pages/_template/' .
				// 		$support['template_name'] . '/' .
				// 		$support['template_file'] . '.php');
				// 	$tag = $support['replace_to_image'];
				// } else {
				// 	$get_template = ' <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><IMG-SRC></IMG-SRC></div>';
				// 	$tag = "IMG-SRC";
				// }
			} else {
				$get_template = ' <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><IMG-SRC></IMG-SRC></div>';
			}
			if ($avatar['avatar_type'] == 'img') {
				$to_img = "<img src='" . $avatar['avatar_value'] . "' style='height:100%;width:100%;" . (isset($support['style']) ? $support['style'] : '') . "'>";
			} else {
				$to_img = "<span  style='width:100%'>" . $avatar['avatar_value'] . "</span>";
			}
			$return .= str_replace("<$tag></$tag>", $to_img, $get_template);
		} else if ($type == 'get_img') {
			$nama_data = $enkripsi[2];
			$id_data = $enkripsi[1];


			$avatar = Partial::get_avatar($page, ($row->$nama_data), $row->$id_data, $enkripsi[0], 1, $support, 1, 0, 'avatar', $enkripsi[3], $enkripsi[4]);


			$return .= $avatar['avatar_value'];
		} else if (($type) == 'link') {

			if (($dataset)) {
				$page['route_type'] = $dataset;
			}
			$return = Partial::link_direct($page, $page['load']['link_route'], $field);
		} else if ($type == 'title') {
			$return .= '<h3 class="' . (isset($support['class']) ? $support['class'] : 'card-title') . '">' . $info . '</h3>';
		} else if ($type == 'subtitle') {
			$return .= '<h6 class="card-title">' . $info . '</h6>';
		} else if ($type == 'subtitle') {
			$return .= '<h6 class="card-title">' . $info . '</h6>';
		} else if ($type == 'header') {
			$return .= '<div class="card-header">' . $info . '</div>';
		} else if ($type == 'body') {
			$return .= '<div class="card-body">' . $info . '</div>';
		} else if ($type == 'footer') {
			$return .= '<div class="card-footer">' . $info . '</div>';
		} else if ($type == 'tag') {
			$return .= '<div class="card-' . $type . '">';
		} else if ($type == 'info') {
			$return .= '' . $info . '';
		} else if ($type == 'end') {
			$return .= '</div>';
		} else if ($type == 'list') { ?>

															<div class="toolbar card-toolbar-tabs  ml-auto">
																<ul class="nav nav-pills" id="pills-tab" role="tablist">
																	<li class="nav-item">
																		<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
																			aria-controls="pills-home" aria-selected="true">Home</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
																			aria-controls="pills-profile" aria-selected="false">Profile</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
																			aria-controls="pills-contact" aria-selected="false">Contact</a>
																	</li>
																</ul>
															</div>
			<?php
		} else if ($dataset == 'extend') {

			$fai->view($type . '/_Main.blade.php', $page, array('card' => $card));
		} else {
			$return = $info;
		}

		return $return;
	}
	public static function parse_button($page, $array, $row)
	{
		if (isset($page['load']['page_database']))
			$id = $page['load']['page_database'];

		$i = 0;
		$type = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$field = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$dataset = isset($array[$i]) ? $array[$i] : null;
		$i++;
		$enkripsi = isset($array[$i]) ? $array[$i] : null;
		$i++;
		if (isset($array[$i])) {
			if (strpos($array[$i][3], '}}')) {
				$temp = $array[$i][3];
				$temp_ex = explode('}', $array[$i][3]);
				$result_temp = "";
				for ($a = 0; $a < count($temp_ex); $a++) {

					if (strpos($temp_ex[$a], "{{") or substr($temp_ex[$a], 0, 2) == '{{') {
						$temp1_explode = explode('{{', $temp_ex[$a]);
						for ($b = 0; $b < count($temp1_explode); $b++) {
							if (substr($temp1_explode[$b], 0, strlen('row:')) == 'row:') {
								$name_row = substr($temp1_explode[$b], strlen('row:'));

								$result_temp .= $row->$name_row;
							} else {
								$result_temp .= $temp1_explode[$b];
							}
						}
					} else {
						$result_temp .= $temp_ex[$a];
					}
				}

				$array[$i][3] = $result_temp;
			}
		}
		$support = isset($array[$i]) ? ($array[$i] == 'BASE_URL_AFTER_DAFTAR' ? " href='" . base_url('/after_daftar') . "' " : Partial::link_direct($page, $page['load']['link_route'], $array[$i])) : null;
		$i++;
		$costum = isset($array[$i]) ? $array[$i] : null;

		if ($dataset == 'database') {
			$info = $row->$field;
		} else if ($dataset == 'database-costum') {
			$field_costum = $field;
			$prefix_costum = $field_costum[0];
			$field = $field_costum[1];
			$suffix_costum = $field_costum[2];
			$info = $prefix_costum . ($row->$field) . $suffix_costum;
		} else if ($dataset == 'database-relation') {
			$field_relation = $field;
			$internal_field = $field[1];

			$info = $row->$field;
		} else {
			$info = $field;
		}

		if ($enkripsi) {
			$info = '<be3 text="' . $info . '" done="false"><span class="skeleton-box" style="width:80%;"></span></be3>';
		}

		$return = "";
		if ($type == 'Start Group') {
			if ($dataset == 'H') {
				$return .= '<div class="btn-group margin">';
			} else if ($dataset == 'V') {
				$return .= '<div class="btn-group-vertical margin">';
			}
		} else if ($type == 'End Group') {
			$return .= '</div>';
		} else if ($type == 'dropdown') {
			$return .= '
			<div class="btn-group">
				<button type="button" class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" data-toggle="dropdown">' . $info . '<span class="caret"></span></button>
		<ul class="dropdown-menu">
		<?php for($b=0;$b<count($info);$b++){?>
			<li><a href="<?= $info[$b][1] ?>"><?= $info[$b][0] ?></a></li>
			<?php }?>
		</ul>
		</div>
			';
		} else if (strtolower($type) == 'a') {
			$return .= ' <a class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" ' . $support . '>' . $info . '</a>';
		} else {
			$return .= '<button type="' . $type . '" class="' . (isset($costum['class']) ? $costum['class'] : "btn btn-primary") . '" ' . $support . '>' . $info . '</button>';
		}
		return $return;
	}
}
