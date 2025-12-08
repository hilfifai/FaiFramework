import FormBuilder from './FormBuilder.js';

import FaiModule from '../FaiModule.js';
export default class CrudBuilder  extends FaiModule{
    constructor() {
        super();
        this.config = {
            isViewChange: false,
            isChangeView: false,
            isBulkButton: false,
            isColumnChange: false,
            isApproveButton: false,

        };
        this.container = "";
        this.data = [];
        this.table = null;
        this.formBuilder = null;
        this.currentView = 'table';
        this.selectedRows = [];
        this.sortable = null;
        this.config.serverSide = true;
        this.serverSideMode = false;
        this.activeSubKategori = null; // Tambahkan state untuk sub kategori aktif
        this.subKategoriData = {};
    }
    async CrudConfig(config) {
        this.config = config;
        this.config.serverSide = true;
        this.container = document.getElementById(config.containerId);
        this.data = [];
        this.table = null;
        this.formBuilder = null;
    }
    async init() {
        if (!this.container) {
            console.error(`Container with ID "${this.config.containerId}" not found.`);
            return;
        }
        await this._refactorConfigArray();
        console.log(this.config);
        this._renderBaseLayout();
        this.showLoading(true);

        try {
            await this._fetchData();
            await this._initDataTable();
            this._bindGlobalEvents();
            this._initViewModes();
            this._refactorSubKategoriConfig();
            this._initSubKategori();
        } catch (error) {
            console.error("Initialization failed:", error);
            this.container.innerHTML = `<div class="alert alert-danger">Gagal memuat data tabel.</div>`;
        } finally {
            this.showLoading(false);
        }
    }

    _renderBaseLayout() {
        this.container.innerHTML = `
            <div class="container-fluid mt-4" id="containterCrud">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-block m-3">
                                <h4 class="mb-3">
                                    <i class="fas fa-table me-2"></i>
                                    ${this.config.page?.title || 'Advanced Data Table'}
                                </h4>
                                
                                <!-- View Mode Toggle -->
								 ${this.config.isViewChange ? `
                                    
                                <div class="btn-group me-3" role="group" aria-label="View Mode">
                                    
                                    <button type="button" class="btn btn-outline-primary active" id="tableViewBtn" data-view="table">
                                        <i class="fas fa-table me-1"></i>
                                        Table
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" id="horizontalViewBtn" data-view="horizontal">
                                        <i class="fas fa-list me-1"></i>
                                        Horizontal
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" id="verticalViewBtn" data-view="vertical">
                                        <i class="fas fa-bars me-1"></i>
                                        Vertical
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" id="cardViewBtn" data-view="card">
                                        <i class="fas fa-th-large me-1"></i>
                                        Cards
                                    </button>
                                </div> 
								
                                    ` : ''}
                                <!-- Form Mode Toggle -->
                                 ${this.config.isChangeView ? `
                                <div class="btn-group me-3" role="group" aria-label="Form Mode">
                                    <button type="button" class="btn btn-outline-secondary active" id="formModeBtn" data-mode="form">
                                        <i class="fas fa-window-maximize me-1"></i>
                                        Form
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" id="modalModeBtn" data-mode="modal">
                                        <i class="fas fa-table me-1"></i>
                                        Modal
                                    </button>
                                </div>
                                 ` : ''}
                                
                                <div class="btn-group">
                                    ${!this.config.page?.crud?.no_add ? `
                                    <button type="button" class="btn btn-primary" id="addNewBtn">
                                        <i class="fas fa-plus me-1"></i>
                                        Tambah Data
                                    </button>
                                    ` : ''}
                                    ${this.config.isColumnChange ? `
                                        <button type="button" class="btn btn-info" id="columnSettingsBtn">
                                        <i class="fas fa-columns me-1"></i>
                                        Column Settings
                                        </button>
                                        ` : ''}
                                     ${this.config.isBulkButton ? `
                                        <!-- colum bulk  -->
                                        ${!this.config.page?.crud?.no_edit ? `
                                        <button type="button" class="btn btn-warning" id="bulkEditBtn" disabled>
                                            <i class="fas fa-edit me-1"></i>
                                            Edit Massal
                                        </button>
                                        ` : ''}
                                        <button type="button" class="btn btn-success" id="bulkApproveBtn" disabled>
                                            <i class="fas fa-check me-1"></i>
                                            Approve Selected
                                        </button>
                                        ${!this.config.page?.crud?.no_delete ? `
                                        <button type="button" class="btn btn-danger" id="bulkDeleteBtn" disabled>
                                            <i class="fas fa-trash me-1"></i>
                                            Delete Selected
                                        </button>
                                        ` : ''}
                                    ` : ''}
                                </div>
                            </div>
                            
                            <div class="card-body d-block">
                                <!-- Filter Section -->
                                <div class="row mb-3">
                                    ${this._renderFilters()}
                                    <div class="col-md-3 d-none align-items-end">
                                        <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                                            <i class="fas fa-times me-1"></i>
                                            Clear Filters
                                        </button>
                                    </div>
                                </div>
                                
                                
                                <!-- Data Views Container -->
                                <div id="dataViewsContainer">
                                    <!-- Table View (Default) -->
                                    <div id="tableView" class="data-view active">
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th width="40">
                                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                                        </th>
                                                        <th width="40">
                                                            <i class="fas fa-grip-vertical text-muted"></i>
                                                        </th>
                                                        ${this._generateTableHeaders()}
                                                        ${!this.config.page?.crud?.no_action ? '<th width="120">Actions</th>' : ''}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data will be populated by DataTables -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Horizontal List View -->
                                    <div id="horizontalView" class="data-view">
                                        <div id="horizontalListContainer" class="horizontal-list-container">
                                            <!-- Horizontal list items will be generated here -->
                                        </div>
                                    </div>

                                    <!-- Vertical List View -->
                                    <div id="verticalView" class="data-view">
                                        <div id="verticalListContainer" class="vertical-list-container">
                                            <!-- Vertical list items will be generated here -->
                                        </div>
                                    </div>

                                    <!-- Card View -->
                                    <div id="cardView" class="data-view">
                                        <div id="cardContainer" class="card-container">
                                            <!-- Card items will be generated here -->
                                        </div>
                                    </div>
                                </div>
                            
                                
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add/Edit Modal -->
            <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dataModalLabel">Tambah Data Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="dataForm">
                            <div class="modal-body" id="modalFormBody">
                                <!-- Form fields will be generated here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mt-3" id="inlineFormContainer" style="display: none;">
                <div class="card-header">
                    <h5 class="card-title mb-0" id="inlineFormTitle">Tambah Data Baru</h5>
                </div>
                <div class="card-body">
                    <form id="inlineDataForm">
                        <div class="row" id="inlineFormBody">
                            <!-- Form fields will be generated here -->
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" id="cancelInlineForm">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sub Kategori Modal -->
            <div class="modal fade" id="subKategoriModal" tabindex="-1" aria-labelledby="subKategoriModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subKategoriModalLabel">Sub Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="subKategoriModalBody">
                            <!-- Sub kategori content will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Loading Overlay -->
            <div id="loadingOverlay" class="loading-overlay" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
    }
    _refactorSubKategoriConfig() {
        if (!this.config.page?.crud?.sub_kategori) return;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayType = subKategori[3] || 'table';

            // Inisialisasi konfigurasi sub kategori
            if (!this.config.page.crud.sub_kategori_config) {
                this.config.page.crud.sub_kategori_config = {};
            }

            this.config.page.crud.sub_kategori_config[tableName] = {
                displayName: subKategori[0],
                tableName: tableName,
                displayType: displayType,
                noAdd: this.config.page?.crud?.no_add_sub_kategori?.[tableName] || false,
                noRow: this.config.page?.crud?.no_row_sub_kategori?.[tableName] || false,
                fields: this.config.page.crud.array_sub_kategori[index] || [],
                databaseConfig: this.config.page?.crud?.database_sub_kategori?.[tableName] || {}
            };
        });
    }
    _renderSubKategoriTabs() {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        let tabsHtml = `
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="subKategoriTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="main-tab" data-bs-toggle="tab" 
                                        data-bs-target="#main-content" type="button" role="tab" 
                                        aria-controls="main-content" aria-selected="true">
                                    ${this.config.page?.title || 'Data Utama'}
                                </button>
                            </li>
    `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];


            tabsHtml += `
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="${tableName}-tab" data-bs-toggle="tab" 
                        data-bs-target="#${tableName}-content" type="button" role="tab" 
                        aria-controls="${tableName}-content" aria-selected="false"
                        data-table="${tableName}" data-index="${index}">
                    ${subKategori[0]}
                    <span class="badge bg-secondary ms-1 sub-kategori-badge" id="badge-${tableName}">0</span>
                </button>
            </li>
        `;
        });

        tabsHtml += `
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `;

        return tabsHtml;
    }

    _renderSubKategoriContent() {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        let contentHtml = `
        <div class="tab-content" id="subKategoriTabContent">
            <div class="tab-pane fade show active" id="main-content" role="tabpanel" aria-labelledby="main-tab">
                <!-- Data utama akan ditampilkan di sini -->
            </div>
    `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayType = subKategori[3] || 'table';
            const noAdd = this.config.page?.crud?.no_add_sub_kategori?.[tableName];

            contentHtml += `
            <div class="tab-pane fade" id="${tableName}-content" role="tabpanel" aria-labelledby="${tableName}-tab">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-folder me-2"></i>
                            ${config.displayName}
                        </h5>
                        <div class="sub-kategori-actions">
                            ${!config.noAdd ? `
                            <button type="button" class="btn btn-sm btn-primary me-2" id="addSubKategori-${tableName}">
                                <i class="fas fa-plus me-1"></i>
                                Tambah
                            </button>
                            ` : ''}
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="refreshSubKategori-${tableName}">
                                <i class="fas fa-sync-alt me-1"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        ${displayType === 'table' ?
                    this._renderSubKategoriTable(tableName) :
                    this._renderSubKategoriForm(tableName)}
                    </div>
                </div>
            </div>
        `;
        });

        contentHtml += `</div>`;
        return contentHtml;
    }



    _renderSubKategoriTable(tableName, index) {
        const arrayConfig = this.config.page.crud.array_sub_kategori[index] || [];
        console.log("------------------------------------");
        console.log(this.config.page.crud.array_sub_kategori);
        console.log(index);
        let tableHtml = `
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="subKategoriTable-${tableName}">
                    <thead class="table-light">
                        <tr>
        `;

        arrayConfig.forEach(field => {
            tableHtml += `<th>${field[0]}</th>`;
        });

        tableHtml += `
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh DataTables -->
                    </tbody>
                </table>
            </div>
        `;

        return tableHtml;
    }

    _renderSubKategoriForm(tableName, index) {
        // Untuk mode form, kita akan render form multiple
        return `
            <div class="sub-kategori-forms" id="subKategoriForms-${tableName}">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
        `;
    }
    _formatSubKategoriValue(value, fieldConfig) {
        // Implementasi formatting value berdasarkan tipe field
        if (fieldConfig[2] === 'date' && value) {
            return new Date(value).toLocaleDateString('id-ID');
        }
        if (fieldConfig[2] === 'currency' && value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(value);
        }
        return value || '-';
    }

    _updateSubKategoriBadge(tableName, count) {
        const badge = $(`#badge-${tableName}`);
        if (badge.length) {
            badge.text(count);
            badge.toggleClass('bg-secondary bg-primary', count > 0);
        }
    }

    _renderSubKategoriError(tableName) {
        const container = $(`#subKategoriBody-${tableName}`);
        container.html(`
        <tr>
            <td colspan="${this.config.page.crud.sub_kategori_config[tableName].fields.length + 2}" 
                class="text-center py-4 text-danger">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                <p>Gagal memuat data</p>
                <button class="btn btn-sm btn-outline-primary mt-2" 
                        onclick="crudBuilder._loadSubKategoriData('${tableName}', null, true)">
                    Coba Lagi
                </button>
            </td>
        </tr>
    `);
    }
    _initSubKategori() {
        if (!this.config.page?.crud?.sub_kategori) return;
        $('#subKategoriTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', (e) => {
            const target = $(e.target);
            const tableName = target.data('table');
            const index = target.data('index');

            if (tableName && index !== undefined) {
                this._loadSubKategoriData(tableName, index);
            }
        });


        // Event handler untuk tombol tambah dan refresh - PERBAIKAN: Gunakan event delegation
        $(document).on('click', '[id^="addSubKategori-"]', (e) => {
            const id = e.target.id;
            const tableName = id.replace('addSubKategori-', '');
            const index = this.config.page.crud.sub_kategori.findIndex(sub => sub[1] === tableName);

            if (index !== -1) {
                this._showSubKategoriForm('add', tableName, index);
            }
        });

        $(document).on('click', '[id^="refreshSubKategori-"]', (e) => {
            const id = e.target.id;
            const tableName = id.replace('refreshSubKategori-', '');
            const index = this.config.page.crud.sub_kategori.findIndex(sub => sub[1] === tableName);

            if (index !== -1) {
                this._loadSubKategoriData(tableName, index, true);
            }
        });

        // Load data untuk tab pertama jika ada
        const firstTab = this.config.page.crud.sub_kategori[0];
        if (firstTab) {
            this._loadSubKategoriData(firstTab[1], 0);
        }
        $('.sub-kategori-btn').on('click', (e) => {
            const target = $(e.currentTarget).data('sub-kategori');
            const index = $(e.currentTarget).data('index');
            this.switchSubKategori(target, index);
        });

        // Event handler untuk tambah sub kategori
        $('.add-sub-kategori-btn').on('click', (e) => {
            const tableName = $(e.currentTarget).data('table');
            const index = $(e.currentTarget).data('index');
            this._showSubKategoriForm('add', tableName, index);
        });

        // Load data untuk sub kategori utama
        this._loadSubKategoriData('main');
        // Event handler untuk tombol tambah dan refresh
        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];

            // Tombol tambah
            $(`#addSubKategori-${tableName}`).on('click', () => {
                this._showSubKategoriForm('add', tableName, index);
            });

            $(`#refreshSubKategori-${tableName}`).on('click', () => {
                this._loadSubKategoriData(tableName, index, true);
            });
        });
    }

    _renderSubKategoriNav() {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        let navHtml = `
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Sub Kategori</h6>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" role="group" aria-label="Sub Kategori">
                                    <button type="button" class="btn btn-outline-primary active sub-kategori-btn" data-sub-kategori="main" data-index="-1">
                                        Utama
                                    </button>
            `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const isActive = index === 0 ? 'active' : '';
            navHtml += `
                    <button type="button" class="btn btn-outline-primary sub-kategori-btn" data-sub-kategori="${subKategori[1]}" data-index="${index}">
                        ${subKategori[0]}
                    </button>
                `;
        });

        navHtml += `
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

        return navHtml;
    }

    _renderSubKategoriContent() {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        let contentHtml = '';

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const subKategoriConfig = subKategori[3] || 'table';
            const tableName = subKategori[1];
            const noAdd = this.config.page?.crud?.no_add_sub_kategori?.[tableName];
            const noRow = this.config.page?.crud?.no_row_sub_kategori?.[tableName];

            contentHtml += `
                    <div class="sub-kategori-content" id="subKategoriContent-${tableName}" style="display: none;">
                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">${subKategori[0]}</h5>
                                ${!noAdd ? `
                                <button type="button" class="btn btn-sm btn-primary add-sub-kategori-btn" data-table="${tableName}" data-index="${index}">
                                    <i class="fas fa-plus me-1"></i>
                                    Tambah
                                </button>
                                ` : ''}
                            </div>
                            <div class="card-body">
                                ${subKategoriConfig === 'table' ? this._renderSubKategoriTable(tableName, index) : this._renderSubKategoriForm(tableName, index)}
                            </div>
                        </div>
                    </div>
                `;
        });

        return contentHtml;
    }





    _handleSubKategoriFromList(id, tableName, rowData) {
        // Simpan data row yang dipilih
        this.selectedMainRow = rowData;
        this.selectedMainRowId = id;

        // Cari index sub kategori berdasarkan tableName
        const subKategoriIndex = this.config.page.crud.sub_kategori.findIndex(
            sub => sub[1] === tableName
        );

        if (subKategoriIndex === -1) {
            this.showToast('Sub kategori tidak ditemukan', 'error');
            return;
        }

        // Switch ke tab sub kategori yang sesuai
        this._switchToSubKategoriTab(tableName, subKategoriIndex);

        // Load data sub kategori dengan filter berdasarkan main row ID
        this._loadSubKategoriDataWithParent(tableName, subKategoriIndex, id);
    }

    _switchToSubKategoriTab(tableName, index) {
        $(`#${tableName}-tab`).tab('show');

        const tabContent = $('#subKategoriTabContent');
        if (tabContent.length) {
            $('html, body').animate({
                scrollTop: tabContent.offset().top - 100
            }, 500);
        }
    }

    async _loadSubKategoriDataWithParent(tableName, index, parentId) {
        this._showSubKategoriLoading(tableName, true);

        try {
            const config = this.config.page.crud.sub_kategori_config[tableName];
            let url = `${this.config.backendUrl}${this.config.apiUrl}?index=${index}&parent_id=${parentId}`;

            // Tambahkan parameter join jika ada
            if (config.databaseConfig.join) {
                url += `&join=${encodeURIComponent(JSON.stringify(config.databaseConfig.join))}`;
            }

            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const response = await fetch(url, { method: "FECTH", headers: myHeaders });
            const data = await response.json();

            this.subKategoriData[tableName] = data.data?.row || data.rows || data.data || [];
            console.log(this.subKategoriData);
            this._updateSubKategoriBadge(tableName, this.subKategoriData[tableName].length);

            this._showParentRowInfo(tableName);

            this._renderSubKategoriData(tableName);

        } catch (error) {
            console.error(`Failed to load sub kategori data for ${tableName}:`, error);
            this.showToast(`Gagal memuat data ${tableName}`, 'error');
            this._renderSubKategoriError(tableName);
        } finally {
            this._showSubKategoriLoading(tableName, false);
        }
    }
    _showSubKategoriLoading(tableName, show) {
        const container = $(`#subKategoriBody-${tableName}`);
        if (show) {
            container.html(`
            <tr>
                <td colspan="${this.config.page.crud.sub_kategori_config[tableName].fields.length + 2}" 
                    class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </td>
            </tr>
        `);
        }
    }
    _showParentRowInfo(tableName) {
        if (!this.selectedMainRow) return;

        const container = $(`#${tableName}-content .card-header`);
        const existingInfo = container.find('.parent-row-info');

        if (existingInfo.length) {
            existingInfo.remove();
        }

        const infoHtml = `
        <div class="parent-row-info mt-2 p-2 bg-light rounded">
            <small class="text-muted">
                <i class="fas fa-link me-1"></i>
                Data Terkait: 
                <strong>${this.selectedMainRow.nama || this.selectedMainRow.name || `#${this.selectedMainRowId}`}</strong>
            </small>
        </div>
    `;

        container.append(infoHtml);
    }

    switchSubKategori(subKategori, index) {
        // Update button states
        $('.sub-kategori-btn').removeClass('active');
        $(`.sub-kategori-btn[data-sub-kategori="${subKategori}"]`).addClass('active');

        // Hide all sub kategori content
        $('.sub-kategori-content').hide();

        if (subKategori === 'main') {
            // Show main data views
            $('#dataViewsContainer').show();
            $('#subKategoriContainer').hide();
        } else {
            // Hide main data views, show selected sub kategori
            $('#dataViewsContainer').hide();
            $('#subKategoriContainer').show();
            $(`#subKategoriContent-${subKategori}`).show();

            // Load data untuk sub kategori jika belum diload
            this._loadSubKategoriData(subKategori, index);
        }

        this.activeSubKategori = subKategori;
    }

    async _loadSubKategoriData(subKategori, index = -1) {
        if (this.subKategoriData[subKategori]) {
            // Data sudah diload, render ulang
            this._renderSubKategoriData(subKategori, index);
            return;
        }

        this.showLoading(true);

        try {
            let url = `${this.config.backendUrl}${this.config.apiUrl}`;

            if (subKategori !== 'main') {
                // Load data sub kategori
                const subKategoriConfig = this.config.page.crud.sub_kategori[index];
                const tableName = subKategoriConfig[1];

                // Tambahkan parameter untuk sub kategori
                url += `?index=${index}`;

                // Tambahkan join jika ada konfigurasi database_sub_kategori
                const dbConfig = this.config.page?.crud?.database_sub_kategori?.[tableName];
                if (dbConfig) {
                    if (dbConfig.join) {
                        url += `&join=${encodeURIComponent(JSON.stringify(dbConfig.join))}`;
                    }
                    // Tambahkan konfigurasi database lainnya jika diperlukan
                }
            }

            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const requestOptions = {
                method: "PATCH",
                headers: myHeaders,
                redirect: "follow"
            };

            const response = await fetch(url, requestOptions);
            const data = await response.json();

            this.subKategoriData[subKategori] = data.data?.row || data.rows || data.data || [];

            this._renderSubKategoriData(subKategori, index);

        } catch (error) {
            console.error(`Failed to load sub kategori data for ${subKategori}:`, error);
            this.showToast(`Gagal memuat data ${subKategori}`, 'error');
        } finally {
            this.showLoading(false);
        }
    }

    _renderSubKategoriData(subKategori, index) {
        if (subKategori === 'main') return;

        const data = this.subKategoriData[subKategori] || [];
        const subKategoriConfig = this.config.page.crud.sub_kategori[index];
        console.log(index);
        console.log(subKategoriConfig);
        console.log(this.subKategoriData[subKategori]);
        const tableName = subKategoriConfig[1];
        const displayType = subKategoriConfig[3] || 'table';

        if (displayType === 'table') {
            this._renderSubKategoriTableData(tableName, index, data);
        } else {
            this._renderSubKategoriFormData(tableName, index, data);
        }
    }

    _renderSubKategoriTableData(tableName, data) {
        const container = $(`#subKategoriTable-${tableName}:visible`);
        const config = this.config.page.crud.sub_kategori_config[tableName];
        const namaField = config.fields[0];

        if (!namaField) return;

        if (data.length === 0) {
            container.html(`
            <tr class="empty-row">
                <td colspan="3" class="text-center py-3 text-muted">
                    <i class="fas fa-inbox me-2"></i>
                    Belum ada data
                </td>
            </tr>
        `);
            return;
        }

        let rowsHtml = '';
        data.forEach((item, index) => {
            const fieldValue = item[namaField[1]] || '';
            rowsHtml += `
            <tr class="edit-row" data-id="${item.primary_key}">
                <td class="row-number">${index + 1}</td>
                <td>
                    <input type="text" 
                           class="form-control form-control-sm" 
                           name="${tableName}_${namaField[1]}_edit[${item.primary_key}]"
                           value="${fieldValue}"
                           placeholder="Masukkan ${namaField[0]}"
                           required>
                    <input type="hidden" name="${tableName}_${namaField[1]}_edit_id[]" value="${item.primary_key}">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        });

        container.html(rowsHtml);
        this._updateRowNumbers(tableName);
    }
    async _loadSingleSubKategoriInForm(tableName, parentId) {
        const container = $(`#subKategoriTable-${tableName}:visible`);
        if (!container.length) return;

        try {
            const config = this.config.page.crud.sub_kategori_config[tableName];
            let url = `${this.config.backendUrl}${this.config.apiUrl}?index=${config.index}&parent_id=${parentId}`;

            if (config.databaseConfig.join) {
                url += `&join=${encodeURIComponent(JSON.stringify(config.databaseConfig.join))}`;
            }

            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const response = await fetch(url, { method: "PATCH", headers: myHeaders });
            const data = await response.json();

            const subKategoriData = data.data?.row || data.rows || data.data || [];

            this._renderSubKategoriTableData(tableName, subKategoriData);

        } catch (error) {
            console.error(`Failed to load sub kategori data for ${tableName}:`, error);
            container.html(`
            <tr>
                <td colspan="3" class="text-center py-3 text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <small>Gagal memuat data</small>
                </td>
            </tr>
        `);
        }
    }
    _renderSubKategoriFormData(tableName, index, data) {
        const container = $(`#subKategoriForms-${tableName}`);
        container.empty();

        data.forEach((item, rowIndex) => {
            const formHtml = this._createSubKategoriForm(item, tableName, index, rowIndex);
            container.append(formHtml);
        });

        // Bind event handlers untuk form
        this._bindSubKategoriFormEvents(tableName, index);
    }

    _createSubKategoriForm(data, tableName, index, rowIndex) {
        const arrayConfig = this.config.page.crud.array_sub_kategori[index] || [];
        const isNew = !data.id;

        let formHtml = `
                <div class="card mb-3 sub-kategori-form" data-table="${tableName}" data-id="${data.id || 'new'}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">${isNew ? 'Data Baru' : `Data #${data.id}`}</h6>
                        <div>
                            <button type="button" class="btn btn-sm btn-success save-sub-kategori-btn" data-table="${tableName}" data-index="${index}" data-row="${rowIndex}">
                                <i class="fas fa-save"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-sub-kategori-btn" data-table="${tableName}" data-id="${data.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
            `;

        arrayConfig.forEach((field, fieldIndex) => {
            const fieldName = field[1];
            const value = data[fieldName] || '';

            formHtml += `
                    <div class="col-md-6 mb-2">
                        <label class="form-label">${field[0]}</label>
                        <input type="text" class="form-control form-control-sm" name="${fieldName}" value="${value}" 
                               data-field="${fieldName}" data-row="${rowIndex}">
                    </div>
                `;
        });

        formHtml += `
                        </div>
                    </div>
                </div>
            `;

        return formHtml;
    }

    _bindSubKategoriTableEvents(tableName, index) {
        $(`#subKategoriBody-${tableName} .edit-sub-kategori-btn`).on('click', (e) => {
            const id = $(e.currentTarget).data('id');
            const rowIndex = $(e.currentTarget).data('row');
            this._editSubKategoriItem(tableName, index, id, rowIndex);
        });

        $(`#subKategoriBody-${tableName} .delete-sub-kategori-btn`).on('click', (e) => {
            const id = $(e.currentTarget).data('id');
            this._deleteSubKategoriItem(tableName, id);
        });
    }

    _bindSubKategoriFormEvents(tableName, index) {
        $(`#subKategoriForms-${tableName} .save-sub-kategori-btn`).on('click', (e) => {
            const rowIndex = $(e.currentTarget).data('row');
            this._saveSubKategoriItem(tableName, index, rowIndex);
        });

        $(`#subKategoriForms-${tableName} .delete-sub-kategori-btn`).on('click', (e) => {
            const id = $(e.currentTarget).data('id');
            this._deleteSubKategoriItem(tableName, id);
        });
    }

    _showSubKategoriForm(mode, tableName, index, data = null) {
        const config = this.config.page.crud.sub_kategori_config[tableName];

        // Jika ada parent row yang dipilih, tambahkan parent_id ke data
        if (this.selectedMainRowId && (!data || mode === 'add')) {
            if (!data) data = {};

            // Cari field yang merupakan foreign key ke parent
            const parentField = this._findParentField(tableName);
            if (parentField) {
                data[parentField] = this.selectedMainRowId;
            }
        }

        if (config.displayType === 'table') {
            this._addSubKategoriTableRow(tableName, data);
        } else {
            this._addSubKategoriForm(tableName, data);
        }
    }

    _findParentField(tableName) {
        // Cari field yang mungkin merupakan foreign key ke tabel utama
        const config = this.config.page.crud.sub_kategori_config[tableName];
        const possibleFields = ['parent_id', 'main_id', 'header_id', 'master_id'];

        for (let field of possibleFields) {
            if (config.fields.some(f => f[1] === field)) {
                return field;
            }
        }

        // Jika tidak ditemukan, return field pertama yang mengandung 'id'
        const idField = config.fields.find(f => f[1].includes('id') && f[1] !== 'id');
        return idField ? idField[1] : null;
    }
    _updateSubKategoriBadge(tableName, count) {
        const badge = $(`#badge-${tableName}`);
        if (badge.length) {
            badge.text(count);
            if (count > 0) {
                badge.removeClass('bg-secondary').addClass('bg-success');
                badge.html(`<i class="fas fa-check me-1"></i>${count}`);
            } else {
                badge.removeClass('bg-success').addClass('bg-secondary');
                badge.text(count);
            }
        }

        $(`.sub-kategori-list-btn[data-table="${tableName}"]`).each(function () {
            const btn = $(this);
            const currentId = btn.data('id');
            if (currentId === this.selectedMainRowId) {
                if (count > 0) {
                    btn.removeClass('btn-outline-info').addClass('btn-success');
                } else {
                    btn.removeClass('btn-success').addClass('btn-outline-info');
                }
            }
        });
    }

    _addSubKategoriTableRow(tableName, index, data = null) {
        const arrayConfig = this.config.page.crud.array_sub_kategori[index] || [];
        const tbody = $(`#subKategoriBody-${tableName}`);
        const rowIndex = tbody.children().length;

        let rowHtml = '<tr class="new-row">';

        arrayConfig.forEach(field => {
            const fieldName = field[1];
            const value = data ? data[fieldName] : '';
            rowHtml += `
                    <td>
                        <input type="text" class="form-control form-control-sm" name="${fieldName}" value="${value}" 
                               data-field="${fieldName}" data-row="${rowIndex}">
                    </td>
                `;
        });

        rowHtml += `
                <td>
                    <button class="btn btn-sm btn-success save-sub-kategori-btn" data-table="${tableName}" data-index="${index}" data-row="${rowIndex}">
                        <i class="fas fa-save"></i>
                    </button>
                    <button class="btn btn-sm btn-danger cancel-sub-kategori-btn" data-table="${tableName}" data-row="${rowIndex}">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>`;

        tbody.append(rowHtml);

        // Bind event handlers
        $(`#subKategoriBody-${tableName} tr:last .save-sub-kategori-btn`).on('click', (e) => {
            const rowIndex = $(e.currentTarget).data('row');
            this._saveSubKategoriTableRow(tableName, index, rowIndex);
        });

        $(`#subKategoriBody-${tableName} tr:last .cancel-sub-kategori-btn`).on('click', (e) => {
            const rowIndex = $(e.currentTarget).data('row');
            $(`#subKategoriBody-${tableName} tr:eq(${rowIndex})`).remove();
        });
    }

    _addSubKategoriForm(tableName, index, data = null) {
        const container = $(`#subKategoriForms-${tableName}`);
        const formData = data || {};
        const formHtml = this._createSubKategoriForm(formData, tableName, index, container.children().length);

        container.append(formHtml);
        this._bindSubKategoriFormEvents(tableName, index);
    }

    async _saveSubKategoriTableRow(tableName, index, rowIndex) {
        const row = $(`#subKategoriBody-${tableName} tr:eq(${rowIndex})`);
        const inputs = row.find('input');
        const formData = {};

        inputs.each(function () {
            const fieldName = $(this).data('field');
            const value = $(this).val();
            formData[fieldName] = value;
        });

        await this._saveSubKategoriData(tableName, index, formData, rowIndex);
    }

    async _saveSubKategoriData(tableName, index, formData, rowIndex) {
        this.showLoading(true);

        try {
            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const isEdit = !!formData.id;
            const requestOptions = {
                method: isEdit ? "PUT" : "POST",
                headers: myHeaders,
                body: JSON.stringify({
                    ...formData,
                    sub_kategori_table: tableName
                }),
                redirect: "follow"
            };

            const url = `${this.config.backendUrl}${this.config.apiUrl}`;
            const response = await fetch(url, requestOptions);
            const result = await response.json();

            if (response.ok) {
                this.showToast('Data berhasil disimpan', 'success');
                // Reload data sub kategori
                delete this.subKategoriData[tableName];
                this._loadSubKategoriData(tableName, index);
            } else {
                throw new Error(result.message || 'Gagal menyimpan data');
            }

        } catch (error) {
            console.error('Failed to save sub kategori data:', error);
            this.showToast('Gagal menyimpan data', 'error');
        } finally {
            this.showLoading(false);
        }
    }

    async _deleteSubKategoriItem(tableName, id) {
        if (!confirm('Anda yakin ingin menghapus data ini?')) return;

        this.showLoading(true);

        try {
            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const requestOptions = {
                method: "DELETE",
                headers: myHeaders,
                redirect: "follow"
            };

            const url = `${this.config.backendUrl}${this.config.apiUrl}?id=${id}&sub_kategori_table=${tableName}`;
            const response = await fetch(url, requestOptions);

            if (response.ok) {
                this.showToast('Data berhasil dihapus', 'success');
                // Reload data sub kategori
                delete this.subKategoriData[tableName];
                this._loadSubKategoriData(tableName,
                    this.config.page.crud.sub_kategori.findIndex(sub => sub[1] === tableName));
            } else {
                throw new Error('Gagal menghapus data');
            }

        } catch (error) {
            console.error('Failed to delete sub kategori data:', error);
            this.showToast('Gagal menghapus data', 'error');
        } finally {
            this.showLoading(false);
        }
    }
    _refactorSubKategoriConfig() {
        if (!this.config.page?.crud?.sub_kategori) return;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayType = subKategori[3] || 'table';

            // Inisialisasi konfigurasi sub kategori
            if (!this.config.page.crud.sub_kategori_config) {
                this.config.page.crud.sub_kategori_config = {};
            }

            this.config.page.crud.sub_kategori_config[tableName] = {
                displayName: subKategori[0],
                tableName: tableName,
                displayType: displayType,
                index: index,
                noAdd: this.config.page?.crud?.no_add_sub_kategori?.[tableName] || false,
                noRow: this.config.page?.crud?.no_row_sub_kategori?.[tableName] || false,
                fields: this.config.page.crud.array_sub_kategori[index] || [],
                databaseConfig: this.config.page?.crud?.database_sub_kategori?.[tableName] || {}
            };
        });
    }

    _initFormMode() {
        $('#formModeBtn, #modalModeBtn').on('click', (e) => {
            const mode = $(e.currentTarget).data('mode');
            this.switchFormMode(mode);
        });
    }

    switchFormMode(mode) {
        // Update button states
        $('#formModeBtn, #modalModeBtn').removeClass('active');
        $(`[data-mode="${mode}"]`).addClass('active');

        this.formMode = mode;
    }

    _showFormModal(mode, data = null) {
        if (this.formMode === 'modal') {
            this._showFormModalMode(mode, data);
        } else {
            this._showInlineForm(mode, data);
        }
    }
    _showModalForm(mode, data = null) {
        // Implementasi modal form yang sudah ada
        const modalElement = document.getElementById('dataModal');
        const modal = new bootstrap.Modal(modalElement);

        const modalTitle = modalElement.querySelector('.modal-title');
        const modalBody = modalElement.querySelector('#modalFormBody');
        const form = modalElement.querySelector('form');
        form.reset();
        modalBody.innerHTML = '';

        modalTitle.textContent = mode === 'add' ? 'Tambah Data Baru' : `Edit Data #${data.id}`;

        // ... rest of existing modal implementation
    }

    _showInlineForm(mode, data = null) {
        const title = $('#inlineFormTitle');
        const formBody = $('#inlineFormBody');
        const form = $('#inlineDataForm');
        const container = $('#inlineFormContainer');
        $('#containterCrud').hide();
        formBody.empty();
        form[0].reset();

        title.text(mode === 'add' ? 'Tambah Data Baru' : `Edit Data #${data.id}`);

        console.log(this.getModule('domainDetail'));
        const formBuilderConfig = {
            viewContext: mode === 'add' ? 'tambah' : 'edit',
            data: data || {},
            page: { crud: this.config.page.crud },
            page_config: this.config
        };
        this.formBuilder = new FormBuilder(formBuilderConfig);

        let allJS = '';
        this.config.page.crud.array.forEach((fieldConfig, index) => {
            const components = this.formBuilder.buildField(fieldConfig, index);
            if (components.html) {
                formBody.append(components.html);
                allJS += components.js;
            }
        });
        formBody.append(this._renderSubKategoriInForm(data));
        if (allJS) {
            const scriptTag = document.createElement('script');
            scriptTag.textContent = allJS;
            formBody.append(scriptTag);
        }

        if (mode === 'edit') {
            form.append(`<input type="hidden" name="id" value="${data.id}">`);
        }

        container.show();

        // Scroll ke form
        container[0].scrollIntoView({ behavior: 'smooth' });

        this._initSubKategoriInFormEvents(data);
    }
    _initSubKategoriInFormEvents(parentData = null) {
        const parentId = parentData?.id;

        $(document).off('click', '.add-sub-kategori-row').on('click', '.add-sub-kategori-row', (e) => {
            e.preventDefault();
            const button = $(e.currentTarget);
            const tableName = button.data('table');
            const fieldName = button.data('field');

            console.log('Tambah row clicked:', tableName, fieldName); // Debug
            this._addNewSubKategoriRow(tableName, fieldName);
        });

        $(document).off('click', '.remove-row').on('click', '.remove-row', (e) => {
            e.preventDefault();
            const button = $(e.currentTarget);
            const row = button.closest('tr');
            const tableContainer = row.closest('.sub-kategori-group');
            const tableName = tableContainer.find('.add-sub-kategori-row').data('table');

            console.log('Hapus row clicked:', tableName); // Debug
            // const rowId = row.find('input[name*="[id]"]').val(); // Cari input ID

            const rowId = row.data('id');
            console.log('Hapus row clicked:', tableName, 'Row ID:', rowId); // Debug
            if (rowId && rowId !== '') {
                // Jika row sudah ada di database, tambahkan hidden input untuk delete
                const deleteInput = $(`<input type="hidden" name="deleteRow${tableName}[]" value="${rowId}">`);
                $(`#subKategoriTable-${tableName}`).append(deleteInput);

                console.log('Added delete input for row ID:', rowId); // Debug
            }
            row.remove();
            this._updateRowNumbers(tableName);
        });

        // Load data jika edit mode
        if (parentId) {
            console.log('Loading sub kategori data for parent:', parentId); // Debug
            this._loadSubKategoriInForm(parentData);
        }
        // Event untuk tombol tambah row
        // $('.add-sub-kategori-row').on('click', (e) => {
        //     const button = $(e.currentTarget);
        //     const tableName = button.data('table');
        //     const fieldName = button.data('field');

        //     this._addNewSubKategoriRow(tableName, fieldName);
        // });

        // Event untuk hapus row (delegation)
        // $(document).on('click', '.remove-row', (e) => {
        //     const button = $(e.currentTarget);
        //     const row = button.closest('tr');
        //     const tableName = row.closest('.sub-kategori-group').find('.add-sub-kategori-row').data('table');

        //     row.remove();
        //     this._updateRowNumbers(tableName);
        // });

        // Load data jika edit mode
        if (parentId) {
            this._loadSubKategoriInForm(parentData);
        }
        if (!parentId) return;

        // Event handler untuk tab change dalam form
        $('#formSubKategoriTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', (e) => {
            const target = $(e.target);
            const tableName = target.data('table');
            const index = target.data('index');

            if (tableName && index !== undefined) {
                this._loadSubKategoriInForm(tableName, index, parentId);
            }
        });

        // Event handler untuk tombol tambah dan refresh dalam form
        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];

            // Tombol tambah
            $(`#formAddSubKategori-${tableName}`).on('click', () => {
                this._showSubKategoriFormInForm('add', tableName, index, parentId);
            });

            $(`#formAddSubKategoriForm-${tableName}`).on('click', () => {
                this._showSubKategoriFormInForm('add', tableName, index, parentId);
            });

            // Tombol refresh
            $(`#formRefreshSubKategori-${tableName}`).on('click', () => {
                this._loadSubKategoriInForm(tableName, index, parentId, true);
            });
        });

        // Load data untuk tab pertama
        const firstTab = this.config.page.crud.sub_kategori[0];
        if (firstTab) {
            this._loadSubKategoriInForm(firstTab[1], 0, parentId);
        }
    }

    _addNewSubKategoriRow(tableName, fieldName) {
        console.log('Adding new row for:', tableName, fieldName); // Debug

        const container = $(`#subKategoriTable-${tableName}:visible`);
        const template = $(`#template-${tableName}`);
        const config = this.config.page.crud.sub_kategori_config[tableName];
        const namaField = config.fields[0];

        if (!container.length) {
            console.error('Container not found:', `#subKategoriTable-${tableName}`);
            return;
        }

        if (!template.length) {
            console.error('Template not found:', `#template-${tableName}`);
            return;
        }

        // Hapus empty row jika ada
        container.find('.empty-row').remove();

        // **PERBAIKAN: Clone template dengan benar**
        const newRow = template.prop('content').cloneNode(true);
        container.append(newRow);

        // **PERBAIKAN: Update row numbers**
        this._updateRowNumbers(tableName);

        console.log('New row added successfully'); // Debug
    }

    _updateRowNumbers(tableName) {
        const container = $(`#subKategoriTable-${tableName}:visible`);
        const rows = container.find('tr:not(.empty-row)');

        if (rows.length === 0) {
            container.html(`
            <tr class="empty-row">
                <td colspan="3" class="text-center py-3 text-muted">
                    <i class="fas fa-inbox me-2"></i>
                    Belum ada data
                </td>
            </tr>
        `);
            return;
        }

        rows.each(function (index) {
            $(this).find('.row-number').text(index + 1);
        });
    }
    _renderSubKategoriInForm(parentData = null) {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        const parentId = parentData?.id;
        const isEditMode = !!parentId;

        let html = `
        <div class="sub-kategori-in-form mt-4">
           
                <div class="card-body">
    `;


        html += `
            
            
            <div class="sub-kategori-tabs">
                <ul class="nav nav-tabs" id="formSubKategoriTabs" role="tablist">
        `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayName = subKategori[0];
            const isActive = index === 0 ? 'active' : '';

            html += `
                <li class="nav-item" role="presentation">
                    <button class="nav-link ${isActive}" id="formTab-${tableName}" 
                            data-bs-toggle="tab" data-bs-target="#formTabContent-${tableName}" 
                            type="button" role="tab" aria-controls="formTabContent-${tableName}" 
                            aria-selected="${index === 0 ? 'true' : 'false'}"
                            data-table="${tableName}" data-index="${index}">
                        ${displayName}
                        <span class="badge bg-secondary ms-1" id="formBadge-${tableName}">0</span>
                    </button>
                </li>
            `;
        });

        html += `
                </ul>
                
                <div class="tab-content mt-3" id="formSubKategoriTabContent">
        `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayType = subKategori[3] || 'table';
            const isActive = index === 0 ? 'show active' : '';
            const config = this.config.page.crud.sub_kategori_config?.[tableName];
            const noAdd = config?.noAdd || false;

            html += `
                <div class="tab-pane fade ${isActive}" id="formTabContent-${tableName}" 
                     role="tabpanel" aria-labelledby="formTab-${tableName}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">${subKategori[0]}</h6>
                        <div>
                            ${!noAdd ? `
                            <button type="button" class="btn btn-sm btn-primary" id="formAddSubKategori-${tableName}">
                                <i class="fas fa-plus me-1"></i>
                                Tambah
                            </button>
                            ` : ''}
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="formRefreshSubKategori-${tableName}">
                                <i class="fas fa-sync-alt me-1"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    
                    ${displayType === 'table' ?
                    this._renderSubKategoriInFormTable(tableName, index) :
                    this._renderSubKategoriInFormForms(tableName, index)}
                </div>
            `;
        });

        html += `
                </div>
            </div>
        `;


        html += `
                </div>
            </div>
        </div>
    `;

        return html;
    }
    _initSubKategoriInF2ormEvents(parentData = null) {
        const parentId = parentData?.id;

    }
    async _loadSubKategoriInForm(parentData) {
        if (!parentData?.id) return;

        const parentId = parentData.id;

        // Load data untuk semua sub kategori
        for (const subKategori of this.config.page.crud.sub_kategori) {
            const tableName = subKategori[1];
            await this._loadSingleSubKategoriInForm(tableName, parentId);
        }
    }
    _renderSubKategoriInForm(parentData = null) {
        if (!this.config.page?.crud?.sub_kategori || !this.config.page.crud.sub_kategori.length) {
            return '';
        }

        const parentId = parentData?.id;
        const isEditMode = !!parentId;

        let html = `
        <div class="sub-kategori-in-form mt-4">
           
                <div class="card-body">
    `;

        this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
            const tableName = subKategori[1];
            const displayName = subKategori[0];
            const config = this.config.page.crud.sub_kategori_config?.[tableName];
            const fields = config?.fields || [];

            // Hanya render field pertama (nama) seperti contoh Anda
            const namaField = fields[0];
            if (!namaField) return;

            html += `
            <div class="sub-kategori-group mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">
                        <i class="fas fa-folder me-2"></i>
                        ${displayName}
                    </h6>
                    <div>
                        <button type="button" class="btn btn-sm btn-success add-sub-kategori-row" 
                                data-table="${tableName}" data-field="${namaField[1]}">
                            <i class="fas fa-plus me-1"></i>
                            Tambah
                        </button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>${namaField[0]}</th>
                                <th width="80" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="subKategoriTable-${tableName}">
        `;

            if (isEditMode) {
                // Loading state untuk edit mode
                html += `
                <tr>
                    <td colspan="3" class="text-center py-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted ms-2">Memuat data...</small>
                    </td>
                </tr>
            `;
            } else {
                // Add mode - kosong
                html += `
                <tr class="empty-row">
                    <td colspan="3" class="text-center py-3 text-muted">
                        <i class="fas fa-inbox me-2"></i>
                        Belum ada data
                    </td>
                </tr>
            `;
            }

            html += `
                        </tbody>
                    </table>
                </div>
                
                <!-- Template untuk row baru -->
                <template id="template-${tableName}">
                    <tr class="new-row">
                        <td class="row-number"></td>
                        <td>
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   name="${tableName}_${namaField[1]}[]"
                                   placeholder="Masukkan ${namaField[0]}"
                                   required>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-row">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </template>
                
                <!-- Template untuk row edit -->
                <template id="template-edit-${tableName}">
                    <tr class="edit-row" data-id="">
                        <td class="row-number"></td>
                        <td>
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   name="${tableName}_${namaField[1]}_edit[id][]"
                                   placeholder="Masukkan ${namaField[0]}"
                                   required>
                            <input type="hidden" name="${tableName}_${namaField[1]}_edit[id][]" value="">
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-row">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </div>
        `;
        });

        html += `
                </div>
            </div>
        </div>
    `;

        return html;
    }
    async _loadSubKategoriIn2Form(tableName, index, parentId, forceRefresh = false) {
        const container = $(`#formSubKategoriBody-${tableName}`);
        const formsContainer = $(`#formSubKategoriForms-${tableName}`);

        // Show loading
        if (container.length) {
            container.html(`
            <tr>
                <td colspan="${this.config.page.crud.sub_kategori_config[tableName].fields.length + 2}" 
                    class="text-center py-3">
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <small class="text-muted ms-2">Memuat data...</small>
                </td>
            </tr>
        `);
        }

        if (formsContainer.length) {
            formsContainer.html(`
            <div class="text-center py-3">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <small class="text-muted ms-2">Memuat data...</small>
            </div>
        `);
        }

        try {
            const config = this.config.page.crud.sub_kategori_config[tableName];
            let url = `${this.config.backendUrl}${this.config.apiUrl}?sub_kategori=${tableName}&parent_id=${parentId}`;

            // Tambahkan parameter join jika ada
            if (config.databaseConfig.join) {
                url += `&join=${encodeURIComponent(JSON.stringify(config.databaseConfig.join))}`;
            }

            const myHeaders = new Headers();
            myHeaders.append("Authorization", this.config.api_token);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const response = await fetch(url, { method: "GET", headers: myHeaders });
            const data = await response.json();

            const subKategoriData = data.data?.row || data.rows || data.data || [];

            // Update badge count
            this._updateFormSubKategoriBadge(tableName, subKategoriData.length);

            // Render data
            if (config.displayType === 'table') {
                this._renderSubKategoriInFormTableData(tableName, subKategoriData);
            } else {
                this._renderSubKategoriInFormFormsData(tableName, subKategoriData);
            }

        } catch (error) {
            console.error(`Failed to load sub kategori data in form for ${tableName}:`, error);

            const errorHtml = `
            <tr>
                <td colspan="${this.config.page.crud.sub_kategori_config[tableName].fields.length + 2}" 
                    class="text-center py-3 text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <small>Gagal memuat data</small>
                </td>
            </tr>
        `;

            if (container.length) container.html(errorHtml);
            if (formsContainer.length) formsContainer.html(`
            <div class="text-center py-3 text-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <small>Gagal memuat data</small>
            </div>
        `);
        }
    }
    _updateFormSubKategoriBadge(tableName, count) {
        const badge = $(`#formBadge-${tableName}`);
        if (badge.length) {
            badge.text(count);
            if (count > 0) {
                badge.removeClass('bg-secondary').addClass('bg-success');
            } else {
                badge.removeClass('bg-success').addClass('bg-secondary');
            }
        }
    }
    // Tambahkan di akhir class CrudBuilder atau di CSS terpisah
    _getAdditionalCSS() {
        return `
        .sub-kategori-in-form {
            border-left: 4px solid #0d6efd;
        }
        .sub-kategori-in-form .card-header {
            border-bottom: 2px solid #0d6efd;
        }
        .sub-kategori-tabs .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        .sub-kategori-tabs .nav-link {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        .sub-kategori-in-form .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }
    `;
    }
    _renderSubKategoriInFormTable(tableName, index) {
        const config = this.config.page.crud.sub_kategori_config?.[tableName];
        const fields = config?.fields || [];

        let tableHtml = `
        <div class="table-responsive" style="max-height: 300px;">
            <table class="table table-sm table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
    `;

        fields.forEach(field => {
            tableHtml += `<th>${field[0]}</th>`;
        });

        tableHtml += `
                        <th width="80" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="formSubKategoriBody-${tableName}">
                    <tr>
                        <td colspan="${fields.length + 2}" class="text-center py-3">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <small class="text-muted ms-2">Memuat data...</small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    `;

        return tableHtml;
    }

    _renderSubKategoriInFormForms(tableName, index) {
        return `
        <div class="sub-kategori-forms-in-form" id="formSubKategoriForms-${tableName}">
            <div class="text-center py-3">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <small class="text-muted ms-2">Memuat data...</small>
            </div>
        </div>
        
        ${!this.config.page.crud.sub_kategori_config?.[tableName]?.noAdd ? `
        <div class="text-center mt-2">
            <button type="button" class="btn btn-sm btn-outline-primary" id="formAddSubKategoriForm-${tableName}">
                <i class="fas fa-plus me-1"></i>
                Tambah Data Baru
            </button>
        </div>
        ` : ''}
    `;
    }
    _renderFilters() {
        // Implement filter rendering based on config
        let filtersHtml = '';

        // Status filter
        if (this.config.page?.crud?.array?.some(field => field[1] === 'status')) {
            filtersHtml += `
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label">Filter Status:</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            `;
        }

        // Department filter
        if (this.config.page?.crud?.array?.some(field => field[1] === 'department')) {
            filtersHtml += `
                <div class="col-md-3">
                    <label for="departmentFilter" class="form-label">Filter Department:</label>
                    <select class="form-select" id="departmentFilter">
                        <option value="">Semua Department</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>
            `;
        }

        // Date filter
        if (this.config.page?.crud?.array?.some(field =>
            field[1].includes('date') || field[1].includes('tanggal') || field[1].includes('tgl'))) {
            filtersHtml += `
                <div class="col-md-3">
                    <label for="dateFilter" class="form-label">Filter Tanggal:</label>
                    <input type="date" class="form-control" id="dateFilter">
                </div>
            `;
        }

        return filtersHtml;
    }

    _generateTableHeaders() {
        let headers = '';
        const listFields = this.config.page.crud.array.filter(cfg => {
            const typeString = cfg[2] || '';
            return typeString.includes('-list') || typeString.includes('-table') || !typeString.includes('-');
        });

        listFields.forEach(cfg => {
            headers += `<th>${cfg[0]}</th>`;
        });

        return headers;
    }

    async _fetchData() {
        if (this.config.serverSide) {
            console.log('Using server-side processing, data will be fetched on demand');
            this.data = { data: { row: [] } }; // Inisialisasi struktur data kosong
            return;
        }

        // Client-side implementation
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const bearerToken = this.config.api_token;
            const myHeaders = new Headers();
            myHeaders.append("Authorization", bearerToken);
            myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            const requestOptions = {
                method: "GET",
                headers: myHeaders,
                redirect: "follow"
            };

            const response = await fetch(`${this.config.backendUrl}${this.config.apiUrl}`, requestOptions);
            const data = await response.json().catch(async () => {
                const text = await response.text();
                try {
                    return JSON.parse(text);
                } catch {
                    return text;
                }
            });

            this.data = data;
        } catch (e) {
            console.error("Failed to fetch data:", e);
            this.data = { data: { row: [] } };
            throw e;
        }
    }
    async _initDataTable() {
        const columns = await this._generateTableColumns();

        if (this.table) {
            this.table.destroy();
        }

        let searchTimeout = null;

        this.table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            scrollY: '400px',
            scrollCollapse: true,
            ajax: {
                url: `${this.config.backendUrl}${this.config.apiUrl}`,
                type: 'GET',
                headers: {
                    "Authorization": this.config.api_token,
                    "Cookie": "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt",
                    "apps": btoa(JSON.stringify(this.config.page.load))
                },
                data: function (d) {
                    const params = {
                        draw: d.draw,
                        start: d.start,
                        length: d.length,
                        search: d.search.value,
                        order: d.order,
                        columns: d.columns,
                        page: Math.floor(d.start / d.length) + 1,
                        limit: d.length
                    };

                    // Tambahkan filter dari UI
                    const statusFilter = $('#statusFilter').val();
                    const departmentFilter = $('#departmentFilter').val();
                    const dateFilter = $('#dateFilter').val();

                    if (statusFilter) params.status = statusFilter;
                    if (departmentFilter) params.department = departmentFilter;
                    if (dateFilter) params.date = dateFilter;

                    return params;
                },
                dataFilter: function (data) {
                    const json = typeof data === 'string' ? JSON.parse(data) : data;
                    return JSON.stringify({
                        draw: json.draw || 0,
                        recordsTotal: json.total || json.recordsTotal || 0,
                        recordsFiltered: json.filtered || json.recordsFiltered || 0,
                        data: json.data || json.rows || json.row || []
                    });
                }
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                search: "_INPUT_",
                searchPlaceholder: "Cari data... (tunggu 1 detik)"
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            columns: columns,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],

            // 🔥 KONFIGURASI DEBOUNCE 🔥
            searchDelay: 2000,
            initComplete: function () {

                const api = this.api();
                const searchInput = $('div.dataTables_filter input');


                searchInput.after('<div class="search-spinner" style="display: none; margin-left: 10px;"><i class="fas fa-spinner fa-spin text-muted"></i></div>');
                const spinner = $('.search-spinner');


                searchInput.on('input', function () {
                    const searchValue = $(this).val();

                    // Clear timeout sebelumnya
                    clearTimeout(searchTimeout);

                    // Tampilkan spinner jika ada input
                    if (searchValue.length > 0) {
                        spinner.show();
                    }

                    // Set timeout baru untuk debounce
                    searchTimeout = setTimeout(function () {
                        api.search(searchValue).draw();

                        // Sembunyikan spinner setelah draw selesai
                        setTimeout(() => {
                            spinner.hide();
                        }, 500);

                    }, 1000); // Delay 1 detik
                });

                // Event ketika user menekan Enter (search langsung tanpa delay)
                searchInput.on('keypress', function (e) {
                    if (e.which === 13) { // Enter key
                        clearTimeout(searchTimeout);
                        spinner.show();
                        api.search($(this).val()).draw();

                        setTimeout(() => {
                            spinner.hide();
                        }, 500);
                    }
                });

                // Event ketika search box kehilangan fokus
                searchInput.on('blur', function () {
                    clearTimeout(searchTimeout);
                    spinner.hide();
                });
            },

            // Event tambahan untuk handling draw (saat data selesai loading)
            drawCallback: function (settings) {
                // Sembunyikan spinner ketika draw selesai
                $('.search-spinner').hide();
            }
        });
        this.serverSideMode = true;
        let filterTimeout = null;

        $('#statusFilter, #departmentFilter, #dateFilter').on('change', () => {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(() => {
                this.table.ajax.reload();
            }, 1000);
        });

        $('#clearFilters').on('click', () => {
            $('#statusFilter, #departmentFilter').val('');
            $('#dateFilter').val('');
            clearTimeout(filterTimeout);
            this.table.ajax.reload(); // Langsung reload tanpa delay untuk clear
        });
    }
    async _initDataTable2() {
        const columns = await this._generateTableColumns();

        if (this.table) {
            this.table.destroy();
        }
        console.log(this.data);
        this.table = $('#dataTable').DataTable({
            data: this.data.data.row,
            processing: true,
            columns: columns,
            responsive: true,
            scrollY: '400px',
            scrollCollapse: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                search: "_INPUT_",
                searchPlaceholder: "Cari data..."
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        });
        this.table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true, // <<<<<< ini penting
            responsive: true,
            scrollY: '400px',
            scrollCollapse: true,
            ajax: (data, callback) => {
                // Ambil parameter dari DataTables
                let params = {
                    page: Math.floor(data.start / data.length) + 1, // hitung halaman
                    limit: data.length,
                    search: data.search.value
                };

                $.ajax({
                    url: '/api/suppliers',
                    type: 'GET',
                    data: params,
                    success: function (res) {
                        callback({
                            draw: data.draw,              // wajib, untuk sinkronisasi DataTables
                            recordsTotal: res.total,      // total semua data (misalnya 1000000)
                            recordsFiltered: res.total,   // kalau ada filter, jumlah setelah filter
                            data: res.data                // array data untuk tabel
                        });
                    }
                });
                this.table.serverSide = true;
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                search: "_INPUT_",
                searchPlaceholder: "Cari data..."
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            columns: columns
        });
    }

    async _generateTableColumns() {
        const columns = [];
        const listFields = this.config.page.crud.array.filter(cfg => {
            const typeString = cfg[2] || '';
            return typeString.includes('-list') || typeString.includes('-table') || !typeString.includes('-');
        });

        columns.push({
            data: null,
            title: '<input type="checkbox" id="selectAll" class="form-check-input">',
            orderable: false,
            searchable: false,
            width: '40px',
            render: (data, type, row) => {
                return `<input type="checkbox" class="form-check-input row-checkbox" data-id="${row.id}">`;
            }
        });

        columns.push({
            data: null,
            title: '<i class="fas fa-grip-vertical text-muted"></i>',
            orderable: false,
            searchable: false,
            width: '40px',
            render: () => {
                return '<i class="fas fa-grip-vertical text-muted"></i>';
            }
        });

        listFields.forEach(cfg => {
            let fieldName = cfg[1];
            const typeString = cfg[2] || '';
            if (typeString == "select") {
                if (!cfg[3][3]) {
                    fieldName = cfg[3][2] + "_" + cfg[3][0];
                } else
                    fieldName = cfg[3][2] + "_" + cfg[3][3];
            }
            columns.push({
                data: fieldName,
                title: cfg[0],
                render: (data, type, row) => {
                    return this._formatTableCell(data, fieldName, row, cfg);
                }
            });
        });

        if (!this.config.page?.crud?.no_action) {
            columns.push({
                data: null,
                title: "Aksi",
                orderable: false,
                searchable: false,
                width: '120px',
                render: (data, type, row) => {
                    return this._renderActionButtons(row);
                }
            });
        }


        return columns;
    }
    _renderSubKategoriButtons(row) {
        if (!this.config.page?.crud?.sub_kategori || this.config.page.crud.sub_kategori.length === 0) {
            return '';
        }

        let buttonsHtml = '';

        // Jika hanya ada 1 sub kategori, tampilkan button langsung
        if (this.config.page.crud.sub_kategori.length === 1) {
            const subKategori = this.config.page.crud.sub_kategori[0];
            const tableName = subKategori[1];
            const displayName = subKategori[0];

            buttonsHtml = `
            <button class="btn btn-sm btn-outline-info sub-kategori-list-btn" 
                    data-id="${row.id}" 
                    data-table="${tableName}"
                    data-row='${JSON.stringify(row).replace(/'/g, "&#39;")}'
                    title="Kelola ${displayName}">
                <i class="fas fa-folder-open me-1"></i>
                ${displayName}
            </button>
        `;
        } else {
            // Jika multiple sub kategori, buat dropdown
            buttonsHtml = `
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-info dropdown-toggle" 
                        type="button" data-bs-toggle="dropdown" 
                        aria-expanded="false"
                        title="Kelola Sub Data">
                    <i class="fas fa-folder"></i>
                </button>
                <ul class="dropdown-menu">
        `;

            this.config.page.crud.sub_kategori.forEach((subKategori, index) => {
                const tableName = subKategori[1];
                const displayName = subKategori[0];

                buttonsHtml += `
                <li>
                    <a class="dropdown-item sub-kategori-list-btn" 
                       href="#" 
                       data-id="${row.id}" 
                       data-table="${tableName}"
                       data-index="${index}"
                       data-row='${JSON.stringify(row).replace(/'/g, "&#39;")}'>
                        <i class="fas fa-folder me-2"></i>
                        ${displayName}
                    </a>
                </li>
            `;
            });

            buttonsHtml += `
                </ul>
            </div>
        `;
        }

        return buttonsHtml;
    }
    _formatTableCell(data, fieldName, row, fieldConfig) {
        // Apply table_view formatting if configured
        if (this.config.page?.crud?.table_view?.[fieldName]) {
            const viewConfig = this.config.page.crud.table_view[fieldName];

            if (viewConfig.tipe_view === 'bold-muted' && viewConfig.muted) {
                return `<strong>${data}</strong> <small class="text-muted">${row[viewConfig.muted]}</small>`;
            }

            if (viewConfig.tipe_view === 'profil_avatar') {
                return `
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm me-2">
                            <div class="avatar-title bg-primary rounded-circle">${data?.charAt(0) || 'U'}</div>
                        </div>
                        <div>
                            <div>${data}</div>
                            ${viewConfig.more_info ? `<small class="text-muted">${row[viewConfig.more_info]}</small>` : ''}
                        </div>
                    </div>
                `;
            }

            if (viewConfig.tipe_view === 'badge') {
                const statusClass = viewConfig.value?.[data] || viewConfig.else || 'secondary';
                return `<span class="badge bg-${statusClass}">${data}</span>`;
            }
        }

        // Apply function formatting if configured
        if (this.config.page?.crud?.function?.[fieldName]) {
            const funcConfig = this.config.page.crud.function[fieldName];
            if (funcConfig.type === 'help' && window[funcConfig.class] && window[funcConfig.class][funcConfig.function]) {
                const params = funcConfig.param.map(p => p === '!!!row???' ? row : p);
                return window[funcConfig.class][funcConfig.function](...params);
            }
        }

        return data;
    }

    _renderActionButtons(row) {
        let buttons = '';

        let allowEdit = !this.config.page?.crud?.no_edit;
        if (this.config.page?.crud?.edit_if) {
            const editConfig = this.config.page.crud.edit_if;
            const rowValue = row[editConfig.row_data];
            const condition = this._evaluateCondition(rowValue, editConfig.value, editConfig.operan);
            allowEdit = condition ? editConfig.true : editConfig.false;
        }

        // Check if delete is allowed
        let allowDelete = !this.config.page?.crud?.no_delete;
        if (this.config.page?.crud?.delete_if) {
            const deleteConfig = this.config.page.crud.delete_if;
            const rowValue = row[deleteConfig.row_data];
            const condition = this._evaluateCondition(rowValue, deleteConfig.value, deleteConfig.operan);
            allowDelete = condition ? deleteConfig.true : deleteConfig.false;
        }

        if (allowEdit) {
            buttons += `<button class="btn btn-sm btn-info edit-btn" data-id="${row.id}" title="Edit">
                <i class="fas fa-edit"></i>
            </button>`;
        }
        if (this.config.isApproveButton) {

            buttons += `<button class="btn btn-sm btn-success approve-btn" data-id="${row.id}" title="Approve">
            <i class="fas fa-check"></i>
            </button>`;

        }
        if (allowDelete) {
            buttons += `<button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>`;
        }
        if (this.config.page?.crud?.sub_kategori && this.config.page.crud.sub_kategori.length > 0) {

            buttons += this._renderSubKategoriButtons(row);

        }
        return buttons;
    }

    _evaluateCondition(rowValue, compareValue, operator) {
        switch (operator) {
            case '>': return rowValue > compareValue;
            case '>=': return rowValue >= compareValue;
            case '<': return rowValue < compareValue;
            case '<=': return rowValue <= compareValue;
            case '==': return rowValue == compareValue;
            case '===': return rowValue === compareValue;
            case '!=': return rowValue != compareValue;
            case '!==': return rowValue !== compareValue;
            default: return false;
        }
    }

    _bindGlobalEvents() {
        this._initFormMode();

        // Cancel inline form
        $('#cancelInlineForm').on('click', () => {
            $('#inlineFormContainer').hide();
            $('#containterCrud').show();
            $('#inlineFormContainer').hide();
        });

        // Submit inline form
        $('#inlineDataForm').on('submit', (e) => {
            e.preventDefault();
            this._handleFormSubmit(e.target, null);
            $('#inlineFormContainer').hide();
        });
        if (!this.config.page?.crud?.no_add) {
            document.getElementById('addNewBtn').addEventListener('click', () => {
                this._showFormModal('add');
            });
        }

        // Edit buttons
        $('#dataTable tbody').on('click', '.edit-btn', async (e) => {
            const id = $(e.currentTarget).data('id');

            if (this.serverSideMode) {
                // Mode server-side: Ambil data dari server via API

                await this._handleEditServerSide(id);
            } else {
                // Mode client-side: Cari data dari local data
                const rowData = this.data.data.row.find(item => item.id == id);
                if (rowData) {
                    this._showFormModal('edit', rowData);
                } else {
                    this.showToast('Data tidak ditemukan', 'error');
                }
            }
        });

        // Delete buttons
        $('#dataTable tbody').on('click', '.delete-btn', (e) => {
            const id = $(e.currentTarget).data('id');
            this._handleDelete(id);
        });

        // Approve buttons
        $('#dataTable tbody').on('click', '.approve-btn', (e) => {
            const id = $(e.currentTarget).data('id');
            this._handleApprove(id);
        });

        //sub kategori button
        $('#dataTable tbody').on('click', '.sub-kategori-list-btn', (e) => {
            e.preventDefault();
            const id = $(e.currentTarget).data('id');
            const tableName = $(e.currentTarget).data('table');
            const rowData = $(e.currentTarget).data('row');

            this._handleSubKategoriFromList(id, tableName, rowData);
        });
        // Select all checkbox
        $('#selectAll').on('change', (e) => {
            const isChecked = e.target.checked;
            $('.row-checkbox').prop('checked', isChecked);
            this._updateBulkButtons();
        });

        // Individual row checkboxes
        $('#dataTable tbody').on('change', '.row-checkbox', () => {
            this._updateBulkButtons();
        });

        // Bulk actions
        $('#bulkEditBtn').on('click', () => {
            this._handleBulkEdit();
        });

        $('#bulkDeleteBtn').on('click', () => {
            this._handleBulkDelete();
        });

        $('#bulkApproveBtn').on('click', () => {
            this._handleBulkApprove();
        });

        // Filters
        $('#statusFilter, #departmentFilter, #dateFilter').on('change', () => {
            this._applyFilters();
        });

        $('#clearFilters').on('click', () => {
            $('#statusFilter, #departmentFilter').val('');
            $('#dateFilter').val('');
            this._applyFilters();
        });
        // $(document).off('click', '.add-sub-kategori-row').on('click', '.add-sub-kategori-row', (e) => {
        //     e.preventDefault();
        //     const button = $(e.currentTarget);
        //     const tableName = button.data('table');
        //     const fieldName = button.data('field');

        //     console.log('Tambah row clicked:', tableName, fieldName); // Debug
        //     this._addNewSubKategoriRow(tableName, fieldName);
        // });
    }
    async _handleEditServerSide(id) {
        this.showLoading(true);

        try {
            let rowData;

            if (this.serverSideMode) {
                // Cari data di rows yang sedang ditampilkan
                const tableData = this.table.rows().data().toArray();
                rowData = tableData.find(item => item.id == id);

                if (!rowData) {
                    // Jika tidak ditemukan, ambil dari API
                    rowData = await this._fetchSingleRecord(id);
                }
            } else {
                // Client-side: cari dari local data
                rowData = this.data.data?.row.find(item => item.id == id);
            }

            if (rowData) {
                this._showFormModal('edit', rowData);
            } else {
                this.showToast('Data tidak ditemukan', 'error');
            }
        } catch (error) {
            console.error('Error fetching record for edit:', error);
            this.showToast('Gagal memuat data untuk edit', 'error');
        } finally {
            this.showLoading(false);
        }
    }
    async _handleDeleteWithMode(id) {
        if (this.table && this.table.serverSide) {
            await this._handleDeleteServerSide(id);
        } else {
            this._handleDelete(id);
        }
    }

    // Tambahkan method baru untuk handle approve dengan mode
    async _handleApproveWithMode(id) {
        if (this.table && this.table.serverSide) {
            await this._handleApproveServerSide(id);
        } else {
            this._handleApprove(id);
        }
    }

    // Method untuk delete dalam mode server-side
    async _handleDeleteServerSide(id) {
        const result = confirm('Anda yakin ingin menghapus data ini?');

        if (result) {
            this.showLoading(true);

            try {
                const response = await fetch(`${this.config.backendUrl}${this.config.apiUrl}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${this.config.api_token}`,
                        'apps': btoa(JSON.stringify(this.config.page.load)),
                        'id_delete': `${id}`
                    }
                });

                if (response.ok) {
                    this.showToast('Data berhasil dihapus.', 'success');
                    // Refresh table untuk server-side
                    this.table.ajax.reload();
                } else {
                    throw new Error('Gagal menghapus data');
                }
            } catch (error) {
                console.error("Delete failed:", error);
                this.showToast('Gagal menghapus data.', 'error');
            } finally {
                this.showLoading(false);
            }
        }
    }

    // Method untuk approve dalam mode server-side
    async _handleApproveServerSide(id) {
        this.showLoading(true);

        try {
            const response = await fetch(`${this.config.backendUrl}${this.config.apiUrl}/${id}/approve`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${this.config.api_token}`,
                    'Content-Type': 'application/json',
                    'apps': btoa(JSON.stringify(this.config.page.load))
                }
            });

            if (response.ok) {
                this.showToast('Data berhasil disetujui.', 'success');
                this.table.ajax.reload();
            } else {
                throw new Error('Gagal menyetujui data');
            }
        } catch (error) {
            console.error("Approve failed:", error);
            this.showToast('Gagal menyetujui data.', 'error');
        } finally {
            this.showLoading(false);
        }
    }
    async _fetchSingleRecord(id) {
        const myHeaders = new Headers();
        myHeaders.append("Authorization", this.config.api_token);
        myHeaders.append("Cookie", "ci_session=7ub6b26t9omk8mckrvh02qol7cb2jakt");
        myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

        const requestOptions = {
            method: "GET",
            headers: myHeaders,
            redirect: "follow"
        };

        const response = await fetch(`${this.config.backendUrl}${this.config.apiUrl}/${id}`, requestOptions);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return data.data || data.record || data; // Sesuaikan dengan struktur response API Anda
    }
    _initViewModes() {
        // View mode toggle events
        $('.btn-group[aria-label="View Mode"] .btn').on('click', (e) => {
            const viewMode = $(e.currentTarget).data('view');
            this.switchView(viewMode);
        });
    }

    switchView(viewMode) {
        if (this.currentView === viewMode) return;

        // Update button states
        $('.btn-group[aria-label="View Mode"] .btn').removeClass('active');
        $(`[data-view="${viewMode}"]`).addClass('active');

        // Hide all views
        $('.data-view').removeClass('active');

        // Show loading state
        $('#dataViewsContainer').addClass('view-loading');

        // Switch to new view after short delay for smooth transition
        setTimeout(() => {
            this.currentView = viewMode;
            this.renderCurrentView();
            $('#dataViewsContainer').removeClass('view-loading');
        }, 150);
    }

    renderCurrentView() {
        // Hide all views first
        $('.data-view').removeClass('active');

        switch (this.currentView) {
            case 'table':
                this.renderTableView();
                break;
            case 'horizontal':
                this.renderHorizontalView();
                break;
            case 'vertical':
                this.renderVerticalView();
                break;
            case 'card':
                this.renderCardView();
                break;
        }
    }

    renderTableView() {
        $('#tableView').addClass('active');
        // Refresh the DataTable if it exists
        if (this.table) {
            this.table.draw();
        }
    }

    renderHorizontalView() {
        $('#horizontalView').addClass('active');
        const container = $('#horizontalListContainer');
        container.empty();

        const filteredData = this.getFilteredData();

        filteredData.forEach(item => {
            const listItem = this.createHorizontalListItem(item);
            container.append(listItem);
        });

        this.initHorizontalViewEvents();
    }

    renderVerticalView() {
        $('#verticalView').addClass('active');
        const container = $('#verticalListContainer');
        container.empty();

        const filteredData = this.getFilteredData();

        filteredData.forEach(item => {
            const listItem = this.createVerticalListItem(item);
            container.append(listItem);
        });

        this.initVerticalViewEvents();
    }

    renderCardView() {
        $('#cardView').addClass('active');
        const container = $('#cardContainer');
        container.empty();

        const filteredData = this.getFilteredData();

        filteredData.forEach(item => {
            const card = this.createCardItem(item);
            container.append(card);
        });

        this.initCardViewEvents();
    }

    getFilteredData() {
        console.warn('getFilteredData() not available in server-side mode');
        return [];
    }
    switchToServerSide() {
        if (this.table) {
            this.table.destroy();
        }

        // Set flag untuk mengetahui mode yang aktif
        this.serverSideMode = true;
        this._initDataTable();
    }

    switchToClientSide() {
        if (this.table) {
            this.table.destroy();
        }

        this.serverSideMode = false;
        // Fetch semua data terlebih dahulu
        this._fetchData().then(() => {
            this._initDataTable();
        });
    }
    createHorizontalListItem(item) {
        const isSelected = this.selectedRows.includes(item.id);
        const statusClass = `status-${item.status}`;
        //const statusText = item.status.charAt(0).toUpperCase() + item.status.slice(1);

        let fieldsHtml = '';
        const listFields = this.config.page.crud.array.filter(cfg => {
            const typeString = cfg[2] || '';
            return typeString.includes('-list') || typeString.includes('-table') || !typeString.includes('-');
        });

        listFields.forEach(cfg => {
            const fieldName = cfg[1];
            const value = this._formatTableCell(item[fieldName], fieldName, item, cfg);
            fieldsHtml += `
                <div class="horizontal-list-field">
                    <div class="horizontal-list-label">${cfg[0]}</div>
                    <div class="horizontal-list-value">${value}</div>
                </div>
            `;
        });

        return $(`
            <div class="horizontal-list-item ${isSelected ? 'selected' : ''}" data-id="${item.id}">
                <div class="horizontal-list-checkbox">
                    <input type="checkbox" class="form-check-input row-checkbox" data-id="${item.id}" ${isSelected ? 'checked' : ''}>
                </div>
                <div class="horizontal-list-drag">
                    <i class="fas fa-grip-vertical drag-handle"></i>
                </div>
                <div class="horizontal-list-content">
                    ${fieldsHtml}
                </div>
                <div class="horizontal-list-actions">
                    ${this._renderActionButtons(item)}
                </div>
            </div>
        `);
    }

    createVerticalListItem(item) {
        const isSelected = this.selectedRows.includes(item.id);
        const statusClass = `status-${item.status}`;
        //const statusText = item.status.charAt(0).toUpperCase() + item.status.slice(1);

        let fieldsHtml = '';
        const listFields = this.config.page.crud.array.filter(cfg => {
            const typeString = cfg[2] || '';
            return typeString.includes('-list') || typeString.includes('-table') || !typeString.includes('-');
        });

        listFields.forEach(cfg => {
            const fieldName = cfg[1];
            const value = this._formatTableCell(item[fieldName], fieldName, item, cfg);
            fieldsHtml += `
                <div class="vertical-list-field">
                    <div class="vertical-list-label">${cfg[0]}</div>
                    <div class="vertical-list-value">${value}</div>
                </div>
            `;
        });

        return $(`
            <div class="vertical-list-item ${isSelected ? 'selected' : ''}" data-id="${item.id}">
                <div class="vertical-list-header">
                    <div class="vertical-list-controls">
                        <input type="checkbox" class="form-check-input row-checkbox" data-id="${item.id}" ${isSelected ? 'checked' : ''}>
                        <i class="fas fa-grip-vertical drag-handle ms-2"></i>
                        <span class="vertical-list-id">#${item.id}</span>
                        <span class="vertical-list-name">${item.nama || item.name}</span>
                    </div>
                    <div class="vertical-list-actions">
                        ${this._renderActionButtons(item)}
                    </div>
                </div>
                <div class="vertical-list-body">
                    ${fieldsHtml}
                </div>
            </div>
        `);
    }

    createCardItem(item) {
        const isSelected = this.selectedRows.includes(item.id);
        const statusClass = `status-${item.status}`;
        //const statusText = (item.status || "").charAt(0).toUpperCase() + (item.status || "").slice(1);

        let fieldsHtml = '';
        const listFields = this.config.page.crud.array.filter(cfg => {
            const typeString = cfg[2] || '';
            return typeString.includes('-list') || typeString.includes('-table') || !typeString.includes('-');
        });

        listFields.forEach(cfg => {
            const fieldName = cfg[1];
            const value = this._formatTableCell(item[fieldName], fieldName, item, cfg);
            fieldsHtml += `
                <div class="card-field">
                    <div class="card-label">${cfg[0]}</div>
                    <div class="card-value">${value}</div>
                </div>
            `;
        });

        return $(`
            <div class="data-card ${isSelected ? 'selected' : ''}" data-id="${item.id}">
                <div class="card-header">
                    <div class="card-controls">
                        <input type="checkbox" class="form-check-input row-checkbox" data-id="${item.id}" ${isSelected ? 'checked' : ''}>
                        <i class="fas fa-grip-vertical drag-handle ms-2"></i>
                        <span class="card-id">#${item.id}</span>
                        <span class="card-name">${item.nama || item.name}</span>
                    </div>
                    <div class="card-actions">
                        ${this._renderActionButtons(item)}
                    </div>
                </div>
                <div class="card-body">
                    ${fieldsHtml}
                </div>
            </div>
        `);
    }

    initHorizontalViewEvents() {
        const container = document.querySelector('#horizontalListContainer');
        if (this.sortable) {
            this.sortable.destroy();
        }

        this.sortable = new Sortable(container, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: (evt) => {
                this.updateRowOrderFromView(evt);
            }
        });

        // Bind checkbox events
        $('#horizontalListContainer').on('change', '.row-checkbox', (e) => {
            this.handleRowSelection(e);
        });

        // Bind action button events
        $('#horizontalListContainer').on('click', '.edit-btn', (e) => {
            this.editRecord($(e.currentTarget).data('id'));
        });
        $('#horizontalListContainer').on('click', '.approve-btn', (e) => {
            this.showApprovalModal($(e.currentTarget).data('id'));
        });
        $('#horizontalListContainer').on('click', '.delete-btn', (e) => {
            this.deleteRecord($(e.currentTarget).data('id'));
        });
    }

    initVerticalViewEvents() {
        const container = document.querySelector('#verticalListContainer');
        if (this.sortable) {
            this.sortable.destroy();
        }

        this.sortable = new Sortable(container, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: (evt) => {
                this.updateRowOrderFromView(evt);
            }
        });

        // Bind checkbox events
        $('#verticalListContainer').on('change', '.row-checkbox', (e) => {
            this.handleRowSelection(e);
        });

        // Bind action button events
        $('#verticalListContainer').on('click', '.edit-btn', (e) => {
            this.editRecord($(e.currentTarget).data('id'));
        });
        $('#verticalListContainer').on('click', '.approve-btn', (e) => {
            this.showApprovalModal($(e.currentTarget).data('id'));
        });
        $('#verticalListContainer').on('click', '.delete-btn', (e) => {
            this.deleteRecord($(e.currentTarget).data('id'));
        });
    }

    initCardViewEvents() {
        const container = document.querySelector('#cardContainer');
        if (this.sortable) {
            this.sortable.destroy();
        }

        this.sortable = new Sortable(container, {
            handle: '.drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: (evt) => {
                this.updateRowOrderFromView(evt);
            }
        });

        // Bind checkbox events
        $('#cardContainer').on('change', '.row-checkbox', (e) => {
            this.handleRowSelection(e);
        });

        // Bind action button events
        $('#cardContainer').on('click', '.edit-btn', (e) => {
            this.editRecord($(e.currentTarget).data('id'));
        });
        $('#cardContainer').on('click', '.approve-btn', (e) => {
            this.showApprovalModal($(e.currentTarget).data('id'));
        });
        $('#cardContainer').on('click', '.delete-btn', (e) => {
            this.deleteRecord($(e.currentTarget).data('id'));
        });
    }

    updateRowOrderFromView(evt) {
        // Get the new order from the current view
        const items = evt.to.children;
        const newOrder = [];

        for (let i = 0; i < items.length; i++) {
            const id = parseInt($(items[i]).data('id'));
            newOrder.push(id);
        }

        // Update data order
        const reorderedData = [];
        newOrder.forEach(id => {
            const item = this.data.data.row.find(d => d.id === id);
            if (item) {
                reorderedData.push(item);
            }
        });

        // Add any remaining items that weren't in the view
        this.data.data.row.forEach(item => {
            if (!newOrder.includes(item.id)) {
                reorderedData.push(item);
            }
        });

        this.data.data.row = reorderedData;

        // Refresh current view
        this.renderCurrentView();

        // Show success message
        this.showSuccessMessage('Urutan baris berhasil diubah!');
    }

    handleRowSelection(e) {
        const id = $(e.currentTarget).data('id');
        const isChecked = e.target.checked;

        if (isChecked) {
            this.selectedRows.push(id);
        } else {
            this.selectedRows = this.selectedRows.filter(rowId => rowId !== id);
        }

        this._updateBulkButtons();
    }

    _updateBulkButtons() {
        const hasSelected = this.selectedRows.length > 0;
        $('#bulkEditBtn, #bulkDeleteBtn, #bulkApproveBtn').prop('disabled', !hasSelected);
    }

    _showFormModalMode(mode, data = null) {
        const modalElement = document.getElementById('dataModal');
        const modal = new bootstrap.Modal(modalElement);

        const modalTitle = modalElement.querySelector('.modal-title');
        const modalBody = modalElement.querySelector('#modalFormBody');
        const form = modalElement.querySelector('form');
        form.reset();
        modalBody.innerHTML = '';

        modalTitle.textContent = mode === 'add' ? 'Tambah Data Baru' : `Edit Data #${data.id}`;

        const formBuilderConfig = {
            viewContext: mode === 'add' ? 'tambah' : 'edit',
            data: data || {},
            page: { crud: this.config.page.crud },
            page_config: this.config
        };
        this.formBuilder = new FormBuilder(formBuilderConfig);

        let allJS = '';
        this.config.page.crud.array.forEach((fieldConfig, index) => {
            const components = this.formBuilder.buildField(fieldConfig, index);
            if (components.html) {
                modalBody.innerHTML += components.html;
                allJS += components.js;
            }
        });

        modalBody.innerHTML += this._renderSubKategoriInForm(data);
        if (allJS) {
            const scriptTag = document.createElement('script');
            scriptTag.textContent = allJS;
            modalBody.appendChild(scriptTag);
        }

        // Simpan data ID di form untuk submit
        if (mode === 'edit') {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = data.id;
            form.appendChild(idInput);
        }

        modal.show();

        const newForm = form.cloneNode(true);
        form.parentNode.replaceChild(newForm, form);

        newForm.addEventListener('submit', (e) => {
            e.preventDefault();
            this._handleFormSubmit(newForm, modal);
        });
        this._initSubKategoriInFormEvents(data);



    }

    async _handleFormSubmit(formElement, modalInstance) {
        const formData = new FormData(formElement);
        // const data = Object.fromEntries(formData.entries());
        const data = {};

        for (const [key, value] of formData.entries()) {
            if (key.endsWith('[]')) {
                const cleanKey = key.replace('[]', '');
                if (!data[cleanKey]) data[cleanKey] = [];
                data[cleanKey].push(value);
            } else {
                data[key] = value;
            }
        }

        console.log(data);
        const isEdit = !!data.id;

        this.showLoading(true);

        try {
            // Prepare request
            const myHeaders = new Headers();
            myHeaders.append("Authorization", `Bearer ${this.config.api_token}`);
            myHeaders.append("Content-Type", "application/json");
            myHeaders.append("apps", btoa(JSON.stringify(this.config.page.load)));

            // Convert amount to number if exists
            if (data.amount) {
                data.amount = Number(data.amount);
            }

            const requestOptions = {
                method: isEdit ? "PUT" : "POST",
                headers: myHeaders,
                body: JSON.stringify(data),
                redirect: "follow"
            };

            const endpoint = isEdit
                ? `${this.config.backendUrl}${this.config.apiUrl}`
                : `${this.config.backendUrl}${this.config.apiUrl}`;

            // Send to API
            const response = await fetch(endpoint, requestOptions);

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Request failed');
            }

            // Refresh data
            await this._fetchData();
            this.table.clear().rows.add(this.data.data.row).draw();
            if (modalInstance)
                modalInstance.hide();

            $('#inlineFormContainer').hide();
            $('#containterCrud').show();
            this.showToast(
                isEdit ? 'Data berhasil diperbarui!' : 'Data berhasil ditambahkan!',
                'success'
            );

        } catch (error) {
            console.error("Form submission failed:", error);
            this.showToast(
                error.message || 'Terjadi kesalahan saat menyimpan data',
                'error'
            );
        } finally {
            this.showLoading(false);
        }
    }

    _handleDelete(id) {
        const result = confirm('Anda yakin ingin menghapus data ini?');
        // alert();
        if (result) {
            this.showLoading(true);

            fetch(`${this.config.backendUrl}${this.config.apiUrl}?id=${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${this.config.api_token}`,
                    'apps': btoa(JSON.stringify(this.config.page.load)),
                    'id_delete': `${id}`
                },
                data: {
                    'id_delete': `${id}`
                }
            })
                .then(response => {
                    if (response.ok) {
                        this.data.data.row = this.data.data.row.filter(item => item.id != id);
                        this.table.clear().rows.add(this.data.data.row).draw();
                        this.showToast('Data berhasil dihapus.');
                    } else {
                        throw new Error('Gagal menghapus data');
                    }
                })
                .catch(error => {
                    console.error("Delete failed:", error);
                    this.showToast('Gagal menghapus data.', 'error');
                })
                .finally(() => {
                    this.showLoading(false);
                });
        }
    }

    _handleApprove(id) {
        // Implementation for approval
        console.log('Approve item with ID:', id);
    }

    _handleBulkEdit() {
        // Implementation for bulk edit
        console.log('Bulk edit selected items:', this.selectedRows);
    }

    _handleBulkDelete() {
        // Implementation for bulk delete
        if (confirm(`Anda yakin ingin menghapus ${this.selectedRows.length} data?`)) {
            console.log('Bulk delete selected items:', this.selectedRows);
        }
    }

    _handleBulkApprove() {
        // Implementation for bulk approve
        console.log('Bulk approve selected items:', this.selectedRows);
    }

    _applyFilters() {
        if (this.table && this.table.serverSide) {
            // Untuk server-side, reload data dengan filter baru
            this.table.ajax.reload();
        } else {
            // Untuk client-side, render ulang view
            this.renderCurrentView();
        }
    }

    showLoading(show) {
        const overlay = document.getElementById('loadingOverlay');
        if (overlay) {
            overlay.style.display = show ? 'flex' : 'none';
        }
    }

    showToast(message, icon = 'success') {
        // Simple toast implementation
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${icon === 'success' ? 'success' : 'danger'} border-0`;
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        // Remove toast after it's hidden
        toast.addEventListener('hidden.bs.toast', () => {
            document.body.removeChild(toast);
        });
    }

    showSuccessMessage(message) {
        this.showToast(message, 'success');
    }
    async _refactorConfigArray() {
        // Simulasi objek fai (harus disesuaikan dengan implementasi sebenarnya)
        const fai = {
            input: (key) => {
                // Implementasi untuk mendapatkan input value
                // Ini contoh sederhana, sesuaikan dengan kebutuhan
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(key);
            }
        };

        if (!this.config.page.crud || !this.config.page.crud.array) {
            console.warn('No CRUD array configuration found');
            return;
        }

        // Process each field in the array
        for (let i = 0; i < this.config.page.crud.array.length; i++) {
            const fieldConfig = this.config.page.crud.array[i];

            // Default values jika tidak ada
            const field = fieldConfig[1] || '';
            const type = fieldConfig[2] || 'text';
            const extype = type; // extype sama dengan type awal

            try {
                const result = await this.refactorCrudArrayConfig(
                    fai,
                    this.config.page,
                    { array: this.config.page.crud.array },
                    i,
                    field,
                    type,
                    extype
                );

                // Update config dengan hasil refactor
                this.config.page = result.page;
                this.config.page.crud.array = result.arrayConfig.array;
            } catch (error) {
                console.error(`Error processing field ${i} (${field}):`, error);
            }
        }

        // Process sub_kategori jika ada
        if (this.config.page.crud.sub_kategori && this.config.page.crud.array_sub_kategori) {
            for (let subIndex = 0; subIndex < this.config.page.crud.sub_kategori.length; subIndex++) {
                const subKategori = this.config.page.crud.sub_kategori[subIndex];
                const subArray = this.config.page.crud.array_sub_kategori[subIndex];

                if (subArray && Array.isArray(subArray)) {
                    for (let i = 0; i < subArray.length; i++) {
                        const fieldConfig = subArray[i];

                        const field = fieldConfig[1] || '';
                        const type = fieldConfig[2] || 'text';
                        const extype = type;

                        try {
                            const result = await this.refactorCrudArrayConfig(
                                fai,
                                this.config.page,
                                { array: subArray },
                                i,
                                field,
                                type,
                                extype
                            );

                            // Update sub array dengan hasil refactor
                            //this.config.page.crud.array_sub_kategori[subIndex] = result.arrayConfig.array;
                            this.config.page = result.page;
                        } catch (error) {
                            console.error(`Error processing sub category field ${subIndex}-${i} (${field}):`, error);
                        }
                    }
                }
            }
        }
    }
    async refactorCrudArrayConfig(fai, page, arrayConfig, i, field, type, extype) {
        // Inisialisasi nilai default
        if (arrayConfig.array && arrayConfig.array[i] && arrayConfig.array[i][1]) {
            arrayConfig.array[i][1] = String(arrayConfig.array[i][1]).toLowerCase().trim().replace('.', '');
        }

        field = arrayConfig.array[i][1] || '';
        type = arrayConfig.array[i][2] || 'text';
        let text = arrayConfig.array[i][0] || '';
        const extypearray = type.split('-');
        const type_temp = type;
        let visible = true;
        let required = false;

        // Jika text kosong, buat dari field
        if (!text && field) {
            arrayConfig.array[i][0] = field.replace(/_/g, ' ')
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
            text = arrayConfig.array[i][0];
        }

        // Jika field kosong, buat dari text
        if (!field && text) {
            arrayConfig.array[i][1] = text.toLowerCase().replace(/\s+/g, '_');
            field = arrayConfig.array[i][1];
        }

        // Set view default jika belum ada
        if (!page.crud.view && page.load && page.load.type) {
            page.crud.view = page.load.type;
        } else if (!page.crud.view) {
            page.crud.view = 'list'; // Default value
        }

        // Proses tipe extended
        if (extypearray.length > 1) {
            if (extypearray.includes('relation')) {
                type = type.replace('-relation', '');
                visible = (page.crud.view === 'view' || fai.input('_view') === 'view');
            } else if (extypearray.includes('hidden_input')) {
                visible = !(page.crud.view === 'list' || fai.input('_view') === 'list');
            } else if (extypearray.includes('table')) {
                type = type.replace('-table', '');
                visible = (page.crud.view === 'list' || fai.input('_view') === 'list');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('appr')) {
                visible = (page.crud.view === 'list' || page.crud.view === 'appr' ||
                    fai.input('_view') === 'list' || fai.input('_view') === 'appr');
            } else if (extypearray.includes('editview')) {
                type = type.replace('-editview', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('crud')) {
                type = type.replace('-crud', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('list')) {
                type = type.replace('-list', '');
                visible = !(page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('listeditview')) {
                type = type.replace('-list', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'list' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'list');
                arrayConfig.array[i][2] = type;
            } else if (type === 'editor-code') {
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
            } else if (extypearray.includes('edit')) {
                type = type.replace('-edit', '');
                visible = (page.crud.view === 'edit' || fai.input('_view') === 'edit');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('tambah')) {
                type = type.replace('-tambah', '');
                visible = (page.crud.view === 'tambah' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('password')) {
                visible = (page.crud.view === 'tambah' || page.crud.view === 'edit' ||
                    fai.input('_view') === 'tambah' || fai.input('_view') === 'edit');
            } else if (extypearray.includes('hidden')) {
                visible = (page.crud.view === 'tambah' || fai.input('_view') === 'tambah');
            } else {
                visible = true;
            }
            // Tetap pertahankan semua logika processing flags
        }

        // Cek non_view settings
        const currentView = page.crud.view;
        if (page.non_view) {
            if ((currentView === 'list' || fai.input('_view') === 'list') && page.non_view.list && page.non_view.list[field]) {
                visible = false;
            } else if ((currentView === 'tambah' || fai.input('_view') === 'tambah') && page.non_view.Tambah && page.non_view.Tambah[field]) {
                visible = false;
            } else if ((currentView === 'edit' || fai.input('_view') === 'edit') && page.non_view.Edit && page.non_view.Edit[field]) {
                visible = false;
            } else if ((currentView === 'hapus' || fai.input('_view') === 'hapus') && page.non_view.Hapus && page.non_view.Hapus[field]) {
                visible = false;
            }
        }
        if (type === 'select-manual-value') {
            const arrray_manual = arrayConfig.array[i][3];
            const array_set = {};

            for (const key_manual in arrray_manual) {
                if (arrray_manual.hasOwnProperty(key_manual)) {
                    const value_manual = arrray_manual[key_manual];
                    array_set[value_manual] = ucwords(value_manual);
                }
            }

            arrayConfig.array[i][3] = array_set;
            type = arrayConfig.array[i][2] = "select-manual";
        }

        // Proses required flag
        if (extypearray.includes('req')) {
            if (page.crud.crud_inline && page.crud.crud_inline[arrayConfig.array[i][2]]) {
                page.crud.crud_inline[arrayConfig.array[i][2]] += " required ";
            } else {
                if (!page.crud.crud_inline) page.crud.crud_inline = {};
                page.crud.crud_inline[arrayConfig.array[i][2]] = " required ";
            }

            type = arrayConfig.array[i][2] = type.replace("-req", "");
            required = true;
        }

        // Proses currency flag
        if (extypearray.includes('cur')) {
            if (!page.crud.input_group) page.crud.input_group = {};
            if (!page.crud.input_group.prefix) page.crud.input_group.prefix = {};
            page.crud.input_group.prefix[field] = "Rp. ";
            type = arrayConfig.array[i][2] = type.replace("-cur", "");
        }

        // Proses percentage flag
        if (extypearray.includes('persen')) {
            if (!page.crud.input_group) page.crud.input_group = {};
            if (!page.crud.input_group.sufix) page.crud.input_group.sufix = {};
            page.crud.input_group.sufix[field] = "%";
            type = arrayConfig.array[i][2] = type.replace("-persen", "");
        }

        // Proses disable flag
        if (extypearray.includes('disable')) {
            if (page.crud.crud_inline && page.crud.crud_inline[arrayConfig.array[i][2]]) {
                page.crud.crud_inline[arrayConfig.array[i][2]] += " disabled ";
            } else {
                if (!page.crud.crud_inline) page.crud.crud_inline = {};
                page.crud.crud_inline[arrayConfig.array[i][2]] = " disabled ";
            }

            type = arrayConfig.array[i][2] = type.replace("-disable", "");
        }

        // Proses kode flag (auto numbering)
        if (extypearray.includes('kode')) {
            if (!page.crud.insert_number_code) page.crud.insert_number_code = {};
            page.crud.insert_number_code[field] = page.crud.insert_number_code[field] || {};

            const configOptions = arrayConfig.array[i][3] || {};
            page.crud.insert_number_code[field].prefix = configOptions.prefix || '';

            if (configOptions.array === 'one') {
                page.crud.insert_number_code[field].root = page.crud.insert_number_code[field].root || {};
                page.crud.insert_number_code[field].root.type = [configOptions.tipe];
                page.crud.insert_number_code[field].root.sprintf = [true];
                page.crud.insert_number_code[field].root.sprintf_number = [configOptions.sprintf_number];

                if (configOptions['parent-separator']) {
                    page.crud.insert_number_code[field]['parent-separator'] = configOptions['parent-separator'];
                }

                if (configOptions['data-parent']) {
                    page.crud.insert_number_code[field]['data-parent'] = configOptions['data-parent'];

                    if (!page.crud.crud_inline) page.crud.crud_inline = {};

                    const parentField = configOptions['data-parent'];
                    let inputInline = page.crud.crud_inline[parentField] || '';

                    if (inputInline.includes('onchange=')) {
                        inputInline = inputInline.replace('onchange="', `onchange="insert_number_code_${field}('<NUMBERING></NUMBERING>');`);
                    } else {
                        inputInline += ` onchange="insert_number_code_${field}('<NUMBERING></NUMBERING>')"`;
                    }

                    if (inputInline.includes('onclick=')) {
                        inputInline = inputInline.replace('onclick="', `onclick="insert_number_code_${field}('<NUMBERING></NUMBERING>');`);
                    } else {
                        inputInline += ` onclick="insert_number_code_${field}('<NUMBERING></NUMBERING>')"`;
                    }

                    page.crud.crud_inline[parentField] = inputInline;
                }
            }

            page.crud.insert_number_code[field].suffix = configOptions.suffix || '';
            type = arrayConfig.array[i][2] = type.replace("-disable", "");
        }

        // Proses flags lainnya
        if (extypearray.includes('en')) {
            type = arrayConfig.array[i][2] = type.replace("-en", "");
        }

        if (extypearray.includes('number')) {
            type = type.replace("-number", "");
        }

        if (extypearray.includes('right')) {
            type = type.replace("-right", "");
        }

        if (extypearray.includes('nonselect2')) {
            // data['nonselect2'] = true;
            type = type.replace("-nonselect2", "");
        }

        // Simpan data konfigurasi
        if (!page.crud.data) page.crud.data = {};
        page.crud.data[field] = {
            visible: visible,
            type: type,
            required: required,
            type_form_asal: type_temp,
            is_number: extypearray.includes('number'),
            is_right: extypearray.includes('right'),
            enskripsi: extypearray.includes('en')
        };

        // Simpan data konfigurasi
        if (!page.crud.data) page.crud.data = {};
        page.crud.data[field] = {
            visible: visible,
            type: type,
            required: required,
            type_form_asal: type_temp,
            is_number: extypearray.includes('number'),
            is_right: extypearray.includes('right'),
            enskripsi: extypearray.includes('en')
        };

        return {
            page: page,
            arrayConfig: arrayConfig,
            field: field,
            type: type
        };
    }
    refactorCrudArrayConfig2(fai, page, arrayConfig, i, field, type, extype) {
        // Inisialisasi nilai default
        arrayConfig.array[i][1] = strtolower(trim(str_replace('.', '', arrayConfig.array[i][1]))) + '';

        field = arrayConfig.array[i][1];
        type = arrayConfig.array[i][2];
        let text = arrayConfig.array[i][0];
        const extypearray = type.split('-');
        const database_utama = page.crud.database_utama;
        const type_temp = type;
        let select = [];
        let join = [];
        let visible = true;
        let get_select = true;
        let required = false;
        const is_master = page.database && page.database.is_array;

        // Jika text kosong, buat dari field
        if (!text) {
            arrayConfig.array[i][0] = ucwords(str.replace(/_/g, ' ', str.toLowerCase(field)));
            text = arrayConfig.array[i][0];
        }

        // Jika field kosong, buat dari text
        if (!field) {
            arrayConfig.array[i][1] = str.toLowerCase(str.replace(/ /g, '_', str.toLowerCase(text)));
            field = arrayConfig.array[i][1];
        }

        // Cek apakah perlu mendapatkan select
        if (page.load && page.load.database && page.load.database.query && page.load.database.query.select &&
            (type === 'select' || type === 'select-relation')) {
            get_select = true;
        }

        // Set view default
        if (!page.crud.view) {
            page.crud.view = page.load.type;
        }

        // Proses tipe extended
        if (extypearray.length > 1) {
            if (extypearray.includes('relation')) {
                type = type.replace('-relation', '');
                visible = (page.crud.view === 'view' || fai.input('_view') === 'view');
            } else if (extypearray.includes('hidden_input')) {
                visible = !(page.crud.view === 'list' || fai.input('_view') === 'list');
            } else if (extypearray.includes('table')) {
                type = type.replace('-table', '');
                visible = (page.crud.view === 'list' || fai.input('_view') === 'list');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('appr')) {
                visible = (page.crud.view === 'list' || page.crud.view === 'appr' ||
                    fai.input('_view') === 'list' || fai.input('_view') === 'appr');
            } else if (extypearray.includes('editview')) {
                type = type.replace('-editview', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('crud')) {
                type = type.replace('-crud', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('list')) {
                type = type.replace('-list', '');
                visible = !(page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('listeditview')) {
                type = type.replace('-list', '');
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'list' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'list');
                arrayConfig.array[i][2] = type;
            } else if (type === 'editor-code') {
                visible = (page.crud.view === 'edit' || page.crud.view === 'view' || page.crud.view === 'tambah' ||
                    fai.input('_view') === 'edit' || fai.input('_view') === 'view' || fai.input('_view') === 'tambah');
            } else if (extypearray.includes('edit')) {
                type = type.replace('-edit', '');
                visible = (page.crud.view === 'edit' || fai.input('_view') === 'edit');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('tambah')) {
                type = type.replace('-tambah', '');
                visible = (page.crud.view === 'tambah' || fai.input('_view') === 'tambah');
                arrayConfig.array[i][2] = type;
            } else if (extypearray.includes('password')) {
                visible = (page.crud.view === 'tambah' || page.crud.view === 'edit' ||
                    fai.input('_view') === 'tambah' || fai.input('_view') === 'edit');
            } else if (extypearray.includes('hidden')) {
                visible = (page.crud.view === 'tambah' || fai.input('_view') === 'tambah');
            } else {
                visible = true;
            }
        }

        // Cek non_view settings
        if ((page.crud.view === 'list' || fai.input('_view') === 'list') && page.non_view && page.non_view.list && page.non_view.list[field]) {
            visible = false;
        } else if ((page.crud.view === 'tambah' || fai.input('_view') === 'tambah') && page.non_view && page.non_view.Tambah && page.non_view.Tambah[field]) {
            visible = false;
        } else if ((page.crud.view === 'edit' || fai.input('_view') === 'edit') && page.non_view && page.non_view.Edit && page.non_view.Edit[field]) {
            visible = false;
        } else if ((page.crud.view === 'hapus' || fai.input('_view') === 'hapus') && page.non_view && page.non_view.Hapus && page.non_view.Hapus[field]) {
            visible = false;
        }

        // Proses select-manual-value
        if (type === 'select-manual-value') {
            const arrray_manual = arrayConfig.array[i][3];
            const array_set = {};

            for (const key_manual in arrray_manual) {
                if (arrray_manual.hasOwnProperty(key_manual)) {
                    const value_manual = arrray_manual[key_manual];
                    array_set[value_manual] = ucwords(value_manual);
                }
            }

            arrayConfig.array[i][3] = array_set;
            type = arrayConfig.array[i][2] = "select-manual";
        }

        // Proses required flag
        if (extypearray.includes('req')) {
            if (page.crud.crud_inline && page.crud.crud_inline[arrayConfig.array[i][2]]) {
                page.crud.crud_inline[arrayConfig.array[i][2]] += " required ";
            } else {
                if (!page.crud.crud_inline) page.crud.crud_inline = {};
                page.crud.crud_inline[arrayConfig.array[i][2]] = " required ";
            }

            type = arrayConfig.array[i][2] = type.replace("-req", "");
            required = true;
        }

        // Proses currency flag
        if (extypearray.includes('cur')) {
            if (!page.crud.input_group) page.crud.input_group = {};
            if (!page.crud.input_group.prefix) page.crud.input_group.prefix = {};
            page.crud.input_group.prefix[field] = "Rp. ";
            type = arrayConfig.array[i][2] = type.replace("-cur", "");
        }

        // Proses percentage flag
        if (extypearray.includes('persen')) {
            if (!page.crud.input_group) page.crud.input_group = {};
            if (!page.crud.input_group.sufix) page.crud.input_group.sufix = {};
            page.crud.input_group.sufix[field] = "%";
            type = arrayConfig.array[i][2] = type.replace("-persen", "");
        }

        // Proses disable flag
        if (extypearray.includes('disable')) {
            if (page.crud.crud_inline && page.crud.crud_inline[arrayConfig.array[i][2]]) {
                page.crud.crud_inline[arrayConfig.array[i][2]] += " disabled ";
            } else {
                if (!page.crud.crud_inline) page.crud.crud_inline = {};
                page.crud.crud_inline[arrayConfig.array[i][2]] = " disabled ";
            }

            type = arrayConfig.array[i][2] = type.replace("-disable", "");
        }

        // Proses kode flag (auto numbering)
        if (extypearray.includes('kode')) {
            if (!page.crud.insert_number_code) page.crud.insert_number_code = {};
            page.crud.insert_number_code[field] = page.crud.insert_number_code[field] || {};

            const configOptions = arrayConfig.array[i][3] || {};
            page.crud.insert_number_code[field].prefix = configOptions.prefix || '';

            if (configOptions.array === 'one') {
                page.crud.insert_number_code[field].root = page.crud.insert_number_code[field].root || {};
                page.crud.insert_number_code[field].root.type = [configOptions.tipe];
                page.crud.insert_number_code[field].root.sprintf = [true];
                page.crud.insert_number_code[field].root.sprintf_number = [configOptions.sprintf_number];

                if (configOptions['parent-separator']) {
                    page.crud.insert_number_code[field]['parent-separator'] = configOptions['parent-separator'];
                }

                if (configOptions['data-parent']) {
                    page.crud.insert_number_code[field]['data-parent'] = configOptions['data-parent'];

                    if (!page.crud.crud_inline) page.crud.crud_inline = {};

                    const parentField = configOptions['data-parent'];
                    let inputInline = page.crud.crud_inline[parentField] || '';

                    if (inputInline.includes('onchange=')) {
                        inputInline = inputInline.replace('onchange="', `onchange="insert_number_code_${field}('<NUMBERING></NUMBERING>');`);
                    } else {
                        inputInline += ` onchange="insert_number_code_${field}('<NUMBERING></NUMBERING>')"`;
                    }

                    if (inputInline.includes('onclick=')) {
                        inputInline = inputInline.replace('onclick="', `onclick="insert_number_code_${field}('<NUMBERING></NUMBERING>');`);
                    } else {
                        inputInline += ` onclick="insert_number_code_${field}('<NUMBERING></NUMBERING>')"`;
                    }

                    page.crud.crud_inline[parentField] = inputInline;
                }
            }

            page.crud.insert_number_code[field].suffix = configOptions.suffix || '';
            type = arrayConfig.array[i][2] = type.replace("-disable", "");
        }

        // Proses flags lainnya
        if (extypearray.includes('en')) {
            type = arrayConfig.array[i][2] = type.replace("-en", "");
        }

        if (extypearray.includes('number')) {
            type = type.replace("-number", "");
        }

        if (extypearray.includes('right')) {
            type = type.replace("-right", "");
        }

        if (extypearray.includes('nonselect2')) {
            // data['nonselect2'] = true;
            type = type.replace("-nonselect2", "");
        }

        // Simpan data konfigurasi
        if (!page.crud.data) page.crud.data = {};
        page.crud.data[field] = {
            visible: visible,
            type: type,
            required: required,
            type_form_asal: type_temp,
            is_number: extypearray.includes('number'),
            is_right: extypearray.includes('right'),
            enskripsi: extypearray.includes('en')
        };

        return {
            page: page,
            arrayConfig: arrayConfig,
            field: field,
            type: type
        };
    }

}