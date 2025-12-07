<style>
	body {
		width: 97%;
		margin: 2em auto;
		font: 95% Arial, sans-serif;
	}

	div.code {
		width: 100%;
	}

	div.code-toolbar {
		height: 2em;
		background: #222;
		border-radius: 4px 4px 0 0;
		line-height: 2;
		padding: 0 0.5em;
		text-align: Left;
	}

	div.code-toolbar a.source {
		color: #fff;
		text-decoration: none;
	}

	div.code pre {
		font: 1em Monaco, "Courier New", monospace;
		margin: 0 0 1em 0;
		line-height: 1.4;
		white-space: pre-wrap;
		word-wrap: break-word;
		background: #eee;
		padding: 1em;
		border-radius: 0 0 4px 4px;
	}

	.accordion {
		background-color: #eee;
		color: #444;
		cursor: pointer;
		padding: 18px;
		width: 100%;
		text-align: left;
		border: none;
		outline: none;
		transition: 0.4s;
	}

	.active,
	.accordion:hover {
		background-color: #ccc;
	}

	/* Style the accordion panel. Note: hidden by default */
	.panel {
		padding: 0 18px;
		background-color: white;
		display: none;
		overflow: hidden;
	}
</style>
<button type="button" onclick="save2()">
	Export to File a
</button>
<div id="response">
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<form action="#" id="form" class="form-horizontal">

	<?php
	$app_framework = $page['app_framework'];
	$page['section'] = 'viewsource';
	$page = Packages::initialize($page);

	$page_temp = $page;
	?>
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				Route:
			</a>
		</div>
		<textarea id="dataRoute" data-id="route" name="route" style="width: 100%;height:100%"><?php
																								include($app_framework . "/_Route.php"); ?>
	</textarea>
	</div>
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				Controller: <?php echo $fai->nama_controller($page, $page['title']); ?>
			</a>
		</div>
		<textarea id="dataController" data-id="controller" name="Controller" style="width: 100%;height:100%"><?php
																												include($app_framework . "/_Controller.php");
																												$page = $page_temp;
																												?>
	</textarea>
	</div>
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				View List:
			</a>
		</div>
		<textarea id="dataModel" data-id="mode" name="view[list]" style="width: 100%;height:100%"><?php
																									include($app_framework . "/_ViewCrudList.php");

																									$page = $page_temp; ?>

																									
	</textarea>
	</div>
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				View Crud:
			</a>
		</div>
		<textarea id="dataView" data-id="add" name="view[crud]" style="width: 100%;height:100%"><?php

																								include($app_framework . "/_ViewCrudAll.php");
																								$page = $page_temp;
																								?>
	</textarea>
	</div>
	
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				View : PDF
			</a>
		</div>
		<textarea id="dataJS" data-id="pdf" name="view[pdf]" style="width: 100%;height:100%"><?php
																								include($app_framework . "/_ViewCrudPDF.php");
																								$page = $page_temp; ?>
	</textarea>
	</div>
	<div class="code">
		<div class="code-toolbar">
			<a href="#" class="source">
				View : PDFPage
			</a>
		</div>
		<textarea id="dataJS" data-id="pdfpage" name="view[PDFPage]" style="width: 100%;height:100%"><?php
																										$page['crud']['view'] = 'PDFPage';
																										include($app_framework . "/_ViewCrudPDFPage.php");
																										$page = $page_temp; ?>
	</textarea>
	</div>
	

	<input type="hidden" name="name_page" value="<?= $page['title']; ?>" />
</form>

<script src='https://lovasoa.github.io/tidy-html5/tidy.js'></script>
<script src="./script.js"></script>
<script>
	dataView = document.querySelector('#dataView');
	options = {
		"indent": "auto",
		"indent-spaces": 2,
		"wrap": 8000,
		"markup": true,
		"output-xml": false,
		"numeric-entities": true,
		"quote-marks": true,
		"quote-nbsp": false,
		"show-body-only": 1,
		"quote-ampersand": false,
		"break-before-br": true,
		"uppercase-tags": false,
		"uppercase-attributes": false,
		"drop-font-tags": true,
		"tidy-mark": false
	}
	String.prototype.toHtmlEntities = function() {
		return this.replace(/./gm, function(s) {
			// return "&#" + s.charCodeAt(0) + ";";
			return (s.match(/[a-z0-9\s]+/i)) ? s : "&#" + s.charCodeAt(0) + ";";
		});
	};

	/**
	 * Create string from HTML entities
	 */
	String.fromHtmlEntities = function(string) {
		return (string + "").replace(/&#\d+;/gm, function(s) {
			return String.fromCharCode(s.match(/\d+/gm)[0]);
		})
	};

	function replaceAll(str, find, replace) {

		return str.replace(new RegExp(find, 'g'), replace);
	}

	function limpiar() {


		//console.log(codigo.textContent);
		$('textarea').each(function() {
			val = $(this).val();
			if ($(this).data('id') != 'controller') {
				// val = replaceAll(val, "<", '&lt;');
				// val = replaceAll(val, ">", '&gt;');
				r = tidy_html5(val, options);
				//console.log('Resultado: ', r);
				r = replaceAll(r, '&kurungbuka;', "(");
				r = replaceAll(r, '%3E', ">");
				r = replaceAll(r, '&gt;', ">");
				r = replaceAll(r, '&lt;', "<");
				r = replaceAll(r, '%3C', "<");
				r = replaceAll(r, '&#039;', "'");
				r = replaceAll(r, '&#39;', "'");
				r = replaceAll(r, '&quot;', '"');
				r = replaceAll(r, '&quot;', '"');
				r = replaceAll(r, '&amp;', '&');

				$(this).val(r);
				// alert(r);
			}
		});
	}


	function save2() {
		//limpiar();

		<?php
		$ci = &get_instance();
		?>
		url = "<?php echo base_url(); ?><?= $ci->uri->segment(1); ?>/get_file/<?= $page['link_page'] ?>/<?= $ci->uri->segment(4); ?>/export";


		// ajax adding data to database
		// var formData = new FormData($('#form')[0]);
		var formData = $('#form').serialize() + "MainAll=2";

		$.ajax({
			url: url,
			type: "POST",
			data: formData,

			success: function(data) {
				alert(data);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');


			}
		});
	}
</script>