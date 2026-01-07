<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --secondary-color: #64748b;
        --success-color: #10b981;
        --bg-color: #f1f5f9;
        --card-bg: #ffffff;
        --text-color: #1e293b;
        --border-color: #e2e8f0;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
        margin: 0;
        padding: 20px;
        line-height: 1.5;
    }

  

    h2 {
        color: var(--text-color);
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Card Styling */
    .card {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        padding: 24px;
        margin-bottom: 20px;
    }

    .card-header {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 16px;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 10px;
        color: var(--primary-color);
    }

    /* Form Styling */
    input[type="file"],
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        box-sizing: border-box;
        display: block;
    }

    input[type="file"] {
        background: #f8fafc;
    }

    /* Button Grid */
    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        margin-top: 15px;
    }

    button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
        font-size: 0.9rem;
        width: 100%;
    }

    button:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    button[type="submit"] {
        background-color: var(--success-color);
        font-weight: 600;
    }

    /* Grouping Logic Buttons */
    .btn-group-label {
        font-size: 0.85rem;
        color: var(--secondary-color);
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    /* Log / Status Area */
    .log-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .log-item {
        background: #f8fafc;
        border-left: 4px solid var(--secondary-color);
        padding: 15px;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .log-title {
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
        color: var(--text-color);
    }

    .log-content {
        font-family: monospace;
        color: #334155;
        min-height: 20px;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .action-buttons {
            grid-template-columns: 1fr;
        }
    }
    /* --- Style Khusus Tabel Sync Utama --- */
    
    /* Reset Table Style */
    #sync_utama table {
        width: 100%;
        border-collapse: collapse; /* Menghilangkan border ganda jadul */
        margin-top: 15px;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden; /* Supaya sudut rounded tidak tertutup header */
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        font-size: 0.9rem;
    }

    /* Header Table */
    #sync_utama th {
        background-color: #f8fafc; /* Abu-abu sangat muda */
        color: #334155; /* Abu-abu gelap */
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }

    /* Body Rows */
    #sync_utama td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle; /* Supaya teks & dropdown sejajar vertikal */
        color: #475569;
    }

    /* Hover Effect pada Baris */
    #sync_utama tr:hover td {
        background-color: #f1f5f9;
    }

    /* Kolom Nomor (Kecilkan lebar) */
    #sync_utama td:first-child {
        width: 40px;
        text-align: center;
        font-weight: bold;
        color: #94a3b8;
    }

    /* Kolom Nama Barang (Highlight) */
    #sync_utama td:nth-child(2) {
        font-weight: 500;
        color: #1e293b;
        max-width: 250px; /* Batasi lebar agar tidak terlalu panjang */
        line-height: 1.4;
    }

    /* Kolom Suggest (Warna beda agar user notice) */
    #sync_utama td:nth-child(3) {
        color: #2563eb; /* Biru */
        font-style: italic;
    }

    /* --- KUSTOMISASI SELECT2 (Dropdown) --- */
    /* Mengubah tampilan default Select2 agar sesuai tema */
    
    /* Container Select2 */
    #sync_utama .select2-container {
        width: 100% !important; /* Paksa lebar penuh kolom */
        min-width: 200px;
    }

    /* Kotak Pilihan Utama */
    #sync_utama .select2-container .select2-selection--single {
        height: 40px !important; /* Tinggi lebih nyaman disentuh */
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        display: flex !important;
        align-items: center !important;
        background-color: #fff;
    }

    /* Teks di dalam pilihan */
    #sync_utama .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 12px !important;
        padding-right: 25px !important;
        color: #334155 !important;
        font-size: 0.9rem;
        line-height: normal !important;
    }

    /* Panah Dropdown */
    #sync_utama .select2-container .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        right: 5px !important;
    }

    /* Saat Dropdown Terbuka/Aktif */
    #sync_utama .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #2563eb !important; /* Border biru saat aktif */
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    /* Dropdown List (Pilihan saat dibuka) */
    .select2-dropdown {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        padding: 5px 0;
    }

    .select2-results__option {
        padding: 8px 12px !important;
        font-size: 0.9rem;
    }

    /* Pilihan yang disorot */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #2563eb !important;
        color: white !important;
    }
</style>
<style>
    /* --- Container Utama untuk Scroll Horizontal --- */
    #sync_varian {
        width: 100%;
        overflow-x: auto; /* KUNCI: Mengaktifkan scroll ke samping */
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        /* Padding bottom agar scrollbar tidak menempel ke konten */
        padding-bottom: 10px; 
    }

    /* Kustomisasi Scrollbar (Opsional - agar terlihat manis) */
    #sync_varian::-webkit-scrollbar {
        height: 10px;
    }
    #sync_varian::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    #sync_varian::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    #sync_varian::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* --- Styling Tabel --- */
    #sync_varian table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1400px; /* Paksa lebar minimal agar scrollbar muncul jika layar kecil */
        font-size: 0.85rem;
    }

    /* Header Table */
    #sync_varian th {
        background-color: #f8fafc;
        color: #1e293b;
        font-weight: 600;
        padding: 12px 10px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap; /* Header tidak boleh turun baris */
        
        /* Sticky Header (Agar header tetap terlihat saat scroll ke bawah) */
        position: sticky;
        top: 0;
        z-index: 10;
    }

    /* Isi Table (Body) */
    #sync_varian td {
        padding: 10px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: top; /* Konten rata atas agar rapi */
        color: #475569;
    }

    #sync_varian tr:hover td {
        background-color: #f8fafc;
    }

    /* --- Styling Kolom Spesifik --- */
    
    /* Kolom No */
    #sync_varian td:nth-child(1) {
        width: 40px;
        text-align: center;
        font-weight: bold;
    }

    /* Kolom Nama Barang (Boleh wrap text) */
    #sync_varian td:nth-child(2) {
        min-width: 250px;
        line-height: 1.4;
    }

    /* Kolom Asset Sync & Info (Highlight) */
    #sync_varian td:nth-child(6) {
        background-color: #fdfbf7; /* Sedikit kuning tipis */
        font-family: monospace;
        font-size: 0.8rem;
    }

    /* Kolom Dropdown Select2 (Lebarkan) */
    #sync_varian td:nth-child(7),
    #sync_varian td:nth-child(8) {
        min-width: 280px; /* Memberi ruang napas untuk dropdown */
    }

    /* --- Styling Tombol Aksi (Action Buttons) --- */
    /* Mengoverride style global button width: 100% sebelumnya */
    
    #sync_varian button {
        width: auto !important; /* Tombol menyesuaikan isi teks */
        display: inline-block;
        padding: 6px 10px;
        margin: 2px;
        font-size: 0.75rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    /* Warna Tombol Berbeda */
    #sync_varian button[onclick*="Sync Single"] {
        background-color: #2563eb; /* Biru */
        color: white;
    }
    
    #sync_varian button[onclick*="Sync Multiple"] {
        background-color: #7c3aed; /* Ungu */
        color: white;
    }

    #sync_varian button[onclick*="loaddata"] {
        background-color: #059669; /* Hijau */
        color: white;
    }

    #sync_varian button[onclick*="CARI INPUT"] {
        background-color: #d97706; /* Oranye */
        color: white;
    }

    #sync_varian button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    /* Input Text Pencarian */
    #sync_varian input[type="text"] {
        width: calc(100% - 10px);
        padding: 6px;
        margin-top: 5px;
        margin-bottom: 5px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    /* Fix Select2 Overflow inside Table */
    .select2-container {
        width: 100% !important;
        margin-bottom: 5px;
    }
</style>