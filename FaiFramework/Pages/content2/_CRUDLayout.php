<?php 
//print_r($fai); 
if($fai['subtype'] =='StartDesignDetail1'){ ?>
            <!-- Icon Search Block -->
				<?php if($pageType==$fai['info']){			?>
             	<div class="block full">
				 <!-- Table Styles Title -->
				<div class="block-title clearfix">
				
					<h2><span class="hidden-xs"></span> <?= $fai['style']?></h2>
					<?php
					if(isset($costum['CRUD'])){
						
					
					//print_r($costum['CRUD'])	;
					for($i=0;$i<count($costum['CRUD']);$i++){
						if($costum['CRUD'][$i]['object']=='DetailButton'){
							
					?>
					<a href="#" onclick='<?= $costum['CRUD'][$i]['var2']?>' data-toggle="tooltip" title="Edit Data" class="btn  btn-info btn-sm"><i class="fa fa-pencil"></i> <?= $costum['CRUD'][$i]['var1']?></a>
					<?php }?>
					<?php }?>
					<?php }?>
					<?php if($pageType=='view_edit'){?>
						
					<a href="#" onclick='faiAjaxUpdate()' data-toggle="tooltip" title="Edit Data" class="btn  btn-info btn-sm"><i class="fa fa-pencil"></i> Save</a>
					<?php }?>
				</div>
				
					<?php }?>
				
				<?php }else if($fai['subtype'] =='box'){ ?>
				
					<div class="col-sm-4 col-lg-4" style="padding-bottom:15px">
						<div class="widget-content widget-content-mini themed-background-default text-right clearfix">
							<div class="widget-icon pull-left themed-background-light">
								<i class="gi gi-money text-light-op"></i>
							</div> 
							<h2 class="widget-heading h3 text-light"> 
								<strong><span><?= $fai['style']?></span></strong>
								
							</h2>
							<span class="text-muted text-light-op"> <?= $fai['info']?></span>
						</div>
					</div>
				<?php }else if($fai['subtype'] =='TitleDesignDetail1'){ ?>
				<h4 class="sub-header" style="margin-top:5px"><i class="fa fa-user"></i> <?= $fai['info']?>  </h4>
				<?php } ?>