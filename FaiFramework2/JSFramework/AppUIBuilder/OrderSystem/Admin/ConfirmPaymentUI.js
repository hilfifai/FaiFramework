import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';
export default class confirmPaymentUI extends OrderSystemBuilder{

            constructor() {
				super();
                this.payments = [];
                this.filteredPayments = [];
                this.currentPayment = null;
                this.currentView = 'list'; // 'list' or 'detail'
            }
            
            async init(config) {
				this.config = config;
                this.render();
               await this.processPaymentData();
                this.renderPaymentList();
                this.setupEventListeners();
                this.updateStats();
            }
			async processPaymentData() {
				this.orderSystemJson = await this.loadData(["payments"]);
				const paymentDataArray = this.orderSystemJson.payments || [];

				this.payments = [];

				paymentDataArray.forEach(payment => {
					let splitBills = [];

					// Parse split_bill jika string
					try {
						if (typeof payment.split_bill === 'string') {
							splitBills = JSON.parse(payment.split_bill);
						} else if (Array.isArray(payment.split_bill)) {
							splitBills = payment.split_bill;
						}
					} catch (e) {
						console.error('Gagal parse split_bill untuk payment ID:', payment.id, e);
						splitBills = [];
					}

					// Jika tidak ada split_bill, buat satu default payment entry
					if (!splitBills.length) {
						/*this.payments.push({
							id: payment.id,
							paymentId: payment.id_erp__pos__payment,
							date: payment.tanggal_payment,
							totalAmount: payment.total_bayar,
							status: 'pending',
							method: 'Manual Bank Transfer',
							bank: 'Bank Mandiri',
							accountNumber: '1300014688181',
							accountName: 'Afifah Rahmani',
							senderName: '',
							senderAccount: '',
							paymentDate: '',
							paymentAmount: '',
							note: '',
							confirmationId: null
						});
						return;
						*/
					}

					// Proses tiap split_bill
					splitBills.forEach(split => {
						const konfirmasiList = Array.isArray(split.konfirm) ? split.konfirm : [];

						if (konfirmasiList.length > 0) {
							
							konfirmasiList.forEach(konfirm => {
								if(konfirm.nominal_bayar && konfirm.nama_rekening_pengirim){
								this.payments.push({
									id: payment.id,
									paymentId: payment.id_erp__pos__payment,
									date: payment.tanggal_payment,
									totalAmount: payment.total_bayar,
									status: 'pending',
									method: split.nama_payment,
									bank: split.brand_nama,
									accountNumber: split.no_rek,
									accountName: split.an,
									senderName: konfirm.nama_rekening_pengirim,
									senderAccount: konfirm.nomor_rekening_pengirim,
									paymentDate: konfirm.tanggal_pembayaran,
									paymentAmount: konfirm.nominal_bayar,
									note: konfirm.catatan,
									confirmationId: konfirm.id
								});
							}
							});
						} else {
							// Jika tidak ada konfirmasi
							/*this.payments.push({
								id: payment.id,
								paymentId: payment.id_erp__pos__payment,
								date: payment.tanggal_payment,
								totalAmount: payment.total_bayar,
								status: 'pending',
								method: split.nama_payment,
								bank: split.brand_nama,
								accountNumber: split.no_rek,
								accountName: split.an,
								senderName: '',
								senderAccount: '',
								paymentDate: '',
								paymentAmount: '',
								note: '',
								confirmationId: null
							});*/
						}
					});
				});

				// Optional: bisa disaring atau disorting di sini
				this.filteredPayments = [...this.payments];
			}

			render() {
					let HTML = `<div class="admin-container">
           
            <div class="admin-content">
                <!-- Payment List View -->
                <div id="paymentListView">
                    <div class="admin-header">
                        <h2 class="admin-title">Daftar Konfirmasi Pembayaran</h2>
                        <div class="admin-actions">
                            <button class="btn btn-primary" id="refreshBtn">
                                <i class="fas fa-sync"></i> Refresh
                            </button>
                            <button class="btn btn-success">
                                <i class="fas fa-file-export"></i> Ekspor
                            </button>
                        </div>
                    </div>
                    
                    <div class="filter-section">
                        <div class="filter-grid">
                            <div class="filter-group">
                                <label class="filter-label">Cari Pembayaran</label>
                                <input type="text" class="filter-input" id="searchPayment" placeholder="ID Pembayaran atau Nomor">
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Status</label>
                                <select class="filter-select" id="paymentStatusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="pending">Menunggu Konfirmasi</option>
                                    <option value="confirmed">Dikonfirmasi</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Tanggal</label>
                                <input type="date" class="filter-input" id="paymentDate">
                            </div>
                        </div>
                    </div>
                    
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-title">Total Pembayaran</div>
                            <div class="stat-value" id="totalPayments">0</div>
                        </div>
                        <div class="stat-card pending">
                            <div class="stat-title">Menunggu Konfirmasi</div>
                            <div class="stat-value" id="pendingPayments">0</div>
                        </div>
                        <div class="stat-card confirmed">
                            <div class="stat-title">Terkonfirmasi</div>
                            <div class="stat-value" id="confirmedPayments">0</div>
                        </div>
                        <div class="stat-card rejected">
                            <div class="stat-title">Ditolak</div>
                            <div class="stat-value" id="rejectedPayments">0</div>
                        </div>
                    </div>
                    
                    <div class="payments-table-container">
                        <table class="payments-table">
                            <thead>
                                <tr>
                                    <th>ID Pembayaran</th>
                                    <th>Tanggal</th>
                                    <th>Total Bayar</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="paymentTableBody">
                                <!-- Payments will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Payment Detail View -->
                <div id="paymentDetailView" class="payment-detail-container">
                    <div class="content-header">
                        <button class="back-button" id="backToPaymentList">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </button>
                        <h2 class="admin-title">Detail Pembayaran: <span id="detailPaymentId"></span></h2>
                    </div>
                    
                    <div class="payment-info-grid">
                        <div class="info-card">
                            <div class="info-card-title">Informasi Pembayaran</div>
                            <div class="info-item">
                                <span class="info-label">ID Pembayaran:</span>
                                <span class="info-value" id="infoPaymentId"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tanggal:</span>
                                <span class="info-value" id="infoPaymentDate"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Total Bayar:</span>
                                <span class="info-value" id="infoTotalBayar"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Status:</span>
                                <span class="info-value" id="infoPaymentStatus"></span>
                            </div>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-title">Informasi Metode Pembayaran</div>
                            <div class="info-item">
                                <span class="info-label">Metode:</span>
                                <span class="info-value" id="infoPaymentMethod"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Bank:</span>
                                <span class="info-value" id="infoPaymentBank"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Rekening:</span>
                                <span class="info-value" id="infoPaymentAccount"></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Atas Nama:</span>
                                <span class="info-value" id="infoPaymentAccountName"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="confirmation-section">
                        <h3>Konfirmasi Pembayaran</h3>
                        <div class="info-item">
                            <span class="info-label">Nama Rekening Pengirim:</span>
                            <span class="info-value" id="infoSenderName"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nomor Rekening Pengirim:</span>
                            <span class="info-value" id="infoSenderAccount"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Pembayaran:</span>
                            <span class="info-value" id="infoPaymentDateDetail"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Nominal Bayar:</span>
                            <span class="info-value" id="infoPaymentAmount"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Catatan:</span>
                            <span class="info-value" id="infoPaymentNote"></span>
                        </div>
                        
                        <div class="confirmation-actions">
                            <button class="btn btn-success" id="confirmPaymentBtn">
                                <i class="fas fa-check"></i> Konfirmasi Pembayaran
                            </button>
                            <button class="btn btn-danger" id="rejectPaymentBtn">
                                <i class="fas fa-times"></i> Tolak Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="modal" id="confirmModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-check-circle"></i> Konfirmasi Pembayaran</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengonfirmasi pembayaran ini?</p>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="cancelConfirm">Batal</button>
                        <button type="button" class="btn btn-success" id="proceedConfirm">Ya, Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Tolak -->
        <div class="modal" id="rejectModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fas fa-times-circle"></i> Tolak Pembayaran</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Alasan Penolakan</label>
                        <textarea class="form-textarea" id="rejectReason" placeholder="Masukkan alasan penolakan pembayaran"></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="cancelReject">Batal</button>
                        <button type="button" class="btn btn-danger" id="proceedReject">Tolak Pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
        `;
		document.getElementById('pages_content').innerHTML = HTML;
            }
            
            
            
            renderPaymentList() {
                const tableBody = document.getElementById('paymentTableBody');
                let tableHTML = '';
                
                this.filteredPayments.forEach(payment => {
                    const statusClass = this.getPaymentStatusClass(payment.status);
                    const statusText = this.getPaymentStatusText(payment.status);
                    const paymentDate = new Date(payment.date).toLocaleDateString('id-ID');
                    const amountFormatted = this.formatCurrency(payment.totalAmount);
                    
                    tableHTML += `
                        <tr>
                            <td>
                                <div class="payment-id">${payment.paymentId}</div>
                            </td>
                            <td>
                                <div class="payment-date">${paymentDate}</div>
                            </td>
                            <td>
                                <div class="payment-amount">${amountFormatted}</div>
                            </td>
                            <td>${payment.method}</td>
                            <td>
                                <span class="status-badge ${statusClass}">${statusText}</span>
                            </td>
                            <td>
                               <div class="action-buttons">
									<button class="action-btn btn-view" data-payment-id="${payment.id}" data-confirmation-id="${payment.confirmationId}">
										<i class="fas fa-eye"></i> Lihat
									</button>
									${payment.status === 'pending' ? `
										<button class="action-btn btn-confirm" data-payment-id="${payment.id}" data-confirmation-id="${payment.confirmationId}">
											<i class="fas fa-check"></i> Konfirmasi
										</button>
										<button class="action-btn btn-reject" data-payment-id="${payment.id}" data-confirmation-id="${payment.confirmationId}">
											<i class="fas fa-times"></i> Tolak
										</button>
									` : ''}
								</div>
                            </td>
                        </tr>
                    `;
                });
                
                tableBody.innerHTML = tableHTML;
            }
            
            viewPaymentDetail(paymentId, confirmationId) {
    // Convert confirmationId to number if it exists
    const confId = confirmationId ? parseInt(confirmationId) : null;
    this.currentPayment = this.payments.find(p => p.id === paymentId);
    if (!this.currentPayment) return;
    
    this.showPaymentDetail();
    this.populatePaymentDetail();
}


            
            showPaymentDetail() {
                document.getElementById('paymentListView').style.display = 'none';
                document.getElementById('paymentDetailView').style.display = 'block';
                this.currentView = 'detail';
            }
            
            showPaymentList() {
                document.getElementById('paymentDetailView').style.display = 'none';
                document.getElementById('paymentListView').style.display = 'block';
                this.currentView = 'list';
            }
            
            populatePaymentDetail() {
                if (!this.currentPayment) return;
                
                // Set basic payment info
                document.getElementById('detailPaymentId').textContent = this.currentPayment.paymentId;
                document.getElementById('infoPaymentId').textContent = this.currentPayment.paymentId;
                document.getElementById('infoPaymentDate').textContent = new Date(this.currentPayment.date).toLocaleDateString('id-ID');
                document.getElementById('infoTotalBayar').textContent = this.formatCurrency(this.currentPayment.totalAmount);
                document.getElementById('infoPaymentStatus').textContent = this.getPaymentStatusText(this.currentPayment.status);
                
                // Set payment method info
                document.getElementById('infoPaymentMethod').textContent = this.currentPayment.method;
                document.getElementById('infoPaymentBank').textContent = this.currentPayment.bank;
                document.getElementById('infoPaymentAccount').textContent = this.currentPayment.accountNumber;
                document.getElementById('infoPaymentAccountName').textContent = this.currentPayment.accountName;
                
                // Set confirmation info
                document.getElementById('infoSenderName').textContent = this.currentPayment.senderName || '-';
                document.getElementById('infoSenderAccount').textContent = this.currentPayment.senderAccount || '-';
                document.getElementById('infoPaymentDateDetail').textContent = this.currentPayment.paymentDate || '-';
                document.getElementById('infoPaymentAmount').textContent = this.currentPayment.paymentAmount ? 
                    this.formatCurrency(this.currentPayment.paymentAmount) : '-';
                document.getElementById('infoPaymentNote').textContent = this.currentPayment.note || '-';
                
                // Show/hide confirmation buttons based on status
                const confirmBtn = document.getElementById('confirmPaymentBtn');
                const rejectBtn = document.getElementById('rejectPaymentBtn');
                
                if (this.currentPayment.status === 'pending') {
                    confirmBtn.style.display = 'flex';
                    rejectBtn.style.display = 'flex';
                } else {
                    confirmBtn.style.display = 'none';
                    rejectBtn.style.display = 'none';
                }
            }
             
            confirmPayment(paymentId, confirmationId) {
				const confId = confirmationId ? parseInt(confirmationId) : null;
				this.currentPayment = this.payments.find(p => p.id === paymentId);
				if (!this.currentPayment) return;
				
				// Show confirmation modal
				document.getElementById('confirmModal').style.display = 'block';
				
				// Set up event listeners for modal
				document.getElementById('proceedConfirm').onclick = () => {
					this.processConfirmation(paymentId, confId, 'confirmed');
					document.getElementById('confirmModal').style.display = 'none';
				};
			}

			rejectPayment(paymentId, confirmationId) {
				const confId = confirmationId ? parseInt(confirmationId) : null;
				this.currentPayment = this.payments.find(p => p.id === paymentId);
				if (!this.currentPayment) return;
				
				// Show rejection modal
				document.getElementById('rejectModal').style.display = 'block';
				
				// Set up event listeners for modal
				document.getElementById('proceedReject').onclick = () => {
					const rejectReason = document.getElementById('rejectReason').value;
					if (!rejectReason.trim()) {
						alert('Harap masukkan alasan penolakan');
						return;
					}
					
					this.processConfirmation(paymentId, confId, 'rejected', rejectReason);
					document.getElementById('rejectModal').style.display = 'none';
					document.getElementById('rejectReason').value = '';
				};
			}
            
            processConfirmation(paymentId, confirmationId, status, reason = '') {
                // Find the payment
                const paymentIndex = this.payments.findIndex(p => p.id === paymentId);
                if (paymentIndex === -1) return;
                
                // Update payment status
                this.payments[paymentIndex].status = status;
                
                // In a real app, you would send this to the backend
                this.sendConfirmationToBackend(paymentId, confirmationId, status, reason);
                
                // Update UI
                this.renderPaymentList();
                this.updateStats();
                
                // If we're in detail view, update the detail view
                if (this.currentView === 'detail' && this.currentPayment && this.currentPayment.id === paymentId) {
                    this.currentPayment.status = status;
                    this.populatePaymentDetail();
                }
                
                // Show success message
                this.showNotification(`Pembayaran berhasil ${status === 'confirmed' ? 'dikonfirmasi' : 'ditolak'}`, status === 'confirmed' ? 'success' : 'error');
            }
            
            sendConfirmationToBackend(paymentId, confirmationId, status, reason) {
                // In a real application, you would make an API call here
                console.log('Sending confirmation to backend:', {
                    paymentId,
                    confirmationId,
                    status,
                    reason
                });
                
                // Simulate API call
                setTimeout(() => {
                    console.log('Confirmation processed successfully');
                }, 1000);
            }
            
            filterPayments() {
                const searchTerm = document.getElementById('searchPayment').value.toLowerCase();
                const statusFilter = document.getElementById('paymentStatusFilter').value;
                const dateFilter = document.getElementById('paymentDate').value;
                
                this.filteredPayments = this.payments.filter(payment => {
                    // Search filter
                    const matchesSearch = !searchTerm || 
                        payment.paymentId.toLowerCase().includes(searchTerm) ||
                        payment.method.toLowerCase().includes(searchTerm);
                    
                    // Status filter
                    const matchesStatus = !statusFilter || payment.status === statusFilter;
                    
                    // Date filter
                    let matchesDate = true;
                    if (dateFilter) {
                        const paymentDate = new Date(payment.date).toISOString().split('T')[0];
                        matchesDate = paymentDate === dateFilter;
                    }
                    
                    return matchesSearch && matchesStatus && matchesDate;
                });
                
                this.renderPaymentList();
            }
            
            updateStats() {
                const totalPayments = this.payments.length;
                const pendingPayments = this.payments.filter(p => p.status === 'pending').length;
                const confirmedPayments = this.payments.filter(p => p.status === 'confirmed').length;
                const rejectedPayments = this.payments.filter(p => p.status === 'rejected').length;
                
                document.getElementById('totalPayments').textContent = totalPayments;
                document.getElementById('pendingPayments').textContent = pendingPayments;
                document.getElementById('confirmedPayments').textContent = confirmedPayments;
                document.getElementById('rejectedPayments').textContent = rejectedPayments;
            }
            
            getPaymentStatusClass(status) {
                switch(status) {
                    case 'pending': return 'status-pending';
                    case 'confirmed': return 'status-confirmed';
                    case 'rejected': return 'status-rejected';
                    default: return 'status-pending';
                }
            }
            
            getPaymentStatusText(status) {
                switch(status) {
                    case 'pending': return 'Menunggu Konfirmasi';
                    case 'confirmed': return 'Terkonfirmasi';
                    case 'rejected': return 'Ditolak';
                    default: return 'Menunggu Konfirmasi';
                }
            }
            
            formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }
            
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
            setupActionButtonsListeners() {
			const tableBody = document.getElementById('paymentTableBody');
			
			tableBody.addEventListener('click', (event) => {
				const button = event.target.closest('.action-btn');
				if (!button) return;
				
				const paymentId = button.getAttribute('data-payment-id');
				const confirmationId = button.getAttribute('data-confirmation-id');
				
				if (button.classList.contains('btn-view')) {
					this.viewPaymentDetail(paymentId, confirmationId);
				} else if (button.classList.contains('btn-confirm')) {
					this.confirmPayment(paymentId, confirmationId);
				} else if (button.classList.contains('btn-reject')) {
					this.rejectPayment(paymentId, confirmationId);
				}
			});
		}
            setupEventListeners() {
    // Back to list button
    document.getElementById('backToPaymentList').addEventListener('click', () => {
        this.showPaymentList();
    });
    
    // Filter inputs
    document.getElementById('searchPayment').addEventListener('input', () => {
        this.filterPayments();
    });
    
    document.getElementById('paymentStatusFilter').addEventListener('change', () => {
        this.filterPayments();
    });
    
    document.getElementById('paymentDate').addEventListener('change', () => {
        this.filterPayments();
    });
    
    // Refresh button
    document.getElementById('refreshBtn').addEventListener('click', () => {
        this.processPaymentData();
        this.renderPaymentList();
        this.updateStats();
        this.showNotification('Data pembayaran diperbarui', 'success');
    });
    
    // Detail view confirmation buttons
    document.getElementById('confirmPaymentBtn').addEventListener('click', () => {
        if (this.currentPayment) {
            this.confirmPayment(this.currentPayment.id, this.currentPayment.confirmationId);
        }
    });
    
    document.getElementById('rejectPaymentBtn').addEventListener('click', () => {
        if (this.currentPayment) {
            this.rejectPayment(this.currentPayment.id, this.currentPayment.confirmationId);
        }
    });
    
    // Modal close buttons
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });
    
    document.getElementById('cancelConfirm').addEventListener('click', function() {
        document.getElementById('confirmModal').style.display = 'none';
    });
    
    document.getElementById('cancelReject').addEventListener('click', function() {
        document.getElementById('rejectModal').style.display = 'none';
    });
    
    // Action buttons event delegation
    this.setupActionButtonsListeners();
    
    // Close modals when clicking outside
    window.addEventListener('click', (event) => {
        const confirmModal = document.getElementById('confirmModal');
        const rejectModal = document.getElementById('rejectModal');
        
        if (event.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
        
        if (event.target === rejectModal) {
            rejectModal.style.display = 'none';
        }
    });
}
        }