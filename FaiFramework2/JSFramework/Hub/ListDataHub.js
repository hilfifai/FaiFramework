import FaiModule from '../FaiModule.js';
export default class ListDataHub extends FaiModule {
  constructor() {
    super();
    this.currentPage = [];
    this.debounceTimer;
    this.searchdata = this.searchdata.bind(this);
    this.prosessearchdata = this.prosessearchdata.bind(this);
    this.appendData = this.appendData.bind(this);
    this.loadMoredata = this.loadMoredata.bind(this);
    this.load_more = this.load_more.bind(this);
    this.initSearchListenersProduk = this.initSearchListenersProduk.bind(this);

    // jika perlu:
  }
  async link_direct(encoded) {

    window.fai.getModule('CorePages').link_direct(encoded);;
  }
  async init_produk(index, search, itemsPerPage) {
    const encoded = btoa(JSON.stringify(search));
    let wrapper = document.querySelector("#wrapper-job-" + index);
    wrapper.dataset.search = encoded;
    wrapper.dataset.itemsPerPage = itemsPerPage;
    wrapper.addEventListener("scroll", (e) => {
      e.target.scrollTop > 30 ?
        header.classList.add("header-shadow") :
        header.classList.remove("header-shadow");
    });
    this.initSearchListenersProduk(index);
    // const toggleButton = document.querySelector(".dark-light");

    // toggleButton.addEventListener("click", () => {
    //     document.body.classList.toggle("dark-mode");
    // });
    // logo.addEventListener("click", () => {
    //     wrapper.classList.remove("detail-page");
    //     wrapper.scrollTop = 0;
    //     jobBg.style.background = bg;
    // });
    // alert(type);
  }
  async closeproduk() {

    // document.querySelectorAll('.job-overview#job-produk').forEach(el => {
    //     el.className = 'job';
    // });
    // document.querySelectorAll('.job-overview-cards').forEach(el => {
    //     el.className = 'job-cards';
    // });
    // document.querySelectorAll('.job-overview-card job-card overview-card').forEach(el => {
    //     el.className = 'job-card';
    // });
    // $('.job-explain').hide();
  }

  async show_produk(jobCard, json, index) {
    const raw = decodeURIComponent(escape(atob(json)));
    const parsed = JSON.parse(raw);
    console.log("show_produk", parsed);
    const wrapper = document.querySelector("#wrapper-job-" + index);
    const number = Math.floor(Math.random() * 10);
    const url = `https://unsplash.it/640/425?image=${number}`;

    $('.job-explain').show();

    wrapper.querySelector(
      ".job-explain-content .job-card-title"
    ).textContent = parsed.nama_barang;
    wrapper.querySelector(".job-logos").innerHTML = "<img src='" + parsed.foto_aset + "'  onclick='showPopup(this)'>";
    wrapper.querySelector(".overview-desc").innerHTML = parsed.deskripsi_barang;
    wrapper.querySelector(".job-subtitle-wrapper").innerHTML = parsed.harga_full;
    wrapper.classList.add("detail-page");
    wrapper.scrollTop = 0;
    wrapper.querySelectorAll('.job#job-produk').forEach(el => {
      el.className = 'job-overview';
    });
    wrapper.querySelectorAll('.job-cards').forEach(el => {
      el.className = 'job-overview-cards';
    });
    wrapper.querySelectorAll('.job-card').forEach(el => {
      el.className = 'job-overview-card job-card overview-card';
    });

    let html = '';
    html += '<div class="row">';
    html += '<input type="hidden" id="max_variasi" value="' + parseInt(parsed.max_variasi) + '"> ';
    if (parseInt(parsed.max_variasi) >= 1)
      html += await varian_list(parsed, "tipe_1", 1, json);
    if (parseInt(parsed.max_variasi) >= 2)
      html += await varian_list(parsed, "tipe_2", 2, json);
    if (parseInt(parsed.max_variasi) >= 3)
      html += await varian_list(parsed, "tipe_3", 3, json);
    html += '</div>';

    html += '<input type="hidden" id="id_asset" value="' + parsed.id_asset + '">';
    html += '<input type="hidden" id="id_produk" value="' + parsed.id + '">';
    html += '<input type="hidden" id="id_asset_varian" value="">';
    html += '<input type="hidden" id="id_produk_varian" value="">';

    wrapper.querySelector(".job-varian").innerHTML = html;
    wrapper.querySelector("#stok-content").innerHTML = parsed.stok;



  }


  async loadMoredata(index, page) {
    if (!page) {
      page = 1;
    }

    if (!this.getModule('data_produk_itemsPerPage')[index]) {
      this.getModule('data_produk_itemsPerPage')[index] = 1;
    }
    // alert(page);
    const startIndex = (page - 1) * this.getModule('data_produk_itemsPerPage')[index];
    const endIndex = page * this.getModule('data_produk_itemsPerPage')[index];

    console.log("this.getModule('data_produk_itemsPerPage')", this.getModule('data_produk_itemsPerPage'));
    let storage_produk = this.getModule('data_produk');
    if (startIndex !== 0) {
      
      let wrapper = document.querySelector("#wrapper-job-" + index);
      const searchInput = document.querySelector('#search-' + index);
      const query = searchInput.value.trim();
      const dataSearc = wrapper.dataset.search;
      const objSearch = JSON.parse(atob(dataSearc));
      const fieldsToSearch = objSearch;
      let whereClause = [];
      if(query){

        whereClause.push({
          fields: fieldsToSearch,
          operator: 'like_or_fields',
          value: `%${query}%`
        });
      }
        const queryBody = {
        db: 'view_produk_detail', // atau nama db dinamis Anda
        where: whereClause,
        select:["primary_key"],
        group:["primary_key"],
        limit: wrapper.dataset.itemsPerPage, // atau batas yang Anda inginkan
        offset: startIndex,
        function: 'all_produk'
      };
      let data_baru = await window.fai.getModule('Data').loadJSON('all_produk', queryBody);
      console.log("data_baru", data_baru);
      // 2. Ambil referensi ke penyimpanan data global
      storage_produk[index] = data_baru

      // 3. Validasi: Pastikan index tersebut ada dan berupa array
      // if (!Array.isArray(storage_produk[index])) {
      //   storage_produk[index] = []; // Buat array kosong jika belum ada
      // }

      // // 4. Masukkan data
      // if (Array.isArray(data_baru)) {
      //   // KASUS A: Jika data_baru adalah Array (banyak item)
      //   // Gunakan '...' (spread operator) untuk menggabungkan isi array
      //   storage_produk[index].push(...data_baru);
      // } else {
      //   // KASUS B: Jika data_baru hanya 1 Object
      //   storage_produk[index].push(data_baru);
      // };
    }
    let data = (this.getModule('data_produk')[index]);
    const arrayProduk = Object.values(storage_produk[index]); // jadi array
    console.log("arrayProduk", arrayProduk);
    console.log("startIndex", startIndex);
    console.log("endIndex", endIndex);
    return arrayProduk;
  }

  async load_more(index) {
    if (!this.currentPage[index]) {
      this.currentPage[index] = 1;
    }
    this.currentPage[index]++;

    this.appendData(index, this.currentPage[index]);
  }

  async paginate(array, page, limit) {
    const startIndex = (page - 1) * limit;
    const endIndex = page * limit;
    return array.slice(startIndex, endIndex);
  }

  // var data' . $function . '_' . $type . ' = 
  async renderPage(page, index) {
    const paginateddata = paginate(this.getModule('data_produk')[index], page, this.getModule('data_produk_itemsPerPage')[index]);
    const listContainer = document.getElementById("content-" + index);
    listContainer.innerHTML = "";

    // paginateddata' . $function . '_' . $type . '.forEach(item => {
    //     const listItem = document.createElement("li");
    //     listItem.textContent = \'${item.artikel}\';
    //     listContainer.appendChild(listItem);
    // });

    // document.getElementById("pageNumber").textContent = \'Page ${page}\';
  }

  async setupPagination(index, totalItems, itemsPerPage) {
    const totalPages = Math.ceil(totalItems / this.getModule('data_produk_itemsPerPage')[index]);
    const paginationContainer = document.getElementById("pagination");

    paginationContainer.innerHTML = "";
    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement("button");
      button.textContent = i;
      button.onclick = () => {
        this.currentPage[index] = i;
        renderPage(this.currentPage, index);
      };
      paginationContainer.appendChild(button);
    }
  }


  async searchdata(index) {
    clearTimeout(this.debounceTimer);
    this.debounceTimer = setTimeout(async () => {
      // Gantilah ini dengan proses pencarian aslimu
      await this.prosessearchdata(index);
    }, 1000); // delay 300ms

  }
  async prosessearchdata(index) {

    // let query = document.getElementById("search-" + index).value.toLowerCase();
    document.getElementById("content-" + index).innerHTML = "";

    let data_produk;
    let wrapper = document.querySelector("#wrapper-job-" + index);
    const searchInput = document.querySelector('#search-' + index);
    const query = searchInput.value.trim();
    const dataSearc = wrapper.dataset.search;
    const objSearch = JSON.parse(atob(dataSearc));
    const fieldsToSearch = objSearch;
    let whereClause = [];
    whereClause.push({
      fields: fieldsToSearch,
      operator: 'like_or_fields',
      value: `%${query}%`
    });
    const queryBody = {
      db: 'view_produk_detail', // atau nama db dinamis Anda
      where: whereClause,
       select:["primary_key"],
        group:["primary_key"],
      limit: wrapper.dataset.itemsPerPage, // atau batas yang Anda inginkan
      offset: 0,
      function: 'all_produk'
    };
    data_produk = await window.fai.getModule('Data').loadJSON('all_produk', queryBody);


    window.fai.getModule('data_produk')[index] = data_produk;


    this.currentPage[index] = 1; // Reset ke halaman pertama
    this.appendData(index, this.currentPage[index]); // Render ulang dengan data yang difilter
  }
  async searchdata2(index) {

    let query = document.getElementById("search-" + index).value.toLowerCase();
    document.getElementById("content-" + index).innerHTML = "";
    const realData = this.getModule('data_produk_real')[index];
    const realArray = Array.isArray(realData) ?
      realData :
      Object.values(realData); // kalau dia object dengan key numerik, dll
    if (query.trim() === "") {
      this.getModule('data_produk')[index] =
        realArray; // Kembalikan ke data' . $async  . '_' . $type . ' asli jika input kosong
    } else {
      let data_produk;
      data_produk = realArray.filter(item => {
        let fields = this.getModule('data_produk_search_field')[index];

        return fields.some(field => {
          const value = item[field];
          return value && value.toString().toLowerCase().includes(query.toLowerCase());
        });

      });
      data_produk = data_produk.filter(item => {
        let isMatch = true;

        document.querySelectorAll('.searchdata-' + index).forEach(el => {
          const key = el.dataset.key;
          const type = el.dataset.type;
          const inputVal = el.value;
          if (inputVal) {
            if (!key || !type) return;

            if (type === 'select') {
              if (inputVal && item[key] != inputVal) {
                isMatch = false;
              }
            } else if (type === 'range') {
              // Misal input range disimpan di format: min-max (contoh: "100000-200000")
              const [min, max] = inputVal.split('-').map(v => parseFloat(v.trim()));
              const itemVal = parseFloat(item[key]);
              if (inputVal && (isNaN(itemVal) || itemVal < min || itemVal > max)) {
                isMatch = false;
              }
            } else if (type === 'checkbox') {
              // Ambil semua checkbox dengan key dan index yang sama
              const selected = [...document.querySelectorAll(
                `.searchdata-${index}[data-key="${key}"][data-type="checkbox"]:checked`
              )]
                .map(cb => cb.value);
              if (selected.length > 0 && !selected.includes(String(item[key]))) {
                isMatch = false;
              }
            }
          }
        });

        return isMatch;
      });
      this.getModule('data_produk')[index] = data_produk;
    }

    this.currentPage[index] = 1; // Reset ke halaman pertama
    this.appendData(index, this.currentPage[index]); // Render ulang dengan data yang difilter
  }

  initSearchListenersProduk(index) {
    const wrapper = document.querySelector("#wrapper-job-" + index);

    wrapper.addEventListener("input", (e) => {
      if (e.target.id === "search-" + index) {
        this.searchdata(index);
      }
    });
    wrapper.addEventListener("keyup", (e) => {
      if (e.target.id === "search-" + index) {
        this.searchdata(index);
      }
    });

    wrapper.addEventListener("change", (e) => {
      if (e.target.id === "search-" + index) {
        this.searchdata(index);
      }
    });
  }
  async proses_search_produk(tipe, variable, json) {
    const raw = decodeURIComponent(escape(atob(json)));
    const parsed = JSON.parse(raw);
    const html_id = parsed.key;
    let html_content = "";

    for (const row of parsed.data) {
      if (row.type == 'checkbox') {
        html_content += `
                    <div class="job-time">
                        <div class="job-time-title">${row.name}</div>
                        <div class="job-wrapper">`;
        storeName = row.db;
        const db = await openDB(transaksiDB, storeName);
        let allData = await getAllFromStore(db, {
          utama: storeName
        }, storeName);
        console.log("r", allData);
        Object.values(allData).forEach(element => {
          html_content += `<div class="type-container">
                            <input type="checkbox" id="job1" class="job-style" value="${element[row.option_key]}" class="searchdata-${variable}" data-type="${row.type}" data-key="${row.key_search}" onclick="searchdata('` + variable + `')">
                            <label for="job1">${element[row.option_value]}</label>
                            <span class="job-number">56</span>
                        </div> `;

        });


        html_content += `</div>
                        </div>
                        `;
      } else
        if (row.type == 'range') {
          html_content += `<div class="job-time">
                        <div class="job-time-title"> ${row.name}</div>
                        <div class="job-wrapper">
                            `;
          const option_literasi = parseInt(row.option_literasi);
          const option_akhir = parseInt(row.option_akhir);

          let ranges = [];
          let start = 0;
          let end = option_literasi;

          while (start < option_akhir) {
            html_content += `<div class="type-container">
                                <input type="checkbox" id="job1" class="job-style"  onclick="searchdata('` + variable + `')" class="searchdata-${variable}" data-type="${row.type}" data-key="${row.key_search}">
                                <label for="job1">${start.toLocaleString()} - ${end.toLocaleString()}</label>
                               
                            </div>`;
            //  <span class="job-number">49</span>
            ranges.push(`${start.toLocaleString()} - ${end.toLocaleString()}`);
            start = end + 1;
            end += option_literasi;
            if (end > option_akhir) end = option_akhir;
          }

          console.log(ranges);

          html_content += `
                        </div>
                    </div>`;
        } else
          if (row.type == 'select') {
            console.log("row.html_id", html_id);
            html_content += `
                    <div class="search-job">
                    <select class="form-control searchdata-${variable} select2" data-key="${row.key_search}"  data-type="${row.type}"  onchange="searchdata('` + variable + `')" >
                    <option value="">- Pilih ${row.name} -</option>`;
            let storeName = row.db;
            console.log("Available modules:", Object.keys(this.deps || {}));
            console.log("Trying to access module:", await this.getModule('CoreDatabase'));
            let data = await this.getModule('CoreDatabase').getApiData(storeName, {});
            let allData = await this.getModule('CoreDatabase').getAllFromStore({
              utama: storeName
            }, storeName);

            Object.values(allData).forEach(element => {
              html_content += `<option value="${element[row.option_key]}">${element[row.option_value]}</option>`;
            });

            html_content += `</select></div>`;

          }

    };


    if (html_content) {

      if (parsed.method == 'append') {
        $('#' + html_id + "-" + variable).append(html_content);

      } else {

        $('#' + html_id + "-" + variable).html(html_content);
      }
    }
  }
  async no_search_produk(tipe, index) {
    if (tipe == 'sidebar') {

      document.querySelectorAll('.search-type').forEach(el => {
        el.classList.remove('search-type');
      });
    } else
      if (tipe == 'search') {

        $('#PRODUK-HEADER-' + index).hide()
      }
  }
  async appendData(index, page) {

    const paginateddata = await this.loadMoredata(index, page);
    const listContainer = document.getElementById("content-" + index);
    const transformArray = (inputArray) => {
      const [key, value] = inputArray;
      // Jika value adalah array, gabungkan dengan format yang diinginkan
      if (Array.isArray(value)) {
        return `${key}=[${value.map(item => `"${item}"`).join(",")}]`;
      }

      // Untuk value non-array
      return `${key}="${value}"`;
    };
    let listItem
    let nomor = 0;
    let contentHtml = this.getModule('data_produk_content')[index];
    //console.log("paginateddata", paginateddata);
    paginateddata.forEach(item => {
      nomor++;
      listItem = contentHtml;

      if (Object.keys(this.getModule('data_produk_array')[index]).length) {
        let array_index = (this.getModule('data_produk_array')[index]);
        Object.entries(array_index).forEach(([key, obj]) => {
          // Pastikan obj adalah array dengan isi [key_array, type_array, value_array]
          if (Array.isArray(obj)) {
            //console.log(obj);
            let [type_array, value_array] = obj;
            //console.log(`<${key}></${key}>`+'REPLACE'+value_array+">>"+ item[value_array])

            if (type_array === 'data') {
              listItem = listItem.replace(`<${key}></${key}>`, item[value_array]);
            }
          } else {
            // console.warn(`Lewati key '${key}' karena tidak iterable`, obj);
          }
        });

      }
      listItem = listItem.replace(`<JSON></JSON>`, btoa(unescape(encodeURIComponent(JSON.stringify(
        item)))));
      $("#content-" + index).append(listItem);

      // owlasync (nomor, nomor2);


    });
    // Periksa apakah data habis
    $("#loading").html("");
    let counter = 0;
    if (this.currentPage[index] * this.getModule('data_produk_itemsPerPage')[index] >= this.getModule('data_produk')[index].length) {
      // document.getElementById("loadMoreButton").style.display = "none";
    }
  }
}
