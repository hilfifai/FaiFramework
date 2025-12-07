<?php if (isset($page['import_export'])) { ?>
<div class="col-md-2 ">
    <a class="btn btn-primary w-100" href="<?= $fai->route_v($page, $page['route'], ['import_export', -1]) ?>"> Import/Export</a>
</div>
<?php } ?>