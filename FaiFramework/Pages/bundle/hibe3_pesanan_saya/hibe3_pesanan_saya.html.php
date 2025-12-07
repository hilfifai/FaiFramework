<div class="order-container">
        <h1><i class="fas fa-box"></i> Daftar Pesanan Saya</h1>

        <!-- Tab Filter Status Pesanan -->
        <div class="order-tabs">
            <button class="tab-button active" data-status="semua">Semua</button>
            <button class="tab-button" data-status="belum-bayar">Belum Bayar</button>
            <button class="tab-button" data-status="dikemas">Dikemas</button>
            <button class="tab-button" data-status="dikirim">Dikirim</button>
            <button class="tab-button" data-status="selesai">Selesai</button>
            <button class="tab-button" data-status="dibatalkan">Dibatalkan</button>
        </div>

        <!-- Daftar Pesanan -->
        <div class="order-list">
            <!-- Contoh Kartu Pesanan 1: Selesai (Banyak Produk) -->
           <LIST-PESANAN></LIST-PESANAN>
            <!-- Contoh Kartu Pesanan 2: Dikirim (Satu Produk) -->
            <div class="order-card" data-status="dikirim"  onclick="pesanan_saya_detail()">
                <div class="card-header">
                    <div class="shop-info">
                        <i class="fas fa-store"></i>
                        <strong>Fashion Pria Keren</strong>
                    </div>
                    <span class="status status-dikirim">Dikirim</span>
                </div>

                <!-- Daftar Produk dalam satu pesanan -->
                <div class="product-list">
                    <div class="product-item">
                        <img src="https://via.placeholder.com/80x80.png?text=Produk+B" alt="Produk B">
                        <div class="product-details">
                            <p class="product-name">Kemeja Flanel Lengan Panjang</p>
                            <p class="product-variant">Ukuran: L, Warna: Biru Navy</p>
                            <p class="product-qty">x1</p>
                        </div>
                    </div>
                </div>

                <div class="card-summary">
                     <p class="product-count">1 Produk</p>
                     <div>
                        <span>Total Pesanan:</span>
                        <span class="total-price">Rp 185.000</span>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-primary">Lacak</button>
                    <button class="btn btn-secondary">Pesanan Diterima</button>
                </div>
            </div>
        </div>
    </div>
