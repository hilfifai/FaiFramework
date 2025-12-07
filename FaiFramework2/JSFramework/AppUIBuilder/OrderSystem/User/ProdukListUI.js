export default class ProdukListUI {
            constructor() {
                this.currentView = 'grid';
                this.filteredProducts = [];
                this.currentProduct = null;
                this.selectedVariations = {};
            }
			init() {
                this.currentView = 'grid';
                this.filteredProducts = [...produkData];
                this.currentProduct = null;
                this.selectedVariations = {};
				
				this.render();
				this.renderList();
            }
            
            render() {
				let HTML=`<div class="content">
            <div class="filter-section">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari produk...">
                </div>
                
                <div class="filter-controls">
                    <select class="filter-select" id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="komputer">Komputer</option>
                        <option value="aksesoris">Aksesoris</option>
                        <option value="audio">Audio</option>
                        <option value="layar">Layar</option>
                        <option value="mobile">Mobile</option>
                    </select>
                    
                    <select class="filter-select" id="sortBy">
                        <option value="name_asc">Nama A-Z</option>
                        <option value="name_desc">Nama Z-A</option>
                        <option value="price_asc">Harga Terendah</option>
                        <option value="price_desc">Harga Tertinggi</option>
                        <option value="newest">Terbaru</option>
                    </select>
                    
                    <div class="view-toggle">
                        <button class="view-btn active" id="gridView">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="view-btn" id="listView">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div id="productListContainer">
                <!-- Product list will be rendered here -->
            </div>
            
            <div class="pagination">
                <button class="pagination-btn">&laquo;</button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">&raquo;</button>
            </div>
        </div>
        <div class="modal" id="productDetailModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="modalProductTitle">Detail Produk</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="modal-product-details">
                        <div class="modal-product-image">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="modal-product-info">
                            <div id="modalProductPrice"></div>
                            <div class="modal-rating" id="modalProductRating"></div>
                            <div class="modal-stock" id="modalProductStock"></div>
                            <div class="modal-description" id="modalProductDescription"></div>
                            
                            <div class="modal-variations" id="modalProductVariations"></div>
                            
                            <div class="preorder-info" id="modalPreorderInfo" style="display: none;">
                                <i class="fas fa-info-circle"></i>
                                <span>Produk ini dalam status pre-order. Estimasi pengiriman: <span id="preorderDays"></span> hari setelah pembayaran.</span>
                            </div>
                            
                            <div class="modal-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn" id="decreaseQty">-</button>
                                    <input type="number" class="quantity-input" id="productQty" value="1" min="1">
                                    <button class="quantity-btn" id="increaseQty">+</button>
                                </div>
                                <button class="add-to-cart-btn" id="addToCartBtn">
                                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
		document.getElementById('pages_content').innerHTML = HTML;
			}
            
            renderList() {
                return `
                    <h3 style="margin-bottom: 20px; font-size: 24px; color: #333;">Daftar Produk</h3>
                    <div class="${this.currentView === 'grid' ? 'product-grid' : 'product-list'}">
                        ${this.renderProducts()}
                    </div>
                `;
            }
            
            renderProducts() {
                let produkHTML = '';
                
                this.filteredProducts.forEach(produk => {
                    const hasDiscount = produk.harga_diskon && produk.harga_diskon < produk.harga;
                    const discountPercent = hasDiscount ? 
                        Math.round((1 - produk.harga_diskon / produk.harga) * 100) : 0;
                    
                    const isPreOrder = produk.pre_order && produk.pre_order.tersedia;
                    const isOutOfStock = produk.stok === 0;
                    
                    produkHTML += `
                        <div class="product-card">
                            <div class="product-img">
                                <i class="fas fa-box-open"></i>
                                ${hasDiscount ? `
                                    <span class="product-badge badge-discount">-${discountPercent}%</span>
                                ` : ''}
                                ${isPreOrder ? `
                                    <span class="product-badge badge-preorder">Pre-order</span>
                                ` : ''}
                            </div>
                            <div class="product-info">
                                <div class="product-title">${produk.nama}</div>
                                
                                <div class="product-price">
                                    <span class="price-current">
                                        Rp ${hasDiscount ? produk.harga_diskon.toLocaleString('id-ID') : produk.harga.toLocaleString('id-ID')}
                                    </span>
                                    ${hasDiscount ? `
                                        <span class="price-original">Rp ${produk.harga.toLocaleString('id-ID')}</span>
                                    ` : ''}
                                </div>
                                
                                <div class="product-meta">
                                    <div class="product-rating">
                                        <span class="rating-stars">
                                            ${this.renderRatingStars(produk.rating)}
                                        </span>
                                        <span>(${produk.jumlah_ulasan})</span>
                                    </div>
                                    <div class="product-category">
                                        ${produk.kategori[0]}
                                    </div>
                                </div>
                                
                                <div class="product-stock">
                                    <span class="stock-label">Stok: </span>
                                    <span class="stock-value ${isOutOfStock ? 'out-of-stock' : (produk.stok < 5 ? 'low-stock' : 'in-stock')}">
                                        ${isOutOfStock ? 'Habis' : `${produk.stok} unit`}
                                    </span>
                                </div>
                                
                                <div class="product-actions">
                                    <button class="btn btn-secondary" onclick="produkListUI.showProductDetail('${produk.id}')">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <button class="btn btn-primary" ${isOutOfStock && !isPreOrder ? 'disabled' : ''} 
                                        onclick="produkListUI.handleBuyButton('${produk.id}')">
                                        <i class="fas fa-cart-plus"></i> ${isPreOrder ? 'Pre-order' : 'Beli'}
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                return produkHTML;
            }
            
            renderRatingStars(rating) {
                const fullStars = Math.floor(rating);
                const halfStar = rating % 1 >= 0.5;
                const emptyStars = 5 - fullStars - (halfStar ? 1 : 0);
                
                let starsHTML = '';
                
                // Full stars
                for (let i = 0; i < fullStars; i++) {
                    starsHTML += '<i class="fas fa-star"></i>';
                }
                
                // Half star
                if (halfStar) {
                    starsHTML += '<i class="fas fa-star-half-alt"></i>';
                }
                
                // Empty stars
                for (let i = 0; i < emptyStars; i++) {
                    starsHTML += '<i class="far fa-star"></i>';
                }
                
                return starsHTML;
            }
            
            showProductDetail(productId) {
                this.currentProduct = produkData.find(p => p.id === productId);
                if (!this.currentProduct) return;
                
                // Reset selected variations
                this.selectedVariations = {};
                
                // Update modal content
                document.getElementById('modalProductTitle').textContent = this.currentProduct.nama;
                
                const hasDiscount = this.currentProduct.harga_diskon && this.currentProduct.harga_diskon < this.currentProduct.harga;
                document.getElementById('modalProductPrice').innerHTML = `
                    <span class="modal-price">
                        Rp ${hasDiscount ? this.currentProduct.harga_diskon.toLocaleString('id-ID') : this.currentProduct.harga.toLocaleString('id-ID')}
                    </span>
                    ${hasDiscount ? `
                        <span class="modal-original-price">Rp ${this.currentProduct.harga.toLocaleString('id-ID')}</span>
                    ` : ''}
                `;
                
                document.getElementById('modalProductRating').innerHTML = `
                    <span class="rating-stars">${this.renderRatingStars(this.currentProduct.rating)}</span>
                    <span>${this.currentProduct.rating} (${this.currentProduct.jumlah_ulasan} ulasan)</span>
                `;
                
                const isOutOfStock = this.currentProduct.stok === 0;
                const isPreOrder = this.currentProduct.pre_order && this.currentProduct.pre_order.tersedia;
                document.getElementById('modalProductStock').innerHTML = `
                    <span class="stock-label">Stok: </span>
                    <span class="${isOutOfStock ? 'out-of-stock' : (this.currentProduct.stok < 5 ? 'low-stock' : 'in-stock')}">
                        ${isOutOfStock ? 'Habis' : `${this.currentProduct.stok} unit`}
                        ${isPreOrder ? ' (Pre-order tersedia)' : ''}
                    </span>
                `;
                
                document.getElementById('modalProductDescription').textContent = this.currentProduct.deskripsi;
                
                // Render variations if available
                let variationsHTML = '';
                if (this.currentProduct.variasi && this.currentProduct.variasi.length > 0) {
                    this.currentProduct.variasi.forEach(variation => {
                        variationsHTML += `
                            <div class="variation-group">
                                <label class="variation-label">${variation.nama}:</label>
                                <div class="variation-options">
                                    ${variation.opsi.map(option => `
                                        <div class="variation-option" data-var-id="${variation.id}" data-opt-id="${option.id}" 
                                             onclick="produkListUI.selectVariation('${variation.id}', '${option.id}')">
                                            ${option.nama} 
                                            ${option.harga_tambahan > 0 ? `(+Rp ${option.harga_tambahan.toLocaleString('id-ID')})` : ''}
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                        `;
                    });
                }
                document.getElementById('modalProductVariations').innerHTML = variationsHTML;
                
                // Show pre-order info if available
                const preorderInfo = document.getElementById('modalPreorderInfo');
                if (isPreOrder) {
                    preorderInfo.style.display = 'block';
                    document.getElementById('preorderDays').textContent = this.currentProduct.pre_order.durasi_hari;
                } else {
                    preorderInfo.style.display = 'none';
                }
                
                // Update add to cart button
                const addToCartBtn = document.getElementById('addToCartBtn');
                if (isOutOfStock && !isPreOrder) {
                    addToCartBtn.disabled = true;
                    addToCartBtn.innerHTML = '<i class="fas fa-times"></i> Stok Habis';
                } else {
                    addToCartBtn.disabled = false;
                    addToCartBtn.innerHTML = isPreOrder ? 
                        '<i class="fas fa-cart-plus"></i> Pre-order Sekarang' : 
                        '<i class="fas fa-cart-plus"></i> Tambah ke Keranjang';
                }
                
                // Show modal
                document.getElementById('productDetailModal').style.display = 'block';
            }
            
            selectVariation(variationId, optionId) {
                this.selectedVariations[variationId] = optionId;
                
                // Update UI to show selected variation
                document.querySelectorAll(`.variation-option[data-var-id="${variationId}"]`).forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                document.querySelector(`.variation-option[data-var-id="${variationId}"][data-opt-id="${optionId}"]`).classList.add('selected');
            }
            
            handleBuyButton(productId) {
                this.showProductDetail(productId);
            }
            
            addToCart() {
                if (!this.currentProduct) return;
                
                const quantity = parseInt(document.getElementById('productQty').value) || 1;
                const isPreOrder = this.currentProduct.pre_order && this.currentProduct.pre_order.tersedia;
                
                // Validate variations if needed
                if (this.currentProduct.variasi && this.currentProduct.variasi.length > 0) {
                    for (const variation of this.currentProduct.variasi) {
                        if (!this.selectedVariations[variation.id]) {
                            alert(`Silakan pilihan ${variation.nama} terlebih dahulu`);
                            return;
                        }
                    }
                }
                
                // Prepare cart item
                const cartItem = {
                    productId: this.currentProduct.id,
                    name: this.currentProduct.nama,
                    price: this.currentProduct.harga_diskon || this.currentProduct.harga,
                    quantity: quantity,
                    variations: {...this.selectedVariations},
                    isPreOrder: isPreOrder
                };
                
                // In a real application, you would add to cart storage or send to server
                console.log('Added to cart:', cartItem);
                
                // Show success message
                alert(`${quantity} ${this.currentProduct.nama} berhasil ditambahkan ke keranjang!`);
                
                // Close modal
                this.closeModal();
            }
            
            closeModal() {
                document.getElementById('productDetailModal').style.display = 'none';
            }
            
            afterRender() {
                // Setup event listeners after rendering
                document.getElementById('searchInput').addEventListener('input', (e) => {
                    this.filterProducts(e.target.value, document.getElementById('categoryFilter').value);
                });
                
                document.getElementById('categoryFilter').addEventListener('change', (e) => {
                    this.filterProducts(document.getElementById('searchInput').value, e.target.value);
                });
                
                document.getElementById('gridView').addEventListener('click', () => {
                    this.setView('grid');
                });
                
                document.getElementById('listView').addEventListener('click', () => {
                    this.setView('list');
                });
                
                // Modal event listeners
                document.querySelector('.close-modal').addEventListener('click', () => {
                    this.closeModal();
                });
                
                document.getElementById('decreaseQty').addEventListener('click', () => {
                    const qtyInput = document.getElementById('productQty');
                    let qty = parseInt(qtyInput.value) || 1;
                    if (qty > 1) {
                        qtyInput.value = qty - 1;
                    }
                });
                
                document.getElementById('increaseQty').addEventListener('click', () => {
                    const qtyInput = document.getElementById('productQty');
                    let qty = parseInt(qtyInput.value) || 1;
                    qtyInput.value = qty + 1;
                });
                
                document.getElementById('addToCartBtn').addEventListener('click', () => {
                    this.addToCart();
                });
                
                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target === document.getElementById('productDetailModal')) {
                        this.closeModal();
                    }
                });
            }
            
            filterProducts(searchTerm, category) {
                searchTerm = searchTerm.toLowerCase();
                
                this.filteredProducts = produkData.filter(produk => {
                    const matchesSearch = produk.nama.toLowerCase().includes(searchTerm) || 
                                         produk.deskripsi.toLowerCase().includes(searchTerm);
                    
                    const matchesCategory = !category || produk.kategori.includes(category);
                    
                    return matchesSearch && matchesCategory;
                });
                
                this.rerender();
            }
            
            setView(viewType) {
                this.currentView = viewType;
                
                // Update active button
                document.getElementById('gridView').classList.toggle('active', viewType === 'grid');
                document.getElementById('listView').classList.toggle('active', viewType === 'list');
                
                this.rerender();
            }
            
            rerender() {
                const container = document.getElementById('productListContainer');
                container.innerHTML = this.render();
            }
        }