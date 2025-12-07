&#60;?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helper_function;


use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Fill;
use App\Eloquent\AbsenLog;
use App\Eloquent\Absen;
use DateTime;;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PHPExcel;
use PHPExcel_IOFactory;
use PDF;

class <?php echo $fai->nama_controller($page,$page['title']);?> extends Controller
{
	<?php 

$array = $page['crud']['array'];

$array_temp = $array;
$page['crud']['array'] = $array ;
$page['database_provider'] = 'mysql';
$page['app_framework'] = 'ci';

$pagetemp = $page;
?>
    public function __construct()
    {
        $this->middleware('auth');
    }public function index(Request $request,$page,$id)
    {
    	return $this->$page($request,$id);
    }public function index_post(Request $request,$page,$id)
    {
    	return $this->$page($request,$id);
    }public function list($request,$id)
    {
    	
    	<?php 
		$all_field_appr =  '';
		$field_appr =  '';
		$page['database'] = Database::converting_primary_key($page,$page['database'],"utama");
    	
        $temp_database  = $page['database'];
    	$search = isset($page['crud']['search'])?$page['crud']['search']:array();
    	$database_utama = $page['database']['utama'];
		$primary_key = $page['database']['primary_key'];
		$page['database']['where'] = isset($page['database']['where'])?$page['database']['where']:array();
		$temp_where = $page['database']['where'];
		$where[] =array("1", "=", '1');
		$page['database']['select'] = isset($page['database']['select'])?$page['database']['select']:array();
		$select=array();
		
		for ($i = 0; $i < count($array); $i++) {
            $text = $array[$i][0];
            $field = $array[$i][1];
            $typearray = $array[$i][2];
            $extypearray = explode('-',$typearray);
			
            if($typearray=='select-appr'){
            	
				$all_field_appr = $field_appr =  $field;
				$select[] = $database_utama . "." . $field_appr."_status as system_status_appr";
				if( $type=='appr' and !isset($page['crud']['appr_no_select'])){
					
            		$where[] = array($database_utama . "." . $field_appr."_id",'=',$idUser);
            		
				}
            	
           
        	}
        }
    	foreach ($search as $key => $value) {
            if ($key == -1) {
            	echo '
            	$search_active = "1=1";
            	if($request->get("search-active"))
            		$search_active = "  '.$database_utama.'.active=".$request->get("search-active");
            	
            	';
               $where[] = array(" ", " ", '$search_active');
            }else if ($key == -2) {
				$field_appr =  $field;
            	echo '
            	$status_appr = "1=1";
            	if($request->get("status-appr"))
            		$status_appr = "  '.$database_utama.'.'.$field_appr.'=".$request->get("status-appr");
            	
            	';
               $where[] = array(" ", " ", ('$status_appr'));
            } else {
                $i = $key;
               
                if($array[$i][2]=='date'){
                	$row = $array[$i][1];
                	echo '
		            	$'.$row.'_dari = "1=1";
		            	if($request->get("'.$row.'_dari"))
		            		$'.$row.'_dari = "  '.$row.'>=".$request->get("'.$row.'_dari");
		            	
		            ';
                	echo '
		            	$'.$row.'_sampai = "1=1";
		            	if($request->get("'.$row.'_sampai"))
		            		$'.$row.'_sampai = "  '.$row.'<=".$request->get("'.$row.'_sampai");
		            	
		            ';
                	$dari = $row.'_dari';
                	$where[] = array(" ", "", '$'.$dari.'');
	                $where[] = array(" ", "", '$'.$row.'_sampai');
                }else{
                	 $row = $array[$i][1];
                	echo '
		            	$'.$row.' = "1=1";
		            	if($request->get("'.$row.'"))
		            		$'.$row.' = "  '.$row.'<=".$request->get("'.$row.'");
		            	
		            ';
	               
	                $where[] = array(" ", " ", '$'.$row);
                }
            }
        }
		$page['database']['select'] = array_merge($page['database']['select'], $select);
		$page['database']['where'] =   array_merge($page['database']['where'], $where);
    		$ci = &get_instance();
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
			
    	?> 
    	
    	
        $sql="<?=$query?>";
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
		<?php 
		$compact = '';
		if(isset($page['crud']['no_edit'])){
			echo '$no_edit = true;';
			$compact = '"no_edit",';	
		}else
		if(isset($page['crud']['no_delete'])){
			echo '$no_delete = true;';
			$compact = '"$no_delete",';	
		}else
		if(isset($page['crud']['no_add'])){
			echo '$no_add = true;';
			$compact = '"$no_add",';	
		}?>
       	if($request->Cari =='pdf'){
			return $this->pdf($<?php echo $fai->nama_function($page,$page['title']);?>);
		}else if($request->Cari =='excel'){
			return $this->excel($request,$<?php echo $fai->nama_function($page,$page['title']);?>);
		}else if($request->Cari =='export_empty'){
			return $this->export_empty($request,$<?php echo $fai->nama_function($page,$page['title']);?>);
		}else if($request->Cari =='import_excel'){
			return $this->import_excel($request,$<?php echo $fai->nama_function($page,$page['title']);?>);
		}else{
		
        	return view('<?php echo $fai->nama_function($page,$page['title']);?>.list_<?php echo $fai->nama_function($page,$page['title']);?>',compact(<?=$compact?>'<?php echo $fai->nama_function($page,$page['title']);?>'));
		}  
       
    }

    public function tambah()
    {
       <?php 
		$compact = '';
		$array = $array_temp;
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type))  and in_array("select",explode('-',$type))){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    $page['select_database_costum'][$field] = Database::converting_primary_key($page, $page['select_database_costum'][$field],"utama");
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);<?php
			
				$compact .= '"'.$field.'",';
			 }	}			
		}		
		
		
		if(isset($page['crud']['sub_kategori'])) {
                	
                	for($h=0;$h<count($page['crud']['sub_kategori']);$h++){
						$sub_kategori = $page['crud']['sub_kategori'][$h];
						
						$database_utama = $sub_kategori[1];
						
						$array_sub_kat=$array= $page['crud']['array_sub_kategori'][$h];
						//$array_sub_kat = Database::converting_array_field($page,$array_sub_kat);
						for($i=0;$i<count($array_sub_kat);$i++){//perubahan $array->array_sub_kat
							$text = $array_sub_kat[$i][0];
							$field = $array_sub_kat[$i][1];
							$type = $array_sub_kat[$i][2];
							if(isset($array_sub_kat[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							     $page['select_database_costum'][$field] = Database::converting_primary_key($page, $page['select_database_costum'][$field],"utama");
			    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= '"'.$field.'",';
							 }	}			
						} 
						
				}		
			}	
			if (isset($page['crud']['total']['content'][0])) {
			for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {	
			if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
			if(isset($page['crud']['total']['content'][$k]["with_input"])){
				if ($page['crud']['total']['content'][$k]["with_input"]) {
					$array = ($page['crud']['total']['content'][$k]["array"]);
					//$array = Database::converting_array_field($page,$array);
					for ($i = 0; $i < count($array); $i++) {
						$type = $array[$i][2];
						$return = $fai->typearray($page, $array, $i);
						$type = $return['type'];
						$visible = $return['visible'];
						$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php 
							
								$compact .= '"'.$field.'",';
							 }	
						}			
						 
						// echo ''.$page['view'];
			
					}
				}
			}			
			}			
			}			
			}			
			$array = $array_temp;
		if($compact){
			
			$compact=substr($compact,0,strlen($compact)-1);
		}
		?>
       
       return view('<?php echo $fai->nama_function($page,$page['title']);?>.add_<?php echo $fai->nama_function($page,$page['title']);?>'<?=$compact?',compact('.$compact.')':''?>);
    }

    public function save($request){
        DB::beginTransaction();
        try{
            $idUser=Auth::user()->id;
            $help = new Helper_function();
            <?php 
            $array = $array_temp;
			$sqlfile = array();
            for ($i = 0; $i < count($array); $i++) {
            	
            	 $text = $array[$i][0];
            $field = $array[$i][1];
            $typearray = $array[$i][2];
            $extypearray = explode('-',$typearray);
			if ($typearray == 'file') {
				?>
				if ($request->file('<?=$field?>')) {
				
					$file = $request->file('<?=$field?>')[0];
					$destination="uploads/";
					$path='<?=$page['title']?>-'.date('YmdHis').$file->getClientOriginalName();
					$file->move($destination,$path);
					
					$data['<?=$field?>'] = $path;
				}
				<?php 

			}else 
			if ($typearray == 'select-appr'){
				$field_name= $field.'_id';
            ?>$data['<?=$field_name?>'] = $request->get('<?=$field_name;?>');
			<?php }
            else if(in_array('number',$extypearray)){
	               ?>$data['<?=$field;?>'] = $help->hapusRupiah($request->get('<?=$field;?>'));
			<?php	}
            else if (!in_array($typearray, array('text-relation', 'select-relation', 'select-nosave'))){	?> $data['<?=$field;?>'] = $request->get('<?=$field;?>');
            <?php }
            }?>
            $data["<?=(isset($page['load']['database']['create_date'])?$page['load']['database']['create_date']:"create_date")?>"]=date('Y-m-d H:i:s');
			$data["<?=(isset($page['load']['database']['create_by'])?$page['load']['database']['create_by']:"create_by")?>"]=$idUser;
			<?php
			if (isset($page['crud']['total']['content'][0])) {
				//echo $page['database_provider'];
								
				for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {
					if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi' or $page['crud']['total']['content'][$k]["type"] == 'input_no_result') {
						if(isset($page['crud']['total']['content'][$k]["add_button_multi"])){
							if ($page['crud']['total']['content'][$k]["add_button_multi"]) {
								
								if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi'){
									if(isset($page['crud']['total']['content'][$k]["with_input"])){
										if ($page['crud']['total']['content'][$k]["with_input"]) {
											$array = ($page['crud']['total']['content'][$k]["array"]);
											//$array = Database::converting_array_field($page,$array);
											
											for ($i = 0; $i < count($array); $i++) {
												$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['sqli'][$page['crud']['total']['content'][$k]["id"]."_".$array[$i][1]] = 
												($page['crud']['total']['content'][$k]["id"]."_".$array[$i][1]);
												$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = array("", $page['crud']['total']['content'][$k]["id"]."_".$array[$i][1], "number");
											}
										}
									
								
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['sqli']["total_".$page['crud']['total']['content'][$k]["id"]] = ("total_total_".$page['crud']['total']['content'][$k]["id"]);
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['sqli']["select_type_".$page['crud']['total']['content'][$k]["id"]] = ("select_type_".$page['crud']['total']['content'][$k]["id"]);
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['sqli'][$page['crud']['total']['content'][$k]["id"]] = "total_".($page['crud']['total']['content'][$k]["id"].'');
								
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = array("", "total_".$page['crud']['total']['content'][$k]["id"], "number");
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = array("", "select_type_".$page['crud']['total']['content'][$k]["id"], "number");
								$sqli_to_database[$page['crud']['total']['content'][$k]["id"]]['array'][] = array("", "".$page['crud']['total']['content'][$k]["id"], "number");
							}
							}
						}
						}else{
							if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi'){
								if(isset($page['crud']['total']['content'][$k]["with_input"])){
									if ($page['crud']['total']['content'][$k]["with_input"]) {
										$array = ($page['crud']['total']['content'][$k]["array"]);
										for ($i = 0; $i < count($array); $i++) {
										?>
										$data["<?=$page['crud']['total']['content'][$k]["id"]."_".$array[$i][1];?>"] = 
										$request-><?=($page['crud']['total']['content'][$k]["id"]."_".$array[$i][1])?>;
										<?php }
									}
								}
							}
							?>$data["total_<?=$page['crud']['total']['content'][$k]["id"]?>"] = $request-><?=("total_total_".$page['crud']['total']['content'][$k]["id"])?>;
							$data["select_type_<?=$page['crud']['total']['content'][$k]["id"]?>"] = $request-><?=("select_type_".$page['crud']['total']['content'][$k]["id"])?>;
							$data["<?=$page['crud']['total']['content'][$k]["id"]?>"] = $request-><?=($page['crud']['total']['content'][$k]["id"].'_input')?>;
						<?php }
						
					}else{
						?>	
						$data["<?=$page['crud']['total']['content'][$k]["id"]?>"] = $request-><?=("total_".$page['crud']['total']['content'][$k]["id"].'')?>;
						<?php 
					}
				}
			}
			?>
			
            $last_value=DB::connection()->select("select max(<?=$page['database']['primary_key'];?>) as max from <?=$page['database']['utama'];?>");
			$data["<?=$page['database']['primary_key'];?>"]=$last_value[0]->max+1;
            DB::connection()->table("<?=$page['database']['utama'];?>")
                ->insert($data);
                
            <?php 
			if(isset($sqli_to_database)){
			if(count($sqli_to_database)){
				foreach($sqli_to_database as $database_total => $value_total){
					
					$xx =0;
					foreach($sqli_to_database[$database_total]['sqli'] as $sqli_database_total => $sqli_value_total){
						
						if($xx==0){
							?>
							foreach($request-><?=$sqli_value_total?> as $x => $xx){
							
							$total = array();
							$total["<?=Database::converting_primary_key($page,$page['database']['utama'],'primary_key')?>"] = $data["<?=$page['database']['primary_key'];?>"];
							<?php 
							$xx++;
						}
						?>
						$total['<?=$sqli_database_total?>'] =   $request-><?=$sqli_to_database[$database_total]['sqli'][$sqli_database_total]?>[$x];

						<?php

					}?>
						 DB::connection()->table("<?=$page['database']['utama']."_".$database_total;?>")
                			->insert($total);
						}
					<?php
					
				}
			}
			}

            if(isset($page['crud']['sub_kategori'])) {
                	
                	for($h=0;$h<count($page['crud']['sub_kategori']);$h++){
						$sub_kategori = $page['crud']['sub_kategori'][$h];
						
						$database_utama = $sub_kategori[1];
						
						$array= $page['crud']['array_sub_kategori'][$h];
						//$array = Database::converting_array_field($page,$array);
						$x=0;
						
							?>
						foreach($request->get('<?=$database_utama.'_'.$array[0][1]?>') as $x => $xx){
							$sqli_sub_kategori = array();
							 

							$sqli_sub_kategori["<?=Database::converting_primary_key($page,$page['database']['utama'],'primary_key')?>"] = $data["<?=$page['database']['primary_key'];?>"];
							<?php 
							if(isset($page['crud']['insert_default_value_sub_kategori'])){
								foreach($page['crud']['insert_default_value_sub_kategori'][$database_utama] as $key => $value){
			?>
			$sqli_sub_kategori['<?=$key?>']=<?=$value?>;
			<?php
								}
							}
					        for ($i = 0; $i < count($array); $i++) {
					            $text = $array[$i][0];
					            $field_name = $database_utama.'_'.$array[$i][1];
					            $field = $array[$i][1];
					            $typearray = $array[$i][2];
					            $extypearray = explode('-',$typearray);
					             if(in_array('number',$extypearray)){
            							
						                	?>
					
					$sqli_sub_kategori['<?=$field;?>'] =  $help->hapusRupiah($request->get('<?=$field_name;?>')[$x]);
						                	<?php
										
								}else if (!in_array($typearray, array('text-relation', 'select-relation'))){
							 			
					        ?>
					
					$sqli_sub_kategori['<?=$field;?>'] = $request->get('<?=$field_name;?>')[$x];
									<?php
											            	
					            }
					        }
					        
					        if(isset($page['crud']['insert_default_value_sub_kategori_request'])){
								foreach($page['crud']['insert_default_value_sub_kategori_request'][$database_utama] as $key => $value){
									$var = $database_utama.'_'.$value;
									?>
				
					$sqli_sub_kategori['<?=$key?>']= $request->get('<?=$var;?>')[$x];
									<?php
									
								}
							}
							 
							if(isset($page['crud']['crud_function_sub_kategori'][$database_utama])){
								foreach($page['crud']['crud_function_sub_kategori'][$database_utama] as $key => $value){
									if($value=='hash'){
										
					?>
					$sqli_sub_kategori['<?=$key?>'']=Hash::make($request->get('<?=$key;?>')[$x]);
					
					<?php 
									}else if($value=='hapusrupiah'){
								$var = $database_utama.'_'.$value;		
											?>
					$sqli_sub_kategori['<?=$key?>']=$this->hapusRupiah($request->get('<?=$var;?>')[$x]);
					
					<?php
									}
									
							}
							}?>
							$sqli_sub_kategori["<?=(isset($page['load']['database']['create_date'])?$page['load']['database']['create_date']:"create_date")?>"]=date('Y-m-d H:i:s');
							$sqli_sub_kategori["<?=(isset($page['load']['database']['create_by'])?$page['load']['database']['create_by']:"create_by")?>"]=$idUser;	
							DB::connection()->table("<?=$database_utama?>")
                					->insert($sqli_sub_kategori);
								
                }
                <?php
							}
							}?>    
               
                
            DB::commit();
            return redirect()->route('<?=$page['route']?>',['list','-1'])->with('success','<?=$page['title']?> Berhasil di input!');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }

    }

    public function edit($request,$id)
    {
    	<?php  
		$array = $array_temp;
    	$database_utama = isset($page['database']['utama'])?$page['database']['utama']:'';
		$primary_key = isset($page['database']['primary_key'])?$page['database']['primary_key']:'';
    		$page['database']['where']=$temp_where ;
    		//$page['database']['where'][] = array("$database_utama.active",'=',"1");
    		$page['database']['where'][] = array("$database_utama.$primary_key",'=','$id');
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
    	?>
    	$sql="<?=$query?>";
        
        
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
        $<?php echo $fai->nama_function($page,$page['title']);?> = count($<?php echo $fai->nama_function($page,$page['title']);?>)?$<?php echo $fai->nama_function($page,$page['title']);?>[0]:array();
        <?php 
		$compact = '';
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type))  and in_array("select",explode('-',$type)) ){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>
		
		
		$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);
		
		<?php
			
				$compact .= ',"'.$field.'"';
			 }	
			}			
		}
		
		
        
        if (isset($page['crud']['sub_kategori'])) {
        	$page['section_vte'] = 'sub_kategori';
        	for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            	$sub_kategori = $page['crud']['sub_kategori'][$h];
               
                	
                        $database_sub = $sub_kategori[1];
                	
						$where=isset($page['database_sub_kategori'][$database_sub]['where'])?$page['database_sub_kategori'][$database_sub]['where']:array();;
                	
                	
                    	$where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page,$page['database']['utama'],'primary_key'), '=', '$id');
                        $where[] = array($sub_kategori[1].".active", '=', 1);
                        
                        $page['crud']['database_sub_kategori'][$database_sub]['utama'] =$sub_kategori[1];;
						$page['crud']['database_sub_kategori'][$database_sub]['primary_key'] =$sub_kategori[2];;
						$page['crud']['database_sub_kategori'][$database_sub]['where'] =$where;;
						$array = $page['crud']['array_sub_kategori'][$h];  
						//$array = Database::converting_array_field($page,$array);
						for($i=0;$i<count($array);$i++){
							$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= ',"'.$field.'"';
							 }	}			
						} 
						$row = $fai->database_coverter($page,$page['crud']['database_sub_kategori'][$database_sub],$array,'source');
						$query = $row;
		?>
		
		
		$sql="<?=$query?>";
        $<?=$sub_kategori[1]?>=DB::connection()->select($sql);
        
		<?php		
					
				$compact .= ',"'.$sub_kategori[1].'"';
			}		
		}
		if (isset($page['crud']['total']['content'][0])) {
			for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {	
			if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
			if(isset($page['crud']['total']['content'][$k]["with_input"])){
				if ($page['crud']['total']['content'][$k]["with_input"]) {
					$array = ($page['crud']['total']['content'][$k]["array"]);
					//$array = Database::converting_array_field($page,$array);
					for ($i = 0; $i < count($array); $i++) {
						$type = $array[$i][2];
						$return = $fai->typearray($page, $array, $i);
						$type = $return['type'];
						$visible = $return['visible'];
						$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php 
							
								$compact .= ',"'.$field.'"';
							 }	
						}			
						 
						// echo ''.$page['view'];
			
					}
				}
			}			
			}			
			}			
			}	
		
		?>
        
        return view('<?php echo $fai->nama_function($page,$page['title']);?>.edit_<?php echo $fai->nama_function($page,$page['title']);?>', compact('id','<?php echo $fai->nama_function($page,$page['title']);?>'<?= $compact?>));
    }
	public function view($request,$id)
    {
    	<?php  
		$array = $array_temp;
    	$database_utama = isset($page['database']['utama'])?$page['database']['utama']:'';
		$primary_key = isset($page['database']['primary_key'])?$page['database']['primary_key']:'';
    		$page['database']['where'][] = array("$database_utama.active",'=',"1");
    		$page['database']['where'][] = array("$database_utama.$primary_key",'=','$id');
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
    	?>
    	$sql="<?=$query?>";
        
        
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
        $<?php echo $fai->nama_function($page,$page['title']);?> = count($<?php echo $fai->nama_function($page,$page['title']);?>)?$<?php echo $fai->nama_function($page,$page['title']);?>[0]:array();
        <?php 
		$compact = '';
		  $array = $array_temp;
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type))   and in_array("select",explode('-',$type)) ){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>
		
		
		$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);<?php
			
				$compact .= ',"'.$field.'"';
			 }	
			}			
		}
		
		
        
        if (isset($page['crud']['sub_kategori'])) {
        	$page['section_vte'] = 'sub_kategori';
        	for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            	$sub_kategori = $page['crud']['sub_kategori'][$h];
               
                	
                        $database_sub = $sub_kategori[1];
                	
						$where=isset($page['database_sub_kategori'][$database_sub]['where'])?$page['database_sub_kategori'][$database_sub]['where']:array();;
                	
                	
                    	$where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page,$page['database']['utama'],'primary_key'), '=', '$id');
                        $where[] = array($sub_kategori[1].".active", '=', 1);
                        
                        $page['crud']['database_sub_kategori'][$database_sub]['utama'] =$sub_kategori[1];;
						$page['crud']['database_sub_kategori'][$database_sub]['primary_key'] =$sub_kategori[2];;
						$page['crud']['database_sub_kategori'][$database_sub]['where'] =$where;;
						$array = $page['crud']['array_sub_kategori'][$h];  
						//$array = Database::converting_array_field($page,$array);
						for($i=0;$i<count($array);$i++){
							$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= ',"'.$field.'"';
							 }	}			
						} 
						$row = $fai->database_coverter($page,$page['crud']['database_sub_kategori'][$database_sub],$array,'source');
						$query = $row;
		?>
		
		
		$sql="<?=$query?>";
        $<?=$sub_kategori[1]?>=DB::connection()->select($sql);
        <?php		
					
				$compact .= ',"'.$sub_kategori[1].'"';
			}		
		}
		if (isset($page['crud']['total']['content'][0])) {
			for ($k = 0; $k < count($page['crud']['total']['content']); $k++) {	
			if ($page['crud']['total']['content'][$k]["type"] == 'input_no_result_multi') {
			if(isset($page['crud']['total']['content'][$k]["with_input"])){
				if ($page['crud']['total']['content'][$k]["with_input"]) {
					$array = ($page['crud']['total']['content'][$k]["array"]);
					//$array = Database::converting_array_field($page,$array);
					for ($i = 0; $i < count($array); $i++) {
						$type = $array[$i][2];
						$return = $fai->typearray($page, $array, $i);
						$type = $return['type'];
						$visible = $return['visible'];
						$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php 
							
								$compact .= ',"'.$field.'"';
							 }	
						}			
						 
						// echo ''.$page['view'];
			
					}
				}
			}			
			}			
			}			
			}	
		
		/*
		if($compact){
			$compact=substr($compact,0,strlen($compact)-1);
		}*/
		?>
        
        return view('<?php echo $fai->nama_function($page,$page['title']);?>.view_<?php echo $fai->nama_function($page,$page['title']);?>', compact('id','<?php echo $fai->nama_function($page,$page['title']);?>'<?= $compact?>));
    }

    public function update($request, $id){
        DB::beginTransaction();
        try{
			$help =new Helper_function();
            $idUser=Auth::user()->id;
            <?php 
            $array = $array_temp;
            for ($i = 0; $i < count($array); $i++) {
            	
	            $text = $array[$i][0];
	            $field = $array[$i][1];
	            $typearray = $array[$i][2];
	            $extypearray = explode('-',$typearray);
			if ($typearray == 'select-appr'){
				$field_name= $field.'_id';
            ?>$data['<?=$field_name?>'] = $request->get('<?=$field_name;?>');
            <?php }
            else if(in_array('number',$extypearray)){
			?>$data['<?=$field;?>'] = $help->hapusRupiah($request->get('<?=$field;?>'));
			<?php	}
            else if (!in_array($typearray, array('text-relation', 'select-relation', 'select-nosave'))){	
            ?>$data['<?=$field;?>'] = $request->get('<?=$field;?>');
            <?php }
            }?>$data["<?=(isset($page['load']['database']['update_date'])?$page['load']['database']['update_date']:"update_date")?>"]=date('Y-m-d H:i:s');
			$data["<?=(isset($page['load']['database']['update_by'])?$page['load']['database']['update_by']:"update_by")?>"]=$idUser;
			
            DB::connection()->table("<?=$page['database']['utama'];?>")
                ->where("<?=$page['database']['primary_key'];?>",$id)
                ->update($data);
                
                
                
                 <?php 
            if(isset($page['crud']['sub_kategori'])) {
                	
                	for($h=0;$h<count($page['crud']['sub_kategori']);$h++){
                		
                		
						$sub_kategori = $page['crud']['sub_kategori'][$h];
						
						$database_utama = $sub_kategori[1];
						
						$array= $page['crud']['array_sub_kategori'][$h];
						//$array = Database::converting_array_field($page,$array);
						$x=0;
						
							?>
							
					DB::connection()->table("<?=$database_utama?>")
                ->where("<?=Database::converting_primary_key($page,$page['database']['utama'],'primary_key')?>",$id)
                ->update(["active"=>0,"<?=(isset($page['load']['database']['delete_by'])?$page['load']['database']['delete_by']:"delete_by")?>"=>$idUser,"<?=(isset($page['load']['database']['delete_date'])?$page['load']['database']['delete_date']:"delete_date")?>" => date("Y-m-d H:i:s")]);
						for($x=0;$x<$request->get('no_sub_kategori');$x++){
							$sqli_sub_kategori = array();
							
							$sqli_sub_kategori["<?=Database::converting_primary_key($page,$page['database']['utama'],'primary_key')?>"] = $data["<?=$page['database']['primary_key'];?>"];
							<?php 
							if(isset($page['crud']['insert_default_value_sub_kategori'])){
								foreach($page['crud']['insert_default_value_sub_kategori'][$database_utama] as $key => $value){
			?>
			$sqli_sub_kategori['<?=$key?>']=<?=$value?>;
			<?php
								}
							}
					        for ($i = 0; $i < count($array); $i++) {
					            $text = $array[$i][0];
					            $field_name = $database_utama.'_'.$array[$i][1];
					            $field = $array[$i][1];
					            $typearray = $array[$i][2];
					            $extypearray = explode('-',$typearray);
					             if(in_array('number',$extypearray)){
            							
						                	?>
					
					$sqli_sub_kategori['<?=$field;?>'] =  $help->hapusRupiah($request->get('<?=$field_name;?>')[$x]);
						                	<?php
										
								}else if (!in_array($typearray, array('text-relation', 'select-relation'))){
							 			
					        ?>
					
					$sqli_sub_kategori['<?=$field;?>'] = $request->get('<?=$field_name;?>')[$x];
									<?php
											            	
					            }
					        }
					        
					        if(isset($page['crud']['insert_default_value_sub_kategori_request'])){
								foreach($page['crud']['insert_default_value_sub_kategori_request'][$database_utama] as $key => $value){
									$var = $database_utama.'_'.$value;
									?>
				
					$sqli_sub_kategori['<?=$key?>']= $request->get('<?=$var;?>')[$x];
									<?php
									
								}
							}
							 
							if(isset($page['crud']['crud_function_sub_kategori'][$database_utama])){
								foreach($page['crud']['crud_function_sub_kategori'][$database_utama] as $key => $value){
									if($value=='hash'){
										
					?>
					$sqli_sub_kategori['<?=$key?>'']=Hash::make($request->get('<?=$key;?>')[$x]);
					
					<?php 
									}else if($value=='hapusrupiah'){
								$var = $database_utama.'_'.$value;		
											?>
					$sqli_sub_kategori['<?=$key?>']=$this->hapusRupiah($request->get('<?=$var;?>')[$x]);
					
					<?php
									}
									
							}
							}?>
							 $sqli_sub_kategori["<?=(isset($page['load']['database']['create_date'])?$page['load']['database']['create_date']:"create_date")?>"]=date('Y-m-d H:i:s');
								$sqli_sub_kategori["<?=(isset($page['load']['database']['create_by'])?$page['load']['database']['create_by']:"create_by")?>"]=$idUser;	
								 DB::connection()->table("<?=$database_utama?>")
                					->insert($sqli_sub_kategori);
								
                }
                <?php
							}
							}?>    
              
            DB::commit();
            return redirect()->route('<?=$page['route']?>',['list','-1'])->with('success','<?=$page['title']?> Berhasil di Ubah!');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
    public function hapus($request,$id)
    {
        DB::beginTransaction();
        try{
            $idUser=Auth::user()->id;
            DB::connection()->table("<?=$page['database']['utama'];?>")
                ->where("<?=$page['database']['primary_key'];?>",$id)
                ->update([
                	"active"=>0, 
                	"<?=(isset($page['load']['database']['delete_by'])?$page['load']['database']['delete_by']:"delete_by")?>"=>$idUser,
                    "<?=(isset($page['load']['database']['delete_date'])?$page['load']['database']['delete_date']:"delete_date")?>" => date("Y-m-d H:i:s")
                ]
                );
            DB::commit();
            return redirect()->route('<?=$page['route']?>',['list','-1'])->with('success','<?=$page['title']?> Berhasil di Hapus!');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
    public function pdf($<?php echo $fai->nama_function($page,$page['title']);?>)
    {
		
		    

		$pdf = PDF::loadView('<?php echo $fai->nama_function($page,$page['title']);?>.pdf_<?php echo $fai->nama_function($page,$page['title']);?>', compact('<?php echo $fai->nama_function($page,$page['title']);?>'))->setPaper('a4', 'landscape');
           
        return $pdf->download('<?php echo $fai->nama_function($page,$page['title']);?> - All.pdf');
	}
	public function PDFPage($request,$id)
    {
		
		<?php  
		$array = $array_temp;
    	$database_utama = isset($page['database']['utama'])?$page['database']['utama']:'';
		$primary_key = isset($page['database']['primary_key'])?$page['database']['primary_key']:'';
    		$page['database']['where'][] = array("$database_utama.active",'=',"1");
    		$page['database']['where'][] = array("$database_utama.$primary_key",'=','$id');
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
    	?>
    	$sql="<?=$query?>";
        
        
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
        $data = count($<?php echo $fai->nama_function($page,$page['title']);?>)?$<?php echo $fai->nama_function($page,$page['title']);?>[0]:array();
        <?php 
		$compact = '';
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>
		
		
		$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);<?php
			
				$compact .= ',"'.$field.'"';
			 }	
			}			
		}
		
		
        
        if (isset($page['crud']['sub_kategori'])) {
        	$page['section_vte'] = 'sub_kategori';
        	for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            	$sub_kategori = $page['crud']['sub_kategori'][$h];
               
                	
                        $database_sub = $sub_kategori[1];
                	
						$where=isset($page['database_sub_kategori'][$database_sub]['where'])?$page['database_sub_kategori'][$database_sub]['where']:array();;
                	
                	
                    	$where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page,$page['database']['utama'],'primary_key'), '=', '$id');
                        $where[] = array($sub_kategori[1].".active", '=', 1);
                        
                        $page['crud']['database_sub_kategori'][$database_sub]['utama'] =$sub_kategori[1];;
						$page['crud']['database_sub_kategori'][$database_sub]['primary_key'] =$sub_kategori[2];;
						$page['crud']['database_sub_kategori'][$database_sub]['where'] =$where;;
						$array = $page['crud']['array_sub_kategori'][$h];  
						//$array = Database::converting_array_field($page,$array);
						for($i=0;$i<count($array);$i++){
							$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= ',"'.$field.'"';
							 }	}			
						} 
						$row = $fai->database_coverter($page,$page['crud']['database_sub_kategori'][$database_sub],$array,'source');
						$query = $row;
		?>
		
		
		$sql="<?=$query?>";
        $<?=$sub_kategori[1]?>=DB::connection()->select($sql);
        <?php		
					
				$compact .= ',"'.$sub_kategori[1].'"';
			}		
		}
		?>



		$pdf = PDF::loadView('<?php echo $fai->nama_function($page,$page['title']);?>.PDFPage_<?php echo $fai->nama_function($page,$page['title']);?>', compact('id','data'<?= $compact?>))->setPaper('<?=$page['layout_pdf'][0];?>', '<?=$page['layout_pdf'][1];?>');
           
        return $pdf->download('<?=$page['title']?> - Page.pdf');
	}
	<?php $page=$pagetemp;?>
    public function excel($request,$row){
			<?php $type = 'excel';
			$type_page = $type;
			$array = $array_temp;
			?>
			
            $spreadsheet = new Spreadsheet;
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();
            <?php if(!($type == 'export_existing' or $type=="export_empty")){ ?>
            	
            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            <?php }

            for ($i = 0; $i < count($array); $i++) {
                 $text = $array[$i][0];
                 $field = $array[$i][1];
               	 $type = $array[$i][2];
                if($type=="password"){
				
				}else{ ?>
					$sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
                	$sheet->setCellValue($help->toAlpha($y) . '1', '<?=$text?>');
				<?php }?>
                $y++;
				
           <?php  }?>


            $rows = 1;
			<?php 
            if ($type_page!="export_empty") {?>
			if(!empty($row)){
                $no = 0;
                foreach ($row as $data) {
                    $rows++;

                    
                    $no++;
                    $y = 0;
                   <?php  if($type_page != 'export_existing'){?>
	                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
	                    $y++;
					<?php }
                    for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {
								if (isset($array[$i][3][3]))
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0] . '_' . $array[$i][3][3];
								else
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
						?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							
							<?php 							
							$option = $array[$i][3];
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
		$formula = "";
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value_select?>).','; } 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih Salah Satu');
							              
                            $y++;
                       <?php  } else if ($type == "select-multiple-string") {?>
                            $multiple = DB::select("select array_agg(" <?= $array[$i][3][0] . "." . $array[$i][3][2] ?> ") as value from " <?= $array[$i][3][0] ?> " where " <?= $array[$i][3][1] . " in(" ?> $data-><?=$field ?> ")");
                            $sheet->setCellValue($help->toAlpha($y) . $rows, str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value));
                            $y++;
                        <?php } else if ($type == "select-manual") {
                            $field_database = $array[$i][3];?>
                            if (isset($field_database[$data-><?=$field?>])) {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                /*$field_database[$data-><?=$field?>]*/
                               
                            } else {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, '');
                               
                            }
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							<?php $option = $array[$i][3];
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; } 
							 ?>
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Must select one from the drop down options.');
							                $y++;
                            
                        <?php } 
                        else if ($type == "select-appr") {
						    $field_database = $array[$i][3];
						    $field = 'system_status_appr';
						    ?>

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                $y++;
                            
						<?php  }
						else if ($type == "text-alias") {
                            $field_database = $array[$i][3];?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $y++;
                      <?php   } 
                        else {?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                            $y++;
                      <?php   }
                    }
            ?> }
            }
            <?php }
			else if($type_page=="export_empty"){
			
				for($j=0;$j<=0;$j++){?>
					 $y = 0;
					 $rows++;
					 <?php for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {

                                $field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
							?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            <?php 
							$option = $array[$i][3];
							$formula = "";
							
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value?>).','; } 
							
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							              
                            $y++;
                        <?php }  else if ($type == "select-manual") {
                            $field_database = $array[$i][3];
                            
?>
							$sheet->setCellValue($help->toAlpha($y) . $rows, '');
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            <?=
							$option = $array[$i][3];
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; }?> 
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							                $y++;
                            
                        <?php 
                        } else { ?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $y++;
                        <?php }
                    }
				}
					
			}?>

            $type = 'xlsx';
            $fileName = "<?= $page['title']?> ." . $type;
            if ($type == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
            } else if ($type == 'xls') {
                $writer = new Xls($spreadsheet);
            }
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        
	
	}
	<?php if(isset($page['import_export'])){?>
	<?php $page=$pagetemp;?>
    public function export_existing($request,$row){
			<?php $type = 'export_existing';
			$type_page = $type;
			$array = $array_temp;
			?>
			
            $spreadsheet = new Spreadsheet;
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();
            <?php if(!($type == 'export_existing' or $type=="export_empty")){ ?>
            	
            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            <?php }

            for ($i = 0; $i < count($array); $i++) {
                 $text = $array[$i][0];
                 $field = $array[$i][1];
               	 $type = $array[$i][2];
                if($type=="password"){
				
				}else{ ?>
					$sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
                	$sheet->setCellValue($help->toAlpha($y) . '1', '<?=$text?>');
				<?php }?>
                $y++;
				
           <?php  }?>


            $rows = 1;
			<?php 
            if ($type_page!="export_empty") {?>
			if(!empty($row)){
                $no = 0;
                foreach ($row as $data) {
                    $rows++;

                    
                    $no++;
                    $y = 0;
                   <?php  if($type_page != 'export_existing'){?>
	                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
	                    $y++;
					<?php }
                    for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {
								if (isset($array[$i][3][3]))
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0] . '_' . $array[$i][3][3];
								else
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
						?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							
							<?php 							
							$option = $array[$i][3];
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
		
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value_select?>).','; } 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih Salah Satu');
							              
                            $y++;
                       <?php  } else if ($type == "select-multiple-string") {?>
                            $multiple = DB::select("select array_agg(" <?= $array[$i][3][0] . "." . $array[$i][3][2] ?> ") as value from " <?= $array[$i][3][0] ?> " where " <?= $array[$i][3][1] . " in(" ?> $data-><?=$field ?> ")");
                            $sheet->setCellValue($help->toAlpha($y) . $rows, str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value));
                            $y++;
                        <?php } else if ($type == "select-manual") {
                            $field_database = $array[$i][3];?>
                            if (isset($field_database[$data-><?=$field?>])) {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                /*$field_database[$data-><?=$field?>]*/
                               
                            } else {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, '');
                               
                            }
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							<?php $option = $array[$i][3];
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; } 
							 ?>
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Must select one from the drop down options.');
							                $y++;
                            
                        <?php } 
                        else if ($type == "select-appr") {
						    $field_database = $array[$i][3];
						    $field = 'system_status_appr';
						    ?>

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                $y++;
                            
						<?php  }
						else if ($type == "text-alias") {
                            $field_database = $array[$i][3];?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $y++;
                      <?php   } 
                        else {?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                            $y++;
                      <?php   }
                    }
            ?> }
            }
            <?php }
			else if($type_page=="export_empty"){
			
				for($j=0;$j<=50;$j++){?>
					 $y = 0;
					 $rows++;
					 <?php for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {

                                $field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
							?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            <?php 
							$option = $array[$i][3];
							$formula = "";
							
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value?>).','; } 
							
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							              
                            $y++;
                        <?php }  else if ($type == "select-manual") {
                            $field_database = $array[$i][3];
                            
?>
							$sheet->setCellValue($help->toAlpha($y) . $rows, '');
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            <?=
							$option = $array[$i][3];
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; }?> 
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							                $y++;
                            
                        <?php 
                        } else { ?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $y++;
                        <?php }
                    }
				}
					
			}?>

            $type = 'xlsx';
            $fileName = "<?= $page['title']?> ." . $type;
            if ($type == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
            } else if ($type == 'xls') {
                $writer = new Xls($spreadsheet);
            }
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        
	
	}
	
	<?php $page=$pagetemp;?>
    public function export_empty($request,$row){
			<?php $type = 'export_empty';
			$type_page = $type;
			$array = $array_temp;
			?>
			$help = new Helper_function();
            $spreadsheet = new Spreadsheet;
            $sheet = $spreadsheet->getActiveSheet();
            $y = 0;
            $help = new Helper_function();
            <?php if(!($type == 'export_existing' or $type=="export_empty")){ ?>
            	
            $sheet->setCellValue($help->toAlpha($y) . '1', 'No');
            $y++;
            <?php }

            for ($i = 0; $i < count($array); $i++) {
                 $text = $array[$i][0];
                 $field = $array[$i][1];
               	 $type = $array[$i][2];
                if($type=="password"){
				
				}else{ ?>
					$sheet->getColumnDimension($help->toAlpha($y))->setAutoSize(true);
                	$sheet->setCellValue($help->toAlpha($y) . '1', '<?=$text.($type=='select'?"(".ucwords(str_replace("_"," ",$array[$i][3][2])).")":"")?>');
				<?php }?>
                $y++;
				
           <?php  }?>


            $rows = 1;
			<?php 
            if ($type_page!="export_empty") {?>
			if(!empty($row)){
                $no = 0;
                foreach ($row as $data) {
                    $rows++;

                    
                    $no++;
                    $y = 0;
                   <?php  if($type_page != 'export_existing'){?>
	                    $sheet->setCellValue($help->toAlpha($y) . $rows, $no);
	                    $y++;
					<?php }
                    for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {
								if (isset($array[$i][3][3]))
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0] . '_' . $array[$i][3][3];
								else
									$field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
						?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							
							<?php 							
							$option = $array[$i][3];
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
		$formula = "";
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value_select?>).','; } 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih Salah Satu');
							              
                            $y++;
                       <?php  } else if ($type == "select-multiple-string") {?>
                            $multiple = DB::select("select array_agg(" <?= $array[$i][3][0] . "." . $array[$i][3][2] ?> ") as value from " <?= $array[$i][3][0] ?> " where " <?= $array[$i][3][1] . " in(" ?> $data-><?=$field ?> ")");
                            $sheet->setCellValue($help->toAlpha($y) . $rows, str_ireplace(array("{", "}", '"'), array("", "", ''), $multiple[0]->value));
                            $y++;
                        <?php } else if ($type == "select-manual") {
                            $field_database = $array[$i][3];?>
                            if (isset($field_database[$data-><?=$field?>])) {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                /*$field_database[$data-><?=$field?>]*/
                               
                            } else {

                                $sheet->setCellValue($help->toAlpha($y) . $rows, '');
                               
                            }
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
							$formula = "";
							<?php $option = $array[$i][3];
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; } 
							 ?>
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(false);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Must select one from the drop down options.');
							                $y++;
                            
                        <?php } 
                        else if ($type == "select-appr") {
						    $field_database = $array[$i][3];
						    $field = 'system_status_appr';
						    ?>

                                $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                                $y++;
                            
						<?php  }
						else if ($type == "text-alias") {
                            $field_database = $array[$i][3];?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field_database?>);
                            $y++;
                      <?php   } 
                        else {?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, $data-><?=$field?>);
                            $y++;
                      <?php   }
                    }
            ?> }
            }
            <?php }
			else if($type_page=="export_empty"){
			
				?>
				
				for($j=0;$j<=0;$j++){
					 $y = 0;
					 $rows++;
					 <?php for ($i = 0; $i < count($array); $i++) {
                        $text = $array[$i][0];
                        $field = $array[$i][1];
                        $type = $array[$i][2];
                        if($type=="password"){
						}else if ($type == "select") {
                            $field_database = $array[$i][4];
                            if (!$field_database) {

                                $field_database = $array[$i][3][2] . '_' . $array[$i][3][0];
                            }
							?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            <?php 
							$option = $array[$i][3];
							$formula = "";
							
							$option_select = $array[$i][3];
						    $database_select = $option[0];
						    $key_select = $option[1];
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							
				$query = $rowoption;
		?>
		
		
		$sql="<?=$query?>";
		$rowoption=DB::connection()->select($sql);
		$formula = "";
							foreach ($rowoption as $dataoption) { $formula.=($dataoption-><?=$value_select?>).','; } 
							
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							              
                            $y++;
                        <?php }  else if ($type == "select-manual") {
                            $field_database = $array[$i][3];
                            
?>
							$sheet->setCellValue($help->toAlpha($y) . $rows, '');
                            
                            $validation = $sheet->getCell($help->toAlpha($y) . $rows)->getDataValidation();
                            
							<?php $option = $array[$i][3];
							foreach($option as $key=>$value){
								echo '$option["'.$key.'"] = "'.$value.'";' ;
							}
							?>
							$formula = "";
							foreach ($option as $key => $value) { $formula.=$value.','; }
							$formula = "<?=$formula;?>";
							 
							$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
							$validation->setFormula1('"'.$formula.'"');
							$validation->setAllowBlank(true);

							$validation->setShowDropDown(true);

							$validation->setShowInputMessage(true);

							$validation->setPromptTitle('Note');

							$validation->setPrompt('Pilih salah satu');
							                $y++;
                            
                        <?php 
                        } else { ?>
                            $sheet->setCellValue($help->toAlpha($y) . $rows, "");
                            $y++;
                        <?php }
                    }
				}
					
			?>
				}
            $type = 'xlsx';
            $fileName = "<?= $page['title']?> ." . $type;
            if ($type == 'xlsx') {
                $writer = new Xlsx($spreadsheet);
            } else if ($type == 'xls') {
                $writer = new Xls($spreadsheet);
            }
            $writer->save("export/" . $fileName);
            header("Content-Type: application/vnd.ms-excel");
            return redirect(url('/') . "/export/" . $fileName);
        
	
	}
	<?php $page=$pagetemp;?>
	public function import_excel($request,$id)
    {
    	$help = new Helper_function();
		$idUser=Auth::user()->id;
    	<?php 
    	$where = array();
    	 $array = $array_temp;
	?>
    		$file = $request->file('excel');
		    $tujuan_upload = 'export';

	        $name = 'import-excel-'.'<?=$page['title'];?>'.date('YmdHis').'-'. $file->getClientOriginalName();
	        $file->move($tujuan_upload, $name);
	       
	        $uploadFilePath = $tujuan_upload.'/'. $name;
	        $inputFileType = ucfirst(pathinfo($uploadFilePath, PATHINFO_EXTENSION));;
			//    $inputFileType = 'Xlsx';
			//    $inputFileType = 'Xml';
			//    $inputFileType = 'Ods';
			//    $inputFileType = 'Slk';
			//    $inputFileType = 'Gnumeric';
			//    $inputFileType = 'Csv';

			/**  Create a new Reader of the type defined in $inputFileType  **/
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
			/**  Load $inputFileName to a Spreadsheet Object  **/
			$spreadsheet = $reader->load($uploadFilePath);
			//die;
			
			$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
			for($j=2;$j<=count($sheetData);$j++){
				<?php for ($i = 0; $i < count($array); $i++) {
					$field = $array[$i][1];?>
					if(!empty($sheetData[$j][$help->toAlpha(<?=$i?>)])){
					<?php 
					if( $array[$i][2]=='select-manual'){
						$option = $array[$i][3];
						?>
						$sqli['<?=$field?>'] =  array_search($sheetData[$j][$help->toAlpha(<?=$i?>)],$option);
					<?php }elseif( $array[$i][2]=='select'){
						$option = $array[$i][3];
							$option_select = $array[$i][3];
						   
						    $database_select = $option[0];
						    $key_select = $option[1];
						    $page['select_database_costum'][$field]['utama'] = $database_select;
						    $page['select_database_costum'][$field]['primary_key'] = $key_select;
						    
						    $value_select = $option[2];
							$rowoption = $fai->database_coverter($page,$page['select_database_costum'][$field], array(),'source');
							$query = $rowoption;
							?>
		
    	
    	
        $sql="<?=$query?>";
        $select_<?=$field;?>=DB::connection()->select($sql);
							
							foreach ($select_<?=$field;?> as $dataoption) { 
								$option_data[$dataoption->primary_key] = $dataoption-><?=$value_select?>;	
							} 
						if(array_search($sheetData[$j][$help->toAlpha(<?=$i?>)],$option_data))
						$sqli['<?=$field?>'] =  array_search($sheetData[$j][$help->toAlpha(<?=$i?>)],$option_data);
						else{
							//buat
						}
						
				<?php	}else{?>
						
						$sqli['<?=$field?>'] = $sheetData[$j][$help->toAlpha(<?=$i;?>)];
					<?php }?>}
					<?php 
					}
				
				?>
			
				$sqli["<?=(isset($page['load']['database']['create_date'])?$page['load']['database']['create_date']:"create_date")?>"]=date('Y-m-d H:i:s');
				$sqli["<?=(isset($page['load']['database']['create_by'])?$page['load']['database']['create_by']:"create_by")?>"]=$idUser;
				<?php 
				if(isset($page['crud']['insert_default_value'])){
					foreach($page['crud']['insert_default_value'] as $key => $value){
						?>$sqli[<?=$key?>]=$value;
						<?php
					}
				}
				
				
				?>
				DB::connection()->table("<?=$database_utama?>")
                			->insert($sqli);
                				
				
			}
	}
	<?php 
	}
	if($field_appr){?>
		
	<?php $page=$pagetemp;?>
	public function appr($request,$id)
    {
    		
    	<?php 
		$select = array();
    	$where = array();
    	 $array = $array_temp;
		$field_appr =  '';
          $page['database'] = $temp_database ;
    	$search = isset($page['crud']['search'])?$page['crud']['search']:array();
    	$database_utama = $page['database']['utama'];
		$primary_key = $page['database']['primary_key'];
		$page['database']['where'] = isset($page['database']['where'])?$page['database']['where']:array();
		$temp_where = $page['database']['where'];
		$where[] =array("1", "=", '1');
		for ($i = 0; $i < count($array); $i++) {
            $text = $array[$i][0];
            $field = $array[$i][1];
            $typearray = $array[$i][2];
            $extypearray = explode('-',$typearray);
			
            if($typearray=='select-appr'){
            	
				$field_appr =  $field;
				$select[] = $database_utama . "." . $field_appr."_status as system_status_appr";
				if( $type=='appr' and !isset($page['crud']['appr_no_select'])){
					
            		$where[] = array($database_utama . "." . $field_appr."_id",'=',$idUser);
            		
				}
            	
           
        	}
        }
    	foreach ($search as $key => $value) {
            if ($key == -1) {
            	echo '
            	$search_active = "1=1";
            	if($request->get("search-active"))
            		$search_active = "  '.$database_utama.'.active=".$request->get("search-active");
            	
            	';
               $where[] = array(" ", " ", '$search_active');
            }else if ($key == -2) {
				$field_appr =  $field;
            	echo '
            	$status_appr = "1=1";
            	if($request->get("status-appr"))
            		$status_appr = "  '.$database_utama.'.'.$field_appr.'=".$request->get("status-appr");
            	
            	';
               $where[] = array(" ", " ", ('$status_appr'));
            } else {
                $i = $key;
               
                if($array[$i][2]=='date'){
                	$row = $array[$i][1];
                	echo '
		            	$'.$row.'_dari = "1=1";
		            	if($request->get("'.$row.'_dari"))
		            		$'.$row.'_dari = "  '.$row.'>=".$request->get("'.$row.'_dari");
		            	
		            ';
                	echo '
		            	$'.$row.'_sampai = "1=1";
		            	if($request->get("'.$row.'_sampai"))
		            		$'.$row.'_sampai = "  '.$row.'<=".$request->get("'.$row.'_sampai");
		            	
		            ';
                	$dari = $row.'_dari';
                	$where[] = array(" ", "", '$'.$dari.'');
	                $where[] = array(" ", "", '$'.$row.'_sampai');
                }else{
                	 $row = $array[$i][1];
                	echo '
		            	$'.$row.' = "1=1";
		            	if($request->get("'.$row.'"))
		            		$'.$row.' = "  '.$row.'<=".$request->get("'.$row.'");
		            	
		            ';
	               
	                $where[] = array(" ", " ", '$'.$row);
                }
            }
        }
		$page['database']['select'] = array_merge($page['database']['select'], $select);
		$page['database']['where'] =   array_merge($page['database']['where'], $where);
    		$ci = &get_instance();
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
			
    	?> 
    	
    	
        $sql="<?=$query?>";
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
		<?php 
		$compact = '';
		if(isset($page['crud']['no_edit'])){
			echo '$no_edit = true;';
			$compact = '"no_edit",';	
		}else
		if(isset($page['crud']['no_delete'])){
			echo '$no_delete = true;';
			$compact = '"$no_delete",';	
		}else
		if(isset($page['crud']['no_add'])){
			echo '$no_add = true;';
			$compact = '"$no_add",';	
		}?>
       	if($request->Cari =='pdf'){
			return $this->pdf();
		}else if($request->Cari =='excel'){
			return $this->excel($request,$<?php echo $fai->nama_function($page,$page['title']);?>);
		}else{
		
        	return view('<?php echo $fai->nama_function($page,$page['title']);?>.appr_<?php echo $fai->nama_function($page,$page['title']);?>',compact(<?=$compact?>'<?php echo $fai->nama_function($page,$page['title']);?>'));
		}  
    
    }
	public function view_appr($request,$id)
    {
	<?php $page=$pagetemp;?>
    	<?php  
    	$where = array();
		$array = $array_temp;
    	$database_utama = isset($page['database']['utama'])?$page['database']['utama']:'';
		$primary_key = isset($page['database']['primary_key'])?$page['database']['primary_key']:'';
    		$page['database']['where'][] = array("$database_utama.active",'=',"1");
    		$page['database']['where'][] = array("$database_utama.$primary_key",'=','$id');
    		$row = $fai->database_coverter($page,$page['database'],$array,'source');
    		$query = $row;
    	?>
    	$sql="<?=$query?>";
        
        
        $<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
        $<?php echo $fai->nama_function($page,$page['title']);?> = count($<?php echo $fai->nama_function($page,$page['title']);?>)?$<?php echo $fai->nama_function($page,$page['title']);?>[0]:array();
        <?php 
		$compact = '';
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>
		
		
		$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);<?php
			
				$compact .= ',"'.$field.'"';
			 }	
			}			
		}
		
		
        
        if (isset($page['crud']['sub_kategori'])) {
        	$page['section_vte'] = 'sub_kategori';
        	for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            	$sub_kategori = $page['crud']['sub_kategori'][$h];
               
                	
                        $database_sub = $sub_kategori[1];
                	
						$where=isset($page['database_sub_kategori'][$database_sub]['where'])?$page['database_sub_kategori'][$database_sub]['where']:array();;
                	
                	
                    	$where[] = array($sub_kategori[1] . "." . Database::converting_primary_key($page,$page['database']['utama'],'primary_key'), '=', '$id');
                        $where[] = array($sub_kategori[1].".active", '=', 1);
                        
                        $page['crud']['database_sub_kategori'][$database_sub]['utama'] =$sub_kategori[1];;
						$page['crud']['database_sub_kategori'][$database_sub]['primary_key'] =$sub_kategori[2];;
						$page['crud']['database_sub_kategori'][$database_sub]['where'] =$where;;
						 $array = $page['crud']['array_sub_kategori'][$h];  
						//$array = Database::converting_array_field($page,$array);
						for($i=0;$i<count($array);$i++){
							$text = $array[$i][0];
							$field = $array[$i][1];
							$type = $array[$i][2];
							if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= ',"'.$field.'"';
							 }	}			
						} 
						$row = $fai->database_coverter($page,$page['crud']['database_sub_kategori'][$database_sub],$array,'source');
						$query = $row;
		?>
		
		
		$sql="<?=$query?>";
        $<?=$sub_kategori[1]?>=DB::connection()->select($sql);
        <?php		
					
				$compact .= ',"'.$sub_kategori[1].'"';
			}		
		}
		
		/*
		if($compact){
			$compact=substr($compact,0,strlen($compact)-1);
		}*/
		?>
        
        return view('<?php echo $fai->nama_function($page,$page['title']);?>.view_appr_<?php echo $fai->nama_function($page,$page['title']);?>', compact('id','<?php echo $fai->nama_function($page,$page['title']);?>'<?= $compact?>));
    }
	public function setujui_appr($request,$id)
    {
		
        DB::beginTransaction();
           
            try {
                 $idUser=Auth::user()->id;
                
				$update= ["<?=$all_field_appr?>_status" => 1,"<?=$all_field_appr?>_date"=>date('Y-m-d H:i:s'),"<?=$all_field_appr?>_by"=>$idUser];
				DB::connection()->table("<?=$database_utama?>")
	                ->where("<?=$primary_key?>",$id)
	                ->update($update );
				
					<?php 
					
						if(isset($page['crud']['onappr'])){
							for($a=0;$a<count($page['crud']['onappr']);$a++){
								$array = $array_temp;
								$database_utama = isset($page['database']['utama'])?$page['database']['utama']:'';
								$primary_key = isset($page['database']['primary_key'])?$page['database']['primary_key']:'';
									$page['database']['where']=$temp_where ;
									//$page['database']['where'][] = array("$database_utama.active",'=',"1");
									$page['database']['where'][] = array("$database_utama.$primary_key",'=','$id');
									$row = $fai->database_coverter($page,$page['database'],$array,'source');
									$query = $row;
								?>
								$sql="<?=$query?>";
								$<?php echo $fai->nama_function($page,$page['title']);?>=DB::connection()->select($sql);
								if(count($<?php echo $fai->nama_function($page,$page['title']);?>)){
									$onappr =array();
									$row=$<?php echo $fai->nama_function($page,$page['title']);?>;
									<?php for($b=0;$b<count($page['crud']['onappr'][$a]['field']);$b++){?>
									$onappr['<?=$page['crud']['onappr'][$a]['field'][$b][1]?>']=$row-><?=$page['crud']['onappr'][$a]['field'][$b][0]?>;
									<?php }?>
									DB::insert('<?=$page['crud']['onappr'][$a]['tabel_target']?>',$onappr);
									}

								<?
							}
						}
					?>
					DB::commit();
				
                
				
               
                return redirect()->route('<?=$page['route']?>',['list','-1'])->with('success','<?=$page['title']?> Berhasil di disetujui!');
            } catch (\Exeception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e);
            }
        
        
        }
    public function decline_appr(Request $request,$id)
    {
       
          
        DB::beginTransaction();
            try {
				  $idUser=Auth::user()->id;
                
				$update= ["<?=$all_field_appr?>_status" => 2,"<?=$all_field_appr?>_date"=>date('Y-m-d H:i:s'),"<?=$all_field_appr?>_by"=>$idUser];
				
				DB::connection()->table("<?=$database_utama?>")
	                ->where("<?=$primary_key?>",$id)
	                ->update($update );
				DB::commit();
				
                
				
               
                return redirect()->route('<?=$page['route']?>',['list','-1'])->with('success','<?=$page['title']?> Berhasil di Tolak!');
                
				
            } catch (\Exeception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e);
            }
        
        
        }
    <?php }?>
	<?php $page=$pagetemp;?>
	<?php 
		 if (isset($page['crud']['sub_kategori'])) {
        	$page['section_vte'] = 'sub_kategori';
        	for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
        		$sub_kategori = $page['crud']['sub_kategori'][$h];
               
                	
                        $database_sub = $sub_kategori[1];
	?>
    public function ajax_sub_kategori_<?=$database_sub?>(Request $request,$id)
    {
    	$no = $request->get('no');
    	<?php 
		$array = $array_temp;
		$compact = '';
		for($i=0;$i<count($array);$i++){
			$text = $array[$i][0];
			$field = $array[$i][1];
			$type = $array[$i][2];
			if(isset($array[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
				
			
				$option = $array[$i][3];
				if(isset($option[0])){
			    $database = $option[0];
			    $key = $option[1];
			    $page['select_database_costum'][$field]['utama'] =  $database;
			    $page['select_database_costum'][$field]['primary_key'] =  $key;
			    
			    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
				$query = $row;
		?>$sql="<?=$query?>";
		$<?=$field?>=DB::connection()->select($sql);<?php
			
				$compact .= '"'.$field.'",';
			 }	}			
		}		
		
		
		if(isset($page['crud']['sub_kategori'])) {
                	
                	for($x=0;$x<count($page['crud']['sub_kategori']);$x++){
						$sub_kategori = $page['crud']['sub_kategori'][$x];
						
						$database_utama = $sub_kategori[1];
						
						$array_sub_kat=$array= $page['crud']['array_sub_kategori'][$x];
						//$array_sub_kat = Database::converting_array_field($page,$array_sub_kat);
						for($i=0;$i<count($array_sub_kat);$i++){
							$text = $array_sub_kat[$i][0];
							$field = $array_sub_kat[$i][1];
							$type = $array_sub_kat[$i][2];
							if(isset($array_sub_kat[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
								
							
								$option = $array_sub_kat[$i][3];
								if(isset($option[0])){
							    $database = $option[0];
							    $key = $option[1];
							    $page['select_database_costum'][$field]['utama'] =  $database;
							    $page['select_database_costum'][$field]['primary_key'] =  $key;
							    $page['crud']['qoute_view_source_none']=true;
							    $row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
								$query = $row;
						?>$sql="<?=$query?>";
						$<?=$field?>=DB::connection()->select($sql);<?php
							
								$compact .= '"'.$field.'",';
							 }	}			
						} 
						
				}		
			}		
					
		if($compact){
			
			$compact=substr($compact,0,strlen($compact)-1);
		}
		?>
		
		echo '
    	<?php 
    		
			$no = '<?=$no?>';
			$page['crud']['type'] = 'ajax';
			$page['crud']['view'] = 'ajax';
			$page['crud']['input_inline'] = '';
			$page['crud']['prefix_name'] = $page['crud']['sub_kategori'][$h][1] . '_';
			$page['crud']['sufix_name'] = '[]';
			$page['crud']['row'] = (object) ['object' => 'foreach_1_row'];
			if($page['crud']['sub_kategori'][$h][3]=='table'){
				$page['crud']['startdiv']="";
				$page['crud']['enddiv']="";
			}
			echo $fai->view('crud/sub_kategori_'.$page['crud']['sub_kategori'][$h][3].'.blade.php',$page,array('h'=>$h,'no'=>$no));
			unset($page['crud']['startdiv']);
			unset($page['crud']['enddiv']);
		?>
    	';
    }
	<?php }?>
	<?php }
	
	$page=$pagetemp;
	if (isset($page['crud']['field_value_automatic'])) {
    	foreach ($page['crud']['field_value_automatic'] as $key => $value) { ?>
		 
	
	public function field_value_automatic_<?=$key?>(Request $request,$id)
    {
    	$no = $request->get('no');
    	$value = $request->get('value');
    	
    	<?php 
    		$page['crud']['field_value_automatic'][$key]['database']['where'][] = array($page['crud']['field_value_automatic'][$key]['request_where'],"=",'$value');
			$row = $fai->database_coverter($page,$page['crud']['field_value_automatic'][$key]['database'], array(),'source');
			$query = $row;
			?>
			
			$sql="<?=$query?>";
			$<?=$key?>=DB::connection()->select($sql);
			echo json_encode($<?=$key?>[0]);
			
		
    }
	<?php }
	}
	
	$page=$pagetemp;
	if (isset($page['crud']['field_value_automatic_sub_kategori'])) {
    	foreach ($page['crud']['field_value_automatic_sub_kategori'] as $key => $value) { ?>
		 
	
	public function field_value_automatic_sub_kategori_<?=$key?>(Request $request)
    {
    	$no = $request->get('no');
    	$value = $request->get('value');
    	
    	<?php 
    		$page['crud']['field_value_automatic_sub_kategori'][$key]['database']['where'][] = array($page['crud']['field_value_automatic_sub_kategori'][$key]['request_where'],"=",'$value');
			$row = $fai->database_coverter($page,$page['crud']['field_value_automatic_sub_kategori'][$key]['database'], array(),'source');
			$query = $row;
			?>
			
			$sql="<?=$query?>";
			$<?=$key?>=DB::connection()->select($sql);
			echo json_encode($<?=$key?>[0]);
			
		
    }
	<?php }
	}
	?>
	
	<?php $page=$pagetemp;?>
	<?php 
	if (isset($page['crud']['field_view_sub_kategori'])) {
    	foreach ($page['crud']['field_view_sub_kategori'] as $key => $value) { 
    		$h =$page['crud']['field_view_sub_kategori'][$key]['target_no'];
    		?>
		 
	
	public function field_view_sub_kategori_<?=$key?>(Request $request,$id)
    {
    	$no = $request->get('_no');
    	$field_auto_change = $request->get('field_auto_change');
    	$value = $request->get('value');
    	
    	<?php 
    	
    	
    		$no = '<?=$no;?>';
			$field_auto_change = $fai->input('field_auto_change');
			$value = $fai->input('value');
				//	print_r($page['crud']['field_view_sub_kategori'][$key]);
			$page['crud']['field_view_sub_kategori'][$key]['database']['where'][] = 
					array($page['crud']['field_view_sub_kategori'][$key]['request_where'],"=",'$value');
					
					
			$row = $fai->database_coverter($page,$page['crud']['field_view_sub_kategori'][$key]['database'], $array_sub_kat ,'source');
			$query = $row;
			?>
			
			$sql="<?=$query?>";
			$<?=$key?>=DB::connection()->select($sql);
			foreach($<?=$key?> as $data)
			{
				?>
				<?php 
				
				
				if(isset($page['crud']['field_view_sub_kategori'][$key]['insert_default_value_sub_kategori_request'])){
					$page['crud']['insert_default_value_sub_kategori_request'] = 
						$page['crud']['field_view_sub_kategori'][$key]['insert_default_value_sub_kategori_request'];
				}
				$array = array();
				$field = $page['crud']['field_view_sub_kategori'][$key]['field'];
				for($i=0;$i<count($field);$i++){
							if($field[$i][0]==-1){
								$array[] = $field[$i][2];
							}
						}
				//$row = $fai->database_coverter($page,$page['crud']['field_view_sub_kategori'][$key]['database']);
				
				$page['crud']['row'] = (object) ['object' => 'foreach_1_row'];
				$page['crud']['prefix_name'] = $page['crud']['sub_kategori'][$h][1] . '_';
				$page['crud']['sufix_name'] = '[]';
				$page['crud']['view'] = 'tambah';
				$page['crud']['type'] = $type;
				$page['crud']['section_vte'] = 'sub_kategori';
				$page['crud']['input_inline'] = '';
				if($page['crud']['sub_kategori'][$h][3]=='table'){
					$page['crud']['startdiv']="";
					$page['crud']['enddiv']="";
				}
				echo $fai->view('crud/field_view_sub_kategori_'.$page['crud']['sub_kategori'][$h][3].'.blade.php',$page,array('h'=>$h,'no'=>$no,'field'=>$field));
				unset($page['crud']['startdiv']);
				unset($page['crud']['enddiv']);
				echo '<?php ';
				?>	
		
			}
		
    }
	<?php }
	}?>
	
	
	<?php $page=$pagetemp;?>
	<?php 
	if (isset($page['crud']['search_load_sub_kategori'])) {
    	foreach ($page['crud']['search_load_sub_kategori'] as $key => $value) { 
    		
    		?>
		 
	
		 
	
	public function search_load_<?=$key?>(Request $request,$id)
    {
    	$search = $request->get('primary_key');
    	$sub_kategori_id = $request->get('sub_kategori_id');
    	$primary_key = $request->get('primary_key');
    	$method = $request->get('method');
		$no =$request->get('no');
    	
    	<?php 
			$search = Partial::input('primary_key');
			$page['crud']['view']="tambah";
			$page['crud']['input_inline']="";
			$page['crud']['type']="tambah";
			$page['crud']['startdiv']="";
			$page['crud']['enddiv']="";
			$page['crud']['type']=='view_viewsource';
			$page['crud']['prefix_name'] = $page['crud']['sub_kategori'][$page['crud']['search_load_sub_kategori'][$key]['target_no_sub_kategori']][1] . '_';
			$page['crud']['sufix_name'] = '[]';

			$sub_kategori_id = Partial::input('sub_kategori_id');
			echo '$where="";
			if($method=="pilih"){
				$where .= "'.($page['crud']['search_load_sub_kategori'][$key]['database']['utama'].".".$page['crud']['search_load_sub_kategori'][$key]['database']['primary_key']." = ".'$search'."").'";
			}else{
				$where .= "'.($page['crud']['search_load_sub_kategori'][$key]['database']['where_raw'] = $page['crud']['search_load_sub_kategori'][$key]['search']." = '".'$search'."'").'";
			}
			';
			
			
			
				//	print_r($page['crud']['field_view_sub_kategori'][$key]);
				$page['crud']['search_load_sub_kategori'][$key]['database']['where_raw'] = '$where';
					
					
			$row = $fai->database_coverter($page,$page['crud']['search_load_sub_kategori'][$key]['database'], array() ,'source');
			$query = $row;
			
			?>
			
			$sql="<?=$query?>";
			$<?=$key?>=DB::connection()->select($sql);
			<?php 
			$array_sub_kat = $page['crud']['array_sub_kategori'][$page['crud']['search_load_sub_kategori'][$key]['target_no_sub_kategori']];
											//$array_sub_kat = Database::converting_array_field($page,$array_sub_kat);
			for($i=0;$i<count($array_sub_kat);$i++){
				$text = $array_sub_kat[$i][0];
				$field = $array_sub_kat[$i][1];
				$type = $array_sub_kat[$i][2];
				if(isset($array_sub_kat[$i][3]) and !in_array("manual",explode('-',$type)) and in_array("select",explode('-',$type)) ){
					
				
					$option = $array_sub_kat[$i][3];
					if(isset($option[0])){
						$database = $option[0];
					
						$page['select_database_costum'][$field]['utama'] =  $database;
						$page['select_database_costum'][$field]['primary_key'] =  $option[1];
						$page['crud']['qoute_view_source_none']=true;
						$row = $fai->database_coverter($page,$page['select_database_costum'][$field],null,'source');
						$query = $row;
			?>

			$sql="<?=$query?>";
			$<?=$field?>=DB::connection()->select($sql);<?php
				
					$compact .= '"'.$field.'",';
				}	
			}			
			} 
			?>
			echo '<tr id="table-subkateogri-tr-'. $no.'">';
			foreach($<?=$key?> as $data){
			echo '<td>'.$no.'<input class="no-'.$sub_kategori_id.'" type="hidden" value="'. $no .'" name="no_sub_kategori"> </td>';
			
			<?php
			echo '?>'; 
			$array = $page['crud']['array_sub_kategori'][$page['crud']['search_load_sub_kategori'][$key]['target_no_sub_kategori']];
			foreach($page['crud']['search_load_sub_kategori'][$key]['array_result'] as $key_result => $value_result){

				if($value_result['type']=='database'){
					$row_value = $value_result["row"];
					$page['crud']['insert_value'][$key_result] = '<?=$data->'.$row_value.';?>';
				}else if($value_result['type']=='text'){
					$row_value = $value_result["text"];
					$page['crud']['insert_value'][$key_result] = $row_value;
				}
				$array_result[] = $key_result;
			}
			for ($i = 0; $i < count($array); $i++) {
				$page['page_row'] = 'sub_kategori';
				if (in_array($page['crud']['view'], array('view')))
					$page['crud']['input_inline'] = 'disabled';
				$type = $array[$i][2];
				$return = Partial::typearray($page, $array, $i);
				$type = $return['type'];
				$page['crud']['numbering'] = '<?=$no;?>';
				$visible = $return['visible'];
				$page['section']=='viewsource';
				$page['crud']['view_source_search_load']=$array_result;
				$page['crud']['type_form_asal'] = $return['type_form_asal'];
				if ($visible) {
					$extypearray = explode('-', $array[$i][2]);
					if($type=='hidden_input'){

					}else 
					if ((in_array('number', $extypearray)) and  (isset($page['PDFPage']))) {
						echo '<td style="padding: 5px;text-align:right">';
					} else {
						echo '<td style="padding: 5px;">';
					}

					echo $fai->view('crud/form.blade.php', $page, array('page' => $page, 'i' => $i, 'no' => $no, 'array' => $array, 'data' => '$data'));
					echo '</td>';
				}
				// echo ''.$page['view'];

			}
			echo '
			<td style="display: flex;">
			<button type="button" onclick="sub_kategori_add(0,'."'"."table"."'".')" class="btn btn-primary btn-sm">
													<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 255);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
												</button>
			<button type="button" onclick="deleteRow(0,'.$no.','."'"."table"."'".')" class="btn btn-primary btn-sm">
			<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
		</button>
		</td>';

		echo '<?php';?>
		echo '<tr>';	
    }
    }
	
	
	public function datatable_<?=$key?>(Request $request,$id)
    {
    	$search = $request->get('search');
    	$sub_kategori_id = $request->get('sub_kategori_id');
    	$primary_key = $request->get('primary_key');
    	$method = $request->get('method');
		$no =$request->get('no');
		$draw =$request->get('draw');
		$start =$request->get('start');
		$rowperpage =$request->get('length');
    	
        $row = $request->get('start');
    	<?php 
			$sub_kategori_id = Partial::input('sub_kategori_id');
			$array = $page['crud']['search_load_sub_kategori'][$key]['search_row'];
			echo '$array = array(';
			for($i=0;$i<count($array);$i++){
				
			echo '"'.$array[$i].'"';
			if($i!=count($array))
			echo ',';
			}
			echo ');';
			?>
			$where="1=1";
			
			if(isset($search['value'])){
			$where="  (";
			<?php
			for($i=0;$i<count($array);$i++){?>
				 $where .="upper(".<?=$array[$i];?>.") like '%".strtoupper($search['value'])."%'";
				 <?php if($i!=count($array)-1){?>
					 $where .='  or  ';
				 <?php }?>
			 	<?php }?>  
			  $where.="  )";
			}
			<?php 
			$key1 = Database::database_coverter($page,$page['crud']['search_load_sub_kategori'][$key]['database'],array(),'source');
			$query = $key1;
			?>
			
			$sql="<?=$query?>";
			$key_all=DB::connection()->select($sql);
			<?php 
			
			$page['crud']['search_load_sub_kategori'][$key]['database']['where_raw'] = '$where';
			$key1 = Database::database_coverter($page,$page['crud']['search_load_sub_kategori'][$key]['database'],array(),'source');
			$query = $key1;
			?>
			
			$sql="<?=$query?>";
			$key_all_with_where=DB::connection()->select($sql);
			<?php 
			$page['crud']['search_load_sub_kategori'][$key]['database']['limit_raw'] = '$rowperpage offset $row';
			$row = Database::database_coverter($page,$page['crud']['search_load_sub_kategori'][$key]['database'],array(),'source');
			$query = $row;
			?>
			
			$sql="<?=$query?>";
			$row=DB::connection()->select($sql);
			$data =[];
			$no=0;
			if(count($row)){
				foreach($row as $value){
					$no++;
					$nestedData['no'] = $no;
					<?php 
					foreach( $page['crud']['search_load_sub_kategori'][$key]['array_detail'] as $key_detail => $value_detail){?>
						$nestedData['<?=$key_detail;?>'] = $value-><?=$key_detail;?> ;
					<?php }?>
					
					$nestedData['aksi'] =  '<button type="button" onclick="pilih_search_load_sub_kategori_<?=$key?>(<?="'."?>$value->primary_key<?=".'"?>)" class="btn btn-success btn-xs">Pilih</button>';
					
						
					$data[] = $nestedData;
				
				}
			}
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => (count($key_all)),
				"iTotalDisplayRecords" => count($key_all_with_where),
				"aaData" => $data
			);
			 echo json_encode($response);
    	}
	
	<?php }
	}
	?>
 


