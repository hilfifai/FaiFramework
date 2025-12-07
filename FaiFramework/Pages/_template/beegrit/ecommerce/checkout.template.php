<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="mb-5">
                <h3 class="mb-0 ">Checkout</h3>

            </div>
        </div>

        <div class="col-xxl-8 col-12">
            <div>
                <!-- stepper -->
                <div id="stepperForm" class="bs-stepper">
                    <!-- Stepper Button -->

                    <!-- card -->
                    <form onsubmit="return false" data-gtm-form-interact-id="0">
                        <div class="card">

                            <div class="card-body">
                                <!-- Stepper content -->
                                <div class="mb-2">
                                    <h3 class="mb-1">Informasi Pengiriman</h3>
                                    <p class="mb-0">
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h4 class="mb-0">Pengiriman Ke</h4>
                                    <a href="#!" class="btn btn-outline-light text-dark" data-bs-toggle="modal" data-bs-target="#addNewAddress">Tambahkan Alamat</a>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <KIRIM-KE></KIRIM-KE>

                                </div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h3 class="mb-1">Produk</h3>
                                        <p class="mb-0">
                                        </p>

                                    </div>

                                    <div class="table-responsive ">
                                        <PRODUK-TABLE></PRODUK-TABLE>
                                    </div>


                                </div>
                                <!--                                 
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h3 class="mb-1">Voucher</h3>
                                        <p class="mb-0"></p>

                                    </div>
                                    <form class="row g-2">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Coupon Code">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-dark">Apply</button>
                                        </div>

                                    </form>
                                    <div id="hasil-voucher">

                                    </div>
                                    <div class="table-responsive ">
                                        <VOUCHER-TABLE></VOUCHER-TABLE>
                                    </div>


                                </div> -->
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h3 class="mb-1">Ongkir</h3>
                                        <p class="mb-0">
                                        </p>

                                    </div>
                                    <div class="table-responsive ">
                                        <ONGKIR-TABLE></ONGKIR-TABLE>
                                    </div>


                                </div>
                                <!-- Button -->

                                <div class="mb-5">
                                    <h3 class="mb-1">Pembayaran</h3>
                                    <p class="mb-0">
                                    </p>
                                </div>
                                <!-- Card -->
                                <LIST-PEMBAYARAN></LIST-PEMBAYARAN>

                                <!-- card -->

                                <!-- Button -->
                                <div class="d-flex justify-content-between">
                                    <!-- Button -->
                                    <button class="btn btn-outline-primary mt-3" onclick="stepperForm.previous()">
                                        Kembali Ke cart
                                    </button>
                                    <!-- Button -->
                                    <button type="button" class="btn btn-primary mt-3" onclick=" location.href='<BUAT_INVOICE></BUAT_INVOICE>' ">
                                        Buat invoice
                                    </button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-12">
        <div class="card mt-5 mt-xxl-0" id="SUMMARY">
            <SUMMARY></SUMMARY>
        </div>
    </div>
</div>
<input type="hidden" id="id_pesananco" value="<IDPESANAN></IDPESANAN>">
<TO_SCRIPT></TO_SCRIPT>
