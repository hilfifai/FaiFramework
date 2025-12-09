import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';
export default class SalesOrderUI extends OrderSystemBuilder {
    constructor() {
        super();
        // Sample data for products
        this.products = [
        ];

        // Sample data for customers
        this.customers = [
            {
                id: 1,
                name: "Ahmad Rizki",
                phone: "08123456789",
                email: "ahmad@example.com",
                addresses: [
                    { id: 1, address: "Jl. Merdeka No. 123, Jakarta Pusat", isPrimary: true },
                    { id: 2, address: "Jl. Sudirman No. 456, Jakarta Selatan", isPrimary: false }
                ]
            },
            {
                id: 2,
                name: "Siti Nurhaliza",
                phone: "08234567890",
                email: "siti@example.com",
                addresses: [
                    { id: 3, address: "Jl. Thamrin No. 789, Jakarta Pusat", isPrimary: true }
                ]
            },
            {
                id: 3,
                name: "Budi Santoso",
                phone: "08345678901",
                email: "budi@example.com",
                addresses: [
                    { id: 4, address: "Jl. Gatot Subroto No. 321, Jakarta Selatan", isPrimary: true },
                    { id: 5, address: "Jl. HR Rasuna Said No. 654, Jakarta Selatan", isPrimary: false }
                ]
            }
        ];

        // Sample data for sales channels
        this.salesChannels = {
            online: ["Website Toko", "Aplikasi Mobile"],
            marketplace: ["Tokopedia", "Shopee", "Bukalapak", "Blibli", "Lazada"],
            offline: ["Toko Utama", "Toko Cabang", "Pameran"],
            corporate: ["Sales Corporate", "Tender", "Kerjasama"]
        };

        // Sample data for sales orders
        this.salesOrders = [];
        // Global variables
        this.apiBaseUrl = window.fai.getModule('base_url');
        this.currentSo = null;
        this.filteredSalesOrders = [...this.salesOrders];
        this.currentStep = 1;
        this.selectedCustomer = null;
        this.scannedProducts = [];
        this.scannerActive = false;
        this.stream = null;

    }

    async init(config) {
        this.config = config;
        await this.GetloadData();
        this.render();
        this.renderSoList();
        this.updateStats();
        this.setupEventListeners();
    }
    async GetloadData() {
        try {
            this.orderSystemJson = await this.loadData(["warehouse_racks", "sales_orders", "payments", "outgoings", "delivery_orders"]);
            console.log(this.orderSystemJson);
            this.warehouseRacks = this.orderSystemJson.warehouseRacks || [];
            this.outgoings = this.orderSystemJson.outgoings || [];
            this.payments = this.orderSystemJson.payments || [];
            this.deliveryOrders = this.orderSystemJson.deliveryOrders || [];
            this.salesOrders = this.orderSystemJson.salesOrders || [];
            this.filteredPurchaseOrders = this.orderSystemJson.filteredPurchaseOrders || [];
            this.filteredSalesOrders = this.orderSystemJson.filteredSalesOrders || [];
            console.log()






        } catch (error) {
            console.error('Error loading data:', error);

        }

    }


    render() {
        const HTML = `
        <div class="admin-container">
		<div class="admin-content">
                <!-- SO List View -->
                <div id="soListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Sales Order</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="addSoBtn">
                                <i class="fas fa-plus"></i> Buat SO
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                            <button class="btn btn-info">
                                <i class="fas fa-sync-alt"></i> Sync Marketplace
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari SO</label>
                                <input type="text" class="filter-input" id="searchSo" placeholder="ID SO atau Pelanggan">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Dikonfirmasi</option>
                                    <option value="processing">Diproses</option>
                                    <option value="shipped">Dikirim</option>
                                    <option value="delivered">Terkirim</option>
                                    <option value="completed">Selesai</option>
                                    <option value="cancelled">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Sumber</label>
                                <select class="filter-select" id="sourceFilter">
                                    <option value="">Semua Sumber</option>
                                    <option value="online">Online</option>
                                    <option value="marketplace">Marketplace</option>
                                    <option value="offline">Offline</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Tanggal Mulai</label>
                                <input type="date" class="filter-input" id="startDate">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Tanggal Akhir</label>
                                <input type="date" class="filter-input" id="endDate">
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-title">Total SO</div>
                            <div class="stat-value" id="totalSos">0</div>
                        </div>
                        <div class="stat-card pending">
                            <div class="stat-title">Pending</div>
                            <div class="stat-value" id="pendingSos">0</div>
                        </div>
                        <div class="stat-card processing">
                            <div class="stat-title">Diproses</div>
                            <div class="stat-value" id="processingSos">0</div>
                        </div>
                        <div class="stat-card shipped">
                            <div class="stat-title">Dikirim</div>
                            <div class="stat-value" id="shippedSos">0</div>
                        </div>
                        <div class="stat-card completed">
                            <div class="stat-title">Selesai</div>
                            <div class="stat-value" id="completedSos">0</div>
                        </div>
                    </div>
                    
                    <div class="orders-table-container">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID SO</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Sumber</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="soTableBody">
                                <!-- SOs will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- SO Detail View -->
                <div id="soDetailView" class="so-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Sales Order: <span id="detailSoId"></span></h2>
                        <div class="admin-actions">
                            <button class="btn btn-info" id="printInvoiceBtn">
                                <i class="fas fa-print"></i> Cetak Invoice
                            </button>
                            <button class="btn btn-warning" id="editSoBtn">
                                <i class="fas fa-edit"></i> Edit SO
                            </button>
                            <button class="btn btn-success" id="processSoBtn">
                                <i class="fas fa-cog"></i> Proses
                            </button>
                        </div>
                    </div>
                    
                    <div class="so-info">
                        <div class="info-card">
                            <div class="info-card-title">Informasi SO</div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal SO:</span>
                                <span class="info-value" id="infoSoDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Sumber:</span>
                                <span class="info-value" id="infoSource"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Channel:</span>
                                <span class="info-value" id="infoChannel"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Catatan:</span>
                                <span class="info-value" id="infoNotes"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pelanggan</div>
                            <div class="info-item">
                                <span class="info-label">Nama:</span>
                                <span class="info-value" id="infoCustomerName"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Telepon:</span>
                                <span class="info-value" id="infoCustomerPhone"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value" id="infoCustomerEmail"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alamat:</span>
                                <span class="info-value" id="infoCustomerAddress"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pengiriman</div>
                            <div class="info-item">
                                <span class="info-label">Kurir:</span>
                                <span class="info-value" id="infoShippingCourier"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Layanan:</span>
                                <span class="info-value" id="infoShippingService"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Resi:</span>
                                <span class="info-value" id="infoTrackingNumber"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoShippingStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alamat:</span>
                                <span class="info-value" id="infoShippingAddress"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pembayaran</div>
                            <div class="info-item">
                                <span class="info-label">Metode:</span>
                                <span class="info-value" id="infoPaymentMethod"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoPaymentStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Total:</span>
                                <span class="info-value" id="infoPaymentTotal"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal Bayar:</span>
                                <span class="info-value" id="infoPaymentDate"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tabs">
                        <div class="tab active" data-tab="items">Item Pesanan</div>
                        <div class="tab" data-tab="outgoing">Outgoing</div>
                        <div class="tab" data-tab="payment">Payment</div>
                        <div class="tab" data-tab="shipping">Delivery Order</div>
                        <div class="tab" data-tab="retur_outgoing">Retur Outgoing</div>
                        <div class="tab" data-tab="refund">Refund</div>
                        <div class="tab" data-tab="history">Riwayat</div>
                    </div>
                    
                    <div id="tab-items" class="tab-content active">
                        <h3>Daftar Item Pesanan</h3>
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="soItemsList">
                                <!-- Items will be populated here -->
                            </tbody>
                        </table>
                        
                        <table class="summary-table">
                            <tr>
                                <td>Subtotal</td>
                                <td id="itemsSubtotal">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Diskon</td>
                                <td id="itemsDiscount">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Biaya Pengiriman</td>
                                <td id="itemsShipping">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Pajak</td>
                                <td id="itemsTax">Rp 0</td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong id="itemsTotal">Rp 0</strong></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="tab-outgoing" class="tab-content">
                        <h3>Outgoing - Pengeluaran Barang</h3>
                        <button class="btn btn-primary" id="addOutgoingBtn">
                            <i class="fas fa-plus"></i> Tambah Outgoing
                        </button>
                        
                        <div id="outgoingList">
                            <!-- Outgoing cards will be populated here -->
                        </div>
                    </div>
                    
                    <div id="tab-shipping" class="tab-content">
                        <h3>Delivery Order - Pengiriman</h3>
                        <button class="btn btn-primary" id="addDeliveryBtn">
                            <i class="fas fa-plus"></i> Tambah Delivery Order
                        </button>
                        
                        <div id="deliveryList">
                            <!-- Delivery order cards will be populated here -->
                        </div>
                    </div>
                    
                    <div id="tab-payment" class="tab-content">
                        <h3>Payment - Pembayaran</h3>
                        <button class="btn btn-primary" id="addPaymentBtn">
                            <i class="fas fa-plus"></i> Tambah Pembayaran
                        </button>
                        
                        <div id="paymentList">
                            <!-- Payment cards will be populated here -->
                        </div>
                    </div>
                    
                    <div id="tab-retur_outgoing" class="tab-content">
                        <h3>Retur Outgoing - Retur Barang</h3>
                        <button class="btn btn-primary" id="addReturBtn">
                            <i class="fas fa-plus"></i> Tambah Retur
                        </button>
                        
                        <div id="returList">
                            <!-- Retur cards will be populated here -->
                        </div>
                    </div>
                    
                    <div id="tab-refund" class="tab-content">
                        <h3>Refund - Pengembalian Dana</h3>
                        <button class="btn btn-primary" id="addRefundBtn">
                            <i class="fas fa-plus"></i> Tambah Refund
                        </button>
                        
                        <div id="refundList">
                            <!-- Refund cards will be populated here -->
                        </div>
                    </div>
                    
                    <div id="tab-history" class="tab-content">
                        <h3>Riwayat Sales Order</h3>
                        <div class="timeline" id="soTimeline">
                            <!-- Timeline will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
			<div class="modal" id="soModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-file-invoice-dollar"></i> <span id="modalTitle">Buat Sales Order</span></h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Step 1: Pilih Sumber Penjualan -->
                    <div id="step1" class="step-container active">
                        <div class="step-header">
                            <div class="step-number">1</div>
                            <div class="step-title">Pilih Sumber Penjualan</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Sumber Penjualan</label>
                            <div class="so-type-selector">
                                <div class="so-type-card" data-source="online">
                                    <div class="so-type-icon" style="color: var(--online);">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="so-type-title">Online</div>
                                    <div class="so-type-desc">Penjualan melalui website toko</div>
                                </div>
                                <div class="so-type-card" data-source="marketplace">
                                    <div class="so-type-icon" style="color: var(--marketplace);">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="so-type-title">Marketplace</div>
                                    <div class="so-type-desc">Tokopedia, Shopee, Bukalapak, dll</div>
                                </div>
                                <div class="so-type-card" data-source="offline">
                                    <div class="so-type-icon" style="color: var(--offline);">
                                        <i class="fas fa-store-alt"></i>
                                    </div>
                                    <div class="so-type-title">Offline</div>
                                    <div class="so-type-desc">Penjualan di toko fisik</div>
                                </div>
                                <div class="so-type-card" data-source="corporate">
                                    <div class="so-type-icon" style="color: var(--corporate);">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="so-type-title">Corporate</div>
                                    <div class="so-type-desc">Penjualan ke perusahaan</div>
                                </div>
                            </div>
                            <input type="hidden" id="selectedSource" required>
                        </div>
                        
                        <div id="channelGroup" class="form-group" style="display: none;">
                            <label class="form-label">Channel</label>
                            <select class="form-select" id="salesChannel">
                                <option value="">Pilih Channel</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="step-actions">
                            <button type="button" class="btn btn-danger close-modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="nextToStep2">Selanjutnya</button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Pilih Pelanggan -->
                    <div id="step2" class="step-container">
                        <div class="step-header">
                            <div class="step-number">2</div>
                            <div class="step-title">Pilih Pelanggan</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Cari Pelanggan</label>
                            <div class="customer-search">
                                <input type="text" class="form-input" id="customerSearch" placeholder="Cari pelanggan...">
                                <div class="customer-results" id="customerResults"></div>
                            </div>
                        </div>
                        
                        <div id="selectedCustomer" class="selected-customer" style="display: none;">
                            <!-- Selected customer will appear here -->
                        </div>
                        
                        <div class="step-actions">
                            <button type="button" class="btn btn-secondary" id="backToStep1">Kembali</button>
                            <button type="button" class="btn btn-primary" id="nextToStep3">Selanjutnya</button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Pilih Produk -->
                    <div id="step3" class="step-container">
                        <div class="step-header">
                            <div class="step-number">3</div>
                            <div class="step-title">Pilih Produk</div>
                        </div>
                        
                        <!-- Scanner View -->
                        <div id="scannerView">
                            <div class="scanner-container">
                                <div class="scanner-preview" id="scannerPreview">
                                    <video id="scannerVideo" style="width: 100%; height: 300px; border: 2px dashed #ccc;"></video>
                                    <canvas id="scannerCanvas" style="display: none;"></canvas>
                                    <div id="scannerOverlay" class="scanner-overlay">
                                        <div class="scan-line"></div>
                                    </div>
                                </div>
                                <div class="scanner-controls">
                                    <button class="btn btn-primary" id="startCamera">
                                        <i class="fas fa-camera"></i> Aktifkan Kamera
                                    </button>
                                    <button class="btn btn-secondary" id="stopCamera" disabled>
                                        <i class="fas fa-stop"></i> Matikan Kamera
                                    </button>
                                    <button class="btn btn-info" id="toggleFlash" style="display: none;">
                                        <i class="fas fa-lightbulb"></i> Flash
                                    </button>
                                </div>
                                <div class="scanner-input">
                                    <input type="text" id="manualBarcode" placeholder="Masukkan barcode manual" style="flex: 1;">
                                    <button class="btn btn-info" id="addManualBarcode">
                                        <i class="fas fa-keyboard"></i> Tambah Manual
                                    </button>
                                </div>
                                <div class="scanner-status" id="scannerResult"></div>
                                <div class="scanner-status" id="scannerStatus">
                                    <i class="fas fa-info-circle"></i> Arahkan kamera ke barcode produk
                                </div>
                            </div>
                            
                            <!-- Product Search Section -->
                            <div class="product-search-section">
                                <h3>Cari Produk Manual</h3>
                                <div class="search-controls">
                                    <input type="text" 
                                           id="productSearchInput" 
                                           class="form-input" 
                                           placeholder="Cari by nama produk atau barcode..."
                                           data-action="product-search">
                                    <button class="btn btn-primary" data-action="search-product">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <button class="btn btn-outline-secondary" data-action="show-all-products">
                                        <i class="fas fa-list"></i> Semua Produk
                                    </button>
                                </div>
                                <div id="productSearchResults" class="search-results">
                                    <div class="search-placeholder">
                                        <i class="fas fa-box-open"></i>
                                        <p>Klik "Semua Produk" untuk melihat daftar produk</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="scanned-products">
                                <h3>Produk Ter-Scan <span class="badge" id="scannedCount">0</span></h3>
                                <div id="scannedProductsList" class="scanned-list">
                                    <div class="empty-state">Belum ada produk yang di-scan</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="step-actions">
                            <button type="button" class="btn btn-secondary" id="backToStep2">Kembali</button>
                            <button type="button" class="btn btn-primary" id="nextToStep4">Selanjutnya</button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Informasi Pengiriman & Pembayaran -->
                    <div id="step4" class="step-container">
                        <div class="step-header">
                            <div class="step-number">4</div>
                            <div class="step-title">Informasi Pengiriman & Pembayaran</div>
                        </div>
                        
                        <div class="shipping-info">
                            <div class="form-group">
                                <label class="form-label">Kurir Pengiriman</label>
                                <select class="form-select" id="soShippingCourier">
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="jnt">J&T</option>
                                    <option value="pickup">Ambil di Toko</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="soPaymentMethod" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                    <option value="cod">COD (Bayar di Tempat)</option>
                                    <option value="e_wallet">E-Wallet</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-textarea" id="soNotes" placeholder="Catatan tambahan untuk SO"></textarea>
                        </div>
                        
                        <div class="step-actions">
                            <button type="button" class="btn btn-secondary" id="backToStep3">Kembali</button>
                            <button type="submit" class="btn btn-success" id="saveSoBtn">Simpan SO</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Delivery Order -->
        <div class="modal" id="deliveryModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-truck"></i> Tambah Delivery Order</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="deliveryForm">
                        <div class="form-group">
                            <label class="form-label">Jenis Pengiriman</label>
                            <div class="delivery-type-selector">
                                <div class="delivery-type-card" data-type="dropship_ecommerce">
                                    <div class="delivery-type-title">Dropship Ecommerce</div>
                                </div>
                                <div class="delivery-type-card" data-type="dropship_non_ecommerce">
                                    <div class="delivery-type-title">Dropship Non Ecommerce</div>
                                </div>
                                <div class="delivery-type-card" data-type="regular">
                                    <div class="delivery-type-title">Reguler</div>
                                </div>
                            </div>
                            <input type="hidden" id="deliveryType" required>
                        </div>
                        
                        <!-- Dropship Ecommerce Fields -->
                        <div id="dropshipEcommerceFields" class="dropship-fields">
                            <div class="form-group">
                                <label class="form-label">Nomor Resi Ecommerce</label>
                                <input type="text" class="form-input" id="ecommerceTracking">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ekspedisi & Service</label>
                                <input type="text" class="form-input" id="ecommerceExpedition">
                            </div>
                            <div class="form-group">
                                <label class="form-label">File Resi Ecommerce</label>
                                <input type="file" class="form-input" id="ecommerceFile">
                            </div>
                        </div>
                        
                        <!-- Dropship Non Ecommerce Fields -->
                        <div id="dropshipNonEcommerceFields" class="dropship-fields">
                            <div class="form-group">
                                <label class="form-label">Nomor Resi</label>
                                <input type="text" class="form-input" id="nonEcommerceTracking">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ekspedisi</label>
                                <input type="text" class="form-input" id="nonEcommerceExpedition">
                            </div>
                        </div>
                        
                        <!-- Regular Fields -->
                        <div id="regularFields" class="regular-fields">
                            <div class="form-group">
                                <label class="form-label">Alamat Penerima</label>
                                <select class="form-select" id="recipientAddress">
                                    <option value="">Pilih Alamat</option>
                                    <!-- Address options will be populated dynamically -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ekspedisi</label>
                                <select class="form-select" id="regularExpedition">
                                    <option value="">Pilih Ekspedisi</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ongkir</label>
                                <input type="number" class="form-input" id="shippingCost" placeholder="Biaya pengiriman">
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger close-modal">Batal</button>
                            <button type="button" class="btn btn-success" id="btnSimpanDO">Simpan Delivery Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Payment -->
        <div class="modal" id="paymentModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-credit-card"></i> Tambah Pembayaran</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="form-group">
                            <label class="form-label">Jenis Pembayaran</label>
                            <div class="payment-method-selector">
                                <div class="payment-method-card" data-method="va">
                                    <div class="payment-method-header">
                                        <div class="payment-method-title">Virtual Account</div>
                                        <i class="fas fa-check" style="display: none;"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="form-group">
                                            <label class="form-label">Bank</label>
                                            <select class="form-select" id="vaBank">
                                                <option value="">Pilih Bank</option>
                                                <option value="bca">BCA</option>
                                                <option value="bni">BNI</option>
                                                <option value="bri">BRI</option>
                                                <option value="mandiri">Mandiri</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nomor VA</label>
                                            <input type="text" class="form-input" id="vaNumber" placeholder="Nomor Virtual Account">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="payment-method-card" data-method="qris">
                                    <div class="payment-method-header">
                                        <div class="payment-method-title">QRIS</div>
                                        <i class="fas fa-check" style="display: none;"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="form-group">
                                            <label class="form-label">QR Code</label>
                                            <input type="file" class="form-input" id="qrisFile">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="payment-method-card" data-method="ewallet">
                                    <div class="payment-method-header">
                                        <div class="payment-method-title">E-Wallet</div>
                                        <i class="fas fa-check" style="display: none;"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="form-group">
                                            <label class="form-label">Provider</label>
                                            <select class="form-select" id="ewalletProvider">
                                                <option value="">Pilih Provider</option>
                                                <option value="gopay">GoPay</option>
                                                <option value="ovo">OVO</option>
                                                <option value="dana">DANA</option>
                                                <option value="linkaja">LinkAja</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-input" id="ewalletPhone" placeholder="Nomor telepon terdaftar">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="payment-method-card" data-method="manual">
                                    <div class="payment-method-header">
                                        <div class="payment-method-title">Manual Transfer Bank</div>
                                        <i class="fas fa-check" style="display: none;"></i>
                                    </div>
                                    <div class="payment-method-details">
                                        <div class="form-group">
                                            <label class="form-label">Bank</label>
                                            <select class="form-select" id="manualBank">
                                                <option value="">Pilih Bank</option>
                                                <option value="bca">BCA</option>
                                                <option value="bni">BNI</option>
                                                <option value="bri">BRI</option>
                                                <option value="mandiri">Mandiri</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Atas Nama</label>
                                            <input type="text" class="form-input" id="manualName" placeholder="Nama pemilik rekening">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nomor Rekening</label>
                                            <input type="text" class="form-input" id="manualAccount" placeholder="Nomor rekening">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Nominal</label>
                                            <input type="number" class="form-input" id="manualAmount" placeholder="Jumlah pembayaran">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Bayar</label>
                                            <input type="date" class="form-input" id="manualDate">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">File Bukti Pembayaran</label>
                                            <input type="file" class="form-input" id="manualFile">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Konfirmasi Pembayaran</label>
                                            <select class="form-select" id="manualConfirmation">
                                                <option value="pending">Menunggu Konfirmasi</option>
                                                <option value="confirmed">Terkonfirmasi</option>
                                                <option value="rejected">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="selectedPaymentMethod" required>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger close-modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
            </div>
        `;
        document.getElementById('pages_content').innerHTML = HTML;

    }
    setupEventListeners() {
        // Event listeners for modal
        document.getElementById('addSoBtn').addEventListener('click', () => {
            this.openSoModal();
        });
        this.setupDeliveryForm();
        document.getElementById('backToList').addEventListener('click', () => {
            document.getElementById('soDetailView').style.display = 'none';
            document.getElementById('soListView').style.display = 'block';
        });

        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('soModal').style.display = 'none';
                document.getElementById('deliveryModal').style.display = 'none';
                document.getElementById('paymentModal').style.display = 'none';
            });
        });

        // SO type selection
        document.querySelectorAll('.so-type-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.so-type-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                document.getElementById('selectedSource').value = card.dataset.source;

                // Show channel selection if not offline
                if (card.dataset.source !== 'offline') {
                    document.getElementById('channelGroup').style.display = 'block';
                    this.populateSalesChannels(card.dataset.source);
                } else {
                    document.getElementById('channelGroup').style.display = 'none';
                }
            });
        });

        // Customer search
        document.getElementById('customerSearch').addEventListener('input', (e) => this.handleCustomerSearch(e));

        // Step navigation
        document.getElementById('nextToStep2').addEventListener('click', () => this.nextToStep2());
        document.getElementById('nextToStep3').addEventListener('click', () => this.nextToStep3());
        document.getElementById('nextToStep4').addEventListener('click', () => this.nextToStep4());
        document.getElementById('backToStep1').addEventListener('click', () => this.backToStep1());
        document.getElementById('backToStep2').addEventListener('click', () => this.backToStep2());
        document.getElementById('backToStep3').addEventListener('click', () => this.backToStep3());

        // Action buttons in detail view
        document.getElementById('editSoBtn').addEventListener('click', () => {
            if (this.currentSo) {
                this.openSoModal(this.currentso.primary_key);
            }
        });

        document.getElementById('processSoBtn').addEventListener('click', () => this.processSo());
        document.getElementById('printInvoiceBtn').addEventListener('click', () => this.printInvoice());
        document.getElementById('addDeliveryBtn').addEventListener('click', () => {
            document.getElementById('deliveryModal').style.display = 'block';
        });
        document.getElementById('addPaymentBtn').addEventListener('click', () => {
            document.getElementById('paymentModal').style.display = 'block';
        });
        document.getElementById('addOutgoingBtn').addEventListener('click', () => this.addOutgoing());
        document.getElementById('addReturBtn').addEventListener('click', () => this.addRetur());
        document.getElementById('addRefundBtn').addEventListener('click', () => this.addRefund());

        // Tab switching
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(`tab-${tab.dataset.tab}`).classList.add('active');

                // Load data for specific tabs
                if (tab.dataset.tab === 'outgoing' && this.currentSo) {
                    this.renderOutgoingList();
                } else if (tab.dataset.tab === 'shipping' && this.currentSo) {
                    this.renderDeliveryList();
                } else if (tab.dataset.tab === 'payment' && this.currentSo) {
                    this.renderPaymentList();
                } else if (tab.dataset.tab === 'retur_outgoing' && this.currentSo) {
                    this.renderReturList();
                } else if (tab.dataset.tab === 'refund' && this.currentSo) {
                    this.renderRefundList();
                }
            });
        });

        // Filter events
        document.getElementById('searchSo').addEventListener('input', () => this.filterSalesOrders());
        document.getElementById('statusFilter').addEventListener('change', () => this.filterSalesOrders());
        document.getElementById('sourceFilter').addEventListener('change', () => this.filterSalesOrders());
        document.getElementById('startDate').addEventListener('change', () => this.filterSalesOrders());
        document.getElementById('endDate').addEventListener('change', () => this.filterSalesOrders());

        // Delivery type selection
        document.querySelectorAll('.delivery-type-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.delivery-type-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                document.getElementById('deliveryType').value = card.dataset.type;

                // Show/hide fields based on type
                document.querySelectorAll('.dropship-fields, .regular-fields').forEach(field => {
                    field.classList.remove('active');
                });

                if (card.dataset.type === 'dropship_ecommerce') {
                    document.getElementById('dropshipEcommerceFields').classList.add('active');
                } else if (card.dataset.type === 'dropship_non_ecommerce') {
                    document.getElementById('dropshipNonEcommerceFields').classList.add('active');
                } else if (card.dataset.type === 'regular') {
                    document.getElementById('regularFields').classList.add('active');
                }
            });
        });

        // Payment method selection
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.payment-method-card').forEach(c => {
                    c.classList.remove('selected');
                    c.querySelector('.fa-check').style.display = 'none';
                });
                card.classList.add('selected');
                card.querySelector('.fa-check').style.display = 'inline';
                document.getElementById('selectedPaymentMethod').value = card.dataset.method;
            });
        });

        // Scanner controls
        document.getElementById('startCamera').addEventListener('click', () => this.startScanner());
        document.getElementById('stopCamera').addEventListener('click', () => this.stopScanner());
        document.getElementById('addManualBarcode').addEventListener('click', () => this.addManualBarcode());
        document.getElementById('productSearchInput').addEventListener('input', (e) => this.handleProductSearch(e));
        document.querySelector('[data-action="search-product"]').addEventListener('click', () => this.searchProducts());
        document.querySelector('[data-action="show-all-products"]').addEventListener('click', () => this.showAllProducts());

        // Save SO button
        document.getElementById('saveSoBtn').addEventListener('click', (e) => this.handleSoFormSubmit(e));

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === document.getElementById('soModal')) {
                document.getElementById('soModal').style.display = 'none';
            }
            if (e.target === document.getElementById('deliveryModal')) {
                document.getElementById('deliveryModal').style.display = 'none';
            }
            if (e.target === document.getElementById('paymentModal')) {
                document.getElementById('paymentModal').style.display = 'none';
            }
        });
        // View button
        document.querySelectorAll('[data-action="view"]').forEach(button => {
            button.addEventListener('click', (e) => {
                
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                this.viewSoDetail(soId);
            });
        });

        // Edit button
        document.querySelectorAll('[data-action="edit"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                this.editSo(soId);
            });
        });

        // Process button
        document.querySelectorAll('[data-action="process"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                this.processSoFromList(soId);
            });
        });

        // Ship button
        document.querySelectorAll('[data-action="ship"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                shipSoFromList(soId);
            });
        });

        // Complete button
        document.querySelectorAll('[data-action="complete"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                completeSoFromList(soId);
            });
        });

        // Print Invoice button
        document.querySelectorAll('[data-action="print-invoice"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const soId = e.target.closest('[data-so-id]').dataset.soId;
                printInvoiceFromList(soId);
            });
        });

    }

    // Tambahkan method ini ke dalam class DeliveryOrderUI
    setupDeliveryForm() {
        const deliveryForm = document.getElementById('deliveryForm');
        const deliveryTypeCards = document.querySelectorAll('.delivery-type-card');
        const deliveryTypeInput = document.getElementById('deliveryType');

        // Event listener untuk delivery type selection
        deliveryTypeCards.forEach(card => {
            card.addEventListener('click', () => {
                // Remove selected class from all cards
                deliveryTypeCards.forEach(c => c.classList.remove('selected'));
                // Add selected class to clicked card
                card.classList.add('selected');
                // Update hidden input value
                deliveryTypeInput.value = card.dataset.type;
                // Show/hide relevant fields
                this.toggleDeliveryFields(card.dataset.type);
            });
        });

        // Event listener untuk form submission
        document.getElementById('btnSimpanDO').addEventListener('click', (e) => {
            e.preventDefault();
            this.handleDeliverySubmit();
        });

        // Event listener untuk close modal button
        const closeModalBtn = deliveryForm.querySelector('.close-modal');
        closeModalBtn.addEventListener('click', () => {
            this.closeDeliveryModal();
        });
    }

    // Method untuk toggle fields berdasarkan jenis pengiriman
    toggleDeliveryFields(deliveryType) {
        // Hide all fields first
        const allFields = document.querySelectorAll('.dropship-fields, .regular-fields');
        allFields.forEach(field => {
            field.classList.remove('active');
        });

        // Show relevant fields based on delivery type
        switch (deliveryType) {
            case 'dropship_ecommerce':
                document.getElementById('dropshipEcommerceFields').classList.add('active');
                break;
            case 'dropship_non_ecommerce':
                document.getElementById('dropshipNonEcommerceFields').classList.add('active');
                break;
            case 'regular':
                document.getElementById('regularFields').classList.add('active');
                break;
        }
    }

    // Method untuk handle form submission
    handleDeliverySubmit() {
        const deliveryType = document.getElementById('deliveryType').value;
        let deliveryData = {};

        // Validate and collect data based on delivery type
        switch (deliveryType) {
            case 'dropship_ecommerce':
                deliveryData = this.collectDropshipEcommerceData();
                if (!this.validateDropshipEcommerceData(deliveryData)) return;
                break;

            case 'dropship_non_ecommerce':
                deliveryData = this.collectDropshipNonEcommerceData();
                if (!this.validateDropshipNonEcommerceData(deliveryData)) return;
                break;

            case 'regular':
                deliveryData = this.collectRegularDeliveryData();
                if (!this.validateRegularDeliveryData(deliveryData)) return;
                break;
        }

        // Add common data
        deliveryData.deliveryType = deliveryType;
        deliveryData.timestamp = new Date().toISOString();

        // Submit data
        this.submitDeliveryData(deliveryData);
    }

    // Method untuk collect data dropship ecommerce
    collectDropshipEcommerceData() {
        return {
            trackingNumber: document.getElementById('ecommerceTracking').value.trim(),
            expedition: document.getElementById('ecommerceExpedition').value.trim(),
            file: document.getElementById('ecommerceFile').files[0]
        };
    }

    // Method untuk collect data dropship non ecommerce
    collectDropshipNonEcommerceData() {
        return {
            trackingNumber: document.getElementById('nonEcommerceTracking').value.trim(),
            expedition: document.getElementById('nonEcommerceExpedition').value.trim()
        };
    }

    // Method untuk collect data regular delivery
    collectRegularDeliveryData() {
        return {
            recipientAddress: document.getElementById('recipientAddress').value,
            expedition: document.getElementById('regularExpedition').value,
            shippingCost: document.getElementById('shippingCost').value
        };
    }

    // Validation methods
    validateDropshipEcommerceData(data) {
        if (!data.trackingNumber) {
            this.showNotification('Nomor resi ecommerce harus diisi', 'error');
            return false;
        }
        if (!data.expedition) {
            this.showNotification('Ekspedisi harus diisi', 'error');
            return false;
        }
        return true;
    }

    validateDropshipNonEcommerceData(data) {
        if (!data.trackingNumber) {
            this.showNotification('Nomor resi harus diisi', 'error');
            return false;
        }
        if (!data.expedition) {
            this.showNotification('Ekspedisi harus diisi', 'error');
            return false;
        }
        return true;
    }

    validateRegularDeliveryData(data) {
        if (!data.recipientAddress) {
            this.showNotification('Alamat penerima harus dipilih', 'error');
            return false;
        }
        if (!data.expedition) {
            this.showNotification('Ekspedisi harus dipilih', 'error');
            return false;
        }
        if (!data.shippingCost || data.shippingCost <= 0) {
            this.showNotification('Ongkir harus diisi dengan nilai yang valid', 'error');
            return false;
        }
        return true;
    }

    // Method untuk submit data ke backend
    submitDeliveryData(deliveryData) {
        // Show loading state
        const submitBtn = document.querySelector('#deliveryForm .btn-success');
        const originalText = submitBtn.textContent;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;

        // Simulate API call (replace with actual API call)
        setTimeout(() => {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;

            // Simulate successful submission
            console.log('Delivery Data Submitted:', deliveryData);

            // Show success notification
            this.showNotification('Delivery order berhasil disimpan', 'success');

            // Close modal
            this.closeDeliveryModal();

            // Refresh delivery list
            this.renderDeliveryList();
            this.updateStats();

        }, 1500);
    }

    // Method untuk close modal
    closeDeliveryModal() {
        const modal = document.getElementById('deliveryModal'); // Asumsi modal ID
        if (modal) {
            modal.style.display = 'none';
        }

        // Reset form
        document.getElementById('deliveryForm').reset();

        // Reset to default delivery type
        const defaultCard = document.querySelector('.delivery-type-card[data-type="dropship_ecommerce"]');
        if (defaultCard) {
            defaultCard.click();
        }
    }

    // Method untuk show notification (jika belum ada)
    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 6px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    `;

        if (type === 'success') {
            notification.style.backgroundColor = '#28a745';
        } else if (type === 'error') {
            notification.style.backgroundColor = '#dc3545';
        } else {
            notification.style.backgroundColor = '#17a2b8';
        }

        notification.textContent = message;

        // Add to page
        document.body.appendChild(notification);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    // Render the SO list
    renderSoList() {
        let tableHTML = '';

        this.filteredSalesOrders.forEach(so => {
            const statusClass = this.getStatusClass(so.status);
            const statusText = this.getStatusText(so.status);
            const soDate = new Date(so.date).toLocaleDateString('id-ID');
            const typeClass = this.getTypeClass(so.source);
            const typeText = this.getTypeText(so.source);

            tableHTML += `
                        <tr>
                            <td>
                                <div class="order-id">${so.nomor}</div>
                                <div class="order-date">${soDate}</div>
                            </td>
                            <td>
                                <div class="customer-name">${so.nama_lengkap}</div>
                                <div class="customer-email">${so.email}</div>
                            </td>
                            <td>${soDate}</td>
                            <td>
                                <span class="type-badge ${typeClass}">${typeText}</span>
                                ${so.channel ? `<div style="font-size: 12px; color: #6c757d;">${so.channel}</div>` : ''}
                            </td>
                            <td class="order-total">${this.formatCurrency(so.total)}</td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                    <div class="action-buttons" data-so-id="${so.primary_key}">
                        <button class="action-btn btn-view" data-action="view" data-so-id="${so.primary_key}">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                        ${so.status === 'draft' || so.status === 'pending' ? `
                            <button class="action-btn btn-edit" data-action="edit" data-so-id="${so.primary_key}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        ` : ''}
                        ${so.status === 'confirmed' ? `
                            <button class="action-btn btn-process" data-action="process" data-so-id="${so.primary_key}">
                                <i class="fas fa-cog"></i> Proses
                            </button>
                        ` : ''}
                        ${so.status === 'processing' ? `
                            <button class="action-btn btn-ship" data-action="ship" data-so-id="${so.primary_key}">
                                <i class="fas fa-truck"></i> Kirim
                            </button>
                        ` : ''}
                        ${so.status === 'shipped' ? `
                            <button class="action-btn btn-complete" data-action="complete" data-so-id="${so.primary_key}">
                                <i class="fas fa-check"></i> Selesai
                            </button>
                        ` : ''}
                        ${so.status !== 'completed' && so.status !== 'cancelled' ? `
                            <button class="action-btn btn-invoice" data-action="print-invoice" data-so-id="${so.primary_key}">
                                <i class="fas fa-print"></i> Invoice
                            </button>
                        ` : ''}
                    </div>
                </td>
                        </tr>
                    `;
        });

        document.getElementById('soTableBody').innerHTML = tableHTML;

    }
    setupSoActionListeners() {
    }
    // Update statistics
    updateStats() {
        document.getElementById('totalSos').textContent = this.salesOrders.length;
        document.getElementById('pendingSos').textContent = this.salesOrders.filter(so => so.status === 'pending').length;
        document.getElementById('processingSos').textContent = this.salesOrders.filter(so => so.status === 'processing').length;
        document.getElementById('shippedSos').textContent = this.salesOrders.filter(so => so.status === 'shipped').length;
        document.getElementById('completedSos').textContent = this.salesOrders.filter(so => so.status === 'completed').length;
    }

    // View SO detail
    viewSoDetail(soId) {
          alert(soId);
          console.log(this.salesOrders);
        this.currentSo = this.salesOrders.find(so => so.primary_key == soId);
        console.log(this.currentSo);
        if (!this.currentSo) return;
        alert();
        this.showSoDetail();
        this.populateSoDetail();
    }

    // Show SO detail view
    showSoDetail() {
        document.getElementById('soListView').style.display = 'none';
        document.getElementById('soDetailView').style.display = 'block';
    }

    // Populate SO detail
    populateSoDetail() {
        if (!this.currentSo) return;

        // Set basic SO info
        document.getElementById('detailSoId').textContent = this.currentSo.primary_key;
        document.getElementById('infoStatus').textContent = this.getStatusText(this.currentSo.status);
        document.getElementById('infoSoDate').textContent = new Date(this.currentSo.date).toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        document.getElementById('infoSource').textContent = this.getTypeText(this.currentSo.source);
        document.getElementById('infoChannel').textContent = this.currentSo.channel || '-';
        document.getElementById('infoNotes').textContent = this.currentSo.notes || '-';

        // Set customer info
        document.getElementById('infoCustomerName').textContent = this.currentSo.nama_lengkap;
        document.getElementById('infoCustomerPhone').textContent = "";
        document.getElementById('infoCustomerEmail').textContent = this.currentSo.email || '-';
        document.getElementById('infoCustomerAddress').textContent = "";
        /*
        // Set shipping info
        document.getElementById('infoShippingCourier').textContent = this.getCourierText(this.currentSo.shippingInfo.courier);
        document.getElementById('infoShippingService').textContent = this.getServiceText(this.currentSo.shippingInfo.service);
        document.getElementById('infoTrackingNumber').textContent = this.currentSo.shippingInfo.trackingNumber || '-';
        document.getElementById('infoShippingStatus').textContent = this.getShippingStatusText(this.currentSo.shippingInfo.status);
        document.getElementById('infoShippingAddress').textContent = this.currentSo.shippingInfo.address;

        // Set payment info
        document.getElementById('infoPaymentMethod').textContent = this.getPaymentMethodText(this.currentSo.paymentInfo.method);
        document.getElementById('infoPaymentStatus').textContent = this.getPaymentStatusText(this.currentSo.paymentInfo.status);
        document.getElementById('infoPaymentTotal').textContent = this.formatCurrency(this.currentSo.total);
        document.getElementById('infoPaymentDate').textContent = this.currentSo.paymentInfo.date ?
            new Date(this.currentSo.paymentInfo.date).toLocaleDateString('id-ID') : '-';
        */
        // Populate items
        let itemsHTML = '';
        console.log(this.currentSo.items);
        this.currentSo.items.forEach(item => {
            itemsHTML += `
                        <tr>
                            <td>${item.name}</td>
                            <td>${this.formatCurrency(item.base_price)}</td>
                            <td>${item.quantity}</td>
                            <td>${this.formatCurrency(item.total_diskon)}</td>
                            <td>${this.formatCurrency((item.grand_total))}</td>
                        </tr>
                    `;
        });
        document.getElementById('soItemsList').innerHTML = itemsHTML;

        // Update summary
        document.getElementById('itemsSubtotal').textContent = this.formatCurrency(this.currentSo.sub_total);
        document.getElementById('itemsDiscount').textContent = this.formatCurrency(this.currentSo.total_diskon);
        document.getElementById('itemsShipping').textContent = this.formatCurrency(this.currentSo.shipping);
        document.getElementById('itemsTax').textContent = this.formatCurrency(this.currentSo.tax);
        document.getElementById('itemsTotal').textContent = this.formatCurrency(this.currentSo.total);

        // Populate timeline
        let timelineHTML = '';
        if (this.currentSo.history) {
            this.currentSo.history.forEach(event => {
                timelineHTML += `
                            <div class="timeline-item">
                                <div class="timeline-date">${new Date(event.date).toLocaleDateString('id-ID')}</div>
                                <div class="timeline-content">${event.action} oleh ${event.user}</div>
                            </div>
                        `;
            });
        }
        document.getElementById('soTimeline').innerHTML = timelineHTML;

        // Update action buttons based on status
        this.updateActionButtons();
    }

    // Update action buttons based on SO status
    updateActionButtons() {
        if (!this.currentSo) return;

        const status = this.currentSo.status;

        // Show/hide buttons based on status
        document.getElementById('editSoBtn').style.display = (status === 'draft' || status === 'pending') ? 'flex' : 'none';

        if (status === 'confirmed') {
            document.getElementById('processSoBtn').innerHTML = '<i class="fas fa-cog"></i> Proses';
            document.getElementById('processSoBtn').style.display = 'flex';
        } else if (status === 'processing') {
            document.getElementById('processSoBtn').innerHTML = '<i class="fas fa-truck"></i> Kirim';
            document.getElementById('processSoBtn').style.display = 'flex';
        } else if (status === 'shipped') {
            document.getElementById('processSoBtn').innerHTML = '<i class="fas fa-check"></i> Selesai';
            document.getElementById('processSoBtn').style.display = 'flex';
        } else {
            document.getElementById('processSoBtn').style.display = 'none';
        }
    }

    // Open SO modal for create or edit
    openSoModal(soId = null) {
        const modalTitle = document.getElementById('modalTitle');

        if (soId) {
            // Edit mode
            modalTitle.textContent = 'Edit Sales Order';

            const so = this.salesOrders.find(s => s.id === soId);
            if (so) {
                // Select SO type
                document.querySelectorAll('.so-type-card').forEach(card => {
                    if (card.dataset.source === so.source) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
                document.getElementById('selectedSource').value = so.source;

                // Show channel if applicable
                if (so.source !== 'offline') {
                    document.getElementById('channelGroup').style.display = 'block';
                    this.populateSalesChannels(so.source);
                    document.getElementById('salesChannel').value = so.channel;
                } else {
                    document.getElementById('channelGroup').style.display = 'none';
                }

                // Set customer
                this.selectedCustomer = so.customer;
                this.renderSelectedCustomer();

                // Fill products
                this.scannedProducts = so.items.map(item => ({
                    ...this.products.find(p => p.id === item.productId),
                    quantity: item.quantity,
                    discount: item.discount
                }));
                this.renderScannedProducts();

                // Fill shipping and payment info
                document.getElementById('soShippingCourier').value = so.shippingInfo.courier;
                document.getElementById('soPaymentMethod').value = so.paymentInfo.method;
                document.getElementById('soNotes').value = so.notes || '';
            }
        } else {
            // Create mode
            modalTitle.textContent = 'Buat Sales Order';
            this.resetSoForm();
        }

        document.getElementById('soModal').style.display = 'block';
        this.showStep(1);
    }

    // Reset SO form
    resetSoForm() {
        document.querySelectorAll('.so-type-card').forEach(c => c.classList.remove('selected'));
        document.getElementById('selectedSource').value = '';
        document.getElementById('channelGroup').style.display = 'none';
        this.selectedCustomer = null;
        document.getElementById('selectedCustomer').style.display = 'none';
        this.scannedProducts = [];
        this.renderScannedProducts();
        document.getElementById('soShippingCourier').value = '';
        document.getElementById('soPaymentMethod').value = '';
        document.getElementById('soNotes').value = '';
    }

    // Show specific step
    showStep(stepNumber) {
        this.currentStep = stepNumber;
        document.querySelectorAll('.step-container').forEach(step => {
            step.classList.remove('active');
        });
        document.getElementById(`step${stepNumber}`).classList.add('active');
    }

    // Next to step 2
    nextToStep2() {
        if (!document.getElementById('selectedSource').value) {
            alert('Pilih sumber penjualan terlebih dahulu');
            return;
        }

        if (document.getElementById('selectedSource').value !== 'offline' && !document.getElementById('salesChannel').value) {
            alert('Pilih channel penjualan terlebih dahulu');
            return;
        }

        this.showStep(2);
    }

    // Next to step 3
    nextToStep3() {
        if (!this.selectedCustomer) {
            alert('Pilih pelanggan terlebih dahulu');
            return;
        }

        this.showStep(3);
    }

    // Next to step 4
    nextToStep4() {
        if (this.scannedProducts.length === 0) {
            //    alert('Pilih setidaknya satu produk');
            //  return;
        }

        this.showStep(4);
    }

    // Back to step 1
    backToStep1() {
        this.showStep(1);
    }

    // Back to step 2
    backToStep2() {
        this.showStep(2);
    }

    // Back to step 3
    backToStep3() {
        this.showStep(3);
    }

    // Populate sales channels based on source
    populateSalesChannels(source) {
        const channels = this.salesChannels[source] || [];
        let optionsHTML = '<option value="">Pilih Channel</option>';

        channels.forEach(channel => {
            optionsHTML += `<option value="${channel}">${channel}</option>`;
        });

        document.getElementById('salesChannel').innerHTML = optionsHTML;
    }

    // Handle customer search
    handleCustomerSearch(e) {
        const query = e.target.value.toLowerCase();

        if (query.length < 2) {
            document.getElementById('customerResults').style.display = 'none';
            return;
        }

        const filteredCustomers = this.customers.filter(customer =>
            customer.name.toLowerCase().includes(query) ||
            customer.phone.includes(query) ||
            customer.email.toLowerCase().includes(query)
        );

        document.getElementById('customerResults').innerHTML = '';

        if (filteredCustomers.length === 0) {
            document.getElementById('customerResults').innerHTML = '<div class="customer-result-item">Pelanggan tidak ditemukan</div>';
        } else {
            filteredCustomers.forEach(customer => {
                const item = document.createElement('div');
                item.className = 'customer-result-item';

                item.innerHTML = `
                            <div class="customer-details">
                                <div class="customer-name">${customer.name}</div>
                                <div class="customer-contact">${customer.phone} | ${customer.email}</div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary select-customer" data-customer-id="${customer.id}">Pilih</button>
                            </div>
                        `;

                document.getElementById('customerResults').appendChild(item);
            });

            // Add event listeners to select buttons
            document.querySelectorAll('.select-customer').forEach(button => {
                button.addEventListener('click', (e) => {
                    const customerId = e.target.dataset.customerId;
                    this.selectCustomer(customerId);
                });
            });
        }

        document.getElementById('customerResults').style.display = 'block';
    }

    // Select customer
    selectCustomer(customerId) {
        this.selectedCustomer = this.customers.find(c => c.id == customerId);
        if (this.selectedCustomer) {
            this.renderSelectedCustomer();
            document.getElementById('customerResults').style.display = 'none';
            document.getElementById('customerSearch').value = '';
        }
    }

    // Render selected customer
    renderSelectedCustomer() {
        if (!this.selectedCustomer) return;

        document.getElementById('selectedCustomer').innerHTML = `
                    <div class="customer-name">${this.selectedCustomer.name}</div>
                    <div class="customer-contact">${this.selectedCustomer.phone} | ${this.selectedCustomer.email}</div>
                    <div class="customer-address">${this.selectedCustomer.addresses.find(a => a.isPrimary).address}</div>
                    <button class="btn btn-sm btn-danger" id="removeCustomer">Hapus</button>
                `;

        document.getElementById('selectedCustomer').style.display = 'block';

        document.getElementById('removeCustomer').addEventListener('click', () => {
            this.selectedCustomer = null;
            document.getElementById('selectedCustomer').style.display = 'none';
        });
    }

    // Handle product search
    handleProductSearch(e) {
        const query = e.target.value.toLowerCase();

        if (query.length < 2) {
            document.getElementById('productSearchResults').style.display = 'none';
            return;
        }

        this.searchProducts(query);
    }

    // Search products
    async searchProducts(query = '', page = 1, limit = 20) {
        // In a real app, this would be an API call
        // For now, we'll simulate with our sample data

        let filteredProducts = this.products;

        if (query) {
            filteredProducts = this.products.filter(product =>
                product.name.toLowerCase().includes(query.toLowerCase()) ||
                product.barcode.includes(query)
            );
        }

        // Apply pagination
        const startIndex = (page - 1) * limit;
        const paginatedProducts = filteredProducts.slice(startIndex, startIndex + limit);

        this.renderProductSearchResults(paginatedProducts, query, page, limit);
    }

    // Show all products
    showAllProducts() {
        this.searchProducts('', 1, 20);
    }

    // Render product search results
    renderProductSearchResults(products, query = '', page = 1, limit = 20) {
        const resultsContainer = document.getElementById('productSearchResults');

        if (products.length === 0) {
            resultsContainer.innerHTML = '<div class="search-result-item">Produk tidak ditemukan</div>';
        } else {
            let resultsHTML = '';

            products.forEach(product => {
                resultsHTML += `
                            <div class="search-result-item" data-product-id="${product.id}">
                                <div class="product-name">${product.name}</div>
                                <div class="product-details">
                                    <span class="product-price">${this.formatCurrency(product.price)}</span>
                                    <span class="product-stock">Stok: ${product.stock}</span>
                                    <span class="product-barcode">Barcode: ${product.barcode}</span>
                                </div>
                                <button class="btn btn-sm btn-primary add-product" data-product-id="${product.id}">Tambah</button>
                            </div>
                        `;
            });

            resultsContainer.innerHTML = resultsHTML;

            // Add event listeners to add buttons
            document.querySelectorAll('.add-product').forEach(button => {
                button.addEventListener('click', (e) => {
                    const productId = e.target.dataset.productId;
                    this.addProductToScanned(parseInt(productId));
                });
            });
        }

        resultsContainer.style.display = 'block';
    }

    // Add product to scanned list
    addProductToScanned(productId) {
        const product = this.products.find(p => p.id === productId);
        if (!product) return;

        // Check if product is already in scanned list
        const existingIndex = this.scannedProducts.findIndex(p => p.id === productId);

        if (existingIndex >= 0) {
            // Increase quantity
            this.scannedProducts[existingIndex].quantity += 1;
        } else {
            // Add new product
            this.scannedProducts.push({
                ...product,
                quantity: 1,
                discount: 0
            });
        }

        this.renderScannedProducts();
    }

    // Render scanned products
    renderScannedProducts() {
        const scannedList = document.getElementById('scannedProductsList');
        const scannedCount = document.getElementById('scannedCount');

        if (this.scannedProducts.length === 0) {
            scannedList.innerHTML = '<div class="empty-state">Belum ada produk yang di-scan</div>';
            scannedCount.textContent = '0';
            return;
        }

        let productsHTML = '';

        this.scannedProducts.forEach((product, index) => {
            productsHTML += `
                        <div class="selected-product" data-product-id="${product.id}">
                            <div class="product-details">
                                <div class="product-name">${product.name}</div>
                                <div class="product-sku">Barcode: ${product.barcode} | Stok: ${product.stock}</div>
                            </div>
                            <div class="product-controls">
                                <div class="product-quantity">
                                    <input type="number" class="quantity-input" value="${product.quantity}" min="1" max="${product.stock}" data-index="${index}">
                                </div>
                                <div class="product-price">
                                    <input type="text" class="price-input" value="${this.formatCurrency(product.price)}" readonly>
                                </div>
                                <div class="product-price">
                                    <input type="number" class="discount-input" value="${product.discount}" placeholder="Diskon" data-index="${index}">
                                </div>
                                <div class="product-total">
                                    <span>${this.formatCurrency((product.price - product.discount) * product.quantity)}</span>
                                </div>
                                <button class="remove-product" data-index="${index}">&times;</button>
                            </div>
                        </div>
                    `;
        });

        scannedList.innerHTML = productsHTML;
        scannedCount.textContent = this.scannedProducts.length;

        // Add event listeners
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.updateScannedProductQuantity(index, parseInt(e.target.value));
            });
        });

        document.querySelectorAll('.discount-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.updateScannedProductDiscount(index, parseInt(e.target.value) || 0);
            });
        });

        document.querySelectorAll('.remove-product').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.removeScannedProduct(index);
            });
        });
    }

    // Update scanned product quantity
    updateScannedProductQuantity(index, quantity) {
        if (index >= 0 && index < this.scannedProducts.length) {
            this.scannedProducts[index].quantity = quantity;
            this.renderScannedProducts();
        }
    }

    // Update scanned product discount
    updateScannedProductDiscount(index, discount) {
        if (index >= 0 && index < this.scannedProducts.length) {
            this.scannedProducts[index].discount = discount;
            this.renderScannedProducts();
        }
    }

    // Remove scanned product
    removeScannedProduct(index) {
        if (index >= 0 && index < this.scannedProducts.length) {
            this.scannedProducts.splice(index, 1);
            this.renderScannedProducts();
        }
    }

    // Start scanner
    startScanner() {
        if (this.scannerActive) return;

        const video = document.getElementById('scannerVideo');
        const startButton = document.getElementById('startCamera');
        const stopButton = document.getElementById('stopCamera');

        // Check if browser supports camera access
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                .then((stream) => {
                    this.stream = stream;
                    video.srcObject = stream;
                    video.play();
                    this.scannerActive = true;

                    startButton.disabled = true;
                    stopButton.disabled = false;

                    // Start barcode detection (simulated)
                    this.simulateBarcodeDetection();
                })
                .catch((error) => {
                    console.error('Error accessing camera:', error);
                    alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                });
        } else {
            alert('Browser tidak mendukung akses kamera.');
        }
    }

    // Stop scanner
    stopScanner() {
        if (!this.scannerActive) return;

        const video = document.getElementById('scannerVideo');
        const startButton = document.getElementById('startCamera');
        const stopButton = document.getElementById('stopCamera');

        if (this.stream) {
            this.stream.getTracks().forEach(track => track.stop());
            this.stream = null;
        }

        video.srcObject = null;
        this.scannerActive = false;

        startButton.disabled = false;
        stopButton.disabled = true;
    }

    // Simulate barcode detection
    simulateBarcodeDetection() {
        if (!this.scannerActive) return;

        // In a real app, this would use a barcode detection library
        // For now, we'll simulate detection with a random product
        const detectBarcode = () => {
            if (!this.scannerActive) return;

            // Simulate random barcode detection every 3 seconds
            setTimeout(() => {
                if (!this.scannerActive) return;

                const randomProduct = this.products[Math.floor(Math.random() * this.products.length)];
                if (randomProduct) {
                    this.addProductToScanned(randomProduct.id);
                    document.getElementById('scannerResult').innerHTML = `
                                <i class="fas fa-check" style="color: var(--success);"></i> 
                                Produk terdeteksi: ${randomProduct.name}
                            `;

                    // Clear result after 2 seconds
                    setTimeout(() => {
                        document.getElementById('scannerResult').innerHTML = '';
                    }, 2000);
                }

                detectBarcode();
            }, 3000);
        };

        detectBarcode();
    }

    // Add manual barcode
    addManualBarcode() {
        const barcodeInput = document.getElementById('manualBarcode');
        const barcode = barcodeInput.value.trim();

        if (!barcode) {
            alert('Masukkan barcode terlebih dahulu');
            return;
        }

        // Find product by barcode
        const product = this.products.find(p => p.barcode === barcode);

        if (product) {
            this.addProductToScanned(product.id);
            barcodeInput.value = '';
            document.getElementById('scannerResult').innerHTML = `
                        <i class="fas fa-check" style="color: var(--success);"></i> 
                        Produk ditemukan: ${product.name}
                    `;

            // Clear result after 2 seconds
            setTimeout(() => {
                document.getElementById('scannerResult').innerHTML = '';
            }, 2000);
        } else {
            document.getElementById('scannerResult').innerHTML = `
                        <i class="fas fa-times" style="color: var(--danger);"></i> 
                        Produk dengan barcode ${barcode} tidak ditemukan
                    `;
        }
    }

    // Handle SO form submission
    handleSoFormSubmit(e) {
        e.preventDefault();

        // Get form values
        const source = document.getElementById('selectedSource').value;
        const channel = source !== 'offline' ? document.getElementById('salesChannel').value : 'Toko Offline';
        const shippingCourier = document.getElementById('soShippingCourier').value;
        const paymentMethod = document.getElementById('soPaymentMethod').value;
        const notes = document.getElementById('soNotes').value;

        // Calculate totals
        let subtotal = 0;
        let totalDiscount = 0;

        const items = this.scannedProducts.map(product => {
            const itemTotal = (product.price - product.discount) * product.quantity;
            subtotal += product.price * product.quantity;
            totalDiscount += product.discount * product.quantity;

            return {
                productId: product.id,
                name: product.name,
                price: product.price,
                quantity: product.quantity,
                discount: product.discount
            };
        });

        // Calculate totals (simplified)
        const shipping = shippingCourier === 'pickup' ? 0 : 20000;
        const tax = subtotal * 0.11; // 11% tax
        const total = subtotal - totalDiscount + shipping + tax;

        // Create new SO
        const newSo = {
            id: `SO-${new Date().getFullYear()}-${String(this.salesOrders.length + 1).padStart(4, '0')}`,
            customer: {
                id: this.selectedCustomer.id,
                name: this.selectedCustomer.name,
                phone: this.selectedCustomer.phone,
                email: this.selectedCustomer.email,
                address: this.selectedCustomer.addresses.find(a => a.isPrimary).address
            },
            date: new Date().toISOString().split('T')[0],
            source: source,
            channel: channel,
            status: 'draft',
            items: items,
            subtotal: subtotal,
            discount: totalDiscount,
            shipping: shipping,
            tax: tax,
            total: total,
            shippingInfo: {
                courier: shippingCourier,
                service: 'REG',
                trackingNumber: '',
                status: 'pending',
                address: this.selectedCustomer.addresses.find(a => a.isPrimary).address
            },
            paymentInfo: {
                method: paymentMethod,
                status: 'pending',
                paidAmount: 0,
                date: null,
                notes: ''
            },
            notes: notes,
            history: [
                {
                    date: new Date().toISOString().split('T')[0],
                    action: "SO dibuat",
                    user: "Admin"
                }
            ],
            outgoing: [],
            deliveryOrders: [],
            payments: [],
            returOutgoing: [],
            refunds: []
        };

        // Add to list
        this.salesOrders.push(newSo);

        // Update UI
        this.renderSoList();
        this.updateStats();

        // Close modal and reset form
        document.getElementById('soModal').style.display = 'none';
        this.resetSoForm();

        alert('Sales Order berhasil dibuat!');
    }

    // Process SO (confirm, ship, or complete based on current status)
    processSo() {
        if (!this.currentSo) return;

        let newStatus = '';
        let action = '';

        switch (this.currentSo.status) {
            case 'confirmed':
                newStatus = 'processing';
                action = 'Pesanan diproses';
                break;
            case 'processing':
                newStatus = 'shipped';
                action = 'Pesanan dikirim';
                break;
            case 'shipped':
                newStatus = 'completed';
                action = 'Pesanan selesai';
                break;
            default:
                alert('Tidak dapat memproses SO dengan status saat ini');
                return;
        }

        if (confirm(`Ubah status SO menjadi ${this.getStatusText(newStatus)}?`)) {
            this.currentSo.status = newStatus;
            this.currentSo.history.push({
                date: new Date().toISOString().split('T')[0],
                action: action,
                user: "Admin"
            });

            this.renderSoList();
            this.updateStats();
            this.populateSoDetail();

            alert(`Status SO berhasil diubah menjadi ${this.getStatusText(newStatus)}`);
        }
    }

    // Print invoice
    printInvoice() {
        if (!this.currentSo) return;
        alert(`Invoice ${this.currentso.primary_key} akan dicetak`);
        // In a real app, this would open a print dialog or generate PDF
    }

    // Add outgoing
    addOutgoing() {
        if (!this.currentSo) return;

        // Generate outgoing ID berdasarkan timestamp
        const outgoingId = Date.now().toString();

        // Format tanggal saat ini (YYYY-MM-DD)
        const currentDate = new Date().toISOString().split('T')[0];

        // Buat outgoing baru sesuai dengan struktur data yang benar
        const newOutgoing = {
            id: outgoingId,
            id_panel: null,
            id_order: this.currentSo.id || this.currentSo.primary_key,
            nomor_outgoing: outgoingId,
            tanggal_outgoing: currentDate,
            active: "1",
            on_domain: "v2.moesneeds.id",
            on_panel: "1",
            on_board: "42",
            on_role: "0",
            privilege: "Private Website",
            create_date: new Date().toISOString().replace('T', ' ').substring(0, 19),
            create_by: "20250123211111186799", // User ID admin
            update_date: null,
            update_by: null,
            delete_date: null,
            delete_by: null,
            timezone: "Asia/Jakarta",
            on_web_apps: "3",
            nomor_receive: null,
            tanggal_diterima: null,
            id_erp__pos__inventory: outgoingId,
            items: JSON.stringify(
                this.currentSo.items.map(item => {
                    return {
                        id: Date.now() + Math.random().toString(36).substr(2, 9), // Unique ID
                        erp__pos__utama__detail_id: item.id_detail || item.erp__pos__utama__detail_id,
                        qty_pesan: item.qty || item.quantity || item.qty_pesanan,
                        harga: item.harga_penjualan || item.harga,
                        id_inventaris__asset__list: item.id_inventaris__asset__list || item.id_asset,
                        id_erp__pos__utama__detail_get: item.id_detail || item.erp__pos__utama__detail_id,
                        id_asset_varian_inv: item.id_asset_varian_inv || item.id_barang_varian,
                        id_produk_inv: item.id_produk || item.id_produk_utama,
                        id_produk_varian_inv: item.id_produk_varian_inv || item.id_barang_varian,
                        active: 1,
                        on_domain: "v2.moesneeds.id",
                        on_panel: 1,
                        on_board: 42,
                        on_role: 0,
                        privilege: "Private Website",
                        create_date: new Date().toISOString().replace('T', ' ').substring(0, 19),
                        create_by: "20250123211111186799",
                        update_date: null,
                        update_by: null,
                        delete_date: null,
                        delete_by: null,
                        timezone: "Asia/Jakarta",
                        id_erp__pos__inventory: outgoingId,
                        id_erp__pos__inventory_detail: null,
                        on_web_apps: "3",
                        status_diterima: null,
                        id_erp__pos__inventory__outgoing: null,
                        breakdown: JSON.stringify([]) // Empty array
                    };
                })
            ),
            primary_key: outgoingId,
            primary_key_erp__pos__inventory: outgoingId,
            status: 'pending',
            id_erp__pos__group: this.currentSo.primary_key,
            preparedBy: null,
            checkedBy: null,
            history: JSON.stringify([
                {
                    date: currentDate,
                    action: "Outgoing dibuat",
                    user: "Admin"
                }
            ])
        };

        // Parse items and breakdown to get clean object (not stringified JSON)
        let parsedItems = [];

        try {
            if (newOutgoing.items) {
                if (typeof newOutgoing.items === 'string') {
                    parsedItems = JSON.parse(newOutgoing.items);
                } else if (Array.isArray(newOutgoing.items)) {
                    parsedItems = newOutgoing.items;
                }
            }
        } catch (error) {
            console.error('Error parsing items:', newOutgoing.id, error);
            parsedItems = [];
        }

        // Parse breakdown inside each item
        parsedItems = parsedItems.map(item => {
            let breakdown = [];

            try {
                if (item.breakdown) {
                    if (typeof item.breakdown === 'string') {
                        breakdown = JSON.parse(item.breakdown);
                    } else if (Array.isArray(item.breakdown)) {
                        breakdown = item.breakdown;
                    }
                }
            } catch (error) {
                console.error('Error parsing breakdown for item:', item.id, error);
                breakdown = [];
            }

            return {
                ...item,
                breakdown: breakdown
            };
        });

        // Final cleaned outgoing object
        const newOutgoingRaw = {
            ...newOutgoing,
            items: parsedItems
        };
        // Tambahkan ke array outgoings
        if (!this.outgoings) this.outgoings = [];
        this.outgoings.push(newOutgoing);

        // Update currentSo.outgoing jika diperlukan

        this.renderOutgoingList();

        // Simpan ke server (jika diperlukan)
        this.saveOutgoingToServer(newOutgoing);

        alert('Outgoing berhasil ditambahkan!');
    }

    // Method untuk menyimpan outgoing ke server (optional)
    saveOutgoingToServer(outgoing) {
        // Implementasi API call untuk menyimpan outgoing ke server
        // Contoh:
        /*
        fetch('/api/outgoing', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(outgoing)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Outgoing saved to server:', data);
        })
        .catch(error => {
            console.error('Error saving outgoing:', error);
        });
        */
    }

    // Render outgoing list
    renderOutgoingList() {
        if (!this.currentSo) return;
        this.currentSo.outgoing = this.outgoings.filter(p => p.id_erp__pos__group === this.currentSo.primary_key);
        const outgoingList = document.getElementById('outgoingList');
        if (!outgoingList) return;
        console.log(this.currentSo.outgoing);
        let outgoingHTML = '';

        this.currentSo.outgoing.forEach(outgoing => {
            // Parse items dari string JSON

            const outgoingItems = outgoing.items || '[]';
            let history = [];

            try {
                if (typeof outgoing.history === 'string') {
                    history = JSON.parse(outgoing.history);
                } else if (Array.isArray(outgoing.history)) {
                    history = outgoing.history;
                }
            } catch (e) {
                console.error('Failed to parse outgoing.history:', e);
                history = [];
            }
            outgoingHTML += `
        <div class="outgoing-card" data-outgoing-id="${outgoing.id}">
            <div class="delivery-header">
                <div class="delivery-title">Outgoing: ${outgoing.nomor_outgoing || outgoing.id}</div>
                <div class="delivery-info">
                    <span class="status-badge ${this.getOutgoingStatusClass(outgoing.status)}">
                        ${this.getOutgoingStatusText(outgoing.status)}
                    </span>
                    <span class="delivery-date">Tanggal: ${outgoing.tanggal_outgoing || outgoing.date}</span>
                </div>
                <div class="delivery-actions">
                    <button class="btn btn-sm btn-info" data-action="view-outgoing" data-outgoing-id="${outgoing.id}">
                        <i class="fas fa-eye"></i> Detail
                    </button>
                    <button class="btn btn-sm btn-warning" data-action="edit-outgoing" data-outgoing-id="${outgoing.id}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    ${outgoing.status !== 'completed' ? `
                        <button class="btn btn-sm btn-success" data-action="complete-outgoing" data-outgoing-id="${outgoing.id}">
                            <i class="fas fa-check"></i> Selesai
                        </button>
                    ` : ''}
                </div>
            </div>
            
            <div class="outgoing-items">
                ${outgoingItems.map(item => {
                // Cari nama barang dan varian dari SO items berdasarkan erp__pos__utama__detail_id
                const soItem = this.findSoItemByDetailId(item.erp__pos__utama__detail_id || item.id_detail);
                const productName = soItem ? soItem.nama_barang : 'Produk Tidak Ditemukan';
                const variantName = soItem ? soItem.nama_varian : 'Varian Tidak Ditemukan';
                const fullProductName = soItem ? `${productName} - ${variantName}` : `Item ID: ${item.id}`;

                return `
                    <div class="outgoing-item" data-product-id="${item.id_produk_inv || item.id}">
                        <div class="outgoing-info">
                            <strong>${fullProductName}</strong>
                            <div class="outgoing-stats">
                                <span>Jumlah Pesanan: ${item.qty_pesan || item.quantity}</span>
                                <span>Sudah Diproses: ${this.getProcessedQuantity(item)}</span>
                                <span>Sisa: ${(item.qty_pesan || item.quantity) - this.getProcessedQuantity(item)}</span>
                            </div>
                        </div>
                        <div class="outgoing-controls">
                            <div class="rack-entries" id="racks-${outgoing.id}-${item.id_produk_inv || item.id}">
                                ${this.renderRackEntries(item, outgoing.id)}
                            </div>
                            <button class="btn btn-sm btn-outline-primary add-more-rack" 
                                data-outgoing-id="${outgoing.id}"
                                data-product-id="${item.id_produk_inv || item.id}"
                                data-action="add-more-rack">
                                <i class="fas fa-plus"></i> Tambah Rak Lain
                            </button>
                        </div>
                    </div>
                    `;
            }).join('')}
            </div>
            
            ${outgoing.preparedBy || outgoing.checkedBy ? `
                <div class="outgoing-signatures">
                    ${outgoing.preparedBy ? `
                        <div class="signature">
                            <strong>Disiapkan oleh:</strong>
                            <div>${outgoing.preparedBy}</div>
                        </div>
                    ` : ''}
                    ${outgoing.checkedBy ? `
                        <div class="signature">
                            <strong>Diperiksa oleh:</strong>
                            <div>${outgoing.checkedBy}</div>
                        </div>
                    ` : ''}
                </div>
            ` : ''}
            
            ${outgoing.history && outgoing.history.length > 0 ? `
                <div class="outgoing-history">
                    <h4>Riwayat Outgoing</h4>
                    <div class="timeline">
                        ${history.map(event => `
                            <div class="timeline-item">
                                <div class="timeline-date">${event.date}</div>
                                <div class="timeline-content">${event.action} oleh ${event.user}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            ` : ''}
        </div>
    `;
        });

        outgoingList.innerHTML = outgoingHTML;

        // Add event listeners
        this.setupOutgoingEventListeners();
    }

    // Method untuk mencari item SO berdasarkan detail ID
    findSoItemByDetailId(detailId) {
        if (!this.currentSo || !this.currentSo.items) return null;

        // Cari di semua items SO
        for (let soItem of this.currentSo.items) {
            if (soItem.id_detail == detailId || soItem.erp__pos__utama__detail_id == detailId) {
                return soItem;
            }
        }

        // Jika tidak ditemukan, coba cari dengan mapping alternatif
        return this.findSoItemByAlternativeMapping(detailId);
    }

    // Method untuk mapping alternatif jika detail ID tidak langsung cocok
    findSoItemByAlternativeMapping(detailId) {
        if (!this.currentSo || !this.currentSo.items) return null;

        // Mapping berdasarkan ID produk atau asset
        for (let soItem of this.currentSo.items) {
            // Coba mapping berdasarkan ID asset
            if (soItem.id_asset_varian_inv == detailId || soItem.id_inventaris__asset__list == detailId) {
                return soItem;
            }

            // Coba mapping berdasarkan ID produk varian
            if (soItem.id_produk_varian_inv == detailId || soItem.id_barang_varian == detailId) {
                return soItem;
            }
        }

        return null;
    }

    // Method untuk mendapatkan quantity yang sudah diproses
    getProcessedQuantity(item) {
        if (!item.breakdown || !Array.isArray(item.breakdown)) return 0;

        return item.breakdown.reduce((total, breakdown) => {
            return total + (parseInt(breakdown.qty_keluar_out) || 0);
        }, 0);
    }

    renderRackEntries(item, outgoingId) {
        if (!item.breakdown || item.breakdown.length === 0) {
            return this.renderRackEntry(item, outgoingId, 0);
        }
        let breakdown = [];

        try {
            if (item.breakdown) {
                if (typeof item.breakdown === 'string') {
                    breakdown = JSON.parse(item.breakdown);
                } else if (Array.isArray(item.breakdown)) {
                    breakdown = item.breakdown;
                }
            }
        } catch (e) {
            console.error('Failed to parse breakdown:', item.breakdown, e);
            breakdown = [];
        }
        return breakdown.map((rack, index) =>
            this.renderRackEntry(item, outgoingId, index, rack)
        ).join('');
    }

    renderRackEntry(item, outgoingId, index, rack = null) {
       

        const remainingQuantity = (item.qty_pesan || item.quantity) - this.getProcessedQuantity(item);
        const maxQuantity = rack ? ((item.qty_pesan || item.quantity) - this.getProcessedQuantity(item) + (rack.qty_keluar_out || 0)) : remainingQuantity;
        alert( rack.id_ruang_simpan_out );
        return `
    <div class="rack-entry" data-index="${index}">
        <div class="rack-selection">
            <select class="form-select rack-select" 
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv || item.id}"
                data-id_ruang_simpan_out="${rack.id_ruang_simpan_out}"
                data-index="${index}">
                <option value="">Pilih Rak</option>
                ${this.warehouseRacks.map(opt => `
                    <option value="${opt.id}" ${rack.id_ruang_simpan_out == opt.id ? 'selected' : ''}>
                        ${opt.name}
                    </option>
                `).join('')}
            </select>
        </div>
        <div class="quantity-input">
            <input type="number" 
                class="form-control rack-quantity"
                min="1"
                max="${maxQuantity}"
                value="${rack ? rack.qty_keluar_out : ''}"
                placeholder="Jumlah"
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv || item.id}"
                data-index="${index}">
        </div>
        ${index > 0 ? `
            <button class="btn btn-sm btn-outline-danger remove-rack" 
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv || item.id}"
                data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        ` : ''}
    </div>
    `;
    }

    // Update method setupOutgoingEventListeners untuk menangani data yang baru
    setupOutgoingEventListeners() {
        // Add more rack buttons
        document.querySelectorAll('[data-action="add-more-rack"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                this.addMoreRack(outgoingId, parseInt(productId));
            });
        });

        // Remove rack buttons
        document.querySelectorAll('.remove-rack').forEach(button => {
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const index = parseInt(e.target.dataset.index);
                this.removeRack(outgoingId, parseInt(productId), index);
            });
        });

        // Rack selection changes
        document.querySelectorAll('.rack-select').forEach(select => {
            select.addEventListener('change', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const index = parseInt(e.target.dataset.index);
                this.handleRackSelection(outgoingId, parseInt(productId), index, e.target.value);
            });
        });

        // Quantity changes
        document.querySelectorAll('.rack-quantity').forEach(input => {
            input.addEventListener('change', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const index = parseInt(e.target.dataset.index);
                this.handleQuantityChange(outgoingId, parseInt(productId), index, parseInt(e.target.value));
            });
        });

        // Action buttons
        document.querySelectorAll('[data-action="view-outgoing"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                this.viewOutgoingDetails(outgoingId);
            });
        });

        document.querySelectorAll('[data-action="edit-outgoing"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                this.editOutgoing(outgoingId);
            });
        });

        document.querySelectorAll('[data-action="complete-outgoing"]').forEach(button => {
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                this.completeOutgoing(outgoingId);
            });
        });
    }

    // Method untuk mendapatkan status class outgoing
    getOutgoingStatusClass(status) {
        const statusMap = {
            'pending': 'status-pending',
            'process': 'status-process',
            'completed': 'status-completed',
            'cancelled': 'status-cancelled'
        };
        return statusMap[status] || 'status-pending';
    }

    // Method untuk mendapatkan teks status outgoing
    getOutgoingStatusText(status) {
        const statusMap = {
            'pending': 'Menunggu',
            'process': 'Diproses',
            'completed': 'Selesai',
            'cancelled': 'Dibatalkan'
        };
        return statusMap[status] || 'Menunggu';
    }
    // Helper methods
    getProcessedQuantity(item) {
        if (!item.racks || item.racks.length === 0) return 0;
        return item.racks.reduce((total, rack) => total + (rack.quantity || 0), 0);
    }

    getOutgoingStatusClass(status) {
        const statusClasses = {
            'pending': 'status-pending',
            'in_progress': 'status-processing',
            'completed': 'status-completed',
            'cancelled': 'status-cancelled'
        };
        return statusClasses[status] || 'status-pending';
    }

    getOutgoingStatusText(status) {
        const statusTexts = {
            'pending': 'Menunggu',
            'in_progress': 'Diproses',
            'completed': 'Selesai',
            'cancelled': 'Dibatalkan'
        };
        return statusTexts[status] || 'Menunggu';
    }

    // Action methods
    addMoreRack(outgoingId, productId) {
        // Cari outgoing dari this.outgoings
        const outgoing = this.outgoings.find(o => o.id === outgoingId || o.primary_key === outgoingId);
        if (!outgoing) return;

        let items = [];
        try {
            if (typeof outgoing.items === 'string') {
                items = JSON.parse(outgoing.items);
            } else if (Array.isArray(outgoing.items)) {
                items = outgoing.items;
            }
        } catch (e) {
            console.error('Failed to parse outgoing.items:', outgoing.items, e);
            items = [];
        }

        const item = items.find(i =>
            i.id_produk_inv === productId ||
            i.productId === productId ||
            i.id === productId
        );
        if (!item) return;

        // Parse breakdown jika ada
        let breakdown = [];
        try {
            if (item.breakdown) {
                if (typeof item.breakdown === 'string') {
                    breakdown = JSON.parse(item.breakdown);
                } else if (Array.isArray(item.breakdown)) {
                    breakdown = item.breakdown;
                }
            }
        } catch (e) {
            console.error('Failed to parse item.breakdown:', item.breakdown, e);
            breakdown = [];
        }

        // Add empty breakdown entry (rack)
        const newBreakdown = {
            id: Date.now() + Math.random().toString(36).substr(2, 9),
            id_erp__pos__inventory: outgoing.id_erp__pos__inventory,
            id_gudang_out: 1, // Default warehouse ID
            id_ruang_simpan_out: '', // Empty rack ID
            harga_beli_out: 0,
            stok_out: 0,
            qty_keluar_out: 0, // Empty quantity
            id_erp__pos__inventory_detail: null,
            id_erp__pos__inventory__outgoing: item.id_erp__pos__inventory__outgoing || null,
            active: 1,
            on_domain: null,
            on_panel: null,
            on_board: null,
            on_role: null,
            privilege: "Private Website",
            create_date: null,
            create_by: null,
            update_date: null,
            update_by: null,
            delete_date: null,
            delete_by: null,
            timezone: null,
            id_: null,
            on_web_apps: null,
            id_barang_keluar_varian: null,
            harga_jual_out: null
        };

        breakdown.push(newBreakdown);

        // Update breakdown di item
        item.breakdown = JSON.stringify(breakdown);

        // Update items di outgoing
        outgoing.items = JSON.stringify(items);

        // Update update_date dan update_by
        outgoing.update_date = new Date().toISOString().replace('T', ' ').substring(0, 19);
        outgoing.update_by = "20250123211111186799"; // User ID admin

        // Re-render the outgoing list
        this.renderOutgoingList();

        // Optional: Simpan perubahan ke server
        this.updateOutgoingOnServer(outgoing);
    }

    // Method untuk update outgoing di server (optional)
    updateOutgoingOnServer(outgoing) {
        // Implementasi API call untuk update outgoing di server
        /*
        fetch(`/api/outgoing/${outgoing.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(outgoing)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Outgoing updated on server:', data);
        })
        .catch(error => {
            console.error('Error updating outgoing:', error);
        });
        */
    }

    removeRack(outgoingId, productId, index) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        const item = outgoing.items.find(i => i.productId === productId);
        if (!item || !item.racks || index >= item.racks.length) return;

        // Remove the rack entry
        item.racks.splice(index, 1);

        // Re-render the outgoing list
        this.renderOutgoingList();
    }

    handleRackSelection(outgoingId, productId, index, rackId) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;
        let items = [];

        try {
            if (typeof outgoing.items === 'string') {
                items = JSON.parse(outgoing.items);
            } else if (Array.isArray(outgoing.items)) {
                items = outgoing.items;
            }
        } catch (e) {
            console.error('Failed to parse outgoing.items:', outgoing.items, e);
            items = [];
        }
        const item = items.find(i => i.productId === productId);
        if (!item || !item.racks || index >= item.racks.length) return;

        const selectedRack = this.warehouseRacks.find(r => r.id === rackId);
        if (selectedRack) {
            item.racks[index] = {
                ...item.racks[index],
                rackId: selectedRack.id,
                rackName: selectedRack.name
            };
        }
    }

    handleQuantityChange(outgoingId, productId, index, quantity) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        const item = outgoing.items.find(i => i.productId === productId);
        if (!item || !item.racks || index >= item.racks.length) return;

        // Validate quantity
        const maxQuantity = item.quantity - this.getProcessedQuantity(item) + (item.racks[index].quantity || 0);
        const validQuantity = Math.min(Math.max(1, quantity), maxQuantity);

        // Update quantity
        item.racks[index].quantity = validQuantity;

        // Re-render to update other quantity inputs
        this.renderOutgoingList();
    }

    viewOutgoingDetails(outgoingId) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        // Show outgoing details in modal or expandable section
        alert(`Detail Outgoing: ${outgoing.id}\nStatus: ${this.getOutgoingStatusText(outgoing.status)}`);
    }

    editOutgoing(outgoingId) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        // Implement edit functionality
        alert(`Edit Outgoing: ${outgoing.id}`);
    }

    completeOutgoing(outgoingId) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        if (confirm(`Selesaikan outgoing ${outgoing.id}?`)) {
            outgoing.status = 'completed';
            outgoing.checkedBy = 'Admin'; // In real app, this would be the current user

            // Add to history
            if (!outgoing.history) outgoing.history = [];
            outgoing.history.push({
                date: new Date().toISOString().split('T')[0],
                action: "Outgoing selesai",
                user: "Admin"
            });

            // Re-render the outgoing list
            this.renderOutgoingList();
            alert(`Outgoing ${outgoing.id} telah diselesaikan`);
        }
    }

    // Add delivery order
    addDeliveryOrder() {
        if (!this.currentSo) return;

        const deliveryType = document.getElementById('deliveryType').value;
        if (!deliveryType) {
            alert('Pilih jenis pengiriman terlebih dahulu');
            return;
        }

        // Generate delivery ID
        const deliveryId = Date.now().toString();

        // Prepare base delivery data
        let deliveryData = {
            id: deliveryId,
            nomor_do: null,
            tanggal_do: new Date().toISOString().split('T')[0],
            kode_pengiriman: null,
            id_store_ongkir: "4",
            asal: null,
            id_bangunan_asal: null,
            id_provinsi_asal: "9",
            id_kota_asal: "23",
            id_kecamatan_asal: "343",
            id_kelurahan_asal: "31151",
            nomor_asal: "398",
            alamat_asal: "Jalan Mochammad Toha",
            rt_asal: null,
            rw_asal: null,
            tujuan: null,
            id_bangunan_tujuan: "60",
            id_provinsi_tujuan: "9",
            id_kota_tujuan: "23",
            id_kecamatan_tujuan: "362",
            id_kelurahan_tujuan: "26954",
            nomor_tujuan: null,
            alamat_tujuan: "Jalan Saluyu Indah XVIII no 170",
            rt_tujuan: null,
            rw_tujuan: null,
            total_berat: "0",
            id_ekpedisi: null,
            id_service: null,
            ongkir: "0",
            harga_diskon_ongkir: null,
            ongkir_akhir: "0",
            active: "1",
            on_domain: "moesneeds.id",
            on_panel: "333",
            on_board: "42",
            on_role: "0",
            privilege: "Private Website",
            create_date: new Date().toISOString().replace('T', ' ').substring(0, 19),
            create_by: "20250123211111186799",
            update_date: null,
            update_by: null,
            delete_date: null,
            delete_by: null,
            timezone: "Asia/Jakarta",
            id_erp__pos__utama: this.currentSo.id,
            id_erp__pos__delivery_order: deliveryId,
            tanggal_kirim: null,
            harga_kirim: null,
            nomor_resi: "-",
            status_pickup_kurir: null,
            paket_ongkir: "LAIN-LAIN",
            estimasi_kirim: "0",
            on_web_apps: "3",
            nama_pengirim: null,
            nomor_pengirim: "0895334908800",
            nama_penerima: null,
            nomor_penerima: null,
            kode_booking: "-",
            no_bangunan_asal: null,
            patokan_asal: null,
            no_bangunan_tujuan: null,
            patokan_tujuan: null,
            tipe_pemesanan: deliveryType,
            dropship_toko: null,
            nomor_resi_ecommerce: null,
            ekspedisi_ecommerce: null,
            service_ecommerce: null,
            plaform_ecommerce: null,
            file_resi_ecommerce: null,
            detail: [],
            status: 'pending',
            history: [
                {
                    date: new Date().toISOString().split('T')[0],
                    action: "Delivery order dibuat",
                    user: "Admin"
                }
            ]
        };

        // Handle different delivery types
        if (deliveryType === 'dropship_ecommerce') {
            deliveryData.nomor_resi_ecommerce = document.getElementById('ecommerceTracking').value;
            deliveryData.ekspedisi_ecommerce = document.getElementById('ecommerceExpedition').value;
        } else if (deliveryType === 'dropship_non_ecommerce') {
            deliveryData.nomor_resi = document.getElementById('nonEcommerceTracking').value;
            deliveryData.id_ekpedisi = document.getElementById('nonEcommerceExpedition').value;
        } else if (deliveryType === 'regular') {
            deliveryData.alamat_tujuan = document.getElementById('recipientAddress').value;
            deliveryData.id_ekpedisi = document.getElementById('regularExpedition').value;
            deliveryData.ongkir = document.getElementById('shippingCost').value;
            deliveryData.ongkir_akhir = document.getElementById('shippingCost').value;
        }

        // Add selected items to delivery
        const selectedItems = this.getSelectedItemsForDelivery();
        if (selectedItems.length === 0) {
            alert('Pilih minimal 1 item untuk dikirim');
            return;
        }

        deliveryData.detail = selectedItems.map(item => ({
            id: Date.now() + Math.random(),
            id_inventaris__asset__list_do: item.id,
            qty_pesan_do: item.qty_pesan,
            berat_satuan_do: item.berat_satuan,
            berat_total_do: (item.berat_satuan * item.qty_dikirim),
            qty_kirim: item.qty_dikirim,
            sisa_qty_kirim: (item.qty_pesan - item.qty_dikirim),
            id_erp__pos__utama: this.currentSo.id,
            id_erp__pos__delivery_order: deliveryId,
            active: "1",
            on_domain: "moesneeds.id",
            on_panel: "333",
            on_board: "42",
            on_role: "0",
            privilege: "Private Website",
            create_date: new Date().toISOString().replace('T', ' ').substring(0, 19),
            create_by: "20250123211111186799",
            update_date: null,
            update_by: null,
            delete_date: null,
            delete_by: null,
            timezone: "Asia/Jakarta"
        }));

        // Calculate total weight
        deliveryData.total_berat = deliveryData.detail.reduce((total, item) =>
            total + parseFloat(item.berat_total_do), 0).toString();

        if (!this.currentSo.deliveryOrders) this.currentSo.deliveryOrders = [];
        this.currentSo.deliveryOrders.push(deliveryData);

        document.getElementById('deliveryModal').style.display = 'none';
        this.renderDeliverySummary();
        this.renderDeliveryList();
        alert('Delivery order berhasil ditambahkan!');
    }

    // Get selected items for delivery
    getSelectedItemsForDelivery() {
        const selectedItems = [];
        const itemCheckboxes = document.querySelectorAll('.item-checkbox:checked');

        itemCheckboxes.forEach(checkbox => {
            const itemId = checkbox.dataset.itemId;
            const qtyInput = document.querySelector(`.qty-kirim[data-item-id="${itemId}"]`);
            const qtyDikirim = parseInt(qtyInput.value) || 0;

            if (qtyDikirim > 0) {
                const item = this.currentSo.items.find(item => item.id == itemId);
                if (item) {
                    selectedItems.push({
                        ...item,
                        qty_dikirim: qtyDikirim
                    });
                }
            }
        });

        return selectedItems;
    }

    // Render delivery summary cards
    renderDeliverySummary() {
        if (!this.currentSo) return;

        const items = this.currentSo.items || [];
        const deliveryOrders = this.currentSo.deliveryOrders || [];

        // Calculate statistics
        const totalBarang = items.reduce((sum, item) => sum + (parseInt(item.qty_pesan) || 0), 0);

        let totalBelumKirim = totalBarang;
        let totalDalamPengiriman = 0;

        deliveryOrders.forEach(delivery => {
            delivery.detail.forEach(item => {
                totalBelumKirim -= (parseInt(item.qty_kirim) || 0);
                if (delivery.status !== 'delivered') {
                    totalDalamPengiriman += (parseInt(item.qty_kirim) || 0);
                }
            });
        });

        const summaryHTML = `
        <div class="delivery-summary-cards">
            <div class="summary-card">
                <div class="summary-title">Total Barang</div>
                <div class="summary-value">${totalBarang}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Belum Dikirim</div>
                <div class="summary-value">${totalBelumKirim}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Dalam Pengiriman</div>
                <div class="summary-value">${totalDalamPengiriman}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Sudah Diterima</div>
                <div class="summary-value">${totalBarang - totalBelumKirim - totalDalamPengiriman}</div>
            </div>
        </div>
    `;

        document.getElementById('deliverySummary').innerHTML = summaryHTML;
    }

    // Render delivery list
    renderDeliveryList() {
        if (!this.currentSo) return;
        // alert();

        this.currentSo.deliveryOrders = this.deliveryOrders.filter(p => p.id_erp__pos__group === this.currentSo.primary_key);
        console.log(this.currentSo.deliveryOrders);
        let deliveryHTML = '';

        this.currentSo.deliveryOrders.forEach(delivery => {
            const expeditionName = this.getExpeditionName(delivery.id_ekpedisi);
            const totalItems = Array.isArray(delivery?.detail)
                ? delivery.detail.reduce((sum, item) => sum + parseInt(item.qty_kirim || 0), 0)
                : 0;

            deliveryHTML += `
            <div class="delivery-order-card">
                <div class="delivery-header">
                    <div class="delivery-title">Delivery Order: ${delivery.id}</div>
                    <div class="delivery-actions">
                        <button class="btn btn-sm btn-info" onclick="app.trackDelivery('${delivery.id}')">
                            Tracking
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="app.editDelivery('${delivery.id}')">
                            Edit Items
                        </button>
                        ${delivery.status === 'pending' ? `
                            <button class="btn btn-sm btn-primary" onclick="app.confirmToExpedition('${delivery.id}')">
                                Konfirmasi ke Ekspedisi
                            </button>
                        ` : ''}
                    </div>
                </div>
                <div class="delivery-info-grid">
                    <div class="info-item">
                        <span class="info-label">Jenis:</span>
                        <span class="info-value">${this.getDeliveryTypeName(delivery.tipe_pemesanan)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value ${delivery.status}">${this.getStatusName(delivery.status)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal DO:</span>
                        <span class="info-value">${delivery.tanggal_do}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Ekspedisi:</span>
                        <span class="info-value">${expeditionName}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Items:</span>
                        <span class="info-value">${totalItems} item</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Berat:</span>
                        <span class="info-value">${delivery.total_berat} gram</span>
                    </div>
                    ${delivery.nomor_resi_ecommerce ? `
                        <div class="info-item">
                            <span class="info-label">No. Resi Ecommerce:</span>
                            <span class="info-value">${delivery.nomor_resi_ecommerce}</span>
                        </div>
                    ` : ''}
                    ${delivery.nomor_resi && delivery.nomor_resi !== '-' ? `
                        <div class="info-item">
                            <span class="info-label">No. Resi:</span>
                            <span class="info-value">${delivery.nomor_resi}</span>
                        </div>
                    ` : ''}
                </div>
                
                <div class="delivery-items">
                    <h5>Items dalam pengiriman:</h5>
                    ${Array.isArray(delivery?.detail)
                    ? delivery.detail.map(item => `
							<div class="delivery-item">
							  <span class="item-name">${this.getItemName(item.id_inventaris__asset__list_do)}</span>
							  <span class="item-qty">${item.qty_kirim} pcs</span>
							</div>
						  `).join('')
                    : '<div class="delivery-item">Tidak ada item dikirim.</div>'
                }
                </div>

                <div class="timeline">
                   ${(delivery.history || []).map(event => `
    <div class="timeline-item">
        <div class="timeline-date">${event.date}</div>
        <div class="timeline-content">${event.action} - ${event.user}</div>
    </div>
`).join('')}

                </div>
            </div>
        `;
        });

        document.getElementById('deliveryList').innerHTML = deliveryHTML;
    }

    // Additional helper methods
    getExpeditionName(expeditionId) {
        const expeditions = {
            "24": "JNE",
            "25": "TIKI",
            "26": "POS Indonesia"
            // Add more expeditions as needed
        };
        return expeditions[expeditionId] || expeditionId;
    }

    getDeliveryTypeName(type) {
        const types = {
            'dropship_ecommerce': 'Dropship Ecommerce',
            'dropship_non_ecommerce': 'Dropship Non-Ecommerce',
            'regular': 'Regular'
        };
        return types[type] || type;
    }

    getStatusName(status) {
        const statuses = {
            'pending': 'Menunggu',
            'confirmed': 'Terkonfirmasi',
            'shipped': 'Dikirim',
            'delivered': 'Diterima'
        };
        return statuses[status] || status;
    }

    getItemName(itemId) {
        // This should be implemented based on your item data structure
        return `Item ${itemId}`;
    }

    // Track delivery
    trackDelivery(deliveryId) {
        const delivery = this.currentSo.deliveryOrders.find(dod => dod.id === deliveryId);
        if (delivery) {
            if (delivery.nomor_resi && delivery.nomor_resi !== '-') {
                // Open tracking in new window
                window.open(`https://tracking-ekspedisi.com/track/${delivery.nomor_resi}`, '_blank');
            } else {
                alert('Nomor resi belum tersedia untuk tracking');
            }
        }
    }

    // Confirm to expedition
    confirmToExpedition(deliveryId) {
        const delivery = this.currentSo.deliveryOrders.find(dod => dod.id === deliveryId);
        if (delivery && confirm('Konfirmasi pengiriman ke ekspedisi?')) {
            delivery.status = 'confirmed';
            delivery.history.push({
                date: new Date().toISOString().split('T')[0],
                action: "Dikonfirmasi ke ekspedisi",
                user: "Admin"
            });
            this.renderDeliveryList();
            alert('Pengiriman berhasil dikonfirmasi ke ekspedisi');
        }
    }

    // Edit delivery items
    editDelivery(deliveryId) {
        const delivery = this.currentSo.deliveryOrders.find(dod => dod.id === deliveryId);
        if (delivery && delivery.status === 'pending') {
            // Implement edit functionality
            this.openEditDeliveryModal(delivery);
        } else {
            alert('Hanya delivery order dengan status pending yang bisa diedit');
        }
    }

    // Add payment
    addPayment() {
        if (!this.currentSo) return;

        const paymentMethod = document.getElementById('selectedPaymentMethod').value;
        if (!paymentMethod) {
            alert('Pilih metode pembayaran terlebih dahulu');
            return;
        }

        const paymentId = `PAY-${Date.now().toString().slice(-6)}`;
        let paymentData = {
            id: paymentId,
            method: paymentMethod,
            date: new Date().toISOString().split('T')[0],
            status: 'pending',
            history: [
                {
                    date: new Date().toISOString().split('T')[0],
                    action: "Pembayaran dibuat",
                    user: "Admin"
                }
            ]
        };

        if (paymentMethod === 'manual') {
            paymentData.bank = document.getElementById('manualBank').value;
            paymentData.accountName = document.getElementById('manualName').value;
            paymentData.accountNumber = document.getElementById('manualAccount').value;
            paymentData.amount = document.getElementById('manualAmount').value;
            paymentData.paymentDate = document.getElementById('manualDate').value;
            paymentData.confirmation = document.getElementById('manualConfirmation').value;
            // File handling would be implemented in a real app
        } else if (paymentMethod === 'va') {
            paymentData.bank = document.getElementById('vaBank').value;
            paymentData.vaNumber = document.getElementById('vaNumber').value;
        } else if (paymentMethod === 'ewallet') {
            paymentData.provider = document.getElementById('ewalletProvider').value;
            paymentData.phone = document.getElementById('ewalletPhone').value;
        }

        if (!this.currentSo.payments) this.currentSo.payments = [];
        this.currentSo.payments.push(paymentData);

        document.getElementById('paymentModal').style.display = 'none';
        this.renderPaymentList();
        alert('Pembayaran berhasil ditambahkan!');
    }
    renderPaymentList() {
        if (!this.currentSo) return;
        this.currentSo.payments = this.payments.find(p => p.id_erp__pos__group === this.currentSo.primary_key);
        console.log(this.currentSo.payments);
        let paymentHTML = '';
        const payment = this.currentSo.payments; // Mengambil data payment utama

        // Hitung total berbagai status
        const totals = this.calculatePaymentTotals(payment.split_bill);

        // Header informasi pembayaran
        paymentHTML += `
        <div class="payment-summary-card">
            <div class="payment-summary-header">
                <h4>Informasi Pembayaran</h4>
                <div class="payment-reference">
                    <span>No. Payment: ${payment.id_erp__pos__payment || payment.id}</span>
                    <span>Tanggal: ${payment.tanggal_payment}</span>
                </div>
            </div>
            <div class="payment-summary-grid">
                <div class="summary-item total-bayar">
                    <span class="summary-label">Total Bayar</span>
                    <span class="summary-value">${this.formatCurrency(payment.total_bayar)}</span>
                </div>
                <div class="summary-item belum-bayar">
                    <span class="summary-label">Belum Bayar</span>
                    <span class="summary-value">${this.formatCurrency(totals.belumBayar)}</span>
                </div>
                <div class="summary-item pending-approval">
                    <span class="summary-label">Pending Approval</span>
                    <span class="summary-value">${this.formatCurrency(totals.pendingApproval)}</span>
                </div>
                <div class="summary-item gagal">
                    <span class="summary-label">Gagal</span>
                    <span class="summary-value">${this.formatCurrency(totals.gagal)}</span>
                </div>
            </div>
        </div>
    `;

        // List split bill (pembayaran)
        if (payment.split_bill && payment.split_bill.length > 0) {
            payment.split_bill.forEach(split => {
                const statusClass = this.getStatusClass(split.status_bayar);
                const konfirmasi = split.konfirm && split.konfirm.length > 0 ? split.konfirm[0] : null;

                paymentHTML += `
                <div class="payment-method-card">
                    <div class="payment-method-header">
                        <div class="payment-method-title">
                            ${split.nama_payment} - ${split.brand_nama}
                            ${split.no_rek ? ` (${split.no_rek})` : ''}
                        </div>
                        <div class="payment-status ${statusClass}">
                            ${this.getStatusText(split.status_bayar)}
                        </div>
                    </div>
                    <div class="payment-method-details">
                        <div class="info-item">
                            <span class="info-label">Metode:</span>
                            <span class="info-value">${split.nama_payment}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Bank/Provider:</span>
                            <span class="info-value">${split.brand_nama}</span>
                        </div>
                        ${split.no_rek ? `
                            <div class="info-item">
                                <span class="info-label">No. Rekening/VA:</span>
                                <span class="info-value">${split.no_rek}</span>
                            </div>
                        ` : ''}
                        ${split.an ? `
                            <div class="info-item">
                                <span class="info-label">Atas Nama:</span>
                                <span class="info-value">${split.an}</span>
                            </div>
                        ` : ''}
                        <div class="info-item">
                            <span class="info-label">Jumlah:</span>
                            <span class="info-value">${this.formatCurrency(split.jumlah_bayar)}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value ${statusClass}">${this.getStatusText(split.status_bayar)}</span>
                        </div>
                        
                        ${konfirmasi ? this.renderKonfirmasi(konfirmasi) : ''}
                        
                        ${split.status_bayar === 'belum' || split.status_bayar === 'pending' ? `
                            <div class="payment-actions">
                                <button class="btn btn-sm btn-primary add-konfirmasi" 
                                        data-split-id="${split.id}">
                                    <i class="fas fa-plus"></i> Tambah Konfirmasi Pembayaran
                                </button>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
            });
        }

        document.getElementById('paymentList').innerHTML = paymentHTML;

        // Tambahkan event listener untuk tombol tambah konfirmasi
        this.addKonfirmasiEventListeners();
    }

    // Fungsi bantuan untuk menghitung total
    calculatePaymentTotals(splitBills) {
        const totals = {
            totalBayar: 0,
            belumBayar: 0,
            pendingApproval: 0,
            gagal: 0
        };

        if (!splitBills) return totals;

        splitBills.forEach(split => {
            const amount = parseFloat(split.jumlah_bayar) || 0;

            switch (split.status_bayar) {
                case 'lunas':
                    totals.totalBayar += amount;
                    break;
                case 'belum':
                    totals.belumBayar += amount;
                    break;
                case 'pending':
                    totals.pendingApproval += amount;
                    break;
                case 'gagal':
                case 'rejected':
                    totals.gagal += amount;
                    break;
            }
        });

        return totals;
    }

    // Fungsi untuk render konfirmasi pembayaran
    renderKonfirmasi(konfirmasi) {
        const statusClass = this.getKonfirmasiStatusClass(konfirmasi.status_approve);

        return `
        <div class="konfirmasi-section">
            <h5>Konfirmasi Pembayaran</h5>
            <div class="info-item">
                <span class="info-label">Nama Rekening:</span>
                <span class="info-value">${konfirmasi.nama_rekening_pengirim || '-'}</span>
            </div>
            <div class="info-item">
                <span class="info-label">No. Rekening:</span>
                <span class="info-value">${konfirmasi.nomor_rekening_pengirim || '-'}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Bayar:</span>
                <span class="info-value">${konfirmasi.tanggal_pembayaran || '-'}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Nominal:</span>
                <span class="info-value">${this.formatCurrency(konfirmasi.nominal_bayar)}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value ${statusClass}">${this.getKonfirmasiStatusText(konfirmasi.status_approve)}</span>
            </div>
            ${konfirmasi.status_approve === null ? `
                <div class="konfirmasi-actions">
                    <button class="btn btn-sm btn-success approve-konfirmasi" 
                            data-konfirmasi-id="${konfirmasi.id}">
                        <i class="fas fa-check"></i> Approve
                    </button>
                    <button class="btn btn-sm btn-danger reject-konfirmasi" 
                            data-konfirmasi-id="${konfirmasi.id}">
                        <i class="fas fa-times"></i> Reject
                    </button>
                </div>
            ` : ''}
        </div>
    `;
    }

    // Fungsi bantuan untuk class status
    getStatusClass(status) {
        switch (status) {
            case 'lunas': return 'status-success';
            case 'belum': return 'status-warning';
            case 'pending': return 'status-info';
            case 'gagal':
            case 'rejected': return 'status-danger';
            default: return 'status-secondary';
        }
    }

    getStatusText(status) {
        const statusMap = {
            'lunas': 'Lunas',
            'belum': 'Belum Bayar',
            'pending': 'Menunggu Konfirmasi',
            'gagal': 'Gagal',
            'rejected': 'Ditolak'
        };
        return statusMap[status] || status;
    }

    getKonfirmasiStatusClass(status) {
        if (status === null) return 'status-warning';
        if (status === true || status === 'approved') return 'status-success';
        if (status === false || status === 'rejected') return 'status-danger';
        return 'status-secondary';
    }

    getKonfirmasiStatusText(status) {
        if (status === null) return 'Menunggu Approval';
        if (status === true || status === 'approved') return 'Terkonfirmasi';
        if (status === false || status === 'rejected') return 'Ditolak';
        return 'Unknown';
    }

    // Event listeners untuk konfirmasi
    addKonfirmasiEventListeners() {
        // Tambah konfirmasi
        document.querySelectorAll('.add-konfirmasi').forEach(button => {
            button.addEventListener('click', (e) => {
                const splitId = e.target.dataset.splitId;
                this.showKonfirmasiModal(splitId);
            });
        });

        // Approve konfirmasi
        document.querySelectorAll('.approve-konfirmasi').forEach(button => {
            button.addEventListener('click', (e) => {
                const konfirmasiId = e.target.dataset.konfirmasiId;
                this.approveKonfirmasi(konfirmasiId, true);
            });
        });

        // Reject konfirmasi
        document.querySelectorAll('.reject-konfirmasi').forEach(button => {
            button.addEventListener('click', (e) => {
                const konfirmasiId = e.target.dataset.konfirmasiId;
                this.approveKonfirmasi(konfirmasiId, false);
            });
        });
    }
    showKonfirmasiModal(splitId) {
        const modalHTML = `
        <div class="modal" id="konfirmasiModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-money-bill-wave"></i> Konfirmasi Pembayaran</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="konfirmasiForm">
                        <input type="hidden" id="splitId" value="${splitId}">
                        <div class="form-group">
                            <label class="form-label">Nama Rekening Pengirim</label>
                            <input type="text" class="form-input" id="namaRekening" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Rekening Pengirim</label>
                            <input type="text" class="form-input" id="nomorRekening" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-input" id="tanggalPembayaran" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nominal Pembayaran</label>
                            <input type="number" class="form-input" id="nominalBayar" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-input" id="buktiPembayaran">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Catatan (Optional)</label>
                            <textarea class="form-input" id="catatan" rows="3"></textarea>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger close-modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;

        // Tambahkan modal ke DOM
        document.body.insertAdjacentHTML('beforeend', modalHTML);

        // Setup event listeners
        this.setupKonfirmasiModalEvents();
    }

    setupKonfirmasiModalEvents() {
        const modal = document.getElementById('konfirmasiModal');
        const form = document.getElementById('konfirmasiForm');

        // Close modal
        modal.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                modal.remove();
            });
        });

        // Submit form
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.submitKonfirmasi();
        });
    }

    async submitKonfirmasi() {
        const form = document.getElementById('konfirmasiForm');
        const formData = new FormData();

        formData.append('split_id', document.getElementById('splitId').value);
        formData.append('nama_rekening', document.getElementById('namaRekening').value);
        formData.append('nomor_rekening', document.getElementById('nomorRekening').value);
        formData.append('tanggal_pembayaran', document.getElementById('tanggalPembayaran').value);
        formData.append('nominal_bayar', document.getElementById('nominalBayar').value);
        formData.append('catatan', document.getElementById('catatan').value);

        const fileInput = document.getElementById('buktiPembayaran');
        if (fileInput.files[0]) {
            formData.append('file_pembayaran', fileInput.files[0]);
        }

        try {
            // Kirim data ke server
            const response = await fetch('/api/konfirmasi-pembayaran', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                alert('Konfirmasi pembayaran berhasil dikirim');
                document.getElementById('konfirmasiModal').remove();
                this.renderPaymentList(); // Refresh list
            } else {
                throw new Error('Gagal mengirim konfirmasi');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal mengirim konfirmasi pembayaran');
        }
    }

    async approveKonfirmasi(konfirmasiId, approve) {
        if (!confirm(`Apakah Anda yakin ingin ${approve ? 'mengapprove' : 'menolak'} konfirmasi ini?`)) {
            return;
        }

        try {
            const response = await fetch('/api/approve-konfirmasi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    konfirmasi_id: konfirmasiId,
                    status: approve ? 'approved' : 'rejected'
                })
            });

            if (response.ok) {
                alert(`Konfirmasi berhasil ${approve ? 'diapprove' : 'ditolak'}`);
                this.renderPaymentList(); // Refresh list
            } else {
                throw new Error('Gagal memproses konfirmasi');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal memproses konfirmasi');
        }
    }
    // Render payment list
    renderPayment2List() {
        if (!this.currentSo || !this.currentSo.payments) return;

        let paymentHTML = '';

        this.currentSo.payments.forEach(payment => {
            paymentHTML += `
                        <div class="payment-method-card">
                            <div class="payment-method-header">
                                <div class="payment-method-title">Pembayaran: ${payment.id}</div>
                            </div>
                            <div class="payment-method-details">
                                <div class="info-item">
                                    <span class="info-label">Metode:</span>
                                    <span class="info-value">${this.getPaymentMethodText(payment.method)}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Status:</span>
                                    <span class="info-value">${payment.status}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Tanggal:</span>
                                    <span class="info-value">${payment.date}</span>
                                </div>
                                ${payment.bank ? `
                                    <div class="info-item">
                                        <span class="info-label">Bank:</span>
                                        <span class="info-value">${payment.bank}</span>
                                    </div>
                                ` : ''}
                                ${payment.amount ? `
                                    <div class="info-item">
                                        <span class="info-label">Jumlah:</span>
                                        <span class="info-value">${this.formatCurrency(payment.amount)}</span>
                                    </div>
                                ` : ''}
                                ${payment.confirmation ? `
                                    <div class="info-item">
                                        <span class="info-label">Konfirmasi:</span>
                                        <span class="info-value">${payment.confirmation}</span>
                                    </div>
                                ` : ''}
                                <div class="timeline">
                                    ${payment.history.map(event => `
                                        <div class="timeline-item">
                                            <div class="timeline-date">${event.date}</div>
                                            <div class="timeline-content">${event.action}</div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        </div>
                    `;
        });

        document.getElementById('paymentList').innerHTML = paymentHTML;
    }

    // Add retur
    addRetur() {
        if (!this.currentSo) return;
        alert('Fitur retur akan ditambahkan');
    }

    // Add refund
    addRefund() {
        if (!this.currentSo) return;
        alert('Fitur refund akan ditambahkan');
    }

    // Render retur list
    renderReturList() {
        // Implementation for retur list
    }

    // Render refund list
    renderRefundList() {
        // Implementation for refund list
    }

    // Filter sales orders
    filterSalesOrders() {
        const searchTerm = document.getElementById('searchSo').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const sourceFilter = document.getElementById('sourceFilter').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        this.filteredSalesOrders = this.salesOrders.filter(so => {
            const matchesSearch = so.primary_key.toLowerCase().includes(searchTerm) ||
                so.customer.name.toLowerCase().includes(searchTerm);
            const matchesStatus = !statusFilter || so.status === statusFilter;
            const matchesSource = !sourceFilter || so.source === sourceFilter;
            const matchesDate = (!startDate || so.date >= startDate) &&
                (!endDate || so.date <= endDate);

            return matchesSearch && matchesStatus && matchesSource && matchesDate;
        });

        this.renderSoList();
    }

    // Helper functions
    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    getStatusClass(status) {
        const statusClasses = {
            draft: 'status-draft',
            pending: 'status-pending',
            confirmed: 'status-confirmed',
            processing: 'status-processing',
            shipped: 'status-shipped',
            delivered: 'status-delivered',
            completed: 'status-completed',
            cancelled: 'status-cancelled',
            refunded: 'status-refunded'
        };
        return statusClasses[status] || 'status-draft';
    }

    getStatusText(status) {
        const statusTexts = {
            draft: 'Draft',
            pending: 'Pending',
            confirmed: 'Dikonfirmasi',
            processing: 'Diproses',
            shipped: 'Dikirim',
            delivered: 'Terkirim',
            completed: 'Selesai',
            cancelled: 'Dibatalkan',
            refunded: 'Dikembalikan'
        };
        return statusTexts[status] || 'Draft';
    }

    getTypeClass(type) {
        const typeClasses = {
            online: 'type-online',
            marketplace: 'type-marketplace',
            offline: 'type-offline',
            corporate: 'type-corporate'
        };
        return typeClasses[type] || 'type-online';
    }

    getTypeText(type) {
        const typeTexts = {
            online: 'Online',
            marketplace: 'Marketplace',
            offline: 'Offline',
            corporate: 'Corporate'
        };
        return typeTexts[type] || 'Online';
    }

    getCourierText(courier) {
        const courierTexts = {
            jne: 'JNE',
            tiki: 'TIKI',
            pos: 'POS Indonesia',
            jnt: 'J&T',
            pickup: 'Ambil di Toko'
        };
        return courierTexts[courier] || courier;
    }

    getServiceText(service) {
        const serviceTexts = {
            REG: 'Reguler',
            YES: 'Yes',
            OKE: 'Oke',
            SDS: 'Same Day'
        };
        return serviceTexts[service] || service;
    }

    getShippingStatusText(status) {
        const statusTexts = {
            pending: 'Menunggu',
            processing: 'Diproses',
            shipped: 'Dikirim',
            delivered: 'Terkirim',
            cancelled: 'Dibatalkan'
        };
        return statusTexts[status] || status;
    }

    getPaymentMethodText(method) {
        const methodTexts = {
            transfer: 'Transfer Bank',
            credit_card: 'Kartu Kredit',
            cod: 'COD',
            e_wallet: 'E-Wallet'
        };
        return methodTexts[method] || method;
    }

    getPaymentStatusText(status) {
        const statusTexts = {
            pending: 'Menunggu',
            paid: 'Dibayar',
            confirmed: 'Dikonfirmasi',
            cancelled: 'Dibatalkan'
        };
        return statusTexts[status] || status;
    }

    // Methods for action buttons in list view
    editSo(soId) {
        this.openSoModal(soId);
    }

    processSoFromList(soId) {
        this.currentSo = this.salesOrders.find(so => so.primary_key === soId);
        if (this.currentSo) {
            this.processSo();
        }
    }

    shipSoFromList(soId) {
        this.currentSo = this.salesOrders.find(so => so.primary_key === soId);
        if (this.currentSo) {
            this.processSo();
        }
    }

    completeSoFromList(soId) {
        this.currentSo = this.salesOrders.find(so => so.primary_key === soId);
        if (this.currentSo) {
            this.processSo();
        }
    }

    printInvoiceFromList(soId) {
        this.currentSo = this.salesOrders.find(so => so.primary_key === soId);
        if (this.currentSo) {
            this.printInvoice();
        }
    }
}

let additionalCSS2 = `
        :root {
            --primary: #4a6cf7;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
            --online: #20c997;
            --marketplace: #e83e8c;
            --offline: #fd7e14;
            --corporate: #6f42c1;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary), #2c4fd4);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        .logo i {
            margin-right: 15px;
            font-size: 36px;
        }
        
        .subtitle {
            font-size: 18px;
            opacity: 0.9;
        }
        
        .admin-container {
            display: flex;
            min-height: 600px;
        }
        
        .admin-sidebar {
            width: 250px;
            background: #f8f9fa;
            border-right: 1px solid #eee;
            padding: 20px 0;
        }
        
        .admin-content {
            flex: 1;
            padding: 25px;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .back-button {
            padding: 8px 16px;
            background: #f0f5ff;
            color: var(--primary);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        
        .back-button i {
            margin-right: 8px;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        
        .menu-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        
        .menu-item:hover {
            background: #e9ecef;
        }
        
        .menu-item.active {
            background: #f0f5ff;
            border-left-color: var(--primary);
            color: var(--primary);
            font-weight: 500;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .admin-title {
            font-size: 24px;
            color: var(--dark);
        }
        
        .admin-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: #3a5fd8;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .btn-warning {
            background: var(--warning);
            color: white;
        }
        
        .btn-warning:hover {
            background: #e0a800;
        }
        
        .btn-info {
            background: var(--info);
            color: white;
        }
        
        .btn-info:hover {
            background: #138496;
        }
        
        .btn-online {
            background: var(--online);
            color: white;
        }
        
        .btn-online:hover {
            background: #1aa87d;
        }
        
        .btn-marketplace {
            background: var(--marketplace);
            color: white;
        }
        
        .btn-marketplace:hover {
            background: #d91a72;
        }
        
        .btn-offline {
            background: var(--offline);
            color: white;
        }
        
        .btn-offline:hover {
            background: #e56a0c;
        }
        
        .btn-corporate {
            background: var(--corporate);
            color: white;
        }
        
        .btn-corporate:hover {
            background: #5a32a3;
        }
        
        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-label {
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--secondary);
            font-weight: 500;
        }
        
        .filter-input, .filter-select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--primary);
        }
        
        .stat-card.pending {
            border-top-color: var(--warning);
        }
        
        .stat-card.processing {
            border-top-color: var(--info);
        }
        
        .stat-card.shipped {
            border-top-color: var(--online);
        }
        
        .stat-card.completed {
            border-top-color: var(--success);
        }
        
        .stat-card.cancelled {
            border-top-color: var(--danger);
        }
        
        .stat-title {
            font-size: 14px;
            color: var(--secondary);
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: var(--dark);
        }
        
        .orders-table-container {
            overflow-x: auto;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .orders-table th {
            background: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 2px solid #eee;
        }
        
        .orders-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .orders-table tr:hover {
            background: #f8f9fa;
        }
        
        .order-id {
            font-weight: 500;
            color: var(--primary);
        }
        
        .customer-name {
            font-weight: 500;
        }
        
        .customer-email {
            font-size: 13px;
            color: var(--secondary);
        }
        
        .order-date {
            color: var(--secondary);
        }
        
        .order-total {
            font-weight: 600;
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-draft {
            background: #f5f5f5;
            color: #616161;
        }
        
        .status-pending {
            background: #fff8e1;
            color: #ff8f00;
        }
        
        .status-confirmed {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .status-processing {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .status-shipped {
            background: #fff8e1;
            color: #ff8f00;
        }
        
        .status-delivered {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-completed {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-cancelled {
            background: #ffebee;
            color: #c62828;
        }
        
        .status-refunded {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        
        .type-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            display: inline-block;
            margin-left: 5px;
        }
        
        .type-online {
            background: #d1f2eb;
            color: var(--online);
        }
        
        .type-marketplace {
            background: #f8d7e6;
            color: var(--marketplace);
        }
        
        .type-offline {
            background: #ffe8d6;
            color: var(--offline);
        }
        
        .type-corporate {
            background: #e9dcf8;
            color: var(--corporate);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 6px 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
        }
        
        .action-btn i {
            margin-right: 4px;
        }
        
        .btn-view {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .btn-edit {
            background: #fff8e1;
            color: #ff8f00;
        }
        
        .btn-delete {
            background: #ffebee;
            color: #c62828;
        }
        
        .btn-process {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .btn-ship {
            background: #fff8e1;
            color: #ff8f00;
        }
        
        .btn-complete {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .btn-invoice {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        
        /* Sales Order Detail Page */
        .so-detail-container {
            display: none;
        }
        
        .so-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .so-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .info-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }
        
        .info-card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .info-label {
            color: var(--secondary);
        }
        
        .info-value {
            font-weight: 500;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 12px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 500;
        }
        
        .tab.active {
            border-bottom-color: var(--primary);
            color: var(--primary);
        }
        
        .tab-content {
            display: none;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .products-table th {
            background: #f8f9fa;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .products-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .summary-table td {
            padding: 8px 15px;
        }
        
        .summary-table tr:last-child {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
            margin-top: 20px;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -20px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
        }
        
        .timeline-item:after {
            content: '';
            position: absolute;
            left: -15px;
            top: 17px;
            bottom: 0;
            width: 2px;
            background: #ddd;
        }
        
        .timeline-item:last-child:after {
            display: none;
        }
        
        .timeline-date {
            font-size: 12px;
            color: var(--secondary);
        }
        
        .timeline-content {
            margin-top: 5px;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .modal-content {
            background: white;
            margin: 50px auto;
            border-radius: 12px;
            max-width: 800px;
            width: 90%;
            animation: modalFadeIn 0.3s;
            overflow: hidden;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .modal-title i {
            margin-right: 10px;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6c757d;
        }
        
        .modal-body {
            padding: 20px;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        
        .product-info {
            flex: 1;
        }
        
        .product-quantity {
            width: 100px;
            margin: 0 10px;
        }
        
        .product-price {
            width: 150px;
        }
        
        .quantity-input, .price-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }
        
        
 `;

const style = document.createElement('style');
style.textContent = additionalCSS2;
document.head.appendChild(style);
window.salesOrderUI = new SalesOrderUI();
const salesOrderUI = new SalesOrderUI();