<section class="checkout spad"><div class="container">

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
                                      <h4 class="mb-0">Alamat Pengiriman </h4>
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
                              <button type="button" class="btn btn-primary mt-3" onclick="cek_form()"
                                  >
                                  Buat invoice
                              </button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </section>
      <input type="hidden" id="id_pesananco" value="<IDPESANAN></IDPESANAN>">


    <section class="login-container" id="alamat-penerima-container" style="display:none">
        <div class="login-header">
            <h1 class="login-title">Alamat Penerima</h1>
            <span class="close-btn" onclick="close_all()">&times;</span>
        </div>
        <div class="login-form">
            <style id="form-alamat-penerima-styles"></style>
            <form autocomplete="off" id="form-alamat-penerima" method="post">

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Nama Bangunan</span>
                    <input type="text" name="name" id="penerima-nama" placeholder="Enter your name" class="form-input"
                        required />
                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Alamat</span>
                    <input type="email" name="email" id="penerima-alamat" placeholder="Enter your email"
                        class="form-input" required />
                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Provinsi</span>
                    <select type="text" name="provinsi" id="penerima-provinsi" placeholder="Enter your password"
                        class="form-input" required>
                    </select>

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kota</span>
                    <select type="text" name="kota" id="penerima-kota" placeholder="Enter your password"
                        class="form-input" required />
                    </select>

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kecamatan</span>
                    <input type="text" name="kota" id="penerima-kecamatan" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Kelurahan</span>
                    <input type="text" name="kota" id="penerima-kelurahan" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0 d-none">
                    <span class="form-label-text">RT</span>
                    <input type="text" name="kota" id="penerima-rt" placeholder="Enter your password" class="form-input"
                        required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">RW</span>
                    <input type="text" name="kota" id="penerima-rw" placeholder="Enter your password" class="form-input"
                        required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">Nomor Bangunan</span>
                    <input type="text" name="kota" id="penerima-nomor" placeholder="Enter your password"
                        class="form-input" required />

                </label>
                <label class="form-label mb-0 mt-0  d-none">
                    <span class="form-label-text">Patokan</span>
                    <input type="text" name="kota" id="penerima-patokan" placeholder="Enter your password"
                        class="form-input" required />

                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">No Whatsapp</span>
                    <div class="phone-input">
                        <span>+62</span>
                        <input type="number" name="phone" id="penerima-wa" placeholder="Enter your phone"
                            class="form-input" required />
                    </div>
                </label>

                <button type="button" onclick="submit_tambah_alamat_penerima()" class="login-btn">Tambahkan</button>
            </form>

        </div>
    </section>
    <section class="login-container" id="toko-dropship-container" style="display:none">
        <div class="login-header">
            <h1 class="login-title">Tambah Toko Dropship</h1>
            <span class="close-btn" onclick="close_all()">&times;</span>
        </div>
        <div class="login-form">
            <form autocomplete="off" id="form-dropship" method="post">
                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Nama Toko</span>
                    <input type="text" name="name" id="dropship-nama" placeholder="Enter your name" class="form-input"
                        required />
                </label>

                <label class="form-label mb-0 mt-0">
                    <span class="form-label-text">Logo Toko</span>
                    <input type="file" name="name" id="dropship-logo" placeholder="Enter your name" class="form-input"
                        required />
                </label>


                <button type="button" onclick="submit_tambah_toko_dropship()" class="login-btn">Tambahkan</button>
            </form>

        </div>
