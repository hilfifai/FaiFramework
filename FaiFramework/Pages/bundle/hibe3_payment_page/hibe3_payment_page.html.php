<form id="form_order" method="POST" class="container"">
    

    <!-- Pilih Nominal -->
  
    <!-- Pilih Pembayaran -->
    <div class="mt-4">
        <div class="card" id="PaymentNew">
            <div class="card-body">
                <h1 class="heading-h5" style="color: #e3a53e" ;="">Pilih Pembayaran</h1>
                <div class="area-list-payment-method">
                    <LIST-PAYMENT></LIST-PAYMENT>
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="sub_total" id="sub_total" value="<GRAND-SUBTOTAL></GRAND-SUBTOTAL>" >
    <input type="hidden" name="biaya_payment_user" id="biaya_payment_user" value="0" >
    <input type="hidden" name="biaya_payment_system" id="biaya_payment_system" value="0" >
    <div id="form">
        <div class="card custom-card animate__animated animate__fadeInUp">
            <div class="card-body">
                <h1 class="heading-h5" style="color: #e3a53e" ;="">Grand Total</h1>
                <div class="form-row">
                    <div class="col-12 mt-2" id="grand-total">
                        Rp. <GRAND-SUBTOTAL></GRAND-SUBTOTAL>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Kode Promo -->

    <!-- Informasi Pembeli -->
    <div class="mt-4">
        
        <div class="mt-2">
            <button type="button" class="btn btn-primary w-100 pay-arvo" id="btn_beli" onclick="proses_bayar()">Bayar Sekarang</button>
        </div>
        <div class="mb-5 text-terms mt-3">
            <span>Dengan mengklik tombol bayar sekarang, Anda telah menyetujui <a href="#" style="color:#e3a53e; font-weight:800;">Syarat &amp; Ketentuan Layanan</a> yang berlaku</span>
        </div>
    </div>


</form>
<input type="hidden" id="brand-pembayaran">