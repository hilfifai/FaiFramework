import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';
export default class SalesOrderUI extends OrderSystemBuilder {
    constructor() {
        super();
        // Sample data for products
        this.products = [];

        // Sample data for customers
        this.customers = [
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
        this.selectedSource = '';
        this.selectedChannel = '';

        // Steps for form
        this.formSteps = [
            // { id: 1, title: 'Pilih Sumber Penjualan', active: true },
            { id: 1, title: 'Pilih Pelanggan', active: true },
            { id: 2, title: 'Pilih Produk', active: false },
            { id: 3, title: 'Informasi Pengiriman & Pembayaran', active: false },
            { id: 4, title: 'Outgoing Rak', active: false },
            { id: 5, title: 'Konfirmasi & Simpan', active: false }
        ];

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
            this.orderSystemJson = await this.loadData(["customers","metodePembayaran","ekspedisi","warehouse_racks", "sales_orders", "payments", "outgoings", "delivery_orders"]);
            console.log(this.orderSystemJson);
            this.warehouseRacks = this.orderSystemJson.warehouseRacks || [];
            this.outgoings = this.orderSystemJson.outgoings || [];
            this.payments = this.orderSystemJson.payments || [];
            this.deliveryOrders = this.orderSystemJson.deliveryOrders || [];
            this.salesOrders = this.orderSystemJson.salesOrders || [];
            this.filteredPurchaseOrders = this.orderSystemJson.filteredPurchaseOrders || [];
            this.filteredSalesOrders = this.orderSystemJson.filteredSalesOrders || [];
            this.ekspedisi = this.orderSystemJson.ekspedisi || [];
            this.metodePembayaran = this.orderSystemJson.metodePembayaran || [];
            this.customers = this.orderSystemJson.customers || this.customers;
            console.log(this.ekspedisi )
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
                
                <!-- Form Tambah SO -->
                <div id="soFormView" class="so-form-container" style="display: none;">
                    <div class="form-header">
                        <button class="back-button" id="backToSoList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Buat Sales Order Baru</h2>
                    </div>
                    
                    <!-- Progress Steps -->
                    <div class="form-steps">
                        ${this.formSteps.map(step => `
                            <div class="step ${step.active ? 'active' : ''} ${this.currentStep >= step.id ? 'completed' : ''}" data-step="${step.id}">
                                <div class="step-number">${step.id}</div>
                                <div class="step-title">${step.title}</div>
                            </div>
                        `).join('')}
                    </div>
                    
                    <!-- Step Content -->
                    <div class="form-steps-content">
                        <!-- Step 1: Pilih Sumber Penjualan -->
                        <div id="step0" class="step-content ${this.currentStep === 10? 'active' : ''}">
                            <h3>Pilih Sumber Penjualan</h3>
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
                            
                            <div id="channelGroup" class="form-group" style="display: none; margin-top: 20px;">
                                <label class="form-label">Channel</label>
                                <select class="form-select" id="salesChannel">
                                    <option value="">Pilih Channel</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="cancelForm">Batal</button>
                                <button class="btn btn-primary" id="nextToStep1" disabled>Lanjut ke Pilih Pelanggan</button>
                            </div>
                        </div>
                        
                        <!-- Step 2: Pilih Pelanggan -->
                        <div id="step1" class="step-content ${this.currentStep === 1 ? 'active' : ''}">
                            <h3>Pilih Pelanggan</h3>
                            <div class="customer-selection">
                                <div class="form-group">
                                    <label class="form-label">Cari Pelanggan</label>
                                    <div class="customer-search">
                                        <input type="text" class="form-input" id="customerSearch" placeholder="Cari pelanggan...">
                                        <div class="customer-results" id="customerResults"></div>
                                    </div>
                                </div>
                                
                                <div id="selectedCustomerCard" class="selected-customer-card" style="display: none;">
                                    <div class="customer-card-header">
                                        <h4>Pelanggan Terpilih</h4>
                                        <button class="btn btn-sm btn-danger" id="removeCustomerBtn">Hapus</button>
                                    </div>
                                    <div class="customer-info">
                                        <div><strong>Nama:</strong> <span id="selectedCustomerName"></span></div>
                                        <div><strong>Telepon:</strong> <span id="selectedCustomerPhone"></span></div>
                                        <div><strong>Email:</strong> <span id="selectedCustomerEmail"></span></div>
                                        <div><strong>Alamat:</strong> <span id="selectedCustomerAddress"></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat Pengiriman</label>
                                <select class="form-select" id="shippingAddress">
                                    <option value="">Pilih Alamat</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>  
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="backToStep1">Kembali</button>
                                <button class="btn btn-primary" id="nextToStep2" >Lanjut ke Pilih Produk</button>
                            </div>
                        </div>
                        
                        <!-- Step 3: Pilih Produk -->
                        <div id="step2" class="step-content ${this.currentStep === 2 ? 'active' : ''}">
                            <h3>Pilih Produk</h3>
                            <div class="product-selection-container">
                                <!-- Scanner Section -->
                                <div class="scanner-section">
                                    <div class="scanner-preview" id="scannerPreview">
                                        <video id="scannerVideo" style="width: 100%; height: 200px; border: 2px dashed #ccc;"></video>
                                    </div>
                                    <div class="scanner-controls">
                                        <button class="btn btn-sm btn-primary" id="startCamera">
                                            <i class="fas fa-camera"></i> Aktifkan Kamera
                                        </button>
                                        <button class="btn btn-sm btn-secondary" id="stopCamera" disabled>
                                            <i class="fas fa-stop"></i> Matikan Kamera
                                        </button>
                                    </div>
                                    <div class="manual-input">
                                        <input type="text" id="manualBarcode" placeholder="Masukkan barcode manual" style="flex: 1;">
                                        <button class="btn btn-sm btn-info" id="addManualBarcode">
                                            <i class="fas fa-keyboard"></i> Tambah Manual
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Product Search -->
                                <div class="product-search-section">
                                    <h4>Cari Produk</h4>
                                    <div class="search-controls">
                                        <input type="text" 
                                               id="productSearchInput" 
                                               class="form-input" 
                                               placeholder="Cari by nama produk atau barcode...">
                                        <button class="btn btn-sm btn-primary" id="searchProductBtn">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" id="showAllProductsBtn">
                                            <i class="fas fa-list"></i> Semua Produk
                                        </button>
                                    </div>
                                    <div id="productSearchResults" class="product-search-results"></div>
                                </div>
                                
                                <!-- Scanned Products -->
                                <div class="scanned-products-section">
                                    <h4>Produk Terpilih <span class="badge" id="scannedCount">0</span></h4>
                                    <div id="scannedProductsList" class="scanned-products-list">
                                        <div class="empty-state">Belum ada produk yang ditambahkan</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="backToStep2">Kembali</button>
                                <button class="btn btn-primary" id="nextToStep3" disabled>Lanjut ke Pengiriman & Pembayaran</button>
                            </div>
                        </div>
                        
                        <!-- Step 4: Informasi Pengiriman & Pembayaran -->
                        <div id="step3" class="step-content ${this.currentStep === 3 ? 'active' : ''}">
                            <h3>Informasi Pengiriman & Pembayaran</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Kurir Pengiriman</label>
                                    <select class="form-select" id="soShippingCourier" required>
                                        <option value="">Pilih Kurir</option>
                                        ${this.ekspedisi.map(data_ekspedisi => `<option value="${data_ekspedisi.kode_ekspedisi}-${data_ekspedisi.kode_service}-${data_ekspedisi.id_ekspedisi}-${data_ekspedisi.id_service}-${data_ekspedisi.nama_service}-${data_ekspedisi.harga_ongkir}">${data_ekspedisi.nama_ekspedisi} - ${data_ekspedisi.nama_service}</option>`).join('')}
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="soPaymentMethod" required>
                                        <option value="">Pilih Metode</option>
                                        ${this.metodePembayaran.map(payment => `<option value="${payment.id_primary_key}">${payment.nama_brand} - ${payment.no_rek}</option>`).join('')}
                                    </select>
                                </div>
                            </div>
                            <div class="payment-confirmation-section">
                                    <h4>Konfirmasi Pembayaran</h4>
                                    <div class="form-group">
                                        <label class="form-label">Status Pembayaran</label>
                                        <select class="form-select" id="paymentConfirmationStatus">
                                            <option value="pending">Menunggu Konfirmasi</option>
                                            <option value="confirmed">Terkonfirmasi</option>
                                            <option value="rejected">Ditolak</option>
                                        </select>
                                    </div>
                                    
                                    <div id="paymentProofSection" class="form-group" style="display: none;">
                                        <label class="form-label">Upload Bukti Pembayaran</label>
                                        <input type="file" class="form-input" id="paymentProof" accept="image/*,.pdf">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Catatan Pembayaran</label>
                                        <textarea class="form-textarea" id="paymentNotes" placeholder="Catatan pembayaran..." rows="2"></textarea>
                                    </div>
                                </div>
                            
                            
                            
                            <div class="form-group">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-textarea" id="soNotes" placeholder="Catatan tambahan untuk SO" rows="3"></textarea>
                            </div>
                            
                            <div class="order-summary">
                                <h4>Ringkasan Pesanan</h4>
                                <div class="summary-details">
                                    <div class="summary-item">
                                        <span>Subtotal:</span>
                                        <span id="summarySubtotal">Rp 0</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Biaya Pengiriman:</span>
                                        <span id="summaryShipping">Rp 0</span>
                                    </div>
                                    <div class="summary-item">
                                        <span>Diskon:</span>
                                        <span id="summaryDiscount">Rp 0</span>
                                    </div>
                                    <div class="summary-item total">
                                        <span>Total:</span>
                                        <span id="summaryTotal">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="backToStep3">Kembali</button>
                                <button class="btn btn-primary" id="nextToStep4">Lanjut ke Outgoing Rak</button>
                            </div>
                        </div>
                        
                        <!-- Step 5: Outgoing Rak -->
                        <div id="step4" class="step-content ${this.currentStep === 4 ? 'active' : ''}">
                            <h3>Outgoing Rak</h3>
                            <p>Atur rak penyimpanan untuk setiap produk</p>
                            <div id="outgoingRakContainer" class="outgoing-rak-container">
                                <!-- Outgoing rak items will be populated here -->
                            </div>
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="backToStep4">Kembali</button>
                                <button class="btn btn-primary" id="nextToStep5">Lanjut ke Konfirmasi</button>
                                <button class="btn btn-primary d-none" id="nextToStep6">Lanjut ke Konfirmasi</button>
                            </div>
                        </div>
                        
                        <!-- Step 6: Konfirmasi & Simpan -->
                        <div id="step5" class="step-content ${this.currentStep === 5 ? 'active' : ''}">
                            <h3>Konfirmasi & Simpan</h3>
                            <div class="confirmation-section">
                                <div class="confirmation-summary">
                                    <h4>Ringkasan Sales Order</h4>
                                    <div class="summary-card">
                                        <div class="summary-row">
                                            <span>Sumber:</span>
                                            <span id="confirmSource"></span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Channel:</span>
                                            <span id="confirmChannel"></span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Pelanggan:</span>
                                            <span id="confirmCustomer"></span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Kurir:</span>
                                            <span id="confirmCourier"></span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Pembayaran:</span>
                                            <span id="confirmPayment"></span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Total Produk:</span>
                                            <span id="confirmProductCount">0 item</span>
                                        </div>
                                        <div class="summary-row total">
                                            <span>Total:</span>
                                            <span id="confirmTotal">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="confirmation-products">
                                    <h4>Produk Pesanan</h4>
                                    <div id="confirmationProductsList" class="confirmation-products-list">
                                        <!-- Products will be populated here -->
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            <div class="step-actions">
                                <button class="btn btn-secondary" id="backToStep5">Kembali</button>
                                <button class="btn btn-success" id="saveSoFinal">Simpan Sales Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- SO Detail View -->
               <div id="soDetailView" class="so-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToSoList">
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
        </div>`;

        document.getElementById('pages_content').innerHTML = HTML;
    }

    setupEventListeners() {
        console.log('Setting up event listeners for SalesOrderUI');
        // Show SO Form
        document.getElementById('addSoBtn').addEventListener('click', () => {
            this.showSoForm();
        });

        // Back to list
        document.getElementById('backToSoList').addEventListener('click', () => {
            this.showListView();
        });

        // Cancel form
        document.getElementById('cancelForm').addEventListener('click', () => {
            if (swalConfirm('Batalkan pembuatan Sales Order?')) {
                this.resetForm();
                this.showListView();
            }
        });

        // SO type selection
        document.querySelectorAll('.so-type-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.so-type-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                this.selectedSource = card.dataset.source;

                // Enable next button
                document.getElementById('nextToStep2').disabled = false;

                // Show channel selection if not offline
                if (this.selectedSource !== 'offline') {
                    document.getElementById('channelGroup').style.display = 'block';
                    this.populateSalesChannels(this.selectedSource);
                } else {
                    document.getElementById('channelGroup').style.display = 'none';
                    this.selectedChannel = 'Toko Offline';
                }
            });
        });

        // Channel selection
        document.getElementById('salesChannel').addEventListener('change', (e) => {
            this.selectedChannel = e.target.value;
        });

        // Step navigation
        document.getElementById('nextToStep2').addEventListener('click', () => this.goToStep(2));
        document.getElementById('nextToStep3').addEventListener('click', () => this.goToStep(3));
        document.getElementById('nextToStep4').addEventListener('click', () => this.goToStep(4));
        document.getElementById('nextToStep5').addEventListener('click', () => this.goToStep(5));
        document.getElementById('nextToStep6').addEventListener('click', () => this.goToStep(6));

        document.getElementById('backToStep1').addEventListener('click', () => this.goToStep(1));
        document.getElementById('backToStep2').addEventListener('click', () => this.goToStep(2));
        document.getElementById('backToStep3').addEventListener('click', () => this.goToStep(3));
        document.getElementById('backToStep4').addEventListener('click', () => this.goToStep(4));
        document.getElementById('backToStep5').addEventListener('click', () => this.goToStep(5));

        // Customer search
        document.getElementById('customerSearch').addEventListener('click', (e) => this.handleCustomerSearch(e));
        document.getElementById('customerSearch').addEventListener('input', (e) => this.handleCustomerSearch(e));
        document.getElementById('removeCustomerBtn').addEventListener('click', () => this.removeCustomer());

        // Scanner controls
        document.getElementById('startCamera').addEventListener('click', () => this.startScanner());
        document.getElementById('stopCamera').addEventListener('click', () => this.stopScanner());
        document.getElementById('addManualBarcode').addEventListener('click', () => this.addManualBarcode());
        document.getElementById('searchProductBtn').addEventListener('click', () => this.searchProducts());
        document.getElementById('showAllProductsBtn').addEventListener('click', () => this.showAllProducts());

        // Save SO final
        document.getElementById('saveSoFinal').addEventListener('click', () => this.saveSalesOrder());

        // Payment confirmation status
        document.getElementById('paymentConfirmationStatus').addEventListener('change', (e) => {
            const proofSection = document.getElementById('paymentProofSection');
            proofSection.style.display = e.target.value === 'confirmed' ? 'block' : 'none';
        });

        document.querySelectorAll('[data-action="view"]').forEach(button => {
            button.addEventListener('click', (e) => {

                const soId = e.target.closest('[data-so-id]').dataset.soId;
                this.viewSoDetail(soId);
            });
        });
        document.getElementById('customerSearch').addEventListener('input', (e) => this.handleCustomerSearch(e));
        document.getElementById('editSoBtn').addEventListener('click', () => {
            if (this.currentSo) {
                this.openSoModal(this.currentso.primary_key);
            }
        });
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
        this.setupDeliveryForm();
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
    showSoForm() {
        document.getElementById('soListView').style.display = 'none';
        document.getElementById('soDetailView').style.display = 'none';
        document.getElementById('soFormView').style.display = 'block';
        this.currentStep = 1;
        this.updateStepProgress();
    }

    showListView() {
        console.log('Returning to Sales Order list view');
        document.getElementById('soFormView').style.display = 'none';
        document.getElementById('soDetailView').style.display = 'none';
        document.getElementById('soListView').style.display = 'block';
        this.resetForm();
    }

    goToStep(step) {
        console.log("step",step);
        // Validate current step before proceeding
        if (!this.validateStep(this.currentStep)) {
            return;
        }

        this.currentStep = step;
        this.updateStepProgress();

        // Load data for specific steps
        switch (step) {
            case 1:
                this.populateCustomerSearch();
                break;
            case 2:
                this.renderScannedProducts();
                break;
            case 3:
                this.populateShippingAddress();
                this.calculateOrderSummary();
                break;
            case 4:
                this.renderOutgoingRak();
                break;
            case 5:
                this.populateConfirmation();
                break;
        }
    }

    validateStep(step) {
        switch (step) {
            case 0:
                if (!this.selectedSource) {
                    this.showNotification('Pilih sumber penjualan terlebih dahulu', 'error');
                    return false;
                }
                if (this.selectedSource !== 'offline' && !this.selectedChannel) {
                    this.showNotification('Pilih channel penjualan terlebih dahulu', 'error');
                    return false;
                }
                return true;

            case 1:
                if (!this.selectedCustomer) {
                    this.showNotification('Pilih pelanggan terlebih dahulu', 'error');
                    return false;
                }
                 const shippingAddress = document.getElementById('shippingAddress').value;

                if (!shippingAddress) {
                    this.showNotification('Pilih alamat pengiriman', 'error');
                    return false;
                }
                return true;

            case 2:
                if (this.scannedProducts.length === 0) {
                    this.showNotification('Pilih minimal satu produk', 'error');
                    return false;
                }
                return true;

            case 3:
                const shippingCourier = document.getElementById('soShippingCourier').value;
                const paymentMethod = document.getElementById('soPaymentMethod').value;
               
                if (!shippingCourier) {
                    this.showNotification('Pilih kurir pengiriman', 'error');
                    return false;
                }
                if (!paymentMethod) {
                    this.showNotification('Pilih metode pembayaran', 'error');
                    return false;
                }
                
                return true;

            default:
                return true;
        }
    }

    updateStepProgress() {
        // Update step indicators
        document.querySelectorAll('.step').forEach((stepEl, index) => {
            const stepNum = parseInt(stepEl.dataset.step);
            stepEl.classList.remove('active', 'completed');

            if (stepNum === this.currentStep) {
                stepEl.classList.add('active');
            } else if (stepNum < this.currentStep) {
                stepEl.classList.add('completed');
            }
        });

        // Show/hide step content
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById(`step${this.currentStep}`).classList.add('active');

        // Update button states
        this.updateStepButtons();
    }

    updateStepButtons() {
        // Enable/disable next buttons based on current step
        if (this.currentStep === 2) {
            document.getElementById('nextToStep3').disabled = !this.selectedCustomer;
        } else if (this.currentStep === 3) {
            document.getElementById('nextToStep4').disabled = this.scannedProducts.length === 0;
        }
    }

    populateSalesChannels(source) {
        const channels = this.salesChannels[source] || [];
        let optionsHTML = '<option value="">Pilih Channel</option>';

        channels.forEach(channel => {
            optionsHTML += `<option value="${channel}">${channel}</option>`;
        });

        document.getElementById('salesChannel').innerHTML = optionsHTML;
    }

    populateCustomerSearch() {
        // Clear previous results
        const resultsContainer = document.getElementById('customerResults');
        resultsContainer.innerHTML = '';
        resultsContainer.style.display = 'none';

        // Populate with all customers initially
        this.customers.forEach(customer => {
            const item = document.createElement('div');
            item.className = 'customer-result-item';
            item.innerHTML = `
                <div class="customer-details">
                    <div class="customer-name">${customer.nama_lengkap}</div>
                    <div class="customer-contact">${customer.nomor_handphone} | ${customer.email}</div>
                </div>
                <div>
                    <button class="btn btn-sm btn-primary select-customer" data-customer-id="${customer.id}">Pilih</button>
                </div>
            `;
            resultsContainer.appendChild(item);
        });

        // Add event listeners
        document.querySelectorAll('.select-customer').forEach(button => {
            button.addEventListener('click', (e) => {
                const customerId = e.target.dataset.customerId;
                this.selectCustomer(customerId);
            });
        });
    }

    async handleCustomerSearch(e) {
        const query = e.target.value.toLowerCase();
        const resultsContainer = document.getElementById('customerResults');

        

        const filteredCustomers = this.customers.filter(customer =>
            customer.nama_lengkap.toLowerCase().includes(query) ||
            customer.nomor_handphone.includes(query) ||
            customer.email.toLowerCase().includes(query)
        );

        resultsContainer.innerHTML = '';

        if (filteredCustomers.length === 0) {
            resultsContainer.innerHTML = '<div class="customer-result-item">Pelanggan tidak ditemukan</div>';
        } else {
            filteredCustomers.forEach(customer => {
                const item = document.createElement('div');
                item.className = 'customer-result-item';
                item.innerHTML = `
                    <div class="customer-details">
                        <div class="customer-name">${customer.nama_lengkap}</div>
                        <div class="customer-contact">${customer.nomor_handphone} | ${customer.email}</div>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary select-customer" data-customer-id="${customer.id}">Pilih</button>
                    </div>
                `;
                resultsContainer.appendChild(item);
            });

            // Add event listeners
            document.querySelectorAll('.select-customer').forEach(button => {
                button.addEventListener('click', (e) => {
                    const customerId = e.target.dataset.customerId;
                    this.selectCustomer(customerId);
                });
            });
        }

        resultsContainer.style.display = 'block';
    }

    selectCustomer(customerId) {
        this.selectedCustomer = this.customers.find(c => c.id == customerId);
        if (this.selectedCustomer) {
            this.showSelectedCustomer();
            document.getElementById('customerResults').style.display = 'none';
            document.getElementById('customerSearch').value = '';
            document.getElementById('nextToStep3').disabled = false;
        }
    }

    showSelectedCustomer() {
        const card = document.getElementById('selectedCustomerCard');
        const primaryAddress = this.selectedCustomer.addresses.find(a => a.default_pembelian_barang);

        document.getElementById('selectedCustomerName').textContent = this.selectedCustomer.nama_lengkap;
        document.getElementById('selectedCustomerPhone').textContent = this.selectedCustomer.nomor_handphone;
        document.getElementById('selectedCustomerEmail').textContent = this.selectedCustomer.email;
        document.getElementById('selectedCustomerAddress').textContent = primaryAddress ? primaryAddress.address : '-';

        card.style.display = 'block';
        this.populateShippingAddress();
    }

    removeCustomer() {
        this.selectedCustomer = null;
        document.getElementById('selectedCustomerCard').style.display = 'none';
        document.getElementById('nextToStep3').disabled = true;
    }

    populateShippingAddress() {
    // Pastikan data customer dan addresses ada
    if (!this.selectedCustomer || !this.selectedCustomer.addresses) return;

    const select = document.getElementById('shippingAddress');
    select.innerHTML = '<option value="">Pilih Alamat</option>';

    this.selectedCustomer.addresses.forEach(address => {
        const option = document.createElement('option');
        
        // Menggunakan primary_key sebagai value (ID)
        option.value = address.primary_key;

        // Menyusun format alamat agar rapi
        // Contoh: DARWATI, Rancasari, Kota Bandung, Jawa Barat 40292
        const fullAddress = `${address.nama_unit_bangunan}, ${address.kelurahan}, ${address.kecamatan}, ${address.kota}, ${address.provinsi} ${address.postal_code}`;

        // Cek apakah alamat utama (default_pembelian_barang = 1)
        const isDefault = address.default_pembelian_barang === 1;

        // Set text konten
        option.textContent = fullAddress + (isDefault ? ' (Utama)' : '');
        
        select.appendChild(option);
    });
}

    async searchProducts(query = '', page = 1, limit = 20) {
        // Implementation similar to PurchaseOrderUI
        try {
            console.log(query);
            this.showSearchLoading();

            let payload;
            let search = document.getElementById('productSearchInput').value;
            if (search && search.length >= 1) {
                payload = {
                    "db": "view_produk_detail",
                    "function": "all_produk",
                    "where": [{
                        "fields": ["nama_barang", "nama_varian", "barcode", "barcode_varian"],
                        "operator": "like_or_fields",
                        "value": `%${search}%`
                    }],
                    select: ["primary_key"],
                    group: ["primary_key"],
                    "limit": limit,
                    "offset": (page - 1) * limit
                };
            } else {
                payload = {
                    "db": "view_produk_detail",
                    "function": "all_produk",
                    select: ["primary_key"],
                    group: ["primary_key"],
                    "limit": limit,
                    "offset": (page - 1) * limit
                };
            }

            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hour = String(now.getUTCHours()).padStart(2, '0');
            const token = `SECRET_TOKEN_${year}${month}${day}${hour}`;

            const response = await fetch(`${this.apiBaseUrl}/api/json`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error(`API error: ${response.status}`);
            }

            const result = await response.json();
            const transformedProducts = this.transformProductData(result.data);
            this.showProductSearchResults(transformedProducts);

        } catch (error) {
            console.error('Error searching products:', error);
            this.showSearchError('Error mencari produk: ' + error.message);
        }
    }

    transformProductData(products) {
        const productArray = Object.values(products);
        return productArray.map(product => {
            const variants = [];

            if (product.varian && Object.keys(product.varian).length > 0) {

                for (const variantId in product.varian) {
                    const variant = product.varian[variantId];
                    console.log(variant);
                    variants.push({
                        id: variant.id_barang_varian,
                        name: variant.nama_varian,
                        barcode: variant.barcode_varian,
                        base_price: parseInt(variant.harga_pokok_varian) || 0,
                        image: variant.gambar_produk_varian || product.foto_aset,
                        stock: parseInt(variant.stok) || 0,
                        variant_detail: variant,
                        produk_detail: product
                    });
                }
            } else {
                variants.push({
                    id: product.id,
                    name: product.nama_barang,
                    barcode: product.barcode,
                    base_price: parseInt(product.harga_jual) || 0,
                    image: product.foto_aset,
                    stock: 0,
                    produk_detail: product
                });
            }

            return variants;
        }).flat();
    }

    showSearchLoading() {
        const resultsContainer = document.getElementById('productSearchResults');
        resultsContainer.innerHTML = `
            <div class="search-loading">
                <div class="loading-spinner"></div>
                <p>Mencari produk...</p>
            </div>
        `;
    }

    showSearchError(message) {
        const resultsContainer = document.getElementById('productSearchResults');
        resultsContainer.innerHTML = `
            <div class="search-error">
                <i class="fas fa-exclamation-circle"></i>
                <p>${message}</p>
            </div>
        `;
    }

    showProductSearchResults(products) {
        const resultsContainer = document.getElementById('productSearchResults');

        if (!products || products.length === 0) {
            resultsContainer.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <p>Tidak ada produk ditemukan</p>
                </div>
            `;
            return;
        }
        console.log(products);
        resultsContainer.innerHTML = `
            <div class="search-results-header">
                <span>Ditemukan ${products.length} produk</span>
            </div>
            <div class="products-grid">
                ${products.map(product => `
                    <div class="product-card" data-product-id="${product.id}">
                        <div class="product-image">
                            <img src="${product.image || 'https://via.placeholder.com/100'}" 
                                 alt="${product.name}" 
                                 onerror="this.src='https://via.placeholder.com/100'">
                        </div>
                        <div class="product-info">
                            <h4>${product.name}</h4>
                            <div class="product-barcode">${product.barcode}</div>
                            <div class="product-price">${this.formatCurrency(product.base_price)}</div>
                            <div class="product-stock">Stok: ${product.stock || 0}</div>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-sm btn-success add-product-btn" 
                                    data-product='${JSON.stringify(product).replace(/'/g, "\\'")}'>
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;

        // Add event listeners
        this.attachProductAddListeners();
    }

    attachProductAddListeners() {
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-product-btn')) {
                const button = e.target.closest('.add-product-btn');
                const productData = JSON.parse(button.getAttribute('data-product'));
                this.addProductToScanned(productData);
            }
        });
    }

    addProductToScanned(product) {
        const existingIndex = this.scannedProducts.findIndex(item => item.barcode === product.barcode);

        if (existingIndex >= 0) {
            this.scannedProducts[existingIndex].quantity += 1;
            this.showNotification(`+1 ${product.name}`, 'success');
        } else {
            const newProduct = {
                productId: product.id,
                name: product.name,
                barcode: product.barcode,
                base_price: product.base_price,
                quantity: 1,
                discount: 0,
                discounted_price: product.base_price,
                image: product.image,
                variant_detail: product.variant_detail,
                produk_detail: product.produk_detail,
                racks: [] // For outgoing rak
            };
            this.scannedProducts.push(newProduct);
            this.showNotification(`✓ ${product.name} ditambahkan`, 'success');
        }

        this.renderScannedProducts();
        this.updateStepButtons();
    }

    renderScannedProducts() {
        const container = document.getElementById('scannedProductsList');
        const countBadge = document.getElementById('scannedCount');

        if (this.scannedProducts.length === 0) {
            container.innerHTML = '<div class="empty-state">Belum ada produk yang ditambahkan</div>';
            countBadge.textContent = '0';
            return;
        }

        container.innerHTML = this.scannedProducts.map((product, index) => `
            <div class="scanned-product-item" data-index="${index}">
                <div class="product-info">
                    <strong>${product.name}</strong>
                    <div class="product-details">
                        <span>Barcode: ${product.barcode}</span>
                        <span>Harga: ${this.formatCurrency(product.base_price)}</span>
                    </div>
                </div>
                <div class="product-controls">
                    <div class="quantity-control">
                        <button class="btn btn-sm btn-outline-secondary decrease-qty" data-index="${index}">-</button>
                        <input type="number" class="quantity-input" value="${product.quantity}" min="1" data-index="${index}">
                        <button class="btn btn-sm btn-outline-secondary increase-qty" data-index="${index}">+</button>
                    </div>
                    <div class="price-info">
                        <span>${this.formatCurrency(product.discounted_price * product.quantity)}</span>
                    </div>
                    <button class="btn btn-sm btn-danger remove-product" data-index="${index}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `).join('');

        countBadge.textContent = this.scannedProducts.length;

        // Add event listeners
        this.attachScannedProductListeners();
    }

    attachScannedProductListeners() {
        // Quantity decrease
        document.querySelectorAll('.decrease-qty').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                if (this.scannedProducts[index].quantity > 1) {
                    this.scannedProducts[index].quantity -= 1;
                    this.renderScannedProducts();
                }
            });
        });

        // Quantity increase
        document.querySelectorAll('.increase-qty').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.scannedProducts[index].quantity += 1;
                this.renderScannedProducts();
            });
        });

        // Quantity input change
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const index = parseInt(e.target.dataset.index);
                const quantity = parseInt(e.target.value) || 1;
                this.scannedProducts[index].quantity = Math.max(1, quantity);
                this.renderScannedProducts();
            });
        });

        // Remove product
        document.querySelectorAll('.remove-product').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.scannedProducts.splice(index, 1);
                this.renderScannedProducts();
                this.updateStepButtons();
            });
        });
    }

    calculateOrderSummary() {
        console.log();
        let subtotal = 0;
        let discount = 0;

        this.scannedProducts.forEach(product => {
            subtotal += product.base_price * product.quantity;
            discount += product.discount * product.quantity;
        });

        const shipping = 20000; // Default shipping cost
        const total = subtotal - discount + shipping;

        document.getElementById('summarySubtotal').textContent = this.formatCurrency(subtotal);
        document.getElementById('summaryDiscount').textContent = this.formatCurrency(discount);
        document.getElementById('summaryShipping').textContent = this.formatCurrency(shipping);
        document.getElementById('summaryTotal').textContent = this.formatCurrency(total);
    }

    renderOutgoingRak() {
        const container = document.getElementById('outgoingRakContainer');

        if (this.scannedProducts.length === 0) {
            container.innerHTML = '<div class="alert alert-warning">Tidak ada produk untuk dikelola rak</div>';
            return;
        }

        container.innerHTML = this.scannedProducts.map((product, index) => `
            <div class="outgoing-rak-item">
                <div class="rak-item-header">
                    <h5>${product.name}</h5>
                    <span class="badge">Quantity: ${product.quantity}</span>
                </div>
                <div class="rak-selection">
                    <label>Pilih Rak:</label>
                    <select class="form-select rack-select" data-index="${index}">
                        <option value="">Pilih Rak</option>
                        ${this.warehouseRacks.map(rack => `
                            <option value="${rack.id}">${rack.name}</option>
                        `).join('')}
                    </select>
                </div>
                <div class="quantity-allocation">
                    <label>Alokasi Quantity:</label>
                    <div class="allocation-controls">
                        <input type="number" class="form-control allocation-qty" 
                               value="${product.quantity}" 
                               min="1" 
                               max="${product.quantity}"
                               data-index="${index}">
                        <span>dari ${product.quantity}</span>
                    </div>
                </div>
            </div>
        `).join('');

        // Add event listeners
        this.attachOutgoingRakListeners();
    }

    attachOutgoingRakListeners() {
        // Update product racks when selection changes
        document.querySelectorAll('.rack-select').forEach(select => {
            select.addEventListener('change', (e) => {
                const index = parseInt(e.target.dataset.index);
                const rackId = e.target.value;

                if (rackId) {
                    const rack = this.warehouseRacks.find(r => r.id == rackId);
                    this.scannedProducts[index].racks = [{
                        rackId: rackId,
                        rackName: rack ? rack.name : 'Unknown',
                        quantity: parseInt(document.querySelector(`.allocation-qty[data-index="${index}"]`).value) || this.scannedProducts[index].quantity
                    }];
                } else {
                    this.scannedProducts[index].racks = [];
                }
            });
        });

        // Update allocation quantity
        document.querySelectorAll('.allocation-qty').forEach(input => {
            input.addEventListener('change', (e) => {
                const index = parseInt(e.target.dataset.index);
                const quantity = parseInt(e.target.value) || 1;
                const maxQuantity = this.scannedProducts[index].quantity;

                if (quantity > maxQuantity) {
                    e.target.value = maxQuantity;
                    this.showNotification(`Quantity tidak boleh melebihi ${maxQuantity}`, 'warning');
                }

                if (this.scannedProducts[index].racks.length > 0) {
                    this.scannedProducts[index].racks[0].quantity = quantity;
                }
            });
        });
    }

    populateConfirmation() {
        // Populate confirmation data
        document.getElementById('confirmSource').textContent = this.getTypeText(this.selectedSource);
        document.getElementById('confirmChannel').textContent = this.selectedChannel || '-';
        document.getElementById('confirmCustomer').textContent = this.selectedCustomer ? this.selectedCustomer.nama_lengkap : '-';
        document.getElementById('confirmCourier').textContent = document.getElementById('soShippingCourier').options[document.getElementById('soShippingCourier').selectedIndex]?.text || '-';
        document.getElementById('confirmPayment').textContent = document.getElementById('soPaymentMethod').options[document.getElementById('soPaymentMethod').selectedIndex]?.text || '-';
        document.getElementById('confirmProductCount').textContent = `${this.scannedProducts.length} item`;
        document.getElementById('confirmTotal').textContent = document.getElementById('summaryTotal').textContent;

        // Populate products list
        const productsList = document.getElementById('confirmationProductsList');
        productsList.innerHTML = this.scannedProducts.map(product => `
            <div class="confirmation-product-item">
                <div class="product-name">${product.name}</div>
                <div class="product-details">
                    <span>${product.quantity} x ${this.formatCurrency(product.base_price)}</span>
                    <span class="product-total">${this.formatCurrency(product.base_price * product.quantity)}</span>
                </div>
                ${product.racks.length > 0 ? `
                    <div class="product-rack">
                        <small>Rak: ${product.racks[0].rackName} (${product.racks[0].quantity} item)</small>
                    </div>
                ` : ''}
            </div>
        `).join('');
    }

    async saveSalesOrder() {
        try {
            // Collect all data
            const soData = {
                source: this.selectedSource,
                channel: this.selectedChannel,
                customer: this.selectedCustomer,
                products: this.scannedProducts,
                shipping: {
                    courier: document.getElementById('soShippingCourier').value,
                    addressId: document.getElementById('shippingAddress').value
                },
                payment: {
                    method: document.getElementById('soPaymentMethod').value,
                    status: document.getElementById('paymentConfirmationStatus').value,
                    notes: document.getElementById('paymentNotes').value
                },
                notes: document.getElementById('soNotes').value,
                racks: this.scannedProducts.map(p => p.racks).flat(),
                outgoing: this.prepareOutgoingData()
            };

            // Show loading
            this.showNotification('Menyimpan Sales Order...', 'loading');

            // Calculate totals
            const subtotal = this.scannedProducts.reduce((sum, p) => sum + (p.base_price * p.quantity), 0);
            const shipping = 20000; // Default shipping
            const total = subtotal + shipping;

            // Prepare SO for backend
            const soToSave = {
                nomor: `SO-${new Date().getFullYear()}-${String(this.salesOrders.length + 1).padStart(4, '0')}`,
                tanggal: new Date().toISOString().split('T')[0],
                nama_lengkap: soData.customer.nama_lengkap,
                email: soData.customer.email,
                source: soData.source,
                channel: soData.channel,
                status: 'draft',
                items: soData.products.map(p => ({
                    id_detail: p.productId,
                    nama_varian: p.name,
                    harga_penjualan: p.base_price,
                    qty: p.quantity,
                    total_diskon: p.discount * p.quantity,
                    grand_total: p.base_price * p.quantity
                })),
                sub_total: subtotal,
                total_diskon: soData.products.reduce((sum, p) => sum + (p.discount * p.quantity), 0),
                shipping: shipping,
                tax: 0,
                total: total,
                notes: soData.notes,
                payment_status: soData.payment.status,
                shipping_courier: soData.shipping.courier,
                outgoing_data: soData.outgoing
            };

            // Save to backend (simulate API call)
            setTimeout(() => {
                // Add to local array
                this.salesOrders.push(soToSave);
                this.filteredSalesOrders = [...this.salesOrders];

                // Show success
                this.showNotification('Sales Order berhasil disimpan!', 'success');

                // Return to list and refresh
                setTimeout(() => {
                    this.showListView();
                    this.renderSoList();
                    this.updateStats();
                    this.resetForm();
                }, 1500);

            }, 1000);

        } catch (error) {
            console.error('Error saving SO:', error);
            this.showNotification('Gagal menyimpan Sales Order: ' + error.message, 'error');
        }
    }

    prepareOutgoingData() {
        return this.scannedProducts.map(product => {
            if (product.racks.length === 0) return null;

            return {
                productId: product.productId,
                productName: product.name,
                quantity: product.racks[0].quantity,
                rackId: product.racks[0].rackId,
                rackName: product.racks[0].rackName,
                barcode: product.barcode,
                price: product.base_price
            };
        }).filter(item => item !== null);
    }

    resetForm() {
        this.currentStep = 1;
        this.selectedSource = '';
        this.selectedChannel = '';
        this.selectedCustomer = null;
        this.scannedProducts = [];

        // Reset UI elements
        document.querySelectorAll('.so-type-card').forEach(c => c.classList.remove('selected'));
        document.getElementById('channelGroup').style.display = 'none';
        document.getElementById('selectedCustomerCard').style.display = 'none';
        document.getElementById('customerSearch').value = '';
        document.getElementById('productSearchInput').value = '';
        document.getElementById('productSearchResults').innerHTML = '';
        document.getElementById('soShippingCourier').value = '';
        document.getElementById('soPaymentMethod').value = '';
        document.getElementById('shippingAddress').innerHTML = '<option value="">Pilih Alamat</option>';
        document.getElementById('soNotes').value = '';

        this.updateStepProgress();
    }

    // Scanner methods (simplified)
    async startScanner() {
        try {
            const video = document.getElementById('scannerVideo');
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'environment' }
            });

            video.srcObject = stream;
            video.play();

            document.getElementById('startCamera').disabled = true;
            document.getElementById('stopCamera').disabled = false;

            // Start barcode detection simulation
            this.simulateBarcodeDetection();

        } catch (error) {
            console.error('Error accessing camera:', error);
            this.showNotification('Tidak dapat mengakses kamera', 'error');
        }
    }

    stopScanner() {
        const video = document.getElementById('scannerVideo');
        if (video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
            video.srcObject = null;
        }

        document.getElementById('startCamera').disabled = false;
        document.getElementById('stopCamera').disabled = true;
    }

    simulateBarcodeDetection() {
        // Simulate barcode detection (in real app, use a barcode library)
        // This is just for demonstration
        const detect = () => {
            if (!document.getElementById('startCamera').disabled) return;

            // Simulate random product detection
            const randomProducts = this.products || [];
            if (randomProducts.length > 0) {
                const randomIndex = Math.floor(Math.random() * randomProducts.length);
                const product = randomProducts[randomIndex];

                // Add product to scanned list
                this.addProductToScanned({
                    id: product.id,
                    name: product.name,
                    barcode: product.barcode,
                    base_price: product.base_price || 0,
                    image: product.image
                });
            }

            // Continue detection
            setTimeout(detect, 3000);
        };

        detect();
    }
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
                name: this.selectedCustomer.nama_lengkap,
                phone: this.selectedCustomer.nomor_handphone,
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

        setShowAlert('Sales Order berhasil dibuat!');
    }

    addManualBarcode() {
        const barcodeInput = document.getElementById('manualBarcode');
        const barcode = barcodeInput.value.trim();

        if (!barcode) {
            this.showNotification('Masukkan barcode terlebih dahulu', 'warning');
            return;
        }

        // In real app, search product by barcode
        // For now, simulate adding
        this.addProductToScanned({
            id: Date.now(),
            name: `Produk Barcode: ${barcode}`,
            barcode: barcode,
            base_price: 100000,
            image: null
        });

        barcodeInput.value = '';
    }

    // Helper methods
    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
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

    showNotification(message, type = 'info') {
        // Remove existing notification
        const existingNotif = document.querySelector('.global-notification');
        if (existingNotif) {
            existingNotif.remove();
        }

        const notification = document.createElement('div');
        notification.className = `global-notification ${type}`;

        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle',
            loading: 'fa-spinner fa-spin'
        };

        notification.innerHTML = `
            <i class="fas ${icons[type] || 'fa-info-circle'}"></i>
            <span>${message}</span>
            ${type !== 'loading' ? '<button class="close-notif">&times;</button>' : ''}
        `;

        document.body.appendChild(notification);

        // Show animation
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Auto remove for non-loading notifications
        if (type !== 'loading') {
            // Close button event
            const closeBtn = notification.querySelector('.close-notif');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    notification.classList.remove('show');
                    setTimeout(() => notification.remove(), 300);
                });
            }

            // Auto hide after 5 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        return notification;
    }
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
    // Keep existing methods for list view, detail view, etc.
    renderSoList() {
        let tableHTML = '';

        this.filteredSalesOrders.forEach(so => {
            const statusClass = this.getStatusClass(so.status);
            const statusText = this.getStatusText(so.status);
            const soDate = new Date(so.tanggal).toLocaleDateString('id-ID');
            const typeClass = this.getTypeClass(so.source);
            const typeText = this.getTypeText(so.source);

            tableHTML += `
                        <tr>
                            <td>
                                <div class="order-id">${so.nomor}</div>
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
                            <i class="fas fa-eye"></i> Edit
                        </button>
                        
                        
                            <button class="action-btn btn-edit" data-action="edit" data-so-id="${so.primary_key}">
                                <i class="fas fa-edit"></i> Ubah Status
                            </button>
                      
                        ${so.status === 'confirmed' ? `
                            <button class="action-btn btn-process" data-action="process" data-so-id="${so.primary_key}">
                                <i class="fas fa-cog"></i> Proses
                            </button>
                        ` : ''}
                       
                            <button class="action-btn btn-ship" data-action="ship" data-so-id="${so.primary_key}">
                                <i class="fas fa-truck"></i> Kirim
                            </button>
                        
                        
                            <button class="action-btn btn-complete" data-action="complete" data-so-id="${so.primary_key}">
                                <i class="fas fa-check"></i> Selesai
                            </button>
                       
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

    updateStats() {
        document.getElementById('totalSos').textContent = this.salesOrders.length;
        document.getElementById('pendingSos').textContent = this.salesOrders.filter(so => so.status === 'pending').length;
        document.getElementById('processingSos').textContent = this.salesOrders.filter(so => so.status === 'processing').length;
        document.getElementById('shippedSos').textContent = this.salesOrders.filter(so => so.status === 'shipped').length;
        document.getElementById('completedSos').textContent = this.salesOrders.filter(so => so.status === 'completed').length;
    }

    // View SO detail
    viewSoDetail(soId) {
        console.log(this.salesOrders);
        this.currentSo = this.salesOrders.find(so => so.primary_key == soId);
        console.log(this.currentSo);
        if (!this.currentSo) return;
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
    renderOutgoingList() {
        if (!this.currentSo) return;
        this.currentSo.outgoing = this.outgoings.filter(p => p.id_erp__pos__group === this.currentSo.primary_key);
        const outgoingList = document.getElementById('outgoingList');
        if (!outgoingList) return;
        console.log(this.currentSo.outgoing);
        let outgoingHTML = '';

        this.currentSo.outgoing.forEach(outgoing => {
            // Parse items dari string JSON
            console.log(outgoing);
            let outgoingItems = [];

            try {
                outgoingItems = typeof outgoing.items === 'string'
                    ? JSON.parse(outgoing.items)
                    : Array.isArray(outgoing.items)
                        ? outgoing.items
                        : [];
            } catch (e) {
                outgoingItems = [];
            }
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
    async sync_cart(BreakdownId, outgoingId, productId, index) {
        const inputEl = document.querySelector(`input[data-breakdown-id="${BreakdownId}"]`);

        const value = inputEl ? inputEl.value : null;

        try {
            // Kirim data ke server
            const response = await window.fai.getModule("urlHelper").fetchDataFromApi(
                window.fai.getModule('base_url') + "api/sync_cart_outgoing", 'POST',
                {
                    qty: value
                    , breakdownId: BreakdownId
                });


            if (response.status) {
                setShowAlert('Sync telah berhasil ', 'success');

            } else {
                setShowAlert('Sync cart gagal ', 'error');
            }
            $("#status_sync_cart-" + BreakdownId).html("" + response.status ? "Berhasil" : "Gagal" + "");
            $("#response_sync_cart-" + BreakdownId).html("" + JSON.stringify(response.response) + "");
            $("#qty_sync-" + BreakdownId).html("" + value + "");

            $('#btn_delete_sync_cart-' + BreakdownId).show();
            $('#btn_resync_cart-' + BreakdownId).show();
            $('#btn_sync_cart-' + BreakdownId).hide();
        } catch (error) {
            console.error('Error:', error);
            setShowAlert('Gagal mengirim konfirmasi pembayaran', 'error');
        }
    }
    async delete_sync_cart(cartSyncId, BreakdownId, outgoingId, productId, index) {
        const inputEl = document.querySelector(`input[data-breakdown-id="${BreakdownId}"]`);

        const value = inputEl ? inputEl.value : null;

        try {
            // Kirim data ke server
            const response = await window.fai.getModule("urlHelper").fetchDataFromApi(
                window.fai.getModule('base_url') + "api/delete_sync_cart_outgoing", 'POST',
                {
                    qty: value
                    , breakdownId: BreakdownId
                    , cartSyncId: cartSyncId
                });


            if (response.status) {
                setShowAlert('Sync telah berhasil ', 'success');

            } else {
                setShowAlert('Sync cart gagal ', 'error');
            }
            $("#status_sync_cart-" + BreakdownId).html("Belum");
            $("#response_sync_cart-" + BreakdownId).html("" + JSON.stringify({}) + "");
            $("#qty_sync-" + BreakdownId).html("-");

            $('#btn_delete_sync_cart-' + BreakdownId).hide();
            $('#btn_resync_cart-' + BreakdownId).hide();
            $('#btn_sync_cart-' + BreakdownId).show();
        } catch (error) {
            console.error('Error:', error);
            setShowAlert('Gagal mengirim konfirmasi pembayaran', 'error');
        }
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
        setShowAlert(`Detail Outgoing: ${outgoing.id}\nStatus: ${this.getOutgoingStatusText(outgoing.status)}`);
    }

    editOutgoing(outgoingId) {
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        // Implement edit functionality
        setShowAlert(`Edit Outgoing: ${outgoing.id}`);
    }

    completeOutgoing(outgoingId) {
        console.log("completeOutgoing");
        const outgoing = this.currentSo.outgoing.find(o => o.id === outgoingId);
        if (!outgoing) return;

        if (swalConfirm(`Selesaikan outgoing ${outgoing.id}?`)) {
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
            setShowAlert(`Outgoing ${outgoing.id} telah diselesaikan`);
        }
    }
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

    // Add delivery order
    addDeliveryOrder() {
        if (!this.currentSo) return;

        const deliveryType = document.getElementById('deliveryType').value;
        if (!deliveryType) {
            setShowAlert('Pilih jenis pengiriman terlebih dahulu');
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
            setShowAlert('Pilih minimal 1 item untuk dikirim',"danger");
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
        setShowAlert('Delivery order berhasil ditambahkan!');
    }
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
        const rackData = this.warehouseRacks.find(o => rack.id_ruang_simpan_out == o.id);
        const rackName = this.warehouseRacks.find(opt => opt.id == rack?.id_ruang_simpan_out)?.name || 'Belum Pilih Rak';
        console.log(item);
        return `
    <div class="rack-entry d-block" data-index="${index}">
    <div class="d-flex">
        <div class="rack-selection">
        ${!rack.id_ruang_simpan_out ? `
            <select class="form-select rack-select rack-select-detail-${item.id}" 
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv || item.id}"
                data-id_ruang_simpan_out="${rack.id_ruang_simpan_out}"
                data-breakdown-id="${rack.id}"
                data-index="${index}">
                <option value="">Pilih Rak</option>
                ${this.warehouseRacks.map(opt => `
                    <option value="${opt.id}" ${rack.id_ruang_simpan_out == opt.id ? 'selected' : ''}>
                        ${opt.name}
                    </option>
                `).join('')}
            </select>
            `: rackName}
        </div>
        <div class="quantity-input">
            <input type="number" 
                class="form-control rack-quantity qty-rack-detail-${item.id}"
                min="1"
                max="${maxQuantity}"
                value="${rack ? rack.qty_keluar_out : ''}"
                placeholder="Jumlah"
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv}"
                data-breakdown-id="${rack.id}"
                data-index="${index}">
                

        </div>
        ${index ? `
            <button class="btn btn-sm btn-outline-danger remove-rack" 
                data-outgoing-id="${outgoingId}"
                data-product-id="${item.id_produk_inv || item.id}"
                data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        ` : ''}
       </div>
            <div class='d-block'>
             ${rackData.id_api ? (
                `<div> Status Sync :  <span id="status_sync_cart-${rack.id}">${rack.status_sync_cart || "Belum"}</span> </div>
                <div> Response Sync :  <span id="response_sync_cart-${rack.id}">${rack.response_sync_cart || "-"}</span> </div>
                <div> Qty Sync :  <span id="qty_sync-${rack.id}">${rack.temp_qty_sync || "-"}</span> </div>
                <div class="d-flex gap-2 mt-2">
                    
                        <button class="btn btn-sm btn-primary sync-cart" 
                          id="btn_sync_cart-${rack.id}"
                            data-outgoing-id="${outgoingId}"
                            data-breakdown-id="${rack.id}"
                            data-product-id="${item.id_produk_inv}"
                            data-index="${index}"
                            data-status-sync="${rack.status_sync_cart || "Belum"}"
                            >
                            Sync Api Cart
                           </button>
                        
                         <button class="btn btn-sm btn-primary resync-cart" 
                          id="btn_resync_cart-${rack.id}"
                            data-outgoing-id="${outgoingId}"
                            data-breakdown-id="${rack.id}"
                            data-product-id="${item.id_produk_inv}"
                            data-cart-sync-id="${rack.id_response_sync_cart}"
                            data-index="${index}"
                            data-status-sync="${rack.status_sync_cart || "Belum"}"
                            >
                            ReSync Api Cart
                           </button>
                           <button class="btn btn-sm btn-primary delete-sync-cart" 
                          id="btn_delete_sync_cart-${rack.id}"
                            data-outgoing-id="${outgoingId}"
                            data-breakdown-id="${rack.id}"
                            data-product-id="${item.id_produk_inv}"
                            data-cart-sync-id="${rack.id_response_sync_cart}"
                            data-index="${index}"
                            data-status-sync="${rack.status_sync_cart || "Belum"}"
                            >
                            Delete Sync Cart
                           </button>
                       
                           `
            ) : ""}
                </div>
                </div>
    </div>
    `;
    }
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
        document.querySelectorAll('.sync-cart').forEach(button => {
            if (button.dataset.statusSync === "Berhasil") {
                button.style.display = "none";
            }
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const BreakdownId = e.target.dataset.breakdownId;

                const index = parseInt(e.target.dataset.index);
                this.sync_cart(BreakdownId, outgoingId, parseInt(productId), index);
            });
        });
        document.querySelectorAll('.resync-cart').forEach(button => {
            if (button.dataset.statusSync !== "Berhasil") {
                button.style.display = "none";
            }
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const BreakdownId = e.target.dataset.breakdownId;

                const index = parseInt(e.target.dataset.index);
                this.sync_cart(BreakdownId, outgoingId, parseInt(productId), index);
            });
        });
        document.querySelectorAll('.delete-sync-cart').forEach(button => {
            if (button.dataset.statusSync !== "Berhasil") {
                button.style.display = "none";
            }
            button.addEventListener('click', (e) => {
                const outgoingId = e.target.dataset.outgoingId;
                const productId = e.target.dataset.productId;
                const BreakdownId = e.target.dataset.breakdownId;
                const cartSyncId = e.target.dataset.cartSyncId;

                const index = parseInt(e.target.dataset.index);
                this.delete_sync_cart(cartSyncId, BreakdownId, outgoingId, parseInt(productId), index);
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

        setShowAlert('Outgoing berhasil ditambahkan!');
    }
    renderDeliveryList() {
        if (!this.currentSo) return;
        // setShowAlert();

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
                setShowAlert('Nomor resi belum tersedia untuk tracking');
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
            setShowAlert('Pengiriman berhasil dikonfirmasi ke ekspedisi');
        }
    }

    // Edit delivery items
    editDelivery(deliveryId) {
        const delivery = this.currentSo.deliveryOrders.find(dod => dod.id === deliveryId);
        if (delivery && delivery.status === 'pending') {
            // Implement edit functionality
            this.openEditDeliveryModal(delivery);
        } else {
            setShowAlert('Hanya delivery order dengan status pending yang bisa diedit',"primary");
        }
    }

    // Add payment
    addPayment() {
        if (!this.currentSo) return;

        const paymentMethod = document.getElementById('selectedPaymentMethod').value;
        if (!paymentMethod) {
            setShowAlert('Pilih metode pembayaran terlebih dahulu',"danger");
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
        setShowAlert('Pembayaran berhasil ditambahkan!');
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
                setShowAlert('Konfirmasi pembayaran berhasil dikirim');
                document.getElementById('konfirmasiModal').remove();
                this.renderPaymentList(); // Refresh list
            } else {
                throw new Error('Gagal mengirim konfirmasi');
            }
        } catch (error) {
            console.error('Error:', error);
            setShowAlert('Gagal mengirim konfirmasi pembayaran',"danger");
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
                setShowAlert(`Konfirmasi berhasil ${approve ? 'diapprove' : 'ditolak'}`);
                this.renderPaymentList(); // Refresh list
            } else {
                throw new Error('Gagal memproses konfirmasi');
            }
        } catch (error) {
            console.error('Error:', error);
            setShowAlert('Gagal memproses konfirmasi',"danger");
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

    // Filter sales orders
    filterSalesOrders() {
        const searchTerm = document.getElementById('searchSo').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const sourceFilter = document.getElementById('sourceFilter').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        this.filteredSalesOrders = this.salesOrders.filter(so => {
            const matchesSearch = so.primary_key.toLowerCase().includes(searchTerm) ||
                so.customer.nama_lengkap.toLowerCase().includes(searchTerm);
            const matchesStatus = !statusFilter || so.status === statusFilter;
            const matchesSource = !sourceFilter || so.source === sourceFilter;
            const matchesDate = (!startDate || so.date >= startDate) &&
                (!endDate || so.date <= endDate);

            return matchesSearch && matchesStatus && matchesSource && matchesDate;
        });

        this.renderSoList();
    }

    // Helper functions


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
                setShowAlert('Tidak dapat memproses SO dengan status saat ini');
                return;
        }

        if (swalConfirm(`Ubah status SO menjadi ${this.getStatusText(newStatus)}?`)) {
            this.currentSo.status = newStatus;
            this.currentSo.history.push({
                date: new Date().toISOString().split('T')[0],
                action: action,
                user: "Admin"
            });

            this.renderSoList();
            this.updateStats();
            this.populateSoDetail();

            setShowAlert(`Status SO berhasil diubah menjadi ${this.getStatusText(newStatus)}`);
        }
    }

    // Print invoice
    printInvoice() {
        if (!this.currentSo) return;
        setShowAlert(`Invoice ${this.currentso.primary_key} akan dicetak`);
        // In a real app, this would open a print dialog or generate PDF
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

// Add CSS for the form steps
const formStepsCSS = `
    .so-form-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .form-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eaeaea;
    }
    
    .form-header .back-button {
        margin-right: 20px;
    }
    
    .form-steps {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }
    
    .form-steps::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e0e0e0;
        z-index: 1;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        flex: 1;
    }
    
    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e0e0e0;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        border: 3px solid white;
    }
    
    .step.active .step-number {
        background: #007bff;
        color: white;
    }
    
    .step.completed .step-number {
        background: #28a745;
        color: white;
    }
    
    .step-title {
        font-size: 12px !important;
        text-align: center;
        color: #666;
        max-width: 150px;
    }
    
    .step.active .step-title {
        color: #007bff;
        font-weight: 600;
    }
    
    .step-content {
        display: none;
        min-height: 400px;
    }
    
    .step-content.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .so-type-selector {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }
    
    .so-type-card {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .so-type-card:hover {
        border-color: #007bff;
        transform: translateY(-2px);
    }
    
    .so-type-card.selected {
        border-color: #007bff;
        background-color: #f8f9fa;
    }
    
    .so-type-icon {
        font-size: 2em;
        margin-bottom: 10px;
    }
    
    .customer-selection {
        margin: 30px 0;
    }
    
    .customer-search {
        position: relative;
        margin-bottom: 20px;
    }
    
    .customer-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 100;
        display: none;
    }
    
    .customer-result-item {
        padding: 10px 15px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .customer-result-item:hover {
        background-color: #f8f9fa;
    }
    
    .selected-customer-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid #e0e0e0;
    }
    
    .customer-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .product-selection-container {
        display: grid;
        gap: 20px;
    }
    
    .scanner-section {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
    }
    
    .scanner-controls, .manual-input {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .product-search-section {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
    }
    
    .search-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .product-search-results {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
    
    .product-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .product-image img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .product-info {
        flex: 1;
    }
    
    .scanned-products-section {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
    }
    
    .scanned-products-list {
        max-height: 300px;
        overflow-y: auto;
        margin-top: 10px;
    }
    
    .scanned-product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .product-controls {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .quantity-control input {
        width: 60px;
        text-align: center;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .order-summary {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
    }
    
    .summary-details {
        margin-top: 15px;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .summary-item.total {
        font-weight: bold;
        font-size: 1.1em;
        border-top: 2px solid #e0e0e0;
        margin-top: 10px;
        padding-top: 15px;
        border-bottom: none;
    }
    
    .outgoing-rak-container {
        max-height: 500px;
        overflow-y: auto;
        margin: 20px 0;
    }
    
    .outgoing-rak-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .rak-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .rak-selection, .quantity-allocation {
        margin-bottom: 10px;
    }
    
    .allocation-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
    }
    
    .confirmation-section {
        max-height: 600px;
        overflow-y: auto;
    }
    
    .confirmation-summary {
        margin-bottom: 30px;
    }
    
    .summary-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 15px;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .summary-row.total {
        font-weight: bold;
        border-top: 2px solid #e0e0e0;
        margin-top: 10px;
        padding-top: 15px;
    }
    
    .confirmation-products-list {
        max-height: 300px;
        overflow-y: auto;
        margin: 15px 0;
    }
    
    .confirmation-product-item {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .product-details {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
    }
    
    .product-total {
        font-weight: bold;
    }
    
    .product-rack {
        margin-top: 5px;
        color: #666;
    }
    
    .payment-confirmation-section {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }
    
    .step-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eaeaea;
    }
    
    .loading-spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #007bff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;

// Add the CSS to the document
const style = document.createElement('style');
style.textContent = formStepsCSS;
document.head.appendChild(style);

window.salesOrderUI = new SalesOrderUI();