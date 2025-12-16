export default class ReceiveUI {
    constructor() {
        this.receives = [
            {
                id: "RCV-001",
                orderId: "ORD-001",
                customer: "Ahmad Fauzi",
                date: "2023-10-15",
                status: "diterima",
                receiver: "Budi Santoso",
                notes: "Barang diterima dalam kondisi baik",
                items: [
                    { product: "Laptop ASUS ROG", ordered: 1, received: 1, warehouse: "Gudang Utama", rack: "Rak A1", purchasePrice: 15000000, status: "diterima" },
                    { product: "Mouse Gaming", ordered: 2, received: 2, warehouse: "Gudang Utama", rack: "Rak B2", purchasePrice: 350000, status: "diterima" }
                ],
                orderTotal: "Rp 15.700.000",
                orderStatus: "selesai"
            },
            {
                id: "RCV-002",
                orderId: "ORD-002",
                customer: "Siti Rahayu",
                date: "2023-10-16",
                status: "diproses",
                receiver: "Budi Santoso",
                notes: "Sedang proses penerimaan",
                items: [
                    { product: "Smartphone Samsung S23", ordered: 1, received: 0, warehouse: "", rack: "", purchasePrice: 0, status: "diproses" }
                ],
                orderTotal: "Rp 12.500.000",
                orderStatus: "dikirim"
            },
            {
                id: "RCV-003",
                orderId: "ORD-003",
                customer: "Rizki Pratama",
                date: "2023-10-14",
                status: "retur",
                receiver: "Budi Santoso",
                notes: "Ada barang yang dikembalikan",
                items: [
                    { product: "Headphone Sony", ordered: 1, received: 1, warehouse: "Gudang Utama", rack: "Rak C1", purchasePrice: 1200000, status: "diterima" },
                    { product: "Kabel USB-C", ordered: 3, received: 2, warehouse: "", rack: "", purchasePrice: 0, status: "retur" }
                ],
                orderTotal: "Rp 1.500.000",
                orderStatus: "selesai"
            }
        ];
        
        this.orders = [
            { id: "ORD-001", customer: "Ahmad Fauzi", total: "Rp 15.700.000", status: "selesai", items: [
                { product: "Laptop ASUS ROG", quantity: 1, barcode: "123456789" },
                { product: "Mouse Gaming", quantity: 2, barcode: "987654321" }
            ]},
            { id: "ORD-002", customer: "Siti Rahayu", total: "Rp 12.500.000", status: "dikirim", items: [
                { product: "Smartphone Samsung S23", quantity: 1, barcode: "456789123" }
            ]},
            { id: "ORD-003", customer: "Rizki Pratama", total: "Rp 1.500.000", status: "selesai", items: [
                { product: "Headphone Sony", quantity: 1, barcode: "789123456" },
                { product: "Kabel USB-C", quantity: 3, barcode: "321654987" }
            ]}
        ];
        
        this.currentReceive = null;
        this.currentView = 'list';
        this.scannerActive = true; 
        this.currentItem = null;
    }
    
    init() {
        this.render();
        this.renderReceiveList();
        this.updateStats();
        this.populateOrderSelect();
        this.setupEventListeners();
    }
    
    render() {
        let HTML=`
        <div class="admin-container">
        <div class="admin-content">
            <!-- Receive List View -->
            <div id="receiveListView">
                <div class="admin-header">
                    <h2 class="admin-title">Daftar Penerimaan</h2>
                    <div class="admin-actions">
                        <button class="btn btn-primary" id="addReceiveBtn">
                            <i class="fas fa-plus"></i> Terima Barang
                        </button>
                        <button class="btn btn-success">
                            <i class="fas fa-file-export"></i> Ekspor
                        </button>
                    </div>
                </div>
                
                <div class="filter-section">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label class="filter-label">Cari Penerimaan</label>
                            <input type="text" class="filter-input" id="searchReceive" placeholder="ID Penerimaan atau ID Pesanan">
                        </div>
                        <div class="filter-group">
                            <label class="filter-label">Status</label>
                            <select class="filter-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="diproses">Diproses</option>
                                <option value="diterima">Diterima</option>
                                <option value="retur">Retur</option>
                                <option value="refund">Refund</option>
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
                        <div class="stat-title">Total Penerimaan</div>
                        <div class="stat-value" id="totalReceives">0</div>
                    </div>
                    <div class="stat-card process">
                        <div class="stat-title">Dalam Proses</div>
                        <div class="stat-value" id="processingReceives">0</div>
                    </div>
                    <div class="stat-card received">
                        <div class="stat-title">Diterima</div>
                        <div class="stat-value" id="receivedReceives">0</div>
                    </div>
                    <div class="stat-card returned">
                        <div class="stat-title">Retur</div>
                        <div class="stat-value" id="returnedReceives">0</div>
                    </div>
                </div>
                
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>ID Penerimaan</th>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="receiveTableBody">
                            <!-- Receives will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Receive Detail View -->
            <div id="receiveDetailView" class="receive-detail-container">
                <div class="content-header">
                    <button class="back-button" id="backToReceiveList">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </button>
                    <h2 class="admin-title">Detail Penerimaan: <span id="detailReceiveId"></span></h2>
                </div>
                
                <div class="receive-info">
                    <div class="info-card">
                        <div class="info-card-title">Informasi Penerimaan</div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value" id="infoStatus"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Penerimaan:</span>
                            <span class="info-value" id="infoReceiveDate"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Penerima:</span>
                            <span class="info-value" id="infoReceiver"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Catatan:</span>
                            <span class="info-value" id="infoNotes"></span>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-card-title">Informasi Pesanan</div>
                        <div class="info-item">
                            <span class="info-label">ID Pesanan:</span>
                            <span class="info-value" id="infoOrderId"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Pelanggan:</span>
                            <span class="info-value" id="infoCustomer"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total Pesanan:</span>
                            <span class="info-value" id="infoOrderTotal"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status Pesanan:</span>
                            <span class="info-value" id="infoOrderStatus"></span>
                        </div>
                    </div>
                </div>
                
                <div class="tabs">
                    <div class="tab active" data-tab="items">Item Diterima</div>
                    <div class="tab" data-tab="returns">Retur</div>
                    <div class="tab" data-tab="refunds">Refund</div>
                    <div class="tab" data-tab="history">Riwayat</div>
                </div>
                
                <div id="tab-items" class="tab-content active">
                    <h3>Daftar Item Diterima</h3>
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah Dipesan</th>
                                <th>Jumlah Diterima</th>
                                <th>Lokasi Penyimpanan</th>
                                <th>Harga Beli</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="receiveItemsList">
                            <!-- Items will be populated here -->
                        </tbody>
                    </table>
                </div>
                
                <div id="tab-returns" class="tab-content">
                    <h3>Manajemen Retur</h3>
                    <button class="btn btn-warning" id="addReturnBtn">
                        <i class="fas fa-undo"></i> Ajukan Retur
                    </button>
                    
                    <div id="returnsList" style="margin-top: 20px;">
                        <!-- Returns will be populated here -->
                    </div>
                </div>
                
                <div id="tab-refunds" class="tab-content">
                    <h3>Manajemen Refund</h3>
                    <button class="btn btn-info" id="addRefundBtn">
                        <i class="fas fa-money-bill-wave"></i> Ajukan Refund
                    </button>
                    
                    <div id="refundsList" style="margin-top: 20px;">
                        <!-- Refunds will be populated here -->
                    </div>
                </div>
                
                <div id="tab-history" class="tab-content">
                    <h3>Riwayat Penerimaan</h3>
                    <div class="timeline" id="receiveTimeline">
                        <!-- Timeline will be populated here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="addReceiveModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-box-open"></i> Terima Barang</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addReceiveForm">
                        <div class="form-group">
                            <label class="form-label">Pilih Pesanan</label>
                            <select class="form-select" id="orderSelect" required>
                                <option value="">Pilih Pesanan</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="barcode-section">
                            <h3>Scan Barcode</h3>
                            <div class="barcode-input-group">
                                <input type="text" class="barcode-input" id="barcodeInput" placeholder="Scan atau masukkan barcode">
                                <button type="button" class="barcode-btn" id="startScannerBtn">
                                    <i class="fas fa-camera"></i> Scan
                                </button>
                            </div>
                            <div class="scanner-container" id="scannerContainer">
                                <div class="scanner-placeholder">
                                    <i class="fas fa-camera"></i>
                                    <p>Klik tombol Scan untuk membuka kamera</p>
                                </div>
                                <div class="scanner-overlay"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Penerima</label>
                            <input type="text" class="form-input" id="receiverInput" placeholder="Nama penerima" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-textarea" id="notesTextarea" placeholder="Catatan penerimaan"></textarea>
                        </div>
                        
                        <h3 style="margin-bottom: 15px;">Item yang Diterima</h3>
                        <div id="receiveItemsContainer">
                            <!-- Items will be populated dynamically -->
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelAddReceive">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Penerimaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Konfirmasi Penerimaan Item -->
        <div class="modal" id="confirmItemModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-check-circle"></i> Konfirmasi Penerimaan Item</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="confirmItemForm">
                        <div class="form-group">
                            <label class="form-label">Produk</label>
                            <input type="text" class="form-input" id="confirmProductName" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jumlah Diterima</label>
                            <input type="number" class="form-input" id="confirmQuantity" min="1" required>
                        </div>
                        
                        <div class="location-section">
                            <div class="form-group">
                                <label class="form-label">Gudang</label>
                                <select class="form-select" id="warehouseSelect" required>
                                    <option value="">Pilih Gudang</option>
                                    <option value="gudang1">Gudang Utama</option>
                                    <option value="gudang2">Gudang Cabang 1</option>
                                    <option value="gudang3">Gudang Cabang 2</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Rak</label>
                                <select class="form-select" id="rackSelect" required>
                                    <option value="">Pilih Rak</option>
                                    <option value="rak1">Rak A1</option>
                                    <option value="rak2">Rak A2</option>
                                    <option value="rak3">Rak B1</option>
                                    <option value="rak4">Rak B2</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="purchase-price-section">
                            <h4>Informasi Harga Beli</h4>
                            <div class="price-input-group">
                                <input type="number" class="price-input" id="purchasePrice" placeholder="Harga beli per unit" required>
                                <span style="line-height: 40px;">IDR</span>
                            </div>
                            <small>Harga beli digunakan untuk perhitungan stok dan laporan keuangan</small>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan Item</label>
                            <textarea class="form-textarea" id="itemNotes" placeholder="Catatan khusus untuk item ini"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelConfirmItem">Batal</button>
                            <button type="submit" class="btn btn-success">Konfirmasi Penerimaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Ajukan Retur -->
        <div class="modal" id="addReturnModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-undo"></i> Ajukan Retur</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addReturnForm">
                        <div class="form-group">
                            <label class="form-label">Item yang Dikembalikan</label>
                            <select class="form-select" id="returnItemSelect" required>
                                <option value="">Pilih Item</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jumlah Dikembalikan</label>
                            <input type="number" class="form-input" id="returnQuantity" min="1" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alasan Retur</label>
                            <select class="form-select" id="returnReason" required>
                                <option value="">Pilih Alasan</option>
                                <option value="rusak">Barang Rusak</option>
                                <option value="salah_kirim">Salah Kirim</option>
                                <option value="tidak_cocok">Tidak Sesuai Deskripsi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-textarea" id="returnDescription" placeholder="Keterangan tambahan"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelReturn">Batal</button>
                            <button type="submit" class="btn btn-warning">Ajukan Retur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal Ajukan Refund -->
        <div class="modal" id="addRefundModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-money-bill-wave"></i> Ajukan Refund</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addRefundForm">
                        <div class="form-group">
                            <label class="form-label">Item yang Direfund</label>
                            <select class="form-select" id="refundItemSelect" required>
                                <option value="">Pilih Item</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jumlah Refund</label>
                            <input type="number" class="form-input" id="refundAmount" min="1" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Metode Refund</label>
                            <select class="form-select" id="refundMethod" required>
                                <option value="">Pilih Metode</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="kredit">Kredit Toko</option>
                                <option value="tunai">Tunai</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alasan Refund</label>
                            <textarea class="form-textarea" id="refundReason" placeholder="Alasan refund"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelRefund">Batal</button>
                            <button type="submit" class="btn btn-info">Ajukan Refund</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        `;
        document.getElementById('pages_content').innerHTML=HTML;
    }
    
    renderReceiveList() {
        const tableBody = document.getElementById('receiveTableBody');
        tableBody.innerHTML = '';
        
        this.receives.forEach(receive => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="order-id">${receive.id}</td>
                <td>${receive.orderId}</td>
                <td>
                    <div class="customer-name">${receive.customer}</div>
                </td>
                <td class="order-date">${this.formatDate(receive.date)}</td>
                <td>
                    <span class="status-badge ${this.getStatusClass(receive.status)}">${this.getStatusText(receive.status)}</span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn btn-view" data-receive-id="${receive.id}">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                        ${receive.status === 'diterima' ? `
                            <button class="action-btn btn-return" data-receive-id="${receive.id}">
                                <i class="fas fa-undo"></i> Retur
                            </button>
                        ` : ''}
                    </div>
                </td>
            `; 
            tableBody.appendChild(row);
        });
        
        // Add event listeners to action buttons
        this.setupTableEventListeners();
    }
    
    setupTableEventListeners() {
        // View buttons
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', (e) => {
                const receiveId = e.target.closest('button').getAttribute('data-receive-id');
                this.viewReceiveDetail(receiveId);
            });
        });
        
        // Return buttons
        document.querySelectorAll('.btn-return').forEach(button => {
            button.addEventListener('click', (e) => {
                const receiveId = e.target.closest('button').getAttribute('data-receive-id');
                this.initiateReturn(receiveId);
            });
        });
    }
    
    setupDetailEventListeners() {
        // Return buttons in detail view
        document.querySelectorAll('#receiveItemsList .btn-return').forEach(button => {
            button.addEventListener('click', (e) => {
                const receiveId = this.currentReceive.id;
                const productName = e.target.closest('button').getAttribute('data-product-name');
                this.returnItem(receiveId, productName);
            });
        });
    }
    
    viewReceiveDetail(receiveId) {
        this.currentReceive = this.receives.find(r => r.id === receiveId);
        if (!this.currentReceive) return;
        
        this.showReceiveDetail();
        this.populateReceiveDetail();
        this.setupDetailEventListeners(); // Setup event listeners for detail view
    }
    
    showReceiveDetail() {
        document.getElementById('receiveListView').style.display = 'none';
        document.getElementById('receiveDetailView').style.display = 'block';
        this.currentView = 'detail';
    }
    
    showReceiveList() {
        document.getElementById('receiveDetailView').style.display = 'none';
        document.getElementById('receiveListView').style.display = 'block';
        this.currentView = 'list';
    }
    
    populateReceiveDetail() {
        if (!this.currentReceive) return;
        
        // Set basic receive info
        document.getElementById('detailReceiveId').textContent = this.currentReceive.id;
        document.getElementById('infoStatus').textContent = this.getStatusText(this.currentReceive.status);
        document.getElementById('infoReceiveDate').textContent = this.formatDate(this.currentReceive.date, true);
        document.getElementById('infoReceiver').textContent = this.currentReceive.receiver;
        document.getElementById('infoNotes').textContent = this.currentReceive.notes || '-';
        
        // Set order info
        document.getElementById('infoOrderId').textContent = this.currentReceive.orderId;
        document.getElementById('infoCustomer').textContent = this.currentReceive.customer;
        document.getElementById('infoOrderTotal').textContent = this.currentReceive.orderTotal;
        document.getElementById('infoOrderStatus').textContent = this.getStatusText(this.currentReceive.orderStatus);
        
        // Populate items
        let itemsHTML = '';
        this.currentReceive.items.forEach(item => {
            itemsHTML += `
                <tr>
                    <td>${item.product}</td>
                    <td>${item.ordered}</td>
                    <td>${item.received}</td>
                    <td>${item.warehouse ? `${item.warehouse} - ${item.rack}` : '-'}</td>
                    <td>${item.purchasePrice ? `Rp ${item.purchasePrice.toLocaleString('id-ID')}` : '-'}</td>
                    <td>
                        <span class="status-badge ${this.getStatusClass(item.status)}">
                            ${this.getStatusText(item.status)}
                        </span>
                    </td>
                    <td>
                        ${item.status === 'diterima' ? `
                            <button class="action-btn btn-return" data-product-name="${item.product}">
                                <i class="fas fa-undo"></i> Retur
                            </button>
                        ` : ''}
                    </td>
                </tr>
            `;
        });
        document.getElementById('receiveItemsList').innerHTML = itemsHTML;
    }
    
    populateOrderSelect() {
        const orderSelect = document.getElementById('orderSelect');
        let optionsHTML = '<option value="">Pilih Pesanan</option>';
        
        this.orders.forEach(order => {
            const hasReceive = this.receives.some(r => r.orderId === order.id);
            if (!hasReceive && (order.status === 'dikirim' || order.status === 'selesai')) {
                optionsHTML += `<option value="${order.id}">${order.id} - ${order.customer}</option>`;
            }
        });
        
        orderSelect.innerHTML = optionsHTML;
        
        // Add event listener to populate items when order is selected
        orderSelect.addEventListener('change', (e) => {
            this.populateReceiveItems(e.target.value);
        });
    }
    
    populateReceiveItems(orderId) {
        const order = this.orders.find(o => o.id === orderId);
        const itemsContainer = document.getElementById('receiveItemsContainer');
        
        if (!order) {
            itemsContainer.innerHTML = '';
            return;
        }
        
        let itemsHTML = '';
        order.items.forEach(item => {
            itemsHTML += `
                <div class="product-item">
                    <div class="product-info">
                        <div><strong>${item.product}</strong></div>
                        <div>Barcode: ${item.barcode}</div>
                        <div>Dipesan: ${item.quantity} pcs</div>
                    </div>
                    <div class="product-quantity">
                        <button type="button" class="btn btn-primary" data-product-name="${item.product}" data-quantity="${item.quantity}">
                            <i class="fas fa-check"></i> Konfirmasi
                        </button>
                    </div>
                </div>
            `;
        });
        
        itemsContainer.innerHTML = itemsHTML;
        
        // Add event listeners to confirm buttons
        this.setupConfirmItemButtons();
    }
    
    setupConfirmItemButtons() {
        document.querySelectorAll('#receiveItemsContainer .btn-primary').forEach(button => {
            button.addEventListener('click', (e) => {
                const productName = e.target.closest('button').getAttribute('data-product-name');
                const quantity = parseInt(e.target.closest('button').getAttribute('data-quantity'));
                this.confirmItem(productName, quantity);
            });
        });
    }
    
    confirmItem(productName, orderedQuantity) {
        this.currentItem = { productName, orderedQuantity };
        
        document.getElementById('confirmProductName').value = productName;
        document.getElementById('confirmQuantity').value = orderedQuantity;
        document.getElementById('confirmQuantity').max = orderedQuantity;
        
        this.showModal('confirmItemModal');
    }
    
    handleConfirmItem(event) {
        event.preventDefault();
        
        const productName = document.getElementById('confirmProductName').value;
        const receivedQuantity = parseInt(document.getElementById('confirmQuantity').value);
        const warehouse = document.getElementById('warehouseSelect').value;
        const rack = document.getElementById('rackSelect').value;
        const purchasePrice = parseInt(document.getElementById('purchasePrice').value);
        const itemNotes = document.getElementById('itemNotes').value;
        
        if (!productName || !receivedQuantity || !warehouse || !rack || !purchasePrice) {
            setShowAlert("Harap isi semua field yang wajib diisi!", "danger");
            return;
        }
        
        // Update the item in the receive form
        const itemsContainer = document.getElementById('receiveItemsContainer');
        const productItems = itemsContainer.querySelectorAll('.product-item');
        
        productItems.forEach(item => {
            const productInfo = item.querySelector('.product-info');
            if (productInfo.textContent.includes(productName)) {
                const status = receivedQuantity === this.currentItem.orderedQuantity ? 'diterima' : 'parsial';
                
                item.innerHTML = `
                    <div class="product-info">
                        <div><strong>${productName}</strong></div>
                        <div>Dipesan: ${this.currentItem.orderedQuantity} pcs | Diterima: ${receivedQuantity} pcs</div>
                        <div>Lokasi: ${warehouse} - ${rack}</div>
                        <div>Harga Beli: Rp ${purchasePrice.toLocaleString('id-ID')}</div>
                        <div>Status: ${this.getStatusText(status)}</div>
                        ${itemNotes ? `<div>Catatan: ${itemNotes}</div>` : ''}
                    </div>
                    <div class="product-quantity">
                        <span class="status-badge ${this.getStatusClass(status)}">${this.getStatusText(status)}</span>
                    </div>
                `;
            }
        });
        
        this.hideModal('confirmItemModal');
        document.getElementById('confirmItemForm').reset();
    }
    
    addReceive() {
        this.showModal('addReceiveModal');
    }
    
    handleAddReceive(event) {
        event.preventDefault();
        
        const orderId = document.getElementById('orderSelect').value;
        const receiver = document.getElementById('receiverInput').value;
        const notes = document.getElementById('notesTextarea').value;
        
        if (!orderId || !receiver) {
            setShowAlert("Harap isi semua field yang wajib diisi!", "danger");
            return;
        }
        
        const order = this.orders.find(o => o.id === orderId);
        if (!order) {
            setShowAlert("Pesanan tidak ditemukan!", "danger");
            return;
        }
        
        // Get received items
        const receivedItems = [];
        const productItems = document.querySelectorAll('#receiveItemsContainer .product-item');
        
        if (productItems.length === 0) {
            setShowAlert("Harap konfirmasi setidaknya satu item!", "danger");
            return;
        }
        
        let allItemsReceived = true;
        
        productItems.forEach(item => {
            const productInfo = item.querySelector('.product-info');
            const productName = productInfo.querySelector('strong').textContent;
            
            // Extract received quantity from text
            const receivedText = productInfo.textContent.match(/Diterima: (\d+) pcs/);
            const receivedQuantity = receivedText ? parseInt(receivedText[1]) : 0;
            
            // Extract warehouse and rack
            const locationText = productInfo.textContent.match(/Lokasi: (.+) - (.+)/);
            const warehouse = locationText ? locationText[1] : '';
            const rack = locationText ? locationText[2] : '';
            
            // Extract purchase price
            const priceText = productInfo.textContent.match(/Harga Beli: Rp ([\d.,]+)/);
            const purchasePrice = priceText ? parseInt(priceText[1].replace(/\./g, '')) : 0;
            
            const orderedItem = order.items.find(i => i.product === productName);
            const orderedQuantity = orderedItem ? orderedItem.quantity : 0;
            
            const status = receivedQuantity === orderedQuantity ? 'diterima' : 
                          receivedQuantity > 0 ? 'parsial' : 'ditolak';
            
            receivedItems.push({
                product: productName,
                ordered: orderedQuantity,
                received: receivedQuantity,
                warehouse: warehouse,
                rack: rack,
                purchasePrice: purchasePrice,
                status: status
            });
            
            if (receivedQuantity !== orderedQuantity) {
                allItemsReceived = false;
            }
        });
        
        // Create new receive
        const newReceive = {
            id: `RCV-${this.receives.length + 1}`,
            orderId: orderId,
            customer: order.customer,
            date: new Date().toISOString().split('T')[0],
            status: allItemsReceived ? 'diterima' : 'parsial',
            receiver: receiver,
            notes: notes,
            items: receivedItems,
            orderTotal: order.total,
            orderStatus: 'selesai'
        };
        
        this.receives.push(newReceive);
        
        this.hideModal('addReceiveModal');
        this.renderReceiveList();
        this.updateStats();
        this.populateOrderSelect();
        
        setShowAlert("Penerimaan berhasil dicatat!", "success");
    }
    
    initiateReturn(receiveId) {
        const receive = this.receives.find(r => r.id === receiveId);
        if (!receive) return;
        
        this.currentReceive = receive;
        
        // Populate return item select
        const returnItemSelect = document.getElementById('returnItemSelect');
        returnItemSelect.innerHTML = '<option value="">Pilih Item</option>';
        
        receive.items.forEach(item => {
            if (item.status === 'diterima') {
                returnItemSelect.innerHTML += `<option value="${item.product}">${item.product} (Tersedia: ${item.received})</option>`;
            }
        });
        
        this.showModal('addReturnModal');
    }
    
    handleReturn(event) {
        event.preventDefault();
        
        if (!this.currentReceive) return;
        
        const itemProduct = document.getElementById('returnItemSelect').value;
        const returnQuantity = parseInt(document.getElementById('returnQuantity').value);
        const returnReason = document.getElementById('returnReason').value;
        const returnDescription = document.getElementById('returnDescription').value;
        
        if (!itemProduct || !returnQuantity || !returnReason) {
            setShowAlert("Harap isi semua field yang wajib diisi!", "danger");
            return;
        }
        
        // Find the item in the receive
        const itemIndex = this.currentReceive.items.findIndex(i => i.product === itemProduct);
        if (itemIndex === -1) {
            setShowAlert("Item tidak ditemukan!", "danger");
            return;
        }
        
        if (returnQuantity > this.currentReceive.items[itemIndex].received) {
            setShowAlert("Jumlah retur tidak boleh lebih dari jumlah yang diterima!", "danger");
            return;
        }
        
        // Update item status
        this.currentReceive.items[itemIndex].received -= returnQuantity;
        if (this.currentReceive.items[itemIndex].received === 0) {
            this.currentReceive.items[itemIndex].status = 'retur';
        } else {
            this.currentReceive.items[itemIndex].status = 'parsial';
        }
        
        // Update receive status if all items are returned
        const allReturned = this.currentReceive.items.every(i => i.status === 'retur');
        if (allReturned) {
            this.currentReceive.status = 'retur';
        }
        
        this.hideModal('addReturnModal');
        this.populateReceiveDetail();
        this.renderReceiveList();
        this.updateStats();
        
        setShowAlert("Retur berhasil diajukan!", "success");
    }
    
    initiateRefund(receiveId) {
        const receive = this.receives.find(r => r.id === receiveId);
        if (!receive) return;
        
        this.currentReceive = receive;
        
        // Populate refund item select
        const refundItemSelect = document.getElementById('refundItemSelect');
        refundItemSelect.innerHTML = '<option value="">Pilih Item</option>';
        
        receive.items.forEach(item => {
            if (item.status === 'retur') {
                refundItemSelect.innerHTML += `<option value="${item.product}">${item.product}</option>`;
            }
        });
        
        this.showModal('addRefundModal');
    }
    
    handleRefund(event) {
        event.preventDefault();
        
        if (!this.currentReceive) return;
        
        const itemProduct = document.getElementById('refundItemSelect').value;
        const refundAmount = parseInt(document.getElementById('refundAmount').value);
        const refundMethod = document.getElementById('refundMethod').value;
        const refundReason = document.getElementById('refundReason').value;
        
        if (!itemProduct || !refundAmount || !refundMethod) {
            setShowAlert("Harap isi semua field yang wajib diisi!", "danger");
            return;
        }
        
        // Find the item in the receive
        const itemIndex = this.currentReceive.items.findIndex(i => i.product === itemProduct);
        if (itemIndex === -1) {
            setShowAlert("Item tidak ditemukan!", "danger");
            return;
        }
        
        // Update receive status
        this.currentReceive.status = 'refund';
        
        this.hideModal('addRefundModal');
        this.populateReceiveDetail();
        this.renderReceiveList();
        this.updateStats();
        
        setShowAlert("Refund berhasil diajukan!", "success");
    }
    
    returnItem(receiveId, productName) {
        this.viewReceiveDetail(receiveId);
        
        // Set the return quantity to the full amount for this item
        const receive = this.receives.find(r => r.id === receiveId);
        const item = receive.items.find(i => i.product === productName);
        
        if (item) {
            // Populate return item select
            const returnItemSelect = document.getElementById('returnItemSelect');
            returnItemSelect.innerHTML = `<option value="${item.product}">${item.product} (Tersedia: ${item.received})</option>`;
            
            document.getElementById('returnQuantity').value = item.received;
            document.getElementById('returnReason').value = 'rusak';
            document.getElementById('returnDescription').value = 'Produk rusak saat diterima';
            
            this.showModal('addReturnModal');
        }
    }
    
    toggleScanner() {
        const scannerContainer = document.getElementById('scannerContainer');
        
        if (!this.scannerActive) {
            // Simulate scanner activation
            scannerContainer.classList.add('scanner-active');
            this.scannerActive = true;
            
            // Simulate barcode detection after 2 seconds
            setTimeout(() => {
                const barcodes = ['123456789', '987654321', '456789123', '789123456', '321654987'];
                const randomBarcode = barcodes[Math.floor(Math.random() * barcodes.length)];
                document.getElementById('barcodeInput').value = randomBarcode;
                this.handleBarcodeInput();
                
                // Turn off scanner after detection
                scannerContainer.classList.remove('scanner-active');
                this.scannerActive = false;
            }, 2000);
        } else {
            scannerContainer.classList.remove('scanner-active');
            this.scannerActive = false;
        }
    }
    
    handleBarcodeInput() {
        const barcode = document.getElementById('barcodeInput').value;
        if (!barcode) return;
        
        // Find product by barcode
        let foundProduct = null;
        for (const order of this.orders) {
            for (const item of order.items) {
                if (item.barcode === barcode) {
                    foundProduct = item;
                    break;
                }
            }
            if (foundProduct) break;
        }
        
        if (foundProduct) {
            // Auto-fill the product in the receive form
            this.confirmItem(foundProduct.product, foundProduct.quantity);
        } else {
            setShowAlert("Barcode tidak dikenali!", "danger");
        }
    }
    
    switchTab(tabId) {
        // Update active tab
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelector(`.tab[data-tab="${tabId}"]`).classList.add('active');
        
        // Show corresponding content
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById(`tab-${tabId}`).classList.add('active');
    }
    
    showModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }
    
    hideModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    
    updateStats() {
        document.getElementById('totalReceives').textContent = this.receives.length;
        document.getElementById('processingReceives').textContent = this.receives.filter(r => r.status === 'diproses').length;
        document.getElementById('receivedReceives').textContent = this.receives.filter(r => r.status === 'diterima').length;
        document.getElementById('returnedReceives').textContent = this.receives.filter(r => r.status === 'retur').length;
    }
    
    formatDate(dateString, full = false) {
        const date = new Date(dateString);
        if (full) {
            return date.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
        }
        return date.toLocaleDateString('id-ID');
    }
    
    getStatusClass(status) {
        const statusClasses = {
            'diproses': 'status-processing',
            'diterima': 'status-completed',
            'parsial': 'status-warning',
            'retur': 'status-returned',
            'refund': 'status-refunded',
            'ditolak': 'status-cancelled',
            'selesai': 'status-completed',
            'dikirim': 'status-shipped'
        };
        
        return statusClasses[status] || 'status-processing';
    }
    
    getStatusText(status) {
        const statusTexts = {
            'diproses': 'Diproses',
            'diterima': 'Diterima',
            'parsial': 'Parsial',
            'retur': 'Retur',
            'refund': 'Refund',
            'ditolak': 'Ditolak',
            'selesai': 'Selesai',
            'dikirim': 'Dikirim'
        };
        
        return statusTexts[status] || 'Diproses';
    }
    
    setupEventListeners() {
        // Navigation
        document.getElementById('backToReceiveList').addEventListener('click', () => this.showReceiveList());
        
        // Modals
        document.getElementById('addReceiveBtn').addEventListener('click', () => this.addReceive());
        
        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function() {
                const modal = this.closest('.modal');
                modal.style.display = 'none';
            });
        });
        
        document.getElementById('cancelAddReceive').addEventListener('click', () => this.hideModal('addReceiveModal'));
        document.getElementById('cancelConfirmItem').addEventListener('click', () => this.hideModal('confirmItemModal'));
        document.getElementById('cancelReturn').addEventListener('click', () => this.hideModal('addReturnModal'));
        document.getElementById('cancelRefund').addEventListener('click', () => this.hideModal('addRefundModal'));
        
        // Forms
        document.getElementById('addReceiveForm').addEventListener('submit', (e) => this.handleAddReceive(e));
        document.getElementById('confirmItemForm').addEventListener('submit', (e) => this.handleConfirmItem(e));
        document.getElementById('addReturnForm').addEventListener('submit', (e) => this.handleReturn(e));
        document.getElementById('addRefundForm').addEventListener('submit', (e) => this.handleRefund(e));
        
        // Tabs
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                this.switchTab(tabId);
            }.bind(this));
        });
        
        // Barcode scanner
        document.getElementById('startScannerBtn').addEventListener('click', () => this.toggleScanner());
        document.getElementById('barcodeInput').addEventListener('input', () => this.handleBarcodeInput());
        
        // Return and refund buttons
        document.getElementById('addReturnBtn').addEventListener('click', () => {
            if (this.currentReceive) {
                this.initiateReturn(this.currentReceive.id);
            }
        });
        
        document.getElementById('addRefundBtn').addEventListener('click', () => {
            if (this.currentReceive) {
                this.initiateRefund(this.currentReceive.id);
            }
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal')) {
                e.target.style.display = 'none';
            }
        });
    }
}

// Initialize the UI
const receiveUI = new ReceiveUI();

// Make it available globally if needed
window.receiveUI = receiveUI;