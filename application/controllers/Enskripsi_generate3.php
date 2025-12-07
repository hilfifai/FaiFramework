
		<?php
		
		defined('BASEPATH') OR exit('No direct script access allowed');
		class Enskripsi_generate extends CI_Controller {
		public function Hari_Jam_menit_Detik_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad_View.php");
			}
			
			public function Tahun_Bulan_Number()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					
					
				
				if(!file_exists("Tahun_Bulan_Number_checking.be3")){
					$fp = fopen("Tahun_Bulan_Number_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Tahun_Bulan_Number_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c,$lines)){
					echo $a."-".$b."-".$c."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$b.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$c.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Tahun_Bulan_Number_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Tahun_Bulan_Number_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Tahun_Bulan_Number()
			{
				
				$this->load->view("enskripsi_generate/Tahun_Bulan_Number_View.php");
			}
			
			public function Tanggal_Number()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					
					
				
				if(!file_exists("Tanggal_Number_checking.be3")){
					$fp = fopen("Tanggal_Number_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Tanggal_Number_checking.be3");
				$lines = file($file_checking);	
				//print_r($lines);
				//echo array_search($a."-".$b,$lines);
				//in_array(,$lines);
				if(in_array($a."-".$b,$lines)){
					echo $a."-".$b."-sudah<br>";
				}else{
					echo $a."-".$b."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$b.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Tanggal_Number_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Tanggal_Number_checking.be3", "a");
					fwrite($fp,$a."-".$b);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Tanggal_Number()
			{
				
				$this->load->view("enskripsi_generate/Tanggal_Number_View.php");
			}
			
			public function Hari_Jam_menit_Detik()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c,$lines)){
					echo $a."-".$b."-".$c."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9J=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9J=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9J=='.$c.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad_View.php");
			}
			
			public function Hari_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					
					
				
				if(!file_exists("Hari_Number_Abjad_checking.be3")){
					$fp = fopen("Hari_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b,$lines)){
					echo $a."-".$b."-sudah<br>";
				}else{
					echo $a."-".$b."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$b.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Hari_Number_Abjad_View.php");
			}
			
			public function Hari_Jam_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					
					
				
				if(!file_exists("Hari_Jam_Number_Abjad_checking.be3")){
					$fp = fopen("Hari_Jam_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c,$lines)){
					echo $a."-".$b."-".$c."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$c.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_Number_Abjad_View.php");
			}
			
			public function Hari_Jam_menit_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Number_Abjad_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Number_Abjad_View.php");
			}
			
			public function Tahun_Bulan_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Tahun_Bulan_Number_Abjad_checking.be3")){
					$fp = fopen("Tahun_Bulan_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Tahun_Bulan_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$b.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$c.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwE5tBC37YTENvoqsv46647rnzs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Tahun_Bulan_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Tahun_Bulan_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Tahun_Bulan_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Tahun_Bulan_Number_Abjad_View.php");
			}
			
			public function Tanggal_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					
					
				
				if(!file_exists("Tanggal_Number_Abjad_checking.be3")){
					$fp = fopen("Tanggal_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Tanggal_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c,$lines)){
					echo $a."-".$b."-".$c."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$b.'  and $this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$c.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Tanggal_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Tanggal_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Tanggal_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Tanggal_Number_Abjad_View.php");
			}
			
			public function Tahun_Tanggal_Number_Abjad()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Tahun_Tanggal_Number_Abjad_checking.be3")){
					$fp = fopen("Tahun_Tanggal_Number_Abjad_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Tahun_Tanggal_Number_Abjad_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$b.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$c.'  and $this->iuwcBE9pOzfOasfHOi70lv4664Qn43M37YTE7rnzs4FsnwOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM4FsnwFD1OPpcik5k9Mtkv4664GT80b=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ="'.$folderr[rand(0,1500)].'";';
					$content .= '';
					$fp = fopen("Tahun_Tanggal_Number_Abjad_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Tahun_Tanggal_Number_Abjad_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Tahun_Tanggal_Number_Abjad()
			{
				
				$this->load->view("enskripsi_generate/Tahun_Tanggal_Number_Abjad_View.php");
			}
			}
			
			
