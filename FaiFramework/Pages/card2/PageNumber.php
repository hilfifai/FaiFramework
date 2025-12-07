<p class="m-0 text-muted">
	Showing
	<span>
		<?= ($_GET['jumlah'] * $_GET['page']) - $_GET['jumlah'] + 1?>
	</span>
	to
	<span>
		<?php
		if($_GET['jumlah'] * $_GET['page'] < $_GET['total_record']) echo $_GET['jumlah'] * $_GET['page'];
		else echo $_GET['total_record'];
		?>
		<!--titik kritisnya ketika satu pagenya kosong itu gimana-->
	</span>
	of
	<span>
		<?=$_GET['total_record']?>
	</span> entries
</p><?php

echo paginate_fai_contetn($_POST['jumlah'],$_POST['page'],$_POST['total_record']); ?>