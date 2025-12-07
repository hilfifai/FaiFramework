
<?php 
require_once('Framework/MainFaiFramework.php');

if($main[$i]['content']['subtype'] =='Start'){ ?>
 <div class="table-responsive">
    <table class="table table-striped">
<?php }else if($main[$i]['content']['subtype'] =='End'){ ?>
	</table>
</div>
<?php }else if($main[$i]['content']['subtype'] =='Start Td'){ ?>
<td>
<?php }else if($main[$i]['content']['subtype'] =='Start Tr'){ ?>
<tr>
<?php }else if($main[$i]['content']['subtype'] =='Start Th'){ ?>
<th>
<?php }else if($main[$i]['content']['subtype'] =='Start Tfoot'){ ?>
<tfoot>
<?php }else if($main[$i]['content']['subtype'] =='Start Tbody'){ ?>
<tbody>
<?php }else if($main[$i]['content']['subtype'] =='Start Thead'){ ?>
<thead>
<?php }else if($main[$i]['content']['subtype'] =='Td'){ ?>
<td><?= $main[$i]['content']['info']?></td>
<?php }else if($main[$i]['content']['subtype'] =='Tr'){ ?>
<tr><?= $main[$i]['content']['info']?></tr>
<?php }else if($main[$i]['content']['subtype'] =='Th'){ ?>
<Th><?= $main[$i]['content']['info']?></Th>
<?php }else if($main[$i]['content']['subtype'] =='Tfoot'){ 
MainFaiFramework::Set_tfoot();

if(MainFaiFramework::get_tfoot()==1){
	
	echo "<Tfoot><tr>";
}
?>
	<th scope="col"><?= $main[$i]['content']['info']?></th>
<?php 
if(!MainFaiFramework::Scaning($id_fai_now,'Table','Tfoot',1)){
	//echo MainFaiFramework::get_thead();
	echo '</tr></Tfoot>';
}
?>
<?php }else if($main[$i]['content']['subtype'] =='Tbody'){ ?>

<tbody>
<?php 
$row_table = $this->information->read_database_where_multiple('fai_costum',array('id_fai_content','type','object'),array($data->id_fai_content,'content','tr'));
foreach($row_table as $dt):
?>
	<tr>
		
	</tr>
<?php endforeach;?>
</tbody>

<?php }else if($main[$i]['content']['subtype'] =='Thead'){ 
MainFaiFramework::Set_thead();

if(MainFaiFramework::get_thead()==1){
	
	echo "<thead><tr>";
}
?>
	<th scope="col"><?= $main[$i]['content']['info']?></th>
<?php 
//echo MainFaiFramework::Scaning($id_fai_now,'Table','Thead',1);
if(MainFaiFramework::Scaning($id_fai_now,'Table','Thead',2)==FALSE){
	echo '</tr></thead>';
}
?>



<?php }else if($main[$i]['content']['subtype'] =='End Td'){ ?>
</td>
<?php }else if($main[$i]['content']['subtype'] =='End Th'){ ?>
</th>
<?php }else if($main[$i]['content']['subtype'] =='End Tr'){ ?>
</tr>
<?php }else if($main[$i]['content']['subtype'] =='End Tfoot'){ ?>
</tfoot>
<?php }else if($main[$i]['content']['subtype'] =='End Tbody'){ ?>
</tbody>
<?php }else if($main[$i]['content']['subtype'] =='End Thead'){ ?>
</thead>
<?php }?>