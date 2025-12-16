//import FaiModule from '../../../Builder/OrderSystemBuilder.js';
export default class AdminOrderListUI  {
            constructor() {
               // super();
            }
            
            init(config) {
				this.orders = config.orderSystemJson.list_pesanan  || [];
                this.filteredOrders = [...this.orders];
                this.currentOrder = null;
                this.currentView = 'list'; // 'list' or 'detail'
                this.deliveryOrders = config.orderSystemJson.delivery_order  || [];
                this.outgoings = config.orderSystemJson.outgoing  || [];
                this.refunds = config.orderSystemJson.refund || [];
                this.returOutgoings = config.orderSystemJson.retur_outgoing || [];
				
                this.render();
                this.renderOrdersList();
                this.setupEventListeners();
                this.updateStats();
            }
            
            render() {
                let HTML = `
				<div class="admin-container"><div class="admin-content">
                <!-- Order List View -->
                <div id="orderListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Pesanan</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="addOrderBtn">
                                <i class="fas fa-plus"></i> Pesan Baru
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari Pesanan</label>
                                <input type="text" class="filter-input" id="searchOrder" placeholder="ID Pesanan atau Nama Pelanggan">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Diproses</option>
                                    <option value="shipped">Dikirim</option>
                                    <option value="delivered">Selesai</option>
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
                            <div class="stat-title">Total Pesanan</div>
                            <div class="stat-value" id="totalOrders">0</div>
                        </div>
                        <div class="stat-card process">
                            <div class="stat-title">Dalam Proses</div>
                            <div class="stat-value" id="processingOrders">0</div>
                        </div>
                        <div class="stat-card shipped">
                            <div class="stat-title">Dikirim</div>
                            <div class="stat-value" id="shippedOrders">0</div>
                        </div>
                        <div class="stat-card delivered">
                            <div class="stat-title">Selesai</div>
                            <div class="stat-value" id="deliveredOrders">0</div>
                        </div>
                    </div>
                    
                    <div class="orders-table-container">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="ordersTableBody">
                                <!-- Orders will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Order Detail View -->
                <div id="orderDetailView" class="order-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Pesanan: <span id="detailOrderId"></span></h2>
                    </div>
                    
                    <div class="order-info">
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pesanan</div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoStatus"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal Pesanan:</span>
                                <span class="info-value" id="infoOrderDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Total:</span>
                                <span class="info-value" id="infoTotal"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Metode Pembayaran:</span>
                                <span class="info-value" id="infoPaymentMethod"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status Pembayaran:</span>
                                <span class="info-value" id="infoPaymentStatus"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pelanggan</div>
                            <div class="info-item">
                                <span class="info-label">Nama:</span>
                                <span class="info-value" id="infoCustomerName"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value" id="infoCustomerEmail"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Telepon:</span>
                                <span class="info-value" id="infoCustomerPhone"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Pengiriman</div>
                            <div class="info-item">
                                <span class="info-label">Ekspedisi:</span>
                                <span class="info-value" id="infoShippingCompany"></span>
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
                                <span class="info-label">Status Pengiriman:</span>
                                <span class="info-value" id="infoShippingStatus"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tabs">
                        <!-- Tabs will be populated dynamically -->
                    </div>
                    
                    <div id="tab-detail" class="tab-content active">
                        <!-- Detail tab content will be populated dynamically -->
                    </div>
                    
                    <div id="tab-delivery" class="tab-content">
                        <!-- Delivery tab content will be populated dynamically -->
                    </div>
                    
                    <div id="tab-outgoing" class="tab-content">
                        <!-- Outgoing tab content will be populated dynamically -->
                    </div>
                    
                    <div id="tab-refund" class="tab-content">
                        <!-- Refund tab content will be populated dynamically -->
                    </div>
                    
                    <div id="tab-retur" class="tab-content">
                        <!-- Retur tab content will be populated dynamically -->
                    </div>
                </div>
            </div>
            </div>
        `;
		document.getElementById('pages_content').innerHTML = HTML;
			}
            
            renderOrdersList() {
                let tableHTML = '';
                
                this.filteredOrders.forEach(order => {
                    const statusClass = this.getStatusClass(order.status);
                    const statusText = this.getStatusText(order.status);
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
                            <td>${orderDate}</td>
                            <td class="order-total">Rp ${order.total.total.toLocaleString('id-ID')}</td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-view" onclick="adminOrderListUI.viewOrderDetail('${order.id}')">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button class="action-btn btn-edit" onclick="adminOrderListUI.editOrder('${order.id}')">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                
                document.getElementById('ordersTableBody').innerHTML = tableHTML;
            }
            
            viewOrderDetail(orderId) {
                this.currentOrder = this.orders.find(o => o.id === orderId);
                if (!this.currentOrder) return;
                
                this.showOrderDetail();
                this.populateOrderDetail();
            }
            
            showOrderDetail() {
                document.getElementById('orderListView').style.display = 'none';
                document.getElementById('orderDetailView').style.display = 'block';
                this.currentView = 'detail';
            }
            
            showOrderList() {
                document.getElementById('orderDetailView').style.display = 'none';
                document.getElementById('orderListView').style.display = 'block';
                this.currentView = 'list';
            }
            
            populateOrderDetail() {
                if (!this.currentOrder) return;
                
                // Set basic order info
                document.getElementById('detailOrderId').textContent = this.currentOrder.id;
                document.getElementById('infoStatus').textContent = this.getStatusText(this.currentOrder.status);
                document.getElementById('infoOrderDate').textContent = new Date(this.currentOrder.tanggal).toLocaleDateString('id-ID', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('infoTotal').textContent = `Rp ${this.currentOrder.total.total.toLocaleString('id-ID')}`;
                document.getElementById('infoPaymentMethod').textContent = this.currentOrder.pembayaran.metode;
                document.getElementById('infoPaymentStatus').textContent = this.currentOrder.pembayaran.status;
                
                // Set customer info
                document.getElementById('infoCustomerName').textContent = this.currentOrder.user_detail.nama;
                document.getElementById('infoCustomerEmail').textContent = this.currentOrder.user_detail.email;
                document.getElementById('infoCustomerPhone').textContent = this.currentOrder.user_detail.telepon;
                
                // Set shipping info
                document.getElementById('infoShippingCompany').textContent = this.currentOrder.pengiriman.expedisi;
                document.getElementById('infoShippingService').textContent = this.currentOrder.pengiriman.service;
                document.getElementById('infoTrackingNumber').textContent = this.currentOrder.pengiriman.no_resi;
                document.getElementById('infoShippingStatus').textContent = this.currentOrder.pengiriman.status_pengiriman;
                
                // Update tabs
                const tabsContainer = document.querySelector('.tabs');
                tabsContainer.innerHTML = `
                    <div class="tab active" data-tab="detail">Detail Pesanan</div>
                    <div class="tab" data-tab="delivery">Delivery Order</div>
                    <div class="tab" data-tab="outgoing">Outgoing</div>
                    <div class="tab" data-tab="refund">Refund</div>
                    <div class="tab" data-tab="retur">Retur Outgoing</div>
                `;
                
                // Populate detail tab
                document.getElementById('tab-detail').innerHTML = this.renderDetailTab();
                
                // Populate delivery tab
                document.getElementById('tab-delivery').innerHTML = this.renderDeliveryTab();
                
                // Populate outgoing tab
                document.getElementById('tab-outgoing').innerHTML = this.renderOutgoingTab();
                
                // Populate refund tab
                document.getElementById('tab-refund').innerHTML = this.renderRefundTab();
                
                // Populate retur tab
                document.getElementById('tab-retur').innerHTML = this.renderReturTab();
            }
            
            renderDetailTab() {
                let productsHTML = '';
                this.currentOrder.produk_list.forEach(product => {
                    productsHTML += `
                        <tr>
                            <td>${product.nama}</td>
                            <td>Rp ${product.harga.toLocaleString('id-ID')}</td>
                            <td>${product.jumlah}</td>
                            <td>Rp ${product.subtotal.toLocaleString('id-ID')}</td>
                        </tr>
                    `;
                });
                
                return `
                    <h3>Produk yang Dipesan</h3>
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${productsHTML}
                        </tbody>
                    </table>
                    
                    <div style="display: flex; justify-content: flex-end;">
                        <table class="summary-table" style="width: 300px;">
                            <tr>
                                <td>Subtotal:</td>
                                <td id="summarySubtotal" style="text-align: right;">Rp ${this.currentOrder.total.subtotal.toLocaleString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td>Diskon:</td>
                                <td id="summaryDiscount" style="text-align: right;">- Rp ${this.currentOrder.total.diskon.toLocaleString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td>Pajak:</td>
                                <td id="summaryTax" style="text-align: right;">Rp ${this.currentOrder.total.pajak.toLocaleString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim:</td>
                                <td id="summaryShipping" style="text-align: right;">Rp ${this.currentOrder.total.ongkir.toLocaleString('id-ID')}</td>
                            </tr>
                            <tr>
                                <td>Total:</td>
                                <td id="summaryTotal" style="text-align: right;">Rp ${this.currentOrder.total.total.toLocaleString('id-ID')}</td>
                            </tr>
                        </table>
                    </div>
                `;
            }
            
            renderDeliveryTab() {
                const delivery = this.deliveryOrders.find(d => d.id_pesanan === this.currentOrder.id);
                
                return `
                    <h3>Manajemen Delivery Order</h3>
                    <button class="btn btn-primary" onclick="adminOrderListUI.addDeliveryOrder()">
                        <i class="fas fa-plus"></i> Tambah Delivery Order
                    </button>
                    
                    ${delivery ? `
                        <div class="info-card" style="margin-top: 20px;">
                            <div class="info-card-title">Informasi Pengiriman</div>
                            <div class="info-item">
                                <span class="info-label">Kurir:</span>
                                <span class="info-value">${delivery.kurir.perusahaan} - ${delivery.kurir.service}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Driver:</span>
                                <span class="info-value">${delivery.driver.nama} (${delivery.driver.telepon})</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value">${delivery.status}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Estimasi Sampai:</span>
                                <span class="info-value">${new Date(delivery.estimasi_sampai).toLocaleDateString('id-ID')}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Resi:</span>
                                <span class="info-value">${delivery.kurir.no_resi}</span>
                            </div>
                        </div>
                        
                        <h3 style="margin-top: 20px;">Riwayat Pengiriman</h3>
                        <div class="timeline">
                            ${delivery.history.map(event => `
                                <div class="timeline-item">
                                    <div class="timeline-date">${new Date(event.waktu).toLocaleDateString('id-ID')} ${new Date(event.waktu).toLocaleTimeString('id-ID')}</div>
                                    <div class="timeline-content">${event.keterangan}</div>
                                </div>
                            `).join('')}
                        </div>
                    ` : `
                        <div class="info-card" style="margin-top: 20px; text-align: center; padding: 30px;">
                            <i class="fas fa-truck" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                            <p>Belum ada delivery order untuk pesanan ini</p>
                        </div>
                    `}
                `;
            }
            
            renderOutgoingTab() {
                const outgoing = this.outgoings.find(o => o.id_pesanan === this.currentOrder.id);
                
                return `
                    <h3>Manajemen Outgoing</h3>
                    <button class="btn btn-primary" onclick="adminOrderListUI.addOutgoing()">
                        <i class="fas fa-plus"></i> Tambah Outgoing
                    </button>
                    
                    ${outgoing ? `
                        <div class="info-card" style="margin-top: 20px;">
                            <div class="info-card-title">Informasi Outgoing</div>
                            <div class="info-item">
                                <span class="info-label">Gudang:</span>
                                <span class="info-value">${outgoing.id_gudang}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Picker:</span>
                                <span class="info-value">${outgoing.picker}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal:</span>
                                <span class="info-value">${new Date(outgoing.tanggal).toLocaleDateString('id-ID')}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value">${outgoing.status}</span>
                            </div>
                        </div>
                        
                        <h3 style="margin-top: 20px;">Item Outgoing</h3>
                        <table class="products-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Lokasi Rak</th>
                                    <th>Batch</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${outgoing.items.map(item => {
                                    const product = orderSystemJson.produk.find(p => p.id === item.id_produk);
                                    return `
                                        <tr>
                                            <td>${product ? product.nama : item.id_produk}</td>
                                            <td>${item.jumlah}</td>
                                            <td>${item.lokasi_rak}</td>
                                            <td>${item.id_batch}</td>
                                        </tr>
                                    `;
                                }).join('')}
                            </tbody>
                        </table>
                    ` : `
                        <div class="info-card" style="margin-top: 20px; text-align: center; padding: 30px;">
                            <i class="fas fa-box-open" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                            <p>Belum ada outgoing untuk pesanan ini</p>
                        </div>
                    `}
                `;
            }
            
            renderRefundTab() {
                const refunds = this.refunds.filter(r => r.id_pesanan === this.currentOrder.id);
                
                return `
                    <h3>Manajemen Refund</h3>
                    <button class="btn btn-primary" onclick="adminOrderListUI.addRefund()">
                        <i class="fas fa-plus"></i> Tambah Refund
                    </button>
                    
                    ${refunds.length > 0 ? `
                        <div class="info-card" style="margin-top: 20px;">
                            <div class="info-card-title">Daftar Refund</div>
                            <table class="products-table">
                                <thead>
                                    <tr>
                                        <th>ID Refund</th>
                                        <th>Tanggal</th>
                                        <th>Alasan</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${refunds.map(refund => `
                                        <tr>
                                            <td>${refund.id}</td>
                                            <td>${new Date(refund.tanggal).toLocaleDateString('id-ID')}</td>
                                            <td>${refund.alasan}</td>
                                            <td>Rp ${refund.jumlah_refund.toLocaleString('id-ID')}</td>
                                            <td>
                                                <span class="status-badge ${this.getStatusClass(refund.status)}">
                                                    ${this.getStatusText(refund.status)}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="action-btn btn-view" onclick="adminOrderListUI.viewRefundDetail('${refund.id}')">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    ` : `
                        <div class="info-card" style="margin-top: 20px; text-align: center; padding: 30px;">
                            <i class="fas fa-receipt" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                            <p>Belum ada refund untuk pesanan ini</p>
                        </div>
                    `}
                `;
            }
            
            renderReturTab() {
                const returs = this.returOutgoings.filter(r => r.id_pesanan === this.currentOrder.id);
                
                return `
                    <h3>Manajemen Retur Outgoing</h3>
                    <button class="btn btn-primary" onclick="adminOrderListUI.addRetur()">
                        <i class="fas fa-plus"></i> Tambah Retur
                    </button>
                    
                    ${returs.length > 0 ? `
                        <div class="info-card" style="margin-top: 20px;">
                            <div class="info-card-title">Daftar Retur</div>
                            <table class="products-table">
                                <thead>
                                    <tr>
                                        <th>ID Retur</th>
                                        <th>Tanggal</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${returs.map(retur => `
                                        <tr>
                                            <td>${retur.id}</td>
                                            <td>${new Date(retur.tanggal).toLocaleDateString('id-ID')}</td>
                                            <td>${retur.alasan}</td>
                                            <td>
                                                <span class="status-badge ${this.getStatusClass(retur.status)}">
                                                    ${this.getStatusText(retur.status)}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="action-btn btn-view" onclick="adminOrderListUI.viewReturDetail('${retur.id}')">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    ` : `
                        <div class="info-card" style="margin-top: 20px; text-align: center; padding: 30px;">
                            <i class="fas fa-undo" style="font-size: 48px; color: #ccc; margin-bottom: 15px;"></i>
                            <p>Belum ada retur untuk pesanan ini</p>
                        </div>
                    `}
                `;
            }
            
            addDeliveryOrder() {
                if (!this.currentOrder) return;
                
                const company = prompt("Masukkan perusahaan pengiriman:");
                if (!company) return;
                
                const service = prompt("Masukkan layanan pengiriman:");
                if (!service) return;
                
                const trackingNumber = prompt("Masukkan nomor resi:");
                if (!trackingNumber) return;
                
                const driverName = prompt("Masukkan nama driver:");
                if (!driverName) return;
                
                const driverPhone = prompt("Masukkan telepon driver:");
                if (!driverPhone) return;
                
                const newDelivery = {
                    id: `do-${Date.now()}`,
                    id_outgoing: this.outgoings.find(o => o.id_pesanan === this.currentOrder.id)?.id || "",
                    id_pesanan: this.currentOrder.id,
                    kurir: {
                        perusahaan: company,
                        service: service,
                        no_resi: trackingNumber
                    },
                    driver: {
                        id_driver: `driver-${Date.now()}`,
                        nama: driverName,
                        telepon: driverPhone
                    },
                    status: "diproses",
                    estimasi_sampai: new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).toISOString(), // 3 hari dari sekarang
                    history: [
                        {
                            status: "diproses",
                            waktu: new Date().toISOString(),
                            keterangan: "Delivery order dibuat"
                        }
                    ],
                    bukti_terima: null,
                    tanda_tangan_penerima: null
                };
                
                this.deliveryOrders.push(newDelivery);
                this.populateOrderDetail();
                setShowAlert("Delivery order berhasil ditambahkan!", "success");
            }
            
            addOutgoing() {
                if (!this.currentOrder) return;
                
                const warehouseId = prompt("Masukkan ID gudang:");
                if (!warehouseId) return;
                
                const picker = prompt("Masukkan nama picker:");
                if (!picker) return;
                
                // Tampilkan produk yang bisa di-outgoing
                let productOptions = "";
                this.currentOrder.produk_list.forEach((product, index) => {
                    productOptions += `${index + 1}. ${product.nama} (${product.jumlah} pcs)\n`;
                });
                
                const productChoice = prompt(`Pilih produk untuk outgoing:\n${productOptions}`);
                if (!productChoice) return;
                
                const productIndex = parseInt(productChoice) - 1;
                if (isNaN(productIndex) || productIndex < 0 || productIndex >= this.currentOrder.produk_list.length) {
                    setShowAlert("Pilihan produk tidak valid!", "danger");
                    return;
                }
                
                const selectedProduct = this.currentOrder.produk_list[productIndex];
                const quantity = prompt(`Masukkan jumlah ${selectedProduct.nama} untuk outgoing (max ${selectedProduct.jumlah}):`);
                if (!quantity || parseInt(quantity) > selectedProduct.jumlah) {
                    setShowAlert("Jumlah outgoing tidak valid!", "danger");
                    return;
                }
                
                // Cari inventory untuk produk ini
                const inventory = orderSystemJson.inventory.find(inv => 
                    inv.id_produk === selectedProduct.id_produk && inv.stok >= parseInt(quantity)
                );
                
                if (!inventory) {
                    setShowAlert("Stok tidak mencukupi untuk outgoing!", "danger");
                    return;
                }
                
                const newOutgoing = {
                    id: `out-${Date.now()}`,
                    id_pesanan: this.currentOrder.id,
                    id_gudang: warehouseId,
                    tanggal: new Date().toISOString(),
                    status: "diproses",
                    items: [
                        {
                            id_produk: selectedProduct.id_produk,
                            id_inventory: inventory.id,
                            id_batch: inventory.batch[0].id_batch, // Ambil batch pertama
                            jumlah: parseInt(quantity),
                            lokasi_rak: inventory.lokasi_rak
                        }
                    ],
                    picker: picker,
                    catatan: ""
                };
                
                this.outgoings.push(newOutgoing);
                
                // Kurangi stok inventory
                inventory.stok -= parseInt(quantity);
                inventory.batch[0].jumlah -= parseInt(quantity);
                
                this.populateOrderDetail();
                setShowAlert("Outgoing berhasil ditambahkan!", "success");
            }
            
            addRefund() {
                if (!this.currentOrder) return;
                
                const refundAmount = prompt("Masukkan jumlah refund:");
                if (!refundAmount) return;
                
                const reason = prompt("Masukkan alasan refund:");
                if (!reason) return;
                
                const newRefund = {
                    id: `refund-${Date.now()}`,
                    id_pesanan: this.currentOrder.id,
                    tanggal: new Date().toISOString(),
                    alasan: reason,
                    jumlah_refund: parseInt(refundAmount),
                    status: "diproses",
                    bukti: [],
                    history: [
                        {
                            status: "diproses",
                            waktu: new Date().toISOString(),
                            keterangan: "Permintaan refund diajukan"
                        }
                    ]
                };
                
                this.refunds.push(newRefund);
                this.populateOrderDetail();
                setShowAlert("Refund berhasil ditambahkan!", "success");
            }
            
            addRetur() {
                if (!this.currentOrder) return;
                
                const reason = prompt("Masukkan alasan retur:");
                if (!reason) return;
                
                // Tampilkan produk yang bisa diretur
                let productOptions = "";
                this.currentOrder.produk_list.forEach((product, index) => {
                    productOptions += `${index + 1}. ${product.nama} (${product.jumlah} pcs)\n`;
                });
                
                const productChoice = prompt(`Pilih produk yang diretur:\n${productOptions}`);
                if (!productChoice) return;
                
                const productIndex = parseInt(productChoice) - 1;
                if (isNaN(productIndex) || productIndex < 0 || productIndex >= this.currentOrder.produk_list.length) {
                    setShowAlert("Pilihan produk tidak valid!", "danger");
                    return;
                }
                
                const selectedProduct = this.currentOrder.produk_list[productIndex];
                const quantity = prompt(`Masukkan jumlah ${selectedProduct.nama} yang diretur (max ${selectedProduct.jumlah}):`);
                if (!quantity || parseInt(quantity) > selectedProduct.jumlah) {
                    setShowAlert("Jumlah retur tidak valid!", "danger");
                    return;
                }
                
                const newRetur = {
                    id: `retur-${Date.now()}`,
                    id_pesanan: this.currentOrder.id,
                    id_outgoing: this.outgoings.find(o => o.id_pesanan === this.currentOrder.id)?.id || "",
                    tanggal: new Date().toISOString(),
                    alasan: reason,
                    status: "diproses",
                    items: [
                        {
                            id_produk: selectedProduct.id_produk,
                            jumlah: parseInt(quantity),
                            alasan: reason
                        }
                    ],
                    history: [
                        {
                            status: "diproses",
                            waktu: new Date().toISOString(),
                            keterangan: "Permintaan retur diajukan"
                        }
                    ]
                };
                
                this.returOutgoings.push(newRetur);
                this.populateOrderDetail();
                setShowAlert("Retur berhasil ditambahkan!", "success");
            }
            
            viewRefundDetail(refundId) {
                const refund = this.refunds.find(r => r.id === refundId);
                if (!refund) return;
                
                let detailHTML = `
                    <h4>Detail Refund: ${refund.id}</h4>
                    <div class="info-card">
                        <div class="info-item">
                            <span class="info-label">Tanggal:</span>
                            <span class="info-value">${new Date(refund.tanggal).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Alasan:</span>
                            <span class="info-value">${refund.alasan}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Jumlah Refund:</span>
                            <span class="info-value">Rp ${refund.jumlah_refund.toLocaleString('id-ID')}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value">${this.getStatusText(refund.status)}</span>
                        </div>
                    </div>
                    
                    <h4 style="margin-top: 20px;">Riwayat Refund</h4>
                    <div class="timeline">
                `;
                
                refund.history.forEach(event => {
                    detailHTML += `
                        <div class="timeline-item">
                            <div class="timeline-date">${new Date(event.waktu).toLocaleDateString('id-ID')} ${new Date(event.waktu).toLocaleTimeString('id-ID')}</div>
                            <div class="timeline-content">${event.keterangan}</div>
                        </div>
                    `;
                });
                
                detailHTML += `</div>`;
                
                // Tampilkan modal atau alert dengan detail
                alert(detailHTML.replace(/<[^>]*>/g, '')); // Hapus tag HTML untuk alert
            }
            
            viewReturDetail(returId) {
                const retur = this.returOutgoings.find(r => r.id === returId);
                if (!retur) return;
                
                const product = orderSystemJson.produk.find(p => p.id === retur.items[0].id_produk);
                
                let detailHTML = `
                    <h4>Detail Retur: ${retur.id}</h4>
                    <div class="info-card">
                        <div class="info-item">
                            <span class="info-label">Tanggal:</span>
                            <span class="info-value">${new Date(retur.tanggal).toLocaleDateString('id-ID')}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Alasan:</span>
                            <span class="info-value">${retur.alasan}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Produk:</span>
                            <span class="info-value">${product ? product.nama : retur.items[0].id_produk} (${retur.items[0].jumlah} pcs)</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Status:</span>
                            <span class="info-value">${this.getStatusText(retur.status)}</span>
                        </div>
                    </div>
                    
                    <h4 style="margin-top: 20px;">Riwayat Retur</h4>
                    <div class="timeline">
                `;
                
                retur.history.forEach(event => {
                    detailHTML += `
                        <div class="timeline-item">
                            <div class="timeline-date">${new Date(event.waktu).toLocaleDateString('id-ID')} ${new Date(event.waktu).toLocaleTimeString('id-ID')}</div>
                            <div class="timeline-content">${event.keterangan}</div>
                        </div>
                    `;
                });
                
                detailHTML += `</div>`;
                
                // Tampilkan modal atau alert dengan detail
                alert(detailHTML.replace(/<[^>]*>/g, '')); // Hapus tag HTML untuk alert
            }
            
            editOrder(orderId) {
                const order = this.orders.find(o => o.id === orderId);
                if (order) {
                    alert(`Mengedit order: ${orderId}\nStatus saat ini: ${this.getStatusText(order.status)}`);
                    // In a real application, you would open an edit form
                }
            }
            
            filterOrders() {
                const searchTerm = document.getElementById('searchOrder').value.toLowerCase();
                const statusFilter = document.getElementById('statusFilter').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                
                this.filteredOrders = this.orders.filter(order => {
                    const matchesSearch = order.id.toLowerCase().includes(searchTerm) || 
                                         order.user_detail.nama.toLowerCase().includes(searchTerm) ||
                                         order.user_detail.email.toLowerCase().includes(searchTerm);
                    
                    const matchesStatus = !statusFilter || order.status === statusFilter;
                    
                    let matchesDate = true;
                    if (startDate) {
                        const orderDate = new Date(order.tanggal).toISOString().split('T')[0];
                        matchesDate = orderDate >= startDate;
                    }
                    if (endDate && matchesDate) {
                        const orderDate = new Date(order.tanggal).toISOString().split('T')[0];
                        matchesDate = orderDate <= endDate;
                    }
                    
                    return matchesSearch && matchesStatus && matchesDate;
                });
                
                this.renderOrdersList();
                this.updateStats();
            }
            
            updateStats() {
                document.getElementById('totalOrders').textContent = this.orders.length;
                document.getElementById('processingOrders').textContent = this.orders.filter(o => o.status === 'processing' || o.status === 'order_proses').length;
                document.getElementById('shippedOrders').textContent = this.orders.filter(o => o.status === 'shipped').length;
                document.getElementById('deliveredOrders').textContent = this.orders.filter(o => o.status === 'delivered').length;
            }
            
            getStatusClass(status) {
                const statusClasses = {
                    'pending': 'status-pending',
                    'order_proses': 'status-processing',
                    'processing': 'status-processing',
                    'shipped': 'status-shipped',
                    'delivered': 'status-delivered',
                    'cancelled': 'status-cancelled',
                    'diproses': 'status-processing'
                };
                
                return statusClasses[status] || 'status-pending';
            }
            
            getStatusText(status) {
                const statusTexts = {
                    'pending': 'Pending',
                    'order_proses': 'Diproses',
                    'processing': 'Diproses',
                    'shipped': 'Dikirim',
                    'delivered': 'Selesai',
                    'cancelled': 'Dibatalkan',
                    'diproses': 'Diproses'
                };
                
                return statusTexts[status] || 'Pending';
            }
            
            setupEventListeners() {
                // Filter event listeners
                document.getElementById('searchOrder').addEventListener('input', () => this.filterOrders());
                document.getElementById('statusFilter').addEventListener('change', () => this.filterOrders());
                document.getElementById('startDate').addEventListener('change', () => this.filterOrders());
                document.getElementById('endDate').addEventListener('change', () => this.filterOrders());
                
                // Back to list button
                document.getElementById('backToList').addEventListener('click', () => this.showOrderList());
                
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
                
                // Add new order button
                document.getElementById('addOrderBtn').addEventListener('click', () => {
                    setShowAlert("Fitur tambah pesanan akan dibuka. Dalam implementasi nyata, ini akan membuka form untuk membuat pesanan baru.", "primary");
                    // In a real application, you would open a form to create a new order
                });
            }
        }