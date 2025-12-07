import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';
export default class PaymentTabUI extends OrderSystemBuilder {
    constructor() {
        super();
        this.payments = [];
        this.currentPayment = null;
        this.currentPoID = null;
    }

    async init(currentPoID) {
        this.currentPoID = currentPoID;
        await this.loadPaymentData(currentPoID);
        this.dom = new PaymentDOM();
        this.dom.render(this.payments, this.currentPayment);
        this.attachEventListeners();
    }

    async loadPaymentData(currentPoID) {
        try {
            let options = {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'endpoint': 'load_by_group_id',
                },
                body: JSON.stringify({ currentPoId: currentPoID }),
            };
            const response = await fetch('/api/payments', options);
            
            if (response.data && Array.isArray(response.data)) {
                this.payments = response.data;
                // Set current payment sebagai payment pertama atau buat baru jika kosong
                this.currentPayment = this.payments.length > 0 ? this.payments[0] : await this.initializeNewPayment();
            } else {
                // Jika response bukan array, inisialisasi baru
                this.payments = [];
                this.currentPayment = await this.initializeNewPayment();
            }
        } catch (error) {
            console.error('Error loading payment data:', error);
            this.payments = [];
            this.currentPayment = await this.initializeNewPayment();
        }
    }

    async initializeNewPayment() {
        // Hitung total bayar berdasarkan items purchase order
        const totalBayar = await this.calculateTotalFromItems();
        
        const newPayment = {
            id: null,
            id_erp__pos__payment: this.generatePaymentId(),
            tanggal_payment: new Date().toISOString().split('T')[0],
            total_bayar: totalBayar,
            status_payment: "Aktif",
            split_bill: [],
            create_by: this.getCurrentUserId(),
            create_date: new Date().toISOString(),
            on_domain: "v2.moesneeds.id",
            on_panel: 1,
            on_board: 42,
            on_web_apps: "3",
            privilege: "Private Website",
            timezone: "Asia/Jakarta"
        };
        
        this.payments.push(newPayment);
        return newPayment;
    }

    async calculateTotalFromItems() {
        try {
            // Ambil data purchase order items
            const poResponse = await fetch(`/api/purchase-orders/${this.currentPoID}`);
            const poData = await poResponse.json();
            
            if (poData && poData.items && Array.isArray(poData.items)) {
                return poData.items.reduce((total, item) => {
                    const grandTotal = parseFloat(item.grand_total) || 0;
                    return total + grandTotal;
                }, 0);
            }
            return 0;
        } catch (error) {
            console.error('Error calculating total from items:', error);
            return 0;
        }
    }

    getCurrentUserId() {
        // Implementasi untuk mendapatkan user ID saat ini
        return "20250123211111186799"; // Contoh user ID
    }

    generatePaymentId() {
        return `PAY-${Date.now()}`;
    }

    attachEventListeners() {
        // Event listeners akan diattach oleh DOM class
    }

    async addNewPayment() {
        const newPayment = await this.initializeNewPayment();
        this.currentPayment = newPayment;
        this.dom.render(this.payments, this.currentPayment);
        return newPayment;
    }

    switchPayment(paymentIndex) {
        if (paymentIndex >= 0 && paymentIndex < this.payments.length) {
            this.currentPayment = this.payments[paymentIndex];
            this.dom.render(this.payments, this.currentPayment);
        }
    }

    async updatePaymentTotal() {
        const newTotal = await this.calculateTotalFromItems();
        if (this.currentPayment) {
            this.currentPayment.total_bayar = newTotal.toString();
            
            // Update juga di split bill jika ada
            if (this.currentPayment.split_bill && this.currentPayment.split_bill.length > 0) {
                this.currentPayment.split_bill[0].jumlah_bayar = newTotal.toString();
            }
            
            this.dom.render(this.payments, this.currentPayment);
        }
    }

    markAsPaid(paymentData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (Math.random() > 0.1) {
                    // Update status payment
                    paymentData.status_payment = "Lunas";
                    if (paymentData.split_bill && paymentData.split_bill.length > 0) {
                        paymentData.split_bill[0].status_bayar = "sudah";
                        paymentData.split_bill[0].tanggal_bayar = new Date().toISOString().split('T')[0];
                    }
                    resolve({ success: true, message: 'Pembayaran berhasil dicatat' });
                } else {
                    reject(new Error('Gagal terhubung ke server'));
                }
            }, 1500);
        });
    }

    submitBankTransferConfirmation(confirmationData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (this.currentPayment.split_bill && this.currentPayment.split_bill.length > 0) {
                    if (!this.currentPayment.split_bill[0].konfirm) {
                        this.currentPayment.split_bill[0].konfirm = [];
                    }
                    this.currentPayment.split_bill[0].konfirm.push(confirmationData);
                }
                resolve({
                    success: true,
                    message: 'Konfirmasi transfer berhasil diproses',
                    data: {
                        confirmation_id: 'CFM-' + Date.now(),
                        processed_at: new Date().toISOString()
                    }
                });
            }, 2000);
        });
    }

    async saveSplitBill(splitBillData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                try {
                    if (!this.currentPayment.split_bill) {
                        this.currentPayment.split_bill = [];
                    }

                    const newSplitBill = {
                        id: Date.now(),
                        id_metode_bayar: splitBillData.id_metode_bayar,
                        id_payment_brand: splitBillData.id_payment_brand,
                        brand_nama: splitBillData.brand_nama,
                        no_rek: splitBillData.no_rek,
                        an: splitBillData.an,
                        jumlah_bayar: this.currentPayment.total_bayar,
                        status_bayar: "belum",
                        nama_payment: splitBillData.nama_payment,
                        kode_payment: splitBillData.kode_payment,
                        create_by: this.getCurrentUserId(),
                        create_date: new Date().toISOString()
                    };

                    this.currentPayment.split_bill.push(newSplitBill);
                    
                    resolve({
                        success: true,
                        message: 'Split bill berhasil disimpan',
                        data: newSplitBill
                    });
                } catch (error) {
                    reject(new Error('Gagal menyimpan split bill: ' + error.message));
                }
            }, 1000);
        });
    }
}

class PaymentDOM {
    constructor() {
        this.container = document.querySelector('.payment-container');
        this.alertContainer = document.getElementById('alertContainer');
    }

    render(payments, currentPayment) {
        if (!currentPayment) return;

        const isPaid = this.isPaymentPaid(currentPayment);
        const hasSplitBill = currentPayment.split_bill && currentPayment.split_bill.length > 0;

        let html = `
            <div class="payment-header">
                <h3>Informasi Pembayaran</h3>
                <p class="text-muted">Kelola pembayaran dan buat kontrabon dengan mudah</p>
            </div>
            
            <!-- Payment Selection -->
            ${this.renderPaymentSelection(payments, currentPayment)}
        `;

        if (!isPaid) {
            html += this.renderUnpaidView(currentPayment, hasSplitBill);
        } else {
            html += this.renderPaidView(currentPayment, hasSplitBill);
        }

        this.container.innerHTML = html;
        this.attachEventListeners(currentPayment);
    }

    renderPaymentSelection(payments, currentPayment) {
        if (payments.length <= 1) return '';

        return `
            <div class="payment-selection mb-4">
                <label class="form-label"><strong>Pilih Payment:</strong></label>
                <select class="form-control" id="paymentSelect">
                    ${payments.map((payment, index) => `
                        <option value="${index}" ${payment === currentPayment ? 'selected' : ''}>
                            ${payment.id_erp__pos__payment} - Rp ${this.formatCurrency(payment.total_bayar)}
                        </option>
                    `).join('')}
                </select>
                <button class="btn btn-primary btn-sm mt-2" id="addNewPayment">
                    <i class="fas fa-plus"></i> Tambah Payment Baru
                </button>
            </div>
        `;
    }

    isPaymentPaid(paymentData) {
        if (paymentData.status_payment === "Lunas") return true;
        if (paymentData.split_bill && paymentData.split_bill.length > 0) {
            return paymentData.split_bill.some(bill => bill.status_bayar === "sudah");
        }
        return false;
    }

    renderUnpaidView(paymentData, hasSplitBill) {
        const splitBillInfo = hasSplitBill ? this.renderSplitBillInfo(paymentData.split_bill, false) : '';

        return `
            <div class="unpaid-view">
                <div class="payment-info-card">
                    <div class="info-item">
                        <span class="info-label">Status Pembayaran:</span>
                        <span class="info-value">
                            <span class="status-badge status-unpaid">Belum Dibayar</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Tagihan:</span>
                        <span class="info-value">Rp ${this.formatCurrency(paymentData.total_bayar)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Payment:</span>
                        <span class="info-value">${this.formatDate(paymentData.tanggal_payment)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">ID Payment:</span>
                        <span class="info-value">${paymentData.id_erp__pos__payment}</span>
                    </div>
                </div>

                ${!hasSplitBill ? this.renderSplitBillForm() : ''}

                ${splitBillInfo}

                <div class="payment-actions mt-4">
                    <button class="btn btn-success" id="markAsPaid" ${!hasSplitBill ? 'disabled' : ''}>
                        <i class="fas fa-check"></i> Tandai Sudah Dibayar
                    </button>
                    <button class="btn btn-warning" id="createContrabon">
                        <i class="fas fa-file-invoice"></i> Buat Kontrabon
                    </button>
                    <button class="btn btn-info" id="updateTotal">
                        <i class="fas fa-sync"></i> Update Total dari Items
                    </button>
                </div>
            </div>
        `;
    }

    renderSplitBillForm() {
        return `
            <div class="payment-form mt-4">
                <h4 class="mb-4">Tambah Split Pembayaran</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="coaSelect">Pilih COA (Chart of Accounts)</label>
                            <select class="form-control" id="coaSelect">
                                <option value="">-- Pilih COA --</option>
                                <option value="101">101 - Kas</option>
                                <option value="102">102 - Bank BCA</option>
                                <option value="103">103 - Bank Mandiri</option>
                                <option value="201">201 - Piutang Usaha</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="paymentMethod">Metode Pembayaran</label>
                            <select class="form-control" id="paymentMethod">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cash">Tunai</option>
                                <option value="credit-card">Kartu Kredit</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="paymentDate">Tanggal Pembayaran</label>
                    <input type="date" class="form-control" id="paymentDate" value="${new Date().toISOString().split('T')[0]}">
                </div>
                
                <div id="bankSelection" style="display: none;">
                    <div class="form-group">
                        <label class="form-label" for="bankSelect">Pilih Bank Tujuan</label>
                        <select class="form-control" id="bankSelect">
                            <option value="">-- Pilih Bank --</option>
                            <option value="5" data-brand="Bank Mandiri" data-rek="1300014688181" data-an="Afifah Rahmani">Bank Mandiri - 1300014688181 (Afifah Rahmani)</option>
                            <option value="6" data-brand="BCA" data-rek="1234567890" data-an="Moesneeds">BCA - 1234567890 (Moesneeds)</option>
                        </select>
                    </div>
                </div>
                
                <button class="btn btn-success" id="saveSplitBill">
                    <i class="fas fa-check"></i> Simpan Split Bill
                </button>
            </div>
        `;
    }

    renderPaidView(paymentData, hasSplitBill) {
        const splitBillInfo = hasSplitBill ? this.renderSplitBillInfo(paymentData.split_bill, true) : '';
        const transferConfirmation = this.renderTransferConfirmation(paymentData);

        return `
            <div class="paid-view">
                <div class="payment-confirmation-card">
                    <div class="confirmation-header">
                        <h4 class="mb-0"><i class="fas fa-check-circle text-success"></i> Pembayaran Berhasil</h4>
                        <span class="confirmation-badge">LUNAS</span>
                    </div>
                    <p class="text-muted">Pembayaran telah berhasil diproses dan diverifikasi.</p>
                    
                    <div class="confirmation-details">
                        <div class="detail-card">
                            <h6><i class="fas fa-info-circle"></i> Informasi Pembayaran</h6>
                            <div class="mb-2"><strong>ID Payment:</strong> ${paymentData.id_erp__pos__payment}</div>
                            <div class="mb-2"><strong>Total Dibayar:</strong> Rp ${this.formatCurrency(paymentData.total_bayar)}</div>
                            <div class="mb-2"><strong>Tanggal Bayar:</strong> ${this.formatDate(paymentData.tanggal_payment)}</div>
                            <div class="mb-2"><strong>Status:</strong> <span class="text-success">Terverifikasi</span></div>
                        </div>
                        
                        <div class="detail-card">
                            <h6><i class="fas fa-credit-card"></i> Metode Pembayaran</h6>
                            ${this.renderPaymentMethodInfo(paymentData)}
                        </div>
                    </div>
                </div>

                ${transferConfirmation}
                ${splitBillInfo}

                <div class="payment-actions mt-4">
                    <button class="btn btn-warning" id="createContrabonPaid">
                        <i class="fas fa-file-invoice"></i> Buat Kontrabon
                    </button>
                </div>

                <div id="contrabonPreview" style="display: none;">
                    <h4>Pratinjau Kontrabon</h4>
                    <div id="contrabonContent"></div>
                    <div class="mt-3">
                        <button class="btn btn-primary" id="downloadContrabon">
                            <i class="fas fa-download"></i> Download PDF
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // ... (sisanya tetap sama seperti sebelumnya, dengan penyesuaian minor)

    attachEventListeners(paymentData) {
        // Payment selection
        const paymentSelect = document.getElementById('paymentSelect');
        if (paymentSelect) {
            paymentSelect.addEventListener('change', (e) => {
                paymentSystem.switchPayment(parseInt(e.target.value));
            });
        }

        // Add new payment
        const addNewPaymentBtn = document.getElementById('addNewPayment');
        if (addNewPaymentBtn) {
            addNewPaymentBtn.addEventListener('click', () => {
                paymentSystem.addNewPayment();
            });
        }

        // Update total button
        const updateTotalBtn = document.getElementById('updateTotal');
        if (updateTotalBtn) {
            updateTotalBtn.addEventListener('click', () => {
                paymentSystem.updatePaymentTotal();
            });
        }

        // Save split bill
        const saveSplitBillBtn = document.getElementById('saveSplitBill');
        if (saveSplitBillBtn) {
            saveSplitBillBtn.addEventListener('click', () => this.handleSaveSplitBill(paymentData));
        }

        // Payment method change
        const paymentMethodSelect = document.getElementById('paymentMethod');
        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', (e) => this.handlePaymentMethodChange(e));
        }

        // Mark as Paid button
        const markAsPaidBtn = document.getElementById('markAsPaid');
        if (markAsPaidBtn) {
            markAsPaidBtn.addEventListener('click', () => this.handleMarkAsPaid(paymentData));
        }

        // Create Contrabon buttons
        const createContrabonBtns = document.querySelectorAll('#createContrabon, #createContrabonPaid');
        createContrabonBtns.forEach(btn => {
            if (btn) {
                btn.addEventListener('click', () => this.handleCreateContrabon(paymentData));
            }
        });

        // Download Contrabon button
        const downloadContrabonBtn = document.getElementById('downloadContrabon');
        if (downloadContrabonBtn) {
            downloadContrabonBtn.addEventListener('click', () => this.handleDownloadContrabon(paymentData));
        }
    }

    async handleSaveSplitBill(paymentData) {
        const paymentMethod = document.getElementById('paymentMethod')?.value;
        const coa = document.getElementById('coaSelect')?.value;
        const paymentDate = document.getElementById('paymentDate')?.value;
        const bankSelect = document.getElementById('bankSelect');

        if (!paymentMethod || !coa || !paymentDate) {
            this.showAlert('Harap lengkapi semua field!', 'error');
            return;
        }

        let splitBillData = {
            id_metode_bayar: paymentMethod === 'transfer' ? 4 : 1,
            id_payment_brand: paymentMethod === 'transfer' ? bankSelect?.value : null,
            brand_nama: paymentMethod === 'transfer' ? bankSelect?.selectedOptions[0]?.dataset.brand : 'Tunai',
            no_rek: paymentMethod === 'transfer' ? bankSelect?.selectedOptions[0]?.dataset.rek : '',
            an: paymentMethod === 'transfer' ? bankSelect?.selectedOptions[0]?.dataset.an : '',
            nama_payment: this.getPaymentMethodName(paymentMethod),
            kode_payment: paymentMethod
        };

        this.setButtonLoading('saveSplitBill', true);
        try {
            await paymentSystem.saveSplitBill(splitBillData);
            this.showAlert('Split bill berhasil disimpan!', 'success');
            this.render(paymentSystem.payments, paymentSystem.currentPayment);
            
            if (paymentMethod === 'transfer') {
                this.showBankTransferModal(paymentData);
            }
        } catch (error) {
            this.showAlert('Gagal menyimpan split bill: ' + error.message, 'error');
        } finally {
            this.setButtonLoading('saveSplitBill', false);
        }
    }

    getPaymentMethodName(method) {
        const methods = {
            'transfer': 'Manual Bank Transfer',
            'cash': 'Tunai',
            'credit-card': 'Kartu Kredit'
        };
        return methods[method] || method;
    }

    handlePaymentMethodChange(e) {
        const bankSelection = document.getElementById('bankSelection');
        if (bankSelection) {
            bankSelection.style.display = e.target.value === 'transfer' ? 'block' : 'none';
        }
    }

    async handleMarkAsPaid(paymentData) {
        this.setButtonLoading('markAsPaid', true);
        try {
            await paymentSystem.markAsPaid(paymentData);
            this.showAlert('Pembayaran berhasil ditandai sebagai sudah dibayar!', 'success');
            this.render(paymentSystem.payments, paymentSystem.currentPayment);
        } catch (error) {
            this.showAlert('Gagal menandai pembayaran: ' + error.message, 'error');
        } finally {
            this.setButtonLoading('markAsPaid', false);
        }
    }

    // ... (method lainnya tetap sama)

    
    // ... (method utility lainnya tetap sama)
}

// Inisialisasi paymentSystem di global scope untuk akses dari event listeners
let paymentSystem;