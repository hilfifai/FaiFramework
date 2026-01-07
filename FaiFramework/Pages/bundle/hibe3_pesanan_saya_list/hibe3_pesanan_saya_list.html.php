 <div class="order-card" data-status="selesai" onclick="pesanan_saya_detail(<ID></ID>)">
     <div class="card-header">
         <div class="shop-info">
             <i class="fas fa-store"></i>
             <strong>
                 <NAMA_TOKO></NAMA_TOKO>
             </strong>

         </div>
         <div class="shop-info">
             <TANGGAL-PO></TANGGAL-PO> - <NO-PO></NO-PO>
         </div>
         <span class="status status-selesai">Selesai</span>
     </div>

     <!-- Daftar Produk dalam satu pesanan -->
     <div class="product-list">
         <LIST-PRODUK></LIST-PRODUK>


     </div>

     <div class="card-summary">
         <p class="product-count">
             <QTY></QTY> Produk
         </p>
         <div>
             <span>Total Pesanan:</span>
             <span class="total-price">Rp <TOTAL></TOTAL></span>
         </div>
     </div>
     <div class="card-actions">
         <!--<button class="btn btn-secondary">Beli Lagi</button>
                    <button class="btn btn-primary">Beri Penilaian</button>-->
     </div>
 </div>