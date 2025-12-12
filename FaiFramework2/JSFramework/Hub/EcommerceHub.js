export async function link_acc_pesanan(button, id_web__apps, id_api, primary_key, id_sync_pesanan, id_apps_user) {
  const parent = button.parentNode;
  const span = document.createElement('span');

  span.textContent = 'Tunggu sebentar...';
  span.className = 'btn btn-warning'; // pakai style tombol
  parent.replaceChild(span, button);

  $.ajax({
    type: 'get',
    data: {
      'contentfaiframework': 'get_pages',
      'frameworksubdomain': window.fai.getModule('domain'),
      'not_sidebar': 'not',
      'MainAll': 2,
      'id': 1,
      'type': 'acc_sync_order',
    },

    url: window.fai.getModule('base_url') + "FaiServer/costum/Ecommerce/acc_sync_order/" + id_web__apps + "/" + id_api + "/" + primary_key + "/" + id_sync_pesanan + "/" + id_apps_user,
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        span.textContent = 'Berhasil di ACC ';
        span.className = 'btn btn-success';
        $('#response_acc_sync_pesanan-' + primary_key).html(JSON.stringify(data.response));
        $('#status_acc_sync_pesanan' + primary_key).html("Berhasil");
      } else {
        span.textContent = 'Gagal, Refresh Page dan coba lagi';
        span.className = 'btn btn-danger';
      }
    },
    error: function (error) {
      span.textContent = 'Gagal, Refresh Page dan coba lagi';
      span.className = 'btn btn-danger';
      alert('error; ' + eval(error));
      console.log('error; ' + eval(error));
      //alert(2);
    }
  });


}
export async function js_delete_cart(id_cart) {
  const isLoggedIn = await await window.fai.getModule('loginHelper').checkLoginStatus();

  if (isLoggedIn) {
    $.ajax({

      type: "post",
      dataType: "html",
      data: { id_cart: id_cart },
      url: window.fai.getModule('base_url') + "api/delete_cart",
      dataType: "json",
      beforeSend: function () {
        // $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar. ',
          allowOutsideClick: false,
          showConfirmButton: false,
          showCloseButton: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (responseData) {

        Swal.close();
        if (responseData.status == 1) {


          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses memproses penghapusan Cart!',
            showConfirmButton: false,
            timer: 1500
          });

          $('#store_cart-' + id_cart).remove();
        } else if (responseData.status == 0) {
          // swal("Gagal!", responseData.keterangan, "error");
          swal("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
          // }
        } else {

          swal("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },


      error: function () {
        Swal.close();
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!',
          showConfirmButton: false,
          timer: 1500
        });

      }
    });
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function link_cancel_pesanan(button, id_web__apps, id_api, primary_key, id_sync_pesanan, id_apps_user) {
  const parent = button.parentNode;
  const span = document.createElement('span');

  span.textContent = 'Tunggu sebentar...';
  span.className = 'btn btn-warning'; // pakai style tombol
  parent.replaceChild(span, button);

  $.ajax({
    type: 'get',
    data: {
      'contentfaiframework': 'get_pages',
      'frameworksubdomain': window.fai.getModule('domain'),
      'not_sidebar': 'not',
      'MainAll': 2,
      'id': 1,
      'type': 'cancel_order',
    },

    url: window.fai.getModule('base_url') + "FaiServer/costum/Ecommerce/cancel_order/" + id_web__apps + "/" + id_api + "/" + primary_key + "/" + id_sync_pesanan + "/" + id_apps_user,
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        span.textContent = 'Berhasil di Cancel Order ';
        span.className = 'btn btn-success';
      } else {
        span.textContent = 'Gagal, Refresh Page dan coba lagi';
        span.className = 'btn btn-danger';
      }
    },
    error: function (error) {
      span.textContent = 'Gagal, Refresh Page dan coba lagi';
      span.className = 'btn btn-danger';
      alert('error; ' + eval(error) + "/" + error);
      console.log('error; ' + eval(error));
      //alert(2);
    }
  });


}
export async function search_produk() {

}
export async function tambah_produk_preorder(button, last_id_utama) {
  const parent = button.parentNode;
  const span = document.createElement('span');

  span.textContent = 'Tunggu sebentar...';
  span.className = 'btn btn-warning'; // pakai style tombol
  parent.replaceChild(span, button);

  $.ajax({
    type: 'get',
    data: {
      'contentfaiframework': 'get_pages',
      'frameworksubdomain': $('#load_domain').val(),
      'not_sidebar': 'not',
      'MainAll': 2,
      'id': 1,
      'type': 'produk_sync',
      'last_id_utama': last_id_utama,
      'searchsync': $('#input_search_sync').val(),
    },
    url: window.fai.getModule('base_url') + "api/produk_sync_preorder",
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        span.textContent = 'Produk sukses ditambahkan';
        span.className = 'btn btn-success';
      } else {
        span.textContent = 'Produk Gagal ditambahkan, refresh dan coba lagi';
        span.className = 'btn btn-danger';
      }
    },
    error: function (error) {
      console.log('error; ' + eval(error));
      //alert(2);
    }
  });

}

export async function tambah_produk(button, last_id_utama) {

  const parent = button.parentNode;
  const span = document.createElement('span');

  span.textContent = 'Tunggu sebentar...';
  span.className = 'btn btn-warning'; // pakai style tombol
  parent.replaceChild(span, button);

  $.ajax({
    type: 'get',
    data: {
      'contentfaiframework': 'get_pages',
      'frameworksubdomain': $('#load_domain').val(),
      'not_sidebar': 'not',
      'MainAll': 2,
      'id': 1,
      'type': 'produk_sync',
      'last_id_utama': last_id_utama,
      'searchsync': $('#input_search_sync').val(),
    },
    url: window.fai.getModule('base_url') + "api/produk_sync",
    dataType: 'json',
    success: function (data) {
      if (data.status) {
        span.textContent = 'Produk sukses ditambahkan';
        span.className = 'btn btn-success';
      } else {
        span.textContent = 'Produk Gagal ditambahkan, refresh dan coba lagi';
        span.className = 'btn btn-danger';
      }
    },
    error: function (error) {
      console.log('error; ' + eval(error));
      //alert(2);
    }
  });


}



export async function list_shipping_alamat() {
  id_user = $("#user_id").val();
  if (id_user) {
    $.ajax({

      type: "get",
      dataType: "html",
      data: {
        "first": link_route,
        "link_route": $("#load_link_route").val(),
        "frameworksubdomain": $("#load_domain").val(),
        "apps": "Ecommerce",
        "page_view": "list_alamat_user",
        "type": "list_alamat_user",
        "id": $("#load_id").val(),
        "id_user": id_user,


        "contentfaiframework": "get_pages",
        "MainAll": 2
      },
      url: link_route,
      dataType: "html",
      success: function (responseData) {
        $("#content_list_cart").html(responseData);


      }
    });
  }
}

export async function list_cart() {
  id_user = $("#user_id").val()
  if (id_user) {
    $.ajax({

      type: "get",
      dataType: "html",
      data: {
        "first": link_route,
        "link_route": $("#load_link_route").val(),
        "frameworksubdomain": $("#load_domain").val(),
        "apps": "Ecommerce",
        "page_view": "list_cart",
        "type": "list_cart",
        "id": $("#load_id").val(),
        "id_user": id_user,


        "contentfaiframework": "get_pages",
        "MainAll": 2
      },
      url: link_route,
      dataType: "html",
      success: function (responseData) {
        $("#content_list_cart").html(responseData);


      }
    });
  }
}



export async function add_cart_by_id(id_asset, id_produk, id_asset_varian, id_produk_varian, id_varian1, id_varian2,
  id_varian3) {
  if ($("#is_login").val() == 0) {
    Swal.fire("Gagal!", "Login Terlebih Dahulu", "error");

  } else if (!$("#user_id").val()) {
    Swal.fire("Gagal!", "Anda belum memilih custumer", "error");

  } else if (parseInt($("#set_qty").val()) > parseInt($("#set_qty").attr("max"))) {
    Swal.fire("Gagal!", "QTY Melebihi Stok", "error");

  } else {
    id_user = $("#user_id").val()
    $.ajax({

      type: "get",
      dataType: "html",
      data: {
        "first": link_route,
        "link_route": $("#load_link_route").val(),
        "frameworksubdomain": $("#load_domain").val(),
        "apps": "Ecommerce",
        "page_view": "add_cart",
        "type": "add_cart",
        "id": $("#load_id").val(),
        "id_user": id_user,
        "id_asset": id_asset,
        "id_produk": id_produk,
        "level": $("#level").val(),
        "id_varian_3": id_varian3,
        "id_varian_2": id_varian2,
        "id_varian_1": id_varian1,
        // "add_qty": 1,
        "id_produk_varian": id_produk_varian,
        "id_asset_varian": id_asset_varian,
        "contentfaiframework": "get_pages",
        "MainAll": 2
      },
      url: link_route,
      dataType: "json",
      success: function (responseData) {

        if (responseData.status) {

          Swal.fire("Sukses!", "Produk sudah masuk kedalam cart!", "success");
          list_cart();
          // if($("#stok_barang").length > 0){
          //   now_stok = $("#stok_barang").val();
          //   now_stok = parseInt(now_stok);
          //   now_stok = now_stok-1;
          //   $("#stok_barang").val(now_stok);
          // }	
        } else
          Swal.fire("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");


      }
    });
  }

}


export async function getHargaSatuan(hargaList, jumlah) {
  for (let i = 0; i < hargaList.length; i++) {
    if (jumlah >= hargaList[i].min) {
      return hargaList[i].harga;
    }
  }
  return 0; // Jika tidak ada harga yang sesuai
}

export async function tambah_produk_indexed_db(id_asset, id_produk, id_asset_varian, id_produk_varian, id_varian1,
  id_varian2, id_varian3, nama, nama_varian, img, harga = 0, hargaList, berat) {
  qtyorder = $("#quantity-" + id_asset + "-" + id_produk + "-" + id_asset_varian + "-" + id_produk_varian +
    "-" + id_varian1 + "-" + id_varian2 + "-" + id_varian3).val();
  //alert("#quantity" + id_asset + "-" + id_produk + "-" + id_asset_varian + "-" + id_produk_varian + "-" +
  // id_varian1 + "-" + id_varian2 + "-" + id_varian3);
  hargaList = [{
    min: 5,
    harga: 12000
  },
  {
    min: 3,
    harga: 15000
  },
  {
    min: 1,
    harga: 20000
  }
  ];
  // alert(qtyorder);
  //   tambahProdukOrder(' . $page['load']['id'] . ', {
  //         id_asset: id_asset,
  //         id_produk: id_produk,
  //         id_asset_varian: id_asset_varian,
  //         id_produk_varian: id_produk_varian,
  //         id_varian1: id_varian1,
  //         id_varian2: id_varian2,
  //         id_varian3: id_varian3,
  //         qty:qtyorder,
  //         nama_barang: nama,
  //         nama_varian:nama_varian,
  //         img:img,
  //         harga:harga,
  //         hargaList:hargaList,
  //         berat:berat,
  //         checked:1

  //     });
}

export async function change_tipe_page() {
  var tipe_page = $("#tipe_page").val()
}




export async function add_cart() {
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    let get_id_varian = $('#max_variasi').val();
    let id_produk = $('#id_produk').val();
    let id_produk_varian = $('#id_produk_varian').val();
    let id_asset = $('#id_asset').val();
    let set_qty = $('#set_qty').val();
    let id_asset_varian = $('#id_asset_varian').val();
    // last_id_varian = $('#varian' + get_id_varian).val();
    let hasil = [null, null, null];
    let selected = document.querySelector('input[name="varian' + get_id_varian + '[]"]:checked');
    let is_produk = false;
    if (parseInt(get_id_varian) == 0) {
      is_produk = true;
    } else {
      if (selected) {
        let last_id_varian = selected.value;
        is_produk = true;
        hasil = last_id_varian.split("-");

      }
    }

    if (!is_produk) {
      Swal.fire("Gagal!", "Pilih Varian terlebih dahulu", "error");

    } else {

      $.ajax({

        type: "get",
        dataType: "html",
        data: {
          "first": $("#load_link_route").val(),
          "link_route": $("#load_link_route").val(),
          "frameworksubdomain": $("#load_domain").val(),
          "apps": "Ecommerce",
          "page_view": "add_cart",
          "type": "add_cart",
          "id": $("#load_id").val(),
          "id_user": isLoggedIn.userId,
          "id_asset": id_asset,
          "id_produk": id_produk,
          "level": $("#level").val(),
          "id_varian_3": hasil[2],
          "id_varian_2": hasil[1],
          "id_varian_1": hasil[0],
          "set_qty": set_qty,
          "id_produk_varian": id_produk_varian,
          "id_asset_varian": id_asset_varian,

        },
        url: window.fai.getModule('base_url') + "api/add_cart",
        dataType: "json",
        beforeSend: function () {

          Swal.fire({
            title: 'Sedang memproses...',
            text: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
        },
        success: function (responseData) {
          Swal.close();
          if (responseData.status == 1) {
            Swal.fire("Sukses!", "Produk sudah masuk kedalam cart!", "success");
          } else if (responseData.status == 0) {
            Swal.fire("Gagal!", responseData.keterangan, "error");
          } else
            Swal.fire("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


        }
      });
    }
    // redirect ke dashboard misalnya
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function proses_checkout_temp(id_cart) {
  $.ajax({

    type: "post",
    dataType: "html",
    data: {

      "id_user": isLoggedIn.userId,
      'id_cart': id_cart,
      'varian_1': varian_1,
      'varian_2': varian_2,
      'varian_3': varian_3,
      'set_qty': qty,
      'checked': $('#bismillah_beli-' + id_cart).is(':checked')

    },
    url: window.fai.getModule('base_url') + "api/proses_checkout",
    dataType: "json",
    beforeSend: function () {
      $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
      Swal.fire({
        title: 'Sedang memproses...',
        text: 'Mohon tunggu sebentar.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    },
    success: function (responseData) {
      Swal.close();
      if (responseData.status == 1) {

        Swal.fire({
          icon: 'success',
          title: 'Sukses!',
          text: 'Sukses menambahkan produk kedalam pesanan!',
          showConfirmButton: false,
          timer: 1500
        });
      } else if (responseData.status == 0) {
        Swal.fire("Gagal!", responseData.keterangan, "error");
        // }	
      } else
        Swal.fire("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


    }
  });

}

export async function initialize_checkout() {
  console.log('INITIAL CHECKOUT');
  let skeletonBilling = `<h5 class="mb-4">Pilih Alamat Penerima<span class="float-right"><button class="btn btn-sm btn-light" id="tambahAlamatPenerima" onclick="tambah_alamat_penerima()"><i class="fa fa-chevron-left mr-2"></i>Tambah</button><button class="btn btn-sm btn-light" id="cancelChangeBilling" onclick="kembali_alamat_penerima_selected()"><i class="fa fa-chevron-left mr-2"></i>Cancel</button></span></h5><div class="list-group" id="content_list_tambah_alamat_penerima"><div class="skeleton" style="height: 120px; background: #f0f0f0; margin-bottom: 10px;"></div><div class="skeleton" style="height: 120px; background: #f0f0f0; margin-bottom: 10px;"></div></div>`;
  let skeletonSelectedBilling = `<div class="float-right"><button class="btn btn-light btn-sm" id="changeBilling" onclick="kembali_alamat_penerima_cari()">Change</button></div><div class="skeleton" style="height: 120px; background: #f0f0f0;"></div>`;
  let skeletonDeliveries = `<h4 class="mb-4 mt-4">Detail Pemesanan Barang</h4><div class="card mb-3"><div class="card-body"><div class="skeleton" style="height: 200px; background: #f0f0f0;"></div></div></div>`;
  let skeletonSummary = `<h4 class="mb-4 mt-3">Rincian Pesanan</h4><div class="card mt-3"><div class="card-body"><div class="skeleton" style="height: 150px; background: #f0f0f0;"></div></div></div>`;
  $('#billingProfileSection').html(skeletonBilling);
  $('#selectedBilling').html(skeletonSelectedBilling);
  $('#deliveries').html(skeletonDeliveries);
  $('.sticky-top').html(skeletonSummary);
  let page = window.fai.getModule("versionContent");

  const storeName = "checkout";
  const search = {
    id_search: page.view.load.load_page_id
  };
  console.log("page", page);
  console.log("id_search", search);

  const allData = await window.fai.getModule('CoreDatabase').getAllFromStore({
    utama: storeName
  }, storeName, search);

  console.log(allData);
  // console.log("DAta Checkout", allData[29]);
  const list_bangunan = JSON.parse(allData.list_bangunan);
  console.log("list_bangunan", list_bangunan);
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  console.log(window.fai.getModule('versionContent'));
  const get_data = page.app.versions.Inventaris_aset.bangunan;
  const last_version = get_data.last_version;
  const bangunan = get_data.versions[last_version];
  bangunan.page.crud.startDiv = `<label class="form-label mb-0 mt-0">
            <span class="form-label-text"><TEXT></TEXT></span>`;
  bangunan.page.crud.endDiv = `</label>
            <span class="help-block text-danger" id="help_<FIELD_NUMBERING></FIELD_NUMBERING>"></span></div></div>`;
  if (!bangunan.page.non_view) {
    bangunan.page.non_view = [];
  }
  bangunan.page.non_view["Tambah"] = {
    "kode_unit": true,
    "deskripsi": true,
    "rt": true,
    "rw": true,
    "nomor_bangunan": true,
    "tipe_unit": true,
    "jumlah_lantai": true,
    "kepemilikan_bangunan": true,
    "keterisian_bangunan": true,
    "fungsi_bangunan": true,
    "tipe_kepemilikan_bangunan": true,
    "blok_tanah": true
  };
  bangunan.page.non_view["Edit"] = {
    "kode_unit": true,
    "deskripsi": true,
    "rt": true,
    "rw": true,
    "nomor_bangunan": true,
    "tipe_unit": true,
    "jumlah_lantai": true,
    "kepemilikan_bangunan": true,
    "keterisian_bangunan": true,
    "fungsi_bangunan": true,
    "tipe_kepemilikan_bangunan": true,
    "blok_tanah": true
  };
  bangunan.page.crud.allCostumClass = "no-form-control form-input";
  // const tableConfig = {
  //   containerId: 'my-table-container',
  //   modalId: 'form-modal',
  //   fieldConfigs: crudSet['array'],
  //   crudSet: crudSet,
  //   apiUrl: "", // Ganti dengan URL API Anda
  //   backendUrl: "{{ env('GOLANG_API_KEY') }}",
  //   api_token: "{{ session('api_token') }}"
  // };
  // await this.crudModule.CrudConfig(tableConfig);
  // this.crudModule.init();
  // parse_form(bangunan.page.crud, bangunan.page, {
  //   function: "submit_tambah_alamat_penerima('form-alamat-penerima')",
  //   class: "login-btn"
  // }, 'form-alamat-penerima', 'tambah', null);



  let temp_bangunan = `
            
            <address class="">
                         <h4><NAMA></NAMA></h4>
                         <p class="mt-2 mb-2"><NAMA-UNIT></NAMA-UNIT><Br><ALAMAT></ALAMAT> <NOMOR></NOMOR> RT <RT></RT>/<RW></RW><br>

                    KEL: <KELURAHAN></KELURAHAN>, KEC: <KECAMATAN></KECAMATAN>,<br>

                    <KOTA-TYPE></KOTA-TYPE> <KOTA></KOTA> <KODE-POS></KODE-POS>,<br>

                    <PROVINSI></PROVINSI>
                    </p>
                    <span><NOMOR-HP></NOMOR-HP></span><br>
                    <span class="fw-semi-bold"><EMAIL></EMAIL></span>
                        </address>
                    `;
  let content_bangunan = "";
  let selected_bangunan = "";
  let content_pengirim = "";
  let selected_pengirim = "";
  const tagnama_unit = "NAMA-UNIT";
  const tagalamat = "ALAMAT";
  const tagnomor = "NOMOR";
  const tagrt = "RT";
  const tagrw = "RW";
  const tagkelurahan = "KELURAHAN";
  const tagkecamatan = "KECAMATAN";
  const tagprovinsi = "PROVINSI";
  const tagkota = "KOTA";
  const tagkota_type = "KOTA-TYPE";
  const tagkodepos = "KODE-POS";
  if (list_bangunan) {
    list_bangunan.forEach(data_bangunan => {
      let get_bangunan = temp_bangunan;

      get_bangunan = get_bangunan.replace(new RegExp(`<${tagnama_unit}></${tagnama_unit}>`, 'gi'),
        data_bangunan.nama_unit_bangunan || '')
        .replace(new RegExp(`<${tagalamat}></${tagalamat}>`, 'gi'), data_bangunan.alamat || '')
        .replace(new RegExp(`<${tagrt}></${tagrt}>`, 'gi'), data_bangunan.rt || '')
        .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
        .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
        .replace(new RegExp(`<${tagkecamatan}></${tagkecamatan}>`, 'gi'), data_bangunan
          .subdistrict_name || '')
        .replace(new RegExp(`<${tagkota}></${tagkota}>`, 'gi'), data_bangunan.city || '')
        .replace(new RegExp(`<${tagkota_type}></${tagkota_type}>`, 'gi'), data_bangunan.type ||
          '')
        .replace(new RegExp(`<${tagkelurahan}></${tagkelurahan}>`, 'gi'), data_bangunan.urban ||
          '')
        .replace(new RegExp(`<${tagnomor}></${tagnomor}>`, 'gi'), data_bangunan
          .nomor_bangunan || '')
        .replace(new RegExp(`<${tagkodepos}></${tagkodepos}>`, 'gi'), data_bangunan
          .postal_code || '')
        .replace(new RegExp(`<${tagprovinsi}></${tagprovinsi}>`, 'gi'), data_bangunan
          .provinsi || '');
      if (selected_pengirim) {

      } else
        if (allData.utama.id_kirim_ke) {
          if (data_bangunan.primary_key2 == allData.utama
            .id_kirim_ke) {
            selected_pengirim = get_bangunan;
          }
        } else if (data_bangunan.default_pembelian_barang == 1) {
          selected_pengirim = get_bangunan;
        }
      // console.log("get_bangunan after",get_bangunan);
      content_pengirim +=
        `<button class="list-group-item text-left billingProfile" onclick="add_selected_bangunan(this,${data_bangunan.primary_key2})">` +
        get_bangunan + `</button>`;
    });
  }
  let ekspedisi = await window.fai.getModule('CoreDatabase').getAllFromStore({
    "select": ["store__toko__ekspedisi.id,id_service,webmaster__ekspedisi.id as id_ekspedisi,nama_service,kode_service,kode_ekspedisi,nama_ekspedisi"],
    utama: "store__toko__ekspedisi",
    "join": [
      ["webmaster__ekspedisi__service", "webmaster__ekspedisi__service.id", "id_service", "left"],
      ["webmaster__ekspedisi", "webmaster__ekspedisi.id", "webmaster__ekspedisi__service.id_webmaster__ekspedisi", "left"]
    ],
    "where": [
      ["store__toko__ekspedisi.active", "=", "1"],
    ]
  }, "webmaster__ekspedisi", { "live": 2 });
  console.log("ongkir eskpedisi ", ekspedisi);
  const dropship = await window.fai.getModule('CoreDatabase').getAllFromStore({
    "utama": "store__toko__user",
    "join": [
      ["store__toko", "store__toko.id", "store__toko__user.id_store_toko", "left"]
    ],
    "where": [
      ["id_apps_user", "=", "'" + isLoggedIn.userId + "'"],
      ["is_dropship_toko", "=", "1"],
    ]
  },
    "store__toko__user", {
    id_apps_user: isLoggedIn.userId,
    live: 2,
    database: {
      "utama": "store__toko__user",
      "join": [
        ["store__toko", "store__toko.id", "store__toko__user.id_store_toko", "left"]
      ],
      "where": [
        ["id_app_user", "=", "'" + isLoggedIn.userId + "'"],
        ["is_dropship_toko", "=", "1"],
      ]
    }
  });
  // console.log("dropship", dropship);
  let list_dropship = (dropship.row);

  // console.log("dropship s", list_dropship);
  let content_list_toko_dropship;
  content_list_toko_dropship = "";
  if (list_dropship) {
    list_dropship.forEach(data_dropship => {
      content_list_toko_dropship += `<div class="col-md-12 mt-3 card" id="">
                    <div class="row">
                        <div class="col-2" style="align-items: center;justify-content: center;display: flex;">
                            <label class="form-check">
                                <input
                                    type="radio"
                                    style="border:1px solid black"
                                    name="dropship_toko"
                                    class="form-check-input  dropship_toko"
                                    value="${data_dropship.id_store_toko}"

                                >
                            </label>
                        </div>
                        <div class=" col-7 cart__product__item p-2">
                            <div class="cart__product__item__title">
                                <h6>${data_dropship.nama_toko} </h6>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
  }
  let content_dropship = `
             <div class="card card-body">
    <h4 class="mb-4 mt-4">Tipe Pemesanan</h4>
    <div class="col-md-12 mt-3 card" id="store_cart-12">
        <div class="row">
            <div class="col-2" style="align-items: center;justify-content: center;display: flex;">
                <label class="form-check">
                    <input
                        type="radio"
                        style="border:1px solid black"
                        name="tipe_pemesanan"
                        id="bismillah_beli-12"
                        class="form-check-input tipe_pemesanan"
                        value="dropship-ecommerce"
                        onclick="change_tipe_pemesanan();"
                    >
                </label>
            </div>
            <div class=" col-7 cart__product__item p-2">
                <div class="cart__product__item__title">
                    <h6>Pemesanan Dropship Ecommerce</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 card d-none" id="">
        <div class="row">
            <div class="col-2" style="align-items: center;justify-content: center;display: flex;">
                <label class="form-check">
                    <input
                        type="radio"
                        style="border:1px solid black"
                        name="tipe_pemesanan"
                        id="bismillah_beli-12"
                        class="form-check-input  tipe_pemesanan"
                        value="dropship-non-ecommerce"
                        onclick="change_tipe_pemesanan();"
                    >
                </label>
            </div>
            <div class=" col-7 cart__product__item p-2">
                <div class="cart__product__item__title">
                    <h6>Pemesanan Dropship Non Ecommerce</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 card" id="store_cart-12">
        <div class="row">
            <div class="col-2" style="align-items: center;justify-content: center;display: flex;">
                <label class="form-check">
                    <input
                        type="radio"
                        style="border:1px solid black"
                        name="tipe_pemesanan"
                        id="bismillah_beli-12"
                        class="form-check-input  tipe_pemesanan"
                        value="reguler"
                        onclick="change_tipe_pemesanan();"
                    >
                </label>
            </div>
            <div class=" col-7 cart__product__item p-2">
                <div class="cart__product__item__title">
                    <h6>Pemesanan Reguler</h6>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="pesanan-dropship" class="card card-body mt-3" style="display:none">
    <h4 class="mb-4 mt-4"> Toko Dropship</h4>
    <h5 class="mb-4">Pilih Nama Toko
        <span class="float-right">
            <button class="btn btn-sm btn-light" id="tambahAlamatpengirim" onclick="tambah_toko_dropship()">
                <i class="fa fa-plus mr-2"></i>Tambah
            </button>

        </span>
    </h5>
    ` + content_list_toko_dropship + `


</div>
<div id="pesanan-ecomerce" class="card card-body mt-3" style="display:none">
    <h4 class="mb-4 mt-4"> Pemesanan Dropship Ecommerce</h4>
    <div class="form-group">
        <label>Nomor Resi</label>
        <input
            type="text"
            id="nomor_resi_ecommerce"
            placeholder="Nomor Resi"
            class="form-control"
        >
    </div>
    <div class="form-group">
        <label>Ekspedisi & Service</label>
        <input
            type="text"
            id="ekspedisi_ecommerce"
            placeholder="Ekspedisi"
            class="form-control"
        >
    </div>
    <div class="form-group d-none">
        <label>Service</label>
        <input
            type="text"
            id="service_ecommerce"
            placeholder="Srvice"
            class="form-control"
        >
    </div>
    <div class="form-group  d-none">
        <label>Platform Ecommerce</label>
        <select
            type="text"
            id="plaform_ecommerce"
            placeholder="Platform Ecommerce"
            class="form-control"
        >
            <option value="">- Pilih Ecommerce -</option>
            <option value="Shopee">Shopee</option>
            <option value="Tiktok">Tiktok</option>
            <option value="Tokopedia">Tokopedia</option>
            <option value="Lazada">Lazada</option>
            <option value="Bli Bli">Bli Bli</option>
            <option value="WooCommerce">WooCommerce</option>
            <option value="Shopify">Shopify</option>
        </select>
    </div>
    <div class="form-group">
        <label>File Resi Ecommerce</label>
        <input
            type="file"
            id="file_resi_ecommerce"
            placeholder="Ekspedisi"
            class="form-control"
        >
    </div>
</div>



    `;
  temp_bangunan = `

            <address class="">
                         <h4><NAMA></NAMA></h4>
                         <p class="mt-2 mb-2"><NAMA-UNIT></NAMA-UNIT><Br><ALAMAT></ALAMAT> <NOMOR></NOMOR> RT <RT></RT>/<RW></RW><br>

                    KEL: <KELURAHAN></KELURAHAN>, KEC: <KECAMATAN></KECAMATAN>,<br>

                    <KOTA-TYPE></KOTA-TYPE> <KOTA></KOTA> <KODE-POS></KODE-POS>,<br>

                    <PROVINSI></PROVINSI>
                    </p>
                    <span><NOMOR-HP></NOMOR-HP></span><br>
                    <span class="fw-semi-bold"><EMAIL></EMAIL></span>
                        </address>
                    `;


  let id_selected = 0;
  if (list_bangunan) {
    list_bangunan.forEach(data_bangunan => {
      let get_bangunan = temp_bangunan;

      console.log("data_bangunan", data_bangunan);
      get_bangunan = get_bangunan.replace(new RegExp(`<${tagnama_unit}></${tagnama_unit}>`, 'gi'), data_bangunan.nama_unit_bangunan || '')
        .replace(new RegExp(`<${tagalamat}></${tagalamat}>`, 'gi'), data_bangunan.alamat || '')
        .replace(new RegExp(`<${tagrt}></${tagrt}>`, 'gi'), data_bangunan.rt || '')
        .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
        .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
        .replace(new RegExp(`<${tagkecamatan}></${tagkecamatan}>`, 'gi'), data_bangunan.subdistrict_name || '')
        .replace(new RegExp(`<${tagkota}></${tagkota}>`, 'gi'), data_bangunan.city || '')
        .replace(new RegExp(`<${tagkota_type}></${tagkota_type}>`, 'gi'), data_bangunan.type || '')
        .replace(new RegExp(`<${tagkelurahan}></${tagkelurahan}>`, 'gi'), data_bangunan.urban || '')
        .replace(new RegExp(`<${tagnomor}></${tagnomor}>`, 'gi'), data_bangunan.nomor_bangunan || '')
        .replace(new RegExp(`<${tagkodepos}></${tagkodepos}>`, 'gi'), data_bangunan.postal_code || '')
        .replace(new RegExp(`<${tagprovinsi}></${tagprovinsi}>`, 'gi'), data_bangunan.provinsi || '');
      if (selected_bangunan) {

      } else
        if (allData.utama.id_kirim_ke) {
          if (data_bangunan.id_kirim == allData.utama.id_kirim_ke) {
            selected_bangunan = get_bangunan;
          }
        } else if (data_bangunan.default_pembelian_barang == 1) {
          selected_bangunan = get_bangunan;
        }
      // console.log("get_bangunan after",get_bangunan);      
      content_bangunan += `<button class="list-group-item text-left billingProfile" onclick="add_selected_bangunan(this,${data_bangunan.primary_key2})">` + get_bangunan + `</button>`;
    });
  }
  console.log("content_bangunan", content_bangunan);
  $('#billingProfileSection').html(`<h5 class="mb-4">Pilih Alamat Penerima<span class="float-right">
                <button class="btn btn-sm btn-light" id="tambahAlamatPenerima" onclick="tambah_alamat_penerima()"><i class="fa fa-chevron-left mr-2"></i>Tambah</button>
                <button class="btn btn-sm btn-light" id="cancelChangeBilling" onclick="kembali_alamat_penerima_selected()"><i class="fa fa-chevron-left mr-2"></i>Cancel</button>
                </span></h5>
                    
                    <div class="list-group" id="content_list_tambah_alamat_penerima">` + content_bangunan + `</div>
                    
                </div>`);

  $('#selectedBilling').html(`<div class="float-right">
                                    <button class="btn btn-light btn-sm" id="changeBilling" onclick="kembali_alamat_penerima_cari()">Change</button>
                                </div>` + selected_bangunan);
  if (!$('#id_kirim_ke').length) {

    $('#billingSection').before(`
                <input type="hidden" id="id_kirim_ke" value="${id_selected}">
                `);

  }
  const list_toko = JSON.parse(allData.list_toko);
  const list_produk = JSON.parse(allData.list_produk);
  console.log("list_toko", list_toko);
  let content_toko = "";
  let total_qty = 0;
  let total_grand = 0;

  if (list_produk) {
    for (let data_toko of list_toko) {
      console.log("data_toko", data_toko);
      let get_toko = `<div class="card mb-3">
                <div class="card-body">
                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column" style="padding-right: 30px;">
                        <h4 class="mb-1">
                        ${data_toko.nama_toko}
                        </h4>
                        <span class="mb-3">
                            Pengirimin dari   </span>
                    `;
      if (list_produk) {
        for (let data_produk of list_produk) {
          if (data_produk.id_toko = data_toko.id_toko) {
            console.log("data_produk", data_produk);
            get_toko += `
                        <div class="col-md-12 mt-3 m-3 card" id="store_cart-9">
                            <div class="row m-3">
                                <div class="col-1 cart__product__item">
                                    <div style="margin: 10px 0;border-radius: 100%;" id="image_cart-9">
                                        <img src="${data_produk.foto_aset_varian ?? data_produk.foto_aset}">
                                    </div>
                                </div>
                                <div class=" col-7 cart__product__item p-2">

                                    <input type="hidden" id="is_varian-9" value="1">
                                    <input type="hidden" id="max_varian-9" value="<MAX_VARIAN></MAX_VARIAN>">


                                    <div class="cart__product__item__title">
                                        <h6>${data_produk.nama_barang}</h6>
                                        Varian : ${data_produk.nama_varian}
                                        
                                        <input class="cart__price" id="stok-val9" value="1" type="hidden">

                                    </div>
                                    <div class="cart__quantity">
                                       Qty : ${data_produk.qty_pesanan}
                                    </div>
                                    <div class="cart__total"><span id="view-harga-9">
                                       Total:     ${await formatRupiah(data_produk.grand_total)}
                                        </span></div>

                                </div>
                                <div class="col-md-1">

                                </div>
                            </div>
                           
                        </div>
                        `;
            total_qty += data_produk.qty_pesanan;
            total_grand += data_produk.grand_total;
          }
        };
      }
      get_toko += `</div></div>
                <div  id="pilih-ongkir-${data_toko.id_toko}" style="padding:20px;background:#fafafa;font-size: 18px;font-weight: bold;color: black;">`;
      Object.entries(ekspedisi).forEach(([keyE, data_ekspedisi]) => {

        const harga_ongkir = 0;
        console.log("data_ekspedisi", data_ekspedisi);
        get_toko += `

                    <div class="card card-bordered shadow-none mb-2">
                        <div class="card-body">
                            <div class="d-flex  align-items-center w-100">
                            <div class="form-check">
                                                <input class="form-check-input" type="radio"  name="pilih_ongkir-${data_toko.id_toko}"   value="${data_ekspedisi.kode_ekspedisi}-${data_ekspedisi.kode_service}-${data_ekspedisi.id_ekspedisi}-${data_ekspedisi.id_service}-${data_ekspedisi.nama_service}-${harga_ongkir}"data-gtm-form-interact-field-id="2" style="border: 2px solid black;">
                                                <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                                </label>
                                </div>
                                <div >
                                    <h5 class="mb-1"> ${data_ekspedisi.nama_ekspedisi} ${data_ekspedisi.nama_service} </h5>
                                    <span class="fs-6"> Estimasi kirim  ~ Hari</span>
                                </div>
                                <div display="text-align: right;flex: max-content;">
                                    <h3 class="mb-0">Rp . 0
                                    <input type="hidden" class="ongkir_terpilih" value="0">
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
      });
      get_toko += `
				 <button class="btn btn-primary btn-sm"  type="button" onclick="get_ubah_ongkir(${data_toko.id_toko})">Pilih</button>
                </div>
                <input  id="ekspedisi-${data_toko.id_toko}" value="25" type="hidden">
                <input  id="service-${data_toko.id_toko}" value="50" type="hidden">
                <input  id="paket_ongkir-${data_toko.id_toko}" value="" type="hidden">
                <input  id="ongkir-${data_toko.id_toko}" value="0" class="ongkir" type="hidden">
                <input  class="all_store" value="${data_toko.id_toko}" type="hidden">
                <div class="pilih_ongkir" style="padding:20px;background:#fafafa;font-size: 18px;font-weight: bold;color: black;" onclick="show_ongkir(${data_toko.id_toko})";>
                <div id="text-selected-ongkir-${data_toko.id_toko}">Pilih Ongkir</div>
                <span class="float-right">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </span>
                </div>

                </div>`;
      content_toko += get_toko;
    }
  };
  $('#choosen_penerima').html(content_dropship);
  $('#deliveries').html(` <h4 class="mb-4 mt-4">Detail Pemesanan Barang</h4>` + content_toko);
  // let allData = await getAllFromStore(db, {
  //     utama: storeName
  // }, storeName,search);
  let summary = `<h4 class="mb-4 mt-3">Rincian Pesanan</h4>
             <div class="card mt-3">
             <div class="card-body">
             
             <div id="detail-order">
                
                <ul class="list-unstyled mb-0">
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> QTY Produk </span>
                <span>${await formatRupiah(total_qty, '')} pcs </span>
                
                </li>
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> Grand Total</span>
                <span>${await formatRupiah(total_grand)}</span>
                
                </li>
                </div>
                <button class="btn-primary btn" onclick="proses_payment()" type="button">Pembayaran</button>
                </div>
                </div>`;
  $('.sticky-top').html(summary);

}

export async function show_ongkir(id_toko) {
  $('#store-ongkir-' + id_toko).hide();
  $('#pilih-ongkir-' + id_toko).show();
}
export async function get_ubah_ongkir(id_toko) {
  $('#store-ongkir-' + id_toko).show();
  $('#pilih-ongkir-' + id_toko).hide();
  let selectedValue = document.querySelector(`input[name="pilih_ongkir-${id_toko}"]:checked`)?.value;

  let [kurir, layanan, id_ekspedisi, id_service, nama_service, harga_serice] = selectedValue.split("-");
  $('#ekspedisi-' + id_toko).val(id_ekspedisi);
  $('#service-' + id_toko).val(id_service);
  $('#paket_ongkir-' + id_toko).val(kurir + "-" + layanan);
  $('#text-selected-ongkir-' + id_toko).html(`
      <span >
                                    <span class="mb-1" style="font-size: 15px;text-transform: uppercase;"> ${kurir} ${nama_service} </span>
                                    <br>
                                    <span class=" style="font-size: 12px;">  Estimasi kirim  ~ Hari</span>
                                    <br>
                                    <span class="mb-0" style="font-size: 12px;">Rp . ${harga_serice}
                                    </span>
                                </span>
                                
    `);


}

export async function change_tipe_pemesanan() {
  $('.tipe_pemesanan').each(function () {
    if ($(this).is(':checked')) {
      if ($(this).val() == 'dropship-ecommerce') {
        $('#pesanan-ecomerce').show();
        $('#pesanan-dropship').hide();
        $('#billingSection').hide();
      } else if ($(this).val() == 'dropship-non-ecommerce') {
        $('#pesanan-ecomerce').hide();
        $('#pesanan-dropship').show();

        $('#billingSection').hide();
      } else {
        $('#pesanan-ecomerce').hide();
        $('#pesanan-dropship').hide();
        $('#billingSection').show();

      }
    }
  });
}
export function validateOngkir() {
  // pilih radio yg name diawali "pilih_ongkir"
  const radios = document.querySelectorAll('input[type="radio"][name^="pilih_ongkir"]');

  // cek apakah ada yg checked
  const selected = Array.from(radios).some(r => r.checked);
  console.log(selected);
  if (!selected) {
    alert("Silakan pilih salah satu ongkir!");
    return false;
  }

  return true;
}
export async function proses_bayar(confirm = 0) {
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  let brand_pembayaran = $("#brand-pembayaran").val();;
  let biaya_payment_user = $("#biaya_payment_user").val();;
  let biaya_payment_system = $("#biaya_payment_system").val();;
  let page = window.fai.getModule("versionContent");


  let load_page_id = page.view.load.load_page_id
  let checkout_id = load_page_id;
  if (!brand_pembayaran) {
    alert("Pilih Pembayaran telebih dahulu");
  } else if (isLoggedIn) {
    $.ajax({

      type: "post",
      dataType: "html",
      data: {

        "id_user": isLoggedIn.userId,

        'checkout_id': checkout_id,
        'brand_pembayaran': brand_pembayaran,
        'biaya_payment_system': biaya_payment_system,
        'biaya_payment_user': biaya_payment_user,
      },
      url: window.fai.getModule('base_url') + "api/proses_bayar",
      dataType: "json",
      beforeSend: function () {
        // $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar. ',
          allowOutsideClick: false,
          showConfirmButton: false,
          showCloseButton: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (responseData) {

        Swal.close();
        if (responseData.status == 1) {


          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses memproses pesanan!',
            showConfirmButton: false,
            timer: 1500
          });

          const data = [{
            object: 'foreach_1_row'
          }];
          const type = {
            0: "Ecommerce",
            1: "bayar",
            2: "view_layout",
            3: responseData.id,
          };
          console.log(type);
          const encoded = btoa(JSON.stringify(type));
          // content.content.html = "javascript:void(link_direct('" + enPage + "','" + encoded + "'))";
          link_direct(encoded);
        } else if (responseData.status == 0) {
          // swal("Gagal!", responseData.keterangan, "error");
          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
          // }
        } else {

          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },


      error: function () {
        Swal.close();
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!',
          showConfirmButton: false,
          timer: 1500
        });

      }
      // success: function(responseData) {
      // Swal.close();
      // if (responseData.status == 1) {

      //

      // } else if (responseData.status == 0) {
      //     swal("Gagal!", responseData.keterangan, "error");
      //     // }
      // } else
      //     swal("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


      // }
    });
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function proses_cek_bayar(confirm = 0) {
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  let page = window.fai.getModule("versionContent");


  let load_page_id = page.view.load.load_page_id
  let checkout_id = load_page_id;
  const formData = new FormData();

  // Ambil nilai input
  formData.append('id_user', isLoggedIn.userId);
  formData.append('checkout_id', checkout_id);
  let status_push = true;
  $('.collect_id').each(function () {
    const id = $(this).val(); // Ambil ID unik

    const bank = $('#konfirm_bayar-bank-' + id).val();
    const an = $('#konfirm_bayar-an-' + id).val();
    const norek = $('#konfirm_bayar-norek-' + id).val();
    const tanggal = $('#konfirm_bayar-tanggal-' + id).val();
    const nominal = $('#konfirm_bayar-nominal-' + id).val();

    formData.append(`bank[${id}]`, bank);
    formData.append(`an[${id}]`, an);
    formData.append(`norek[${id}]`, norek);
    formData.append(`tanggal[${id}]`, tanggal);
    formData.append(`nominal[${id}]`, nominal);

    const fileInput = document.getElementById('konfirm_bayar-file-' + id);
    if (fileInput && fileInput.files.length > 0) {
      formData.append(`file[${id}]`, fileInput.files[0]);
    } else {
      status_push = false;
    }

    if (!bank.trim() || !an.trim() || !norek.trim() || !tanggal.trim() || !nominal.trim()) {
      status_push = false;
    }
  });
  if(!status_push){
       Swal.fire("Gagal!",
              "Terdapat Field yang kosong!",
              "error");
  }else
  if (isLoggedIn) {
    $.ajax({

      type: "post",
      dataType: "html",
      data: formData,
      contentType: false,
      processData: false,
      url: window.fai.getModule('base_url') + "api/proses_cek_bayar",
      dataType: "json",
      beforeSend: function () {
        // $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar. ',
          allowOutsideClick: false,
          showConfirmButton: false,
          showCloseButton: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (responseData) {

        Swal.close();
        if (responseData.status == 1) {


          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses memproses pembayaran!',
            showConfirmButton: false,
            timer: 1500
          });

          const data = [{
            object: 'foreach_1_row'
          }];
          const type = {
            0: "Ecommerce",
            1: "sukses_bayar",
            2: "view_layout",
            3: checkout_id,
          };
          console.log(type);
          const encoded = btoa(JSON.stringify(type));
          // content.content.html = "javascript:void(link_direct('" + enPage + "','" + encoded + "'))";
          link_direct(encoded);
        } else if (responseData.status == 0) {
          // swal("Gagal!", responseData.keterangan, "error");
          if (responseData.send_order[0].response.status === undefined) {


            Swal.fire("Gagal!",
              "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
              "error");
          } else {
            if (responseData.send_order[0].response.status == 'keranjang tidak ditemukan') {
              Swal.fire("Gagal!",
                responseData.send_order[0].response.status + ", lakukan order ulang karena cart lebih dari 1 hari/jam 12 malam",
                "error");
            } else {

              Swal.fire("Gagal!",
                responseData.send_order[0].response.status + "",
                "error");
            }
          }
          // }
        } else {

          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },


      error: function () {
        Swal.close();
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!',
          showConfirmButton: false,
          timer: 1500
        });

      }
    });
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function proses_payment(confirm = 0) {

  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  let tipe_pemesanan = $(".tipe_pemesanan:checked").val();;
  let page = window.fai.getModule("versionContent");


  let load_page_id = page.view.load.load_page_id
  let checkout_id = load_page_id;
  // let dropship_toko = $(".dropship_toko:checked").val();;
  // let nomor_resi_ecommerce = $("#nomor_resi_ecommerce").val();;
  // let ekspedisi_ecommerce = $("#ekspedisi_ecommerce").val();;
  // let service_ecommerce = $("#service_ecommerce").val();;
  // let plaform_ecommerce = $("#plaform_ecommerce").val();;
  // let file_resi_ecommerce = $("#file_resi_ecommerce").val();;
  // let penerima = $("#id_kirim_ke").val();;
  let formData = new FormData();

  // Tambahkan data biasa
  formData.append("id_user", isLoggedIn.userId);
  formData.append("checkout_id", checkout_id);
  formData.append("confirm", confirm);
  formData.append("penerima", $("#id_kirim_ke").val());
  formData.append("tipe_pemesanan", $(".tipe_pemesanan:checked").val());
  formData.append("dropship_toko", $(".dropship_toko:checked").val());
  formData.append("nomor_resi_ecommerce", $("#nomor_resi_ecommerce").val());
  formData.append("ekspedisi_ecommerce", $("#ekspedisi_ecommerce").val());
  formData.append("service_ecommerce", $("#service_ecommerce").val());
  formData.append("plaform_ecommerce", $("#plaform_ecommerce").val());

  // Tambahkan file
  let file = $("#file_resi_ecommerce")[0].files[0]; // ambil File object
  if (file) {
    formData.append("file_resi_ecommerce", file);
  }

  // Tambahkan ongkir (objek array), serialize dulu

  let ongkir = {};
  let isDefult = true;
  $('.all_store').each(function () {
    const storeId = $(this).val();

    ongkir[storeId] = {
      ekspedisi: $('#ekspedisi-' + storeId).val(),
      service: $('#service-' + storeId).val(),
      paket_ongkir: $('#paket_ongkir-' + storeId).val(),
      ongkir: $('#ongkir-' + storeId).val()
    };
    if (!$('#paket_ongkir-' + storeId).val()) {
      isDefult = false
    }
  });
  formData.append("ongkir", JSON.stringify(ongkir)); // kamu bisa refactor `getOngkirObject()` dari loop yg sudah kamu buat

  if (!validateOngkir()) {

  } else if (tipe_pemesanan === undefined) {
    alert("Pilih tipe pemesanan dulu!");
  } else if (tipe_pemesanan == 'reguler' && (!$("#id_kirim_ke").val())) {
    alert("Pilih alamat penerima!");
  } else if (isLoggedIn) {
    let send_cart_proses = [];



    $.ajax({

      type: "post",
      dataType: "html",
      data: formData,
      contentType: false,
      processData: false,
      // data: {

      //     "id_user": isLoggedIn.userId,

      //     'checkout_id': checkout_id,
      //     'confirm': confirm,
      //     'penerima': penerima,
      //     'tipe_pemesanan': tipe_pemesanan,
      //     'ongkir': ongkir,
      //     dropship_toko: dropship_toko,
      //     nomor_resi_ecommerce: nomor_resi_ecommerce,
      //     ekspedisi_ecommerce: ekspedisi_ecommerce,
      //     service_ecommerce: service_ecommerce,
      //     plaform_ecommerce: plaform_ecommerce,
      //     file_resi_ecommerce: file_resi_ecommerce,

      // },
      url: window.fai.getModule('base_url') + "api/proses_payment",
      dataType: "json",
      beforeSend: function () {
        // $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar. ',
          allowOutsideClick: false,
          showConfirmButton: false,
          showCloseButton: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (responseData) {

        Swal.close();
        if (responseData.status == 1) {

          $('#summary').html(responseData.print_summary);
          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses menambahkan produk kedalam pesanan!',
            showConfirmButton: false,
            timer: 1500
          });

          const data = [{
            object: 'foreach_1_row'
          }];


          const type = {
            0: "Ecommerce",
            1: "payment",
            2: "view_layout",
            3: load_page_id,
          };

          const encoded = btoa(JSON.stringify(type));
          console.log(encoded);

          // content.content.html = "javascript:void(link_direct('" + enPage + "','" + encoded + "'))";
          link_direct(encoded);
        } else if (responseData.status == 0) {
          // swal("Gagal!", responseData.keterangan, "error");
          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
          // }
        } else {

          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },


      error: function () {
        Swal.close();
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!',
          showConfirmButton: false,
          timer: 1500
        });

      }
      // success: function(responseData) {
      // Swal.close();
      // if (responseData.status == 1) {

      //

      // } else if (responseData.status == 0) {
      //     swal("Gagal!", responseData.keterangan, "error");
      //     // }
      // } else
      //     swal("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


      // }
    });
  } else {
    console.log("Belum login");
    open_login();
  }

}
export async function varian_list(parsed, tipe, variasi, json) {
  let html = "";
  let original = (parsed.list_varian[tipe].detail);
  const uniqueArray = Object.values(original).filter((item, index, self) =>
    index === self.findIndex(obj => obj.nama_varian === item.nama_varian)
  );


  // Jika kamu ingin hasil akhirnya kembali jadi object dengan index baru:
  let uniqueObject = Object.fromEntries(uniqueArray.map((item, i) => [i, item]));
  let sortedArray = await sortData(Object.values(uniqueObject));
  console.log(sortedArray);
  // Langkah ketiga: Jika perlu mengonversi kembali ke objek, bisa lakukan:
  let sortedObject = Object.fromEntries(sortedArray.map((item, i) => [i, item]));

  console.log(sortedObject);
  console.log(uniqueObject);
  let dis = "";
  if (variasi == 2) {
    dis = "disabled";
  }
  if (variasi == 3) {
    dis = "disabled";
  }

  html += '<div class="col-4"> <label>' + parsed.nama_variasi[variasi] + '</label></div>';
  html += '<div class="col-8" id="variasi-content-' + variasi + '">';
  html += '<div class="form-selectgroup  mt-3">';
  Object.values(sortedObject).forEach(item => {
    html += `
                    <label class="form-selectgroup-item">
                    <input type="radio" ${dis}  name="varian` + variasi + `[]" id="varian` + variasi + `" value="${item.id_varian}" 
                        class="form-selectgroup-input" onclick="change_variasi(${variasi},'${item.id_varian}','${json}',this);">
                    <span class="form-selectgroup-label">${item.nama_varian}</span>
                    </label>
                `;
  });
  html += '</div>';
  html += '</div>';
  return html;
}

export async function submit_tambah_alamat_penerima(formId) {

  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    console.log(formId);
    //const form = $('#'+formId)[0];
    const form = document.getElementById("form-alamat-penerima");

    if (!form || form.tagName !== "FORM") {
      console.error("Form not valid");
    } else {
      const formData = new FormData(form); // native FormData
      formData.append("id_user", isLoggedIn.userId);
      console.log(formData);
      formData.append("A", "Inventaris_aset");
      formData.append("F", "bangunan");
      formData.append("T", "save");
      formData.append("T", "save");

      $('#alamat-penerima-container').hide();
      document.body.classList.remove("blurred");
      $.ajax({
        processData: false,
        contentType: false,
        type: "post",
        dataType: "json",
        headers: { // gunakan "headers", bukan "header"
          "Authorization": "",
          "Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
          "apps": btoa(JSON.stringify({
            "apps": "Inventaris_aset",
            "page_view": "bangunan",
            "load_type": "save",
            "load_page_id": -1
          }))
        },
        data: formData,
        url: window.fai.getModule('base_url') + "api/crud",
        dataType: "json",
        beforeSend: function () {
          $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
          Swal.fire({
            title: 'Sedang memproses...',
            text: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            showConfirmButton: false,
            showCloseButton: true,
            didOpen: () => {
              Swal.showLoading();
            }
          });
        },
        success: function (responseData) {
          Swal.close();
          if (responseData.status == 1 || responseData.last_insert_id) {
            send_id_rumah_pengisi(isLoggedIn.userId, responseData.last_insert_id, responseData);
          } else if (responseData.status == 0) {
            Swal.fire("Gagal!", responseData.keterangan, "error");
            // }
          } else
            Swal.fire("Gagal!",
              "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error"
            );


        }
      });
    }
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function send_id_rumah_pengisi(id_user, id_bangunan, data) {
  $.ajax({

    type: "post",
    dataType: "json",
    data: {
      id_user: id_user,
      id_bangunan: id_bangunan
    },
    url: window.fai.getModule('base_url') + "api/add_rumah_pengisi",
    dataType: "json",
    beforeSend: function () {
      $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
      Swal.fire({
        title: 'Sedang memproses...',
        text: 'Mohon tunggu sebentar.',
        allowOutsideClick: false,
        showConfirmButton: false,
        showCloseButton: true,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    },
    success: function (responseData) {
      Swal.close();
      if (responseData.status == 1) {
        let temp_bangunan = `

                                <address class="">
                                            <h4><NAMA></NAMA></h4>
                                            <p class="mt-2 mb-2"><NAMA-UNIT></NAMA-UNIT><Br><ALAMAT></ALAMAT> <NOMOR></NOMOR> RT <RT></RT>/<RW></RW><br>

                                        KEL: <KELURAHAN></KELURAHAN>, KEC: <KECAMATAN></KECAMATAN>,<br>

                                        <KOTA-TYPE></KOTA-TYPE> <KOTA></KOTA> <KODE-POS></KODE-POS>,<br>

                                        <PROVINSI></PROVINSI>
                                        </p>
                                        <span><NOMOR-HP></NOMOR-HP></span><br>
                                        <span class="fw-semi-bold"><EMAIL></EMAIL></span>
                                            </address>
                                        `;
        const tagnama_unit = "NAMA-UNIT";
        const tagalamat = "ALAMAT";
        const tagnomor = "NOMOR";
        const tagrt = "RT";
        const tagrw = "RW";
        const tagkelurahan = "KELURAHAN";
        const tagkecamatan = "KECAMATAN";
        const tagprovinsi = "PROVINSI";
        const tagkota = "KOTA";
        const tagkota_type = "KOTA-TYPE";
        const tagkodepos = "KODE-POS";
        let data_bangunan = data.sqli;
        let get_bangunan = temp_bangunan;

        get_bangunan = get_bangunan.replace(new RegExp(`<${tagnama_unit}></${tagnama_unit}>`, 'gi'),
          data_bangunan.nama_unit_bangunan || '')
          .replace(new RegExp(`<${tagalamat}></${tagalamat}>`, 'gi'), data_bangunan.alamat || '')
          .replace(new RegExp(`<${tagrt}></${tagrt}>`, 'gi'), data_bangunan.rt || '')
          .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
          .replace(new RegExp(`<${tagrw}></${tagrw}>`, 'gi'), data_bangunan.rw || '')
          .replace(new RegExp(`<${tagkecamatan}></${tagkecamatan}>`, 'gi'), data_bangunan
            .subdistrict_name || '')
          .replace(new RegExp(`<${tagkota}></${tagkota}>`, 'gi'), data_bangunan.city || '')
          .replace(new RegExp(`<${tagkota_type}></${tagkota_type}>`, 'gi'), data_bangunan.type ||
            '')
          .replace(new RegExp(`<${tagkelurahan}></${tagkelurahan}>`, 'gi'), data_bangunan.urban ||
            '')
          .replace(new RegExp(`<${tagnomor}></${tagnomor}>`, 'gi'), data_bangunan
            .nomor_bangunan || '')
          .replace(new RegExp(`<${tagkodepos}></${tagkodepos}>`, 'gi'), data_bangunan
            .postal_code || '')
          .replace(new RegExp(`<${tagprovinsi}></${tagprovinsi}>`, 'gi'), data_bangunan
            .provinsi || '');

        // console.log("get_bangunan after",get_bangunan);
        $('#content_list_tambah_alamat_penerima').append(
          `<button class="list-group-item text-left billingProfile" onclick="add_selected_bangunan(this,${id_bangunan})">` +
          get_bangunan + `</button>`);
        add_selected_bangunan(this, id_bangunan);
        Swal.fire({
          icon: 'success',
          title: 'Sukses!',
          text: 'Sukses menambahkan alamat penerima kedalam pesanan!',
          showConfirmButton: false,
          timer: 1500
        });

        //send_id_rumah_pengisi(isLoggedIn.userId,responseData.return_data.last_insert_id);
      } else if (responseData.status == 0) {
        Swal.fire("Gagal!", responseData.keterangan, "error");
        // }
      } else
        Swal.fire("Gagal!",
          "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error"
        );


    }
  });
}
export async function submit_tambah_toko_dropship() {
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    $.ajax({

      type: "post",
      dataType: "html",
      data: {

        "id_user": isLoggedIn.userId,
        'dropship-nama': $('dropship-nama').val(),
        'dropship-logo': $('dropship-logo').val(),

      },
      url: window.fai.getModule('base_url') + "api/submit_tambah_toko_dropship",
      dataType: "json",
      beforeSend: function () {
        $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar.',
          allowOutsideClick: false,
          showConfirmButton: false,
          showCloseButton: true,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (responseData) {
        Swal.close();
        if (responseData.status == 1) {
          $('#satuan-harga-' + id_cart).html(responseData.harga_satuan_print);
          $('#view-harga-' + id_cart).html(responseData.harga_jual_akhir_print);

          $('#summary').html(responseData.print_summary);
          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses menambahkan produk kedalam pesanan!',
            showConfirmButton: false,
            timer: 1500
          });
        } else if (responseData.status == 0) {
          Swal.fire("Gagal!", responseData.keterangan, "error");
          // }
        } else {

          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },

      complete: function (responseData) {
        Swal.close();
        if (responseData.status == 1) {
          $('#satuan-harga-' + id_cart).html(responseData.harga_satuan_print);
          $('#view-harga-' + id_cart).html(responseData.harga_jual_akhir_print);

          $('#summary').html(responseData.print_summary);
          Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Sukses menambahkan produk kedalam pesanan!',
            showConfirmButton: false,
            timer: 1500
          });
        } else if (responseData.status == 0) {
          Swal.fire("Gagal!", responseData.keterangan, "error");
          // }
        } else {

          Swal.fire("Gagal!",
            "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!",
            "error");
        }


      },
      error: function () {
        Swal.close();
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!',
          showConfirmButton: false,
          timer: 1500
        });

      }
    });
  } else {
    console.log("Belum login");
    open_login();
  }
}

export async function tambah_alamat_penerima() {

  document.body.classList.add("blurred");
  $("#alamat-penerima-container").show();

}
export async function tambah_toko_dropship() {

  document.body.classList.add("blurred");
  $("#toko-dropship-container").show();

}
export async function kembali_alamat_penerima_selected() {

  $('#billingProfileSection').hide();
  $('#selectedBilling').show();
}
export async function kembali_alamat_penerima_cari() {

  $('#billingProfileSection').show();
  $('#selectedBilling').hide();
}
export async function add_selected_bangunan(e, id_kirim_ke) {
  $('#id_kirim_ke').val(id_kirim_ke);
  $('#selectedBilling').html(`<div class="float-right">
                                    <button class="btn btn-light btn-sm" id="changeBilling" onclick="kembali_alamat_penerima_cari()">Change</button>
                                </div>` + $(e).html());
  $('#billingProfileSection').hide();
  $('#selectedBilling').show();
}
export async function proses_checkout() {
  await proses_checkout_cek_stok();
}
export async function proses_checkout_cek_stok(confirm = 0) {

  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    let send_cart_proses = [];
    $('.cart-produk').each(function () {
      if ($(this).is(':checked')) {
        const harga = parseFloat($('#satuan-harga-val' + this.value).val());
        const qty = parseFloat($('#set_qty-' + this.value).val());
        const stok = parseFloat($('#stok-val' + this.value).val());
        send_cart_proses.push({
          id_cart: this.value,
          qty: qty
        });

      }

    });
    console.log("send_cart_proses", send_cart_proses);
    $.ajax({

      type: "post",
      dataType: "html",
      data: {

        "id_user": isLoggedIn.userId,

        'send_cart_proses': send_cart_proses,
        'confirm': confirm

      },
      url: window.fai.getModule('base_url') + "api/proses_checkout",
      dataType: "json",
      beforeSend: function () {
        // $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
        Swal.fire({
          title: 'Sedang memproses...',
          text: 'Mohon tunggu sebentar.',
          allowOutsideClick: false,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success:  function (responseData) {
        Swal.close();
        if (responseData.status == 1) {

          const data = [{
            object: 'foreach_1_row'
          }];
          const type = {
            0: "Ecommerce",
            1: "checkout",
            2: "view_layout",
            3: responseData.id,
          };
          console.log(type);
          const encoded =  btoa(JSON.stringify(type));
          // content.content.html = "javascript:void(link_direct('" + enPage + "','" + encoded + "'))";
          link_direct(encoded);

        } else if (responseData.status == 0) {
          Swal.fire("Gagal!", responseData.keterangan, "error");
          // }	
        } else
          Swal.fire("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


      }
    });
  } else {
    console.log("Belum login");
    open_login();
  }

}

export async function js_cek_harga(id_cart) {
  // 
  let subtotal_cart = 0;
  let qty_cart = 0;
  let cartTotal = 0;
  const cartItems = $('.cart-produk').toArray(); // convert ke array agar bisa pakai for...of

  for (const item of cartItems) {
    if ($(item).is(':checked')) {
      let harga = parseFloat($('#satuan-harga-val' + item.value).val());
      let qty = parseFloat($('#set_qty-' + item.value).val());
      let stok = parseFloat($('#stok-val' + item.value).val());
      console.log(item.value);
      console.log(harga);
      console.log(qty);
      // if (qty > stok) {
      //   qty = stok;
      //   $('#set_qty-' + this.value).val(qty);
      //   Swal.fire({
      //     icon: 'success',
      //     title: 'Gagal!',
      //     text: 'Qty tidak boleh melebihi stok!',
      //     showConfirmButton: false,
      //     timer: 700
      //   });
      // }
      let cartTotal = qty * harga;
      let RPcartTotal = await formatRupiah(cartTotal, 'Rp. ')
      $('#view-harga-' + item.value).html(RPcartTotal)
      qty_cart += qty;
      console.log();
      subtotal_cart += cartTotal;
    }

  };
  if (qty_cart) {
    let formatQty = await formatRupiah(qty_cart, '');
    let formatSubtotal = await formatRupiah(subtotal_cart);
    let summary = `<div id="detail-order">
                
                <ul class="list-unstyled mb-0">
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> QTY Produk </span>
                <span>${formatQty} pcs </span>
                
                </li>
                <li class="d-flex justify-content-between mb-3 " style="border-bottom:1px dotted black">
                <span> Sub Total</span>
                <span>${formatSubtotal}</span>
                
                </li>
                </div>
                <button class="btn-primary btn" onclick="proses_checkout()" type="button">Checkout</button>`;
    $('#summary').html(summary);

  } else {
    $('#summary').html("");

  }
}
export async function getWrapperJobParent(el) {
  while (el && el !== document) {
    if (el.id && el.id.startsWith("wrapper-job-")) {
      return el; // ketemu parent
    }
    el = el.parentElement; // naik ke atas
  }
  return null;
}
export async function send_cart_checked(id_cart) {
  const isLoggedIn = await window.fai.getModule('loginHelper').checkLoginStatus();
  if (isLoggedIn) {
    var varian_1 = 0;
    var varian_2 = 0;
    var varian_3 = 0;
    var qty = 0;
    let visible = false;
    let max_varian = $('#max_varian-' + id_cart).val();
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
    let is_produk = 1;

    if (!is_produk) {
      Swal.fire("Gagal!", "Pilih Varian terlebih dahulu", "error");

    } else {

      $.ajax({
        type: "post",
        dataType: "html",
        data: {

          "id_user": isLoggedIn.userId,
          'id_cart': id_cart,
          'varian_1': varian_1,
          'varian_2': varian_2,
          'varian_3': varian_3,
          'set_qty': qty,
          'checked': $('#bismillah_beli-' + id_cart).is(':checked')

        },
        url: window.fai.getModule('base_url') + "api/cheked_cart",
        dataType: "json",
        beforeSend: function () {
          $("#summary").html("Tunggu Sebentar"); // Menampilkan indikator loading
          Swal.fire({
            title: 'Sedang memproses...',
            text: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });
        },
        success: function (responseData) {
          Swal.close();
          if (responseData.status == 1) {
            $('#satuan-harga-' + id_cart).html(responseData.harga_satuan_print);
            $('#view-harga-' + id_cart).html(responseData.harga_jual_akhir_print);
            // $('#image_cart-' + id_cart).html(responseData.img_src);
            $('#summary').html(responseData.print_summary);
            Swal.fire({
              icon: 'success',
              title: 'Sukses!',
              text: 'Sukses menambahkan produk kedalam pesanan!',
              showConfirmButton: false,
              timer: 1500
            });
          } else if (responseData.status == 0) {
            Swal.fire("Gagal!", responseData.keterangan, "error");
            // }	
          } else
            Swal.fire("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


        }
      });
    }
    // redirect ke dashboard misalnya
  } else {
    console.log("Belum login");
    open_login();
  }
}
export async function change_variasi(variasi, nama_variasi, json, el) {
  const wrapper = el.closest("[id^='wrapper-job-']");
  if (!wrapper) {
    console.error("wrapper-job tidak ditemukan");
    return;
  }
  const raw = decodeURIComponent(escape(atob(json)));
  const parsed = JSON.parse(raw);
  console.log("max_variasi", parsed.max_variasi);
  console.log("variasi", variasi);
  if (parseInt(parsed.max_variasi) == parseInt(variasi)) {
    let id_variasi = parsed.list_varian_detail.all[nama_variasi];
    if (!id_variasi) {
      id_variasi = parsed.list_varian_detail.all[nama_variasi + "-"];
    }

    let detail = parsed.varian[id_variasi];
    console.log("id_variasi", id_variasi);
    console.log("parsed", parsed);
    console.log("detail", detail);
    wrapper.querySelector(".job-subtitle-wrapper").innerHTML = await formatRupiah(detail.harga_pokok_varian);
    wrapper.querySelector(".job-logos").innerHTML = "<img src='" + detail.gambar_produk_varian + "' onclick='showPopup(this)' >";

    // document.querySelector("#stok-content").innerHTML = detail.stok;
    $('#id_produk_varian').val(id_variasi);
    $('#id_asset_varian').val(detail.id_barang_varian);
    stok_varian(wrapper, variasi, nama_variasi, parsed.id, parsed.id_asset, id_variasi, detail.id_barang_varian, detail.nama_varian);
  } else {
    wrapper.querySelector(".job-subtitle-wrapper").innerHTML = parsed.harga_detail[nama_variasi].harga_full;
    wrapper.querySelector(".job-logos").innerHTML = "<img src='" + parsed.foto_detail[nama_variasi] + "' onclick='showPopup(this)' >";
    wrapper.querySelector("#stok-content").innerHTML = parsed.stok_detail[nama_variasi];
    let dis = "";
    let tipe;
    let original;
    for (let i = (variasi + 1); i <= 3; i++) {

      $('#variasi-content-' + (i)).html('');
      tipe = "tipe_" + (variasi + 1);
      original = (parsed.list_varian[tipe].breakdown[i][nama_variasi]);
      const uniqueArray = Object.values(original).filter((item, index, self) =>
        index === self.findIndex(obj => obj.nama_varian === item.nama_varian)
      );


      // Jika kamu ingin hasil akhirnya kembali jadi object dengan index baru:
      const uniqueObject = Object.fromEntries(uniqueArray.map((item, i) => [i, item]));
      console.log("uniqueObject", uniqueObject);
      let sortedArray = await sortData(Object.values(uniqueObject));
      if (!Array.isArray(sortedArray)) {
        console.error("sortData tidak mengembalikan array");
        sortedArray = [];
      }
      // Langkah ketiga: Jika perlu mengonversi kembali ke objek, bisa lakukan:
      let sortedObject = Object.fromEntries(sortedArray.map((item, i) => [i, item]));

      console.log(sortedObject);
      console.log(sortedObject);
      let html = '';

      html += '<div class="form-selectgroup mt-3">';
      Object.values(sortedObject).forEach(item => {
        html += `
                    <label class="form-selectgroup-item">
                    <input type="radio" ` + dis + ` id="varian` + i + `" name="varian` + i + `[]" 
                    value="${item.id_varian}" class="form-selectgroup-input" onclick="change_variasi(${i},'${item.id_varian}','${json}',this);">
                    <span class="form-selectgroup-label">${item.nama_varian}</span>
                    </label>
                `;
      });
      html += '</div>';
      $('#variasi-content-' + (i)).html(html);
      dis = "disabled";
    }
  }

}

async function stok_varian(wrapper, variasi, id_varian, id_produk, id_asset, id_produk_varian = "", id_barang_varian = "", nama_varian = "") {
  const dataStok = await fetchDataFromApi(window.fai.getModule('base_url') + "api/get_stok", 'POST',
    {
      variasi: variasi
      , id_varian: id_varian
      , id_asset: id_asset
      , id_produk: id_produk
      , id_produk_varian: id_produk_varian
      , id_asset_varian: id_barang_varian
    });
  wrapper.querySelector("#stok-content").innerHTML = dataStok.stok;
  const stokDetail = wrapper.querySelector('.stok-content-detail');
  if (stokDetail) stokDetail.remove();
  wrapper.querySelector("#stok-content-detail").innerHTML = "(" + nama_varian + ")";

}
let debounceTimer;
export async function searchdata(index) {
  clearTimeout(debounceTimer);

  debounceTimer = setTimeout(async () => {
    // Gantilah ini dengan proses pencarian aslimu
    await prosessearchdata(index);
  }, 1000); // delay 300ms

}
export async function prosessearchdata(index) {

  let query = document.getElementById("search-" + index).value.toLowerCase();
  document.getElementById("content-" + index).innerHTML = "";
  const realData = getalldata.data_produk_real[index];
  const realArray = Array.isArray(realData) ?
    realData :
    Object.values(realData); // kalau dia object dengan key numerik, dll
  if (query.trim() === "") {
    getalldata.data_produk[index] =
      realArray; // Kembalikan ke data' . $function . '_' . $type . ' asli jika input kosong
  } else {
    let data_produk;
    console.log(getalldata);
    console.log(getalldata.data.search_field);
    let fields = getalldata.data.search_field[index];
    const searchInput = document.querySelector('#search-' + index);
    const query = searchInput.value.trim();
    const fieldsToSearch = getalldata.data.search_field[index];
    let whereClause = [];
    whereClause.push({
      fields: fieldsToSearch,
      operator: 'like_or_fields',

      value: `%${query}%`
    });
    const queryBody = {
      db: 'view_produk_detail', // atau nama db dinamis Anda
      where: whereClause,
      limit: getalldata.data.itemsPerPage[index], // atau batas yang Anda inginkan
      offset: 0,
      function : 'all_produk'
    };
    data_produk = await loadJSON('view_produk_detail', queryBody);

    console.log(data_produk);
    getalldata.data_produk[index] = data_produk;
  }

  currentPage[index] = 1; // Reset ke halaman pertama
  appendData(index, currentPage[index]); // Render ulang dengan data yang difilter
}