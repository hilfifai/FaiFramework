
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Tahun_Bulan_Number_".$a."_result.be3", "a");
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
				if(in_array($a."-".$b,$lines)){
					echo $a."-".$b."-sudah<br>";
				}else{
					echo $a."-".$b."<br>";
					$content = 'else if($this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$a.'  and $this->iuwcBE9pOzfOasfHOi70lv46647rnzsMPUZSMPUZSv4664Nvoqs4Fsnw6c3Kg37YTERMO3Mpcik5iKaOcrLPxM=='.$b.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Tanggal_Number_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Tahun_Bulan_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Tanggal_Number_Abjad_".$a."_result.be3", "a");
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
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Tahun_Tanggal_Number_Abjad_".$a."_result.be3", "a");
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
			
			public function Hari_Jam_menit_Detik_Number1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi3JX2Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiPm1KQ=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiYXJlS=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSigQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSigQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSigQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSigQmZS=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSidRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSidRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSidRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSidRxM8=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number7()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number7_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number7_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number7_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiBlr1u=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiBlr1u=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiBlr1u=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiBlr1u=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number7_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number7_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number7()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number7_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number8()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number8_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number8_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number8_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiDctKK=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiDctKK=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiDctKK=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiDctKK=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number8_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number8_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number8()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number8_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number9()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number9_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number9_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number9_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiGRmf6=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiGRmf6=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiGRmf6=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiGRmf6=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number9_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number9_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number9()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number9_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number10()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number10_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number10_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number10_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z1GO2X=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z1GO2X=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z1GO2X=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z1GO2X=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number10_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number10_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number10()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number10_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number11()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number11_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number11_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number11_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z2pS6Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number11_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number11_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number11()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number11_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number12()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number12_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number12_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number12_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSi2pS6Z3JX2Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number12_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number12_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number12()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number12_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQ=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlS=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZS=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad7()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad7_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad7_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad7_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1u=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1u=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1u=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1u=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad7_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad7_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad7()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad7_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad8()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad8_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad8_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad8_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKK=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKK=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKK=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKK=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad8_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad8_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad8()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad8_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad9()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad9_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad9_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad9_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad9_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad9_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad9()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad9_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad10()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad10_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad10_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad10_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2X=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2X=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2X=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2X=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad10_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad10_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad10()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad10_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad11()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad11_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad11_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad11_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad11_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad11_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad11()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad11_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Abjad12()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Abjad12_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Abjad12_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Abjad12_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d,$lines)){
					echo $a."-".$b."-".$c."-".$d."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2Z=='.$d.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Abjad12_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Abjad12_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Abjad12()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Abjad12_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad1_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad1_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad1_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6ZQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad1_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad1_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad1_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad2_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad2_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad2_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b3JX2ZQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad2_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad2_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad2_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad3_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad3_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad3_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bPm1KQQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad3_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad3_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad3_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad4_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad4_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad4_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bYXJlSQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad4_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad4_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad4_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad5_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad5_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad5_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bgQmZSQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad5_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad5_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad5_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad6_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad6_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad6_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bdRxM8QGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad6_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad6_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad6_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad7_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad7_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad7_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bBlr1uQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad7_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad7_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad7_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad8_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad8_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad8_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bDctKKQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad8_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad8_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad8_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad9_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad9_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad9_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8bGRmf6QGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad9_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad9_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad9_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad10_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad10_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad10_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z1GO2XQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad10_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad10_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad10_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad11_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad11_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad11_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z2pS6ZQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad11_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad11_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad11_6_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_1()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_1_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_1_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_1_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T2pS6Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T2pS6Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T2pS6Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T2pS6Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T2pS6Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_1_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_1_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_1()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_1_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_2()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_2_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_2_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_2_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T3JX2Z=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T3JX2Z=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T3JX2Z=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T3JX2Z=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2T3JX2Z=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_2_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_2_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_2()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_2_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_3()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_3_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_3_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_3_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TPm1KQ=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TPm1KQ=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TPm1KQ=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TPm1KQ=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TPm1KQ=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_3_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_3_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_3()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_3_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_4()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_4_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_4_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_4_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TYXJlS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TYXJlS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TYXJlS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TYXJlS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TYXJlS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_4_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_4_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_4()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_4_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_5()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_5_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_5_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_5_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TgQmZS=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TgQmZS=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TgQmZS=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TgQmZS=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TgQmZS=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_5_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_5_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_5()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_5_View.php");
			}
			
			public function Hari_Jam_menit_Detik_Number_Abjad12_6()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					
				
				if(!file_exists("Hari_Jam_menit_Detik_Number_Abjad12_6_checking.be3")){
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_6_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("Hari_Jam_menit_Detik_Number_Abjad12_6_checking.be3");
				$lines = file($file_checking);	
				if(in_array($a."-".$b."-".$c."-".$d."-".$e,$lines)){
					echo $a."-".$b."-".$c."-".$d."-".$e."-sudah<br>";
				}else{
					echo $a."-".$b."-".$c."-".$d."-".$e."<br>";
					$content = 'else if($this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TdRxM8=='.$a.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TdRxM8=='.$b.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TdRxM8=='.$c.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TdRxM8=='.$d.'  and $this->G1aqxxVkwdwfa2zHafapk7xJvKoxRSioV2hiwWTb7hItso7xJvKE3KXawWTb7E3KXaKV59hmRhkkoV2hiSkw2RwWTb7o6VLnKV59hSkw2RoV2hiOmt9JwWTb7qwPKNK60PNE3KXavg12zKV59hoxRSiwWTb71y3Nfvg12zohLMy7xJvKGLY8b2pS6Z3JX2ZQGg2TdRxM8=='.$e.')				
						$this->Sfr6p8RVFbxcb7VH62tM362tM3iMYh4i72gzCqhdYWcBMS ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
					$content .= '';
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_6_".$a."_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("Hari_Jam_menit_Detik_Number_Abjad12_6_checking.be3", "a");
					fwrite($fp,$a."-".$b."-".$c."-".$d."-".$e);
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_Hari_Jam_menit_Detik_Number_Abjad12_6()
			{
				
				$this->load->view("enskripsi_generate/Hari_Jam_menit_Detik_Number_Abjad12_6_View.php");
			}
			
			

	}