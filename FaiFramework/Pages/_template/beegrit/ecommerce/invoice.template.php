<div class="container-fluid mt-4">
    <div class="card" id="invoice">
        <!-- Page header -->
        <div class="card-body">
            <div class="row justify-content-between mb-md-10">
                <div class="col-lg-3 col-md-6 col-12">
                    <a href="#">
                        <img width="80px" src="<BE3-LOGO></BE3-LOGO>" alt="" class="text-inverse">
                    </a>
                    <div class="mt-6">
                        <span class="fw-semi-bold"><NAMA-SINGLE-TOKO></NAMA-SINGLE-TOKO></span>
                        <p class="mt-2 mb-0">
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 d-flex justify-content-md-end mt-4 mt-md-0">
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <span>Invoice No. :</span>
                            <span class="ms-2 text-dark"><NOMOR-INVOICE></NOMOR-INVOICE> </span>

                        </li>
                        <li class="mb-1">
                            <span>Tanggal Invoice :</span>
                            <span class="ms-2 text-dark"><TANGGAL-INVOICE></TANGGAL-INVOICE> </span>

                        </li>
                       
                        <li class="mb-1">
                            <span>Status Pembayaran</span>
                            <span class="ms-2 text-dark" style="font-size:x-large"><STATUS-PEMBAYARAN></STATUS-PEMBAYARAN> </span>

                        </li>
                    </ul>


                </div>
            </div>
            <div class="row justify-content-between mb-8">
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="mt-6">
                       
                        <KIRIM-KE></KIRIM-KE>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 d-flex  mt-4 mt-md-0">
                    <br>
                    <PEMBAYARAN></PEMBAYARAN>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive ">
                        <LIST-PEMBAYARAN></LIST-PEMBAYARAN>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive ">
                        <PRODUK></PRODUK>
                    </div>
                </div>
                <div class="col-5 col-md-7">
                   
                </div>
                <div class=" col-md-5 col-7">
                    <SUMMARY></SUMMARY>
                </div>
                <div class="border-top pt-8">
                    <div>
                        <h5 class="mb-1">Notes:</h5>
                        <p class="mb-0">
                            <CATATAN></CATATAN>
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="#" class="btn btn-primary print-link no-print">Print</a>
                        <a href="#" class="btn btn-danger ms-2 no-print">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>