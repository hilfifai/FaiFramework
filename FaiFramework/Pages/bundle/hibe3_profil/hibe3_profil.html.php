 <div class="profile-container">

     <div id="view-mode">
         <header class="profile-header">
             <img src="<FOTO></FOTO>" alt="Foto Profil" class="profile-picture">
             <h1 id="view-name"><NAMA-LENGKAP></NAMA-LENGKAP></h1>
             <p id="view-email"><EMAIL></EMAIL></p>
             <button id="edit-profile-btn" class="btn btn-primary" onclick="editProfileBtn()">Edit Profil</button>
         </header>

         <main class="profile-content">
             <section class="profile-section">
                 <h3>Informasi Pribadi</h3>
                 <div class="info-row">
                     <strong><i class="fas fa-phone"></i> Telepon</strong>
                     <span id="view-phone"><NO-HP></NO-HP></span>
                 </div>
             </section>

             <section class="profile-section">
                 <h3>Daftar Alamat</h3>
                 <div id="view-address-list">
					<LIST-ALAMAT></LIST-ALAMAT>
                     
                 </div>
             </section>
         </main>
     </div>


     <div id="edit-mode" class="hidden">
         <header class="profile-header">
             <h1>Edit Profil</h1>
             <p>Perbarui informasi akun dan alamat Anda.</p>
         </header>

         <form id="profile-form">
             <section class="profile-section">
                 <h3>Informasi Pribadi</h3>
                 <div class="form-group">
                     <label for="edit-name">Nama Lengkap</label>
                     <input class="form-control" type="text" id="edit-name" value="<NAMA-LENGKAP></NAMA-LENGKAP>">
                 </div>
                 <div class="form-group">
                     <label for="edit-email">Email</label>
                     <input class="form-control" type="email" id="edit-email" value="<EMAIL></EMAIL>" disabled>
                     <small>Email tidak dapat diubah.</small>
                 </div>
                 <div class="form-group">
                     <label for="edit-phone">Nomor Telepon</label>
                     <input class="form-control" type="tel" id="edit-phone" value="<NO-HP></NO-HP>">
                 </div>
             </section>

             <section class="profile-section">
                 <h3>Ubah Alamat</h3>
                 <div id="edit-address-list">
                     <!-- Contoh Form Alamat 1 -->
                     <div class="address-form-card">
                         <div class="form-group">
                             <label for="addr-label-1">Label Alamat (Contoh: Rumah, Kantor)</label>
                             <input class="form-control" type="text" id="addr-label-1" value="Alamat Rumah">
                         </div>
                         <div class="form-group">
                             <label for="addr-detail-1">Alamat Lengkap</label>
                             <textarea class="form-control"id="addr-detail-1" rows="3">Jl. Merdeka No. 17, RT 05/RW 02, Kel. Sukamaju, Kec. Cilandak, Jakarta Selatan, DKI Jakarta, 12430</textarea>
                         </div>
                         <div class="form-check">
                             <input class="form-control" type="radio" id="addr-default-1" name="default-address" checked>
                             <label for="addr-default-1">Jadikan Alamat Utama</label>
                         </div>
                     </div>
                     <!-- Contoh Form Alamat 2 -->
                     <div class="address-form-card">
                         <div class="form-group">
                             <label for="addr-label-2">Label Alamat</label>
                             <input class="form-control" type="text" id="addr-label-2" value="Alamat Kantor">
                         </div>
                         <div class="form-group">
                             <label for="addr-detail-2">Alamat Lengkap</label>
                             <textarea class="form-control"id="addr-detail-2" rows="3">Gedung Perkantoran ABC, Lantai 10, Jl. Jenderal Sudirman Kav. 52, Jakarta Pusat, DKI Jakarta, 12190</textarea>
                         </div>
                         <div class="form-check">
                             <input class="form-control" type="radio" id="addr-default-2" name="default-address">
                             <label for="addr-default-2">Jadikan Alamat Utama</label>
                         </div>
                     </div>
                 </div>
                 <button type="button" id="add-address-btn" class="btn btn-secondary" onclick="addAddressBtn()">
                     <i class="fas fa-plus"></i> Tambah Alamat Baru
                 </button>
             </section>

             <div class="form-actions">
                 <button type="button" id="cancel-btn" class="btn btn-secondary" onclick="cancelBtn()">Batal</button>
                 <button type="button" id="save-btn" class="btn btn-primary" onclick="profileForm()">Simpan Perubahan</button>
             </div>
         </form>
     </div>
 </div>