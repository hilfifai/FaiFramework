<?php 
$page['crud']['type'] = 'all_viewsource';
$page['id'] = '$id';
$page['section'] = 'viewsource';
$page['app_framework']=$app_framework ;
echo CrudContent::edit($page, $fai,"","","");