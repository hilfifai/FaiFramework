export default class DeliveryOrderUI {
            constructor() {
                this.deliveryOrders = [];
                this.orders = [];
                this.products = [];
                this.filteredDeliveries = [];
                this.currentDelivery = null;
                this.currentView = 'list';
                this.stream = null;
                this.scannedResi = '';
                this.selectedItems = [];
				 this.apiBaseUrl = window.fai.getModule('base_url');
            }
            
            async init() {
                await this.loadData();
                this.render();
                this.renderDeliveryList();
                this.setupEventListeners();
                this.updateStats();
            }
            
            async loadData() {
                try {
                    // Load delivery orders from API
                    const deliveryResponse = await this.apiRequest('api/delivery_orders');
                    this.deliveryOrders = deliveryResponse.map(delivery => {
						let detail = [];

						// Parse detail
						try {
							if (delivery.detail) {
								if (typeof delivery.detail === 'string') {
									detail = JSON.parse(delivery.detail);
								} else if (Array.isArray(delivery.detail)) {
									detail = delivery.detail;
								}
							}
						} catch (error) {
							console.error('Error parsing delivery.detail for delivery ID:', delivery.id, error);
							detail = [];
						}

						// (Optional) Kalau ada nested string di dalam detail, kamu bisa parse di sini juga

						return {
							...delivery,
							detail: detail
						};
					});

                    
                    this.filteredDeliveries = [...this.deliveryOrders];
                } catch (error) {
                    console.error('Error loading data:', error);
                    // Fallback to sample data if API fails
                    //this.loadSampleData();
                }
            }
			async apiRequest(endpoint, options = {}) {
				try {
					const response = await fetch(`${this.apiBaseUrl}${endpoint}`, {
						headers: {
							'Content-Type': 'application/json',
							...options.headers
						},
						...options
					});
					if (!response.ok) {
						throw new Error(`API error: ${response.status}`);
					}

					return await response.json();
				} catch (error) {
					console.error('API request failed:', error);
					return null;
				}
			} 
            loadSampleData() {
                // Sample delivery orders data matching your structure
                this.deliveryOrders = [
                    {
                        id: "472",
                        nomor_do: null,
                        tanggal_do: "2025-10-05",
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
                        total_berat: "1500",
                        id_ekpedisi: "24",
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
                        create_date: "2025-10-05 15:28:36",
                        create_by: "20250123211111186799",
                        update_date: "2025-10-05 15:30:10",
                        update_by: "20250123211111186799",
                        delete_date: null,
                        delete_by: null,
                        timezone: "Asia/Jakarta",
                        id_erp__pos__utama: "488",
                        id_erp__pos__delivery_order: "472",
                        tanggal_kirim: null,
                        harga_kirim: null,
                        nomor_resi: "123456",
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
                        tipe_pemesanan: "regular",
                        dropship_toko: null,
                        nomor_resi_ecommerce: null,
                        ekspedisi_ecommerce: null,
                        service_ecommerce: null,
                        plaform_ecommerce: null,
                        file_resi_ecommerce: null,
                        detail: [
                            {
                                id: 170980,
                                id_inventaris__asset__list_do: 25780,
                                qty_pesan_do: 1,
                                berat_satuan_do: 300,
                                berat_total_do: 300,
                                qty_kirim: 1,
                                sisa_qty_kirim: 0,
                                id_erp__pos__utama: 488,
                                id_erp__pos__delivery_order: 472,
                                active: 1,
                                on_domain: "moesneeds.id",
                                on_panel: 333,
                                on_board: 42,
                                on_role: 0,
                                privilege: "Private Website",
                                create_date: "2025-10-05 15:28:36",
                                create_by: "20250123211111186799",
                                update_date: null,
                                update_by: null,
                                delete_date: null,
                                delete_by: null,
                                timezone: "Asia/Jakarta"
                            }
                        ],
                        status: "pending",
                        history: [
                            {
                                date: "2025-10-05",
                                action: "Delivery order dibuat",
                                user: "Admin"
                            }
                        ]
                    },{
                        id: "473",
                        nomor_do: null,
                        tanggal_do: "2025-10-05",
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
                        total_berat: "1500",
                        id_ekpedisi: "24",
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
                        create_date: "2025-10-05 15:28:36",
                        create_by: "20250123211111186799",
                        update_date: "2025-10-05 15:30:10",
                        update_by: "20250123211111186799",
                        delete_date: null,
                        delete_by: null,
                        timezone: "Asia/Jakarta",
                        id_erp__pos__utama: "488",
                        id_erp__pos__delivery_order: "472",
                        tanggal_kirim: null,
                        harga_kirim: null,
                        nomor_resi: "123446",
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
                        tipe_pemesanan: "regular",
                        dropship_toko: null,
                        nomor_resi_ecommerce: null,
                        ekspedisi_ecommerce: null,
                        service_ecommerce: null,
                        plaform_ecommerce: null,
                        file_resi_ecommerce: null,
                        detail: [
                            {
                                id: 170980,
                                id_inventaris__asset__list_do: 25780,
                                qty_pesan_do: 1,
                                berat_satuan_do: 300,
                                berat_total_do: 300,
                                qty_kirim: 1,
                                sisa_qty_kirim: 0,
                                id_erp__pos__utama: 488,
                                id_erp__pos__delivery_order: 472,
                                active: 1,
                                on_domain: "moesneeds.id",
                                on_panel: 333,
                                on_board: 42,
                                on_role: 0,
                                privilege: "Private Website",
                                create_date: "2025-10-05 15:28:36",
                                create_by: "20250123211111186799",
                                update_date: null,
                                update_by: null,
                                delete_date: null,
                                delete_by: null,
                                timezone: "Asia/Jakarta"
                            }
                        ],
                        status: "pending",
                        history: [
                            {
                                date: "2025-10-05",
                                action: "Delivery order dibuat",
                                user: "Admin"
                            }
                        ]
                    }
                ];
                
                this.orders = [
                    {
                        id: "488",
                        nomor_invoice: "INV-2025-1001",
                        status: "diproses",
                        user_detail: {
                            nama: "Ahmad Rizki",
                            telepon: "08123456789",
                            alamat: {
                                jalan: "Jalan Saluyu Indah XVIII no 170",
                                kota: "Bandung",
                                provinsi: "Jawa Barat"
                            }
                        },
                        produk_list: [
                            {
                                id: "25780",
                                nama: "Laptop Gaming",
                                harga: 15000000,
                                jumlah: 1,
                                berat: 300
                            }
                        ]
                    }
                ];
                
                this.products = [
                    {
                        id: "25780",
                        nama: "Laptop Gaming",
                        harga: 15000000,
                        stok: 10,
                        berat: 300
                    }
                ];
                
                this.filteredDeliveries = [...this.deliveryOrders];
            }
            
            render() {
                let tableHTML = `<div class="admin-container">
           
            <div class="admin-content">
                <!-- Delivery List View -->
                <div id="deliveryListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Pengiriman</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="scanResiBtn">
                                <i class="fas fa-qrcode"></i> Scan Resi
                            </button>
                            <button class="btn btn-success" id="addDeliveryBtn">
                                <i class="fas fa-plus"></i> Tambah Delivery
                            </button>
                            <button class="btn btn-info">
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
                                    <th>ID Delivery</th>
                                    <th>ID Pesanan</th>
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
						
    <div class="item-management">
        <div class="item-actions">
            <button class="btn btn-success" id="addItemBtn">
                <i class="fas fa-plus"></i> Tambah Item
            </button>
            <button class="btn btn-info" id="refreshItemsBtn">
                <i class="fas fa-sync"></i> Refresh
            </button>
        </div>
		<table class="table table-stripped">
            <thead class=" ">
			<tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Berat Satuan</th>
                <th>Total Berat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody id="deliveryItemsList">
                <!-- Items will be populated here -->
            </tbody>
            <tfoot class=" total-row">
			<tr>
                <td><strong>TOTAL</strong></td>
                <td id="totalQuantity">0</td>
                <td>-</td>
                <td id="totalWeight">0 gram</td>
                <td></td>
			</tr>
            </tfoot>
        </table>
        
        <!-- Add Item Form -->
        <div class="add-item-form" id="addItemForm">
            <h4>Tambah Item Baru</h4>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Pilih Produk</label>
                    <select class="form-select" id="newItemProduct">
                        <option value="">Pilih produk...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-input" id="newItemQuantity" value="1" min="1">
                </div>
                <div class="form-group">
                    <label class="form-label">Berat (gram)</label>
                    <input type="number" class="form-input" id="newItemWeight" readonly>
                </div>
                <div class="form-actions-inline">
                    <button class="btn btn-success btn-small" id="saveNewItemBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button class="btn btn-danger btn-small" id="cancelNewItemBtn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Items List -->
        
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
        </div>
        
        <!-- Modal Scan Resi -->
		<!-- Modal Confirm Delete -->
<div class="modal" id="confirmDeleteModal">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <h2 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h2>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus item ini?</p>
            <div class="form-actions">
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
                <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">Batal</button>
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
        
        <!-- Modal Add Delivery -->
        <div class="modal" id="addDeliveryModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-plus"></i> Tambah Delivery Order</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Pilih Pesanan</label>
                        <select class="form-select" id="selectOrder">
                            <option value="">Pilih pesanan...</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pilih Items</label>
                        <div class="items-grid" id="itemsGrid">
                            <!-- Items will be populated here -->
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Kurir</label>
                        <select class="form-select" id="deliveryCourier">
                            <option value="">Pilih kurir...</option>
                            <option value="JNE">JNE</option>
                            <option value="TIKI">TIKI</option>
                            <option value="POS">POS Indonesia</option>
                            <option value="J&T">J&T</option>
                            <option value="SiCepat">SiCepat</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Layanan</label>
                        <select class="form-select" id="deliveryService">
                            <option value="">Pilih layanan...</option>
                            <option value="REG">Reguler</option>
                            <option value="ECO">Economy</option>
                            <option value="YES">YES</option>
                            <option value="ONS">One Day Service</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-danger" id="cancelAddDelivery">Batal</button>
                        <button type="button" class="btn btn-success" id="confirmAddDelivery">Tambah Delivery</button>
                    </div>
                </div>
            </div>
        </div>
        `;
		
        document.getElementById('pages_content').innerHTML = tableHTML;
			}
            renderDeliveryList() {
    let tableHTML = '';
    
    this.filteredDeliveries.forEach(delivery => {
        const statusClass = this.getDeliveryStatusClass(delivery.status);
        const statusText = this.getDeliveryStatusText(delivery.status);
        const orderDate = new Date(delivery.tanggal_do).toLocaleDateString('id-ID');
        const expeditionName = this.getExpeditionName(delivery.id_ekpedisi);
        
        tableHTML += `
            <tr data-delivery-id="${delivery.id}">
                <td>
                    <div class="order-id">${delivery.id}</div>
                </td>
                <td>
                    <div class="customer-name">${delivery.id_erp__pos__utama}</div>
                </td>
                <td>
                    <div><strong>${expeditionName}</strong></div>
                    <div class="order-date">${delivery.nomor_resi || 'Belum ada resi'}</div>
                </td>
                <td>${orderDate}</td>
                <td>
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn btn-view" data-action="view">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                        ${delivery.status === 'pending' ? `
                            <button class="action-btn btn-edit" data-action="scan">
                                <i class="fas fa-qrcode"></i> Scan Resi
                            </button>
                        ` : ''}
                        ${delivery.status === 'dikirim' ? `
                            <button class="action-btn btn-success" data-action="delivered">
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
setupDeliveryActions() {
    document.getElementById('deliveryTableBody').addEventListener('click', (e) => {
        const button = e.target.closest('[data-action]');
        if (!button) return;
        
        const row = e.target.closest('tr');
        const deliveryId = row.getAttribute('data-delivery-id');
        const action = button.getAttribute('data-action');
        
        switch (action) {
            case 'view':
                this.viewDeliveryDetail(deliveryId);
                break;
            case 'scan':
                this.scanResiForDelivery(deliveryId);
                break;
            case 'delivered':
                this.markAsDelivered(deliveryId);
                break;
        }
    });
}
            viewDeliveryDetail(deliveryId) {
                this.currentDelivery = this.deliveryOrders.find(d => d.id === deliveryId);
                if (!this.currentDelivery) return;
                
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
            showAddItemForm() {
    document.getElementById('addItemForm').style.display = 'block';
    this.populateProductSelect();
    document.getElementById('newItemQuantity').value = '1';
    document.getElementById('newItemWeight').value = '';
}

hideAddItemForm() {
    document.getElementById('addItemForm').style.display = 'none';
}

populateProductSelect() {
    const select = document.getElementById('newItemProduct');
    select.innerHTML = '<option value="">Pilih produk...</option>';
    
    this.products.forEach(product => {
        const option = document.createElement('option');
        option.value = product.id;
        option.textContent = `${product.nama} - Stok: ${product.stok}`;
        option.dataset.weight = product.berat;
        select.appendChild(option);
    });
}
// Add this method to handle item actions
setupItemActions() {
    const itemsList = document.getElementById('deliveryItemsList');
    if (!itemsList) return;
    
    itemsList.addEventListener('click', (e) => {
        const button = e.target.closest('[data-action]');
        if (!button) return;
        
        const row = e.target.closest('.item-row');
        const index = parseInt(row.getAttribute('data-item-index'));
        const action = button.getAttribute('data-action');
        
        switch (action) {
            case 'increase-quantity':
                this.increaseItemQuantity(index);
                break;
            case 'decrease-quantity':
                this.decreaseItemQuantity(index);
                break;
            case 'edit-item':
                this.editItem(index);
                break;
            case 'delete-item':
                this.deleteItem(index);
                break;
        }
    });
}
populateDeliveryItems() {
    if (!this.currentDelivery) return;
    
    const itemsList = document.getElementById('deliveryItemsList');
    let itemsHTML = '';
    
    if (this.currentDelivery.detail.length === 0) {
        itemsHTML = `
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Belum ada item dalam pengiriman ini</p>
            </div>
        `;
    } else {
		console.log(this.currentDelivery);
        this.currentDelivery.detail.forEach((item, index) => {
            const product = this.products.find(p => p.id == item.id_inventaris__asset__list_do);
            const productName = product ? product.nama : `Item ${item.id_inventaris__asset__list_do}`;
            const productWeight = product ? product.berat : item.berat_satuan_do;
            
            itemsHTML += ` 
			<tr>
                            <td>${productName}</td>
                            <td>${item.qty_kirim} pcs</td>
                            <td>${item.berat_total_do} gram</td>
                            <td>
                                <span class="status-badge ${item.sisa_qty_kirim === 0 ? 'status-delivered' : 'status-processing'}">
                                    ${item.sisa_qty_kirim === 0 ? 'Terkirim' : 'Proses'}
                                </span>
                            </td>
							<td>
							<button class="btn-small btn-edit-small" data-action="edit-item">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn-small btn-delete-small" data-action="delete-item">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
							</td>
                        </tr>
                
            `;
        });
    }
    
    itemsList.innerHTML = itemsHTML;
    this.updateTotals();
    
    // Setup item actions
    this.setupItemActions();
}

updateTotals() {
    if (!this.currentDelivery) return;
    
    const totalQuantity = this.currentDelivery.detail.reduce((sum, item) => sum + parseInt(item.qty_kirim), 0);
    const totalWeight = this.currentDelivery.detail.reduce((sum, item) => sum + parseInt(item.berat_total_do), 0);
    
    document.getElementById('totalQuantity').textContent = totalQuantity;
    document.getElementById('totalWeight').textContent = totalWeight + ' gram';
    
    // Update total berat di delivery data
    this.currentDelivery.total_berat = totalWeight.toString();
}

increaseItemQuantity(index) {
    if (!this.currentDelivery || !this.currentDelivery.detail[index]) return;
    
    const item = this.currentDelivery.detail[index];
    const product = this.products.find(p => p.id == item.id_inventaris__asset__list_do);
    
    if (product && item.qty_kirim < product.stok) {
        item.qty_kirim++;
        item.berat_total_do = item.berat_satuan_do * item.qty_kirim;
        this.saveItemUpdate();
        this.populateDeliveryItems();
    }
}

decreaseItemQuantity(index) {
    if (!this.currentDelivery || !this.currentDelivery.detail[index]) return;
    
    const item = this.currentDelivery.detail[index];
    if (item.qty_kirim > 1) {
        item.qty_kirim--;
        item.berat_total_do = item.berat_satuan_do * item.qty_kirim;
        this.saveItemUpdate();
        this.populateDeliveryItems();
    }
}
editItem(index) {
    const itemRow = document.querySelector(`[data-item-index="${index}"]`);
    const item = this.currentDelivery.detail[index];
    const product = this.products.find(p => p.id == item.id_inventaris__asset__list_do);
    
    itemRow.innerHTML = `
        <div>
            <select class="form-select" data-edit-field="product">
                ${this.products.map(p => 
                    `<option value="${p.id}" ${p.id == item.id_inventaris__asset__list_do ? 'selected' : ''}
                     data-weight="${p.berat}">${p.nama}</option>`
                ).join('')}
            </select>
        </div>
        <div>
            <input type="number" class="form-input" data-edit-field="quantity" value="${item.qty_kirim}" min="1" max="${product ? product.stok : 100}">
        </div>
        <div data-edit-field="weight">${product ? product.berat : item.berat_satuan_do} gram</div>
        <div data-edit-field="total-weight">${item.berat_total_do} gram</div>
        <div class="item-actions-buttons">
            <button class="btn-small btn-save-small" data-action="save-edit">
                <i class="fas fa-save"></i> Simpan
            </button>
            <button class="btn-small btn-cancel-small" data-action="cancel-edit">
                <i class="fas fa-times"></i> Batal
            </button>
        </div>
    `;
    
    itemRow.classList.add('editing');
    itemRow.setAttribute('data-editing-index', index);
    
    // Setup edit mode event listeners
    this.setupEditModeListeners(itemRow);
}

// Add this method for edit mode
setupEditModeListeners(itemRow) {
    const index = parseInt(itemRow.getAttribute('data-editing-index'));
    
    // Product change
    const productSelect = itemRow.querySelector('[data-edit-field="product"]');
    productSelect.addEventListener('change', () => {
        this.updateEditItemWeight(itemRow);
    });
    
    // Quantity change
    const quantityInput = itemRow.querySelector('[data-edit-field="quantity"]');
    quantityInput.addEventListener('input', () => {
        this.updateEditItemWeight(itemRow);
    });
    
    // Save button
    const saveBtn = itemRow.querySelector('[data-action="save-edit"]');
    saveBtn.addEventListener('click', () => {
        this.saveItemEdit(index, itemRow);
    });
    
    // Cancel button
    const cancelBtn = itemRow.querySelector('[data-action="cancel-edit"]');
    cancelBtn.addEventListener('click', () => {
        this.cancelItemEdit(index);
    });
}
updateEditItemWeight(itemRow) {
    const productSelect = itemRow.querySelector('[data-edit-field="product"]');
    const quantityInput = itemRow.querySelector('[data-edit-field="quantity"]');
    const selectedProduct = this.products.find(p => p.id == productSelect.value);
    
    if (selectedProduct) {
        const weight = selectedProduct.berat;
        const quantity = parseInt(quantityInput.value) || 1;
        const totalWeight = weight * quantity;
        
        itemRow.querySelector('[data-edit-field="weight"]').textContent = weight + ' gram';
        itemRow.querySelector('[data-edit-field="total-weight"]').textContent = totalWeight + ' gram';
    }
}

saveItemEdit(index, itemRow) {
    const productSelect = itemRow.querySelector('[data-edit-field="product"]');
    const quantityInput = itemRow.querySelector('[data-edit-field="quantity"]');
    
    const productId = productSelect.value;
    const quantity = parseInt(quantityInput.value) || 1;
    const product = this.products.find(p => p.id == productId);
    
    if (!product) {
        setShowAlert("Produk tidak ditemukan", "danger");
        return;
    }
    
    const item = this.currentDelivery.detail[index];
    item.id_inventaris__asset__list_do = productId;
    item.qty_kirim = quantity;
    item.berat_satuan_do = product.berat;
    item.berat_total_do = product.berat * quantity;
    
    this.saveItemUpdate();
    this.populateDeliveryItems();
}

cancelItemEdit(index) {
    this.populateDeliveryItems();
}

deleteItem(index) {
    this.itemToDelete = index;
    document.getElementById('confirmDeleteModal').style.display = 'block';
}

confirmDeleteItem() {
    if (this.itemToDelete !== null && this.currentDelivery) {
        this.currentDelivery.detail.splice(this.itemToDelete, 1);
        this.saveItemUpdate();
        this.populateDeliveryItems();
        this.closeDeleteModal();
    }
}

closeDeleteModal() {
    document.getElementById('confirmDeleteModal').style.display = 'none';
    this.itemToDelete = null;
}

saveNewItem() {
    const productSelect = document.getElementById('newItemProduct');
    const quantityInput = document.getElementById('newItemQuantity');
    
    const productId = productSelect.value;
    const quantity = parseInt(quantityInput.value) || 1;
    const product = this.products.find(p => p.id == productId);
    
    if (!productId || !product) {
        setShowAlert("Pilih produk terlebih dahulu", "danger");
        return;
    }
    
    if (quantity < 1) {
        setShowAlert("Jumlah harus lebih dari 0", "danger");
        return;
    }
    
    const newItem = {
        id: Date.now(),
        id_inventaris__asset__list_do: productId,
        qty_pesan_do: quantity,
        berat_satuan_do: product.berat,
        berat_total_do: product.berat * quantity,
        qty_kirim: quantity,
        sisa_qty_kirim: 0
    };
    
    if (!this.currentDelivery.detail) {
        this.currentDelivery.detail = [];
    }
    
    this.currentDelivery.detail.push(newItem);
    this.saveItemUpdate();
    this.populateDeliveryItems();
    this.hideAddItemForm();
}

async saveItemUpdate() {
    if (!this.currentDelivery) return;
    
    try {
        const response = await fetch(`/api/delivery_orders/${this.currentDelivery.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(this.currentDelivery)
        });
        
        if (!response.ok) {
            throw new Error('Failed to update delivery items');
        }
        
        // Update total weight
        this.currentDelivery.total_berat = this.currentDelivery.detail.reduce((sum, item) => 
            sum + parseInt(item.berat_total_do), 0).toString();
            
    } catch (error) {
        console.error('Error updating delivery items:', error);
        setShowAlert("Gagal menyimpan perubahan item", "danger");
    }
}
            populateDeliveryDetail() {
                if (!this.currentDelivery) return;
                
                // Set basic delivery info
                document.getElementById('detailOrderId').textContent = this.currentDelivery.id;
                
                // Set delivery info
                document.getElementById('infoDeliveryStatus').textContent = this.getDeliveryStatusText(this.currentDelivery.status);
                document.getElementById('infoCourier').textContent = this.getExpeditionName(this.currentDelivery.id_ekpedisi);
                document.getElementById('infoResi').textContent = this.currentDelivery.nomor_resi || 'Belum ada resi';
                document.getElementById('infoService').textContent = this.currentDelivery.paket_ongkir;
                document.getElementById('infoEstimation').textContent = this.currentDelivery.estimasi_kirim + ' hari';
                
                // Set status dot color
                const statusDot = document.getElementById('statusDot');
                statusDot.className = 'status-dot ' + this.currentDelivery.status;
                
                // Set recipient info
                const order = this.orders.find(o => o.id === this.currentDelivery.id_erp__pos__utama);
                if (order) {
                    document.getElementById('infoRecipient').textContent = order.user_detail.nama;
                    document.getElementById('infoRecipientPhone').textContent = order.user_detail.telepon;
                    document.getElementById('infoRecipientAddress').textContent = this.currentDelivery.alamat_tujuan;
                }
				this.populateDeliveryItems();
                // Populate items
                let itemsHTML = '';
                this.currentDelivery.detail.forEach(item => {
                    const product = this.products.find(p => p.id == item.id_inventaris__asset__list_do);
                    const productName = product ? product.nama : `Item ${item.id_inventaris__asset__list_do}`;
                    
                    itemsHTML += `
                        <tr>
                            <td>${productName}</td>
                            <td>${item.qty_kirim} pcs</td>
                            <td>${item.berat_total_do} gram</td>
                            <td>
                                <span class="status-badge ${item.sisa_qty_kirim === 0 ? 'status-delivered' : 'status-processing'}">
                                    ${item.sisa_qty_kirim === 0 ? 'Terkirim' : 'Proses'}
                                </span>
                            </td>
                        </tr>
                    `;
                });
                document.getElementById('deliveryItemsList').innerHTML = itemsHTML;
                
                // Populate timeline
                let timelineHTML = '';
                if (this.currentDelivery.history) {
                    this.currentDelivery.history.forEach(event => {
                        timelineHTML += `
                            <div class="timeline-item">
                                <div class="timeline-date">${event.date}</div>
                                <div class="timeline-content">${event.action} - ${event.user}</div>
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
                this.currentDelivery = null;
            }
            
            scanResiForDelivery(deliveryId) {
                this.currentDelivery = this.deliveryOrders.find(d => d.id === deliveryId);
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
                    setShowAlert("Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.", "danger");
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
                
                let matchHTML = '';
                if (this.currentDelivery) {
                    matchHTML = `
                        <div style="margin-top: 10px; padding: 10px; background: #e8f5e9; border-radius: 4px;">
                            <i class="fas fa-check-circle" style="color: #28a745;"></i>
                            <strong>Delivery Ditemukan:</strong> ${this.currentDelivery.id}<br>
                            <strong>Status:</strong> ${this.getDeliveryStatusText(this.currentDelivery.status)}
                        </div>
                    `;
                } else {
                    const matchedDelivery = this.deliveryOrders.find(delivery => 
                        delivery.nomor_resi === resi
                    );
                    
                    if (matchedDelivery) {
                        matchHTML = `
                            <div style="margin-top: 10px; padding: 10px; background: #e8f5e9; border-radius: 4px;">
                                <i class="fas fa-check-circle" style="color: #28a745;"></i>
                                <strong>Delivery Ditemukan:</strong> ${matchedDelivery.id}<br>
                                <strong>Status:</strong> ${this.getDeliveryStatusText(matchedDelivery.status)}
                            </div>
                        `;
                        this.currentDelivery = matchedDelivery;
                    } else {
                        matchHTML = `
                            <div style="margin-top: 10px; padding: 10px; background: #fff3cd; border-radius: 4px;">
                                <i class="fas fa-exclamation-triangle" style="color: #ffc107;"></i>
                                <strong>Tidak ada delivery yang cocok.</strong> Pastikan resi sesuai.
                            </div>
                        `;
                    }
                }
                
                document.getElementById('orderMatchInfo').innerHTML = matchHTML;
                document.getElementById('scanPreview').style.display = 'block';
            }
            
            confirmResi() {
                if (!this.scannedResi) {
                    setShowAlert("Silakan scan atau masukkan nomor resi terlebih dahulu.", "danger");
                    return;
                }
                
                if (this.currentDelivery) {
                    // Update delivery dengan resi yang discan
                    this.currentDelivery.nomor_resi = this.scannedResi;
                    this.currentDelivery.status = 'dikirim';
                    
                    // Tambahkan history
					if (!Array.isArray(this.currentDelivery.history)) {
					  try {
						// Kalau awalnya dalam bentuk string JSON
						this.currentDelivery.history = JSON.parse(this.currentDelivery.history || '[]');
					  } catch (e) {
						this.currentDelivery.history = [];
					  }
					}

                    this.currentDelivery.history.push({
                        date: new Date().toISOString().split('T')[0],
                        action: `Resi ${this.scannedResi} berhasil discan dan dikonfirmasi`,
                        user: "Admin"
                    });
                    
                    // Simpan ke API
                    this.saveDeliveryUpdate(this.currentDelivery);
                    
                    alert(`Resi ${this.scannedResi} berhasil dikonfirmasi untuk delivery ${this.currentDelivery.id}`);
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
            
            async saveDeliveryUpdate(delivery) {
                try {
                    const response = await fetch(`/api/delivery_orders/${delivery.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(delivery)
                    });
                    
                    if (!response.ok) {
                        throw new Error('Failed to update delivery');
                    }
                } catch (error) {
                    console.error('Error updating delivery:', error);
                }
            }
            
            markAsShipped() {
                if (!this.currentDelivery) return;
                
                this.currentDelivery.status = 'dikirim';
                this.currentDelivery.history.push({
                    date: new Date().toISOString().split('T')[0],
                    action: "Pesanan telah dikirim",
                    user: "Admin"
                });
                
                this.saveDeliveryUpdate(this.currentDelivery);
                
                alert(`Delivery ${this.currentDelivery.id} berhasil ditandai sebagai dikirim`);
                this.renderDeliveryList();
                this.updateStats();
                this.populateDeliveryDetail();
            }
            
            markAsDelivered(deliveryId) {
                const delivery = this.deliveryOrders.find(d => d.id === deliveryId);
                if (!delivery) return;
                
                delivery.status = 'diterima';
                delivery.history.push({
                    date: new Date().toISOString().split('T')[0],
                    action: "Pesanan telah diterima oleh pelanggan",
                    user: "Admin"
                });
                
                this.saveDeliveryUpdate(delivery);
                
                alert(`Delivery ${deliveryId} berhasil ditandai sebagai diterima`);
                this.renderDeliveryList();
                this.updateStats();
            }
            
            processDelivery() {
                if (!this.currentDelivery) return;
                
                this.currentDelivery.status = 'diproses';
                this.currentDelivery.history.push({
                    date: new Date().toISOString().split('T')[0],
                    action: "Pesanan sedang diproses untuk pengiriman",
                    user: "Admin"
                });
                
                this.saveDeliveryUpdate(this.currentDelivery);
                
                alert(`Delivery ${this.currentDelivery.id} sedang diproses`);
                this.renderDeliveryList();
                this.updateStats();
                this.populateDeliveryDetail();
            }
            
            filterDeliveries() {
                const searchTerm = document.getElementById('searchDelivery').value.toLowerCase();
                const statusFilter = document.getElementById('deliveryStatusFilter').value;
                const courierFilter = document.getElementById('courierFilter').value;
                const dateFilter = document.getElementById('deliveryDate').value;
                
                this.filteredDeliveries = this.deliveryOrders.filter(delivery => {
                    const matchesSearch = delivery.id.toLowerCase().includes(searchTerm) || 
                                         (delivery.nomor_resi && delivery.nomor_resi.toLowerCase().includes(searchTerm));
                    
                    const matchesStatus = !statusFilter || delivery.status === statusFilter;
                    
                    const expeditionName = this.getExpeditionName(delivery.id_ekpedisi);
                    const matchesCourier = !courierFilter || expeditionName === courierFilter;
                    
                    let matchesDate = true;
                    if (dateFilter) {
                        matchesDate = delivery.tanggal_do === dateFilter;
                    }
                    
                    return matchesSearch && matchesStatus && matchesCourier && matchesDate;
                });
                
                this.renderDeliveryList();
                this.updateStats();
            }
            
            updateStats() {
                const deliveries = this.deliveryOrders;
                document.getElementById('totalDeliveries').textContent = deliveries.length;
                document.getElementById('pendingDeliveries').textContent = 
                    deliveries.filter(d => d.status === 'pending').length;
                document.getElementById('shippedDeliveries').textContent = 
                    deliveries.filter(d => d.status === 'dikirim').length;
                document.getElementById('deliveredDeliveries').textContent = 
                    deliveries.filter(d => d.status === 'diterima').length;
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
            
            getExpeditionName(expeditionId) {
                const expeditions = {
                    "24": "JNE",
                    "25": "TIKI",
                    "26": "POS Indonesia",
                    "27": "J&T",
                    "28": "SiCepat"
                };
                return expeditions[expeditionId] || expeditionId;
            }
            
            // Add Delivery Order Methods
            openAddDeliveryModal() {
                document.getElementById('addDeliveryModal').style.display = 'block';
                this.populateOrderSelect();
                this.selectedItems = [];
            }
            
            populateOrderSelect() {
                const select = document.getElementById('selectOrder');
                select.innerHTML = '<option value="">Pilih pesanan...</option>';
                
                this.orders.forEach(order => {
                    if (order.status === 'diproses') {
                        const option = document.createElement('option');
                        option.value = order.id;
                        option.textContent = `${order.id} - ${order.user_detail.nama}`;
                        select.appendChild(option);
                    }
                });
            }
            
            populateItemsGrid(orderId) {
                const order = this.orders.find(o => o.id === orderId);
                if (!order) return;
                
                const itemsGrid = document.getElementById('itemsGrid');
                itemsGrid.innerHTML = '';
                
                order.produk_list.forEach(item => {
                    const product = this.products.find(p => p.id == item.id);
                    if (!product) return;
                    
                    const itemCard = document.createElement('div');
                    itemCard.className = 'item-card';
                    itemCard.innerHTML = `
                        <div class="item-name">${product.nama}</div>
                        <div class="item-details">
                            Berat: ${product.berat} gram<br>
                            Stok: ${product.stok} pcs
                        </div>
                        <div class="item-quantity">
                            <label>Jumlah dikirim:</label>
                            <div class="quantity-controls">
                                <button class="quantity-btn" onclick="deliveryUI.decreaseQuantity('${item.id}')">-</button>
                                <input type="text" class="quantity-display" id="qty-${item.id}" value="0" readonly>
                                <button class="quantity-btn" onclick="deliveryUI.increaseQuantity('${item.id}', ${item.jumlah})">+</button>
                            </div>
                        </div>
                    `;
                    
                    itemsGrid.appendChild(itemCard);
                });
            }
            
            increaseQuantity(itemId, maxQuantity) {
                const input = document.getElementById(`qty-${itemId}`);
                let currentValue = parseInt(input.value) || 0;
                if (currentValue < maxQuantity) {
                    input.value = currentValue + 1;
                    this.updateSelectedItems(itemId, currentValue + 1);
                }
            }
            
            decreaseQuantity(itemId) {
                const input = document.getElementById(`qty-${itemId}`);
                let currentValue = parseInt(input.value) || 0;
                if (currentValue > 0) {
                    input.value = currentValue - 1;
                    this.updateSelectedItems(itemId, currentValue - 1);
                }
            }
            
            updateSelectedItems(itemId, quantity) {
                const existingIndex = this.selectedItems.findIndex(item => item.id === itemId);
                
                if (quantity > 0) {
                    if (existingIndex >= 0) {
                        this.selectedItems[existingIndex].quantity = quantity;
                    } else {
                        const product = this.products.find(p => p.id == itemId);
                        if (product) {
                            this.selectedItems.push({
                                id: itemId,
                                quantity: quantity,
                                product: product
                            });
                        }
                    }
                } else {
                    if (existingIndex >= 0) {
                        this.selectedItems.splice(existingIndex, 1);
                    }
                }
            }
            
            async confirmAddDelivery() {
                const orderId = document.getElementById('selectOrder').value;
                const courier = document.getElementById('deliveryCourier').value;
                const service = document.getElementById('deliveryService').value;
                
                if (!orderId || !courier || this.selectedItems.length === 0) {
                    setShowAlert("Harap lengkapi semua field dan pilih minimal 1 item", "danger");
                    return;
                }
                
                const newDelivery = {
                    id: Date.now().toString(),
                    nomor_do: null,
                    tanggal_do: new Date().toISOString().split('T')[0],
                    id_erp__pos__utama: orderId,
                    id_ekpedisi: this.getExpeditionId(courier),
                    paket_ongkir: service,
                    nomor_resi: "-",
                    status: "pending",
                    detail: this.selectedItems.map(item => ({
                        id_inventaris__asset__list_do: item.id,
                        qty_pesan_do: item.quantity,
                        berat_satuan_do: item.product.berat,
                        berat_total_do: item.product.berat * item.quantity,
                        qty_kirim: item.quantity,
                        sisa_qty_kirim: 0
                    })),
                    total_berat: this.selectedItems.reduce((total, item) => 
                        total + (item.product.berat * item.quantity), 0).toString(),
                    history: [
                        {
                            date: new Date().toISOString().split('T')[0],
                            action: "Delivery order dibuat",
                            user: "Admin"
                        }
                    ]
                };
                
                try {
                    const response = await fetch('/api/delivery_orders', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(newDelivery)
                    });
                    
                    if (response.ok) {
                        this.deliveryOrders.push(newDelivery);
                        this.filteredDeliveries = [...this.deliveryOrders];
                        this.renderDeliveryList();
                        this.updateStats();
                        this.closeAddDeliveryModal();
                        setShowAlert("Delivery order berhasil ditambahkan!", "success");
                    } else {
                        throw new Error('Failed to create delivery order');
                    }
                } catch (error) {
                    console.error('Error creating delivery order:', error);
                    setShowAlert("Gagal menambahkan delivery order", "danger");
                }
            }
            
            getExpeditionId(expeditionName) {
                const expeditions = {
                    "JNE": "24",
                    "TIKI": "25",
                    "POS Indonesia": "26",
                    "J&T": "27",
                    "SiCepat": "28"
                };
                return expeditions[expeditionName] || "24";
            }
            
            closeModal() {
                document.getElementById('scanResiModal').style.display = 'none';
                this.stopCamera();
                document.getElementById('resiScanInput').value = '';
                this.scannedResi = '';
            }
            
            closeAddDeliveryModal() {
                document.getElementById('addDeliveryModal').style.display = 'none';
                document.getElementById('selectOrder').value = '';
                document.getElementById('deliveryCourier').value = '';
                document.getElementById('deliveryService').value = '';
                document.getElementById('itemsGrid').innerHTML = '';
                this.selectedItems = [];
            }
            
            setupEventListeners() {
                // Filter event listeners
				
				 this.setupDeliveryActions();
				 
                document.getElementById('searchDelivery').addEventListener('input', () => this.filterDeliveries());
                document.getElementById('deliveryStatusFilter').addEventListener('change', () => this.filterDeliveries());
                document.getElementById('courierFilter').addEventListener('change', () => this.filterDeliveries());
                document.getElementById('deliveryDate').addEventListener('change', () => this.filterDeliveries());
				document.getElementById('addItemBtn').addEventListener('click', () => this.showAddItemForm());
				document.getElementById('refreshItemsBtn').addEventListener('click', () => this.populateDeliveryItems());
				document.getElementById('newItemProduct').addEventListener('change', (e) => {
					const selectedProduct = this.products.find(p => p.id == e.target.value);
					if (selectedProduct) {
						document.getElementById('newItemWeight').value = selectedProduct.berat;
					}
				});
				document.getElementById('saveNewItemBtn').addEventListener('click', () => this.saveNewItem());
				document.getElementById('cancelNewItemBtn').addEventListener('click', () => this.hideAddItemForm());

				// Delete confirmation event listeners
				document.getElementById('confirmDeleteBtn').addEventListener('click', () => this.confirmDeleteItem());
				document.getElementById('cancelDeleteBtn').addEventListener('click', () => this.closeDeleteModal());

				// Close delete modal with X button
				document.querySelectorAll('.close-modal').forEach(btn => {
					btn.addEventListener('click', () => {
						this.closeModal();
						this.closeAddDeliveryModal();
						this.closeDeleteModal();
					});
				});
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
                
                // Scan resi buttons
                document.getElementById('scanResiBtn').addEventListener('click', () => this.scanResi());
                document.getElementById('scanResiDetailBtn').addEventListener('click', () => this.scanResiForDelivery(this.currentDelivery.id));
                
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
                    if (swalConfirm('Apakah Anda yakin ingin membatalkan pengiriman ini?')) {
                        setShowAlert("Pengiriman dibatalkan", "danger");
                    }
                });
                
                // Add delivery buttons
                document.getElementById('addDeliveryBtn').addEventListener('click', () => this.openAddDeliveryModal());
                document.getElementById('selectOrder').addEventListener('change', (e) => {
                    this.populateItemsGrid(e.target.value);
                });
                document.getElementById('confirmAddDelivery').addEventListener('click', () => this.confirmAddDelivery());
                document.getElementById('cancelAddDelivery').addEventListener('click', () => this.closeAddDeliveryModal());
                
                // Cancel buttons
                document.getElementById('cancelScan').addEventListener('click', () => this.closeModal());
                
                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target.classList.contains('modal')) {
                        this.closeModal();
                        this.closeAddDeliveryModal();
                    }
                });
                
                // Close modal with X button
                document.querySelectorAll('.close-modal').forEach(btn => {
                    btn.addEventListener('click', () => {
                        this.closeModal();
                        this.closeAddDeliveryModal();
                    });
                });
            }

        }