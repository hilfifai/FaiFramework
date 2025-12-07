<?php

 use Illuminate\Support\Arr;

class Auth
{

	public static function login_page_1($page)
	{
		$page['load']['login-template'] = "soft-ui";
		$page['load']['login-database'] = "apps_user";
		$page['load']['login-row'] = array("primary_key" => "id_apps_user", "step" => "daftar_step");
		$page['load']['login-session-utama'] = array("session_name" => "id_apps_user", "database_row" => "id_apps_user");
		$page['load']['login-session'] = array(
			array("session_name" => "hak_akses", "type" => "database", "database_row" => "akses"),
			array("session_name" => "as", "type" => "string", "text" => "user"),
			array("session_name" => "id_organisasi", "type" => "string", "text" => ""),
			array("session_name" => "id_program", "type" => "string", "text" => ""),
		);
		$page['load']['login-array'] = array(
			"field" => array("username" => array("username", "email"), "password" => array("password")),
			"content" => array(
				"TOP" => array(
					array("type" => "text", "content" => '<div class="row justify-content-center">
										
										<div class="col-lg-5 text-center mx-auto">
										<img src = "'.Bundlecontent::router($page, 'content', [], 'BE3-LOGO').'" style="width:150px">
												<h1 class=" mb-2 mt-5">Welcome!</h1>
												<p class="text-lead ">Welcome to '.((isset($page['utama']))?$page['utama']['row'][0]->meta_title:'').'</p>
											</div>
										</div>')
				),
				"TITLE" => array(

					array("type" => "text", "content" => "<h3 class='mb-2 text-center'>LOGIN</h3>"),
					array("type" => "text", "content" => '<p class="mb-4 text-center"></p>'),
				),
				"BUTTON_CLASS" => array(
					array("type" => "text", "content" => 'btn bg-primary w-100'),
				)
			)

		);
		//<div class="row justify-content-center">


		$page['load']['login-daftar-hak_akses'] = "user";
		$page['load']['login-daftar-array'] = array(
			"type" => "wizard",
			"first" => "1",
			"step" => array(
				"1" => array(
					"var_content" => "form_utama",
					"next" => 3,
					"view" => "crud",
					"function_crud" => array(
						"form_type" => ("2"),
						"diferent_value" => array("id_apps_user"),
						"verification_code" => array(
							array(
								"row" => "email_verifikasi_kode",
								"send" => array("email", "no_wa"),
								"email" => "<html>Kode Veritifikasi Email Anda Adalah <GET-CODE></GET-CODE>",
								"wa" => "*Kode Vertifikasi*"
							)
						),
						"unique_value" => array(
							"list_field" => array("email", "username"),
							"email" =>
							array(
								"database" => array(
									"utama" => $page['load']['login-database'],
									"primary_key" => $page['load']['login-row']['primary_key'],
								)
							),
							"username" => array(
								"database" => array(
									"utama" => $page['load']['login-database'],
									"primary_key" => $page['load']['login-row']['primary_key'],
								)
							)
						)

					),

					"submit" => array(
						"type" => "insert",
						"default" => array(
							'id_apps_user' => "NOWDATETIME::YmdHis|" . "RAND::10000-999999|",
							'daftar_step' => 1,
							'status'      					=> 'daftar',

							"email_verifikasi_kode"			=> "RAND::10000-999999|",
						)
					),
					"content" => array(
						"TOP" => array(
							array("type" => "logo", "content" => Bundlecontent::router($page, 'content', [], 'BE3-LOGO')),
							array("type" => "text", "content" => "<h4 class='mb-4 text-center'>Welcome to ".((isset($page['utama']))?$page['utama']['row'][0]->meta_title:'')."</h4>")
						),
						"BUTTON_CLASS" => array(
							array("type" => "text", "content" => 'btn bg-gradient-success w-100'),
						),
						"TITLE" => array(
							array("type" => "text", "content" => "<h3 class='mb-2 text-center'>Register</h3>"),
							array("type" => "text", "content" => '<p class="mb-4 text-center"></p>'),
						)
					)

				),
				"2" =>
				array(
					"var_content" => "email_vertification", "view" => "get_code",
					"get_code" => array(
						"total_number" => 6,
						"row" => "email_verifikasi_kode"
					),
					"submit" => array(
						"type" => "update",
						"database_row_where" => "id_apps_user",
						"session_value_where" => "id_apps_user",

						"default" => array(
							'daftar_step' => 2,
							'email_verifikasi'      					=> 'sudah',
							'email_verifikasi_kode'  					=> ""
						)
					),
					"content" => array(
						"TOP" => array(
							array("type" => "logo", "content" => Bundlecontent::router($page, 'content', [], 'BE3-LOGO')),
							array("type" => "text", "content" => "<h4 class='mb-4 text-center'>Welcome to ".((isset($page['utama']))?$page['utama']['row'][0]->meta_title:'')."</h4>")
						),
						"TITLE" => array(

							array("type" => "text", "content" => "<h3 class='mb-2 text-center'>Email Vertication</h3>"),
							array("type" => "text", "content" => '<p class="mb-4 text-center"></p>'),
						)
					)
				),
				"3" => array(
					"var_content" => "detail",
					"view" => "crud",
					"next" => 4,
					"function_crud" => array(
						"form_type" => ("2"),
						"crud_inline" => array("nama_lengkap" => "width: 100%;border: 0;border-bottom: 1px dotted;font-size: 20px;outline: 0;font-weight: bold;"),
						"sub_kategori" => array(
							["Alamat",  "inventaris__asset__tanah__bangunan", null, "form"]
						),
						"array_sub_kategori" => array(
							array(

								array("Nama Unit Bangunan", "nama_unit_bangunan", "text"),
							//	array("Blok Tanah", "blok_tanah", "select", array("inventaris__asset__tanah", null, "penamaan_tanah")),
								// array("Deskripsi", "deskripsi", "text"),
								array("Alamat", "alamat", "textarea"),
								array("Nomor Bangunan", "nomor_bangunan", "number"),
								array("RT", "rt", "number"),
								array("RW", "rw", "number"),
								array("Provinsi", "id_provinsi", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
								array("Kota", "id_kota", "select-ajax"),
								array("Kecamatan", "id_kecamatan", "select-ajax"),
								array("Kelurahan", "id_kelurahan", "select-ajax"),
								array("Patokan", "patokan", "text"),



								// array("Tipe Unit", "tipe_unit", "select-manual", array("Kontrakan" => "Kontrakan", "Apartemen" => "Apartemen", 'Rumah' => 'Rumah', 'Pabrik' => "Pabrik", "Ruko", "Vila", "Kantor" => "Kantor", "Gedung" => "Gedung", "Istana" => "Istana", "Tempat Wisata" => "Tempat Wisata", "Museum/Situs" => "Museum/Situs")),
								// array("Jumlah Lantai", "jumlah_lantai", "text"),
								// array("Keterisian Bangunan", "keterisian_bangunan", "select-manual", array("kosong" => "Bangunan Kosong", "fungsi" => "Bangunan Fungsi")),
								// array("Fungsi Bangunan", "fungsi_bangunan", "select-manual", array("bangunan_kontrak" => "Kontrakan/Kosan", "operasional_kantor" => "Operasional Kantor", "bangunan_keluarga" => "Bangunan Huni keluarga")),
								// array("Tipe Kepemilikan Bangunan", "tipe_kepemilikan_bangunan", "select-manual", array("pribadi" => "Milik Pribadi", "keluarga" => "Milik Keluarga", "orang_lain" => "Milik Diluar Keluarga",  "organisasi" => "Organisasi/Perusahaan", "pemerintah" => "Pemerintah")),
								// array("Kepemilikan Bangunan", "kepemilikan_bangunan", "select-ajax"),
							)
						),
					    'no_action'=>array(
					        "inventaris__asset__tanah__bangunan" => true
					   ),
						"oninsert_sub_kategori" => array(
							array(
								"table_sub_kategori" => "inventaris__asset__tanah__bangunan",

								

								"first_proses" => "insert",
								"proses" => array("insert"),
								"insert" => array(
									"tipe" => "insert",
									"table_insert" => "inventaris__asset__tanah__bangunan__pengisi",
									"field" => [ array("id_apps_user", "{SESSION_UTAMA_DAFTAR}", "string_database"),	
												 array("id_inventaris__asset__tanah__bangunan", "", "last_id_sub_kategori"),
												 array("default_pembelian_barang", "1", "text")
												],
								
								)

							)
						),

						"update_default_value" => array("daftar_step" => 3),
						"unique_value" => array(
							"list_field" => array("apps_id"),
							"apps_id" =>
							array(
								"database" => array(
									"utama" => $page['load']['login-database'],
									"primary_key" => $page['load']['login-row']['primary_key'],
								)
							),

						),
						"value_input_database" => array("nama_lengkap" => array(
							"database" => array(
								"utama" => "apps_user",
								"primary_key" => "id_apps_user",
								"where" => array(
									array("id_apps_user", "=", "!!!session:utama_daftar???")
								)
							),
							"row_value" => "nama_lengkap"

						)),


						"wizard_form" => array(
							"list_field" => array("id_provinsi", "id_kota", "id_kecamatan"),
							"id_provinsi" => array(

								"row_to_database" => array(
									"utama" => "webmaster__wilayah__kabupaten",
									"primary_key" => "kota_id",
								),
								"get_where" => "provinsi_id",
								"id_result_to" => "id_kota",
								"output_row" => array(
									"value" => "kota_id",
									"prefix" => array(
										array("type" => "database", "text" => "type"),
										array("type" => "text", "text" => " ")
									),
									"text" => "kota_name"
								)
							),
							"id_kota" => array(

								"row_to_database" => array(
									"utama" => "webmaster__wilayah__kecamatan",
									"primary_key" => "subdistrict_id",
								),
								"id_result_to" => "id_kecamatan",
								"get_where" => "kota_id",
								"output_row" => array(
									"value" => "subdistrict_id",

									"text" => "subdistrict_name"
								)
							),
							"id_kecamatan" => array(

								"row_to_database" => array(
									"utama" => "webmaster__wilayah__postal_code",
									"primary_key" => "id",
								),
								"id_result_to" => "id_kelurahan",
								"get_where" => "kecamatan_id",
								"output_row" => array(
									"value" => "id",
									"sufix" => array(
										array("type" => "text", "text" => "("),
										array("type" => "database", "text" => "postal_code"),
										array("type" => "text", "text" => ")")
									),
									"text" => "urban"

								)
							),
						),
					),
					"submit" => array(
						"type" => "update",
						"database_row_where" => "id_apps_user",
						"session_value_where" => "id_apps_user_daftar",
						"default" => array(
							'daftar_step' => 3,

						)
					),
					"content" => array(
						"TOP" => array(
							array("type" => "logo", "content" => Bundlecontent::router($page, 'content', [], 'BE3-LOGO')),
							array("type" => "text", "content" => "<h4 class='mb-4 text-center'>Welcome to ".((isset($page['utama']))?$page['utama']['row'][0]->meta_title:'')."</h4>")
						),
						"TITLE" => array(

							array("type" => "text", "content" => "<h3 class='mb-2 text-center'>Detail Account</h3>"),
							array("type" => "text", "content" => '<p class="mb-4 text-center"></p>'),
						)
					)
				),
				"4" => array(
					"var_content" => "welcome", "view" => "view", "content" => array(
						"TOP" => array(
							array("type" => "logo", "content" => Bundlecontent::router($page, 'content', [], 'BE3-LOGO')),
							array("type" => "text", "content" => "<h4 class='mb-4 text-center'>Welcome to ".((isset($page['utama']))?$page['utama']['row'][0]->meta_title:'')."</h4>")
						),
						"TITLE" => array(

							array("type" => "text", "content" => "<h5 class='mb-2 p-3 text-center'>Selamat! Pendaftaran Anda Berhasil.</h5><div class='text-center'>Terima kasih telah mendaftar! Kami sangat senang Anda bergabung bersama kami.  <Br><Br>"),
							// array("type" => "text", "content" => '<p class="mb-4 text-center">Hibe3 merupakan sebuah sosial media management organisasi, dengan Hibe3 semua aplikasi terdapat dalam satu laman.</p>'),
							array("type" => "button", "array" => array("a", "Start Journey", 'text', false, array("Auth", "daftar_to_login", "", -1,"route_type"=>"just_link"),"just_link")),
						)
					)
				)
			),
			"content" => array(
				"form_utama" => array(
					array("Nama Lengkap", "nama_lengkap", "text-r"),
					array("Email", "email", "email-r"),
					array("Username", "username", "text-r"),
					array("Password", "password", "password-r")
				),
				"detail" => array(
					array("File", "file", "picture-upload"),
					array("Nama Lengkap", "nama_lengkap", "contenteditable"),
					array("Display Status", "display_status", "contenteditable"),
					array("Apps ID", "apps_id", "text"),
					array("Nama Panggilan", "nama_panggilan", "multiple-tag"),
					array("Jenis Kelamin", "jenis_kelamin", "radio2-manual", array("Pria" => "Pria", "Wanita" => "Wanita")),
					array("Agama", "agama", "select-selectoption"),
					array("No HP", "nomor_handphone", "number"),
					array("Koneksi WA", "connection_wa", "checkbox-manual", array("1" => "Apakah Nomor ini terdaftar di Whatapps? ")),
					array("Tempat Lahir", "tempat_lahir", "text"),
					array("Tanggal Lahir", "tanggal_lahir", "date"),
				// 	array("Tempat Lahir", "tempat_lahir", "text"),
					// 	array("Alamat", "alamat_domisili", "textarea"),
					// 	array("Provinsi", "id_provinsi_domisili", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi")),
					// 	array("Kota", "id_kota_domisili", "select-ajax"),
					// 	array("Kecamatan", "id_kecamatan_domisili", "select-ajax"),
					// 	array("Kelurahan", "id_kelurahan_domisili", "select-ajax"),
				),
			),
		);
	
		return $page;
	}
	public static function daftar_to_login(){
		$_SESSION['id_apps_user']= $_SESSION['id_apps_user_daftar'];
		$_SESSION['hak_akses'] ='user';
		$_SESSION['login']=true;
		$_SESSION['is_login']=true;
		//print_r($_SESSION);
		redirect(base_url());
	
	}public static function change_role_board($page,$id)
	{
	    
	     $id_board= Partial::input('id_board');
	     $id_role= Partial::input('id_role');
	     $_SESSION['board_role-'.$id_board] = $id_role;
		 MainFaiFramework::board_role_default($page,$id_board,$id_role);
	     echo "<script>  window.location.href='".(Partial::link_direct($page,base_url().'pages/',array("Workspace","admin",'list',-1,-1,-1,$page['load']['board'])))."';</script>";
	     die;
	}public static function change_panel($page,$id)
	{
	   DB::connection($page);
	   DB::queryRaw($page,"select * from panel where id=$id");
	   $panel = DB::get('all');
	   $hak_akses = $_SESSION['hak_akses'] = $panel['row'][0]->panel;
	   if($hak_akses!='user')
	   $_SESSION['id_organisasi'] = $panel['row'][0]->id_organisasi;
	   else
	   $_SESSION['id_organisasi'] = null;
		redirect(base_url()); 
		die;
	   
	}public static function logout()
	{
		session_destroy();
		redirect(base_url());
	}
}
