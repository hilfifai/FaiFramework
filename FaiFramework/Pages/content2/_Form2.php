<?php if($main[$i]['content']['subtype'] =='Start'){ ?>
<form action="<?php echo $main[$i]['content']['info'];?>" method="post" enctype="multipart/form-data">
<?php }else if($main[$i]['content']['subtype'] =='Start Input'){ ?>
<?php if($main[$i]['content']['style'] =='1'){ ?>
	
<div class="input-group">
	<?php }else if($main[$i]['content']['style'] =='2'){ ?>
<div class="input-icon">
<?php }?>
<?php }else if($main[$i]['content']['subtype'] =='End Input'){ ?>
</div>
<?php }else if($main[$i]['content']['subtype'] =='End'){ ?>
</form>
<?php }else if($main[$i]['content']['subtype'] =='End Swiicth'){ ?>
</div>
<?php }else if($main[$i]['content']['subtype'] =='End Select Group'){ ?>
</div>
<?php } else if($main[$i]['content']['subtype'] =='Swiicth'){ ?>
<div class="custom-switches-stacked mt-2">
<?php } else if($main[$i]['content']['subtype'] =='Select Group'){ ?>
 <?php if($main[$i]['content']['style'] =='1'){ ?>
	

  <div class="selectgroup w-100">
	<?php }else if($main[$i]['content']['style'] =='2'){ ?> 
  
  <div class="selectgroup selectgroup-pills">
  <?php }?>
<?php } else if($main[$i]['content']['subtype'] =='Start Group'){ ?>
	
	<?php
	$fai_->forRadio();
	 if($main[$i]['content']['style'] =='1'){ ?>
	<div class="form-group">
	<?php }else if($main[$i]['content']['style'] =='2'){ ?>
	<div class="form-group row">
	<?php }else if($main[$i]['content']['style'] =='3'){ ?>
	  <div class="form-group form-floating-label" >
	<?php }else if($main[$i]['content']['style'] =='4'){ ?>
	 <div class="form-group form-group-default">
	<?php }?>
<?php }else if($main[$i]['content']['subtype'] =='After'){ ?>
	<?php if($main[$i]['content']['style'] =='1'){ ?>
	<div class="input-group-append"><div class="input-group-text"><i class="<?= $main[$i]['content']['info']?>"></i> </div></div>
	<?php }else if($main[$i]['content']['style'] =='2'){ ?>
	<span class="input-icon-addon"><i class="<?= $main[$i]['content']['info']?>"></i></span>
	<?php }?> 	 	
<?php }else if($main[$i]['content']['subtype'] =='Prefed'){ ?>
	<?php if($main[$i]['content']['style'] =='1'){ ?>	
	<div class="input-group-prepend"><div class="input-group-text"><i class="<?= $main[$i]['content']['info']?>"></i></div></div>
	<?php }else if($main[$i]['content']['style'] =='2'){ ?>
	<span class="input-icon-addon"><i class="<?= $main[$i]['content']['info']?>"></i></span>
	<?php }?>
<?php }else if($main[$i]['content']['subtype'] =='End Group'){ ?>
	</div>
	<?php if($main[$i]['content']['style'] =='2'){ ?></div><?php }?>
	<?php }else if($main[$i]['content']['subtype'] =='Label'){ ?>
	<label <?php if($main[$i]['content']['style'] =='2'){ ?>class="col-md-3 col-form-label"<?php }?><?php if($main[$i]['content']['style'] =='3'){ ?>class="placeholder"<?php }?>><?= $main[$i]['content']['info'];?></label>
	<?php if($main[$i]['content']['style'] =='2'){ ?><div class="col-md-9 p-md-0 p-xs-2"><?php }?>
<?php }else if($main[$i]['content']['subtype'] =='Note'){ ?>
	<small class="form-text text-muted <?php if($main[$i]['content']['style'] =='2'){echo 'col-md-12';}?>"><?= $main[$i]['content']['info'];?></small>
<?php }?>