 <div class="detail-container">
        <!-- Tombol Kembali ke Daftar Pesanan -->
        <a href="javascript:void(0)" onclick="pesanan_saya()" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan</a>
        
        <div class="detail-header">
            <h1><i class="fas fa-receipt"></i> Detail Pesanan</h1>
        </div>

        <!-- Bagian Status dan Pengiriman -->
        <div class="detail-section">
            <div class="status-header">
                <span class="order-id">"><TANGGAL-PO></TANGGAL-PO> - <NOMOR-PO></NOMOR-PO></span>
                <span class="status status-selesai">Pesanan Selesai</span>
            </div>
            <hr>
            <div class="shipping-info">
                <h3>Informasi Pengiriman</h3>
                <p><strong>Penerima:</strong> <NAMA-PENERIMA></NAMA-PENERIMA></p>
                <p><strong>Telepon:</strong> <NO-PENERIMA></NO-PENERIMA></p>
                <p><strong>Alamat:</strong> <ALAMAT-PENERIMA></ALAMAT-PENERIMA></p>
            </div>
            <div class="courier-info">
                <p><i class="fas fa-truck"></i> <JASA-KIRIM></JASA-KIRIM> (<SERVICE></SERVICE>) - <strong><NO-RESI></NO-RESI></strong></p>
                <!--<button class="btn btn-secondary btn-sm">Lacak</button>-->
            </div>
        </div>

        <!-- Bagian Daftar Produk -->
        <div class="detail-section">
            <h3>Produk yang Dipesan</h3>
            <div class="shop-info-detail">
                <i class="fas fa-store"></i>
                <strong><NAMA_TOKO></NAMA_TOKO></strong>
               
            </div>
            <div class="product-list-detail">
				<LIST-PRODUK></LIST-PRODUK>
               
                <div class="product-item">
                    <img src="https://via.placeholder.com/80x80.png?text=Produk+D" alt="Produk D">
                    
                </div>
            </div>
        </div>

        <!-- Bagian Rincian Pembayaran -->
        <div class="detail-section">
            <h3>Rincian Pembayaran</h3>
            <div class="payment-details">
                <div class="payment-row">
                    <span>Metode Pembayaran</span>
                    <span><METODE-BAYAR></METODE-BAYAR> <BRAND-BAYAR></BRAND-BAYAR></span>
                </div>
                <hr>
                <div class="payment-row"> 
                    <span>QTY Produk</span>
                    <span>Rp <QTY></QTY></span>
                </div>
				<div class="payment-row">
                    <span>Subtotal Produk</span>
                    <span>Rp <SUBTOTAL></SUBTOTAL></span>
                </div>
                <div class="payment-row">
                    <span>Total Diskon</span>
                    <span>Rp <DISKON></DISKON></span>
                </div><div class="payment-row">
                    <span>Ongkos Kirim</span>
                    <span>Rp <ONGKIR></ONGKIR></span>
                </div>
                <div class="payment-row">
                    <span>Biaya Layanan</span>
                    <span>Rp 0</span>
                </div>
                <div class="payment-row grand-total">
                    <strong>Total Pembayaran</strong>
                    <strong>Rp <TOTAL></TOTAL></strong>
                </div>
            </div>
        </div>
        
        <!-- Tombol Aksi Utama -->
        <div class="detail-actions">
            <button class="btn btn-secondary">Hubungi Penjual</button>
            <button class="btn btn-primary">Beri Penilaian</button>
        </div>

    </div>
