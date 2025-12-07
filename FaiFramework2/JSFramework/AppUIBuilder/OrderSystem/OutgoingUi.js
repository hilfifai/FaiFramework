class OutgoingUI {
            constructor() {
                this.outgoings = orderSystemJson.outgoing;
                this.filteredOutgoings = [...this.outgoings];
                this.currentOutgoing = null;
                this.currentView = 'list'; // 'list' or 'detail'
                this.orders = orderSystemJson.list_pesanan;
                this.warehouses = orderSystemJson.gudang;
                this.inventory = orderSystemJson.inventory;
                this.products = orderSystemJson.produk;
            }
            
            init() {
                this.render();
                this.renderOutgoingList();
                this.setupEventListeners();
                this.updateStats();
                this.populateOrderSelect();
                this.populateWarehouseSelect();
            }
            
            render() {
                let HTML = `<div class="admin-content">
                <!-- Outgoing List View -->
                <div id="outgoingListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Outgoing</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="addOutgoingBtn">
                                <i class="fas fa-plus"></i> Outgoing Baru
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari Outgoing</label>
                                <input type="text" class="filter-input" id="searchOutgoing" placeholder="ID Outgoing atau ID Pesanan">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
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
                            <div class="stat-title">Total Outgoing</div>
                            <div class="stat-value" id="totalOutgoings">0</div>
                        </div>
                        <div class="stat-card process">
                            <div class="stat-title">Dalam Proses</div>
                            <div class="stat-value" id="processingOutgoings">0</div>
                        </div>
                        <div class="stat-card delivered">
                            <div class="stat-title">Selesai</div>
                            <div class="stat-value" id="completedOutgoings">0</div>
                        </div>
                        <div class="stat-card cancelled">
                            <div class="stat-title">Dibatalkan</div>
                            <div class="stat-value" id="cancelledOutgoings">0</div>
                        </div>
                    </div>
                    
                    <div class="orders-table-container">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID Outgoing</th>
                                    <th>ID Pesanan</th>
                                    <th>Gudang</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Item</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="outgoingTableBody">
                                <!-- Outgoing will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Outgoing Detail View -->
                <div id="outgoingDetailView" class="outgoing-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToOutgoingList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Outgoing: <span id="detailOutgoingId"></span></h2>
                    </div>
                    
                    <div class="outgoing-info">
                        <div class="info-card">
                            <div class="info-card-title">Informasi Outgoing</div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal Outgoing:</span>
                                <span class="info-value" id="infoOutgoingDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Gudang:</span>
                                <span class="info-value" id="infoWarehouse"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Picker:</span>
                                <span class="info-value" id="infoPicker"></span>
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
                        <div class="tab active" data-tab="items">Item Outgoing</div>
                        <div class="tab" data-tab="history">Riwayat</div>
                    </div>
                    
                    <div id="tab-items" class="tab-content active">
                        <h3>Daftar Item Outgoing</h3>
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Lokasi Rak</th>
                                    <th>Batch</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="outgoingItemsList">
                                <!-- Items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tab-history" class="tab-content">
                        <h3>Riwayat Outgoing</h3>
                        <div class="timeline" id="outgoingTimeline">
                            <!-- Timeline will be populated here -->
                        </div>
                    </div>
                </div>
            </div>
			<div class="modal" id="addOutgoingModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Tambah Outgoing Baru</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addOutgoingForm">
                        <div class="form-group">
                            <label class="form-label">Pilih Pesanan</label>
                            <select class="form-select" id="orderSelect" required>
                                <option value="">Pilih Pesanan</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Pilih Gudang</label>
                            <select class="form-select" id="warehouseSelect" required>
                                <option value="">Pilih Gudang</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Picker</label>
                            <input type="text" class="form-input" id="pickerInput" placeholder="Nama picker" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-textarea" id="notesTextarea" placeholder="Catatan outgoing"></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-danger" id="cancelAddOutgoing">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        `;
		
		document.getElementById('pages_content').innerHTML = HTML;
            }
            
            renderOutgoingList() {
                let tableHTML = '';
                
                this.filteredOutgoings.forEach(outgoing => {
                    const statusClass = this.getStatusClass(outgoing.status);
                    const statusText = this.getStatusText(outgoing.status);
                    const outgoingDate = new Date(outgoing.tanggal).toLocaleDateString('id-ID');
                    const totalItems = outgoing.items.reduce((sum, item) => sum + item.jumlah, 0);
                    
                    tableHTML += `
                        <tr>
                            <td>
                                <div class="order-id">${outgoing.id}</div>
                                <div class="order-date">${outgoingDate}</div>
                            </td>
                            <td>${outgoing.id_pesanan}</td>
                            <td>${this.getWarehouseName(outgoing.id_gudang)}</td>
                            <td>${outgoingDate}</td>
                            <td>${totalItems} item</td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-view" onclick="outgoingUI.viewOutgoingDetail('${outgoing.id}')">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button class="action-btn btn-edit" onclick="outgoingUI.editOutgoing('${outgoing.id}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                
                document.getElementById('outgoingTableBody').innerHTML = tableHTML;
            }
            
            viewOutgoingDetail(outgoingId) {
                this.currentOutgoing = this.outgoings.find(o => o.id === outgoingId);
                if (!this.currentOutgoing) return;
                
                this.showOutgoingDetail();
                this.populateOutgoingDetail();
            }
            
            showOutgoingDetail() {
                document.getElementById('outgoingListView').style.display = 'none';
                document.getElementById('outgoingDetailView').style.display = 'block';
                this.currentView = 'detail';
            }
            
            showOutgoingList() {
                document.getElementById('outgoingDetailView').style.display = 'none';
                document.getElementById('outgoingListView').style.display = 'block';
                this.currentView = 'list';
            }
            
            populateOutgoingDetail() {
                if (!this.currentOutgoing) return;
                
                // Set basic outgoing info
                document.getElementById('detailOutgoingId').textContent = this.currentOutgoing.id;
                document.getElementById('infoStatus').textContent = this.getStatusText(this.currentOutgoing.status);
                document.getElementById('infoOutgoingDate').textContent = new Date(this.currentOutgoing.tanggal).toLocaleDateString('id-ID', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('infoWarehouse').textContent = this.getWarehouseName(this.currentOutgoing.id_gudang);
                document.getElementById('infoPicker').textContent = this.currentOutgoing.picker;
                document.getElementById('infoNotes').textContent = this.currentOutgoing.catatan || '-';
                
                // Set order info
                const order = this.orders.find(o => o.id === this.currentOutgoing.id_pesanan);
                if (order) {
                    document.getElementById('infoOrderId').textContent = order.id;
                    document.getElementById('infoCustomer').textContent = order.user_detail.nama;
                    document.getElementById('infoOrderTotal').textContent = `Rp ${order.total.total.toLocaleString('id-ID')}`;
                    document.getElementById('infoOrderStatus').textContent = this.getStatusText(order.status);
                }
                
                // Populate items
                let itemsHTML = '';
                this.currentOutgoing.items.forEach(item => {
                    const product = this.products.find(p => p.id === item.id_produk);
                    itemsHTML += `
                        <tr>
                            <td>${product ? product.nama : item.id_produk}</td>
                            <td>${item.jumlah}</td>
                            <td>${item.lokasi_rak}</td>
                            <td>${item.id_batch}</td>
                            <td>
                                <span class="status-badge ${this.getStatusClass(item.status)}">
                                    ${this.getStatusText(item.status)}
                                </span>
                            </td>
                        </tr>
                    `;
                });
                document.getElementById('outgoingItemsList').innerHTML = itemsHTML;
                
                // Populate timeline
                let timelineHTML = '';
                if (this.currentOutgoing.history) {
                    this.currentOutgoing.history.forEach(event => {
                        timelineHTML += `
                            <div class="timeline-item">
                                <div class="timeline-date">${new Date(event.waktu).toLocaleDateString('id-ID')} ${new Date(event.waktu).toLocaleTimeString('id-ID')}</div>
                                <div class="timeline-content">${event.keterangan}</div>
                            </div>
                        `;
                    });
                }
                document.getElementById('outgoingTimeline').innerHTML = timelineHTML;
            }
            
            populateOrderSelect() {
                const orderSelect = document.getElementById('orderSelect');
                let optionsHTML = '<option value="">Pilih Pesanan</option>';
                
                this.orders.forEach(order => {
                    // Only show orders that don't have outgoing yet
                    const hasOutgoing = this.outgoings.some(o => o.id_pesanan === order.id);
                    if (!hasOutgoing) {
                        optionsHTML += `<option value="${order.id}">${order.id} - ${order.user_detail.nama}</option>`;
                    }
                });
                
                orderSelect.innerHTML = optionsHTML;
            }
            
            populateWarehouseSelect() {
                const warehouseSelect = document.getElementById('warehouseSelect');
                let optionsHTML = '<option value="">Pilih Gudang</option>';
                
                this.warehouses.forEach(warehouse => {
                    optionsHTML += `<option value="${warehouse.id}">${warehouse.nama}</option>`;
                });
                
                warehouseSelect.innerHTML = optionsHTML;
            }
            
            addOutgoing() {
                document.getElementById('addOutgoingModal').style.display = 'block';
            }
            
            submitOutgoingForm(event) {
                event.preventDefault();
                
                const orderId = document.getElementById('orderSelect').value;
                const warehouseId = document.getElementById('warehouseSelect').value;
                const picker = document.getElementById('pickerInput').value;
                const notes = document.getElementById('notesTextarea').value;
                
                if (!orderId || !warehouseId || !picker) {
                    alert('Harap isi semua field yang wajib diisi!');
                    return;
                }
                
                const order = this.orders.find(o => o.id === orderId);
                if (!order) {
                    alert('Pesanan tidak ditemukan!');
                    return;
                }
                
                // Create new outgoing
                const newOutgoing = {
                    id: `out-${Date.now()}`,
                    id_pesanan: orderId,
                    id_gudang: warehouseId,
                    tanggal: new Date().toISOString(),
                    status: "diproses",
                    items: [],
                    picker: picker,
                    catatan: notes,
                    history: [
                        {
                            status: "dibuat",
                            waktu: new Date().toISOString(),
                            keterangan: "Outgoing dibuat"
                        }
                    ]
                };
                
                // Add items from order
                order.produk_list.forEach(product => {
                    // Find inventory for this product in the selected warehouse
                    const inventory = this.inventory.find(inv => 
                        inv.id_produk === product.id_produk && 
                        inv.id_gudang === warehouseId &&
                        inv.stok >= product.jumlah
                    );
                    
                    if (inventory) {
                        newOutgoing.items.push({
                            id_produk: product.id_produk,
                            id_inventory: inventory.id,
                            id_batch: inventory.batch[0].id_batch,
                            jumlah: product.jumlah,
                            lokasi_rak: inventory.lokasi_rak,
                            status: "menunggu"
                        });
                    } else {
                        alert(`Stok tidak mencukupi untuk produk: ${product.nama}`);
                    }
                });
                
                if (newOutgoing.items.length === 0) {
                    alert('Tidak ada produk yang dapat ditambahkan ke outgoing. Stok tidak mencukupi.');
                    return;
                }
                
                this.outgoings.push(newOutgoing);
                this.filteredOutgoings = [...this.outgoings];
                
                this.closeModal();
                this.renderOutgoingList();
                this.updateStats();
                this.populateOrderSelect();
                
                alert('Outgoing berhasil ditambahkan!');
            }
            
            editOutgoing(outgoingId) {
                const outgoing = this.outgoings.find(o => o.id === outgoingId);
                if (outgoing) {
                    alert(`Mengedit outgoing: ${outgoingId}\nStatus saat ini: ${this.getStatusText(outgoing.status)}`);
                    // In a real application, you would open an edit form
                }
            }
            
            closeModal() {
                document.getElementById('addOutgoingModal').style.display = 'none';
                document.getElementById('addOutgoingForm').reset();
            }
            
            filterOutgoings() {
                const searchTerm = document.getElementById('searchOutgoing').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                
                this.filteredOutgoings = this.outgoings.filter(outgoing => {
                    const matchesSearch = outgoing.id.toLowerCase().includes(searchTerm) || 
                                         outgoing.id_pesanan.toLowerCase().includes(searchTerm);
                    
                    const matchesStatus = !statusFilter || outgoing.status === statusFilter;
                    
                    let matchesDate = true;
                    if (startDate) {
                        const outgoingDate = new Date(outgoing.tanggal).toISOString().split('T')[0];
                        matchesDate = outgoingDate >= startDate;
                    }
                    if (endDate && matchesDate) {
                        const outgoingDate = new Date(outgoing.tanggal).toISOString().split('T')[0];
                        matchesDate = outgoingDate <= endDate;
                    }
                    
                    return matchesSearch && matchesStatus && matchesDate;
                });
                
                this.renderOutgoingList();
                this.updateStats();
            }
            
            updateStats() {
                document.getElementById('totalOutgoings').textContent = this.outgoings.length;
                document.getElementById('processingOutgoings').textContent = this.outgoings.filter(o => o.status === 'diproses').length;
                document.getElementById('completedOutgoings').textContent = this.outgoings.filter(o => o.status === 'selesai').length;
                document.getElementById('cancelledOutgoings').textContent = this.outgoings.filter(o => o.status === 'dibatalkan').length;
            }
            
            getWarehouseName(warehouseId) {
                const warehouse = this.warehouses.find(w => w.id === warehouseId);
                return warehouse ? warehouse.nama : warehouseId;
            }
            
            getStatusClass(status) {
                const statusClasses = {
                    'dibuat': 'status-pending',
                    'diproses': 'status-processing',
                    'selesai': 'status-completed',
                    'dibatalkan': 'status-cancelled',
                    'menunggu': 'status-pending',
                    'diambil': 'status-completed'
                };
                
                return statusClasses[status] || 'status-pending';
            }
            
            getStatusText(status) {
                const statusTexts = {
                    'dibuat': 'Dibuat',
                    'diproses': 'Diproses',
                    'selesai': 'Selesai',
                    'dibatalkan': 'Dibatalkan',
                    'menunggu': 'Menunggu',
                    'diambil': 'Diambil'
                };
                
                return statusTexts[status] || 'Dibuat';
            }
            
            setupEventListeners() {
                // Filter event listeners
                document.getElementById('searchOutgoing').addEventListener('input', () => this.filterOutgoings());
                document.getElementById('statusFilter').addEventListener('change', () => this.filterOutgoings());
                document.getElementById('startDate').addEventListener('change', () => this.filterOutgoings());
                document.getElementById('endDate').addEventListener('change', () => this.filterOutgoings());
                
                // Back to list button
                document.getElementById('backToOutgoingList').addEventListener('click', () => this.showOutgoingList());
                
                // Tab functionality
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('tab')) {
                        const tabName = e.target.getAttribute('data-tab');
                        
                        // Update active tab
                        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                        e.target.classList.add('active');
                        
                        // Show corresponding content
                        document.querySelectorAll('.tab-content').forEach(content => {
                            content.classList.remove('active');
                        });
                        document.getElementById(`tab-${tabName}`).classList.add('active');
                    }
                });
                
                // Add outgoing button
                document.getElementById('addOutgoingBtn').addEventListener('click', () => this.addOutgoing());
                
                // Cancel add outgoing
                document.getElementById('cancelAddOutgoing').addEventListener('click', () => this.closeModal());
                
                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target === document.getElementById('addOutgoingModal')) {
                        this.closeModal();
                    }
                });
                
                // Close modal with X button
                document.querySelector('.close-modal').addEventListener('click', () => this.closeModal());
                
                // Submit form
                document.getElementById('addOutgoingForm').addEventListener('submit', (e) => this.submitOutgoingForm(e));
            }
        }