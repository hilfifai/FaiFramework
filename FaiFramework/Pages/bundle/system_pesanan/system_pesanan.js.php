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
            getOrder(, function(order) {
                if (order) {
                    console.log("Order ditemukan:", order);
                } else {
                    console.log("Order tidak ditemukan.");
                }
            });

            // Tambahkan produk baru ke order dengan id 2
        </script>


      <script>
          $(".Tabs").each(function (i, tab) {
            var tabRoot = $(this);
            var tabNumber = $(".TabHead").children().length;
            var tabPercentage = parseInt(100 / tabNumber);
            var tabTrigger = ".TabTrigger";
            var tabContent = ".TabContent";
            var findTabTrigger = tabRoot.find(tabTrigger);
            var findTabContent = tabRoot.find(tabContent);
            var currentTab = $(".TabTrigger.__active").index() + 1;
            var tabProgress = currentTab * tabPercentage;
            var progressBar = ".TabProgressBar";

            findTabTrigger.attr("aria-selected", false);
            findTabContent.attr("aria-expanded", false);

            findTabTrigger.eq(0).addClass("__active").attr("aria-selected", true);
            findTabContent.eq(0).addClass("__active").attr("aria-expanded", true);

            findTabTrigger.click(function (e) {
              e.preventDefault();
              var dataSet = $(this).data("set");

              tabRoot
            .find(tabTrigger + ".__active")
            .attr("aria-selected", false)
            .removeClass("__active");
          $(this).attr("aria-selected", true).addClass("__active");

          tabRoot
            .find(tabContent + ".__active")
            .attr("aria-expanded", false)
            .removeClass("__active");
          tabRoot
            .find(tabContent + '[data-set="' + dataSet + '"]')
            .attr("aria-expanded", true)
            .addClass("__active");
        });
       });

        // Progress bar for selected tab
        $(".TabTrigger").click(function () {
          var tabNumber = $(".TabHead").children().length;
          var tabPercentage = parseInt(100 / tabNumber);
          var tabIndex = $(".TabTrigger").index();
          var currentTab = $(".TabTrigger.__active").index();
          var tabProgress = currentTab * tabPercentage;
          var progressBar = ".TabProgressBar";

          $(progressBar).css("width", tabProgress + "%");

          // Marks previous tab as complete
          if (currentTab > tabIndex) {
            $(this).prev().addClass("__complete");
          }
        });

        $("#button-reset").click(function() {
          $(".TabTrigger").removeClass("__complete");
          console.log("button clicked");
        })



        function list_shipping_alamat(){
          id_user =$("#user_id").val();
          if(id_user){
              $.ajax({

                type: "get",
                dataType: "html",
                data: {
                  "first": link_route,
                  "link_route": $("#load_link_route").val(),
                  "frameworksubdomain": $("#load_domain").val(),
                  "apps": "Ecommerce",
                  "page_view": "list_alamat_user",
                  "type": "list_alamat_user",
                  "id": $("#load_id").val(),
                  "id_user":id_user,
                
                
                  "contentfaiframework": "get_pages",
                  "MainAll": 2
                },
                url: link_route,
                dataType: "html",
                success: function (responseData) {
                  $("#content_list_cart").html(responseData);
                  

                }
              });
          }
        }
        function list_cart(){
          id_user =$("#user_id").val()
          if(id_user){
              $.ajax({

                type: "get",
                dataType: "html",
                data: {
                  "first": link_route,
                  "link_route": $("#load_link_route").val(),
                  "frameworksubdomain": $("#load_domain").val(),
                  "apps": "Ecommerce",
                  "page_view": "list_cart",
                  "type": "list_cart",
                  "id": $("#load_id").val(),
                  "id_user":id_user,
                
                
                  "contentfaiframework": "get_pages",
                  "MainAll": 2
                },
                url: link_route,
                dataType: "html",
                success: function (responseData) {
                  $("#content_list_cart").html(responseData);
                  

                }
              });
          }
        }
        
        function add_cart_by_id(id_asset,id_produk,id_asset_varian,id_produk_varian,id_varian1,id_varian2,id_varian3) {
          if ($("#is_login").val() == 0) {
            swal("Gagal!", "Login Terlebih Dahulu", "error");

          } else if (!$("#user_id").val()) {
            swal("Gagal!", "Anda belum memilih custumer", "error");
          
          } else if (parseInt($("#set_qty").val()) > parseInt($("#set_qty").attr("max"))) {
            swal("Gagal!", "QTY Melebihi Stok", "error");

          } else {
            id_user =$("#user_id").val()
            $.ajax({

              type: "get",
              dataType: "html",
              data: {
                "first": link_route,
                "link_route": $("#load_link_route").val(),
                "frameworksubdomain": $("#load_domain").val(),
                "apps": "Ecommerce",
                "page_view": "add_cart",
                "type": "add_cart",
                "id": $("#load_id").val(),
                "id_user":id_user,
                "id_asset":id_asset,
                "id_produk": id_produk,
                "level": $("#level").val(),
                "id_varian_3": id_varian3,
                "id_varian_2": id_varian2,
                "id_varian_1": id_varian1,
                "add_qty": 1,
                "id_produk_varian": id_produk_varian,
                "id_asset_varian": id_asset_varian,
                "contentfaiframework": "get_pages",
                "MainAll": 2
              },
              url: link_route,
              dataType: "json",
              success: function (responseData) {

                if (responseData.status){

                  swal("Sukses!", "Produk sudah masuk kedalam cart!", "success");
                  list_cart();
                  // if($("#stok_barang").length > 0){
                  //   now_stok = $("#stok_barang").val();
                  //   now_stok = parseInt(now_stok);
                  //   now_stok = now_stok-1;
                  //   $("#stok_barang").val(now_stok);
                  // }	
                }
                else
                  swal("Gagal!", "Terdapat Kesalahan Teknis Silahkan Hubungi Costumer Service!", "error");


              }
            });
          }

        }
         

        function getHargaSatuan(hargaList,jumlah) {
            for (let i = 0; i < hargaList.length; i++) {
                if (jumlah >= hargaList[i].min) {
                    return hargaList[i].harga;
                }
            }
            return 0; // Jika tidak ada harga yang sesuai
        }
        function tambah_produk_indexed_db(id_asset,id_produk,id_asset_varian,id_produk_varian,id_varian1,id_varian2,id_varian3,nama,nama_varian,img,harga=0,hargaList,berat) {
          qtyorder = $("#quantity-"+id_asset+"-"+id_produk+"-"+id_asset_varian+"-"+id_produk_varian+"-"+id_varian1+"-"+id_varian2+"-"+id_varian3).val();
          alert("#quantity"+id_asset+"-"+id_produk+"-"+id_asset_varian+"-"+id_produk_varian+"-"+id_varian1+"-"+id_varian2+"-"+id_varian3);
          hargaList = [
            { min: 5, harga: 12000 },
            { min: 3, harga: 15000 },
            { min: 1, harga: 20000 }
        ];
        alert(qtyorder);
          tambahProdukOrder(, {
                id_asset: id_asset,
                id_produk: id_produk,
                id_asset_varian: id_asset_varian,
                id_produk_varian: id_produk_varian,
                id_varian1: id_varian1,
                id_varian2: id_varian2,
                id_varian3: id_varian3,
                qty:qtyorder,
                nama_barang: nama,
                nama_varian:nama_varian,
                img:img,
                harga:harga,
                hargaList:hargaList,
                berat:berat,
                checked:1
                
            });
        }
            function change_tipe_page(){
             var tipe_page= $("#tipe_page").val()
            }
      </script>