<!DOCTYPE html>
<html>

<head>
    <title>Upload Excel via AJAX - CodeIgniter</title>
</head>

<body>
    <h2>Upload Excel File</h2>
    <form id="uploadForm">
        <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" required><br><br>
        <button type="submit">Upload</button>
    </form>
    <!-- f7b44cdb600513f1723aae68ac711fe8.xlsx -->
    <Br>
    <input type="text" name="nama_file" id="nama_file">
    <button onclick="klik_proses_excel()">Generate proses excel</button>
    <button onclick="klik_inisiasi()">Generate Inisasi</button>
    <button onclick="klik_stok('warna')">Generate Stok Warna</button>
    <button onclick="klik_stok('sarimbit')">Generate Stok Sarimbit</button>
    <button onclick="klik_stok('artikel')">Generate Stok Artikel</button>
    <button onclick="klik_stok('barang')">Generate Stok Barang</button>
    <Br>
    Step 1 : Simpan Excel
    <div id="result"></div>
    Step 2 : Proses Excel ke database
    <div id="proses_excel"></div>
    Step 3 : Menginisasi Data
    <div id="inisiasi"></div>
    Step 4 : Generate Stok
    <div></div>
    Step 4.1 : Generate Stok Warna
    <div id="stok_warna"></div>
    Step 4.2 : Generate Stok Sarimbit
    <div id="stok_sarimbit"></div>
    Step 4.3 : Generate Stok Artikel
    <div id="stok_artikel"></div>
    Step 4.4 : Generate Stok Barang
    <div id="stok_barang"></div>
    Step 5 : Download Excel
    <div id="Download Excel"></div>

    <!-- //step 1
        //tambahkan semua ke database temp excel
        //manambahkan jika belum ada tambahkan ke database

        //konfirmasi produk baru

        //step 2
        //menginisasi data -> semua stok menjadi 0
        //menginiasasi data  generate 

        //step 3
        // generate 

        // step 4
        // download excel -->
    <script>
        function klik_proses_excel() {
            proses_excel("", document.getElementById('nama_file').value);
        }

        function klik_inisiasi() {
            inisiasi_data("", document.getElementById('nama_file').value);
        }

        function klik_stok(tipe) {
            generate("", document.getElementById('nama_file').value, tipe);
        }

        function proses_excel(file_path, file_name) {
            var formData = new FormData();
            formData.append("path", file_path);
            formData.append("name", file_name);
            const params = new URLSearchParams();
            formData.forEach((value, key) => {
                params.append(key, value);
            });
            fetch("<?= base_url('index.php/faiCommandTest/shopee_database_excel'); ?>?" + params.toString(), {
                    method: 'get',
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        document.getElementById('proses_excel').innerHTML = `
                                <p style="color:green;">${result.message}</p>
                                
                            `;
                        inisiasi_data(file_path, file_name);
                    } else {
                        document.getElementById('proses_excel').innerHTML = `
                            <p style="color:red;">${result.message}</p>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('proses_excel').innerHTML = 'Terjadi kesalahan.';
                });

        }

        function inisiasi_data(file_path, file_name) {
            var formData = new FormData();
            formData.append("path", file_path);
            formData.append("name", file_name);
            const params = new URLSearchParams();
            formData.forEach((value, key) => {
                params.append(key, value);
            });
            fetch("<?= base_url('index.php/faiCommandTest/shopee_inisiasi_data'); ?>?" + params.toString(), {
                    method: 'get'
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        document.getElementById('inisiasi').innerHTML = `
                            <p style="color:green;">${result.message}</p>
                           
                        `;
                        generate(file_path, file_name, 'warna');
                    } else {
                        document.getElementById('inisiasi').innerHTML = `
                            <p style="color:red;">${result.message}</p>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('inisiasi').innerHTML = 'Terjadi kesalahan.';
                });

        }

        function generate(file_path, file_name, tipe_generate) {
            var formData = new FormData();
            formData.append("path", file_path);
            formData.append("name", file_name);
            formData.append("tipe_generate", tipe_generate);
            const params = new URLSearchParams();
            formData.forEach((value, key) => {
                params.append(key, value);
            });
            fetch("<?= base_url('index.php/faiCommandTest/import_shopee_generete'); ?>?" + params.toString(), {
                    method: 'get'
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        document.getElementById("stok_" + tipe_generate).innerHTML = `
                            <p style="color:green;">${result.message}</p>
                           
                        `;
                        if (!result.sisa) {
                            window.location.href = "<?= base_url('index.php/faiCommandTest/export_excel_from_database'); ?>";
                        } else
                            generate(file_path, file_name, result.next_generate);
                    } else {
                        document.getElementById("stok_" + tipe_generate).innerHTML = `
                            <p style="color:red;">${result.message}</p>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('result').innerHTML = 'Terjadi kesalahan.';
                });

        }
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData();
            var fileInput = document.getElementById('excel_file');
            formData.append("excel_file", fileInput.files[0]);

            fetch("<?= base_url('index.php/faiCommandTest/upload_excel'); ?>", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        document.getElementById('result').innerHTML = `
                            <p style="color:green;">${result.message}</p>
                            <p>File: <a href="${result.file_path}" target="_blank">${result.file_name}</a></p>
                        `;
                        proses_excel(result.file_path, result.file_name);
                    } else {
                        document.getElementById('result').innerHTML = `
                            <p style="color:red;">${result.message}</p>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('result').innerHTML = 'Terjadi kesalahan.';
                });
        });
    </script>
</body>

</html>