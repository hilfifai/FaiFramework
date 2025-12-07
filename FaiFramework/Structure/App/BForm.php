<?php

class BForm{

    public static function form(){
        $page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
				$page['route'] = __FUNCTION__ ;
				$page['layout_pdf'] = array('a4','portait') ;
			   
				$database_utama = "form";
				$primary_key =null;
				
				$array = array(
                     array("Tipe form","tipe_form","select-manual-req",array("board"=>"Board Form","User"=>"User Form")),
                     array("Board","board","select",array("web__list_apps_board",null,"nama_board")),
                     
                    array("Load Apps",null,"text"),
                    array("Load Page View",null,"text"),
                    array("Database Utama",null,"text"),
                    array("Style Form",null,"text"),
                    
                    array("Brosur Form","brosur_form","file",'form'),
                    array("Nama form","nama_form","text-req"),
                    array("Kode form","kode_form","text-req"),
                    array("Deskripsi","deskripsi","textarea-req"),
                    array("Pesan setelah submit","pesan_setelah_submit","textarea-req"),
                    
                    array("Status form","status_form","select-manual-req",array("open"=>"Open","open_jadwal"=>"Open Sesuai Jadwal","close"=>"Close")),
                    array("Link Spreadsheet",null,"text-req"),
                    array("Sheet",null,"text-req"),
                    array("Status approval Proses",null,"text-req"),
                    array("Status approval Update",null,"text-req"),
					 
					  
			   );
			   $sub_kategori[] = ["Form", $database_utama ."__content__class", null, "table"];
			   $form =  $array_sub_kategori[] = array(
                    array("field",null,"text-req"),
                    array("teks",null,"text-req"),
                    array("tampil",null,"select-manual",array("tidak tampil","tampil")),
                    array("multi entitas",null,"select-manual",array("tidak","ya")),
                   
			   );
			   $sub_kategori[] = ["Form", $database_utama ."__content__extend", null, "table"];
			   $array_sub_kategori[] = array(
                    array("Pertanyaan","pertanyaan","text-req"),
                    array("Tipe Form","tipe_form","select",array("webmaster__form__tipe",null,"nama_tipe")),
                    // array("option","option","modalform-subkategori-add",array(
                    //     "type"=>"many",
                    //     "database"=>$database_utama . "__content__option",
                    //     "array"=>array(
                    //             array("Option","option","text-req"),
                    //             array("Deskripsi","deskripsi","text-req"),
                    //             array("urutan option","urutan_option","number"),
                    //             )
                    //     )
                // ),
			   );
			   $sub_kategori[] = ["Form", $database_utama ."__response__extend", null, "table"];
			   $array_sub_kategori[] = array(
                    array(null,"connect_database_utama","text-req"),
                    array(null,"connect_database_id","text-req"),
                    array(null,"respons","text-req"),
                    array(null,"id_extend","select-req",array($database_utama ."__content__extend",null,'pertanyaan')),
			   );
			   $sub_kategori[] = ["Form", $database_utama ."__approval", null, "table"];
			   $array_sub_kategori[] = array(
                    array("Approval Ke",null,"number-req"),
                    array("Group Approval",null,"select",array("web__list_apps_board__role__group",null,"nama_role_group")),
                    array("Tipe Approval",null,"select-manual",array("Proses"=>"Approval Proses","Update"=>"Approval Update")),
                    array("User Approval",null,"select-manual",array("Semua user dalam role"=>"Semua user dalam role","Spesifik user dalam role"=>"Spesifik user dalam role")),
                //     array("option","option","modalform-subkategori-add",array(
                //         "type"=>"many",
                //         "database"=>$database_utama . "__content__approval",
                //         "array"=>array(
                //                     array("Pertanyaan","pertanyaan","text-req"),
                //                     array("Tipe Form","tipe_form","select",array("webmaster__form__tipe",null,"nama_tipe")),
                //                     array("option","option","modalform-subkategori-add",array(
                //                             "type"=>"many",
                //                             "database"=>$database_utama . "__content__approval__option",
                //                             "array"=>array(
                //                                     array("Option","option","text-req"),
                //                                     array("Deskripsi","deskripsi","text-req"),
                //                                     array("urutan option","urutan_option","number"),
                //                                     )
                //                             )
                //                     ),
                //             )
                //         )
                // ),
                   
			   );
			   $sub_kategori[] = ["Open Form", $database_utama ."__open", null, "table"];
			   $array_sub_kategori[] = array(
                    
                    array("Tanggal awal ","tanggal_awal_","date"),
                    array("Jam Awal","jam_awal","time"),
                    array("Tanggal akhir","tanggal_akhir","date"),
                    array("Jam Akhir","jam_akhir","time"),
                    array("Pesan setelah Penutupan Form","pesan_setelah_penutupan_form","textarea-req"),
			   );
			    $page['crud']['sub_kategori'] = $sub_kategori ;
			   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
			   $search = array();
			   
			   $page['crud']['array'] = $array ;
			   $page['crud']['search'] = $search ;
				$page['panel'] = 'form';
				 
				 $page['database']['utama'] = $database_utama;
				$page['database']['primary_key'] = $primary_key ;
				$page['database']['select'] = array("*"); ;
				$page['database']['join'] = array();
				$page['database']['where'] = array();  
				 return $page;
       

    }
    public static function form__response(){
        $page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
				$page['route'] = __FUNCTION__ ;
				$page['layout_pdf'] = array('a4','portait') ;
			   
				$database_utama = "form__response";
				$primary_key =null;
				
				$array = array(
                     array("","form","select",array("form",null,"nama_form")),
                     array("","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
                     array(null,"connect_database_utama","text-req"),
                     array(null,"connect_database_id","text-req"),
                    //  array(null,"tipe_data","select-manual-req",array("array_form"=>"array_form","sub_kategori_form"=>"sub_kategori_form")),
					 
					  
			   );
			  
			   $sub_kategori[] = ["Form", $database_utama ."__extend", null, "table"];
			   $array_sub_kategori[] = array(
                     array(null,"connect_database","text-req"),
                     array(null,"connect_id","text-req"),
                     array(null,"tipe_data","select-manual-req",array("array_form"=>"array_form","sub_kategori_form"=>"sub_kategori_form")),
					 
                    array(null,"respons","text-req"),
                    array(null,"id_extend","select-req",array($database_utama ."__content__extend",null,'pertanyaan')),
			   );
			  
			    $page['crud']['sub_kategori'] = $sub_kategori ;
			   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
			   $search = array();
			   
			   $page['crud']['array'] = $array ;
			   $page['crud']['search'] = $search ;
				$page['panel'] = 'form';
				 
				 $page['database']['utama'] = $database_utama;
				$page['database']['primary_key'] = $primary_key ;
				$page['database']['select'] = array("*"); ;
				$page['database']['join'] = array();
				$page['database']['where'] = array();  
				 return $page;
       

    }
    public static function form__approval__proses(){
        $page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
				$page['route'] = __FUNCTION__ ;
				$page['layout_pdf'] = array('a4','portait') ;
			   
				$database_utama = "form__approval__flow";
				$primary_key =null;
				
				$array = array(
                     array("","form","select",array("form",null,"nama_form")),
                     array(null,"connect_database_utama","text-req"),
                     array(null,"connect_database_id","number-req"),
                     array(null,"proses_selesai","number-req"),
                     array(null,"proses_tunggu","number-req"),
                     array(null,"is_selesai","number-req"),
					 
					  
			   );
			  
			 //  $sub_kategori[] = ["Form", $database_utama ."__response", null, "table"];
			 //  $array_sub_kategori[] = array(
    //                  array(null,"tipe_data","select-manual-req",array("array_form"=>"array_form","sub_kategori_form"=>"sub_kategori_form")),
    //                  array(null,"connect_database","text-req"),
    //                  array(null,"connect_id","text-req"),
					 
    //                 array(null,"respons","text-req"),
    //                 array(null,"id_extend","select-req",array($database_utama ."__content__extend",null,'pertanyaan')),
			 //  );
			   $sub_kategori[] = ["Form", $database_utama ."__proses", null, "table"];
			   $array_sub_kategori[] = array(
                     
                     array("","approval","select",array("form__approval",null,"nama__approval")),
                     array(null,"status_approval","select-manual-req",array("1"=>"Setuju","2"=>"Tolak",3=>"Pending")),
                     array("","apps_user","select",array("apps_user","id_apps_user","nama_lengkap")),
                     array(null,"is_undo","date-req"),
                     array(null,"tanggal_approval","date-req"),
                     array(null,"tanggal_undo_approval","date-req"),
                     array(null,"alasan_tolak","textarea-req"),
                     array(null,"connect_database_id","number-req"),
                     array(null,"connect_database_id","number-req"),
                     array(null,"id_form","number-req"),
			   );
			  
			    $page['crud']['sub_kategori'] = $sub_kategori ;
			   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
			   $search = array();
			   
			   $page['crud']['array'] = $array ;
			   $page['crud']['search'] = $search ;
				$page['panel'] = 'form';
				 
				 $page['database']['utama'] = $database_utama;
				$page['database']['primary_key'] = $primary_key ;
				$page['database']['select'] = array("*"); ;
				$page['database']['join'] = array();
				$page['database']['where'] = array();  
				 return $page;
       

    }
    public static function form_content($page,$i_form,$i_support=0,$type='extend',$is_data=0,$data=array()){
         $sql = "select * from webmaster__form__tipe where active=1";
			$get = DB::query($sql);

			$row_tipe_form = DB::fetchResponse($get);
			
        $content = '
        <div class="card  mb-4">
                		        <div class="card-body">
                		        <div class="row">
                		        <div class="col-md-6">
                		               <label>Nama Form </label>
                		             <input id="pertanyaan-'.$i_form.'" data-id="'.$i_form.'" value="'.($is_data?$data->pertanyaan:'').'" onkeyup="save_text_form_'.$type.'(this,'.$i_form.','.$i_support.')" placeholder="Nama Form" class="form-control">
                		            <div id="form-sync_'.$type.'-'.$i_form.'-'.$i_support.'"></div>
                		        </div>
                		        <div class="col-md-6">
                		        <label>Jenis Form</label>
                		        <select id="pertanyaan-'.$i_form.'" data-id="'.$i_form.'" onchange="save_tipe_form_'.$type.'(this,'.$i_form.','.$i_support.')" class="form-control" > ';
                		        foreach($row_tipe_form as $form){
                		        $content .=' <option value="'.$form->id.'" '.($is_data?(($data->id_tipe_form==$form->id)?'selected':''):'').'>'.$form->nama_form.'</option> ';
                		        }
                		        $content .='         </select>
                		        </div>
                		        </div>
                		         </div>
                    		       <div class="card-footer">
                    		    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked data-field="'.$i_form.'" onclick="save_tampil_'.$type.'(this,'.$i_form.','.$i_support.')">
                                        <label class="onoffswitch-label" for="myonoffswitch">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                    		    </div>
                    		    </div>
        ';
        return $content;
    }
    public static function approval_content($page,$i_approval,$tahap,$is_data=0,$data=array()){
         $sql = "select * from web__list_apps_board__role__group where active=1
        and id_web__list_apps_board =".$page['load']['board']."
        ";
			$get = DB::query($sql);

			$row_group_role = DB::fetchResponse($get);
			$type = "";
        $content_approval="";
                            $content_approval.='
                            <div class="card  mb-4">
		                        <div class="card-body">
		                            <div class="row">
		                              <div class="col-md-4">
		                                     <label>Tahap</label>
		                                     <input  value="'.$tahap.'" class="form-control" readonly onkeyup="change_tahap(this,'.$i_approval.')">
                        		        <div id="form_approval-sync-'.$i_approval.'"></div></div>
                        		        <div class="col-md-4">
		                                    <label>Group Approval</label>
		                                    <select class="form-control"  onchange="change_group_approval(this,'.$i_approval.')" onclick="change_group_approval(this,'.$i_approval.')" > ';  
		                                    foreach($row_group_role as $group){
		                                        $content_approval .=' <option value="'.$group->id.'" '.($is_data?($data->id_group_approval==$group->id?'selected':''):'').'>'.$group->nama_role_group.'</option> ';
		                                    }
		                                    $content_approval .=
                            '         </select>
    		                              </div>
                            		        <div class="col-md-4">
    		                                  <label>Nama Approval</label>
    		                                  <input value="'.($is_data?$data->nama_approval:'').'" placeholder="Nama Approval" onkeyup="change_nama_approval(this,'.$i_approval.')" onclick="change_nama_approval(this,'.$i_approval.')" onmouseover="change_nama_approval(this,'.$i_approval.')" class="form-control">
    		                              </div>
    		                              <div class="col-md-4">
                             		            <label>Tipe Approval</label>
                            		            <select name="" class="form-control"  onchange="change_tipe_approval(this,'.$i_approval.')" onclick="change_tipe_approval(this,'.$i_approval.')">
                               		        <option '.($is_data?($data->tipe_approval=='Semua user dalam role'?'selected':''):'').'>
                                		            Semua user dalam role
                                		        </option>
                                		        <option '.($is_data?($data->tipe_approval=='Spesifik user dalam role'?'selected':''):'').'>
                                		            Spesifik user dalam role
                                		        </option>
                                		    </select>
                        		        </div>
                        		         <div class="col-md-4">
    		                                  <label>Bisa Edit Form?
    		                                  ini bisa juga di form extend nge ubah field utama..
    		                                  </label>
    		                                  <input value="'.($is_data?$data->nama_approval:'').'" placeholder="Nama Approval" onkeyup="change_nama_approval(this,'.$i_approval.')" onclick="change_nama_approval(this,'.$i_approval.')" onmouseover="change_nama_approval(this,'.$i_approval.')" class="form-control">
    		                              </div>
                        		    </div>
                        		    </div>
                        		    </div>
                        		    <div style="margin-left:20px; margin-bottom:20px">
                            		        <div class=" "  id="content-form-approval-'.$i_approval.'">
                            		        ';
                            		        if($is_data){
                            		               DB::table('form__content__extend');
                                            		DB::whereRaw("id_form=$data->id_form");
                                            		DB::whereRaw("id_approval =$i_approval");
                                            		$row_extend = DB::get('all');
                                                  	if($row_extend['num_rows']){
                                                      	foreach($row_extend['row'] as $data_extend){
                                                      	    $content_approval .=BForm::form_content($page,$data_extend->id,$i_approval,'approval',1,$data_extend);
                                                      
                                                      	}
                                                  	}
                                              	}
                            		        $content_approval.='
                                		    </div>
                                		        <button class="btn btn-primary" onclick="add_form_approval('.$i_approval.')">
                                		            Tambah Form Tahap '.$tahap.' 
                                		        </button>
                                              </div>
                                             
                            ';
                            return $content_approval;
    }
    public static function update_utama($page){
        $id_form = Partial::input('id_form');
        $field = Partial::input('field');
        $content = Partial::input('content');
        
		
        $sqli_update[$field] = $content;
		$fai = new MainFaiFramework();
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form", "id",  $id_form);
        echo '1';
        die;
    }
    public static function add_approval($page){
        $id_form = Partial::input('id_form');
        DB::table('form__approval');
		DB::selectRaw("max(approval_ke::int)");
		DB::whereRaw("id_form=$id_form ");
		DB::whereRaw("active=1 ");
		$row = DB::get('all');
		
        $sqli['id_form'] = $id_form;
        $sqli['approval_ke'] = (int) ($row['row'][0]->max)+1;
		$fai = new MainFaiFramework();
        $save = CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "form__approval", array(),array());
        $content['text'] = BForm::approval_content($page,$save['last_insert_id'],$save['sqli']['approval_ke']);
        echo json_encode($content);
        die;
    }
    public static function add_from_extend($page){
        $id_form = Partial::input('id_form');
        $sqli['id_form'] = $id_form;
		$fai = new MainFaiFramework();
        $save = CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "form__content__extend", array(),array());
        $content['text'] = BForm::form_content($page,$save['last_insert_id'],0,'extend');
        echo json_encode($save);
        die;
    }
    public static function add_form_approval($page){
        $id_form = Partial::input('id_form');
        $id_approval = Partial::input('id_approval');
        $sqli['id_form'] = $id_form;
        $sqli['id_approval'] = $id_approval;
		$fai = new MainFaiFramework();
        $save = CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "form__content__extend", array(),array());
        $content['text'] = BForm::form_content($page,$save['last_insert_id'],$id_approval,'approval');
        echo json_encode($content);
        die;
    }
    public static function save_nama_approval($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $iex  = Partial::input('id');
       $fai = new MainFaiFramework();
			
			
        $sqli_update['nama_approval'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__approval", "id",  $iex);
        echo '1';
        die;
        
        die;
    }
    public static function save_group_approval($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $iex  = Partial::input('id');
       $fai = new MainFaiFramework();
			
			
        $sqli_update['id_group_approval'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__approval", "id",  $iex);
        echo '1';
        die;
        
        die;
    }
    public static function save_tipe_approval($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $iex  = Partial::input('id');
       $fai = new MainFaiFramework();
			
			
        $sqli_update['tipe_approval'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__approval", "id",  $iex);
        echo '1';
        die;
        
        die;
    }
    public static function save_text_form_extend($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $iex  = Partial::input('iex');
       $fai = new MainFaiFramework();
			
			
        $sqli_update['pertanyaan'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__content__extend", "id",  $iex);
        echo '1';
        die;
        
        die;
    }
    public static function save_tipe_form_extend($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $iex  = Partial::input('iex');
        $fai = new MainFaiFramework();
			
			
        $sqli_update['id_tipe_form'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__content__extend", "id",  $iex);
        echo '1';
        die;
        
        die;
    }
    public static function save_text_form_class($page){
      
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $field  = Partial::input('field');
        DB::table('form__content__class');
		DB::whereRaw("id_form=$id_form and field='$field'");
		$row = DB::get('all');
	 $fai = new MainFaiFramework();
        if(!$row['num_rows']){
			    $sqli['id_form'] = $id_form;
			    $sqli['teks'] = $content;
			    $sqli['field'] = $field;
			    CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "form__content__class", array(),array());
			    
    			 DB::table('form__content__class');
        		DB::whereRaw("id_form=$id_form and field='$field'");
        		$row = DB::get('all');
			}
			
			
        $sqli_update['teks'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__content__class", "id",  $row['row'][0]->id);
        echo '1';
        die;
        
        die;
    }
    public static function save_tampil_class($page){
        $id_form = Partial::input('id_form');
        $content = Partial::input('content');
        $field  = Partial::input('field');
        DB::table('form__content__class');
		DB::whereRaw("id_form=$id_form and field='$field'");
		$row = DB::get('all');
	 $fai = new MainFaiFramework();
        if(!$row['num_rows']){
			    $sqli['id_form'] = $id_form;
			    $sqli['tampil'] = (int) $content;
			    $sqli['field'] = $field;
			    CRUDFunc::crud_save($fai, $page, $sqli, array(), array(), "form__content__class", array(),array());
			    
			 DB::table('form__content__class');
    		DB::whereRaw("id_form=$id_form and field='$field'");
    		$row = DB::get('all');
			}
			
			
        $sqli_update['tampil'] = $content;
       
        $return = CRUDFunc::crud_update($fai, $page, $sqli_update, array(), array(), array(), "form__content__class", "id",  $row['row'][0]->id);
        echo '1';
        die;
        
        die;
    }
    public function board(){
        $page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
				$page['route'] = __FUNCTION__ ;
				$page['layout_pdf'] = array('a4','portait') ;
			   
				$database_utama = "form__board";
				$primary_key =null;
				
				$array = array(
                    array("Nama form","nama_form","text-req"),
                    array("Deskripsi","deskripsi","textarea-req"),
                    array("Pesan setelah submit","pesan_setelah_submit","textarea-req"),
                    array("Tanggal awal ","tanggal_awal_","date"),
                    array("Jam Awal","jam_awal","time"),
                    array("Tanggal akhir","tanggal_akhir","date"),
                    array("Jam Akhir","jam_akhir","time"),
                    array("Pesan setelah Penutupan Form","pesan_setelah_penutupan_form","textarea-req"),
                    array("Brosur Form","brosur_form","file"),
					 
					  
			   );
			   $search = array();
			   
			   $page['crud']['array'] = $array ;
			   $page['crud']['search'] = $search ;
				$page['panel'] = 'form';
				 
				 $page['database']['utama'] = $database_utama;
				$page['database']['primary_key'] = $primary_key ;
				$page['database']['select'] = array("*"); ;
				$page['database']['join'] = array();
				$page['database']['where'] = array();  
				 return $page;
       

    }
    public function section(){
        $page['title'] = ucwords(str_replace("_"," ",__FUNCTION__)) ;
				$page['route'] = __FUNCTION__ ;
				$page['layout_pdf'] = array('a4','portait') ;
			   
				$database_utama = "form__section";
				$primary_key =null;
				
				$array = array(
                    array("Nama section","nama_section","text-req"),
                    array("Urutan section","urutan_section","number"),
                    array("Deskripsi section","deskripsi_section","textarea-req"),
					  
			   );

               $sub_kategori[] = ["Form", $database_utama ."__form", null, "table"];
			   $array_sub_kategori[] = array(
                    array("Pertanyaan","pertanyaan","text-req"),
                    array("Tipe Form","tipe_form","select",array("webmaster__form__tipe",null,"nama_tipe")),
                    array("option","option","modalform-subkategori-add",array(
                        "type"=>"many",
                        "database"=>$database_utama . "__form_option",
                        "array"=>array(
                                array("Option","option","text-req"),
                                array("Deskripsi","deskripsi","text-req"),
                                array("urutan option","urutan_option","number"),
                                )
                        )
                ),
			   );
              
			   
			   $page['crud']['sub_kategori'] = $sub_kategori ;
			   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;

			   $search = array();
			   
			   $page['crud']['array'] = $array ;
			   $page['crud']['search'] = $search ;
				
				 
				 $page['database']['utama'] = $database_utama;
				$page['database']['primary_key'] = $primary_key ;
				$page['database']['select'] = array("*"); ;
				$page['database']['join'] = array();
				$page['database']['where'] = array();  
				 return $page;
       

    }
    public function response(){
       

        //sub option
       

    }
}