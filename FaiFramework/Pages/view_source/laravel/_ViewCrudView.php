<?php 
$page['crud']['type'] = 'view_viewsource';
$page['crud']['crud_inline'] = ' disabled ';
$page['id'] = '$id';
$page['section'] = 'viewsource';
$page['app_framework']=$app_framework ;
echo CrudContent::view($page, $fai,"","","");