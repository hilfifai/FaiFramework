<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_quran extends CI_Model
{
	public function get_kaidah_b_arab($surat_ke,$ayat = null,$urutan=null)
	{
		if($ayat){
			$this->db->where('kitab_quran_ayat__advance.ayat_ke',$ayat);
		}if($urutan){
			$this->db->where('kitab_quran_ayat__advance.urutan',$urutan);
		}
		
		$query = $this->db
			->where('kitab_quran_ayat__advance.surat_ke',$surat_ke)
			
			
			->order_by('kitab_quran_ayat__advance.surat_ke')
			->group_by('kitab_quran_ayat__advance.surat_ke')
			->order_by('kitab_quran_ayat__advance.ayat_ke')
			->group_by('kitab_quran_ayat__advance.ayat_ke')
			->order_by('kitab_quran_ayat__advance.urutan')
			->group_by('kitab_quran_ayat__advance.urutan')
			->get('kitab_quran_ayat__advance')->result();
			$content =  '<table class="table table-striped">';
			//<b>Surat'.$row->surat_ke.' Ayat'.$row->ayat_ke.'</b> 
			foreach($query as $row){
				$kaidah = '';
				if($row->verb_noun=='Noun' or $row->tag=='N'){
					$kaidah = 'Kata Benda(Isim)';
					
				}else if($row->verb_noun=='Not Noun')
				{
					$kaidah = 'Kata Kerja(Fiil) ';
				}
				if($row->tag == 'ADJ')
					{
						$kaidah .= 'yang menunjukan kata sifat';

					}
					else if($row->tag == 'PRON')
					{
						$kaidah .= 'yang menunjukan Kata ganti orang (isim Dhomir)';

					}
					else if($row->tag == 'REL')
					{
						$kaidah .= 'yang menunjukan Kata ganti relative ';

					}
					else if($row->tag == 'PN')
					{
						$kaidah .= 'yang menunjukan Kata Penyanding yang layak disandingkan dengan kata sebelumnya';

					}else 
					if($row->tag == 'FUT')
					{
						$kaidah .= ' yang menunjukan kata yang akan datang';

					}else if($row->tag == 'CONJ')
					{
						$kaidah .= ' yang menunjukan kata sambung';

					}else if($row->tag == 'PRO')
					{
						$kaidah .= ' yang menunjukan Larangan';

					}else if($row->tag == 'PP')
					{
						$kaidah .= ' yang  terdapat huruf Jar atau kata ganti';

					}else if($row->tag == 'NEG')
					{
						$kaidah .= ' yang  menunjukan kata negatif';

					}
					else if($row->tag == 'PRON')
					{
						$kaidah .= 'yang menunjukan Kata ganti orang';

					}else if($row->tag == 'T')
					{
						$kaidah .= 'yang menunjukan waktu';

					}else if($row->tag == 'DEM')
					{
						$kaidah .= 'yang menunjukan Kata ganti penunjuk';

					}
					if($row->att == 'IMPF')
					{
						$kaidah .= ' Belum Sempurna harus ada penyanding sebelum/setelahnya';

					}
				$content .='
				<tr>
				<td colspan=2 class="fz-17 text-center strong">	Perkata ke-'.$row->urutan.': <br>			
				<span class="font-arabic">'.$row->t.'</span>			</td>
				</tr>
				';
				
				$content .='
				<tr>
				<td>	Arti Kata 			</td>
				<td>	<span class="">'.$row->i.'</span>			</td>
				</tr>
				';
				$content .='
				<tr>
				<td>	Penggalan Huruf 			</td>
				<td>	<span class="font-arabic">'.$row->penggalan_huruf.'</span>			</td>
				</tr>
				';	
				
				
				
				
				if($row->peruntukan=='Male'){
					$kaidah = 'Mudzakar / Laki  Laki';
				}else if($row->peruntukan=='Female'){
					$kaidah = 'Muannats / Perempuan';
				}else {
					$kaidah = '-';
				}
				$content .='
				<tr>
				<td>	Peruntukan			</td>
				<td>	<span class="">'.$kaidah.'</span>			</td>
				</tr>
				';	
				
				if($row->deg==1){
					$kaidah = 'Dhomir Munfashil / Berdiri Sendiri';
				}else if($row->deg==2){
					$kaidah = 'Dhomir Munfashil / Sebagai Objek';
				}else if($row->deg==3){
					$kaidah = 'Dhomir Munstatir';
				} else {
					$kaidah = '-';
				}if($row->deg==1){
					$kaidah = 'Dhomir Mutakallim / yang Berbicara';
				}else if($row->deg==2){
					$kaidah = 'Dhomir Munkhattab / yang diajak bicara';
				}else if($row->deg==3){
					$kaidah = 'Dhomir Ghaib / sedang dibicarakan';
				} else {
					$kaidah = '-';
				}
				$content .='
				<tr>
				<td>				</td>
				<td>			</td>
				</tr>
				';$content .='
				<tr>
				<td>	Dhomir			</td>
				<td>	<span class="">'.$kaidah.'</span>			</td>
				</tr>
				';	
				$content .='
				<tr>
				<td>	Tasrif Bentuk Irab/nahwu			</td>
				<td>	<span class="font-arabic">'.$row->r.'</span>';
				$content .=' - <span class="font-arabic">'.$row->t.'</span>';
				$content .=' - <span class="font-arabic">'.$row->l.'</span>			</td>
				</tr>
				';	
				
				$content .='
				<tr>
				<td>	Kaidah Shorof			</td>
				<td>	<span class="font-arabic">'.$row->ag.'</span>	<div class="text-muted">'.arab2latin($row->ag_harakat).'</div>		</td>
				</tr>
				';	
				
				$content .='
				<tr style="border-bottom:#111">
				<td>	Tasrif Bentuk Sharaf	</td>
				<td>	<span class="font-arabic">'.$row->lu.'</span>				</td>
				</tr>
				
				';	
				
			}
			$content.='</table>';
		return $content;
	}public function get_page($id_quran_versi,$surat_or_halaman,$ayat_or_baris = null,$urutan = 1,$mode='default')
	{
		
		
		$this->db->join('kitab_quran_ayat__perkata','id_ayat_perkata=kitab_quran_ayat__perkata.id');
		$this->db->where('id_quran_versi',$id_quran_versi);
		
		
		
		if($mode == 'max_row'){
			$this->db->where('page_halaman',$surat_or_halaman);
			$this->db->where('page_baris',$ayat_or_baris);
			$this->db->select_max('page_urutan');
			return $this->db->get('kitab_quran__versi_susunan')->row()->page_urutan;
		}
		else if($mode == 'max_baris'){
			$this->db->where('page_halaman',$surat_or_halaman);
			$this->db->select_max('page_baris');
			return $this->db->get('kitab_quran__versi_susunan')->row()->page_baris;
		}else if($mode == 'huruf_halaman'){
			$this->db->where('page_halaman',$surat_or_halaman);
			$this->db->where('type','ayat');
			$this->db->limit(1);
			return $this->db->get('kitab_quran__versi_susunan')->row()->kata_arab;
		}else if($mode == 'huruf_baris'){
			$this->db->where('page_halaman',$surat_or_halaman);
			$this->db->where('page_baris',$ayat_or_baris);
			$this->db->where('type','ayat');
			$this->db->limit(1);
			
			return $this->db->get('kitab_quran__versi_susunan')->row()->kata_arab;
		}else if($mode == 'huruf_ayat'){
			$this->db->where('surat_ke',$surat_or_halaman);
			$this->db->where('ayat_ke',$ayat_or_baris);
			$this->db->where('urutan',$urutan);
			$this->db->where('type','ayat');
			$this->db->limit(1);
			
			return $this->db->get('kitab_quran__versi_susunan')->row()->kata_arab;
		}
		else
		{
			$this->db->where('surat_ke',$surat_or_halaman);
			$this->db->where('ayat_ke',$ayat_or_baris);
			if($urutan)
			$this->db->where('urutan',$urutan);
			return $this->db->get('kitab_quran__versi_susunan')->row();
		}
	}
	
	public function get_index_tematik($surat,$ayat = null)
	{	
		$this->db->where('surat',$surat);
		$this->db->where('ayat',$ayat);
		$this->db->join('kitab_quran_tematik','id_quran_tematik = kitab_quran_tematik.id');
		return $this->db->get('kitab_quran_tematik__ayat')->result();
	}public function get_index_tematik_parent($id)
	{	
		$this->db->where('id',$id);
		return $this->db->get('kitab_quran_tematik')->row();
	}
	public function get_ayat($surat,$ayat = null,$mode = 'default')
	{
		$this->db->join('kitab_quran_surat__detail','kitab_quran_ayat.id_quran_surat = kitab_quran_surat__detail.id_quran_surat','left');
		$this->db->where('kitab_quran_surat__detail.lang','ID');
		$this->db->where('kitab_quran_ayat.surat_ke',$surat);
		if($ayat)
		$this->db->where('kitab_quran_ayat.ayat_ke',$ayat);
		if($mode == 'get'){

			return $this->db->get('kitab_quran_ayat')->row();
		}
		else
		{

			return $this->db->get('kitab_quran_ayat')->result();
		}
	}
	public function get_terjemah($surat,$ayat,$lang = 'ID',$mode = 'default')
	{
		$this->db->where('kitab_quran_ayat__terjemah.surat_ke',$surat);
		 
		$this->db->where('kitab_quran_ayat__terjemah.ayat_ke',$ayat);
		$this->db->where('kitab_quran_ayat__terjemah.lang',$lang);
		$row = $this->db->get('kitab_quran_ayat__terjemah')->row();
		
		return $row->text_terjemah;

	}
	public function get_surat($surat = null)
	{
		$this->db->join('kitab_quran_surat__detail','kitab_quran_surat.id = kitab_quran_surat__detail.id_quran_surat');
		$this->db->where('kitab_quran_surat__detail.lang','ID');
		if($surat)
		{
			$this->db->where('kitab_quran_surat.surat_ke',$surat);
			return $this->db->get('kitab_quran_surat')->row();
		}
		else
		{
			return $this->db->get('kitab_quran_surat')->result();
		}


	}
}