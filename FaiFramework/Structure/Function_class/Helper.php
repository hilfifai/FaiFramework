<?php
 function empty_data($row,$text){
	if(!count($row)){
		
	
		return '<div class="text-center mb-3 text-muted fz-14">
		<svg id="Capa_1" enable-background="new 0 0 512.005 512.005" height="100" viewBox="0 0 512.005 512.005" width="100" xmlns="http://www.w3.org/2000/svg"><g><path d="m512.004 192.508c0-10.448-8.501-18.949-18.949-18.949h-47.216c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h47.216c2.177 0 3.949 1.771 3.949 3.949v259.951l-103.457-127.207c-3.614-4.443-8.972-6.992-14.7-6.992h-87.397c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h87.396c1.194 0 2.31.531 3.063 1.457l106.828 131.351h-368.172c-1.194 0-2.311-.531-3.064-1.458l-101.59-124.91c-1.42-1.747-.824-3.51-.502-4.187.322-.678 1.315-2.253 3.566-2.253h235.448c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-131.801v-57.471c1.064.029 2.131.047 3.202.047h88.14c6.291 0 11.912-3.755 14.319-9.567 2.407-5.813 1.089-12.442-3.36-16.891l-12.683-12.683c17.591-19.995 27.565-45.138 28.461-71.862h24.729c1.055 0 2.047.411 2.792 1.156l21.044 21.044c-1.673 4.111-2.604 8.601-2.604 13.306 0 19.527 15.886 35.413 35.413 35.413 18.44 0 33.627-14.171 35.26-32.193h51.477c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-53.346c-4.866-13.751-17.993-23.632-33.39-23.632-9.329 0-17.822 3.632-24.154 9.55l-19.093-19.094c-3.579-3.579-8.337-5.55-13.399-5.55h-25.201c-1.839-19.271-8.462-37.674-19.464-53.761-2.339-3.419-7.006-4.295-10.425-1.957s-4.295 7.006-1.957 10.425c11.377 16.635 17.391 36.12 17.391 56.346 0 26.697-10.397 51.797-29.275 70.675-2.929 2.929-2.929 7.678 0 10.606l17.817 17.817c.126.126.236.236.108.544-.127.308-.282.308-.46.308h-88.14c-55.112 0-99.949-44.837-99.95-99.949 0-26.671 10.403-51.763 29.295-70.655s43.984-29.296 70.655-29.296c21.175 0 41.41 6.543 58.517 18.919 3.357 2.429 8.046 1.676 10.473-1.68 2.428-3.356 1.676-8.045-1.68-10.473-19.681-14.24-42.957-21.767-67.31-21.767-30.678 0-59.537 11.964-81.262 33.689-21.724 21.726-33.688 50.586-33.688 81.263 0 57.19 41.984 104.752 96.748 113.503v58.87h-88.647c-7.383 0-13.94 4.142-17.112 10.81-3.171 6.667-2.248 14.367 2.411 20.095l101.59 124.911c3.614 4.444 8.973 6.993 14.701 6.993h383.939c4.031.05 7.565-3.467 7.499-7.504v-281.057zm-189.928-27.581c11.255 0 20.413 9.157 20.413 20.413s-9.157 20.413-20.413 20.413-20.413-9.157-20.413-20.413 9.157-20.413 20.413-20.413z"/><path d="m276.722 406.47 25.889 34.017c3.289 4.322 8.495 6.902 13.926 6.902h101.018c4.784 0 9.075-2.663 11.2-6.949s1.645-9.314-1.252-13.122l-25.889-34.017c-3.289-4.322-8.495-6.902-13.926-6.902h-101.019c-4.784 0-9.076 2.663-11.2 6.95-2.124 4.288-1.644 9.315 1.253 13.121zm110.966-5.07c.776 0 1.52.369 1.989.986l22.834 30.003h-95.974c-.776 0-1.52-.369-1.989-.986l-22.834-30.003z"/><path d="m202.618 439.887c0 4.142 3.358 7.5 7.5 7.5h45.887c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-45.887c-4.142 0-7.5 3.358-7.5 7.5z"/><path d="m239.259 422.511c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-19.477c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5z"/><path d="m178.918 115.292c0-6.01-2.341-11.661-6.59-15.909-4.25-4.25-9.9-6.591-15.91-6.591s-11.661 2.341-15.91 6.591l-14.685 14.685-14.683-14.686c-4.25-4.25-9.9-6.59-15.91-6.59s-11.661 2.341-15.91 6.59c-4.25 4.25-6.59 9.9-6.59 15.91s2.34 11.66 6.59 15.91l14.684 14.685-14.684 14.684c-4.25 4.25-6.59 9.9-6.59 15.91s2.341 11.661 6.59 15.909c4.25 4.25 9.9 6.591 15.91 6.591s11.661-2.341 15.91-6.59l14.684-14.685 14.685 14.685c4.25 4.25 9.9 6.59 15.91 6.59s11.66-2.34 15.91-6.59 6.59-9.9 6.59-15.91-2.34-11.66-6.59-15.91l-14.685-14.685 14.685-14.685c4.249-4.249 6.589-9.899 6.589-15.909zm-17.197 5.303-19.988 19.988c-2.929 2.929-2.929 7.678 0 10.606l19.988 19.988c1.417 1.417 2.197 3.3 2.197 5.303s-.78 3.887-2.197 5.303-3.3 2.197-5.303 2.197-3.887-.78-5.303-2.197l-19.988-19.988c-1.406-1.407-3.314-2.197-5.303-2.197s-3.897.79-5.303 2.197l-19.988 19.988c-1.416 1.416-3.299 2.196-5.303 2.196s-3.887-.78-5.303-2.197c-1.417-1.416-2.197-3.299-2.197-5.303 0-2.003.78-3.887 2.197-5.303l19.987-19.988c2.929-2.929 2.929-7.678 0-10.606l-19.987-19.988c-1.417-1.417-2.197-3.3-2.197-5.303s.78-3.887 2.197-5.303c1.416-1.417 3.299-2.197 5.303-2.197s3.887.78 5.303 2.197l19.987 19.988c1.406 1.407 3.314 2.197 5.303 2.197s3.897-.79 5.303-2.197l19.988-19.988c1.417-1.417 3.299-2.197 5.303-2.197s3.886.78 5.303 2.198c1.417 1.416 2.197 3.299 2.197 5.303.001 2.003-.779 3.886-2.196 5.303z"/><path d="m419.83 159.372c16.281 0 29.527-13.246 29.527-29.527s-13.246-29.527-29.527-29.527-29.527 13.246-29.527 29.527 13.246 29.527 29.527 29.527zm0-44.054c8.01 0 14.527 6.517 14.527 14.527s-6.517 14.527-14.527 14.527-14.527-6.517-14.527-14.527 6.517-14.527 14.527-14.527z"/><path d="m344.229 104.248c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l4.058-4.058 4.058 4.058c1.464 1.465 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.677 0-10.606l-4.058-4.058 4.058-4.058c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-4.058 4.058-4.058-4.058c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.677 0 10.606l4.058 4.058-4.058 4.058c-2.93 2.929-2.93 7.678 0 10.606z"/><path d="m28.317 295.193c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197l7.065-7.065 7.065 7.065c1.464 1.464 3.384 2.197 5.303 2.197s3.839-.732 5.303-2.197c2.929-2.929 2.929-7.678 0-10.606l-7.065-7.065 7.065-7.065c2.929-2.929 2.929-7.678 0-10.606-2.929-2.929-7.678-2.929-10.606 0l-7.065 7.065-7.065-7.065c-2.929-2.929-7.678-2.929-10.606 0-2.929 2.929-2.929 7.678 0 10.606l7.065 7.065-7.065 7.065c-2.93 2.928-2.93 7.677 0 10.606z"/></g></svg>
		<br>
		'.$text.'
		</div>';
	}else{
		return '';
	}
}

 function nama_bulan($bln){
	$bln = explode('-',$bln)[1];
	switch($bln){
		case 1:
		return "Januari";
		break;
		case 2:
		return "Februari";
		break;
		case 3:
		return "Maret";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Juni";
		break;
		case 7:
		return "Juli";
		break;
		case 8:
		return "Agustus";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "Oktober";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "Desember";
		break;
	}
}
 function tambah_tanggal($tanggal,$jumlah_hari){
	$tgl1 = $tanggal;// pendefinisian tanggal awal
	$tgl2 = date('Y-m-d', strtotime('+'.$jumlah_hari.' days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
	return $tgl2;
}
 function tgl_valid($tgl){
	$ubah    = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah   = explode("-",$ubah);
	$tanggal = $pecah[2];
	$bulan   = bulan_east($pecah[1]);
	$tahun   = $pecah[0];
	return $tanggal.' '.$bulan.' '.$tahun;
}
 function datetime_indo($tgl){
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = bulan($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tanggal.' '.$bulan.' '.$tahun;
}
 function tgl_indo_fd($tgl){
	$waktu = format_tanggal($tgl,'H:i:s'); 
	if($waktu=='00:00:00'){
		$waktu='';
	}else{
		$waktu = 'Pukul '.$waktu;
	}
	$tgl = format_tanggal($tgl,'Y-m-d'); 
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = bulan($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tanggal.' '.$bulan.' '.$tahun.' '.$waktu;
}
 function nama_bulan_hijriah($bulan_ke){
	$bulan = array(1 => "Muharam", "Safar", "Rabiul Awal", "Rabiul Akhir",
		"Jumadil Ula", "Jumadil Akhir", "Rajab", "Syaban",
		"Ramadhan", "Syawal", "Dzulqadah", "Dzulhijjah");
	return $bulan[$bulan_ke];
}
 function tgl_hijriah($tgl){
	$tgl = format_tanggal($tgl,'Y-m-d'); 
	$pecah  = explode("-",$tgl);
	$y =  $pecah[0];
	$m =  $pecah[1];
	$d =  $pecah[2];
	$jd = GregoriantoJD($m, $d, $y);
	$l = $jd - 1948440 + 10632;
	$n = (int) (( $l - 1 ) / 10631);
	$l = $l - 10631 * $n + 354;
	$j = ( (int) (( 10985 - $l ) / 5316)) * ( (int) (( 50 * $l) / 17719)) + (
		(int) ( $l / 5670 )) * ( (int) (( 43 * $l ) / 15238 ));
	$l = $l - ( (int) (( 30 - $j ) / 15 )) * ( (int) (( 17719 * $j ) / 50)) - (
		(int) ( $j / 16 )) * ( (int) (( 15238 * $j ) / 43 )) + 29;
	$m = (int) (( 24 * $l ) / 709 );
	$d = $l - (int) (( 709 * $m ) / 24);
	$y = 30 * $n + $j - 30;
 
	$Hijriah['year'] = $y;
	$Hijriah['month'] = $m;
	$Hijriah['day'] = $d;
 
	return $Hijriah;
}
 
 function tgl_indo($tgl){
	$tgl = format_tanggal($tgl,'Y-m-d'); 
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = bulan($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tanggal.' '.$bulan.' '.$tahun;
}
 function back_tgl_indo($tgl){

	$pecah   = explode(" ",$tgl);
	$tanggal = $pecah[0];
	$bulan   = back_bulan($pecah[1]);
	if($bulan < 10){
		$bulan = '0'.$bulan;
	}
	$tahun = $pecah[2];
	return $tahun.'-'.$bulan.'-'.$tanggal;
}
 function bulan_indo($tgl){
	$ubah    = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah   = explode("-",$ubah);
	$tanggal = $pecah[2];
	$bulan   = bulan($pecah[1]);
	$tahun   = $pecah[0];
	return $bulan;
}



 function back_bulan($bln){
	switch($bln){
		case "Januari":
		return 1;
		break;
		case "Februari":
		return 2;
		break;
		case "Maret":
		return 3;
		break;
		case "April":
		return 4;
		break;
		case "Mei":
		return 5;
		break;
		case "Juni":
		return 6;
		break;
		case "Juli":
		return 7;
		break;
		case "Juli":
		return 7;
		break;
		case "Agustus":
		return 8;
		break;
		case "September":
		return 9;
		break;
		case "Oktober":
		return 10;
		break;
		case "November":
		return 11;
		break;
		case "Desember":
		return 12;
		break;

	}
}
	 function bulan_short($bln){
		switch($bln){
			case 1:
			return "Jan";
			break;
			case 2:
			return "Feb";
			break;
			case 3:
			return "Mar";
			break;
			case 4:
			return "Apr";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Jun";
			break;
			case 7:
			return "Jul";
			break;
			case 8:
			return "Agu";
			break;
			case 9:
			return "Sep";
			break;
			case 10:
			return "Okt";
			break;
			case 11:
			return "Nov";
			break;
			case 12:
			return "Des";
			break;
		}
	}
 function bulan($bln){
	switch($bln){
		case 1:
		return "Januari";
		break;
		case 2:
		return "Februari";
		break;
		case 3:
		return "Maret";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Juni";
		break;
		case 7:
		return "Juli";
		break;
		case 8:
		return "Agustus";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "Oktober";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "Desember";
		break;
	}
}
 function bulan_east($bln){
	switch($bln){
		case 1:
		return "January";
		break;
		case 2:
		return "February";
		break;
		case 3:
		return "March";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "May";
		break;
		case 6:
		return "June";
		break;
		case 7:
		return "July";
		break;
		case 8:
		return "August";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "October";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "December";
		break;
	}
}
 function search_hari($Date,$day_number){
	$days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
	
	return date('Y-m-d', strtotime(''.$days[$day_number].' this week', strtotime($Date)));

}
 function search_hari_antara_tanggal($startDate,$endDate,$day_number){
$endDate = strtotime($endDate);
$days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
$date_array[]=date('Y-m-d',$i);

return $date_array;
 }
 
if( !  function_exists('nama_hari')){
	 function nama_hari($tanggal){
		$ubah      = gmdate($tanggal, time() + 60 * 60 * 8);
		$pecah     = explode("-",$ubah);
		$tgl       = $pecah[2];
		$bln       = $pecah[1];
		$thn       = $pecah[0];

		$nama      = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama == "Sunday"){
			$nama_hari = "Minggu";
		}
		else
		if($nama == "Monday"){
			$nama_hari = "Senin";
		}
		else
		if($nama == "Tuesday"){
			$nama_hari = "Selasa";
		}
		else
		if($nama == "Wednesday"){
			$nama_hari = "Rabu";
		}
		else
		if($nama == "Thursday"){
			$nama_hari = "Kamis";
		}
		else
		if($nama == "Friday"){
			$nama_hari = "Jumat";
		}
		else
		if($nama == "Saturday"){
			$nama_hari = "Sabtu";
		}
		return $nama_hari;
	}
}

if( !  function_exists('hitung_mundur')){
	 function hitung_mundur($wkt){
		$waktu = array(365 * 24 * 60 * 60=> "tahun",
			30 * 24 * 60 * 60 => "bulan",
			7 * 24 * 60 * 60  => "minggu",
			24 * 60 * 60      => "hari",
			60 * 60           => "jam",
			60                => "menit",
			1                 => "detik");

		$hitung = strtotime(date("Y-m-d H:i:s")) - strtotime($wkt);
		$hasil  = array();
		if($hitung < 5){
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else{
			$stop = 0;
			foreach($waktu as $periode => $satuan){
				if($stop >= 6 || ($stop > 0 && $periode < 60)) break;
				$bagi = floor($hitung / $periode);
				if($bagi > 0){
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi * $periode;
					$stop++;
				}
				else
				if($stop > 0) $stop++;
			}
			$hasil = implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}


 function fullLink( ){
	return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
 function dat(){
	return date('Y-m-d H:i:s');
}
 function da(){
	return date('Y-m-d');
}
 function createZip($zip,$dir){
	if(is_dir($dir)){

		if($dh = opendir($dir)){
			while(($file = readdir($dh)) !== false){

				// If file
				if(is_file($dir.$file)){
					if($file != '' && $file != '.' && $file != '..'){

						$zip->addFile($dir.$file);
					}
				}
				else{
					// If directory
					if(is_dir($dir.$file) ){

						if($file != '' && $file != '.' && $file != '..'){

							// Add empty directory
							$zip->addEmptyDir($dir.$file);

							$folder = $dir.$file.'/';

							// Read data of the folder
							createZip($zip,$folder);
						}
					}

				}

			}
			closedir($dh);
		}
	}
}
 function dirToArray($dir){

	$result = array();

	$cdir = scandir($dir);
	foreach($cdir as $key => $value){
		if(!in_array($value,array(".",".."))){
			if(is_dir($dir . DIRECTORY_SEPARATOR . $value)){
				$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
			}
			else{
				$result[] = $value;
			}
		}
	}

	return $result;
}
 function createPath($path){
	if(is_dir($path)) return true;
	$prev_path = substr($path, 0, strrpos($path, '/', - 2) + 1 );
	$return    = createPath($prev_path);
	return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}
 function domain_url(){
	return 'https://'.$_SERVER['HTTP_HOST'].'/';
}



 function rupiah($angka,$decimal = 0){
	$angka = !empty($angka)?$angka:0;
	$ex_angka     = explode(' - ',$angka);
	$hasil_rupiah = '';
	for($i = 0;$i < count($ex_angka);$i++){
		$hasil_rupiah .= "Rp " . number_format($ex_angka[$i],$decimal,',','.');
		if($i != count($ex_angka) - 1)
		$hasil_rupiah .= ' - ';

	}
	//echo $hasil_rupiah;

	return $hasil_rupiah;

}

 function terbilang($i){
	$huruf = array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan","sepuluh","sebelas");

	if($i < 12) return " " . $huruf[$i];
	elseif($i < 20) return terbilang($i - 10) . " belas";
	elseif($i < 100) return terbilang($i / 10) . " puluh" . terbilang($i % 10);
	elseif($i < 200) return " seratus" . terbilang($i - 100);
	elseif($i < 1000) return terbilang($i / 100) . " ratus" . terbilang($i % 100);
	elseif($i < 2000) return " seribu" . terbilang($i - 1000);
	elseif($i < 1000000) return terbilang($i / 1000) . " ribu" . terbilang($i % 1000);
	elseif($i < 1000000000) return terbilang($i / 1000000) . " juta" . terbilang($i % 1000000);
}
 function hitungHari($awal,$akhir){
	$awal    = date("Y-m-d", strtotime($awal));
	$akhir   = date("Y-m-d", strtotime($akhir));
	//$akhir = date_format($akhir,"Y - m - d");

	$tglAwal = strtotime($awal);
	$tglAkhir= strtotime($akhir);
	$jeda    = abs($tglAkhir - $tglAwal);
	return floor($jeda / (60 * 60 * 24));
}
 function hitungHariNoAbs($awal,$akhir){
	$awal    = date("Y-m-d", strtotime($awal));
	$akhir   = date("Y-m-d", strtotime($akhir));
	//$akhir = date_format($akhir,"Y - m - d");

	$tglAwal = strtotime($awal);
	$tglAkhir= strtotime($akhir);
	$jeda    = ($tglAkhir - $tglAwal);
	return floor($jeda / (60 * 60 * 24));
}
 function mondayOfTheWeek($date){
	$week                 = date('W', strtotime($date));
	$year                 = date('Y', strtotime($date));;

	$timestamp            = mktime( 0, 0, 0, 1, 1,  $year ) + ( $week * 7 * 24 * 60 * 60 );
	$timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
	$date_for_monday      = date( 'Y-m-d', $timestamp_for_monday );
	return $date_for_monday;
}
 function format_tanggal($date,$format){
	$ci        = &get_instance();
	$ci->load->helper('date');
	return nice_date($date,$format);
}
 function range_tanggal($tanggal,$awal,$akhir){

	$start_data    = $awal;
	$date          = $start_data;
	$a             =-1;
	$range_tanggal = 0;
	for($i = 0;$i <= hitungHari($awal,$akhir);$i++){

		if($tanggal == $date){
			$range_tanggal += 1;
		}
		else{
			$range_tanggal += 0;
		}

		$date = date('Y-m-d', strtotime($date."+1 day"));
	}
	if($range_tanggal > 0){
		return 1;
	}
	else{
		return 0;

	}
}
 function hitungBulan($awal,$akhir){

	$timeStart = strtotime($awal);
	$timeEnd   = strtotime($akhir);
	// Menambah bulan ini + semua bulan pada tahun sebelumnya
	$numBulan  = 1 + (date("Y",$timeEnd) - date("Y",$timeStart)) * 12;
	// menghitung selisih bulan
	$numBulan += date("m",$timeEnd) - date("m",$timeStart);

	return $numBulan;
}
 function hitungMinggu($tgl_awal, $tgl_akhir){
	$detik    = 24 * 3600;
	$tgl_awal = strtotime($tgl_awal);
	$tgl_akhir= strtotime($tgl_akhir);

	$minggu   = 0;
	for($i = $tgl_awal; $i < $tgl_akhir; $i += $detik){
		if(date("w", $i) == "0"){
			$minggu++;
		}
	}
	return $minggu;
}
 function jml_minggu($tgl_awal, $tgl_akhir){
	$detik    = 24 * 3600;
	$tgl_awal = strtotime($tgl_awal);
	$tgl_akhir= strtotime($tgl_akhir);

	$minggu   = 0;
	for($i = $tgl_awal; $i < $tgl_akhir; $i += $detik){
		if(date("w", $i) == "0"){
			$minggu++;
		}
	}
	return $minggu;
}


 function weekOfMonth($date){
	// estract date parts
	list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

	// current week, min 1
	$w = 1;

	// for each day since the start of the month
	for($i = 1; $i <= $d; ++$i){
		// if that day was a sunday and is not the first day of month
		if($i > 1 && date('w', strtotime("$y-$m-$i")) == 0){
			// increment current week
			++$w;
		}
	}

	// now return
	return $w;
}
 function tgl_indo_no_tahun($tgl){

	$newDate = date("Y-m-d", strtotime($tgl));
	$ubah    = gmdate($newDate, time() + 60 * 60 * 8);
	$pecah   = explode(" ",$ubah);
	$pecah2  = explode("-",$pecah[0]);
	$tanggal = $pecah2[2];
	$bulan   = bulan($pecah2[1]);
	$tahun   = $pecah2[0];
	return $tanggal.' '.$bulan;
}
 function stgl_indo_no_tahun($tgl){

	$newDate = date("Y-m-d", strtotime($tgl));
	$ubah    = gmdate($newDate, time() + 60 * 60 * 8);
	$pecah   = explode(" ",$ubah);
	$pecah2  = explode("-",$pecah[0]);
	$tanggal = $pecah2[2];
	$bulan   = sbulan($pecah2[1]);
	$tahun   = $pecah2[0];
	return $tanggal.' '.$bulan;
}
 function awal_bulan($tgl){
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = ($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tahun.'-'.$bulan.'-1';
}
 function tanggal_lima($tgl){
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = ($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tahun.'-'.$bulan.'-5';
}
 function tanggal_enam($tgl){
	$ubah   = gmdate($tgl, time() + 60 * 60 * 8);
	$pecah  = explode(" ",$ubah);
	$pecah2 = explode("-",$pecah[0]);
	$tanggal= $pecah2[2];
	$bulan  = ($pecah2[1]);
	$tahun  = $pecah2[0];
	return $tahun.'-'.$bulan.'-6';
}

if( !  function_exists('back_bulan')){
	 function back_bulan($bln){
		switch($bln){
			case "Januari":
			return 1;
			break;
			case "Februari":
			return 2;
			break;
			case "Maret":
			return 3;
			break;
			case "April":
			return 4;
			break;
			case "Mei":
			return 5;
			break;
			case "Juni":
			return 6;
			break;
			case "Juli":
			return 7;
			break;
			case "Juli":
			return 7;
			break;
			case "Agustus":
			return 8;
			break;
			case "September":
			return 9;
			break;
			case "Oktober":
			return 10;
			break;
			case "November":
			return 11;
			break;
			case "Desember":
			return 12;
			break;

		}
	}

}
if( !  function_exists('bulan')){	
	 function bulan($bln){
		switch($bln){
			case 1:
			return "Januari";
			break;
			case 2:
			return "Februari";
			break;
			case 3:
			return "Maret";
			break;
			case 4:
			return "April";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Juni";
			break;
			case 7:
			return "Juli";
			break;
			case 8:
			return "Agustus";
			break;
			case 9:
			return "September";
			break;
			case 10:
			return "Oktober";
			break;
			case 11:
			return "November";
			break;
			case 12:
			return "Desember";
			break;
		}
	}
}
if( !  function_exists('bulan_east')){
	 function bulan_east($bln){
		switch($bln){
			case 1:
			return "January";
			break;
			case 2:
			return "February";
			break;
			case 3:
			return "March";
			break;
			case 4:
			return "April";
			break;
			case 5:
			return "May";
			break;
			case 6:
			return "June";
			break;
			case 7:
			return "July";
			break;
			case 8:
			return "August";
			break;
			case 9:
			return "September";
			break;
			case 10:
			return "October";
			break;
			case 11:
			return "November";
			break;
			case 12:
			return "December";
			break;
		}
	}
}
if( !  function_exists('sbulan')){	
	 function sbulan($bln){
		switch($bln){
			case 1:
			return "Jan";
			break;
			case 2:
			return "Feb";
			break;
			case 3:
			return "Mar";
			break;
			case 4:
			return "Apr";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Jun";
			break;
			case 7:
			return "Jul";
			break;
			case 8:
			return "Ags";
			break;
			case 9:
			return "Sep";
			break;
			case 10:
			return "Okt";
			break;
			case 11:
			return "Nov";
			break;
			case 12:
			return "Des";
			break;
		}
	}
}
if( !  function_exists('nama_hari')){
	 function nama_hari($tanggal){
		$ubah      = gmdate($tanggal, time() + 60 * 60 * 8);
		$pecah     = explode("-",$ubah);
		$tgl       = $pecah[2];
		$bln       = $pecah[1];
		$thn       = $pecah[0];

		$nama      = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama == "Sunday"){
			$nama_hari = "Minggu";
		}
		else
		if($nama == "Monday"){
			$nama_hari = "Senin";
		}
		else
		if($nama == "Tuesday"){
			$nama_hari = "Selasa";
		}
		else
		if($nama == "Wednesday"){
			$nama_hari = "Rabu";
		}
		else
		if($nama == "Thursday"){
			$nama_hari = "Kamis";
		}
		else
		if($nama == "Friday"){
			$nama_hari = "Jumat";
		}
		else
		if($nama == "Saturday"){
			$nama_hari = "Sabtu";
		}
		return $nama_hari;
	}
}
 function beda_waktu($date1){
	$date2 = date('Y-m-d H:i:s');
	$diff  = date_diff( date_create($date1), date_create($date2) );
	array('y'=> $diff->y,
		'm'=> $diff->m,
		'd'=> $diff->d,
		'h'=> $diff->h,
		'i'=> $diff->i,
		's'=> $diff->s
	);
	if( $diff->i < 1)
	$return = $diff->format('%s detik yang lalu');
	else
	if( $diff->h < 1)
	$return = $diff->format('%i menit yang lalu');
	else
	if( $diff->d < 1)
	$return = $diff->format('%h jam yang lalu');
	else
	if( $diff->m < 1)
	$return = $diff->format('%d hari yang lalu');
	else
	if( $diff->y < 1)
	$return = $diff->format('%m bulan yang lalu');
	else
	$return = $diff->format('%y tahun yang lalu');
	return $return;
}
if( !  function_exists('hitung_mundur')){
	 function hitung_mundur($wkt){
		$waktu = array(365 * 24 * 60 * 60=> "tahun",
			30 * 24 * 60 * 60 => "bulan",
			7 * 24 * 60 * 60  => "minggu",
			24 * 60 * 60      => "hari",
			60 * 60           => "jam",
			60                => "menit",
			1                 => "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () + 60 * 60 * 8)) - $wkt;
		$hasil  = array();
		if($hitung < 5){
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else{
			$stop = 0;
			foreach($waktu as $periode => $satuan){
				if($stop >= 6 || ($stop > 0 && $periode < 60)) break;
				$bagi = floor($hitung / $periode);
				if($bagi > 0){
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi * $periode;
					$stop++;
				}
				else
				if($stop > 0) $stop++;
			}
			$hasil = implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}

}
 function tambah_minggu($tgl1,$jumlah){
	// pendefinisian tanggal awal
	$tgl2 = date('Y-m-d', strtotime('+'.$jumlah.' weeks', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
	return $tgl2;
}
 function tambah_bulan($tgl1,$jumlah){
	// pendefinisian tanggal awal
	$tgl2 = date('Y-m-d', strtotime('+'.$jumlah.' months', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
	return $tgl2;
}

 function random($panjang_karakter){
	$karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
	$string        = '';
	$split         = str_split($karakter);
	$panjang_split = count($split);
	for($i = 0; $i < $panjang_karakter; $i++){
		$pos = rand(0, $panjang_split - 1);
		$string .= $split[$pos];
	}
	return $string;
}
 function randomaplpanum($panjang_karakter){
	$karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$string        = '';
	$split         = str_split($karakter);
	$panjang_split = count($split);
	for($i = 0; $i < $panjang_karakter; $i++){
		$pos = rand(0, $panjang_split - 1);
		$string .= $split[$pos];
	}
	return $string;
}
 function random_str($panjang_karakter){
	$karakter      = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string        = '';
	$split         = str_split($karakter);
	$panjang_split = count($split);
	for($i = 0; $i < $panjang_karakter; $i++){
		$pos = rand(0, $panjang_split - 1);
		$string .= $split[$pos];
	}
	return $string;
}
 function random_low_num($panjang_karakter){
	$karakter      = '1234567890abcdefghijklmnopqrstuvwxyz';
	$string        = '';
	$split         = str_split($karakter);
	$panjang_split = count($split);
	for($i = 0; $i < $panjang_karakter; $i++){
		$pos = rand(0, $panjang_split - 1);
		$string .= $split[$pos];
	}
	return $string;
}
 function random_num($panjang_karakter){
	$karakter      = '1234567890';
	$string        = '';
	$split         = str_split($karakter);
	$panjang_split = count($split);
	for($i = 0; $i < $panjang_karakter; $i++){
		$pos = rand(0, $panjang_split - 1);
		$string .= $split[$pos];
	}
	return $string;
}

 function paginate($item_per_page, $current_page, $total_records,$func = 'loadDataAkSholat'){
	$pagination = '';
	$total_pages= ceil($total_records / $item_per_page);
	if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){
		//verify total pages and current page number
		$pagination .= '<ul class="pagination m-0 ms-auto">';

		$right_links = $current_page + 3;
		$previous    = $current_page - 3; //previous link
		$next        = $current_page + 1; //next link
		$first_link  = true; //boolean var to decide our first link

		if($current_page > 1){
			$previous_link = ($previous == 0)?1:$previous;
			$pagination .= '<li class="first page-item"><button type="button" class="page-link" onclick="'.$func.'(1)" title="First"><i class="fa fa-angle-double-left"></i></button></li>'; //first link
			$pagination .= '<li  class="page-item "><button type="button" class="page-link" onclick="'.$func.'('.$previous_link.')" title="Previous"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			<path stroke="none" d="M0 0h24v24H0z" fill="none">
			</path>
			<polyline points="15 6 9 12 15 18">
			</polyline>
			</svg></button></li>'; //previous link
			for($i = ($current_page - 2); $i < $current_page; $i++){
				//Create left - hand side links
				if($i > 0){
					$pagination .= '<li class="page-item "> <button type="button" class="page-link" onclick="'.$func.'('.$i.')">'.$i.'</button></li>';
				}
			}
			$first_link = false; //set first link to false
		}

		if($first_link){
			//if current active page is first link
			$pagination .= '<li class="first page-item active"><button type="button" class="page-link" onclick="'.$func.'('.$current_page.')">'.$current_page.'</button></li>';
		}
		elseif($current_page == $total_pages){
			//if it's the last active link
			$pagination .= '<li class="last page-item active"><button type="button" class="page-link" onclick="'.$func.'('.$current_page.')">'.$current_page.'</button></li>';
		}
		else{
			//regular current link
			$pagination .= '<li class="page-item active"><button type="button" class="page-link" onclick="'.$func.'('.$current_page.')">'.$current_page.'</button></li>';
		}

		for($i = $current_page + 1; $i < $right_links ; $i++){
			//create right - hand side links
			if($i <= $total_pages){
				$pagination .= '<li  class="page-item"><button type="button" class="page-link" onclick="'.$func.'('.$i.')">'.$i.'</button></li>';
			}
		}
		if($current_page < $total_pages){
			$next_link = ($i > $total_pages)? $total_pages : $i;
			$pagination .= '<li  class="page-item"><button type="button" class="page-link" onclick="'.$func.'('.$next_link.')" ><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="15px" height="15px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			<path stroke="none" d="M0 0h24v24H0z" fill="none">
			</path>
			<polyline points="9 6 15 12 9 18">
			</polyline>
			</svg></button></li>'; //next link
			$pagination .= '<li class="last page-item"><button type="button" class="page-link" onclick="'.$func.'('.$total_pages.')" title="Last"><i class="fa fa-angle-double-right"></i></button></li>'; //last link
		}

		$pagination .= '</ul>';
	}
	return $pagination; //return pagination links
}
 function compareStrings($oldString, $newString){
	$old_array = explode(' ', $oldString);
	$new_array = explode(' ', $newString);
	$return    = '';
	for($i = 0; isset($old_array[$i]) || isset($new_array[$i]); $i++){
		if(!isset($old_array[$i])){
			$return .= '<font color="red">' . $new_array[$i] . '</font>';
			continue;
		}

		for($char = 0; isset($old_array[$i][$char]) || isset($new_array[$i][$char]); $char++){

			if(!isset($old_array[$i][$char])){
				$return .= '<font color="red">' . substr($new_array[$i], $char) . '</font>';
				break;
			}
			elseif(!isset($new_array[$i][$char])){
				break;
			}

			if(ord($old_array[$i][$char]) != ord($new_array[$i][$char]))
			$return .= '<font color="red">' . $new_array[$i][$char] . '</font>';
			else
			$return .= $new_array[$i][$char];

		}

		if(isset($new_array[$i + 1]))
		$return .= ' ';

	}
	return $return;
}
