<?php if($main[$i]['content']['subtype'] =='H1'){ ?>
<h1><?= $main[$i]['content']['info']?></h1>
<?php }else if($main[$i]['content']['subtype'] =='H2'){ ?>
<h2><?= $main[$i]['content']['info']?></h2>
<?php }else if($main[$i]['content']['subtype'] =='H3'){ ?>
<h3><?= $main[$i]['content']['info']?></h2>
<?php }else if($main[$i]['content']['subtype'] =='H4'){ ?>
<h4><?= $main[$i]['content']['info']?></h4>
<?php }else if($main[$i]['content']['subtype'] =='H5'){ ?>
<h5><?= $main[$i]['content']['info']?></h5>
<?php }else if($main[$i]['content']['subtype'] =='H6'){ ?>
<h6><?= $main[$i]['content']['info']?></h6>
<?php }?>