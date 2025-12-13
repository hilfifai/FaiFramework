<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HabitsApp
{

	public static function habittable($page, $type, $id)
	{
		if ($type == 'habittable') {
			$tgl = MainFaiFramework::input('tgl')? MainFaiFramework::input('tgl'):date('Y-m-d');
			$content = "";
			$content .= '<table id="main-table" class="main-table table table-vcenter card-table table-striped">
			<thead>
				<tr>
					<th scope="col">Nama Kebiasaan</th>';
			$date = $tgl;
			for ($i = 0; $i < 15; $i++) {
				$content .= ' <th scope="col" class="text-center">' . nama_hari($date) . '<br>' . Partial::format_tgl($date, ' d-m') . ' </th>';
				$date = tambah_tanggal($date, '-1');
			}

			$content .= '	</tr>
			
			</thead>
			<tbody>';

			function buildTree($page, $parent, $type_page, $table)
			{
				// print_r($data_row);

				// (
				// 	SELECT count(*) FROM ltw_kegiatan as lh 
				// 		JOIN ltw_kegiatan__user as lhu on 
				// 				lhu.id_ltw_kegiatan= lh.id_ltw_kegiatan 
				// 				and lhu.id_apps_user = "."'".$_SESSION[$page['load']['login-session-utama']['session_name']]."'"." 

				// WHERE lh.mode_habits ='amalan' AND lh.parent =ltw_kegiatan.parent)
				$DB = new DB();
				//$Database= new ();
				$DB->connection($page);
				$habits_db['utama'] = 'ltw_kegiatan__list';
				$habits_db['select'] = array('*',  "0 as count","ltw_kegiatan__task.id_list","ltw_kegiatan__task.id as id_task");
				$habits_db['primary_key'] = null;
				$habits_db['join'][] = array('ltw_kegiatan__task', "ltw_kegiatan__list.id", "ltw_kegiatan__task.id_list");
				// $habits_db['join'][] = array('ltw_kegiatan__task__detail', "ltw_kegiatan__task.id", "ltw_kegiatan__task__detail.id_ltw_kegiatan__task");
				$habits_db['join'][] = array('ltw_kegiatan__board__user', "ltw_kegiatan__board__user.id_ltw_kegiatan__board", "ltw_kegiatan__task.id_board");
				$habits_db['join'][] = array('ltw_kegiatan__list__breakdown_target', "ltw_kegiatan__list__breakdown_target.id", "ltw_kegiatan__task.id_ideal_target",'LEFT');
				$habits_db['where'][] = array('ltw_kegiatan__board__user.id_user', "=", "'" . $_SESSION[$page['load']['login-session-utama']['session_name']] . "'");
				$habits_db['where'][] = array('mode_kegiatan', "=", "'amalan'");
				$habits_db['where'][] = array('id_parent', "=", "'" . $parent . "'");
				if(Partial::input('id_board')){
					$habits_db['where'][] = array('ltw_kegiatan__task.id_board', "=", "" . Partial::input('id_board') . "");

				}
				$row = Database::database_coverter($page, $habits_db, array(), 'all');
				//id_list//id_user
				echo $row['query'];
				$list_=[];
				if ($row['num_rows']) {
					foreach ($row['row'] as $data) {
						if(!in_array($data->id_list,$list_)){
						$list_[]=$data->id_list;
						$tab = '';
						for ($x = 0; $x < $data->level_parent; $x++) {
							$tab .= '<span style="white-space: pre;">	</span>';
						}
						$icon_x = '<span class="iconify text-red" data-icon="raphael:cross"><i class="fa fa-user"></</span>';
						$icon_c = '<span class="iconify text-success" data-icon="bi:check-lg"></span>';
						$icon_w = '<span class="iconify" data-icon="mdi:timer-sand-empty"></span>';

						$icon = $icon_x;
						$table .= '<tr>
							<td>' . $tab . $data->nama_kegiatan . ' 
							<div class="text-muted ">						
							' . $tab .
							'<span class="fz-10">Target : ' . $data->target . ' ' . $data->unit_target . ' Setiap ' . $data->frekuensi . ' ' . $data->per . '
								
							<br>' . $tab . 'Target Ideal: ' . $data->ideal_target . ' ' . $data->unit_target . ' Setiap ' . $data->ideal_frekuensi . ' ' . $data->ideal_per . '</span></div>
							</td> 
							';
						$date = Partial::input('tgl')?Partial::input('tgl'):date('Y-m-d');;
						$khusus_hari = array();
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__khusus_hari';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						if ($row['num_rows']) {
							foreach ($row as $hari) {
								$khusus_hari[] = $hari->hari;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__khusus_tanggal';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('tanggal_type', "=", "'hijriyah'");

						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						// echo $row['query'];
						$khusus_tanggal_h = array();
						if ($row['num_rows']) {
							foreach ($row as $khusus) {
								$khusus_tanggal_h[] = $khusus->tanggal;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__khusus_tanggal';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('tanggal_type', "=", "'masehi'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$khusus_tanggal_m = array();
						if ($row['num_rows']) {
							foreach ($row as $khusus) {
								$khusus_tanggal_m[] = $khusus->tanggal;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__khusus_bulan';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('bulan_type', "=", "'hijriyah'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$khusus_bulan_h = array();
						if ($row['num_rows']) {
							foreach ($row as $khusus) {
								$khusus_bulan_h[] = $khusus->bulan;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__khusus_bulan';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('bulan_type', "=", "'masehi'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$khusus_bulan_m = array();
						if ($row['num_rows']) {
							foreach ($row as $khusus) {
								$khusus_bulan_m[] = $khusus->bulan;
							}
						}
						unset($kegiatan_db);
						$kecuali_hari = array();
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__kecuali_hari';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						if ($row['num_rows']) {
							foreach ($row as $hari) {
								$kecuali_hari[] = $hari->hari;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__kecuali_tanggal';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('tanggal_type', "=", "'hijriyah'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$kecuali_tanggal_h = array();
						if ($row['num_rows']) {
							foreach ($row as $kecuali) {
								$kecuali_tanggal_h[] = $kecuali->tanggal;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__kecuali_tanggal';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('tanggal_type', "=", "'masehi'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$kecuali_tanggal_m = array();
						if ($row['num_rows']) {
							foreach ($row as $kecuali) {
								$kecuali_tanggal_m[] = $kecuali->tanggal;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__kecuali_bulan';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('bulan_type', "=", "'hijriyah'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$kecuali_bulan_h = array();
						if ($row['num_rows']) {
							foreach ($row as $kecuali) {
								$kecuali_bulan_h[] = $kecuali->bulan;
							}
						}
						unset($kegiatan_db);
						$kegiatan_db['utama'] = 'ltw_kegiatan__list__kecuali_bulan';
						$kegiatan_db['where'][] = array('id_ltw_kegiatan__list', "=", "'" . $data->id_list . "'");
						$kegiatan_db['where'][] = array('bulan_type', "=", "'masehi'");
						$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
						$kecuali_bulan_m = array();
						if ($row['num_rows']) {
							foreach ($row as $kecuali) {
								$kecuali_bulan_m[] = $kecuali->bulan;
							}
						}

						for ($i = 0; $i < 15; $i++) {
							$check_aktif = true;
							$check_aktif_i_bulan = true;
							$check_aktif_i_tanggal = true;
							$check_aktif_i_hari = true;
							$check_aktif_s_bulan = true;
							$check_aktif_s_tanggal = true;
							$check_aktif_s_hari = true;
							if (count($khusus_hari))
								$check_aktif_s_hari = in_array(nama_hari($date), $khusus_hari);

							if (count($khusus_tanggal_h))
								$check_aktif_s_tanggal = in_array(tgl_hijriah($date)['day'], $khusus_tanggal_h);

							if (count($khusus_tanggal_m))
								$check_aktif_s_tanggal = in_array(format_tanggal($date, 'd'), $khusus_tanggal_m);


							if (count($khusus_bulan_h))
								$check_aktif_s_bulan = in_array(nama_bulan_hijriah(tgl_hijriah($date)['month']), $khusus_bulan_h);

							if (count($kecuali_hari))
								$check_aktif_s_hari = in_array(nama_hari($date), $kecuali_hari);

							if (count($kecuali_tanggal_h))
								$check_aktif_s_tanggal = in_array(tgl_hijriah($date)['day'], $kecuali_tanggal_h);

							if (count($kecuali_tanggal_m))
								$check_aktif_s_tanggal = in_array(format_tanggal($date, 'm'), $kecuali_tanggal_m);


							if (count($kecuali_bulan_h))
								$check_aktif_s_bulan = in_array(nama_bulan_hijriah(tgl_hijriah($date)['month']), $kecuali_bulan_h);

							$check_aktif = $check_aktif_i_bulan && $check_aktif_i_tanggal && $check_aktif_i_hari && $check_aktif_s_bulan && $check_aktif_s_tanggal && $check_aktif_s_hari ? true : false;
							//

							if ($check_aktif) {
								unset($kegiatan_db);
								$kegiatan_db['utama'] = 'ltw_kegiatan__report';
								// $search['id_task_detail'] 	= $data->id_task_detail;
								$search['id_task'] 	= $data->id_task;
								$search['tanggal_report']  	= $date;


								foreach ($search as $key => $value) {
									$kegiatan_db['where'][] = array($key, "=", "'" . $value . "'");
								}
								$row_repot = Database::database_coverter($page, $kegiatan_db, array(), 'all');


								if ($row_repot['num_rows']) {
									$row_repot = 	$row_repot['row'][0];
									$value = ($row_repot->value_report);
									$persen = ($row_repot->persen_target);
									if ($persen == 0) {
										$icon = $icon_x;
									} else if ($persen == 100) {
										$icon = $icon_c;
									} else {
										$icon = '<span class="text-cyan">' . round($persen, 2) . '%</span>';
									}

									if ($row_repot->value_report_tanggal) {
										$report_tanggal = '<br><sub class=" text-muted" style="font-size:6px">' . ($row_repot->value_report_tanggal) . ' ' . $data->unit_target . '(' . round($row_repot->persen_target_tanggal) . '%)</sub>';
									} else {
										$report_tanggal = '';
									}
								} else {
									$icon = $icon_x;
									$value = 0;
									$report_tanggal = '';
								}

								$table .=  ' <td class="text-center hover-td" id="' . ($data->id_ltw_kegiatan) . '-' . $date . '" onclick="u3OmVFdtRd4uXovbH93VEgnnVvoZCfgxa38DXdOaEPopYn3(' . "'" . ($data->id_ltw_kegiatan) . "','" . ($data->id_list) . "','" . ($data->id_task) . "','" . $date . "'" . ')">' . $icon . '
									<br> <small class="fz-7 text-muted">' . $value . ' ' . $data->unit_target . '</small>   ' . $report_tanggal . '
									</td>';
							} else {
								$table .=  ' <td class="text-center hover-td" >
									<span class="iconify text-teal" data-icon="akar-icons:circle-minus-fill"></span>
										
								</td>';
							}
							$date = tambah_tanggal($date, '-1');
						}
						$table .=  '</tr>';


						if ($data->count)
							$table .= buildTree($page, $data->id_ltw_kegiatan, $type_page, "");
					}
					}
				}

				return $table;

				//echo print_r($element);


			}

			$content .= buildTree($page, 0, $id,"");

			$content .= '
			</tfoot>
		</table>';
		}
		return $content;
	}
	public static function save_lapor_habits($page, $type, $id)
	{
		$ci        = &get_instance();
		//$kode = de($_POST['k'.en('ode',true)]);
		$icon_x = '<span class="iconify text-red" data-icon="raphael:cross"></span>';
		$icon_c = '<span class="iconify text-success" data-icon="bi:check-lg"></span>';
		$icon_w = '<span class="iconify" data-icon="mdi:timer-sand-empty"></span>';
		$icon_o = 'span class="iconify text-teal" data-icon="akar-icons:circle-minus-fill"></span>';

		$kode = ($_POST['k' . en('ode', true)]);
		$kode_list = ($_POST['k' . en('id_list', true)]);
		$kode_task_detail = ($_POST['k' . en('id_task_detail', true)]);
		$kegiatan_db['utama'] = 'ltw_kegiatan__list';
		$kegiatan_db['where'][] = array('id', "=", "'" . $kode_list . "'");

		$row = Database::database_coverter($page, $kegiatan_db, array(), 'all');
		$row = $row['row'][0];
		//
		if ($row->ideal_frekuensi == 1 and $row->ideal_per == "Hari") {
			$start_date = $_POST['tgl'];
			$end_date = $_POST['tgl'];
		} else if ($row->ideal_frekuensi > 1 and $row->ideal_per == "Hari") {
			// $search['id_task_detail'] 	= $kode_task_detail;
			$search['id_task'] 	= $kode_task_detail;
			$report['utama'] = 'ltw_kegiatan__report';
			// $report['where'][] = array('id_task_detail', "=", "'" . $kode_task_detail . "'");
			$report['where'][] = array('id_task', "=", "'" . $kode_task_detail . "'");
			$report['where'][] = array('tanggal_report', ">=", "'" . tambah_tanggal($_POST['tgl'], - ($row->ideal_frekuensi)) . "'");
			$report['where'][] = array('tanggal_report', "<=", "'" . $_POST['tgl'] . "'");
			$report['limit'] = 1;
			$check_repot = Database::database_coverter($page, $report, array(), 'all');
			if ($check_repot['num_rows']) {
				$start_date = $check_repot['row'][0]->tanggal_report;
				$end_date = tambah_tanggal($start_date, ($row->ideal_frekuensi));
			} else {
				$start_date = tambah_tanggal($_POST['tgl'], - ($row->ideal_frekuensi));
				$end_date = $_POST['tgl'];
			}
		} else if ($row->ideal_per == "Minggu") {

			//cari senin -> tambah minggu
			$start_date = search_hari($_POST['tgl'], 1);
			$end_date = tambah_tanggal(tambah_minggu($start_date, ($row->ideal_frekuensi)), -1);
		} else if ($row->ideal_per == "Bulan") {

			if ($row->khusus_bulan_type == 'hijriyah') {

				$start_date = tambah_tanggal($_POST['tgl'], - (tgl_hijriah($_POST['tgl'])['day'] - 1));
				$end_date = tambah_tanggal(tambah_bulan($start_date, ($row->ideal_frekuensi)), -1);
				$end_date = tambah_tanggal($end_date, -tgl_hijriah($end_date)['day']);
			} else {

				$start_date = awal_bulan($_POST['tgl']);
				$end_date = tambah_tanggal(tambah_bulan($start_date, ($row->ideal_frekuensi)), -1);
			}
		}

		//mode digunakan untuk megnetahui bahwa itu ideal, pribadi, atau, board
		//akan di hitung ulang ketika pribadi!=ideal atau board!=ideal

		//untuk pertama contoh
		//ketika orang ingin lapor ?
		//cari presentasenya? semuanya dulu dari tanggal sekian sampe sekian 
		//dapetin value report secara akumulatif?

		// $search['id_task_detail'] 	= $kode_task_detail;
		$search['id_task'] 	= $kode_task_detail;

		unset($report);
		$report['utama'] = 'ltw_kegiatan__report';
		// $report['where'][] = array('id_task_detail', "=", "'" . $kode_task_detail . "'");
		$report['where'][] = array('id_task', "=", "'" . $kode_task_detail . "'");
		$report['where'][] = array('tanggal_report', ">=", "'" . $start_date . "'");
		$report['where'][] = array('tanggal_report', "<=", "'" . $end_date . "'");
		$report['limit'] = 1;
		$row_repot = Database::database_coverter($page, $report, array(), 'all');

		$data = $search;
		$data['target'] = $row->ideal_target;
		if ($row_repot['num_rows']) {
			$data['value_report'] = ($row_repot['row'][0]->value_report) + 1;
			//hasil dari total jumlah sum dari range tanggal
		} else {
			$data['value_report'] = 1;
		}
		if ($data['value_report'] > $data['target']) {
			$data['value_report'] = 0;

			$reset['value_report_tanggal'] = 0;
			$reset['persen_target_tanggal'] = 0;
			// $searchupdate[] = array('id_task_detail', '>=', $kode_task_detail);
			$searchupdate[] = array('id_task', '>=', $kode_task_detail);
			$searchupdate[] = array('tanggal_report', '>=', "'" . $start_date."'");
			$searchupdate[] = array('tanggal_report', '<=', "'".$end_date."'");

			DB::update('ltw_kegiatan__report', $reset, $searchupdate,'Where Array');
		}

		$data['persen_target'] = $data['value_report'] / $data['target'] * 100;
		if ($data['persen_target'] >= 100) {
			$data['persen_target'] = 100;
			$data['ketercapaian_target'] = 1;
		} else {
			$data['ketercapaian_target'] = 0;
		}

		unset($report);
		$report['utama'] = 'ltw_kegiatan__report';
		// $report['where'][] = array('id_task_detail', "=", "'" . $kode_task_detail . "'");
		$report['where'][] = array('id_task', "=", "'" . $kode_task_detail . "'");
		$report['where'][] = array('tanggal_report', "=", "'" .  $_POST['tgl'] . "'");
		$row_repot_tgl = Database::database_coverter($page, $report, array(), 'all');

		
		if ($row_repot_tgl['num_rows']) {
			$tgl['value_report_tanggal'] = ($row_repot_tgl['row'][0]->value_report_tanggal) + 1;
			//hasil dari total jumlah sum dari range tanggal

		} else {
			$tgl['value_report_tanggal'] = 1;
		}

		$tgl['persen_target_tanggal'] = $tgl['value_report_tanggal'] / $data['target'] * 100;


		$date = $start_date;
		$count =  hitungHari($start_date, $end_date);
		$count = !$count ? 1 : $count;

		for ($i = 0; $i < $count; $i++) {
			unset($data['value_report_tanggal']);
			unset($data['persen_target_tanggal']);
			if ($date == $_POST['tgl']) {
				$data['value_report_tanggal']	 = $tgl['value_report_tanggal'];
				$data['persen_target_tanggal']	 = $tgl['persen_target_tanggal'];
			}


			$data['tanggal_report'] = "'$date'";
			$data['mode'] = "'#ideal'";
			unset($report);
			$report['utama'] = 'ltw_kegiatan__report';
			$report['select'] = array('*','ltw_kegiatan__report.id as id_ltw_kegiatan_report');
			$report['where'][] = array('id_task_detail', "=", "'" . $kode_task_detail . "'");
			$report['where'][] = array('tanggal_report', "=", "'" .  $date . "'");
			$row_repot = Database::database_coverter($page, $report, array(), 'all');

			

			if ($row_repot['num_rows']) {
				unset($where);
				$where[] = array('id', '=',$row_repot['row'][0]->id_ltw_kegiatan_report);
				DB::update('ltw_kegiatan__report', $data,$where,"Where Array");
				
			} else {
				$data['tanggal_report'] = "$date";
				$data['mode'] = "#ideal";
				CRUDFunc::crud_insert(false, $page, $data, [], 'ltw_kegiatan__report', []);

			}
			$report['utama'] = 'ltw_kegiatan__report';
			// $report['where'][] = array('id_task_detail', "=", "'" . $kode_task_detail . "'");
			$report['where'][] = array('id_task', "=", "'" . $kode_task_detail . "'");
			$report['where'][] = array('tanggal_report', "=", "'" .  $date . "'");
			$row_repot = Database::database_coverter($page, $report, array(), 'all');
			$row_repot= $row_repot['row'][0];
			if ($row_repot->value_report_tanggal and !($row->ideal_per == "Hari" and $row->ideal_frekuensi == 1)) {
				$report_tanggal = '<br><sub class=" text-muted" style="font-size:6px">' . ($row_repot->value_report_tanggal) . ' ' . $row->unit_target . '(' . round($row_repot->persen_target_tanggal) . '%)</sub>';
			} else {
				$report_tanggal = '';
			}
			$value = ($data['value_report']);
			$persen = ($data['persen_target']);
			if ($persen == 0) {
				$icon = $icon_x;
			} else if ($persen == 100) {
				$icon = $icon_c;
			} else {
				$icon = '<span class="text-cyan">' . round($persen, 2) . '%</span>';
			}
			$icon = $icon . '<br> <small class="fz-7 text-muted">' . $value . ' ' . $row->unit_target . '</small>' . $report_tanggal;
			echo "u" . en('update_td', true) . "('" . $_POST['k' . en('ode', true)] . "','" . $date . "','" . $icon . "');";
			$date = tambah_tanggal($date, 1);
		}
	}

	public function load_task()
	{
		$ci        = &get_instance();


		$query = $ci->db->where('ltw_planner__treatment_sub.id_ltw_planner_treatment', de($_POST['k']))->order_by('date_pengerjaan')
			->join('ltw_planner__pengerjaan', 'ltw_planner__treatment_sub.id_ltw_planner_treatment_sub = ltw_planner__pengerjaan.id_ltw_planner_treatment_sub')->order_by('start_time_pengerjaan')->get('ltw_planner__treatment_sub');

		$page['query'] = $query;
		$page['type_task'] = $ci->db->select('type_task')->where('id_ltw_planner_treatment', $query->row()->id_ltw_planner_treatment)->get('ltw_planner__treatment')->row()->type_task;
		$ci->load->view('_v_lifetime_work/planner/planner_board_detail_ajax.php', $page);
	}
	public function ajax_get_edit()
	{
		$ci        = &get_instance();
		global $f;
		$id        = de($ci->input->post('k'));
		$data = $ci->db->where('ltw_planner__treatment_sub.id_ltw_planner_treatment_sub', $id)->join('ltw_planner__pengerjaan', 'ltw_planner__treatment_sub.id_ltw_planner_treatment_sub = ltw_planner__pengerjaan.id_ltw_planner_treatment_sub')->get('ltw_planner__treatment_sub')->row();

		$who = explode('#', $data->who_pengerjaan);
		$en_who = '';
		for ($i = 1; $i < count($who); $i++) {
			$en_who .= en($who[$i], true) . '#';
		}
		$data->who = $en_who;
		$data->c = en($data->id_ltw_planner_treatment_sub);
		unset($data->id_ltw_planner_treatment_sub);
		unset($data->id_ltw_planner_pengerjaan);
		unset($data->id_ltw_planner_treatment);
		unset($data->id_ltw_planner_treatment);
		unset($data->who_pengerjaan);
		echo json_encode($data);
	}
	public function delete_task()
	{
		$ci        = &get_instance();
		global $f;
		$id        = de($ci->input->post('k'));
		$f->delete_database('ltw_planner__treatment_sub', $id);
	}
	public function tambah_multi_task()
	{
		$ci        = &get_instance();
		global $f;
		$task        		= $ci->input->post('task_progress');
		$sub_task_post       = $ci->input->post('task_progres');
		$id_treatment        = de($ci->input->post('b'));
		$i = 0;
		$sub['nama_sub_task'] = $task[$i];
		if ($_POST['type'] == 'add') {
			$sub['id_ltw_planner_treatment'] = $id_treatment;
			$id_sub = $f->input_database('ltw_planner__treatment_sub', $sub);
		} else {
			$id_sub = de($_POST['c']);
			$f->update_database('ltw_planner__treatment_sub', $id_sub, $sub);
		}

		$sub_task['id_ltw_planner_treatment'] = $id_treatment;
		$sub_task['id_ltw_planner_treatment_sub'] = $id_sub;

		$sub_task['date_pengerjaan'] = $sub_task_post['date'][$i];
		$sub_task['start_time_pengerjaan'] = $sub_task_post['start_time'][$i];
		$sub_task['end_time_pengerjaan'] = $sub_task_post['end_time'][$i];
		$sub_task['who_pengerjaan'] = '';
		if (isset($sub_task_post['who'][$i])) {
			$who        = $sub_task_post['who'][$i];
			for ($j = 0; $j < count($who); $j++) {
				$who[$j] = de($who[$j]);
				$sub_task['who_pengerjaan'] .= '#' . $who[$j];
				if (!in_array($who[$j], explode('#', $penugasan))) {
					$penugasan .= '#' . $who[$j];
				}
			}
		} else {
			$ci->db->where('id_ltw_planner_treatment', $id_treatment);
			$sub_task['who_pengerjaan'] = $ci->db->select('ltw_planner.terlibat')
				->join('ltw_planner__kegiatan', 'ltw_planner__kegiatan.id_ltw_planner_kegiatan = ltw_planner__treatment.id_ltw_planner_kegiatan')
				->join('ltw_planner', 'ltw_planner__kegiatan.id_ltw_planner = ltw_planner.id_ltw_planner')->get('ltw_planner__treatment')
				->row()->terlibat;
		}
		if ($_POST['type'] == 'add') {
			$f->input_database('ltw_planner__pengerjaan', $sub_task);
		} else {
			$f->update_database('ltw_planner__pengerjaan', $id_sub, $sub_task, 'id_ltw_planner_treatment_sub');
		}
	}
	public function tambah_task($id, $id_planner)
	{
		$ci        = &get_instance();
		$page['content'] = '_v_lifetime_work/planner/tambah_task.php';
		$page['header'] = ltw_header();
		$page['planner'] = $ci->db->where('id_ltw_planner_kegiatan', $id)->get('ltw_planner__kegiatan')->row();
		$page['id'] = $id;
		$page['id_planner'] = $id_planner;
		$ci->load->view('layout/content', $page);
	}
	public function save_tambah_task($id, $id_planner)
	{
		$ci        = &get_instance();
		global $f;
		$data = $_POST[en('data', true)];
		$terlibat        = $ci->input->post('terlibat');
		$data['deadline'] .= ' ' . $ci->input->post('deadline_jam');
		$data['id_ltw_planner_kegiatan'] = $id;

		$id_treatment = $f->input_database('ltw_planner__treatment', $data);
		$penugasan = '';
		if ($data['type_task'] == 'sub') {

			$task        		= $ci->input->post('task_progress');
			$sub_task_post        = $ci->input->post('task_progres');
			$sub['id_ltw_planner_treatment'] = $id_treatment;
			for ($i = 0; $i < count($task); $i++) {
				$sub['nama_sub_task'] = $task[$i];
				$id_sub = $f->input_database('ltw_planner__treatment_sub', $sub);

				$sub_task['id_ltw_planner_treatment'] = $id_treatment;
				$sub_task['id_ltw_planner_treatment_sub'] = $id_sub;

				$sub_task['date_pengerjaan'] = $sub_task_post['date'][$i];
				$sub_task['start_time_pengerjaan'] = $sub_task_post['start_time'][$i];
				$sub_task['end_time_pengerjaan'] = $sub_task_post['end_time'][$i];
				$sub_task['who_pengerjaan'] = '';
				if (isset($sub_task_post['who'][$i])) {


					$who        = $sub_task_post['who'][$i];
					for ($j = 0; $j < count($who); $j++) {
						$who[$j] = de($who[$j]);
						$sub_task['who_pengerjaan'] .= '#' . $who[$j];
						if (!in_array($who[$j], explode('#', $penugasan))) {
							$penugasan .= '#' . $who[$j];
						}
					}
				} else {
					$ci->db->where('id_ltw_planner_treatment', $id_treatment);
					$sub_task['who_pengerjaan'] = $ci->db->select('ltw_planner.terlibat')
						->join('ltw_planner__kegiatan', 'ltw_planner__kegiatan.id_ltw_planner_kegiatan = ltw_planner__treatment.id_ltw_planner_kegiatan')
						->join('ltw_planner', 'ltw_planner__kegiatan.id_ltw_planner = ltw_planner.id_ltw_planner')->get('ltw_planner__treatment')
						->row()->terlibat;
				}

				$f->input_database('ltw_planner__pengerjaan', $sub_task);
			}
		} else {

			$waktu        = $ci->input->post('waktu_pengerjaan');
			$pengerjaan['id_ltw_planner_treatment'] = $id_treatment;
			for ($i = 0; $i < count($waktu['date']); $i++) {
				$pengerjaan['date_pengerjaan'] = $waktu['date'][$i];
				$pengerjaan['time_pengerjaan'] = $waktu['time'][$i];
				$pengerjaan['who_pengerjaan'] = '';
				$who        = $waktu['who'][$i];
				for ($j = 0; $j < count($who); $j++) {
					$who[$j] = de($who[$j]);
					$pengerjaan['who_pengerjaan'] .= '#' . $who[$j];
					if (!in_array($who[$j], explode('#', $penugasan))) {
						$penugasan .= '#' . $who[$j];
					}
				}

				$f->input_database('ltw_planner__pengerjaan', $pengerjaan);
			}
		}
		$update['penugasan'] =	$penugasan;
		$f->update_database('ltw_planner__treatment', $id_treatment, $update);
		redirect(r('_lifetime_work', 'planner/board/' . $id_planner));
	}
	public function update_task()
	{
		$ci        		= &get_instance();
		global $f;
		$type 			= de($_POST['f']);
		$id 			= de($_POST['e']);

		if ($type == 'sub') {
			$data['status'] = ($_POST['g']) == 'checked' ? 'selesai' : 'belum';
			$f->update_database('ltw_planner__treatment_sub', $id, $data);
			if ($_POST['h'] == 0) {
				$text = 'To Do';
			} else if ($_POST['j'] == 100) {
				$text = 'Done';
			} else {
				$text = 'On Progress';
			}
			$data['status'] = $text;
			$f->update_database('ltw_planner__treatment', de($_POST['k']), $data);
		} else {
			$data['status'] = ($_POST['j']) == 100 ? 'Done' : 'To Do';
			$f->update_database('ltw_planner__treatment', $id, $data);
		}
	}
	public function save_task_group($id)
	{
		$ci        = &get_instance();
		$data['nama_kegiatan'] = ($_POST['k' . en('ode', true)]);
		$data['id_ltw_planner'] = $id;
		$ci->db->insert('ltw_planner__kegiatan', $data);
	}
	public function save_tambah_board()
	{
		$ci        = &get_instance();
		$terlibat        = $ci->input->post('terlibat');
		$data = $_POST[en('data', true)];
		$data['terlibat'] = '#' . $_SESSION['id_apps'];

		$data['who_created'] = $_SESSION['id_apps'];
		$data['date_created'] = dat();
		if ($data['panel'] == 'user') {
			$data['panel'] = $_SESSION['as'];
			$data['id_panel'] = $_SESSION['id_apps'];
		} else if ($data['panel'] == 'organisasi') {

			$data['id_organisasi'] = $_SESSION['id_organisasi'];
		} else if ($data['panel'] == 'program') {

			$data['id_organisasi'] = $_SESSION['id_organisasi'];
		}
		for ($i = 0; $i < count($terlibat); $i++) {
			$terlibat[$i] = de($terlibat[$i]);
			$data['terlibat'] .= '#' . $terlibat[$i];
		}
		$ci->db->insert('ltw_planner', $data);
		redirect(r('_lifetime_work', 'planner/index'));
	}
}
