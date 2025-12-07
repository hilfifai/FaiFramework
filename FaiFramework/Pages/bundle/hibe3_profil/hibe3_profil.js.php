<script>
    function editProfileBtn() {
        const viewMode = document.getElementById('view-mode');
        const editMode = document.getElementById('edit-mode');
        // Sembunyikan mode tampilan, tampilkan mode edit
        viewMode.classList.add('hidden');
        editMode.classList.remove('hidden');
    };

    function cancelBtn() {
        const viewMode = document.getElementById('view-mode');
        const editMode = document.getElementById('edit-mode');
        // Sembunyikan mode edit, tampilkan mode tampilan
        editMode.classList.add('hidden');
        viewMode.classList.remove('hidden');
    }

    function profileForm() {
        const viewMode = document.getElementById('view-mode');
        const editMode = document.getElementById('edit-mode');
        e.preventDefault(); // Mencegah form untuk reload halaman

        // === Update Info Pribadi ===
        document.getElementById('view-name').textContent = document.getElementById('edit-name').value;
        document.getElementById('view-email').textContent = document.getElementById('edit-email').value;
        document.getElementById('view-phone').textContent = document.getElementById('edit-phone').value;

        // === Update Daftar Alamat ===
        const viewAddressList = document.getElementById('view-address-list');
        viewAddressList.innerHTML = ''; // Kosongkan daftar alamat yang lama

        const addressForms = editAddressList.querySelectorAll('.address-form-card');

        addressForms.forEach((form, index) => {
            const label = form.querySelector('input[type="text"]').value;
            const detail = form.querySelector('textarea').value;
            const isDefault = form.querySelector('input[type="radio"]').checked;

            const addressCard = document.createElement('div');
            addressCard.className = 'address-card';
            if (isDefault) {
                addressCard.classList.add('default');
            }

            let defaultBadge = isDefault ? '<span class="default-badge">Utama</span>' : '';

            addressCard.innerHTML = `
                <div class="address-card-header">
                    <strong>${label}</strong>
                    ${defaultBadge}
                </div>
                <p>${detail.replace(/\n/g, '<br>')}</p>
            `;
            viewAddressList.appendChild(addressCard);
        });

        // Sembunyikan mode edit, tampilkan kembali mode tampilan
        editMode.classList.add('hidden');
        viewMode.classList.remove('hidden');
    }

    function addAddressBtn() {
        const editAddressList = document.getElementById('edit-address-list');

        // Counter untuk alamat baru
        let addressCounter = editAddressList.children.length;
        addressCounter++;

        const newAddressForm = document.createElement('div');
        newAddressForm.className = 'address-form-card';
        newAddressForm.innerHTML = `
            <div class="form-group">
                <label for="addr-label-${addressCounter}">Label Alamat</label>
                <input class="form-control"class="form-control" type="text" id="addr-label-${addressCounter}" placeholder="Contoh: Apartemen, Kos">
            </div>
            <div class="form-group">
                <label for="addr-detail-${addressCounter}">Alamat Lengkap</label>
                <textarea class="form-control"id="addr-detail-${addressCounter}" rows="3" placeholder="Masukkan alamat lengkap Anda"></textarea>
            </div>
            <div class="form-check">
                <input class="form-control"class="form-control" type="radio" id="addr-default-${addressCounter}" name="default-address">
                <label for="addr-default-${addressCounter}">Jadikan Alamat Utama</label>
            </div>
        `;
        editAddressList.appendChild(newAddressForm);
    }
</script>