<?php

class ERP
{
    //Master Data

    public static function list_workspace($page)
    {
        $page = Workspace::workspace_apps($page);
        $page['get']['sidebarIn'] = true;;
        return $page;
    }
    public static function Dashboard_workspace($page)
    {
        $i = 0;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";



        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Total Pembelian",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "123",
            ),
        );
        $i++;
        $website['content'][$i]['tag'] = "BANNER";
        $website['content'][$i]['content_source'] = "template";
        $website['content'][$i]['template_name'] = "soft-ui";
        $website['content'][$i]['row'] = "col-md-3";
        $website['content'][$i]['template_file'] = "CardDashboard.template";


        $website['content'][$i]['template_array'] = array(
            array(
                "tag" => 'CARD-TITLE',
                "refer" => "text",
                "text" => "Total Harga Beli",
            ),
            array(
                "tag" => 'CARD-NUMBER-TEXT',
                "refer" => "text",
                "text" => "122",
            ),
        );
        $page['view_layout'][] = array("website", "col-md-12", $website);

        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        $page['get']['sidebarIn'] = true;;
        return $page;
    }

    public static function menu_basic($page)
    {
        $menu = array(
            // array("menu", "Gudang", array("POS", "supplier", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
            // array("menu", "Supplier", array("POS", "supplier", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

            // Mutasi Gudang

            // Pengeluaran Barang Non Jual

            // Barang Masuk dari Produsen

            // Retur Produsen

            // Stock Opname







            array(
                "group", "Pusat", array(

                    array(
                        "dropdown", "Bahan Baku", array(
                            array(
                                "dropdown", "Pembelian Supplier", array(

                                    // Permintaan Pembelian ->Persetujuan Permintaan Pembelian:
                                    array("menu", "Purchase Requisition", array("ERP", "bahan_baku__supplier__purchase__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Purchase Order", array("ERP", "bahan_baku__supplier__purchase__order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                    //Pembayaran -> PO menjadi Invoice Pembayaran

                                    // penawaran harga dengan supplier
                                    array("menu", "Approval Purchase Quotation", array("ERP", "bahan_baku__supplier__purchase__quotation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approve Purchase Quotation", array("ERP", "bahan_baku__supplier__purchase__quotation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


                                    array("menu", "Invoice", array("ERP", "bahan_baku__supplier__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //Invoice dikumpulkan di kontrabon
                                    array("menu", "Kontrabon", array("ERP", "bahan_baku__supplier__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approve Kontrabon", array("ERP", "bahan_baku__supplier__kontrabon", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //menjadi faktur jual
                                    array("menu", "Payment", array("ERP", "bahan_baku__supplier__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Invoice", array("ERP", "bahan_baku__supplier__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //DO-> untuk pengiriman
                                    //array("menu", "Delivery Order", array("POS", "payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                    //Barang Masuk
                                    array("menu", "Receive", array("ERP", "bahan_baku__supplier__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approval Receive", array("ERP", "bahan_baku__supplier__receive", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //barang masuk tapi di kembalikan
                                    array("menu", "Retur Receive", array("ERP", "bahan_baku__supplier__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Refund Retur", array("ERP", "bahan_baku__supplier__refund_retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //Permintaan barang -> nyambung 
                                    // array("menu", "Request", array("ERP", "bahan_baku__supplier__request_outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    // array("menu", "Approve Request", array("ERP", "bahan_baku__supplier__request_outgoing", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //Barang Keluar


                                ),
                            ),
                            array(
                                "dropdown", "Pembelian Offline", array(
                                    array("menu", "Purchase Order", array("ERP", "bahan_baku__offline__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Payment", array("ERP", "bahan_baku__offline__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Receive", array("ERP", "bahan_baku__offline__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Receive", array("ERP", "bahan_baku__offline__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Refund Retur", array("ERP", "bahan_baku__offline__refund", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown", "Pembelian Online", array(
                                    array("menu", "Purchase Order", array("ERP", "bahan_baku__online__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Payment", array("ERP", "bahan_baku__online__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Receive", array("ERP", "bahan_baku__online__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Receive", array("ERP", "bahan_baku__online__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Refund Retur", array("ERP", "bahan_baku__online__refund", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                        ),
                    ),
                    array(
                        "dropdown", "Barang Jadi", array(

                            //array("menu", "Barang Masuk dari Bahan Baku", array("ERP", "barang_masuk_bahan_baku", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),



                            array(
                                "dropdown", "Pembelian Ke Distributor", array(


                                    array("menu", "Purchase Request Distributor", array("ERP", "barang_jadi__distributor__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Purchase Order Distributor", array("ERP", "barang_jadi__distributor__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                    array("menu", "Invoice", array("ERP", "barang_jadi__distributor__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                    //Invoice dikumpulkan di kontrabon
                                    array("menu", "Kontrabon", array("ERP", "barang_jadi__distributor__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Approve Kontrabon", array("ERP", "barang_jadi__distributor__kontrabon", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //menjadi faktur jual
                                    array("menu", "Payment", array("ERP", "barang_jadi__distributor__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    //DO-> untuk pengiriman
                                    // array("menu", "Delivery Order Distributor", array("ERP", "payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                                    //Barang Masuk
                                    array("menu", "Receive Dari Distributor", array("ERP", "barang_jadi__distributor__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Approval Receive", array("ERP", "barang_jadi__distributor__receive", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Receive", array("ERP", "barang_jadi__distributor__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


                                ),
                            ),
                            array(
                                "dropdown", "Pembelian Offline", array(
                                    array("menu", "Purchase Order", array("ERP", "barang_jadi__offline__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Payment", array("ERP", "barang_jadi__offline__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Receive", array("ERP", "barang_jadi__offline__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Receive", array("ERP", "barang_jadi__offline__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Refund Retur", array("ERP", "barang_jadi__offline__refund", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown", "Pembelian Online", array(
                                    array("menu", "Purchase Order", array("ERP", "barang_jadi__online__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Payment", array("ERP", "barang_jadi__online__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Receive", array("ERP", "barang_jadi__online__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Receive", array("ERP", "barang_jadi__online__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Refund Retur", array("ERP", "barang_jadi__online__refund", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),
                            array(
                                "dropdown", "Barang Masuk Produsen", array(
                                    array("menu", "Barang Masuk Pembelian Offline", array("ERP", "barang_jadi__produsen__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                    array("menu", "Retur Barang Jadi", array("ERP", "barang_jadi__produsen__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),

                            array(
                                "dropdown", "Barang Jadi Non Beli", array(
                                    array("menu", "Barang Masuk Non Beli", array("ERP", "pembelian_offline__receive_non_beli", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                                ),
                            ),

                        ),
                    ),

                ),
            ),
            array(
                "dropdown", "Produksi Barang Jadi", array(

                    //array("menu", "Barang Masuk dari Bahan Baku", array("ERP", "barang_masuk_bahan_baku", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),



                    array(
                        "dropdown", "Design", array(
                            array("menu", "Intruksi Design Barang Jadi",            array("ERP", "barang_jadi__design__instruksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Rancangan Design Barang Jadi",           array("ERP", "barang_jadi__design__rancangan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approve Rancangan Design Barang Jadi",   array("ERP", "barang_jadi__design__rancangan", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                    array(
                        "dropdown", "Sample ", array(
                            array("menu", "Request Sample",         array("ERP", "barang_jadi__sample__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approve Request Sample", array("ERP", "barang_jadi__sample__request", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Outgoing Sample",        array("ERP", "barang_jadi__sample__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                        ),
                    ),
                    array(
                        "dropdown", "Produksi Barang Jadi", array(
                            array("menu", "Master Tahapan Produksi",    array("ERP", "tahapan_produksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            //array("menu", "Barang Masuk Produksi",    array("ERP", "barmas_produksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Mutasi Produksi",            array("ERP", "mutasi_produksi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                            array("menu", "Receive Produksi Vendor", array("ERP", "barang_jadi__produksi__vendor__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Purhcase Order Produksi Vendor", array("ERP", "barang_jadi__produksi__vendor__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approval Invoice Produksi Vendor", array("ERP", "barang_jadi__produksi__vendor__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Payment Produksi Vendor", array("ERP", "barang_jadi__produksi__vendor__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                            array("menu", "Approval Request dari Vendor", array("ERP", "barang_jadi__produksi__vendor__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Outgoing Vendor", array("ERP", "barang_jadi__produksi__vendor__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Outgoing", array("ERP", "bahan_baku__supplier__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                            array("menu", "Retur Outgoing", array("ERP", "bahan_baku__supplier__retur_outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approve Retur Outgoing", array("ERP", "bahan_baku__supplier__retur_outgoing", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                        ),
                    ),
                ),
            ),
            array(
                "group", "Mitra", array(
                    //kenapa ga ada pembelian barang? ada 2 jalan langsung sebagai dropshiper perantara


                    array(
                        "dropdown", "Purchasing", array(
                            array("menu", "Pre Order", array("ERP", "mitra__purchase__pre_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Request", array("ERP", "mitra__purchase__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Purchase Order ", array("ERP", "mitra__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Invoice ", array("ERP", "mitra__invoise", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approval Payment ", array("ERP", "mitra__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                        )
                    ),

                    array(
                        "dropdown", "Inventory", array(
                            array("menu", "Barang Masuk ", array("ERP", "mitra__receive_produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Retur Produsen", array("ERP", "mitra__retur_produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Mutasi Gudang", array("ERP", "mitra__mutasi_gudang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Pengeluaran Non Jual", array("ERP", "mitra__pengeluaran_non_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Stop Opname", array("ERP", "mitra__stop_opname", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                ),
            ),


            array(
                "group", "Vendor", array(
                    //sebagai vendor
                    array(
                        "dropdown", "Purchasing", array(
                            array("menu", "Request", array("ERP", "vendor__purchase__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Purchase Order Produksi", array("ERP", "vendor__purchase_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Invoice Produksi", array("ERP", "vendor__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Approval Payment Produksi", array("ERP", "vendor__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                        )
                    ),
                    array(
                        "dropdown", "Inventory", array(
                            array("menu", "Barang Masuk dari Produsen", array("ERP", "vendor__receive_produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Retur Produsen", array("ERP", "vendor__retur_produsen", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Mutasi Keluar", array("ERP", "vendor__mutasi_keluar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Pengeluaran Non Jual", array("ERP", "vendor__pengeluaran_non_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                            array("menu", "Stop Opname", array("ERP", "stop_opname", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                        ),
                    ),
                ),
            ),
            array(
                "group", "Inventory Management", array(

                    array("menu", "Barang masuk Non Beli", array("ERP", "barmas_non_beli", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                    array("menu", "Mutasi Gudang", array("ERP", "mitra__mutasi_gudang", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Pengeluaran Non Jual", array("ERP", "mitra__pengeluaran_non_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Stop Opname", array("ERP", "mitra__stop_opname", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

                   ),
            ),
            array(
                "group", "Laporan", array(

                    array("menu", "Laporan Pembelian", array("ERP", "laporan_pembelian", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Rekomendasi Belanja", array("ERP", "rekomendasi_belanja", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Laporan Stok", array("ERP", "stok", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                    array("menu", "Kartu Stok", array("ERP", "kartu_stok", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
                
                   ),
            ),



        );
        return $menu;
    }
    public static function pajak($page)
    {
        return ErpPosApp::pajak($page);
    }

    public static function stok($page)
    {
        $sql = "SELECT
                    sum( COALESCE ( qty_in, 0 ) ) - sum( COALESCE ( qty_out, 0 ) ) - sum( COALESCE ( qty_retur, 0 ) ) AS sisa_qty,
                    sum( COALESCE ( qty_in, 0 ) ) AS qty_masuk,
                    sum( COALESCE ( qty_out, 0 ) ) AS qty_keluar,
                    id_inventaris__asset__list,
                    nama_barang,
                    erp__pos__inventory_detail.harga_beli 
                FROM
                    erp__pos__inventory_detail
                    LEFT JOIN inventaris__asset__list ON inventaris__asset__list.id = id_inventaris__asset__list
                    LEFT JOIN erp__pos__inventory ON erp__pos__inventory.id = id_erp__pos__inventory 
                WHERE
                    id_panel = 41 
                GROUP BY
                    id_inventaris__asset__list,
                    nama_barang,
                    erp__pos__inventory_detail.harga_beli 
                ORDER BY
                    id_inventaris__asset__list";
    }

    public static function bahan_baku__offline__purchase_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Offline ', 'purchase_order', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__offline__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Offline ', 'payment', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__offline__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Offline ', 'receive', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__offline__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Offline ', 'retur', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__online__purchase_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Bahan Baku Online', 'purchase_order', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__online__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Bahan Baku Online', 'payment', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__online__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Bahan Baku Online', 'receive', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__online__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Bahan Baku Online', 'retur', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__offline__purchase_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'barang_jadi_offline', 'purchase_order', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__offline__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'barang_jadi_offline', 'payment', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__offline__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'barang_jadi_offline', 'receive', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__offline__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'barang_jadi_offline', 'retur', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__online__purchase_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'purchase_order', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__online__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'payment', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__online__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'receive', 'erp_simple', 'costumer');
        return $page;
    }
    public static function barang_jadi__online__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Ecommerce', 'retur', 'erp_simple', 'costumer');
        return $page;
    }
    public static function bahan_baku__supplier__purchase__request($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'purchase_request', 'erp_full', 'costumer');
        return $page;
    }
    public static function bahan_baku__supplier__purchase__order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'purchase_order', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__purchase__quotation($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'purchase__quotation', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__invoice($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'invoice', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__kontrabon($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'kontrabon', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'payment', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'receive', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'retur', 'erp_full', 'costumer');

        return $page;
    }
    public static function bahan_baku__supplier__refund($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Pembelian Bahan Baku Supplier', 'refund', 'erp_full', 'costumer');

        return $page;
    }


    public static function barang_jadi__distributor__purchase__request($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'purchase_request', 'erp_full', 'costumer');
        return $page;
    }
    public static function barang_jadi__distributor__purchase_order($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'purchase_order', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__purchase_quotation($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'purchase__quotation', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor_invoice($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'invoice', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__kontrabon($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'kontrabon', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__payment($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'payment', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__receive($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'receive', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__retur($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'retur', 'erp_full', 'costumer');

        return $page;
    }
    public static function barang_jadi__distributor__refund($page)
    {
        $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'Barang Jadi Distributor', 'refund', 'erp_full', 'costumer');

        return $page;
    }
}
