<?php if (!isset($page['no_add'])) { ?>

<div class="col-md-2">
    <a class="btn btn-primary w-100" <?= $page['section'] == 'viewsource' ? 'href="<?=url(' . "'" . $fai->route($page['route'], ['tambah', -1]) . "')?>" . '"' : 'onclick="reach_page(' . "'" . $page['route'] . "'" . ',' . "'" . 'tambah' . "'" . ',-1)"'; ?>> Add <?= $page['title'] ?></a>
</div>
<?php } ?>
<?php if (isset($page['add']['link'])) { ?>
<div class="col-md-2">
    <a class="btn btn-primary" href="<?= $page['add']['link'] ?>"> <? $page['add']['text'] ?></a>
</div>
<?php } ?>

