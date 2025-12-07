<?php
class ErpPosApp
{

    public static function router($page, $type_page, $view_page, $kategori, $side)
    {
        $page_temp = ErpPosApp::route_nomor($page, $type_page);
        $page = array_merge($page, $page_temp);
        if (in_array($view_page, array(
            'purchase_request',
            'purchase_order',
            'sales_qoutation',
            'purchase_qoutation',
            'pre_order',
            'sales_order',
            'invoice',
            'kontrabon'
        )))
            return ErpPosApp::data_utama($page, $type_page, $view_page, $kategori, $side);
        else if (in_array($view_page, array('payment'))) {
            return ErpPosApp::data_payment($page, $type_page, $view_page, $kategori, $side);
        } else if (in_array($view_page, array('delivery_order',))) {
            return ErpPosApp::data_delivery($page, $type_page, $view_page, $kategori, $side);
        } else if (in_array($view_page, array('delivery_order', 'receive', "outgoing", "retur"))) {
            return ErpPosApp::data_inventory($page, $type_page, $view_page, $kategori, $side);
        } else if (in_array($view_page, array('cart', 'pre_order'))) {
            return ErpPosApp::data_pra_order($page, $type_page, $view_page, $kategori, $side);
        } else if (in_array($view_page, array('stok_opname'))) {
            return ErpPosApp::data_stok_opname($page, $type_page, $view_page, $kategori, $side);
        } else if (in_array($view_page, array('data_grup'))) {
            return ErpPosApp::data_grup($page, $type_page, $view_page, $kategori, $side);
        }
    }
    public static function route_nomor($page, $type_page, $return_filter = "all")
    {
        $nomor_add = '.';
        $ex_type_page = explode('_', $type_page);
        for ($i = 0; $i < count($ex_type_page); $i++) {
            $nomor_add .= strtoupper($ex_type_page[$i][0]);
        }


        if ($return_filter == 'all' or $return_filter == 'nomor_stok_opname') {
            $page['crud']['insert_number_code']['nomor_stok_opname']['prefix'] = "SOP$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_stok_opname']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_stok_opname']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_stok_opname']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_stok_opname']['root']['month_get_row_where'][0] = "tanggal_stok_opname";
            $page['crud']['insert_number_code']['nomor_stok_opname']['root']['not_string'] = "tanggal_stok_opname";
            $page['crud']['insert_number_code']['nomor_stok_opname']['suffix'] = '';
            $page['crud']['insert_number_code']['nomor_stok_opname']['database_utama'] = 'erp__pos__stok_opname';
            $page['crud']['insert_number_code']['nomor_stok_opname']['month_get_row_where'] = 'tanggal_stok_opname';
        }
        if ($return_filter == 'all' or $return_filter == 'no_purchose_request') {

            $page['crud']['insert_number_code']['no_purchose_request']['prefix'] = "PR$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['no_purchose_request']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['no_purchose_request']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['no_purchose_request']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['no_purchose_request']['root']['month_get_row_where'][0] = "tanggal_pr";
            $page['crud']['insert_number_code']['no_purchose_request']['root']['not_string'] = "tanggal_pr";
            $page['crud']['insert_number_code']['no_purchose_request']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'no_purchose_order') {
            $page['crud']['insert_number_code']['no_purchose_order']['prefix'] = "PO$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['no_purchose_order']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['no_purchose_order']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['no_purchose_order']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['no_purchose_order']['root']['month_get_row_where'][0] = "tanggal_po";
            $page['crud']['insert_number_code']['no_purchose_order']['root']['not_string'] = "tanggal_po";
            $page['crud']['insert_number_code']['no_purchose_order']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'no_sales_order') {
            $page['crud']['insert_number_code']['no_sales_order']['prefix'] = "SO$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['no_sales_order']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['no_sales_order']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['no_sales_order']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['no_sales_order']['root']['month_get_row_where'][0] = "tanggal_sales_order";
            $page['crud']['insert_number_code']['no_sales_order']['root']['not_string'] = "tanggal_sales_order";
            $page['crud']['insert_number_code']['no_sales_order']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'nomor_invoice') {
            $page['crud']['insert_number_code']['nomor_invoice']['prefix'] = "INV$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_invoice']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_invoice']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_invoice']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_invoice']['root']['month_get_row_where'][0] = "tanggal_invoice";
            $page['crud']['insert_number_code']['nomor_invoice']['root']['not_string'] = "tanggal_invoice";
            $page['crud']['insert_number_code']['nomor_invoice']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'nomor_receive') {
            $page['crud']['insert_number_code']['nomor_receive']['prefix'] = "RC$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_receive']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_receive']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_receive']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_receive']['root']['month_get_row_where'][0] = "tanggal_diterima";
            $page['crud']['insert_number_code']['nomor_receive']['root']['not_string'] = "tanggal_diterima";
            $page['crud']['insert_number_code']['nomor_receive']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'nomor_outgoing') {
            $page['crud']['insert_number_code']['nomor_outgoing']['prefix'] = "RO$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_outgoing']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_outgoing']['root']['month_get_row_where'][0] = "tanggal_outgoing";
            $page['crud']['insert_number_code']['nomor_outgoing']['root']['not_string'] = "tanggal_outgoing";
            $page['crud']['insert_number_code']['nomor_outgoing']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'nomor_do') {
            $page['crud']['insert_number_code']['nomor_do']['prefix'] = "DO$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_do']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_do']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_do']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_do']['root']['month_get_row_where'][0] = "tanggal_do";
            $page['crud']['insert_number_code']['nomor_do']['root']['not_string'] = "tanggal_do";
            $page['crud']['insert_number_code']['nomor_do']['database_utama'] = "erp__pos__delivery_order";
            $page['crud']['insert_number_code']['nomor_do']['suffix'] = '';
        }

        if ($return_filter == 'all' or $return_filter == 'nomor_payment') {
            $page['crud']['insert_number_code']['nomor_payment']['prefix'] = "INV$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
            $page['crud']['insert_number_code']['nomor_payment']['root']['type'][0] = 'count-month';
            $page['crud']['insert_number_code']['nomor_payment']['root']['sprintf'][0] = true;
            $page['crud']['insert_number_code']['nomor_payment']['root']['sprintf_number'][0] = 5;
            $page['crud']['insert_number_code']['nomor_payment']['root']['month_get_row_where'][0] = "tanggal_payment";
            $page['crud']['insert_number_code']['nomor_payment']['root']['not_string'] = "tanggal_payment";
            $page['crud']['insert_number_code']['nomor_payment']['suffix'] = '';
            $page['crud']['insert_number_code']['nomor_payment']['database_utama'] = 'erp__pos__payment';
        }
        $return_filter;
        $page['crud']['update_number_code'] = $page['crud']['insert_number_code'];
        return $page;
    }
    public static function alur_flow($page,  $view_page)
    {
        $get = 'all';
        if ($view_page == 'pre_order' or $get == 'all')
            $view_page_proses = 1;
        if ($view_page == 'cart' or $get == 'all')
            $cart =  $view_page_proses = 2;
        if ($view_page == 'purchase_request' or $get == 'all')
            $purchase_request =  $view_page_proses = 3;
        if ($view_page == 'purchase_order' or $get == 'all')
            $purchase_order = $view_page_proses = 4;
        if ($view_page == 'sales_qoutation' or $get == 'all')
            $sales_qoutation = $view_page_proses = 5;
        if ($view_page == 'purchase_qoutation' or $get == 'all')
            $purchase_qoutation = $view_page_proses = 6;

        if ($view_page == 'sales_order' or $get == 'all')
            $sales_order = $view_page_proses = 7;
        if ($view_page == 'invoice' or $get == 'all')
            $invoice = $view_page_proses = 8;
        if ($view_page == 'kontrabon' or $get == 'all')
            $kontrabon = $view_page_proses = 9;
        if ($view_page == 'payment' or $get == 'all')
            $payment = $view_page_proses = 10;

        if ($view_page == 'outgoing' or $get == 'all')
            $outgoing = $view_page_proses = 11;
        if ($view_page == 'retur_outgoing' or $get == 'all')
            $retur_outgoing = $view_page_proses = 12;
        if ($view_page == 'refund_outgoing' or $get == 'all')
            $refund_outgoing = $view_page_proses = 13;
        if ($view_page == 'delivery_order' or $get == 'all')
            $delivery_order = $view_page_proses = 14;
        if ($view_page == 'retur_delivery_order' or $get == 'all')
            $retur_delivery_order = $view_page_proses = 15;
        if ($view_page == 'receive' or $get == 'all')
            $receive = $view_page_proses = 16;
        if ($view_page == 'retur' or $get == 'all')
            $retur = $view_page_proses = 17;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 18;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 19;
        if ($view_page == 'selesai' or $get == 'all')
            $selesai = $view_page_proses = 20;




        $array_flow_alur['alur']["Aktif"] = "Proses Cart";
        $array_flow_alur['alur']["$cart"] = "Cart Aktif";
        $array_flow_alur['alur'][""] = "Purchase Request dibuat - menunggu approval";
        $array_flow_alur['alur'][$purchase_request] = "Purchase Request dibuat - menunggu approval";
        $array_flow_alur['alur']["$purchase_request.2"] = "Proses Purchase Request - Approval masih dalam proses";
        $array_flow_alur['alur']["$purchase_request.3"] = "Proses Purchase Request Selesai - Approval Request ditolak";

        $array_flow_alur['alur']["Pemesanan"] = "Proses Pemesanan";
        $array_flow_alur['alur'][$purchase_order] = "Proses Purchase Request Selesai - menunggu review pemesanan";
        $array_flow_alur['alur']["$purchase_order.2"] = "Proses Purchase Order Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_order.3"] = "Proses Purchase Order Selesai - Tahap Review terdapat ketidaksesuaian";
        $array_flow_alur['alur']["$purchase_order.9"] = "Proses Purchase Order Batal oleh konsumen";



        $array_flow_alur['option_on'][$purchase_request]['value'][$purchase_request] = "Perlu Approval Purchase Request";
        $array_flow_alur['option_on'][$purchase_request]['value'][$purchase_order] = "Lanjutkan Ke Proses Purchase Order";

        $array_flow_alur['option_on'][$purchase_order]['value']["$purchase_order.3"] = "Purchase Order terdapat ketidaksesuian";
        $array_flow_alur['option_on'][$purchase_order]['value']["$purchase_order.2"] = "Purchase Order Perlu Proses Approval";
        $array_flow_alur['option_on'][$purchase_order]['value'][$sales_qoutation] = "Lanjutkan Ke Proses Sales Qoutation(Penjual)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$purchase_qoutation] = "Lanjutkan Ke Proses Review Purchase Qoutation(Pembeli)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$sales_order] = "Lanjutkan Ke Proses Sales Order(Penjual)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$invoice] = "Lanjutkan Ke Pembuatan Invoice";


        $array_flow_alur['alur'][$sales_qoutation] = "Proses Sales Order Selesai - menunggu proses approval negosiasi dari penjual";
        $array_flow_alur['alur']["$sales_qoutation.2"] = "Proses Qoutation Pembeli - terdapat negosiasi kembali dari pembeli";
        $array_flow_alur['alur']["$sales_qoutation.3"] = "Proses Qoutation Penjual Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan ";
        $array_flow_alur['option_on'][$sales_qoutation]['value'][$purchase_qoutation] = "Ajukan Negosiasi kepada pembeli";
        $array_flow_alur['option_on'][$sales_qoutation]['value']["$sales_qoutation.3"] = "Negosiasi ditolak";
        $array_flow_alur['option_on'][$sales_qoutation]['value'][$sales_order] = "Pemesanan Disetujui dan negosisiasi selesai";

        $array_flow_alur['alur'][$purchase_qoutation] = "Proses Qoutation - menunggu negosiasi penawaran dari pembeli";
        $array_flow_alur['alur']["$purchase_qoutation.2"] = "Proses Qoutation Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_qoutation.3"] = "Proses Qoutation Pembeli Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan";
        $array_flow_alur['option_on'][$purchase_qoutation]['value']["$sales_qoutation.2"] = "Ajukan kembali negosiasi kepada penjual";
        $array_flow_alur['option_on'][$purchase_qoutation]['value']["$purchase_qoutation.3"] = "Negosiasi ditolak";
        $array_flow_alur['option_on'][$purchase_qoutation]['value'][$sales_order] = "Pemesanan Disetujui dan negosisiasi selesai";

        $array_flow_alur['alur'][$purchase_qoutation] = "Proses Qoutation - menunggu negosiasi penawaran dari pembeli";
        $array_flow_alur['alur']["$purchase_qoutation.2"] = "Proses Qoutation Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_qoutation.3"] = "Proses Qoutation Pembeli Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan";

        $array_flow_alur['alur'][$sales_order] = "Proses Sales Order - menunggu review Pemesanan";
        $array_flow_alur['alur']["$sales_order.2"] = "Proses Sales Order Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$sales_order.3"] = "Proses Sales Order Selesai - Tahap Review terdapat ketidaksesuaian";
        $array_flow_alur['option_on'][$sales_order]['value'][$invoice] = "Lanjutkan Ke Pembuatan Invoice";
        $array_flow_alur['option_on'][$sales_order]['value']["$sales_order.3"] = "Sales Order terdapat ketidaksesuian";
        $array_flow_alur['option_on'][$sales_order]['value']["$sales_order.2"] = "Sales Order Perlu Proses Approval";

        $array_flow_alur['alur'][$invoice] = "Penerbitan Inovice - Menunggu Proses Pembayaran Pembeli";
        $array_flow_alur['option_on'][$invoice]['value'][$kontrabon] = "Diperlukan Proses Kontra bon sebelum pembayaran ";
        $array_flow_alur['option_on'][$invoice]['value'][$payment] = "Lanjutkan Proses Payment";

        $array_flow_alur['alur'][$payment] = "Proses Pembayaran";
        $array_flow_alur['option_on'][$payment]['value'][$kontrabon] = "Diperlukan Proses Kontra bon sebelum pembayaran ";
        $array_flow_alur['option_on'][$payment]['value'][$payment] = "Lanjutkan Proses Payment";

        $return['array_flow_alur'] = $array_flow_alur;
        return $return;
    }
    public static function data_grup($page, $type_page, $view_page, $kategori, $side)
    {
        $database_utama = "erp__pos__group";
        $primary_key = null;
        $array[]  =    array("Nomor", null, "text-nomor", "G");
        $array[]  =    array("Tanggal", null, "date");
        $array[]  =    array("page", null, "text");
        $array[]  =    array("Panel", null, "select", array("panel", null, "nama_panel"));
        // $array[]  =    array("Panel Pembeli", null, "select", array("panel", null, "nama_panel"));
        $array[]  =    array("id_apps_user", null, "select", array("apps_user", null, "nama_lengkap"));
        $array[]  =    array("Status", null, "select-manual-value", array("Aktif", "Pemesanan", "Pembayaran"));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['where'][]     = array("page", "=", "'$type_page'");
        $page['crud']['array'] = $array;
        return $page;
    }
    public static function data_utama($page, $type_page, $view_page, $kategori, $side)
    {
        $database_utama = "erp__pos__utama";
        $primary_key = null;
        $get = 'all';
        if ($view_page == 'pre_order' or $get == 'all')
            $view_page_proses = 1;
        if ($view_page == 'cart' or $get == 'all')
            $cart =  $view_page_proses = 2;
        if ($view_page == 'purchase_request' or $get == 'all')
            $purchase_request =  $view_page_proses = 3;
        if ($view_page == 'purchase_order' or $get == 'all')
            $purchase_order = $view_page_proses = 4;
        if ($view_page == 'sales_qoutation' or $get == 'all')
            $sales_qoutation = $view_page_proses = 5;
        if ($view_page == 'purchase_qoutation' or $get == 'all')
            $purchase_qoutation = $view_page_proses = 6;

        if ($view_page == 'sales_order' or $get == 'all')
            $sales_order = $view_page_proses = 7;
        if ($view_page == 'invoice' or $get == 'all')
            $invoice = $view_page_proses = 8;
        if ($view_page == 'kontrabon' or $get == 'all')
            $kontrabon = $view_page_proses = 9;
        if ($view_page == 'payment' or $get == 'all')
            $payment = $view_page_proses = 10;

        if ($view_page == 'outgoing' or $get == 'all')
            $outgoing = $view_page_proses = 11;
        if ($view_page == 'retur_outgoing' or $get == 'all')
            $retur_outgoing = $view_page_proses = 12;
        if ($view_page == 'refund_outgoing' or $get == 'all')
            $refund_outgoing = $view_page_proses = 13;
        if ($view_page == 'delivery_order' or $get == 'all')
            $delivery_order = $view_page_proses = 14;
        if ($view_page == 'retur_delivery_order' or $get == 'all')
            $retur_delivery_order = $view_page_proses = 15;
        if ($view_page == 'receive' or $get == 'all')
            $receive = $view_page_proses = 16;
        if ($view_page == 'retur' or $get == 'all')
            $retur = $view_page_proses = 17;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 18;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 19;
        if ($view_page == 'selesai' or $get == 'all')
            $selesai = $view_page_proses = 20;




        $array_flow_alur['alur']["$cart"] = "Cart Aktif";
        $array_flow_alur['alur'][""] = "Purchase Request dibuat - menunggu approval";
        $array_flow_alur['alur'][$purchase_request] = "Purchase Request dibuat - menunggu approval";
        $array_flow_alur['alur']["$purchase_request.2"] = "Proses Purchase Request - Approval masih dalam proses";
        $array_flow_alur['alur']["$purchase_request.3"] = "Proses Purchase Request Selesai - Approval Request ditolak";

        $array_flow_alur['alur'][$purchase_order] = "Proses Purchase Request Selesai - menunggu review pemesanan";
        $array_flow_alur['alur']["$purchase_order.2"] = "Proses Purchase Order Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_order.3"] = "Proses Purchase Order Selesai - Tahap Review terdapat ketidaksesuaian";
        $array_flow_alur['alur']["$purchase_order.9"] = "Proses Purchase Order Batal oleh konsumen";



        $array_flow_alur['option_on'][$purchase_request]['value'][$purchase_request] = "Perlu Approval Purchase Request";
        $array_flow_alur['option_on'][$purchase_request]['value'][$purchase_order] = "Lanjutkan Ke Proses Purchase Order";

        $array_flow_alur['option_on'][$purchase_order]['value']["$purchase_order.3"] = "Purchase Order terdapat ketidaksesuian";
        $array_flow_alur['option_on'][$purchase_order]['value']["$purchase_order.2"] = "Purchase Order Perlu Proses Approval";
        $array_flow_alur['option_on'][$purchase_order]['value'][$sales_qoutation] = "Lanjutkan Ke Proses Sales Qoutation(Penjual)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$purchase_qoutation] = "Lanjutkan Ke Proses Review Purchase Qoutation(Pembeli)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$sales_order] = "Lanjutkan Ke Proses Sales Order(Penjual)";
        $array_flow_alur['option_on'][$purchase_order]['value'][$invoice] = "Lanjutkan Ke Pembuatan Invoice";


        $array_flow_alur['alur'][$sales_qoutation] = "Proses Sales Order Selesai - menunggu proses approval negosiasi dari penjual";
        $array_flow_alur['alur']["$sales_qoutation.2"] = "Proses Qoutation Pembeli - terdapat negosiasi kembali dari pembeli";
        $array_flow_alur['alur']["$sales_qoutation.3"] = "Proses Qoutation Penjual Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan ";
        $array_flow_alur['option_on'][$sales_qoutation]['value'][$purchase_qoutation] = "Ajukan Negosiasi kepada pembeli";
        $array_flow_alur['option_on'][$sales_qoutation]['value']["$sales_qoutation.3"] = "Negosiasi ditolak";
        $array_flow_alur['option_on'][$sales_qoutation]['value'][$sales_order] = "Pemesanan Disetujui dan negosisiasi selesai";

        $array_flow_alur['alur'][$purchase_qoutation] = "Proses Qoutation - menunggu negosiasi penawaran dari pembeli";
        $array_flow_alur['alur']["$purchase_qoutation.2"] = "Proses Qoutation Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_qoutation.3"] = "Proses Qoutation Pembeli Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan";
        $array_flow_alur['option_on'][$purchase_qoutation]['value']["$sales_qoutation.2"] = "Ajukan kembali negosiasi kepada penjual";
        $array_flow_alur['option_on'][$purchase_qoutation]['value']["$purchase_qoutation.3"] = "Negosiasi ditolak";
        $array_flow_alur['option_on'][$purchase_qoutation]['value'][$sales_order] = "Pemesanan Disetujui dan negosisiasi selesai";

        $array_flow_alur['alur'][$purchase_qoutation] = "Proses Qoutation - menunggu negosiasi penawaran dari pembeli";
        $array_flow_alur['alur']["$purchase_qoutation.2"] = "Proses Qoutation Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$purchase_qoutation.3"] = "Proses Qoutation Pembeli Selesai - negosiasi tidak menemukan deal, pemesanan tidak dilanjutkan";

        $array_flow_alur['alur'][$sales_order] = "Proses Sales Order - menunggu review Pemesanan";
        $array_flow_alur['alur']["$sales_order.2"] = "Proses Sales Order Selesai - menunggu proses Approval";
        $array_flow_alur['alur']["$sales_order.3"] = "Proses Sales Order Selesai - Tahap Review terdapat ketidaksesuaian";
        $array_flow_alur['option_on'][$sales_order]['value'][$invoice] = "Lanjutkan Ke Pembuatan Invoice";
        $array_flow_alur['option_on'][$sales_order]['value']["$sales_order.3"] = "Sales Order terdapat ketidaksesuian";
        $array_flow_alur['option_on'][$sales_order]['value']["$sales_order.2"] = "Sales Order Perlu Proses Approval";

        $array_flow_alur['alur'][$invoice] = "Penerbitan Inovice";
        $array_flow_alur['option_on'][$invoice]['value'][$kontrabon] = "Diperlukan Proses Kontra bon sebelum pembayaran ";
        $array_flow_alur['option_on'][$invoice]['value'][$payment] = "Lanjutkan Proses Payment";

        $array_flow_alur['alur'][$payment] = "Proses Pembayaran";
        $array_flow_alur['option_on'][$payment]['value'][$kontrabon] = "Diperlukan Proses Kontra bon sebelum pembayaran ";
        $array_flow_alur['option_on'][$payment]['value'][$payment] = "Lanjutkan Proses Payment";

        $status = array();
        $view_page_proses = $$view_page;
        if (Partial::input('type') == 'tambah' or Partial::input('type') == 'edit') {
            if (isset($array_flow_alur['option_on'][$view_page_proses]['value']))
                $status = $array_flow_alur['option_on'][$view_page_proses]['value'];
        } else {
            $status = $array_flow_alur['alur'];
        }

        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );

        $array[]  =    array("id_erp__pos__group", null, "hidden_input");
        $array[]  =    array("Page", null, "select", array("webmaster__erp_pos__page", null, "page"));
        $array[]  =    array("Side", null, "hidden_input");
        $array[]  =    array("Input Proses", null, "hidden_input");
        $array[]  =    array("Panel", null, "select", array("panel", null, "nama_panel"));
        $array[]  =    array("Pembeli", "apps_user", "select", array("apps_user", "id_apps_user", "nama_lengkap"));
        $array[]  =    array("Store_toko", "id_store_toko", "select", array("store__toko", null, "nama_toko"), null);
        // $array[]  =    array("Store", null, "select",["store__toko",null,"nama_toko"]);
        // $array[]  =    array("Gudang", null, "select-ajax");

        if ($view_page_proses  == $purchase_request) {
            $array[]  =    array("No Purchose Request", "no_purchose_request", "text");
            $array[]  =    array("Tanggal Purchose Request", "tanggal_pr", "date");
        }
        if ($view_page_proses  == $purchase_order or $view_page_proses  == $sales_order) {

            $array[]  =    array("No Purchose Order", "no_purchose_order", "text");
            $array[]  =    array("Tanggal Purchose Order", "tanggal_po", "date");
        }
        if ($view_page_proses  == $sales_order) {

            $array[]  =    array("No Sales Order", "no_sales_order", "text");
            $array[]  =    array("Tanggal Sales Order", "tanggal_sales_order", "date");
        }
        if ($view_page_proses  == $invoice) {

            $array[]  =    array("No Invoice", "nomor_invoice", "text");
            $array[]  =    array("Tanggal Invoice", "tanggal_invoice", "date");
        }

        $array[]  =    array("Departemen", "hcms__struktur__divisi_seq", "select", array("hcms__struktur__divisi", null, "nama_divisi"), null);
        // if ($type_page == 'Pembelian Bahan Baku Supplier')
        //     $array[]  =    array("Supplier", "supplier_seq", "select", array("outsourcing__supplier", null, "nama_suplier"), null);
        // if ($type_page == 'Pembelian Bahan Baku Offline ')
        //     $array[]  =    array("Toko offline", "toko_offline", "select", array("outsourcing__toko_ofline", null, "nama_toko_offline"), null);

        if ($type_page == 'Bahan Baku Online') {
            $array[]  =    array("Platform", "platform", "text", array("outsourcing__toko_ofline", null, "nama_toko_offline"), null);
            $array[]  =    array("Nama Toko", "nama_toko_online", "text");
        }
        // if ($type_page == 'Barang Jadi Ecommerce') {

        //     $array[]  =    array("Nama Toko", "nama_toko_online", "text");
        // }
        // if ($type_page == 'Barang Jadi Distributor')
        //     $array[]  =    array("Distributor", "distributor_seq", "select", array("outsourcing__distributor", null, "nama_distributor"), null);

        if ($type_page == 'Barang Jadi Ecommerce') {
            $array[]  =     array("Payment", "status_payment", "text-relation");
            $array[]  =      array("Type Pemesanan", null, "select-manual", array("umum" => "umum", "dropshiper" => "dropshipper"));
        }
        $array[]  =     array("Status Pesanan", null, "select-manual", array("Aktif" => ($side == 'penjual' ? 'Belum Bayar' : "Aktif"), "review" => "Review", "pembayaran" => "Menunggu Pembayaran", "batal" => "Batal", "proses" => "Menunggu Proses", "pengiriman" => "Pengiriman", "selesai" => "Selesai"));

        $array[]  =    array("Kirim_ke", "kirim_ke", "select", array("inventaris__asset__tanah__bangunan", null, "nama_unit_bangunan"));
        $array[]  =    array("", "id_payment_method", "hidden_input", array("inventaris__asset__tanah__bangunan", null, "nama_unit_bangunan"));
        $array[]  =    array("", "id_payment_brand", "hidden_input", array("inventaris__asset__tanah__bangunan", null, "nama_unit_bangunan"));
        // $array[]  =    array("Tanggal kirim", "tanggal_kirim", "date");
        // $array[]  =    array("Status PO", "status_po", "select-manual-editview", array("Open" => "Open PO", "Closed" => "Closed PO"));
        $array[]  =    array("Catatan Pesanan", "pesan", "textarea");
        $array[]  =    array("Attachment", "attachment", "file", "erp_pos/$type_page/");
        $array[]  =    array("Status", "status", "select-manual-req", $status);


        if ($view_page_proses  >= $purchase_request) {
            $page['crud']['crud_inline']['no_purchose_request'] = " readonly";
            $page['crud']['crud_inline']['tanggal_pr'] = " readonly";
        }
        $page['crud']['no_add_sub_kategori'][$database_utama . "__detail"] = true;
        $page['crud']['no_row_sub_kategori'][$database_utama . "__detail"] = true;

        $page['crud']['costum_class']['supplier_seq'] = 'select2';


        $sub_kategori[0] = ["",  $database_utama . "__detail", null, "table"];

        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['target_no_sub_kategori'] = 0;
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['input_row'] = "col-md-3 col-sm-7 col-xs-9";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['input'] = "Search ";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['call_function'] = array("change_subtotal(this,output)");
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['utama'] = "inventaris__asset__list";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['primary_key'] = null;

        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['select'] = array("*,
                (case when coalesce(inventaris__asset__list__varian.barcode_varian,'-1') != '-1' then inventaris__asset__list__varian.barcode_varian else inventaris__asset__list.barcode end) as barcode_utama,
                (case when coalesce(inventaris__asset__list__varian.berat_varian,'-1') != '-1' then inventaris__asset__list__varian.berat_varian else inventaris__asset__list.berat end) as berat_utama,
                (case when coalesce(store__produk__varian.harga_pokok_penjualan_varian,'-1') != '-1' then store__produk__varian.harga_pokok_penjualan_varian else store__produk.harga_pokok_penjualan end) as harga_utama,
                inventaris__asset__list__varian.nama_varian,
                store__produk.id as id_store_produk,
                store__toko.id as id_store_toko,
                inventaris__asset__list.id as id_inventaris__asset__list,
                store__produk__varian.id as id_store__varian,
                inventaris__asset__list__varian.id as id_barang_varian
                ");
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['join'][] = array("inventaris__asset__list__varian", "inventaris__asset__list.id", "inventaris__asset__list__varian.id_inventaris__asset__list", 'left');;
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['join'][] = array("store__produk", "store__produk.id_asset", "inventaris__asset__list.id", 'left');
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['join'][] = array("store__toko", "store__produk.id_toko", "store__toko.id", 'left');;
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['join'][] = array("store__produk__varian", "store__produk__varian.id_store__produk", "store__produk.id and id_barang_varian=inventaris__asset__list__varian.id", 'left');;
        if (isset($page['load']['workspace'])) {

            $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database']['where'][] = array("store__toko.id", " = ", "WORKSPACE_SINGLE_TOKO|");
        }
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['search'] = "primary_key";
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['pilih_id'] = array(
            array("id_asset", "store__produk"),
            array("id_store__produk", "store__produk__varian"),
            array("id_toko", "store__produk"),
            array("id_store__varian", "store__produk__varian", "id"),
            array("id_barang_varian", "store__produk__varian")
        );
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['search_row'] = array("inventaris__asset__list__varian.barcode", "inventaris__asset__list.barcode", "nama_barang", 'nama_varian', "nama_toko");
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['array_detail'] = array(
            "nama_barang" => "Nama",
            "nama_varian" => "Varian",
            "harga_utama" => "Harga",
            "barcode_utama" => "Barcode",
            "nama_toko" => "Toko"
        );
        $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['array_result'] =
            array(
                "barang" => array("type" => "array_website", "connect" => [
                    "id_inventaris__asset__list" => array("id_asset", "store__produk"),
                    "id_store_produk" => array("id_store__produk", "store__produk__varian"),
                    "id_store_toko" => array("id_toko", "store__produk"),
                    "id_store__varian" => array("id", "store__produk__varian"),
                    "id_barang_varian" => array("id_barang_varian", "store__produk__varian"),
                ]),
                "id_produk" => array("row" => "id_store_produk", "type" => "database"),
                "id_store_toko" => array("row" => "id_store_toko", "type" => "database"),
                "id_varian" => array("row" => "id_store__varian", "type" => "database"),
                "id_barang_varian" => array("row" => "id_barang_varian", "type" => "database"),
                "kode_pengiriman" => array("type" => "database_diferent", "diferent_row" => "id_store_toko"),
                "stok_onhand" => array("text" => 1, "type" => "text"),
                "harga_penjualan" => array("row" => "harga_utama", "type" => "database"),
                "qty" => array("text" => 1, "type" => "text"),
                "tipe_diskon" => array("text" => 'Persentase', "type" => "text"),
                "diskon_utama" => array("text" => '0', "type" => "text"),
                "berat_satuan" => array("row" => 'berat_utama', "type" => "database"),
                "berat_total" => array("row" => 'berat_utama', "type" => "database"),

                "grandtotal" => array("row" => "harga_utama", "type" => "database"),
            );

        $db_array_website = $page['crud']['search_load_sub_kategori'][$database_utama . "__detail"]['database'];
        $db_array_website['where'][] = array("inventaris__asset__list.nama_toko", ' is ', "not null");
        $db_array_website['where'][] = array("coalesce(nama_varian,'-1')", ' != ', "'-1'");
        $db_array_website['limit'] = 1;
        $array_sub_kategori[0][] = array(
            "Barang",
            "barang",
            "array_website",
            array(
                "source_list" => "template_database",
                "array" =>
                [
                    "NAMA-PRODUK" => array("refer" => "database", "row" => "nama_barang"),
                    "NAMA-VARIAN" => array("refer" => "database", "row" => "nama_varian"),
                    "NAMA-TOKO" => array("refer" => "database", "row" => "nama_toko")
                ],
                "database_refer" => "-1",
                "database" => $db_array_website,
                "template_content" => '
                    <div class="d-flex justify-content-start align-items-center text-nowrap">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                                <img src="../../assets/img/products/woodenchair.png" alt="" class="rounded-2">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <small>Produk<NAMA-TOKO></NAMA-TOKO></small>
                            <h6 class="text-heading mb-0"><NAMA-PRODUK></NAMA-PRODUK> </h6>
                            <small><NAMA-VARIAN></NAMA-VARIAN></small>
                        </div>
                    </div>'
            ),
            array(
                "get" => "add",
                "database" => $db_array_website,
                'array_detail' => array(
                    "nama_barang" => "Nama",
                    "nama_varian" => "Varian",
                    "harga_utama" => "Harga",
                    "barcode_utama" => "Barcode",
                    "nama_toko" => "Toko"
                ),
                'search_row' => array("inventaris__asset__list__varian.barcode", "inventaris__asset__list.barcode", "nama_barang", 'nama_varian', "nama_toko"),
                "connect" => [

                    "id_inventaris__asset__list" => array("id_inventaris__asset__list", "number"),
                    "id_store_produk" => array("id_produk", "number", "id_store__produk"),
                    "id_store_toko" => array("id_store_toko", "number", "store__toko.id"),
                    "id_store__varian" => array("id_varian", "number", "store__produk__varian.id"),
                    "id_barang_varian" => array("id_barang_varian", "number"),
                ]

            )
        );
        $array_sub_kategori[0][] = array("Nama Barang", "id_inventaris__asset__list", "hidden_input", array("inventaris__asset__list", null, "nama_barang"), null);

        $array_sub_kategori[0][] = array("Produk", "id_produk", "hidden_input", array('store__produk', null, 'nama_produk'), null);
        $array_sub_kategori[0][] =  array("Store Toko", "id_store_toko", "hidden_input", array('store__produk__varian', null, 'id'), null);
        $array_sub_kategori[0][] =  array("Varian", "id_varian", "hidden_input", array('store__produk__varian', null, 'id'), null);
        $array_sub_kategori[0][] =  array("Varian Asset", "id_barang_varian", "hidden_input", array('store__produk__varian', null, 'id'), null);
        $array_sub_kategori[0][] = array("Cart", "id_cart", "hidden_input", array('erp__pos__pra_order', null, 'id_produk'), null);
        // $array_sub_kategori[0][] = array("Harga", "harga", "select", array('store__produk__harga', null, 'id'), null);
        // $array_sub_kategori[0][] = array("Bundle Harga", "bundle_harga_pesan", "select", array('store__bundle__harga', null, 'id'), null);

        // $array_sub_kategori[0][] =  array("Expired Date", "expired_date", "date");
        $array_sub_kategori[0][] =  array("kode_pengiriman", "kode_pengiriman", "hidden_input");
        $array_sub_kategori[0][] =  array("Harga Penjualan", "harga_penjualan", "number-cur");
        $array_sub_kategori[0][] =  array("QTY", "qty", "number");
        $array_sub_kategori[0][] =  array("Tipe Diskon", "tipe_diskon", "select-manual", array("Harga" => "Harga", "Persentase" => "Persentase"));
        $array_sub_kategori[0][] =  array("Diskon", "diskon_utama", "number-cur");

        $array_sub_kategori[0][] =  array("Berat Satuan", "berat_satuan", "number");
        $array_sub_kategori[0][] =  array("Berat Total", "berat_total", "number");
        if ($view_page_proses  == $purchase_request) {
            $array_sub_kategori[0][] =  array("QTY Request", "qty_request", "number-editview");
            $array_sub_kategori[0][] =  array("Tipe Diskon Request", "tipe_diskon_request", "number-editview");
            $array_sub_kategori[0][] =  array("Diskon Request", "diskon_request", "number-editview");
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_request'] = 'qty';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['tipe_diskon_request'] = 'tipe_diskon';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['diskon_request'] = 'diskon_utama';
        }
        if ($view_page_proses  == $purchase_order or $view_page_proses  == $sales_order) {
            $array_sub_kategori[0][] =  array("QTY Pesanan", "qty_pesanan", "hidden_input");
            $array_sub_kategori[0][] =  array("Tipe Diskon Pesanan", "tipe_diskon_pesanan", "hidden_input", array("Harga" => "Harga", "Persentase" => "Persentase"));
            $array_sub_kategori[0][] =  array("Diskon Pesanan", "diskon_pesanan", "hidden_input");
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_pesanan'] = 'qty';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['tipe_diskon_pesanan'] = 'tipe_diskon';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['diskon_pesanan'] = 'diskon_utama';





            $page['crud']['function_js'][] =  array(
                "type" => "input-changer",
                "name" => "change_pesanan",
                "parameter" => "e,id_row",
                "parameter_input" => "this,<NUMBERING></NUMBERING>",
                "row" => array("qty_pesanan", "tipe_diskon_pesanan", 'diskon_pesanan'),
                "id_row" => true,
                "input" => array("onkeyup"),
                "get" => array("qty_pesanan" => "id_row", "tipe_diskon_pesanan" => "id_row", "diskon_pesanan" => "id_row"),

                "result" => array(
                    array(
                        "type" => "to_val_row",
                        "elemen" => "qty",
                        "input" => "id",
                        "triger" => "change",
                        "var" => "qty_pesanan"
                    ),
                    array(
                        "type" => "to_val_row",
                        "elemen" => "tipe_diskon",
                        "input" => "id",
                        "triger" => "change",
                        "var" => "tipe_diskon_pesanan"
                    ),
                    array(
                        "type" => "to_val_row",
                        "elemen" => "diskon_utama",
                        "input" => "id",
                        "triger" => "change",
                        "var" => "diskon_pesanan"
                    ),
                    array(
                        "type" => "call_function",
                        "name_function" => "change_subtotal",
                        "parameter" => "e,id_row"
                    )
                )
            );
        }
        if ($view_page_proses  == $sales_qoutation) {
            $array_sub_kategori[0][] =  array("Harga Beli Quotation", "harga_beli_quotation", "text-number-right");
            $array_sub_kategori[0][] =  array("Qty Quotation", "qty_quotation", "text-number-right");
            $array_sub_kategori[0][] =  array("Diskon Quotation", "diskon_quotation", "text-number-right");

            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['harga_quotation'] = 'harga_penjualan';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_quotation'] = 'qty';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['tipe_diskon_quotation'] = 'tipe_diskon';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['diskon_quotation'] = 'diskon_utama';
        }
        if ($view_page_proses  == $kontrabon) {
            $array_sub_kategori[0][] =  array("Harga Beli Kontrabon", "harga_beli_kontrabon", "text-number-right");
            $array_sub_kategori[0][] =  array("Qty Kontrabon", "qty_kontrabon", "text-number-right");
            $array_sub_kategori[0][] =  array("Qty Kontrabon", "tipe_diskon_kontrabon", "text-number-right");
            $array_sub_kategori[0][] =  array("Diskon Kontrabon", "diskon_kontrabon", "text-number-right");

            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['harga_beli_kontrabon'] = 'harga_penjualan';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_kontrabon'] = 'qty';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['tipe_diskon_kontrabon'] = 'tipe_diskon';
            $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['diskon_kontrabon'] = 'diskon_utama';
        }


        // if ($type_page == 'Barang Jadi Ecommerce') {

        //     $array_sub_kategori[0][] = array("Margin Distributor", "margin_distibutor_pesan", "hidden_input");
        //     $array_sub_kategori[0][] = array("Tipe Margin Harga Distributor", "tipe_margin_harga_distributor_pesan",  "hidden_input", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] = array("Tipe Selisih Harga Distributor", "tipe_selisih_harga_distributor_pesan", "hidden_input", "select-manual", array("-" => "Kurang", "+" => "Tambah"));
        //     $array_sub_kategori[0][] = array("Harga Distributor", "harga_distributor_pesan",  "hidden_input", "number");

        //     $array_sub_kategori[0][] = array("Margin Harga Jual", "margin_harga_jual_pesan", "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Tipe Margin Harga Jual", "tipe_harga_jual_pesan", "hidden_input", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] = array("Tipe Selisih Harga Jual", "tipe_selisih_harga_jual_pesan",  "hidden_input", "select-manual", array("-" => "Kurang", "+" => "Tambah"));
        //     $array_sub_kategori[0][] = array("Harga Jual", "harga_jual_satuan_pesan",  "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Harga Jual QTY", "harga_jual_qty_pesan", "hidden_input", "number");



        //     $array_sub_kategori[0][] = array("ID Diskon Toko", "id_diskon_toko_pesan", "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Diskon Toko", "diskon_toko_pesan",  "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Tipe Diskon Toko", "tipe_diskon_toko_pesan",  "hidden_input", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] = array("Harga Diskon Toko", "harga_diskon_toko",  "number");

        //     $array_sub_kategori[0][] = array("Mitra Toko", "id_mitra_toko",  "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Mitra Toko", "diskon_mitra_pesan",  "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Tipe Mitra Toko", "tipe_diskon_mitra_pesan",  "hidden_input", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] =  array("Harga Mitra Toko", "harga_diskon_mitra", "number");

        //     $array_sub_kategori[0][] = array("User Toko", "id_user_toko", "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("User Toko", "diskon_user_pesan", "hidden_input", "number");
        //     $array_sub_kategori[0][] = array("Tipe User Toko", "tipe_diskon_user_pesan", "hidden_input", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] = array("Harga User Toko", "harga_diskon_user", "number");


        //     $array_sub_kategori[0][] = array("Donasi Baitul Mal", "donasi_baitul_mal", "number");
        //     $array_sub_kategori[0][] = array("tipe_Donasi Baitul Mal", "tipe_donasi_baitul_mal", "select-manual", array("%" => "%", "Rp" => "Rp"));
        //     $array_sub_kategori[0][] = array("Harga Donasi Baitul Mal", "harga_donasi_baitul_mal", "number");
        // }
        $array_sub_kategori[0][] = array(
            "Diskon",
            "diskon_detail",
            "modalform-subkategori-add",
            array(
                "type" => "many",
                "view_form" => "table",
                "view_modalform" => "inline",
                "database" =>  $database_utama . "__detail__diskon",
                "array" => array(
                    // array("", "id_inventaris__asset__list_diskon", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                    // array("", "id_store_produk_diskon", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                    // array("", "id_barang_varian_diskon", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                    // array("", "id_produk_varian_diskon", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                    array("Jenis Diskon ", "jenis_diskon", "select-manual", array("Toko" => "Toko")),
                    array("Harga Jual ", "harga_jual_diskon", "number"),
                    array("Margin Diskon", "margin_diskon", "number-cur"),
                    array("Tipe Margin Diskon", "tipe_margin_diskon", "number"),

                    array("", "total_diskon", "number-cur"),
                    array("", "id_diskon_relation", "hidden_input"),
                    array("", "informasi_diskon_relation", "hidden_input"),
                    array("", "maksimal_margin", "hidden_input"),
                    array("", "nama_promo", "hidden_input"),
                ),
            )
        );
        $array_sub_kategori[0][] =     array("Pajak", "pajak_seq", "select", array('webmaster__pajak', null, 'nama_pajak'), null);
        $array_sub_kategori[0][] =     array("Total", "grand_total", "number-cur");
        $array_sub_kategori[0][] =     array("Total Pajak", "total_pajak", "hidden_input");
        $array_sub_kategori[0][] =     array("Total Harga", "total_harga", "hidden_input");
        $array_sub_kategori[0][] =     array("Total Diskon", "total_diskon", "hidden_input");


        $db_toko_detail['utama'] = 'store__toko';
        $db_toko_detail['primary_key'] = null;
        $db_toko_detail['select'][] = '*';
        $db_toko_detail['select'][] = 'inventaris__asset__tanah__bangunan.id as primary_key';
        //  $db_toko_detail['select'][] = '(select id_kirim_ke from erp__pos__utama where erp__pos__utama.id={LOAD_ID}) as id_kirim_ke';


        $db_toko_detail['join'][] = array("inventaris__asset__tanah__bangunan", "inventaris__asset__tanah__bangunan.id", "id_inventory_bangunan_toko");
        $db_toko_detail['join'][] = array("webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "inventaris__asset__tanah__bangunan.id_provinsi");
        $db_toko_detail['join'][] = array("webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "inventaris__asset__tanah__bangunan.id_kota");
        $db_toko_detail['join'][] = array("webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "inventaris__asset__tanah__bangunan.id_kecamatan");
        $db_toko_detail['join'][] = array("webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "inventaris__asset__tanah__bangunan.id_kelurahan");
        $db_toko_detail['where'][] = array("inventaris__asset__tanah__bangunan.id_kota", " is ", " not null");
        $db_toko_detail['where'][] = array("store__toko.id", " = ", "WORKSPACE_SINGLE_TOKO|");

        $db_toko_tujuan['utama']  = "inventaris__asset__tanah__bangunan";
        $db_toko_tujuan['primary_key']  = "id";
        $db_toko_tujuan['join'][] = array("webmaster__wilayah__provinsi", "webmaster__wilayah__provinsi.provinsi_id", "inventaris__asset__tanah__bangunan.id_provinsi");
        $db_toko_tujuan['join'][] = array("webmaster__wilayah__kabupaten", "webmaster__wilayah__kabupaten.kota_id", "inventaris__asset__tanah__bangunan.id_kota");
        $db_toko_tujuan['join'][] = array("webmaster__wilayah__kecamatan", "webmaster__wilayah__kecamatan.subdistrict_id", "inventaris__asset__tanah__bangunan.id_kecamatan");
        $db_toko_tujuan['join'][] = array("webmaster__wilayah__postal_code", "webmaster__wilayah__postal_code.id", "inventaris__asset__tanah__bangunan.id_kelurahan");
        $db_toko_tujuan['where'][] = array("inventaris__asset__tanah__bangunan.id_kota", " is ", " not null");
        $db_toko_tujuan['select'] = $db_toko_detail['select'];






        $sub_kategori[1] = ["Pengiriman",  "erp__pos__delivery_order", null, "form"];
        $array_sub_kategori[1][] = array("Nomor DO", null, "text");
        $array_sub_kategori[1][] = array("Tanggal DO", null, "text");


        $array_sub_kategori[1][] = array("kode_pengiriman", "kode_pengiriman", "hidden_input");
        $array_sub_kategori[1][] = array("store_ongkir", "id_store_ongkir", "select", array("store__toko", '', 'nama_toko'));
        $array_sub_kategori[1][] = array(
            "Asal",
            "asal",
            "array_website",
            array(
                "source_list" => "template_database",
                "database_refer" => "-1",
                "database" => $db_toko_detail,
                "array" =>
                [
                    'ID' => array(
                        "refer" => "database",
                        "row" => "primary_key",
                    ),

                    'NAMA-UNIT' => array(
                        "refer" => "database",
                        "row" => "nama_unit_bangunan",
                    ),
                    'ALAMAT' => array(
                        "refer" => "database",
                        "row" => "alamat",
                    ),
                    'RT' => array(
                        "refer" => "database",
                        "row" => "rt",
                    ),
                    'RW' => array(
                        "refer" => "database",
                        "row" => "rw",
                    ),
                    'KECAMATAN' => array(
                        "refer" => "database",
                        "row" => "subdistrict_name",
                    ),
                    'KOTA' => array(
                        "refer" => "database",
                        "row" => "kota_name",
                    ),
                    'KOTA-TYPE' => array(
                        "refer" => "database",
                        "row" => "type",
                    ),
                    'KELURAHAN' => array(
                        "refer" => "database",
                        "row" => "urban",
                    ),
                    'KODE-POS' => array(
                        "refer" => "database",
                        "row" => "postal_code",
                    ),
                    'PROVINSI' => array(
                        "refer" => "database",
                        "row" => "provinsi",
                    ),
                    'NOMOR' => array(
                        "refer" => "database",
                        "prefix" => " No.",
                        "row" => "nomor_bangunan",
                    ),
                ],

                "template_content" => '
                    <div class="">
 
                    <div class="border p-4 rounded-3">
                        <div class=" mb-2">
                            <label class="form-check-label text-dark " for="homeRadio">
                                <NAMA-UNIT></NAMA-UNIT>
                            </label>
                            
                        </div>
                        <p class="mb-0"><ALAMAT></ALAMAT> <NOMOR></NOMOR> RT <RT></RT>/<RW></RW><br>

                            KEL: <KELURAHAN></KELURAHAN> KEC:<KECAMATAN></KECAMATAN>,<br>

                            <KOTA-TYPE></KOTA-TYPE> <KOTA></KOTA> <KODE-POS></KODE-POS>,<br>

                            <PROVINSI></PROVINSI></p>
                    </div>
                
                </div>  '
            ),
            array(
                "get" => "database",
                "connect" => [


                    "primary_key" => array("id_bangunan_asal", "number", "inventaris__asset__tanah__bangunan.id"),
                    "id_provinsi" => array("id_provinsi_asal", "number", "inventaris__asset__tanah__bangunan.id_provinsi"),
                    "id_kota" => array("id_kota_asal", "number", "inventaris__asset__tanah__bangunan.id_kota"),
                    "id_kecamatan" => array("id_kecamatan_asal", "number", "inventaris__asset__tanah__bangunan.id_kecamatan"),
                    "id_kelurahan" => array("id_kelurahan_asal", "number", "inventaris__asset__tanah__bangunan.id_kelurahan"),
                    "nomor_bangunan" => array("nomor_asal", "number", "inventaris__asset__tanah__bangunan.nomor_bangunan"),
                    "alamat" => array("alamat_asal", "textarea", "inventaris__asset__tanah__bangunan.alamat"),
                    "rt" => array("rt_asal", "number", "inventaris__asset__tanah__bangunan.rt"),
                    "rw" => array("rw_asal", "number", "inventaris__asset__tanah__bangunan.rw"),
                ]

            )
        );
        $array_sub_kategori[1][] = array(
            "Tujuan",
            "tujuan",
            "array_website",
            array(
                "source_list" => "template_database",
                "database_refer" => "-1",
                "database" => $db_toko_tujuan,
                "array" =>
                [
                    'ID' => array(
                        "refer" => "database",
                        "row" => "primary_key",
                    ),

                    'NAMA-UNIT' => array(
                        "refer" => "database",
                        "row" => "nama_unit_bangunan",
                    ),
                    'ALAMAT' => array(
                        "refer" => "database",
                        "row" => "alamat",
                    ),
                    'RT' => array(
                        "refer" => "database",
                        "row" => "rt",
                    ),
                    'RW' => array(
                        "refer" => "database",
                        "row" => "rw",
                    ),
                    'KECAMATAN' => array(
                        "refer" => "database",
                        "row" => "subdistrict_name",
                    ),
                    'KOTA' => array(
                        "refer" => "database",
                        "row" => "kota_name",
                    ),
                    'KOTA-TYPE' => array(
                        "refer" => "database",
                        "row" => "type",
                    ),
                    'KELURAHAN' => array(
                        "refer" => "database",
                        "row" => "urban",
                    ),
                    'KODE-POS' => array(
                        "refer" => "database",
                        "row" => "postal_code",
                    ),
                    'PROVINSI' => array(
                        "refer" => "database",
                        "row" => "provinsi",
                    ),
                    'NOMOR' => array(
                        "refer" => "database",
                        "prefix" => " No.",
                        "row" => "nomor_bangunan",
                    ),
                ],

                "template_content" => '
                    <div class="">
 
                    <div class="border p-4 rounded-3">
                        <div class=" mb-2">
                            <label class="form-check-label text-dark " for="homeRadio">
                                <NAMA-UNIT></NAMA-UNIT>
                            </label>
                            
                        </div>
                        <p class="mb-0"><ALAMAT></ALAMAT> <NOMOR></NOMOR> RT <RT></RT>/<RW></RW><br>

                            KEL: <KELURAHAN></KELURAHAN> KEC:<KECAMATAN></KECAMATAN>,<br>

                            <KOTA-TYPE></KOTA-TYPE> <KOTA></KOTA> <KODE-POS></KODE-POS>,<br>

                            <PROVINSI></PROVINSI></p>
                    </div>
                
                </div>  '
            ),
            array(
                "get" => "form_input_value",
                "form_input_value" => "id_kirim_ke",
                "form_input_get" => "inventaris__asset__tanah__bangunan.id",
                "connect" => [


                    "primary_key" => array("id_bangunan_tujuan", "number"),
                    "id_provinsi" => array("id_provinsi_tujuan", "number", "inventaris__asset__tanah__bangunan.id_provinsi"),
                    "id_kota" => array("id_kota_tujuan", "number", "inventaris__asset__tanah__bangunan.id_kota"),
                    "id_kecamatan" => array("id_kecamatan_tujuan", "number", "inventaris__asset__tanah__bangunan.id_kecamatan"),
                    "id_kelurahan" => array("id_kelurahan_tujuan", "number", "inventaris__asset__tanah__bangunan.id_kelurahan"),
                    "nomor_bangunan" => array("nomor_tujuan", "number", "inventaris__asset__tanah__bangunan.nomor_bangunan"),
                    "alamat" => array("alamat_tujuan", "textarea", "inventaris__asset__tanah__bangunan.alamat"),
                    "rt" => array("rt_tujuan", "number", "inventaris__asset__tanah__bangunan.rt"),
                    "rw" => array("rw_tujuan", "number", "inventaris__asset__tanah__bangunan.rw"),
                ]

            )
        );
        // $array_sub_kategori[1][] = array("provinsi_asal", "provinsi_asal", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi", 'asal'));
        // $array_sub_kategori[1][] = array("provinsi_asal", "provinsi_asal", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi", 'asal'));
        // $array_sub_kategori[1][] = array("kota_asal", "id_bangunan_asal", "number");
        // $array_sub_kategori[1][] = array("kota_asal", "id_kota_asal", "number");
        // $array_sub_kategori[1][] = array("kecamatan_asal", "id_kecamatan_asal", "number");
        // $array_sub_kategori[1][] = array("kelurahan_asal", "id_kelurahan_asal", "number");
        // $array_sub_kategori[1][] = array("alamat_asal", "alamat_asal", "textarea");
        // $array_sub_kategori[1][] = array("provinsi_tujuan", "id_provinsi_tujuan", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi", 'tujuan'));
        // $array_sub_kategori[1][] = array("kota_tujuan", "id_kota_tujuan", "number");
        // $array_sub_kategori[1][] = array("kecamatan_tujuan", "id_kecamatan_tujuan", "number");
        // $array_sub_kategori[1][] = array("kelurahan_tujuan", "id_kelurahan_tujuan", "number");
        // $array_sub_kategori[1][] = array("alamat_tujuan", "alamat_tujuan", "textarea");
        $array_sub_kategori[1][] = array(
            "Barang",
            "detail_do",
            "modalform-subkategori-add",
            array(
                "type" => "many",
                "view_form" => "table",
                "view_modalform" => "inline",
                "database" =>  "erp__pos__delivery_order__detail",
                "array" => array(
                    array("Nama Barang", "id_inventaris__asset__list_do", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                    array("QTY Pesan", "qty_pesan_do", "number"),
                    array("berat_satuan", "berat_satuan_do", "number"),
                    array("berat_total", "berat_total_do", "number"),
                    array("QTY Kirim", "qty_kirim", "number"),
                    array("Sisa QTY kirim", "sisa_qty_kirim", "number"),
                ),
            )
        );
        $page['crud']['miror_sub_kategori'][$database_utama . "__detail"]["to"] = "erp__pos__delivery_order__detail";
        $page['crud']['miror_sub_kategori'][$database_utama . "__detail"]["tipe_miror"] = "full-get"; // full tiap input semua masuk 
        $page['crud']['miror_sub_kategori'][$database_utama . "__detail"]["array"] = [
            "id_inventaris__asset__list_do"     => ["data", "id_inventaris__asset__list"],
            "qty_pesan_do"                      => ["data", "qty"],
            "berat_satuan_do"                   => ["data", "berat_satuan"],
            "berat_total_do"                    => ["data", "berat_total"],
            "qty_kirim"                         => ["data", "qty"],
            "sisa_qty_kirim"                    => ["text", "0"],
        ]; // full tiap input semua masuk 

        $array_sub_kategori[1][] = array("total_berat", "total_berat", "number");
        $array_sub_kategori[1][] = array("ekspedisi", "id_ekpedisi", "select", array("webmaster__ekspedisi", null, "nama_ekspedisi"));
        $array_sub_kategori[1][] = array("service", "service", "select", array("webmaster__ekspedisi__service", null, "nama_service"));
        $array_sub_kategori[1][] = array("total_ongkir", "ongkir", "number-cur");
        $array_sub_kategori[1][] = array("promo_ongkir", "harga_diskon_ongkir", "number-cur");
        $array_sub_kategori[1][] = array("ongkir_akhir", "ongkir_akhir", "number-cur");

        $sub_kategori[2] = ["Pengiriman",  "erp__pos__payment", null, "form"];

        $page['crud']['database_sub_kategori']['erp__pos__payment']['join'][] = ["erp__pos__utama", "erp__pos__utama.id_payment", "erp__pos__payment.id", "inner"];
        $array_sub_kategori[2][] = array("kode_pengiriman", "kode_pengiriman", "hidden_input");

        $array_sub_kategori[2] = array(
            array("Nomor Payment", null, "text"),
            array("Tanggal Payment", null, "date"),
            array("Total Bayar", null, "number"),
            array("Total Kembali", null, "number"),
            array("TOP", "top", "text-number"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            // array("Status Payment", null, "select-manual", array("Aktif" => "Aktif", "Expired" => "Expired", "Gagal" => "Gagal", "Selesai" => "Pembayaran Selesai")),
            // array("Status", "status", "select-manual-req", $status)
            array(
                "Cara Bayar",
                "data_receive",
                "modalform-subkategori-add",
                array(
                    "type" => "many",
                    "view_form" => "table",
                    "view_modalform" => "inline",
                    "database" =>  "erp__pos__payment__bayar",
                    "array" => array(
                        array("Metode Bayar", null, "select", array('webmaster__payment_method', null, 'nama_payment'), null),
                        array("Brand", "payment_brand", "select", array('webmaster__payment_method_brand', null, 'nama_brand'), null),
                        array("Akun Bank", null, "select", array('keuangan__akun', null, 'nama_akun'), null),
                        array("Payment Api", null, "select-editview", array('payment_api', null, 'nomor_payment_api'), null),
                        array("", "brand_nama", "hidden_input"),
                        array("", "no_rek", "hidden_input"),
                        array("", "an", "hidden_input"),
                        array("", "va_number", "hidden_input"),
                        array("", "is_api", "hidden_input"),
                        array("Nominal Bayar", "jumlah_bayar", "text"),
                        array("", "status_bayar", "select-manual", array("belum" => "Belum", "sudah" => "Sudah", "gagal" => "Gagal")),
                        array("Tanggal Bayar", null, "date"),
                        array("Tanggal Jatuh Tempo", null, "date"),
                    ),
                )
            )
        );

        $page['crud']["wizard_form"] = array(
            "list_field" => array("id_panel", "store"),
            "id_panel" => array(
                "row_to_database" => array(
                    "utama" => "store__toko",
                    "primary_key" => "id",
                ),
                "get_where" => "id_panel",
                "id_result_to" => "store",
                "output_row" => array(
                    "value" => "id",

                    "text" => "nama_toko"
                )
            ),
            "store" => array(
                "row_to_database" => array(
                    "utama" => "store__toko__gudang",
                    "primary_key" => "id",
                    "join" => array(
                        array("inventaris__asset__tanah__gudang", "id_gudang", "inventaris__asset__tanah__gudang.id"),
                    )
                ),
                "id_result_to" => "gudang",
                "get_where" => "id_store__toko",
                "output_row" => array(
                    "value" => "primary_key",

                    "text" => "nama_gudang"
                )
            ),
        );

        $page['crud']['total'] = array(
            "col-row" => "col-md-12",
            "content" => array(
                array("name" => "Total Item", "id" => "total_qty", "type" => "text"),
                array("name" => "Sub Total", "id" => "sub_total", "type" => "text"),
                array("name" => "Diskon Per Item", "id" => "diskon_per_item", "type" => "text"),
                array(
                    "name" => "Diskon",
                    "id" => "diskon",
                    "type" => "input_no_result_multi",
                    //input -> thisvalue
                    "select" => array("%", "Rp"),
                    "eventInput" => array("onkeyup" => "total"),
                    "function_js" => array(
                        "%" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "(parseFloat(sub_total_input)*(thisvalue/100))",
                                    "var" => "result"
                                )
                            )
                        ),
                        "Rp" => array(
                            "get" => array("sub_total_input" => "id"),
                            "call_function" => array("total"),
                            //execute harus ada result
                            "execute" => array(
                                array(
                                    "type" => "math",
                                    "math" => "((thisvalue))",
                                    "var" => "result"
                                )
                            )
                        )

                    ),
                ),

                array("name" => "Biaya Pengiriman", "id" => "biaya_pengiriman", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Donasi Baitul Mal", "id" => "domasi_baitul_mall", "type" => "input", "eventInput" => array("onkeyup" => "total")),
                array("name" => "Total", "id" => "total", "type" => "text"),

            )
        );
        $page['crud']['function_js'][] =  array(
            "type" => "input-changer",
            "name" => "change_subtotal",
            "parameter" => "e,id_row",
            "parameter_input" => "this,<NUMBERING></NUMBERING>",
            "row" => array("qty", "diskon_utama", 'harga_penjualan'),
            "id_row" => true,
            "input" => array("onkeyup", 'onchange'),
            "get" => array("qty" => "id_row", "harga_penjualan" => "id_row", "diskon_utama" => "id_row", "berat_satuan" => "id_row"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => ("(qty*berat_satuan)"),
                    "var" => "total_berat"
                ),
                array(
                    "type" => "math",
                    "math" => ("(qty*harga_penjualan)"),
                    "var" => "total_harga"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga*(diskon_utama/100))"),
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "math",
                    "math" => ("(total_harga-total_diskon)"),
                    "var" => "result"
                ),
            ),
            "create_elemen" => array(
                "<input type='hidden' class='total_qty_harga' >",
                "<input type='hidden' class='total_diskon'>"
            ),
            "result" => array(
                array(
                    "type" => "to_val_row",
                    "elemen" => "berat_total",
                    "input" => "id",
                    "var" => "total_berat"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_harga",
                    "input" => "id",
                    "var" => "total_harga"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "total_diskon",
                    "input" => "id",
                    "var" => "total_diskon"
                ),
                array(
                    "type" => "to_val_row",
                    "elemen" => "grand_total",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "sub_total"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "diskon_item"
                )
            )
        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "diskon_item",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_diskon",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "diskon_per_item_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "diskon_per_item_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "sub_total",
            //sub_total _total Qty * harga
            "execute" => array(
                array(
                    "type" => "sum",
                    "sum" => "total_harga",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "sub_total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "sub_total_content",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "call_function",
                    "name_function" => "total"
                )
            )

        );
        $page['crud']['function_js'][] = array(
            "type" => "calculation",
            "name" => "total",
            "get" => array("sub_total_input" => "id", "biaya_pengiriman_input" => "id", "diskon_input" => "id", "diskon_per_item_input" => "id"),
            "execute" => array(
                array(
                    "type" => "math",
                    "math" => "(((parseFloat(sub_total_input))+(parseFloat(biaya_pengiriman_input))-(parseFloat(diskon_input))-(parseFloat(diskon_per_item_input))))",
                    "var" => "result"
                )
            ),
            "result" => array(
                array(
                    "type" => "to_val",
                    "elemen" => "total_input",
                    "input" => "id",
                    "var" => "result"
                ),
                array(
                    "type" => "to_html",
                    "elemen" => "total_content",
                    "input" => "id",
                    "var" => "result"
                ),

            ),

        );
        $page['crud']['field_value_automatic']['supplier_seq']['database']['utama'] = "outsourcing__supplier";
        $page['crud']['field_value_automatic']['supplier_seq']['database']['primary_key'] = null;
        $page['crud']['field_value_automatic']['supplier_seq']['request_where'] = "outsourcing__supplier.seq";
        $page['crud']['field_value_automatic']['supplier_seq']['field'][] = array("temp_of_payment", "top");
        $page['crud']['field_value_automatic']['supplier_seq']['field'][] = array("pajak", "pajak_suplier");


        // $page['crud']['button_list_if']['param_if'][] = '!!!row:status_po???[=]Open';
        // $page['crud']['button_list_if']['text'][] = 'Closed PO';
        // $page['crud']['button_list_if']['link_type'][] = 'route';
        // $page['crud']['button_list_if']['link_route'][] = 'closed_po';
        // $page['crud']['button_list_if']['link_param'][] = '!!!row:primary_key???';

        // $page['crud']['button_list_if']['param_if'][] = '!!!row:status_po???[=]Closed';
        // $page['crud']['button_list_if']['text'][] = 'Open PO';
        // $page['crud']['button_list_if']['link_type'][] = 'route';
        // $page['crud']['button_list_if']['link_route'][] = 'open_po';
        // $page['crud']['button_list_if']['link_param'][] = '!!!row:primary_key???';



        $page['crud']['button_tambah']['type'][] = '';
        $page['crud']['button_tambah']['text'][] = '';

        $page['crud']['subtitle'] = '<div ><img src="" style="width:200px;position:absolute;top:40px;left:0"></div><div style="text-align:center"><h3 style="margin:0;padding:0;">Harlem Resto</h3><br>Jl Aceh No 64</div><br><br>';
        $number = 1;
        /*$checking =  $this->checking_database($page, $database_utama);;
        $number = 1;
        if ($checking[0]->exists_) {

            $db = DB::connection()->select("SELECT max(" . $primary_key . ") as max FROM " . $database_utama);
            $number = $db[0]->max + 1;
        }*/
        if ($view_page_proses  == $purchase_request) {
            // $page['crud']['crud_inline']['qty'] = " readonly";
            // $page['crud']['crud_inline']['tipe_diskon'] = " readonly";
            // $page['crud']['crud_inline']['diskon_utama'] = " readonly";
            // $page['crud']['crud_inline']['qty_request'] = " readonly";
            // $page['crud']['crud_inline']['tipe_diskon_request'] = " readonly";
            // $page['crud']['crud_inline']['diskon_request'] = " readonly";
        }
        if ($view_page_proses = $sales_order) {
            // $page['crud']['crud_inline']['qty_pesanan'] = " readonly";
            // $page['crud']['crud_inline']['tipe_diskon_pesanan'] = " readonly";
            // $page['crud']['crud_inline']['diskon_pesanan'] = " readonly";
        }

        $page['crud']['function']['tanggal_po']['type'] = 'help';
        $page['crud']['function']['tanggal_po']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_po']['param'][] = '!!!row???';

        $page['crud']['function']['tanggal_kirim']['type'] = 'help';
        $page['crud']['function']['tanggal_kirim']['function'] = 'tgl_indo';
        $page['crud']['function']['tanggal_kirim']['param'][] = '!!!row???';



        //in
        ////tanggal_po//tanggal_sales_order//tanggal_invoice
        $page['crud']['insert_value']['diskon'] = 0;
        $page['crud']['insert_value']['tanggal_pr'] = date('Y-m-d');
        $page['crud']['insert_value']['tanggal_po'] = date('Y-m-d');
        $page['crud']['insert_value']['tanggal_sales_order'] = date('Y-m-d');
        $page['crud']['insert_value']['tanggal_invoice'] = date('Y-m-d');
        $page['crud']['insert_value']['tanggal_do'] = date('Y-m-d');
        $page['crud']['update_value'] =  $page['crud']['insert_value'];

        // $page['crud']['insert_default_value']['status_po'] = 'Open';

        //$page['crud']['crud_inline']['inventaris__asset__list_seq'] = 'onchange="get_spesific_material(this,!!!var:no???)"';

        // $page['crud']['crud_function_sub_kategori'][$database_utama . "__detail"]['qty_sisa'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori'][$database_utama . "__detail"]['qty_pesanan'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori'][$database_utama . "__detail"]['harga_beli'] = 'hapusrupiah';
        // $page['crud']['crud_function_sub_kategori'][$database_utama . "__detail"]['diskon'] = 'hapusrupiah';
        $page['crud']['crud_function_sub_kategori'][$database_utama . "__detail"]['total'] = 'hapusrupiah';

        $page['crud']['costum_class']['qty_pesanan'] = ' text-right';
        $page['crud']['costum_class']['harga_beli'] = ' text-right';
        $page['crud']['costum_class']['diskon'] = ' text-right';
        $page['crud']['costum_class']['total'] = ' text-right';

        $page['crud']['costum_class']['inventaris__asset__list_seq'] = 'select3';
        $page['crud']['non_view']['PDFPage']['user_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr_id'] = true;
        $page['crud']['non_view']['PDFPage']['appr'] = true;

        $page['crud']['appr_no_select'] = true;

        //$page['crud']['crud_inline']['supplier_seq'] = 'onchange="get_spesific_supplier(this)"';
        $page['crud']['crud_after_form']['supplier_seq'] = "<div id='content_spesific_supplier'></div>";
        // $page['crud']['js'] = $this->js_purchashing();

        $page['crud']['insert_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_pesanan'] = 'qty_sisa';
        $page['crud']['update_default_value_sub_kategori_request'][$database_utama . "__detail"]['qty_sisa'] = 'qty_pesanan';

        //$page['crud']['insert_default_value']['user_id'] = $idUser;


        $page['crud']['delete_if']['check'] = "row";
        $page['crud']['delete_if']['row_data'] = "status";
        $page['crud']['delete_if']['value'] = $view_page_proses;
        $page['crud']['delete_if']['operan'] = ' > ';
        $page['crud']['delete_if']['true'] = false;
        $page['crud']['delete_if']['false'] = true;

        $page['crud']['edit_if']['check'] = "row";
        $page['crud']['edit_if']['row_data'] = "status";
        $page['crud']['edit_if']['value'] = $view_page_proses;
        $page['crud']['edit_if']['operan'] = ' > ';
        $page['crud']['edit_if']['true'] = false;
        $page['crud']['edit_if']['false'] = true;
        $id_page = -1;
        if($page['section']!='generate'){

            $db['utama'] = "webmaster__erp_pos__page";
            $db['where'][] = array('webmaster__erp_pos__page.page', '=', "'$type_page'");
            $get = Database::database_coverter($page, $db, array(), 'all');
            if (!$get['num_rows']) {
                $sqli['page'] = $type_page;
                CRUDFunc::crud_insert(false, $page, $sqli, [], 'webmaster__erp_pos__page', []);
                
                $get = Database::database_coverter($page, $db, array(), 'all');
            }
            if ($get['num_rows']) {
                $id_page = $get['row'][0]->id;
            }
        }else{}

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));
        $page['crud']['insert_default_value']['page'] =  $id_page;
        $page['crud']['insert_default_value']['side'] = $side;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*", "apps_user.email");;
        $page['database']['join'] = array();
        $page['database']['order'][] = array("tanggal_po desc");
        $page['database']['np'] = 1;
        if ($side == 'penjual') {
            $page['database']['where'][] = ["$database_utama.id", " in ", " (select id_$database_utama from " . $database_utama . "__detail where id_store_toko=WORKSPACE_SINGLE_TOKO|  group by id_$database_utama)"];
            $page['crud']['no_dm']['id_panel'] = true;
        }

        // $page['database']['where'][] = array("id_apps_user",);
        $page['database']['join'][]     = array("webmaster__erp_pos__page as pos_page", "id_page", "pos_page.id");
        $page['database']['where'][]     = array("pos_page.page", "=", "'$type_page'");
        $page['database']['where'][]     = array("(erp__pos__utama.status", " in ", "('$view_page_proses.2','$view_page_proses.3','8','9','10','11'))");
        $page['crud']['array'] = $array;
        return $page;
    }
    public static function data_inventory($page, $type_page, $view_page, $kategori)
    {
        $database_utama = "erp__pos__inventory";
        $primary_key = null;

        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        $get = 'all';
        if ($view_page == 'payment' or $get == 'all')
            $payment = $view_page_proses = 10;

        if ($view_page == 'outgoing' or $get == 'all')
            $outgoing = $view_page_proses = 11;
        if ($view_page == 'retur_outgoing' or $get == 'all')
            $retur_outgoing = $view_page_proses = 12;
        if ($view_page == 'refund_outgoing' or $get == 'all')
            $refund_outgoing = $view_page_proses = 13;
        if ($view_page == 'delivery_order' or $get == 'all')
            $delivery_order = $view_page_proses = 14;
        if ($view_page == 'retur_delivery_order' or $get == 'all')
            $retur_delivery_order = $view_page_proses = 15;
        if ($view_page == 'receive' or $get == 'all')
            $receive = $view_page_proses = 16;
        if ($view_page == 'retur' or $get == 'all')
            $retur = $view_page_proses = 17;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 18;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 19;
        if ($view_page == 'selesai' or $get == 'all')
            $selesai = $view_page_proses = 20;
        $array_flow_alur['alur'][$payment] = "Proses Pembayaran";
        $array_flow_alur['option_on'][$payment]['value'][$outgoing] = "Pembayaran Selesai";
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array[]  = array("Panel", null, "select", array("panel", null, "nama_panel"));
        $array[] = array("Order", "id_order", "select", array("erp__pos__utama", null, "no_sales_order"));
        // $array[] = array("Order invetory", "order_invetory", "select", array("erp__pos__utama__ongkir", null, "ekspedisi"));

        if ($view_page == 'outgoing') {
            $array[] = array("Nomor Outgoing", null, "text");
            $array[] = array("tanggal_outgoing", "tanggal_outgoing", "date");
        }
        if ($view_page == 'receive') {

            $array[] = array("Nomor Receive", null, "text");
            $array[] = array("tanggal Receive", "tanggal_diterima", "date");
        }






        $page['crud']['field_view_sub_kategori']['id_order']['type'] = 'get'; //get or add
        $page['crud']['field_view_sub_kategori']['id_order']['target'] = $database_utama . "_detail";
        $page['crud']['field_view_sub_kategori']['id_order']['target_no'] = 0;
        $page['crud']['field_view_sub_kategori']['id_order']['database']['utama'] = "erp__pos__utama__detail";
        // $page['crud']['field_view_sub_kategori']['id_order']['database']['join'][] = array("inventaris__asset__list","erp__pos__utama__detail.id_inventaris__asset__list","inventaris__asset__list.id",'left');
        $page['crud']['field_view_sub_kategori']['id_order']['database']['primary_key'] = null;
        $page['crud']['field_view_sub_kategori']['id_order']['database']['select_raw'] = "*";
        $page['crud']['field_view_sub_kategori']['id_order']['database']['where'][] = array('erp__pos__utama__detail.active', '=', "1");
        $page['crud']['field_view_sub_kategori']['id_order']['request_where'] = "id_erp__pos__utama";


        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            -1,
            "primary_key", // sesuaikan dengan id di subkategori
            array("Nama Barang", "erp__pos__utama__detail", "select", array("inventaris__asset__list", "id", "nama_barang"), 'id_inventaris__asset__list', "id_erp__pos__utama__detail"), //untuk ditampilkan
            "nama_barang" //ambil value get
        );
        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            -1,
            "id_inventaris__asset__list", // sesuaikan dengan id di subkategori
            array("Nama Barang", "id_inventaris__asset__list", "hidden"), //untuk ditampilkan
            "id_inventaris__asset__list" //ambil value get
        );
        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            -1,
            "id_erp__pos__utama__detail_get", // sesuaikan dengan id di subkategori
            array("Nama Barang", "id_erp__pos__utama__detail", "hidden"), //untuk ditampilkan
            "primary_key" //ambil value get
        );
        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            -1,
            "qty", // sesuaikan dengan id di subkategori
            array("qty", null, "number", array(1 => "Ya", 2 => "Tidak")),

        );
        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            -1,
            "harga_penjualan", // sesuaikan dengan id di subkategori
            array("Harga Penjualan", "harga", "number-cur"),

        );
        $page['crud']['field_view_sub_kategori']['id_order']['field'][] = array(
            0,
            "data outgoing", // sesuaikan dengan id di subkategori
            array(
                "data outgoing",
                "data_outgoing",
                "modalform-subkategori-add",
                array(
                    "type" => "one",
                    "view_form" => "form",
                    "database" => $database_utama . "__outgoing",
                    "array" => array(
                        array("Nama Barang", "id_barang_keluar", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                        array("QTY Pesan", "qty_pesan_keluar", "number"),
                        array("Total Keluar", "total_keluar", "number")
                    ),
                    "connect" => array(
                        array(
                            "table_sub_kategori_row" => "id_inventaris__asset__list",
                            "modalform_sub_kategori_row" => "id_barang_keluar",
                            "notif" => "Qty Pesan harus sama dengan Total Keluar"
                        ),
                    ),
                    "check_close" => array(
                        array(
                            "type_check" => "2val",
                            "val_1" => "qty_pesan_keluar",
                            "val_2" => "total_keluar",
                            "notif" => "Qty Pesan harus sama dengan Total Keluar"
                        ),
                    ),
                    "sub_kategori" => array(
                        ["Breakdown Gudang",  $database_utama . "__outgoing_breakdown", null, "form"]
                    ),
                    "array_sub_kategori" => array(
                        0 => [

                            array("Ambil dari Gudang", "id_gudang_out", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang'), null),
                            array("Ambil dari Ruang Simpan", "id_ruang_simpan_out", "select", array('inventaris__asset__tanah__gudang__ruang_bangun', null, 'nama_ruang_simpan'), null),
                            array("Harga beli", "harga_beli_out", "number-cur"),
                            array("Stok", "stok_out", "number"),
                            array("Qty Keluar", "qty_keluar_out", "number"),
                        ]

                    )
                )
            )
        );


        $sub_kategori[0] = ["Detail",  $database_utama . "_detail", null, "form"];
        $array_sub_kategori[0][] = array("Nama Barang", "erp__pos__utama__detail", "select", array("erp__pos__utama__detail", "id", "nama_barang", null, null, 'inventaris__asset__list'), "erp__pos__utama__detail_id", "id_erp__pos__utama__detail_get");
        $page['crud']['select_database_costum']['erp__pos__utama__detail_id']['select']  = array("erp__pos__utama__detail.id as erp__pos__utama__detail_id", "inventaris__asset__list.nama_barang", '*');
        $page['crud']['select_database_costum']['erp__pos__utama__detail_id']['join'][]  = array("inventaris__asset__list", 'inventaris__asset__list.id', 'erp__pos__utama__detail.id_inventaris__asset__list', 'left');
        $page['crud']['select_database_costum']['id_erp__pos__utama__detail_get'] = $page['crud']['select_database_costum']['erp__pos__utama__detail_id'];;

        $array_sub_kategori[0][] =  array("QTY Pesan", "qty_pesan", "number");
        $array_sub_kategori[0][] =  array("Harga Penjualan", "harga", "number-cur");
        $array_sub_kategori[0][] =  array("Nama Barang", "id_inventaris__asset__list", "hidden");
        $array_sub_kategori[0][] =  array("Nama Barang", "id_erp__pos__utama__detail_get", "hidden");

        if ($view_page == 'delivery_order') {
            $array_sub_kategori[0][] =  array(
                "data outgoing",
                "data_outgoing",
                "modalform-subkategori-add",
                array(
                    "type" => "one",
                    "view_form" => "form",
                    "database" => $database_utama . "__outgoing",
                    "array" => array(
                        array("Nama Barang", "barang_keluar", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                        array("QTY Pesan", "qty_pesan_keluar", "number"),
                        array("Total Keluar", "total_keluar", "number")
                    ),
                    "connect" => array(
                        array(
                            "table_sub_kategori_row" => "id_inventaris__asset__list",
                            "modalform_sub_kategori_row" => "id_barang_keluar",
                            "notif" => "Qty Pesan harus sama dengan Total Keluar"
                        ),
                    ),
                    "check_close" => array(
                        array(
                            "type_check" => "2val",
                            "val_1" => "qty_pesan_keluar",
                            "val_2" => "total_keluar",
                            "notif" => "Qty Pesan harus sama dengan Total Keluar"
                        ),
                    ),
                    "sub_kategori" => array(
                        ["Ambil dari Gudang",  $database_utama . "__outgoing_breakdown", null, "form"]
                    ),
                    "array_sub_kategori" => array(
                        0 => [

                            array("Ambil dari Gudang", "gudang_out", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang'), null),
                            array("Ambil dari Ruang Simpan", "ruang_simpan_out", "select", array('inventaris__asset__tanah__gudang__ruang_bangun', null, 'nama_ruang_simpan'), null),
                            array("Stok", "stok_out", "number"),
                            array("Harga beli", "harga_beli_out", "number-cur"),
                            array("Qty Keluar", "qty_keluar_out", "number"),
                        ]

                    )
                )
            );
        }
        //  $array_sub_kategori[0][] = array("Varian", "produk", "select", array('store__produk', null, 'nama_produk'), null);


        if ($view_page == 'delivery_order') {
            $array_sub_kategori[0][] =  array("QTY Kirim", "qty_kirim", "number");
            $array_sub_kategori[0][] =  array("Sisa QTY kirim", "sisa_qty_kirim", "number");
        }
        if ($view_page == 'receive') {
            $array_sub_kategori[0][] =  array("Status Diterima", "status_diterima", "select-manual", array('1' => "Sudah", "2" => 'Belum'), null);
            $array_sub_kategori[0][] =  array(
                "data terima",
                "data_receive",
                "modalform-subkategori-add",
                array(
                    "type" => "one",
                    "view_form" => "form",
                    "database" => $database_utama . "__receive",
                    "array" => array(
                        array("Nama Barang", "barang_in", "select", array("inventaris__asset__list", null, "nama_barang"), null),
                        array("QTY Keluar", "qty_pesan_in", "number"),
                        array("Total Masuk", "total_in", "number")
                    ),
                    "connect" => array(
                        array(
                            "table_sub_kategori_row" => "id_inventaris__asset__list",
                            "modalform_sub_kategori_row" => "id_barang_in",
                        ),
                    ),

                    "sub_kategori" => array(
                        ["Ambil Dari Gudang",  $database_utama . "__receive_breakdown", null, "form"]
                    ),
                    "array_sub_kategori" => array(
                        0 => [

                            array("Ambil dari Gudang", "gudang_in", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang'), null),
                            array("Ambil dari Ruang Simpan", "ruang_simpan_in", "select", array('inventaris__asset__tanah__gudang__ruang_bangun', null, 'nama_ruang_simpan'), null),
                            array("Stok", "stok_in", "number"),
                            array("Harga beli", "harga_beli_in", "number-cur"),
                            array("Qty Masuk", "qty_keluar_in", "number"),
                            array("Tanggal Masuk", "qty_keluar_in", "number"),
                        ]



                    )
                )
            );
        }
        if ($view_page == 'retur') {
            $array_sub_kategori[0][] =  array("QTY Retur", "qty_retur", "number");
            $array_sub_kategori[0][] =  array("Keterangan Retur", "keterangan_retur", "number");
        }
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));
        $nomor_add = '.';
        $ex_type_page = explode('_', $type_page);
        for ($i = 0; $i < count($ex_type_page); $i++) {
            $nomor_add .= strtoupper($ex_type_page[$i][0]);
        }


        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['join'][]     = array("erp__pos__utama as utama ", "erp__pos__inventory.id_order", "utama.id", 'left');
        $page['database']['join'][]     = array("webmaster__erp_pos__page as pos_page", "utama.id_page", "pos_page.id", 'left');
        $page['database']['where'][]     = array("pos_page.page", "=", "'$type_page'");
        $page['crud']['array'] = $array;
        return $page;
    }
    public static function data_delivery($page, $type_page, $view_page, $kategori)
    {
        $page_temp = $page;
        $database_utama = "erp__pos__delivery_order";
        $primary_key = null;

        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        $get = 'all';
        if ($view_page == 'payment' or $get == 'all')
            $payment = $view_page_proses = 10;

        if ($view_page == 'outgoing' or $get == 'all')
            $outgoing = $view_page_proses = 11;
        if ($view_page == 'retur_outgoing' or $get == 'all')
            $retur_outgoing = $view_page_proses = 12;
        if ($view_page == 'refund_outgoing' or $get == 'all')
            $refund_outgoing = $view_page_proses = 13;
        if ($view_page == 'delivery_order' or $get == 'all')
            $delivery_order = $view_page_proses = 14;
        if ($view_page == 'retur_delivery_order' or $get == 'all')
            $retur_delivery_order = $view_page_proses = 15;
        if ($view_page == 'receive' or $get == 'all')
            $receive = $view_page_proses = 16;
        if ($view_page == 'retur' or $get == 'all')
            $retur = $view_page_proses = 17;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 18;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 19;
        if ($view_page == 'selesai' or $get == 'all')
            $selesai = $view_page_proses = 20;
        $array_flow_alur['alur'][$payment] = "Proses Pembayaran";
        $array_flow_alur['option_on'][$payment]['value'][$outgoing] = "Pembayaran Selesai";
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array_sub_kategori[1][] = array("kode_pengiriman", "kode_pengiriman", "text");
        $array_sub_kategori[1][] = array("store_ongkir", "id_store_ongkir", "select", ["store__toko", "", "nama_toko"]);
        $array_sub_kategori[1][] = array("provinsi_asal", "provinsi_asal", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi", 'asal'));
        $array_sub_kategori[1][] = array("kota_asal", "id_kota_asal", "number");
        $array_sub_kategori[1][] = array("kecamatan_asal", "id_kecamatan_asal", "number");
        $array_sub_kategori[1][] = array("kelurahan_asal", "id_kelurahan_asal", "number");
        $array_sub_kategori[1][] = array("alamat_asal", "alamat_asal", "textarea");
        $array_sub_kategori[1][] = array("provinsi_tujuan", "id_provinsi_tujuan", "select", array("webmaster__wilayah__provinsi", "provinsi_id", "provinsi", 'tujuan'));
        $array_sub_kategori[1][] = array("kota_tujuan", "id_kota_tujuan", "number");
        $array_sub_kategori[1][] = array("kecamatan_tujuan", "id_kecamatan_tujuan", "number");
        $array_sub_kategori[1][] = array("kelurahan_tujuan", "id_kelurahan_tujuan", "number");
        $array_sub_kategori[1][] = array("alamat_tujuan", "alamat_tujuan", "textarea");

        $array_sub_kategori[1][] = array("ekspedisi", "id_ekpedisi", "select", array("webmaster__ekspedisi", null, "nama_ekspedisi"));
        $array_sub_kategori[1][] = array("service", "service", "select", array("webmaster__ekspedisi__service", null, "nama_service"));
        $array_sub_kategori[1][] = array("total_ongkir", "ongkir", "number-cur");
        $array_sub_kategori[1][] = array("promo_ongkir", "harga_diskon_ongkir", "number");
        $array_sub_kategori[1][] = array("ongkir_akhir", "ongkir_akhir", "number-cur");
        $array[] = array("Nomor DO", null, "text");
        $array[] = array("Order", "id_erp__pos__utama", "select", array("erp__pos__utama", null, "no_purchose_order"));

        $array[] = array("Kode Pengiriman", null, "text");
        $array[] = array("ekspedisi", "id_ekpedisi", "select", array("webmaster__ekspedisi", null, "kode_ekspedisi"));
        $array[] = array("service", "service", "select", array("webmaster__ekspedisi__service", null, "nama_service"));
        $array[] = array("total_ongkir", "ongkir", "number-cur");
        $array[] = array("promo_ongkir", "harga_diskon_ongkir", "number");
        $array[] = array("ongkir_akhir", "ongkir_akhir", "number-cur");
        $array[] = array("tanggal_kirim", "tanggal_kirim", "date");
        $array[] = array("harga Kirim", "harga_kirim", "number");
        $array[] = array("Nomor Resi", null, "text");
        $array[] = array("Status Pickup Kurir", null, "select-manual", array("Belum" => "Belum", "Sudah" => "Sudah"));

        $nomor_add = '.';
        $ex_type_page = explode('_', $type_page);
        for ($i = 0; $i < count($ex_type_page); $i++) {
            $nomor_add .= strtoupper($ex_type_page[$i][0]);
        }
        $page['crud']['insert_number_code']['nomor_receive']['prefix'] = "RC$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['nomor_receive']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor_receive']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor_receive']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['nomor_receive']['root']['month_get_row_where'][0] = "tanggal_diterima";
        $page['crud']['insert_number_code']['nomor_receive']['root']['not_string'] = "tanggal_diterima";
        $page['crud']['insert_number_code']['nomor_receive']['suffix'] = '';

        $page['crud']['insert_number_code']['nomor_outgoing']['prefix'] = "OUT$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['nomor_outgoing']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor_outgoing']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['nomor_outgoing']['root']['month_get_row_where'][0] = "tanggal_outgoing";
        $page['crud']['insert_number_code']['nomor_outgoing']['root']['not_string'] = "tanggal_outgoing";
        $page['crud']['insert_number_code']['nomor_outgoing']['suffix'] = '';

        $page['crud']['insert_number_code']['nomor_do']['prefix'] = "DO$nomor_add." . sprintf('%02d', date('m')) . date('y') . '.';
        $page['crud']['insert_number_code']['nomor_do']['root']['type'][0] = 'count-month';
        $page['crud']['insert_number_code']['nomor_do']['root']['sprintf'][0] = true;
        $page['crud']['insert_number_code']['nomor_do']['root']['sprintf_number'][0] = 5;
        $page['crud']['insert_number_code']['nomor_do']['root']['month_get_row_where'][0] = "tanggal_do";
        $page['crud']['insert_number_code']['nomor_do']['root']['not_string'] = "tanggal_do";
        $page['crud']['insert_number_code']['nomor_do']['suffix'] = '';
        $page['crud']['update_number_code'] = $page['crud']['insert_number_code'];


        $sub_kategori[0] = ["Detail",  $database_utama . "__detail", null, "form"];
        $array_sub_kategori[0][] = array("Nama Barang", "inventaris__asset__list_do", "select", array("inventaris__asset__list", null, "nama_barang"), null);



        $array_sub_kategori[0][] =  array("", "berat_satuan_do", "number");
        $array_sub_kategori[0][] =  array("", "berat_total_do", "number");
        $array_sub_kategori[0][] =  array("QTY Pesan", "qty_pesan_do", "number");
        $array_sub_kategori[0][] =  array("QTY Kirim", "qty_kirim", "number");
        $array_sub_kategori[0][] =  array("Sisa QTY kirim", "sisa_qty_kirim", "number");




        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['join'][]     = array("erp__pos__utama as utama ", " $database_utama.id_erp__pos__utama", "utama.id", 'left');
        $page['database']['join'][]     = array("webmaster__erp_pos__page as pos_page", "utama.id_page", "pos_page.id", 'left');
        $page['database']['where'][]     = array("pos_page.page", "=", "'$type_page'");
        $page['crud']['array'] = $array;

        // if (Partial::input('id') != -1 and Partial::input('id')) {

        //     DB::table($database_utama . "__detail");
        //     DB::selectRaw('
        //     *
        //     ');
        //     DB::whereRaw("id_erp__pos__delivery_order=" . Partial::input('id'));
        //     $get_total = DB::get("all");
        //     print_r($get_total);
        //     if (!$get_total['num_rows']) {
        //         DB::table("erp__pos__utama__detail");
        //         DB::joinRaw("$database_utama on erp__pos__utama__detail.id_erp__pos__utama = $database_utama.id_erp__pos__utama");
        //         // DB::joinRaw('$database_utama__detail on $database_utama__detail.id_$database_utama = $database_utama.id');
        //         DB::selectRaw('*');
        //         DB::whereRaw("erp__pos__delivery_order.id=" . Partial::input('id'));
        //         DB::whereRaw("erp__pos__delivery_order.kode_pengiriman =erp__pos__utama__detail.kode_pengiriman ");
        //         $get = DB::get("all");
        //         echo $get['query'];
        //         foreach ($get['row'] as $row) {

        //             $sqli['id_inventaris__asset__list'] = $row->id_inventaris__asset__list;
        //             $sqli['qty_pesan'] = $row->qty;
        //             $sqli['berat_satuan'] = $row->berat_satuan;
        //             $sqli['berat_total'] = $row->berat_total;
        //             $sqli["id_$database_utama"] = Partial::input('id');
        //             $database_utama_detail = $database_utama . "__detail";
        //             $return = CRUDFunc::crud_save(new MainFaiFramework(),  $page_temp, $sqli, array(), array(), $database_utama_detail);
        //         }
        //     }
        // }

        return $page;
    }
    public static function data_payment($page, $type_page, $view_page, $kategori)
    {
        $database_utama = "erp__pos__payment";
        $primary_key = null;
        $get = 'all';
        if ($view_page == 'payment' or $get == 'all')
            $payment = $view_page_proses = 10;

        if ($view_page == 'outgoing' or $get == 'all')
            $outgoing = $view_page_proses = 11;
        if ($view_page == 'retur_outgoing' or $get == 'all')
            $retur_outgoing = $view_page_proses = 12;
        if ($view_page == 'refund_outgoing' or $get == 'all')
            $refund_outgoing = $view_page_proses = 13;
        if ($view_page == 'delivery_order' or $get == 'all')
            $delivery_order = $view_page_proses = 14;
        if ($view_page == 'retur_delivery_order' or $get == 'all')
            $retur_delivery_order = $view_page_proses = 15;
        if ($view_page == 'receive' or $get == 'all')
            $receive = $view_page_proses = 16;
        if ($view_page == 'retur' or $get == 'all')
            $retur = $view_page_proses = 17;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 18;
        if ($view_page == 'refund_receive' or $get == 'all')
            $refund_receive = $view_page_proses = 19;
        if ($view_page == 'selesai' or $get == 'all')
            $selesai = $view_page_proses = 20;
        $array_flow_alur['alur'][$payment] = "Proses Pembayaran";
        $array_flow_alur['option_on'][$payment]['value'][$outgoing] = "Pembayaran Selesai";
        $status_ajuan = null;
        $kategori = "";
        $view_page_proses = $$view_page;
        if (Partial::input('type') == 'tambah' or Partial::input('type') == 'edit') {
            if (isset($array_flow_alur['option_on'][$view_page_proses]['value']))
                $status = $array_flow_alur['option_on'][$view_page_proses]['value'];
        } else {
            $status = $array_flow_alur['alur'];
        }
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Order", null, "select", array("erp__pos__utama", null, "no_purchose_order")),
            array("Nomor Payment", null, "text"),
            array("Tanggal Payment", null, "date"),
            array("Total Bayar", null, "number-cur"),
            array("TOP", "top", "text-number"),
            array("Pajak", "pajak", "select-manual", array("PKP" => "PKP", "Non PKP" => "Non PKP")),
            array("Status Payment", null, "select-manual", array("Aktif" => "Aktif", "Expired" => "Expired", "Gagal" => "Gagal", "Selesai" => "Pembayaran Selesai")),
            array("Status", "status", "select-manual-req", $status)

        );
        $page['crud']['select_database_costum']['id_order']['where'][] = array('status', '=', $payment);
        $sub_kategori[] = ["Cara Bayar", "" . $database_utama  . "__bayar", null, "form"];
        $array_sub_kategori[] = array(
            array("Metode Bayar", null, "select", array('webmaster__payment_method', null, 'nama_payment'), null),
            array("Brand", "payment_brand", "select", array('webmaster__payment_method_brand', null, 'nama_brand'), null),
            array("Payment Api", null, "select-edit-view", array('payment_api', null, 'nomor_payment_api'), null),
            array("Akun Bank", null, "select", array('keuangan__akun', null, 'nama_akun'), null),
            array("", "brand_nama", "hidden_input"),
            array("", "no_rek", "hidden_input"),
            array("", "an", "hidden_input"),
            array("", "va_number", "hidden_input"),
            array("", "is_api", "hidden_input"),
            array("", "jumlah_bayar", "text"),
            array("", "status_bayar", "select-manual", array("belum" => "Belum", "sudah" => "Sudah", "gagal" => "Gagal")),
            array("Tanggal Bayar", null, "date"),
            array("Tanggal Jatuh Tempo", null, "date"),

        );
        // $sub_kategori[] = ["Summary", "" . $database_utama  . "__summary", null, "form"];
        // $array_sub_kategori[] = array(
        //     array("Metode Bayar", null, "select", array('webmaster__payment_method', null, 'nama_payment'), null),
        //     array("Brand", null, "select", array('webmaster__payment_method_brand', null, 'nama_brand'), null),
        //     array("Payment Api", null, "select", array('payment_api', null, 'nomor_payment_api'), null),
        //     array("", "brand_nama", "text"),
        //     array("", "no_rek", "text"),
        //     array("", "an", "text"),
        //     array("", "va_number", "text"),
        //     array("", "is_api", "text"),
        //     array("", "jumlah_bayar", "text"),
        //     array("", "status_bayar", "select-manual", array("belum" => "Belum", "sudah" => "Sudah", "gagal" => "Gagal")),
        //     array("Tanggal Bayar", null, "date"),
        //     array("Tanggal Jatuh Tempo", null, "date"),

        // );
        // $sub_kategori[] = ["Accounting", "" . $database_utama  . "__accounting", null, "form"];
        // $array_sub_kategori[] = array(
        //     array("Coa", null, "select", array('webmaster__payment_method', null, 'nama_payment'), null),
        //     array("Tanggal Bayar", null, "date"),
        //     array("", "jumlah_bayar", "text"),
        //     array("Debit", null, "number"),
        //     array("Kredit", null, "number"),

        // );



        $page['crud']['crud_after'] = "
        <script>
        $('#id_order0').bind('click change', function(e) {
            select_order($(this).val());
          })
        function select_order(id) {
           
            if (typeof(id) !== 'undefined') {
                id=$('#id_order0').val();
               alert(id);
            
            $.ajax({
                type: 'GET',
                data: $('#formvte_fai_framework').serialize() +
                    '&link_route=' + $('#load_link_route').val() +
                    '&apps=' + $('#load_apps').val() +
                    '&page_view=' + $('#load_page_view').val() +
                    '&type=select_order' +
                    '&id=' + $('#load_id').val() +
                    '&get_id_order=' + id +
                    +
                    '&MainAll=2' +
                    '&contentfaiframework=get_pages',
                url: $('#load_link_route').val(),
                dataType: 'json',
                success: function(data) {
                    $('#total_bayar0').val(data.sub_total) ;
                },
                error: function(error) {
                    console.log('error; ' + eval(error));
                    //alert(2);
                }
            });
            }   
        }
        </script>
        ";
        $page['crud']['crud_inline']['total_bayar'] = " readonly ";


        //in
        ////tanggal_po//tanggal_sales_order//tanggal_invoice
        $page['crud']['insert_value']['tanggal_payment'] = date('Y-m-d');

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        $page['database']['join'] = array();
        $page['database']['join'][]     = array("erp__pos__utama as utama ", "$database_utama.id_order", "utama.id", 'left');
        $page['database']['join'][]     = array("webmaster__erp_pos__page as pos_page", "utama.id_page", "pos_page.id", 'left');
        $page['database']['where'][]     = array("pos_page.page", "=", "'$type_page'");
        $page['crud']['array'] = $array;
        return $page;
    }

    public static function data_pra_order($page, $type_page, $view_page, $kategori)
    {
        $database_utama = "erp__pos__pra_order";
        $primary_key = null;
        if ($view_page == 'request')
            $view_page_proses = 1;
        else if ($view_page == 'outgoing')
            $view_page_proses = 2;
        else if ($view_page == 'receive')
            $view_page_proses = 3;
        else if ($view_page == 'retur')
            $view_page_proses = 4;

        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array = array(
            array("Apps User", null, "select", array("apps_user", "id_apps_user", "nama_lengkap")),
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Asset", null, "select", array("inventaris__asset__list", null, "nama_barang")),
            array("Produk", null, "select", array("store__produk", null, "nama_produk")),
            array("Asset Varian", null, "select", array("inventaris__asset__list__varian", null, "nama_varian")),
            array("Produk Varian", null, "select", array("store__produk__varian", null, "id")),
            array("Varian 1", "varian_pra_order_1", "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", 'varian1')),
            array("Varian 2", "varian_pra_order_2", "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", 'varian2')),
            array("Varian 3", "varian_pra_order_3", "select", array("inventaris__master__tipe_varian__list", null, "nama_list_tipe_varian", 'varian3')),
            array("Jumlah", null, "number"),
            array("Checked", null, "number"),
            array("Status Pra Order", null, "select-manual", array("Aktif" => "Aktif", "Hapus" => "Hapus", "Pemesanan" => "Pemesanan")),
        );

        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));
        $page['crud']['insert_default_value']['page'] = $type_page;

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        // $page['database']['join'][] = array("erp__pos__utama", "erp__pos__utama.id", "id_order");
        // $page['database']['where'][]     = array("page", "=", "'$type_page'");
        $page['crud']['array'] = $array;

        return $page;
    }
    public static function data_stok_opname($page, $type_page, $view_page, $kategori)
    {
        $database_utama = "erp__pos__stok_opname";
        $primary_key = null;
        if ($view_page == 'request')
            $view_page_proses = 1;
        else if ($view_page == 'outgoing')
            $view_page_proses = 2;
        else if ($view_page == 'receive')
            $view_page_proses = 3;
        else if ($view_page == 'retur')
            $view_page_proses = 4;

        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Nomor", "nomor_stok_opname", "text"),
            array("Tanggal", "tanggal_stok_opname", "date"),
            array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
            array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),


        );
        $sub_kategori[] = ["Barang", "" . $database_utama  . "__detail", null, "form"];
        $array_sub_kategori[] = array(
            array("Asset", null, "select", array("inventaris__asset__list", null, "nama_barang")),

            array("Data Stok", null, "number"),
            array("Data Real", null, "number"),
            array("Selisih", null, "number"),

        );

        $page['crud']['sub_kategori'] = $sub_kategori;
        $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));
        $page['crud']['insert_value']['page'] = $type_page;
        $page['crud']['valueinput']['tanggal_stok_opname'] = date('Y-m-d');

        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        // $page['database']['join'][] = array("erp__pos__utama", "erp__pos__utama.id", "id_order");
        // $page['database']['where'][]     = array("page", "=", "'$type_page'");
        $page['crud']['array'] = $array;

        return $page;
    }
    public static function get_stok($page, $id_panel, $id_gudang, $id_ruang_simpan, $id_barang, $return = 'page',$lainnya=[],$id_varian=null)
    {
        $database_utama = "";
        $primary_key = null;


        $status_ajuan = null;
        $kategori = "";
        if ($kategori == 'erp_full') {
        }
        // $array[]  = array(
        //     "Data Tipe ", "tipe_data", "radio2-manual", array(
        //         "Dari Purchase Request(Non Miror)" => "Dari Purchase Request(Non Miror)!!Data Diambil dari Purchase Request dan data dapat diedit dari data purchase request ", "Dari Purchase Request(Miror)" => "Dari Purchase Request(Miror)!!Data Diambil dari Purchase Request dan data tidak bisa di edit dan terpaku dengan purchase request ", "Data Manual" => "Data Manual!!Data langsung diinputkan dan tidak mengacu pada Purchase Request"
        //     )
        // );
        $array = array(
            array("Panel", null, "select", array("panel", null, "nama_panel")),
            array("Gudang", "gudang_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang')),
            array("Ruang", "ruang_simpan_stok_opname", "select", array('inventaris__asset__tanah__gudang', null, 'nama_gudang', 'ruang')),
            array("Asset", null, "select", array("inventaris__asset__list", null, "nama_barang")),

            array("Non Order - Barang Keluar", null, "number"),
            array("Non Order - Barang Masuk", null, "number"),
            array("Order - Pembelian - Request", null, "number"),
            array("Order - Pembelian - Purchase order", null, "number"),
            array("Order - Pembelian - Invoice", null, "number"),
            array("Order - Pembelian - Kontrabon", null, "number"),
            array("Order - Pembelian - Payment", null, "number"),
            array("Order - Pembelian - Retur", null, "number"),
            array("Order - Pembelian - Masuk", null, "number"),
            array("Order - Pembelian - Pengembalian", null, "number"),

            array("Order - Pembelian - Request", null, "number"),
            array("Order - Pembelian - Sales order", null, "number"),
            array("Order - Pembelian - Invoice", null, "number"),
            // array("Order - Pembelian - Kontrabon", null, "number"),
            // array("Order - Pembelian - Payment", null, "number"),

            array("Order - Pembelian - Delivery Order", null, "number"),
            array("Order - Pembelian - Keluar", null, "number"),
            array("Order - Pembelian - Retur Jual", null, "number"),
            array("Stok Opname", null, "number"),

            array("Total Akhir", null, "number"),
            array("Selisih", null, "number"),


        );
        // $sub_kategori[] = ["Barang", "" . $database_utama  . "__detail", null, "form"];
        // $array_sub_kategori[] = array(

        // );

        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['sub_kategori'] = $sub_kategori;
        // $page['crud']['array_sub_kategori'] = $array_sub_kategori;
        // $page['crud']['search'] = array(-2 => array(12, 1), 1 => array(12));
        // $page['crud']['insert_value']['page'] = $type_page;
        $page['crud']['valueinput']['tanggal_stok_opname'] = date('Y-m-d');
        $where_all = "";
        $where_rekap_akhir = "";
        if ($id_barang) {
            $where_all .= " and id = $id_barang";
            $where_rekap_akhir .= " and id = $id_barang";
        }
        if ($id_varian) {
            $where_all .= " and id_varian = $id_varian";
            $where_rekap_akhir .= " and id_varian = $id_varian";
        }
        if ($id_gudang) {
            $where_all .= " and id_gudang = $id_gudang";
        }
        if ($id_ruang_simpan) {
            $where_all .= " and id_ruang_simpan = $id_ruang_simpan";
        }

        $sql = "SELECT
                id_gudang,
                id_ruang_simpan,
                nama_gudang,
                nama_ruang_simpan,
                nama_barang,
                inventaris__asset__list.id,
                all_stok.id_asset_varian as id_varian,
                tanggal,
                type,
                qty_op,
                qty_out,
                qty_in 
            FROM
                inventaris__asset__tanah__gudang
                LEFT JOIN inventaris__asset__tanah__gudang__ruang_bangun ON inventaris__asset__tanah__gudang.ID = id_inventaris__asset__tanah__gudang
                LEFT JOIN 
                (
                    (
                        SELECT
                            'Stok Opname' AS type,
                            id_gudang_stok_opname AS id_gudang,
                            id_ruang_simpan_stok_opname AS id_ruang_simpan,
                            id_asset,
                            id_asset_varian,
                            tanggal_stok_opname AS tanggal,
                            sum( selisih ) AS qty_op,
                            0 AS qty_out,
                            0 AS qty_in 
                        FROM
                            erp__pos__stok_opname
                            JOIN erp__pos__stok_opname__detail ON erp__pos__stok_opname.id = id_erp__pos__stok_opname 
                        GROUP BY
                            id_ruang_simpan_stok_opname,
                            id_gudang_stok_opname,
                            tanggal_stok_opname,
                            id_asset ,
                            id_asset_varian
                    ) 
                    UNION ALL
                    (
                        SELECT
                            'Barang Keluar' AS type,
                            erp__pos__inventory__outgoing_breakdown.id_gudang_out AS id_gudang,
                            erp__pos__inventory__outgoing_breakdown.id_ruang_simpan_out AS id_ruang_simpan,
                            id_barang_keluar AS id_asset,
                            erp__pos__inventory__outgoing_breakdown.id_barang_keluar_varian as id_asset_varian,
                            tanggal_outgoing AS tanggal,
                            0 AS qty_op,
                            SUM( erp__pos__inventory__outgoing_breakdown.qty_keluar_out ) AS qty_out,
                            0 AS qty_in 
                        FROM
                            erp__pos__inventory__outgoing
                            LEFT JOIN erp__pos__inventory ON id_erp__pos__inventory = erp__pos__inventory.id
                            LEFT JOIN erp__pos__inventory__outgoing_breakdown ON erp__pos__inventory__outgoing.ID = id_erp__pos__inventory__outgoing 
                        GROUP BY
                            erp__pos__inventory__outgoing.id_erp__pos__inventory,
                            erp__pos__inventory__outgoing_breakdown.id_gudang_out,
                            erp__pos__inventory__outgoing.id_erp__pos__inventory_detail,
                            erp__pos__inventory__outgoing_breakdown.id_ruang_simpan_out,
                            erp__pos__inventory__outgoing.id_barang_keluar,
                            erp__pos__inventory__outgoing_breakdown.id_barang_keluar_varian,
                            erp__pos__inventory.tanggal_outgoing 
                    ) UNION ALL
                    (
                        SELECT
                            'Barang Masuk' AS type,
                            erp__pos__inventory__receive_breakdown.id_gudang_in AS id_gudang,
                            erp__pos__inventory__receive_breakdown.id_ruang_simpan_in AS id_ruang_simpan,
                            id_barang_in AS id_asset,
                            id_barang_varian_in as id_asset_varian,
                            tanggal_receive AS tanggal,
                            0 AS qty_op,
                            0 AS qty_out,
                            SUM( erp__pos__inventory__receive_breakdown.qty_keluar_in ) AS qty_in 
                        FROM
                            erp__pos__inventory__receive
                            LEFT JOIN erp__pos__inventory ON id_erp__pos__inventory = erp__pos__inventory.id
                            LEFT JOIN erp__pos__inventory__receive_breakdown ON erp__pos__inventory__receive.ID = id_erp__pos__inventory__receive 
                        GROUP BY
                    erp__pos__inventory__receive.id_erp__pos__inventory,
                    erp__pos__inventory__receive_breakdown.id_gudang_in,
                    id_barang_in,
                    id_barang_varian_in,
                    tanggal_receive,
                    erp__pos__inventory__receive.id_erp__pos__inventory_detail,
                    erp__pos__inventory__receive_breakdown.id_ruang_simpan_in 
                    ) 
                ) AS all_stok ON id_gudang = inventaris__asset__tanah__gudang.id 
                    AND
                    CASE
                        
                        WHEN id_ruang_simpan IS NULL THEN
                        1 = 1 ELSE id_ruang_simpan = inventaris__asset__tanah__gudang__ruang_bangun.id
                        
                        END LEFT JOIN inventaris__asset__list ON id_asset = inventaris__asset__list.id
                        where 1=1  
               
            
                ";
        $page['database']['utama'] = $database_utama;
        $page['database']['primary_key'] = $primary_key;
        $page['database']['select'] = array("*");;
        // $page['database']['join'][] = array("erp__pos__utama", "erp__pos__utama.id", "id_order");
        // $page['database']['where'][]     = array("page", "=", "'$type_page'");
        $page['crud']['array'] = $array;
        $sql_rekap_akhir = "SELECT  
                nama_gudang,
                nama_ruang_simpan,
                nama_barang,
                id,
                id_varian,
                sum(qty_op-qty_out+qty_in) as stok
                from ($sql) as s
                where 1=1  ".($return=='rekap_akhir'?$where_all:"")."
                group by 
                nama_gudang,
                nama_ruang_simpan,
                nama_barang,
                id,
                id_varian,
                s.id_varian
                ";
                // echo $return;

            $sql_all_breakdown_varian ="SELECT 
                    inventaris__asset__list__varian.id, 
                    inventaris__asset__list.asal_barang_dari, 
                    inventaris__asset__list.id_master, 
                    inventaris__asset__list.varian_barang, 
                    inventaris__asset__list__varian.id as id_varian_utama, 
                    inventaris__asset__list__varian.asal_from_data_varian, 
                    inventaris__asset__list__varian.id_asset_list_varian, 
                    inventaris__asset__list__varian.id_master_varian, 
                    master.asal_from_data_varian as asal_from_data_varian_master, 
                    master.id_asset_list_varian as id_asset_list_varian_master, 
                    master.id_master_varian as id_master_varian_master, 
                    master_varian_asset.asal_barang_dari as asal_barang_dari_master_varian, 
                    master_varian_asset.id_api as id_api_master_varian_asset, 
                    master_varian_asset.id_sync as id_sync_master_varian_asset, 
                    case when master.asal_from_data_varian ='Asset' then master_varian_asset.nama_barang end as nama_barang 
                
                FROM store__produk 
                LEFT JOIN inventaris__asset__list on inventaris__asset__list.id = store__produk.id_asset
                LEFT JOIN inventaris__asset__list__varian on inventaris__asset__list.id = inventaris__asset__list__varian.id_inventaris__asset__list 
                LEFT JOIN inventaris__asset__list__varian as master on master.id = inventaris__asset__list__varian.id_master_varian 
                LEFT JOIN inventaris__asset__list as master_varian_asset on master_varian_asset.id = 
                            case when inventaris__asset__list__varian.asal_from_data_varian ='Master' then master.id_asset_list_varian 
                                    else inventaris__asset__list__varian.id end 
                ";
                // WHERE store__produk.id = 117
            $sql_total_asset = "SELECT
                inventaris__asset__list.id,sum(stok) as total_stok 
            FROM
                inventaris__asset__list
                LEFT JOIN (
                    SELECT
                        inventaris__asset__list__varian.id_inventaris__asset__list,
                        inventaris__asset__list__varian.id as id_varian,
                        case 
                        when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
                        then master_var.id_varian_1 
                        else  inventaris__asset__list__varian.id_varian_1 end as  id_varian_1,
                        case 
                        when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
                        then master_var.id_varian_2 
                        else  inventaris__asset__list__varian.id_varian_2 end as  id_varian_2,
                        case 
                        when inventaris__asset__list__varian.asal_from_data_varian ='Master' 
                        then master_var.id_varian_3 
                        else  inventaris__asset__list__varian.id_varian_3 end as  id_varian_3,
                                
                        inventaris__asset__list__varian.id_master_varian,
                        master_var.asal_from_data_varian as asal_from_data_varian_master, 
                        master_var.id_asset_list_varian 
                    FROM
                        inventaris__asset__list__varian
                        LEFT JOIN inventaris__asset__list__varian AS master_var ON inventaris__asset__list__varian.id_master_varian = master_var.id 
                        
                ) AS var ON inventaris__asset__list.id = id_inventaris__asset__list 
                left join ($sql_rekap_akhir) as full_stok 
                        on  full_stok.id = 
                                case when inventaris__asset__list.varian_barang = '1' and var.asal_from_data_varian_master='Asset' then var.id_asset_list_varian 
                                else inventaris__asset__list.id end
                where 1=1
                <WHERE> 
                group by inventaris__asset__list.id
                ";
        if ($return == 'sql_rekap_akhir_total_asset') {
           $sql_total_asset = str_replace(" <WHERE>","",$sql_total_asset);
            return $sql_total_asset;
        } else
        if ($return == 'exe_rekap_akhir_total_asset') {
            if($id_barang)
            $where = "and inventaris__asset__list.id=$id_barang ";
            if(isset($lainnya['id_varian'])){
                $where .= " and var.id_varian =".$lainnya['id_varian'];
            }
            if(isset($lainnya['id_varian_1'])){
                $where .= " and var.id_varian_1 =".$lainnya['id_varian_1'];
            }
            $sql_total_asset = str_replace(" <WHERE>",$where,$sql_total_asset);
           
            DB::queryRaw($page, "SELECT sum(coalesce(total_stok,0)) as stok from (". $sql_total_asset.") as all_stok");
            return DB::get('all');
        } else
        if ($return == 'sum_rekap_akhir') {
            DB::queryRaw($page, "SELECT sum(coalesce(stok,0)) as stok from (". $sql_rekap_akhir.") as all_stok");
            return DB::get('all');
        } else
        if ($return == 'rekap_akhir') {
            //  echo $sql_rekap_akhir;
             
            DB::queryRaw($page,  $sql_rekap_akhir);
            return DB::get('all');
        } else
        if ($return == 'page') {
            return $page;
        }
    }
    public static function select_order($page, $type, $id)
    {

        $id_order = Partial::input('id_order');

        $db['utama'] = ('erp__pos__utama__detail');
        $db['where'][] = array('id', '=', $id_order);

        $get = Database::database_coverter($page, $db, null, 'all');
        $sub_total = 0;
        if ($get['num_rows']) {
            foreach ($get['row'] as $row) {
                $sub_total  += $row->harga;
            }
        }
        $return['sub_total'] = $sub_total;
        echo json_encode($return);
        die;
    }
}
