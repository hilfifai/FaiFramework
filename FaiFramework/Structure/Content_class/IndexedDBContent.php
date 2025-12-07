<?php
class IndexedDBContent
{


    public static function barang($page)
    {
        ob_start(); ?>
        <script>
            function debounceBarang(func, delay) {
                let timer;
                return function(...args) {
                    // Hapus timer sebelumnya jika ada
                    clearTimeout(timer);

                    // Set timer baru
                    timer = setTimeout(() => {
                        func.apply(this, args);
                    }, delay);
                };
            }
            const dbName = "MyDatabase";
            const storeName = "barang";

            function openDB() {
                return new Promise((resolve, reject) => {
                    const request = indexedDB.open(dbName, 1);

                    request.onupgradeneeded = function(event) {
                        const db = event.target.result;
                        if (!db.objectStoreNames.contains(storeName)) {
                            db.createObjectStore(storeName);
                        }
                    };

                    request.onsuccess = function(event) {
                        resolve(event.target.result);
                    };

                    request.onerror = function(event) {
                        reject("Database error: " + event.target.error);
                    };
                });
            }

            async function setItemBarang(key) {
                const db = await openDB();
                const transaction = db.transaction(storeName, "readwrite");
                const store = transaction.objectStore(storeName);
                return new Promise((resolve, reject) => {
                    const checkRequest = store.get(key);

                    checkRequest.onsuccess = function() {
                        if (checkRequest.result !== undefined) {

                            console.log(`Item dengan key "${key}" sudah ada, tidak disimpan.`);
                            resolve(false);
                        } else {
                            fetchAndStoreItemDebounced(key);
                            resolve(true)
                        }
                    };


                });

            }

            // async function getItemBarang(key) {
            //     const db = await openDB();
            //     const transaction = db.transaction(storeName, "readonly");
            //     const store = transaction.objectStore(storeName);

            //     // return new Promise((resolve, reject) => {
            //     const request = store.get(key);

            //     // request.onsuccess = () => resolve(request.result);
            //     request.onsuccess = function(event) {
            //         const barang = event.target.result;

            //         if (barang) {
            //             console.log("Barang ditemukan:", barang);

            //             return (barang); // Kembalikan barang jika ditemukan
            //         } else {
            //             console.log("Barang dengan ID", key, "tidak ditemukan.");
            //             fetchAndStoreItem(key);
            //             return (null); // Jika tidak ada, kembalikan null
            //         }
            //     };
            //     request.onerror = (event) => reject("Gagal mengambil data: " + event.target.error);
            //     // });
            // }
            async function getItemBarang(key) {
                try {
                    const db = await openDB();
                    const transaction = db.transaction(storeName, "readonly");
                    const store = transaction.objectStore(storeName);

                    return new Promise((resolve, reject) => {
                        const request = store.get(key);

                        request.onsuccess = function(event) {
                            const barang = event.target.result;
                            if (barang) {
                                console.log(`Barang ditemukan:`, barang);
                                resolve(barang); // Mengembalikan barang jika ditemukan
                            } else {
                                console.warn(`Barang dengan key "${key}" tidak ditemukan.`);
                                fetchAndStoreItemDebounced(key);
                                resolve(null); // Jika tidak ditemukan, kembalikan null
                            }
                        };

                        request.onerror = function(event) {
                            console.error("Gagal mengambil data:", event.target.error);
                            reject(event.target.error);
                        };
                    });
                } catch (error) {
                    console.error("Terjadi kesalahan:", error);
                    throw error;
                }
            }


            function getAllBarang() {
                const transaction = db.transaction([storeName], "readonly");
                const objectStore = transaction.objectStore(storeName);

                const request = objectStore.getAll(); // Mengambil semua data barang
                request.onsuccess = function(event) {
                    const allBarang = event.target.result;
                    console.log("Semua barang:", allBarang);
                    analyzeBarang(allBarang);
                };
                request.onerror = function(event) {
                    console.error("Error fetching all barang", event.target.error);
                };
            }
            async function addBarang(key, data) {
                try {
                    // Buka database
                    const db = await openDB();
                    const transaction = db.transaction(storeName, "readwrite");
                    const store = transaction.objectStore(storeName);

                    // Simpan data ke IndexedDB
                    const putRequest = store.put(data, key);

                    putRequest.onsuccess = function() {
                        console.log(`Item dengan key "${key}" telah disimpan.`);
                    };

                    putRequest.onerror = function(event) {
                        console.error("Gagal menyimpan barang:", event.target.error);
                    };
                } catch (error) {
                    console.error("Terjadi kesalahan:", error);
                }
            }
            const fetchAndStoreItemDebounced = debounceBarang(fetchAndStoreItem, 1000);
            function fetchAndStoreItem(key) {


                // AJAX untuk mengambil data barang dari server
                $.ajax({
                    url: "<?= base_url('/FaiServer/costum/Ecommerce/list_barang_detail/' . $page['load']['id_web__apps']); ?>",
                    type: "GET",
                    data: {
                        id_apps: key
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log("Data barang dari server:", data);
                        alert();
                        addBarang(key, data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data from server:", error);
                    }
                });
            }



            async function getAjaxAddBarang(key) {
                alert(key);
                const db = await openDB();
                const transaction = db.transaction(storeName, "readwrite");
                const store = transaction.objectStore(storeName);
                // Mengambil data barang dari server menggunakan AJAX
                fetch("<?= base_url('/FaiServer/costum/Ecommerce/list_barang_detail/' . $page['load']['id_web__apps']); ?>?id_apps=" + key)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Data barang dari server:", data);
                        const putRequest = store.add(data, key); // `put` akan menimpa jika key sudah ada
                        putRequest.onsuccess = () => {
                            console.log(`Item dengan key "${key}" telah disimpan `);
                            resolve(true);
                        };
                        putRequest.onerror = (event) => reject("Gagal menyimpan: " + event.target.error);
                    })
                    .catch(error => console.error("Error fetching data from server", error));
            }

            function fetchBarangFromServer() {
                // Mengambil data barang dari server menggunakan AJAX
                fetch("url-to-fetch-barang")
                    .then(response => response.json())
                    .then(data => {
                        console.log("Data barang dari server:", data);
                        compareBarang(data);
                    })
                    .catch(error => console.error("Error fetching data from server", error));
            }

            function analyzeBarang(allBarang) {
                fetchBarangFromServer();

                function compareBarang(serverData) {
                    const missingBarang = serverData.filter(serverItem => {
                        return !allBarang.some(storedItem => storedItem.id === serverItem.id);
                    });

                    console.log("Barang yang belum terinput:", missingBarang);
                    // Kamu bisa memutuskan untuk menambahkan barang yang hilang ke IndexedDB
                    missingBarang.forEach(barang => {
                        addBarang(barang); // Menambahkan barang yang belum ada
                    });
                }
            }

            function getAllBarang() {
                const transaction = db.transaction([storeName], "readonly");
                const objectStore = transaction.objectStore(storeName);

                const request = objectStore.getAll(); // Mengambil semua data barang
                request.onsuccess = function(event) {
                    const allBarang = event.target.result;
                    console.log("Semua barang:", allBarang);
                    analyzeBarang(allBarang);
                };
                request.onerror = function(event) {
                    console.error("Error fetching all barang", event.target.error);
                };
            }
        </script>
    <?php
        return ob_get_clean();
    }
    public static function send_barang($page, $id_apps, $array) {}
    public static function orders($page)
    {
        ob_start(); ?>
        <script>
            const STORE_NAME_ORDER = "orders";

            // Fungsi untuk membuka database
            function openDatabase_Orders(callback) {
                const DB_NAME = "MyDatabase";
                const DB_VERSION = 1;
                let request = indexedDB.open(DB_NAME, DB_VERSION);

                request.onupgradeneeded = function(event) {
                    let db = event.target.result;
                    if (!db.objectStoreNames.contains(STORE_NAME_ORDER)) {
                        db.createObjectStore(STORE_NAME_ORDER, {
                            keyPath: "id"
                        });
                    }
                };

                request.onsuccess = function(event) {
                    let db = event.target.result;
                    callback(db);
                };

                request.onerror = function() {
                    console.error("Gagal membuka database.");
                };
            }

            // Fungsi untuk mengambil order berdasarkan id_key
            function getOrder(id_key, callback) {
                openDatabase_Orders(db => {
                    let transaction = db.transaction(STORE_NAME_ORDER, "readonly");
                    let store = transaction.objectStore(STORE_NAME_ORDER);
                    let request = store.get(id_key);

                    request.onsuccess = function(event) {
                        let data = event.target.result;
                        callback(data || null); // Jika tidak ditemukan, kembalikan `null`
                    };

                    request.onerror = function() {
                        console.error("Gagal mengambil order.");
                        callback(null);
                    };
                });
            }

            // Fungsi untuk menambah produk ke dalam order
            function tambahProdukOrder(id_key, produkBaru) {
                openDatabase_Orders(db => {
                    let transaction = db.transaction(STORE_NAME_ORDER, "readwrite");
                    let store = transaction.objectStore(STORE_NAME_ORDER);
                    let request = store.get(id_key);

                    request.onsuccess = function(event) {
                        let order = event.target.result;

                        if (!order) {
                            console.log("Order tidak ditemukan, membuat order baru...");
                            order = {
                                id: id_key,
                                barang: [],
                                payment: {
                                    metode: "Belum dipilih",
                                    status: "Belum dibayar"
                                },
                                pengiriman: {
                                    alamat: "Belum diisi",
                                    kurir: "Belum dipilih",
                                    status: "Belum dikirim"
                                }
                            };
                        }

                        // Tambahkan produk baru ke dalam array barang
                        let produkIndex = order.barang.findIndex(p =>
                            p.id_asset === produkBaru.id_asset &&
                            p.id_produk === produkBaru.id_produk &&
                            p.id_asset_varian === produkBaru.id_asset_varian &&
                            p.id_produk_varian === produkBaru.id_produk_varian &&
                            p.id_varian1 === produkBaru.id_varian1 &&
                            p.id_varian2 === produkBaru.id_varian2 &&
                            p.id_varian3 === produkBaru.id_varian3
                        );

                        if (produkIndex !== -1) {
                            // Produk sudah ada, update qty
                            order.barang[produkIndex].qty = produkBaru.qty;
                            console.log(`Produk sudah ada, qty diperbarui:`, order.barang[produkIndex]);
                        } else {
                            // Produk belum ada, tambahkan produk baru
                            order.barang.push(produkBaru);
                            console.log("Produk baru ditambahkan:", produkBaru);
                        }

                        // Simpan kembali ke IndexedDB
                        let updateRequest = store.put(order);

                        updateRequest.onsuccess = function() {
                            console.log("Order berhasil diperbarui:", order);
                        };

                        updateRequest.onerror = function() {
                            console.error("Gagal menyimpan perubahan.");
                        };
                    };



                    request.onerror = function() {
                        console.error("Gagal mengambil order.");
                    };
                });
            }

            function kosongkanBarang(id_key) {
                openDatabase_Orders(db => {
                    let transaction = db.transaction(STORE_NAME_ORDER, "readwrite");
                    let store = transaction.objectStore(STORE_NAME_ORDER);
                    let request = store.get(id_key);

                    request.onsuccess = function(event) {
                        let order = event.target.result;

                        if (order) {
                            order.barang = []; // Mengosongkan array barang

                            // Simpan kembali ke IndexedDB
                            let updateRequest = store.put(order);

                            updateRequest.onsuccess = function() {
                                console.log(`Barang dalam order ${id_key} berhasil dikosongkan.`);
                            };

                            updateRequest.onerror = function() {
                                console.error("Gagal mengosongkan barang.");
                            };
                        } else {
                            console.log("Order tidak ditemukan.");
                        }
                    };

                    request.onerror = function() {
                        console.error("Gagal mengambil order.");
                    };
                });
            }

            function tampilkanBarang(id_key) {
                openDatabase(db => {
                    let transaction = db.transaction(STORE_NAME, "readonly");
                    let store = transaction.objectStore(STORE_NAME);
                    let request = store.get(id_key);

                    request.onsuccess = function(event) {
                        let order = event.target.result;
                        let tbody = document.querySelector("#barangTable tbody");
                        tbody.innerHTML = ""; // Kosongkan tabel sebelum menampilkan

                        if (order && order.barang.length > 0) {
                            order.barang.forEach((item, index) => {
                                let row = `<tr>
                                <td>${index + 1}</td>
                                <td>${item.nama}</td>
                                <td>Rp ${item.harga.toLocaleString()}</td>
                                <td>${item.qty}</td>
                                <td>Rp ${(item.harga * item.qty).toLocaleString()}</td>
                            </tr>
                            
                            
                            `;

                                row = `<div class="col-md-12  card"  id="store_cart-` + index + 1 + `">
                <div class="row">
                                    <div class="col-2" style="
                                        align-items: center;
                                        justify-content: center;
                                        display: flex;
                                    ">
                                        <label class="form-check">
                                            <input type="checkbox" style="border:1px solid black" name="form-project-manager[]" id="bismillah_beli-` + index + 1 + `" class="form-check-input" value="` + index + 1 + `" onclick="cek_harga(` + index + 1 + `);" ` + item.checked + `>
           
                                          </label>
                                          <div class="cart__close"><a href="javascript:void(0)" class="icon_close"  onclick="delete_cart(` + index + 1 + `)"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a></div>
                                
                                    </div>
                                    <div class="col-3 cart__product__item">
                                         <div style="margin: 10px 0;border-radius: 100%;" id="image_cart-` + index + 1 + `">
                                            ` + item.img + `
                                        </div>
                                    </div>
                                    <div class=" col-7 cart__product__item p-2">
                                        
                                         <input type="hidden" id="is_varian-` + index + 1 + `" value="<IS_VARIAN></IS_VARIAN>">
                                         <input type="hidden" id="max_varian-` + index + 1 + `" value="<MAX_VARIAN></MAX_VARIAN>">
                                        
                                      
                                        <div class="cart__product__item__title">
                                            <h6>` + item.nama_barang + `</h6>
                                            Varian :  <Span id="nama-varian-` + index + 1 + `">` + item.nama_varian + `</span>
                                           <div class="">
                                            <span class="cart__price" id="satuan-harga-` + index + 1 + `">` + item.harga.toLocaleString() + `  </span>
                                            <span class="cart__price" id="diskon-harga-` + index + 1 + `" style="
    text-align: right;
    float: right;
    margin: 0 25px;
">Disc: <TOTAL-DISKON></TOTAL-DISKON></span>
</div>
                                    <div class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" class="form-control" id="set_qty-` + index + 1 + `" value="` + item.qty + `" onkeyup="cek_harga(\'` + index + 1 + `\')" onchange="cek_harga(\'` + index + 1 + `\');">
                                        </div>
                                    </div>
                                    <div class="cart__total"><span id="view-harga-` + index + 1 + `">
                                <HARGA></HARGA>
                            </span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    
                                    </div>
                                </div>
                                <input type="hidden" name="varian_` + index + 1 + `[1]" id="varian-1-` + index + 1 + `" value="` + item.id_varian1 + `>" />
                                <input type="hidden" name="varian_` + index + 1 + `[2]" id="varian-2-` + index + 1 + `" value="` + item.id_varian2 + `" />
                                <input type="hidden" name="varian_` + index + 1 + `[3]" id="varian-3-` + index + 1 + `" value="` + item.id_varian3 + `" />
                              
                                </div>`;;
                                tbody.innerHTML += row;
                            });
                        } else {
                            tbody.innerHTML = `<tr><td colspan="5">Tidak ada barang dalam order.</td></tr>`;
                        }
                    };

                    request.onerror = function() {
                        console.error("Gagal mengambil data order.");
                    };
                });
            }
            // Contoh penggunaan fungsi:
            // Ambil order dengan id 2
            getOrder(<?= $page['load']['id']; ?>, function(order) {
                if (order) {
                    console.log("Order ditemukan:", order);
                } else {
                    console.log("Order tidak ditemukan.");
                }
            });

            // Tambahkan produk baru ke order dengan id 2
        </script>

<?php
        return ob_get_clean();
    }
}
