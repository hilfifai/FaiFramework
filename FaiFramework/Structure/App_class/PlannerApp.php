<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Planner{
	 
	public function index(){ 
		$ci        = &get_instance(); 
		$page['content'] = '_v_lifetime_work/planner/index_planner_page.php';
		$page['header'] = ltw_header(); 
		$ci->load->view('layout/content',$page);
	
	} 
	public function tambah_board(){ 
		$ci        = &get_instance(); 
		$page['content'] = '_v_lifetime_work/planner/tambah_planner_board.php';
		$page['header'] = ltw_header(); 
		$ci->load->view('layout/content',$page);
	}
	public function board($id){ 
		$ci        = &get_instance(); 
		$page['content'] = '_v_lifetime_work/planner/planner_board.php';
		$page['header'] = ltw_header(); 
		$page['planner'] = $ci->db->where('id_ltw_planner',$id)->get('ltw_planner')->row(); 
		$page['id'] = $id; 
		$ci->load->view('layout/content',$page);
	} public function detail($id,$id_planner){ 
		$ci        = &get_instance(); 
		$page['treatment'] = $ci->db->where('id_ltw_planner_treatment',$id)->get('ltw_planner__treatment')->row(); 
		$page['id'] = $id; 
		;
		$page['detail'] = $page; 
		$page['content'] = '_v_lifetime_work/planner/planner_board_detail.php';
		$page['header'] = ltw_header(); 
		
		$page['id_planner'] = $id_planner; 
		$ci->load->view('layout/content',$page);
	} 
	public function load_task(){ 
		$ci        = &get_instance();  
	
		
		$query= $ci->db->where('ltw_planner__treatment_sub.id_ltw_planner_treatment',de($_POST['k']))->order_by('date_pengerjaan')
		->join('ltw_planner__pengerjaan','ltw_planner__treatment_sub.id_ltw_planner_treatment_sub = ltw_planner__pengerjaan.id_ltw_planner_treatment_sub')->order_by('start_time_pengerjaan')->get('ltw_planner__treatment_sub');
		  
		$page['query'] = $query; 
		$page['type_task'] = $ci->db->select('type_task')->where('id_ltw_planner_treatment',$query->row()->id_ltw_planner_treatment)->get('ltw_planner__treatment')->row()->type_task; 
		$ci->load->view('_v_lifetime_work/planner/planner_board_detail_ajax.php',$page);
	} 
	public function ajax_get_edit(){  
		$ci        = &get_instance(); 
		global $f;
		$id        = de($ci->input->post('k'));
		$data =$ci->db->where('ltw_planner__treatment_sub.id_ltw_planner_treatment_sub',$id)->join('ltw_planner__pengerjaan','ltw_planner__treatment_sub.id_ltw_planner_treatment_sub = ltw_planner__pengerjaan.id_ltw_planner_treatment_sub')->get('ltw_planner__treatment_sub')->row();
		
		$who = explode('#',$data->who_pengerjaan);
		$en_who=''; 
		for($i = 1; $i < count($who); $i++){
			$en_who.=en($who[$i],true).'#';
			 
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
	public function delete_task(){  
		$ci        = &get_instance(); 
		global $f;
		$id        = de($ci->input->post('k'));
		$f->delete_database('ltw_planner__treatment_sub',$id);
	}
	public function tambah_multi_task(){  
		$ci        = &get_instance(); 
		global $f;
		$task        		= $ci->input->post('task_progress');
		$sub_task_post       = $ci->input->post('task_progres');
		$id_treatment        = de($ci->input->post('b'));
		$penugasan=''; 
			$i = 0;
			$sub['nama_sub_task'] = $task[$i];
			if($_POST['type'] == 'add'){
				$sub['id_ltw_planner_treatment'] =$id_treatment;
				$id_sub=$f->input_database('ltw_planner__treatment_sub',$sub);
			}else{
				$id_sub = de($_POST['c']);
				$f->update_database('ltw_planner__treatment_sub',$id_sub,$sub);
			}
			
			$sub_task['id_ltw_planner_treatment'] =$id_treatment;
			$sub_task['id_ltw_planner_treatment_sub'] =$id_sub;
				
			$sub_task['date_pengerjaan'] = $sub_task_post['date'][$i];
			$sub_task['start_time_pengerjaan'] = $sub_task_post['start_time'][$i];
			$sub_task['end_time_pengerjaan'] = $sub_task_post['end_time'][$i];
			$sub_task['who_pengerjaan'] = '';
			if(isset($sub_task_post['who'][$i])){
				$who        = $sub_task_post['who'][$i];
				for($j = 0;$j < count($who);$j++){
					$who[$j] = de($who[$j]);
					$sub_task['who_pengerjaan'] .= '#'.$who[$j];
					if(!in_array($who[$j],explode('#',$penugasan))){
						$penugasan.='#'.$who[$j];
					}
				}
			}else{
				$ci->db->where('id_ltw_planner_treatment',$id_treatment);
				$sub_task['who_pengerjaan'] = $ci->db->select('ltw_planner.terlibat')
				->join('ltw_planner__kegiatan','ltw_planner__kegiatan.id_ltw_planner_kegiatan = ltw_planner__treatment.id_ltw_planner_kegiatan')
				->join('ltw_planner','ltw_planner__kegiatan.id_ltw_planner = ltw_planner.id_ltw_planner')->get('ltw_planner__treatment')
				->row()->terlibat;
			}
			if($_POST['type'] == 'add'){
				$f->input_database('ltw_planner__pengerjaan',$sub_task);
			}else{
				$f->update_database('ltw_planner__pengerjaan',$id_sub,$sub_task,'id_ltw_planner_treatment_sub');
			}
			
						
	} 
	public function tambah_task($id,$id_planner){ 
		$ci        = &get_instance(); 
		$page['content'] = '_v_lifetime_work/planner/tambah_task.php';
		$page['header'] = ltw_header(); 
		$page['planner'] = $ci->db->where('id_ltw_planner_kegiatan',$id)->get('ltw_planner__kegiatan')->row(); 
		$page['id'] = $id; 
		$page['id_planner'] = $id_planner; 
		$ci->load->view('layout/content',$page);
	} 
	public function save_tambah_task($id,$id_planner){ 
		$ci        = &get_instance(); 
		global $f;
		$data = $_POST[en('data',true)];
		$terlibat        = $ci->input->post('terlibat');
		$data['deadline'] .= ' '.$ci->input->post('deadline_jam');
		$data['id_ltw_planner_kegiatan']=$id;
		
		$id_treatment = $f->input_database('ltw_planner__treatment',$data);
		$penugasan='';
		if($data['type_task']=='sub'){
			
			$task        		= $ci->input->post('task_progress');
			$sub_task_post        = $ci->input->post('task_progres');
			$sub['id_ltw_planner_treatment'] =$id_treatment;
			for($i = 0;$i < count($task);$i++){
				$sub['nama_sub_task'] = $task[$i];
				$id_sub=$f->input_database('ltw_planner__treatment_sub',$sub);
			
				$sub_task['id_ltw_planner_treatment'] =$id_treatment;
				$sub_task['id_ltw_planner_treatment_sub'] =$id_sub;
				
				$sub_task['date_pengerjaan'] = $sub_task_post['date'][$i];
				$sub_task['start_time_pengerjaan'] = $sub_task_post['start_time'][$i];
				$sub_task['end_time_pengerjaan'] = $sub_task_post['end_time'][$i];
				$sub_task['who_pengerjaan'] = '';
				if(isset($sub_task_post['who'][$i])){
						
					
					$who        = $sub_task_post['who'][$i];
					for($j = 0;$j < count($who);$j++){
						$who[$j] = de($who[$j]);
						$sub_task['who_pengerjaan'] .= '#'.$who[$j];
						if(!in_array($who[$j],explode('#',$penugasan))){
							$penugasan.='#'.$who[$j];
						}
					}
				}else{
					$ci->db->where('id_ltw_planner_treatment',$id_treatment);
				$sub_task['who_pengerjaan'] = $ci->db->select('ltw_planner.terlibat')
						->join('ltw_planner__kegiatan','ltw_planner__kegiatan.id_ltw_planner_kegiatan = ltw_planner__treatment.id_ltw_planner_kegiatan')
						->join('ltw_planner','ltw_planner__kegiatan.id_ltw_planner = ltw_planner.id_ltw_planner')->get('ltw_planner__treatment')
						->row()->terlibat;
					}
			 
				$f->input_database('ltw_planner__pengerjaan',$sub_task);
					
					
			}
		}else{
			
			$waktu        = $ci->input->post('waktu_pengerjaan');
			$pengerjaan['id_ltw_planner_treatment'] =$id_treatment;
			for($i = 0;$i < count($waktu['date']);$i++){
				$pengerjaan['date_pengerjaan'] = $waktu['date'][$i];
				$pengerjaan['time_pengerjaan'] = $waktu['time'][$i];
				$pengerjaan['who_pengerjaan'] = '';
				$who        = $waktu['who'][$i];
				for($j = 0;$j < count($who);$j++){
					$who[$j] = de($who[$j]);
					$pengerjaan['who_pengerjaan'] .= '#'.$who[$j];
					if(!in_array($who[$j],explode('#',$penugasan))){
						$penugasan.='#'.$who[$j];
					}
				}
			
				$f->input_database('ltw_planner__pengerjaan',$pengerjaan);
				
					
			}
		}
		$update['penugasan'] =	$penugasan;
		$f->update_database('ltw_planner__treatment',$id_treatment,$update);
		redirect(r('_lifetime_work','planner/board/'.$id_planner));
	} 
	public function update_task(){
		$ci        		= &get_instance(); 
		global $f;   
		$type 			= de($_POST['f']);		 
		$id 			= de($_POST['e']);	
		
		if($type=='sub'){
			$data['status'] = ($_POST['g'])=='checked'?'selesai':'belum';	
			$f->update_database('ltw_planner__treatment_sub',$id,$data);
			if($_POST['h']==0){
				$text = 'To Do';
							
			}else if($_POST['j']==100){
				$text = 'Done';
							
			}else{
				$text = 'On Progress';
							
			} 
			$data['status'] = $text;
			$f->update_database('ltw_planner__treatment',de($_POST['k']),$data);
			
			
		}else{
			$data['status'] = ($_POST['j'])==100?'Done':'To Do';	
			$f->update_database('ltw_planner__treatment',$id,$data);
			
		} 
	} 
	public function save_task_group($id){ 
		$ci        = &get_instance(); 
		$data['nama_kegiatan'] = ($_POST['k'.en('ode',true)]);
		$data['id_ltw_planner'] = $id;
		$ci->db->insert('ltw_planner__kegiatan',$data);
	} public function save_tambah_board(){ 
		$ci        = &get_instance(); 
		$terlibat        = $ci->input->post('terlibat');
		$data = $_POST[en('data',true)];
		$data['terlibat']='#'.$_SESSION['id_apps'];
		
		$data['who_created']=$_SESSION['id_apps'];
		$data['date_created']=dat();
		if($data['panel']=='user'){
			$data['panel']=$_SESSION['as'];
			$data['id_panel']=$_SESSION['id_apps'];
		}
		else if($data['panel']=='organisasi'){
			
			$data['id_organisasi']=$_SESSION['id_organisasi'];
		}
		else if($data['panel']=='program'){
			
			$data['id_organisasi']=$_SESSION['id_organisasi'];
		}
		for($i = 0;$i < count($terlibat);$i++){
			$terlibat[$i] = de($terlibat[$i]);
			$data['terlibat'] .= '#'.$terlibat[$i];
			
		}
		$ci->db->insert('ltw_planner',$data);
		redirect(r('_lifetime_work','planner/index'));
	} 
}