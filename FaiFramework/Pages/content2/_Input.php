<?php
$basic = new MainFaiFramework();
//print_r($row);
//$main[$i]['content']['main'][$ifai]['costum'][$type][$icos]['var5']
//$costum[$type][$icos]['var5']

if(strtolower($main[$i]['content']['mode'])=='fullpackage-1'){
	echo '
	<div class="form-group form-group-default">
		<label>'. $main[$i]['content']['info'].'</label>
	
	
	';
}else if(strtolower($main[$i]['content']['mode'])=='fullpackage-2'){
	echo '<div class="form-group row">
		<label class="col-md-3 col-form-label">'. $main[$i]['content']['info'].'</label>
	<div class="col-md-9 p-md-0 p-xs-2">
	'; 
}else if(strtolower($main[$i]['content']['mode'])=='fullpackage-3'){
	
}
if(!isset($pageType))
{
	$pageType = 'general';

}
//echo $this->uri->segment(4);
$support = explode('-',$main[$i]['content']['support']);
if(isset($support[1]))
{
	$name_data = $support[1];
}
else
{
	$name_data = 'data';
}
if($support[0] == 'type1')
{
	$name = $name_data."[".$main[$i]['content']['open']."]";
}
else
if($support[0] == 'type2')
{
	$name = $main[$i]['content']['open']."[]";
}
else
if($support[0] == 'type3')
{
	$name = $main[$i]['content']['open'];
}
else
if($support[0] == 'type4')
{
	$name = $name_data."[".$main[$i]['content']['open']."][]";
}
else
if($support[0] == 'file')
{
	$name = $main[$i]['content']['open']."[]";
}

$costum_class       = " ";
$costum_id          = "";
$costum_style       = "";
$costum_placeholder = "";
$costum_value       = "";
$costum_text_area_value       = "";
$costum_selected    = "";
$costum_inline      = "";
if($main[$i]['content']['subtype'] != 'Radio' or $main[$i]['content']['subtype'] == 'Checkbox' )
{
	if($main[$i]['content']['style'] == '3')
	{
		$costum_class .= "input-border-bottom ";
		$costum_inline .= "required";
	}
}
$costum_id .= $main[$i]['content']['open'].$i;
if($pageType == 'view_edit')
{
	//$id = 'id_'.$main[$i]['content']_crud['parameter1'];

	$open = $main[$i]['content']['open'];
	$costum_value .= "value='".$row->$open."'";
	$costum_text_area_value .= $row->$open;
	$costum_selected = $row->$open;

}
else
if($pageType == 'view_detail')
{
	//$id = 'id_'.$main[$i]['content']_crud['parameter1'];

	if(isset($costum['detail_value']))
	{
		//print_r($costum['detail_value']);
		$costum_teks = '';
		for($j = 0;$j < count($costum['detail_value']);$j++)
		{
			if($costum['detail_value'][$j]['object'] == 'teks')
			{

				$costum_teks = $costum['detail_value'][$j]['var1'] ;
				$costum_value .= $costum_teks;
			}
		}

		//$costum_value .= $costum_teks;
	}
	else
	{
		$open = $main[$i]['content']['open'];
		if($row->$open) $rowOpen = $row->$open;
		else $rowOpen = '';
		$costum_value .= $rowOpen;
	}
	if($costum_value == '') $costum_value = '-';

}
else

if(isset($costum['Input']))
{
	
	for($b = 0;$b < count($costum['Input']);$b++)
	{
		if(strtolower($costum['Input'][$b]['object']) == "class")
		{
			$costum_class .= $costum['Input'][$b]['var1'].' ';
		}
		else
		if(strtolower($costum['Input'][$b]['object']) == "id")
		{
			$costum_id .= $costum['Input'][$b]['var1'].' ';
		}
		else
		if(strtolower($costum['Input'][$b]['object']) == "style")
		{
			$costum_style .= $costum['Input'][$b]['var1'].' ';
		}
		else
		if(strtolower($costum['Input'][$b]['object']) == "placeholder")
		{
			$costum_placeholder .= $costum['Input'][$b]['var1'].' ';
		}
		else
		if(strtolower($costum['Input'][$b]['object']) == "inline")
		{
			$costum_inline .= $costum['Input'][$b]['var1'].' ';
		}else
		if(strtolower($costum['Input'][$b]['object']) == "value")
		{
			$costum_value .= 'value="'.$costum['Input'][$b]['var1'].'"';
		}
	}
}
if($costum_placeholder == "")
{
	if($main[$i]['content']['style'] != '3')
	{
		$costum_placeholder .= "placeholder='Masukan ".$main[$i]['content']['info']."'";
	}
}
else
{
	$costum_placeholder = "placeholder='".$costum_placeholder."'";
}


?>

<?php
if(strtolower($main[$i]['content']['subtype']) == 'radio' or strtolower($main[$i]['content']['subtype']) == 'checkbox'  )
{
	?>
	<?php
	if(isset($costum['Option']))
	{

		for($b = 0;$b < count($costum['Option']);$b++)
		{
			?>

			<?php
			if($main[$i]['content']['style'] == '1')
			{
				?>
				<div class="<?= $main[$i]['content']['subtype'];?>">
					<label>
						<?php
						if($pageType == 'detail') echo $costum_value;
						else ?><input type="<?= $main[$i]['content']['subtype'];?>"  class="<?= $costum_class;?>" name="<?php echo $name;?>" id="<?= $costum_id  ;?>" value="<?= $costum['Option'][$b]['var1'];?>" <?= $costum_inline ;?>> <?= $costum['Option'][$b]['var2'];?>
					</label>
				</div>

				<?php
			}
			else
			if($main[$i]['content']['style'] == '2')
			{
				?>
				<?php
				if(Radio() == 1)
				{
					echo '<br>';
				}?>
				<label class="form-radio-label">
					<input class="form-radio-input <?= $costum_class;?>" type="<?= $main[$i]['content']['subtype'];?>"  id="<?= $costum_id  ;?>" name="<?php echo $name;?>" value="<?= $costum['Option'][$b]['var1'];?>"  <?= $costum_inline ;?>>
					<span class="form-radio-sign">
						<?= $costum['Option'][$b]['var2'];?>
					</span>
				</label>
				<?php
			}
			else
			if($main[$i]['content']['style'] == '3')
			{
				?>
				<label class="selectgroup-item">
					<input type="radio" name="<?php echo $name;?>" value="<?= $costum['Option'][$b]['var1'];?>" id="<?= $costum_id  ;?>"s class="selectgroup-input <?= $costum_class;?>" <?= $costum_inline ;?>>
					<span class="selectgroup-button">
						<?= $costum['Option'][$b]['var2'];?>
					</span>
				</label>

				<?php
			}
			else
			if($main[$i]['content']['style'] == '4')
			{
				?>
				<label class="selectgroup-item">
					<input type="radio" name="<?php echo $name;?>" value="<?= $costum['Option'][$b]['var1'];?>" id="<?= $costum_id  ;?>" class="selectgroup-input <?= $costum_class;?>" <?= $costum_inline ;?> >
					<span class="selectgroup-button selectgroup-button-icon">
						<i class="<?= $costum['Option'][$b]['var2'];?>">
						</i>
					</span>
				</label>
				<?php
			}
			else
			if($main[$i]['content']['style'] == '5')
			{
				?>
				<?php
				if(Radio() == 1)
				{
					echo '<br>';
				}?>
				<label class="imagecheck mb-4">
					<input name="<?php echo $name;?>"  type="checkbox" value="<?= $costum['Option'][$b]['var1'];?>" class="imagecheck-input <?= $costum_class;?>" id="<?= $costum_id  ;?>" <?= $costum_inline ;?>/>
					<figure class="imagecheck-figure">
						<img src="<?= base_url();?><?= $costum['Option'][$b]['var2'];?>"  class="imagecheck-image">
					</figure>
				</label>
				<?php
			}
			else
			if($main[$i]['content']['style'] == '6')
			{
				?>
				<br>
				<label class="custom-switch">
					<input type="radio"  name="<?php echo $name;?>"  value="<?= $costum['Option'][$b]['var1'];?>" id="<?= $costum_id  ;?>" class="custom-switch-input <?= $costum_class;?>" <?= $costum_inline ;?>>
					<span class="custom-switch-indicator">
					</span>
					<span class="custom-switch-description">
						<?= $costum['Option'][$b]['var2'];?>
					</span>
				</label>
				<?php
			}?>
			<?php
		}?>	<?php
	}?>
	<?php
}
else

if(strtolower($main[$i]['content']['subtype']) == 'select')
{
	?>
	<?php
	if($pageType == 'view_detail')  echo $costum_value;
	else
	{
		//print_R($costum['Option']);
		?>
		<select name="<?php echo $name;?>"  class="form-control select2  <?= $costum_class;?>" id="<?= $costum_id  ;?>" <?= $costum_inline ;?>>
			<option value="">
				<?php
				if($main[$i]['content']['style'] != '3')
				{
					?>- Pilih  <?= $main[$i]['content']['info'];?>-<?php
				}?>
			</option>
			
			<?php
			if(isset($costum['Option']))
			{
				

				for($b = 0;$b < count($costum['Option']);$b++)
				{
					if($costum_selected == $costum['Option'][$b]['var1'])
					{
						$selected = 'selected';
					}
					else
					{
						$selected = '';

					}
					if($costum['Option'][$b]['object'] == 'Content')
					{
						//echo 'tesst';
						if($costum['Option'][$b]['var3'] == 'database')
						{
						$dataselect = $fai_->get_query_option($i,$b);
						//print_r($ci->db->last_query());
						//print_r($dataselect);
						$value = $costum['Option'][$b]['var1'];
						$content = $costum['Option'][$b]['var2'];
						foreach($dataselect as $select){
							if($select->$value==$costum_selected)
								$selected = 'selected';
							else
								$selected = '';
							echo '<option value="'.$select->$value.'" '.$selected.'>'.$select->$content.'</option>';
						}
						}else{
						
						echo '<option value="'.$costum['Option'][$b]['var1'].'" '.$selected.'>'.$costum['Option'][$b]['var2'].'</option>';
							}
					}
					 
					else
					if($costum['Option'][$b]['object'] == 'Opt Group')
					{
						echo '<optgroup label="'.$costum['Option'][$b]['var1'].'">';
					}
					else
					if($costum['Option'][$b]['object'] == 'End Opt Group')
					{
						echo ' </optgroup>';
					}
				}

			}
			?>
		</select>
		<?php
	}?>
	<?php
}
else
if(strtolower($main[$i]['content']['subtype']) == 'textarea')
{
	?>
	<textarea class="form-control <?= $costum_class;?>" id="<?= $costum_id  ;?>" name="<?php echo $name;?>" <?= $costum_placeholder ;?>  <?= $costum_inline ;?>><?= $costum_text_area_value ;?></textarea>
	<?php
}
else if(strtolower($main[$i]['content']['subtype']) == 'texteditor')
{
	?>
	<link rel="stylesheet" href="<?= base_url();?>assets/froala/css/froala_editor.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/froala/css/froala_style.css">
<style >
	.editable
	{
		width: 100%;
		height: 65px;
		border: 1px solid #fff;
		padding: 0px 20px;;
		resize: both;
		overflow: auto;
	}
	.editable:focus
	{
		outline: none;
	}
	
	.btn-clean {
  background: transparent;
  color: #333333;
  -moz-outline: 0;
  outline: none;
  border: 0;
  line-height: 1;
  cursor: pointer;
  text-align: left;
  margin: 0;
  padding: 10px;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  -ms-transition: all 0.5s;
  -o-transition: all 0.5s;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  z-index: 2;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  text-decoration: none;
  user-select: none;
  -o-user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
 
  height: 40px; }

</style>

	<div class="fr-toolbar fr-desktop fr-top fr-basic " style="top: 0px; bottom: auto;width:100%;border: 0">
				<div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-clean"
   onclick="document.execCommand('bold');"
  ><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 5h6a3.5 3.5 0 0 1 0 7h-6z" /><path d="M13 12h1a3.5 3.5 0 0 1 0 7h-7v-7" /></svg></button>
  <button type="button" class="btn btn-clean"
  onclick="document.execCommand('italic');"
  ><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="11" y1="5" x2="17" y2="5" /><line x1="7" y1="19" x2="13" y2="19" /><line x1="14" y1="5" x2="10" y2="19" /></svg></button>
  
  <button type="button" class="btn btn-clean"
  onclick="document.execCommand('underline');"
  ><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 5v5a5 5 0 0 0 10 0v-5" /><path d="M5 19h14" /></svg></button> 
 
</div>
 <button type="button" class="btn btn-clean"
data-bs-toggle="modal" data-bs-target="#modal-uploadfile" onclick=" formReset()"
  ><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg></button>
				
					<div class="fr-btn-grp fr-float-right" style="margin: 0;">
						<button id="emoticons-1" type="button" tabindex="-1" role="button" class="fr-command fr-btn" data-cmd="emoticons" data-popup="true" aria-disabled="false" data-title="Emoticons">
							<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path d="M11.991,3A9,9,0,1,0,21,12,8.99557,8.99557,0,0,0,11.991,3ZM12,19a7,7,0,1,1,7-7A6.99808,6.99808,0,0,1,12,19Zm3.105-5.2h1.503a4.94542,4.94542,0,0,1-9.216,0H8.895a3.57808,3.57808,0,0,0,6.21,0ZM7.5,9.75A1.35,1.35,0,1,1,8.85,11.1,1.35,1.35,0,0,1,7.5,9.75Zm6.3,0a1.35,1.35,0,1,1,1.35,1.35A1.35,1.35,0,0,1,13.8,9.75Z">
								</path>
							</svg>
							<span class="fr-sr-only">
								Emoticons
							</span>
						</button>
						<span class="fr-sr-only">
							Redo
						</span>
						<button id="moreMisc-1" data-group-name="moreMisc-1" type="button" tabindex="-1" role="button" class="fr-command fr-btn" data-cmd="moreMisc" aria-disabled="false" data-title="More Misc">
							<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.5,17c0,0.8-0.7,1.5-1.5,1.5s-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5S13.5,16.2,13.5,17z M13.5,12c0,0.8-0.7,1.5-1.5,1.5 s-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5S13.5,11.2,13.5,12z M13.5,7c0,0.8-0.7,1.5-1.5,1.5S10.5,7.8,10.5,7s0.7-1.5,1.5-1.5 S13.5,6.2,13.5,7z">
								</path>
							</svg>
							<span class="fr-sr-only">
								More Misc
							</span>
						</button>
					</div>
					<div class="fr-newline">
					</div>
					<div class="fr-sticky-dummy " style="height: ">
					</div>
					<span class="row">
						<div class="col-11" style="margin: 0;padding-right:0">
							<div class="editable form-control"   contenteditable="true" >
							</div>
							
						</div>
						
					</span>


				</div>
	<?php
}
else
{
	?>
	<?php
	if($pageType == 'view_detail')  echo $costum_value;
	else
	{
		?><input type="<?= $main[$i]['content']['subtype']?>" name="<?php echo $name;?>" id="<?= $costum_id  ;?>" class="form-control <?= $costum_class;?>"  <?= $costum_placeholder ;?>   <?= $costum_inline ;?>  <?= $costum_value ;?> <?php if($main[$i]['content']['subtype'] == 'Number'){?>onkeypress='return event.charCode >= 48 && event.charCode <= 57'<?php }?>/><?php
	}?>
	<?php
}?>

<?php 

if(strtolower($main[$i]['content']['mode'])=='fullpackage-1'){
	echo '
	</div>
	
	
	';
}else if(strtolower($main[$i]['content']['mode'])=='fullpackage-2'){
	echo '
	</div>
	</div>
	
	
	';
}else if(strtolower($main[$i]['content']['mode'])=='fullpackage-3'){
	
}?>