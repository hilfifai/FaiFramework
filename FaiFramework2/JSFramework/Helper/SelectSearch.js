// ==============================================
// SELECTSEARCH.JS - ES Module Version
// ==============================================

// Class utama SelectSearch
class SelectSearchClass {
    constructor(element, options = {}) {
        // Validasi element
        if (!element || !(element instanceof HTMLElement)) {
            console.error('Element tidak valid atau tidak ditemukan');
            throw new Error('Element tidak valid');
        }

        this.element = element;
        this.options = {
            placeholder: 'Select...',
            searchable: true,
            multiple: false,
            data: [],
            api: null,
            allowClear: false,
            width: '100%',
            minSearchLength: 0,
            debounceTime: 300,
            onChange: null,
            ...options
        };

        this.selectedValues = new Map();
        this.isOpen = false;
        this.data = [];
        this.allData = [];
        this.isLoading = false;
        this.lastSearch = '';
        this.debounceTimer = null;

        this.init();
    }

    init() {
        try {
            // Simpan referensi ke select asli
            this.originalSelect = this.element;

            // Validasi element parent
            if (!this.originalSelect.parentNode) {
                console.error('Element tidak memiliki parent node');
                return;
            }

            // Simpan original styles untuk backup
            this.originalDisplay = this.originalSelect.style.display;
            this.originalSelect.style.display = 'none';

            // Buat container custom select
            this.createCustomSelect();

            // Load data awal
            this.loadInitialData();

            // Tambahkan event listeners
            this.addEventListeners();

            console.log('SelectSearch berhasil diinisialisasi untuk element:', this.element.id);
        } catch (error) {
            console.error('Error saat inisialisasi SelectSearch:', error);
            // Fallback: tampilkan select asli jika gagal
            if (this.originalSelect) {
                this.originalSelect.style.display = this.originalDisplay || '';
            }
        }
    }


    createCustomSelect() {
        try {
            // Buat wrapper
            this.wrapper = document.createElement('div');
            this.wrapper.className = 'select-search-container';
            this.wrapper.style.width = this.options.width;

            // Generate unique ID untuk wrapper jika belum ada
            if (!this.wrapper.id) {
                this.wrapper.id = `select-search-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            }

            // Sisipkan wrapper setelah select asli
            if (this.originalSelect && this.originalSelect.parentNode) {
                this.originalSelect.parentNode.insertBefore(this.wrapper, this.originalSelect.nextSibling);
            } else {
                throw new Error('Tidak dapat menemukan parent element');
            }

            // Buat custom select box
            this.createSelectBox();

            // Buat dropdown container
            this.createDropdown();

        } catch (error) {
            console.error('Error saat membuat custom select:', error);
            throw error;
        }
    }

    createSelectBox() {
        this.selectBox = document.createElement('div');
        this.selectBox.className = 'select-search-box';
        this.selectBox.innerHTML = `
            <span class="select-search-placeholder">${this.options.placeholder}</span>
            <span class="select-search-arrow">▼</span>
        `;
        this.wrapper.appendChild(this.selectBox);

        // Buat container untuk selected tags jika multiple
        if (this.options.multiple) {
            this.selectedTagsContainer = document.createElement('div');
            this.selectedTagsContainer.className = 'select-search-tags';
            this.selectBox.appendChild(this.selectedTagsContainer);
        }

        // Tambahkan clear button jika allowClear
        if (this.options.allowClear) {
            this.clearButton = document.createElement('span');
            this.clearButton.className = 'select-search-clear';
            this.clearButton.innerHTML = '&times;';
            this.clearButton.addEventListener('click', (e) => {
                e.stopPropagation();
                this.clear();
            });
            this.selectBox.appendChild(this.clearButton);
        }
    }

    createDropdown() {
        this.dropdown = document.createElement('div');
        this.dropdown.className = 'select-search-dropdown';

        // Tambahkan search input jika searchable
        if (this.options.searchable) {
            this.searchInput = document.createElement('input');
            this.searchInput.type = 'text';
            this.searchInput.className = 'select-search-input';
            this.searchInput.placeholder = 'Type to search...';
            this.searchInput.autocomplete = 'off';
            this.dropdown.appendChild(this.searchInput);
        }

        // Buat list untuk options
        this.optionsList = document.createElement('ul');
        this.optionsList.className = 'select-search-options';
        this.dropdown.appendChild(this.optionsList);

        // Info container
        this.infoContainer = document.createElement('div');
        this.infoContainer.className = 'select-search-info';
        this.dropdown.appendChild(this.infoContainer);

        this.wrapper.appendChild(this.dropdown);
    }

    async loadInitialData() {
        try {
            // Jika ada data langsung
            if (this.options.data && this.options.data.length > 0) {
                this.allData = this.options.data;
                this.data = [...this.allData];
                this.renderOptions();
            }
            // Jika menggunakan API
            else if (this.options.api) {
                await this.fetchData();
            }
            // Jika menggunakan options dari select element
            else {
                this.loadFromSelectElement();
            }

            // Set nilai awal dari select element
            this.setInitialValues();

            // Update info
            this.updateInfo();
        } catch (error) {
            console.error('Error saat memuat data awal:', error);
            this.showMessage('Error loading data', 'error');
        }
    }

    loadFromSelectElement() {
        try {
            const options = this.originalSelect.querySelectorAll('option');
            this.allData = Array.from(options).map(option => ({
                id: option.value,
                text: option.textContent || option.value,
                disabled: option.disabled,
                element: option
            }));
            this.data = this.allData.filter(item => !item.disabled);
            this.renderOptions();
        } catch (error) {
            console.error('Error saat memuat data dari select element:', error);
        }
    }

    async fetchData(search = '', isSearch = false) {
        if (!this.options.api) return;

        const searchTerm = search.trim();

        // Validasi min search length
        if (isSearch && searchTerm.length < this.options.minSearchLength) {
            if (searchTerm.length === 0) {
                // Jika search kosong, reset ke data awal
                if (this.allData.length > 0) {
                    this.data = [...this.allData];
                    this.renderOptions();
                } else {
                    await this.fetchInitialData();
                }
            } else {
                this.showMessage(`Type at least ${this.options.minSearchLength} characters`, 'info');
            }
            return;
        }

        this.isLoading = true;
        this.showLoading();

        try {
            let url = this.options.api.url;
            const params = new URLSearchParams();

            // Tambahkan search parameter jika ada
            if (searchTerm && this.options.api.searchParam) {
                params.append(this.options.api.searchParam, searchTerm);
            }

            // Tambahkan limit jika ada
            if (this.options.api.field) {
                params.append('field', this.options.api.field);
            }
            if (this.options.api.db) {
                params.append('db', this.options.api.db);
            }
            if (this.options.api.limit) {
                params.append('_limit', this.options.api.limit);
            }

            // Tambahkan pagination jika ada
            if (this.options.api.page && this.options.api.perPage) {
                params.append('_page', this.options.api.page);
                params.append('_per_page', this.options.api.perPage);
            }

            // Tambahkan custom params jika ada
            if (this.options.api.params) {
                Object.entries(this.options.api.params).forEach(([key, value]) => {
                    params.append(key, value);
                });
            }

            // Append params to URL
            if (params.toString()) {
                url += (url.includes('?') ? '&' : '?') + params.toString();
            }

            // Tambahkan headers jika ada
            const headers = {
                'Content-Type': 'application/json',
                ...this.options.api.headers
            };

            const response = await fetch(url, {
                method: this.options.api.method || 'GET',
                headers: headers,
                credentials: this.options.api.credentials || 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const responseData = await response.json();

            // Map response ke format yang diharapkan
            let data = responseData;
            if (this.options.api.mapResponse && typeof this.options.api.mapResponse === 'function') {
                data = this.options.api.mapResponse(responseData, isSearch);
            }
            console.log('Fetched data:', data);

            if (isSearch) {
                this.data = data;
            } else {
                this.allData = data;
                this.data = [...data];
            }

            this.renderOptions();
            this.updateInfo();
        } catch (error) {
            console.error('Error fetching data:', error);
            this.showMessage('Failed to load data', 'error');
        } finally {
            this.isLoading = false;
            this.renderOptions();
            this.updateInfo();
        }
    }

    async fetchInitialData() {
        await this.fetchData('', false);
    }

    setInitialValues() {
        if (this.options.multiple) {
            const selectedOptions = this.originalSelect.querySelectorAll('option:checked');
            selectedOptions.forEach(option => {
                if (option.value) {
                    this.selectValue(option.value, option.textContent, false);
                }
            });
        } else {
            const selectedOption = this.originalSelect.querySelector('option:checked');
            if (selectedOption && selectedOption.value) {
                this.selectValue(selectedOption.value, selectedOption.textContent, false);
            }
        }

        this.updateDisplay();
    }

    renderOptions() {
        if (!this.optionsList) return;

        this.optionsList.innerHTML = '';

        if (this.isLoading) {
            const loadingItem = document.createElement('li');
            loadingItem.className = 'select-search-loading';
            loadingItem.textContent = 'Loading...';
            this.optionsList.appendChild(loadingItem);
            return;
        }
        console.log('Rendering options:', this.data);
        if (this.data.length === 0) {
            const noResults = document.createElement('li');
            noResults.className = 'select-search-no-results';
            noResults.textContent = this.searchInput && this.searchInput.value
                ? 'No results found'
                : 'No options available';
            this.optionsList.appendChild(noResults);
            return;
        }

        this.data.forEach(item => {
            const optionItem = document.createElement('li');
            optionItem.className = 'select-search-option';
            optionItem.dataset.value = item.id;

            if (item.disabled) {
                optionItem.classList.add('disabled');
            }

            // Highlight teks jika ada pencarian
            let displayText = item.text;
            if (this.searchInput && this.searchInput.value) {
                displayText = this.highlightText(item.text, this.searchInput.value);
            }

            optionItem.innerHTML = displayText;

            if (this.selectedValues.has(item.id.toString())) {
                optionItem.classList.add('selected');
            }

            if (!item.disabled) {
                optionItem.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.selectValue(item.id, item.text, true);
                    if (!this.options.multiple) {
                        this.closeDropdown();
                    }
                });
            }

            this.optionsList.appendChild(optionItem);
        });
    }

    highlightText(text, search) {
        if (!search || !text) return text;

        try {
            const escapedSearch = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp(`(${escapedSearch})`, 'gi');
            return text.replace(regex, '<mark class="select-search-highlight">$1</mark>');
        } catch (e) {
            return text;
        }
    }

    selectValue(value, text, updateOriginal = true) {
        const valueStr = value.toString();

        if (this.options.multiple) {
            if (this.selectedValues.has(valueStr)) {
                this.selectedValues.delete(valueStr);
            } else {
                this.selectedValues.set(valueStr, text);
            }
        } else {
            this.selectedValues.clear();
            this.selectedValues.set(valueStr, text);
        }

        if (updateOriginal) {
            this.updateOriginalSelect();
        }

        this.updateDisplay();
        this.renderOptions();
        this.updateInfo();

        // Trigger change event
        this.triggerChangeEvent();
    }

    updateOriginalSelect() {
        if (this.options.multiple) {
            // Update semua option
            const options = this.originalSelect.querySelectorAll('option');
            options.forEach(option => {
                option.selected = this.selectedValues.has(option.value);
            });
        } else {
            // Set nilai single select
            const selectedValue = Array.from(this.selectedValues.keys())[0];
            const option = this.originalSelect.querySelector(`option[value="${selectedValue}"]`);
            if (option) {
                option.selected = true;
            }
        }

        // Trigger change event pada select asli
        const event = new Event('change', { bubbles: true });
        this.originalSelect.dispatchEvent(event);
    }

    updateDisplay() {
        if (this.options.multiple) {
            this.updateSelectedTags();

            if (this.selectedValues.size > 0) {
                this.selectBox.querySelector('.select-search-placeholder').style.display = 'none';
            } else {
                this.selectBox.querySelector('.select-search-placeholder').style.display = 'inline';
                this.selectBox.querySelector('.select-search-placeholder').textContent = this.options.placeholder;
            }
        } else {
            if (this.selectedValues.size > 0) {
                const text = Array.from(this.selectedValues.values())[0];
                this.selectBox.querySelector('.select-search-placeholder').textContent = text;
                this.selectBox.querySelector('.select-search-placeholder').classList.add('has-value');
            } else {
                this.selectBox.querySelector('.select-search-placeholder').textContent = this.options.placeholder;
                this.selectBox.querySelector('.select-search-placeholder').classList.remove('has-value');
            }
        }

        // Toggle clear button visibility
        if (this.clearButton) {
            this.clearButton.style.display = this.selectedValues.size > 0 ? 'block' : 'none';
        }
    }

    updateSelectedTags() {
        if (!this.selectedTagsContainer || !this.options.multiple) return;

        this.selectedTagsContainer.innerHTML = '';

        this.selectedValues.forEach((text, value) => {
            const tag = document.createElement('span');
            tag.className = 'select-search-tag';
            tag.innerHTML = `
                ${this.truncateText(text, 20)}
                <span class="select-search-remove-tag" data-value="${value}">&times;</span>
            `;
            this.selectedTagsContainer.appendChild(tag);
        });

        // Tambahkan event listener untuk remove tag
        this.selectedTagsContainer.querySelectorAll('.select-search-remove-tag').forEach(removeBtn => {
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const value = e.target.dataset.value;
                this.selectValue(value, '', true);
            });
        });
    }

    truncateText(text, maxLength) {
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    }
    handleSelectBoxClick(e) {
        e.stopPropagation();
        this.toggleDropdown();
    }

    handleDocumentClick(e) {
        // Jika klik di luar select box dan dropdown, tutup dropdown
        if (!this.selectBox.contains(e.target) && !this.dropdown.contains(e.target)) {
            this.closeDropdown();
        }
    }
    addEventListeners() {
        // Toggle dropdown
         this.handleDocumentClick = this.handleDocumentClick.bind(this);
    this.handleSelectBoxClick = this.handleSelectBoxClick.bind(this);
    
    // Toggle dropdown - gunakan proper function
    this.selectBox.addEventListener('click', this.handleSelectBoxClick);

        // Search input dengan debounce
        if (this.searchInput) {
        this.searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value;
            
            // Clear previous debounce timer
            if (this.debounceTimer) {
                clearTimeout(this.debounceTimer);
            }
            
            // Set new debounce timer
            this.debounceTimer = setTimeout(() => {
                this.handleSearch(searchTerm);
            }, this.options.debounceTime);
        });
        
        // Prevent event propagation
        this.searchInput.addEventListener('click', (e) => {
            e.stopPropagation();
        });
        
        // Handle keydown events
        this.searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeDropdown();
            } else if (e.key === 'Enter' && this.data.length === 1) {
                // Auto-select jika hanya ada satu hasil
                const firstOption = this.data[0];
                if (firstOption) {
                    this.selectValue(firstOption.id, firstOption.text, true);
                    this.closeDropdown();
                }
            }
        });
    }

        // Close dropdown ketika klik di luar
        document.addEventListener('click', this.handleDocumentClick);
    
    // Prevent dropdown close ketika klik di dalam dropdown
    this.dropdown.addEventListener('click', (e) => {
        e.stopPropagation();
    });
    
    // Handle resize
    window.addEventListener('resize', () => {
        if (this.isOpen) {
            this.adjustDropdownPosition();
        }
    });
    }

    handleSearch(searchTerm) {
        this.lastSearch = searchTerm;

        if (this.options.api && this.options.api.searchParam) {
            // Search melalui API
            this.fetchData(searchTerm, true);
        } else {
            // Search dari data lokal
            this.searchLocalData(searchTerm);
        }
    }

    searchLocalData(searchTerm) {
        if (!searchTerm) {
            this.data = [...this.allData];
        } else {
            const searchLower = searchTerm.toLowerCase();
            this.data = this.allData.filter(item =>
                item.text && item.text.toLowerCase().includes(searchLower)
            );
        }
        this.renderOptions();
        this.updateInfo();
    }

    // toggleDropdown() {
    //     if (this.selectBox.classList.contains('disabled')) return;

    //     this.isOpen ? this.closeDropdown() : this.openDropdown();
    // }

    // openDropdown() {
    //     this.isOpen = true;
    //     this.selectBox.classList.add('open');
    //     this.dropdown.classList.add('open');

    //     // Adjust dropdown position
    //     this.adjustDropdownPosition();

    //     // Fokus ke search input jika ada
    //     if (this.searchInput) {
    //         setTimeout(() => {
    //             this.searchInput.focus();
    //             this.searchInput.select();

    //             // Jika menggunakan API dan belum ada data, fetch data awal
    //             if (this.options.api && this.data.length === 0 && !this.isLoading) {
    //                 this.fetchInitialData();
    //             }
    //         }, 100);
    //     }
    // }
    toggleDropdown() {
        if (this.selectBox.classList.contains('disabled')) return;

        // Gunakan setTimeout untuk memastikan rendering selesai
        setTimeout(() => {
            if (this.isOpen) {
                this.closeDropdown();
            } else {
                this.openDropdown();
            }
        }, 0);
    }
    openDropdown() {
        console.log('Opening dropdown...');

        if (this.isOpen) return;

        this.isOpen = true;
        this.selectBox.classList.add('open');
        this.dropdown.classList.add('open');

        // Adjust dropdown position
        this.adjustDropdownPosition();

        // Fokus ke search input jika ada
        if (this.searchInput) {
            setTimeout(() => {
                this.searchInput.focus();
                this.searchInput.select();

                // Jika menggunakan API dan belum ada data, fetch data awal
                if (this.options.api && this.data.length === 0 && !this.isLoading) {
                    this.fetchInitialData();
                }
            }, 100);
        }

        console.log('Dropdown opened:', {
            selectBoxHasOpen: this.selectBox.classList.contains('open'),
            dropdownHasOpen: this.dropdown.classList.contains('open')
        });
    }

    closeDropdown() {
        console.log('Closing dropdown...');

        if (!this.isOpen) return;

        this.isOpen = false;
        this.selectBox.classList.remove('open');
        this.dropdown.classList.remove('open');

        // Clear search input
        if (this.searchInput) {
            this.searchInput.value = '';

            // Reset data ke semua data jika menggunakan data lokal
            if (!this.options.api || !this.options.api.searchParam) {
                this.data = [...this.allData];
                this.renderOptions();
                this.updateInfo();
            }
        }

        console.log('Dropdown closed:', {
            selectBoxHasOpen: this.selectBox.classList.contains('open'),
            dropdownHasOpen: this.dropdown.classList.contains('open')
        });
    }
    // closeDropdown() {
    //     this.isOpen = false;
    //     this.selectBox.classList.remove('open');
    //     this.dropdown.classList.remove('open');

    //     // Clear search input
    //     if (this.searchInput) {
    //         this.searchInput.value = '';

    //         // Reset data ke semua data jika menggunakan data lokal
    //         if (!this.options.api || !this.options.api.searchParam) {
    //             this.data = [...this.allData];
    //             this.renderOptions();
    //             this.updateInfo();
    //         }
    //     }
    // }

    adjustDropdownPosition() {
        // Cek jika dropdown keluar dari viewport bawah
        const dropdownRect = this.dropdown.getBoundingClientRect();
        const viewportHeight = window.innerHeight;

        if (dropdownRect.bottom > viewportHeight) {
            // Ubah posisi dropdown ke atas
            this.dropdown.style.bottom = '100%';
            this.dropdown.style.top = 'auto';
        } else {
            this.dropdown.style.bottom = 'auto';
            this.dropdown.style.top = '100%';
        }
    }

    showLoading() {
        if (this.optionsList) {
            this.optionsList.innerHTML = '<li class="select-search-loading">Loading...</li>';
        }
    }

    showMessage(message, type = 'info') {
        if (this.infoContainer) {
            this.infoContainer.textContent = message;
            this.infoContainer.className = `select-search-info ${type}`;
            this.infoContainer.style.display = 'block';

            // Auto hide setelah 3 detik
            if (type !== 'info') {
                setTimeout(() => {
                    this.infoContainer.style.display = 'none';
                }, 3000);
            }
        }
    }

    updateInfo() {
        if (!this.infoContainer) return;

        let message = '';

        if (this.isLoading) {
            message = 'Loading...';
        } else if (this.data.length === 0) {
            message = this.searchInput && this.searchInput.value
                ? 'No results found'
                : 'No options available';
        } else {
            message = `Showing ${this.data.length} of ${this.allData.length} options`;

            if (this.searchInput && this.searchInput.value) {
                message += ` for "${this.searchInput.value}"`;
            }
        }

        this.infoContainer.textContent = message;
        this.infoContainer.className = 'select-search-info';
        this.infoContainer.style.display = this.data.length > 0 ? 'block' : 'none';
    }

    triggerChangeEvent() {
    const event = new CustomEvent('selectsearch:change', {
        detail: {
            values: this.getValue(),
            instance: this
        },
        bubbles: true
    });
    this.wrapper.dispatchEvent(event);
    
    // Panggil callback onChange jika ada
    if (typeof this.options.onChange === 'function') {
        this.options.onChange(this.getValue(), this.getSelectedText(), this);
    }
}

    // ================= PUBLIC METHODS =================

    getValue() {
        if (this.options.multiple) {
            return Array.from(this.selectedValues.keys());
        } else {
            return Array.from(this.selectedValues.keys())[0] || null;
        }
    }

    getSelectedText() {
        if (this.options.multiple) {
            return Array.from(this.selectedValues.values());
        } else {
            return Array.from(this.selectedValues.values())[0] || null;
        }
    }

    setValue(value) {
        if (this.options.multiple && Array.isArray(value)) {
            this.selectedValues.clear();
            value.forEach(val => {
                const item = this.allData.find(item => item.id.toString() === val.toString());
                if (item) {
                    this.selectedValues.set(val.toString(), item.text);
                }
            });
        } else {
            this.selectedValues.clear();
            const item = this.allData.find(item => item.id.toString() === value.toString());
            if (item) {
                this.selectedValues.set(value.toString(), item.text);
            }
        }

        this.updateOriginalSelect();
        this.updateDisplay();
        this.renderOptions();
        this.triggerChangeEvent();
    }

    clear() {
        this.selectedValues.clear();
        this.updateOriginalSelect();
        this.updateDisplay();
        this.renderOptions();
        this.triggerChangeEvent();
    }

    enable() {
        this.selectBox.classList.remove('disabled');
        this.originalSelect.disabled = false;
    }

    disable() {
        this.selectBox.classList.add('disabled');
        this.originalSelect.disabled = true;
        this.closeDropdown();
    }

    destroy() {
        // Hapus event listeners
        document.removeEventListener('click', this.closeDropdown);
        window.removeEventListener('resize', this.adjustDropdownPosition);

        // Tampilkan kembali select asli
        if (this.originalSelect) {
            this.originalSelect.style.display = this.originalDisplay || '';
        }

        // Hapus custom select dari DOM
        if (this.wrapper && this.wrapper.parentNode) {
            this.wrapper.parentNode.removeChild(this.wrapper);
        }

        // Clear debounce timer
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }
    }

    // Method untuk update data dinamis
    updateData(newData) {
        this.allData = newData;
        this.data = [...newData];
        this.renderOptions();
        this.updateInfo();
    }

    // Method untuk menambah data
    addOption(id, text, position = 'end') {
        const newOption = { id, text };

        if (position === 'start') {
            this.allData.unshift(newOption);
        } else {
            this.allData.push(newOption);
        }

        this.data = [...this.allData];
        this.renderOptions();
        this.updateInfo();
    }

    // Method untuk menghapus option
    removeOption(id) {
        this.allData = this.allData.filter(item => item.id !== id);
        this.data = this.data.filter(item => item.id !== id);
        this.selectedValues.delete(id.toString());
        this.renderOptions();
        this.updateInfo();
        this.updateOriginalSelect();
    }
}

// ==============================================
// PUBLIC API MANAGER
// ==============================================
// 


class SelectSearchManager {
    constructor() {
        // Instance property untuk menyimpan instances
        this.instances = new Map();
    }


    init(element, options = {}) {
        try {
            // Inject CSS jika belum ada
            this.injectCSS();

            let targetElement;
            console.log('Inisialisasi SelectSearch untuk element:', element);

            if (typeof element === 'string') {
                targetElement = document.getElementById(element);
                if (!targetElement) {
                    targetElement = document.querySelector(element);
                }

                if (!targetElement) {
                    console.error(`Element "${element}" tidak ditemukan`);
                    return null;
                }
            } else if (element instanceof HTMLElement) {
                targetElement = element;
            } else {
                console.error('Parameter element tidak valid');
                return null;
            }

            if (!targetElement.id) {
                targetElement.id = `select-search-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            }

            const elementId = targetElement.id;

            // Hapus instance sebelumnya jika ada
            if (this.instances.has(elementId)) {
                this.destroy(elementId);
            }

            // Buat instance baru dari CLASS
            const instance = new SelectSearchClass(targetElement, options);
            this.instances.set(elementId, instance);

            console.log('Instance created:', instance);
            console.log('Total instances:', this.instances.size);

            return instance;
        } catch (error) {
            console.error('Error saat inisialisasi SelectSearch:', error);
            return null;
        }
    }

    getInstance(element) {
        let elementId;

        if (typeof element === 'string') {
            elementId = element;
        } else if (element instanceof HTMLElement) {
            elementId = element.id;
        } else {
            return null;
        }

        return this.instances.get(elementId) || null;
    }

    getValue(element) {
        const instance = this.getInstance(element);
        return instance ? instance.getValue() : null;
    }

    setValue(element, value) {
        const instance = this.getInstance(element);
        if (instance) {
            instance.setValue(value);
        }
    }

    clear(element) {
        const instance = this.getInstance(element);
        if (instance) {
            instance.clear();
        }
    }

    destroy(element) {
        let elementId;

        if (typeof element === 'string') {
            elementId = element;
        } else if (element instanceof HTMLElement) {
            elementId = element.id;
        }

        if (!elementId) return;

        const instance = this.instances.get(elementId);
        if (instance) {
            try {
                instance.destroy();
                this.instances.delete(elementId);
                console.log(`Destroyed instance for: ${elementId}`);
            } catch (error) {
                console.error('Error destroying instance:', error);
            }
        }
    }

    onChange(element, callback) {
        const instance = this.getInstance(element);
        if (instance && instance.wrapper) {
            instance.wrapper.addEventListener('selectsearch:change', (e) => {
                callback(e.detail.values, instance);
            });
        }
    }

    // Helper untuk auto-init
    autoInit(selector = '[data-select-search]') {
        document.querySelectorAll(selector).forEach(element => {
            try {
                const options = {};

                if (element.dataset.placeholder) {
                    options.placeholder = element.dataset.placeholder;
                }

                if (element.dataset.searchable) {
                    options.searchable = element.dataset.searchable === 'true';
                }

                if (element.dataset.multiple) {
                    options.multiple = element.dataset.multiple === 'true';
                }

                if (element.dataset.allowClear) {
                    options.allowClear = element.dataset.allowClear === 'true';
                }

                if (element.dataset.apiUrl) {
                    options.api = {
                        url: element.dataset.apiUrl,
                        limit: parseInt(element.dataset.limit) || 10,
                        searchParam: element.dataset.searchParam || 'q',
                        method: element.dataset.method || 'GET'
                    };
                }

                this.init(element, options);
            } catch (error) {
                console.error('Error saat auto-init untuk element:', element, error);
            }
        });
    }

    // Debug method
    logInstances() {
        console.log('=== SelectSearch Instances ===');
        console.log('Total:', this.instances.size);
        this.instances.forEach((instance, id) => {
            console.log(`- ${id}:`, instance);
        });
    }
    injectCSS() {
        // Cek apakah CSS sudah diinject
        if (document.querySelector('style[data-select-search-css]')) {
            return;
        }

        const css = `
/* SELECT SEARCH CSS */
.select-search-container {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.select-search-box {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background-color: white;
    cursor: pointer;
    user-select: none;
    min-height: 48px;
    position: relative;
    transition: all 0.2s ease;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.select-search-box:hover {
    border-color: #9ca3af;
}

.select-search-box.open {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.select-search-box.disabled {
    background-color: #f3f4f6;
    cursor: not-allowed;
    opacity: 0.6;
}

.select-search-placeholder {
    color: #9ca3af;
    flex-grow: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding-right: 1.5rem;
}

.select-search-placeholder.has-value {
    color: #374151;
}

.select-search-arrow {
    color: #6b7280;
    font-size: 0.75rem;
    transition: transform 0.2s ease;
    flex-shrink: 0;
}

.select-search-box.open .select-search-arrow {
    transform: rotate(180deg);
}

.select-search-clear {
    position: absolute;
    right: 2.5rem;
    color: #9ca3af;
    cursor: pointer;
    font-size: 1.25rem;
    line-height: 1;
    padding: 0.25rem;
    display: none;
    z-index: 1;
}

.select-search-clear:hover {
    color: #ef4444;
}

.select-search-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.375rem;
    flex-grow: 1;
}

.select-search-tag {
    background-color: #dbeafe;
    color: #1e40af;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    max-width: 200px;
}

.select-search-remove-tag {
    cursor: pointer;
    font-size: 1.125rem;
    line-height: 1;
    padding-left: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.select-search-remove-tag:hover {
    color: #dc2626;
}

.select-search-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    z-index: 50;
    max-height: 300px;
    overflow: hidden;
    display: none;
    margin-top: 0.25rem;
}

.select-search-dropdown.open {
    display: block;
}

.select-search-input {
    padding: 0.75rem 1rem;
    border: none;
    border-bottom: 1px solid #e5e7eb;
    width: 100%;
    font-size: 0.875rem;
    outline: none;
    box-sizing: border-box;
}

.select-search-input:focus {
    border-bottom-color: #3b82f6;
}

.select-search-options {
    list-style: none;
    margin: 0;
    padding: 0;
    max-height: 250px;
    overflow-y: auto;
}

.select-search-option {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: background-color 0.15s ease;
    font-size: 0.875rem;
    border-bottom: 1px solid #f3f4f6;
}

.select-search-option:last-child {
    border-bottom: none;
}

.select-search-option:hover {
    background-color: #f3f4f6;
}

.select-search-option.selected {
    background-color: #eff6ff;
    color: #1e40af;
    font-weight: 500;
}

.select-search-option.disabled {
    color: #9ca3af;
    cursor: not-allowed;
    background-color: #f9fafb;
}

.select-search-option.disabled:hover {
    background-color: #f9fafb;
}

.select-search-highlight {
    background-color: #fef3c7;
    font-weight: 600;
    padding: 0 1px;
    border-radius: 2px;
}

.select-search-loading,
.select-search-no-results {
    padding: 1.5rem 1rem;
    text-align: center;
    color: #6b7280;
    font-size: 0.875rem;
}

.select-search-info {
    padding: 0.75rem 1rem;
    border-top: 1px solid #e5e7eb;
    font-size: 0.75rem;
    color: #6b7280;
    background-color: #f9fafb;
    display: none;
}

.select-search-info.error {
    color: #dc2626;
    background-color: #fee2e2;
}

.select-search-info.success {
    color: #059669;
    background-color: #d1fae5;
}

/* Responsive */
@media (max-width: 640px) {
    .select-search-dropdown {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90vw;
        max-width: 400px;
        max-height: 70vh;
    }

    .select-search-tag {
        max-width: 150px;
    }
}
        `;

        const style = document.createElement('style');
        style.setAttribute('data-select-search-css', '');
        style.textContent = css;
        document.head.appendChild(style);
    }

}
export default SelectSearchManager;

// Export class untuk penggunaan langsung (jika diperlukan)
export { SelectSearchClass };

// Export fungsi helper sebagai named exports
export const initSelectSearch = (element, options) => SelectSearchManager.init(element, options);
export const getSelectSearchValue = (element) => SelectSearchManager.getValue(element);
export const setSelectSearchValue = (element, value) => SelectSearchManager.setValue(element, value);
export const clearSelectSearch = (element) => SelectSearchManager.clear(element);
export const destroySelectSearch = (element) => SelectSearchManager.destroy(element);
export const onSelectSearchChange = (element, callback) => SelectSearchManager.onChange(element, callback);