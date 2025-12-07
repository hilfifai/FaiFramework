<?php
// require_once(__DIR__ . '/../../../Pages/content/_Form.php');
require_once(__DIR__ . '/../App/BForm.php');

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CrudContent
{

	public static function vte($page, $fai)
	{
		$content = "";
		if (isset($_GET['select_other'])) {
			$page['section'] = 'select-other';
		}

		// $filename = isset($page['load']['crud_template']['vte']['template_file']) ?
		// 	($page['load']['crud_template']['vte']['template_file'] ? $page['load']['crud_template']['vte']['template_file'] : 'crud_vte.template')
		// 	: 'crud_vte.template';
		// $template_name = isset($page['load']['crud_template']['vte']['template_name']) ?
		// 	$page['load']['crud_template']['vte']['template_name'] : 'tabler';
		// $content_template = file_get_contents(__DIR__ . '/../../Pages/_template/' . $template_name . '/' . $filename . '.php');
		if (!isset($page['load']['crud_template']['vte'])) {
			$page['load']['crud_template']['vte']['content_source'] = "file_template";
			$page['load']['crud_template']['vte']['template_file'] = "crud_vte.template";
			$page['load']['crud_template']['vte']['template_name'] = "tabler";
		}
		$content_template = Partial::content_source($page, $page['load']['crud_template']['vte']);;

		$content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
		$array_template = array(
			"BREADCUMB" => 'content_breadcumb_vte',
			"SECTION-HEADER" => 'content_section_header',
			"START-CARD" => 'content_start_card',
			"END-CARD" => 'content_end_card',
			"FORM-ACTION" => 'content_form_action',
			"VTE-MAIN" => 'content_vte_main',
			"BUTTON-VTE" => 'content_button_vte',
		);
		$CRUDLISTFUNC = new CrudContentSection();
		foreach ($array_template as $key => $value) {

			if (strpos($content_template, "<$key></$key>"))
				$content_template = str_replace("<$key></$key>", $CRUDLISTFUNC->$value($page), $content_template);
		}
		$content .= (isset($page['file_open']) ? $page['file_open'] : '') . '' .    $content_template;
		$page['section'] = isset($page['section']) ? $page['section'] : 'webpage';

		ob_start();
		$fai->view('_template/dist/js.php', $page, array('array' => $page['crud']['array'], 'page' => $page, 'fai' => $fai));
		$content .= ob_get_clean();
		$content .= isset($page['js']) ? $page['js'] : '';
		$content .= isset($page['file_closed']) ? $page['file_closed'] : '';
		return $content;
	}
	public static function vte_main($page, $fai)
	{



		if (!empty($page['get_panel']['get_user']->is_admin))
			$content = '<br><br><pre>' . (isset($page['crud']['row']['query']) ? $page['crud']['row']['query'] : '')."</pre>";
		else
			$content = "";

		$content .=  isset($page['crud']['crud_before_all']) ? $page['crud']['crud_before_all'] : '';
		$array = $page['crud']['array'];
		if (isset($page['crud']['PDFPage']))
			$content .= '<table style="margin-bottom:10px;">';

		$page['crud']['section_vte'] = 'form';
		if (!isset($no))
			$no = 1;
		if (!in_array($page['crud']['type'], array('PDFPage')))
			$content .= '<div class="row">';
		$content .=  ' <input type="hidden" name="tipe_page" value="' . ($to_view = $page['crud']['view']) . '">';
		$input_inline = "";
		if (isset($page['crud']['input_inline']))
			$input_inline = $page['crud']['input_inline'];

		if ($page['crud']['view'] == "edit_approval") {
			$page['crud']['view'] = "edit";

			$page['crud']['input_inline'] = " disabled ";
		}
		$page['crud']['database_utama'] = (isset($page['database']['alias']) ? $page['database']['alias'] : $page['database']['utama']);
		if (!isset($page['crud']['costum_view'])) {

			for ($i = 0; $i < count($array); $i++) {


				$field = $array[$i][1];
				if (!in_array($page['crud']['type'], array('PDFPage')))
					$content .= '<div class="' . (isset($page['crud']['col_row'][$field]) ? ($page['crud']['col_row'][$field]) : (isset($page['load']['crud']['col_row']) ? $page['load']['crud']['col_row'] : 'col-md-12')) . '" id="div-' . $field . '">';
				if (!isset($page['non_view'][$page['crud']['type']][$field]))
					$content .= CrudContent::form($page, $fai, $array, $i, $no, isset($page['crud']['row']['row']) ? $page['crud']['row']['row'] : array());



				if (!in_array($page['crud']['type'], array('PDFPage'))) $content .= '</div>';
			}

			if (isset($page['crud']['array_extend']['array'])) {
				for ($i = 0; $i < count($page['crud']['array_extend']['array']); $i++) {
					$content .= CrudContent::form($page, $fai, $page['crud']['array_extend']['array'], $i, $no, array());
				}
			}
			$page['crud']['input_inline'] = $input_inline;
			if (isset($page['crud']['array_approval']['approval']) and $to_view != 'tambah') {

				foreach ($page['crud']['array_approval']['approval'] as $key => $value) {
					if (isset($page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['proses'][$page['crud']['array_approval']['id_approval'][$key]]['row'])) {
						$content .= '<hr><h4> Tahap ' . $key . ' : ' . $value[0] . ' ' . $value[1] . '</h4>';
						$disable = false;
						$required = false;
						if (($page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['row']->is_selesai)) {
						} else if ($to_view == 'edit_approval' and ($page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['now_proses']->primary_key == $page['crud']['array_approval']['id_approval'][$key])) {
							$page['crud']['crud_inline']["approve__status_approval__" . $page['crud']['array_approval']['id_approval'][$key]] = " required ";
							$page['crud']['crud_inline']["approve__keterangan__" . $page['crud']['array_approval']['id_approval'][$key]] = " required ";
							$content .= '<input type="hidden" name="id_proses_approval" value="' . $page['crud']['array_approval']['id_approval'][$key] . '">';
						} else if ($page['crud']['view'] == "view") {
							$disable = true;
						} else {
							$disable = true;
							$page['crud']['crud_inline']["approve__status_approval__" . $page['crud']['array_approval']['id_approval'][$key]] = " disabled ";
							$page['crud']['crud_inline']["approve__keterangan__" . $page['crud']['array_approval']['id_approval'][$key]] = " disabled ";
						}
						$array_approval = array(
							array("Persetujuan", "approve__status_approval__" . $page['crud']['array_approval']['id_approval'][$key], "select-manual", array(4 => "Proses Pertimbangan", "2" => "Tolak", "1" => "Setuju")),
							array("Keterangan", "approve__keterangan__" . $page['crud']['array_approval']['id_approval'][$key], "textearea")
						);

						$get_row_approval = $page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['proses'][$page['crud']['array_approval']['id_approval'][$key]]['row'];
						$data_approval[0] = (object) ["approve__status_approval__" . $page['crud']['array_approval']['id_approval'][$key] => $get_row_approval->status_approval, "approve__keterangan__" . $page['crud']['array_approval']['id_approval'][$key] => $get_row_approval->keterangan];
						$page['crud']['section_vte'] = 'approval';
						for ($i = 0; $i < count($array_approval); $i++) {
							$content .= CrudContent::form($page, $fai, $array_approval, $i, $no, $data_approval);
						}

						if (isset($page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['extend'][$page['crud']['array_approval']['id_approval'][$key]]['array'])) {
							$array_approval_extend = $page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['extend'][$page['crud']['array_approval']['id_approval'][$key]]['array'];

							$data_approval_extend[0] = (object) $page['crud']['array_approval']['approval_flow'][$page['crud']['row']['row'][0]->primary_key]['extend'][$page['crud']['array_approval']['id_approval'][$key]]['value_input'];
							for ($i = 0; $i < count($array_approval_extend); $i++) {
								if ($disable) {
									$page['crud']['crud_inline'][$array[$i][2]] = " disabled ";
								}
								$content .= CrudContent::form($page, $fai, $array_approval_extend, $i, $no, $data_approval_extend);
							}
						}
					}
				}
			}

			if (in_array($page['crud']['type'], array('PDFPage')))
				$content .= '</div>';
			if (in_array($page['crud']['type'], array('PDFPage')))
				$content .= '</table>';
			$sub = true;
			if (Partial::input('sub_kategori') == 'not') {
				$sub = false;
			}
			if (isset($page['crud']['sub_kategori']) and $sub) {

				$page['crud']['section_vte'] = 'sub_kategori';
				$content .= CrudContent::sub_kategori($page, $fai);
			}

			$content .=  isset($page['crud']['crud_after']) ? $page['crud']['crud_after'] : '';
			$content .= '</div>';
			$content .= CrudContent::total($page, $fai, $no);
		} else {
			$i_costum = 0;
			$temp_costum = 0;
			foreach ($page['crud']['costum_view']['box'] as $key_box => $value_box) {
				$content .= '<div class="' . $value_box['row'] . ' ">';
				foreach ($page['crud']['costum_view']['box'][$key_box]['content'] as $key_costum => $value_costum) {
					//' . $value_costum['row'] . '

					$content .= '<div class="' . $value_costum['row'] . '">';
					$content .= '<div class="card card-body  ">
						<div class=""><h3>' . $key_costum . '</h3></div>
						<div class="row">
						';
					if (isset($value_costum['array'])) {

						for ($i_costum = 0; $i_costum < count($value_costum['array']); $i_costum++) {
							$field = $value_costum['array'][$i_costum];
							$i = $page['crud']['field_array'][$field];
							$array_costum[$i] = $array[$i];

							if (!in_array($page['crud']['type'], array('PDFPage')))
								$content .= '<div class="' . (isset($page['crud']['col_row'][$field]) ? ($page['crud']['col_row'][$field]) : (isset($page['load']['crud']['col_row']) ? $page['load']['crud']['col_row'] : 'col-md-12')) . '" id="div-' . $field . '">';
							if (!isset($page['non_view'][$page['crud']['type']][$field]))
								$content .= CrudContent::form($page, $fai, $array_costum, $i, $no, isset($page['crud']['row']['row']) ? $page['crud']['row']['row'] : array());
							if (!in_array($page['crud']['type'], array('PDFPage'))) $content .= '</div>';
						}
					}
					if (isset($value_costum['sub_kategori'])) {
						$page_temp  = $page;
						unset($page_temp['crud']['sub_kategori']);
						unset($page_temp['crud']['array_sub_kategori']);
						for ($i_costum = 0; $i_costum < count($value_costum['sub_kategori']); $i_costum++) {
							$page_temp['crud']['section_vte'] = 'sub_kategori';
							$page['crud']['field_sub_kategori'][$value_costum['sub_kategori'][$i_costum]];
							$page_temp['crud']['sub_kategori'][$page['crud']['field_sub_kategori'][$value_costum['sub_kategori'][$i_costum]]] = $page['crud']['sub_kategori'][$page['crud']['field_sub_kategori'][$value_costum['sub_kategori'][$i_costum]]];
							$page_temp['crud']['array_sub_kategori'][$page['crud']['field_sub_kategori'][$value_costum['sub_kategori'][$i_costum]]] = $page['crud']['array_sub_kategori'][$page['crud']['field_sub_kategori'][$value_costum['sub_kategori'][$i_costum]]];
							$content .= CrudContent::sub_kategori($page_temp, $fai);
							// $page['crud']['field_sub_kategori'][$page['crud']['sub_kategori'][$h][1]] = $h;
						}
					}
					if (isset($value_costum['total'])) {
						$content .= CrudContent::total($page, $fai, $no);
					}
					$content .= "</div>";
					$content .= "</div>";
					$content .= "</div>";




					$i_costum++;
				}
				$content .= "</div>";
			}
		}
		$content .=  isset($page['crud']['crud_after_all']) ? $page['crud']['crud_after_all'] : '';

		if (isset($page['crud']['inside_js'])) {
			ob_start();
			$fai->view('_template/dist/js.php', $page, array('array' => $page['crud']['array'], 'page' => $page, 'fai' => $fai));
			$content .= ob_get_clean();
		}
		$content .= "<input type='hidden' id='load_crud_view' value='" . $page['crud']['view'] . "'>";
		return $content;
	}
	public static function form($page, $fai, $array, $i, $no = 0, $data = 0)
	{
		$list_input_charger = array();
		$list_input_charger_detail = array();
		if (isset($page['crud']['function_js'][0])) {

			for ($k = 0; $k < count($page['crud']['function_js']); $k++) {
				if ($page['crud']['function_js'][$k]['type'] == 'input-changer') {
					for ($l = 0; $l < count($page['crud']['function_js'][$k]['row']); $l++) {

						$list_input_charger_detail[$page['crud']['function_js'][$k]['row'][$l]][] = array("i" => $k, "oninput" => $page['crud']['function_js'][$k]['input'], "parameter_input" => isset($page['crud']['function_js'][$k]['parameter_input']) ? $page['crud']['function_js'][$k]['parameter_input'] : '');
					}

					$list_input_charger = array_merge($page['crud']['function_js'][$k]['row'], $list_input_charger);
				}
			}
		}


		$extypearray = explode('-', $array[$i][2]);
		$type = $array[$i][2];
		$field = $array[$i][1];

		$page['crud']['list_input_charger'] = $list_input_charger;
		$page['crud']['list_input_charger_detail'] = $list_input_charger_detail;
		$no = isset($no) ? $no : 0;
		$data = isset($data) ? $data : 0;

		$return = CrudContent::typearray($page, $array, $i);
		$type = $return['type'];
		$visible = $return['visible'];
		if ($visible)
			return Content::parse_form($fai, $page, $array, $type, $i, $no, $data, $return);
		else {
			if (($page['crud']['type'] == 'all_viewsource') and $page['section'] == 'viewsource' and in_array('appr', $extypearray)) {
				return '<?php if($page=="appr-' . (isset($page['crud']['appr'][$field]) ? $page['crud']['appr'][$field] : $field) . '"){?>' .
					Content::parse_form($fai, $page, $array, $type, $i, 1, $data, $return)

					. '<?php }?>';;
			}
		}
	}
	public static function typearray($page, $array, $i)
	{
		$fai = new MainFaiFramework;
		$field = $array[$i][1];
		$type = $array[$i][2];
		$type = $array[$i][2];

		$extypearray = explode('-', $array[$i][2]);
		if (isset($page['crud']['data'][$field]))
			return $page['crud']['data'][$field];
		else {
			$array['array'] = $array;
			$return = Packages::initialize_array($fai, $page, $array, $i, $field, $type, $extypearray);
			$page = $return['page'];
			$array = $return['array']['array'];
			$field = $array[$i][1];
			return $page['crud']['data'][$field];
		}
	}
	public static function view_crud($page, $fai) {}
	public static function sub_kategori($page, $fai)
	{

		$content = "";
		$page_temp_sub_kategori_awal = $page;

		foreach ($page['crud']['sub_kategori'] as $h => $sub_kategori) {
			$sub_kategori = $page['crud']['sub_kategori'][$h];

			$page['crud']['h_sub_kategori'] = $h;
			$content .= isset($page['crud']['crud_before_subkategori'][$sub_kategori[1]]) ? $page['crud']['crud_before_subkategori'][$sub_kategori[1]] : '';
			$content .= '<div class="col-12" id="subkategori_kontent-' . $sub_kategori[1] . '">';
			$content .= '<h3 class="pt-2 pb-2 mb-0">' . $sub_kategori[0] . '</h3>';
			if (isset($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['input']) and !in_array($page['crud']['view'], array('appr', 'view'))) {
				$content .= CrudContent::sub_kategori_search_load($page, $fai, $sub_kategori, $h);
			}

			if (isset($page['crud']['sub_kategori_costum']['no_tambah'][$sub_kategori[1]])) {
				if (in_array($page['crud']['view'], array('tambah')))
					$view_subkategori = false;
				else
					$view_subkategori = true;
			} else {
				$view_subkategori = true;
			}
			if ($view_subkategori) {
				$page['crud']['database_utama'] =  $database_sub = $sub_kategori[1];

				$where = isset($page['crud']['database_sub_kategori'][$database_sub]['where']) ? $page['crud']['database_sub_kategori'][$database_sub]['where'] : array();;
				// $order = isset($page['database_sub_kategori'][$database_sub]['order_by']) ? $page['database_sub_kategori'][$database_sub]['order_by'] : array();;


				$where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), '=', '$id');
				$where[] = array($sub_kategori[1] . ".active", '=', 1);

				$page['crud']['database_sub_kategori'][$database_sub]['utama'] = $sub_kategori[1];;
				$page['crud']['database_sub_kategori'][$database_sub]['primary_key'] = $sub_kategori[2];;
				$page['crud']['database_sub_kategori'][$database_sub]['where'] = $where;;
				$array = $page['crud']['array_sub_kategori'][$h];
				$suffix = "";
				if ($page['section'] != 'viewsource') {
					if (!in_array($page['crud']['view'], array('edit', 'view', 'ajax_sub_kategori'))) {
						$row = (object) ['object' => 'foreach_1_row'];

						$page['crud']['row_sub_kategori'][$h]['row'] = $row;
						$page['crud']['row_sub_kategori'][$h]['num_rows'] = 1;
					} else {
						$row = Database::database_coverter($page, $page['crud']['database_sub_kategori'][$database_sub], $array, 'all');
						$page['crud']['row_sub_kategori'][$h] = $row;
						$suffix = "_edit";
						// $page['crud']['row_sub_kategori'][$h]['row'] = $row;


					}
				} else {
					$row = (object) ['object' => 'foreach_1_row'];
					$page['crud']['row_sub_kategori'][$h]['row'] = $row;
					$page['crud']['row_sub_kategori'][$h]['num_rows'] = 1;
					$page['crud']['row_sub_kategori'][$h]['query'] = "";
					if (in_array($page['crud']['view'], array('edit', 'view')))
						$suffix = "_edit";
				}
				$page['crud']['prefix_name'] = $page['crud']['sub_kategori'][$h][1] . '_';

				$page['crud']['sufix_name'] = $suffix . (isset($page['crud']['super_sufix_name']) ? ($page['crud']['super_sufix_name']) : '[]');


				$no = 0;

				$page['crud']['view_sub_kategori'] = $page['crud']['sub_kategori'][$h][3];
				$page['crud']['page_row'] = 'sub_kategori';
				if ($page['crud']['sub_kategori'][$h][3] == 'table') {
					$page['crud']['startdiv'] = '';
					$page['crud']['enddiv'] = '';
					if (
						isset($page['crud']['row_sub_kategori'][$h]['query'])
						and  (!empty($page['get_panel']['get_user']->is_admin) and $page['load_section'] != 'viewsource')
					)
						$content .= $page['crud']['row_sub_kategori'][$h]['query'];
					$content .= '<div class="pt-3 pb-5">
					<div style="overflow-x: scroll;max-width: 100%;">
                        <table class="table text-nowrap table-striped datatable-' . $page['crud']['view'] . '" id="tablecontentsubkategori-' . $h . '">
                        <thead >
                        	<tr>
                            	<th>No</th>
        				';
					$array = $page['crud']['array_sub_kategori'][$h];
					$content_all_change = "";
					for ($i = 0; $i < count($array); $i++) {
						$text = $array[$i][0];
						$field = $array[$i][1];
						$type = $array[$i][2];
						$return = CrudContent::typearray($page, $array, $i);
						$type = $return['type'];
						$visible = $return['visible'];

						if ($type == 'hidden_input') {
							$visible = false;
						}
						$page['type_form_asal'] = $return['type_form_asal'];
						if ($visible) {
							$content .= '<th>' . $text . '</th>';
						}

						if (isset($page['crud']['all_change_sub_kategori'][$page['crud']['database_utama']])) {
							if (in_array($field, $page['crud']['all_change_sub_kategori'][$page['crud']['database_utama']]['array'])) {
								$content_all_change .= '<th>';
								$array[$i][1] .= "__all_change";

								$page['crud']['input_group']['suffix'][$array[$i][1]] = 'Terapkan';
								$page['crud']['input_group']['suffix_type'][$array[$i][1]] = '<button class="btn btn-outline-primary " type="button" id="button-addon2" style="padding: 0 5px;font-size: 11px;" onclick="terapkan_semua_' . $field . '(' . $i . ',\'' . $field . '\')"> <TEXT></TEXT> </button>';
								$content_all_change .= CrudContent::form($page, $fai, $array, $i, $no);
								$content_all_change .= '</th>';
							} else {
								$content_all_change .= '<th></th>';
							}
						}
					}
					// if (!in_array($page['crud']['view'], array('view')) and  !isset($page['crud']['no_action'][$page['crud']['sub_kategori'][$h][1]]) and !(isset($page['crud']['PDFPage'])))
					if (in_array($page['crud']['view'], array('edit', 'tambah')))
						$content .= '<th>Aksi</th>';
					$content .= '
        											
        											</tr>
        										</thead>
        										<tbody id="tablecontentsubkategori-tbody-' . $h . '">' .
						($content_all_change ? "<tr><td>" . $content_all_change . "<td></tr>" : "");
				} else {
					$content .= '<div id="tablecontentsubkategori-tbody-' . $h . '">';
					unset($page['crud']['startdiv']);
					unset($page['crud']['enddiv']);
				}
				if (isset($page['crud']['no_row_sub_kategori'][$database_sub]) and   (in_array($page['crud']['view'], array('tambah')))) {
					if ($page['section'] == 'viewsource') $content .= '<?php $no=1;?>;';
				} else {
					$page['crud']['database_utama'] = strtolower($page['crud']['sub_kategori'][$h][1]);
					$funct = "sub_kategori_" . strtolower($page['crud']['sub_kategori'][$h][3]);
					$content .= CrudContent::$funct($page, $fai, $h, $no, $suffix);
				}

				if ($page['crud']['sub_kategori'][$h][3] == 'table') {

					$content .= '
        										 	
        										 </tbody></table></div>';
				} else {
					if (in_array($page['crud']['view'], array('edit', 'tambah'))) {

						$content .= '<div id="addcontentsubkategori-' . $h . '"></div>
        						<div class="pt-3 pb-3"></div>
								</div>';
					}
				}
				if ((!in_array($page['crud']['view'], array('view'))) and !isset($page['crud']['no_add_sub_kategori'][$page['crud']['sub_kategori'][$h][1]]) and !isset($page['crud']['no_action'][$page['crud']['sub_kategori'][$h][1]]) and !(isset($page['crud']['PDFPage']))) {
					$content .= '<div style="display: flex;margin:20px">';
					$content .= '<input type="number" placeholder="Jumlah Tambah" class="form-control w-10" style="width:100px"  id="tambah_sub_kategori-' . $h . '">
								<button type="button" onclick="sub_kategori_add' . ($page['section'] == 'viewsource' ? '_' . $page['crud']['sub_kategori'][$h][1] : '') . '(' . $h . ',' . "'" . ((($page['section'] == 'viewsource' and isset($page['crud']['qoute_viewsource_none'])) ? '."' . "'" . '"."' : '')) . $page['crud']['sub_kategori'][$h][3] . ((($page['section'] == 'viewsource' and isset($page['crud']['qoute_viewsource_none'])) ? '"."' . "'" . '".' : '')) . "'" . ')" class="btn btn-primary btn-sm">
        					Tambah 
        														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
        													</button>';
					$content .= '	</div>';
				}
			}
			$content .=  isset($page['crud']['crud_after_sub_kategori']) ? $page['crud']['crud_after_sub_kategori'] : '';
			$content .= '</div>';
			$content .= '</div>';
		}
		return $content;
	}
	public static function sub_kategori_content_array($page, $fai, $array, $h, $no, $data)
	{

		$content = "";

		if (isset($data->primary_key))
			$content .= '
		<input type="hidden" name="' . $page['crud']['sub_kategori'][$h][1] . '_primary_key_edit[]' . '" value="' . $data->primary_key . '">';
		for ($i = 0; $i < count($array); $i++) {
			$page['page_row'] = 'sub_kategori';
			if (in_array($page['crud']['view'], array('view')))
				$page['crud']['input_inline'] = 'disabled';
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			$return = CrudContent::typearray($page, $array, $i);
			$type = $return['type'];
			$numbering = $page['crud']['numbering'] = $no;
			$visible = $return['visible'];
			$page['crud']['type_form_asal'] = $return['type_form_asal'];

			if ($visible) {
				$extypearray = explode('-', $array[$i][2]);
				if ($type == 'hidden_input') {
				} else 
                if ((in_array('number', $extypearray)) and  (isset($page['PDFPage']))) {
					$content .= '
					<td style="padding: 15px 10px;min-width: 250px;text-align:right">';
				} else {
					$content .= '
					<td style="padding: 15px 10px;min-width: 250px;">';
				}
				if ($type == 'modalform-subkategori-add') {
					$temp = $page['crud']['view_sub_kategori'];

					$page['crud']['view_sub_kategori'] = isset($array[$i][3]['view_form']) ? $array[$i][3]['view_form'] : 'table';
					$page_temp_sub_kategori = $page;
					$page['crud']['database_utama'] = $array[$i][3]['database'];
					if (isset($page['crud']['costum_class'][$field])) {
						$page['crud']['costum_class'][$field] .= $page['crud']['database_utama'] . "__$field" . "_$numbering";
					} else {
						$page['crud']['costum_class'][$field] = $page['crud']['database_utama'] . "__$field" . "_$numbering";
					}

					if (isset($page['load']['form']['type'])) {

						$formType = $page['load']['form']['type'];
					} else  if (isset($page['crud']['form_type'])) {

						$formType = $page['crud']['form_type'];
					} else {
						$formType = 1;
					}

					if ($formType == 1) {

						$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group row mb-1" ><label class="control-label col-3 " style="font-weight:600">' . $text . '</label><div class="col-9">';
						$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
					} elseif ($formType == 2) {

						$startdiv = isset($page['crud']['startdiv']) ? $page['crud']['startdiv'] : '<div class="form-group  mb-1" ><label class="control-label  " style="font-weight:600">' . $text . '</label><div class="">';
						$enddiv = isset($page['crud']['enddiv']) ? $page['crud']['enddiv'] : '<input type="hidden" id="supporting_' . $field . $numbering . '"></span><span class="help-block text-danger" id="help_' . $field . $numbering . '"></span></div></div>';
					}

					$content .= $startdiv .
						CrudContent::sub_kategori_modalform($page, $fai, $field, $i, $h, $array, $no, $array[$i][3]['array'], $data, $array[$i][3])
						. $enddiv;

					$page = $page_temp_sub_kategori;

					$page['crud']['view_sub_kategori'] = $temp;
				} else {

					$content .= CrudContent::form($page, $fai, $array, $i, $no, $data);
				}

				if ($type == 'hidden_input') {
				} else
					$content .= '</td>';
			}
		}
		return $content;
	}
	public static function sub_kategori_form($page, $fai, $h, $no, $suffix)
	{
		$content = "";
		if (($page['crud']['row_sub_kategori'][$h]['num_rows'])) {

			foreach ($page['crud']['row_sub_kategori'][$h]['row'] as $data) {


				if ($page['section'] == 'viewsource') {
					if ($page['crud']['view'] != 'ajax') {
						$content .= '
                    <?php 
                    $no=0;';

						if ($page['crud']['view'] != 'tambah') {
							$content .=  '
                        foreach($' . $page['crud']['sub_kategori'][$h][1] . ' as $' . $fai->nama_function($page, $page['title']) . '){
                        $no++;';
						}



						$no = '<?=$no;?>';
						$content .= '?>';
					} else {
						$noo = '$no';
						$no = "'.$noo.'";
					}
				} else
					$no++;


				$content .= '
				
				<div class="contentsubkategori-' . $h . '-' . $no . '">

            <div class="divider">
                <div class="divider-text">Data - ' . $no . '
                </div>
            </div>
            <input class="no-' . $h . '" type="hidden" value="' . $no . '">
            <input class="contentinput-' . $h . '" type="hidden">
            <input name="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '[]" value="' . $no . '" type="hidden" />';

				$array = Database::converting_array_field($page, $page['crud']['array_sub_kategori'][$h]);

				$content .= CrudContent::sub_kategori_content_array($page, $fai, $array, $h, $no, $data);

				$js = "";
				if (isset($page['crud']["tree_sub_kategori"][$page['crud']['sub_kategori'][$h][1]])) {
					$content .=   '<div id="tree_sub_kategori-content-' . $h . '"></div>';
					$js .= 'tree_sub_kategori(' . $h . ');';
				}
				$content .= '
            <input class="contentinput-' . $h . '" type="hidden">
            <input name="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '[]" value="' . $no . '" type="hidden" />';

				$content .= '</tr>';

				if ($page['crud']['view'] != 'ajax' and $page['crud']['view'] != 'tambah') {
					$content .=  $page['section'] == 'viewsource' ? '<?php } ?>' : '';
				}

				$content .= '</div>';
			}
			if (isset($page['crud']["tree_sub_kategori"])) {
				$content .= ' <script>
            ' . $js . '
        </script>';
			}
		}
		return $content;
	}
	public static function sub_kategori_modalform($page, $fai, $field, $ii, $h, $array_sub_kategori, $no, $array, $data, $modalform = array(), $nomor = 0, $return_content = 'all')
	{

		$field_utama = $field;
		if (!isset($modalform['view_modalform']))
			$modalform['view_modalform'] = 'modal';
		$content = "";
		if ($page['crud']['type'] != 'PDFPage') {
			if ($modalform['view_modalform'] == 'modal') {

				$content .= '<button type="button" class="btn btn-primary" onclick="open_modal_modalform_subkategori_add' . $field_utama . '_' . $no . '(this);">...</button>
			
			<script>
			function open_modal_modalform_subkategori_add' . $field_utama . '_' . $no . '(){
				';
				if (isset($modalform['connect'])) {
					for ($cc = 0; $cc < count($modalform['connect']); $cc++) {


						$content .= '
									$(".' . $modalform['connect'][$cc]['modalform_sub_kategori_row'] . '_' . $no . '").val($("#' . $modalform['connect'][$cc]['table_sub_kategori_row'] . '' . $no . '").val());
											';
					}
				}
				$content .= '
                			$("#modal_modalform_subkategori_add' . $field_utama . '_' . $no . '").modal("show");
							
                		}function close_modal_modalform_subkategori_add' . $field_utama . '_' . $no . '(){
							
							close_check=true;
							keterangan = "";
							';
				if (isset($modalform['check_close'])) {
					for ($cc = 0; $cc < count($modalform['check_close']); $cc++) {
						if ($modalform['check_close'][$cc]['type_check'] == '2val') {
							$content .= '
						if(close_check){
										var sum' . $modalform['check_close'][$cc]['val_1'] . '_' . $no . ' = 0;
										$(".' . $modalform['check_close'][$cc]['val_1'] . '_' . $no . '").each(function(){
											sum' . $modalform['check_close'][$cc]['val_1'] . '_' . $no . ' += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
										});

										var sum' . $modalform['check_close'][$cc]['val_2'] . '_' . $no . ' = 0;
										$(".' . $modalform['check_close'][$cc]['val_2'] . '_' . $no . '").each(function(){
											sum' . $modalform['check_close'][$cc]['val_2'] . '_' . $no . ' += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
										});

										close_check = sum' . $modalform['check_close'][$cc]['val_1'] . '_' . $no . '== sum' . $modalform['check_close'][$cc]['val_2'] . '_' . $no . ';
							if(!close_check)
							keterangan = "' . $modalform['check_close'][$cc]['notif'] . '";
										}';
						}
					}
				}

				$content .= '
				if(!close_check){
										alert(keterangan);
						}else
								$("#modal_modalform_subkategori_add' . $field . '_' . $no . '").modal("hide");
							}
						</script> 
					<div class="modal fade " data-keyboard="false" data-bs-keyboard="false" data-bs-backdrop="static" data-backdrop="static" id="modal_modalform_subkategori_add' . $field . '_' . $no . '" tabindex="-1" role="dialog" aria-labelledby="modal_modalform_subkategori_add' . $field . '_' . $no . 'Label" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal Sub Kategori</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal_modalform_subkategori_add' . $field . '_' . $no . '()">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						
				';
			}
			$page['crud']['prefix_name'] = $page['crud']['sub_kategori'][$h][1] . '_';
			$page['crud']['sufix_name'] = '_modalform[' . $no . '][]';
			$page['crud']['view_sub_kategori'] = isset($modalform['view_form']) ? $modalform['view_form'] : 'table';;
			if ($page['crud']['view_sub_kategori'] == 'table') {
				$content .= '<div style="overflow-x: scroll;max-width: 100%;">
				<table border="1" style="border-collapse: collapse;width:100%" class="table table-striped pb-5" id="tablecontentmodalformsubkategori-' . $h . '-' . $no . '">
							<thead >
							<tr>

						';
				$content .=  '<th>No</th>';
			}

			for ($i = 0; $i < count($array); $i++) {
				$text = $array[$i][0];
				$field = $array[$i][1];
				$type = $array[$i][2];
				$return = CrudContent::typearray($page, $array, $i);
				$type = $return['type'];
				$visible = $return['visible'];
				if ($type == 'hidden_input') {
					$visible = false;
				}
				$page['type_form_asal'] = $return['type_form_asal'];
				if ($visible and $page['crud']['view_sub_kategori'] == 'table') {
					$content .=  '<th>' . $text . '</th>';
				}
				$page['crud']['costum_class'][$field] = $field . "_$no";
			}

			if ($page['crud']['view_sub_kategori'] == 'table') {

				$content .=  '</tr></thead>
				<tbody id="tablecontentmodalformsubkategori-tbody-' . $h . '-' . $no . '">
					
						
				';
			}


			if (isset($modalform['connect'])) {
				for ($mf = 0; $mf < count($modalform['connect']); $mf++) {

					$get_row_datas = $modalform['connect'][$mf]['table_sub_kategori_row'];
					if (isset($data->$get_row_datas))
						$page['crud']['insert_value'][$modalform['connect'][$mf]['modalform_sub_kategori_row']] = $data->$get_row_datas;
				}
			}
			$page['crud']['database_utama'] = $modalform['database'];

			$suffix = "";
			$page['crud']['database_utama'] = $modalform['database'];
			if (!in_array($page['crud']['view'], array('edit', 'view', 'ajax_sub_kategori'))) {
				$row = (object) ['object' => 'foreach_1_row'];

				$page['crud']['row_sub_kategori'][$h]['row'] = $row;
				$page['crud']['row_sub_kategori'][$h]['num_rows'] = 1;
			} else {
				$modalform_database['utama'] = $modalform['database'];
				if (isset($data->primary_key))
					$modalform_database['where'][] = array($modalform['database'] . "." . Database::converting_primary_key($page, $page['crud']['sub_kategori'][$h][1], 'primary_key'), '=', $data->primary_key);

				$row = Database::database_coverter($page, $modalform_database, $modalform['array'], 'all');

				$page['crud']['row_sub_kategori'][$h] = $row;
				$suffix = "_edit";
			}
			$page['crud']['array_sub_kategori'][$h] = $modalform['array'];
			if ($page['crud']['view_sub_kategori'] == 'table')
				$content .= CrudContent::sub_kategori_table($page, $fai, $h, $nomor, $data, $suffix);
			else
				$content .= CrudContent::sub_kategori_form($page, $fai, $h, $nomor, $data, $suffix);

			if ($page['crud']['view_sub_kategori'] == 'table')
				$content .= '</tbody></table></div>';
			if (isset($array_sub_kategori[$ii][3]['sub_kategori']) and $modalform['type'] != 'many') {
				$page['crud']['super_sufix_name'] = '_modalform[' . $no . '][]';
				$page['crud']['sub_kategori'] = $array_sub_kategori[$ii][3]['sub_kategori'];
				$page['crud']['array_sub_kategori'] = $array_sub_kategori[$ii][3]['array_sub_kategori'];
				$content .= CrudContent::sub_kategori($page, $fai);
			}

			if ($modalform['type'] == 'many') {

				$content .= '
				<button type="button" onclick="modalform_sub_kategori_add(' . $h . ',' . $no . ',' . $ii . ',' . "'" . $page['crud']['sub_kategori'][$h][1] . "'" . ',' . "'" . $page['crud']['view_sub_kategori'] . "'" . ' )" class="btn btn-primary btn-sm">
				Tambah 
				<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
				</button>
				</div>
				';
			}
			if ($modalform['view_modalform'] == 'modal') {

				$content .= '
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary"  onclick="close_modal_modalform_subkategori_add' . $field_utama . '_' . $no . '()">Close</button>
				<button type="button" class="btn btn-primary" onclick="close_modal_modalform_subkategori_add' . $field_utama . '_' . $no . '()">Save changes</button>
				</div>
                </div>
				</div>
				</div>
				</div>';
			}
		}
		return $content;
	}
	public static function sub_kategori_search_load($page, $fai, $sub_kategori, $h)
	{
		$content = "";
		if ($page['crud']['type'] != 'PDFPage') {
			$content .=  '<div class="row">';
			$content .=  '<div class="' . (isset($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['input_row']) ? $page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['input_row'] : 'col-md-2 col-sm-7 col-xl-12') . '">';
			$content .=  '<input type="text" placeholder="' . ($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['input']) . '" class="form-control"
				id="input_' . $sub_kategori[1] . '"
				>';
			$content .=  '</div>';
			$content .=  '<div class="col-3">';
			$content .=  '<button type="button" class="btn btn-primary mr-2 ms-2 me-2" onclick="load_search_load_sub_kategori_' . $sub_kategori[1] . '()">&nbsp<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
				<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
				<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
			</svg></button>';
			$content .=  '<button type="button" class="btn btn-primary mr-2 ms-2 me-2" onclick="open_detail_search_load_sub_kategori_' . $sub_kategori[1] . '()">...</button>';

			$content .=  '</div>';
			$content .=  '</div>';
			$content .=  '
				<div class="modal fade" id="modal_detail_search_load_sub_kategori_' . $sub_kategori[1] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class=" close"  onclick="close_search_load_sub_kategori_' . $sub_kategori[1] . '()">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="table_detail_search_load_sub_kategori_' . $sub_kategori[1] . '" class="table table-bordered table-sm w-100">
						<thead class="table-success" style="font-size: smaller">
						<tr>
							<th>No</th>
			';
			foreach (($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['array_detail']) as $key => $value) {
				$content .=  '<th>';
				$content .=  $value;
				$content .=  '</th>';
			}
			$content .=  '
						<th>Action</th>
					</tr>
					</thead>
					<tbody style="font-size: smaller" id="detailBaJaDetail">
						
					</tbody>
				</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" onclick="close_search_load_sub_kategori_' . $sub_kategori[1] . '()">Selesai</button>
				</div>
				</div>
			</div>
			</div>
			<script>
			
			function load_search_load_sub_kategori_' . $sub_kategori[1] . '(){
				var primary_key = $("#input_' . $sub_kategori[1] . '").val();
				search_load_sub_kategori_' . $sub_kategori[1] . '(primary_key,"search");
			}
			function pilih_search_load_sub_kategori_' . $sub_kategori[1] . '(primary_key){
				search_load_sub_kategori_' . $sub_kategori[1] . '(primary_key,"pilih");
			}
			function close_search_load_sub_kategori_' . $sub_kategori[1] . '(primary_key){
				$("#modal_detail_search_load_sub_kategori_' . $sub_kategori[1] . '").modal("hide");
			}
			
			function search_load_sub_kategori_' . $sub_kategori[1] . '(primary_key,method){
				' . "
				
				var output = 0;
								$('.no-0').each(
									function() {
										if (parseInt($(this).val()) > output) {
											output = parseInt($(this).val());
										}
									}
								);
				output++;
				if (!$('#checbox_search_load_sub_kategori_" . $sub_kategori[1] . "' + primary_key).is(':checked')) {
								
								nomor_tr = ($('#no-search_load_" . $sub_kategori[1] . "-' + primary_key).val());
								$('#table-subkateogri-tr-" . $h . "-' + nomor_tr).remove();
								} else {
				$.ajax({
					type: 'get',
					url : " . ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['search_load_' . $sub_kategori[1], -1])) . "'") : "$('#load_link_route').val()") . ",
					data: {
						_token: '',
						'id':'" . $sub_kategori[1] . "',
						'apps':$('#load_apps').val(),
						'page_view':$('#load_page_view').val(),
						'type':'search_load',
						'primary_key':primary_key,
						'sub_kategori_id':'$h',
						'contentfaiframework':'get_pages',
						'no':output,
						'method':method
					  
					},
					dataType: 'html',
	                success: function(data) {
						//$('#modal_detail_search_load_sub_kategori_" . $sub_kategori[1] . "').modal('hide');
	                	$('#tablecontentsubkategori-tbody-$h').append(data);
						
						";
			if (isset($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['call_function'])) {

				for ($cfa = 0; $cfa < count($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['call_function']); $cfa++) {
					$content .=  $page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['call_function'][$cfa] . ";";
				}
			}

			$content .= 	 ";
						 no=output+1;
	                },
	                error: function(error) {
					}
				});
				" . '
				}
			}
			function open_detail_search_load_sub_kategori_' . $sub_kategori[1] . '(){
				' . "
				$('#modal_detail_search_load_sub_kategori_" . $sub_kategori[1] . "').modal('show');
					var table =  $('#table_detail_search_load_sub_kategori_$sub_kategori[1]').DataTable({
								   'processing': true,
								   'serverSide': true,
								   'serverMethod': 'get',
								   'bDestroy': true,
								   
								   'ajax': {
									   'url':" . ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['datatable_' . $sub_kategori[1], -1])) . "'") : "$('#load_link_route').val()") . ",
									   'data': {
										   _token: '',
										   'id':'" . $sub_kategori[1] . "',
										   'apps':$('#load_apps').val(),
										   'page_view':$('#load_page_view').val(),
										   'type':'datatable',
										   'contentfaiframework':'get_pages',
										   'sub_kategori_id':'$h',
										 	'checked': function() {
												var sum = '';
												$('." . (isset($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['checked_row']) ? $page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['checked_row'] : key($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['array_result'])) . "').each(function() {
													sum += ($(this).val()) + ','; // Or this.innerHTML, this.innerText
												});
												sum += '-1';
												return sum;
											},
									   },
									   
								   },
								   'columns': [
									   { data: 'no' },
									   ";
			foreach (($page['crud']['search_load_sub_kategori'][$sub_kategori[1]]['array_detail']) as $key => $value) {
				$content .=  " { data: '$key' },";
			}

			$content .=  "  { data: 'aksi' },
								   ]
								   }); 
								   
						   " . '
			}
			</script>';
		}
		return $content;
	}
	public static function sub_kategori_table($page, $fai, $h, $no, $suffix)
	{
		$content = "";
		$page['crud']['view_sub_kategori'] = "table";
		$temp = $page['title'];
		$page['title'] = $page['title'] . '_detail';

		if (($page['crud']['row_sub_kategori'][$h]['num_rows'])) {
			foreach ($page['crud']['row_sub_kategori'][$h]['row'] as $data) {

				if ($page['section'] == 'viewsource') {
					if ($page['crud']['view'] != 'ajax') {
						$content .=  '
                                <?php 
                                $no=0;';

						if ($page['crud']['view'] != 'tambah') {
							$content .=  '
                    foreach($' . $page['crud']['sub_kategori'][$h][1] . ' as $' . $fai->nama_function($page, $page['title']) . '){
                    $no++;';
						}



						$no = '<?=$no;?>';
						$content .=  '?>';
					} else {
						$noo = '$no';
						$no = "'.$noo.'";
					}
				} else
					$no++;

				$content .=  '<tr id="table-subkateogri-tr-' . $h . '-' . $no . '">
                <td >' . $no . '
                    <input class="no-' . $h . '" name="no_sub_kategori[]" type="hidden" value="' . $no . '">  
                </td>
               ';
				$page['crud']['numbering'] = $no;
				$array = $page['crud']['array_sub_kategori'][$h];

				$content .= CrudContent::sub_kategori_content_array($page, $fai, $array, $h, $no, $data);

				$content .=  '
				<td style="display:none"><input class="contentinput-' . $h . '" type="hidden">
                <input class="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '" name="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '[]" value="' . $no . '" type="hidden" />
				</td>
                ';
				if (($page['section'] != 'viewsource') and in_array($page['crud']['view'], array('edit', 'tambah'))) {


					$content .=  '<td><button type="button" onclick="deleteRow' . $suffix . '(' . '' . $h . ',' . $no . ',' . (isset($data->primary_key)?$data->primary_key:'') . ',' . "'" . ((($page['section'] == 'viewsource' and isset($page['crud']['qoute_viewsource_none'])) ? '."' . "'" . '"."' : '')) . $page['crud']['sub_kategori'][$h][3] . ((($page['section'] == 'viewsource' and isset($page['crud']['qoute_viewsource_none'])) ? '"."' . "'" . '".' : '')) . "'" . ')" class="btn btn-primary btn-sm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                                                    </button></td>';
					$content .=  $page['section'] == 'viewsource' ? '<?php } ?>' : '';
				}
				// ($suffix=='_edit'?$data->primary_key.',':'')
				$content .=  '</tr>';


				$temp = $page['title'];
			}
		}
		return $content;
	}
	public static function table($page, $fai, $database_utama = null, $return_result = null)
	{

		$content = "";
		$content_datatable = array();
		$draw = Partial::input('draw');
		if (!$database_utama)
			$database_utama = isset($page['database']['alias']) ? $page['database']['alias'] : $page['database']['utama'];
		$content .= isset($page['load']['crud_template']['table_prefix']) ? $page['load']['crud_template']['table_prefix'] : '';
		$content .= '<table class="' . (isset($page['load']['crud_template']['class']['table']) ? $page['load']['crud_template']['class']['table'] : 'table table-bordered table-striped w-100') . ' w-100 " id="' . ((isset($page['crud']['row']['num_rows']) and !isset($page['load']['crud_template']['table']['first_datatable'])) ? ($page['crud']['row']['num_rows'] <= 100 ? 'example1' : 'example2') : 'example2') . '" style="' . (isset($page['load']['crud_template']['style']['table']) ? $page['load']['crud_template']['style']['table'] : '') . ' ;width: 100%; oveflow:auto">';;
		$content .= '<thead class="' . (isset($page['load']['crud_template']['class']['thead']) ? $page['load']['crud_template']['class']['thead'] : '') . '">';
		$content .= '<tr>';
		$content .=     '<th>No</th>';
		$array = $page['crud']['array'];
		if ($page['section'] != 'viewsource')
			$key1 = $fai->database_coverter($page, $page['database'], $array, 'all');
		else {
			$key1 = $fai->database_coverter($page, $page['database'], $array, 'source');
		}
		if (isset($page['crud']['table_group'])) {
			foreach ($page['crud']['table_group'] as $key => $value) {
				$content .= '<th>' . $key . '</th>';
			}
			for ($i = 0; $i < count($array); $i++) {
				$table_group[$array[$i][1]] = $i;
			}
		} else {
			for ($i = 0; $i < count($array); $i++) {
				$text = $array[$i][0];
				$field = $array[$i][1];
				$type = $array[$i][2];

				$return = CrudContent::typearray($page, $array, $i);
				$type = $return['type'];
				$visible = $return['visible'];
				if ($visible) {

					$content .= '<th>' . $text . '</th>';
				}
			}
		}
		if (!isset($page['load_section'])) {
			$page['load_section'] = $page['section'];
		}
		if ($page['load_section'] != 'viewsource') {
			if ($page['crud']['is_approval']) {
				$content .= '<th>Approval Report</th>';
				$content .= '<th>Approval Status</th>';
			}
		}
		if (isset($page['load']['crud_template']['table']['view']['is_colom'])) {
			$content .= '<th>' . $page['load']['crud_template']['table']['view']['nama_colum'] . '</th>';
		}
		if (isset($page['load']['crud_template']['table']['edit']['is_colom'])) {
			$content .= '<th>' . $page['load']['crud_template']['table']['edit']['nama_colum'] . '</th>';
		}
		if (isset($page['load']['crud_template']['table']['hapus']['is_colom'])) {
			$content .= '<th>' . $page['load']['crud_template']['table']['hapus']['nama_colum'] . '</th>';
		}
		if (!($fai->input('Cari') == "pdf")) {
			$content .= '<th>Action</th>';
		}
		$content .= '	</tr>';
		$content .= '</thead>';
		$content .= '<tbody>';
		$no = 0;

		if ($page['section'] == 'viewsource')
			$content .= CrudContent::table_viewsource($page, $fai, $database_utama);
		else {
			if ($page['get_panel']['get_user']->is_admin)
				$content .= $page['crud']['row']['query'];
			if (($page['crud']['row']['num_rows'])) {
				if (($page['crud']['row']['num_rows']) <= 100) {
					foreach ($page['crud']['row']['row'] as $data) {
						$nestedData = [];
						$row_edit_hapus = true;
						$no++;
						$content .= '					<tr>';
						$content .= '						<td>' . $no . '</td>';

						$nestedData['no'] = $no;

						$primary_key = $page['database']['primary_key'];
						if (isset($page['crud']['table_group'])) {
							foreach ($page['crud']['table_group'] as $key => $value) {

								$content_table_group = "";
								$content .= '<td>';
								$content_table_group .= '<ul style="list-style: none;   font-size: smaller;padding-left:0">';
								for ($tg = 0; $tg < count($page['crud']['table_group'][$key]); $tg++) {
									$field =  $page['crud']['table_group'][$key][$tg];

									if (isset($table_group[$field])) {
										// $page['crud']['table_group']['i'][$page['crud']['table_group'][$key][$tg]];
										$content_table_group .= '<li>';
										$i = $table_group[$field];
										if (!isset($page['crud']['setting_table_group']["non_prefix_all"]))
											$content_table_group .= '<strong>' . $array[$i][0] . '</b></strong> : ';
										$content_table_group .= CrudContent::table_content($page, $fai, $array, $i, $data, $no, $database_utama);
										$content_table_group .= '</li>';
									}
								}
								$content_table_group .= '</ul>';
								$nestedData[str_replace(' ', '', $key)] = $content_table_group;
								$content .= $content_table_group . '</td>';
							}
						} else {
							for ($i = 0; $i < count($array); $i++) {
								$return = CrudContent::typearray($page, $array, $i);
								$type = $return['type'];
								$visible = $return['visible'];
								if ($visible) {
									$field = $array[$i][1];
									if (!in_array($array[$i][2], array("select-appr", "select-nosave")))
										$page['value_field'][$field] =  $data->$field;
									else if ($array[$i][2] == "select-appr") {

										$field_database = $array[$i][3];
										$field = 'system_status_appr';
										if ($data->$field)
											$view_data = $field_database[$data->$field];

										if ($data->$field != 3)
											$row_edit_hapus = false;
									}
									$style = '';
									$extypearray = explode('-', $array[$i][2]);
									if (in_array('number', $extypearray)) {
										$style = "style='text-align:right';";
									}
									$content .= '<td id="' . $field . $no . '" ' . $style . ' >';
									$table_content = CrudContent::table_content($page, $fai, $array, $i, $data, $no, $database_utama);;
									$content .= $table_content;
									$nestedData[$field] = $table_content;

									$content .= '</td>';
								}
							}
						}
						$content_aksi = "";
						if ($page['load_section'] != 'viewsource') {
							if ($page['crud']['is_approval'] and isset($page['crud']['array_approval'])) {
								$content .= '	<td style="min-width:100px">';
								foreach ($page['crud']['array_approval']['approval'] as $key => $value) {
									if (isset($page['crud']['array_approval']['approval_flow'][$data->primary_key]['proses'][$page['crud']['array_approval']['id_approval'][$key]]['row'])) {
										$content .= '<b>T.' . $key . ' : ' . $value[0] . ' ' . $value[1] . '</b><br>';
										$status = $page['crud']['array_approval']['approval_flow'][$data->primary_key]['proses'][$page['crud']['array_approval']['id_approval'][$key]]['row']->status_approval;
										if ($status == 4) {
											$proses_status = 'Proses Pertimbangan';
										} else if ($status == 3) {
											$proses_status = 'Pending';
										} else if ($status == 2) {
											$proses_status = 'Tolak';
										} else if ($status == 1) {
											$proses_status = 'Setuju';
										}
										$content .= 'Status : ' . $proses_status . '<br>';;
									}
								}
								$content .= '</td>';
								$content .= '	<td>';

								if ($page['crud']['array_approval']['approval_flow'][$data->primary_key]['row']->is_selesai) {
									$status = $page['crud']['array_approval']['approval_flow'][$data->primary_key]['row']->status_approval;
									if ($status == 4) {
										$proses_status = 'Proses Pertimbangan';
									} else if ($status == 3) {
										$proses_status = 'Pending';
									} else if ($status == 2) {
										$proses_status = 'Ditolak';
									} else if ($status == 1) {
										$proses_status = 'Disetujui';
									}
									$content .= 'Selesai : Status ' . $proses_status;

									//
								} else {
									$content .= 'Menunggu Approval ' . $page['crud']['array_approval']['approval_flow'][$data->primary_key]['now_proses']->nama_approval . ' ' . $page['crud']['array_approval']['approval_flow'][$data->primary_key]['now_proses']->nama_role_group;
								}
								$content .= '</td>';
								$delete_visible = false;
								$page['crud']['no_delete'] = true;
								$page['crud']['no_edit'] = true;

								if (!$page['crud']['array_approval']['approval_flow'][$data->primary_key]['row']->is_selesai) {
									if ($page['crud']['array_approval']['approval_flow'][$data->primary_key]['now_proses']->id_group_approval == $page['crud']['row_akses_role']->id_role_group) {
										$content_aksi .= '	<a title="Edit" href=' . "'" . ($fai->route_v($page, $page['route'], ['edit_approval', $data->primary_key])) . "'" . ' style="margin-right:10px" class="' . (isset($page['load']['crud_template']['class']['edit_approval']) ? $page['load']['crud_template']['class']['edit_approval'] : 'btn btn-primary btn-sm') . '">
                												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                													<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
                												</svg>
                												' . (isset($page['load']['crud_template']['text']['edit_approval']) ? $page['load']['crud_template']['text']['edit_approval'] : 'Edit Approval') . '
                											</a>';
									}
								}
							}
						}
						$edit_visible = true;
						if (!($fai->input('Cari') == "pdf" or $page['type'] == 'pdf')) {
							$is_edit = false;
							if (isset($page['load']['crud_template']['table']['edit']['is_colom'])) {
								$is_edit = true;
								$content .= '	<td>';;
								$content .= '	<a title="Edit" href=' . "'" . ($fai->route_v($page, $page['route'], ['edit', $data->primary_key])) . "'" . ' class="' . (isset($page['load']['crud_template']['class']['edit']) ? $page['load']['crud_template']['class']['edit'] : 'btn btn-primary btn-sm') . '">
                												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                													<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
                												</svg>
                												' . (isset($page['load']['crud_template']['text']['edit']) ? $page['load']['crud_template']['text']['edit'] : '') . '
                											</a>';
								$content .= '	</td>';
							}
							$content .= '	<td>';
							$content .= '	<div class="d-flex"><KONTENT-AKSI>';
							$content_aksi .= '	<a title="privilage" href="javascript:void(0)" onclick="info_modal(' . $data->primary_key . ')" class="btn btn-primary btn-sm m-2">
														<svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
													</a>';


							if (isset($page['crud']['button_list']['text'][0])) {
								for ($i = 0; $i < count($page['crud']['button_list']['text']); $i++) {
									if ($page['crud']['button_list']['link_type'][$i] == 'route') {
										$param = explode('|', $page['crud']['button_list']['link_param'][0]);
										for ($j = 0; $j < count($param); $j++) {
											$param_in = $param[$j];
											if (strpos($param_in, '???')) {

												$temp = $param_in;
												$sub_string_awal = substr($param_in, (strpos($param_in, '???') + 3), (strpos($param_in, '!!!') - (strpos($param_in, '???') + 3)));
												$ex_string = explode(':', $sub_string_awal);
												if ($ex_string[0] == 'var') {
													$to_string = $ex_string[1];
													$new_string = $$to_string;
												} else if ($ex_string[0] == 'row') {
													$to_string = $ex_string[1];
													$new_string = $data->$to_string;
												}

												$param_in = str_replace('???' . $sub_string_awal . '!!!', $new_string, $param_in);
											}
											$param[$j] = $param_in;
										}

										if (count($param) == 1) {
											$href = route($page['crud']['button_list']['link_route'][$i], $param[0]);
										} else if (count($param) == 2) {
											$href = route($page['crud']['button_list']['link_route'][$i], [$param[0], $param[1]]);
										} else if (count($param) == 3) {
											$href = route($page['crud']['button_list']['link_route'][$i], [$param[0], $param[1], $param[2]]);
										} else if (count($param) == 4) {
											$href = route($page['crud']['button_list']['link_route'][$i], [$param[0], $param[1], $param[2], $param[3]]);
										}
									}

									$content_aksi .= '
            											<a href="' . $href . '" class="btn btn-primary btn-sm" >
            											' . ($page['crud']['button_list']['text'][$i]) . '
            										</a>
            											';
								}
							}

							if (isset($page['crud']['button_list_if']['text'][0])) {
								for ($i = 0; $i < count($page['crud']['button_list_if']['text']); $i++) {

									'???row:status_po!!![=]1';

									$param_if = explode('[=]', $page['crud']['button_list_if']['param_if'][$i]);
									$if = $param_if[0];
									$value = $param_if[1];

									if (strpos($if, '???')) {
										$temp = $if;
										$sub_string_awal = substr($if, (strpos($if, '!!!') + 3), (strpos($if, '???') - (strpos($if, '!!!') + 3)));
										$ex_string = explode(':', $sub_string_awal);
										if ($ex_string[0] == 'var') {
											$to_string = $ex_string[1];
											$new_string = $$to_string;
										} else if ($ex_string[0] == 'row') {
											$to_string = $ex_string[1];
											$new_string = $data->$to_string;
										}

										$if = str_replace('!!!' . $sub_string_awal . '???', $new_string, $if);
									}
									$visible_if = false;
									if ($if == $value) {
										$visible_if = true;
									}

									if ($visible_if) {

										if ($page['crud']['button_list_if']['link_type'][$i] == 'route') {
											$param = explode('|', $page['crud']['button_list_if']['link_param'][0]);
											for ($j = 0; $j < count($param); $j++) {
												$param_in = $param[$j];

												if (strpos($param_in, '???')) {
													$temp = $param_in;
													$sub_string_awal = substr($param_in, (strpos($param_in, '!!!') + 3), (strpos($param_in, '???') - (strpos($param_in, '!!!') + 3)));
													$ex_string = explode(':', $sub_string_awal);

													if ($ex_string[0] == 'var') {
														$to_string = $ex_string[1];
														$new_string = $$to_string;
													} else if ($ex_string[0] == 'row') {
														$to_string = $ex_string[1];
														$new_string = $data->$to_string;
													}

													$param_in = str_replace('!!!' . $sub_string_awal . '???', $new_string, $param_in);
												}
												$param[$j] = $param_in;
											}
											if (count($param) == 1) {
												$href = $fai->route($page['crud']['button_list_if']['link_route'][$i], $param[0]);
											} else if (count($param) == 2) {
												$href = $fai->route($page['crud']['button_list_if']['link_route'][$i], [$param[0], $param[1]]);
											} else if (count($param) == 3) {
												$href = $fai->route($page['crud']['button_list_if']['link_route'][$i], [$param[0], $param[1], $param[2]]);
											} else if (count($param) == 4) {
												$href = $fai->route($page['crud']['button_list_if']['link_route'][$i], [$param[0], $param[1], $param[2], $param[3]]);
											}
										}

										$content_aksi .= '
            											<a href="' . $href . '" class="btn btn-primary btn-sm" >
            											' . ($page['crud']['button_list_if']['text'][$i]) . '
            										</a>
            											';
									}
								}
							}
							$delete_visible = true;
							if (isset($page['crud']['edit_if'])) {


								$if_row = $page['crud']['edit_if']['row_data'];

								if ($page['crud']['edit_if']['check'] == 'notrow??GA Tau Apa') {
								} else if ($page['crud']['edit_if']['check'] == 'row') {
									$row_get_edit = ($page['crud']['edit_if']['row_data']);
									$operan_get_edit = ($page['crud']['edit_if']['operan']);
									$value_get_edit = ($page['crud']['edit_if']['value']);
									'==' . $data->$row_get_edit;
									$result_edit = false;
									if (trim($operan_get_edit) == '=') {
										$result_edit = $data->$row_get_edit == $value_get_edit ? true : false;
									} else
									if (trim($operan_get_edit) == '!=') {
										$result_edit = $data->$row_get_edit != $value_get_edit ? true : false;
									} else
									if (trim($operan_get_edit) == '<') {
										$result_edit = $data->$row_get_edit < $value_get_edit ? true : false;
									} else
									if (trim($operan_get_edit) == '<=') {
										$result_edit = $data->$row_get_edit <= $value_get_edit ? true : false;
									} else
									if (trim($operan_get_edit) == '>') {
										$result_edit = $data->$row_get_edit > $value_get_edit ? true : false;
									} else
									if (trim($operan_get_edit) == '>=') {
										$result_edit = $data->$row_get_edit >= $value_get_edit ? true : false;
									}

									if ($result_edit) {
										$edit_visible = ($page['crud']['edit_if']['true']);
									} else {
										$edit_visible = ($page['crud']['edit_if']['false']);
									}
								} else if ($page['crud']['edit_if']['check'] == 'database') {
									$_db['select'] = array('count(*) as count	');
									$_db['utama'] =  $page['crud']['edit_if']['database'];
									$_db['where'] =  array(array($page['crud']['edit_if']['where_in_database'], '=', ($data->$if_row)));
									$db = $fai->database_coverter($page, $_db, null);

									if ($db[0]->count > 0)
										$edit_visible = false;
								}
							}


							if ($page['type'] == 'appr') {
								if ($row_edit_hapus) {
									$content_aksi .= '
            
            											<a href=' . "'" . ($fai->route_v($page, $page['route'], ['setujui_appr', $data->primary_key], 'reach_page_redirect', 'appr')) . "'" . ' class=" m-2 btn btn-primary btn-sm" title="Approve">
            												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;">
            													<path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm-7.933 13.481-3.774-3.774 1.414-1.414 2.226 2.226 4.299-5.159 1.537 1.28-5.702 6.841z"></path>
            												</svg>
            											</a>
            											<a href="' . ($fai->route_v($page, $page['route'], ['decline_appr', $data->primary_key], 'reach_page_redirect', 'appr')) . '" class=" m-2 btn btn-primary btn-sm" title="Decline"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;">
            													<path d="M17 5H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm-1 8H8v-2h8z"></path>
            												</svg></a><br>';
								}
								$content_aksi .= '
            										<a title="view" href="' .  ($fai->route_v($page, $page['route'], ['view_appr', $data->primary_key])) . '" class=" m-2 btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;">
            												<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
            												<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
            											</svg></a>';
							} else {
								$content_aksi .= '	<a title="View" href="' .  ($fai->route_v($page, $page['route'], ['view', $data->primary_key])) .  '" class=" m-2 ' . (isset($page['load']['crud_template']['class']['view']) ? $page['load']['crud_template']['class']['view'] : 'btn btn-primary btn-sm') . '">
                											<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                												<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
                												<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
                											</svg>
                											' . (isset($page['load']['crud_template']['text']['view']) ? $page['load']['crud_template']['text']['view'] : '') . '
                
                										</a>';
								if (!isset($page['crud']['no_edit']) and $row_edit_hapus and !$is_edit and $edit_visible) {
									$content_aksi .= '	<a title="Edit" href="' .  ($fai->route_v($page, $page['route'], ['edit', $data->primary_key])) . '" class=" m-2 ' . (isset($page['load']['crud_template']['class']['edit']) ? $page['load']['crud_template']['class']['edit'] : 'btn btn-primary btn-sm') . '">
                												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                													<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
                												</svg>
                												' . (isset($page['load']['crud_template']['text']['edit']) ? $page['load']['crud_template']['text']['edit'] : '') . '
                											</a>';
								}
								$delete_visible = true;

								if (isset($page['crud']['delete_if'])) {


									$if_row = $page['crud']['delete_if']['row_data'];

									if ($page['crud']['delete_if']['check'] == 'notrow??GA Tau Apa') {
									} else if ($page['crud']['delete_if']['check'] == 'row') {
										$row_get_delete = ($page['crud']['delete_if']['row_data']);
										$operan_get_delete = ($page['crud']['delete_if']['operan']);
										$value_get_delete = ($page['crud']['delete_if']['value']);
										'==' . $data->$row_get_delete;
										$result_delete = false;
										if (trim($operan_get_delete) == '=') {
											$result_delete = $data->$row_get_delete == $value_get_delete ? true : false;
										} else
										if (trim($operan_get_delete) == '!=') {
											$result_delete = $data->$row_get_delete != $value_get_delete ? true : false;
										} else
										if (trim($operan_get_delete) == '<') {
											$result_delete = $data->$row_get_delete < $value_get_delete ? true : false;
										} else
										if (trim($operan_get_delete) == '<=') {
											$result_delete = $data->$row_get_delete <= $value_get_delete ? true : false;
										} else
										if (trim($operan_get_delete) == '>') {
											$result_delete = $data->$row_get_delete > $value_get_delete ? true : false;
										} else
										if (trim($operan_get_delete) == '>=') {
											$result_delete = $data->$row_get_delete >= $value_get_delete ? true : false;
										}

										if ($result_delete) {
											$delete_visible = ($page['crud']['delete_if']['true']);
										} else {
											$delete_visible = ($page['crud']['delete_if']['false']);
										}
									} else if ($page['crud']['delete_if']['check'] == 'database') {
										$_db['select'] = array('count(*) as count	');
										$_db['utama'] =  $page['crud']['delete_if']['database'];
										$_db['where'] =  array(array($page['crud']['delete_if']['where_in_database'], '=', ($data->$if_row)));
										$db = $fai->database_coverter($page, $_db, null);
										if ($db[0]->count > 0)
											$delete_visible = false;
									}
								}

								$content_aksi .= '	<a title="privilage" href="javascript:void(0)" onclick="open_modal_privilage()" class="btn btn-primary btn-sm m-2">
														<svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
													</a>';
								if (!isset($page['crud']['no_delete']) and $row_edit_hapus and $delete_visible) {
									$content_aksi .= '	<a title="delete" href="javascript:void(0)" onclick="delete_from_privilage(' . $data->primary_key . ')" class="btn btn-primary btn-sm m-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
            													<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
            												</svg></a>';
								} else if (!$delete_visible) {
									// $content_aksi .= '	<a title="delete" href="javascript::void(0)" onclick="return alert(' . "'Tidak bisa menghapus data ini dikarenakan sudah terpakai pada transksi lain!'" . ');" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
									// 							<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
									// 						</svg></a>';
								}
							}
							$content .= '</div>';
							$content .= '</td>';
						}
						$nestedData['aksi'] = $content_aksi;
						$content = str_replace('<KONTENT-AKSI>', $content_aksi, $content);
						$content_datatable[] = $nestedData;
						$content .= '</tr>';
					}
				}
			}
		}
		$content .= '</tbody>';
		$content .= '</table>';
		$content .= isset($page['load']['crud_template']['table_sufix']) ? $page['load']['crud_template']['table_sufix'] : '';

		if (isset($page['crud']['row']['num_rows']) ? $page['crud']['row']['num_rows'] >= 100 : 0) {
			$content .= '
              
		<script>
			var table = $("#example2").DataTable({
					"ajax": {
						"url": "' . $page['load']['route_page'] . '",
						"dataType": "json",
						"type": "get",
						"data": {
							// _token: "{{csrf_token()}}",
							"link_route": "' . $page['load']['route_page'] . '",
							"apps": "' . $page['load']['apps'] . '",
							"page_view": "' . $page['load']['page_view'] . '",
							"type": "list_datatable",
							"id": ' . $page['load']['id'] . ',
							"menu": " ' . $page['load']['menu'] . '",
							"nav": " ' . $page['load']['nav'] . '",
							"contentfaiframework": "get_pages",
							"not_sidebar": "not",
							"MainAll": 2
							
						}
					
					},
					"drawCallback": function(settings) {
						// Here the response
						// var msg2 = settings.json;
						// // alert(JSON.stringify(response));
						
						//alert();
					},
					
				
					//"responsive": true,
					"paging": true,
					"processing": true,
					"serverSide": true,
					"deferLoading": 57,
					lengthMenu: [
						[10, 25, 50, 100, -1],
						[10, 25, 50, 100, "All"],
					],
					columns: [{
							data: "no",
							name: "no"
						},';

			if (isset($page['crud']['table_group'])) {
				foreach ($page['crud']['table_group'] as $key => $value) {
					$content .= '
						{
							data: "' . str_replace(' ', '', $key) . '",
							name: "' . str_replace(' ', '', $key) . '"
						},';
				}
			} else {
				for ($i = 0; $i < count($array); $i++) {
					$field = $array[$i][1];
					if ($array[$i][2] == "select-appr") {

						$field_database = $array[$i][3];
						$field = 'system_status_appr';
					}
					$content .= '
						{
							data: "' . $field . '",
							name: "' . $field . '"
						},';
				}
			}


			$content .= '
						{
							data: "aksi",
							name: "aksi"
						}
					],
					"lengthChange": true,
					//"dom": "t<"col-sm-6"li><"col-sm-6"p>",
					"searching": true,
					"ordering": true,
					"scrollX": true,
					"scrollY": "100vh",
					"info": true,
					"scroller": true,
					"autoWidth": true,
					"order": [
						[1, "desc"]
					],
					"columnDefs": [
						{
							className: "dt-body-center",
							"targets": [0]
						},
					
					],


				});

				//disable sorting kolom nomor urut
				table.on("order.dt search.dt", function() {
					table.column(0, {
						search: "applied",
						order: "applied"
					}).nodes().each(function(cell, i) {
						cell.innerHTML = i + 1;
					});
				}).draw();

				$("a[href=' . "'#tab2'" . ']").on("shown.bs.tab", function(e) {
					table.columns.adjust().draw();
				});

				$("#btn-reload").click(function() {

					table.ajax.reload();
				});
		</script>';
		} else {
			$content .=  '
				
					<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
					<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
					<script>
							// alert();
							$("#example1").DataTable({
								fixedColumns: {
									left: 2
								},
								"scrollY": 500,
								"scrollX": true,
								"ordering": true,
								"lengthChange": true,
								"paging": true,
							});
					</script>
					';
		}
		if ($page['section'] != 'viewsource') {

			$content .= '
			<div class="modal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title">Hapus </h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
			<select id="jenis_hapus" class="form-control">
			<option value="Diri Saya">Delete Untuk Diri Saya</option>
			<option value="Semua">Delete Untuk Semua</option>
			</select>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-primary">Save changes</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
			</div>
			</div>
			<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
            <div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="infoModalLabel">Information Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs" id="infoTab" role="tablist">
			<li class="nav-item" role="presentation">
			<button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">
			Details
			</button>
			</li>
			<li class="nav-item" role="presentation">
			<button class="nav-link" id="changes-tab" data-bs-toggle="tab" data-bs-target="#changes" type="button" role="tab" aria-controls="changes" aria-selected="false">
			Historis Data 
			</button>
			</li>
			</ul>
			
			<!-- Tab Panes -->
			<div class="tab-content" id="infoTabContent">
			<!-- Tab 1: Details -->
			<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
			<div class="mt-3">
			<h6>Informasi Pembuat</h6>
			<ul id="id_pembuat"> 
			<li><strong>Created By:</strong> <span id="created_info">John Doe</span></li>
			<li><strong>Created On:</strong> <span id="">2024-11-18</span></li>
			<li><strong>Panel:</strong> <span id="panel_info">Admin Panel</span></li>
			<li><strong>Domain:</strong> <span id="domain_info">example.com</span></li>
			<li><strong>Workspace:</strong> <span id="workspace_info">Active</span></li>
			<li><strong>Role:</strong> <span id="role_info">Active</span></li>
			</ul>
			</div>
			</div>
			
			<!-- Tab 2: Changes & Transactions -->
			<div class="tab-pane fade" id="changes" role="tabpanel" aria-labelledby="changes-tab">
			<div class="mt-3">
			<h6>Histori Data</h6>
			<table class="table table-striped">
			<thead>
			<tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>User</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Data Awal</th>
                                            <th>Data Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody id="histori_data">
                                      
                                    </tbody>
                                </table>

                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
		<div class="modal fade" id="privilegeModal" tabindex="-1" aria-labelledby="privilegeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privilegeModalLabel">Set Privileges</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
                    <!-- Privilege Type Selection -->
                    <div class="mb-3">
                        <label for="privilegeType" class="form-label">Privilege Type</label>
                        <select class="form-select" id="privilegeType">
                            <option value="website">Private Website</option>
                            <option value="workspace">Private Workspace</option>
                            <option value="personal">Private Personal</option>
                        </select>
                    </div>

                    <!-- Add Reader or Editor -->
                    <div class="mb-3">
                        <label for="userType" class="form-label">Add User</label>
                        <select class="form-select" id="userType">
                            <option value="reader">Reader</option>
                            <option value="editor">Editor</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" id="addUser">Add User</button>

                    <!-- Display Selected Privileges -->
                    <div class="mt-4">
                        <h6>Selected Privileges:</h6>
                        <ul id="privilegeList" class="list-group"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="savePrivileges">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<script>
				function open_modal_privilage(id){
					$("#privilegeModal").modal("show");
					}
					function info_modal(id){
						$.ajax({
							type: "get",
							data: {
									
									id_form: id,
								},
								url: "' . (Partial::link_direct($page, base_url() . 'pages/', array($page['load']['apps'], $page['load']['page_view'], 'info_privilage', $page['crud']['database_utama_temp'], -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . '",
								dataType: "json",
								success: function(data) {
									     

									$("#created_info").html(data.nama_lengkap);
									$("#date_info").html(data.create_date);
									$("#panel_info").html(data.nama_panel);
									$("#domain_info").html(data.domain);
									$("#workspace_info").html(data.nama_board);
									$("#role_info").html(data.nama_role);
									$("#histori_data").html(data.histori_data);
									$("#infoModal").modal("show");
								},
								error: function(error) {
									
								
								},
								
								});
								
								
								}
								function delete_from_privilage(id){
									$.ajax({
										type: "get",
										data: {
											
										id_form: id,
                            },
                            url: "' . (Partial::link_direct($page, base_url() . 'pages/', array($page['load']['apps'], $page['load']['page_view'], 'delete_privilage', $page['crud']['database_utama_temp'], -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . '",
                            dataType: "json",
                            success: function(data) {
								if(data.status){

									Swal.fire({
										
										icon: "success",
										title: "Penghapusan Berhasil",
										showConfirmButton: false,
										timer: 1500
									});
									window.location.href="";
								}
							},
                            error: function(error) {
                                
                               
                            },
                            
							});
							}
							</script>
							';
		}

		if ($page['section'] != 'viewsource') {
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => ($key1['num_rows_non_limit']),
				"iTotalDisplayRecords" => ($key1['num_rows_non_limit']),
				"aaData" => $content_datatable
			);
		}
		if ($return_result == "datatable") {

			return json_encode($response);
		} else
			return $content;;
	}
	public static function table_content($page, $fai, $array, $i, $data, $no, $database_utama, $type_view = 'table')
	{
		$text = $array[$i][0];
		$field = $array[$i][1];
		$return = CrudContent::typearray($page, $array, $i);
		$type = $return['type'];
		$visible = $return['visible'];
		$view_data = '';
		$content = "";
		$prefix = "";
		$sufix = "";
		if ($type_view == 'table') {

			// $prefix = "<td>";
			// $sufix = "</td>";
		}

		if ($visible) {
			if ($page['section'] == 'viewsource') {
				if ($type == "password") {
				} else if ($type == "select" or $type == "select-relation") {
					// $field_database = $array[$i][4];
					// if (!$field_database) {
					// 	if (isset($array[$i][3][3]))
					// 		$field_database = $array[$i][3][2] . '_' . $array[$i][3][0] . '_' . $array[$i][3][3];
					// 	else
					// 		$field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
					// }

					$field_database =  Database::get_colomn_select($page, $array[$i], $database_utama, 'value_table', 'row');
					$content .= '
								<td><?=$data->' . $field_database . ';?></td>';
				} else if ($type == "hidden_input") {
				} else if ($type == "select-multiple-string") {
					$multiple = DB::connection()->select("select array_agg(" . $array[$i][3][0] . "." . $array[$i][3][2] . ") as value from " . $array[$i][3][0] . " where " . $array[$i][3][1] . " in(" . $data->$field . ")");
					$content .=  '
								<td>' . str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value) . '</td>';
				} else if ($type == "select-appr") {
					$field_database = $array[$i][3];
					$field = 'system_status_appr';
					$content .=  '
								
								<?php if ($data->' . $field . ' != 3) $row_edit_hapus = false;?>
								<td><?php if($data->' . $field . '==1) 
											echo "Setuju";
										else if($data->' . $field . '==2) 
											echo "Tolak";
										else if($data->' . $field . '==3) 
										echo "Pending";
									;?></td>';
				} else if ($type == "select-manual") {
					$field_database = $array[$i][3];

					$content .=  '
								
								
								<td><?php 
								';
					$x = 0;
					foreach ($field_database as $key => $value) {
						if ($x != 0)
							$content .=  'else ';
						$content .=  'if($data->' . $field . '=="' . $key . '") 
											echo "' . $value . '";';
						$x++;
					}
					$content .=  '
									;?></td>';
				} else if ($type == "text-alias") {
					$field_database = $array[$i][3];
					$view_data = $data->$field_database;
					$content .=  '
								<td><?=$data->' . $field_database . ';?></td>';
				} else if ($type == 'file') {
					/*echo '
								
								<td><?php  $' . $field . ' = $data->' . $field . ';?>
								<a href="<?=url('."'uploads/'.".'$data->'. $field.')?>" target="_blank" title="Download"><span class="fa fa-download"></span></a>
								</td>';
						*/
				} else {
					$content .=  '
								
								<td><?= $' . $field . ' = $data->' . $field . ';?></td>';
				}
			} else {


				if ($type == "password") {
					// } else if ($type == "select" or $type == "select-relation") {
					// 	$field_database =  Database::get_colomn_select($page, $array[$i], $database_utama, 'value_table', 'row');

					// 	$view_data = $data->$field_database;
					// } else if ($type == "select-appr") {

					// } else if ($type == "text-alias") {
					// 	$field_database = $array[$i][3];
					// 	$field_database = substr($field_database, 0, 63);
					// 	$view_data = $data->$field_database;
				} else if ($type == "select-multiple-string") {
					$multiple = DB::connection()->select("select array_agg(" . $array[$i][3][0] . "." . $array[$i][3][2] . ") as value from " . $array[$i][3][0] . " where " . $array[$i][3][1] . " in(" . $data->$field . ")");
					$view_data =   str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value);
				} else if ($type == "select-manual") {
					if(isset($array[$i][3])){

						$field_database = $array[$i][3];
						$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
						if ($data->$field_data) {
							if (isset($field_database[$data->$field_data])) {
								$view_data = $field_database[$data->$field_data];
							}
						}
					}
				} else if ($type == "calc") {
					$total_field = 0;

					for ($c = 0; $c < count($array[$i][3]); $c++) {
						$operator = strtolower($array[$i][3][$c][0]);
						$nom_row = $array[$i][3][$c][1];
						$nom = $page['value_field'][$nom_row];

						if ($operator == 'kali')
							$total_field *= $nom;
						else if ($operator == 'tambah')
							$total_field += $nom;
						else if ($operator == 'kurang')
							$total_field -= $nom;
						else if ($operator == 'bagi')
							$total_field = $$row2 / $nom;
					}

					$view_data = $total_field;
				} else if ($type == "file"  or $type == "photos" or $type == "file-upload" or $type == 'video') {
					$view_data = "";
					$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
					if (isset($data->$field_data))
						$view_data = '<a href="' . base_url() . $data->$field_data . '" target="_blank" title="Download"><span class="fa fa-download"></span></a>';
				} else if ($type == "number") {
					$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
					$view_data = Partial::rupiah($data->$field_data, 0, '');
				} else if ($type == "date") {
					$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
					$view_data = date('d-m-Y', strtotime($data->$field_data));
				} else if ($type == "number-cur") {
					$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
					$view_data = Partial::rupiah($data->$field_data, 0, 'Rp ');
				} else {


					$field_data = $page['crud']['field_database'][$field][$database_utama]['value'];
					$view_data = $data->$field_data;
					// $view_data = $data->$field_data;
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
							$value = $view_data;
						$$var = $value;
					}
					//if(=='help')
					$view_data = $page[$page['function'][$field]['type']]->$func($param0, $param1, $param2, $param3, $param4, $param5, $param6, $param7);
				}





				if ($type == "text-crud") {
				} else if ($type == 'hidden') {
				} else if ($type == 'password') {
				} else {
					$content .=  $view_data;
				}
			}
		}

		if (isset($page['crud']['table_view'][$field]["tipe_view"])) {
			if ($page['crud']['table_view'][$field]["tipe_view"] == 'badge') {

				if ($content and isset($page['crud']['table_view'][$field]['value'][strtolower($content)])) {
					$prefix = '<span class="badge px-2 bg-label-' . ($page['crud']['table_view'][$field]['value'][strtolower($content)]) . '" text-capitalized="">';
					$sufix = '</span>';
				} else {
					$prefix = '<span class="badge px-2 bg-label-' . ($page['crud']['table_view'][$field]['else']) . '" text-capitalized="">';
					$sufix = '</span>';
				}
			} else if ($page['crud']['table_view'][$field]["tipe_view"] == 'bold-muted') {
				$prefix .= '<div class="d-flex flex-column"><h6 class="text-heading mb-0" style="color: #384551 !important;text-decoration:none;font-weight:505">';
				$var = ($page['crud']['table_view'][$field]["muted"]);
				$sufix = '</h6><small class="text-muted">' . $data->$var . '</small></div>';
			} else if ($page['crud']['table_view'][$field]["tipe_view"] == 'profil_avatar') {
				$prefix = '<div class="d-flex justify-content-start align-items-center order-name text-nowrap">
						<div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-primary">ZS</span></div></div>
						
						<div class="d-flex flex-column"><h6 class="m-0"><a href="#" class="text-heading" style="color: #384551 !important;text-decoration:none;font-weight:510">
						
						';
				$sufix = '</a></h6><small>' . $data->email . '</small></div></div>';
			}
		}

		return $prefix . $content . $sufix;
	}
	public static function table_form($page, $fai)
	{
		$content = '';
		foreach ($page['row'] as $data) {
			$no++;
			if ($type == "password") {
				$valueinput = '';
			} else
														if ($type == "text-alias") {
				$field_database = $array[$i][3];
				$valueinput = $page['row'][0]->$field_database;
			} else if ($type == "select" or $type == "select-relation" or $type == "select-multiple-string") {
				$field_database = $field . '_2';
				$valueinput = $page['row'][0]->$field_database;
			} else {

				$valueinput = $page['row'][0]->$field;
			}
			$content .= '
					<tr>
						<td>' . $no . '</td>';

			$array = $page['array_sub_kategori'][$h];

			for ($i = 0; $i < count($array); $i++) {

				if ($type != 'password')
					$content .= '<td>';
				$content .= CrudContent::form($page, $fai, $array, $i, $no, $data);
				$content .= '</td>';
			}

			$content .= '</tr>';
		}
		return $content;
	}
	public static function field_view_sub_kategori_table($page, $fai, $field, $database_utama, $h, $no)
	{


		return CrudContent::field_view_sub_kategori($page, $fai, $field, $database_utama, $h, $no, 'table');
	}
	public static function field_view_sub_kategori_form($page, $fai, $field, $database_utama, $h, $no)
	{
		return CrudContent::field_view_sub_kategori($page, $fai, $field, $database_utama, $h, $no, 'form');
	}
	public static function field_view_sub_kategori($page, $fai, $field, $database_utama, $h, $no, $tipe_field_view)
	{
		$content = "";

		for ($i = 0; $i < count($field); $i++) {

			$array[] = $field[$i][2];
		}

		$array = Database::converting_array_field($page, $array, 'all')['array'];
		$prefix_name = isset($page['crud']['prefix_name']) ? $page['crud']['prefix_name'] : '';
		$sufix_name = isset($page['crud']['sufix_name']) ? $page['crud']['sufix_name'] : '';

		if ($tipe_field_view == 'form') {

			unset($page['crud']['startdiv']);
			unset($page['crud']['enddiv']);
		} else {
			$page['crud']['startdiv'] = "";
			$page['crud']['enddiv'] = "";
		}
		if ($page['section'] == 'viewsource') {
			$data = '$data';
			//$content .=  " $no++; ";
			$content .=  CrudContent::field_view_sub_kategori_content($page, $fai, $field, $array, $database_utama, $i, $h, $no, $data, $prefix_name, $sufix_name, $tipe_field_view);
		} else {
			$no = 0;
			// CrudContent::sub_kategori_form($page, $fai, $h, $no, "");
			if ($page['crud']['row']['num_rows']) {
				foreach ($page['crud']['row']['row'] as $data) {

					$no++;
					$page['crud']['numbering'] = $no;
					$content .=  CrudContent::field_view_sub_kategori_content($page, $fai, $field, $array, $database_utama, $i, $h, $no, $data, $prefix_name, $sufix_name, $tipe_field_view);
				}
			}
		}
		return $content;
	}


	public static function field_view_sub_kategori_content($page, $fai, $field, $array, $database_utama, $i, $h, $no, $data, $prefix_name, $sufix_name, $type_page_view)
	{

		$content = '';
		$type_page_view;
		if ($type_page_view == 'table') {

			$content .= '<tr id="table-subkateogri-tr-' . $h . '-' . ($page['section'] == 'viewsource' ? '<?=$no?>' : $no) . '">
					<td>' . ($page['section'] == 'viewsource' ? '<?=$no?>' : $no) . '
					
					
					</td> <input type="hidden" value="' . ($page['section'] == 'viewsource' ? '<?=$request->value;?>' : $fai->input('value')) . '" class="valueRequest">';
		}
		for ($i = 0; $i < count($field); $i++) {
			$return = CrudContent::typearray($page, $array, $i);
			$type = $return['type'];
			$visible = $return['visible'];
			if ($field[$i][0] == -1) {
				if ($type_page_view == 'table') {

					$content .= CrudContent::table_content($page, $fai, $array, $i, $data, $no, $database_utama);
				} else {
					$field_database = $array[$i][1];
					$page['crud']['valueinput'][isset($array[$i][5]) ? ($array[$i][5]) : ($array[$i][1])] = $data->$field_database;
					$page['crud']['crud_inline'][isset($array[$i][5]) ? ($array[$i][5]) : ($array[$i][1])] = " readonly";
					$content .= CrudContent::form($page, $fai, $array, $i, $no, $data);
				}
				if (isset($field[$i][3]))
					$row_data = $field[$i][3];
				else
					$row_data = $field[$i][1];
				$content .= '<input type="hidden" 
										id="' . $field[$i][1] . '-' . $no . '" 
										name="' . $prefix_name . $field[$i][1] . $sufix_name . '" 
										value="' . ($page['section'] == 'viewsource' ? '<?=$data->' . $row_data . '?>' : $data->$row_data) . '">';
				if ($type_page_view == 'table'  and $type != 'hidden_input') {
					$content .= '</td>
									';
				}
			} else {
				// $field[$i][3]
				$fields = $array[$i][1];
				$type = $array[$i][2];
				$return = CrudContent::typearray($page, $array, $i);
				$type = $return['type'];
				$visible = $return['visible'];
				$extypearray = explode('-', $array[$i][2]);
				if ($type_page_view == 'table') {
					if ((in_array('right', $extypearray)) and  (isset($page['PDFPage']))) {
						$content .= '
						<td style="padding: 15px 10px;min-width: 250px;text-align:right" >';
					} else {
						$content .= '
						<td style="padding: 15px 10px;min-width: 250px;">';
					}
				} else {
					unset($page['crud']['startdiv']);
					unset($page['crud']['enddiv']);
				}

				$page_temp_sub_kategori = $page;
				$content .= CrudContent::form($page, $fai, $array, $i, $no, $data);
				$page = $page_temp_sub_kategori;

				if ($type_page_view == 'table') {
					$content .= '</td>';
				}
			}
		}



		if ($type_page_view == 'table') {
			if ((!in_array($page['crud']['view'], array('view'))) and !isset($page['crud']['no_action'][$page['crud']['sub_kategori'][$h][1]])) {
				$content .= '	<td style="display: flex;">';


				$content .= '<button type="button" onclick="deleteRow(' . $h . ',' . $no . ',' . "'" . $page['crud']['sub_kategori'][$h][3] . "'" . ')" class="btn btn-primary btn-sm">
															<svg xmlns="http://www.w3.org/2000/svg"  width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
											</button>';


				$content .= '	</td>';
			}
		}
		$content .= '<input class="contentinput-' . ($h) . '" type="hidden">
				<input name="no_sub_kategori-' . $page['crud']['sub_kategori'][$h][1] . '[]" value="' . ($no) . '" type="hidden" />
				</tr>';
		return $content;
	}
	public static function tree_sub_kategori($page, $fai)
	{
		$content_result = "";
		foreach ($page['crud']['row'] as $data) {
			$array = $page['crud']['array_sub_kategori'][$h];
			$get_content = '<div class="divider">
							<div class="divider-text">Sub Data - <LEVEL>
							</div>
						</div>';
			for ($i = 0; $i < count($array); $i++) {
				$page['page_row'] = 'sub_kategori';
				if (in_array($page['crud']['view'], array('view')))
					$page['crud']['input_inline'] = 'disabled';
				$type = $array[$i][2];
				$return = CrudContent::typearray($page, $array, $i);
				$type = $return['type'];
				ob_start();
				$page['crud']['numbering'] = $no;
				$visible = $return['visible'];
				$page['crud']['view_sub_kategori'] = 'form';
				$page['crud']['type_form_asal'] = $return['type_form_asal'];
				if ($visible) {
					$page['crud']['sufix_name'] = '<LEVELINPUT>';
					$get_content .= CrudContent::form($page, $fai, $array, $i, $no, $data);
				}
			}

			$content_result .= '<div id="tree_sub_kategori-' . $h . '-' . $no . '"></div>';

			if ((!in_array($page['crud']['view'], array('view'))) and !isset($page['crud']['no_action'][$page['crud']['sub_kategori'][$h][1]]) and !(isset($page['crud']['PDFPage']))) {
				$content = '<button type="button" onclick="tree_sub_kategori(' . $h . ',' . $no . ',<LEVELSUBJSPARAM>)" class="btn btn-primary btn-sm"> Tambah Sub Data Level <LEVEL>
															<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
														</button><br>';
				$get_content .= $content;
				$content = str_replace('<LEVEL>', $no, $content);
				$content = str_replace('<LEVELJSPARAM></LEVELJSPARAM', 1, $content);
				$get_content .= '<div id="tree_sub_kategori-' . $h . '-' . $no . '<IDTREE>"></div>';

				$content = '<button type="button" onclick="tree_sub_kategori(' . $h . ',' . $no . ',<LEVELJSPARAM>)" class="btn btn-primary btn-sm"> Tambah Data Level <LEVEL>
															<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
														</button>';
				//$get_content .= $content;

				$content = str_replace('<LEVEL>', $no, $content);
				$content = str_replace('<LEVELJSPARAM>', 1, $content);
				$content_result .= $content;


				$get_content = preg_replace('/[\r\n]+/', '', $get_content);;
			}

			$content_result .=   '<input type="hidden" id="content_multi" value="' . $get_content . '" /><div id="no-tree_sub"></div>';
			$content_result .=   '<script>';
			$content_result .=   '
					function tree_sub_kategori(a = 0, no, level, no2 = 0, no3 = 0, no4 = 0, no5 = 0) {
						let text = $("#content_multi").val();
						
				
						if (level == 1) {
							if ($("#no-tree_sub_kategori-" + a + "-" + no).length) {
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no).val()) + 1;
							} else {
								$("#no-tree_sub").append("<input type=' . "'hidden'" . ' id=' . "'no-tree_sub_kategori-" . '" + a + "-" + no + "' . "'" . ' value=0>");
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no).val()) + 1;
				
							}
							$("#no-tree_sub_kategori-" + a + "-" + no).val(number);
							text = text.replace(/<LEVEL>/gi, no + "-" + number);
							text = text.replace(/<LEVELSUBJSPARAM>/gi, "2" + "," + (parseInt(number)));
							text = text.replace(/<LEVELJSPARAM>/gi, 1);
							text = text.replace(/<LEVELINPUT>/gi, "_tree1[" + no + "][" + number + "]");
							text = text.replace(/<IDTREE>/gi, "-" + number);
				
							$("#tree_sub_kategori-" + a + "-" + no).append(text);
						} else if (level == 2) {
							if ($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2).length) {
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2).val()) + 1;
							} else {
								$("#no-tree_sub").append("<input type=' . "'hidden'" . ' id=' . "'no-tree_sub_kategori-" . '" + a + "-" + no + "-" + no2 + "' . "'" . ' value=0>");
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2).val()) + 1;
				
							}
							$("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2).val(number);
							text = text.replace(/<LEVEL>/gi, no + "-" + no2 + "-" + number);
							text = text.replace(/<LEVELSUBJSPARAM>/gi, "3," + no2 + "," + (parseInt(number)));
							text = text.replace(/<LEVELJSPARAM>/gi, 2 + "," + no2);
							text = text.replace(/<LEVELINPUT>/gi, "_tree2[" + no + "][" + no2 + "][" + number + "]");
							text = text.replace(/<IDTREE>/gi, "-" + no2 + "-" + number);
				
							$("#tree_sub_kategori-" + a + "-" + no + "-" + no2).append(text);
						} else if (level == 3) {
							if ($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3).length) {
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3).val()) + 1;
							} else {
								$("#no-tree_sub").append("<input type=' . "'hidden'" . 'id=' . "'no-tree_sub_kategori-" . '" + a + "-" + no + "-" + no2 + "-" + no3 + "' . "'" . ' value=0>");
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3).val()) + 1;
				
							}
							$("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3).val(number);
							text = text.replace(/<LEVEL>/gi, no + "-" + no2 + "-" + no3 + "-" + number);
							text = text.replace(/<LEVELSUBJSPARAM>/gi, "4," + no2 + "," + no3 + "," + (parseInt(number)));
							text = text.replace(/<LEVELJSPARAM>/gi, 3 + "," + no2 + "," + no3);
							text = text.replace(/<LEVELINPUT>/gi, "_tree3[" + no + "][" + no2 + "][" + no3 + "][" + number + "]");
							text = text.replace(/<IDTREE>/gi, "-" + no2 + "-" + no3 + "-" + number);
				
							$("#tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3).append(text);
				
						} else if (level == 4) {
							if ($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4).length) {
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4).val()) + 1;
							} else {
								$("#no-tree_sub").append("<input type=' . "'hidden'" . 'id=' . "'no-tree_sub_kategori-" . '" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "' . "'" . ' value=0>");
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4).val()) + 1;
				
							}
							$("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4).val(number);
							text = text.replace(/<LEVEL>/gi, no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + number);
							text = text.replace(/<LEVELSUBJSPARAM>/gi, "5," + no2 + "," + no3 + "," + no4 + "," + (parseInt(number)));
							text = text.replace(/<LEVELJSPARAM>/gi, 4 + "," + no2 + "," + no3 + "," + no4);
							text = text.replace(/<LEVELINPUT>/gi, "_tree4[" + no + "][" + no2 + "][" + no3 + "][" + no4 + "][" + number + "]");
							text = text.replace(/<IDTREE>/gi, "-" + no2 + "-" + no3 + "-" + no4 + "-" + number);
				
							$("#tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4).append(text);
						} else if (level == 5) {
							if ($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5).length) {
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5).val()) + 1;
							} else {
								$("#no-tree_sub").append("<input type=' . "'hidden'" . 'id=' . "'no-tree_sub_kategori-" . '" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5 + "' . "'" . ' value=0>");
								number = parseInt($("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5).val()) + 1;
				
							}
							$("#no-tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5).val(number);
							text = text.replace(/<LEVEL>/gi, no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5 + "-" + number);
							text = text.replace(/<LEVELSUBJSPARAM>/gi, "6," + no2 + "," + no3 + "," + no4 + "," + no5 + "," + (parseInt(number)));
							text = text.replace(/<LEVELJSPARAM>/gi, 5 + "," + no2 + "," + no3 + "," + no4 + "," + no5);
							text = text.replace(/<LEVELINPUT>/gi, "_tree5[" + no + "][" + no2 + "][" + no3 + "][" + no4 + "][" + no5 + "][" + number + "]");
							text = text.replace(/<IDTREE>/gi, "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5 + "-" + number);
				
							$("#tree_sub_kategori-" + a + "-" + no + "-" + no2 + "-" + no3 + "-" + no4 + "-" + no5).append(text);
						}
				
					}
				</script>';
		}
		return $content_result;
	}
	public static function table_viewsource($page, $fai, $database_utama)
	{

		$content = "";
		if (!isset($page['load']['crud_template']['table']['first_datatable'])) {

			$content .= '<?php 
						$no=0;';
			$content .= 'foreach($' . $fai->nama_function($page, $page['title']) . ' as $data){?>';
			$content .= '
							<?php $no++;?>
							<tr>
							<td><?=$no?></td>';
			$array = $page['crud']['array'];

			for ($i = 0; $i < count($array); $i++) {
				$text = $array[$i][0];
				$field = $array[$i][1];
				$type = $array[$i][2];

				$return = CrudContent::typearray($page, $array, $i);
				$type = $return['type'];
				$visible = $return['visible'];
				if ($visible) {
					$content .=  CrudContent::table_content($page, $fai, $array, $i, '$data', '$no', $database_utama);
				}
			}
			$is_view = false;

			if (isset($page['load']['crud_template']['table']['view']['is_colom'])) {

				$is_view = true;
				$content .= '	<td>';
				$content .= '
					<a title="view" href=' . "'" . ($fai->route_v($page, $page['route'], ['view', '$data->primary_key'])) . "'" . ' class="' . (isset($page['load']['crud_template']['class']['view']) ? $page['load']['crud_template']['class']['view'] : 'btn btn-primary btn-sm') . '">
					
					' . (isset($page['load']['crud_template']['icon']['view']) ? $page['load']['crud_template']['icon']['view'] : '
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
							<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
						</svg>') . '
						' . (isset($page['load']['crud_template']['text']['view']) ? $page['load']['crud_template']['text']['view'] : '') . '
				
				
					</a>';
				$content .= '	</td>';
			}
			$is_edit = false;

			if (isset($page['load']['crud_template']['table']['edit']['is_colom'])) {

				$is_edit = true;
				$content .= '	<td>';
				$content .= '	
								
								<a title="edit" href=' . "'" . ($fai->route_v($page, $page['route'], ['edit', '$data->primary_key'])) . "'" . ' class="' . (isset($page['load']['crud_template']['class']['edit']) ? $page['load']['crud_template']['class']['edit'] : 'btn btn-primary btn-sm') . '">
								' . (isset($page['load']['crud_template']['icon']['edit']) ? $page['load']['crud_template']['icon']['edit'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
						</svg>') . '
						' . (isset($page['load']['crud_template']['text']['edit']) ? $page['load']['crud_template']['text']['edit'] : '') . '
					</a>
					
					';
				$content .= '	</td>';
			}
			$is_delete = true;
			if (isset($page['load']['crud_template']['table']['hapus']['is_colom'])) {
				$is_delete = true;

				$content .= '	<td>';
				$content .= ' 
					<a title="delete" href=' . "'" . ($fai->route_v($page, $page['route'], ['hapus', '$data->primary_key'])) . "'" . ' onclick="return confirm(' . "'Apakah Anda Yakin?'" . ');" class="' . (isset($page['load']['crud_template']['class']['delete']) ? $page['load']['crud_template']['class']['delete'] : 'btn btn-primary btn-sm') . '">
					' . (isset($page['load']['crud_template']['icon']['delete']) ? $page['load']['crud_template']['icon']['delete'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
						</svg>') . '
						' . (isset($page['load']['crud_template']['text']['delete']) ? $page['load']['crud_template']['text']['delete'] : '') . '
					</a>';
				$content .= '	</td>';
			}
			$content .= '
								<td>
											<div class="d-flex">
											<?php $row_edit_hapus = true?>
									';
			if (isset($page['crud']['button_list']['text'][0])) {
				for ($i = 0; $i < count($page['crud']['button_list']['text']); $i++) {
					if ($page['crud']['button_list']['link_type'][$i] == 'route') {
						$param = explode('|', $page['crud']['button_list']['link_param'][0]);
						for ($j = 0; $j < count($param); $j++) {
							$param_in = $param[$j];
							if (strpos($param_in, '???')) {
								$temp = $param_in;
								$sub_string_awal = substr($param_in, (strpos($param_in, '???') + 3), (strpos($param_in, '!!!') - (strpos($param_in, '???') + 3)));
								$ex_string = explode(':', $sub_string_awal);
								if ($ex_string[0] == 'var') {
									$to_string = $ex_string[1];
									$new_string = $$to_string;
								} else if ($ex_string[0] == 'row') {
									$to_string = $ex_string[1];
									$new_string = $data->$to_string;
								}

								$param_in = str_replace('???' . $sub_string_awal . '!!!', $new_string, $param_in);
							}
							$param[$j] = $param_in;
						}
						if (count($param) == 1) {
							$href = '<?=route(' . $page['crud']['button_list']['link_route'][$i] . ', ' . $param[0] . ')?>';
						} else if (count($param) == 2) {
							$href = '<?=route(' . $page['crud']['button_list']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . '])?>';
						} else if (count($param) == 3) {
							$href = '<?=route(' . $page['crud']['button_list']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . ', ' . $param[2] . '])?>';
						} else if (count($param) == 4) {
							$href = '<?=route(' . $page['crud']['button_list']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . ', ' . $param[2] . ', ' . $param[3] . '])?>';
						}
					}

					$content .= '
															<a href="' . $href . '" class="btn btn-primary btn-sm" >
																' . ($page['crud']['button_list']['text'][$i]) . '
															</a>
															';
				}
			}

			if (isset($page['crud']['button_list_if']['text'][0])) {
				for ($i = 0; $i < count($page['crud']['button_list_if']['text']); $i++) {

					'???row:status_po!!![=]1';

					$param_if = explode('[=]', $page['crud']['button_list_if']['param_if'][$i]);
					$if = $param_if[0];
					$value = $param_if[1];

					if (strpos($if, '???')) {
						$temp = $if;
						$sub_string_awal = substr($if, (strpos($if, '!!!') + 3), (strpos($if, '???') - (strpos($if, '!!!') + 3)));
						$ex_string = explode(':', $sub_string_awal);
						if ($ex_string[0] == 'var') {
							$to_string = $ex_string[1];
							$new_string = $$to_string;
						} else if ($ex_string[0] == 'row') {
							$to_string = $ex_string[1];
							$new_string = '$data->' . $to_string;
						}

						$if = str_replace('!!!' . $sub_string_awal . '???', $new_string, $if);
					}
					$visible_if = false;
					if ($if == $value) {
						$visible_if = true;
					}

					if ($visible_if) {

						if ($page['crud']['button_list_if']['link_type'][$i] == 'route') {
							$param = explode('|', $page['crud']['button_list_if']['link_param'][0]);
							for ($j = 0; $j < count($param); $j++) {
								$param_in = $param[$j];

								if (strpos($param_in, '???')) {

									$temp = $param_in;
									$sub_string_awal = substr($param_in, (strpos($param_in, '!!!') + 3), (strpos($param_in, '???') - (strpos($param_in, '!!!') + 3)));
									$ex_string = explode(':', $sub_string_awal);
									if ($ex_string[0] == 'var') {
										$to_string = $ex_string[1];
										$new_string = '$' . $to_string;
									} else if ($ex_string[0] == 'row') {
										$to_string = $ex_string[1];
										$new_string = '$data->' . $to_string;
									}

									$param_in = str_replace('!!!' . $sub_string_awal . '???', $new_string, $param_in);
								}
								$param[$j] = $param_in;
							}
							if (count($param) == 1) {
								$href = '<?=route(' . $page['crud']['button_list_if']['link_route'][$i] . ', ' . $param[0] . ')?>';
							} else if (count($param) == 2) {
								$href = '<?=route(' . $page['crud']['button_list_if']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . '])?>';
							} else if (count($param) == 3) {
								$href = '<?=route(' . $page['crud']['button_list_if']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . ', ' . $param[2] . '])?>';
							} else if (count($param) == 4) {
								$href = '<?=route(' . $page['crud']['button_list_if']['link_route'][$i] . ', [' . $param[0] . ', ' . $param[1] . ', ' . $param[2] . ', ' . $param[3] . '])?>';
							}
						}

						$content .= '
															<a href="' . $href . '" class="btn btn-primary btn-sm" >
															' . ($page['crud']['button_list_if']['text'][$i]) . '
														</a>
															';
					}
				}
			}


			if ($page['crud']['type'] == 'appr') {

				$content .= '<?php if($row_edit_hapus){?>';

				$content .= '
					<a href="' . ($fai->route_v($page, $page['route'], ['setujui_appr', '$data->primary_key'])) . '" class="btn btn-primary btn-sm" title="Approve">
						<i class="fa fa-check"></i>
				
					</a>';
				$content .= '<?php } if($row_edit_hapus){?>' . '
					<a href="' . $fai->route_v($page, $page['route'], ['decline_appr', '$data->primary_key']) . '" class="btn btn-primary btn-sm" title="Decline">
						<i class="fa fa-times"></i>
					</a><br>';
				$content .=  '<?php }?>';
				$content .= '<a title="view" href=' . "'" . ($fai->route_v($page, $page['route'], ['view_appr', '$data->primary_key']))  . "'" . ' class="btn btn-primary btn-sm">
						<i class="fa fa-eye"></i>
					</a>';
			} else {
				if (!$is_view) {
					$content .= '
					<a title="view" href=' . "'" . ($fai->route_v($page, $page['route'], ['view', '$data->primary_key'])) . "'" . ' class="' . (isset($page['load']['crud_template']['class']['view']) ? $page['load']['crud_template']['class']['view'] : 'btn btn-primary btn-sm') . '">
					' . (isset($page['load']['crud_template']['icon']['view']) ? $page['load']['crud_template']['icon']['view'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
							<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
						</svg>') . '
						
						' . (isset($page['load']['crud_template']['text']['view']) ? $page['load']['crud_template']['text']['view'] : '') . '
					</a>';
				}
				if (!$is_edit) {
					$content .= '<?php $edit_visible = true;';
					if (isset($page['crud']['edit_if'])) {
						if ($page['crud']['edit_if']['check'] == 'row') {
							$content .= '
							if($data->' . ($page['crud']['edit_if']['row_data']) . ' == ' . ($page['crud']['edit_if']['value']) . '){
							$edit_visible =' . ($page['crud']['edit_if']['true']) . ';
							}else{
							$edit_visible = ' . ($page['crud']['edit_if']['false']) . ';
							}';
						} else if ($page['crud']['edit_if']['check'] == 'database') {
							$if_row = $page['crud']['edit_if']['row_data'];
							$edit_if_database['select'] = array('count(*) as count');
							$edit_if_database['utama'] = $page['crud']['edit_if']['database'];
							$edit_if_database['where'][] = array($page['crud']['edit_if']['where_in_database'], '=', '($data->' . $if_row . ')');
							$row = $fai->database_coverter($page, $edit_if_database, array(), 'source');
							$query = $row;

							$content .= '
								$sql="' . $query . '";
								$edit_if=DB::connection()->select($sql);
								if ($edit_if[0]->count > 0)
								$edit_visible = false;
							';
						}
					}
					$content .= '';
					$content .= ' if(!isset($no_edit) and $row_edit_hapus and $edit_visible){?>';
					$content .= '
				
				
					<a title="edit" href="' . ($fai->route_v($page, $page['route'], ['edit', '$data->primary_key'])) . '" class="' . (isset($page['load']['crud_template']['class']['edit']) ? $page['load']['crud_template']['class']['edit'] : 'btn btn-primary btn-sm') . '">
					' . (isset($page['load']['crud_template']['icon']['edit']) ? $page['load']['crud_template']['icon']['edit'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
						</svg>') . '
						' . (isset($page['load']['crud_template']['text']['edit']) ? $page['load']['crud_template']['text']['edit'] : '') . '
					</a>';
					$content .= '<?php 
													}
													
													?>';
				}
				if (!$is_delete) {
					$content .= '<?php 
													$delete_visible = true;
													';
					if (isset($page['crud']['delete_if'])) {
						if ($page['crud']['delete_if']['check'] == 'row') {
							$content .= '
							if($data->' . ($page['crud']['delete_if']['row_data']) . ' ' . ($page['crud']['delete_if']['operan']) . ' ' . ($page['crud']['delete_if']['value']) . '){
							$delete_visible =' . ($page['crud']['delete_if']['true']) . ';
							}else{
							$delete_visible = ' . ($page['crud']['delete_if']['false']) . ';
							}
							';
						} else if ($page['crud']['delete_if']['check'] == 'database') {
							$if_row = $page['crud']['delete_if']['row_data'];
							$delete_if_database['select'] = array('count(*) as count');
							$delete_if_database['utama'] = $page['crud']['delete_if']['database'];
							$delete_if_database['where'][] = array($page['crud']['delete_if']['where_in_database'], '=', '($data->' . $if_row . ')');
							$row = $fai->database_coverter($page, $delete_if_database, array(), 'source');
							$query = $row;
							$content .= '
							$sql="' . ($query) . '";
							$delete_if=DB::connection()->select($sql);
							if ($delete_if[0]->count > 0)
							$delete_visible = false;';
						}
					}
					$content .=  '
													if(!isset($no_delete) and $row_edit_hapus and $delete_visible){?>';

					$content .= ' 
					<a title="delete" href=' . "'" . ($fai->route_v($page, $page['route'], ['hapus', '$data->primary_key'])) . "'" . ' onclick="return confirm(' . "'Apakah Anda Yakin?'" . ');" class="' . (isset($page['load']['crud_template']['class']['delete']) ? $page['load']['crud_template']['class']['delete'] : 'btn btn-primary btn-sm') . '">
					' . (isset($page['load']['crud_template']['icon']['delete']) ? $page['load']['crud_template']['icon']['delete'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
							<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
						</svg>') . '
						' . (isset($page['load']['crud_template']['text']['delete']) ? $page['load']['crud_template']['text']['delete'] : '') . '
					</a>';

					if (isset($page['crud']['delete_if']['not_visible'])) {
						$content .=  '}else if(!$delete_visible){?>';
						$content .= '  
					<a title="delete" href="javascript::void(0)" onclick="return alert(' . "'" . ($page['crud']['delete_if']['not_visible']) . "'" . ');" class="' . (isset($page['load']['crud_template']['class']['delete']) ? $page['load']['crud_template']['class']['delete'] : 'btn btn-primary btn-sm') . '">
					' . (isset($page['load']['crud_template']['icon']['delete']) ? $page['load']['crud_template']['icon']['delete'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
								<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
							</svg>') . '
							' . (isset($page['load']['crud_template']['text']['delete']) ? $page['load']['crud_template']['text']['delete'] : '') . '
						</a>';
					}
					$content .= '<?php 
													}
													?>';
				}
			}
			$content .= '</div>
				</td>';


			$content .= '</tr>';
			$content .= '<?php }?>';
		}
		return $content;
	}
	public static function search($page, $fai)
	{
		$content = "";
		$no = -1;
		if ($page['section'] == 'viewsource') {
			$content = '<?php 
					$no=-1;
				?>';
		}
		foreach ($page['crud']['search'] as $key => $value) {
			if ($key <= -100) {
				$selected = '';
				if ($fai->input('status-appr', '_GET'))
					$selected = $fai->input('status-appr', '_GET');

				$content .= '<div class="col-md-' . $value[0] . '">';
				$page['crud']['view'] = "tambah";
				$field = $value[2][1] = "search_" . $value[2][1];
				$type = $value[2][2];
				// if (isset($value[2][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))  and in_array("select", explode('-', $type))) {


				// 	// $option = $value[2][3];
				// 	// if (isset($option[0])) {
				// 	// 	$database = $option[0];
				// 	// 	$key = $option[1];
				// 	// 	$page['crud']['select_database_costum'][$field]['utama'] =  $database;
				// 	// 	$page['crud']['select_database_costum'][$field]['primary_key'] =  $key;

				// 	// 	$row = $fai->database_coverter($page, $page['crud']['select_database_costum'][$field], null, 'source');
				// 	// 	$query = $row;

				// 	// 	$content .= '

				// 	// <?php $sql="' . $query . '";
				// 	// $' . $field . '=DB::connection()->select($sql);
				// 	// 
				// 	// ';
				// 	// }
				// }
				$content .=  CrudContent::form($page, $fai, [0 => $value[2]], 0, -1, []);;
				$content .= '</div>';
			} else if ($key == -1) {
				$selected = 1;
				if ($fai->input('search-active', '_GET'))
					$selected = $fai->input('search-active', '_GET');

				$content .= '<div class="col-md-' . $value[0] . '">';
				$content .= '
											<div class="form-group row" style="display: block ruby;">
															<label class="control-label col-3 ">Status</label>
															<div class="col-9">
											<select name="search-active" class="form-select">
													<option value="2">Semua</option>
													<option value="1" ' . ($selected == 1 ? 'selected' : '') . '>Aktif</option>
													<option value="-1" ' . ($selected == -1 ? 'selected' : '') . '>Non Akfif</option>
												</select>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
			} else if ($key == -2) {
				$selected = '';
				if ($fai->input('status-appr', '_GET'))
					$selected = $fai->input('status-appr', '_GET');

				$content .= '<div class="col-md-' . $value[0] . '">';
				$content .= '
											<div class="form-group row" style="display: block ruby;">
															<label class="control-label col-3 ">Status</label>
															<div class="col-9">
											<select name="status-appr" class="form-select">
													<option value="">Semua</option>
													<option value="1" ' . ($selected == 1 ? 'selected' : '') . '>Disetujui</option>
													<option value="2" ' . ($selected == 2 ? 'selected' : '') . '>Tolak</option>
													<option value="3" ' . ($selected == 3 ? 'selected' : '') . '>Pending</option>
												</select>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
			} else if ($key == -3) {
				$selected = '';
				if ($fai->input('status-appr', '_GET'))
					$selected = $fai->input('status-appr', '_GET');

				$content .= '<div class="col-md-' . $value[0] . '">';
				$content .= '
					
					<div class="col-md-12 d-inline-flex mb-2">
					<label for="inputZip" class="form-label col-sm-3">Periode : </label>
					<input type="date" class="form-control form-control-sm border-dark" id="create_awal" name="create_awal" value="' . ($page['section'] == 'viewsource' ? '<?=isset($_GET["create_awal"])?$_GET["create_awal"]:\'\';?>' : '') . '" >
					<input type="date" class="form-control form-control-sm border-dark" id="create_akhir" name="create_akhir" value="' . ($page['section'] == 'viewsource' ? '<?=isset($_GET["create_akhir"])?$_GET["create_akhir"]:\'\';?>' : '') . '" >
					</div>
					';
				$content .= '</div>';
			} else if ($key >= 0) {
				$page = $page;
				$page['crud']['view'] = 'search';
				$page['crud']['input_inline'] = '';
				$search_value = 0;
				$search_key   = $key;
				$i = $key;;
				$array = $page['crud']['array'];
				$typearray = $array[$i][2];

				$extypearray = explode('-', $typearray);
				$page['crud']['type_form_asal'] = $typearray;
				if ($extypearray[0] == 'date') {
					$array_temp = $array;
					$array = $array_temp;
					$array[$i] = array($array[$i][0] . ' Dari', $array[$i][1] . '_dari', 'date');
					$content .= '<div class="col-md-' . $value[0] . '">';
					$content .= CrudContent::form($page, $fai, $array, $i, -1, []);
					$content .= '</div>';
					$array = $array_temp;
					$array[$i] = array($array[$i][0] . ' Sampai', $array[$i][1] . '_sampai', 'date');
					$content .= '<div class="col-md-' . $value[0] . '">';
					$content .= CrudContent::form($page, $fai, $array, $i, -1, []);
					$content .= '</div>';
				} else {

					$content .= '<div class="col-md-' . $value[0] . '">';
					$content .= CrudContent::form($page, $fai, $array, $i, -1, []);
					$content .= '</div>';
				}
			}
		}
		return $content;
	}
	public static function PDFPage($page, $fai)
	{
		$content = "";
		$content .= '<h1 style="text-align: center">' . $page['title'] . '</h1>';


		$content .= isset($page['subtitle']) ? $page['subtitle'] : '';
		$page = $page;
		$page['crud']['view'] = "view";
		$page['crud']['PDFPage'] = true;
		$page['crud']['form_route'] = "PDFPage";
		$page['crud']['input_inline'] = "disabled";
		$page['crud']['section_vte'] = "form_utama";
		$content .= CrudContent::vte_main($page, $fai);
		return $content;
	}
	public static function pdf($page, $fai)
	{
		$page['crud']['no_action'] = true;
		$content = '<h1 style="text-align: center">' . $page['title'] . '</h1>';
		$content .= CrudContent::table($page, $fai);
		return $content;
	}
	public static function edit($page, $fai)
	{
		$page = $page;
		$page['crud']['view'] = "edit";
		$page['crud']['form_route'] = "update";
		$page['crud']['input_inline'] = "";
		return CrudContent::vte($page, $fai);
	}
	public static function edit_approval($page, $fai)
	{
		$page = $page;

		$page['crud']['view'] = "edit_approval";
		$page['crud']['form_route'] = "update_approval";
		$page['crud']['input_inline'] = "";
		return CrudContent::vte($page, $fai);
	}
	public static function appr($page, $fai)
	{
		$page = $page;
		$content = "";
		$content .= isset($page['file_open']) ? $page['file_open'] : '';
		$page['title'] = "Approval " . $page['title'];
		$page['crud']['view'] = 'appr';
		$page['crud']['redirect'] = 'appr';
		$page['crud']['no_add'] = true;
		$page['crud']['no_edit'] = true;
		$page['crud']['no_hapus'] = true;
		$page['crud']['no_edit_hapus_after_appr'] = true;
		$content .= CrudContent::list_table($page, $fai);

		$content .= '</div>
						</div>
					</div>
				</div>
			</main>



		' . (isset($page['file_closed']) ? $page['file_closed'] : '') . '

			
			<script type="text/javascript">$("#sampleTable").DataTable();</script>
			<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
		<script>
			table = $("#table").DataTable({ 
					"ordering" : true, 
					"processing": true, 
					"serverSide": true, 
					"order": [],
					"ajax": { "url": "https://api.srv3r.com/table/", 
							"type": "POST", 
							"data": function ( data ) { } 
							}, 
						oLanguage: { sProcessing: "<i class=\'fa fa-spinner fa-spin text-success\'></i> Tunggu sebentar..." }, 
					"columnDefs": [ { 
										"targets": [ 0 ], //first column / numbering column 
										"orderable": false, //set not orderable 
									}, ], 
					}); 
				$("#btn-filter").click(function(){ 
				
					table.ajax.reload(null,false); 
				}); 
				$("#btn-reset").click(function(){ //button reset event click 
					$("#form-filter")[0].reset(); table.ajax.reload(null,false); //just reload table xxxx
				}); 
		</script>   </script> ';

		return $content;
	}
	public static function tambah($page, $fai)
	{
		$page = $page;

		$page['crud']['view'] = "tambah";
		$page['crud']['form_route'] = "save";
		$page['crud']['input_inline'] = "";
		$page['section'] = isset($page['section']) ? $page['section'] : '';

		return CrudContent::vte($page, $fai);
	}
	public static function setting($page, $fai)
	{
		$page = $page;

		$page['crud']['view'] = "setting";
		$page['crud']['form_route'] = "save_setting";
		$page['crud']['input_inline'] = "";
		$page['section'] = isset($page['section']) ? $page['section'] : '';

		return CrudContent::setting_page($page, $fai);
	}
	public static function view($page, $fai)
	{
		$page = $page;

		$page['crud']['view'] = "view";
		$page['crud']['form_route'] = "view";
		$page['crud']['input_inline'] = "disabled";
		return CrudContent::vte($page, $fai);
	}
	public static function view_appr($page, $fai)
	{
		$page = $page;

		$page['crud']['view'] = "view";
		$page['crud']['form_route'] = "view";
		$page['crud']['input_inline'] = "disabled";
		$page['crud']['appr_page'] = true;
		return CrudContent::vte($page, $fai);
	}

	public static function setting_page($page, $fai)
	{
		$content = '';
		if (isset($page['crud']['list_table_view_layout'])) {
			$function = "change_view_layout_crud";
		} else {
			$function = "reachpage";
		}

		$content .= '
            <div class="' . (isset($page['load']['crud_template']['class']['button_add_prefix']) ? $page['load']['crud_template']['class']['button_add_prefix'] : 'col-md-2') . '">
                <a class="' . (isset($page['load']['crud_template']['class']['button_add']) ? $page['load']['crud_template']['class']['button_add'] : 'btn btn-primary') . '" 
                    ' . ($page['section'] == 'viewsource' ? 'href="<?=url(' . "'" . $fai->route($page['route'], ['tambah', -1]) . "')?>" . '"' : 'onclick="' . $function . '(' . "'" . $page['route'] . "'" . ',' . "'" . 'list' . "'" . ',-1)"') . '
                > ' . (isset($page['load']['crud_template']['text']['tambah']) ? $page['load']['crud_template']['text']['tambah'] : 'Kembali Ke Form ') . ' ' . $page['title'] . '</a>
            </div>';

		$content .= '
	    <style>
	    .cycle-tab-container {
          margin: 30px auto;
          width: 100%;
          padding: 20px;
        
        }
        
        .cycle-tab-container a {
          color: #173649;
          font-size: 16px;
          font-family: roboto;
          text-align: center;
        }
        
        .tab-pane {
            min-height: 300px !important;
            margin: 10px ;
            max-width: 100%;
        }
        
        .fade {
          opacity: 0;
          transition: opacity 4s ease-in-out;
        }
        
        .fade.active {
          opacity: 1;
        }
        
        .cycle-tab-item {
          width: 150px;
          font-size:10px
        }
        
        .cycle-tab-item:after {
          display:block;
          content: "";
          border-bottom: solid 3px green;  
          transform: scaleX(0);  
          transition: transform 0ms ease-out;
        }
        .cycle-tab-item.active:after { 
          transform: scaleX(1);
          transform-origin:  0% 50%; 
          transition: transform 5000ms ease-in;
        }
        
        .nav-link{
            font-size:12px
        }
        .nav-link:focus,
        .nav-link:hover,
        .cycle-tab-item.active a {
          border-color: transparent !important;
          color: green;
        }
  
        
        .onoffswitch {
            position: relative; width: 75px;
            -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
        }
        .onoffswitch-checkbox {
            display: none;
        }
        .onoffswitch-label {
            display: block; overflow: hidden; cursor: pointer;
            border: 2px solid #FFFFFF; border-radius: 20px;
        }
        .onoffswitch-inner {
            display: block; width: 200%; margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }
        .onoffswitch-inner:before, .onoffswitch-inner:after {
            display: block; float: left; width: 50%; height: 28px; padding: 0; line-height: 28px;
            font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
            box-sizing: border-box;
        }
        .onoffswitch-inner:before {
            content: "Tampil";
            padding-left: 12px;
            background-color: #51C234; color: #FFFFFF;
        }
        .onoffswitch-inner:after {
            content: "Tidak";
            padding-right: 12px;
            background-color: #DDDDDD; color: #FFFFFF;
            text-align: right;
        }
        .onoffswitch-switch {
            display: block; width: 16px; margin: 6px;
            background: #FFFFFF;
            position: absolute; top: 0; bottom: 0;
            right: 43px;
            border: 2px solid #FFFFFF; border-radius: 20px;
            transition: all 0.3s ease-in 0s; 
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }
        .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
            right: 0px; 
        }
	    </style>
	    
	    <div class="cycle-tab-container  p-0">
	        
	        
          <ul class="nav nav-tabs">
          <li class="cycle-tab-item">
            <a class="nav-link" role="tab" data-toggle="tab" href="#dasar">Dasar</a>
          </li>
          <li class="cycle-tab-item active">
            <a class="nav-link" role="tab" data-toggle="tab" href="#home">Form</a>
          </li>
          <li class="cycle-tab-item"> 
            <a class="nav-link" role="tab" data-toggle="tab" href="#profile">Approval</a>
          </li>
          <li class="cycle-tab-item">
            <a class="nav-link" role="tab" data-toggle="tab" href="#messages">Akses</a>
          </li>
          <li class="cycle-tab-item">
            <a class="nav-link" role="tab" data-toggle="tab" href="#settings">Spreadsheet</a>
          </li>
          <li class="cycle-tab-item">
            <a class="nav-link" role="tab" data-toggle="tab" href="#respon">Auto Respon </a>
          </li>
        </ul>
          <div class="tab-content">
          <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">';
		$array = $page['crud']['array'];

		$page['crud']['section_vte'] = 'form';
		if (!isset($no))
			$no = 1;
		$sql = "select * from form where database_utama = '" . $page['database']['utama'] . "' 
	            and id_board=" . $page['load']['board'] . " 
	            and load_apps='" . $page['load']['apps'] . "'  
	            and load_page_view='" . $page['load']['page_view'] . "' 
	            and tipe_form = 'Board Form' 
	            and active=1";
		$get = DB::query($sql);
		$form = DB::fetchResponse($get);
		if (!$form) {
			$insert_form['database_utama'] = $page['database']['utama'];
			$insert_form['id_board'] = $page['load']['board'];
			$insert_form['load_apps'] = $page['load']['apps'];
			$insert_form['load_page_view'] = $page['load']['page_view'];
			$insert_form['tipe_form'] = 'Board Form';
			$save = CRUDFunc::crud_save($fai, $page, $insert_form, array(), array(), "form", array(), array());
			$get = DB::query($sql);
			$form = DB::fetchResponse($get);
		}
		$x = 0;
		foreach ($form as $form_) {
			if (!$x) {
				$get_form = $form_;
				$x++;
			}
		}

		$sql = "select * from web__list_apps_board__role__group where active=1";
		$get = DB::query($sql);

		$row_group_role = DB::fetchResponse($get);
		$sql = "select * from webmaster__form__tipe where active=1";
		$get = DB::query($sql);

		$row_tipe_form = DB::fetchResponse($get);
		for ($i = 0; $i < count($array); $i++) {
			$return = CrudContent::typearray($page, $array, $i);
			$type = $return['type'];
			$sql = "select count(*) from webmaster__form__tipe  where active=1 and kode_form='$type'";
			$get_count = DB::fetchResponse(DB::query($sql));
			if (!$get_count[0]->count) {
				$sqli['kode_form'] = $type;
				$sqli['nama_form'] = ucwords(str_replace('_', ' ', $type));

				CRUDFunc::crud_insert(false, $page, $sqli, [], 'webmaster__form__tipe', []);

				$sql = "select * from webmaster__form__tipe where active=1";
				$get = DB::query($sql);

				$row_tipe_form = DB::fetchResponse($get);
			}
			$content .= '
		    
		    <div class="card  mb-4">
		        <div class="card-body">
    		        <div class="row">
    		            <div class="col-md-6">
    		                <label>Nama Form </label>
        		            <input data-field="' . $array[$i][1] . '" onkeyup="save_text_form_class(this,' . "'" . $array[$i][1] . "'" . ')" value="' . $array[$i][0] . '" class="form-control">
        		            <div id="nama_form-sync-' . $array[$i][1] . '"></div>
    		            </div>
    		            <div class="col-md-6">
    		        
    		               <label>Jenis Form</label>
            		          <select  value="' . $array[$i][0] . '" class="form-control" disabled>';
			foreach ($row_tipe_form as $form) {
				$content .= ' <option value="' . $form->kode_form . '" ' . ($type == $form->kode_form ? 'selected' : '') . '>' . $form->nama_form . '</option>';
			}
			$content .= '         
            		        </select>
        		        </div>
        		    </div>
		        </div>
    		    <div class="card-footer">
    		        <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked data-field="' . $array[$i][1] . '" onclick="save_tampil_class(this,' . "'" . $array[$i][1] . "'" . ')">
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
    		    </div>
    		  <!--multi entitas-->
		    </div>
		    ';
		}
		$page['route_type'] = 'just_link';
		$content .= '
          	
          	<div id="tambah_form-content">
          	';
		DB::table('form__content__extend');
		DB::whereRaw("id_form=$get_form->id");
		DB::whereRaw("id_approval is null");
		$row_extend = DB::get('all');
		if ($row_extend['num_rows']) {
			foreach ($row_extend['row'] as $data_extend) {
				$content .= BForm::form_content($page, $data_extend->id, 0, 'extend', 1, $data_extend);
			}
		}
		$content .= '
          	</div>
          	<div id="tambah_form"></div>
          	<button class="btn btn-primary" onclick="add_from_extend()"> Tambah From</button>
          
          	<script>
          	var i_extend=0;
          	function add_from_extend(){
          	    
          	    ';
		$content .= "
          	            $.ajax({
                            type: 'get',
                            data: {
                                
                                'id_form': " . $get_form->id . ",
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "add_from_extend", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'json',
                            success: function(data) {
                                text = data.text;
                                ";
		$content .= '    
                          	    
                    		    ';
		$content .= '
                    		    i_extend++;
                          	    $("#tambah_form").append(text);
                            },
                            error: function(error) {
                                
                               
                            },
                            
                        });
          	}
          	';

		$content .= "
          	function save_text_form_extend(e,iex,t){
          	            var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'iex': iex,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_text_form_extend", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data proses save');
                            }
                        });
          	}
          	function save_tipe_form_extend(e,iex,t){
          	            var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'iex': iex,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_tipe_form_extend", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form-sync_extend-'+iex+'-'+t).html('Data proses save');
                            }
                        });
          	}
          	function save_text_form_class(e,field){
          	            var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'field': field,
                                'id_form': " . $get_form->id . ",
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_text_form_class", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#nama_form-sync-'+field).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#nama_form-sync-'+field).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#nama_form-sync-'+field).html('Data proses save');
                            }
                        });
          	}
          	function save_tampil_class(e,field){
          	            var content = $(e).is('checked');
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'field': field,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_tampil_class", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#nama_form-sync-'+field).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#nama_form-sync-'+field).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#nama_form-sync-'+field).html('Data proses save');
                            }
                        });
          	}
          	</script>";

		$content .= '
          	
          </div>	
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="card mb-5">
              <div class="card-body">
                  <div class="form-group row">
        		        <div class="col-md-6">
        		            Approval Data Proses?
                        </div>
        		        <div class="col-md-6">
        		            <input type="checkbox" class="form-check-input content-  childchekbox" name="checklist_menu[]" value="1" ' . ($get_form->status_approval_proses ? 'checked' : '') . ' data-id="" style="" onclick="check_approval_proses(this)"  onload="check_approval_proses(this)">
                                
                        </div>
                        
                  </div>
                  
                  <div class="form-group row">
        		        <div class="col-md-6">
        		            Approval Proses Per 
                        </div>
        		        <div class="col-md-6">
        		            <select type="checkbox" class="form-check-input content-  childchekbox" name="checklist_menu[]" value="1" ' . ($get_form->status_approval_proses ? 'checked' : '') . ' data-id="" style="" onclick="check_approval_proses_per(this)"  onload="check_approval_proses_per(this)">
                                <option value="Data">Data</option>
                                <option value="Tanggal Pembuatan">Tanggal Pembuatan</option>
                                <option value="Karyawan Entitas">Karyawan Entitas</option>
                            </select>
                        </div>
                        
                  </div>
                  
                <!--  <div class="form-group row">
        		        <div class="col-md-6">
        		            Approval Data Update?
                         </div>
        		        <div class="col-md-6">
        		            <input type="checkbox" class="form-check-input content-  childchekbox" name="checklist_menu[]" value="1" data-id="" style="" onclick="c(this)">
                                
                       </div>
                        
                   </div>
                   --!>
              </div>
          </div>
          <div id="content-approval-proses">
            ';
		DB::table('form__approval');
		DB::whereRaw("id_form=$get_form->id");
		DB::orderRaw($page, array("approval_ke", "asc"));
		$row_extend = DB::get('all');
		if ($row_extend['num_rows']) {
			foreach ($row_extend['row'] as $data_extend) {
				$content .= BForm::approval_content($page, $data_extend->id, $data_extend->approval_ke, 1, $data_extend);
			}
		}
		$content .= '
          </div>
          <button class="btn btn-primary" id="btnproses" ' . ($get_form->status_approval_proses ? '' : 'style="display:none"') . ' onclick="add_approval_proses()">
    		            Tambah Approval Proses
    		        </button>
          ';
		$content .= "
          <script>
          function save_text_form_approval (e,iex,t){
                 var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'iex': iex,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_text_form_extend", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data gagal tersimpan');
                                
                            },
                            beforeSend: function(jqXHR) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data proses save');
                            }
                        });
              
          }
          function save_tipe_form_approval(e,iex,t){
          	            var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'iex': iex,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_tipe_form_extend", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form-sync_approval-'+iex+'-'+t).html('Data proses save');
                            }
                        });
          	}
          
          function check_approval_proses(e){
                var is;
                if($(e).is(':checked')){
                    is=1;
                    $('#btnproses').show(); 
                }else{
                    is=0;
                    $('#btnproses').hide(); 
                    
                }
                utama(is,'status_approval_proses');
          }
          function utama(content,field){
               $.ajax({
                            type: 'get',
                            data: {
                                
                                'id_form': " . $get_form->id . ",
                                'content': content,
                                'field': field,
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "update_utama", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'json',
                            success: function(data) {
                           
                            },
                            error: function(error) {
                                
                               
                            },
                            beforeSend: function(jqXHR) {
                            }
                        });
          }
            function add_approval_proses(){
                 $.ajax({
                            type: 'get',
                            data: {
                                
                                'id_form': " . $get_form->id . ",
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "add_approval", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'json',
                            success: function(data) {
                            text = data.text;
                            
                             $('#content-approval-proses').append(text);
                            },
                            error: function(error) {
                                
                               
                            },
                            beforeSend: function(jqXHR) {
                            }
                        });
          	}
            function add_form_approval(approval){
                 $.ajax({
                            type: 'get',
                            data: {
                                
                                'id_form': " . $get_form->id . ",
                                'id_approval': approval,
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "add_form_approval", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'json',
                            success: function(data) {
                            text = data.text;
                            
                             $('#content-form-approval-'+approval).append(text);
                            },
                            error: function(error) {
                                
                               
                            },
                            beforeSend: function(jqXHR) {
                            }
                        });
          	}
            function change_nama_approval(e,id){
                 var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'id': id,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_nama_approval", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form_approval-sync-'+id).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form_approval-sync-'+id).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form_approval-sync-'+id).html('Data proses save');
                            }
                        });
            }
            function change_group_approval(e,id){
                 var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'id': id,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_group_approval", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form_approval-sync-'+id).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form_approval-sync-'+id).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form_approval-sync-'+id).html('Data proses save');
                            }
                        });
            }
            function change_tipe_approval(e,id){
                 var content = $(e).val();
                        $.ajax({
                            type: 'get',
                            data: {
                                
                                'content': content,
                                'id': id,
                                'id_form': " . $get_form->id . ",
            
                                
                                
            
                            },
                            url: '" . (Partial::link_direct($page, base_url() . 'pages/', array("BForm", "save_tipe_approval", 'view_layout', -1, -1, -1, 'ID_BOARD|'), 'menu', 'just_link')) . "',
                            dataType: 'html',
                            success: function(data) {
                                $('#form_approval-sync-'+id).html('Data tersimpan');
                            },
                            error: function(error) {
                                $('#form_approval-sync-'+id).html('Data gagal tersimpan');
                               
                            },
                            beforeSend: function(jqXHR) {
                                $('#form_approval-sync-'+id).html('Data proses save');
                            }
                        });
            }
          </script>
          
          ";


		$content .= '
          </div>
          <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">Asymmetrical sustainable live-edge tempor eiusmod kale chips cloud bread vexillologist et man bun pitchfork hashtag excepteur scenester ethical.</div>
          <div class="tab-pane fade" id="respon" role="tabpanel" aria-labelledby="respon-tab">
            <div class="card">
              <div class="card-body">
                  <div class="form-group row">
        		        <div class="col-md-4">
        		            Respon Setelah  Menambahkan
                        </div>
        		        <div class="col-md-2">
        		            <input type="checkbox" class="form-check-input content-  childchekbox" name="checklist_menu[]" value="1" data-id="" style="" onclick="checkparent(this)">
                                
                        </div>
                        
                  </div>
                  <div class="form-group row">
        		        <div class="col-md-4">
        		            Respon Proses Approval 
                        </div>
        		        <div class="col-md-6">
        		            <input type="checkbox" class="form-check-input content-  childchekbox" name="checklist_menu[]" value="1" data-id="" style="" onclick="checkparent(this)">
                                
                        </div>
                        
                  </div>
              </div>
          </div>
          </div>
          <div class="tab-pane fade" id="dasar" role="tabpanel" aria-labelledby="dasar-tab">
          <div class="card">
              <div class="card-body">
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Title
                        </div>
        		        <div class="col-md-8">
        		            <input type="text" class="form-control" value="' . ($get_form->nama_form ? $get_form->nama_form : $page['title']) . '" onclick="title_form(this)"  onkeyup="title_form(this)" onmouseover="title_form(this)">
                                
                        </div>
                        
                  </div>
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Deskripsi 
                        </div>
        		        <div class="col-md-8">
        		            <textarea type="text" class="form-control " name="checklist_menu[]" value="1" data-id="" style="" onclick="deskripsi(this)" onkeyup="deskripsi(this)" onmouseover="deskripsi(this)">' . $get_form->deskripsi . '</textarea>
                                
                        </div>
                        
                  </div>
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Pesan Setelah Form
                        </div>
        		        <div class="col-md-8">
        		            <textarea type="text" class="form-control " name="checklist_menu[]" value="1" data-id="" style="" onclick="pesan_form(this)" onkeyup="pesan_form(this)"  onmouseover="pesan_form(this)">' . $get_form->pesan_setelah_submit . '</textarea>
                                
                        </div>
                        
                  </div>
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Pesan Form Di tutup
                        </div>
        		        <div class="col-md-8">
        		            <textarea type="text" class="form-control " data-id="" style="" onkeyup="pesan_tutup(this)"  onclick="pesan_tutup(this)" onmouseover="pesan_tutup(this)">' . $get_form->pesan_setelah_penutupan_form . '</textarea>
                                
                        </div>
                        
                  </div>
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Pisahkan form sesuai field
                        </div>
        		        <div class="col-md-8">
        		            <textarea type="text" class="form-control " data-id="" style="" onkeyup="pesan_tutup(this)"  onclick="pesan_tutup(this)" onmouseover="pesan_tutup(this)">' . $get_form->pesan_setelah_penutupan_form . '</textarea>
                                
                        </div>
                        
                  </div>
                 </div>
                </div>
                <script>
                    function title(e){
                        content = $(e).val();
                        utama(content,"nama_form");
                    }
                    function deskripsi(e){
                        content = $(e).val();
                        utama(content,"deskripsi");
                    }
                    function pesan_form(e){
                        content = $(e).val();
                        utama(content,"pesan_setelah_submit");
                    }
                    function pesan_tutup(e){
                        content = $(e).val();
                        utama(content,"pesan_setelah_penutupan_form");
                    }
                    function spreadshet_link(e){
                        content = $(e).val();
                        utama(content,"link_spreadsheet");
                    }
                    function spreadshet_sheet(e){
                        content = $(e).val();
                        utama(content,"sheet");
                    }
                </script>
                
          </div>
          <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab"> 
          <div class="card">
              <div class="card-body">
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Link Spreadsheet
                        </div>
        		        <div class="col-md-8">
        		            <input type="text" class="form-control content-  childchekbox" name="checklist_menu[]" value="1" data-id="" style="" onclick="spreadshet_link(this)"  onkeyup="spreadshet_link(this)" onmouseover="spreadshet_link(this)">
                                
                        </div>
                        
                  </div>
                  <div class="form-group row mb-5">
        		        <div class="col-md-4">
        		            Sheet
                        </div>
        		        <div class="col-md-8">
        		            <input type="text" class="form-control content-  childchekbox" name="checklist_menu[]" value="1" data-id="" style="" onclick="spreadshet_sheet(this)" onkeyup="spreadshet_sheet(this)" onmouseover="spreadshet_sheet(this)">
                                
                        </div>
                        
                  </div>
                 </div>
                </div>
          </div>
        </div>
          </div>';
		$content .= "
        <script>
        function tabChange() {
            var tabs = $('.nav-tabs > li');
            var active = tabs.filter('.active');
            var next = active.next('li').length? active.next('li').find('a') : tabs.filter(':first-child').find('a');
            next.tab('show');
        }
        </script>
        
	    ";
		return $content;
	}
	public static function list_table($page, $fai)
	{
		$content = "";
		$filename = isset($page['load']['crud_template']['list']['template_file']) ?
			($page['load']['crud_template']['list']['template_file'] ? $page['load']['crud_template']['list']['template_file'] : 'crud_list.template')
			: 'crud_list.template';
		$template_name = isset($page['load']['crud_template']['list']['template_name']) ?
			$page['load']['crud_template']['list']['template_name'] : 'tabler';
		$content_template = file_get_contents(__DIR__ . '/../../Pages/_template/' . $template_name . '/' . $filename . '.php');
		$content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
		$array_template = array(
			"SECTION-HEADER" => 'content_section_header',
			"BREADCUMB" => 'content_breadcumb',
			"PREFIX-BUTTON" => 'content_prefix_button',
			"ADD-BUTTON" => 'content_add_button',
			"IMPORTEXPORT-BUTTON" => 'content_importexport_button',
			"SUFFIX-BUTTON" => 'content_suffix_button',
			"SEARCH-TABLE" => 'content_search_table',
			"CONTENT-TABLE" => 'content_content_table',

		);
		$CRUDLISTFUNC = new CrudContentSection();
		foreach ($array_template as $key => $value) {

			if (strpos($content_template, "<$key></$key>"))
				$content_template = str_replace("<$key></$key>", $CRUDLISTFUNC->$value($page), $content_template);
		}
		$content .= (isset($page['file_open']) ? $page['file_open'] : '') . '' . $content_template . '' . (isset($page['file_closed']) ? $page['file_closed'] : '');

		$form_route = $fai->route($page['route'], ['hapus']);
		$form_route_list = $fai->route($page['route'], ['list', -1]);

		$content .= "
		<script>
			function show_import() {
				$('#import_content').show();
			}

			function list_from(Cari) {
				if (Cari == 'pdf') {

					window.location.href = " . "'" . $fai->route_r($page, $page['load']['route_page'], [$page['load']['apps'], $page['load']['page_view'], 'pdf', '-1']) . "'" . ";
				} else if (Cari == 'excel') {
					window.location.href = " . "'" . $fai->route_r($page, $page['load']['route_page'], [$page['load']['apps'], $page['load']['page_view'], 'excel', '-1']) . "'" . ";
				} else {


					$.ajax({
						type: 'get',
						data: $('#formlist_fai_framework').serialize() +
							'&Cari=' + Cari + '&id=' + '-1' +
							'&apps=' + $('#load_apps').val() +
							'&page_view=' + $('#load_page_view').val() +
							'&type=' + Cari +
							'&link_route=' + $('#load_link_route').val(),
						url: $('#load_link_route').val(),
						dataType: 'html',
						success: function(data) {
							$('#contentFaiFramework').html(data);
						},
						error: function(error) {
							console.log('error; ' + eval(error));
							//alert(2);
						}
					});
				}

			}

			 function list_imexport(Cari) {
				if (Cari == 'pdf') {

					window.location.href = " . "'" . $fai->route_r($page, $page['load']['route_page'], [$page['load']['apps'], $page['load']['page_view'], 'pdf', '-1']) . "'" . ";
				} else if (Cari == 'excel') {
					window.location.href = " . "'" . $fai->route_r($page, $page['load']['route_page'], [$page['load']['apps'], $page['load']['page_view'], 'excel', '-1']) . "'" . ";
				} else {


					$.ajax({
						type: 'get',
						data: $('#formlist_fai_framework').serialize() +
							'&Cari=' + Cari + '&id=' + '-1' +
							'&apps=' + $('#load_apps').val() +
							'&page_view=' + $('#load_page_view').val() +
							'&type=' + Cari +
							'&link_route=' + $('#load_link_route').val(),
						url: $('#load_link_route').val(),
						dataType: 'html',
						success: function(data) {
							$('#contentFaiFramework').html(data);
						},
						error: function(error) {
							console.log('error; ' + eval(error));
							//alert(2);
						}
					});
				}

			}
		</script>
		
		
		";


		return $content;
	}

	public static function total($page, $fai)
	{
		$content_utama = "";
		if (isset($page['crud']['row']['row'][0]))
			$data = $page['crud']['row']['row'][0];
		if (isset($page['crud']['total']['content'][0])) {
			$content_utama .= '<div class="row">';
			$content_utama .= '<div class="' . $page['crud']['total']['col-row'] . '">';
			for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {
				$content_total = "
		
				";
				$variable_data = $fai->nama_function($page, $page['title']);
				$row_total = (object) ['object' => 'foreach_1_row'];
				$id_toal = $page['crud']['total']['content'][$k]['id'];
				if (isset($page['crud']['total']['content'][$k]["add_button_multi"])) {
					$row_total = (object) ['object' => 'foreach_1_row'];
					if ($page['crud']['total']['content'][$k]["add_button_multi"]) {

						$database_total['utama'] = $page['database']['utama'] . '_' . $id_toal;
						$database_total['primary_key'] = null;
						if ((in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource')) {

							$database_total['where'][] = array(Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), '=', $data->primary_key);
							$variable_data = $id_toal;
							$row_total = $fai->database_coverter($page, $database_total, array(), 'all');
						} else if ((($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource')) {
							$database_total['where'][] = array(Database::converting_primary_key($page, $page['database']['utama'], 'primary_key'), '=', "$" . $fai->nama_function($page, $page['title']) . '->primary_key');

							$row_total = $fai->database_coverter($page, $database_total, array(), 'source');

							$content_utama .= '<?php ';
?>

							$sql="<?= $row_total; ?>";
							$<?= $id_toal ?>=DB::connection()->select($sql);
							foreach($<?= $id_toal ?> as $<?= $id_toal ?>){

<?php
							$content_utama .= '?>';

							$variable_data = $id_toal;
							$row_total = (object) ['object' => 'foreach_1_row'];
						}
					}
				}

				foreach ($row_total as $$id_toal) {
					$content_js = "";
					$content_get_for_total = array();
					$content_get_for_js = array();
					$value = array();
					$content_total .= '<div class="row mb-2">';
					$content_total .= '<div class="' . (isset($page['crud']['total']['content'][$k]["col_row"]) ? $page['crud']['total']['content'][$k]["col_row"][0] : 'col-4') . '">';
					$content_total .= $page['crud']['total']['content'][$k]['name'];
					$content_total .= '</div>';
					$content_total .= '<div class="' . (isset($page['crud']['total']['content'][$k]["col_row"]) ? $page['crud']['total']['content'][$k]["col_row"][1] : 'col-4') . '">';

					if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result') {


						$content_total .= '
			
							<div style="display:none" id="content-no_input-' . $page['crud']['total']['content'][$k]['id'] . '">
							<input type="number"  class="form-control" 
								id="' . $page['crud']['total']['content'][$k]['id'] . '_input-no_result" 
								onkeyup="math_' . $page['crud']['total']['content'][$k]['id'] . '(this)" 
								name="total_total_' . $page['crud']['total']['content'][$k]['id'] . '"  
								value="' . $valueinput . '">
							</div>';
					} else if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {

						$content_total .= '
		   
								<div <STYLE></STYLE> id="content-no_input-' . $page['crud']['total']['content'][$k]['id'] . '">
								<div class="row">
								<div class="col-4">
								';
						if (isset($page['crud']['total']['content'][$k]["with_input"])) {
							if ($page['crud']['total']['content'][$k]["with_input"]) {
								$array = ($page['crud']['total']['content'][$k]["array"]);
								for ($i = 0; $i < count($array); $i++) {
									$page['page_row'] = 'sub_kategori';
									if (in_array($page['crud']['view'], array('view')))
										$page['crud']['input_inline'] = 'disabled';
									$type = $array[$i][2];
									$return = CrudContent::typearray($page, $array, $i);
									$type = $return['type'];
									$visible = $return['visible'];
									$page['crud']['startdiv'] = '';
									$page['crud']['enddiv'] = '';
									$page['crud']['input_inline'] = ' data-id=<ID></ID>';
									$page['crud']['numbering'] = "<ID></ID>";
									$page['crud']['prefix_name'] = $page['crud']['total']['content'][$k]['id'] . '_';
									$page['crud']['sufix_name'] = "<NAME></NAME>";
									$page['crud']['input_inline'] = ' data-id=<ID></ID>';
									$page['crud']['type_form_asal'] = $return['type_form_asal'];

									if ($visible) {
										$extypearray = explode('-', $array[$i][2]);
										unset($page['crud']['no_input_value']);
										unset($page['crud']['set_input_value']);
										ob_start();

										$datavalue = $page['crud']['total']['content'][$k]['id'] . "_" . $array[$i][1];
										$text_value = 'GETVALUE_' . $datavalue;
										$tag_value = "<$text_value></$text_value>";
										$value[$k]['tag_value'][] = $tag_value;
										$value[$k]['datavalue'][] = $datavalue;
										$value[$k]['variable'][] = $variable_data;

										if ($type == 'select' or $type == 'select-manual')
											$value[$k]['selected'][] = array("type" => $type, "array" => $array[$i][3]);

										else
											$value[$k]['selected'][] = false;

										if ((($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') or (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource')) {


											$page['crud']['set_input_value']['tag'] = $tag_value;
											$page['crud']['set_input_value']['text_tag'] = $text_value;
										}
										$content_total .= "<WITHINPUT-TOTAL-" . $page['crud']['total']['content'][$k]['id'] . "-$i></WITHINPUT-TOTAL-" . $page['crud']['total']['content'][$k]['id'] . "-$i>";
										$content_get_for_total[$page['crud']['total']['content'][$k]['id']][$i] = preg_replace('/[\r\n]+/', '', CrudContent::form($page, $fai, $array, $i, $no, array()));
										unset($page['crud']['no_input_value']);
										unset($page['crud']['set_input_value']);
										if ((($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') or (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource')) {


											$page['crud']['no_input_value'] = true;
										}
										$content_get_for_js[$page['crud']['total']['content'][$k]['id']][$i] = preg_replace('/[\r\n]+/', '', CrudContent::form($page, $fai, $array, $i, $no, array()));;
									}
								}
							}
						}

						$datavalue = 'select_type_' . $page['crud']['total']['content'][$k]['id'];
						$text_value = 'GETVALUE_' . $datavalue;
						$tag_value = "<$text_value></$text_value>";
						$value[$k]['tag_value'][] = $tag_value;
						$value[$k]['datavalue'][] = $datavalue;
						$value[$k]['variable'][] = $variable_data;
						$value[$k]['selected'][] = array("type" => "select-manual", "array" => $page['crud']['total']['content'][$k]['select']);

						$content_total .= '
							</div>
									<div class="col-4">

										<select class="form-control"  id="' . $page['crud']['total']['content'][$k]['id'] . '_select-no_result<ID></ID>" 
										name="select_type_' . $page['crud']['total']['content'][$k]['id'] . '<NAME></NAME>" 
										onchange="change_select_input_no_result_multi_' . $page['crud']['total']['content'][$k]['id'] . '(this, <IDINPUT></IDINPUT>)">';
						foreach ($page['crud']['total']['content'][$k]['select'] as $key_multi => $value_multi) {
							$content_total .= '<option value="' . $value_multi . '" ' . "<$text_value-$value_multi></$text_value-$value_multi>" . ' >' . $value_multi . '</option>';
							$datavalue = 'total_' . $page['crud']['total']['content'][$k]['id'];
							$text_value = 'GETVALUE_' . $datavalue;
							$tag_value = "<$text_value></$text_value>";
							$value[$k]['tag_value'][] = $tag_value;
							$value[$k]['datavalue'][] = $datavalue;
							$value[$k]['variable'][] = $variable_data;
							$value[$k]['selected'][] = false;
						}

						$content_total .= '
										</select>
								</div>
								<div class="col-4">

										<input type="number"  class="form-control" 
											id="' . $page['crud']['total']['content'][$k]['id'] . '_input-no_result<ID></ID>" 
											onkeyup="math_' . $page['crud']['total']['content'][$k]['id'] . '(this,<IDINPUT></IDINPUT>)" 
											name="total_total_' . $page['crud']['total']['content'][$k]['id'] . '<NAME></NAME>"  
											value="' . $tag_value . '">
								</div>
						</div>
						</div>
						';
					}
					$content_total .= '</div>';
					$content_total .= '<div class="' . (isset($page['crud']['total']['content'][$k]["col_row"]) ? $page['crud']['total']['content'][$k]["col_row"][2] : 'col-4') . ' text-right">';
					if ($page['crud']['total']['content'][$k]["type"] == 'text') {
						$datavalue = '' . $page['crud']['total']['content'][$k]['id'];
						$text_value = 'GETVALUE_' . $datavalue;
						$tag_value = "<$text_value></$text_value>";
						$value[$k]['tag_value'][] = $tag_value;
						$value[$k]['datavalue'][] = $datavalue;
						$value[$k]['variable'][] = $variable_data;

						$value[$k]['selected'][] = false;
						$content_total .= '<strong><b><div id="' . $page['crud']['total']['content'][$k]['id'] . '_content">' . $tag_value . '</div></b></strong>';
						$content_total .= '<input type="hidden" name="total_' . $page['crud']['total']['content'][$k]['id'] . '" id="' . $page['crud']['total']['content'][$k]['id'] . '_input" value="' . $tag_value . '">';
					} else if ($page['crud']['total']['content'][$k]["type"] == 'input') {
						$name = $page['crud']['total']['content'][$k]['name'];
						$id_name = strtoupper(str_replace(" ", "_", $name));
						$eventInput = "";
						if (isset($page['crud']['total']['content'][$k]['eventInput'])) {
							foreach (($page['crud']['total']['content'][$k]['eventInput']) as $key_ei => $value_ei) {
								$eventInput = "$key_ei='$value_ei()'";
							}
						}
						$datavalue = '' . $page['crud']['total']['content'][$k]['id'];
						$text_value = 'GETVALUE_' . $datavalue;
						$tag_value = "<$text_value></$text_value>";
						$value[$k]['tag_value'][] = $tag_value;
						$value[$k]['datavalue'][] = $datavalue;
						$value[$k]['variable'][] = $variable_data;
						$value[$k]['selected'][] = false;

						$content_total .= '
							<div  id="to_display-' . $page['crud']['total']['content'][$k]['id'] . '"  >
								<a href="javascript:void(0)" onclick="click_' . $page['crud']['total']['content'][$k]['id'] . '()"   style="font-size:12px; font-weight:700;">+ Tambahkan ' . $page['crud']['total']['content'][$k]['name'] . '</a>
							</div>
							<div style="display:none" id="content-' . $page['crud']['total']['content'][$k]['id'] . '">
								<input type="number" ' . $eventInput . ' class="form-control" id="' . $page['crud']['total']['content'][$k]['id'] . '_input" onkeyup="input_' . $page['crud']['total']['content'][$k]['id'] . '" name="total_' . $page['crud']['total']['content'][$k]['id'] . '"  value="' . $tag_value . '">
							</div>';
						$content_js .= '
							<script> 
								function click_' . $page['crud']['total']['content'][$k]['id'] . '(){
									document.getElementById( "to_display-' . $page['crud']['total']['content'][$k]['id'] . '" ).style.display ="none";
									document.getElementById( "content-' . $page['crud']['total']['content'][$k]['id'] . '" ).style.display ="block";

									$("#to_display-' . $page['crud']['total']['content'][$k]['id'] . '").hide();
									$("#content-' . $page['crud']['total']['content'][$k]['id'] . '").show();
								}
								
							</script>
						';
						if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') {
							$content_js .= '
							<?php if($' . $variable_data . '->' . $datavalue . '){?>
								<script>
									click_' . $page['crud']['total']['content'][$k]['id'] . '()
								</script>
							<?php }?>
						';
						} else if (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource') {
							if ($data->$datavalue) {
								$content_js .= '<script>
									click_' . $page['crud']['total']['content'][$k]['id'] . '()
									</script>';
							}
						}
					} else if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result') {
						$name = $page['crud']['total']['content'][$k]['name'];
						$id_name = strtoupper(str_replace(" ", "_", $name));
						$eventInput = "";
						if (isset($page['crud']['total']['content'][$k]['eventInput'])) {
							foreach (($page['crud']['total']['content'][$k]['eventInput']) as $key_ei => $value_ei) {
								$eventInput = "$key_ei='$value_ei()'";
							}
						}
						$datavalue = '' . $page['crud']['total']['content'][$k]['id'];
						$text_value = 'GETVALUE_' . $datavalue;
						$tag_value = "<$text_value></$text_value>";
						$value[$k]['tag_value'][] = $tag_value;
						$value[$k]['datavalue'][] = $datavalue;
						$value[$k]['variable'][] = $variable_data;
						$content_total .= '
							<div  id="to_display-' . $page['crud']['total']['content'][$k]['id'] . '">
								<a href="javascript:void(0)" onclick="click_' . $page['crud']['total']['content'][$k]['id'] . '()"   style="font-size:12px; font-weight:700;">+ Tambahkan ' . $page['crud']['total']['content'][$k]['name'] . '</a>
							</div>
							<div style="display:none" id="content-' . $page['crud']['total']['content'][$k]['id'] . '">
								<strong><b><div id="' . $page['crud']['total']['content'][$k]['id'] . '_result">' . $tag_value . '</div></strong></b>
								<input type="hidden" ' . $eventInput . ' class="form-control" id="' . $page['crud']['total']['content'][$k]['id'] . '_input" onkeyup="input_' . $page['crud']['total']['content'][$k]['id'] . '" name="total_' . $page['crud']['total']['content'][$k]['id'] . '"  value="' . $tag_value . '">
							</div>';



						if (($page['crud']['type'] == 'edit_viewsource') and $page['section'] == 'viewsource') {
							$content_js .= '
								<?php if($' . $variable_data . '->' . $datavalue . '){?>
									<script>
										click_' . $page['crud']['total']['content'][$k]['id'] . '()
									</script>
								<?php }?>
							';
						} else if (($page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') {
							$content_js .= '
								
									<script>
										click_' . $page['crud']['total']['content'][$k]['id'] . '()
									</script>
								
							';
						} else if (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource') {
							if ($data->$datavalue) {
								$content_js .= '<script>
						click_' . $page['crud']['total']['content'][$k]['id'] . '()
						</script>';
							}
						}
						$content_js .= '
							<script>
								function click_' . $page['crud']['total']['content'][$k]['id'] . '(){
									document.getElementById( "to_display-' . $page['crud']['total']['content'][$k]['id'] . '" ).style.display ="none";
									document.getElementById( "content-no_input-' . $page['crud']['total']['content'][$k]['id'] . '" ).style.display ="block";
									document.getElementById( "content-' . $page['crud']['total']['content'][$k]['id'] . '" ).style.display ="block";

									$("#to_display-' . $page['crud']['total']['content'][$k]['id'] . '").hide();
									$("#content-no_input-' . $page['crud']['total']['content'][$k]['id'] . '").show();
									$("#content-' . $page['crud']['total']['content'][$k]['id'] . '").show();

								}
							
								function math_' . $page['crud']['total']['content'][$k]['id'] . '(e){
									var thisvalue = $(e).val();
							';

						foreach ($page['crud']['total']['content'][$k]['function_js']['get'] as $key => $value_js) {
							$content_total .= 'var ' . $key . '=';
							if ($value_js == 'id') {
								$content_js .= '$("#' . $key . '").val();
						';
							} else if ($value_js == 'class') {
								$content_js .= '$(".' . $key . '").val();
						';
							} else if ($value_js == 'id_row') {
								$content_js .= '$("#' . $key . '"+id_row).val();
						';
							}
						}
						for ($l = 0; $l < count($page['crud']['total']['content'][$k]['function_js']['execute']); $l++) {

							if ($page['crud']['total']['content'][$k]['function_js']['execute'][$l]['type'] == 'math') {
								$content_js .= 'var ' . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['var'];
								$content_js .= '=';
								$content_js .= $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['math'];
								$content_js .= ';';
								// echo 'alert("'.$page['crud']['total']['content'][$k]['function_js']['execute'][$l]['var'].'="+'.$page['crud']['total']['content'][$k]['function_js']['execute'][$l]['var'].');';
							} else 
					if ($page['crud']['total']['content'][$k]['function_js']['execute'][$l]['type'] == 'sum') {
								$content_js .= 'var sum_' . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['sum'] . ' = 0;';
								$content_js .= "
							 $('." . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['sum'] . "').each(function(){
								nilai = parseFloat($(this).val());
								if(!nilai) 
									nilai=0;
									
								sum_" . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['sum'] . " += parseFloat(nilai);  
							});";
								$content_js .= 'var ' . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['var'];
								$content_js .= '=';
								$content_js .= 'sum_' . $page['crud']['total']['content'][$k]['function_js']['execute'][$l]['sum'];
								$content_js .= ';';
							}
						}
						$content_js .= '
							$("#' . $page['crud']['total']['content'][$k]['id'] . '_input").val(result);
							$("#' . $page['crud']['total']['content'][$k]['id'] . '_result").html(result);
							';
						for ($cf = 0; $cf < count($page['crud']['total']['content'][$k]['function_js']['call_function']); $cf++) {
							$content_js .= $page['crud']['total']['content'][$k]['function_js']['call_function'][$cf] . '();';
						}
						$content_js .= '
								}
							</script>';
					} else if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {

						$name = $page['crud']['total']['content'][$k]['name'];
						$id_name = strtoupper(str_replace(" ", "_", $name));
						$eventInput = "";
						if (isset($page['crud']['total']['content'][$k]['eventInput'])) {
							foreach (($page['crud']['total']['content'][$k]['eventInput']) as $key_ei => $value_ei) {
								$eventInput = $key_ei . '=' . '"' . $value_ei . '()' . '"';
							}
						}

						$datavalue = '' . $page['crud']['total']['content'][$k]['id'];
						$text_value = 'GETVALUE_' . $datavalue;
						$tag_value = "<$text_value></$text_value>";
						$value[$k]['tag_value'][] = $tag_value;
						$value[$k]['datavalue'][] = $datavalue;
						$value[$k]['variable'][] = $variable_data;
						$value[$k]['selected'][] = false;
						$content_total .= ' 

				
							<div <STYLE></STYLE> class="text-right" id="content-' . $page['crud']['total']['content'][$k]['id'] . '">
								<strong><b><div id="' . $page['crud']['total']['content'][$k]['id'] . '_result<ID></ID>">' . $tag_value . '</div></strong></b>
								<input type="hidden" ' . $eventInput . ' 
									class="form-control ' . $page['crud']['total']['content'][$k]['id'] . ' ' . $page['crud']['total']['content'][$k]['id'] . '_class<ID></ID>" 
									id="' . $page['crud']['total']['content'][$k]['id'] . '_input<ID></ID>" 
									onkeyup="input_' . $page['crud']['total']['content'][$k]['id'] . '()" 
									name="total_' . $page['crud']['total']['content'][$k]['id'] . '<NAME></NAME>"  value="' . $tag_value . '">
								
							</div>';
						if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') {
							$content_js .= '
						<?php if($' . $variable_data . '->' . $datavalue . '){?>
							<script>
								click_' . $page['crud']['total']['content'][$k]['id'] . '()
							</script>
						<?php }?>
					';
						} else if (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource') {
							if ($data->$datavalue) {
								$content_js .= '<script>
						click_' . $page['crud']['total']['content'][$k]['id'] . '()
						</script>';
							}
						}


						$content_multi = preg_replace('/[\r\n]+/', '', $content_total);


						if (count($content_get_for_total)) {
							foreach ($content_get_for_total as $key_for_total => $kft) {
								foreach ($content_get_for_total[$key_for_total] as $i_for_total => $kft) {

									$content_total = str_replace("<WITHINPUT-TOTAL-$key_for_total-$i_for_total></WITHINPUT-TOTAL-$key_for_total-$i_for_total>", $content_get_for_total[$key_for_total][$i_for_total], $content_total);
									$content_multi = str_replace("<WITHINPUT-TOTAL-$key_for_total-$i_for_total></WITHINPUT-TOTAL-$key_for_total-$i_for_total>", $content_get_for_js[$key_for_total][$i_for_total], $content_multi);
								}
							}
						}

						$content_total = str_replace("<STYLE></STYLE>", 'style="display:none"', $content_total);
						$content_multi = str_replace("<STYLE></STYLE>", '', $content_multi);
						if (isset($page['crud']['total']['content'][$k]['add_button_multi'])) {
							$content_total = str_replace("<ID></ID>", '0', $content_total);
							$content_total = str_replace("<IDINPUT></IDINPUT>", '0', $content_total);
							$content_multi = str_replace("<ID></ID>", "'+nomor_" . $page['crud']['total']['content'][$k]['id'] . "+'", $content_multi);
							$content_multi = str_replace("<IDINPUT></IDINPUT>", "'+nomor_" . $page['crud']['total']['content'][$k]['id'] . "+'", $content_multi);
						} else {
							$content_total = str_replace("<ID></ID>", '', $content_total);
							$content_total = str_replace("<IDINPUT></IDINPUT>", "''", $content_total);
							$content_multi = str_replace("<ID></ID>", "", $content_multi);
							$content_multi = str_replace("<IDINPUT></IDINPUT>", "''", $content_multi);
						}


						if (isset($page['crud']['total']['content'][$k]['add_button_multi'])) {
							if (($page['crud']['total']['content'][$k]['add_button_multi'])) {
								$content_total = str_replace("<NAME></NAME>", '[]', $content_total);
								$content_multi = str_replace("<NAME></NAME>", '[]', $content_multi);
							} else {


								$content_total = str_replace("<NAME></NAME>", '', $content_total);
								$content_multi = str_replace("<NAME></NAME>", '', $content_multi);
							}
						} else {

							$content_total = str_replace("<NAME></NAME>", '', $content_total);
							$content_multi = str_replace("<NAME></NAME>", '', $content_multi);
						}



						$content_total .= '<div  id="to_display-' . $page['crud']['total']['content'][$k]['id'] . '">
								<a href="javascript:void(0)" onclick="click_' . $page['crud']['total']['content'][$k]['id'] . '()"   style="font-size:12px; font-weight:700;">+ Tambahkan ' . $page['crud']['total']['content'][$k]['name'] . '</a>
							</div>	';

						$content_js .= '
							<script>
							var nomor_' . $page['crud']['total']['content'][$k]['id'] . '=0;
								function click_' . $page['crud']['total']['content'][$k]['id'] . '(){
									$("#to_display-' . $page['crud']['total']['content'][$k]['id'] . '").hide();
									$("#content-no_input-' . $page['crud']['total']['content'][$k]['id'] . '").show();
									$("#content-' . $page['crud']['total']['content'][$k]['id'] . '").show();
									$("#to_display_multi_button-' . $page['crud']['total']['content'][$k]['id'] . '").show();
								}
								function change_select_input_no_result_multi_' . $page['crud']['total']['content'][$k]['id'] . '(e,id_row){
									$("#' . $page['crud']['total']['content'][$k]['id'] . '_input-no_result"+id_row).val(0);
									math_' . $page['crud']['total']['content'][$k]['id'] . '(e,id_row);
								}
								function math_' . $page['crud']['total']['content'][$k]['id'] . '(e,id_row){';
						$content_js .= '
							var thisvalue = $("#' . $page['crud']['total']['content'][$k]['id'] . '_input-no_result"+id_row).val();
							
							';
						foreach ($page['crud']['total']['content'][$k]['select'] as $key_multi => $value_multi) {
							if ($key_multi > 0)
								$content_js .= 'else ';
							$content_js .= 'if($("#' . $page['crud']['total']['content'][$k]['id'] . '_select-no_result"+id_row).val() =="' . $value_multi . '"){
							
							';

							foreach ($page['crud']['total']['content'][$k]['function_js'][$value_multi]['get'] as $key => $value_js) {
								$content_js .= 'var ' . $key . '=';
								if ($value_js == 'id') {
									$content_js .= '$("#' . $key . '").val();
									';
								} else if ($value_js == 'class') {
									$content_js .= '$(".' . $key . '").val();
									';
								} else if ($value_js == 'id_row') {
									$content_js .= '$("#' . $key . '"+id_row).val();
									';
								}
							}
							for ($l = 0; $l < count($page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute']); $l++) {

								if ($page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['type'] == 'math') {
									$content_js .= 'var ' . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['var'];
									$content_js .= '=';
									$content_js .= $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['math'];
									$content_js .= ';';
									//$content_js .= 'alert("'.$page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['var'].'="+'.$page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['var'].');';
								} else if ($page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['type'] == 'sum') {
									$content_js .= 'var sum_' . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['sum'] . ' = 0;';
									$content_js .= "
										$('." . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['sum'] . "').each(function(){
											nilai = parseFloat($(this).val());
											if(!nilai)
												nilai=0;
												
											sum_" . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['sum'] . " += parseFloat(nilai);  
										});";
									$content_js .= 'var ' . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['var'];
									$content_js .= '=';
									$content_js .= 'sum_' . $page['crud']['total']['content'][$k]['function_js'][$value_multi]['execute'][$l]['sum'];
									$content_js .= ';';
								}
							}
							$content_js .= '
									$("#' . $page['crud']['total']['content'][$k]['id'] . '_input"+id_row).val(result);
									$("#' . $page['crud']['total']['content'][$k]['id'] . '_result"+id_row).html(result);
									';
							for ($cf = 0; $cf < count($page['crud']['total']['content'][$k]['function_js'][$value_multi]['call_function']); $cf++) {
								$content_js .= $page['crud']['total']['content'][$k]['function_js'][$value_multi]['call_function'][$cf] . '();';
							}
							$content_js .= '
								}
								';
						}
						$content_js .= '
							}
							</script>';
					}
					$content_total .= '</div>';
					$content_total .= '</div>';
					if (isset($page['crud']['total']['content'][$k]['add_button_multi'])) {
						if (($page['crud']['total']['content'][$k]['add_button_multi'])) {
							$content_total .= '
								<div id="content_multi_button-' . $page['crud']['total']['content'][$k]['id'] . '"></div>
								<div id="to_display_multi_button-' . $page['crud']['total']['content'][$k]['id'] . '" style="display:none" class="text-right">

									<a href="javascript:void(0)" onclick="add_multi_' . $page['crud']['total']['content'][$k]['id'] . '()"   style="font-size:12px; font-weight:700;">+ Tambahkan ' . $page['crud']['total']['content'][$k]['name'] . '</a>
								</div>
							';
							$content_js .= '
								<script>
									function add_multi_' . $page['crud']['total']['content'][$k]['id'] . '(){
										nomor_' . $page['crud']['total']['content'][$k]['id'] . '++;
										$("#content_multi_button-' . $page['crud']['total']['content'][$k]['id'] . '").append(' . "'$content_multi'" . ');
									}
								</script>';
						}
					}
					$content_total .= '<hr>';
					if (isset($value[$k])) {
						$kk = $k;
						for ($ik = 0; $ik < count($value[$kk]['tag_value']); $ik++) {
							$change_value = 0;
							$tag_value = $value[$kk]['tag_value'][$ik];
							$datavalue = $value[$kk]['datavalue'][$ik];
							if ($page['crud']['type'] == 'all_viewsource' and $page['section'] == 'viewsource')
								$change_value = '<?=($page!="tambah"?$help->rupiah($' .  $value[$kk]['variable'][$ik] . '->' . $datavalue . '):"");?>';
							else if (($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource') {

								if (!$value[$kk]['selected'][$ik])
									$change_value = '<?=$help->rupiah($' . $value[$kk]['variable'][$ik] . '->' . $datavalue . ',\'\')?>';
								else {
									if ($value[$kk]['selected'][$ik]['type'] == 'select-manual') {
										foreach ($value[$kk]['selected'][$ik]['array'] as $key_selected => $value_selected) {
											$tag_value = "GETVALUE_" . $value[$kk]['datavalue'][$ik] . "-" . $value_selected;
											$tag_value = "<$tag_value></$tag_value>";
											$change_value = '<?=$' . $value[$kk]['variable'][$ik] . '->' . $datavalue . '=="' . $value_selected . '" ?"selected":""?>';
											$content_total = str_replace($tag_value, $change_value, $content_total);
										}
									} else {
										if (!$value[$kk]['selected'][$ik]['array'][1]) {
											$value[$kk]['selected'][$ik]['array'][1] = Database::converting_primary_key($page, $value[$kk]['selected'][$ik]['array'][0], 'ontable');
										}
										$change_value = '<?=$' . $value[$kk]['variable'][$ik] . '->' . $datavalue . '==$dataoption->' . $value[$kk]['selected'][$ik]['array'][1] . ' ?"selected":""?>';
									}
								}
							} else if (in_array($page['crud']['view'], array('edit', 'view')) and $page['section'] != 'viewsource') {

								$to_data = $value[$kk]['variable'][$ik];
								$change_value = $data->$datavalue;
							}

							$content_total = str_replace($tag_value, $change_value, $content_total);
						}
					}

					$content_utama .= $content_total;
				}
				if (isset($page['crud']['total']['content'][$k]["add_button_multi"])) {

					if ($page['crud']['total']['content'][$k]["add_button_multi"]) {

						if ((($page['crud']['type'] == 'edit_viewsource' or $page['crud']['type'] == 'view_viewsource') and $page['section'] == 'viewsource')) {
							$content_utama .= '
			
			<?php }?>';
						}
					}
				}
				$content_utama .= '' . $content_js;
			}
			$content_utama .= '</div>';
			$content_utama .= '</div>';
		}
		return $content_utama;
	}


	public static function import($fai, $page)
	{

		$content = '
		<div class="card">
		<div class="card-header">

		<ul class="nav nav-tabs" id="myTab" role="tablist">
		';
		foreach ($page['crud']['import_export']['setting'] as $key => $values) {

			$content .= '
			<li class="nav-item" role="presentation">
			<button class="nav-link active" id="import' . $key . '-tab" data-bs-toggle="tab" data-bs-target="#import' . $key . '" type="button" role="tab" aria-controls="import' . $key . '" aria-selected="true">' . $values['nama_format'] . '</button>
			</li>';
		}
		$content .= '
		
		</ul>
		</div>
		<div class="card-body">
		<div class="tab-content" id="myTabContent">
		';
		//  
		foreach ($page['crud']['import_export']['setting'] as $key => $values) {
			$content .= '<div class="tab-pane fade show active" id="import' . $key . '" role="tabpanel" aria-labelledby="import' . $key . '-tab">
			<a href=' . "'" . ($fai->route_v($page, $page['route'], ['template_import', $key])) . "'" . ' target="_blank">Template import ' . $values['nama_format'] . '</a>

			<form action="' . ($fai->route_v($page, $page['route'], ['execution_import', $key])) . '" enctype="multipart/form-data" method="post">
				<div class="mb-3">
					<label for="exampleFormControlInput1" class="form-label">File Import</label>
					<input type="file" class="form-control" id="" name="file_import" placeholder="">
				</div>
				<button type="submit" class="btn btn-primary">Import</button>
				
				<a  href=' . "'" . ($fai->route_v($page, $page['route'], ['list', -1])) . "'" . ' type="button" class="btn btn-dark">Kembali</a>
			</form>

			</div>';
		}
		$content .= '
			</div>
			</div>
			</div>

';


		return $content;
	}


	public static function execution_import($fai, $page, $id)
	{
		$file = $fai->input('file_import', '_FILES');
		$tujuan_upload = 'Export';

		$name = 'import-excel-' . $page['title'] . date('YmdHis') . '-' . $file['name'];
		$uploadFilePath = $tujuan_upload . '/' . $name;
		move_uploaded_file($file['tmp_name'], $uploadFilePath);

		$inputFileType = ucfirst(pathinfo($uploadFilePath, PATHINFO_EXTENSION));;
		//    $inputFileType = 'Xlsx';
		//    $inputFileType = 'Xml';
		//    $inputFileType = 'Ods';
		//    $inputFileType = 'Slk';
		//    $inputFileType = 'Gnumeric';
		//    $inputFileType = 'Csv';

		/**  Create a new Reader of the type defined in $inputFileType  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
		/**  Load $inputFileName to a Spreadsheet Object  **/
		$spreadsheet = $reader->load($uploadFilePath);

		$sheetData = $spreadsheet->getActiveSheet(0)->toArray(null, true, true, true);

		$array_data = [];
		$temp = [];


		foreach ($sheetData[1] as $key_2 => $values_2) {
			if (isset($page['crud']['import_export']['setting'][$id]['format'][$values_2]))
				$columInit[$key_2] = $page['crud']['import_export']['setting'][$id]['format'][$values_2];
		}
		$literasi = -1;
		$literasi_combine = -1;
		for ($j = 2; $j <= count($sheetData); $j++) {
			print_R($sheetData[$j]);
			$literasi_combine++;
			$true = true;
			foreach ($sheetData[$j] as $key_2 => $values_2) {
				if (isset($columInit[$key_2][1])) {
					if ($columInit[$key_2][1]) {


						if (!isset($temp[$key_2])) {
							$temp[$key_2] = '';
						}
						if ($temp[$key_2] != $values_2) {
							$true = false;
							echo $key_2;
						}
					}
				}
			}
			if (!$true) {
				$literasi++;

				$literasi_combine = -1;
				foreach ($sheetData[$j] as $key_2 => $values_2) {
					if (isset($columInit[$key_2][1])) {
						if ($columInit[$key_2][1]) {
							$temp[$key_2] =  $values_2;
						}
					}
				}
			}
			$literasi_combine++;
			foreach ($columInit as $key_a => $value_a) {
				if (!$value_a[1])
					$array_data[$literasi]['combine'][$literasi_combine][$value_a[0]] = $sheetData[$j][$key_a];
				else
					$array_data[$literasi]['data'][$value_a[0]] = $sheetData[$j][$key_a];
			}
		}

		foreach ($array_data as $key => $values) {
			$page['save']['section'] = "utama";
			$return = CRUDFunc::declare_crud_variable($fai, $page, $array_data[$key]['data'], $page['database']['utama'], 'get_execution_import', [], []);

			$id_last = CRUDFunc::crud_insert($fai, $page, $return['$sqli'], [], $page['database']['utama'], []);
			foreach ($array_data[$key]['combine'] as $key_sub => $values_sub) {

				$page['save']['section'] = "sub_kategori";
				$return = CRUDFunc::declare_crud_variable($fai, $page, $array_data[$key]['combine'][$key_sub], $page['crud']['import_export']['setting'][$id]['combine_sub_kategori'], 'get_execution_import', [], []);
				$return['$sqli']['id_' . $page['database']['utama']] = $id_last;
				CRUDFunc::crud_insert($fai, $page, $return['$sqli'], [], $page['crud']['import_export']['setting'][$id]['combine_sub_kategori'], []);
			}
		}
		die;
	}


	public static function template_import($fai, $page, $id)
	{

		$spreadsheet = new Spreadsheet;
		$sheet = $spreadsheet->getActiveSheet();
		$y = 0;
		$sheet_number = 0;
		$sheet->setCellValue($fai->toAlpha($y) . '1', 'No');
		$y++;
		$sheet2 = $spreadsheet->createSheet();
		$sheet2->setTitle('OptionSheet');
		$z = 0;
		$array = $page['crud']['array'];
		foreach ($page['crud']['import_export']['setting'][$id]['format'] as $key => $values) {
			$sheet->setCellValue($fai->toAlpha($y) . '1', $key);
			$sheet->getColumnDimension($fai->toAlpha($y))->setAutoSize(true);
			if ($values[1]) {
				$i = $page['crud']['field_array'][$values[0]];
				if ($array[$i][2] == 'select') {
					$field = $array[$i][1];
					$option_select = $array[$i][3];
					$database_select = $option_select[0];
					$key_select = $option_select[1];

					$page['select_database_costum'][$field]['utama'] = $database_select;
					$page['select_database_costum'][$field]['primary_key'] = $key_select;

					$value_select = $option_select[2];
					$rowoption = $fai->database_coverter($page, $page['select_database_costum'][$field], array());
					$col = 0;
					foreach ($rowoption as $dataoption) {

						$sheet2->setCellValue($fai->toAlpha($z) . $col, $dataoption->$key_select . '||' . $dataoption->$value_select);
						$col++;
					}
					$key;
					$dataRange = "'OptionSheet'!" . $fai->toAlpha($z) . '0:' . $fai->toAlpha($z) . $col;

					for ($baris = 1; $baris < 1000; $baris++) {

						$validation = $sheet->getCell($fai->toAlpha($y) . $baris)->getDataValidation();
						$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
						$validation->setAllowBlank(false);
						$validation->setFormula1($dataRange);
						$validation->setShowDropDown(true);
					}
					$z++;
				} else if ($array[$i][2] == 'select-manual' or $array[$i][2] == 'radio2-manual') {

					for ($baris = 1; $baris < 1000; $baris++) {
						$validation = $sheet->getCell($fai->toAlpha($y) . $baris)->getDataValidation();
						$option = $array[$i][3];
						$formula = "";
						foreach ($option as $key => $value) {
							$formula .= $value . ',';
						}

						$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
						$validation->setFormula1('"' . $formula . '"');
						$validation->setAllowBlank(false);

						$validation->setShowDropDown(true);

						$validation->setShowInputMessage(true);

						$validation->setPromptTitle('Note');

						$validation->setPrompt('Must select one from the drop down options.');
					}
				}
			}
			$y++;
		}
		$type = 'xlsx';
		if ($type == 'xlsx') {
			$writer = new Xlsx($spreadsheet);
		} else if ($type == 'xls') {
			$writer = new Xls($spreadsheet);
		}
		$fileName = $page['title'] . date('YmdHis') . "." . $type;
		$writer->save("Export/" . $fileName);

		header("Content-Type: application/vnd.ms-excel");
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private', false); // required for certain browsers 
		//header('Content-Type: application/pdf');

		header('Content-Disposition: attachment; filename="' . basename($fileName) . '";');
		header('Content-Transfer-Encoding: binary');
		//header('Content-Length: ' . filesize($fileName));

		readfile("Export/" . $fileName);
		die;
	}
}

class CrudContentSection
{

	public static function content_section_header($page)
	{
		return '<div class="mb-3 ' . (isset($page['load']['crud_template']['class']['section_header']) ? $page['load']['crud_template']['class']['section_header'] : '') . '" style="' . (isset($page['load']['crud_template']['style']['section_header']) ? $page['load']['crud_template']['style']['section_header'] : '') . '">
            <h3 class="mb-0 "> ' . ($page['section'] == 'viewsource' ? '<?=ucwords($page);?> ' : '') . $page['title'] . '</h3>
        </div>';
	}

	public static function content_breadcumb($page)
	{
		return '
        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">' . $page['title'] . '</li>
                        </ol>
        ';
	}
	public static function content_breadcumb_vte($page)
	{
		if (!isset($page['route'])) {
			$page['route'] = $page['load']['page_view'];
		}
		$fai = new MainFaiFramework();
		$form_route = $fai->route(($page['section'] == 'viewsource' ? '' : '') . $page['route'], ['list', -1]);
		return '
        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="' . $form_route . '">' . $page['title'] . '</a></li>
                            <li class="breadcrumb-item active">' . $page['crud']['type'] . '</li>
                        </ol>
        ';
	}

	public static function content_prefix_button($page)
	{
		return '';
	}

	public static function content_add_button($page)
	{
		$fai = new MainFaiFramework();
		$content = '';
		if (isset($page['crud']['list_table_view_layout'])) {
			$function = "change_view_layout_crud";
		} else {
			$function = "reachpage";
		}
		if (!isset($page['crud']['no_add'])) {
			$content .= '
            <div class="' . (isset($page['load']['crud_template']['class']['button_add_prefix']) ? $page['load']['crud_template']['class']['button_add_prefix'] : 'col-md-2') . '"  style="' . (isset($page['load']['crud_template']['style']['button_add_prefix']) ? $page['load']['crud_template']['style']['button_add_prefix'] : 'col-md-2') . '">
                <a 
				 href=' . "'" . ($fai->route_v($page, $page['route'], ['tambah', -1])) . "'" . '
					class="' . (isset($page['load']['crud_template']['class']['button_add']) ? $page['load']['crud_template']['class']['button_add'] : 'btn btn-primary text-white') . '" 
                  
                > ' . (isset($page['load']['crud_template']['text']['tambah']) ? $page['load']['crud_template']['text']['tambah'] : 'Tambah ') . ' </a>
            </div>';
		}

		if (!isset($page['crud']['no_setting']) and !($page['load_section'] == 'viewsource')) {
			$content .= '
            <div class="' . (isset($page['load']['crud_template']['class']['button_add_prefix']) ? $page['load']['crud_template']['class']['button_add_prefix'] : 'col-md-2') . '">
                <a class="' . (isset($page['load']['crud_template']['class']['button_add']) ? $page['load']['crud_template']['class']['button_add'] : 'btn btn-primary') . '" 
                    ' . ($page['section'] == 'viewsource' ? 'href="<?=url(' . "'" . $fai->route($page['route'], ['tambah', -1]) . "')?>" . '"' : 'onclick="' . $function . '(' . "'" . $page['route'] . "'" . ',' . "'" . 'setting' . "'" . ',-1)"') . '
                > ' . (isset($page['load']['crud_template']['text']['tambah']) ? $page['load']['crud_template']['text']['tambah'] : 'Setting') . ' </a>
            </div>';
		}
		// Partial::link_direct($page,$page['load']['link_route'],[$page['load']['apps'],$page['load']['page_view'],$page['load']['type'],$page['load']['id'],$page['load']['menu'],$page['load']['nav']]))
		if (isset($page['add']['link'])) {
			$content .= '
                <div class="col-md-2">
                    <a class="' . (isset($page['load']['crud_template']['class']['button_add']) ? $page['load']['crud_template']['class']['button_add'] : 'btn btn-primary') . '" href="' . $page['add']['link'] . '"> ' . $page['add']['text'] . '</a>
                </div>';
		}



		return $content;
	}

	public static function content_importexport_button($page)
	{
		$fai = new MainFaiFramework();

		$form_route = $fai->route(($page['section'] == 'viewsource' ? 'post_' : '') . $page['route'], ['list', -1]);

		$content = '<form method="POST" id="formimexport_fai_framework" enctype="multipart/form-data" ' . ($page['section'] == 'viewsource' ? 'action="<?=url("' . $form_route . '");?>' : '') . '>
      
       ';
		if ($page['section'] == 'viewsource') {
			$content .= ' @csrf';
		}
		if (!isset($page['crud']['no_pdf'])) {

			$content .= '
			<div class=" text-right right">
			<button ' . ($page['section'] == 'viewsource' ? 'type="submit"' :
				'onclick="list_imexport(' . "'" . "pdf" . "'" . ')" type="button"'
			)
				. '  value="pdf" name="Cari" 
			class="' . (isset($page['load']['crud_template']['class']['pdf']) ? $page['load']['crud_template']['class']['pdf'] : 'btn btn-primary') . ' "
			>' . (isset($page['load']['crud_template']['text']['PDF']) ? $page['load']['crud_template']['text']['PDF'] : 'PDF') . ' </button>';
		}
		if (!isset($page['crud']['no_excel'])) {
			$content .= '
                    <button ' . ($page['section'] == 'viewsource' ? 'type="submit"' :
				'onclick="list_imexport(' . "'" . "excel" . "'" . ')" type="button"'
			)
				. '   value="excel" name="Cari" class="' . (isset($page['load']['crud_template']['class']['excel']) ? $page['load']['crud_template']['class']['excel'] : 'btn btn-primary') . ' ">' . (isset($page['load']['crud_template']['text']['excel']) ? $page['load']['crud_template']['text']['excel'] : 'Excel') . ' </button>
        
                                     ';
		}
		if (isset($page['import_export']) and !isset($page['crud']['no_import'])) {

			$content .= '
                <button 
                ' . ($page['section'] == 'viewsource' ? 'type="submit"' :
				'onclick="list_imexport(' . "'" . "excel" . "'" . ')" type="button"'
			)
				. ' value="export_empty" name="Cari"
                class="' . (isset($page['load']['crud_template']['class']['button_import_export']) ? $page['load']['crud_template']['class']['button_import_export'] : 'btn btn-primary') . '" >
                ' . (isset($page['load']['crud_template']['text']['template']) ? $page['load']['crud_template']['text']['template'] : 'Template') . ' 
                 </button>
           ';
			// $content .='</form>';

			$content .= '
                <a  href=' . "'" . ($fai->route_v($page, $page['route'], ['import', -1])) . "'" . ' type="button" 
                class="' . (isset($page['load']['crud_template']['class']['button_import_export']) ? $page['load']['crud_template']['class']['button_import_export'] : 'btn btn-primary') . '" >
                ' . (isset($page['load']['crud_template']['text']['Import']) ? $page['load']['crud_template']['text']['Import'] : 'Import') . '  
                 </a>
                 
            
            ';
		}
		$content .= '</div>
        
        <div id="import_content" style="display:none;width: 64%;float: right;"> 
                    
                    <input type="file" class="form-control" name="excel" >
                    <button ' . ($page['section'] == 'viewsource' ? 'type="submit"' :
			'onclick="list_imexport(' . "'" . "excel" . "'" . ')" type="button"'
		)
			. ' value="import_excel" name="Cari" style="float: right;"   class="' . (isset($page['load']['crud_template']['class']['submit import']) ? $page['load']['crud_template']['class']['submit import'] : 'btn btn-primary') . ' ">Submit</button>
                 </div>
        
        ';

		$content .= '</form>';
		return $content;
	}

	public static function content_suffix_button($page)
	{
		return '';
	}

	public static function content_search_table($page)
	{
		$fai = new MainFaiFramework();
		$content = '';
		$content .= '<form id="formlist_fai_framework"  method="get" enctype="multipart/form-data">
                            <div class="row">';

		if (isset($page['crud']['search'])) {

			$content .= CrudContent::search($page, $fai);;
			$content .= '</div>
                            ';

			if (count($page['crud']['search'])) {
				$content .= '
                                <a href="' . $fai->route_v($page, $page['route'], ['list', '-1']) . '" class="btn btn-primary">Reset</a>
                                <button ' . ($page['section'] == 'viewsource' ? 'type="submit"' :
					'onclick="list_from(' . "'" . "list" . "'" . ')" type="button" ') . ' value="list" name="Cari" class="btn btn-primary">Cari</button>
                            ';
			}
		}
		';
                        </form>';
		return $content;
	}

	public static function content_vte_main($page)
	{

		$fai = new MainFaiFramework();
		// ob_start();
		// $fai->view('crud/vte_main.blade.php', $page);
		$content = CrudContent::vte_main($page, $fai);
		return $content;
	}

	public static function content_button_vte($page)
	{
		$fai = new MainFaiFramework();
		$content = '
        <div id="pesanSubmit"></div>
        <div class="">';
		if ($page['section'] == 'select-other') {
			$content = "";
		} else {
			$tampil = true;
			if (Partial::input('no_button_vte') == 'not') {
				$tampil = false;
			}
			if (isset($page['crud']['list_table_view_layout'])) {
				$function = (isset($page['load']['card']['button_save']['function']) ? $page['load']['card']['button_save']['function'] : 'submit_form_layout_crud') . "" . '(' . "'" . $page['load']['route_page'] . "'," . "'" . $page['crud']['form_route'] . "'," . "'" . $page['load']['id'] . "'" . ')"';
			} else {
				$function = (isset($page['crud']['submit_form']) ? $page['crud']['submit_form'] : 'submit_form') . "" . '(' . "'" . $page['crud']['form_route'] . "'" . ')';
			}
			if ($tampil) {
				if (in_array($page['crud']['view'], array('edit', 'tambah', 'edit_approval'))) {

					$content .= ' <button class="' . (isset($page['load']['crud_template']['class']['button_save']) ? $page['load']['crud_template']['class']['button_save'] : 'btn btn-primary') . '" 
                                ' . ($page['section'] == 'viewsource' ? 'type="button" onclick="form_action_submit()"' : ' type="button" onclick="' . $function . '"') . '
								
                             >
                            
										' . (isset($page['load']['crud_template']['text']['save']) ? $page['load']['crud_template']['text']['save'] : 'Save') . '									
                            </button>';
				}

				if (in_array($page['crud']['view'], array('edit', 'view')) or isset($page['crud']['button_approve_on_edit'])) {
					if (in_array($page['crud']['view'], array('edit', 'view'))) {

						$content .= '    <a href="' . Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], 'PDFPage', 'page:id']) . '"  target="_blank" 
                        class="' . (isset($page['load']['crud_template']['class']['button_print']) ? $page['load']['crud_template']['class']['button_print'] : 'btn btn-primary') . ' ">
                        ' . (isset($page['load']['crud_template']['text']['print']) ? $page['load']['crud_template']['text']['print'] : '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;">
                        <path d="M19 7h-1V2H6v5H5a3 3 0 0 0-3 3v7a2 2 0 0 0 2 2h2v3h12v-3h2a2 2 0 0 0 2-2v-7a3 3 0 0 0-3-3zM8 4h8v3H8V4zm0 16v-4h8v4H8zm11-8h-4v-2h4v2z"></path>
                    </svg>  Print') . ' </a>';

						$array = $page['crud']['array'];
						$primary_key = $page['database']['primary_key'];
						$row_edit_hapus = true;

						if ($page['section'] == 'viewsource') {
							$content .= '<?php $row_edit_hapus = true;';
						}

						for ($i = 0; $i < count($array); $i++) {
							$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if ($type == "select-appr") {
								$field_database = $array[$i][3];
								$field = $field . '_status';
								if ($page['section'] != 'viewsource') {
									$del = (mysqli_fetch_object($page['crud']['row_database_utama']));

									if ($del->$field != 3)
										$row_edit_hapus = false;
								} else {
									$content .= 'if($' . $fai->nama_function($page, $page['title']) . '->' . $field . '!=3)
                                    $row_edit_hapus = false; 
                                ';
								}
							}
						}

						if ($page['section'] == 'viewsource') {
							$content .= '?>';
						}
					}
					if ($page['crud']['type'] != 'view_appr')
						$row_edit_hapus = false;

					if (isset($page['crud']['button_approve_on_edit']) and in_array($page['crud']['view'], array('edit'))) {

						$row_edit_hapus = true;
					}
					if ($row_edit_hapus) {
						if ($page['section'] == 'viewsource') {
							$content .= '<?php if ($row_edit_hapus) {?>';
						}

						$content .= '<a href="' . $fai->route_v($page, $page['route'], ['setujui_appr', 'data:primary_key']) . '" class="' . (isset($page['load']['crud_template']['class']['button_approve']) ? $page['load']['crud_template']['class']['button_approve'] : 'btn btn-primary') . '" title="Approve">
                        
                        
										' . (isset($page['load']['crud_template']['text']['approve']) ? $page['load']['crud_template']['text']['approve'] : 'Approve') . '
                    </a>';

						if ($page['section'] == 'viewsource') {
							$content .=  '<?php } ?>';
						}
					}
					if ($row_edit_hapus) {

						if ($page['section'] == 'viewsource') {
							$content .= '<?php if ($row_edit_hapus) {?>';
						}

						$content .= ' 
                    <a href="' .  Partial::link_direct($page, $page['load']['link_route'], [$page['load']['apps'], $page['load']['page_view'], 'decline_appr', 'data:primary_key']) . '" class="' . (isset($page['load']['crud_template']['class']['button_decline']) ? $page['load']['crud_template']['class']['button_decline'] : 'btn btn-primary') . '" title="Decline">
                    
                        ' . (isset($page['load']['crud_template']['text']['decline']) ? $page['load']['crud_template']['text']['decline'] : 'Decline') . '</a>';

						if ($page['section'] == 'viewsource') {
							$content .= '<?php } ?>';
						}
					}
				}
				if (isset($page['crud']['list_table_view_layout'])) {
					$function = "change_view_layout_crud";
				} else {
					$function = "reachpage";
				}
				$content .= '<a href="javascript:void(0)" onclick="' . $function . '(' . "'" . $page['route'] . "'" . ',' . "'" . 'list' . "'" . ',-1)" class="' . (isset($page['load']['crud_template']['class']['button_back']) ? $page['load']['crud_template']['class']['button_back'] : 'btn btn-primary') . ' ">
            
                ' . (isset($page['load']['crud_template']['text']['kembali']) ? $page['load']['crud_template']['text']['kembali'][0] : 'Back') . ' </a>
        </div>';
			}
		}
		if ($page['section'] == 'viewsource') {

			$content .= "
							
				<script>
				function form_action_submit() {
					$('#pesanSubmit').html('');


					var required = $('form#formvte_fai_framework input,form#formvte_fai_framework textarea,form#formvte_fai_framework select').filter('[required]:visible');
					var allRequired = true;
					var belumygmana = '';
					required.each(function() {
						if ($(this).val() == '') {
							allRequired = false;
							belumygmana += '<li>' + $(this).attr('placeholder') + '</li>';

						}

					});

					if (allRequired) {
						$('#pesanSubmit').html('');
						document.getElementById('formvte_fai_framework').submit();
						$('form#formvte_fai_framework').submit();
					} else {

						$('#pesanSubmit').html('<div class=\"alert alert-danger\" role=\"alert\">Silahkan isi form dengan benar, cek kembali form<br><br><ol>' + belumygmana + '</ol></div>');


					}


				}
				</script>
			";
		}
		return $content;
	}

	public static function content_start_card($page)
	{
		if (!isset($page['crud']['costum_view'])) {

			return '
			<div class="card">
			<div class="card-body" id="printarea">
			';
		} else {
			return '';
		}
	}
	public static function content_end_card($page)
	{
		if (!isset($page['crud']['costum_view'])) {

			return '
			</div>
			</div>
			';
		} else {
			return '';
		}
	}

	public static function content_form_action($page)
	{

		if (!isset($page['route'])) {
			$page['route'] = $page['load']['page_view'];
		}
		$fai = new MainFaiFramework();
		$content = '';
		if ($page['section'] == 'select-other') {
			$content = "";
		} else {

			$form_route = $fai->route(($page['section'] == 'viewsource' ? 'post_' : '') . $page['route'], ['".($page==\'tambah\'?\'save\':\'update\')."', $page['id']]);
			if (isset($page['crud']['form_route_costum'][$page['crud']['view']]))
				$form_route = $fai->route(($page['section'] == 'viewsource' ? 'post_' : '') . $page['crud']['form_route_costum'][$page['crud']['view']], [$page['crud']['form_route'], $page['id']]);
			if ($page['section'] != 'viewsource') {
				$page['load']['link'] = 'direct';
				if (isset($page['crud']['submit_link'])) {
					$link = ($page['crud']['submit_link']);
				} else {

					$link = ([
						(Partial::input('apps') ? Partial::input('apps') : $page['load']['apps']),
						(Partial::input('page_view') ? Partial::input('page_view') : $page['load']['page_view']),
						($page['load']['type'] == 'edit' ? 'update' : 'save'),
						Partial::input('id') ? Partial::input('id') : $page['load']['id'],
						Partial::input('menu') ? Partial::input('menu') : $page['load']['menu'],
						Partial::input('nav') ? Partial::input('nav') : $page['load']['nav'],
						Partial::input('board') ? Partial::input('board') : $page['load']['board']
					]);
				}

				$form_route = Partial::link_direct(
					$page,
					base_url() . 'pages/',
					$link,
					'menu',
					'just_link'
				);
			}
			$content .= '<form method="POST" id="formvte_fai_framework"  name="formvte_fai_framework"  enctype="multipart/form-data"  ' . 
			($page['section'] == 'viewsource' ? 'action=' . "'" . '<?=url("' . $form_route . '");?>' : '') . 
			($page['section'] == 'viewsource' ? "'" 												 : 'action="' . $form_route . '"') . '>';
			if ($page['section'] == 'viewsource') {
				$content .= '                       @csrf';
			}
		}
		//enctype="multipart/form-data"

		$content .= "<input type='hidden' name='contentfaiframework' value='get_pages'>";
		$content .= "<input type='hidden' name='main_all' value='2'>";
		$content .= "<input type='hidden' name='MainAll' value='2'>";
		$content .= "<input type='hidden' name='not_sidebar' value='not'>";
		$content .= "<input type='hidden' name='not_sidebar' value='not'>";
		$content .= "<input type='hidden' name='apps' value='" . $page['load']['apps'] . "'>";
		$content .= "<input type='hidden' name='page_view' value='" . $page['load']['page_view'] . "'>";
		$content .= "<input type='hidden' name='type' value='" . (isset($page['crud']['costum_type']) ? $page['crud']['costum_type'] : ($page['load']['type'] == 'edit' ? 'update' : 'save')) . "'>";
		$content .= "<input type='hidden' name='id' value='" . $page['load']['id'] . "'>";
		$content .= "<input type='hidden' name='nav' value='" . $page['load']['nav'] . "'>";
		$content .= "<input type='hidden' name='menu' value='" . $page['load']['menu'] . "'>";
		$content .= "<input type='hidden' name='board' value='" . $page['load']['board'] . "'>";
		$content .= "<input type='hidden' name='frameworksubdomain' value='" . $page['load']['domain'] . "'>";
		$content .= "<input type='hidden' name='section' value='" . $page['section'] . "'>";
		$content .= "<input type='hidden' name='view_layout_number' value='" . (isset($page['view_layout_number']) ? ($page['view_layout_number']) : -1) . "'>";
		$content .= "<input type='hidden' name='page_database' value='" . (isset($page['load']['card']['page_database']) ? ($page['load']['card']['page_database']) : -1) . "'>";
		$content .= "<input type='hidden' name='page_database' value='" . (isset($page['load']['card']['page_database']) ? ($page['load']['card']['page_database']) : -1) . "'>";


		return $content;
	}

	public static function content_content_table($page)
	{

		$fai = new MainFaiFramework();

		$content = '';;
		$content .= '<div class="row">';
		$show = false;
		if ($page['section'] != 'viewsource' and $show) {
			$content .= '			<div class="col-6 d-flex " style="align-content: center;align-items: center;">';
			$show_entry = array(10, 25, 50, 100, 250, 500);


			$content .= 'Show <select class="form-control " id="show_entry" style="width: 100px">';
			for ($s = 0; $s < count($show_entry); $s++) {
				$content .= '				<option value="' . $show_entry[$s] . '">' . $show_entry[$s] . '</option>';
			}
			$content .= '				</select> Entries
					</div><div class="col-6 d-flex " style="align-content: center;align-items: center;justify-content: end;">
						Search <input class="form-control" id="search"  style="width: 50%">
					</div>';
		}
		$content .= '			<div class="col-12 mt-3 mb-3" >';



		$page['crud']['view'] = 'list';


		$content .= CrudContent::table($page, $fai);;
		if ($page['section'] != 'viewsource' and $show) {
			$content .= '           
                    </div>
                	<div class="col-6 d-flex " style="align-content: center;align-items: center;">
						Showing 1 to 10 of 16 entries
					</div><div class="col-6 d-flex " style="align-content: center;align-items: center;justify-content: end;">
						' . Partial::paginate_fai_content(10, 2, 22) . '
					</div>
                </div>';
		}
		return $content;
	}
}
