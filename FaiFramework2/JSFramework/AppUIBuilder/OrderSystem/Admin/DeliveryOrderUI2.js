export default class DeliveryOrderUI {
            constructor() {
                
            }
            
            init(config) {
				this.config = config;
				this.orders = this.config.orderSystemJson.list_pesanan;
                this.filteredOrders = [...this.orders];
                this.currentOrder = null;
                this.currentView = 'list'; // 'list' or 'detail'
                this.products = this.config.orderSystemJson.produk;
                this.stream = null;
                this.scannedResi = '';   
				 
                this.render();
                this.renderDeliveryList();
                this.setupEventListeners();
                this.updateStats();
            }  
            render() {
                let HTML = `
				<div class="admin-container">
				<div class="admin-content">
                <!-- Delivery List View -->
                <div id="deliveryListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Pengiriman</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="scanResiBtn">
                                <i class="fas fa-qrcode"></i> Scan Resi
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari Pengiriman</label>
                                <input type="text" class="filter-input" id="searchDelivery" placeholder="ID Pesanan atau No. Resi">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="deliveryStatusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Menunggu</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="dikirim">Dikirim</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Kurir</label>
                                <select class="filter-select" id="courierFilter">
                                    <option value="">Semua Kurir</option>
                                    <option value="JNE">JNE</option>
                                    <option value="TIKI">TIKI</option>
                                    <option value="POS">POS Indonesia</option>
                                    <option value="J&T">J&T</option>
                                    <option value="SiCepat">SiCepat</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Tanggal</label>
                                <input type="date" class="filter-input" id="deliveryDate">
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-title">Total Pengiriman</div>
                            <div class="stat-value" id="totalDeliveries">0</div>
                        </div>
                        <div class="stat-card process">
                            <div class="stat-title">Menunggu</div>
                            <div class="stat-value" id="pendingDeliveries">0</div>
                        </div>
                        <div class="stat-card received">
                            <div class="stat-title">Dikirim</div>
                            <div class="stat-value" id="shippedDeliveries">0</div>
                        </div>
                        <div class="stat-card returned">
                            <div class="stat-title">Diterima</div>
                            <div class="stat-value" id="deliveredDeliveries">0</div>
                        </div>
                    </div>
                    
                    <div class="orders-table-container">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Kurir & Resi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="deliveryTableBody">
                                <!-- Deliveries will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Delivery Detail View -->
                <div id="deliveryDetailView" class="receive-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToDeliveryList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Pengiriman: <span id="detailOrderId"></span></h2>
                    </div>
                    
                    <div class="delivery-info-grid">
                        <div class="delivery-card">
                            <div class="info-card-title">Informasi Pengiriman</div>
                            <div class="delivery-status">
                                <div class="status-dot" id="statusDot"></div>
                                <span class="info-value" id="infoDeliveryStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kurir:</span>
                                <span class="info-value" id="infoCourier"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Resi:</span>
                                <span class="info-value resi-info" id="infoResi"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Layanan:</span>
                                <span class="info-value" id="infoService"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Estimasi:</span>
                                <span class="info-value" id="infoEstimation"></span>
                            </div>
                        </div>
                        
                        <div class="delivery-card">
                            <div class="info-card-title">Informasi Penerima</div>
                            <div class="info-item">
                                <span class="info-label">Nama:</span>
                                <span class="info-value" id="infoRecipient"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Telepon:</span>
                                <span class="info-value" id="infoRecipientPhone"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Alamat:</span>
                                <span class="info-value" id="infoRecipientAddress"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tabs">
                        <div class="tab active" data-tab="items">Item Dikirim</div>
                        <div class="tab" data-tab="tracking">Lacak Pengiriman</div>
                        <div class="tab" data-tab="actions">Aksi</div>
                    </div>
                    
                    <div id="tab-items" class="tab-content active">
                        <h3>Daftar Item Dikirim</h3>
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="deliveryItemsList">
                                <!-- Items will be populated here -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="tab-tracking" class="tab-content">
                        <h3>Lacak Pengiriman</h3>
                        <div class="shipping-timeline" id="deliveryTimeline">
                            <!-- Timeline will be populated here -->
                        </div>
                        
                        <div class="delivery-map">
                            <i class="fas fa-map-marker-alt" style="font-size: 48px; margin-right: 15px;"></i>
                            <div>
                                <h4>Peta Pengiriman</h4>
                                <p>Fitur pelacakan lokasi real-time</p>
                            </div>
                        </div>
                    </div>
                    
                    <div id="tab-actions" class="tab-content">
                        <h3>Aksi Pengiriman</h3>
                        <div class="delivery-actions">
                            <button class="btn btn-primary" id="processDeliveryBtn">
                                <i class="fas fa-cog"></i> Proses Pengiriman
                            </button>
                            <button class="btn btn-warning" id="scanResiDetailBtn">
                                <i class="fas fa-qrcode"></i> Scan Resi
                            </button>
                            <button class="btn btn-success" id="markAsShippedBtn">
                                <i class="fas fa-shipping-fast"></i> Tandai Dikirim
                            </button>
                            <button class="btn btn-info" id="updateTrackingBtn">
                                <i class="fas fa-sync"></i> Update Tracking
                            </button>
                            <button class="btn btn-danger" id="cancelDeliveryBtn">
                                <i class="fas fa-times"></i> Batalkan
                            </button>
                        </div>
                        
                        <div class="scan-container" style="margin-top: 20px;">
                            <input type="text" class="scan-input" id="manualResiInput" placeholder="Masukkan nomor resi manual">
                            <button class="scan-btn" id="submitResiBtn">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
       <div class="modal" id="scanResiModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-qrcode"></i> Scan Nomor Resi</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="scan-container">
                        <input type="text" class="scan-input" id="resiScanInput" placeholder="Arahkan kamera ke barcode atau QR code">
                        <button class="scan-btn" id="startCameraBtn">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    
                    <div class="camera-container" id="cameraContainer">
                        <video id="cameraVideo" autoplay playsinline></video>
                        <div class="camera-controls">
                            <button class="btn btn-primary" id="captureBtn">
                                <i class="fas fa-camera"></i> Capture
                            </button>
                            <button class="btn btn-danger" id="stopCameraBtn">
                                <i class="fas fa-stop"></i> Stop
                            </button>
                        </div>
                    </div>
                    
                    <div class="scan-preview" id="scanPreview">
                        <h4>Hasil Scan:</h4>
                        <div class="resi-info" id="scannedResi"></div>
                        <div id="orderMatchInfo"></div>
                    </div>
                    
                    <div class="form-actions" style="margin-top: 20px;">
                        <button type="button" class="btn btn-danger" id="cancelScan">Batal</button>
                        <button type="button" class="btn btn-success" id="confirmResi">Konfirmasi Resi</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        `;
		
		document.getElementById('pages_content').innerHTML = HTML;
			}
            
            renderDeliveryList() {
                let tableHTML = '';
                
                this.filteredOrders.forEach(order => {
                    const statusClass = this.getDeliveryStatusClass(order.pengiriman.status_pengiriman);
                    const statusText = this.getDeliveryStatusText(order.pengiriman.status_pengiriman);
                    const orderDate = new Date(order.tanggal).toLocaleDateString('id-ID');
                    
                    tableHTML += `
                        <tr>
                            <td>
                                <div class="order-id">${order.id}</div>
                                <div class="order-date">${orderDate}</div>
                            </td>
                            <td>
                                <div class="customer-name">${order.user_detail.nama}</div>
                                <div class="customer-email">${order.user_detail.email}</div>
                            </td>
                            <td>
                                <div><strong>${order.pengiriman.expedisi}</strong></div>
                                <div class="order-date">${order.pengiriman.no_resi || 'Belum ada resi'}</div>
                            </td>
                            <td>${orderDate}</td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-view" onclick="deliveryUI.viewDeliveryDetail('${order.id}')">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    ${order.pengiriman.status_pengiriman === 'diproses' ? `
                                        <button class="action-btn btn-edit" onclick="deliveryUI.scanResiForOrder('${order.id}')">
                                            <i class="fas fa-qrcode"></i> Scan Resi
                                        </button>
                                    ` : ''}
                                    ${order.pengiriman.status_pengiriman === 'dikirim' ? `
                                        <button class="action-btn btn-success" onclick="deliveryUI.markAsDelivered('${order.id}')">
                                            <i class="fas fa-check"></i> Diterima
                                        </button>
                                    ` : ''}
                                </div>
                            </td>
                        </tr>
                    `;
                });
                
                document.getElementById('deliveryTableBody').innerHTML = tableHTML;
            }
            
            viewDeliveryDetail(orderId) {
                this.currentOrder = this.orders.find(o => o.id === orderId);
                if (!this.currentOrder) return;
                
                this.showDeliveryDetail();
                this.populateDeliveryDetail();
            }
            
            showDeliveryDetail() {
                document.getElementById('deliveryListView').style.display = 'none';
                document.getElementById('deliveryDetailView').style.display = 'block';
                this.currentView = 'detail';
            }
            
            showDeliveryList() {
                document.getElementById('deliveryDetailView').style.display = 'none';
                document.getElementById('deliveryListView').style.display = 'block';
                this.currentView = 'list';
            }
            
            populateDeliveryDetail() {
                if (!this.currentOrder) return;
                
                // Set basic order info
                document.getElementById('detailOrderId').textContent = this.currentOrder.id;
                
                // Set delivery info
                const shipping = this.currentOrder.pengiriman;
                document.getElementById('infoDeliveryStatus').textContent = this.getDeliveryStatusText(shipping.status_pengiriman);
                document.getElementById('infoCourier').textContent = shipping.expedisi;
                document.getElementById('infoResi').textContent = shipping.no_resi || 'Belum ada resi';
                document.getElementById('infoService').textContent = shipping.service;
                document.getElementById('infoEstimation').textContent = shipping.estimasi;
                
                // Set status dot color
                const statusDot = document.getElementById('statusDot');
                statusDot.className = 'status-dot ' + shipping.status_pengiriman;
                
                // Set recipient info
                const user = this.currentOrder.user_detail;
                document.getElementById('infoRecipient').textContent = user.nama;
                document.getElementById('infoRecipientPhone').textContent = user.telepon;
                document.getElementById('infoRecipientAddress').textContent = 
                    `${user.alamat.jalan}, ${user.alamat.kota}, ${user.alamat.provinsi} ${user.alamat.kode_pos}`;
                
                // Populate items
                let itemsHTML = '';
                this.currentOrder.produk_list.forEach(item => {
                    itemsHTML += `
                        <tr>
                            <td>${item.nama}</td>
                            <td>${item.jumlah}</td>
                            <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                            <td>Rp ${item.subtotal.toLocaleString('id-ID')}</td>
                        </tr>
                    `;
                });
                document.getElementById('deliveryItemsList').innerHTML = itemsHTML;
                
                // Populate timeline
                let timelineHTML = '';
                if (shipping.history) {
                    shipping.history.forEach(event => {
                        timelineHTML += `
                            <div class="timeline-item">
                                <div class="timeline-date">${new Date(event.waktu).toLocaleDateString('id-ID')} ${new Date(event.waktu).toLocaleTimeString('id-ID')}</div>
                                <div class="timeline-content">${event.keterangan}</div>
                            </div>
                        `;
                    });
                }
                document.getElementById('deliveryTimeline').innerHTML = timelineHTML;
            }
            
            scanResi() {
                document.getElementById('scanResiModal').style.display = 'block';
                this.scannedResi = '';
                document.getElementById('scanPreview').style.display = 'none';
            }
            
            scanResiForOrder(orderId) {
                this.currentOrder = this.orders.find(o => o.id === orderId);
                this.scanResi();
            }
            
            async startCamera() {
                try {
                    const video = document.getElementById('cameraVideo');
                    this.stream = await navigator.mediaDevices.getUserMedia({ 
                        video: { facingMode: 'environment' } 
                    });
                    video.srcObject = this.stream;
                    document.getElementById('cameraContainer').style.display = 'block';
                } catch (error) {
                    console.error('Error accessing camera:', error);
                    alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
                }
            }
            
            stopCamera() {
                if (this.stream) {
                    this.stream.getTracks().forEach(track => track.stop());
                    this.stream = null;
                }
                document.getElementById('cameraContainer').style.display = 'none';
            }
            
            captureBarcode() {
                // Simulasi capture barcode/QR code
                // Dalam implementasi nyata, ini akan menggunakan library seperti QuaggaJS atau jsQR
                const randomResi = this.generateRandomResi();
                this.processScannedResi(randomResi);
            }
            
            generateRandomResi() {
                const couriers = ['JNE', 'TIKI', 'POS', 'J&T', 'SiCepat'];
                const courier = couriers[Math.floor(Math.random() * couriers.length)];
                const numbers = Math.random().toString().substr(2, 12);
                return `${courier}${numbers}ID`;
            }
            
            processScannedResi(resi) {
                this.scannedResi = resi;
                document.getElementById('scannedResi').textContent = resi;
                
                // Cari order yang sesuai
                const matchedOrder = this.orders.find(order => 
                    order.pengiriman.no_resi === resi || 
                    order.pengiriman.status_pengiriman === 'diproses'
                );
                
                let matchHTML = '';
                if (matchedOrder) {
                    matchHTML = `
                        <div style="margin-top: 10px; padding: 10px; background: #e8f5e9; border-radius: 4px;">
                            <i class="fas fa-check-circle" style="color: #28a745;"></i>
                            <strong>Order Ditemukan:</strong> ${matchedOrder.id}<br>
                            <strong>Pelanggan:</strong> ${matchedOrder.user_detail.nama}
                        </div>
                    `;
                } else {
                    matchHTML = `
                        <div style="margin-top: 10px; padding: 10px; background: #fff3cd; border-radius: 4px;">
                            <i class="fas fa-exclamation-triangle" style="color: #ffc107;"></i>
                            <strong>Tidak ada order yang cocok.</strong> Pastikan resi sesuai.
                        </div>
                    `;
                }
                
                document.getElementById('orderMatchInfo').innerHTML = matchHTML;
                document.getElementById('scanPreview').style.display = 'block';
            }
            
            confirmResi() {
                if (!this.scannedResi) {
                    alert('Silakan scan atau masukkan nomor resi terlebih dahulu.');
                    return;
                }
                
                if (this.currentOrder) {
                    // Update order dengan resi yang discan
                    this.currentOrder.pengiriman.no_resi = this.scannedResi;
                    this.currentOrder.pengiriman.status_pengiriman = 'dikirim';
                    
                    // Tambahkan history
                    this.currentOrder.pengiriman.history.push({
                        status: "dikirim",
                        waktu: new Date().toISOString(),
                        keterangan: `Pesanan telah dikirim dengan nomor resi ${this.scannedResi}`
                    });
                    
                    alert(`Resi ${this.scannedResi} berhasil dikonfirmasi untuk order ${this.currentOrder.id}`);
                    this.closeModal();
                    this.renderDeliveryList();
                    this.updateStats();
                    
                    if (this.currentView === 'detail') {
                        this.populateDeliveryDetail();
                    }
                } else {
                    alert('Resi berhasil discan: ' + this.scannedResi);
                    this.closeModal();
                }
            }
            
            markAsShipped() {
                if (!this.currentOrder) return;
                
                this.currentOrder.pengiriman.status_pengiriman = 'dikirim';
                this.currentOrder.pengiriman.history.push({
                    status: "dikirim",
                    waktu: new Date().toISOString(),
                    keterangan: "Pesanan telah dikirim"
                });
                
                alert(`Order ${this.currentOrder.id} berhasil ditandai sebagai dikirim`);
                this.renderDeliveryList();
                this.updateStats();
                this.populateDeliveryDetail();
            }
            
            markAsDelivered(orderId) {
                const order = this.orders.find(o => o.id === orderId);
                if (!order) return;
                
                order.pengiriman.status_pengiriman = 'diterima';
                order.status = 'diterima';
                order.pengiriman.history.push({
                    status: "diterima",
                    waktu: new Date().toISOString(),
                    keterangan: "Pesanan telah diterima oleh pelanggan"
                });
                
                alert(`Order ${orderId} berhasil ditandai sebagai diterima`);
                this.renderDeliveryList();
                this.updateStats();
            }
            
            processDelivery() {
                if (!this.currentOrder) return;
                
                this.currentOrder.pengiriman.status_pengiriman = 'diproses';
                this.currentOrder.pengiriman.history.push({
                    status: "diproses",
                    waktu: new Date().toISOString(),
                    keterangan: "Pesanan sedang diproses untuk pengiriman"
                });
                
                alert(`Order ${this.currentOrder.id} sedang diproses`);
                this.renderDeliveryList();
                this.updateStats();
                this.populateDeliveryDetail();
            }
            
            filterDeliveries() {
                const searchTerm = document.getElementById('searchDelivery').value.toLowerCase();
                const statusFilter = document.getElementById('deliveryStatusFilter').value;
                const courierFilter = document.getElementById('courierFilter').value;
                const dateFilter = document.getElementById('deliveryDate').value;
                
                this.filteredOrders = this.orders.filter(order => {
                    const matchesSearch = order.id.toLowerCase().includes(searchTerm) || 
                                         (order.pengiriman.no_resi && order.pengiriman.no_resi.toLowerCase().includes(searchTerm));
                    
                    const matchesStatus = !statusFilter || order.pengiriman.status_pengiriman === statusFilter;
                    
                    const matchesCourier = !courierFilter || order.pengiriman.expedisi === courierFilter;
                    
                    let matchesDate = true;
                    if (dateFilter) {
                        const orderDate = new Date(order.tanggal).toISOString().split('T')[0];
                        matchesDate = orderDate === dateFilter;
                    }
                    
                    return matchesSearch && matchesStatus && matchesCourier && matchesDate;
                });
                
                this.renderDeliveryList();
                this.updateStats();
            }
            
            updateStats() {
                const deliveries = this.orders;
                document.getElementById('totalDeliveries').textContent = deliveries.length;
                document.getElementById('pendingDeliveries').textContent = 
                    deliveries.filter(d => d.pengiriman.status_pengiriman === 'pending').length;
                document.getElementById('shippedDeliveries').textContent = 
                    deliveries.filter(d => d.pengiriman.status_pengiriman === 'dikirim').length;
                document.getElementById('deliveredDeliveries').textContent = 
                    deliveries.filter(d => d.pengiriman.status_pengiriman === 'diterima').length;
            }
            
            getDeliveryStatusClass(status) {
                const statusClasses = {
                    'pending': 'status-pending',
                    'diproses': 'status-processing',
                    'dikirim': 'status-shipped',
                    'diterima': 'status-delivered',
                    'dibatalkan': 'status-cancelled'
                };
                
                return statusClasses[status] || 'status-pending';
            }
            
            getDeliveryStatusText(status) {
                const statusTexts = {
                    'pending': 'Menunggu',
                    'diproses': 'Diproses',
                    'dikirim': 'Dikirim',
                    'diterima': 'Diterima',
                    'dibatalkan': 'Dibatalkan'
                };
                
                return statusTexts[status] || 'Menunggu';
            }
            
            closeModal() {
                document.getElementById('scanResiModal').style.display = 'none';
                this.stopCamera();
                document.getElementById('resiScanInput').value = '';
                this.scannedResi = '';
            }
            
            setupEventListeners() {
                // Filter event listeners
                document.getElementById('searchDelivery').addEventListener('input', () => this.filterDeliveries());
                document.getElementById('deliveryStatusFilter').addEventListener('change', () => this.filterDeliveries());
                document.getElementById('courierFilter').addEventListener('change', () => this.filterDeliveries());
                document.getElementById('deliveryDate').addEventListener('change', () => this.filterDeliveries());
                
                // Back to list button
                document.getElementById('backToDeliveryList').addEventListener('click', () => this.showDeliveryList());
                
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
                
                // Scan resi button
                document.getElementById('scanResiBtn').addEventListener('click', () => this.scanResi());
                document.getElementById('scanResiDetailBtn').addEventListener('click', () => this.scanResi());
                
                // Camera controls
                document.getElementById('startCameraBtn').addEventListener('click', () => this.startCamera());
                document.getElementById('stopCameraBtn').addEventListener('click', () => this.stopCamera());
                document.getElementById('captureBtn').addEventListener('click', () => this.captureBarcode());
                
                // Manual resi input
                document.getElementById('resiScanInput').addEventListener('input', (e) => {
                    this.processScannedResi(e.target.value);
                });
                
                document.getElementById('manualResiInput').addEventListener('input', (e) => {
                    this.scannedResi = e.target.value;
                });
                
                // Confirm resi
                document.getElementById('confirmResi').addEventListener('click', () => this.confirmResi());
                document.getElementById('submitResiBtn').addEventListener('click', () => {
                    const manualResi = document.getElementById('manualResiInput').value;
                    if (manualResi) {
                        this.processScannedResi(manualResi);
                        this.confirmResi();
                    }
                });
                
                // Action buttons
                document.getElementById('processDeliveryBtn').addEventListener('click', () => this.processDelivery());
                document.getElementById('markAsShippedBtn').addEventListener('click', () => this.markAsShipped());
                document.getElementById('cancelDeliveryBtn').addEventListener('click', () => {
                    if (confirm('Apakah Anda yakin ingin membatalkan pengiriman ini?')) {
                        alert('Pengiriman dibatalkan');
                    }
                });
                
                // Cancel buttons
                document.getElementById('cancelScan').addEventListener('click', () => this.closeModal());
                
                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target.classList.contains('modal')) {
                        this.closeModal();
                    }
                });
                
                // Close modal with X button
                document.querySelectorAll('.close-modal').forEach(btn => {
                    btn.addEventListener('click', () => this.closeModal());
                });
            }
        }