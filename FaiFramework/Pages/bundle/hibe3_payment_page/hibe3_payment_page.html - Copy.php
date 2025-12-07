<form id="form_order" method="POST" class="container"">
    <input type=" hidden" name="kategori" id="kategori" value="124">
    <div id="form">
        <div class="card custom-card animate__animated animate__fadeInUp">
            <div class="card-body">
                <h1 class="heading-h5" style="color: #e3a53e" ;="">Sub Total</h1>
                <div class="form-row">
                    <div class="col-12 mt-2">
                        Rp. 0    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilih Nominal -->
  
    <!-- Pilih Pembayaran -->
    <div class="mt-4">
        <div class="card" id="PaymentNew">
            <div class="card-body">
                <h1 class="heading-h5" style="color: #e3a53e" ;="">Pilih Pembayaran</h1>
                <div class="area-list-payment-method">
                    <LIST-PAYMENT></LIST-PAYMENT>
                    <div class="child-box payment-drawwer shadow mb-3 active">
                        <div class="header short-payment-support-info-head" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <div class="left">
                                <b>
                                    <i class="fas fa-wallet"></i>
                                    QRIS </b>
                            </div>
                        </div>
                        <div class="button-action-payment" style="display: block;">
                            <div class="row row-cols-2 row-cols-md-3 p-1">
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_100" class="radio-pembayaran" name="metode" value="100" data-gtm-form-interact-field-id="1">
                                        <label for="method_100" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/1631940346d_qris.png" alt="QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="QRIS">Rp 50,500</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="short-payment-support-info" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <img src="https://assets.areagamers.com/img/181a20b1-5b4d-47ee-da91-b1bba2e6b068.webp" alt="QRIS" style="display: none;">
                        </div>
                    </div>
                    <div class="child-box payment-drawwer shadow mb-3">
                        <div class="header short-payment-support-info-head" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <div class="left">
                                <b>
                                    <i class="fas fa-wallet"></i>
                                    E-Wallet </b>
                            </div>
                        </div>
                        <div class="button-action-payment" style="display: none;">
                            <div class="row row-cols-2 row-cols-md-3 p-1">
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_101" class="radio-pembayaran" name="metode" value="101">
                                        <label for="method_101" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/165889919263759ovo_purple_11zon.png" alt="OVO QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="OVO_QRIS">Rp 51,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                OVO QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_102" class="radio-pembayaran" name="metode" value="102">
                                        <label for="method_102" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/165889924341092re_11zon.jpg" alt="Dana QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Dana_QRIS">Rp 51,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Dana QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_103" class="radio-pembayaran" name="metode" value="103">
                                        <label for="method_103" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/165889898523452re_11zon.jpg" alt="ShopeePay QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="ShopeePay_QRIS">Rp 51,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                ShopeePay QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_104" class="radio-pembayaran" name="metode" value="104">
                                        <label for="method_104" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/1634127105saldo-paypal-via-linkaja.png" alt="LinkAja QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="LinkAja_QRIS">Rp 51,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                LinkAja QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_120" class="radio-pembayaran" name="metode" value="120">
                                        <label for="method_120" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/30823efa-d55f-487f-d820-717aaf3582f6.webp" alt="Gopay QRIS" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Gopay_QRIS">Rp 51,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Gopay QRIS <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="short-payment-support-info" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <img src="https://assets.areagamers.com/img/f8ec432c-c0ce-49e4-f5d4-ab9066ae2b0d.webp" alt="E-Wallet">
                        </div>
                    </div>
                    <div class="child-box payment-drawwer shadow mb-3">
                        <div class="header short-payment-support-info-head" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <div class="left">
                                <b>
                                    <i class="fas fa-store"></i>
                                    Retail </b>
                            </div>
                        </div>
                        <div class="button-action-payment" style="display: none;">
                            <div class="row row-cols-2 row-cols-md-3 p-1">
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_111" class="radio-pembayaran" name="metode" value="111">
                                        <label for="method_111" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/1633695920ART_LOGO_BARU.png" alt="Alfamart" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Alfamart">Rp 53,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Alfamart <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="short-payment-support-info" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <img src="https://assets.areagamers.com/img/404c0c96-0b6d-45ef-a705-26f3f901bcd2.webp" alt="Retail">
                        </div>
                    </div>
                    <div class="child-box payment-drawwer shadow mb-3">
                        <div class="header short-payment-support-info-head" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <div class="left">
                                <b>
                                    <i class="fas fa-credit-card"></i>
                                    Bank </b>
                            </div>
                        </div>
                        <div class="button-action-payment" style="display: none;">
                            <div class="row row-cols-2 row-cols-md-3 p-1">
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_106" class="radio-pembayaran" name="metode" value="106">
                                        <label for="method_106" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/165376556771126387425889450564ri.png" alt="Mandiri Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Mandiri_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Mandiri Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_107" class="radio-pembayaran" name="metode" value="107">
                                        <label for="method_107" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/165376551071088386815883203585.png" alt="BNI Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="BNI_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                BNI Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_108" class="radio-pembayaran" name="metode" value="108">
                                        <label for="method_108" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/164976682202299.png" alt="BRI Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="BRI_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                BRI Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_109" class="radio-pembayaran" name="metode" value="109">
                                        <label for="method_109" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bank_permata.png" alt="Permata Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Permata_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Permata Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_110" class="radio-pembayaran" name="metode" value="110">
                                        <label for="method_110" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bank_bsi.webp" alt="BSI Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="BSI_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                BSI Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_112" class="radio-pembayaran" name="metode" value="112">
                                        <label for="method_112" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/maybank.png" alt="Maybank Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Maybank_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Maybank Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_113" class="radio-pembayaran" name="metode" value="113">
                                        <label for="method_113" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/1735583223s_(11).webp" alt="ATM Bersama" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="ATM_Bersama">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                ATM Bersama <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_114" class="radio-pembayaran" name="metode" value="114">
                                        <label for="method_114" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bank_ag.png" alt="Bank Artha Graha" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Bank_Artha_Graha">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Bank Artha Graha <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_115" class="radio-pembayaran" name="metode" value="115">
                                        <label for="method_115" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bnc.png" alt="Bank Neo Commerce" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Bank_Neo_Commerce">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Bank Neo Commerce <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_116" class="radio-pembayaran" name="metode" value="116">
                                        <label for="method_116" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bank-sampurna.png" alt="Bank Sahabat Sampoerna" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Bank_Sahabat_Sampoerna">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Bank Sahabat Sampoerna <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 p-1">
                                    <div class="list-group1 h-100">
                                        <input required="" type="radio" id="method_117" class="radio-pembayaran" name="metode" value="117">
                                        <label for="method_117" class="list-group-item h-100" style="cursor:pointer;">
                                            <div class="info-top d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://assets.areagamers.com/img/bank-danamon.png" alt="Danamon Virtual Account" style="height: 20px; width: auto;">
                                                </div>
                                                <span class="payment-price" id="Danamon_Virtual_Account">Rp 54,000</span>
                                            </div>
                                            <div class="info-bottom mt-2">
                                                Danamon Virtual Account <div class="info-metode">
                                                    <i>Dicek Otomatis</i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="short-payment-support-info" onclick="PaymentCollapse(this)" style="cursor:pointer;">
                            <img src="https://assets.areagamers.com/img/0760acf8-3eb0-40a0-f689-673c11d482f2.webp" alt="Bank">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kode Promo -->

    <!-- Informasi Pembeli -->
    <div class="mt-4">
        <div class="card mb-3">
            <div class="card-body">
                <h1 class="heading-h5" style="color: #e3a53e" ;="">Beli</h1>
                <div id="WhatsApp">
                    <label>Email (Untuk Notifikasi)</label>
                    <input required="" type="email" class="form-control" placeholder="xxx@areagamers.com" id="email" name="kontak" value="">
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="button" class="btn btn-primary w-100 pay-arvo" id="btn_beli">Beli Sekarang</button>
        </div>
        <div class="mb-5 text-terms mt-3">
            <span>Dengan mengklik tombol beli sekarang, Anda telah menyetujui <a href="https://areagamers.com/terms" style="color:#e3a53e; font-weight:800;">Syarat &amp; Ketentuan Layanan</a> yang berlaku</span>
        </div>
    </div>


</form>