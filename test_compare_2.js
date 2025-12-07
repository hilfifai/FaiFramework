
export async function initialize_checkout() {
    console.clear();
    console.log('INITIAL CHECKOUT');
    $('#billingProfileSection').html("");
    $('#selectedBilling').html("");
    $('#deliveries').html("");
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
    const isLoggedIn = await checkLoginStatus();;
    get_data = getalldata.myApp.page.app.versions.Inventaris_aset.bangunan;
    last_version = get_data.last_version;
    bangunan = get_data.versions[last_version];
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
    parse_form(bangunan.page.crud, bangunan.page, {
        function: "submit_tambah_alamat_penerima('form-alamat-penerima')",
        class: "login-btn"
    }, 'form-alamat-penerima', 'tambah', null);



    const temp_bangunan = `
            
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
            get_bangunan = temp_bangunan;

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
                if (allData[getalldata.myApp.page.load.load_page_id].utama.id_kirim_ke) {
                    if (data_bangunan.primary_key2 == allData[getalldata.myApp.page.load.load_page_id].utama
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
    let ekspedisi = await getAllFromStore(db, {
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
    const dropship = await getAllFromStore(db, {
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
    list_dropship = (dropship.row);

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
            get_bangunan = temp_bangunan;

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
                if (allData[29].utama.id_kirim_ke) {
                    if (data_bangunan.id_kirim == allData[29].utama.id_kirim_ke) {
                        selected_bangunan = get_bangunan;
                    }
                } else if (data_bangunan.default_pembelian_barang == 1) {
                    selected_bangunan = get_bangunan;
                }
            // console.log("get_bangunan after",get_bangunan);      
            content_bangunan += `<button class="list-group-item text-left billingProfile" onclick="add_selected_bangunan(this)">` + get_bangunan + `</button>`;
        });
    }
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
                                        <img src="https://api.ethica.id//uploads/SEPLY/KASEO/BESAR/KASEO 241 SUMMER BLUE.jpg">
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
                <div style="padding:20px;background:#fafafa;font-size: 18px;font-weight: bold;color: black;">
                Pilih Ongkir 
                <span class="float-right">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                </span>
                </div>

                </div>`;
            content_toko += get_toko;
        }
    };
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