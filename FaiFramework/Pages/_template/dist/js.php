<?php if ($page['section'] != 'viewsource') { ?>
    <!-- <script>
        function direct_role(e, id_board) {
            id_role = $(e).val();
            $.ajax({
                type: 'get',
                data: {

                    'id_board': id_board,
                    'id_role': id_role,




                },
                url: '<?= (Partial::link_direct($page, base_url() . 'pages/', array("Auth", "change_role_board", 'view_layout', -1))) ?>',
                dataType: 'html',
                success: function(data) {

                },
                error: function(error) {
                    console.log('error; ' + eval(error));
                    //alert(2);
                },
                beforeSend: function(jqXHR) {

                }
            });
        }
    </script> -->
<?php
}
if (isset($page['crud']['list_table_view_layout'])) {

?>
    <script>
        function change_view_layout_crud(link_route, type, id) {
            $.ajax({
                type: 'get',
                data: {
                    'type_crud': type,
                    'id': id,

                    'json_decode': 0,
                    'contentfaiframework': 'crudlayout',
                    'search': <?= json_encode(isset($page['search']) ? $page['search'] : array()); ?>,

                    'database': <?= json_encode($page['database']); ?>,
                    'view_layout_number': <?= $page['view_layout_number']; ?>,
                    'frameworksubdomain': $('#load_domain').val(),
                    "MainAll": 2

                },
                url: link_route,
                dataType: 'html',
                success: function(data) {
                    $('#faicontentcrud').html(data);
                    if ($("#example2").length > 0) {
                        table.ajax.reload();
                    }
                },
                error: function(error) {
                    console.log('error; ' + eval(error));
                    //alert(2);
                },
                beforeSend: function(jqXHR) {

                }
            });
        }

        function <?= isset($page['load']['card']['button_save']['function']) ? $page['load']['card']['button_save']['function'] : 'submit_form_layout_crud'; ?>(link_route, type, id) {

            formData = $('#formvte_fai_framework').serialize() +
                '&type_crud=' + type +
                '&id=' + id +
                '&view_layout_number=<?= $page['view_layout_number']; ?>' +
                '&board=<?= $page['load']['board']; ?>' +
                '&contentfaiframework=crudlayout' +
                '&frameworksubdomain=' + $('#load_domain').val() +

                '&json_decode=1' +
                "&MainAll=2"

            ;

            $.ajax({
                type: 'get',
                data: formData,
                url: link_route,
                dataType: 'html',
                proccessData: false,
                contentType: false,
                success: function(data) {
                    <?php if (isset($page['crud']['redirect_after_submit'])) { ?>
                        window.location.href = "<?php $page['route_type'] = "just_link";
                                                echo Partial::link_direct($page, $page['load']['link_route'], $page['crud']['redirect_after_submit']); ?>";
                    <?php } else { ?>
                        change_view_layout_crud(link_route, 'list', id)
                    <?php } ?>
                },
                error: function(error) {
                    console.log('error; ' + eval(error));
                    //alert(2);
                },
                beforeSend: function(jqXHR) {
                    // $.xhrPool.push(jqXHR);
                }
            });
        }
    </script>

<?php }
$content_array_website = '';

$content_validation = "function validation(){
	
";
$perantara_add_sub_kategori = "";
$content_validation .= 'var result= 0;';
$total_file_upload = 0;
$total_tag_input = 0;
$total_tag_input = 0;
$content_terapkan_semua = "";
for ($i = 0; $i < count($array); $i++) {

    $text = $array[$i][0];
    $field = $array[$i][1];
    $type = $array[$i][2];
    $extype = explode('-', $type);
    if ($type == 'editor-code')
        $content_validation .= '
     var get_editor_' . $field . '0 = ace.edit("editor_' . $field . '0");
            var code = get_editor_' . $field . '0.getValue();
    $("#' . $field  . '0").val(escapeHtml(code));';
    if ($type == 'picture-upload')
        $total_file_upload += 1;
    if ($type == 'multiple-tag')
        $total_tag_input += 1;
    if ($type == 'array_website') {
        $content_array_website .= "
        function array_website_" . $array[$i][4]['get'] . "__$field (e,numbering){
            ";
        if ($array[$i][4]['get'] == 'form_input_value') {
            $content_array_website .= " 
                var value_add=-1;
                var value_form_input_value = $(e).val();";
        } else {

            $content_array_website .= " var value_add = e;";
            $content_array_website .= " var value_form_input_value = -1;";
        }


        $content_array_website .= "
            $.ajax({
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=result_array_website'
			                + '&array_website=\".$field.\"'
			                + '&id='+$('#load_id').val()
			                + '&tipe_array=\"array_utama\"'
			                + '&no_array=$i'
			                + '&value_form_input_value='+value_form_input_value
			                + '&value_add='+value_add
			                + '&contentfaiframework=get_pages'
                            +  '&frameworksubdomain=' +$('#load_domain').val()
                            
                            + '&MainAll=2',
	                url: $('#load_link_route').val(),
	                dataType: 'json',
	                success: function(data) {
	                	$('#supporting_'+field+'0').val(data.count);
	                	
	                	
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	           
	            
        }
                ";
    }

    if (in_array('r', $extype) or in_array('required', $extype) or in_array('req', $extype)) {

        $content_validation .= "

    if($('#" . $field . "0').val()==''){
        $('#help_" . $field . "0').html('$text Belum terisi');
        Show_alert('$text Belum terisi','Success alert-important alert-dismissible','svg-checklis');
        result++;
    }else{
        $('#help_" . $field . "0').html('');
    }";
    }
    if (isset($page['crud']['unique_value'])) {
        if (in_array($field, $page['crud']['unique_value']['list_field'])) {
            $content_validation .= "
			
			get_unique$field = parseInt($('#supporting_" . $field . "0').val());
			if(get_unique$field>0)
			$('#help_" . $field . "0').html('$text sudah digunakan');
			else
			$('#help_" . $field . "0').html('');
			result += get_unique$field;
		";
        }
    }
}
if (isset($page['crud']['sub_kategori'])) {

    for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
        $array_sub_kategori = $page['crud']['array_sub_kategori'][$h];
        for ($i = 0; $i < count($page['crud']['array_sub_kategori'][$h]); $i++) {
            $text = $array_sub_kategori[$i][0];
            $field = $array_sub_kategori[$i][1];

            $type = $array_sub_kategori[$i][2];
            if (isset($page['crud']['all_change_sub_kategori'][$page['crud']['sub_kategori'][$h][1]]['array'])) {

                if (isset($page['crud']['all_change_sub_kategori'][$page['crud']['sub_kategori'][$h][1]]['array'])) {

                    if (in_array($field, $page['crud']['all_change_sub_kategori'][$page['crud']['sub_kategori'][$h][1]]['array'])) {
                        $perantara_add_sub_kategori .= "terapkan_semua_$field();";
                        //  $content_terapkan_semua .= $type;
                        if (in_array($type,['select']) ){
                            $content_terapkan_semua .= "
                            function terapkan_semua_$field(){
                               
                                
                                data = $('." . $field . "__all_change').select2('data');
                                if(data.hasOwnProperty(0)) {
                                ".'$newOption'." = $(\"<option selected='selected'></option>\").val(data[0].id).text(data[0].text)
                                $('.$field').append(".'$newOption'.").trigger(\"change\");
                                }
                                }";
                        }else{

                            $content_terapkan_semua .= "
                            function terapkan_semua_$field(){
                                $('.$field').val($('." . $field . "__all_change').val());
                               
                                }";
                        }
                    }
                }
            }

            if ($type == 'array_website') {
                $content_array_website .= "
                <script>
            function array_website_" . $array_sub_kategori[$i][4]['get'] . "__$field (e,numbering){
                ";
                if ($array_sub_kategori[$i][4]['get'] == 'form_input_value') {
                    $content_array_website .= " 
                    var value_add=-1;
                    var value_form_input_value = $(e).val();";
                } else {

                    $content_array_website .= " var value_add = e;";
                    $content_array_website .= " var value_form_input_value = -1;";
                }


                $content_array_website .= "
                $.ajax({
                        type: 'GET',
                        data: $('#formvte_fai_framework').serialize() 
                                + '&link_route='+$('#load_link_route').val()
                                + '&apps='+$('#load_apps').val()
                                + '&page_view='+$('#load_page_view').val()
                                + '&id='+$('#load_id').val()
                                + '&type=result_array_website'
                                + '&array_website=\".$field.\"'
                                + '&tipe_array=\"array_sub_kategori\"'
                                + '&no_sub_kategori=$h'
                                + '&no_array=$i'
                                + '&value_form_input_value='+value_form_input_value
                                + '&value_add='+value_add
                                + '&contentfaiframework=get_pages'
                                +  '&frameworksubdomain=' +$('#load_domain').val()
                                
                                + '&MainAll=2',
                        url: $('#load_link_route').val(),
                        dataType: 'html',
                        success: function(data) {
                            $('.$field').html(data);
                            
                            
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                        }
                    }); 	
                   
                    
            }
                    </script>
                    ";
                if ($array_sub_kategori[$i][4]['get'] == 'add') {
                    $content_array_website .=  '
				<div class="modal fade" id="modal_array_website_' . $field . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="btn btn-primary close"  onclick="close_search_load_sub_kategori_' . $field . '()">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="table_array_website_' . $field . '" class="table table-bordered table-sm w-100">
						<thead class="table-success" style="font-size: smaller">
						<tr>
				
                        <th>No</th>
			';

                    foreach (($array_sub_kategori[$i][4]['array_detail']) as $key => $value) {
                        $content_array_website .=  '<th>';
                        $content_array_website .=  $value;
                        $content_array_website .=  '</th>';
                    }
                    $content_array_website .=  '
						<th>Action</th>
					</tr>
					</thead>
					<tbody style="font-size: smaller" id="detailBaJaDetail">
						
					</tbody>
				</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" onclick="close_search_load_sub_kategori_' . $field . '()">Close</button>
				</div>
				</div>
			</div>
			</div>
			<script>
			
			function load_search_load_sub_kategori_' . $field . '(){
				var primary_key = $("#input_' . $field . '").val();
				search_load_sub_kategori_' . $field . '(primary_key,"search");
			}
			function pilih_search_load_sub_kategori_' . $field . '(primary_key){
				search_load_sub_kategori_' . $field . '(primary_key,"pilih");
			}
			function close_search_load_sub_kategori_' . $field . '(primary_key){
				$("#modal_array_website_' . $field . '").modal("hide");
			}
			function search_load_sub_kategori_' . $field . '(primary_key,method){
				' . "
				var output = 0;
				$('.no-$h').each(
					function(){
						if($(this).val() > output){
							output = $(this).val();
						}
					}
				);
				output++;
                
                                + '&array_website=\".$field.\"'
                                + '&tipe_array=\"array_sub_kategori\"'
                                + '&no_sub_kategori=$h'
                                + '&no_array=$i'
				$.ajax({
					type: 'get',
					url : " . ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['search_load_' . $field, -1])) . "'") : "$('#load_link_route').val()") . ",
					data: {
						_token: '',
						'id':'" . $field . "',
						'apps':$('#load_apps').val(),
						'page_view':$('#load_page_view').val(),
						'type':'search_load',
						'array_website':'$field',
						'tipe_array':'array_sub_kategori',
						'no_sub_kategori':'$h',
						'no_array':'$i',
						'primary_key':primary_key,
						'sub_kategori_id':'$h',
						'contentfaiframework':'get_pages',
						'no':output,
						'method':method
					  
					},
					dataType: 'html',
	                success: function(data) {
						$('#modal_array_website_" . $field . "').modal('hide');
	                	$('.$field').html(data);
						
						";
                    if (isset($array_sub_kategori[$i][4]['call_function'])) {

                        for ($cfa = 0; $cfa < count($array_sub_kategori[$i][4]['call_function']); $cfa++) {
                            $content .=  $array_sub_kategori[$i][4]['call_function'][$cfa] . ";";
                        }
                    }

                    $content_array_website .=      ";
						 no=output+1;
	                },
	                error: function(error) {
					}
				});
				" . '
			}
			function detail_array_website_add_' . $field . '(){
				' . "
				$('#modal_array_website_" . $field . "').modal('show');
					var table =  $('#table_array_website_$field').DataTable({
								   'processing': true,
								   'serverSide': true,
								   'serverMethod': 'get',
								   'bDestroy': true,
								   
								   'ajax': {
									   'url':" . ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['datatable_' . $field, -1])) . "'") : "$('#load_link_route').val()") . ",
									   'data': {
										   _token: '',
										   'id':'" . $field . "',
										   'apps':$('#load_apps').val(),
										   'page_view':$('#load_page_view').val(),
										   'type':'datatable_array_website',
										   'contentfaiframework':'get_pages',
										   'sub_kategori_id':'$h',
										    'array_website':'$field',
                                            'tipe_array':'array_sub_kategori',
                                            'no_sub_kategori':'$h',
                                            'no_array':'$i',
									   },
									   
								   },
								   'columns': [
									   { data: 'no' },
									   ";
                    foreach (($array_sub_kategori[$i][4]['array_detail']) as $key => $value) {
                        $content_array_website .=  " { data: '$key' },";
                    }

                    $content_array_website .=  "  { data: 'aksi' },
								   ]
								   }); 
								   
						   " . '
			}
			</script>';
                }
            }
        }
    }
}
$content_validation .= '

if(result==0)
	return 1;
else
	return 0;


';

$content_validation .= '}

';
if (isset($page['crud']['unique_value'])) {
    $content_validation .= "
   	

function search_unique (field,value){
	
$.ajax({
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=unique_value'
			                + '&id='+$('#load_id').val()
			                + '&value_input='+field
			                + '&contentfaiframework=get_pages'
                            +  '&frameworksubdomain=' +$('#load_domain').val()
                            
                            + '&MainAll=2',
	                url: $('#load_link_route').val(),
	                dataType: 'json',
	                success: function(data) {
	                	$('#supporting_'+field+'0').val(data.count);
	                	
	                	
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	           
	            
}
";
}

if ($total_file_upload) {
    $content_validation .= 'function readURL(input,field)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();
			reader.onload = function (e)
			{
				';
    $content_validation .= "$('#imagePreview'+field).attr('style', 'background-image: url('+e.target.result+');border-radius: 18px 47px;');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}";
}
echo '' . $content_array_website . '';
if (isset($page['crud']['js_ajax'])) {
    $js_ajax = "";
    for ($i = 0; $i < count($page['crud']['js_ajax']); $i++) {
        $js_ajax .= "function js_ajax_" . $page['crud']['js_ajax'][$i]["form_input"] . "_" . $page['crud']['js_ajax'][$i]["name"] . "(){
        var return_data = 0;
 $.ajax({ 
                     type: 'GET',
                     data: $('#formvte_fai_framework').serialize() 
                             + '&link_route='+$('#load_link_route').val()
                             + '&apps='+$('#load_apps').val()
                             + '&page_view='+$('#load_page_view').val()
                             + '&type=js_ajax'
                             + '&id='+$('#load_id').val()
                             + '&link=" . json_encode($page['crud']['js_ajax'][$i]["link"]) . "'
                            ";
        for ($j = 0; $j < count($page['crud']['js_ajax'][$i]["get"]); $j++) {
            $js_ajax .= "+ '&" . $page['crud']['js_ajax'][$i]["get"][$j][0] . "='+$('#" . $page['crud']['js_ajax'][$i]["get"][$j][1] . $page['crud']['js_ajax'][$i]["get"][$j][2] . "').val()";
        }
        $js_ajax .= "
                             + '&contentfaiframework=get_pages'
                             +  '&frameworksubdomain=' +$('#load_domain').val()
                             + '&MainAll=2'
                             + '&not_sidebar=not',
                     url: $('#load_link_route').val(),
                     dataType: '" . $page['crud']['js_ajax'][$i]["dataType"] . "',
                     success: function(data) {
                        ";
        for ($j = 0; $j < count($page['crud']['js_ajax'][$i]["result"]); $j++) {
            $js_ajax .= " $('#" . $page['crud']['js_ajax'][$i]["result"][$j][0] . "')." . $page['crud']['js_ajax'][$i]["result"][$j][1] . "(data" . ($page['crud']['js_ajax'][$i]["result"][$j][2] ? "." . $page['crud']['js_ajax'][$i]["result"][$j][2] : '') . ");";
        }
        $js_ajax .= "  
                        
                     },
                     error: function(error) {
                         console.log('error; ' + eval(error));
                         //alert(2);
                     }
                 }); 	
               
                 return return_data;
 }";
    }
    echo '<script>' . $js_ajax . '</script>';
    // echo $js_ajax;
}
if (isset($page['crud']['wizard_form'])) {

    for ($i = 0; $i < count($page['crud']['wizard_form']['list_field']); $i++) {

        // $text = $array[$i][0];
        // $type = $array[$i][2];
        $field = $page['crud']['wizard_form']['list_field'][$i];

        // print_r($page['crud']['wizard_form']['list_field']);
        //if (in_array($field, $page['crud']['wizard_form']['list_field'])) {
        if (isset($page['crud']['wizard_form'][$field])) {
            // echo 'BBBBBBBBB';
            $content_validation .= "
	
	function change_wizard_form_$field (value,field,numbering){
   	var return_data = 0;
        $.ajax({ 
	                type: 'GET',
	                data: $('#formvte_fai_framework').serialize() 
			                + '&link_route='+$('#load_link_route').val()
			                + '&apps='+$('#load_apps').val()
			                + '&page_view='+$('#load_page_view').val()
			                + '&type=wizard_form'
			                + '&id='+$('#load_id').val()
			                + '&value_input='+field
			                + '&this_value_input='+value
			                + '&contentfaiframework=get_pages'
                            
                            +  '&frameworksubdomain=' +$('#load_domain').val()
                            + '&MainAll=2'
                            + '&not_sidebar=not',
	                url: $('#load_link_route').val(),
	                dataType: 'html',
	                success: function(data) {
	                	
	                	$('#" . $page['crud']['wizard_form'][$field]['id_result_to'] . "'+numbering).html(data);
	                },
	                error: function(error) {
	                    console.log('error; ' + eval(error));
	                    //alert(2);
	                }
	            }); 	
	          
	            return return_data;
    }
    ";
        }
    }

    // echo '<script>' . $wizard . '</script>';

}
//$fp = fopen(Partial::urlframework('assets','validation.js'),"wb");
//fwrite($fp,$content_validation);
//fclose($fp);

// file_put_contents(__DIR__.'/../_template/assets/validation.js', $content_validation);
//echo '<script src="'.Partial::urlframework('assets','validation.js').'" type="text/javascript"></script>';
echo '<script>' . $content_validation . '</script>';

?>
<script>
    function perantara_add_sub_kategori() {

        <?php echo $perantara_add_sub_kategori; ?>
    }
    <?php
    echo $content_terapkan_semua;
    ?>
</script>

<?php
if (isset($page['crud']['function_js'][0])) {
    echo '<script>';
    for ($k = 0; $k < count($page['crud']['function_js']); $k++) {
        if ($page['crud']['function_js'][$k]['type'] == 'input-changer') {
            for ($l = 0; $l < count($page['crud']['function_js'][$k]['row']); $l++) {
                echo '
                function input_' . $page['crud']['function_js'][$k]['row'][$l];
                if (isset($page['crud']['function_js'][$k]['parameter']))
                    echo '(' . $page['crud']['function_js'][$k]['parameter'] . ')';
                else {
                    echo '()';
                }
                echo '{';
                echo $page['crud']['function_js'][$k]['name'];
                if (isset($page['crud']['function_js'][$k]['parameter']))
                    echo '(' . $page['crud']['function_js'][$k]['parameter'] . ')';
                else {
                    echo '()';
                }
                echo ';';
                echo '}
                ';
            }
        }
        echo '
        function ' . $page['crud']['function_js'][$k]['name'];
        if (isset($page['crud']['function_js'][$k]['parameter']))
            echo '(' . $page['crud']['function_js'][$k]['parameter'] . ')';
        else {
            echo '()';
        }
        echo '{
		';
        if (isset($page['crud']['function_js'][$k]['first'][0])) {
            for ($l = 0; $l < count($page['crud']['function_js'][$k]['first']); $l++) {
                echo '
            ';
                if ($page['crud']['function_js'][$k]['first'][$l]['type'] == 'call_function') {
                    echo '' . $page['crud']['function_js'][$k]['first'][$l]['name_function'] . '(' . (isset($page['crud']['function_js'][$k]['first'][$l]['parameter']) ? $page['crud']['function_js'][$k]['first'][$l]['parameter'] : '') . ');
                ';
                }
            }
        }
        if (isset($page['crud']['function_js'][$k]['get'])) {
            foreach ($page['crud']['function_js'][$k]['get'] as $key => $value) {
                echo $key . '=';
                if ($value == 'id') {
                    //  if (typeof $(".' . $key . '").data("number") !== \'undefined\') {
                    echo '$("#' . $key . '").val();
                  
                        ' . $key . ' = rupiahtonumber(' . $key . ');
                        
                    
					';
                } else if ($value == 'class') {
                    echo '$(".' . $key . '").val();
                   
                        ' . $key . ' = rupiahtonumber(' . $key . ');
                        
                    
					';
                } else if ($value == 'id_row') {
                    echo '$("#' . $key . '"+id_row).val();
					
                        ' . $key . ' = rupiahtonumber(' . $key . ');
                        
                   
                    ';
                }
                // echo 'alert("' . $key . '"+' . $key . ');';
            }
        }
        if (isset($page['crud']['function_js'][$k]['execute'])) {
            for ($l = 0; $l < count($page['crud']['function_js'][$k]['execute']); $l++) {

                if ($page['crud']['function_js'][$k]['execute'][$l]['type'] == 'math') {
                    echo '
                    var ' . $page['crud']['function_js'][$k]['execute'][$l]['var'];
                    echo '=';
                    echo $page['crud']['function_js'][$k]['execute'][$l]['math'];
                    echo ';';
                    // echo 'alert("'.$page['crud']['function_js'][$k]['execute'][$l]['var'].'="+'.$page['crud']['function_js'][$k]['execute'][$l]['var'].');';
                } else if ($page['crud']['function_js'][$k]['execute'][$l]['type'] == 'sum') {
                    echo 'var sum_' . $page['crud']['function_js'][$k]['execute'][$l]['sum'] . ' = 0;';
                    echo "
                            $('." . $page['crud']['function_js'][$k]['execute'][$l]['sum'] . "').each(function(){
                                nilai = parseFloat(rupiahtonumber($(this).val()));
                                        if(!nilai)
                                            nilai=0;
                                            
                                sum_" . $page['crud']['function_js'][$k]['execute'][$l]['sum'] . " += parseFloat(nilai);  
                            });";
                    echo '
                    
                    var ' . $page['crud']['function_js'][$k]['execute'][$l]['var'];
                    echo '=';
                    echo 'sum_' . $page['crud']['function_js'][$k]['execute'][$l]['sum'];
                    echo ';';
                }
            }
        }
        if (isset($page['crud']['function_js'][$k]['result'][0])) {
            for ($l = 0; $l < count($page['crud']['function_js'][$k]['result']); $l++) {
                echo '
            ';
                if ($page['crud']['function_js'][$k]['result'][$l]['type'] == 'call_function') {
                    echo '' . $page['crud']['function_js'][$k]['result'][$l]['name_function'] . '(' . (isset($page['crud']['function_js'][$k]['result'][$l]['parameter']) ? $page['crud']['function_js'][$k]['result'][$l]['parameter'] : '') . ');
                ';
                } else if ($page['crud']['function_js'][$k]['result'][$l]['type'] == 'to_val_row') {
                    if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'id') {
                        echo '$("#' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '"+id_row).val(formatRupiah(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . '))' .
                            (isset($page['crud']['function_js'][$k]['result'][$l]['triger']) ? '.trigger(".' . $page['crud']['function_js'][$k]['result'][$l]['triger'] . '")' : '') . ';';
                    } else if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'class') {
                        echo '$(".' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '"+id_row).val(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . ')' . (isset($page['crud']['function_js'][$k]['result'][$l]['triger']) ? '.' . $page['crud']['function_js'][$k]['result'][$l]['triger'] . '()' : '') . ';';
                    }
                } else if ($page['crud']['function_js'][$k]['result'][$l]['type'] == 'to_val') {
                    if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'id') {
                        echo '$("#' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '").val(formatRupiah(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . '));';
                    } else if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'class') {
                        echo '$(".' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '").val(formatRupiah(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . '));';
                    }
                } else if ($page['crud']['function_js'][$k]['result'][$l]['type'] == 'to_html') {
                    if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'id') {
                        echo '$("#' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '").html(formatRupiah(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . '));';
                    } else if ($page['crud']['function_js'][$k]['result'][$l]['input'] == 'class') {
                        echo '$(".' . $page['crud']['function_js'][$k]['result'][$l]['elemen'] . '").html(formatRupiah(' . $page['crud']['function_js'][$k]['result'][$l]['var'] . '));';
                    }
                }
            }
        }

        echo '
        }';
    }
    echo '</script>';
}
?>
<?php if ($page['section'] != 'select-other' and $page['section'] != 'viewsource') { ?>
    <script>
        function <?= isset($page['crud']['submit_form']) ? $page['crud']['submit_form'] : 'submit_form'; ?>(form_type) {
            $('.is_number').each(function() {
                nilai = parseFloat(rupiahtonumber($(this).val()));
                $(this).val(nilai);
            });
           
            var required = $('form#formvte_fai_framework input,form#formvte_fai_framework textarea,form#formvte_fai_framework select').filter('[required]:visible');
            var allRequired = true;
            var belumygmana = "";
            required.each(function() {
                if ($(this).val() == '') {
                    allRequired = false;
                    belumygmana += "<li>" + $(this).attr("placeholder") + '</li>';

                }

            });
            if (!allRequired) {
                $('#pesanSubmit').html('<div class="alert alert-danger" role="alert">Silahkan isi form dengan benar, cek kembali form<br><br><ol>' + belumygmana + '</ol></div>');


            } else {
                <?php if ($page['load']['link'] == 'direct') { ?>
                 
                    document.getElementById('formvte_fai_framework').submit();
                    $('form#formvte_fai_framework').submit();
                    <?php } else { ?>
                        
                      

                    var formData = new FormData($('#formvte_fai_framework')[0]);
                    formData.append('contentfaiframework', 'get_pages');
                    formData.append('MainAll', 2);
                    formData.append('not_sidebar', "not");
                    formData.append('link_route', $('#load_link_route').val());
                    formData.append('apps', $('#load_apps').val());
                    formData.append('id', $('#load_id').val());
                    formData.append('page_view', $('#load_page_view').val());
                    formData.append('menu', $('#load_menu').val());
                    formData.append('nav', $('#load_nav').val());
                    formData.append('type', form_type);
                    formData.append('frameworksubdomain', $('#load_domain').val());
                    formData.append('section', '<?= $page['section']; ?>');
                    formData.append('board', '<?= $page['load']['board']; ?>');
                    formData.append('page_database', '<?= isset($page['load']['page_database']) ? ($page['load']['page_database']) : -1; ?>');
                    formData.append('view_layout_number', '<?= isset($page['view_layout_number']) ? ($page['view_layout_number']) : -1; ?>');


                    $.ajax({
                        type: 'post',
                        data: formData,

                        url: <?php
                                $page_temp = $page;
                                $page['route_type'] = 'just_link_with_kutip';
                                $page['load']['link'] = 'direct';
                                $link = Partial::link_direct($page, $page['load']['link_route'], array($page['load']['apps'], $page['load']['page_view'], 'save', $page['load']['id'], $page['load']['menu']));
                                echo $link ? $link : '""';
                                $page = $page_temp;
                                ?>,
                        dataType: 'html',

                        processData: false,
                        contentType: false,
                        success: function(data) {
                            <?php if (isset($page['crud']['submit_form_direct'])) {
                                if ($page['crud']['submit_form_direct'] == 'this_link') {
                            ?>
                                    window.location.href = $('#load_link_route').val();
                                <?php }
                            } else { ?>

                                reach_page('<?= $page['route'] ?>', 'list', -1);
                            <?php } ?>
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                        }
                    });
                <?php } ?>
            }
        }

        function delete_from(id) {
            if (confirm('Apakah Anda Yakin?')) {
                //$('#load_apps').val(),$('#load_page_view').val(),$('#load_type').val(),$('#load_id').val()
                $.ajax({
                    type: 'POST',
                    url: link_route,
                    data: {
                        'id': id,
                        'apps': $('#load_apps').val(),
                        'page_view': $('#load_page_view').val(),
                        'frameworksubdomain': $('#load_domain').val(),
                        'type': 'hapus',
                        'contentfaiframework': 'get_pages',
                        "MainAll": 2,
                        "not_sidebar": "not",
                        "board": "<?= $page['load']['board']; ?>",
                        "section": "<?= $page['section']; ?>",
                        "page_database": "<?= isset($page['load']['page_database']) ? ($page['load']['page_database']) : -1; ?>",
                        "view_layout_number": "<?= isset($page['view_layout_number']) ? ($page['view_layout_number']) : -1; ?>",
                        menu: $('#load_menu').val(),
                        nav: $('#load_nav').val(),


                    },
                    dataType: 'html',
                    success: function(data) {
                        <?php if (isset($page['crud']['submit_form_direct'])) {
                            if ($page['crud']['submit_form_direct'] == 'this_link') {
                        ?>
                                window.location.href = $('#load_link_route').val();
                            <?php }
                        } else { ?>

                            reach_page('<?= $page['route'] ?>', 'list', -1);
                        <?php } ?>

                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    },
                    beforeSend: function(jqXHR) {
                        // //$.xhrPool.push(jqXHR);
                    }
                });

            }
        }
    </script>
<?php } ?>
<?php
if (isset($page['crud']['miror_sub_kategori'])) {
    foreach ($page['crud']['miror_sub_kategori'] as $db_miror => $value) {
        $to_event = 'miror_sub_kategori__' . $db_miror . '(this,numbering,field_miror=""){';
        echo 'function ' . $to_event;
        foreach ($value['array'] as $field_miror => $value_miror) {

            if ($value_miror[0] == 'data') {
                echo '$(".' . $value['to'] . '_"+numberic).val($(".' . $db_miror . '_"+numbering).val())';
            } else {
                echo '$(".' . $value['to'] . '_"+numberic).val(' . $value_miror[1] . ')';
            }
        }
        echo '}';
    }
}
?>
<?php if ($page['section'] == 'viewsource') {
    if (isset($page['crud']['sub_kategori'])) {
        $page['section_vte'] = 'sub_kategori';
        for ($h = 0; $h < count($page['crud']['sub_kategori']); $h++) {
            $sub_kategori = $page['crud']['sub_kategori'][$h];


            $database_sub = $sub_kategori[1];
?>
            <script>
                function sub_kategori_add_<?= $database_sub ?>(h, type) {
                    no = $('.contentinput-' + h).length;
                    $.ajax({
                        type: 'get',
                        data: {
                            'h': h,
                            '_view': '<?= $page['crud']['view']; ?>',
                            'frameworksubdomain': $('#load_domain').val(),
                            'no': no,
                            "MainAll": 2,
                            "not_sidebar": "not",

                            'contentfaiframework': 'get_pages',
                        },
                        url: '<?= $fai->route_v($page, $page['route'], ['ajax_sub_kategori_' . $database_sub, -1]); ?>',
                        dataType: 'html',
                        success: function(data) {
                            if (type == 'table') {
                                $('#tablecontentsubkategori-' + h + ' tr:last').after(data);
                            } else {
                                $('#addcontentsubkategori-' + h).append(data);
                            }
                            $('.select3').select2();
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                        }
                    });
                }
            </script>
<?php
        }
    }
}

?>

<?php if (isset($page['crud']['hidden_show'])) {
    foreach ($page['crud']['hidden_show'] as $key => $value) {
        if (!isset($page['crud']['hidden_show'][$key]['onjs'])) {
            $page['crud']['hidden_show'][$key]['onjs'] = "onclick,onkeyup,onchange";
        }
?>
        <script>
            $(".<?= $key; ?>").on("<?= $page['crud']['hidden_show'][$key]['onjs'] ?>", function() {
                hidden_show_<?= $key; ?>(this);
            });

            function hidden_show_<?= $key; ?>(e) {

                <?php
                $i = 0;
                foreach ($page['crud']['hidden_show'][$key]['value_if'] as $key_value_if => $value_if) { ?>
                    <?php
                    if ($i > 0) {
                        echo 'else';
                    }
                    ?>
                    if ($(e).val() == '<?= $key_value_if; ?>') {
                        <?php
                        if (isset($page['crud']['hidden_show'][$key]['value_if'])) {
                            foreach ($page['crud']['hidden_show'][$key]['value_if'][$key_value_if] as $key_field => $value_field) { ?>
                                $('#div-<?= $key_field; ?>').<?= $value_field ?>();
                                $('.<?= $key_field; ?>').val("");
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($page['crud']['hidden_show'][$key]['value_if_sub_kategori'])) {
                            foreach ($page['crud']['hidden_show'][$key]['value_if_sub_kategori'][$key_value_if] as $key_field => $value_field) { ?>
                                $('#subkategori_kontent-<?= $key_field; ?>').<?= $value_field ?>();
                        <?php }
                        } ?>
                    }
                <?php
                    $i++;
                } ?>
                else {
                    <?php
                    if (isset($page['crud']['hidden_show'][$key]['default'])) {
                        foreach ($page['crud']['hidden_show'][$key]['default'] as $key_field => $value_field) { ?>
                            $('#div-<?= $key_field; ?>').<?= $value_field ?>();
                        <?php
                        }
                    }
                    if (isset($page['crud']['hidden_show'][$key]['default_sub_kategori'])) {
                        foreach ($page['crud']['hidden_show'][$key]['default_sub_kategori'] as $key_field => $value_field) { ?>
                            $('#subkategori_kontent-<?= $key_field; ?>').<?= $value_field ?>();
                    <?php }
                    }
                    ?>
                }
            }
            $(document).ready(function() {
                hidden_show_<?= $key; ?>();
            });
        </script>

<?php }
} ?>

<?php if (isset($page['crud']['select_other'])) {
    foreach ($page['crud']['select_other'] as $key => $value) { ?>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?= $key ?>">Open modal for @getbootstrap</button> -->

        <div class="modal fade" id="Modal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?= $key ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form method="POST" id="formvte_select_other-<?= $key ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="content_select_other-<?= $key ?>"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="select_other_modal_close_<?= $key; ?>()">Batal</button>
                            <button type="button" class="btn btn-primary" onclick="submit_form_select_other_<?= $key; ?>()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            select_other_<?= $key; ?>();

            function select_other_modal_<?= $key; ?>() {
                $('#Modal<?= $key ?>').modal('show');
            }

            function select_other_modal_close_<?= $key; ?>() {
                $('#Modal<?= $key ?>').modal('hide');
            }

            function submit_form_select_other_<?= $key; ?>() {
                var formData = new FormData($('#formvte_select_other-<?= $key ?>')[0]);
                formData.append('contentfaiframework', 'get_pages');
                formData.append('link_route', $('#load_link_route').val());
                formData.append('apps', '<?= $page['crud']['select_other'][$key]['controller'] ?>');
                formData.append('id', $('#load_id').val());
                formData.append('page_view', '<?= $page['crud']['select_other'][$key]['function'] ?>');
                formData.append('MainAll', 2),
                    formData.append('frameworksubdomain', $('#load_domain').val()),

                    formData.append('type', 'save');
                formData.append('section', '<?= $page['section']; ?>');
                formData.append('board', '<?= $page['load']['board']; ?>');
                formData.append('view_layout_number', '<?= isset($page['view_layout_number']) ? ($page['view_layout_number']) : -1; ?>');
                $.ajax({
                    type: 'POST',
                    data: formData,

                    url: $('#load_link_route').val(),
                    dataType: 'json',

                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#select_other_content-<?= $key; ?>').html('<input type="hidden" name="' + $('#select_other_content-<?= $key; ?>').data('name') + '" value="' + data.last_insert_id + '" ><input type="text" class="form-control" disabled value="' + data.sqli.<?= $page['crud']['select_other'][$key]['field'] ?> + '" >');
                        $('#Modal<?= $key ?>').modal('hide');
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }

            function select_other_<?= $key; ?>() {


                $.ajax({
                    type: 'get',
                    data: {
                        'select_other': 1,
                        'id': -1,
                        'apps': '<?= $page['crud']['select_other'][$key]['controller'] ?>',
                        'page_view': '<?= $page['crud']['select_other'][$key]['function'] ?>',
                        'type': 'tambah',
                        'contentfaiframework': 'get_pages',
                        'frameworksubdomain': $('#load_domain').val(),
                        "MainAll": 2
                    },
                    url: <?= ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['select_other_' . $key, -1])) . "'") : "$('#load_link_route').val()") ?>,

                    dataType: 'html',
                    success: function(data) {

                        $('#content_select_other-<?= $key ?>').html(data);
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }
        </script>
    <?php } ?>
<?php } ?>

<?php if (isset($page['crud']['field_value_automatic'])) {
    foreach ($page['crud']['field_value_automatic'] as $key => $value) { ?>

        <script>
            function field_value_automatic_<?= $key; ?>(e) {
                value = $(e).val();
                $.ajax({
                    type: 'get',
                    data: {
                        'value': value,
                        'field_auto_change': '<?= $key; ?>',
                        '_view': '<?= $page['crud']['view']; ?>',
                        'id': -1,
                        'apps': $('#load_apps').val(),
                        'page_view': $('#load_page_view').val(),
                        'type': 'field_value_automatic_',
                        "MainAll": 2,
                        'contentfaiframework': 'get_pages',

                        "not_sidebar": "not",
                        'frameworksubdomain': $('#load_domain').val(),

                    },

                    url: <?php

                            // $page_temp = $page;
                            //         $page['route_type'] = 'just_link_with_kutip';
                            //         echo Partial::link_direct($page, $page['load']['link_route'], array($page['load']['apps'], $page['load']['page_view'], 'save', $page['load']['id'], $page['load']['menu']));
                            //         $page = $page_temp;
                            ?><?= ($page['section'] == 'viewsource' ? ("'" . ($fai->route_v($page, $page['route'], ['field_value_automatic_' . $key, -1])) . "'") : "$('#load_link_route').val()") ?>,

                    dataType: 'json',
                    success: function(data) {
                        <?php
                        //print_r($page['field_value_automatic'][$key]['field']);die;
                        for ($i = 0; $i < count($page['crud']['field_value_automatic'][$key]['field']); $i++) {

                            echo "$('input[name=" . $page['crud']['field_value_automatic'][$key]['field'][$i][1] . "]').val(data." . $page['crud']['field_value_automatic'][$key]['field'][$i][0] . ");
 						";
                            echo "$('#" . $page['crud']['field_value_automatic'][$key]['field'][$i][1] . "0').val(data." . $page['crud']['field_value_automatic'][$key]['field'][$i][0] . ");
 						";
                        }
                        ?>
                        $('.select3').select2();
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }
        </script>
    <?php } ?>
<?php } ?>
<?php if (isset($page['crud']['field_value_automatic_sub_kategori'])) {
    foreach ($page['crud']['field_value_automatic_sub_kategori'] as $key => $value) { ?>

        <script>
            function field_value_automatic_sub_kategori_<?= $key; ?>(e, numbering) {
                value = $(e).val();
                $.ajax({
                    type: 'get',
                    data: {
                        'value': value,
                        'field_auto_change': '<?= $key; ?>',
                        '_view': '<?= $page['crud']['view']; ?>',
                        'numbering': numbering,


                        'id': -1,
                        'apps': $('#load_apps').val(),
                        'page_view': $('#load_page_view').val(),
                        'type': 'field_value_automatic_sub_kategori',
                        'contentfaiframework': 'get_pages',
                        'frameworksubdomain': $('#load_domain').val(),
                        "MainAll": 2
                    },
                    url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['field_value_automatic_sub_kategori_' . $key, -1])) . '"') : "$('#load_link_route').val()") ?>,
                    dataType: 'json',
                    success: function(data) {
                        <?php
                        //print_r($page['field_value_automatic'][$key]['field']);die;
                        for ($i = 0; $i < count($page['crud']['field_value_automatic_sub_kategori'][$key]['field']); $i++) {

                            echo "$('input[name=" . $page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$i][1] . "]').val(data." . $page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$i][0] . ");
 						";
                            echo "$('#" . $page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$i][1] . "'+numbering).val(data." . $page['crud']['field_value_automatic_sub_kategori'][$key]['field'][$i][0] . ").trigger('keyup').trigger('change');
 						";
                        }
                        ?>
                        $('.select3').select2();
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }
        </script>
    <?php } ?>
<?php } ?>
<?php if (isset($page['crud']['field_value_automatic_select_target'])) {
    foreach ($page['crud']['field_value_automatic_select_target'] as $key => $value) { ?>

        <script>
            function field_value_automatic_select_target_<?= $key; ?>(e, numberselct) {
                value = $(e).val();
                $.ajax({
                    type: 'get',
                    data: {
                        'value': value,
                        'field_auto_change': '<?= $key; ?>',
                        '_view': '<?= $page['crud']['view']; ?>',
                        'frameworksubdomain': $('#load_domain').val(),
                        "MainAll": 2,
                        "type": "field_value_automatic_select_target",
                        'contentfaiframework': 'get_pages',

                    },
                    url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['field_value_automatic_select_target_' . $key, -1])) . '"') : "$('#load_link_route').val()") ?>,
                    dataType: 'html',
                    success: function(data) {

                        <?php
                        // echo "$('input[name=" . $page['crud']['field_value_automatic_select_target'][$key]['target'] . "]').html(data);
                        // ";
                        echo "$('#" . $page['crud']['field_value_automatic_select_target'][$key]['target'] . "'+numberselct).html(data);
 						";

                        ?>
                        $('.select3').select2();
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }
        </script>
    <?php } ?>
<?php } ?>
<?php if (isset($page['crud']['insert_number_code'])) {
    foreach ($page['crud']['insert_number_code'] as $key => $value) { ?>

        <script>
            var attemp =0;
            var debounceTimeoutinsert_number_code_<?= $key; ?>;
            function insert_number_code_<?= $key; ?>(nomor) {
                clearTimeout(debounceTimeoutinsert_number_code_<?= $key; ?>); // Hapus timeout sebelumnya
                debounceTimeoutinsert_number_code_<?= $key; ?> = setTimeout(() => {
                    call_insert_number_code_<?= $key; ?>(nomor);
                    }, 500); // Delay eksekusi 500 ms
            }
            function call_insert_number_code_<?= $key; ?>(nomor) {
                attemp++;
                if(attemp==1 && ($('#load_type')!='tambah' )){
                    show_insert = 0;
                }else{
                    show_insert =1;

                }
                if(show_insert){
                    
                <?php if (isset($page['crud']['insert_number_code'][$key]['data-parent'])) { ?>

                    parent = $('#<?= $page['crud']['insert_number_code'][$key]['data-parent']; ?>' + nomor).val();
                <?php } ?>
                $.ajax({
                    type: 'get',
                    data: {

                        <?php if (isset($page['crud']['insert_number_code'][$key]['data-parent'])) { ?> 'parent': parent,

                        <?php } ?> 'field_auto_change': '<?= $key; ?>',
                        '_view': '<?= $page['crud']['view']; ?>',
                        'frameworksubdomain': $('#load_domain').val(),
                        "MainAll": 2,
                        "type": "insert_number_code",
                        'contentfaiframework': 'get_pages',
                        'id': -1,
                        'apps': $('#load_apps').val(),
                        'page_view': $('#load_page_view').val(),

                    },
                    url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['insert_number_code' . $key, -1])) . '"') : "$('#load_link_route').val()") ?>,
                    dataType: 'html',
                    success: function(data) {
                        $('#<?=$key;?>'+nomor).val(data);
                    },
                    error: function(error) {
                        console.log('error; ' + eval(error));
                        //alert(2);
                    }
                });
            }
            }
        </script>
    <?php } ?>
<?php } ?>
<?php if (isset($page['crud']['insert_autofield'])) {
    foreach ($page['crud']['insert_autofield'] as $key => $value) { ?>

        <script>
            function insert_autofield_<?= $key; ?>(e) {
                if ($(e).is(':checked')) {
                    $('#<?= $key; ?>0').val('<?= $page['crud']['insert_autofield'][$key] ?>');
                    $('#<?= $key; ?>0').attr('readonly', true);
                } else {
                    $('#<?= $key; ?>0').attr('readonly', false);
                    $('#<?= $key; ?>0').val('');

                }
            }
        </script>
    <?php } ?>
<?php } ?>
<?php if (isset($page['crud']['field_view_sub_kategori'])) {
    foreach ($page['crud']['field_view_sub_kategori'] as $key => $value) { ?>

        <script>
            function field_view_sub_kategori_<?= $key; ?>(e) {
                <?php if ($page['crud']['field_view_sub_kategori'][$key]['type'] == 'get') { ?>
                    value = $(e).val();
                <?php } else { ?>
                    value = $('#<?= $key; ?>0').val();

                <?php } ?>


                //alert();
                var inputs = $(".valueRequest");
                //alert();
                var arrayinput = [];
                var no;
                if (inputs.length) {

                    for (var i = 0; i < inputs.length; i++) {
                        arrayinput.push($(inputs[i]).val());
                    }
                    no = inputs.length;
                } else {
                    no = 0;
                }
                <?php if ($page['crud']['field_view_sub_kategori'][$key]['type'] == 'add') { ?>
                    if (arrayinput.includes(value))
                        alert('Sudah terdapat inputan dengan value yang sama')
                    else {
                    <?php } ?>


                    $.ajax({
                        type: 'get',
                        data: {
                            'value': value,
                            'field_auto_change': '<?= $key; ?>',
                            '_view': '<?= $page['crud']['view']; ?>',
                            '_no': no,
                            'id': -1,
                            'apps': $('#load_apps').val(),
                            'page_view': $('#load_page_view').val(),
                            'type': 'field_view_sub_kategori',
                            'contentfaiframework': 'get_pages',
                            'frameworksubdomain': $('#load_domain').val(),
                            "MainAll": 2,
                            "not_sidebar": "not",

                        },
                        url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['field_view_sub_kategori_' . $key, -1])) . '"') : "$('#load_link_route').val()") ?>,
                        dataType: 'html',
                        success: function(data) {
                            <?php
                            if ($page['crud']['field_view_sub_kategori'][$key]['type'] == 'get') {
                                echo "$('#tablecontentsubkategori-tbody-" . $page['crud']['field_view_sub_kategori'][$key]['target_no'] . "').html(data);";
                            } else {
                                echo "$('#tablecontentsubkategori-" . $page['crud']['field_view_sub_kategori'][$key]['target_no'] . " tr:last').after(data);";
                            }
                            ?>
                            $('.select3').select2();
                        },
                        error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                        }
                    });
                    <?php if ($page['crud']['field_view_sub_kategori'][$key]['type'] == 'add') { ?>
                    }
                <?php } ?>
            }
        </script>
    <?php } ?>
<?php } ?>
<?php
foreach ($page['crud']['array'] as $i => $value) {


    $text = $array[$i][0];
    $field = $array[$i][1];
    $type = $array[$i][2];
    $extype = explode('-', $type);
    if (isset($value[2][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))  and in_array("select", explode('-', $type))) {
?>
        <script>
            $(document).ready(function() {
                $("#<?= $field ?>-1").select2({
                    ajax: {
                        url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['select2_' . $field, -1])) . '"') : "$('#load_link_route').val()") ?>,

                        dataType: 'json',
                        data: (params) => {
                            return {
                                q: params.term,
                            }
                        },
                        processResults: (data, params) => {
                            const results = data.items.map(item => {
                                return {
                                    id: item.id,
                                    text: item.full_name || item.name,
                                };
                            });
                            return {
                                results: results,
                            }
                        },
                    },
                });
            })
        </script>
        <?php
    }
}
if (isset($page['crud']['search'])) {
    foreach ($page['crud']['search'] as $key => $value) {
        if ($key <= -100) {

            $page['crud']['view'] = "tambah";
            $field = $value[2][1] = "search_" . $value[2][1];
            $type = $value[2][2];
            if (isset($value[2][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))  and in_array("select", explode('-', $type))) {
        ?>
                <script>
                    $(document).ready(function() {
                        $("#<?= $field ?>-1").select2({
                            ajax: {
                                url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['select2_' . $field, -1])) . '"') : "$('#load_link_route').val()") ?>,

                                dataType: 'json',
                                data: (params) => {
                                    return {
                                        q: params.term,
                                    }
                                },
                                processResults: (data, params) => {
                                    const results = data.items.map(item => {
                                        return {
                                            id: item.id,
                                            text: item.full_name || item.name,
                                        };
                                    });
                                    return {
                                        results: results,
                                    }
                                },
                            },
                        });
                    })
                </script>
            <?php
            }
        } else if ($key >= 0) {
            $page = $page;
            $page['crud']['view'] = 'search';
            $page['crud']['input_inline'] = '';
            $search_value = 0;
            $search_key   = $key;
            $i = $key;;
            $array = $page['crud']['array'];
            $type = $array[$i][2];
            $typearray = $array[$i][2];

            $extypearray = explode('-', $typearray);
            $page['crud']['type_form_asal'] = $typearray;
            if (isset($value[$i][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))  and in_array("select", explode('-', $type))) {
            ?>
                <script>
                    $(document).ready(function() {
                        $("#<?= $field ?>-1").select2({
                            ajax: {
                                url: <?= ($page['section'] == 'viewsource' ? ('"' . ($fai->route_v($page, $page['route'], ['select2_' . $field, -1])) . '"') : "$('#load_link_route').val()") ?>,
                                dataType: 'json',
                                data: (params) => {
                                    return {
                                        q: params.term,
                                    }
                                },
                                processResults: (data, params) => {
                                    const results = data.items.map(item => {
                                        return {
                                            id: item.id,
                                            text: item.full_name || item.name,
                                        };
                                    });
                                    return {
                                        results: results,
                                    }
                                },
                            },
                        });
                    })
                </script>
<?php
            }
        }
    }
}
?>