<hr style="border:1px dashed #000">
<h2 class="section-title">Data ke <?=($no_array+1);?></h2>

<input type="hidden" class="count_array_crud">
                <div class="form-group">
                    <label>Config Array</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="page['crud']['array'][<?=$no_array;?>][0]" placeholder="Title ">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="page['crud']['array'][<?=$no_array;?>][1]" placeholder="Name ">
                        </div>
                        <div class="col-md-4">
                            <select type="text"  onchange="get_type(this,<?=$no_array;?>)" class="form-control select2" name="page['crud']['array'][<?=$no_array;?>][2]" placeholder="Name ">
                                <option value="">- Pilih Type -</option>
                                <?php
                                $list_type = array(

                                    "text", "textarea", "select", "select-manual", "select-multiple-string", "checkbox", "radio", "date", "email", "file", "hidden", "number", "password", "submit"
                                    //,"tel","time","url","week","color","datetime-local","image","month","range","reset","search"

                                );
                                $list_type_sub = array("", '-crud', '-relation', '-nosave', '-edit', '-editview', '-tambah');

                                for ($j = 0; $j < count($list_type_sub); $j++) {
                                    for ($i = 0; $i < count($list_type); $i++) {
                                        echo '<option value="' . $list_type[$i] . $list_type_sub[$j] . '">' . ucwords($list_type[$i] . $list_type_sub[$j]) . '</option>';
                                    }
                                }
                                ?>

                            </select>

                        </div>

                    </div>
                    
                    <div id="select-database-<?=$no_array;?>" style="display:none">
                    <div class="form-group">
                        <label>Select Database</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control input-select-database-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][]" placeholder="Select Database ">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-select-database-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][]" placeholder="Select Primary Key ">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-select-database-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][]" placeholder="Select Show Text ">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-select-database-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][]" placeholder="Select Alias Database ">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div id="select-manual-<?=$no_array;?>"  style="display:none">
                    <div class="form-group">
                        <label>Select Manual</label>
                        <div class="row" id="select-manual">
                            <div class="col-md-6">
                                <input type="text" class="form-control input-select-manual-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][0]['key']" placeholder="Select Value ">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-select-manual-<?=$no_array;?>" name="page['crud']['array'][<?=$no_array;?>][3][0]['value']" placeholder="Select  Show Text ">
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="">Tambah Select Manual</button>
                    </div>
                    </div>



                    <?php
                    $list_fitur = array(
                        "function" => array("type" => 1, "function" => 1, "param" => 0),
                        "crud_inline" => 1, "insert_value" => 1, "insert_disable" => 1, "insert_default_value_request" => 1, "insert_default_value" => 1, "insert_autofield" => 1, "crud_after_form" => 1, "crud_disabled_value" => 1, "costum_class" => 1, "prefix_list" => 1, "sufix_list" => 1, "prefix_name" => 1, "sufix_name" => 1, "field_value_automatic" => array("database" => 2, "request_where" => 1, "field" => 0), "field_view_sub_kategori" => 1, "field_value_automatic_select_target" => array("database"    =>    2, "request_where"    =>    1, "target"    =>    1, "value"    =>    1, "option"    =>    1), "select_database_costum" => array("database" => 2)
                    );
                    foreach ($list_fitur as $key => $value) { ?>
                        <div class="form-group">
                            <div class="control-label">
                                <h2 class="section-title"><?=
                                                            ucwords(str_replace('_', ' ', $key));
                                                            ?></h2>
                            </div>
                            <div class="custom-switches-stacked mt-2">
                                <label class="custom-switch">
                                    <input type="checkbox" name="option" value="1" class="custom-switch-input" onclick="showhiddenarray(this,'<?=$key?>',<?=$no_array;?>)">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Active</span>
                                </label>
                            </div>
                           
                            <div id="contentArrayCostum_<?=$key?>-<?=$no_array;?>" style="display:none">
                            <?php if ($value == 1) { ?>
                                <div class="form-group">
                                    <input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud][<?=$key?>][<?=$no_array;?>]" placeholder="<?= ucwords(str_replace('_', ' ', $key)); ?>">

                                </div>
                                <?php } else {
                                foreach ($value as $to_key => $to_value) {
                                    if ($to_value == 1) {
                                ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud][<?=$key?>][<?=$no_array;?>]" placeholder="<?= ucwords(str_replace('_', ' ', $to_key)); ?>">

                                        </div>
                                        <?php   } else if ($to_value == 2) {
                                            echo '<hr>';
                                        foreach ($database as $database_key => $database_value) {
                                            if ($database_value == 1) {
                                        ?>
                                                <div class="form-group">
                                                    <input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud][<?=$key?>][<?=$no_array;?>][database][<?= $database_key ?>]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?> <?= ucwords(str_replace('_', ' ', $to_key)); ?>">

                                                </div>


                                            <?php   } else if ($database_value == 0) { ?>
                                                <div class="form-group">
                                                    <input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud][<?=$key?>][<?=$no_array;?>][database][<?= $database_key ?>][]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?> <?= ucwords(str_replace('_', ' ', $to_key)); ?>">
                                                </div>
                                                <div id="appendDatabaseContent_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>"></div>
                                                <button class="btn btn-primary mb-4" onclick="appendDatabase_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>()">Tambah <?= ucwords(str_replace('_', ' ', $database_key)); ?> <?= ucwords(str_replace('_', ' ', $to_key)); ?></button>
                                                <script>
                                                    function appendDatabase_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>() {
                                                        $('#appendDatabaseContent_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>').append(' <div class="form-group"><input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud][<?=$key?>][<?=$no_array;?>][database][<?= $database_key ?>][]" placeholder="<?= ucwords(str_replace('_', ' ', $database_key)); ?> <?= ucwords(str_replace('_', ' ', $to_key)); ?>">  </div>');
                                                    }
                                                </script>


                                            <?php   } else {
                                                $kontent = '<div class="row">';
                                                foreach ($database_value as $db_key => $db_value) {
                                                    $kontent .= '<div class="col-md-3">';
                                                    $kontent .= '<div class="form-group"><input type="text" class="form-control ArrayInput_<?=$key?>-<?=$no_array;?>" name="page[crud]['.$key.']['.$no_array.'][database][' . $database_key . '][' . $db_key . '][]" placeholder="' . ucwords(str_replace('_', ' ', $database_key)) . ' ' . ucwords(str_replace('_', ' ', $db_key)) . '">  </div>';


                                                    $kontent .= '</div>';
                                                }
                                                $kontent .= '</div>';
                                                echo $kontent;
                                            ?>
                                                <div id="appendDatabaseContent_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>"></div>
                                                <button class="btn btn-primary mb-4" onclick="appendDatabase_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>()">Tambah <?= ucwords(str_replace('_', ' ', $database_key)); ?> <?= ucwords(str_replace('_', ' ', $to_key)); ?></button>
                                                <script>
                                                    function appendDatabase_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>() {
                                                        $('#appendDatabaseContent_<?= $database_key ?>_<?= $to_key ?>_<?= $key ?>').append('<?= $kontent; ?>');
                                                    }
                                                </script>


                                            <?php   } ?>
                                        <?php   } ?>
                                        
                                        
                                    <?php  
                                echo '<hr>';
                                } else if ($to_value == 0) { ?>
                                        <?php 
                                        
                                        $kontent = "";
                                        
                                        $kontent .= '<div class="form-group"><input type="text" class="form-control ArrayInput_'.$key.'-'.$no_array.'" name="page[crud]['.$key.']['.$no_array.'][]" placeholder="'.ucwords(str_replace('_', ' ', $to_key)) .'"></div>';
                                        echo $kontent;
                                        ?>  
                                        <div id="appendArrayContent_<?=$key?>-<?=$to_key?>-<?=$no_array;?>"></div>
                                        <button class="btn btn-primary" onclick="appendArray_<?=$key?>_<?=$to_key?>_<?=$no_array;?>()">Tambah <?= ucwords(str_replace('_', ' ', $to_key)); ?></button>
                                        <script>
                                                    function appendArray_<?=$key?>_<?=$to_key?>_<?=$no_array;?>() {
                                                        
                                                        $('#appendArrayContent_<?=$key?>-<?=$to_key?>-<?=$no_array;?>').append('<?= $kontent; ?>');
                                                    }
                                                </script>
                                    <?php   } ?>
                                <?php   } ?>
                                
                                <?php } ?>
                                </div>
                        <?php } ?>


                        </div>


          