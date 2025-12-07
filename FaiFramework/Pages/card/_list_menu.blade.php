<?php 

$filename = isset($page['load']['card_template']['list_menu']['template_file']) ?
    ($page['load']['card_template']['list_menu']['template_file'] ? $page['load']['card_template']['list_menu']['template_file'] : '_CardListingMenu.template')
    : '_CardListingMenu.template';
$template_name = isset($page['load']['card_template']['list_menu']['template_name']) ?
    $page['load']['card_template']['list_menu']['template_name'] : 'soft-ui';
$content_template = file_get_contents(__DIR__ . '/../_template/' . $template_name . '/' . $filename . '.php');
//echo '/../_template/'.$template_name.'/'.$filename.'.php';

$content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
$array_template = array(
    "MENU" => 'menu',
    "MENU-SCREENA" => 'menu_screen_a',
    "MENU-SCREENB" => 'menu_screen_b',
);

$CARDCONTENTFUNC = $fai->call_function_class("CARDCONTENTFUNC");
foreach ($array_template as $key => $value) {
    $content_template = str_replace("<$key></$key>", $CARDCONTENTFUNC->$value($page,$card,$template_name), $content_template);
}

echo $content_template;
?>

