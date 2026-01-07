
// FUNGSI JAVASCRIPT ASLI (TIDAK DIUBAH AGAR LOGIKA TETAP JALAN)
export function upload_desty() {
    const resultEl = document.getElementById('result');
    const fileInput = document.getElementById('excel_file');

    if (!fileInput || !fileInput.files.length) {
        resultEl.innerHTML = `
            <div style="background:#fee2e2; padding:10px; border-radius:5px; color:#991b1b;">
                Silakan pilih file terlebih dahulu
            </div>
        `;
        return;
    }

    resultEl.innerHTML = "<i>Mengupload file...</i>";

    const formData = new FormData();
    formData.append("excel_file", fileInput.files[0]);

    fetch(window.fai.getModule('base_url') + 'DestyStokManual/upload_excel', {
        method: 'POST',
        body: formData
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('HTTP Error ' + res.status);
        }
        return res.json();
    })
    .then(result => {
        if (result.status === 'success') {
            resultEl.innerHTML = `
                <div style="background:#dcfce7; padding:10px; border-radius:5px; color:#166534;">
                    <b>Sukses!</b> ${result.message}<br>
                    File: 
                    <a href="${result.file_path}" target="_blank">
                        ${result.file_name}
                    </a>
                </div>
            `;

            // Auto fill nama file (jika ada field)
            const namaFile = document.getElementById('nama_file');
            if (namaFile) {
                namaFile.value = result.file_name;
            }

            // Proses lanjutan
            if (typeof proses_excel === 'function') {
                proses_excel(result.file_path, result.file_name);
            }

        } else {
            resultEl.innerHTML = `
                <div style="background:#fee2e2; padding:10px; border-radius:5px; color:#991b1b;">
                    <b>Gagal!</b> ${result.message}
                </div>
            `;
        }
    })
    .catch(err => {
        console.error(err);
        resultEl.innerHTML = `
            <div style="background:#fee2e2; padding:10px; border-radius:5px; color:#991b1b;">
                Terjadi kesalahan saat upload
            </div>
        `;
    });
}
export function klik_proses_excel() {
    // UI Feedback
    $('#proses_excel').html('<i>Sedang memproses...</i>');
    proses_excel("", document.getElementById('nama_file').value);
}

export function klik_inisiasi() {
    $('#inisiasi').html('<i>Sedang menginisiasi...</i>');
    inisiasi_data("", document.getElementById('nama_file').value);
}

export function klik_stok(tipe) {
    $('#stok_' + tipe).html('<i>Sedang generate stok...</i>');
    generate("", document.getElementById('nama_file').value, tipe);
}

export function klik_sync_utama() {
    $('#sync_utama').html('<i>Loading data...</i>');
    $.ajax({
        url: window.fai.getModule('base_url') + 'DestyStokManual/manual_produk_sync_utama',
        type: 'GET',
        success: function (data) {
            $('#sync_utama').html(data);
            $(document).ready(function () {
                $(".js-example-basic-single").select2({
                    width: '100%'
                }); // Tambah width 100% agar responsif
            });
        },
        error: function () {
            $('#sync_utama').html('<span style="color:red">Error memuat data</span>');
        }
    });
}

export function klik_sync_varian() {
    $('#sync_varian').html('<i>Loading data...</i>');
    $.ajax({
        url: window.fai.getModule('base_url') + 'DestyStokManual/manual_produk_sync_varian',
        type: 'GET',
        success: function (data) {
            $('#sync_varian').html(data);
        },
        error: function () {
            $('#sync_varian').html('<span style="color:red">Error memuat data</span>');
        }
    });
}

export function proses_excel(file_path, file_name) {
    var formData = new FormData();
    formData.append("path", file_path);
    formData.append("name", file_name);
    const params = new URLSearchParams();
    formData.forEach((value, key) => {
        params.append(key, value);
    });
    fetch(window.fai.getModule('base_url') + 'DestyStokManual/proses_data_excel_to_database?' + params.toString(), {
        method: 'get',
    })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                document.getElementById('proses_excel').innerHTML = `
                                <span style="color:green; font-weight:bold;">✔ ${result.message}</span>
                            `;
                inisiasi_data(file_path, file_name);
            } else {
                document.getElementById('proses_excel').innerHTML = `
                            <span style="color:red; font-weight:bold;">✖ ${result.message}</span>
                        `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('proses_excel').innerHTML = 'Terjadi kesalahan sistem.';
        });

}

export function klik_inventory() {
    $('#inisiasi_inventaris').html('<i>Sedang memproses...</i>');
    var formData = new FormData();

    fetch(window.fai.getModule('base_url') + 'DestyStokManual/desty_data_to_inventaris', {
        method: 'get'
    })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                document.getElementById('inisiasi_inventaris').innerHTML = `
                            <span style="color:green; font-weight:bold;">✔ ${result.message}</span>
                        `;

            } else {
                document.getElementById('inisiasi_inventaris').innerHTML = `
                            <span style="color:red; font-weight:bold;">✖ ${result.message}</span>
                        `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('inisiasi_inventaris').innerHTML = 'Terjadi kesalahan sistem.';
        });

}

export function inisiasi_data(file_path, file_name) {
    var formData = new FormData();
    formData.append("path", file_path);
    formData.append("name", file_name);
    const params = new URLSearchParams();
    formData.forEach((value, key) => {
        params.append(key, value);
    });
    fetch(window.fai.getModule('base_url') + 'DestyStokManual/proses_inisiasi_generate_data?' + params.toString(), {
        method: 'get'
    })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                document.getElementById('inisiasi').innerHTML = `
                            <span style="color:green; font-weight:bold;">✔ ${result.message}</span>
                        `;
                generate(file_path, file_name, 'warna');
            } else {
                document.getElementById('inisiasi').innerHTML = `
                            <span style="color:red; font-weight:bold;">✖ ${result.message}</span>
                        `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('inisiasi').innerHTML = 'Terjadi kesalahan sistem.';
        });

}

export function generate(file_path, file_name, tipe_generate) {
    var formData = new FormData();
    formData.append("path", file_path);
    formData.append("name", file_name);
    formData.append("tipe_generate", tipe_generate);
    const params = new URLSearchParams();
    formData.forEach((value, key) => {
        params.append(key, value);
    });
    fetch(window.fai.getModule('base_url') + 'DestyStokManual/import_shopee_generete' + params.toString(), {
        method: 'get'
    })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                document.getElementById("stok_" + tipe_generate).innerHTML = `
                            <span style="color:green;">✔ ${result.message} <b>${result.nama_barang}</b></span>
                        `;
                if (!result.sisa) {
                    setTimeout(() => {
                        generate(file_path, file_name, tipe_generate);
                    }, 1234);
                } else {
                    setTimeout(() => {
                        generate(file_path, file_name, tipe_generate);
                    }, 1234);
                }
            } else {
                document.getElementById("stok_" + tipe_generate).innerHTML = `
                            <span style="color:red;">✖ ${result.message} <b>${result.nama_barang}</b></span>
                        `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerHTML = 'Terjadi kesalahan sistem.';
        });

}

// document.getElementById('uploadForm').addEventListener('submit', function (e) {
//     e.preventDefault();
//     // Menambah feedback visual saat upload
//     
// });