<div class="">
    <h2>Dashboard Desty Manual Stok</h2>

    <div class="card">
        <div class="card-header">1. Upload File Excel</div>
        <form id="uploadForm">
            <label for="excel_file" style="display:block; margin-bottom:5px; font-weight:500;">Pilih File (.xls / .xlsx)</label>
            <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" required>
            <button type="button" onclick="upload_desty()">Upload & Simpan</button>
        </form>
        <div id="result" style="margin-top:10px; font-weight:500;"></div>
    </div>

    <div class="card">
        <div class="card-header">2. Panel Kontrol Proses</div>

        <label for="nama_file" style="font-weight:500;">Nama File (System):</label>
        <input type="text" name="nama_file" id="nama_file" placeholder="Nama file akan muncul otomatis setelah upload...">

        <div class="btn-group-label">Inisiasi & Sync Utama</div>
        <div class="action-buttons">
            <button type="button" onclick="klik_proses_excel()">roses ke Database</button>
            <button type="button" onclick="klik_inventory()">Generate Inventoris</button>
            <button type="button" onclick="klik_sync_utama()">Sync Utama</button>
            <button type="button" onclick="klik_sync_varian()">Sync Varian</button>
            <button type="button" onclick="klik_inisiasi()">Inisiasi Data</button>
        </div>

        <div class="btn-group-label">Generate Stok</div>
        <div class="action-buttons">
            <button type="button" onclick="klik_stok('warna')" style="background-color: #6366f1;">Stok Warna</button>
            <button type="button" onclick="klik_stok('sarimbit')" style="background-color: #8b5cf6;">Stok Sarimbit</button>
            <button type="button" onclick="klik_stok('artikel')" style="background-color: #ec4899;">Stok Artikel</button>
            <button type="button" onclick="klik_stok('barang')" style="background-color: #14b8a6;">Stok Barang</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">3. Log Aktivitas & Status</div>

        <div class="log-container">
            <div class="log-item" style="border-left-color: #2563eb;">
                <span class="log-title">Step 2: Proses Excel ke Database</span>
                <div id="proses_excel" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #0d9488;">
                <span class="log-title">Step 3: Inisiasi Inventaris List</span>
                <div id="inisiasi_inventaris" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #f59e0b;">
                <span class="log-title">Step 4.1: Sync Utama</span>
                <div id="sync_utama" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #f59e0b;">
                <span class="log-title">Step 4.2: Sync Varian</span>
                <div id="sync_varian" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #dc2626;">
                <span class="log-title">Step 5: Menginisiasi Data</span>
                <div id="inisiasi" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #6366f1;">
                <span class="log-title">Step 6.1: Generate Stok Warna</span>
                <div id="stok_warna" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #8b5cf6;">
                <span class="log-title">Step 6.2: Generate Stok Sarimbit</span>
                <div id="stok_sarimbit" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #ec4899;">
                <span class="log-title">Step 6.3: Generate Stok Artikel</span>
                <div id="stok_artikel" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #14b8a6;">
                <span class="log-title">Step 6.4: Generate Stok Barang</span>
                <div id="stok_barang" class="log-content">Waiting...</div>
            </div>

            <div class="log-item" style="border-left-color: #10b981;">
                <span class="log-title">Step 7: Download Excel</span>
                <div id="Download Excel" class="log-content">Waiting...</div>
            </div>
        </div>
    </div>

</div>