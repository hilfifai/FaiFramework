<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ElearningApp{
  

	public function __construct(){
		//parent::__construct();
		//session_start();
		
		//histori_user();
		//$ci->first_user();
		//	ini_set('session.cookie_domain', 'weareislam.id');
		$ci        = &get_instance();
		$ci->load->model('M_quran','quran');

	}
	public function header($id_program){
		$header['nama'][] = 'Home';
		$header['link'][] = r('_program','Elearning/index/'.$id_program);
		$header['active'][] = array($header['link'][0]);
		
		$header['nama'][] = 'Classroom';
		$header['link'][] = r('_program','Elearning/list_kelas/'.$id_program);
		$header['active'][] = array($header['link'][1]);
		  
		$header['nama'][] = 'Review';
		$header['link'][] = r('_program','Elearning/page_review/'.$id_program);
		$header['active'][] = array($header['link'][2]);
		
		$header['nama'][] = 'Transkrips';
		$header['link'][] = r('_program','Elearning/Raport/'.$id_program);
		$header['active'][] = array($header['link'][3]);
		return $header;
	}public function header_right($id_program){
		//ulasan
		$header['icon'][] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>';
		$header['link'][] = r('_program','List_/ulasan/'.$id_program);
		$header['active'][] = array($header['link'][0]);
		//cha
		$header['icon'][] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" /><line x1="8" y1="9" x2="16" y2="9" /><line x1="8" y1="13" x2="14" y2="13" /></svg>';
		$header['link'][] = r('_chat','Room/index///chat_panel/program/'.$id_program); 
		$header['active'][] = array($header['link'][1]);
		if($_SESSION['id_apps']=='2021031816193639478'){
			
		$header['icon'][] = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>';
		$header['link'][] = r('_program','Elearning/hitung_score');
		$header['active'][] = array($header['link'][0]);
		}
		
		
		 
		 
		return $header;
	}
	
	public function hitung_score(){
		$ci        = &get_instance();
		$page['content'] = '_v_program/_elearning/page/v_hitung_score.php';
		$ci->load->view('layout/content',$page);
	}
	
	public function index($id_program){
		$ci        = &get_instance();
		$get = $ci->db->where('id_apps_user',$_SESSION['id_apps'])->where('id_program',$id_program)->get('program__user');
		$page['content'] = '_v_program/_elearning/v_dashboard.php';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program);
		$page['mutqin_user'] = $get->row();
		$_SESSION['header'] = array(
			"program-".$id_program=>array('header'=>$this->header($id_program),'header_right'=>$this->header_right($id_program))
		);
		$ci->load->view('layout/content',$page);
	}public function raport($id_program){
		$ci        = &get_instance();
		$page['content'] = '_v_program/_elearning/v_raport.php';   
		$page['header'] = $this->header($id_program);
		$page['id_program'] = $id_program;
		$page['header_right'] = $this->header_right($id_program);
		
		$ci->load->view('layout/content',$page);
	}
	public function list_kelas($id_program){ 
		$ci        = &get_instance();
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$page['get'] = $get->row();
		
		$page['content'] = '_v_program/_elearning/v_list_kelas.php'; 
		$page['header'] = $this->header($id_program); 
		$page['header_right'] = $this->header_right($id_program); 
		$page['js'][] = 'js_php/_program/_ulum_quran/v_js_dashboard_mutqin.php';;
		$ci->load->view('layout/content',$page);
	}
	public function misi_aktivasi($id_kelas,$id_program)
	{
		$ci        = &get_instance();
		$page['content'] = '_v_program/_elearning/v_misi_aktivasi.php';
		$page['id_kelas'] = $id_kelas;
		$page['id_program'] = $id_program;
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$page['get'] = $get->row();
		$page['header'] = $this->header($id_program); 
		$page['header_right'] = $this->header_right($id_program); 
		$ci->load->view('layout/content',$page);
	}
	public function Aktivasi($id_kelas,$id_program)
	{
		$ci        = &get_instance();
		if(isset($_FILES['misi1'])){ 
		
			file_uploader('misi1','AktivasiMisi1Surat-'.$id_kelas,$_SESSION['id_apps'],'program/aktivasi/misi1');
			file_uploader('misi2','AktivasiMisi2Surat-'.$id_kelas,$_SESSION['id_apps'],'program/aktivasi/misi2');
			file_uploader('misi3','AktivasiMisi3Surat-'.$id_kelas,$_SESSION['id_apps'],'program/aktivasi/misi3');
			file_uploader('misi4','AktivasiMisi4Surat-'.$id_kelas,$_SESSION['id_apps'],'program/aktivasi/misi4');
			file_uploader('misi5','AktivasiMisi5Surat-'.$id_kelas,$_SESSION['id_apps'],'program/aktivasi/misi5'); 

		}  
		
		$get = $ci->db->where('id_program_elearning_kelas',$id_kelas)->get('program_elearning__kelas')->row()->user_aktif;
		$update['user_aktif'] =$get.'##'.$_SESSION['id_apps'];
		$ci->db->where('id_program_elearning_kelas',$id_kelas)->update('program_elearning__kelas',$update);
		//echo $ci->db->last_query();
		redirect(r('_program','elearning/quizzes/'.$id_kelas.'/'.$id_program));
	}
	public function quizzes($id_kelas,$id_program){
		//echo $slug;  
		$ci        = &get_instance();
		
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$kelas = $ci->db->where('id_program_elearning_kelas',$id_kelas)->get('program_elearning__kelas');
		
		$page['get'] = $get->row();
		$page['kelas'] = $kelas->row();
		$page['id_kelas'] = $id_kelas;
		$page['id_program'] = $id_program;
		$page['header_right'] = $this->header_right($id_program); 
		$page['header'] = $this->header($id_program);
		$page['content'] = '_v_program/_elearning/v_list_content_level.php';
		
		
		$ci->load->view('layout/content',$page);
	} public function load_materi(){
		//$page[''] = $;
		$ci        = &get_instance();
		$type = $_POST['t'];
		$id_mata = de($_POST['a']);
		$id_program = de($_POST['b']);
		$mata = $ci->db->where('id_program_elearning_mata',$id_mata)->get('program_elearning__mata');
		$kelas = $ci->db->where('id_program_elearning_kelas',$mata->row()->id_program_elearning_kelas)->get('program_elearning__kelas');
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$page['get'] = $get->row();
		$page['kelas'] = $kelas->row();
		$page['id_program'] = $id_program;
		$page['id_mata'] = $id_mata;
		$page['mata'] = $mata;
		$ci->load->view('_v_program/_elearning/v_list_content_materi_ajax_'.$type.'.php',$page);
	}public function load_materi_loop(){
		//$page[''] = $;
		$ci        = &get_instance();
		$id_loop = de($_POST['t']);
		$task_level = de($_POST['z']);
		$id_mata = de($_POST['a']);
		$id_program = de($_POST['b']);
		$mata = $ci->db->where('id_program_elearning_mata',$id_mata)->get('program_elearning__mata');
		$kelas = $ci->db->where('id_program_elearning_kelas',$mata->row()->id_program_elearning_kelas)->get('program_elearning__kelas');
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$page['get'] = $get->row();
		$page['kelas'] = $kelas->row();
		$page['task_level'] = $task_level;
		$page['id_program'] = $id_program;
		$page['id_loop'] = $id_loop;
		$page['id_mata'] = $id_mata;
		$page['mata'] = $mata;
		$ci->load->view('_v_program/_elearning/v_list_content_materi_ajax_loop.php',$page);
	} public function list_content_materi($id_mata,$id_program){
		$ci        = &get_instance();
		$mata = $ci->db->where('id_program_elearning_mata',$id_mata)->get('program_elearning__mata');
		$kelas = $ci->db->where('id_program_elearning_kelas',$mata->row()->id_program_elearning_kelas)->get('program_elearning__kelas');
		$get = $ci->db->where('id_program',$id_program)->get('program');
		$page['get'] = $get->row();
		$page['kelas'] = $kelas->row();
		$page['id_program'] = $id_program;
		$page['id_mata'] = $id_mata;
		$page['mata'] = $mata;
		$page['content'] = '_v_program/_elearning/v_list_content_materi.php';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$ci->load->view('layout/content',$page);
	} public function to_take($id_task,$id_mata,$id_program,$mode=null,$token_mode='standar',$id_loop=null,$id_loop_object=null){
		$ci        = &get_instance();
		$token       = $ci->db
		
		->where('id_apps_user',$_SESSION['id_apps'])->where('id_program',$id_program)->where('status','aktif')->get('program_elearning__user_token');
		$task_taken = $ci->db->where('id_program_elearning_task',$id_task)->get('program_elearning__task')->row();
	
		//echo ($token->num_rows() and $id_task == $token->row()->id_program_elearning_task and $id_program == $token->row()->id_program);
		//echo $mode.''; 
		//echo $token->num_rows() and !$mode and !(($token_mode=='standar' and  ($id_task != $token->row()->id_program_elearning_task or $id_program != $token->row()->id_program)) or ($token_mode=='loop' and  ($id_task != $token->row()->id_program_elearning_task or $id_program != $token->row()->id_program) and $id_loop_object ==$token->row()->id_loop_object));
		if($token->num_rows() and $id_task == $token->row()->id_program_elearning_task and $id_program == $token->row()->id_program and !$mode and ($token_mode=='standar' or ($token_mode=='loop' and $id_loop_object ==$token->row()->id_loop_object))){
			redirect(r('_program','elearning/take/'.$id_task.'/'.$id_mata.'/'.$id_program));
		//echo ($id_loop_object );
		}
		else
		if($token->num_rows() and  !$mode and !(($token_mode=='standar' and  ($id_task != $token->row()->id_program_elearning_task or $id_program != $token->row()->id_program)) or ($token_mode=='loop' and  ($id_task != $token->row()->id_program_elearning_task or $id_program != $token->row()->id_program) and $id_loop_object ==$token->row()->id_loop_object))){
		//	echo 'm';
			$page['content'] = '_v_program/_elearning/v_token_taking.php';
			$page['bg'] = 'bg-grey';
			$page['id_task'] = $id_task;
			$page['id_program'] = $id_program;
			$page['id_mata'] = $id_mata; 
			$page['token_mode'] = $token_mode;
			$page['id_program_elearning_task_loop'] = $id_loop;
			$page['id_loop_object'] = $id_loop_object;

			$ci->load->view('layout/content',$page);
		}
		
		else{
			//echo $en.' < br > ';
			//echo 'mm';
			//menonaktifkan semua
			if($mode=='end_and_new'){
				//masul
				//echo 'masuk';
				$this->save_all_answer('get_new',$id_task,$id_mata,$id_program,null,$token_mode,$id_loop,$id_loop_object)	;
			}else{
				$this->save_all_answer('empty_action',$id_task,$id_mata,$id_program,null,$token_mode,$id_loop,$id_loop_object)	;
			
				//
				$data['id_apps_user'] = $_SESSION['id_apps'];
				$data['date_taked'] = dat();
			
			
				$data['status'] = 'aktif';
				$data['id_program_elearning_task'] = $id_task;
				$data['id_program_elearning_mata'] = $id_mata;
				//$data['id_program_elearning_kelas'] = $id_kelas;
				$data['token_mode'] = $token_mode;
				$data['id_program_elearning_task_loop'] = $id_loop;
				$data['id_loop_object'] = $id_loop_object;
				$data['id_program'] = $id_program;
			
				$id_pertanyaan_aktif = $ci->db->where('id_program_elearning_task',$id_task)->order_by('sort')->limit(1)->get('program_elearning__pertanyaan');
				
				$data['id_pertanyaan_aktif'] = $id_pertanyaan_aktif->row()->id_program_elearning_pertanyaan;
				if($id_pertanyaan_aktif->num_rows()){
				$ci->db->insert('program_elearning__user_token',$data);
				}else{
					redirect(r('_program','elearning/no_result/'.$id_task.'/'.$id_mata.'/'.$id_program));
				}
			}
			redirect(r('_program','elearning/take/'.$id_task.'/'.$id_mata.'/'.$id_program));
		}
	} 
	public function no_result($id_task,$id_mata,$id_program){
		$ci        = &get_instance();
		$page['content'] = '_v_program/_elearning/v_empty_pertanyaan.php';
		$page['bg'] = 'bg-grey';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$page['id_task'] = $id_task;
		$page['id_program'] = $id_program;
		$page['id_mata'] = $id_mata;
		$ci->load->view('layout/content',$page);
	}
	public function take($id_task,$id_mata,$id_program){
		$ci        = &get_instance();
		$page['content'] = '_v_program/_elearning/v_take_question.php';
		$page['bg'] = 'bg-grey';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$page['id_task'] = $id_task;
		$page['id_program'] = $id_program;
		$page['id_mata'] = $id_mata;
		$ci->load->view('layout/content',$page);
	}
	public function level(){
		$ci        = &get_instance();
		$page['bg'] = 'bg-grey';
		
		$page['id_pertanyaan_aktif'] = de($ci->input->post('p1')) ; 
		$page['id_task'] = de($ci->input->post('p2')) ; 
		$page['id_mata'] = de($ci->input->post('p3')) ; 
		$page['id_program'] = de($ci->input->post('p4')) ; 
		//print_r($_POST); 
		$get = $ci->db->where('id_program',$page['id_program'])->get('program');
		$page['get'] = $get->row();
		$ci->load->view('_v_program/_elearning/v_take_question_load.php',$page);
	}
	
	private function to_insert($insert)
	{
		
			
			$ci        = &get_instance();
			$where = $insert;
			unset($where['answer']);
			unset($where['answer_key']);
			unset($where['type_answer']);
			$get = $ci->db->where($where)->get('program_elearning__user_jawab');
			$insert['waktu'] = $ci->input->post('waktu_pengerjaan');;
			$insert['updated_at'] = date('Y-m-d H:i:s');;
			if(!$get->num_rows())
			{
				$insert['created_at'] = date('Y-m-d H:i:s');;
				$ci->db->insert('program_elearning__user_jawab',$insert);
				return $ci->db->insert_id();
			}
			else
			{
				$ci->db->where('id_program_elearning_user_jawab',$get->row()->id_program_elearning_user_jawab);
				$ci->db->update('program_elearning__user_jawab',$insert);
				return $get->row()->id_program_elearning_user_jawab;
			}
		
	}
	public function save_answer()
	{
		$ci        = &get_instance();
		$user_take      =de($ci->input->post('user_task'));
		$ci->db->join('program_elearning__pertanyaan','program_elearning__pertanyaan.id_program_elearning_pertanyaan=program_elearning__user_task.id_program_elearning_pertanyaan');
	//	$this->db->join('program_elearning__task','program_elearning__task.id_program_elearning_task=program_elearning__user_token.id_program_elearning_task');
		$row = $ci->db->where('id_program_elearning_user_task',$user_take)->get('program_elearning__user_task')->row();
		//->where('id_apps_user',$_SESSION['id_apps'])->where('id_program_elearning_token',$id_program)->where('status','aktif')
		$type = $row->type;
		$id_token = $row->id_program_elearning_user_token;
		$all = 
		$filled = 0;
		if($type == 'puzzle')
		{

			$insert = array(
				'id_program_elearning_user_token'    =>$id_token,
				'id_program_elearning_user_task'=>$user_take,
				'locked'      =>0,
			);
			if($ci->input->post('tabs_value') == 'Manual')
			{
				$insert['type_answer'] = $ci->input->post('tabs_value');
				$insert['answer'] = $ci->input->post('answer');
				$insert['answer_key'] = null;
			}
			else 
			if($ci->input->post('tabs_value') == 'Puzzle')
			{ 
				$insert['type_answer'] = $ci->input->post('tabs_value');
				$insert['answer_key'] = $ci->input->post('answer_puzle_key');
				$insert['answer'] = $ci->input->post('answer_puzle_value');

			}
			$this->to_insert($insert);
		}
		else
		if($type == 'file')
		{
			$insert = array(
				'id_program_elearning_user_token'    =>$id_token, 
				'id_program_elearning_user_task'=>$user_take,
				'type_answer'        =>'file',
				'locked'      =>0,
			);
			//	print_r($ci->input->post());
			$id = $this->to_insert($insert);
			file_uploader('file','quiz_setoran_'.$user_take,$id,'program/setoran');


		}
		else
		if($type == 'puzzle_form')
		{
			if($ci->input->post('tabs_value') == 'Manual')
			{
				$insert['answer_key'] = null;
				$key          = $ci->input->post('answer-multiple-Key');
				$value        = $ci->input->post('answer-multiple-Value');
				$total_filled = 0;
				for($i = 0; $i < count($key) - 1; $i++)
				{
					$insert = array(
						'id_program_elearning_user_token'    =>$id_token,
						'id_program_elearning_user_task'=>$user_take,
						'type_answer'        =>$ci->input->post('tabs_value'),
						'locked'      =>0,
						'form_sort'   =>$i + 1,
						'answer_key'  =>$key[$i],
						'answer'      =>$value[$i],
					);
					//print_r($insert);
					$this->to_insert($insert);
					$total_filled = !empty($value[$i]) ? $total_filled + 1:$total_filled;
				}
				$filled = $total_filled == count($key) - 1?1:0;

			}
			else
			{

				$id_collect   = explode('-',$ci->input->post('colect_puzzle_form_id'));
				//print_r($id_collect);
				$total_filled = 0;
				for($i = 0; $i < count($id_collect) - 1; $i++)
				{
					$insert = array(
						'id_program_elearning_user_token'    =>$id_token,
						'id_program_elearning_user_task'=>$user_take,
						'locked'      =>0,
						'type_answer'        =>$ci->input->post('tabs_value'),
						'form_sort'   =>$i + 1,
						'answer_key'  =>$id_collect[$i],
						'answer'      =>$ci->input->post('answer_puzle')[$id_collect[$i]],
					);
					//print_r($insert);
					$this->to_insert($insert);
					$total_filled = !empty($ci->input->post('answer_puzle')[$id_collect[$i]]) ? $total_filled + 1:$total_filled;
				}
				$filled = $total_filled == count($id_collect) - 1?1:0;
			}
		}
		else
		{

			$insert = array(
				'id_program_elearning_user_token'    =>$id_token,
				'answer'      =>$ci->input->post('answer'),
				'id_program_elearning_user_task'=>$user_take,
				'locked'      =>0,
			);
			$this->to_insert($insert);
		}

		//tidak kosong dan
		//echo $type;
		if(!empty($ci->input->post('answer') or $type == 'info' or $type == 'perintah' or $type == 'info_ulumul' ) or !empty($ci->input->post('answer_puzle_value') or $filled))
		{
			$update['has_filled'] = 1;
			$update['updated_at'] = date('Y-m-d H:i:s');;
			$ci->db->where('id_program_elearning_user_task',$user_take);
			$ci->db->update('program_elearning__user_task',$update);
			//echo 'hai';
			$list_question = $ci->db->where('id_program_elearning_task',$row->id_program_elearning_task)->get('program_elearning__pertanyaan')->result();				
			foreach($list_question as $list){ 
				$list_kuis[] = $list->id_program_elearning_pertanyaan;
			}
			
			if($id_pertanyaan_aktif == $list_kuis[count($list_kuis)-1]){
				$data['id_pertanyaan_aktif'] = $list_kuis[count($list_kuis)-1];
			}else{
				$data['id_pertanyaan_aktif'] = $list_kuis[array_search($id_pertanyaan_aktif, $list_kuis)+1] ;
			}
			
			
			
			$ci->db->where('id_program_elearning_user_token',$id_token);
			$ci->db->update('program_elearning__user_token',$data);
			$status = 1;

		} 
		else
		{
			$status = 2;
			//data kosong

		}
		//$data['notif'] =
		echo "notif('".$user_take."','$status')";
	}
	public function notif($id,$status)
	{
		$ci        = &get_instance();
		$query = $ci->db->where('id_program_elearning_user_task',$id)->join('program_elearning__pertanyaan','program_elearning__user_task.id_program_elearning_pertanyaan=program_elearning__pertanyaan.id_program_elearning_pertanyaan')->get('program_elearning__user_task')->row();;
		if($status == 1)
		{
			$alert = 'success';
			$text  = 'Sesi jawaban '.$query->nama_task.' berhasil disimpan.';
		}
		else
		if($status == 2)
		{
			$alert = 'warning';
			$text  = 'Sesi jawaban '.$query->nama_task.' Masiih Kosong.';
		}
		else
		if($status == 3)
		{
			$alert = 'primary';
		}
		echo '<div class="alert alert-'.$alert.' alert-dismissible" role="alert">
		<div class="d-flex">
		<div>
		<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
		<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
		<path d="M5 12l5 5l10 -10"></path>
		</svg>
		</div>
		<div>
		<h4 class="alert-title">Kuis Al Fatihah Sesi '.$query->pertanyaan.'  </h4>
		<div class="text-muted">'.$text.'</div>
		</div>
		</div>
		<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
		</div>';


	}
	public function save_all_answer($mode = null,$id_task=null,$id_mata=null,$id_program=null,$mode2=null,$token_mode='standar',$id_loop=null,$id_loop_object=null)
	{
		
		$ci        = &get_instance();
		$tokens = $ci->db->where('id_apps_user',$_SESSION['id_apps'])->where('id_program',$id_program)->where('status','aktif')->get('program_elearning__user_token');
		
		foreach($tokens->result() as $token){
		$query = $ci->db
				->where('id_program_elearning_user_token',$token->id_program_elearning_user_token)
				->get('program_elearning__user_task');

		foreach($query->result() as $save)
		{
			$update['locked'] = 1;
			$update['locked_at'] = dat();
			$ci->db->where('id_program_elearning_user_task',$save->id_program_elearning_user_task);
			$ci->db->update('program_elearning__user_jawab',$update);
   
 
			$update2['status'] = 'SCRORING';
			$ci->db->where('id_program_elearning_user_task',$save->id_program_elearning_user_task);
			$ci->db->update('program_elearning__user_task',$update2);

			
		}
			$update3['date_done'] = dat();
			$update3['status'] = 'scoring';
			$ci->db->where('id_program_elearning_user_token',$token->id_program_elearning_user_token);
			$ci->db->update('program_elearning__user_token',$update3);
		}
		if($mode=='empty_action')
		{
		}else if($mode)
		{
			//echo $id_loop;
			redirect(r('_program','elearning/to_take/'.$id_task.'/'.$id_mata.'/'.$id_program.'/get_new'.'/'.$token_mode.'/'.$id_loop.'/'.$id_loop_object));
			
		}
		else  
		{
			
			 redirect( r('_program','elearning/list_content_materi/'.$id_mata.'/'.$id_program)); 
		} 
		

	}
	public function summary($id_program,$id_mata)
	{
		$ci        = &get_instance();
		
		
		$token       = $ci->db->where('id_apps_user',$_SESSION['id_apps'])
		->where('id_program',$id_program)
		->where('program_elearning__user_token.status','aktif')
		->join('program_elearning__user_task','program_elearning__user_token.id_program_elearning_user_token = program_elearning__user_task.id_program_elearning_user_token')
		->join('program_elearning__user_jawab','program_elearning__user_jawab.id_program_elearning_user_task = program_elearning__user_task.id_program_elearning_user_task')
		->join('program_elearning__pertanyaan','program_elearning__user_task.id_program_elearning_pertanyaan = program_elearning__user_task.id_program_elearning_pertanyaan')
		->join('program_elearning__task','program_elearning__task.id_program_elearning_task = program_elearning__pertanyaan.id_program_elearning_task')
		->join('program_elearning__task_level','program_elearning__task.id_program_elearning_task_level = program_elearning__task_level.id_program_elearning_task_level')
		->get('program_elearning__user_token');
		
		//echo $ci->db->last_query();
		$page['token'] = $token;
		$page['id_mata'] = $id_mata;
		$page['id_program'] = $id_program;
		$page['content'] = '_v_program/_elearning/v_take_summary.php';
		$page['bg'] = 'bg-grey';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$ci->load->view('layout/content',$page);
	}public function page_review($id_program)
	{
		$ci        = &get_instance(); 
		$page['id_program'] = $id_program;
		$page['content'] = '_v_program/_elearning/v_review.php';
		$page['bg'] = 'bg-grey';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$page['js'][] = 'js_php/_program/_ulum_quran/v_js_dashboard_mutqin.php';;
		$ci->load->view('layout/content',$page);
		
	}public function table($tgl=null)
	{
		$ci        = &get_instance();
		$limit = $ci->input->post('limit');
		$start = $ci->input->post('start');
		$tgl =  $ci->input->post('tgl');
		$ci->db->where('DATE_FORMAT(`date_taked`,"%Y-%m-%d")',$tgl);  
		
		$query = $ci->db
		->limit($limit,$limit*$start)
		->where('id_apps_user',$_SESSION['id_apps'])->get('program_elearning__user_token')->result();
		$table = '';  
		//$table .=  $ci->db->last_query(); 
		$i=0;
		foreach($query as $baris){
		$i+=1;
		$tgl_kerja= (nice_date($baris->date_taked,'d M Y'));
		$status= '<br><code>'.$baris->status.'</code>';
		
		$score= $baris->score;
		$point= $baris->point;
		$end_to_score = $baris->end_to_score ;
		$persen_pengerjaan = $baris->presentase_pengerjaan ;
		$kelas_mata = $ci->db->where('id_program_elearning_mata',$baris->id_program_elearning_mata)
				->join('program_elearning__kelas','program_elearning__kelas.id_program_elearning_kelas = program_elearning__mata.id_program_elearning_kelas')
				->get('program_elearning__mata')->row();
		$task = $ci->db->where('id_program_elearning_task',$baris->id_program_elearning_task)
				->get('program_elearning__task')->row(); 
		$type_task= '  <code>'.$task->type_task.'</code>';
		$quiz= ' Mata Kelas '.$kelas_mata->nama_mata.' Task '.$task->nama_task;
		$onclick = 'onclick="document.location = '."'".r('_program','elearning/review/'.en('review_pengerjaan').'RPWAAII'.$baris->id_program_elearning__user_token.'/'.$baris->id_program.'/'.$baris->id_program_elearning_mata)."'".'"';
			$table .= "
			<tr $onclick>
							<td class='w-1'>
								$i
							</td>
							<td class='td-truncate'>
								<div class='text-truncate'>
									$quiz $status $type_task
								</div>
								<div class='text-muted'>
								<span>Score : $score/$end_to_score</span>
								<span>Point : $point</span>
								<span>Persen Pengerjaan : $persen_pengerjaan</span></div>
							</td>
							<td class='text-nowrap text-muted'>
								$tgl_kerja
							</td>
						</tr>
			";
			
		}
		if(!$table){
			$table = '<div class="p-3">
				Tidak ada aktivitas di tanggal '.tgl_indo_fd($tgl).'
			</div>';
			
			
		}
		$data['table'] =  $table;
		$data['pagination'] =  paginate($limit,$start,$i,'loadTable');
		echo json_encode($data);
	}public function review($id,$id_program,$id_mata)
	{
		$ci        = &get_instance();
		$id = explode('RPWAAII',$id)[1];
		//echo $id;
		
		$token  = $ci->db
		->where('program_elearning__user_token.id_program',$id_program)
		->where('program_elearning__user_token.id_program_elearning_mata',$id_mata)
		->where('program_elearning__user_token.id_program_elearning_user_token',$id)
		 
		->join('program_elearning__user_jawab','program_elearning__user_token.id_program_elearning_user_token = program_elearning__user_jawab.id_program_elearning_user_token','left')
		->join('program_elearning__user_task','program_elearning__user_jawab.id_program_elearning_user_task = program_elearning__user_task.id_program_elearning_user_task','left')
		->join('program_elearning__pertanyaan','program_elearning__user_task.id_program_elearning_pertanyaan = program_elearning__pertanyaan.id_program_elearning_pertanyaan','left')
		->join('program_elearning__task','program_elearning__task.id_program_elearning_task = program_elearning__user_token.id_program_elearning_task','left')
		
		->get('program_elearning__user_token');
		
		$page['token'] = $token;
		$page['id_program'] = $id_program;
		$page['id_mata'] = $id_mata;
		$page['id'] = $id;
		$page['content'] = '_v_program/_elearning/v_take_review.php';
		$page['bg'] = 'bg-grey';
		$page['header'] = $this->header($id_program);
		$page['header_right'] = $this->header_right($id_program); 
		$ci->load->view('layout/content',$page);
	}
	

}