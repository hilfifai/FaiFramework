<?php


class viewLayout
{

    public static function listing()
    {

        $page['title'] = "Ecommerce";
        $page['subtitle'] = "";



        $card['listing_type'] = "listing"; //info/listing/listmenu
        $card['default_id'] = "Mall";
        $card['view_default'] = "ViewVertical";
        $page['limit_page'] = 8;
        $card['row'] = "col-xl-3 col-md-4 mb-xl-0 mb-4";
        $card['menu'] = array(
			
			"Mall" => array("icon", 'card-listing', 'array-produk'),
			
		);



        //card-listing


        //layout//ViewHorizontal//ViewVertical//ViewListTables
        //layout -> 

        $card['array-produk'] =  array(

            "source" => "template",
            'ViewVertical' => array(
                "template_name" => "beegrit",
                "template_file" => "card/layout.template"
            ),
            "sort_by" => array(

                "Harga Rendah ke Tinggi" => array("harga_jual_min_store", "asc"),
                "Harga Tinggi ke Rendah" => array("harga_jual_max_store", "desc"),
                "Presentase Diskon Tertinggi" => array("presentase_diskon", "desc"),
                "Presentase Diskon Terendah" => array("presentase_diskon", "asc"),
                "Harga Diskon Tertinggi" => array("harga_diskon", "desc"),
                "Terlaris" => array("total_jual", "desc"),
                "Terbaru" => array("create_date", "asc"),
                "Terlama" => array("create_date", "desc"),
            ),
            "filter" => array(
                //Text  // typeform //row //row_where_filter
                array("Brand", null, "select", array("inventaris__asset__master__brand", "id", "nama_brand"), "id_brand"),
                array("Kota Toko",   null, "select", array("webmaster__wilayah__kabupaten", "kota_id", "kota_name"), "id_kota"),
                array("Harga",   null, "number_dari_sampai", "harga_jual", "harga_jual_min_store"),
            ),
            "array" => array(
                array(
                    "img", null, "datafile", array("inventaris__asset__list", 'id_asset', "nama_barang"),
                    [
                        "source" => "template",
                        "template_name" => "beegrit",
                        "template_file" => "card/img.template",
                        "replace_to_image" => "IMG-SRC",
                        "style" => "border-radius:25px 25px 0 0;"
                    ]
                ),
                array("body", "tag"),
                array("link", array("Ecommerce", "detail", "view_layout", "row:id!card|"), 'just_link'),
                array("title", "nama_barang", "database", true, array("class" => "product-title")),
                array("subtitle", array("App", "EcommerceApp", "get_data_Harga", array("min_max", 'row:id!card|'), "Min Max Harga Jual Akhir"), "function", true),
                array("KOTA", "kota", "database"),
            ),
        );
        $card['array-layout-dashboard'] = array(
            "array" => array(
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "ProfileTingkatScore.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),
                array(
                    "cardType" => "template",

                    "cardContent" => array(
                        "template_name" => "HarianList.template",
                        "template_form" => "codepen",
                        "row" => "col-md-12",
                        "content" => array(
                            array("CARD-TITLE" => array(
                                "dataType" => "text",
                                "text" => "Jumlah Organisasi"
                            )),
                            array("CARD-NUMBER-TEXT" => array(
                                "dataType" => "database",
                                "database_refer" => "Dashboard-Query",
                                "database_row" => "jumlah_organisasi"
                            )),
                        ),

                    )
                ),

            ),


        );

        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "codepen";
        $website['content'][$i]['template_file'] = "swipper/swipper.template";
        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'TITLE',
                "refer" => "text",
                "value" => "Pilih Perencanaan Paket yang tepat",
            ),

            array(
                "tag" => 'SUBTITLE',
                "refer" => "text",
                "value" => "Atau hubungi tim konsultasi kami."
            ),

        );
        // $page['view_layout'][] = array("website", "col-md-12", $website);
        $page['view_layout'][] = array("card", "col-md-12", $card);

        $page['enkripsi'] = array("nama_organisasi", "apps_id", "email_organisasi", "narahubung_organisasi", "nama_narahubung", "alamat_organisasi", "bidang_organisasi");
        $page['crud_card']['Daftarkan Organisasi'][''] = 'pengajuan';



        $page['config']['database']['Mall']['query'] = "
		select *,case when LENGTH ((nama_barang))>=75 then concat(substr(nama_barang,0,75),'....') else nama_barang end as nama_barang 
		from
		(
			(select store__produk.id,id_asset, nama_barang,concat(type,' ',kota_name) as kota,id_brand,id_kota
					from store__produk 
					
						join inventaris__asset__list b on id_asset=b.id
						left join inventaris__asset__master__brand on b.id_brand = inventaris__asset__master__brand.id
						left join store__toko on id_toko = store__toko.id
						left join webmaster__wilayah__kabupaten on id_kota = kota_id
						where b.jual_barang='Ya' and inventaris__asset__master__brand.jual_produk=1
						order by id desc limit 10)

		UNION  ALL
		
		(select store__produk.id,id_asset,nama_barang,concat(type,' ',kota_name) as kota ,id_brand ,id_kota
		from store__produk 
			join inventaris__asset__list b on id_asset=b.id 
			left join inventaris__asset__master__brand on b.id_brand = inventaris__asset__master__brand.id
			left join store__toko on id_toko = store__toko.id
			left join webmaster__wilayah__kabupaten on id_kota = kota_id
			where b.jual_barang='Ya' and inventaris__asset__master__brand.jual_produk=1
			)
		) as a
		
		|WHERE|
		GROUP BY a.id,id_asset,nama_barang,a.kota,a.id_brand,id_kota
		order by random()
		";
        $page['crud']['select_database_costum']["0"]['where'][] = array("jual_produk", "=", 1);



        return $page;
    }
    public static function home()
    {
    }
}
