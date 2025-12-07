<?php
$visible = false;
$page_database = '';


 $page_database;
$page['load']['card']['page_database'] = $page_database;
$page['load']['card']['nama_type'] = $nama_type;
$page['load']['card']['this_card'] = $this_card;
$page['load']['card']['array'] = $array;

if ($page_database) {
	if (isset($page['row_section'][$page_database]))
		$database = $page['row_section'][$page_database];
	else
		$database = "";
} else
	$database = "";


$key = $page['load']['page_section_menu'];

$filename = isset($page['load']['card_template']['main_profile']['template_file']) ?
	($page['load']['card_template']['main_profile']['template_file'] ? $page['load']['card_template']['main_profile']['template_file'] : '_CardProfileMenu.template')
	: '_CardProfileMenu.template';
$template_name = isset($page['load']['card_template']['main_listing']['template_name']) ?
	$page['load']['card_template']['main_listing']['template_name'] : 'soft-ui';
$content_template = file_get_contents(__DIR__ . '/../_template/' . $template_name . '/' . $filename . '.php');
// echo '/../_template/'.$template_name.'/'.$filename.'.php';
$page['row_section']['profil'] = Database::database_coverter($page,$card['profil']['database'],array(),'all');
$content_template = str_replace("NOWDATE", date('Y-m-d'), $content_template);
$array_template = array(
	"PAGE-TITLE" => 'page_title',
	"PAGE-SUBTITLE" => 'page_subtitle',
	"PROFILE-TITLE" => 'profile_title',
	"PROFILE-SUBTITLE" => 'profile_subtitle',
	"LIST-MENU" => 'list_menu', 
	"PRELIST" => 'prelist',
	"FILTER" => 'filter',
	"MAINLOADDATA" => 'main_load_data_on_listing_menu',
);

$CARDCONTENTFUNC = $fai->call_function_class("CARDCONTENTFUNC");
foreach ($array_template as $key => $value) {
	$content_template = str_ireplace("<$key></$key>", $CARDCONTENTFUNC->$value($page, $card, $template_name, $this_card, $nama_type, $nama_array, $array, $page_database, $visible), $content_template);
}

echo $content_template;
?>
<input id="total_record" value="<?= $database ? ($database['num_rows']) : -1; ?>" type="hidden">
<input id="limit_page" value="<?= $page['limit_page']; ?>" type="hidden">

<script>
	var number_page = 1;
	var view = "ViewHorizontal";
	var numbeArrayEdit = 0;
</script>
<?php if (!$visible) { ?>
	<script>
		load_data_menu('<?= $page['load']['page_section_menu'] ?>');
	</script>
<?php } ?>