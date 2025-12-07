<?php if($main[$i]['content']['subtype'] =='Start'){ ?>
<div class="<?= $main[$i]['content']['style'];?>" id="<?= $main[$i]['content']['open']?>">
<?php }elseif($main[$i]['content']['subtype'] =='Row'){ ?>
<?php }elseif($main[$i]['content']['subtype'] =='Content Div'){ ?>
<div class=""><?= $main[$i]['content']['info']?></div>
<?php }else if($main[$i]['content']['subtype'] =='End'){ ?>
</div>
<?php }?>