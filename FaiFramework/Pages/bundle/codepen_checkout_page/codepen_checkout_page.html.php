<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css"> -->
<style>
    address {
        margin-bottom: 1rem;
        font-style: normal;
        line-height: inherit;
    }

    .float-right {
        float: right !important;
    }

    .input-size-sm {
        width: 175px;
    }

    #billingProfileSection .list-group-item {
        cursor: pointer;
    }

    #billingProfileSection .list-group-item:not(.active):hover {
        background: rgba(179, 179, 179, 0.1);
        color: black;
    }

    @supports ((position:-webkit-sticky) or (position:sticky)) {
        .sticky-top {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1020;
        }
    }

    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1020;
    }

    .list-group-item:first-child {
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }

    .text-left {
        text-align: left !important;
    }

    .list-group-item {
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .125);
    }

    .list-group-item:first-child {
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }

    .text-left {
        text-align: left !important;
    }

    .list-group-item {
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .125);
    }
</style>

<div id="checkout">
    <div class="container">
        <div class="row">
            <div id="choosen_penerima"></div>
            <div class="col-md-12 order-md-1 mt-3">
                <section id="shippingSection" style="display: none;">
                    <h4 class="mb-4">Shipping</h4>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="selectedShipping">
                                <div class="float-right">
                                    <button class="btn btn-light btn-sm" id="changeShipping">Change</button>
                                </div>
                                <address>
                                    <strong>Billy</strong><br>
                                    135 Roane Avenue,<br>
                                    College Park, MD 20741
                                </address>
                            </div>
                            <div id="shippingProfileSection" style="display: none">

                                <h5 class="mb-4">Select Shipping<span class="float-right"><button class="btn btn-sm btn-light" id="cancelChangeShipping"><i class="fa fa-chevron-left mr-2"></i>Cancel</button></span></h5>

                                <div class="list-group">
                                </div>
                                <button class="btn btn-sm mt-3 btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="billingSection">
                    <h4 class="mb-4">Alamat Penerima</h4>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="selectedBilling" style="">
                                <div class="float-right">
                                    <button class="btn btn-light btn-sm" id="changeBilling">Change</button>
                                </div>
                                <address>
                                    <strong>Don Jr.</strong><br>
                                    135 Roane Avenue,<br>
                                    College Park, MD 20741
                                </address>
                            </div>
                            <div id="billingProfileSection" class="mb-4 pb-3 border-bottom" style="display: none;">

                                <h5 class="mb-4">Select Billing<span class="float-right"><button class="btn btn-sm btn-light" id="cancelChangeBilling" onclick="kembal"><i class="fa fa-chevron-left mr-2"></i>Cancel</button></span></h5>

                                <div class="list-group">
                                    <button class="list-group-item text-left billingProfile" data-billingprofile="7d83f97c-868e-43d3-886d-1c8518ffa1dc">
                                        <address class="">
                                            <strong>Jake Test</strong>
                                            <br> 123 Beach Blvd Unit 111,
                                            <br> Jacksonville, FL 12345
                                        </address>
                                        VISA *1111
                                    </button>
                                    <button class="list-group-item text-left billingProfile" data-billingprofile="ea18bc76-3b05-4004-9952-df20884713da">
                                        <address class="">
                                            <strong>Jake Test</strong>
                                            <br> 123 Beach Blvd Unit 111,
                                            <br> Jacksonville, FL 12345
                                        </address>
                                        VISA *1111
                                    </button>
                                </div>
                                <button class="btn btn-sm mt-3 btn-primary">Save</button>
                            </div>

                        </div>
                    </div>
                </section>

                <section id="deliveries">
                    <h4 class="mb-4">Detail Pemesanan Barang</h4>
                    <div class="card">
                        <div class="card-header">
                            Tuesday 10/16 <span class="ml-2 badge badge-primary">Weekly</span>
                        </div>
                        <div class="card-body">
                            <article class="row pb-3 mb-3 border-bottom product" id="1234">
                                <div class="col-2"><img src="#" width="100" height="100"></div>
                                <div class="col-10">
                                    <h6>Some Item in the cart</h6>

                                </div>

                            </article>
                            <article class="row pb-3  product" id="1234">
                                <div class="col-2"><img src="#" width="100" height="100"></div>
                                <div class="col-10">
                                    <h6>Some Item in the cart</h6>

                                </div>

                            </article>
                        </div>
                    </div>
                </section>
                <section id="voucher">
                    <h4 class="mb-4">Voucher</h4>
                    <div class="card">
                        <div class="card-body">
                            <div id="offerCode">

                                <div class="row pl-4">
                                    <input type="text" placeholder="Enter Code" class="mr-2 input-size-sm form-control form-control-sm  w-100 mb-3">
                                    <button class="btn btn-primary btn-sm d-inline-block">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
            <div class="col-md-12 order-md-2">
                <section class="sticky-top" style="top: 52px">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mb-3 px-3 text-center">
                                <button class="btn btn-primary btn-block">Complete Order</button>
                                <small class="text-center">By placing your order, you agree to 's privacy notice and conditions of use.
                                </small>
                            </div>
                            <h6>Order Summary</h6>
                            <ul class="list-group-flush">
                                <li class="list-group-item p-1"><strong>Subtotal</strong></li>
                            </ul>
                        </div>
                    </div>

                </section>
            </div>

        </div>
    </div>
</div>

<script>
    $('#billingProfileSection').html("");
    $('#changeBilling').click(function() {
        // Aksi saat tombol diklik
        console.log("Tombol di-klik!");
        $('#billingProfileSection').show();
        $('#selectedBilling').hide();
    });
    $('#cancelChangeBilling').click(function() {
        // Aksi saat tombol diklik
        console.log("Tombol di-klik!");
        $('#billingProfileSection').hide();
        $('#selectedBilling').show();
    });
    initialize_checkout();
</script>
 <section class="login-container" id="alamat-penerima-container" style="display:none">
        <div class="login-header">
            <h1 class="login-title">Alamat Penerima</h1>
            <span class="close-btn" onclick="close_all()">&times;</span>
        </div>
        <div class="login-form">
            <style id="form-alamat-penerima-styles"></style>
            <form autocomplete="off" id="form-alamat-penerima" method="post">

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Nama Bangunan</span>
                    <input type="text" name="name" id="penerima-nama" placeholder="Enter your name" class="form-input"
                        required />
                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Alamat</span>
                    <input type="email" name="email" id="penerima-alamat" placeholder="Enter your email"
                        class="form-input" required />
                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Provinsi</span>
                    <select type="text" name="provinsi" id="penerima-provinsi" placeholder="Enter your password"
                        class="form-input" required>
                    </select>

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kota</span>
                    <select type="text" name="kota" id="penerima-kota" placeholder="Enter your password"
                        class="form-input" required />
                    </select>

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kecamatan</span>
                    <input type="text" name="kota" id="penerima-kecamatan" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kelurahan</span>
                    <input type="text" name="kota" id="penerima-kelurahan" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0 d-none">
                    <span class="form-label-text">RT</span>
                    <input type="text" name="kota" id="penerima-rt" placeholder="Enter your password" class="form-input"
                        required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">RW</span>
                    <input type="text" name="kota" id="penerima-rw" placeholder="Enter your password" class="form-input"
                        required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">Nomor Bangunan</span>
                    <input type="text" name="kota" id="penerima-nomor" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">Patokan</span>
                    <input type="text" name="kota" id="penerima-patokan" placeholder="Enter your password"
                        class="form-input" required />

                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">No Whatsapp</span>
                    <div class="phone-input">
                        <span>+62</span>
                        <input type="number" name="phone" id="penerima-wa" placeholder="Enter your phone"
                            class="form-input" required />
                    </div>
                </label>

                <button type="button" onclick="submit_tambah_alamat_penerima()" class="login-btn">Tambahkan</button>
            </form>

        </div>
    </section>
    <section class="login-container" id="toko-dropship-container" style="display:none">
        <div class="login-header">
            <h1 class="login-title">Tambah Toko Dropship</h1>
            <span class="close-btn" onclick="close_all()">&times;</span>
        </div>
        <div class="login-form">
            <form autocomplete="off" id="form-dropship" method="post">
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Nama Toko</span>
                    <input type="text" name="name" id="dropship-nama" placeholder="Enter your name" class="form-input"
                        required />
                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Logo Toko</span>
                    <input type="file" name="name" id="dropship-logo" placeholder="Enter your name" class="form-input"
                        required />
                </label>


                <button type="button" onclick="submit_tambah_toko_dropship()" class="login-btn">Tambahkan</button>
            </form>

        </div>
    </section>
    </div>
