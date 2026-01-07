import FaiModule from '../FaiModule.js';
export default class CoreDatabase extends FaiModule {
    async setModule(key, value) {
        this[key] = value;
    }
    async databaseConverter(content, data) {
        let row = {
            query: 0,
            is_json: 0,
            num_rows: 0,
            row: []
        };
        let search = {};
        if (!content.database) {

            row.row = [{
                object: 'foreach_1_row'
            }];
            row.num_rows = 1;
            return row;
        } else {
            if (content.database.live) {
                search.live = content.database.live;
            }
        }

        const storeName = content.database?.utama ?? '-1';
        const allData = await this.getAllFromStore(content.database, storeName, search, data);
        console.log("allData", allData);
        Object.entries(allData).forEach(([key, obj]) => {
            obj.primary_key = key;
        });
        row.row = allData;
        row.num_rows = Object.keys(allData).length;
        row.query = 1;

        // handle pagination JSON flag
        if (content.pagination?.page === 'json') {
            row.is_json = 1;
        }

        return row;
    }
    async getAllFromStore(database, storeName, search = {}, data = {}) {
        try {
            let allData;
            let row = {};
            if (!search.database) {
                search.database = database;
            }
            console.log(database);
            if (storeName || database?.query || search?.database?.query) {
                console.log("masuk");
                let getAPi = await this.getApiData(storeName, search, data);
                console.log("getAPi", getAPi);

                allData = getAPi;
                if (search.live == 2) {
                    return (getAPi.row);
                }
                if (search.live == 1) {
                    return (getAPi.row);
                }
                if (search.id_search) {
                    const id_search = parseInt(search.id_search);

                    // const filtered = allData.filter(item => {
                    //     const rowAwal = parseInt(item.row_awal || 0);
                    //     const rowAkhir = parseInt(item.row_akhir || 0);
                    //     return id_search >= rowAwal && id_search <= rowAkhir;
                    // });
                    // if(filtered)
                    // allData = filtered;

                }

                console.log("getAPi non live", getAPi);
                row = await this.ParseAllData(allData, search);
                console.log("row:", row);
            }
            // console.log("row:", row);
            return row;
        } catch (err) {
            alert("Gagal getAllFromStore: " + err.message);
        }

    }
    async ParseAllData(allData, database, search = {}) {
        let row = {};
        let parsed;
        let item;
        // console.log("ParseAllData", typeof allData);
        // if (typeof allData === "object" && allData !== null) {
        //     // // Ubah object jadi array
        //     allData = Object.values(allData);
        // }
        console.log("ParseAllData", allData,typeof allData);
        if (Array.isArray(allData)) {
            console.log("alldata is Array");
            allData.forEach(data => {

                if (typeof data.json_data) {

                    console.log("data.json_data" + (typeof data.json_data) + " ", data.json_data);
                    if (typeof data.json_data === 'string') {
                        try {
                            parsed = JSON.parse(data.json_data);
                            // console.log(parsed);
                            if (search.id_search) {
                                key = search.id_search;
                                row[key] = parsed[key].current;
                            } else {
                                for (const key in parsed) {
                                    if (parsed[key]?.current) {
                                        item = row[key] = parsed[key].current;

                                    }
                                }
                            }
                        } catch (err) {
                            console.warn("Gagal parse JSON:", err, data.json_data);
                        }

                    } else if (typeof data.json_data === 'object') {
                        parsed = data.json_data;
                        // console.log("data", data);
                        // console.log("parsed", parsed);
                        // console.log("typeof data.json_data.current", typeof data.json_data.current);
                        if (typeof data.json_data.current === 'object') {
                            // console.log("parsed.current", parsed.current);
                            row = parsed.current;
                        } else {
                            if (search.id_search && parsed[key].current) {
                                key = search.id_search;
                                row[key] = parsed[key].current;
                            } else {

                                for (const key in parsed) {

                                    // console.log("parsed", parsed[key].current);
                                    if (parsed[key]?.current) {
                                        item = row[key] = parsed[key].current;
                                        // if (database.join) {
                                        //     //prosesJoin(item, database, db);

                                        // }
                                    }
                                }
                            }
                        }

                    }
                }

            });
        } else if (typeof allData === 'object' && allData.json_data) {
            console.log("onject allData");
            parsed = allData.json_data;
            // console.log("data", data);
            // console.log("parsed", parsed);
            // console.log("typeof data.json_data.current", typeof data.json_data.current);
            if (typeof allData.json_data.current === 'object') {
                // console.log("parsed.current", parsed.current);
                row = parsed.current;
            } else {
                if (search.id_search && parsed[key].current) {
                    key = search.id_search;
                    row[key] = parsed[key].current;
                } else {

                    for (const key in parsed) {

                        // console.log("parsed", parsed[key].current);
                        if (parsed[key]?.current) {
                            item = row[key] = parsed[key].current;
                            // if (database.join) {
                            //     //prosesJoin(item, database, db);

                            // }
                        }else{
                            row[key] = parsed[key];
                        }
                    }
                }
            }
        }
        return row;
    }
    async getApiData(storeName, search = {}, data = {}) {
        const apiUrl = this.getModule("base_url") + "api/get_db_json";

        try {
            // ['load']['load_page_id']
            let page = window.fai.getModule("versionContent");

            let load_page_id
            if (page?.view?.load?.load_page_id)
                load_page_id = page.view.load.load_page_id || "-1";
            else
                load_page_id = "-1"
            const deviceId = await this.getModule("deviceHelper").getDeviceId();
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
                    load: {
                        load_page_id: load_page_id
                    },
                    deviceId: deviceId
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

                }

        } catch (err) {
            console.error("Fetch atau simpan gagal:" + storeName, err);
            throw err;
        }
    }
}