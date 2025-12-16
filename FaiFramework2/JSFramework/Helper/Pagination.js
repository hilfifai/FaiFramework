export default class Pagination {
    /**
     * @param {Object} options - Konfigurasi pagination
     * @param {HTMLElement} options.container - Container untuk pagination
     * @param {Number} options.totalItems - Total seluruh data
     * @param {Number} options.pageSize - Jumlah data per halaman (default: 10)
     * @param {Number} options.currentPage - Halaman saat ini (default: 1)
     * @param {Function} options.onPageChange - Callback saat halaman berubah
     * @param {Function} options.onPageSizeChange - Callback saat pageSize berubah
     */
    

    init(options = {}) {
        this.container = options.container;
        console.log(this.container);
        this.totalItems = options.totalItems || 0;
        this.pageSize = options.pageSize || 10;
        this.currentPage = options.currentPage || 1;
        this.onPageChange = options.onPageChange || (() => { });
        this.onPageSizeChange = options.onPageSizeChange || (() => { });
        this.render();
        this.bindEvents();
    }

    get totalPages() {
        return Math.ceil(this.totalItems / this.pageSize);
    }

    get hasPrev() {
        return this.currentPage > 1;
    }

    get hasNext() {
        return this.currentPage < this.totalPages;
    }

    get offset() {
        return (this.currentPage - 1) * this.pageSize;
    }

    get paginationInfo() {
        return {
            totalItems: this.totalItems,
            pageSize: this.pageSize,
            currentPage: this.currentPage,
            totalPages: this.totalPages,
            hasPrev: this.hasPrev,
            hasNext: this.hasNext,
            offset: this.offset,
            limit: this.pageSize
        };
    }

    getPageNumbers(currentPage, totalPages) {
        const pageNumbers = [];
        const maxVisiblePages = 5;

        if (totalPages <= maxVisiblePages) {
            for (let i = 1; i <= totalPages; i++) {
                pageNumbers.push(i);
            }
        } else {
            let startPage = Math.max(2, currentPage - 1);
            let endPage = Math.min(totalPages - 1, currentPage + 1);

            if (currentPage <= 3) {
                startPage = 2;
                endPage = 4;
            } else if (currentPage >= totalPages - 2) {
                startPage = totalPages - 3;
                endPage = totalPages - 1;
            }

            pageNumbers.push(1);

            if (startPage > 2) {
                pageNumbers.push('...');
            }

            for (let i = startPage; i <= endPage; i++) {
                pageNumbers.push(i);
            }

            if (endPage < totalPages - 1) {
                pageNumbers.push('...');
            }

            pageNumbers.push(totalPages);
        }

        return pageNumbers;
    }

    render() {
       
       

        const paginationInfo = this.paginationInfo;
        const pageNumbers = this.getPageNumbers(paginationInfo.currentPage, paginationInfo.totalPages);

        const container = `
      <div class="pagination-container">
        <div class="pagination-left">
          <label>
            Menampilkan
            <select class="page-size-select" value="${this.pageSize}">
              <option value="10">10 item</option>
              <option value="25">25 item</option>
              <option value="50">50 item</option>
              <option value="100">100 item</option>
            </select>
            dari ${paginationInfo.totalItems} item
          </label>
        </div>

        <div class="pagination-controls">
          <!-- Tombol Previous -->
          <button class="pagination-btn prev-btn" ${!paginationInfo.hasPrev ? 'disabled' : ''}>
            <i class="fas fa-chevron-left"></i>
          </button>

          <!-- Nomor halaman -->
          ${pageNumbers.map(page => {
            if (page === '...') {
                return `<button class="pagination-ellipsis">...</button>`;
            } else {
                const isActive = page === paginationInfo.currentPage;
                return `
                <button class="pagination-btn page-btn ${isActive ? 'active' : ''}" 
                        data-page="${page}">
                  ${page}
                </button>
              `;
            }
        }).join('')}

          <!-- Tombol Next -->
          <button class="pagination-btn next-btn" ${!paginationInfo.hasNext ? 'disabled' : ''}>
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    `;
        document.getElementById(this.container).innerHTML= container;
        // Set selected option untuk page size
        const select = document.getElementById(this.container).querySelector('.page-size-select');
        if (select) {
            select.value = this.pageSize;
        }
    }

    bindEvents() {
        if (!this.container) return;

        // Event delegation untuk button halaman
        document.getElementById(this.container).addEventListener('click', (e) => {
            const target = e.target;

            // Previous button
            if (target.closest('.prev-btn')) {
                e.preventDefault();
                if (this.hasPrev) {
                    this.goToPage(this.currentPage - 1);
                }
            }

            // Next button
            else if (target.closest('.next-btn')) {
                e.preventDefault();
                if (this.hasNext) {
                    this.goToPage(this.currentPage + 1);
                }
            }

            // Page number button
            else if (target.closest('.page-btn')) {
                e.preventDefault();
                const pageBtn = target.closest('.page-btn');
                const page = parseInt(pageBtn.dataset.page);
                if (!isNaN(page)) {
                    this.goToPage(page);
                }
            }
        });

        // Page size change
        document.getElementById(this.container).addEventListener('change', (e) => {
            if (e.target.classList.contains('page-size-select')) {
                e.preventDefault();
                const newPageSize = parseInt(e.target.value);
                if (!isNaN(newPageSize) && newPageSize !== this.pageSize) {
                    this.changePageSize(newPageSize);
                }
            }
        });
    }

    goToPage(page) {
        if (page < 1 || page > this.totalPages || page === this.currentPage) {
            return;
        }

        this.currentPage = page;
        this.render();
        this.onPageChange(this.paginationInfo);
    }

    changePageSize(newPageSize) {
        if (newPageSize <= 0) return;

        const newTotalPages = Math.ceil(this.totalItems / newPageSize);
        let newCurrentPage = this.currentPage;

        // Adjust current page if needed
        if (newCurrentPage > newTotalPages) {
            newCurrentPage = newTotalPages || 1;
        }

        const oldPageSize = this.pageSize;
        this.pageSize = newPageSize;
        this.currentPage = newCurrentPage;

        this.render();
        this.onPageSizeChange({
            oldPageSize,
            newPageSize,
            ...this.paginationInfo
        });
        this.onPageChange(this.paginationInfo);
    }

    update(totalItems, currentPage = 1) {
        this.totalItems = totalItems;
        this.currentPage = currentPage;
        this.render();
    }

    destroy() {
        if (this.container) {
            this.container.innerHTML = '';
            // Remove event listeners if needed
        }
    }
}