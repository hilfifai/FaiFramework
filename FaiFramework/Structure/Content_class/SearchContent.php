<?php

class SearchContent
{

    public static function router()
    {
        $domain['v2.moesneeds.id']['form_id']    = "search-form";
        $domain['v2.moesneeds.id']['get_params'] = [
            "search_kategori" => ["type" => "select"],
            "keyword"         => ["type" => "input", "min_input" => 3],
        ];
        $domain['v2.moesneeds.id']['content'][] = SearchContent::ecommerce();

        $domain['moesneeds.id']['form_id']    = "search-form";
        $domain['moesneeds.id']['get_params'] = [
            "search_kategori" => ["type" => "select"],
            "keyword"         => ["type" => "input", "min_input" => 3],
        ];
        $domain['moesneeds.id']['content'][] = SearchContent::ecommerce();
        return $domain;
    }
    public static function ecommerce()
    {
        $list = [];
        $list = [
            "Judul"      => "Produk",
            "database"   => "all_produk",
            "get_params" => [
                "search_kategori",
                "keyword",
            ],
            "where_data" => [
                ["nama_barang", '=', ":keyword"],
                ["nama_varian", '=', ":keyword"],
                ["nama_list_tipe_varian_varian1", '=', ":keyword"],
                ["nama_list_tipe_varian_varian2", '=', ":keyword"],
                ["nama_list_tipe_varian_varian3", '=', ":keyword"],
                ["barcode", '=', ":keyword"],
                ["barcode_varian", '=', ":keyword"],
            ],
            "view"       => ["hibe3", "ecommerce-search"],
            "array"      => [
                "ID"          => ["data", "id"],
                "NAMA-PRODUK" => ["data", "nama_barang"],
                "ID-ASSET"    => ["data", "id_asset"],
                "ID-PRODUK"   => ["data", "id_produk"],
                "HARGA-FULL"  => ["data", "harga_full"],
                "DESC"        => ["data", "deskripsi_barang"],
                "TUMB"        => ["data", "foto_aset"],
            ],
        ];
        return $list;
    }
}
