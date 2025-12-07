<?php 
$key = $page['load']['page_section_menu'];

$filename = isset($page['load']['card_template']['filter']['template_file']) ?
    ($page['load']['card_template']['filter']['template_file'] ? $page['load']['card_template']['filter']['template_file'] : '_CardFilter.template')
    : '_CardFilter.template';
    
$template_name = isset($page['load']['card_template']['filter']['template_name']) ?
    $page['load']['card_template']['filter']['template_name'] : 'soft-ui';
    
    $content_template = file_get_contents(__DIR__ . '/../_template/' . $template_name . '/' . $filename . '.php');
    //echo "__DIR__ . '/../_template/' . $template_name . '/' . $filename . '.php'";
    //echo '<textarea>'.$content_template.'</textarea>';
$content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
$array_template = array(
    "TITLE" => 'title_nav',
    "SUBTITLE" => 'subtitle_nav',
    "CARD-NAV" => 'card_nav',
    "ULLI-BUTTON" => 'ulli_button',
    "FILTER" => 'filter_on_filter',
    "SORT-BY" => 'sort_by_on_filter',
    "BUTTON-FILTER" => 'button_filter_on_filter',
    "BUTTON-SEARCH" => 'button_search_on_filter',
);

$CARDCONTENTFUNC = $fai->call_function_class("CARDCONTENTFUNC");
foreach ($array_template as $key => $value) {
    $content_template = str_replace("<$key></$key>", $CARDCONTENTFUNC->$value($page,$card,$template_name,$this_card,$nama_type), $content_template);
}
// echo '<textarea>'.$content_template.'</textarea>';
echo $content_template;
?>
