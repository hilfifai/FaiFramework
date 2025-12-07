export default class ReturReceiveUI {
            constructor() {
                // Sample data for receives (from Receive Management)
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
                        status: "diterima",
                        receiver: "Budi Santoso",
                        notes: "Barang diterima lengkap",
                        items: [
                            { product: "Smartphone Samsung S23", ordered: 1, received: 1, warehouse: "Gudang Utama", rack: "Rak C1", purchasePrice: 12000000, status: "diterima" }
                        ],
                        orderTotal: "Rp 12.500.000",
                        orderStatus: "selesai"
                    },
                    {
                        id: "RCV-003",
                        orderId: "ORD-003",
                        customer: "Rizki Pratama",
                        date: "2023-10-14",
                        status: "diterima",
                        receiver: "Budi Santoso",
                        notes: "Barang diterima sebagian",
                        items: [
                            { product: "Headphone Sony", ordered: 1, received: 1, warehouse: "Gudang Utama", rack: "Rak C1", purchasePrice: 1200000, status: "diterima" },
                            { product: "Kabel USB-C", ordered: 3, received: 2, warehouse: "Gudang Utama", rack: "Rak D1", purchasePrice: 50000, status: "diterima" }
                        ],
                        orderTotal: "Rp 1.500.000",
                        orderStatus: "selesai"
                    }
                ];
                
                // Sample data for returns
                this.returs = [
                    {
                        id: "RET-001",
                        receiveId: "RCV-001",
                        customer: { name: "Ahmad Fauzi", email: "ahmad@example.com", phone: "08123456789" },
                        date: "2023-10-15",
                        type: "retur",
                        status: "pending",
                        reason: "produk_rusak",
                        description: "Laptop datang dengan layar retak dan tidak bisa dinyalakan",
                        items: [
                            { product: "Laptop ASUS ROG", quantityReceived: 1, quantityReturned: 1, reason: "Layar retak", status: "pending" }
                        ],
                        totalRefund: 0,
                        history: [
                            { date: "2023-10-15", action: "Retur diajukan oleh pelanggan", user: "Ahmad Fauzi" }
                        ]
                    },
                    {
                        id: "RET-002",
                        receiveId: "RCV-002",
                        customer: { name: "Siti Rahayu", email: "siti@example.com", phone: "08234567890" },
                        date: "2023-10-12",
                        type: "refund",
                        status: "approved",
                        reason: "tidak_cocok",
                        description: "Warna smartphone tidak sesuai dengan yang diharapkan",
                        items: [
                            { product: "Smartphone Samsung S23", quantityReceived: 1, quantityReturned: 1, reason: "Warna tidak sesuai", status: "approved" }
                        ],
                        totalRefund: 8000000,
                        history: [
                            { date: "2023-10-12", action: "Retur diajukan oleh pelanggan", user: "Siti Nurhaliza" },
                            { date: "2023-10-13", action: "Retur disetujui oleh admin", user: "Admin" }
                        ]
                    },
                    {
                        id: "RET-003",
                        receiveId: "RCV-003",
                        customer: { name: "Rizki Pratama", email: "rizki@example.com", phone: "08345678901" },
                        date: "2023-10-10",
                        type: "retur",
                        status: "processing",
                        reason: "produk_salah",
                        description: "Menerima produk yang berbeda dengan pesanan",
                        items: [
                            { product: "Kabel USB-C", quantityReceived: 2, quantityReturned: 2, reason: "Produk salah", status: "processing" }
                        ],
                        totalRefund: 0,
                        history: [
                            { date: "2023-10-10", action: "Retur diajukan oleh pelanggan", user: "Rizki Pratama" },
                            { date: "2023-10-11", action: "Retur diproses oleh gudang", user: "Staff Gudang" }
                        ]
                    }
                ];
                
                this.currentRetur = null;
                this.filteredReturs = [...this.returs];
                this.currentView = 'list';
            }
            
            init() {
                this.render();
                this.renderReturList();
                this.updateStats();
                this.populateReceiveSelect();
                this.setupEventListeners();
            }
            
            render() {
				let HTML = `<div class="admin-content">
                <!-- Retur List View -->
                <div id="returListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Retur Barang</h2>
                        <div class="admin-actions">
                            <button class="btn btn-retur" id="addReturBtn">
                                <i class="fas fa-plus"></i> Ajukan Retur
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari Retur</label>
                                <input type="text" class="filter-input" id="searchRetur" placeholder="ID Retur atau ID Pesanan">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Menunggu</option>
                                    <option value="processing">Diproses</option>
                                    <option value="approved">Disetujui</option>
                                    <option value="completed">Selesai</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Jenis</label>
                                <select class="filter-select" id="typeFilter">
                                    <option value="">Semua Jenis</option>
                                    <option value="retur">Retur Barang</option>
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
                            <div class="stat-title">Total Retur</div>
                            <div class="stat-value" id="totalReturs">0</div>
                        </div>
                        <div class="stat-card pending">
                            <div class="stat-title">Menunggu</div>
                            <div class="stat-value" id="pendingReturs">0</div>
                        </div>
                        <div class="stat-card process">
                            <div class="stat-title">Diproses</div>
                            <div class="stat-value" id="processingReturs">0</div>
                        </div>
                        <div class="stat-card completed">
                            <div class="stat-title">Selesai</div>
                            <div class="stat-value" id="completedReturs">0</div>
                        </div>
                    </div>
                    
                    <div class="orders-table-container">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID Retur</th>
                                    <th>ID Receive</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="returTableBody">
                                <!-- Returs will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Retur Detail View -->
                <div id="returDetailView" class="retur-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToReturList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Retur: <span id="detailReturId"></span></h2>
                        <div class="admin-actions">
                            <button class="btn btn-approve" id="approveReturBtn">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                            <button class="btn btn-reject" id="rejectReturBtn">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                            <button class="btn btn-process" id="processReturBtn">
                                <i class="fas fa-cog"></i> Proses
                            </button>
                        </div>
                    </div>
                    
                    <div class="retur-info">
                        <div class="info-card">
                            <div class="info-card-title">Informasi Retur</div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal Retur:</span>
                                <span class="info-value" id="infoReturDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Jenis Retur:</span>
                                <span class="info-value" id="infoReturType"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alasan:</span>
                                <span class="info-value" id="infoReason"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Deskripsi:</span>
                                <span class="info-value" id="infoDescription"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Receive</div>
                            <div class="info-item">
                                <span class="info-label">ID Receive:</span>
                                <span class="info-value" id="infoReceiveId"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pelanggan:</span>
                                <span class="info-value" id="infoCustomer"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal Receive:</span>
                                <span class="info-value" id="infoReceiveDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status Receive:</span>
                                <span class="info-value" id="infoReceiveStatus"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tabs">
                        <div class="tab active" data-tab="items">Item Retur</div>
                        <div class="tab" data-tab="actions">Tindakan</div>
                        <div class="tab" data-tab="history">Riwayat</div>
                    </div>
                    
                    <div id="tab-items" class="tab-content active">
                        <h3>Daftar Item yang Dikembalikan</h3>
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah Diterima</th>
                                    <th>Jumlah Dikembalikan</th>
                                    <th>Alasan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="returItemsList">
                                <!-- Items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tab-actions" class="tab-content">
                        <h3>Tindakan Retur</h3>
                        
                        <div class="scan-section">
                            <h4>Scan Barang Retur</h4>
                            <div class="scanner-container">
                                <div class="scanner-preview">
                                    <div class="scanner-placeholder">
                                        <i class="fas fa-qrcode"></i>
                                        <p>Aktifkan scanner untuk memindai barcode barang retur</p>
                                    </div>
                                </div>
                                <div class="scanner-controls">
                                    <button class="btn btn-primary" id="startScanner">
                                        <i class="fas fa-camera"></i> Mulai Scan
                                    </button>
                                    <button class="btn btn-danger" id="stopScanner" disabled>
                                        <i class="fas fa-stop"></i> Stop Scan
                                    </button>
                                </div>
                                <div class="scanner-input">
                                    <input type="text" id="manualBarcode" placeholder="Masukkan barcode manual">
                                    <button class="btn btn-info" id="addManualBarcode">
                                        <i class="fas fa-keyboard"></i> Tambah Manual
                                    </button>
                                </div>
                            </div>
                            
                            <div class="scan-result" id="scanResult" style="display: none;">
                                <div class="product-info">
                                    <div class="product-image">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="product-details">
                                        <div class="product-name" id="scannedProductName">Nama Produk</div>
                                        <div class="product-barcode" id="scannedProductBarcode">Barcode: </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Kondisi Barang</label>
                                    <select class="form-select" id="itemCondition">
                                        <option value="baik">Baik (Bisa dijual kembali)</option>
                                        <option value="rusak_ringan">Rusak Ringan (Perbaikan)</option>
                                        <option value="rusak_berat">Rusak Berat (Disposal)</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Tindakan</label>
                                    <select class="form-select" id="itemAction">
                                        <option value="ganti">Ganti Barang</option>
                                        <option value="refund">Refund</option>
                                        <option value="perbaikan">Perbaikan</option>
                                        <option value="disposal">Disposal</option>
                                    </select>
                                </div>
                                
                                <div class="form-actions">
                                    <button class="btn btn-success" id="confirmScan">
                                        <i class="fas fa-check"></i> Konfirmasi
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan Tindakan</label>
                            <textarea class="form-textarea" id="actionNotes" placeholder="Catatan proses retur"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn btn-success" id="completeAction">
                                <i class="fas fa-check"></i> Selesaikan Tindakan
                            </button>
                        </div>
                    </div>
                    
                    <div id="tab-history" class="tab-content">
                        <h3>Riwayat Retur</h3>
                        <div class="timeline" id="returTimeline">
                            <!-- Timeline will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal" id="addReturModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-undo"></i> Ajukan Retur Barang</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addReturForm">
                        <div class="form-group">
                            <label class="form-label">Pilih Receive</label>
                            <select class="form-select" id="receiveSelect" required>
                                <option value="">Pilih Receive</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alasan Retur</label>
                            <select class="form-select" id="returReason" required>
                                <option value="">Pilih Alasan Retur</option>
                                <option value="produk_rusak">Produk Rusak</option>
                                <option value="produk_salah">Produk Salah</option>
                                <option value="tidak_cocok">Tidak Cocok</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Deskripsi Detail</label>
                            <textarea class="form-textarea" id="returDescription" placeholder="Jelaskan detail kondisi produk dan alasan retur" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Jenis Retur</label>
                            <select class="form-select" id="returType" required>
                                <option value="">Pilih Jenis Retur</option>
                                <option value="retur">Retur Barang</option>
                                <option value="refund">Refund</option>
                            </select>
                        </div>
                        
                        <h3 style="margin-bottom: 15px;">Item yang Dikembalikan</h3>
                        <div id="returItemsContainer">
                            <!-- Items will be populated dynamically -->
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelAddRetur">Batal</button>
                            <button type="submit" class="btn btn-retur">Ajukan Retur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        `;
			}
            
            renderReturList() {
                const tableBody = document.getElementById('returTableBody');
                tableBody.innerHTML = '';
                
                this.filteredReturs.forEach(retur => {
                    const statusClass = this.getStatusClass(retur.status);
                    const statusText = this.getStatusText(retur.status);
                    const returDate = new Date(retur.date).toLocaleDateString('id-ID');
                    const typeClass = retur.type === 'retur' ? 'type-retur' : 'type-refund';
                    const typeText = retur.type === 'retur' ? 'Retur' : 'Refund';
                    
                    tableBody.innerHTML += `
                        <tr>
                            <td>
                                <div class="order-id">${retur.id}</div>
                                <div class="order-date">${returDate}</div>
                            </td>
                            <td>${retur.receiveId}</td>
                            <td>
                                <div class="customer-name">${retur.customer.name}</div>
                                <div class="customer-email">${retur.customer.email}</div>
                            </td>
                            <td>${returDate}</td>
                            <td>
                                <span class="type-badge ${typeClass}">${typeText}</span>
                            </td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-view" onclick="returReceiveUI.viewReturDetail('${retur.id}')">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    ${retur.status === 'pending' ? `
                                        <button class="action-btn btn-approve" onclick="returReceiveUI.approveReturFromList('${retur.id}')">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                        <button class="action-btn btn-reject" onclick="returReceiveUI.rejectReturFromList('${retur.id}')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    ` : ''}
                                    ${retur.status === 'approved' ? `
                                        <button class="action-btn btn-process" onclick="returReceiveUI.processReturFromList('${retur.id}')">
                                            <i class="fas fa-cog"></i> Proses
                                        </button>
                                    ` : ''}
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }
            
            viewReturDetail(returId) {
                this.currentRetur = this.returs.find(r => r.id === returId);
                if (!this.currentRetur) return;
                
                this.showReturDetail();
                this.populateReturDetail();
            }
            
            showReturDetail() {
                document.getElementById('returListView').style.display = 'none';
                document.getElementById('returDetailView').style.display = 'block';
                this.currentView = 'detail';
            }
            
            showReturList() {
                document.getElementById('returDetailView').style.display = 'none';
                document.getElementById('returListView').style.display = 'block';
                this.currentView = 'list';
            }
            
            populateReturDetail() {
                if (!this.currentRetur) return;
                
                // Set basic retur info
                document.getElementById('detailReturId').textContent = this.currentRetur.id;
                document.getElementById('infoStatus').textContent = this.getStatusText(this.currentRetur.status);
                document.getElementById('infoReturDate').textContent = new Date(this.currentRetur.date).toLocaleDateString('id-ID', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('infoReturType').textContent = this.currentRetur.type === 'retur' ? 'Retur Barang' : 'Refund';
                document.getElementById('infoReason').textContent = this.getReasonText(this.currentRetur.reason);
                document.getElementById('infoDescription').textContent = this.currentRetur.description;
                
                // Set receive info
                const receive = this.receives.find(r => r.id === this.currentRetur.receiveId);
                if (receive) {
                    document.getElementById('infoReceiveId').textContent = receive.id;
                    document.getElementById('infoCustomer').textContent = receive.customer;
                    document.getElementById('infoReceiveDate').textContent = new Date(receive.date).toLocaleDateString('id-ID');
                    document.getElementById('infoReceiveStatus').textContent = this.getStatusText(receive.status);
                }
                
                // Populate items
                let itemsHTML = '';
                this.currentRetur.items.forEach(item => {
                    itemsHTML += `
                        <tr>
                            <td>${item.product}</td>
                            <td>${item.quantityReceived}</td>
                            <td>${item.quantityReturned}</td>
                            <td>${item.reason}</td>
                            <td>
                                <span class="status-badge ${this.getStatusClass(item.status)}">
                                    ${this.getStatusText(item.status)}
                                </span>
                            </td>
                            <td>
                                ${item.status === 'pending' ? `
                                    <button class="action-btn btn-approve" onclick="returReceiveUI.approveReturItem('${this.currentRetur.id}', '${item.product}')">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                ` : ''}
                            </td>
                        </tr>
                    `;
                });
                document.getElementById('returItemsList').innerHTML = itemsHTML;
                
                // Populate timeline
                let timelineHTML = '';
                if (this.currentRetur.history) {
                    this.currentRetur.history.forEach(event => {
                        timelineHTML += `
                            <div class="timeline-item">
                                <div class="timeline-date">${new Date(event.date).toLocaleDateString('id-ID')}</div>
                                <div class="timeline-content">${event.action} oleh ${event.user}</div>
                            </div>
                        `;
                    });
                }
                document.getElementById('returTimeline').innerHTML = timelineHTML;
                
                // Update action buttons visibility based on status
                this.updateActionButtons();
            }
            
            updateActionButtons() {
                if (!this.currentRetur) return;
                
                const status = this.currentRetur.status;
                document.getElementById('approveReturBtn').style.display = status === 'pending' ? 'flex' : 'none';
                document.getElementById('rejectReturBtn').style.display = status === 'pending' ? 'flex' : 'none';
                document.getElementById('processReturBtn').style.display = status === 'approved' ? 'flex' : 'none';
            }
            
            populateReceiveSelect() {
                const receiveSelect = document.getElementById('receiveSelect');
                let optionsHTML = '<option value="">Pilih Receive</option>';
                
                // Only show receives that are completed and don't have retur yet
                this.receives.forEach(receive => {
                    const hasRetur = this.returs.some(r => r.receiveId === receive.id);
                    if (!hasRetur && receive.status === 'diterima') {
                        optionsHTML += `<option value="${receive.id}">${receive.id} - ${receive.customer}</option>`;
                    }
                });
                
                receiveSelect.innerHTML = optionsHTML;
                
                // Add event listener to populate items when receive is selected
                receiveSelect.addEventListener('change', (e) => {
                    this.populateReturItems(e.target.value);
                });
            }
            
            populateReturItems(receiveId) {
                const receive = this.receives.find(r => r.id === receiveId);
                const itemsContainer = document.getElementById('returItemsContainer');
                
                if (!receive) {
                    itemsContainer.innerHTML = '';
                    return;
                }
                
                let itemsHTML = '';
                receive.items.forEach(item => {
                    // Calculate available quantity for return (received - already returned)
                    const existingReturs = this.returs.filter(r => r.receiveId === receiveId);
                    let alreadyReturned = 0;
                    
                    existingReturs.forEach(retur => {
                        const returItem = retur.items.find(i => i.product === item.product);
                        if (returItem) {
                            alreadyReturned += returItem.quantityReturned;
                        }
                    });
                    
                    const availableForReturn = item.received - alreadyReturned;
                    
                    if (availableForReturn > 0) {
                        itemsHTML += `
                            <div class="product-item">
                                <div class="product-info">
                                    <div><strong>${item.product}</strong></div>
                                    <div>Diterima: ${item.received} pcs | Tersedia untuk retur: ${availableForReturn} pcs</div>
                                </div>
                                <div class="product-quantity">
                                    <label class="form-label">Jumlah Retur</label>
                                    <input type="number" class="quantity-input" name="return_${item.product}" 
                                        value="0" min="0" max="${availableForReturn}" required
                                        onchange="returReceiveUI.validateQuantity(this, ${availableForReturn})">
                                    <div class="validation-error" id="error_${item.product.replace(/\s+/g, '_')}">
                                        Jumlah retur tidak boleh melebihi ${availableForReturn} pcs
                                    </div>
                                </div>
                                <div class="product-info">
                                    <label class="form-label">Alasan Retur</label>
                                    <select class="form-select" name="reason_${item.product}" required>
                                        <option value="">Pilih Alasan</option>
                                        <option value="produk_rusak">Produk Rusak</option>
                                        <option value="produk_salah">Produk Salah</option>
                                        <option value="tidak_cocok">Tidak Cocok</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        `;
                    }
                });
                
                itemsContainer.innerHTML = itemsHTML;
            }
            
            validateQuantity(input, maxQuantity) {
                const value = parseInt(input.value);
                const productName = input.name.replace('return_', '');
                const errorElement = document.getElementById(`error_${productName.replace(/\s+/g, '_')}`);
                
                if (value > maxQuantity) {
                    errorElement.classList.add('show');
                    input.style.borderColor = 'var(--danger)';
                } else {
                    errorElement.classList.remove('show');
                    input.style.borderColor = '#ddd';
                }
            }
            
            addRetur() {
                this.showModal('addReturModal');
            }
            
            handleAddRetur(event) {
                event.preventDefault();
                
                const receiveId = document.getElementById('receiveSelect').value;
                const reason = document.getElementById('returReason').value;
                const description = document.getElementById('returDescription').value;
                const type = document.getElementById('returType').value;
                
                if (!receiveId || !reason || !description || !type) {
                    alert('Harap isi semua field yang wajib diisi!');
                    return;
                }
                
                const receive = this.receives.find(r => r.id === receiveId);
                if (!receive) {
                    alert('Receive tidak ditemukan!');
                    return;
                }
                
                // Get retur items
                const returItems = [];
                let hasValidItems = false;
                
                receive.items.forEach(item => {
                    const returQtyInput = document.querySelector(`input[name="return_${item.product}"]`);
                    if (!returQtyInput) return;
                    
                    const returQty = parseInt(returQtyInput.value) || 0;
                    const returReason = document.querySelector(`select[name="reason_${item.product}"]`).value;
                    
                    // Validate quantity
                    const existingReturs = this.returs.filter(r => r.receiveId === receiveId);
                    let alreadyReturned = 0;
                    
                    existingReturs.forEach(retur => {
                        const returItem = retur.items.find(i => i.product === item.product);
                        if (returItem) {
                            alreadyReturned += returItem.quantityReturned;
                        }
                    });
                    
                    const availableForReturn = item.received - alreadyReturned;
                    
                    if (returQty > 0) {
                        if (returQty > availableForReturn) {
                            alert(`Jumlah retur untuk ${item.product} melebihi jumlah yang tersedia (${availableForReturn} pcs)`);
                            return;
                        }
                        
                        if (!returReason) {
                            alert(`Harap pilih alasan retur untuk ${item.product}`);
                            return;
                        }
                        
                        returItems.push({
                            product: item.product,
                            quantityReceived: item.received,
                            quantityReturned: returQty,
                            reason: returReason,
                            status: 'pending'
                        });
                        
                        hasValidItems = true;
                    }
                });
                
                if (!hasValidItems) {
                    alert('Tidak ada item yang dikembalikan!');
                    return;
                }
                
                // Create new retur
                const newRetur = {
                    id: `RET-${String(this.returs.length + 1).padStart(3, '0')}`,
                    receiveId: receiveId,
                    customer: { name: receive.customer, email: '', phone: '' },
                    date: new Date().toISOString().split('T')[0],
                    type: type,
                    status: 'pending',
                    reason: reason,
                    description: description,
                    items: returItems,
                    totalRefund: 0,
                    history: [
                        {
                            date: new Date().toISOString().split('T')[0],
                            action: "Retur diajukan",
                            user: "Pelanggan"
                        }
                    ]
                };
                
                this.returs.push(newRetur);
                this.filteredReturs = [...this.returs];
                
                this.hideModal('addReturModal');
                this.renderReturList();
                this.updateStats();
                this.populateReceiveSelect();
                
                alert('Retur berhasil diajukan!');
            }
            
            approveRetur() {
                if (!this.currentRetur) return;
                
                if (confirm(`Setujui retur ${this.currentRetur.id}?`)) {
                    this.currentRetur.status = 'approved';
                    this.currentRetur.history.push({
                        date: new Date().toISOString().split('T')[0],
                        action: "Retur disetujui",
                        user: "Admin"
                    });
                    
                    // Update all items to approved
                    this.currentRetur.items.forEach(item => {
                        item.status = 'approved';
                    });
                    
                    this.renderReturList();
                    this.updateStats();
                    this.populateReturDetail();
                    
                    alert('Retur berhasil disetujui!');
                }
            }
            
            rejectRetur() {
                if (!this.currentRetur) return;
                
                const reason = prompt('Masukkan alasan penolakan:');
                if (reason) {
                    this.currentRetur.status = 'rejected';
                    this.currentRetur.history.push({
                        date: new Date().toISOString().split('T')[0],
                        action: `Retur ditolak: ${reason}`,
                        user: "Admin"
                    });
                    
                    this.renderReturList();
                    this.updateStats();
                    this.populateReturDetail();
                    
                    alert('Retur berhasil ditolak!');
                }
            }
            
            processRetur() {
                if (!this.currentRetur) return;
                
                if (confirm(`Proses retur ${this.currentRetur.id}?`)) {
                    this.currentRetur.status = 'processing';
                    this.currentRetur.history.push({
                        date: new Date().toISOString().split('T')[0],
                        action: "Retur diproses oleh gudang",
                        user: "Staff Gudang"
                    });
                    
                    this.renderReturList();
                    this.updateStats();
                    this.populateReturDetail();
                    
                    alert('Retur sedang diproses!');
                }
            }
            
            approveReturFromList(returId) {
                this.currentRetur = this.returs.find(r => r.id === returId);
                if (this.currentRetur) {
                    this.approveRetur();
                }
            }
            
            rejectReturFromList(returId) {
                this.currentRetur = this.returs.find(r => r.id === returId);
                if (this.currentRetur) {
                    this.rejectRetur();
                }
            }
            
            processReturFromList(returId) {
                this.currentRetur = this.returs.find(r => r.id === returId);
                if (this.currentRetur) {
                    this.processRetur();
                }
            }
            
            approveReturItem(returId, productName) {
                const retur = this.returs.find(r => r.id === returId);
                if (retur) {
                    const item = retur.items.find(i => i.product === productName);
                    if (item) {
                        item.status = 'approved';
                        
                        // Check if all items are approved
                        const allApproved = retur.items.every(i => i.status === 'approved');
                        if (allApproved && retur.status === 'pending') {
                            retur.status = 'approved';
                            retur.history.push({
                                date: new Date().toISOString().split('T')[0],
                                action: "Semua item retur disetujui",
                                user: "Admin"
                            });
                        }
                        
                        this.renderReturList();
                        this.updateStats();
                        
                        if (this.currentRetur && this.currentRetur.id === returId) {
                            this.populateReturDetail();
                        }
                        
                        alert('Item retur berhasil disetujui!');
                    }
                }
            }
            
            filterReturs() {
                const searchTerm = document.getElementById('searchRetur').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;
                const typeFilter = document.getElementById('typeFilter').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                
                this.filteredReturs = this.returs.filter(retur => {
                    const matchesSearch = retur.id.toLowerCase().includes(searchTerm) || 
                                         retur.receiveId.toLowerCase().includes(searchTerm);
                    
                    const matchesStatus = !statusFilter || retur.status === statusFilter;
                    const matchesType = !typeFilter || retur.type === typeFilter;
                    
                    let matchesDate = true;
                    if (startDate) {
                        matchesDate = retur.date >= startDate;
                    }
                    if (endDate && matchesDate) {
                        matchesDate = retur.date <= endDate;
                    }
                    
                    return matchesSearch && matchesStatus && matchesType && matchesDate;
                });
                
                this.renderReturList();
                this.updateStats();
            }
            
            updateStats() {
                document.getElementById('totalReturs').textContent = this.returs.length;
                document.getElementById('pendingReturs').textContent = this.returs.filter(r => r.status === 'pending').length;
                document.getElementById('processingReturs').textContent = this.returs.filter(r => r.status === 'processing').length;
                document.getElementById('completedReturs').textContent = this.returs.filter(r => r.status === 'completed').length;
            }
            
            getStatusClass(status) {
                const statusClasses = {
                    'pending': 'status-pending',
                    'processing': 'status-processing',
                    'approved': 'status-approved',
                    'completed': 'status-completed',
                    'rejected': 'status-rejected',
                    'diterima': 'status-completed'
                };
                
                return statusClasses[status] || 'status-pending';
            }
            
            getStatusText(status) {
                const statusTexts = {
                    'pending': 'Menunggu',
                    'processing': 'Diproses',
                    'approved': 'Disetujui',
                    'completed': 'Selesai',
                    'rejected': 'Ditolak',
                    'diterima': 'Diterima'
                };
                
                return statusTexts[status] || 'Menunggu';
            }
            
            getReasonText(reason) {
                const reasonTexts = {
                    'produk_rusak': 'Produk Rusak',
                    'produk_salah': 'Produk Salah',
                    'tidak_cocok': 'Tidak Cocok',
                    'lainnya': 'Lainnya'
                };
                
                return reasonTexts[reason] || 'Lainnya';
            }
            
            showModal(modalId) {
                document.getElementById(modalId).style.display = 'block';
            }
            
            hideModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
                document.getElementById('addReturForm').reset();
                document.getElementById('returItemsContainer').innerHTML = '';
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
            
            setupEventListeners() {
                // Navigation
                document.getElementById('backToReturList').addEventListener('click', () => this.showReturList());
                
                // Modals
                document.getElementById('addReturBtn').addEventListener('click', () => this.addRetur());
                
                document.querySelectorAll('.close-modal').forEach(button => {
                    button.addEventListener('click', function() {
                        const modal = this.closest('.modal');
                        modal.style.display = 'none';
                    });
                });
                
                document.getElementById('cancelAddRetur').addEventListener('click', () => this.hideModal('addReturModal'));
                
                // Forms
                document.getElementById('addReturForm').addEventListener('submit', (e) => this.handleAddRetur(e));
                
                // Tabs
                document.querySelectorAll('.tab').forEach(tab => {
                    tab.addEventListener('click', function() {
                        const tabId = this.getAttribute('data-tab');
                        returReceiveUI.switchTab(tabId);
                    });
                });
                
                // Filter events
                document.getElementById('searchRetur').addEventListener('input', () => this.filterReturs());
                document.getElementById('statusFilter').addEventListener('change', () => this.filterReturs());
                document.getElementById('typeFilter').addEventListener('change', () => this.filterReturs());
                document.getElementById('startDate').addEventListener('change', () => this.filterReturs());
                document.getElementById('endDate').addEventListener('change', () => this.filterReturs());
                
                // Retur action buttons
                document.getElementById('approveReturBtn').addEventListener('click', () => this.approveRetur());
                document.getElementById('rejectReturBtn').addEventListener('click', () => this.rejectRetur());
                document.getElementById('processReturBtn').addEventListener('click', () => this.processRetur());
                
                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target.classList.contains('modal')) {
                        e.target.style.display = 'none';
                    }
                });
                
                // Scanner functionality (placeholder)
                this.setupScanner();
            }
            
            setupScanner() {
                // In a real application, this would integrate with a barcode scanner library
                const startScannerBtn = document.getElementById('startScanner');
                const stopScannerBtn = document.getElementById('stopScanner');
                const addManualBarcodeBtn = document.getElementById('addManualBarcode');
                const confirmScanBtn = document.getElementById('confirmScan');
                
                startScannerBtn.addEventListener('click', () => {
                    alert('Scanner diaktifkan. Arahkan kamera ke barcode produk.');
                    startScannerBtn.disabled = true;
                    stopScannerBtn.disabled = false;
                    
                    // Simulate scanning after 2 seconds
                    setTimeout(() => {
                        if (this.currentRetur && this.currentRetur.items.length > 0) {
                            const randomItem = this.currentRetur.items[Math.floor(Math.random() * this.currentRetur.items.length)];
                            document.getElementById('scannedProductName').textContent = randomItem.product;
                            document.getElementById('scannedProductBarcode').textContent = `Barcode: ${randomItem.product.replace(/\s+/g, '').toUpperCase()}`;
                            document.getElementById('scanResult').style.display = 'block';
                        }
                    }, 2000);
                });
                
                stopScannerBtn.addEventListener('click', () => {
                    startScannerBtn.disabled = false;
                    stopScannerBtn.disabled = true;
                    document.getElementById('scanResult').style.display = 'none';
                    alert('Scanner dinonaktifkan.');
                });
                
                addManualBarcodeBtn.addEventListener('click', () => {
                    const barcode = document.getElementById('manualBarcode').value;
                    if (barcode) {
                        // Find product by barcode (simulated)
                        if (this.currentRetur && this.currentRetur.items.length > 0) {
                            const item = this.currentRetur.items.find(i => 
                                i.product.replace(/\s+/g, '').toUpperCase() === barcode.toUpperCase()
                            );
                            if (item) {
                                document.getElementById('scannedProductName').textContent = item.product;
                                document.getElementById('scannedProductBarcode').textContent = `Barcode: ${barcode}`;
                                document.getElementById('scanResult').style.display = 'block';
                            } else {
                                alert('Produk tidak ditemukan dalam retur ini.');
                            }
                        }
                    } else {
                        alert('Masukkan kode barcode terlebih dahulu.');
                    }
                });
                
                confirmScanBtn.addEventListener('click', () => {
                    const condition = document.getElementById('itemCondition').value;
                    const action = document.getElementById('itemAction').value;
                    
                    alert(`Produk telah dikonfirmasi. Kondisi: ${condition}, Tindakan: ${action}`);
                    document.getElementById('scanResult').style.display = 'none';
                    document.getElementById('manualBarcode').value = '';
                });
            }
        }