<?php

$page = $page;
$page['crud']['view'] = "view";
$page['crud']['form_route'] = "view";
$page['crud']['input_inline'] = "disabled";
$page['crud']['appr_page'] = true;
$page['crud']['type'] = 'view_viewsource';
$page['crud']['crud_inline'] = ' disabled ';
$page['id'] = '$id';
$page['section'] = 'viewsource';
echo CrudContent::vte($page, $fai,"","","");