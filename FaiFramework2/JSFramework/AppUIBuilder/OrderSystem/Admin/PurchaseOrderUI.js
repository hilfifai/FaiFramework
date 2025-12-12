import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';
import PaymentTabUI from './PaymentTabUI.js';
export default class PurchaseOrderUI extends OrderSystemBuilder {
    constructor() {
        super();
        this.products = [];
        this.suppliers = [];
        this.warehouseRacks = [];
        this.PurchaseOrders = [];
        this.filteredPurchaseOrders = [];
        this.pendingReceiving = {};
        this.currentPoId = null;
        this.currentView = 'list';
        this.productView = 'add';
        this.scannerActive = false;
        this.scanner = null;
        this.currentStep = 'type'; // scan, confirm, detail
        this.scannedProducts = [];
        this.selectedSupplier = null;
        this.selectedPoType = '';
        this.apiBaseUrl = window.fai.getModule('base_url');

    }

    async init(config, apiUrl = null) {
        if (apiUrl) {
            this.apiBaseUrl = apiUrl;
        }
        if (!apiUrl) {
            this.apiBaseUrl = window.fai.getModule('base_url');
        }
        await this.getloadData();
        this.render();
        setTimeout(() => {
            this.setupEventListeners();
            this.renderPoList();
            this.updateStats();
            this.renderWarehouseRacks();
        }, 100);

    }

    async getloadData() {
        try {

            this.orderSystemJson = await this.loadData(["warehouse_racks", "purchase_orders", "suppliers", "jenis_transaksi"]);

            this.warehouseRacks = this.orderSystemJson.warehouseRacks || [];
            this.filteredPurchaseOrders = this.orderSystemJson.filteredPurchaseOrders || [];
            this.PurchaseOrders = this.orderSystemJson.PurchaseOrders || [];



            this.jenis_transaksi = this.orderSystemJson.jenis_transaksi.data;
            this.suppliers = this.orderSystemJson.suppliers.data.map(supplier => ({
                id: supplier.id,
                name: supplier.nama_channel,
                contact: supplier.telp,
                address: supplier.alamat,
                default_discount: supplier.default_discount,
                default_price: supplier.default_price,
                type: "supplier"
            })) || [];


        } catch (error) {
            console.error('Error loading data:', error);
            //this.products = await this.getSampleProducts();
            this.suppliers = [];
            this.warehouseRacks = [];
            const samplePOs = [];
            this.filteredPurchaseOrders = samplePOs;
            this.PurchaseOrders = [...samplePOs];
        }

    }






    render() {
        const HTML = `
        <div class="admin-container">
            <div class="admin-content">
                <!-- PO List View -->
                <div id="poListView" class="view-section">
                    ${this.renderListView()}
                </div>
                
                <!-- Add PO View - Step 1: PO Type -->
                <div id="addPoTypeView" class="view-section" style="display: none;">
                    ${this.renderTypeView()}
                </div>
                
                <!-- Add PO View - Step 2: Scan -->
                <div id="addPoScanView" class="view-section" style="display: none;">
                    ${this.renderScanView()}
                </div>
                
                <!-- Add PO View - Step 3: Confirm Products -->
                <div id="addPoConfirmView" class="view-section" style="display: none;">
                    ${this.renderConfirmView()}
                </div>
                
                <!-- Add PO View - Step 4: Product Details -->
                <div id="addPoDetailView" class="view-section" style="display: none;">
                    ${this.renderDetailView()}
                </div>
				<div id="addDetailReceive" class="view-section" style="display: none;">
                    ${this.renderDetailTabPenerimaan()}
                </div>
                
                <!-- PO Detail View -->
                <div id="poDetailView" class="view-section" style="display: none;">
                    ${this.renderDetailPOView()}
                </div>
				 <div id="editPoView" class="view-section" style="display: none;">
                    ${this.renderEditView()}
                </div>
            </div>
        </div>`;

        document.getElementById('pages_content').innerHTML = HTML;
    }

    renderListView() {
        return `
            <div class="admin-header">
                <h2 class="admin-title">Daftar Purchase Order </h2>
                <div class="admin-actions">
                    <button class="btn btn-primary" id="addPoBtn">
                        <i class="fas fa-plus"></i> Buat PO
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-file-export"></i> Ekspor
                    </button>
                </div>
            </div>
            
            <div class="filter-section">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label">Cari PO</label>
                        <input type="text" class="filter-input" id="searchPo" placeholder="ID PO atau Supplier">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="draft">Draft</option>
                            <option value="ordered">Dipesan</option>
                            <option value="shipped">Dikirim</option>
                            <option value="received">Diterima</option>
                            <option value="partial">Parsial</option>
                            <option value="cancelled">Dibatalkan</option>
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
                    <div class="stat-title">Total PO</div>
                    <div class="stat-value" id="totalPos">0</div>
                </div>
                <div class="stat-card draft">
                    <div class="stat-title">Draft</div>
                    <div class="stat-value" id="draftPos">0</div>
                </div>
                <div class="stat-card ordered">
                    <div class="stat-title">Diproses</div>
                    <div class="stat-value" id="orderedPos">0</div>
                </div>
                <div class="stat-card received">
                    <div class="stat-title">Selesai</div>
                    <div class="stat-value" id="receivedPos">0</div>
                </div>
            </div>
            
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID PO</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Stage</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="poTableBody">
                        <!-- POs will be populated here -->
                    </tbody>
                </table>
            </div>
        `;
    }


    renderPoList() {
        const tableBody = document.getElementById('poTableBody');
        tableBody.innerHTML = this.filteredPurchaseOrders.map(po => `
            <tr>
                <td>
                    <span class="order-id">${po.nomor}</span>
                </td>
                <td>${this.formatDate(po.tanggal)}</td>
                <td>${this.formatCurrency(po.total)}</td>
                <td>
                    <div class="status-badge ${this.getStatusClass(po.status_penerimaan)}">
                           Barang: ${this.getStatusText(po.status_penerimaan)}</div>
                    <div class="status-badge ${this.getStatusClass(po.status_payment)}">
                           Pelunasan: ${this.getStatusText(po.status_payment)}</div> 
                </td> 
                <td><span class="status-badge ${this.getStatusClass(po.status_pemesanan)}">
                            ${this.getStatusText(po.status_pemesanan)}</span></td> 
                <td>
                <div class="action-buttons">
                    <button class="btn btn-sm btn-view action-btn" data-action="view" data-po-id="${po.id}">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <button class="btn btn-sm btn-edit action-btn" data-action="edit" data-po-id="${po.id}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger action-btn" data-action="hapus" data-po-id="${po.id}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </td>
			 
        `).join('');
    }
    renderTypeView() {
        const pembelianData = this.jenis_transaksi.filter(item => item.tipe === 'pembelian');
        return `
            <div class="content-header">
                <button class="back-button" id="backToPoListFromType">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </button>
                <h2 class="admin-title">Buat Purchase Order - Pilih Jenis</h2>
            </div>
            
            <div class="po-type-selection">
                <div class="form-group">
                    <label class="form-label">Jenis Purchase Order</label>
                    <div class="po-type-selector">
					${pembelianData.map(item => `
                        <div class="po-type-card" data-type="${item.nama_jenis_pembelian_barang.toLowerCase()}">
                            <div class="po-type-icon" style="color: var(--${item.nama_jenis_pembelian_barang.toLowerCase()});">
                                <i class="${item.icon}"></i>
                            </div>
                            <div class="po-type-title">${item.nama_jenis_pembelian_barang}</div>
                            <div class="po-type-desc">${item.deskripsi_jenis_pembelian_barang}</div>
                        </div>
                    `).join('')}
                        
                    </div>
                    <input type="hidden" id="selectedPoType" required>
                </div>
                
                <div class="supplier-selection" id="supplierSelection" style="display: none;">
                    <h3>Informasi Supplier/Produsen</h3>
                    <div class="form-group">
                        <label class="form-label">Nama Supplier/Produsen</label>
                        <select class="form-select" id="supplierSelect">
                            <option value="">Pilih Supplier</option>
                            ${this.suppliers.map(supplier =>
            `<option value="${supplier.id}" data-type="${supplier.type}">${supplier.name}</option>`
        ).join('')}
                        </select>
                    </div>
					<div class="d-none">
                    <div class="form-group">
                        <label class="form-label">Kontak</label>
                        <input type="text" class="form-input" id="supplierContact" placeholder="Telepon/Email" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-textarea" id="supplierAddress" placeholder="Alamat supplier" readonly></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Pembelian</label>
                        <select class="form-select" id="jenis-pembelian">
                            <option value="receiving">Barang sudah diterima</option>
                            <option value="progres">Barang dalam proses pembelian</option>
                            <option value="none">Barang belum dibeli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pelunasan Pembayaran</label>
                        <select class="form-select" id="pelunasan-pembayaran">
                            <option value="">- PILIH -</option>
                            <option value="lunas">Lunas Total</option>
                            <option value="sebagian">Lunas Sebagian</option>
                            <option value="belum">belum</option>
                        </select>
                    </div>
					<div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="transfer">Transfer Bank</option>
                            <option value="cash">Tunai</option>
                            <option value="credit">Kredit (30 hari)</option>
                            <option value="cod">COD (Bayar saat terima)</option>
                        </select>
                    </div>
                     
                            
                        
                        
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-secondary" id="backToTypeBtn">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button class="btn btn-primary" id="proceedToScan" disabled>
                        <i class="fas fa-arrow-right"></i> Lanjut ke Scan Produk
                    </button>
                </div>
            </div>
        `;
    }

    renderScanView(mode = "add") {
        return `
            <div class="content-header " data-mode="${mode}" id="typeScanView">
            
                <button class="back-button" id="backToTypeFromScan">
                    <i class="fas fa-arrow-left"></i> Kembali ke Pilih Jenis
                </button>
                <h2 class="admin-title">Scan Produk - ${this.getTypeText(this.selectedPoType)}</h2>
            </div>
            
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
            ${this.renderProductSearch()}
            <div class="scanned-products">
                <h3>Produk Ter-Scan <span class="badge">${this.scannedProducts.length}</span></h3>
                <div id="scannedProductsList" class="scanned-list">
                    ${this.scannedProducts.length === 0 ?
                '<div class="empty-state">Belum ada produk yang di-scan</div>' :
                ''}
                </div>
            </div>
            
            <div class="form-actions">
            
                <button class="btn btn-secondary" id="backToScanBtn">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                
                <button class="btn btn-success" id="proceedToConfirm" ${this.scannedProducts.length === 0 ? 'disabled' : ''}>
                    <i class="fas fa-arrow-right"></i> Lanjut ke Konfirmasi (${this.scannedProducts.length})
                </button>
               
            </div>
        `;
    }
    renderProductSearch() {
        return `
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
    `;
    }
    async searchProducts(query = '', page = 1, limit = 20) {
        try {
            this.showSearchLoading();

            let payload;
            if (query && query.length >= 2) {
                // Search dengan query
                payload = {
                    "db": "view_produk_detail", "function": "all_produk",
                    "where": [{
                        "fields": ["nama_barang", "nama_varian", "barcode", "barcode_varian"],
                        "operator": "like_or_fields",
                        "value": `%${query}%`
                    }],
                    "limit": limit,
                    "offset": (page - 1) * limit
                };
            } else {
                // Tampilkan semua produk (default)
                payload = {
                    "db": "view_produk_detail", "function": "all_produk",
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
            const response = await fetch(`${this.apiBaseUrl}/api/json/all_produk`, {
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
            console.log(result);

            const transformedProducts = this.transformProductData(result.data);
            console.log(transformedProducts);
            this.showSearchResults(transformedProducts, result.data.length, page, limit, query);

            if (query && transformedProducts.length === 1) {
                this.autoAddSingleProduct(transformedProducts[0]);
            }

        } catch (error) {
            console.error('Error searching products:', error);
            this.showSearchError('Error mencari produk: ' + error.message);
        }
    }

    // Method untuk otomatis tambah produk jika hasil hanya 1
    autoAddSingleProduct(product) {
        // Tampilkan notifikasi bahwa produk akan ditambahkan
        this.showScanSuccess(`Produk "${product.name}" langsung ditambahkan`);

        // Tambahkan ke scanned products
        this.addProductToScannedList(product, product.barcode);

        // Clear search input
        const searchInput = document.getElementById('productSearchInput');
        if (searchInput) {
            searchInput.value = '';
        }
    }
    transformProductData(products) {
        console.log(products);
        const productArray = Object.values(products);
        
        return productArray.map(product => {
            // Jika produk punya multiple varian, kita tampilkan semua varian sebagai produk terpisah
            const variants = [];

            if (product.varian && Object.keys(product.varian).length > 0) {
                // Untuk setiap varian, buat entry terpisah
                for (const variantId in product.varian) {
                    const variant = product.varian[variantId];
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
                // Produk tanpa varian
                variants.push({
                    id: product.id,
                    name: product.nama_barang,
                    barcode: product.barcode,
                    base_price: parseInt(product.harga_awal) || 0,
                    image: product.foto_aset,
                    stock: 0,
                    variant_detail: variant,
                    produk_detail: product // Default stock untuk produk tanpa varian
                });
            }

            return variants;
        }).flat(); // Flatten array of arrays
    }
    showVariantSelection(productData, barcode) {
        const product = productData;

        // Jika produk memiliki multiple varian, tampilkan pilihan
        if (product.varian && Object.keys(product.varian).length > 1) {
            const modalContent = `
            <div class="variant-selection-modal">
                <h3>Pilih Varian Produk</h3>
                <p>Produk "${product.nama_barang}" memiliki multiple varian:</p>
                <div class="variants-list">
                    ${Object.keys(product.varian).map(variantId => {
                const variant = product.varian[variantId];
                return `
                            <div class="variant-item" data-variant-id="${variantId}">
                                <div class="variant-info">
                                    <strong>${variant.nama_varian}</strong>
                                    <div>Barcode: ${variant.barcode_varian}</div>
                                    <div>Harga: ${this.formatCurrency(variant.harga_pokok_varian)}</div>
                                    <div>Stok: ${variant.stok || 0}</div>
                                </div>
                                <button class="btn btn-sm btn-success select-variant" 
                                        data-barcode="${variant.barcode_varian}">
                                    Pilih
                                </button>
                            </div>
                        `;
            }).join('')}
                </div>
                <div class="modal-actions">
                    <button class="btn btn-secondary" onclick="this.closest('.modal').remove()">Batal</button>
                </div>
            </div>
        `;

            this.showModal('Pilih Varian Produk', modalContent);

            // Add event listeners untuk pilihan varian
            setTimeout(() => {
                document.querySelectorAll('.select-variant').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const selectedBarcode = e.target.getAttribute('data-barcode');
                        document.querySelector('.modal').remove();
                        this.processSelectedVariant(selectedBarcode);
                    });
                });
            }, 100);

            return true;
        }

        return false;
    }

    // Process varian yang dipilih
    processSelectedVariant(barcode) {
        // Gunakan barcode yang dipilih untuk proses selanjutnya
        this.processBarcode(barcode);
    }
    showSearchLoading() {
        const resultsContainer = document.getElementById('productSearchResults');
        if (!resultsContainer) return;

        resultsContainer.innerHTML = `
        <div class="search-loading">
            <div class="loading-spinner"></div>
            <p>Mencari produk...</p>
        </div>
    `;
    }

    // Method untuk menampilkan error
    showSearchError(message) {
        const resultsContainer = document.getElementById('productSearchResults');
        if (!resultsContainer) return;

        resultsContainer.innerHTML = `
        <div class="search-error">
            <i class="fas fa-exclamation-circle"></i>
            <p>${message}</p>
        </div>
    `;
    }

    // Method untuk menampilkan hasil search
    showSearchResults(products, total, page, limit, query = '') {
        const resultsContainer = document.getElementById('productSearchResults');
        if (!resultsContainer) return;

        if (!products || products.length === 0) {
            resultsContainer.innerHTML = `
            <div class="no-results">
                <i class="fas fa-search"></i>
                <p>${query ? 'Tidak ada produk ditemukan' : 'Belum ada produk'}</p>
            </div>
        `;
            return;
        }

        resultsContainer.innerHTML = `
        <div class="search-results-header">
            <span>${query ? `Hasil pencarian "${query}"` : 'Semua Produk'} - Ditemukan ${total} produk</span>
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
                    
                    <div class="product-actions">
                        <button class="btn btn-sm btn-success add-product-btn" 
                                data-product='${JSON.stringify(product).replace(/'/g, "\\'")}'>
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                    </div>

                </div>
            `).join('')}
        </div>
        ${this.renderPagination(total, page, limit)}
    `;

        // Add event listeners untuk tombol tambah
        this.attachProductAddListeners();
    }
    attachProductAddListeners() {
        // Gunakan event delegation untuk tombol tambah
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-product-btn')) {
                const button = e.target.closest('.add-product-btn');
                const productData = JSON.parse(button.getAttribute('data-product'));
                this.addProductFromSearch(productData);
            }
        });
    }

    // Method untuk menambah produk dari search
    addProductFromSearch(product) {
        // Cek duplikat
        console.log()
        const existingIndex = this.scannedProducts.findIndex(item => item.barcode === product.barcode);

        if (existingIndex >= 0) {
            // Update quantity untuk existing product
            this.scannedProducts[existingIndex].quantity += 1;
            this.showScanSuccess(`+1 ${product.name}`);
        } else {
            const newProduct = {
                productId: product.id,
                name: product.name,
                barcode: product.barcode,
                base_price: product.base_price,
                quantity: 1,
                purchase_discount: this.selectedSupplier ? this.selectedSupplier.default_discount : 0,
                discounted_price: product.base_price,
                selling_price: Math.round(product.base_price * 1.2), // 20% markup default
                rack_id: null,
                image: product.image,
                variant_detail: product.variant_detail,
                produk_detail: product.produk_detail
            };
            this.calculateDiscountedPrice(newProduct);
            this.scannedProducts.push(newProduct);
            this.showScanSuccess(`✓ ${product.name} ditambahkan`);
        }

        this.renderScannedProducts();
        this.updateProceedButton();
    }
    renderSearchResults(products, total, page, limit) {
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

        resultsContainer.innerHTML = `
        <div class="search-results-header">
            <span>Ditemukan ${total} produk</span>
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
                    </div>
                    <div class="product-actions">
                        <button class="btn btn-sm btn-success" 
                                data-action="add-product"
                                data-barcode="${product.barcode}">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
            `).join('')}
        </div>
        ${this.renderPagination(total, page, limit)}
    `;
    }

    // Pagination component
    renderPagination(total, currentPage, limit) {
        const totalPages = Math.ceil(total / limit);
        if (totalPages <= 1) return '';

        return `
        <div class="pagination">
            <button class="btn btn-sm ${currentPage <= 1 ? 'disabled' : ''}" 
                    data-action="prev-page" 
                    ${currentPage <= 1 ? 'disabled' : ''}>
                <i class="fas fa-chevron-left"></i> Prev
            </button>
            
            <span class="page-info">Halaman ${currentPage} dari ${totalPages}</span>
            
            <button class="btn btn-sm ${currentPage >= totalPages ? 'disabled' : ''}" 
                    data-action="next-page" 
                    ${currentPage >= totalPages ? 'disabled' : ''}>
                Next <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    `;
    }
    renderConfirmView(mode = "add") {
        return `
            <div class="content-header" data-mode="${mode}" id="modeConfirmView">
                <button class="back-button" id="backToScanFromConfirm">
                    <i class="fas fa-arrow-left"></i> Kembali ke Scan
                </button>
                <h2 class="admin-title">Konfirmasi Produk</h2>
            </div>
            
            <div class="supplier-info-confirm">
                <h3>Supplier: ${this.selectedSupplier ? this.selectedSupplier.name : '-'}</h3>
                <p>Jenis PO: ${this.getTypeText(this.selectedPoType)}</p>
            </div>
            
            <div id="productConfirmList" class="product-confirm-container">
                <!-- Products confirmation will be populated here -->
            </div>
            
            <div class="form-actions">
                <button class="btn btn-secondary" id="backToConfirmBtn">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                <button class="btn btn-success" id="proceedToDetail">
                    <i class="fas fa-arrow-right"></i> Lanjut ke Detail
                </button>
            </div>
        `;
    }

    renderDetailView(mode = 'add') {

        return `
            <div class="content-header"  data-mode="${mode}" id="modeDetailView">
                <button class="back-button" id="backToConfirmFromDetail">
                    <i class="fas fa-arrow-left"></i> Kembali ke Konfirmasi
                </button>
                <h2 class="admin-title">Detail Produk & Informasi PO</h2>
            </div>
            
            <div class="po-summary-header">
                <div class="summary-info">
                    <h3>${this.selectedSupplier ? this.selectedSupplier.name : 'Supplier'}</h3>
                    <p>Jenis: ${this.getTypeText(this.selectedPoType)}</p>
                    <p>Total Produk: ${this.scannedProducts.length} item</p>
                </div>
            </div>
            
            <div id="productDetailList" class="product-detail-container">
                <!-- Product details form will be populated here -->
            </div>
            ${mode == 'add' ? `
            <div class="po-notes">
                <h3>Informasi PO</h3>
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea class="form-textarea" id="poNotes" placeholder="Catatan tambahan untuk PO" rows="3"></textarea>
                </div>
            </div>`: ``}
            
            <div class="form-actions">
                <button class="btn btn-secondary" id="backToDetailBtn">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
                
                    <button class="btn btn-success btn-penerima-on-detail" id="proceedToPenerimaan">
                        <i class="fas fa-arrow-right"></i> Lanjut ke Penerimaan
                    </button>
                    <button class="btn btn-success btn-save-on-detail" id="savePo">
                        <i class="fas fa-save"></i> Simpan PO
                    </button>
                
            </div>
        `;
    }
    renderDetailTabPenerimaan() {
        return `
		<h3>Penerimaan Barang</h3>
                <div class="receiving-items" id="receivingItemsAdd">
                    <!-- Receiving items will be populated here -->
                </div>
                
                
                <button class="btn btn-success" id="savePoReceive">
                        <i class="fas fa-save"></i> Simpan PO
                </button>
		`

    }

    renderDetailPOView() {
        //  <!--<div class="tab" data-tab="shipping">Pengiriman</div>-->
        // <!--<div class="tab" data-tab="inventory">Inventory Rak</div>
        //         <div class="tab" data-tab="history">Riwayat</div>-->
        return `
            <div class="content-header">
                <button class="back-button" id="backToPoList">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </button>
                <h2 class="admin-title">Detail Purchase Order: <span id="detailPoId"></span></h2>
                <div class="admin-actions">
                    <button class="btn btn-warning" id="editPoBtn">
                        <i class="fas fa-edit"></i> Edit PO
                    </button>
                    <button class="btn btn-success" id="receiveItemsBtn">
                        <i class="fas fa-box-open"></i> Terima Barang
                    </button>
                    <button class="btn btn-info" id="processPaymentBtn">
                        <i class="fas fa-credit-card"></i> Proses Pembayaran
                    </button>
                </div>
            </div>
            
            <div class="po-info row">
                <div class="info-card col-md-4">
                    <div class="info-card-title">Informasi PO</div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value" id="infoStatus"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal PO:</span>
                        <span class="info-value" id="infoPoDate"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Jenis PO:</span>
                        <span class="info-value" id="infoPoType"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Metode Pembayaran:</span>
                        <span class="info-value" id="infoPaymentMethod"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Catatan:</span>
                        <span class="info-value" id="infoNotes"></span>
                    </div>
                     <div class="info-card-title">Informasi Supplier</div>
                    <div class="info-item">
                        <span class="info-label">Nama:</span>
                        <span class="info-value" id="infoSupplierName"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kontak:</span>
                        <span class="info-value" id="infoSupplierContact"></span>
                    </div>
                </div>
                
                
                <div class="info-card col-md-6">
                    <div class="info-card-title">Status</div>
                    <div class="info-item">
                        <span class="info-label">Pembayaran</span>
                        <span class="info-value" id="infoSupplierName"> 1</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Penerimaan</span>
                        <span class="info-value" id="infoSupplierContact">1</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Float Gudang</span>
                        <span class="info-value" id="infoSupplierAddress">1</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">Total Di terima</span>
                        <span class="info-value" id="infoSupplierAddress">1</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Di Retur</span>
                        <span class="info-value" id="infoSupplierAddress">1</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Items Gudang</span>
                        <span class="info-value" id="infoSupplierAddress">1</span>
                    </div>
                </div>
            </div>
            
            <div class="tabs">
                <div class="tab active" data-tab="items">Item PO</div>
                <div class="tab" data-tab="payment">Pembayaran</div>
               
                <div class="tab" data-tab="receiving">Penerimaan</div>
                <div class="tab" data-tab="returns">Retur</div>
				

            </div>
            
            <div id="tab-tambah-items" class="tab-content">
            </div>
            <div id="tab-confirm-items" class="tab-content">
            </div>
            <div id="tab-harga-items" class="tab-content">
            </div>
            
            <div id="tab-items" class="tab-content active">
                <h3>Daftar Item Purchase Order</h3> 
                
                <button class="btn btn-tambah-items btn-primary justDraft" data-action="tambah-item">Tambah Item</button>
               
                                
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Beli</th>
                            <th>Diskon</th>
                            <th>Harga Akhir</th>
                            <th>Harga Jual</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="poItemsList">
                        <!-- Items will be populated here -->
                    </tbody>
                </table>
                
                <table class="summary-table">
                    <tr>
                        <td>Subtotal</td>
                        <td id="itemsSubtotal">Rp 0</td>
                    </tr>
                    <tr>
                        <td>Pajak (11%)</td>
                        <td id="itemsTax">Rp 0</td>
                    </tr>
                    <tr>
                        <td>Biaya Pengiriman</td>
                        <td id="itemsShipping">Rp 0</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong id="itemsTotal">Rp 0</strong></td>
                    </tr>
                </table>
            </div>
            <div id="editItemModal" class="modal">
        <div class="modal-content">
            <h3>Edit Item Purchase Order</h3>
            <h4 id="editProductName">Nama Produk</h4>
            <form id="itemEditForm">
                <input type="hidden" id="editItemIndex">
                <div class="form-row">
                    <div class="form-group">
                        <label for="editQuantity">Jumlah</label>
                        <input type="number" id="editQuantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="editBasePrice">Harga Beli</label>
                        <input type="number" id="editBasePrice" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="editDiscount">Diskon (%)</label>
                        <input type="number" id="editDiscount" min="0" max="100" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="editSellingPrice">Harga Jual</label>
                        <input type="number" id="editSellingPrice" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="form-group d-none">
                    <label for="editRack">Rak</label>
                    <select id="editRack" class="">
                        <option value="1">Rak A1</option>
                        <option value="2">Rak A2</option>
                        <option value="3">Rak B1</option>
                        <option value="4">Rak B2</option>
                    </select>
                </div>
                <div class="modal-buttons">
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                    <button type="button" id="cancelEdit" class="btn btn-cancel">Batal</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteItemModal" class="modal">
        <div class="modal-content">
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus item ini?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="btn btn-delete">Hapus</button>
                <button id="cancelDelete" class="btn btn-cancel">Batal</button>
            </div>
        </div>
    </div>
            <div id="tab-payment" class="tab-content">
                <div class="payment-container">
        <div class="payment-header">
            <h3>Informasi Pembayaran</h3>
            <p class="text-muted">Kelola pembayaran dan buat kontrabon dengan mudah</p>
        </div>
        
        
        
        <!-- Tampilan akan diisi oleh JavaScript -->
    </div>

    <!-- Modal Konfirmasi Transfer Bank -->
    <div class="modal fade" id="bankTransferModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Transfer Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="bankTransferModalBody">
                    <!-- Konten modal akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

            </div>
            
            <div id="tab-shipping" class="tab-content">
                <h3>Informasi Pengiriman</h3>
                <div class="shipping-form">
                    <div class="form-group">
                        <label class="form-label">Expedisi</label>
                        <input type="text" class="form-input" id="shippingExpedition" placeholder="Nama expedisi">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Layanan</label>
                        <input type="text" class="form-input" id="shippingService" placeholder="Jenis layanan">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Resi</label>
                        <input type="text" class="form-input" id="shippingTracking" placeholder="Nomor resi">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat Penerima</label>
                        <textarea class="form-textarea" id="shippingAddress" placeholder="Alamat lengkap"></textarea>
                    </div>
                    <button class="btn btn-primary" id="saveShipping">
                        <i class="fas fa-save"></i> Simpan Info Pengiriman
                    </button>
                </div>
                
                <div class="shipping-history">
                    <h4>Riwayat Pengiriman</h4>
                    <div id="shippingTimeline">
                        <!-- Shipping timeline will be populated here -->
                    </div>
                </div>
            </div>
            
            <div id="tab-receiving" class="tab-content">
                <h3>Penerimaan Barang</h3>
                <div class="receiving-items" id="receivingItems">
                    <!-- Receiving items will be populated here -->
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-success justProses" id="completeReceiving">
                        <i class="fas fa-check"></i> Simpan Penerimaan Baru
                    </button>
                </div>
            </div>
            
            <div id="tab-returns" class="tab-content">
                <h3>Manajemen Retur</h3>
                <div class="returns-section">
                    <button class="btn btn-warning" id="createReturn">
                        <i class="fas fa-undo"></i> Buat Retur
                    </button>
                    
                    <div id="returnsList">
                        <!-- Returns list will be populated here -->
                    </div>
                </div>
            </div>
            <div id="tab-inventory" class="tab-content">
    <h3>Inventory Rak - Penerimaan Barang</h3>
    
    <div class="inventory-controls">
        <div class="form-group">
            <label class="form-label">Filter Rak:</label>
            <select class="form-select" id="inventoryRackFilter" onchange="purchaseOrderUI.filterInventory()">
                <option value="">Semua Rak</option>
                ${this.warehouseRacks.map(rack =>
            `<option value="${rack.id}">${rack.name}</option>`
        ).join('')}
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Cari Produk:</label>
            <input type="text" class="form-input" id="inventorySearch" 
                   placeholder="Nama produk atau barcode..." oninput="purchaseOrderUI.filterInventory()">
        </div>
    </div>
    
    <div class="inventory-summary">
        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-title">Total Rak</div>
                <div class="summary-value">${this.warehouseRacks.length}</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Total Penerimaan</div>
                <div class="summary-value" id="totalReceivings">0</div>
            </div>
            <div class="summary-card">
                <div class="summary-title">Kapasitas Terpakai</div>
                <div class="summary-value" id="usedCapacity">0%</div>
            </div>
        </div>
    </div>
    
    <div class="inventory-views">
        <div class="view-toggle">
            <button class="btn btn-sm btn-outline-primary active" data-view="rack">View per Rak</button>
            <button class="btn btn-sm btn-outline-primary" data-view="product">View per Produk</button>
            <button class="btn btn-sm btn-outline-primary" data-view="history">Riwayat Penerimaan</button>
        </div>
    </div>
    
    <div id="rackView" class="inventory-view active">
        <div class="racks-grid" id="racksGrid">
            <!-- Rak inventory akan diisi di sini -->
        </div>
    </div>
    
    <div id="productView" class="inventory-view">
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Barcode</th>
                    <th>Total Stock</th>
                    <th>Distribusi Rak</th>
                    <th>Terakhir Diterima</th>
                </tr>
            </thead>
            <tbody id="productInventoryList">
                <!-- Product inventory akan diisi di sini -->
            </tbody>
        </table>
    </div>
    
    <div id="historyView" class="inventory-view">
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>PO</th>
                    <th>Supplier</th>
                    <th>Produk</th>
                    <th>Quantity</th>
                    <th>Rak</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="receivingHistoryList">
                <!-- Receiving history akan diisi di sini -->
            </tbody>
        </table>
    </div>
</div>
            <div id="tab-history" class="tab-content">
                <h3>Riwayat Purchase Order</h3>
                <div class="timeline" id="poTimeline">
                    <!-- Timeline will be populated here -->
                </div>
            </div>
        `;
    }
    renderEditView() {
        return `
            <div class="content-header">
                <button class="back-button" id="backToDetailFromEdit">
                    <i class="fas fa-arrow-left"></i> Kembali ke Detail
                </button>
                <h2 class="admin-title">Edit Purchase Order: <span id="editPoIdDisplay"></span></h2>
            </div>
            
            <div class="edit-po-container">
                <div class="form-section">
                    <h3>Informasi PO</h3>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editPoStatus">
                            <option value="draft">Draft</option>
                            <option value="proses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    
                </div>
                <div class="form-group">
                        <label class="form-label">Jenis Pembelian</label>
                        <select class="form-select" id="edit-jenis-pembelian">
                            <option value="receiving">Barang sudah diterima</option>
                            <option value="progres">Barang dalam proses pembelian</option>
                            <option value="none">Barang belum dibeli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pelunasan Pembayaran</label>
                        <select class="form-select" id="edit-pelunasan-pembayaran">
                            <option value="">- PILIH -</option>
                            <option value="lunas">Lunas Total</option>
                            <option value="sebagian">Lunas Sebagian</option>
                            <option value="belum">belum</option>
                        </select>
                    </div>
                
                
                <div class="form-actions">
                    <button class="btn btn-secondary" id="cancelEdit">
                        Batal
                    </button>
                    <button class="btn btn-success" id="saveEditPo">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        `;
    }
    viewPoDetail(poId) {
        console.log('View PO Detail:', poId);
        console.log('Available POs:', this.filteredPurchaseOrders);

        this.currentPoId = poId;
        this.showView('poDetailView');

        // PERBAIKAN: Tunggu sebentar agar DOM ter-render dulu
        setTimeout(() => {
            this.populatePoDetail();
        }, 100);
    }


    populateHideshow() {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);

        const prosesEls = document.querySelectorAll('.justProses');
        const draftEls = document.querySelectorAll('.justDraft');

        if (this.getStatusText(po.status_pemesanan) === 'Draft') {
            prosesEls.forEach(el => el.style.setProperty('display', 'none', 'important'));
            draftEls.forEach(el => el.style.setProperty('display', 'block', 'important'));
        }
        else if (this.getStatusText(po.status_pemesanan) === 'Diproses') {
            prosesEls.forEach(el => el.style.setProperty('display', 'block', 'important'));
            draftEls.forEach(el => el.style.setProperty('display', 'none', 'important'));
        }
        else {
            prosesEls.forEach(el => el.style.setProperty('display', 'none', 'important'));
            draftEls.forEach(el => el.style.setProperty('display', 'none', 'important'));
        }
    }


    populatePoDetail() {
        let poList;
        if (Array.isArray(this.filteredPurchaseOrders)) {
        poList = this.filteredPurchaseOrders;
    } else if (typeof this.filteredPurchaseOrders === "object" && this.filteredPurchaseOrders !== null) {
        // jika object, convert menjadi array dari values-nya
        poList = Object.values(this.filteredPurchaseOrders);
    } else {
        console.error("filteredPurchaseOrders bukan array atau object:", this.filteredPurchaseOrders);
        return;
    }
        const po = poList.find(p => p.id === this.currentPoId);

        // PERBAIKAN: Debug lebih detail
        if (!po) {
            console.error('PO tidak ditemukan:', this.currentPoId);
            console.log('Available POs:', this.filteredPurchaseOrders.map(p => p.id));
            alert('Data PO tidak ditemukan!');
            this.showView('poListView');
            return;
        }

        console.log('Populating PO:', po);

        // PERBAIKAN: Gunakan nullish coalescing untuk handle undefined
        document.getElementById('detailPoId').textContent = po.id || '-';
        document.getElementById('infoStatus').textContent = this.getStatusText(po.status_pemesanan);
        document.getElementById('infoPoDate').textContent = this.formatDate(po.date);
        document.getElementById('infoPoType').textContent = this.getTypeText(po.type);
        document.getElementById('infoPaymentMethod').textContent = po.paymentMethod || '-';
        document.getElementById('infoNotes').textContent = po.notes || '-';

        // Supplier info dengan pengecekan
        if (po.supplier) {
            document.getElementById('infoSupplierName').textContent = po.supplier.name || '-';
            document.getElementById('infoSupplierContact').textContent = po.supplier.contact || '-';
            document.getElementById('infoSupplierAddress').textContent = po.supplier.address || '-';
        }

        // Items dengan pengecekan
        const itemsList = document.getElementById('poItemsList');
        if (po.items && po.items.length > 0) {
            itemsList.innerHTML = po.items.map((item, index) => `
				<tr  data-item-index="${index}" >
					<td>${item.name || '-'}</td>
					<td>${item.quantity || 0}</td>
					<td>${this.formatCurrency(item.base_price || 0)}</td>
					<td>${item.purchase_discount || 0}%</td>
					<td>${this.formatCurrency(item.discounted_price || 0)}</td>
					<td>${this.formatCurrency(item.selling_price || 0)}</td>
					<td>${this.formatCurrency((item.discounted_price || 0) * (item.quantity || 0))}</td>
                    <td>
                        
                            <div class="action-buttons">
                                <button class="btn btn-edit-items justDraft" data-action="edit-item">Edit</button>
                                <button class="btn btn-delete-items justDraft" data-action="delete-item">Hapus</button>
                            </div>
                        
                        </td>
				</tr>
			`).join('');
        } else {
            itemsList.innerHTML = '<tr><td colspan="8" style="text-align: center;">Tidak ada items</td></tr>';
        }

        // Summary dengan default value
        document.getElementById('itemsSubtotal').textContent = this.formatCurrency(po.subtotal || 0);
        document.getElementById('itemsTax').textContent = this.formatCurrency(po.tax || 0);
        document.getElementById('itemsShipping').textContent = this.formatCurrency(po.shipping || 0);
        document.getElementById('itemsTotal').textContent = this.formatCurrency(po.total || 0);
        this.setupPOListEventListeners();
        // Payment info
        // document.getElementById('paymentTotal').textContent = this.formatCurrency(po.total || 0);

        // Timeline
        this.populateHideshow();
        if (po.history) {
            this.populateTimeline(po.history);
        }
    }
    populateTimeline(history) {
        const timeline = document.getElementById('poTimeline');
        if (!timeline) return;

        timeline.innerHTML = history.map(event => `
            <div class="timeline-item">
                <div class="timeline-date">${this.formatDate(event.date)}</div>
                <div class="timeline-content">
                    <strong>${event.action}</strong> oleh ${event.user}
                </div>
            </div>
        `).join('');
    }

    // Method untuk edit PO
    editPo(poId) {
        this.currentPoId = poId;
        this.showView('editPoView');
        this.populateEditForm();
    }
    deletePo(poId) {
        this.currentPoId = poId;
        this.showView('editPoView');
        this.populateEditForm();
    }

    populateEditForm() {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po) return;
        this.po = po;
        document.getElementById('editPoIdDisplay').textContent = po.id;
        document.getElementById('editPoStatus').value = po.status;
        // document.getElementById('editPaymentMethod').value = po.paymentMethod;
        // document.getElementById('editPoNotes').value = po.notes || '';

        // Populate items for editing

    }

    updateEditItem(index, field, value) {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po || !po.items[index]) return;

        if (field === 'base_price') {
            po.items[index].base_price = this.parseCurrency(value);
        } else if (field === 'quantity') {
            po.items[index].quantity = parseInt(value) || 1;
        } else if (field === 'purchase_discount') {
            po.items[index].purchase_discount = parseFloat(value) || 0;
        }

        // Recalculate discounted price
        this.calculateDiscountedPrice(po.items[index]);

        // Recalculate PO totals
        this.calculatePOTotals(po);
    }

    removeEditItem(index) {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po || !po.items[index]) return;

        if (confirm('Hapus item ini?')) {
            po.items.splice(index, 1);
            this.populateEditForm();
        }
    }

    calculatePOTotals(po) {
        po.subtotal = po.items.reduce((sum, item) => sum + (item.discounted_price * item.quantity), 0);
        po.tax = po.subtotal * 0.11;
        po.total = po.subtotal + po.tax + po.shipping;
    }

    async saveEditPo() {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po) return;

        po.status = document.getElementById('editPoStatus').value;
        po.status_payment = document.getElementById('edit-pelunasan-pembayaran').value;
        po.status_penerimaan = document.getElementById('edit-jenis-pembelian').value;
        let data = {
            status_pemesanan: po.status,
            status_payment: po.status_payment,
            status_penerimaan: po.status_penerimaan

        };
        // Add to history
        await this.SendItemsToBackend(data, "update");

        this.filteredPurchaseOrders = [...this.filteredPurchaseOrders];
        this.showView('poDetailView');
        this.populatePoDetail();
        this.renderPoList();
        this.updateStats();
        this.showAlert('success', 'PO berhasil diperbarui!');
    }

    // View Management
    showView(viewName) {
        document.querySelectorAll('.view-section').forEach(view => {
            view.style.display = 'none';
        });
        document.getElementById(viewName).style.display = 'block';
        this.currentView = viewName.replace('View', '');
    }

    // Scanner Functionality
    async startCamera() {
        try {
            const video = document.getElementById('scannerVideo');
            const stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "environment",
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                }
            });

            video.srcObject = stream;
            video.play();

            document.getElementById('startCamera').disabled = true;
            document.getElementById('stopCamera').disabled = false;
            document.getElementById('scannerStatus').innerHTML = '<i class="fas fa-check-circle" style="color: green;"></i> Kamera aktif - Arahkan ke barcode';

            // Initialize QuaggaJS for better barcode scanning
            this.initializeQuagga();

        } catch (error) {
            console.error('Error accessing camera:', error);
            document.getElementById('scannerStatus').innerHTML = '<i class="fas fa-exclamation-circle" style="color: red;"></i> Tidak dapat mengakses kamera: ' + error.message;
        }
    }

    initializeQuagga() {
        // Load QuaggaJS library dynamically
        if (typeof Quagga === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js';
            script.onload = () => this.startQuagga();
            document.head.appendChild(script);
        } else {
            this.startQuagga();
        }
    }

    startQuagga() {
        try {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scannerVideo'),
                    constraints: {
                        facingMode: "environment"
                    },
                },
                decoder: {
                    readers: [
                        "code_128_reader",
                        "ean_reader",
                        "ean_8_reader",
                        "code_39_reader",
                        "upc_reader",
                        "upc_e_reader"
                    ]
                },
                locate: true
            }, (err) => {
                if (err) {
                    console.error('Quagga init error:', err);
                    this.startFallbackScanner();
                    return;
                }
                Quagga.start();
                document.getElementById('scannerStatus').innerHTML = '<i class="fas fa-check-circle" style="color: green;"></i> Scanner aktif - Scan barcode...';
            });

            Quagga.onDetected((result) => {
                const code = result.codeResult.code;
                this.processBarcode(code);

                // Visual feedback
                this.showScanSuccess();
            });

        } catch (error) {
            console.error('Quagga error:', error);
            this.startFallbackScanner();
        }
    }

    startFallbackScanner() {
        // Fallback to canvas-based scanning
        document.getElementById('scannerStatus').innerHTML = '<i class="fas fa-info-circle"></i> Scanner dasar aktif - Pastikan pencahayaan cukup';
        this.scannerActive = true;
        this.scanBarcode();
    }

    async scanBarcode() {
        if (!this.scannerActive) return;

        const video = document.getElementById('scannerVideo');
        const canvas = document.getElementById('scannerCanvas');
        const context = canvas.getContext('2d');

        if (video.videoWidth > 0 && video.videoHeight > 0) {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Simple barcode detection (basic fallback)
            try {
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                // Add simple barcode detection logic here
            } catch (error) {
                console.error('Scan error:', error);
            }
        }

        setTimeout(() => {
            if (this.scannerActive) {
                this.scanBarcode();
            }
        }, 500);
    }

    showScanSuccess() {
        const overlay = document.getElementById('scannerOverlay');
        overlay.style.display = 'block';
        overlay.style.background = 'rgba(0, 255, 0, 0.3)';

        setTimeout(() => {
            overlay.style.background = 'transparent';
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 300);
        }, 300);
    }

    stopCamera() {
        // Stop Quagga if running
        if (typeof Quagga !== 'undefined' && Quagga.isInitialized) {
            Quagga.stop();
        }

        // Stop camera stream
        const video = document.getElementById('scannerVideo');
        const stream = video.srcObject;
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
        }

        this.scannerActive = false;
        document.getElementById('startCamera').disabled = false;
        document.getElementById('stopCamera').disabled = true;
        document.getElementById('scannerStatus').innerHTML = '<i class="fas fa-info-circle"></i> Kamera dimatikan';
    }

    async processBarcode(barcode) {
        if (!barcode || barcode.length < 8) {
            this.showScanError('Barcode tidak valid');
            return;
        }

        document.getElementById('scannerResult').innerHTML = barcode;

        try {
            // Cari produk by barcode dari API baru
            const product = await this.findProductByBarcodeAPI(barcode);
            console.log("findProductByBarcodeAPI", product);
            if (product) {
                console.log('product');

                this.addProductToScannedList(product, barcode);
            } else {
                console.log('productData');
                const productData = await this.getProductDataByBarcode(barcode);
                if (productData && this.showVariantSelection(productData, barcode)) {
                    return;
                }
                this.showScanError('Produk tidak ditemukan di database');
            }

        } catch (error) {
            console.error('Error searching product:', error);
            this.showScanError('Error mencari produk');
        }
    }
    addProductToScannedList(product, barcode) {
        // Cek duplikat
        console.log(this.scannedProducts);

        const existingIndex = this.scannedProducts.findIndex(item => item.barcode === barcode);
        let foundProduct = null;
        let foundVariant = null;

        if (existingIndex >= 0) {
            // Update quantity untuk existing product
            this.scannedProducts[existingIndex].quantity += 1;
            this.showScanSuccess(`+1 ${product.name}`);
        } else {
            console.log(" Add new product");
            // Add new product
            const newProduct = {
                productId: product.id,
                name: product.name,
                barcode: barcode,
                base_price: product.base_price,
                quantity: 1,
                purchase_discount: this.selectedSupplier ? this.selectedSupplier.default_discount : 0,
                discounted_price: product.base_price,
                selling_price: Math.round(product.base_price * 1.2), // 20% markup default
                rack_id: null,
                image: product.image,
                variant_detail: product.variant_detail,
                produk_detail: product.produk_detail
            };

            this.calculateDiscountedPrice(newProduct);
            this.scannedProducts.push(newProduct);
            this.showScanSuccess(`✓ ${product.name}`);
        }

        this.renderScannedProducts();
        this.updateProceedButton();
    }
    async getProductDataByBarcode(barcode) {
        try {
            const payload = {
                "db": "view_produk_detail", "function": "all_produk",
                "where": [{
                    "fields": ["nama_barang", "nama_varian", "barcode", "barcode_varian"],
                    "operator": "like_or_fields",
                    "value": `%${barcode}%`
                }],
                "limit": 1,
                "offset": 0
            };
            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hour = String(now.getUTCHours()).padStart(2, '0');

            const token = `SECRET_TOKEN_${year}${month}${day}${hour}`;
            const response = await fetch(`${this.apiBaseUrl}/api/json/all_produk`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error(`API error: ${response.status}`);

            const result = await response.json();
            return result.success && result.data.length > 0 ? result.data[0] : null;

        } catch (error) {
            console.error('Error getting product data:', error);
            return null;
        }
    }

    async findProductByBarcodeAPI(barcode) {
        try {
            // Gunakan endpoint /api/json/all_produk dengan payload yang sesuai
            const payload = {
                "db": "view_produk_detail", "function": "all_produk",
                "where": [{
                    "fields": ["nama_barang", "nama_varian", "barcode", "barcode_varian"],
                    "operator": "like_or_fields",
                    "value": `%${barcode}%`
                }],
                "limit": 30,
                "offset": 0
            };

            const now = new Date();
            const year = now.getUTCFullYear();
            const month = String(now.getUTCMonth() + 1).padStart(2, '0');
            const day = String(now.getUTCDate()).padStart(2, '0');
            const hour = String(now.getUTCHours()).padStart(2, '0');

            const token = `SECRET_TOKEN_${year}${month}${day}${hour}`;
            const response = await fetch(`${this.apiBaseUrl}/api/json/all_produk`, {
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

            // Filter hasil untuk mendapatkan produk dengan barcode yang tepat
            if (result.success && result.data && result.data.length > 0) {
                return this.filterProductByExactBarcode(result.data, barcode);
            }

            return null;

        } catch (error) {
            console.error('Error fetching product by barcode:', error);

            return this.findProductByBarcodeLocal(barcode);
        }
    }

    // Method helper untuk filter produk dengan barcode exact
    filterProductByExactBarcode(products, barcode) {
        for (const product of products) {
            // Cek barcode utama produk
            if (product.barcode === barcode) {
                return {
                    id: product.id,
                    name: product.nama_barang,
                    barcode: product.barcode,
                    base_price: parseInt(product.harga_awal) || 0,
                    image: product.foto_aset,
                    produk_detail: product
                };
            }

            // Cek varian produk
            if (product.varian) {
                for (const variantId in product.varian) {
                    const variant = product.varian[variantId];
                    if (variant.barcode_varian === barcode) {
                        return {
                            id: variant.id_barang_varian,
                            name: variant.nama_varian,
                            barcode: variant.barcode_varian,
                            base_price: parseInt(variant.harga_pokok_varian) || 0,
                            image: variant.gambar_produk_varian || product.foto_aset,
                            variant_detail: variant,
                            produk_detail: product
                        };
                    }
                }
            }
        }
        return null;
    }

    // Fallback local search (untuk sample data kecil)
    findProductByBarcodeLocal(barcode) {
        for (const product of this.products) {
            // Cek produk tanpa varian
            if (product.barcode === barcode) {
                return {
                    id: product.id,
                    name: product.nama_barang,
                    barcode: product.barcode,
                    base_price: parseInt(product.harga_pokok) || 0,
                    image: product.foto_aset
                };
            }

            // Cek produk dengan varian
            if (product.varian) {
                for (const variantId in product.varian) {
                    const variant = product.varian[variantId];
                    if (variant.barcode_varian === barcode) {
                        return {
                            id: variant.id_barang_varian,
                            name: variant.nama_varian,
                            barcode: variant.barcode_varian,
                            base_price: parseInt(variant.harga_pokok_varian) || 0,
                            image: variant.gambar_produk_varian
                        };
                    }
                }
            }
        }
        return null;
    }
    p2rocessBarcode(barcode) {
        if (!barcode || barcode.length < 8) {
            this.showScanError('Barcode tidak valid');
            return;
        }
        document.getElementById('scannerResult').innerHTML = barcode;
        // Cek duplikat
        const existingIndex = this.scannedProducts.findIndex(item => item.barcode === barcode);

        // Find product by barcode
        let foundProduct = null;
        let foundVariant = null;

        for (const product of this.products) {
            // Cek produk tanpa varian
            if (product.barcode === barcode) {
                foundProduct = product;
                break;
            }

            // Cek produk dengan varian
            if (product.varian) {
                for (const variantId in product.varian) {
                    const variant = product.varian[variantId];
                    if (variant.barcode_varian === barcode) {
                        foundProduct = product;
                        foundVariant = variant;
                        break;
                    }
                }
            }
            if (foundProduct) break;
        }

        if (foundProduct) {
            const productName = foundVariant ? foundVariant.nama_varian : foundProduct.nama_barang;
            const basePrice = foundVariant ?
                parseInt(foundVariant.harga_pokok_varian) :
                parseInt(foundProduct.harga_pokok);

            if (existingIndex >= 0) {
                // Update quantity for existing product
                this.scannedProducts[existingIndex].quantity += 1;
                this.showScanSuccess(`+1 ${productName}`);
            } else {
                // Add new product
                const newProduct = {
                    productId: foundVariant ? foundVariant.id_barang_varian : foundProduct.id,
                    name: productName,
                    barcode: barcode,
                    base_price: basePrice,
                    quantity: 1,
                    purchase_discount: this.selectedSupplier ? this.selectedSupplier.default_discount : 0,
                    discounted_price: basePrice,
                    selling_price: Math.round(basePrice * 1.2), // 20% markup default
                    rack_id: null,
                    image: foundVariant ? foundVariant.gambar_produk_varian : foundProduct.foto_aset,

                    variant_detail: product.variant_detail,
                    produk_detail: product.produk_detail
                };

                this.calculateDiscountedPrice(newProduct);
                this.scannedProducts.push(newProduct);
                this.showScanSuccess(`✓ ${productName}`);
            }
            this.renderScannedProducts();
            this.updateProceedButton();

        } else {
            this.showScanError('Produk tidak ditemukan');
        }
    }
    updateProceedButton() {
        const proceedBtn = document.getElementById('proceedToConfirm');
        if (proceedBtn) {
            proceedBtn.disabled = this.scannedProducts.length === 0;
            proceedBtn.innerHTML = `<i class="fas fa-arrow-right"></i> Lanjut ke Konfirmasi (${this.scannedProducts.length})`;
        }
    }
    showScanSuccess(message) {
        const status = document.getElementById('scannerStatus');
        status.innerHTML = `<i class="fas fa-check-circle" style="color: green;"></i> ${message}`;

        setTimeout(() => {
            if (this.scannerActive) {
                status.innerHTML = '<i class="fas fa-check-circle" style="color: green;"></i> Scanner aktif - Scan barcode...';
            }
        }, 2000);
    }

    showScanError(message) {
        const status = document.getElementById('scannerStatus');
        status.innerHTML = `<i class="fas fa-exclamation-circle" style="color: red;"></i> ${message}`;

        setTimeout(() => {
            if (this.scannerActive) {
                status.innerHTML = '<i class="fas fa-check-circle" style="color: green;"></i> Scanner aktif - Scan barcode...';
            }
        }, 3000);
    }

    renderScannedProducts() {
        const container = document.getElementById('scannedProductsList');
        container.innerHTML = this.scannedProducts.map(item => `
            <div class="scanned-item">
                <div class="scanned-info">
                    <strong>${item.name}</strong>
                    <div>Barcode: ${item.barcode}</div>
                    <div>Jumlah: ${item.quantity}</div>
                </div>
                <div class="scanned-actions">
                    <button class="btn btn-sm btn-danger" onclick="purchaseOrderUI.removeScannedProduct('${item.barcode}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }
    renderScannedProducts() {
        const container = document.getElementById('scannedProductsList');
        if (!container) return;

        if (this.scannedProducts.length === 0) {
            container.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-barcode"></i>
                <p>Belum ada produk yang di-scan</p>
            </div>
        `;
            return;
        }

        container.innerHTML = this.scannedProducts.map((item, index) => `
        <div class="scanned-item ${index === this.scannedProducts.length - 1 ? 'new-item' : ''}" 
             data-barcode="${item.barcode}">
            <div class="scanned-info">
                <strong title="${item.name}">${this.truncateText(item.name, 50)}</strong>
                <div>Barcode: ${item.barcode}</div>
                <div>Jumlah: <strong>${item.quantity}</strong></div>
                ${item.base_price ? `<div>Harga: ${this.formatCurrency(item.base_price)}</div>` : ''}
            </div>
            <div class="scanned-actions">
                <button class="btn btn-sm btn-danger remove-scanned-btn" 
                        data-barcode="${item.barcode}"
                        title="Hapus produk">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `).join('');

        // Attach event listeners
        this.attachScannedProductsListeners();
    }

    // Method untuk attach event listeners
    attachScannedProductsListeners() {
        // Event delegation untuk tombol hapus
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-scanned-btn')) {
                const button = e.target.closest('.remove-scanned-btn');
                const barcode = button.getAttribute('data-barcode');
                this.removeScannedProduct(barcode);
            }
        });

        // Hover effects
        document.addEventListener('mouseenter', (e) => {
            if (e.target.closest('.scanned-item')) {
                e.target.closest('.scanned-item').classList.add('highlight');
            }
        }, true);

        document.addEventListener('mouseleave', (e) => {
            if (e.target.closest('.scanned-item')) {
                e.target.closest('.scanned-item').classList.remove('highlight');
            }
        }, true);
    }

    // Method truncate text
    truncateText(text, maxLength) {
        if (!text) return '';
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    }
    removeScannedProduct(barcode) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (!product) return;

        // Animation sebelum remove
        const productElement = document.querySelector(`.scanned-item[data-barcode="${barcode}"]`);
        if (productElement) {
            productElement.style.opacity = '0';
            productElement.style.transform = 'translateX(-10px)';

            setTimeout(() => {
                // Remove dari array
                this.scannedProducts = this.scannedProducts.filter(item => item.barcode !== barcode);
                // Re-render
                this.renderScannedProducts();
                this.updateProceedButton();

                // Show notification
                this.showNotification(`Produk "${product.name}" dihapus`, 'info');
            }, 300);
        }
    }

    // Product Confirmation Step
    renderProductConfirmation() {
        const container = document.getElementById('productConfirmList');
        if (!container) return;

        container.innerHTML = this.scannedProducts.map(item => `
        <div class="product-confirm-item" data-barcode="${item.barcode}">
            <div class="product-info">
                <h4>${item.name}</h4>
                <div>Barcode: ${item.barcode}</div>
                <div>Jumlah: <strong>${item.quantity}</strong></div>
            </div>
            <div class="product-actions">
                <button class="btn btn-warning edit-quantity-btn" data-barcode="${item.barcode}">
                    <i class="fas fa-edit"></i> Edit Jumlah
                </button>
            </div>
        </div>
    `).join('');

        // Attach event listeners
        this.attachProductConfirmationListeners();
    }
    attachProductConfirmationListeners() {
        // Event delegation untuk tombol edit quantity
        document.addEventListener('click', (e) => {
            if (e.target.closest('.edit-quantity-btn')) {
                const button = e.target.closest('.edit-quantity-btn');
                const barcode = button.getAttribute('data-barcode');
                this.editProductQuantity(barcode);
            }
        });
    }

    editProductQuantity(barcode) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (!product) return;

        // Cari element product yang sesuai
        const productElement = this.findProductElementByBarcode(barcode);
        if (!productElement) return;

        // Ganti tampilan dengan input form
        this.renderQuantityEditForm(productElement, product);
    }

    // Method untuk mencari element product by barcode
    findProductElementByBarcode(barcode) {
        const productItems = document.querySelectorAll('.product-confirm-item');
        for (const item of productItems) {
            const productInfo = item.querySelector('.product-info');
            if (productInfo && productInfo.textContent.includes(barcode)) {
                return item;
            }
        }
        return null;
    }

    // Method untuk render form edit quantity
    renderQuantityEditForm(productElement, product) {
        const productInfo = productElement.querySelector('.product-info');
        const productActions = productElement.querySelector('.product-actions');

        if (!productInfo || !productActions) return;

        // Simpan original content
        const originalContent = productInfo.innerHTML;

        // Render form edit
        productInfo.innerHTML = `
        <div class="quantity-edit-form">
            <h4>${product.name}</h4>
            <div class="barcode-info">Barcode: ${product.barcode}</div>
            <div class="quantity-controls">
                <label for="quantityInput-${product.barcode}">Jumlah:</label>
                <div class="quantity-input-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary quantity-decrease" 
                            data-barcode="${product.barcode}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" 
                           id="quantityInput-${product.barcode}" 
                           class="quantity-input" 
                           value="${product.quantity}" 
                           min="1" 
                           max="999"
                           data-barcode="${product.barcode}">
                    <button type="button" class="btn btn-sm btn-outline-secondary quantity-increase" 
                            data-barcode="${product.barcode}">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    `;

        // Update actions buttons
        productActions.innerHTML = `
        <button class="btn btn-success save-quantity" data-barcode="${product.barcode}">
            <i class="fas fa-check"></i> Simpan
        </button>
        <button class="btn btn-secondary cancel-edit" data-barcode="${product.barcode}">
            <i class="fas fa-times"></i> Batal
        </button>
    `;

        // Focus on input
        setTimeout(() => {
            const input = document.getElementById(`quantityInput-${product.barcode}`);
            if (input) {
                input.focus();
                input.select();
            }
        }, 100);

        // Add event listeners untuk form
        this.attachQuantityEditListeners(product.barcode, originalContent);
    }

    // Method untuk attach event listeners ke form edit
    attachQuantityEditListeners(barcode, originalContent) {
        const productElement = this.findProductElementByBarcode(barcode);
        if (!productElement) return;

        // Save button
        const saveButton = productElement.querySelector('.save-quantity');
        if (saveButton) {
            saveButton.addEventListener('click', () => {
                this.saveQuantityChange(barcode);
            });
        }

        // Cancel button
        const cancelButton = productElement.querySelector('.cancel-edit');
        if (cancelButton) {
            cancelButton.addEventListener('click', () => {
                this.cancelQuantityEdit(barcode, originalContent);
            });
        }

        // Increase button
        const increaseButton = productElement.querySelector('.quantity-increase');
        if (increaseButton) {
            increaseButton.addEventListener('click', () => {
                this.changeQuantity(barcode, 1);
            });
        }

        // Decrease button
        const decreaseButton = productElement.querySelector('.quantity-decrease');
        if (decreaseButton) {
            decreaseButton.addEventListener('click', () => {
                this.changeQuantity(barcode, -1);
            });
        }

        // Input enter key
        const quantityInput = document.getElementById(`quantityInput-${barcode}`);
        if (quantityInput) {
            quantityInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.saveQuantityChange(barcode);
                }
            });

            quantityInput.addEventListener('input', (e) => {
                this.validateQuantityInput(e.target);
            });
        }
    }

    // Method untuk change quantity dengan tombol +/-
    changeQuantity(barcode, change) {
        const quantityInput = document.getElementById(`quantityInput-${barcode}`);
        if (!quantityInput) return;

        let newQuantity = parseInt(quantityInput.value) + change;

        // Validate min value
        if (newQuantity < 1) newQuantity = 1;
        if (newQuantity > 999) newQuantity = 999;

        quantityInput.value = newQuantity;
        this.validateQuantityInput(quantityInput);
    }

    // Method untuk validasi input quantity
    validateQuantityInput(input) {
        let value = parseInt(input.value);

        if (isNaN(value) || value < 1) {
            input.value = 1;
        } else if (value > 999) {
            input.value = 999;
        }
    }

    // Method untuk save quantity change
    saveQuantityChange(barcode) {
        const quantityInput = document.getElementById(`quantityInput-${barcode}`);
        if (!quantityInput) return;

        const newQuantity = parseInt(quantityInput.value);

        if (isNaN(newQuantity) || newQuantity < 1) {
            this.showQuantityError('Quantity harus angka dan minimal 1');
            return;
        }

        // Update data
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            product.quantity = newQuantity;
        }

        // Render ulang tampilan normal
        this.renderNormalProductView(barcode);

        // Show success message
        this.showQuantitySuccess(`Quantity ${product.name} diubah menjadi ${newQuantity}`);
    }

    // Method untuk cancel edit
    cancelQuantityEdit(barcode, originalContent) {
        const productElement = this.findProductElementByBarcode(barcode);
        if (!productElement) return;

        const productInfo = productElement.querySelector('.product-info');
        const productActions = productElement.querySelector('.product-actions');

        if (productInfo && productActions) {
            // Kembalikan ke tampilan semula
            productInfo.innerHTML = originalContent;
            productActions.innerHTML = `
            <button class="btn btn-warning edit-quantity-btn" data-barcode="${barcode}">
                <i class="fas fa-edit"></i> Edit Jumlah
            </button>
        `;
        }
    }

    // Method untuk render tampilan normal setelah edit
    renderNormalProductView(barcode) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (!product) return;

        const productElement = this.findProductElementByBarcode(barcode);
        if (!productElement) return;

        const productInfo = productElement.querySelector('.product-info');
        const productActions = productElement.querySelector('.product-actions');

        if (productInfo && productActions) {
            productInfo.innerHTML = `
            <h4>${product.name}</h4>
            <div>Barcode: ${product.barcode}</div>
            <div>Jumlah: <strong>${product.quantity}</strong></div>
        `;

            productActions.innerHTML = `
            <button class="btn btn-warning edit-quantity-btn" data-barcode="${barcode}">
                <i class="fas fa-edit"></i> Edit Jumlah
            </button>
        `;
        }
    }

    // Method untuk show success message
    showQuantitySuccess(message) {
        // Buat temporary notification
        const notification = document.createElement('div');
        notification.className = 'quantity-notification success';
        notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${message}</span>
    `;

        document.body.appendChild(notification);

        // Show animation
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Remove after 2 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 2000);
    }

    // Method untuk show error message
    showQuantityError(message) {
        const notification = document.createElement('div');
        notification.className = 'quantity-notification error';
        notification.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        <span>${message}</span>
    `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Product Details Step
    // Ganti method renderProductDetails dengan ini:
    renderProductDetails() {
        const container = document.getElementById('productDetailList');

        const supplier = this.selectedSupplier;
        if ($('#jenis-pembelian').val() == 'receiving') {

            $('.btn-penerima-on-detail').show();
            $('.btn-save-on-detail').hide();
        }
        else {
            $('.btn-penerima-on-detail').hide();
            $('.btn-save-on-detail').show();
        }

        container.innerHTML = this.scannedProducts.map(item => `
        <div class="product-detail-item" data-barcode="${item.barcode}">
            <h4>${item.name}</h4>
            <div class="detail-form">
                <div class="form-group">
                    <label class="form-label">Harga Pokok</label>
                    <input type="text" class="form-input price-input" 
                           value="${this.formatCurrency(item.base_price)}" 
                           data-barcode="${item.barcode}">
                </div>
                <div class="form-group">
                    <label class="form-label">Diskon Pembelian (%)</label>
                    <input type="number" class="form-input discount-input" 
                           value="${supplier ? supplier.default_discount : 0}" 
                           data-barcode="${item.barcode}">
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Setelah Diskon</label>
                    <input type="text" class="form-input final-price-input" 
                           value="${this.formatCurrency(item.discounted_price)}" 
                           readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Harga Jual</label>
                    <input type="text" class="form-input selling-price-input" 
                           value="${this.formatCurrency(item.selling_price)}" 
                           data-barcode="${item.barcode}">
                </div>
                
            </div>
        </div>
    `).join('');

        // Attach event listeners untuk form details
        this.attachProductDetailsListeners();
    }
    // Tambahkan method ini:
    attachProductDetailsListeners() {
        // Event delegation untuk semua input di product details
        document.addEventListener('input', (e) => {
            // Price input change
            if (e.target.classList.contains('price-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductPrice(barcode, e.target.value);
            }

            // Discount input change
            if (e.target.classList.contains('discount-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductDiscount(barcode, e.target.value);
            }

            // Selling price input change
            if (e.target.classList.contains('selling-price-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateSellingPrice(barcode, e.target.value);
            }
        });

        // Event untuk rack select change
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('rack-select')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductRack(barcode, e.target.value);
            }
        });

        /* Event untuk format currency saat focus out
        document.addEventListener('blur', (e) => {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('selling-price-input')) {
                this.formatCurrencyInput(e.target);
            }
        });
        
        // Event untuk parse currency saat focus in
        document.addEventListener('focus', (e) => {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('selling-price-input')) {
                this.parseCurrencyInput(e.target);
            }
        });*/
    }
    // Tambahkan method helper untuk format currency di input
    formatCurrencyInput(input) {
        const value = this.parseCurrency(input.value);
        input.value = this.formatCurrency(value);
    }

    // Method untuk parse currency dari input
    parseCurrencyInput(input) {
        const value = this.parseCurrency(input.value);
        input.value = value;
    }
    updateProductPrice(barcode, price) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            product.base_price = this.parseCurrency(price);
            this.calculateDiscountedPrice(product);
            this.updatePriceDisplay(barcode);
        }
    }

    // Update method updateProductDiscount:
    updateProductDiscount(barcode, discount) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            product.purchase_discount = parseFloat(discount) || 0;
            this.calculateDiscountedPrice(product);
            this.updatePriceDisplay(barcode);
        }
    }

    // Update method updateSellingPrice:
    updateSellingPrice(barcode, price) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            product.selling_price = this.parseCurrency(price);
        }
    }

    // Update method updateProductRack:
    updateProductRack(barcode, rackId) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            product.rack_id = rackId ? parseInt(rackId) : null;
        }
    }

    calculateDiscountedPrice(product) {
        const discountAmount = product.base_price * (product.purchase_discount / 100);
        product.discounted_price = product.base_price - discountAmount;
    }

    updatePriceDisplay(barcode) {
        const product = this.scannedProducts.find(item => item.barcode === barcode);
        if (product) {
            const productElement = document.querySelector(`.product-detail-item[data-barcode="${barcode}"]`);
            if (productElement) {
                const finalPriceInput = productElement.querySelector('.final-price-input');
                if (finalPriceInput) {
                    finalPriceInput.value = this.formatCurrency(product.discounted_price);
                }
            }
        }
    }
    validatePOBeforeSave() {
        const errors = [];

        if (!this.selectedSupplier) {
            errors.push('Supplier harus dipilih');
        }

        if (this.scannedProducts.length === 0) {
            errors.push('Minimal satu produk harus dipilih');
        }

        // Validasi setiap produk
        this.scannedProducts.forEach((product, index) => {
            //if (!product.rack_id) {
            //    errors.push(`Produk "${product.name}" belum memiliki rak penyimpanan`);
            //}
            if (product.quantity <= 0) {
                errors.push(`Quantity produk "${product.name}" harus lebih dari 0`);
            }
            if (product.base_price <= 0) {
                errors.push(`Harga pokok produk "${product.name}" harus lebih dari 0`);
            }
        });

        return errors;
    }
    // Save PO
    async savePurchaseOrder() {
        const paymentMethod = document.getElementById('paymentMethod')?.value || 'transfer';
        const notes = document.getElementById('poNotes')?.value || '';
        const errors = this.validatePOBeforeSave();
        if (errors.length > 0) {
            this.showNotification(errors.join('<br>'), 'error');
            return;
        }
        if (!this.selectedSupplier) {
            this.showNotification('Pilih supplier terlebih dahulu!', 'error');
            return;
        }

        if (this.scannedProducts.length === 0) {
            this.showNotification('Tidak ada produk yang dipilih!', 'error');
            return;
        }
        try {
            // Show loading
            // this.showNotification('Menyimpan Purchase Order...', 'loading');

            // Prepare PO data untuk dikirim ke backend
            const poData = this.preparePOData(paymentMethod, notes);

            // Kirim ke backend
            const result = await this.sendPOToBackend(poData);

            if (result.success) {
                await this.handleSaveSuccess(result.data, poData, result.po_id);
            } else {
                throw new Error(result.message || 'Gagal menyimpan PO');
            }

        } catch (error) {
            console.error('Error saving PO:', error);
            this.showNotification(`Error: ${error.message}`, 'error');
        }
    }
    // Tambahkan method ini:
    preparePOData(paymentMethod, notes) {
        // Calculate totals
        const subtotal = this.scannedProducts.reduce((sum, item) =>
            sum + (item.discounted_price * item.quantity), 0
        );
        const tax = subtotal * 0.11; // 11% PPN
        const shipping = 50000; // Default shipping cost
        const total = subtotal + tax + shipping;
        const status_penerimaan = document.getElementById('jenis-pembelian')?.value || 'belum';
        const status_pembayaran = document.getElementById('pelunasan-pembayaran')?.value || 'belum';
        return {
            po_number: `PO-${Date.now().toString().slice(-6)}`,
            supplier_id: this.selectedSupplier.id,
            supplier_name: this.selectedSupplier.name,
            supplier_contact: this.selectedSupplier.contact,
            supplier_address: this.selectedSupplier.address,
            po_date: new Date().toISOString().split('T')[0],
            po_type: this.selectedPoType,
            status: "draft",
            payment_method: paymentMethod,
            status_penerimaan: status_penerimaan,
            status_pembayaran: status_pembayaran,
            notes: notes,
            items: this.scannedProducts,
            subtotal: subtotal,
            tax: tax,
            shipping_cost: shipping,
            total_amount: total,
            created_by: "admin", // bisa diganti dengan user yang login
            created_at: new Date().toISOString()
        };
    }
    // Tambahkan method ini:
    async sendPOToBackend(poData) {
        try {
            // Ganti endpoint dengan endpoint backend yang sesuai
            const response = await fetch(`${this.apiBaseUrl}/api/purchase_orders`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Tambahkan headers auth jika diperlukan
                    // 'Authorization': 'Bearer ' + this.getAuthToken()
                },
                body: JSON.stringify(poData)
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }

            return await response.json();

        } catch (error) {
            console.error('Error sending PO to backend:', error);
            throw error;
        }
    }
    // Tambahkan method ini:
    async handleSaveSuccess(backendData, localData, po_id) {
        // Gabungkan data dari backend dengan data local
        const savedPO = {
            ...localData,
            id: backendData.po_id || localData.po_number,
            backend_id: backendData.id, // ID dari database
            created_at: backendData.created_at || localData.created_at,
            status: backendData.status || "draft"
        };
        const parsedPOs = [backendData].map(po => ({
            ...po,
            items: (typeof po.items === "string" ? JSON.parse(po.items) : po.items || []).map(item => ({
                ...item,
                productId: item.id_detail,
                base_price: item.harga_penjualan,
                name: item.nama_varian || item.nama_barang,
                quantity: item.qty,
                barcode: item.barcode,
                purchase_discount: item.diskon_utama,
                discounted_price: item.total_diskon,
                selling_price: item.grand_total,
            }))
        }));
        // Add to local state
        this.PurchaseOrders.push(parsedPOs[0]);
        this.filteredPurchaseOrders.push(parsedPOs[0]);
        this.filteredPurchaseOrders = [...this.filteredPurchaseOrders];
        this.currentPoId = backendData.id;
        // Add history entry
        if (!savedPO.history) savedPO.history = [];
        savedPO.history.push({
            date: new Date().toISOString().split('T')[0],
            action: "PO dibuat dan disimpan ke sistem",
            user: "Admin"
        });

        // Show success message
        this.showNotification('Purchase Order berhasil disimpan!', 'success');
        if ($('#jenis-pembelian').val() == "receiving") {

            await this.completeReceiving();
        } else {
            setTimeout(() => {
                this.resetPOData();
                this.showView('poListView');
                this.renderPoList();
                this.updateStats();
            }, 2000);

        }
        // Reset dan kembali ke list
        // setTimeout(() => {
        this.currentPoId = null;
        //     this.resetPOData();
        //     //if()
        //     this.showView('poListView');

        //     this.renderPoList();
        //     this.updateStats();
        // }, 2000);
    }
    // Tambahkan method ini:
    resetPOData() {
        this.scannedProducts = [];
        this.selectedSupplier = null;
        this.selectedPoType = '';
        this.pendingReceiving = {};

        // Reset form fields jika ada
        const poNotes = document.getElementById('poNotes');
        if (poNotes) poNotes.value = '';

        const paymentMethod = document.getElementById('paymentMethod');
        if (paymentMethod) paymentMethod.value = 'transfer';

        const supplierSelect = document.getElementById('supplierSelect');
        if (supplierSelect) supplierSelect.value = '';

        const supplierContact = document.getElementById('supplierContact');
        if (supplierContact) supplierContact.value = '';

        const supplierAddress = document.getElementById('supplierAddress');
        if (supplierAddress) supplierAddress.value = '';
        const productSearchInput = document.getElementById('productSearchInput');
        if (productSearchInput) productSearchInput.value = '';
        const scannedProductsList = document.getElementById('scannedProductsList');
        if (scannedProductsList) scannedProductsList.innerHTML = '';
    }
    hideNotification(notification) {
        if (!notification) {
            notification = document.querySelector('.global-notification');
        }
        if (notification) {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300); // kasih waktu animasi hilang
        }
    }
    // Tambahkan method notification yang lebih baik:
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

        // Auto remove untuk non-loading notifications
        if (type !== 'loading') {
            // Close button event
            const closeBtn = notification.querySelector('.close-notif');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    this.hideNotification(notification);
                });
            }

            // Auto hide setelah 5 detik
            setTimeout(() => {
                this.hideNotification(notification);
            }, 5000);
        }

        return notification;
    }

    hideNotification(notification) {
        if (notification && notification.parentNode) {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }
    }
    // PO List Management

    receivePo(poId) {
        this.currentPoId = poId;
        this.showView('poDetailView');

        // Switch to receiving tab
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.querySelector('[data-tab="receiving"]').classList.add('active');
        document.getElementById('tab-receiving').classList.add('active');

        this.initReceivingItems("po");
    }

    async initPaymentTab() {
        console.group(`calculate()`);
        console.time("Duration");
        let paymentTab = new PaymentTabUI();
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        console.log("po", po);
        console.log("this.currentPoId", this.currentPoId);
        await paymentTab.init(this.currentPoId, po);
    }

    async initReceivingItems(mode) {
        let idContainer;
        let po = [];
        if (!mode) {
            mode = 'po';
        }
        if (mode == 'po') {
            po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
            if (!po) return;

            idContainer = "receivingItems";
        } else {
            po.items = this.scannedProducts;
            idContainer = "receivingItemsAdd";
        }
        let options = {
            method: 'PATCH',
            body: JSON.stringify({ currentPoId: this.currentPoId }),
        };
        this.data = await this.loadData(['receivings'], options);
        this.receivings = this.data.receivings;
        this.po = (po);
        console.log(this.receivings);
        const receivingContainer = document.getElementById(idContainer);
        if (!receivingContainer) return;


        receivingContainer.innerHTML = po.items.map(item => {
            // kumpulkan semua receiving item untuk item ini
            const relatedReceivingItems = [];

            this.receivings.forEach(receiving => {
                receiving.items.forEach(receivingItem => {
                    if (receivingItem.erp__pos__utama__detail_id == item.id_detail) {
                        relatedReceivingItems.push({
                            ...receivingItem,
                            receiving_parent: receiving, // Simpan info receiving parent
                        });
                    }
                });
            });

            // render semua receiving item yang ditemukan
            const receivingEntriesHTML = relatedReceivingItems.length > 0
                ? relatedReceivingItems.map((receivingItem, index) => {
                    const totalReceived = receivingItem.breakdown
                        ? receivingItem.breakdown.reduce((total, b) => total + b.qty_masuk_in, 0)
                        : 0;

                    const remaining = item.quantity - totalReceived;
                    const hasExistingReceiving =
                        receivingItem.breakdown && receivingItem.breakdown.length > 0;
                    console.log(receivingItem.id_receive);
                    return `
                <div class="receiving-entry edit" data-receiving-id="${receivingItem.id_receive}" data-detail-id="${receivingItem.id}">
                    ${hasExistingReceiving
                            ? this.renderExistingReceivingView(item, receivingItem, index)
                            : this.renderEmptyReceivingForm(item, "po", receivingItem.id_receive, receivingItem.id)
                        }
                </div>
            `;
                }).join('')
                : this.renderEmptyReceivingForm(item);

            // hitung total semua penerimaan (jika lebih dari 1 receivingItem)
            const totalReceivedAll = relatedReceivingItems.reduce((sum, ri) => {
                if (ri.breakdown) {
                    return sum + ri.breakdown.reduce((t, b) => t + b.qty_masuk_in, 0);
                }
                return sum;
            }, 0);

            const remainingAll = item.quantity - totalReceivedAll;

            return `
                <div class="receiving-item ${mode}" data-barcode="${item.barcode}">
                    <div class="receiving-info">
                        <strong>${item.name}</strong>
                        <div>Barcode: ${item.barcode}</div>
                        <div class="receiving-stats">
                            <span>Dipesan: ${item.quantity}</span>
                            <span>Sudah Diterima: ${totalReceivedAll}</span>
                            <span>Sisa: ${remainingAll}</span>
                        </div>
                    </div>
                    <div class="receiving-controls">
                        <div class="receiving-entries" id="entries-${item.barcode}">
                            ${receivingEntriesHTML}
                        </div>
                        ${remainingAll > 0 ? `
                            <button class="btn btn-sm btn-outline-primary add-new-receiving justProses" 
                                data-barcode="${item.barcode}"
                                data-action="add-new-receiving-${mode}">
                                <i class="fas fa-plus"></i> Buat Penerimaan Baru
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
        }).join('');
        this.populateHideshow();
    }

    renderExistingReceivingView(item, receivingDetail) {

        const totalReceived = receivingDetail.breakdown.reduce((total, breakdown) => total + breakdown.qty_masuk_in, 0);
        console.log(receivingDetail);
        return `
        <div class="existing-receiving-view" id="view-${item.barcode}">
            <div class="receiving-summary">
                <strong>Penerimaan Sebelumnya:</strong>
                <div><strong>Nomor Receiving:</strong> ${receivingDetail.nomor_receive}</div>
                <div><strong>Tanggal Receiving:</strong> ${receivingDetail.tanggal_receive}</div>
                <div class="breakdown-list">
                    ${receivingDetail.breakdown.map((breakdown, index) => `
                        <div class="breakdown-item">
                            <span class="quantity">${breakdown.qty_masuk_in} item</span>
                            <span class="rack">di Rak: ${this.getRackName(breakdown.id_ruang_simpan_in)}</span>
                        </div>
                    `).join('')}
                </div>
                <div class="total-received">
                    <strong>Total: ${totalReceived} item</strong>
                </div>
            </div>
            <div class="receiving-actions">
            
                <button class="btn btn-sm btn-warning edit-receiving justProses" 
                        data-barcode="${item.barcode}"
                        data-receiving-id="${receivingDetail.id_receive}"
                        data-detail-id="${receivingDetail.id}"
                        data-action="edit-receiving">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger delete-receiving justProses" 
                        data-barcode="${item.barcode}"
                        data-receiving-id="${receivingDetail.id_receive}"
                        data-detail-id="${receivingDetail.id}"
                        data-action="delete-receiving">
                    <i class="fas fa-trash"></i> Hapus 123
                </button>
              
            </div>
            ${(item.quantity - totalReceived > 0 && 1 == 0 && this.getStatusText(this.po.status_pemesanan) == 'Diproses') ? `
                <div class="additional-receiving">
                    <button class="btn btn-sm btn-outline-primary add-more-items justProses" 
                            data-barcode="${item.barcode}"
                            data-receiving-id="${receivingDetail.id_receive}"
                            data-detail-id="${receivingDetail.id}"
                            data-action="add-more-items">
                        <i class="fas fa-plus"></i> Tambah Item (${item.quantity - totalReceived} sisa)
                    </button>
                </div>
            ` : ''}
        </div>
    `;
    }


    renderEmptyReceivingForm(item, mode = "po", id_receive = null, detail_id = null) {
        return `
        <div class="empty-receiving-form"  ${id_receive ? `data-receiving-id="${id_receive}" data-detail-id="${detail_id}"` : ''}>
            <div class="receiving-entries" id="entries-${item.barcode}${id_receive ? `-${id_receive}` : ''}">
                ${this.renderReceivingEntry(item, 0, 0, null, null, id_receive, detail_id)}
            </div>
           <!-- <button class="btn btn-sm btn-outline-primary add-more-rack justProses" 
                    data-barcode="${item.barcode}"
                    data-receiving-id="${id_receive}"
                    data-detail-id="${detail_id}"
                    data-action="add-more-rack-${mode}">
                <i class="fas fa-plus"></i> Tambah Rak Lain
            </button>
            <div class="form-actions">
                <button class="btn btn-sm btn-success save-receiving justProses" 
                        data-barcode="${item.barcode}"
                        data-receiving-id="${id_receive}"
                        data-detail-id="${detail_id}"
                        data-action="save-receiving">
                    <i class="fas fa-save"></i> ${id_receive ? 'Update' : 'Simpan'} Penerimaan
                </button>
             </div>
                -->
        </div>
    `;
    }

    // Method untuk render form editing
    renderEditReceivingForm(item, receivingDetail) {
        const totalReceived = receivingDetail.breakdown.reduce((total, breakdown) => total + breakdown.qty_masuk_in, 0);
        const remaining = item.quantity - totalReceived;

        return `
        <div class="edit-receiving-form" id="edit-${item.barcode}-${receivingDetail.id_receive}">
            <div class="form-header">
                <strong>Edit Penerimaan: ${receivingDetail.nomor_receive || receivingDetail.id_receive}</strong>
                <small>Total diterima: ${totalReceived} item | Sisa: ${remaining} item</small>
            </div>
            <div class="receiving-entries" id="entries-${item.barcode}-${receivingDetail.id_receive}">
                ${receivingDetail.breakdown.map((breakdown, index) =>
            this.renderReceivingEntry(
                item,
                index,
                breakdown.qty_masuk_in,
                breakdown.id_ruang_simpan_in,
                breakdown.id,
                receivingDetail.id_receive,
                receivingDetail.id
            )
        ).join('')}
            </div>
            ${(remaining > 0 && 1 == 0) ? `
                <button class="btn btn-sm btn-outline-primary add-more-rack justProses" 
                        data-barcode="${item.barcode}"data-receiving-id="${receivingDetail.id_receive}"
                        data-detail-id="${receivingDetail.id}"
                        
                        data-action="add-more-rack-edit">
                    <i class="fas fa-plus"></i> Tambah Rak Lain
                </button>
            ` : ''}
            <div class="form-actions">
                <button class="btn btn-sm btn-success save-edit justProses" 
                        data-barcode="${item.barcode}"data-receiving-id="${receivingDetail.id_receive}"
                        data-detail-id="${receivingDetail.id}"
                        data-action="save-edit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <button class="btn btn-sm btn-secondary cancel-edit justProses" 
                        data-barcode="${item.barcode}"
                        data-action="cancel-edit">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </div>
    `;
    }

    // Method untuk render receiving entry (sama seperti sebelumnya)
    renderReceivingEntry(item, index, quantity = 0, rackId = null, breakdownId = null, id_receive = null, detail_id = null) {
        const receivingItem = this.receivings.find(receiving =>
            receiving.items.some(receivingItem =>
                receivingItem.erp__pos__utama__detail_id == item.id_detail
            )
        );

        const receivingDetail = receivingItem ?
            receivingItem.items.find(ri => ri.erp__pos__utama__detail_id == item.id_detail) :
            null;

        // const totalReceived = receivingDetail ?
        //     receivingDetail.breakdown.reduce((total, breakdown) => total + breakdown.qty_masuk_in, 0) :
        //     0;
        const totalReceived = this.calculateTotalReceived(item.id_detail, id_receive);

        const remaining = item.quantity - totalReceived;
        const currentPending = this.getTotalPendingQuantity(item.barcode, index, id_receive);
        const maxQuantity = remaining + (quantity || 0) - currentPending;
        let classEntry = "";
        if (breakdownId)
            classEntry = "edit";
        else
            classEntry = "add";
        return `
        <div class="receiving-entry ${classEntry}" data-index="${index}"
             data-breakdown-id="${breakdownId || ''}"
             ${id_receive ? `data-receiving-id="${id_receive}"` : ''}
             ${detail_id ? `data-detail-id="${detail_id}"` : ''}>
            <div class="entry-controls">
                <div class="receiving-quantity">
                    <label>Jumlah:</label>
                    <input type="number" 
                           value="${quantity}" 
                           min="0" 
                           max="${maxQuantity}"
                           data-action="update-quantity"
                           data-barcode="${item.barcode}"
                           data-index="${index}"
                           ${breakdownId ? 'data-breakdown-id="' + breakdownId + '"' : ''}
                           ${id_receive ? 'data-receiving-id="' + id_receive + '"' : ''}
                           ${detail_id ? 'data-detail-id="' + detail_id + '"' : ''}>
                </div>
                <div class="receiving-rack">
                    <label>Rak:</label>
                    <select data-action="update-rack"
                            data-barcode="${item.barcode}"
                            data-index="${index}"
                            ${breakdownId ? 'data-breakdown-id="' + breakdownId + '"' : ''}
                            ${id_receive ? 'data-receiving-id="' + id_receive + '"' : ''}
                            ${detail_id ? 'data-detail-id="' + detail_id + '"' : ''}>
                        <option value="">Pilih Rak</option>
                        ${this.warehouseRacks.map(rack => `
                            <option value="${rack.id}" ${rackId == rack.id ? 'selected' : ''}>
                                ${rack.name} (Kapasitas: ${rack.capacity})
                            </option>
                        `).join('')}
                    </select>
                </div>
                ${index > 0 ? `
                    <button type="button" class="btn btn-sm btn-danger remove-entry" 
                            data-action="remove-entry"
                            data-barcode="${item.barcode}"
                            data-index="${index}"
                            ${breakdownId ? 'data-breakdown-id="' + breakdownId + '"' : ''}
                            ${id_receive ? 'data-receiving-id="' + id_receive + '"' : ''}
                            ${detail_id ? 'data-detail-id="' + detail_id + '"' : ''}>
                        <i class="fas fa-times"></i>
                    </button>
                ` : ''}
            </div>
            <div class="entry-preview" id="preview-${item.barcode}-${index}${id_receive ? `-${id_receive}` : ''}">
                ${this.getEntryPreview(item.barcode, index, id_receive)}
            </div>
        </div>
    `;
    }
    calculateTotalReceived(itemDetailId, excludeReceivingId = null) {
        let total = 0;
        this.receivings.forEach(receiving => {
            // Skip jika ini adalah receiving yang sedang diedit
            if (excludeReceivingId && receiving.id == excludeReceivingId) {
                return;
            }
            receiving.items.forEach(item => {
                if (item.erp__pos__utama__detail_id == itemDetailId && item.breakdown) {
                    total += item.breakdown.reduce((sum, breakdown) => sum + breakdown.qty_masuk_in, 0);
                }
            });
        });
        return total;
    }

    // Method untuk mendapatkan nama rak
    getRackName(rackId) {
        console.log(rackId);
        console.log(this.warehouseRacks);
        const rack = this.warehouseRacks.find(rack => parseInt(rack.id) == parseInt(rackId));
        return rack ? rack.name : 'Rak tidak ditemukan';
    }

    // Method untuk mendapatkan total pending quantity

    // Updated getTotalPendingQuantity dengan id_receive
    getTotalPendingQuantity(barcode, currentIndex, id_receive = null) {
        const containerId = id_receive ? `entries-${barcode}-${id_receive}` : `entries-${barcode}`;
        const entriesContainer = document.getElementById(containerId);
        if (!entriesContainer) return 0;

        const quantityInputs = entriesContainer.querySelectorAll('input[data-action="update-quantity"]');
        let total = 0;

        quantityInputs.forEach((input, index) => {
            if (index !== currentIndex && input.value) {
                total += parseInt(input.value) || 0;
            }
        });

        return total;
    }

    // Method untuk update preview
    getEntryPreview(barcode, index) {
        const entryContainer = document.querySelector(`.receiving-entry[data-index="${index}"]`);
        if (!entryContainer) return '';

        const quantityInput = entryContainer.querySelector('input[data-action="update-quantity"]');
        const rackSelect = entryContainer.querySelector('select[data-action="update-rack"]');

        const quantity = quantityInput ? quantityInput.value : 0;
        const rackId = rackSelect ? rackSelect.value : '';
        const rackName = rackSelect ? rackSelect.options[rackSelect.selectedIndex]?.text : '';

        if (!quantity || quantity == 0 || !rackId) {
            return '<span class="text-muted">Belum diisi</span>';
        }

        return `
        <div class="preview-info">
            <strong>${quantity} item</strong> akan disimpan di <strong>${rackName}</strong>
        </div>
    `;
    }

    // Event handler untuk update quantity
    updateQuantityHandler(barcode, index, value, breakdownId = null) {
        const item = this.po.items.find(item => item.barcode === barcode);
        if (!item) return;

        // Update UI
        const previewElement = document.getElementById(`preview-${barcode}-${index}`);
        if (previewElement) {
            previewElement.innerHTML = this.getEntryPreview(barcode, index);
        }

        // Update stats
        this.updateReceivingStats(barcode);

        // Jika ada breakdownId, berarti ini edit existing data
        if (breakdownId) {
            this.updateExistingBreakdown(breakdownId, value);
        }
    }

    // Method untuk update existing breakdown
    updateExistingBreakdown(breakdownId, newQuantity) {
        // Cari breakdown di this.receivings
        this.receivings.forEach(receiving => {
            receiving.items.forEach(item => {
                const breakdown = item.breakdown.find(b => b.id == breakdownId);
                if (breakdown) {
                    breakdown.qty_masuk_in = parseInt(newQuantity) || 0;
                }
            });
        });

        console.log('Updated breakdown:', this.receivings);
    }

    // Method untuk update receiving stats


    // Method untuk update receiving stats
    updateReceivingStats(barcode, receivingId = null, detailId = null) {
        const itemElement = document.querySelector(`.receiving-item[data-barcode="${barcode}"]`);
        if (!itemElement) return;

        // Hitung total received dari SEMUA receiving untuk item ini
        const item = this.po.items.find(item => item.barcode === barcode);
        let totalReceivedAll = 0;

        // Hitung dari data receivings yang ada
        this.receivings.forEach(receiving => {
            receiving.items.forEach(receivingItem => {
                if (receivingItem.erp__pos__utama__detail_id == item.id_detail && receivingItem.breakdown) {
                    totalReceivedAll += receivingItem.breakdown.reduce((sum, breakdown) => sum + breakdown.qty_masuk_in, 0);
                }
            });
        });

        // Jika sedang dalam mode edit, tambahkan juga yang sedang diinput
        if (receivingId) {
            const entriesContainer = document.getElementById(`entries-${barcode}-${receivingId}`);
            if (entriesContainer) {
                const quantityInputs = entriesContainer.querySelectorAll('input[data-action="update-quantity"]');
                let currentInputTotal = 0;

                quantityInputs.forEach(input => {
                    currentInputTotal += parseInt(input.value) || 0;
                });

                // Kurangi total dari receiving yang sedang diedit (karena mungkin sudah termasuk dalam receivings)
                const existingReceivingTotal = this.getExistingReceivingTotal(item.id_detail, receivingId);
                totalReceivedAll = totalReceivedAll - existingReceivingTotal + currentInputTotal;
            }
        }

        const remainingAll = item.quantity - totalReceivedAll;

        const statsElement = itemElement.querySelector('.receiving-stats');
        if (statsElement) {
            statsElement.innerHTML = `
            <span>Dipesan: ${item.quantity}</span>
            <span>Sudah Diterima: ${totalReceivedAll}</span>
            <span>Sisa: ${remainingAll}</span>
        `;
        }

        // Show/hide "Tambah Rak Lain" button untuk semua receiving
        const addButtons = itemElement.querySelectorAll('.add-more-rack');
        addButtons.forEach(addButton => {
            if (remainingAll > 0) {
                addButton.style.display = 'block';
            } else {
                addButton.style.display = 'none';
            }
        });

        // Show/hide "Buat Penerimaan Baru" button
        const addNewReceivingButton = itemElement.querySelector('.add-new-receiving');
        if (addNewReceivingButton) {
            if (remainingAll > 0) {
                addNewReceivingButton.style.display = 'block';
            } else {
                addNewReceivingButton.style.display = 'none';
            }
        }

        // Update juga "Tambah Item" button di existing receiving views
        const addMoreItemsButtons = itemElement.querySelectorAll('.add-more-items');
        addMoreItemsButtons.forEach(button => {
            const currentReceivingId = button.getAttribute('data-receiving-id');
            const currentDetailId = button.getAttribute('data-detail-id');

            // Hitung sisa untuk receiving spesifik ini
            const remainingForThisReceiving = this.calculateRemainingForReceiving(item.id_detail, currentReceivingId);

            if (remainingForThisReceiving > 0) {
                button.style.display = 'block';
                button.innerHTML = `<i class="fas fa-plus"></i> Tambah Item (${remainingForThisReceiving} sisa)`;
            } else {
                button.style.display = 'none';
            }
        });
    }

    // Helper method untuk mendapatkan total dari receiving tertentu
    getExistingReceivingTotal(itemDetailId, receivingId) {
        let total = 0;
        const receiving = this.receivings.find(r => r.id == receivingId);
        if (receiving) {
            receiving.items.forEach(item => {
                if (item.erp__pos__utama__detail_id == itemDetailId && item.breakdown) {
                    total += item.breakdown.reduce((sum, breakdown) => sum + breakdown.qty_masuk_in, 0);
                }
            });
        }
        return total;
    }

    // Helper method untuk menghitung sisa untuk receiving tertentu
    calculateRemainingForReceiving(itemDetailId, receivingId) {
        const item = this.po.items.find(item => item.id_detail == itemDetailId);
        if (!item) return 0;

        // Total semua receiving kecuali yang sedang diproses
        const otherReceivingTotal = this.calculateOtherReceivingTotal(itemDetailId, receivingId);

        // Total dari receiving yang sedang diproses (dari input)
        const currentReceivingTotal = this.getCurrentReceivingInputTotal(receivingId, item.barcode);

        const remaining = item.quantity - (otherReceivingTotal + currentReceivingTotal);
        return Math.max(0, remaining);
    }

    // Helper method untuk mendapatkan total input dari receiving yang sedang diedit
    getCurrentReceivingInputTotal(receivingId, barcode) {
        const entriesContainer = document.getElementById(`entries-${barcode}-${receivingId}`);
        if (!entriesContainer) return 0;

        const quantityInputs = entriesContainer.querySelectorAll('input[data-action="update-quantity"]');
        let total = 0;

        quantityInputs.forEach(input => {
            total += parseInt(input.value) || 0;
        });

        return total;
    }
    async editReceiving(barcode, receivingId, detailId) {
        const item = this.po.items.find(item => item.barcode === barcode);
        const receivingItem = this.findReceivingItem(receivingId, detailId);
        if (receivingItem) {
            console.log("receivingId", receivingId);
            const viewElement = document.querySelector(`[data-receiving-id="${receivingId}"][data-detail-id="${detailId}"]`);
            if (viewElement) {
                console.log("ada");
                viewElement.innerHTML = this.renderEditReceivingForm(item, receivingItem);
            }
        } else {
           //??
        }
    }

    async deleteReceiving(barcode, receivingId, detailId) {
        if (confirm('Apakah Anda yakin ingin menghapus data penerimaan ini?')) {
            try {
                const result = await this.deleteReceivingData(receivingId, detailId);
                if (result.success) {
                    this.showAlert('success', 'Penerimaan berhasil dihapus!');
                    this.initReceivingItems(); // Refresh data
                } else {
                    this.showAlert('error', result.message);
                }
            } catch (error) {
                this.showAlert('error', 'Terjadi kesalahan saat menghapus data');
            }
        }
    }

    // Helper method untuk mencari receiving item
    findReceivingItem(receivingId, detailId) {
        for (const receiving of this.receivings) {



            const detail = receiving.items.find(item => item.id_receive == receivingId);
            if (detail) {
                return {
                    ...detail,
                    id_receive: receivingId,
                    receiving_parent: receiving
                };
            }

        }
        return null;
    }

    // Method untuk menambah receiving baru
    addNewReceiving(barcode) {
        const item = this.po.items.find(item => item.barcode === barcode);
        const entriesContainer = document.getElementById(`entries-${barcode}`);

        if (entriesContainer) {
            const newReceivingHTML = this.renderEmptyReceivingForm(item);
            entriesContainer.insertAdjacentHTML('beforeend', newReceivingHTML);
        }
    }
    editReceiving2(barcode) {
        const item = this.po.items.find(item => item.barcode === barcode);
        const receivingItem = this.receivings.find(receiving =>
            receiving.items.some(receivingItem =>
                receivingItem.erp__pos__utama__detail_id == item.id_detail
            )
        );
        const receivingDetail = receivingItem.items.find(ri => ri.erp__pos__utama__detail_id == item.id_detail);

        const viewElement = document.getElementById(`view-${barcode}`);
        if (viewElement) {
            viewElement.innerHTML = this.renderEditReceivingForm(item, receivingDetail);
        }
    }

    // Method untuk delete receiving
    deleteReceiving2(barcode) {
        if (confirm('Apakah Anda yakin ingin menghapus data penerimaan ini?')) {
            const item = this.po.items.find(item => item.barcode === barcode);

            // Hapus dari data receivings
            this.receivings = this.receivings.filter(receiving =>
                !receiving.items.some(receivingItem =>
                    receivingItem.erp__pos__utama__detail_id == item.id_detail
                )
            );

            // Refresh tampilan
            this.refreshReceivingView(barcode);
        }
    }

    // Method untuk tambah item baru ke existing receiving
    addMoreItems2(barcode) {
        const item = this.po.items.find(item => item.barcode === barcode);
        const receivingItem = this.receivings.find(receiving =>
            receiving.items.some(receivingItem =>
                receivingItem.erp__pos__utama__detail_id == item.id_detail
            )
        );
        const receivingDetail = receivingItem.items.find(ri => ri.erp__pos__utama__detail_id == item.id_detail);

        const viewElement = document.getElementById(`view-${barcode}`);
        if (viewElement) {
            viewElement.innerHTML = this.renderEditReceivingForm(item, receivingDetail);
        }
    }
    async sendDeleteToBackend(deleteData, receiveId, detailId) {
        try {
            const response = await fetch('/api/receivings', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'endpoint': 'delete'
                },
                body: JSON.stringify({
                    receiveId: receiveId,
                    ...deleteData
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            return result;

        } catch (error) {
            console.error('Error sending delete to backend:', error);
            throw new Error('Gagal mengirim permintaan hapus ke server');
        }
    }
    // Method untuk save edit
    async saveEdit(barcode, receivingId, detailId) {
        this.setLoadingState(barcode, true);

        try {
            // Validasi terlebih dahulu
            if (!this.validateReceiving(barcode, receivingId)) {
                return;
            }

            // Update data ke backend
            const result = await this.updateReceivingData(barcode, receivingId, detailId);

            if (result.success) {
                // Kembali ke view mode
                this.initReceivingItems("po");
                this.showAlert('success', 'Perubahan berhasil disimpan!');
            } else {
                this.showAlert('error', result.message);
            }

        } catch (error) {
            console.error('Error in saveEdit:', error);
            this.showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        } finally {
            // Remove loading state
            this.setLoadingState(barcode, receivingId, false);
        }
    }
    setLoadingState(barcode, receivingId, isLoading) {
        const saveButton = document.querySelector(`[data-barcode="${barcode}"][data-receiving-id="${receivingId}"][data-action="save-edit"]`);
        if (saveButton) {
            if (isLoading) {
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                saveButton.disabled = true;
            } else {
                saveButton.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
                saveButton.disabled = false;
            }
        }
    }



    async updateReceivingData(barcode, receivingId, detailId) {
        try {
            const item = this.po.items.find(item => item.barcode === barcode);
            if (!item) throw new Error('Item tidak ditemukan');

            const entriesContainer = document.getElementById(`entries-${barcode}-${receivingId}`);
            const entries = entriesContainer.querySelectorAll('.receiving-entry');

            // Cari receiving item yang spesifik berdasarkan receivingId
            let receivingItem = this.receivings.find(receiving =>
                receiving.id == receivingId
            );

            // Siapkan data untuk dikirim ke backend
            const updateData = {
                id_order: this.po.id,
                receiving_id: receivingId,
                detail_id: detailId,
                items: []
            };

            // Process each entry
            const breakdownUpdates = [];
            const breakdownCreates = [];
            const breakdownDeletes = [];

            entries.forEach((entry, index) => {
                const breakdownId = entry.getAttribute('data-breakdown-id');
                const quantityInput = entry.querySelector('input[data-action="update-quantity"]');
                const rackSelect = entry.querySelector('select[data-action="update-rack"]');

                const quantity = parseInt(quantityInput.value) || 0;
                const rackId = rackSelect ? rackSelect.value : null;

                if (quantity > 0 && rackId) {
                    if (breakdownId) {
                        // Update existing breakdown
                        breakdownUpdates.push({
                            id: parseInt(breakdownId),
                            qty_masuk_in: quantity,
                            id_ruang_simpan_in: parseInt(rackId),
                            id_erp__utama__detail_masuk: item.id_detail,
                            update_by: "20240226230013939733",
                            update_date: new Date().toISOString().replace('T', ' ').substring(0, 19)
                        });
                    } else {
                        // Create new breakdown
                        breakdownCreates.push({
                            id_erp__pos__inventory: receivingId,
                            id_erp__pos__inventory__receive: detailId,
                            id_erp__utama__detail_masuk: item.id_detail,
                            id_gudang_in: 10, // Default warehouse
                            id_ruang_simpan_in: parseInt(rackId),
                            id_barang_varian_in: item.id_barang_varian,
                            qty_masuk_in: quantity,
                            qty_keluar_in: null,
                            stok_in: quantity,
                            harga_beli_in: item.discounted_price || item.base_price,
                            asal_barang_dari: "Master",
                            asal_from_data_varian: "Api",
                            active: 1,
                            create_by: "20240226230013939733",
                            create_date: new Date().toISOString().replace('T', ' ').substring(0, 19)
                        });
                    }
                }
            });

            // Identify breakdowns to delete (existing breakdowns not in current entries)
            if (receivingItem) {
                const receivingDetail = receivingItem.items.find(ri =>
                    ri.id == detailId && ri.erp__pos__utama__detail_id == item.id_detail
                );

                if (receivingDetail && receivingDetail.breakdown) {
                    const currentBreakdownIds = Array.from(entries)
                        .map(entry => entry.getAttribute('data-breakdown-id'))
                        .filter(id => id);

                    receivingDetail.breakdown.forEach(breakdown => {
                        if (!currentBreakdownIds.includes(breakdown.id.toString())) {
                            breakdownDeletes.push({
                                id: breakdown.id,
                                delete_by: "20240226230013939733",
                                delete_date: new Date().toISOString().replace('T', ' ').substring(0, 19),
                                active: 0
                            });
                        }
                    });
                }
            }

            // Prepare main update data
            updateData.breakdown_updates = breakdownUpdates;
            updateData.breakdown_creates = breakdownCreates;
            updateData.breakdown_deletes = breakdownDeletes;

            console.log('Data to be sent to backend:', updateData);

            // Send to backend
            const response = await this.sendUpdateToBackend(updateData);

            if (response.success) {
                // Update local data dengan response dari backend
                // await this.updateLocalDataAfterBackend(response.data, barcode, receivingId, detailId);

                return {
                    success: true,
                    message: 'Data berhasil diperbarui'
                };
            } else {
                throw new Error(response.message || 'Gagal memperbarui data');
            }

        } catch (error) {
            console.error('Error updating receiving data:', error);
            return {
                success: false,
                message: error.message
            };
        }
    }


    // Method untuk mengirim data ke backend
    async sendUpdateToBackend(updateData) {
        try {
            const response = await fetch('/api/receivings', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'endpoint': 'update',
                },
                body: JSON.stringify(updateData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            return result;

        } catch (error) {
            console.error('Error sending data to backend:', error);
            throw new Error('Gagal mengirim data ke server');
        }
    }

    // Method untuk show alert
    showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        `;

        // Tambahkan alert ke container yang sesuai
        const alertContainer = document.getElementById('alert-container') || document.body;
        alertContainer.insertAdjacentHTML('afterbegin', alertHtml);

        // Auto remove after 5 seconds
        setTimeout(() => {
            const alert = alertContainer.querySelector('.alert');
            if (alert) alert.remove();
        }, 5000);
    }
    // Method untuk update local data setelah backend berhasil
    updateLocalDataAfterBackend(backendData, barcode, receivingId, detailId) {
        const item = this.po.items.find(item => item.barcode === barcode);

        // Cari receiving item
        let receivingItem = this.receivings.find(receiving =>
            receiving.id == receivingId
        );

        if (!receivingItem && backendData.receiving_id) {
            receivingItem = {
                id: backendData.receiving_id.toString(),
                id_order: this.po.id,
                items: []
            };
            this.receivings.push(receivingItem);
        }

        if (receivingItem) {
            // Cari atau buat receiving detail
            let receivingDetail = receivingItem.items.find(ri =>
                ri.id == detailId && ri.erp__pos__utama__detail_id == item.id_detail
            );

            if (!receivingDetail) {
                receivingDetail = {
                    id: detailId || backendData.receiving_detail_id,
                    erp__pos__utama__detail_id: item.id_detail,
                    breakdown: []
                };
                receivingItem.items.push(receivingDetail);
            }

            // Update breakdown data
            receivingDetail.breakdown = backendData.breakdowns.map(bd => ({
                id: bd.id,
                id_erp__pos__inventory: bd.id_erp__pos__inventory,
                id_erp__pos__inventory__receive: bd.id_erp__pos__inventory__receive,
                id_erp__utama__detail_masuk: bd.id_erp__utama__detail_masuk,
                id_gudang_in: bd.id_gudang_in,
                id_ruang_simpan_in: bd.id_ruang_simpan_in,
                id_barang_varian_in: bd.id_barang_varian_in,
                qty_masuk_in: bd.qty_masuk_in,
                qty_keluar_in: bd.qty_keluar_in,
                stok_in: bd.stok_in,
                harga_beli_in: bd.harga_beli_in,
                asal_barang_dari: bd.asal_barang_dari,
                asal_from_data_varian: bd.asal_from_data_varian,
                active: bd.active,
                create_by: bd.create_by,
                create_date: bd.create_date,
                update_by: bd.update_by,
                update_date: bd.update_date
            }));

            // Update total received quantity
            receivingDetail.qty_diterima = receivingDetail.breakdown.reduce((total, bd) => total + bd.qty_masuk_in, 0);
        }

        console.log('Local data updated after backend:', this.receivings);
    } async saveNewReceiving(barcode, receivingId = null, detailId = null) {
        this.setLoadingState(barcode, receivingId, true);

        try {
            // Validasi terlebih dahulu
            if (!this.validateReceiving(barcode, receivingId)) {
                return;
            }

            let result;
            if (receivingId && detailId) {
                // Update existing receiving
                result = await this.updateReceivingData(barcode, receivingId, detailId);
            } else {
                // Create new receiving
                result = await this.saveNewReceivingData(barcode, receivingId, detailId);
            }

            if (result.success) {
                // Kembali ke view mode
                this.refreshReceivingView(barcode, receivingId, detailId);
                this.showAlert('success', receivingId ? 'Penerimaan berhasil diperbarui!' : 'Penerimaan berhasil disimpan!');
            } else {
                this.showAlert('error', result.message);
            }

        } catch (error) {
            console.error('Error in saveNewReceiving:', error);
            this.showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        } finally {
            // Remove loading state
            this.setLoadingState(barcode, receivingId, false);
        }
    }

    // Method untuk save new receiving data dengan backend
    async saveNewReceivingData(barcode) {
        try {
            const item = this.po.items.find(item => item.barcode === barcode);
            if (!item) throw new Error('Item tidak ditemukan');

            const entriesContainer = document.getElementById(`entries-${barcode}`);
            const entries = entriesContainer.querySelectorAll('.receiving-entry');

            // Prepare data for new receiving
            const newReceivingData = {
                id_order: this.po.id,
                nomor_receive: `RCV-${this.po.nomor}-${Date.now()}`,
                tanggal_diterima: new Date().toISOString().substring(0, 10),
                items: []
            };

            const itemData = {
                erp__pos__utama__detail_id: item.id_detail,
                id_asset: item.id_inventaris__asset__list,
                id_varian: item.id_varian,
                id_asset_varian_inv: item.id_barang_varian,
                nama_varian: item.nama_varian,
                qty_pesan: item.quantity,
                harga: item.base_price,
                breakdowns: []
            };

            // Process each entry
            entries.forEach((entry, index) => {
                const quantityInput = entry.querySelector('input[data-action="update-quantity"]');
                const rackSelect = entry.querySelector('select[data-action="update-rack"]');

                const quantity = parseInt(quantityInput.value) || 0;
                const rackId = rackSelect ? rackSelect.value : null;

                if (quantity > 0 && rackId) {
                    itemData.breakdowns.push({
                        id_gudang_in: 10, // Default warehouse
                        id_ruang_simpan_in: parseInt(rackId),
                        id_barang_varian_in: item.id_barang_varian,
                        qty_masuk_in: quantity,
                        harga_beli_in: item.discounted_price || item.base_price,
                        asal_barang_dari: "Master",
                        asal_from_data_varian: "Api"
                    });
                }
            });

            newReceivingData.items.push(itemData);

            console.log('New receiving data to send:', newReceivingData);

            // Send to backend
            const response = await this.sendNewReceivingToBackend(newReceivingData);

            if (response.success) {
                // Update local data dengan response dari backend
                this.receivings.push(response.data.receiving);

                return {
                    success: true,
                    message: 'Penerimaan berhasil disimpan'
                };
            } else {
                throw new Error(response.message || 'Gagal menyimpan penerimaan baru');
            }

        } catch (error) {
            console.error('Error saving new receiving:', error);
            return {
                success: false,
                message: error.message
            };
        }
    }

    // Method untuk delete receiving dengan backend (support multiple)
    async deleteReceivingData(receivingId, detailId) {
        try {
            if (!receivingId) {
                throw new Error('Receiving ID tidak ditemukan');
            }

            const deleteData = {
                receiving_id: receivingId,
                detail_id: detailId,
                id_order: this.po.id
            };

            console.log('Delete data to send:', deleteData);

            const response = await this.sendDeleteToBackend(deleteData, receivingId, detailId);

            if (response.success) {
                // Remove from local data
                this.receivings = this.receivings.filter(receiving => receiving.id !== receivingId);

                return {
                    success: true,
                    message: 'Data penerimaan berhasil dihapus'
                };
            } else {
                throw new Error(response.message || 'Gagal menghapus data penerimaan');
            }

        } catch (error) {
            console.error('Error deleting receiving:', error);
            return {
                success: false,
                message: error.message
            };
        }
    }
    // Method untuk cancel edit
    cancelEdit(barcode) {
        this.initReceivingItems("po");
    }

    // Method untuk save new receiving
    saveNewReceiving(barcode) {
        if (!this.validateReceiving(barcode)) {
            return;
        }

        // Simpan data receivings baru
        this.saveNewReceivingData(barcode);

        // Refresh tampilan
        this.refreshReceivingView(barcode);

        alert('Penerimaan berhasil disimpan!');
    }

    // Method untuk refresh view
    refreshReceivingView(barcode, receivingId, detailId) {
        const item = this.po.items.find(item => item.barcode === barcode);
        const receivingItem = this.receivings.find(receiving =>
            receiving.items.some(receivingItem =>
                receivingItem.erp__pos__utama__detail_id == item.id_detail
            )
        );

        const receivingDetail = receivingItem ?
            receivingItem.items.find(ri => ri.erp__pos__utama__detail_id == item.id_detail) :
            null;

        const receivingControls = document.querySelector(`.receiving-item[data-barcode="${barcode}"] .receiving-controls`);
        if (receivingControls) {
            if (receivingDetail && receivingDetail.breakdown && receivingDetail.breakdown.length > 0) {
                receivingControls.innerHTML = this.renderExistingReceivingView(item, receivingDetail);
            } else {
                receivingControls.innerHTML = this.renderEmptyReceivingForm(item);
            }
        }

        // Update stats
        this.updateReceivingStats(barcode, receivingId, detailId);
    }

    // Method untuk validasi receiving
    validateReceiving(barcode, receivingId = null) {
        const containerId = receivingId ? `entries-${barcode}-${receivingId}` : `entries-${barcode}`;
        const entriesContainer = document.getElementById(containerId);
        const quantityInputs = entriesContainer.querySelectorAll('input[data-action="update-quantity"]');

        let totalQuantity = 0;
        let hasErrors = false;

        quantityInputs.forEach((input, index) => {
            const quantity = parseInt(input.value) || 0;
            const rackSelect = input.closest('.receiving-entry').querySelector('select[data-action="update-rack"]');
            const rackId = rackSelect ? rackSelect.value : '';

            if (quantity <= 0) {
                alert(`Jumlah pada entry ${index + 1} harus lebih dari 0`);
                hasErrors = true;
                return;
            }

            if (!rackId) {
                alert(`Rak pada entry ${index + 1} harus dipilih`);
                hasErrors = true;
                return;
            }

            totalQuantity += quantity;
        });

        if (hasErrors) return false;

        const item = this.po.items.find(item => item.barcode === barcode);

        // Hitung total dari receiving lainnya (kecuali yang sedang diedit)
        const otherReceivingTotal = this.calculateOtherReceivingTotal(item.id_detail, receivingId);

        if (totalQuantity + otherReceivingTotal > item.quantity) {
            alert(`Total jumlah (${totalQuantity}) + sudah diterima di penerimaan lain (${otherReceivingTotal}) = ${totalQuantity + otherReceivingTotal} melebihi jumlah yang dipesan (${item.quantity})`);
            return false;
        }

        return true;
    }
    calculateOtherReceivingTotal(itemDetailId, excludeReceivingId = null) {
        let total = 0;
        this.receivings.forEach(receiving => {
            // Skip jika ini adalah receiving yang sedang diedit
            if (excludeReceivingId && receiving.id == excludeReceivingId) {
                return;
            }
            receiving.items.forEach(item => {
                if (item.erp__pos__utama__detail_id == itemDetailId && item.breakdown) {
                    total += item.breakdown.reduce((sum, breakdown) => sum + breakdown.qty_masuk_in, 0);
                }
            });
        });
        return total;
    }
    addNewRackEntry(barcode) {
        const entriesContainer = document.getElementById(`entries-${barcode}`);
        if (!entriesContainer) return;

        const item = this.po.items.find(item => item.barcode === barcode);
        if (!item) return;

        const currentEntries = entriesContainer.querySelectorAll('.receiving-entry');
        const newIndex = currentEntries.length;

        const newEntryHTML = this.renderReceivingEntry(item, newIndex);
        entriesContainer.insertAdjacentHTML('beforeend', newEntryHTML);

        // Update stats
        this.updateReceivingStats(barcode);
    }

    // Method untuk menghapus entry
    removeEntry(barcode, index, breakdownId = null) {
        const entryElement = document.querySelector(`.receiving-entry[data-index="${index}"]`);
        if (!entryElement) return;

        // Jika ada breakdownId, hapus dari data
        if (breakdownId) {
            this.removeExistingBreakdown(breakdownId);
        }

        entryElement.remove();

        // Update stats dan reindex entries
        this.updateReceivingStats(barcode);
        this.reindexEntries(barcode);
    }

    // Method untuk menghapus existing breakdown
    removeExistingBreakdown(breakdownId) {
        this.receivings.forEach(receiving => {
            receiving.items.forEach(item => {
                item.breakdown = item.breakdown.filter(b => b.id != breakdownId);
            });
        });
    }

    // Method untuk reindex entries setelah penghapusan
    reindexEntries(barcode) {
        const entriesContainer = document.getElementById(`entries-${barcode}`);
        if (!entriesContainer) return;

        const entries = entriesContainer.querySelectorAll('.receiving-entry');
        entries.forEach((entry, newIndex) => {
            entry.setAttribute('data-index', newIndex);

            // Update semua attributes di dalam entry
            const inputs = entry.querySelectorAll('[data-index]');
            inputs.forEach(input => {
                input.setAttribute('data-index', newIndex);
            });

            // Update preview ID
            const preview = entry.querySelector('.entry-preview');
            if (preview) {
                preview.id = `preview-${barcode}-${newIndex}`;
            }
        });
    }
    // renderReceivingEntry(item, index, quantity = 0, rackId = null) {
    //     const remaining = item.quantity - (item.received || 0);
    //     const maxQuantity = remaining - this.getTotalPendingQuantity(item.barcode, index);

    //     return `
    //     <div class="receiving-entry" data-index="${index}">
    //         <div class="entry-controls">
    //             <div class="receiving-quantity">
    //                 <label>Jumlah:</label>
    //                 <input type="number" 
    //                        value="${quantity}" 
    //                        min="0" 
    //                        max="${maxQuantity}"
    //                        data-action="update-quantity"
    //                        data-barcode="${item.barcode}"
    //                        data-index="${index}">
    //             </div>
    //             <div class="receiving-rack">
    //                 <label>Rak:</label>
    //                 <select data-action="update-rack"
    //                         data-barcode="${item.barcode}"
    //                         data-index="${index}">
    //                     <option value="">Pilih Rak</option>
    //                     ${this.warehouseRacks.map(rack => `
    //                         <option value="${rack.id}" ${rackId == rack.id ? 'selected' : ''}>
    //                             ${rack.name} (Kapasitas: ${rack.capacity})
    //                         </option>
    //                     `).join('')}
    //                 </select>
    //             </div>
    //             ${index > 0 ? `
    //                 <button type="button" class="btn btn-sm btn-danger remove-entry" 
    //                         data-action="remove-entry"
    //                         data-barcode="${item.barcode}"
    //                         data-index="${index}">
    //                     <i class="fas fa-times"></i>
    //                 </button>
    //             ` : ''}
    //         </div>
    //         <div class="entry-preview" id="preview-${item.barcode}-${index}">
    //             ${this.getEntryPreview(item.barcode, index)}
    //         </div>
    //     </div>
    // `;
    // }

    // addMoreRack(barcode, mode) {
    //     const entriesContainer = document.getElementById(`entries-${barcode}`);
    //     let item;
    //     if (mode == 'po') {

    //         item = this.getPOItemByBarcode(barcode);

    //     } else {
    //         item = this.scannedProducts.findIndex(item => item.barcode === barcode);
    //     }

    //     const currentEntries = entriesContainer.querySelectorAll('.receiving-entry').length;
    //     const newEntry = this.renderReceivingEntry(item, currentEntries);
    //     console.log(newEntry);
    //     entriesContainer.insertAdjacentHTML('beforeend', newEntry);

    //     // Update max quantities for all entries
    //     this.updateAllMaxQuantities(barcode);
    // }

    // removeReceivingEntry(barcode, index) {
    //     const entry = document.querySelector(`.receiving-entry[data-index="${index}"]`);
    //     if (entry) {
    //         entry.remove();
    //         // Renumber remaining entries
    //         this.renumberEntries(barcode);
    //         this.updateAllMaxQuantities(barcode);
    //     }
    // }
    // renumberEntries(barcode) {
    //     const entriesContainer = document.getElementById(`entries-${barcode}`);
    //     const entries = entriesContainer.querySelectorAll('.receiving-entry');

    //     entries.forEach((entry, newIndex) => {
    //         entry.setAttribute('data-index', newIndex);

    //         // Update data attributes untuk semua elements dalam entry
    //         const quantityInput = entry.querySelector('[data-action="update-quantity"]');
    //         const rackSelect = entry.querySelector('[data-action="update-rack"]');
    //         const removeBtn = entry.querySelector('[data-action="remove-entry"]');

    //         if (quantityInput) {
    //             quantityInput.setAttribute('data-index', newIndex);
    //         }
    //         if (rackSelect) {
    //             rackSelect.setAttribute('data-index', newIndex);
    //         }
    //         if (removeBtn) {
    //             removeBtn.setAttribute('data-index', newIndex);
    //         }
    //     });
    // }

    // Track pending quantities untuk validasi


    // updatePendingQuantity(barcode, index, quantity) {
    //     if (!this.pendingReceiving[barcode]) {
    //         this.pendingReceiving[barcode] = [];
    //     }

    //     this.pendingReceiving[barcode][index] = {
    //         ...this.pendingReceiving[barcode][index],
    //         quantity: parseInt(quantity) || 0
    //     };

    //     this.updateEntryPreview(barcode, index);
    //     this.updateAllMaxQuantities(barcode);
    // }

    // updatePendingRack(barcode, index, rackId) {
    //     if (!this.pendingReceiving[barcode]) {
    //         this.pendingReceiving[barcode] = [];
    //     }

    //     this.pendingReceiving[barcode][index] = {
    //         ...this.pendingReceiving[barcode][index],
    //         rackId: rackId ? parseInt(rackId) : null
    //     };

    //     this.updateEntryPreview(barcode, index);
    // }

    // getTotalPendingQuantity(barcode, excludeIndex = null) {
    //     if (!this.pendingReceiving[barcode]) return 0;

    //     return this.pendingReceiving[barcode].reduce((total, entry, index) => {
    //         if (excludeIndex !== null && index === excludeIndex) return total;
    //         return total + (entry.quantity || 0);
    //     }, 0);
    // }

    // updateAllMaxQuantities(barcode) {
    //     const item = this.getPOItemByBarcode(barcode);
    //     if (!item) return;

    //     const remaining = item.quantity - (item.received || 0);
    //     const entries = document.querySelectorAll(`#entries-${barcode} .receiving-entry`);

    //     entries.forEach((entry, index) => {
    //         const quantityInput = entry.querySelector('input[type="number"]');
    //         const otherQuantities = this.getTotalPendingQuantity(barcode, index);
    //         const maxQuantity = remaining - otherQuantities;

    //         quantityInput.max = Math.max(0, maxQuantity);

    //         // Jika current value melebihi max, adjust
    //         if (parseInt(quantityInput.value) > maxQuantity) {
    //             quantityInput.value = maxQuantity;
    //             this.updatePendingQuantity(barcode, index, maxQuantity);
    //         }
    //     });
    // }

    // updateEntryPreview(barcode, index) {
    //     const preview = document.getElementById(`preview-${barcode}-${index}`);
    //     const entry = this.pendingReceiving[barcode]?.[index];

    //     if (preview && entry) {
    //         const quantity = entry.quantity || 0;
    //         const rackName = entry.rackId ? this.getRackName(entry.rackId) : 'Belum dipilih';

    //         preview.innerHTML = quantity > 0 ?
    //             `Akan diterima: ${quantity} item di ${rackName}` :
    //             'Belum diisi';
    //     }
    // }

    // getEntryPreview(barcode, index) {
    //     const entry = this.pendingReceiving[barcode]?.[index];
    //     if (!entry || !entry.quantity) return 'Belum diisi';

    //     const rackName = entry.rackId ? this.getRackName(entry.rackId) : 'Belum dipilih';
    //     return `Akan diterima: ${entry.quantity} item di ${rackName}`;
    // }

    getPOItemByBarcode(barcode) {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        return po?.items.find(item => item.barcode === barcode);
    }


    // Utility Methods
    truncateText(text, maxLength) {
        if (!text) return '';
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    }
    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    parseCurrency(currencyString) {
        return parseInt(currencyString.replace(/[^\d]/g, ''));
    }

    formatDate(dateString) {
        return new Date(dateString).toLocaleDateString('id-ID');
    }

    getStatusClass(status) {
        const classes = {
            'draft': 'status-draft',
            'ordered': 'status-ordered',
            'shipped': 'status-shipped',
            'receiving': 'status-received',
            'partial': 'status-partial',
            'sebagian': 'status-partial',
            'cancelled': 'status-cancelled',
            'proses': 'status-ordered',
            'diproses': 'status-ordered',
            'selesai': 'status-received',
            'lunas': 'status-received',
        };
        return classes[status] || 'status-draft';
    }

    getStatusText(status) {
        const texts = {
            'draft': 'Draft',
            'ordered': 'Dipesan',
            'shipped': 'Dikirim',
            'receiving': 'Diterima',
            'partial': 'Parsial',
            'cancelled': 'Dibatalkan',
            "proses": "Diproses",
            "diproses": "Diproses",
            "lunas": "Lunas",
            "sebagian": "Lunas Sebagian",
            "selesai": "Selesai"

        };
        return texts[status] || 'Draft';
    }


    updateStats() {
        document.getElementById('totalPos').textContent = this.filteredPurchaseOrders.length;
        document.getElementById('draftPos').textContent = this.filteredPurchaseOrders.filter(p => p.status === 'draft').length;
        document.getElementById('orderedPos').textContent = this.filteredPurchaseOrders.filter(p => p.status === 'ordered').length;
        document.getElementById('receivedPos').textContent = this.filteredPurchaseOrders.filter(p => p.status === 'received').length;
    }

    renderWarehouseRacks() {
        // Implementation for warehouse racks display
    }
    async processPayment() {
        setButtonLoading(markAsPaidBtn, true);

        try {
            const response = await markAsPaidBackend();

            // Simpan data pembayaran
            paymentData.isPaid = true;
            paymentData.paymentDetails = {
                invoiceNumber: document.getElementById('invoiceNumber').textContent,
                amount: document.getElementById('paymentTotal').textContent,
                paymentDate: paymentDate.value,
                coa: coaSelect.options[coaSelect.selectedIndex].text,
                method: paymentMethod.options[paymentMethod.selectedIndex].text,
                brand: paymentBrand.options[paymentBrand.selectedIndex].text
            };

            updateViewBasedOnStatus();

            showAlert('Pembayaran berhasil ditandai sebagai sudah dibayar!', 'success');

        } catch (error) {
            showAlert('Gagal menandai pembayaran: ' + error.message, 'error');
        } finally {
            setButtonLoading(markAsPaidBtn, false);
        }
    }

    showEditItemModal(index) {
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        const item = po.items[index];

        // Isi form dengan data item yang akan diedit
        document.getElementById('editItemIndex').value = index;
        document.getElementById('editProductName').textContent = item.name || 'Nama Produk';
        document.getElementById('editQuantity').value = item.quantity || 0;
        document.getElementById('editBasePrice').value = item.base_price || 0;
        document.getElementById('editDiscount').value = item.purchase_discount || 0;
        document.getElementById('editSellingPrice').value = item.selling_price || 0;
        document.getElementById('editRack').value = item.rack_id || 1;

        // Tampilkan modal edit
        document.getElementById('editItemModal').style.display = 'flex';
    }

    // Fungsi untuk menyembunyikan modal edit
    hideEditItemModal() {
        document.getElementById('editItemModal').style.display = 'none';
    }
    async saveItemChanges() {
        const index = parseInt(document.getElementById('editItemIndex').value);
        const name = document.getElementById('editProductName').textContent;
        const quantity = parseInt(document.getElementById('editQuantity').value);
        const basePrice = parseFloat(document.getElementById('editBasePrice').value);
        const discount = parseFloat(document.getElementById('editDiscount').value);
        const sellingPrice = parseFloat(document.getElementById('editSellingPrice').value);
        // const rackId = parseInt(document.getElementById('editRack').value);

        // Hitung harga setelah diskon
        const discountedPrice = basePrice - (basePrice * discount / 100);
        const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
        const item = po.items[index];
        // Update item
        const data = {

            name,
            quantity,
            base_price: basePrice,
            purchase_discount: discount,
            discounted_price: discountedPrice,
            selling_price: sellingPrice,
            id_erp__pos__utama: item.id_erp__pos__utama,
            id_detail: item.id_detail,
            id_erp__pos__group: item.id_erp__pos__group,
            // rack_id: rackId
        };

        // Sembunyikan modal edit
        // this.hideEditModal();



        // Simpan ke backend (simulasi)
        await this.SendItemsToBackend(data, "update_items");

        this.showAlert('success', 'Item berhasil diperbarui!');
        this.showNotification('Item berhasil diperbarui!', 'success');
    }
    async deleteItem() {
        if (this.itemToDelete !== null) {
            const po = this.filteredPurchaseOrders.find(p => p.id === this.currentPoId);
            const item = po.items[this.itemToDelete];

            // Simpan ke backend (simulasi)
            await this.SendItemsToBackend(item, "delete_items");
            // this.po.items.splice(this.itemToDelete, 1);
            this.hideDeleteModal();
            // this.renderItems();
            this.showAlert('success', 'Item berhasil dihapus!');
        }
    }
    parsePO(po) {
        return {
            ...po,
            items: (typeof po.items === "string" ? JSON.parse(po.items) : po.items || []).map(item => ({
                ...item,
                productId: item.id_detail,
                base_price: item.harga_penjualan,
                name: item.nama_varian || item.nama_barang,
                quantity: item.qty,
                barcode: item.barcode,
                purchase_discount: item.diskon_utama,
                discounted_price: item.total_diskon,
                selling_price: item.grand_total,
            }))
        };
    }
    async SendItemsToBackend(data, endpoint) {
        try {
            // Simulasi API call


            // Contoh implementasi API nyata:
            const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
            const response = await fetch('/api/purchase_orders', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    "endpoint": endpoint,
                    "curentpoid": this.currentPoId,
                    "po": po.id_utama,
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Gagal menyimpan data');
            }

            let res = await response.json();
            const updatedPo = this.parsePO(res.data);
            this.PurchaseOrders = this.PurchaseOrders.map(po =>
                po.id === this.currentPoId ? updatedPo : po
            );
            this.filteredPurchaseOrders = this.filteredPurchaseOrders.map(po =>
                po.id === this.currentPoId ? updatedPo : po
            );

            this.populatePoDetail();
            setTimeout(() => {
                this.hideEditItemModal();
                this.hideDeleteModal();
                this.swicthTab('items');
            }, 200);

        } catch (error) {
            console.error('Error menyimpan data:', error);
            this.showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
    showDeleteModal(index) {
        this.itemToDelete = index;
        document.getElementById('deleteItemModal').style.display = 'flex';
    }

    // Fungsi untuk menyembunyikan modal hapus
    hideDeleteModal() {
        document.getElementById('deleteItemModal').style.display = 'none';
        this.itemToDelete = null;
    }
    swicthTab(tabName) {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));


        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        const tabContent = document.getElementById(`tab-${tabName}`);
        if (tabContent) {
            tabContent.classList.add('active');
        }
    }
    resetViewProduct() {
        document.getElementById('addPoScanView').innerHTML = this.renderScanView("add");
        document.getElementById('addPoConfirmView').innerHTML = this.renderConfirmView("add");
        document.getElementById('addPoDetailView').innerHTML = this.renderDetailView("add");
        document.getElementById('tab-tambah-items').innerHTML = "";
        document.getElementById('tab-confirm-items').innerHTML = "";
        document.getElementById('tab-harga-items').innerHTML = "";
        this.setupSetupaddProductEventListeners()
    }
    tambahItems() {
        document.getElementById('addPoScanView').innerHTML = "";
        document.getElementById('addPoConfirmView').innerHTML = "";
        document.getElementById('addPoDetailView').innerHTML = "";
        document.getElementById('tab-tambah-items').innerHTML = this.renderScanView("items");
        document.getElementById('tab-confirm-items').innerHTML = this.renderConfirmView("items");
        document.getElementById('tab-harga-items').innerHTML = this.renderDetailView("items");
        let tabName = 'tambah-items';
        this.swicthTab(tabName);
        this.setupSetupaddProductEventListeners()
    }
    // Event Listeners
    setupPOListEventListeners() {

        document.getElementById('poItemsList').addEventListener('click', (e) => {
            const target = e.target;

            if (target.matches('[data-action="edit-item"]')) {
                const row = target.closest('tr');
                const index = parseInt(row.dataset.itemIndex);
                this.showEditItemModal(index);
            }

            if (target.matches('[data-action="delete-item"]')) {
                const row = target.closest('tr');
                const index = parseInt(row.dataset.itemIndex);
                this.showDeleteModal(index);
            }
        });

        // Form edit item
        document.getElementById('itemEditForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveItemChanges();
        });

        // Tombol batal edit
        document.getElementById('cancelEdit').addEventListener('click', () => {
            this.hideEditItemModal();
        });

        // Tombol konfirmasi hapus
        document.getElementById('confirmDelete').addEventListener('click', () => {
            this.deleteItem();
        });

        // Tombol batal hapus
        document.getElementById('cancelDelete').addEventListener('click', () => {
            this.hideDeleteModal();
        });

        // Tombol kembali
        // document.getElementById('backButton').addEventListener('click', () => {
        //     window.history.back();
        // });

        // Event untuk menutup modal saat klik di luar konten
        document.addEventListener('click', (e) => {
            if (e.target.id === 'editItemModal') {
                this.hideEditModal();
            }
            if (e.target.id === 'deleteItemModal') {
                this.hideDeleteModal();
            }
        });

        // // Tab navigation
        // document.querySelectorAll('.tab-button').forEach(button => {
        //     button.addEventListener('click', () => {
        //         const tabId = button.getAttribute('data-tab');
        //         this.switchTab(tabId);
        //     });
        // });

        // // Scanner controls
        // document.getElementById('startCamera').addEventListener('click', () => {
        //     this.startCamera();
        // });

        // document.getElementById('stopCamera').addEventListener('click', () => {
        //     this.stopCamera();
        // });

        // document.getElementById('addManualBarcode').addEventListener('click', () => {
        //     this.addManualBarcode();
        // });

        // // Product search
        // document.getElementById('productSearch').addEventListener('input', (e) => {
        //     this.searchProducts(e.target.value);
        // });
    }
    setupSetupaddProductEventListeners() {
        this.delegateEvent('input', '[data-action="product-search"]', (e) => {
            // Real-time search dengan debounce
            clearTimeout(this.searchTimeout);
            const query = e.target.value.trim();

            if (query.length === 0) {
                // Jika search dikosongkan, tetap tampilkan placeholder
                const resultsContainer = document.getElementById('productSearchResults');
                if (resultsContainer) {
                    resultsContainer.innerHTML = `
                <div class="search-placeholder">
                    <i class="fas fa-box-open"></i>
                    <p>Klik "Semua Produk" untuk melihat daftar produk</p>
                </div>
            `;
                }
                return;
            }

            this.searchTimeout = setTimeout(() => {
                if (query.length >= 2) {
                    this.searchProducts(query);
                }
            }, 500);
        });
        this.delegateEvent('input', '[data-action="product-search"]', (e) => {
            // Real-time search dengan debounce
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                const query = e.target.value.trim();
                if (query.length >= 2) {
                    this.searchProducts(query);
                }
            }, 500);
        });

        this.delegateEvent('click', '[data-action="search-product"]', (e) => {
            const input = document.getElementById('productSearchInput');
            const query = input.value.trim();
            this.searchProducts(query);
        });

        this.delegateEvent('click', '[data-action="add-product"]', (e) => {
            const button = e.target.closest('[data-action="add-product"]');
            const barcode = button.getAttribute('data-barcode');
            this.processBarcode(barcode); // Reuse existing method
        });
        const startCameraBtn = document.getElementById('startCamera');
        const stopCameraBtn = document.getElementById('stopCamera');
        const addManualBtn = document.getElementById('addManualBarcode');

        if (startCameraBtn) {
            startCameraBtn.onclick = () => this.startCamera();
        }
        if (stopCameraBtn) {
            stopCameraBtn.onclick = () => this.stopCamera();
        }
        if (addManualBtn) {
            addManualBtn.onclick = () => {
                const barcode = document.getElementById('manualBarcode').value;
                if (barcode) {
                    console.log("masuk", barcode);
                    this.processBarcode(barcode);
                    document.getElementById('manualBarcode').value = '';
                }
            };
        }

        let debounceTimerManualBarcode = null;

        document.getElementById('manualBarcode').addEventListener('input', (e) => {
            const barcode = e.target.value.trim();

            clearTimeout(this.debounceTimerManualBarcode);

            this.debounceTimerManualBarcode = setTimeout(() => {
                if (barcode !== '') {
                    this.processBarcode(barcode);
                    e.target.value = '';
                }
            }, 800);
        });

        document.addEventListener('input', (e) => {
            // Price input change
            if (e.target.classList.contains('price-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductPrice(barcode, e.target.value);
            }

            // Discount input change
            if (e.target.classList.contains('discount-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductDiscount(barcode, e.target.value);
            }

            // Selling price input change
            if (e.target.classList.contains('selling-price-input')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateSellingPrice(barcode, e.target.value);
            }
        });

        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('rack-select')) {
                const barcode = e.target.getAttribute('data-barcode');
                this.updateProductRack(barcode, e.target.value);
            }
        });
    }
    setupEventListeners() {
        console.log('🔧 Setting up event listeners...');

        // HAPUS semua event listener lama
        this.removeEventListeners();
        this.setupSetupaddProductEventListeners();
        // Gunakan event delegation untuk element yang dynamic
        this.delegateEvent('click', '#addPoBtn', () => {
            this.showView('addPoTypeView');
        });

        this.delegateEvent('click', '#backToPoList', () => {
            this.showView('poListView');
            this.resetViewProduct();
        });

        this.delegateEvent('click', '#backToPoListFromType', () => {
            this.showView('poListView');
        });

        this.delegateEvent('click', '#backToTypeFromScan', () => {
            if (document.getElementById("typeScanView").value == 'add')
                this.showView('addPoTypeView');
            else
                this.swicthTab("items");
        });
        this.delegateEvent('click', '#backToScanBtn', () => {
            if (document.getElementById("typeScanView").value == 'add')
                this.showView('addPoTypeView');
            else
                this.swicthTab("items");
        });

        this.delegateEvent('click', '#backToScanFromConfirm', () => {
            if (document.getElementById("modeConfirmView").value == 'add')
                this.showView('addPoScanView');
            else
                this.swicthTab("tambah-items");
        });

        this.delegateEvent('click', '#backToConfirmFromDetail', () => {
            this.showView('addPoConfirmView');
        });

        this.delegateEvent('click', '#backToDetailFromEdit', () => {
            this.showView('poDetailView');
        });
        this.delegateEvent('click', '#proceedToScan', () => {
            if (!this.selectedSupplier) {
                // this.showNotification('Purchase Order berhasil disimpan!', 'success');
                this.showNotification('Pilih supplier terlebih dahulu!', 'error');
                return;
            }
            this.showView('addPoScanView');
        });

        this.delegateEvent('click', '#proceedToConfirm', () => {
            alert
            if (this.scannedProducts.length === 0) {
                this.showNotification('Scan minimal satu produk terlebih dahulu!', 'error');

                return;
            }
            if (document.getElementById('typeScanView').dataset.mode == 'add') {

                this.showView('addPoConfirmView');
            } else {
                this.swicthTab("confirm-items");
            }
            this.renderProductConfirmation();
        });
        console.log('🔧 Setting up event listeners. proceedToDetail..');

        this.delegateEvent('click', '#proceedToDetail', () => {
            if (!this.scannedProducts.length) {
                alert('Barang minimal satu produk terlebih dahulu!');
                return;
            }
            console.log(document.getElementById("modeConfirmView").dataset.mode);
            if (document.getElementById("modeConfirmView").dataset.mode == 'add')
                this.showView('addPoDetailView');
            else
                this.swicthTab("harga-items");
            this.renderProductDetails();
        });
        this.delegateEvent('click', '#proceedToPenerimaan', () => {
            this.showView('addDetailReceive');
            this.initReceivingItems("save");
        });

        this.delegateEvent('click', '#savePo', () => {
            if (document.getElementById("modeConfirmView").dataset.mode == 'add')
                this.savePurchaseOrder();
            else
                this.SendItemsToBackend({ "items": this.scannedProducts }, "tambah_items");
            this.resetViewProduct();
        });
        this.delegateEvent('click', '#savePoReceive', async () => {
            let total_received = await this.completeReceiving("hitung");
            if (!total_received) {
                this.showNotification('Tidak ada barang yang diterima!', 'error');
                return;
            }

            await this.savePurchaseOrder();
            this.resetPOData();
            this.showView('poListView');
            this.showNotification('Purchase Order dan Penerimaan Berhasil!', 'success');
            this.renderPoList();
            this.updateStats();
        });


        // PO Type Selection
        this.delegateEvent('click', '.po-type-card', (e) => {
            const card = e.target.closest('.po-type-card');
            document.querySelectorAll('.po-type-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');

            this.selectedPoType = card.dataset.type;
            document.getElementById('selectedPoType').value = this.selectedPoType;
            document.getElementById('supplierSelection').style.display = 'block';

            const proceedBtn = document.getElementById('proceedToScan');
            if (proceedBtn) proceedBtn.disabled = false;

            this.filterSuppliersByType(this.selectedPoType);
        });
        // this.delegateEvent('click', '[data-action="add-more-rack-po"]', (e) => {
        //     const button = e.target.closest('[data-action="add-more-rack-po"]');
        //     const barcode = button.getAttribute('data-barcode');
        //     this.addMoreRack(barcode, 'po');
        // });
        // this.delegateEvent('click', '[data-action="add-more-rack-save"]', (e) => {

        //     const button = e.target.closest('[data-action="add-more-rack-save"]');
        //     const barcode = button.getAttribute('data-barcode');
        //     this.addMoreRack(barcode, 'save');
        // });
        // Di setupEventListeners(), tambahkan event listeners untuk input changes:
        // Di dalam setupEventListeners, tambahkan:
        this.delegateEvent('click', '[data-action="tambah-item"]', (e) => {
            // Load semua produk tanpa filter
            this.tambahItems();
        });

        this.delegateEvent('click', '[data-action="show-all-products"]', (e) => {
            // Load semua produk tanpa filter
            this.searchProducts('', 1, 20);
        });

        this.delegateEvent('input', '[data-action="product-search"]', (e) => {
            // Real-time search dengan debounce
            clearTimeout(this.searchTimeout);
            const query = e.target.value.trim();

            if (query.length === 0) {
                // Jika search dikosongkan, tetap tampilkan placeholder
                const resultsContainer = document.getElementById('productSearchResults');
                if (resultsContainer) {
                    resultsContainer.innerHTML = `
                <div class="search-placeholder">
                    <i class="fas fa-box-open"></i>
                    <p>Klik "Semua Produk" untuk melihat daftar produk</p>
                </div>
            `;
                }
                return;
            }

            this.searchTimeout = setTimeout(() => {
                if (query.length >= 2) {
                    this.searchProducts(query);
                }
            }, 500);
        });

        document.addEventListener('click', (e) => {
            // Edit receiving dengan id_receive
            if (e.target.matches('.edit-receiving') || e.target.closest('.edit-receiving')) {
                const button = e.target.matches('.edit-receiving') ? e.target : e.target.closest('.edit-receiving');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.editReceiving(barcode, receivingId, detailId);
            }

            // Delete receiving dengan id_receive
            if (e.target.matches('.delete-receiving') || e.target.closest('.delete-receiving')) {
                const button = e.target.matches('.delete-receiving') ? e.target : e.target.closest('.delete-receiving');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.deleteReceiving(barcode, receivingId, detailId);
            }

            // Add more items dengan id_receive
            if (e.target.matches('.add-more-items') || e.target.closest('.add-more-items')) {
                const button = e.target.matches('.add-more-items') ? e.target : e.target.closest('.add-more-items');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.addMoreItems(barcode, receivingId, detailId);
            }

            // Save edit dengan id_receive
            if (e.target.matches('.save-edit') || e.target.closest('.save-edit')) {
                const button = e.target.matches('.save-edit') ? e.target : e.target.closest('.save-edit');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.saveEdit(barcode, receivingId, detailId);
            }

            // Cancel edit dengan id_receive
            if (e.target.matches('.cancel-edit') || e.target.closest('.cancel-edit')) {
                const button = e.target.matches('.cancel-edit') ? e.target : e.target.closest('.cancel-edit');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.cancelEdit(barcode, receivingId, detailId);
            }

            // Save new receiving dengan id_receive
            if (e.target.matches('.save-receiving') || e.target.closest('.save-receiving')) {
                const button = e.target.matches('.save-receiving') ? e.target : e.target.closest('.save-receiving');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.saveNewReceiving(barcode, receivingId, detailId);
            }

            // Add more rack dengan id_receive
            if (e.target.matches('.add-more-rack') || e.target.closest('.add-more-rack')) {
                const button = e.target.matches('.add-more-rack') ? e.target : e.target.closest('.add-more-rack');
                const barcode = button.getAttribute('data-barcode');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.addNewRackEntry(barcode, receivingId, detailId);
            }

            // Remove entry dengan id_receive
            if (e.target.matches('.remove-entry') || e.target.closest('.remove-entry')) {
                const button = e.target.matches('.remove-entry') ? e.target : e.target.closest('.remove-entry');
                const barcode = button.getAttribute('data-barcode');
                const index = button.getAttribute('data-index');
                const breakdownId = button.getAttribute('data-breakdown-id');
                const receivingId = button.getAttribute('data-receiving-id');
                const detailId = button.getAttribute('data-detail-id');
                this.removeEntry(barcode, index, breakdownId, receivingId, detailId);
            }

            // Add new receiving
            if (e.target.matches('.add-new-receiving') || e.target.closest('.add-new-receiving')) {
                const button = e.target.matches('.add-new-receiving') ? e.target : e.target.closest('.add-new-receiving');
                const barcode = button.getAttribute('data-barcode');
                this.addNewReceiving(barcode);
            }
        });
        document.addEventListener('input', (e) => {
            if (e.target.matches('input[data-action="update-quantity"]')) {
                const barcode = e.target.getAttribute('data-barcode');
                const index = e.target.getAttribute('data-index');
                const breakdownId = e.target.getAttribute('data-breakdown-id');
                const value = e.target.value;

                this.updateQuantityHandler(barcode, index, value, breakdownId);
            }
        });

        document.addEventListener('change', (e) => {
            if (e.target.matches('select[data-action="update-rack"]')) {
                const barcode = e.target.getAttribute('data-barcode');
                const index = e.target.getAttribute('data-index');

                const previewElement = document.getElementById(`preview-${barcode}-${index}`);
                if (previewElement) {
                    previewElement.innerHTML = this.getEntryPreview(barcode, index);
                }
            }
        });

        document.addEventListener('click', (e) => {
            if (e.target.matches('.add-more-rack') || e.target.closest('.add-more-rack')) {
                const button = e.target.matches('.add-more-rack') ? e.target : e.target.closest('.add-more-rack');
                const barcode = button.getAttribute('data-barcode');

                this.addNewRackEntry(barcode);
            }

            if (e.target.matches('.remove-entry') || e.target.closest('.remove-entry')) {
                const button = e.target.matches('.remove-entry') ? e.target : e.target.closest('.remove-entry');
                const barcode = button.getAttribute('data-barcode');
                const index = button.getAttribute('data-index');
                const breakdownId = button.getAttribute('data-breakdown-id');

                this.removeEntry(barcode, index, breakdownId);
            }
        });

        this.delegateEvent('change', '#supplierSelect', (e) => {
            const supplierId = e.target.value;
            this.selectedSupplier = this.suppliers.find(s => s.id == supplierId);

            if (this.selectedSupplier) {
                const contactField = document.getElementById('supplierContact');
                const addressField = document.getElementById('supplierAddress');
                if (contactField) contactField.value = this.selectedSupplier.contact;
                if (addressField) addressField.value = this.selectedSupplier.address;
            }
        });
        this.delegateEvent('click', '#completeReceiving', () => {
            this.completeReceiving();
        });
        // Navigation between steps


        // Di setupEventListeners(), tambahkan:

        this.delegateEvent('click', '[data-action="prev-page"]', (e) => {
            const currentQuery = document.getElementById('productSearchInput').value;
            const currentPage = parseInt(e.target.closest('.pagination').dataset.currentPage || 1);
            this.searchProducts(currentQuery, currentPage - 1);
        });

        this.delegateEvent('click', '[data-action="next-page"]', (e) => {
            const currentQuery = document.getElementById('productSearchInput').value;
            const currentPage = parseInt(e.target.closest('.pagination').dataset.currentPage || 1);
            this.searchProducts(currentQuery, currentPage + 1);
        });

        this.delegateEvent('click', '#createReturn', () => {
            this.createReturn();
        });
        // Action buttons untuk PO list (FIX: gunakan class yang konsisten)
        this.delegateEvent('click', '.btn-view', (e) => {
            const button = e.target.closest('.btn-view');
            const poId = this.getPoIdFromButton(button);
            if (poId) this.viewPoDetail(poId);
        });

        this.delegateEvent('click', '.btn-edit', (e) => {
            const button = e.target.closest('.btn-edit');
            const poId = this.getPoIdFromButton(button);
            if (poId) this.editPo(poId);
        });

        this.delegateEvent('click', '.btn-receive', (e) => {
            const button = e.target.closest('.btn-receive');
            const poId = this.getPoIdFromButton(button);
            if (poId) this.receivePo(poId);
        });

        // Edit PO actions
        this.delegateEvent('click', '#saveEditPo', () => {
            this.saveEditPo();
        });

        this.delegateEvent('click', '#cancelEdit', () => {
            this.showView('poDetailView');
        });

        // Filter events
        this.delegateEvent('input', '#searchPo', () => this.filterPurchaseOrders());
        this.delegateEvent('change', '#statusFilter', () => this.filterPurchaseOrders());
        this.delegateEvent('change', '#startDate', () => this.filterPurchaseOrders());
        this.delegateEvent('change', '#endDate', () => this.filterPurchaseOrders());

        this.delegateEvent('click', '[data-action]', (e) => {
            const button = e.target.closest('[data-action]');
            const action = button.getAttribute('data-action');
            const poId = button.getAttribute('data-po-id');

            console.log(`🔘 Action: ${action}, PO: ${poId}`);

            switch (action) {
                case 'view':
                    this.viewPoDetail(poId);
                    break;
                case 'edit':
                    this.editPo(poId);
                    break;
                case 'delete':
                    this.deletePo(poId);
                    break;
                case 'receive':
                    this.receivePo(poId);
                    break;
            }
        });
        this.delegateEvent('click', '[data-view]', (e) => {
            const view = e.target.dataset.view;
            this.switchInventoryView(view);
        });

        this.delegateEvent('change', '#inventoryRackFilter', () => this.filterInventory());
        this.delegateEvent('input', '#inventorySearch', () => this.filterInventory());
        // Tab events
        this.delegateEvent('click', '.tab', (e) => {
            const tab = e.target.closest('.tab');
            const tabName = tab.getAttribute('data-tab');

            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            const tabContent = document.getElementById(`tab-${tabName}`);
            if (tabContent) {
                tabContent.classList.add('active');
            }
            if (tabName === 'returns') {
                setTimeout(() => {
                    this.renderReturnsList();
                }, 100);
            }
            if (tabName === 'payment') {
                this.initPaymentTab("po");
            }
            if (tabName === 'receiving') {
                this.initReceivingItems("po");
            }
            if (tabName === 'inventory') {
                setTimeout(() => {
                    this.renderInventoryViews();
                    this.setupInventoryViewToggle();
                }, 100);
            }
        });

        // Scanner events (static elements)

        /*
        document.addEventListener('blur', (e) => {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('selling-price-input')) {
                this.formatCurrencyInput(e.target);
            }
        });
        
        document.addEventListener('focus', (e) => {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('selling-price-input')) {
                this.parseCurrencyInput(e.target);
            }
        });*/
        console.log('✅ Event listeners setup complete');
    }

    // Helper method untuk mendapatkan PO ID dari button
    getPoIdFromButton(button) {
        if (!button) return null;

        // Cari row terdekat
        const row = button.closest('tr');
        if (!row) return null;

        // Cari PO ID di row
        const poIdElement = row.querySelector('.order-id');
        return poIdElement ? poIdElement.textContent : null;
    }

    // Method untuk remove event listeners lama
    removeEventListeners() {
        // Remove specific event listeners jika ada
        const elements = [
            'addPoBtn', 'backToPoList', 'backToPoListFromType',
            'proceedToScan', 'proceedToConfirm', 'proceedToDetail',
            'savePo', 'saveEditPo', 'cancelEdit'
        ];

        elements.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.replaceWith(element.cloneNode(true));
            }
        });
    }
    delegateEvent(event, selector, callback) {
        document.addEventListener(event, (e) => {
            if (e.target.matches(selector) || e.target.closest(selector)) {
                callback(e);
            }
        });
    }

    filterSuppliersByType(type) {
        const supplierSelect = document.getElementById('supplierSelect');
        const options = supplierSelect.querySelectorAll('option');

        options.forEach(option => {
            if (option.value === '') return;
            const show = option.dataset.type === type;
            option.style.display = show ? '' : 'none';
        });

        // Reset selection
        supplierSelect.value = '';
        document.getElementById('supplierContact').value = '';
        document.getElementById('supplierAddress').value = '';
        this.selectedSupplier = null;
    }

    getTypeText(type) {
        const texts = {
            'supplier': 'Supplier',
            'producer': 'Produsen',
            'cash': 'Pembelian Cash',
            'supermarket': 'Supermarket'
        };
        return texts[type] || 'Supplier';
    }
    filterPurchaseOrders() {
        const searchTerm = document.getElementById('searchPo').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        this.filteredPurchaseOrders = this.filteredPurchaseOrders.filter(po => {
            const matchesSearch = po.id.toLowerCase().includes(searchTerm) ||
                po.supplier.name.toLowerCase().includes(searchTerm);

            const matchesStatus = !statusFilter || po.status === statusFilter;

            let matchesDate = true;
            if (startDate) {
                matchesDate = po.date >= startDate;
            }
            if (endDate && matchesDate) {
                matchesDate = po.date <= endDate;
            }

            return matchesSearch && matchesStatus && matchesDate;
        });

        this.renderPoList();
    }
    async completeReceiving(getType = 'proccess') {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        if (getType == 'proccess') {
            if (!po) {
                alert('PO tidak ditemukan!');
                return;
            }
        }
        let stylecode;
        if (document.getElementById("modeConfirmView").dataset.mode == 'add') {
            stylecode = ".save";
        }
        // Ambil semua receiving inputs
        const receivingItems = document.querySelectorAll('.receiving-item' + stylecode);
        let totalReceived = 0;
        let hasReceiving = false;

        receivingItems.forEach(item => {
            const quantityInput = item.querySelector('input[type="number"]');
            const rackSelect = item.querySelector('select');
            const quantity = parseInt(quantityInput.value) || 0;

            if (quantity > 0) {
                hasReceiving = true;
                totalReceived += quantity;
            }
        });
        if (getType == 'proccess') {
            if (!hasReceiving) {
                alert('Tidak ada barang yang diterima!');
                return;
            }

            // Konfirmasi sebelum complete


            if (confirm(`Apakah Anda yakin menyelesaikan penerimaan?\nTotal barang diterima: ${totalReceived} item`)) {
                await this.processReceiving(po, receivingItems);

            }
        } else {
            return totalReceived;
        }
    }
    async processReceiving(po, receivingItems) {
        try {
            // Show loading
            let notif = this.showNotification('Memproses penerimaan barang...', 'loading');

            // Prepare receiving data
            const receivingData = this.prepareReceivingData(po, receivingItems);
            console.log(receivingData);
            // Validate data sebelum kirim
            const validationErrors = this.validateReceivingData(receivingData);
            if (validationErrors.length > 0) {
                this.showNotification(validationErrors.join('<br>'), 'error');
                return;
            }

            // Kirim ke backend
            const result = await this.sendReceivingToBackend(receivingData);

            if (result.success) {

                await this.handleReceivingSuccess(po, receivingData, result.data);
            } else {
                throw new Error(result.message || 'Gagal memproses penerimaan');
            }

        } catch (error) {
            console.error('Error processing receiving:', error);
            this.showNotification(`Error: ${error.message}`, 'error');
        }
    }
    // Tambahkan method ini:
    prepareReceivingData(po, receivingItems) {
        const receivingEntries = [];
        let totalReceived = 0;

        receivingItems.forEach(receivingItem => {
            const barcode = receivingItem.dataset.barcode;
            const entries = receivingItem.querySelectorAll('.receiving-entry.add');

            entries.forEach(entry => {

                const quantityInput = entry.querySelector('input[type="number"]');
                const rackSelect = entry.querySelector('select');
                const quantity = parseInt(quantityInput.value) || 0;
                const rackId = rackSelect.value ? parseInt(rackSelect.value) : null;
                console.log(quantity);
                console.log(rackId);
                if (quantity > 0) {
                    const poItem = po.items.find(i => i.barcode === barcode);
                    if (poItem) {
                        receivingEntries.push({
                            po_id: po.id,
                            po_item_id: poItem.productId,
                            product_barcode: barcode,
                            product_name: poItem.name,
                            quantity_received: quantity,
                            rack_id: rackId,
                            rack_name: this.getRackName(rackId),
                            unit_price: poItem.discounted_price,
                            total_value: quantity * poItem.discounted_price,
                            receiving_date: new Date().toISOString().split('T')[0],
                            received_by: "admin", // bisa diganti dengan user yang login
                            notes: "",
                            detail: poItem
                        });

                        totalReceived += quantity;
                    }
                }
            });
        });

        return {
            po_id: po.id,
            //supplier_id: po.supplier.id,
            receiving_number: `REC-${Date.now().toString().slice(-6)}`,
            receiving_date: new Date().toISOString().split('T')[0],
            total_items: receivingEntries.length,
            total_quantity: totalReceived,
            total_value: receivingEntries.reduce((sum, item) => sum + item.total_value, 0),
            entries: receivingEntries,
            status: "completed",
            created_by: "admin",
            created_at: new Date().toISOString()
        };
    }
    // Tambahkan method validasi:
    validateReceivingData(receivingData) {
        const errors = [];

        if (receivingData.entries.length === 0) {
            errors.push('Tidak ada barang yang akan diterima');
        }

        receivingData.entries.forEach((entry, index) => {
            if (!entry.rack_id) {
                errors.push(`Barang "${entry.product_name}" belum memiliki rak penyimpanan`);
            }

            if (entry.quantity_received <= 0) {
                errors.push(`Quantity barang "${entry.product_name}" harus lebih dari 0`);
            }

            // Validasi kapasitas rak
            const rack = this.warehouseRacks.find(r => r.id === entry.rack_id);
            if (rack) {
                const currentCapacity = this.getRackCurrentCapacity(rack.id);
                const newCapacity = currentCapacity + entry.quantity_received;

                if (newCapacity > rack.capacity) {
                    errors.push(`Rak ${rack.name} melebihi kapasitas. Kapasitas: ${rack.capacity}, Akan menjadi: ${newCapacity}`);
                }
            }
        });

        return errors;
    }

    // Method helper untuk mendapatkan kapasitas rak saat ini
    getRackCurrentCapacity(rackId) {
        let capacity = 0;

        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.receivingHistory) {
                    item.receivingHistory.forEach(receiving => {
                        if (receiving.rack_id === rackId) {
                            capacity += receiving.quantity;
                        }
                    });
                }
            });
        });

        return capacity;
    }
    // Tambahkan method untuk kirim ke backend:
    async sendReceivingToBackend(receivingData) {
        try {
            const response = await fetch(`${this.apiBaseUrl}/api/receivings`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // 'Authorization': 'Bearer ' + this.getAuthToken()
                },
                body: JSON.stringify(receivingData)
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }

            return await response.json();

        } catch (error) {
            console.error('Error sending receiving to backend:', error);

            // Fallback: save ke local storage
            return this.saveReceivingLocally(receivingData);
        }
    }

    // Fallback method
    saveReceivingLocally(receivingData) {
        return {
            success: true,
            data: {
                receiving_id: receivingData.receiving_number,
                id: Date.now().toString(),
                created_at: new Date().toISOString(),
                status: "completed"
            },
            message: "Penerimaan disimpan secara lokal (backend offline)"
        };
    }
    // Tambahkan method handle success:
    async handleReceivingSuccess(po, receivingData, backendData) {
        try {
            // Update local state dengan data dari receiving
            this.showReceivingSuccess(po, receivingData, backendData);
            this.initReceivingItems("po");
            // Update PO status

            // if (!po.history)
            //     po.history = [];
            // po.history.push({
            //     date: new Date().toISOString().split('T')[0],
            //     action: `Penerimaan barang diselesaikan - ${receivingData.total_quantity} item`,
            //     user: "Admin"
            // });

            // // Clear pending data
            // this.pendingReceiving = {};

            // // Update local arrays
            // this.filteredPurchaseOrders = [...this.PurchaseOrders];

            // Show success message


            // Refresh views
            // setTimeout(() => {
            //     this.renderPoList();
            //     this.showView('poDetailView');
            //     this.populatePoDetail();
            // }, 2000);

        } catch (error) {
            console.error('Error handling receiving success:', error);
            this.showNotification('Error update data lokal: ' + error.message, 'error');
        }
    }

    // Method untuk update inventory lokal
    updateLocalInventory(po, receivingEntry) {
        // Update item di PO
        const poItem = po.items.find(i => i.barcode === receivingEntry.product_barcode);
        if (poItem) {
            poItem.received = (poItem.received || 0) + receivingEntry.quantity_received;

            // Simpan history penerimaan
            if (!poItem.receivingHistory) {
                poItem.receivingHistory = [];
            }

            poItem.receivingHistory.push({
                receiving_id: receivingEntry.receiving_id,
                date: receivingEntry.receiving_date,
                quantity: receivingEntry.quantity_received,
                rack_id: receivingEntry.rack_id,
                rack_name: receivingEntry.rack_name
            });

            // Update stock di rak
            this.updateRackInventory(receivingEntry.rack_id, receivingEntry);
        }
    }

    // Update method updateRackInventory:
    updateRackInventory(rackId, receivingEntry) {
        if (!rackId) return;

        const rack = this.warehouseRacks.find(r => r.id === rackId);
        if (rack) {
            if (!rack.items) rack.items = [];

            // Cari item di rak
            const existingItem = rack.items.find(item => item.barcode === receivingEntry.product_barcode);
            if (existingItem) {
                existingItem.quantity += receivingEntry.quantity_received;
                existingItem.last_updated = new Date().toISOString().split('T')[0];
            } else {
                // Tambah item baru ke rak
                rack.items.push({
                    barcode: receivingEntry.product_barcode,
                    name: receivingEntry.product_name,
                    quantity: receivingEntry.quantity_received,
                    unit_price: receivingEntry.unit_price,
                    added_date: new Date().toISOString().split('T')[0],
                    last_updated: new Date().toISOString().split('T')[0],
                    po_id: receivingEntry.po_id
                });
            }
        }
    }
    updatePOStatusAfterReceiving(po) {
        const totalOrdered = po.items.reduce((sum, item) => sum + item.quantity, 0);
        const totalReceived = po.items.reduce((sum, item) => sum + (item.received || 0), 0);

        if (totalReceived === 0) {
            po.status = 'ordered';
        } else if (totalReceived === totalOrdered) {
            po.status = 'received';
        } else {
            po.status = 'partial';
        }
    }

    updateRackInve2ntory(rackId, barcode, quantity) {
        if (!rackId) return;

        const rack = this.warehouseRacks.find(r => r.id === rackId);
        if (rack) {
            // Cari item di rak
            const existingItem = rack.items.find(item => item.barcode === barcode);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                // Tambah item baru ke rak
                const product = this.findProductByBarcode(barcode);
                if (product) {
                    rack.items.push({
                        barcode: barcode,
                        name: product.name,
                        quantity: quantity,
                        added_date: new Date().toISOString().split('T')[0]
                    });
                }
            }
        }
    }

    findProductByBarcode(barcode) {
        for (const product of this.products) {
            if (product.barcode === barcode) return product;
            if (product.varian) {
                for (const variantId in product.varian) {
                    if (product.varian[variantId].barcode_varian === barcode) {
                        return {
                            id: product.varian[variantId].id_barang_varian,
                            name: product.varian[variantId].nama_varian
                        };
                    }
                }
            }
        }
        return null;
    }

    showReceivingSuccess(po, totalReceived) {
        // Show success notification
        const notification = `
        <div class="receiving-success" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        ">
            <i class="fas fa-check-circle"></i>
            <strong>Penerimaan Berhasil!</strong><br>
            ${totalReceived} item telah diterima untuk PO ${po.id}
        </div>
    `;
        this.showNotification('Penerimaan Berhasil!', 'success');
        // document.body.insertAdjacentHTML('beforeend', notification);

        // // Auto remove after 5 seconds
        // setTimeout(() => {
        //     const notif = document.querySelector('.receiving-success');
        //     if (notif) notif.remove();
        // }, 5000);

        // Kembali ke detail view
        // this.showView('poDetailView');
        // this.populatePoDetail();
    }
    getAllReceivingHistory() {
        const allReceiving = [];

        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.receivingHistory && item.receivingHistory.length > 0) {
                    item.receivingHistory.forEach(receiving => {
                        allReceiving.push({
                            po_id: po.id,
                            po_date: po.date,
                            supplier: po.supplier.name,
                            product_name: item.name,
                            barcode: item.barcode,
                            quantity: receiving.quantity,
                            rack_id: receiving.rack_id,
                            rack_name: receiving.rack_name,
                            receiving_date: receiving.date,
                            status: po.status
                        });
                    });
                }
            });
        });

        return allReceiving.sort((a, b) => new Date(b.receiving_date) - new Date(a.receiving_date));
    }

    // Method untuk mendapatkan stock per rak
    getRackInventory() {
        const rackInventory = {};

        // Initialize semua rak
        this.warehouseRacks.forEach(rack => {
            rackInventory[rack.id] = {
                rack_name: rack.name,
                capacity: rack.capacity,
                used_capacity: 0,
                items: []
            };
        });

        // Aggregate data dari receiving history
        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.receivingHistory) {
                    item.receivingHistory.forEach(receiving => {
                        if (receiving.rack_id && rackInventory[receiving.rack_id]) {
                            const rack = rackInventory[receiving.rack_id];
                            const existingItem = rack.items.find(i => i.barcode === item.barcode);

                            if (existingItem) {
                                existingItem.quantity += receiving.quantity;
                            } else {
                                rack.items.push({
                                    barcode: item.barcode,
                                    name: item.name,
                                    quantity: receiving.quantity,
                                    last_received: receiving.date,
                                    po_id: po.id
                                });
                            }

                            rack.used_capacity += receiving.quantity;
                        }
                    });
                }
            });
        });

        return rackInventory;
    }
    renderInventoryViews() {
        this.renderRackView();
        this.renderProductView();
        this.renderHistoryView();
        this.updateInventorySummary();
    }

    // View per Rak
    renderRackView() {
        const racksGrid = document.getElementById('racksGrid');
        if (!racksGrid) return;

        const rackInventory = this.getRackInventory();

        racksGrid.innerHTML = this.warehouseRacks.map(rack => {
            const inventory = rackInventory[rack.id];
            const usagePercent = inventory ? Math.round((inventory.used_capacity / rack.capacity) * 100) : 0;
            const usageClass = usagePercent > 90 ? 'high' : usagePercent > 70 ? 'medium' : 'low';

            return `
            <div class="rack-card" data-rack-id="${rack.id}">
                <div class="rack-header">
                    <h4>${rack.name}</h4>
                    <span class="rack-usage ${usageClass}">${usagePercent}%</span>
                </div>
                <div class="rack-capacity">
                    <div class="capacity-bar">
                        <div class="capacity-fill ${usageClass}" style="width: ${usagePercent}%"></div>
                    </div>
                    <div class="capacity-text">${inventory?.used_capacity || 0} / ${rack.capacity}</div>
                </div>
                <div class="rack-items">
                    <div class="items-header">
                        <span>Produk</span>
                        <span>Qty</span>
                    </div>
                    ${inventory && inventory.items.length > 0 ?
                    inventory.items.map(item => `
                            <div class="rack-item">
                                <span class="item-name" title="${item.name}">${this.truncateText(item.name, 20)}</span>
                                <span class="item-quantity">${item.quantity}</span>
                            </div>
                        `).join('') :
                    '<div class="no-items">Tidak ada barang</div>'
                }
                </div>
                <div class="rack-actions">
                    <button class="btn btn-sm btn-outline-primary" onclick="purchaseOrderUI.viewRackDetail(${rack.id})">
                        <i class="fas fa-list"></i> Detail
                    </button>
                </div>
            </div>
        `;
        }).join('');
    }

    // View per Produk
    renderProductView() {
        const productList = document.getElementById('productInventoryList');
        if (!productList) return;

        const productInventory = this.getProductInventory();

        productList.innerHTML = productInventory.map(product => {
            const rackDistribution = product.racks.map(rack =>
                `${rack.rack_name}: ${rack.quantity}`
            ).join(', ');

            return `
            <tr>
                <td>
                    <div class="product-info">
                        <strong>${product.name}</strong>
                        <div class="product-barcode">${product.barcode}</div>
                    </div>
                </td>
                <td>${product.barcode}</td>
                <td>
                    <span class="total-stock">${product.total_quantity}</span>
                </td>
                <td>
                    <div class="rack-distribution">
                        ${rackDistribution || 'Tidak ada distribusi'}
                    </div>
                </td>
                <td>${this.formatDate(product.last_received)}</td>
            </tr>
        `;
        }).join('');
    }
    // Method untuk switch antara view inventory
    switchInventoryView(view) {
        // Update active button
        document.querySelectorAll('[data-view]').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-view="${view}"]`).classList.add('active');

        // Show/hide views
        document.querySelectorAll('.inventory-view').forEach(viewEl => {
            viewEl.classList.remove('active');
        });

        const targetView = document.getElementById(`${view}View`);
        if (targetView) {
            targetView.classList.add('active');
        }

        // Refresh data untuk view yang dipilih
        switch (view) {
            case 'rack':
                this.renderRackView();
                break;
            case 'product':
                this.renderProductView();
                break;
            case 'history':
                this.renderHistoryView();
                break;
        }
    }
    // View Riwayat Penerimaan
    renderHistoryView() {
        const historyList = document.getElementById('receivingHistoryList');
        if (!historyList) return;

        const receivingHistory = this.getAllReceivingHistory();

        historyList.innerHTML = receivingHistory.map(receiving => {
            return `
            <tr>
                <td>${this.formatDate(receiving.receiving_date)}</td>
                <td>
                    <span class="po-id">${receiving.po_id}</span>
                </td>
                <td>${receiving.supplier}</td>
                <td>
                    <div class="product-info">
                        <strong>${receiving.product_name}</strong>
                        <div class="product-barcode">${receiving.barcode}</div>
                    </div>
                </td>
                <td>
                    <span class="quantity-badge">${receiving.quantity}</span>
                </td>
                <td>
                    <span class="rack-badge">${receiving.rack_name}</span>
                </td>
                <td>
                    <span class="status-badge ${this.getStatusClass(receiving.status)}">
                        ${this.getStatusText(receiving.status)}
                    </span>
                </td>
            </tr>
        `;
        }).join('');

        document.getElementById('totalReceivings').textContent = receivingHistory.length;
    }

    // Method untuk mendapatkan inventory per produk
    getProductInventory() {
        const productMap = {};

        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.receivingHistory) {
                    item.receivingHistory.forEach(receiving => {
                        if (!productMap[item.barcode]) {
                            productMap[item.barcode] = {
                                name: item.name,
                                barcode: item.barcode,
                                total_quantity: 0,
                                racks: [],
                                last_received: receiving.date
                            };
                        }

                        const product = productMap[item.barcode];
                        product.total_quantity += receiving.quantity;

                        const existingRack = product.racks.find(r => r.rack_id === receiving.rack_id);
                        if (existingRack) {
                            existingRack.quantity += receiving.quantity;
                        } else {
                            product.racks.push({
                                rack_id: receiving.rack_id,
                                rack_name: receiving.rack_name,
                                quantity: receiving.quantity
                            });
                        }

                        // Update last received date
                        if (new Date(receiving.date) > new Date(product.last_received)) {
                            product.last_received = receiving.date;
                        }
                    });
                }
            });
        });

        return Object.values(productMap).sort((a, b) => b.total_quantity - a.total_quantity);
    }
    updateInventorySummary() {
        const rackInventory = this.getRackInventory();
        let totalUsed = 0;
        let totalCapacity = 0;

        this.warehouseRacks.forEach(rack => {
            totalCapacity += rack.capacity;
            const inventory = rackInventory[rack.id];
            if (inventory) {
                totalUsed += inventory.used_capacity;
            }
        });

        const usedPercent = totalCapacity > 0 ? Math.round((totalUsed / totalCapacity) * 100) : 0;
        document.getElementById('usedCapacity').textContent = `${usedPercent}%`;
    }
    filterInventory() {
        const rackFilter = document.getElementById('inventoryRackFilter').value;
        const searchTerm = document.getElementById('inventorySearch').value.toLowerCase();

        // Filter rak view
        document.querySelectorAll('.rack-card').forEach(card => {
            const rackId = card.dataset.rackId;
            const matchesRack = !rackFilter || rackId === rackFilter;

            // Cek apakah ada item yang match search term
            let matchesSearch = true;
            if (searchTerm) {
                const items = card.querySelectorAll('.item-name');
                matchesSearch = Array.from(items).some(item =>
                    item.textContent.toLowerCase().includes(searchTerm)
                );
            }

            card.style.display = matchesRack && matchesSearch ? 'block' : 'none';
        });

        // Filter product view
        const productRows = document.querySelectorAll('#productInventoryList tr');
        productRows.forEach(row => {
            const productName = row.querySelector('.product-info strong').textContent.toLowerCase();
            const barcode = row.querySelector('.product-barcode').textContent.toLowerCase();
            const matchesSearch = !searchTerm || productName.includes(searchTerm) || barcode.includes(searchTerm);
            row.style.display = matchesSearch ? 'table-row' : 'none';
        });

        // Filter history view
        const historyRows = document.querySelectorAll('#receivingHistoryList tr');
        historyRows.forEach(row => {
            const productName = row.querySelector('.product-info strong').textContent.toLowerCase();
            const barcode = row.querySelector('.product-barcode').textContent.toLowerCase();
            const rackName = row.querySelector('.rack-badge').textContent.toLowerCase();
            const matchesSearch = !searchTerm ||
                productName.includes(searchTerm) ||
                barcode.includes(searchTerm) ||
                rackName.includes(searchTerm);
            row.style.display = matchesSearch ? 'table-row' : 'none';
        });
    }

    // View toggle
    setupInventoryViewToggle() {
        this.delegateEvent('click', '[data-view]', (e) => {
            const view = e.target.dataset.view;

            // Update active button
            document.querySelectorAll('[data-view]').forEach(btn => {
                btn.classList.remove('active');
            });
            e.target.classList.add('active');

            // Show/hide views
            document.querySelectorAll('.inventory-view').forEach(viewEl => {
                viewEl.classList.remove('active');
            });
            document.getElementById(`${view}View`).classList.add('active');
        });
    }
    // Method untuk melihat detail rak
    viewRackDetail(rackId) {
        const rack = this.warehouseRacks.find(r => r.id === rackId);
        const rackInventory = this.getRackInventory();
        const inventory = rackInventory[rackId];

        if (!rack) return;

        const modalContent = `
        <div class="modal-header">
            <h3>Detail Rak: ${rack.name}</h3>
            <button class="close-modal" onclick="this.closest('.modal').remove()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="rack-detail-info">
                <div class="info-item">
                    <label>Kapasitas:</label>
                    <span>${inventory?.used_capacity || 0} / ${rack.capacity}</span>
                </div>
                <div class="info-item">
                    <label>Persentase Terpakai:</label>
                    <span>${Math.round(((inventory?.used_capacity || 0) / rack.capacity) * 100)}%</span>
                </div>
            </div>
            
            <div class="rack-items-detail">
                <h4>Daftar Barang</h4>
                ${inventory && inventory.items.length > 0 ? `
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Terakhir Diterima</th>
                                <th>PO</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${inventory.items.map(item => `
                                <tr>
                                    <td>${item.name}</td>
                                    <td>${item.barcode}</td>
                                    <td>${item.quantity}</td>
                                    <td>${this.formatDate(item.last_received)}</td>
                                    <td>${item.po_id}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                ` : '<p class="no-data">Tidak ada barang di rak ini</p>'}
            </div>
        </div>
    `;

        this.showModal(`Rak ${rack.name}`, modalContent);
    }

    // Helper method untuk show modal
    showModal(title, content) {
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    `;

        modal.innerHTML = `
        <div class="modal-content" style="
            background: white;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            overflow: auto;
        ">
            ${content}
        </div>
    `;

        document.body.appendChild(modal);

        // Close modal on background click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }
    // Method untuk membuat retur
    createReturn() {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po) {
            alert('PO tidak ditemukan!');
            return;
        }

        // Cek apakah ada barang yang sudah diterima
        const receivedItems = po.items.filter(item => (item.received || 0) > 0);
        if (receivedItems.length === 0) {
            alert('Tidak ada barang yang sudah diterima untuk di-retur!');
            return;
        }

        const modalContent = `
        <div class="return-modal">
            <h3>Buat Retur - PO ${po.id}</h3>
            <div class="return-form">
                <div class="form-group">
                    <label class="form-label">Alasan Retur</label>
                    <select class="form-select" id="returnReason">
                        <option value="">Pilih Alasan Retur</option>
                        <option value="damaged">Barang Rusak</option>
                        <option value="wrong_item">Barang Tidak Sesuai</option>
                        <option value="excess">Kelebihan Pengiriman</option>
                        <option value="defective">Cacat Produksi</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea class="form-textarea" id="returnNotes" placeholder="Jelaskan alasan retur secara detail..." rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Retur</label>
                    <input type="date" class="form-input" id="returnDate" value="${new Date().toISOString().split('T')[0]}">
                </div>
                
                <div class="return-items-section">
                    <h4>Pilih Barang yang akan di-Retur</h4>
                    <div class="return-items-list" id="returnItemsList">
                        ${this.renderReturnItems(po.items)}
                    </div>
                </div>
                
                <div class="return-summary">
                    <h4>Ringkasan Retur</h4>
                    <div class="summary-details">
                        <div class="summary-item">
                            <span>Total Item:</span>
                            <span id="returnTotalItems">0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total Quantity:</span>
                            <span id="returnTotalQty">0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total Nilai:</span>
                            <span id="returnTotalValue">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="this.closest('.modal').remove()">Batal</button>
                <button class="btn btn-primary" onclick="purchaseOrderUI.submitReturn()">Buat Retur</button>
            </div>
        </div>
    `;

        this.showModal('Buat Retur Barang', modalContent);
    }

    renderReturnItems(items) {
        return items.map(item => {
            const received = item.received || 0;
            if (received === 0) return '';

            return `
            <div class="return-item" data-barcode="${item.barcode}">
                <div class="item-info">
                    <div class="item-header">
                        <strong>${item.name}</strong>
                        <span class="received-badge">Diterima: ${received}</span>
                    </div>
                    <div class="item-details">
                        <span>Barcode: ${item.barcode}</span>
                        <span>Harga: ${this.formatCurrency(item.discounted_price)}</span>
                    </div>
                </div>
                <div class="return-controls">
                    <div class="quantity-control">
                        <label>Jumlah Retur:</label>
                        <input type="number" 
                               class="return-qty" 
                               min="0" 
                               max="${received}"
                               value="0"
                               onchange="purchaseOrderUI.updateReturnSummary()">
                    </div>
                    <div class="rack-selection">
                        <label>Dari Rak:</label>
                        <select class="rack-select" onchange="purchaseOrderUI.updateReturnSummary()">
                            <option value="">Pilih Rak</option>
                            ${this.getReturnRackOptions(item.barcode)}
                        </select>
                    </div>
                </div>
            </div>
        `;
        }).join('');
    }

    // Get available racks untuk retur
    getReturnRackOptions(barcode) {
        const racksWithItem = [];

        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.barcode === barcode && item.receivingHistory) {
                    item.receivingHistory.forEach(receiving => {
                        if (receiving.rack_id && receiving.quantity > 0) {
                            const existingRack = racksWithItem.find(r => r.id === receiving.rack_id);
                            if (existingRack) {
                                existingRack.quantity += receiving.quantity;
                            } else {
                                racksWithItem.push({
                                    id: receiving.rack_id,
                                    name: receiving.rack_name,
                                    quantity: receiving.quantity
                                });
                            }
                        }
                    });
                }
            });
        });

        return racksWithItem.map(rack =>
            `<option value="${rack.id}">${rack.name} (Tersedia: ${rack.quantity})</option>`
        ).join('');
    }

    // Update return summary
    updateReturnSummary() {
        let totalItems = 0;
        let totalQty = 0;
        let totalValue = 0;

        document.querySelectorAll('.return-item').forEach(itemEl => {
            const barcode = itemEl.dataset.barcode;
            const qtyInput = itemEl.querySelector('.return-qty');
            const quantity = parseInt(qtyInput.value) || 0;

            if (quantity > 0) {
                const item = this.findItemByBarcode(barcode);
                if (item) {
                    totalItems++;
                    totalQty += quantity;
                    totalValue += quantity * item.discounted_price;
                }
            }
        });

        document.getElementById('returnTotalItems').textContent = totalItems;
        document.getElementById('returnTotalQty').textContent = totalQty;
        document.getElementById('returnTotalValue').textContent = this.formatCurrency(totalValue);
    }

    // Submit return
    submitReturn() {
        const reason = document.getElementById('returnReason').value;
        const notes = document.getElementById('returnNotes').value;
        const returnDate = document.getElementById('returnDate').value;

        if (!reason) {
            alert('Pilih alasan retur terlebih dahulu!');
            return;
        }

        const returnItems = [];
        let isValid = true;

        document.querySelectorAll('.return-item').forEach(itemEl => {
            const barcode = itemEl.dataset.barcode;
            const qtyInput = itemEl.querySelector('.return-qty');
            const rackSelect = itemEl.querySelector('.rack-select');
            const quantity = parseInt(qtyInput.value) || 0;
            const rackId = rackSelect.value ? parseInt(rackSelect.value) : null;

            if (quantity > 0) {
                if (!rackId) {
                    alert('Pilih rak untuk semua item yang akan di-retur!');
                    isValid = false;
                    return;
                }

                const item = this.findItemByBarcode(barcode);
                if (item) {
                    returnItems.push({
                        barcode: barcode,
                        name: item.name,
                        quantity: quantity,
                        rack_id: rackId,
                        rack_name: this.getRackName(rackId),
                        unit_price: item.discounted_price,
                        total_value: quantity * item.discounted_price
                    });
                }
            }
        });

        if (!isValid) return;

        if (returnItems.length === 0) {
            alert('Pilih minimal satu barang untuk di-retur!');
            return;
        }

        // Create return object
        const newReturn = {
            id: `RET-${Date.now().toString().slice(-6)}`,
            po_id: this.currentPoId,
            date: returnDate,
            reason: reason,
            notes: notes,
            items: returnItems,
            status: 'pending',
            total_value: returnItems.reduce((sum, item) => sum + item.total_value, 0),
            created_by: 'Admin',
            created_date: new Date().toISOString().split('T')[0],
            history: [
                {
                    date: new Date().toISOString().split('T')[0],
                    action: 'Retur dibuat',
                    user: 'Admin'
                }
            ]
        };

        // Save to PO returns
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po.returns) po.returns = [];
        po.returns.push(newReturn);

        // Update inventory
        this.processReturnInventory(newReturn);

        // Close modal dan refresh
        document.querySelector('.modal').remove();
        this.showReturnSuccess(newReturn);
        this.renderReturnsList();
    }
    // Method untuk render returns list
    renderReturnsList() {
        const returnsList = document.getElementById('returnsList');
        if (!returnsList) return;

        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        const returns = po?.returns || [];

        if (returns.length === 0) {
            returnsList.innerHTML = `
            <div class="no-returns">
                <i class="fas fa-exchange-alt" style="font-size: 3em; color: #ccc; margin-bottom: 10px;"></i>
                <p>Belum ada retur untuk PO ini</p>
                <button class="btn btn-primary" onclick="purchaseOrderUI.createReturn()">
                    <i class="fas fa-plus"></i> Buat Retur Pertama
                </button>
            </div>
        `;
            return;
        }

        returnsList.innerHTML = `
        <div class="returns-header">
            <h4>Daftar Retur (${returns.length})</h4>
            <button class="btn btn-primary btn-sm" onclick="purchaseOrderUI.createReturn()">
                <i class="fas fa-plus"></i> Retur Baru
            </button>
        </div>
        <div class="returns-cards">
            ${returns.map(retur => this.renderReturnCard(retur)).join('')}
        </div>
    `;
    }

    // Render individual return card
    renderReturnCard(retur) {
        const statusClass = this.getReturnStatusClass(retur.status);
        const statusText = this.getReturnStatusText(retur.status);

        return `
        <div class="return-card" data-return-id="${retur.id}">
            <div class="return-header">
                <div class="return-id">${retur.id}</div>
                <div class="return-status ${statusClass}">${statusText}</div>
            </div>
            <div class="return-details">
                <div class="detail-item">
                    <label>Tanggal:</label>
                    <span>${this.formatDate(retur.date)}</span>
                </div>
                <div class="detail-item">
                    <label>Alasan:</label>
                    <span>${this.getReturnReasonText(retur.reason)}</span>
                </div>
                <div class="detail-item">
                    <label>Total Item:</label>
                    <span>${retur.items.length} item</span>
                </div>
                <div class="detail-item">
                    <label>Total Nilai:</label>
                    <span>${this.formatCurrency(retur.total_value)}</span>
                </div>
            </div>
            <div class="return-items-preview">
                <strong>Items:</strong>
                <div class="items-list">
                    ${retur.items.map(item => `
                        <div class="return-item-preview">
                            ${item.name} (${item.quantity} @ ${this.formatCurrency(item.unit_price)})
                            <span class="rack-badge">${item.rack_name}</span>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="return-actions">
                <button class="btn btn-sm btn-info" onclick="purchaseOrderUI.viewReturnDetail('${retur.id}')">
                    <i class="fas fa-eye"></i> Detail
                </button>
                <button class="btn btn-sm btn-warning" onclick="purchaseOrderUI.editReturn('${retur.id}')" ${retur.status !== 'pending' ? 'disabled' : ''}>
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-success" onclick="purchaseOrderUI.processReturn('${retur.id}')" ${retur.status !== 'pending' ? 'disabled' : ''}>
                    <i class="fas fa-check"></i> Proses
                </button>
            </div>
        </div>
    `;
    }

    // Helper methods untuk retur
    getReturnStatusClass(status) {
        const classes = {
            'pending': 'status-pending',
            'processed': 'status-processed',
            'cancelled': 'status-cancelled',
            'completed': 'status-completed'
        };
        return classes[status] || 'status-pending';
    }

    getReturnStatusText(status) {
        const texts = {
            'pending': 'Menunggu',
            'processed': 'Diproses',
            'cancelled': 'Dibatalkan',
            'completed': 'Selesai'
        };
        return texts[status] || 'Menunggu';
    }

    getReturnReasonText(reason) {
        const texts = {
            'damaged': 'Barang Rusak',
            'wrong_item': 'Barang Tidak Sesuai',
            'excess': 'Kelebihan Pengiriman',
            'defective': 'Cacat Produksi',
            'other': 'Lainnya'
        };
        return texts[reason] || reason;
    }

    // View return detail
    viewReturnDetail(returnId) {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        const returnData = po?.returns.find(r => r.id === returnId);

        if (!returnData) return;

        const modalContent = `
        <div class="return-detail-modal">
            <h3>Detail Retur: ${returnData.id}</h3>
            <div class="detail-sections">
                <div class="detail-section">
                    <h4>Informasi Retur</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Status:</label>
                            <span class="return-status ${this.getReturnStatusClass(returnData.status)}">
                                ${this.getReturnStatusText(returnData.status)}
                            </span>
                        </div>
                        <div class="info-item">
                            <label>Tanggal Retur:</label>
                            <span>${this.formatDate(returnData.date)}</span>
                        </div>
                        <div class="info-item">
                            <label>Alasan:</label>
                            <span>${this.getReturnReasonText(returnData.reason)}</span>
                        </div>
                        <div class="info-item">
                            <label>Dibuat Oleh:</label>
                            <span>${returnData.created_by}</span>
                        </div>
                        <div class="info-item">
                            <label>Keterangan:</label>
                            <span>${returnData.notes || '-'}</span>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h4>Items Retur</h4>
                    <table class="return-items-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Quantity</th>
                                <th>Rak</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${returnData.items.map(item => `
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <strong>${item.name}</strong>
                                            <div class="barcode">${item.barcode}</div>
                                        </div>
                                    </td>
                                    <td>${item.quantity}</td>
                                    <td>${item.rack_name}</td>
                                    <td>${this.formatCurrency(item.unit_price)}</td>
                                    <td>${this.formatCurrency(item.total_value)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                                <td><strong>${this.formatCurrency(returnData.total_value)}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="detail-section">
                    <h4>Riwayat Retur</h4>
                    <div class="return-history">
                        ${returnData.history.map(event => `
                            <div class="history-item">
                                <div class="history-date">${this.formatDate(event.date)}</div>
                                <div class="history-action">${event.action} oleh ${event.user}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="this.closest('.modal').remove()">Tutup</button>
            </div>
        </div>
    `;

        this.showModal(`Detail Retur ${returnData.id}`, modalContent);
    }

    // Process return
    processReturn(returnId) {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        const returnData = po?.returns.find(r => r.id === returnId);

        if (!returnData) return;

        if (confirm(`Proses retur ${returnId}? Status akan berubah menjadi diproses.`)) {
            returnData.status = 'processed';
            returnData.history.push({
                date: new Date().toISOString().split('T')[0],
                action: 'Retur diproses',
                user: 'Admin'
            });

            this.renderReturnsList();
            alert('Retur berhasil diproses!');
        }
    }

    // Edit return (hanya untuk status pending)
    editReturn(returnId) {
        // Implementation untuk edit return
        alert('Fitur edit retur akan segera tersedia!');
    }

    // Helper method untuk find item by barcode
    findItemByBarcode(barcode) {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        return po?.items.find(item => item.barcode === barcode);
    }
    // Method untuk membuat retur
    createReturn() {
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po) {
            alert('PO tidak ditemukan!');
            return;
        }

        // Cek apakah ada barang yang sudah diterima
        const receivedItems = po.items.filter(item => (item.received || 0) > 0);
        if (receivedItems.length === 0) {
            alert('Tidak ada barang yang sudah diterima untuk di-retur!');
            return;
        }

        const modalContent = `
        <div class="return-modal">
            <h3>Buat Retur - PO ${po.id}</h3>
            <div class="return-form">
                <div class="form-group">
                    <label class="form-label">Alasan Retur</label>
                    <select class="form-select" id="returnReason">
                        <option value="">Pilih Alasan Retur</option>
                        <option value="damaged">Barang Rusak</option>
                        <option value="wrong_item">Barang Tidak Sesuai</option>
                        <option value="excess">Kelebihan Pengiriman</option>
                        <option value="defective">Cacat Produksi</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea class="form-textarea" id="returnNotes" placeholder="Jelaskan alasan retur secara detail..." rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Retur</label>
                    <input type="date" class="form-input" id="returnDate" value="${new Date().toISOString().split('T')[0]}">
                </div>
                
                <div class="return-items-section">
                    <h4>Pilih Barang yang akan di-Retur</h4>
                    <div class="return-items-list" id="returnItemsList">
                        ${this.renderReturnItems(po.items)}
                    </div>
                </div>
                
                <div class="return-summary">
                    <h4>Ringkasan Retur</h4>
                    <div class="summary-details">
                        <div class="summary-item">
                            <span>Total Item:</span>
                            <span id="returnTotalItems">0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total Quantity:</span>
                            <span id="returnTotalQty">0</span>
                        </div>
                        <div class="summary-item">
                            <span>Total Nilai:</span>
                            <span id="returnTotalValue">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="this.closest('.modal').remove()">Batal</button>
                <button class="btn btn-primary" onclick="purchaseOrderUI.submitReturn()">Buat Retur</button>
            </div>
        </div>
    `;

        this.showModal('Buat Retur Barang', modalContent);
    }

    // Render items yang bisa di-retur
    renderReturnItems(items) {
        return items.map(item => {
            const received = item.received || 0;
            if (received === 0) return ''; // Skip items yang belum diterima

            return `
            <div class="return-item" data-barcode="${item.barcode}">
                <div class="item-info">
                    <div class="item-header">
                        <strong>${item.name}</strong>
                        <span class="received-badge">Diterima: ${received}</span>
                    </div>
                    <div class="item-details">
                        <span>Barcode: ${item.barcode}</span>
                        <span>Harga: ${this.formatCurrency(item.discounted_price)}</span>
                    </div>
                </div>
                <div class="return-controls">
                    <div class="quantity-control">
                        <label>Jumlah Retur:</label>
                        <input type="number" 
                               class="return-qty" 
                               min="0" 
                               max="${received}"
                               value="0"
                               onchange="purchaseOrderUI.updateReturnSummary()">
                    </div>
                    <div class="rack-selection">
                        <label>Dari Rak:</label>
                        <select class="rack-select" onchange="purchaseOrderUI.updateReturnSummary()">
                            <option value="">Pilih Rak</option>
                            ${this.getReturnRackOptions(item.barcode)}
                        </select>
                    </div>
                </div>
            </div>
        `;
        }).join('');
    }

    // Get available racks untuk retur
    getReturnRackOptions(barcode) {
        const racksWithItem = [];

        this.PurchaseOrders.forEach(po => {
            po.items.forEach(item => {
                if (item.barcode === barcode && item.receivingHistory) {
                    item.receivingHistory.forEach(receiving => {
                        if (receiving.rack_id && receiving.quantity > 0) {
                            const existingRack = racksWithItem.find(r => r.id === receiving.rack_id);
                            if (existingRack) {
                                existingRack.quantity += receiving.quantity;
                            } else {
                                racksWithItem.push({
                                    id: receiving.rack_id,
                                    name: receiving.rack_name,
                                    quantity: receiving.quantity
                                });
                            }
                        }
                    });
                }
            });
        });

        return racksWithItem.map(rack =>
            `<option value="${rack.id}">${rack.name} (Tersedia: ${rack.quantity})</option>`
        ).join('');
    }

    // Update return summary
    updateReturnSummary() {
        let totalItems = 0;
        let totalQty = 0;
        let totalValue = 0;

        document.querySelectorAll('.return-item').forEach(itemEl => {
            const barcode = itemEl.dataset.barcode;
            const qtyInput = itemEl.querySelector('.return-qty');
            const quantity = parseInt(qtyInput.value) || 0;

            if (quantity > 0) {
                const item = this.findItemByBarcode(barcode);
                if (item) {
                    totalItems++;
                    totalQty += quantity;
                    totalValue += quantity * item.discounted_price;
                }
            }
        });

        document.getElementById('returnTotalItems').textContent = totalItems;
        document.getElementById('returnTotalQty').textContent = totalQty;
        document.getElementById('returnTotalValue').textContent = this.formatCurrency(totalValue);
    }

    // Submit return
    submitReturn() {
        const reason = document.getElementById('returnReason').value;
        const notes = document.getElementById('returnNotes').value;
        const returnDate = document.getElementById('returnDate').value;

        if (!reason) {
            alert('Pilih alasan retur terlebih dahulu!');
            return;
        }

        const returnItems = [];
        let isValid = true;

        document.querySelectorAll('.return-item').forEach(itemEl => {
            const barcode = itemEl.dataset.barcode;
            const qtyInput = itemEl.querySelector('.return-qty');
            const rackSelect = itemEl.querySelector('.rack-select');
            const quantity = parseInt(qtyInput.value) || 0;
            const rackId = rackSelect.value ? parseInt(rackSelect.value) : null;

            if (quantity > 0) {
                if (!rackId) {
                    alert('Pilih rak untuk semua item yang akan di-retur!');
                    isValid = false;
                    return;
                }

                const item = this.findItemByBarcode(barcode);
                if (item) {
                    returnItems.push({
                        barcode: barcode,
                        name: item.name,
                        quantity: quantity,
                        rack_id: rackId,
                        rack_name: this.getRackName(rackId),
                        unit_price: item.discounted_price,
                        total_value: quantity * item.discounted_price
                    });
                }
            }
        });

        if (!isValid) return;

        if (returnItems.length === 0) {
            alert('Pilih minimal satu barang untuk di-retur!');
            return;
        }

        // Create return object
        const newReturn = {
            id: `RET-${Date.now().toString().slice(-6)}`,
            po_id: this.currentPoId,
            date: returnDate,
            reason: reason,
            notes: notes,
            items: returnItems,
            status: 'pending',
            total_value: returnItems.reduce((sum, item) => sum + item.total_value, 0),
            created_by: 'Admin',
            created_date: new Date().toISOString().split('T')[0],
            history: [
                {
                    date: new Date().toISOString().split('T')[0],
                    action: 'Retur dibuat',
                    user: 'Admin'
                }
            ]
        };

        // Save to PO returns
        const po = this.PurchaseOrders.find(p => p.id === this.currentPoId);
        if (!po.returns) po.returns = [];
        po.returns.push(newReturn);

        // Update inventory
        this.processReturnInventory(newReturn);

        // Close modal dan refresh
        document.querySelector('.modal').remove();
        this.showReturnSuccess(newReturn);
        this.renderReturnsList();
    }

    // Process return inventory
    processReturnInventory(returnData) {
        returnData.items.forEach(returnItem => {
            // Kurangi quantity dari rak
            const rack = this.warehouseRacks.find(r => r.id === returnItem.rack_id);
            if (rack && rack.items) {
                const rackItem = rack.items.find(item => item.barcode === returnItem.barcode);
                if (rackItem) {
                    rackItem.quantity = Math.max(0, rackItem.quantity - returnItem.quantity);

                    // Remove item jika quantity 0
                    if (rackItem.quantity === 0) {
                        rack.items = rack.items.filter(item => item.barcode !== returnItem.barcode);
                    }
                }
            }

            // Update received quantity di PO item
            const po = this.PurchaseOrders.find(p => p.id === returnData.po_id);
            if (po) {
                const poItem = po.items.find(item => item.barcode === returnItem.barcode);
                if (poItem) {
                    poItem.received = Math.max(0, (poItem.received || 0) - returnItem.quantity);

                    // Add to return history
                    if (!poItem.returnHistory) poItem.returnHistory = [];
                    poItem.returnHistory.push({
                        return_id: returnData.id,
                        quantity: returnItem.quantity,
                        date: returnData.date,
                        reason: returnData.reason
                    });
                }
            }
        });
    }

    // Show return success notification
    showReturnSuccess(returnData) {
        const notification = `
        <div class="return-success" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        ">
            <i class="fas fa-check-circle"></i>
            <strong>Retur Berhasil Dibuat!</strong><br>
            ID: ${returnData.id} - ${returnData.items.length} item
        </div>
    `;

        document.body.insertAdjacentHTML('beforeend', notification);

        setTimeout(() => {
            const notif = document.querySelector('.return-success');
            if (notif) notif.remove();
        }, 5000);
    }
    // Process return inventory
    processReturnInventory(returnData) {
        returnData.items.forEach(returnItem => {
            // Kurangi quantity dari rak
            const rack = this.warehouseRacks.find(r => r.id === returnItem.rack_id);
            if (rack && rack.items) {
                const rackItem = rack.items.find(item => item.barcode === returnItem.barcode);
                if (rackItem) {
                    rackItem.quantity = Math.max(0, rackItem.quantity - returnItem.quantity);

                    // Remove item jika quantity 0
                    if (rackItem.quantity === 0) {
                        rack.items = rack.items.filter(item => item.barcode !== returnItem.barcode);
                    }
                }
            }

            // Update received quantity di PO item
            const po = this.PurchaseOrders.find(p => p.id === returnData.po_id);
            if (po) {
                const poItem = po.items.find(item => item.barcode === returnItem.barcode);
                if (poItem) {
                    poItem.received = Math.max(0, (poItem.received || 0) - returnItem.quantity);

                    // Add to return history
                    if (!poItem.returnHistory) poItem.returnHistory = [];
                    poItem.returnHistory.push({
                        return_id: returnData.id,
                        quantity: returnItem.quantity,
                        date: returnData.date,
                        reason: returnData.reason
                    });
                }
            }
        });
    }

    // Show return success notification
    showReturnSuccess(returnData) {
        const notification = `
        <div class="return-success" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        ">
            <i class="fas fa-check-circle"></i>
            <strong>Retur Berhasil Dibuat!</strong><br>
            ID: ${returnData.id} - ${returnData.items.length} item
        </div>
    `;

        document.body.insertAdjacentHTML('beforeend', notification);

        setTimeout(() => {
            const notif = document.querySelector('.return-success');
            if (notif) notif.remove();
        }, 5000);
    }
}
const additionalCSS = `
.scanner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    transition: all 0.3s ease;
}

.scan-line {
    position: absolute;
    top: 50%;
    left: 10%;
    width: 80%;
    height: 2px;
    background: #00ff00;
    animation: scan 2s infinite linear;
    box-shadow: 0 0 10px #00ff00;
}

@keyframes scan {
    0% { top: 10%; }
    50% { top: 90%; }
    100% { top: 10%; }
}

.po-type-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin: 20px 0;
}

.po-type-card {
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.po-type-card:hover {
    border-color: #007bff;
    transform: translateY(-2px);
}

.po-type-card.selected {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.po-type-icon {
    font-size: 2em;
    margin-bottom: 10px;
}

.po-type-title {
    font-weight: bold;
    margin-bottom: 5px;
}

.po-type-desc {
    font-size: 0.9em;
    color: #666;
}

.scanner-status {
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
    margin: 10px 0;
    text-align: center;
}

.empty-state {
    text-align: center;
    padding: 40px;
    color: #666;
    font-style: italic;
}

.badge {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
}
/* Inventory Styles */
.inventory-controls {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.inventory-controls .form-group {
    flex: 1;
    min-width: 200px;
}

.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.summary-card {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    text-align: center;
}

.summary-title {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 5px;
}

.summary-value {
    font-size: 1.5em;
    font-weight: bold;
    color: #333;
}

.view-toggle {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.inventory-view {
    display: none;
}

.inventory-view.active {
    display: block;
}

/* Rack Grid */
.racks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.rack-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.rack-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.rack-header h4 {
    margin: 0;
    color: #333;
}

.rack-usage {
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8em;
    font-weight: bold;
}

.rack-usage.low { background: #d4edda; color: #155724; }
.rack-usage.medium { background: #fff3cd; color: #856404; }
.rack-usage.high { background: #f8d7da; color: #721c24; }

.rack-capacity {
    margin-bottom: 15px;
}

.capacity-bar {
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 5px;
}

.capacity-fill {
    height: 100%;
    transition: width 0.3s ease;
}

.capacity-fill.low { background: #28a745; }
.capacity-fill.medium { background: #ffc107; }
.capacity-fill.high { background: #dc3545; }

.capacity-text {
    font-size: 0.8em;
    color: #666;
    text-align: center;
}

.rack-items {
    margin-bottom: 15px;
}

.items-header {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    font-size: 0.9em;
    margin-bottom: 5px;
    padding-bottom: 5px;
    border-bottom: 1px solid #dee2e6;
}

.rack-item {
    display: flex;
    justify-content: space-between;
    padding: 3px 0;
    font-size: 0.9em;
}

.item-name {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.item-quantity {
    font-weight: bold;
    color: #007bff;
}

.no-items {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 10px 0;
}

.rack-actions {
    text-align: center;
}

/* Inventory Tables */
.inventory-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.inventory-table th,
.inventory-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.inventory-table th {
    background: #f8f9fa;
    font-weight: 600;
}

.product-info strong {
    display: block;
    margin-bottom: 2px;
}

.product-barcode {
    font-size: 0.8em;
    color: #666;
}

.rack-distribution {
    font-size: 0.9em;
    max-width: 200px;
}

.total-stock {
    font-weight: bold;
    color: #28a745;
}

.quantity-badge {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
}

.rack-badge {
    background: #6c757d;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
}

/* Modal Styles */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
}

.modal-header h3 {
    margin: 0;
}

.close-modal {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
    color: #666;
}

.modal-body {
    padding: 20px;
}

.rack-detail-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
}

.detail-table {
    width: 100%;
    border-collapse: collapse;
}

.detail-table th,
.detail-table td {
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
}

.detail-table th {
    background: #e9ecef;
}/* Return Styles */
.return-modal {
    max-width: 800px;
}

.return-items-section {
    margin: 20px 0;
}

.return-item {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    background: #f9f9f9;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.received-badge {
    background: #17a2b8;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
}

.item-details {
    display: flex;
    gap: 15px;
    font-size: 0.9em;
    color: #666;
}

.return-controls {
    display: flex;
    gap: 15px;
    margin-top: 10px;
    flex-wrap: wrap;
}

.quantity-control, .rack-selection {
    flex: 1;
    min-width: 150px;
}

.quantity-control label, .rack-selection label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.return-summary {
    background: #e7f3ff;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.summary-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
}

/* Returns List */
.no-returns {
    text-align: center;
    padding: 40px;
    color: #666;
}

.returns-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.returns-cards {
    display: grid;
    gap: 15px;
}

.return-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background: white;
}

.return-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.return-id {
    font-weight: bold;
    color: #333;
}

.return-status {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8em;
    font-weight: bold;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-processed { background: #cce7ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.return-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
}

.detail-item label {
    font-weight: 500;
    color: #666;
}

.return-items-preview {
    margin-bottom: 15px;
}

.items-list {
    max-height: 120px;
    overflow-y: auto;
    margin-top: 8px;
}

.return-item-preview {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    font-size: 0.9em;
    border-bottom: 1px solid #f0f0f0;
}

.return-actions {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

/* Return Detail */
.return-detail-modal {
    max-width: 900px;
}

.detail-sections {
    max-height: 60vh;
    overflow-y: auto;
}

.detail-section {
    margin-bottom: 25px;
}

.detail-section h4 {
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 10px;
}

.return-items-table {
    width: 100%;
    border-collapse: collapse;
}

.return-items-table th,
.return-items-table td {
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
    text-align: left;
}

.return-items-table th {
    background: #f8f9fa;
    font-weight: 600;
}

.return-history {
    max-height: 200px;
    overflow-y: auto;
}

.history-item {
    display: flex;
    gap: 15px;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.history-date {
    min-width: 100px;
    font-weight: 500;
}

.history-action {
    flex: 1;
}.receiving-entry {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 8px;
    background: white;
}

.entry-controls {
    display: flex;
    gap: 10px;
    align-items: end;
    flex-wrap: wrap;
}

.receiving-quantity, .receiving-rack {
    flex: 1;
    min-width: 150px;
}

.receiving-quantity label, .receiving-rack label {
    display: block;
    margin-bottom: 3px;
    font-size: 0.9em;
    font-weight: 500;
}

.entry-preview {
    margin-top: 8px;
    padding: 5px 10px;
    background: #e7f3ff;
    border-radius: 3px;
    font-size: 0.9em;
    color: #0066cc;
}

.add-more-rack {
    margin-top: 5px;
}

.remove-entry {
    align-self: center;
}
/* Return Styles */
.return-modal {
    max-width: 800px;
}

.return-items-section {
    margin: 20px 0;
}

.return-item {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    background: #f9f9f9;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.received-badge {
    background: #17a2b8;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
}

.item-details {
    display: flex;
    gap: 15px;
    font-size: 0.9em;
    color: #666;
}

.return-controls {
    display: flex;
    gap: 15px;
    margin-top: 10px;
    flex-wrap: wrap;
}

.quantity-control, .rack-selection {
    flex: 1;
    min-width: 150px;
}

.quantity-control label, .rack-selection label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.return-summary {
    background: #e7f3ff;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.summary-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
}

/* Returns List */
.no-returns {
    text-align: center;
    padding: 40px;
    color: #666;
}

.returns-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.returns-cards {
    display: grid;
    gap: 15px;
}

.return-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background: white;
}

.return-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.return-id {
    font-weight: bold;
    color: #333;
}

.return-status {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8em;
    font-weight: bold;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-processed { background: #cce7ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.return-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
}

.detail-item label {
    font-weight: 500;
    color: #666;
}

.return-items-preview {
    margin-bottom: 15px;
}

.items-list {
    max-height: 120px;
    overflow-y: auto;
    margin-top: 8px;
}

.return-item-preview {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    font-size: 0.9em;
    border-bottom: 1px solid #f0f0f0;
}

.return-actions {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

/* Return Detail */
.return-detail-modal {
    max-width: 900px;
}

.detail-sections {
    max-height: 60vh;
    overflow-y: auto;
}

.detail-section {
    margin-bottom: 25px;
}

.detail-section h4 {
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 10px;
}

.return-items-table {
    width: 100%;
    border-collapse: collapse;
}

.return-items-table th,
.return-items-table td {
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
    text-align: left;
}

.return-items-table th {
    background: #f8f9fa;
    font-weight: 600;
}

.return-history {
    max-height: 200px;
    overflow-y: auto;
}

.history-item {
    display: flex;
    gap: 15px;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.history-date {
    min-width: 100px;
    font-weight: 500;
}

.history-action {
    flex: 1;
} .product-search-section {
    margin: 20px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
}

.search-controls {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.search-controls input {
    flex: 1;
}

.search-results {
    min-height: 100px;
}

.no-results {
    text-align: center;
    padding: 30px;
    color: #666;
}

.no-results i {
    font-size: 2em;
    margin-bottom: 10px;
    color: #ccc;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.product-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background: white;
    display: flex;
    gap: 12px;
}

.product-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}

.product-info {
    flex: 1;
}

.product-info h4 {
    margin: 0 0 5px 0;
    font-size: 0.95em;
    line-height: 1.3;
}

.product-barcode {
    font-size: 0.8em;
    color: #666;
    margin-bottom: 5px;
}

.product-price {
    font-weight: bold;
    color: #28a745;
}

.product-actions {
    align-self: center;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
}

.page-info {
    font-size: 0.9em;
    color: #666;
}/* Tambahkan CSS ini ke additionalCSS */
.variant-selection-modal {
    max-width: 600px;
}

.variants-list {
    max-height: 400px;
    overflow-y: auto;
    margin: 15px 0;
}

.variant-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 8px;
    background: white;
}

.variant-info strong {
    display: block;
    margin-bottom: 4px;
}

.variant-info div {
    font-size: 0.85em;
    color: #666;
    margin-bottom: 2px;
}

.select-variant {
    white-space: nowrap;
} 
/* Tambahkan CSS untuk notification */
.global-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    z-index: 10000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    min-width: 300px;
    max-width: 500px;
}

.global-notification.show {
    transform: translateX(0);
}

.global-notification.success {
    background: #28a745;
    border-left: 4px solid #1e7e34;
}

.global-notification.error {
    background: #dc3545;
    border-left: 4px solid #c82333;
}

.global-notification.warning {
    background: #ffc107;
    color: #212529;
    border-left: 4px solid #e0a800;
}

.global-notification.info {
    background: #17a2b8;
    border-left: 4px solid #138496;
}

.global-notification.loading {
    background: #6c757d;
    border-left: 4px solid #545b62;
}

.global-notification i {
    font-size: 1.2em;
}

.global-notification span {
    flex: 1;
}

.close-notif {
    background: none;
    border: none;
    color: inherit;
    font-size: 1.2em;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.8;
}

.close-notif:hover {
    opacity: 1;
}
.variant-selection-modal {
    max-width: 600px;
}

.variants-list {
    max-height: 400px;
    overflow-y: auto;
    margin: 15px 0;
}

.variant-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    margin-bottom: 8px;
    background: white;
}

.variant-info strong {
    display: block;
    margin-bottom: 4px;
}

.variant-info div {
    font-size: 0.85em;
    color: #666;
    margin-bottom: 2px;
}

.select-variant {
    white-space: nowrap;
}
.search-loading {
    text-align: center;
    padding: 40px;
    color: #666;
}

.loading-spinner {
    border: 3px solid #f3f3f3;
    border-top: 3px solid #007bff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.search-error {
    text-align: center;
    padding: 30px;
    color: #dc3545;
    background: #f8d7da;
    border-radius: 5px;
    border: 1px solid #f5c6cb;
}

.search-error i {
    font-size: 2em;
    margin-bottom: 10px;
    display: block;
}

.no-results {
    text-align: center;
    padding: 40px;
    color: #666;
}

.no-results i {
    font-size: 3em;
    margin-bottom: 15px;
    color: #ccc;
    display: block;
}

.search-results-header {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
    font-weight: 500;
    color: #495057;
}
.product-stock {
    font-size: 0.8em;
    color: #28a745;
    font-weight: 500;
}

.add-product-btn {
    width: 100%;
    margin-top: 8px;
}
 
.product-card {
    transition: all 0.2s ease;
}

.product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}/* Tambahkan CSS ini */

/* Quantity Edit Form */
.quantity-edit-form h4 {
    margin-bottom: 8px;
    color: #333;
}

.barcode-info {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 12px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.quantity-controls label {
    font-weight: 500;
    color: #333;
    margin-bottom: 0;
}

.quantity-input-group {
    display: flex;
    align-items: center;
    gap: 5px;
}

.quantity-input {
    width: 80px;
    text-align: center;
    padding: 6px 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-weight: bold;
}

.quantity-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.quantity-decrease,
.quantity-increase {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;
}

.quantity-decrease:hover,
.quantity-increase:hover {
    background-color: #f8f9fa;
}

/* Notification Styles */
.quantity-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 20px;
    border-radius: 6px;
    color: white;
    font-weight: 500;
    z-index: 10000;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.quantity-notification.show {
    transform: translateX(0);
}

.quantity-notification.success {
    background: #28a745;
    border-left: 4px solid #1e7e34;
}

.quantity-notification.error {
    background: #dc3545;
    border-left: 4px solid #c82333;
}

.quantity-notification i {
    font-size: 1.2em;
}

/* Product Confirm Item Styles */
.product-confirm-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 10px;
    background: white;
    transition: all 0.2s ease;
}

.product-confirm-item:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.product-info {
    flex: 1;
}

.product-info h4 {
    margin: 0 0 5px 0;
    color: #333;
}

.product-info div {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 3px;
}

.product-actions {
    display: flex;
    gap: 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-confirm-item {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    
    .product-actions {
        justify-content: flex-end;
    }
    
    .quantity-controls {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}/* Tambahkan CSS ini */

.product-detail-item {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-detail-item h4 {
    margin: 0 0 15px 0;
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 8px;
}

.detail-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: 500;
    margin-bottom: 5px;
    color: #333;
}

.form-input {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.form-input:read-only {
    background-color: #f8f9fa;
    color: #666;
    cursor: not-allowed;
}

/* Currency input styling */
.price-input, .selling-price-input {
    text-align: right;
    font-weight: 500;
}

.final-price-input {
    text-align: right;
    font-weight: bold;
    color: #28a745;
}

.discount-input {
    text-align: center;
}

.rack-select {
    cursor: pointer;
}

/* Responsive design */
@media (max-width: 768px) {
    .detail-form {
        grid-template-columns: 1fr;
    }
    
    .product-detail-item {
        padding: 15px;
    }
}
/* Scanned Products List Styles */
.scanned-list {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #fafafa;
}

.scanned-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 15px;
    border-bottom: 1px solid #e8e8e8;
    background: white;
    transition: all 0.2s ease;
    position: relative;
}

.scanned-item:last-child {
    border-bottom: none;
}

.scanned-item:hover {
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.scanned-info {
    flex: 1;
    min-width: 0; /* Untuk text truncate */
}

.scanned-info strong {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 4px;
    font-weight: 600;
    line-height: 1.3;
}

.scanned-info div {
    font-size: 12px;
    color: #666;
    margin-bottom: 2px;
}

.scanned-info div:last-child {
    margin-bottom: 0;
}

.scanned-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.scanned-actions .btn {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.scanned-actions .btn-danger {
    background: #dc3545;
    border: 1px solid #dc3545;
    color: white;
}

.scanned-actions .btn-danger:hover {
    background: #c82333;
    border-color: #c82333;
    transform: scale(1.05);
}

.scanned-actions .btn-danger:active {
    transform: scale(0.95);
}

/* Empty State */
.scanned-list .empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #999;
    font-style: italic;
}

.scanned-list .empty-state i {
    font-size: 3em;
    margin-bottom: 10px;
    color: #ddd;
    display: block;
}

/* Scrollbar Styling */
.scanned-list::-webkit-scrollbar {
    width: 6px;
}

.scanned-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.scanned-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.scanned-list::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Badge untuk jumlah */
.scanned-badge {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.8em;
    font-weight: 600;
    margin-left: 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .scanned-item {
        padding: 10px 12px;
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
    }
    
    .scanned-actions {
        justify-content: flex-end;
        border-top: 1px solid #f0f0f0;
        padding-top: 10px;
    }
    
    .scanned-info strong {
        font-size: 13px;
    }
    
    .scanned-info div {
        font-size: 11px;
    }
}

/* Animation untuk item baru */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.scanned-item.new-item {
    animation: slideIn 0.3s ease;
}

/* Highlight untuk item yang di-hover */
.scanned-item.highlight {
    background: #e3f2fd;
    border-left: 3px solid #2196f3;
}

/* Status indicator */
.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #28a745;
    margin-right: 8px;
}

.status-indicator.pending {
    background: #ffc107;
}

.status-indicator.error {
    background: #dc3545;
}/* Header Styles */
.scanned-products h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    color: #333;
    font-size: 1.2em;
}

.scanned-products h3 .badge {
    background: #007bff;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8em;
    font-weight: 600;
}

/* Summary info */
.scanned-summary {
    background: #e7f3ff;
    padding: 10px 15px;
    border-radius: 6px;
    margin-bottom: 15px;
    border-left: 4px solid #007bff;
}

.scanned-summary div {
    font-size: 0.9em;
    color: #333;
    margin-bottom: 3px;
}

.scanned-summary .total-items {
    font-weight: 600;
    color: #007bff;
}

/* Loading state */
.scanned-list.loading {
    opacity: 0.6;
    pointer-events: none;
}

.scanned-list.loading::after {
    content: 'Memuat...';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #666;
    font-style: italic;
}/* Smooth transitions */
.scanned-item,
.scanned-actions .btn,
.scanned-info strong {
    transition: all 0.2s ease;
}

/* Focus states untuk accessibility */
.scanned-actions .btn:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .scanned-list {
        background: #2d3748;
        border-color: #4a5568;
    }
    
    .scanned-item {
        background: #1a202c;
        border-bottom-color: #4a5568;
    }
    
    .scanned-item:hover {
        background: #2d3748;
    }
    
    .scanned-info strong {
        color: #e2e8f0;
    }
    
    .scanned-info div {
        color: #a0aec0;
    }
}
    .existing-receiving-view {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    background-color: #f8f9fa;
}

.breakdown-list {
    margin: 10px 0;
}

.breakdown-item {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px solid #dee2e6;
}

.breakdown-item:last-child {
    border-bottom: none;
}

.receiving-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.additional-receiving {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #dee2e6;
}

.edit-receiving-form {
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 15px;
    background-color: #f8f9fa;
}

.form-header {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.empty-receiving-form {
    border: 1px dashed #dee2e6;
    border-radius: 8px;
    padding: 15px;
}


.payment-container {
            
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 25px;
        }
        .payment-header {
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .payment-header h3 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .payment-info {
            margin-bottom: 25px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-label {
            font-weight: 600;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .payment-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .payment-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-unpaid {
            background-color: #ffe6e6;
            color: #d63031;
        }
        .status-paid {
            background-color: #e6f7e6;
            color: #27ae60;
        }
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        #contrabonPreview {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: white;
        }
        .file-upload {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .file-upload i {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .file-preview {
            margin-top: 15px;
            display: none;
        }
        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 6px;
        }
        .bank-transfer-info {
            background-color: #e8f4fd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .payment-confirmation-card {
            background: linear-gradient(135deg, #e6f7e6, #d4edda);
            border: 1px solid #c3e6cb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .confirmation-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .confirmation-badge {
            background-color: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .confirmation-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        .detail-card {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        .detail-card h6 {
            color: #28a745;
            margin-bottom: 10px;
        }
        .proof-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
       
       .split-bill-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }
        .konfirmasi-item {
            background-color: #e8f5e8;
            border-radius: 6px;
            padding: 10px;
            margin-top: 10px;
        }
            
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 500px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .modal h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #e1e1e1;
            padding-bottom: 10px;
        }
        
        .modal h4 {
            margin: 15px 0 5px 0;
            color: #3498db;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        .no-items {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        #editItemModal .form-group {
            margin-bottom: 15px;
        }
        
        #editItemModal .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        #editItemModal .form-group input, .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        #editItemModal .form-row {
            display: flex;
            gap: 15px;
        }
        
        #editItemModal .form-row .form-group {
            flex: 1;
        }
`;

const style = document.createElement('style');
style.textContent = additionalCSS;
document.head.appendChild(style);
window.purchaseOrderUI = new PurchaseOrderUI();
