<?php
if ($page['load']['type'] == 'view_website') {

	$page_template = $fai->Apps($page['load']['apps'], $page['load']['page_view']);
	$page['template'] = $page_template['website']['template'];
} ?>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="robots" content="noindex,nofollow">
	<meta name="google-site-verification" content="<?= isset($page['meta']['google_seo']) ? $page['meta']['google_seo'] : '' ?>">

	<meta name="keywords" content="<?= $keywords = isset($page['meta']['keyword']) ? $page['meta']['keyword'] : '' ?>,<?= $_SERVER['HTTP_HOST'] ?>">
	<meta name="description" content="<?= $description = isset($page['meta']['description']) ? $page['meta']['description'] : '' ?>">
	<!-- Primary Meta Tags -->

	<meta name="title" content="<?= $title = isset($page['meta']['title']) ? $page['meta']['title'] : '' ?>">
	<link rel="icon" href="<?= $icon = isset($page['meta']['icon']) ? $page['meta']['icon'] : '' ?>" type="image/x-icon" />

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= $page['load']['route_page'] ?>">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:description" content="<?= $description ?>">
	<meta property="og:image" content="<?= $icon ?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?= $page['load']['route_page'] ?>">
	<meta property="twitter:title" content="<?= $title ?>">
	<meta property="twitter:description" content="<?= $description ?>">
	<meta property="twitter:image" content="<?= $icon ?>">
	<!--images/logobgwhite.png-->
	<title><?= $title ?></title>
	<script src="<?= $fai->urlframework('dist', 'jquery-3.4.1.min.js') ?>"></script>
	<link href="<?= $fai->urlframework('dist', 'style-basic.css') ?>">
	<link href="<?= $fai->urlframework('dist', 'style.css') ?>">
	<link href="<?= $fai->urlframework('assets/bootstrap/dist/css/', 'bootstrap.css') ?>">
	<script src="<?= $fai->urlframework('assets/bootstrap/dist/js/', 'bootstrap.js') ?>"></script>

	<link rel="stylesheet" href="<?= $fai->urlframework('assets\font-awesome-4.7.0\css', 'font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?= $fai->urlframework('assets\datatable', 'css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= $fai->urlframework('assets\datatable', 'css/buttons.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= $fai->urlframework('assets\datatable', 'css/fixedColumns.bootstrap5.min.css'); ?>">
	<link href="<?= $fai->urlframework('hibe3', 'horizontal/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet">
	<link href="<?= $fai->urlframework('hibe3', 'horizontal/assets/libs/%40mdi/font/css/materialdesignicons.min.css') ?>" rel="stylesheet">
	<link href="<?= $fai->urlframework('hibe3', 'horizontal/assets/libs/simplebar/dist/simplebar.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
	<script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" integrity="sha512-xrbX64SIXOxo5cMQEDUQ3UyKsCreOEq1Im90z3B7KPoxLJ2ol/tCT0aBhuIzASfmBVdODioUdUPbt5EDEXmD9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
	<style>
		.select2-container .select2-selection--single .select2-selection__rendered {
			/*padding: .5rem 3rem .5rem 1rem;*/
		}

		.select2 {
			width: 100% !important;
			font-size: 11px;
		}

		.select2-selection__rendered {
			line-height: 31px !important;
			font-size: 13px;
		}

		.select2-container .select2-selection--single {
			height: 35px !important;
		}

		.select2-selection__arrow {
			height: 34px !important;
		}

		.select2-container--default .select2-selection--single {
			border: var(--dashui-border-width) solid var(--dashui-input-border);
			border-radius: .375rem;
		}

		.select2-container--default .select2-results__option--highlighted[aria-selected] {
			background-color: rgba(28, 175, 55);
			color: white;
		}

		.text_editor {
			position: relative;
		}

		.text_editorAria {
			height: 100%;
			min-height: 400px;
			border: 1px solid #ddd;
			overflow-y: auto;
			padding: 1em;
			margin-top: -2px;
			outline: none;
		}

		.toolbar-text_editor {
			position: sticky;
			top: 0;
			left: 0;
			right: 0;
			background-color: #fff;
			border: 1px solid #ddd;
			padding: 10px;
		}

		.toolbar-text_editor a,
		.fore-wrapper,
		.back-wrapper {
			border: 1px solid #ddd;
			background: #FFF;
			font-family: "Candal";
			color: #000;
			padding: 5px;
			margin: 2px 0px;
			width: 35px;
			height: 35px;
			display: inline-block;
			text-align: center;
			text-decoration: none;
		}

		.toolbar-text_editor a:hover,
		.fore-wrapper:hover,
		.back-wrapper:hover {
			background: #0eacc6;
			color: #fff;
			border-color: #0eacc6;
		}

		a.palette-item {
			display: inline-block;
			height: 1.3em;
			width: 1.3em;
			margin: 0px 1px 1px;
			cursor: pointer;
		}

		a.palette-item[data-value="#FFFFFF"] {
			border: 1px solid #ddd !important;
		}

		a.palette-item:hover {
			transform: scale(1.1);
		}

		.fore-wrapper,
		.back-wrapper {
			position: relative;
			cursor: auto;
		}

		.fore-palette,
		.back-palette {
			display: none;
			cursor: auto;
		}

		.fore-wrapper:hover .fore-palette,
		.back-wrapper:hover .back-palette {
			display: block;
		}

		.fore-wrapper .fore-palette,
		.back-wrapper .back-palette {
			position: relative;
			display: inline-block;
			cursor: auto;
			display: block;
			left: 0;
			top: calc(100% + 5px);
			position: absolute;
			padding: 10px 5px;
			width: 160px;
			background: #FFF;
			box-shadow: 0 0 5px #CCC;
			display: none;
			text-align: left;
		}

		.fore-wrapper .fore-palette:after,
		.back-wrapper .back-palette:before {
			content: "";
			display: inline-block;
			position: absolute;
			top: -10px;
			left: 10px;
			width: 0;
			height: 0;
			border-left: 10px solid transparent;
			border-right: 10px solid transparent;
			border-bottom: 10px solid #fff;
		}

		.fore-palette a,
		.back-palette a {
			background: #FFF;
			margin-bottom: 2px;
			border: none;
		}

		.text_editor img {
			max-width: 100%;
			object-fit: cover;
		}
	</style>
</head>

<body data-layout="horizontal" class="<?= isset($page['load']['body_class']) ? $page['load']['body_class'] : ''; ?>" style="<?= isset($page['load']['body_style']) ? $page['load']['body_style'] : ''; ?>">
	<?php if (isset($page['load_screen'])) { ?>
		<div class="row no-gutters vh-100 loader-screen" style="background: white !important;">
			<?= $page['load_screen'] ?>
		</div>
	<?php } ?>


	<div id="AllContentLoad">
		<?php
		if ($page['load']['type'] !== 'view_website' and $page['load']['protocol'] == 'call') {
			$fai = new MainFaiFramework();
			$fai->AllPage($page, $page['load']['menuApps'], 'template', 2);
		}
		?>
	</div>
	<?php

	echo '<input type="hidden" id="load_link_route" value="' . $page['load']['route_page'] . '">
			    <input type="hidden" id="load_apps" value="' . $page['load']['apps'] . '">
			    <input type="hidden" id="load_page_view" value="' . $page['load']['page_view'] . '">
			    <input type="hidden" id="load_menu" value="' . (isset($page['load']['menu']) ? $page['load']['menu'] : '') . '">
			    <input type="hidden" id="load_nav" value="' . (isset($page['load']['nav']) ? $page['load']['nav'] : '') . '">
			    <input type="hidden" id="load_type" value="' . $page['load']['type'] . '">
			    <input type="hidden" id="load_type_temp" value="' . (isset($page['load']['type_temp']) ? $page['load']['type_temp'] : '')  . '">
			    <input type="hidden" id="load_id_temp" value="' . $page['load']['id'] . '">
			    <input type="hidden" id="load_id" value="' . $page['load']['id'] . '">
			    <input type="hidden" id="load_domain" value="' . $page['load']['domain'] . '">
			    ';
	?>

	<?php if (isset($page['load_screen'])) { ?>

		<script>
			$(window).on('load', function() {
				//$('.loader-screen').fadeOut('slow');
				$('.loader-screen').delay(500).css('display', 'none');
			});
		</script>

	<?php } ?>
	<style>

	</style>
	<div id="snackbar-container">
		<div id="snackbar">
			<div id="classType" class="" role="alert">
				<div class="d-flex">
					<div id="svg_content">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<circle cx="12" cy="12" r="9"></circle>
							<line x1="12" y1="8" x2="12" y2="12"></line>
							<line x1="12" y1="16" x2="12.01" y2="16"></line>
						</svg>
					</div>
					<div id="pesan"></div>
				</div>
				<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
	<script src="<?= $fai->urlframework('7sayvd814', 'r92h3go49as1s98.js') ?>"></script>
	<script src="<?= $fai->urlframework('dist', 'fai.js') ?>"></script>
	<!-- <script src=""></script> -->
	<!-- <?= $fai->urlframework('dist', 'fai.js') ?> -->
	<script src="<?= $fai->urlframework('assets\datatable', 'js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/dataTables.responsive.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/responsive.bootstrap4.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/dataTables.buttons.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/buttons.bootstrap4.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/jszip.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/pdfmake.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/vfs_fonts.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/buttons.html5.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/buttons.print.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/buttons.colVis.min.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets\datatable', 'js/dataTables.fixedColumns.min.js'); ?>"></script>

	<script src="<?= $fai->urlframework('assets\ace', 'src-noconflict/ace.js'); ?>"></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<script>
		feather.replace();
	</script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

	<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'></script>
	<script type="text/javascript">
		$('#sampleTable').DataTable();
	</script>
	<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

	<link rel="stylesheet" href="<?= $fai->urlframework('assets/bootstrap-tagsinput-latest/dist/', 'bootstrap-tagsinput.css'); ?> ">
	<link rel="stylesheet" href="<?= $fai->urlframework('assets/bootstrap-tagsinput-latest/examples/assets/', 'app.css'); ?>">
	<link rel="stylesheet" href="<?= $fai->urlframework('assets/bootstrap-tagsinput-latest/dist/', 'style.css'); ?>">
	<script src="<?= $fai->urlframework('assets/bootstrap-tagsinput-latest/dist/', 'bootstrap-tagsinput.js'); ?>"></script>
	<script src="<?= $fai->urlframework('assets/bootstrap-tagsinput-latest/examples/assets/', 'app.js'); ?>"></script>

	<script>
		table = $('#table').DataTable({
			"ordering": true,
			"processing": true, //Feature control the processing indicator. 
			"serverSide": true, //Feature control DataTables' server-side processing mode. 
			"order": [], //Initial no order. // Load data for the table's content from an Ajax source 
			"ajax": {
				"url": "https://api.srv3r.com/table/",
				"type": "POST",
				"data": function(data) {}
			},
			oLanguage: {
				sProcessing: "<i class='fa fa-spinner fa-spin text-success'></i> Tunggu sebentar..."
			}, //Set column definition initialisation properties. 
			"columnDefs": [{
				"targets": [0], //first column / numbering column 
				"orderable": false, //set not orderable 
			}, ],
		});
		$('#btn-filter').click(function() {

			table.ajax.reload(null, false); //just reload table 
		});
		$('#btn-reset').click(function() { //button reset event click 
			$('#form-filter')[0].reset();
			table.ajax.reload(null, false); //just reload table 
		});
	</script>
	<?php


	if ($page['load']['type'] == 'view_website') { ?>
		<script>
			reach_page_view_website();
		</script>

	<?php } else if ($page['load']['protocol'] !== 'call' or $page['template'] == 'sneat') {



	?>
		<script>
			reach_page_all_page();
		</script>
	<?php } else { ?>
		<script>
			reach_page_first('<?= $page['load']['apps'] ?>', '<?= $page['load']['page_view'] ?>', '<?= $page['load']['type'] ?>', '<?= $page['load']['id'] ?>');
		</script>
	<?php } ?>

</body>