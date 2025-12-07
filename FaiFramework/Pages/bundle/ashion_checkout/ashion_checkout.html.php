<section class="checkout spad">
<div class="container">

<form action="#" class="checkout__form">
<div class="row">
    <div class="col-lg-8">
        <div class="card">

            <div class="card-body">
                <!-- Stepper content -->
                <div class="mb-2">
                    <h3 class="mb-1">Produk</h3>
                    <p class="mb-0">
                    </p>
                </div>
                <div class="table-responsive ">
                    <PRODUK-TABLE></PRODUK-TABLE>
                </div>
            </div>
        </div>
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
                    <a href="#!" class="btn btn-outline-light text-dark" data-bs-toggle="modal"
                        data-bs-target="#addNewAddress">Tambahkan Alamat</a>
                </div>
                <!-- row -->
                <div class="row">
                    <KIRIM-KE></KIRIM-KE>
                </div>
            </div>
        </div>
        <div class="card">

            <div class="card-body">
                <!-- Stepper content -->
                <div class="mb-2">
                    <h3 class="mb-1">Ongkir</h3>
                    <p class="mb-0">
                    </p>
                </div>
                <div class="table-responsive ">
                    <ONGKIR-TABLE></ONGKIR-TABLE>
                </div>
            </div>
        </div>
        
        <div class="card">

            <div class="card-body">
                <!-- Stepper content -->
                <div class="mb-2">
                    <h3 class="mb-1">Pembayaran</h3>
                    <p class="mb-0">
                    </p>
                </div>
                <LIST-PEMBAYARAN></LIST-PEMBAYARAN>
            </div>
        </div>



    </div>

<div class="col-lg-4">
    <div class="checkout__order">
      
        <div class="checkout__order__product">
            <SUMMARY></SUMMARY>
            <button type="button" class="btn btn-primary mt-3"
                onclick=" location.href='<BUAT_INVOICE></BUAT_INVOICE>' ">
                Buat invoice
            </button>
        </div>
    </div>
</div>
</form>
</div>
</section>
<input type="hidden" id="id_pesananco" value="<IDPESANAN></IDPESANAN>">
<TO_SCRIPT></TO_SCRIPT>