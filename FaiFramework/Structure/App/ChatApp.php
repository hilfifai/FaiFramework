<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once('ChatbotApp.php');
require_once(__DIR__ . '/WaApp.php');
require_once(__DIR__ . '/../Function_class/FileFunc.php');
class ChatApp
{
	public static function initialize_chat($page, $data)
	{
		$data['bufferImage'] = isset($data['bufferImage']) ? $data['bufferImage'] : null; // this is the image buffer if the message is image
		$fai = new MainFaiFramework();
		if (isset($data['participant'])) {
			$tipe = "grup";
		} else {
			$data['participant'] = $data['from'];
			$tipe = "personal";
		}
		$db['utama'] = "chat__room";
		$db['where'][] = array("is_wa", '=', "1");
		$db['where'][] = array("number_from", '=', "'" . $data['from'] . "'");
		$db['where'][] = array("from_sender", '=', "'" . $data['sender'] . "'");

		$row = $fai->database_coverter($page, $db, array(), 'all');
		// $page['get_panel'] = Partial::panel_initial($page, 'all');
		if (!$row['num_rows']) {

			$sqli['apps_id'] = random(6);
			$sqli['id_panel'] = -1;
			$sqli['nama_room'] = "Room WA " . $data['from'];
			$sqli['tipe_room'] = "wa" . $tipe;
			$sqli['is_wa'] = 1;
			$sqli['number_from'] = $data['from'];
			$sqli['from_sender'] = $data['sender'];
			$return = CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), 'chat__room');
			$get_id = $return['last_insert_id'];

			$sqli2['id_chat__room'] = $get_id;
			$sqli2['id_apps_user'] = -1;
			$sqli2['id_role'] = 5;
			$sqli2['last_sort'] = 0;
			$sqli2['last_read'] = 0;
			$return = CRUDFunc::crud_save($fai, $page, $sqli2, array(), array(), 'chat__room__anggota');

			$sqli2['id_chat__room'] = $get_id;
			$sqli2['id_apps_user'] = -2;
			$sqli2['id_role'] = 5;
			$sqli2['last_sort'] = 0;
			$sqli2['last_read'] = 0;
			$return = CRUDFunc::crud_save($fai, $page, $sqli2, array(), array(), 'chat__room__anggota');


			$row = $fai->database_coverter($page, $db, array(), 'all');
		}
		//print_r($data);
		$db_anggota['utama'] = "chat__room__anggota";
		$db_anggota['where'][] = array("id_chat__room", '=', $row['row'][0]->id);
		$db_anggota['where'][] = array("number_wa", '=', "'" . $data['participant'] . "'");
		$row_anggota = $fai->database_coverter($page, $db_anggota, array(), 'all');
		if (!$row_anggota['num_rows']) {
			$sqli2['id_chat__room'] = $row['row'][0]->id;
			$sqli2['id_apps_user'] = null;
			$sqli2['number_wa'] = $data['participant'];
			$sqli2['id_role'] = 5;
			$sqli2['last_sort'] = 0;
			$sqli2['last_read'] = 0;
			$return = CRUDFunc::crud_save($fai, $page, $sqli2, array(), array(), 'chat__room__anggota');
		}
		ChatApp::altenatif_send_massage($page, $row['row'][0]->id, $data['message'], -2, 'utama', 1, $data);
	}
	public static function altenatif_send_massage($page, $id_chat_room, $pesan, $pengirim, $mode, $is_wa = 0, $data_wa = array(), $bot = null, $uniq = null, $check_bot = true, $tipe_pesan = 'message', $gambar = null)
	{
		$fai = new MainFaiFramework();

		//	 echo 'HADAD'. $page['conection_user'];die;

		$db_sort['query'] = 'SELECT max(sort) as last_sort FROM chat__room__pesan WHERE id_chat__room=' . $id_chat_room;
		$db_sort['non_add_select'] = true;
		// $db_sort['where'][] = array("id_chat__room", '=', $id_chat_room);
		$data = $fai->database_coverter($page, $db_sort, array(), 'all');

		$sqli3['id_chat__room'] = $id_chat_room;
		$sqli3['mode'] = $mode;
		$sqli3['id_pengirim'] = $pengirim;
		$sqli3['sort'] = (int) $data['row'][0]->last_sort + 1;
		$sqli3['tipe_pesan'] = $tipe_pesan;
		$sqli3['content_message'] = $pesan;
		$sqli3['package_bot'] = $bot ? $bot->package_bot : null;
		$sqli3['reply_package'] = $bot ? $bot->reply_package : null;
		$sqli3['kode_chat_room_bot'] = $bot ? $bot->kode_chat_room_bot : null;
		$sqli3['bot_unique_id'] = $uniq;
		if ($is_wa) {
			$sqli3['buffer_image'] = $data_wa['bufferImage'];
			$sqli3['bufferimagelink'] = isset($data_wa['bufferImageLink']) ? $data_wa['bufferImageLink'] : '';
			$sqli3['participant'] = $data_wa['participant'];
			$sqli3['send_wa'] = 3;
			if (!$check_bot) {
				$sqli3['send_wa'] = 2;
			}
		} else
			$sqli3['send_wa'] = 3;

		$return = CRUDFunc::crud_save($fai, $page, $sqli3, array(), array(), 'chat__room__pesan');
		$last_insert_id = $return['last_insert_id'];
		if ($tipe_pesan == 'media') {

			Filefunc::file_upload($page, "", $gambar, "Be3 Chat", "chat__room__pesan", $last_insert_id, "url");
		}
		if (!empty($data_wa['bufferImageLink']))
			Filefunc::file_upload($page, "", $data_wa['bufferImageLink'], "Be3 Chat", "chat__room__pesan", $last_insert_id, "url");

		if ($check_bot)
			ChatbotApp::router($page, $sqli3, $id_chat_room, $last_insert_id, $is_wa, $data_wa);
	}



	public static function proses_brodcast($page)
	{
		DB::connection($page);
		$fai = new MainFaiFramework();
		unset($database_check);
		$database_check['select'][] = '*';
		$database_check['select'][] = 'chat__broadcast.id as pid';
		$database_check['select'][] = 'chat__broadcast__list__pesan.id as id_pesan';
		$database_check['utama'] = 'chat__broadcast';
		$database_check['np'] = 'chat__broadcast__list__chat_room';
		$database_check['join'][] = array('chat__broadcast__list__pesan', "id_chat__broadcast", "chat__broadcast.id");
		$database_check['where'][] = array('frekuensi', ' = ', "'sekali'");
		$database_check['where'][] = array("coalesce(status,'belum')", ' != ', "'sudah'");
		// $database_check['where'][] = array('(generate_date',' != ',"'".date('Y-m-d')."'  or generate_date is null)");
		$database_check['where'][] = array("(concat(CAST(to_char(tanggal_mulai, 'YYYY-MM-DD') as VARCHAR), ' ',(waktu_mulai),':00'))", ' <= ', "'" . date('Y-m-d H:i:s') . "'");


		$row = Database::database_coverter($page, $database_check, array(), 'all');

		$count = 0;
		$count += $row['num_rows'];
		if ($row['num_rows']) {
			foreach ($row['row'] as $data) {
				ChatApp::proses_brodcast_to_generate($page, $data, $data->tanggal . " " . $data->waktu);
				$update['status'] = "sudah";
				DB::update("chat__broadcast", $update, ["id=$data->pid"]);
			}
		}
		unset($database_check);
		$database_check['select'][] = '*';
		$database_check['select'][] = 'chat__broadcast.id as pid';
		$database_check['select'][] = 'chat__broadcast__list__pesan.id as id_pesan';
		$database_check['select'][] = 'chat__broadcast__list__pesan.id as id_pesan';
		$database_check['utama'] = 'chat__broadcast';
		$database_check['np'] = 'chat__broadcast__list__chat_room';
		$database_check['join'][] = array('chat__broadcast__list__pesan', "id_chat__broadcast", "chat__broadcast.id");
		$database_check['where'][] = array('(frekuensi', ' = ', "'berulang harian' or frekuensi='berulang hari khusus')");
		$database_check['where'][] = array("coalesce(status,'belum')", ' != ', "'sudah'");
		$database_check['where'][] = array('(generate_date', ' != ', "'" . date('Y-m-d') . "'  or generate_date is null)");
		//$database_check['where'][] = array("(concat(CAST(to_char(tanggal, 'YYYY-MM-DD') as VARCHAR), ' ',(waktu),':00'))",' <= ',"'".date('Y-m-d H:i:s')."'");


		$row = Database::database_coverter($page, $database_check, array(), 'all');

		$count += $row['num_rows'];
		if ($row['num_rows']) {
			foreach ($row['row'] as $data) {
				echo 'hai';
				if ($data->berulang_dalam_satu_hari) {

					$date =  date("Y-m-d ") . $data->waktu_mulai;
					$i = true;
					while ($i == true) {
						if ($date > date("Y-m-d ") . "23:00") {
							$i = false;
						}
						if ($i) {
							$array[] = $date;
							$date = date('Y-m-d H:i:s', strtotime("$data->berulang_dalam_satu_hari", strtotime($date)));
						}
						echo $date;
						echo '<br>';
					}
				} else {
					$array[] = date("Y-m-d ") . $data->waktu_hari;
				}
				for ($i = 0; $i < count($array); $i++) {
					ChatApp::proses_brodcast_to_generate($page, $data, $array[$i]);
				}
				$update['generate_date'] = date('Y-m-d');
				if ($data->tanggal_akhir_broadcast < date('Y-m-d'))
					$update['status'] = "sudah";
				DB::update("chat__broadcast", $update, ["id=$data->pid"]);
			}
		}
		echo $count;
		return $count;
	}

	public static function proses_brodcast_to_generate($page, $data, $generate_tanggal)
	{
		echo $generate_tanggal;
		unset($db1);
		$db1['select'][] = 'distinct number_wa';
		$db1['utama'] = 'chat__broadcast__list__chat_room';
		$db1['np'] = 'chat__broadcast__list__chat_room';
		$db1['join'][] = array('chat__room__anggota', "id_chatroom", "id_chat__room");
		$db1['where'][] = array('id_chat__broadcast', ' = ', "$data->pid");
		$db1['where'][] = array('number_wa', ' is ', "not null");
		// $db1['where'][] = array('generate_tanggal',' <= ',"'".date('Y-m-d')."'");
		$row1 = Database::database_coverter($page, $db1, array(), 'all');
		if ($row1['num_rows']) {
			foreach ($row1['row'] as $data1) {
				$insert = array();
				$insert["generate_tanggal"] = $generate_tanggal;
				// $insert["generate_time"] = $data->waktu;
				$insert["status"] = "belum";
				$insert["number"] = $data1->number_wa;
				// $insert["sender"] = $data1->sender;
				$insert["id_pesan"] = $data->id_pesan;
				$insert["id_chat__broadcast"] = $data->pid;
				$insert["create_date"] = date('Y-m-d H:i:s');
				CRUDFunc::crud_insert(false, $page, $insert, [], 'chat__broadcast__generate', []);
			}
		}
		unset($db1);
		$db1['select'][] = 'distinct wa_number';
		$db1['utama'] = 'chat__broadcast__list__phone_book';
		$db1['np'] = 'chat__broadcast__list__chat_room';
		$db1['join'][] = array('chat_wa_phonebook__number', "id_phonebook", "id_chat_wa_phonebook");
		$db1['join'][] = array('chat_wa_number', "id_number", "chat_wa_number.id");
		$db1['where'][] = array('id_chat__broadcast', ' = ', "$data->pid");
		$db1['where'][] = array('wa_number', ' is ', "not null");
		// $db1['where'][] = array('generate_tanggal',' <= ',"'".date('Y-m-d')."'");
		$row1 = Database::database_coverter($page, $db1, array(), 'all');
		if ($row1['num_rows']) {
			foreach ($row1['row'] as $data1) {
				$insert = array();
				$insert["generate_tanggal"] = $generate_tanggal;
				// $insert["generate_time"] = $data->waktu;
				$insert["status"] = "belum";
				$insert["number"] = $data1->wa_number;
				// $insert["sender"] = $data1->sender;
				$insert["id_pesan"] = $data->id_pesan;
				$insert["id_chat__broadcast"] = $data->pid;
				$insert["create_date"] = date('Y-m-d H:i:s');
				CRUDFunc::crud_insert(false, $page, $insert, [], 'chat__broadcast__generate', []);
			}
		}
		unset($db1);
		$db1['select'][] = 'distinct number';
		$db1['utama'] = 'chat__broadcast__list__number';
		// $db1['join'][] = array('chat_wa_phonebook__number',"id_phonebook","id_chat_wa_phonebook");
		// $db1['join'][] = array('chat_wa_number',"id_number","chat_wa_number.id");
		$db1['where'][] = array('id_chat__broadcast', ' = ', "$data->pid");
		$db1['where'][] = array('number', ' is ', "not null");
		// $db1['where'][] = array('generate_tanggal',' <= ',"'".date('Y-m-d')."'");
		$row1 = Database::database_coverter($page, $db1, array(), 'all');
		if ($row1['num_rows']) {
			foreach ($row1['row'] as $data1) {
				$insert = array();
				$insert["generate_tanggal"] = $generate_tanggal;
				// $insert["generate_time"] = $data->waktu;
				$insert["status"] = "belum";
				$insert["number"] = $data1->number;
				// $insert["sender"] = $data1->sender;
				$insert["id_chat__broadcast"] = $data->pid;
				$insert["id_pesan"] = $data->id_pesan;
				$insert["create_date"] = date('Y-m-d H:i:s');
				CRUDFunc::crud_insert(false, $page, $insert, [], 'chat__broadcast__generate', []);
			}
		}
	}






	public function buat_grup()
	{
		$f = new MainFaiFramework();
		$ci = &get_instance();;
		$data['name'] = $_POST['nama'];
		$data['deskripsi'] = $_POST['deskripsi'];
		$data['pisahkan'] = $_POST['pisahkan'] ? 1 : 0;
		$data['grup_utama'] = $_POST['grup_utama'] ? 1 : 0;
		$data['wai_id'] = 'WAI' . '.' . random_num(6);
		$data['panel'] = $_SESSION['as'];
		$data['type'] = 'grup';
		$anggota_akhwat   = '';
		$anggota_ikhwan   = '';
		$anggota   = '#' . $_SESSION['id_apps'];
		$last_read = '';
		$last_read_akhwat = '';
		$last_read_ikhwan = '';
		$last_read .= '#0'; //untuk yang buat

		$jk = $ci->db->where('id_apps_user', $_SESSION['id_apps'])->get('apps_user')->row()->jk;
		if ($jk == 'Wanita') {
			$anggota_akhwat .= '#' . $_SESSION['id_apps'];
			$last_read_akhwat .= '#0';
		} else {
			$last_read_ikhwan .= '#0';
			$anggota_ikhwan .= '#' . $_SESSION['id_apps'];
		}



		$list_anggota  = $_POST['id_a_grup'];
		$list_anggota  = explode('-', $list_anggota);
		for ($i = 1; $i < count($list_anggota); $i++) {
			//echo $list_anggota[$i].'<br>';
			$anggota .= '#' . de($list_anggota[$i]);
			$last_read .= '#0';
			$jk = $ci->db->where('id_apps_user', de($list_anggota[$i]))->get('apps_user')->row()->jk;
			if ($jk == 'Wanita') {
				$anggota_akhwat .= '#' . de($list_anggota[$i]);
				$last_read_akhwat .= '#0';
			} else {
				$last_read_ikhwan .= '#0';
				$anggota_ikhwan .= '#' . de($list_anggota[$i]);
			}
		}

		$data['anggota'] =  $anggota;
		$data['anggota_ikhwan'] =  $anggota_ikhwan;
		$data['anggota_akhwat'] =  $anggota_akhwat;
		//print_r($_POST);

		$data['last_read'] = $last_read;
		$data['last_read_ikhwan'] = $last_read_ikhwan;
		$data['last_read_akhwat'] = $last_read_akhwat;
		//$data['id_panel'] = $_SESSION['id_organisasi'];
		$data['create_date'] = date('Y-m-d H:i:s');
		$data['admin'] = '#' . $_SESSION['id_apps'];
		$data['who_created'] = $_SESSION['id_apps'];
		$id         = $f->input_database('chat_room', $data);
		file_uploader('foto', 'chat', $id, "profile_grup");

		//redirect(base_url().'fai_page/redirect/2542?id='.$id);
		//echo $id.'<br>';
		$en_chat_Room = en('id_chat_room', true);
		$return['i' . $en_chat_Room] = en($id, true);
		echo json_encode($return);
	}





	public function join_room($id)
	{
		//$ci = &get_instance();
		$wholist = $_POST['who'];
		for ($i = 0; $i < count($wholist); $i++) {
			gabung_chat_room(null, null, de($wholist[$i]), null, null, null, $id, 2);
		}
		redirect(r('_chat', 'room/index'));
	}

	public function index($mode = null, $to_chat_active = null, $list_type_panel = null, $panel = null, $id_panel = null)
	{

		$ci = &get_instance();
		//$get= $ci->db->where('id_apps_user',$_SESSION['id_apps'])->get('program__User');
		if ($list_type_panel == 'chat_panel') {

			$page['header'] = $_SESSION['header'][$panel . '-' . $id_panel]['header'];
			$page['header_right'] = $_SESSION['header'][$panel . '-' . $id_panel]['header_right'];
		}



		$page['title'] = 'Chat';
		$page['header_subtitle'] = 'Chat Room';
		$page['mode'] = $mode;
		$page['id_panel'] = $id_panel;
		$page['to_chat_active'] = $to_chat_active;
		$page['panel'] = $panel;
		$page['list_type_panel'] = $list_type_panel;
		$page['content'] = '_v_chat/v_index_chat.php';
		//$page['row'] = $get->row();
		$page['container'] = 'containter-fluid pe-0 me-0 ms-md-5 pt-0 ms-0';
		$ci->load->view('layout/content', $page);
	}
}
