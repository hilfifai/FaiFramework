<?php 
$page['crud']['type'] ='list';
echo CrudContent::list_table($page, $fai,"","","");
// include dirname(__FILE__).'/../../../Pages/crud/list.blade.php';
echo '
@push("script")

';

echo '<script>
          
        var table = $("#example1").DataTable({
            "processing": true,
	        "serverSide": true,     
	        "ajax": {
                "url": "<?=url("/'.$fai->nama_function($page, $page['title']).'/datatable/-1/");?>",
                "dataType": "json",
                "type": "get",
                "data":function(d){
			            d.create_awal =$("#create_awal").val();
			            d.create_akhir = $("#create_akhir").val();
                        ';
                        $array = $page['crud']['array'];
                        $array_temp = $array;
                        foreach ($page['crud']['search'] as $key => $value) {
                            if ($key <= -100) {
                                $page['crud']['view'] = "tambah";
				$field = $value[2][1] = "search_" . $value[2][1];
				$type = $value[2][2];
				if (isset($value[2][3]) and !in_array("manual", explode('-', $type)) and in_array("select", explode('-', $type))  and in_array("select", explode('-', $type))) {
                                 echo '
                                 d.'.$field.' = $("#'.$field.'-1").val();
                                 ';
                            }
                            }else if($key>=0){
                                $i = $key;;
                                $array = $array_temp;
                                $typearray = $array[$i][2];

                                $extypearray = explode('-', $typearray);
                                $page['crud']['type_form_asal'] = $typearray;
                                if ($extypearray[0] == 'date') {
                                    echo '
                                        d.'. $array[$i][1] . '_dari'.' = $("#'. $array[$i][1] . '_dari'.'-1").val();
                                        d.'. $array[$i][1] . '_sampai'.' = $("#'. $array[$i][1] . '_sampai'.'-1").val();
                                    ';
                                } else {
                                    echo '
                                        d.'. $array[$i][1] . ''.' = $("#'. $array[$i][1] . ''.'-1").val();
                                    ';
                                }
                            }
                        }
                        echo '
			        }
                
               
            },
            "destroy" : true,
            //"responsive": true,
            "paging": true,
            
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "scrollX": true,
            "info": true,
            "scroller": true,
            "autoWidth": true,
            "order": [
                [1, "desc"]
            ],
            //"deferLoading": 57,
            //lengthMenu: [
              //  [10, 25, 50, 100, -1],
                //[10, 25, 50, 100, "All"],
            //],
            
            //"dom": "t<"col-sm-6"li><"col-sm-6"p>",
            columns: [
            {
                    data: "no",
                    name: "no"
                },
            ';
		for ($i = 0; $i < count($page['crud']['array']); $i++) {
					$field = $page['crud']['array'][$i][1];
					
					echo '
                {
                    data: "' . $field . '",
                    name: "' . $field . '"
                },';
				}
				?>
				
            	
                {
                    data: "aksiView",
                    name: "aksiView"
                },
                {
                    data: "aksiEdit",
                    name: "aksiEdit"
                },
                {
                    data: "aksiDelete",
                    name: "aksiDelete"
                }
            ],
            
									
												
            
            


        });

        //disable sorting kolom nomor urut
        table.on("order.dt search.dt", function() {
            table.column(0, {
                search: "applied",
                order: "applied"
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

       

        $("#btn-reload").click(function() {
		
            table.ajax.reload();
        });
      </script>
      @endpush