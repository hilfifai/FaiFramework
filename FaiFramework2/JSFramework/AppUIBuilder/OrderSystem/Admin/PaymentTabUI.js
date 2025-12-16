import OrderSystemBuilder from '../../../Builder/OrderSystemBuilder.js';

export default class PaymentTabUI extends OrderSystemBuilder {
    constructor() {
        super();
        this.payments = [];
        this.currentPayments = []; // Changed from single object to array

        this.container = document.querySelector('.payment-container');
        this.alertContainer = document.getElementById('alert-container') || document.body;
    }
    
    async init(currentPoID, po) {
        this.currentPoID = currentPoID;

        this.po = po;
        this.orderSystemJson = await this.loadData(["payment_brand"]);
        this.payment_brand = this.orderSystemJson.payment_brand.data || [];
        console.log(this.payment_brand);
        await this.loadPaymentData(currentPoID);
        await this.loadPurchaseOrderData(po); // Load purchase order data

        await this.render(this.currentPayments, this.po);
        await this.populateHideshow(po)
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
                body: JSON.stringify({ currentPoId: this.currentPoID }),
            };
            const response = await fetch('/api/payments', options);
            let res = await response.json();
            // Handle both single payment and array of payments
            this.currentPayments = res.data.map(payment => {
                let split_bill = [];
                try {
                    if (payment.split_bill) {
                        split_bill = typeof payment.split_bill === 'string'
                            ? JSON.parse(payment.split_bill)
                            : payment.split_bill;
                    }
                } catch (error) {
                    console.error('Error parsing split_bill for payment:', payment.id, error);
                }

                split_bill = split_bill.map(split => {
                    let konfirm = [];
                    try {
                        if (split.konfirm) {
                            konfirm = typeof split.konfirm === 'string'
                                ? JSON.parse(split.konfirm)
                                : split.konfirm;
                        }
                    } catch (error) {
                        console.error('Error parsing konfirm for split:', split.id, error);
                    }

                    return { ...split, konfirm };
                });

                return { ...payment, split_bill };
            });

            this.isPaymentData = 1;
            // If no payments exist, create initial payment structure
            if (this.currentPayments.length === 0) {
                this.isPaymentData = 0;
                this.currentPayments = [this.createInitialPayment(currentPoID)];
            }

        } catch (error) {
            this.isPaymentData = 0;
            console.error('Error loading payment data:', error);
            this.currentPayments = [this.createInitialPayment(currentPoID)];
        }
    }

    async loadPurchaseOrderData(po) {

        this.po = po;

    }
    populateHideshow(po) {


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
    getStatusText(status) {
        const texts = {
            'draft': 'Draft',
            'ordered': 'Dipesan',
            'shipped': 'Dikirim',
            'received': 'Diterima',
            'partial': 'Parsial',
            'cancelled': 'Dibatalkan',
            "proses": "Diproses",
            "diproses": "Diproses",
            "selesai": "Selesai"

        };
        return texts[status] || 'Draft';
    }
    createInitialPayment(currentPoID) {
        const totalFromItems = this.calculateTotalFromItems();

        return {
            id: Date.now().toString(),
            id_erp__pos__group: currentPoID,
            nomor_payment: `PAY-${Date.now()}`,
            tanggal_payment: new Date().toISOString().split('T')[0],
            total_bayar: totalFromItems,
            status_payment: "Aktif",
            split_bill: [],
            create_by: "system",
            create_date: new Date().toISOString(),
            on_domain: "v2.moesneeds.id",
            on_panel: 1,
            on_board: 42,
            on_web_apps: "3"
        };
    }

    calculateTotalFromItems() {

        console.log(this.po);
        if (!this.po.items || this.po.items.length === 0) {
            return 0;
        }

        return this.po.items.reduce((total, item) => {
            console.log(item);
            const itemTotal = parseFloat(item.grand_total) || 0;
            return total + itemTotal;
        }, 0);
        console.timeEnd("Duration");
        console.groupEnd();
    }



    async sendPaymentToBackend(endpoint, paymentId, paymentData) {
        try {
            const response = await fetch('/api/payments', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    "endpoint": endpoint,
                    "curentpoid": this.currentPoID,
                    "paymentId": paymentId,
                },
                body: JSON.stringify(paymentData)
            });

            if (!response.ok) {
                throw new Error('Gagal menyimpan data');
            }

            let res = await response.json();
            return res;
        } catch (error) {
            console.error('Error menyimpan data:', error);
            this.showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
    async sendPaymentToBackendInit(endpoint, paymentId, paymentData) {
        try {

            const response = await fetch('/api/payments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "endpoint": endpoint,
                    "curentpoid": this.currentPoId,
                    "paymentId": paymentId,
                },
                body: JSON.stringify(paymentData)
            });

            if (!response.ok) {
                throw new Error('Gagal menyimpan data');
            }

            let res = await response.json();
            this.currentPayments = this.currentPayments.forEach(p =>
                p.id === paymentData.id ? res.data : p
            );
            return res.data;
        } catch (error) {
            console.error('Error menyimpan data:', error);
            this.showAlert('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
    async markAsPaid(paymentId, paymentData) {
        return new Promise((resolve, reject) => {
            setTimeout(async () => {
                if (Math.random() > 0.1) {
                    const paymentIndex = this.currentPayments.findIndex(p => p.id === paymentId);
                    if (paymentIndex !== -1) {

                        this.currentPayments[paymentIndex].status_payment = "Lunas";
                        if (this.currentPayments[paymentIndex].split_bill && this.currentPayments[paymentIndex].split_bill.length > 0) {
                            this.currentPayments[paymentIndex].split_bill[0].status_bayar = "sudah";
                            this.currentPayments[paymentIndex].split_bill[0].tanggal_bayar = new Date().toISOString().split('T')[0];
                        }
                    }
                    await this.sendPaymentToBackend("confirm_lunas", paymentId, { paymentId: paymentId });
                    resolve({ success: true, message: 'Pembayaran berhasil dicatat' });
                } else {
                    reject(new Error('Gagal terhubung ke server'));
                }
            }, 1500);
        });
    }

    submitBankTransferConfirmation(paymentId, confirmationData) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                const paymentIndex = this.currentPayments.findIndex(p => p.id === paymentId);
                if (paymentIndex !== -1 && this.currentPayments[paymentIndex].split_bill &&
                    this.currentPayments[paymentIndex].split_bill.length > 0) {

                    if (!this.currentPayments[paymentIndex].split_bill[0].konfirm) {
                        this.currentPayments[paymentIndex].split_bill[0].konfirm = [];
                    }
                    this.currentPayments[paymentIndex].split_bill[0].konfirm.push(confirmationData);

                    resolve({
                        success: true,
                        message: 'Konfirmasi transfer berhasil diproses',
                        data: {
                            confirmation_id: 'CFM-' + Date.now(),
                            processed_at: new Date().toISOString()
                        }
                    });
                } else {
                    reject(new Error('Payment atau split bill tidak ditemukan'));
                }
            }, 2000);
        });
    }

    addNewPayment() {
        const newPayment = this.createInitialPayment();
        this.currentPayments.push(newPayment);
        return newPayment;
    }

    removePayment(paymentId) {
        this.currentPayments = this.currentPayments.filter(p => p.id !== paymentId);
    }

    updatePaymentTotal(paymentId, newTotal) {
        const paymentIndex = this.currentPayments.findIndex(p => p.id === paymentId);
        if (paymentIndex !== -1) {
            this.currentPayments[paymentIndex].total_bayar = newTotal;
            return true;
        }
        return false;
    }

    // Analysis methods
    getPaymentStatistics() {

        const totalFromItems = this.calculateTotalFromItems();
        let totalTerkonfirmasi = 0;
        let totalTerbayar = 0;
        let totalBelumTerkonfirmasi = 0;
        let totalKurangBayar = 0;
        let totalLebihBayar = 0;

        this.currentPayments.forEach(payment => {
            const paymentTotal = parseFloat(payment.total_bayar) || 0;

            if (payment.status_payment === "Lunas") {
                totalTerkonfirmasi += paymentTotal;
            }
            console.log("payment", payment)
            if (payment.split_bill && payment.split_bill.length > 0) {
                payment.split_bill.forEach(bill => {
                    const billAmount = parseFloat(bill.jumlah_bayar) || 0;

                    if (bill.status_bayar === "sudah") {
                        totalTerbayar += billAmount;

                        // Check for konfirmasi
                        if (bill.konfirm && bill.konfirm.length > 0) {
                            const totalKonfirmasi = bill.konfirm.reduce((sum, konfirm) =>
                                sum + (parseFloat(konfirm.nominal_bayar) || 0), 0);

                            if (totalKonfirmasi < billAmount) {
                                totalKurangBayar += (billAmount - totalKonfirmasi);
                            } else if (totalKonfirmasi > billAmount) {
                                totalLebihBayar += (totalKonfirmasi - billAmount);
                            }
                        } else {
                            totalBelumTerkonfirmasi += billAmount;
                        }
                    }
                });
            }
        });

        // Calculate remaining amounts
        const totalSeharusnyaDibayar = totalFromItems;
        const totalSudahDibayar = totalTerbayar;
        const sisaBelumDibayar = Math.max(0, totalSeharusnyaDibayar - totalSudahDibayar);

        return {
            totalTerkonfirmasi,
            totalTerbayar,
            totalBelumTerkonfirmasi,
            totalKurangBayar,
            totalLebihBayar,
            totalSeharusnyaDibayar: totalFromItems,
            totalSudahDibayar,
            sisaBelumDibayar
        };
    }



    render(payments, purchaseOrder) {
        if (!payments || payments.length === 0) {
            this.container.innerHTML = '<div class="alert alert-info">Tidak ada data pembayaran</div>';
            return;
        }

        const statistics = this.getPaymentStatistics();

        let html = `
            <div class="payment-header">
                <h3>Informasi Pembayaran</h3>
                <p class="text-muted">Kelola pembayaran dan buat kontrabon dengan mudah</p>
            </div>
            
            ${this.renderStatistics(statistics)}
        `;

        // Render each payment
        payments.forEach((payment, index) => {
            html += this.renderPayment(payment, index, purchaseOrder);
        });

        // Add new payment button
        html += `
            <div class="payment-actions mt-4">
                <button class="btn btn-primary justProses" id="addNewPayment">
                    <i class="fas fa-plus"></i> Tambah Pembayaran Baru
                </button>
            </div>
        `;

        this.container.innerHTML = html;
        this.attachEventListeners(payments, purchaseOrder);
    }

    renderStatistics(stats) {
        return `
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-success">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.totalTerkonfirmasi)}</div>
                            <div class="stat-label">Terkonfirmasi</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-primary">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.totalTerbayar)}</div>
                            <div class="stat-label">Terbayar</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-warning">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.totalBelumTerkonfirmasi)}</div>
                            <div class="stat-label">Belum Terkonfirmasi</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-danger">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.totalKurangBayar)}</div>
                            <div class="stat-label">Kurang Bayar</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-info">
                        <div class="stat-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.totalLebihBayar)}</div>
                            <div class="stat-label">Lebih Bayar</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-secondary">
                        <div class="stat-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Rp ${this.formatCurrency(stats.sisaBelumDibayar)}</div>
                            <div class="stat-label">Sisa Belum Bayar</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <style>
                .stat-card {
                    background: white;
                    border-radius: 8px;
                    padding: 15px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    display: flex;
                    align-items: center;
                    border-left: 4px solid #007bff;
                }
                .stat-card.stat-success { border-left-color: #28a745; }
                .stat-card.stat-primary { border-left-color: #007bff; }
                .stat-card.stat-warning { border-left-color: #ffc107; }
                .stat-card.stat-danger { border-left-color: #dc3545; }
                .stat-card.stat-info { border-left-color: #17a2b8; }
                .stat-card.stat-secondary { border-left-color: #6c757d; }
                
                .stat-icon {
                    font-size: 24px;
                    margin-right: 15px;
                    opacity: 0.8;
                }
                .stat-success .stat-icon { color: #28a745; }
                .stat-primary .stat-icon { color: #007bff; }
                .stat-warning .stat-icon { color: #ffc107; }
                .stat-danger .stat-icon { color: #dc3545; }
                .stat-info .stat-icon { color: #17a2b8; }
                .stat-secondary .stat-icon { color: #6c757d; }
                
                .stat-value {
                    font-size: 16px;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .stat-label {
                    font-size: 12px;
                    color: #6c757d;
                    text-transform: uppercase;
                }
            </style>
        `;
    }
    renderSplitBillInfo(splitBills, isPaid) {
        if (!splitBills || splitBills.length === 0) return '';

        let html = `
                    <div class="">
                       
                `;

        splitBills.forEach(bill => {
            const statusClass = bill.status_bayar === 'belum' ? 'status-unpaid' : 'status-paid';
            const statusText = bill.status_bayar === 'belum' ? 'Belum Bayar' : 'Sudah Bayar';

            html += `
                        <div class="split-bill-item">
                             <h5><i class="fas fa-receipt"></i> Split Bill :</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2"><strong>Brand:</strong> ${bill.brand_nama}</div>
                                    <div class="mb-2"><strong>No. Rek:</strong> ${bill.no_rek}</div>
                                    <div class="mb-2"><strong>Atas Nama:</strong> ${bill.an}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2"><strong>Jumlah:</strong> Rp ${this.formatCurrency(bill.jumlah_bayar)}</div>
                                    <div class="mb-2"><strong>Status:</strong> <span class="status-badge ${statusClass}">${statusText}</span></div>
                                    ${bill.tanggal_bayar ? `<div class="mb-2"><strong>Tanggal Bayar:</strong> ${this.formatDate(bill.tanggal_bayar)}</div>` : ''}
                                </div>
                            </div>
                            ${bill.konfirm && bill.konfirm.length > 0 ? this.renderKonfirmasiInfo(bill.konfirm) : ''}
                        </div>
                    `;
        });

        html += `</div>`;
        return html;
    }
    renderKonfirmasiInfo(konfirmasi) {
        return konfirmasi.map(konfirm => `
                    <h4>Konfirmasi Pembayaran</h4>
                    <div class="konfirmasi-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-1"><strong>Pengirim:</strong> ${konfirm.nama_rekening_pengirim}</div>
                                <div class="mb-1"><strong>Rekening:</strong> ${konfirm.nomor_rekening_pengirim}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1"><strong>Tanggal:</strong> ${this.formatDate(konfirm.tanggal_pembayaran)}</div>
                                <div class="mb-1"><strong>Nominal:</strong> Rp ${this.formatCurrency(konfirm.nominal_bayar)}</div>
                            </div>
                        </div>
                        ${konfirm.catatan ? `<div class="mt-1"><strong>Catatan:</strong> ${konfirm.catatan}</div>` : ''}
                    </div>
                `).join('');
    }

    renderPaymentMethodInfo(paymentData) {
        if (!paymentData.split_bill || paymentData.split_bill.length === 0) {
            return '<div class="mb-2"><strong>Metode:</strong> Tidak tersedia</div>';
        }

        const bill = paymentData.split_bill[0];
        return `
                    <div class="mb-2"><strong>Metode:</strong> ${bill.nama_payment}</div>
                    <div class="mb-2"><strong>Brand:</strong> ${bill.brand_nama}</div>
                    <div class="mb-2"><strong>Kode:</strong> ${bill.kode_payment}</div>
                `;
    }

    renderTransferConfirmation(paymentData) {
        if (!paymentData.split_bill || paymentData.split_bill.length === 0 ||
            !paymentData.split_bill[0].konfirm || paymentData.split_bill[0].konfirm.length === 0) {
            return '';
        }

        const konfirm = paymentData.split_bill[0].konfirm[0];
        return `
                    <div class="payment-split-info">
                        <h5><i class="fas fa-exchange-alt"></i> Pembayaran </h5>
                        <div class="detail-card mt-3">
                            <h6><i class="fas fa-user"></i> Data Pengirim</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2"><strong>Atas Nama:</strong> ${konfirm.nama_rekening_pengirim}</div>
                                    <div class="mb-2"><strong>No. Rekening:</strong> ${konfirm.nomor_rekening_pengirim}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2"><strong>Tanggal Transfer:</strong> ${this.formatDate(konfirm.tanggal_pembayaran)}</div>
                                    <div class="mb-2"><strong>Nominal Transfer:</strong> Rp ${this.formatCurrency(konfirm.nominal_bayar)}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
    }
    renderPayment(payment, index, purchaseOrder) {
        const isPaid = this.isPaymentPaid(payment);
        const hasSplitBill = payment.split_bill && payment.split_bill.length > 0;

        return `
            <div class="payment-card mb-4">
                <div class="payment-card-header">
                    <h4>Pembayaran ${index + 1} - ${payment.nomor_payment}</h4>
                    <div class="payment-actions">
                        <button class="btn btn-sm btn-outline-danger delete-payment" data-payment-id="${payment.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                ${!isPaid ?
                this.renderUnpaidView(payment, hasSplitBill, purchaseOrder) :
                this.renderPaidView(payment, hasSplitBill)
            }
            </div>
        `;
    }

    renderUnpaidView(payment, hasSplitBill, purchaseOrder) {
        const splitBillInfo = hasSplitBill ? this.renderSplitBillInfo(payment.split_bill, false) : '';
        const totalFromItems = this.calculateTotalFromItems();
        console.log("PAYMENT", payment);
        return `
            <div class="unpaid-view">
                <div class="payment-info-grid">
                    <div class="info-item">
                        <span class="info-label">Status Pembayaran:</span>
                        <span class="info-value">
                            <span class="status-badge status-unpaid">Belum Dibayar</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Tagihan:</span>
                        <span class="info-value">Rp ${this.formatCurrency(payment.total_bayar)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total dari Items:</span>
                        <span class="info-value">Rp ${this.formatCurrency(totalFromItems)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Selisih:</span>
                        <span class="info-value ${totalFromItems > payment.total_bayar ? 'text-danger' : 'text-success'}">
                            Rp ${this.formatCurrency(totalFromItems - payment.total_bayar)}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Payment:</span>
                        <span class="info-value">${this.formatDate(payment.tanggal_payment)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">ID Payment:</span>
                        <span class="info-value">${payment.nomor_payment}</span>
                    </div>
                </div>

                ${splitBillInfo}

                <div class="payment-form">
                    <h5 class="mb-3">Tambah Split Pembayaran</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="nominal-${payment.id}">Nominal</label>
                                <input type="number" class="form-control" id="nominal-${payment.id}" 
                                       value="0">
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="paymentMethod-${payment.id}">Metode Pembayaran</label>
                                <select class="form-control" id="paymentMethod-${payment.id}">
                                    <option value="">-- Pilih Metode --</option>
                                    ${this.payment_brand.map((payment, index) => {
            return `<option value="${payment.primary_key}-${payment.id_webmaster__payment_method}">
                                            ${payment.nama_payment} - ${payment.nama_brand}
                                            </option>`;
        }).join('')
            }
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Tunai</option>
                                    <option value="credit-card">Kartu Kredit</option>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="coaSelect-${payment.id}">Pilih COA</label>
                                <select class="form-control" id="coaSelect-${payment.id}">
                                    <option value="">-- Pilih COA --</option>
                                    <option value="101">101 - Kas</option>
                                    <option value="102">102 - Bank BCA</option>
                                    <option value="103">103 - Bank Mandiri</option>
                                    <option value="201">201 - Piutang Usaha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="paymentDate-${payment.id}">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" id="paymentDate-${payment.id}" 
                                       value="${new Date().toISOString().split('T')[0]}">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2 justProses" id="SimpanSplitBlit-${payment.id}">
                        <i class="fas fa-check"></i> Simpan Split Bill
                    </button>
                </div>
                
                <div class="payment-actions mt-3">
                    <button class="btn btn-success justProses" id="markAsPaid-${payment.id}">
                        <i class="fas fa-check"></i> Tandai Sudah Dibayar
                    </button>
                    <button class="btn btn-warning" id="createContrabon-${payment.id}">
                        <i class="fas fa-file-invoice"></i> Buat Kontrabon
                    </button>
                </div>
            </div>
        `;
    }


    attachEventListeners(payments, purchaseOrder) {
        // Add new payment button
        const addNewPaymentBtn = document.getElementById('addNewPayment');
        if (addNewPaymentBtn) {
            addNewPaymentBtn.addEventListener('click', () => this.handleAddNewPayment());
        }

        // Delete payment buttons
        const deletePaymentBtns = document.querySelectorAll('.delete-payment');
        deletePaymentBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const paymentId = e.target.closest('.delete-payment').dataset.paymentId;
                this.handleDeletePayment(paymentId);
            });
        });

        // Attach listeners for each payment
        payments.forEach(payment => {
            this.attachPaymentEventListeners(payment, purchaseOrder);
        });
    }

    attachPaymentEventListeners(payment, purchaseOrder) {
        const paymentId = payment.id;

        // Mark as Paid button
        const markAsPaidBtn = document.getElementById(`markAsPaid-${paymentId}`);
        if (markAsPaidBtn) {
            markAsPaidBtn.addEventListener('click', () => this.handleMarkAsPaid(payment));
        }

        // Save Split Bill button
        console.log(`SimpanSplitBlit-${paymentId}`);
        const saveSplitBillBtn = document.getElementById(`SimpanSplitBlit-${paymentId}`);
        if (saveSplitBillBtn) {
            saveSplitBillBtn.addEventListener('click', () => this.handleSimpanSplitBlit(payment));
        }

        // Create Contrabon buttons
        const createContrabonBtn = document.getElementById(`createContrabon-${paymentId}`);
        if (createContrabonBtn) {
            createContrabonBtn.addEventListener('click', () => this.handleCreateContrabon(payment));
        }
    }

    async handleAddNewPayment() {
        const newPayment = this.addNewPayment();
        this.render(this.currentPayments, this.purchaseOrder);
        this.showAlert('Pembayaran baru berhasil ditambahkan', 'success');
    }

    async handleDeletePayment(paymentId) {
        if (swalConfirm('Apakah Anda yakin ingin menghapus pembayaran ini?')) {
            this.removePayment(paymentId);
            // this.render(this.currentPayments, this.purchaseOrder);
            this.showAlert('Pembayaran berhasil dihapus', 'success');
        }
    }

    async handleMarkAsPaid(payment) {
        this.setButtonLoading(`markAsPaid-${payment.id}`, true);
        try {
            await this.markAsPaid(payment.id, {
                paymentMethod: document.getElementById(`paymentMethod-${payment.id}`)?.value,
                coa: document.getElementById(`coaSelect-${payment.id}`)?.value,
                paymentDate: document.getElementById(`paymentDate-${payment.id}`)?.value
            });
            this.showAlert('Pembayaran berhasil ditandai sebagai sudah dibayar!', 'success');
            // this.render(this.currentPayments, this.purchaseOrder);
            this.init(this.currentPoID, this.po)
            this.setButtonLoading(`markAsPaid-${payment.id}`, false);
        } catch (error) {
            this.showAlert('Gagal menandai pembayaran: ' + error.message, 'error');
        } finally {
            this.setButtonLoading(`markAsPaid-${payment.id}`, false);
        }
    }

    async handleSimpanSplitBlit(paymentData) {
        const id = paymentData.id;
        const paymentMethod = document.getElementById('paymentMethod-' + id)?.value;
        const coa = document.getElementById('coaSelect-' + id)?.value;
        const paymentDate = document.getElementById('paymentDate-' + id)?.value;

        console.log("MASUK HANDLER", paymentMethod);
        console.log("MASUK HANDLER", coa);
        console.log("MASUK HANDLER", paymentDate);
        if (!paymentMethod || !coa || !paymentDate) {
            this.showAlert('Harap lengkapi semua field!', 'error');
            return;
        }
        let split = paymentMethod.split('-')
        console.log(split[1]);
        if (parseInt(split[1]) === 4) {
            this.showBankTransferModal(paymentData);
        } else {
            // this.setButtonLoading('markAsPaid', true);
            try {
                await this.handleBayarSubmit(paymentData);



                this.showAlert('Pembayaran berhasil ditandai sebagai sudah dibayar!', 'success');
                this.init(this.currentPoID, this.po)
            } catch (error) {
                this.showAlert('Gagal menandai pembayaran: ' + error.message, 'error');
            } finally {
                // this.setButtonLoading('markAsPaid', false);
            }
        }
    }
    showBankTransferModal(paymentData) {
        // alert();
        const modalBody = document.getElementById('bankTransferModalBody');
        if (!modalBody) return;
        // alert();
        modalBody.innerHTML = `
                    <div class="bank-transfer-info">
                        <h6><i class="fas fa-info-circle"></i> Informasi Rekening Tujuan</h6>
                        ${paymentData.split_bill && paymentData.split_bill.length > 0 ? `
                            <p class="mb-1"><strong>Bank:</strong> ${paymentData.split_bill[0].brand_nama}</p>
                            <p class="mb-1"><strong>No. Rekening:</strong> ${paymentData.split_bill[0].no_rek}</p>
                            <p class="mb-0"><strong>Atas Nama:</strong> ${paymentData.split_bill[0].an}</p>
                        ` : '<p>Informasi rekening tidak tersedia</p>'}
                    </div>
                    
                    <form id="bankTransferForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Atas Nama Pengirim *</label>
                                    <input type="text" class="form-control" id="senderName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No. Rekening Pengirim *</label>
                                    <input type="text" class="form-control" id="senderAccount" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Bank Pengirim *</label>
                            <select class="form-control" id="senderBank" required>
                                <option value="">-- Pilih Bank Pengirim --</option>
                                <option value="bca">BCA</option>
                                <option value="mandiri">Bank Mandiri</option>
                                <option value="bni">BNI</option>
                                <option value="bri">BRI</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tanggal Transfer *</label>
                            <input type="date" class="form-control" id="transferDate" value="${new Date().toISOString().split('T')[0]}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Nominal Transfer *</label>
                            <input type="number" class="form-control" id="transferAmount" value="${paymentData.total_bayar}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="transferNotes" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                    </form>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="submitBankTransfer">
                            <i class="fas fa-paper-plane"></i> Kirim Konfirmasi
                        </button>
                    </div>
                `;

        // Attach event listener untuk submit
        const submitBtn = modalBody.querySelector('#submitBankTransfer');
        if (submitBtn) {
            submitBtn.addEventListener('click', () => this.handleBankTransferSubmit(paymentData));
        }

        const modal = new bootstrap.Modal(document.getElementById('bankTransferModal'));
        modal.show();
        $('.modal-backdrop').remove();
    }


    setButtonLoading(buttonId, isLoading) {
        const button = document.getElementById(buttonId);
        if (!button) return;

        if (isLoading) {
            button.disabled = true;
            button.innerHTML = `<span class="loading"></span> Memproses...`;
        } else {
            button.disabled = false;
            if (buttonId === 'markAsPaid') {
                button.innerHTML = `<i class="fas fa-check"></i> Tandai Sudah Dibayar`;
            } else if (buttonId === 'downloadContrabon') {
                button.innerHTML = `<i class="fas fa-download"></i> Download PDF`;
            } else if (buttonId === 'submitBankTransfer') {
                button.innerHTML = `<i class="fas fa-paper-plane"></i> Kirim Konfirmasi`;
            }
        }
    }
    async handleBayarSubmit(paymentData) {
        const id = paymentData.id;
        const nominal = document.getElementById('nominal-' + id)?.value;
        const paymentMethod = document.getElementById('paymentMethod-' + id)?.value;
        const coa = document.getElementById('coaSelect-' + id)?.value;
        const paymentDate = document.getElementById('paymentDate-' + id)?.value;
        let newPaymentId = paymentData.id;
        if (this.isPaymentData == 0) {
            const initData = await this.sendPaymentToBackendInit("initial_payment", null, paymentData);
            newPaymentId = initData.id;
            this.isPaymentData = 1;
        }

        const bayar = await this.sendPaymentToBackend("add_bayar", newPaymentId, {
            nominal: nominal,
            paymentMethod: paymentMethod,
            coa: coa,
            paymentDate: paymentDate,
            id_erp__pos__payment: newPaymentId
        });
        return bayar;
    }
    async handleBankTransferSubmit(paymentData) {
        const form = document.getElementById('bankTransferForm');


        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        this.setButtonLoading('submitBankTransfer', true);

        const confirmationData = {
            nama_rekening_pengirim: document.getElementById('senderName').value,
            nomor_rekening_pengirim: document.getElementById('senderAccount').value,
            tanggal_pembayaran: document.getElementById('transferDate').value,
            nominal_bayar: document.getElementById('transferAmount').value,
            catatan: document.getElementById('transferNotes').value,
            create_date: new Date().toISOString(),
            create_by: paymentData.create_by
        };
        try {
            let bayar = await handleBayarSubmit(paymentData);
            await this.submitBankTransferConfirmation(confirmationData, newPaymentId, bayar);

            this.showAlert('Konfirmasi transfer bank berhasil dikirim! Pembayaran telah dicatat.', 'success');
            this.init(this.currentPoID, this.po)

            const modal = bootstrap.Modal.getInstance(document.getElementById('bankTransferModal'));
            modal.hide();
        } catch (error) {
            this.showAlert('Gagal mengirim konfirmasi transfer: ' + error.message, 'error');
        } finally {
            this.setButtonLoading('submitBankTransfer', false);
        }
    }
    async submitBankTransferConfirmation(confirmationData, newPaymentId, bayar) {
        return new Promise((resolve, reject) => {
            setTimeout(async () => {
                // Simulasi penyimpanan data konfirmasi
                // if (this.currentPayment.split_bill && this.currentPayment.split_bill.length > 0) {
                //     if (!this.currentPayment.split_bill[0].konfirm) {
                //         this.currentPayment.split_bill[0].konfirm = [];
                //     }
                //     this.currentPayment.split_bill[0].konfirm.push(confirmationData);
                // }
                await this.sendPaymentToBackend("add_konfirm", newPaymentId, {
                    ...confirmationData,
                    id_erp__pos__payment__bayar: bayar.id
                });
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
    handleCreateContrabon(paymentData) {
        const contrabonContent = document.getElementById('contrabonContent');
        const contrabonPreview = document.getElementById('contrabonPreview');

        if (contrabonContent && contrabonPreview) {
            contrabonContent.innerHTML = this.generateContrabonContent(paymentData);
            contrabonPreview.style.display = 'block';
            contrabonPreview.scrollIntoView({ behavior: 'smooth' });
            this.showAlert('Kontrabon berhasil dibuat! Silakan download PDF.', 'success');
        }
    }

    handleDownloadContrabon(paymentData) {
        this.setButtonLoading('downloadContrabon', true);
        this.generatePDF(paymentData);
        setTimeout(() => {
            this.setButtonLoading('downloadContrabon', false);
        }, 1000);
    }

    generateContrabonContent(paymentData) {
        const isPaid = this.isPaymentPaid(paymentData);
        const paidDate = isPaid ?
            (paymentData.split_bill && paymentData.split_bill[0].tanggal_bayar) ||
            paymentData.tanggal_payment :
            new Date().toISOString().split('T')[0];

        return `
                    <div class="contrabon-details">
                        <h5>Kontrabon - ${paymentData.nomor_payment}</h5>
                        <hr>
                        <div class="detail-item">
                            <strong>Nomor Payment:</strong> ${paymentData.nomor_payment}
                        </div>
                        <div class="detail-item">
                            <strong>Total Pembayaran:</strong> Rp ${this.formatCurrency(paymentData.total_bayar)}
                        </div>
                        <div class="detail-item">
                            <strong>Tanggal Payment:</strong> ${this.formatDate(paymentData.tanggal_payment)}
                        </div>
                        <div class="detail-item">
                            <strong>Tanggal Bayar:</strong> ${this.formatDate(paidDate)}
                        </div>
                        <div class="detail-item">
                            <strong>Status:</strong> ${isPaid ? 'Lunas' : 'Belum Bayar'}
                        </div>
                        <hr>
                        <div class="signature-area mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Disetujui oleh,</p>
                                    <br><br>
                                    <p>_________________________</p>
                                    <p>Manager Keuangan</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Dibuat oleh,</p>
                                    <br><br>
                                    <p>_________________________</p>
                                    <p>Staff Keuangan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
    }

    generatePDF(paymentData) {
        const doc = new jsPDF();

        doc.setFontSize(18);
        doc.text('KONTRA BON', 105, 20, { align: 'center' });

        doc.setFontSize(12);
        let yPosition = 40;

        doc.text(`Nomor Payment: ${paymentData.nomor_payment}`, 20, yPosition);
        yPosition += 10;
        doc.text(`Total Pembayaran: Rp ${this.formatCurrency(paymentData.total_bayar)}`, 20, yPosition);
        yPosition += 10;
        doc.text(`Tanggal Payment: ${this.formatDate(paymentData.tanggal_payment)}`, 20, yPosition);
        yPosition += 10;
        doc.text(`Status: ${this.isPaymentPaid(paymentData) ? 'Lunas' : 'Belum Bayar'}`, 20, yPosition);

        yPosition += 15;
        doc.line(20, yPosition, 190, yPosition);

        yPosition += 20;
        doc.text('Disetujui oleh,', 50, yPosition);
        doc.text('Dibuat oleh,', 140, yPosition);

        yPosition += 40;
        doc.line(40, yPosition, 90, yPosition);
        doc.line(130, yPosition, 180, yPosition);

        yPosition += 10;
        doc.text('Manager Keuangan', 65, yPosition, { align: 'center' });
        doc.text('Staff Keuangan', 155, yPosition, { align: 'center' });

        doc.save(`Kontrabon-${paymentData.nomor_payment}.pdf`);
    }


    // Update other methods to handle payment IDs
    isPaymentPaid(payment) {
        if (payment.status_payment === "Lunas") return true;
        if (payment.split_bill && payment.split_bill.length > 0) {
            return payment.split_bill[0].status_bayar === "sudah";
        }
        return false;
    }

    formatCurrency(amount) {
        return parseFloat(amount || 0).toLocaleString('id-ID');
    }

    formatDate(dateString) {
        if (!dateString) return '-';
        const options = { day: '2-digit', month: 'long', year: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', options);
    }

    showAlert(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        this.alertContainer.appendChild(alertDiv);

        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
    renderPaidView(paymentData, hasSplitBill) {
        const splitBillInfo = hasSplitBill ? this.renderSplitBillInfo(paymentData.split_bill, true) : '';
        const transferConfirmation = this.renderTransferConfirmation(paymentData);

        return ` 
                    <div class="paid-view d-block">
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

}

// Initialize payment system globally
