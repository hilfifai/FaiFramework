<?php
$key = $page['load']['page_section_menu'];

if ($nama_type == 'crud' or $nama_type=='crud-table') {
	$page['section'] = 'card';
	$page_database =  $page['load']['page_database'] ; 
	$page['load']['card']['page_database'] = $page_database;
	$array = Packages::converting_array_field($page, $array, null);
	$_POST['section'] = 'card';
	$_POST['page_database'] = $page_database;
	$_POST['array'] = json_encode($array);
	//print_r($array);
	
    
	if(isset($card[$nama_array]['crud']))
	$page['crud'] = $card[$nama_array]['crud'];
	else{
	    if(isset($card[$nama_array]['type'])){
    	    if(($card[$nama_array]['type'])=='nav'){
    	       if(isset( $card[$nama_array]['cardNav'][$page['load']['nav']]['crud']))
    	            $page['crud'] = $card[$nama_array]['cardNav'][$page['load']['nav']]['crud']; 
    	    }
	    }
	}
	$page['crud']['list_table_view_layout'] =true;  
	$page['crud']['search'] =array();
	$page['crud']['array'] = $array;
	$page['database'] = $page['config']['database'][$page_database];
	$page['title'] = $page['load']['menu'];
	;
	$page['route'] = $page['load']['route_page'];
	$page['id'] = -1;
	$page = Packages::initialize($page);
	$page['crud']['submit_form'] = "card_submit_form";

	echo "<div id='faicontentcrud'>";
	if($nama_type=='crud-table'){
		
	
	    if(isset($page['crud']['list_table_view_layout'])){
	      if(!Partial::input('type_crud')){
	          $page['crud']['view']= 'list';
	          $_POST['type_crud']='list';
	      }
			$page['crud']['view']= Partial::input('type_crud');
			$fai->page($page, Partial::input('type_crud'), $page['load']['id']);
		}else{
		$page['crud']['list_table_view_layout'] =true;  
		$page['crud']['view']= 'list';
		echo $fai->page($page, 'list', $page['load']['id']);
		}
	
	}else 
	$fai->page($page, 'tambah', $page['load']['id']);
    echo '</div>';
	$fai->view('_template/dist/js.php',$page,array("array"=>$array));
} else if ($nama_type == 'card-nav') {
	$page['load']['nav'];
	if ($page['load']['nav'] == -1) {
		$page['load']['nav'] = $card[$card['menu'][$key][2]]['defaultNav'];
	}

	$cardNav = $card[$card['menu'][$key][2]]['cardNav'][$page['load']['nav']];

	if ($cardNav['mode'] == 'card-layout') {
		$array = $cardNav['array'];
		CardFunc::card_layout($page, $fai, $array);
	} else if ($cardNav['mode'] == 'card-listing') {
		$array = $cardNav['array'];

		CardFunc::card_listing($page, $fai, $cardNav, $cardNav['database_refer'], $array,$this_card);
	}
} else if ($nama_type == 'card-layout') {
	echo '<div class="row">';
	CardFunc::card_layout($page, $fai, $array);
	echo '</div>';
} else if ($nama_type == 'card-listing'){
	
	CardFunc::card_listing($page, $fai, $card, $page['load']['page_database'], $array,$this_card);


}

