<?php


if(!empty($main)){
for($i =0;$i<count($main);$i++){
//print_r($main[$i]);
$costum = '';
if(isset($main[$i]['costum'])){
	$costum =$main[$i]['costum'];
	//print_r($costum);
}
if($main[$i]['content']['type']=='Card'){
	include libfai().'Content/_Card.php';	
	//$this->view('Fai/Content/_Card.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
}
else if($main[$i]['content']['type']=='Input'){
	include libfai().'Content/_Input.php';	
//	$this->view('Fai/Content/_Input.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
}
else  if($main[$i]['content']['type']=='Div'){
	include libfai().'Content/_Div.php';	
	//$this->view('Fai/Content/_Div.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
}
else  if($main[$i]['content']['type']=='Section'){
	include libfai().'Content/_Section.php';	
//	$this->view('Fai/Content/_Section.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
}
else  if($main[$i]['content']['type']=='Form'){
	include libfai().'Content/_Form.php';	
//	$this->view('Fai/Content/_Form.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
} else  if($main[$i]['content']['type']=='Table'){
	include libfai().'Content/_Tables.php';	
	//$this->view('Fai/Content/_Tables.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
} else  if($main[$i]['content']['type']=='Images'){
	include libfai().'Content/_Images.php';	
	//$this->view('Fai/Content/_Images.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
} else  if($main[$i]['content']['type']=='Header'){
	include libfai().'Content/_Heading.php';	
	//$this->view('Fai/Content/_Heading.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
} else  if($main[$i]['content']['type']=='Button'){
	include libfai().'Content/_Button.php';	
	//$this->view('Fai/Content/_Button.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
} else  if($main[$i]['content']['type']=='Typo'){
	include libfai().'Content/_Typo.php';	
	//$this->view('Fai/Content/_Typo.php',array("fai"=>$main[$i]['content'],"costum"=>$costum,"id_fai_now"=>$i));
}else  if($main[$i]['content']['type']=='View'){
	include libfai().'Content/_Typo.php';	
	//$this->view($main[$i]['content']['subtype']);
} 
}
}
?>
