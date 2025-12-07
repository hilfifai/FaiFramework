   <div class="contact-page-container">

       <header class="contact-header">
           <h1>Hubungi Kami</h1>
           <p class="contact-intro">Punya pertanyaan atau masukan? Kami siap membantu Anda. Hubungi kami melalui detail di bawah atau isi formulir di samping.</p>
       </header>

       <main class="contact-main-content">
           <!-- Kolom Kiri: Informasi Kontak -->
           <div class="contact-info">
               <div class="info-item">
                   <i class="fas fa-map-marker-alt"></i>
                   <div>
                       <strong>Alamat Kantor</strong>
                       <p><ALAMAT></ALAMAT></p>
                   </div>
               </div>
               <div class="info-item">
                   <i class="fas fa-envelope"></i>
                   <div>
                       <strong>Email</strong>
                       <p><EMAIL></EMAIL></p>
                   </div>
               </div>
               <div class="info-item">
                   <i class="fas fa-phone"></i>
                   <div>
                       <strong>Telepon</strong>
                       <p><NO-TELP></NO-TELP></p>
                   </div>
               </div>
               

           </div>
			<input type="hidden" id="phone" value="<NO-TELP></NO-TELP>">
           <!-- Kolom Kanan: Formulir Kontak -->
           <div class="contact-form">
               <form action="#" method="post">
                   <div class="form-group">
                       <label for="name">Nama Lengkap</label>
                       <input type="text" id="nama_lengkap" name="name" placeholder="Masukkan nama Anda" required>
                   </div>
                   <div class="form-group">
                       <label for="email">Alamat Email</label>
                       <input type="email" id="alamat_email" name="email" placeholder="contoh@email.com" required>
                   </div> <div class="form-group">
                       <label for="email">Nomor Wa</label>
                       <input type="text" id="wa_no" name="email" placeholder="contoh@email.com" required>
                   </div>
                   <div class="form-group">
                       <label for="subject">Subjek Pesan</label>
                       <select id="subject" id="subject_pesan" name="subject">
                           <option value="umum">Pertanyaan Umum</option>
                           <option value="pesanan">Terkait Pesanan</option>
                           <option value="teknis">Dukungan Teknis</option>
                           <option value="lainnya">Lainnya</option>
                       </select>
                   </div>
                   <div class="form-group">
                       <label for="message">Pesan Anda</label>
                       <textarea id="message_pesan" name="message" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                   </div>
                   <button type="button" onclick="sendWa()" class="btn btn-primary">Kirim Pesan</button>
               </form>
           </div>
       </main>

       <!-- Bagian Peta -->
       <section class="map-section">
           <h2>Lokasi Kami di Peta</h2>
           <!-- Ganti iframe ini dengan kode embed Google Maps Anda -->
           <iframe
               src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.24330103233!2d106.80481231536761!3d-6.231568995489111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d3a7d2679%3A0x1d14f2c110a1d493!2sPacific%20Century%20Place%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1678886543210!5m2!1sen!2sid"
               width="100%"
               height="400"
               style="border:0;"
               allowfullscreen=""
               loading="lazy"
               referrerpolicy="no-referrer-when-downgrade">
           </iframe>
       </section>
   </div>