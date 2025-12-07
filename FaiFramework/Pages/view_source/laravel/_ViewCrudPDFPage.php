<?php

?>
<h1 style="text-align: center"><?=$page['title'];?></h1>
 
 <?php
 echo isset($page['subtitle'])?$page['subtitle']:'';
  	$page = $page;
	$page['crud']['view'] = "view_viewsource";
	$page['crud']['type'] = "PDFPage";
	$page['crud']['PDFPage'] = true;
	$page['crud']['form_route'] = "PDFPage";
	$page['crud']['input_inline'] = "disabled";
	$page['crud']['section_vte'] = "form_utama";
	$page['section'] = 'viewsource';
echo CrudContent::vte_main($page, $fai,"","","");
  ?>