<div class="">
    <nav class="navbar navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl card card-body blur" style="padding: 15px;">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0"><?=$fai['title_page'];?></h6>
                <?=isset($fai['sub_title_page'])?'<div class="text-muted text-small">'.$fai['sub_title_page'].'</div>':'';?>
                <?php if(isset($fai['breadcumb']['nama_page'][0])){?>
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            		<?php for($i=0;$i<count($fai['breadcumb']['nama_page']);$i++){?>
                    <li class="breadcrumb-item text-sm"><a class="<?=$fai['breadcumb']['disable'][$i]?'opacity-5 text-dark':'';?>" href="<?=$fai['breadcumb']['link'][$i]?>"><?=$fai['breadcumb']['nama_page'][$i]?></a></li>
            		<?php }?>
                   
                </ol>
                <?php }?>
            </nav>
            <div class=" navbar-collapse mt-sm-4 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-md-end justify-content-md-start " style="flex-direction: row;">


                    <li class="nav-item px-3 ps-0 d-flex align-items-center" >
                        <button class="btn btn-icon btn-2 btn-success" style="padding: 0.5rem" type="button" onclick="searchButton(this)" data-visible="false">
                            <span class="btn-inner--icon"><i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </i></span>
                        </button>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-icon btn-2 btn-success" style="padding: 0.5rem" type="button"  onclick="filterButton(this)" data-visible="false">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5" />
                                    </svg></i></span>
                        </button>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-icon btn-2 btn-success" style="padding: 0.5rem" type="button" onclick="changeView('ViewListTables')">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="3" y="4" width="18" height="8" rx="3" />
                                        <rect x="3" y="12" width="18" height="8" rx="3" />
                                        <line x1="7" y1="8" x2="7" y2="8.01" />
                                        <line x1="7" y1="16" x2="7" y2="16.01" />
                                    </svg></i></span>
                        </button>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-icon btn-2 btn-success " style="padding: 0.5rem" type="button"onclick="changeView('ViewVertical')">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="4" y="4" width="16" height="6" rx="2" />
                                        <rect x="4" y="14" width="16" height="6" rx="2" />
                                    </svg></i></span>
                        </button>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <button class="btn btn-icon btn-2 btn-success" style="padding: 0.5rem" type="button" onclick="changeView('ViewHorizontal')">
                            <span class="btn-inner--icon"><i><svg style="width: 15px;height: 15px;" xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" fill="white" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="4" y="4" width="6" height="6" rx="1" />
                                        <rect x="14" y="4" width="6" height="6" rx="1" />
                                        <rect x="4" y="14" width="6" height="6" rx="1" />
                                        <rect x="14" y="14" width="6" height="6" rx="1" />
                                    </svg></i></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div style="width: 100%;padding: 0px 28px 10px 15px !important;" class="pt-sm-0">

            <div id="filterContent" style="display: none">
            	<form id="filterform" action="#">
                <div class="row">
                
                <?php 
                if(isset($fai['filter'][0]['master']['nama_filter'])){
                	for($i=0;$i<count($fai['filter']);$i++){
                ?>
                    <div class="<?=$fai['filter'][$i]['master']['col_grid'];?>">

                        <label class="form-label  col-form-label">
                            <?=$fai['filter'][$i]['master']['nama_filter'];?>
                        </label>
                        <select class="form-control " name="datafilter[<?=$fai['filter'][$i]['master']['name_input'];?>]" required="">
                            <option value="">
                                - <?=$fai['filter'][$i]['master']['nama_filter'];?> -
                            </option>
                            <?php 
                            	if($fai['filter'][$i]['master']['type_data_select']=='manual'){
                            		for($j=0;$j<count($fai['filter'][$i]['filter_field']['value']);$j++){
                            			
                            ?>
                            <option value="<?=($fai['filter'][$i]['filter_field']['value'][$j])?>">
                                <?=($fai['filter'][$i]['filter_field']['option'][$j])?>
                            </option>
                            <?php 
                            		}
                            	}else if($fai['filter'][$i]['master']['type_data_select']=='database'){
                            		$query = $get_ci->db->query($fai['filter'][$i]['filter_database']['query'])->result();
                            		foreach($query as $data){
                            			$id =$fai['filter'][$i]['filter_database']['value'];
                            			$option =$fai['filter'][$i]['filter_database']['option'];
                            			
                            ?>
                            <option value="<?=$data->$id?>">
                                <?=$data->$option;?>
                            </option>
                            <?php 
                            		}
                            	}?>
                            
                        </select>

                    </div>
                    <?php }}?>
                    
                </div>
                </form>
                <button class="btn btn-success"  onclick="load_data()" type="button">Filter</button>
            </div>
            <div id="searchContent" class="pt-2" style="display:none">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type here"  id="searchID">
                    <BUTTON class="input-group-text text-body" onclick="load_data()" type="button"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></i></BUTTON>
                </div>
            </div>
        </div>
    </nav>
    <input id="total_record" value="<?=$main_row->num_rows()?>" style="display: none">
    <input id="limit_page" value="<?=$fai['limit_page']?>" style="display: none">
   
</div>
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div id="contentList"></div>
    
</div>


<script>
	var  page = 1;
	var  view = "ViewHorizontal";
	var  numbeArrayEdit = 0;
    $.xhrPool = [];
	function gantipage(numberpage)
	{
		//alert();
		var TotalView = document.getElementById("total_record").value;
		pageBefore = page;
		page = numberpage;
	}
	function searchButton(e){
		if($(e).attr("data-visible")=='false'){
			$('#searchContent').show();
			$(e).attr("data-visible",true);
		}else{
			$('#searchContent').hide();
			$(e).attr("data-visible",false);
			
		}
		$('#searchID').val('');;
		page = 1;
	}
	function filterButton(e){
		if($(e).attr("data-visible")=='false'){
			$('#filterContent').show();
			$(e).attr("data-visible",true);
		}else{
			$('#filterContent').hide();
			$(e).attr("data-visible",false);
			
		}
		$('#searchID').val('');;
		page = 1;
	}
	function changeView(varview){
		view = varview;
		$('#searchID').val('');;
		load_data();
	}
	load_data();
	function load_data(){
        alert();
		$.xhrPool1.abortAll = function() {
		each(this, function(jqXHR) {
		  jqXHR.abort();
		});
	  };
		//window.location.href
		var Url3=window.location.href ;
		
		//alert(Url3);
		$.ajax(
			{
				url: Url3,
				data:
				{
					jumlah: $('#limit_page').val(),
					total_record: $('#total_record').val(),
					datasearch: $('#searchID').val(),
					datafilter: $('#filterform').serializeArray(),
					page_fai: view,
					page: page,
									"MainAll":2
				},
				type: "post" ,
				dataType: "HTML",
				
				success: function (response,textStatus,xhr)
				{
					$('#contentList').html(response);
					eachDe();
				},
				error: function(error)
				{

					console. log(' Error '+error )
				}, beforeSend: function (jqXHR) {
                    $.xhrPool1.push(jqXHR);
                }
			})
	}
</script>