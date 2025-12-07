
        
        <form action="http://localhost/frameworkServer//FaiServer/costum/Ecommerce/get_pesanan/1///" method="POST"><div class="card card-body ">
       
        <h6>Tipe Pemesanan</h6>
        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
            <label class="form-selectgroup-item flex-fill">
              <input type="radio" name="form-pesanan" value="baru" class="form-selectgroup-input" required>
              <div class="form-selectgroup-label d-flex align-items-center p-3">
                <div class="me-3">
                  <span class="form-selectgroup-check"></span>
                </div>
                <div>
                  <span class="payment payment-provider-visa payment-xs me-2"></span>
                  <strong>Pesanan Baru</strong>
                </div>
              </div>
            </label>
            <label class="form-selectgroup-item flex-fill">
              <input type="radio" name="form-pesanan" value="lama" class="form-selectgroup-input" required>
              <div class="form-selectgroup-label d-flex align-items-center p-3 w-100">
                <div class="me-3">
                  <span class="form-selectgroup-check"></span>
                </div>
                <div style="width:100%">
                  <span class="payment payment-provider-visa payment-xs me-2"></span>
                  <strong>Pesanan Lama</strong>
                  <br>
                  <select type="text"   id="pesanan" name="pesanan" value="" class="form-control w-100 select2">
                    <option value="">Pilih Nomor Pesanan</option>
                    <LIST-PESANAN></LIST-PESANAN> 
                  </select>
                </div>
              </div>
            </label>
           <h6>Jumlah Pembelian Toko</h6>
           <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
            <label class="form-selectgroup-item flex-fill">
              <input type="radio" name="form-grup" value="satu" class="form-selectgroup-input" required>
              <div class="form-selectgroup-label d-flex align-items-center p-3">
                <div class="me-3">
                  <span class="form-selectgroup-check"></span>
                </div>
                <div>
                  <span class="payment payment-provider-visa payment-xs me-2"></span>
                  <strong>Pembelian disatu toko saja</strong>
                </div>
              </div>
            </label>
            <label class="form-selectgroup-item flex-fill">
              <input type="radio" name="form-grup" value="lebih" class="form-selectgroup-input" required>
              <div class="form-selectgroup-label d-flex align-items-center p-3 w-100">
                <div class="me-3">
                  <span class="form-selectgroup-check"></span>
                </div>
                <div style="width:100%">
                  <span class="payment payment-provider-visa payment-xs me-2"></span>
                  <strong>Pembelian dilebih dari 1 toko</strong>
                  <br>
                  
                </div>
              </div>
            </label>
          <button type="submit" class="btn btn-primary"> Lanjutkan</button>
            </div>
            </div>
        </div>