import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';

export default class RecapStockUI extends OrderSystemBuilder {
    constructor() {
        super();
        this.products = [];
        this.filteredProducts = [];
        this.currentTab = 'all';

        // Data arrays
        this.stockOpnameData = [];
        this.outgoingData = [];
        this.receivingData = [];
        this.warehouseRackData = [];

        // DOM Elements
        this.stockTableBody = null;
        this.lowStockTableBody = null;
        this.outStockTableBody = null;
        this.movementTableBody = null;
        this.namaBarangTableBody = null;
        this.namaVarianTableBody = null;
        this.idProdukTableBody = null;
        this.idProdukVarianTableBody = null;
        this.idApiTableBody = null;
        this.gudangTableBody = null;
        this.rakTableBody = null;
        this.historyTableBody = null;
        this.detailHistoryTableBody = null;

        this.adjustStockModal = null;
        this.detailModal = null;
        this.adjustStockForm = null;
        this.quickAdjustBtn = null;
        this.quickTransferBtn = null;
        this.quickOrderBtn = null;
        this.quickReportBtn = null;
        this.closeModalBtns = null;

        // Current filter values
        this.currentSearch = '';
        this.currentGudang = '';
        this.currentLocation = '';
        this.currentLimit = 10;
        this.currentOffset = 0;
        this.currentPage = 1;

        // Debounce timeout
        this.searchTimeout = null;
    }

    async init() {
        await this.loadDataFromAPI();
        this.render();
        this.initializeDOMElements();
        this.renderStockTable();
        this.populateAdjustProductSelect();
        this.setupEventListeners();
        this.filterProducts();
    }

    // Initialize DOM Elements after render
    initializeDOMElements() {
        this.stockTableBody = document.getElementById('stockTableBody');
        this.lowStockTableBody = document.getElementById('lowStockTableBody');
        this.outStockTableBody = document.getElementById('outStockTableBody');
        this.movementTableBody = document.getElementById('movementTableBody');
        this.namaBarangTableBody = document.getElementById('namaBarangTableBody');
        this.namaVarianTableBody = document.getElementById('namaVarianTableBody');
        this.idProdukTableBody = document.getElementById('idProdukTableBody');
        this.idProdukVarianTableBody = document.getElementById('idProdukVarianTableBody');
        this.idApiTableBody = document.getElementById('idApiTableBody');
        this.gudangTableBody = document.getElementById('gudangTableBody');
        this.rakTableBody = document.getElementById('rakTableBody');
        this.historyTableBody = document.getElementById('historyTableBody');
        this.detailHistoryTableBody = document.getElementById('detailHistoryTableBody');

        this.adjustStockModal = document.getElementById('adjustStockModal');
        this.detailModal = document.getElementById('detailModal');
        this.adjustStockForm = document.getElementById('adjustStockForm');
        this.quickAdjustBtn = document.getElementById('quickAdjustBtn');
        this.quickTransferBtn = document.getElementById('quickTransferBtn');
        this.quickOrderBtn = document.getElementById('quickOrderBtn');
        this.quickReportBtn = document.getElementById('quickReportBtn');
        this.closeModalBtns = document.querySelectorAll('.close-modal');
    }

    // Load data from API
    async loadDataFromAPI() {
        try {
            // Simulate API calls - in a real app, you would use fetch or axios
            // For demonstration, we'll use the provided data
            this.orderSystemJson = await this.loadData(["warehouse_racks"]);
            // Process stock opname data
            // this.stockOpnameData = this.orderSystemJson.stok_opname;

            // // Process outgoing data
            // this.outgoingData =  this.orderSystemJson.outgoings;;

            // // Process receiving data
            // this.receivingData = this.orderSystemJson.receivings;;

            // // Process warehouse rack data
            this.warehouseRackData = this.orderSystemJson.warehouseRacks;
            console.log("this.warehouseRackData", this.warehouseRackData);
            // Products will be loaded in filterProducts

        } catch (error) {
            console.error('Error loading data from API:', error);
            alert('Terjadi kesalahan saat memuat data dari API');
        }
    }


    // Process API data to create products array
    async processDataToProducts(params = {}) {
        let whereClause = [];
        if (params.search) {

            whereClause.push({
                fields: ['nama_varian',"nama_barang"],
                operator: 'like_or_fields',
                value: `%${params.search}%`
            });
           
        }
        if (params.gudang) {
            whereClause.push({
                fields: 'nama_gudang',
                operator: '=',
                value: params.gudang
            });
        }
        if (params.location) {
            whereClause.push({
                fields: 'nama_ruang_simpan',
                operator: '=',
                value: params.location
            });
        }
        const queryBody = {
            db: 'view_all_produk_stok_per_gudang',
            limit: params.limit || 10,
            where: whereClause,
            offset: params.offset || 0,
            search: params.search || '',
            gudang: params.gudang || '',
            location: params.location || ''
        };
        let data_produk = await window.fai.getModule('Data').loadJSON('view_all_produk_stok_per_gudang', queryBody, true);
        this.paginationProduct = data_produk;
        this.initPagination();
        return data_produk.data;
    }
    render() {
        let gudangOptions = '<option value="">Semua Gudang</option>';
        let locationOptions = '<option value="">Semua Lokasi</option>';
        let adjustLocationOptions = '<option value="">Pilih Lokasi</option>';
        if (this.warehouseRackData) {
            let gudangs = [...new Set(this.warehouseRackData.map(r => r.nama_gudang))];
            gudangs.forEach(g => {
                gudangOptions += `<option value="${g}">${g}</option>`;
            });
            this.warehouseRackData.forEach(rack => {
                locationOptions += `<option value="${rack.nama_ruang_simpan}">${rack.nama_ruang_simpan}</option>`;
                adjustLocationOptions += `<option value="${rack.nama_ruang_simpan}">${rack.nama_ruang_simpan}</option>`;
            });
        }

        let HTML = `
        <div class="admin-container d-block" >
            <div class="admin-content">
                <div class="admin-header">
                    <h2 class="admin-title">Rekapitulasi Stok Barang</h2>
                    <div class="admin-actions">
                        <button class="btn btn-primary" id="generateReportBtn">
                            <i class="fas fa-file-pdf"></i> Generate Stok
                        </button>
                        <button class="btn btn-success" id="exportExcelBtn">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        
                    </div>
                </div>
                
                <div class="filter-section">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label class="filter-label">Cari Produk</label>
                            <input type="text" class="filter-input" id="searchProduct" placeholder="Nama atau SKU produk">
                        </div>
                        
                        <div class="filter-group">
                            <label class="filter-label">Gudang</label>
                            <select class="filter-select" id="gudangFilter">
                                ${gudangOptions}
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-label">Lokasi</label>
                            <select class="filter-select" id="locationFilter">
                                ${locationOptions}
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="stats-cards">
                    <div class="stat-card total">
                        <div class="stat-title">Total Produk</div>
                        <div class="stat-value" id="totalProducts">0</div>
                        <div class="stat-change positive" id="totalChange">+0% dari bulan lalu</div>
                    </div>
                    <div class="stat-card good">
                        <div class="stat-title">Stok Baik</div>
                        <div class="stat-value" id="goodStock">0</div>
                        <div class="stat-change positive" id="goodChange">+0%</div>
                    </div>
                    <div class="stat-card medium">
                        <div class="stat-title">Stok Sedang</div>
                        <div class="stat-value" id="mediumStock">0</div>
                        <div class="stat-change negative" id="mediumChange">-0%</div>
                    </div>
                    <div class="stat-card low">
                        <div class="stat-title">Stok Rendah</div>
                        <div class="stat-value" id="lowStock">0</div>
                        <div class="stat-change negative" id="lowChange">-0%</div>
                    </div>
                </div>
                
                <div class="dashboard-grid d-none">
                    <div class="chart-container">
                        <div class="chart-title">Trend Stok 30 Hari Terakhir</div>
                        <div class="chart-placeholder">
                            <i class="fas fa-chart-bar" style="font-size: 48px; margin-right: 15px;"></i>
                            <div>
                                <p>Grafik trend stok akan ditampilkan di sini</p>
                                <small>Data historis stok barang selama 30 hari terakhir</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-actions">
                        <div class="action-card" id="quickAdjustBtn">
                            <div class="action-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="action-title">Koreksi Stok</div>
                            <div class="action-desc">Perbaiki selisih stok fisik</div>
                        </div>
                        <div class="action-card" id="quickTransferBtn">
                            <div class="action-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div class="action-title">Transfer Stok</div>
                            <div class="action-desc">Pindahkan stok antar gudang</div>
                        </div>
                        <div class="action-card" id="quickOrderBtn">
                            <div class="action-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="action-title">Pesan Stok</div>
                            <div class="action-desc">Buat PO untuk stok rendah</div>
                        </div>
                        <div class="action-card" id="quickReportBtn">
                            <div class="action-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="action-title">Laporan Cepat</div>
                            <div class="action-desc">Generate laporan stok</div>
                        </div>
                    </div>
                </div>
                
                <div class="tabs">
                    <div class="tab active" data-tab="all">Semua Stok</div>
                    
                    <div class="tab " data-tab="nama-barang">Berdasarkan Nama Barang</div>
                    <div class="tab d-none" data-tab="nama-varian" >Berdasarkan Nama Varian</div>
                    <div class="tab" data-tab="id-produk">Berdasarkan ID Produk</div>
                    <div class="tab" data-tab="id-produk-varian">Berdasarkan ID Produk Varian</div>
                    <div class="tab d-none" data-tab="id-api">Berdasarkan ID API</div>
                    <div class="tab" data-tab="gudang">Berdasarkan Gudang</div>
                    <div class="tab" data-tab="rak">Berdasarkan Rak</div>
                    <div class="tab d-none" data-tab="history">History</div>
                </div>
                
                <div id="tab-all" class="tab-content active">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>SKU</th>
                                    <th>Lokasi</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Status</th>
                                    <th>Trend</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="stockTableBody">
                                <!-- Stock items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Other tab contents remain the same -->
                <div id="tab-low" class="tab-content">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        <strong>Perhatian:</strong> Beberapa produk memiliki stok rendah dan perlu dipesan segera.
                    </div>
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>SKU</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Stok Minimum</th>
                                    <th>Kekurangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="lowStockTableBody">
                                <!-- Low stock items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                 <div id="tab-out" class="tab-content">
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle"></i> 
                        <strong>Peringatan:</strong> Beberapa produk telah habis dan perlu segera di-restock.
                    </div>
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>SKU</th>
                                    <th>Terakhir Tersedia</th>
                                    <th>Hari Habis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="outStockTableBody">
                                <!-- Out of stock items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-movement" class="tab-content">
                    <div class="filter-section" style="margin-top: 0;">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Periode</label>
                                <select class="filter-select" id="periodFilter">
                                    <option value="7">7 Hari Terakhir</option>
                                    <option value="30" selected>30 Hari Terakhir</option>
                                    <option value="90">90 Hari Terakhir</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Jenis Pergerakan</label>
                                <select class="filter-select" id="movementTypeFilter">
                                    <option value="">Semua Jenis</option>
                                    <option value="in">Stok Masuk</option>
                                    <option value="out">Stok Keluar</option>
                                    <option value="adjust">Koreksi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Stok Sebelum</th>
                                    <th>Stok Sesudah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="movementTableBody">
                                <!-- Movement items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Tab baru untuk klasifikasi -->
                <div id="tab-nama-barang" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Varian</th>
                                    <th>Total Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="namaBarangTableBody">
                                <!-- Data akan diisi berdasarkan nama barang -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-nama-varian" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Nama Varian</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="namaVarianTableBody">
                                <!-- Data akan diisi berdasarkan nama varian -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-id-produk" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>ID Produk</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Varian</th>
                                    <th>Total Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="idProdukTableBody">
                                <!-- Data akan diisi berdasarkan ID produk -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-id-produk-varian" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>ID Produk Varian</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Varian</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="idProdukVarianTableBody">
                                <!-- Data akan diisi berdasarkan ID produk varian -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-id-api" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>ID API</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Varian</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="idApiTableBody">
                                <!-- Data akan diisi berdasarkan ID API -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-gudang" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Nama Gudang</th>
                                    <th>Jumlah Produk</th>
                                    <th>Total Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="gudangTableBody">
                                <!-- Data akan diisi berdasarkan gudang -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-rak" class="tab-content">
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Nama Rak</th>
                                    <th>Gudang</th>
                                    <th>Jumlah Produk</th>
                                    <th>Total Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="rakTableBody">
                                <!-- Data akan diisi berdasarkan rak -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="tab-history" class="tab-content">
                    <div class="filter-section" style="margin-top: 0;">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Periode</label>
                                <select class="filter-select" id="historyPeriodFilter">
                                    <option value="7">7 Hari Terakhir</option>
                                    <option value="30" selected>30 Hari Terakhir</option>
                                    <option value="90">90 Hari Terakhir</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Jenis Transaksi</label>
                                <select class="filter-select" id="historyTypeFilter">
                                    <option value="">Semua Jenis</option>
                                    <option value="in">Stok Masuk</option>
                                    <option value="out">Stok Keluar</option>
                                    <option value="adjust">Koreksi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stock-table-container">
                        <table class="stock-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Produk</th>
                                    <th>Varian</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                <!-- Data history akan diisi di sini -->
                            </tbody>
                        </table>
                    </div>
             
            </div>
            <div id="pagination-container"></div>
        </div>
        
        <!-- Modal Detail View -->
        <div class="modal" id="detailModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-info-circle"></i> Detail Produk</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="detail-view">
                        <div class="detail-header">
                            <div class="detail-title" id="detailProductName">Nama Produk</div>
                            <div class="status-badge" id="detailProductStatus">Status</div>
                        </div>
                        <div class="detail-info">
                            <div class="info-item">
                                <span class="info-label">SKU</span>
                                <span class="info-value" id="detailSKU">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Stok Saat Ini</span>
                                <span class="info-value" id="detailCurrentStock">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Stok Minimum</span>
                                <span class="info-value" id="detailMinStock">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Stok Maksimum</span>
                                <span class="info-value" id="detailMaxStock">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Lokasi</span>
                                <span class="info-value" id="detailLocation">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kategori</span>
                                <span class="info-value" id="detailCategory">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">ID Produk</span>
                                <span class="info-value" id="detailProductId">-</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">ID Varian</span>
                                <span class="info-value" id="detailVariantId">-</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="chart-title">Riwayat Pergerakan Stok</div>
                    <div class="stock-table-container">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Stok Sebelum</th>
                                    <th>Stok Sesudah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detailHistoryTableBody">
                                <!-- History items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Koreksi Stok -->
        <div class="modal" id="adjustStockModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-edit"></i> Koreksi Stok</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="adjustStockForm">
                        <div class="form-group">
                            <label class="form-label">Produk</label>
                            <select class="form-select" id="adjustProduct" required>
                                <option value="">Pilih Produk</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Lokasi</label>
                            <select class="form-select" id="adjustLocation" required>
                                ${adjustLocationOptions}
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Stok Sistem</label>
                            <input type="number" class="form-input" id="adjustSystemStock" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Stok Fisik</label>
                            <input type="number" class="form-input" id="adjustPhysicalStock" min="0" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Selisih</label>
                            <input type="number" class="form-input" id="adjustDifference" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alasan Koreksi</label>
                            <select class="form-select" id="adjustReason" required>
                                <option value="">Pilih Alasan</option>
                                <option value="stock_opname">Stock Opname</option>
                                <option value="kerusakan">Kerusakan Barang</option>
                                <option value="hilang">Barang Hilang</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-textarea" id="adjustNotes" placeholder="Keterangan tambahan"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger close-modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Koreksi</button>
                        </div>
                    </form>
                </div>
            </div>
               
        </div>
        
        <div class="footer">
            <p>Recap Stock Management System </p>
        </div>
    </div>
`;
        document.getElementById('pages_content').innerHTML = HTML;
    }

    // Get warehouse name by ID
    getWarehouseName(warehouseId, warehouseRackData) {
        if (!warehouseId) return "Unknown";
        console.log(warehouseId);
        const warehouse = warehouseRackData.find(w => parseInt(w.id_inventaris__asset__tanah__gudang) === parseInt(warehouseId));
        return warehouse ? warehouse.nama_gudang : "Unknown";
    }

    // Get stock status based on current stock, min stock, and max stock
    getStockStatus(currentStock, minStock, maxStock) {
        if (currentStock === 0) return "out";
        if (currentStock < minStock) return "low";
        if (currentStock < maxStock * 0.7) return "medium";
        return "good";
    }

    // Setup event listeners
    setupEventListeners() {
        // Filter events
        document.getElementById('searchProduct').addEventListener('input', () => {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => this.filterProducts(), 500);
        });
        document.getElementById('gudangFilter').addEventListener('change', () => this.updateLocationOptions());
        document.getElementById('locationFilter').addEventListener('change', () => this.filterProducts());
        document.getElementById('periodFilter').addEventListener('change', () => this.renderMovementTable());
        document.getElementById('movementTypeFilter').addEventListener('change', () => this.renderMovementTable());
        document.getElementById('historyPeriodFilter').addEventListener('change', () => this.renderHistoryTable());
        document.getElementById('historyTypeFilter').addEventListener('change', () => this.renderHistoryTable());

        // Tab switching
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(`tab-${tab.dataset.tab}`).classList.add('active');

                this.currentTab = tab.dataset.tab;
                // Render appropriate table
                switch (this.currentTab) {
                    case 'all':
                        this.renderStockTable();
                        break;
                    case 'low':
                        this.renderLowStockTable();
                        break;
                    case 'out':
                        this.renderOutStockTable();
                        break;
                    case 'movement':
                        this.renderMovementTable();
                        break;
                    case 'nama-barang':
                        this.renderNamaBarangTable();
                        break;
                    case 'nama-varian':
                        this.renderNamaVarianTable();
                        break;
                    case 'id-produk':
                        this.renderIdProdukTable();
                        break;
                    case 'id-produk-varian':
                        this.renderIdProdukVarianTable();
                        break;
                    case 'id-api':
                        this.renderIdApiTable();
                        break;
                    case 'gudang':
                        this.renderGudangTable();
                        break;
                    case 'rak':
                        this.renderRakTable();
                        break;
                    case 'history':
                        this.renderHistoryTable();
                        break;
                }
            });
        });



        // Quick actions
        this.quickAdjustBtn.addEventListener('click', () => {
            this.adjustStockModal.style.display = 'block';
        });

        this.quickTransferBtn.addEventListener('click', () => {
            alert('Fitur Transfer Stok akan dibuka');
        });

        this.quickOrderBtn.addEventListener('click', () => {
            alert('Fitur Pesan Stok akan dibuka');
        });

        this.quickReportBtn.addEventListener('click', () => {
            alert('Fitur Laporan Cepat akan dibuka');
        });

        // Modal events
        this.closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                this.adjustStockModal.style.display = 'none';
                this.detailModal.style.display = 'none';
            });
        });

        // Adjust stock form
        this.adjustStockForm.addEventListener('submit', (e) => this.handleAdjustStock(e));

        // Real-time calculation for adjustment
        document.getElementById('adjustPhysicalStock').addEventListener('input', () => this.calculateDifference());

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === this.adjustStockModal) {
                this.adjustStockModal.style.display = 'none';
            }
            if (e.target === this.detailModal) {
                this.detailModal.style.display = 'none';
            }
        });

        // Action buttons
        // document.getElementById('generateReportBtn').addEventListener('click', () => this.generateReport());
        document.getElementById('exportExcelBtn').addEventListener('click', () => this.exportExcel());
        // document.getElementById('refreshBtn').addEventListener('click', () => this.refreshData());

    }

    // Render main stock table
    renderStockTable() {
        let tableHTML = '';

        this.filteredProducts.forEach(product => {
            const statusClass = this.getStatusClass(product.status);
            const statusText = this.getStatusText(product.status);
            const trend = this.getTrend(product.total_terjual_varian);
            const trendClass = this.getTrendClass(trend);
            const trendIcon = this.getTrendIcon(trend);

            // Calculate stock percentage for bar
            const stockPercentage = (product.stok_available / product.maxStock) * 100;
            const barClass = this.getBarClass(stockPercentage);

            tableHTML += `
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-img">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">${product.nama_barang}</div>
                                <div class="product-sku">${product.nama_varian}</div>
                            </div>
                        </div>
                    </td>
                    <td>${product.barcode_varian}</td>
                    <td>${product.nama_ruang_simpan}</td>
                    <td>
                        <div class="stock-level">
                            <div class="stock-bar">
                                <div class="stock-fill ${barClass}"></div>
                            </div>
                            <div class="stock-value">${product.stok_available}</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge ${statusClass}">${statusText}</span>
                    </td>
                    <td>
                        <span class="${trendClass}">
                            <i class="fas ${trendIcon}"></i> ${product.total_terjual_varian}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-adjust" onclick="this.adjustProductStock(${product.id})">
                                <i class="fas fa-edit"></i> Koreksi
                            </button>
                            <button class="action-btn btn-transfer" onclick="this.transferProductStock(${product.id})">
                                <i class="fas fa-exchange-alt"></i> Transfer
                            </button>
                            <button class="action-btn btn-detail" onclick="this.viewProductDetail(${product.id})">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });

        this.stockTableBody.innerHTML = tableHTML;
    }

    // Render low stock table
    renderLowStockTable() {
        const lowStockProducts = this.products.filter(p => p.status === 'low' || p.status === 'out');
        let tableHTML = '';

        lowStockProducts.forEach(product => {
            const shortage = product.minStock - product.stok_available;

            tableHTML += `
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-img">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="product-info">
                                <div class="product-name">${product.nama_barang}</div>
                                <div class="product-sku">${product.sku}</div>
                            </div>
                        </div>
                    </td>
                    <td>${product.sku}</td>
                    <td>${product.stok_available}</td>
                    <td>${product.minStock}</td>
                    <td>${shortage > 0 ? shortage : 0}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-adjust" onclick="this.adjustProductStock(${product.id})">
                                <i class="fas fa-edit"></i> Koreksi
                            </button>
                            <button class="action-btn btn-detail" onclick="this.viewProductDetail(${product.id})">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="action-btn btn-success" onclick="this.orderProductStock(${product.id})">
                                <i class="fas fa-cart-plus"></i> Pesan
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });

        this.lowStockTableBody.innerHTML = tableHTML;
    }

    // Update statistics
   

    // Filter products
    async filterProducts() {
        this.currentSearch = document.getElementById('searchProduct').value.toLowerCase();
        this.currentGudang = document.getElementById('gudangFilter').value;
        this.currentLocation = document.getElementById('locationFilter').value;

        const params = {
            search: this.currentSearch,
            gudang: this.currentGudang,
            location: this.currentLocation,
            limit: this.currentLimit,
            offset: this.currentOffset
        };

        this.products = await this.processDataToProducts(params);
        this.filteredProducts = [...this.products];
        this.renderStockTable();
        this.updateStats();
        // this.initPagination();
    }

    // Update location options based on selected gudang
    updateLocationOptions() {
        const selectedGudang = document.getElementById('gudangFilter').value;
        let locationOptions = '<option value="">Semua Lokasi</option>';
        let filteredRacks = selectedGudang ? this.warehouseRackData.filter(r => r.nama_gudang === selectedGudang) : this.warehouseRackData;
        filteredRacks.forEach(rack => {
            locationOptions += `<option value="${rack.nama_ruang_simpan}">${rack.nama_ruang_simpan}</option>`;
        });
        document.getElementById('locationFilter').innerHTML = locationOptions;
        this.filterProducts();
    }

    // Initialize pagination
    initPagination() {

        this.pagination = window.fai.getModule('Pagination').init({
            container: 'pagination-container',
            totalItems: this.paginationProduct.total,
            pageSize: this.currentLimit,
            currentPage: this.currentPage,
            onPageChange: (info) => {
                this.currentOffset = (info.currentPage - 1) * this.currentLimit;
                this.currentPage = info.currentPage;
                this.filterProducts();
            },
            onPageSizeChange: (newSize) => {
                this.currentLimit = newSize.limit;
                this.currentOffset = 0;
                this.filterProducts();
            }
        });
    }

    // Populate adjust product select
    populateAdjustProductSelect() {
        const select = document.getElementById('adjustProduct');
        let optionsHTML = '<option value="">Pilih Produk</option>';

        this.products.forEach(product => {
            optionsHTML += `<option value="${product.id}">${product.nama_barang} (${product.sku})</option>`;
        });

        select.innerHTML = optionsHTML;

        // Add event listener to update system stock when product is selected
        select.addEventListener('change', (e) => {
            const productId = e.target.value;
            const product = this.products.find(p => p.id == productId);

            if (product) {
                document.getElementById('adjustSystemStock').value = product.stok_available;
                document.getElementById('adjustPhysicalStock').value = product.stok_available;
                this.calculateDifference();
            }
        });
    }

    // Calculate difference between system and physical stock
    calculateDifference() {
        const systemStock = parseInt(document.getElementById('adjustSystemStock').value) || 0;
        const physicalStock = parseInt(document.getElementById('adjustPhysicalStock').value) || 0;
        const difference = physicalStock - systemStock;

        document.getElementById('adjustDifference').value = difference;
    }

    // Handle adjust stock form submission
    handleAdjustStock(e) {
        e.preventDefault();

        const productId = document.getElementById('adjustProduct').value;
        const location = document.getElementById('adjustLocation').value;
        const systemStock = parseInt(document.getElementById('adjustSystemStock').value);
        const physicalStock = parseInt(document.getElementById('adjustPhysicalStock').value);
        const reason = document.getElementById('adjustReason').value;
        const notes = document.getElementById('adjustNotes').value;

        if (!productId || !location || !reason) {
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        // Find product
        const product = this.products.find(p => p.id == productId);
        if (!product) {
            alert('Produk tidak ditemukan!');
            return;
        }

        // Update product stock
        const difference = physicalStock - systemStock;
        product.stok_available = physicalStock;

        // Update product status based on new stock level
        const stockPercentage = (product.stok_available / product.maxStock) * 100;
        if (product.stok_available === 0) {
            product.status = 'out';
        } else if (stockPercentage < 30) {
            product.status = 'low';
        } else if (stockPercentage < 70) {
            product.status = 'medium';
        } else {
            product.status = 'good';
        }

        // Update UI
        this.renderStockTable();
        this.updateStats();
        this.adjustStockModal.style.display = 'none';
        this.adjustStockForm.reset();

        alert(`Stok ${product.nama_barang} berhasil dikoreksi!`);
    }

    // View product detail
    viewProductDetail(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            // Update modal content
            document.getElementById('detailProductName').textContent = product.nama_barang;
            document.getElementById('detailProductStatus').textContent = this.getStatusText(product.status);
            document.getElementById('detailProductStatus').className = `status-badge ${this.getStatusClass(product.status)}`;
            document.getElementById('detailSKU').textContent = product.sku;
            document.getElementById('detailCurrentStock').textContent = product.stok_available;
            document.getElementById('detailMinStock').textContent = product.minStock;
            document.getElementById('detailMaxStock').textContent = product.maxStock;
            document.getElementById('detailLocation').textContent = product.nama_ruang_simpan;
            document.getElementById('detailCategory').textContent = product.category;
            document.getElementById('detailProductId').textContent = product.id_produk || '-';
            document.getElementById('detailVariantId').textContent = product.id_varian || '-';

            // Show modal
            this.detailModal.style.display = 'block';
        }
    }

    // Adjust product stock (from action button)
    adjustProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            document.getElementById('adjustProduct').value = product.id;
            document.getElementById('adjustSystemStock').value = product.stok_available;
            document.getElementById('adjustPhysicalStock').value = product.stok_available;
            document.getElementById('adjustLocation').value = product.nama_ruang_simpan;
            this.calculateDifference();

            this.adjustStockModal.style.display = 'block';
        }
    }

    // Transfer product stock (from action button)
    transferProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            alert(`Transfer stok untuk ${product.nama_barang} akan dilakukan`);
            // In a real app, this would open a transfer modal
        }
    }

    // Order product stock (from action button)
    orderProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            const quantity = prompt(`Jumlah yang ingin dipesan untuk ${product.nama_barang}:`, product.minStock - product.stok_available);
            if (quantity && quantity > 0) {
                alert(`PO untuk ${quantity} ${product.nama_barang} akan dibuat`);
                // In a real app, this would create a purchase order
            }
        }
    }

    // Generate report
    generateReport() {
        alert('Laporan rekapitulasi stok akan di-generate dalam format PDF');
        // In a real app, this would generate a PDF report
    }

    // Export to Excel
    async exportExcel() {
        const queryBody = {
            db: 'view_all_produk_stok_per_gudang',
            isExcel: true,
            where: this.buildWhereClause(),
            select:["nama_gudang",
"nama_ruang_simpan",
"nama_barang",
"deskripsi_barang",
"barcode",
"foto_aset",
"nama_toko",
"deskripsi_all_produk",
"nama_varian",
"sku_index_varian",
"foto_aset_varian",
"nama_tipe_tipe1",
"nama_tipe_tipe2",
"nama_tipe_tipe3",
"nama_list_tipe_varian_varian1",
"nama_list_tipe_varian_varian",
"nama_list_tipe_varian_varian3",
"berat_varian",
"berat",
"barcode_varian",
"harga_pokok_penjualan_varian",
"harga_pokok",
"total_terjual_varian",
"stok_available"]
        };
        try {
            const response = await fetch('/api/json', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(queryBody),
            });

            if (response.ok) {
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'export_' + new Date().toISOString().slice(0, 19).replace(/:/g, '') + '.xlsx';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } else {
                alert('Failed to export Excel');
            }
        } catch (error) {
            console.error('Error exporting Excel:', error);
            alert('Error exporting Excel');
        }
    }

    // Build where clause for API
    buildWhereClause() {
        let whereClause = [];
        if (this.currentSearch) {
            whereClause.push({
                fields: ['nama_varian', "nama_barang"],
                operator: 'like_or_fields',
                value: `%${this.currentSearch}%`
            });
        }
        if (this.currentGudang) {
            whereClause.push({
                fields: 'nama_gudang',
                operator: '=',
                value: this.currentGudang
            });
        }
        if (this.currentLocation) {
            whereClause.push({
                fields: 'nama_ruang_simpan',
                operator: '=',
                value: this.currentLocation
            });
        }
        return whereClause;
    }

    // Refresh data
    refreshData() {
        // Simulate data refresh
        alert('Data stok diperbarui');
        this.loadDataFromAPI().then(() => {
            this.renderStockTable();
            this.updateStats();
        });
    }

    // Get status class
    getStatusClass(status) {
        const statusClasses = {
            'good': 'status-good',
            'medium': 'status-medium',
            'low': 'status-low',
            'out': 'status-out'
        };

        return statusClasses[status] || 'status-medium';
    }

    // Get status text

    getStatusText(status) {
        const statusTexts = {
            'good': 'Baik',
            'medium': 'Sedang',
            'low': 'Rendah',
            'out': 'Habis'
        };

        return statusTexts[status] || 'Sedang';
    }
    getTrend(status) {
        const trendClasses = {
            'up': 'trend-up',
            'down': 'trend-down',
            'neutral': 'trend-neutral'
        };
        if (status > 0) {
            return 'up';
        } else
            if (status == 0) {
                return 'neutral';
            } else {
                return 'down';
            }

        return trendClasses[trend] || 'trend-neutral';
    }
    // Get trend class
    getTrendClass(trend) {
        const trendClasses = {
            'up': 'trend-up',
            'down': 'trend-down',
            'neutral': 'trend-neutral'
        };

        return trendClasses[trend] || 'trend-neutral';
    }

    // Get trend icon
    getTrendIcon(trend) {
        const trendIcons = {
            'up': 'fa-arrow-up',
            'down': 'fa-arrow-down',
            'neutral': 'fa-minus'
        };

        return trendIcons[trend] || 'fa-minus';
    }

    // Get bar class based on percentage
    getBarClass(percentage) {
        if (percentage >= 70) return 'full';
        if (percentage >= 40) return 'good';
        if (percentage >= 20) return 'medium';
        return 'low';
    }

    // Placeholder methods for other table renders
    renderOutStockTable() {
        const outStockProducts = this.products.filter(p => p.status === 'out');
        let tableHTML = '';

        outStockProducts.forEach(product => {
            const lastDate = new Date(product.lastMovement);
            const today = new Date();
            const daysOut = Math.floor((today - lastDate) / (1000 * 60 * 60 * 24));

            tableHTML += `
                    <tr>
                        <td>
                            <div class="product-cell">
                                <div class="product-img">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="product-info">
                                    <div class="product-name">${product.nama_barang}</div>
                                    <div class="product-sku">${product.sku}</div>
                                </div>
                            </div>
                        </td>
                        <td>${product.sku}</td>
                        <td>${new Date(product.lastMovement).toLocaleDateString('id-ID')}</td>
                        <td>${daysOut} hari</td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-detail" onclick="viewProductDetail(${product.id})">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <button class="action-btn btn-success" onclick="orderProductStock(${product.id})">
                                    <i class="fas fa-cart-plus"></i> Pesan
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
        });
        // Implementation for out of stock table
        this.outStockTableBody.innerHTML = tableHTML
    }

    renderMovementTable() {
        // Implementation for movement table
        this.movementTableBody.innerHTML = `<tr><td colspan="7" style="text-align: center;">Data pergerakan stok akan ditampilkan di sini</td></tr>`;
    }

    renderNamaBarangTable() {
    const groupedProducts = {};

    this.products.forEach(product => {
        if (!groupedProducts[product.nama_barang]) {
            groupedProducts[product.nama_barang] = {};
        }

        const varianKey = product.nama_varian;

        if (!groupedProducts[product.nama_barang][varianKey]) {
            groupedProducts[product.nama_barang][varianKey] = {
                ...product,
                stok_available: parseFloat(product.stok_available)
            };
        } else {
            groupedProducts[product.nama_barang][varianKey].stok_available += parseFloat(product.stok_available);
        }
    });

    let tableHTML = '';

    Object.keys(groupedProducts).forEach(namaBarang => {
        const uniqueVariants = Object.values(groupedProducts[namaBarang]);

        const totalStock = uniqueVariants.reduce(
            (sum, product) => sum + product.stok_available,
            0
        );

        const status = this.getStockStatus(totalStock, 5, 50);

        tableHTML += `
            <tr>
                <td>${namaBarang}</td>
                <td>${uniqueVariants.length}</td>
                <td>${totalStock}</td>
                <td>
                    <span class="status-badge ${this.getStatusClass(status)}">
                        ${this.getStatusText(status)}
                    </span>
                </td>
                <td>
                    <button class="action-btn btn-detail"
                        onclick="viewProductsByNamaBarang('${namaBarang}')">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </button>
                </td>
            </tr>
        `;
    });

    document.getElementById('namaBarangTableBody').innerHTML = tableHTML;
}


    renderNamaVarianTable() {
        // Implementation for nama varian table
        const productsWithVarian = this.products.filter(p => p.nama_varian);

        let tableHTML = '';

        productsWithVarian.forEach(product => {
            tableHTML += `
                    <tr>
                        <td>${product.nama_varian}</td>
                        <td>${product.nama_barang}</td>
                        <td>${product.stok_available}</td>
                        <td>
                            <span class="status-badge ${this.getStatusClass(product.status)}">${this.getStatusText(product.status)}</span>
                        </td>
                        <td>
                            <button class="action-btn btn-detail" onclick="viewProductDetail(${product.id})">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                `;
        });

        this.namaVarianTableBody.innerHTML = tableHTML;
    }

    renderIdProdukTable() {
        // Implementation for ID produk table
        const groupedProducts = {};
        this.products.forEach(product => {
            if (product.id) {
                if (!groupedProducts[product.id]) {
                    groupedProducts[product.id] = [];
                }
                groupedProducts[product.id].push(product);
            }
        });

        let tableHTML = '';

        Object.keys(groupedProducts).forEach(idProduk => {
            const productsInGroup = groupedProducts[idProduk];
            const totalStock = productsInGroup.reduce((sum, product) => sum + parseFloat(product.stok_available), 0);

            tableHTML += `
                    <tr>
                        <td>${idProduk}</td>
                        <td>${productsInGroup[0].nama_barang}</td>
                        <td>${productsInGroup.length}</td>
                        <td>${totalStock}</td>
                        <td>
                            <button class="action-btn btn-detail" onclick="viewProductsByIdProduk('${idProduk}')">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        </td>
                    </tr> 

                    
                `;
        });
        this.idProdukTableBody.innerHTML = tableHTML;
    }

    renderIdProdukVarianTable() {
        const productsWithIdProdukVarian = this.products.filter(p => p.id_produk_varian);

        let tableHTML = '';

        productsWithIdProdukVarian.forEach(product => {
            tableHTML += `
                    <tr>
                        <td>${product.id_produk_varian}</td>
                        <td>${product.nama_barang}</td>
                        <td>${product.nama_varian || '-'}</td>
                        <td>${product.stok_available}</td>
                        <td>
                            <button class="action-btn btn-detail" onclick="viewProductDetail(${product.id})">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                `;
        });
        // Implementation for ID produk varian table
        this.idProdukVarianTableBody.innerHTML = tableHTML;
    }

    renderIdApiTable() {
        const productsWithIdApi = this.products.filter(p => p.id_api || p.id_api_varian);

        let tableHTML = '';

        productsWithIdApi.forEach(product => {
            const idApi = product.id_from_api_varian || product.id_from_api;

            tableHTML += `
                    <tr>
                        <td>${idApi}</td>
                        <td>${product.nama_barang}</td>
                        <td>${product.nama_varian || '-'}</td>
                        <td>${product.stok_available}</td>
                        <td>
                            <button class="action-btn btn-detail" onclick="viewProductDetail(${product.id})">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                `;
        });
        // Implementation for ID API table
        this.idApiTableBody.innerHTML = tableHTML;
    }

    renderGudangTable() {
        // Implementation for gudang table
        const groupedProducts = {};
        this.products.forEach(product => {
            if (!groupedProducts[product.nama_gudang]) {
                groupedProducts[product.nama_gudang] = [];
            }
            groupedProducts[product.nama_gudang].push(product);
        });

        let tableHTML = '';

        Object.keys(groupedProducts).forEach(location => {
            const productsInGroup = groupedProducts[location];
            const totalStock = productsInGroup.reduce((sum, product) => sum + parseFloat(product.stok_available), 0);
            const status = this.getStockStatus(totalStock, 5, 50); // Using default min/max

            tableHTML += `
                    <tr>
                        <td>${location}</td>
                        <td>${productsInGroup.length}</td>
                        <td>${totalStock}</td>
                        <td>
                            <span class="status-badge ${this.getStatusClass(status)}">${this.getStatusText(status)}</span>
                        </td>
                        <td>
                            <button class="action-btn btn-detail" onclick="this.viewProductsByLocation('${location}')">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        </td>
                    </tr>
                `;
        });
        this.gudangTableBody.innerHTML = tableHTML;
    }

    renderRakTable() {
        const groupedProducts = {};
        this.products.forEach(product => {
            if (!groupedProducts[product.nama_ruang_simpan]) {
                groupedProducts[product.nama_ruang_simpan] = [];
            }
            groupedProducts[product.nama_ruang_simpan].push(product);
        });

        let tableHTML = '';

        Object.keys(groupedProducts).forEach(location => {
            const productsInGroup = groupedProducts[location];
            const totalStock = productsInGroup.reduce((sum, product) => sum + parseFloat(product.stok_available), 0);
            const status = this.getStockStatus(totalStock, 5, 50); // Using default min/max

            tableHTML += `
                    <tr>
                        <td>${location}</td>
                        <td>${productsInGroup.length}</td>
                        <td>${totalStock}</td>
                        <td>
                            <span class="status-badge ${this.getStatusClass(status)}">${this.getStatusText(status)}</span>
                        </td>
                        <td>
                           <!-- <button class="action-btn btn-detail" onclick="this.viewProductsByLocation('${location}')">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>-->
                        </td>
                    </tr>
                `;
        });
        this.rakTableBody.innerHTML = tableHTML;
        }

    renderHistoryTable() {
        // Implementation for history table
        this.historyTableBody.innerHTML = `<tr><td colspan="6" style="text-align: center;">Data history akan ditampilkan di sini</td></tr>`;
    }
     updateStats() {
        const totalProducts = this.paginationProduct.total;
       
        const goodStock = this.products.filter(p => p.stok_available >= 50).length;
        const mediumStock = this.products.filter(p => p.stok_available >= 11 && p.stok_available <= 49).length;
        const lowStock = this.products.filter(p => p.stok_available >= 1 && p.stok_available <= 10 ).length;
        const outStock = this.products.filter(p => p.stok_available <= 0).length;

        // Calculate changes (simulated)
        const totalChange = Math.floor(Math.random() * 10) - 2;
        const goodChange = Math.floor(Math.random() * 15) - 5;
        const mediumChange = Math.floor(Math.random() * 10) - 8;
        const lowChange = Math.floor(Math.random() * 10) - 5;

        document.getElementById('totalProducts').textContent = totalProducts;
        document.getElementById('goodStock').textContent = goodStock;
        document.getElementById('mediumStock').textContent = mediumStock;
        document.getElementById('lowStock').textContent = lowStock + outStock;

        document.getElementById('totalChange').textContent = `${totalChange >= 0 ? '+' : ''}${totalChange}% dari bulan lalu`;
        document.getElementById('goodChange').textContent = `${goodChange >= 0 ? '+' : ''}${goodChange}%`;
        document.getElementById('mediumChange').textContent = `${mediumChange >= 0 ? '+' : ''}${mediumChange}%`;
        document.getElementById('lowChange').textContent = `${lowChange >= 0 ? '+' : ''}${lowChange}%`;

        // Update change colors
        document.getElementById('totalChange').className = `stat-change ${totalChange >= 0 ? 'positive' : 'negative'}`;
        document.getElementById('goodChange').className = `stat-change ${goodChange >= 0 ? 'positive' : 'negative'}`;
        document.getElementById('mediumChange').className = `stat-change ${mediumChange >= 0 ? 'positive' : 'negative'}`;
        document.getElementById('lowChange').className = `stat-change ${lowChange >= 0 ? 'positive' : 'negative'}`;
    }
    

    // Filter products
    async filterProducts() {
        this.currentSearch = document.getElementById('searchProduct').value.toLowerCase();
        this.currentGudang = document.getElementById('gudangFilter').value;
        this.currentLocation = document.getElementById('locationFilter').value;

        const params = {
            search: this.currentSearch,
            gudang: this.currentGudang,
            location: this.currentLocation,
            limit: this.currentLimit,
            offset: this.currentOffset
        };

        this.products = await this.processDataToProducts(params);
        this.filteredProducts = [...this.products];
        this.renderStockTable();
        this.updateStats();
        if (this.pagination) {
            this.pagination.updateTotal(this.paginationProduct.total);
        }
    }

    // Populate adjust product select
    populateAdjustProductSelect() {
        const select = document.getElementById('adjustProduct');
        let optionsHTML = '<option value="">Pilih Produk</option>';

        this.products.forEach(product => {
            optionsHTML += `<option value="${product.id}">${product.nama_barang} (${product.sku})</option>`;
        });

        select.innerHTML = optionsHTML;

        // Add event listener to update system stock when product is selected
        select.addEventListener('change', (e) => {
            const productId = e.target.value;
            const product = this.products.find(p => p.id == productId);

            if (product) {
                document.getElementById('adjustSystemStock').value = product.stok_available;
                document.getElementById('adjustPhysicalStock').value = product.stok_available;
                calculateDifference();
            }
        });
    }

    // Calculate difference between system and physical stock
    calculateDifference() {
        const systemStock = parseInt(document.getElementById('adjustSystemStock').value) || 0;
        const physicalStock = parseInt(document.getElementById('adjustPhysicalStock').value) || 0;
        const difference = physicalStock - systemStock;

        document.getElementById('adjustDifference').value = difference;
    }

    // Handle adjust stock form submission
    handleAdjustStock(e) {
        e.preventDefault();

        const productId = document.getElementById('adjustProduct').value;
        const location = document.getElementById('adjustLocation').value;
        const systemStock = parseInt(document.getElementById('adjustSystemStock').value);
        const physicalStock = parseInt(document.getElementById('adjustPhysicalStock').value);
        const reason = document.getElementById('adjustReason').value;
        const notes = document.getElementById('adjustNotes').value;

        if (!productId || !location || !reason) {
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        // Find product
        const product = this.products.find(p => p.id == productId);
        if (!product) {
            alert('Produk tidak ditemukan!');
            return;
        }

        // Update product stock
        const difference = physicalStock - systemStock;
        product.stok_available = physicalStock;

        // Update product status based on new stock level
        const stockPercentage = (product.stok_available / product.maxStock) * 100;
        if (product.stok_available === 0) {
            product.status = 'out';
        } else if (stockPercentage < 30) {
            product.status = 'low';
        } else if (stockPercentage < 70) {
            product.status = 'medium';
        } else {
            product.status = 'good';
        }

        // Update UI
        renderStockTable();
        updateStats();
        adjustStockModal.style.display = 'none';
        adjustStockForm.reset();

        alert(`Stok ${product.nama_barang} berhasil dikoreksi!`);
    }

    // View product detail
    viewProductDetail(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            // Update modal content
            document.getElementById('detailProductName').textContent = product.nama_barang;
            document.getElementById('detailProductStatus').textContent = getStatusText(product.status);
            document.getElementById('detailProductStatus').className = `status-badge ${this.getStatusClass(product.status)}`;
            document.getElementById('detailSKU').textContent = product.sku;
            document.getElementById('detailCurrentStock').textContent = product.stok_available;
            document.getElementById('detailMinStock').textContent = product.minStock;
            document.getElementById('detailMaxStock').textContent = product.maxStock;
            document.getElementById('detailLocation').textContent = product.nama_ruang_simpan;
            document.getElementById('detailCategory').textContent = product.category;
            document.getElementById('detailProductId').textContent = product.id_produk || '-';
            document.getElementById('detailVariantId').textContent = product.id_varian || '-';

            // Show modal
            detailModal.style.display = 'block';
        }
    }

    // View products by nama barang
    viewProductsByNamaBarang(namaBarang) {
        const filteredProducts = this.products.filter(p => p.name === namaBarang);
        // This would open a modal or navigate to a detail view
        alert(`Menampilkan ${filteredProducts.length} produk dengan nama "${namaBarang}"`);
    }

    // View products by ID produk
    viewProductsByIdProduk(idProduk) {
        const filteredProducts = this.products.filter(p => p.id_produk == idProduk);
        // This would open a modal or navigate to a detail view
        alert(`Menampilkan ${filteredProducts.length} produk dengan ID Produk "${idProduk}"`);
    }

    // View products by location
    viewProductsByLocation(location) {
        const filteredProducts = this.products.filter(p => p.location === location);
        // This would open a modal or navigate to a detail view
        alert(`Menampilkan ${filteredProducts.length} produk di lokasi "${location}"`);
    }

    // Adjust product stock (from action button)
    adjustProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            document.getElementById('adjustProduct').value = product.id;
            document.getElementById('adjustSystemStock').value = product.stok_available;
            document.getElementById('adjustPhysicalStock').value = product.stok_available;
            document.getElementById('adjustLocation').value = product.nama_ruang_simpan;
            calculateDifference();

            adjustStockModal.style.display = 'block';
        }
    }

    // Transfer product stock (from action button)
    transferProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            alert(`Transfer stok untuk ${product.nama_barang} akan dilakukan`);
            // In a real app, this would open a transfer modal
        }
    }

    // Order product stock (from action button)
    orderProductStock(productId) {
        const product = this.products.find(p => p.id === productId);
        if (product) {
            const quantity = prompt(`Jumlah yang ingin dipesan untuk ${product.nama_barang}:`, product.minStock - product.stok_available);
            if (quantity && quantity > 0) {
                alert(`PO untuk ${quantity} ${product.nama_barang} akan dibuat`);
                // In a real app, this would create a purchase order
            }
        }
    }

    // Generate report
    generateReport() {
        alert('Laporan rekapitulasi stok akan di-generate dalam format PDF');
        // In a real app, this would generate a PDF report
    }

    // Export to Excel
   

    // Refresh data
    refreshData() {
        // Simulate data refresh
        alert('Data stok diperbarui');
        loadDataFromAPI().then(() => {
            renderStockTable();
            updateStats();
        });
    }

    // Get status class
    getStatusClass(status) {
        const statusClasses = {
            'good': 'status-good',
            'medium': 'status-medium',
            'low': 'status-low',
            'out': 'status-out'
        };

        return statusClasses[status] || 'status-medium';
    }

    // Get status text
    getStatusText(status) {
        const statusTexts = {
            'good': 'Baik',
            'medium': 'Sedang',
            'low': 'Rendah',
            'out': 'Habis'
        };

        return statusTexts[status] || 'Sedang';
    }

    // Get trend class
    getTrendClass(trend) {
        const trendClasses = {
            'up': 'trend-up',
            'down': 'trend-down',
            'neutral': 'trend-neutral'
        };

        return trendClasses[trend] || 'trend-neutral';
    }

    // Get trend icon
    getTrendIcon(trend) {
        const trendIcons = {
            'up': 'fa-arrow-up',
            'down': 'fa-arrow-down',
            'neutral': 'fa-minus'
        };

        return trendIcons[trend] || 'fa-minus';
    }

    // Get bar class based on percentage
    getBarClass(percentage) {
        if (percentage >= 70) return 'full';
        if (percentage >= 40) return 'good';
        if (percentage >= 20) return 'medium';
        return 'low';
    }
}