<?php

			$page['crud']['view'] = 'view';
			$page['crud']['type'] = 'pdf';
?>
<h1 style="text-align: center"><?=$page['title'];?></h1>
 <?php
 echo 
 CrudContent::list_table($page, $fai,"","","");?>