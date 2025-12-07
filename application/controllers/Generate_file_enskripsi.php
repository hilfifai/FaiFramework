<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
class Generate_file_enskripsi extends CI_Controller {
	
	public function start(){
		$name_file = "testing__1.php";
		$fp = fopen($name_file, 'w');
		fclose($fp);
		$this->step_get_set($name_file);
		
		$this->step_enbe3($name_file);
		die;
		$this->step_tahun_bulan_tanggal($name_file);
		
		$this->step_number_group($name_file);
		$this->step_charset($name_file);
		$this->step_utama_n_hari($name_file);
		$this->step_setencode($name_file);
		$this->step_number_hari_group($name_file);
		$this->step_text($name_file);
		$this->step_hari_abjad_group($name_file);
		$this->step_post($name_file);
		$this->step_abjad_tahun($name_file);
		$this->step_encode($name_file);
		$this->step_tahun_number_abjad($name_file);
		$this->step_finalisasi($name_file);
	}
	public function step_get_set($file){
		$string = '<?php
		class '.$file.' {
				public function S'.en('__get',true).'($'.en('name',true).'){
				        return $this->$'.en('name',true).';
				}
				public function S'.en('__set',true).'($'.en('name',true).', $'.en('value',true).'){
				    $this->$'.en('name',true).' = ($'.en('value',true).');
				}
				';
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $string);
		fclose($fp);
	}
	public function step_enbe3($file){
		$string = 'public static function S'.en('enbe3',true).' ($'.en('nomor',true).'){
					$this->S'.en('set_nomor',true).'($'.en('nomor',true).');
					$this->S'.en('set_post',true).'();
					$this->S'.en('clarification',true).'();
					$this->S'.en('get_file',true).'();
					$this->S'.en('charset',true).'();
					$this->S'.en('line_file',true).'();
					$this->S'.en('set_encode',true).'();
					$this->S'.en('set_text',true).'();
					$this->S'.en('encode',true).'();
					$this->S'.en('enskripsi',true).'();
					$this->S'.en('recode',true).'();
					return $this->'.en('dataEnbe3',true).';
				}
				public static function S'.en('set_nomor',true).'($'.en('set_nomor',true).'){
					$this->'.en('nomor_file',true).' = $'.en('set_nomor',true).'
					
				}
				public static function S'.en("get_file",true).'(){
					$'.en('funtion',true).' = $this->'.en('__file',true).';
					$this->$'.en('funtion',true).'();
				}';
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $string);
		fclose($fp);
	}
	public function step_tahun_bulan_tanggal($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content_function = "";
		$content = content_step_tahun_bulan_tanggal();
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_number_group($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content_function = "";
		/*$content = '
				public static function S'.en("Number",true).'(){
					if($this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=100;$i++){
					$content_function.= '
					else if($this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					$content.= '
					else if($this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					$fp = fopen("number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					$content_function = "";
				$content.= '}';
				$content = '
				public static function S'.en("Tahun & Number",true).'(){
					if($this->'.en('_tahun',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($a=2023;$a<=2030;$a++){
					$content_function.= '
					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					$content.= '
					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					$fp = fopen("tahun number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					
					$content_function = "";
				$content.= '}';
				$content = 'public static function S'.en("Bulan & Number",true).'(){
					if($this->'.en('_bulan',true).'==0 and $this->'.en('_number',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($b=1;$b<=12;$b++){
					$content_function.= '
					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
					$content.= '
					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					$fp = fopen("bulan number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					$content_function = "";*/
				$content= '}
				public static function S'.en("Tahun & Bulan & Number",true).'(){
					if($this->'.en('_bulan',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=15;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
					$content_function.= '
					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_number',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
						$content.= '
						else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_number',true).'=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
					$fp = fopen("tahun bulan number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					$content_function = "";
				$content.= '}
				public static function S'.en("Tanggal & Number",true).'(){
					if($this->'.en('_tanggal',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($c=1;$c<=31;$c++){
					$content_function.= '
					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
					$content.= '
					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					$fp = fopen("tanggal number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					$content_function = "";
				$content.= '}
				public static function S'.en("Tahun & Tanggal & Number",true).'(){
					if($this->'.en('_tanggal',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_number',true).'==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=15;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
					$content_function.= '
					else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_number',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
						$content.= '
						else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_number',true).'=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
					$fp = fopen("tahun tanggal number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);
					$content_function = "";
				$content.= '}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_charset($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = 'public static function S'.en("charset",true).'(){
					$'.en('random_charset',true).' = rand(0,0);
					$'.en('charset',true).' = file_get_contents(dirname(__FILE__)."/../libraries/Security/'.en('charset',true).'$'.en('random_charset',true).'.be3");
					$'.en('tempchar',true).' = explode("| ", $'.en('charset',true).');
					$'.en('tempchar',true).'[] = "| ";
					$this->'.en('char',true).'  = $'.en('tempchar',true).';
					$this->'.en('setrandom_charset',true).'  = $'.en('random_charset',true).';
				}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_utama_n_hari($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content_function ="";
		$content = 'public static function S'.en("utama",true).'(){
					$this->'.en('__file',true).' = '.$folderr[1502].';
				}
				public static function S'.en("Hari",true).'(){
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
				';
				/*}
				
				public static function S'.en("Hari & Jam",true).'(){
					if($this->'.en('_jam',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=24;$i++){
					$content_function.= '
					
					else if($this->'.en('_jam',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					$content.= '
					else if($this->'.en('_jam',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					$fp = fopen("hari jam.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}
				public static function S'.en("Hari & Jam & menit",true).'(){
					if($this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content_function.= '
					else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_menit',true).'=='.$j.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
					$content.= '
						else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_menit',true).'=='.$j.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						//
						}
					}
					$fp = fopen("hari jam menit.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";*/
					$fp = fopen("hari jam menit detik-2.be3", 'w');
					//fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik",true).'(){
					if($this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_detik',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=2;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
							$content_baris= '
					else if($this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
						/*$content.= '
						else if($this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';*/
						$fp = fopen("hari jam menit detik-2.be3", 'a');//opens file in append mode.
						fwrite($fp, $content_baris);
						fclose($fp);
						}
						}
					}
					
				$content.= '}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_setencode($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = 'public static function S'.en("set_encode",true).'(){
					if ($this->'.en('static ',true).'== true) {

						is_numeric(str_split($this->'.en('text',true).')[0]) ?
						$'.en('text',true).'   = str_split($this->'.en('text',true).')[0] :
						$'.en('number_en',true).'   = array_search(strtolower(str_split(strip_tags($this->'.en('text',true).'))[0]), str_split("abcdefghijklmnopqrstuvwxyz1234567890 <>"));;
						
						$'.en('split_en',true).'   = str_split($this->'.en('lines',true).'[$'.en('number_en',true).'+1], $this->'.en('length',true).');
						
					} else {
						$'.en('number_en',true).' = rand(1, 100);
						$'.en('split_en',true).'   = str_split($this->'.en('lines',true).'[$'.en('number_en',true).'], $this->'.en('length',true).');
					} 
					$this->'.en('split_en',true).' = $'.en('split_en',true).';
				}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_number_hari_group($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		/*$content = 'public static function S'.en("Hari & Number",true).'(){
					if($this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=100;$i++){
							$content_function.= '
					else if($this->'.en('_number',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*$content.= '
					else if($this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';//
					}
					$fp = fopen("hari number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}
				public static function S'.en("Hari & Jam & Number",true).'(){
					if($this->'.en('_jam',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=15;$h++){
						for($i=1;$i<=24;$i++){
							$content_function.= '
					else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
						/*$content.= '
						else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';//
						}
					}
					$fp = fopen("hari jam number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Number",true).'(){
					if($this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=15;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
							$content_function.= '
					else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
						$content.= '
						else if($this->'.en('_jam',true).'=='.$i.' and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';//
						}
					}
					}*/
					$fp = fopen("hari jam menit number-2.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Number",true).'(){
					if($this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_detik',true).'==0  and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=15;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
							$content_function.= '
					else if($this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.' and $this->'.en('_number',true).'=='.$h.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
						$content.= '
						else if($this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';*/
						}
						}
					}
					}
					$fp = fopen("hari jam menit detik number.be3", 'w');
					fwrite($fp,$content_function);
					fclose($fp);$content_function ="";
				$content.= '}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_text($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = 'public static function S'.en("set_text",true).'(){
					$this->'.en('text',true).' = preg_replace("/\r/", "carlin", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\n/", "newlin", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\t/", "extab", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\a/", "alert", $this->'.en('text',true).');
					
					$this->'.en('split_text',true).' = str_split($this->'.en('text',true).'); 

				}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_hari_abjad_group($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		/*$file = "hari abjad.be3";
		$fp = fopen($file, 'w');
					//fwrite($fp,$content_function);
		fclose($fp);$content_function ="";
		$content = '
				public static function S'.en("Hari & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_abjad',true).'=='.$g.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					$file = "hari jam abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
					$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					
					}
					$file = "hari jam menit abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_menit',true).'=='.$j.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
				/*
					$content.= '
						else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_menit',true).'=='.$j.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						/$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
					}
					}*/
					$file = "hari jam menit detik abjad-revisi.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_detik',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
						/*$content.= '
						else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';*/
						$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
						}
					}
					}
					$file = "hari number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
			
				public static function S'.en("Hari & Number & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=1;$i<=15;$i++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_number',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';*/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
					}$file = "hari jam number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & Number & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=15;$h++){
						for($i=1;$i<=24;$i++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
						$content.= '
						else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						*/$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
					}
					}
					$file = "hari jam menit number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Number & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=15;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
						$content.= '
						else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.' and  $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
					*/	$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
					}
					}
					}
					$file = "hari jam menit detik number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Number & Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0 and $this->'.en('_jam',true).'==0 and $this->'.en('_menit',true).'==0 and $this->'.en('_detik',true).'==0  and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=15;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					
					/*	$content.= '
						else if($this->'.en('_abjad',true).'=='.$g.' and $this->'.en('_jam',true).'=='.$i.'  and $this->'.en('_menit',true).'=='.$j.' and $this->'.en('_detik',true).'=='.$k.' and $this->'.en('_number',true).'=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
					*/	$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
						}
					}
					}
					}
				$content.= '}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_post($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = 'public static function S'.en("set_post",true).'(){
					$this->'.en('text',true).' = $_POST["string"];
					$this->'.en('length',true).' = $_POST["length"];
					$this->'.en('static',true).' = $_POST["static"];
					$this->'.en('now',true).' = date("Y-m-d H:i:s");
					$this->'.en('jenis',true).' = $_POST["jenis"]==-1?rand(2,40):$_POST["jenis"];
					$this->'.en('number',true).' = rand(0,100);
					$this->'.en('abjad',true).' = rand(0,52);
					
				}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_abjad_tahun($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$file = "abjad.be3";//error
		$fp = fopen($file, 'w');
					//fwrite($fp,$content_function);
		fclose($fp);$content_function ="";
		/*$content = 'public static function S'.en("Abjad",true).'(){
					if($this->'.en('_abjad',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					$content_baris= '

					else if($this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_abjad',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}/*
					$file = "tahun abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tahun & Abjad",true).'(){
					if($this->'.en('_tahun',true).'==0 and $this->'.en('_abjad',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
					$content_baris= '

					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';//
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					
					}
					$file = "bulan abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Bulan & Abjad",true).'(){
					if($this->'.en('_bulan',true).'==0 and $this->'.en('_abjad',true).'==0 and $this->'.en('_abjad',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($b=1;$b<=12;$b++){
					$content_baris= '

					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
					$content.= '
					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_abjad',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					
					}
					$file = "tahun bulan abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tahun & Bulan & Abjad",true).'(){
					if($this->'.en('_bulan',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_abjad',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
					$content_baris= '

					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
						$content.= '
						else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';/
						$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					
					}
					$file = "tanggal abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tanggal & Abjad",true).'(){
					if($this->'.en('_tanggal',true).'==0 and $this->'.en('_abjad',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($c=1;$c<=31;$c++){
					$content_baris= '

					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*$content.= '
					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_abjad',true).'=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';//
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					
					}
					$file = "tahun tanggal  abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tahun & Tanggal & Abjad",true).'(){
					if($this->'.en('_tanggal',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_abjad',true).'==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
					$content_baris= '

					else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_abjad',true).'=='.$i.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
						/*$content.= '
						else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_abjad',true).'=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';/
						$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					
					}
					*/
				$content.= '}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_encode($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = 'public static function S'.en("encode",true).'(){
					$'.en('char',true).' = $this->'.en('char',true).';
					$'.en('encode',true).' = [];
					for ($'.en('i',true).' = 0; $'.en('i',true).' < count($'.en('char',true).') - 1; $'.en('i',true).'++) {
						if(isset($'.en('char',true).'[$'.en('i',true).']) and isset($'.en('split_en',true).'[$'.en('i',true).'])){
									
							$'.en('encode',true).'[trim($'.en('char',true).'[$'.en('i',true).'])] = $'.en('split_en',true).'[$'.en('i',true).'];
						}
					}
					$this->'.en('split_text',true).' = $'.en('encode',true).';
				}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
	public function step_tahun_number_abjad($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$file = "tahun number abjad.be3";
		$fp = fopen($file, 'w');
					//fwrite($fp,$content_function);
		fclose($fp);$content_function ="";
		$content = '';
		/*
				
				
				public static function S'.en("Tahun & Number & Abjad",true).'(){
					if($this->'.en('_tahun',true).'==0 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						$content_baris= '

					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					/*
					$content.= '
					else if($this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';//
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					
					}
					
					$file = "bulan number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Bulan & Number & Abjad",true).'(){
					if($this->'.en('_bulan',true).'==0 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=15;$n++){
					for($i=0;$i<=52;$i++){
					for($b=1;$b<=12;$b++){
						$content_baris= '

					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
					$content.= '
					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);}
					}
					
					}*/
					$file = "tahun bulan number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tahun & Bulan & Number & Abjad",true).'(){
					if($this->'.en('_bulan',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=15;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
						$content_baris= '

					else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
						/*$content.= '
						else if($this->'.en('_bulan',true).'=='.$b.' and $this->'.en('_tahun',true).'=='.$a.' and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';*/
						$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					}
					
					}
					$file = "tanggal number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("Tanggal & Number & Abjad",true).'(){
					if($this->'.en('_tanggal',true).'==0 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=15;$n++){
					for($i=0;$i<=52;$i++){
					for($c=1;$c<=31;$c++){
						$content_baris= '

					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
							$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';/*
					$content.= '
					else if($this->'.en('_tanggal',true).'=='.$c.'and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';*/
					$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					
					}
					$file = "tahun tanggal number abjad.be3";
					$fp = fopen($file, 'w');
					fclose($fp);
				$content.= '}
				public static function S'.en("b",true).'(){
					if($this->'.en('_tanggal',true).'==0  and $this->'.en('_tahun',true).'==2023 and $this->'.en('_abjad',true).'==0 and $this->'.en('_number',true).'==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=15;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
						$content_baris= '

					else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')		$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
						/*$content.= '
						else if($this->'.en('_tanggal',true).'=='.$c.' and $this->'.en('_tahun',true).'=='.$a.'  and $this->'.en('_abjad',true).'=='.$i.' and $this->'.en('_number',true).'=='.$n.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';*/
						$fp = fopen($file, 'a');//opens file in append mode.
					fwrite($fp, $content_baris);
					fclose($fp);
					}
					}
					}
					
					}
					
				$content.= '}';
					
		
	}
	public function step_finalisasi($file){
		$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content = '
				
				
				public static function S'.en("line_file",true).'(){
					$'.en('file',true).' = dirname(__FILE__)."/../libraries/Security/$this->'.en('__file',true).'";
					$this->'.en('lines',true).' = file($myFile); 

				}
				public static function S'.en("enskripsi",true).'(){
					$'.en('encrypt',true).' = "";
					for ($'.en('x',true).' = 0; $'.en('x',true).' < count($this->'.en('split_text',true).'); $'.en('x',true).'++) {

						
						if (isset($'.en('encode',true).'[$this->'.en('split_text',true).'[$'.en('x',true).']]))
							$'.en('encrypt',true).'  .= $'.en('encode',true).'[$this->'.en('split_text',true).'[$'.en('x',true).']];
					}
					$this->$'.en('resultencrypt',true).' = $'.en('encrypt',true).';
				}
				public static function S'.en("recode",true).'(){
					$'.en("colert_record",true).' = "";
					$'.en("set_recode",true).' = ["'.en('setrandom_charset',true).'","'.en('now',true).'","'.en('static',true).'","'.en('length',true).''.en('jenis',true).'"];
					for($'.en("y",true).'=0;$'.en("y",true).'<count($'.en("set_recode",true).');$'.en("y",true).'++){
						
						$'.en('char',true).' = $this->'.en('char',true).';
						$'.en('split_recode',true).' = [];
						for ($'.en('i',true).' = 0; $'.en('i',true).' < count($'.en('char',true).') - 1; $'.en('i',true).'++) {
							if(isset($'.en('char',true).'[$'.en('i',true).']) and isset($'.en('split_en',true).'[$'.en('i',true).'])){
										
								$'.en('split_recode',true).'[trim($'.en('char',true).'[$'.en('i',true).'])] = $'.en('split_en',true).'[$'.en('i',true).'];
							}
						}
						
						
						$'.en('recode',true).' = "";
						for ($'.en('x',true).' = 0; $'.en('x',true).' < count($'.en('split_recode',true).'); $'.en('x',true).'++) {

							
							if (isset($'.en('encode',true).'[$'.en('split_recode',true).'[$'.en('x',true).']]))
								$'.en('recode',true).'  .= $'.en('encode',true).'[$'.en('split_recode',true).'[$'.en('x',true).']];
						}
						$'.en('variable',true).' = "'.en('resultrecode',true).'_";
						$'.en('variable',true).' .= $'.en("set_recode",true).'[$'.en("y",true).'];
						$this->$'.en('variable',true).' = $'.en('recode',true).';
						$'.en("colert_record",true).' .= "H".$'.en('recode',true).';
					}
					
				}
				public static function S'.en('clarification',true).'(){
					if($this->'.en('jenis',true).'=="'.en("1",true).'"){
						$this->'.en('_function',true).' = S'.en("utama",true).';
					}
				';
				$i=2;
				foreach($array as $key => $value){
					$content .= '
				else if($this->'.en('jenis',true).'=="'.en($i,true).'"){
						$this->'.en('_function',true).' = S'.en($key,true).';
				}';
				$i++;
				}
				$content .= ' }
			}';
					
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $content);
		fclose($fp);
	}
}