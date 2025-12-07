<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(BASEPATH.'../../FaiFramework/MainFaiFramework.php');
class Enskripsi extends CI_Controller {
	public function en(){
		//$this->load->view('enskripsi/en');
		echo en('dataurut',true,2);
	} public function decode(){
		echo de('v4JrKSDTq3l2ZbcHlGVtQuRptTE9RmS92ONdE9RmStjK3CzjXfdcUDMquRptTEyOR9uRptTNCZ5bRGSNlGbEQNKUBc1RGSNluRptTTPEbruRptTu0GwSzjXfdtjK3CzjXfduRptTEyOR9lGVtQuRptTcUDMqzjXfdfm72JzjXfdsKQYx6Bs4nFEizsXGGfR9GyTluRptTEyOR9uRptTSvsiJ7udJNE9RmSlCZ0VxaQRFxBQVlSvsiJRpuRlMVXKwotnW0XGGfRPYbd1q6Qd9fSgzgvroRR9GyTlSSCtpu0GwSIrJjEEBafMRGSNlcTjpl68jqfnnWtiWWjjOWyiEvxBY326Bs4nFEizsXxQfINCZ5bGbEQNXZ2Jprcypp92ONdFfYQzhyBVYmKLZqWRFdxkRfSX0V4qnSbJIaPBr31Gq7kkfm72JWyut2zjXfd31wqX4lIuqpfYTCp8bCguRptTDkWnqDkWnq');
	} public function get_chartset(){
		$text = "saya";
		echo mb_convert_encoding($text, "UTF-8");
echo "<br/><br/>";
echo iconv(mb_detect_encoding($text), "UTF-8", $text);
		echo 	iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
	} public function generate_yang_belum(){
		$generate = array(
		"Hari & Jam & menit & Detik & Number & Abjad" => array("_jam"=>array(0,24),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Tahun & Bulan & Number" => array("_tahun"=>array(2023,2050),"_bulan"=>array(1,12),"_number"=>array(0,15)),
		"Tanggal & Number" => array("_tanggal"=>array(1,31),"_number"=>array(0,15)),
		"Hari & Jam & menit & Detik" => array("_jam"=>array(10,24),"_menit"=>array(0,60),"_detik"=>array(0,60)),
		"Hari & Jam & menit & Detik & Number" => array("_jam"=>array(0,24),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
		"Hari & Jam & menit & Detik & Abjad" => array("_jam"=>array(0,24),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
		"Hari & Number & Abjad" => array("_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Hari & Jam & Number & Abjad" => array("_jam"=>array(0,24),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Hari & Jam & menit & Number & Abjad" => array("_jam"=>array(0,24),"_menit"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Tahun & Bulan & Number & Abjad" => array("_tahun"=>array(2023,2050),"_bulan"=>array(1,12),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Tanggal & Number & Abjad" => array("_tanggal"=>array(1,31),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Tahun & Tanggal & Number & Abjad" => array("_tahun"=>array(2023,2050),"_tanggal"=>array(1,31),"_number"=>array(0,15),"_abjad"=>array(0,52)),
		"Hari & Jam & menit & Detik & Number1" => array("_jam"=>array(0,2),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number2" => array("_jam"=>array(3,4),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number3" => array("_jam"=>array(5,6),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number4" => array("_jam"=>array(7,8),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number5" => array("_jam"=>array(9,10),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number6" => array("_jam"=>array(11,12),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number7" => array("_jam"=>array(13,14),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number8" => array("_jam"=>array(15,16),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number9" => array("_jam"=>array(17,18),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number10" => array("_jam"=>array(19,20),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number11" => array("_jam"=>array(21,22),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),
"Hari & Jam & menit & Detik & Number12" => array("_jam"=>array(23,24),"_menit"=>array(0,60),"_detik"=>array(0,60),"_number"=>array(0,15)),

"Hari & Jam & menit & Detik & Abjad1" => array("_jam"=>array(0,2),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad2" => array("_jam"=>array(3,4),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad3" => array("_jam"=>array(5,6),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad4" => array("_jam"=>array(7,8),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad5" => array("_jam"=>array(9,10),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad6" => array("_jam"=>array(11,12),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad7" => array("_jam"=>array(13,14),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad8" => array("_jam"=>array(15,16),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad9" => array("_jam"=>array(17,18),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad10" => array("_jam"=>array(19,20),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad11" => array("_jam"=>array(21,22),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Abjad12" => array("_jam"=>array(23,24),"_menit"=>array(0,60),"_detik"=>array(0,60),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad1_1" => array("_jam"=>array(0,2),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad1_2" => array("_jam"=>array(0,2),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad1_3" => array("_jam"=>array(0,2),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad1_4" => array("_jam"=>array(0,2),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad1_5" => array("_jam"=>array(0,2),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad1_6" => array("_jam"=>array(0,2),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad2_1" => array("_jam"=>array(3,4),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad2_2" => array("_jam"=>array(3,4),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad2_3" => array("_jam"=>array(3,4),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad2_4" => array("_jam"=>array(3,4),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad2_5" => array("_jam"=>array(3,4),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad2_6" => array("_jam"=>array(3,4),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad3_1" => array("_jam"=>array(5,6),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad3_2" => array("_jam"=>array(5,6),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad3_3" => array("_jam"=>array(5,6),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad3_4" => array("_jam"=>array(5,6),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad3_5" => array("_jam"=>array(5,6),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad3_6" => array("_jam"=>array(5,6),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad4_1" => array("_jam"=>array(7,8),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad4_2" => array("_jam"=>array(7,8),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad4_3" => array("_jam"=>array(7,8),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad4_4" => array("_jam"=>array(7,8),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad4_5" => array("_jam"=>array(7,8),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad4_6" => array("_jam"=>array(7,8),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad5_1" => array("_jam"=>array(9,10),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad5_2" => array("_jam"=>array(9,10),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad5_3" => array("_jam"=>array(9,10),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad5_4" => array("_jam"=>array(9,10),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad5_5" => array("_jam"=>array(9,10),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad5_6" => array("_jam"=>array(9,10),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad6_1" => array("_jam"=>array(11,12),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad6_2" => array("_jam"=>array(11,12),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad6_3" => array("_jam"=>array(11,12),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad6_4" => array("_jam"=>array(11,12),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad6_5" => array("_jam"=>array(11,12),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad6_6" => array("_jam"=>array(11,12),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad7_1" => array("_jam"=>array(13,14),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad7_2" => array("_jam"=>array(13,14),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad7_3" => array("_jam"=>array(13,14),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad7_4" => array("_jam"=>array(13,14),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad7_5" => array("_jam"=>array(13,14),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad7_6" => array("_jam"=>array(13,14),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad8_1" => array("_jam"=>array(15,16),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad8_2" => array("_jam"=>array(15,16),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad8_3" => array("_jam"=>array(15,16),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad8_4" => array("_jam"=>array(15,16),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad8_5" => array("_jam"=>array(15,16),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad8_6" => array("_jam"=>array(15,16),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad9_1" => array("_jam"=>array(17,18),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad9_2" => array("_jam"=>array(17,18),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad9_3" => array("_jam"=>array(17,18),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad9_4" => array("_jam"=>array(17,18),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad9_5" => array("_jam"=>array(17,18),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad9_6" => array("_jam"=>array(17,18),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad10_1" => array("_jam"=>array(19,20),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad10_2" => array("_jam"=>array(19,20),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad10_3" => array("_jam"=>array(19,20),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad10_4" => array("_jam"=>array(19,20),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad10_5" => array("_jam"=>array(19,20),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad10_6" => array("_jam"=>array(19,20),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad11_1" => array("_jam"=>array(21,22),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad11_2" => array("_jam"=>array(21,22),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad11_3" => array("_jam"=>array(21,22),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad11_4" => array("_jam"=>array(21,22),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad11_5" => array("_jam"=>array(21,22),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad11_6" => array("_jam"=>array(21,22),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

"Hari & Jam & menit & Detik & Number & Abjad12_1" => array("_jam"=>array(23,24),"_menit"=>array(0,10),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad12_2" => array("_jam"=>array(23,24),"_menit"=>array(11,20),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad12_3" => array("_jam"=>array(23,24),"_menit"=>array(21,30),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad12_4" => array("_jam"=>array(23,24),"_menit"=>array(31,40),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad12_5" => array("_jam"=>array(23,24),"_menit"=>array(41,50),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),
"Hari & Jam & menit & Detik & Number & Abjad12_6" => array("_jam"=>array(23,24),"_menit"=>array(51,60),"_detik"=>array(0,60),"_number"=>array(0,15),"_abjad"=>array(0,52)),

		);
		$controller ="
		<?php
		
		defined('BASEPATH') OR exit('No direct script access allowed');
		class Enskripsi_generate extends CI_Controller {
		";
		foreach($generate as $key=>$value){
			$count =  count($generate[$key]);
			$file = str_replace(" & ","_",$key);
			
			$isi =[];
			$i=0;
				$var ="abcdefg";
			$param7='';
			
			$param7.='else if(';
			foreach($generate[$key] as $key2=>$value){
				$isi[]=$key2;
			$param7.='$this->'.en($key,true).'=='."'.".'$'.$var[$i].".'";
			if($i!=$count-1)
				$param7.="  and ";
				$i++;
				
			}
				$param7.=')';
				$param7.='				
						$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';';
			//$param7='
					
			if($count==1){
				$batas0 = $generate[$key][$isi[0]][1];
				$param = $generate[$key][$isi[0]][0];
				$param2 = "a";
				$param3 = "a:a";
				$param4 = "if(a<=$batas0){ generate_proses(a+1);}";
				$param5 = '
					$a=$_GET["a"];
					
					';
				$param6='$a';
			}else 
			if($count==2){
				$param = $generate[$key][$isi[0]][0].",".$generate[$key][$isi[1]][0];
				$param2 = "a,b";
				$param3 = "a:a,b:b";
				$batas0 = $generate[$key][$isi[0]][1];
				$batas = $generate[$key][$isi[1]][1];
				$param4 = "
				if(a<=$batas0){
					if(b==$batas){
							    generate_proses(a+1,0);
		                    }else{
		                        
							    generate_proses(a,b+1);
		                    }
		                    }
		                    ";
				$param5 = '
					$a=$_GET["a"];
					$b=$_GET["b"];
					
					';
				$param6='$a."-".$b';
			}else 
			if($count==3){
				$param = $generate[$key][$isi[0]][0].",".$generate[$key][$isi[1]][0].",".$generate[$key][$isi[2]][0];
				$param2 = "a,b,c";
				$param3 = "a:a,b:b,c:c";
				$batas0 = $generate[$key][$isi[0]][1];
				$batas = $generate[$key][$isi[1]][1];
				$awal = $generate[$key][$isi[1]][0];
				$batas2 = $generate[$key][$isi[2]][1];
				$awal2 = $generate[$key][$isi[2]][0];
				$param4 = "
				if(a<=$batas0){
					if(c==$batas2){
	                        if(b==$batas){
	                            generate_proses(a+1,$awal,$awal2);
	                        }else{
	                            generate_proses(a,b+1,$awal2);
	                        }
	                    }else{
	                        generate_proses(a,b,c+1);
	                    }
	                    }
	                    ";
				$param5 = '
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					
					';
				$param6='$a."-".$b."-".$c';
			}else 
			if($count==4){
				$param = $generate[$key][$isi[0]][0].",".$generate[$key][$isi[1]][0].",".$generate[$key][$isi[2]][0].",".$generate[$key][$isi[3]][0];
				$param2 = "a,b,c,d";
				$param3 = "a:a,b:b,c:c,d:d";
				$batas0 = $generate[$key][$isi[0]][1];
				$batas = $generate[$key][$isi[1]][1];
				$awal = $generate[$key][$isi[1]][0];
				$batas2 = $generate[$key][$isi[2]][1];
				$awal2 = $generate[$key][$isi[2]][0];
				$batas3 = $generate[$key][$isi[3]][1];
				$awal3 = $generate[$key][$isi[3]][0];
				$param4 = "
				if(a<=$batas0){
						if(d==$batas3){
							if(c==$batas2){
		                        if(b==$batas){
		                            generate_proses(a+1,$awal,$awal2,$awal3);
		                        }else{
		                            generate_proses(a,b+1,$awal2,$awal3);
		                        }
		                    }else{
		                        generate_proses(a,b,c+1,$awal3);
		                    }
						}else{
		                        generate_proses(a,b,c,d+1);
						
						}
						}
						";
				$param5 = '
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					
					';
				$param6='$a."-".$b."-".$c."-".$d';
			}else 
			if($count==5){
				$param = $generate[$key][$isi[0]][0].",".$generate[$key][$isi[1]][0].",".$generate[$key][$isi[2]][0].",".$generate[$key][$isi[3]][0].",".$generate[$key][$isi[4]][0];
				$param2 = "a,b,c,d,e";
				$param3 = "a:a,b:b,c:c,d:d,e:e";
				$batas0 = $generate[$key][$isi[0]][1];
				$batas = $generate[$key][$isi[1]][1];
				$awal = $generate[$key][$isi[1]][0];
				$batas2 = $generate[$key][$isi[2]][1];
				$awal2 = $generate[$key][$isi[2]][0];
				$batas3 = $generate[$key][$isi[3]][1];
				$awal3 = $generate[$key][$isi[3]][0];
				$batas4 = $generate[$key][$isi[4]][1];
				$awal4 = $generate[$key][$isi[4]][0];
				$param4 = "
						if(a<=$batas0){
							if(e==$batas4){
								if(d==$batas3){
									if(c==$batas2){
				                        if(b==$batas){
				                            generate_proses(a+1,$awal,$awal2,$awal3,$awal4);
				                        }else{
				                            generate_proses(a,b+1,$awal2,$awal3,$awal4);
				                        }
				                    }else{
				                        generate_proses(a,b,c+1,$awal3,$awal4);
				                    }
								}else{
				                        generate_proses(a,b,c,d+1,$awal4);
								
								}
							}else{
				                        generate_proses(a,b,c,d,e+1);
								
							}
						}
						";
				$param5 = '
					$a=$_GET["a"];
					$b=$_GET["b"];
					$c=$_GET["c"];
					$d=$_GET["d"];
					$e=$_GET["e"];
					
					';
				$param6='$a."-".$b."-".$c."-".$d."-".$e';
			}else 
			if($count==6){
				$param = "0,0,0,0,0,0";
				$param2 = "a,b,c,d,e,f";
				$param3 = "a:a,b:b,c:c,d:d,e:e,f:f";
			}else 
			if($count==7){
				$param = "0,0,0,0,0,0,0";
				$param2 = "a,b,c,d,e,f,g";
				$param3 = "a:a,b:b,c:c,d:d,e:e,f:f,g:g";
			}
			$param8="";
			$content = '<div id="content"></div>
			<button type="button" onclick="generate()">Generate '.$key.'</button>
			<script src="'.base_url('jquery.js').'"></script> 
			<script>

			function generate(){
				
	    		generate_proses('.$param.');
	    
			}
			function generate_proses('.$param2.'){
				
								$("#content").append("Generate '.$key.':");
			      $.ajax({
							type: "get",
			        		data:{'.$param3.',},
							url:  "'.base_url('enskripsi_generate/'.$file).'",
							dataType: "html",
							success: function(data){
								 
								$("#content").append(data);
								'.$param4.'
							},
							error: function (error) {
							    console.log("error; " + eval(error));
							    //alert(2);
							}
						});
			    
			    }
			    
			</script>
			';
			$controller .='public function '.$file.'()
			{
				$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		
				
				'.$param5.'
				
				if(!file_exists("'.$file.'_checking.be3")){
					$fp = fopen("'.$file.'_checking.be3", "w");
					fclose($fp);
				}
				$file_checking = base_url("'.$file.'_checking.be3");
				$lines = file($file_checking);	
				if(in_array('.$param6.',$lines)){
					echo '.$param6.'."-sudah<br>";
				}else{
					echo '.$param6.'."<br>";
					$content = '."'".$param7."'".';
					$content .= '."'".$param8."'".';
					$fp = fopen("'.$file.'_'."'.".'$a'.".'".'_result.be3", "a");
					fwrite($fp,$content);
					fwrite($fp,"\n");
					fclose($fp);
					
					$fp = fopen("'.$file.'_checking.be3", "a");
					fwrite($fp,'.$param6.');
					fwrite($fp,"\n");
					fclose($fp);
					
				}
			}public function generate_'.$file.'()
			{
				
				$this->load->view("enskripsi_generate/'.$file.'_View.php");
			}
			
			';
			$fp = fopen($file.'_View.php', 'w');//opens file in append mode. 
			fwrite($fp,$content);
			fclose($fp);
		}
		$controller .="\n
	}";
		echo $controller;
		$fp = fopen('Enskripsi_generate.php', 'w');//opens file in append mode.
			fwrite($fp,$controller);
			fclose($fp);
	}
	 public function get(){
		//$this->load->view('enskripsi/en');
		//echo en('datafile',true,2);
		//echo de('4DU2IoilZLwKZKyHTiMvm2MvTfMvRvQU',2);
		//$charset = file_get_contents(base_url()."/system/libraries/Security/char.be3");
		//$encode = file_get_contents(base_url()."/system/libraries/Security/fai.be3");
		//$char = explode('| ', $charset);
		function dec2hex($number)
		{
		    $hexvalues = array('0','1','2','Z','a','5','6','7',
		               '8','9','A','K','C','D','D','F');
		    $hexval = '';
		     while($number != '0')
		     {
		        $hexval = $hexvalues[bcmod($number,'16')].$hexval;
		        $number = bcdiv($number,'16',0);
		    }
		    return $hexval;
		};
		function nama_file(){
			$loop = true;
			$i=0;
			$sudah=array();
			$stringRandom = "";
			$string = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
			while($loop){
				
				$random = rand(0,count($string)-1);
			
				
						$stringRandom .= $string[$random];
						$i++;
								$sudah[] = $random;
				
				if($i==100)
				$loop=FALSE;
			
			}
			$nama_file = 'H'.$stringRandom;
			return $nama_file;
		}
		$file = nama_file().".be3";
			
			$fp = fopen($file, 'w');
			
			fclose($fp);
		
		for($tgl=0;$tgl<2200;$tgl++){
			$data[$tgl]= array();
			
			$random = rand(0,655884);
			$stringRandom = dec2hex($random);
			$data[$tgl]['urutan'] = $stringRandom;
			$data[$tgl]['data']['nama_file'] =  nama_file();
			//$file = nama_file().".be3";
			
			$fp = fopen(nama_file().'.php', 'w');
			
			fclose($fp);
		
			$string_php = "";
			
			
			$ent = en(json_encode($data[$tgl]),false,10);
			$ent .="\n";
			echo '<br>';
			$fp = fopen($file, 'a');//opens file in append mode.
			fwrite($fp, $ent);
			fclose($fp);
		}
		
		
		
	} 
	public function generate_content()
	{
		echo '<pre>';
			$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
		$content ='public static function S'."'en('Tahun',true).'".'(){
					if($this->'.en('_tahun',true).'==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($a=2023;$a<=2030;$a++){
					$content.= '
					else if($this->'.en('_tahun',true).'=='.$a.')
					$this->'.en('__file',true).' ='.'"'."'.".'$folderr[rand(0,1500)]'.".'".'"'.';
					';
					}
				$content.= '}';
				
				echo $content;
	}public function content_file()
	{
		
		
		$myFile = FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mvjx4zjxm2MvlY/HiKP38IxxsMyD2V0lTiEp4bxfo7r0Yw2lLEOc3AWKmYuk0ir8PDVDmPx6yyWQkS8AX9k0c3CXv1dbzXPJXk2QPcJVFlhcOynfNnam.be3");
			$lines = file($myFile);
			$json = json_decode(de($lines[0],10),true);
			//echo print_r($json['data']['nama_file']);
			$folderr = scandir(FCPATH.("/../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU"));
			//print_r($folderr);
			//for($i=0;$i<count($folderr);$i++){
			//	$list_file[de(str_replace(".be3","",$folderr[$i]))] = $folderr[$i];
			//}
			//print_r($list_file);die;
			//;
			//print_r($lines);
			$array = array(
		"Tahun" => false,
		"Bulan" => false,
		"Tahun Bulan" => false,
		"Tanggal" => false,
		"Tahun Tanggal" => false,
		"Bulan Tanggal" => false,
		"Hari" => true,
		"Jam" => false,
		"Hari & Jam" => false,
		"Menit" => false,
		"Hari & Jam & menit" => false,
		"Detik" => false,
		"Hari & Jam & menit & Detik" => false,
		"Number" => true,
		"Tahun & Number" => true,
		"Bulan & Number" => true,
		"Tanggal & Number" => true,
"Enkripsi Tahun & Bulan & Number" => true,
"Enkripsi Tahun & Tanggal & Number" => true,
	
"Enkripsi Hari & Number" => false,
"Enkripsi Hari & Jam & Number" => false,
"Enkripsi Hari & Jam & menit & Number" => false,
"Enkripsi Hari & Jam & menit & Detik & Number" => false,
	
"Enkripsi Abjad" => false,
	
"Enkripsi Tahun & Abjad" => false,
"Enkripsi Bulan & Abjad" => false,
"Enkripsi Tanggal & Abjad" => false,
"Enkripsi Tahun & Bulan & Abjad" => false,
"Enkripsi Tahun & Tanggal & Abjad" => false,

"Enkripsi Hari & Abjad" => false,
"Enkripsi Hari & Jam & Abjad" => false,
"Enkripsi Hari & Jam & menit & Abjad" => false,
"Enkripsi Hari & Jam & menit & Detik & Abjad" => false,


"Enkripsi Number & Abjad" => true,
"Enkripsi Tahun & Number & Abjad" => false,
"Enkripsi Bulan & Number  & Abjad" => false,
"Enkripsi Tanggal & Number  & Abjad" => false,
"Enkripsi Tahun & Bulan & Number  & Abjad" => false,
"Enkripsi Tahun & Tanggal & Number  & Abjad" => false,
	
"Enkripsi Hari & Number & Abjad" => false,
"Enkripsi Hari & Jam & Number & Abjad" => false,
"Enkripsi Hari & Jam & menit & Number & Abjad" => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Abjad" => false,

"Enkripsi Key" => false,
"Enkripsi Tahun & Key " => false,
"Enkripsi Bulan & Key " => false,
"Enkripsi Tahun & Bulan & Key " => false,
"Enkripsi Tahun & Tanggal & Key " => false,
"Enkripsi Hari & Key " => false,


"Enkripsi Number & Key " => false,

"Enkripsi Tahun & Number & Key " => false,
"Enkripsi Bulan & Number & Key " => false,
"Enkripsi Tanggal & Number & Key " => false,
"Enkripsi Tahun & Bulan & Number & Key " => false,
"Enkripsi Tahun & Tanggal & Number & Key " => false,

"Enkripsi Hari & Number & Key " => false,
"Enkripsi Hari & Jam & Number & Key " => false,
"Enkripsi Hari & Jam & menit & Number & Key " => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Key " => false,
	
"Enkripsi Abjad & Key" => false,
	
"Enkripsi Tahun & Abjad & Key" => false,
"Enkripsi Bulan & Abjad & Key" => false,
"Enkripsi Tanggal & Abjad & Key" => false,
"Enkripsi Tahun & Bulan & Abjad & Key" => false,
"Enkripsi Tahun & Tanggal & Abjad & Key" => false,
"Enkripsi Tahun & Number & Abjad & Key" => false,
"Enkripsi Bulan & Number  & Abjad & Key" => false,
"Enkripsi Tanggal & Number  & Abjad & Key" => false,
"Enkripsi Tahun & Bulan & Number  & Abjad & Key" => false,
"Enkripsi Tahun & Tanggal & Number  & Abjad & Key" => false, 

"Enkripsi Number & Abjad & Key" => false,
"Enkripsi Hari & Number & Abjad & Key" => false,
"Enkripsi Hari & Jam & Number & Abjad & Key" => false,
"Enkripsi Hari & Jam & menit & Number & Abjad & Key" => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Abjad & Key" => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Abjad & Tahun & Key" => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Abjad & Bulan & Key" => false,
"Enkripsi Hari & Jam & menit & Detik & Number & Abjad & Tanggal & Key" => false,
	);
	/*
	
				$i=2;
				foreach($array as $key => $value){
					if($value){
				$content .= 'public static function S'.en($key,true).'(){
					$this->'.en('__file',true).' = '.$folderr[count($folderr)-$i].';
					
				}';
				$i++;
				}
				}*/
		$content = '<?php
			
			class '.$json['data']['nama_file'].' {
				public function S'.en('__get',true).'($'.en('name',true).'){
				        return $this->$'.en('name',true).';
				}
				public function S'.en('__set',true).'($'.en('name',true).', $'.en('value',true).'){
				    $this->$'.en('name',true).' = ($'.en('value',true).');
				}';
				
				
				$content .= 'public static function S'.en('enbe3',true).' ($'.en('nomor',true).'){
					S'.en('set_nomor',true).'($'.en('nomor',true).');
					S'.en('set_post',true).'();
					S'.en('clarification',true).'();
					S'.en('get_file',true).'();
					S'.en('charset',true).'();
					S'.en('line_file',true).'();
					S'.en('set_encode',true).'();
					S'.en('set_text',true).'();
					S'.en('encode',true).'();
					S'.en('enskripsi',true).'();
					S'.en('recode',true).'();
					return $this->'.en('dataEnbe3',true).';
				}
				
				public static function S'.en('set_nomor',true).'($'.en('set_nomor',true).'){
					$this->'.en('nomor_file',true).' = $'.en('set_nomor',true).'
					
				}
				public static function S'.en("get_file",true).'(){
					$'.en('funtion',true).' = $this->'.en('__file',true).';
					$'.en('funtion',true).'();
				}
				public static function S'.en("Tahun",true).'(){
					if($_POST["_tahun"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($a=2023;$a<=2030;$a++){
					$content.= '
					else if($_POST["_tahun"]=='.$a.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Bulan",true).'(){
					if($_POST["_bulan"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($b=1;$b<=12;$b++){
					$content.= '
					else if($_POST["_bulan"]=='.$b.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Tahun Bulan",true).'(){
					if($_POST["_bulan"]==0  and $_POST["_tahun"]==2023)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
						$content.= '
						else if($_POST["_bulan"]=='.$b.' and $_POST["_tahun"]=='.$a.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
				$content.= '}
				public static function S'.en("Tanggal",true).'(){
					if($_POST["_tanggal"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($c=1;$c<=31;$c++){
					$content.= '
					else if($_POST["_tanggal"]=='.$c.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Tahun Tanggal",true).'(){
					if($_POST["_tanggal"]==0  and $_POST["_tahun"]==2023)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
						$content.= '
						else if($_POST["_tanggal"]=='.$c.' and $_POST["_tahun"]=='.$a.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
				$content.= '}
				public static function S'.en("Jam",true).'(){
					if($_POST["_jam"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=24;$i++){
					$content.= '
					else if($_POST["_jam"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Menit",true).'(){
					if($_POST["_menit"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=60;$i++){
					$content.= '
					else if($_POST["_menit"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Detik",true).'(){
					if($_POST["_detik"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=60;$i++){
					$content.= '
					else if($_POST["_detik"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Number",true).'(){
					if($_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=100;$i++){
					$content.= '
					else if($_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Tahun & Number",true).'(){
					if($_POST["_tahun"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($a=2023;$a<=2030;$a++){
					$content.= '
					else if($_POST["_tahun"]=='.$a.' and $_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Bulan & Number",true).'(){
					if($_POST["_bulan"]==0 and $_POST["_number"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($b=1;$b<=12;$b++){
					$content.= '
					else if($_POST["_bulan"]=='.$b.' and $_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Bulan & Number",true).'(){
					if($_POST["_bulan"]==0  and $_POST["_tahun"]==2023 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
						$content.= '
						else if($_POST["_bulan"]=='.$b.' and $_POST["_tahun"]=='.$a.' and $_POST["_number"]=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Tanggal & Number",true).'(){
					if($_POST["_tanggal"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($c=1;$c<=31;$c++){
					$content.= '
					else if($_POST["_tanggal"]=='.$c.'and $_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Tanggal & Number",true).'(){
					if($_POST["_tanggal"]==0  and $_POST["_tahun"]==2023 and $_POST["_number"]==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=100;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
						$content.= '
						else if($_POST["_tanggal"]=='.$c.' and $_POST["_tahun"]=='.$a.'  and $_POST["_number"]=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				
				public static function S'.en("charset",true).'(){
					$'.en('random_charset',true).' = rand(0,0);
					$'.en('charset',true).' = file_get_contents(dirname(__FILE__)."/../libraries/Security/'.en('charset',true).'$'.en('random_charset',true).'.be3");
					$'.en('tempchar',true).' = explode("| ", $'.en('charset',true).');
					$'.en('tempchar',true).'[] = "| ";
					$this->'.en('char',true).'  = $'.en('tempchar',true).';
					$this->'.en('setrandom_charset',true).'  = $'.en('random_charset',true).';
				}
				
				
				public static function S'.en("utama",true).'(){
					$this->'.en('__file',true).' = '.$folderr[1502].';
				}
				public static function S'.en("Hari",true).'(){
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
				}
				public static function S'.en("Hari & Jam",true).'(){
					if($_POST["_jam"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=24;$i++){
					$content.= '
					else if($_POST["_jam"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content.= '
						else if($_POST["_jam"]=='.$i.' and $_POST["_menit"]=='.$j.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_detik"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content.= '
						else if($_POST["_jam"]=='.$i.'  and $_POST["_menit"]=='.$j.' and $_POST["_detik"]=='.$k.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
						}
					}
				$content.= '}
				
				public static function S'.en("set_encode",true).'(){
					if ($static == true) {

						is_numeric(str_split($this->'.en('text',true).')[0]) ?
						$number_en   = str_split($this->'.en('text',true).')[0] :
						$number_en   = array_search(strtolower(str_split(strip_tags($this->'.en('text',true).'))[0]), str_split("abcdefghijklmnopqrstuvwxyz1234567890 <>"));;
						
						$'.en('split_en',true).'   = str_split($lines[$number_en+1], $this->'.en('length',true).');
						
					} else {
						$number_en = rand(1, 100);
						$'.en('split_en',true).'   = str_split($lines[$number_en], $this->'.en('length',true).');
					} 
					$this->'.en('split_en',true).' = $'.en('split_en',true).';
				}
				
				public static function S'.en("Hari & Number",true).'(){
					if($_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=100;$i++){
					$content.= '
					else if($_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Hari & Jam & Number",true).'(){
					if($_POST["_jam"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
						for($i=1;$i<=24;$i++){
						$content.= '
						else if($_POST["_jam"]=='.$i.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Number",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content.= '
						else if($_POST["_jam"]=='.$i.' and $_POST["_menit"]=='.$j.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_detik"]==0  and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content.= '
						else if($_POST["_jam"]=='.$i.'  and $_POST["_menit"]=='.$j.' and $_POST["_detik"]=='.$k.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
						}
					}
					}
				$content.= '}
				
				
				
				public static function S'.en("set_text",true).'(){
					$this->'.en('text',true).' = preg_replace("/\r/", "carlin", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\n/", "newlin", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\t/", "extab", $this->'.en('text',true).');
					$this->'.en('text',true).' = preg_replace("/\a/", "alert", $this->'.en('text',true).');
					
					$this->'.en('split_text',true).' = str_split($this->'.en('text',true).'); 

				}
				public static function S'.en("Hari & Abjad",true).'(){
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
				}
				public static function S'.en("Hari & Jam & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
					$content.= '
					else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0 and $_POST["_menit"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content.= '
						else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.' and  $_POST["_menit"]=='.$j.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_detik"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content.= '
						else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.'  and $_POST["_menit"]=='.$j.' and $_POST["_detik"]=='.$k.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
						}
					}
					}
				$content.= '}
			
				public static function S'.en("Hari & Number & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($i=1;$i<=100;$i++){
					$content.= '
					else if($_POST["_abjad"]=='.$g.' and $_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & Number & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=100;$h++){
						for($i=1;$i<=24;$i++){
						$content.= '
						else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.' and  $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Number & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content.= '
						else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.' and  $_POST["_menit"]=='.$j.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Abjad",true).'(){
					if($_POST["_abjad"]==0 and $_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_detik"]==0  and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($g=0;$g<=52;$g++){
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content.= '
						else if($_POST["_abjad"]=='.$g.' and $_POST["_jam"]=='.$i.'  and $_POST["_menit"]=='.$j.' and $_POST["_detik"]=='.$k.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
						}
					}
					}
					}
				$content.= '}
				
				public static function S'.en("Hari & Number",true).'(){
					if($_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=1;$i<=100;$i++){
					$content.= '
					else if($_POST["_number"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Hari & Jam & Number",true).'(){
					if($_POST["_jam"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
						for($i=1;$i<=24;$i++){
						$content.= '
						else if($_POST["_jam"]=='.$i.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Number",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						$content.= '
						else if($_POST["_jam"]=='.$i.' and $_POST["_menit"]=='.$j.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Hari & Jam & menit & Detik & Number",true).'(){
					if($_POST["_jam"]==0 and $_POST["_menit"]==0 and $_POST["_detik"]==0  and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($h=1;$h<=100;$h++){
					for($i=0;$i<=24;$i++){
						for($j=0;$j<=60;$j++){
						for($k=0;$k<=60;$k++){
						$content.= '
						else if($_POST["_jam"]=='.$i.'  and $_POST["_menit"]=='.$j.' and $_POST["_detik"]=='.$k.' and $_POST["_number"]=='.$h.')
							$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
						}
					}
					}
				$content.= '}
				
				public static function S'.en("set_post",true).'(){
					$this->'.en('text',true).' = $_POST["string"];
					$this->'.en('length',true).' = $_POST["length"];
					$this->'.en('static',true).' = $_POST["static"];
					$this->'.en('now',true).' = date("Y-m-d H:i:s");
					$this->'.en('jenis',true).' = $_POST["jenis"]==-1?rand(2,40):$_POST["jenis"];
					$this->'.en('number',true).' = rand(0,100);
					$this->'.en('abjad',true).' = rand(0,52);
					
				}
				
				
				public static function S'.en("Abjad",true).'(){
					if($_POST["_abjad"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					$content.= '
					else if($_POST["_abjad"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
				$content.= '}
				public static function S'.en("Tahun & Abjad",true).'(){
					if($_POST["_tahun"]==0 and $_POST["_abjad"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
					$content.= '
					else if($_POST["_tahun"]=='.$a.' and $_POST["_abjad"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Bulan & Abjad",true).'(){
					if($_POST["_bulan"]==0 and $_POST["_abjad"]==0 and $_POST["_abjad"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($b=1;$b<=12;$b++){
					$content.= '
					else if($_POST["_bulan"]=='.$b.' and $_POST["_abjad"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Bulan & Abjad",true).'(){
					if($_POST["_bulan"]==0  and $_POST["_tahun"]==2023 and $_POST["_abjad"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
						$content.= '
						else if($_POST["_bulan"]=='.$b.' and $_POST["_tahun"]=='.$a.' and $_POST["_abjad"]=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				public static function S'.en("Tanggal & Abjad",true).'(){
					if($_POST["_tanggal"]==0 and $_POST["_abjad"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($c=1;$c<=31;$c++){
					$content.= '
					else if($_POST["_tanggal"]=='.$c.'and $_POST["_abjad"]=='.$i.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Tanggal & Abjad",true).'(){
					if($_POST["_tanggal"]==0  and $_POST["_tahun"]==2023 and $_POST["_abjad"]==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
						$content.= '
						else if($_POST["_tanggal"]=='.$c.' and $_POST["_tahun"]=='.$a.'  and $_POST["_abjad"]=='.$i.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
				$content.= '}
				
				//public static function S'.en("utama",true).'(){
				//	$this->'.en('__file',true).' = '.$folderr[1502].';
				//}
				
				public static function S'.en("encode",true).'(){
					$'.en('char',true).' = $this->'.en('char',true).';
					$'.en('encode',true).' = [];
					for ($'.en('i',true).' = 0; $'.en('i',true).' < count($'.en('char',true).') - 1; $'.en('i',true).'++) {
						if(isset($'.en('char',true).'[$'.en('i',true).']) and isset($'.en('split_en',true).'[$'.en('i',true).'])){
									
							$'.en('encode',true).'[trim($'.en('char',true).'[$'.en('i',true).'])] = $'.en('split_en',true).'[$'.en('i',true).'];
						}
					}
					$this->'.en('split_text',true).' = $'.en('encode',true).';
				}
				
				
				public static function S'.en("Tahun & Number & Abjad",true).'(){
					if($_POST["_tahun"]==0 and $_POST["_abjad"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
					$content.= '
					else if($_POST["_tahun"]=='.$a.' and $_POST["_abjad"]=='.$i.' and $_POST["_number"]=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					}
				$content.= '}
				public static function S'.en("Bulan & Number & Abjad",true).'(){
					if($_POST["_bulan"]==0 and $_POST["_abjad"]==0 and $_POST["_number"]==0 and $_POST["_abjad"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($b=1;$b<=12;$b++){
					$content.= '
					else if($_POST["_bulan"]=='.$b.' and $_POST["_abjad"]=='.$i.' and $_POST["_number"]=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Bulan & Number & Abjad",true).'(){
					if($_POST["_bulan"]==0  and $_POST["_tahun"]==2023 and $_POST["_abjad"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($b=1;$b<=12;$b++){
						$content.= '
						else if($_POST["_bulan"]=='.$b.' and $_POST["_tahun"]=='.$a.' and $_POST["_abjad"]=='.$i.' and $_POST["_number"]=='.$n.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
					}
				$content.= '}
				public static function S'.en("Tanggal & Number & Abjad",true).'(){
					if($_POST["_tanggal"]==0 and $_POST["_abjad"]==0 and $_POST["_number"]==0)
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($c=1;$c<=31;$c++){
					$content.= '
					else if($_POST["_tanggal"]=='.$c.'and $_POST["_abjad"]=='.$i.' and $_POST["_number"]=='.$n.')
					$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					}
					}
					}
				$content.= '}
				public static function S'.en("Tahun & Tanggal & Number & Abjad",true).'(){
					if($_POST["_tanggal"]==0  and $_POST["_tahun"]==2023 and $_POST["_abjad"]==0 and $_POST["_number"]==0 )
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
					';
					for($n=0;$n<=100;$n++){
					for($i=0;$i<=52;$i++){
					for($a=2023;$a<=2030;$a++){
						for($c=1;$c<=31;$c++){
						$content.= '
						else if($_POST["_tanggal"]=='.$c.' and $_POST["_tahun"]=='.$a.'  and $_POST["_abjad"]=='.$i.' and $_POST["_number"]=='.$n.')
						$this->'.en('__file',true).' ="'.$folderr[rand(0,1500)].'";
						';
						}
					}
					}
					}
				$content.= '}
				
				
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
					$'.en("set_recode",true).' = ["'.en('setrandom_charset',true).'","'.en('now',true).'","'.en('static',true).'","'.en('length',true).''.en('jenis',true).'","'.en('setrandom_charset',true).'","'.en('setrandom_charset',true).'","'.en('setrandom_charset',true).'","",""];
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
			}
			
			?>
			
			';
			echo $content;
			$fp = fopen("coba-2.be3", 'w');
			fwrite($fp,$content);
			fclose($fp);
	} 
	public function moving_file()
	{
		$allfiledir = scandir('complete_en');
		$fp = fopen("perubahannamafile.be3", 'w');
			
			fclose($fp);
		for($i=2;3;$i++){
			rename("complete_en/".$allfiledir[$i] ,"../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU/".en("data".sprintf("%05d",$i)).".be3");
			$ent = $allfiledir[$i]."-->".en("data".sprintf("%05d",$i)).".be3"."\n";
			$fp = fopen("perubahannamafile-2.be3", 'a');//opens file in append mode.
			fwrite($fp, $ent);
		
		fclose($fp);
		}
	}public function moving_file_with_duolicatt()
	{
		//rename("user/image1.jpg", "user/del/image1.jpg");
		$allfiledir = scandir('complete_en');
		//print_r($allfiledir);
		// for($x=0;$x<100;$x++){
		// 	$file = "All".$x.".be3";
		// 	$fp = fopen("enkripsi/".$file, 'w');
		// 	fclose($fp);
		   
		// }
		function showDups($array)
			{
				$array_key =array();
				$array_temp = array();

				foreach($array as $key => $val)
				{
					if (!in_array($val, $array_temp))
					{
					$array_temp[] = $val;
					}
					else
					{
						$array_key[]=$key;
						//echo 'duplicate = ' . $val . '<br />';
					}
				}
				return $array_key;
			}
			//print_r($allfiledir);
		for($i=2;$i<3;$i++){
			rename("complete_en/".$allfiledir[$i] ,"../ApiBe3System/4DU2IoilZLwKZKyHTiMvm2Mva0dzvFQU/");
			/*$myFile = base_url("complete_en/".$allfiledir[$i] );
			$lines = file($myFile);echo '<br>';echo '<br>';echo '<br>';
			echo $allfiledir[$i];
			$all_content = "";
			for($j=1;$j<count($lines);$j++){
				$script = $lines[$j];
				($strsplit = str_split($script,5));
			

			 $duplicate =(showDups($strsplit));
			 $string = "A";
			 if(count($duplicate)){
			 	print_r($duplicate);
			 	echo '<br>';
			 	$final = "";
					 for($m=0;$m<count($duplicate);$m++){
					 	$isi = $strsplit[$duplicate[$m]];
						
					 	$isi[rand(0,4)] = $string;
						
					 	$strsplit[$duplicate[$m]] = $isi;

					 }
					 for($n=0;$n<count($strsplit);$n++){
					 	$final .= $strsplit[$n];
					 }
				}else{
					$final = $script;
			 
				}
			 $final = trim(preg_replace('/\s\s+/', ' ', $final));
			 $final = str_replace(array("\n", "\r"), '', $final);
			 $all_content.=$final."\n";
			*/
			}
		}
//}} 
	public function generate_satu_kali_number()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i=$_GET['i'];
			$file = en(en($i."numfai_en_system",true,2),true,2).".be3";
			if(file_exists($file)){
				echo $i."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "number". $i."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_satu_kali_jam()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i=$_GET['i'];
			$file = en(en($i."jam_en_system",true,2),true,2).".be3";
			if(file_exists($file)){
				echo $i."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "number". $i."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_satu_kali_detik()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i=$_GET['i'];
			$file = en(en($i."detik_en_system",true,2),true,2).".be3";
			if(file_exists($file)){
				echo $i."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "detik". $i."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_satu_kali_menit()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i=$_GET['i'];
			$file = en(en($i."menit_en_system",true,2),true,2).".be3";
			if(file_exists($file)){
				echo $i."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "number". $i."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_hari()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		
		$i=$_GET['Hari'];
			$file = en(en(date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i)))."_en_system",true,2),true,2).".be3";
			if(file_exists($file)){
				echo date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i)))."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "tgl". date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i)))."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_hari_jam()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		
		$i=$_GET['hari'];
		$j=$_GET['jam'];
			$file = en(en(date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j)."hari_jam",true,2),true,2).".be3";
			if(file_exists($file)){
				echo date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j)."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "tgl". date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j)."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}public function generate_hari_jam_menit()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		
		$i=$_GET['hari'];
		$j=$_GET['jam'];
		$k=$_GET['menit'];
			$file = en(en(date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k)."hari_jam_menit",true,2),true,2).".be3";
			if(file_exists($file)){
				echo date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k)."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "hari_jam_menit". date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k)."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}
	public function generate_hari_jam_menit_detik()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		
		$i=$_GET['hari'];
		$j=$_GET['jam'];
		$k=$_GET['menit'];
		$l=$_GET['detik'];
			$file = en(en(date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k).sprintf('%02d',$l)."hari_jam_menit_detik",true,2),true,2).".be3";
			if(file_exists($file)){
				echo date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k).sprintf('%02d',$l)."-sudah<br>";
			}else{
			$fp = fopen($file, 'w');
			echo "hari_jam_menit_detik". date('d-m-Y',strtotime(tambah_tanggal("2023-08-17",$i))).sprintf('%02d',$j).sprintf('%02d',$k).sprintf('%02d',$l)."<br>";
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			}
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		
	}
	public function generate_satu_kali_abjad()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
			
				$i= $_GET['i'];
				$s = str_split('abcdfghijklmnopqrstuvwxyzBCDEFGIJKLMNOPQRSTUVWXYZAH');
				$file = en(en("alphabetic_".$s[$i]."_fai_en_system",true,2),true,2).".be3";
				if(file_exists($file)){
					echo $i."-sudah<br>";
				}else{
					echo 'abjad'.$s[$i].'<br>';
				
				$fp = fopen($file, 'w');
				fclose($fp);
				//$myfile = fopen($file, "w") or die("Unable to open file!");
				//echo $file;die;
				$this->generate_file_key($file);
				$this->generate_file_kodebaris($file);
				//file_put_contents($file,$txt);
				//fwrite($myfile, $txt);
			}
	}
	public function generate_satu_kali_tahun_bulan_tanggal()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
			
				$i= $_GET['i'];
				$j= isset($_GET['j'])?$_GET['j']:'';
				$type= $_GET['type'];
				if($type=='tahun' or $type=='tanggal_tahun' or $type=='bulan_tahun'){
					$i = 2023+(int)$i;
				}
				//$s = str_split('abcdfghijklmnopqrstuvwxyzBCDEFGIJKLMNOPQRSTUVWXYZ');
				$file = en(en($i.$j.$type."_fai_en_system",true,2),true,2).".be3";
				if(file_exists($file)){
					echo $i.'-'.$j."-sudah<br>";
				}else{
					echo $type.''.$i.'-'.$j.'<br>';
				
				$fp = fopen($file, 'w');
				fclose($fp);
				//$myfile = fopen($file, "w") or die("Unable to open file!");
				//echo $file;die;
				$this->generate_file_key($file);
				$this->generate_file_kodebaris($file);
				//file_put_contents($file,$txt);
				//fwrite($myfile, $txt);
			}
	}
	public function generate_satu_kali_tanggal()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
			
				$i= $_GET['i'];
				$s = str_split('abcdfghijklmnopqrstuvwxyzBCDEFGIJKLMNOPQRSTUVWXYZ');
				$file = en(en("".$s[$i]."tanggal_fai_en_system",true,2),true,2).".be3";
				if(file_exists($file)){
					echo $i."-sudah<br>";
				}else{
					echo 'tanggal'.$s[$i].'<br>';
				
				$fp = fopen($file, 'w');
				fclose($fp);
				//$myfile = fopen($file, "w") or die("Unable to open file!");
				//echo $file;die;
				$this->generate_file_key($file);
				$this->generate_file_kodebaris($file);
				//file_put_contents($file,$txt);
				//fwrite($myfile, $txt);
			}
	}
	 
	public function generate_satu_kali_bulan()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
			
				$i= $_GET['i'];
				$s = str_split('abcdfghijklmnopqrstuvwxyzBCDEFGIJKLMNOPQRSTUVWXYZ');
				$file = en(en("".$s[$i]."bulan_fai_en_system",true,2),true,2).".be3";
				if(file_exists($file)){
					echo $i."-sudah<br>";
				}else{
					echo 'bulan'.$s[$i].'<br>';
				
				$fp = fopen($file, 'w');
				fclose($fp);
				//$myfile = fopen($file, "w") or die("Unable to open file!");
				//echo $file;die;
				$this->generate_file_key($file);
				$this->generate_file_kodebaris($file);
				//file_put_contents($file,$txt);
				//fwrite($myfile, $txt);
			}
	}
	public function generate_satu_kali_abjad_number()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i= $_GET['j'];
		$j= $_GET['i'];
			$s = str_split('abcdfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			
			$file = en(en($s[$i]."-".$j."alphanumber",true,2),true,2).".be3";
		if(file_exists($file)){
			echo $i."-sudah<br>";
		}else{
			echo "abjad_number".$s[$i]."-".$j."<br>";
			$fp = fopen($file, 'w');
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		}
	}public function generate_satu_kali_hari_number()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i= $_GET['j'];
		$j= $_GET['i'];
			$s = str_split('abcdfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			
			$file = en(en([$i]."-".$j."daynumber_en_system",true,2),true,2).".be3";
		if(file_exists($file)){
			echo $i."-sudah<br>";
		}else{
			echo "abjad_number".$s[$i]."-".$j."<br>";
			$fp = fopen($file, 'w');
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		}
	}
	public function generate_satu_kali_abjad_tahun_bulan()
	{
		
		//fwrite($fp, 'Cats chase mice');
		//fwrite($fp, 'Cats chase mice');
		//file_put_contents("hello.txt","testfile");
		//die;
		$i= $_GET['j'];
		$j= $_GET['i'];
			$s = str_split('abcdfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
			
			$file = en(en($s[$i]."-".$j."tahun_bulan_en_system",true,2),true,2).".be3";
		if(file_exists($file)){
			echo $i."-sudah";
		}else{
			echo "tahun_bulan_en_system".$s[$i]."-".$j."<br>";
			$fp = fopen($file, 'w');
			fclose($fp);
			//$myfile = fopen($file, "w") or die("Unable to open file!");
			//echo $file;die;
			$this->generate_file_key($file);
			$this->generate_file_kodebaris($file);
			//file_put_contents($file,$txt);
			//fwrite($myfile, $txt);
		}
	}
	public function generate()
	{
		$this->load->view('enskripsi/generate');
	}public function generate_abjad()
	{
		$this->load->view('enskripsi/generate_abjad');
	}public function generate_jam()
	{
		$this->load->view('enskripsi/generate_jam');
	}public function get_generate_detik()
	{
		$this->load->view('enskripsi/generate_detik');
	}public function get_generate_tanggal_bulan_tahun()
	{
		$this->load->view('enskripsi/get_generate_tanggal_bulan_tahun');
	}public function get_generate_menit()
	{
		$this->load->view('enskripsi/generate_menit');
	}public function get_generate_hari()
	{
		$this->load->view('enskripsi/generate_hari');
	
	}public function get_generate_hari_jam()
	{
		$this->load->view('enskripsi/generate_hari_jam');
	}public function get_generate_hari_jam_menit()
	{
		$this->load->view('enskripsi/generate_hari_jam_menit');
	}public function get_generate_hari_jam_menit_detik()
	{
		$this->load->view('enskripsi/generate_hari_jam_menit_detik');
	}
	public function get_generate_abjad_number()
	{
		$this->load->view('enskripsi/generate_abjad_number');
	}
	public function enL1($keyword,$type=-1,$statis=false,$lenght)
	{
		
	}
	public function fileencripsi()
	{
		for($i=0;$i<=1750;$i++){
			$name_file_tgl = en(date(""));	
		}
	}
	public function generate_file_kode_baris_in_file()
	{
		ini_set('memory_limit', '1000M');
		$x= rand(0,50);
		$myFile = base_url("enkripsi/All".$x.".be3" );
		$lines = file($myFile);
		$rand = rand(0,count($lines));
		
		$return= $lines[$rand];
		echo $return;
	}
	public function generate_file_kodebaris($file)
	{
		echo '<pre>';
		$allfiledir = scandir('enkripsi');
		//print_r($allfiledir);
		// for($x=0;$x<100;$x++){
		// 	$file = "All".$x.".be3";
		// 	$fp = fopen("enkripsi/".$file, 'w');
		// 	fclose($fp);
		   
		// }
		function showDups($array)
			{
				$array_key =array();
				$array_temp = array();

				foreach($array as $key => $val)
				{
					if (!in_array($val, $array_temp))
					{
					$array_temp[] = $val;
					}
					else
					{
						$array_key[]=$key;
						//echo 'duplicate = ' . $val . '<br />';
					}
				}
				return $array_key;
			}
		for ($f = 0; $f <= 100; $f++) {
		$total=0;
		$x=0;
		$i=rand(3,($r = count($allfiledir)-1));;
			$myFile = base_url("enkripsi/" . $allfiledir[$i]);
			$lines = file($myFile);
			$j= rand(1,count($lines)-1);
			//for($j=1;$j<count($lines);$j++){
			$text =  ($lines[$j]);
			$final = $text;
			
			$script =$text;
			$split = str_split($text,rand(50,1000));
			
			$susunan = array();
			
			$true = false;
			//echo (count($split));
			//print_r($split);
			//echo '<br>';
			while($true==false){
				$rand = rand(0,count($split)-1);
			//	echo $rand;
				if(!in_array($rand,$susunan)){
					//echo 'ha;;';
					$susunan[]=$rand;
				}
			//	echo count($susunan);
				if(count($susunan)==(count($split))){
					$true=true;
			//		echo count($susunan);
				}
			}
			//print_r($susunan);
			$script = "";
			for($k=0;$k<count($susunan);$k++){
				$script .= $split[$susunan[$k]];
			}
			
			

			//print_r(
			$final = $script;
				($strsplit = str_split($script,5));
			

			// $duplicate =(showDups($strsplit));
			// $string = "A";
			// for($m=0;$m<count($duplicate);$m++){
			// 	$isi = $strsplit[$duplicate[$m]];
				
			// 	$isi[rand(0,4)] = $string;
				
			// 	$strsplit[$duplicate[$m]] = $isi;

			// }
			// $final = "";
			// for($n=0;$n<count($strsplit);$n++){
			// 	$final .= $strsplit[$n];
			// }
			// $final = trim(preg_replace('/\s\s+/', ' ', $final));
			//  $final = str_replace(array("\n", "\r"), '', $final);
			$final.="\n";
			 $fp = fopen($file, 'a');//opens file in append mode.
			fwrite($fp, $final);
			
			fclose($fp);
			// $file = "hallo1.be3";
		 	// $fp = fopen("enkripsi/".$file, 'w');
			 
			//  fwrite($fp, $final);
			//  fclose($fp);
			// $final;
			//echo $total;
			//echo $script;die;
			
			// $fp = fopen("enkripsi/All".$x.".be3", 'a');//opens file in append mode.
			// fwrite($fp, $text."\n");
			// fclose($fp);

			// $fp = fopen("enkripsi/All".$x.".be3", 'a');//opens file in append mode.
			// fwrite($fp, $script."\n");
			// fclose($fp);
			
			$total++;
			

			//}
			//print_r($susunan);die;
		}
		
	}
	public function collectAll()
	{
		$myFile = base_url("assets\dist\index.php?i=" . time());
		$lines = file($myFile);
		
		for($i=1;$i<count($lines);$i++){
			$fp = fopen($file, 'a');//opens file in append mode.
			fwrite($fp, $lines[$i]."\n");
			
			fclose($fp);
		}
	}
	public function count()
	{
		echo de(de('KKaFo6OLCGr5slBHZNucVGt7VTRDi8i8NfNRGN5wPRolkEKQUbnG0o0oi8NfWPy9ZNNRPXBR6yZlNL1Isj8m0o0oNL1IUbZN6yXyUbZNy9NLsj8mWPy9'));
	}
	public function generate_file_key($file)
	{
		$var = file_get_contents(("char.be3"));
		$char = explode('| ', $var);
		//echo '<pre>';print_r($char);die;
		$char[] = '|';
		$x = 0;
		$sudah = array();
		$ent = '';
		$s = str_split('abcdfghijklmnopqrstuvwxyzABCDEFGIJKLMNOPQRSTUVWXYZ1234567890');
		while ($x <= 100) {
			$st = '';
			for ($i = 0; $i < rand(2,31); $i++) {
				$p = rand(0, count($s) - 1);
				$st .= $s[$p];
			}
			if (!in_array($st, $sudah)) {
				$ent .= $st . 'H';
				$sudah[] = $st;
				$x++;
			}
		}
		$ent .="\n";
		$fp = fopen($file, 'a');//opens file in append mode.
		fwrite($fp, $ent);
		
		fclose($fp);
	}
	public function generate_file_kodebaris2($file)
	{
		$var = file_get_contents(("char.be3"));
		$char = explode('| ', $var);
		//echo '<pre>';print_r($char);die;
		$char[] = '|';
		$x = 0;
		
		
		
		for ($f = 0; $f <= 100; $f++) {
			$x = 1;
			$s = str_split('abcdfghijklmnopqrstuvwxyzBCDEFGIJKLMNOPQRSTUVWXYZ1234567890');
			$a = array();
			$ent ='';
			$l = 0; //lemah ketika simbol
			while ($x <= count($char) + 3) {
				$st = '';
				for ($i = 0; $i < 5; $i++) {
					$p = rand(0, count($s) - 1);
					$st .= $s[$p];
				}
				if (!in_array($st, $a)) {
					$ent .= $st;
					$a[] = $st;
					$x++;
				}
			}
			$ent .= "\n";
			$fp = fopen($file, 'a');//opens file in append mode.
			fwrite($fp, $ent);
			
			fclose($fp);
			
			//echo '<br>';
			//die;
		}


		//$this->load->view('welcome_message');
	}
}