import FaiModule from '../FaiModule.js';
export default class DataProcessing extends FaiModule {
	async getApiData(storeName, search = {}, data = {}) {
		const apiUrl = base_url + "api/get_db_json";

		try {


			const deviceId = await getDeviceId();
			const response = await fetch(apiUrl, {
				method: "POST",
				headers: {
					'Content-Type': 'application/json',
					'X-Custom-Header': 'FullData'
				},
				body: JSON.stringify({
					db: storeName,
					search: search,
					data: data,
					deviceId: deviceId,
					load: getalldata.myApp.page.load,
				}) // kirim storeName sebagai payload
			});
			if (!response.ok) throw new Error("Gagal fetch dari API");

			const dataFromAPI = await response.json();


			if (parseInt(search.live) == 2) {

				return (dataFromAPI);;
			} else
				if (parseInt(search.live) == 1) {
					return (dataFromAPI);;
				} else {
					return (dataFromAPI);;
					// alert(2);
					// Transaksi IndexedDB
					/* const writeTx = db.transaction(storeName, "readwrite");
					 const writeStore = writeTx.objectStore(storeName);
	
					 // Fungsi untuk memproses data
					 const processData = async () => {
						 if (Array.isArray(dataFromAPI)) {
							 // Menggunakan for-loop untuk async/await
							 for (let item of dataFromAPI) {
								 const key = item.id + item.nama_db + item.row_awal + item.row_akhir;
								 const existingItem = await getItemFromIndexedDB(writeStore, key);
	
								 if (existingItem) {
									 console.log("Existing");
									 // Update json_data dan kapan_update_terakhir
									 existingItem.json_data = item.json_data;
									 existingItem.kapan_update_terakhir = item.kapan_update_terakhir;
									 writeStore.put(existingItem); // Update data yang ada
								 } else {
									 console.log("Input");
									 // Simpan data baru
									 if (item.id) {
										 writeStore.put(item);
									 } else {
										 console.warn("Objek tanpa id ditemukan, dilewati:", item);
									 }
								 }
							 }
						 } else if (typeof dataFromAPI === 'object' && dataFromAPI.id) {
							 const key = dataFromAPI.id + dataFromAPI.nama_db + dataFromAPI.row_awal +
								 dataFromAPI.row_akhir;
							 const existingItem = await getItemFromIndexedDB(writeStore, key);
	
							 if (existingItem) {
								 // Update json_data dan kapan_update_terakhir
								 console.log("Existing");
								 existingItem.json_data = dataFromAPI.json_data;
								 existingItem.kapan_update_terakhir = dataFromAPI.kapan_update_terakhir;
								 writeStore.put(existingItem); // Update data yang ada
							 } else {
								 console.log("Input");
								 // Simpan data baru
								 writeStore.put(dataFromAPI);
							 }
						 } else {
							 console.error("Format data tidak valid:", dataFromAPI);
							 throw new Error("Format data tidak valid");
						 }
					 };
				 	
					 // Jalankan proses data
	
	
					 await processData();
		
					 // Event selesai transaksi
					 writeTx.oncomplete = () => console.log("Data berhasil disimpan ke IndexedDB");
					 writeTx.onerror = (err) => {
						 console.error("Gagal menyimpan data ke IndexedDB", err);
					 };*/

					/*
					const processData = async () => {
					   let combinedJsonData = []; // Array to store all json_data
	
	try {
	if (Array.isArray(dataFromAPI)) {
		// Process each item in the array
		for (let item of dataFromAPI) {
			if (item.json_data && typeof item.json_data === 'object') {
				// Handle the case where json_data is an object with numeric keys
				if (!Array.isArray(item.json_data)) {
					// Convert the object-with-numeric-keys to an array of values
					const nestedItems = Object.values(item.json_data);
					combinedJsonData = combinedJsonData.concat(nestedItems);
				} else {
					// If it's already an array, just concatenate
					combinedJsonData = combinedJsonData.concat(item.json_data);
				}
			}
		}
	} else if (typeof dataFromAPI === 'object' && dataFromAPI.json_data) {
		// Process single object
		if (typeof dataFromAPI.json_data === 'object') {
			if (!Array.isArray(dataFromAPI.json_data)) {
				const nestedItems = Object.values(dataFromAPI.json_data);
				combinedJsonData = combinedJsonData.concat(nestedItems);
			} else {
				combinedJsonData = combinedJsonData.concat(dataFromAPI.json_data);
			}
		}
	} else {
		console.error("Invalid data format:", dataFromAPI);
		throw new Error("Invalid data format");
	}
	
	// Add primary_key to each object in combinedJsonData
	 combinedJsonData = Object.fromEntries(
	  combinedJsonData.map(item => [item[0], item])
	);
		
	// Alternative using Object.entries (if you really need it)
	// const result = {};
	// combinedJsonData.forEach((obj, index) => {
	//     result[index] = obj;
	//     obj.primary_key = index.toString();
	// });
	// combinedJsonData = Object.values(result);
	
	console.log("Combined JSON Data with primary keys:", combinedJsonData);
	return combinedJsonData;
	} catch (error) {
	console.error("Error processing data:", error);
	throw error;
	}
					};
					 return await processData();
					*/
				}

		} catch (err) {
			console.error("Fetch atau simpan gagal:" + storeName, err);
			throw err;
		}
	}
	async loadJSON(db = 'inventaris__asset__master__kategori_toko', queryBody = {}) {
		try {
			const now = new Date();
			const year = now.getUTCFullYear();
			const month = String(now.getUTCMonth() + 1).padStart(2, '0');
			const day = String(now.getUTCDate()).padStart(2, '0');
			const hour = String(now.getUTCHours()).padStart(2, '0');

			const token = `SECRET_TOKEN_${year}${month}${day}${hour}`;
			/*
				
				//let queryBody = {};
				/*let queryBody = {
					db: 'db1',
					where: [
						{
							field: 'city',
							operator: '=',
							value: 'Jakarta'
						}
					],
					orderBy: {
						field: 'age',
						direction: 'desc'
					},
					limit: 2
				};*/
			response = await fetch(base_url + 'json/' + db, {
				headers: {
					'Authorization': `Bearer ${token}`
				},
				method: 'POST',

				// 2. Tambahkan header 'Content-Type'
				headers: {
					'Content-Type': 'application/json',
					'Authorization': `Bearer ${token}`
				},

				// 3. Kirim objek query sebagai string JSON di body
				body: JSON.stringify(queryBody)
			});
			originalData = await response.json();
			return originalData.data;
		} catch (error) {
			console.error('Error loading data:', error);

		}
	}
} 