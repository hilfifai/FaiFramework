<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


function answer($user_task,$id_program,$id_task){
	$ci=&get_instance();
		$answer_question = $ci->db
			->where('id_program_elearning_user_task',$user_task->row()->id_program_elearning_user_task)
			->where('id_program_elearning_user_token',$user_task->row()->id_program_elearning_user_token)
			->get('program_elearning__user_jawab');
		$answer_recap = $ci->db
					//->where('id_program_elearning_task',$id_task)
					->where('id_program_elearning_pertanyaan',$user_task->row()->id_program_elearning_pertanyaan)
					->where('id_apps_user',$_SESSION['id_apps']) 
									->where('id_program',$id_program)
									
 			
									->get('program_elearning__user_jawab_rekap'); 
									$data['answerQuestion'] = $answer_question;					
									$data['answerRecap'] = $answer_recap;					
									return $data;
}
function input_text($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata  )
{
	$ci = &get_instance();
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->row()->answer;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->row()->answer;
	}
	else
	{
		$value_answer = '';
	}
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '<input name="answer" type="text" class="form-control " placeholder="Masukan jawaban anda disi" value="'.$value_answer.'">';


	$return['content'] = $content;
	$return['title'] = '<b class="fz-13">Pertanyaan</b>
	<br>'.$row_pertanyaan->pertanyaan.'<br> <div class="text-muted fz-11">Jawab Pertanyaan Sesuai yang anda pelajari dan pahami</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function input_select($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata  )
{
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->row()->answer;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->row()->answer;
	}
	else
	{
		$value_answer = '';
	}
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '<input name="answer" type="text" class="form-control " placeholder="Masukan jawaban anda disi" value="'.$value_answer.'">';


	$return['content'] = $content;
	$return['title'] = '<b class="fz-13">Pertanyaan</b>
	<br>'.$row_pertanyaan->pertanyaan.'<br> <div class="text-muted fz-11">Jawab Pertanyaan Sesuai yang anda pelajari dan pahami</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function radio($query_select,$value)
{
	$return='';
	foreach($query_select as $key => $select)
	{
		if(!$key){
			$key==$select;
		}
		$selected =  $value==$key?'checked':'';
		$return .= "
		<label class='form-check'>
		<input class='form-check-input'  name='answer' type='radio' value='$key' $selected>
		<span class='form-check-label'>$select</span>
		</label>
		";

	}
	return $return;
} 
function select($query_select,$value)
{
	
	$return='<select name="answer" type="text" class="form-control " >';
	$return.='<option value="">- Pilih Jawaban -</option>';
	foreach($query_select as $key => $select)
	{
		if(!$key){
			$key==$select;
		}
		$selected =  $value==$key?'selected':'';
		$return .= "<option value='$key' $selected>$select</option>";

	}
	$return.='</select>';
	return $return;
} 
function file__Setoran($row_pertanyaan,$user_task,$answer )
{
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '<div class="mb-3">
	<div class="form-label"></div>
	<input type="file" class="form-control" name="file[]" multiple/>
	<p>Silahkan bikin <code>Audio atau Video</code>Lalu kirimkan,usahakan dengan ukuran kecil, Ukurun file akan berpengaruh kepada lamanya proses upload</p>
	</div>';


	$return['content'] = $content;
	$return['title'] = '<b class="fz-13"></b>
	'.$row_pertanyaan->pertanyaan.'<br> <div class="text-muted fz-11">Upload File Setoran</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function tag__($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata  )
{
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->row()->answer;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->row()->answer;
	}
	else
	{
		$value_answer = '';
	}
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '
	<link rel="stylesheet" href="http://weareislam.id/assets/bootstrap-tagsinput-latest//dist/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="http://weareislam.id/assets/bootstrap-tagsinput-latest/examples/assets/app.css">
	<style>
	.bootstrap-tagsinput{
	padding:10px;border: 1px solid #dadcde;
	box-shadow: none;
	}
	.bootstrap-tagsinput .tag {
	margin-right: 2px;
	color: white;
	background: #03abdf;
	padding: 4px;
	border-radius: 5px;
	font-size: 14px;

	}
	</style>


	<div class="bs-example">
	<input type="text" class="form-control"  placeholder="Masukan" data-role="tagsinput" id="test" name="answer" value='.$value_answer.'/>  <p>Pisahkan dengan  <code>Koma(,) atau Enter</code></p>
	</div>
	<script src=" http://weareislam.id/assets/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js"></script>
	<script src="http://weareislam.id/assets/bootstrap-tagsinput-latest/examples/assets/app.js"></script>
	';


	$return['content'] = $content;
	$return['title'] = '<b class="fz-13">Pertanyaan</b>
	<br>'.$row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function textarea__(
$row_pertanyaan,$user_task,$id_program,$id_task,$id_mata  )
{
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->row()->answer;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->row()->answer;
	}
	else
	{
		$value_answer = '';
	}
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '<textarea rows=7 name="answer" type="text" class="form-control " placeholder="Masukan jawaban anda disi">'.$value_answer.'</textarea>';

	$return['content'] = $content;
	$return['title'] = '<b class="fz-13">Pertanyaan</b><br>'.$row_pertanyaan->pertanyaan.'<br> <div class="text-muted fz-11">Jawab Pertanyaan Sesuai yang anda pelajari dan pahami</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function multiple($pertanyaan,$jumlah)
{
	$return = '';
	for($a = 0; $a < $jumlah; $a++)
	{
		$return .= '
		<div class="row mb-3">';
		for($b = 0; $b < count($pertanyaan); $b++)
		{
			$return .= '
			<div class="col-md-'.$pertanyaan[$b][0].'">
			<input name="answer-multiple-'.$pertanyaan[$b][2].'[]" type="text" class="form-control " placeholder="'.$pertanyaan[$b][1].'">
			</div>';
		}
		$return .= '

		</div>
		';
	}
	return $return;
}
function multiple__sebab_penamaan($row_pertanyaan,$user_task,$answer )
{
	
	$ci             = & get_instance();

	$query_multiple =
	array(
		array('4','Nama','Key'),
		array('7','Alasan Pemberian Nama','Key')

	);
	echo ''.$ci->uri->segment(4);
	$where2['jenis'] = 'sebab penamaan';
	$where2['surat'] =  $ci->input->post('surat');
	$where2['ayat'] = 0;
	$ci->db->join('kitab_quran_ulumul__ayat','kitab_quran_ulumul__ayat.id_quran_ulumul = kitab_quran_ulumul.id');
	$query_multiple_jumlah =
	$ci->db->where($where2)->get('kitab_quran_ulumul')->num_rows();
 	//echo $query_multiple_jumlah;
	$content               = '';
	$content .= multiple($query_multiple,$query_multiple_jumlah );
	if(!$content)$content='Kontent Belum tersedia,silahkan lanjutkan ke konten pertanyaan yang lain terlebih dahulu';
	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	//print_r($return);
	return $return;

}

function ayat_detail($surat,$ayat,$jenis,$mode = 'default',$limit = 1 )
{
	$ci      = & get_instance();
	 $content = '';

	$ci->db
	->select('kitab_quran_ulumul__ayat.*,kitab_quran_ulumul.*,kitab.*,
		kitab_quran_ulumul.id as id_ulumul')
	->where('kitab_quran_ulumul__ayat.surat',$surat)
	->where('kitab_quran_ulumul__ayat.ayat',$ayat)
	->where('kitab_quran_ulumul.jenis',$jenis)
	->join('kitab_quran_ulumul__ayat','id_quran_ulumul = kitab_quran_ulumul.id','left')
	->join('kitab','id_quran_kitab = kitab.id','left'	);
	if($mode == 'counting')
	{
		$query = $ci->db->get('kitab_quran_ulumul');
	}
	else
	{
		$ci->db->limit('1',$limit); 
		$query = $ci->db->get('kitab_quran_ulumul');
	}
	
 
	 //echo $ci->db->last_query();
	if($mode == 'counting')
	{
		$content = $query->num_rows();
	}
	else
	{

		if(!$query->num_rows())
		{
			$content .= 'Maaf data tentang '.ucwords($jenis).' belum ada';
		} 
		//, At Takwiir dan juga Al Infithaar 
		foreach($query->result() as $data){
			$content .= '<h3 class="mb-1">Dalam kitab : '.$data->nama_kitab.'</h3>';
			$content .= '<div class="text-muted">Penulis : '.$data->penulis.' </div>'; 
			$content .= '<div class="text-muted small fz-9">(Kitab  masih dalam perizinan ke penulis dan juga edar di website ini, sehingga hanya beberapa surat saja yang kami tampilkan Yaitu : Al Fatihah, An Naba, An Naziat, Abasa)</div>'; 
  
  
			$content .= '<p>'.$data->text_ulumul.'</p>';

			$data_multiple = $ci->db->where('id_quran_ulumul',$data->id_ulumul)->get('kitab_quran_ulumul__multiple')->result();
			foreach($data_multiple as $multiple)
			{
				$content .= '<li style="margin-left: 15px;">';
				$content .= $multiple->key_content.'<br> <p class="text-muted">'.$multiple->value.'</p>';
				$content .= '</li>';
			}
		}
	}
	return $content;
}

function content_ayat_perkata($surat,$ayat,$mode = null)
{
	$ci      = & get_instance();

	$query   = $ci->db
	->where('surat_ke',$surat)
	->where('ayat_ke',$ayat)
	->where('lang','ID')->where('versi_id',1)
	//->order_by('rand()')
	->join('kitab_quran_ayat__perkata','kitab_quran_ayat__terjemah_kata.id_quran_perkata = kitab_quran_ayat__perkata.id')
	->join('kitab_quran_ayat__latin','kitab_quran_ayat__latin.id_quran_perkata = kitab_quran_ayat__perkata.id')
	->get('kitab_quran_ayat__terjemah_kata')->result();
	$row     = 'kata_arab';
	$support = 'kata_terjemah';

	$content = '
	<style>
	.topleft {
	position: absolute;
	top: 0px;
	left: 16px;
	font-size: 12px;
	}
	</style>

	<div class="col">
	<div class="demo-icons-list-wrap">
	<div class="demo-icons-list">';
	$i=0;
	foreach($query as $baris)
	{

		$i++;

		$content .= '
		<input type="hidden" value="'.$baris->$row.'" id="inputget-'.$baris->id.'">
		<div style="position: relative;">
		<a href="javascript:void(0)"  class="demo-icons-list-item" id="puzzleId-'.$baris->id.'" onclick="to_field_puzle('.$baris->id.')" data-toggle-icon="'.$baris->$support.'" title="'.$baris->$support.'" >
		<div class="topleft " id="top-'.$baris->id.'">'.$i.'</div>
		<span class="font-arabic">'.$baris->$row.'</span>
		<div class="mt-1 text-muted text-h5">'.$baris->$support.'</div>
		</a>
		</div> ';
	}
	$content .= '
	</div>
	</div>
	</div>

	';
	return $content;

}
function arabic_w2e($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_western, $arabic_eastern, $str);
}

/**
 * Converts numbers from eastern to western Arabic numerals.
 *
 * @param  string $str Arbitrary text
 * @return string Text with eastern Arabic numerals converted into western Arabic numerals.
 */
function arabic_e2w($str)
{
    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    return str_replace($arabic_eastern, $arabic_western, $str);
}
function content_ayat($surat,$ayat,$mode = null)
{
	$ci              = & get_instance();
	$list_ayat       = $ci->quran->get_ayat($surat,$ayat);
	
	//print_r($list_ayat);
	$content         = '';
	foreach($list_ayat as $ayat)
	{
		if($mode == 'tajwid')
		{

			$content .= '<div class="fz-40"  dir="rtl">'.tajwid($ayat->text_tajwid).' </div>

			';
		}
		else
		{
			$content .= '<div class="font-arabic2"  dir="rtl">'.$ayat->text_ayat.' ('.$ayat->ayat_ke.')</div>';
		}
	
		if($mode == 'terjemahan')
		{
				$text_terjemahan = $ci->quran->get_terjemah($surat,$ayat->ayat_ke);
			$content .= '<div>Terjemahan:<br>'.$text_terjemahan.'</div>
			';
		}

	}
	return $content;
}

function info_ulumul($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	//echo 'say heloo';
	//print_r($row_pertanyaan);
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;
	$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value;
	$jenis = $ci->db->where('id_program_elearning_task',$row_pertanyaan->id_program_elearning_task)->where('nama_row','jenis_ulumul')->get('program_elearning__task_extend')->row()->value;
	//echo $ci->db->last_query();
	 $token = $ci->db->where('id_program_elearning_user_token',$user_task->row()->id_program_elearning_user_token)->get('program_elearning__user_token')->row(); 
	$content = '<input type="hidden" id="all_value" value="'.ayat_detail($surat,$ayat,$jenis,'counting').'">';
	
		
	for($i = 0;$i < ayat_detail($surat,$ayat,$jenis,'counting');$i++ )
	{
		$content .= '<div class="show_tabs " id="nav-ulumul-'.$i.'">';
	//echo $token->id_loop_object.'---------'; 
	//print_r($token);
		$content .= ayat_detail($surat,$ayat,$jenis,'get',$i);
		$content .= '</div>';
	} 

	$return['content'] = '<div contenteditable=false style="text-align: justify;">'.str_replace('\n','<br><br><br>',$content).'</div>';
	$return['js'] = 'inisiasi_tabs_ulumul();';
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Pahami  </div>';
//<button type="button" onclick="to_next()" id="btnNext" class="btn btn-primary ms-auto">Lanjutkan</button>
	$return['button'] = '
	<button type="button" onclick="to_next()" id="btnNext" class="btn btn-primary ms-auto  w-100">Lanjutkan</button> 
	<button type="button" onclick="save()" id="btnSave" class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';




	return $return;
}

function radio__diturunkan($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->row()->answer;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->row()->answer;
	}
	else
	{
		$value_answer = '';
	}
	$query_select = array('Mekah'=>'Mekah','Madinah'=>'Madinah');
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= radio($query_select,$value_answer);


	$return['content'] = $content;
	$return['title'] = '<b class="fz-13">Pertanyaan</b>
	<br>'.$row_pertanyaan->pertanyaan.'<br> <div class="text-muted fz-11">Jawab Pertanyaan Sesuai yang anda pelajari dan pahami</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function info__ayat_surat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= content_ayat($surat,$ayat,'keutamaan surat' );

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayatnya</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function info__lainnya_surat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= ayat_detail($surat,$ayat,'lainnya tentang surat' );

	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';

	return $return;
}
function info__ngenal_surat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';

	$detail  = $ci->quran->get_surat($surat);
	$content .= '

	<div class="card-body border-bottom">
	<table border="0">
	<tr>
	<th>
	Nama Surat
	</th>
	<td>
	'. $detail->nama_surat.'
	</td>
	</tr>
	<tr>
	<th>
	Arti Surat
	</th>
	<td>
	'. $detail->arti_nama_surat.'
	</td>
	</tr>
	<tr>
	<th>
	Diturunkan
	</th>
	<td>
	'. $detail->diturunkan_di.'
	</td>
	</tr>
	<tr>
	<th>
	Surat Ke
	</th>
	<td>
	'. $detail->surat_ke.'
	</td>
	</tr>
	<tr>
	<th >
	<span style="margin-right: 10px">

	Jumlah Ayat
	</span>
	</th>
	<td>
	'. $detail->jumlah_ayat.'
	</td>
	</tr>
	</table>
	</div>
	';

	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';

	return $return;
}
function info__posisi_ayat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance(); 
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;
	$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value;
	$token = $ci->db->where('id_program_elearning_user_token',$user_task->row()->id_program_elearning_user_token)->get('program_elearning__user_token')->row(); 
	$ci->db->where('id_quran_versi',$token->id_loop_object);
	$row_versi  = $ci->db->get('kitab_quran__versi')->result();
	//echo $ayat; 
	$content='';
	$content .= '

	<div class="card-body border-bottom">
	<table border="0" class="table table-striped">';
	if(!count($row_versi)){
		$content.= '<tr><td>Data Belum Tersedia</td></tr>'; 
	} 
	foreach($row_versi as $versi){
		
	$page    = $ci->quran->get_page($versi->id_quran_versi,$surat,$ayat);
	if(isset($page)){
		
	//print_r($ci->db->last_query());
	$max_row = $ci->quran->get_page($versi->id_quran_versi,$page->page_halaman,$page->page_baris,null,'max_row');
	$max_baris = $ci->quran->get_page($versi->id_quran_versi,$page->page_halaman,null,null,'max_baris');
	$bil = $page->page_urutan;
	$bagi= $max_row / 5 ;
	//echo $max_row.$max_baris;
	//echo'ini < br > ';
	if($bil >= $bagi - $bagi and $bil < $bagi)
	$posisi_row = 'Paling Kanan ';
	else
	if($bil >= $bagi and $bil < $bagi * 2)
	$posisi_row = 'Sebelah Kanan ';
	else
	if($bil >= $bagi * 2 and $bil < $bagi * 3)
	$posisi_row = 'bagian Tengah ';
	else
	if($bil >= $bagi * 3 and $bil < $bagi * 4)
	$posisi_row = 'Sebelah Kiri';
	else
	if($bil >= $bagi * 4 and $bil <= $bagi * 5)
	$posisi_row = 'Paling Kiri';
	else
	$posisi_row = 'Ujung Baris';
	$bil        = $page->page_baris;
	//echo $bil;
	$bagi       = $max_baris / 5 ;
	if($bil >= $bagi - $bagi and $bil < $bagi)
	$posisi_hal = 'Paling Atas ';
	else
	if($bil >= $bagi and $bil < $bagi * 2)
	$posisi_hal = 'Sebelah Atas ';
	else
	if($bil >= $bagi * 2 and $bil < $bagi * 3)
	$posisi_hal = 'Tengah ';
	else
	if($bil >= $bagi * 3 and $bil < $bagi * 4)
	$posisi_hal = 'Sebelah Bawah';
	else
	if($bil >= $bagi * 4 and $bil < $bagi * 5)
	$posisi_hal = 'Paling Bawah';
	else
	$posisi_hal = 'Akhir Halaman ';
	if($page->page_baris == 1 and $page->page_urutan == 1)
	{
		$posisi = 'Paling kanan awal halaman';
	}
	else
	{
		$posisi = $posisi_row.' ' .$posisi_hal;
	}
		//.'</b> Baris ke '. $page->page_baris.' Huruf ke '.$page->page_halaman.'
		$posisi = ''.$posisi.',';
		//$posisi = '<div class="text-muted">Maaf masih proses pengecekan kesesuaian data, karena beberapa ada tidak sesuai'; 
	$content .= '
	<tr>
	
	<td colspan=2 class="text-center strong">
		Pada '.$versi->nama.'
	</td>
	</tr></tr>
	<tr>
	<th>
	Posisi Ayat
	</th>
	<td>
		'.$posisi.'
	</td>
	</tr></tr>
	<tr>
	<th>
	Baris Ayat
	</th>
	<td>
	<b> Baris ke '. $page->page_baris.' huruf ke '. $page->page_urutan.'
	</td>
	</tr>
	<tr>
	<th>
	Halaman Ayat
	</th>
	<td>
	<b> Halaman '. $page->page_halaman.'
	</td>
	</tr></tr>
	<tr>
	<th>
	Halaman di awali dengan kata
	</th>
	<td>
	<span class="font-arabic fz-15">  '.$ci->quran->get_page($versi->id_quran_versi,$page->page_halaman,null,null,'huruf_halaman').'
	</span>
	</td>
	</tr>
	<tr>
	<th>
	Baris di awali dengan kata
	</th>
	<td>
	<span class="font-arabic fz-15">  '.$ci->quran->get_page($versi->id_quran_versi,$page->page_halaman,$page->page_baris,null,'huruf_baris').'
	</span>
	</td>
	</tr>
	<tr>
	<th>
	Ayat di awali dengan kata
	</th>
	<td>
	<span class="font-arabic fz-15">  '. $ci->quran->get_page($versi->id_quran_versi,$page->surat_ke,$page->ayat_ke,1,'huruf_ayat').'
	</span>
	</td>
	</tr>
	 
';
	}
	}
	
	$content.='</table>
	</div>';
	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';

	return $return;
}
function info__index_tematik($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	
	$index_tematik = $ci->quran->get_index_tematik($surat,$ayat);

	if(count($index_tematik))
	$index = '';
	else
	$index = "<span class='text-muted'> Maaf kami belum memsaukan data ini</span>";
	foreach($index_tematik as $to_index)
	{
		$index .= '<li>'.$to_index->nama_bab;
		if($to_index->parent)
		{
			$index .= "<span class='text-muted'>(";
			$id_index = $to_index->parent;
			$praindex='';
			for($i = 0; $i < $to_index->level; $i++)
			{
				
			if($id_index){  
			
				if($i)
				$praindex2 = ' -> ';
				else
					$praindex2='';
				$query_index = $ci->quran->get_index_tematik_parent($id_index);
				$praindex = $query_index->nama_bab.$praindex2.$praindex; 
			}
				$id_index = $query_index->parent;
			}
			
			$index .= 'BAB '.$to_index->parent_bab.' -> '.$praindex;;
			$index .= ')</span>';;
		}
	}
	$content .= '

	<div class="card-body border-bottom">
	<table border="0" class="table table-striped">';
	$content.='
	<tr>
	<th >
	<span style="margin-right: 10px">

	Index Tematik Ayat
	</span>
	</th>
	<td>
	'. $index.'
	</td>
	</tr>
	</table>
	</div>
	';

	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';

	return $return;
}
function info__info_ayat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';

	$detail  = $ci->quran->get_ayat($surat,$ayat,'get');
	
	
	$content .= '

	<div class="card-body border-bottom">
	<table border="0" class="table table-striped">
	<tr>
	<th>
	Juz
	</th>
	<td>
	'. $detail->juz.'
	</td>
	</tr><tr>
	<th>
	Surat Ke
	</th>
	<td>
	'. $surat.' - Surat '.nama_surat($surat).'
	</td>
	</tr><tr>
	<th>
	Ayat Ke
	</th>
	<td>
	'. $ayat.'
	</td>
	</tr>
	<tr>
	<th>
	Text Ayat
	</th>
	<td>
	<div class="fz-40">
	'. content_ayat($surat,$ayat).' 
		</div>
	</td>
	</tr>';
	$urutan=array(); 
	$jumlah_huruf=0; 
	$text_huruf=''; 
	$query = $ci->db->where('surat_ke',$surat)->where('ayat_ke',$ayat)->get('kitab_quran_ayat__advance')->result();
	foreach($query as $penggalan){
		if(!in_array($penggalan->urutan,$urutan)){
			 $urutan[]=$penggalan->urutan;
		$jumlah_huruf += count(array_filter(explode(' ',$penggalan->penggalan_huruf)));
		$text_huruf .= '<div>';
		$text_huruf .= $penggalan->t;
		$text_huruf .= ' -> ';
		$text_huruf .= $penggalan->penggalan_huruf;
		$text_huruf .= ' -> ';
		$text_huruf .= count(array_filter(explode(' ',$penggalan->penggalan_huruf)));
		$text_huruf .= '</div>';
		}
	}
	$content.='
	<tr>
	<th>
	Jumlah Huruf dalam Ayat
	</th>
	<td>
	'. $jumlah_huruf.' Huruf '.$text_huruf.'
	</td>
	</tr>
	<tr>
	<th>
	Jumlah Kata dalam Ayat
	</th>
	<td>
	'. count($urutan).' Kata
	</td>
	</tr>
	
	';
	
	
	$content.='
	
	</table>
	</div>
	';

	$return['content'] = $content;
	$return['title'] = $row_pertanyaan->pertanyaan;
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';

	return $return;
}
function info__ayat_terjemah($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= content_ayat($surat,$ayat,'terjemahan' );

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayat dan terjemahannya</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function perintah__Hafal_Ayat_terjemah($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= '
	<h3> Hafalkan !</h3>
	di level ini, temen temen diminta untuk menghafalkan dan mengingat ayat sampai hafal dan fasih baik secara pengucapannya, makhorijul hurufnya, tajwid, dan lainnya.
	<br>
	<br>

	'.content_ayat($surat,$ayat,'terjemahan' ).
	'

	<br>
	<h6>Hafalkan Juga Arti Perkatanya</h6>
	'.content_ayat_perkata($surat,$ayat,'terjemahan' )

	;

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayat dan terjemahannya</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function info__ayat_perkata($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; 
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= content_ayat_perkata($surat,$ayat,'ayat per kata' );

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayat dan arti perkatanya </div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function info__tajwid($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= ''.content_ayat($surat,$ayat,'tajwid' );
		$query            = $ci->db
		->where('surat_ke',$surat)
		->where('ayat_ke',$ayat)
		->where('type','tajwid_pertajwid')
		->order_by('urutan','asc')


		->get('kitab_quran_ayat__tajwid')->result();
		foreach($query as $tajwid){
			$content .='
			
			';
		}
	$table = '
	Keterangan:
	<table style="width: 100%;">
	<thead>
	<tr>
	<th style="width:100px">Warna</th>
	<th style="width:50px"></th>
	<th style="margin-left:100px">Hukum Tajwid</th>

	</tr>
	</thead>
	<tbody>';
	$query = $ci->db->get('kitab_quran_ayat__tajwid_list')->result();
	foreach($query as $t)
	{

		$table .= '
		<tr style="border-bottom: 1px solid #d0d0d0;">

		<td style="background-color: '.$t->colour.';text-align:center">'.$t->colour.'</td>
		<td></td>
		<td>'.nama_tajwid($t->identifier).'</td>

		</tr>
		';
	}
	$table .= '
	</tbody>
	</table>';
	$content .= $table;


	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayat dan arti perkatanya </div>';


	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function info__kaidah_arab($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance(); 

	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;
	$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$content .= ''. $ci->quran->get_kaidah_b_arab($surat,$ayat);





	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayat dan arti perkatanya </div>';


	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function puzle($surat,$ayat,$mode = null,$answer_key=null)
{
	$ci = & get_instance();
	if($mode == 'ayat_terjemah')
	{
		$query   = $ci->db
		->where('surat_ke',$surat)
		->where('ayat_ke',$ayat)
		->where('lang','ID')->where('versi_id',1)
		->order_by('rand()')
		->join('kitab_quran_ayat__perkata','kitab_quran_ayat__terjemah_kata.id_quran_perkata = kitab_quran_ayat__perkata.id')
		->join('kitab_quran_ayat__latin','kitab_quran_ayat__latin.id_quran_perkata = kitab_quran_ayat__perkata.id')
		->get('kitab_quran_ayat__terjemah_kata')->result();
		$row     = 'kata_terjemah';
		$support = null;
	}
	else
	if($mode == 'ayat')
	{
		$query   = $ci->db
		->where('surat_ke',$surat)
		->where('ayat_ke',$ayat)
		->where('lang','ID')->where('versi_id',1)
		->order_by('rand()')
		->join('kitab_quran_ayat__perkata','kitab_quran_ayat__terjemah_kata.id_quran_perkata = kitab_quran_ayat__perkata.id')->join('kitab_quran_ayat__latin','kitab_quran_ayat__latin.id_quran_perkata = kitab_quran_ayat__perkata.id')
		->get('kitab_quran_ayat__terjemah_kata')->result();
		$row     = 'kata_arab';
		$support = 'kata_latin';
	}
	$baris_support = '';
	$content       = '
	<style>
	.topleft {
	position: absolute;
	top: 0px;
	left: 16px;
	font-size: 12px;
	}
	</style>

	<div class="col">
	<div class="demo-icons-list-wrap">
	<div class="demo-icons-list">';
	
	$answer_key_select = explode('-',$answer_key);
	//print_r($answer_key_select);
	$i=0;
	foreach($query as $baris)
	{
		$i++;
		if($answer_key != '')
		{ 
			//echo $baris->id;
			$selected = array_search($baris->id,$answer_key_select);
			$kode_to_puzle = 'active';
		}
		else
		{
			$selected = '';
			$kode_to_puzle = '';
		}
		if($support)
		$baris_support = $baris->$support;


		$content .= '
		<input type="hidden" value="'.$baris->$row.'" id="inputget-'.$baris->id.'">
		<div style="position: relative;">
		<a href="javascript:void(0)"  class="demo-icons-list-item '.$kode_to_puzle.'" id="puzzleId-'.$baris->id.'" onclick="to_field_puzle('.$baris->id.')" data-toggle-icon="'.$baris_support.'" title="'.$baris_support.'" >
		<div class="topleft " id="top-'.$baris->id.'">'.$selected.'</div>
		'.$baris->$row.'
		<div class="mt-1 text-muted text-h5">'.$baris_support.'</div>
		</a>
		</div> ';
	}
	$content .= '
	</div>
	</div>
	</div>

	';
	return $content;
}
function puzle_form($type,$surat,$ayat,$mode_form = null,$support_form = null,$answer='')
{
	$ci            = & get_instance();
	$pra_support   = '';
	$pasca_support = '';
	$pra_content   = '';
	$pasca_content = '';
	$row_type      = 'normal';
	$value_type    = 'normal';
	if($answer!=''){
		foreach($answer as $list_answer){
			$jawaban[$list_answer->answer_key] = $list_answer->answer;
		}
	}
	if($type == 'terjemah perkata')
	{
		$query   = $ci->db
		->where('surat_ke',$surat)
		->where('ayat_ke',$ayat)
		->where('versi_id',1)
		->order_by('urutan','asc')

		->join('kitab_quran_ayat__latin','kitab_quran_ayat__latin.id_quran_perkata = kitab_quran_ayat__perkata.id')
		->get('kitab_quran_ayat__perkata')->result();
		$row     = 'kata_arab';
		$support = 'kata_latin';
	}
	else
	if($type == 'tajwid')
	{
		$query            = $ci->db
		->where('surat_ke',$surat)
		->where('ayat_ke',$ayat)
		->where('type','tajwid_pertajwid')
		->order_by('urutan','asc')


		->get('kitab_quran_ayat__tajwid')->result();
		$row              = 'kata_tajwid';
		$row_type         = 'func';
		$nama_func_row    = 'tajwid';
		$support          = 'point_tajwid';
		$pra_support      = 'Huruf[ ';
		$pasca_support    = '] adalah?';
		$id_select        = 'identifier';
		$value_select     = 'identifier';
		$pra_content      = '<span class="fz-25" style="color: black;">';
  
		$pasca_content    = '</span>';
		$value_type       = 'func';
		$nama_func_select = 'nama_tajwid';

		$query_select     = $ci->db
		->get('kitab_quran_ayat__tajwid_list')->result();
	}

	$content   = '
	<style>
	.topleft {
	position: absolute;
	top: 0px;
	left: 16px;
	font-size: 12px;
	}
	</style>

	<div class="col">
	<div class="demo-icons-list-wrap">
	<div class="demo-icons-list">';
	$idCollect = '';


	foreach($query as $baris)
	{
		if($mode_form == 'input')
		{
			$value = isset($jawaban[$baris->id])?$jawaban[$baris->id]:'';
			$form = '<textarea name="answer_puzle['.$baris->id.']" class="form-control text-center" placeholder=" Terjemahan Perkata" rows=2 style="resize: none;">'.$value.'</textarea>';
		}
		else
		if($mode_form == 'select')
		{
			$value = isset($jawaban[$baris->id])?$jawaban[$baris->id]:'';
			$form = '<select name="answer_puzle['.$baris->id.']" class="form-control text-center" placeholder=" Terjemahan Perkata" rows=2 style="resize: none;">
			<option value="">- Pilih -</option>
			';
			foreach($query_select as $select)
			{
				$selected = $value==$select->$id_select?'selected':'';
				if($value_type == 'normal')
				{
					$value_text = $select->$id_select;
				}
				else
				if($value_type == 'func')
				{
					$value_text = $nama_func_select($select->$id_select);
				}
				
				$form .= '<option value="'.$select->$id_select.'" '.$selected.'>'.$value_text.'</option>';
			}
			$form .= '
			</select>';
		}
		$idCollect .= $baris->id.'-';
		if($row_type == 'normal')
		{
			$row_content = $baris->$row;
		}
		else
		if($row_type == 'func')
		{
			$row_content = $nama_func_row($baris->$row);
		}

		$content .= '
		<input type="hidden" value="'.$baris->$row.'" id="inputget-'.$baris->id.'">
		<div style="position: relative;">
		<div href="javascript:void(0)"  class="demo-icons-list-item" id="puzzleId-'.$baris->id.'"  data-toggle-icon="'.$baris->$support.'" title="'.$baris->$support.'" >
		<div class="topleft " id="top-'.$baris->id.'"></div>
		'.$pra_content.$row_content.$pasca_content.'
		<div class="mt-1 text-muted text-h5">'.$pra_support.$baris->$support.$pasca_support.'</div>
		'.$form.'
		</div>
		</div> ';
	}

	$content .= '
	<input type="hidden" name="colect_puzzle_form_id" value="'.$idCollect.'">
	</div></div></div>';
	return $content;
}
function tabs($tabs,$selected=null )
{
	$return = '
	<input type="hidden" name="tabs_value" id="tabs_value" value="'.$tabs[0]['menu'].'">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';

	for($i = 0; $i < count($tabs); $i++)
	{

		if($selected!=null){
			
		$active = strtolower($selected)==strtolower($tabs[$i]['menu']) ? 'active':'';
		}else{
		$active = !$i ? 'active':'';
			
		}
		$return .= '
		<li class="nav-item" role="presentation">
		<button class="nav-link '.$active.'" id="pills-home-'.$i.'-tab" data-bs-toggle="pill" data-bs-target="#pills-home-'.$i.'" type="button" role="tab" aria-controls="pills-home-'.$i.'" aria-selected="true" onclick="$('."'#tabs_value'".').val('."'".$tabs[$i]['menu']."'".');">
		'.$tabs[$i]['menu'].'

		</button>
		</li>
		';
	}
	$return .= '</ul>';
	$return .= '
	<div class="tab-content" id="pills-tabContent">
	';
	//echo $selected.'';
	for($i = 0; $i < count($tabs); $i++)
	{
		if($selected!=null){
			
		$active = strtolower($selected)==strtolower($tabs[$i]['menu']) ? ' show active':'';
		}else{
		$active = !$i ? 'show active':'';
			
		}
		//$active = !$i ? 'show active':'';
		$return .= '<div class="tab-pane fade '.$active.'" id="pills-home-'.$i.'" role="tabpanel" aria-labelledby="pills-home-'.$i.'-tab">';
		$return .= $tabs[$i]['content'];
		$return .= '</div>';
	}
	$return .= '</div>';
	return $return;
}
function puzzle__ayat_terjemah($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	//<input id = "candidate_arabic" name = "firstname" required = "required" class = "gui - input" dir = "rtl" type = "text" />
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$pra_answer = $answer['answerQuestion']->row();
		
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$pra_answer = $answer['answerRecap']->row();
	}
	else
	{
		$pra_answer = '';
		
	}
	$value_answer_key = '';
	$value_answer     = '';
	//print_r($pra_answer);
	if($pra_answer != '' and strtolower($pra_answer->type_answer) == 'manual')
	{
		$value_answer = $pra_answer->answer;
		$type=$pra_answer->type_answer;
	}
	else
	if($pra_answer != '' and strtolower($pra_answer->type_answer) == 'puzzle')
	{
		$value_answer_key = $pra_answer->answer_key;;
		$value_answer     = $pra_answer->answer;;
		$type=$pra_answer->type_answer;
	}else{
		$type=null;
	}
	echo $type;
	$tabs[] = array('menu'   =>'Manual','content'=>content_ayat($surat,$ayat).'
		<br>
		<strong> Arti:</strong>
		<textarea name="answer" type="text" class="form-control " placeholder="Masukan Terjemahan Ayat Disini" value="'.$value_answer.'" row="2"></textarea>');
		
		$value = $value_answer!=''?$value_answer:'Pilih urutan Terjemahan Ayat';
	

	$tabs[] = array('menu'   =>'Puzzle','content'=>content_ayat($surat,$ayat).'<br> <strong> Arti:</strong><input type="hidden" id="input-puzzle-key" name="answer_puzle_key" value="'.$value_answer_key.'">
		<input type="hidden" id="input-puzzle-value" name="answer_puzle_value" value="'.$value_answer.'">
		<div id="content-puzzle" class="fz-16 mb-3" contenteditable="true"><span class="text-muted">'.$value.'</span></div>
		'.puzle($surat,$ayat,'ayat_terjemah',$value_answer_key));
	$content .= tabs($tabs,$type);
	$content .= '


	';

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13"></b>
	'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Susunlah atau Isilan Jawaban dibawah sesuai dengan yang kamu hafal</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function puzzle_form__ayat_terjemah_perkata($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci             = & get_instance();
	$content        = '';
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; 
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->result();
		$type = $answer['answerQuestion']->row()->type_answer;;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->result();
		$type = $answer['answerRecap']->row()->type_answer;;
	}
	else
	{
		$value_answer = '';
		$type=null;
	}
	 
	$query_multiple =
	array(
		array('4','Arabic','Key'),
		array('7','Terjemahan Per Kata','Value')

	);
	$where2['surat_ke'] = $surat;
	$where2['ayat_ke'] = $ayat;
	$query_multiple_jumlah =
	$ci->db->where($where2)->get('kitab_quran_ayat__perkata')->num_rows();

	$content               = '';

	$tabs[] = array('menu'   =>'Manual','content'=>multiple($query_multiple,$query_multiple_jumlah ));
	$tabs[] = array('menu'   =>'Puzzle Form','content'=>''.puzle_form('terjemah perkata',$surat,$ayat,'input','',$value_answer));

	$content .= tabs($tabs,$type);
	$content .= '


	';

	$return['content'] = $content;
	$return['js'] = "restrictInputOtherThanArabic($('#allowAyat'));";
	$return['title'] =
	''.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Susunlah atau Isilan Jawaban dibawah sesuai dengan yang kamu hafal</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function puzzle_form__Tajwid($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci             = & get_instance();
	$content        = '';
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; 
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$value_answer = $answer['answerQuestion']->result();
		$type = $answer['answerQuestion']->row()->type_answer;;
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$value_answer = $answer['answerRecap']->result();
		$type = $answer['answerRecap']->row()->type_answer;;
	}
	else
	{
		$value_answer = '';
		$type=null;
	}
	
	
	
	$query_multiple =
	array(
		array('4','Arabic','Key'),
		array('7','Hukum Tajwid','Value')

	);
	
	$where2['surat_ke'] = $surat;
	$where2['ayat_ke'] = $ayat;
	$query_multiple_jumlah =
	$ci->db->where($where2)->get('kitab_quran_ayat__perkata')->num_rows();

	$content               = '';

	$tabs[] = array('menu'   =>'Manual','content'=>multiple($query_multiple,$query_multiple_jumlah ));
	$tabs[] = array('menu'   =>'Puzzle Form','content'=>''.puzle_form('tajwid',$surat,$ayat,'select','',$value_answer));

	$content .= tabs($tabs,$type);
	$content .= '


	';

	$return['content'] = $content;
	$return['js'] = "restrictInputOtherThanArabic($('#allowAyat'));";
	$return['title'] =
	''.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Susunlah atau Isilan Jawaban dibawah sesuai dengan yang kamu hafal</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function puzzle__nyusun_ayat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; 
	$content = '';
	
	$answer = answer($user_task,$id_program,$id_task);
	if($answer['answerQuestion']->num_rows())
	{
		$pra_answer = $answer['answerQuestion']->row();
	}
	else
	if($answer['answerRecap']->num_rows())
	{
		$pra_answer = $answer['answerRecap']->row();
	}
	else
	{
		$pra_answer = '';
	}
	$value_answer_key = '';
	$value_answer     = '';
//print_r($pra_answer);
	if($pra_answer != '' and strtolower($pra_answer->type_answer) == 'manual')
	{
		$value_answer = $pra_answer->answer;
	}
	else
	if($pra_answer != '' and strtolower($pra_answer->type_answer) == 'puzle')
	{
		$value_answer_key = $pra_answer->answer_key;;
		$value_answer     = $pra_answer->answer;;
	}
	//echo $value_answer;
	$tabs[] = array(
		'menu'   =>'Manual','content'=>'
		<textarea name="answer" type="text" class="form-control " dir="rtl" id="allowAyat" placeholder="Masukan Ayat Disini" value="'.$value_answer.'" row="2"></textarea>
		<span class="text-muted">Hanya bisa diisi dengan font Arabic,
		<span class="fz-10 text-muted"><br>untuk android Anda bisa download di playstore keyboard  arabic ,
		<br> untuk windows pergi ke cpanel > Clock, Language and Region > "Language" > tambahkan bahasa arab > lalu "Windows + Spasi" untuk merubah keyboard;
		<br>jika masih kesulitan hubungi admin
		</span>
		</span>
		');
	$value = $value_answer!=''?$value_answer:'Pilih urutan Terjemahan Ayat';
	$tabs[] = array('menu'   =>'Puzzle','content'=>'
		<input type="hidden" id="input-puzzle-key" name="answer_puzle_key" value="'.$value_answer_key.'">
		<input type="hidden" id="input-puzzle-value" name="answer_puzle_value" value="'.$value_answer.'" >
		<div id="content-puzzle" class="m-2 font-arabic"  dir="rtl"  contenteditable="true"><span class="text-muted">'.$value.'</span></div>
		'.puzle($surat,$ayat,'ayat',$value_answer_key));
	$selected= isset($pra_answer->type_answer)?$pra_answer->type_answer:'';
	$content .= tabs($tabs,$selected);
	$content .= '


	';

	$return['content'] = $content;
	$return['js'] = "restrictInputOtherThanArabic($('#allowAyat'));";
	$return['title'] =
	''.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Susunlah atau Isilan Jawaban dibawah sesuai dengan yang kamu hafal</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function sound_quran__muratal_ayat($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	//$content .= content_ayat($surat,$ayat,'keutamaan surat' );
 
	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayatnya</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}
function perintah__takrir($row_pertanyaan,$user_task,$id_program,$id_task,$id_mata )
{
	$ci      = & get_instance();
	$surat = $ci->db->where('id_program_elearning_kelas',$row_pertanyaan->id_program_elearning_kelas)->get('program_elearning__kelas')->row()->nama_kelas;$ayat = $ci->db->where('id_program_elearning_mata',$id_mata)->where('nama_row','ayat')->get('program_elearning__mata_extend')->row()->value; $content = '';
	//$content .= content_ayat($surat,$ayat,'keutamaan surat' );

	$return['content'] = $content;
	$return['title'] =
	'<b class="fz-13">Perintah</b>
	<br>'.
	$row_pertanyaan->pertanyaan
	.'<br> <div class="text-muted fz-11">Baca dan Hafalkan Ayatnya</div>';
	$return['button'] = '<button type="button" onclick="save()" id="btnSave"class="btn btn-primary ms-auto w-100">Simpan & Lanjutkan</button>';
	return $return;
}


