<?php if($main[$i]['content']['subtype'] =='Start'){ ?>
<section > 
<?php }else if($main[$i]['content']['subtype'] =='Header'){ ?>
<section class="content-header" style="margin-top: 50px;"> 
<?php }else if($main[$i]['content']['subtype'] =='End'){ ?>
</section>
<?php }else if($main[$i]['content']['subtype'] =='Title'){ ?>
<div class="section-title mt-0"><?= $main[$i]['content']['info'];?></div>
<?php }else if($main[$i]['content']['subtype'] =='Subtitle'){ ?>
<p class="section-lead"><?= $main[$i]['content']['info'];?></p>
<?php }?>