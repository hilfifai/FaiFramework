<?php
class Web
{
	public static function menu()
	{
		//nama/link/icon
		$menu = array(
			array("group", "Api Master"),
			array("menu", "Wa Number", array("Chat", "wa_number", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Wa Number"),
			array("menu", "Wa Number", array("Chat", "wa_number", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Wa Phonebook", array("Chat", "wa_phonebook", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Wa Phonebook", array("Chat", "wa_phonebook", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Chat"),
			array("menu", "Chat", array("Chat", "room", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Chat Package Bot", array("Chat", "package_bot", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Chat Bot", array("Chat", "Bot", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Chat Broadcast", array("Chat", "broadcast", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Template"),
			array("menu", "Kategori", array("Website", "website_template_kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Utama - Main All", array("Website", "website_template_main", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Template", array("Website", "website_template_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Template File Content", array("Website", "website_template_list_file", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Bundles Master"),
			array("menu", "Master Refer", array("Website", "website_bundles_refer", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master Link", array("Website", "website_bundles_link", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master If", array("Website", "website_bundles_if", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master Function", array("Website", "website_bundles_function", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master Dropdown", array("Website", "website_bundles_dropdown", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master Banner", array("Website", "website_bundles_banner", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Master Menu", array("Website", "website_bundles_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Tag", array("Website", "website_bundles_tag", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Database", array("Website", "website_database", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Bundles List"),
			array("menu", "Website Bundles", array("Website", "website_bundles_website_master", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Card Bundles", array("Website", "website_bundles_card", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Colect Bundles", array("Website", "website_bundles_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Web Appss"),
			array("menu", "Apps", array("Web", "web_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pages", array("Web", "pages", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Apps Menu Bar", array("Web", "web_apps_menu_bar", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Apps Database", array("Web", "web_apps_database", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Website"),
			array("menu", "List Website", array("Website", "website_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Utama"),
			array("menu", "Utama", array("User", "utama", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Template", array("Web", "web_template", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Menu", array("Web", "web_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			//array("menu", "Role List Apps", array("Web", "web_role_list_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Hak Akses", array("Web", "web_hak_akses", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			//27
			array("group", "Apps"),
			array("menu", "historis22", array("Apps", "historis", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "privilege", array("Apps", "privilege", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "transaksi", array("Apps", "transaksi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "Panel"),
			array("menu", "Panel", array("Web", "panel", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Panel List", array("Web", "panel_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Panel profile_connection", array("Web", "profile_connection", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "Form"),
			array("menu", "Form", array("BForm", "form", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Form Response", array("BForm", "form__response", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "List Apps"),
			array("menu", "List Apps Group", array("Web", "web_list_apps_group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps", array("Web", "web_list_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "List Apps Use"),
			array("menu", "List Apps Menu", array("Web", "web_list_apps_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Role", array("Web", "web_list_apps_role", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps User", array("Web", "web_list_apps_user", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Board", array("Web", "web_list_apps_board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket Tipe ", array("Web", "web_list_apps_tipe_paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket Element", array("Web", "web_list_apps_paket_elemen", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket Group", array("Web", "web_list_apps_paket_group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket List", array("Web", "web_list_apps_paket_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket Role Group", array("Web", "web_list_apps_paket_role__group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List Apps Paket Role Akses", array("Web", "web_list_apps_paket_role__akses", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "Workspace"),
			array("menu", "Dashboard", array("Workspace", "dashboard", "edit", "ID_BOARD|", -1, -1,), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Workspace", array("Workspace", "informasi", "edit", "ID_BOARD|", -1, -1,), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "List User ", array("Workspace", "user_list", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Entitas", array("Workspace", "entitas", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Group Role", array("Workspace", "group_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Akses Role", array("Workspace", "akses_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "User Role", array("Workspace", "user_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pengajuan Penambahan Menu", array("Workspace", "web_list_apps_board", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Tab Group"),
			array("menu", "Tab Group", array("Web", "tab", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Kegiatan"),
			array("menu", "Kegiatan List", array("Kegiatan", "list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Kegiatan Board", array("Kegiatan", "board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Kegiatan Task", array("Kegiatan", "board_task", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Kegiatan Report", array("Kegiatan", "report", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),




			array("group", "POS"),
			array("menu", "Board", array("POS", "Board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "Webmaster"),
			array("menu", "Paymen_methode", array("Webmaster", "payment_method", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "ekspedisi", array("Webmaster", "ekspedisi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "form__tipe", array("Webmaster", "form__tipe", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "erp_pos__page", array("Webmaster", "erp_pos__page", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "ERP POS"),
			array("menu", "PAJAK", array("Webmaster", "pajak", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "data_grup", array("Web", "data_grup", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("group", "HCMS-MASTER"),
			array("menu", "Kategori", array("Webmaster", "webmaster__organsiasi__kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Bidang", array("Webmaster", "webmaster__organsiasi__bidang", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Role", array("Webmaster", "webmaster__organsiasi__role", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Kerjasama", array("Webmaster", "webmaster__organisasi__tipe_kerjasama", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("group", "HCMS-STRUKTUR"),
			array("menu", "Organsiasi", array("Organisasi", "list_organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Organsiasi", array("Organisasi", "list_organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "organisasi_form", array("Organisasi", "organisasi_form", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			array("menu", "Periode", array("HCMS", "periode", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Semester", array("HCMS", "semester", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Level", array("HCMS", "level", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Divisi", array("HCMS", "divisi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pangkat", array("HCMS", "pangkat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Jabatan", array("HCMS", "jabatan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Anggota", array("HCMS", "Anggota", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// array("menu", "periode", array("Organisasi", "periode", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "semester", array("Organisasi", "semester", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "level", array("Organisasi", "level", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "divisi", array("Organisasi", "divisi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "pangkat", array("Organisasi", "pangkat", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "jabatan", array("Organisasi", "jabatan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "anggota", array("Organisasi", "anggota", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "follower", array("Organisasi", "follower", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "following", array("Organisasi", "following", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "parthner", array("Organisasi", "parthner", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "entitas", array("Organisasi", "entitas", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "entitas", array("Apotek", "penjualan__tagihan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			array(
				"group",
				"Store Produk & Harga"
			),
			//  array(
			array("menu", "Bundle Harga", array("Store", "bundle_harga", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Toko", array("Store", "Toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Produk", array("Store", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Produk User", array("Store", "produk__user", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Paket", array("Store", "paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Ulasan", array("Store", "ulasan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Promo Toko", array("Store", "promo__toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Promo Costumer", array("Store", "promo__costumer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Promo Ongkir", array("Store", "promo__ongkir", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Voucher", array("Store", "promo__vourcer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Iklan", array("Store", "iklan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			array("menu", "Pesanan", array("Workspace", "bisnis_pesanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Barang Keluar", array("Workspace", "bisnis_barang_keluar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pembayaran", array("Workspace", "bisnis_pembayaran", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pengiriman", array("Workspace", "bisnis_pengiriman", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Produk", array("Workspace", "bisnis_produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// ),


			array("menu", "Tipe Mitra Store", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			//array("menu", "Data Mitra", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// 			array("group", "Alamat"),
			// 				array("menu", "Simpan Alamat", array("Store", "simpan_alamat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// 			array("group", "Pre Order"),
			// 			array("menu", "Pre Order Sesion", array("Store", "preorder", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// 			array("group", "Gudang Toko"),
			//             array("menu", "Gudang", array("Store", "gudang_toko", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),



			array("group", "Penjualan Ecomerce Hibe3.com"),

			array("menu", "Cart/Quotation", array("POS", "online__cart", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Pemesanan", array("POS", "online__pemesanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Invoice", array("POS", "online__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Payment", array("POS", "online__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Outgoing", array("POS", "online__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Delivery Order", array("POS", "online__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			array("menu", "Retur Jual", array("POS", "online__retur_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			array("group", "Pembelian Supplier"),

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




			array("group", "Apps"),
			array("menu", "Historis", array("Apps", "historis", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
		);

		return $menu;
	}
	public static function menu2()
	{
		//nama/link/icon
		$menu = array(
			array("group", "Api Master"),
			
			array(
				"group",
				"Wa Number",
				[

					array("menu", "Wa Number", array("Chat", "wa_number", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Wa Phonebook", array("Chat", "wa_phonebook", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Wa Phonebook", array("Chat", "wa_phonebook", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Chat",
				[
					array("menu", "Chat", array("Chat", "room", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Chat Package Bot", array("Chat", "package_bot", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Chat Bot", array("Chat", "Bot", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Chat Broadcast", array("Chat", "broadcast", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Template",
				[
					array("menu", "Kategori", array("Website", "website_template_kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Utama - Main All", array("Website", "website_template_main", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Template", array("Website", "website_template_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Template File Content", array("Website", "website_template_list_file", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Bundles Master",
				[
					array("menu", "Master Refer", array("Website", "website_bundles_refer", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master Link", array("Website", "website_bundles_link", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master If", array("Website", "website_bundles_if", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master Function", array("Website", "website_bundles_function", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master Dropdown", array("Website", "website_bundles_dropdown", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master Banner", array("Website", "website_bundles_banner", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Master Menu", array("Website", "website_bundles_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Tag", array("Website", "website_bundles_tag", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Database", array("Website", "website_database", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),

			array(
				"group",
				"Bundles List",
				[
					array("menu", "Website Bundles", array("Website", "website_bundles_website_master", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Card Bundles", array("Website", "website_bundles_card", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Colect Bundles", array("Website", "website_bundles_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Web Appss",
				[
					array("menu", "Apps", array("Web", "web_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Pages", array("Web", "pages", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					// array("menu", "Apps Menu Bar", array("Web", "web_apps_menu_bar", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					// array("menu", "Apps Database", array("Web", "web_apps_database", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Website",
				[
					array("menu", "List Website", array("Website", "website_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Utama",
				[
					array("menu", "Utama", array("User", "utama", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Template", array("Web", "web_template", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Menu", array("Web", "web_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					//array("menu", "Role List Apps", array("Web", "web_role_list_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Hak Akses", array("Web", "web_hak_akses", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


					//27
				]
			),
			array(
				"group",
				"Apps",
				[
					array("menu", "historis", array("Apps", "historis", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "privilege", array("Apps", "privilege", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "transaksi", array("Apps", "transaksi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array(
				"group",
				"Panel",
				[
					array("menu", "Panel", array("Web", "panel", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Panel List", array("Web", "panel_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Panel profile_connection", array("Web", "profile_connection", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array(
				"group",
				"Form",
				[
					array("menu", "Form", array("BForm", "form", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Form Response", array("BForm", "form__response", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"List Apps",
				[
					array("menu", "List Apps Group", array("Web", "web_list_apps_group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps", array("Web", "web_list_apps", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array(
				"group",
				"List Apps Use",
				[
					array("menu", "List Apps Menu", array("Web", "web_list_apps_menu", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Role", array("Web", "web_list_apps_role", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps User", array("Web", "web_list_apps_user", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Board", array("Web", "web_list_apps_board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket Tipe ", array("Web", "web_list_apps_tipe_paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket Element", array("Web", "web_list_apps_paket_elemen", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket Group", array("Web", "web_list_apps_paket_group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket List", array("Web", "web_list_apps_paket_list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket Role Group", array("Web", "web_list_apps_paket_role__group", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List Apps Paket Role Akses", array("Web", "web_list_apps_paket_role__akses", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array(
				"group",
				"Workspace",
				[
					array("menu", "Dashboard", array("Workspace", "dashboard", "edit", "ID_BOARD|", -1, -1,), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Workspace", array("Workspace", "informasi", "edit", "ID_BOARD|", -1, -1,), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "List User ", array("Workspace", "user_list", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Entitas", array("Workspace", "entitas", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Group Role", array("Workspace", "group_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Akses Role", array("Workspace", "akses_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "User Role", array("Workspace", "user_role", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Pengajuan Penambahan Menu", array("Workspace", "web_list_apps_board", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Tab Group",
				[
					array("menu", "Tab Group", array("Web", "tab", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Kegiatan",
				[
					array("menu", "Kegiatan List", array("Kegiatan", "list", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Kegiatan Board", array("Kegiatan", "board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Kegiatan Task", array("Kegiatan", "board_task", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Kegiatan Report", array("Kegiatan", "report", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),




				]
			),
			array(
				"group",
				"POS",
				[
					array("menu", "Board", array("POS", "Board", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"Webmaster",
				[
					array("menu", "Paymen_methode", array("Webmaster", "payment_method", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "ekspedisi", array("Webmaster", "ekspedisi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "form__tipe", array("Webmaster", "form__tipe", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "erp_pos__page", array("Webmaster", "erp_pos__page", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array(
				"group",
				"ERP POS",
				[
					array("menu", "PAJAK", array("Webmaster", "pajak", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			array(
				"group",
				"HCMS-MASTER",
				[
					array("menu", "Kategori", array("Webmaster", "webmaster__organsiasi__kategori", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Bidang", array("Webmaster", "webmaster__organsiasi__bidang", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Role", array("Webmaster", "webmaster__organsiasi__role", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Kerjasama", array("Webmaster", "webmaster__organisasi__tipe_kerjasama", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				]
			),
			array("group", "HCMS-STRUKTUR", [
				array("menu", "Organsiasi", array("Organisasi", "list_organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Organsiasi", array("Organisasi", "list_organisasi", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "organisasi_form", array("Organisasi", "organisasi_form", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

				array("menu", "Periode", array("HCMS", "periode", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Semester", array("HCMS", "semester", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Level", array("HCMS", "level", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Divisi", array("HCMS", "divisi", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Pangkat", array("HCMS", "pangkat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Jabatan", array("HCMS", "jabatan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				array("menu", "Anggota", array("HCMS", "Anggota", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


				// array("menu", "follower", array("Organisasi", "follower", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				// array("menu", "following", array("Organisasi", "following", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				// array("menu", "parthner", array("Organisasi", "parthner", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				// array("menu", "entitas", array("Organisasi", "entitas", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				// array("menu", "entitas", array("Apotek", "penjualan__tagihan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			]),

			array(
				"group",
				"Store Produk & Harga",
				[
					array("menu", "Bundle Harga", array("Store", "bundle_harga", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Toko", array("Store", "Toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Produk", array("Store", "produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Produk User", array("Store", "produk__user", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Paket", array("Store", "paket", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Ulasan", array("Store", "ulasan", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Promo Toko", array("Store", "promo__toko", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Promo Costumer", array("Store", "promo__costumer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Promo Ongkir", array("Store", "promo__ongkir", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Voucher", array("Store", "promo__vourcer", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Iklan", array("Store", "iklan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


					array("menu", "Pesanan", array("Workspace", "bisnis_pesanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Barang Keluar", array("Workspace", "bisnis_barang_keluar", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Pembayaran", array("Workspace", "bisnis_pembayaran", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Pengiriman", array("Workspace", "bisnis_pengiriman", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
					array("menu", "Produk", array("Workspace", "bisnis_produk", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
				]
			),
			// // ),


			// array("menu", "Tipe Mitra Store", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //array("menu", "Data Mitra", array("Store", "mitra", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // 			array("group", "Alamat"),
			// // 				array("menu", "Simpan Alamat", array("Store", "simpan_alamat", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// // 			array("group", "Pre Order"),
			// // 			array("menu", "Pre Order Sesion", array("Store", "preorder", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// // 			array("group", "Gudang Toko"),
			// //             array("menu", "Gudang", array("Store", "gudang_toko", "list", "-1"), '<i class="menu-icon tf-icons bx bx-collection"></i>'),



			// array("group", "Penjualan Ecomerce Hibe3.com"),

			// array("menu", "Cart/Quotation", array("POS", "online__cart", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Pemesanan", array("POS", "online__pemesanan", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Invoice", array("POS", "online__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Payment", array("POS", "online__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Outgoing", array("POS", "online__outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Delivery Order", array("POS", "online__delivery_order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Retur Jual", array("POS", "online__retur_jual", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			// array("group", "Pembelian Supplier"),

			// // Permintaan Pembelian ->Persetujuan Permintaan Pembelian:
			// array("menu", "Purchase Requisition", array("ERP", "bahan_baku__supplier__purchase__request", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Purchase Order", array("ERP", "bahan_baku__supplier__purchase__order", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// //Pembayaran -> PO menjadi Invoice Pembayaran

			// // penawaran harga dengan supplier
			// array("menu", "Approval Purchase Quotation", array("ERP", "bahan_baku__supplier__purchase__quotation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // array("menu", "Approve Purchase Quotation", array("ERP", "bahan_baku__supplier__purchase__quotation", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),


			// array("menu", "Invoice", array("ERP", "bahan_baku__supplier__invoice", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //Invoice dikumpulkan di kontrabon
			// array("menu", "Kontrabon", array("ERP", "bahan_baku__supplier__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // array("menu", "Approve Kontrabon", array("ERP", "bahan_baku__supplier__kontrabon", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //menjadi faktur jual
			// array("menu", "Payment", array("ERP", "bahan_baku__supplier__payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // array("menu", "Invoice", array("ERP", "bahan_baku__supplier__kontrabon", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //DO-> untuk pengiriman
			// //array("menu", "Delivery Order", array("POS", "payment", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),

			// //Barang Masuk
			// array("menu", "Receive", array("ERP", "bahan_baku__supplier__receive", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // array("menu", "Approval Receive", array("ERP", "bahan_baku__supplier__receive", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //barang masuk tapi di kembalikan
			// array("menu", "Retur Receive", array("ERP", "bahan_baku__supplier__retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// array("menu", "Refund Retur", array("ERP", "bahan_baku__supplier__refund_retur", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //Permintaan barang -> nyambung 
			// // array("menu", "Request", array("ERP", "bahan_baku__supplier__request_outgoing", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// // array("menu", "Approve Request", array("ERP", "bahan_baku__supplier__request_outgoing", "appr", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
			// //Barang Keluar




			// array("group", "Apps"),
			// array("menu", "Historis", array("Apps", "historis", "list", "-1", -1, -1, 'ID_BOARD|'), '<i class="menu-icon tf-icons bx bx-collection"></i>'),
		);

		return $menu;
	}
	public static function menu_basic()
	{
		$menu = array();
		return $menu;
	}
	public static function data_grup($page)
    {
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
        $page['route'] = __FUNCTION__;
        $page['crud']['layout_pdf'] = array('a4', 'landscape');
        $page['get']['sidebarIn'] = true;;
        $page = ErpPosApp::router($page, 'All', 'data_grup', 'pos_full', 'pembeli');
        return $page;
    }
	public static function web_apps()
	{

		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__apps";
		$primary_key = null;

		$array = array(
			array("Kode", "kode_webapps", "text"),
			array("", "nama_domain", "text"),
			array("Domain Utama", "domain_utama", "text"),
			array("Route Page", "domain_sub_route", "text"),
			array("App Framework", "app_framework", "select-manual", array("laravel" => "Laravel", "ci" => "CodeIgniter")),
			array("Database Provider", "database_provider", "select-manual", array("postgres" => "Postgres", "mysql" => "MySql")),

			array("Connection Server", "conection_server", "text"),
			array("Conection Name Database", "conection_name_database", "text"),
			array("Conection User", "conection_user", "text"),
			array("Conection Password", "conection_password", "text"),
			array("Conection Scheme", "conection_scheme", "text"),

			array("Database ID text", null, "text"),
			array("Database ID Type", null, "select-manual", array("prefix" => "Prefix", "sufix" => "sufix")),
			array("Database ID on table", null, "select-manual", array(1 => "ya( ID_{nama_table})", "0" => "Tidak (ID)")),

			array("Logo", "logo", "file", "system/apps/"),
			array("Meta Title", "meta_title", "text"),
			array("Meta Keyword", "meta_keyword", "text"),
			array("Meta Description", "meta_description", "text"),
			array("Link", "link", "select-manual", array("js" => "JS", "direct" => "Direct")),


			//array("First Menu","first_menu","select",array("web__menu",null,"nama_menu"),null),


			array("Alamat Lengkap", "alamat", "text"),
			array("No Telpon", "no_telepon", "text"),
			array("Nama Narahubung", "nama_narahubung", "text"),
			array("Email", "email", "text"),
			array("", "nomor_send_wa", "text"),
			array("", "link_gmaps", "text"),
			array("TIpe Website", "", "select-manual",["bundles"=>"bundles","controller"=>"controller","template_content"=>"template_content"]),
			array("TIpe Sidebar", "", "select-manual",["panel"=>"Panel","database_web_apps"=>"Sidebar web_apps","database_menu"=>"Sidebar menu board"]),

			array("First Menu", null, "select", array("web__list_apps_menu", null, "nama_menu")),
			array("Board", null, "select", array("web__list_apps_board", null, "nama_board")),
			array("Utama", null, "select", array("website__template__main", null, "versi")),
			array("Main Template", null, "select", array("website__template__list", null, "nama_template")),
			array("Header bundles", null, "select", array("website__bundles__list", null, "nama_bundle", "header")),
			array("Sidebar bundles", null, "select", array("website__bundles__list", null, "nama_bundle", "sidebar")),
			array("Footer bundles", null, "select", array("website__bundles__list", null, "nama_bundle", "footer")),
			array("Card ", null, "select", array("website__bundles__list", null, "nama_bundle", "card")),
			array("Crud ", null, "select", array("website__bundles__list", null, "nama_bundle", "crud")),

			array("Api key Raja Ongkir ", null, "text"),
			array("Api key Midtrans ", null, "text"),

			// array("Template Utama","template","select",array("web__template",null,"nama_template"),null),
			// array("Navbar Template","navbar_template","select",array("web__template",null,"nama_template",'navbar'),null),
			// array("Header Template","header_template","select",array("web__template",null,"nama_template",'header'),null),
			// array("Sidebar Template","sidebar_template","select",array("web__template",null,"nama_template",'sidebar'),null),
			// array("Sidebar In Template","sidebarin_template","select",array("web__template",null,"nama_template",'sidebarin'),null),
			// array("Card  Template","card_template","select",array("web__template",null,"nama_template",'card'),null),
			// array("Crud Template","crud_template","select",array("web__template",null,"nama_template",'crud'),null),
			// array("Footer Template","footer_template","select",array("web__template",null,"nama_template",'footer'),null),

		);
		$page['crud']['table_group']['Apps'][] = "kode_webapps";
		$page['crud']['table_group']['Apps'][] = "domain_utama";
		$page['crud']['table_group']['Apps'][] = "domain_sub_route";
		$page['crud']['table_group']['Apps'][] = "app_framework";
		$page['crud']['table_group']['Apps'][] = "database_provider";
		$page['crud']['table_group']['Connection'][] = "conection_server";
		$page['crud']['table_group']['Connection'][] = "conection_name_database";
		$page['crud']['table_group']['Connection'][] = "conection_user";
		$page['crud']['table_group']['Connection'][] = "conection_password";
		$page['crud']['table_group']['Connection'][] = "conection_scheme";

		$page['crud']['table_group']['Database'][] = "database_id_text";
		$page['crud']['table_group']['Database'][] = "database_id_type";
		$page['crud']['table_group']['Database'][] = "database_id_on_table";

		$page['crud']['table_group']['Meta Apps'][] = "meta_title";
		$page['crud']['table_group']['Meta Apps'][] = "meta_keyword";
		$page['crud']['table_group']['Meta Apps'][] = "meta_description";

		$page['crud']['table_group']['Data Apps'][] = "logo";
		$page['crud']['table_group']['Data Apps'][] = "alamat";
		$page['crud']['table_group']['Data Apps'][] = "no_telepon";
		$page['crud']['table_group']['Data Apps'][] = "nama_narahubung";
		$page['crud']['table_group']['Data Apps'][] = "email";

		$page['crud']['table_group']['Template'][] = "template";
		$page['crud']['table_group']['Template'][] = "sidebar_template";
		$page['crud']['table_group']['Template'][] = "footer_template";

		$page['crud']['select_database_costum']['id_apps_menu']['select'][] = "*,concat(web__list_apps_menu.ambil_dari,' - ',web__list_apps_menu.nama_menu,' - ',web__list_apps_menu.kode_link) as nama_menu";
		$page['crud']['select_database_costum']['id_apps_menu']['where'][] = array("tipe_menu", "=", "'menu'");
		$page['crud']['select_database_costum']['id_menu']['utama'][] = array("utama", "=", "1");

		$sub_kategori[] = ["First Menu", $database_utama . "_first_menu", null, "table"];
		$array_sub_kategori[] = array(
			array("Hak Akses", "hak_akses", "select", array("web__hak_akses", null, "nama_hak_akses"), null),
			array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),
			array("Apps Menu", "apps_menu", "select", array("web__list_apps_menu", null, "nama_menu"), null),


		);


		// $sub_kategori[] = ["Navbar",  $database_utama . "__menubar", null, "table"];
		// $array_sub_kategori[] = array(
		//     array("Tag","tag","text"),
		//     array("Tipe Menu","tipe_menu","select-manual",array("navbar"=>"Navbar","header"=>"Header","sidebar"=>"Sidebar","sidebarin"=>"SidebarIn")),
		//     array("Nama Header","nama_header","text"),
		//     array("Kategori","kategori_header","select-manual",array("1"=>"Utama","2"=>"Right","3"=>"Sidebar Left","4"=>"Sidebar Right","5"=>"Bottom","6"=>"Sub Utama")),
		//     array("Type","type_header","select-manual",array("1"=>"Normal","2"=>"Dropdown")),
		//     array("Content Addon(Dropdown)","content_dropdown","select-manual",array("toggle_sidebar"=>"Toggle Sidebar","chat"=>"Chat(last)","search"=>"Search","notif"=>"notifikasi","cart"=>"Cart","QA"=>"Quict Action","lang"=>"Languange")),
		//     array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),
		//     //array("Parent","parent","select",array($database_utama . "__navbar",null,'nama_header','get_parent')),
		//     array("Urutan","urutan","text"),

		// 	array("Source","source","select-manual",array("controller"=>"Controller","database"=>"List Database","get_database"=>"Get Database","file"=>"File")),
		// 	array("Folder Tag",null,'text'),
		// 	array("File Tag",null,'text'),
		// 	array("tag","dropdown","modalform-subkategori-add",array(
		// 		"type"=>"many",
		// 		"database"=>$database_utama . "__menubar_tag",
		// 		"array"=>array(
		// 					array("Tag","tag","text"),
		// 					array("Source","source","select-manual",array("controller"=>"Controller","database"=>"List Database","get_database"=>"Get Database","file"=>"File")),
		// 					array("Nama Header","nama_header","text"),
		// 					array("Type","type_header","select-manual",array("profil"=>"profil","garis"=>"Garis Pemisah","logo"=>"Logo")),

		// 					array("Menu", "menu", "select", array("web__menu", "id", "nama_menu"), null),

		// 					array("Urutan","urutan","text"),
		// 				)
		// 		)
		// 	),
		// 	array("Database","list_database","modalform-subkategori-add",array(
		//     		"type"=>"one",
		//     		"database"=>$database_utama . "__menubar_list_database",
		//     		"array"=>array(
		// 						array("Name Database","name_database","text"),
		// 						array("Database Utama","utama","text"),
		// 						array("Database Primary","primary_key","text"),

		// 				),
		// 			"sub_kategori"=>[
		// 					["select",  $database_utama . "__menubar_list_database__select", null, "table"],
		// 					["where",  $database_utama . "__menubar_list_database__where", null, "table"],
		// 					["join",  $database_utama . "__menubar_list_database__join", null, "table"]
		// 				],
		// 			"array_sub_kategori"=>[
		// 				array(
		// 					array("row","row_database","text"),
		// 				),
		// 				array(
		// 					array("row","row_database","text"),
		// 					array("operan","operan","text"),
		// 					array("Value","value","text"),
		// 				),
		// 				array(
		// 					array("database","database","text"),
		// 					array("join database in","join_databasse_in","text"),
		// 					array("join database out","join_databasse_out","text"),
		// 				),
		// 			]
		// 		)
		//     ),
		// 	array("Drop down","dropdown","modalform-subkategori-add",array(
		//     		"type"=>"many",
		//     		"database"=>$database_utama . "__menubar_dropdown",
		//     		"array"=>array(
		// 						array("Nama Header","nama_header","text"),
		// 						array("Type","type_header","select-manual",array("profil"=>"profil","garis"=>"Garis Pemisah")),

		// 						array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),

		// 						array("Urutan","urutan","text"),
		//     				)
		//     		)
		//     ),

		// );

		//    $sub_kategori[] = ["Header", $database_utama ."_header", null, "table"];
		//    $array_sub_kategori[] = array(
		//         array("Hak Akses", "hak_akses", "select", array("web__hak_akses", null, "nama_hak_akses"), null),
		//         array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),


		//   );
		   $sub_kategori[] = ["Sidebar", $database_utama ."_sidebar", null, "table"];
		   $array_sub_kategori[] = array(
		        // array("Hak Akses", "hak_akses", "select", array("web__hak_akses", null, "nama_hak_akses"), null),
		        array("Group Sidebar", "", "text"),
		        array("Menu", "menu", "select", array("web__list_apps_menu", null, "nama_menu"), null),
		        array("Urutan", "", "number"),


		  );
		//    $sub_kategori[] = ["Sidebar IN", $database_utama ."_sidebar_in", null, "table"];
		//    $array_sub_kategori[] = array(
		//         array("Hak Akses", "hak_akses", "select", array("web__hak_akses", null, "nama_hak_akses"), null),
		//         array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),


		//   );
		//$sub_kategori[] = ["Footer", $database_utama ."_footer", null, "table"];
		//     $array_sub_kategori[] = array(
		//         array("Hak Akses", "hak_akses", "select", array("web__hak_akses", null, "nama_hak_akses"), null),
		//         array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),
		//         array("Urutan", "urutan_footer", "number"),


		//     );
		$search = array();

		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;
		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function pages()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_menu";
		$primary_key = null;

		$array = array(
			array("Kode Link", null, "text"),
			array("", "web_apps", "select", array("web__apps", null, "domain_utama")),
			array("", "web_list_apps", "select", array("web__list_apps", null, "nama_apps")),
			array("Bundle", null, "select", array("website__bundles__list", null, "nama_bundle")),
			array("login", "login", "select-manual", array("1" => "Harus Login", 0 => "Tidak Harus")),
			array("User Akses", "privilages_akses", "select-manual", array("1" => "Harus Login", 0 => "Tidak Harus")),

		);
		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['insert_default_value']['ambil_dari'] = "bundles";
		//   $page['crud']['sub_kategori'] = $sub_kategori ;
		//   $page['crud']['array_sub_kategori'] = $array_sub_kategori ;
		$page['crud']['search'] = $search;
		$page['crud']['insert_value']['page'] = "Frontend";
		$page['crud']['insert_value']['page'] = "Frontend";

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'][] = array("ambil_dari", "=", "'bundles'");
		return $page;
	}
	public static function web_apps_menu_bar()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__apps__menubar";
		$primary_key = null;

		$array = array(
			array("Tag", "tag", "text"),
			array("Tipe Menu", "tipe_menu", "select-manual", array("navbar" => "Navbar", "header" => "Header", "sidebar" => "Sidebar", "sidebarin" => "SidebarIn")),
			array("Nama Header", "nama_header", "text"),
			array("Parent", "parent", "select", array($database_utama, null, 'nama_header', 'get_parent')),
			//array("Kategori","kategori_header","select-manual",array("1"=>"Utama","2"=>"Right","3"=>"Sidebar Left","4"=>"Sidebar Right","5"=>"Bottom","6"=>"Sub Utama")),
			//array("Type","type_header","select-manual",array("1"=>"Normal","2"=>"Dropdown")),
			array("Source", "source", "select-manual", array("controller" => "Controller", "database" => "List Database", "get_database" => "Get Database", "file" => "File")),
			array("Content Addon(Dropdown)", "content_dropdown", "select-manual", array("toggle_sidebar" => "Toggle Sidebar", "chat" => "Chat(last)", "search" => "Search", "notif" => "notifikasi", "cart" => "Cart", "QA" => "Quict Action", "lang" => "Languange")),
			array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),

			array("Urutan", "urutan", "text"),

			array("Folder Tag", null, 'text'),
			array("File Tag", null, 'text'),
			array("Class Controller", null, 'text'),
			array("Function Controller", null, 'text'),
			array("Row Database", null, 'text'),
			array("Database Refer", null, 'text'),
		);


		$search = array();
		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_apps_database()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__apps__menubar_list_database";
		$primary_key = null;

		$array = array(
			array("Web Apps", "id_web__apps__menubar", "select", array("web__apps__menubar", null, 'nama_header')),
			array("Name Database", "name_database", "text"),
			array("Database Utama", "utama", "text"),
			array("Database Primary", "primary_key", "text"),
		);

		$sub_kategori[] = ["select",  $database_utama . "__select", null, "table"];
		$array_sub_kategori[] = array(
			array("row", "row_database", "text"),
		);
		$sub_kategori[] = ["group",  $database_utama . "__group", null, "table"];
		$array_sub_kategori[] = array(
			array("row", "row_database", "text"),
		);
		$sub_kategori[] = ["where",  $database_utama . "__where", null, "table"];
		$array_sub_kategori[] = array(
			array("row", "row_database", "text"),
			array("operan", "operan", "text"),
			array("Value", "value", "text"),
		);
		$sub_kategori[] = ["join",  $database_utama . "__join", null, "table"];
		$array_sub_kategori[] = array(
			array("database", "database", "text"),
			array("join database in", "join_databasse_in", "text"),
			array("join database out", "join_databasse_out", "text"),
		);



		$search = array();
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}

	public static function web_template()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__template";
		$primary_key = null;

		$array = array(
			array("Nama Template", null, "text"),
			array("Folder Template", null, "text"),
			array("Main Template", null, "textarea"),
			// array("Navbar File",null,"text"),
			// array("Header File",null,"text"),
			// array("Sidebar File",null,"text"),
			// array("SidebarIN File",null,"text"),
			// array("Crud List File",null,"text"),
			// array("Crud VTE File",null,"text"),


			// array("Card Menu File",null,"text"),
			// array("Card Filter File",null,"text"),
			// array("Card Listing Menu File",null,"text"),
			// array("Card Main Listing Menu File",null,"text"),
			// array("Card Menu File",null,"text"),
			// array("Card Menu Screen A File",null,"text"),
			// array("Card Menu Screen B File",null,"text"),
			// array("Card Ul Nav File",null,"text"),
			// array("Card UL LI Nav File",null,"text"),

		);
		$page['crud']['insert_value']['navbar_file'] = "NavbarPage";
		$page['crud']['insert_value']['header_file'] = "HeaderPage";
		$page['crud']['insert_value']['sidebar_file'] = "SidebarPage";
		$page['crud']['insert_value']['sidebarin_file'] = "SidebarinPage";
		$page['crud']['insert_value']['crud_list_file'] = "crud_list.template";
		$page['crud']['insert_value']['crud_vte_file'] = "crud_vte.template";

		$page['crud']['insert_value']['card_menu_file'] = "_CardMenu.template";
		$page['crud']['insert_value']['card_filter_file'] = "_CardFilter.template";
		$page['crud']['insert_value']['card_listing_menu_file'] = "_CardListingMenu.template";
		$page['crud']['insert_value']['card_main_listing_menu_file'] = "_CardMainListingMenu.template";
		$page['crud']['insert_value']['card_menu_file'] = "_CardMenu.template";
		$page['crud']['insert_value']['card_menu_screen_a_file'] = "_CardMenuScreenA.template";
		$page['crud']['insert_value']['card_menu_screen_b_file'] = "_CardMenuScreenB.template";
		$page['crud']['insert_value']['card_ul_nav_file'] = "_CardUlNav.template";
		$page['crud']['insert_value']['card_ul_li_nav_file'] = "_CardUlLiNav.template";
		//block_ruang

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}

	public static function tab()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "tab_group";
		$primary_key = null;

		$array = array(
			array("user", "apps_user", "select", array("apps_user", null, "nama_lengkap"), null),
			array("Menu", "menu", "select", array("web__menu", null, "nama_menu"), null),
			array("Panel", "panel", "select", array("panel", null, "nama_panel"), null),
			array("Nama Tab", "nama_tab", "text"),
			array("Nama Menu Tab", "nama_menu_tab", "text"),
			array("urutan", "urutan", "number"),


		);
		//block_ruang

		$search = array();


		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_menu()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__menu";
		$primary_key = null;

		$array = array(
			array("menu_Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),

			array("kode Menu", null, "text"),
			array("Nama Menu", null, "text"),

			//array("Kategori","kategori_header","select-manual",array("1"=>"Utama","2"=>"Right","3"=>"Sidebar Left","4"=>"Sidebar Right","5"=>"Bottom","6"=>"Sub Utama")),
			//array("Type","type_header","select-manual",array("1"=>"Normal","2"=>"Dropdown")),
			array("Content Addon(Dropdown)", "content_dropdown", "select-manual", array("chat" => "Chat(last)", "search" => "Search", "notif" => "notifikasi", "cart" => "Cart", "QA" => "Quict Action", "lang" => "Languange")),
			array("Tipe Menu", null, "select-manual", array("group" => "group", "Dropdown" => "Dropdown", "menu" => "Menu")),
			array("Nama Menu", null, "text"),
			array("Load Apps", null, "text"),
			array("Load Page View", null, "text"),
			array("Load Type", null, "text"),
			array("Load page_id", null, "text"),
			array("menu", null, "text"),
			array("nav", null, "text"),
			array("board", null, "number"),
			array("Icon", null, "text"),
			array("Contentfaiframework", null, "text"),
			array("Utama", null, "select-manual", array(2 => "tidak", 1 => "ya")),
			array("login", null, "select-manual", array(0 => "false", 1 => "true")),

		);
		//block_ruang

		$search = array();

		$page['crud']['insert_default_value']['kode_menu'] = 'RANDOM::25|';
		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function apps__privilage()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "apps__privilage";
		$primary_key = null;

		$array = array(
			array("menu_Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),

			array("kode Menu", null, "text"),
			array("Nama Menu", null, "text"),

			//array("Kategori","kategori_header","select-manual",array("1"=>"Utama","2"=>"Right","3"=>"Sidebar Left","4"=>"Sidebar Right","5"=>"Bottom","6"=>"Sub Utama")),
			//array("Type","type_header","select-manual",array("1"=>"Normal","2"=>"Dropdown")),
			array("Content Addon(Dropdown)", "content_dropdown", "select-manual", array("chat" => "Chat(last)", "search" => "Search", "notif" => "notifikasi", "cart" => "Cart", "QA" => "Quict Action", "lang" => "Languange")),
			array("Tipe Menu", null, "select-manual", array("group" => "group", "Dropdown" => "Dropdown", "menu" => "Menu")),
			array("Nama Menu", null, "text"),
			array("Load Apps", null, "text"),
			array("Load Page View", null, "text"),
			array("Load Type", null, "text"),
			array("Load page_id", null, "text"),
			array("menu", null, "text"),
			array("nav", null, "text"),
			array("board", null, "number"),
			array("Icon", null, "text"),
			array("Contentfaiframework", null, "text"),
			array("Utama", null, "select-manual", array(2 => "tidak", 1 => "ya")),
			array("login", null, "select-manual", array(0 => "false", 1 => "true")),

		);
		//block_ruang

		$search = array();

		$page['crud']['insert_default_value']['kode_menu'] = 'RANDOM::25|';
		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps";
		$primary_key = null;

		$array = array(
			array("Group", null, "select", array("web__list_apps_group", null, "nama_group"), null),
			array("Nama Apps", null, "text"),

			array("Icon", null, "text"),
			array("First Menu", null, "select", array("web__menu", null, "nama_menu"), null),

			array("Icon", null, "text"),
			array("Tampilkan", null, "select-manual", array(1 => "Tidak", 2 => "Tampilkan")),
			array("Urutan", null, "number"),
			array("Urutan workspace", null, "number"),
		);
		//block_ruang

		$search = array();

		$sub_kategori[] = ["define", "" . $database_utama . "_define", null, "table"];
		$array_sub_kategori[] = array(

			array("Load Apps", null, "text"),
			array("Load Page View", null, "text"),
			array("Load Type", null, "text"),
			array("Load Menu", null, "text"),
			array("Load Nav", null, "text"),

		);

		$page['crud']['costum_class']['id_first_menu'] = 'select2';
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['database']['order'][] = array("id_group", "asc");
		$page['database']['order'][] = array("$database_utama.urutan", "asc");
		return $page;
	}
	public static function web_list_apps_group()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_group";
		$primary_key = null;

		$array = array(
			array("Nama Group", null, "text"),
			array("Tampilkan", null, "select-manual", array(1 => "Tidak", 2 => "Tampilkan")),
			array("Urutan", null, "text"),

		);
		//block_ruang

		$search = array();


		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		$page['database']['order'][] = array("urutan", "asc");
		return $page;
	}
	public static function web_list_apps_menu()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_menu";
		$primary_key = null;

		$array = array(
			array("ID", null, "number"),
			array("Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),
			array("Tipe Menu", null, "select-manual", array("group" => "group", "Dropdown" => "Dropdown", "menu" => "Menu")),
			array("Nama Menu", null, "text"),
			array("Load Apps", null, "text"),
			array("Load Page View", null, "text"),
			array("Load Type", null, "text"),
			array("Load page_id", null, "text"),
			array("menu", null, "text"),
			array("nav", null, "text"),
			array("board", null, "number"),
			array("icon", null, "text"),
			array("parent", null,  "select", array("web__list_apps_menu", null, "nama_menu", "menu"), null),
			array("urutan", null, "number"),
			array("page", null, "text"),
			array("", "diambil_dari", "select-manual", array("controller" => "Controller", "bundles" => "Bundles")),
			array("", "kode_link", "text"),


		);
		//block_ruang
		$page['crud']['crud_inline']['id_apps'] = 'select2';
		$search = array();


		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*,web__list_apps_menu.nama_menu");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		// $page['database']['order'][] = array("urutan","asc");  
		return $page;
	}
	public static function web_list_apps_package_menu()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_package_menu";
		$primary_key = null;

		$array = array(
			array("Nama Package", null, "text"),

		);
		$sub_kategori[] = ["User", $database_utama . "__panel", null, "table"];
		$array_sub_kategori[] = array(
			array("menu", null, "select", array("web__list_apps_menu", null, "nama_menu"), null),
		);


		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;
		//block_ruang
		$search = array();


		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		// $page['database']['order'][] = array("urutan","asc");  
		return $page;
	}
	public static function web_list_apps_role()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_role";
		$primary_key = null;

		$array = array(
			array("Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),

			array("Nama Role", null, "text"),
			array("Level Role", null, "number"),
			array("Default Pembuat", null, "select-manual", array("1" => "Ya", "2" => "Tidak")),
			array("Privacy", null, "select-manual", array("public" => "Public", "private" => "Private")),
			array("Support_id_privavte", null, "number"),
			array("Support_database_privavte", null, "text"),


		);
		//block_ruang
		$page['crud']['crud_inline']['id_apps'] = 'select2';
		$search = array();


		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		// $page['database']['order'][] = array("urutan","asc");  
		return $page;
	}
	public static function web_list_apps_board()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_board";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("Panel", "panel", "select", array("panel", null, "nama_panel"), null),
			array("Be3 ID", null, "text"),
			array("Nama Board", null, "text"),
			array("Deskripsi", null, "text"),
			array("Foto Utama", null, "file", 'board/brosur'),
			array("Barcode", null, "text"),
			array("Tanggal Awal", null, "date"),
			array("Tanggal Akhir", null, "date"),
			array("Pembayaran Terakhir", null, "date"),
			array("Pembayaran Total", null, "numeric"),
			array("Pembayaran Selanjutnya", null, "date"),
			array("Tagihan Term Frekuensi", null, "date"),
			array("Tagihan Term Per", null,  "select-manual", array("Hari" => "Hari", "Tanggal" => "Tanggal", "Bulan" => "Bulan", "Tahun" => "Tahun", "Lifetime" => "LifeTime")),
			array("Status Tagihan", null,  "select-manual", array("Lunas Berjalan" => "Lunas Berjalan", "Proses Tagihan" => "Proses Tagihan", "Trial" => "Trial")),
			array("Step", null,  "select-manual", array("Lunas Berjalan" => "Lunas Berjalan", "Proses Tagihan" => "Proses Tagihan")),
			array("Paket", null, "select", array("web__list_apps_paket__list", null, "nama_paket"), null),
			array("Trial Date Start", null, "date"),
			array("Trial Date End", null, "date"),
			array("Status Trial", null, "select-manual", array(2 => "Telah Digunakan", 3 => "Belum Digunakan", 1 => "Sedang Di Gunakan")),

			array("Single Toko", null, "select", array("store__toko", '', "nama_toko")),
			array("Panel Utama", null, "select", array("panel", '', "nama_panel", "panel_utama")),
		);
		$sub_kategori[] = ["Apps", $database_utama . "__apps", null, "table"];
		$array_sub_kategori[] = array(
			array("Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),
			array("Tipe Menu", null, "select-manual", array("Semua" => "All Menu", "basic" => "Basic")),
			array("Data Apps", null, "select-manual", array("Semua" => "Semua Data", "board" => "Khusus Board")),
		);
		$sub_kategori[] = ["Menu", $database_utama . "__menu", null, "table"];
		$array_sub_kategori[] = array(
			array("menu", null, "select", array("web__menu", null, "nama_menu"), null),
		);
		$sub_kategori[] = ["User", $database_utama . "__user", null, "table"];
		$array_sub_kategori[] = array(
			array("user", null, "select", array("apps_user", 'id_apps_user', "nama_lengkap"), null),
			array("Role", null, "select", array("web__list_apps_role", null, "nama_role"), null),
		);
		$sub_kategori[] = ["Entitas", $database_utama . "__entitas", null, "table"];
		$array_sub_kategori[] = array(
			array("Organisasi", null, "select", array("organisasi", null, "nama_organisasi"), null),
			array("Status Entitas", null, "select-manual", array("Pengajuan", "Menunggu Konfirmasi Webmaster", "Aktif"), null),
			array("tagihan", null, "input-hidden"),
		);
		$sub_kategori[] = ["Menu", $database_utama . "__role__group", null, "table"];
		$array_sub_kategori[] = array(
			array("Nama Role Group", null, "text"),
		);
		$sub_kategori[] = ["Menu", $database_utama . "__role__akses", null, "table"];
		$array_sub_kategori[] = array(
			array("role group", null, "select", array("web__list_apps_board__role__group", null, "nama_role_group"), null),
			array("Nama Role", null, "text"),
			array("", "template_base", "select-manua", array("Costum Template" => "Costum Template")),
			array("", "id_template", "select", array("website__template__list", null, "nama_template")),
			array("", "nama_menu", "select", array("web__list_apps_menu", null, "struktur_menu"), "nama_menu"),
		);
		// 		$sub_kategori[] = ["Panel", $database_utama . "__panel", null, "table"];
		// 		$array_sub_kategori[] = array(
		// 			array("panel", null, "select", array("panel", null, "nama_panel"),null),
		// 		);


		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps_tipe_paket()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__tipe";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("Nama Tipe Paket", null, "text"),
			array("list_Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),

		);

		$sub_kategori[] = ["Detail", $database_utama . "__detail", null, "table"];
		$array_sub_kategori[] = array(
			array("apps menu", null, "select", array("web__list_apps_menu", null, "struktur_menu"), null),
			array("Checklist", null, "select-manual", array(1 => "Ya", 0 => "Tidak")),
		);
		$page['crud']['database_sub_kategori'][$database_utama . "__detail"]['order'][] = array("struktur_menu", "asc");

		$page['crud']['insert_value']['checklist'] = 1;

		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['field_view_sub_kategori']['id_list_apps']['type'] = 'get'; //get or add
		$page['crud']['field_view_sub_kategori']['id_list_apps']['target'] = $database_utama . "__detail";
		$page['crud']['field_view_sub_kategori']['id_list_apps']['target_no'] = 0;
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['utama'] = "web__list_apps_menu";
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['primary_key'] = null;
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['select_raw'] = "*,web__list_apps_menu.id as id_apps_menu";

		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['order_by'][] = array('web__list_pps_menu.struktur_menu', 'asc');
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['order'][] = array('web__list_apps_menu.struktur_menu', 'asc');
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['where'][] = array('web__list_apps_menu.tipe_menu', '=', "'menu'");
		$page['crud']['field_view_sub_kategori']['id_list_apps']['database']['where'][] = array('web__list_apps_menu.active', '=', "1");
		$page['crud']['field_view_sub_kategori']['id_list_apps']['request_where'] = "id_apps";


		$page['crud']['field_view_sub_kategori']['id_list_apps']['field'][] = array(
			-1,
			"id_apps_menu",
			array("apps menu", "struktur_menu", "text", array("web__list_apps_menu", "id", "struktur_menu", 'a'), null),
		);

		$page['crud']['field_view_sub_kategori']['id_list_apps']['field'][] = array(
			0,
			"checklist",
			array("Checklist", null, "select-manual", array(1 => "Ya", 0 => "Tidak")),


		);

		$page['crud']['no_row_sub_kategori'][$database_utama . "__detail"] = true;





		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps_paket_list()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__list";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("Nama Paket", null, "text"),
			array("list_Apps", null, "select", array("web__list_apps", null, "nama_apps"), null),
			array("Group", null, "select", array("web__list_apps_paket__group", null, "nama_group"), null),
			array("Deskripsi Paket", null, "text"),
			array("Extend Paket", null, "text"),
			array("Harga Utama", null, "text"),
			array("Tipe Harga", null, "select-manual", array("Rp" => "Rp", "%" => "%")),
			array("Tagihan Term Frekuensi", null, "number"),
			array("Tagihan Term Per", null,  "select-manual", array("Hari" => "Hari", "Tanggal" => "Tanggal", "Bulan" => "Bulan", "Tahun" => "Tahun", "Lifetime" => "LifeTime")),



			array("urutan", null, "number"),

		);

		$sub_kategori[] = ["Detail", $database_utama . "__detail", null, "table"];
		$array_sub_kategori[] = array(
			array("elemen", null, "select", array("web__list_apps_paket__elemen", null, "nama_elemen"), null),
			array("count number", null, "number",),
			array("Checklist", null, "select-manual", array("Tidak", "Ya")),
			array("paket_apps", null, "select", array("web__list_apps_paket__tipe", null, "nama_tipe_paket"), null),
		);



		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps_paket_role__group()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__role__group";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("paket", null, "select", array("web__list_apps_paket__list", null, "nama_paket"), null),
			array("Nama Role Group", null, "text"),
			// 			array("Semua Menu", null, "select-manual",array("Tidak","Ya")),

		);





		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps_paket_role__akses($page_temp)
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__role__akses";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("paket", null, "select", array("web__list_apps_paket__list", null, "nama_paket"), null),
			array("role group", null, "select", array("web__list_apps_paket__role__group", null, "nama_role_group"), null),
			array("Nama Role", null, "text"),
			array("Page", null, "select-manual", array("Frontend" => "Frontend", "Backend" => "Backend")),
			array("Semua Menu", null, "select-manual", array("Tidak", "Ya")),

			array("", "id_template", "select", array("website__template__list", null, "nama_template")),
			array("", "nama_menu", "select", array("web__list_apps_menu", null, "struktur_menu"), "nama_menu"),
		);
		// 		$sub_kategori[] = ["menu_akses", $database_utama ."__menu", null, "table"];
		//         $array_sub_kategori[] = array(
		//             array("Menu", "menu", "select", array("web__list_apps_menu", null, "nama_menu"), null),
		//             array("Akses Menu", null, "select-manual", array("Tidak", "Ya")),
		//             array("Tambah", null, "select-manual", array("Tidak", "Ya")),
		//             array("Edit", null, "select-manual", array("Tidak", "Ya")),
		//             array("Hapus", null, "select-manual", array("Tidak", "Ya")),


		//         );
		// 		$page['crud']['sub_kategori'] = $sub_kategori ;
		// 		$page['crud']['array_sub_kategori'] = $array_sub_kategori ;
		// $page['crud']['hidden_show']['semua_menu']['default_sub_kategori'][$database_utama . "__menu"] = "hide";

		$page['crud']['crud_inline']['semua_menu'] = 'onchange="get_menu(this)"';
		$page['crud']['crud_inline']['id_paket'] = 'onchange="get_menu(this)"';
		$page_temp['route_type'] = "just_link";
		$page_temp['load']['link'] = "direct";
		$page['crud']['insert_after'] = array("Web", "save_menu");
		$page['crud']['crud_after'] = "
        <div id='menu-content'></div>
        <script>
            function get_menu(e){
                if($('#semua_menu0').val()==0){
                   var id_paket = $('#id_paket0').val();
            $.ajax({
                type: 'get',
                data: {
                    
                    'id': id_paket,

                    
                    

                },
                url: '" . ($page_temp['section']=='generate'?'':(Partial::link_direct($page_temp, base_url() . 'pages/', array("Web", "get_menu", 'view_layout', -1)))) . "',
                dataType: 'html',
                success: function(data) {
                    $('#menu-content').html(data); 
                },
                error: function(error) {
                    console.log('error; ' + eval(error));
                    //alert(2);
                },
                beforeSend: function(jqXHR) {

                }
            });
                   
                }else{
                   $('#menu-content').html(''); 
                }
            }
        </script>
        ";

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function get_menu($page)
	{
		$id_paket = Partial::input('id');
		$query = "
	    select * from web__list_apps_paket__list__detail
	    left join web__list_apps_paket__tipe__detail on id_paket_apps = id_web__list_apps_paket__tipe
	    where id_web__list_apps_paket__list=$id_paket
	    and web__list_apps_paket__list__detail.checklist = '1'
	    and web__list_apps_paket__tipe__detail.checklist = '1'
	    ";
		Partial::get_menu($page, $query, 'id_apps_menu', '');
		die;
	}
	public static function save_menu($page, $type, $id)
	{
		$menu = Partial::input('checklist_menu');
		$add = Partial::input('checklist_add');
		$edit = Partial::input('checklist_edit');
		$hapus = Partial::input('checklist_hapus');

		$fai = new MainFaiFramework();
		unset($page['crud']['insert_after']);
		foreach ($menu as $id_menu => $value) {
			$sqli['id_web__list_apps_paket__role__akses'] = $id;
			$sqli['id_menu'] = $id_menu;
			$sqli['akses_menu'] = $value;
			$sqli['tambah'] = isset($add[$id_menu]) ? 1 : 0;
			$sqli['edit'] = isset($edit[$id_menu]) ? 1 : 0;
			$sqli['hapus'] = isset($hapus[$id_menu]) ? 1 : 0;
			$respon = CrudFunc::crud_save($fai, $page, $sqli, array(), array(), "web__list_apps_paket__role__akses__menu");
			$collect_akses_menu[$id_menu] = $respon['last_insert_id'];
		}
	}
	public static function web_list_apps_paket_group()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__group";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("apps", null, "select", array("web__list_apps", null, "nama_apps"), null),
			array("Nama Group", null, "text"),
			array("Deskripsi Group", null, "text"),

		);





		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function web_list_apps_paket_elemen()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__list_apps_paket__elemen";
		$primary_key = null;

		$array = array(

			// array("Tipe Board", null, "select-manual", array("Kegiatan" => "Kegiatan", "Amalan" => "Amalan", "Task Planner" => "Task Planner", "Habits" => "Habits")),

			array("apps", null, "select", array("web__list_apps", null, "nama_apps"), null),
			array("Nama Elemen", null, "text"),
			array("Koneksi Apps", null, "select", array("web__list_apps", null, "nama_apps", "connection")),

		);





		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;

		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function profile_connection()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__panel__connection";
		$primary_key = null;

		$array = array(
			array("Nama Connection", null, "text"),
			array("Panel", "panel_list", "select", array("web__panel__list", null, "nama_panel"), null),
		);
		//block_ruang

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
	public static function panel_list()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__panel__list";
		$primary_key = null;

		$array = array(
			array("Nama Panel", null, "text"),
			array("Kode Session", null, "text"),
			array("First Menu", null, "select", array("web__menu", null, "nama_menu"), null),
		);
		//block_ruang

		$search = array();
		$sub_kategori[] = ["List Apps Panel", $database_utama . "_list_apps", null, "table"];
		$array_sub_kategori[] = array(
			array("Apps", "apps", "select", array("web__list_apps", null, "nama_apps"), null),


		);
		$page['crud']['sub_kategori'] = $sub_kategori;
		$page['crud']['array_sub_kategori'] = $array_sub_kategori;

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}

	public static function web_hak_akses()
	{
		$page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
		$page['route'] = __FUNCTION__;
		$page['layout_pdf'] = array('a4', 'portait');

		$database_utama = "web__hak_akses";
		$primary_key = null;

		$array = array(
			array("Kode Session", null, "text"),
			array("Nama Hak Akses", null, "text"),

		);
		//block_ruang

		$search = array();

		$page['crud']['array'] = $array;
		$page['crud']['search'] = $search;


		$page['database']['utama'] = $database_utama;
		$page['database']['primary_key'] = $primary_key;
		$page['database']['select'] = array("*");;
		$page['database']['join'] = array();
		$page['database']['where'] = array();
		return $page;
	}
}
