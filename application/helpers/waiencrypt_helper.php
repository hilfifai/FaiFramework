<?php 

function enss($text=null,$static=false,$wordbyword=2)
{
 	if($wordbyword<2)$wordbyword=2;
	$c = "MlEx{6937+-mYiAR`=1'>y:@[SorJC,acI<8efg(;LKhpq?/stvzBD2PnWFGNOQTUZ\"%.]uj)HX5dk0}V!b4w_".chr(8).'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';
	$x = 1;	$ent= '';$s = str_split('bcdfghjkmnpqrstvwxyzABCDEGHIJKLMNOPQRSTUVWXYZ1234567890');$a = array();
	if($static == true)
	{
		
		is_numeric(str_split($text)[0])?
			$l   = str_split($text)[0]: 
			$l   = array_search(strtolower(str_split($text)[0]),str_split('abcdfghjkmnpqrstvwxyz1234567890'));;
		$ent = explode('Faa',$c)[$l + 1];
	}else {
		$l=0;//lemah ketika simbol
	while($x <= count(str_split(explode('Faa',$c)[0]))){
		$st = '';
		for($i = 0; $i < $wordbyword; $i++)
		{
			$p = rand(0, count($s) - 1);
			$st .= $s[$p];
		}
		if(!in_array($st,$a)  ){
			$ent .= $st;
			$a[] = $st;
			$x++;
		}
	}  
	} 
	
	$split_en   = str_split($ent,$wordbyword);
	
	$split_text = str_split($text);
	
	$split_date = str_split(date('Y-m-d'));
	$alphabetic = str_split(explode('Faa',$c)[0]);
	for($i = 0;$i < count($alphabetic);$i++){
		$en[$alphabetic[$i]] = $split_en[$i];

	}
	$encrypt = "";
	for($x = 0;$x < count($split_text);$x++){
		if(isset($en[$split_text[$x]]))
		{


			if($split_text[$x] == " "){
				$encrypt .= " ";
			}
			else
			{

				$encrypt .= $en[$split_text[$x]];
			}
		}
		else
		{
			$encrypt .= $split_text[$x];
		}
	}
	$encryptDate = "";
	for($x = 0;$x < count($split_date);$x++){
		if(isset($en[$split_date[$x]]))
		{


			if($split_date[$x] == " "){
				$encryptDate .= " ";
			}
			else
			{

				$encryptDate .= $en[$split_date[$x]];
			}
		}
		else
		{
			$encryptDate .= $split_date[$x];
		}
	}
	//echo 'ini'.$encrypt.'<br>';
	$r = $ent.'Fa'.$wordbyword.'Fa'.$encrypt.'Fa'.$encryptDate;
	
	return $r;
}

  
function de($string){
	$c = "MlEx{6937+-mYiAR`=1'>y:@[SorJC,acI<8efg(;LKhpq?/stvzBD2PnWFGNOQTUZ\"%.]uj)HX5dk0}V!b4w_".chr(8);;
	$split_text = str_split(explode('Fa',$string)[2],explode('Fa',$string)[1]);
	$split_en   = str_split(explode('Fa',$string)[0],explode('Fa',$string)[1]);
	//print_r($split_text);
	//print_r($split_en);
	$alphabetic = str_split($c);
	$decrypt    = "";
	if(explode('Fa',$string)[2] != ''){

		for($i = 0;$i < count($alphabetic);$i++){
			if($split_en[$i] != ''){

				$de[$split_en[$i]] = $alphabetic[$i];
			}
			else
			{

			}

		}

		for($x = 0;$x < count($split_text);$x++){
			if(isset($de[$split_text[$x]]))
			{

				if($split_text[$x] == " "){
					$decrypt .= " ";
				}
				else
				{

					$decrypt .= $de[$split_text[$x]];
				}
			}
			else
			{
				$decrypt .= $split_text[$x];
			} 
		}
	}
	//echo $decrypt;
	return $decrypt;
}  
function deDate($string){
	 $c =  "MlEx{6937+-mYiAR`=1'>y:@[SorJC,acI<8efg(;LKhpq?/stvzBD2PnWFGNOQTUZ\"%.]uj)HX5dk0}V!b4w_";
	$split_text = str_split(explode('Fa',$string)[3],explode('Fa',$string)[1]);
	$split_en   = str_split(explode('Fa',$string)[0],explode('Fa',$string)[1]);
	//print_r($split_text);
	$alphabetic = str_split($c);
	$decrypt    = "";
	if(explode('Fa',$string)[3] != ''){

		for($i = 0;$i < count($alphabetic);$i++){
			if($split_en[$i] != ''){

				$de[$split_en[$i]] = $alphabetic[$i];
			}
			else
			{

			}

		}

		for($x = 0;$x < count($split_text);$x++){
			if(isset($de[$split_text[$x]]))
			{

				if($split_text[$x] == " "){
					$decrypt .= " ";
				}
				else
				{

					$decrypt .= $de[$split_text[$x]];
				}
			}
			else
			{
				$decrypt .= $split_text[$x];
			} 
		}
	}
	return $decrypt;
	
}