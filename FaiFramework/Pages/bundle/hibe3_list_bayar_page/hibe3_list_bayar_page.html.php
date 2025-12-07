 <input type="hidden" class="collect_id" value="<ID></ID>">
 <form class="space-y-3" id="konfirmasi-pembayaran-<ID></ID>">
   <div class="card card-body p-4 space-y-4" style="<DISPLAY-QRIS></DISPLAY-QRIS>">
     <div class="text-center">
       <h2 class="text-xl font-bold">Pembayaran via QRIS</h2>
     </div>
     <div class="bg-white shadow-md rounded-xl p-6 text-center space-y-4">
       <img src="https://localhost/FrameworkServer_V1/R.png" alt="QRIS" class="mx-auto w-48 h-48 object-contain m-3">
       <div class="text-lg font-semibold">Harga: Rp <NONIMAL></NONIMAL>
       </div>

     </div>
   </div>

   <div class="card card-body p-4 space-y-4" style="<DISPLAY-MANUAL></DISPLAY-MANUAL>">
     <!-- Informasi Transfer -->
     <div class="bg-white shadow-md rounded-xl p-6 text-center space-y-3">
       <h3 class="text-lg font-bold">Transfer Manual ke Bank</h3>
       <div class="text-base">Bank: <strong>
           <BANK></BANK>
         </strong></div>
       <div class="text-base">No Rekening: <strong><NO-REK></NO-REK></strong></div>
       <div class="text-base">Atas Nama: <strong><ATAS-NAMA></ATAS-NAMA></strong></div>
       <div class="text-base">Nominal Total: <strong>Rp <NONIMAL></NONIMAL></strong></div>
     </div>

     <!-- Form Konfirmasi -->
     <div class="bg-white shadow-md rounded-xl p-6 space-y-4">
       <h4 class="text-lg font-semibold">Konfirmasi Pembayaran</h4>


       <label>Bank</label>
       <input type="text" placeholder="Bank" id="konfirm_bayar-bank-<ID></ID>" class="w-full border rounded p-2 form-control" style="margin-bottom: 10px;">

       <label>Atas Nama</label>
       <input type="text" placeholder="Atas Nama" id="konfirm_bayar-an-<ID></ID>" class="w-full border rounded p-2 form-control" style="margin-bottom: 10px;">

       <label>Nomor Rekening</label>
       <input type="text" placeholder="No Rekening" id="konfirm_bayar-norek-<ID></ID>" class="w-full border rounded p-2 form-control" style="margin-bottom: 10px;">
       <label>Nominal</label>
       <input type="number" placeholder="Nominal" id="konfirm_bayar-nominal-<ID></ID>" value="<NONIMAL></NONIMAL>" class="w-full border rounded p-2 form-control" style="margin-bottom: 10px;">
       <label>Tanggal bayar</label>
       <input type="date" placeholder="Tanggal bayar" id="konfirm_bayar-tanggal-<ID></ID>" value="<DATE-NOW></DATE-NOW>" class="w-full border rounded p-2 form-control" style="margin-bottom: 10px;" value="">
       <label>File Pembayaran</label>
       <input type="file" class="w-full border rounded p-2 form-control" id="konfirm_bayar-file-<ID></ID>" style="margin-bottom: 10px;">
       <button class="w-full btn btn-primary text-white rounded p-2 font-semibold " onclick="proses_cek_bayar();" type="button">Kirim Konfirmasi</button>

     </div>
   </div>

   <div class="card card-body p-4 space-y-4" style="<DISPLAY-VA></DISPLAY-VA>">
     <!-- Informasi Transfer -->
     <div class="card center">
       <div class="card-title">Pembayaran via Virtual Account</div>
       <div class="text-normal">Bank: <strong>
           <BANK></BANK>
         </strong></div>
       <div class="va-number">
         <VA_NUMBER></VA_NUMBER>
       </div>
       <div class="va-number">Rp. <NONIMAL></NONIMAL>
       </div>
     </div>

     <!-- Card Instruksi -->
     <div class="card bg-gray instructions ">
       <div class="card-title">Instruksi Pembayaran:</div>
       <ol>
         <li>Buka aplikasi mobile banking Anda.</li>
         <li>Pilih menu "Bayar" atau "Transfer".</li>
         <li>Pilih bank tujuan dan masukkan nomor VA di atas.</li>
         <li>Pastikan nama dan nominal sesuai.</li>
         <li>Konfirmasi dan selesaikan transaksi.</li>
       </ol>
     </div>
   </div>
 </form>
