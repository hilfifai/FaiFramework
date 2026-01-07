

// Fungsi untuk menyortir array berdasarkan urutan ukuran
export async function sortSizes(arr) {
  const sizeOrder = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4XL', '5XL', '6XL'];
  return arr.sort((a, b) => {
    // Urutan yang benar untuk ukuran
    return sizeOrder.indexOf(a) - sizeOrder.indexOf(b);
  });
}

// Fungsi untuk menyortir angka
export async function sortNumbers(arr) {
  return arr.sort((a, b) => a - b);
}
export async function fetchDataFromApi(apiEndpoint, method = 'GET', data = null) {
  try {
    const options = {
      method,
      headers: {
        'Content-Type': 'application/json'
      }
    };

    if (method === 'GET' && data) {
      // 🔗 Ubah data object ke query string
      const params = new URLSearchParams(data).toString();
      apiEndpoint += (apiEndpoint.includes('?') ? '&' : '?') + params;
    } else if (data && method !== 'HEAD') {
      // 📨 Untuk POST/PUT dsb, kirim lewat body
      options.body = JSON.stringify(data);
    }
    const response = await fetch(apiEndpoint, options);
    if (!response.ok) throw new Error('Network response was not ok');

    return await response.json();
  } catch (error) {
    console.error('Error fetching data from API:', error);
    throw error;
  }
}

// Gabungkan keduanya dalam satu array jika diperlukan
export async function sortData(arr) {
  const sizeOrder = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4XL', '5XL', '6XL'];

  return arr.sort((a, b) => {
    const sizeIndexA = sizeOrder.indexOf(a.nama_varian);
    const sizeIndexB = sizeOrder.indexOf(b.nama_varian);

    // Jika kedua varian adalah ukuran (XS–6XL)
    if (sizeIndexA !== -1 && sizeIndexB !== -1) {
      return sizeIndexA - sizeIndexB;
    }

    // Jika kedua varian adalah angka murni
    if (!isNaN(a.nama_varian) && !isNaN(b.nama_varian)) {
      return Number(a.nama_varian) - Number(b.nama_varian);
    }

    // Jika A ukuran dan B bukan ukuran
    if (sizeIndexA !== -1) {
      return -1;
    }

    // Jika B ukuran dan A bukan ukuran
    if (sizeIndexB !== -1) {
      return 1;
    }

    // fallback, bandingkan alphabet (jika string biasa)
    return String(a.nama_varian).localeCompare(String(b.nama_varian));
  });
}

export async function formatRupiah(angka, prefix = 'Rp ') {

  if (!angka)
    angka = 0;
  angka = parseFloat(angka);
  angka = angka.toString();
  var numberString = angka.toString().replace(/[^\d.]/g, '');

  // Split the string into integer and decimal parts
  var parts = numberString.split('.');

  var integerPart = parts[0];
  var decimalPart = parts.length > 1 ? parts[1] : '';

  decimalPart = decimalPart.length > 1 ? decimalPart.toString().substring(0, 2) : '';

  decimalPart = decimalPart.length > 1 ? ',' + decimalPart : '';


  // Add thousand separators to the integer part
  integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  // Combine integer and decimal parts

  var formattedAmount = prefix + integerPart + decimalPart;
  
  return formattedAmount;

}

export async function formatRupiah2(input, prefix = "Rp") {
  if (isNaN(input)) {
    return '${prefix} 0';
  }
  number = parseInt(input.replace(/[^,\d]/g, ""), 10)
  // Menggunakan toLocaleString untuk format angka
  return `${prefix} ${number.toLocaleString("id-ID")}`;
}

export async function toPlainNumber(rupiah) {
  return parseInt(rupiah.replace(/[^,\d]/g, ""), 10) || 0; // Hapus "Rp" dan tanda titik
}

export async function showPopup(img) {
  const popup = document.getElementById('popup');
  const popupImg = document.getElementById('popup-img');
  popupImg.src = img.src;
  popup.style.display = 'flex';
  zoomLevel = 1;
  offsetX = 0;
  offsetY = 0;
  popupImg.style.transform = 'scale(1)';
  popupImg.style.transformOrigin = 'center center'; // default
  document.body.classList.add('no-scroll');
}
let zoomLevel = 1;
const popupImg = document.getElementById('popup-img');
popupImg.addEventListener('click', function (e) {
  if (zoomLevel >= 3) return; // batasi zoom maksimal

  const rect = popupImg.getBoundingClientRect();
  const clickX = e.clientX - rect.left;
  const clickY = e.clientY - rect.top;
  const percentX = (clickX / rect.width) * 100;
  const percentY = (clickY / rect.height) * 100;

  zoomLevel += 0.5;
  popupImg.style.transformOrigin = `${percentX}% ${percentY}%`;
  applyZoom();
});

export async function zoomIn(event) {
  event.stopPropagation();
  zoomLevel += 0.2;
  applyZoom();
}

export async function zoomOut(event) {
  event.stopPropagation();
  zoomLevel = Math.max(0.2, zoomLevel - 0.2);
  applyZoom();
}

export async function applyZoom() {
  popupImg.style.transform =
    `scale(${zoomLevel}) translate(${offsetX / zoomLevel}px, ${offsetY / zoomLevel}px)`;
}

export async function applyZoom2() {
  document.getElementById('popup-img').style.transform = `scale(${zoomLevel})`;
}

export async function closePopup(event) {
  if (!event || event.target.id === 'popup') {
    document.getElementById('popup').style.display = 'none';
    document.body.classList.remove('no-scroll');
  }
}
export async function delay(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

// Fungsi async utama




export async function select2_function(storeName, id) {
  $('#mySelect2').select2({
    ajax: {
      transport: function (params, success, failure) {
        (async () => {
          const db = await openDB(transaksiDB, storeName);
          const allData = await getApiData(db, storeName, {});

          const filtered = allData.filter(item =>
            item.label.toLowerCase().includes(params.data.q.toLowerCase())
          );

          // Format Select2 data
          const results = filtered.map(item => ({
            id: item.value,
            text: item.label
          }));

          success({
            results
          });
        })().catch(failure);
      },
      delay: 250,
      data: function (params) {
        return {
          q: params.term || ""
        };
      },
      processResults: function (data) {
        return data;
      }
    },
    placeholder: 'Cari data...',
    minimumInputLength: 1,
  });

}