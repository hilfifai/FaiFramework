<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url();?>/style.css">
    <title>Admin Dashboard - Version Control</title>
	<style>
	/* ... (Gunakan CSS dari jawaban sebelumnya atau buat CSS kustom) ... */
body { font-family: sans-serif; background-color: #f4f7f6; color: #333; }
.container { max-width: 1000px; margin: 20px auto; padding: 20px; }
.card { background: #fff; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
.form-group input[type="text"], .form-group select, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
.form-group-inline { display: flex; align-items: center; gap: 10px; }
button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
button:hover { background-color: #0056b3; }
.versions-table { width: 100%; border-collapse: collapse; }
.versions-table th, .versions-table td { padding: 12px; border: 1px solid #ddd; text-align: left; }
.versions-table th { background-color: #f2f2f2; }
.action-buttons button { margin-right: 5px; padding: 5px 10px; font-size: 12px; }
.btn-edit { background-color: #ffc107; }
.btn-generate { background-color: #28a745; }
.btn-delete { background-color: #dc3545; }
.modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); }
.modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 700px; border-radius: 8px; }
.close-button { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
	</style>
	
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard - Version Control</h1>

        <div class="card">
            <h2>Buat Versi Baru</h2>
            <form id="create-version-form">
                <div class="form-group">
                    <label for="version_name">Nama Versi (cth: 1.0.0-alpha)</label>
                    <input type="text" id="version_name" name="version_name" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="alpha">Alpha</option>
                        <option value="beta">Beta</option>
                        <option value="production">Production</option>
                    </select>
                </div>
                <div class="form-group-inline">
                    <input type="checkbox" id="encryption_enabled" name="encryption_enabled" value="1">
                    <label for="encryption_enabled">Aktifkan Enkripsi untuk versi ini?</label>
                </div>
                <button type="submit">Buat Versi</button>
            </form>
        </div>

        <h2>Daftar Versi</h2>
        <table class="versions-table">
            <thead>
                <tr>
                    <th>Versi</th>
                    <th>Status</th>
                    <th>Enkripsi</th>
                    <th>Tgl Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="versions-table-body">
                <!-- Data akan diisi oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal untuk Edit Konten -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Edit Konten untuk Versi <span id="modal-version-name"></span></h2>
            <form id="edit-content-form">
                <input type="hidden" id="edit-version-id" name="id">
                <div class="form-group">
                    <label for="app_content">App Content (JSON)</label>
                    <textarea id="app_content" name="app_content" rows="5" placeholder='{"appName": "My App", "themeColor": "#FFFFFF"}'></textarea>
                </div>
                <div class="form-group">
                    <label for="bundle_content">Bundle (HTML/JS/CSS)</label>
                    <textarea id="bundle_content" name="bundle_content" rows="10" placeholder="Letakkan kode HTML, CSS, atau JS di sini..."></textarea>
                </div>
                <div class="form-group">
                    <label for="menu_list_content">Menu List (JSON)</label>
                    <textarea id="menu_list_content" name="menu_list_content" rows="5" placeholder='[{"title": "Home", "url": "/home"}, {"title": "About", "url": "/about"}]'></textarea>
                </div>
                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    
    <script>
	document.addEventListener('DOMContentLoaded', () => {
    const API_URL = '<?=base_url();?>version/';
    const versionsTableBody = document.getElementById('versions-table-body');
    const createForm = document.getElementById('create-version-form');
    
    // Modal elements
    const modal = document.getElementById('edit-modal');
    const closeModalBtn = document.querySelector('.close-button');
    const editForm = document.getElementById('edit-content-form');
    const modalVersionName = document.getElementById('modal-version-name');
    const editVersionId = document.getElementById('edit-version-id');

    // Fungsi utama untuk memuat semua versi
    

    // Event listener untuk form create
    createForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(createForm);
        formData.append('action', 'create_version');

        const response = await fetch(API_URL+"/add_version", { method: 'POST', body: formData });
        const result = await response.json();
        
        if (result.success) {
            alert("Success")
			createForm.reset();
            loadVersions();
			
        }
    });

    // Event listener untuk tombol di tabel (Edit, Generate, Hapus)
    versionsTableBody.addEventListener('click', async (e) => {
        const target = e.target;
        const id = target.dataset.id;

        // Tombol Hapus
        if (target.classList.contains('btn-delete')) {
            if (confirm('Apakah Anda yakin ingin menghapus versi ini? Semua konten terkait akan hilang.')) {
                const formData = new FormData();
                formData.append('action', 'delete_version');
                formData.append('id', id);
                const response = await fetch(API_URL, { method: 'POST', body: formData });
                const result = await response.json();
                alert(result.message);
                loadVersions();
            }
        }

        // Tombol Generate
        if (target.classList.contains('btn-generate')) {
            target.textContent = 'Generating...';
            target.disabled = true;
            const formData = new FormData();
            formData.append('action', 'generate');
            formData.append('id', id);
            const response = await fetch(API_URL+'/generate', { method: 'POST', body: formData });
            const result = await response.json();
            alert("Sukses");
            target.textContent = 'Generate';
            target.disabled = false;
        }

        // Tombol Edit Konten
        if (target.classList.contains('btn-edit')) {
            const name = target.dataset.name;
            modalVersionName.textContent = name;
            editVersionId.value = id;
            
            // Ambil konten yang ada
            const response = await fetch(`${API_URL}get_content&id=${id}`);
            const result = await response.json();
            if (result.success) {
                document.getElementById('app_content').value = result.data.app_content || '';
                document.getElementById('bundle_content').value = result.data.bundle_content || '';
                document.getElementById('menu_list_content').value = result.data.menu_list_content || '';
            }
            
            modal.style.display = 'block';
        }
    });

    // Menutup Modal
    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    window.addEventListener('click', (e) => {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });
    
    // Simpan perubahan konten dari modal
    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(editForm);
        formData.append('action', 'update_content');

        const response = await fetch(API_URL, { method: 'POST', body: formData });
        const result = await response.json();
        
        alert(result.message);
        if (result.success) {
            modal.style.display = 'none';
        }
    });
	const loadVersions = async () => {
        const response = await fetch(`${API_URL}get_versions`);
        const result = await response.json();

        versionsTableBody.innerHTML = ''; // Kosongkan tabel
        if (result.success && result.data) {
            result.data.forEach(version => {
                const row = `
                    <tr>
                        <td>${version.version_name}</td>
                        <td>${version.status}</td>
                        <td>${version.encryption_enabled == 1 ? 'Aktif' : 'Tidak Aktif'}</td>
                        <td>${new Date(version.created_at).toLocaleString('id-ID')}</td>
                        <td class="action-buttons">
                            <button class="btn-edit" data-id="${version.id}" data-name="${version.version_name}">Edit Konten</button>
                            <button class="btn-generate" data-id="${version.id}">Generate</button>
                            <button class="btn-delete" data-id="${version.id}">Hapus</button>
                        </td>
                    </tr>
                `;
                versionsTableBody.innerHTML += row;
            });
        }
    };
    // Muat data saat halaman pertama kali dibuka
    loadVersions();
});
	</script>
</body>
</html>