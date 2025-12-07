import FaiModule from '../FaiModule.js';
export default class OrderSystemBuilder extends FaiModule {
	constructor() {
		super();


		this.currentView = 'home';
		this.config = {
			orderSystemJson: {
				warehouse_racks: [],
				outgoings: [],
				deliveryOrders: [],
				payments: [],
				salesOrders: []
			}
		};
		this.views = {};
		this.apiBaseUrl = window.fai.getModule('base_url');
	}

	async init(config) {
		this.config = {
			orderSystemJson: {
				warehouse_racks: [],
				outgoings: [],
				deliveryOrders: [],
				payments: [],
				salesOrders: [],
				filteredSalesOrders: [],
				...(config?.orderSystemJson || {})
			},
			...config
		};

		await this.registerViews();
		//this.showView('home');
		//this.setupEventListeners();
	}
	
	async loadData(keys = [], options = {}) {
		console.log(keys);
		const need = new Set(keys); // agar lebih cepat saat cek key
		const configJson = this.config.orderSystemJson;
		const loaders = [];

		if (need.has("warehouse_racks")) {
			loaders.push(
				this.apiRequest("api/warehouse_racks").then(async racksResponse => {
					configJson.warehouseRacks = racksResponse || await this.getSampleRacks();
				})
			);
		}
		if (need.has("suppliers")) {
			loaders.push(
				this.apiRequest("api/crud", {
					headers: { // gunakan "headers", bukan "header"
						"Authorization": "",
						"Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
						"apps": btoa(JSON.stringify({
							"apps": "Outsourcing",
							"page_view": "channel",
							"load_type": "list",
							"load_page_id": -1
						}))
					}
				}).then(async Response => {
					configJson.suppliers = Response;
				})
			);
		}
		if (need.has("payment_webapps")) {
			loaders.push(
				this.apiRequest("api/crud", {
					headers: { // gunakan "headers", bukan "header"
						"Authorization": "",
						"Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
						"apps": btoa(JSON.stringify({
							"apps": "Webmaster",
							"page_view": "payment_webapps",
							"load_type": "list",
							"load_page_id": -1
						}))
					}
				}).then(async Response => {
					configJson.payment_webapps = Response;
				})
			);
		}
		if (need.has("payment_method")) {
			loaders.push(
				this.apiRequest("api/crud", {
					headers: { // gunakan "headers", bukan "header"
						"Authorization": "",
						"Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
						"apps": btoa(JSON.stringify({
							"apps": "Webmaster",
							"page_view": "payment_method",
							"load_type": "list",
							"load_page_id": -1
						}))
					}
				}).then(async Response => {
					configJson.payment_method = Response;
				})
			);
		}
		if (need.has("payment_brand")) {
			loaders.push(
				this.apiRequest("api/crud?index=0", {
					method: 'PATCH',
					headers: { // gunakan "headers", bukan "header"
						"Authorization": "",
						"Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
						"apps": btoa(JSON.stringify({
							"apps": "Webmaster",
							"page_view": "payment_method",
							"load_type": "list",
							"load_page_id": -1
						}))
					}
				}).then(async Response => {
					configJson.payment_brand = Response;
				})
			);
		}
		if (need.has("jenis_transaksi")) {
			loaders.push(
				this.apiRequest("api/crud", {
					headers: { // gunakan "headers", bukan "header"
						"Authorization": "",
						"Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
						"apps": btoa(JSON.stringify({
							"apps": "Webmaster",
							"page_view": "jenis_transaksi",
							"load_type": "list",
							"load_page_id": -1
						}))
					}
				}).then(async Response => {
					configJson.jenis_transaksi = Response;
				})
			);
		}


		if (need.has("sales_orders")) {
			loaders.push(this.apiRequest("api/sales_orders").then(async soResponse => {
				const soData = typeof soResponse === "string" ? JSON.parse(soResponse) : soResponse;
				configJson.salesOrders = soData.map(so => ({
					...so,
					items: (typeof so.items === "string" ? JSON.parse(so.items) : so.items || []).map(item => ({
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
				configJson.filteredSalesOrders = [...configJson.salesOrders];
			}));
		}

		if (need.has("payments")) {
			loaders.push(this.apiRequest("api/payments").then(async paymentResponse => {
				configJson.payments = paymentResponse.map(payment => {
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
			}));
		}

		if (need.has("outgoings")) {
			loaders.push(this.apiRequest("api/outgoings").then(async outgoingResponse => {
				configJson.outgoings = outgoingResponse.map(outgoing => {
					let items = [];
					try {
						items = typeof outgoing.items === 'string'
							? JSON.parse(outgoing.items)
							: outgoing.items || [];
					} catch (error) {
						console.error('Error parsing items for outgoing:', outgoing.id, error);
					}

					items = items.map(item => {
						let breakdown = [];
						try {
							breakdown = typeof item.breakdown === 'string'
								? JSON.parse(item.breakdown)
								: item.breakdown || [];
						} catch (error) {
							console.error('Error parsing breakdown for item:', item.id, error);
						}

						return { ...item, breakdown };
					});

					return { ...outgoing, items };
				});
			}));
		}
		if (need.has("receivings")) {
			loaders.push(this.apiRequest("api/receivings", options).then(async receivingResponse => {
				configJson.receivings = receivingResponse.map(receiving => {
					let items = [];
					try {
						items = typeof receiving.items === 'string'
							? JSON.parse(receiving.items)
							: receiving.items || [];
					} catch (error) {
						console.error('Error parsing items for receiving:', receiving.id, error);
					}

					items = items.map(item => {
						let breakdown = [];
						try {
							breakdown = typeof item.breakdown === 'string'
								? JSON.parse(item.breakdown)
								: item.breakdown || [];
						} catch (error) {
							console.error('Error parsing breakdown for item:', item.id, error);
						}

						return { ...item, breakdown };
					});

					return { ...receiving, items };
				});
			}));
		}
		if (need.has("stok_opname")) {
			loaders.push(this.apiRequest("api/stok_opname").then(async stok_opnameResponse => {
				configJson.stok_opname = stok_opnameResponse.map(stok_opname => {
					let detail = [];
					try {
						detail = typeof stok_opname.detail === 'string'
							? JSON.parse(stok_opname.detail)
							: stok_opname.detail || [];
					} catch (error) {
						console.error('Error parsing items for outgoing:', stok_opname.id, error);
					}



					return { ...stok_opname, detail };
				});
			}));
			alert();
		}

		if (need.has("delivery_orders")) {
			loaders.push(this.apiRequest("api/delivery_orders").then(async deliveryResponse => {
				configJson.deliveryOrders = deliveryResponse;
			}));
		}

		if (need.has("purchase_orders")) {
			loaders.push(this.apiRequest("api/purchase_orders").then(async poResponse => {
				const poDataRaw = poResponse || await this.getSamplePOs();
				const poData = typeof poDataRaw === "string" ? JSON.parse(poDataRaw) : poDataRaw;

				const parsedPOs = poData.map(po => ({
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

				configJson.filteredPurchaseOrders = parsedPOs;
				configJson.PurchaseOrders = [...parsedPOs];
			}));
		}

		try {
			await Promise.all(loaders);
			console.log("✅ Data loaded:", [...need]);
			return configJson;

		} catch (error) {
			console.error('❌ Error loading data:', error);
		}
	}

	async apiRequest(endpoint, options = {}) {
		try {

			this.apiBaseUrl = window.fai.getModule('base_url');
			const response = await fetch(`${this.apiBaseUrl}${endpoint}`, {
				headers: {
					'Content-Type': 'application/json',
					...options.headers
				},
				method: options.method || 'GET',
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

	async registerViews() {
		const [
			{ default: AdminListUI },
			{ default: DeliveryOrderUI },
			{ default: PurchaseOrderUI },
			{ default: SalesOrderUI },
			{ default: OutgoingUI },
			{ default: ReceiveUI },
			{ default: ReturReceiveUI },
			{ default: ProdukListUI },
			{ default: ConfirmPaymentUI },
			{ default: RecapStockUI },
			{ default: PaymentTabUI },
		] = await Promise.all([
			import('../AppUIBuilder/OrderSystem/Admin/AdminListUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/DeliveryOrderUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/PurchaseOrderUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/SalesOrderUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/OutgoingUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/ReceiveUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/ReturReceiveUI.js'),
			import('../AppUIBuilder/OrderSystem/User/ProdukListUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/ConfirmPaymentUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/RecapStockUI.js'),
			import('../AppUIBuilder/OrderSystem/Admin/PaymentTabUI.js'),

		]);
		// Daftar semua view yang tersedia
		this.views = {
			// home: new HomeUI(),
			produk_list: new ProdukListUI(),
			//pre_order: new PreOrderUI(),
			//wishlist: new WishlistUI(),
			//cart: new CartUI(),
			purchase_order: new PurchaseOrderUI(),
			//delivery_order: new DeliveryOrderUI(),
			//invoice: new InvoiceUI(),
			admin_order_list: new AdminListUI(),
			//booking_request: new BookingRequestUI(),
			//booking_confirmed: new BookingConfirmedUI(),
			//purchase_request: new PurchaseRequestUI(),

			//waiting_take_order: new WaitingTakeOrderUI(),
			//order_proses: new OrderProsesUI(),
			//quotation_request: new QuotationRequestUI(),
			//quotation_confirm: new QuotationConfirmUI(),
			sales_order: new SalesOrderUI(),
			//invoice: new InvoiceUI(),
			//kontrabon: new KontrabonUI(),
			//payment: new PaymentUI(),
			//contract_signed: new ContractSignedUI(),
			//assign_team: new AssignTeamUI(),
			//schedule: new ScheduleUI(),
			//milestone: new MilestoneUI(),
			//cancelled: new CancelledUI(),
			outgoing: new OutgoingUI(),
			//retur_outgoing: new ReturOutgoingUI(),
			//refund_outgoing: new RefundOutgoingUI(),
			delivery_order: new DeliveryOrderUI(),
			//pickup_done: new PickupDoneUI(),
			//assigned_driver: new AssignedDriverUI(),
			//retur_delivery_order: new ReturDeliveryOrderUI(),
			//digital_delivery: new DigitalDeliveryUI(),
			//access_granted: new AccessGrantedUI(),
			//license_issued: new LicenseIssuedUI(),
			receive: new ReceiveUI(),
			retur_receive: new ReturReceiveUI(),
			paymentTab: new PaymentTabUI(),
			confirm_payment: new ConfirmPaymentUI(),
			//refund_receive: new RefundReceiveUI(),
			//stok_opname: new StokOpnameUI(),
			//selesai: new SelesaiUI(),
			//review: new ReviewUI(),
			//user_order_list: new UserOrderListUI(),
			//user_order_detail: new UserOrderDetailUI(),
			//gudang_list: new GudangListUI(),
			//stock_opname: new StockOpnameUI(),
			recap_stock: new RecapStockUI(),
		};
		this.config.arrayLoad = {
			sales_order: ["warehouse_racks", "sales_orders", "payments", "outgoings", "delivery_orders"],
			confirm_payment: ["payments"],
		};
	}

	async showView(viewName, id = null) {
		if (this.views[viewName]) {
			this.currentView = viewName;
			//document.getElementById('currentViewTitle').textContent = this.getViewTitle(viewName);

			// Update menu aktif
			//document.querySelectorAll('.menu-item').forEach(item => {
			//    item.classList.remove('active');
			//    if (item.getAttribute('data-view') === viewName) {
			//        item.classList.add('active');
			//    }
			//});

			// Render konten view
			//const contentElement = document.getElementById('viewContent');
			//const contentElement = document.getElementById('viewContent');
			//contentElement.innerHTML = 


			await this.views[viewName].init(this.config, id);
			const link = document.createElement("link");
			link.rel = "stylesheet";
			link.href = this.getModule("base_url") + "FaiFramework/Pages/OrderSystem/style.css";
			const container = document.getElementById("pages_content");
			container.prepend(link);
			if (typeof this.views[viewName].afterRender === 'function') {
				//this.views[viewName].afterRender();
			}
		} else {
			console.error(`View ${viewName} tidak ditemukan`);
		}
	}

	getViewTitle(viewName) {
		const titles = {
			home: "Home",
			produk_list: "Daftar Produk",
			cart: "Keranjang Belanja",
			purchase_order: "Purchase Order",
			delivery_order: "Delivery Order",
			invoice: "Invoice",
			payment: "Pembayaran",
			admin_order_list: "Daftar Pesanan Admin"
		};

		return titles[viewName] || viewName;
	}

	setupEventListeners() {
		// Navigasi menu
		document.querySelectorAll('.menu-item').forEach(item => {
			item.addEventListener('click', () => {
				const viewName = item.getAttribute('data-view');
				this.showView(viewName);
			});
		});

		// Tombol next dan previous
		document.getElementById('nextView').addEventListener('click', () => {
			const viewOrder = Object.keys(this.views);
			const currentIndex = viewOrder.indexOf(this.currentView);
			const nextIndex = (currentIndex + 1) % viewOrder.length;
			this.showView(viewOrder[nextIndex]);
		});

		document.getElementById('prevView').addEventListener('click', () => {
			const viewOrder = Object.keys(this.views);
			const currentIndex = viewOrder.indexOf(this.currentView);
			const prevIndex = (currentIndex - 1 + viewOrder.length) % viewOrder.length;
			this.showView(viewOrder[prevIndex]);
		});
	}

}
