<form id="formlist_fai_framework"  method="get" enctype="multipart/form-data">
                            <div class="row">
                                <?php
                                echo $fai->view('crud/search.blade.php', $page)
                                ?>
                            </div>
                            <?php if (count($page['crud']['search'])) { ?>
                                <a href="<?= $fai->route_v($page, $page['route'], ['list', '-1']) ?>" class="btn btn-primary">Reset</a>
                                <button <?= $page['section']=='viewsource'?'type="submit"':
                                	'onclick="list_from('."'"."list"."'".')" type="button" ';?> value="list" name="Cari" class="btn btn-primary">Cari</button>
                            <?php } ?>
                            <button <?= $page['section']=='viewsource'?'type="submit"':'onclick="list_from('."'"."excel"."'".')" type="button" ';?> onclick="list_from('excel')" value="excel" name="Cari" class="btn btn-primary">Excel</button>
                            <button <?= $page['section']=='viewsource'?'type="submit"':'onclick="list_from('."'"."pdf"."'".')" type="button" ';?>  value="pdf" name="Cari" class="btn btn-primary">PDF</button>
                        </form>