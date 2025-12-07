<section class="section">
    <div class="section-header">
        <h1>Advanced Forms</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Advanced Forms</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Page</h2>
        <p class="section-lead">Pengaturan Page</p>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Page</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="page[title]" placeholder="Title Page">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="page[layout_pdf][]" placeholder="Layout PDF size">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="page[layout_pdf][]" placeholder="Layout PDF Orientasi ">
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label>Database</label>
                    <?php
                    $database = array(
                        "utama" => 1, 'primary_key' => 1, 'select' => 0, 'where' => array("where_row" => 1, "where_operator" => 1, "where_valuer" => 1), 'join' => array("join_database" => 1, "join_to_row_data" => 1, "join_row_database_equals" => 1, "lir_join" => 1),
                        'selectRaw' => 1, 'whereRaw' => 1
                    );
                    foreach ($database as $database_key => $database_value) {
                        if ($database_value == 1) {
                    ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="page[database][<?= $database_key ?>]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?>">

                            </div>


                        <?php   } else if ($database_value == 0) { ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="page[database][<?= $database_key ?>][]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?>">
                            </div>
                            <div id="appendDatabaseContent_<?= $database_key ?>"></div>
                            <button class="btn btn-primary mb-4" onclick="appendDatabase_<?= $database_key ?>()">Tambah <?= ucwords(str_replace('_', ' ', $database_key)); ?></button>
                            <script>
                                function appendDatabase_<?= $database_key ?>() {
                                    $('#appendDatabaseContent_<?= $database_key ?>').append(' <div class="form-group"><input type="text" class="form-control" name="page[database][<?= $database_key ?>][]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?>">  </div>');
                                }
                            </script>


                        <?php   } else {
                            $kontent = '<div class="row">';
                            foreach ($database_value as $db_key => $db_value) {
                                $kontent .= '<div class="col-md-3">';
                                $kontent .= '<div class="form-group"><input type="text" class="form-control" name="page[database][' . $database_key . '][' . $db_key . '][]" placeholder="' . ucwords(str_replace('_', ' ', $database_key)) . ' ' . ucwords(str_replace('_', ' ', $db_key)) . '">  </div>';


                                $kontent .= '</div>';
                            }
                            $kontent .= '</div>';
                            echo $kontent;
                        ?>
                            <div id="appendDatabaseContent_<?= $database_key ?>"></div>
                            <button class="btn btn-primary mb-4" onclick="appendDatabase_<?= $database_key ?>()">Tambah <?= ucwords(str_replace('_', ' ', $database_key)); ?></button>
                            <script>
                                function appendDatabase_<?= $database_key ?>() {
                                    $('#appendDatabaseContent_<?= $database_key ?>').append(' <?= $kontent; ?>');
                                }
                            </script>


                        <?php   } ?>
                    <?php   } ?>

                </div>
            </div>
        </div>

        <h2 class="section-title">Get Template Single</h2>
        <p class="section-lead">Buat menambahkan dan memasukan Template template </p>
        <div class="card">
            <div class="card-body">
                <select class="form-control" id="template_single">
                    <option>Pilih</option>
                    <option>CRUD Array</option>
                    <option>CRUD Subkategori</option>
                    <option>Card List</option>
                </select>
                <button class="btn btn-primary" onclick="addTempalte()">Tambah</button>
            </div>
        </div>
        <div id="contentTemplate"></div>





        <div class="section-body">
            <h2 class="section-title">Result Config Page</h2>
            <p class="section-lead">Pengaturan Page</p>


        </div>
</section>
<script>
    function addTempalte() {
        //alert();
        $.ajax({
            type: 'get',
            data: {
                'template': $('#template_single').val()
            },
            url: '<?= base_url(); ?>/Welcome/get_template_single',
            dataType: 'html',
            success: function(data) {
                $('#contentTemplate').append(data);
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function tambah_array_crud() {
        $.ajax({
            type: 'get',
            data: {
                'no_array': $('.count_array_crud').length
            },
            url: '<?= base_url(); ?>/Welcome/get_array_crud',
            dataType: 'html',
            success: function(data) {
                $('#contentArrayCrud').append(data);
            },
            error: function(error) {
                console.log('error; ' + eval(error));
                //alert(2);
            }
        });
    }

    function showhiddenarray(e, key, no_array) {

        if ($(e).is(':checked')) {
            $('#contentArrayCostum_' + key + '-' + no_array).show();
        } else {
            $('#contentArrayCostum_' + key + '-' + no_array).hide();
        }
        $('.ArrayInput_' + key + '-' + no_array).val('');
    } 
</script>
<script>
    function get_type(e, i) {
        array_select_database = ['select-crud', 'select-relation', 'select-nosave', 'select-edit', 'select-editview', 'select-tambah', 'select'];
        array_select_manual = ['select-manual-crud', 'select-manual-relation', 'select-manual-nosave', 'select-manual-edit', 'select-manual-editview', 'select-manual-tambah', 'select-manual'];
        alert(array_select_database.includes($(e).val()));
        alert($(e).val());
        if (array_select_database.includes($(e).val())) {
            $('#select-database-' + i).show();
            $('#select-manual-' + i).hide();
            $('.input-select-manual-' + i).val('');
        } else if (array_select_manual.includes($(e).val())) {
            $('#select-manual-' + i).show();
            $('#select-database-' + i).hide();
            $('.input-select-database-' + i).val('');

        } else {
            $('#select-manual-' + i).hide();
            $('#select-database-' + i).hide();
            $('.input-select-database-' + i).val('');
            $('.input-select-manual-' + i).val('');

        }
    }
</script>