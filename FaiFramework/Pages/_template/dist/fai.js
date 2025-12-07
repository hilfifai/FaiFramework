var route_page = $('#load_link_route').val();
$.xhrPool = [];
var apps_global;
var page_view_global;
var link_route;
link_route = route_page;
let isUserInteracting = false;
document.addEventListener("DOMContentLoaded", function () {
	// Set isUserInteracting to true when the document is ready
	isUserInteracting = true;
});
function direct_role(e, id_board) {
	id_role = $(e).val();
	$.ajax({
		type: 'get',
		data: {

			'link_route': $('#load_link_route').val(),
			'frameworksubdomain': $('#load_domain').val(),
			'apps': 'Auth',
			'page_view': 'change_role_board',
			'type': 'view_layout',
			'id': -1,

			'contentfaiframework': 'get_pages',
			"MainAll": 2,
			'id_board': id_board,
			'id_role': id_role,




		},
		url: link_route,
		dataType: 'html',
		success: function (data) {

		},
		error: function (error) {
			console.log('error; ' + eval(error));

		},
		beforeSend: function (jqXHR) {

		}
	});
}
function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};

	return text.replace(/[&<>"']/g, function (m) { return map[m]; });
}
function countup(el, target) {
	let data = {
		count: 0
	};
	anime({
		targets: data,
		count: [0, target],
		duration: 4000,
		round: 1,
		delay: 200,
		easing: 'easeOutCubic',
		update() {
			el.innerText = data.count.toLocaleString();
		}
	});
}

function makeCountup(el) {
	const text = el.textContent;
	const target = parseInt(text, 10);

	const io = new IntersectionObserver(entries => {
		entries.forEach(entry => {
			if (entry.intersectionRatio > 0) {
				countup(el, target);
				io.unobserve(entry.target);
			}
		});
	});

	io.observe(el);
}

const els = document.querySelectorAll('[data-countup]');
els.forEach(makeCountup);

// alert()
function select_varian(id_asset, id_produk, id_varian_list, level) {
	//alert(id_varian_list);
	// $('#id_produk_varian').val(id_produk_varian);
	// $('#id_asset_varian').val(id_asset_varian);
	if (isUserInteracting) {

		$('#id_varian_list').val(id_varian_list);
		$('#id_varian_' + level).val(id_varian_list);
		$('#level').val(level);


		$.ajax({
			type: 'GET',
			data: {
				'first': link_route,
				'link_route': $('#load_link_route').val(),
				'frameworksubdomain': $('#load_domain').val(),
				'apps': 'Ecommerce',
				'page_view': 'add_cart',
				'type': 'select_varian',
				'id': $('#load_id').val(),
				'id_asset': id_asset,
				'id_produk': id_produk,
				'level': level,
				'id_varian_list': $('#id_varian_list').val(),
				'id_varian_3': $('#id_varian_3').val(),
				'id_varian_2': $('#id_varian_2').val(),
				'id_varian_1': $('#id_varian_1').val(),
				'set_qty': $('#set_qty').val(),
				'contentfaiframework': 'get_pages',
				"MainAll": 2
			},
			url: $('#load_link_route').val(),
			dataType: 'json',
			success: function (data) {

				// $('#satuan-harga-' + id_cart).html(data.harga_satuan_print);
				// $('#view-harga-' + id_cart).html(data.harga_jual_akhir_print);
				// $('#image_cart-' + id_cart).html(data.img_src);
				$('#levelke-' + (level + 1)).html(data.varian_list);
				$('#harga_akhir').html(data.harga_jual_akhir_print);
				$('#image_detail').html(data.img_src);
				$('#stok_barang').html(data.stok);
				$('#set_qty').attr("max", data.stok);
			},
			error: function (error) {
				console.log('error; ' + eval(error));
				//alert(2);
			}
		});

		// if ($('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).is(':checked')) {
		// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', false);
		// } else {
		// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', true);
		// }
		//$('#checked-'+id_asset+"-"+id_produk+"-"+id_produk_varian+"-"+id_varian_list+"-"+level).prop('checked');
	}
}

function gunakan_voucher(id_voucher) {
	//alert(id_varian_list);
	// $('#id_produk_varian').val(id_produk_varian);
	// $('#id_asset_varian').val(id_asset_varian);

	$.ajax({
		type: 'GET',
		data: {
			'first': link_route,
			'link_route': $('#load_link_route').val(),
			'apps': 'Ecommerce',
			'page_view': 'add_cart',
			'type': 'gunakan_voucher',
			'id': $('#load_id').val(),
			'id_voucher': id_voucher,

			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'json',
		success: function (data) {

			$('#varian-' + (level + 1) + '-' + id_cart).html(data.varian_list_option);

		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});

	// if ($('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).is(':checked')) {
	// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', false);
	// } else {
	// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', true);
	// }
	//$('#checked-'+id_asset+"-"+id_produk+"-"+id_produk_varian+"-"+id_varian_list+"-"+level).prop('checked');
}

function batalkan_voucher(id_voucher) {
	//alert(id_varian_list);
	// $('#id_produk_varian').val(id_produk_varian);
	// $('#id_asset_varian').val(id_asset_varian);

	$.ajax({
		type: 'GET',
		data: {
			'first': link_route,
			'link_route': $('#load_link_route').val(),
			'apps': 'Ecommerce',
			'page_view': 'add_cart',
			'type': 'batalkan_voucher',
			'id': $('#load_id').val(),
			'id_voucher': id_voucher,

			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'json',
		success: function (data) {

			$('#varian-' + (level + 1) + '-' + id_cart).html(data.varian_list_option);

		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});

	// if ($('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).is(':checked')) {
	// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', false);
	// } else {
	// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', true);
	// }
	//$('#checked-'+id_asset+"-"+id_produk+"-"+id_produk_varian+"-"+id_varian_list+"-"+level).prop('checked');
}

function cek_varian_cart(id_cart, level) {
	//alert(id_varian_list);
	// $('#id_produk_varian').val(id_produk_varian);
	// $('#id_asset_varian').val(id_asset_varian);
	if (isUserInteracting) {
		level = parseInt(level);
		var varian_1 = 0;
		var varian_2 = 0;
		var varian_3 = 0;
		if (typeof $('#varian-1-' + id_cart).val() !== 'undefined') {
			// the variable is defined
			varian_1 = $('#varian-1-' + id_cart).val();
		}
		if (typeof ($('#varian-2-' + id_cart).val()) !== 'undefined') {
			// the variable is defined
			varian_2 = $('#varian-2-' + id_cart).val();
		}

		if (typeof ($('#varian-3-' + id_cart).val()) !== 'undefined') {
			// the variable is defined
			varian_3 = $('#varian-3-' + id_cart).val();
		}
		$.ajax({
			type: 'GET',
			data: {
				'first': link_route,
				'link_route': $('#load_link_route').val(),
				'apps': 'Ecommerce',
				'page_view': 'add_cart',
				'type': 'select_varian_cart',
				'id': $('#load_id').val(),
				'id_cart': id_cart,
				'level': level,
				'id_varian_list': $('#id_varian_list').val(),
				'id_varian_3': varian_3,
				'id_varian_2': varian_2,
				'id_varian_1': varian_1,
				'set_qty': $('#set_qty-' + id_cart).val(),
				'contentfaiframework': 'get_pages',
				'frameworksubdomain': $('#load_domain').val(),
				"MainAll": 2
			},
			url: $('#load_link_route').val(),
			dataType: 'json',
			success: function (data) {

				$('#varian-' + (level + 1) + '-' + id_cart).html(data.varian_list_option);

			},
			error: function (error) {
				console.log('error; ' + eval(error));
				//alert(2);
			}
		});

		// if ($('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).is(':checked')) {
		// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', false);
		// } else {
		// 	$('#checked-' + id_asset + "-" + id_produk + "-" +  id_varian_list + "-" + level).prop('checked', true);
		// }
		//$('#checked-'+id_asset+"-"+id_produk+"-"+id_produk_varian+"-"+id_varian_list+"-"+level).prop('checked');
	}
}

function cek_harga(id_cart) {
	if (isUserInteracting) {
		var varian_1 = 0;
		var varian_2 = 0;
		var varian_3 = 0;
		var qty = 0;
		if (typeof $('#varian-1-' + id_cart).val() !== 'undefined') {
			// the variable is defined
			varian_1 = $('#varian-1-' + id_cart).val();
		}
		if (typeof ($('#varian-2-' + id_cart).val()) !== 'undefined') {
			// the variable is defined
			varian_2 = $('#varian-2-' + id_cart).val();
		}

		if (typeof ($('#varian-3-' + id_cart).val()) !== 'undefined') {
			// the variable is defined
			varian_3 = $('#varian-3-' + id_cart).val();
		}
		if (typeof ($('#set_qty-' + id_cart).val()) !== 'undefined') {
			// the variable is defined
			qty = $('#set_qty-' + id_cart).val();
		}
		visible = false;
		max_varian = $('#max_varian-' + id_cart).val();
		if ($('#is_varian-' + id_cart).val() == 1) {
			if (max_varian == 1 && varian_1) {
				visible = true;
			} else if (max_varian == 1 && !varian_1) {
				alert("Silahkan untuk memilih varian terlebih dahulu");
				$('#bismillah_beli-' + id_cart).prop('checked', false);
			} else if (max_varian == 2 && varian_2) {
				visible = true;
			} else if (max_varian == 2 && !varian_2) {
				alert("Silahkan untuk memilih varian terlebih dahulu");
				$('#bismillah_beli-' + id_cart).prop('checked', false);
			} else if (max_varian == 3 && varian_3) {
				visible = true;
			} else if (max_varian == 3 && !varian_3) {
				alert("Silahkan untuk memilih varian terlebih dahulu");
				$('#bismillah_beli-' + id_cart).prop('checked', false);
			}
		} else {
			visible = true;
		}

		$.ajax({
			type: 'GET',
			data: $('#formvte_fai_framework').serialize()
				+ '&link_route=' + $('#load_link_route').val()
				+ '&apps=' + $('#load_apps').val()
				+ '&page_view=' + $('#load_page_view').val()
				+ '&type=cek_harga_cart_get_checkout'
				+ '&id=' + $('#load_id').val()
				+ '&frameworksubdomain=' + $('#load_domain').val()
				+ '&id_cart=' + id_cart
				+ '&varian_1=' + varian_1
				+ '&varian_2=' + varian_2
				+ '&varian_3=' + varian_3
				+ '&set_qty=' + qty
				+ '&checked=' + $('#bismillah_beli-' + id_cart).is(':checked')
				+ '&MainAll=2'
				+ '&contentfaiframework=get_pages',
			url: $('#load_link_route').val(),
			dataType: 'json',
			beforeSend: function () {
				$("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
			},
			success: function (data) {

				$('#satuan-harga-' + id_cart).html(data.harga_satuan_print);
				$('#view-harga-' + id_cart).html(data.harga_jual_akhir_print);
				$('#image_cart-' + id_cart).html(data.img_src);
				$('#summary').html(data.print_summary);
			},
			error: function (error) {
				console.log('error; ' + eval(error));
				//alert(2);
			}
		});

	}
}
function delete_cart(id_cart) {

	$.ajax({
		type: 'GET',
		data: $('#formvte_fai_framework').serialize()
			+ '&link_route=' + $('#load_link_route').val()
			+ '&apps=' + $('#load_apps').val()
			+ '&page_view=' + $('#load_page_view').val()
			+ '&frameworksubdomain=' + $('#load_domain').val()
			+ '&type=delete_cart'
			+ '&id=' + $('#load_id').val()
			+ '&id_cart=' + id_cart
			+ '&MainAll=2'
			+ '&contentfaiframework=get_pages',
		url: $('#load_link_route').val(),
		dataType: 'json',
		success: function (data) {

			$('#store_cart-' + id_cart).html('');
			cek_harga(id_cart)
			//$('#view-harga-' + id_cart).html(data.Harga_jual_akhir);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});
}
function add_cart() {
	pageNum = $('#select_date').val();
	if ($('#is_login').val() == 0) {
		swal("Gagal!", "Login Terlebih Dahulu", "error");

	} else if (parseInt($('#set_qty').val()) > parseInt($('#set_qty').attr("max"))) {
		swal("Gagal!", "QTY Melebihi Stok", "error");

	} else {

		$.ajax({

			type: 'get',
			dataType: 'html',
			data: {
				'first': link_route,
				'link_route': $('#load_link_route').val(),
				'frameworksubdomain': $('#load_domain').val(),
				'apps': 'Ecommerce',
				'page_view': 'add_cart',
				'type': 'add_cart',
				'id': $('#load_id').val(),
				'id_asset': $('#id_asset').val(),
				'id_produk': $('#id_produk').val(),
				'level': $('#level').val(),
				'id_varian_list': $('#id_varian_list').val(),
				'id_varian_3': $('#id_varian_3').val(),
				'id_varian_2': $('#id_varian_2').val(),
				'id_varian_1': $('#id_varian_1').val(),
				'set_qty': $('#set_qty').val(),
				'id_produk_varian': $('#id_produk_varian').val(),
				'id_asset_varian': $('#id_asset_varian').val(),
				tgl: pageNum,
				'contentfaiframework': 'get_pages',
				"MainAll": 2
			},
			url: link_route,
			dataType: 'json',
			success: function (responseData) {

				if (responseData.status) {

					swal("Sukses!", "Produk sudah masuk kedalam cart!", "success");
					if ($('#stok_barang').length > 0) {
						now_stok = $('#stok_barang').val();
						now_stok = parseInt(now_stok);
						now_stok = now_stok - 1;
						$('#stok_barang').val(now_stok);
					}
				}
				else
					swal("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


			}
		});
	}

}
function submit_login() {
	//alert($('#load_link_route').val());

	$.ajax({
		type: 'GET',
		data: $('#formvte_fai_framework').serialize()
			+ '&link_route=' + $('#load_link_route').val()
			+ '&apps=' + $('#load_apps').val()
			+ '&frameworksubdomain=' + $('#load_domain').val()
			+ '&page_view=' + $('#load_page_view').val()
			+ '&id=' + $('#load_id').val()
			+ '&frameworksubdomain=' + $('#load_domain').val()
			+ '&type=get_login'
			+ '&contentfaiframework=get_pages'
			+ '&MainAll=2',
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {

			window.location.href = $('#load_link_route').val();
			//	reach_page($('#load_link_route').val(), $('#load_type').val(), $('#load_id').val());
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});
}

function loadTable_habits_Table() {
	pageNum = $('#select_date').val();
	$.ajax({

		type: 'get',
		dataType: 'html',
		data: {
			'first': link_route,
			'link_route': $('#load_link_route').val(),
			'apps': 'Kegiatan',
			'page_view': 'list_kegiatan',
			'type': 'habittable',
			'id': $('#load_id').val(),
			'frameworksubdomain': $('#load_domain').val(),
			'tgl': pageNum,
			'contentfaiframework': 'get_pages',
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (responseData) {

			$("#table-scroll").html(responseData);



		}
	});

}

function addTblDate(totalAdd) {
	//$('#select_date').val() 
	var newDate = addDays(new Date($('#select_date').val()), totalAdd, 'yyyy-MM-dd'); // @formatter:off
	$('#select_date').val(newDate);
	//alert(newDate);

}
var formatDate = function date2str(x, y) {
	var z = {
		M: x.getMonth() + 1,
		d: x.getDate(),
		h: x.getHours(),
		m: x.getMinutes(),
		s: x.getSeconds()
	};
	y = y.replace(/(M+|d+|h+|m+|s+)/g, function (v) {
		return ((v.length > 1 ? "0" : "") + z[v.slice(-1)]).slice(-2)
	});

	return y.replace(/(y+)/g, function (v) {
		return x.getFullYear().toString().slice(-v.length)
	});
};

function addDays(theDate, days, formater) {
	return formatDate(new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000), formater);
}


function u3OmVFdtRd4uXovbH93VEgnnVvoZCfgxa38DXdOaEPopYn3(k1c3rd6oNGXpYsShHOqQhilDC4314zDBm5fDb, kPmlKFpnFVaL6UxJHIWG169OOKdOLzimnIa11IWG16uYLnkVni1p, kPmlKFpnFVaL6UxJHIWG169OOKdOLzimVni1pjwYqPuYLnktTX9COLzim9OOKd3PhkLVni1pjwYqPIWG16nIa11, date) {
	$.ajax({
		type: "post",
		data: {
			'first': link_route,
			'link_route': $('#load_link_route').val(),
			'apps': 'Kegiatan',
			'page_view': 'list_kegiatan',
			'type': 'save_lapor_habits',
			'id': $('#load_id').val(),
			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			k54Pl3gdvRiNvXwcHaZY61SvdfxvD0u7: k1c3rd6oNGXpYsShHOqQhilDC4314zDBm5fDb,
			kPmlKFpnFVaL6UxJHIWG169OOKdOLzimnIa11IWG16uYLnkVni1p: kPmlKFpnFVaL6UxJHIWG169OOKdOLzimnIa11IWG16uYLnkVni1p,
			kPmlKFpnFVaL6UxJHIWG169OOKdOLzimVni1pjwYqPuYLnktTX9COLzim9OOKd3PhkLVni1pjwYqPIWG16nIa11: kPmlKFpnFVaL6UxJHIWG169OOKdOLzimVni1pjwYqPuYLnktTX9COLzim9OOKd3PhkLVni1pjwYqPIWG16nIa11,
			tgl: date,
			"MainAll": 2
		},
		url: link_route,
		cache: false,
		success: function (res) {

			loadTable()

		},
		error: function (error) {
			console.log(' Error ${error}')
		}
	});
}

function u3OmVFdtRd4uXovbH93VEgnnVvoZCfgxa38DXdOaEPopYn3BT9sBdOaEPZCfgx(k1c3rd6oNGXpYsShHOqQhilDC4314zDBm5fDb, date, span) {
	//alert();
	$('#' + k1c3rd6oNGXpYsShHOqQhilDC4314zDBm5fDb + '-' + date).html(span);
}

function submit_daftar(next, id_now, next_id) {


	if (validation()) {
		$.ajax({
			type: 'GET',
			data: $('#formvte_fai_framework').serialize()
				+ '&link_route=' + $('#load_link_route').val()
				+ '&apps=' + $('#load_apps').val()
				+ '&page_view=' + $('#load_page_view').val()
				+ '&type=save_daftar'
				+ '&id=' + id_now
				+ '&frameworksubdomain=' + $('#load_domain').val()
				+ '&contentfaiframework=get_pages'
				+ '&MainAll=2',
			url: $('#load_link_route').val(),
			dataType: 'html',
			success: function (data) {
				if (next) {
					reach_page($('#load_link_route').val(), 'daftar', next_id);

				} else {
					reach_page($('#load_link_route').val(), $('#load_type').val(), $('#load_id').val());
				}
			},
			error: function (error) {
				console.log('error; ' + eval(error));
				//alert(2);
			}
		});
	}
}

function kirim_ulang() {
	$.ajax(
		{
			type: "POST",
			url: "http://localhost/FrameworkServer/hibe3/auth/kirim_ulang",
			cache: false,
			dataType: "JSON",
			success: function (data) {

			}
		});
}

function load_navbar() {


	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'navbar',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#LoadNavbar').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function load_header() {


	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'header',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#LoadHeader').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function load_sidebar() {


	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'sidebar',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#LoadSidebar').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			////$.xhrPool.push(jqXHR);
		}
	});
}
function load_sidebarin() {


	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'sidebarin',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {

			$('#contentFaiFramework').before(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			////$.xhrPool.push(jqXHR);
		}
	});
}

function load_buttombar() {


	$.ajax({
		type: 'get',
		data: {
			'contentfaiframework': 'buttombar',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#LoadButtombar').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function changeMenu(type, controller_, function_) {


	$.ajax({
		type: 'get',
		data: {

			'array_menu_': type,
			'controller_': controller_,
			'function_': function_,
			'contentfaiframework': 'changeMenu',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#LoadSidebar').html(data);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function reach_page_first(apps, page_view, type, id) {
	apps_global = apps;
	page_view_global = page_view;

	$.ajax({
		type: 'get',
		data: {
			'first': link_route,
			'link_route': link_route,
			'apps': apps,
			'page_view': page_view,
			'type': type,
			'id': id,
			'contentfaiframework': 'pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#contentFaiFramework').html(data);
			$('#load_link_route').val(link_route);
			$('#load_apps').val(apps);
			$('#load_page_view').val(page_view);
			$('#load_type').val(type);
			$('#load_id').val(id);
			eachDe();
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function reachpage(page_view, type, id, menu = '-1') {
	reach_page(page_view, type, id, menu = '-1');
}
function reach_page(page_view, type, id, menu = '-1') {
	// $.xhrPool.abortAll = function() {
	// 	each(this, function(jqXHR) {
	// 	  jqXHR.abort();
	// 	});
	//   };
	$.ajax({
		type: 'post',
		data: {
			'link_route': link_route,
			'apps': apps_global,
			'page_view': page_view_global,
			'type': type,
			'id': id,
			'menu': menu,
			'contentfaiframework': 'link_direct',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'json',
		success: function (data) {
			if (data.link == 'direct') {
				window.location.href = data.href;
			} else {


				$('#contentFaiFramework').html(data.data);
				$('#load_link_route').val(link_route);
				$('#load_apps').val(apps_global);
				$('#load_page_view').val(page_view_global);
				$('#load_type').val(type);
				$('#load_menu').val(menu);
				$('#load_id').val(id);
				// $('#example1').datatable();
				$('.select2').select2();
				eachDe();
				if ($("#example2").length > 0) {
					table.ajax.reload();
				}
			}
		},
		error: function (error) {
			console.log('error; ' + eval(error));

		}
		, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function reach_page_content_div(content_id, page_view, type, id, menu = '-1') {
	// $.xhrPool.abortAll = function() {
	// 	each(this, function(jqXHR) {
	// 	  jqXHR.abort();
	// 	});
	//   };
	$.ajax({
		type: 'post',
		data: {
			'link_route': link_route,
			'apps': apps_global,
			'page_view': page_view_global,
			'type': type,
			'id': id,
			'menu': menu,
			'contentfaiframework': 'pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#contentFaiFramework').html(data);
			$('#load_link_route').val(link_route);
			$('#load_apps').val(apps_global);
			$('#load_page_view').val(page_view_global);
			$('#load_type').val(type);
			$('#load_menu').val(menu);
			$('#load_id').val(id);
			// $('#example1').datatable();
			eachDe();
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
		, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function reach_page_ajax(page_view, type, id, menu = '-1') {
	// $.xhrPool.abortAll = function() {
	// 	each(this, function(jqXHR) {
	// 	  jqXHR.abort();
	// 	});
	//   };
	$.ajax({
		type: 'post',
		data: {
			'link_route': link_route,
			'apps': apps_global,
			'page_view': page_view_global,
			'type': type,
			'id': id,
			'menu': menu,
			'contentfaiframework': 'pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#contentFaiFramework').html(data);
			$('#load_link_route').val(link_route);
			$('#load_apps').val(apps_global);
			$('#load_page_view').val(page_view_global);
			$('#load_type').val(type);
			$('#load_menu').val(menu);
			$('#load_id').val(id);

			eachDe();
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
		, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function reach_page_post(page_view, type, id) {

	$.ajax({
		type: 'POST',
		data: {
			'link_route': link_route,
			'apps': apps_global,
			'page_view': page_view_global,
			'type': type,
			'id': id,
			'menu': $('#load_menu').val(),
			'contentfaiframework': 'pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			$('#contentFaiFramework').html(data);
			$('#load_link_route').val(link_route);
			$('#load_apps').val(apps_global);
			$('#load_page_view').val(page_view_global);
			$('#load_type').val(type);
			$('#load_id').val(id);
			eachDe();
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}


function reach_page_redirect(page_view, type, id, redirect) {

	$.ajax({
		type: 'get',
		data: {
			'link_route': link_route,
			'apps': apps_global,
			'page_view': page_view_global,
			'type': type,
			'id': id,
			'contentfaiframework': 'pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: link_route,
		dataType: 'html',
		success: function (data) {
			//$('#contentFaiFramework').html(data);
			$('#load_link_route').val(link_route);
			$('#load_apps').val(apps_global);
			$('#load_page_view').val(page_view_global);
			$('#load_type').val(type);
			$('#load_id').val(id);
			reach_page(page_view, redirect, -1);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});
}
function debounce_fai(func, delay) {
	let timeout;
	return function (...args) {
		clearTimeout(timeout); // Hapus timer sebelumnya
		timeout = setTimeout(() => func.apply(this, args), delay); // Set timer baru
	};
}
const load_data_menu = debounce_fai((id, i_card) => {

	load_data_menu_proses(id, i_card)
}, 1000);
function load_data_menu_proses(id, i_card) {
	$('#load_id').val(id);


	$.ajax({
		url: $('#load_link_route').val(),
		data: {
			jumlah: $('#limit_page').val(),
			total_record: $('#total_record').val(),
			datasearch: $('#searchID-' + i_card).val(),
			dataSortBy: $('#sortByListing').val(),
			datafilter: $('#filterform').serializeArray(),
			page_view: $('#load_page_view').val(),
			menu: $('#load_menu').val(),
			view: view,
			i_card: i_card,
			page: number_page,
			type: 'load_data',
			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			number_page: number_page,
			apps: $('#load_apps').val(),
			id: id,
			"MainAll": 2

		},
		type: "get",
		dataType: "HTML",

		success: function (response, textStatus, xhr) {

			$('#contentList').html(response);
			eachDe();
		},
		beforeSend: function (error) {
			$('#contentList').html("Sedang mengambil data, mohon tunggu sebentar");

		}, error: function (error) {

			console.log(' Error ${error}')
		}
	})
}
// eachDe();
function eachDe() {

	$('be3[done="false"]').each(function (i, el) {
		txt = $(el).attr("text");
		if ($(el).attr("done") == 'false') {

			$.ajax({
				url: $('#load_link_route').val(),
				data: {
					text: txt,
					type: 'enskripsi',
					page_view: $('#load_page_view').val(),
					apps: $('#load_apps').val(),
					id: $('#load_id').val(),
					'contentfaiframework': 'get_pages',
					'frameworksubdomain': $('#load_domain').val(),
					"MainAll": 2,
					"not_sidebar": "not",
				},
				type: "post",
				dataType: "HTML",

				success: function (response, textStatus, xhr) {
					$(el).html(response);
					$(el).attr("done", true);

				},
				error: function (error) {

					$(el).html('');
				}, beforeSend: function (jqXHR) {
					//	//$.xhrPool.push(jqXHR);
				}
			})

		}
	});
}
function de(text) {
	let respon;
	$.ajax({
		type: "post",
		data: { text: text },
		url: "<?=r('_system','be3system/get')?>",
		dataType: "html",
		success: function (data) {
			respon = data;

		},
		error: function () {
			respon = '';
		}, beforeSend: function (jqXHR) {
			//$.xhrPool.push(jqXHR);
		}
	});

	response = respon;
	return response;

}

function sub_kategori_hapus(h, no) {
	$(".contentsubkategori-" + h + "-" + no + "").remove();
}

function deleteRow(h, row) {
	$("#table-subkateogri-tr-" + row).remove();
}
function deleteRow_edit(h, row, id, type) {
	if (type == 'table') {
		$('#tablecontentsubkategori-tbody-' + h + '').append("<input type='hidden' name='deleteRow" + h + "[]' value='" + id + "'>");
	} else {
		$('#addcontentsubkategori-' + h).append("<input type='hidden' name='deleteRow" + h + "[]' value='" + row + "'>");
	}
	$("#table-subkateogri-tr-" + h + "-" + row).remove();
}
function sub_kategori_add(h, type, perantara = 1) {
	no = $('.no-' + h).length;
	$.ajax({
		type: 'post',
		data: {
			'h': h,
			'_view': $('#load_crud_view').val(),
			'jumlah_add': $('#tambah_sub_kategori-' + h).val(),
			'no': no,
			'id': -1,
			'apps': $('#load_apps').val(),
			'page_view': $('#load_page_view').val(),
			'type': 'ajax_sub_kategori',
			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2,
			"not_sidebar": "not",
		},
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {
			if (type == 'table') {
				$('#tablecontentsubkategori-tbody-' + h + '').append(data);
			} else {
				$('#addcontentsubkategori-' + h).append(data);
			}
			$('.select3').select2();

			perantara_add_sub_kategori(h, no);
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});

}

function modalform_sub_kategori_add(h, no, i, nama_sub_kategori, type = 'table') {

	var nomor = 0;

	$('.no_sub_kategori-' + nama_sub_kategori).each(function () {
		nomor = $(this).val();
	});
	$.ajax({
		type: 'get',
		data: {
			'h': h,
			'_view': $('#load_crud_view').val(),
			'no': no,
			'nomor': nomor,
			'i': i,
			'id': -1,
			'apps': $('#load_apps').val(),
			'page_view': $('#load_page_view').val(),
			'type': 'modalform_sub_kategori_add',
			'contentfaiframework': 'get_pages',
			'frameworksubdomain': $('#load_domain').val(),
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {
			if (type == 'table') {
				$('#tablecontentmodalformsubkategori-tbody-' + h + '-' + no).append(data);
			} else {
				$('#addcontentsubkategori-' + h).append(data);
			}
			$('.select3').select2();
		},
		error: function (error) {
			console.log('error; ' + eval(error));
			//alert(2);
		}
	});

}
if ($('#example1').length)
	$('#example1').DataTable();
if ($('.select2').length)
	$('.select2').select2();
var SETTINGS = {
	navBarTravelling: false,
	navBarTravelDirection: "",
	navBarTravelDistance: 150
}

document.documentElement.classList.remove("no-js");
document.documentElement.classList.add("js");

// Out advancer buttons

// the indicator
if ($('#pnProductNav').length){
var pnIndicator = document.getElementById("pnIndicator");

var pnProductNav = document.getElementById("pnProductNav");
var pnProductNavContents = document.getElementById("pnProductNavContents");

pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));

// Set the indicator
moveIndicator(pnProductNav.querySelector("[aria-selected=\"true\"]"));

// Handle the scroll of the horizontal container
var last_known_scroll_position = 0;
var ticking = false;

function doSomething(scroll_pos) {
	pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
}

pnProductNav.addEventListener("scroll", function () {
	last_known_scroll_position = window.scrollY;
	if (!ticking) {
		window.requestAnimationFrame(function () {
			doSomething(last_known_scroll_position);
			ticking = false;
		});
	}
	ticking = true;
});

if ($('#pnAdvancerLeft').length) {
	var pnAdvancerLeft = document.getElementById("pnAdvancerLeft");
	pnAdvancerLeft.addEventListener("click", function () {
		// If in the middle of a move return
		if (SETTINGS.navBarTravelling === true) {
			return;
		}
		// If we have content overflowing both sides or on the left
		if (determineOverflow(pnProductNavContents, pnProductNav) === "left" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
			// Find how far this panel has been scrolled
			var availableScrollLeft = pnProductNav.scrollLeft;
			// If the space available is less than two lots of our desired distance, just move the whole amount
			// otherwise, move by the amount in the settings
			if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
				pnProductNavContents.style.transform = "translateX(" + availableScrollLeft + "px)";
			} else {
				pnProductNavContents.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
			}
			// We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
			pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
			// Update our settings
			SETTINGS.navBarTravelDirection = "left";
			SETTINGS.navBarTravelling = true;
		}
		// Now update the attribute in the DOM
		pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
	});
}
if ($('#pnAdvancerRight').length) {
	var pnAdvancerRight = document.getElementById("pnAdvancerRight");
	pnAdvancerRight.addEventListener("click", function () {
		// If in the middle of a move return
		if (SETTINGS.navBarTravelling === true) {
			return;
		}
		// If we have content overflowing both sides or on the right
		if (determineOverflow(pnProductNavContents, pnProductNav) === "right" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
			// Get the right edge of the container and content
			var navBarRightEdge = pnProductNavContents.getBoundingClientRect().right;
			var navBarScrollerRightEdge = pnProductNav.getBoundingClientRect().right;
			// Now we know how much space we have available to scroll
			var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
			// If the space available is less than two lots of our desired distance, just move the whole amount
			// otherwise, move by the amount in the settings
			if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
				pnProductNavContents.style.transform = "translateX(-" + availableScrollRight + "px)";
			} else {
				pnProductNavContents.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
			}
			// We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
			pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
			// Update our settings
			SETTINGS.navBarTravelDirection = "right";
			SETTINGS.navBarTravelling = true;
		}
		// Now update the attribute in the DOM
		pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
	});
}

pnProductNavContents.addEventListener(
	"transitionend",
	function () {
		// get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
		var styleOfTransform = window.getComputedStyle(pnProductNavContents, null);
		var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
		// If there is no transition we want to default to 0 and not null
		var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
		pnProductNavContents.style.transform = "none";
		pnProductNavContents.classList.add("pn-ProductNav_Contents-no-transition");
		// Now lets set the scroll position
		if (SETTINGS.navBarTravelDirection === "left") {
			pnProductNav.scrollLeft = pnProductNav.scrollLeft - amount;
		} else {
			pnProductNav.scrollLeft = pnProductNav.scrollLeft + amount;
		}
		SETTINGS.navBarTravelling = false;
	},
	false
);

// Handle setting the currently active link
pnProductNavContents.addEventListener("click", function (e) {
	var links = [].slice.call(document.querySelectorAll(".pn-ProductNav_Link"));
	links.forEach(function (item) {
		item.setAttribute("aria-selected", "false");
	})
	e.target.setAttribute("aria-selected", "true");
	moveIndicator(e.target);
});
}
function moveIndicator(item, color) {
	var textPosition = item.getBoundingClientRect();
	var container = pnProductNavContents.getBoundingClientRect().left;
	var distance = textPosition.left - container;
	pnIndicator.style.transform = "translateX(" + (distance + pnProductNavContents.scrollLeft) + "px) scaleX(" + textPosition.width * 0.01 + ")";
	if (color) {
		pnIndicator.style.backgroundColor = colour;
	}
}

function determineOverflow(content, container) {
	var containerMetrics = container.getBoundingClientRect();
	var containerMetricsRight = Math.floor(containerMetrics.right);
	var containerMetricsLeft = Math.floor(containerMetrics.left);
	var contentMetrics = content.getBoundingClientRect();
	var contentMetricsRight = Math.floor(contentMetrics.right);
	var contentMetricsLeft = Math.floor(contentMetrics.left);
	if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
		return "both";
	} else if (contentMetricsLeft < containerMetricsLeft) {
		return "left";
	} else if (contentMetricsRight > containerMetricsRight) {
		return "right";
	} else {
		return "none";
	}
}

var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
	var options = {
		damping: '0.5'
	}
	Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
$(function () {
	//Initialize Select2 Elements
	$('.select2').select2()

})
function Show_alert(pesan, class_name, svg = null, menit = 1000) {
	//alert(pesan)
	//$("#pesan").html(pesan);
	class_name = 'alert alert-' + class_name;
	document.getElementById("pesan").innerHTML = pesan;
	document.getElementById("classType").className = class_name;
	content_svg = '';
	if (svg == 'svg-checklis') {
		content_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>';
	} else if (svg == 'svg-info') {
		content_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>';
	} else if (svg == 'svg-important') {
		content_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>';
	} else if (svg == 'svg-danger') {
		content_svg = '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
	}
	document.getElementById("svg_content").innerHTML = content_svg;
	var x = document.getElementById("snackbar");
	x.className = "show";
	setTimeout(function () { x.className = x.className.replace("show", ""); }, menit);
}
function Show_alert_multiple(pesan, class_name, svg = null) {
	var el = document.createElement("div");
	el.className = "snackbar";
	var y = document.getElementById("snackbar-container");
	el.innerHTML = pesan;
	y.append(el);

	document.getElementById("classType").className = class_name;
	class_name = 'alert alert-' + class_name;
	el.className = "snackbar show";
	setTimeout(function () { el.className = el.className.replace("snackbar show", "snackbar"); }, 3000);
}


function quick_view(url) {
	window.location.replace(url);
}
function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
function save_session() {
	var formData = new FormData($('#myFirstSession')[0]);
	var url = 'http://localhost/Server/hibe3/home/save_session/';
	//alert('hallo');
	$.ajax(
		{
			url: url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			//dataType: "JSON",
			success: function (data, textStatus, xhr) {

				location.reload();

			},
			error: function (error) {
				console.log(error)

			}
		});
}

function gantipage(numberpage) {

	var TotalView = document.getElementById("total_record").value;
	pageBefore = number_page;
	number_page = numberpage;
}

function searchButton(e) {
	if ($(e).attr("data-visible") == 'false') {
		$('#searchContent').show();
		$(e).attr("data-visible", true);
	} else {
		$('#searchContent').hide();
		$(e).attr("data-visible", false);

	}
	$('#searchID').val('');;
	number_page = 1;
}

function filterButton(e) {
	if ($(e).attr("data-visible") == 'false') {
		$('#filterContent').show();
		$(e).attr("data-visible", true);
	} else {
		$('#filterContent').hide();
		$(e).attr("data-visible", false);

	}
	$('#searchID').val('');;
	number_page = 1;
}

function changeView(varview) {
	view = varview;
	$('#searchID').val('');;
	load_data_menu();
}

function handleNumber(event, mask, prefix = '', sufix = '', total_number = -10, total_decimal = -2) {
	//  var mask = prefix+"{"+total_number+","+total_decimal+"}"+sufix;

	/* numeric mask with pre, post, minus sign, dots and comma as decimal separator
		{}: positive integer
		{10}: positive integer max 10 digit
		{,3}: positive float max 3 decimal
		{10,3}: positive float max 7 digit and 3 decimal
		{null,null}: positive integer
		{10,null}: positive integer max 10 digit
		{null,3}: positive float max 3 decimal
		{-}: positive or negative integer
		{-10}: positive or negative integer max 10 digit
		{-,3}: positive or negative float max 3 decimal
		{-10,3}: positive or negative float max 7 digit and 3 decimal
	*/
	with (event) {
		stopPropagation()
		preventDefault()
		if (!charCode) return
		var c = String.fromCharCode(charCode)
		if (c.match(/[^-\d,]/)) return
		with (target) {
			var txt = value.substring(0, selectionStart) + c + value.substr(selectionEnd)
			var pos = selectionStart + 1
		}
	}

	var dot = count(txt, /\./, pos)
	txt = txt.replace(/[^-\d,]/g, '')

	mask = mask.match(/^(\D*)\{(-)?(\d*|null)?(?:,(\d+|null))?\}(\D*)$/);
	if (!mask) return // meglio exception?
	var sign = !!mask[2],
		decimals = +mask[4],
		integers = Math.max(0, +mask[3] - (decimals || 0))
	if (!txt.match('^' + (!sign ? '' : '-?') + '\\d*' + (!decimals ? '' : '(,\\d*)?') + '$')) return

	txt = txt.split(',')
	if (integers && txt[0] && count(txt[0], /\d/) > integers) return
	if (decimals && txt[1] && txt[1].length > decimals) return
	txt[0] = txt[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.')

	with (event.target) {
		value = mask[1] + txt.join(',') + mask[5]
		selectionStart = selectionEnd = pos + (pos == 1 ? mask[1].length : count(value, /\./, pos) - dot)
	}

	function count(str, c, e) {
		e = e || str.length
		for (var n = 0, i = 0; i < e; i += 1)
			if (str.charAt(i).match(c)) n += 1
		return n
	}
}

function format(e, prefix = 'Rp ', decimals = 2, decimalSeparator = ',', thousandsSeparator = '.') {
	number = parseFloat($(e).val());
	const roundedNumber = number.toFixed(decimals);
	let integerPart = '',
		fractionalPart = '';
	if (decimals == 0) {
		integerPart = roundedNumber;
		decimalSeparator = '';
	} else {
		let numberParts = roundedNumber.split('.');
		integerPart = numberParts[0];
		fractionalPart = numberParts[1];
	}
	integerPart = prefix + integerPart.replace(/(\d)(?=(\d{3})+(?!\d))/g, `$1${thousandsSeparator}`);
	return `${integerPart}${decimalSeparator}${fractionalPart}`;
}

function rupiahtonumber(text) {
	var chars = {
		'.': '',
		',': '.',
		'R': '',
		'p': '',
		' ': ''
	};

	text = text.replace(/[.,Rp ]/g, m => chars[m]);


	return text
}

function formatRupiah(angka, prefix) {
	var reverse = angka.toString().split('').reverse().join(''),
		ribuan = reverse.match(/\d{1,3}/g);
	ribuan = ribuan.join('.').split('').reverse().join('');

	return prefix == undefined ? ribuan : (ribuan ? 'Rp ' + ribuan : '');
}
function tree_sub_kategori(h) {
	no = $('.no-' + h).length;
	$.ajax({
		type: 'get',
		data: {
			'h': h,
			'_view': 'tambah',
			'no': no,
			'id': -1,
			'apps': $('#load_apps').val(),
			'page_view': $('#load_page_view').val(),
			'type': 'tree_sub_kategori',
			'contentfaiframework': 'get_pages',
			"MainAll": 2
		},
		url: $('#load_link_route').val(),
		dataType: 'html',
		success: function (data) {

			$('#tree_sub_kategori-content-' + h).append(data);

		},
		error: function (error) {
			console.log('error; ' + eval(error));

		}
	});

}

// $(document).ready(function(){
// var colorPalette = ["000000", "FF9966", "6699FF", "99FF66", "CC0000", "00CC00", "0000CC", "333333", "0066FF", "FFFFFF"],
// forePalette = $(".fore-palette"),
// backPalette = $(".back-palette"),
// text_editor = $(".text_editor");

//   for (var i = 0; i < colorPalette.length; i++) {
//     forePalette.append("<a href=\"#\" data-command=\"foreColor\" data-value=\"" + "#" + colorPalette[i] + "" style="background-color:" + "#" + colorPalette[i] + ";\" class=\"palette-item\"></a>");
//     backPalette.append("<a href=\"#\" data-command=\"backColor\" data-value=\"" + "#" + colorPalette[i] + "" style="background-color:" + "#" + colorPalette[i] + ";\" class=\"palette-item\"></a>");
//   }
//   $(".toolbar-text_editor a").click(function(e) {
// 		e.preventDefault();
//     var command = $(this).data("command");
//     if (command == "h1" || command == "h2" || command == "p") {
//       document.execCommand("formatBlock", false, command);
//     }
//     if (command == "foreColor" || command == "backColor") {
// 			var color = $(this).data("value");
//       document.execCommand($(this).data("command"), false, color);
//
//     }
// 	if (command == "removeFormat") {
//       document.execCommand("removeFormat", false, command);
//     }
//     if (command == "createlink" || command == "insertimage") {
//       url = prompt("Enter the link here: ", "http:\/\/");
// 			console.log(command + " " + url);
// 			document.execCommand($(this).data("command"), false, url);
//       // document.execCommand($(this).data("command") && "enableObjectResizing", false, url);
//     } else document.execCommand($(this).data("command"), false, url);
//   });
// 	$(".text_editorAria img").click(function(){
//       document.execCommand("enableObjectResizing", false);
// 	});
// 	$("#getHTML").click(function(){
// 		var text_editorId = $(this).attr("get-data");
// 		var html = $("#" + text_editorId).find(".text_editorAria").html();
//
// 	});
// });


