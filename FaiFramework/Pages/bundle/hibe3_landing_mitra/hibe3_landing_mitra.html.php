<div class="container " style="display:<DISPLAY></DISPLAY>">
    <form id="FormMitra" enctype="multidata/form-data">
        <div class="mt-4 ">
            <div class="text-center">
                <h3>Form Pendaftaran Mitra</h3>
            </div>
            <div class="card" id="PaymentNew">
                <div class="card-body">

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap">
                    </div>
                    <div class="form-group">
                        <label>No Whatsapp</label>
                        <input type="text" class="form-control" placeholder="No Whatsapp" name="no_wa">
                    </div>
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" class="form-control" placeholder="Nama Toko" name="nama_toko">
                    </div>
                    <div class="form-group">
                        <label>Link Shopee Toko</label>
                        <input type="text" class="form-control" placeholder="Nama Shopee" name="link_shopee">
                    </div>
                    <div class="form-group">
                        <label>Link Tokopedia/Tiktok Toko</label>
                        <input type="text" class="form-control" placeholder="Nama Tokopedia/Tiktok" name="link_tokpedtok">
                    </div>
                    <div class="form-group">
                        <label>Link Lazada Toko</label>
                        <input type="text" class="form-control" placeholder="Nama Lazada" name="link_lazada">
                    </div>
                    <div class="form-group">
                        <label>Pilih Kemitraan</label>
                        <PILIH-KEMITRAAN></PILIH-KEMITRAAN>
                        <div class="area-list-payment-method d-flex">
                            <div class="col-md-3 p-1">

                                <div class="list-group1 h-100">
                                    <input required="<ID></ID>" type="radio" id="method_100" class="radio-pembayaran" name="metode" value="100" data-gtm-form-interact-field-id="1">
                                    <label for="method_100" class="list-group-item h-100 radio-pembayarandiv" style="cursor:pointer;" onclick="click_pembayaran(this,1,0)">
                                        <div class="info-top d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                Reseler
                                            </div>
                                            <span class="payment-price" id="QRIS">-10%</span>
                                        </div>
                                        <div class="info-bottom mt-2">
                                            Syarat dan ketentuan :
                                            1. cukup mendaftarkan diri
                                            <div class="info-metode">

                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 p-1">
                                <div class="list-group1 h-100">
                                    <input required="<ID></ID>" type="radio" id="method_100" class="radio-pembayaran" name="metode" value="100" data-gtm-form-interact-field-id="1">
                                    <label for="method_100" class="list-group-item h-100 radio-pembayarandiv" style="cursor:pointer;" onclick="click_pembayaran(this,2,150000)">
                                        <div class="info-top d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                Agen
                                            </div>
                                            <span class="payment-price" id="QRIS">-20%</span>
                                        </div>
                                        <div class="info-bottom mt-2">
                                            Syarat dan ketentuan :
                                            1. pembayaran minimum 150.000
                                            <div class="info-metode">

                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card card-body d-flex mt-4">
                <strong><b>Total Pembayaran</b></strong>
                <input type="hidden" id="val_total_pembayaran">
                <div class="" id="total_pembayaran">
                    Rp 150.000
                </div>
            </div>
            <div class="mt-4">

                <div class="mt-2">
                    <button type="button" class="btn btn-primary w-100 pay-arvo" id="btn_beli" onclick="proses_daftar_mitra()">Daftar Sekarang</button>
                </div>
                <div class="mb-5 text-terms mt-3">
                    <span>Dengan mengklik tombol bayar sekarang, Anda telah menyetujui <a href="#" style="color:#e3a53e; font-weight:800;">Syarat &amp; Ketentuan Layanan</a> yang berlaku</span>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container" style="display:<DISPLAY-RESMI></DISPLAY-RESMI>">
    <div style="max-width: 400px; margin: 80px auto; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); text-align: center; background-color: #ffffff; font-family: 'Arial', sans-serif;">

        <!-- Icon sukses -->
        <div style="background-color: #e0f8e9; border-radius: 50%; width: 80px; height: 80px; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" fill="#34D399" />
                <path d="M9 12l2 2l4 -4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

        <!-- Pesan -->
        <h2 style="color: #10B981; margin-bottom: 8px;">Pendaftaran Mitra Berhasil</h2>
        <p style="color: #6B7280; font-size: 16px;">Terima kasih! Kamu resmi menjadi mitra kami.Anda akan mendapatkan potongan harga mitra <PERSEN></PERSEN>%. </p>

        <!-- Tombol cek riwayat -->

    </div>
</div>
<div class="container" style="display: <DISPLAY-PENDING></DISPLAY-PENDING>">
    <div style="max-width: 400px; margin: 80px auto; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); text-align: center; background-color: #ffffff; font-family: 'Arial', sans-serif;">

        <!-- Icon pending -->
        <div style="background-color: #fff3e0; border-radius: 50%; width: 80px; height: 80px; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" fill="#F59E0B" />
                <path d="M12 8v4l3 3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="12" cy="12" r="9" stroke="white" stroke-width="2" />
            </svg>
        </div>

        <!-- Pesan -->
        <h2 style="color: #F59E0B; margin-bottom: 8px;">Menunggu Verifikasi Pembayaran</h2>
        <p style="color: #6B7280; font-size: 16px;">Pendaftaranmu berhasil! Tim kami sedang memverifikasi pembayaran. Kamu akan mendapatkan <PERSEN></PERSEN>% setelah proses selesai.</p>

    </div>
</div>
<div class="container" style="display: <DISPLAY-BELUM-BAYAR></DISPLAY-BELUM-BAYAR>">
    <div style="max-width: 400px; margin: 80px auto; padding: 32px; border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); text-align: center; background-color: #ffffff; font-family: 'Arial', sans-serif;">

        <!-- Icon pembayaran -->
        <div style="background-color: #fee2e2; border-radius: 50%; width: 80px; height: 80px; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" fill="#EF4444" />
                <path d="M12 8v4m0 4h.01" stroke="white" stroke-width="2" stroke-linecap="round" />
                <path d="M8 4l8 16" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>

        <!-- Pesan -->
        <h2 style="color: #EF4444; margin-bottom: 8px;">Pembayaran Belum Dilakukan</h2>
        <p style="color: #6B7280; font-size: 16px;">Silakan lengkapi pembayaran untuk mengaktifkan status mitra dan mendapatkan <PERSEN></PERSEN>%.</p>

        <!-- Tombol isi form pembayaran -->
        <button style="margin-top: 24px; padding: 12px 24px; background-color: #EF4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;" onclick="klik_isi_form(<ID_GROUP></ID_GROUP>)">
            Isi Form Pembayaran
        </button>

        <!-- Catatan kecil -->

    </div>
</div>